<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dispatch_file_list extends MX_Controller {
    function __construct() {
        parent::__construct();
        $this->load->module('template');
        $this->load->language('view_file','hindi');
        $this->load->model('view_file_model','view_file');
        authorize();
    }
    public function index($id=null)
    {
        $data = array();
        $data['title'] = $this->lang->line('view_file_manue');
        $section_id = getEmployeeSection();
       // pr($section_id);
        $section_explode =  explode(',',$section_id);
        $data['title_tab'] = $this->lang->line('return_file_show');
        $data['get_files'] = $this->view_file->dispatch_getFiles();
        $data['module_name'] = "view_file";
        $data['view_file'] = "view_file/dispatch_file_list";
        $data['view_left_sidebar'] =  'admin/left_sidebar';
        $this->template->index($data);
    }

    //rp
    public function return_fileofficer($file_id = null)
    {
        $query = $this->db->query("SELECT `emp_id`,`emp_full_name` FROM `ft_employee` WHERE `emp_id` in (SELECT DISTINCT `fmove_previous_user_id` FROM `ft_file_movements` WHERE `fmove_file_id`=".$file_id." and fmove_id < (SELECT `fmove_id` FROM `ft_file_movements` WHERE `fmove_file_id`=".$file_id." and `fmove_previous_user_id`=".emp_session_id()." LIMIT 1)) and `emp_id` != ".emp_session_id()." order by emp_id asc");
        $res_array =  $query->result_array();
        echo json_encode($res_array);
        exit();
    }
    public function section_da_name()
    {
        $res_1 = $this->view_file->get_DAname(getEmployeeSection());
        echo json_encode($res_1);
        exit();
    }


}