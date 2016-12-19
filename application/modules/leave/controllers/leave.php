<?php

if (!defined('BASEPATH'))
    exit
            ('No direct script access allowed');

class leave extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->module('template');
        $this->load->language('leave', 'hindi');
        $this->load->language('leave_approve', 'hindi');        
        $this->load->model("leave_model");
        $this->load->helper('leave_helper');
        authorize();
    }

    public function is_logged_in() {
        if ($this->session->userdata('is_logged_in') === false) {
            redirect("home");
        }
    }

    public function index() {
        no_cache();
        $data = array();

        $data['title'] = $this->lang->line('view_leave');
        $data['page_title'] = $this->lang->line('view_leave');
        $data['leaves'] = $this->leave_model->getLeaves();
        $data['leaves_pending'] = $this->leave_model->get_leaves('pending');
        $data['leaves_approve_deny_cancel'] = $this->leave_model->get_leaves('leaves_approve_deny_cancel');
        //$data['leaves_all'] = $this->leave_model->get_leaves();
        $data['module_name'] = "leave";
        $data['view_file'] = "leave/index";
        $this->template->index($data);
    }

    public function add_leave($id = null) {

        $data['title'] = $this->lang->line('apply_leave');
        $data['page_title'] = $this->lang->line('page_title');
        $data['leaves'] = $this->leave_model->getLeaves();
        if (!empty($id)) {
            $data['user_det'] = $this->leave_model->getSingleEmployee($id);
        }

        $data['module_name'] = "leave";
        $data['view_file'] = "leave/leave_form";
        $this->template->index($data);
    }

    function check_other_department($dept_id, $dept_name) {
        if ($dept_id == 'other') {
            $this->form_validation->set_message('check_other_department', $this->lang->line('file_other_dept_error'));
            return false;
        } else {
            return true;
        }
    }

   
    public function addleave($id = '') {
        $error = $upload_data = '';
        if (isset($_FILES['medical_file']['name']) && !empty($_FILES['medical_file']['name'])) {
            $path = './uploads/medical_files/';
            $config['upload_path'] = $path;
            $config['allowed_types'] = '*';
            $config['max_size'] = '1024';
            //$config['max_width'] = '1024';
            //$config['max_height'] = '768';
            $config['overwrite'] = TRUE;
            $config['encrypt_name'] = TRUE;
            $config['remove_spaces'] = TRUE;
            if (!is_dir($path)) {
                die("THE UPLOAD DIRECTORY DOES NOT EXIST");
            }
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('medical_file')) {
                $error = array('error' => $this->upload->display_errors());
            } else {
                $upload_data = $this->upload->data();
            }
        }
         
        if( $error != '' && $this->input->post('leave_type') == 'hpl' && $this->input->post('head_quoter_type') == 'MG' ){
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>' . $error['error'] . '</div>');
            redirect("leave/add_leave/");
        }        
     
                
        if (!empty($id)) {
            $data['user_det'] = $this->leave_model->getSingleEmployee($id);
        }
        $data['title'] = $this->lang->line('apply_leave');
        $data['page_title'] = $this->lang->line('page_title');
        $data['leave_type'] = $this->input->post('leave_type');
        $this->form_validation->set_rules('days', $this->lang->line('required'), 'required');
        if(!empty($this->input->post('leave_type')) && ($this->input->post('leave_type')!='hq')){
            $this->form_validation->set_rules('start_date', $this->lang->line('required'), 'required');
            $this->form_validation->set_rules('end_date', $this->lang->line('required'), 'required');
	    }
        if (!empty($this->input->post('leave_type')) && ($this->input->post('leave_type') == 'el')) {
            $this->form_validation->set_rules('pay_grade_pay', $this->lang->line('required'), 'required');
            $this->form_validation->set_rules('emp_houserent', $this->lang->line('required'), 'required');
        }
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

        $emp_id_exits = $this->input->post('emp_id') != '' ? $this->input->post('emp_id') : $this->session->userdata('emp_id');
       
        if($this->is_onlevave_holidays($this->input->post('start_date'), $this->input->post('leave_type'))){
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>' . $this->lang->line('leave_not_appliedon_holidays') . '</div>');
            redirect("leave/add_leave/" . $this->input->post('emp_id'));
        }
        
        if($this->input->post('leave_type') == 'el' || $this->input->post('leave_type') == 'hpl'){
            if( $this->leave_model->is_leave_exits($emp_id_exits ,$this->input->post('start_date'),$this->input->post('end_date'),$this->input->post('leave_type'), true )){
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>' . $this->lang->line('leave_notification_message_error') . '</div>');
                redirect("leave/add_leave/" . $this->input->post('emp_id'));
            }
            if( $this->leave_model->check_leave_date_after($emp_id_exits ,$this->input->post('start_date') )){
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>' . $this->lang->line('leave_notification_next_prev_message_error') . '</div>');
                redirect("leave/add_leave/" . $this->input->post('emp_id'));
            } 
            if( $this->leave_model->is_leave_exits_before_holiday($emp_id_exits ,$this->input->post('start_date') )){
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>' . $this->lang->line('leave_notification_next_prev_message_error') . '</div>');
                redirect("leave/add_leave/" . $this->input->post('emp_id'));
            }
        } else if($this->input->post('leave_type') == 'cl' || $this->input->post('leave_type') == 'ol'){
            if( $this->leave_model->is_leave_exits($emp_id_exits ,$this->input->post('start_date'), $this->input->post('end_date'), $this->input->post('leave_type') )){
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>' . $this->lang->line('leave_notification_message_error') . '</div>');
                redirect("leave/add_leave/" . $this->input->post('emp_id'));
            }
            if( $this->leave_model->check_leave_date_after($emp_id_exits ,$this->input->post('start_date'), true )){
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>' . $this->lang->line('leave_notification_next_prev_message_error_ol_cl') . '</div>');
                redirect("leave/add_leave/" . $this->input->post('emp_id'));
            } 
            if( $this->leave_model->is_leave_exits_before_holiday($emp_id_exits ,$this->input->post('start_date'),true )){
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>' . $this->lang->line('leave_notification_next_prev_message_error_ol_cl') . '</div>');
                redirect("leave/add_leave/" . $this->input->post('emp_id'));
            }
           
        } else if($this->input->post('leave_type') == 'ot' || $this->input->post('leave_type') == 'hq'){
			
			  if( $this->leave_model->is_leave_exits($emp_id_exits ,$this->input->post('start_date'),$this->input->post('end_date'),$this->input->post('leave_type'), true )){
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>' . $this->lang->line('leave_notification_message_error') . '</div>');
                redirect("leave/add_leave/" . $this->input->post('emp_id'));
            }
		} 
     
        if ($this->form_validation->run($this) == TRUE) {
             $_leave_type = $this->input->post('leave_type') == 'sl' ? $this->input->post('leave_type_sl') : $this->input->post('leave_type') ; 
            $leave_type = in_array($_leave_type, array('hq','ihpl','sl')) ? 'other' : $_leave_type ; 
           // $leave_type = $this->input->post('leave_type');
            $column_name = $leave_type . '_leave';
            if (!empty($this->input->post('emp_id'))) {

                $leave_rem = $this->leave_model->get_remaining_leaves($this->input->post('emp_id'),$this->input->post('leave_type'),$this->input->post('head_quoter_type'));
                if ($leave_rem < $this->input->post('days')) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>' . $this->lang->line('leave_balance_low_message') . '</div>');
                    redirect('leave/add_leave/' . $this->input->post('emp_id'));
                } else {
                    $data_date = array();
                    $data_all = array(
                        'emp_id' => !empty($this->input->post('emp_id')) ? $this->input->post('emp_id') : $this->session->userdata('emp_id'),
                        'emp_leave_type' => $_leave_type,
                        'emp_leave_no_of_days' => $this->input->post('days'),
                        'emp_leave_date' => date('Y-m-d', strtotime($this->input->post('start_date'))),
                        'emp_leave_end_date' => date('Y-m-d', strtotime($this->input->post('end_date'))),
                        'emp_leave_is_HQ' => $this->input->post('headquoter'),
                        'emp_leave_half_type' => $this->input->post('half_type'),
                        'emp_leave_address' => $this->input->post('address'),
                        'on_behalf_leave' => $this->input->post('on_behalf_id'),
                        'on_behalf_leave' => $this->input->post('on_behalf_id'),
                        'leave_apply' => $this->input->post('leave_way'),
                        'leave_message' => !empty($this->input->post('hq_time')) ? $this->input->post('hq_time') : $this->input->post('leave_message'),
                        'type_of_headquoter' => $this->input->post('head_quoter_type'),
                        'medical_files' => $upload_data != ''  ? $upload_data['orig_name'] : '' ,
                        'emp_leave_HQ_start_date' => date('Y-m-d', strtotime($this->input->post('hd_start_date'))),
                        'emp_leave_HQ_end_date' => date('Y-m-d', strtotime($this->input->post('hd_end_date'))),
                        'sickness_date' => !empty($this->input->post('sickness_date')) ? date('Y-m-d', strtotime($this->input->post('sickness_date'))) : '',
                        'leave_message' => !empty($this->input->post('hq_time')),
                    );
                    
                    if(get_emplyee_role_id($this->session->userdata('emp_id')) <= 15){
                       $data_date = array(
                            'emp_leave_forword_emp_id' => $this->session->userdata('emp_id'),
                            'emp_leave_forword_type' => '1',
                            'emp_leave_forword_date' => date('Y-m-d'),
                            'leave_status' =>  4,
                        );
                    } 
                    
                    $data = array_merge($data_date, $data_all);

                    if (!empty($_FILES['medical_file'])) {
                        $filename = $_FILES['medical_file']['name'];
                        $path = './uploads/medical_files/';
                        uploadalltypeFile($filename, $path);
                    }

                    if ($this->input->post('leave_reason_ddl') != $this->lang->line('leave_reason_other')) {
                        $data['emp_leave_reason'] = $this->input->post('leave_reason_ddl');
                    } else {
                        $data['emp_leave_reason'] = $this->input->post('reason');
                    }
                }
            } else {
               $_leave_type = $this->input->post('leave_type') == 'sl' ? $this->input->post('leave_type_sl') : $this->input->post('leave_type') ; 
               $leave_type = in_array($_leave_type, array('hq','ihpl','sl')) ? 'other' : $_leave_type ;
                //$leave_type = $this->input->post('leave_type');
                $leave_rem = $this->leave_model->get_remaining_leaves('',$this->input->post('leave_type'),$this->input->post('head_quoter_type'));
                $leave_details->$leave_type . '_leave';
                if ($leave_rem < $this->input->post('days')) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>' . $this->lang->line('leave_balance_low_message') . '</div>');
                    redirect('leave/addleave');
                } else {
                    $data_date = array();
                    $data_all = array(
                        'emp_id' => !empty($this->input->post('emp_id')) ? $this->input->post('emp_id') : $this->session->userdata('emp_id'),
                        'emp_leave_type' => $_leave_type,
                        'emp_leave_no_of_days' => $this->input->post('days'),
                        'emp_leave_is_HQ' => $this->input->post('headquoter'),
                        'emp_leave_half_type' => $this->input->post('half_type'),
                        'emp_leave_address' => $this->input->post('address'),
                        'leave_apply' => $this->input->post('leave_way'),
                        'leave_message' => !empty($this->input->post('hq_time')) ? $this->input->post('hq_time') : $this->input->post('leave_message'),
                        'on_behalf_leave' => $this->input->post('on_behalf_id'),
                        'medical_files' => $upload_data != ''  ? $upload_data['orig_name'] : '' ,
                        'emp_leave_HQ_start_date' => date('Y-m-d', strtotime($this->input->post('hd_start_date'))),
                        'emp_leave_HQ_end_date' => date('Y-m-d', strtotime($this->input->post('hd_end_date'))),
                        'sickness_date' => !empty($this->input->post('sickness_date')) ? 
                            date('Y-m-d', strtotime($this->input->post('sickness_date'))) :
                           // $this->input->post('leave_type') == 'hpl' ? 
                           // date('Y-m-d', strtotime($this->input->post('start_date'))) :
                             '' ,
                        'leave_status' =>  2,
                    );
                    
                    if($this->input->post('leave_type') == 'hq'){
                       $data_date = array(
                            'emp_leave_date' => date('Y-m-d', strtotime($this->input->post('hd_start_date'))),
                            'emp_leave_end_date' => date('Y-m-d', strtotime($this->input->post('hd_end_date'))),
                        );
                    } else {
                        $data_date = array(
                            'emp_leave_date' => date('Y-m-d', strtotime($this->input->post('start_date'))),
                            'emp_leave_end_date' => date('Y-m-d', strtotime($this->input->post('end_date'))),
                        );
                    }

                    $data = array_merge($data_date, $data_all);
                       // pr($data);
                    if ($this->input->post('leave_reason_ddl') != $this->lang->line('leave_reason_other')) {
                        $this->input->post('leave_reason_ddl');
                        $data['emp_leave_reason'] = $this->input->post('leave_reason_ddl');
                    } else {
                        $data['emp_leave_reason'] = $this->input->post('reason');
                    }
                }
            }


	    // print_r( $data );die;
            $response = $this->leave_model->insert_leave($data);
            if (!empty($this->input->post('pay_grade_pay')) && !empty($this->input->post('emp_houserent'))) {
                $upt_data = array(
                    'emp_gradpay' => $this->input->post('pay_grade_pay'),
                    'emp_houserent' => $this->input->post('emp_houserent'),
                );
                $this->leave_model->update_employee($upt_data);
            }
            if ($response) {
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable hideauto"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>' . $this->lang->line('success_message') . '</div>');
                redirect('leave');
            }
        }
        $data['leaves'] = $this->leave_model->getLeaves();
        $data['module_name'] = "leave";
        $data['view_file'] = "leave/leave_form";
        $this->
        template->index($data);
    }

    function is_onlevave_holidays($date, $leave_type){
        if(in_array($leave_type, array('cl','ol','el','hpl'))) {
            $date = date('Y-m-d', strtotime($date));
            return check_holidays($date);
        }
    }
    
    function cancel_leave($id) {
        if ($id != '') {
            $response = $this->leave_model->cancel_leave($id);
            if ($response) {
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable hideauto"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>' . $this->lang->line('cancel_leave_success_message') . '</div>');
            }
        }

        $this->index();
    }

    function print_leave($id) {
        if ($id != '') {
            $leave_details = $this->leave_model->getLeave($id);
            if (!empty($leave_details)) {
                if ($leave_details->emp_leave_type == 'el') {
                    $file_name = 'el_form';
                } else if ($leave_details->emp_leave_type == 'child') {
                    $file_name = 'cc_form';
                } else {
                    $file_name = 'all_form';
                }
            }
            $data['module_name'] = "leave";
            $data['view_file'] = "leave/print_leave/" . $file_name;
            $data['leave_details'] = $leave_details;
            $data['title'] = $this->lang->line('print');
            $this->template->index($data);
        } else {

            $this->index();
        }
    }
    function print_order($id) {
        if ($id != '') {
            $leave_details = $this->leave_model->getLeave($id);
            if (!empty($leave_details)) {
              $file_name = 'order';
            }
            $data['module_name'] = "leave";
            $data['view_file'] = "leave/print_leave/" . $file_name;
            $data['leave_details'] = $leave_details;
            $data['title'] = $this->lang->line('print');
            $this->template->index($data);
        } else {
            $this->index();
        }
    }
    

    public function getEmpRemainLeave($emp_id = '') {
        if (!empty($emp_id)) {
            return $this->leave_model->getTotalLeave($emp_id);
        } else {
            return $this->leave_model->getTotalLeave($this->session->userdata('emp_id'));
        }
    }

    function leave_today() {
        $data['module_name'] = "leave";
        $data['view_file'] = "leave/leave_today_list";
        $data['leave_today_list'] = user_leave_today();
        $data['title'] = $this->lang->line('leave_on_today');
        $this->template->index($data);
    }

    public function getleave($leave_id = '') {
        return $this->leave_model->getLeave($leave_id);
    }

    public function modify_leave($leave_id) {
        $leave_details = $this->getleave($leave_id);
        $data['leave_details'] = $leave_details;
        $data['title'] = $this->lang->line('leave_modify_title_menue');
        $data['page_title'] = $this->lang->line('leave_modify_title');
        $data['leaves'] = $this->leave_model->getLeaves();
        if (!empty($leave_details->emp_id)) {
            $data['user_det'] = $this->leave_model->getSingleEmployee($leave_details->emp_id);
        }
        $data['module_name'] = "leave";
        $data['view_file'] = "leave/leave_modify_form";
        $this->template->index($data);
    }

    public function modifyleave() {
        $leave_movement_id = $this->input->post('leave_movement_id');
        $leave_days = $this->input->post('leave_days');
        $leave_data = $this->leave_model->getLeave($leave_movement_id);
        
        $leave_pre_days = $leave_data->emp_leave_no_of_days;
        $leave_type = $leave_data->emp_leave_type;
		$emp_id = $leave_data->emp_id;
		$total_days = $leave_data->emp_leave_no_of_days;
		
        
        $first_date = reset($leave_days);
        $last_date = end($leave_days);
        $days =  count($leave_days);
        $days_diff = $leave_pre_days - $days;
        
        $udata = array(
            'emp_leave_date' => date('Y-m-d', strtotime($first_date)),
            'emp_leave_end_date' => date('Y-m-d', strtotime($last_date)),
            'emp_leave_no_of_days' => $days,
            'emp_leave_deny_reason' => "$days_diff दिन कम किये गए",
        );
        
        deductLeaveAdd($leave_data->emp_id, $leave_type, $days_diff);
        $this->leave_model->updateLeaveMovement($udata, $leave_movement_id);
        
		$leave_remark = getemployeeName($this->session->userdata('emp_id'))." के द्वारा ".getemployeeName($emp_id)."  के  ".leaveType($leave_type, true)." में संशोधन किया गया और $total_days दिन में से $days_diff दिन कम किये गए";
	    set_leave_log($leave_movement_id,$this->session->userdata('emp_id'), $leave_remark);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>' .
        $this->lang->line('leave_notification_message') . '</div>');
        redirect('leave/approve_list');
    }

    function onbehalf_applied(){
        $data['module_name'] = "leave";
        $data['view_file'] = "leave/onbehalf_applied_leaves";
        $data['applied_list'] = $this->leave_model->get_applied_lists();
        $data['title'] = $this->lang->line('list_of_applied_leave');
        $this->template->index($data);
    }
	
	function manage_leave($id){
		$data['title'] = $this->lang->line('leave_manage_title');
        $data['title_tab'] = $this->lang->line('leave_manage_title_tab');
        $data['module_name'] = "leave";
        $data['id'] = $id;
        $data['leave_balance'] = get_list(EMPLOYEE_LEAVE, null, array('emp_id' => $id));
        $data['view_file'] = "leave/manage_leave_balance";
        $this->template->index($data);
	}
	
	function update_leave_balance(){
		$emp_id = $this->input->post('emp_id');
		$this->form_validation->set_rules('cl_leave', $this->lang->line('required'), 'required|max_length[13]');
		$this->form_validation->set_rules('ol_leave', $this->lang->line('required'), 'required|max_length[3]');
		$this->form_validation->set_rules('el_leave', $this->lang->line('required'), 'required');
		$this->form_validation->set_rules('hpl_leave', $this->lang->line('required'), 'required');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		if ($this->form_validation->run($this) == TRUE) {
			$data = array(
				'cl_leave' => $this->input->post('cl_leave'),
				'ol_leave' => $this->input->post('ol_leave'),
				'el_leave' => $this->input->post('el_leave'),
				'hpl_leave' => $this->input->post('hpl_leave'),
			);
			$res = updateData(EMPLOYEE_LEAVE, $data, array('emp_id' => $emp_id));
			if($res){
				$leave_remark = getemployeeName($this->session->userdata('emp_id'))." के द्वारा ".getemployeeName($emp_id)."  के अवकाश में संशोधन किया गया |";
				set_leave_log('',$this->session->userdata('emp_id'), $leave_remark);
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>अवकाश में संशोधन किया गया</div>');
				redirect("leave/employee_list/");
			}
		}
		$this->manage_leave($emp_id);
	}
    
	
	public function under_employees(){
		$data['title'] = $this->lang->line('under_employee_title');
        $data['title_tab'] = $this->lang->line('under_employee_title_tab');
		$data['under_employee_lists'] = $this->leave_model->getUnderEmployeeUser(2);
        $data['module_name'] = "leave";       
        $data['view_file'] = "leave/under_employee_lists";
        $this->template->index($data);
	}
	
	
    public function show_404() {
        $this->load->view('404');
    }

}
