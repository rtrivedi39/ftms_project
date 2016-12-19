<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Notesheet_generate extends MX_Controller {
    function __construct() {
        parent::__construct();
        $this->load->module('template');
        $this->load->model('admin_notesheet_master_model','notesheet_master_model');
        $this->load->language('admin_notesheet_master', 'hindi');
    }

    public function index()
    {
        $data = array();
        $data['title'] = $this->lang->line('notesheet_title_label');
        $data['title_tab'] = $this->lang->line('notesheet_title_tab');
        $data['notesheet_list'] = get_list(NOTESHEET_MASTER,'notesheet_id',null);
        //pre($data['get_section']);
        $data['module_name'] = "admin_notesheet_master";
        $data['view_file'] = "admin_notesheet_master/index";
        $this->template->index($data);
    }

    function generate_notesheet($notesheet_id = null, $section_id = null, $file_id = null) {
        //pr($this->input->post());
        if($notesheet_id != null && $section_id != null && $file_id != null){

            $data['title'] = 'E-file';
			$data['file_details']  = getFiledata($file_id);
            $data['notesheet_details']  = $this->notesheet_master_model->get_notesheet_details($notesheet_id);
            $data['is_genrate'] = true;
            $data['file_sts'] = $this->input->post('file_sts') != '' ?  $this->input->post('file_sts') : '' ;
            $data['post_data'] = $this->input->post();
			$data['module_name'] = "admin_notesheet_master";
			$data['view_file'] = "admin_notesheet_master/common_structure";
			$this->template->index($data);
           // $this->load->view('common_structure', $data);
		   } else {
            $this->show_404();
        }
    }
    
    
    public function manage_generate_notesheet($notesheet_id = null, $section_id = null, $file_id = null) {
        if($notesheet_id != null && $section_id != null && $file_id != null){
            $this->generate_notesheet($notesheet_id, $section_id, $file_id);
        } else {
            $this->show_404();
        }
    }

    public function save_notesheet($notesheet_id = null, $section_id = null, $file_id = null){
		$content = $this->input->post('content1');
		$req_type = $this->input->post('req_type') != null ? $this->input->post('req_type') : null;
		$html = base64_decode($content);		
		$notesheet_id = isset($notesheet_id)?$notesheet_id:$this->input->post('notesheet_id');
		$section_id = isset($section_id)?$section_id:$this->input->post('section_id');
		$file_id = isset($file_id)?$file_id:$this->input->post('file_id');
		$head_id = $this->input->post('head_id');
	
        $today = date('d_m_Y');
        if($notesheet_id != null && $section_id != null && $file_id != null){
			$file_data = getFiledata($file_id);
			//pr($file_data );
            $section_name = getSection($section_id, true);
           //$contents = $this->input->post('contents');
			if($this->input->get('type')){
			$d_type = $this->input->get('type') != '' ? $this->input->get('type') : 'o';
			}else{
				$d_type = $this->input->post('d_type') != '' ? $this->input->post('d_type') : 'o';
			}
            //$html = $this->encrypt->decode($contents);
			$notesheet_details = $this->notesheet_master_model->get_notesheet_details($notesheet_id);
		    $filename = 'file_'.$file_id.'_notesheet_'.$notesheet_id;
            $data_log = array(
                'file_id'       => $file_id,
                'file_head_id'  => $this->input->post('file_head'),
                'section_id'    => $section_id,
                'to_emp_id'     => emp_session_id(),
                'from_emp_id'   => emp_session_id(),
                'flog_remark' => "",
                'flog_other_remark' => 'दस्तावेज  '.$notesheet_details[0]->notesheet_title.' संलग्न किये गए',
                'flog_ip_address'   => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
                'flog_browser_id'   => $_SERVER['HTTP_USER_AGENT'],
                'notesheet_file_path'     => $filename,
                'notesheet_id' =>  $notesheet_id,
                'notesheet_contents' => htmlentities($html),
            );
            // pr($d_type);

            if($this->input->post('isupdate') == 'yes'){
                $response = updateData(FILES_LOG, $data_log, array('notesheet_file_path' => $filename));
            } else {
                $response = insertData($data_log, FILES_LOG);
            }
            if($response){
                // $this->complete_draft($contents, true);

                $data = array(
                    'draft_file_id' => $file_id,
                    'draft_sender_id' => $this->session->userdata("emp_id"),
                    'draft_reciever_id' => $this->session->userdata("emp_id"),
                    'draft_subject' => $file_data[0]['file_subject'],
                    'draft_content_text' => escape_str($html),
                    'draft_type' => $d_type,
                    'draft_is_finalize' => 0,  //0 for draft working in process
                    'draft_create_date' => date('Y-m-d H:i:s'),
                    'draft_status' => 3,
                    'notesheet_id' =>  $notesheet_id,
                    'draft_creater_emp_id' => $this->session->userdata("emp_id"),
					'order_generat_officer_id' => $this->input->post('officer_id')
                );

                if($this->input->post('file_sts') == 'p' ){
					$this->session->set_flashdata('message', 'Note sheet generate successfully!');
                	//redirect("view_file/viewdetails/".$file_id);
                	redirect("attached/file_doc/1");
                } else {

					if($notesheet_id == 51 ||$notesheet_id == 21||$notesheet_id == 172 ||$notesheet_id == 176 ||$notesheet_id == 180){
						$d_id = insertData_with_lastid($data, DRAFT);
					}else{
                        if($d_type == 'n'){
                            $query = $this->db->get_where(DRAFT, array('draft_file_id' => $file_id, 'draft_type' => 'n'), '1');
                        }else{
                            $query = $this->db->get_where(DRAFT, array('draft_file_id' => $file_id, 'notesheet_id' => $notesheet_id), '1');
                        }$draft_data = $query->row_array();
						if($query->num_rows() > 0){
							$upt_data = array(
								'draft_content_text' =>  escape_str($html),
								'order_generat_officer_id' => $this->input->post('officer_id')
								);
                        if($draft_data['draft_status'] == 4){
                            $upt_data['notesheet_id'] = $notesheet_id;
                            $upt_data['draft_status'] = 3;
                            $upt_data['draft_sender_id'] = $this->session->userdata("emp_id");
                            $upt_data['draft_reciever_id'] = $this->session->userdata("emp_id");
                        }

							$res =  updateData(DRAFT, $upt_data, array('draft_id' => $draft_data['draft_id'] ));
							$d_id = $draft_data['draft_id'];
						} else {
							$d_id = insertData_with_lastid($data, DRAFT);
						}

					}
					$log_data = array(
						'draft_log_creater' => $this->session->userdata("emp_id"),
						'draft_log_sendto' => $this->session->userdata("emp_id"),
						'draft_log_create_date' => date('Y-m-d H:i:s'),
						'draft_log_draft_id' => $d_id,
						'draft_log_file_id' => $file_id,
						'draft_log_section_id' => $file_data[0]['file_mark_section_id'] ? $file_data[0]['file_mark_section_id'] : false ,
						'draft_content' => escape_str($html),
						'draft_final' => 0,
					);

					$res = insertData($log_data, DRAFT_LOG);

					update_filedata($file_id, $d_id);
					
					if($this->input->post('pay_id')){
					$this->notesheet_master_model->update_pay_details($this->input->post('pay_id') );
					}
					
					if($req_type == 'yes_ajax'){
						echo 'saved'; exit;
					}else{
						$this->session->set_flashdata('message', 'दस्तावेज दर्ज किया गया');

						redirect('efile/'.$file_id);					
					}
                }
            }
        } else {
            $this->show_404();
        }
    }
            
    function alpha_dash_space($str) 
    {
        if(!preg_match("/^([-a-z_ ])+$/i", $str)){
            $this->form_validation->set_message('alpha_dash_space',$this->lang->line('text_allow_with_space_error'));
            return false; 
        }
    }
    
	public function again_save_notesheet(){
		$content = $this->input->post('content1');
		$content = base64_decode($content);
		$content = htmlentities($content);
		$file_log_id = $this->input->post('file_log_id');
		if(isset($file_log_id) && !empty($file_log_id )){
		$file_log_details =  get_file_log_data($file_log_id );
		
		$notesheet_id  = $file_log_details['notesheet_id']; 
		$section_id  = $file_log_details['section_id'];
		$file_id   =  $file_log_details['file_id'];
		$file_head_id = $file_log_details['file_head_id'];

		
		$today = date('d_m_Y');
        if($notesheet_id != null && $section_id != null && $file_id != null)
		{
			$file_data = getFiledata($file_id);
			//pr($file_data );
            $section_name = getSection($section_id, true);
           // $contents = $this->input->post('contents');
            $d_type = $this->input->get('type') != '' ? $this->input->get('type') : 'o';
           // $html = $this->encrypt->decode($contents);
			$notesheet_details = $this->notesheet_master_model->get_notesheet_details($notesheet_id);
		    $filename = 'file_'.$file_id.'_notesheet_'.$notesheet_id;
            $data_log = array(
                'file_id'       => $file_id,
                'file_head_id'  => isset($file_head_id)?$file_head_id:'',
                'section_id'    => $section_id,
                'to_emp_id'     => emp_session_id(),
                'from_emp_id'   => emp_session_id(),
                'flog_remark' => "",
                'flog_other_remark' => 'दस्तावेज  '.$notesheet_details[0]->notesheet_title.' संलग्न किये गए',
                'flog_ip_address'   => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
                'flog_browser_id'   => $_SERVER['HTTP_USER_AGENT'],
                'notesheet_file_path'     => $filename,
                'notesheet_id' =>  $notesheet_id,
                'notesheet_contents' => $content,
            );
           
            
            $response = insertData($data_log, FILES_LOG);
			
			echo "success"; 
		}

    }
    
    }
    public function show_404() {
        $this->load->view('404');
    }
}