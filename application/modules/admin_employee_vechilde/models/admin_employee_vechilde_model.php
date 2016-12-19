<?php
class admin_employee_vechilde_model extends CI_Model {

 	function __construct() {
        parent::__construct();
    }
    public function get_employee_vechild($vechild_id = null )
    {
        $tbl_vehile = EMPLOYEE_VEHILE;
       
        $this->db->select();
        $this->db->from($tbl_vehile);
        if($vechild_id){
        $this->db->where("$tbl_vehile.emp_vehicle_id", $vechild_id);
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

