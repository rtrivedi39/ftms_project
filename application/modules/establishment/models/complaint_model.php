<?php
class Complaint_model extends CI_Model {

 	function __construct() {
        parent::__construct();
    }
	
	public function get_complaints($type = '', $emp_id = '',$limit=null,$page=null)
    {
		if($emp_id == ''){
			$emp_id = $this->session->userdata('emp_id');
		}	
		$ctype = complaint_type('', 1);
		$com_type = array();
		foreach($ctype as $key => $types){
			$com_type[] = $types['master_category_id'];
		}
		$all_com_type = implode(',', $com_type);
		$check_est_emplyee = check_est_emplyee();
		$check_est_so = check_est_so();
		$userrole = checkUserrole();
		$u_emp_id = emp_session_id();
		
		$tbl1 = FILES;
		$tbl2 = SECTIONS;
		$tbl3 = EMPLOYEES;
		$tbl4 = 'ft_est_master_category';
		$this->db->select(FILES . '.*,section_name_hi,section_name_en,emp_full_name,emp_full_name_hi');
		$this->db->from($tbl1);
		$this->db->join($tbl2, "$tbl2.section_id = $tbl1.file_mark_section_id", 'left');
		$this->db->join($tbl3, "$tbl3.emp_id = $tbl1.file_received_emp_id", 'left');
		$this->db->join($tbl4, "$tbl1.section_file_type = $tbl4.master_category_id", 'left');
		if($check_est_so) {
			if($type == 'p'){
				$this->db->where("$tbl1.file_hardcopy_status != ", 'close');	
				$this->db->where("(`file_received_emp_id` = '$emp_id')");
			}
			if($type == 'f'){
				$this->db->where("$tbl1.file_hardcopy_status", 'close');
			}	
		} else if($check_est_emplyee){
			$this->db->where("$tbl1.file_received_emp_id", "$emp_id");
		} else if($userrole == 1 || ($userrole == 5 && $u_emp_id == 4) || ($userrole == 23 && $u_emp_id == 151)) {
			$this->db->where("((master_category_id = '60' or parent_category_id = '60') or createfile_empid = '$emp_id' )");
		}else{
			$this->db->where("$tbl1.createfile_empid", "$emp_id");
		}	
		$this->db->where("$tbl1.file_mark_section_id", 7);
		if($userrole != 5 && $u_emp_id != 4) {
			$this->db->where("$tbl1.section_file_type IN($all_com_type) ");
		}
		$this->db->order_by("file_update_date", 'asc');
		if(isset($_GET['searchby']) && $_GET['searchby']!=''){
			$searchval=trim($_GET['searchby']);
			$wheres= "(FIND_IN_SET('".$searchval."',ft_files.file_all_section_no) OR ft_files.file_subject like '%".$searchval."%'  OR ft_files.file_uo_or_letter_no like '%".$searchval."%' OR ft_files.file_uo_or_letter_date = DATE_FORMAT('".$searchval."', '%Y-%m-%d') OR ($tbl4.category_title_hin like'%".$searchval."%' OR $tbl4.category_title_en like'%".$searchval."%' ))";
			$this->db->where($wheres);
		}
		$this->db->limit($limit,$page);	
		$query = $this->db->get();
		$this->db->last_query();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return FALSE;
		}
		
		
    }
	
	public function count_get_complaints($type = '', $emp_id = '')
    {
		if($emp_id == ''){
			$emp_id = $this->session->userdata('emp_id');
		}	
		$ctype = complaint_type('', 1);
		$com_type = array();
		foreach($ctype as $key => $types){
			$com_type[] = $types['master_category_id'];
		}
		$all_com_type = implode(',', $com_type);
		$check_est_emplyee = check_est_emplyee();
		$check_est_so = check_est_so();
		$userrole = checkUserrole();
		$u_emp_id = emp_session_id();
		
		$tbl1 = FILES;
		$tbl2 = SECTIONS;
		$tbl3 = EMPLOYEES;
		$tbl4 = 'ft_est_master_category';
		$this->db->select("COUNT(DISTINCT(file_id)) as totalfiles");
		$this->db->from($tbl1);
		$this->db->join($tbl2, "$tbl2.section_id = $tbl1.file_mark_section_id", 'left');
		$this->db->join($tbl3, "$tbl3.emp_id = $tbl1.file_received_emp_id", 'left');
		$this->db->join($tbl4, "$tbl1.section_file_type = $tbl4.master_category_id", 'left');
		
		if($check_est_so) {
			if($type == 'p'){
				$this->db->where("$tbl1.file_hardcopy_status != ", 'close');	
				$this->db->where("(`file_received_emp_id` = '$emp_id')");
			
			}
			if($type == 'f'){
				$this->db->where("$tbl1.file_hardcopy_status", 'close');
			}	
		} else if($check_est_emplyee){
			$this->db->where("$tbl1.file_received_emp_id", "$emp_id");
		} else if($userrole == 1 || ($userrole == 5 && $u_emp_id == 4) || ($userrole == 23 && $u_emp_id == 151)) {
			$this->db->where("((master_category_id = '60' or parent_category_id = '60') or createfile_empid = '$emp_id' )");
		}else{
			$this->db->where("$tbl1.createfile_empid", "$emp_id");
		}	
		$this->db->where("$tbl1.file_mark_section_id", 7);
		
		if($userrole != 5 && $u_emp_id != 4) {
			$this->db->where("$tbl1.section_file_type IN($all_com_type) ");
		}
		if(isset($_GET['searchby']) && $_GET['searchby']!=''){
			$searchval=trim($_GET['searchby']);
			$wheres= "(FIND_IN_SET('".$searchval."',ft_files.file_all_section_no) OR ft_files.file_subject like '%".$searchval."%'  OR ft_files.file_uo_or_letter_no like '%".$searchval."%' OR ft_files.file_uo_or_letter_date = DATE_FORMAT('".$searchval."', '%Y-%m-%d') OR ($tbl4.category_title_hin like'%".$searchval."%' OR $tbl4.category_title_en like'%".$searchval."%' ))";
			$this->db->where($wheres);
		}
		$query = $this->db->get();
		return $query->row_array();
	
		
    }
	
	public function get_showcount_complaints($type = '', $emp_id = '')
    {
		if($emp_id == ''){
			$emp_id = $this->session->userdata('emp_id');
		}	
		$ctype = complaint_type('', 1);
		$com_type = array();
		foreach($ctype as $key => $types){
			$com_type[] = $types['master_category_id'];
		}
		$all_com_type = implode(',', $com_type);
		$check_est_emplyee = check_est_emplyee();
		$check_est_so = check_est_so();
		$userrole = checkUserrole();
		$u_emp_id = emp_session_id();
		
		$tbl1 = FILES;
		$tbl2 = SECTIONS;
		$tbl3 = EMPLOYEES;
		$tbl4 = 'ft_est_master_category';
		$this->db->select(FILES . '.*,section_name_hi,section_name_en,emp_full_name,emp_full_name_hi');
		$this->db->from($tbl1);
		$this->db->join($tbl2, "$tbl2.section_id = $tbl1.file_mark_section_id", 'left');
		$this->db->join($tbl3, "$tbl3.emp_id = $tbl1.file_received_emp_id", 'left');
		$this->db->join($tbl4, "$tbl1.section_file_type = $tbl4.master_category_id", 'left');
		if($check_est_so) {
			if($type == 'p'){
				$this->db->where("$tbl1.file_hardcopy_status != ", 'close');	
				$this->db->where("(`file_received_emp_id` = '$emp_id')");
			}
			if($type == 'f'){
				$this->db->where("$tbl1.file_hardcopy_status", 'close');
			}	
		} else if($check_est_emplyee){
			$this->db->where("$tbl1.file_received_emp_id", "$emp_id");
		} else if($userrole == 1 || ($userrole == 5 && $u_emp_id == 4) || ($userrole == 23 && $u_emp_id == 151)) {
			$this->db->where("((master_category_id = '60' or parent_category_id = '60') or createfile_empid = '$emp_id' )");
		}else{
			$this->db->where("$tbl1.createfile_empid", "$emp_id");
		}	
		$this->db->where("$tbl1.file_mark_section_id", 7);
		if($userrole != 5 && $u_emp_id != 4) {
			$this->db->where("$tbl1.section_file_type IN($all_com_type) ");
		}
		
		$this->db->order_by("file_id", 'DESC');
		
		$query = $this->db->get();
	//echo $this->db->last_query();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return FALSE;
		}
		
		
    }
	
	public function get_single_complaints($com_id = '')
    {
		$tbl1 = FILES;

		$tbl2 = SECTIONS;
		$tbl3 = EMPLOYEES;
		$this->db->select(FILES . '.*,section_name_hi,section_name_en,emp_full_name,emp_full_name_hi');
		$this->db->from($tbl1);
		$this->db->join($tbl2, "$tbl2.section_id = $tbl1.file_mark_section_id", 'left');
		$this->db->join($tbl3, "$tbl3.emp_id = $tbl1.file_received_emp_id", 'left');
		$this->db->where("$tbl1.file_id", $com_id);
		$query = $this->db->get();
		echo $this->db->last_query();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return FALSE;
		}

    }
	
	
	
}

