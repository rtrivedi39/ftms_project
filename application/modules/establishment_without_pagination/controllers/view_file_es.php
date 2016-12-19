<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class View_file_es	 extends MX_Controller {
    function __construct() {
        parent::__construct();
        $this->load->module('template');
        $this->load->language('view_file','hindi');
        $this->load->model('view_file_model','view_file');
		$this->load->model('complaint_model');
		$this->load->model('est_model');
        authorize();
    }
    public function index($id=null)
    {
        $section_id = getEmployeeSection();
        $section_explode = explode(',', $section_id);
        $data = array();
        $data['title'] = $this->lang->line('view_file_manue');
        if ($id == 'return') {
            $data['title_tab'] = $this->lang->line('return_file_show');
        } else if ($id == '1') {
            $data['title_tab'] = $this->lang->line('dealing_file_show');
        } else {
            $data['title_tab'] = $this->lang->line('received_files');
        }
            $moveup_down = $id;
		$section_search_id = $this->input->get('section_id');
		if($section_search_id){
			$data['get_files'] = $this->view_file->getFiles($section_explode, $moveup_down, $section_search_id);
		}
		else{
			$data['get_files'] = $this->view_file->getFiles($section_explode, $moveup_down);
		}
           
        $data['view_file'] = "establishment/es_view_index";

        $data['view_left_sidebar'] = 'admin/left_sidebar';
        $this->template->index($data);
    }

    public function section_user_name_es()
    {
        $res_1 = get_establishment_employees_with_des();
        echo json_encode($res_1);
        exit();
    }

    public function return_fileofficer($file_id = null)
    {
        $role1 = empdetails(emp_session_id());
        // $query = $this->db->query("SELECT `emp_id`,`emp_full_name` FROM `ft_employee` WHERE `emp_id` in (SELECT DISTINCT `fmove_previous_user_id` FROM `ft_file_movements` WHERE `fmove_file_id`=".$file_id." and fmove_id < (SELECT `fmove_id` FROM `ft_file_movements` WHERE `fmove_file_id`=".$file_id." and `fmove_previous_user_id`=".emp_session_id()." LIMIT 1)) and `emp_id` != ".emp_session_id()." and role_id !='9' order by emp_id asc");
        $query = $this->db->query("SELECT ft_employee.emp_full_name_hi, ft_employee.emp_id ,ft_employee.role_id , ft_emprole_master.emprole_name_hi , ft_sections_master.section_name_hi, ft_sections_master.section_id FROM ft_employee inner join ft_emprole_master on ft_emprole_master.role_id = ft_employee.role_id left join ft_sections_master on ft_sections_master.section_id = ft_employee.emp_section_id  WHERE ((ft_employee.role_id < '9' AND ft_employee.role_id > '".$role1[0]['role_id']."'  AND ft_employee.role_id not in ('9','1','2')) or ft_employee.role_id in ('37','14')) and ft_employee.emp_status = '1' and ft_employee.emp_is_retired = '0' order by ft_employee.role_id asc");
        $res_array =  $query->result_array();
        echo json_encode($res_array);
        exit();
    }
    // this is new function for fetch upper officer id
    public function upper_role_officer_new($file_id = null)
    {
        $role1 = empdetails(emp_session_id());
        $query = $this->db->query("SELECT ft_employee_details.emp_detail_gender, ft_employee.emp_full_name, ft_employee.emp_id , ft_emprole_master.emprole_name_hi FROM ft_employee inner join ft_employee_details on ft_employee_details.emp_id = ft_employee.emp_id inner join ft_emprole_master on ft_emprole_master.role_id =  ft_employee.role_id WHERE (ft_employee.role_id < 8 || ft_employee.role_id ='11'|| ft_employee.role_id ='37') and ft_employee.role_id !='1' and ft_employee.emp_status = '1' and ft_employee.emp_is_retired = '0' order by ft_employee.role_id desc");
		//$query = $this->db->query("SELECT ft_employee.emp_full_name, ft_employee.emp_id , ft_emprole_master.emprole_name_hi FROM ft_employee inner join ft_emprole_master on ft_emprole_master.role_id =  ft_employee.role_id  WHERE (ft_employee.role_id < 8 || ft_employee.role_id ='11') and ft_employee.role_id !='1' and ft_employee.emp_status = '1' and ft_employee.emp_is_retired = '0' order by ft_employee.role_id desc");
        $res_array1 =  $query->result_array();

        $query1 = $this->db->query("SELECT emp_id as upperofficid FROM `ft_employee_hirarchi` WHERE `under_emp_id` = ".$role1[0]['emp_id']);
        $res_array2 =  $query1->result_array();
        echo json_encode(array($res_array1,$res_array2));
        exit();
    }
    public function section_off_nm_es($file_id = null)
    {
       // echo modules::run('view_file/view_file/section_off_nm',null);
	    $filedetails =  getFileDetails($file_id);
    //    $section_section_name = section_section_name();
    //    $markssec = $section_section_name[$filedetails->file_mark_section_id];
   //     $query = $this->db->query("SELECT section_id, section_name_hi, section_name_en FROM ft_sections_master where section_id=".$markssec);
    //   $query = $this->db->query("SELECT section_id, section_name_hi, section_name_en FROM ft_sections_master where section_id not in ('1','8')");
      $query = $this->db->query("SELECT section_id, section_name_hi, section_name_en FROM ft_sections_master ");
     $res_array1 =  $query->result_array();
	//echo $this->db->last_query();
        echo json_encode($res_array1);
        exit();
    }
	public function check_user_section()
	{
		$emp_id = $this->input->post('emp_id');
		$empdetails = empdetails($emp_id) ;
		
		$emp_section_id = $empdetails[0]['emp_section_id'];
	
		$sectionids = explode( ',',$emp_section_id );
		if(( ( $empdetails[0]['role_id'] == 8 ) && (count($sectionids)>1))||( ( $empdetails[0]['role_id'] == 37 ) && (count($sectionids)>1))){ 
		$section_array=get_list_with_in(SECTIONS, '' ,'section_id',$sectionids);
		//	pr($section_array);
		echo json_encode($section_array);
        
		}else{
			$nul=0;
			echo json_encode($nul);
		}
		exit();
		
	}
}