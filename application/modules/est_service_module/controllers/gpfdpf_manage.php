<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Gpfdpf_manage extends MX_Controller {

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
        if($this->uri->segment(2) == 'edit_service_forms' && $id != null){
            $data['title']              = "आवेदन में बदलाव करे ";
            $appdetails =  $this->service_model->service_emp_app_data($id);
            if($appdetails['pay_cateid'] == '52'){ $data['title_tab'] = $this->lang->line('manage_gpf_tab_title'); }
            if($appdetails['pay_cateid'] == '53'){ $data['title_tab'] = $this->lang->line('manage_dpf_tab_title'); }
            $data['appdetails']  =  $appdetails;
        }elseif($this->uri->segment(3) == 52){
		 	$data['title']              = $this->lang->line('manage_gpf_title');
        	$data['title_tab']          = $this->lang->line('manage_gpf_tab_title');
		}else if($this->uri->segment(3) == 53){
			$data['title']              = $this->lang->line('manage_dpf_title');
        	$data['title_tab']          = $this->lang->line('manage_dpf_tab_title');
		}
        $data['is_page_edit']       = FALSE;
        $data['abc']                = '';
        $data['module_name']        = "est_service_module";
        $data['view_file']          = "est_service_module/forms/partfinal_form_est";
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
       // $data['abc']                = '';
        $insert_form  =  $this->gpfdpf_model->insert_update_dpf_gpf();
		if($insert_form == true){
            redirect('est_service_module/app_list');
        }else{
            redirect('est_service_module/app_list');
        }
      //  $data['module_name']        = "establishment";
       // $data['view_file']          = "establishment/gpf_form_est";
      //  $data['view_left_sidebar']  = 'admin/left_sidebar';
      // 	$this->template->index($data);
    }
	
}