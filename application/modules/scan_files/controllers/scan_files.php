<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Scan_files extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->module('template');
		$this->load->model('scan_file_model','scan_file');
        $this->lang->load("files","hindi");
		$this->lang->load("scan_files","hindi");
        authorize();
    }
    public function is_logged_in()
    {
        if ($this->session->userdata('is_logged_in') === false)
        {
            redirect("home");
        }
    }
    public function index($file_id = null)
    {
		
        $this->is_logged_in();
        $data['title']              = 'Upload scan files ';
        $data['title_tab']          = 'Add files';
        $data['is_page_edit']       = FALSE;
        $data['id']                = $file_id;
        $departments_list           = get_list(DEPARTMENTS, 'department_default_no', null,'ASC');
        $data['departments_list']   = $departments_list;
        $district_list              = get_list(DISTRICT, 'district_name_hi', null,'ASC');
        $data['district_list']      = $district_list;
		$emp_sectionids = getEmployeeSection();
		$empdetails = empdetails(emp_session_id()) ;
		
		if(isset($empdetails[0]['role_id']) && ($empdetails[0]['role_id'] != 9)){
			  $section_list               = get_list(SECTIONS, null, array('section_id' =>getEmployeeSection())); 
		}else{
			  $section_list               = get_list(SECTIONS, null, array('section_id !=' =>getEmployeeSection())); 
		}
        $data['section_list']       = $section_list;
        $unit_level                 = get_list(UNIT_LEVEL, null, null);
        $data['unit_level']         = $unit_level;
        $data['state_list']         = get_list(STATE_MASTER,null,null);
        $data['head_notesheet']     = get_list(FILE_NOTESHEET_HEADER_MASTER,null,null);
		$data['file_id']     		= $file_id;      
		$file_details               = get_list(FILES,null,array('file_id' => $file_id));
		$data['file_details']     	= $file_details;		
		$data['module_name']        = "scan_files";
        $data['view_file']          = "scan_files/add_scan_files";
        $data['view_left_sidebar']  = 'admin/left_sidebar';
        $this->template->index($data);
    }
    public function manage_scan_files($file_id = null)
	{	
		$data['title']              = 'Upload scan files ';
        $data['title_tab']          = 'Add files';
        $departments_list           = get_list(DEPARTMENTS, 'department_default_no', null,'ASC');
        $data['departments_list']   = $departments_list;
        $district_list              = get_list(DISTRICT, 'district_name_hi', null,'ASC');
        $data['district_list']      = $district_list;
        $section_list               = get_list(SECTIONS, null, null);
        $data['section_list']       = $section_list;
        $data['state_list']         = get_list(STATE_MASTER,null,null);
        $data['head_notesheet']     = get_list(FILE_NOTESHEET_HEADER_MASTER,null,null);
		$file_details               = get_list(FILES,null,array('file_id' => $file_id));
		$data['file_details']     	= $file_details;

	
		$file_id = $this->input->post('redirect_url');
        $this->form_validation->set_rules('doc_scan_type', $this->lang->line('doc_scan_type'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('file_mark_section_id', $this->lang->line('file_mark_section_id'), 'trim|required|xss_clean');
        //$this->form_validation->set_rules('meta_key', $this->lang->line('meta_key'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('file_subject', $this->lang->line('file_subject'), 'trim|required|xss_clean');
        /*
		$this->form_validation->set_rules('file_offer_by', $this->lang->line('file_offer_by'), 'trim|required|xss_clean');
		if($this->input->post('file_offer_by') == 'v'){
            $from_place = $this->input->post('file_department_id');        
        }else if($this->input->post('file_offer_by') == 'c' || $this->input->post('file_offer_by') == 'jvn' ){
            $from_place = $this->input->post('district_id');        
        }else if($this->input->post('file_offer_by') == 'm' || $this->input->post('file_offer_by') == 'u'){
            $from_place = $this->input->post('court_bench');        
        }else if($this->input->post('file_offer_by') == 'au'){
            $from_place = $this->input->post('state_id');        
        }else if($this->input->post('file_offer_by') == 'sc'){
            $from_place = $this->input->post('gov_adocate_delhi');        
        }else{
            $from_place = $this->input->post('file_other_name');        
        }
		*/
        if ($this->form_validation->run($this) === TRUE) {
            if (isset($_FILES['file_upload']) && $_FILES['file_upload']['error'] == 0) {

                $form_scan_data = array(
                    'scan_type' => $this->input->post('doc_scan_type'),
					'scan_file_type' => $this->input->post('scan_file_types'),
					'scan_subfile_types' => $this->input->post('scan_subfile_types'),
                    'scan_section_id' => $this->input->post('file_mark_section_id'),
                    'scan_meta_key' => $this->input->post('save_meta'),
                    'scan_subject' => $this->input->post('file_subject'),
                    'scan_creator_id' => emp_session_id(),
                    'scan_file_from_type' => $this->input->post('file_offer_by') != '' ? $this->input->post('file_offer_by') : '0',
                    'scan_file_from_place' => @$from_place != '' ? $from_place : '0',
                    'scan_created_date' => date('Y-m-d H:i:s'),
                    'scan_update_date' => date('Y-m-d H:i:s'),
                );
				
                $file_title =  trim(strtolower($this->input->post('file_title')));
				
                $file_upload = scan_file_upload('file_upload', './uploads/scan/'.$this->input->post('file_mark_section_id') . '/'.date('Y'),$file_title);

                if($file_upload == 'error') {
                    $this->session->set_flashdata('error', 'Error on file uploading try again....');
                    redirect('scan_files/index/' . $file_id);
                }else if ($file_upload != 'error') {
                    $path = 'uploads/scan/'.$this->input->post('file_mark_section_id').'/'.date('Y') ;
                    $final_p = $path . '/' . $file_upload;
                } else {
                    $final_p = '';
                }
                $form_scan_data1 = array(
                    'scan_file_path' => $final_p,
                );

                $final_form_data = array_merge($form_scan_data, $form_scan_data1);

                if (isset($file_upload) && $file_upload != '') {

                    if ($file_upload != 'error') {
//pr($final_form_data);
                        $res = insertData_with_lastid($final_form_data, FILE_SCAN);

                        if($res){
							if($this->input->post('url_red') && $this->input->post('redirect_url'))
							{
								$file_details = get_scan_file_deatils($this->input->post('redirect_url'));
								
								$scan_id_exits =$file_details['scan_id'];
								$scan_ids = array();
								if(isset($scan_id_exits) && !empty($scan_id_exits) )
								{
									$existids = unserialize($scan_id_exits);
									array_push($existids,$res);

									serialize($existids);
									$file_data['scan_id'] =  serialize($existids);
									$condition = array('file_id'=>$this->input->post('redirect_url'));
									$res = updateData(FILES, $file_data , $condition);
								}
								else{

									$scan_ids = array($res);
									$file_data['scan_id'] = serialize($scan_ids);									
									$condition = array('file_id'=>$this->input->post('redirect_url'));
									updateData(FILES, $file_data , $condition);	
								}
								echo "<script>window.location='".$this->input->post('url_red')."'</script>";
							}else
							{
								$this->session->set_flashdata('message', 'File Successfully uploaded <span style="float:right"> File id: '.$res.'</span>');
								redirect('scan_files/index/'.$file_id);
							}
                        }
                    }
                }
            }
        }
       // $this->session->set_flashdata('error', $this->lang->line('file_validation_error'));
        
        $data['module_name']        = "scan_files";
        $data['view_file']          = "scan_files/add_scan_files";
        $data['view_left_sidebar']  = 'admin/left_sidebar';
        $this->template->index($data);
    }

	// this is comment on 27/6/2016 because need modification 
	/*public function file_mark_cus($fileid = null)
    {
    $rmk1 = $this->input->post('cus_remark');
    $file_status12 = @$this->input->post('file_status12') != '' ? $this->input->post('file_status12') : null;
    $markrd_emp = '218';
        $file_pr = '0';
        $send_file = filesend_nextofficer($fileid, $markrd_emp, $file_pr,$rmk1,null,$file_status12);
        if($send_file){
            $this->session->set_flashdata('message', 'File Successfully Sent on centrel scan unit <span style="float:right"> File id: '.$fileid.'</span>');
            redirect('view_file/dealing_file');
        }
    }*/
    
    	public function file_mark_cus($file_id = null)
    {
        $file_remark = $this->input->post('cus_remark');
        $f_status = @$this->input->post('file_status12') != '' ? $this->input->post('file_status12') : null;
        $mark_emp = '218';
        $file_progressid = '0';

    //    $send_file = filesend_nextofficer($fileid, $markrd_emp, $file_pr,$rmk1,null,$file_status12);

        if (isset($file_id) && $mark_emp != '') {
            $filedetails =  getFileDetails($file_id);
            $check_da_permission = logged_emp_is_permission(); // use for DA prmission

            if($filedetails->file_received_emp_id == emp_session_id() || $check_da_permission['emp_id_assign_by'] == $filedetails->file_received_emp_id) {

                $empdetails = empdetails(emp_session_id());
                $empdetails2 = empdetails($mark_emp);

                $file_data = array(
                    'file_received_emp_id' => $mark_emp,
                    'file_sender_emp_id' => emp_session_id(),
                    'file_hardcopy_status' => 'not',
                    'file_update_date' => date('Y-m-d H:i:s'),
                    'file_mark_section_id'=> !empty( $section_id)? $section_id : $filedetails->file_mark_section_id,
                    'file_unit_level' => getunitid($empdetails2[0]['role_id'])==''?0:getunitid($empdetails2[0]['role_id']),
                    'file_return' => '0',
                    'file_status' => isset($f_status)?$f_status :'',
                );
                if($file_remark != ''){
                    $remark = $file_remark;
                }else{
                    $remark = '';
                }

                $checkUserdesignation = checkUserdesignation();

                $filelog_data = array(
                    'file_id' => $file_id,
                    'section_id' =>  !empty( $section_id)? $section_id : $filedetails->file_mark_section_id,
                    'to_emp_id' => $mark_emp,
                    'from_emp_id' => emp_session_id(),
                    'flog_other_remark' => $remark,
                    'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
                    'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
                    'sublogin' => $this->session->userdata('emp_id'),
                    'emp_degignation_id' => $checkUserdesignation,
                    'file_status_log' => isset($f_status)?$f_status :'',
                );

                $form_data_move1 = array(
                    'fmove_file_id'  => $file_id,
                    'fmove_current_user_id'  => $mark_emp,
                    'fmove_previous_user_id' => emp_session_id(),
                    'fmove_to_unit_id'       => getunitid($empdetails2[0]['role_id'])==''?0:getunitid($empdetails2[0]['role_id']),
                    'fmove_from_unit_id'     => getunitid($empdetails[0]['role_id'])==''?0:getunitid($empdetails[0]['role_id']),
                );

                $res1 = updateData(FILES, $file_data, array('file_id' => $file_id));
                if ($res1) {
                insertData($filelog_data, FILES_LOG);
                insertData($form_data_move1, FILES_MOVEMENT);
                    $this->session->set_flashdata('message', 'File Successfully Sent on centrel scan unit <span style="float:right"> File id: '.$file_id.'</span>');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            }else{
                $this->session->set_flashdata('message', 'File Successfully Sent on centrel scan unit <span style="float:right"> File id: '.$file_id.'</span>');
                redirect($_SERVER['HTTP_REFERER']);
            }
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

	
	public function search_scan_file()
   {
	  $get_file =	$this->scan_file->search_scan_file();
	  echo json_encode($get_file);
      exit();
	}
	public function scan_file_open()
   {
		$scan_id = $this->input->post('scan_id');
		$get_file =	$this->scan_file->scan_file_open($scan_id);
		$scan_file = $get_file[0];
		echo $scan_file->scan_file_path;
		
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
	
	// function get_subfiletype($id = null){
        // $scan_file_id = $this->input->post('scan_file_id');
        // $subfiletype = get_list(SCAN_FILE_TYPE, null, array('perent_type_id' => $scan_file_id));
        // echo json_encode($subfiletype);
        // exit();

    // }
	
		function get_subfiletype($id = null){
        $scan_file_id = $this->input->post('scan_file_id');
        $section_id = $this->input->post('section_id');
        if(isset($scan_file_id)) {
            if(isset($scan_file_id) && $section_id != '') {
                $where = "FIND_IN_SET('" . $section_id . "', type_section_id)";
                $this->db->where($where);
            }
            $this->db->where('perent_type_id', $scan_file_id);
            $this->db->order_by('type_id,sub_file_type_hi', 'ASC');
            $this->db->from(SCAN_FILE_TYPE);
            $query = $this->db->get();
            echo json_encode($query->result_array());
            exit();
        }
    }
	
	public function csu_upload_files($file_id1 = null)
    {
	
        $this->is_logged_in();
        $data['id']              = $file_id1;
        $data['title']              = 'Upload scan files .';
        $data['title_tab']          = 'Add files';
        $data['is_page_edit']       = FALSE;
        $departments_list           = get_list(DEPARTMENTS, 'department_default_no', null,'ASC');
        $data['departments_list']   = $departments_list;
        $district_list              = get_list(DISTRICT, 'district_name_hi', null,'ASC');
        $data['district_list']      = $district_list;
		$section_list      = get_list(SECTIONS, null, null);
        $data['section_list']       = $section_list;      
        $unit_level                 = get_list(UNIT_LEVEL, null, null);
        $data['unit_level']         = $unit_level;
        $data['state_list']         = get_list(STATE_MASTER,null,null);
		$data['file_details']     		= get_list(FILES,null,array('file_id' => $file_id1));
		$data['module_name']        = "scan_files";
        $data['view_file']          = "scan_files/scan_add_fileid";
        $data['view_left_sidebar']  = 'admin/left_sidebar';
        $this->template->index($data);
    }
    
    public function csu_upload_files_manage($file_id1 = null)
    {
	 if(empty($this->input->post()))
		{
			$this->session->set_flashdata('error', 'Post value greater than set post value');
			redirect('scan_files/csu_upload_files/'.$file_id1);
		} 
        $this->is_logged_in();
        $data['id']              = $file_id1;
        $data['title']              = 'Upload scan files .';
        $data['title_tab']          = 'Add files';
        $data['is_page_edit']       = FALSE;
        $departments_list           = get_list(DEPARTMENTS, 'department_default_no', null,'ASC');
        $data['departments_list']   = $departments_list;
        $district_list              = get_list(DISTRICT, 'district_name_hi', null,'ASC');
        $data['district_list']      = $district_list;
		$section_list      = get_list(SECTIONS, null, null);
        $data['section_list']       = $section_list;
        $unit_level                 = get_list(UNIT_LEVEL, null, null);
        $data['unit_level']         = $unit_level;
        $data['state_list']         = get_list(STATE_MASTER,null,null);
		$file_details               = get_list(FILES,null,array('file_id' => $file_id1));
		$data['file_details']     	= $file_details;


        $this->form_validation->set_rules('doc_scan_type', $this->lang->line('doc_scan_type'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('file_mark_section_id', $this->lang->line('file_mark_section_id'), 'trim|required|xss_clean');
       // $this->form_validation->set_rules('meta_key', $this->lang->line('meta_key'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('file_subject', $this->lang->line('file_subject'), 'trim|required|xss_clean');
        //$this->form_validation->set_rules('file_offer_by', $this->lang->line('file_offer_by'), 'trim|required|xss_clean');

        if($this->input->post('file_offer_by') == 'v'){
            $from_place = $this->input->post('file_department_id');
         //   $this->form_validation->set_rules('file_department_id', $this->lang->line('file_department_id'), 'trim|required|xss_clean');
        }else if($this->input->post('file_offer_by') == 'c' || $this->input->post('file_offer_by') == 'jvn' ){
            $from_place = $this->input->post('district_id');
         //   $this->form_validation->set_rules('district_id', $this->lang->line('district_id'), 'trim|required|xss_clean');
        }else if($this->input->post('file_offer_by') == 'm' || $this->input->post('file_offer_by') == 'u'){
            $from_place = $this->input->post('court_bench');
         //   $this->form_validation->set_rules('court_bench', $this->lang->line('court_bench'), 'trim|required|xss_clean');
        }else if($this->input->post('file_offer_by') == 'au'){
            $from_place = $this->input->post('state_id');
         //   $this->form_validation->set_rules('state_id', $this->lang->line('state_id'), 'trim|required|xss_clean');
        }else if($this->input->post('file_offer_by') == 'sc'){
            $from_place = $this->input->post('gov_adocate_delhi');
         //   $this->form_validation->set_rules('gov_adocate_delhi', $this->lang->line('gov_adocate_delhi'), 'trim|required|xss_clean');
        }else{
            $from_place = $this->input->post('file_other_name');
         //   $this->form_validation->set_rules('file_other_name', $this->lang->line('file_other_name'), 'trim|required|xss_clean');
        }
		
        if ($this->form_validation->run($this) === TRUE) {
            if (isset($_FILES['file_upload'])) {
            $file_upload = upload_array_files('./uploads/scan/'.$this->input->post('file_mark_section_id') . '/'.date('Y'), $this->input->post('file_title'), $_FILES['file_upload']);				
				$scan_file_type = $this->input->post('scan_file_types');
                $scan_subfile_types = $this->input->post('scan_subfile_types');
				if($file_upload == 'error'){
			//	echo "Error on file uploading try again....".$file_upload;
				$this->session->set_flashdata('error', 'Error on file uploading try again....');
				redirect('scan_files/csu_upload_files/'.$file_id1);
					}else{
					foreach($file_upload as $key => $upload_f) {
                 // bork mark code
                    $b_nonjhj = $this->input->post('add_bookmark_text'.$key);
                    if(isset($b_nonjhj) && !empty($b_nonjhj[0])){
                    $tyuv = explode(',',$b_nonjhj[0]);
                    $rty = array();
                    if(is_array($tyuv) && isset($tyuv)) {
                        foreach ($tyuv as $b_nonjhjp) {
                            $tyu = explode('=', $b_nonjhjp);
                            if(is_numeric($tyu[0]) && isset($tyu[1])) {
                                $rty[$tyu[0]] = $tyu[1];
                            }
                        }
                      }
                    }else{
                        unset($rty);
                    }
                    // bork mark code end
                    $form_scan_data = array(
                        'scan_type' => $this->input->post('doc_scan_type'),
						'scan_file_type' => $scan_file_type[$key],
                        'scan_subfile_types' => $scan_subfile_types[$key],
                        'scan_section_id' => $this->input->post('file_mark_section_id'),
                        'scan_meta_key' => $this->input->post('save_meta'),
                        'scan_subject' => $this->input->post('file_subject'),
                        'scan_creator_id' => emp_session_id(),
                        'scan_file_from_type' => $this->input->post('file_offer_by') != '' ? $this->input->post('file_offer_by') : '0',
                        'scan_file_from_place' => @$from_place != '' ? $from_place : '0',
                        'scan_created_date' => date('Y-m-d H:i:s'),
                        'scan_update_date' => date('Y-m-d H:i:s'),
                        'scan_file_path' => $upload_f,
                        'scan_bookmark_page' => @isset($rty) && !empty($rty) ? serialize($rty) : false
                    );
					$res[] = insertData_with_lastid($form_scan_data, FILE_SCAN);
                    $upload_f_multi[] = $upload_f;
                }
				}
				if($this->input->post('mark_to_pre_user') != '' && $this->input->post('mark_to_pre_user') == 'mark_to_pre_user'){
                    $receiver_emp_id = $file_details[0]['file_sender_emp_id'];
                    $sec_marksec = $file_details[0]['file_sender_emp_id'];
                }else {
                if($this->input->post('file_mark_section_id')!=''){
                    $sectionunit_user = sectionunit_user();
                    $markunitid =  $sectionunit_user[$this->input->post('file_mark_section_id')];

                    if($this->input->post('file_mark_section_id') == 16 && $this->input->post('file_type') != 'f'){ // use for drafting section when file type not select
                        $markunitid = '59';
                    }
                    if($this->input->post('file_mark_section_id') == 100 ){
					    $receiver_emp_id = $file_details[0]['file_sender_emp_id'];
					}else{
                        $receiver_id = getmarkeduser($this->input->post('file_mark_section_id'),$markunitid);
                        $receiver_emp_id = $receiver_id['emp_id'];
					}
					
                   //$receiver_id = getmarkeduser($this->input->post('file_mark_section_id'),$markunitid);
                   //$receiver_emp_id = $receiver_id['emp_id'];
                    $sec_marksec = $this->input->post('file_mark_section_id');
                }else{
                    $receiver_emp_id =$this->input->post('file_mark_officer_id');
                    $sec_marksec = '100'; // 100 no for direct mark files
                }
				}

                $file_data1 = array(
                    'file_received_emp_id'    => $receiver_emp_id,
                    'file_sender_emp_id'      => emp_session_id(),
                    'file_mark_section_date'  => date('Y-m-d H:i:s'),
                    'file_update_date'        => date('Y-m-d H:i:s'),
                    'file_unit_level'         => '62', // 62 is csu unit id
                //    'scan_id'                 => serialize($res),
                    'file_hardcopy_status'    => 'not',
                );
								 
                $file_log_data1 = array(
                    'file_id'  => $file_id1,
                    'section_id'  => $sec_marksec,
                    'to_emp_id'   => $receiver_emp_id,
                    'from_emp_id' => emp_session_id(),
                    'flog_remark' => 'File Enter in Section',
                    'flog_other_remark' => "Number of files add : ".count($res),
                    'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
                    'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
                    'document_path' => implode(',',$upload_f_multi),
					'scan_ids'      => serialize($res),
                    'emp_degignation_id' => checkUserdesignation()
                );
                $empdetails_to = empdetails($receiver_emp_id);
                $form_data_move1 = array(
                    'fmove_file_id'  => $file_id1,
                    'fmove_current_user_id'  => $receiver_emp_id,
                    'fmove_previous_user_id' => emp_session_id(),
                    'fmove_from_unit_id'     => getunitid($this->session->userdata('user_role')) ? getunitid($this->session->userdata('user_role')) : 0 ,   // Central receipt
                    'fmove_to_unit_id'       => getunitid($empdetails_to[0]['role_id']) ? getunitid($empdetails_to[0]['role_id']) : 0,
                    'file_return'            => '0'
                );
				
				$existscan = $file_details[0]['scan_id'];
                if(isset($existscan) && !empty($existscan)) {
                    $existscan1 = unserialize($existscan);
                    $scan_data1 = array_merge($existscan1, $res);
                }
                else {
                    $scan_data1 = $res;
                }

                $file_data1['scan_id'] = serialize($scan_data1);

                $res_u = updateData(FILES, $file_data1 , array('file_id'=>$file_id1));
                if($res_u){
					   insertData($file_log_data1, FILES_LOG);
					   insertData($form_data_move1, FILES_MOVEMENT);
					   if($this->session->userdata('user_role') == 39 ){
					     $this->session->set_flashdata('message', 'File Successfully Added and marked to officer ..<span style="float: right">File id '.$file_id1.'</span>');
						 redirect('show_file/csu');
					   }else{
					   	 $this->session->set_flashdata('message', 'File Successfully Added ..<span style="float: right">File id '.$file_id1.'</span>');
						 redirect('scan/dealing/'.$file_id1);
					   }
						
				   }
            }
        }

		$data['module_name']        = "scan_files";
        $data['view_file']          = "scan_files/scan_add_fileid";
        $data['view_left_sidebar']  = 'admin/left_sidebar';
        $this->template->index($data);
    }
	public function manage_sacn_bookmark($scanid = null)
    {
        if(isset($scanid) && $scanid != 'null')
            $scan_details = scan_file_details($scanid);
            $add_bookmark = $this->input->post('add_bookmark');
        if(isset($add_bookmark) && !empty($add_bookmark)){
            $tyuv1 = explode(',',$add_bookmark);
            $rty_data = array();
            if(isset($tyuv1) && is_array($tyuv1)) {
                foreach ($tyuv1 as $b_nonjhjp1) {
                    $tyu1 = explode('=', $b_nonjhjp1);
                    if(is_numeric($tyu1[0]) && isset($tyu1[1])) {
                        $rty_data[$tyu1[0]] = $tyu1[1];
                    }
                }
            }
            $data2 = $rty_data;
        }else{
            unset($rty_data);
            $data2 = '';
        }
        if(isset($scan_details['scan_bookmark_page']) && !empty($scan_details['scan_bookmark_page'])){
       //     $bookmark = unserialize($scan_details['scan_bookmark_page']);
       //     $result = array_intersect_key($rty_data, $bookmark); // check key is exixt or not and provide duplicate key with fist array element
          //  unset($bookmark[key($result)]);
           // $data2 = array_merge($bookmark,$rty_data);
        }
//pr($data2);
        $update_scan['scan_bookmark_page'] = @isset($rty_data) && !empty($rty_data) ? serialize($rty_data) : null;
      //  pr($update_scan);
        $res_update = updateData(FILE_SCAN, $update_scan , array('scan_id'=>$scanid));
        if($res_update){
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    public function file_direct_mark($file_id1 = null)
    {
        if($file_id1 != null){
            $file_details     = get_list(FILES,null,array('file_id' => $file_id1));
            $sectionunit_user = sectionunit_user();
            $markunitid =  $sectionunit_user[$file_details[0]['file_mark_section_id']];

            if($file_details[0]['file_mark_section_id'] == 16 && $file_details[0]['file_type'] != 'f'){ // use for drafting section when file type not select
                $markunitid = '59';
            }
            $receiver_id = getmarkeduser($file_details[0]['file_mark_section_id'],$markunitid);
            $receiver_emp_id = $receiver_id['emp_id'];
            $sec_marksec = $file_details[0]['file_mark_section_id'];

            $file_data1 = array(
                'file_received_emp_id'    => $receiver_emp_id,
                'file_sender_emp_id'      => emp_session_id(),
                'file_mark_section_date'  => date('Y-m-d H:i:s'),
                'file_update_date'        => date('Y-m-d H:i:s'),
                'file_unit_level'         => '62', // 62 is csu unit id
                'file_hardcopy_status'    => 'not',
            );

            $file_log_data1 = array(
                'file_id'  => $file_id1,
                'section_id'  => $sec_marksec,
                'to_emp_id'   => $receiver_emp_id,
                'from_emp_id' => emp_session_id(),
                'flog_remark' => 'File Enter in Section',
                'flog_other_remark' => "Directly marked by CSU (No scan Pdf attached)",
                'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
                'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
                'emp_degignation_id' => checkUserdesignation(),
                'file_status_log	' => 'p'
            );
			
            $empdetails_to = empdetails($receiver_emp_id);
            $form_data_move1 = array(
                'fmove_file_id'  => $file_id1,
                'fmove_current_user_id'  => $receiver_emp_id,
                'fmove_previous_user_id' => emp_session_id(),
                'fmove_from_unit_id'     => getunitid($this->session->userdata('user_role')) ? getunitid($this->session->userdata('user_role')) : 0 ,   // Central receipt
                'fmove_to_unit_id'       => getunitid($empdetails_to[0]['role_id']) ? getunitid($empdetails_to[0]['role_id']) : 0,
                'file_return'            => '0'
            );

            $res_u = updateData(FILES, $file_data1 , array('file_id'=>$file_id1));
            if($res_u){
                insertData($file_log_data1, FILES_LOG);
                insertData($form_data_move1, FILES_MOVEMENT);

                $this->session->set_flashdata('message', 'File Directly marked to officer ..<span style="float: right">File id '.$file_id1.'</span>');

                redirect('show_file/csu');
            }
        }
    }
}