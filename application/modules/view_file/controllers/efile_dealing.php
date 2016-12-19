<?php
class Efile_dealing extends MX_Controller{
    function __construct() {
        parent::__construct();
        $this->load->module('template');
        $this->load->language('view_file','hindi');
        $this->load->model('dealing_file_model','dealing_file');        
    }	
	public function multi_file_sent_to_da($file_id,$mark_emp_id,$section_id,$f_status_s,$draft_log_id,$loggined_in_userId)
    {
		$f_status_s = safe_b64decode($f_status_s);
        $file_dt =  getFileDetails($file_id);
        $m_empdetails = empdetails($mark_emp_id); // marked emp		
        $p_empdetails = empdetails($loggined_in_userId); // login emp
        $file_data = array(
            'file_received_emp_id' => $mark_emp_id,
            'file_sender_emp_id' => $loggined_in_userId,
            'file_progress_status_id' => '22', // File/Letter is sending to Dealing Assistant . (remark_master)
            'file_hardcopy_status' => 'not', // only two value will be save received/not
            'file_level_id' => '30',
            'file_status' => 	$f_status_s!=''?$f_status_s:'',
        );
        $sectionid = getusersection($loggined_in_userId);
        $checkUserdesignation = checkUserdesignation($loggined_in_userId);
        $filelog_data = array(
            'file_id'       => $file_id,
            'section_id'    => $section_id,
            'to_emp_id'     => $mark_emp_id,
            'from_emp_id'   => $loggined_in_userId,
            'flog_remark'   => 'File/Letter is send to Dealing Assistant',
            'flog_ip_address'   => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
            'flog_browser_id'   => $_SERVER['HTTP_USER_AGENT'],
            'emp_degignation_id' => $checkUserdesignation,
            'file_status_log' => $f_status_s!=''?$f_status_s:'',
        );
        $form_data_move1 = array(
            'fmove_file_id'  => $file_id,
            'fmove_current_user_id'     => $mark_emp_id,
            'fmove_previous_user_id'    => $loggined_in_userId,
            'fmove_to_unit_id'          => getunitid($m_empdetails[0]['role_id'])==''?0:getunitid($m_empdetails[0]['role_id']),
            'fmove_from_unit_id'        => getunitid($p_empdetails[0]['role_id'])==''?0:getunitid($p_empdetails[0]['role_id']),
            'file_return'            => $file_dt->file_return,
        );
        $res1 = updateData(FILES, $file_data, array('file_id' => $file_id));
        if ($res1) {
            update_efile($file_id,$mark_emp_id,null,$loggined_in_userId); // use for add draft
            insertData($filelog_data, FILES_LOG);
            insertData($form_data_move1, FILES_MOVEMENT);
			update_file_draft($loggined_in_userId,$mark_emp_id,$draft_log_id); /*Update file draft log table*/
            $this->session->set_flashdata('message', '<u>FIleID : ' . $file_id . '</u> Successfully Sent');
        }
        return $res1;
    }   
}