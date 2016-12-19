<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Test_view	 extends MX_Controller {
    function __construct() {
        parent::__construct();
    }
    public function index()
    {
      /* echo $i = 1;
        $file_ids = array(40305,38364,39851,39973,39607,39886); 
        //pr($file_ids);
	    foreach($file_ids as $file_id){    
	        $emp_id = 3;  // receiver emp id   
			$file_dt =  getFileDetails($file_id); 
	        $emp_dt =  empdetails($emp_id);  
	        $notesheet = get_draft($file_dt->final_draft_id, 'n');
	        $remark1 = " श्री वैद्य  जी (सचिव) अवकाश पर होने के कारण नस्ति को श्री वाणी जी  ( सचिव)  के पास भेजी गयी |"; 
	       // $remark1 = "  यह फाइल  अंकित की  गयी है"; 
	        $remark1_draft = escape_str($remark1); 
	        $draftid_log =  get_last_log_id($notesheet['draft_id'],$file_dt->file_received_emp_id);
	        $sql_emp = "UPDATE `ft_files` SET `file_received_emp_id`='".$emp_dt[0]['emp_id']."',`file_sender_emp_id`='".$file_dt->file_received_emp_id."',`file_update_date`= '".date('Y-m-d H:i:s')."' ,`file_hardcopy_status`= 'not' WHERE `file_id`='".$file_id."'";
	        $redfds = $this->db->query($sql_emp);	
	        $sql_emp = "INSERT INTO `ft_file_movements`(`fmove_file_id`, `fmove_current_user_id`, `fmove_previous_user_id`, `fmove_from_unit_id`, `fmove_to_unit_id`,  `fmove_created_datetime`) VALUES ('".$file_id."','".$emp_dt[0]['emp_id']."','".$file_dt->file_received_emp_id."','0','0','".date('Y-m-d H:i:s')."')";
	        $redfds = $this->db->query($sql_emp);	 
	        
	        $sql_emp = "INSERT INTO `ft_file_logs`(`file_id`, `section_id`, `to_emp_id`, `from_emp_id`,`flog_other_remark`, `flog_created_date`, `emp_degignation_id`, `file_status_log`) VALUES ('".$file_id."','".$file_dt->file_mark_section_id."','".$emp_dt[0]['emp_id']."','".$file_dt->file_received_emp_id."','".$remark1."','".date('Y-m-d H:i:s')."','".$emp_dt[0]['designation_id']."','".$file_dt->file_status."')";
	        $redfds = $this->db->query($sql_emp); 
			
	        $sql_emp = "UPDATE `ft_file_draft` SET `draft_sender_id`='1',`draft_reciever_id`='".$emp_dt[0]['emp_id']."',`draft_content_text`='".$remark1_draft."' WHERE draft_file_id = '".$file_id."' and draft_type = 'n' and draft_id = '".$notesheet['draft_id']."'";
	        $redfds = $this->db->query($sql_emp);	
	         if($draftid_log != ''){
	             updateData(DRAFT_LOG, array('draft_log_dispaly_status' => '1' ), array('draft_log_id' => $draftid_log));
	         }	
	         $sql_emp = "INSERT INTO `ft_draft_log`(`draft_log_creater`, `draft_log_create_date`, `draft_log_draft_id`, `draft_log_file_id`, `draft_log_section_id`, `draft_log_sendto`, `draft_content`, `draft_final`) VALUES ('1','".date('Y-m-d H:i:s')."','".$notesheet['draft_id']."','".$file_id."','".$file_dt->file_mark_section_id."','".$emp_dt[0]['emp_id']."','".$remark1_draft."','1')";
	         $redfds = $this->db->query($sql_emp);
			 
			echo $i.') done->'.$file_id.'<br/>';	 
		
	    $i ++; }
		*/
    }    
}

