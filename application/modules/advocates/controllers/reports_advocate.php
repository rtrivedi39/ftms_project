<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reports_advocate extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->model('advocates_report_model');
        $this->load->language('admin_user', 'hindi');
        $this->load->language('advocate', 'hindi');
		$this->load->helper('advocate');
        authorize();
    }

    public function index($adv_type) {
		$data = array();
		$advocat_type = get_row("SELECT adm_name,adm_id  FROM `ft_advocate_name_master` WHERE `adm_id`=$adv_type");
		$data['title'] =$advocat_type['adm_name'];
        $data['get_users'] = $this->advocates_report_model->get_advocate_list($adv_type,null,null,null);
		$this->load->view("advocates/report_index",$data);	
       
    }
	
    public function advocate_report_bypost( )
	{
		$data = array();
		$adv_type = $this->input->post('adv_type');
		//$advocat_type = get_row("SELECT adm_name,adm_id  FROM `ft_advocate_name_master` WHERE `adm_id`=1");
		//$data['title'] =$advocat_type['adm_name']
		//$data['title_tab'] = 'सूची';
        $data['advocate_details'] = $this->advocates_report_model->get_advocate_list_dst_tah_tal($adv_type,null,null,null);
		$this->load->view('tables',$data );
		
	}
	/*public function advocate_report_bypost_taluka( )
	{
		//echo "tahsil";
		$data = array();
		$adv_type = $this->input->post('adv_type');
		//$advocat_type = get_row("SELECT adm_name,adm_id  FROM `ft_advocate_name_master` WHERE `adm_id`=1");
		//$data['title'] =$advocat_type['adm_name']. ' की सूची';
		//$data['title_tab'] = 'सूची';
        $data['advocate_details'] = $this->advocates_report_model->get_advocate_list_dst_tah(1,null,null,null);
		$this->load->view('tables',$data );
		
	} */
}
