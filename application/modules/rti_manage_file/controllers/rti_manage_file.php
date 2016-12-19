<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Rti_manage_file extends MX_Controller {
    function __construct() {
        parent::__construct();
        $this->load->module('template');
        $this->load->language('pa_permission','hindi');
        $this->load->language('view_file','hindi');
        $this->load->model('rti_manage_model','rti_model');
		$this->is_logged_in();
    }
   	public function is_logged_in()
    {
        if ($this->session->userdata('is_logged_in') === false)
        {
            redirect("home");
        }
    }
	
	public function view_created_file()
    {
        $data = array();
        $data['title'] = $this->lang->line('view_file_manue');
        $user_id =  emp_session_id();
		$data['title_tab'] = $this->lang->line('return_file_show');
		$data['get_files'] = $this->rti_model->all_rti_files($user_id);
        $data['module_name'] = "rti_manage_file";
        $data['view_file'] = "rti_manage_file/index";
        $this->template->index($data);
    }
	/*Code 29-09-2015*/
	function add_file($fileid=null){
		$this->is_logged_in();
		$this->lang->load("files","hindi");
		$sectionid= getEmployeeSection();
        $data['title']              = $this->lang->line('file_title');
        $data['title_tab']          = $this->lang->line('file_tab_title');
        $data['is_page_edit']       = FALSE;
        $data['abc']                = '';
        $data['module_name']        = "rti_manage_file";
        
        $data['view_left_sidebar']  = 'admin/left_sidebar';
        $departments_list           = get_list(DEPARTMENTS, null, null);
        $data['departments_list']   = $departments_list;
        $district_list              = get_list(DISTRICT, null, null);
        $data['district_list']      = $district_list;
        $section_list               = get_list(SECTIONS, null);
        $data['section_list']       = $section_list;
        $unit_level                 = get_list(UNIT_LEVEL, null, null);
        $data['unit_level']         = $unit_level;
        $data['state_list']         = get_list(STATE_MASTER,null,null);
        $data['head_notesheet']     = get_list(FILE_NOTESHEET_HEADER_MASTER,null,null);
		if(isset($fileid) && $fileid!=''){
			$data['file_detail']= getFiledata($fileid) ;
			$data['file_more_detail']= get_list(FILES_OTHER_FEILDS,null,array('f_file_id'=>$data['file_detail'][0]['file_id']));
		}
		if(!$this->input->post()){
			$data['file_type']= ''; $data['applicant_firm_name']= ''; $data['firm_contact_no']= ''; 
			$data['rti_file_fee']= '';	$data['val_file_subject']= ''; 	$data['file_offer_by']= '';	
			$data['file_department_name']= '';
		}
		//pre($this->input->post());
		$data['id']=$fileid;
		$data['view_file']          = "rti_manage_file/rti_manage_file";
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
            $file_data = getFiledata($id);
            $data['id'] = $id;
        }
		$mark_unitid = $this->input->post('mark_unitid');
		
        $this->form_validation->set_rules('check_field', 'check_field', 'required');
        $this->form_validation->set_rules('file_subject', $this->lang->line('file_subject'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('rti_file_applicant_firm_name', $this->lang->line('rti_file_applicant_firm_name'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('rti_file_applicant_firm_contact_no', $this->lang->line('rti_file_applicant_firm_contact_no'), 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        if ($this->form_validation->run($this) === TRUE)
        {
			$file_last_number = $this->cr_model->get_file_last_number();
			$section_file_last_number = $this->cr_model->get_file_last_number_sectionwise($this->input->post('file_mark_section_id'));
            //  $sectionid = getuserbyrole($this->input->post('	'), '8'); // 8 is role id of sectionofficer for identify the user
            if($this->input->post('mark_file_section_id')!=''){
				//echo $this->input->post('mark_file_section_id').'-'.$this->input->post('mark_unitid');
				$receiver_id = getmarkeduser($this->input->post('mark_file_section_id'),$this->input->post('mark_unitid'));
				$receiver_emp_id = $receiver_id['emp_id'];
                $crno_ofsec_marksec = $this->input->post('mark_file_section_id');
            }
		    //pre($receiver_emp_id);
			$form_data = array(
                'file_mark_section_id'    => $crno_ofsec_marksec,
                'file_received_emp_id'    => $receiver_emp_id,
                'file_sender_emp_id'      => emp_session_id(),
                'file_mark_section_date'  => date('Y-m-d H:i:s'),
                'file_update_date'  => date('Y-m-d H:i:s'),
                'file_level_id'           => '30',   // WORK IN PROGRESS (file_movement_level_master)
                'file_unit_level'         => '51', // 0 is section  to sectio unit id
                'createfile_empid'        => emp_session_id(),
                 'file_hardcopy_status'=>  'working',
            );
            // pr($form_data);
            //$letter_uo_date = strtotime($this->input->post('file_uo_date'));
            // if ($this->input->post('judgement_data') == '') {  $judg_dt = ''; } else
            // {  $judg_dt = date("Y-m-d", strtotime($this->input->post('judgement_data'))); }
            $section_exp = explode(',',getEmployeeSection()); 
            $form_data_fixed = array(
                'file_number'            => $file_last_number,
				'file_section_serial_no'   => $section_file_last_number,
                //'file_uo_or_letter_no'   => $this->input->post('file_uo_number'),
                //'file_uo_or_letter_date' => date("Y-m-d", $letter_uo_date),
                'file_type'            => $this->input->post('file_type')==''?0:$this->input->post('file_type'),
                'file_from_section_id' => $section_exp[0],
                'file_department_id'   => $this->input->post('file_department_id')==''?0:$this->input->post('file_department_id'),
                'file_department_name' => $this->input->post('file_department_name')==''?0:$this->input->post('file_department_name'),
                'section_file_type' 	=> $this->input->post('section_file_type')==''?0:$this->input->post('section_file_type'),
                'file_district_id'     => $this->input->post('district_id')==''?0:$this->input->post('district_id'),
                'file_state_id'         => $this->input->post('state_id')==''?0:$this->input->post('state_id'),
                'file_subject'         => $this->input->post('file_subject'),
                'court_bench_id'       => $this->input->post('court_bench')==''?0:$this->input->post('court_bench'),
                'file_created_date'    => date('Y-m-d H:i:s'),
                'file_Offer_by'         => $this->input->post('file_offer_by')==''?0:$this->input->post('file_offer_by'),
                //'case_parties'          => @$this->input->post('party_petition') ? $this->input->post('party_petition')."-विरुद्ध- ".$this->input->post('Party_name_respondent') : '',
                //'courts_name_location'  => $this->input->post('courts_name_location'),
                //  'file_form'             => $this->input->post('from_id'),
				'file_return'            => '0',
            );
            $final_form_data = array_merge($form_data, $form_data_fixed);
            //  pre($final_form_data);
           /* if($_FILES['file_upload']){
                $file_upload = uploadalltypeFile('file_upload' , './uploads/documents_file/' );
            } else {
                $file_upload = '';
            }*/
            $file_log_data1 = array(
                'section_id'  => $crno_ofsec_marksec,
                'to_emp_id'   => $receiver_emp_id,
                'from_emp_id' => emp_session_id(),
                'flog_remark' => 'File Enter in Section',
                'flog_other_remark' => "Subject : ".$this->input->post('RTI_tip'),
                'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
                'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
                'document_path' => $file_upload
            );
            $empdetails = empdetails(emp_session_id());
            $form_data_move1 = array(
                'fmove_current_user_id'  => $receiver_emp_id,
                'fmove_previous_user_id' => emp_session_id(),
                'fmove_from_unit_id'     => getunitid($empdetails[0]['role_id'])==''?0:getunitid($empdetails[0]['role_id']),   // Central receipt
                'fmove_to_unit_id'       => $mark_unitid==''?0:$mark_unitid,   // Section officer
            );
            //entry in files_section
            $sectionno = plusone_fileno1($empdetails[0]['emp_section_id']);
            if($sectionno != 0)  { $section_number = $sectionno; }
            else{  $section_number = '1';  }
            $file_section = array(
                'section_id'            => $empdetails[0]['emp_section_id'], // login user section id eg-CR
                'section_number'        => $section_number,
                'filemarked_section_id' => $crno_ofsec_marksec , // this is use for section_id but for direct file use '100' .
                'file_type'             => $this->input->post('file_type'),
                'file_mark_date'       => date('Y-m-d H:i:s'),
                'file_created_date'    => date('Y-m-d H:i:s'),
                'file_update_date'     => date('Y-m-d H:i:s'),
            );
			//pr($file_section);
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
				'applicant_name' => $this->input->post('rti_file_applicant_firm_name'),
				'rti_applicant_contactno' =>$this->input->post('rti_file_applicant_firm_contact_no'),
				'rti_application_fee' => $this->input->post('rti_file_fee'),
				'pay_serial_no_rti' => $this->input->post('rti_file_serial_no'),
				'hearing_date_rti' => date('Y-m-d' , strtotime($this->input->post('hearing_date'))),
            );
			if($id){
				//file_number
				//file_section_serial_no
				$res = updateData(FILES, $final_form_data, array('file_id'=>$id));
				updateData(FILES_OTHER_FEILDS,$file_other_feilds,array('f_file_id'=>$id));
				updateData(FILES_LOG,$file_log_data1,array('file_id'=>$id));
                if($res){
					update_file_tbl_for_section_no($id);
                    $this->session->set_flashdata('message', $this->lang->line('file_update_success_msg'));
                } 
            }else
			{
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
						update_file_tbl_for_section_no($id);
                        $this->session->set_flashdata('message', 'फाइल/पत्र :- <b>' . $res . '</b>  सफलतापूर्वक दर्ज की गई,  जिसका  <b > &nbsp;पंजी क्रमांक :- ' . $section_number . '</b>&nbsp; हैं |');
                    }
                } else{ $this->session->set_flashdata('message', '<span class="text-bold">Marked user is not found, try after some time</span>');
                }
            }
			$emp_id = emp_session_id();
			$empdetails = empdetails($emp_id) ;
		
			
			$so_and_above_officer = array(3,4,5,6,7,8);
			
			if(in_array($empdetails[0]['role_id'] ,$so_and_above_officer  )){
				redirect('rti/view_file');
			}else{
				redirect('rti/show_all_rti');
			}
			
			
           
        }
		else{
            //   $this->session->set_flashdata('error', $this->lang->line('file_validation_error'));
            $data['file_type']              = $this->input->post('file_type');
            $data['val_file_subject']      	= $this->input->post('file_subject');
            $data['applicant_firm_name']    = $this->input->post('rti_file_applicant_firm_name');
            $data['firm_contact_no']        = $this->input->post('rti_file_applicant_firm_contact_no');
            $data['rti_file_fee']         	= $this->input->post('rti_file_fee');
            $data['RTI_tip']         		= $this->input->post('RTI_tip');
            $departments_list              	= get_list(DEPARTMENTS, null, null);
            $data['departments_list']      	= $departments_list;
            $district_list                 	= get_list(DISTRICT, null, null);
            $data['district_list']         	= $district_list;
            $section_list                  	= get_list(SECTIONS, null, array('section_id !=' =>getEmployeeSection()));
            $data['section_list']          	= $section_list;
            $data['state_list']         	= get_list(STATE_MASTER,null,null);
            $data['head_notesheet'] 		= get_list(FILE_NOTESHEET_HEADER_MASTER,null,null);
            $data['module_name']           	= "rti_manage_file";
            $data['view_file']             	= "rti_manage_file/rti_manage_file";
            $this->template->index($data);
        }
    }
	/*Code 29-09-2015*/
	
	
	public function update_files($id = null) {
		
		
		
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
            $file_data = getFiledata($id);
            $data['id'] = $id;
        }
		$mark_unitid = $this->input->post('mark_unitid')==''?0:$this->input->post('mark_unitid');
		
        $this->form_validation->set_rules('check_field', 'check_field', 'required');
        $this->form_validation->set_rules('file_subject', $this->lang->line('file_subject'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('rti_file_applicant_firm_name', $this->lang->line('rti_file_applicant_firm_name'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('rti_file_applicant_firm_contact_no', $this->lang->line('rti_file_applicant_firm_contact_no'), 'trim|required|xss_clean');
        
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        if ($this->form_validation->run($this) === TRUE)
        {
		
			
			$section_file_last_number = $this->cr_model->get_file_last_number_sectionwise($this->input->post('file_mark_section_id'));
            //  $sectionid = getuserbyrole($this->input->post('	'), '8'); // 8 is role id of sectionofficer for identify the user
            if($this->input->post('mark_file_section_id')!=''){
				//echo $this->input->post('mark_file_section_id').'-'.$this->input->post('mark_unitid');
				$receiver_id = getmarkeduser($this->input->post('mark_file_section_id'),$this->input->post('mark_unitid'));
				$receiver_emp_id = $receiver_id['emp_id'];
                $crno_ofsec_marksec = $this->input->post('mark_file_section_id');
            }
		    //pre($receiver_emp_id);
			$form_data = array(
              //  'file_mark_section_id'    => $crno_ofsec_marksec,
                //'file_received_emp_id'    => $receiver_emp_id,
               // 'file_sender_emp_id'      => emp_session_id(),
               /// 'file_mark_section_date'  => date('Y-m-d H:i:s'),
                'file_update_date'  => date('Y-m-d H:i:s'),
                'file_level_id'           => '30',   // WORK IN PROGRESS (file_movement_level_master)
                'file_unit_level'         => '51', // 0 is section  to sectio unit id
               // 'createfile_empid'        => emp_session_id(),
                'file_hardcopy_status'=>  'working',
            );
             //pr($form_data);
            //$letter_uo_date = strtotime($this->input->post('file_uo_date'));
            // if ($this->input->post('judgement_data') == '') {  $judg_dt = ''; } else
            // {  $judg_dt = date("Y-m-d", strtotime($this->input->post('judgement_data'))); }
            $form_data_fixed = array(
               
				'file_section_serial_no'   => $section_file_last_number,
                //'file_uo_or_letter_no'   => $this->input->post('file_uo_number'),
                //'file_uo_or_letter_date' => date("Y-m-d", $letter_uo_date),
                'file_type'            => $this->input->post('file_type'),
                'file_department_id'   => $this->input->post('file_department_id')==''?0:$this->input->post('file_department_id'),
                'file_department_name' => $this->input->post('file_department_name'),
                'section_file_type' 	=> $this->input->post('section_file_type'),
                'file_district_id'     => $this->input->post('district_id')==''?0:$this->input->post('district_id'),
                'file_state_id'         => $this->input->post('state_id')==''?0:$this->input->post('state_id'),
                'file_subject'         => $this->input->post('file_subject'),
                'court_bench_id'       => $this->input->post('court_bench')==''?0:$this->input->post('court_bench'),
               // 'file_created_date'    => date('Y-m-d H:i:s'),
                'file_Offer_by'         => $this->input->post('file_offer_by'),
               
				'file_return'            => '0',
            );
            $final_form_data = array_merge($form_data, $form_data_fixed);
              //pr($final_form_data);
            if(isset($_FILES['file_upload'])){
                $file_upload = uploadalltypeFile('file_upload' , './uploads/documents_file/' );
            } else {
                $file_upload = '';
            }
            $file_log_data1 = array(
                'section_id'  => $crno_ofsec_marksec,
               // 'to_emp_id'   => $receiver_emp_id,
               // 'from_emp_id' => emp_session_id(),
                'flog_remark' => 'File Enter in Section',
                'flog_other_remark' => "Subject : ".$this->input->post('RTI_tip'),
                'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
                'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
                'document_path' => $file_upload
            );
            $empdetails = empdetails(emp_session_id());
           
            $sectionno = plusone_fileno1($empdetails[0]['emp_section_id']);
            if($sectionno != 0)  { $section_number = $sectionno; }
            else{  $section_number = '1';  }
            $file_section = array(
                'section_id'            => $empdetails[0]['emp_section_id'], // login user section id eg-CR
                'section_number'        => $section_number,
                'filemarked_section_id' => $crno_ofsec_marksec , // this is use for section_id but for direct file use '100' .
                'file_type'             => $this->input->post('file_type'),
				'file_update_date'     => date('Y-m-d H:i:s'),
            );
			//pr($file_section);
            $tt = $this->input->post('files_other_feilds');
            
            $file_other_feilds = array(
                'section_id' => $crno_ofsec_marksec,
				'gov_adocate_delhi' => $this->input->post('gov_adocate_delhi'),
                'file_upload' => $file_upload,
				'applicant_name' => $this->input->post('rti_file_applicant_firm_name'),
				'rti_applicant_contactno' =>$this->input->post('rti_file_applicant_firm_contact_no'),
				'rti_application_fee' => $this->input->post('rti_file_fee'),
				'pay_serial_no_rti' => $this->input->post('rti_file_serial_no'),
				'hearing_date_rti' => date('Y-m-d' , strtotime($this->input->post('hearing_date'))),
            );
			if($id){
				
				$res = updateData(FILES, $final_form_data, array('file_id'=>$id));
				updateData(FILES_OTHER_FEILDS,$file_other_feilds,array('f_file_id'=>$id));
				updateData(FILES_LOG,$file_log_data1,array('file_id'=>$id));
                if($res){
                    $this->session->set_flashdata('message', $this->lang->line('file_update_success_msg'));
                } 
            }
			
			$emp_id = emp_session_id();
			$empdetails = empdetails($emp_id) ;
		
			
			$so_and_above_officer = array(3,4,5,6,7,8);
			if(in_array($empdetails[0]['role_id'] ,$so_and_above_officer  )){
				redirect('rti/view_file');
			}else{
				redirect('view_file/dealing_file');
			}
			
        }
		
	}
	
	public function update_files_from_da($id = null) {
		
		
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
            $file_data = getFiledata($id);
            $data['id'] = $id;
        }
		$mark_unitid = $this->input->post('mark_unitid');
		
        $this->form_validation->set_rules('check_field', 'check_field', 'required');
        $this->form_validation->set_rules('file_subject', $this->lang->line('file_subject'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('rti_file_applicant_firm_name', $this->lang->line('rti_file_applicant_firm_name'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('rti_file_applicant_firm_contact_no', $this->lang->line('rti_file_applicant_firm_contact_no'), 'trim|required|xss_clean');
        
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        if ($this->form_validation->run($this) === TRUE)
        {
		
			
			$section_file_last_number = $this->cr_model->get_file_last_number_sectionwise($this->input->post('file_mark_section_id'));
            //  $sectionid = getuserbyrole($this->input->post('	'), '8'); // 8 is role id of sectionofficer for identify the user
            if($this->input->post('mark_file_section_id')!=''){
				//echo $this->input->post('mark_file_section_id').'-'.$this->input->post('mark_unitid');
				$receiver_id = getmarkeduser($this->input->post('mark_file_section_id'),$this->input->post('mark_unitid'));
				$receiver_emp_id = $receiver_id['emp_id'];
                $crno_ofsec_marksec = $this->input->post('mark_file_section_id');
            }
		    //pre($receiver_emp_id);
			$form_data = array(
              //  'file_mark_section_id'    => $crno_ofsec_marksec,
                //'file_received_emp_id'    => $receiver_emp_id,
               // 'file_sender_emp_id'      => emp_session_id(),
               /// 'file_mark_section_date'  => date('Y-m-d H:i:s'),
                'file_update_date'  => date('Y-m-d H:i:s'),
                'file_level_id'           => '30',   // WORK IN PROGRESS (file_movement_level_master)
                'file_unit_level'         => '51', // 0 is section  to sectio unit id
                 'file_hardcopy_status'  => 'working',
            );
            // pr($form_data);
            //$letter_uo_date = strtotime($this->input->post('file_uo_date'));
            // if ($this->input->post('judgement_data') == '') {  $judg_dt = ''; } else
            // {  $judg_dt = date("Y-m-d", strtotime($this->input->post('judgement_data'))); }
            $form_data_fixed = array(
               
				'file_section_serial_no'   => $section_file_last_number,
                //'file_uo_or_letter_no'   => $this->input->post('file_uo_number'),
                //'file_uo_or_letter_date' => date("Y-m-d", $letter_uo_date),
                'file_type'            => $this->input->post('file_type'),
                'file_department_id'   => $this->input->post('file_department_id'),
                'file_department_name' => $this->input->post('file_department_name'),
                'section_file_type' 	=> $this->input->post('section_file_type'),
                'file_district_id'     => $this->input->post('district_id'),
                'file_state_id'         => $this->input->post('state_id'),
                'file_subject'         => $this->input->post('file_subject'),
                'court_bench_id'       => $this->input->post('court_bench'),
               // 'file_created_date'    => date('Y-m-d H:i:s'),
                'file_Offer_by'         => $this->input->post('file_offer_by'),
              
				'file_return'            => '0',
            );
            $final_form_data = array_merge($form_data, $form_data_fixed);
             // pr($final_form_data);
            if(isset($_FILES['file_upload'])){
                $file_upload = uploadalltypeFile('file_upload' , './uploads/documents_file/' );
            } else {
                $file_upload = '';
            }
            $file_log_data1 = array(
                'section_id'  => $crno_ofsec_marksec,
               // 'to_emp_id'   => $receiver_emp_id,
               // 'from_emp_id' => emp_session_id(),
                'flog_remark' => 'File Enter in Section',
                'flog_other_remark' => "Subject : ".$this->input->post('RTI_tip'),
                'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
                'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
                'document_path' => $file_upload
            );
            $empdetails = empdetails(emp_session_id());
           
            $sectionno = plusone_fileno1($empdetails[0]['emp_section_id']);
            if($sectionno != 0)  { $section_number = $sectionno; }
            else{  $section_number = '1';  }
            $file_section = array(
                'section_id'            => $empdetails[0]['emp_section_id'], // login user section id eg-CR
                'section_number'        => $section_number,
                'filemarked_section_id' => $crno_ofsec_marksec , // this is use for section_id but for direct file use '100' .
                'file_type'             => $this->input->post('file_type'),
				'file_update_date'     => date('Y-m-d H:i:s'),
            );
			//pr($file_section);
            $tt = $this->input->post('files_other_feilds');
            
            $file_other_feilds = array(
                'section_id' => $crno_ofsec_marksec,
				'gov_adocate_delhi' => $this->input->post('gov_adocate_delhi'),
                'file_upload' => $file_upload,
				'applicant_name' => $this->input->post('rti_file_applicant_firm_name'),
				'rti_applicant_contactno' =>$this->input->post('rti_file_applicant_firm_contact_no'),
				'rti_application_fee' => $this->input->post('rti_file_fee'),
				'pay_serial_no_rti' => $this->input->post('rti_file_serial_no'),
				'hearing_date_rti' => date('Y-m-d' , strtotime($this->input->post('hearing_date'))),
            );
			if($id){
				
				$res = updateData(FILES, $final_form_data, array('file_id'=>$id));
				updateData(FILES_OTHER_FEILDS,$file_other_feilds,array('f_file_id'=>$id));
				updateData(FILES_LOG,$file_log_data1,array('file_id'=>$id));
                if($res){
                    $this->session->set_flashdata('message', $this->lang->line('file_update_success_msg'));
                } 
            }
			//if()
			redirect('view_file/dealing_file');
			
        }
		
	}
	
	public function notreceive_file(){
		$data = array();
        $data['title'] = $this->lang->line('view_file_manue');
        $user_id =  emp_session_id();
		$data['title_tab'] = $this->lang->line('return_file_show');
		$data['get_files'] = $this->rti_model->all_rti_files_not_receive($user_id);
        $data['module_name'] = "rti_manage_file";
        
		
		$emp_id = emp_session_id();
		$empdetails = empdetails($emp_id) ;
		$so_and_above_officer = array(3,4,5,6,7);
		if(in_array($empdetails[0]['role_id'] ,$so_and_above_officer  )){
			$data['view_file'] = "rti_manage_file/rti_officer_list";
		}else{
			$data['view_file'] = "rti_manage_file/rti_receive_list";
		}
		
		
        $this->template->index($data);
	}
	
	public function view_officer_file(){
		$data = array();
        $data['title'] = $this->lang->line('view_file_manue');
        $user_id =  emp_session_id();
		$data['title_tab'] = $this->lang->line('return_file_show');
		$data['get_files'] = $this->rti_model->rti_files_from_officer($user_id);
        $data['module_name'] = "rti_manage_file";
        $data['view_file'] = "rti_manage_file/rti_officer_list";
        $this->template->index($data);
	}
	
	public function created_file_list(){
		$data = array();
        $data['title'] = $this->lang->line('view_file_manue');
        $user_id =  emp_session_id();
		$data['title_tab'] = $this->lang->line('return_file_show');
		$data['get_files'] = $this->rti_model->all_rti_files_working($user_id);
        $data['module_name'] = "rti_manage_file";
        $data['view_file'] = "rti_manage_file/rti_file_list";
        $this->template->index($data);
	}
	
	
}
