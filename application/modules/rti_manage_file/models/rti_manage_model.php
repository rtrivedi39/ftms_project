<?php
class Rti_manage_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
	public function all_rti_files($user_id)
    {
        $tbl_files = FILES;
        $tbl4 = DEPARTMENTS;
        $tbl5 = DISTRICT;
        $this->db->select(FILES .'.*,dept_name_hi,district_name_hi');
        $this->db->from($tbl_files);
        $this->db->join($tbl4, "$tbl4.dept_id = $tbl_files.file_department_id", 'left');
        $this->db->join($tbl5, "$tbl5.district_id = $tbl_files.file_district_id",'left');
        //$this->db->where('createfile_empid',$user_id);
        //$this->db->where('createfile_empid','153');
		
			$this->db->where("$tbl_files.file_received_emp_id",$user_id);
		$this->db->where("$tbl_files.file_hardcopy_status",'received');
        //$this->db->where("$tbl_files.file_hardcopy_status !=",'close');
		$this->db->where("$tbl_files.file_mark_section_id",'22');
        $this->db->order_by("$tbl_files.file_id",'desc');
        $query = $this->db->get();
		//echo $this->db->last_query();
        return $query->result();
    }
	
	public function all_rti_files_working($user_id)
    {
        $tbl_files = FILES;
        $tbl4 = DEPARTMENTS;
        $tbl5 = DISTRICT;
        $this->db->select(FILES .'.*,dept_name_hi,district_name_hi');
        $this->db->from($tbl_files);
        $this->db->join($tbl4, "$tbl4.dept_id = $tbl_files.file_department_id", 'left');
        $this->db->join($tbl5, "$tbl5.district_id = $tbl_files.file_district_id",'left');
        //$this->db->where('createfile_empid',$user_id);
       // $this->db->where('createfile_empid','153');
		$this->db->where("$tbl_files.file_hardcopy_status !=",'close');
		$this->db->where("$tbl_files.file_mark_section_id",'22');
        $this->db->order_by("$tbl_files.file_id",'desc');
        $query = $this->db->get();
		//echo $this->db->last_query();
        return $query->result();
    }
	
	public function all_rti_files_not_receive($user_id)
    {
		$tbl_files = FILES;
        $tbl4 = DEPARTMENTS;
        $tbl5 = DISTRICT;
        $this->db->select(FILES .'.*,dept_name_hi,district_name_hi');
        $this->db->from($tbl_files);
        $this->db->join($tbl4, "$tbl4.dept_id = $tbl_files.file_department_id", 'left');
        $this->db->join($tbl5, "$tbl5.district_id = $tbl_files.file_district_id",'left');
        //$this->db->where('createfile_empid',$user_id);
       /////// $this->db->where('createfile_empid','153');
		$this->db->where("$tbl_files.file_received_emp_id",$user_id);
        $this->db->where("$tbl_files.file_hardcopy_status !=",'close');
		$this->db->where("$tbl_files.file_hardcopy_status",'not');
		$this->db->where("$tbl_files.file_mark_section_id",'22');
		//$this->db->or_where("$tbl_files.file_mark_section_id",'22');
		$this->db->where("$tbl_files.file_return !=",'1');
        $this->db->order_by("$tbl_files.file_id",'desc');
        $query = $this->db->get();
		//echo $this->db->last_query();
        return $query->result();
    }
	
	public function rti_files_from_officer($user_id)
    {
	
        $tbl_files = FILES;
        $tbl4 = DEPARTMENTS;
        $tbl5 = DISTRICT;
        $this->db->select(FILES .'.*,dept_name_hi,district_name_hi');
        $this->db->from($tbl_files);
        $this->db->join($tbl4, "$tbl4.dept_id = $tbl_files.file_department_id", 'left');
        $this->db->join($tbl5, "$tbl5.district_id = $tbl_files.file_district_id",'left');
        //$this->db->where('createfile_empid',$user_id);
       // $this->db->where('createfile_empid','153');
		$this->db->where("$tbl_files.file_received_emp_id",$user_id);
        $this->db->where("$tbl_files.file_hardcopy_status !=",'close');
		//$this->db->where("$tbl_files.file_hardcopy_status",'not');
		$this->db->where("$tbl_files.file_mark_section_id",'22');
		//$this->db->where("$tbl_files.file_return ",'1');
        $this->db->order_by("$tbl_files.file_id",'desc');
        $query = $this->db->get();
		//echo $this->db->last_query();
        return $query->result();
    }
	
	
}