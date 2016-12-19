<?php
class Est_category_master_model extends CI_Model {
 	function __construct() {
        parent::__construct();
    }
	
    public function fetch_category_yid($category_id='')
    {
        $tbl_category = EST_CATEGORY_MASTER;
        $this->db->select('*');
        $this->db->from($tbl_category);
        if($category_id){
			$this->db->where("$tbl_category.master_category_id", $category_id);
        }
		if(empty($category_id)){
			$this->db->where('parent_category_id IS NULL');
			$this->db->where('active_status','1');
			$this->db->where('master_type !=','module');
		}
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

	public function fetch_subcategory_yid($parent_id = null , $condition = null)
    {
        $tbl_category = EST_CATEGORY_MASTER;

        $this->db->select();
        $this->db->from($tbl_category);
        if($parent_id){
			$this->db->where("$tbl_category.parent_category_id", $parent_id);
        }
        if($condition != null){
            $this->db->where($condition);
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

    public function fetch_category_con($parent_id = null , $condition = null)
    {
        $qry = "SELECT ft_est_master_category.master_category_id , ft_est_master_category.parent_category_id , ft_est_master_category.category_title_en , ft_est_master_category.category_title_hin , ft_est_master_category.active_status , group_concat(concat (con_mst_apply_on,':',con_type,'-',con_condition) separator ',') as mst_con  FROM (`ft_est_master_category`) LEFT JOIN `ft_est_master_conditions` ON `ft_est_master_conditions`.`con_est_mst_id` = `ft_est_master_category`.`master_category_id` WHERE";
        if($parent_id != null){
            $qry .= "`ft_est_master_category`.`parent_category_id` = ".$parent_id;
        }
        if($condition != null){
            $qry .= " and `ft_est_master_category`.`master_category_id` = ".$condition;
        }
        $query = $this->db->query($qry);
        $res_array1 =  $query->result_array();
        if($query->num_rows() != 0)
        {
            return $query->result_array();
        }
        else{
            return FALSE;
        }
    }

    public function fetch_category_condition($condition = null)
    {
        $qry = "SELECT * FROM `ft_est_master_conditions`";
        if($condition != null){
            $qry .= " WHERE `con_est_mst_id` = ".$condition;
        }
        $query = $this->db->query($qry);
        $res_array1 =  $query->result_array();
        if($query->num_rows() != 0)
        {
            return $query->result_array();
        }
        else{
            return FALSE;
        }
    }
}

