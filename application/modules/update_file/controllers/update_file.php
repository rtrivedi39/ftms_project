<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Update_file extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->module('template');
        $this->load->model('update_file_model');
        authorize();
    }
 
    public function index()
    {
		$data['title']              = 'Search file';
        $data['title_tab']          = 'Files';
        $data['module_name']        = "update_file";
		$data['search_list']        = null;
		$data['file_data'] =  false;
        $data['view_file']          = "update_file/file_update";
        $this->template->index($data);
    } 
	
	public function file_list()
    {	
		$data['title']              = 'Search file';
        $data['title_tab']          = 'Files';
		$data['file_data'] = null;
        $this->form_validation->set_rules('search_file_id', 'search_file_id', 'required');
		if ($this->form_validation->run($this) === TRUE){
			$search_id = $this->input->post('search_file_id');
			$file_search_data = $this->update_file_model->get_file_list($search_id);
			
			if(!empty($file_search_data)){
				$data['file_data'] = $file_search_data ;
			}else{
				 $this->session->set_flashdata('message', $search_id." यह फाइल  आई. डी. रिकॉर्ड मे मोजूद नहीं है");
			}
			$data['advocts_list'] = get_advocates_name(array('advocate_type' => 1));
		}
        $data['file_id']        = $this->input->post('search_file_id');
        $data['module_name']        = "update_file";
        $data['view_file']          = "update_file/file_update";
        $this->template->index($data);
    }

    // use for first time entry of file RP
    public function manage_file($id = null){
        $data['title']              = 'Search file';
        $data['title_tab']          = 'Files';
        $data['file_id'] = $id;
		$data['file_data'] = $this->update_file_model->get_file_list($id);
		$data['advocts_list'] = get_advocates_name(array('advocate_type' => 1));
		
        $this->form_validation->set_rules('avocate_id', 'sing_user', 'required');
        $this->form_validation->set_rules('sing_user', 'sing_user', 'required');
        $this->form_validation->set_rules('party_petition','party_petition' , 'trim|required|xss_clean');
        $this->form_validation->set_rules('Party_name_respondent', 'Party_name_respondent', 'trim|required|xss_clean');
        $this->form_validation->set_rules('judgement_data', 'judgement_data', 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		
		if ($this->form_validation->run($this) === TRUE){
			$case_party = null;
			$avocate_id = $this->input->post('avocate_id');
			$sing_user = $this->input->post('sing_user');
			//$draft_id = $this->input->post('draft_id');
			$party_petition = $this->input->post('party_petition');
			$Party_name_respondent = $this->input->post('Party_name_respondent');
			$case_party = $party_petition.'-विरुद्ध-'.$Party_name_respondent;
			$judgement_data = get_date_formate($this->input->post('judgement_data'),'Y-m-d');
			$tt = $this->input->post('files_other_feilds');
            for($i=0 ; $i < count($tt['case_no']); $i++){
                foreach ($tt as $a=>$b){
                    if($a == 'case_type'){$val12 = $b[$i]."/";}
                    if($a == 'case_no'){$val12 .= $b[$i]."/";}
                    if($a == 'case_year'){ $val12 .= $b[$i];}
                }
                $final_val[] = $val12;
            }
			
			 $file_other_feilds = array(
                'f_file_id'     => $id,
                'case_no'  => implode(',', $final_val),
            );
           
		   
            $file_data = array(
                'case_parties'          => @$case_party ,
                'file_judgment_date'    => $judgement_data,
                'section_file_categoty'    => 4,
               
			); 
			
			
            $form_log = array(
                'file_id'   => $id,
                'section_id'  => $this->input->post('file_mark_section_id'),
                'from_emp_id' => $this->session->userdata('emp_id'),
                'to_emp_id'   => $this->session->userdata('emp_id'),
                'flog_other_remark'  =>  'फाइल पर बदलाव किया गया',
                'flog_remark'  =>  serialize(array_merge($file_data,$file_other_feilds)),
                'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
                'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
				'emp_degignation_id' => $this->session->userdata('user_role')
            );

            if($id){
                $res = updateData(FILES, $file_data, array('file_id' => $id));
                if($res){
                    updateData(FILES_OTHER_FEILDS, $file_other_feilds, array('f_file_id' => $id));
                    if($this->update_file_model->check_file_exist_in_draft($id)){
						updateData(DRAFT, array('order_generat_advocate_id' => $avocate_id), array('draft_file_id' => $id, 'draft_type' => 'o' ));
                    } else{
						$draft_data = array(
							'draft_file_id' => $id,
							'draft_parent_id' => null,
							'draft_creater_emp_id' => $this->session->userdata('emp_id'),
							'draft_subject' => 'फाइल पर अधिवक्ता का नाम जोड़ा गया',
							'draft_content_text' => 'फाइल पर अधिवक्ता का नाम जोड़ा गया',
							'draft_type' => 'o',
							'draft_version' => null,
							'draft_sender_id' => $this->session->userdata('emp_id'),
							'draft_reciever_id' => $this->session->userdata('emp_id'),
							'draft_status' => 1,
							'notesheet_id' => null,
							'draft_create_date' => date('Y-m-d h:i:s'),
							'draft_is_finalize' => null,
							'draft_complete_path' => null,
							'order_generat_officer_id' => $sing_user,
							'order_generat_advocate_id' => $avocate_id,
						);
						
						insertData($draft_data, DRAFT);
					}
					insertData($form_log, FILES_LOG);
                    $this->session->set_flashdata('message', $id." सफलतापूर्वक संसोधित कि गयी| ");
                }
            }else{
				pr('Please set file id');
            }
            redirect('update_file');
        } else{
			$data['module_name']        = "update_file";
			$data['view_file']          = "update_file/file_update";
			$this->template->index($data);
        }
    }


    public function show_404() {
        $this->load->view('404');
    }


}