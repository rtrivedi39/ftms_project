<?php
class View_file_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
	public function getFiles_old_bfr_pagination_not_use($section_id,$moveup_down,$section_id_search='')
    {
		$sub_type = '';
        if(!empty($moveup_down)) {
            $query = $this->db->query("select group_concat(under_emp_id SEPARATOR ',') as u_empid from ft_employee_hirarchi where emp_id = " . emp_session_id());
            $rr = $query->row_array();
            $rt = explode(',', $rr['u_empid']);
        }
        if(isset($_GET['sn']) && $_GET['sn']=='cr') {
            $cr_empid = get_emp_by_role('9', '1');
            $cr_explod = explode(',', $cr_empid);
        }
		if($this->input->get('sstype') != '') {
			$sub_type = $this->input->get('sstype');
        }
        $tbl_files = FILES;
		$tbl4 = DEPARTMENTS;
        $tbl5 = DISTRICT;
        $this->db->select(FILES .'.*,dept_name_hi,district_name_hi');
		$this->db->join($tbl4, "$tbl4.dept_id = $tbl_files.file_department_id", 'left');
        $this->db->join($tbl5, "$tbl5.district_id = $tbl_files.file_district_id",'left');
         if(!empty($section_id_search)){
			$this->db->where_in('file_mark_section_id', $section_id_search);
		}
		else if(isset($section_id) && $section_id != null) {
            $this->db->where_in('file_mark_section_id', $section_id);
        }
		if($moveup_down == '1'){
            $this->db->where_in('file_sender_emp_id',$rt);
		}else if($moveup_down == 'return'){
            $this->db->where_not_in('file_sender_emp_id',$rt);
            $this->db->where('file_return','1');
       }else if($moveup_down == 'reject'){
            $this->db->where_not_in('file_sender_emp_id',$rt);
            $this->db->where('file_return','3');
        }else if(isset($_GET['sn']) && $_GET['sn']=='cr'){
             $this->db->where_in('file_sender_emp_id',$cr_explod);
            $this->db->where('file_return !=','3');
        }else{
         //   $this->db->where('file_hardcopy_status !=','working');
        }
        $this->db->where('file_received_emp_id',emp_session_id());
        $this->db->where('file_hardcopy_status !=','working');
        $this->db->where('file_hardcopy_status !=','close');
		if($sub_type != ''){
			$this->db->where('section_file_categoty',$sub_type);
		}
		$this->db->order_by('file_update_date','ASC');
		$query = $this->db->get($tbl_files);
      //  echo $this->db->last_query();
		return $query->result();
    }

    public function getFiles($section_id,$moveup_down,$section_id_search='',$limit=null,$page=null)
    {
		$sub_type = '';
        if(!empty($moveup_down)) {
            $query = $this->db->query("select group_concat(under_emp_id SEPARATOR ',') as u_empid from ft_employee_hirarchi where emp_id = " . emp_session_id());
            $rr = $query->row_array();
            $rt = explode(',', $rr['u_empid']);
        }
        if(isset($_GET['sn']) && $_GET['sn']=='cr') {
            $cr_empid = get_emp_by_role('9', '1');
            $cr_explod = explode(',', $cr_empid);
        }
		if($this->input->get('sstype') != '') {
			$sub_type = $this->input->get('sstype');
        }
        $tbl_files = FILES;
		$tbl4 = DEPARTMENTS;
        $tbl5 = DISTRICT;
        $this->db->select(FILES .'.*,dept_name_hi,district_name_hi');
		$this->db->join($tbl4, "$tbl4.dept_id = $tbl_files.file_department_id", 'left');
        $this->db->join($tbl5, "$tbl5.district_id = $tbl_files.file_district_id",'left');
         if(!empty($section_id_search)){
			$this->db->where_in('file_mark_section_id', $section_id_search);
		}
		else if(isset($section_id) && $section_id != null) {
            $this->db->where_in('file_mark_section_id', $section_id);
        }
		if($moveup_down == '1'){
            $this->db->where_in('file_sender_emp_id',$rt);
		}else if($moveup_down == 'return'){
            $this->db->where_not_in('file_sender_emp_id',$rt);
            $this->db->where('file_return','1');
       }else if($moveup_down == 'reject'){
            $this->db->where_not_in('file_sender_emp_id',$rt);
            $this->db->where('file_return','3');
        }else if(isset($_GET['sn']) && $_GET['sn']=='cr'){
             $this->db->where_in('file_sender_emp_id',$cr_explod);
            $this->db->where('file_return !=','3');
        }else{
         //   $this->db->where('file_hardcopy_status !=','working');
        }
        $this->db->where('file_received_emp_id',emp_session_id());
        $this->db->where('file_hardcopy_status !=','working');
        $this->db->where('file_hardcopy_status !=','close');
		if($sub_type != ''){
			$this->db->where('section_file_categoty',$sub_type);
		}
		if(isset($_GET['searchby']) && $_GET['searchby']!=''){
			$searchval=trim($_GET['searchby']);
			$wheres= "(FIND_IN_SET('".$searchval."',ft_files.file_all_section_no) OR ft_files.file_subject like '%".$searchval."%'  OR ft_files.file_uo_or_letter_no like '%".$searchval."%' OR ft_files.file_uo_or_letter_date = DATE_FORMAT('".$searchval."', '%Y-%m-%d'))";
			$this->db->where($wheres);
		}
		$this->db->order_by("$tbl_files.file_update_date", 'asc');
		$this->db->limit($limit,$page);	
		$query = $this->db->get($tbl_files);
      //  echo $this->db->last_query();
		return $query->result();
    }
	public function count_getFiles($section_id,$moveup_down,$section_id_search='',$limit=null,$page=null)
    {
		$sub_type = '';
        if(!empty($moveup_down)) {
            $query = $this->db->query("select group_concat(under_emp_id SEPARATOR ',') as u_empid from ft_employee_hirarchi where emp_id = " . emp_session_id());
            $rr = $query->row_array();
            $rt = explode(',', $rr['u_empid']);
        }
        if(isset($_GET['sn']) && $_GET['sn']=='cr') {
            $cr_empid = get_emp_by_role('9', '1');
            $cr_explod = explode(',', $cr_empid);
        }
		if($this->input->get('sstype') != '') {
			$sub_type = $this->input->get('sstype');
        }
        $tbl_files = FILES;
		$tbl4 = DEPARTMENTS;
        $tbl5 = DISTRICT;
        $this->db->select("COUNT(DISTINCT(file_id)) as totalfiles");
		$this->db->join($tbl4, "$tbl4.dept_id = $tbl_files.file_department_id", 'left');
        $this->db->join($tbl5, "$tbl5.district_id = $tbl_files.file_district_id",'left');
         if(!empty($section_id_search)){
			$this->db->where_in('file_mark_section_id', $section_id_search);
		}
		else if(isset($section_id) && $section_id != null) {
            $this->db->where_in('file_mark_section_id', $section_id);
        }
		if($moveup_down == '1'){
            $this->db->where_in('file_sender_emp_id',$rt);
		}else if($moveup_down == 'return'){
            $this->db->where_not_in('file_sender_emp_id',$rt);
            $this->db->where('file_return','1');
       }else if($moveup_down == 'reject'){
            $this->db->where_not_in('file_sender_emp_id',$rt);
            $this->db->where('file_return','3');
        }else if(isset($_GET['sn']) && $_GET['sn']=='cr'){
             $this->db->where_in('file_sender_emp_id',$cr_explod);
            $this->db->where('file_return !=','3');
        }else{
         //   $this->db->where('file_hardcopy_status !=','working');
        }
        $this->db->where('file_received_emp_id',emp_session_id());
        $this->db->where('file_hardcopy_status !=','working');
        $this->db->where('file_hardcopy_status !=','close');
		if($sub_type != ''){
			$this->db->where('section_file_categoty',$sub_type);
		}	
		if(isset($_GET['searchby']) && $_GET['searchby']!=''){
			$searchval=trim($_GET['searchby']);
			$wheres= "(FIND_IN_SET('".$searchval."',ft_files.file_all_section_no) OR ft_files.file_subject like '%".$searchval."%'  OR ft_files.file_uo_or_letter_no like '%".$searchval."%' OR ft_files.file_uo_or_letter_date = DATE_FORMAT('".$searchval."', '%Y-%m-%d'))";
			$this->db->where($wheres);
		}
		$query = $this->db->get($tbl_files);
      //  echo $this->db->last_query();
		return $query->row_array();
    }

	function getFiledata_inlist_desc_count($file_id = null , $section_id = null , $category = null) {
		$CI = & get_instance();
		$emp_session_id = emp_session_id();
		if($section_id == 'oth'){$section =  empdetails($emp_session_id);
		$rt = explode(',',$section[0]['emp_section_id']);
		}
		$tbl1 = FILES;
		$tbl4 = DEPARTMENTS;
		$tbl5 = DISTRICT;		
		$CI->db->select("COUNT(DISTINCT(file_id)) as totalfiles");
		$CI->db->from($tbl1);		
		if($file_id != null && isset($file_id)){
		$CI->db->where("$tbl1.file_id", $file_id); }
		if($section_id != null && isset($section_id)){
			if($section_id == 'oth'){
			$CI->db->where_not_in("$tbl1.file_mark_section_id", $rt);
			}else {
			//$CI->db->where("$tbl1.file_mark_section_id", $section_id);
				if($section_id==1){
					$CI->db->where("$tbl1.file_mark_section_id",0);
				}else{
				   $CI->db->where("$tbl1.file_mark_section_id", $section_id);
				}
			} 
		}
		$CI->db->where("$tbl1.file_received_emp_id", $emp_session_id);		
		$CI->db->where("$tbl1.file_hardcopy_status !=", 'close');
		if($category != ''){
		$CI->db->where("$tbl1.section_file_categoty", $category); 
		}
		if(isset($_GET['searchby']) && $_GET['searchby']!=''){
			$searchval=trim($_GET['searchby']);
			$sql_emp="SELECT emp_id,emp_full_name FROM ft_employee WHERE MATCH(emp_full_name_hi) AGAINST('".$searchval."')";
			$emp_row_details=get_row($sql_emp);
			if(isset($emp_row_details['emp_id']) && $emp_row_details['emp_id']!=''){				
				$searchval = $emp_row_details['emp_id'];
				$CI->db->where('ft_files.file_sender_emp_id',$searchval);
			}else{
				$wheres= "(FIND_IN_SET('".$searchval."',ft_files.file_all_section_no) OR ft_files.file_subject like '%".$searchval."%'  OR ft_files.file_uo_or_letter_no like '%".$searchval."%' OR ft_files.file_uo_or_letter_date = DATE_FORMAT('".$searchval."', '%Y-%m-%d'))";
				$CI->db->where($wheres);
			}
		}		
		$query = $CI->db->get();
        return $query->row_array();
	
	}
	public function getFiledata_inlist_desc($file_id = null , $section_id = null , $category = null,$limit, $page) {
		$CI = & get_instance();
		$emp_session_id = emp_session_id();
		if($section_id == 'oth'){$section =  empdetails($emp_session_id);
			$rt = explode(',',$section[0]['emp_section_id']);
		}
		$tbl1 = FILES;
		$tbl4 = DEPARTMENTS;
		$tbl5 = DISTRICT;	
		$CI->db->select(FILES .'.*,dept_name_hi,district_name_hi');
		$CI->db->from($tbl1);
		$CI->db->join($tbl4, "$tbl4.dept_id = $tbl1.file_department_id", 'left');
		$CI->db->join($tbl5, "$tbl5.district_id = $tbl1.file_district_id",'left');	
		if($file_id != null && isset($file_id)){ $CI->db->where("$tbl1.file_id", $file_id); }
		if($section_id != null && isset($section_id)){
			if($section_id == 'oth'){
			$CI->db->where_not_in("$tbl1.file_mark_section_id", $rt);
			}else {	
				if($section_id==1){
					$CI->db->where("$tbl1.file_mark_section_id",0);
				}else{
					$CI->db->where("$tbl1.file_mark_section_id", $section_id);
				}
			} 
		}
		$CI->db->where("$tbl1.file_received_emp_id", $emp_session_id);	
		$CI->db->where("$tbl1.file_hardcopy_status !=", 'close');
		if($category != ''){ $CI->db->where("$tbl1.section_file_categoty", $category); }	
		if(isset($_GET['searchby']) && $_GET['searchby']!=''){
			$searchval=trim($_GET['searchby']);
			$sql_emp="SELECT emp_id,emp_full_name FROM ft_employee WHERE MATCH(emp_full_name_hi) AGAINST('".$searchval."')";
			$emp_row_details=get_row($sql_emp);
			if(isset($emp_row_details['emp_id']) && $emp_row_details['emp_id']!=''){				
				$searchval = $emp_row_details['emp_id'];
				$CI->db->where('ft_files.file_sender_emp_id',$searchval);
			}else{
				$wheres= "(FIND_IN_SET('".$searchval."',ft_files.file_all_section_no) OR ft_files.file_subject like '%".$searchval."%'  OR ft_files.file_uo_or_letter_no like '%".$searchval."%' OR ft_files.file_uo_or_letter_date = DATE_FORMAT('".$searchval."', '%Y-%m-%d'))";
				$CI->db->where($wheres);
			}
		}
		$CI->db->order_by("$tbl1.file_update_date", 'asc');
		$CI->db->limit($limit,$page);		
		$query = $CI->db->get();	
		return $query->result();
	}
	// RP
    public function getFiles_bycr_old($user_id)
    {
        $tbl_files = FILES;
        $tbl4 = DEPARTMENTS;
        $tbl5 = DISTRICT;
        $this->db->select(FILES .'.*,dept_name_hi,district_name_hi');
        $this->db->from($tbl_files);
        $this->db->join($tbl4, "$tbl4.dept_id = $tbl_files.file_department_id", 'left');
        $this->db->join($tbl5, "$tbl5.district_id = $tbl_files.file_district_id",'left');
        $rtt = 'file_received_emp_id in (SELECT emp_id FROM ft_employee WHERE role_id=9)';
        $this->db->where($rtt);
        $this->db->where("$tbl_files.file_hardcopy_status !=",'close');
        $this->db->where("$tbl_files.file_return != ",'2');
        $this->db->order_by("$tbl_files.file_id",'desc');
        $query = $this->db->get();
        //   echo $this->db->last_query();
        return $query->result();
    }
	
	public function count_getFiles_bycr($user_id, $year = '', $month = '', $section = '', $user = '')
    {
        $tbl_files = FILES;        
        $this->db->select("COUNT(DISTINCT(file_id)) as totalfiles");
        $this->db->from($tbl_files);        
        $rtt = 'file_received_emp_id in (SELECT emp_id FROM ft_employee WHERE role_id=9)';
        $this->db->where($rtt);
		if($year !='' && $month!=''){
			$frmdate=$year; $tilldate = $month;
			$where_date="(DATE_FORMAT(`file_mark_section_date`, '%d-%m-%Y') >= '".$frmdate."' and DATE_FORMAT(file_mark_section_date, '%d-%m-%Y') <= '".$tilldate."' )";
			$this->db->where($where_date);
		}

		/*if($year != ''){
			$this->db->where("DATE_FORMAT(`file_created_date`)",$year);
		}
		if($month != ''){
			$this->db->where("DATE_FORMAT(`file_created_date`)",$month);
		}*/
		if($section != ''){
			$this->db->where("file_mark_section_id",$section);
		}
		if($user != ''){
			/*$this->db->where("createfile_empid",$user);
			if($this->session->userdata('emp_id')==$user){
				$this->db->or_where("file_received_emp_id",$user);
			}*/
			$wheres= "(file_received_emp_id= '".$user."' OR file_received_emp_id= '".$user."')";
			$this->db->where($wheres);
		}
        $this->db->where("$tbl_files.file_hardcopy_status !=",'close');
        $this->db->where("$tbl_files.file_return != ",'2');
        
        $query = $this->db->get();        
        return $query->row_array();
    }
	
	public function getFiles_bycr($user_id, $year = '', $month = '', $section = '', $user = '',$limit=null,$page=null)
    {
        $tbl_files = FILES;
        $tbl4 = DEPARTMENTS;
        $tbl5 = DISTRICT;
        $this->db->select(FILES .'.*,dept_name_hi,district_name_hi');
        $this->db->from($tbl_files);
        $this->db->join($tbl4, "$tbl4.dept_id = $tbl_files.file_department_id", 'left');
        $this->db->join($tbl5, "$tbl5.district_id = $tbl_files.file_district_id",'left');
        $rtt = 'file_received_emp_id in (SELECT emp_id FROM ft_employee WHERE role_id=9)';
		/*if($year != ''){
			$this->db->where("YEAR(file_created_date)",$year);
		}
		if($month != ''){
			$this->db->where("MONTH(file_created_date)",$month);
		}*/
		if($year !='' && $month!=''){
			$frmdate=$year; $tilldate = $month;
			$where_date="(DATE_FORMAT(`file_mark_section_date`, '%d-%m-%Y') >= '".$frmdate."' and DATE_FORMAT(file_mark_section_date, '%d-%m-%Y') <= '".$tilldate."' )";
			$this->db->where($where_date);
		}
		if($section != ''){
			$this->db->where("file_mark_section_id",$section);
		}
		if($user != ''){
			/*$this->db->where("createfile_empid",$user);
			if($this->session->userdata('emp_id')==$user){
				$this->db->or_where("file_received_emp_id",$user);
			}*/
			$wheres= "(file_received_emp_id= '".$user."' OR file_received_emp_id= '".$user."')";
			$this->db->where($wheres);
		}
        $this->db->where($rtt);
        $this->db->where("$tbl_files.file_hardcopy_status !=",'close');
        $this->db->where("$tbl_files.file_return != ",'2');
		if(isset($_GET['searchby']) && $_GET['searchby']!=''){
			//$cr_empid = get_emp_by_role('9', '1');
			//pr($cr_empid);
			$searchval=trim($_GET['searchby']);
			$wheres= "(FIND_IN_SET('".$searchval."',ft_files.file_all_section_no) OR ft_files.file_id = '".$searchval."' OR ft_files.file_subject like '%".$searchval."%'  OR ft_files.file_uo_or_letter_no like '%".$searchval."%' OR ft_files.file_uo_or_letter_date = DATE_FORMAT('".$searchval."', '%Y-%m-%d'))";
			$this->db->where($wheres);
		}	
        $this->db->order_by("$tbl_files.file_update_date", 'desc');
		$this->db->limit($limit,$page);	
        $query = $this->db->get();
        //   echo $this->db->last_query();
        $result_rs= $query->result();
		//pr($result_rs);
		return $result_rs;
    }
    // RP
    /* public function allfile_bycr($user_id)
    {
        $tbl_files = FILES;
        $this->db->select('*');
     //   $this->db->where('createfile_empid',$user_id);
        $this->db->where('file_hardcopy_status !=','close');
        $this->db->order_by('file_id','desc');
        $query = $this->db->get($tbl_files);
        $this->db->last_query();
        return $query->result();
    } */
	public function allfile_bycr_count($user_id, $year = '', $month = '', $section = '', $user = '')
    {
        $tbl_files = FILES;        
        $this->db->select("COUNT(DISTINCT(file_id)) as totalfiles");
        $this->db->from($tbl_files);
        
        //$this->db->where('createfile_empid',$user_id);
		/*if($year != ''){
			$this->db->where("YEAR(file_created_date)",$year);
		}
		if($month != ''){
			$this->db->where("MONTH(file_created_date)",$month);
		}*/
		$year;$month;
		if($year !='' && $month!=''){
			$frmdate=$year; $tilldate = $month;
			$where_date="(DATE_FORMAT(file_created_date, '%d-%m-%Y') >= '".$frmdate."' and DATE_FORMAT(file_created_date, '%d-%m-%Y') <= '".$tilldate."' )";
			$this->db->where($where_date);
		}
		if($section != ''){
			$this->db->where("file_mark_section_id",$section);
		}
		if($user != ''){
			$wher_usr= "createfile_empid =".$user." and file_received_emp_id !=".$user;
			$this->db->where($wher_usr);
			
			/*if($this->session->userdata('emp_id')==$user){
				$this->db->or_where("file_received_emp_id",$user);
			}*/
		}
        $this->db->where('createfile_empid !=','35');
        $this->db->where("$tbl_files.file_hardcopy_status !=",'close');
		$this->db->where("$tbl_files.file_return !=",'2');
		/*if(isset($_GET['searchby']) && $_GET['searchby']!=''){
			$searchval=trim($_GET['searchby']);
			$wheres= "(FIND_IN_SET('".$searchval."',ft_files.file_all_section_no) OR ft_files.file_id = '".$searchval."' OR ft_files.file_subject like '%".$searchval."%'  OR ft_files.file_uo_or_letter_no like '%".$searchval."%' OR ft_files.file_uo_or_letter_date = DATE_FORMAT('".$searchval."', '%Y-%m-%d'))";
			$this->db->where($wheres);
		}*/	        
        $query = $this->db->get();
       //echo $this->db->last_query();
		return $query->row_array();
    }
	
	public function allfile_bycr($user_id, $year = '', $month = '', $section = '', $user = '',$limit, $page)
    {
        $tbl_files = FILES;
        $tbl4 = DEPARTMENTS;
        $tbl5 = DISTRICT;
        $this->db->select(FILES .'.*,dept_name_hi,district_name_hi');
        $this->db->from($tbl_files);
        $this->db->join($tbl4, "$tbl4.dept_id = $tbl_files.file_department_id", 'left');
        $this->db->join($tbl5, "$tbl5.district_id = $tbl_files.file_district_id",'left');
        //$this->db->where('createfile_empid',$user_id);
		/*if($year != ''){
			$this->db->where("YEAR(file_created_date)",$year);
		}
		if($month != ''){
			$this->db->where("MONTH(file_created_date)",$month);
		}*/
		$year;$month;
		if($year !='' && $month!=''){
			$frmdate=$year; $tilldate = $month;
			$where_date="(DATE_FORMAT(file_created_date, '%d-%m-%Y') >= '".$frmdate."' and DATE_FORMAT(file_created_date, '%d-%m-%Y') <= '".$tilldate."' )";
			$this->db->where($where_date);
		}
		if($section != ''){
			$this->db->where("file_mark_section_id",$section);
		}
		if($user != ''){
			//$this->db->where("createfile_empid",$user);
			$wher_usr= "createfile_empid =".$user." and file_received_emp_id !=".$user;
			$this->db->where($wher_usr);			
			/*if($this->session->userdata('emp_id')==$user){
				$this->db->or_where("file_received_emp_id",$user);
			}*/
		}
        $this->db->where('createfile_empid !=','35');
        $this->db->where("$tbl_files.file_hardcopy_status !=",'close');
		$this->db->where("$tbl_files.file_return !=",'2');
		if(isset($_GET['searchby']) && $_GET['searchby']!=''){
			$searchval=trim($_GET['searchby']);
			$wheres= "(FIND_IN_SET('".$searchval."',ft_files.file_all_section_no) OR ft_files.file_id = '".$searchval."' OR ft_files.file_subject like '%".$searchval."%'  OR ft_files.file_uo_or_letter_no like '%".$searchval."%' OR ft_files.file_uo_or_letter_date = DATE_FORMAT('".$searchval."', '%Y-%m-%d'))";
			$this->db->where($wheres);
		}	
		//$this->db->order_by("$tbl_files.file_update_date", 'asc');
        $this->db->order_by("$tbl_files.file_id",'desc');
		$this->db->limit($limit,$page);	
        $query = $this->db->get();
       //echo $this->db->last_query();
        return $query->result();
    }
	
	public function allfile_bycr_tetmp($user_id1,$user2)
    {	
        $tbl_files = FILES;
        $tbl4 = DEPARTMENTS;
        $tbl5 = DISTRICT;
        $this->db->select(FILES .'.*,dept_name_hi,district_name_hi');
        $this->db->from($tbl_files);
        $this->db->join($tbl4, "$tbl4.dept_id = $tbl_files.file_department_id", 'left');
        $this->db->join($tbl5, "$tbl5.district_id = $tbl_files.file_district_id",'left');
      //  $this->db->where('createfile_empid',$user_id);
		$this->db->where("$tbl_files.file_hardcopy_status !=",'close');
        $this->db->where_in("$tbl_files.createfile_empid",array(210,211)); 
        $this->db->order_by("$tbl_files.file_id",'desc');
        $query = $this->db->get();
       //echo $this->db->last_query();
        return $query->result();
    }

    //for dealing assistant name RP
    public function get_DAname_old($section_id,$subuser=null )
    {	
		if(emp_session_id() == 63){
			$query =   $this->db->query("select group_concat(under_emp_id SEPARATOR ',') as u_empid from ft_employee_hirarchi where emp_id = 23");
		}else{
			//$query =   $this->db->query("select group_concat(under_emp_id SEPARATOR ',') as u_empid from ft_employee_hirarchi where emp_id = ".emp_session_id());
			if($subuser!=''){
				$query =   $this->db->query("select group_concat(under_emp_id SEPARATOR ',') as u_empid from ft_employee_hirarchi where emp_id = ".$subuser);
			}else{
				$query =   $this->db->query("select group_concat(under_emp_id SEPARATOR ',') as u_empid from ft_employee_hirarchi where emp_id = ".emp_session_id());
			}
		}
        $rr =  $query->row_array();
        $rt =  explode(',',$rr['u_empid']);
        $tbl_files = EMPLOYEES;
        $this->db->select('*');
        $this->db->where_in('emp_id',$rt);
        $query = $this->db->get($tbl_files);
        // echo   $this->db->last_query();
        return $query->result_array();
    }
	
	//for dealing assistant name Bij 17 12 2015 new
	public function get_DAname($section_id,$subuser=null )
    {	
		if(emp_session_id() == 63){
			$query =   $this->db->query("select group_concat(under_emp_id SEPARATOR ',') as u_empid from ft_employee_hirarchi where emp_id = 23");
		}else{
			//$query =   $this->db->query("select group_concat(under_emp_id SEPARATOR ',') as u_empid from ft_employee_hirarchi where emp_id = ".emp_session_id());
			if($subuser!=''){
				$user_level = get_emp_role_levele();				
				$so_incharg_id = get_so_incharge_of_da($subuser,$section_id);				
				if($user_level['emprole_level']==13){
					$query =   $this->db->query("select group_concat(under_emp_id SEPARATOR ',') as u_empid from ft_employee_hirarchi where emp_id = ".$so_incharg_id);
				}else{
					$query =   $this->db->query("select group_concat(under_emp_id SEPARATOR ',') as u_empid from ft_employee_hirarchi where emp_id = ".$subuser);
				}
			}else{
				$query =   $this->db->query("select group_concat(under_emp_id SEPARATOR ',') as u_empid from ft_employee_hirarchi where emp_id = ".emp_session_id());
			}
		}
        $rr =  $query->row_array();
        $rt =  explode(',',$rr['u_empid']);
        $tbl_files = EMPLOYEES;
        $this->db->select('*');
		$this->db->join('ft_employee_details', $tbl_files.'.emp_id = ft_employee_details.emp_id');
		$this->db->join('ft_emprole_master', $tbl_files.'.designation_id = ft_emprole_master.role_id');
		$this->db->where_in($tbl_files.'.emp_id',$rt);
		$this->db->where_not_in($tbl_files.'.designation_id',28,29,30,34,36,38);
		$this->db->where('emp_status', 1);
		$this->db->where('emp_is_retired', 0);
        $query = $this->db->get($tbl_files);
        // echo   $this->db->last_query();
        return $query->result_array();
    }

    public function getFileDetails($file_id)
    {
        $tbl1 = FILES;
        $tbl2 = SECTIONS;
        $tbl3 = EMPLOYEES;
        $tbl4 = DEPARTMENTS;
        $tbl5 = DISTRICT;
        $tbl6 = REMARK_MASTER;
        $tbl7 = STATE_MASTER;
        $tbl8 = FILES_OTHER_FEILDS;
        $this->db->select(FILES.'.*,section_name_hi,section_name_en,emp_id,emp_full_name,emp_full_name_hi,dept_name_hi,dept_name_en,district_name_hi,district_name_en,remark_title_hi,state_name_en,state_name_hi,state_id,file_upload,case_no,rti_application_fee,hearing_date_rti,pay_serial_no_rti,applicant_name,rti_applicant_contactno,old_registared_no');
        $this->db->from($tbl1);
        $this->db->join($tbl2, "$tbl2.section_id = $tbl1.file_mark_section_id",'left');
        $this->db->join($tbl3, "$tbl3.emp_id = $tbl1.file_received_emp_id",'left');
        $this->db->join($tbl4, "$tbl4.dept_id = $tbl1.file_department_id",'left');
        $this->db->join($tbl5, "$tbl5.district_id = $tbl1.file_district_id",'left');
        $this->db->join($tbl6, "$tbl6.remark_id = $tbl1.file_progress_status_id",'left');
        $this->db->join($tbl7, "$tbl7.state_id = $tbl1.file_state_id",'left');
        $this->db->join($tbl8, "$tbl8.f_file_id = $tbl1.file_id",'left');
        $this->db->where("$tbl1.file_id", $file_id);
        $query = $this->db->get();
        $this->db->last_query();
        if($query->num_rows() != 0)
        {
            return $query->result_array();
        }
        else{
            $tbl1 = FILES_MASTER;
            $tbl2 = SECTIONS;
            $tbl3 = EMPLOYEES;
            $tbl4 = DEPARTMENTS;
            $tbl5 = DISTRICT;
            $tbl6 = REMARK_MASTER;
            $tbl7 = STATE_MASTER;
            $tbl8 = FILES_OTHER_FEILDS;
            $this->db->select(FILES_MASTER.'.*,section_name_hi,section_name_en,emp_id,emp_full_name,emp_full_name_hi,dept_name_hi,dept_name_en,district_name_hi,district_name_en,remark_title_hi,state_name_en,state_name_hi,state_id,file_upload,case_no,rti_application_fee,hearing_date_rti,pay_serial_no_rti,applicant_name,rti_applicant_contactno,old_registared_no');
            $this->db->from($tbl1);
            $this->db->join($tbl2, "$tbl2.section_id = $tbl1.file_mark_section_id",'left');
            $this->db->join($tbl3, "$tbl3.emp_id = $tbl1.file_received_emp_id",'left');
            $this->db->join($tbl4, "$tbl4.dept_id = $tbl1.file_department_id",'left');
            $this->db->join($tbl5, "$tbl5.district_id = $tbl1.file_district_id",'left');
            $this->db->join($tbl6, "$tbl6.remark_id = $tbl1.file_progress_status_id",'left');
            $this->db->join($tbl7, "$tbl7.state_id = $tbl1.file_state_id",'left');
            $this->db->join($tbl8, "$tbl8.f_file_id = $tbl1.file_id",'left');
            $this->db->where("$tbl1.file_id", $file_id);
            $query = $this->db->get();
            $this->db->last_query();
            if($query->num_rows() != 0)
            {
                return $query->result_array();
            }
            else{
                return FALSE;
            }
        }
    }
    //file log
    public function getFiles_log($file_id = null)
    {
        $this->db->where('file_id',$file_id);
        $this->db->order_by('flog_id','DESC');
        $this->db->from(FILES_LOG);
        $query = $this->db->get();
        $data = $query->result_array();
        if($query->num_rows() != 0)
        {
            return $data;
        }
        else{
            $this->db->where('file_id',$file_id);
            $this->db->order_by('flog_id','DESC');
            $this->db->from(FILES_LOG_MASTER);
            $query = $this->db->get();
            $data = $query->result_array();
            return $data;
        }
    }

    //file Movement
    public function getFiles_movement($file_id = null)
    {
        $this->db->where('fmove_file_id',$file_id);
        $this->db->order_by('fmove_id','DESC');
        $this->db->from(FILES_MOVEMENT);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    //only use for dispatch section
    public function dispatch_getFiles($where_show = null)
    {
		$emp_session_id = emp_session_id();
        $query =   $this->db->query("select group_concat(under_emp_id SEPARATOR ',') as u_empid from ft_employee_hirarchi where emp_id = ".emp_session_id());
        $rr =  $query->row_array();
        $rt =  explode(',',$rr['u_empid']);
		$tbl_files_file = FILES;
        $tbl4 = DEPARTMENTS;
        $tbl5 = DISTRICT;
        $this->db->select("$tbl_files_file.*,dept_name_hi,district_name_hi");
        $this->db->join($tbl4, "$tbl4.dept_id = $tbl_files_file.file_department_id", 'left');
        $this->db->join($tbl5, "$tbl5.district_id = $tbl_files_file.file_district_id",'left');
        //$this->db->where_in('file_mark_section_id','8');
        $this->db->where_in('file_received_emp_id',$emp_session_id);
        if($where_show == '1'){
            $this->db->where_in('file_sender_emp_id',$rt);}
        else {
            $this->db->where_not_in('file_sender_emp_id',$rt);
        }
        $this->db->where($tbl_files_file.'.file_hardcopy_status !=','close');
		if($this->input->get('section_id') != ''){
			$this->db->where($tbl_files_file.'.file_mark_section_id',$this->input->get('section_id'));
		}
		//echo $tbl_files_file;
        $this->db->order_by($tbl_files_file.'.file_id','desc');
        $query = $this->db->get($tbl_files_file);
        // echo  $this->db->last_query();
        return $query->result();
    }
	
	//this is use for only printing purpose as per 07-11 Susmita maams said
	public function dispatch_getFiles_for_print($where_show = null)
    {
        $tbl_files = FILES;
        $tbl4 = DEPARTMENTS;
        $tbl5 = DISTRICT;
        $tbl6 = FILES_DISPATCH;
        $this->db->select(FILES .'.*,dept_name_hi,district_name_hi,district_name_hi,district_name_en,dispatch_date');
        $this->db->join($tbl4, "$tbl4.dept_id = $tbl_files.file_department_id",'left');
        $this->db->join($tbl5, "$tbl5.district_id = $tbl_files.file_district_id",'left');
        $this->db->join($tbl6, "$tbl6.file_id = $tbl_files.file_id");
        $this->db->where($tbl_files.'.file_mark_section_id','14');
        $this->db->order_by($tbl_files.'.file_id','desc');
        $query = $this->db->get($tbl_files);
        // echo  $this->db->last_query();
        return $query->result();
    }
	
	
	/*18-09-2015 Get Sub user Files */
	public function getFiles_count_2($section_id,$moveup_down)
    {
		$allotempid = emp_session_id(); 
	    $tbl_files = FILES;
        $this->db->select('*');
		if($moveup_down == '1'){
            $this->db->where_in('file_sender_emp_id',$rt);}
        else if($moveup_down == 'return'){
            $this->db->where_not_in('file_sender_emp_id',$rt);
            $this->db->where('file_return','1');
        }
		//echo emp_session_id();
		$this->db->where('file_received_emp_id',$allotempid);
		if(isset($_GET['section_id']) && $_GET['section_id']!=''){
			$this->db->where('file_mark_section_id',$section_id[0]);
		}
        $this->db->where('file_hardcopy_status !=','close');
		$this->db->order_by('file_id','desc');
		$query = $this->db->get($tbl_files);
		$reuslt = $query->result();			
		return $reuslt;
    }
	public function getFiles_2($section_id,$moveup_down)
    {
		$allotempid = emp_session_id(); 
	    $tbl_files = FILES;
        $this->db->select('*');
		if($moveup_down == '1'){
            $this->db->where_in('file_sender_emp_id',$rt);}
        else if($moveup_down == 'return'){
            $this->db->where_not_in('file_sender_emp_id',$rt);
            $this->db->where('file_return','1');
        }
		//echo emp_session_id();
		$this->db->where('file_received_emp_id',$allotempid);
		if(isset($_GET['section_id']) && $_GET['section_id']!=''){
			$this->db->where('file_mark_section_id',$section_id[0]);
		}
		/* update code 18 Oct 2016*/
		if(isset($_GET['searchby']) && $_GET['searchby']!=''){
			$searchval=trim($_GET['searchby']);
			$wheres= "(FIND_IN_SET('".$searchval."',ft_files.file_all_section_no) OR ft_files.file_subject like '%".$searchval."%'  OR ft_files.file_uo_or_letter_no like '%".$searchval."%' OR ft_files.file_uo_or_letter_date = DATE_FORMAT('".$searchval."', '%Y-%m-%d'))";
			$this->db->where($wheres);
		}		
		/*update code  18 Oct 2016*/
        $this->db->where('file_hardcopy_status !=','close');
		$this->db->order_by('file_id','desc');
		$query = $this->db->get($tbl_files);
		$reuslt = $query->result();			
		return $reuslt;
    }
	
	public function getFiles_2_testing($section_id,$moveup_down)
    {
	    $tbl_files = FILES;
        $this->db->select('*');
		$empssection = empdetails(emp_session_id());
		$rcempid=$empssection[0]['emp_id'];
		$this->db->where('file_received_emp_id',$rcempid);
        $this->db->where('file_hardcopy_status !=','close');
		$this->db->order_by('file_id','desc');
		$query = $this->db->get($tbl_files);
		if($_GET['test']=='ab'){
			echo $this->db->last_query();
		}
		return $query->result();
    }
	/*18-09-2015 Get Sub user Files */
	
	/* Searching file in cr section for printing created - Rohit*/
	function count_files_search_cr($section_id = '', $search_date = ''){	
		$tbl_files = FILES;
        $tbl4 = DEPARTMENTS;
        $tbl5 = DISTRICT;
        $this->db->select("COUNT(DISTINCT(file_id)) as totalfiles");
        $this->db->from($tbl_files);        
        $this->db->where('file_mark_section_id',$section_id);
        $this->db->where("DATE_FORMAT(`file_mark_section_date`, '%d-%m-%Y') = ",$search_date);
        $this->db->where("$tbl_files.file_unit_level",'50');
        $this->db->where("$tbl_files.file_return",'0');
        $this->db->where("$tbl_files.file_hardcopy_status",'not');
		/*if(isset($_GET['searchby']) && $_GET['searchby']!=''){
			$searchval=trim($_GET['searchby']);
			$wheres= "(FIND_IN_SET('".$searchval."',ft_files.file_all_section_no) OR ft_files.file_id = '".$searchval."' OR ft_files.file_subject like '%".$searchval."%'  OR ft_files.file_uo_or_letter_no like '%".$searchval."%' OR ft_files.file_uo_or_letter_date = DATE_FORMAT('".$searchval."', '%Y-%m-%d'))";
			$this->db->where($wheres);
		}*/
        $this->db->order_by("$tbl_files.file_id",'desc');
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->row_array();
        
	}
	function files_search_cr($section_id = '', $search_date = '',$limit, $page){		
		$tbl_files = FILES;
        $tbl4 = DEPARTMENTS;
        $tbl5 = DISTRICT;
        $this->db->select(FILES .'.*,dept_name_hi,district_name_hi');
        $this->db->from($tbl_files);
        $this->db->join($tbl4, "$tbl4.dept_id = $tbl_files.file_department_id", 'left');
        $this->db->join($tbl5, "$tbl5.district_id = $tbl_files.file_district_id",'left');
        $this->db->where('file_mark_section_id',$section_id);
        $this->db->where("DATE_FORMAT(`file_mark_section_date`, '%d-%m-%Y') = ",$search_date);
        $this->db->where("$tbl_files.file_unit_level",'50');
        $this->db->where("$tbl_files.file_return",'0');
        $this->db->where("$tbl_files.file_hardcopy_status",'not');
		if(isset($_GET['searchby']) && $_GET['searchby']!=''){
			$searchval=trim($_GET['searchby']);
			$wheres= "(FIND_IN_SET('".$searchval."',ft_files.file_all_section_no) OR ft_files.file_id = '".$searchval."' OR ft_files.file_subject like '%".$searchval."%'  OR ft_files.file_uo_or_letter_no like '%".$searchval."%' OR ft_files.file_uo_or_letter_date = DATE_FORMAT('".$searchval."', '%Y-%m-%d'))";
			$this->db->where($wheres);
		}
		$this->db->order_by("$tbl_files.file_update_date", 'asc');
		$this->db->limit($limit,$page);	
        //$this->db->order_by("$tbl_files.file_id",'desc');
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result();
        
	}
	
	public function send_getFiles()
    {
        $session1 = emp_session_id();
        $tbl_files = FILES;
        $tbl4 = DEPARTMENTS;
        $tbl5 = DISTRICT;
        $this->db->select(FILES .'.*,dept_name_hi,district_name_hi');
        $this->db->join($tbl4, "$tbl4.dept_id = $tbl_files.file_department_id", 'left');
        $this->db->join($tbl5, "$tbl5.district_id = $tbl_files.file_district_id",'left');
        $this->db->where('file_sender_emp_id',$session1);
        $this->db->where('file_hardcopy_status','not');
        $this->db->order_by('file_update_date','asc');
        $query = $this->db->get($tbl_files);
       // echo $this->db->last_query();
        return $query->result();
    }
	public function get_employee_alloted_section($section_id = '' )
	{
		//echo "asdsa ".$section_id;
		$query =   $this->db->query( "select group_concat(section_name_hi SEPARATOR ',') as section_name_hi from ft_sections_master where section_id in ( $section_id  )" );
			
        $results =  $query->row_array();
		$data = array();
		foreach($results as $key=>$res ){
			$data[] = $res;
			
		}
		return $data;
	}

	    public function allfile_ofcsu($user_id, $year = '', $month = '', $section = '', $user = '')
    {
        $tbl_files = FILES;
        $tbl4 = DEPARTMENTS;
        $tbl5 = DISTRICT;
        $tbl6 = EMPLOYEES;
        $this->db->select(FILES .'.*,dept_name_hi,district_name_hi');
        $this->db->from($tbl_files);
        $this->db->join($tbl4, "$tbl4.dept_id = $tbl_files.file_department_id", 'left');
        $this->db->join($tbl5, "$tbl5.district_id = $tbl_files.file_district_id",'left');
        $this->db->join($tbl6, "$tbl6.emp_id = $tbl_files.file_received_emp_id",'left');
        //$this->db->where('createfile_empid',$user_id);
        if($year != ''){
            $this->db->where("YEAR(file_created_date)",$year);
        }
        if($month != '' && $month != date('m')){ // this will add becoz display all cus file .
            $this->db->where("MONTH(file_created_date)",$month);
        }
        if($section != ''){
            $this->db->where("file_mark_section_id",$section);
        }
        if($user != ''){
            $this->db->where("createfile_empid",$user);
        }
        $this->db->where("$tbl6.role_id",'39');
        $this->db->where("$tbl_files.file_hardcopy_status !=",'close');
        $this->db->where("$tbl_files.file_return !=",'2');
        $this->db->order_by("$tbl_files.file_id",'desc');
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result();
    }
    
        //New file Movement
    public function getFiles_movement_details($file_id = null)
    {
        $query1 = "SELECT move.fmove_id , move.fmove_file_id , 
move.fmove_current_user_id as curr_empid ,
curr_emp.emp_title_hi as curr_title_nm ,
curr_emp.emp_full_name_hi as curr_emp_nm ,
curr_role.emprole_name_hi as curr_role_nm ,
move.fmove_previous_user_id as pre_empid ,
pre_emp.emp_title_hi as pre_title_nm ,
pre_emp.emp_full_name_hi as pre_emp_nm,
pre_role.emprole_name_hi as pre_role_nm ,
move.file_return,
move.fmove_created_datetime
FROM `ft_file_movements` as move
Left join ft_employee as curr_emp on curr_emp.emp_id = move.fmove_current_user_id
Left join ft_employee as pre_emp on pre_emp.emp_id = move.fmove_previous_user_id
LEFT JOIN ft_emprole_master as curr_role ON curr_role.role_id = curr_emp.designation_id
LEFT JOIN ft_emprole_master as pre_role ON pre_role.role_id = pre_emp.designation_id
where (move.fmove_current_user_id != move.fmove_previous_user_id || move.file_return = '2') and move.fmove_file_id = ".$file_id." order by move.fmove_id desc";
        $query = $this->db->query($query1);
        $data = $query->result_array();
       if($query->num_rows() != 0) {
            return $data;
        }
        else{ 
            $query1 = "SELECT move.fmove_id , move.fmove_file_id ,
move.fmove_current_user_id as curr_empid ,
curr_emp.emp_title_hi as curr_title_nm ,
curr_emp.emp_full_name_hi as curr_emp_nm ,
curr_role.emprole_name_hi as curr_role_nm ,
move.fmove_previous_user_id as pre_empid ,
pre_emp.emp_title_hi as pre_title_nm ,
pre_emp.emp_full_name_hi as pre_emp_nm,
pre_role.emprole_name_hi as pre_role_nm ,
move.file_return,
move.fmove_created_datetime
FROM `ft_file_movements_master` as move
Left join ft_employee as curr_emp on curr_emp.emp_id = move.fmove_current_user_id
Left join ft_employee as pre_emp on pre_emp.emp_id = move.fmove_previous_user_id
LEFT JOIN ft_emprole_master as curr_role ON curr_role.role_id = curr_emp.designation_id
LEFT JOIN ft_emprole_master as pre_role ON pre_role.role_id = pre_emp.designation_id
where (move.fmove_current_user_id != move.fmove_previous_user_id || move.file_return = '2') and move.fmove_file_id = ".$file_id." order by move.fmove_id desc";
            $query = $this->db->query($query1);
            $data = $query->result_array();
            return $data;
        }
    }
		
}

