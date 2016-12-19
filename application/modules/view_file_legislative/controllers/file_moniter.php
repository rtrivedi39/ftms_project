<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class File_moniter	 extends MX_Controller {
    function __construct() {
        parent::__construct();
        $this->load->module('template');
        $this->load->language('view_file','hindi');
        $this->load->model('view_file_model','view_file');
        authorize();
    }
    public function index()
    {
        $section_id = getEmployeeSection();
        $section_explode =  explode(',',$section_id);
        $data = array();
        $data['title'] = $this->lang->line('view_file_manue');
        $data['title_tab'] = 'File moniter';
        $data['module_name'] = "view_file";
        $data['get_files'] = file_moniter_byuser();
        $data['view_file'] = "view_file/file_moniter";
        $data['view_left_sidebar'] = 'admin/left_sidebar';
        $this->template->index($data);
    }

}