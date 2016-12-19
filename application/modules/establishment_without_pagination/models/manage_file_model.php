<?php

class Manage_file_model extends CI_Model {
 	function __construct() {
        parent::__construct();
    }

    function get_file_last_number(){
    	$this->db->select_max('file_number');
		$query = $this->db->get(FILES, 1);    	
    	$result = $query->row_array();
    	return $result['file_number'] + 1;
    }
	
	function get_file_last_number_sectionwise($section){
    	$this->db->select_max('file_section_serial_no');
		$this->db->where(array('file_mark_section_id'=>$section));
		$query = $this->db->get(FILES);    	
    	$result = $query->row_array();
    	return $result['file_section_serial_no'] + 1;
    }

}

