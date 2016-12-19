<?php

class View_file_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    public function getFiles($section_id,$moveup_down,$section_id_search=null)
    {
        if(!empty($moveup_down)) {
            $query = $this->db->query("select group_concat(under_emp_id SEPARATOR ',') as u_empid from ft_employee_hirarchi where emp_id = " . emp_session_id());
            $rr = $query->row_array();
            $rt = explode(',', $rr['u_empid']);
        }
        $section_exp = explode(',',getEmployeeSection());
        $tbl_files = FILES;
		$tbl4 = DEPARTMENTS;
        $tbl5 = DISTRICT;
        $this->db->select(FILES .'.*,dept_name_hi,district_name_hi');
		$this->db->join($tbl4, "$tbl4.dept_id = $tbl_files.file_department_id", 'left');
        $this->db->join($tbl5, "$tbl5.district_id = $tbl_files.file_district_id",'left');
		if($section_id_search){
		if($section_id_search == 'oth'){
			 $this->db->where_not_in('file_mark_section_id',$section_exp);
		}else{
            $this->db->where('file_mark_section_id',$section_id_search);
        }
        }else if(isset($section_id) && $section_id != null) {
			$sectionids = explode(',',$section_id);
		//	$this->db->where_in('file_mark_section_id',$sectionids);
        }
		if($moveup_down == '1'){
             $this->db->where_in('file_sender_emp_id',$rt);}
         else if($moveup_down == 'return'){
           $this->db->where_not_in('file_sender_emp_id',$rt);
            $this->db->where('file_return','1');
        }else {
		//  $this->db->where_not_in('file_sender_emp_id',$rt);
         //   $this->db->where('file_return','0');
        }
		$this->db->where('file_received_emp_id',emp_session_id());
        $this->db->where('file_hardcopy_status !=','working');
        $this->db->where('file_hardcopy_status !=','close');
		$this->db->order_by('file_id','desc');
		$query = $this->db->get($tbl_files);
      // echo $this->db->last_query();
		return $query->result();
    }

    // RP
    public function getFiles_bycr($user_id)
    {
        $tbl_files = FILES;
        $tbl4 = DEPARTMENTS;
        $tbl5 = DISTRICT;
        $this->db->select(FILES .'.*,dept_name_hi,district_name_hi');
        $this->db->from($tbl_files);
        $this->db->join($tbl4, "$tbl4.dept_id = $tbl_files.file_department_id", 'left');
        $this->db->join($tbl5, "$tbl5.district_id = $tbl_files.file_district_id",'left');
        $this->db->where('file_received_emp_id',$user_id);
        $this->db->where("$tbl_files.file_hardcopy_status !=",'close');
        $this->db->where("$tbl_files.file_return",'1');
        $this->db->order_by("$tbl_files.file_id",'desc');
        $query = $this->db->get();
       //echo $this->db->last_query();
        return $query->result();
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
   public function allfile_bycr($user_id)
    {
        $tbl_files = FILES;
        $tbl4 = DEPARTMENTS;
        $tbl5 = DISTRICT;
        $this->db->select(FILES .'.*,dept_name_hi,district_name_hi');
        $this->db->from($tbl_files);
        $this->db->join($tbl4, "$tbl4.dept_id = $tbl_files.file_department_id", 'left');
        $this->db->join($tbl5, "$tbl5.district_id = $tbl_files.file_district_id",'left');
        //$this->db->where('createfile_empid',$user_id);
        $this->db->where('createfile_empid !=','35');
        $this->db->where("$tbl_files.file_hardcopy_status !=",'close');
        $this->db->order_by("$tbl_files.file_id",'desc');
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
    public function get_DAname($section_id,$subuser=null )
    {		
        //$query =   $this->db->query("select group_concat(under_emp_id SEPARATOR ',') as u_empid from ft_employee_hirarchi where emp_id = ".emp_session_id());
		if($subuser!=''){
			$query =   $this->db->query("select group_concat(under_emp_id SEPARATOR ',') as u_empid from ft_employee_hirarchi where emp_id = ".$subuser);
		}else{
			$query =   $this->db->query("select group_concat(under_emp_id SEPARATOR ',') as u_empid from ft_employee_hirarchi where emp_id = ".emp_session_id());
		}
        $rr =  $query->row_array();
        
        if($rr['u_empid']==''){
            $query =   $this->db->query("select group_concat(emp_id SEPARATOR ',') as u_empid from ft_employee where emp_section_id=".$section_id);   
            $rr =  $query->row_array();
            //echo $this->db->last_query();
        }
        $rt =  explode(',',$rr['u_empid']);
        $tbl_files = EMPLOYEES;
		$empdetail=EMPLOYEE_DETAILS;
        $this->db->select('*');
		$this->db->join($empdetail, "$empdetail.emp_id = $tbl_files.emp_id",'inner');
        $this->db->where_in($tbl_files.'.emp_id',$rt);
        $query = $this->db->get($tbl_files);        
        return $query->result_array();
    }
	
	public function get_DAname_ajax($section_id,$subuser=null )
    {	
	 $section_id1 = explode(',',$section_id);
        //$query =   $this->db->query("select group_concat(under_emp_id SEPARATOR ',') as u_empid from ft_employee_hirarchi where emp_id = ".emp_session_id());
		if($subuser!=''){
			$query =   $this->db->query("select group_concat(under_emp_id SEPARATOR ',') as u_empid from ft_employee_hirarchi where emp_id = ".$subuser);
		}else{
			$query =   $this->db->query("select group_concat(under_emp_id SEPARATOR ',') as u_empid from ft_employee_hirarchi where emp_id = ".emp_session_id());
		}
        $rr =  $query->row_array();
        
        if($rr['u_empid']==''){ 
			//if(isset($_GET['test']) && $_GET['test']=='bij'){ /*This is test code 24-08-2016 */
				//pre($section_id1);
				$get_sec_emp_var='';	
				foreach($section_id1 as $val){
					//if(count($section_id)>1){
					if(count($section_id1) == 1){
						$get_sec_emp_var.="FIND_IN_SET($val,emp_section_id)";
					}else{
						$get_sec_emp_var.="FIND_IN_SET($val,emp_section_id) OR ";
						
					}
				}
				$get_sec_emp_array = explode('OR',$get_sec_emp_var);
				array_pop($get_sec_emp_array);
				//pre($get_sec_emp_array);
				if(count($get_sec_emp_array)>1){
					$get_sec_emp_var = implode('OR',$get_sec_emp_array);
				}else{
					$get_sec_emp_var;
				}								
                $query =   $this->db->query("select group_concat(emp_id SEPARATOR ',') as u_empid from ft_employee where ($get_sec_emp_var)  AND role_id IN(17,18,19,22,23,24,20) AND emp_status ='1' AND emp_is_retired = '0' and emp_posting_location =1");   
			//}
			//else{
             //   $query =   $this->db->query("select group_concat(emp_id SEPARATOR ',') as u_empid from ft_employee where emp_section_id=".$section_id1[0]);   
			//}
            $rr =  $query->row_array();
            //echo $this->db->last_query();
        }        
        
        if(emp_session_id() == 25){   // this condition only for mayank shroti sir(25) and pagare sir(133) for display da name under mayank sir
            $uempids = $rr['u_empid'].",133";
        }else{
            $uempids = $rr['u_empid'];
        }
        
        $rt =  explode(',',$uempids);
        $tbl_files = EMPLOYEES;
		$empdetail=EMPLOYEE_DETAILS;
        $this->db->select("$tbl_files.emp_id,$tbl_files.role_id,$tbl_files.designation_id,$tbl_files.emp_full_name,$tbl_files.emp_full_name_hi,$tbl_files.emp_section_id,$empdetail.emp_detail_gender");
		$this->db->join($empdetail, "$empdetail.emp_id = $tbl_files.emp_id",'inner');
        $this->db->where_in($tbl_files.'.emp_id',$rt);
        $query = $this->db->get($tbl_files);        
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
        $this->db->select(FILES.'.*,section_name_hi,section_name_en,emp_full_name,dept_name_hi,dept_name_en,district_name_hi,district_name_en,remark_title_hi,state_name_en,state_name_hi,state_id,file_upload,case_no');
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
    //file log
    public function getFiles_log($file_id = null)
    {
        $this->db->where('file_id',$file_id);
        $this->db->order_by('flog_id','DESC');
        $this->db->from(FILES_LOG);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
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
        $query =   $this->db->query("select group_concat(under_emp_id SEPARATOR ',') as u_empid from ft_employee_hirarchi where emp_id = ".emp_session_id());
        $rr =  $query->row_array();
        $rt =  explode(',',$rr['u_empid']);

          $tbl_files = FILES;
        $tbl4 = DEPARTMENTS;
        $tbl5 = DISTRICT;
        $this->db->select(FILES .'.*,dept_name_hi,district_name_hi');
        $this->db->join($tbl4, "$tbl4.dept_id = $tbl_files.file_department_id", 'left');
        $this->db->join($tbl5, "$tbl5.district_id = $tbl_files.file_district_id",'left');
     //   $this->db->where_in('file_mark_section_id','8');
        $this->db->where_in('file_received_emp_id',emp_session_id());
        if($where_show == '1'){
            $this->db->where_in('file_sender_emp_id',$rt);}
        else {
            $this->db->where_not_in('file_sender_emp_id',$rt);
        }
        $this->db->where('file_hardcopy_status !=','close');
        $this->db->order_by('file_id','desc');
        $query = $this->db->get($tbl_files);
        // echo  $this->db->last_query();
        return $query->result();
    }
	/*18-09-2015 Get Sub user Files */
	public function getFiles_2($section_id,$moveup_down)
    {
	    $tbl_files = FILES;
        $this->db->select('*');
		if($moveup_down == '1'){
            $this->db->where_in('file_sender_emp_id',$rt);}
        else if($moveup_down == 'return'){
            $this->db->where_not_in('file_sender_emp_id',$rt);
            $this->db->where('file_return','1');
        }
		//echo emp_session_id();
		$this->db->where('file_received_emp_id',emp_session_id());
        $this->db->where('file_hardcopy_status !=','close');
		$this->db->order_by('file_id','desc');
		$query = $this->db->get($tbl_files);
		return $query->result();
    }
	/*18-09-2015 Get Sub user Files */

}

