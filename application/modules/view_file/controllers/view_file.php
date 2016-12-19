<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class View_file	 extends MX_Controller {
    function __construct() {
        parent::__construct();
        $this->load->module('template');
        $this->load->language('view_file','hindi');
        $this->load->model('view_file_model','view_file');
        $this->load->model('notesheet_model');   
		$this->load->library('pagination');
        authorize();
    }
    public function index($id=null)
    {
       $section_exp = explode(',',getEmployeeSection());
       $section_11 = array('20','18','28','16','19');
       // $dreafting_sec_id = array('16');
	   $section_id_search = $this->input->get('section_id');
        if(array_intersect($section_exp, $section_11)){
            redirect('view_file_legislative/index/'.$id);
        }
        //else if(array_intersect($section_exp, $dreafting_sec_id)){
        //      redirect('drafting/files/'.$id);
        //redirect('view_file_legislative/view_file_drafting/index/'.$id);
        //  }
		else {
            $section_id = getEmployeeSection();
            $section_explode =  explode(',',$section_id);
            $data = array();
            $data['title'] = $this->lang->line('view_file_manue');
            if ($id == 'return') {
                $data['title_tab'] = $this->lang->line('return_file_show');
            } else if ($id == 'reject') {
                $data['title_tab'] = 'रिजेक्ट की गयी फाइलें';
            }else if ($id == '1') {
                $data['title_tab'] = $this->lang->line('dealing_file_show');
            } else {
                $data['title_tab'] = $this->lang->line('received_files');
            }
            $data['module_name'] = "view_file";
			/*Pagination*/			
			$config["is_question_mark"] = TRUE;									
			if(isset($_GET['section_id']) && $_GET['section_id']!=''){
				$config["base_url"] = base_url()."view_file?section_id=".$_GET['section_id'];
			}else{
				$config["base_url"] = base_url()."view_file?";
			}			
			$total_count = $this->view_file->count_getFiles($section_id,@$moveup_down,$section_id_search,$limit=null,$page=null);								
			$data['total_files']=$total_count['totalfiles'];
			// Set total rows in the result set you are creating pagination for.
			$config['total_rows'] = $data['total_files'];
			$data['perpage']=PER_PAGE_VALUE;;
			$config["per_page"] = $data['perpage'];		
			
			$config['first_link'] = 'First';
			$config['first_tag_open'] = '<li class="paginate_button previous disabled" id="example1_previous">';
			$config['first_tag_close'] = '</li>';
			
			
			$config['prev_link'] = 'Previous';
			$config['prev_tag_open'] = '<li class="paginate_button previous disabled" id="example1_previous">';
			$config['prev_tag_close'] = '</li>';
			
			$config['next_link'] = 'Next';
			$config['next_tag_open'] = '<li class="paginate_button next" id="example1_next">';
			$config['next_tag_close'] = '</li>';
			
			$config['full_tag_open'] ='<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			
			$config['num_tag_open'] = '<li class="paginate_button ">';
			$config['num_tag_close'] = '</li>';
			
			$config['cur_tag_open'] = '<li class="paginate_button active"><a>';
			$config['cur_tag_close'] = '</a></li>';
			
			$config['last_link'] = 'End';
			$config['last_tag_open'] = '<li id="example1_next" class="paginate_button next">';
			$config['last_tag_close'] = '</li>';
			//$config['page_query_string'] = TRUE;
			
			$this->pagination->initialize($config);
			if(isset($_GET['per_page']) && $_GET['per_page']!=''){
				$page = $_GET['per_page'];
			}else{
				$page=0;
			}
            if(in_array('8',$section_explode)) // 8 is dispatch section id.
            {
                $data['get_files'] = $this->view_file->dispatch_getFiles($id);
                $data['view_file'] = "view_file/dispatch_file_list";

            }else {
                $moveup_down = $id;
				if($section_id_search){					
					$data['get_files'] = $this->view_file->getFiles($section_explode, $moveup_down,$section_id_search,$config['per_page'],$page);
				}
				else{					
					$data['get_files'] = $this->view_file->getFiles($section_explode, $moveup_down,null,$config['per_page'],$page);
				}				
				$str_links = $this->pagination->create_links();
				$data["links"] = explode('&nbsp;',$str_links);			
				/*Pagination*/	
				
               // $data['get_files'] = $this->view_file->getFiles($section_explode, $moveup_down);
                $data['view_file'] = "view_file/index";
            }
            $data['view_left_sidebar'] = 'admin/left_sidebar';
            $this->template->index($data);
        }
    }
	
	//this is use for only printing purpose as per 07-11 Susmita maams said
	public function for_print($id=null)
    {
        $section_exp = explode(',',getEmployeeSection());
        $section_11 = array('20','18','28','16','19');
      //  $dreafting_sec_id = array('16');
        if(array_intersect($section_exp, $section_11)){
            redirect('view_file_legislative/index/'.$id);
        }
        //else if(array_intersect($section_exp, $dreafting_sec_id)){
        //      redirect('drafting/files/'.$id);
        //redirect('view_file_legislative/view_file_drafting/index/'.$id);
        //  }
		else {
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
            $data['module_name'] = "view_file";
            if(in_array('8',$section_explode)) // 8 is dispatch section id.
            {
                $data['get_files'] = $this->view_file->dispatch_getFiles_for_print($id);
                $data['view_file'] = "view_file/dispatch_file_list_print";

            }else {
                $moveup_down = $id;
                $data['get_files'] = $this->view_file->getFiles($section_explode, $moveup_down);
                $data['view_file'] = "view_file/index";
            }
            $data['view_left_sidebar'] = 'admin/left_sidebar';
            $this->template->index($data);
        }
    }
	public function crviewfile($showtype='',$sec_id=null)
    {
		$role = $this->session->userdata('user_role');
        $section_exp = explode(',',getEmployeeSection());
        $user_id =  emp_session_id();
		if($this->input->get('frm_search_date') != ''){
			$year = $this->input->get('frm_search_date');
		} else {
			$year = '';
		}		
		if($this->input->get('till_search_date') != ''){
			//$month = $this->input->get('files_month');
			$month = $this->input->get('till_search_date');
		} else {
			$month =  '';
		}		
		if($this->input->get('files_section') != ''){
			$section = $this->input->get('files_section');
        }elseif($sec_id != null && $sec_id != 'all'){
            $section = $sec_id;
        }elseif($section_exp[0] && $role == '39'){ // this is for per user section
            if($user_id == '218' || $sec_id == 'all'){
                $section = '';
            }else{
                $section = $section_exp[0];
            }
        }else {
			$section = '';
		}		
		if($this->input->get('files_user') != ''){
			$user = $this->input->get('files_user');
		} else {
			$user = '';
		}		
		if($this->input->get('type') != '' && $this->input->get('type') == 'all'){
			$year = '';
		}		
        $data = array();
        $data['title'] = $this->lang->line('view_file_manue');
        //  $section_id = getEmployeeSection();		
		/*Pagination*/			
			$config["is_question_mark"] = TRUE;		
			if($showtype == 'ALL')
			{				
				if(isset($_GET['frm_search_date']) && $_GET['frm_search_date']!='' && isset($_GET['till_search_date']) && $_GET['till_search_date']!='' && isset($_GET['files_section']) && isset($_GET['files_user']) && $_GET['files_user']!='' ){
					$config["base_url"] = base_url()."show_file/ALL?frm_search_date=".$_GET['frm_search_date'].'&till_search_date='.$_GET['till_search_date'].'&files_section='.$_GET['files_section'].'&files_user='.$_GET['files_user'];
				}else{
					$config["base_url"] = base_url()."show_file/ALL?";
				}
				$total_count = $this->view_file->allfile_bycr_count($user_id, $year, $month, $section, $user);
			}elseif($showtype == 'csu'){}
			else {
				if(isset($_GET['frm_search_date']) && $_GET['frm_search_date']!='' && isset($_GET['till_search_date']) && isset($_GET['files_section']) && isset($_GET['files_user'])){
				$config["base_url"] = base_url()."return_file?frm_search_date=".$_GET['frm_search_date'].'&till_search_date='.$_GET['till_search_date'].'&files_section='.$_GET['files_section'].'&files_user='.$_GET['files_user'];
				}else{
					$config["base_url"] = base_url()."return_file?";
				}
				$total_count = $this->view_file->count_getFiles_bycr($user_id, $year, $month, $section, $user);				
			}								
			$data['total_files']=$total_count['totalfiles'];
			// Set total rows in the result set you are creating pagination for.
			$config['total_rows'] = $data['total_files'];
			$data['perpage']=PER_PAGE_VALUE;;
			$config["per_page"] = $data['perpage'];					
			$config['first_link'] = 'First';
			$config['first_tag_open'] = '<li class="paginate_button previous disabled" id="example1_previous">';
			$config['first_tag_close'] = '</li>';
			
			
			$config['prev_link'] = 'Previous';
			$config['prev_tag_open'] = '<li class="paginate_button previous disabled" id="example1_previous">';
			$config['prev_tag_close'] = '</li>';
			
			$config['next_link'] = 'Next';
			$config['next_tag_open'] = '<li class="paginate_button next" id="example1_next">';
			$config['next_tag_close'] = '</li>';
			
			$config['full_tag_open'] ='<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			
			$config['num_tag_open'] = '<li class="paginate_button ">';
			$config['num_tag_close'] = '</li>';
			
			$config['cur_tag_open'] = '<li class="paginate_button active"><a>';
			$config['cur_tag_close'] = '</a></li>';
			
			$config['last_link'] = 'End';
			$config['last_tag_open'] = '<li id="example1_next" class="paginate_button next">';
			$config['last_tag_close'] = '</li>';
			//$config['page_query_string'] = TRUE;
			
			$this->pagination->initialize($config);
			if(isset($_GET['per_page']) && $_GET['per_page']!=''){
				$page = $_GET['per_page'];
			}else{
				$page=0;
			}		
        
		if($showtype == 'ALL')
        {   $data['title_tab'] = $this->lang->line('title');
			$data['get_files'] = $this->view_file->allfile_bycr($user_id, $year, $month, $section, $user,$config['per_page'],$page);
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links);			
			/*Pagination*/
        }elseif($showtype == 'csu'){
            $data['sec_id'] = $sec_id;
            $data['title_tab'] = 'Add scan PDF on this files.';
            $data['get_files'] = $this->view_file->allfile_ofcsu($user_id, $year, $month, $section, $user);
        }else {
            $data['title_tab'] = $this->lang->line('return_file_show');
			//pre('retur -1');
            $data['get_files'] = $this->view_file->getFiles_bycr($user_id,$year, $month, $section, $user,$config['per_page'],$page);
			//pre($data['get_files']);
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links);			
			/*Pagination*/
        }

        $data['module_name'] = "view_file";
        if($showtype == 'csu')
        {   
			$data['view_file'] = "view_file/fileslist_csu_unit";
        }else{
			$data['view_file'] = "view_file/files_cr";
        }
        //   $data['view_left_sidebar'] =  'manage_file/left_sidebar_cr';
        $this->template->index($data);
    }

    // show file list of cr RP
    public function crviewfile_old($showtype='',$sec_id=null)
    {
        $role = $this->session->userdata('user_role');
        $section_exp = explode(',',getEmployeeSection());
        $user_id =  emp_session_id();
		if($this->input->get('files_year') != ''){
			$year = $this->input->get('files_year');
		} else {
			$year = date('Y');
		}
		if($this->input->get('files_month') != ''){
			$month = $this->input->get('files_month');
		} else {
			$month =  date('m');
		}
		if($this->input->get('files_section') != ''){
			$section = $this->input->get('files_section');
        }elseif($sec_id != null && $sec_id != 'all'){
            $section = $sec_id;
        }elseif($section_exp[0] && $role == '39'){ // this is for per user section
            if($user_id == '218' || $sec_id == 'all'){
                $section = '';
            }else{
                $section = $section_exp[0];
            }
        }else {
			$section = '';
		}
		
		if($this->input->get('files_user') != ''){
			$user = $this->input->get('files_user');
		} else {
			$user = '';
		}

		if($this->input->get('type') != '' && $this->input->get('type') == 'all'){
			$year = '';
		}
		
        $data = array();
        $data['title'] = $this->lang->line('view_file_manue');
        //  $section_id = getEmployeeSection();
		
		/*Pagination*/			
			$config["is_question_mark"] = TRUE;									
			if(isset($_GET['files_year']) && $_GET['files_year']!='' && isset($_GET['files_month']) && $_GET['files_month']!='' && isset($_GET['files_section']) && $_GET['files_section']!='' && isset($_GET['files_user']) && $_GET['files_user']!='' ){
				$config["base_url"] = base_url()."show_file/ALL?files_year=".$_GET['files_year'].'&files_month='.$_GET['files_month'].'&files_section='.$_GET['files_section'].'&files_user='.$_GET['files_user'];
			}else{
				$config["base_url"] = base_url()."show_file/ALL?";
			}			
			$total_count = $this->view_file->allfile_bycr_count($user_id, $year, $month, $section, $user);								
			$data['total_files']=$total_count['totalfiles'];
			// Set total rows in the result set you are creating pagination for.
			$config['total_rows'] = $data['total_files'];
			$data['perpage']=PER_PAGE_VALUE;;
			$config["per_page"] = $data['perpage'];		
			
			$config['first_link'] = 'First';
			$config['first_tag_open'] = '<li class="paginate_button previous disabled" id="example1_previous">';
			$config['first_tag_close'] = '</li>';
			
			
			$config['prev_link'] = 'Previous';
			$config['prev_tag_open'] = '<li class="paginate_button previous disabled" id="example1_previous">';
			$config['prev_tag_close'] = '</li>';
			
			$config['next_link'] = 'Next';
			$config['next_tag_open'] = '<li class="paginate_button next" id="example1_next">';
			$config['next_tag_close'] = '</li>';
			
			$config['full_tag_open'] ='<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			
			$config['num_tag_open'] = '<li class="paginate_button ">';
			$config['num_tag_close'] = '</li>';
			
			$config['cur_tag_open'] = '<li class="paginate_button active"><a>';
			$config['cur_tag_close'] = '</a></li>';
			
			$config['last_link'] = 'End';
			$config['last_tag_open'] = '<li id="example1_next" class="paginate_button next">';
			$config['last_tag_close'] = '</li>';
			//$config['page_query_string'] = TRUE;
			
			$this->pagination->initialize($config);
			if(isset($_GET['per_page']) && $_GET['per_page']!=''){
				$page = $_GET['per_page'];
			}else{
				$page=0;
			}		
        
		if($showtype == 'ALL')
        {   $data['title_tab'] = $this->lang->line('title');
			$data['get_files'] = $this->view_file->allfile_bycr($user_id, $year, $month, $section, $user,$config['per_page'],$page);
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links);			
			/*Pagination*/
        }elseif($showtype == 'csu'){
            $data['sec_id'] = $sec_id;
            $data['title_tab'] = 'Add scan PDF on this files.';
            $data['get_files'] = $this->view_file->allfile_ofcsu($user_id, $year, $month, $section, $user);
        }else {
            $data['title_tab'] = $this->lang->line('return_file_show');
            $data['get_files'] = $this->view_file->getFiles_bycr($user_id);
        }

        $data['module_name'] = "view_file";
        if($showtype == 'csu')
        {   
			$data['view_file'] = "view_file/fileslist_csu_unit";
        }else{
			$data['view_file'] = "view_file/files_cr";
        }
        //   $data['view_left_sidebar'] =  'manage_file/left_sidebar_cr';
        $this->template->index($data);
    }

    public function viewDetails($file_id = null)
    {
        if($file_id != null) {
            $data = array();
            $data['title'] = $this->lang->line('view_file_manue');
            $data['title_tab'] = $this->lang->line('view_file_details');
            $data['file_details'] = $this->view_file->getFileDetails($file_id);
           // $file_log = $this->view_file->getFiles_log($file_id);
           // $data['file_log'] = $file_log; 
           
           // $file_movement = $this->view_file->getFiles_movement($file_id);
          //  $data['file_movement'] = $file_movement;
            
            $data['getFiles_details'] = $this->view_file->getFiles_movement_details($file_id);
            
            // pre($data['file_log']);
            $data['module_name'] = "view_file";
            $data['view_left_sidebar'] = 'manage_file/left_sidebar_cr';
            //	$data['view_left_sidebar'] =  'admin/left_sidebar';
            $data['view_file'] = "view_file";
            $this->template->index($data);
        }else{
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
public function showlog($file_id = null)
    { 
			$file_id = $this->uri->segment(3);
			$file_log = $this->view_file->getFiles_log($file_id);
            $data['file_log'] = $file_log;
	 $this->load->view('view_log',$data);
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
        $data['module_name'] = "view_file";
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
		$section_category = '' ;
	    $section_category = $this->input->get('cate') ;
        if(isset($section_ids1)){
            $section_ids2 = $section_ids1 ;
        } else { $section_ids2 = null ; }
        /*if($id != null) {
            $data['page1'] = $id;
            $data['title_tab'] = $this->lang->line('return_files');
            $data['get_files'] = getFiledata_inlist_desc(null,$section_ids2, $section_category);
        }else {
            $data['title_tab'] = $this->lang->line('received_files');
            $data['get_files'] = getFiledata_inlist_asc(null,$section_ids2 , $section_category);
        }*/
		/*Pagination*/
		    $config["is_question_mark"] = TRUE;
			if(isset($_GET['section_id']) && $_GET['section_id']!=''){
				$config["base_url"] = base_url()."view_file/Dispaly_list?section_id=".$_GET['section_id'];
			}elseif(isset($_GET['searchby']) && $_GET['searchby']!=''){
				$config["base_url"] = base_url()."view_file/Dispaly_list?searchby=".$_GET['searchby'];
			}elseif($_GET['searchby']!='' && $_GET['section_id']!=''){
				$config["base_url"] = base_url()."view_file/Dispaly_list?section_id=".$_GET['searchby']."&searchby=".$_GET['searchby'];
			}else{
				$config["base_url"] = base_url()."view_file/Dispaly_list?";
			}
			//$config["base_url"] = $this->current_url();
			$total_count = $this->view_file->getFiledata_inlist_desc_count(null,$section_ids2, $section_category);					
			$data['total_files']=$total_count['totalfiles'];
			// Set total rows in the result set you are creating pagination for.
			$config['total_rows'] = $data['total_files'];
			$data['perpage']=PER_PAGE_VALUE;
			$config["per_page"] = $data['perpage'];		
			
			$config['first_link'] = 'First';
			$config['first_tag_open'] = '<li class="paginate_button previous disabled" id="example1_previous">';
			$config['first_tag_close'] = '</li>';
			
			
			$config['prev_link'] = 'Previous';
			$config['prev_tag_open'] = '<li class="paginate_button previous disabled" id="example1_previous">';
			$config['prev_tag_close'] = '</li>';
			
			$config['next_link'] = 'Next';
			$config['next_tag_open'] = '<li class="paginate_button next" id="example1_next">';
			$config['next_tag_close'] = '</li>';
			
			$config['full_tag_open'] ='<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			
			$config['num_tag_open'] = '<li class="paginate_button ">';
			$config['num_tag_close'] = '</li>';
			
			$config['cur_tag_open'] = '<li class="paginate_button active"><a>';
			$config['cur_tag_close'] = '</a></li>';
			
			$config['last_link'] = 'End';
			$config['last_tag_open'] = '<li id="example1_next" class="paginate_button next">';
			$config['last_tag_close'] = '</li>';
			//$config['page_query_string'] = TRUE;
			
			$this->pagination->initialize($config);
			if(isset($_GET['per_page']) && $_GET['per_page']!=''){
				$page = $_GET['per_page'];
			}else{
				$page=0;
			}
			//$data['vender_list'] = $this->user_model->getFiledata_inlist_desc($category,$city,$area,$config['per_page'], $page);	
			$data['get_files'] = $this->view_file->getFiledata_inlist_desc(null,$section_ids2, $section_category,$config['per_page'], $page);			
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links );			
			/*Pagination*/
		$data['title_tab'] = $this->lang->line('received_files'); 
        $data['module_name'] = "view_file";
        $data['view_file'] = "view_file/view_file_list";
        $data['view_left_sidebar'] =  'admin/left_sidebar';
        $this->template->index($data);
    }
    //rp
   /* public function return_fileofficer($file_id = null)
    {

        $role1 = empdetails(emp_session_id());
       // $query = $this->db->query("SELECT `emp_id`,`emp_full_name` FROM `ft_employee` WHERE `emp_id` in (SELECT DISTINCT `fmove_previous_user_id` FROM `ft_file_movements` WHERE `fmove_file_id`=".$file_id." and fmove_id < (SELECT `fmove_id` FROM `ft_file_movements` WHERE `fmove_file_id`=".$file_id." and `fmove_previous_user_id`=".emp_session_id()." LIMIT 1)) and `emp_id` != ".emp_session_id()." and role_id !='9' order by emp_id asc");
        $query = $this->db->query("SELECT ft_employee.emp_full_name_hi, ft_employee.emp_id ,ft_employee.role_id , ft_emprole_master.emprole_name_hi , ft_sections_master.section_name_hi, ft_sections_master.section_id FROM ft_employee inner join ft_emprole_master on ft_emprole_master.role_id = ft_employee.role_id left join ft_sections_master on ft_sections_master.section_id = ft_employee.emp_section_id  WHERE ((ft_employee.role_id < '12' AND ft_employee.role_id > '".$role1[0]['role_id']."'  AND ft_employee.role_id not in ('1','2','9','10')) or ft_employee.role_id in ('37','14','15')) and ft_employee.emp_status = '1' and ft_employee.emp_is_retired = '0' order by ft_employee.role_id asc");
        $res_array =  $query->result_array();
        echo json_encode($res_array);
        exit();
    } */
	
	//upated by -Rohit on 15/12/2015 return_fileofficer()
	public function return_fileofficer($file_id = null)
    {
		if(checkUserrole()==8){
			$this->section_da_name();
		}else{
			$select = "SELECT ft_employee_details.emp_detail_gender,ft_employee.emp_full_name_hi, ft_employee.emp_id ,ft_employee.role_id , ft_emprole_master.emprole_name_hi , ft_sections_master.section_name_hi, ft_sections_master.section_id ,ft_employee.emp_section_id FROM ft_employee inner join ft_employee_details on ft_employee_details.emp_id = ft_employee.emp_id inner join ft_emprole_master on ft_emprole_master.role_id = ft_employee.role_id left join ft_sections_master on ft_sections_master.section_id = ft_employee.emp_section_id  WHERE  emp_posting_location ='1' and ";
			$role1 = empdetails(emp_session_id());
			if($role1[0]['role_id'] == 11){
				$where = "ft_employee.role_id in ('7','8','37','14','15')";
			}else {
				$where = "((ft_employee.role_id < '12' AND ft_employee.role_id > '".$role1[0]['role_id']."'  AND ft_employee.role_id not in ('1','2','9','10')) or ft_employee.role_id in ('37','14','15'))";
			}
			$by = " and (ft_employee.emp_status = '1' and ft_employee.emp_is_retired = '0') order by ft_employee.role_id asc";
			$query = $this->db->query($select.' '.$where.' '.$by);
			$res_array =  $query->result_array();
	
			//emp_section_id
			$section_array = array();
			foreach($res_array as $ky=>$res){
					$section  = $this->view_file->get_employee_alloted_section($res['emp_section_id'] );
					$res_array[$ky]['section_name']=$section[0];
						//print_r($section );
			}
			
			
			//echo $this->db->last_query();
			//die;
			echo json_encode($res_array);
			exit();
		}
    }
	
    public function section_da_name($is_return=false)
    {
		if(checkUserrole()==8){
			$res_1 = $this->view_file->get_DAname(getEmployeeSection());
		}else{			
			$res_1 = $this->view_file->get_DAname(getEmployeeSection(),emp_session_id());
		}
		$res_1 = (array) $res_1;    
		//print_r($res_1);die;
		//emp_section_id
			$section_array = array();
			foreach($res_1 as $ky=>$res){
					//echo $res['emp_section_id']; die;
					$section  = $this->view_file->get_employee_alloted_section($res['emp_section_id'] );
					$res_1[$ky]['section_name']=$section[0];
						//print_r($section );
			}
		if($is_return==true){
			return $res_1;
		}else{
			echo json_encode($res_1);
		}
        exit();
    }

	public function get_da_name_whoiscreatefilename(){
		$fileid= $this->input->post('fileid');
		$lvlname = $this->input->post('lvlname');
		$sectionid = $this->input->post('sectionid');		
		$file_draftId = $this->input->post('file_draft_id');	
		$rowid = $this->input->post('rowid');
		$dropdown='';
		/*if($sectionid=='' || $sectionid==null){
			get_row("SELECT * FROM ( ft_".FILES.") WHERE `file_id` = $fileid");
			$sectionid = $draft_detail['file_mark_section_id'];
		}*/
		if($sectionid=='' || $sectionid==null){
			$filse_section_array = get_row("SELECT file_mark_section_id FROM ( ft_".FILES.") WHERE `file_id` = $fileid");
			$sectionid = $filse_section_array['file_mark_section_id'];			
		}
		$role_id = get_employee_role(emp_session_id(),true);		
		if($lvlname == 6){ /* for SO show all section employees*/
			$draft_detail = get_list(DRAFT,null,array('draft_id'=>$file_draftId,'draft_file_id'=>$fileid));
			$file_creator_id = $draft_detail[0]['draft_creater_emp_id'];
		}else if(in_array($lvlname, array(2,3,4,5,7))){ /*for all officers show section officer*/
			$draft_detail = get_list(EMPLOYEES,null,"(role_id = 8 or role_id = 37) and FIND_IN_SET($sectionid,emp_section_id)");
			$file_creator_id = $draft_detail[0]['emp_id'];
		}else if($lvlname == 1){ /* for PS show sender name*/
			$draft_detail = get_row("SELECT * FROM (ft_file_movements) WHERE `fmove_file_id` = $fileid ORDER BY fmove_id DESC LIMIT 1,1");
			$file_creator_id = $draft_detail['fmove_previous_user_id'];
		}
			$section_ids = getusersection($file_creator_id);
			$dataarray = explode(',',$section_ids);
			$section_array = get_list_with_in(SECTIONS,null,'section_id',$dataarray);
			//pre($section_array);
			$dropdown='<select class="section_id" id="section_id'.$fileid.'" name="section_id['.$rowid.']">';
			//$dropdown.='<option></option>';
			foreach($section_array as $ky=>$val){
			if($val['section_id'] == $sectionid){
                    $select = "selected";
                }else{
                    $select = "";
                }
				$dropdown.='<option  value="'.$val['section_id'].'" '.$select.'>'.$val['section_name_hi'].'('.$val['section_name_en'].') </option>';
			}			
			$dropdown.='</select>';		
		echo json_encode(array('file_creator_id'=>$file_creator_id,'sections'=>$dropdown));
		exit;
		
	}
    public function upper_role_officer($file_id = null)
    {
        $role1 = empdetails(emp_session_id());
        $filedetails =  getFileDetails($file_id);
        $query = $this->db->query("SELECT ft_employee_details.emp_detail_gender,ft_employee.emp_full_name,ft_employee.emp_full_name_hi, ft_employee.emp_id , ft_emprole_master.emprole_name_hi FROM ft_employee inner join ft_employee_details on ft_employee_details.emp_id = ft_employee.emp_id  inner join ft_emprole_master on ft_emprole_master.role_id =  ft_employee.role_id  WHERE ft_employee.role_id < ".$role1[0]['role_id']." AND ft_emprole_master.role_id not in ('8','9','10','1') and ft_employee.emp_status = '1' and ft_employee.emp_is_retired = '0' order by ft_employee.role_id desc");
        $res_array1 =  $query->result_array();
        echo json_encode($res_array1);
        exit();
    }
	
	  // this is new function for fetch upper officer id
	/* public function upper_role_officer_new($file_id = null)
    {
        $role1 = empdetails(emp_session_id());
       // $filedetails =  getFileDetails($file_id);
        $query = $this->db->query("SELECT ft_employee.emp_full_name, ft_employee.emp_id , ft_emprole_master.emprole_name_hi FROM ft_employee inner join ft_emprole_master on ft_emprole_master.role_id =  ft_employee.role_id  WHERE ft_employee.role_id < ".$role1[0]['role_id']." AND ft_employee.role_id != '1' OR ft_employee.role_id = '11' and ft_employee.emp_status = '1' and ft_employee.emp_is_retired = '0' order by ft_employee.role_id desc");
        $res_array1 =  $query->result_array();

        $query1 = $this->db->query("SELECT emp_id as upperofficid FROM `ft_employee_hirarchi` WHERE `under_emp_id` = ".$role1[0]['emp_id']);
        $res_array2 =  $query1->result_array();
        echo json_encode(array($res_array1,$res_array2));
        exit();
    } */
    
   //upated by -Rohit on 15/12/2015 upper_role_officer_new()
	/*public function upper_role_officer_new($file_id = null)
    {
		$select = "SELECT ft_employee_details.emp_detail_gender,ft_employee.emp_full_name,ft_employee.emp_full_name_hi, ft_employee.emp_id , ft_emprole_master.emprole_name_hi FROM ft_employee inner join ft_employee_details on ft_employee_details.emp_id = ft_employee.emp_id inner join ft_emprole_master on ft_emprole_master.role_id =  ft_employee.role_id  WHERE ";
        $role1 = empdetails(emp_session_id());
		if($role1[0]['role_id'] == 11){
			$where = "ft_employee.role_id in ('3','4','5','6')";
		}else {
			$where = "(ft_employee.role_id < ".$role1[0]['role_id']." AND ft_employee.role_id != '1' OR ft_employee.role_id = '11')";
		}
		$by = " and (ft_employee.emp_status = '1' and ft_employee.emp_is_retired = '0') order by ft_employee.role_id desc";
        $query = $this->db->query($select.' '.$where.' '.$by);
        $res_array1 =  $query->result_array();

        $query1 = $this->db->query("SELECT emp_id as upperofficid FROM `ft_employee_hirarchi` WHERE `under_emp_id` = ".$role1[0]['emp_id']);
        $res_array2 =  $query1->result_array();
        echo json_encode(array($res_array1,$res_array2));
        exit();
    }*/
	
	//raginee 4 march
	public function upper_role_officer_new($file_id = null)    {
		$select = "SELECT ft_employee_details.emp_detail_gender,ft_employee.emp_full_name,ft_employee.emp_full_name_hi, ft_employee.emp_id , ft_emprole_master.emprole_name_hi FROM ft_employee inner join ft_employee_details on ft_employee_details.emp_id = ft_employee.emp_id inner join ft_emprole_master on ft_emprole_master.role_id =  ft_employee.role_id  WHERE  emp_posting_location ='1' and ";
        $role1 = empdetails(emp_session_id());
		$emp_role_n = $role1[0]['role_id'];
		if($role1[0]['role_id'] == 11){
			$where = "ft_employee.role_id in ('3','4','5','6')";
		}else {
            $role_11 = '';
            if($role1[0]['role_id'] >= 7){
            $role_11 = " OR ft_employee.role_id = '11'";
            }
			if($role1[0]['role_id'] == 8){
            $emp_role_n = '7';
            }
			$where = "(ft_employee.role_id <= ".$emp_role_n." AND ft_employee.role_id != '1' $role_11)";
		}
		$by = " and ft_employee.emp_id != ".$role1[0]['emp_id']." and (ft_employee.emp_status = '1' and ft_employee.emp_is_retired = '0') order by ft_employee.role_id asc";
        $query = $this->db->query($select.' '.$where.' '.$by);
        $res_array1 =  $query->result_array();

        $query1 = $this->db->query("SELECT emp_id as upperofficid FROM `ft_employee_hirarchi` WHERE `under_emp_id` = ".$role1[0]['emp_id']);
        $res_array2 =  $query1->result_array();
        echo json_encode(array($res_array1,$res_array2));
        exit();
    }
	
	public function upper_role_officer_list($file_id = null)
    {
		$select = "SELECT ft_employee_details.emp_detail_gender,ft_employee.emp_full_name,ft_employee.emp_full_name_hi, ft_employee.emp_id , ft_emprole_master.emprole_name_hi FROM ft_employee inner join ft_employee_details on ft_employee_details.emp_id = ft_employee.emp_id inner join ft_emprole_master on ft_emprole_master.role_id =  ft_employee.role_id  WHERE emp_posting_location ='1' and ";
        $role1 = empdetails(emp_session_id());
		$where = "ft_employee.role_id in ('3','4','5','6','7','11')";
		$by = " and (ft_employee.emp_status = '1' and ft_employee.emp_is_retired = '0') order by ft_employee.role_id desc";
        $query = $this->db->query($select.' '.$where.' '.$by);
        $res_array1 =  $query->result_array();

        $query1 = $this->db->query("SELECT emp_id as upperofficid FROM `ft_employee_hirarchi` WHERE `under_emp_id` = ".$role1[0]['emp_id']);
        $res_array2 =  $query1->result_array();
        echo json_encode(array($res_array1,$res_array2));
        exit();
    }

    public function  view_notesheet($id = ''){
        if($id != ''){
            $contains = $this->notesheet_model->view_notesheets($id);
            if($contains != false){
                $data['contains'] = $contains;
				$data['file_detail'] = $contains;
                $this->load->view('view_notesheet',$data);
            } else {
                $this->show_404();
            }
        }else {
            return false;
        }
    }
	
	public function section_off_nm($file_id = null)
    {
       $sectionid = $this->input->post('file_section_id');
   // $filedetails =  getFileDetails($file_id);
    $section_section_name = section_section_name();
   // $markssec = $section_section_name[$filedetails->file_mark_section_id];
   // $query = $this->db->query("SELECT section_id, section_name_hi, section_name_en FROM ft_sections_master where section_id=".$markssec);
   // $query = $this->db->query("SELECT section_id, section_name_hi, section_name_en FROM ft_sections_master where section_id not in ('1','8')");
      if(isset($sectionid) && $sectionid != ''){
	  $query = $this->db->query("SELECT section_id, section_name_hi, section_name_en FROM ft_sections_master where section_id not in ('1','8',26,21) and section_id not in (".$sectionid.")");
		  }else{
		  $query = $this->db->query("SELECT section_id, section_name_hi, section_name_en FROM ft_sections_master where section_id not in ('1','8','26','21')");
		  }      
     $res_array1 =  $query->result_array();
        echo json_encode($res_array1);
        exit();
    }
    
    public function show_404() {
        $this->load->view('404');
    }
	
	/*18/09/2015 show assign task*/
	public function assign_other_employees_files($id=null)
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
        $data['module_name'] = "view_file";
        if(in_array('8',$section_explode)) // 8 is dispatch section id.
        {
			$data['get_files'] = $this->view_file->dispatch_getFiles($id);
            $data['view_file'] = "view_file/dispatch_file_list";

        }else {
            $moveup_down = $id;
			//section_explode
			//$section_explode.'-'.$moveup_down;
			//echo $section_explode;
			if($this->session->userdata("emp_id")==135){
				if($_GET['test']=='ab'){
					$data['get_files'] = $this->view_file->getFiles_2_testing($section_explode, $moveup_down);
				}else{
					$data['get_files'] = $this->view_file->getFiles_2($section_explode, $moveup_down);
				}
			}else{
				$data['get_files'] = $this->view_file->getFiles_2($section_explode, $moveup_down);
			}
			//getFiles_2_testing
			
			if($_GET['test']=='ab'){
			  pre($data['get_files']);
			}
				//pre($data['get_files']);
            $data['view_file'] = "view_file/index";
        }
		//pr($data['get_files']);
        $data['view_left_sidebar'] = 'admin/left_sidebar';
        $this->template->index($data);
    }
	/*End show assign task*/

	/* Searching file in cr section for printing created - Rohit*/
	function search_files_cr(){
		$this->form_validation->set_rules('sections', 'Sections', 'required');
        $this->form_validation->set_rules('search_date', 'Date', 'required');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		
		$user_id =  emp_session_id();
		/*Pagination*/			
			$config["is_question_mark"] = TRUE;									
			if(isset($_GET['sections']) && $_GET['sections']!='' && isset($_GET['search_date']) && $_GET['search_date']!=''){
				$config["base_url"] = base_url()."view_file/search_files_cr?sections=".$_GET['sections'].'&search_date='.$_GET['search_date'];
			}else{
				$config["base_url"] = base_url()."show_file/ALL?";
			}	
			if($this->input->get('sections')!='' && $this->input->get('search_date')!=''){
				$section_id = trim($this->input->get('sections'));
				$search_date = trim($this->input->get('search_date'));			
				$total_count = $this->view_file->count_files_search_cr($section_id, $search_date);
			}else{
				
				$total_count = $this->view_file->allfile_bycr_count($user_id, null,null, null, null);								
			} 			
			$data['total_files']=$total_count['totalfiles'];
			// Set total rows in the result set you are creating pagination for.
			$config['total_rows'] = $data['total_files'];
			$data['perpage']=PER_PAGE_VALUE;;
			$config["per_page"] = $data['perpage'];		
			
			$config['first_link'] = 'First';
			$config['first_tag_open'] = '<li class="paginate_button previous disabled" id="example1_previous">';
			$config['first_tag_close'] = '</li>';
			
			
			$config['prev_link'] = 'Previous';
			$config['prev_tag_open'] = '<li class="paginate_button previous disabled" id="example1_previous">';
			$config['prev_tag_close'] = '</li>';
			
			$config['next_link'] = 'Next';
			$config['next_tag_open'] = '<li class="paginate_button next" id="example1_next">';
			$config['next_tag_close'] = '</li>';
			
			$config['full_tag_open'] ='<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			
			$config['num_tag_open'] = '<li class="paginate_button ">';
			$config['num_tag_close'] = '</li>';
			
			$config['cur_tag_open'] = '<li class="paginate_button active"><a>';
			$config['cur_tag_close'] = '</a></li>';
			
			$config['last_link'] = 'End';
			$config['last_tag_open'] = '<li id="example1_next" class="paginate_button next">';
			$config['last_tag_close'] = '</li>';
			//$config['page_query_string'] = TRUE;
			
			$this->pagination->initialize($config);
			if(isset($_GET['per_page']) && $_GET['per_page']!=''){
				$page = $_GET['per_page'];
			}else{
				$page=0;
			}
        if($this->input->get('sections')!='' && $this->input->get('search_date')!=''){
			
			$section_id = trim($this->input->get('sections'));
			$search_date = trim($this->input->get('search_date'));			
			$data['get_files'] = $this->view_file->files_search_cr($section_id, $search_date,$config['per_page'],$page);
		} else {
		
			$data['get_files'] = $this->view_file->allfile_bycr($user_id,null,null,null,null,$config['per_page'],$page);			
		}
		$str_links = $this->pagination->create_links();
		$data["links"] = explode('&nbsp;',$str_links);			
		/*Pagination*/
        $data['title'] = $this->lang->line('view_file_manue');       
		$data['title_tab'] = $this->lang->line('title');
		
        $data['module_name'] = "view_file";
        $data['view_file'] = "view_file/files_cr";
        $this->template->index($data);	
	}
	
	    public function send_file_return($showtype='')
    {
        $data = array();
        $data['title'] = 'अंकित की गई फाइलें';
        //  $section_id = getEmployeeSection();
        $user_id =  emp_session_id();
        $data['title_tab'] = 'यह वह फाइलें है जो आपके द्वारा किसी को अंकित की गई  है , लेकिन उन्होंने  प्राप्त नही किया है |';
        $data['get_files'] = $this->view_file->send_getFiles();
        $data['module_name'] = "view_file";
        $data['view_file'] = "view_file/send_file_return";
        //   $data['view_left_sidebar'] =  'manage_file/left_sidebar_cr';
        $this->template->index($data);
    }
	public function check_user_section()
	{
		$emp_id = $this->input->post('emp_id');
		$empdetails = empdetails($emp_id) ;		
		$emp_section_id = $empdetails[0]['emp_section_id'];	
		$sectionids = explode( ',',$emp_section_id );
		//if(( ( $empdetails[0]['role_id'] == 8 ) && (count($sectionids)>1))||( ( $empdetails[0]['role_id'] == 37 ) && (count($sectionids)>1))){ 
		if(( ( $empdetails[0]['role_id'] == 14 ) && (count($sectionids)>1))||( ( $empdetails[0]['role_id'] == 8 ) && (count($sectionids)>1))||( ( $empdetails[0]['role_id'] == 37 ) && (count($sectionids)>1))){ 
			$section_array=get_list_with_in(SECTIONS, '' ,'section_id',$sectionids);
		//	pr($section_array);
		echo json_encode($section_array);
        
		}else{
			$nul=0;
			echo json_encode($nul);
		}
		exit();
		
	}
	
	public function get_physical_file_from_log()
	{
		$file_id = $this->input->post('file_id');
		$file_status = $this->input->post('file_status');
		$query = $this->db->query("SELECT * from ft_file_logs where `file_status_log` like '%p%' and file_id = ".$file_id ."  order by `flog_id` desc limit 1");
		 $res_array1 =  $query->result_array();

		 //echo $this->db->last_query();
		echo json_encode($res_array1);
		exit();
		
    }
	public function file_details_for_suspence()
	{
		$file_id = $this->input->post('file_id');
		 $filedetails =  getFileDetails($file_id);
		$section_name = getSection($filedetails->file_mark_section_id);
		$panji_no = get_panji_no($filedetails->file_id,$filedetails->file_mark_section_id,$filedetails->file_created_date);
		
		$dispatch_dept = json_decode($filedetails->dispatch_lists);
		$remark = get_file_log_data('' ,$file_id );
		$rrt = all_getfilesec_id_byfileid($file_id);
		foreach($rrt as $rrt1){
				if($rrt1['section_id']==8){
					$dispetch_no = $rrt1['section_number'];
			}
		}
		 $suspence_slipe_array = array(
		 'file_from_section' => $section_name ,
		 'panji_no'			=> $panji_no,
		 'file_come_in_dept' => get_date_formate($filedetails->file_created_date,'d/m/Y'),
		 'dispetch_dept' => $dispatch_dept[0] ,
		 'dispetch_file_type' => $filedetails->dispetch_file_type,
		 'file_subject' => $filedetails->file_subject,
		 'flog_remark' => isset($remark['flog_remark'])?$remark['flog_remark']:'',
		 'dispetch_no' =>$dispetch_no
		 );
		//print_r( $suspence_slipe_array);
		echo json_encode($suspence_slipe_array);
		exit();
    }
	
	 public function fn_pre_page_entry(){
		$pre_page = $this->input->post('pre_page_entry');
		//if($this->session->userdata('emp_section_id')=='2,11,17' || $this->session->userdata('emp_section_id')==26)
        //{ $pre_page =10; }	
        $cookie_name = "per_page_entry";
        $this->session->set_userdata($cookie_name,$pre_page);
		//define(PER_PAGE_VALUE,PER_PAGE_VALUE_1);
        echo 'success';
        exit;
    }
    
    	public function section_all_nm($file_id = null)
    {
        $query = $this->db->query("SELECT section_id, section_name_hi, section_name_en FROM ft_sections_master where section_id not in ('1','8',26,21)");
        $res_array1 =  $query->result_array();
        echo json_encode($res_array1);
        exit();
    }
	
}