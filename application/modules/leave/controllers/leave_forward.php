<?php

if (!defined('BASEPATH'))
    exit
            ('No direct script access allowed');

class Leave_forward extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->module('template');
        $this->load->language('leave', 'hindi');
        $this->load->language('leave_forward', 'hindi');
        $this->load->model("leave_model");
        $this->load->helper('leave_helper');
        //isAdminAuthorize();
    }

    public function is_logged_in() {
        if ($this->session->userdata('is_logged_in') === false) {
            redirect("home");
        }
    }

    public function index() {

        no_cache();
        $data = array();
        $data['title'] = $this->lang->line('approve_leave_manue');
        $data['title_tab'] = $this->lang->line('title');

        $data['under_employee'] = $this->leave_model->getUnderEmployee();
        $data['under_employee_lists'] = $this->leave_model->get_under_forwader_employees();
        //print_r($data['under_employee_lists']);

        if ($this->input->get('type')) {
            $type = $this->input->get('type');
            $data['details_leave'] = $this->leave_model->get_allforword_lists($type);
        } else{
			$data['details_leave'] = $this->leave_model->get_allforword_lists();
		}

        $data['module_name'] = "leave";
        $data['view_file'] = "leave/forward_list";
        $this->template->index(
                $data);
    }

    public function leave_el() {
        no_cache();
        $data = array();
        $data['title'] = $this->lang->line('approve_leave_manue');
        $data['title_tab'] = $this->lang->line('title');
        $data['details_leave'] = $this->leave_model->getAllELLeaves('pending');
        $data['module_name'] = "leave";
        $data['view_file'] = "leave/approve_list_el";
        $this->template->index(
                $data);
    }

    public function approve($leave_id) {

        $leave = $this->leave_model->getLeave($leave_id);
        $emp_id = $leave->emp_id;
        $type = $leave->emp_leave_type;
        $days = $leave->emp_leave_no_of_days;
        deductLeave($emp_id, $type, $days);

        $data = array(
            'emp_leave_approval_emp_id' => $this->session->userdata('emp_id'),
            'emp_leave_approval_type' => '1',
            'emp_leave_approvel_date' => date('Y-m-d h:i:s'),
            'leave_status' =>  4,
        );

        $response = $this->leave_model->updateLeave($leave_id, $data);
        if ($response) {
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable hideauto"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>' . $this->lang->line('update_success_message') . '</div>');
            redirect('leave/leave_forward');
        }
    }

    public function forword_not_leave($leave_id) {

        $data = array(
            'emp_leave_forword_emp_id' => $this->session->userdata('emp_id'),
            'emp_leave_forword_type' => '2',
            'emp_leave_forword_date' => date('Y-m-d h:i:s'),
            'leave_status' =>  4,
        );

        $response = $this->leave_model->updateLeave($leave_id, $data);
        if ($response) {
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable hideauto"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>' . $this->lang->line('update_success_message') . '</div>');
            redirect('leave/leave_forward');
        }
    }

    function deny() {
        $leave_id = $this->input->post('leaveID');
        $data = array(
            'emp_leave_forword_emp_id' => $this->session->userdata('emp_id'),
            'emp_leave_forword_type' => '2',
            'emp_leave_forword_date' => date('Y-m-d H:i:s'),
            'emp_leave_deny_reason' => $this->input->post('deny_reson'),
           // 'leave_status' =>  8,
        );

        $response = $this->leave_model->updateLeave($leave_id, $data);
        if ($response) {
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable hideauto"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>' . $this->lang->line('update_success_message') . '</div>');
            redirect('leave/leave_forward');
        }
    }

    public function bulkAction() {
        $leave_ids = $this->input->post('leave_ids');
        $this->form_validation->set_rules('bultselect', 'कृपया चयन करें', 'required');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        if ($this->form_validation->run($this) === TRUE) {
            foreach ($leave_ids as $leaveid) {
                $data = array(
                    'emp_leave_forword_emp_id' => $this->session->userdata('emp_id'),
                    'emp_leave_forword_type' => $this->input->post('bultselect'),
                    'emp_leave_forword_date' => date('Y-m-d H:i:s'),
                    'leave_status' =>  4,
                );
                $response = $this->leave_model->updateLeave($leaveid, $data);
            }
            if ($response) {
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable hideauto"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>' . $this->lang->line('update_success_message') . '</div>');
                redirect('leave/leave_forward');
            }
        } else {
            $this->index();
        }
    }

    public function getEmployeeLeave() {
        $data['title'] = $this->lang->line('view_all_employee');
        $data['title_tab'] = $this->lang->line('view_all_employee');
        $data['details_leave'] = $this->leave_model->getEmployeeLeave();
        $data['module_name'] = "leave";
        $data['view_file'] = "leave/leave_employee";
        $this->template->index($data);
    }

    public function forword_leave($leave_id = '') {
        $leave = $this->leave_model->getLeave($leave_id);
        $emp_id = $leave->emp_id;
        $type = $leave->emp_leave_type;
        $days = $leave->emp_leave_no_of_days;
        //deductLeave($emp_id , $type ,$days );

        $data = array(
            'emp_leave_forword_emp_id' => $this->session->userdata('emp_id'),
            'emp_leave_forword_type' => '1',
            'emp_leave_forword_date' => date('Y-m-d H:i:s'),
        );
        $response = $this->leave_model->updateLeave($leave_id, $data);
        if ($response) {
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable hideauto"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>' . $this->lang->line('update_success_message') . '</div>');

            redirect('leave/leave_forward');
        }
    }

    public function employeeLeave() {
        $data['title'] = $this->lang->line('leave_employee');
        $data['title_tab'] = $this->lang->line('leave_serach_employee');
        if (isset($_POST['search_type'])) {
            $data['userleaves'] = $this->leave_model->getUser(
                    $this->input->post('search_type'), $this->input->post('seach_value')
            );
        }

        $data['module_name'] = "leave";
        $data['view_file'] = "leave/employee_search_leave"

        ;
        $this->template->index($data);
    }

    public function show_404() {
        $this->load->view('404');
    }

}
