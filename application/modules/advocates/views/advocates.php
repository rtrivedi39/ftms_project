<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Advocates extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('cookie');
		$this->load->helper('advocate');
        $this->load->module('template');
        $this->load->model('advocates_model', 'advocate_model');
        $this->load->language('admin_user', 'hindi');
        $this->load->language('advocate', 'hindi');
        authorize();
    }

    public function index($adv_type,$search_type = null) {
		$data = array();
		$advocat_type = get_row("SELECT adm_name,adm_id  FROM `ft_advocate_name_master` WHERE `adm_id`=$adv_type");
        $data['title'] =$advocat_type['adm_name']. ' की सूची';
        $data['title_tab'] = 'सूची';
		$data['advocate_type_name'] = $advocat_type['adm_name'];
        $data['get_users'] = $this->advocate_model->get_advocate_list($adv_type,null,null,null,$search_type);
		//pre($data['get_users']);
        $data['module_name'] = "advocates";
        $data['adv_type'] = $adv_type;
		$data['search_type'] = $search_type;
		$post_array = auto_update_advocate_posting($adv_type,null,null,null);
		
		if($adv_type == 9){
			$data['view_file'] = "advocates/index_judge";
		}else
		{
			$data['view_file'] = "advocates/index";
		}
       
        $this->template->index($data);
    }
	public function repor_view($adv_type) {
		$data = array();
		$advocat_type = get_row("SELECT adm_name,adm_id  FROM `ft_advocate_name_master` WHERE `adm_id`=$adv_type");
        $data['title'] =$advocat_type['adm_name']. ' की सूची';
        $data['tit'] =$advocat_type['adm_name'];
        $data['title_tab'] = 'सूची';
        $data['get_users'] = $this->advocate_model->get_advocate_list_by_postid($adv_type);
		//pre($data['get_users']);
        $data['module_name'] = "advocates";
        $data['adv_type'] = $adv_type;
		//$post_array = auto_update_advocate_posting($adv_type,null,null,null);
		$data['view_file'] = "advocates/report_view";
        $this->template->index($data);
    }
public function report_view_agp_gp() {
		$data = array();
		//$advocat_type = get_row("SELECT adm_name,adm_id  FROM `ft_advocate_name_master` WHERE `adm_id`=$adv_type");
        $data['title'] = ' AGP/ GP जिलेवार स्वीकृत पद देखे ';
        $data['title_tab'] = ' AGP/ GP जिलेवार स्वीकृत पद देखे ';
        $data['get_users'] = $this->advocate_model->get_advocate_agp_gp_segtion();
		//pre($data['get_users']);
        $data['module_name'] = "advocates";
        $data['adv_type'] = $adv_type;
		//$post_array = auto_update_advocate_posting($adv_type,null,null,null);
		$data['view_file'] = "advocates/report_view_agp_gp";
        $this->template->index($data);
    }
    public function manage_advocate($adv_type = null ,$id = null) {
		
		$data = array();
		$advocate_ids = array();
		$data['advo_types_array'] = get_advo_notary_list();
		foreach($data['advo_types_array'] as $advo_types){
				$advocate_ids[] = $advo_types['adm_id'];
		}
		$data['advo_ids'] = $advocate_ids;
		$post_type  = !empty($adv_type)?$adv_type:$this->input->post('advocate_post_type');
		$advocat_type = get_row("SELECT adm_name,adm_id  FROM `ft_advocate_name_master` WHERE `adm_id`=$post_type");
		$this->load->helper(array('form', 'url'));
        $data['title'] = $advocat_type['adm_name'];
        $data['title_tab'] = $this->lang->line('manage_emp_sub_heading');
        if ($id == null) {
            $data['page_title'] = $this->lang->line('adv_add_heading').'('.$advocat_type['adm_name'].')';
            $data['is_page_edit'] = 1;
        } else {
            $data['page_title'] = $this->lang->line('adv_edit_heading').'('.$advocat_type['adm_name'].')';
            $data['is_page_edit'] = 0;
        }
			
	    $this->form_validation->set_rules('scm_name_hi', 'scm_name_hi', 'required');
		 $this->form_validation->set_rules('advocate_post_type', 'advocate_post_type', 'required');
		 $this->form_validation->set_rules('scm_gender', 'scm_gender', 'required');
		 $this->form_validation->set_rules('scm_gender', 'scm_gender', 'required');
		
		if($adv_type != 9){
			
			 $this->form_validation->set_rules('scm_address_hi', 'scm_address_hi', 'required');
			// $this->form_validation->set_rules('once_registration_number_council', 'once_registration_number_council', 'required');
			
		}
		
		if($adv_type != 9){
			 $this->form_validation->set_rules('advocate_type', 'advocate_type', 'required');
			 $this->form_validation->set_rules('scm_state_id', 'scm_state_id', 'required');
			 $this->form_validation->set_rules('scm_district_id', 'scm_district_id', 'required');
			 $this->form_validation->set_rules('scm_tahsil_id', 'scm_tahsil_id', 'required');
		}
		if($adv_type == 9){
			$this->form_validation->set_rules('home_district', 'home_district', 'required');
			 $this->form_validation->set_rules('residential_address', 'residential_address', 'required');
			 $this->form_validation->set_rules('marti_no', 'marti_no', 'required');
			// $this->form_validation->set_rules('roll_no', 'roll_no', 'required');
			// $this->form_validation->set_rules('total_interview', 'total_interview', 'required');
		}
		
		
		
		
		//pr($this->input)
         $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		if ($this->form_validation->run($this) == TRUE) {
			
			$advocate_master = array(
				
				'scm_name_en' 		=> $this->input->post('scm_name_en'),
				'scm_name_hi' 		=> $this->input->post('scm_name_hi'),
				'scm_post_en' 		=> $this->input->post('advocate_designation'),
				'scm_post_hi' 		=> $this->input->post('advocate_designation'),
				'scm_address_en' 	=> $this->input->post('scm_address_en'),
				'scm_address_hi' 	=> $this->input->post('scm_address_hi'),
				'scm_pincode' 		=> $this->input->post('scm_pincode'),
				
				//'scm_court_name_hi' => $this->input->post('scm_court_name_hi'),
				//'scm_court_name_en' => $this->input->post('scm_court_name_hi'),
				
				'advocate_type' 	=> isset($_POST['advocate_type'])?$this->input->post('advocate_type'):null,
				'advocate_post_type' => $this->input->post('advocate_post_type'),
				'advocate_designation' => $this->input->post('advocate_designation'),
				'scm_state_id' 		=> $this->input->post('scm_state_id'),
				'scm_district_id' 	=> $this->input->post('scm_district_id'),
				'scm_tahsil_id' 	=> isset($_POST['scm_tahsil_id'])?$this->input->post('scm_tahsil_id'):0,
				'scm_taluka_id' 	=> isset($_POST['scm_taluka_id'])?$this->input->post('scm_taluka_id'):0,
				'creator_id' 		=> emp_session_id(),
				'status' 			=> 	1 ,
				'scm_gender' 		=> $this->input->post('scm_gender'),
				'scm_dob'	 		=> isset($_POST['scm_dob'])?date('Y-m-d',strtotime($_POST['scm_dob'])):'',
				'email_id' 			=> $this->input->post('email_id'),
				'scm_father_name_hi'=> $this->input->post('scm_father_name_hi'),
				'scm_father_name_en'=> $this->input->post('scm_father_name_hi'),
				'contact_no' 		=> $this->input->post('contact_no'),
				'provision_pirod' =>  $this->input->post('provision_pirod'),
				'once_registration_number_council' =>  $this->input->post('once_registration_number_council'),
				'notery_registration_no' =>  $this->input->post('notery_registration_no'),
				
			);
		
			
			$inserted_id = insertData_with_lastid($advocate_master, ADVOCATE_MASTER);
			$advocate_service_record = array(
					 			 'advocate_file_cr_no' 		=> $this->input->post('advocate_file_cr_no'),
					 			 'section_no_year' 		=> $this->input->post('section_no_year'),
								 'asr_scm_id' 		=> $inserted_id,
								 'email_id' => $this->input->post('email_id'),
								 'contact_no' => $this->input->post('contact_no'),
								 'order_no' => $this->input->post('adv_order_no'),
								 'order_date' => !empty($_POST['adv_order_date'])? date('Y-m-d' , strtotime( $this->input->post('adv_order_date') )):'0000-00-00',
								 'stamp_no' => $this->input->post('stamp_no'),
								 'stamp_date' => !empty($_POST['stamp_date'])? date('Y-m-d' , strtotime( $this->input->post('stamp_date'))):'0000-00-00',
								 'posting_date' => !empty($_POST['posting_date'])? date('Y-m-d' , strtotime( $this->input->post('posting_date'))):'0000-00-00',
								 'post_renew_date' => !empty($_POST['post_renew_date'])?  date('Y-m-d' , strtotime(  $this->input->post('post_renew_date'))) :'0000-00-00',
								
								 'state_id' 		=> $this->input->post('scm_state_id'),
								 'district_id' 		=> $this->input->post('scm_district_id'),
								 'tahsil_id' 		=> $this->input->post('scm_tahsil_id'),
								 'taluka_id' 		=> $this->input->post('scm_taluka_id'),
								
								 'provision_pirod' 		=>  $this->input->post('provision_pirod'),
								 'lokabhiyojak_work' 	=>  $this->input->post('adv_appointment_posting_date'),
								 'asr_current_status'	=> 'crnt',
								 'create_date' 			=> date('Y-m-d'),
								 'adv_remarke' 			=>  $this->input->post('adv_remarke'),
								'adv_work_experiance' 		=> $this->input->post('adv_work_experiance'),
								
			 );		
			//  print_r($advocate_service_record);die;		
			 insertData($advocate_service_record, ADVOCATE_SERVICE_RECORD);
           	
            
        
          if($adv_type == 9 ){
             $advocate_attachment = array(
				        'marti_no'                       => $this->input->post('marti_no'),
                        'roll_no'                        => $this->input->post('roll_no'),
                        'home_district'                  => $this->input->post('home_district'),
                        'residential_address'            => $this->input->post('residential_address'),
                        'total_marks_written'            => $this->input->post('total_interview'),
                     	'category_name'                  => $this->input->post('cast_category'),
                        'sci_id'                         => $inserted_id,
			);
			
			
				if($_FILES['cast_category_file']['name'] && $this->input->post('cast_category_cert_status') == 'y'  ){
					$file_name_character =  do_upload('cast_category_file',  './uploads/civil_judge/' );
					 $advocate_attachment['is_cast_cert_upload'] = $this->input->post('cast_category_cert_status') ;
					 $advocate_attachment['cast_cert_upload_path']   =  $file_name_character ;
				}else{
					 $advocate_attachment['is_cast_cert_upload'] = $this->input->post('cast_category_cert_status') ;
				}
			
			  if($_FILES['non_opjection_cert_file']['name'] && $this->input->post('non_opjection_cert_status') == 'y' ){
					$file_name_noc =  do_upload('non_opjection_cert_file',  './uploads/civil_judge/' );
					
					$advocate_attachment['non_opjection_cert_status'] = $this->input->post('non_opjection_cert_status') ;
					 $advocate_attachment['non_opjection_cert_path']   =  $file_name_noc  ;
				}else{
					$advocate_attachment['non_opjection_cert_status'] = $this->input->post('non_opjection_cert_status') ;
				}
			
				if($_FILES['fitness_cert_path']['name'] && $this->input->post('attach_fitness_cert_status') == 'y' ){
					 $fitness_cert_path =  do_upload('fitness_cert_path',  './uploads/civil_judge/' );
					
					$advocate_attachment['attach_fitness_cert_status'] = $this->input->post('attach_fitness_cert_status') ;
					$advocate_attachment['fitness_file_upload_path']   =  $fitness_cert_path  ;
				}else{
					$advocate_attachment['attach_fitness_cert_status'] = $this->input->post('attach_fitness_cert_status') ;
				}
			 
		 
		 
		  $advocate_attachment['id_physical_handicap'] = $this->input->post('id_physical_handicap');
		  $advocate_attachment['is_character_cert_status'] = $this->input->post('is_character_cert_status') ;
		  $attchment_id =	insertData_with_lastid( $advocate_attachment ,ADVOCATE_ATTACHMENT) ;	
			if($_FILES['ctr_charater_certificate_file']['name'] && $this->input->post('is_character_cert_status')  == 'y' ){
					$character_cert_path =  do_upload('ctr_charater_certificate_file',  './uploads/civil_judge/' );
					$charater_array['upload_file_name']   =  $character_cert_path  ;
					$charater_array['judge_id'] =	$inserted_id;
					$charater_array['state_id'] = $this->input->post('ctr_state_id') ;
					$charater_array['district_id'] = $this->input->post('ctr_district_id') ;
					$charater_array['attachment_id'] =	$attchment_id;
				}
				//pr($charater_array);die;
				if(count($charater_array) > 0){
				insertData($charater_array, ADVOCATE_CIJ_CHAR_CERTIFICATE);
				}
			 }

			
			$url_path_currnet = $this->input->post('url_path_currnet') ;
			$url_path = explode('/',$url_path_currnet);
			$url_path = $url_path[0].'/'.$url_path[1].'/'.$url_path[2];			
			if($url_path == 'view_file/document_path/index' ){
					echo "<script type=\"text/javascript\">  location.href = '".base_url().$this->input->post('redirect_url')."';   </script>";
					//echo "<script type=\"text/javascript\"> var redirectWindow = window.open('".base_url().$this->input->post('redirect_url')."', '_blank');  redirectWindow.location; </script>";
					
					//echo "<script type=\"text/javascript\"> window.setTimeout(function () { location.href = '".base_url().$this->input->post('url_path_currnet')."'; }, 500); </script>";
					exit;					
			} else {
					 $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable hideauto"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>' . $this->lang->line('success_message') . '</div>');
					 redirect('advocate/list/'.$adv_type);
			 }
			
		}
		$data['adv_type'] = $adv_type;
		$data['module_name'] = "advocates";
		$data['advocat_type']=$advocat_type;
        $data['view_file'] = "advocates/advocates_user";
        $this->template->index($data);
    }

    function check_unique_emp_id($str) {
        $emp_unique_id1 = $this->input->post('emp_unique_id');
        if ($this->uri->segment(3) != '') {
            $cnt = 1;
            $isusers = get_list(EMPLOYEES, NULL, array('emp_unique_id' => $emp_unique_id1, 'emp_id !=' => $this->uri->segment(3)));
        } else {
            $cnt = 0;
            $isusers = get_list(EMPLOYEES, NULL, array('emp_unique_id' => $emp_unique_id1));
        }
        if ($cnt < count($isusers)) {
            $this->form_validation->set_message('check_unique_emp_id', '<b>' . $emp_unique_id1 . '</b> ' . $this->lang->line('emp_unique_id_allready_exit_message'));
            return false;
        }
    }

    function check_unique_emp_loginid($str) {
        $emp_unique_loginid1 = $this->input->post('emp_login_id');
        if ($this->uri->segment(3) != '') {
            $cnt = 1;
            $is_users = get_list(EMPLOYEES, NULL, array('emp_login_id' => $emp_unique_loginid1, 'emp_id !=' => $this->uri->segment(3)));
        } else {
            $cnt = 0;
            $is_users = get_list(EMPLOYEES, NULL, array('emp_login_id' => $emp_unique_loginid1));
        }
        if ($cnt < count($is_users)) {
            $this->form_validation->set_message('check_unique_emp_loginid', '<b>' . $emp_unique_loginid1 . '</b> ' . $this->lang->line('emp_unique_loginid_allready_exit_message'));
            return false;
        }
    }
    
    function check_unique_emp_email($str) {
        $emp_unique_loginid3 = $this->input->post('emp_email');
        if ($this->uri->segment(3) != '') {
            $cnt = 1;
            $is_users = get_list(EMPLOYEES, NULL, array('emp_email' => $emp_unique_loginid3, 'emp_id !=' => $this->uri->segment(3)));
        } else {
            $cnt = 0;
            $is_users = get_list(EMPLOYEES, NULL, array('emp_email' => $emp_unique_loginid3));
        }
        if ($cnt < count($is_users)) {
            $this->form_validation->set_message('check_unique_emp_email', '<b>' . $emp_unique_loginid3 . '</b> ' . $this->lang->line('emp_unique_email_allready_exit_message'));
            return false;
        }
    }
	
	function add($id){
		$data['advo_types_array'] = $advocate_type = $this->advocate_model->get_advocate_type(array('adm_name'), array('adm_id' => $id));
		$data['title'] = $advocate_type['adm_name'];
        $data['title_tab'] = 'Add new';
		$data['page_title'] = 'Manage advocate';
        $data['is_page_edit'] = 1;
        $data['type'] = $id;
		$data['module_name'] = "advocates";
        $data['view_file'] = "advocates/advocates_user";
        $this->template->index($data);
	}
	
	function view($id){
		
	}

    function alpha_dash_space($str) {
        //return (! preg_match("/^([-a-z_ ])+$/i", $str)) ? FALSE : TRUE;
        if (!preg_match("/^([-a-z._])+$/i", $str)) {
            $this->form_validation->set_message('alpha_dash_space', $this->lang->line('text_allow_with_space_error'));
            return false;
        }
    }

    public function delete_section($id) {
        if (isset($id) && $id != '') {
            $res = delete_data(SECTIONS, array('emp_id' => $id));
            if ($res) {
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable hideauto"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>' . $this->lang->line('delete_success_message') . '</div>');
            }
            redirect('admin/sections');
        }
    }
	
	public function edit_advocate($adv_type = null ,$id = null)
	{
		$data = array();
		$advocate_ids = array();
		$data['advo_types_array'] = get_advo_notary_list();
		foreach($data['advo_types_array'] as $advo_types){
				$advocate_ids[] = $advo_types['adm_id'];
		}
		$dctr_charater_certificate_fileata['advo_ids'] = $advocate_ids;
		$post_type  = !empty($adv_type)?$adv_type:$this->input->post('advocate_post_type');
		$advocat_type = get_row("SELECT adm_name,adm_id  FROM `ft_advocate_name_master` WHERE `adm_id`=$post_type");
        $this->load->helper(array('form', 'url'));
        
	    $data['title'] = $advocat_type['adm_name'];
        $data['title_tab'] = $this->lang->line('manage_emp_sub_heading');
        if ($id == null) {
            $data['page_title'] = $this->lang->line('emp_add_heading');
            $data['is_page_edit'] = 1;
        } else {
            $data['page_title'] = $this->lang->line('emp_edit_heading');
            $data['is_page_edit'] = 0;
        }
		 $this->form_validation->set_rules('scm_name_hi', 'scm_name_hi', 'required');
		// $this->form_validation->set_rules('advocate_post_type', 'advocate_post_type', 'required');
		 $this->form_validation->set_rules('scm_gender', 'scm_gender', 'required');
		
		
		if($adv_type != 9){
			
			 $this->form_validation->set_rules('scm_address_hi', 'scm_address_hi', 'required');
			 //$this->form_validation->set_rules('once_registration_number_council', 'once_registration_number_council', 'required');
			
		}
		
		if($adv_type != 9){
			 //$this->form_validation->set_rules('advocate_type', 'advocate_type', 'required');
			 $this->form_validation->set_rules('scm_state_id', 'scm_state_id', 'required');
			 $this->form_validation->set_rules('scm_district_id', 'scm_district_id', 'required');
			 $this->form_validation->set_rules('scm_tahsil_id', 'scm_tahsil_id', 'required');
		}
		if($adv_type == 9){
			$this->form_validation->set_rules('home_district', 'home_district', 'required');
			 $this->form_validation->set_rules('residential_address', 'residential_address', 'required');
			 $this->form_validation->set_rules('marti_no', 'marti_no', 'required');
			 $this->form_validation->set_rules('roll_no', 'roll_no', 'required');
			 $this->form_validation->set_rules('total_interview', 'total_interview', 'required');
		}
		//pr($this->input)
         $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		if ($this->form_validation->run($this) == TRUE) {
		
			$advocate_master = array(
				
				'scm_name_en' 		=> $this->input->post('scm_name_en'),
				'scm_name_hi' 		=> $this->input->post('scm_name_hi'),
				'scm_post_en' 		=> $this->input->post('advocate_designation'),
				'scm_post_hi' 		=> $this->input->post('advocate_designation'),
				'scm_address_en' 	=> $this->input->post('scm_address_en'),
				'scm_address_hi' 	=> $this->input->post('scm_address_hi'),
				'scm_pincode' 		=> $this->input->post('scm_pincode'),
				
				//'scm_court_name_hi' => $this->input->post('scm_court_name_hi'),
				//'scm_court_name_en' => $this->input->post('scm_court_name_hi'),
				
				'advocate_type' 	=> isset($_POST['advocate_type'])?$this->input->post('advocate_type'):null,
				'advocate_post_type' => $this->input->post('advocate_post_type'),
				'advocate_designation' => $this->input->post('advocate_designation'),
				'scm_state_id' 		=> $this->input->post('scm_state_id'),
				'scm_district_id' 	=> $this->input->post('scm_district_id'),
				'scm_tahsil_id' 	=> isset($_POST['scm_tahsil_id'])?$this->input->post('scm_tahsil_id'):0,
				'scm_taluka_id' 	=> isset($_POST['scm_taluka_id'])?$this->input->post('scm_taluka_id'):0,
				'creator_id' 		=> emp_session_id(),
				'status' 			=> 	1 ,
				'scm_gender' 		=> $this->input->post('scm_gender'),
				'scm_dob'	 		=> isset($_POST['scm_dob'])?date('Y-m-d',strtotime($_POST['scm_dob'])):'',
				'email_id' 			=> $this->input->post('email_id'),
				'scm_father_name_hi'=> $this->input->post('scm_father_name_hi'),
				'scm_father_name_en'=> $this->input->post('scm_father_name_hi'),
				'contact_no' 		=> $this->input->post('contact_no'),
				'provision_pirod' =>  $this->input->post('provision_pirod'),
				'once_registration_number_council' =>  $this->input->post('once_registration_number_council'),
				'notery_registration_no' =>  $this->input->post('notery_registration_no'),
				
			);
		//pr($advocate_master);
			$condition_1 = array('scm_id' => $this->input->post('scm_id') );
			updateData(ADVOCATE_MASTER, $advocate_master, $condition_1) ;
			//die;
				$advocate_service_record = array(
				'advocate_file_cr_no' 		=> $this->input->post('advocate_file_cr_no'),
				'adv_work_experiance' 		=> $this->input->post('adv_work_experiance'),
				'email_id' => $this->input->post('email_id'),
				'contact_no' => $this->input->post('contact_no'),
				'order_no' => $this->input->post('adv_order_no'),
				
				
				 'order_date' => !empty($_POST['adv_order_date'])? date('Y-m-d' , strtotime( $this->input->post('adv_order_date') )):'0000-00-00',
				 'stamp_no' => $this->input->post('stamp_no'),
				 'stamp_date' => !empty($_POST['stamp_date'])? date('Y-m-d' , strtotime( $this->input->post('stamp_date'))):'0000-00-00',
				 'posting_date' => !empty($_POST['posting_date'])? date('Y-m-d' , strtotime( $this->input->post('posting_date'))):'0000-00-00',
				 'post_renew_date' => !empty($_POST['post_renew_date'])?  date('Y-m-d' , strtotime(  $this->input->post('post_renew_date'))) :'0000-00-00',
				 'application_for_renewal_date' =>  !empty($_POST['application_for_renewal_date'])?  date('Y-m-d' , strtotime(  $this->input->post('application_for_renewal_date'))):'0000-00-00',
				 'adv_invoice_date' 	=> date('Y-m-d' ,  strtotime( $this->input->post('adv_invoice_date'))),
				 'adv_invoice_date' => date('Y-m-d' ,  strtotime( $this->input->post('adv_invoice_date'))),
				'state_id' => $this->input->post('state_id'),
				'city_id' =>  $this->input->post('city_id'),
				'city_id' =>  $this->input->post('city_id'),
				'package_amount' =>  $this->input->post('adv_appointment_posting_date'),
				'provision_pirod' =>  $this->input->post('provision_pirod'),
				'lokabhiyojak_work' =>  $this->input->post('adv_appointment_posting_date'),
				'asr_current_status' => 'crnt',
				'updated_date' => date('Y-m-d'),
				'adv_remarke' =>  $this->input->post('adv_remarke'),
				'adv_invoice_no' => $this->input->post('adv_invoice_no'),				
			);
			
			 $condition_2 = array('asr_scm_id' => $this->input->post('scm_id'));
			updateData(ADVOCATE_SERVICE_RECORD, $advocate_service_record, $condition_2) ;
			if($adv_type == 9){
			 $advocate_attachment = array(
				        'marti_no'                       => $this->input->post('marti_no'),
                        'roll_no'                        => $this->input->post('roll_no'),
                        'home_district'                  => $this->input->post('home_district'),
                        'residential_address'            => $this->input->post('residential_address'),
                        'total_marks_written'            => $this->input->post('total_interview'),
                     	'fitness_file_upload_path'       => $this->input->post('attach_fitness_cert_status'),
                     	'category_name'                  => $this->input->post('cast_category'),
                      
			);
				
			
				if($_FILES['charater_certificate_file']['name'] && $this->input->post('character_cert_status') == 'y' ){
					 $file_name_character =  do_upload('charater_certificate_file',  './uploads/civil_judge/' );
					
					$advocate_attachment['is_character_cert_verify'] = $this->input->post('character_cert_status') ;
					 $advocate_attachment['character_cert_upload_path']   =  $file_name_character  ;
				}else{
					$advocate_attachment['attach_fitness_cert_status'] = $this->input->post('character_cert_status') ;
				}
			
				if($_FILES['cast_category_file']['name'] && $this->input->post('cast_category_cert_status') == 'y'  ){
					 $file_name_character =  do_upload('cast_category_file',  './uploads/civil_judge/' );
					 $advocate_attachment['is_cast_cert_upload'] = $this->input->post('cast_category_cert_status') ;
					 $advocate_attachment['cast_cert_upload_path']   =  $file_name_character ;
				}else{
					 $advocate_attachment['is_cast_cert_upload'] = $this->input->post('cast_category_cert_status') ;
				}
			 	if($_FILES['non_opjection_cert_file']['name'] && $this->input->post('non_opjection_cert_status') == 'y' ){
					 $file_name_noc =  do_upload('non_opjection_cert_file',  './uploads/civil_judge/' );
					
					$advocate_attachment['non_opjection_cert_status'] = $this->input->post('non_opjection_cert_status') ;
					 $advocate_attachment['non_opjection_cert_path']   =  $file_name_noc  ;
				}else{
					$advocate_attachment['non_opjection_cert_status'] = $this->input->post('non_opjection_cert_status') ;
				}
			
			
				if($_FILES['physical_handicap_certificate']['name'] && $this->input->post('attach_fitness_cert_status') == 'y' ){
					 $file_name_character =  do_upload('physical_handicap_certificate',  './uploads/civil_judge/' );
					
					$advocate_attachment['physical_handicap_certificate'] = $this->input->post('character_cert_status') ;
					 $advocate_attachment['character_cert_upload_path']   =  $file_name_character  ;
				}else{
					$advocate_attachment['attach_fitness_cert_status'] = $this->input->post('attach_fitness_cert_status') ;
				}
			    $condition_3 = array('sci_id' => $this->input->post('scm_id'));
				$responst_1= updateData(ADVOCATE_ATTACHMENT, $advocate_attachment, $condition_3) ;
			}
			
           if($this->input->post('total_row')){ 
				$total_row = $this->input->post('total_row');
				
				/*if($this->input->post('total_row')){
			        $this->advocate_model->delete_judgecharacter($id);
			    }*/
				for($s=0; $s < $total_row; $s++){
					
				    $_FILES['charater_certificate_ctr']['name'] = $_FILES['ctr_charater_certificate_file']['name'][$s];
					$_FILES['charater_certificate_ctr']['type'] = $_FILES['ctr_charater_certificate_file']['type'][$s];
					$_FILES['charater_certificate_ctr']['tmp_name'] = $_FILES['ctr_charater_certificate_file']['tmp_name'][$s];
					$_FILES['charater_certificate_ctr']['error'] = $_FILES['ctr_charater_certificate_file']['error'][$s];
					$_FILES['charater_certificate_ctr']['size'] = $_FILES['ctr_charater_certificate_file']['size'][$s];
					
					$uploadPath = './uploads/civil_judge/character_certificate/';
					$config['upload_path'] = $uploadPath;
					$config['allowed_types'] = 'pdf';
					//pre($_FILES['charater_certificate_ctr']);
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
						if($this->upload->do_upload('charater_certificate_ctr') && $_FILES['charater_certificate_ctr']!='error'){
							$fileData = $this->upload->data();
							$uploadData[$s]['file_name'] = $fileData['file_name'];
							$ctr_state_id = $_POST['ctr_state_id'][$s];
							$ctr_district_id = $_POST['ctr_district_id'][$s];
							$charater_array = array(
										'judge_id' =>	$id,
										'state_id' => $ctr_state_id,
										'district_id' => $ctr_district_id,
										'upload_file_name' => $uploadData[$s]['file_name'],
									);
							
							insertData($charater_array, ADVOCATE_CIJ_CHAR_CERTIFICATE);
							//pr($charater_array);
						}else{
							
							echo "state ".$ctr_state_id = $_POST['ctr_state_id'][$s];
							$ctr_district_id = $_POST['ctr_district_id'][$s];
							$charater_array = array(
										'judge_id' =>	$id,
										'state_id' =>   $_POST['ctr_state_id'][$s],
										'district_id' => $_POST['ctr_district_id'][$s],
									);
							
							insertData($charater_array, ADVOCATE_CIJ_CHAR_CERTIFICATE);
						}
					//pr($charater_array);	
                }
			}
			if ($responst_1) {
					$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable hideauto"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>' . $this->lang->line('update_success_message') . '</div>');
					redirect('advocate/list/'.$adv_type);
			} else {
					$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable hideauto"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>' . $this->lang->line('success_message') . '</div>');
					redirect('advocate/list/'.$adv_type);
			}
			
			
		}
		$data['id'] = $id;
		$adv_details = $this->advocate_model->getadvocate_details($id ,$adv_type );
		
		$data['adv_character_details'] = $this->advocate_model->get_civijudgecharacter($id );
		$data['adv_details'] = $adv_details[0];
		$data['advocat_type']=$advocat_type;
		$data['module_name'] = "advocates";
        $data['view_file'] = "advocates/advocates_user";
        $this->template->index($data);
	}
	
    public function show_404() {
        $this->load->view('404');
    }

    public function get_supervisore_emp() {
        $roleid = $this->input->post('rold_id');
        $data = get_supervisor_list($roleid);
        //pre($data);
        echo json_encode($data);
        exit();
    }
	public function getAdvocateName()
	{
		$name_en = $this->input->post('name_en');
		$this->db->like('scm_name' , $name_en );
		$query = $this->db->get(ADVOCATE_MASTER);
		$advocates = $query->result();
		//$advocates  = get_list(ADVOCATE_MASTER, NULL, array('scm_name' => $name_hi) );
		//print_r($advocates);die;
		if(!empty($advocates)) {
		?>
		<ul id="country-list">
		<?php
		foreach($advocates as $advocate) {
		?>
		<li onClick="selectAdvocate_name_en('<?php echo $advocate->scm_name; ?>',<?php echo $advocate->scm_id; ?>);"><?php echo $advocate->scm_name; ?></li>
		<?php } ?>
		</ul>
		<?php }  
	}
			
	public function getAdvocateName_hin()
	{
		$name_hi = $this->input->post('name_hi');
		$this->db->like('scm_name_hi' , $name_hi );
		$query = $this->db->get(ADVOCATE_MASTER);
		$advocates = $query->result();
		//$advocates  = get_list(ADVOCATE_MASTER, NULL, array('scm_name' => $name_hi) );
		//print_r($advocates);die;
		if(!empty($advocates)) {
		?>
		<ul id="country-list">
		<?php
		foreach($advocates as $advocate) {
		?>
		<li onClick="selectAdvocate_name_hi('<?php echo $advocate->scm_name_hi; ?>',<?php echo $advocate->scm_id; ?>);"><?php echo $advocate->scm_name_hi; ?></li>
		<?php } ?>
		</ul>
		<?php }  
	}
		
	public function getAdvocatedetails(){
		
		$advocate_details = $this->advocate_model->getadvocate_details($this->input->post('scm_id'));
		
		echo json_encode($advocate_details);
        exit();
	}
	
	
	//tahsil list used in advocates form 
	public function getTahsil_list( ){
		$district_id = $this->input->post('district_id');
		echo get_tahsil_ddl_list('scm_tahsil_id',  'class="form-control" onchange="get_tahsil_details(this.value,this.text)" id="tahsil_val"','',$district_id );
	}
	//tahsil list used in advocates form 
	public function getaluka_list( ){
		$district_id = $this->input->post('district_id');
		echo get_taluka_ddl_list('scm_taluka_id',  'class="form-control" id="scm_taluka_id" onchange="get_taluka_details(this.value)" ' ,'',$district_id );
	}
	public function get_advocate_single( ){
		$tahsil_id = $this->input->post('tahsil_id');
		$condition = array('tahsil_id'=>$tahsil_id);
		echo get_advocate_ddl_list('advocate_name' , 
		'onchange="get_advocate_details(this.value);"', $condition);
	}
	public function get_advocate_single_by_city( ){
		$city_id = $this->input->post('city_id');
		$condition = array('city_id'=>$city_id);
		echo get_advocate_ddl_list('advocate_name' , 'onchange="get_advocate_details(this.value);"', $condition);
	}
	public function advocate_report()
	{
		$data = array();
		$data['title'] = "Report";
        $data['title_tab'] = 'Report';
		$advocate_details = $this->advocate_model->getadvocate_type();
		$data['advocate_records'] = $advocate_details;
        $data['module_name'] = "advocates";
        $data['view_file'] = "advocates/report";
        $this->template->index($data);		
	}
		
	public function get_ajax_data() {
		
		$data = array();
		$adv_type = $this->input->post('adv_type');
		$advocat_type = get_row("SELECT adm_name,adm_id  FROM `ft_advocate_name_master` WHERE `adm_id`=$adv_type");
        $data['title'] =$advocat_type['adm_name']. ' की सूची';
        $data['title_tab'] = 'सूची';
        $data['get_users'] = $this->advocate_model->get_advocate_list($adv_type,null,null,null);
		$data['adv_type'] = $adv_type;
		$this->load->view('index_ajax_table',$data); 
    }	
	
	public function getstate_list(){		
		echo get_state_ddl_list('ctr_state_id[]', ' class="form-control col-md-3"  id="ctr_state_lst"'); 
		exit();
	}
	public function getdistict_list(){		
		echo  get_distic_ddl_list('ctr_district_id[]', 'id="ctr_district_id"  class="form-control col-md-3"'); 
		exit();
	}
	public function get_registration_number()
	{
		$registration_number = $this->input->post('registration_number');
		$advocate_details = $this->advocate_model->get_registration_number($registration_number);	
		echo $advocate_details;
	}
	public function add_character_certificate($judge_id = null )
	{
		
		$character_cert_path =  do_upload('ctr_charater_certificate_file',  './uploads/civil_judge/' );
		$charater_array['upload_file_name']   =  $character_cert_path  ;
		$charater_array['judge_id'] =	$judge_id ;
		$charater_array['state_id'] = $this->input->post('ctr_state_id') ;
		$charater_array['district_id'] = $this->input->post('ctr_district_id') ;
		$responce = insertData($charater_array, ADVOCATE_CIJ_CHAR_CERTIFICATE);
		if($responce){
			redirect('advocate/list/9');
		}
	}
	public function delete_char_certificate($judge_car_id = null )
	{
		
		$responce = $this->advocate_model->delete_char_certificate($judge_car_id);
		if($responce){
			redirect('advocate/list/9');
		}
	}
	public function delete_records($judge_id = null )
	{
		
		$responce = $this->advocate_model->delete_records($judge_id);
		if($responce){
			redirect('advocate/list/9');
		}
	}
	public function get_section_number()
	{
		$section_no = $this->input->post('section_no');
		$section_no_details = $this->advocate_model->get_section_number($section_no);	
		echo $section_no_details;
	}
	public function manage_adv_panel()
	{
        $responce = $this->advocate_model->manage_panel();
        if($responce){
            redirect($_SERVER['HTTP_REFERER']);
        }
	}
	
	
	    public function manage_adv_panel_list($id_avd)
	{
        $data = array();
        $advocat_type = get_row("SELECT adm_name,adm_id  FROM `ft_advocate_name_master`");
        $data['title'] =$advocat_type['adm_name']. ' की सूची';
        $data['title_tab'] = 'सूची';
       $data['get_pannel'] = $this->advocate_model->get_panel_list($id_avd);
       // $data['get_users'] = $this->advocate_model->get_advocate_list($adv_type,null,null,null);
        $data['module_name'] = "advocates";
        $data['view_file'] = "advocates/adv_panel_list";
        $this->template->index($data);
	}
	
}
