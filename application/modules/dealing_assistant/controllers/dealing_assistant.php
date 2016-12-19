<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dealing_assistant extends MX_Controller {
     function __construct() {
        parent::__construct();
        $this->load->module('template');
		$this->load->language('dealing_assistant','hindi');
        $this->load->model('dealing_assistant_model','dealing_assistant');
    }
 	public function index()
    {
        $data = array();
        $data['title'] = $this->lang->line('dealing_assistant_manue');
        $data['title_tab'] = $this->lang->line('all_assistant_label'); 
        $data['get_assistant']= $this->dealing_assistant->getdealingAssistant();
        $data['module_name'] = "dealing_assistant";
		$data['view_left_sidebar'] =  'admin/left_sidebar'; 
        $data['view_file'] = "dealing_assistant/index";
        $this->template->index($data);
    }

    public function viewProfile($profile_id)
	{
		$data = array();
        $data['title'] = $this->lang->line('assistant_profile');
        $data['title_tab'] = $this->lang->line('assistant_profile'); 
		
        $data['assistant_details']= $this->dealing_assistant->getAssistantDetails($profile_id);
        $data['module_name'] = "dealing_assistant";
		$data['view_left_sidebar'] =  'admin/left_sidebar'; 
        $data['view_file'] = "dealing_assistant/profile_dealing_assistant";
        $this->template->index($data);
	}
	
	public function viewFile($profile_id)
	{
		$data = array();
        $data['title'] = $this->lang->line('assistant_file');
        $data['title_tab'] = $this->lang->line('assistant_file'); 
		
        $data['assistant_files']= $this->dealing_assistant->getAssistantFiles($profile_id);
        $data['module_name'] = "dealing_assistant";
		$data['view_left_sidebar'] =  'admin/left_sidebar'; 
        $data['view_file'] = "dealing_assistant/view_file";
        $this->template->index($data);	
	}
}