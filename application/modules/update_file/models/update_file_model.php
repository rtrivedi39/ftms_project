<?php

class Update_file_model extends CI_Model {

 	function __construct() {
        parent::__construct();
    }

    function get_file_list($file_id){
		$tbl_file = FILES;
		$tbl_section = FILES_SECTION;
		$tbl_sections = SECTIONS;
		$tbl_other = FILES_OTHER_FEILDS;
		$tbl_draft = DRAFT;
		$this->db->select('*');
		$this->db->from($tbl_file);
		$this->db->join($tbl_other, "$tbl_file.file_id = $tbl_other.f_file_id",'left');
		$this->db->join($tbl_sections, "$tbl_file.file_mark_section_id = $tbl_sections.section_id",'left');	
		$this->db->join($tbl_draft, "$tbl_draft.draft_file_id = $tbl_file.file_id",'left');	
		$this->db->where("$tbl_file.file_id", $file_id);
		$query = $this->db->get();
		// echo $this->db->last_query().br();
		if($query->num_rows() > 0 ){
			 return $query->row_array(); 	
		}else {
			return false;
		}
       
    }
	
	
	function check_file_exist_in_draft($file_id){
		$tbl_draft = DRAFT;	
		$this->db->select('draft_file_id');
		$this->db->from($tbl_draft);
		$this->db->where("$tbl_draft.draft_file_id", $file_id);
		$query = $this->db->get();
		// echo $this->db->last_query().br();
		if($query->num_rows() > 0 ){
			 return true;
		}else {
			return false;
		}
		
    }
	


}

