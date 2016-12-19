<?php

class View_file_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    public function getFiles($section_id,$moveup_down,$section_search_id ='')
    {
        $cr_empid = get_emp_by_role('9', '1');
        $cr_explod = explode(',', $cr_empid);
		$empids = $this->get_establishment_empids();

       /* $query = $this->db->query("select group_concat(under_emp_id SEPARATOR ',') as u_empid from ft_employee_hirarchi where emp_id = " . emp_session_id());
        $rr = $query->row_array();
        $rt = explode(',', $rr['u_empid']);*/


        $emp_da_cr  = array_merge($empids,$cr_explod);

        $tbl_files = FILES;
		$tbl4 = DEPARTMENTS;
        $tbl5 = DISTRICT;
        $this->db->select(FILES .'.*,dept_name_hi,district_name_hi');
		$this->db->join($tbl4, "$tbl4.dept_id = $tbl_files.file_department_id", 'left');
        $this->db->join($tbl5, "$tbl5.district_id = $tbl_files.file_district_id",'left');
        if(!empty($section_search_id)){
		    $this->db->where('file_mark_section_id',$section_search_id); 
	    }
		else if(isset($section_id) && $section_id != null) {
            //$this->db->where_in('file_mark_section_id', $section_id);
        }
		if($moveup_down == 'cr'){
                $this->db->where_in('file_sender_emp_id',$cr_explod);
                $this->db->where('file_type !=','app');
        }
        else if($moveup_down == 'return'){
            $this->db->where_not_in('file_sender_emp_id',$emp_da_cr);
            $this->db->where('file_type !=','app');
        }else {

         //   $this->db->where_not_in('file_sender_emp_id',$rt);
            //$this->db->where('file_return !=','2');
         //   $this->db->where('file_hardcopy_status !=','working');
        }
		/*if (($key = array_search(151, $empids)) !== false) {
                        unset($empids[$key]);
        }
		$this->db->where_not_in( 'createfile_empid', $empids);*/

		//$this->db->where('section_file_type',0); //code comment by bij 22 12 2015
		$this->db->where('file_received_emp_id',emp_session_id());
        $this->db->where('file_hardcopy_status !=','close');
		$this->db->order_by('file_update_date','ASC');
		$query = $this->db->get($tbl_files);
    //    echo $this->db->last_query();
        return $query->result();
    }


    //for dealing assistant name RP
    public function get_DAname($section_id,$subuser=null )
    {
    if($subuser!=''){
        $query =   $this->db->query("select group_concat(under_emp_id SEPARATOR ',') as u_empid from ft_employee_hirarchi where emp_id = ".$subuser);
    }else {
        $query = $this->db->query("select group_concat(under_emp_id SEPARATOR ',') as u_empid from ft_employee_hirarchi where emp_id = " . emp_session_id());
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
        $this->db->order_by('file_id','desc');
        $query = $this->db->get($tbl_files);
       // echo $this->db->last_query();
        return $query->result();
    }
	public function get_establishment_empids()
	{
		
		$employees_es = get_establishment_employees_with_des(); 
		$empids = array();
		foreach( $employees_es as $emp_ids){ $empids[] = $emp_ids->emp_id ; }
		return $empids;
	}
}

