<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Suggestion extends MX_Controller {
     function __construct() {
        parent::__construct();
        $this->load->module('template');
        $this->load->model('suggestion_model');
        $this->load->language('suggestion','hindi');
    }
 	public function index()
    {
        $data = array();
		$type = '';
        $data['title'] = $this->lang->line('suggestion_title');
        $data['title_tab'] = $this->lang->line('suggestion_sub_title');
		if ($this->input->get('type')) {
            $type = $this->input->get('type');
		}		
		$data['get_suggestion_list']= $this->suggestion_model->get_suggestion($type);
		
        $data['module_name'] = "suggestions";
        $data['view_file'] = "index";
        $this->template->index($data);
    }
	
	public function add_suggestion()
    {
		$this->form_validation->set_rules('suggestion_subject','suggestion_subject' , 'trim|required');
		$this->form_validation->set_rules('suggestion_containts','suggestion_containts' , 'trim|required');
		
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
 
		if ($this->form_validation->run($this) == TRUE)
		{
            $form_data = array(
                'suggestion_name'    => $this->input->post('suggestion_subject'),
                'suggestion_details'    => $this->input->post('suggestion_containts'),
                'suggestion_emp'    => emp_session_id(),
                'suggestion_status'    => '0',
                'suggestion_createat'    => date('Y-m-d h:i:s'),
              
			);
			$res = insertData($form_data,SUGGESTION);
			if($res){
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable hideauto"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>सुझाव जोड़ दिया गया</div>');
				redirect('suggestions');
			}
        } else{		
			$data = array();
			$data['title'] = $this->lang->line('add_suggestion_title');
			$data['title_tab'] = $this->lang->line('add_suggestion_sub_title');      
			$data['input_data'] = $this->input->post();
			$data['module_name'] = "suggestions";
			$data['view_file'] = 'suggestion_create';
			$this->template->index($data);
		}
    }
	
	public function view_suggestion($id)
    {
        $data = array();
        $data['title'] = $this->lang->line('view_suggestion_title');
        $data['title_tab'] = $this->lang->line('view_suggestion_sub_title');      
		$data['get_suggestion']= $this->suggestion_model->get_single_suggestions($id);
        $data['module_name'] = "suggestions";
        $data['view_file'] = 'suggestion_view';
        $this->template->index($data);
    }
	
	public function finish_suggestion($id)
    {
		$suggestion_data = array(
				'suggestion_status' => '1',		
				'suggestion_solved_by' => emp_session_id(),		
				'suggestion_solved_date' => date('Y-m-d h:i:s'),		
			);			
			$res = updateData(SUGGESTION,$suggestion_data, array('suggestion_id' => $id));
			if($res){
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable hideauto"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>'.$this->lang->line('update_success_message').'</div>');
			}
        redirect('suggestions');
    }
	
	public function print_suggestion($id)
    {
        $data = array();
        $data['title'] = $this->lang->line('finish_suggestion_title');
        $data['title_tab'] = $this->lang->line('finish_suggestion_sub_title');      
		$data['get_suggestion']= $this->suggestion_model->get_single_suggestions($id);     
        $this->load->view('suggestion_print', $data);
    }   
	
	
	public function show_404() {
        $this->load->view('404');
 	}
}