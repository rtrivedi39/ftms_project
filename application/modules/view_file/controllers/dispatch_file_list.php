<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dispatch_file_list extends MX_Controller {
    function __construct() {
        parent::__construct();
        $this->load->module('template');
        $this->load->language('view_file','hindi');
        $this->load->model('view_file_model','view_file');
        $this->load->model('file_search_model','file_search');
        authorize();
    }
    public function index($id=null)
    {
        $data = array();
        $data['title'] = $this->lang->line('view_file_manue');
        $section_id = getEmployeeSection();
       // pr($section_id);
        $section_explode =  explode(',',$section_id);
        $data['title_tab'] = $this->lang->line('return_file_show');
        $data['get_files'] = $this->view_file->dispatch_getFiles();
        $data['module_name'] = "view_file";
        $data['view_file'] = "view_file/dispatch_file_list";
        $data['view_left_sidebar'] =  'admin/left_sidebar';
        $this->template->index($data);
    }
	
	public function search_files(){       
        $this->form_validation->set_rules('search_value','search_value', 'trim|required|xss_clean');
        $this->form_validation->set_rules('sections','sections', 'trim|required|xss_clean');
        if ($this->form_validation->run($this) === TRUE){
		$year = $this->input->post('files_year') != '' ? $this->input->post('files_year') : date('Y');			
            $search_value = $this->input->post('search_value');  
            $sections = $this->input->post('sections');           
            $building_name = $this->input->post('building_name');           
            $building_floor = $this->input->post('building_floor');           
            $search_values = array();
            if (strpos($search_value,'-')) {
                $first =  array_pop(explode('-', $search_value,-1));
                $last =  array_pop(explode('-', $search_value));                    
                while($first <= $last){
                    $search_values[] = $first;
                    $first ++; 
                }
            } else{              
                $search_values = explode(',', $search_value);   
            }
              
            foreach($search_values as $s_value){
               $response = $this->file_search->file_search_lists(1, $sections, $s_value, $building_name, $building_floor, $year);
                if($response != false){
					 $data['get_files'][] = $response;
				}
            }           
        } else {
            $data['get_files'] = $this->view_file->dispatch_getFiles();
        }
        $data['title'] = $this->lang->line('view_file_manue');
        $section_id = getEmployeeSection();       
        $section_explode =  explode(',',$section_id);
        $data['title_tab'] = $this->lang->line('return_file_show');
        $data['module_name'] = "view_file";        
        $data['view_file'] = "view_file/dispatch_file_list";     
        $this->template->index($data);
	}

    //rp
    public function return_fileofficer($file_id = null)
    {
        $query = $this->db->query("SELECT `emp_id`,`emp_full_name` FROM `ft_employee` WHERE `emp_id` in (SELECT DISTINCT `fmove_previous_user_id` FROM `ft_file_movements` WHERE `fmove_file_id`=".$file_id." and fmove_id < (SELECT `fmove_id` FROM `ft_file_movements` WHERE `fmove_file_id`=".$file_id." and `fmove_previous_user_id`=".emp_session_id()." LIMIT 1)) and `emp_id` != ".emp_session_id()." order by emp_id asc");
        $res_array =  $query->result_array();
        echo json_encode($res_array);
        exit();
    }
    public function section_da_name()
    {
        $res_1 = $this->view_file->get_DAname(getEmployeeSection());
        echo json_encode($res_1);
        exit();
    }


}