<?php

class Sub_file_type_model extends CI_Model {

 	function __construct() {
        parent::__construct();
    }
	
	
    public function sub_file_types($type = '')
    {
		$this->db->select('sub_file_type_section_id,section_name_hi,sub_file_type_name,sub_file_type_id');
        $this->db->from(SUB_FILE_TYPE); 
		$this->db->join(SECTIONS, SUB_FILE_TYPE.".sub_file_type_section_id = ".SECTIONS.".section_id");		
		$this->db->order_by('sub_file_type_id','DESC');
        $query = $this->db->get();
		
        if($query->num_rows() != 0)
        {
            return $query->result_array();
        }
        else{
            return FALSE;
        }
    }
	
}

