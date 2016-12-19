<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Draft extends MX_Controller {
     function __construct() {
        parent::__construct();
        $this->load->module('template');
        $this->load->model('draft_model');
        $this->load->helper('scanfile');
		$this->load->language('view_file','hindi');
		$this->load->language('draft','hindi');
		authorize();
    }
	
 	public function index() {
		no_cache(); 		
		$data['title']    =  $this->lang->line('draft_title');
		$data['small_title']    =  $this->lang->line('inbox_inprocesss');
		$data['sub_title']    =  $this->lang->line('inbox');
		$data['draft_data']  = $this->draft_model->get_draft('inbox');
		$data['module_name']    = "draft";
        $data['view_file']      = "index";
        $this->template->index($data);
    }
	
	public function send_draft() {
		no_cache(); 		
		$data['title']    =  $this->lang->line('draft_title');
		$data['small_title']    =  $this->lang->line('sendbox_inprocesss');
		$data['sub_title']    =  $this->lang->line('sendbox');
		$data['draft_data']  = $this->draft_model->get_draft('send');
		$data['module_name']    = "draft";
        $data['view_file']      = "index";
        $this->template->index($data);
    }
	
	public function working_draft() {
		no_cache(); 		
		$data['title']    =  $this->lang->line('draft_title');
		$data['small_title']    =  $this->lang->line('workingbox_inprocesss');
		$data['sub_title']    =  $this->lang->line('workingbox');
		$data['draft_data']  = $this->draft_model->get_draft('working');
		$data['module_name']    = "draft";
        $data['view_file']      = "index";
        $this->template->index($data);
    }
	
	public function final_draft() {
		no_cache(); 		
		$data['title']    = $this->lang->line('draft_title');
		$data['small_title']    =  $this->lang->line('finishedbox_inprocesss');
		$data['sub_title']    =  $this->lang->line('finishedbox');
		$data['draft_data']  = $this->draft_model->get_draft('finished');
		$data['module_name']    = "draft";
        $data['view_file']      = "index";
        $this->template->index($data);
    }
	
	function add_draft(){
		$data['title']    =  $this->lang->line('draft_create');
		$data['sub_title']    =   $this->lang->line('draft_sub_create');
		$data['add_draft']    = false;
		$data['search_file']    = false;
		$data['module_name']    = "draft";
        $data['view_file']      = "compose_draft";
        $this->template->index($data);
	}
	
	
	function search_file($location = null, $draft_id = null){
		$this->form_validation->set_rules('search_value','search_value', 'trim|required|xss_clean');
		$this->form_validation->set_rules('sections_all','sections_all', 'trim|required|xss_clean');
		$this->form_validation->set_rules('year_select','year_select', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        if ($this->form_validation->run($this) === TRUE) {
			$data_file  = $this->draft_model->get_details($this->input->post('search_value'),$this->input->post('sections_all'), $this->input->post('year_select'));
			if(!empty($data_file)){
				$data['file_data'] = getFileDetails($data_file['file_id'] , true);
			} else{
				$data['file_data'] = '';
			}
			$data['search_file']    = true;
		} else{		
			$data['search_file']    = false;
		}
		$data['title']    =   $this->lang->line('draft_create');
		$data['sub_title']    =  $this->lang->line('draft_sub_create');
		$data['add_draft']    = false;
		$data['module_name']    = "draft";
		if($location != null && $location == 1){
			$data['draft_data']  = $this->draft_model->get_single_draft($draft_id);
			$data['draft_emp']  = $this->draft_model->get_draft_employees($draft_id);
			$data['view_file']      = "add_draft_file";
		}else{
			$data['view_file']      = "compose_draft";
		}
		$this->template->index($data);
	}
	
	function add_fileto_draft($file_id, $draft_id = null){
		$data['title']    =   $this->lang->line('draft_create');
		$data['sub_title']    =  $this->lang->line('draft_sub_create');
		$data['add_draft']    = true;
		$data['search_file']    = true;
		$data['file_data'] =  getFileDetails($file_id , true);
		$data['module_name']    = "draft";
		if($draft_id != null){
			$final_data = array(
				'draft_file_id' => $file_id,
			); 
			$res = updateData(DRAFT, $final_data, array('draft_id' => $draft_id));
			if($res){
				$this->session->set_flashdata('message', $this->lang->line('msg_draft_added'));
				redirect('draft/draft');
			}
		} else {
			$data['view_file']  = "compose_draft";
		}
		$this->template->index($data);
	}
	
	
	
	
	function add_file($draft_id){   // use for drafat exists and file not add
		$data['title']    =   $this->lang->line('draft_create_on_file');
		$data['sub_title']    =  $this->lang->line('draft_sub_create');
		$data['add_draft']    = false;
		$data['search_file']    = false;
		$data['draft_data']  = $this->draft_model->get_single_draft($draft_id);
		$data['draft_emp']  = $this->draft_model->get_draft_employees($draft_id);
		$data['module_name']    = "draft";
		$data['view_file']      = "add_draft_file";
		$this->template->index($data);
	}
	
		function generate_draft($id = null ,  $type){
		$content = base64_decode($this->input->post('final_content'));
		$data['title']    =  'e-'.draft_type($type);
		$data['sub_title']    =  'e-'.draft_type($type);
		$data['draft_type']    = $type;
		$data['sing_user'] = $this->input->post('sing_user');
		$data['officer_dign'] = get_officer_dign($this->input->post('sing_user'));
		$data['department_mp'] = $this->input->post('department_mp');
		$data['send_department'] = $this->input->post('send_department');
		$data['draft_content_text'] = $content ;
		$this->session->set_userdata('draft_content_text',$content);
		$this->session->set_userdata('sing_user',$this->input->post('sing_user'));
		$this->session->set_userdata('send_department',$this->input->post('send_department'));
		$data['module_name']    = "draft";
        $data['view_file']      = "temporary_draft";
		$data['add_draft']    = true;
		$data['search_file']  = true;
		$data['file_data'] =  getFileDetails($this->input->post('file_id') , true);
		$data['title']    =   $this->lang->line('draft_create');
		$data['sub_title']    =  $this->lang->line('draft_sub_create');
        $this->template->index($data);
	}
	function save_draft($id = ''){
		$this->form_validation->set_rules('sender_id','sender_id', 'trim|required|xss_clean');
		$this->form_validation->set_rules('draft_subject','draft_subject', 'trim|required|xss_clean');
		$this->form_validation->set_rules('draft_type','draft_type', 'trim|required|xss_clean');
		$this->form_validation->set_rules('draft_content_text','draft_content_text', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        if($this->form_validation->run($this) === TRUE) {
			$btnadddraft = $this->input->post('btnadddraft');
			$data = array(
				'draft_file_id' => $this->input->post('file_id') != '' ? $this->input->post('file_id') : 0 ,
				'draft_parent_id' => $id != '' ? $id : 0,
				'draft_creater_emp_id' => emp_session_id(),
				'draft_subject' => $this->input->post('draft_subject'),
				'draft_content_text' => escape_str($this->input->post('draft_content_text')),
				'draft_type' => $this->input->post('draft_type'),
				'draft_version' => $this->input->post('draft_version'),
				'draft_sender_id' => emp_session_id(),
				'draft_reciever_id' => emp_session_id(),			
				'draft_is_finalize' => 0,  //0 for draft working in process
				'draft_create_date' => date('Y-m-d h:i:s'),
			);
			
			if($btnadddraft == 'send_draft'){
				$data_draft = array(
					'draft_status' => 3, // finished  at user level and send to upper level
				);
			} else{
				$data_draft= array(
					'draft_status' => 3, // working at user level for multiple editing
				);
			}
			$final_data = array_merge($data, $data_draft);
			 
			$draft_id = insertData_with_lastid($final_data, DRAFT);
			$log_data = array(
				'draft_log_creater' => emp_session_id(),
				'draft_log_create_date' => date('Y-m-d h:i:s'),
				'draft_log_draft_id' => $draft_id,
				'draft_log_sendto' => emp_session_id(),
				'draft_final' => 0,  // draft final or not
				'draft_content' => escape_str($this->input->post('draft_content_text')),
                'draft_log_sublogin_creater' => $this->session->userdata("emp_id"),
				'draft_log_file_id' => $this->input->post('file_id') != '' ? $this->input->post('file_id') : 0 ,
                'draft_log_section_id' => $this->input->post('section_id') != '' ? $this->input->post('section_id') : null ,
				); 
			//pr($log_data);
			//for update file table with draft
			if($this->input->post('file_id') != ''){
				updateData(FILES, array('file_status' => 'p,e', 'final_draft_id' => $draft_id), array('file_id' => $this->input->post('file_id') ));
			}
			$res = insertData($log_data, DRAFT_LOG);
			
			if($res){
				$this->session->set_flashdata('message', $this->lang->line('msg_draft_added'));
				redirect('draft/draft');
			}
		}
		$data['add_draft']    = true;
		$data['search_file']  = true;
		$data['file_data'] =  getFileDetails($this->input->post('file_id') , true);
		$data['title']    =   $this->lang->line('draft_create');
		$data['sub_title']    =  $this->lang->line('draft_sub_create');
		$data['module_name']    = "draft";
        $data['view_file']      = "compose_draft";
        $this->template->index($data);
	}
	
	function create_fileto_draft($file_id, $type, $draft_id = null){
		$data['title']    =  'e-'.draft_type($type);
		$data['sub_title']    =  'e-'.draft_type($type);
		$data['draft_type']    = $type;
		if($draft_id != null){
			$data['draft_id']    = $draft_id;
		}
		$data['module_name']    = "draft";
		$data['file_data'] =  getFileDetails($file_id , true);
		$data['view_file']      = "draft_create";
		$this->template->index($data);
	}
	
	function save_draft_file($d_id = null){
		$is_ajax_autoadd = $this->input->post('is_ajax_autoadd') != '' ? $this->input->post('is_ajax_autoadd') : false;
		$is_ajax_return = $this->input->post('is_ajax_return') != '' ? $this->input->post('is_ajax_return') : false;
				
		$mark_to_other_dept = $this->input->post('mark_to_other_dept') != '' ? escape_str($this->input->post('mark_to_other_dept')) : null;
        $mark_to_other_dept_select = $this->input->post('mark_to_other_dept_select') != '' ? escape_str($this->input->post('mark_to_other_dept_select')) : null;
		
		if($is_ajax_return){
			$draft_content_text = base64_decode($this->input->post('draft_content_text'));
			$this->session->set_userdata('sing_user','');
			$this->session->set_userdata('draft_content_text','');
		} else {
			$draft_content_text = base64_decode($this->input->post('final_content')); // $this->input->post('draft_content_text');
		}
		$this->form_validation->set_rules('draft_subject','draft_subject', 'trim|required|xss_clean');
		$this->form_validation->set_rules('draft_type','draft_type', 'trim|required|xss_clean');
		//$this->form_validation->set_rules('draft_content_text','draft_content_text', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        $d_log_id = $this->input->post('log_id') ? $this->input->post('log_id') : null;
        $section_id1 = $this->input->post('Section_id1') ? $this->input->post('Section_id1') : null;

        $file_ids = $this->input->post('file_id') ? $this->input->post('file_id') : null;

	   if($this->form_validation->run($this) === TRUE) {
			$btnadddraft = $this->input->post('btnadddraft');				
			$data = array(
				'draft_file_id' => $this->input->post('file_id'),			
				'draft_sender_id' => emp_session_id(),
				'draft_reciever_id' => emp_session_id(),
				'draft_subject' => $this->input->post('draft_subject'),
				'draft_content_text' => escape_str($draft_content_text),
				'draft_type' => $this->input->post('draft_type'),
				'draft_is_finalize' => 0,  //0 for draft working in process
				'draft_create_date' => date('Y-m-d H:i:s'),
				'order_generat_officer_id' =>$this->input->post('officer_id'),// != '' ? $this->input->post('officer_id') : 0 ,
			);			
			if($btnadddraft == 'save_draft'){
				$data_draft = array(
					'draft_status' => 3, // finished  at user level and send to upper level
				);
			} else{
				$data_draft= array(
					'draft_status' => 2, // working at user level for multiple editing
				);
			}
			$final_data = array_merge($data, $data_draft);
			//pr($final_data);
				if($d_id == null && empty($d_id)){

				$query_draft = $this->db->get_where(DRAFT, array('draft_file_id' => $file_ids, 'draft_type' => 'n'), '1');
				$draft_data = $query_draft->row_array();
                if($query_draft->num_rows() > 0 && $this->input->post('draft_type') == 'n'){
				$res = updateData(DRAFT, $final_data, array('draft_id' =>$draft_data['draft_id'] ));
				$d_id = $draft_data['draft_id'];

				}else{

				$data_draft_creater = array('draft_creater_emp_id' => emp_session_id());
				$full_final_data = array_merge($data_draft_creater, $final_data);
				$d_id = insertData_with_lastid($full_final_data, DRAFT);

				}

			} else {
				$res =  updateData(DRAFT, $final_data, array('draft_id' =>$d_id ));
			}
			
			$log_data = array(
				'draft_log_creater' => emp_session_id(),
				'draft_log_sendto' => emp_session_id(),
				'draft_log_create_date' => date('Y-m-d H:i:s'),
				'draft_log_draft_id' => $d_id,
                'draft_log_file_id' => $this->input->post('file_id'),
                'draft_log_section_id' => $section_id1,
				'draft_content' =>  escape_str($draft_content_text),
                'draft_log_sublogin_creater' => $this->session->userdata("emp_id"),
                'draft_markto_otherdept' => $mark_to_other_dept,
			);
			if($btnadddraft == 'save_draft'){
				$data_log_draft = array(
					'draft_final' => 0, // finished  at user level and send to upper level
				);
			} else{
				$data_log_draft= array(
					'draft_final' => 0, // working at user level for multiple editing
				);
			}
			$final_log_data = array_merge($log_data, $data_log_draft);
			//pr($log_data);
			if($d_log_id == null){
				$res = insertData($final_log_data, DRAFT_LOG);
			} else {
                $verify_logid_sinature = verify_logid_sinature($d_log_id) ; // check draft logid is in ft_digital_signature
                if($verify_logid_sinature != ''){
                    updateData(DRAFT_LOG, array('draft_log_dispaly_status' => '1' ), array('draft_log_id' => $d_log_id ));
                    $res = insertData($final_log_data, DRAFT_LOG);
                }else{
                    $res =  updateData(DRAFT_LOG, $final_log_data, array('draft_log_id' => $d_log_id ));
                }
			}
if($mark_to_other_dept != null && $mark_to_other_dept != '' && $mark_to_other_dept_select != null && $mark_to_other_dept_select != ''){
                    updateData(FILES, array('ps_mark_file' => $mark_to_other_dept_select ), array('file_id' => $this->input->post('file_id') ));
                }
			update_filedata($this->input->post('file_id'), $d_id);
			if($is_ajax_return){				
				echo 'saved';
				exit;			
			}else{
			
			if($is_ajax_autoadd){
				echo 'saved';
				exit;
			}else{
				$this->session->set_flashdata('message', $this->lang->line('msg_doc_added'));
				redirect('efile/'.$this->input->post('file_id'));
				}
			}
		}	
		$data['file_data'] =  getFileDetails($this->input->post('file_id') , true);
		$data['title']    =   $this->lang->line('draft_create');
		$data['sub_title']    =  $this->lang->line('draft_sub_create');
		$data['module_name']    = "draft";
        $data['view_file']      = "draft_create";
        $this->template->index($data);
	}
	
	function save_edit_draft($id = ''){
		$this->form_validation->set_rules('sender_id','sender_id', 'trim|required|xss_clean');
		$this->form_validation->set_rules('draft_subject','draft_subject', 'trim|required|xss_clean');
		$this->form_validation->set_rules('draft_type','draft_type', 'trim|required|xss_clean');
		$this->form_validation->set_rules('draft_content_text','draft_content_text', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        if($this->form_validation->run($this) === TRUE) {
			$btnadddraft = $this->input->post('btnadddraft');
			$data = array(
				//'draft_file_id' => $this->input->post('file_id'),
				'draft_parent_id' => 0,
				'draft_subject' => $this->input->post('draft_subject'),
				'draft_content_text' => escape_str($this->input->post('draft_content_text')),
				'draft_type' => $this->input->post('draft_type'),
				'draft_version' => $this->input->post('draft_version'),
				'draft_sender_id' => emp_session_id(),
				'draft_reciever_id' => $this->input->post('sender_id'),				
				'draft_is_finalize' => 0,  //0 for draft working in process
			);
			
			if($btnadddraft == 'send_draft'){
				$data_draft = array(
					'draft_status' => 3, // finished  at user level and send to upper level
				);
			} else{
				$data_draft= array(
					'draft_status' => 2, // working at user level for multiple editing
				);
			}
			$final_data = array_merge($data, $data_draft);
			
			$res = updateData(DRAFT, $final_data, array('draft_id' => $id));
			$log_data = array(
				'draft_log_creater' => emp_session_id(),
				'draft_log_create_date' => date('Y-m-d H:i:s'),
				'draft_log_draft_id' => $id,
				'draft_log_sendto' => $this->input->post('sender_id'),
				'draft_final' => 0,  // draft final or not
				'draft_content' => escape_str($this->input->post('draft_content_text')),
                'draft_log_sublogin_creater' => $this->session->userdata("emp_id"),
			);
			//pr($log_data);
			$res = insertData($log_data, DRAFT_LOG);
			
			if($res){
				$this->session->set_flashdata('message',$this->lang->line('msg_draft_added'));
				redirect('draft/draft');
			}
		}
		$data['add_draft']    = true;
		$data['search_file']  = true;
		$data['file_data'] =  getFileDetails($this->input->post('file_id') , true);
		$data['title']    =   $this->lang->line('draft_create');
		$data['sub_title']    =  $this->lang->line('draft_sub_create');
		$data['module_name']    = "draft";
        $data['view_file']      = "compose_draft";
        $this->template->index($data);
	}
	
	function draft_viewer($id, $full_view = 1){
		$data['title']    =   $this->lang->line('lbl_draft_view');
		$data['sub_title']    =  $this->lang->line('lbl_draft_view');
		$data['draft_data']  = $this->draft_model->get_single_draft($id);
		//$data['draft_data_log']  = $this->draft_model->get_related_draft($id);
		///$data['draft_emp']  = $this->draft_model->get_draft_employees($id);
		
		$data['module_name']    = "draft";
		if($full_view == 1){
			$data['view_file']      = "full_viewer";
		} else{
			$data['view_file']      = "view_draft";
		}
       
        $this->template->index($data);
	}

	function file_draft_full_viewer($id, $full_view = 1){
		$data['title']    =   $this->lang->line('lbl_draft_view');
		$data['sub_title']    =  $this->lang->line('lbl_draft_view');
		$data['draft_data']  = $this->draft_model->get_single_draft($id);
		//$data['draft_data_log']  = $this->draft_model->get_related_draft($id);
		//$data['draft_emp']  = $this->draft_model->get_draft_employees($id);
		$data['module_name']    = "draft";
		if($full_view == 1){
			$data['view_file']      = "full_viewer";
		} else{
			$data['view_file']      = "view_draft";
		}
       
        $this->template->index($data);
	}
	function draft_edit($id){
		$data['title']    =   $this->lang->line('lbl_draft_edit');
		$data['sub_title']    =  $this->lang->line('lbl_draft_edit');
		$data['draft_data']  = $this->draft_model->get_single_draft($id);
		//$data['draft_emp']  = $this->draft_model->get_draft_employees($id);
		$data['module_name']    = "draft";
        $data['view_file']      = "draft_editor";
        $this->template->index($data);
	}

	function reopen_draft($id){
		$data['title']    =   $this->lang->line('lbl_draft_reopen');
		$data['sub_title']    =  $this->lang->line('lbl_draft_reopen');
		$data['draft_data']  = $this->draft_model->get_single_draft($id);
		//$data['draft_emp']  = $this->draft_model->get_draft_employees($id);
		$data['module_name']    = "draft";
        $data['view_file']      = "draft_editor";
        $data['reopen']      = true;
        $this->template->index($data);
	}
	
	function complete_draft($id = ''){
		$draft_data  = $this->draft_model->get_single_draft($id);
		$file_data = getFileDetails($draft_data['draft_file_id'] , true);
		if($draft_data['draft_type'] == 'n'){
			$contents = '<p style="padding-left:15%;"><b>'.$draft_data['draft_subject'].'</b></p>'; 	
		} else{
			$contents = '';
		}
		$contents .= $this->input->post('contents') != '' ? $this->input->post('contents') : $draft_data['draft_content_text'] ; 	
		$draft_emp  = $this->draft_model->get_draft_employees($id);
		foreach($draft_emp as $emp_id){
			$contents .= '<br/>';
			$contents .= '<p><b><u>'.get_employee_role($emp_id->draft_log_creater).'</u></b></p>';
		}
		$html = stripslashes($contents);
		
		$filename = 'Complete_draft_'.uniqid();
		// As PDF creation takes a bit of memory, we're saving the created file in /downloads/reports/
		$pdfAbspath = "uploads/scan/".date('Y')."/".$file_data[0]['file_mark_section_id']."/$filename.pdf";	
		$pdfFilePath = FCPATH.$pdfAbspath;	
		$data = array(
			'draft_version' => (int)$draft_data['draft_file_id'] + 1,
			'draft_is_finalize' => 1,  //1 for draft completed
			'draft_status' => 3,  //3 for draft completed
			'draft_complete_path' => $pdfAbspath,  //3 for draft completed
		);
		$res = updateData(DRAFT, $data, array('draft_id' => $id));
		$res = updateData(FILES, array('final_draft_id' => $id), array('file_id' => $draft_data['draft_file_id']));
		
		if (file_exists($pdfFilePath) == FALSE)
		{
			require_once(APPPATH.'/third_party/tcpdf/tcpdf.php');
			ini_set('memory_limit','32M'); // boost the memory limit if it's low <img class="emoji" draggable="false" alt="😉" src="https://s.w.org/images/core/emoji/72x72/1f609.png">
			$this->load->library('pdf');
			
			ob_clean();
			
			// create new PDF document
			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
			$fontname = TCPDF_FONTS::addTTFfont(APPPATH.'/third_party/tcpdf/fonts/mangal.ttf', 'TrueTypeUnicode', '', 32);

			// set document information
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor('विधि और विधायी कार्य विभाग , भोपाल');
			$pdf->SetTitle('विधि और विधायी कार्य विभाग , भोपाल');
			$pdf->SetSubject('विधि और विधायी कार्य विभाग , भोपाल');
			$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

			// remove default header/footer
			$pdf->setPrintHeader(false);
			$pdf->setPrintFooter(false);

			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

			// set margins
			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

			// set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

			// set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

			// set default font subsetting mode
			$pdf->setFontSubsetting(true);

			// set font
			$pdf->SetFont($fontname, '', 12, '', 'false');

			// add a page
			$pdf->AddPage();			

			// set color for text
			$pdf->SetTextColor(0, 63, 127);

			// write the text
			$pdf->writeHTML($html, true, false, true, false, '');

			//Close and output PDF document
			$pdf->Output($pdfFilePath, 'F');
		
			redirect('draft/draft/view_file/'.$id.'/'.$draft_data['draft_file_id']);
			//redirect($pdfFilePath);
		} else {
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	
	function draft_compare($log_id, $draft_id){
		$data['title']    =  "ड्राफ्ट  कॉम्पयर करे";
		$data['sub_title']    =  "ड्राफ्ट कॉम्पयर करे";
		$data['draft_data_log']  = $this->draft_model->get_compare_record($log_id, $draft_id);
		//$data['draft_data']  = $this->draft_model->get_single_draft($d_id);
		$data['module_name']    = "draft";
        $data['view_file']      = "draft_compare";
        $this->template->index($data);
	}

	
	function view_file($draft_id, $file_id){
		$data['title']    = $this->lang->line('lbl_efile_view');
		$data['sub_title']    = $this->lang->line('lbl_efile_view');
		$data['draft_data']  = $this->draft_model->get_single_draft($draft_id);
		$data['file_data']    = getFileDetails($file_id , true);
		$data['draft_emp']  = $this->draft_model->get_draft_employees($draft_id);
		$data['module_name']    = "draft";
        $data['view_file']      = "view_draft_file";
        $this->template->index($data);
	}
	
	function efile_view($file_id){
        $this->load->model('e_filelist/efile_list_model','efile_model');
		$data['title']    = $this->lang->line('lbl_efile_view');
		$data['sub_title']    = $this->lang->line('lbl_efile_view');
	//$file_data1    = getFiledata($file_id);
		$file_data    = getFileDetails($file_id ,true);
		$data['file_data']    = $file_data[0];
		$data['module_name']    = "draft";
		/*Load Other Moduel*/
        $data['title_tab'] = $this->lang->line('e_file_title_tab');
        $data['view_file']      = "view_efile";
		$notesheet_id=null;
		$data['notesheet_id'] = $notesheet_id;
		$data['section_id']=getEmployeeSection();
	    $data['get_files'] = $this->efile_model->getesingleFiles($section_id=null,$file_id);
		/*End load model*/
        $this->template->index($data);
	}

	function delete_draft($id, $file_id){
		//pr($id);
		$res = updateData(DRAFT,array('draft_status' => '4') , array('draft_id' => $id));
		$res = updateData(DRAFT_LOG,array('draft_log_dispaly_status' => '1'), array('draft_log_draft_id' => $id));
		if($res){
			$file_data =  getFileDetails($file_id , true);
			$filesin_draft = explode(',',$file_data[0]['final_draft_id']);
			if(in_array($id, $filesin_draft)){
				foreach (array_keys($filesin_draft, $id) as $key) {
					unset($filesin_draft[$key]);
				}
				$ids = implode(',',$filesin_draft);
			} else{
				$ids = $file_data[0]['final_draft_id'];
			}
			$res = updateData(FILES, array('final_draft_id' => $ids), array('file_id' => $file_id));

			$this->session->set_flashdata('error', 'डिलीट कर दीया गया');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	function delete_draft_log($id, $file_id){
        $data_draft = get_list(DRAFT_LOG, null, array('draft_log_id' => $id));
        $d_id = $data_draft[0]['draft_log_draft_id'];
        $res = updateData(DRAFT_LOG,array('draft_log_dispaly_status' => '1') ,array('draft_log_id' => $id));
        $res = updateData(DRAFT,array('draft_status' => '4') ,array('draft_id' => $d_id)); // 4 for type of delete
        if($res){
            $file_data =  getFileDetails($file_id ,true);
            $filesin_draft = explode(',',$file_data[0]['final_draft_id']);
            if(in_array($d_id, $filesin_draft)){
                foreach (array_keys($filesin_draft, $d_id) as $key) {
                    unset($filesin_draft[$key]);
                }
                $ids = implode(',',$filesin_draft);
            } else{
                $ids = $file_data[0]['final_draft_id'];
            }
            $res = updateData(FILES, array('final_draft_id' => $ids), array('file_id' => $file_id));

            $this->session->set_flashdata('error', 'डिलीट कर दीया गया');
            redirect($_SERVER['HTTP_REFERER']);
        }
	}
	
	function ajax_get_log_data($log_id = null){
		$result = get_draft_log($log_id);		
		echo json_encode($result);		
        exit();
	}
	
	function get_final_content_with_html_old(){
		
		$file_id=$this->input->post('fileid');
		$empid = $this->input->post('empid');
		$sender_name = $this->input->post('sender_name');
		$sign_emp_name = getemployeeName($empid, $ishindi = true);
		$user_role = $this->session->userdata('user_role');
		$sign_emp_name_section_name = getemployeeRole($user_role);
		$draft_detail= get_final_draft($empid,$file_id);
		$title="Discription";

		//pre($this->session->all_userdata());		
		$html_view='<div role="dialog" class="modal fade in" id="teep_expandModel" style="display: block; padding-right: 17px;" aria-hidden="false">
					<div class="modal-dialog">
						<!-- Modal content-->
						<div class="modal-content">
						  <div class="modal-header">
							<button data-dismiss="modal" class="close jsmodel" type="button">x</button>							
						  </div>
						  <div class="modal-body">
							<div id="expand_data"><b>'.$draft_detail["draft_content"].'</b><br/>'.$sender_name.' <div style="float:right">'.$sign_emp_name.'('.$sign_emp_name_section_name.')</div></div>
						  </div>
						  <div class="modal-footer">
							<button data-dismiss="modal" style="float:left;" class="btn btn-default jsmodel" type="button">Close</button>
							<button  id="send_data_for_sign" class="btn btn-primary send_data_for_sign" type="button" style="float:left;">डिजिटल हस्ताक्षर जोड़े</button>							
						  </div>
						  <span id="draft_log_id" name="'.$draft_detail["draft_log_id"].'"></span>
						</div>
					</div>
				</div>
				<script>
					$(".jsmodel").click(function(){
						$(".sign_data_content").html("");
						$(".get_sign_data").prop( "checked", false );
					});
					$(document).ready(function(){
						$(".send_data_for_sign").click(function () {
							
							var final_data_content="";
							final_data_content= $("#expand_data").text();
							var fid = $("#modal-id2").val();
							var draftlogid = $("#draft_log_id").attr("name");				
							var eid = "'.emp_session_id().'";
							var location_url = "http://10.115.254.213:8080/data_signing/signDataJNLP?draft_id="+draftlogid+"&file_id="+eid+"&emp_name=bijendra&data="+final_data_content; 
							location.href= location_url;	
							
						});
					});
				</script>';
		echo $html_view;		
        exit();		
	}	

	function get_final_content_with_html(){
		$file_id=$this->input->post('fileid');
		$empid = $this->input->post('empid');
		$sender_name = $this->input->post('sender_name');
		$sign_emp_name = getemployeeName($empid, $ishindi = true);
		$user_role = $this->session->userdata('user_role');
		$sign_emp_name_section_name = getemployeeRole($user_role);
		$draft_detail= get_final_draft($empid,$file_id);
		$title="Discription";
		//pre($this->session->all_userdata());
		$html_view='<div class="modal-body" style="background-color:#D8D5D5">
							<div><b id="expand_data">'.$draft_detail["draft_content"].'</b><br/>'.$sender_name.' <div style="float:right">'.$sign_emp_name.'('.$sign_emp_name_section_name.')</div></div>
						  </div>
						  <span id="draft_log_id" name="'.$draft_detail["draft_log_id"].'"></span>
						  <input type="hidden" name="text_base64decode" id="text_base64decode" value="'.md5($draft_detail["draft_content"]).'">
					</div>
				<script>
					$(".jsmodel").click(function(){
						$(".sign_data_content").html("");
						$(".get_sign_data").prop( "checked", false );
					});
				</script>';
		echo $html_view;
        exit();
	}
	function add_signature_data(){
		$this->load->helper('signature');			
		$content_data=$this->input->post('final_data_content');
		echo $return = sign_data(null,null,$content_data);		
	}


	function update_final_content_with_html(){
		$final_content=$this->input->post('final_content');
		$file_id=$this->input->post('fid');
		$draftlogid=$this->input->post('draftlogid');
		$loginEmpid=$this->input->post('eid');
		return $this->draft_model->update_draft($final_content,$file_id,$draftlogid,$loginEmpid);
	}
	
	function auto_add_multiple_draft($file_id  ,$draft_subject = null, $d_id = null,$draft_content_text = null, $btnadddraft = null){
		
		 $d_log_id = $this->input->post('log_id') ? $this->input->post('log_id') : null;
		{
				
			
			$data = array(
				'draft_file_id' => $file_id ,			
				'draft_sender_id' => emp_session_id(),
				'draft_reciever_id' => emp_session_id(),
				'draft_subject' => $draft_subject ,
				'draft_content_text' => escape_str($draft_content_text),
				'draft_type' => 'n',
				'draft_is_finalize' => 0,  //0 for draft working in process
				'draft_create_date' => date('Y-m-d H:i:s'),
			);
			//pr($data );
			if($btnadddraft == 'save_draft'){
				$data_draft = array(
					'draft_status' => 3, // finished  at user level and send to upper level
				);
			} else{
				$data_draft= array(
					'draft_status' => 2, // working at user level for multiple editing
				);
			}
			$final_data = array_merge($data, $data_draft);
			//pr($final_data);
			if($d_id == null){
				$data_draft_creater = array(
					'draft_creater_emp_id' => emp_session_id(),
				);
				$full_final_data = array_merge($data_draft_creater, $final_data);
				$d_id = insertData_with_lastid($full_final_data, DRAFT);
			} else {				
				$res =  updateData(DRAFT, $final_data, array('draft_id' =>$d_id ));
			}
			
			$log_data = array(
				'draft_log_creater' => emp_session_id(),
				'draft_log_sendto' => emp_session_id(),
				'draft_log_create_date' => date('Y-m-d H:i:s'),
				'draft_log_draft_id' => $d_id,
				'draft_content' => escape_str($this->input->post('draft_content_text')),
                'draft_log_sublogin_creater' => $this->session->userdata("emp_id"),
			);
			if($btnadddraft == 'save_draft'){
				$data_log_draft = array(
					'draft_final' => 0, // finished  at user level and send to upper level
				);
			} else{
				$data_log_draft= array(
					'draft_final' => 0, // working at user level for multiple editing
				);
			}
			$final_log_data = array_merge($log_data, $data_log_draft);
			//pr($log_data);
			$final_log_data = array_merge($log_data, $data_log_draft);
			//pr($log_data);
			if($d_log_id == null){
				return $res = insertData($final_log_data, DRAFT_LOG);
			} else {
                $verify_logid_sinature = verify_logid_sinature($d_log_id) ; // check draft logid is in ft_digital_signature
                if($verify_logid_sinature != ''){
                   return  updateData(DRAFT_LOG, array('draft_log_dispaly_status' => '1' ), array('draft_log_id' => $d_log_id ));
                    $res = insertData($final_log_data, DRAFT_LOG);
                }else{
                   return $res =  updateData(DRAFT_LOG, $final_log_data, array('draft_log_id' => $d_log_id ));
                }
			}

			update_filedata($this->input->post('file_id'), $d_id);


		}	
		
	}

    function draft_log_hide($log_id, $create_id){
      //  $data_draft = get_list(DRAFT_LOG, null, array('draft_log_id' => $id));
        if($log_id != 'null' && $create_id != 'null') {
            $res = updateData(DRAFT_LOG, array('draft_log_dispaly_status' => '1'), array('draft_log_id' => $log_id, 'draft_log_creater' => $create_id));
            if ($res) {
                $this->session->set_flashdata('error', 'टीप को डिलीट कर दीया गया है |');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }	
	function test_update_draft($draft_ids){
			$draft_ids = explode('d',$draft_ids);
			if(count($draft_ids)==0 || $draft_ids==null || $draft_ids==''){
				echo 'No draft d value';
				exit;
			}			
			//$draft_ids= array(1857,295);
			$draft_list = get_list_with_in("ft_file_draft",null,'draft_id',$draft_ids);						
			foreach($draft_list as $ky=>$val){
				$file_detail = get_row("SELECT file_received_emp_id,file_sender_emp_id,file_update_date FROM `ft_files` where file_id=".$val['draft_file_id']);
				
				$file_detail_detail = get_row("SELECT draft_creater_emp_id,draft_file_id FROM `ft_file_draft` where draft_id=".$val['draft_id']);
				pre($file_detail);	
				pre($file_detail_detail);
				$log_data = array(
				'draft_log_creater' => 22,
				'draft_log_sendto' => $file_detail['file_received_emp_id'],
				'draft_log_create_date' => $file_detail['file_update_date'],
				'draft_log_draft_id' => $val['draft_id'],
				'draft_content' => '<p>Seen</p>',
                'draft_log_sublogin_creater' => $file_detail['file_sender_emp_id'],
				);		
				insertData($log_data,DRAFT_LOG);
				$data_data = array(
					'draft_content_text' => '<p>Seen</p>',
					'draft_sender_id'=>22,
					'draft_reciever_id'=>$file_detail_detail['draft_creater_emp_id'],
					'draft_update_date'=>$file_detail['file_update_date'],					
				);				
				updateData(DRAFT, $data_data, array('draft_id' =>$val['draft_id']));
			}
	}	
	
	function voic_input(){		
		$data['title']    =  'Voice Input';
		$data['small_title']    =  "Voice";
		$data['sub_title']    =  'Voice Input';		
		$data['module_name']    = "draft";
        $data['view_file']      = "voice_input_draft";
        $this->template->index($data);		
	}
	
		//for upload file in any level
	function upload_document(){
		$file_id = $this->input->post('scan_files_id');
		$file_data  = getFileDetails($file_id);
	
		if (isset($_FILES['scapdffile']) && $_FILES['scapdffile']['error'] == 0) {

			$form_scan_data = array(
				'scan_type' => 'front',
				'scan_file_type' => 5,
			    'scan_subfile_types' => $this->input->post('scan_subfile_types'),
			    'scan_section_id' => $file_data->file_mark_section_id,
				'scan_meta_key' => $this->input->post('save_meta'),
				'scan_subject' => $file_data->file_subject,
				'scan_creator_id' => emp_session_id(),
				'scan_file_from_type' => $file_data->file_Offer_by,
				'scan_file_from_place' => null,
				'scan_created_date' => date('Y-m-d H:i:s'),
				'scan_update_date' => date('Y-m-d H:i:s'),
			);

			$file_title =  pathinfo($_FILES['scapdffile']['name'], PATHINFO_FILENAME);
			$file_extn =  pathinfo($_FILES['scapdffile']['name'], PATHINFO_EXTENSION );
			//pr($file_extn);
			if($file_extn != 'pdf'){
				$this->session->set_flashdata('error', 'कृपया PDF फाइल को ही जोड़े|');
				redirect($_SERVER['HTTP_REFERER']); 
			}
			$upload_path = 'uploads/scan/'.$file_data->file_mark_section_id . '/'.date('Y');
			$file_upload_new =  str_replace(' ', '_', $file_title).'_'.md5(microtime().rand()).'.'.$file_extn;
			 
			if(!is_dir($upload_path)) //create the folder if it's not already exists
			{
				mkdir($upload_path,0777,TRUE);
			}
			
			$final_path = $upload_path . '/' . $file_upload_new;
			$target_file = FCPATH .$upload_path.'/'.$file_upload_new;
			
			$form_scan_data1 = array(
				'scan_file_path' => $final_path,
			);

			$final_scan_data = array_merge($form_scan_data, $form_scan_data1);

			//pr($target_file);
			if (isset($file_upload_new) && $file_upload_new != '') {
				$config['upload_path'] = $upload_path;
				$config['allowed_types'] = '*';
				$config['max_size'] = '10240';
				//$config['max_width'] = '1024';
				//$config['max_height'] = '768';
				$config['overwrite'] = TRUE;
				$config['encrypt_name'] = TRUE;
				$config['remove_spaces'] = TRUE;
				$config['file_name'] = $file_upload_new;
				if (!is_dir($upload_path)) {
					die("THE UPLOAD DIRECTORY DOES NOT EXIST");
				}
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('scapdffile')) {
					$error = array('error' => $this->upload->display_errors());
				} else {
					$upload_data = $this->upload->data();
					//$upload_name =  $upload_data['raw_name'].'_'.uniqid().$upload_data['file_ext'];
					$upload_name =  $upload_data['file_name'];
				}
			
				//move_uploaded_file($_FILES["scapdffile"]["tmp_name"], $target_file);
				$last_scan_id = insertData_with_lastid($final_scan_data, FILE_SCAN);
				$scan_upload_data = $last_scan_id.','.$this->input->post('scan_files_id');
								
				$scan_explod = explode(',',$scan_upload_data);				
			    $file_scan_ids = unserialize($file_data->scan_id);
				if(!empty($file_scan_ids)){
					$final_scan_data = array_merge($file_scan_ids,$scan_explod);
					$final_searil_data = serialize($final_scan_data);	
				}else{
					$final_searil_data = serialize($scan_explod);	
				}
						
				$res = updateData(FILES, array('scan_id' => $final_searil_data), array('file_id' => $this->input->post('scan_files_id') ));
								
				if ($res) {
					$this->session->set_flashdata('message', 'दस्तावेज़ जोड़ दिया गया|');
					redirect($_SERVER['HTTP_REFERER']);
				}
			}
		} // close file isset
	} // closed method
}