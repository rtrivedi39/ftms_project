<?php

class Est_service_model extends CI_Model {

 	function __construct() {
        parent::__construct();
    }

    public function check_alloted_category($emp_id = '') {
        $query = $this->db->query("SELECT GROUP_CONCAT(est_word_alloted_work_id) as allotted_work FROM ft_est_work_alloted WHERE est_word_alloted_emp_id = '$emp_id' GROUP BY est_word_alloted_emp_id");
         if($query->num_rows() != 0)  {
         return $row = $query->row_array();
        }else{
            return FALSE;
        }
    }

    public function get_alloted_category($emp_id = '') {
        $query = $this->db->query("SELECT ft_est_master_category.* FROM (`ft_est_master_category`) JOIN `ft_est_work_alloted` ON FIND_IN_SET(`ft_est_master_category`.`master_category_id`,`ft_est_work_alloted`.`est_word_alloted_work_id`) WHERE `ft_est_work_alloted`.`est_word_alloted_emp_id` = '$emp_id' && ft_est_master_category.parent_category_id != '' ORDER BY `est_word_alloted_work_id` ASC");
         if($query->num_rows() != 0)
        {
            return $row = $query->result_array();
        }
        else{
            return FALSE;
        }
    }

    public function check_for_gpf_dpf($emp_id = '') // not in use now
    {
        $tab1 = EMPLOYEES;
        $tab2 = PAY_SALARY_CATEGORY;
        $this->db->select("$tab1.emp_full_name_hi ,$tab2.pay_cate_name ,$tab2.pay_parent_id  ,$tab2.pay_cate_gpf ,$tab2.pay_cate_dpf");
        $this->db->from($tab1);
        $this->db->join($tab2, "$tab1.emp_pay_cate_id = $tab2.pay_cate_id", 'left');
        $this->db->where($tab1.'.emp_id',$this->session->userdata['emp_id']);
        $this->db->order_by("$tab2.pay_cate_id", 'ASC');
        $query = $this->db->get();
        if($query->num_rows() != 0)
        {
            $row = $query->result_array();
            return $row ;
        }
        else{
            return FALSE;
        }
    }
    public function service_emp_premission(){
        $tab1 = SERVICE_WORK_PREMISSION;
        $tab2 = EST_CATEGORY_MASTER;
        $this->db->select("$tab1.work_user_empid ,$tab2.master_category_id , $tab1.work_user_uniqueid , $tab1.work_master_id, $tab2.parent_category_id , $tab2.category_title_en , $tab2.category_title_hin ,$tab2.master_pdf_name");
        $this->db->from($tab1);
        $this->db->join($tab2, "$tab1.work_master_id = $tab2.master_category_id", 'left');
        $this->db->where("$tab1.work_user_empid",$this->session->userdata['emp_id']);
        $query = $this->db->get();
        if($query->num_rows() != 0)
        {
            $row = $query->result_array();
            return $row ;
        }
        else{
            return FALSE;
        }
    }

    public function service_emp_app_list($belongs = null , $empid = null){
        $tab1 = PAY_DPF_YEARLY_AMOUNT;
     //   $tab2 = EMPLOYEES;
        $this->db->select("*");
        $this->db->from($tab1);
      //  $this->db->join($tab2, "$tab1.work_master_id = $tab2.master_category_id", 'left');
        if($belongs != null){
            $this->db->where("$tab1.pay_sub_cateid",$belongs);
        }
        if($empid != null){
            $this->db->where("$tab1.pay_emp_id",$empid);
        }else{
            $this->db->where("$tab1.pay_file_id !=",'');
        }
        $query = $this->db->get();
        if($query->num_rows() != 0)
        {
            $row = $query->result_array();
            return $row ;
        }
        else{
            return FALSE;
        }
    }
    public function service_emp_app_data($pay_id = null){
        if($pay_id != null){
            $tab1 = PAY_DPF_YEARLY_AMOUNT;
            $this->db->select("*");
            $this->db->from($tab1);
            $this->db->where("$tab1.pay_id",$pay_id);
            $query = $this->db->get();
            if($query->num_rows() != 0)
            {
                $row = $query->row_array();
                return $row ;
            }
            else{
                return FALSE;
            }

        }
    }
    
        public function get_permission_with_user() {

        $query1 = "SELECT ft_employee.emp_full_name_hi ,ft_employee.emp_title_hi , ft_est_service_work_premission.work_user_empid ,
                    GROUP_CONCAT(ft_est_service_work_premission.work_master_id) as mst_id ,
                    GROUP_CONCAT(ft_est_master_category.category_title_en) as mst_name
                    FROM `ft_est_service_work_premission`
                    LEFT JOIN ft_employee ON ft_est_service_work_premission.work_user_empid = ft_employee.emp_id
                    LEFT JOIN ft_est_master_category ON ft_est_master_category.master_category_id = ft_est_service_work_premission.work_master_id
                    GROUP BY ft_est_service_work_premission.work_user_empid";
        $query = $this->db->query($query1);
         if($query->num_rows() != 0)
        {
            return $row = $query->result_array();
        }
        else{
            return FALSE;
        }
    }

    public function service_emp_bill_list($belongs = null , $empid = null , $check_month = null){
        $tab1 = EST_LOCAL_BILLS;
        //   $tab2 = EMPLOYEES;
        $this->db->select("*");
        $this->db->from($tab1);
        //  $this->db->join($tab2, "$tab1.work_master_id = $tab2.master_category_id", 'left');
        if($belongs != null){
            $this->db->where("$tab1.bill_sub_catid",$belongs);
        }
        if($check_month != null){
            $this->db->where("$tab1.bill_apply_month",$check_month);
        }
        if($empid != null){
            $this->db->where("$tab1.bill_emp_id",$empid);
        }else{
            $this->db->where("$tab1.bill_file_id !=",'');
        }
        $query = $this->db->get();
        if($query->num_rows() != 0)
        {
            $row = $query->result_array();
            return $row ;
        }
        else{
            return FALSE;
        }
    }

    public function service_emp_bill_data($bill_id = null){
        if($bill_id != null){
            $tab1 = EST_LOCAL_BILLS;
            $this->db->select("*");
            $this->db->from($tab1);
            $this->db->where("$tab1.id",$bill_id);
            $query = $this->db->get();
            if($query->num_rows() != 0)
            {
                $row = $query->row_array();
                return $row ;
            }
            else{
                return FALSE;
            }

        }
    }

    public function emp_bill_by_group($belongs = null , $empid = null , $check_month = null){
        $tab1 = EST_LOCAL_BILLS;
        //   $tab2 = EMPLOYEES;
        $this->db->select("GROUP_CONCAT(id) AS id , bill_emp_name , bill_sub_catid , bill_emp_id , bill_emp_unique_id , bill_emp_designation , bill_for , bill_status , bill_file_id , bill_mobile_no , bill_vehicle_no , bill_petrol_lit , bill_electricity_unit , bill_user_house_no , GROUP_CONCAT(bill_apply_amt) AS bill_apply_amt , GROUP_CONCAT(bill_apply_amt_words) AS bill_apply_amt_words , GROUP_CONCAT(bill_apply_month) AS bill_apply_month , GROUP_CONCAT(bill_from_date) AS bill_from_date , GROUP_CONCAT(bill_approve_amount) AS bill_approve_amount , GROUP_CONCAT(bill_to_date) AS bill_to_date");
        $this->db->from($tab1);
        //  $this->db->join($tab2, "$tab1.work_master_id = $tab2.master_category_id", 'left');
        if($belongs != null){
            $this->db->where("$tab1.bill_sub_catid",$belongs);
        }
        if($check_month != null){
            $this->db->where("$tab1.bill_apply_month",$check_month);
        }
        if($empid != null){
            $this->db->where("$tab1.bill_emp_id",$empid);
        }else{
            $this->db->where("$tab1.bill_file_id !=",'');
        }
        $this->db->group_by('bill_grouping');
        $query = $this->db->get();
     //   echo $this->db->last_query();
        if($query->num_rows() != 0)
        {
            $row = $query->result_array();
            return $row ;
        }
        else{
            return FALSE;
        }
    }


}

