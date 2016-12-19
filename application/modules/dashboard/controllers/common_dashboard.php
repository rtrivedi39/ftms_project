<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Common_dashboard extends MX_Controller {

     function __construct() {
        parent::__construct();
        $this->load->module('template');
        $this->load->model('common_dashboard_model','dashboard_model');
        $this->load->language('common_dashboard','hindi');
		//$this->load->model('leave/leave_model');
		$this->load->language('leave','hindi');
    }
	 public function isLoggedIn()
    {
        if (($this->session->userdata('admin_logged_in') === false) && ($this->session->userdata('is_logged_in') === false))
        {
            redirect("home");
        }
    }
 	public function index()
    {
		no_cache(); 
		//print_r($this->session->all_userdata());		
        $this->isLoggedIn();
        $data = array();
        $data['title']          = $this->lang->line('title');
        $data['title_tab']      = $this->lang->line('emprole_all_unit_list'); 
		$emp_section = $this->session->userdata('emp_section_id');
			/* if($emp_section == 8){
           $dispetch_files_counter =  $this->dashboard_model->getTotalFile_dispetch();  not in use
            $data['total_file']=$dispetch_files_counter['total_files_in_dis'];
            $data['pending_file']=$dispetch_files_counter['total_pending_files_in_dis']+$dispetch_files_counter['total_working_files_in_dis'];
            $data['dispetch_file']=$dispetch_files_counter['total_close_files_in_dis'];
        }else{
            $data['total_file']   	= $this->dashboard_model->getTotalFile();
    		$data['dispetch_file']	= $this->dashboard_model->getDispatchFile();
    		$data['pending_file'] 	= $data['total_file'] - $data['dispetch_file'];
    		$data['leaves'] 		= $this->leave_model->getLeaves();
    		$data['pending_files']  = $this->dashboard_model->getPendingfilesDetails();
        } */
		$setion_id 	= $emp_section;
		//$data['notice_boards']= getNoticeBoardInformation($setion_id);
		$data['emp_section_ids']  = $emp_section;
		//$data['userid']  = emp_session_id();
		$data['userid_sec']  = $emp_section;
		$data['start_date'] = date('Y-m-d');
		$data['end_date'] = date('Y-m-d');
		$data['module_name']    = "dashboard";
        $data['view_file']      = "dashboard/index";
        $this->template->index($data);
    }
    public function show_detail($task)
    {
        no_cache(); 
        $this->isLoggedIn();
		$emp_section = $this->session->userdata('emp_section_id');
        $data = array();
        $data['title']          = $this->lang->line('title');
        $data['title_tab']      = $this->lang->line('emprole_all_unit_list'); 
        $setion_id              = $emp_section;
        $data['module_name']    = "dashboard";
        $data['view_file']      = "dashboard/dashboard_detail";
        $this->template->index($data);
    }

    public function show_camra(){
        $addr = "C:\Program Files (x86)\MySQL\MySQL Workbench 6.0 CE/MySQLWorkbench.exe";
        //$addr = "C:\Program Files\iVMS-4200 Station\iVMS-4200\iVMS-4200 Client\iVMS-4200.exe";
        exec($addr,$output, $return);
    }
    public function show_biomartrics(){
		echo 'b';
        //echo $addr = "C:\Program Files (x86)\Business Attendance\Business Attendance.exe";
        $addr = "C:\Program Files (x86)\Adobe\Reader 11.0\Reader\AcroRd32.exe";
       // $output = "C:\Program Files (x86)\Adobe\Reader 11.0\Reader\AcroRd32.exe";
        //exec($addr,$output,$return);
		exec('runas /user:SULBHA\phpitlaw2015 "C:\Program Files (x86)\Adobe\Reader 11.0\Reader\AcroRd32.exe"');
        //system($addr);
		//echo $dd = shell_exec("C:\Program Files (x86)\Adobe\Reader 11.0\Reader\AcroRd32.exe -args");
		pre($output);
		//echo '<br/>'. $return;
    }
	
	//for search report
	public function dashboard_report(){		
		$emp_section = $this->session->userdata('emp_section_id');
		$this->form_validation->set_rules('start_date', 'कृपया इसे चुने', 'required');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        if ($this->form_validation->run($this) == TRUE ) {   
			$data['start_date'] = get_date_formate($this->input->post('start_date'),'Y-m-d');
			$data['end_date'] = get_date_formate($this->input->post('end_date'),'Y-m-d');
		} else{			
			$data['start_date'] = date('Y-m-d');
			$data['end_date'] = date('Y-m-d');
		}
		$data['emp_section_ids']  = $emp_section;
		$data['userid']  = $this->input->post('user_id')!= '' ? $this->input->post('user_id') : emp_session_id();
		$data['userid_sec']  = $emp_section;
		$data['form_input'] = $this->input->post();
		$data['module_name']    = "dashboard";
        $data['view_file']      = "dashboard/index";
        $this->template->index($data);
	}
	
    public function show_404() {
         $this->load->view('404');
 	}
}