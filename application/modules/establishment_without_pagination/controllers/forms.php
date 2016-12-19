<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Forms extends MX_Controller {
     function __construct() {
        parent::__construct();
        $this->load->module('template');
        $this->load->model('form_model');
        $this->load->helper('establishment');
		 $this->load->model('est_category_master_model', 'est_category_model');
        $this->load->language('est_forms','hindi');
		$this->load->model('est_model');

    }
 	public function index()
    {
        $data = array();
        $data['title'] = $this->lang->line('forms_title');
        $data['title_tab'] = $this->lang->line('forms_sub_title');
		$data['is_page_edit'] = false;
		$data['get_all_cat']= $this->form_model->get_category();
		/*if(check_est_so()){
			$data['get_all_cat']= $this->form_model->get_category();
		} else {
			$data['get_category_list']= $this->form_model->get_alloted_category();
		}*/
       
       
        $data['module_name'] = "establishment";
        $data['view_file'] = "forms";
        $this->template->index($data);
    }
	
	public function add_from($id)
    {
        $data = array();
		$data['is_page_edit'] = false;
		switch($id){
			case 1:
				$data['title'] = $this->lang->line('add_forms_title');
				$data['title_tab'] = $this->lang->line('add_forms_sub_title');
				$form = 'add_form';
			break;
			case 2:
				$data['title'] = $this->lang->line('add_forms_title');
				$data['title_tab'] = $this->lang->line('add_forms_sub_title');
				$form = 'add_form';
			break;
			case 31:
				 $data['title'] = 'बिल फॉर्म';
				$data['title_tab'] = 'बिल फॉर्म';
				$form = 'bill_form';
			break;
			case 30:
				 $data['title'] = 'बजट फॉर्म';
				$data['title_tab'] = 'बजट फॉर्म';
				$form = 'budget_form';
			break;
			case 53:
				 $data['title'] = 'डी पी एफ फॉर्म';
				$data['title_tab'] = 'डी पी एफ फॉर्म';
				$form = 'dpf_form';
			break;
			case 36:
				$data['title'] = 'मेडिकल फॉर्म';
				$data['title_tab'] = 'मेडिकल फॉर्म';
				$form = 'medical_form';
			break;
			default:
				 $data['title'] = $this->lang->line('add_forms_title');
				 $data['title_tab'] = $this->lang->line('add_forms_sub_title');  
				$form = 'common_form';
			break;
			
		}
        $data['module_name'] = "establishment";
        $data['view_file'] = 'forms/'.$form;
        $this->template->index($data);
    }
    
	


	public function get_employee_designation()
	{
		$emp_id = $this->input->post('emp_id');
		$employee_detail = get_list(EMPLOYEES, null, array('emp_id' => $emp_id));
		$role_id = $employee_detail[0]['role_id'];
		//print_R($role_id);die;
		$designation = get_list(EMPLOYEEE_ROLE, null, array('role_id' => $role_id));
		echo  $designation[0]['emprole_name_hi'];
	}



	public function show_404() {
        $this->load->view('404');
 	}
}