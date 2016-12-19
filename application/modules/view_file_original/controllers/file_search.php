<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class File_search extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->module('template');
        $this->load->model('file_search_model','file_search');
        $this->load->model('view_file_model','view_file');
        $this->lang->load("view_file","hindi");
        authorize();
    }
    public function is_logged_in()
    {
        if ($this->session->userdata('is_logged_in') === false)
        {
            redirect("home");
        }
    }
    //it used for search and link files
    public function index($id = null, $file_id = null)
    {
        $data = array();
        if($id!=null && $id == 101){
            $data['title'] = 'Link File';
            $data['title_tab'] = 'Search previous Files for link';
        }else {
            $data['title'] = 'File Search';
            $data['title_tab'] = 'Search files by type';
        }
        $data['frm_date']=null;;
        $data['to_date']=null;;
        $data['get_section'] = get_list(SECTIONS,null,null);
        $search_type = $this->input->post('search_type');
        $sections = $this->input->post('sections');
        $search_value = $this->input->post('search_value');        
        $frm_dt = $this->input->post('frm_dt');
        //  $to_dt = $this->input->post('to_dt');
        $months = $this->input->post('months');


        $case_type = $this->input->post('case_type');
        $case_no = $this->input->post('case_no');
        $case_year = $this->input->post('case_year');

        $movement_frm_dt = $this->input->post('movement_frm_dt');
        $movement_to_dt = $this->input->post('movement_to_dt');

        $this->form_validation->set_rules('search_type','search_type', 'trim|required|xss_clean');
        if($search_type == 1)
        {
            $this->form_validation->set_rules('search_value','search_value', 'trim|required|xss_clean');
            $this->form_validation->set_rules('sections','sections', 'trim|required|xss_clean');
        } else if($search_type == 4)
        {
            $this->form_validation->set_rules('frm_dt','frm_dt', 'trim|required|xss_clean');
            // $this->form_validation->set_rules('to_dt','to_dt', 'trim|required|xss_clean');
        } else if($search_type == 5)
        {
            $this->form_validation->set_rules('months','months', 'trim|required|xss_clean');
        } else if($search_type == 7)
        {
            $this->form_validation->set_rules('case_no','case_no', 'trim|required|xss_clean');
            $this->form_validation->set_rules('case_type','case_type', 'trim|required|xss_clean');
        }else if($search_type == 9)
        {
            $this->form_validation->set_rules('movement_frm_dt','movement_frm_dt', 'trim|required|xss_clean');
            $this->form_validation->set_rules('movement_to_dt','movement_to_dt', 'trim|required|xss_clean');
        }else if($search_type == 10){
            $this->form_validation->set_rules('filter_section_emp_wise','filter_section_emp_wise', 'trim|required|xss_clean');
            $this->form_validation->set_rules('empid_secid','empid_secid', 'trim|required|xss_clean');
            $this->form_validation->set_rules('search_frm_dt','search_frm_dt', 'trim|required|xss_clean');
            $this->form_validation->set_rules('search_to_dt','search_to_dt', 'trim|required|xss_clean');
        } else
        {
            $this->form_validation->set_rules('search_value','search_value', 'trim|required|xss_clean');
        }
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        if ($this->form_validation->run($this) === TRUE)
        {
            if($search_type == 1) { 
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
                    $data['get_files'][] = $this->file_search->file_search_sectionno($search_type, $sections, $s_value);
                    
                }               
            }
            if($search_type == 3 || $search_type == 6 || $search_type == 8 || $search_type == 2) {
                $data['get_files'] = $this->file_search->file_search($search_type, $search_value, null);
            }
            if($search_type == 4) {
                $data['get_files'] = $this->file_search->file_search($search_type, $frm_dt, null);
            }
            if($search_type == 5) {
                $data['get_files'] = $this->file_search->file_search($search_type, $months, null);
            }
            if($search_type == 7) {
                $case_value = $case_type."/".$case_no."/".$case_year;
                $data['get_files'] = $this->file_search->file_search_caseno($search_type, $case_value, null);
            }
            if($search_type == 9) {
                $data['get_files'] = $this->file_search->file_search($search_type, $movement_frm_dt, $movement_to_dt);
            }
            if($search_type == 10) {
                $filter_section_emp_wise= $this->input->post('filter_section_emp_wise');
                $empid_secid= $this->input->post('empid_secid');
                $srch_frm_dt= $this->input->post('search_frm_dt');
                $search_to_dt= $this->input->post('search_to_dt');
                $data['frm_date']=$srch_frm_dt;
                $data['to_date']=$search_to_dt;
                $data['get_files'] = $this->file_search->file_search_emp_section_wise($search_type,$filter_section_emp_wise,$empid_secid,$srch_frm_dt, $search_to_dt);
            }
        }
        $data['module_name'] = "view_file";
        if($id!=null && $id == 101){
            $data['file_details']= $this->view_file->getFileDetails($file_id);
            $data['link_fileid'] = $file_id;
            $data['view_file'] = "view_file/file_link_list";
        }else {
            $data['view_file'] = "view_file/file_search_list";
        }
        $this->template->index($data);
    }

    public function manage_link_files(){

        $file = $this->input->post('file3');
        $file_link =  $this->input->post('linkcheck');

        $file_l =  implode(',',$file_link);


        if($file != '' && $file_link != ''){
            //update single file by all file ids which will link
            if($file != ''){
                $filedetails =  getFileDetails($file);
                $link_data = array(
                    'file_linked_id' => @$filedetails->file_linked_id ? $filedetails->file_linked_id.",".$file_l : $file_l,
                );
                $filelog_data = array(
                    'file_id' => $file,
                    'section_id' => $filedetails->file_mark_section_id,
                    'to_emp_id' => emp_session_id(),
                    'from_emp_id' => emp_session_id(),
                    'flog_other_remark' => 'Link',
                    'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
                    'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
                    'sublogin' => $this->session->userdata('emp_id'),
                );
                $res = updateData(FILES, $link_data, array('file_id'=>$file));
                if($res) {
                    insertData($filelog_data, FILES_LOG);
                }}

            // update all file which will link
            if(!empty($file_link)){

                foreach($file_link as $file4){
                    $file_d =  getFileDetails($file4);

                    $link_data1 = array(
                        'file_linked_id' => @$file_d->file_linked_id ? $file_d->file_linked_id.",".$file : $file,
                    );
                    $filelog_data1 = array(
                        'file_id' => $file4,
                        'section_id' => $file_d->file_mark_section_id,
                        'to_emp_id' => emp_session_id(),
                        'from_emp_id' => emp_session_id(),
                        'flog_other_remark' => 'Link',
                        'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
                        'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
                        'sublogin' => $this->session->userdata('emp_id'),
                    );

                    $res1 = updateData(FILES, $link_data1, array('file_id'=>$file4));
                    if($res1) {
                        insertData($filelog_data1, FILES_LOG);
                    }
                }
            }
            if($res){
                $this->session->set_flashdata('message', 'File Linked Successfully');
            }else{
                $this->session->set_flashdata('message', 'File Not Linked, Try Again..?');
            }
        }
        redirect('view_file/file_link/101/'.$file);
    }

    function ajax_get_section_employee(){
        $request_for='';
        $search_filter = $this->input->post('search_filter');
        if($search_filter=='emp'){
            //if()
            $emp_list[0] = get_list_orderwise(EMPLOYEES,array('col'=>'role_id','order'=>'ASC'),array('emp_is_retired'=>0,'emp_status'=>1,'role_id !='=>'1'),null);
        }else if($search_filter=='sec'){
            $emp_list[0] = get_list_orderwise(SECTIONS,array('col'=>'section_name_en','order'=>'ASC'),array('section_id !='=>26),null);
        }
        echo json_encode($emp_list);
        exit();
    }

}