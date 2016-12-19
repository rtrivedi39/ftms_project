<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_teep_master  extends MX_Controller {
     function __construct() {
        parent::__construct();
        $this->load->module('template');
		$this->load->language('admin_teep_master','hindi');
        $this->load->model('admin_teep_master_model','teep_model');
	    $CI =& get_instance();
   }

 	public function index()
    {
		
        $data = array();
        $data['title'] = $this->lang->line('teep_title');
        $data['title_tab'] = $this->lang->line('teep_all_section_label'); 
		
        $data['get_teeps'] = $this->teep_model->get_teep_details();
        //pre($data['get_section']);
        $data['module_name'] = "admin_teep_master";
        $data['view_file'] = "admin_teep_master/index";
        $this->template->index($data);
    }

    public function manage_teep($id=null){
	    echo "sulbha ";
        $this->load->helper(array('form', 'url'));
        $data = array();
        $data['title'] = $this->lang->line('teep_page_title');
        $data['title_tab'] = $this->lang->line('all_section_label'); 
        if($id==null){
            $data['page_title'] = $this->lang->line('teep_add_page_title');
            $data['is_page_edit']=1;

        }else{
           
            $data['page_title'] = $this->lang->line('teep_edit_page_title');
            $data['is_page_edit']=0;
            $teep_master_detail = $this->teep_model->get_teep_details($id);
            $data['teep_master_details'] = $teep_master_detail[0];
        }
        $data['id']=$id;
        $this->form_validation->set_rules('title',$this->lang->line('title'), 'trim|required|xss_clean');
        $this->form_validation->set_rules('status',$this->lang->line('status'), 'trim|required|xss_clean');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

        if ($this->form_validation->run($this) === TRUE)
        {
			 
			  $teep_tbl_data = array($this->input->post());
			  unset($teep_tbl_data[0]['emprole_level']);
			
			$emprole_lvl = array();
			foreach($this->input->post('emprole_level') as $emprole_level_id){
				$emprole_lvl[] = $emprole_level_id;
			}
			$role_lvl = implode($emprole_lvl,',');
			$emprole_level_id =  array('emprole_level_id'=> $role_lvl );
			$array_final = array_merge( $teep_tbl_data[0] , $emprole_level_id);
		
		 
            if($id){
				$updated_date =  array('updated_at'=> date('Y-m-d H:i:s'));
				$array_final = array_merge( $array_final ,$updated_date);
				//pr($array_final);
				$res=updateData(TEEP_MASTER, $array_final,array('autoload_teep_master_id'=>$id));
                if($res){
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable hideauto"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>'.$this->lang->line('update_success_message').'</div>');
                }
            }else{
				
                $res =insertData($array_final,TEEP_MASTER);
                if($res){
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable hideauto"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>'.$this->lang->line('success_message').'</div>');
                }
            }
            redirect('admin/teep_list');
        }
		$data['get_emp_rolelist'] = $this->teep_model->get_employee_rolelist();
      
        $data['view_file'] = "admin_manage_teep";
        $data['module_name'] = "admin_teep_master";
        $this->template->index($data);

    }
	public function get_employee_lavel_name($lavel_ids = null){
		$emp_label = $this->teep_model->get_employee_lavel_name($lavel_ids);
		return  $emp_label->emprole_name_hi .'/'.$emp_label->emprole_name_en;
	}
    function alpha_dash_space($str)
    {
        if(!preg_match("/^([-a-z_ ])+$/i", $str)){
            $this->form_validation->set_message('alpha_dash_space',$this->lang->line('text_allow_with_space_error'));
            return false;
        }
    } 
    public function delete_teep($id){
        if(isset($id) && $id!='' ){
            $res =delete_data(TEEP_MASTER,array('autoload_teep_master_id'=>$id));
            if($res){
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable hideauto"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>'.$this->lang->line('delete_success_message').'</div>');
            }
            redirect('admin/teep_list');
        }
    }
    public function show_404() {
         $this->load->view('404');
 	}
}