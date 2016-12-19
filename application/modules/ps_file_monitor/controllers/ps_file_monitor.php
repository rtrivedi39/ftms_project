<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ps_file_monitor extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->module('template');
        $this->load->model('ps_file_monitor_model');
        $this->lang->load("files","hindi");
        $this->load->language('view_file','hindi');
        authorize();
    }
    public function is_logged_in()
    {
        if ($this->session->userdata('is_logged_in') === false)
        {
            redirect("home");
        }
    }
    public function index($task = null)
    {
        $this->is_logged_in();
        $data['title'] = $this->lang->line('view_file_manue');
        $data['title_tab'] = 'File Monitor';
        $psmonitor_files=$this->ps_file_monitor_model->ps_monitor_files($task,null,null);
        $data['get_files']    = $psmonitor_files;
        $data['module_name']        = "ps_file_monitor";
        $data['view_file']          = "index";
        $data['view_left_sidebar']  = 'admin/left_sidebar';
        $this->template->index($data);
    }
	public function show_404() {
        $this->load->view('404');
    }
}