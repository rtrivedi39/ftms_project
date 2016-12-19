<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class E_filelist extends MX_Controller {
    function __construct() {
        parent::__construct();
        $this->load->module('template');
        $this->load->language('view_file','hindi');
        $this->load->model('view_file/view_file_model','view_file');
        $this->load->model('efile_list_model','efile_model');   
		$this->load->library('pagination');
        //$this->load->model('notesheet_model');        
        authorize();
    }
    public function index()
    {
		$emp_role_lvl= get_emp_role_levele(); 
        $data['title'] = $this->lang->line('e_file_title');
        $data['title_tab'] = $this->lang->line('e_file_title_tab');
		/*Pagination*/
		    $config["is_question_mark"] = TRUE;
			if(isset($_GET['section_id']) && $_GET['section_id']!=''){
				$config["base_url"] = base_url()."e-files/inbox?section_id=".$_GET['section_id'];
			}else if(isset($_GET['searchby']) && $_GET['searchby']!=''){
				$config["base_url"] = base_url()."e-files/inbox?searchby=".$_GET['searchby'];
			}else if($_GET['searchby']!='' && $_GET['section_id']!=''){
				$config["base_url"] = base_url()."e-files/inbox?section_id=".$_GET['section_id']."searchby=".$_GET['searchby'];
			}else{
				$config["base_url"] = base_url()."e-files/inbox?";	
			}
			//$config["base_url"] = paging_url();
			if($emp_role_lvl['emprole_level']==13){ //For DA
			//echo $emp_role_lvl['emprole_level'];
				//$data['get_files'] = $this->efile_model->geteFiles($section_explode=null, $moveup_down=null,$section_id_search=null,'inbox', $config['per_page'], $page);
				//$get_files_return = $this->efile_model->geteFiles($section_explode=null, $moveup_down=null,$section_id_search=null,'return', $config['per_page'], $page);	
				$total_count_return = $this->efile_model->count_geteFiles($section_explode=null, $moveup_down=null,$section_id_search=null,'return',null,null);					
				$total_count_inbox = $this->efile_model->count_geteFiles($section_explode=null, $moveup_down=null,$section_id_search=null,'inbox',null,null);					
				if($total_count_return['totalfiles']>0){
					$data['total_files'] =($total_count_inbox['totalfiles'] + $total_count_return['totalfiles']);
				}
				if($total_count_inbox['totalfiles']<=0){
					//$total_count_reutn_count = $this->efile_model->geteFiles($section_explode=null, $moveup_down=null,$section_id_search=null,'return'null,null);	
					$else_total_count_return = $this->efile_model->count_geteFiles($section_explode=null, $moveup_down=null,$section_id_search=null,'return',null,null);					
					$data['total_files']=$total_count_return['totalfiles'];
				}			
			}else{
				$total_count = $this->efile_model->count_geteFiles($section_explode=null, $moveup_down=null,$section_id_search=null,'inbox',null,null);					
				$data['total_files']=$total_count['totalfiles'];
			}			
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
        /*First Time*/
		/*if($emp_role_lvl['emprole_level']==13){ //For DA			
			$data['get_files'] = $this->efile_model->geteFiles($section_explode=null, $moveup_down=null,$section_id_search=null,'inbox');
			$get_files_return = $this->efile_model->geteFiles($section_explode=null, $moveup_down=null,$section_id_search=null,'return');	
			if(count($get_files_return) > 0){
				$data['get_files'] = array_merge($data['get_files'],$get_files_return);
			}
			if(count($data['get_files'])<=0){
				$data['get_files'] = $this->efile_model->geteFiles($section_explode=null, $moveup_down=null,$section_id_search=null,'return');	
			}
		}else{
			
			$data['get_files'] = $this->efile_model->geteFiles($section_explode=null, $moveup_down=null,$section_id_search=null,'inbox');
		}*/
		
		if($emp_role_lvl['emprole_level']==13){ //For DA
			//echo $emp_role_lvl['emprole_level'];
			$data['get_files'] = $this->efile_model->geteFiles($section_explode=null, $moveup_down=null,$section_id_search=null,'inbox', $config['per_page'], $page);
			$get_files_return = $this->efile_model->geteFiles($section_explode=null, $moveup_down=null,$section_id_search=null,'return', $config['per_page'], $page);	
			if(count($get_files_return) > 0){
				$data['get_files'] = array_merge($data['get_files'],$get_files_return);
			}
			if(count($data['get_files'])<=0){
				$data['get_files'] = $this->efile_model->geteFiles($section_explode=null, $moveup_down=null,$section_id_search=null,'return', $config['per_page'], $page);	
			}			
		}else{			
			$data['get_files'] = $this->efile_model->geteFiles($section_explode=null, $moveup_down=null,$section_id_search=null,'inbox', $config['per_page'],$page);
		}
        $emp_role_lvl= get_emp_role_levele();		
		getEmployeeSection();
		$notesheet_id=null;
		$data['notesheet_id'] = $notesheet_id;
		$data['section_id']=getEmployeeSection();
		$data['title'] = 'अंकित ई-फ़ाइलें';
		$data['title_tab'] = $this->lang->line('title');
		/*Pagination*/
		$str_links = $this->pagination->create_links();
		$data["links"] = explode('&nbsp;',$str_links );							
		/*End pagination*/
		$data['view_file'] = "view_file/viewfile_fornotesheet";
		$views = show_view_as_lvl();
		$data['view_file'] = "$views";
		$data['view_left_sidebar'] = 'admin/left_sidebar';
        $this->template->index($data);
    }
    public function sent()
    {
        $data['title'] = 'भेजी गई ई-फ़ाइलें';
        $data['title_tab'] = $this->lang->line('e_file_title_tab');        
       	$close =$this->uri->segment(3);
     //  	echo $close;
        /*Pagination*/
		    $config["is_question_mark"] = TRUE;
			if(isset($_GET['searchby']) && $_GET['searchby']!=''){
				$config["base_url"] = base_url()."e-files/sent?searchby=".$_GET['searchby'];
			}else if($_GET['searchby']!='' && $_GET['section_id']!=''){
				$config["base_url"] = base_url()."e-files/sent?section_id=".$_GET['section_id']."searchby=".$_GET['searchby'];
			}elseif($close == "close"){
				$config['base_url'] =  base_url().'e-files/sent/close?' ;
				
			}else{
				$config["base_url"] = base_url()."e-files/sent?";	
			}

			//echo $pgurl = paging_url();
			//if($pgurl){
			//	$config["base_url"] = paging_url();				
			//}else{
			//	$config["base_url"] = base_url()."e-files/sent?";	
			//}

			if($close == "close")
			{ 
				$total_count = $this->efile_model->count_sent_efile_close();	
			}else{
				$total_count = $this->efile_model->count_sent_efile();	
			}		

			$data['total_files']= $total_count['totalfiles'];
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
			$config['page_query_string'] = TRUE;
			
			$this->pagination->initialize($config);
			if(isset($_GET['per_page']) && $_GET['per_page']!=''){
				$page = $_GET['per_page'];
			}else{
				$page=0;
			}			
            if($close == "close")
				{ 
				$data['get_files'] = $this->efile_model->sent_efile_close($config['per_page'],$page); 
				}else{ 
				$data['get_files'] = $this->efile_model->sent_efile($config['per_page'],$page); 
				}	/*Pagination*/
		$str_links = $this->pagination->create_links();
		$data["links"] = explode('&nbsp;',$str_links );							
		/*End pagination*/		
		//$data['get_files'] = $this->efile_model->sent_efile();;        
        $views = 'view_file/file_moniter';		
		$data['view_file'] = "$views";
		$data['notesheet_id'] = "";
		$data['section_id'] = "";
        $data['view_left_sidebar'] = 'admin/left_sidebar';
        $this->template->index($data);        
    }
    public function working()
    {   
		$emp_role_lvl= get_emp_role_levele();
		$data['title'] = $this->lang->line('e_file_title');
        $data['title_tab'] = $this->lang->line('e_file_title_tab');
        //echo modules::run('module/view_file/index',$id=null);
		//$data['total_count_files']=json_decode($this->ajax_count_inbox(true),true);		
		/*Pagination*/
		    $config["is_question_mark"] = TRUE;
			if(isset($_GET['section_id']) && $_GET['section_id']!=''){
				$config["base_url"] = base_url()."e-files/working?section_id=".$_GET['section_id'];
			}else if($_GET['searchby']!='' && $_GET['section_id']!=''){
				$config["base_url"] = base_url()."e-files/working?section_id=".$_GET['section_id']."searchby=".$_GET['searchby'];
			}else{
				$config["base_url"] = base_url()."e-files/working?";	
			}
			//$config["base_url"] = paging_url();					
			$total_count = $this->efile_model->count_geteFiles($section_explode=null, $moveup_down=null,$section_id_search=null,'working',null,null);					
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
			$data['get_files'] = $this->efile_model->geteFiles($section_explode=null, $moveup_down=null,$section_id_search=null,'working',$config['per_page'],$page);
			/*Pagination*/
		$str_links = $this->pagination->create_links();
		$data["links"] = explode('&nbsp;',$str_links );							
		/*End pagination*/
        //$data['get_files'] = $this->efile_model->geteFiles($section_explode=null, $moveup_down=null,$section_id_search=null,'working');
		getEmployeeSection();
		$notesheet_id=null;
		$data['notesheet_id'] = $notesheet_id;
		$data['section_id']=getEmployeeSection();
		$data['title'] = 'कार्यरत ई-फाइलें';
		$data['title_tab'] = $this->lang->line('title');
		$views = show_view_as_lvl();		
		$data['view_file'] = "$views";
		$data['view_left_sidebar'] = 'admin/left_sidebar';
        $this->template->index($data);
    }
	public function ajax_count_inbox($is_retur=false){
		$emp_role_lvl= get_emp_role_levele(); 
		
		$file_working_array=$this->efile_model->count_geteFiles($section_explode=null, $moveup_down=null,$section_id_search=null,'working');/*working*/		
		$total_working= $file_working_array['totalfiles'];/*working*/		
		
		//$total_array= $this->efile_model->count_geteFiles($section_explode=null, $moveup_down=null,$section_id_search=null,'inbox'); /*Inbox*/
		//$inbox= $total_array['totalfiles'];/*Inbox*/
		//if($inbox==0){
		//	$total_array= $this->efile_model->count_geteFiles($section_explode=null, $moveup_down=null,$section_id_search=null,'return'); /*return*/
		//	$inbox= $total_array['totalfiles'];/*Inbox*/
		//}
		if($emp_role_lvl['emprole_level']==13){ //For DA			
			$total_count_return = $this->efile_model->count_geteFiles($section_explode=null, $moveup_down=null,$section_id_search=null,'return',null,null);					
			//pre($total_count_return);
			$total_count_inbox = $this->efile_model->count_geteFiles($section_explode=null, $moveup_down=null,$section_id_search=null,'inbox',null,null);					
			//pre($total_count_inbox);
			if($total_count_return['totalfiles']>0){
				$inbox =($total_count_inbox['totalfiles'] + $total_count_return['totalfiles']);
			}
			if($total_count_inbox['totalfiles']<=0){
				//$total_count_reutn_count = $this->efile_model->geteFiles($section_explode=null, $moveup_down=null,$section_id_search=null,'return'null,null);	
				$else_total_count_return = $this->efile_model->count_geteFiles($section_explode=null, $moveup_down=null,$section_id_search=null,'return',null,null);					
				//pr($else_total_count_return);
				$inbox =$total_count_return['totalfiles'];
			}	
				
		}else{
			$total_array= $this->efile_model->count_geteFiles($section_explode=null, $moveup_down=null,$section_id_search=null,'inbox'); /*Inbox*/
			$inbox= $total_array['totalfiles'];/*Inbox*/
			if($inbox==0){
				$total_array= $this->efile_model->count_geteFiles($section_explode=null, $moveup_down=null,$section_id_search=null,'return'); /*return*/
				$inbox= $total_array['totalfiles'];/*Inbox*/
			}
		}
		$sent_file_array = $this->efile_model->count_sent_efile();/*Sent*/
		$total_sent= $sent_file_array['totalfiles'];/*Sent*/
		
		$ibox=array($total_working,$inbox,$total_sent,);/*working,inbox,sent*/		
		if($is_retur==false){
			echo json_encode($ibox);
		}else{
			return json_encode($ibox);
		}
		//$this->output->set_content_type('application/json')->set_output(json_encode($ibox));
	}
	
	public function efile_sign(){
		
		$emp_role_lvl= get_emp_role_levele();
		$data['login_emp_level']=$emp_role_lvl;
		$data['title'] = 'फाइल पर  हस्ताक्षर';
        $data['title_tab'] ='फाइल पर  हस्ताक्षर'  ;
        //echo modules::run('module/view_file/index',$id=null);
		//$data['total_count_files']=json_decode($this->ajax_count_inbox(true),true);
        //$data['get_files'] = array(0);
        
		/*Pagination*/
		    $config["is_question_mark"] = TRUE;
			if(isset($_GET['section_id']) && $_GET['section_id']!=''){
				$config["base_url"] = base_url()."e-files/efile_sign?section_id=".$_GET['section_id'];
			}else{
				$config["base_url"] = base_url()."e-files/efile_sign?";	
			}		
			//$config["base_url"] = paging_url();
			$total_count = $this->efile_model->count_geteFiles_working($section_explode=null, $moveup_down=null,$section_id_search=null,'working');
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
			$data['get_files'] = $this->efile_model->new_geteFiles_working($section_explode=null, $moveup_down=null,$section_id_search=null,'working',$config['per_page'],$page);
			/*Pagination*/
			$str_links = $this->pagination->create_links();
			$data["links"] = explode('&nbsp;',$str_links );							
		/*End pagination*/
		
		//$data['get_files'] = $this->efile_model->geteFiles_working($section_explode=null, $moveup_down=null,$section_id_search=null,'working');
		$notesheet_id=null;
		$data['notesheet_id'] = $notesheet_id;
		$data['section_id']=getEmployeeSection();
		$data['view_file'] = "e_filelist/file_list_sign";
		$data['view_left_sidebar'] = 'admin/left_sidebar';
        $this->template->index($data);
	}
	public function old_efile_sign(){

		$emp_role_lvl= get_emp_role_levele();
		$data['login_emp_level']=$emp_role_lvl;
		$data['title'] = 'फाइल पर  हस्ताक्षर';
        $data['title_tab'] ='फाइल पर  हस्ताक्षर'  ;
        //echo modules::run('module/view_file/index',$id=null);
		//$data['total_count_files']=json_decode($this->ajax_count_inbox(true),true);
        //$data['get_files'] = array(0);
        $data['get_files'] = $this->efile_model->geteFiles_working($section_explode=null, $moveup_down=null,$section_id_search=null,'working');
		$notesheet_id=null;
		$data['notesheet_id'] = $notesheet_id;
		$data['section_id']=getEmployeeSection();
		$data['view_file'] = "e_filelist/file_list_sign";
		$data['view_left_sidebar'] = 'admin/left_sidebar';
        $this->template->index($data);
	}
	public function post_multi_signature_old_notuse(){
        //pre($this->input->post());
        $i=0;  $j=0; $k=0;
        $post_data_array=array();
		$checked_row_id  = array_keys($this->input->post('ck_file_id'));

		$content_row_id  = array_keys($this->input->post('signing_content'));
		$ck_file_id = $this->input->post('ck_file_id');

		$ck_file_id = $this->input->post('ck_file_id');

		$section_id = $this->input->post('section_id');

		$up_down = $this->input->post('up_down');

		$empid = $this->input->post('empid');

		$signing_content = $this->input->post('signing_content');

		$file_status = $this->input->post('file_status');

		$draft_log_id = $this->input->post('draft_log_id');

		$file_param1 = $this->input->post('file_param1');
		$file_param2 = $this->input->post('file_param2');
		$file_param3 = $this->input->post('file_param3');
		$file_param4 = $this->input->post('file_param4');
		/*Common*/
		$checkval = array_intersect($checked_row_id,$content_row_id);
		//pre($post_val);
		/*File ID*/
		foreach($checkval as $keyr => $checkval1){
			//FileId
			$post_data_array_b[$keyr]['ck_file_id'] = $ck_file_id[$checkval1];
			/*Section Id*/
			$post_data_array_b[$keyr]['section_id'] = $section_id[$checkval1];
			/*File up_down*/
			$post_data_array_b[$keyr]['up_down'] = $up_down[$checkval1];
			/*empid*/
			$post_data_array_b[$keyr]['empid'] = $empid[$checkval1];
			/*file_status*/
			$post_data_array_b[$keyr]['file_status'] = $file_status[$checkval1];
			/*draft_log_id*/
			$post_data_array_b[$keyr]['draft_log_id'] = $draft_log_id[$checkval1];
			/*Signing Contant*/
			$post_data_array_b[$keyr]['signing_content'] = $signing_content[$checkval1];
			/*file_param1*/
			$post_data_array_b[$keyr]['file_param1'] = $file_param1[$checkval1];
			/*file_param2*/
			$post_data_array_b[$keyr]['file_param2'] = $file_param2[$checkval1];
			/*file_param3*/
			$post_data_array_b[$keyr]['file_param3'] = $file_param3[$checkval1];
			/*file_param4*/
			$post_data_array_b[$keyr]['file_param4'] = $file_param4[$checkval1];

		}
		//pr($post_data_array_b);
		echo json_encode($post_data_array_b);
	}
	
	public function post_multi_signature(){
        //pre($this->input->post());
        $i=0;  $j=0; $k=0;
        $post_data_array=array();
		$checked_row_id  = array_keys($this->input->post('ck_file_id'));

		$content_row_id  = array_keys($this->input->post('signing_content'));
		$ck_file_id = $this->input->post('ck_file_id');

		$ck_file_id = $this->input->post('ck_file_id');

		$section_id = $this->input->post('section_id');

		$up_down = $this->input->post('up_down');

		$empid = $this->input->post('empid');

		$signing_content = $this->input->post('signing_content');

		$file_status = $this->input->post('file_status');

		$draft_log_id = $this->input->post('draft_log_id');

		$file_param1 = $this->input->post('file_param1');
		$file_param2 = $this->input->post('file_param2');
		$file_param3 = $this->input->post('file_param3');
		$file_param4 = $this->input->post('file_param4');
		/*Common*/
		$checkval = array_intersect($checked_row_id,$content_row_id);
		//pre($post_val);
		/*File ID*/
		foreach($checkval as $keyr => $checkval1){
			//FileId
			$post_data_array_b[$keyr]['ck_file_id'] = $ck_file_id[$checkval1];
			/*Section Id*/
			$post_data_array_b[$keyr]['section_id'] = $section_id[$checkval1];
			/*File up_down*/
			$post_data_array_b[$keyr]['up_down'] = $up_down[$checkval1];
			/*empid*/
			$post_data_array_b[$keyr]['empid'] = $empid[$checkval1];
			/*file_status*/
			$post_data_array_b[$keyr]['file_status'] = $file_status[$checkval1];
			/*draft_log_id*/
			$post_data_array_b[$keyr]['draft_log_id'] = $draft_log_id[$checkval1];
			/*Signing Contant*/
			$post_data_array_b[$keyr]['signing_content'] = $signing_content[$checkval1];
			/*file_param1*/
			$post_data_array_b[$keyr]['file_param1'] = $file_param1[$checkval1];
			/*file_param2*/
			$post_data_array_b[$keyr]['file_param2'] = $file_param2[$checkval1];
			/*file_param3*/
			$post_data_array_b[$keyr]['file_param3'] = $file_param3[$checkval1];
			/*file_param4*/
			$post_data_array_b[$keyr]['file_param4'] = $file_param4[$checkval1];
		}		
		$file_order_id=array_values($this->input->post('file_order_id'));	
		/*Create File Order Id Array*/		
		if(!empty($file_order_id)){
			foreach($file_order_id as $orderids)
			{
				$order_detail = get_draft($orderids,'o');
				$file_order_id_zero=get_draft_log_data($orderids,true,null,null);
				//$order_sign_content= stripslashes(md5($file_order_id_zero[0]->draft_content));
				$order_sign_content=  urlencode(base64_encode($file_order_id_zero[0]->draft_content)); 
				$file_order_id_array[]=array(
											'ck_file_id'=>$order_detail['draft_file_id'],
											'section_id'=>'0',										
											'up_down'=>'order',
											'empid'=>'0',	
											'file_status'=>'0',											
											'signing_content'=>$order_sign_content,
											'file_param1'=>md5($file_order_id_zero[0]->draft_content),	
											'file_param2'=>$file_order_id_zero[0]->draft_log_id,
											'file_param3'=>'0',											
											'file_param4'=>emp_session_id());													
			}		
			if(count($file_order_id_array)>0){
				//pre($file_order_id_array);
				$post_data_array_b = array_merge($post_data_array_b,$file_order_id_array);
			}
		}
		/*Other Deparment notesheet Array*/
		$file_other_dpt_nt_id =array_values($this->input->post('file_other_dpt_nt_id'));
		if(!empty($file_other_dpt_nt_id)){		
			foreach($file_other_dpt_nt_id as $odnids)
			{
				$other_nt_detail = get_draft($odnids,'odn');
				$other_dept_notesheet_ids=get_draft_log_data($odnids,true,null,null);	
				//$order_sign_content= "<script>encodeURIComponent(escape(".$other_dept_notesheet_ids[0]->draft_content."),'UTF-8')</script>";
				//$odn_sign_content= stripslashes(md5($other_dept_notesheet_ids[0]->draft_content));
				//$odn_sign_content= stripslashes(md5($other_dept_notesheet_ids[0]->draft_content));
				$odn_sign_content = urlencode(base64_encode($other_dept_notesheet_ids[0]->draft_content)); 
				$other_dept_notesheet_ids_array[]=array('ck_file_id'=>$other_nt_detail['draft_file_id'],
											'section_id'=>'0',										
											'up_down'=>'odn',
											'empid'=>'0',	
											'file_status'=>'0',											
											'signing_content'=>$odn_sign_content,
											'file_param1'=>md5($other_dept_notesheet_ids[0]->draft_content),
											'file_param2'=>$other_dept_notesheet_ids[0]->draft_log_id,
											'file_param3'=>'0',											
											'file_param4'=>emp_session_id());
			}		
			if(count($other_dept_notesheet_ids_array)>0){
				//pre($file_order_id_array);
				$post_data_array_b = array_merge($post_data_array_b,$other_dept_notesheet_ids_array);
			}
		}		
		//pr($post_data_array_b);
		echo json_encode($post_data_array_b);		
	}
    public function add_multi_signature(){
        //pre($this->input->post());
        $i=0;
        $j=0;
        $k=0;
        $post_data_array=array();
        foreach($this->input->post() as $ky=>$val){
            if($ky=='ck_file_id'){
                $total_post = count($val);
               foreach($val as $value1){
                    $post_data_array[$j][$ky]=$value1;
                    $j++;
               }
            }
            if($ky=='section_id'){
                $total_post;
                for($a=0;$a<$total_post;$a++){
                    $post_data_array[$a]['section_id']=$val[$a];
                }
            }
            if($ky=='up_down'){
                $total_post;
                for($b=0;$b<$total_post;$b++){
                    $post_data_array[$b]['up_down']=$val[$b];
                }
            }
            if($ky=='empid'){
                $total_post;
                for($c=0;$c<$total_post;$c++){
                    $post_data_array[$c]['empid']=$val[$c];
                }
            }
            if($ky=='signing_content'){
                $total_post;
                for($d=0;$d<$total_post;$d++){
                    $post_data_array[$d]['signing_content']=$val[$d];
                }
            }
            if($ky=='file_status'){
                $total_post;
                for($e=0;$e<$total_post;$e++){
                    $post_data_array[$e]['file_status']=$val[$e];
                }
            }

            if($ky=='file_prama1'){
                $total_post;
                for($f=0;$f<$total_post;$f++){
                    $post_data_array[$f]['file_prama1']=$val[$f];
                }
            }
            if($ky=='file_prama2'){
                $total_post;
                for($g=0;$g<$total_post;$g++){
                    $post_data_array[$g]['file_prama2']=$val[$g];
                }
            }
            if($ky=='file_prama3'){
                $total_post;
                for($h=0;$h<$total_post;$h++){
                    $post_data_array[$h]['file_prama3']=$val[$h];
                }
            }
            if($ky=='file_prama4'){
                $total_post;
                for($z=0;$z<$total_post;$z++){
                    $post_data_array[$z]['file_prama4']=$val[$z];
                }
            }
            $i++;
        }
        //manage_file/Sendfile_upperofficer/14137;
		//pr($post_data_array);
        foreach($post_data_array as $ky=>$file_data){
            $user_level = get_emp_role_levele();

            if($file_data['up_down']==1){
                $file_id = $file_data['ck_file_id'];
                $rmk1="";
                $mark_emp_id=$file_data['empid'];
                $section_id=$file_data['section_id'];
                $file_status=$file_data['file_status'];
                modules::run('manage_file/multi_file_send_upper_officer',$file_id,$rmk1,$mark_emp_id,$section_id,$file_status);
            }
            if($file_data['up_down']==0){
                //pre($file_data);
                //echo $file_data['up_down'];
                //$sent_to_uper_officer=array('fileids2','rmk1','emp_id2','file_status');
                $file_id = $file_data['ck_file_id'];
                $rmk1="";
                $mark_emp_id=$file_data['empid'];
                $section_id=$file_data['section_id'];
                $file_status=$file_data['file_status'];
                //view_file/dealing_file/sent_to_da
                if($user_level['emprole_level']=='6'){/*SO or Incharge*/
                    modules::run('view_file/dealing_file/multi_file_sent_to_da',$file_id,$mark_emp_id,$section_id,$file_status);
                }else{
                    modules::run('manage_file/multi_file_send_upper_officer',$file_id,$rmk1,$mark_emp_id,$section_id,$file_status);
                }
            }
        }
        $this->session->set_flashdata('message', 'File Send to Successfully');
        redirect($_SERVER['HTTP_REFERER']);
    }
	public function received_multiple_files(){
		//pre($this->input->post());
		$file_emp_mark_id = $this->input->post('file_emp_mark_id');
		$file_selected_file_ids = $this->input->post('file_selected_file_ids');
		$today_sec_permission = $this->input->post('today_sec_permission');
		$file_ids_array = explode(',',$file_selected_file_ids);
		//pr($file_ids_array);
		//foreach($file_ids_array as $val){
			if(emp_session_id()==$file_emp_mark_id && $today_sec_permission !='today'){
				$not_recived_files = $this->efile_model->get_not_recieved_files($file_selected_file_ids);
				$file_ids_array = explode(',',$not_recived_files);
				echo modules::run('manage_file/multiple_file_receive_sectionno',$file_ids_array);
			}else{
				echo modules::run('manage_file/multi_file_receive_sectionno_mark_da',$file_ids_array,$file_emp_mark_id);
			}
		//}
		//modules::run('manage_file/multi_file_receive_sectionno_mark_da',$file_emp_mark_id);
		//receive_file_sectionno($fileid = '')
	}
	public function add_multiple_draft(){
		//pr($this->input->post());
	
	//echo "ghj  ".$draft_content_text = $this->input->post('draft_content_text');die;
	$file_selected_file_ids = $this->input->post('file_selected_file_ids');
	$save_draft = 'save_draft';
	$file_ids_array = explode(',',$file_selected_file_ids);
			//pr($file_ids_array);
		foreach($file_ids_array as $val){
			$file_data = get_draft_from_file($val);
			//pr($file_data);
			$draft_id = $file_data['final_draft_id'];
			$subject = $file_data['file_subject'];
			$file_receive = $file_data['file_hardcopy_status']; 
			
			if($file_receive == 'received')
			{
				$responce = modules::run('draft/draft/auto_add_multiple_draft', $val,$subject ,$draft_id 	,$draft_content_text ,$save_draft);
			}
			
		}
		if($responce){
						echo json_encode("success");
					}
	}
	
	  public function ajax_count_inbox_second($is_retur=false){
      $inbox1 = $this->efile_model->count_inbox();
      $wip1 = $this->efile_model->count_wip();
      $sent1 = $this->efile_model->count_sent();
	  
        $ibox=array($wip1['wipefile'],$inbox1['inbox'],$sent1[0]->sent_efile);/*working,inbox,sent*/
        if($is_retur==false){
            echo json_encode($ibox);
        }else{
            return json_encode($ibox);
        }
    }
	
}