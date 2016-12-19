<?php
class Est_category_master_model extends CI_Model {

 	function __construct() {
        parent::__construct();
    }
	
    public function fetch_category_yid($category_id='')
    {
        $tbl_category = EST_CATEGORY_MASTER;
       
        $this->db->select();
        $this->db->from($tbl_category);
        if($category_id){
			$this->db->where("$tbl_category.master_category_id", $category_id);
        }
		if(empty($category_id)){
			$this->db->where('parent_category_id IS NULL');
		}
		//$this->db->where('is_every_emp_create',0);
		$this->db->order_by('created_date','desc');
		

        $query = $this->db->get();
		
        if($query->num_rows() != 0)
        {
            return $query->result_array();
        }
        else{
            return FALSE;
        }

    }
	
	public function fetch_alloted_work($work_id = '')
    {
        $tbl_category = EST_CATEGORY_MASTER;
        $tbl_work_allote = EST_WORK_ALLOTE;
		$this->db->select('*');	
        if($work_id != ''){
			$this->db->where("$tbl_work_allote.est_word_alloted_id", $work_id);
        }
        $this->db->join($tbl_work_allote, $tbl_work_allote . '.est_word_alloted_work_id = '.$tbl_category .'.master_category_id');
        $this->db->from($tbl_category);
        $this->db->order_by('est_word_alloted_work_id', 'ASC');
        $query = $this->db->get();
        $this->db->last_query();
        
        if($query->num_rows() != 0)
        {          
            return $query->result_array();
        }
        else{
            return FALSE;
        }

    }
	public function fetch_subcategory_yid($parent_id = null)
    {
        $tbl_category = EST_CATEGORY_MASTER;

        $this->db->select();
        $this->db->from($tbl_category);
        if($parent_id){
			$this->db->where("$tbl_category.parent_category_id", $parent_id);
        }



        $query = $this->db->get();
		//echo $this->db->last_query();

        if($query->num_rows() != 0)
        {


            return $query->result_array();
        }
        else{
            return FALSE;
        }

    }
}

