<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Files_scan_upolad extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->module('template');
        $this->load->module('manage_file');
        $this->load->model('manage_file/cr_model');
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
    public function index()
    {
        $this->is_logged_in();
        $data['title']              = $this->lang->line('file_title');
        $data['title_tab']          = $this->lang->line('file_tab_title');
        $data['is_page_edit']       = FALSE;
        $data['abc']                = '';
        $data['module_name']        = "scan_files";
        $data['view_file']          = "scan_files/scan_cr_manage_file";
        $data['view_left_sidebar']  = 'admin/left_sidebar';
        $departments_list           = get_list(DEPARTMENTS, 'department_default_no', null,'ASC');
        $data['departments_list']   = $departments_list;
        $district_list              = get_list(DISTRICT, 'district_name_hi', null,'ASC');
        $data['district_list']      = $district_list;
        $section_list               = get_list(SECTIONS, null, array('section_id !=' =>getEmployeeSection(),'section_id !='=>'25'));
        $data['section_list']       = $section_list;
        $unit_level                 = get_list(UNIT_LEVEL, null, null);
        $data['unit_level']         = $unit_level;
        $data['state_list']         = get_list(STATE_MASTER,null,null);
        $data['head_notesheet']     = get_list(FILE_NOTESHEET_HEADER_MASTER,null,null);
        $this->template->index($data);
    }

    // use for first time entry of file RP
    public function manage_files($id = null) {
		
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

        $this->form_validation->set_rules('check_field', 'check_field', 'required');
        $this->form_validation->set_rules('file_subject', $this->lang->line('file_subject'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('file_uo_number', $this->lang->line('file_uo_number'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('file_uo_date', $this->lang->line('file_uo_date'), 'trim|required|xss_clean');

        if($this->input->post('file_mark_section_id')!=''){
            $this->form_validation->set_rules('file_mark_section_id',$this->lang->line('file_mark_section'), 'trim|required|xss_clean');
        }else{
            $this->form_validation->set_rules('file_mark_officer_id',$this->lang->line('file_mark_officer_id'), 'trim|required|xss_clean');
        }
		/*
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
        if($this->input->post('file_offer_by') == 'v' ){
        $this->form_validation->set_rules('file_department_id', $this->lang->line('file_department'), 'trim|required|xss_clean');
        }
		*/
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

        if ($this->form_validation->run($this) === TRUE)
        {
            $file_last_number = $this->cr_model->get_file_last_number();

            $section_file_last_number = $this->cr_model->get_file_last_number_sectionwise($this->input->post('file_mark_section_id'));
            //  $sectionid = getuserbyrole($this->input->post('file_mark_section_id'), '8'); // 8 is role id of sectionofficer for identify the user
            if($this->input->post('file_mark_section_id')!=''){
                $sectionunit_user = sectionunit_user();
                $markunitid =  $sectionunit_user[$this->input->post('file_mark_section_id')];

                if($this->input->post('file_mark_section_id') == 16 && $this->input->post('file_type') != 'f'){ // use for drafting section when file type not select
                    $markunitid = '59';
                }
                $receiver_id = getmarkeduser($this->input->post('file_mark_section_id'),$markunitid);

                //   $receiver_id = getmarkeduser($this->input->post('file_mark_section_id'),$this->input->post('mark_unitid'));
                $receiver_emp_id = $receiver_id['emp_id'];
                $crno_ofsec_marksec = $this->input->post('file_mark_section_id');
            }else{
                $receiver_emp_id =$this->input->post('file_mark_officer_id');
                $crno_ofsec_marksec = '100'; // 100 no for direct mark files
            }

            //pre($receiver_emp_id);
            if($this->input->post('old_registared_no')==''){
                $old_register_numer=0;
            }else{
                $old_register_numer=$this->input->post('old_registared_no');
            }

            $file_mark_section_id = ($this->input->post('file_mark_section_id')=='' || $this->input->post('file_mark_section_id')==null) ? 0 : $this->input->post('file_mark_section_id');

            $form_data = array(
                'file_mark_section_id'    => $file_mark_section_id,
                'file_received_emp_id'    => $receiver_emp_id,
                'file_sender_emp_id'      => emp_session_id(),
                'file_mark_section_date'  => date('Y-m-d H:i:s'),
                'file_update_date'  => date('Y-m-d H:i:s'),
                'file_level_id'           => '30',   // WORK IN PROGRESS (file_movement_level_master)
                'file_unit_level'         => '50', // 50 is cr unit id
                // 'file_progress_status_id' => '20',   // File/Letter sent to section (remark_master)
                'createfile_empid'        => emp_session_id(),
                'old_registared_no'       => $old_register_numer,
            );
            // pr($form_data);
            $letter_uo_date = strtotime($this->input->post('file_uo_date'));

            if ($this->input->post('judgement_data') == '') {  $judg_dt = '0000-00-00'; } else
            {  $judg_dt = date("Y-m-d", strtotime($this->input->post('judgement_data'))); }
            $section_exp = explode(',',getEmployeeSection());
            //pr($this->input->post('district_id'));
            if($this->input->post('district_id')=='' || $this->input->post('district_id')==null ){
                $district_id=0;
            }
            else{
                $district_id=$this->input->post('district_id');
            }
            if($this->input->post('state_id')=='' || $this->input->post('state_id')==null ){
                $state_id=0;
            }else{
                $state_id=$this->input->post('state_id');
            }
            if($this->input->post('court_bench_id')=='' || $this->input->post('court_bench_id')==null ){
                $court_bench_id=0;
            }else{
                $court_bench_id=$this->input->post('court_bench_id');
            }
            $file_head_id = ($this->input->post('file_head_id')=='' || $this->input->post('file_head_id')==null) ? 0 : $this->input->post('file_head_id');

            $file_department_id = ($this->input->post('file_department_id')=='' || $this->input->post('file_department_id')==null) ? 0 : $this->input->post('file_department_id');


            $form_data_fixed = array(
                'file_number'            => $file_last_number,
                'file_section_serial_no'   => $section_file_last_number,
                'file_uo_or_letter_no'   => $this->input->post('file_uo_number'),
                'file_uo_or_letter_date' => date("Y-m-d", $letter_uo_date),
                'file_type'            => $this->input->post('file_type'),
                'file_from_section_id' => $section_exp[0],
                'file_department_id'   => $file_department_id,
                'file_department_name' => $this->input->post('file_department_name'),
                'section_file_type' 	=> $this->input->post('section_file_type'),
                'file_district_id'     => $district_id,
                'file_state_id'         => $this->input->post('state_id')==''?0:$this->input->post('state_id'),
                'file_subject'         => $this->input->post('file_subject'),
                'court_bench_id'       => $this->input->post('court_bench_id')==''?0:$this->input->post('court_bench_id'),
                'file_created_date'    => date('Y-m-d H:i:s'),
                'file_Offer_by'         => $this->input->post('file_offer_by'),
                'case_parties'          => @$this->input->post('party_petition') ? $this->input->post('party_petition')."-विरुद्ध- ".$this->input->post('Party_name_respondent') : '',
                'courts_name_location'  => $this->input->post('courts_name_location'),
                'file_judgment_date'    => $judg_dt,
                //  'file_form'             => $this->input->post('from_id'),
                'file_head_id'          => $file_head_id!=''?$file_head_id:0,
                'file_return'            => '0',
            );

            $final_form_data = array_merge($form_data, $form_data_fixed);
            //  pre($final_form_data);

                $file_upload = '';

            $file_log_data1 = array(
                'section_id'  => $file_mark_section_id,
                'to_emp_id'   => $receiver_emp_id,
                'from_emp_id' => emp_session_id(),
                'flog_remark' => 'File Enter in Section',
                'flog_other_remark' => "Subject : ".$this->input->post('file_subject'),
                'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
                'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
                'document_path' => $file_upload
            );
            //  pre($file_log_data1);
            $empdetails = empdetails(emp_session_id());
            $form_data_move1 = array(
                'fmove_current_user_id'  => $receiver_emp_id,
                'fmove_previous_user_id' => emp_session_id(),
                'fmove_from_unit_id'     => getunitid($empdetails[0]['role_id']),   // Central receipt
                'fmove_to_unit_id'       => $this->input->post('mark_unitid')==''?0:$this->input->post('mark_unitid'),   // Section officer
            );


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
            //  pre($file_section);

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
                //    'f_file_id' => '',
                'section_id' => $file_mark_section_id,
                //  'case_no'  => @$this->input->post('case_no[]') ? $this->input->post('case_type[]')."/".$this->input->post('case_no[]')."/".$this->input->post('case_year[]') : '',
                'case_no'  => $final_val1,
                'gov_adocate_delhi' => $this->input->post('gov_adocate_delhi'),
                'file_upload' => $file_upload,
                'crimanal_name' => $this->input->post('crimanal_name'),
                'crimanal_no' => $this->input->post('crimanal_no'),
                'distict_name' => $this->input->post('distict_name'),
                'police_station_name' => $this->input->post('police_station_name'),
                'applicant_name' => $this->input->post('applicant_name'),
                'lokayukt_office_no' => $this->input->post('lokayukt_office_no'),
                'registry_date' => date( 'Y-m-d' , strtotime(  $this->input->post('registry_date')) ),
                'registry_no' => $this->input->post('registry_number') ,
            );
            //  pr($file_other_feilds);

            if($id){

            }else{
                if(isset($receiver_emp_id) && $receiver_emp_id != '' && $receiver_emp_id != null)
                {
                    if (isset($_FILES['file_upload']) && $_FILES['file_upload']['error'] == 0) {

                        if ($this->input->post('file_offer_by') == 'v') {
                            $from_place = $this->input->post('file_department_id');
                        } else if ($this->input->post('file_offer_by') == 'c' || $this->input->post('file_offer_by') == 'jvn') {
                            $from_place = $this->input->post('district_id');
                        } else if ($this->input->post('file_offer_by') == 'm' || $this->input->post('file_offer_by') == 'u') {
                            $from_place = $this->input->post('court_bench');
                        } else if ($this->input->post('file_offer_by') == 'au') {
                            $from_place = $this->input->post('state_id');
                        } else if ($this->input->post('file_offer_by') == 'sc') {
                            $from_place = $this->input->post('gov_adocate_delhi');
                        } else {
                            $from_place = $this->input->post('file_other_name');
                        }

                        $form_scan_data = array(
                            'scan_type' => $this->input->post('doc_scan_type'),
							'scan_file_type' => $this->input->post('scan_file_types'),
                           'scan_subfile_types' => $this->input->post('scan_subfile_types'),
						   'scan_section_id' => $this->input->post('file_mark_section_id'),
                            'scan_meta_key' => $this->input->post('save_meta'),
                            'scan_subject' => $this->input->post('file_subject'),
                            'scan_creator_id' => emp_session_id(),
                            'scan_file_from_type' => $this->input->post('file_offer_by'),
                            'scan_file_from_place' => $from_place,
                            'scan_created_date' => date('Y-m-d H:i:s'),
                            'scan_update_date' => date('Y-m-d H:i:s'),
                        );

                        $file_title =  trim(strtolower($this->input->post('file_title')));

                        $file_upload_new = scan_file_upload('file_upload','./uploads/scan/'.$this->input->post('file_mark_section_id') . '/'.date('Y'),$file_title);

                        if ($file_upload_new != 'error') {
                            $path = 'uploads/scan/'.date('Y').'/' . $this->input->post('file_mark_section_id');
                            $final_p = $path . '/' . $file_upload_new;
                        } else {
                            $final_p = '';
                        }
                        $form_scan_data1 = array(
                            'scan_file_path' => $final_p,
                        );

                        $final_scan_data = array_merge($form_scan_data, $form_scan_data1);

                        if (isset($file_upload_new) && $file_upload_new != '') {
                            if ($file_upload_new != 'error') {
                                $res_s = insertData_with_lastid($final_scan_data, FILE_SCAN);
                                if($this->input->post('scan_files_id') && $this->input->post('scan_files_id') != ''){
								$scan_id_r = $res_s.','.$this->input->post('scan_files_id');
								//pr($this->input->post('scan_files_id'));
								}else{
								$scan_id_r = $res_s;
								}
								$scan_explod1 = explode(',',$scan_id_r);
								foreach($scan_explod1 as $scan_id){
									if(!empty($scan_id)){
										$scan_explod1_1[] = $scan_id;
									}
								}
								$scan_seril = serialize($scan_explod1_1);
								$scan_id =  array('scan_id' => $scan_seril);
                            }
                        }
                    }else{
						$scan_explods = explode(',',$this->input->post('scan_files_id'));
						foreach($scan_explods as $scan_id){
							if(!empty($scan_id)){
								$scan_explod[] = $scan_id;
							}
						}
						//print_r($scan_explod);die;
                        $scan_seri2 = serialize($scan_explod);
                        $scan_id =  array('scan_id' => $scan_seri2);
                    }
					
					

                    $final_form_data_wt_scanid = array_merge($final_form_data, $scan_id);
//pr($final_form_data_wt_scanid);
                    // INSERT IN FILE AND FILE_LOG AND FILE_MOVEMENT TABLE RP
                    $res = insertData_with_lastid($final_form_data_wt_scanid, FILES);
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

                        $this->session->set_flashdata('message', 'अनुभाग का पंजी क्रमांक :-<b > ' . $section_number . '</b> सफलतापूर्वक दर्ज की गई हैं |');
                    }
                } else{ $this->session->set_flashdata('message', '<span class="text-bold">Marked user is not found, try after some time</span>');
                }
            }
            redirect('show_file/ALL');
        } else{
            //   $this->session->set_flashdata('error', $this->lang->line('file_validation_error'));
            $data['abc']                = $this->input->post('file_type');
            $data['val_file_subject']      = $this->input->post('file_subject');
            $data['val_file_uo_number']    = $this->input->post('file_uo_number');
            $data['val_file_type']         = $this->input->post('file_uo_number');
            $data['module_name']           = "scan_files";
            $departments_list              = get_list(DEPARTMENTS, 'department_default_no', null,'ASC');
            $data['departments_list']      = $departments_list;
            $district_list                 = get_list(DISTRICT, 'district_name_hi', null,'ASC');
            $data['district_list']         = $district_list;
            $section_list                  = get_list(SECTIONS, null, array('section_id !=' =>getEmployeeSection()));
            $data['section_list']          = $section_list;
            $data['state_list']         = get_list(STATE_MASTER,null,null);
            $data['head_notesheet'] = get_list(FILE_NOTESHEET_HEADER_MASTER,null,null);
            $data['view_file']             = "scan_files/scan_cr_manage_file";
            $this->template->index($data);
        }
    }
    function check_other_department($dept_id, $dept_name)
    {
        if ($dept_id == 'other')
        {
            $this->form_validation->set_message('check_other_department',$this->lang->line('file_other_dept_error'));
            return false;
        }
        else
        {
            return true;
        }
    }

    public function checkuo_number()
    {
        $uonumner = $this->input->post('uonumner');
        $this->db->where('file_uo_or_letter_no',$uonumner );
        $query = $this->db->get(FILES);
        $rows = $query->num_rows();
        //echo $this->db->last_query();
        echo $rows ;

    }

    public function add_new_scan($load_id = null)
    {
        $this->load->view("add_new_scan.php");
    }

    public function add_created_scan($load_id = null)
    {
        $this->load->view("add_created_scan.php");
    }


    public function show_404() {
        $this->load->view('404');
    }

    function get_oficer_unitid(){
        $emp_id = $this->input->post('emp_id');
        $empunit_id = get_emp_role($emp_id,$other=null);
        $resdata['unit_id']=$empunit_id;
        echo json_encode($resdata);
        exit();
    }
}