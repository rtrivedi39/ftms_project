<?php
class admin_head_master_model extends CI_Model {

 	function __construct() {
        parent::__construct();
    }
    public function fetchheadsbyid($headsid='')
    {
        $tbl_heads = HEADS_MASTER;
       
        $this->db->select();
        $this->db->from($tbl_heads);
        if($headsid){
        $this->db->where("$tbl_heads.head_master_id", $headsid);
        }
      
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

