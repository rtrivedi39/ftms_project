<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_tahsil extends MX_Controller {
    /**
     * created by Raginee patle
     */

     function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('cookie');
        $this->load->model('admin_tahsil_model');
        $this->load->module('template');
         $this->load->language('hindi_tahsil','hindi');
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
        $data['title'] = $this->lang->line('tahsil');
        $data['title_tab'] = $this->lang->line('tahsil_title_tab');
		$data['get_tahsil'] = $this->admin_tahsil_model->getTahsilDatafrom_district($district_id);
      
       // pre($data['get_section']);
        $data['view_file'] = "admin_tahsil";
        $data['module_name'] = "admin_tahsil";
        $this->template->index($data);
    }

    public function manage_tahsil($district_id = '' ,$tahsil_id = null )
    {
        $data = array();
        $data['title'] = $this->lang->line('tahsil');
		if(empty($tahsil_id)){
			$data['title_tab'] = $this->lang->line('add_tahsil');
		}else{
			$data['title_tab'] = $this->lang->line('edit_tahsil');
		}
        $data['get_tahsil']=get_list(TAHSIL_MASTER,'tahsil_id',null);
        $data['view_file'] = "admin_manage_tahsil";
        $data['module_name'] = "admin_tahsil";
        $data['tahsildata'] = $this->admin_tahsil_model->gettahsilData($tahsil_id);
        $this->template->index($data);
    }
     public function addUpdatetahsil()
    {
        $this->form_validation->set_rules('tahsil_name_hi', 'tahsil_name_hi', 'required');
        $this->form_validation->set_rules('tahsil_name_en', 'tahsil_name_en', 'required|callback_alpha_dash_space');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

        if ($this->form_validation->run($this) === TRUE) {


            if ($this->input->post('tahsil_id')) {
                $tahsil_id = $this->input->post('tahsil_id');
                $data = array(
					'district_id' => trim($this->input->post('district_id')),
                    'tahsil_name_hi' => trim($this->input->post('tahsil_name_hi')),
                    'tahsil_name_en' => trim($this->input->post('tahsil_name_en')),
                );
                $response = $this->admin_tahsil_model->updatetahsil($data, $tahsil_id);

                if ($response) {
                    $this->session->set_flashdata('update', $this->lang->line('update_success_message'));
                    redirect('admin/tahsil/index/'.$this->input->post('district_id'));
                }
            } else {
                $data = array(
					'district_id' => trim($this->input->post('district_id')),
                    'tahsil_name_hi' => trim($this->input->post('tahsil_name_hi')),
                    'tahsil_name_en' => trim($this->input->post('tahsil_name_en')),
                );
                $response = $this->admin_tahsil_model->addtahsil($data);
                if ($response) {
                    $this->session->set_flashdata('insert', $this->lang->line('success_message'));
                   redirect('admin/tahsil/index/'.$this->input->post('district_id'));
                }
            }
        }
        else
        {
            $dist_id = $this->input->post('tahsil_id');
            $data = array();
            $data['title'] = "District";
            $data['title_tab'] = "All District list";
            $data['get_tahsil']=get_list(TAHSIL_MASTER,'tahsil_id',null);
            $data['view_file'] = "admin_manage_tahsil";
            $data['module_name'] = "admin_tahsil";
            $data['tahsildata'] = $this->admin_tahsil_model->gettahsilData($dist_id);
            $data['msg'] = "Please enter valid value";
            $this->template->index($data);

        }
    }
    public function tahsil_delete($district_id =null , $delete_id = '')
    {

       echo  $response = $this->admin_tahsil_model->deletetahsil( $delete_id );
        if ($response)
        {
            $this->session->set_flashdata('delete','District deleted sucessfully..!!');
            redirect('admin/tahsil/index/'.$district_id);
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