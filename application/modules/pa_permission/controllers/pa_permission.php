<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pa_permission extends MX_Controller {
    function __construct() {
        parent::__construct();
        $this->load->module('template');
        $this->load->language('pa_permission','hindi');
        $this->load->model('pa_permission_model','pa_permission_model');
		$this->is_logged_in();
    }
    public function index()
    {
        $data = array();
        if(isset($_GET['empid']) && $_GET['empid']!=''){
            $id  = $_GET['empid'];
            $data['id']=$id;
        }else{
            $id=null;
        }
        $data['title'] = $this->lang->line('pa_head_title');
        $data['title_tab'] = $this->lang->line('pa_head_title');
        $data['get_pa_list']= get_officer_pa_list(null,$this->session->userdata('emp_id'));
		// pr($data['get_pa_list']);
        $data['get_permission_list']= get_list(EMPLOYEE_PERMISSION_ALLOTED,null,array('emp_id_assign_by'=>$this->session->userdata('emp_id'),'emp_id_assign_to'=>$id));
       
        $data['module_name'] = "pa_permission";
        $data['view_left_sidebar'] =  'admin/left_sidebar';
        $data['view_file'] = "pa_permission/index";
        $this->template->index($data);
    }
	public function is_logged_in()
    {
        if ($this->session->userdata('is_logged_in') === false)
        {
            redirect("home");
        }
    }
    public  function permission_to_employee(){
        $data['title'] = $this->lang->line('label_endm_allote_permission_to_employee');
        $data['title_tab'] = $this->lang->line('label_endm_allote_permission_to_employee');
        //$data['get_pa_list']= get_officer_pa_list(null,$this->session->userdata('emp_id'));
        //$data['get_permission_list']= get_list(EMPLOYEE_PERMISSION_ALLOTED,null,array('emp_id_assign_by'=>$this->session->userdata('emp_id'),'emp_id_assign_to'=>$id));
        //pre($data['get_permission_list']);
        $data['module_name'] = "pa_permission";
        $data['view_left_sidebar'] =  'admin/left_sidebar';
        $data['view_file'] = "pa_permission/permission_allot";
        $this->template->index($data);
    }

    public function manage_permission(){
        $data = array();
        $id  = $_GET['empid'];
        if ($id == null) {
            $data['id']='';
            $data['is_page_edit'] = 0;
        } else {
            $data['id']=$id;
            $data['is_page_edit'] = 1;
        }
        $this->form_validation->set_rules('emp_id', $this->lang->line('list_label_emp_name'), 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        if ($this->form_validation->run($this) === TRUE) {
            $res = $this->pa_permission_model->manage_pa_permision();
            if(count($res)>0){
                    if($id){
                        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable hideauto"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>' . $this->lang->line('success_message') . '</div>');
                    }else{
                        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable hideauto"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>' . $this->lang->line('update_success_message') . '</div>');
                    }
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable hideauto"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>' . $this->lang->line('record_not_updated') . '</div>');
            }
            redirect("pa/list");
        }else{
            redirect("pa/list");
        }
    }
	
	public function da_manage_permission(){
        $data = array();
        $id  = $_GET['empid'];
        if ($id == null) {
            $data['id']='';
            $data['is_page_edit'] = 0;
        } else {
            $data['id']=$id;
            $data['is_page_edit'] = 1;
        }
        $this->form_validation->set_rules('epa_type',$this->lang->line('assign_role'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('epa_permission_from', $this->lang->line('section_assign_permission_from'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('epa_permission_to', $this->lang->line('section_assign_permission_to'), 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        if ($this->form_validation->run($this) === TRUE) {
            $res = $this->pa_permission_model->manage_da_permision();
            if(count($res)>0){
                    if($id){
                        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable hideauto"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>' . $this->lang->line('success_message') . '</div>');
                    }else{
                        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable hideauto"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>' . $this->lang->line('update_success_message') . '</div>');
                    }
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable hideauto"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>' . $this->lang->line('record_not_updated') . '</div>');
            }
            redirect("permission/allot");
        }else{
            redirect("permission/allot");
        }
    }
	
	function ajax_get_section_employee(){
		$sectionid = $this->input->post('section_id');
		if($sectionid == 7){
			$emp_list[0] = get_establishment_employees();
		}else if(checkUserrole()==8){
            $emp_list[0] = get_list_orderwise(EMPLOYEES,array('col'=>'role_id','order'=>'ASC'),array('emp_is_retired'=>0,'emp_status'=>1,'role_id >='=>8,'emp_section_id like'=>'%'.$sectionid.'%'),null );
        }else{
			$emp_list[0] = get_list_orderwise(EMPLOYEES,array('col'=>'role_id','order'=>'ASC'),array('emp_is_retired'=>0,'emp_status'=>1,'emp_section_id'=>$sectionid),null );
		}
		echo json_encode($emp_list);
        exit();
	}
	function ajax_get_designation_employee(){
		$request_for='';
		$desig_id = $this->input->post('section_id');
		$requesttype = $this->input->post('requesttype');
		$request_for = $this->input->post('rqfor');
		
		if($requesttype=='designation_wise' && $request_for=='' ){
			$emp_list[0] = get_list_orderwise(EMPLOYEES,array('col'=>'role_id','order'=>'ASC'),array('designation_id'=>$desig_id,'emp_is_retired'=>0,'emp_status'=>1),null);
		}else if($requesttype=='designation_wise' && $request_for=='by_designation'){
			//$emp_list[0] = get_list_orderwise(EMPLOYEES,array('col'=>'role_id','order'=>'ASC'),array('emp_section_id'=>$desig_id,'emp_is_retired'=>0,'emp_status'=>1),null);
			$emp_list[0] = get_list_orderwise(EMPLOYEES,array('col'=>'role_id','order'=>'ASC'),array('designation_id >='=>$desig_id,'designation_id <='=>7,'emp_is_retired'=>0,'emp_status'=>1),null);
		}
		echo json_encode($emp_list);
        exit();
	}
	
	function delete_permission($epa_id){
		$res = delete_data(EMPLOYEE_PERMISSION_ALLOTED,array('epa_id'=>$epa_id,));
		$this->session->unset_userdata('today_permission_assign');
		if($res){
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable hideauto"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>' . $this->lang->line('delete_success_message') . '</div>');
		}else{
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable hideauto"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>' . $this->lang->line('record_not_updated') . '</div>');
		}
		
		redirect('permission/allot');
	}
	/*Code 29-09-2015*/
	function add_file(){
		$this->is_logged_in();
		$empdetails = empdetails(emp_session_id());
		$this->lang->load("files","hindi");
		//pre($this->session->all_userdata());
        $data['title']              = $this->lang->line('file_title');
        $data['title_tab']          = $this->lang->line('file_tab_title');
        $data['is_page_edit']       = FALSE;
        $data['abc']                = '';
        $data['module_name']        = "pa_permission";
        $data['view_file']          = "pa_permission/cr_manage_file";
        $data['view_left_sidebar']  = 'admin/left_sidebar';
        $departments_list           = get_list(DEPARTMENTS, null, null);
        $data['departments_list']   = $departments_list;
        $district_list              = get_list(DISTRICT, null, null);
        $data['district_list']      = $district_list;
        $section_list               = get_list(SECTIONS, null, array('section_id !=' =>getEmployeeSection()));
        $data['section_list']       = $section_list;
        $unit_level                 = get_list(UNIT_LEVEL, null, null);
        $data['unit_level']         = $unit_level;
        $data['state_list']         = get_list(STATE_MASTER,null,null);
        $data['head_notesheet']     = get_list(FILE_NOTESHEET_HEADER_MASTER,null,null);
        $this->template->index($data);
	}

	public function manage_files($id = null) {
        $this->lang->load("files","hindi");
        $this->load->model('manage_file/cr_model');
        $data['title']            =  $this->lang->line('file_title');
        $data['title_tab']        = $this->lang->line('file_tab_title');
        if($id == null){
            $data['page_title']   = $this->lang->line('file_tab_title');
            $data['is_page_edit'] = false;
        }else{
            $data['page_title']   = $this->lang->line('file_edit_title');
            $data['is_page_edit'] = true;
            $file_data = get_file($id);
            $data['id'] = $id;
        }
        $mark_unitid = $this->input->post('mark_unitid');

        $this->form_validation->set_rules('check_field', 'check_field', 'required');
        $this->form_validation->set_rules('file_subject', $this->lang->line('file_subject'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('file_uo_number', $this->lang->line('file_uo_number'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('file_uo_date', $this->lang->line('file_uo_date'), 'trim|required|xss_clean');
        
        $this->form_validation->set_rules('file_offer_by','file_offer_by', 'trim|required|xss_clean');
        if($this->input->post('file_offer_by') == 'c' || $this->input->post('file_offer_by') == 'jvn' )
        {
            $this->form_validation->set_rules('district_id', 'district_id', 'trim|required|xss_clean');
        }
        if($this->input->post('file_offer_by') == 'm' || $this->input->post('file_offer_by') == 'u')
        {
            $this->form_validation->set_rules('court_bench', 'court_bench', 'trim|required|xss_clean');
        }
        if($this->input->post('file_offer_by') == 'o')
        {
            $this->form_validation->set_rules('file_department_name', 'file_department_name', 'trim|required|xss_clean');
        }
        $data['postdata']=$this->input->post();
        //pre($data['postdata']);
        if($this->input->post('file_offer_by') == 'v' ){
            $this->form_validation->set_rules('file_department_id', $this->lang->line('file_department'), 'trim|required|xss_clean');
        }
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        if ($this->form_validation->run($this) === TRUE)
        {
            $file_last_number = $this->cr_model->get_file_last_number();
            $section_file_last_number = $this->cr_model->get_file_last_number_sectionwise($this->input->post('file_mark_section_id'));
            //  $sectionid = getuserbyrole($this->input->post('file_mark_section_id'), '8'); // 8 is role id of sectionofficer for identify the user
            $ps_ofsec_markset= get_list_with_column(EMPLOYEES,'emp_id,emp_unique_id',null,array('emp_id'=>emp_session_id()));
            $receiver_emp_id =emp_session_id();
            $crno_ofsec_marksec = '100'; // 100 no for direct mark files
            if($this->input->post('mark_unitid')=='' && emp_session_id()=='2'){
                $mark_unitid='56';
            }
            $empdetails = empdetails(emp_session_id());
            $empunit_id= getunitid($empdetails[0]['role_id']);
            $form_data = array(
               // 'file_mark_section_id'    => $crno_ofsec_marksec,
                'file_received_emp_id'    => $receiver_emp_id,
                'file_sender_emp_id'      => emp_session_id(),
                'file_mark_section_date'  => date('Y-m-d H:i:s'),
                'file_update_date'  => date('Y-m-d H:i:s'),
                'file_level_id'           => '30',   // WORK IN PROGRESS (file_movement_level_master)
                'file_unit_level'         => $empunit_id, // 56 is PS unit id
                'createfile_empid'        => emp_session_id(),
            );
            // pr($form_data);
            $letter_uo_date = strtotime($this->input->post('file_uo_date'));
            if ($this->input->post('judgement_data') == '') {  $judg_dt = '0000-00-00'; } else
            {  $judg_dt = date("Y-m-d", strtotime($this->input->post('judgement_data'))); }
            $form_data_fixed = array(
                'file_number'            => $file_last_number,
                'file_section_serial_no'   => $section_file_last_number,
                'file_uo_or_letter_no'   => $this->input->post('file_uo_number'),
                'file_uo_or_letter_date' => date("Y-m-d", $letter_uo_date),
                'file_type'            => $this->input->post('file_type')==''?0:$this->input->post('file_type'),
                'file_department_id'   => $this->input->post('file_department_id')==''?0:$this->input->post('file_department_id'),
                'file_department_name' => $this->input->post('file_department_name')==''?0:$this->input->post('file_department_name'),
                'section_file_type'     => $this->input->post('section_file_type')==''?0:$this->input->post('section_file_type'),
                'file_district_id'     => $this->input->post('district_id')==''?0:$this->input->post('district_id'),
                'file_state_id'         => $this->input->post('state_id')==''?0:$this->input->post('state_id'),
                'file_subject'         => $this->input->post('file_subject'),
                'court_bench_id'       => $this->input->post('court_bench')==''?0:$this->input->post('court_bench'),
                'file_created_date'    => date('Y-m-d H:i:s'),
                'file_Offer_by'         => $this->input->post('file_offer_by')==''?0:$this->input->post('file_offer_by'),
                'case_parties'          => @$this->input->post('party_petition') ? $this->input->post('party_petition')."-विरुद्ध- ".$this->input->post('Party_name_respondent') : '',
                'courts_name_location'  => $this->input->post('courts_name_location')==''?0:$this->input->post('courts_name_location'),
                'file_judgment_date'    => $judg_dt,
                //  'file_form'             => $this->input->post('from_id'),
                'file_head_id'          => $this->input->post('file_head')==''?0:$this->input->post('file_head'),
                'file_hardcopy_status'  => 'received',
            );
            $final_form_data = array_merge($form_data, $form_data_fixed);
            //  pre($final_form_data);
            if($_FILES['file_upload']){
                $file_upload = uploadalltypeFile('file_upload' , './uploads/documents_file/' );
            } else {
                $file_upload = '';
            }
            $file_log_data1 = array(
                'section_id'  => $crno_ofsec_marksec,
                'to_emp_id'   => $receiver_emp_id,
                'from_emp_id' => emp_session_id(),
                'flog_remark' => 'File Enter in Section',
                'flog_other_remark' => "Subject : ".$this->input->post('file_subject'),
                'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
                'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
                'document_path' => $file_upload
            );
           
            $form_data_move1 = array(
                'fmove_current_user_id'  => $receiver_emp_id,
                'fmove_previous_user_id' => emp_session_id(),
                'fmove_from_unit_id'     => getunitid($empdetails[0]['role_id']),   // Central receipt
                'fmove_to_unit_id'       => $mark_unitid==''?0:$mark_unitid,   // Section officer
            );
            //entry in files_section
            $sectionno = plusone_fileno1($crno_ofsec_marksec);  
            if($sectionno != 0)  { $section_number = $sectionno; }
            else{  $section_number = '1';  }
            $file_section = array(
                'section_id'            => $crno_ofsec_marksec, // login user section id eg-CR
                'section_number'        => $section_number,
                //'filemarked_section_id' =>  , // this is use for section_id but for direct file use '100' .
                'file_type'             => $this->input->post('file_type'),
                'file_mark_date'       => date('Y-m-d H:i:s'),
                'file_created_date'    => date('Y-m-d H:i:s'),
                'file_update_date'     => date('Y-m-d H:i:s'),
            );

            $tt = $this->input->post('files_other_feilds');
            if(!empty($tt['case_no'][0])){
                for($i=0 ; $i < count($tt['case_no']); $i++){
                    foreach ($tt as $a=>$b){
                        if($a == 'case_type'){$val12 = $b[$i]."/";}
                        if($a == 'case_no'){$val12 .= $b[$i]."/";}
                        if($a == 'case_year'){ $val12 .= $b[$i];}
                    }
                    $final_val[] = $val12;
                    $final_val1 = implode(',', $final_val);
                }
            }else{
                $final_val1 = '';
            }
            $file_other_feilds = array(
                'section_id' => $crno_ofsec_marksec,
                'case_no'  => $final_val1,
                'gov_adocate_delhi' => $this->input->post('gov_adocate_delhi'),
                'file_upload' => $file_upload,
            );
            if($id){
                /* $res = updateData(FILES, $form_data, array('file_id'=>$id));
                if($res){
                    $this->session->set_flashdata('message', $this->lang->line('file_update_success_msg'));
                } */
            }else{
                if(isset($receiver_emp_id) && $receiver_emp_id != '' && $receiver_emp_id != null)
                {
                    // INSERT IN FILE AND FILE_LOG AND FILE_MOVEMENT TABLE RP
                    $res = insertData_with_lastid($final_form_data, FILES);
                    if($res) {
                        $file_id1 = array('file_id' => $res);
                        $finallog = array_merge($file_log_data1, $file_id1);
                        insertData($finallog, FILES_LOG);

                        $form_data_move = array_merge($file_section, $file_id1);
                        insertData($form_data_move, FILES_SECTION);

                        $file_id_oth = array('f_file_id' => $res);
                        $file_other = array_merge($file_other_feilds, $file_id_oth);
                        insertData($file_other, FILES_OTHER_FEILDS);

                        $file_id2 = array('fmove_file_id' => $res);
                        $form_data_move = array_merge($form_data_move1, $file_id2);
                        insertData($form_data_move, FILES_MOVEMENT);
						update_file_tbl_for_section_no($res);
                        $this->session->set_flashdata('message', 'फाइल/पत्र :- <b>' . $res . '</b>  सफलतापूर्वक दर्ज की गई,  जिसका  <b > &nbsp;पंजी क्रमांक :- ' . $section_number . '</b>&nbsp; हैं |');
                    }
                } else{ $this->session->set_flashdata('message', '<span class="text-bold">Marked user is not found, try after some time</span>');
                }
            }
            redirect('view_file/Dispaly_list');
        }
        else{
            //   $this->session->set_flashdata('error', $this->lang->line('file_validation_error'));
            $data['abc']                = $this->input->post('file_type');
            $data['val_file_subject']      = $this->input->post('file_subject');
            $data['val_file_uo_number']    = $this->input->post('file_uo_number');
            $data['val_file_type']         = $this->input->post('file_uo_number');
            $data['module_name']           = "pa_permission";
            $departments_list              = get_list(DEPARTMENTS, null, null);
            $data['departments_list']      = $departments_list;
            $district_list                 = get_list(DISTRICT, null, null);
            $data['district_list']         = $district_list;
            $section_list                  = get_list(SECTIONS, null, array('section_id !=' =>getEmployeeSection()));
            $data['section_list']          = $section_list;
            $data['state_list']         = get_list(STATE_MASTER,null,null);
            $data['head_notesheet'] = get_list(FILE_NOTESHEET_HEADER_MASTER,null,null);
            $data['view_file']             = "pa_permission/cr_manage_file";
            $this->template->index($data);
        }
    }
	/*Code 29-09-2015*/

}