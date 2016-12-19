<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Establishment extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->module('template');
        $this->load->model('manage_file_model','manage_model');
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

    }

    //file receive . RP
    public function receive_sectionno_mark_da($fileid = '')
    {

        if($fileid !='') {
            $rrty = $_SERVER['HTTP_REFERER'];
            $rty1 = explode("/",$rrty);
            $empdetails =  empdetails(emp_session_id());
            $filedetails =  getFileDetails($fileid);

            if($empdetails[0]['role_id'] == 8 || in_array("today",$rty1) || $empdetails[0]['role_id'] == 37 || $empdetails[0]['role_id'] == 14 || $empdetails[0]['role_id'] == 15) //this condition only for section officer .
            {
                $check_sec = getfilesec_id_byfileid($filedetails->file_id,$filedetails->file_mark_section_id,$filedetails->file_type);
                if(!isset($check_sec) && $check_sec == null)
                {
                    $sectionno = plusone_fileno_es($filedetails->file_mark_section_id);
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

            $res = filereceive_byofficer($fileid,$carry_empname);
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
                            );

                            $form_data_move1 = array(
                                'fmove_file_id'  => $fileid,
                                'fmove_current_user_id'     => $this->input->post('Da_name'),
                                'fmove_previous_user_id'    => emp_session_id(),
                                'fmove_to_unit_id'          => getunitid($m_empdetails[0]['role_id']),
                                'fmove_from_unit_id'        => getunitid($p_empdetails[0]['role_id']),
                                'file_return'            => $filedetails->file_return,
                            );

                            $res1 = updateData(FILES, $file_data, array('file_id' => $fileid));
                            if ($res1) {
                                insertData($filelog_data, FILES_LOG);
                                insertData($form_data_move1, FILES_MOVEMENT);
                                $this->session->set_flashdata('message', '<u>FIleID : ' . $fileid . '</u> Successfully Sent to '.emp_gender($m_empdetails[0]['emp_id']).' '.$m_empdetails[0]['emp_full_name_hi'].' and <b><u>Section no :-'. $section_number .'</u></b>');
                            }
                            redirect($_SERVER['HTTP_REFERER']);
                        }
                      }
                    $this->session->set_flashdata('message', '<u>FIleID : ' . $fileid . '</u> Successfully Received');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            }
        }else{
            redirect($_SERVER['HTTP_REFERER']);
        }

    }	
	//for add remark every level
	function add_reamrk(){
		$fileid = $this->input->post('file_id_remark');
		$remark = $this->input->post('file_remark');
		if($fileid!=''){
		 $sql="select file_id,file_mark_section_id,file_from_section_id from ft_files where file_id=$fileid";
		 $fil_sectionId_array = get_row($sql);
		 $fil_sectionId = $fil_sectionId_array['file_mark_section_id'];
		}else{
			$fil_sectionId=7;
		}
		$filelog_data = array(
			'file_id'       => $fileid,
			'flog_type'    => 1,
			'section_id'    => $fil_sectionId,
			'to_emp_id'     => emp_session_id(),
			'from_emp_id'   => emp_session_id(),
			'flog_remark'   => 'This is add by establishment file movement',
			'flog_other_remark' => $remark,
			'flog_ip_address'   => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
			'flog_browser_id'   => $_SERVER['HTTP_USER_AGENT'],
        );
		$res = insertData($filelog_data, FILES_LOG);
		if($res){
			$this->session->set_flashdata('message', '<u>FIleID : ' . $fileid . '</u> remark add Successfully');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	
	
    public function getemployee_emp_code_notesheet_2()
    {
        $emp_code = $this->input->post('emp_unique_code');
        if(strlen($emp_code) > 6 ){
            $emp_list = get_employee_name_details('' ,$emp_code);
            echo json_encode($emp_list);
            exit();
        }
 
    }
    public function getemployee_from_name()
    {
        $emp_name = $this->input->post('emp_full_name');
        //if(strlen($emp_name) > 6 )
        {
            $emp_list = get_employee_name_details($emp_name);
            if(!empty($emp_list)) {
                ?>
                <ul id="employee_fullname-list">
                    <?php
                    foreach($emp_list as $employee) {
                        ?>
                        <li onClick="selectEmployee_name('<?php echo $employee->emp_full_name_hi; ?>',<?php echo $employee->emp_id; ?>);"><?php echo $employee->emp_full_name_hi; ?></li>
                    <?php } ?>
                </ul>
            <?php }  }

    }
    public function getemployee_emp_code()
    {
        $emp_code = $this->input->post('emp_unique_code');
        if(strlen($emp_code) > 6 ){
            $emp_list = get_employee_name_details('' ,$emp_code);
            if(!empty($emp_list)) {
                ?>
                <ul id="employee_unicode-list">
                    <?php
                    foreach($emp_list as $employee) {
                        ?>
                        <li onClick="selectEmployee_name('<?php echo $employee->emp_unique_id; ?>',<?php echo $employee->emp_id; ?>);"><?php echo $employee->emp_unique_id; ?></li>
                    <?php } ?>
                </ul>
            <?php }  }

    }
    public function getemployee_details_fill()
    {
        $emp_id = $this->input->post('emp_id');
        $emp_details = emp_details_with_pay_details( $emp_id );
        // $data_details = get_dpf_gpf_details($emp_details[0]['emp_unique_id'] ,$emp_id   );
        // $amount_before_2_year = check_twoyearammount($emp_details[0]['emp_unique_id'] , 2 );
        // $amount_last_year = check_twoyearammount($emp_details[0]['emp_unique_id'] , 1 );
        // $pay_before_amount = isset($amount_before_2_year[0]->pay_amount)?$amount_before_2_year[0]->pay_amount:'';
        // $pay_last_amount =   isset($amount_last_year[0]->pay_amount)?$amount_last_year[0]->pay_amount:'';
            $emp_class = $emp_details[0]['emp_class'] != '' ? employees_class($emp_details[0]['emp_class']) : '';
        // $emp_adv = get_withdraw_ammount($emp_details[0]['emp_unique_id']); //comment for now
        // $emp_full_name_hi = employees_class($emp_details[0]['emp_full_name_hi']);
        // $emp_unique_id = employees_class($emp_details[0]['emp_unique_id']);
        $emp_adv = 0 ;
        $data_details = 0 ;

        $details_array = array(
            'emp_id' 			=> $emp_id,
            'emp_class' 		=> $emp_class,
            'pay_before_amount' => $data_details['pay_pre_amount'] ? $data_details['pay_pre_amount'] : '0',
            'pay_last_amount' 	=> $data_details['pay_amount'] ? $data_details['pay_amount'] : '0',
            'emp_full_name_hi' 	=> $emp_details[0]['emp_title_hi']." ".$emp_details[0]['emp_full_name_hi'],
            'emp_unique_id' 	=> $emp_details[0]['emp_unique_id'],
            'emp_class_id' 		=> $emp_details[0]['emp_class'] ? $emp_details[0]['emp_class'] : '',
        // 'emp_pay_cate_id' 	=> $emp_details[0]['emp_pay_cate_id'],
            'emprole_name_hi' 	=> $emp_details[0]['emprole_name_hi'],
            'emp_gpf_dpf_code' 	=> $emp_details[0]['emp_gpf_dpf_code'],
            'emp_gpf_dpf_adv' 	=> $emp_adv['pay_adv_amount'] ? $emp_adv['pay_adv_amount'] : '0',
            'applied_amount_adv' => $emp_adv['applied_amount_adv'] ? $emp_adv['applied_amount_adv'] : '0',
			'emp_mobile_number' 	=> $emp_details[0]['emp_mobile_number'],
        );
        //print_r($details_array );
        echo json_encode($details_array);


    }
    public function application_edit_fill()
    {
        $emp_id = $this->input->post('emp_id');
        $pay_app_id = $this->input->post('app_id');
        $emp_details = emp_details_with_pay_details($emp_id);
        $data_details = get_dpf_gpf_details($emp_details[0]['emp_unique_id'] ,$emp_id,null ,$pay_app_id);

        $details_array = array(
            'emp_id' 			=> $data_details['pay_emp_id'],
            'emp_class' 		=> $data_details['pay_emp_class'],
            'pay_before_amount' => $data_details['pay_pre_amount'] ? $data_details['pay_pre_amount'] : '0',
            'pay_last_amount' 	=> $data_details['pay_amount'] ? $data_details['pay_amount'] : '0',
            'emp_full_name_hi' 	=> $data_details['pay_emp_name'],
            'emp_unique_id' 	=> $data_details['pay_emp_unique_id'],
            'emp_class_id' 		=> '',
            // 'emp_pay_cate_id' 	=> $emp_details[0]['emp_pay_cate_id'],
            'emprole_name_hi' 	=> $data_details['pay_emp_designation'],
            'emp_gpf_dpf_code' 	=> $data_details['pay_account_no'],
            'emp_gpf_dpf_adv' 	=> $data_details['pay_adv_amount'] ? $data_details['pay_adv_amount'] : '0',
            'applied_amount_adv' => $data_details['applied_amount_adv'] ? $data_details['applied_amount_adv'] : '0',

            'applied_amount_adv_words' => $data_details['applied_amount_adv_words'],
            'pay_percentage' => $data_details['pay_percentage'],

        );
        echo json_encode($details_array);


    }
	
}