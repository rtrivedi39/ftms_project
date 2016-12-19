<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_head_master extends MX_Controller {
     function __construct() {
        parent::__construct();
        $this->load->module('template');
        $this->load->model('admin_head_master_model');
        $this->load->language('admin_head_master','hindi');
    }
 	public function index()
    {
        $data = array();
        $data['title'] = $this->lang->line('heads_heading');
        $data['title_tab'] = $this->lang->line('heads_sub_heading');
       
        $data['get_heads']= $this->admin_head_master_model->fetchheadsbyid();
       
        $data['module_name'] = "admin_head_master";
        $data['view_file'] = "admin_head_master/index";
        $this->template->index($data);
    }
    public function manage_head($id=null){
        $data = array();
		
        $data['title'] = "Add Head";
        $data['title_tab'] = "Heads";
        $data['get_notice_type']=get_list(HEADS_MASTER,'head_master_id',null);
        $data['get_notice_section']=get_list(HEADS_MASTER,'head_master_id',null);
        if($id==null){
			$data['page_title'] = "Add Head";
			$data['is_page_edit']=1;
        }else{
			$data['page_title'] = "Edit Head";
			$data['is_page_edit']=0;
        $heads_detail = $this->admin_head_master_model->fetchheadsbyid($id);
        $data['heads_detail']=$heads_detail[0];
        }
		$data['id']=$id;

		$this->form_validation->set_rules('section_id','section_id' , 'trim|required');
		$this->form_validation->set_rules('head_code','head_code' , 'trim|required');
		$this->form_validation->set_rules('head_title','head_title' , 'trim|required');
     
     

      $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
 //echo $this->form_validation->run($this);die;
 //echo $this->form_validation->run($this);die;
    if ($this->form_validation->run($this) == TRUE)
     {
       
		$heads_tbl_data=array($this->input->post());
		unset($heads_tbl_data[0]['savenotice']);
		//pr($heads_tbl_data[0]);
			if($id){
                $res=updateData(HEADS_MASTER,$heads_tbl_data[0],array('head_master_id'=>$id));
                if($res){
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable hideauto"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>'.$this->lang->line('update_success_message').'</div>');
                }
            }else{
                //pr($section_tbl_data);
                $res =insertData($heads_tbl_data[0],HEADS_MASTER);
                if($res){
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable hideauto"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>'.$this->lang->line('success_message').'</div>');
                }
            }
         
           redirect('admin/heads');
      }
        $data['input_data'] = $this->input->post();
        $data['view_file'] = "admin_head_master";
        $data['module_name'] = "admin_notice_master";
        $this->template->index($data);

      }

    public function delete_head($id)
    {
      //  pr($id);
      
        $this->db->where('head_master_id',$id);
        $res = $this->db->delete(HEADS_MASTER);
        if($res){
            $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable hideauto"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>'.$this->lang->line('delete_success_message').'</div>');
        }
         redirect('admin/heads');
    }

    function alpha_dash_space($str)
    {
        if(!preg_match("/^([-a-z_ ])+$/i", $str)){
            $this->form_validation->set_message('alpha_dash_space',$this->lang->line('text_allow_with_space_error'));
            return false;
        }
    }
  public function show_404() {
         $this->load->view('404');
 	}
}