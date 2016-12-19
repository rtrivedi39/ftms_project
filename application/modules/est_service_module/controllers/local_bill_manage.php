<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Local_bill_manage extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->module('template');
        $this->load->model('est_service_model','service_model');
        $this->load->model('gpfdpf_model');
        $this->lang->load("manage_gpfdpf","hindi");
        $this->load->model('est_category_master_model');
        authorize();
    }
    public function is_logged_in()
    {
        if ($this->session->userdata('is_logged_in') === false)
        {
            redirect("home");
        }
    }
    public function index($id = null)
    {
        $this->is_logged_in();
        $uri3 =  $this->uri->segment(3);
        $uri4 =  $this->uri->segment(4);

        $data['module_name']  = "est_service_module";
        $data['title'] = "बिल ";

        if ($this->uri->segment(2) == 'edit_bill_forms' && $id != null) {
            $data['billdetails'] = $this->service_model->service_emp_bill_data($id);
            $billdetails = $data['billdetails'];
            $data['get_category_bill'] = $this->est_category_master_model->fetch_category_con('31', $billdetails['bill_sub_catid']);
            $data['get_category_bill_con'] = $this->est_category_master_model->fetch_category_condition($billdetails['bill_sub_catid']);
            $data['get_bill_single'] = $data['get_category_bill'][0];

            $data['view_file'] = "est_service_module/forms/bill_forms";
        }else{
            $data['get_category_bill'] = $this->est_category_master_model->fetch_category_con('31', $uri4);
            $data['get_category_bill_con'] = $this->est_category_master_model->fetch_category_condition($uri4);
            $data['get_bill_single'] = $data['get_category_bill'][0];
            // $where_con = "master_category_id IN (121,122,123,124)";
            $data['view_file']     = "est_service_module/forms/bill_forms";
        }
        $data['view_left_sidebar']  = 'admin/left_sidebar';
        $this->template->index($data);
    }

    public function view_fill_from($id = null)
    {
        $this->is_logged_in();
        if($this->uri->segment(4) == 160 || $this->uri->segment(4) == 162 ){
            $data['title']              = $this->lang->line('manage_gpf_title');
            $data['title_tab']          = $this->lang->line('manage_gpf_tab_title');
        }else if($this->uri->segment(4) == 161 || $this->uri->segment(4) == 163 ){
            $data['title']              = $this->lang->line('manage_dpf_title');
            $data['title_tab']          = $this->lang->line('manage_dpf_tab_title');
        }
        $data['is_page_edit']       = FALSE;
        $data['abc']                = '';
        $data['module_name']        = "est_service_module";
        $data['view_file']          = "est_service_module/forms/partfinal_form_est_view";
        $data['view_left_sidebar']  = 'admin/left_sidebar';
        $this->template->index($data);
    }
    public function manage_gpf_dpf($id = null)
    {

        if($this->uri->segment(4) == 160 || $this->uri->segment(4) == 162 ){
            $data['title']              = $this->lang->line('manage_gpf_title');
            $data['title_tab']          = $this->lang->line('manage_gpf_tab_title');
        }else if($this->uri->segment(4) == 161 || $this->uri->segment(4) == 163 ){
            $data['title']              = $this->lang->line('manage_dpf_title');
            $data['title_tab']          = $this->lang->line('manage_dpf_tab_title');
        }

        $data['is_page_edit']       = FALSE;
        $insert_form  =  $this->gpfdpf_model->insert_update_dpf_gpf();
        if($insert_form == true){
            redirect('est_service_module/app_list');
        }else{
            redirect('est_service_module/app_list');
        }
        // $data['module_name']        = "establishment";
        // $data['view_file']          = "establishment/gpf_form_est";
        // $data['view_left_sidebar']  = 'admin/left_sidebar';
        // $this->template->index($data);
    }

    public function work_for_bill(){
        //   $bill_sub_cat = $_GET['bill_sub_cat'];
        $file_ids = $_GET['file_id'];
        $bill_id = $_GET['bill_id'];
        //   $file_status = $_GET['file_status'];

        if($file_ids != '' && $bill_id != ''){
            updateData(FILES, array('file_hardcopy_status' => 'close' , 'file_return' => '2'), array('file_id' => $file_ids));
            updateData('ft_est_local_bills', array('bill_status' => '4'), array('id' => $bill_id));
            redirect('admin_notesheet_master/view_file_notesheet/195/7/'.$file_ids);
            die;
        }
    }

    public function addout_bills($id = null) // water bill , telephone
    {
        if($id != null){
            $this->is_logged_in();

        $data['bill_file_id'] =  $_GET['file_id'] ;
            $uri3 =  $this->uri->segment(3);
            $uri4 =  $this->uri->segment(4);

            $data['module_name']  = "est_service_module";
            $data['title'] = "बिल ";

            if ($this->uri->segment(2) == 'edit_bill_forms' && $id != null) {
                $data['billdetails'] = $this->service_model->service_emp_bill_data($id);
                $billdetails = $data['billdetails'];
                $data['get_category_bill'] = $this->est_category_master_model->fetch_category_con('31', $billdetails['bill_sub_catid']);
                $data['get_category_bill_con'] = $this->est_category_master_model->fetch_category_condition($billdetails['bill_sub_catid']);
                $data['get_bill_single'] = $data['get_category_bill'][0];
                $data['view_file'] = "est_service_module/forms/bill_forms";
            }else{
                $data['get_category_bill'] = $this->est_category_master_model->fetch_category_con('31', $uri4);
                $data['get_category_bill_con'] = $this->est_category_master_model->fetch_category_condition($uri4);
                $data['get_bill_single'] = $data['get_category_bill'][0];
                // $where_con = "master_category_id IN (121,122,123,124)";
                $data['view_file']     = "est_service_module/forms/addout_bill_form";
            }
            $data['view_left_sidebar']  = 'admin/left_sidebar';
            $this->template->index($data);
        }
    }

    public function update_bill_status($id = null)
    {
        $approve_amt = $this->input->post('approve_amt');
        $bill_file_id = $this->input->post('file1');
        $bill_status = $this->input->post('bill_status');
        $bill_id = $this->input->post('bill1') ? $this->input->post('bill1') : null ;
        if($bill_id != '' && $bill_id != null){
            $data_is = array(
                'bill_approve_amount'  	=> convert_currentcy_interger($approve_amt),
                'bill_status'  			=> $bill_status,
                'bill_update_by'        => $this->session->userdata('emp_id'),
                'bill_update_at'        => date('Y-m-d H:i:s'),
            );

            $res =  updateData(EST_LOCAL_BILLS, $data_is, array('id' => $bill_id));
            if($res){
                $this->session->set_flashdata('message', '...');
                redirect($_SERVER['HTTP_REFERER']);
                die;
            }
        }else{
            $this->session->set_flashdata('message', 'Something went wrong...!');
            redirect($_SERVER['HTTP_REFERER']);
            die;
        }

    }

}