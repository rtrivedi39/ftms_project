<?php
class Admin_notesheet_master_model extends CI_Model {

 	function __construct() {
        parent::__construct();
    }
	
    public function get_notesheet_new_no(){
        $this->db->select_max('notesheet_id');
        $this->db->from(NOTESHEET_MASTER);
        $query = $this->db->get();
        $row = $query->row();        
        if ($query->num_rows() > 0) {
            return $row->notesheet_id + 1;
        } else {
            return false;
        }
    }
    
    public function get_notesheet_details($id){
        $this->db->select('*');
        $this->db->from(NOTESHEET_MASTER);
        $this->db->where('notesheet_id', $id);
        $query = $this->db->get();
        $result = $query->result();        
        if ($query->num_rows() > 0) {
            return $result;
        } else {
            return false;
        }
    }
    
    public function get_dpf_gpf_details($pay_id)
	 {
        $this->db->select('*');
        $this->db->from('pay_dpf_yearly_amount');
        $this->db->where('pay_id', $pay_id);
        $query = $this->db->get();
		$result = $query->result();
        if ($query->num_rows() > 0) {
            return $result;
        } else {
            return false;
        }
    } 
}

