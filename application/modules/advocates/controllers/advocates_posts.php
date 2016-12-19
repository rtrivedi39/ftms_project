<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Advocates_posts extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->module('template');
        $this->load->model('advocates_model', 'advocate_model');
        $this->load->language('admin_user', 'hindi');
        $this->load->language('advocate', 'hindi');
        authorize();
    }

    public function index() {
		$data = array();
        $data['title'] ='अधिवक्ता पोस्ट ';
        $data['title_tab'] = 'सूची';
        $data['advocate_post'] = $this->advocate_model->get_advocate_post();
		//pre($data['get_users']);
        $data['module_name'] = "advocates";
        $data['view_file'] = "advocates/advocates_posts_list";
        $this->template->index($data);
    }

    public function manage_advocate_post($id = null) {
		$data = array();
        $this->load->helper(array('form', 'url'));
        $data['title'] = $this->lang->line('advo_post_title_label');
        $data['title_tab'] = $this->lang->line('manage_emp_sub_heading');
		
		$advocate_details = $this->advocate_model->get_advocate_post_single($id);
	
		$data['advocate_details'] = isset($advocate_details[0])?$advocate_details[0]:'';

        if ($id == null) {
			$data['page_title'] = $this->lang->line('emp_adv_add_heading');
            $data['is_page_edit'] = 1;
        } else {
            $data['page_title'] = $this->lang->line('emp_adv_edit_heading');
            $data['is_page_edit'] = 0;
        }
		$data['id']  = $id; 
		//pre($this->input->post());
		$this->form_validation->set_rules('advocate_post_type', 'advocate_post_type', 'required');
		$this->form_validation->set_rules('approved_posts', 'approved_posts', 'required');
		$this->form_validation->set_rules('state_id', 'state_id', 'required');
		
		$this->form_validation->set_rules('scm_district_id', 'scm_district_id', 'required');
         $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		
		if ($this->form_validation->run($this) == TRUE) {
			$data_advocate_post = array(
					'advocate_type'	=> $this->input->post('advocate_post_type'),
					'approved_posts' => $this->input->post('approved_posts'),
					'filled_posts' => $this->input->post('filled_posts'),
					'vacant_seats' => $this->input->post('vacant_seats'),
					'state_id' 		=> $this->input->post('state_id'),
					'district_id' => $this->input->post('scm_district_id'),
					'tahsil_id'  => $this->input->post('scm_tahsil_id'),
					'taluka_id'  => $this->input->post('scm_taluka_id'),
					'created_empid' =>  emp_session_id(),
					);
					
			$condition_1 = array('advocate_posting_id' => $id );
			if ($id) {
				//pr($data_advocate_post);
					updateData(ADVOCATE_POSTING, $data_advocate_post, $condition_1) ;
					$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable hideauto"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>' . $this->lang->line('update_success_message') . '</div>');
					redirect('advocate/post');
			} else {
					$data_advocate_post['created_date'] = date('y-m-d H-i-s' );
					insertData($data_advocate_post, ADVOCATE_POSTING);
					$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable hideauto"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>' . $this->lang->line('success_message') . '</div>');
					redirect('advocate/post');
					
			}
		}
		$data['module_name'] = "advocates";
        $data['view_file'] = "advocates/advocates_posts";
        $this->template->index($data);
    }

       public function show_404() {
        $this->load->view('404');
    }

   

}
