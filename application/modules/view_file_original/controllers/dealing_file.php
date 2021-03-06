<?php
class Dealing_file extends MX_Controller{
    function __construct() {
        parent::__construct();
        $this->load->module('template');
        $this->load->language('view_file','hindi');
        $this->load->model('dealing_file_model','dealing_file');
        authorize();
    }
    public function index($val = null)
    {
        $section_exp = explode(',',getEmployeeSection());
        $section_11 = array('16','20','18','28');
        if(array_intersect($section_exp, $section_11)){
                redirect('view_file_legislative/dealing_file/index/'.$val);
        }else {
        $data = array();
        $data['title'] = $this->lang->line('view_file_manue');
        $data['title_tab'] = $this->lang->line('title');
        $section_id = getEmployeeSection();
        if($val == 'return'){
        $data['get_files']= $this->dealing_file->getFiles_DA($section_id,'2');
        }else{
        $data['get_files']= $this->dealing_file->getFiles_DA($section_id,null);
        }
        if($val == 'return'){
            $data['view_file'] = "view_file/viewfile_fornotesheet";
        }else{
            $data['view_file'] = "view_file/Dealing_viewfile";
        }
        $data['module_name'] = "view_file";
        $data['view_left_sidebar'] = 'admin/left_sidebar';
        $this->template->index($data);

    }
    }

    //use for send to DA and alse return to CR . RP
    public function Sent_to_DA()
    {
        $file_id = $this->input->post('file_id1');
        $file_dt =  getFileDetails($file_id);

        if($this->input->post('return_tocr') == 'return_tocr')  //file return to cr by so RP
        {
            $m_empdetails = empdetails($file_dt->createfile_empid); // marked emp
            $p_empdetails = empdetails(emp_session_id()); // login emp

            $file_data1 = array(
                'file_unit_level'       => getunitid($m_empdetails[0]['role_id']),
                'file_hardcopy_status'  => 'not',
                'file_received_emp_id'  => $file_dt->createfile_empid,
                'file_sender_emp_id'    => emp_session_id(),
            //    'file_mark_section_id'  => $m_empdetails[0]['emp_section_id'],  //CR
                'file_level_id' => '30',
                'file_mark_section_date' => date('Y-m-d H:i:s'),
                'file_update_date'      => date('Y-m-d H:i:s'),
                'file_return'            => '1',
            );
            $filelog_data1 = array(
                'file_id'       => $file_id,
                'section_id'    => $m_empdetails[0]['emp_section_id'],
                'to_emp_id'     => $file_dt->createfile_empid,
                'from_emp_id'   => emp_session_id(),
                'flog_other_remark' => $this->input->post('file_remark'),
                'flog_ip_address'   => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
                'flog_browser_id'   => $_SERVER['HTTP_USER_AGENT'],
            );
            $form_data_move1 = array(
                'fmove_file_id'  => $file_id,
                'fmove_current_user_id'     => $file_dt->createfile_empid,
                'fmove_previous_user_id'    => emp_session_id(),
                'fmove_to_unit_id'          => getunitid($m_empdetails[0]['role_id']),
                'fmove_from_unit_id'        => getunitid($p_empdetails[0]['role_id']),
                'file_return'            => '1',
            );
           // pr($form_data_move1);
            $file_section1 = array(
                'filemarked_section_id' => $m_empdetails[0]['emp_section_id'],
                'file_mark_date'        => date('Y-m-d H:i:s'),
                'file_update_date'      => date('Y-m-d H:i:s'),
            );

            updateData(FILES_SECTION, $file_section1, array('section_id' => $file_dt->file_mark_section_id, 'file_id' => $file_id)); // here file_mark_section_id is current user section after this update file_mark_section_id will change by below update function
            $res1 = updateData(FILES, $file_data1, array('file_id' => $file_id));
            if ($res1) {
                insertData($filelog_data1, FILES_LOG);
                insertData($form_data_move1, FILES_MOVEMENT);
                $this->session->set_flashdata('message', '<u>FIleID : ' . $file_id . '</u> Successfully Return to CR');
            }
          //  redirect('view_file');
            redirect('view_file/index/1');
        }
        else {
            // $this->form_validation->set_rules('file_remark', 'file_remark', 'trim|required|xss_clean');
            if($this->input->post('court_bench_byso')){
				$this->form_validation->set_rules('court_bench_byso', 'court_bench_byso', 'trim|required|xss_clean');
			}else if($this->input->post('section_file_type')){
				$this->form_validation->set_rules('section_file_type', 'section_file_type', 'trim|required|xss_clean');
			}
            $this->form_validation->set_rules('Da_name', 'Da_name', 'trim|required|xss_clean');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

            if ($this->form_validation->run($this) === TRUE) {
				if($this->input->post('court_bench_byso')){
					$court_bench_byso=$this->input->post('court_bench_byso');
				}else { $court_bench_byso='';}

                $m_empdetails = empdetails($this->input->post('Da_name')); // marked emp
                $p_empdetails = empdetails(emp_session_id()); // login emp

                $file_data = array(
                    'file_received_emp_id' => $this->input->post('Da_name'),
                    'file_sender_emp_id' => emp_session_id(),
                    'file_progress_status_id' => '22', // File/Letter is sending to Dealing Assistant . (remark_master)
                    'file_hardcopy_status' => 'not', // only two value will be save received/not
                    'court_bench_id' =>$court_bench_byso,
					'file_Offer_by' =>$court_bench_byso,
					'section_file_type' => $this->input->post('section_file_type'),
                    'file_level_id' => '30',
              //      'file_unit_level' => getunitid($m_empdetails[0]['role_id']),
                );
				
				if($court_bench_byso == sc){
                    unset($file_data['court_bench_id']);
                }else{
                    unset($file_data['file_Offer_by']);
                }

                $sectionid = getusersection(emp_session_id());
                //    $Dealingass = get_list(EMPLOYEES, null, array('emp_id' => $this->input->post('Da_name')));

                $filelog_data = array(
                    'file_id'       => $file_id,
                    'section_id'    => $file_dt->file_mark_section_id,
                    'to_emp_id'     => $this->input->post('Da_name'),
                    'from_emp_id'   => emp_session_id(),
                    //  'fvlm_id' => '22', //  File/Letter is send to Dealing Assistant . (remark_master)
                    'flog_remark'   => 'File/Letter is send to Dealing Assistant',
                    'flog_other_remark' => $this->input->post('file_remark'),
                    'flog_ip_address'   => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
                    'flog_browser_id'   => $_SERVER['HTTP_USER_AGENT'],
                );


                $form_data_move1 = array(
                    'fmove_file_id'  => $file_id,
                    'fmove_current_user_id'     => $this->input->post('Da_name'),
                    'fmove_previous_user_id'    => emp_session_id(),
                    'fmove_to_unit_id'          => getunitid($m_empdetails[0]['role_id']),
                    'fmove_from_unit_id'        => getunitid($p_empdetails[0]['role_id']),
                    'file_return'            => $file_dt->file_return,
                );

                $res1 = updateData(FILES, $file_data, array('file_id' => $file_id));
                if ($res1) {
                    insertData($filelog_data, FILES_LOG);
                    insertData($form_data_move1, FILES_MOVEMENT);
                    // $this->session->set_flashdata('message', $this->lang->line('file_add_success_msg').' <b>'.$file_last_number.'</b>');
                    $this->session->set_flashdata('message', '<u>FIleID : ' . $file_id . '</u> Successfully Sent');
                }

                $url2 = explode("/",$_SERVER['HTTP_REFERER']) ;
                if (in_array("work", $url2)) {
                    redirect('view_file');
                }else {
                    redirect($_SERVER['HTTP_REFERER']);
                }
            } else {
                redirect('File/work/' . $file_id);
            }
        }
    }

//Receive file by dealing assistant RP
    public function receivebyAD($fileid='')
    {
        $filedetails =  getFileDetails($fileid);
        $file_data = array(
            'file_hardcopy_status' => 'received',
            //  'file_progress_status_id' => '29',
            'file_update_date' => date('Y-m-d H:i:s'),
        );
        $filelog_data = array(
            'file_id' => $fileid,
            'section_id' => $filedetails->file_mark_section_id,
            'to_emp_id' => emp_session_id(),
            'from_emp_id' => emp_session_id(),
            //  'fvlm_id' => '29',
            'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
            'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
        );
        $res1 = updateData(FILES, $file_data, array('file_id' => $fileid));
        if ($res1) {
            insertData($filelog_data, FILES_LOG);
            $this->session->set_flashdata('message', '<u>FIleID : ' . $fileid . '</u> Successfully Received');  }
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function notesheet_files($id = null, $notesheet_id = '', $section_id = '')
    {
        $section_exp = explode(',',getEmployeeSection());
        $section_11 = array('16','20','18','28');
        if(array_intersect($section_exp, $section_11)){
            redirect('attached/file_doc_legis/'.$id);
        }else {
        $data = array();
        $data['title'] = $this->lang->line('Add_document');
        $data['title_tab'] = $this->lang->line('title');
        $emp_section_id = getEmployeeSection();
        $data['get_files']= $this->dealing_file->getFiles_DA($emp_section_id, $id);
        $data['module_name'] = "view_file";
        $data['view_file'] = "viewfile_fornotesheet";
        if($notesheet_id != ''){
           $data['notesheet_id'] = $notesheet_id;
        }
        if($section_id != ''){
           $data['section_id'] = $section_id;
        }
        $this->template->index($data);

    }}


}