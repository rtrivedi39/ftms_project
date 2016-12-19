<?php
class File_splitting extends MX_Controller{
    function __construct() {
        parent::__construct();
        $this->load->module('template');
        $this->load->language('view_file','hindi');
        $this->load->model('view_file_model','view_file');
        authorize();
    }
    public function index($val = null)
    {
        $data = array();
        $data['title'] = 'File splitting ';
        $data['title_tab'] = 'File for splitting..';
        $data['file_details']= $this->view_file->getFileDetails($val);
        $copies_file = $data['file_details']['0'];
        if($copies_file['file_copy_ids'] != '' and $copies_file['file_copy_ids'] != null){
            $copies = "file_id IN (".$copies_file['file_copy_ids'].")";
            $data['file_copies']= get_list(FILES,null,$copies);
        }
        $data['view_file'] = "view_file/file_splitting";
        $data['module_name'] = "view_file";
        $data['view_left_sidebar'] = 'admin/left_sidebar';
        $this->template->index($data);

    }

    public function script_get_officers_list(){
        $curr_emp1 = emp_session_id();
        $Query = ("SELECT ft_employee.emp_id ,ft_employee.emp_full_name , ft_employee.emp_full_name_hi , ft_emprole_master.emprole_name_hi , ft_emprole_master.emprole_name_en FROM ft_employee join ft_emprole_master on ft_emprole_master.role_id = ft_employee.designation_id where ft_employee.emp_id != '$curr_emp1'  and ft_emprole_master.level_class = '1'");
        $results = $this->db->query($Query);
        $res_array1 =  $results->result_array();
        echo json_encode($res_array1);
        exit();
    }

    public function file_splitting_fn($file_id = null)
    {
        $file_id = $this->input->post('s_file_id');
        $filedetails =  getFileDetails($file_id);
        $filesubject = $this->input->post('s_filesubject');
        $file_mark_type = $this->input->post('file_mark_type');
        $section_ids = $this->input->post('section_ids');
        $officer_ids = $this->input->post('officer_ids');
        $file_desription = $this->input->post('s_description');
        $file_uonumber = $this->input->post('s_uonumber');

        if(isset($file_id) && $file_id != ''){

            if($file_mark_type == '1' && $section_ids!=''){
                $sectionunit_user = sectionunit_user();
                $markunitid =  $sectionunit_user[$section_ids];
                $receiver_id = getmarkeduser($section_ids,$markunitid);
                $receiver_emp_id = $receiver_id['emp_id'];
                $marked_sec = $section_ids;
            }elseif($file_mark_type == '2' && $officer_ids!=''){
                $receiver_emp_id = $officer_ids;
                $marked_sec = '100'; // 100 no for direct mark files
            }

            $form_data = array(
                'file_mark_section_id'    => $marked_sec,
                'file_from_section_id'    => $filedetails->file_mark_section_id,
                'file_received_emp_id'    => $receiver_emp_id,
                'file_sender_emp_id'      => emp_session_id(),
                'file_mark_section_date'  => date('Y-m-d H:i:s'),
                'file_update_date'        => date('Y-m-d H:i:s'),
                'file_level_id'           => '30',   // WORK IN PROGRESS (file_movement_level_master)
                'file_unit_level'         => '51', // 51 is so unit id
                'createfile_empid'        => emp_session_id(),
                'file_status'				=> 'p'
            );

            $form_data_fixed = array(
                'file_number'               => 0,//need to check+
                'file_section_serial_no'    => 0, //need to check
                'file_uo_or_letter_no'      => @$file_uonumber ? $file_uonumber : $filedetails->file_uo_or_letter_no,
                'file_uo_or_letter_date'    => $filedetails->file_uo_or_letter_date,
                //   'file_uo_or_letter_date'    => date('Y-m-d H:i:s'),
                //  'file_type'                 => $this->input->post('file_type'),
                'file_type'                 => $filedetails->file_type,
                'file_department_id'        => $filedetails->file_department_id,
                'file_department_name'      => 'Law department bhopal',
                'section_file_type' 	    => $filedetails->section_file_type,
                'file_district_id'          => $filedetails->file_district_id,
                'file_state_id'             => $filedetails->file_state_id,
                'file_subject'              => $filesubject,
                'court_bench_id'            => $filedetails->court_bench_id,
                'file_created_date'         => date('Y-m-d H:i:s'),
                'file_Offer_by'             => $filedetails->file_Offer_by,
                'case_parties'              => $filedetails->case_parties,
                'courts_name_location'      => $filedetails->courts_name_location,
                'file_judgment_date'        => $filedetails->file_judgment_date,
                'file_return'               => '0',
                'file_copy_ids'             => $filedetails->file_id,
                'file_description'          => $file_desription,
            );

            $final_form_data = array_merge($form_data, $form_data_fixed);

            $checkUserdesignation = checkUserdesignation();
            $file_log_data1 = array(
                'section_id'        => $marked_sec,
                'to_emp_id'         => $receiver_emp_id,
                'from_emp_id'       => emp_session_id(),
                'flog_remark'       => 'File Enter in Section',
                'flog_other_remark' => "विवरण : ".$file_desription,
                'flog_ip_address'   => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
                'flog_browser_id'   => $_SERVER['HTTP_USER_AGENT'],
                'sublogin'          =>  $this->session->userdata('emp_id'),
                'emp_degignation_id' => $checkUserdesignation,
                'file_status_log' => 'p',
            );

            $empdetails = empdetails(emp_session_id());
            $form_data_move1 = array(
                'fmove_current_user_id'  => $receiver_emp_id,
                'fmove_previous_user_id' => emp_session_id(),
                'fmove_from_unit_id'     => getunitid($empdetails[0]['role_id']),   // Central receipt
                'fmove_to_unit_id'       => $this->input->post('mark_unitid'),   // Section officer
                'fmove_sectionid_to'     => $marked_sec,
                'fmove_sectionid_from'   => $filedetails->file_mark_section_id,
            );

            /* $sectionno = plusone_fileno1($filedetails->file_mark_section_id,$crno_ofsec_marksec);

             if($sectionno != 0)  { $section_number = $sectionno; }
             else{  $section_number = '1';  }
             $file_section = array(
                 'section_id'            => $filedetails->file_mark_section_id, // login user section id eg-CR
                 'section_number'        => $section_number,
                 'filemarked_section_id' => $crno_ofsec_marksec , // this is use for section_id but for direct file use '100' .
                 'file_type'             => 'f',
                 'file_mark_date'        => date('Y-m-d H:i:s'),
                 'file_created_date'     => date('Y-m-d H:i:s'),
                 'file_update_date'      => date('Y-m-d H:i:s'),
             );*/

            $file_other_feilds = array(
                'section_id' => $marked_sec,
            );


            if(isset($receiver_emp_id) && $receiver_emp_id != '' && $receiver_emp_id != null)
            {

                $res = insertData_with_lastid($final_form_data, FILES);
                if($res) {

                    $copy_id = array(
                        'file_copy_ids' => @$filedetails->file_copy_ids ? $filedetails->file_copy_ids.",".$res : $res,
                    );
                    $up_res = updateData(FILES, $copy_id, array('file_id' => $file_id));
                    if($up_res){
                        $filelog_data = array(
                            'file_id' => $file_id,
                            'section_id' => $filedetails->file_mark_section_id,
                            'to_emp_id' => emp_session_id(),
                            'from_emp_id' => emp_session_id(),
                            'flog_other_remark' => 'नस्ती की प्रतिलिपि बनाई गई |',
                            'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
                            'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
                            'sublogin' => $this->session->userdata('emp_id'),
                            'emp_degignation_id' => checkUserdesignation(),
                            'file_headerpath' => isset($res) ? serialize(array($res)) : false
                        );
                        insertData($filelog_data, FILES_LOG);
                    }

                    $file_id1 = array('file_id' => $res);
                    $finallog = array_merge($file_log_data1, $file_id1);
                    insertData($finallog, FILES_LOG);

                    /*$form_data_move = array_merge($file_section, $file_id1);
                    insertData($form_data_move, FILES_SECTION);*/

                    $file_id_oth = array('f_file_id' => $res);
                    $file_other = array_merge($file_other_feilds, $file_id_oth);
                    insertData($file_other, FILES_OTHER_FEILDS);

                    $file_id2 = array('fmove_file_id' => $res);
                    $form_data_move = array_merge($form_data_move1, $file_id2);
                    insertData($form_data_move, FILES_MOVEMENT);

                    $this->session->set_flashdata('message', 'फाइल/पत्र  की प्रति   सफलतापूर्वक दर्ज कर  की गई |');
                }
            } else{ $this->session->set_flashdata('message', '<span class="text-bold">Marked user is not found, try after some time</span>');
            }
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
}