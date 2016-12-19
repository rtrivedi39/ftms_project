<?php

class Local_bill_module extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function insert_update_local_bill()
    {

        $bill_last_number =  $this->get_bill_last_group();
        $process_type = $this->input->post('process_type');
        $bill_id = $this->input->post('bill_id') ? $this->input->post('bill_id') : null ;

        $app_applied_month = $this->input->post('app_applied_month');
        foreach($app_applied_month as $key => $app_applied) {

            $frm_dt = $this->input->post('frm_dt');
            $to_dt = $this->input->post('to_dt');
            $app_applied_month = $this->input->post('app_applied_month');
            $case_memo      = $this->input->post('case_memo');

            $app_petrol_rate    = $this->input->post('app_petrol_rate');

            $app_bill_description      = $this->input->post('app_bill_description');

            $driver_name    = $this->input->post('driver_name');
            $app_petrol_lit = $this->input->post('app_petrol_lit');
            $applied_amount_adv_words = $this->input->post('applied_amount_adv_words');
            $mailo_meter    = $this->input->post('mailo_meter');
            $app_apply_amount = $this->input->post('app_apply_amount');
            $app_petrol_lit = $this->input->post('app_petrol_lit');
            $app_electricity_unit = $this->input->post('app_electricity_unit');

            $extrafeilds = array('oil_rate' => $app_petrol_rate[$key] , 'case_memo' => $case_memo[$key] , 'driver_name' => $driver_name[$key] , 'mailo_meter' => $mailo_meter[$key]);
            $extrafeilds['description'] = $app_bill_description[$key] ;
            $applied_amount_adv_words = $this->input->post('applied_amount_adv_words');

            $data_is = array(
                'bill_user_house_no'  	=> $this->input->post('app_house_no'),
                'bill_extra_feilds'  	=> serialize($extrafeilds),
                'bill_from_date'  	    => date( 'Y-m-d' , strtotime($frm_dt[$key])),
                'bill_to_date'  	    => date( 'Y-m-d' , strtotime($to_dt[$key])),
                'bill_emp_id'  	        => $this->input->post('applicant_emp_id'),
                'bill_emp_unique_id'  	=> $this->input->post('applicant_emp_code'),
                'bill_emp_name'  	    => $this->input->post('applicant_name'),
                'bill_emp_designation'  => $this->input->post('applicant_designation'),
                'bill_apply_amt'  	    => convert_currentcy_interger($app_apply_amount[$key]),
                'bill_apply_amt_words'  => $applied_amount_adv_words[$key],
                'bill_apply_month'  	=> $app_applied_month[$key],
                'bill_for'  		    => @$this->input->post('sub_master_id') == '128' ? $this->input->post('app_oth_bill') : $this->input->post('app_bill_for'),
                'bill_sub_catid'  		=> $this->input->post('sub_master_id'),
                'bill_condition'  		=> "",
                'bill_status'  			=> '1',
                'bill_create_by'        =>  $this->session->userdata('emp_id'),
                'bill_update_by'        =>  $this->session->userdata('emp_id'),
                'bill_create_at'        => date('Y-m-d H:i:s'),
                'bill_update_at'        => date('Y-m-d H:i:s'),
                'bill_mobile_no'  		=> $this->input->post('app_mobile_number') ? $this->input->post('app_mobile_number') : null,
                'bill_vehicle_no'  		=> $this->input->post('app_vehicle_no') ? $this->input->post('app_vehicle_no') : null,
                'bill_petrol_lit'  		=> $app_petrol_lit[$key] ? $app_petrol_lit[$key] : null,
                'bill_electricity_unit' => $app_electricity_unit[$key] ? $app_electricity_unit[$key] : null,
                'bill_grouping'         => $bill_last_number ,
            );

            if($_FILES['attachment1'.$key] && !empty($_FILES['attachment1'.$key]['name'])){
                $image_name = uploadalltypeFile('attachment1'.$key , './uploads/local_bill/' );
                $data_is['bill_attachment'] =  "uploads/local_bill/".$image_name;
            }
            if($process_type == 'send_est' || $process_type == 'only_save') {
                $res[] = insertData_with_lastid($data_is, 'ft_est_local_bills');
            }
        }
        $res1 =   implode(',',$res);

        if($process_type == 'modify_app' && $bill_id != null){
            //  $data_old = get_list('ft_est_local_bills', null ,array('id' => $bill_id));
            //  $data_old_data = array(  );
            unset($data_is['bill_create_by'],$data_is['bill_create_at'] ,$data_is['bill_grouping']);

            $updt =  updateData('ft_est_local_bills', $data_is, array('id' => $bill_id ));
            if($updt){
                // insertData($data_old_data, 'ft_pay_gpfdpf_amount_update_log');
                $this->session->set_flashdata('message', 'आवेदन में सफलतापूर्वक बदलाव किया गया |');
                redirect('est_service_module');
            }
        }else{
            if($res1){
                if($process_type == 'send_est'){
                    $datafeed = $this->file_create_for_bill($res1,$data_is);
                    if($datafeed == true){
                        $this->session->set_flashdata('message', 'आवेदन सफलतापूर्वक दर्ज किया गया अत: स्थापना में  भेजा गया | ');
                        if(emp_session_id() != $this->input->post('applicant_emp_id')){
                            redirect('est_service_module/index/5');
                        }else{
                            redirect('est_service_module');
                        }
                        die;
                    }else{
                        $this->session->set_flashdata('message', '....!');
                        if(emp_session_id() != $this->input->post('applicant_emp_id')){
                            redirect('est_service_module/index/5');
                        }else{
                            redirect('est_service_module');
                        }
                        die;
                    }
                }else{
                    $this->session->set_flashdata('message', 'आवेदन केवल दर्ज किया गया |');
                    if(emp_session_id() != $this->input->post('applicant_emp_id')){
                        redirect('est_service_module/index/5');
                    }else{
                        redirect('est_service_module');
                    }
                    die;
                }
            }else{
                return false ;
            }}
    }

    public function file_create_for_bill($bill_id , $data_is)
    {
        $bill_details =  $data_is;
        $filesubject = $bill_details['bill_emp_name']." (".$bill_details['bill_emp_designation'].") (".$bill_details['bill_emp_unique_id'].") द्वारा ".$bill_details['bill_for']." हेतु |";
        $file_e_p = $this->input->post('file_e_p');
        $file_description = '';
        $file_uonumber = '';
        $sender_emp_id = emp_session_id();

        if(isset($bill_id) && $bill_id != '' && $bill_details != ''){

            $section_ids = '7'; // 7 no for EST

            //mark user who are currently work on this categoery
            $receiver_emp_id_array = get_category_allote_emp($bill_details['bill_sub_catid'] , true); // not use if multiple user

            if(!empty($receiver_emp_id_array)){
                $check_alorted_user  = count($receiver_emp_id_array);
                if($check_alorted_user == 1){
                    $receiver_emp_id = $receiver_emp_id_array[0]['est_word_alloted_emp_id'];
                }else{
                    $multi_user1  =  null;
                    if($check_alorted_user > 1){
                        foreach($receiver_emp_id_array as $receiver_emp_id_arra){
                            $user1[]  =   $receiver_emp_id_arra['est_word_alloted_emp_id'];
                        }
                        $multi_user1  =  implode(',',$user1);
                    }
                    $sectionunit_user = sectionunit_user();
                    $markunitid =  $sectionunit_user[$section_ids];
                    $receiver_id = getmarkeduser($section_ids,$markunitid);
                    $receiver_emp_id = $receiver_id['emp_id'];
                }
            }else{
                $multi_user1  =  null;
                $sectionunit_user = sectionunit_user();
                $markunitid =  $sectionunit_user[$section_ids];
                $receiver_id = getmarkeduser($section_ids,$markunitid);
                $receiver_emp_id = $receiver_id['emp_id'];
            }

            /* if($receiver_emp_id == false || $receiver_emp_id == ''){
                            $sectionunit_user = sectionunit_user();
                            $markunitid =  $sectionunit_user[$section_ids];
                            $receiver_id = getmarkeduser($section_ids,$markunitid);
                            $receiver_emp_id = $receiver_id['emp_id'];
                        } else {
                            $receiver_emp_id = $receiver_emp_id;
                        }*/

            $marked_sec = $section_ids;

            $form_data = array(
                'file_mark_section_id'    => $marked_sec,
                'file_from_section_id'    => '0',
                'file_received_emp_id'    => $receiver_emp_id,
                'file_sender_emp_id'      => $sender_emp_id,
                'file_mark_section_date'  => date('Y-m-d H:i:s'),
                'file_update_date'        => date('Y-m-d H:i:s'),
                'file_level_id'           => '30',   // WORK IN PROGRESS (file_movement_level_master)
                'file_unit_level'         => '51',  // 51 is so unit id
                'createfile_empid'        => $sender_emp_id,
                'file_status'			=> 'p',
                'file_hardcopy_status'	=> 'not',
                'multi_user_receiver_id'  => $multi_user1
            );

            $form_data_fixed = array(
                'file_number'               => 0,//need to check+
                'file_section_serial_no'    => 0, //need to check
                'file_uo_or_letter_no'      => 0,
                'file_uo_or_letter_date'    => 0,
                'file_type'                 => 'f', //app
                'file_department_id'        => '56', // law department id
                'file_department_name'      => $bill_details['bill_emp_name'],
                'section_file_type' 	    => $bill_details['id'],
                'file_subject'              => $filesubject,
                'file_created_date'         => date('Y-m-d H:i:s'),
                'file_Offer_by'             => 'v',
                'file_return'               => '0',
                'file_description'          => $file_description,
            );

            $final_form_data = array_merge($form_data, $form_data_fixed);

            $checkUserdesignation = checkUserdesignation();
            $file_log_data1 = array(
                'section_id'        => $marked_sec,
                'to_emp_id'         => $receiver_emp_id,
                'from_emp_id'       => $sender_emp_id,
                'flog_remark'       => 'File Enter in Section',
                'flog_other_remark' => "विषय : ".$filesubject,
                'flog_ip_address'   => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
                'flog_browser_id'   => $_SERVER['HTTP_USER_AGENT'],
                'sublogin'          =>  $this->session->userdata('emp_id'),
                'emp_degignation_id' => $checkUserdesignation,
                'file_status_log' => 'p',
            );

            //  $empdetails = empdetails($receiver_emp_id);
            $form_data_move1 = array(
                'fmove_current_user_id'  => $receiver_emp_id,
                'fmove_previous_user_id' => $sender_emp_id,
                'fmove_from_unit_id'     => 0,   // Central receipt
                'fmove_to_unit_id'       => 0,   // Section officer
                'fmove_sectionid_to'     => $marked_sec,
                'fmove_sectionid_from'   => $marked_sec,
            );

            $insert_relation = array(
                'relation_application_id'     => $bill_id,
                'relation_module_table'       => 'ft_est_local_bills',
            );

            $sectionno = plusone_fileno1($marked_sec);

            if($sectionno != 0)  { $section_number = $sectionno; }
            else{  $section_number = '1';  }
            $file_section = array(
                'section_id'            => 7, // login user section id eg-CR
                'section_number'        => $section_number,
                //  'filemarked_section_id' => null , // this is use for section_id but for direct file use '100' .
                'file_type'             => 'f',
                'file_mark_date'        => date('Y-m-d H:i:s'),
                'file_created_date'     => date('Y-m-d H:i:s'),
                'file_update_date'      => date('Y-m-d H:i:s'),
            );

            if(isset($receiver_emp_id) && $receiver_emp_id != '' && $receiver_emp_id != null)
            {
                $res = insertData_with_lastid($final_form_data, FILES);
                if($res) {
                    $file_id1 = array('file_id' => $res);
                    $form_dt = array(
                        'bill_file_id' => $res,
                        'bill_status' => '2', // onfile
                    );
                    $bill =  explode(',',$bill_id);
                    foreach($bill as $bill1){
                        updateData('ft_est_local_bills', $form_dt, array('id' => $bill1));
                    }
                    $file_relation = array('relation_file_id' => $res);
                    $form_relation = array_merge($insert_relation, $file_relation);
                    $rel_id = insertData_with_lastid($form_relation, 'ft_est_module_relation');
                    if($rel_id){
                        updateData(FILES, array('file_est_relation_id' => $rel_id), array('file_id' => $res));
                    }
                    $form_data_sec = array_merge($file_section, $file_id1);
                    insertData($form_data_sec, FILES_SECTION);

                    $finallog = array_merge($file_log_data1, $file_id1);
                    insertData($finallog, FILES_LOG);

                    $file_id2 = array('fmove_file_id' => $res);
                    $form_data_move = array_merge($form_data_move1, $file_id2);
                    insertData($form_data_move, FILES_MOVEMENT);
                    return true ;
                }
            } else{
                $this->session->set_flashdata('message', '<span class="text-bold">Marked user is not found, try after some time</span>');
                return false ;
            }
        }
    }

    function get_bill_last_group(){
        $this->db->select_max('bill_grouping');
        $query = $this->db->get(EST_LOCAL_BILLS, 1);
        $result = $query->row_array();
        return $result['bill_grouping'] + 1;
    }



    public function insert_out_bill_byfile()
    {

        $bill_last_number =  $this->get_bill_last_group();
        $bill_file_id = $this->input->post('bill_file_id');
        $process_type = $this->input->post('process_type');
        $bill_id = $this->input->post('bill_id') ? $this->input->post('bill_id') : null ;

        $app_applied_month = $this->input->post('app_applied_month');
        $applicant_emp_id = $this->input->post('applicant_emp_id');
        foreach($applicant_emp_id as $key => $app_applied) {

            $frm_dt = $this->input->post('frm_dt');
            $to_dt = $this->input->post('to_dt');
            $app_applied_month = $this->input->post('app_applied_month');
            $app_bill_description      = $this->input->post('app_bill_description');
            $app_petrol_lit = $this->input->post('app_petrol_lit');
            $app_electricity_unit = $this->input->post('app_electricity_unit');

            $applicant_emp_id =  $this->input->post('applicant_emp_id');
            $applicant_name =  $this->input->post('applicant_name');
            $applicant_emp_code =  $this->input->post('applicant_emp_code');
            $applicant_designation =  $this->input->post('applicant_designation');
            $app_apply_amount =  $this->input->post('app_apply_amount');
            $applied_amount_adv_words =  $this->input->post('applied_amount_adv_words');
            $eligible_amount =  $this->input->post('eligible_amount');
            $more_eligible_amount =  $this->input->post('more_eligible_amount');
            $app_mobile_number =  $this->input->post('app_mobile_number');

            $extrafeilds = array('eligible_amount' => $eligible_amount[$key] , 'more_than_eligible' => $more_eligible_amount[$key]);
            $extrafeilds['description'] = $app_bill_description[$key] ;

            $data_is = array(
                'bill_user_house_no'  	=> @$this->input->post('app_house_no') ? $this->input->post('app_house_no') : null,
                'bill_extra_feilds'  	=> serialize($extrafeilds),
                'bill_from_date'  	    => date( 'Y-m-d' , strtotime($frm_dt)),
                'bill_to_date'  	    => date( 'Y-m-d' , strtotime($to_dt)),
                'bill_emp_id'  	        => $applicant_emp_id[$key],
                'bill_emp_unique_id'  	=> $applicant_emp_code[$key],
                'bill_emp_name'  	    => $applicant_name[$key],
                'bill_emp_designation'  => $applicant_designation[$key],
                'bill_apply_amt'  	    => convert_currentcy_interger($app_apply_amount[$key]),
                'bill_apply_amt_words'  => $applied_amount_adv_words[$key],
                'bill_apply_month'  	=> $app_applied_month[$key],
                'bill_for'  		    => $this->input->post('app_bill_for'),
                'bill_sub_catid'  		=> $this->input->post('sub_master_id'),
                'bill_condition'  		=> "",
                'bill_status'  			=> '2',
                'bill_create_by'        =>  $this->session->userdata('emp_id'),
                'bill_update_by'        =>  $this->session->userdata('emp_id'),
                'bill_create_at'        => date('Y-m-d H:i:s'),
                'bill_update_at'        => date('Y-m-d H:i:s'),
                'bill_mobile_no'  		=> $app_mobile_number[$key],
                'bill_vehicle_no'  		=> $this->input->post('app_vehicle_no') ? $this->input->post('app_vehicle_no') : null,
                'bill_petrol_lit'  		=> $app_petrol_lit[$key] ? $app_petrol_lit[$key] : null,
                'bill_electricity_unit' => $app_electricity_unit[$key] ? $app_electricity_unit[$key] : null,
                'bill_grouping'         => $bill_last_number ,
                'bill_file_id'         => $bill_file_id ,
            );

            if($data_is['bill_attachment'] && !empty($_FILES['attachment1']['name'])){
                $image_name = uploadalltypeFile('attachment1' , './uploads/local_bill/' );
                $data_is['bill_attachment'] =  "uploads/local_bill/".$image_name;
            }
            if($process_type == 'add_on_file') {
                $res[] = insertData_with_lastid($data_is, 'ft_est_local_bills');
            }
        }
        $res1 =   implode(',',$res);

        if($process_type == 'modify_app' && $bill_id != null){
            unset($data_is['bill_create_by'],$data_is['bill_create_at'] ,$data_is['bill_grouping']);
            $updt =  updateData('ft_est_local_bills', $data_is, array('id' => $bill_id ));
            if($updt){
                $this->session->set_flashdata('message', 'आवेदन में सफलतापूर्वक बदलाव किया गया |');
                redirect('est_service_module');
            }
        }else{
            if($res1){
                if($process_type == 'add_on_file'){
                    $insert_relation = array(
                        'relation_application_id'     => $res1,
                        'relation_module_table'       => 'ft_est_local_bills',
                    );
                    $file_relation = array('relation_file_id' => $bill_file_id);
                    $form_relation = array_merge($insert_relation, $file_relation);
                    $rel_id = insertData_with_lastid($form_relation, 'ft_est_module_relation');
                    if($rel_id){
                        updateData(FILES, array('file_est_relation_id' => $rel_id), array('file_id' => $bill_file_id));
                    }
                    $this->session->set_flashdata('message', 'आवेदन सफलतापूर्वक दर्ज किया गया अत: स्थापना में  भेजा गया | ');
                    if(emp_session_id() != $this->input->post('applicant_emp_id')){
                        redirect('est_service_module/index/5');
                    }else{
                        redirect('est_service_module');
                    }
                    die;
                }
            }else{
                return false ;
            }}
    }

}
