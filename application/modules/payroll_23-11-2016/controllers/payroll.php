<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Payroll extends MX_Controller {

    function __construct() {
        parent::__construct();

      // if($this->session->userdata('user_id') != 115010496 || $this->session->userdata('user_id') != 171005898  || $this->session->userdata('user_id') != 51010885) {
       
      //       redirect('home'); // the user is not logged in, redirect them!
      //   }
        $this->load->module('template');
		$this->load->helper('cookie','payroll');
     //  $this->load->language('leave', 'hindi');
        $this->load->model("payroll_model");
         $this->load->language('payroll', 'hindi');
		     

           //   $this->load->language('leave_approve', 'hindi');
    }

    /**
     * Check if the user is logged in, if he's not, 
     * send him to the login page
     * @return void
     */

    public function index()
     {
        if ($this->session->userdata('is_logged_in')) {
            redirect('dashboard');
        } else if ($this->session->userdata('admin_logged_in')) {
            redirect('admin/dashboard');
        } else {
            $data['title'] = $this->lang->line('home_title');
            $data['notice'] = $this->admin_notice->fetchnoticebyid();
            $this->load->view('home', $data);
        }
    }

      
    function showbuget()
    {
	     $pay_cate_id = $this->uri->segment(3);
		    $data['dataval'] =$this->payroll_model->getcate_al($pay_cate_id);
        $this->load->view("payroll/test" ,$data);

    }
	function addallareays()
	{
	pre($_POST);
	}
    /**
     * encript the datakey 
     * @return mixed
     */
    function __encrip_password($datakey) {
        return md5($datakey);
    }

    /**
     * check the username and the password with the database
     * @return void
     */
    
    public function uploadfile()
    {
      $this->load->view("uploadfrom");
    }
 
    public function register()
    {

         $data['title'] = $this->lang->line('pay_title');
         $data['title_tab'] = $this->lang->line('view_all_employee');
        // $data['details_leave'] = $this->payroll_model->getEmployeeLeave();
      //  $data['pay_regi'] = $this->payroll_model->getpayroll();
		// echo "fsdfsd";die();
         $data['module_name'] = "payroll";
          $data['view_file'] = "payroll/emp_register";
        // $data['view_file'] = "payroll/register";
         $this->template->index($data);
      //$this->load->view('register',$data);
    }
    public function showrigtser()
    {
      $emp_id = $_GET["uid"];
        $data['title'] = $this->lang->line('pay_title');
         $data['title_tab'] = $this->lang->line('pay_title');
         $data['pay_regi'] = $this->payroll_model->getpay($emp_id);
          $data['emp_details'] = $this->payroll_model->getemp($emp_id);
      foreach ($data['emp_details']as $key => $valueca) {
        $pay_cate_id =$valueca->emp_pay_cate_id;

      }
      $condi =  array("pay_cate_id"=>$pay_cate_id );
       $data['pay_basic'] = getsum('ft_pay_register' , '`pay_emp_unique_id` ='.$emp_id,'pay_basic');
       //print_r($pay_basic);
      $data['dataval'] = get_list("ft_pay_salary_category",'pay_cate_id',$condi);
           $data['module_name'] = "payroll";
          $data['view_file'] = "payroll/emp_register_details";
        // $data['view_file'] = "payroll/register";
          $this->template->index($data);

    }

	public function empslary()
	{
		
		$emp_id = $this->uri->segment("3");
	$data['title'] = $this->lang->line('emp_salary_details');
		$data['pay_regi'] = $this->payroll_model->getpay($emp_id);
		$data['emp_bank'] = $this->payroll_model->emp_bank($emp_id);
		//pre($data['pay_regi']);
		$data['module_name'] = "payroll";
         $data['view_file'] = "payroll/emp_salary";
         $this->template->index($data);
	}
    public function salary_mastar()
    {
        $data['title'] = $this->lang->line('salary_mastar');
        $data['title_tab'] = $this->lang->line('salary_mastar');
    
        $data['pay_salary'] = $this->payroll_model->salary_mastar();
        $data['module_name'] = "payroll";
        $data['view_file'] = "payroll/salary_mastar";
        $this->template->index($data);


    }
     public function addsalary(){
        $data['title'] = $this->lang->line('emp_salary_details');

    //pre($data['pay_regi']);
    $data['module_name'] = "payroll";
         $data['view_file'] = "payroll/emp_salary_details";
         $this->template->index($data);
    }
    public function showdetails()
    {
    
      $emp_id =$_GET['emp_unique_codeemp_unique_code'];
    
        $data['emp_details'] = $this->payroll_model->getemp($emp_id);
      foreach ($data['emp_details']as $key => $valueca) {
        $pay_cate_id =$valueca->emp_pay_cate_id;

      }
      $condi =  array("pay_cate_id"=>$pay_cate_id );
        $data['dataval'] = get_list("ft_pay_salary_category",'pay_cate_id',$condi);

       $data['pay_salary'] = $this->payroll_model->getpaymonthmaster($emp_id);
   
  			  redirect("payroll/showsalaryexcase/".$emp_id."/".date("F"));
    //  
         // pre($data['dataval'] );
         $data['module_name'] = "payroll";
       $data['view_file'] = "payroll/add_edit_salary";
      $this->load->view("add_edit_salary" ,$data);
      //  $this->template->index($data);
    }function showsalaryexcase()
	{

	        $data['emp_details'] = $this->payroll_model->getemp($this->uri->segment(3));
      foreach ($data['emp_details']as $key => $valueca) {
        $pay_cate_id =$valueca->emp_pay_cate_id;

      }
      $condi =  array("pay_cate_id"=>$pay_cate_id );
	
        $data['dataval'] = get_list("ft_pay_salary_category",'pay_cate_id',$condi);

	    $data["pay_salary"] = $this->payroll_model->showsalaryexcase();
      $this->load->view("add_edit_salary" ,$data);
	
	}function showsalaryexcase1()
	{

	   $data["pay_salary"] = $this->payroll_model->showsalaryexcase1();
      $condi =  array("pay_cate_id"=>$data["pay_salary"][0]->pay_salary_cate_id );
	
        $data['dataval'] = get_list("ft_pay_salary_category",'pay_cate_id',$condi);

	    $data["pay_salary"] = $this->payroll_model->showsalaryexcase1();
      $this->load->view("add_edit_salary1" ,$data);
	
	}
    public function pay_modification()
    {
       $emp_id = $_GET["emp_unique_codeemp_unique_code"];
          $pay_month= $_GET["pay_month"];
        
      $last_month = Date('F', strtotime($pay_month . " last month"));
      $data['this_pay_month'] = $this->payroll_model->getpaymonth($emp_id,$pay_month);
     $data['emp_details'] = $this->payroll_model->getemp($emp_id);
       $data['emp_emi'] = $this->payroll_model->getemp_emi($emp_id);
      foreach ($data['emp_details']as $key => $valueca) {
        $pay_cate_id =$valueca->emp_pay_cate_id;

      }
      $condi =  array("pay_cate_id"=>$pay_cate_id );
      $data['dataval'] = get_list("ft_pay_salary_category",'pay_cate_id',$condi);
        
    $data['emp_bank'] = $this->payroll_model->emp_bank($emp_id);
     $data['adv'] = $this->payroll_model->advance();
      $data['pay_regi'] = $this->payroll_model->getpaymonth($emp_id,$pay_month);
   $data['module_name'] = "payroll";
         $data['view_file'] = "payroll/modificatiosalary";
               $this->template->index($data);

    }
      public function addcate()
    {
        $data['title'] = $this->lang->line('salary_mastar');
        $data['title_tab'] = $this->lang->line('salary_mastar');
    
     
        $data['module_name'] = "payroll";
        $data['view_file'] = "payroll/addcate";
        $this->template->index($data);


    }
	public function advance()
	{
	           $data['title'] = $this->lang->line('tab3_pay_adv');
        $data['title_tab'] = $this->lang->line('tab3_pay_adv');
    
      $data['pay_salary'] = $this->payroll_model->advance();
        $data['module_name'] = "payroll";
        $data['view_file'] = "payroll/advance";
        $this->template->index($data);
	}public function add_adv()
	{
	                  $data['title'] = $this->lang->line('tab3_pay_adv');
        $data['title_tab'] = $this->lang->line('tab3_pay_adv');
        $data['module_name'] = "payroll";
        $data['view_file'] = "payroll/add_adv";
        $this->template->index($data);
	}public function post_adv()
	{
	          $data = $this->input->post();
			 $data['pay_regi'] = insertData($data , "ft_pay_advance_master");
			 redirect('payroll/advance');
        $this->template->index($data);
	}
    public function allcate(){

           $data['title'] = $this->lang->line('salary_mastar');
        $data['title_tab'] = $this->lang->line('salary_mastar');
    
      $data['pay_salary'] = $this->payroll_model->salary_mastar();
        $data['module_name'] = "payroll";
        $data['view_file'] = "payroll/allcate";
        $this->template->index($data);
    }
    public function add_cate()
    {
        
        $data = $this->input->post();

        $data['pay_regi'] = insertData($data , "ft_pay_salary_category");
        redirect('payroll/salary_mastar');
    }
    public function add_salary()
    {
		$data['title'] = $this->lang->line('salary_mastar');
        $data['title_tab'] = $this->lang->line('salary_mastar');
     // $data['details_leave'] = $this->payroll_model->salary_cate();
        $data['pay_salary'] = $this->payroll_model->salary_mastar();
        $data['module_name'] = "payroll";
        $data['view_file'] = "payroll/salary_mastar";
        $this->template->index($data);


    }
   public function empcate()
    {

		   if($this->session->userdata('user_id') == 'admin'  || $this->session->userdata('user_id') == 115010496 || $this->session->userdata('user_id') == 171005898  || $this->session->userdata('user_id') == 51010885)
		   {
                $emp_id = $this->uri->segment("3");
                   $emp_month = $this->uri->segment("4");
        $data['pay_salary'] = $this->payroll_model->salary_emp($emp_id,$emp_month);
         $data['cate_salary'] = $this->payroll_model->cate_salary($emp_id);
         $data['pay_bill'] = $this->payroll_model->pay_bill_cate1($emp_id,$emp_month);
          $condi =  array("pay_cate_id"=>$emp_id );
      $data['dataval'] = get_list("ft_pay_salary_category",'pay_cate_id',$condi);
        $this->load->view("empccate" , $data);
		  }else{
			  
			    redirect("dashboard");
		  }
    }
   
    public function employee_list(){
        $data['title'] = $this->lang->line('view_all_employee');
        $data['title_tab'] = $this->lang->line('view_all_employee');
        $data['details_leave'] = $this->payroll_model->getpayroll();

        $data['module_name'] = "payroll";
        $data['view_file'] = "payroll_employee";
        $this->template->index($data);
    }

    public function show_404() {
        $this->load->view('404');
    }

    public function faq() {
        $data['title'] = 'FAQ'; //$this->lang->line('title_faq');
        $this->load->view('faq', $data);
    }

    public function privacy_policy() {
        $data['title'] = 'Privacy policy'; //$this->lang->line('title_faq');
        $this->load->view('privacy_policy', $data);
    }

public function departmental_setup() {
        $data['title'] = 'Departmental setup'; //$this->lang->line('title_faq');
        $this->load->view('departmental_setup', $data);
    }
	public function allarreays ()
	{
	// $data['title'] = 'Departmental setup'; //$this->lang->line('title_faq');
	    $data['module_name'] = "payroll";
        $data['view_file'] = "allarreaysfrom";
        $this->template->index($data);
       
	
	}

    public function add_emp_salary()
    {
      print_r($_POST);
      $emi = $this->payroll_model->getemp_emi($_POST['emp_unique_code']);
      if($_POST['emp_unique_code'] != "")
      {
           $data['emp_details'] = $this->payroll_model->getemp($_POST['emp_unique_code']);
            $ifemp = count($data['emp_details']);
            if($ifemp == 1)
            {
              if(isset($_POST['pay_define'])){
               $pay_define =$_POST['pay_define']; 
              }else{
               $pay_define=0;
              }
            if(isset($_POST['pay_madical'])){
               $madical =$_POST['pay_madical'];
              }else{
               $madical=0;
              }
              if(isset($_POST['pay_gradepay'])){
               $pay_gradepay =$_POST['pay_gradepay'];
              }else{
               $pay_gradepay=0;
              }
              if(isset($_POST['pay_special'])){
               $pay_special =$_POST['pay_special'];
              }else{
               $pay_special=0;
              }
              $pay_ca = "";
              if(isset($_POST['pay_ca'])){
               $pay_ca =$_POST['pay_ca'];
              }else{
               $pay_ca =0;
              }

               if(isset($_POST['pay_fuel_charge'])){
               $pay_fuel_charge =$_POST['pay_fuel_charge'];
              }else{
               $pay_fuel_charge=0;
              }

               $data['adv'] = $this->payroll_model->advance();
               foreach ($data['adv']  as $key => $adv) {

                
              if(count($emi) == 0){
               
                if($_POST['starting_month_'.$adv->adv_id] != "")
                {

                  $p=$_POST['advance_amount_'.$adv->adv_id];
                  echo $p ."<br/>";
                    $r= $_POST['advance_inetrest_'.$adv->adv_id];
                    echo $r."<br/>";
                    $ti=$_POST['pay_income_tax_'.$adv->adv_id];   //yea$rly
                    $t=10;  
                   // $t=$t/$ti;
                    $si = ($p*$r*$t)/100;
                    echo "Simple Interest : ".$si;
      
                    $adv_date =date("Y-m-dd",strtotime($_POST['starting_month_'.$adv->adv_id]));
                $dataadv = $arrayName = array(
                  'pea_emp_unique_id' => $_POST['emp_unique_code'] ,
                 'pea_type_id' => $adv->adv_id,
                'pea_starting_month' => $adv_date,
                 'pea_intrest_rate' => $_POST['advance_inetrest_'.$adv->adv_id],
                 'pea_amount' => $_POST['advance_amount_'.$adv->adv_id],
                  'pae_interest' => $_POST['advance_inetrest_'.$adv->adv_id],
                   'pea_emi_amount' => $_POST['instalment_amount_'.$adv->adv_id],
                   'pea_emi'=> $_POST['pay_income_tax_'.$adv->adv_id],
                  
                  );// echo $_POST['starting_month_'.$adv->adv_id]."---fgdfg--"; die();
               // pre($dataadv ); 
                $dataemi = array(
                  'emi_emp_unique_id' => $_POST['emp_unique_code'] ,
                  'emi_pay_date' => date("Y-m-dd"),
                  'emi_no_installment' =>  $_POST['advnce_current_instsallment_number_'.$adv->adv_id],
                  'emi_amount' =>  $_POST['instalment_amount_'.$adv->adv_id],
                  );
                insertData($dataadv , "ft_pay_emp_advance");
                 insertData($dataemi , "ft_pay_emi");
                echo $adv->adv_name_en ."|".$_POST['instalment_amount_'.$adv->adv_id];
                  $val_adv = $adv->adv_name_en ."|".$_POST['instalment_amount_'.$adv->adv_id] ;
                 $adv.$adv->adv_id = $_POST['instalment_amount_'.$adv->adv_id];
                 }else{

                    $adv.$adv->adv_id = 0;

                 }
                
             }else{
              $dataemi = array(
                  'emi_emp_unique_id' => $_POST['emp_unique_code'] ,
                  'emi_pay_date' => date("Y-m-dd"),
                  'emi_no_installment' =>  $_POST['advnce_current_instsallment_number_'.$adv->adv_id],
                  'emi_amount' =>  $_POST['instalment_amount_'.$adv->adv_id],
                  );
              insertData($dataemi , "ft_pay_emi");
            $adv1 = $_POST['instalment_amount_'.$adv->adv_id];
             $adv2 = $_POST['instalment_amount_'.$adv->adv_id];
              $adv3 = $_POST['instalment_amount_'.$adv->adv_id];
               $adv4 = $_POST['instalment_amount_'.$adv->adv_id];
        }
      }
       
            //  $month = date("now")
           
        
            $currentmonth = date('F'); 
              $datapay = array(
                'pay_salary_cate_id' => $_POST['pay_salary_cate_id'],

                'pay_month' => $currentmonth ,
                'pay_year' => "2016" ,
                'pay_emp_unique_id' => $_POST['emp_unique_code'] ,
                'pay_basic' => $_POST['pay_basic'] ,
              'pay_grp' => $pay_gradepay ,
              'pay_da' => $_POST['pay_da'] ,
              'pay_special' => $pay_special ,
              'pay_hra' => $_POST['pay_hra'] ,
              'pay_sa' => $_POST['pay_sa'] ,
              'pay_madical' => $madical ,
              'pay_ca' => $pay_ca,
              'pay_sp' => $_POST['pay_sp'] ,
              'pay_others' => $_POST['pay_others'] ,
              'pay_total_sum' => $_POST['pay_total_sum'] ,
               'pay_gpf' => $_POST['pay_gpf'] ,
              'pay_gias' => $_POST['pay_gias'] ,
              'pay_defined_contribution' => $pay_define ,
              'pay_fuel_charge' => $pay_fuel_charge ,
              'pay_professional_tax' => $_POST['pay_professional_tax'] ,
              'pay_income_tax' => $_POST['pay_income_tax'] ,
              'pay_ca' => $_POST['pay_ca'] ,
              'pay_sp' => $_POST['pay_sp'] ,
              'pay_others' => $_POST['pay_others'] ,
              'pay_total_sum' => $_POST['pay_total_sum'] ,
			         'pay_grain_adv' => $adv1 ,
              'pay_festival_adv' => $adv2,
               'pay_other_adv' => $adv3,
        
               );
              

           //  insertData($datapay , "ft_pay_register");
            $this->payroll_model->update_salary($datapay);
    redirect("payroll/addsalary");
            }
      }
    }
    public function pan_adhar_house()
    {
     $data['title'] = $this->lang->line('view_all_employee');
        $data['title_tab'] = $this->lang->line('view_all_employee');
        $data['details_leave'] = $this->payroll_model->getempdetails();

        $data['module_name'] = "payroll";
        $data['view_file'] = "payroll_employee_details";
        $this->template->index($data);

    }
    public function adddetails()
    {
  $emp_id = $this->uri->segment("3");
           $data['title'] = $this->lang->line('view_all_employee');
        $data['title_tab'] = $this->lang->line('view_all_employee');
        $data['details_leave'] = $this->payroll_model->getempdetails( $emp_id );
        $data['gpf'] = $this->payroll_model->getempgpf( $emp_id );
$data['house_type'] = $this->payroll_model->house_type();
        $data['module_name'] = "payroll";
        $data['view_file'] = "add_employee_details";
        $this->template->index($data);
    }
    public function add_deatils()
    {
      $this->payroll_model->add_deatils();
      redirect("payroll/pan_adhar_house");
    }

    public function payslip()
    {
    
            $data['title'] = $this->lang->line('pay_slip');
        $data['title_tab'] = $this->lang->line('pay_slip');
        $data['module_name'] = "payroll";
        $data['view_file'] = "payslip";
        $this->template->index($data);
    }
public function pay_slip()
    {
     $emp_month = $_POST['pay_month'];

         $emp_id = $_POST['uid'];
          $data['payslip'] = $this->payroll_model->pay_slip();
        $data['emp_details'] = $this->payroll_model->getemp($emp_id);

      foreach ($data['emp_details']as $key => $valueca) {
        $pay_cate_id =$valueca->emp_pay_cate_id;

      }
      $condi =  array("pay_cate_id"=>$pay_cate_id );

      $data['pay_bill'] = $this->payroll_model->pay_bill_cate($pay_cate_id,$emp_month);
           $data['dataval'] = get_list("ft_pay_salary_category",'pay_cate_id',$condi);
          $this->load->view("pay_slip" , $data);
    }

    /**
     * logout all session and redirect to home page
     * @return void
     */
    public function logout() {
        $this->Users_model->destroy_user_login_log();
        $this->session->sess_destroy();
        no_cache();
        redirect("home");
    }
    public function paydiduction()
    {
      $data['title'] = $this->lang->line('salary_mastar');
      $data['title_tab'] = $this->lang->line('salary_mastar');
      $data['pay_salary'] = $this->payroll_model->salary_mastar();
      $data['module_name'] = "payroll";
        $data['view_file'] = "paydiduction";
        $this->template->index($data);
    }

     public function paydiduction_paper()
	 {
      $data['title'] = $this->lang->line('salary_mastar');
      $data['title_tab'] = $this->lang->line('salary_mastar');
      $data['pay_salary'] = $this->payroll_model->salary_mastar();
      $data['module_name'] = "payroll";
        $data['view_file'] = "paydiduction2";
        $this->template->index($data);
    }

  public function diductionarr()
    {$emp_id = $this->uri->segment(3);
                 $data['title'] = $this->lang->line('salary_mastar');
        $data['title_tab'] = $this->lang->line('salary_mastar');
     $data['cate_salary'] = $this->payroll_model->cate_salary($emp_id);
      $condi =  array("pay_cate_id"=>$emp_id );
      $data['dataval'] = get_list("ft_pay_salary_category",'pay_cate_id',$condi);
      $data['pay_salary'] = $this->payroll_model->salary_mastar();
        $data['module_name'] = "payroll";
        $data['view_file'] = "pay_diduction_summary1";
        $this->template->index($data);
    }
  public function diduction()
    {$emp_id = $this->uri->segment(3);
                 $data['title'] = $this->lang->line('salary_mastar');
        $data['title_tab'] = $this->lang->line('salary_mastar');
     $data['cate_salary'] = $this->payroll_model->cate_salary($emp_id);
      $condi =  array("pay_cate_id"=>$emp_id );
      $data['dataval'] = get_list("ft_pay_salary_category",'pay_cate_id',$condi);
      $data['pay_salary'] = $this->payroll_model->salary_mastar();
        $data['module_name'] = "payroll";
        $data['view_file'] = "pay_diduction_summary";
        $this->template->index($data);
    }
 public function backdiduction()
    {$emp_id = $this->uri->segment(3);
                 $data['title'] = $this->lang->line('salary_mastar');
        $data['title_tab'] = $this->lang->line('salary_mastar');
     $data['cate_salary'] = $this->payroll_model->cate_salary($emp_id);
      $condi =  array("pay_cate_id"=>$emp_id );
      $data['dataval'] = get_list("ft_pay_salary_category",'pay_cate_id',$condi);
      $data['pay_salary'] = $this->payroll_model->salary_mastar();
        $data['module_name'] = "payroll";
        $data['view_file'] = "pay_diduction_summaryback";
        $this->template->index($data);
    }
 public function paydd_papar_bck()
    {$month = $this->uri->segment(3);
       $m = $this->uri->segment(4);  
   $data['pay_bill'] = $this->payroll_model->month_salary_cate('2016',$month);
    $data['pay_salary'] = $this->payroll_model->pay_diduction_bck($month,$m);


         // pre($data['pay_salary']);die();
        $data['module_name'] = "payroll";
        $data['view_file'] = "pay_diduction_summary_dd_bck";
        $this->template->index($data);
}
      public function paydd()
      {
       

      
        $cate_id = $this->uri->segment(3);
          $month = $this->uri->segment(4);

  $data['pay_bill'] = $this->payroll_model->month_salary_cate('2016',$month);
  $condi =  array("pay_cate_id"=>$cate_id);
      $data['dataval'] = get_list("ft_pay_salary_category",'pay_cate_id',$condi);
          $data['pay_salary'] = $this->payroll_model->pay_diduction($cate_id,$month);
         // pre($data['pay_salary']);die();
        $data['module_name'] = "payroll";
        $data['view_file'] = "pay_diduction_summary_dd";
        $this->template->index($data);

      }
      public function paydd_papar()
      {
       
		$f1 = $this->uri->segment(3);
      
        $cate_id = $this->uri->segment(4);
          $month = $this->uri->segment(5);

		  $data['pay_bill'] = $this->payroll_model->month_salary_cate('2016',$month);
		  $condi =  array("pay_cate_id"=>$cate_id);
			$data['dataval'] = get_list("ft_pay_salary_category",'pay_cate_id',$condi);
          $data['pay_salary'] = $this->payroll_model->pay_diduction1($f1,$cate_id,$month);
         // pre($data['pay_salary']);die();
        $data['module_name'] = "payroll";
        $data['view_file'] = "pay_diduction_summary_dd_papar";
        $this->template->index($data);

      }
	  function currentda()
	  {
		  	$f1 = $this->uri->segment(3);
		    $pay_bill = $this->payroll_model->currentda($f1);
		echo $pay_bill ;
	  }
      public function paydd_papararr()
      {
       
$f1 = $this->uri->segment(3);
      
        $cate_id = $this->uri->segment(4);
          $month = $this->uri->segment(5);

  $data['pay_bill'] = $this->payroll_model->month_salary_cate('2016',$month);
  $condi =  array("pay_cate_id"=>$cate_id);
      $data['dataval'] = get_list("ft_pay_salary_category",'pay_cate_id',$condi);
          $data['pay_salary'] = $this->payroll_model->pay_diduction12($f1,$cate_id,$month);
         // pre($data['pay_salary']);die();
        $data['module_name'] = "payroll";
        $data['view_file'] = "pay_diduction_summary_dd_papar1";
        $this->template->index($data);

      }

	public function paybillno()
    {
        $data['title'] = $this->lang->line('pay_slip');
        $data['title_tab'] = $this->lang->line('pay_slip');
        $data['pay_cate'] = $this->payroll_model->salary_mastar();
		$data['pay_emp'] = $this->payroll_model->salary_mastaremp();
        $data['pay_bills'] = $this->payroll_model->Allbills();
        $data['module_name'] = "payroll";
        $data['view_file'] = "paybillnoall";
        $this->template->index($data);
    }
    function add_bill()
    {
       $data['title'] = $this->lang->line('pay_slip');
        $data['title_tab'] = $this->lang->line('pay_slip');
        $data['pay_cate'] = $this->payroll_model->salary_mastar();
        $data['leave_approve_emp'] = $this->payroll_model->get_leave_approve_emp( );
        $data['transfer_emp'] = $this->payroll_model->get_transfer_emp( );
        $data['pay_bills'] = $this->payroll_model->Allbills();
        $data['module_name'] = "payroll";
        $data['view_file'] = "paybillno";
        $this->template->index($data);
    }
	 function edit_bill()
    {
       $data['title'] = $this->lang->line('pay_slip');
        $data['title_tab'] = $this->lang->line('pay_slip');
        $data['pay_bills'] = $this->payroll_model->bills();
        $data['pay_cate'] = $this->payroll_model->salary_mastar();
    $data['pay_emp'] = $this->payroll_model->salary_mastaremp();
   //   $data['pay_bills'] = $this->payroll_model->Allbills();
        $data['module_name'] = "payroll";
        $data['view_file'] = "edit_paybillno";
        $this->template->index($data);
    }
    function edit_pay_bill()
    {
        $data["salary_bill_cate"]= $this->payroll_model->edit_pay_bill11();
     redirect("payroll/paybillno/");
    }
	 function pay_bill($edit_id = null)
    {     
		 
		
	 	$this->form_validation->set_rules('pay_type', 'pay_type', 'required');
		if($this->input->post('pay_type') != 2  && $this->input->post('pay_type') != 3  ){
			$this->form_validation->set_rules('pay_head', 'pay_head', 'required');
			$this->form_validation->set_rules('pay_buget', 'pay_buget', 'required');
		}
		
	    $this->form_validation->set_rules('pay_month', 'pay_month', 'required');
	    $this->form_validation->set_rules('pay_year', 'pay_year', 'required');
	    $this->form_validation->set_rules('bill_grossamount', 'bill_grossamount', 'required');
	     $this->form_validation->set_rules('bill_netamount', 'bill_netamount', 'required');
	    $this->form_validation->set_rules('computer_bill_number', 'computer_bill_number', 'required');
	    $this->form_validation->set_rules('computer_bill_date', 'computer_bill_date', 'required');
	    $this->form_validation->set_rules('office_bill_number', 'office_bill_number', 'required');
	  
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		
        if ($this->form_validation->run($this) === TRUE)
        {
			if(!empty($edit_id)){
				$data['edit_id'] = $edit_id ; 
			}else{
				$data['edit_id'] = '' ; 
			}
		 	$this->form_validation->set_rules('pay_type', 'pay_type', 'required');
			if($this->input->post('pay_type') != 2  && $this->input->post('pay_type') != 3  ){
				$this->form_validation->set_rules('pay_head', 'pay_head', 'required');
				$this->form_validation->set_rules('pay_buget', 'pay_buget', 'required');
			}
		    $this->form_validation->set_rules('pay_month', 'pay_month', 'required');
		    $this->form_validation->set_rules('pay_year', 'pay_year', 'required');
		    $this->form_validation->set_rules('computer_bill_number', 'computer_bill_number', 'required');
		    $this->form_validation->set_rules('computer_bill_date', 'computer_bill_date', 'required');
		    $this->form_validation->set_rules('office_bill_number', 'office_bill_number', 'required');
		  
			$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
			
	        if ($this->form_validation->run($this) === TRUE)
	        {
				
				
				if(empty($edit_id)){
					
					/*$result_count = $this->payroll_model->check_pay_bill_exist();
					
					if($result_count > 0 && empty($edit_id) ){
							 $data['error_set'] = '<div class="text-danger">कृपया अन्य माह एवं वर्ष का चयन करें इस माह एवं वर्ष पर बिल नंबर चढ़ाया जा चुका है </div>'; 
							 $data['pay_cate'] = $this->payroll_model->salary_mastar();
							 $data['pay_emp'] = $this->payroll_model->salary_mastaremp();
							 // $data['module_name'] = "payroll";
							 // $data['view_file'] = "paybillno";
							 // $this->template->index($data);
					}else 
					{ */
						//die("esdfsdfsd ");
						$data['pay_cate'] = $this->payroll_model->pay_bill();
						$this->session->set_flashdata('message_success', '<u>रिकार्ड सफलता पूर्वक दर्ज किया गया|</u>');
						if(inputcheckvaul('pay_type') == 0 )
						{
							redirect("payroll/empcate/".$_POST['pay_head']."/".$_POST['pay_month']);
						}
						else if(inputcheckvaul('pay_type') == 2 || inputcheckvaul('pay_type') == 3  ){
							redirect("payroll/showsalaryexcase1/".$_POST['pay_month']);
						}
						else{
	
							redirect("payroll/getarrias/".$_POST['pay_head']."/".$_POST['pay_month']."/".$_POST['emp_uinq']);
						 }
					/*}*/
					 $data['pay_cate'] = $this->payroll_model->salary_mastar();
					 $data['pay_emp'] = $this->payroll_model->salary_mastaremp();
					 // $data['module_name'] = "payroll";
					 // $data['view_file'] = "paybillno";
					 // $this->template->index($data);
				}
				else
				{
					
					
					 	$responce = $this->payroll_model->edit_pay_bill11($edit_id);
						if($responce){
							$this->session->set_flashdata('message_success', '<u>रिकार्ड सफलतापूर्वक संशोधित किया गया |</u>');
							redirect("payroll/paybillno");
	                	}
	    				
				}
					
			}
		
        }
         if(!empty($edit_id)){
					$data['edit_id'] = $edit_id;
					$pay_bills = $this->payroll_model->bills($edit_id);
				 	$data['pay_bills'] = $pay_bills[0];
				 	
				 	
		 }
         $data['pay_cate'] = $this->payroll_model->salary_mastar();
	     $data['pay_emp'] = $this->payroll_model->salary_mastaremp();
		 $data['leave_approve_emp'] = $this->payroll_model->get_leave_approve_emp( );
		 $data['transfer_emp'] = $this->payroll_model->get_transfer_emp( );
		 $data['module_name'] = "payroll";
		 $data['view_file'] = "paybillno";
		 $this->template->index($data);
	}

    public function addallsallary()
    {
         $data['title'] = $this->lang->line('salary_mastar');
        $data['title_tab'] = $this->lang->line('salary_mastar');
    $data['msg'] = " "; 

      $data['pay_salary'] = $this->payroll_model->salary_mastar();
        $data['module_name'] = "payroll";
        $data['view_file'] = "payroll/addallsallary";
        $this->template->index($data);
    }
    function add_allsallary()
    { 
	if($this->uri->segment(3)  == 2 )
	{
	$currentmonth = "July"; 
    $current_year = date("Y");
    $isk=0;
	}else{
	$currentmonth = $_POST['pay_month']; 
    $current_year = $_POST['pay_year'];
    $isk=0;
	}

    # code...

  $data['pay_bill'] = $this->payroll_model->month_salary_cate($current_year,$currentmonth);


 $count = count($data['pay_bill']);

 //print_r( count($data['pay_bill']));die();
if($count == 0 )
{ 

  $data['pay_salary'] = $this->payroll_model->add_allsallary();
redirect("payroll/allcate");
}else{
   $this->session->set_flashdata('error', "salary for this month under this salary already added ");
                    redirect("payroll/addallsallary/");
}
   
    }
    function edit_salary()
    {

      $pay_id =$this->uri->segment("3");
      $emp_id =$this->uri->segment("4");
$data['pay_salary'] = $this->payroll_model->edit_salary($pay_id);

  $data['emp_details'] = $this->payroll_model->getemp($emp_id);
      
 foreach ($data['emp_details']as $key => $valueca) {
        $pay_cate_id =$valueca->emp_pay_cate_id;

      }
      $condi =  array("pay_cate_id"=>$pay_cate_id );
      $data['dataval'] = get_list("ft_pay_salary_category",'pay_cate_id',$condi);

  $data['title'] = $this->lang->line('salary_mastar');
        $data['title_tab'] = $this->lang->line('salary_mastar');
       $data['module_name'] = "payroll";
        $data['view_file'] = "payroll/edit_salary";
         $this->template->index($data);
    }
    public function edit_slary_emp()
    {
        $emp_id =$_POST['pay_salary_cate_id'];
        $month = $_POST['pay_month'];
      
     $this->payroll_model->edit_slary_emp();
     redirect("payroll/empcate/".$emp_id."/".$month);
    }

    public function payarriyars()
    {
        $data['title'] = $this->lang->line('pay_slip');
        $data['title_tab'] = $this->lang->line('pay_slip');
        $data['pay_cate'] = $this->payroll_model->salary_mastar();
        $data['module_name'] = "payroll";
        $data['view_file'] = "addarriyars";
        $this->template->index($data);

    }
    public function add_arriyasnotall()
   {
    //czs
$data['zeroarriays'] = $this->payroll_model->zeroarriays();

 $data['module_name'] = "payroll";
         $data['view_file'] = "add_arriyasnotall";
          $this->template->index($data);

   }
   public function add_arriyas()
   {

     $months = "";
      $date1= $_GET['pay_year']."-".date("m",strtotime($_GET['pay_month']))."-01";
     $date2= $_GET['pay_year_end']."-".date("m",strtotime($_GET['pay_month_end']))."-01";


    $output = [];
    $time   = strtotime($date1);
    $last   = date('F|Y', strtotime($date2));

 

    do {
        $month = date('F|Y', $time);
        $total = date('t', $time);

        $output[] = [
            'month' => $month,
            'total' => $total,
        ];

        $time = strtotime('+1 month', $time);
    } while ($month != $last);



            $pay_cate_id =$_GET['cate_id'];
   
      $condi =  array("pay_cate_id"=>$pay_cate_id );
      $data['dataval'] = get_list("ft_pay_salary_category",'pay_cate_id',$condi);
    //  $data['getemp'] = $this->payroll_model->get_salararriays();
	        $data['getemp'] = $this->payroll_model->getemparres( $pay_cate_id);
	  
        $data['totalmonth'] = count($output);
        $data["months"] = $output;
      

//$data['salary_mastar'] = $this->payroll_model->salary_mastar();
      

//print_r($data['getemp']);
         $data['module_name'] = "payroll";
         $data['view_file'] = "add_arriyas";
          $this->template->index($data);

   } 
   function getarrias_papper()
   {

  		  if(isset($_POST['gpf'])){
       $data['getemp'] = $this->payroll_model->epaymentgpf();
 

      }else{
      $data['getemp'] = $this->payroll_model->epaymentpp();
        }
  
  
      
      
		   redirect("payroll/getarrias_pp/".$_POST['cate_id']."/".date("F")."/".$_POST['pay_arriyas_type']);

	
   }
   function getarrias_pp()
   {
   
   
   $uri = $this->uri->segment(3);
        $m = $this->uri->segment(4);    
     $t = $this->uri->segment(5);  
       $condi =  array("pay_cate_id"=>$uri );
      $data['dataval'] = get_list("ft_pay_salary_category",'pay_cate_id',$condi);
    
   	        $data['getemp'] = $this->payroll_model->getarrias_papper($uri,$m);
	  
        
     $data['module_name'] = "payroll_model";
      if($t == 1 )
     {
        $data['view_file'] = "getarrias_papper";
    
      } else{
             $data['view_file'] = "getarrias_papper1";
          
      } 
          
        
     
          $this->template->index($data);
   }
   function updatepapaer()
   {$uri = $this->uri->segment(3);
    $data['getemp'] = $this->payroll_model->updatepapaer($uri);
		   redirect("payroll/getarrias_pp/".$uri);
   }function dpfslip(){

   $data['view_file'] = "dpfslip";
          $this->template->index($data);
   }
   function showdpfslip()
   {
$data['view_file'] = "showdpfslip";
          $this->template->index($data);
 
    
   }
   function add_arreyas_emp()
    {
     // print_r($_POST);


      $data['arriyas'] = $this->payroll_model->add_arriyas();
      redirect("payroll/showrigtser?uid=".$_POST['emp_unique_id']."&savenotice=1" ,"refresh");
    }
    function epayment()
    {

   
   
        $year = date("Y") ;
      $maonth = date("F") ;
     
     //s   $data['getemp'] = $this->payroll_model->epaymentgpf();
        

     $data['getemp'] = $this->payroll_model->epayment();
     
      //$data['pay_salary']= $this->payroll_model->getarrias();
      
        //$this->load->view("epayment" , $data);
    $maonth = date("F") ;
             redirect("payroll/getarrias/". $this->uri->segment(3)."/".$maonth);

    }
    function getarrias()
    {
      $cate_id = $this->uri->segment(3);
      $month = $this->uri->segment(4);
  $condi =  array("pay_cate_id"=>$cate_id );


      $data['dataval'] = get_list("ft_pay_salary_category",'pay_cate_id',$condi);

      $data['pay_salary']= $this->payroll_model->getarrias();
      
        $this->load->view("epayment" , $data);

    }

    public function emplist_current_month()
    { $data['title'] = "वेतन सूची संशोधन";
        $data['title_tab'] = "वेतन सूची संशोधन";
  $data['pay_salary'] = $this->payroll_model->salary_mastar();
        $data['module_name'] = "payroll";
        $data['view_file'] = "payroll/emplist";
      $this->template->index($data);
    }
    public function empcate_mofification()
    { $data['title'] = "वेतन सूची संशोधन";
        $data['title_tab'] = "वेतन सूची संशोधन";
      $emp_id = $this->uri->segment("3");
                   $emp_month = $this->uri->segment("4");

              $data['pay_salary_master'] = $this->payroll_model->pay_salary_master(); 
        $data['pay_salary'] = $this->payroll_model->salary_emp_mofification($emp_id,$emp_month);
         $data['cate_salary'] = $this->payroll_model->cate_salary($emp_id);
         $data['pay_bill'] = $this->payroll_model->pay_bill_cate($emp_id,$emp_month);
          $condi =  array("pay_cate_id"=>$emp_id );
          $data['dataval'] = get_list("ft_pay_salary_category",'pay_cate_id',$condi);
          $data['module_name'] = "payroll";
        $data['view_file'] = "payroll/emplist_modification";
        $this->template->index($data);

    }
    function allheads()
    {

      $data['title'] = $this->lang->line('salary_mastar');
        $data['title_tab'] = $this->lang->line('salary_mastar');
    
        $data['pay_salary'] = $this->payroll_model->salary_mastar();
        $data['module_name'] = "payroll";
        $data['view_file'] = "payroll/salary_mastar";
        $this->template->index($data);
    }
    function edithead()
    {$cateid = "pay_cate_id = ". $this->uri->segment(3);
          $data['title'] = $this->lang->line('salary_mastar');
        $data['title_tab'] = $this->lang->line('salary_mastar');
       $data['pay_salary'] = $this->payroll_model->edithead($cateid,"ft_pay_salary_category");
        $data['module_name'] = "payroll";
        $data['view_file'] = "payroll/edithead";
        $this->template->index($data);

    }
    function edit_head()
    {
      $this->payroll_model->edit_head();
      redirect("payroll/allheads");
    }
    function allfixstion(){

       $data['title'] = $this->lang->line('salary_mastar');
        $data['title_tab'] = $this->lang->line('salary_mastar');
    
        $data['pay_salary'] = $this->payroll_model->salary_fixstion();
        $data['module_name'] = "payroll";
        $data['view_file'] = "payroll/allfixstion";
        $this->template->index($data);
    }
    function addfixstion()
    {
       $data['title'] = $this->lang->line('salary_mastar');
        $data['title_tab'] = $this->lang->line('salary_mastar');
      $data['pay_cate'] = $this->payroll_model->salary_mastar();
     
        $data['module_name'] = "payroll";
        $data['view_file'] = "payroll/addfixstion";
        $this->template->index($data);
    }
    function add_fixstion()
    {
      $this->payroll_model->add_fixstion();
      redirect("payroll/allfixstion");
    }
    function editfixstion()
    {
      $cateid = "pf_id = ". $this->uri->segment(3);
       $data['title'] = $this->lang->line('salary_mastar');
        $data['title_tab'] = $this->lang->line('salary_mastar');
      $data['pay_cate'] = $this->payroll_model->salary_mastar();
     
      $data['pay_salary'] = $this->payroll_model->edithead($cateid,"ft_pay_fixation");
     
        $data['module_name'] = "payroll";
        $data['view_file'] = "payroll/editfixstion";
        $this->template->index($data);
    }
    function edit_fixstion()
    {
      $this->payroll_model->edit_fixstion();
      redirect("payroll/allfixstion");
    }
    function salaryfixation()
    {
       $data['title'] = $this->lang->line('salary_mastar');
        $data['title_tab'] = $this->lang->line('salary_mastar');
        $data['module_name'] = "payroll";
        $data['view_file'] = "payroll/salaryfixation";
        $this->template->index($data);

    }
    function showallsalary()
    {
        $data['title'] = $this->lang->line('salary_mastar');
        $data['title_tab'] = $this->lang->line('salary_mastar');
         $data['pay_salary'] = $this->payroll_model->allsalarymster();
        $data['module_name'] = "payroll";
        $data['view_file'] = "payroll/showallsalary";
        $this->template->index($data);
    }
    function showsalary()
    {
      $cateid = "pay_emp_unique_id = ".$_GET['uid'];

      $data['pay_salary'] = $this->payroll_model->edithead($cateid,"ft_pay_emp_salary");
    //  pre($data['pay_salary'] );
      $cate_id = "pf_cate_id  =".$data['pay_salary'][0]->pay_salary_cate_id;
      //echo "</br>".$cate_id."</br>";

          $data['emp_details'] = $this->payroll_model->getemp($_GET['uid']);
        $data['pay_fixation'] = $this->payroll_model->edithead($cate_id,"ft_pay_fixation");
         $condi =  array("pay_cate_id"=>$data['pay_salary'][0]->pay_salary_cate_id );
      $data['dataval'] = get_list("ft_pay_salary_category",'pay_cate_id',$condi);
        
        $data['module_name'] = "payroll";
        $data['view_file'] = "payroll/showsalary";
        $this->template->index($data);

    }
    function salarycal()
    {
        $cateid = $this->uri->segment(3);
        $pay_icr = $this->uri->segment(4);
     
      $picr_id = "pf_id =".$pay_icr;

        $empid = "pay_emp_unique_id = ".$cateid;
        $data['pay_salary'] = $this->payroll_model->edithead($empid,"ft_pay_emp_salary");
        $data['pay_fixation'] = $this->payroll_model->edithead($picr_id,"ft_pay_fixation");
         $data['salary_mastar'] = $this->payroll_model->salarymster($data['pay_salary'][0]->pay_salary_cate_id);
      
        if($data['pay_fixation'][0]->pf_type == 0)
        {
          $basic = ($data['pay_salary'][0]->pay_basic + $data['pay_salary'][0]->pay_grp );
          $par_val = "0.0".$data['pay_fixation'][0]->pf_parcentage_val;

         $newbasic = ( $par_val * $basic) + $data['pay_salary'][0]->pay_basic ;
         $da = ceil(($basic * $data['salary_mastar'][0]->salary_da) / 100) ;
         $nbasic = ceil($newbasic / 10) * 10;
         $data_salary =$nbasic."|".$da."|".$data['pay_fixation'][0]->pf_name;

       // $slary_value = json_encode($data_salary);
        print_r($data_salary);
        }else{
			if($data['pay_salary'][0]->pay_basic >= 58930)
			{
			 $basic =$data['pay_salary'][0]->pay_basic +1280;
			
			}elseif($data['pay_salary'][0]->pay_basic >= 67210){
			
			$basic =$data['pay_salary'][0]->pay_basic +1380;
			
			}elseif($data['pay_salary'][0]->pay_basic >= 70290){
			 $basic =$data['pay_salary'][0]->pay_basic +1540;
			}
			
			$nbasic = ceil($basic / 10) * 10;
			 $da = ceil(($basic * 119) / 100) ;
			  $data_salary =$nbasic."|".$da."|".$data['pay_fixation'][0]->pf_name;
			 print_r($data_salary);
		}
    }

    function edit_slary_emp1()
    {
       $emp_id =$_POST['pay_salary_cate_id'];
        $month = $_POST['pay_month'];
      
     $this->payroll_model->edit_slary_emp1();
     redirect("payroll/empcate/".$emp_id."/".$month);
    } function edit_slary_empbck()
    {
       $emp_id =$_POST['pay_salary_cate_id'];
        $month = $_POST['pay_month'];
      
     $this->payroll_model->edit_slary_empbck();
     
    }
function edit_slary_arreas()
    {
       $emp_id =$_POST['pay_salary_cate_id'];
        $month = $_POST['pay_month'];
      
     $this->payroll_model->edit_slary_arreas();
     redirect("payroll/getarrias/".$emp_id."/".$month);
    }

function edit_slary_emp12()
    {
       $emp_id =$_POST['pay_salary_cate_id'];
        $month = $_POST['pay_month'];
      
     $this->payroll_model->edit_slary_emp12();
   //  redirect("payroll/empcate/".$emp_id."/".$month);
    }
    function edit_salarymaster()
    {
     

       $empid = $_POST['pay_id'];

         $file_title =  $this->input->post('pay_emp_unique_id');

        $file_upload_new = scan_file_upload('file_upload','./uploads/paybill/order/'.$this->input->post('pay_emp_unique_id') . '/'.date('Y'),$file_title);

   
       $this->payroll_model->edit_salarymaster($file_upload_new );


     //  scan_file_upload();

       // $data['pay_salary'] = $this->payroll_model->edithead($empid,"ft_pay_emp_salary");

       redirect("payroll/addallsallary");

    }
   
    public function edit_emp_salary()
    {



      $emi = $this->payroll_model->getemp_emi($_POST['emp_unique_code']);
      if($_POST['emp_unique_code'] != "")
      {
           $data['emp_details'] = $this->payroll_model->getemp($_POST['emp_unique_code']);
            $ifemp = count($data['emp_details']);
            if($ifemp == 1)
            {
              if(isset($_POST['pay_define'])){
               $pay_define =$_POST['pay_define']; 
              }else{
               $pay_define=0;
              }
            if(isset($_POST['pay_madical'])){
               $madical =$_POST['pay_madical'];
              }else{
               $madical=0;
              }
              if(isset($_POST['pay_gradepay'])){
               $pay_gradepay =$_POST['pay_gradepay'];
              }else{
               $pay_gradepay=0;
              }
              if(isset($_POST['pay_special'])){
               $pay_special =$_POST['pay_special'];
              }else{
               $pay_special=0;
              }
              $pay_ca = "";
              if(isset($_POST['pay_ca'])){
               $pay_ca =$_POST['pay_ca'];
              }else{
               $pay_ca =0;
              }

               if(isset($_POST['pay_fuel_charge'])){
               $pay_fuel_charge =$_POST['pay_fuel_charge'];
              }else{
               $pay_fuel_charge=0;
              }
if(isset($_POST['pay_sa'])){
               $pay_sa =$_POST['pay_sa'];
              }else{
               $pay_sa=0;
              }
              if(isset($_POST['pay_gpf'])){
               $pay_gpf =$_POST['pay_gpf'];
              }else{
               $pay_gpf=0;
              }
               $data['adv'] = $this->payroll_model->advance();
               foreach ($data['adv']  as $key => $adv)

                {

                
              if(count($emi) == 0){
               
                if($_POST['starting_month_'.$adv->adv_id] != "")
                {

                  $p=$_POST['advance_amount_'.$adv->adv_id];
                  echo $p ."<br/>";
                    $r= $_POST['advance_inetrest_'.$adv->adv_id];
                    echo $r."<br/>";
                    $ti=$_POST['pay_income_tax_'.$adv->adv_id];   //yea$rly
                    $t=10;  
                   // $t=$t/$ti;
                    $si = ($p*$r*$t)/100;
                    echo "Simple Interest : ".$si;
      
                    $adv_date =date("Y-m-dd",strtotime($_POST['starting_month_'.$adv->adv_id]));
                $dataadv = $arrayName = array(
                  'pea_emp_unique_id' => $_POST['emp_unique_code'] ,
                 'pea_type_id' => $adv->adv_id,
                'pea_starting_month' => $adv_date,
                 'pea_intrest_rate' => $_POST['advance_inetrest_'.$adv->adv_id],
                 'pea_amount' => $_POST['advance_amount_'.$adv->adv_id],
                  'pae_interest' => $_POST['advance_inetrest_'.$adv->adv_id],
                   'pea_emi_amount' => $_POST['instalment_amount_'.$adv->adv_id],
                   'pea_emi'=> $_POST['pay_income_tax_'.$adv->adv_id],
                  
                  );// echo $_POST['starting_month_'.$adv->adv_id]."---fgdfg--"; die();
               // pre($dataadv ); 
                $dataemi = array(
                  'emi_emp_unique_id' => $_POST['emp_unique_code'] ,
                  'emi_pay_date' => date("Y-m-dd"),
                  'emi_no_installment' =>  $_POST['advnce_current_instsallment_number_'.$adv->adv_id],
                  'emi_amount' =>  $_POST['instalment_amount_'.$adv->adv_id],
                  );
                //insertData($dataadv , "ft_pay_emp_advance");
                 insertData($dataemi , "ft_pay_emi");
                echo $adv->adv_name_en ."|".$_POST['instalment_amount_'.$adv->adv_id];
                  $val_adv = $adv->adv_name_en ."|".$_POST['instalment_amount_'.$adv->adv_id] ;
                 $adv.$adv->adv_id = $_POST['instalment_amount_'.$adv->adv_id];
                 }else{

                    $adv.$adv->adv_id = 0;

                 }
                
             }else{
              $dataemi = array(
                  'emi_emp_unique_id' => $_POST['emp_unique_code'] ,
                  'emi_pay_date' => date("Y-m-dd"),
                  'emi_no_installment' =>  $_POST['advnce_current_instsallment_number_'.$adv->adv_id],
                  'emi_amount' =>  $_POST['instalment_amount_'.$adv->adv_id],
                  );
             // insertData($dataemi , "ft_pay_emi");
            $adv1 = $_POST['instalment_amount_'.$adv->adv_id];
             $adv2 = $_POST['instalment_amount_'.$adv->adv_id];
              $adv3 = $_POST['instalment_amount_'.$adv->adv_id];
               $adv4 = $_POST['instalment_amount_'.$adv->adv_id];
        }
      }
       
            //  $month = date("now")
           
        
            $currentmonth = date('F'); 
              $datapay = array(
                'pay_salary_cate_id' => $_POST['pay_salary_cate_id'],

                'pay_month' => $currentmonth ,
                'pay_year' => "2016" ,
                'pay_emp_unique_id' => $_POST['emp_unique_code'] ,
                'pay_basic' => $_POST['pay_basic'] ,
              'pay_grp' => $pay_gradepay ,
              'pay_da' => $_POST['pay_da'] ,
              'pay_special' => $pay_special ,
              'pay_hra' => $_POST['pay_hra'] ,
              'pay_sa' => $pay_sa ,
              'pay_madical' => $madical ,
              'pay_ca' => $pay_ca,
              'pay_sp' => $_POST['pay_sp'] ,
              'pay_others' => $_POST['pay_others'] ,
              'pay_total_sum' => $_POST['pay_total_sum'] ,
               'pay_gpf' => $pay_gpf ,
              'pay_gias' => $_POST['pay_gias'] ,
              'pay_defined_contribution' => $pay_define ,
              'pay_fuel_charge' => $pay_fuel_charge ,
              'pay_professional_tax' => $_POST['pay_professional_tax'] ,
              'pay_income_tax' => $_POST['pay_income_tax'] ,
              'pay_ca' => $_POST['pay_ca'] ,
              'pay_sp' => $_POST['pay_sp'] ,
              'pay_others' => $_POST['pay_others'] ,
              'pay_total_sum' => $_POST['pay_total_sum'] ,
               'pay_grain_adv' => $adv1 ,
              'pay_festival_adv' => $adv2,
               'pay_other_adv' => $adv3,
        'pay_id' => $_POST['id'] ,
               );
              

           //  insertData($datapay , "ft_pay_register");
            $this->payroll_model->update_salary($datapay);
//   redirect("payroll/addsalary");

    }
    }

    }
    function editda()
     {
        $data["da"] = $this->payroll_model->showda();
        $data["cate"]= $this->payroll_model->salary_cate(); 
          $data['module_name'] = "payroll";
        $data['view_file'] = "payroll/editda";
        $this->template->index($data);

     }
     function showda()
     {
       $pay_cate_id = $this->uri->segment(3);
       $data['dataval'] =$this->payroll_model->getcate_pp($pay_cate_id);
      $this->load->view("payroll/da" ,$data);

     }
     function update_da()
     {
       $data['dataval'] =$this->payroll_model->update_da();
      //  $this->load->view("payroll/da" ,$data);
       redirect("payroll/editda");
     }
     
     function payslipall()
     {$data['title'] = "वेतन पर्ची क्लास 4";
        $data['title_tab'] = "वेतन पर्ची क्लास 4";
       $data['module_name'] = "payroll";
        $data['view_file'] = "payroll/payslipall";
        $this->template->index($data);

     }
    function showallpayslip()
    {

         $data['title'] = "वेतन पर्ची क्लास 4";
           $data['payall'] =$this->payroll_model->showallpayslip();
           //pre( $data['payall']);
      $data['module_name'] = "payroll_model";

        //$data['view_file'] = "payroll/showallpayslip";
        $this->load->view("payroll/showallpayslip",$data);
      //  $this->template->index($data);
    }
    function checkmonthda()
    {

      
  
       $data['payall'] =$this->payroll_model->checkmonthda();
    }
    function autoincremrnt()
    {

      
  
       $data['payall'] =$this->payroll_model->autoincremrnt();

   $data['module_name'] = "payroll";
        $data['view_file'] = "payroll/autoincremrnt";
        $this->template->index($data);

    }
	function add_increment_monthall()
	{
	print_r($_POST);die();
	
	
	}
    function add_incrementmonth()
    {

      $data['payall'] =$this->payroll_model->emp_cate();
          $data['module_name'] = "payroll";
        $data['view_file'] = "payroll/add_incrementmonth";
        $this->template->index($data);
    }
    function add_month()
    {
      $id ="pay_id =".$this->uri->segment(3);
      $data['pay_salary'] = $this->payroll_model->edithead($id,"ft_pay_increment_month");
      $data['module_name'] = "payroll";
      $data['view_file'] = "payroll/add_month";
      $this->template->index($data);

    }
    function add_increment_month()
    {

      $data['pay_salary'] = $this->payroll_model->add_increment_month();
      $data['module_name'] = "payroll";
      $data['view_file'] = "payroll/add_month";

      redirect("payroll/add_incrementmonth");


    }
    function backdatesalary()
    {
      $data['title'] = $this->lang->line('emp_salary_details');

    //pre($data['pay_regi']);
    $data['module_name'] = "payroll";
         $data['view_file'] = "payroll/emp_salary_details";
         $this->template->index($data);
    }
    function incrment_month()
    {

      $data['pay_salary'] = $this->payroll_model->incrment_month();
        redirect("payroll/autoincremrnt");

    }
function emp_salary_master()
    {

      $this->payroll_model->emp_salary_master();
    }
    function permisstion()
    {

      $data['title'] = "";//$this->lang->line('emp_salary_details');

    //pre($data['pay_regi']);
    $data['module_name'] = "payroll";
         $data['view_file'] = "payroll/permisstion";
         $this->template->index($data);
    } 



    function master()
    {//echo "monika";
     $data['pay_salary']= $this->payroll_model->salary_mastar();
     $data['module_name'] = "payroll";
         $data['view_file'] = "payroll/dashboard";
         $this->template->index($data);
    }
    function showsalary_cate()
    {
      $emp_id = $this->uri->segment(3);
        $data['pay_salary']= $this->payroll_model->empsalary($emp_id);
         $data['cate_salary'] = $this->payroll_model->cate_salary($emp_id);
         $data['master_salary'] = $this->payroll_model->cate_salary_master($emp_id);
         $condi =  array("pay_cate_id"=>$emp_id );
      $data['dataval'] = get_list("ft_pay_salary_category",'pay_cate_id',$condi);
       
     $data['module_name'] = "payroll";
         $data['view_file'] = "payroll/showsalary_cate";
         $this->template->index($data);
    }
    function fromloadca()
    {
      $pay_cate_id = $this->uri->segment(3);
        $data['dataval'] =$this->payroll_model->getcate_pp($pay_cate_id);
      $this->load->view("fromloadca",$data);
    }
    function upadate_master()
    {
      pre($_POST);
    }
    function addempincate()
    {

          $data['pay_salary'] = $this->payroll_model->salary_mastar();
          $data['emp'] = $this->payroll_model->allemp();
           $data['module_name'] = "payroll";
         $data['view_file'] = "payroll/addempincate";
         $this->template->index($data);
    }
    function add_slary_head_cate()
    {
     
$data['pay_salary'] = $this->payroll_model->emp_update();
      redirect("payroll/addempincate");
    }
    function changeca()
    {
$data['pay_salary'] = $this->payroll_model->changeca();

    
      redirect("payroll/showsalary_cate/".$_POST['cateid']);

    }
    function changeda()
    {

    $data['pay_salary'] = $this->payroll_model->changeda();
    redirect("payroll/showsalary_cate/".$_POST['cateid']);

    }
      function changehra()
    {

    $data['pay_salary'] = $this->payroll_model->changehra();
    redirect("payroll/showsalary_cate/".$_POST['cateid']);

    }
function changema()
    {
     // print_r($_POST);

    $data['pay_salary'] = $this->payroll_model->changema();

   redirect("payroll/showsalary_cate/".$_POST['cateid']);

    }

    function changesa()
    {
     // print_r($_POST);

    $data['pay_salary'] = $this->payroll_model->changesa();

   redirect("payroll/showsalary_cate/".$_POST['cateid']);

    }

 function changegis()
    {
     // print_r($_POST);

    $data['pay_salary'] = $this->payroll_model->changegis();

   redirect("payroll/showsalary_cate/".$_POST['cateid']);

    }
     function changept()
    {
     // print_r($_POST);

    $data['pay_salary'] = $this->payroll_model->changept();

   redirect("payroll/showsalary_cate/".$_POST['cateid']);

    }

    function changefule()
    {
     // print_r($_POST);

    $data['pay_salary'] = $this->payroll_model->changefule();

   redirect("payroll/showsalary_cate/".$_POST['cateid']);

    }
     function changegpf()
    {
     // print_r($_POST);

    $data['pay_salary'] = $this->payroll_model->changegpf();

   redirect("payroll/showsalary_cate/".$_POST['cateid']);

    }
    function addsalryonmaster()
    {
       $data['pay_salary'] = $this->payroll_model->salary_mastar();
          $data['emp'] = $this->payroll_model->allemp();
		  
           $data['module_name'] = "payroll";
         $data['view_file'] = "payroll/addsalryonmaster";
         $this->template->index($data);  
    }
    function edit_slary_master()
    {
   
    $data['pay_salary'] = $this->payroll_model->edit_slary_master();
  redirect("payroll/master/");
    }
     function edit_slary_master1()
    {

    $data['pay_salary'] = $this->payroll_model->edit_slary_master1();
  redirect("payroll/showsalary_cate/".$_POST['pay_salary_cate_id']);
    }
    function alladvnce()
    {
      $data['pay_salary'] = $this->payroll_model->alladvnce();
          $data['emp'] = $this->payroll_model->allemp();
           $data['module_name'] = "payroll";
         $data['view_file'] = "payroll/alladvnce";
         $this->template->index($data); 
       }
       function add_employee_adv()
       {
          $data['alladv'] = $this->payroll_model->alladv();
           $data['pay_salary'] = $this->payroll_model->salary_mastar();
          $data['emp'] = $this->payroll_model->allemp();
           $data['module_name'] = "payroll";
         $data['view_file'] = "payroll/add_employee_adv";
         $this->template->index($data); 
       }
       function add_empadv(){

        print_r($_POST);
        $data['pay_salary'] = $this->payroll_model->add_empadv();
         redirect("payroll/alladvnce");

       }
       function report()
       {
   
            $emp_month = $this->uri->segment("3");
            $data['pay_salary'] = $this->payroll_model->salary_emp_report($emp_month);
			$this->load->view("report" , $data);

       }
       function payconsdiertime()
       {
            $data['alladv'] = $this->payroll_model->alladv();
            $data['pay_salary'] = $this->payroll_model->salary_mastar();
            $data['emp'] = $this->payroll_model->allemp();
            $data['module_name'] = "payroll";
            $data['view_file'] = "payroll/payconsdiertime";
            $this->template->index($data); 

       }
       function showsamayman()
       {
            $data['pay_salary'] = $this->payroll_model->showsamayman();
            $data['module_name'] = "payroll";
            $data['view_file'] = "payroll/showsamayman";
            $this->template->index($data); 

       }
       function add_samaymaan()
       {

            $data['pay_salary'] = $this->payroll_model->showsamayman();
            $data['module_name'] = "payroll";
			$data['view_file'] = "payroll/add_samaymaan";
            $this->template->index($data);
       }
       function addsamaymaan()
       {

         $file_title =  $this->input->post('pay_emp_unique_idpay_emp_unique_id');

        $file_upload_new = scan_file_upload('file_upload','./uploads/paybill/samyaman/'.$this->input->post('pay_emp_unique_id') . '/'.date('Y'),$file_title);
       
                $data['pay_salary'] = $this->payroll_model->addsamaymaan($file_upload_new);

                  redirect("payroll/showsamayman/?uid=".$_POST['pay_emp_unique_idpay_emp_unique_id']);
       }function addptremarks()
       {
      //  print_r($_POST);
          $data['pay_salary'] = $this->payroll_model->addptremarks();
        redirect("payroll/paydd_papar/pay_professional_tax/".$this->uri->segment(3)."/".$this->uri->segment(4));
       }

function addremarksindb()
{$id  = $this->uri->segment(3);
$data['pay_salary'] = $this->payroll_model->addremarksindb($id );

}////////////////////////slasy incrment 

function showempcate(){

  $data['title'] = $this->lang->line('salary_mastar');
        $data['title_tab'] = $this->lang->line('salary_mastar');
    
      $data['pay_salary'] = $this->payroll_model->salary_mastar();
        $data['module_name'] = "payroll";
        $data['view_file'] = "payroll/allcateemp";
        $this->template->index($data);
}
function empyearlyincement()
{
  $data['title'] = $this->lang->line('salary_mastar');
        $data['title_tab'] = $this->lang->line('salary_mastar');
    
      $data['pay_salary'] = $this->payroll_model->empyearlyincementdata();
        $data['module_name'] = "payroll";
        $data['view_file'] = "payroll/empyearlyincement";
        $this->template->index($data);

}
function empyearlyincementcer()
{
  $data['title'] = $this->lang->line('salary_mastar');
        $data['title_tab'] = $this->lang->line('salary_mastar');
    
      $data['pay_salary'] = $this->payroll_model->empyearlyincementdata();
        $data['module_name'] = "payroll";
        $data['view_file'] = "payroll/empyearlyincementcr";
        $this->template->index($data);

}
	function addremarksindbincr()
	{
	$id  = $this->uri->segment(3);
	 $data['pay_salary'] = $this->payroll_model->addremarksindbincr($id);
	
	}
		
		function salaryincr()
		{
		 $data['pay_salary'] = $this->payroll_model->salaryincr();
		 redirect("payroll/add_allsallary/2");
		}
	function addarreasentry()
	{
	//	echo $this->uri->segment(5);
		  $data['title'] = $this->lang->line('salary_mastar');
		        $data['title_tab'] = $this->lang->line('salary_mastar');
		     $data['currenthead'] = $this->payroll_model->currentpayhead();
		
			  $condi =  array("pay_cate_id"=>$data['currenthead'][0]->emp_pay_cate_id );
			
		$data['dataval'] =get_list("ft_pay_salary_category",'pay_cate_id',$condi);
		
		     // $data['pay_salary'] = $this->payroll_model->empyearlyincementdata();
		        $data['module_name'] = "payroll";
		        $data['view_file'] = "payroll/addarreasentry";
		        $this->template->index($data);
		
		
		}
	function edit_addarreasentry()
	{
		$data['title'] = $this->lang->line('salary_mastar');
		$data['title_tab'] = $this->lang->line('salary_mastar');
		$data['currenthead'] = $this->payroll_model->currentpayhead();
		$condi =  array("pay_cate_id"=>$data['currenthead'][0]->emp_pay_cate_id );
		$data['dataval'] =get_list("ft_pay_salary_category",'pay_cate_id',$condi);
		if($this->uri->segment(4) == "lpc"){
		$payid= $this->uri->segment(6); 
		}else{
		$payid= $this->uri->segment(5);
		}
		$data['payre'] =$this->payroll_model->get_pay($payid);
		$bid= $data['payre'][0]->pay_billno;
		$data['billno'] =$this->payroll_model->get_bill($bid);
	     $data['module_name'] = "payroll";
		$data['view_file'] = "payroll/addarreasentry_edit";
		$this->template->index($data);
	
	}
	function edit_pay_slary_register(){
	$data['pay_salary'] = $this->payroll_model->edit_pay_slary_register();
		 redirect("payroll/showrigtser?uid=".$this->input->post('uid')."&pay_year=2016-2017");
	
	}
	function pay_slary_register()
		{
		
		
		$data['pay_salary'] = $this->payroll_model->pay_slary_register();
		 redirect("payroll/showrigtser?uid=".$this->input->post('uid')."&pay_year=2016-2017");
		}
}