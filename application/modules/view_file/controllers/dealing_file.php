<?php
class Dealing_file extends MX_Controller{
    function __construct() {
        parent::__construct();
        $this->load->module('template');
        $this->load->language('view_file','hindi');
        $this->load->model('dealing_file_model','dealing_file');
		$this->load->library('pagination');
        authorize();
    }
    public function index($val = null)
    {
		$section_exp = explode(',',getEmployeeSection());
        $section_11 = array('16','20','18','28','19');
        if(array_intersect($section_exp, $section_11)){
                redirect('view_file_legislative/dealing_file/index/'.$val);
        }else {
        $data = array();
        $data['title'] = $this->lang->line('view_file_manue');
        $data['title_tab'] = $this->lang->line('title');
        $section_id = getEmployeeSection();
		/*Pagination*/			
		$config["is_question_mark"] = TRUE;		
		if($val == 'return'){				
			if(isset($_GET['section_id']) && $_GET['section_id']!=''){
			$config["base_url"] = base_url()."view_file/dealing_file/index/return?section_id=".$_GET['section_id'];
			}else{
				$config["base_url"] = base_url()."view_file/dealing_file/index/return?";
			 }
		}else{
			if(isset($_GET['section_id']) && $_GET['section_id']!=''){
			$config["base_url"] = base_url()."view_file/dealing_file?section_id=".$_GET['section_id'];
			}else{
				$config["base_url"] = base_url()."view_file/dealing_file?";
			 }
		}
		//$config["base_url"] = $this->current_url();
		 if($val == 'return'){
			 $total_count = $this->dealing_file->count_getFiles_DA($section_id,'2',null,null);											 
		 }else{				 
			$total_count = $this->dealing_file->count_getFiles_DA($section_id,null,null,null);								
		 }
		$data['total_files']=$total_count['totalfiles'];
		// Set total rows in the result set you are creating pagination for.
		$config['total_rows'] = $data['total_files'];
		$data['perpage']=PER_PAGE_VALUE;
		$config["per_page"] = $data['perpage'];		
		
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li class="paginate_button previous disabled" id="example1_previous">';
		$config['first_tag_close'] = '</li>';
		
		
		$config['prev_link'] = 'Previous';
		$config['prev_tag_open'] = '<li class="paginate_button previous disabled" id="example1_previous">';
		$config['prev_tag_close'] = '</li>';
		
		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li class="paginate_button next" id="example1_next">';
		$config['next_tag_close'] = '</li>';
		
		$config['full_tag_open'] ='<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		
		$config['num_tag_open'] = '<li class="paginate_button ">';
		$config['num_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = '<li class="paginate_button active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['last_link'] = 'End';
		$config['last_tag_open'] = '<li id="example1_next" class="paginate_button next">';
		$config['last_tag_close'] = '</li>';
		//$config['page_query_string'] = TRUE;
		
		$this->pagination->initialize($config);
		if(isset($_GET['per_page']) && $_GET['per_page']!=''){
			$page = $_GET['per_page'];
		}else{
			$page=0;
		}
        if($val == 'return'){			
			$data['get_files']= $this->dealing_file->getFiles_DA($section_id,'2',$config['per_page'], $page);        
		}else{			
						
			$data['get_files']= $this->dealing_file->getFiles_DA($section_id,null,$config['per_page'], $page);
        }
        if($val == 'return'){
			$data['view_file'] = "view_file/viewfile_fornotesheet";
        }else{
			$data['view_file'] = "view_file/dealing_viewfile";
        }
		$str_links = $this->pagination->create_links();
		$data["links"] = explode('&nbsp;',$str_links);			
		/*Pagination*/	
        /*if($val == 'return'){
        $data['get_files']= $this->dealing_file->getFiles_DA($section_id,'2');
        }else{
        $data['get_files']= $this->dealing_file->getFiles_DA($section_id,null);
        }
        if($val == 'return'){
			$data['view_file'] = "view_file/viewfile_fornotesheet";
        }else{
			$data['view_file'] = "view_file/dealing_viewfile";
        }*/
        $data['module_name'] = "view_file";
        $data['view_left_sidebar'] = 'admin/left_sidebar';
        $this->template->index($data);

    }
    }

	public function multi_file_sent_to_da($file_id,$mark_emp_id,$section_id,$f_status_s)
    {
        $file_dt =  getFileDetails($file_id);
        $m_empdetails = empdetails($mark_emp_id); // marked emp
        $p_empdetails = empdetails(emp_session_id()); // login emp
        $file_data = array(
            'file_received_emp_id' => $mark_emp_id,
            'file_sender_emp_id' => emp_session_id(),
            'file_progress_status_id' => '22', // File/Letter is sending to Dealing Assistant . (remark_master)
            'file_hardcopy_status' => 'not', // only two value will be save received/not
            'file_level_id' => '30',
            'file_status' => 	$f_status_s!=''?$f_status_s:'',
			'file_update_date'      => date('Y-m-d H:i:s'),
        );

        $sectionid = getusersection(emp_session_id());
        $checkUserdesignation = checkUserdesignation();
        $filelog_data = array(
            'file_id'       => $file_id,
            'section_id'    => $section_id,
            'to_emp_id'     => $mark_emp_id,
            'from_emp_id'   => emp_session_id(),
            'flog_remark'   => 'File/Letter is send to Dealing Assistant',
            'flog_ip_address'   => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
            'flog_browser_id'   => $_SERVER['HTTP_USER_AGENT'],
            'emp_degignation_id' => $checkUserdesignation,
            'file_status_log' => $f_status_s!=''?$f_status_s:'',
        );
        $form_data_move1 = array(
            'fmove_file_id'  => $file_id,
            'fmove_current_user_id'     => $mark_emp_id,
            'fmove_previous_user_id'    => emp_session_id(),
            'fmove_to_unit_id'          => getunitid($m_empdetails[0]['role_id'])==''?0:getunitid($m_empdetails[0]['role_id']),
            'fmove_from_unit_id'        => getunitid($p_empdetails[0]['role_id'])==''?0:getunitid($p_empdetails[0]['role_id']),
            'file_return'            => $file_dt->file_return,
        );

		   /*start add this on draft */
        if($file_dt->final_draft_id != '') {
            $logged_emp_is_permission = get_list_with_column(EMPLOYEE_PERMISSION_ALLOTED, 'emp_id_assign_by,emp_id_assign_to,epa_section_id,epa_designation_id', null, array('emp_id_assign_to' => $this->session->userdata("emp_id"), 'epa_module_name' => 'files'));
            $notesheet_id = get_draft($file_dt->final_draft_id, 'n');
            if($notesheet_id != ''){
            $draft_id = $notesheet_id['draft_id'];
            $query_draft = $this->db->get_where(DRAFT, array('draft_id' => $draft_id, 'draft_file_id' => $file_id, 'draft_type' => 'n'), '1');
            $draft_data_data = $query_draft->row_array();
            $draft_reciver = $draft_data_data['draft_reciever_id'];
            /*$draft_log = $this->db->get_where(DRAFT_LOG, array('draft_log_draft_id' => $draft_id, 'draft_log_creater' => $draft_reciver, 'draft_log_sendto' => $draft_reciver, 'draft_log_dispaly_status' => '0'), '1');
            $draft_log_data = $draft_log->row_array();
            $draftid_log = $draft_log_data['draft_log_id'];*/

            $draftid_log =  get_last_log_id($draft_id, $draft_reciver);


            if ($draft_reciver == emp_session_id()) {
                $draft_content = 'देखा गया |';
            } elseif ($logged_emp_is_permission['emp_id_assign_by'] == $draft_reciver) {
                $draft_content = 'अनुभाग अधिकारी अवकाश पर |';
            }

            $data_draft = array(
                'draft_sender_id' => emp_session_id(),
                'draft_reciever_id' => $mark_emp_id,
                'draft_content_text' => escape_str($draft_content),
            );
            $log_data_draft = array(
                'draft_log_creater' => emp_session_id(),
                'draft_log_sendto' => $mark_emp_id,
                'draft_log_create_date' => date('Y-m-d H:i:s'),
                'draft_log_draft_id' => $draft_id,
                'draft_log_file_id' => $file_id,
                'draft_log_section_id' => $file_dt->file_mark_section_id,
                'draft_content' => escape_str($draft_content),
                'draft_log_sublogin_creater' => $this->session->userdata("emp_id"),
                'draft_final' => 0,
            );
            if ($draftid_log != '' && $draftid_log != null && $draft_reciver == $this->session->userdata("emp_id")){

            }else{
                updateData(DRAFT, $data_draft, array('draft_id' => $draft_id));
                if($draftid_log != ''){
                    updateData(DRAFT_LOG, array('draft_log_dispaly_status' => '1' ), array('draft_log_id' => $draftid_log));
                }
                insertData($log_data_draft, DRAFT_LOG);
            }
        }
        }
        /*start add this on draft */

        $res1 = updateData(FILES, $file_data, array('file_id' => $file_id));
        if ($res1) {
            update_efile($file_id,$mark_emp_id); // use for add draft
            insertData($filelog_data, FILES_LOG);
            insertData($form_data_move1, FILES_MOVEMENT);
            $this->session->set_flashdata('message', '<u>FIleID : ' . $file_id . '</u> Successfully Sent');
        }
        return $res1;
    }
    //use for send to DA and alse return to CR . RP
    public function sent_to_da()
    {
        $file_id = $this->input->post('file_id1');
        $file_dt =  getFileDetails($file_id);
		$check_da_permission = logged_emp_is_permission();
        $current_user_emp = emp_session_id();
        $multi_user =  explode(',',$file_dt->multi_user_receiver_id);

		if($file_dt->file_received_emp_id == emp_session_id() || $check_da_permission['emp_id_assign_by'] == $file_dt->file_received_emp_id || in_array($current_user_emp,$multi_user)){

		$f_status = array();
			if($this->input->post('physical_file')){
				$f_status_s = $this->input->post('physical_file') ;
			}
			if($this->input->post('file_status')){
				foreach($this->input->post('file_status') as $file_status_val){
					$f_status[] = $file_status_val;
				}
				$f_status_s = implode($f_status,',');
			}
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
				'file_status' => 	isset($f_status_s)?$f_status_s: $file_dt->file_status,
            );
            $checkUserdesignation = checkUserdesignation();
            $file_remark = $this->input->post('file_remark');
            $filelog_data1 = array(
                'file_id'       => $file_id,
                'section_id'    => $m_empdetails[0]['emp_section_id'],
                'to_emp_id'     => $file_dt->createfile_empid,
                'from_emp_id'   => emp_session_id(),
                'flog_other_remark' => $file_remark,
                'flog_ip_address'   => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
                'flog_browser_id'   => $_SERVER['HTTP_USER_AGENT'],
				'emp_degignation_id' => $checkUserdesignation,
				'file_status_log'   => isset($f_status_s)?$f_status_s: $file_dt->file_status,
                'flog_type'         => $file_remark == '' ? '' : '2',
            );
            $form_data_move1 = array(
                'fmove_file_id'  => $file_id,
                'fmove_current_user_id'     => $file_dt->createfile_empid,
                'fmove_previous_user_id'    => emp_session_id(),
                'fmove_to_unit_id'          => getunitid($m_empdetails[0]['role_id'])==''?0:getunitid($m_empdetails[0]['role_id']),
                'fmove_from_unit_id'        => getunitid($m_empdetails[0]['role_id'])==''?0:getunitid($m_empdetails[0]['role_id']),
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
				update_efile($file_id, $file_dt->createfile_empid); // use for add draft
                insertData($filelog_data1, FILES_LOG);
                insertData($form_data_move1, FILES_MOVEMENT);
                $this->session->set_flashdata('message', '<u>FileID : ' . $file_id . '</u> Successfully Return to CR');
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
				}else { $court_bench_byso=0;}

                $m_empdetails = empdetails($this->input->post('Da_name')); // marked emp
                $p_empdetails = empdetails(emp_session_id()); // login emp

                $file_data = array(
                    'file_received_emp_id' => $this->input->post('Da_name'),
                    'file_sender_emp_id' => emp_session_id(),
                    'file_progress_status_id' => '22', // File/Letter is sending to Dealing Assistant . (remark_master)
                    'file_hardcopy_status' => 'not', // only two value will be save received/not
                    'court_bench_id' =>$court_bench_byso,
					'file_Offer_by' =>$court_bench_byso==0?'':$court_bench_byso,
					'section_file_type' => $this->input->post('section_file_type'),
                    'file_level_id' => '30',
              //      'file_unit_level' => getunitid($m_empdetails[0]['role_id']),
					'file_status' => 	$f_status_s!=''?$f_status_s:'',
					'file_update_date'      => date('Y-m-d H:i:s'),
                );
                if($this->input->post('section_file_type') == ''){
                    unset($file_data['section_file_type']);
                }

				if($court_bench_byso == 'sc'){
                    unset($file_data['court_bench_id']);
                }else{
                    unset($file_data['file_Offer_by']);
                }

                $sectionid = getusersection(emp_session_id());
                //    $Dealingass = get_list(EMPLOYEES, null, array('emp_id' => $this->input->post('Da_name')));
                $checkUserdesignation = checkUserdesignation();
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
					'emp_degignation_id' => $checkUserdesignation,
					'file_status_log' => $f_status_s!=''?$f_status_s:'',
                );


                $form_data_move1 = array(
                    'fmove_file_id'  => $file_id,
                    'fmove_current_user_id'     => $this->input->post('Da_name'),
                    'fmove_previous_user_id'    => emp_session_id(),
                    'fmove_to_unit_id'          => getunitid($m_empdetails[0]['role_id'])==''?0:getunitid($m_empdetails[0]['role_id']),
                    'fmove_from_unit_id'        => getunitid($p_empdetails[0]['role_id'])==''?0:getunitid($p_empdetails[0]['role_id']),
                    'file_return'            => $file_dt->file_return,
                );

                $res1 = updateData(FILES, $file_data, array('file_id' => $file_id));
                if ($res1) {
					update_efile($file_id,$this->input->post('Da_name')); // use for add draft
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
     }else{
		$this->session->set_flashdata('message', 'This is not your file .... plz try again');
		redirect($_SERVER['HTTP_REFERER']);
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
        $section_11 = array('16','20','18','28','19');
        if(array_intersect($section_exp, $section_11)){
            redirect('attached/file_doc_legis/'.$id);
        }else {
        $data = array();
        $data['title'] = $this->lang->line('Add_document');
        $data['title_tab'] = $this->lang->line('title');
        $emp_section_id = getEmployeeSection();
		/*
        $data['get_files']= $this->dealing_file->getFiles_DA($emp_section_id, $id);
		*/
		/*Pagination*/			
		$config["is_question_mark"] = TRUE;		
		
		if(isset($_GET['sstype']) && $_GET['sstype']!=''){
			$config["base_url"] = base_url()."attached/file_doc/1?sstype=".$_GET['sstype'];
		}else{
			$config["base_url"] = base_url()."attached/file_doc/1?";
		}		
		//$config["base_url"] = $this->current_url();
		$total_count = $this->dealing_file->count_getFiles_DA($section_id,$id,null,null);										
		$data['total_files']=$total_count['totalfiles'];
		// Set total rows in the result set you are creating pagination for.
		$config['total_rows'] = $data['total_files'];
		$data['perpage']=PER_PAGE_VALUE;
		$config["per_page"] = $data['perpage'];		
		
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li class="paginate_button previous disabled" id="example1_previous">';
		$config['first_tag_close'] = '</li>';
		
		
		$config['prev_link'] = 'Previous';
		$config['prev_tag_open'] = '<li class="paginate_button previous disabled" id="example1_previous">';
		$config['prev_tag_close'] = '</li>';
		
		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li class="paginate_button next" id="example1_next">';
		$config['next_tag_close'] = '</li>';
		
		$config['full_tag_open'] ='<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		
		$config['num_tag_open'] = '<li class="paginate_button ">';
		$config['num_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = '<li class="paginate_button active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['last_link'] = 'End';
		$config['last_tag_open'] = '<li id="example1_next" class="paginate_button next">';
		$config['last_tag_close'] = '</li>';
		//$config['page_query_string'] = TRUE;
		
		$this->pagination->initialize($config);
		if(isset($_GET['per_page']) && $_GET['per_page']!=''){
			$page = $_GET['per_page'];
		}else{
			$page=0;
		}
        $data['get_files']= $this->dealing_file->getFiles_DA($emp_section_id, $id,$config['per_page'], $page);
		$str_links = $this->pagination->create_links();
		$data["links"] = explode('&nbsp;',$str_links);			
		/*Pagination*/	
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
	public function receive_file_da($fileid='')
    {
		$f_status = array();
		if($this->input->post('file_status')){
			foreach($this->input->post('file_status') as $file_status_val){
				$f_status[] = $file_status_val;
			}
			$f_status_s = implode($f_status,',');
		}



        $filedetails =  getFileDetails($fileid);
        $file_data = array(
            'file_hardcopy_status' => 'received',
            //  'file_progress_status_id' => '29',
            'file_update_date' => date('Y-m-d H:i:s'),
			'file_status'  	   => isset($f_status_s)?$f_status_s:''
        );
        $checkUserdesignation = checkUserdesignation();
        $filelog_data = array(
            'file_id' => $fileid,
            'section_id' => $filedetails->file_mark_section_id,
            'to_emp_id' => emp_session_id(),
            'from_emp_id' => emp_session_id(),
            //  'fvlm_id' => '29',
            'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
            'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
			'emp_degignation_id' => $checkUserdesignation,
			'file_status_log'  	  => isset($f_status_s)?$f_status_s:''

        );
		//pr($filelog_data);
        $res1 = updateData(FILES, $file_data, array('file_id' => $fileid));

        if ($res1) {
            insertData($filelog_data, FILES_LOG);
			$this->session->set_flashdata('message', '<u>FIleID : ' . $fileid . '</u> Successfully Received');  }
			redirect($_SERVER['HTTP_REFERER']);
    }

}