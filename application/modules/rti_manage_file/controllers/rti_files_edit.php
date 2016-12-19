<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Rti_files_edit extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->module('template');
        $this->load->model('rti_model');
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
    public function index($id = null)
    {
        $this->is_logged_in();
        $data['title']              = 'Update file';
        $data['title_tab']          = 'Files';
        $data['is_page_edit']       = FALSE;
        $file_data                = getFiledata($id);
        $data['file_data']        = $file_data;
        $section_list               = get_list(SECTIONS, null, null);
        $data['section_list']       = $section_list;
        $unit_level               = get_list(UNIT_LEVEL, null, null);
        $data['unit_level']       = $unit_level;
        $departments_list           = get_list(DEPARTMENTS, null, null);
        $data['departments_list']   = $departments_list;
        $district_list              = get_list(DISTRICT, null, null);
        $data['district_list']      = $district_list;
        $headnotesheet              = get_list(FILE_NOTESHEET_HEADER_MASTER, null   , null);
        $data['head_notesheet']     = $headnotesheet;
        $data['state_list']         = get_list(STATE_MASTER,null,null);
        $data['module_name']        = "manage_file";
        $data['view_file']          = "manage_file/cr_manage_editfile";
        $this->template->index($data);
    }

    // use for first time entry of file RP
    public function update_files($id = null){
        $data['title']            =  $this->lang->line('file_title');
        $data['title_tab']        = $this->lang->line('file_tab_title');
        $data['page_title']         = $this->lang->line('file_edit_title');
        $data['is_page_edit'] = true;
        $data['id'] = $id;



        $this->form_validation->set_rules('check_field', 'check_field', 'required');
        $this->form_validation->set_rules('file_subject', $this->lang->line('file_subject'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('file_uo_number', $this->lang->line('file_uo_number'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('file_uo_date', $this->lang->line('file_uo_date'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('file_mark_section_id',$this->lang->line('file_mark_section'), 'trim|required|xss_clean');

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
        if($this->input->post('file_offer_by') == 'v' )
        {
            $this->form_validation->set_rules('file_department_id', $this->lang->line('file_department'), 'trim|required|xss_clean');
        }

        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

        if ($this->form_validation->run($this) === TRUE)
        {
            $sectionunit_user = sectionunit_user();
            $markunitid =  $sectionunit_user[$this->input->post('file_mark_section_id')];

            if($this->input->post('file_mark_section_id') == 16 && $this->input->post('file_type') != 'f'){ // use for drafting section when file type not select
                $markunitid = '59';
            }
            $receiver_id = getmarkeduser($this->input->post('file_mark_section_id'),$markunitid);


        //    $sectionid = getmarkeduser($this->input->post('file_mark_section_id'),$this->input->post('mark_unitid'));
            $letter_uo_date = strtotime($this->input->post('file_uo_date'));

            if ($this->input->post('judgement_data') == '') {  $judg_dt = ''; } else
            {  $judg_dt = date("Y-m-d", strtotime($this->input->post('judgement_data'))); }

            $empdetails = empdetails(emp_session_id());

            $form_data = array(
                'file_subject'           => $this->input->post('file_subject'),
                'file_uo_or_letter_no'   => $this->input->post('file_uo_number'),
                'file_uo_or_letter_date' => date("Y-m-d", $letter_uo_date),
                'file_mark_section_id'   => $this->input->post('file_mark_section_id')==''?0:$this->input->post('file_mark_section_id'),
                'file_mark_section_date' => date('Y-m-d H:i:s'),
                'file_unit_level'        => $this->input->post('mark_unitid')==''?0:$this->input->post('mark_unitid'),
             //   'file_received_emp_id'   => $sectionid['emp_id'],
                'file_received_emp_id'   => $receiver_id['emp_id'],
                'file_sender_emp_id'     => emp_session_id(),
                'file_department_id'   => $this->input->post('file_department_id')==''?0:$this->input->post('file_department_id'),
                'file_department_name' => $this->input->post('file_department_name')==''?0:$this->input->post('file_department_name'),
                'file_district_id'     => $this->input->post('district_id')==''?0:$this->input->post('district_id'),
                'file_state_id'         => $this->input->post('state_id')==''?0:$this->input->post('state_id'),
                'court_bench_id'       => $this->input->post('court_bench')==''?0:$this->input->post('court_bench'),
                'file_Offer_by'         => $this->input->post('file_offer_by'),
                'case_parties'          => @$this->input->post('party_petition') ? $this->input->post('party_petition')."-विरुद्-".$this->input->post('Party_name_respondent') : '',
                'courts_name_location'  => $this->input->post('courts_name_location'),
                'file_judgment_date'    => $judg_dt,
                //  'file_form'             => $this->input->post('from_id'),
                'file_update_date'       => date('Y-m-d H:i:s'),
                'file_hardcopy_status' => 'not',
                'file_return' => '0',
            );

            $form_movement = array(
                'fmove_file_id' => $id,
             //   'fmove_current_user_id'   => $sectionid['emp_id'],
                'fmove_current_user_id'   => $receiver_id['emp_id'],
                'fmove_previous_user_id'  => emp_session_id(),
                'fmove_from_unit_id'      => getunitid($empdetails[0]['role_id'])==''?0:getunitid($empdetails[0]['role_id']),
                'fmove_to_unit_id'        => $this->input->post('mark_unitid')==''?0:$this->input->post('mark_unitid'),
            );
            // use for insert
            $form_log = array(
                'file_id'   => $id,
                'section_id'  => $this->input->post('file_mark_section_id'),
                'from_emp_id' => emp_session_id(),
             //   'to_emp_id'   => $sectionid['emp_id'],
                'to_emp_id'   => $receiver_id['emp_id'],
                'flog_other_remark'  => 'File is Resend by CR',
                'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
                'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
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
                'case_no'  => implode(',', $final_val),
            );
            
/*			$file_section1 = array(
                'filemarked_section_id' => $this->input->post('file_mark_section_id'),
                'file_update_date'      => date('Y-m-d H:i:s'),
                'file_mark_date'      => date('Y-m-d'),
            ); */
			
			 //change
            $empdetails = empdetails(emp_session_id());
            $sectionno = plusone_fileno1($empdetails[0]['emp_section_id'],$this->input->post('file_mark_section_id'));

            if($sectionno != 0)  { $section_number = $sectionno; }
            else{  $section_number = '1';  }
            $file_section = array(
                'file_id' => $id,
                'section_id'            => $empdetails[0]['emp_section_id'], // login user section id eg-CR
                'section_number'        => $section_number,
                'filemarked_section_id' => $this->input->post('file_mark_section_id') , // this is use for section_id but for direct file use '100' .
                'file_type'             => $this->input->post('file_type'),
                'file_mark_date'       => date('Y-m-d H:i:s'),
                'file_created_date'    => date('Y-m-d H:i:s'),
                'file_update_date'     => date('Y-m-d H:i:s'),
            );
            //change
			
             if($id){
            //    updateData(FILES_SECTION, $file_section1, array('section_id' => '1', 'file_id' => $id,'file_type' => $this->input->post('file_type'))); // here 1 is cr section id
                $res = updateData(FILES, $form_data, array('file_id'=>$id));
                if($res){
                    insertData($form_movement,FILES_MOVEMENT);
                    updateData(FILES_OTHER_FEILDS, $file_other_feilds, array('f_file_id'=>$id));
                    insertData($form_log,FILES_LOG);
					
					insertData($file_section, FILES_SECTION);
					
                    $this->session->set_flashdata('message', $id." ".$this->lang->line('file_update_success_msg'));
                }
            }else{
            }
            redirect('return_file');
        } else{
            $data['title']              = 'Update file';
            $data['title_tab']          = 'Files';
            $data['is_page_edit']       = FALSE;
            $file_data                = getFiledata($id);
            $data['file_data']        = $file_data;
            $section_list               = get_list(SECTIONS, null, null);
            $data['section_list']       = $section_list;
            $unit_level               = get_list(UNIT_LEVEL, null, null);
            $data['unit_level']       = $unit_level;
            $departments_list           = get_list(DEPARTMENTS, null, null);
            $data['departments_list']   = $departments_list;
            $district_list              = get_list(DISTRICT, null, null);
            $data['district_list']      = $district_list;
            $headnotesheet              = get_list(FILE_NOTESHEET_HEADER_MASTER, null   , null);
            $data['head_notesheet']     = $headnotesheet;
            $data['state_list']         = get_list(STATE_MASTER,null,null);
            $data['module_name']        = "manage_file";
            $data['view_file']          = "manage_file/cr_manage_editfile";
            $this->template->index($data);
        }
    }


    public function receivebycr($id = null){
        $file_dt   = get_list(FILES, null, array('file_id'=>$id));

        $form_data = array(
            'file_update_date'     => date('Y-m-d'),
            'file_hardcopy_status' => 'received',
        );
        // use for insert
        $form_log = array(
            'file_id'   => $id,
            'section_id'  => $file_dt[0]['file_mark_section_id'],
            'from_emp_id' => emp_session_id(),
            'to_emp_id'   =>emp_session_id(),
            //    'fvlm_id' => '27',  // File/Letter is Received by CR(remark_master)
            'flog_remark' => 'File/Letter is Received by CR',
            'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
            'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
        );
        if($id){
            $res = updateData(FILES, $form_data, array('file_id'=>$id));
            insertData($form_log,FILES_LOG);
            if($res){
                $this->session->set_flashdata('message', 'File '.$id.' Received Successfully');
            }
        }
        redirect('rti/view_file');
    }

	
	public function receivebyofficer($id = null){
        $file_dt   = get_list(FILES, null, array('file_id'=>$id));

        $form_data = array(
            'file_update_date'     => date('Y-m-d'),
            'file_hardcopy_status' => 'received',
        );
        // use for insert
        $form_log = array(
            'file_id'   => $id,
            'section_id'  => $file_dt[0]['file_mark_section_id'],
            'from_emp_id' => emp_session_id(),
            'to_emp_id'   =>emp_session_id(),
            //    'fvlm_id' => '27',  // File/Letter is Received by CR(remark_master)
            'flog_remark' => 'File/Letter is Received by CR',
            'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
            'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
        );
        if($id){
            $res = updateData(FILES, $form_data, array('file_id'=>$id));
            insertData($form_log,FILES_LOG);
            if($res){
                $this->session->set_flashdata('message', 'File '.$id.' Received Successfully');
            }
        }
        redirect('rti/view_officer_file');
    }
	
    public function show_404() {
        $this->load->view('404');
    }


}