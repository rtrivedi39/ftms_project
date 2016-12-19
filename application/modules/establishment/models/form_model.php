<?php
class Form_model extends CI_Model {

 	function __construct() {
        parent::__construct();
    }
	
	public function get_alloted_category($emp_id = '')
    {
        $tbl_category = EST_CATEGORY_MASTER;
        $tbl_work_allote = EST_WORK_ALLOTE;
		$this->db->select('est_word_alloted_work_id');	
		if($emp_id == ''){
			$emp_id = $this->session->userdata('emp_id');
		}
		$this->db->where("$tbl_work_allote.est_word_alloted_emp_id", $emp_id);
		$this->db->where("$tbl_category.parent_category_id IS NULL");
        $this->db->join($tbl_work_allote, $tbl_work_allote . '.est_word_alloted_work_id = '.$tbl_category .'.master_category_id');
        $this->db->from($tbl_category);
        $this->db->order_by('est_word_alloted_work_id', 'ASC');
        $query = $this->db->get();
       // echo $this->db->last_query();
        
        if($query->num_rows() != 0)
        {          
            $row = $query->result_array();				
		    return $row[0]['est_word_alloted_work_id'];
        }
        else{
            return FALSE;
        }
    }
	
	 public function get_category($category_id = '')
    {		
        $tbl_category = EST_CATEGORY_MASTER;
       
        $this->db->select();
        $this->db->from($tbl_category);
        if($category_id != ''){
			$this->db->where("$tbl_category.master_category_id", $category_id);
        }      
		$this->db->where("$tbl_category.parent_category_id IS NULL");
		//$this->db->where("$tbl_category.is_every_emp_create", '0');
        $query = $this->db->get();
		//echo $this->db->last_query();
        if($query->num_rows() > 0)
        {
            $rows = $query->result_array();
			return $rows;            
        }
        else{
            return FALSE;
        }

    }
	
}

