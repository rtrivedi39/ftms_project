<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Est_files extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->module('template');
        $this->load->model('complaint_model');
		$this->load->model('est_model');
		$this->load->model('view_file_model','view_file');
        $this->lang->load("files","hindi");
		$this->load->language('est_forms','hindi');
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
        $data['module_name']        = "manage_file";
        $data['view_file']          = "manage_file/cr_manage_file";
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
			$data['file_data']= getFiledata($id);
            $data['id'] = $id;
        }
        $est_section_id=7;
       
        $this->form_validation->set_rules('file_subject', $this->lang->line('file_subject'), 'trim|required|xss_clean');
       
        /*If Section Post Petition*/
       
       
        $data['postdata']=$this->input->post();
        //pre($data['postdata']);
       
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

        if ($this->form_validation->run($this) === TRUE)
        {
			//print_r($this->session->all_userdata()))
            $file_last_number = $this->est_model->get_file_last_number();
			$section_file_last_number = $this->est_model->get_file_last_number_sectionwise($this->input->post('file_mark_section_id'));
            //  $sectionid = getuserbyrole($this->input->post('file_mark_section_id'), '8'); // 8 is role id of sectionofficer for identify the user
          

		  if($this->input->post('est_emp_id')!= ''){				
                $receiver_emp_id= $this->input->post('est_emp_id');
            }else{
                $receiver_emp_id = emp_session_id();
            }
			
			if(emp_session_id() == $receiver_emp_id){
                $file_hardcopy_status = 'received';
            }else{
                $file_hardcopy_status = 'not';
            }

            //pre($receiver_emp_id);
            $form_data = array(
                'file_mark_section_id'    => $est_section_id,
                'file_received_emp_id'    => $receiver_emp_id,
                'file_sender_emp_id'      => emp_session_id(),
                'file_mark_section_date'  => date('Y-m-d H:i:s'),
                'file_update_date'  => date('Y-m-d H:i:s'),
                'file_level_id'           => '30',   // WORK IN PROGRESS (file_movement_level_master)
                'file_unit_level'         => '51', // 50 is cr unit id
                'createfile_empid'        => emp_session_id(),
				'file_hardcopy_status'        => $file_hardcopy_status,
				'section_file_type'        => $this->input->post('section_file_page'),
				'file_status'              => 'p',
            );
          //pr($form_data);
          

            
            $form_data_fixed = array(
                'file_number'            => $file_last_number,
				'file_section_serial_no'   => $section_file_last_number,
                'file_type'            => $this->input->post('file_type')==''?'f':$this->input->post('file_type'),
               // 'section_file_type' 	=> $this->input->post('section_file_type'),
                'file_subject'         => $this->input->post('file_subject'),
				'file_description' 	=> $this->input->post('file_discription'),
                'file_created_date'    => date('Y-m-d H:i:s'),
                'file_return'            => '0',
            );
            $final_form_data = array_merge($form_data, $form_data_fixed);
            //pr($final_form_data);
            if(isset($_FILES['upload_file']) && $_FILES['upload_file']['error'] == 0){
                $file_upload = uploadalltypeFile('file_upload' , './uploads/est_certificate/' );
            } else {
               $file_upload = '';
            }
			
			$file_meta_data = array(
					'est_category_id'	=> $this->input->post('category_id'),
					'est_meta_emp_id' 	=> $this->input->post('employee_id'),
					'est_designation' 	=> $this->input->post('designation'),
					'est_medical_fee'	=> $this->input->post('fee'),
					'est_medicat_type'	=> $this->input->post('medical_type'),
					'est_emp_account_no'=> $this->input->post('employee_ac_no'),
					'est_meta_exiting_amt'	=> $this->input->post('existing_amount'),
					'est_meta_want_amt'	=> $this->input->post('amount_want'),
					'est_meta_laws'		=> $this->input->post('laws'),
					'est_amount'		=> $this->input->post('bill_amount'),
					'est_bill_no'		=> $this->input->post('bill_no'),
					'est_description'	=> $this->input->post('file_discription'),
					'est_bill_type'		=> $this->input->post('bill_type'),
					'est_bill_category'	=> $this->input->post('bill_category'),

			);
			
			if(!empty($file_upload)){
				$file_meta_data['est_certificate_file'] = $file_upload;
			}
			//print_r($file_meta_data );
            $file_log_data1 = array(
                'section_id'  => $est_section_id,
                'to_emp_id'   => $receiver_emp_id,
                'from_emp_id' => emp_session_id(),
                'flog_remark' => 'File Created in Section',
                'flog_other_remark' => "Subject : ".$this->input->post('file_subject'),
                'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
                'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
                'document_path' => $file_upload,
				'file_status_log'             => 'p',
            );
             // pr($file_log_data1);
            $empdetails = empdetails(emp_session_id());
			$crno_ofsec_marksec = $est_section_id;
            $form_data_move1 = array(
                'fmove_current_user_id'  => $receiver_emp_id,
                'fmove_previous_user_id' => emp_session_id(),
                'fmove_from_unit_id'     => '51',   // Esttablisment section to
                'fmove_to_unit_id'       => '51',   // Section officer
            );
            //  pr($form_data_move1);
            //entry in files_section
           /*comment by bij 04-12-2015 for avoid duplicate section no.
			$sectionno = plusone_fileno1($empdetails[0]['emp_section_id'],$crno_ofsec_marksec);
			*/
			$sectionno = plusone_fileno1(7,null,null,null);
            if($sectionno != 0)  { $section_number = $sectionno; }
            else{  $section_number = '1';  }
            $file_section = array(
                'section_id'            => $est_section_id, // login user section id eg-CR
                'section_number'        => $section_number,
                'filemarked_section_id' => $crno_ofsec_marksec , // this is use for section_id but for direct file use '100' .
                'file_type'             => $this->input->post('file_type'),
                'file_mark_date'       => date('Y-m-d H:i:s'),
                'file_created_date'    => date('Y-m-d H:i:s'),
                'file_update_date'     => date('Y-m-d H:i:s'),
            );
            //pr($file_section);
		
            if($id){
				$form_data = array(
					'file_type'            => $this->input->post('file_type'),
				    'file_description' 	=> $this->input->post('file_discription'),
					'file_subject'         => $this->input->post('file_subject'),
				);
				$final_log = array(
					'file_id' => $id,
					'section_id'  => getusersection(emp_session_id()),
					'to_emp_id'   => emp_session_id(),
					'from_emp_id' => emp_session_id(),
					'flog_remark' => 'File updated',
					'flog_other_remark' => "Subject : ".$this->input->post('file_subject'),
					'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
					'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
					'document_path' => $file_upload
				);
				//pr($final_log);
				insertData($final_log, FILES_LOG);
                $res = updateData(FILES, $form_data, array('file_id'=>$id));
                if($res){
                    $this->session->set_flashdata('message', $this->lang->line('file_update_success_msg'));
                } 
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

                      /*  $file_id_oth = array('f_file_id' => $res);
                        $file_other = array_merge($file_other_feilds, $file_id_oth);
                        insertData($file_other, FILES_OTHER_FEILDS);*/

                        $file_id2 = array('fmove_file_id' => $res);
                        $form_data_move = array_merge($form_data_move1, $file_id2);
                        insertData($form_data_move, FILES_MOVEMENT);
						
						update_file_tbl_for_section_no($res);
					    insertData($file_meta_data, EST_META);
						
                        $this->session->set_flashdata('message', 'फाइल/पत्र :-  सफलतापूर्वक दर्ज की गई,  जिसका  <b > &nbsp;पंजी क्रमांक :- ' . $section_number . '</b>&nbsp; हैं |');
                    }
                } else{ $this->session->set_flashdata('message', '<span class="text-bold">Marked user is not found, try after some time</span>');
                }
            }
             redirect('establishment/est_files/marked_da_file');
        } else{
            //   $this->session->set_flashdata('error', $this->lang->line('file_validation_error'));
            $data['abc']                = $this->input->post('file_type');
            $data['val_file_subject']      = $this->input->post('file_subject');
            $data['val_file_uo_number']    = $this->input->post('file_uo_number');
            $data['val_file_type']         = $this->input->post('file_uo_number');
            $data['module_name']           = "manage_file";
            $departments_list              = get_list(DEPARTMENTS, null, null);
            $data['departments_list']      = $departments_list;
            $district_list                 = get_list(DISTRICT, null, null);
            $data['district_list']         = $district_list;
            $section_list                  = get_list(SECTIONS, null, array('section_id !=' =>getEmployeeSection()));
            $data['section_list']          = $section_list;
            $data['state_list']            = get_list(STATE_MASTER,null,null);
            $data['head_notesheet']        = get_list(FILE_NOTESHEET_HEADER_MASTER,null,null);
            $data['view_file']             = 'establishment/forms/common_form';
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
	
	
	public function marked_da_file()
    {
        $data = array();
		$type = 'p';
        $data['title'] = 'स्थापना शाखा में बनाई फाइलें / पत्र';
        $data['title_tab'] = $this->lang->line('complaint_sub_title');
		if ($this->input->get('type')) {
           $type = $this->input->get('type');
		}		
		$data['get_marked_list']= $this->est_model->get_marked_da_file($type);
		
        $data['module_name'] = "establishment";
        $data['view_file'] = "marked_da_file";
        $this->template->index($data);
    }
	
	//modify file
	function modify($id = ''){
		 $data = array();
        $data['title'] = $this->lang->line('complaint_title');
        $data['title_tab'] = $this->lang->line('complaint_sub_title');
			
		$data['files']= getFiledata($id);
		$data['id']= $id;
		
        $data['module_name'] = "establishment";
        $data['view_file'] = "forms/common_form";
        $this->template->index($data);
	}
	
	
}