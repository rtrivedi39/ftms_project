<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Generate_notesheet extends MX_Controller {
     function __construct() {
        parent::__construct();
        $this->load->module('template');
        $this->load->model('generate_notice_model');
        $this->load->language('display_notesheet','hindi');
    }
 	public function index($file_id=null, $notesheet_type_id = null)
    {
		
        $data = array();
        $data['title'] = $this->lang->line('title');
        $data['title_tab'] = $this->lang->line('page_title');
		if ($file_id) {  $data['file_dat_show'] = getFiledata($file_id);  }
		$data['get_notesheet']= get_list(NOTESHEET_MASTER, NULL ,array('notesheet_type'=>$notesheet_type_id));
        $data['get_notice']= $this->generate_notice_model->fetchnoticebyid();
       //pr($data['get_notice']);
        $data['module_name'] = "display_notesheet";
        $data['view_file'] = "display_notesheet/notesheet";
        $this->template->index($data);
    }
    public function notesheet($file_id=null, $notesheet_type_id = null ,$notesheet_id = null){
        $data = array();
        $data['title'] = "All Notices";
        $data['title_tab'] = "Notices";
        $get_notesheet = get_list(NOTESHEET_MASTER, NULL ,array('notesheet_type'=>$notesheet_type_id));
		//pr(  $data['get_notesheet']);
        $data['get_notice_section']=get_list(SECTIONS,'section_id',null);
		
        $data['view_file'] = "admin_notesheet_master/".$get_notesheet[0]['file_name'] ;
        $data['module_name'] = "display_notesheet";
        $this->template->index($data);

      }

    public function notice_delete($id)
    {
      //  pr($id);
        $data1 = array('notice_trash'=>'1');
        $this->db->where('notice_id',$id);
        $res = $this->db->update(NOTICE_BOARD,$data1);
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