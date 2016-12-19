<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_notesheet_type_master extends MX_Controller {
     function __construct() {
        parent::__construct();
        $this->load->module('template');
        $this->load->model('admin_notesheet_type_master_model','notesheet_type_master_model');
        $this->load->language('admin_notesheet_type_master', 'hindi');
   }

 	public function index()
    {
        $data = array();
        $data['title'] = $this->lang->line('nt_mastmenu_title_label');
        $data['title_tab'] = $this->lang->line('nt_sub_mastmenu_title_label'); 
        $data['nt_menu_master_list']=get_list(NOTESHEET_MASTER_MENU,'notesheet_menu_id',null);
        //pre($data['get_section']);
        $data['module_name'] = "admin_notesheet_type_master";
        $data['view_file'] = "admin_notesheet_type_master/index";
        $this->template->index($data);
    }

    public function manage_notesheet_mastmenu($id=null){
        $this->load->helper(array('form', 'url'));
        $data = array();
        $data['title'] = $this->lang->line('nt_mastmenu_title_label');
        $data['title_tab'] =$this->lang->line('nt_sub_mastmenu_title_label');
        $data['page_title'] = $this->lang->line('Manage_notesheet_label');
        $data['is_page_edit']=0;
        if(isset($id) && $id!=''){
            $otherwork_master_detail=get_list(NOTESHEET_MASTER_MENU,null,array('notesheet_menu_id'=>$id));
            $data['otherwork_master_detail']=$otherwork_master_detail[0];
            $data['id']=$id;
        }
        $this->form_validation->set_rules('section_id',$this->lang->line('label_section_id_hi') , 'trim|required|xss_clean');
        $this->form_validation->set_rules('notesheet_menu_title_hi',$this->lang->line('label_error_otherwork_hi') , 'trim|required|xss_clean');
        $this->form_validation->set_rules('notesheet_menu_title_en',$this->lang->line('label_error_otherwork_en'), 'trim|xss_clean');
        //$this->form_validation->set_rules('section_short_name',$this->lang->line('section_short_label'), 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        if($this->input->post()){
            $section_tbl_data=array($this->input->post());
            $data['post_date']=$section_tbl_data[0];
            
        }
        if ($this->form_validation->run($this) === TRUE)
        {
            
            //pr($section_tbl_data);
            if($id){
                $res=updateData(NOTESHEET_MASTER_MENU,$section_tbl_data[0],array('notesheet_menu_id'=>$id));
                if($res){
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable hideauto"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>'.$this->lang->line('update_success_message').'</div>');
                }
            }else{
                    $res=insertData($section_tbl_data[0],NOTESHEET_MASTER_MENU);
                if($res){
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable hideauto"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>'.$this->lang->line('success_message').'</div>');
                }
            }
            redirect('admin/notesheet_master_menu');
        }
        //$data['get_section']=get_list(SECTIONS,'section_id',null);
        //pre($data['get_section']);
        $data['view_file'] = "admin_notesheet_type_master";
        $data['module_name'] = "admin_notesheet_type_master";
        $this->template->index($data);

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