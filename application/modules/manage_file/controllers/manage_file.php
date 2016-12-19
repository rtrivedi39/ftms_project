<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Manage_file extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->module('template');
        $this->load->model('Manage_files_model' , 'manage_model');
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

    }

    //file send.RP
    public function Send_file_us($fileid = '')
    {
        if($fileid) {
            // $filedetails =  getFileDetails($fileid);
            $senderemp = empdetails(emp_session_id());

            $qry = $this->db->query("SELECT emp_id FROM `ft_employee_hirarchi` WHERE `under_emp_id`=".emp_session_id());
            $result = $qry->row_array();
            $checkemp =   checkemp_section_byfile($fileid,$result['emp_id']);

            if(!empty($checkemp)){
                $markrd_emp = $checkemp->emp_id;
            }
            else{
                $qry1 = $this->db->query("SELECT emp_id FROM `ft_employee_hirarchi` WHERE `under_emp_id`=".$result['emp_id']);
                $result1 = $qry1->row_array();
                $checkemp1 =   checkemp_section_byfile($fileid,$result1['emp_id']);
                $markrd_emp = $checkemp1->emp_id;
            }
            if(!empty($markrd_emp)){
                $file_progress = '0';
                $send_file = filesend_nextofficer($fileid, $markrd_emp, $file_progress);
                if ($send_file) {
                    $this->session->set_flashdata('message', '<u>File id : ' . $send_file . '</u> Successfully Sent');
                }
            }
            if($senderemp[0]['role_id'] == '8') {
                redirect('view_file/index/1');
            }else{redirect('view_file/Dispaly_list');}
        }
    }


    //file receive . RP
    public function receive_by_officer($fileid = '')
    {
            if($fileid !='') {
            if($this->input->post('carry_fileemp_name')){
                $carry_empname = $this->input->post('carry_fileemp_name');
            }else{
			$carry_empname = '';
            }
           	$f_status_s = 'p';
			if($this->input->post('file_status')){
				foreach($this->input->post('file_status') as $file_status_val){
					$f_status[] = $file_status_val;
				}
				$f_status_s = implode($f_status,',');
			}
			else if($this->input->get('ft_status') != ''){
				$f_status_s = $this->input->get('ft_status');
			}
            $res = filereceive_byofficer($fileid,$carry_empname,'',$f_status_s );
            if ($res) {
                $this->session->set_flashdata('message', '<u>File id : ' . $res . '</u> Successfully Received');
                redirect($_SERVER['HTTP_REFERER']);
            }

        }
    }

    //file receive . RP
    public function receive_file_sectionno($fileid = '')
    {
        if($fileid !='') {
            $rrty = $_SERVER['HTTP_REFERER'];
            $rty1 = explode("/",$rrty);
            $empdetails =  empdetails(emp_session_id());
			
			$filedetails =  getFileDetails($fileid);
			
            if($empdetails[0]['role_id'] == 8 || in_array("today",$rty1) || $empdetails[0]['role_id'] == 37 || $empdetails[0]['role_id'] == 14 || $empdetails[0]['role_id'] == 15 || $filedetails->file_mark_section_id == '7') //this condition only for section officer .
            {               

                if($filedetails->file_mark_section_id == 0){
                    $sectionid2 = $this->input->post('section_mark1');
                }else{
                    $sectionid2 = $filedetails->file_mark_section_id;
                }
                $check_sec = getfilesec_id_byfileid($filedetails->file_id,$filedetails->file_mark_section_id);  //,$filedetails->file_type 
                if(!isset($check_sec) && $check_sec == null)
                {
                    $sectionno = $this->manage_model->plusone_fileno($filedetails->file_mark_section_id);
                   // $sectionno = $this->manage_model->plusone_fileno($sectionid2);
                    if ($sectionno != 0) {  $section_number = $sectionno; } else {  $section_number = '1'; }

                    $file_section = array(
                        'section_id' => $filedetails->file_mark_section_id,
                      //  'section_id' => $sectionid2,
                        'section_number' => $section_number,
                        'file_id'       => $fileid,
                        'file_type'   => $filedetails->file_type,
                        'file_mark_date' => date('Y-m-d H:i:s'),
                        'file_created_date' => date('Y-m-d H:i:s'),
                        'file_update_date' => date('Y-m-d H:i:s'),
                    );
				
                }
            }
            if($this->input->post('carry_fileemp_name')){
                $carry_empname = $this->input->post('carry_fileemp_name');
            }else{
                $carry_empname = '';
            }
			$f_status = array();
			if($this->input->post('physical_file')){
				$f_status_s = $this->input->post('physical_file');
			}
			else if($this->input->post('file_status')){
				foreach($this->input->post('file_status') as $file_status_val){
					$f_status[] = $file_status_val;
				}
				$f_status_s = implode($f_status,',');
			}

        //    $checksecno = getfilesec_id_byfileid($filedetails->file_id,$filedetails->file_mark_section_id,$filedetails->file_type);
        //    if(empty($checksecno)){
                $res = filereceive_byofficer($fileid,$carry_empname,$sectionid2,$f_status_s);
                if($res)
                {
                    if($empdetails[0]['role_id'] == 8  || in_array("today",$rty1) || $empdetails[0]['role_id'] == 37 || $empdetails[0]['role_id'] == 14 || $empdetails[0]['role_id'] == 15 || $filedetails->file_mark_section_id == '7') {
                        if(!isset($check_sec) && $check_sec == null) {
                            insertData($file_section, FILES_SECTION);
							update_file_tbl_for_section_no($fileid);
                            $this->session->set_flashdata('message', 'Successfully Received , <u>File Section id : ' . $section_number . '</u>');
                        }
                    }else {
                        $this->session->set_flashdata('message', '<u>File id : ' . $res . '</u> Successfully Received');
                    }
                }
        //    }else{
        //        $this->session->set_flashdata('message', 'All ready have a section no. , try again');
        //    }
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    // returns file of officer . RP
    public function return_file()
    {
        $file_id = $this->input->post('fileids');
        $ps_mark_file   = $this->input->post('ps_file_mark');
        $filedetails =  getFileDetails($file_id);
        $check_da_permission = logged_emp_is_permission(); // use for DA prmission

        if($filedetails->file_received_emp_id == emp_session_id() || $check_da_permission['emp_id_assign_by'] == $filedetails->file_received_emp_id) {

    //     $empdetails = empdetails(emp_session_id()); un-used
        $empdetails_m = empdetails($this->input->post('emp_id'));
		$f_status_s ='' ;
		if($this->input->post('file_status')){
			foreach($this->input->post('file_status') as $file_status_val){
				$f_status[] = $file_status_val;
			}
			$f_status_s = implode($f_status,',');
		}

//use for direct mark files
     //   if(($filedetails->file_mark_section_id == null || $filedetails->file_mark_section_id == 0) && ($empdetails_m[0]['role_id'] == 8 || $empdetails_m[0]['role_id'] == 37 || $empdetails_m[0]['role_id'] == 14))
		if(isset($_POST['section_id'])){
		//	if(($empdetails_m[0]['role_id'] == 8) || ($empdetails_m[0]['role_id'] == 37) ){
				 				  $marksetion = $this->input->post('section_id') != '' ? $this->input->post('section_id') : $filedetails->file_mark_section_id;
		//	}
		}else{
			 if(($empdetails_m[0]['role_id'] == 8 || $empdetails_m[0]['role_id'] == 37 || $empdetails_m[0]['role_id'] == 14 || $empdetails_m[0]['role_id'] == 15)){
				$marksetion =  $empdetails_m[0]['emp_section_id'];
			}else{
				$marksetion =  $filedetails->file_mark_section_id;
			}
		}
        $empdetails_rr = empdetails($filedetails->file_sender_emp_id);

          $empssection = empdetails(emp_session_id());
        if(checkUserrole()==3 || $empssection[0]['role_id']==3){
            $file_return = '1';
        }else if($empdetails_rr[0]['role_id']==2){
            $file_return = '0';
        }else if(checkUserrole()==8 && $empdetails_rr[0]['role_id']<checkUserrole()){
            $file_return = '0';
        }else if($empdetails_rr[0]['role_id'] == '9'){
            $file_return = '0';
        }else{
            $file_return = '1';
        }
		if($this->input->post('ps_moniter_date') && $this->input->post('ps_moniter_date')!=''){
           $ps_moniter_date = date('Y-m-d',strtotime($this->input->post('ps_moniter_date')));
           $file_data = array(
            'file_received_emp_id' => $this->input->post('emp_id'),
            'file_sender_emp_id' => emp_session_id(),
            'file_return' => $file_return,
            'file_hardcopy_status' => 'not',
            'file_mark_section_date' => date('Y-m-d H:i:s'),
            'file_update_date' => date('Y-m-d H:i:s'),
			'file_mark_section_id' => $marksetion,
			'ps_mark_monitor_date' => date('Y-m-d H:i:s'),
            'ps_moniter_date' =>$ps_moniter_date ,
			'file_status' => isset($f_status_s)?$f_status_s:$filedetails->file_status  ,
            );
        }else{ $ps_moniter_date='';
             $file_data = array(
            'file_received_emp_id' => $this->input->post('emp_id'),
            'file_sender_emp_id' => emp_session_id(),
            'file_return' => $file_return,
            'file_hardcopy_status' => 'not',
            'file_mark_section_date' => date('Y-m-d H:i:s'),
            'file_update_date' => date('Y-m-d H:i:s'),
			'file_mark_section_id' => $marksetion,
			'file_status' => isset($f_status_s)?$f_status_s:$filedetails->file_status  ,
            );
        }
        if(isset($ps_mark_file) && $ps_mark_file != '') {
            $file_data['ps_mark_file'] = isset($ps_mark_file) ? $ps_mark_file : null;
        }
        $checkUserdesignation = checkUserdesignation();
		$psmonitdate = '';
        if(isset($ps_moniter_date) && $this->input->post('ps_moniter_date') != ''){
        $psmonitdate = "( पी .एस. मॉनिटर दिनांक : ".date('d-m-Y',strtotime($this->input->post('ps_moniter_date')))." )";  }
		
        $filelog_data = array(
            'file_id' => $file_id,
            'section_id' => $marksetion,
            'to_emp_id' => $this->input->post('emp_id'),
            'from_emp_id' => emp_session_id(),
            'flog_other_remark' => $this->input->post('rmk1')." ".$psmonitdate,
            'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
            'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
			'emp_degignation_id' => $checkUserdesignation,
			'sublogin' => $this->session->userdata('emp_id'),
			'file_status_log' => isset($f_status_s)?$f_status_s:$filedetails->file_status  ,
        );

        $form_data_move1 = array(
            'fmove_file_id'  => $file_id,
            'fmove_current_user_id'  => $this->input->post('emp_id'),
            'fmove_previous_user_id' => emp_session_id(),
            'fmove_to_unit_id'       => getunitid($empdetails_m[0]['role_id'])==''?0:getunitid($empdetails_m[0]['role_id']),
            'fmove_from_unit_id' => getunitid($empssection[0]['role_id']) == '' ? 0 : getunitid($empssection[0]['role_id']),
            'file_return'            => $file_return,
        );
        // pr(array_merge($file_data,$form_data_move1));
        $res1 = updateData(FILES, $file_data, array('file_id' => $file_id));
        if ($res1) {
            if(emp_session_id() == '2' && $this->input->post('ps_moniter_date') && $this->input->post('ps_moniter_date')!='') { // 2 is ps empid
                file_monitor_sms_sent(null, $this->input->post('emp_id'), $file_id, $file_return);
            }
            if($filedetails->final_draft_id != null || $filedetails->final_draft_id != 0){
                update_efile($file_id, $this->input->post('emp_id')); // use for add draft on file
				if($filelog_data['flog_other_remark'] != ''){
                        insertData($filelog_data, FILES_LOG);
                    }				
            }else{
                insertData($filelog_data, FILES_LOG);
            }
            insertData($form_data_move1, FILES_MOVEMENT);
        }
        // redirect('view_file/Dispaly_list/1');
        // redirect('view_file/Dispaly_list');
        redirect($_SERVER['HTTP_REFERER']);
        }else{
        //    $this->session->set_flashdata('error', 'यह नस्ती आपकी ID पे नही है  |');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

	public function multi_file_send_upper_officer($fileid,$rmk1,$markrd_emp,$section_id,$file_status)
    {
        $f_status = array();
        if($fileid) {
            $file_progress = '0';
            if($section_id!=''){
                $send_file = filesend_nextofficer($fileid, $markrd_emp, $file_progress,$rmk1 ,$section_id, $file_status);
            }
            else{
                $send_file = filesend_nextofficer($fileid, $markrd_emp, $file_progress,$rmk1,'', $file_status);
            }
            $result = update_efile($fileid, $markrd_emp); // USE FOR ADD DRAFT
        }
        return $result;
    }

	public function multi_return_file($file_id,$mark_emp_id,$section_id)
    {
        $filedetails =  getFileDetails($file_id);
        $empdetails = empdetails(emp_session_id());
        $empdetails_m = empdetails($mark_emp_id);
		if(isset($section_id)){
				  $marksetion = $section_id;
		}else{
			 if(($empdetails_m[0]['role_id'] == 8 || $empdetails_m[0]['role_id'] == 37 || $empdetails_m[0]['role_id'] == 14)){
				$marksetion =  $empdetails_m[0]['emp_section_id'];
			}else{
				$marksetion =  $filedetails->file_mark_section_id;
			}
		}
        $empdetails_rr = empdetails($filedetails->file_sender_emp_id);
          $empssection = empdetails(emp_session_id());
        if(checkUserrole()==3 || $empssection[0]['role_id']==3){
            $file_return = '1';
        }else if($empdetails_rr[0]['role_id']==2){
            $file_return = '0';
        }else if(checkUserrole()==8 && $empdetails_rr[0]['role_id']<checkUserrole()){
            $file_return = '0';
        }else if($empdetails_rr[0]['role_id'] == '9'){
            $file_return = '0';
        }else{
            $file_return = '1';
        }
		if($this->input->post('ps_moniter_date') && $this->input->post('ps_moniter_date')!=''){
           $ps_moniter_date = date('Y-m-d',strtotime($this->input->post('ps_moniter_date')));
           $file_data = array(
            'file_received_emp_id' => $mark_emp_id,
            'file_sender_emp_id' => emp_session_id(),
            'file_return' => $file_return,
            'file_hardcopy_status' => 'not',
            'file_mark_section_date' => date('Y-m-d H:i:s'),
            'file_update_date' => date('Y-m-d H:i:s'),
			'file_mark_section_id' => $marksetion,
			'ps_mark_monitor_date' => date('Y-m-d H:i:s'),
            'ps_moniter_date' =>$ps_moniter_date ,
            );
        }else{ $ps_moniter_date='';
             $file_data = array(
            'file_received_emp_id' => $mark_emp_id,
            'file_sender_emp_id' => emp_session_id(),
            'file_return' => $file_return,
            'file_hardcopy_status' => 'not',
            'file_mark_section_date' => date('Y-m-d H:i:s'),
            'file_update_date' => date('Y-m-d H:i:s'),
			'file_mark_section_id' => $marksetion,
            );
        }
        $checkUserdesignation = checkUserdesignation();
        $filelog_data = array(
            'file_id' => $file_id,
            'section_id' => $marksetion,
            'to_emp_id' => $mark_emp_id,
            'from_emp_id' => emp_session_id(),
            'flog_other_remark' => $this->input->post('rmk1'),
            'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
            'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
			'emp_degignation_id' => $checkUserdesignation
        );

        $form_data_move1 = array(
            'fmove_file_id'  => $file_id,
            'fmove_current_user_id'  => $mark_emp_id,
            'fmove_previous_user_id' => emp_session_id(),
            'fmove_to_unit_id'       => getunitid($empdetails_m[0]['role_id'])==''?0:getunitid($empdetails_m[0]['role_id']),
            'fmove_from_unit_id'     => getunitid($empdetails[0]['role_id'])==''?0:getunitid($empdetails[0]['role_id']),
            'file_return'            => $file_return,
        );
        $res1 = updateData(FILES, $file_data, array('file_id' => $file_id));
        if ($res1) {
			update_efile($file_id, $mark_emp_id); // use for add draft on file
			file_monitor_sms_sent(null,$mark_emp_id,$file_id,$file_return);
            insertData($filelog_data, FILES_LOG);
            insertData($form_data_move1, FILES_MOVEMENT);
        }
		return 1;
    }

    // returns file to dealing assistant . RP
    public function return_file_da()
    {
        $file_id = $this->input->post('fileids');
        $filedetails =  getFileDetails($file_id);
        $this->form_validation->set_rules('emp_id', 'emp_id', 'trim|required|xss_clean');
        if ($this->form_validation->run($this) === TRUE) {
            $file_data = array(
                'file_received_emp_id' => $this->input->post('emp_id'),
                'file_sender_emp_id' => emp_session_id(),
                'file_hardcopy_status' => 'not',
                'file_update_date' => date('Y-m-d H:i:s'),
            );
            $checkUserdesignation = checkUserdesignation();
            $filelog_data = array(
                'file_id' => $file_id,
                'section_id' => $filedetails->file_mark_section_id,
                'to_emp_id' => $this->input->post('emp_id'),
                'from_emp_id' => emp_session_id(),
                //   'fvlm_id' => '22',
                // 'flog_remark' => 'File/Letter is send to Dealing Assistant',
                'flog_other_remark' => $this->input->post('rmk1'),
                'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
                'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
				'emp_degignation_id' => $checkUserdesignation
            );
            // pr(array_merge($file_data,$form_data_move1));
            $res1 = updateData(FILES, $file_data, array('file_id' => $file_id));
            if ($res1) {
                insertData($filelog_data, FILES_LOG);
            }
        }
        redirect('view_file/index/return');
    }
    // Send file to dispatch
    public function dispatch_file_byso($file_id = null)
    {
		$file_id = !empty($this->input->post('dis_file_id')) ? $this->input->post('dis_file_id') : $file_id ;
		$remark = !empty($this->input->post('remark')) ? $this->input->post('remark') : '' ;
		$dispatch_name = !empty($this->input->post('dispatch_name')) ? $this->input->post('dispatch_name') : '' ;
		$file_types = !empty($this->input->post('file_types')) ? $this->input->post('file_types') : '' ;
		//$array = array_filter($dispatch_name);
		foreach($dispatch_name as $dispatch_na)
		{
			if(!empty(trim($dispatch_na)) && trim($dispatch_na) != null && trim($dispatch_na) !='' ){
				$dispatch_name[] = $dispatch_na;
			}
		}
		//pr(array_filter($dispatch_name));
        //pr($file_id);
		if($this->input->post('file_status')){
				foreach($this->input->post('file_status') as $file_status_val){
					$f_status[] = $file_status_val;
				}
				$f_status_s = implode($f_status,',');
			}
        $filedetails =  getFileDetails($file_id);
        $markemp = getuserbyrole('8','37'); // section id , roleid (incharge)
		$file_data = array(
            'file_received_emp_id' => $markemp[0]['emp_id'],
            'file_sender_emp_id' => emp_session_id(),
            'file_return' => '2', // 2 for dispatch
            'file_hardcopy_status' => 'not',
            'file_unit_level' => '58',
            //    'file_mark_section_date' => date('Y-m-d H:i:s'),
            'file_update_date' => date('Y-m-d H:i:s'),
			'dispatch_lists' => json_encode(array_unique(array_filter($dispatch_name))),
			'dispetch_file_type' => isset($file_types)? $file_types :'',
			'file_status' => isset($f_status_s)?$f_status_s:$filedetails->file_status
			
        );
		//pr($file_data);
        $checkUserdesignation = checkUserdesignation();
        $filelog_data = array(
            'file_id' => $file_id,
            'section_id' => '8',
            'to_emp_id' => $markemp[0]['emp_id'],
            'from_emp_id' => emp_session_id(),
            'flog_other_remark' => 'File marked to dispatch section:- '.$file_types,
            'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
            'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
			'emp_degignation_id' => $checkUserdesignation,
			'flog_remark' => isset($remark)?$remark:'' ,
		    'file_status_log' => isset($f_status_s)?$f_status_s:$filedetails->file_status
        );
        $empdetails = empdetails(emp_session_id());
        $empdetails_m = empdetails($markemp[0]['emp_id']);
        $form_data_move1 = array(
            'fmove_file_id'  => $file_id,
            'fmove_current_user_id'  => $markemp[0]['emp_id'],
            'fmove_previous_user_id' => emp_session_id(),
            'fmove_to_unit_id'       => getunitid($empdetails_m[0]['role_id'])==''?0:getunitid($empdetails_m[0]['role_id']),
            'fmove_from_unit_id'     => getunitid($empdetails[0]['role_id'])==''?0:getunitid($empdetails[0]['role_id']),
            'file_return'            => '2',
        );
//         pr(array_merge($file_data,$filelog_data,$form_data_move1));
        if(isset($markemp) && $markemp != '' && $markemp != null)
        {
            $res1 = updateData(FILES, $file_data, array('file_id' => $file_id));
            if ($res1) {
                insertData($filelog_data, FILES_LOG);
                insertData($form_data_move1, FILES_MOVEMENT);
                $this->session->set_flashdata('message', '<u>File id : ' . $file_id . '</u> Successfully Send');
            }
        } else{ $this->session->set_flashdata('error', '<span class="text-bold">Marked user is not found, try after some time</span>');
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function update_dispatch_file($file_id = null)
    {
        $fileid = !empty($this->input->post('dis_file_id')) ? $this->input->post('dis_file_id') : '' ;
        $dispatch_name = !empty($this->input->post('dispatch_name')) ? $this->input->post('dispatch_name') : '' ;

        $empdetails = empdetails(emp_session_id());
        if($fileid !='') {
            $filedetails =  getFileDetails($fileid);

            if($empdetails[0]['role_id'] == 8 || $empdetails[0]['role_id'] == 37) //this condition only for section officer and prabhari .
            {
                //entry in files_section
                $sectionno = $this->manage_model->plusone_fileno('8');
                if ($sectionno != 0) {
                    $section_number = $sectionno;
                } else {
                    $section_number = '1';
                }
                $file_section = array(
                    'section_id'        => '8',
                    'section_number'    => $section_number,
                    'file_id'           => $fileid,
                    'file_type'   => $filedetails->file_type,
                    'file_mark_date'     => date('Y-m-d H:i:s'),
                    'file_created_date'  => date('Y-m-d H:i:s'),
                    'file_update_date'   => date('Y-m-d H:i:s'),
				
                );
            }

            $file_data = array(
                'file_hardcopy_status'       => 'received',
                'file_update_date'           => date('Y-m-d H:i:s'),
                'dispatch_lists' => json_encode(array_filter($dispatch_name)),
				'file_status' => isset($filedetails->file_status)?$filedetails->file_status:''
            );
            if($this->input->post('carry_fileemp_name')){
                $carry_empname = $this->input->post('carry_fileemp_name');
            }else{
                $carry_empname = '';
            }
            $checkUserdesignation = checkUserdesignation();
            $filelog_data = array(
                'file_id'       => $fileid,
                'section_id'    => '8',
                'to_emp_id'     => emp_session_id(),
                'from_emp_id'   => emp_session_id(),
                //    'fvlm_id'       => '29',
                'hardcopy_carry_empname' => $carry_empname,
                'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
                'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
				'emp_degignation_id' => $checkUserdesignation,
				'file_status_log' =>  isset($filedetails->file_status)?$filedetails->file_status:''
            );
            $empdetails = empdetails(emp_session_id());
            $form_data_move1 = array(
                'fmove_file_id'  => $fileid,
                'fmove_current_user_id'  => emp_session_id(),
                'fmove_previous_user_id' => emp_session_id(),
                'fmove_to_unit_id'       => getunitid($empdetails[0]['role_id'])==''?0:getunitid($empdetails[0]['role_id']),
                'fmove_from_unit_id'     => getunitid($empdetails[0]['role_id'])==''?0:getunitid($empdetails[0]['role_id']),
            );
            $res1 = updateData(FILES, $file_data, array('file_id' => $fileid));
            if ($res1) {
                insertData($filelog_data, FILES_LOG);
                insertData($form_data_move1, FILES_MOVEMENT);
                if($empdetails[0]['role_id'] == 8 || $empdetails[0]['role_id'] == 37) //this condition only for section officer and prabhari .
                {
                    insertData($file_section, FILES_SECTION);
                    $this->session->set_flashdata('message', 'Successfully Received , <u>File Section id : '.$section_number.'</u>');
                }

            }
           redirect($_SERVER['HTTP_REFERER']);
        }

    }

       //file receive by dispatch section . RP
    public function receive_file_dispatch($fileid = '')
    {
        $empdetails = empdetails(emp_session_id());
        if($fileid !='') {
            $filedetails =  getFileDetails($fileid);

            if($empdetails[0]['role_id'] == 8 || $empdetails[0]['role_id'] == 37) //this condition only for section officer and prabhari .
            {
                //entry in files_section
                $sectionno = $this->manage_model->plusone_fileno('8');
                if ($sectionno != 0) {
                    $section_number = $sectionno;
                } else {
                    $section_number = '1';
                }
                $check_sec = getfilesec_id_byfileid($filedetails->file_id, '8', $filedetails->file_type);
                if (!isset($check_sec) && $check_sec == null) {
                    $file_section = array(
                        'section_id' => '8',
                        'section_number' => $section_number,
                        'file_id' => $fileid,
                        'file_type' => $filedetails->file_type,
                        'file_mark_date' => date('Y-m-d H:i:s'),
                        'file_created_date' => date('Y-m-d H:i:s'),
                        'file_update_date' => date('Y-m-d H:i:s'),
                    );
                }
            }
            $file_data = array(
                'file_hardcopy_status'       => 'received',
                'file_update_date'           => date('Y-m-d H:i:s'),
            );
            if($this->input->post('carry_fileemp_name')){
                $carry_empname = $this->input->post('carry_fileemp_name');
            }else{
                $carry_empname = '';
            }
            $checkUserdesignation = checkUserdesignation();
            $filelog_data = array(
                'file_id'       => $fileid,
                'section_id'    => '8',
                'to_emp_id'     => emp_session_id(),
                'from_emp_id'   => emp_session_id(),
                'hardcopy_carry_empname' => $carry_empname,
                'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
                'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
				'emp_degignation_id' => $checkUserdesignation
            );
            $empdetails = empdetails(emp_session_id());
            $form_data_move1 = array(
                'fmove_file_id'  => $fileid,
                'fmove_current_user_id'  => emp_session_id(),
                'fmove_previous_user_id' => emp_session_id(),
                'fmove_to_unit_id'       => getunitid($empdetails[0]['role_id'])==''?0:getunitid($empdetails[0]['role_id']),
                'fmove_from_unit_id'     => getunitid($empdetails[0]['role_id'])==''?0:getunitid($empdetails[0]['role_id']),
            );
            $res1 = updateData(FILES, $file_data, array('file_id' => $fileid));
            if ($res1) {
                insertData($filelog_data, FILES_LOG);
                insertData($form_data_move1, FILES_MOVEMENT);
                if($empdetails[0]['role_id'] == 8 || $empdetails[0]['role_id'] == 37) //this condition only for section officer and prabhari .
                {
                    $check_sec = getfilesec_id_byfileid($filedetails->file_id, '8', $filedetails->file_type);
                    if (!isset($check_sec) && $check_sec == null) {
                        insertData($file_section, FILES_SECTION);
                        $this->session->set_flashdata('message', 'Successfully Received , <u>File Section id : ' . $section_number . '</u>');
                    }else{
                        $this->session->set_flashdata('message', 'Successfully Received , <u>File Received</u>');
                    }
                }

            }
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    //RP
   
   public function dispatch_for_close()
    {
        //add scan files
        $file_id_close = $this->input->post('fileids2');
        $file_deatils = getFiledata($file_id_close);
        $drafts = $file_deatils[0]['final_draft_id'];
        $scan_ids = $file_deatils[0]['scan_id'];


        $file_data = array(
            'file_level_id' => '33',
            'file_return' => '2',
            'file_hardcopy_status' => 'close',
            'file_update_date' => date('Y-m-d H:i:s'),
        );
		/*
		//  add id on scan id col in file table and generate pdf
        if($drafts != null || $drafts != 0){
            $orders = get_draft($drafts, 'n', true, true);  // get all orders from lists
            foreach($orders  as $order){
                ob_clean();
                $pathof = 'uploads/scan/'.$file_deatils[0]['file_mark_section_id'].'/'.date('Y').'/department';
                $namepdf ='order_'.uniqid();
                $response = generate_PDF($order->draft_content_text, $namepdf,$pathof);
                //addd to scan
                if($response == true){

                    $form_scan_data = array(
                        'scan_type' => 'full',
                        'scan_file_type' => '4',
                        'scan_subfile_types' => '15',
                        'scan_section_id' => $file_deatils[0]['file_mark_section_id'],
                        'scan_meta_key' => 'order,Other,law department',
                        'scan_subject' => $this->input->post('file_subject'),
                        'scan_creator_id' => emp_session_id(),
                        'scan_file_from_type' => 'o',
                        'scan_file_from_place' => 'law department',
                        'scan_created_date' => date('Y-m-d H:i:s'),
                        'scan_update_date' => date('Y-m-d H:i:s'),
                        'scan_file_path' => $pathof.'/'.$namepdf.'.pdf',
                    );
                   $res[] = insertData_with_lastid($form_scan_data, FILE_SCAN);

                    $existscan = $file_deatils[0]['scan_id'];
                    if(isset($existscan) && !empty($existscan)) {
                        $existscan1 = unserialize($existscan);
                        $scan_data1 = array_merge($existscan1, $res);
                    }
                    else {
                        $scan_data1 = $res;
                    }
                    $file_data['scan_id'] = serialize($scan_data1);
                    $upload_f_multi[] =  $pathof.'/'.$namepdf.'.pdf';
                }
            }
        }
		// end of add id on scan id col in file table and generate pdf 
		*/
	    $mobile_no =  $this->input->post('mobile_number') ;
        $upload_f_multi = '';
        $file_data_log11 = array(
            'document_path'  => implode(',',$upload_f_multi) // log data
        );
        if($_FILES['proof_dispatch']){
            $proof_name = uploadalltypeFile('proof_dispatch' , './uploads/dispatch/' );
        } else {
            $proof_name = '';
        }
        $dispatch_file = array(
            'file_id'            => $this->input->post('fileids2'),
            'emp_id'             => emp_session_id(),
            'cost_of_dispatch'   => $this->input->post('cost_dispatch')==''?0:$this->input->post('cost_dispatch'),
            'remark'             => $this->input->post('rmk2'),
            'url_proof_dispatch' => $proof_name,
            'dispatch_date'      => date('Y-m-d H:i:s'),

        );
        $dispatchno = insertData_with_lastid($dispatch_file, FILES_DISPATCH);
		$file_deatils = getFiledata($this->input->post('fileids2'));
		$dispatched_no = getfilesec_id_byfileid($file_deatils[0]['file_id'],8,$file_deatils[0]['file_type']) ? getfilesec_id_byfileid($file_deatils[0]['file_id'],8,$file_deatils[0]['file_type']) : 'N/a' ;
        $checkUserdesignation = checkUserdesignation();
        $filelog_data = array(
            'file_id' => $this->input->post('fileids2'),
            'section_id' => '8',
            'to_emp_id' => emp_session_id(),
            'from_emp_id' => emp_session_id(),
            'flog_other_remark' =>'File is Successfully Dispatched by '.$dispatched_no,
            'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
            'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
            'fvlm_id' => '1', // 1 for close file which is out of department
			'emp_degignation_id' => $checkUserdesignation
        );
        
        $log1 = array_merge($filelog_data,$file_data_log11);
        if($dispatchno){
            updateData(FILES, $file_data, array('file_id' => $this->input->post('fileids2')));
			insertData($log1, FILES_LOG);
            $this->session->set_flashdata('message', '<u>File id : ' . $this->input->post('fileids2') . '</u> Successfully Dispatch and Dispatch ID is '.$dispatchno);
			$file_deatils = getFiledata($this->input->post('fileids2'));
			$dispatched_no = getfilesec_id_byfileid($file_deatils[0]['file_id'],8,$file_deatils[0]['file_type']) ? getfilesec_id_byfileid($file_deatils[0]['file_id'],8,$file_deatils[0]['file_type']) : 'N/a' ;
			$message = "Dear Sir/Mdm, File with UO No. ".$file_deatils[0]['file_uo_or_letter_no']." received from ".$file_deatils[0]['dept_name_en']." on ".get_date_formate($file_deatils[0]['file_created_date'],'d/m/Y')." is dispatched with Dispatch No ".$dispatched_no.".";
			//echo strlen($message);
			$numbers = explode(',',$mobile_no);
			$mobile_nos = '';
			foreach($numbers as $number){				
				if(strlen($number) == 10){
					$mobiles[] = $number;
				}
			}			
			$mobile_nos = implode(',',$mobiles);						
			if($mobile_nos != ''){						
				send_sms($mobile_nos, $message);
				$sms_data = array(
					'sms_file_id'  => $file_deatils[0]['file_id'],
					'sms_emp_id'  => 0,
					'sms_file_move' => '1',
					'sms_text'=> $message.'------Mobile number--------'.$mobile_no,
					'sms_create_date' => date('Y-m-d h:i:s'),
				);
				insertData($sms_data,'ft_file_monitor_sms');
			}
        }
        $this->move_working_to_master_file($file_id_close );
        redirect('view_file');
    }	
     public function move_working_to_master_file($id)
	{
			$vv = "ft_";
			
			$query9 ="INSERT $vv".DIGITAL_SINATURE_MASTER." SELECT * FROM $vv".DIGITAL_SINATURE." WHERE ds_file_id =$id";
			$query =$this->db->query($query9);
			
			$query7 ="INSERT $vv".DRAFT_LOG_MASTER." SELECT * FROM $vv".DRAFT_LOG." WHERE draft_log_file_id =$id";
			$query =$this->db->query($query7);
			
			$query1 ="INSERT $vv".FILES_MASTER."  SELECT * FROM $vv".FILES." WHERE file_id=$id";
			$query =$this->db->query($query1);
			
			$query2 ="INSERT $vv".FILES_MOVEMENT_MASTER." SELECT * FROM $vv".FILES_MOVEMENT." WHERE fmove_file_id =$id";
			$query =$this->db->query($query2);
			
			$query3 ="INSERT $vv".FILES_LOG_MASTER." SELECT * FROM $vv".FILES_LOG." WHERE file_id =$id";
			$query =$this->db->query($query3);			
			
			
			$query4 ="DELETE FROM $vv".FILES." WHERE file_id=$id";
			$query =$this->db->query($query4);
			
			$query5 ="DELETE FROM $vv".FILES_MOVEMENT." WHERE fmove_file_id =$id";
			$query =$this->db->query($query5);
			
			$query6 ="DELETE FROM $vv".FILES_LOG." WHERE file_id =$id;";
			$query =$this->db->query($query6);

			//for draft log
			$query8 ="DELETE FROM $vv".DRAFT_LOG." WHERE draft_log_file_id = $id;";
			$query =$this->db->query($query8);
			
			$query10 ="DELETE FROM $vv".DIGITAL_SINATURE." WHERE ds_file_id = $id;";
			$query =$this->db->query($query10);
		
		
		
	}
    public function dispatch_for_close_byso()
    {
        $file_id = $this->input->post('filedis_id');
        $filedetails =  getFileDetails($file_id);
		$emp_session_id = emp_session_id();
       // pr($filedetails->file_mark_section_id);
        $file_data = array(
            'file_level_id' => '33', //file close for 33
            'file_return' => '2', // 2 for dispatch
            'file_hardcopy_status' => 'close', 
            'file_update_date' => date('Y-m-d H:i:s'),
        );
       
        $dispatch_file = array(
            'file_id'            => $file_id,
            'emp_id'             => $emp_session_id,
            'cost_of_dispatch'   => 0,
            'remark'             => $this->input->post('filedis_msg'),
            'url_proof_dispatch' => 'Dispose in Section',
            'dispatch_date'      => date('Y-m-d H:i:s'),
            'issection_despose'      => 1,

        );
        $dispatchno = insertData_with_lastid($dispatch_file, FILES_DISPATCH);
        $checkUserdesignation = checkUserdesignation();
        $filelog_data = array(
            'file_id' => $file_id,
            'section_id' => $filedetails->file_mark_section_id,
             'to_emp_id' => $emp_session_id,
            'from_emp_id' => $emp_session_id,
            'flog_other_remark' => $this->input->post('filedis_msg') != '' ? $this->input->post('filedis_msg') : 'File is Successfully Disposed.', //$dispatchno
			'flog_remark' => $this->input->post('filedis_msg').'---File is Successfully Disposed.',
            'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
            'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
            'fvlm_id' => '1', // 1 for close file 
			'emp_degignation_id' => $checkUserdesignation
        );

		$empdetails = empdetails($emp_session_id);
        $form_data_move_m = array(
            'fmove_file_id'  => $file_id,
            'fmove_current_user_id'  => $emp_session_id,
            'fmove_previous_user_id' => $emp_session_id,
            'fmove_to_unit_id'       => getunitid($empdetails[0]['role_id'])==''?0:getunitid($empdetails[0]['role_id']),
            'fmove_from_unit_id'     => getunitid($empdetails[0]['role_id'])==''?0:getunitid($empdetails[0]['role_id']),
            'file_return'     		 => '2',
        );
		
        if($dispatchno){
            updateData(FILES, $file_data, array('file_id' => $file_id));
			insertData($form_data_move_m, FILES_MOVEMENT);
            insertData($filelog_data, FILES_LOG);
            $this->session->set_flashdata('message', '<u>File id : ' . $file_id . '</u> Successfully Dispose and Dispose ID is '.$dispatchno);
        }
       // redirect('view_file');
           $this->move_working_to_master_file($file_id);
        redirect($_SERVER['HTTP_REFERER']);
    }



    //new function for send file to upper level officer reference by upper function  Send_file_us
    public function Sendfile_upperofficer($fileid = null)
    {
        if($fileid == null) {
            $fileid = $this->input->post('fileids2');
        }
        $rmk1 = $this->input->post('rmk1');
        $markrd_emp = $this->input->post('emp_id2');
		$f_status = array();
			if($this->input->post('file_status')){
				foreach($this->input->post('file_status') as $file_status_val){
					$f_status[] = $file_status_val;
				}
				$f_status_s = implode($f_status,',');
			}
        if($fileid) {
            $file_progress = '0';
			if($this->input->post('section_id')){
				$section_id = $this->input->post('section_id');
				$send_file = filesend_nextofficer($fileid, $markrd_emp, $file_progress,$rmk1 ,$section_id, $f_status_s);
			}
			else{
				$send_file = filesend_nextofficer($fileid, $markrd_emp, $file_progress,$rmk1,'', $f_status_s);
			}
			
            if ($send_file) {
                $this->session->set_flashdata('message', '<u>File id : ' . $send_file . '</u> Successfully Sent');
            }
		//	update_efile($fileid, $markrd_emp); // USE FOR ADD DRAFT
        }
        redirect($_SERVER['HTTP_REFERER']);

    }

    //return file to CR by SO only in case of wrong file come .
	// this function is replaced by reject_to_cr .
    public function reject_file($file_id = null)
    {
        if ($file_id != null) {
            //  $crsectionid = '1'; // cr section id
            $filedetails =  getFileDetails($file_id);
            $file_data = array(
                'file_received_emp_id' => $filedetails->file_sender_emp_id,
                'file_sender_emp_id' => $filedetails->file_received_emp_id,
              //  'file_mark_section_id' => $filedetails->file_from_section_id,
              //  'file_from_section_id' => $filedetails->file_mark_section_id,
                //  'file_mark_section_id' => $crsectionid,
                'file_mark_section_date' => date('Y-m-d H:i:s'),
                'file_hardcopy_status' => 'not',
                'file_update_date' => date('Y-m-d H:i:s'),
                'file_return'            => '1',
            );
            $checkUserdesignation = checkUserdesignation();
            $filelog_data = array(
                'file_id' => $file_id,
                'section_id' => $filedetails->file_mark_section_id,
                'to_emp_id' => $filedetails->file_sender_emp_id,
                'from_emp_id' => $filedetails->file_received_emp_id,
                'flog_other_remark' => $this->input->post('rmk1')."File return",
                'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
                'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
				'emp_degignation_id' => $checkUserdesignation
            );
            $empreciver = empdetails($filedetails->file_sender_emp_id);
            $empsender = empdetails($filedetails->file_received_emp_id);
            $form_data_move1 = array(
                'fmove_file_id'  => $file_id,
                'fmove_current_user_id'  => $filedetails->file_sender_emp_id,
                'fmove_previous_user_id' => $filedetails->file_received_emp_id,
                'fmove_sectionid_to' => $filedetails->file_from_section_id,
                'fmove_sectionid_from' => $filedetails->file_mark_section_id,
                'fmove_to_unit_id'       => getunitid($empreciver[0]['role_id'])==''?0:getunitid($empreciver[0]['role_id']),
                'fmove_from_unit_id'     => getunitid($empsender[0]['role_id'])==''?0:getunitid($empsender[0]['role_id']),
                'file_return'            => '1',
            );
            // pr(array_merge($file_data,$form_data_move1));
            $res1 = updateData(FILES, $file_data, array('file_id' => $file_id));
            if ($res1) {
                insertData($filelog_data, FILES_LOG);
                insertData($form_data_move1, FILES_MOVEMENT);
                $this->session->set_flashdata('message', '<u>File id : ' . $file_id . '</u> Successfully Rejected');
            }
        }
        redirect('view_file');
    }

    public function show_404() {
        $this->load->view('404');
    }
	
	function ajax_get_section_head(){
		$request_for='';
		$section_id = $this->input->post('section_id');
		$section_list = get_list_orderwise(HEADS_MASTER,array('col'=>'head_title','order'=>'ASC'),array('section_id'=>$section_id),null);
		echo json_encode($section_list);
        exit();
	}

	function ajax_get_section_file_type(){
		$request_for='';
		$section_id = $this->input->post('section_id');
		if($section_id == 15){
			$section_file_type = get_prosecution_file_type();
		}
		if($section_id == 12){
			$section_file_type = get_BII_file_type();
		}
		if($section_id == 11){
			$section_file_type = get_BI_file_type();
		}
		if($section_id == 19){
			$section_file_type = get_lib_file_type();
		} else {
			$section_file_type = '';
		}

		//print_r($section_file_type);

		echo json_encode($section_file_type);
      //  exit();
	}
	
	   public function section_to_section($fileid = null)
    {
		
		$rmk1 = $this->input->post('rmk1');
        $markrd_section = $this->input->post('section_mark');
        $sectionrole_user = so_by_roleandsection();
        $markrole =  $sectionrole_user[$markrd_section];
        $receiver_id = user_byrole_section($markrd_section,$markrole);

        if($fileid != null) {
            $file_progress = '0';
            $send_file = section_to_sectionmove($fileid, $receiver_id['emp_id'], $markrd_section, $rmk1);
            if ($send_file) {
				update_efile($fileid, $receiver_id['emp_id']); // USE FOR ADD DRAFT
                $this->session->set_flashdata('message', '<u>File id : ' . $send_file . '</u> Successfully Sent');
            }
        }
        redirect($_SERVER['HTTP_REFERER']);
    }	    //send return file and upper level reject
    public function send_file_return($file_id = null)
    {
        $filedetails =  getFileDetails($file_id);
        if ($file_id != null || emp_session_id() == $filedetails->file_sender_emp_id || emp_session_id() == $filedetails->file_received_emp_id)   {

			$section_exp_1 = explode(',',getEmployeeSection());
            $sender_section = array('1','8','100');

            /*$empdetails_send =  emp_roleid($filedetails->file_sender_emp_id);
            $empdetails_rec =  emp_roleid($filedetails->file_received_emp_id);*/
            $emp_role_lvl= get_emp_role_levele();
            $empreciver = empdetails($filedetails->file_sender_emp_id);
            $empsender = empdetails($filedetails->file_received_emp_id);

            if(($empreciver[0]['role_id'] < $empsender[0]['role_id'] || $emp_role_lvl['emprole_level'] == 13)  && $filedetails->file_return != 2 && $filedetails->file_return != 1){
                $file_return = '0';
            }else{
                $file_return = '1';
            }
			
			if(emp_session_id() == $filedetails->file_sender_emp_id){
                $file_note = 'फाइल वापस ली गई |';
                $fvlm_id = '2';
                $check_sec = getfilesec_id_byfileid($filedetails->file_id,$filedetails->file_mark_section_id,$filedetails->file_type);
                if(!isset($check_sec) && $check_sec == null)
                {  
					$rec_not = 'not';
                }else{
					if($filedetails->final_draft_id != '') {
					$rec_not = 'not';
					}else{
					$rec_not = 'received';
					}
                  //  $rec_not = 'received';
                }
				if($empreciver[0]['role_id'] == '39')
				{ // this condition for csu role id 39
					$rec_not = 'received';
					$file_return = '0';
				}
				
            }elseif(emp_session_id() == $filedetails->file_received_emp_id){
                $file_note = 'फाइल को अस्वीकार किया गया है  |';
                $fvlm_id = '3';
                $rec_not = 'not';
            }
			$emprole_array = array(17,18,19,20,22,23,24,26,27);
			
            $file_data = array(
                'file_received_emp_id' => $filedetails->file_sender_emp_id,
                'file_sender_emp_id' => $filedetails->file_received_emp_id,
            //  'file_mark_section_id' => $filedetails->file_from_section_id,
            //  'file_from_section_id' => $filedetails->file_mark_section_id,
                'file_hardcopy_status' => $rec_not,
                'file_update_date' => date('Y-m-d H:i:s'),
                'file_unit_level' => getunitid($empreciver[0]['role_id'])==''?0:getunitid($empreciver[0]['role_id']),
                'file_return' => $file_return,
            );
            /*if($filedetails->file_from_section_id =='' || $filedetails->file_from_section_id ==0 || in_array($filedetails->file_mark_section_id,$section_exp_1) || $empdetails_send['role_id'] == '39') {
                unset($file_data['file_mark_section_id']);
                unset($file_data['file_from_section_id']);
            }*/
           if($filedetails->file_from_section_id !='' && $filedetails->file_from_section_id !=0 && $empreciver[0]['role_id'] != '39'  && !in_array($filedetails->file_from_section_id,$sender_section) && !in_array($empreciver[0]['role_id'],$emprole_array ) ) {  //&& !in_array($filedetails->file_mark_section_id,$section_exp_1)
                $file_data['file_mark_section_id'] = $filedetails->file_from_section_id;
                $file_data['file_from_section_id'] = $filedetails->file_mark_section_id;
            }
			// && !in_array($filedetails->file_mark_section_id,$section_exp_1) /*Remove this codition due to section toggle problem*/		 
			
            $checkUserdesignation = checkUserdesignation();
            $filelog_data = array(
                'file_id' => $file_id,
                'section_id' => $filedetails->file_mark_section_id,
                'to_emp_id' => $filedetails->file_sender_emp_id,
                'from_emp_id' => $filedetails->file_received_emp_id,
                'flog_other_remark' => $file_note,
                'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
                'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
				'sublogin' => $this->session->userdata('emp_id'),
				'fvlm_id' => $fvlm_id,
				'emp_degignation_id' => $checkUserdesignation
            );

            if($filedetails->file_from_section_id == '' || $filedetails->file_from_section_id == 0) {
                $fmove_sectionid_from =  $filedetails->file_from_section_id;
                $fmove_sectionid_to = $filedetails->file_mark_section_id;
            }else{
                $fmove_sectionid_to =  $filedetails->file_from_section_id;
                $fmove_sectionid_from = $filedetails->file_mark_section_id;
            }
            $form_data_move1 = array(
                'fmove_file_id'  => $file_id,
                'fmove_current_user_id'  => $filedetails->file_sender_emp_id,
                'fmove_previous_user_id' => $filedetails->file_received_emp_id,
                'fmove_sectionid_to' => $fmove_sectionid_from,
                'fmove_sectionid_from' => $fmove_sectionid_to,
                'fmove_to_unit_id'       => getunitid($empreciver[0]['role_id'])==''?0:getunitid($empreciver[0]['role_id']),
                'fmove_from_unit_id'     => getunitid($empsender[0]['role_id'])==''?0:getunitid($empsender[0]['role_id']),
                'file_return'            => $file_return,
            );

            if(emp_session_id() == $filedetails->file_sender_emp_id && $filedetails->final_draft_id != '') {
                $final_data = array(
                    //'draft_sender_id' => $filedetails->file_sender_emp_id,
                    'draft_reciever_id' => $filedetails->file_sender_emp_id,
                    'draft_status' => 3,     //draft completed
                    'draft_is_finalize' => 0,  //0 for draft working in process
                );
                $draft_data = get_draft($filedetails->final_draft_id,'n');
                $log_id = get_last_log_id($draft_data['draft_id'], $draft_data['draft_sender_id'], 1); // for recall use draft sender id
                $final_log_data = array(
                    'draft_log_sendto' => $filedetails->file_sender_emp_id,
                    'draft_final' => 0,  //0 for draft working in process
                  //  'draft_content' => $draft_data ['draft_content_text'],
                );
            }

            $res1 = updateData(FILES, $file_data, array('file_id' => $file_id));
            if ($res1) {

                if($filedetails->final_draft_id != '') {
                    updateData(DRAFT, $final_data, array('draft_file_id' => $file_id)); 
                    updateData(DRAFT_LOG, $final_log_data, array('draft_log_id' => $log_id));
                    /*Delete signature if file is return*/
                    $draft_log_detail = get_row("select draft_log_id,draft_content from ft_draft_log where draft_log_id=$log_id");
                    delete_data("ft_digital_signature",array('ds_draft_log_id'=>$log_id,'ds_emp_id'=>emp_session_id(),'ds_local_data'=>md5($draft_log_detail['draft_content'])));
                    /*End*/
                }
                insertData($filelog_data, FILES_LOG);
                insertData($form_data_move1, FILES_MOVEMENT);
                $this->session->set_flashdata('message', '<u>File id : ' . $file_id . '</u> Successfully Return');
            }
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
	
	//this function is use in place when file want to send in cr in any level .
    public function reject_for_cr($file_id = null)
    {
        if($file_id != null){
            $filedetails =  getFileDetails($file_id);
        }else{
            $filedetails = '';
        }
		  $logged_emp_is_permission = get_list_with_column(EMPLOYEE_PERMISSION_ALLOTED, 'emp_id_assign_by,emp_id_assign_to,epa_section_id,epa_designation_id', null, array('emp_id_assign_to' => $this->session->userdata("emp_id"), 'epa_module_name' => 'files'));

        if ($file_id != null && (emp_session_id() == $filedetails->file_received_emp_id || $logged_emp_is_permission['emp_id_assign_by'] == $filedetails->file_received_emp_id)) {
            $crsectionid = '1'; // cr section id
            $file_data = array(
                'file_received_emp_id' => $filedetails->createfile_empid,
                'file_sender_emp_id' => $filedetails->file_received_emp_id,
                'file_mark_section_date' => date('Y-m-d H:i:s'),
                'file_hardcopy_status' => 'not',
                'file_update_date' => date('Y-m-d H:i:s'),
                'file_return'      => '1',
				'file_unit_level' => 50,
            );
            $checkUserdesignation = checkUserdesignation();
			$file_remark = $this->input->post('file_remark');
            $filelog_data = array(
                'file_id' => $file_id,
                'section_id' => $filedetails->file_mark_section_id,
                'to_emp_id' => $filedetails->createfile_empid,
                'from_emp_id' => $filedetails->file_received_emp_id,
               // 'flog_other_remark' => $this->input->post('rmk1')."File return to CR",
				'flog_other_remark' => $file_remark." ,File return to CR",              
			  'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
                'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
                'sublogin' => $this->session->userdata('emp_id'),
                'fvlm_id' => '3',
				'emp_degignation_id' => $checkUserdesignation,
                'flog_type' => $file_remark == '' ? 0 : 2,
            );
            $empreciver = empdetails($filedetails->file_sender_emp_id);
            $empsender = empdetails($filedetails->file_received_emp_id);
            $form_data_move1 = array(
                'fmove_file_id'  => $file_id,
                'fmove_current_user_id'  => $filedetails->createfile_empid,
                'fmove_previous_user_id' => $filedetails->file_received_emp_id,
                'fmove_sectionid_to' => $crsectionid,
                'fmove_sectionid_from' => $filedetails->file_mark_section_id,
                'fmove_to_unit_id'       => getunitid($empreciver[0]['role_id'])==''?0:getunitid($empreciver[0]['role_id']),
                'fmove_from_unit_id'     => getunitid($empsender[0]['role_id'])==''?0:getunitid($empsender[0]['role_id']),
                'file_return'            => '3',
            );
            // pr(array_merge($file_data,$form_data_move1));
            $res1 = updateData(FILES, $file_data, array('file_id' => $file_id));
            if ($res1) {
                insertData($filelog_data, FILES_LOG);
                insertData($form_data_move1, FILES_MOVEMENT);
                $this->session->set_flashdata('message', '<u>File id : ' . $file_id . '</u> Successfully Rejected and Send to CR section');
            }
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
	
	//Reject file by CR to any section whic they send but any region hard copy not send
    public function reject_crto_section($file_id = null)
    {
        if($file_id != null){
            $filedetails =  getFileDetails($file_id);
        }else{
            $filedetails = '';
        }
        if ($file_id != null && emp_session_id() == $filedetails->file_received_emp_id) {		

			if($filedetails->file_mark_section_id == '100' || $filedetails->file_mark_section_id == null){
			$receiver_id = $filedetails->file_sender_emp_id;
			}else{
            $sectionunit_user = sectionunit_user();
            $markunitid =  $sectionunit_user[$filedetails->file_mark_section_id];
            $receiver_id = getmarkeduser($filedetails->file_mark_section_id,$markunitid);
			}
			
            $file_data = array(
                'file_received_emp_id' => $receiver_id['emp_id'],
                'file_sender_emp_id' => $filedetails->createfile_empid,
                'file_mark_section_date' => date('Y-m-d H:i:s'),
                'file_hardcopy_status' => 'not',
                'file_update_date' => date('Y-m-d H:i:s'),
                'file_return'      => '3',
				'file_unit_level' => '51',
            );
            $checkUserdesignation = checkUserdesignation();
            $filelog_data = array(
                'file_id' => $file_id,
                'section_id' => $filedetails->file_mark_section_id,
                'to_emp_id' => $receiver_id['emp_id'],
                'from_emp_id' => $filedetails->createfile_empid,
               // 'flog_other_remark' => $this->input->post('rmk1')."File return to CR",
				'flog_other_remark' => $this->input->post('file_remark')." ,File return to Section",              
			    'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
                'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
                'sublogin' => $this->session->userdata('emp_id'),
                'fvlm_id' => '3',
				'emp_degignation_id' => $checkUserdesignation
            );
            $form_data_move1 = array(
                'fmove_file_id'  => $file_id,
                'fmove_current_user_id'  => $receiver_id['emp_id'],
                'fmove_previous_user_id' => $filedetails->createfile_empid,
                'fmove_sectionid_to' => $filedetails->file_mark_section_id,
                'fmove_sectionid_from' => '1',
                'fmove_to_unit_id'       => getunitid($receiver_id['role_id'])==''?0:getunitid($receiver_id['role_id']),
                'fmove_from_unit_id'     => '50',
                'file_return'            => '3',
            );
            // pr(array_merge($file_data,$form_data_move1));
            $res1 = updateData(FILES, $file_data, array('file_id' => $file_id));
            if ($res1) {
                insertData($filelog_data, FILES_LOG);
                insertData($form_data_move1, FILES_MOVEMENT);
                $this->session->set_flashdata('message', '<u>File id : ' . $file_id . '</u> Successfully Rejected and Send to section');
            }
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
	
	//Reject file by dispatch section to any section which they send but any region or hard copy not send
    public function reject_dispacthto_section($file_id = null)
    {
        if($file_id != null){
            $filedetails =  getFileDetails($file_id);
        }else{
            $filedetails = '';
        }
        if ($file_id != null && emp_session_id() == $filedetails->file_received_emp_id) {
           
		   $sectionunit_user = sectionunit_user();
            $markunitid =  $sectionunit_user[$filedetails->file_mark_section_id];

            $receiver_id = getmarkeduser($filedetails->file_mark_section_id,$markunitid);
		   
            $file_data = array(
                'file_received_emp_id' => $receiver_id['emp_id'],
                'file_sender_emp_id' => emp_session_id(),
                'file_mark_section_date' => date('Y-m-d H:i:s'),
                'file_hardcopy_status' => 'not',
                'file_update_date' => date('Y-m-d H:i:s'),
                'file_return'      => '3',
				'file_unit_level' => '51',
            );
            $checkUserdesignation = checkUserdesignation();
            $filelog_data = array(
                'file_id' => $file_id,
                'section_id' => $filedetails->file_mark_section_id,
                'to_emp_id' => $receiver_id['emp_id'],
                'from_emp_id' => emp_session_id(),
               // 'flog_other_remark' => $this->input->post('rmk1')."File return to CR",
				'flog_other_remark' => $this->input->post('file_remark')." ,File return to Section",              
			    'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
                'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
                'sublogin' => $this->session->userdata('emp_id'),
                'fvlm_id' => '3',
				'emp_degignation_id' => $checkUserdesignation
            );
            $form_data_move1 = array(
                'fmove_file_id'  => $file_id,
                'fmove_current_user_id'  => $receiver_id['emp_id'],
                'fmove_previous_user_id' => emp_session_id(),
                'fmove_sectionid_to' => $filedetails->file_mark_section_id,
                'fmove_sectionid_from' => '8',
                'fmove_to_unit_id'       => getunitid($receiver_id['role_id'])==''?0:getunitid($receiver_id['role_id']),
                'fmove_from_unit_id'     => '58',
                'file_return'            => '3',
            );
             //pr(array_merge($file_data,$form_data_move1));
            $res1 = updateData(FILES, $file_data, array('file_id' => $file_id));
            if ($res1) {
                insertData($filelog_data, FILES_LOG);
                insertData($form_data_move1, FILES_MOVEMENT);
                $this->session->set_flashdata('message', '<u>File id : ' . $file_id . '</u> Successfully Rejected and Send to section');
            }
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
	
	
	    //file receive and mark to da . RP
    public function receive_sectionno_mark_da($fileid = '')
    {

        if($fileid !='') {
            $rrty = $_SERVER['HTTP_REFERER'];
            $rty1 = explode("/",$rrty);
            $empdetails =  empdetails(emp_session_id());           			
			$filedetails =  getFileDetails($fileid);
			
            if($empdetails[0]['role_id'] == 8 || in_array("today",$rty1) || $empdetails[0]['role_id'] == 37 || $empdetails[0]['role_id'] == 14 || $empdetails[0]['role_id'] == 15) //this condition only for section officer .
            {
                $check_sec = getfilesec_id_byfileid($filedetails->file_id,$filedetails->file_mark_section_id); //$filedetails->file_type
                if(!isset($check_sec) && $check_sec == null)
                {
                    $sectionno = $this->manage_model->plusone_fileno($filedetails->file_mark_section_id);
                    if ($sectionno != 0) {  $section_number = $sectionno; } else {  $section_number = '1'; }

                    $file_section = array(
                        'section_id' => $filedetails->file_mark_section_id,
                        'section_number' => $section_number,
                        'file_id'       => $fileid,
                        'file_type'   => $filedetails->file_type,
                        'file_mark_date' => date('Y-m-d H:i:s'),
                        'file_created_date' => date('Y-m-d H:i:s'),
                        'file_update_date' => date('Y-m-d H:i:s'),
                    );

                }
            }
            if($this->input->post('carry_fileemp_name')){
                $carry_empname = $this->input->post('carry_fileemp_name');
            }else{
                $carry_empname = '';
            }
            $file_status = null;
			if($this->input->post('physical_file'))
			{
				$file_status = $this->input->post('physical_file');
			}
			$res = filereceive_byofficer($fileid,$carry_empname,'',$file_status);
            if($res)
            {

                if($empdetails[0]['role_id'] == 8  || in_array("today",$rty1) || $empdetails[0]['role_id'] == 37 || $empdetails[0]['role_id'] == 14 || $empdetails[0]['role_id'] == 15) {
                    if(!isset($check_sec) && $check_sec == null) {
                        insertData($file_section, FILES_SECTION);

                        $this->form_validation->set_rules('Da_name', 'Da_name', 'trim|required|xss_clean');
                        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

                        if ($this->form_validation->run($this) === TRUE) {

                            $m_empdetails = empdetails($this->input->post('Da_name')); // marked emp
                            $p_empdetails = empdetails(emp_session_id()); // login emp


                            $file_data = array(
                                'file_received_emp_id' => $this->input->post('Da_name'),
                                'file_sender_emp_id' => emp_session_id(),
                                'file_progress_status_id' => '22', // File/Letter is sending to Dealing Assistant . (remark_master)
                                'file_hardcopy_status' => 'not', // only two value will be save received/not
                                'file_level_id' => '30',
                                // 'file_unit_level' => getunitid($m_empdetails[0]['role_id']),
								'file_status'		 => $this->input->post('physical_file')
                            );

                            $filelog_data = array(
                                'file_id'       => $fileid,
                                'section_id'    => $filedetails->file_mark_section_id,
                                'to_emp_id'     => $this->input->post('Da_name'),
                                'from_emp_id'   => emp_session_id(),
                                'flog_remark'   => 'File/Letter is send to Dealing Assistant',
                                'flog_other_remark' => $this->input->post('file_remark'),
                                'flog_ip_address'   => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
                                'flog_browser_id'   => $_SERVER['HTTP_USER_AGENT'],
								'emp_degignation_id' => checkUserdesignation()	,
								'file_status_log'		 => $this->input->post('physical_file')
                            );

                            $form_data_move1 = array(
                                'fmove_file_id'  => $fileid,
                                'fmove_current_user_id'     => $this->input->post('Da_name'),
                                'fmove_previous_user_id'    => emp_session_id(),
                                'fmove_to_unit_id'          => getunitid($m_empdetails[0]['role_id'])==''?0:getunitid($m_empdetails[0]['role_id']),
                                'fmove_from_unit_id'        => getunitid($p_empdetails[0]['role_id'])==''?0:getunitid($p_empdetails[0]['role_id']),
                                'file_return'            => $filedetails->file_return,
                            );
                            
							$this->master_to_working_move($fileid);
                            $res1 = updateData(FILES, $file_data, array('file_id' => $fileid));
                            if ($res1) {
                                insertData($filelog_data, FILES_LOG);
                                insertData($form_data_move1, FILES_MOVEMENT);
								update_file_tbl_for_section_no($fileid);
                                $this->session->set_flashdata('message', '<span style="font-size: 18px">'.emp_gender($m_empdetails[0]['emp_id']).' '.$m_empdetails[0]['emp_full_name_hi'].'  को अंकित की गई है , जिसका   <b><u>पंजी क्रमांक : '. $section_number .'</u> है |</b></span><span style="float:right">File id : ' . $fileid . '</span>');
                            }
                            redirect($_SERVER['HTTP_REFERER']);
                        }
                    }
                    $this->session->set_flashdata('message', '<u>File id : ' . $fileid . '</u> Successfully Received');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            }
        }else{
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function master_to_working_move($id){
	
		$vv = "ft_";
		
			$query9 ="INSERT $vv".DIGITAL_SINATURE." SELECT * FROM $vv".DIGITAL_SINATURE_MASTER." WHERE ds_file_id =$id";
			$query =$this->db->query($query9);
			
			$query7 ="INSERT $vv".DRAFT_LOG."  SELECT * FROM $vv".DRAFT_LOG_MASTER." WHERE draft_log_file_id=$id";
			$query =$this->db->query($query7);
			///// mater to working file 
			$query1 ="INSERT $vv".FILES."  SELECT * FROM $vv".FILES_MASTER." WHERE file_id=$id";
			$query =$this->db->query($query1);
			
			$query2 ="INSERT $vv".FILES_MOVEMENT." SELECT * FROM $vv".FILES_MOVEMENT_MASTER." WHERE fmove_file_id =$id";
			$query =$this->db->query($query2);
			
			$query3 ="INSERT $vv".FILES_LOG." SELECT * FROM $vv".FILES_LOG_MASTER." WHERE file_id =$id";
			$query =$this->db->query($query3);
			
			///// mater to delete file 
			$query4 ="DELETE FROM $vv".FILES_MASTER." WHERE file_id=$id";
			$query =$this->db->query($query4);
			
			$query5 ="DELETE FROM $vv".FILES_MOVEMENT_MASTER." WHERE fmove_file_id =$id";
			$query =$this->db->query($query5);
			
			$query6 ="DELETE FROM $vv".FILES_LOG_MASTER." WHERE file_id =$id;";
			$query =$this->db->query($query6);
			
			$query8 ="DELETE FROM $vv".DRAFT_LOG_MASTER." WHERE draft_log_file_id =$id;";
			$query =$this->db->query($query8);
			
			$query10 ="DELETE FROM $vv".DIGITAL_SINATURE_MASTER." WHERE ds_file_id =$id;";
			$query =$this->db->query($query10);
	}
	public function ajax_file_reopen()
    {
        $fileid = $this->input->post('fileid');
		
      $filedetails =  getFileDetails_closefile($fileid);
      
        $emp_role_lvl= get_emp_role_levele();
        if ($fileid != null) {
            $current_emp = emp_session_id();
            $receiver_id = empdetails($current_emp);
            $file_hardcopy_status = 'received';
            $rolename = getemployeeRole($receiver_id[0]['designation_id']);

            $receiver_section = explode(',',$receiver_id[0]['emp_section_id']);

            if(!in_array($filedetails->file_mark_section_id ,$receiver_section) && $receiver_id[0]['role_id'] >= '8' && $receiver_id[0]['role_id'] != '11'){
            $check_sec = getfilesec_id_byfileid($filedetails->file_id,$receiver_section[0],$filedetails->file_type);
            if(!isset($check_sec) && $check_sec == null) {
                $file_hardcopy_status = 'not';
            }
            }
            $file_data = array(
                'file_received_emp_id' => $current_emp,
                'file_sender_emp_id' => $current_emp,
                'file_hardcopy_status' => $file_hardcopy_status,
                'file_update_date' => date('Y-m-d H:i:s'),
                'file_return'      => '0',
				'ps_moniter_date'  => null,
                'file_unit_level' => getunitid($receiver_id[0]['role_id'])==''? '51' :getunitid($receiver_id[0]['role_id']),
            );
            if($filedetails->file_mark_section_id != $receiver_section[0] && $receiver_id[0]['role_id'] >= '8' && $receiver_id[0]['role_id'] != '11'){
                $file_data['file_mark_section_id'] = $receiver_section[0];
            }
            $checkUserdesignation = checkUserdesignation();
            $filelog_data = array(
                'file_id' => $fileid,
                'section_id' => $filedetails->file_mark_section_id,
                'to_emp_id' => $current_emp,
                'from_emp_id' => $current_emp,
               // 'flog_other_remark' => $this->input->post('rmk1')."File return to CR",
                'flog_other_remark' => "यह फाइल ".$receiver_id[0]['emp_full_name_hi']." (".$rolename.") द्वारा फिर से खोली गयी  हैं |",
                'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
                'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
                'sublogin' => $this->session->userdata('emp_id'),
                'fvlm_id' => '0',
				'emp_degignation_id' => $checkUserdesignation
            );
            $form_data_move1 = array(
                'fmove_file_id'  => $fileid,
                'fmove_current_user_id'  => $current_emp,
                'fmove_previous_user_id' => $filedetails->file_received_emp_id,
                'fmove_to_unit_id'       => getunitid($receiver_id[0]['role_id'])==''?0:getunitid($receiver_id[0]['role_id']),
                'fmove_from_unit_id'     => $filedetails->file_unit_level == ''?0: $filedetails->file_unit_level,
                'file_return'            => '0',
            );
             //pr(array_merge($file_data,$form_data_move1));
            //E-file reopen
           if($filedetails->final_draft_id != '' && $filedetails->final_draft_id != null && ($filedetails->file_status=='e,p' || $filedetails->file_status=='p,e' || $filedetails->file_status=='e')) {
               $cr_empid = '';
               $check_sec = getfilesec_id_byfileid($filedetails->file_id,'8');
               if(isset($check_sec) && $check_sec != null)
               {
                   $cr_empid = get_emp_by_role('9', '1');
               }
               $cr_empid_array = explode(',',$cr_empid);

                 $logged_emp_is_permission = get_list_with_column(EMPLOYEE_PERMISSION_ALLOTED, 'emp_id_assign_by,emp_id_assign_to,epa_section_id,epa_designation_id', null, array('emp_id_assign_to' => $this->session->userdata("emp_id"), 'epa_module_name' => 'files'));

                $this->db->select('draft_reciever_id,draft_id');
                $query_draft = $this->db->get_where(DRAFT, array('draft_file_id' => $fileid, 'draft_type' => 'n'), '1');
                $draft_data = $query_draft->row_array();
                $draft_id = $draft_data['draft_id'];
                $draft_reciver = $draft_data['draft_reciever_id'];

                if($receiver_id[0]['role_id'] == '8' && $draft_reciver != $current_emp){ // 8 section officer
                    $query = $this->db->query("select group_concat(under_emp_id SEPARATOR ',') as u_empid from ft_employee_hirarchi where emp_id = " . $current_emp);
                    $rr = $query->row_array();
                    $rt1 = explode(',', $rr['u_empid']);  }

                if($logged_emp_is_permission['emp_id_assign_by'] == $draft_reciver || $draft_reciver == $current_emp || (isset($rt1) && in_array($draft_reciver,$rt1)) || (isset($cr_empid_array) && in_array($current_emp,$cr_empid_array))){
                }else{
                    echo 2;
                    return;
                }

            }
            //E-file reopen
             $this->master_to_working($fileid);
            $res1 = updateData(FILES, $file_data, array('file_id' => $fileid));
            if ($res1) {
                insertData($filelog_data, FILES_LOG);
                insertData($form_data_move1, FILES_MOVEMENT);

 //E-file reopen
                if($filedetails->final_draft_id != '' && $filedetails->final_draft_id != null) {

                    if((($receiver_id[0]['role_id'] == '8' && isset($rt1) && in_array($draft_reciver,$rt1)) || ($emp_role_lvl['emprole_level'] == '13' && $logged_emp_is_permission['emp_id_assign_to'] == $current_emp) || ($current_emp == $draft_reciver ) || (isset($cr_empid_array) && in_array($current_emp,$cr_empid_array)))){

                        if ($logged_emp_is_permission['emp_id_assign_by'] == $draft_reciver) {
                            $draft_content = '<p>अनुभाग अधिकारी की अनुपस्थिति में नस्ती को शाखा में पुनः खोला गया है |</p>';
                        }elseif($current_emp == $draft_reciver){
                            $draft_content = '<p>नस्ती को पुनः खोला गया है |</p>';
                        }elseif(in_array($current_emp,$cr_empid_array)){
                            $draft_content = '<p>नस्ती को विभाग में  पुनः प्राप्त किया गया है |</p>';
                        }else{
                            $draft_content = '<p>सम्बंधित साहयक की अनुपस्थिति में नस्ती को पुनः खोला गया है |</p>';
                        }
                        $data_draft = array(
                            'draft_sender_id' => $current_emp,
                            'draft_reciever_id' => $current_emp,
                            'draft_content_text' => escape_str($draft_content),
                        );
                        $log_data_draft = array(
                            'draft_log_creater' => $current_emp,
                            'draft_log_sendto' => $current_emp,
                            'draft_log_create_date' => date('Y-m-d H:i:s'),
                            'draft_log_draft_id' => $draft_id,
                            'draft_log_file_id' => $fileid,
                            'draft_log_section_id' => $filedetails->file_mark_section_id,
                            'draft_content' => escape_str($draft_content),
                            'draft_log_sublogin_creater' => $this->session->userdata("emp_id"),
                            'draft_final' => 0,
                            'draft_file_reopen' => '1',
                        );
                        updateData(DRAFT, $data_draft, array('draft_id' => $draft_id));
                        insertData($log_data_draft, DRAFT_LOG);
                    }
                }
                //E-file reopen

                echo 0;
            }else{
                echo 1;
            }
        }else{
            echo 1;
        }
         
    }
    public function master_to_working($id){
		
			$vv = "ft_";
			///// mater to working file  
			$query9 ="INSERT $vv".DIGITAL_SINATURE." SELECT * FROM $vv".DIGITAL_SINATURE_MASTER." WHERE ds_file_id =$id";
			$query =$this->db->query($query9);
			
			$query7 ="INSERT $vv".DRAFT_LOG."  SELECT * FROM $vv".DRAFT_LOG_MASTER." WHERE draft_log_file_id=$id";
			$query =$this->db->query($query7);
			
			$query1 ="INSERT $vv".FILES."  SELECT * FROM $vv".FILES_MASTER." WHERE file_id=$id";
			$query =$this->db->query($query1);
			
			$query2 ="INSERT $vv".FILES_MOVEMENT." SELECT * FROM $vv".FILES_MOVEMENT_MASTER." WHERE fmove_file_id =$id";
			$query =$this->db->query($query2);
			
			$query3 ="INSERT $vv".FILES_LOG." SELECT * FROM $vv".FILES_LOG_MASTER." WHERE file_id =$id";
			$query =$this->db->query($query3);
			
			///// mater to delete file 
			$query4 ="DELETE FROM $vv".FILES_MASTER." WHERE file_id=$id";
			$query =$this->db->query($query4);
			
			$query5 ="DELETE FROM $vv".FILES_MOVEMENT_MASTER." WHERE fmove_file_id =$id";
			$query =$this->db->query($query5);
			
			$query6 ="DELETE FROM $vv".FILES_LOG_MASTER." WHERE file_id =$id;";
			$query =$this->db->query($query6);
			
			$query8 ="DELETE FROM $vv".DRAFT_LOG_MASTER." WHERE draft_log_file_id =$id;";
			$query =$this->db->query($query8);
			
			$query10 ="DELETE FROM $vv".DIGITAL_SINATURE_MASTER." WHERE ds_file_id =$id;";
			$query =$this->db->query($query10);
	}
	
	
	public function multiple_file_receive_sectionno($fileids = '')
    {
        if($fileids !='') {
			foreach($fileids as $fileid){			
			//pr($fileid);
				$rrty = $_SERVER['HTTP_REFERER'];
				$rty1 = explode("/",$rrty);
				$empdetails =  empdetails(emp_session_id());			
				$filedetails =  getFileDetails($fileid);			
				if($empdetails[0]['role_id'] == 8 || in_array("today",$rty1) || $empdetails[0]['role_id'] == 37 || $empdetails[0]['role_id'] == 14 || $empdetails[0]['role_id'] == 15 || $filedetails->file_mark_section_id == '7') //this condition only for section officer .
				{               
					$sectionid2 = $filedetails->file_mark_section_id;                
					$check_sec = getfilesec_id_byfileid($filedetails->file_id,$filedetails->file_mark_section_id);
					if(!isset($check_sec) && $check_sec == null)
					{
						$sectionno = $this->manage_model->plusone_fileno($filedetails->file_mark_section_id);
						if ($sectionno != 0) {  $section_number = $sectionno; } else {  $section_number = '1'; }
						$file_section = array(
							'section_id' => $filedetails->file_mark_section_id,
						  //  'section_id' => $sectionid2,
							'section_number' => $section_number,
							'file_id'       => $fileid,  
							'file_type'   => $filedetails->file_type,
							'file_mark_date' => date('Y-m-d H:i:s'),
							'file_created_date' => date('Y-m-d H:i:s'),
							'file_update_date' => date('Y-m-d H:i:s'),
						);		
					}
				}
				$carry_empname = '';           			
				$f_status_s=$filedetails->file_status;
				$res = filereceive_byofficer($fileid,$carry_empname,$sectionid2,$f_status_s);
				if($res)
				{
					if($empdetails[0]['role_id'] == 8  || in_array("today",$rty1) || $empdetails[0]['role_id'] == 37 || $empdetails[0]['role_id'] == 14 || $empdetails[0]['role_id'] == 15 || $filedetails->file_mark_section_id == '7') {
						if(!isset($check_sec) && $check_sec == null) {
							insertData($file_section, FILES_SECTION);						
						}
					}
									
				}
			}
			return $res;
        }else{
			return false;
		}
    }
	public function multi_file_receive_sectionno_mark_da($fileids,$Da_name_id)
    {
		if($fileids !='') {
			foreach($fileids as $fileid)
			{				
				echo $fileid;
				$rrty = $_SERVER['HTTP_REFERER'];
				$rty1 = explode("/",$rrty);
				$empdetails =  empdetails(emp_session_id());				
				$filedetails =  getFileDetails($fileid);
				if($empdetails[0]['role_id'] == 8 || in_array("today",$rty1) || $empdetails[0]['role_id'] == 37 || $empdetails[0]['role_id'] == 14 || $empdetails[0]['role_id'] == 15) //this condition only for section officer .
				{
					$check_sec = getfilesec_id_byfileid($filedetails->file_id,$filedetails->file_mark_section_id); // ,$filedetails->file_type
					if(!isset($check_sec) && $check_sec == null)
					{ 
						$sectionno = $this->manage_model->plusone_fileno($filedetails->file_mark_section_id);
						if ($sectionno != 0) {  $section_number = $sectionno; } else {  $section_number = '1'; }
						$file_section = array(
							'section_id' => $filedetails->file_mark_section_id,
							'section_number' => $section_number,
							'file_id'       => $fileid,
							'file_type'   => $filedetails->file_type,
							'file_mark_date' => date('Y-m-d H:i:s'),
							'file_created_date' => date('Y-m-d H:i:s'),
							'file_update_date' => date('Y-m-d H:i:s'),
						);
					}
				}           
				$carry_empname = '';
				//pre($filedetails);
				$file_status =$filedetails->file_status;
				//echo 'bok-'.$fileid.'==='.$carry_empname.'--'.$file_status;
				//echo '<br/>';
				$res = filereceive_byofficer($fileid,$carry_empname,'',$file_status);
				//pr($res);
				//echo $res;die;
				if($res)
				{
					if($empdetails[0]['role_id'] == 8  || in_array("today",$rty1) || $empdetails[0]['role_id'] == 37 || $empdetails[0]['role_id'] == 14 || $empdetails[0]['role_id'] == 15) {
						if(!isset($check_sec) && $check_sec == null) {
							insertData($file_section, FILES_SECTION);
								$m_empdetails = empdetails($Da_name_id); // marked emp
								$p_empdetails = empdetails(emp_session_id()); // login emp
								$file_data = array(
									'file_received_emp_id' =>$Da_name_id,
									'file_sender_emp_id' => emp_session_id(),
									'file_progress_status_id' => '22', // File/Letter is sending to Dealing Assistant . (remark_master)
									'file_hardcopy_status' => 'not', // only two value will be save received/not
									'file_level_id' => '30',                               
								);
								$filelog_data = array(
									'file_id'       => $fileid,
									'section_id'    => $filedetails->file_mark_section_id,
									'to_emp_id'     => $Da_name_id,
									'from_emp_id'   => emp_session_id(),
									'flog_remark'   => 'File/Letter is send to Dealing Assistant',                               
									'flog_ip_address'   => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
									'flog_browser_id'   => $_SERVER['HTTP_USER_AGENT'],
									'emp_degignation_id' => checkUserdesignation()	,									
								);

								$form_data_move1 = array(
									'fmove_file_id'  => $fileid,
									'fmove_current_user_id'     => $Da_name_id,
									'fmove_previous_user_id'    => emp_session_id(),
									'fmove_to_unit_id'          => getunitid($m_empdetails[0]['role_id'])==''?0:getunitid($m_empdetails[0]['role_id']),
									'fmove_from_unit_id'        => getunitid($p_empdetails[0]['role_id'])==''?0:getunitid($p_empdetails[0]['role_id']),
									'file_return'            => $filedetails->file_return,
								);
								$res1 = updateData(FILES, $file_data, array('file_id' => $fileid));
								if ($res1) {
									insertData($filelog_data, FILES_LOG);
									insertData($form_data_move1, FILES_MOVEMENT);
									//$this->session->set_flashdata('message', '<span style="font-size: 18px">'.emp_gender($m_empdetails[0]['emp_id']).' '.$m_empdetails[0]['emp_full_name_hi'].'  को अंकित की गई है , जिसका   <b><u>पंजी क्रमांक : '. $section_number .'</u> है |</b></span><span style="float:right">File id : ' . $fileid . '</span>');
								}
						}else{
								echo modules::run('view_file/dealing_file/multi_file_sent_to_da',$fileid,$Da_name_id,$filedetails->file_mark_section_id,$filedetails->file_status);
								//multi_file_sent_to_da($file_id,$mark_emp_id,$section_id,$f_status_s)
						
						}
						
					}
				}
			}
			//return $fileid;
        }else{
            return false;
        }

    }
}