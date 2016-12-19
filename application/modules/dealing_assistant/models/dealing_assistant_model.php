<?php

class Dealing_assistant_model extends CI_Model {

 	function __construct() {
        parent::__construct();
    }
	
	public function getdealingAssistant()
	{
	//	$section_id = getEmployeeSection();
	//	$this->db->where('emp_section_id',$section_id);
	//	$this->db->where('emp_id !=',$this->session->userdata('emp_id'));
	//	$query = $this->db->get(EMPLOYEES);
	//	$this->db->last_query();
	//	return $query->result();
        $query =   $this->db->query("select group_concat(under_emp_id SEPARATOR ',') as u_empid from ft_employee_hirarchi where emp_id = ".$this->session->userdata('emp_id'));
        $rr =  $query->row_array();
        $rt =  explode(',',$rr['u_empid']);
        $tbl_files = EMPLOYEES;
        $this->db->select('*');
        $this->db->where_in('emp_id',$rt);
        $query = $this->db->get($tbl_files);
        // echo   $this->db->last_query();
        return $query->result();

	}
	
	public function getAssistantDetails($profile_id)
	{
		$tbl_emp = EMPLOYEES;
    	$tbl_emp_detail = EMPLOYEE_DETAILS;    
    	$tbl_emp_role = EMPLOYEEE_ROLE;   
		$tbl_sections_master = SECTIONS;   	   	
    	$this->db->select('emp_unique_id,emprole_name_hi,emprole_name_en,section_name_hi,section_name_en,emp_login_id,emp_full_name,emp_email,emp_image,emp_mobile_number	,emp_is_retired,emp_detail_gender,emp_detail_dob,emp_detail_martial_status,emp_detail_address,emp_detail_city,emp_detail_state,'.$tbl_emp_role.'.role_id,emp_status,emp_last_login_date,emp_first_login,emp_section_id,emprole_name_hi');
		$this->db->from($tbl_emp);
		$this->db->join($tbl_emp_detail, "$tbl_emp.emp_id = $tbl_emp_detail.emp_id",'left');
		$this->db->join($tbl_emp_role, "$tbl_emp.role_id = $tbl_emp_role.role_id",'left');
		$this->db->join($tbl_sections_master, "$tbl_emp.emp_section_id = $tbl_sections_master.section_id",'left');
		$this->db->where($tbl_emp.'.emp_id',$profile_id);
		$query = $this->db->get();
		$this->db->last_query();
		return $query->row(); 
		
	}
	
	public function getAssistantFiles($profile_id)
	{
		$tbl_files = FILES;
		$this->db->select('*');
		$this->db->where('file_received_emp_id',$profile_id);
		$query = $this->db->get($tbl_files);
		$this->db->last_query();
		return $query->result(); 
	}
}

