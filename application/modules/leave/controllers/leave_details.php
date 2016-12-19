<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Leave_details extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->module('template');
        $this->load->language('leave', 'hindi');
        $this->load->model("leave_model");
        $this->load->helper('leave_helper');
        authorize();
    }

    public function is_logged_in() {
        if ($this->session->userdata('is_logged_in') === false) {
            redirect("home");
        }
    }

    public function index($id) {
        $data['title'] = $this->lang->line('leave_detail_title');
        $data['title_tab'] = $this->lang->line('leave_detail_title_tab');
        $data['module_name'] = "leave";
        $data['id'] = $id;
        $data['leave_detail_lists'] = $this->leave_model->get_leaves('','',$id);
        $data['view_file'] = "leave/leave_details";
        $this->template->index($data);
    }
     
    public function show_404() {
        $this->load->view('404');
    }

}
