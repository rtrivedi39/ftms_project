<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Activity_report	 extends MX_Controller {
    function __construct() {
        parent::__construct();
        $this->load->module('template');
        $this->load->language('view_file','hindi');
		$this->load->model('file_moniter_activity','activit_model');
	  $this->load->helper("report_helper");
        authorize();
    }
    public function index($id=null)
    {
        /*$section_id = getEmployeeSection();
        $section_explode =  explode(',',$section_id);
        $data = array();
        $data['title'] = $this->lang->line('view_file_manue');
        $data['title_tab'] = 'Report';
        $data['get_section'] = get_list(SECTIONS,null,null);
        $data['view_left_sidebar'] = 'admin/left_sidebar';
        $data['module_name'] = "activity_report";
        $data['view_file'] = "activity_report/sections_report";
        $this->template->index($data);
		*/
		$start_date = $end_date = date('Y-m-d');
		if($this->input->post('start_date') != ''){
			$start_date = $this->input->post('start_date');
		}
		if($this->input->post('end_date') != ''){
			$end_date = $this->input->post('end_date');
		}
		
		$userrole = checkUserrole();
		$section_id = $this->session->userdata('emp_section_id');
        $section_explode =  explode(',',$section_id);
		//pre($section_explode);
        $data = array();
        $data['title'] = $this->lang->line('view_file_manue');
        $data['title_tab'] = 'Report';
		$data['get_section'] = get_list_with_in(SECTIONS,null,'section_id',$section_explode);
        $data['view_left_sidebar'] = 'admin/left_sidebar';
        $data['start_date'] = "activity_report";
        $data['start_date'] = get_date_formate($start_date, 'Y-m-d');
        $data['end_date'] = get_date_formate($end_date, 'Y-m-d');
		$data['datewise_report'] = false;
		if($userrole < '9' || in_array($userrole, array('11','15','14','37'))){ 
			$data['view_file'] = "activity_report/sections_report";
		} else {
			redirect('individual_reports');
		}
        $this->template->index($data);
    } 
	
	public function datewise_report()
    {
		
        $start_date = $end_date = date('Y-m-d');
		if($this->input->post('start_date') != ''){
			$start_date = $this->input->post('start_date');
		}
		if($this->input->post('end_date') != ''){
			$end_date = $this->input->post('end_date');
		}
		
		$userrole = checkUserrole();
		$section_id = $this->session->userdata('emp_section_id');
        $section_explode =  explode(',',$section_id);
		//pre($section_explode);
        $data = array();
        $data['title'] = $this->lang->line('view_file_manue');
        $data['title_tab'] = 'Report';
		$data['emp_section_ids']  = $section_id;
		//$data['get_section'] = get_list_with_in(SECTIONS,null,'section_id',$section_explode);
        $data['start_date'] = get_date_formate($start_date, 'Y-m-d');
        $data['end_date'] = get_date_formate($end_date, 'Y-m-d');
        $data['datewise_report'] = true;
		$data['view_file'] = "activity_report/sections_report";

        $this->template->index($data);
		
    }
	
	public function employee_report()
    {
		
        $start_date = $end_date = date('Y-m-d');
		if($this->input->post('start_date') != ''){
			$start_date = $this->input->post('start_date');
		}
		if($this->input->post('end_date') != ''){
			$end_date = $this->input->post('end_date');
		}
		
		$userrole = checkUserrole();
		$section_id = $this->session->userdata('emp_section_id');
        $section_explode =  explode(',',$section_id);
		//pre($section_explode);
        $data = array();
        $data['title'] = $this->lang->line('view_file_manue');
        $data['title_tab'] = 'Report';
		
		//$data['get_section'] = get_list_with_in(SECTIONS,null,'section_id',$section_explode);
        $data['start_date'] = get_date_formate($start_date, 'Y-m-d');
        $data['end_date'] = get_date_formate($end_date, 'Y-m-d');
        $data['datewise_report'] = true;
		$data['view_file'] = "activity_report/employee_report";

        $this->template->index($data);
		
    }

    //rp
    public function return_fileofficer($file_id = null)
    {
        $query = $this->db->query("SELECT `emp_id`,`emp_full_name` FROM `ft_employee` WHERE `emp_id` in (SELECT DISTINCT `fmove_previous_user_id` FROM `ft_file_movements` WHERE `fmove_file_id`=".$file_id." and fmove_id < (SELECT `fmove_id` FROM `ft_file_movements` WHERE `fmove_file_id`=".$file_id." and `fmove_previous_user_id`=".$this->session->userdata('emp_id')." LIMIT 1)) and `emp_id` != ".$this->session->userdata('emp_id')." order by emp_id asc");
        $res_array =  $query->result_array();
        echo json_encode($res_array);
        exit();
    }
    public function section_da_name()
    {
        $res_1 = $this->view_file->get_DAname($this->session->userdata('emp_section_id'));
        echo json_encode($res_1);
        exit();
    }
    public function upper_role_officer($file_id = null)
    {
        $role1 = empdetails($this->session->userdata('emp_id'));
        $filedetails =  getFileDetails($file_id);
        $query = $this->db->query("SELECT ft_employee.emp_full_name, ft_employee.emp_id , ft_emprole_master.emprole_name_hi FROM ft_employee inner join ft_emprole_master on ft_emprole_master.role_id =  ft_employee.role_id  WHERE FIND_IN_SET($filedetails->file_mark_section_id, emp_section_id) AND ft_employee.role_id < ".$role1[0]['role_id']." AND ft_employee.role_id != '1' order by ft_employee.role_id desc");
        $res_array1 =  $query->result_array();
        echo json_encode($res_array1);
        exit();
    }

    public function fetch_data($section_id = null)
    {
        // if we want to load on same page by jquery
       //$data['sce_id'] = $section_id;
       //$this->load->view('activity_report/fetch_data',$data);

    // different page
        $data = array();
        $data['title'] = 'Report';
        $data['title_tab'] = 'Report';
        $data['get_section'] = get_list(SECTIONS,null,array('section_id' => $section_id));
        $data['view_left_sidebar'] = 'admin/left_sidebar';
        $data['module_name'] = "activity_report";
        $data['view_file'] = "activity_report/fetch_data_diffpage";
        $this->template->index($data);

    }
	
	public function fetch_data_cr()
    {
		$start_date = $end_date = date('Y-m-d');
		if($this->input->post('start_date') != ''){
			$start_date = $this->input->post('start_date');
		}
		if($this->input->post('end_date') != ''){
			$end_date = $this->input->post('end_date');
		}
        $data = array();
        $data['title'] = 'Report';
        $data['title_tab'] = 'Report';
        $data['get_section'] = get_list(SECTIONS, null, array('section_id' => '1'));
        $data['module_name'] = "activity_report";
        $data['view_file'] = "activity_report/fetch_data_cr";
        $data['start_date'] = get_date_formate($start_date, 'Y-m-d');
        $data['end_date'] = get_date_formate($end_date, 'Y-m-d');
		
        $this->template->index($data);

    }
	
	public function index_for_admin($id=null)
    {
        $section_id  = $this->session->userdata('emp_section_id');
        $section_explode =  explode(',',$section_id);
		//pre($section_explode);
        $data = array();
        $data['title'] = $this->lang->line('view_file_manue');
        $data['title_tab'] = 'Report';
		$data['get_section'] = get_list_with_in(SECTIONS,'section_grouping','section_id',$section_explode,'asc');
        $data['module_name'] = "activity_report";
        $data['view_file'] = "activity_report/sections_report";
        $this->load->view('activity_report/sections_report_for_admin',$data);
    }
	
	public function index_datewise_report($id=null)
    {
		$section_id  = $this->session->userdata('emp_section_id');
        $section_explode =  explode(',',$section_id);
		//pre($section_explode);
        $data = array();
        $data['title'] = $this->lang->line('view_file_manue');
        $data['title_tab'] = 'Report';
		$data['get_section'] = get_list_with_in(SECTIONS,'section_grouping','section_id',$section_explode,'asc');
        $data['module_name'] = "activity_report";
        $data['view_file'] = "activity_report/sections_report";
        $this->load->view('activity_report/datewise_report',$data);
    }
	
	
	public function employee_officer_report($task){
		$data = array();
        $data['title'] = 'Report';
        $data['title_tab'] = 'Officer Level Report';
        
        $data['view_left_sidebar'] = 'admin/left_sidebar';
		if($task=='officer'){
			$condition=" emp.role_id=7 and emp.emp_status=1 and emp.emp_is_retired=0 and emp.emp_posting_location=1 ";
			$data['employees_list'] =$this->activit_model->get_employee_role_sectionwise($task,$condition) ;
			
			$condition1=" emp.role_id=6 and emp.emp_status=1 and emp.emp_is_retired=0 and emp.emp_posting_location=1 ";
			$data['deputy_secratory_list'] =$this->activit_model->get_employee_role_sectionwise($task,$condition1) ;
			
			$condition2=" emp.role_id=5 and emp.emp_status=1 and emp.emp_is_retired=0 and emp.emp_posting_location=1 ";
			$data['additional_secratory_list'] =$this->activit_model->get_employee_role_sectionwise($task,$condition2) ;
			
			$condition3=" emp.role_id=4 and emp.emp_status=1 and emp.emp_is_retired=0 and emp.emp_posting_location=1 ";
			$data['secratory_list'] =$this->activit_model->get_employee_role_sectionwise($task,$condition3) ;
			
			$condition4=" emp.role_id=3 and emp.emp_status=1 and emp.emp_is_retired=0 and emp.emp_posting_location=1";
			$data['pricipal_secratory_list'] =$this->activit_model->get_employee_role_sectionwise($task,$condition4) ;
		}
		$data['module_name'] = "activity_report";
        $data['view_file'] = "activity_report/officer_emp_report";
        $this->template->index($data);		
		}
	
	public function file_report() /*Show all section level report*/
    {
        $data = array();
        $data['title'] = 'Report';
        $data['title_tab'] = 'Report';
        $data['get_section'] = get_list_with_in(SECTIONS,'section_name_en','section_id not',array(1,26,8,25));
        $data['view_left_sidebar'] = 'admin/left_sidebar';
        $data['module_name'] = "activity_report";
        $data['view_file'] = "activity_report/file_report_all_section";
        $this->template->index($data);

    }
	//used for individual_reports 
	public function individual_reports(){
		$emp_section = $this->session->userdata('emp_section_id');
		$emp_id = $this->input->post('user_type') != '' ? $this->input->post('user_type') : '';
		$data = array();		
        $data['title'] = 'Report';
        $data['title_tab'] = 'Individual report worked by you on files';
		$data['module_name'] = "activity_report";
        $data['view_file'] = "activity_report/individual_reports";
		if($emp_id == ''){
			$data['userid']  = emp_session_id();
			$data['userid_sec']  = $emp_section;
		} else {
			$data['userid']  = $emp_id;
			$data['userid_sec']  = getEmployeeSection($emp_id);
		}
		
		$data['today'] = date('Y-m-d');
        $this->template->index($data);
	}
	
 // used for get uncer employee name update 21-04-2016 as per induvidual report
function get_emloyees_section(){
		$section_id = $this->input->post('section_id');
		$emp_role = $this->session->userdata('user_designation');	
		$emp_asrole = $this->session->userdata('user_role');		
		//if($emp_role<=)
		$tbl_files = EMPLOYEES;
        $this->db->select($tbl_files.'.emp_id,designation_id,emp_full_name,emp_full_name_hi,emprole_name_hi,emp_detail_gender');
		$this->db->join('ft_employee_details', $tbl_files.'.emp_id = ft_employee_details.emp_id');
		$this->db->join('ft_emprole_master', $tbl_files.'.designation_id = ft_emprole_master.role_id');
		if($section_id=='officers'){
			$this->db->where("(ft_employee.designation_id >= $emp_role AND ft_employee.designation_id < 8  AND ft_employee.role_id !=1 AND emp_status ='1' AND emp_is_retired = '0' AND emp_posting_location ='1') or (ft_employee.role_id='11')");
		}else if($section_id == 'pa'){
			$this->db->where("(ft_employee.designation_id in (12,13,25,27) AND emp_status ='1' AND emp_is_retired = '0' AND emp_posting_location ='1')");
		}else{
			if($emp_asrole == 11){
			$this->db->where("FIND_IN_SET('$section_id',`emp_section_id`) AND  `ft_employee`.designation_id >= 8 AND emp_status ='1' AND `ft_employee`.role_id!='11' AND emp_is_retired = '0' AND emp_posting_location ='1'  and  `ft_employee`.designation_id not in (1,2,27,28,29,30,33,34,38,36,40,42,43,44)");
			}else if($emp_asrole == '37'){
					$this->db->where("FIND_IN_SET('$section_id',`emp_section_id`) AND  emp_status ='1' AND `ft_employee`.designation_id!='11' AND emp_is_retired = '0' AND emp_posting_location ='1' and   `ft_employee`.designation_id in (16,17,18,19,20,21,22,23,24,25,26,27,31,32)");
			} else {
				$this->db->where("FIND_IN_SET('$section_id',`emp_section_id`) AND  `ft_employee`.designation_id > $emp_role AND emp_status ='1' AND `ft_employee`.designation_id!='11' AND emp_is_retired = '0' AND emp_posting_location ='1' and   `ft_employee`.designation_id not in (1,2,27,28,29,30,33,34,38,36,40,42,43,44)");
			} 
			
		}
		$this->db->order_by($tbl_files.'.designation_id','asc');
		$this->db->order_by($tbl_files.'.emp_full_name','desc');
        $query = $this->db->get($tbl_files);
        //echo   $this->db->last_query();
        $emplyees =  $query->result_array();       
        // $emplyees = get_list(EMPLOYEES, 'designation_id', "FIND_IN_SET('$section_id',`emp_section_id`) AND role_id > $emp_role AND emp_status ='1' AND emp_is_retired = '0'", 'ASC');
        echo json_encode($emplyees);
        exit();
	}
	public function work_done_report(){
		
		$data = array();	
		$report_type = $this->input->post('report_type') != '' ? $this->input->post('report_type') : null ;
		$report_year = $this->input->post('report_year') != '' ? $this->input->post('report_year') : null ;
		$report_month = $this->input->post('report_month') != '' ? $this->input->post('report_month') : null ;
		$emp_id = $this->input->post('user_type') != '' ? $this->input->post('user_type') : $this->session->userdata('emp_id') ;
		$report_date =  $this->input->post('report_date') != '' ?  get_date_formate($this->input->post('report_date'), 'Y-m-d') : null;
		$report_date_end =  $this->input->post('report_date_end') != '' ?  get_date_formate($this->input->post('report_date_end'), 'Y-m-d') : null;
		
		if(!empty($report_type)){	
			$data['work_report_list'] = $this->activit_model->get_work_done_report($emp_id ,$report_type, $report_year, $report_month, $report_date, $report_date_end);
		}else {
			$data['work_report_list'] = null;
		}
		$data['form_input'] = $this->input->post();
		$data['title'] = 'Report';
		$data['title_tab'] = 'Work done report';
		$data['module_name'] = "activity_report";
        $data['view_file'] = "activity_report/work_done_report";
		
        $this->template->index($data);
	}
	
	public function save_work_done_report($sd = null, $ed = null, $time = null){
		$result = array();
		$run_time = !empty($time) ? $time : '10:00:00'; 
		$currnt_time =  date('H:i:s');
		$today = !empty($ed) ? $ed : date('2015-09-24'); //date('Y-m-d');
		$last_date = !empty($sd) ? $sd  : date('2015-09-23'); //$this->activit_model->get_last_update_date();
		$begin = new DateTime($last_date);
		$end = new DateTime($today);
		
		if($currnt_time > $run_time){
			if($begin){
				if(strtotime($last_date) < strtotime($today)){
					$interval = DateInterval::createFromDateString('1 day');
					$period = new DatePeriod($begin, $interval, $end);

					foreach ( $period as $dt ){
						$date = $dt->format('Y-m-d');
						$users_list = $this->activit_model->get_all_users();
												
						foreach ( $users_list as $value ){
							$work_report_list = $this->activit_model->get_work_done_report($value->emp_id ,$date, $date, $value->role_id, true);
							
							$data = array(
								'work_date' => $date,
								'work_emp_id' => $value->emp_id,
								'work_total' => (empty($work_report_list[0]['total_files']) ? 0 : $work_report_list[0]['total_files']),
								'work_tip_add' => (empty($work_report_list[0]['total_tip']) ? 0 : $work_report_list[0]['total_tip']),
							);
							
							$result[] = insertData($data, 'ft_work_done_report');
						}
					}
					pr(count($result) .' record inserted succesfully!');
				} else{
					pr('Data already updated!');
				}
			} else{
				pr('Last date not found!');
			}
		} else{
			pr('You can run after 6 PM only');
		}
	}
}