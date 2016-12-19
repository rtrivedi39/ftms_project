<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Manage_forms extends MX_Controller {

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
        $this->is_logged_in();
        $data['title']              = $this->lang->line('file_title');
        $data['title_tab']          = $this->lang->line('file_tab_title');
        $data['is_page_edit']       = FALSE;
        $data['abc']                = '';
        $data['module_name']        = "establishment";
        $data['view_file']          = "establishment/forms/form_1";
        $data['view_left_sidebar']  = 'admin/left_sidebar';
        $departments_list           = get_list(DEPARTMENTS, null, null);
        $data['departments_list']   = $departments_list;
        $district_list              = get_list(DISTRICT, null, null);
        $data['district_list']      = $district_list;
        $section_list               = get_list(SECTIONS, null, array('section_id !=' =>getEmployeeSection()));
        $data['section_list']       = $section_list;
        $unit_level                 = get_list(UNIT_LEVEL, null, null);
        $data['unit_level']         = $unit_level;
        $data['state_list']         = get_list(STATE_MASTER,null,null);
        $data['head_notesheet']     = get_list(FILE_NOTESHEET_HEADER_MASTER,null,null);
        $this->template->index($data);
    }


    public function manage_files($id = null) {
        //  pr('rag');
        $data['title']            =  $this->lang->line('file_title');
        $data['title_tab']        = $this->lang->line('file_tab_title');

        if($id == null){
            $data['page_title']   = $this->lang->line('file_tab_title');
            $data['is_page_edit'] = false;
        }else{
            $data['page_title']   = $this->lang->line('file_edit_title');
            $data['is_page_edit'] = true;
            $file_data = get_file($id);
            $data['id'] = $id;
        }

        $this->form_validation->set_rules('check_field', 'check_field', 'required');
        $this->form_validation->set_rules('file_subject', $this->lang->line('file_subject'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('file_uo_number', $this->lang->line('file_uo_number'), 'trim|required|xss_clean');

        if($this->input->post('file_mark_section_id')!=''){
            $this->form_validation->set_rules('file_mark_section_id',$this->lang->line('file_mark_section'), 'trim|required|xss_clean');
        }else{
            $this->form_validation->set_rules('file_mark_officer_id',$this->lang->line('file_mark_officer_id'), 'trim|required|xss_clean');
        }

        $data['postdata']=$this->input->post();

        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

        if ($this->form_validation->run($this) === TRUE)
        {
            $file_last_number = $this->manage_model->get_file_last_number();
            $section_file_last_number = $this->manage_model->get_file_last_number_sectionwise($this->input->post('file_mark_section_id'));
            if($this->input->post('file_mark_section_id')!=''){
            // $sectionunit_user = sectionunit_user();
                $section_role = so_by_roleandsection();

             // $markunitid =  $sectionunit_user[$this->input->post('file_mark_section_id')];
                $section_role_id =  $section_role[$this->input->post('file_mark_section_id')];

             // $receiver_id = getmarkeduser($this->input->post('file_mark_section_id'),$markunitid);
                $receiver_id = user_byrole_section($this->input->post('file_mark_section_id'),$section_role_id);

                $receiver_emp_id = $receiver_id['emp_id'];

                $crno_ofsec_marksec = $this->input->post('file_mark_section_id');

            }else{
                $receiver_emp_id =$this->input->post('file_mark_officer_id');
                $crno_ofsec_marksec = '7'; // 100 no for direct mark files
            }

          //  $section_exp = explode(',',getEmployeeSection());
            $letter_uo_date = strtotime($this->input->post('file_uo_date'));
            $form_data = array(
                'file_type'                 => $this->input->post('file_type'),
                'file_mark_section_id'      => $this->input->post('file_mark_section_id'),
                'file_received_emp_id'      => $receiver_emp_id,
                'file_uo_or_letter_no'      => $this->input->post('file_uo_number'),
                'file_subject'              => $this->input->post('file_subject'),
                'file_description'          => $this->input->post('file_description'),
                'file_uo_or_letter_date'    => date("Y-m-d", $letter_uo_date),
                'file_number'               => $file_last_number,
                'file_section_serial_no'    => $section_file_last_number,
                'file_from_section_id'      => '7',
                'file_sender_emp_id'        => emp_session_id(),
                'createfile_empid'          => emp_session_id(),
                'file_unit_level'           => '',
                'file_mark_section_date'    => date('Y-m-d H:i:s'),
                'file_update_date'          => date('Y-m-d H:i:s'),
                'file_created_date'         => date('Y-m-d H:i:s'),
                'file_level_id'             => '30',   // WORK IN PROGRESS (file_movement_level_master)
            );

            if(isset($_FILES['file_upload']) && $_FILES['file_upload']['error'] == 0){
                $file_upload = uploadalltypeFile('file_upload' , './uploads/documents_file/' );
            } else {
                $file_upload = '';
            }

            $file_log_data1 = array(
                'section_id'  => $this->input->post('file_mark_section_id'),
                'to_emp_id'   => $receiver_emp_id,
                'from_emp_id' => emp_session_id(),
                'flog_remark' => 'File generated',
                'flog_other_remark' => "Subject : ".$this->input->post('file_subject'),
                'flog_ip_address'   => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
                'flog_browser_id'   => $_SERVER['HTTP_USER_AGENT'],
                'document_path'     => $file_upload
            );

            $empdetails = empdetails(emp_session_id());
            $form_data_move1 = array(
                'fmove_current_user_id'  => $receiver_emp_id,
                'fmove_previous_user_id' => emp_session_id(),
                'fmove_from_unit_id'     => getunitid($empdetails[0]['role_id']),   // Central receipt
                'fmove_sectionid_to'     => $this->input->post('file_mark_section_id'),   // Central receipt
                'fmove_sectionid_from'   => '7',   // Central receipt
                'fmove_to_unit_id'       => $this->input->post('mark_unitid'),   // Section officer
            );

            $sectionno = plusone_fileno1($empdetails[0]['emp_section_id'],$crno_ofsec_marksec);

            if($sectionno != 0)  { $section_number = $sectionno; }
            else{  $section_number = '1';  }
            $file_section = array(
                'section_id'            => $empdetails[0]['emp_section_id'], // login user section id eg-CR
                'section_number'        => $section_number,
                'filemarked_section_id' => $crno_ofsec_marksec , // this is use for section_id but for direct file use '100' .
                'file_type'             => $this->input->post('file_type'),
                'file_mark_date'        => date('Y-m-d H:i:s'),
                'file_created_date'     => date('Y-m-d H:i:s'),
                'file_update_date'      => date('Y-m-d H:i:s'),
            );

            $tt = $this->input->post('files_other_feilds');

            if(!empty($tt['case_no'][0])){
                for($i=0 ; $i < count($tt['case_no']); $i++){
                    foreach ($tt as $a=>$b){
                        if($a == 'case_type'){$val12 = $b[$i]."/";}
                        if($a == 'case_no'){$val12 .= $b[$i]."/";}
                        if($a == 'case_year'){ $val12 .= $b[$i];}
                    }
                    $final_val[] = $val12;
                    $final_val1 = implode(',', $final_val);
                }
            }else{
                $final_val1 = '';
            }


            $file_other_feilds = array(
                'section_id'    => $this->input->post('file_mark_section_id'),
                'case_no'       => $final_val1,
                'gov_adocate_delhi' => $this->input->post('gov_adocate_delhi'),
                'file_upload'       => $file_upload,
                'crimanal_name'     => $this->input->post('crimanal_name'),
                'crimanal_no'       => $this->input->post('crimanal_no'),
                'distict_name'      => $this->input->post('distict_name'),
                'police_station_name' => $this->input->post('police_station_name'),
                'applicant_name'      => $this->input->post('applicant_name'),
                'lokayukt_office_no'  => $this->input->post('lokayukt_office_no'),
                'registry_date'       => date( 'Y-m-d' , strtotime(  $this->input->post('registry_date')) ),
                'registry_no'         => $this->input->post('registry_number') ,
            );
            if($id){
            }else{
                if(isset($receiver_emp_id) && $receiver_emp_id != '' && $receiver_emp_id != null)
                {
                    $res = insertData_with_lastid($form_data, FILES);
                    if($res) {
                        $file_id1 = array('file_id' => $res);
                        $finallog = array_merge($file_log_data1, $file_id1);
                        insertData($finallog, FILES_LOG);

                        $form_data_move = array_merge($file_section, $file_id1);
                        insertData($form_data_move, FILES_SECTION);

                        $file_id_oth = array('f_file_id' => $res);
                        $file_other = array_merge($file_other_feilds, $file_id_oth);
                        insertData($file_other, FILES_OTHER_FEILDS);

                        $file_id2 = array('fmove_file_id' => $res);
                        $form_data_move = array_merge($form_data_move1, $file_id2);
                        insertData($form_data_move, FILES_MOVEMENT);

                        $this->session->set_flashdata('message', 'फाइल/पत्र :- <b>' . $res . '</b>  सफलतापूर्वक दर्ज की गई,  जिसका  <b > &nbsp;पंजी क्रमांक :- ' . $section_number . '</b>&nbsp; हैं |');
                    }
                } else{ $this->session->set_flashdata('message', '<span class="text-bold">Marked user is not found, try after some time</span>');
                }
            }
            redirect('show_file/ALL');
        } else{
            $data['abc']                = $this->input->post('file_type');
            $data['val_file_subject']      = $this->input->post('file_subject');
            $data['val_file_uo_number']    = $this->input->post('file_uo_number');
            $data['val_file_type']         = $this->input->post('file_uo_number');
            $data['section_list']     = get_list(SECTIONS, null, array('section_id !=' =>getEmployeeSection()));
            $data['module_name']            = "establishment";
            $data['view_file']              = "establishment/forms/form_1";
            $this->template->index($data);
        }
    }
    function check_other_department($dept_id, $dept_name)
    {
        if ($dept_id == 'other')
        {
            $this->form_validation->set_message('check_other_department',$this->lang->line('file_other_dept_error'));
            return false;
        }
        else
        {
            return true;
        }
    }

    public function checkuo_number()
    {
        $uonumner = $this->input->post('uonumner');
        $this->db->where('file_uo_or_letter_no',$uonumner );
        $query = $this->db->get(FILES);
        $rows = $query->num_rows();
        echo $rows ;

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
}