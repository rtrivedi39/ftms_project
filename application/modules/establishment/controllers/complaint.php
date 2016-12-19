<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Complaint extends MX_Controller {
     function __construct() {
        parent::__construct();
        $this->load->module('template');
        $this->load->model('complaint_model');
		$this->load->model('est_model');
		$this->load->model('view_file_model','view_file');
        $this->load->helper('establishment');
        $this->load->language('est_complaint','hindi');
		$this->load->library('pagination');
    }
 	public function index()
    {
        $data = array();
		$type = 'p';
        $data['title'] = $this->lang->line('complaint_title');
        $data['title_tab'] = $this->lang->line('complaint_sub_title');
		if ($this->input->get('type')) {
            $type = $this->input->get('type');
		}		
		//$data['get_complaint_list']= $this->complaint_model->get_complaints($type);
		
		/*Pagination*/			
			$config["is_question_mark"] = TRUE;		
			if(!empty($type)){
				$config["base_url"] = base_url()."establishment/complaints?type=".$type;
			}
			else{
				$config["base_url"] = base_url()."establishment/complaints?";
			}			
			
			
			$total_count = $this->complaint_model->count_get_complaints($type,'');							
			$data['total_files']=$total_count['totalfiles'];
			// Set total rows in the result set you are creating pagination for.
			$config['total_rows'] = $data['total_files'];
			$data['perpage']=PER_PAGE_VALUE;;
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
			
			
			$this->pagination->initialize($config);
			if(isset($_GET['per_page']) && $_GET['per_page']!=''){
				$page = $_GET['per_page'];
			}else{
				$page=0;
			}
			$data['get_complaint_list']= $this->complaint_model->get_complaints($type,'',$config['per_page'],$page);
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links);			
			/*Pagination*/	
        $data['module_name'] = "establishment";
        $data['view_file'] = "complaints";
        $this->template->index($data);
    }
	
	public function add_complaint($update_id = '')
    {
		$this->form_validation->set_rules('complaint_type','complaint_type' , 'trim|required');
		$this->form_validation->set_rules('complaint_subtype','complaint_subtype' , 'trim|required');
		$this->form_validation->set_rules('complaint_subject','complaint_subject' , 'trim|required');
		$this->form_validation->set_rules('complaint_containts','complaint_containts' , 'trim|required');
		
		//$this->form_validation->set_rules('complaint_for_emp','complaint_for_emp' , 'trim|required');
		
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
 
		if ($this->form_validation->run($this) == TRUE)
		{
			$mark_section_id = 7; //direct mark to so establishment
            $file_last_number = $this->est_model->get_file_last_number();
			$section_file_last_number = $this->est_model->get_file_last_number_sectionwise($mark_section_id);
			
			// mark to SO establishment
            $receiver_so = get_section_employee(7,8);
            $receiver_so_emp_id = $receiver_so[0]->emp_id;
			
			//mark user who are currently work on this categoery
			$receiver_emp_id = get_category_allote_emp($this->input->post('complaint_subtype'));
			
			if($receiver_emp_id == false || $receiver_emp_id == ''){
				$receiver_emp_id = $receiver_so_emp_id;
				$multi_user_receiver_id = $receiver_so_emp_id;
			} else {
				$multi_user_receiver_id = $receiver_emp_id.','.$receiver_so_emp_id;
			}
			
            //pr($receiver_emp_id);
            $form_data = array(
                'file_mark_section_id'    => $mark_section_id,
                'file_received_emp_id'    => $receiver_emp_id,
                'file_sender_emp_id'      => $this->session->userdata("emp_id"),
                'file_mark_section_date'  => date('Y-m-d H:i:s'),
                'file_update_date'  => date('Y-m-d H:i:s'),
                'file_level_id'           => '30',   // WORK IN PROGRESS (file_movement_level_master)
                'file_unit_level'         => '57', // 50 is cr unit id
                'createfile_empid'        => $this->input->post('complaint_for_emp') != '' ?  $this->input->post('complaint_for_emp') : $this->session->userdata("emp_id"),
                'multi_user_receiver_id'  => $multi_user_receiver_id,
				'file_status'  => 'p',
            );
           //pr($form_data);          
            
            $form_data_fixed = array(
                'file_number'            => $file_last_number,
				'file_section_serial_no'   => $section_file_last_number,
                'file_type'            => 'app',
                'section_file_type' 	=> $this->input->post('complaint_subtype'),
                'file_subject'         => $this->input->post('complaint_subject'),
                'file_description'      => $this->input->post('complaint_containts'),
                'file_created_date'    => date('Y-m-d H:i:s'),
                'file_return'            => '0',
            );
            $final_form_data = array_merge($form_data, $form_data_fixed);
            //pr($final_form_data);
            if(isset($_FILES['file_upload']) && $_FILES['file_upload']['error'] == 0){
                $file_upload = uploadalltypeFile('file_upload' , './uploads/documents_file/' );
            } else {
                $file_upload = '';
            }
			$for_emp  = $this->input->post('complaint_for_emp') != '' ? ' के '.getemployeeName($this->input->post('complaint_for_emp'), true)  : ' के ';
            $file_log_data1 = array(
                'section_id'  => $mark_section_id,
                'to_emp_id'   => $receiver_emp_id,
                'from_emp_id' => $this->session->userdata("emp_id"),
                'flog_other_remark' => getemployeeName($this->session->userdata("emp_id"), true).$for_emp.'द्वारा आवेदन किया गया है |' ,
                'flog_remark' => "Subject : ".$this->input->post('complaint_subject'),
                'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
                'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
                'document_path' => $file_upload,
				'file_status_log'  => 'p',
            );
            // pr($file_log_data1);
            $empdetails = empdetails($this->session->userdata("emp_id"));
			$crno_ofsec_marksec = $mark_section_id;
            $form_data_move1 = array(
                'fmove_current_user_id'  => $receiver_emp_id,
                'fmove_previous_user_id' => $this->session->userdata("emp_id"),
                'fmove_from_unit_id'     => '57',   // Esttablisment section to
                'fmove_to_unit_id'       => '51',   // Section officer
            );
            //  pr($form_data_move1);          
		
            if($update_id){
                /* $res = updateData(FILES, $form_data, array('file_id'=>$id));
                if($res){
                    $this->session->set_flashdata('message', $this->lang->line('file_update_success_msg'));
                } */
            }else{
                if(isset($receiver_emp_id) && $receiver_emp_id != '' && $receiver_emp_id != null)
                {
                    // INSERT IN FILE AND FILE_LOG AND FILE_MOVEMENT TABLE RP
                    $res = insertData_with_lastid($final_form_data, FILES);
                    if($res) {
                        $file_id1 = array('file_id' => $res);
                        $finallog = array_merge($file_log_data1, $file_id1);
                        insertData($finallog, FILES_LOG);                        

                      /*$file_id_oth = array('f_file_id' => $res);
                        $file_other = array_merge($file_other_feilds, $file_id_oth);
                        insertData($file_other, FILES_OTHER_FEILDS);*/

                        $file_id2 = array('fmove_file_id' => $res);
                        $form_data_move = array_merge($form_data_move1, $file_id2);
                        insertData($form_data_move, FILES_MOVEMENT);

                        $this->session->set_flashdata('message', 'फाइल  सफलतापूर्वक दर्ज की गई,  जिसका  <b > &nbsp;क्रमांक :- ' . $section_file_last_number . '</b>&nbsp; हैं |');
                    }
                } else{ $this->session->set_flashdata('message', '<span class="text-bold">Marked user is not found, try after some time</span>');
                }
            }			
			redirect('establishment/complaints');
		}
    
        $data = array();
        $data['title'] = $this->lang->line('add_complaint_title');
        $data['title_tab'] = $this->lang->line('add_complaint_sub_title');      
		$data['input_data'] = $this->input->post();
        $data['module_name'] = "establishment";
        $data['view_file'] = 'complaint_create';
        $this->template->index($data);
    }
	
	public function view_complaint($id)
    {
        $data = array();
        $data['title'] = $this->lang->line('view_complaint_title');
        $data['title_tab'] = $this->lang->line('view_complaint_sub_title');      
		$data['get_complaint']= $this->complaint_model->get_single_complaints($id);
        $data['module_name'] = "establishment";
        $data['view_file'] = 'complaint_view';
        $this->template->index($data);
    }
	
	public function finish_complaint($id)
    {
        $data = array();
        $data['title'] = $this->lang->line('finish_complaint_title');
        $data['title_tab'] = $this->lang->line('finish_complaint_sub_title');      
		$data['get_complaint']= $this->complaint_model->get_single_complaints($id);
        $data['module_name'] = "establishment";
        $data['view_file'] = 'complaint_finish';
        $this->template->index($data);
    }
	
	public function complaint_finished()
    {
		$id = $this->input->post('complaint_finish');
		$compaint_data = array(
				'complaint_is_finish' => $this->input->post('complaint_finish'),		
				'complaint_finish_date' => date('Y-m-d h:i:s'),		
				'complaint_finish_emp' => $this->session->userdata('emp_id'),		
			);			
			$res = updateData(COMPLAINTS,$compaint_data, array('complaint_id' => $id));
			if($res){
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable hideauto"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>'.$this->lang->line('update_success_message').'</div>');
			}
        redirect('establishment/complaints');
    }
	
	public function print_complaint($id)
    {
        $data = array();
        $data['title'] = $this->lang->line('finish_complaint_title');
        $data['title_tab'] = $this->lang->line('finish_complaint_sub_title');      
		$data['get_complaint']= $this->complaint_model->get_single_complaints($id);     
        $this->load->view('complaint_print', $data);
    }
    
	public function ajax_get_category($id)
    {
		$res =  get_list(EST_CATEGORY_MASTER, 'master_category_id', array('parent_category_id' => $id));
        echo json_encode($res);
        exit();
    }
	
	public function show_404() {
        $this->load->view('404');
 	}
}