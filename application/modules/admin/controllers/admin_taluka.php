<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_taluka extends MX_Controller {
    /**
     * created by Raginee patle
     */

     function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('cookie');
        $this->load->model('admin_taluka_model');
        $this->load->module('template');
         $this->load->language('hindi_taluka','hindi');
        //$this->load->controller('template/template','admin_template');
    }
    public function isLoggedIn()
    {
        if ($this->session->userdata('admin_logged_in') === TRUE)
        {
            redirect("admin_dashboard");
        }
    }
    public function index($district_id = null )
    {
	
        $data = array();
        $data['title'] = $this->lang->line('taluka');
        $data['title_tab'] = $this->lang->line('taluka_title_tab');
		$data['get_taluka'] = $this->admin_taluka_model->getTalukafrom_district($district_id);
      
       // pre($data['get_section']);
        $data['view_file'] = "admin_taluka";
        $data['module_name'] = "admin_taluka";
        $this->template->index($data);
    }

    public function manage_taluka($district_id = null  ,$taluka_id = null )
    {
		
        $data = array();
        $data['title'] = $this->lang->line('taluka');
		if(empty($taluka_id)){
			$data['title_tab'] = $this->lang->line('add_taluka');
		}else{
			$data['title_tab'] = $this->lang->line('edit_taluka');
		}
        $taluka_val = $this->admin_taluka_model->getTalukafrom_taluka_id($taluka_id );
		$data['talukadata'] = $taluka_val[0];
		$data['view_file'] = "admin_manage_taluka";
        $data['module_name'] = "admin_taluka";
       // $data['talukadata'] = $this->admin_taluka_model->gettalukaData($taluka_id);
        $this->template->index($data);
    }
     public function addUpdatetaluka()
    {
        $this->form_validation->set_rules('taluka_name_hi', 'taluka_name_hi', 'required');
        $this->form_validation->set_rules('taluka_name_en', 'taluka_name_en', 'required|callback_alpha_dash_space');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

        if ($this->form_validation->run($this) === TRUE) {


            if ($this->input->post('taluka_id')) {
                $taluka_id = $this->input->post('taluka_id');
                $data = array(
					'district_id' => trim($this->input->post('district_id')),
                    'taluka_name_hi' => trim($this->input->post('taluka_name_hi')),
                    'taluka_name_en' => trim($this->input->post('taluka_name_en')),
                    'display' => 'y',
                    'mp' => 'Y',
                );
                $response = $this->admin_taluka_model->updatetaluka($data, $taluka_id);

                if ($response) {
                    $this->session->set_flashdata('update', $this->lang->line('update_success_message'));
                    redirect('admin/taluka/index/'.$this->input->post('district_id'));
                }
            } else {
                $data = array(
					'district_id' => trim($this->input->post('district_id')),
                    'taluka_name_hi' => trim($this->input->post('taluka_name_hi')),
                    'taluka_name_en' => trim($this->input->post('taluka_name_en')),
					'display' => 'y',
                    'mp' => 'Y',
                );
                $response = $this->admin_taluka_model->addtaluka($data);
                if ($response) {
                    $this->session->set_flashdata('insert', $this->lang->line('success_message'));
                   redirect('admin/taluka/index/'.$this->input->post('district_id'));
                }
            }
        }
        else
        {
            $dist_id = $this->input->post('taluka_id');
            $data = array();
            $data['title'] = "District";
            $data['title_tab'] = "All District list";
            $data['get_taluka']=get_list(TAHSIL_MASTER,'taluka_id',null);
            $data['view_file'] = "admin_manage_taluka";
            $data['module_name'] = "admin_taluka";
            $data['talukadata'] = $this->admin_taluka_model->gettalukaData($dist_id);
            $data['msg'] = "Please enter valid value";
            $this->template->index($data);

        }
    }
    public function taluka_delete($district_id =null , $delete_id = '')
    {

       echo  $response = $this->admin_taluka_model->deletetaluka( $delete_id );
        if ($response)
        {
            $this->session->set_flashdata('delete','District deleted sucessfully..!!');
            redirect('admin/taluka/index/'.$district_id);
        }
    }

    function alpha_dash_space($str)
    {
        if(!preg_match("/^([-a-z_ ])+$/i", $str)){
            $this->form_validation->set_message('alpha_dash_space','Please fill valid value');
            return false;
        }
    }

    public function show_404() {
         $this->load->view('404');
     }
}