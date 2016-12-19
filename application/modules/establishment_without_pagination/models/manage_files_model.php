<?php

class Manage_files_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    // file lastid section no
    public function plusone_fileno($sectionid){
        $this->db->select_max('section_number');
        $this->db->where('section_id',$sectionid);
		$this->db->where('YEAR(file_created_date)', date("Y"));
        $query = $this->db->get(FILES_SECTION, 1);
        $result = $query->row_array();
        $this->db->last_query();
        return $result['section_number'] + 1;
    }

}

