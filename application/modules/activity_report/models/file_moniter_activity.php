<?php
class File_moniter_activity extends CI_Model {
    function __construct() {
        parent::__construct();
    }	
	public function count_files_monitore($section_id = null ,$status = null ,$empid = null, $s_date = null, $e_date = null, $on = null,$limit=null,$page=null)
    {
		$section_id = explode(',', $section_id);
        $action ='';
		$lvl='';
		if(isset($_GET['a'])){
			$action = $_GET['a'];
		}
		if(isset($_GET['lvl'])){
			$lvl = $_GET['lvl'];
		}
		$file_officer_ids=get_officer_emp_ids();
		if($lvl=='section_dispose'){
			if(is_array($section_id)){
				$section_id= implode(',',$section_id);
			}			
			if(isset($_GET['searchby']) && $_GET['searchby']!=''){
				$searchval=$_GET['searchby'];
				$wheres= " and (FIND_IN_SET('".$searchval."',file_all_section_no) OR file_subject like '%".$searchval."%'  OR file_uo_or_letter_no like '%".$searchval."%' OR file_uo_or_letter_date = DATE_FORMAT('".$searchval."', '%Y-%m-%d'))";
			}
			$sql="SELECT COUNT(files.file_id) AS totalfiles FROM `ft_files` as files inner join ft_file_dispatch as file_dispetch on file_dispetch.file_id= files.file_id and issection_despose=1 WHERE files.file_mark_section_id IN ($section_id) AND (files.file_hardcopy_status = 'close') AND files.file_return = '2' $wheres";
			$query9	 = $this->db->query($sql);
			return $section_dispose= $query9->row_array();						
		}else if($lvl=='section_dis'){
			$sql="select * FROM ft_files where `file_return` ='2' and (file_hardcopy_status = 'received' or file_hardcopy_status = 'working' or file_hardcopy_status = 'not')";
			$query9	 = $this->db->query($sql);
			return $section_dispose= $query9->result();
		}else if($lvl=='dis_sec_cloase_file'){
			$sql="select * FROM ft_files where `file_return` ='2' and file_hardcopy_status = 'close'";
			$query9	 = $this->db->query($sql);
			return $section_dispose= $query9->result();
		}else if($lvl=='emp_section_dispose'){
			if(isset($_GET['secid']) && $_GET['secid']!=''){
			 $show_section_id =$_GET['secid'];
			}else{
				$show_section_id=0;
			}
			if(isset($_GET['searchby']) && $_GET['searchby']!=''){
					$searchval=trim($_GET['searchby']);
					$wheres= "(FIND_IN_SET('".$searchval."',files.file_all_section_no) OR files.file_subject like '%".$searchval."%'  OR files.file_uo_or_letter_no like '%".$searchval."%' OR files.file_uo_or_letter_date = DATE_FORMAT('".$searchval."', '%Y-%m-%d')) and ";
			}
			$sql="SELECT COUNT(DISTINCT(files.file_id)) AS totalfiles FROM `ft_files` as files inner join ft_file_dispatch as file_dispetch on file_dispetch.file_id=files.file_id and issection_despose=1 WHERE $wheres files.file_mark_section_id=$show_section_id AND(files.file_hardcopy_status = 'close') AND files.file_return = '2' and files.file_received_emp_id=$empid";
			$query9	 = $this->db->query($sql);
			return $section_dispose= $query9->row_array();
		}else if($lvl=='sent_dipatch_section'){		
			$where = "file_mark_section_id IN(".implode(',',$section_id).") ";
			if(isset($_GET['searchby']) && $_GET['searchby']!=''){
					$searchval=trim($_GET['searchby']);
					$sql_emp="SELECT emp_id,emp_full_name FROM ft_employee WHERE MATCH(emp_full_name_hi) AGAINST('".$searchval."')";
					$emp_row_details=get_row($sql_emp);
					if(isset($emp_row_details['emp_id']) && $emp_row_details['emp_id']!=''){				
						$searchval = $emp_row_details['emp_id'];
						$this->db->where('ft_files.file_received_emp_id',$searchval);
					}else{
					$wheres= " and (FIND_IN_SET('".$searchval."',file_all_section_no) OR file_subject like '%".$searchval."%'  OR file_uo_or_letter_no like '%".$searchval."%' OR file_uo_or_letter_date = DATE_FORMAT('".$searchval."', '%Y-%m-%d'))";
					$where=$where.$wheres;
					}
			}
			   //"select count(file_id) as total_numb_of_dispose FROM ft_files where `file_mark_section_id`='".$get_section[0]['section_id']."' and file_hardcopy_status = 'close' and `file_return` ='2'"	
			//$sql="SELECT COUNT(files.file_id) AS totalfiles FROM `ft_files` as files inner join ft_file_dispatch as file_dispetch on file_dispetch.file_id= files.file_id and issection_despose=0 and $where AND (files.file_hardcopy_status = 'close') AND files.file_return = '2'";
			$sql="SELECT count(distinct(files.file_id)) as totalfiles from `ft_files` as files  left join ft_file_dispatch as file_dispetch on file_dispetch.file_id= files.file_id where $where  AND (files.file_hardcopy_status = 'close') AND files.file_return = '2'";
			$query9	 = $this->db->query($sql);
			$section_dispose= $query9->row_array();
			//pr($section_dispose);
			return $section_dispose;
		}else if($lvl=='list_all_dipatch_section_files'){
			$sql="select * FROM ft_files where `file_return` ='2'";
			$query9	 = $this->db->query($sql);
			return $section_dispose= $query9->result();
		}else if($lvl=='view_ofcr_deald_files'){
			$empid = $_GET['empid'];	
			$sectionid=null;
			return total_work_by_officer_emp('list_of_all_files_deals_by_user_count',$empid,$sectionid);
		}else{
				$tbl_files = FILES;
				$this->db->select("COUNT(DISTINCT(file_id)) as totalfiles");
				if(@$_GET['secid']==21){
					//$where = "ps_moniter_date !='' && ps_moniter_date!='0000-00-00'";
					$this->db->where('ps_moniter_date !=',"");
					$this->db->where('ps_moniter_date !=',"0000-00-00");
				}else{
					$where = "file_mark_section_id IN(".implode(',',$section_id).") ";
					$this->db->where_in($where);
				}
				if($status == 'received'){
					//$where1 = "(file_hardcopy_status ='received')";
					$where1 = "(file_hardcopy_status ='received' or file_hardcopy_status ='working')";
				}else if($status == 'working'){
					//$where1 = "(file_hardcopy_status ='working')";
					$where1 = "(file_hardcopy_status ='received' or file_hardcopy_status ='working')";
				}else if($status == '2' && $action=='dispetch'){
					//echo 'add';
					$where1 = "(file_hardcopy_status!='close')";
				}else if($status == '2' && $action=='dispose'){
					$where1 = "(file_hardcopy_status = 'close')";
				}else{
					$where1 = "file_hardcopy_status ='not'";
					$where1 .= "and file_mark_section_id IN(".implode(',',$section_id).") ";
					if($lvl=='section'){
						$where1.="and file_received_emp_id not in($file_officer_ids)";
					}else if($lvl=='officer'){
						$where1.="and file_received_emp_id in($file_officer_ids)";
					}
					//if()//
				}
				if($empid == null) {					
					if ($status != null && $status != '2' && $on == '') {
						$this->db->where($where1);
						$this->db->where('file_return !=', '2');
					}else if($status == '2' && ($action=='dispetch' || $action=='dispose') && $on == ''){
						$this->db->where($where1);
						$this->db->where("file_return", "2");
					}else if ($status == '2' && $on == '') {
						$this->db->where('file_return', $status);
					} else if($on != '' && $status != null ){
						$this->db->where("file_return", $on);	
						$this->db->where("file_hardcopy_status", $status);	
					}
				}else{
					if(isset($_GET['secid']) && $_GET['secid']==21){
						//$this->db->where(array('ps_moniter_date!='=>'','ps_moniter_date!='=>'0000-00-00'));
						$where = "ps_moniter_date !='' && ps_moniter_date!='0000-00-00' AND file_received_emp_id='$empid' && file_hardcopy_status!='close'";
					}else{
						if(isset($_GET['secid'])){
                            $where = "file_mark_section_id IN(".implode(',',$section_id).") AND file_received_emp_id='$empid' && file_hardcopy_status!='close'";
                        }else{
                            $where = "file_received_emp_id = '$empid' && file_hardcopy_status!='close'";
                        }
					}
					$this->db->where($where);
					if($status != null) {
						$this->db->where($where1);
					}
				}
				if(isset($_GET['secid']) && $_GET['secid']!='' && $_GET['s']=='' && $_GET['lvl']==''){	
					$section_id=$_GET['secid'];
					$where = "file_mark_section_id IN(".$section_id.")";
					$this->db->where($where);
				}else if(isset($_GET['secid']) && $_GET['secid']!='' && isset($_GET['s']) && $_GET['s']!='' && @$_GET['lvl']==''){
					
					$section_id=$_GET['secid'];
					$where = "file_mark_section_id IN(".$section_id.")";
					$this->db->where($where);
				}
				if($s_date != null && $e_date != null){
					$this->db->where("(date(file_update_date) > '$e_date' && date(file_update_date) <= '$s_date')");
				}
				if($s_date == null && $e_date != null){
					$this->db->where("date(file_update_date) <= '$e_date'");
				}
				if(isset($_GET['searchby']) && $_GET['searchby']!=''){
					$searchval=trim($_GET['searchby']);
					$wheres= "(FIND_IN_SET('".$searchval."',file_all_section_no) OR ft_files.file_subject like '%".$searchval."%'  OR ft_files.file_uo_or_letter_no like '%".$searchval."%' OR ft_files.file_uo_or_letter_date = DATE_FORMAT('".$searchval."', '%Y-%m-%d'))";
					$this->db->where($wheres);
				}
				$this->db->order_by("file_update_date", 'asc');        						
				$query = $this->db->get($tbl_files);
				$result = $query->row_array();					
				//echo $this->db->last_query();
				return $result;
		}

    }

    public function getFiles($section_id = null ,$status = null ,$empid = null, $s_date = null, $e_date = null, $on = null,$limit=null,$page=null)
    {
		$section_id = explode(',', $section_id);
        $action ='';
		$lvl='';
		if(isset($_GET['a'])){
			$action = $_GET['a'];
		}
		if(isset($_GET['lvl'])){
			$lvl = $_GET['lvl'];
		}
		$file_officer_ids=get_officer_emp_ids();
		if($lvl=='section_dispose'){
			$wheres_sd='';
			if(is_array($section_id)){
				$section_id= implode(',',$section_id);
			}
			if(isset($_GET['searchby']) && $_GET['searchby']!=''){
				$searchval=$_GET['searchby'];
				$wheres_sd= " and (FIND_IN_SET('".$searchval."',file_all_section_no) OR file_subject like '%".$searchval."%'  OR file_uo_or_letter_no like '%".$searchval."%' OR file_uo_or_letter_date = DATE_FORMAT('".$searchval."', '%Y-%m-%d'))";
			}
			$sql="SELECT * FROM `ft_files` as files inner join ft_file_dispatch as file_dispetch on file_dispetch.file_id= files.file_id and issection_despose=1 WHERE files.file_mark_section_id IN ($section_id) AND (files.file_hardcopy_status = 'close') AND files.file_return = '2' $wheres_sd LIMIT $limit OFFSET $page";
			$query9	 = $this->db->query($sql);
			return $section_dispose= $query9->result();
			//pre($section_dispose);
		}else if($lvl=='section_dis'){
			$sql="select * FROM ft_files where `file_return` ='2' and (file_hardcopy_status = 'received' or file_hardcopy_status = 'working' or file_hardcopy_status = 'not')";
			$query9	 = $this->db->query($sql);
			return $section_dispose= $query9->result();
		}else if($lvl=='dis_sec_cloase_file'){
			$sql="select * FROM ft_files where `file_return` ='2' and file_hardcopy_status = 'close'";
			$query9	 = $this->db->query($sql);
			return $section_dispose= $query9->result();
		}else if($lvl=='emp_section_dispose'){
			if(isset($_GET['secid']) && $_GET['secid']!=''){
			 $show_section_id =$_GET['secid'];
			}else{
				$show_section_id=0;
			}
			$wheres='';
			if(isset($_GET['searchby']) && $_GET['searchby']!=''){
					$searchval=trim($_GET['searchby']);
					$wheres= "(FIND_IN_SET('".$searchval."',files.file_all_section_no) OR files.file_subject like '%".$searchval."%'  OR files.file_uo_or_letter_no like '%".$searchval."%' OR files.file_uo_or_letter_date = DATE_FORMAT('".$searchval."', '%Y-%m-%d')) and ";
			}
			if(isset($_GET['per_page'])&&$_GET['per_page']!=''){
				$start_lmt=$_GET['per_page'];				
			}else{
				$start_lmt=0;
			}
			$end_lmt=10;
			$sql="SELECT files.* FROM `ft_files` as files inner join ft_file_dispatch as file_dispetch on file_dispetch.file_id=files.file_id and issection_despose=1 WHERE $wheres files.file_mark_section_id=$show_section_id AND(files.file_hardcopy_status = 'close') AND files.file_return = '2' and files.file_received_emp_id=$empid GROUP BY files.file_id ORDER BY file_update_date DESC limit $start_lmt,$end_lmt";
			$query9	 = $this->db->query($sql);
			return $section_dispose= $query9->result();
		}else if($lvl=='sent_dipatch_section'){		
			$where = "file_mark_section_id IN(".implode(',',$section_id).") ";
			if(isset($_GET['searchby']) && $_GET['searchby']!=''){
				$searchval=trim($_GET['searchby']);
				$wheres= " and (FIND_IN_SET('".$searchval."',file_all_section_no) OR file_subject like '%".$searchval."%'  OR file_uo_or_letter_no like '%".$searchval."%' OR file_uo_or_letter_date = DATE_FORMAT('".$searchval."', '%Y-%m-%d'))";
				$where=$where.$wheres;
			}
			$sql="SELECT * from `ft_files` as files  where $where  AND (files.file_hardcopy_status = 'close') AND files.file_return = '2' LIMIT $limit OFFSET $page";			
			$query9	 = $this->db->query($sql);
			return $section_dispose= $query9->result();
		}else if($lvl=='list_all_dipatch_section_files'){
			$sql="select * FROM ft_files where `file_return` ='2'";
			$query9	 = $this->db->query($sql);
			return $section_dispose= $query9->result();
		}else if($lvl=='view_ofcr_deald_files'){
			$empid = $_GET['empid'];	
			$sectionid=null;
			return total_work_by_officer_emp('list_of_all_files_deals_by_user',$empid,$sectionid,$limit,$page);
		}else{
				$tbl_files = FILES;
				$this->db->select('*');
				if(@$_GET['secid']==21){
					//$where = "ps_moniter_date !='' && ps_moniter_date!='0000-00-00'";
					$this->db->where('ps_moniter_date !=',"");
					$this->db->where('ps_moniter_date !=',"0000-00-00");
				}else{
					$where = "file_mark_section_id IN(".implode(',',$section_id).") ";
					$this->db->where_in($where);
				}
				if($status == 'received'){
					//$where1 = "(file_hardcopy_status ='received')";
					$where1 = "(file_hardcopy_status ='received' or file_hardcopy_status ='working')";
				}else if($status == 'working'){
					//$where1 = "(file_hardcopy_status ='working')";
					$where1 = "(file_hardcopy_status ='received' or file_hardcopy_status ='working')";
				}else if($status == '2' && $action=='dispetch'){
					//echo 'add';
					$where1 = "(file_hardcopy_status!='close')";
				}else if($status == '2' && $action=='dispose'){
					$where1 = "(file_hardcopy_status = 'close')";
				}else{
					$where1 = "file_hardcopy_status ='not'";
					$where1 .= "and file_mark_section_id IN(".implode(',',$section_id).") ";
					if($lvl=='section'){
						$where1.="and file_received_emp_id not in($file_officer_ids)";
					}else if($lvl=='officer'){
						$where1.="and file_received_emp_id in($file_officer_ids)";
					}
				}
				if($empid == null) {
					if ($status != null && $status != '2' && $on == '') {
						$this->db->where($where1);
						$this->db->where('file_return !=', '2');
					}else if($status == '2' && ($action=='dispetch' || $action=='dispose') && $on == ''){
						$this->db->where($where1);
						$this->db->where("file_return", "2");
					}else if ($status == '2' && $on == '') {
						$this->db->where('file_return', $status);
					} else if($on != '' && $status != null ){
						$this->db->where("file_return", $on);	
						$this->db->where("file_hardcopy_status", $status);	
					}
				}else{
					if(@$_GET['secid']==21){
						//$this->db->where(array('ps_moniter_date!='=>'','ps_moniter_date!='=>'0000-00-00'));
						$where = "ps_moniter_date !='' && ps_moniter_date!='0000-00-00' AND file_received_emp_id='$empid' && file_hardcopy_status!='close'";
					}else{
                        if(isset($_GET['secid'])){
                            $where = "file_mark_section_id IN(".implode(',',$section_id).") AND file_received_emp_id='$empid' && file_hardcopy_status!='close'";
                        }else{
                            $where = "file_received_emp_id = '$empid' && file_hardcopy_status!='close'";
                        }
					}
					$this->db->where($where);
					if($status != null) {
						$this->db->where($where1);
					}
				}
				if(isset($_GET['secid']) && $_GET['secid']!='' && $_GET['s']=='' && $_GET['lvl']==''){
				//if(isset($_GET['secid']) && $_GET['secid']!='' && $_GET['s']=='' && $_GET['lvl']==''){
					$section_id=$_GET['secid'];
					$where = "file_mark_section_id IN(".$section_id.")";
					$this->db->where($where);
				}else if(isset($_GET['secid']) && $_GET['secid']!='' && isset($_GET['s']) && $_GET['s']!='' && @$_GET['lvl']==''){
					$section_id=$_GET['secid'];
					$where = "file_mark_section_id IN(".$section_id.")";
					$this->db->where($where);
				}
				if($s_date != null && $e_date != null){
					$this->db->where("(date(file_update_date) > '$e_date' && date(file_update_date) <= '$s_date')");
				}
				if($s_date == null && $e_date != null){
					$this->db->where("date(file_update_date) <= '$e_date'");
				}
				if(isset($_GET['searchby']) && $_GET['searchby']!=''){
					$searchval=trim($_GET['searchby']);
					$sql_emp="SELECT emp_id,emp_full_name FROM ft_employee WHERE MATCH(emp_full_name_hi) AGAINST('".$searchval."')";
					$emp_row_details=get_row($sql_emp);
					if(isset($emp_row_details['emp_id']) && $emp_row_details['emp_id']!=''){				
						$searchval = $emp_row_details['emp_id'];
						$this->db->where('ft_files.file_received_emp_id',$searchval);
					}else{
						$wheres= "(FIND_IN_SET('".$searchval."',file_all_section_no) OR ft_files.file_subject like '%".$searchval."%'  OR ft_files.file_uo_or_letter_no like '%".$searchval."%' OR ft_files.file_uo_or_letter_date = DATE_FORMAT('".$searchval."', '%Y-%m-%d'))";
						$this->db->where($wheres);
					}
				}
				$this->db->order_by("file_update_date", 'asc');        		
				$this->db->limit($limit,$page);	
				$query = $this->db->get($tbl_files);
				$result = $query->result();				
				return $result;
		}
       // echo $this->db->last_query();

    }

	public function getFiles_log($empid = null, $s_date = null, $e_date = null, $action = null,  $status = null,$limit=null,$page=null)
    {
        $tbl_files = FILES;
        $tbl_files_log = FILES_LOG;
		$this->db->select('*');
		$this->db->join($tbl_files_log, "$tbl_files_log.file_id = $tbl_files.file_id");
		
		if($action != '' && $empid != ''){
			if($action == 'marked'){
				$this->db->where($tbl_files_log.".to_emp_id", "$empid");
				$this->db->where("file_hardcopy_status", "not");
			} else if($action == 'worked'){
				$this->db->where($tbl_files_log.".from_emp_id", "$empid");
				//$this->db->where("", "");
			} else if($action == 'received'){
				$this->db->where($tbl_files_log.".to_emp_id", "$empid");
				$this->db->where("file_hardcopy_status", "received");
			} else if($action == 'all'){
				$where = "(to_emp_id = '$empid' OR from_emp_id = '$empid') and (file_hardcopy_status != 'close')";
				$this->db->where($where);
				//$this->db->where("date(`flog_created_date`)", "$date");
			}
		}
		//for dispact reivce and not reicve with date 
						
		if($s_date != null && $e_date != null){
			$this->db->where("(date(flog_created_date) <= '$e_date' && date(flog_created_date) >= '$s_date')");
		}
		if($s_date != null && $e_date == null){
			$this->db->where("date(`flog_created_date`)", "$s_date");
		}
		if(isset($_GET['searchby']) && $_GET['searchby']!=''){
			$searchval=trim($_GET['searchby']);
			$wheres= "(FIND_IN_SET('".$searchval."',file_all_section_no) OR ft_files.file_subject like '%".$searchval."%'  OR ft_files.file_uo_or_letter_no like '%".$searchval."%' OR ft_files.file_uo_or_letter_date = DATE_FORMAT('".$searchval."', '%Y-%m-%d'))";
			$this->db->where($wheres);
		}
		$this->db->group_by($tbl_files.'.file_id');		
		$this->db->order_by($tbl_files.'.file_update_date','asc');
		$this->db->limit($limit,$page);
		$query = $this->db->get($tbl_files);
		$result = $query->result();
		//pre($result);
		//echo  $this->db->last_query();
		return $result;
    }
	
	public function count_getFiles_log($empid = null, $s_date = null, $e_date = null, $action = null,  $status = null)
    {
        $tbl_files = FILES;
        $tbl_files_log = FILES_LOG;
		$this->db->select("count(distinct(ft_files.file_id)) AS totalfiles");
		$this->db->join($tbl_files_log, "$tbl_files_log.file_id = $tbl_files.file_id");
		
		if($action != '' && $empid != ''){
			if($action == 'marked'){
				$this->db->where($tbl_files_log.".to_emp_id", "$empid");
				$this->db->where("file_hardcopy_status", "not");
			} else if($action == 'worked'){
				$this->db->where($tbl_files_log.".from_emp_id", "$empid");
				//$this->db->where("", "");
			} else if($action == 'received'){
				$this->db->where($tbl_files_log.".to_emp_id", "$empid");
				$this->db->where("file_hardcopy_status", "received");
			} else if($action == 'all'){
				$where = "(to_emp_id = '$empid' OR from_emp_id = '$empid') and (file_hardcopy_status != 'close')";
				$this->db->where($where);
				//$this->db->where("date(`flog_created_date`)", "$date");
			}
		}
		//for dispact reivce and not reicve with date 						
		if($s_date != null && $e_date != null){
			$this->db->where("(date(flog_created_date) <= '$e_date' && date(flog_created_date) >= '$s_date')");
		}
		if($s_date != null && $e_date == null){
			$this->db->where("date(`flog_created_date`)", "$s_date");
		}	
		if(isset($_GET['searchby']) && $_GET['searchby']!=''){
			$searchval=trim($_GET['searchby']);
			$wheres= "(FIND_IN_SET('".$searchval."',file_all_section_no) OR ft_files.file_subject like '%".$searchval."%'  OR ft_files.file_uo_or_letter_no like '%".$searchval."%' OR ft_files.file_uo_or_letter_date = DATE_FORMAT('".$searchval."', '%Y-%m-%d'))";
			$this->db->where($wheres);
		}
		$query = $this->db->get($tbl_files);
		$result = $query->row_array();
		//pre($result);
		//echo  $this->db->last_query();
		return $result;
    }
	
	public function count_getFiles_cr($sec_id = null, $empid = null, $s_date = null, $e_date = null,  $type = null)
    {
        $tbl_files = FILES;
        $tbl_files_log = FILES_LOG;
		$this->db->select("count(distinct(ft_files.file_id)) AS totalfiles");		
		if($type == 'new'){
			$this->db->where("old_registared_no", '0');
		} else if($type == 'old'){
			$this->db->where("old_registared_no !=", '0');
		} else if($type == 'return') {
			$this->db->where("(file_received_emp_id = '$empid' and (file_return = '3' OR file_return = '1'))");
		} else{
			
		}
		if($sec_id != '' ){
			$this->db->where("file_mark_section_id", $sec_id);
		}
		if($empid != ''){
			$this->db->where("createfile_empid", $empid);
		}
		//for dispact reivce and not reicve with date 
					
		if($s_date != null && $e_date != null){
			$this->db->where("(date(file_created_date) >= '$s_date' && date(file_created_date) <= '$e_date')");
		}	
		$this->db->where("file_type !=",'app');
		if(isset($_GET['searchby']) && $_GET['searchby']!=''){
			$searchval=trim($_GET['searchby']);
			$wheres= "(FIND_IN_SET('".$searchval."',ft_files.file_all_section_no) OR ft_files.file_subject like '%".$searchval."%'  OR ft_files.file_uo_or_letter_no like '%".$searchval."%' OR ft_files.file_uo_or_letter_date = DATE_FORMAT('".$searchval."', '%Y-%m-%d'))";
			$this->db->where($wheres);
		}		
		$query = $this->db->get($tbl_files);
		$result = $query->row_array();
		//pre($result);
		//echo  $this->db->last_query();
		return $result;
    }
	public function getFiles_cr($sec_id = null, $empid = null, $s_date = null, $e_date = null,  $type = null,$limit=null,$page=null)
    {
        $tbl_files = FILES;
        $tbl_files_log = FILES_LOG;
		$this->db->select('*');		
		if($type == 'new'){
			$this->db->where("old_registared_no", '0');
		} else if($type == 'old'){
			$this->db->where("old_registared_no !=", '0');
		} else if($type == 'return') {
			$this->db->where("(file_received_emp_id = '$empid' and (file_return = '3' OR file_return = '1'))");
		} else{
			
		}
		if($sec_id != '' ){
			$this->db->where("file_mark_section_id", $sec_id);
		}
		if($empid != ''){
			$this->db->where("createfile_empid", $empid);
		}
		//for dispact reivce and not reicve with date 
					
		if($s_date != null && $e_date != null){
			$this->db->where("(date(file_created_date) >= '$s_date' && date(file_created_date) <= '$e_date')");
		}	
		$this->db->where("file_type !=",'app');
		if(isset($_GET['searchby']) && $_GET['searchby']!=''){
			$searchval=trim($_GET['searchby']);
			$wheres= "(FIND_IN_SET('".$searchval."',ft_files.file_all_section_no) OR ft_files.file_subject like '%".$searchval."%'  OR ft_files.file_uo_or_letter_no like '%".$searchval."%' OR ft_files.file_uo_or_letter_date = DATE_FORMAT('".$searchval."', '%Y-%m-%d'))";
			$this->db->where($wheres);
		}	
		$this->db->limit($limit,$page);
		$this->db->order_by('file_update_date','asc');
		$query = $this->db->get($tbl_files);
		$result = $query->result();
		return $result;
    }
	public function getFiles_cr_01_06($sec_id = null, $empid = null, $s_date = null, $e_date = null,  $type = null)
    {
        $tbl_files = FILES;
        $tbl_files_log = FILES_LOG;
		$this->db->select('*');
		
		if($type == 'new'){
			$this->db->where("old_registared_no", '0');
		} else if($type == 'old'){
			$this->db->where("old_registared_no !=", '0');
		} else if($type == 'return') {
			$this->db->where("(file_received_emp_id = '$empid' and (file_return = '3' OR file_return = '1'))");
		} else{
			
		}
		if($sec_id != '' ){
			$this->db->where("file_mark_section_id", $sec_id);
		}
		if($empid != ''){
			$this->db->where("createfile_empid", $empid);
		}
		//for dispact reivce and not reicve with date 
					
		if($s_date != null && $e_date != null){
			$this->db->where("(date(file_created_date) >= '$s_date' && date(file_created_date) <= '$e_date')");
		}
		
		$this->db->order_by('file_update_date','asc');
		$query = $this->db->get($tbl_files);
		$result = $query->result();
		//pre($result);
		//echo  $this->db->last_query();
		return $result;
		
    }
	
    function get_employee_role_sectionwise($task,$condition){
		if($task=='officer'){
			$sql="select emp.emp_id,emp.role_id,emp.designation_id,
				emp_detail.emp_detail_gender,emp.emp_full_name,emp.emp_full_name_hi,
				emp.emp_section_id from ft_employee as emp 
				INNER JOIN ft_employee_details as emp_detail 
				on emp.emp_id=emp_detail.emp_id where $condition";
		}
		$query9	 = $this->db->query($sql);
		$section_dispose= $query9->result_array();
		//pre($section_dispose);
		return $section_dispose;
	}
	
	function daily_files_cr($empid = null, $s_date = null, $e_date = null){
		$tbl_files = FILES;
        $tbl_emp = EMPLOYEES;
		$this->db->select("$tbl_emp.emp_full_name_hi as emp_name, date(`file_created_date`) as date_created, count(`file_id`) as 'Total_files'");
		$this->db->join($tbl_emp, "$tbl_files.createfile_empid = $tbl_emp.emp_id");
		$this->db->where("date(`file_created_date`) >= '$s_date' and date(`file_created_date`) <= '$e_date'");
		$this->db->where("createfile_empid", $empid);
		$this->db->where("file_type !=",'app');
		$this->db->group_by($tbl_files.'.createfile_empid');
		$this->db->group_by("date(`file_created_date`)");
		$this->db->order_by('date(`file_created_date`)','ASC');
		$query = $this->db->get($tbl_files);
		$result = $query->result();
		//echo  $this->db->last_query();
		return  $result;
	}

	function get_work_done_report($empid, $report_type, $report_year, $report_month ,$report_date, $report_date_end){
		$emps = $sec_whr = null;
		if($this->input->post('emp_section_name') == 'officers'){
			$section = getEmployeeSection($this->input->post('emp_section_name'));
		}else{
			$section = $this->input->post('emp_section_name'); 
		}

		if($empid == 'all'){
			$report_date_end = null;
			$section = $this->input->post('emp_section_name');
			$user_role = $this->session->userdata('user_role');
			$user_query = "select group_concat(emp_id) as emp_ids from ft_".EMPLOYEES." where FIND_IN_SET('$section',`emp_section_id`) AND emp_status ='1' AND emp_is_retired = '0' and  emp_posting_location = 1 and role_id >= $user_role   and role_id not in (1,2,27,28,29,30,33,34,38,36,40,42,43,44) order by emp_full_name_hi ASC";
			$emplist = $this->db->query($user_query);
			$result_user = $emplist->row();
			$emps = $result_user->emp_ids;
		} else{		
			$emps = $empid; 
		}	
	
		
		$select = "SELECT emp.emp_title_hi as user_title,emp.emp_full_name_hi as user_name,fmove_previous_user_id as emp, max(DATE(fmove_created_datetime)) as 'to_date', min(DATE(fmove_created_datetime)) as 'from_date',count(distinct(fmove_file_id)) as 'files_deal'";			
		
		$from = "FROM (SELECT * FROM ft_file_movements UNION SELECT * FROM ft_file_movements_master ) AS m join ft_employee as emp on emp.emp_id = m.fmove_previous_user_id ";
		if($this->input->post('report_section_type') == 'onlysection'){
			$from .=" join (SELECT * FROM  ft_files UNION SELECT * FROM  ft_files_master) AS f on f.file_id = m.fmove_file_id ";
			$sec_whr = " f.file_mark_section_id in($section) and ";
		}
		$where = "WHERE $sec_whr  ((m.fmove_current_user_id in($emps) AND m.fmove_previous_user_id in($emps)) OR m.fmove_previous_user_id in($emps)) AND ";
		
		
		if($report_type == 'year'){
			$where .= "YEAR(fmove_created_datetime) = '$report_year'";
			$groupby = "GROUP BY YEAR(fmove_created_datetime), fmove_previous_user_id";
			$orderby = "ORDER BY YEAR(fmove_created_datetime) ASC, role_id ASC";
		}
		if($report_type == 'month'){
			$where .= "MONTH(fmove_created_datetime) = '$report_month' AND  YEAR(fmove_created_datetime) = '$report_year'";
			$groupby = "GROUP BY MONTH(fmove_created_datetime),  fmove_previous_user_id";
			$orderby = "ORDER BY MONTH(fmove_created_datetime) ASC, role_id ASC";
		}
		if($report_type == 'date'){
			if(!empty($report_date_end)){
				$where .= "DATE(fmove_created_datetime) >= '$report_date' and DATE(fmove_created_datetime) <= '$report_date_end'";
				$groupby = "GROUP BY DATE(fmove_created_datetime), fmove_previous_user_id ";
				$orderby = "ORDER BY DATE(fmove_created_datetime) ASC,role_id ASC";
			} else{
				$where .= "DATE(fmove_created_datetime) = '$report_date'";
				$groupby = "GROUP BY fmove_previous_user_id ";
				$orderby = "ORDER BY role_id ASC";
			}
		}		
		
		$final_query = $select.' '.$from.' '.$where.' '.$groupby.' '.$orderby;
		
		$query = $this->db->query($final_query);
		$result = $query->result();		
		//echo  $this->db->last_query();	exit;
		return  $result;
	}
	
	function get_last_update_date(){
		$tabl = 'ft_work_done_report';
		$this->db->select("date(`work_date`) as 'last_update_date'");	
		$this->db->order_by('date(`work_date`)','DESC');
		$query = $this->db->get($tabl);
		$result = $query->row_array();
		if($query->num_rows() > 0){
			return $result['last_update_date'];
		}else{
			return false;
		}
	}
	
	function get_all_users(){
		$this->db->select('emp_id,role_id');
        $this->db->from(EMPLOYEES);
        $this->db->where_not_in("designation_id", array(1,2,27,28,29,30,34,35,36,40,42,43,44));
		$this->db->where(EMPLOYEES . '.emp_is_retired', 0);
        $this->db->where(EMPLOYEES . '.emp_status', 1);
		$this->db->where(EMPLOYEES . '.emp_is_parmanent', 1);		
		$this->db->where(EMPLOYEES . '.emp_posting_location', 1);
		$this->db->order_by('designation_id','ASC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
	}
}

