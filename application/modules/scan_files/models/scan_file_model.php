<?php

class Scan_file_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
   public function search_scan_file()
    {
		$meta_key = $this->input->post('meta_key');
		$file_subject = $this->input->post('file_subject');
        $mark_to_section = $this->input->post('mark_to_section');
        $scan_file_path = $this->input->post('file_title');
        $scan_type = $this->input->post('scan_type');
        $file_place_id = $this->input->post('from_place');

      //  pre($this->input->post());
		
		if(isset($meta_key) && !empty($meta_key))
		{
			$this->db->like('scan_meta_key',$meta_key);
		}
		if(isset($file_subject) && !empty($file_subject))
		{
			$this->db->like('scan_subject',$file_subject);
		}
		if(isset($file_offer_by) && !empty($file_offer_by))
		{
			$this->db->where('scan_file_from_type',$file_offer_by);
		}
		if(isset($file_place_id) && !empty($file_place_id))
		{
			$this->db->where('scan_file_from_place',$file_place_id);
		}
		if(isset($mark_to_section) && !empty($mark_to_section))
		{
			$this->db->where('scan_section_id',$mark_to_section);
		}
        if(isset($scan_file_path) && !empty($scan_file_path))
		{
			$this->db->like('scan_file_path',$scan_file_path);
		}
        if(isset($scan_type) && !empty($scan_type))
		{
			$this->db->where('scan_type',$scan_type);
		}
        $query = $this->db->get(FILE_SCAN);
      //  echo  $this->db->last_query();

		if($query->num_rows() > 0)
		{
			return  $query->result();
		}
		else
		{
			return  '';
		}
    }

	 public function scan_file_open( $scan_id )
    {
		$this->db->where('scan_id',$scan_id );
		$query = $this->db->get(FILE_SCAN);
        return $query->result();
		
    }
		
}

