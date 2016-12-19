<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sub_file_type extends MX_Controller {
     function __construct() {
        parent::__construct();
        $this->load->module('template');
        $this->load->model('sub_file_type_model');
        $this->load->language('sub_section_file_type','hindi');
    }
 	public function index()
    {
        $data = array();
        $data['title'] = $this->lang->line('title');
        $data['title_tab'] = $this->lang->line('sub_title');
        $data['get_types']= $this->sub_file_type_model->sub_file_types();		
        $data['view_file'] = "sub_file_type/index";
        $this->template->index($data);
    }
    public function manage_sub_file_type($id=null){
        $data = array();
		
        $data['title'] = "Add type";
        $data['title_tab'] = "Types";       
        if($id == null){
			$data['page_title'] = "Add type";
			$data['is_page_edit'] = 1;
        }else{
			$data['page_title'] = "Edit type";
			$data['is_page_edit'] = 0;
			$data['get_types'] = $this->sub_file_type_model->sub_file_types($id);
			$data['get_types'] = $data['get_types'][0];
        }
		$data['id'] = $id;

		$this->form_validation->set_rules('section_id','section_id' , 'trim|required');
		$this->form_validation->set_rules('type_name','type_name' , 'trim|required');

       $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');	
		if ($this->form_validation->run($this) == TRUE)
		{
			
			$type_tbl_data = array(
				'sub_file_type_name' => $this->input->post('type_name'),
				'sub_file_type_section_id' => $this->input->post('section_id')
			);
			if($id){
				$res = updateData(SUB_FILE_TYPE, $type_tbl_data, array('sub_file_type_id' => $id));
				if($res){
					$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable hideauto"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>'.$this->lang->line('update_success_message').'</div>');
				}
			}else{
				//pr($section_tbl_data);
				$res =insertData($type_tbl_data, SUB_FILE_TYPE);
				if($res){
					$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable hideauto"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>'.$this->lang->line('success_message').'</div>');
				}
			}
			 
			redirect('admin/sub_file_type');
		}
		$data['input_data'] = $this->input->post();
		$data['view_file'] = "manage_sub_file_type";
		$this->template->index($data);
	}

    public function sub_file_type_delete($id)
    {
      //  pr($id);
        $data1 = array('notice_trash'=>'1');
        $this->db->where('notice_id',$id);
        $res = $this->db->update(SUB_FILE_TYPE,$data1);
        if($res){
            $this->session->set_flashdata('delete',$this->lang->line('delete_success_message'));
        }
        redirect('admin/notice');
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