<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Est_master_category extends MX_Controller {
     function __construct() {
        parent::__construct();
        $this->load->module('template');
        $this->load->model('est_category_master_model');
		$this->load->helper('establishment');
        $this->load->language('est_category_master','hindi');
    }
 	public function index()
    {
        $data = array();
        $data['title'] = $this->lang->line('est_heading');
        $data['title_tab'] = $this->lang->line('est_sub_heading');
       
        $data['get_category']= $this->est_category_master_model->fetch_category_yid();
       
        $data['module_name'] = "establishment";
        $data['view_file'] = "establishment/index";
        $this->template->index($data);
    }
    public function manage_category($id=null){
        $data = array();
		
        $data['title'] = $this->lang->line('label_category_add');
        $data['title_tab'] =  $this->lang->line('label_category_add');
      
        if($id==null){
			$data['page_title'] = $this->lang->line('label_category_add');
			$data['is_page_edit']=1;
        }else{
			$data['page_title'] = "Edit Head";
			$data['is_page_edit']=0;
        $category_detail = $this->est_category_master_model->fetch_category_yid($id);
        $data['category_detail']=$category_detail[0];
        }
		$data['id']=$id;

		$this->form_validation->set_rules('category_title_en','category_title_en' , 'trim|required');
		$this->form_validation->set_rules('category_title_hin','category_title_hin' , 'trim|required');
		$this->form_validation->set_rules('category_description','category_description' , 'trim|required');
		
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
 
    if ($this->form_validation->run($this) == TRUE)
     {
       
		$establishment_tbl_data = array($this->input->post());
		unset($establishment_tbl_data[0]['savenotice']);
		if(!empty($this->input->post('is_every_emp_create')) && $this->input->post('is_every_emp_create') == 'on'){
			$establishment_tbl_data[0]['is_every_emp_create'] = 1;
		} else {
			$establishment_tbl_data[0]['is_every_emp_create'] =  0;
		}
			if($id){
					$res = updateData(EST_CATEGORY_MASTER,$establishment_tbl_data[0],array('master_category_id'=>$id));
					$res = updateData(EST_CATEGORY_MASTER,array('is_every_emp_create' => $establishment_tbl_data[0]['is_every_emp_create']),array('parent_category_id'=>$id));
                if($res){
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable hideauto"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>'.$this->lang->line('update_success_message').'</div>');
                }
            }else{
                //pr($section_tbl_data);
                $res =insertData($establishment_tbl_data[0],EST_CATEGORY_MASTER);
                if($res){
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable hideauto"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>'.$this->lang->line('success_message').'</div>');
                }
            }
         
           redirect('establishment/category');
      }
        $data['input_data'] = $this->input->post();
        $data['view_file'] = "est_category_master";
        $data['module_name'] = "establishment";
        $this->template->index($data);

    }

	public function addsub_category($category_id=null ,$subcategory_id =null){

        $data = array();


        $data['title_tab'] =  $this->lang->line('label_subcategory_add');

        if($subcategory_id==null){
			$data['title'] = $this->lang->line('label_subcategory_add');
			$data['page_title'] = $this->lang->line('label_category_add');
			$data['is_page_edit']=1;
        }else{
			 $data['title'] = $this->lang->line('label_subcategory_edit');
			$data['page_title'] =  $this->lang->line('label_subcategory_edit');
			$data['is_page_edit']=0;
			$category_detail = $this->est_category_master_model->fetch_category_yid($subcategory_id);
			$data['category_detail']=$category_detail[0];
			$data['subcategory_id']=$subcategory_id;

        }
		$data['category_id']= $category_id;
		$data['all_categoris'] = $this->est_category_master_model->fetch_subcategory_yid();

		//print_r(	$data['all_categoris'] );die;
		$this->form_validation->set_rules('category_title_en','category_title_en' , 'trim|required');
		$this->form_validation->set_rules('category_title_hin','category_title_hin' , 'trim|required');
		$this->form_validation->set_rules('category_description','category_description' , 'trim|required');
		$this->form_validation->set_rules('parent_category_id','parent_category_id' , 'trim|required');

		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		if ($this->form_validation->run($this) == TRUE)
		{

			$establishment_tbl_data=array($this->input->post());
			unset($establishment_tbl_data[0]['category_id']);
			unset($establishment_tbl_data[0]['savenotice']);
			if(!empty($this->input->post('parent_category_id')) && is_every_empcreate($this->input->post('parent_category_id'))){
				$establishment_tbl_data[0]['is_every_emp_create'] = 1;
			} else {
				$establishment_tbl_data[0]['is_every_emp_create'] =  0;
			}
			//pr($heads_tbl_data[0]);
				if($subcategory_id){
					$res = updateData(EST_CATEGORY_MASTER,$establishment_tbl_data[0],array('master_category_id'=>$subcategory_id));
					if($res){
						$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable hideauto"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>'.$this->lang->line('update_success_message').'</div>');
					}
				}else{
					//pr($section_tbl_data);
					$res = insertData($establishment_tbl_data[0],EST_CATEGORY_MASTER);
					if($res){
						$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable hideauto"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>'.$this->lang->line('success_message').'</div>');
					}
				}

			   redirect('establishment/view_subcategory/'.$this->input->post('category_id'));
		}
        $data['input_data'] = $this->input->post();
        $data['view_file'] = "est_category_master";
        $data['module_name'] = "establishment";
        $this->template->index($data);

    }



    public function delete_category($id)
    {
      //  pr($id);

       $this->db->where('parent_category_id',$id);
	   $res_subcategory = $this->db->delete(EST_CATEGORY_MASTER);

        $this->db->where('master_category_id',$id);
        $res = $this->db->delete(EST_CATEGORY_MASTER);
        if($res){
            $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable hideauto"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>'.$this->lang->line('delete_success_message').'</div>');
        }
         redirect('establishment/category');
    }

	public function delete_subcategory($category_id , $subcategory_id)
    {
      //  pr($id);

        $this->db->where('master_category_id',$subcategory_id);
        $res = $this->db->delete(EST_CATEGORY_MASTER);
        if($res){
            $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable hideauto"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>'.$this->lang->line('delete_success_message').'</div>');
        }
         redirect('establishment/view_subcategory/'.$this->uri->segment(3));
    }

    function alpha_dash_space($str)
    {
        if(!preg_match("/^([-a-z_ ])+$/i", $str)){
            $this->form_validation->set_message('alpha_dash_space',$this->lang->line('text_allow_with_space_error'));
            return false;
        }
    }

	public function viewsub_category($id = null)
    {
        $data = array();
        $data['title'] = $this->lang->line('est_subcate_heading');
        $data['title_tab'] = $this->lang->line('est_subcate_sub_heading');

        $data['get_category']= $this->est_category_master_model->fetch_subcategory_yid($id);

        $data['module_name'] = "establishment";
        $data['view_file'] = "establishment/index";
        $this->template->index($data);
    }


	//for alloted work
	public function work_allote()
    {
        $data = array();
        $data['title'] = $this->lang->line('est_allote_title');
        $data['title_tab'] = $this->lang->line('est_allote_title_tab');
       
        $data['get_alloted_lists']= $this->est_category_master_model->fetch_alloted_work();
       
        $data['module_name'] = "establishment";
        $data['view_file'] = "establishment/work_allote";
        $this->template->index($data);
	}
		
	//manage work alloted
	public function manage_work_allote($id = ''){
		$data = array();

		$data['title'] = $this->lang->line('est_allote_title');
		$data['title_tab'] =  $this->lang->line('est_allote_title_tab');

		if($id == ''){
			$data['page_title'] = $this->lang->line('add_work_title');
			$data['is_page_edit'] = 0;
		}else{
			$data['page_title'] = $this->lang->line('edit_work_title');
			$data['is_page_edit'] = 1;
			$alloted_work_detail = $this->est_category_master_model->fetch_alloted_work($id);
			$data['alloted_work'] = $alloted_work_detail[0];
		}
		$data['id'] = $id;

		$this->form_validation->set_rules('est_word_alloted_emp_id','est_word_alloted_emp_id' , 'trim|required');
		$this->form_validation->set_rules('est_word_alloted_work_id','est_word_alloted_work_id' , 'required');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

		if ($this->form_validation->run($this) == TRUE)
		{
			$work_allote_form_data = array(
				'est_word_alloted_emp_id' => $this->input->post('est_word_alloted_emp_id'),
				'est_word_alloted_work_id' => implode(',', $this->input->post('est_word_alloted_work_id')),
				'est_word_alloted_comment' => $this->input->post('est_word_alloted_comment'),
			);
			if($id != ''){
				$res = updateData(EST_WORK_ALLOTE, $work_allote_form_data, array('est_word_alloted_id' => $id));
				if($res){
					$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable hideauto"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>'.$this->lang->line('update_success_message').'</div>');
				}
			}else{
				$res = insertData($work_allote_form_data, EST_WORK_ALLOTE);
				if($res){
					$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable hideauto"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>'.$this->lang->line('success_message').'</div>');
				}
			}
		   redirect('establishment/work_allote');
		} else {
			$data['form_input'] = $this->input->post();
		}
		$data['employees'] = get_establishment_employees();
		$data['category_detail'] = $this->est_category_master_model->fetch_category_yid();		
		$data['view_file'] = "manage_work_allote";
		$data['module_name'] = "establishment";
		$this->template->index($data);

	}
	



  public function show_404() {
         $this->load->view('404');
 	}
}