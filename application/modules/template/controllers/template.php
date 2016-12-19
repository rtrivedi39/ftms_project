<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');
class Template extends MX_Controller {
	function __construct(){
		//$this->load->module('template');
		$this->benchmark->mark('start');
	}
	public function index($data) {
		 if ($this->session->userdata('admin_logged_in') === true) {
			$this->load->view('template/admin_template',$data);
		}else{
			$this->load->view('template/user_template',$data);
		}
	}
	/*public function admin_index($data) {
		 if ($this->session->userdata('admin_logged_in') === false) {
		 	redirect('home');
		}else{
		 	$this->load->view('template/admin_template',$data);
		}
			
	}
	public function user_index($data) {
		 if ($this->session->userdata('is_logged_in') === false) {
		 	redirect('home');
		}else{
		 	$this->load->view('template/user_template',$data);
		}
			
	} */

}
