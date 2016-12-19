<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class View_file_legislative	 extends MX_Controller {
    function __construct() {
        parent::__construct();
        $this->load->module('template');
        $this->load->language('view_file','hindi');
        $this->load->model('view_file_model','view_file');
        //   $this->load->model('notesheet_model');
        authorize();
    }
    public function index($id=null)
    {

        $section_id = getEmployeeSection();
        $section_explode =  explode(',',$section_id);
        $data = array();
        $data['title'] = $this->lang->line('view_file_manue');
        if ($id == 'return') {
            $data['title_tab'] = $this->lang->line('return_file_show');
        } else if ($id == '1') {
            $data['title_tab'] = $this->lang->line('dealing_file_show');
        } else {
            $data['title_tab'] = $this->lang->line('received_files');
        }
        $data['module_name'] = "view_file_legislative";
            $moveup_down = $id;
			if($this->input->get('section_id'))
			{
				$section_id_search = $this->input->get('section_id');
				$data['get_files'] = $this->view_file->getFiles($section_id , $moveup_down ,$section_id_search );
			}
			else
			{
				$data['get_files'] = $this->view_file->getFiles($section_id, $moveup_down , $section_id_search='');
			}
            $section_exp = explode(',',getEmployeeSection());
            $section_11 = array('16');
            if(array_intersect($section_exp, $section_11)){
                $data['view_file'] = "view_file_legislative/drafting_index";
            } else {
                $data['view_file'] = "view_file_legislative/index";
            }
        $data['view_left_sidebar'] = 'admin/left_sidebar';
        $this->template->index($data);
    }


    public function viewDetails($file_id = null)
    {
        if($file_id != null) {
            $data = array();
            $data['title'] = $this->lang->line('view_file_manue');
            $data['title_tab'] = $this->lang->line('view_file_details');
            $data['file_details'] = $this->view_file->getFileDetails($file_id);
            $file_log = $this->view_file->getFiles_log($file_id);
            $data['file_log'] = $file_log;
            $file_movement = $this->view_file->getFiles_movement($file_id);
            $data['file_movement'] = $file_movement;
            // pre($data['file_log']);
            $data['module_name'] = "view_file_legislative";
            $data['view_file'] = "view_file_legislative";
            $this->template->index($data);
        }else{
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    // Send file to DA , RP
    public function senttoda_action($file_id)
    {
        $data = array();
        $data['title'] = $this->lang->line('view_file_manue');
        $data['title_tab'] = $this->lang->line('view_file_details');
        $data['file_details']= getFiledata($file_id);
        $data['dealing_name']= $this->view_file->get_DAname(getEmployeeSection(),null);
        if(count($data['dealing_name'])<=0){
            $data['dealing_name']= $this->view_file->get_DAname($data['file_details'][0]['file_mark_section_id'],$data['file_details'][0]['file_received_emp_id']);
        }
        //  pre($data['dealing_name']);
        $data['module_name'] = "view_file_legislative";
        // $data['view_left_sidebar'] =  'manage_file/left_sidebar_so';
        //	$data['view_left_sidebar'] =  'admin/left_sidebar';
        $data['view_file'] = "action_so";
        $this->template->index($data);
    }
    //show file list RP
    public function Dispaly_list($id=null)
    {
        $data = array();
        $data['title'] = $this->lang->line('view_file_manue');
        $section_ids1 = $this->input->get('section_id') ;
        // pr($section_ids1);
        if(isset($section_ids1)){
            $section_ids2 = $section_ids1 ;
        } else { $section_ids2 = null ; }
        if($id != null) {
            $data['page1'] = $id;
            $data['title_tab'] = $this->lang->line('return_files');
            $data['get_files'] = getFiledata_inlist_desc(null,$section_ids2);
        }else {
            $data['title_tab'] = $this->lang->line('received_files');
            $data['get_files'] = getFiledata_inlist_asc(null,$section_ids2);
        }
        $data['module_name'] = "view_file_legislative";
        $data['view_file'] = "view_file_legislative/view_file_list";
        $data['view_left_sidebar'] =  'admin/left_sidebar';
        $this->template->index($data);
    }
    //rp
    public function return_fileofficer($file_id = null)
    {

        $role1 = empdetails(emp_session_id());
        // $query = $this->db->query("SELECT `emp_id`,`emp_full_name` FROM `ft_employee` WHERE `emp_id` in (SELECT DISTINCT `fmove_previous_user_id` FROM `ft_file_movements` WHERE `fmove_file_id`=".$file_id." and fmove_id < (SELECT `fmove_id` FROM `ft_file_movements` WHERE `fmove_file_id`=".$file_id." and `fmove_previous_user_id`=".emp_session_id()." LIMIT 1)) and `emp_id` != ".emp_session_id()." and role_id !='9' order by emp_id asc");
        $query = $this->db->query("SELECT ft_employee.emp_full_name_hi, ft_employee.emp_id ,ft_employee.role_id , ft_emprole_master.emprole_name_hi , ft_sections_master.section_name_hi, ft_sections_master.section_id FROM ft_employee inner join ft_emprole_master on ft_emprole_master.role_id = ft_employee.role_id left join ft_sections_master on ft_sections_master.section_id = ft_employee.emp_section_id  WHERE (ft_employee.role_id < '9' AND ft_employee.role_id > '".$role1[0]['role_id']."'  AND ft_employee.role_id not in ('9','1','2')) or ft_employee.role_id ='37' and ft_employee.emp_status = '1' and ft_employee.emp_is_retired = '0'  and emp_posting_location ='1' order by ft_employee.role_id asc");
        $res_array =  $query->result_array();
        echo json_encode($res_array);
        exit();
    }
    public function section_da_name()
    {
	    $get_emp_ses = getEmployeeSection();	    
	    if(isset($_GET['test']) && $_GET['test']=='bij'){
			pre($get_emp_ses);
		}
        $res_1 = $this->view_file->get_DAname_ajax($get_emp_ses);
        echo json_encode($res_1);
        exit();
    }


    public function upper_role_officer($file_id = null)
    {
	//    $query = $this->db->query("SELECT ft_employee_details.emp_detail_gender, ft_employee.emp_full_name,ft_employee.emp_full_name_hi, ft_employee.emp_id , ft_emprole_master.emprole_name_hi FROM ft_employee inner join ft_employee_details on ft_employee_details.emp_id = ft_employee.emp_id inner join ft_emprole_master on ft_emprole_master.role_id =  ft_employee.role_id  WHERE (ft_employee.role_id < 8 || ft_employee.role_id =11) AND ft_employee.role_id != '1' and ft_employee.emp_status = '1' and ft_employee.emp_is_retired = '0'  and emp_posting_location ='1' order by ft_employee.role_id desc");
        
       $file_section = $this->input->post('file_section');
       $sql1  = "SELECT ft_employee_details.emp_detail_gender, ft_employee.emp_full_name,ft_employee.emp_full_name_hi, ft_employee.emp_id , ft_emprole_master.emprole_name_hi FROM ft_employee inner join ft_employee_details on ft_employee_details.emp_id = ft_employee.emp_id inner join ft_emprole_master on ft_emprole_master.role_id =  ft_employee.role_id  WHERE ";
       if($this->session->userdata('user_role') == '37' && $file_section == '18' && $this->session->userdata('emp_id') == '133'){
           $sql1 .= "(ft_employee.role_id < 8 || ft_employee.role_id = 11 || ft_employee.emp_id = '25') AND ";
       }else{
           $sql1 .= "(ft_employee.role_id < 8 || ft_employee.role_id =11) AND ";
       }
        $sql1 .= " ft_employee.role_id != '1' and ft_employee.emp_status = '1' and ft_employee.emp_is_retired = '0'  and emp_posting_location ='1' order by ft_employee.role_id desc";
       $query = $this->db->query($sql1);
       
        $res_array1 =  $query->result_array();
        echo json_encode($res_array1);
        exit();
    }
    public function section_off_nm($file_id = null)
    {
        // $query = $this->db->query("SELECT section_id, section_name_hi, section_name_en FROM ft_sections_master where section_id not in ('1','8',26,21) and section_id not in (".getEmployeeSection().")");
         $query = $this->db->query("SELECT section_id, section_name_hi, section_name_en FROM ft_sections_master where section_id not in ('1','8',26,21)");
		 $res_array1 =  $query->result_array();
      
        echo json_encode($res_array1);
        exit();
    }



    public function show_404() {
        $this->load->view('404');
    }


}