<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_division extends MX_Controller {
    /**
     * created by Raginee patle
     */

     function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('cookie');
        $this->load->model('admin_division_model');
        $this->load->module('template');
         $this->load->language('hindi_division','hindi');
        //$this->load->controller('template/template','admin_template');
    }
    public function isLoggedIn()
    {
        if ($this->session->userdata('admin_logged_in') === TRUE)
        {
            redirect("admin_dashboard");
        }
    }
    public function index()
    {
        $data = array();
        $data['title'] = $this->lang->line('division');
        $data['title_tab'] = $this->lang->line('division_title_tab');
        $data['get_division']=get_list(DIVISION_MASTER,'division_id',null);
       // pre($data['get_section']);
        $data['view_file'] = "admin_division";
        $data['module_name'] = "admin_division";
        $this->template->index($data);
    }

    public function manage_division($id='')
    {
        $data = array();
        $data['title'] = $this->lang->line('division');
		if(empty($id)){
			$data['title_tab'] = $this->lang->line('add_division');
		}else{
			$data['title_tab'] = $this->lang->line('edit_division');
		}
	//	if($id){}
        //$division_data = get_list(DIVISION_MASTER,'division_id',null);
		//$data['division_data'] = $division_data[0];
        $data['view_file'] = "admin_manage_division";
        $data['module_name'] = "admin_division";
        $data['division_data'] = $this->admin_division_model->getdivisionData($id);
        $this->template->index($data);
    }
     public function addUpdatedivision()
    {
        $this->form_validation->set_rules('division_name_hi', 'division_name_hi', 'required');
        $this->form_validation->set_rules('division_name_en', 'division_name_en', 'required|callback_alpha_dash_space');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

        if ($this->form_validation->run($this) === TRUE) {


            if ($this->input->post('division_id')) {
                $division_id = $this->input->post('division_id');
                $data = array(
                    'division_name_hi' => trim($this->input->post('division_name_hi')),
                    'division_name_en' => trim($this->input->post('division_name_en')),
                    
                );
                $response = $this->admin_division_model->updatedivision($data, $division_id);

                if ($response) {
                    $this->session->set_flashdata('update', $this->lang->line('update_success_message'));
                    redirect('admin/division');
                }
            } else {
                $data = array(
                    'division_name_hi' => trim($this->input->post('division_name_hi')),
                    'division_name_en' => trim($this->input->post('division_name_en')),
					
                );
                $response = $this->admin_division_model->adddivision($data);
                if ($response) {
                    $this->session->set_flashdata('insert', $this->lang->line('success_message'));
                    redirect('admin/division');
                }
            }
        }
        else
        {
            $dist_id = $this->input->post('division_id');
            $data = array();
            $data['title'] = "District";
            $data['title_tab'] = "All District list";
            $data['get_division']=get_list(DISTRICT,'division_id',null);
            $data['view_file'] = "admin_manage_division";
            $data['module_name'] = "admin_division";
            $data['divisiondata'] = $this->admin_division_model->getdivisionData($dist_id);
            $data['msg'] = "Please enter valid value";
            $this->template->index($data);

        }
    }
    public function division_delete($delete_id = '')
    {

       echo  $response = $this->admin_division_model->deletedivision( $delete_id );
        if ($response)
        {
            $this->session->set_flashdata('delete','Division deleted sucessfully..!!');
            redirect('admin/division');
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