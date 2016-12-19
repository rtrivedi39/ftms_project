<?php

class Gpfdpf_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function insert_update_dpf_gpf()
    {
        $process_type = $this->input->post('process_type');

        $pay_app_id = $this->input->post('pay_app_id') ? $this->input->post('pay_app_id') : null ;



        $data_is = array(
            'pay_emp_id'  	    => $this->input->post('applicant_emp_id'),
            'pay_emp_unique_id'  	=> $this->input->post('applicant_emp_code'),
            'pay_emp_name'  	=> $this->input->post('applicant_name'),
            'pay_emp_designation'  	=> $this->input->post('applicant_designation'),
            'pay_emp_class'  	=> $this->input->post('applicant_category'),
            'pay_account_no'  	=> $this->input->post('dpf_account_no'),
            'pay_pre_month'  		=> 'March',
            'pay_pre_year'  		=> $this->input->post('previous_year_txt'),
            'pay_pre_amount'  		=> convert_currentcy_interger($this->input->post('previous_year_amnt')),
            'pay_month'  			=> 'March',
            'pay_years'  			=> $this->input->post('current_year_txt'),
            'pay_amount' 			=> convert_currentcy_interger($this->input->post('current_year_amnt')),
            'pay_adv_amount' 		=> convert_currentcy_interger($this->input->post('gpfdpf_adv')),
            'pay_amnt_curr_financial' => convert_currentcy_interger($this->input->post('curr_current_year_amt')),
            'applied_amount_adv' 	=> convert_currentcy_interger($this->input->post('applied_amount_adv')),
            'pay_cateid' 			=> $this->input->post('master_id'),
            'pay_sub_cateid' 		=> $this->input->post('sub_master_id'),
            'created_by' 			=>  $this->session->userdata('emp_id'),
            'updated_by' 			=>  $this->session->userdata('emp_id'),
            'pay_percentage' 		=> $this->input->post('pay_persent'),
            'applied_amnt_adv_status' => '1', //only save
            'applied_amount_adv_words' => $this->input->post('applied_amount_adv_words'),
            'pay_curr_financial_yr' => $this->input->post('pay_curr_financial_yr'),
            'updated_at'            => date('Y-m-d H:i:s'),
        );
        if($_FILES['attachment1']){
            $image_name = uploadalltypeFile('attachment1' , './uploads/GPF_DPF/' );
            $data_is['pay_attachment'] =  "uploads/GPF_DPF/".$image_name;
        }


        if($process_type == 'modify_app' && $pay_app_id != null){
            $data_old = get_list('pay_dpf_yearly_amount', null ,array('pay_id' => $pay_app_id));

            $data_old_data = array(
                'log_pay_id'  	        => $data_old[0]['pay_id'],
                'log_order_no'  	=> $data_old[0]['pay_order_no'],
                'log_dd_type'  	    => $data_old[0]['pay_dd_type'],
                'log_emp_name'  	=> $data_old[0]['pay_emp_name'],
                'log_emp_id'  	    => $data_old[0]['pay_emp_id'],
                'log_emp_unique_id'  	=> $data_old[0]['pay_emp_unique_id'],
                'log_emp_designation'  	=> $data_old[0]['pay_emp_designation'],
                'log_account_no'  		=> $data_old[0]['pay_account_no'],
                'log_percentage'  		=> $data_old[0]['pay_percentage'],
                'log_emp_class'  		=> $data_old[0]['pay_emp_class'],
                'log_pre_year'  		=> $data_old[0]['pay_pre_year'],
                'log_pre_month' 		=> $data_old[0]['pay_pre_month'],
                'log_pre_amount' 		=> $data_old[0]['pay_pre_amount'],
                'log_years' 	        => $data_old[0]['pay_years'],
                'log_month' 			=> $data_old[0]['pay_month'],
                'log_cateid' 		=> $data_old[0]['pay_cateid'],
                'log_adv_amount' 	=> $data_old[0]['pay_adv_amount'],
                'log_amount' 		=> $data_old[0]['pay_amount'],
                'log_rateofintrest' => $data_old[0]['pay_rateofintrest'],
                'log_applied_amount_adv' => $data_old[0]['applied_amount_adv'],
                'log_applied_amount_adv_words' => $data_old[0]['applied_amount_adv_words'],
                'log_applied_amnt_adv_status' => $data_old[0]['applied_amnt_adv_status'],
                'log_created_by' =>  $this->session->userdata('emp_id'),
                'log_pay_attachment' => $data_old[0]['pay_attachment'],
                'log_pay_sub_cateid' => $data_old[0]['pay_sub_cateid'],
                'log_pay_file_id' => $data_old[0]['pay_file_id'],
            );
			unset($data_is['created_by']);
            $updt =  updateData('pay_dpf_yearly_amount', $data_is, array('pay_id' => $pay_app_id ));
            if($updt){
                insertData($data_old_data, 'ft_pay_gpfdpf_amount_update_log');
                $this->session->set_flashdata('message', 'आवेदन में सफलतापूर्वक बदलाव किया गया |');
                redirect('est_service_module');
            }
        }else{
        $res = insertData_with_lastid($data_is,'pay_dpf_yearly_amount');
        if($res){
            if($process_type == 'send_est'){
              $datafeed =   $this->file_create_gpf_dpf($res,$data_is);
                if($datafeed == true){
                    $this->session->set_flashdata('message', 'आवेदन सफलतापूर्वक दर्ज किया गया अत: स्थापना में  भेजा गया | ');
                    if(emp_session_id() != $this->input->post('applicant_emp_id')){
                        redirect('est_service_module/index/5');
                    }else{
                        redirect('est_service_module');
                    }
                    die;
                }else{
                    $this->session->set_flashdata('message', '.... !');
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

    public function file_create_gpf_dpf($pay_id , $data_is)
    {
        $padetails =  $data_is;
        $filesubject = "अभिदाता का नाम तथा एम्प्लोये कोड :".$padetails['pay_emp_name']." (".$padetails['pay_emp_designation'].") (".$padetails['pay_emp_unique_id'].")";
        $file_e_p = $this->input->post('file_e_p');
        $file_description = '';
        $file_uonumber = '';
        $sender_emp_id = emp_session_id();

        if(isset($pay_id) && $pay_id != '' && $padetails != ''){

            $section_ids = '7'; // 7 no for EST

            //mark user who are currently work on this categoery
            $receiver_emp_id = get_category_allote_emp($padetails['pay_sub_cateid']);
            if($receiver_emp_id == false || $receiver_emp_id == ''){
                $sectionunit_user = sectionunit_user();
                $markunitid =  $sectionunit_user[$section_ids];
                $receiver_id = getmarkeduser($section_ids,$markunitid);
                $receiver_emp_id = $receiver_id['emp_id'];
            } else {
                $receiver_emp_id = $receiver_emp_id;
            }

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
                'file_status'				=> 'p',
                'file_hardcopy_status'		=> 'not'
            );

            $form_data_fixed = array(
                'file_number'               => 0,//need to check+
                'file_section_serial_no'    => 0, //need to check
                'file_uo_or_letter_no'      => 0,
                'file_uo_or_letter_date'    => 0,
                'file_type'                 => 'f',
                'file_department_id'        => '56',
                'file_department_name'      => $padetails['pay_emp_name'],
                'section_file_type' 	    => $padetails['pay_id'],
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

            $empdetails = empdetails($receiver_emp_id);
            $form_data_move1 = array(
                'fmove_current_user_id'  => $receiver_emp_id,
                'fmove_previous_user_id' => $sender_emp_id,
                'fmove_from_unit_id'     => 0,   // Central receipt
                'fmove_to_unit_id'       => 0,   // Section officer
                'fmove_sectionid_to'     => $marked_sec,
                'fmove_sectionid_from'   => $marked_sec,
            );

            $insert_relation = array(
                'relation_application_id'     => $pay_id,
                'relation_module_table'       => 'ft_pay_dpf_yearly_amount',
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
                        'pay_file_id' => $res,
                        'applied_amnt_adv_status' => '2', // onfile
                    );
                    updateData('pay_dpf_yearly_amount', $form_dt, array('pay_id' => $pay_id));

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


    public function get_pay_dpf_yearly_amount_s()
    {
    }
}

