<?php

class admin_teep_master_model extends CI_Model {

 	function __construct() {
        parent::__construct();
    }
	public function get_employee_rolelist()
	{
		$this->db->select('emprole_name_hi,emprole_name_en,emprole_level');
		$this->db->from(EMPLOYEEE_ROLE);
		$this->db->group_by('emprole_level');
		$this->db->where('emprole_level !=','');
		$this->db->where('emprole_level !=',12);
		$this->db->where('emprole_level !=',14);
		$query = $this->db->get();
		return $query->result_array();
		
	}
	public function get_teep_details( $teep_id = null)
	{
		$this->db->select('*');
		$this->db->from(TEEP_MASTER);
		if(!empty( $teep_id )){
			$this->db->where('autoload_teep_master_id', $teep_id);
		}
		$query = $this->db->get();
		echo $this->db->last_query();
		return $query->result_array();
		
	}
	public function get_single_teep($teep_id = null)
	{
		$this->db->select('*');
		$this->db->from(TEEP_MASTER);
		$this->db->where('autoload_teep_master_id',$teep_id);
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->row();
		
	}
	public function get_employee_lavel_name($lavel_ids)
	{
		$this->db->select('emprole_name_hi,emprole_name_en');
		$this->db->from(EMPLOYEEE_ROLE);
		$this->db->where('emprole_level',$lavel_ids);
		$query = $this->db->get();
		//echo $this->db->last_query();
		return $query->row();
		
	}
	
	
}

