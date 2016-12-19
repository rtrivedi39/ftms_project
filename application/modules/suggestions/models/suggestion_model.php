<?php
class Suggestion_model extends CI_Model {

 	function __construct() {
        parent::__construct();
    }
	
	public function get_suggestion($type = '', $emp_id = '')
    {
		if($emp_id == ''){
			$emp_id = $this->session->userdata('emp_id');
		}
		$user_role =checkUserrole();
		
		$tbl_suggestion = SUGGESTION;
		
		$this->db->select('*');
		$this->db->from($tbl_suggestion);
		if($user_role != '1'){
			$this->db->where("suggestion_emp", $emp_id);
		}
		if($type == 'p'){
			$this->db->where("suggestion_status", '0');	
		}
		if($type == 'f'){
			$this->db->where("suggestion_status", '1');
		}
		$this->db->order_by("suggestion_createat",'DESC');
		$query = $this->db->get();
		//echo $this->db->last_query();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return FALSE;
		}
		
		
    }
	
	public function get_single_suggestions($id = '')
    {
		$tbl_suggestion = SUGGESTION;
		$this->db->select('*');
		$this->db->from($tbl_suggestion);
		$this->db->where("suggestion_id", $id);
		$query = $this->db->get();
		//echo $this->db->last_query();
		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return FALSE;
		}

    }
	
	
	
}

