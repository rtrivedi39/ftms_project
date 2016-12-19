<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Est_service_module extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->module('template');
        $this->lang->load("files","hindi");
        $this->lang->load("manage_gpfdpf","hindi");
        $this->load->model('est_service_model','service_model');
        $this->load->model('est_category_master_model','est_category_master_model');
        $this->load->model('local_bill_module','local_bill_module');
        $this->load->model('gpfdpf_model','gpfdpf_model');
        authorize();
    }

    public function is_logged_in()
    {
        if ($this->session->userdata('is_logged_in') === false)
        {
            redirect("home");
        }
    }

    public function index($allorted_works = null)
    {
        $this->is_logged_in();
        if($allorted_works != null){
            $data['title']              = "आवेदन पर कार्यवाही करें |";
            $data['get_alloted_category'] = $this->service_model->get_alloted_category(emp_session_id());
            $show_masters = $data['get_alloted_category'];
            $data['title_tab']          = $this->lang->line('file_tab_title');
            $data['dis_allort_work'] = true ;
        }else{
            $data['title']              = "आवेदन करें ";
            $data['get_per_cat']        = $this->service_model->service_emp_premission();
            $show_masters               =  $data['get_per_cat'] ;
            $data['title_tab']          = $this->lang->line('file_tab_title');
            $data['dis_allort_work'] = false ;
        }
        $data['show_masters']       = $show_masters ;
        $data['fetch_category_yid'] = $this->est_category_master_model->fetch_category_yid();
        $data['module_name']        = "est_service_detail";
        $data['view_file']          = "index";
        $data['view_left_sidebar']  = 'admin/left_sidebar';
        $this->template->index($data);
    }

    public function app_list($belongs = null , $empid = null)
    {
        $this->is_logged_in();
        $data['title']              = $this->lang->line('file_title');
        $data['title_tab']          = $this->lang->line('file_tab_title');
        $data['app_list']           = $this->service_model->service_emp_app_list($belongs , $empid);
        $data['module_name']        = "est_service_detail";
        $data['view_file']          = "application_list";
        $data['view_left_sidebar']  = 'admin/left_sidebar';
        $this->template->index($data);
    }

    public function create_file_application($pay_id = null)
    {
        $padetails =  $this->service_model->service_emp_app_data($pay_id);

        $datafeed =  $this->gpfdpf_model->file_create_gpf_dpf($pay_id , $padetails);
        if($datafeed == true){
            $this->session->set_flashdata('message', 'आवेदन सफलतापूर्वक स्थापना में  भेजा गई | ');
            redirect($_SERVER['HTTP_REFERER']);
            die;
        }else{
            $this->session->set_flashdata('message', '.... !');
            redirect($_SERVER['HTTP_REFERER']);
            die;
        }
		}

    public function dispaly_application($pay_id = null){
        $appdetails =  $this->service_model->service_emp_app_data($pay_id);
        $this->is_logged_in();
        $data['title']              = "आवेदन";
        $data['title_tab']          = "आवेदन";
        $data['appdetails']        = $appdetails;
        $data['module_name']        = "est_service_detail";
        $data['view_file']          = "forms/partfinal_form_est_view";
        $data['view_left_sidebar']  = 'admin/left_sidebar';
        $this->template->index($data);
    }

    public function get_masers_rules(){
        $app_masterid = $this->input->post('app_master');
        $res_array1 = get_est_mat_attachment($app_masterid);
        echo json_encode($res_array1);
        exit();

    }

    public function create_notesheet_app(){
        $file_ids = $_GET['file_id'];
        $pay_ids = $_GET['pay_id'];
        $rt = updateData(FILES, array('file_hardcopy_status' => 'working'), array('file_id' => $file_ids));
        if($rt){
            updateData('ft_pay_dpf_yearly_amount', array('applied_amnt_adv_status' => '3'), array('pay_id' => $pay_ids));
            redirect('admin_notesheet_master/view_file_notesheet/234/7/'.$file_ids.'?pay_id='.$pay_ids);
            die;
        }
    }

    public function manage_local_bill($id = null)
    {
        $insert_form  =  $this->local_bill_module->insert_update_local_bill();
        if($insert_form == true){
            redirect('est_service_module/app_list');
        }else{
            redirect('est_service_module/app_list');
        }
    }

    public function app_bill_list($belongs = null , $empid = null)
    {
        $this->is_logged_in();
        $data['title']              = "किये गये आवेदन देखे  |";
        $data['title_tab']          = "आवेदन देखे  |";
        $data['app_list']           = $this->service_model->emp_bill_by_group($belongs , $empid);


       // pr($data['app_list']);


        $data['module_name']        = "est_service_detail";
        $data['view_file']          = "local_bill_list";
        $data['view_left_sidebar']  = 'admin/left_sidebar';
        $this->template->index($data);
    }

    public function dispaly_bill_view($bill_id = null ){
        $this->is_logged_in();
        $billdetails =  $this->service_model->service_emp_bill_data($bill_id);
        $data['get_category_bill_con'] = $this->est_category_master_model->fetch_category_condition($billdetails['bill_sub_catid']);
        $data['title']              = "आवेदन";
        $data['title_tab']          = "आवेदन";
        $data['billdetails']        = $billdetails;
        $data['module_name']        = "est_service_detail";
        $data['view_file']          = "forms/bill_forms_view";
        $data['view_left_sidebar']  = 'admin/left_sidebar';
        $this->template->index($data);
    }

    public function create_file_for_bill($bill_id = null)
    {
        $billdetails =  $this->service_model->service_emp_bill_data($bill_id);

        $datafeed =  $this->local_bill_module->file_create_for_bill($bill_id , $billdetails);
        if($datafeed == true){
            $this->session->set_flashdata('message', 'आवेदन सफलतापूर्वक स्थापना में  भेजा गई | ');
            redirect($_SERVER['HTTP_REFERER']);
            die;
        }else{
            $this->session->set_flashdata('message', '.... !');
            redirect($_SERVER['HTTP_REFERER']);
            die;
        }
    }

    public function create_notesheet_for_bill(){
        $bill_sub_cat = $_GET['bill_sub_cat'];
        $file_ids = $_GET['file_id'];
        $bill_id = $_GET['bill_id'];
        $file_status = $_GET['file_status'];

        if($bill_sub_cat == '123'){ // मोबाइल बिल
            if($file_status != 'working'){
              updateData(FILES, array('file_hardcopy_status' => 'working'), array('file_id' => $file_ids));
            }
            updateData(EST_LOCAL_BILLS, array('bill_status' => '3'), 'id IN ('.$bill_id.')');
            redirect('admin_notesheet_master/view_file_notesheet/195/7/'.$file_ids);
            die;
        }elseif($bill_sub_cat == '121'){ // Petrol bill
            if($file_status != 'working'){
                updateData(FILES, array('file_hardcopy_status' => 'working'), array('file_id' => $file_ids));
            }
            updateData(EST_LOCAL_BILLS, array('bill_status' => '3'), 'id IN ('.$bill_id.')');
            redirect('admin_notesheet_master/view_file_notesheet/197/7/'.$file_ids);
            die;
        }elseif($bill_sub_cat == '122'){ // Electricity bill
            if($file_status != 'working'){
               updateData(FILES, array('file_hardcopy_status' => 'working'), array('file_id' => $file_ids));
            }
            updateData('ft_est_local_bills', array('bill_status' => '3'), 'id IN ('.$bill_id.')');
            redirect('admin_notesheet_master/view_file_notesheet/202/7/'.$file_ids);
            die;
        }elseif($bill_sub_cat == '127'){ // वाहन मरम्मद बिल
            if($file_status != 'working'){
               updateData(FILES, array('file_hardcopy_status' => 'working'), array('file_id' => $file_ids));
            }
            updateData('ft_est_local_bills', array('bill_status' => '3'), 'id IN ('.$bill_id.')');
            redirect('admin_notesheet_master/view_file_notesheet/193/7/'.$file_ids);
            die;
        }elseif($bill_sub_cat == '124'){ // Newspaper bill
        echo "notesheet is in process.....";
        // if($file_status != 'working'){
        // updateData(FILES, array('file_hardcopy_status' => 'working'), array('file_id' => $file_ids));
        // }
        // updateData('ft_est_local_bills', array('bill_status' => '3'), array('id' => $bill_id));
        // redirect('admin_notesheet_master/view_file_notesheet/202/7/'.$file_ids);
        // die;
        }
    }

    public function check_for_month($belongs = null , $empid = null)
    {
        $empid = $_POST['emp_id'];
        $master_id = $_POST['master_id'];
        $check_mnt = $_POST['check_mnt'];
        $data_bill = $this->service_model->service_emp_bill_list($master_id , $empid , $check_mnt);
        echo json_encode($data_bill);
        exit();

    }


    public function manage_out_bill_byfile($id = null)
    {
        $insert_form  =  $this->local_bill_module->insert_out_bill_byfile();
        if($insert_form == true){
            redirect('est_service_module/app_list');
        }else{
            redirect('est_service_module/app_list');
        }
    }


}