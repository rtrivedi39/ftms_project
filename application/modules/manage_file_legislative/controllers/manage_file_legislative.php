<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Manage_file_legislative extends MX_Controller {

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
                    $this->session->set_flashdata('message', '<u>FIleID : ' . $send_file . '</u> Successfully Sent');
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
                $res = filereceive_byofficer($fileid,$carry_empname,$this->input->post('section_mark1'));
            if ($res) {
                $this->session->set_flashdata('message', '<u>FIleID : ' . $res . '</u> Successfully Received');
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
			$f_status_s ='' ;
            if($this->input->post('file_status')){
                foreach($this->input->post('file_status') as $file_status_val){
                    $f_status[] = $file_status_val;
                }
                $f_status_s = implode($f_status,',');
            }
            else if($this->input->get('ft_status') == 'p' ){
                $f_status_s = 'p';
            }
			           
			if($empdetails[0]['role_id'] == 8 || in_array("today",$rty1) || $empdetails[0]['role_id'] == 37 || $empdetails[0]['role_id'] == 14) //this condition only for section officer .
            {
                $filedetails =  getFileDetails($fileid);

                if($filedetails->file_mark_section_id == 0){
                    $sectionid2 = $this->input->post('section_mark1');
                }else{
                    $sectionid2 = $filedetails->file_mark_section_id;
                }

                $check_sec = getfilesec_id_byfileid($filedetails->file_id,$filedetails->file_mark_section_id);
                if(!isset($check_sec) && $check_sec == null)
                {
                    $section_exp = explode(',',getEmployeeSection());
                    if(in_array('16',$section_exp)){
                     //   $sectionno = $this->manage_model->plusone_fileno_drafting($sectionid2);
                        $sectionno = $this->manage_model->plusone_fileno($sectionid2);
                    }else{
                        $sectionno = $this->manage_model->plusone_fileno($sectionid2);
                    }
                    if ($sectionno != 0) {  $section_number = $sectionno; } else {  $section_number = '1'; }
                    $file_section = array(
                        'section_id' => $sectionid2,
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
                $res = filereceive_byofficer($fileid,$carry_empname,$sectionid2,$f_status_s);
                if($res)
                {
                    if($empdetails[0]['role_id'] == 8  || in_array("today",$rty1) || $empdetails[0]['role_id'] == 37 || $empdetails[0]['role_id'] == 14) {
                        if(!isset($check_sec) && $check_sec == null) {
                            insertData($file_section, FILES_SECTION);
							update_file_tbl_for_section_no($fileid);
                            $this->session->set_flashdata('message', 'Successfully Received , <u>File Section id : ' . $section_number . '</u>');
                        }
                    }else {
                        $this->session->set_flashdata('message', '<u>FIleID : ' . $res . '</u> Successfully Received');
                    }
                }
            redirect($_SERVER['HTTP_REFERER']);
        }
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
            $filelog_data = array(
                'file_id' => $file_id,
                'section_id' => $filedetails->file_mark_section_id,
                'to_emp_id' => $this->input->post('emp_id'),
                'from_emp_id' => emp_session_id(),
                'flog_other_remark' => $this->input->post('rmk1'),
                'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
                'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
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
        //pr($file_id);
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
        );
        $filelog_data = array(
            'file_id' => $file_id,
            'section_id' => '8',
            'to_emp_id' => $markemp[0]['emp_id'],
            'from_emp_id' => emp_session_id(),
            'flog_other_remark' => 'File marked to dispatch section',
            'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
            'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
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
                $this->session->set_flashdata('message', '<u>FIleID : ' . $file_id . '</u> Successfully Send');
            }
        } else{ $this->session->set_flashdata('message', '<span class="text-bold">Marked user is not found, try after some time</span>');
        }
        redirect($_SERVER['HTTP_REFERER']);
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
            );
            if($this->input->post('carry_fileemp_name')){
                $carry_empname = $this->input->post('carry_fileemp_name');
            }else{
                $carry_empname = '';
            }
            $filelog_data = array(
                'file_id'       => $fileid,
                'section_id'    => '8',
                'to_emp_id'     => emp_session_id(),
                'from_emp_id'   => emp_session_id(),
                //    'fvlm_id'       => '29',
                'hardcopy_carry_empname' => $carry_empname,
                'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
                'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
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
            redirect('view_file');
        }
    }
    //RP
    public function dispatch_for_close()
    {
        $file_data = array(
            'file_level_id' => '33',
            'file_return' => '2',
            'file_hardcopy_status' => 'close',
            'file_update_date' => date('Y-m-d H:i:s'),
        );
        if($_FILES['proof_dispatch']){
            $proof_name = uploadalltypeFile('proof_dispatch' , './uploads/dispatch/' );
        } else {
            $proof_name = '';
        }
        $dispatch_file = array(
            'file_id'            => $this->input->post('fileids2'),
            'emp_id'             => emp_session_id(),
            'cost_of_dispatch'   => $this->input->post('cost_dispatch'),
            'remark'             => $this->input->post('rmk2'),
            'url_proof_dispatch' => $proof_name,
            'dispatch_date'      => date('Y-m-d H:i:s'),

        );
        $dispatchno = insertData_with_lastid($dispatch_file, FILES_DISPATCH);
        $filelog_data = array(
            'file_id' => $this->input->post('fileids2'),
            'section_id' => '8',
            'to_emp_id' => emp_session_id(),
            'from_emp_id' => emp_session_id(),
            'flog_other_remark' =>'File is Successfully Dispatched by '.$dispatchno,
            'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
            'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
            'fvlm_id' => '1', // 1 for close file which is out of department
        );
        if($dispatchno){
            updateData(FILES, $file_data, array('file_id' => $this->input->post('fileids2')));
            insertData($filelog_data, FILES_LOG);
            $this->session->set_flashdata('message', '<u>FIleID : ' . $this->input->post('fileids2') . '</u> Successfully Dispatch and Dispatch ID is '.$dispatchno);
        }
        redirect('view_file');
    }//RP
	
   //new function for send file to upper level officer reference by upper function  Send_file_us
    public function Sendfile_upperofficer($fileid = null)
    {
       // pr($fileid);
    //    $fileid = $this->input->post('fileids2');
        $rmk1 = $this->input->post('rmk1');
        $markrd_emp = $this->input->post('emp_id2');
        if($fileid) {
            $file_progress = '0';
            $send_file = filesend_nextofficer($fileid, $markrd_emp, $file_progress,$rmk1);
            if ($send_file) {
                $this->session->set_flashdata('message', '<u>FIleID : ' . $send_file . '</u> Successfully Sent');
            }
        }
        redirect($_SERVER['HTTP_REFERER']);

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
                $this->session->set_flashdata('message', '<u>FIleID : ' . $send_file . '</u> Successfully Sent');
            }
        }
        redirect($_SERVER['HTTP_REFERER']);

    }

    //return file to CR by SO only in case of wrong file come .
    public function reject_file($file_id = null)
    {
        if ($file_id != null) {
            //  $crsectionid = '1'; // cr section id
            $filedetails =  getFileDetails($file_id);
            $file_data = array(
                'file_received_emp_id' => $filedetails->file_sender_emp_id,
                'file_sender_emp_id' => $filedetails->file_received_emp_id,
                //  'file_mark_section_id' => $crsectionid,
                'file_mark_section_date' => date('Y-m-d H:i:s'),
                'file_hardcopy_status' => 'not',
                'file_update_date' => date('Y-m-d H:i:s'),
                'file_return'            => '1',
            );
            $filelog_data = array(
                'file_id' => $file_id,
                'section_id' => $filedetails->file_mark_section_id,
                'to_emp_id' => $filedetails->file_sender_emp_id,
                'from_emp_id' => $filedetails->file_received_emp_id,
                'flog_other_remark' => $this->input->post('rmk1')."File return",
                'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
                'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
            );
            $empreciver = empdetails($filedetails->file_sender_emp_id);
            $empsender = empdetails($filedetails->file_received_emp_id);
            $form_data_move1 = array(
                'fmove_file_id'  => $file_id,
                'fmove_current_user_id'  => $filedetails->file_sender_emp_id,
                'fmove_previous_user_id' => $filedetails->file_received_emp_id,
                'fmove_to_unit_id'       => getunitid($empreciver[0]['role_id'])==''?0:getunitid($empreciver[0]['role_id']),
                'fmove_from_unit_id'     => getunitid($empsender[0]['role_id'])==''?0:getunitid($empsender[0]['role_id']),
                'file_return'            => '1',
            );
            // pr(array_merge($file_data,$form_data_move1));
            $res1 = updateData(FILES, $file_data, array('file_id' => $file_id));
            if ($res1) {
                insertData($filelog_data, FILES_LOG);
                insertData($form_data_move1, FILES_MOVEMENT);
                $this->session->set_flashdata('message', '<u>FIleID : ' . $file_id . '</u> Successfully Rejected');
            }
        }
        redirect('view_file');
    }

    public function dispatch_for_close_byso()
    {
        $file_id = $this->input->post('filedis_id');
        $file_data = array(
            'file_level_id' => '33', //file close for 33
            'file_return' => '2', // 2 for dispatch
            'file_hardcopy_status' => 'close',
            'file_update_date' => date('Y-m-d H:i:s'),
        );

        $dispatch_file = array(
            'file_id'            => $file_id,
            'emp_id'             => emp_session_id(),
            'cost_of_dispatch'   => 0,
            'remark'             => $this->input->post('filedis_msg'),
            'url_proof_dispatch' => 'Dispose by SO',
            'dispatch_date'      => date('Y-m-d H:i:s'),

        );
        $dispatchno = insertData_with_lastid($dispatch_file, FILES_DISPATCH);
        $filelog_data = array(
            'file_id' => $file_id,
            'section_id' => getEmployeeSection(),
            'to_emp_id' => emp_session_id(),
            'from_emp_id' => emp_session_id(),
            'flog_other_remark' =>'File is Successfully Dispose by '.$dispatchno,
            'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
            'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
            'fvlm_id' => '1', // 1 for close file
        );
        if($dispatchno){
            updateData(FILES, $file_data, array('file_id' => $file_id));
            insertData($filelog_data, FILES_LOG);
            $this->session->set_flashdata('message', '<u>FIleID : ' . $file_id . '</u> Successfully Dispose and Dispose ID is '.$dispatchno);
        }
        redirect($_SERVER['HTTP_REFERER']);
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
	
	//this function is use in place when file want to send in cr in any level .
    public function reject_for_cr($file_id = null)
    {
        if($file_id != null){
            $filedetails =  getFileDetails($file_id);
        }else{
            $filedetails = '';
        }
        if ($file_id != null && emp_session_id() == $filedetails->file_received_emp_id) {
            $crsectionid = '1'; // cr section id
            $file_data = array(
                'file_received_emp_id' => $filedetails->createfile_empid,
                'file_sender_emp_id' => $filedetails->file_received_emp_id,
                'file_mark_section_date' => date('Y-m-d H:i:s'),
                'file_hardcopy_status' => 'not',
                'file_update_date' => date('Y-m-d H:i:s'),
                'file_return'      => '1',
            );
            $filelog_data = array(
                'file_id' => $file_id,
                'section_id' => $filedetails->file_mark_section_id,
                'to_emp_id' => $filedetails->createfile_empid,
                'from_emp_id' => $filedetails->file_received_emp_id,
                'flog_other_remark' => $this->input->post('rmk1')."File return to CR",
                'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
                'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
                'sublogin' => $this->session->userdata('emp_id'),
                'fvlm_id' => '3',
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
                'file_return'            => '1',
            );
            // pr(array_merge($file_data,$form_data_move1));
            $res1 = updateData(FILES, $file_data, array('file_id' => $file_id));
            if ($res1) {
                insertData($filelog_data, FILES_LOG);
                insertData($form_data_move1, FILES_MOVEMENT);
                $this->session->set_flashdata('message', '<u>FIleID : ' . $file_id . '</u> Successfully Rejected and Send to CR section');
            }
        }
        redirect($_SERVER['HTTP_REFERER']);
    }



}