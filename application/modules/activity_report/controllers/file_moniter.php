	<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class File_moniter	 extends MX_Controller {
    function __construct() {
        parent::__construct();
        $this->load->module('template');
        $this->load->language('view_file','hindi');
        $this->load->model('file_moniter_activity','file_moniter');
        $this->load->helper('condition');
		$this->load->library('pagination');
        authorize();
    }
    public function index()
    {
        $data = array();
        $section_id = getEmployeeSection();
        $section_explode =  explode(',',$section_id);
        $sec_id = $this->input->get('secid') != '' ? $this->input->get('secid') : '';
        $status = $this->input->get('s') != '' ? $this->input->get('s') : '';
        $empid = $this->input->get('emp') != '' ? $this->input->get('emp') : '';
		$s_date = $this->input->get('s_date') != '' ? $this->input->get('s_date') : '';
        $e_date = $this->input->get('e_date') != '' ? $this->input->get('e_date') : '';
        $on = $this->input->get('on') != '' ? $this->input->get('on') : '';
        if(isset($status))
        { $sec = $status ;} else { $sec = null ; }
        if(isset($empid)){
            $empid1 =  $empid;
        } else { $empid1 =  null; }
        if(isset($_GET['emp'])){
			$empname = getemployeeName($_GET['emp'],true,true);			
			$data['title'] = 'आप '.$empname.'  की फाइलें देख रहे हैं';
		}else{
			$data['title'] = $this->lang->line('view_file_manue');
		}
        $data['title_tab'] = 'File moniter';
		/*Pagination*/			
		$config["is_question_mark"] = TRUE;									
		/*if(isset($_GET['secid']) && $_GET['secid']!=''){
			$config["base_url"] = base_url()."reports/moniter?secid=".$_GET['secid'];
		}
		if(isset($_GET['secid']) && $_GET['secid']!='' && isset($_GET['s']) && $_GET['s']!='' && isset($_GET['lvl']) && $_GET['lvl']!=''){
			$config["base_url"] = base_url()."reports/moniter?secid=".$_GET['secid'].'&s='.$_GET['s'].'&lvl='.$_GET['lvl'];
		}		
		if(isset($_GET['secid']) && $_GET['secid']!='' && isset($_GET['s']) && $_GET['s']!=''){
				$config["base_url"] = base_url()."reports/moniter?secid=".$_GET['secid'].'&s='.$_GET['s'];
		}if(isset($_GET['secid']) && $_GET['secid']!='' && isset($_GET['s']) && $_GET['s']!='' && isset($_GET['lvl']) && $_GET['lvl']!=''){
				$config["base_url"] = base_url()."reports/moniter?secid=".$_GET['secid'].'&s='.$_GET['s'].'&a='.$_GET['a'].'&lvl='.$_GET['lvl'];
		}if(isset($_GET['secid']) && $_GET['secid']!='' && isset($_GET['s']) && $_GET['s']!='' && isset($_GET['emp']) && $_GET['emp']!=''){
				$config["base_url"] = base_url()."reports/moniter?secid=".$_GET['secid'].'&s='.$_GET['s'].'&a='.@$_GET['a'].'&emp='.$_GET['emp'];
		}
		if(isset($_GET['secid']) && $_GET['secid']!='' && isset($_GET['emp']) && $_GET['emp']!=''){
				$config["base_url"] = base_url()."reports/moniter?secid=".$_GET['secid'].'&emp='.$_GET['emp'];
		}
		if(isset($_GET['emp']) && $_GET['emp']!=''){
				$config["base_url"] = base_url()."reports/moniter?emp=".$_GET['emp'];
		}*/
		$config["base_url"] = paging_url();
		$total_count = $this->file_moniter->count_files_monitore($sec_id, $sec, $empid1, $s_date, $e_date,$on,null,null);												
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
        $data['get_files'] = $this->file_moniter->getFiles($sec_id, $sec, $empid1, $s_date, $e_date, $on,$config['per_page'],$page);
		$str_links = $this->pagination->create_links();
		$data["links"] = explode('&nbsp;',$str_links);			
		/*Pagination*/
        $data['module_name'] = "activity_report";
        $data['view_file'] = "activity_report/file_moniter";
        $data['view_left_sidebar'] = 'admin/left_sidebar';
        $this->template->index($data);
    }
	
	public function files_log(){
		$sec_id = $this->input->get('secid') != '' ? $this->input->get('secid') : '';
        $status = $this->input->get('s') != '' ? $this->input->get('s') : '';
        $empid = $this->input->get('emp') != '' ? $this->input->get('emp') : '';
		$s_date = $this->input->get('s_date') != '' ? $this->input->get('s_date') : '';
        $e_date = $this->input->get('e_date') != '' ? $this->input->get('e_date') : '';
        $action = $this->input->get('a') != '' ? $this->input->get('a') : '';
		$data['title'] = $this->lang->line('view_file_manue');
        $data['title_tab'] = 'File moniter';
		/*Pagination*/			
		$config["is_question_mark"] = TRUE;									
		if(isset($_GET['secid']) && $_GET['secid']!=''){
			$config["base_url"] = base_url()."reports/moniter?secid=".$_GET['secid'];
		}if(isset($_GET['secid']) && $_GET['secid']!='' && isset($_GET['s']) && $_GET['s']!=''){
				$config["base_url"] = base_url()."reports/moniter?secid=".$_GET['secid'].'&s='.$_GET['s'];
		}if(isset($_GET['secid']) && $_GET['secid']!='' && isset($_GET['s']) && $_GET['s']!='' && isset($_GET['lvl']) && $_GET['lvl']!=''){
				$config["base_url"] = base_url()."reports/moniter?secid=".$_GET['secid'].'&s='.$_GET['s'].'&lvl='.$_GET['lvl'];
		}if(isset($_GET['secid']) && $_GET['secid']!='' && isset($_GET['s']) && $_GET['s']!='' && isset($_GET['lvl']) && $_GET['lvl']!=''){
				$config["base_url"] = base_url()."reports/moniter?secid=".$_GET['secid'].'&s='.$_GET['s'].'&a='.$_GET['a'].'&lvl='.$_GET['lvl'];
		}if(isset($_GET['secid']) && $_GET['secid']!='' && isset($_GET['s']) && $_GET['s']!='' && isset($_GET['emp']) && $_GET['emp']!=''){
				$config["base_url"] = base_url()."reports/moniter?secid=".$_GET['secid'].'&s='.$_GET['s'].'&a='.@$_GET['a'].'&emp='.$_GET['emp'];
		}
		//if(isset($_GET['secid']) && $_GET['secid']!='' && isset($_GET['emp']) && $_GET['emp']!=''){
		if(isset($_GET['searchby']) && $_GET['searchby']!=''){
			$config["base_url"] = base_url()."activity_report/file_moniter/files_log?a=".$_GET['a'].'&emp='.$_GET['emp'].'&s_date='.$_GET['s_date'].'&e_date='.$_GET['e_date'].'&searchby='.$_GET['searchby'];
		}else{
			$config["base_url"] = base_url()."activity_report/file_moniter/files_log?a=".$_GET['a'].'&emp='.$_GET['emp'].'&s_date='.$_GET['s_date'].'&e_date='.$_GET['e_date'];
		}
		//}
		///else{
		//	$config["base_url"] = base_url()."view_file?";
		//}			
		$total_count = $this->file_moniter->count_getFiles_log($empid, $s_date, $e_date, $action, $status);
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
        $data['get_files'] = $this->file_moniter->getFiles_log($empid, $s_date, $e_date, $action, $status,$config['per_page'],$page);
        //$data['get_files'] = $this->file_moniter->getFiles($sec_id, $sec, $empid1, $s_date, $e_date, $on,$config['per_page'],$page);
		$str_links = $this->pagination->create_links();
		$data["links"] = explode('&nbsp;',$str_links);			
		/*Pagination*/
        //$data['get_files'] = $this->file_moniter->getFiles_log($empid, $s_date, $e_date, $action, $status);
        $data['module_name'] = "activity_report";
        $data['view_file'] = "activity_report/file_moniter";
        $data['view_left_sidebar'] = 'admin/left_sidebar';
        $this->template->index($data);
	}
	
	public function files_cr_old106(){
		$sec_id = $this->input->get('secid') != '' ? $this->input->get('secid') : '';
        $type = $this->input->get('t') != '' ? $this->input->get('t') : '';
        $empid = $this->input->get('emp') != '' ? $this->input->get('emp') : '';
		$s_date = $this->input->get('s_date') != '' ? $this->input->get('s_date') : '';
        $e_date = $this->input->get('e_date') != '' ? $this->input->get('e_date') : '';
		$data['title'] = $this->lang->line('view_file_manue');
        $data['title_tab'] = 'File moniter';
        $data['get_files'] = $this->file_moniter->getFiles_cr($sec_id, $empid, $s_date, $e_date, $type);
        $data['module_name'] = "activity_report";
        $data['view_file'] = "activity_report/file_moniter";
        $data['view_left_sidebar'] = 'admin/left_sidebar';
        $this->template->index($data);
	}
	public function files_cr(){
		$sec_id = $this->input->get('secid') != '' ? $this->input->get('secid') : '';
        $type = $this->input->get('t') != '' ? $this->input->get('t') : '';
        $empid = $this->input->get('emp') != '' ? $this->input->get('emp') : '';
		$s_date = $this->input->get('s_date') != '' ? $this->input->get('s_date') : '';
        $e_date = $this->input->get('e_date') != '' ? $this->input->get('e_date') : '';
		$data['title'] = $this->lang->line('view_file_manue');
        $data['title_tab'] = 'File monitor';
		
		/*Pagination*/			
		$config["is_question_mark"] = TRUE;									
		/*if(isset($_GET['secid']) && $_GET['secid']!=''){
			$config["base_url"] = base_url()."activity_report/file_moniter/files_cr?secid=".$_GET['secid'];
		}if(isset($_GET['secid']) && $_GET['secid']!='' && isset($_GET['t']) && $_GET['t']!=''){
				$config["base_url"] = base_url()."activity_report/file_moniter/files_cr?secid=".$_GET['secid'].'&t='.$_GET['t'];
		}
		if(isset($_GET['secid']) && $_GET['secid']!='' && isset($_GET['t']) && $_GET['t']!='' && isset($_GET['s_date']) && $_GET['s_date']!='' && isset($_GET['e_date']) && $_GET['e_date']!=''){
				$config["base_url"] = base_url()."activity_report/file_moniter/files_cr?secid=".$_GET['secid']."&t=".$_GET['t']."&s_date=".$_GET['s_date'].'&e_date='.$_GET['e_date'];
		}
		if(isset($_GET['emp']) && $_GET['emp']!='' && isset($_GET['s_date']) && $_GET['s_date']!='' && isset($_GET['e_date']) && $_GET['e_date']!=''){
			echo 'bije';
			echo show_current_url();
			$config["base_url"] = base_url()."activity_report/file_moniter/files_cr?emp=".$_GET['emp']."&t=".$_GET['t']."&s_date=".$_GET['s_date'].'&e_date='.$_GET['e_date'];
		}*/
		//if(isset($_GET['secid']) && $_GET['secid']!='' && isset($_GET['emp']) && $_GET['emp']!=''){
		if(isset($_GET['searchby']) && $_GET['searchby']!=''){
			$config["base_url"] = show_current_url().'&searchby='.$_GET['searchby'];
		}		
		$config["base_url"] =show_current_url();
		$total_count = $this->file_moniter->count_getFiles_cr($sec_id,$empid,$s_date,$e_date,$type);
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
        $data['get_files'] = $this->file_moniter->getFiles_cr($sec_id, $empid, $s_date, $e_date, $type,$config['per_page'],$page);
        $str_links = $this->pagination->create_links();
		$data["links"] = explode('&nbsp;',$str_links);			
		/*Pagination*/
		
		
        $data['module_name'] = "activity_report";
        $data['view_file'] = "activity_report/file_moniter";
        $data['view_left_sidebar'] = 'admin/left_sidebar';
        $this->template->index($data);
	}

public function pending_report($task, $date, $date2 = null){
		$emp_section = $this->session->userdata('emp_section_id');
		$data['title'] = $this->lang->line('view_file_manue');
        $data['title_tab'] = 'Pending files report';
		if($task == 'not'){
			$condition = "(file_hardcopy_status = 'not') ";
		} else{
			$condition = "(file_hardcopy_status = 'received' OR file_hardcopy_status = 'working')";
		}	
			$daterange = " DATE(file_update_date) <= '$date'";
			
		$uequertt = "SELECT * FROM ft_files WHERE $condition
			AND  $daterange
			AND file_mark_section_id in($emp_section)";
			
		$qry = $this->db->query($uequertt);		
        $data['get_files'] = $qry->result();
        $data['module_name'] = "activity_report";
        $data['view_file'] = "activity_report/file_moniter";
        $data['view_left_sidebar'] = 'admin/left_sidebar';
        $this->template->index($data);
	}
	
	public function daily_files_cr(){
        $empid = $this->input->get('emp') != '' ? $this->input->get('emp') : '';
		$s_date = $this->input->get('s_date') != '' ? get_date_formate($this->input->get('s_date'),'Y-m-d') : '';
        $e_date = $this->input->get('e_date') != '' ? get_date_formate($this->input->get('e_date'),'Y-m-d') : '';
		$data['title'] = $this->lang->line('view_file_manue');
        $data['title_tab'] = 'File moniter';
        $data['module_name'] = "activity_report";
		$data['result_data']=  $this->file_moniter->daily_files_cr($empid, $s_date, $e_date);
		$data['view_file'] = "activity_report/daily_files_cr";
        $data['view_left_sidebar'] = 'admin/left_sidebar';
        $this->template->index($data);
	}

}