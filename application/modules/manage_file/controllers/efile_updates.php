<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Efile_updates extends MX_Controller {
    function __construct() {
        parent::__construct();
        $this->load->module('template');
        $this->load->model('Manage_files_model' , 'manage_model');
        $this->lang->load("files","hindi");
    }
	public function multi_file_send_upper_officer($fileid,$rmk1,$markrd_emp,$section_id,$file_status,$draft_log_id,$loggined_in_userId)
    {
		$file_status = safe_b64decode($file_status);
        $f_status = array();
        if($fileid) {
            $file_progress = '0';
            if($section_id!=''){
                $send_file = efile_send_nextofficer($fileid, $markrd_emp, $file_progress,$rmk1 ,$section_id, $file_status,$loggined_in_userId);
            }
            else{
                $send_file = efile_send_nextofficer($fileid, $markrd_emp, $file_progress,$rmk1,'', $file_status,$loggined_in_userId);
            }
            $result = update_efile($fileid, $markrd_emp,null,$loggined_in_userId); // USE FOR ADD DRAFT
			
			update_signture_ds_local_data($draft_log_id,$loggined_in_userId);
			
			update_file_draft($loggined_in_userId,$markrd_emp,$draft_log_id); /*Update file draft log table*/
        }
        return $result;
    }	
	public function multi_return_file($file_id,$mark_emp_id,$logged_empid,$section_id,$remark,$draft_log_id)
    {       
        $filedetails =  getFileDetails($file_id);
        $empdetails = empdetails($mark_emp_id);
        $empdetails_m = empdetails($logged_empid);     
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
          $empssection = empdetails($logged_empid);
        if($empdetails_m[0]['role_id'] ==3 || $empssection[0]['role_id']==3){
            $file_return = '1';
        }else if($empdetails_rr[0]['role_id']==2){
            $file_return = '0';
        }else if($empdetails_m[0]['role_id'] ==8 && $empdetails_rr[0]['role_id']<$empdetails_m[0]['role_id'] ){
            $file_return = '1';
        }else if($empdetails_rr[0]['role_id'] == '9'){
            $file_return = '0';
        }else{
            $file_return = '1';
        }
		if($this->input->post('ps_moniter_date') && $this->input->post('ps_moniter_date')!=''){
           $ps_moniter_date = date('Y-m-d',strtotime($this->input->post('ps_moniter_date')));
           $file_data = array(
            'file_received_emp_id' => $mark_emp_id,
            'file_sender_emp_id' => $logged_empid,
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
            'file_sender_emp_id' => $logged_empid,
            'file_return' => $file_return,
            'file_hardcopy_status' => 'not',
            'file_mark_section_date' => date('Y-m-d H:i:s'),
            'file_update_date' => date('Y-m-d H:i:s'),
			'file_mark_section_id' => $marksetion,
            );
        }
        $checkUserdesignation = checkUserdesignation($logged_empid);
        $filelog_data = array(
            'file_id' => $file_id,
            'section_id' => $marksetion,
            'to_emp_id' => $mark_emp_id,
            'from_emp_id' => $logged_empid,
            'flog_other_remark' => $remark,
            'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
            'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
			'emp_degignation_id' => $checkUserdesignation
        );
        $form_data_move1 = array(
            'fmove_file_id'  => $file_id,
            'fmove_current_user_id'  => $mark_emp_id,
            'fmove_previous_user_id' => $logged_empid,
            'fmove_to_unit_id'       => getunitid($empdetails_m[0]['role_id'])==''?0:getunitid($empdetails_m[0]['role_id']),
            'fmove_from_unit_id'     => getunitid($empdetails[0]['role_id'])==''?0:getunitid($empdetails[0]['role_id']),
            'file_return'            => $file_return,
        );      
        $res1 = updateData(FILES, $file_data, array('file_id' => $file_id));
        if ($res1) {
			update_efile($file_id,$mark_emp_id,null,$logged_empid); // use for add draft on file
			file_monitor_sms_sent(null,$mark_emp_id,$file_id,$file_return);
            insertData($filelog_data, FILES_LOG);
            insertData($form_data_move1, FILES_MOVEMENT);
			update_signture_ds_local_data($draft_log_id,$logged_empid);
			update_file_draft($logged_empid,$mark_emp_id,$draft_log_id);
        }        
		return 1;
    }		
	function check_digitally_sign_or_not(){
		$i=0;
        $j=0;
        $k=0;
        $post_data_array=array();
		$post_data_array_b=array();
		//pre($this->input->post());
        foreach($this->input->post() as $ky=>$val){
            if($ky=='ck_file_id'){
			   $total_post = count($val);
               foreach($val as $fky=>$value1){
					$post_data_array[$j][$ky]=$value1;
					$file_ley[]=$fky;
                    $j++;
               }
            }			              
            $i++;
        }
		$draft12 = array_keys($this->input->post('draft_log_id'));
		$checkdraft12 = array_keys($this->input->post('ck_file_id'));
		$checkval = array_intersect($draft12,$checkdraft12);
		foreach($checkval as $keyr => $checkval1){
		    $draft_log_id1 = $this->input->post('draft_log_id');		   
			$post_data_array_b[] = $draft_log_id1[$checkval1];			
			/*Draft signing content*/			
			$draft_content_md5_row = $this->input->post('file_param1');		   
			$draft_content_md5_aray[] = "'".$draft_content_md5_row[$checkval1]."'";
		}
		/*pre($post_data_array_b);		
		$draft_log_id= implode(',',$post_data_array_b);
		$draft_sign_list = get_list_with_in('ft_digital_signature',null,'ds_draft_log_id',$draft_log_id);
		echo count($draft_sign_list);
		*/
		
		$draft_log_id= implode(',',$post_data_array_b);		
		$draft_content_md5_str= implode(',',$draft_content_md5_aray);
		//$draft_sign_list = get_list_with_in('ft_digital_signature_b',null,'ds_local_data',$draft_content_md5_str);
		//$ds_sql="SELECT COUNT(ds_id) as total_sign_data FROM (`ft_digital_signature`) WHERE `ds_local_data` IN ($draft_content_md5_str) AND ds_draft_log_id IN ($draft_log_id)";
		//$draft_sign_list = get_row($ds_sql);
		//echo $draft_sign_list['total_sign_data'];		
		if($draft_content_md5_str!='' && $draft_log_id!=''){
			$ds_sql="SELECT COUNT(ds_id) as total_sign_data FROM (`ft_digital_signature`) WHERE `ds_local_data` IN ($draft_content_md5_str) AND ds_draft_log_id IN ($draft_log_id)";
			$draft_sign_list = get_row($ds_sql);
		}else{ $draft_sign_list['total_sign_data']=0; }
		echo $draft_sign_list['total_sign_data'];			
	}
	function single_file_digitally_sign_or_not(){	
		$draft_log_id=$this->input->post('draft_log_id');
		$draft_sign_list = get_list_with_in('ft_digital_signature',null,'ds_draft_log_id',$draft_log_id);
		//pre($draft_sign_list);
		echo count($draft_sign_list);
		//echo json_encode($post_data_array_b);	
	}
}