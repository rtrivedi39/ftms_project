<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class admin_employee_vechilde extends MX_Controller {
     function __construct() {
        parent::__construct();
        $this->load->module('template');
        $this->load->model('admin_employee_vechilde_model','admin_employee_vechilde');
        $this->load->language('admin_employee_vechilde','hindi');
    }
 	public function index()
    {
        $data = array();
        $data['title'] = $this->lang->line('heads_heading');
        $data['title_tab'] = $this->lang->line('heads_sub_heading');
       
        $data['get_vichle']= $this->admin_employee_vechilde->get_employee_vechild('');
       
        $data['module_name'] = "admin_employee_vechilde";
        $data['view_file'] = "admin_employee_vechilde/index";
        $this->template->index($data);
    }
    public function manage_vechilde($id=null){
        $data = array();
		
        $data['title'] =$this->lang->line('heads_heading');
        $data['title_tab'] = $this->lang->line('heads_heading');
        $data['get_notice_type']=get_list(HEADS_MASTER,'head_master_id',null);
        $data['get_notice_section']=get_list(HEADS_MASTER,'head_master_id',null);
        if($id==null){
			$data['page_title'] = $this->lang->line('heads_heading');
			$data['is_page_edit']=1;
        }else{
			$data['page_title'] = $this->lang->line('edit');
			$data['is_page_edit']=0;
        $heads_detail = $this->admin_employee_vechilde->get_employee_vechild($id);
        $data['heads_detail']=$heads_detail[0];
        }
		$data['id']=$id;

		$this->form_validation->set_rules('emp_id','emp_id' , 'trim|required');
		$this->form_validation->set_rules('emp_vehicle_no','emp_vehicle_no' , 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
    	if ($this->form_validation->run($this) == TRUE)
    	{
       
		$vehicle_tbl_data=array($this->input->post());
		unset($vehicle_tbl_data[0]['savenotice']);
		//pr($heads_tbl_data[0]);
			if($id){
				$vehicle_tbl_data[0]['updated_by'] = $this->session->userdata('user_id');
				$vehicle_tbl_data[0]['updated_at'] = date('Y-m-d');
				array_push($vehicle_tbl_data,
						  $vehicle_tbl_data
						  );
				
                $res=updateData(EMPLOYEE_VEHILE,$vehicle_tbl_data[0],array('emp_vehicle_id'=>$id));
                if($res){
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable hideauto"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>'.$this->lang->line('update_success_message').'</div>');
                }
            }else{
				
				array_push($vehicle_tbl_data,$vehicle_tbl_data[0]['created_by'] = $this->session->userdata('user_id') );
              
                $res =insertData($vehicle_tbl_data[0],EMPLOYEE_VEHILE);
                if($res){
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissable hideauto"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>'.$this->lang->line('success_message').'</div>');
                }
            }
         
           redirect('admin/employee_vehicle');
      }
        $data['input_data'] = $this->input->post();
        $data['view_file'] = "vechilde_form";
        $data['module_name'] = "admin_employee_vechilde";
        $this->template->index($data);

      }

    public function delete_vehicle($id)
    {
      //  pr($id);
      
        $this->db->where('emp_vehicle_id',$id);
        $res = $this->db->delete(EMPLOYEE_VEHILE);
        if($res){
            $this->session->set_flashdata('message','<div class="alert alert-danger alert-dismissable hideauto"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><i class="icon fa fa-check"></i>'.$this->lang->line('delete_success_message').'</div>');
        }
          redirect('admin/add_vehicle');
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