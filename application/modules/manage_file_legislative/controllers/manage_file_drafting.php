<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Manage_file_drafting extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->module('template');
        $this->load->model('Manage_files_model' , 'manage_model');
        $this->load->model('cr_model');
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
    public function index($fileid = '')
    {

    }

    public function mark_dispatch($file_id = null)
    {
        $section_mark1 = $this->input->post('section_mark1');
        if($section_mark1 == 1){
            $marked_sec = '20'; // trnslation
        }else if($section_mark1 == 3){
            $marked_sec = '8';  // dispatch
        }
        $filedetails =  getFileDetails($file_id);

        if($section_mark1 == 1){


            $file_last_number = $this->cr_model->get_file_last_number();
            $section_file_last_number = $this->cr_model->get_file_last_number_sectionwise($this->input->post('file_mark_section_id'));

            $sectionunit_user = sectionunit_user();
            $markunitid =  $sectionunit_user[$marked_sec];
            $receiver_id = getmarkeduser($marked_sec,$markunitid);
            $receiver_emp_id = $receiver_id['emp_id'];
            $crno_ofsec_marksec = $marked_sec;

            $letter_uo_date = $this->input->post('uo_date');


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
            );
           $form_data_fixed = array(
                'file_number'               => $file_last_number,
                'file_section_serial_no'    => $section_file_last_number,
                'file_uo_or_letter_no'      => getfilesec_id_byfileid($filedetails->file_id,$filedetails->file_mark_section_id)."/21-".get_section_code($filedetails->file_mark_section_id)."/".date('y'),
              //  'file_uo_or_letter_date'    => date("Y-m-d", $letter_uo_date),
                'file_uo_or_letter_date'    => date('Y-m-d H:i:s'),
              //  'file_type'                 => $this->input->post('file_type'),
                'file_type'                 => 'f',
                'file_department_id'        => $filedetails->file_department_id,
                'file_department_name'      => 'Drafting Section (Law dept)',
                'section_file_type' 	    => $filedetails->section_file_type,
                'file_district_id'          => $filedetails->file_district_id,
                'file_state_id'             => $filedetails->file_state_id,
                'file_subject'              => $this->input->post('subject1'),
                'court_bench_id'            => $filedetails->court_bench_id,
                'file_created_date'         => date('Y-m-d H:i:s'),
                'file_Offer_by'             => $filedetails->file_Offer_by,
                'case_parties'              => $filedetails->case_parties,
                'courts_name_location'      => $filedetails->courts_name_location,
                'file_judgment_date'        => $filedetails->file_judgment_date,
                'file_return'               => '0',
                'file_copy_ids'             => $filedetails->file_id,
            );
            $final_form_data = array_merge($form_data, $form_data_fixed);

            $file_log_data1 = array(
                'section_id'        => $marked_sec,
                'to_emp_id'         => $receiver_emp_id,
                'from_emp_id'       => emp_session_id(),
                'flog_remark'       => 'File Enter in Section',
                'flog_other_remark' => "Subject : ".$this->input->post('subject1'),
                'flog_ip_address'   => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
                'flog_browser_id'   => $_SERVER['HTTP_USER_AGENT'],
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
            $sectionno = plusone_fileno1($filedetails->file_mark_section_id,$crno_ofsec_marksec);

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
            );
            $file_other_feilds = array(
                'section_id' => $marked_sec,
            );
            if(isset($receiver_emp_id) && $receiver_emp_id != '' && $receiver_emp_id != null)
            {
                $res = insertData_with_lastid($final_form_data, FILES);
                if($res) {

                    $copy_id = array('file_copy_ids' => $res);
                    updateData(FILES, $copy_id, array('file_id' => $file_id));

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

			$this->session->set_flashdata('message', 'फाइल/पत्र '.$file_id .' :- की प्रति   सफलतापूर्वक दर्ज की गई,  जिसकी    <b > &nbsp;file id :- ' . $res . '</b>&nbsp; हैं | और पंजी क्र. :-<u> '.$section_number.'</u>');             
			 }
            } else{ $this->session->set_flashdata('message', '<span class="text-bold">Marked user is not found, try after some time</span>');
            }
            redirect($_SERVER['HTTP_REFERER']);


        }
       if($section_mark1 == 3 || $section_mark1 == 4) { // 3 for dispatch only // 4 for return and dipatch
            $markemp = getuserbyrole('8', '37'); // section id , roleid (incharge)
            $file_data = array(
                'file_received_emp_id' => $markemp[0]['emp_id'],
                'file_sender_emp_id' => emp_session_id(),
                'file_return' => '2', // 2 for dispatch
                'file_hardcopy_status' => 'not',
                'file_unit_level' => '58',
                //    'file_mark_section_date' => date('Y-m-d H:i:s'),
                'file_update_date' => date('Y-m-d H:i:s'),
            );
            $filelog_data = array(
                'file_id' => $file_id,
                'section_id' => '8',
                'to_emp_id' => $markemp[0]['emp_id'],
                'from_emp_id' => emp_session_id(),
                'flog_other_remark' => $this->input->post('subject1'),
                'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
                'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
            );
            $empdetails = empdetails(emp_session_id());
            $empdetails_m = empdetails($markemp[0]['emp_id']);
            $form_data_move1 = array(
                'fmove_file_id' => $file_id,
                'fmove_current_user_id' => $markemp[0]['emp_id'],
                'fmove_previous_user_id' => emp_session_id(),
                'fmove_to_unit_id' => getunitid($empdetails_m[0]['role_id']),
                'fmove_from_unit_id' => getunitid($empdetails[0]['role_id']),
                'file_return' => '2',
            );

            if (isset($markemp) && $markemp != '' && $markemp != null) {
                $res1 = updateData(FILES, $file_data, array('file_id' => $file_id));
                if ($res1) {
                    insertData($filelog_data, FILES_LOG);
                    insertData($form_data_move1, FILES_MOVEMENT);
                    $this->session->set_flashdata('message', '<u>FIleID : ' . $file_id . '</u> Successfully Send');
                }
            } else {
                $this->session->set_flashdata('message', '<span class="text-bold">Marked user is not found, try after some time</span>');
            }
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function check_for_dispatch()
    {
        $file_ids3 = $this->input->post('file_id3');
        $this->db->where('file_id',$file_ids3 );
        $this->db->where('file_copy_ids',null);
        $query = $this->db->get(FILES);
        $rows = $query->num_rows();
        //echo $this->db->last_query();
        echo $rows ;

    }

    public function check_for_traslation()
    {
        $file_ids3 = $this->input->post('file_id3');
        $this->db->select('file_copy_ids');
        $this->db->where('file_id',$file_ids3 );
        $this->db->where('file_copy_ids !=', '');
        $query = $this->db->get(FILES);
        $rows = $query->num_rows();
        echo $rows ;

       /* $rows = $query->row();
        if($query->row() == 1){
        echo $rows->file_copy_ids ;
        }else{
            echo "0";
        }*/

    }

}