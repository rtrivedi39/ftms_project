<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Document_path extends MX_Controller {

     function __construct() {
        parent::__construct();
        $this->load->module('template');
        $this->load->language('view_file', 'hindi');
        $this->load->model('notesheet_model');
         authorize();
    }

    public function index($id = null) {
        $data = array();
        $data['title'] = 'Documents Path';
        $data['title_tab'] = 'Section Documents';
		$section_id = getEmployeeSection();
        $data['notesheets_menu_list'] = get_list(NOTESHEET_MASTER_MENU, NULL, array('section_id' => $section_id));
        if ($id) {
            $data['file_dat_show'] = getFiledata($id);
        }
        $data['module_name'] = "view_file";
        $data['view_file'] = "view_file/document_path";
        $data['view_left_sidebar'] = 'admin/left_sidebar';
        $this->template->index($data);
    }

    
}