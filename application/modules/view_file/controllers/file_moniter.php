<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class File_moniter	 extends MX_Controller {
    function __construct() {
        parent::__construct();
        $this->load->module('template');
        $this->load->language('view_file','hindi');
      //  $this->load->model('view_file_model','view_file');
        $this->load->model('file_search_model','file_search');
		$this->load->library('pagination');
        authorize();
    }
    public function index()
    {
		if($this->input->get('u') != ''){
			$empid	= $this->input->get('u');
		} else{
			$empid = null;
		}
        $section_id = getEmployeeSection();
        $section_explode =  explode(',',$section_id);
        $data = array();
        if(isset($_GET['files_year']) && $_GET['files_year']!=''){$files_year=$_GET['files_year'];}else{ $files_year=date('Y');}
        if(isset($_GET['files_month']) && $_GET['files_month']!=''){$files_month=$_GET['files_month'];}else{ $files_month=date('m');}
        $data['title'] = $this->lang->line('view_file_manue');
        $dt = DateTime::createFromFormat('!m', $files_month);
        $vmonth = $dt->format('F');
        $data['title_tab'] = 'File moniter: <b class="text-red">You are viewing '.$vmonth.'-'.$files_year.' Files </b>';
        $data['module_name'] = "view_file";
		/*Pagination*/
		    $config["is_question_mark"] = TRUE;

			if($this->uri->segment(3) == 'close'){
			if(isset($_GET['files_year']) && $_GET['files_year']!=''){
				$config["base_url"] = base_url()."moniter/files/close?files_year=".$_GET['files_year']."&files_month=".$_GET['files_month']."&sort=".$_GET['sort'];
			}elseif(isset($_GET['u']) && $_GET['u']!=''){
				$config["base_url"] = base_url()."moniter/files/close?u=".$_GET['u'];	
			}elseif(isset($_GET['psmrk']) && $_GET['psmrk']!=''){
				$config["base_url"] = base_url()."moniter/files/close/?psmrk=".$_GET['psmrk'];	
			}elseif(isset($_GET['searchby']) && $_GET['searchby']!=''){
				$config["base_url"] = base_url()."moniter/files/close/?searchby=".$_GET['searchby'];	
			}else{				
				$config["base_url"] = base_url()."moniter/files/close?";	
			}
			}else{
			
			if(isset($_GET['files_year']) && $_GET['files_year']!=''){
				$config["base_url"] = base_url()."moniter/files?files_year=".$_GET['files_year']."&files_month=".$_GET['files_month']."&sort=".$_GET['sort'];
			}elseif(isset($_GET['u']) && $_GET['u']!=''){
				$config["base_url"] = base_url()."moniter/files?u=".$_GET['u'];	
			}elseif(isset($_GET['psmrk']) && $_GET['psmrk']!=''){
				$config["base_url"] = base_url()."moniter/files/?psmrk=".$_GET['psmrk'];	
			}elseif(isset($_GET['searchby']) && $_GET['searchby']!=''){
				$config["base_url"] = base_url()."moniter/files/?searchby=".$_GET['searchby'];	
			}else{				
				$config["base_url"] = base_url()."moniter/files?";	
			}
	}	
			if(isset($_GET['psmrk']) && $_GET['psmrk'] !=''){
				$total_count = $this->file_search->count_monitor_files('psmrk',$_GET['psmrk'],null,null,null);					
			}else{
			if($this->uri->segment(3) == 'close'){
			$total_count= count_close_file_moniter_byuser(null,null,null);	
				}else{
				$total_count= count_file_moniter_byuser(null,null,null);	
				}
				
				}
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
			if(isset($_GET['psmrk']) && $_GET['psmrk'] !=''){				
			   $data['get_files'] = $this->file_search->file_search('psmrk',$_GET['psmrk'],null,$config['per_page'],$page);
			}else{

				if($this->uri->segment(3) == 'close'){
			$data['get_files'] = close_file_moniter_byuser(null, null,$empid,$config['per_page'],$page);
				}else{
				$data['get_files'] = file_moniter_byuser(null, null,$empid,$config['per_page'],$page);
				}
			
			}
		/*Pagination*/
		$str_links = $this->pagination->create_links();
		$data["links"] = explode('&nbsp;',$str_links );							
		/*End pagination*/
        /*if(isset($_GET['psmrk']) && $_GET['psmrk'] !=''){
           $data['get_files'] = $this->file_search->file_search('psmrk',$_GET['psmrk']);
        }else{
            $data['get_files'] = file_moniter_byuser(null, null, $empid);
        }*/
        $data['view_file'] = "view_file/file_moniter";
        $data['view_left_sidebar'] = 'admin/left_sidebar';
        $this->template->index($data);
    }
}