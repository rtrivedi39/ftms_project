<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class File_search extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->module('template');
        if($this->input->post('check_table') == 'close'){
            $this->load->model('file_search_close_model','file_search');
        }else{
            $this->load->model('file_search_model','file_search');
        }  
        $this->load->model('view_file_model','view_file');
        $this->lang->load("view_file","hindi");
		$this->lang->load("files_search","hindi");
        authorize();
    }
    public function is_logged_in()
    {
        if ($this->session->userdata('is_logged_in') === false)
        {
            redirect("home");
        }
    }
     public function index_stop()
     {
			echo "Work in progrese " ;
	}
    //it used for search and link files
    public function index($id = null, $file_id = null)
    {
		/*if(($this->input->post('search_value'))){
			echo "abc----फाइल आवागमन दिनांक"; $this->input->post('search_value');exit();}*/
        $data = array();
        $data['search_by_temp_section_emp_name']=null;
        $data['filter_search_frm_date']=null;
        $data['filter_search_to_date']=null;
		$filter_section_emp_wise=null;
		$data['filter_section_emp_wise']='';
		$data['filter_search_frm_date']='';
		$data['filter_search_to_date']='';
		$data['frm_date']='';
		$data['to_date']='';
        if($id!=null && $id == 101){
            $data['title'] = 'Merge File';
            $data['title_tab'] = 'Search previous Files for Merge';
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

		$s_files_year = $this->input->post('s_files_year');
		
        $ps_months = $this->input->post('ps_months');
        $ps_case_year = $this->input->post('ps_case_year');


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
			$cr_section_ids= get_cr_emp_id(1);
			/*if(in_array(emp_session_id(),$cr_section_ids['id_array'])){ // this condition comment its create problem when file mark presonal.
				$this->form_validation->set_rules('mark_sections','mark_sections', 'trim|required|xss_clean');
			}*/
        }  else if($search_type == 3 || $search_type == 2 )
        {
           $this->form_validation->set_rules('search_value','search_value', 'trim|required|xss_clean');
            $this->form_validation->set_rules('sections','sections', 'trim|required|xss_clean');
        }else if($search_type == 4)
        {
            $this->form_validation->set_rules('frm_dt','frm_dt', 'trim|required|xss_clean');
             $this->form_validation->set_rules('sections','sections', 'trim|required|xss_clean');
        } else if($search_type == 5)
        {
            $this->form_validation->set_rules('months','months', 'trim|required|xss_clean');
        } else if($search_type == 7)
        {
			$this->form_validation->set_rules('sections','sections', 'trim|required|xss_clean');
            $this->form_validation->set_rules('case_no','case_no', 'trim|required|xss_clean');
            $this->form_validation->set_rules('case_type','case_type', 'trim|required|xss_clean');
        }else if($search_type == 9)
        {
			$this->form_validation->set_rules('sections','sections', 'trim|required|xss_clean');
            $this->form_validation->set_rules('movement_frm_dt','movement_frm_dt', 'trim|required|xss_clean');
            $this->form_validation->set_rules('movement_to_dt','movement_to_dt', 'trim|required|xss_clean');
        }else if($search_type == 10){
            $this->form_validation->set_rules('filter_section_emp_wise','filter_section_emp_wise', 'trim|required|xss_clean');
            $this->form_validation->set_rules('empid_secid','empid_secid', 'trim|required|xss_clean');
            $this->form_validation->set_rules('search_frm_dt','search_frm_dt', 'trim|required|xss_clean');
            $this->form_validation->set_rules('search_to_dt','search_to_dt', 'trim|required|xss_clean');
		} else if($search_type == 11){
            $this->form_validation->set_rules('date_distpach','date_distpach', 'trim|required|xss_clean');
        } else if($search_type == 12){
			$this->form_validation->set_rules('sections','sections', 'trim|required|xss_clean');
            $this->form_validation->set_rules('ps_months','ps_months', 'trim|required|xss_clean');
            $this->form_validation->set_rules('ps_case_year','ps_case_year', 'trim|required|xss_clean');
        }
		else if($search_type == 13){
			
            $this->form_validation->set_rules('file_offer_by','offer_by', 'trim|required|xss_clean');
            //$this->form_validation->set_rules('file_department_id','file_department_id', 'trim|required|xss_clean');

 			        
        }
		else{
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
					
					if(getEmployeeSection() == 1 && $this->input->post('mark_sections') !='' || $this->input->post('movement_frm_dt') !=''|| $this->input->post('movement_to_dt') !=''){
						$data['get_files'][] = $this->file_search->file_search_sectionno_cr($search_type, $sections, $s_value , $s_files_year,$movement_frm_dt ,  $movement_to_dt );
					} else {
						$data['get_files'][] = $this->file_search->file_search_sectionno($search_type, $sections, $s_value , $s_files_year,$movement_frm_dt ,  $movement_to_dt );
                    }
                }               
            }
			
            if($search_type == 3 || $search_type == 6 || $search_type == 8 || $search_type == 2 ) {
				$data['get_files'] = $this->file_search->file_search($search_type, $search_value, null, null, null,$this->input->post('mark_sections'),$s_files_year,$movement_frm_dt , $movement_to_dt );
            }
            if($search_type == 4) {
                $data['get_files'] = $this->file_search->file_search($search_type, $frm_dt, null,null,null,$this->input->post('mark_sections'), $s_files_year,$movement_frm_dt ,  $movement_to_dt );
            }
            if($search_type == 5) {
                $data['get_files'] = $this->file_search->file_search($search_type, $months, null);
                $data['search_by_temp_section_emp_name']= $this->input->post('temp_section_emp_name');
            }
            if($search_type == 7) {
                $case_value = $case_type."/".$case_no."/".$case_year;
				
                $data['get_files'] = $this->file_search->file_search_caseno($search_type, $case_value, null , $this->input->post('sections')  ,$s_files_year ,$movement_frm_dt  , $movement_to_dt   );
            }
            if($search_type == 9) {
                $data['get_files'] = $this->file_search->file_search($search_type,null,null,null,null , $this->input->post('mark_sections') ,$s_files_year ,$movement_frm_dt, $movement_to_dt);
                $data['filter_search_frm_date']=$this->input->post('movement_frm_dt');
                $data['filter_search_to_date']=$this->input->post('movement_to_dt');
                $data['search_by_temp_section_emp_name']= $this->input->post('temp_section_emp_name');
            }
			if($search_type == 13) {
                $data['get_files'] = $this->file_search->file_search($search_type,null,null,null,null , $this->input->post('mark_sections') ,$s_files_year ,$movement_frm_dt, $movement_to_dt);
            }
            if($search_type == 10) {
                $filter_section_emp_wise= $this->input->post('filter_section_emp_wise');

                $empid_secid= $this->input->post('empid_secid');
                $srch_frm_dt= $this->input->post('search_frm_dt');
                $search_to_dt= $this->input->post('search_to_dt');
                $data['search_by_section_nd_name']= $this->input->post('empid_secid');
                if($this->input->post('sections')!=''){
                    $data['search_by_temp_section_emp_name']= $this->input->post('sections');
                }
                if($this->input->post('temp_section_emp_name')!=''){
                    $data['search_by_temp_section_emp_name']= $this->input->post('temp_section_emp_name');
                }

                $data['filter_section_emp_wise']=$filter_section_emp_wise;
                $data['filter_search_frm_date']=$srch_frm_dt;
                $data['filter_search_to_date']=$search_to_dt;
                $data['frm_date']=$srch_frm_dt;
                $data['to_date']=$search_to_dt;
                $data['get_files'] = $this->file_search->file_search_emp_section_wise($search_type,$filter_section_emp_wise,$empid_secid,$srch_frm_dt, $search_to_dt);
            }
            if($search_type==1) {
                //echo $data['filter_section_emp_wise']=$this->input->post('sections');
                $data['search_by_temp_section_emp_name']= $this->input->post('temp_section_emp_name');
            }

            if($search_type==8) {
                //echo $data['filter_section_emp_wise']=$this->input->post('sections');
                $data['search_by_temp_section_emp_name']= $this->input->post('search_value');
            }
            if($search_type==2) {
                //echo $data['filter_section_emp_wise']=$this->input->post('sections');
                $data['search_by_temp_section_emp_name']= $this->input->post('temp_section_emp_name');
            }
            if($search_type==6) {
                //echo $data['filter_section_emp_wise']=$this->input->post('sections');
                $data['search_by_temp_section_emp_name']= $this->input->post('temp_section_emp_name').'-'.$this->input->post('search_value');
            }
			// for searching disptached files
			if($search_type == 11) {
				$data['get_files'] = $this->file_search->file_search($search_type, $this->input->post('date_distpach'), $this->input->post('dispatch_type') ,'','','',$movement_frm_dt, $movement_to_dt );
                $data['search_by_temp_section_emp_name']= $this->input->post('temp_section_emp_name').'-'.$this->input->post('search_value');
            }
            if($search_type == 12) {
                $data['get_files'] = $this->file_search->file_search($search_type, $ps_months, $ps_case_year);
            }

        }
        if($id!=null && $id == 101){
            $show_related_view = $this->input->post('show_related_view');
            if(isset($show_related_view) && $show_related_view == 'related_view') {
                $data['get_files_related'] = $this->file_search->auto_search_file(null, $file_id);
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
		$data['data_search_type'] = $search_type;
        $this->template->index($data);
    }

    public function manage_link_files(){

        $file = $this->input->post('file3');
        $file_link =  $this->input->post('linkcheck');
		$emp_session_id = emp_session_id();
    //    $file_l =  implode(',',$file_link);

        if($file != '' && $file_link != ''){

            // update all file which will link
            if(!empty($file_link)){

                foreach($file_link as $file4){
                    $file_d =  getFileDetails($file4);
                    $pre_link_ids[] = $file_d->file_linked_id ;
                    $link_data1 = array(
                        'file_level_id' => '33', //file close for 33
                        'file_return' => '2', // 2 for dispatch
                        'file_hardcopy_status' => 'close',
                        'file_update_date' => date('Y-m-d H:i:s'),
                        'file_linked_id' => @$file_d->file_linked_id ? $file_d->file_linked_id.",".$file : $file,
                    );
                    $dispatch_file = array(
                        'file_id'            => $file4,
                        'emp_id'             => $emp_session_id,
                        'cost_of_dispatch'   => 0,
                        'remark'             => '',
                        'url_proof_dispatch' => 'File merge and close',
                        'dispatch_date'      => date('Y-m-d H:i:s'),
                        'issection_despose'      => 2, // file who close by merge

                    );
                    $dispatchno = insertData_with_lastid($dispatch_file, FILES_DISPATCH);

                    $filelog_data1 = array(
                        'file_id' => $file4,
                        'section_id' => $file_d->file_mark_section_id,
                        'to_emp_id' => $emp_session_id,
                        'from_emp_id' => $emp_session_id,
                        'flog_other_remark' => 'यह नस्ती अन्य नस्ती के साथ एकीकृत  गई है अत: इस नस्ती को बंद किया गया है  |  Dispose Id :'.$dispatchno,
                        'fvlm_id' => '1', // 1 for close file
                        'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
                        'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
                        'sublogin' => $this->session->userdata('emp_id'),
                        'emp_degignation_id' => checkUserdesignation(),
                        'file_headerpath' =>  serialize(array($file))
                    );

                    $empdetails = empdetails($emp_session_id);
                    $form_data_move_m = array(
                        'fmove_file_id'  => $file4, 
                        'fmove_current_user_id'  => $emp_session_id,
                        'fmove_previous_user_id' => $emp_session_id,
                        'fmove_to_unit_id'       => getunitid($empdetails[0]['role_id'])==''?0:getunitid($empdetails[0]['role_id']),
                        'fmove_from_unit_id'     => getunitid($empdetails[0]['role_id'])==''?0:getunitid($empdetails[0]['role_id']),
                        'file_return'     		 => '2',
                    );

                    $res1 = updateData(FILES, $link_data1, array('file_id'=>$file4));
                    if($res1) {
                        insertData($filelog_data1, FILES_LOG);
                        insertData($form_data_move_m, FILES_MOVEMENT);
                        $this->move_working_to_master_file($file4);
                    }
                }
                $pre_link_ids_join  =   join(',',array_filter($pre_link_ids));
            }


            //update single file by all file ids which will link
            if($file != ''){
                $filedetails =  getFileDetails($file);

                $merge_array[] = join(',',array_filter($file_link));
                $merge_array[] = $pre_link_ids_join ;
                $all_merge_file =  join(',',array_filter($merge_array));

                $link_data = array(
                    'file_linked_id' => @$filedetails->file_linked_id ? $filedetails->file_linked_id.",".$all_merge_file : $all_merge_file,
                );

                $filelog_data = array(
                    'file_id' => $file,
                    'section_id' => $filedetails->file_mark_section_id,
                    'to_emp_id' => $emp_session_id,
                    'from_emp_id' => $emp_session_id,
                    'flog_other_remark' => 'नस्ती को एकीकृत किया गया |',
                    'fvlm_id' => '4',
                    'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
                    'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
                    'sublogin' => $this->session->userdata('emp_id'),
                    'emp_degignation_id' => checkUserdesignation(),
                    'file_headerpath' => is_array($file_link) ? serialize($file_link) : false
                );
                $res = updateData(FILES, $link_data, array('file_id'=>$file));
                if($res) {
                    insertData($filelog_data, FILES_LOG);
                }}

            if($res){				
                $this->session->set_flashdata('message', 'File Successfully Linked and Disposed in section.');
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
            $emp_list[0] = get_list_orderwise(EMPLOYEES,array('col'=>'emp_full_name','order'=>'ASC'),array('emp_is_retired'=>0,'emp_status'=>1,'role_id !='=>'1'),null);
        }else if($search_filter=='sec'){
            $emp_list[0] = get_list_orderwise(SECTIONS,array('col'=>'section_name_en','order'=>'ASC'),array('section_id !='=>26),null);
        }
        echo json_encode($emp_list);
        exit();
    }
    function file_search_out_of_dep(){
        $searchval = $this->input->post('mark_out_dept');
        $search_section_wise = $this->input->post('search_section_wise');
		$other_val = null;
		if($searchval == 'अन्य'){
			$other_val = $this->input->post('outer_other_name');
		}
        $data['title']              = 'विभाग  की बाहर भेजी गयी नस्तियां';
        $data['title_tab']          = 'फाइलें खोजे';
		
        if(isset($searchval) && $searchval != null){
            $result = $this->file_search->search_out_of_dept($searchval, $other_val, $search_section_wise);
            $data['files_data']          = $result;
        }
        $data['module_name']        = "view_file";
        $data['view_file']          = "view_file/file_search_out_of_dep";
        $this->template->index($data);
    }
	
	/*
		Used for move close file to master table
		Same function same name used in mange_file conroller 
	*/
	public function move_working_to_master_file($id)
	{
		$vv = "ft_";
		
		$query9 ="INSERT $vv".DIGITAL_SINATURE_MASTER." SELECT * FROM $vv".DIGITAL_SINATURE." WHERE ds_file_id =$id";
		$query =$this->db->query($query9);
		
		$query7 ="INSERT $vv".DRAFT_LOG_MASTER." SELECT * FROM $vv".DRAFT_LOG." WHERE draft_log_file_id =$id";
		$query =$this->db->query($query7);
		
		$query1 ="INSERT $vv".FILES_MASTER."  SELECT * FROM $vv".FILES." WHERE file_id=$id";
		$query =$this->db->query($query1);
		
		$query2 ="INSERT $vv".FILES_MOVEMENT_MASTER." SELECT * FROM $vv".FILES_MOVEMENT." WHERE fmove_file_id =$id";
		$query =$this->db->query($query2);
		
		$query3 ="INSERT $vv".FILES_LOG_MASTER." SELECT * FROM $vv".FILES_LOG." WHERE file_id =$id";
		$query =$this->db->query($query3);			
		
		$query4 ="DELETE FROM $vv".FILES." WHERE file_id=$id";
		$query =$this->db->query($query4);
		
		$query5 ="DELETE FROM $vv".FILES_MOVEMENT." WHERE fmove_file_id =$id";
		$query =$this->db->query($query5);
		
		$query6 ="DELETE FROM $vv".FILES_LOG." WHERE file_id =$id;";
		$query =$this->db->query($query6);

		//for draft log
		$query8 ="DELETE FROM $vv".DRAFT_LOG." WHERE draft_log_file_id = $id;";
		$query =$this->db->query($query8);
		
		$query10 ="DELETE FROM $vv".DIGITAL_SINATURE." WHERE ds_file_id = $id;";
		$query =$this->db->query($query10);
	}

}