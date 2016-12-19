<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class View_file_drafting	 extends MX_Controller {
    function __construct() {
        parent::__construct();
        $this->load->module('template');
        $this->load->language('view_file','hindi');
        $this->load->model('drafting_view_file_model','view_file');
      //  $this->load->model('notesheet_model');
        authorize();
    }
    public function index($id=null)
    {
               $section_id = getEmployeeSection();
        $section_explode =  explode(',',$section_id);
        $data = array();
        $data['title'] = $this->lang->line('view_file_manue');
        if ($id == 'return') {
            $data['title_tab'] = $this->lang->line('return_file_show');
        } else if ($id == '1') {
            $data['title_tab'] = $this->lang->line('dealing_file_show');
        } else {
            $data['title_tab'] = $this->lang->line('received_files');
        }
        $data['module_name'] = "view_file_legislative";
        if(in_array('8',$section_explode)) // 8 is dispatch section id.
        {
            $data['get_files'] = $this->view_file->dispatch_getFiles($id);
            $data['view_file'] = "view_file_legislative/dispatch_file_list";

        }else {
            $moveup_down = $id;
            $data['get_files'] = $this->view_file->getFiles($section_explode, $moveup_down);
            $data['view_file'] = "view_file_legislative/drafting_index";
        }
        $data['view_left_sidebar'] = 'admin/left_sidebar';
        $this->template->index($data);
    }


    public function viewDetails($file_id = null)
    {
        if($file_id != null) {
            $data = array();
            $data['title'] = $this->lang->line('view_file_manue');
            $data['title_tab'] = $this->lang->line('view_file_details');
            $data['file_details'] = $this->view_file->getFileDetails($file_id);
            $file_log = $this->view_file->getFiles_log($file_id);
            $data['file_log'] = $file_log;
            $file_movement = $this->view_file->getFiles_movement($file_id);
            $data['file_movement'] = $file_movement;
            // pre($data['file_log']);
            $data['module_name'] = "view_file_legislative";
            $data['view_file'] = "view_file_legislative";
            $this->template->index($data);
        }else{
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    // Send file to DA , Bij
    public function senttoda_action($file_id)
    {   
        $data = array();
        $data['title'] = $this->lang->line('view_file_manue');
        $data['title_tab'] = $this->lang->line('view_file_details');
        $data['file_details']= getFiledata($file_id);
        $data['dealing_name']= $this->view_file->get_DAname(getEmployeeSection(),null);
		if(count($data['dealing_name'])<=0){
			$data['dealing_name']= $this->view_file->get_DAname($data['file_details'][0]['file_mark_section_id'],$data['file_details'][0]['file_received_emp_id']);
		}
        $data['module_name'] = "view_file_legislative";
        $data['view_file'] = "drafting_action_so";
        $this->template->index($data);
    }
    //show file list RP
    public function Dispaly_list($id=null)
    {
        $data = array();
        $data['title'] = $this->lang->line('view_file_manue');
        $section_ids1 = $this->input->get('section_id') ;
       // pr($section_ids1);
        if(isset($section_ids1)){
            $section_ids2 = $section_ids1 ;
        } else { $section_ids2 = null ; }
        if($id != null) {
            $data['page1'] = $id;
            $data['title_tab'] = $this->lang->line('return_files');
            $data['get_files'] = getFiledata_inlist_desc(null,$section_ids2);
        }else {
            $data['title_tab'] = $this->lang->line('received_files');
            $data['get_files'] = getFiledata_inlist_asc(null,$section_ids2);
        }
        $data['module_name'] = "view_file_legislative";
        $data['view_file'] = "view_file_legislative/view_file_list";
        $data['view_left_sidebar'] =  'admin/left_sidebar';
        $this->template->index($data);
    }
    //rp

    public function show_404() {
        $this->load->view('404');
    }
	

}