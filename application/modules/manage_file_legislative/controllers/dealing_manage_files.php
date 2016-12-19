<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dealing_manage_files extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->module('template');
        $this->load->model('cr_model');
        $this->lang->load("files","hindi");
        authorize();
    }
    public function is_logged_in()
    {
        if ($this->session->userdata('is_logged_in') === false)
        {
            redirect("home");
        }
    }
    public function index($fileid = '')
    {
        $this->is_logged_in();
        $data['title']              = $this->lang->line('file_title');
        $data['title_tab']          = $this->lang->line('file_tab_title');
        $data['is_page_edit']       = FALSE;
        $departments_list           = get_list(DEPARTMENTS, null, null);
        $data['departments_list']   = $departments_list;
        $district_list              = get_list(DISTRICT, null, null);
        $data['district_list']      = $district_list;
        $section_list               = get_list(SECTIONS, null   , null);
        $data['section_list']       = $section_list;
        $headnotesheet              = get_list(FILE_NOTESHEET_HEADER_MASTER, null,null);
        $data['head_notesheet']     = $headnotesheet;
        $unit_level               = get_list(UNIT_LEVEL, null, null);
        $data['unit_level']       = $unit_level;
        $file_data                = getFiledata($fileid);
        $data['file_data']        = $file_data;
        $data['module_name']        = "manage_file_legislative";
		$emp_id = $this->session->userdata('emp_id');
		$emp_details = empdetails($emp_id);
		$emp_section_id = $emp_details[0]['emp_section_id'];
		 if( $emp_section_id == 15 ){
			  $data['view_file']          = "manage_file_legislative/dealing_manage_file_prosecution";
		 }
		 else{
			 $data['view_file']          = "manage_file_legislative/dealing_manage_file";
		 }
       // $data['view_file']          = "manage_file/dealing_manage_file";
        // pre($data['file_data']);
        $this->template->index($data);
    }

    // use for first time entry of file RP
    public function manage_files($id = null) {
       // pr($id);
        $data['title']            =  $this->lang->line('file_title');
        $data['title_tab']        = $this->lang->line('file_tab_title');
        if($id == null){
            $data['page_title']   = $this->lang->line('file_tab_title');
            $data['is_page_edit'] = false;

        }else{
            $data['page_title']   = $this->lang->line('file_edit_title');
            $data['is_page_edit'] = true;
            $data['id'] = $id;
        }
		$is_da='y';
        $section_exp = explode(',',getEmployeeSection());
        if(in_array('16',$section_exp)) {
            $this->form_validation->set_rules('file_type', $this->lang->line('file_type'), 'trim|required|xss_clean');
        }
        $this->form_validation->set_rules('file_uo_number', $this->lang->line('file_uo_number'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('file_uo_date', $this->lang->line('file_uo_date'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('file_subject', $this->lang->line('file_subject'), 'trim|required|xss_clean');
		
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		if ($this->input->post('judgement_data') == '') {  $judg_dt = ''; } else
            {  $judg_dt = date("Y-m-d", strtotime($this->input->post('judgement_data'))); }
			
			if ($this->input->post('file_uo_date') == '') {  $file_uo_date = ''; } else
            {  $file_uo_date = date("Y-m-d", strtotime($this->input->post('file_uo_date'))); }
			
		
        if ($this->form_validation->run($this) === TRUE)
        {

			if(in_array(checkUserrole(),show_dealing_asst_list()) || in_array('19',$section_exp)){
               $file_hardcopy_status='working'; 
            }else{  $file_hardcopy_status='received';  }   
            //die(checkUserrole());         
            $data_dealing = array(
                'file_type'                 => $this->input->post('file_type'),
				'file_uo_or_letter_no'      => $this->input->post('file_uo_number'),
				'file_uo_or_letter_date'    => $file_uo_date,
                'case_parties'              => $this->input->post('party_petition')."-विरुद्ध- ".$this->input->post('Party_name_respondent'),
            //    'courts_name_location'      => $this->input->post('courts_name_location'),
                'file_subject'              => $this->input->post('file_subject'),
            //    'file_head_id'              => $this->input->post('file_head'),
                'file_hardcopy_status'      => $file_hardcopy_status,
                'file_department_id'        => $this->input->post('file_department_id')==''?0:$this->input->post('file_department_id'),
                'file_district_id'          => $this->input->post('district_id')==''?0:$this->input->post('district_id'),
                'file_state_id'          => $this->input->post('state_id')==''?0:$this->input->post('state_id'),
            //    'court_bench_id'            => $this->input->post('court_bench'),
            //    'file_judgment_date'        => $judg_dt,
               'file_department_name'      => $this->input->post('file_department_name'),
               'section_file_type' 	=> $this->input->post('section_file_type'),
            );
            if(!in_array('16',$section_exp)) {
                unset($data_dealing['file_type']);
            }
         //   pr($data_dealing);

            if($_FILES['file_upload']){
                $file_upload = uploadalltypeFile('file_upload' , './uploads/documents_file/' );
            } else {
                $file_upload = '';
            }
            $data_dealing_log = array(
                'file_id'       => $id,
                'file_head_id'  => $this->input->post('file_head')==''?0:$this->input->post('file_head'),
                'section_id'    => $this->input->post('file_mark_section_id'),
                'to_emp_id'     => emp_session_id(),
                'from_emp_id'   => emp_session_id(),
                //  'fvlm_id'     => '25', // Work in progress by Officer (remark_master)
                'flog_remark' => "पक्षकार का नाम ".$this->input->post('party_petition')." विरुद्ध ".$this->input->post('Party_name_respondent'),
                'flog_other_remark' => 'Modify Details by Dealing Assistant',
                'flog_ip_address'   => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
                'flog_browser_id'   => $_SERVER['HTTP_USER_AGENT'],
                'document_path'     => $file_upload
            );

            $tt = $this->input->post('files_other_feilds');
            for($i=0 ; $i < count($tt['case_no']); $i++){
                foreach ($tt as $a=>$b){
                    if($a == 'case_type'){$val12 = $b[$i]."/";}
                    if($a == 'case_no'){$val12 .= $b[$i]."/";}
                    if($a == 'case_year'){ $val12 .= $b[$i];}
                }
                $final_val[] = $val12;
            }

            $file_other_feilds = array(
                'f_file_id'     => $id,
               // 'case_no'       => $this->input->post('case_type')."/".$this->input->post('case_no')."/".$this->input->post('case_year'),
                'case_no'  => implode(',', $final_val),
                'file_upload'   => $file_upload,
            );
         //   pr($file_other_feilds);
            if($id){
                $res = updateData(FILES, $data_dealing, array('file_id'=>$id));
                if($res){
                    insertData($data_dealing_log,FILES_LOG);
                    updateData(FILES_OTHER_FEILDS, $file_other_feilds, array('f_file_id'=>$id));
                    $this->session->set_flashdata('message', 'फाइल/पत्र क्रं:&nbsp;'.$id.'&nbsp; सफलतापूर्वक  प्रगति पर आ चुकी है जाये  |');
                }
            }else{
                $this->session->set_flashdata('message', $this->lang->line('file_add_success_msg') );
            }
            if($this->input->post('link_file') == 'link_file'){
                redirect('view_file/file_link/101/'.$id);
            }else{
                if($this->session->userdata('user_role') == '8' || $this->session->userdata('user_role') == '37')
                {
                    redirect('view_file_legislative');
                }else{
                    redirect('view_file_legislative/dealing_file');
                }
            }
        } else{
            $data['title']              = $this->lang->line('file_title');
            $data['title_tab']          = $this->lang->line('file_tab_title');
            $data['is_page_edit']       = FALSE;
            $data['module_name']        = "manage_file_legislative";
            $data['view_file']          = "manage_file_legislative/dealing_manage_file";
            $departments_list           = get_list(DEPARTMENTS, null, null);
            $data['departments_list']   = $departments_list;
            $district_list              = get_list(DISTRICT, null, null);
            $data['district_list']      = $district_list;
            $section_list               = get_list(SECTIONS, null   , null);
            $data['section_list']       = $section_list;
            $headnotesheet              = get_list(FILE_NOTESHEET_HEADER_MASTER, null   , null);
            $data['head_notesheet']   = $headnotesheet;
            $unit_level               = get_list(UNIT_LEVEL, null, null);
            $data['unit_level']       = $unit_level;
            $file_data                = getFiledata($id);
            $data['file_data']        = $file_data;
            // pre($data['file_data']);
            $this->template->index($data);
        }
    }

    // send file to SO by DA. RP
    public function return_file_so($file_id = null,$condition = null){ // ($condition == 1 file for return to cr)($condition == 2 file for dispatch)
        if($file_id != null)    {
            $filedetails =  getFileDetails($file_id);
            $section_officedrid = get_list(EMPLOYEE_HIARARCHI_LEVEL, null, array('under_emp_id' => emp_session_id()));
               if($condition != null && $condition == '1')    {
                   $rtn = '0';
                   $remk = 'फाइल अनुभाग अधिकारी की वापस कर दी गई है  |';
                   $file_level_id = 31;
               } else if($condition != null && $condition == '2')    {
                   $rtn = '1';
                   $remk = 'यह फाइल अनुभाग अधिकारी की वापस कर दी गई है  |';
                   $file_level_id = 30;
               } else {
                   $rtn = '0';
                   $remk = '';
                   $file_level_id = 30;
               }


            $m_empdetails = empdetails($section_officedrid[0]['emp_id']); // marked emp
            $p_empdetails = empdetails(emp_session_id()); // login emp

            $file_data = array(
                'file_received_emp_id' => $section_officedrid[0]['emp_id'],
                'file_sender_emp_id' => emp_session_id(),
                'file_hardcopy_status' => 'not',
                'file_update_date' => date('Y-m-d H:i:s'),
                'file_level_id' => $file_level_id, // 31 USE FOR RETURN FILE TO CR WHICH IS REJECTED TO DEALING ASSITANT
                'file_unit_level' => getunitid($m_empdetails[0]['role_id'])==''?0:getunitid($m_empdetails[0]['role_id']),
                'file_return' => $rtn
            );
            $filelog_data = array(
                'file_id' => $file_id,
                'section_id' => $filedetails->file_mark_section_id,
                'to_emp_id' => $section_officedrid[0]['emp_id'],
                'from_emp_id' => emp_session_id(),
                'flog_remark' => 'File/Letter Return to SO BY AD',
                'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
                'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
                'sublogin' => $this->session->userdata('emp_id'),
                'flog_other_remark' => $remk,
            );


            $form_data_move1 = array(
                'fmove_file_id'  => $file_id,
                'fmove_current_user_id'     => $section_officedrid[0]['emp_id'],
                'fmove_previous_user_id'    => emp_session_id(),
                'fmove_to_unit_id'          => getunitid($m_empdetails[0]['role_id'])==''?0:getunitid($m_empdetails[0]['role_id']),
                'fmove_from_unit_id'        => getunitid($p_empdetails[0]['role_id'])==''?0:getunitid($p_empdetails[0]['role_id']),
                'file_return'            => $filedetails->file_return,
            );


            $res1 = updateData(FILES, $file_data, array('file_id' => $file_id));
            if ($res1) {
                insertData($filelog_data, FILES_LOG);
                insertData($form_data_move1, FILES_MOVEMENT);
                if($condition != null) {
                    $this->session->set_flashdata('message', '<b>फ़ाइल/प्रत्र अनुभाग अधिकारी को वापस कर दिया गया हैं |</b>');
                }else {
                    $this->session->set_flashdata('message', '<b>फ़ाइल/प्रत्र अनुभाग अधिकारी को मार्क कर दिया गया हैं |</b>');
                }
            }
            //   redirect('attached/file_doc/1');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    function check_other_department($dept_id, $dept_name)
    {
        if ($dept_id == 'other')
        {
        //    $this->form_validation->set_message('check_other_department',$this->lang->line('file_other_dept_error'));
            return false;
        }
        else
        {
            return true;
        }
    }

    public function show_404() {
        $this->load->view('404');
    }


}