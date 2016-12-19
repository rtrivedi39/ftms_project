<?php 

class Payroll_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function getemp_emi($emp_id)
    {
      $currentyear = date("Y");
      $this->db->select('*');
      $this->db->from('ft_pay_emi');
      $this->db->select_max("emi_no_installment");
      $this->db->join('ft_pay_emp_advance', 'ft_pay_emp_advance.pea_emp_unique_id = ft_pay_emi.emi_emp_unique_id');
      $this->db->where("emi_emp_unique_id",$emp_id);
      // $this->db->where("pay_month",$pay_month);
      // $this->db->where("pay_year",$currentyear);
       $query = $this->db->get();
     //echo $this->db->last_query();
   return $rows = $query->result();
    }

    public function getpayroll() {
       // $this->db->select('*');
        $query = $this->db->query('SELECT * FROM  ft_employee where emp_order <> 0 ORDER BY emp_order  ASC ');
     
        return $query->result();
    }
      function getEmployeeLeave() {
        $employee_leave = ft_pay_register;
        $employee = EMPLOYEES;
        $this->db->select($employee . '.emp_id,emp_unique_id,emp_mobile_number,emp_full_name,emp_email,emp_mobile_number,emp_full_name_hi,role_id');
        $this->db->from($employee);
        $this->db->where('role_id !=', 1);
        $this->db->join($employee_leave, $employee_leave . '.pay_emp_id=' . $employee . '.emp_unique_id');
        $this->db->order_by("designation_id", "ASC");
		$this->db->order_by("emp_full_name_hi", "ASC");
		$query = $this->db->get();
        //$this->db->last_query();
        return $rows = $query->result();
    }
    function salary_cate()
    {
    	$query = $this->db->get("ft_pay_salary_category");
        //$this->db->last_query();
        return $rows = $query->result();
    }

    public function getcate($emp_id)
  {
      $this->db->select('*');
      $this->db->from('ft_employee');
  //  $this->db->join('ft_employee', 'ft_employee.emp_unique_id = ft_pay_register.pay_emp_unique_id');
     $this->db->join('ft_pay_salary_category', 'ft_employee.emp_pay_cate_id = ft_pay_salary_category.pay_cate_id');
    $this->db->where("emp_unique_id",$emp_id);
    $query = $this->db->get();
//echo $this->db->last_query();
    
        return $rows = $query->result();
  }
  public  function getpay($emp_id)
	{

    $pay_year = $_GET['pay_year'];
   $pay_year = explode("-", $pay_year);
    $year = "'".$pay_year[0]."','".$pay_year[1]."'";
    $query = $this->db->query("SELECT * FROM (`ft_pay_register`) JOIN `ft_employee` ON
     `ft_employee`.`emp_unique_id` = `ft_pay_register`.`pay_emp_unique_id` WHERE 
     `pay_emp_unique_id` = ".$emp_id." AND ft_pay_register.`pay_year_given` in (".$year.") ORDER BY `ft_pay_register`.`pay_month_order` ASC");
      $rowid = $query->result();

		 
//echo $this->db->last_query();
	   return $rowid;
	}

  public  function getpaymonth($emp_id,$pay_month)
  {
    $currentyear = date("Y");
      $this->db->select('*');
      $this->db->from('ft_pay_register');
    $this->db->join('ft_employee', 'ft_employee.emp_unique_id = ft_pay_register.pay_emp_unique_id');
    $this->db->where("pay_emp_unique_id",$emp_id);
    $this->db->where("pay_month",$pay_month);
    $this->db->where("pay_year",$currentyear);
    $query = $this->db->get();
//echo $this->db->last_query();
   return $rows = $query->result();
  }

public  function update_salary($data)
  {
     $this->db->where('pay_id', $data['pay_id']);
$this->db->update('ft_pay_register', $data); 
return true;
    
  }



  public function emp_bank($emp_id)
	{
		$this->db->select('*');
		  $this->db->from('ft_emp_service_record');

         $this->db->join('ft_employee', 'ft_employee.emp_unique_id = ft_emp_service_record.emp_uid');
         $this->db->join('ft_employee_details', 'ft_employee_details.uid = ft_emp_service_record.emp_uid');
		$this->db->where("emp_uid",$emp_id);
		$query = $this->db->get();
//echo $this->db->last_query();
		
        return $rows = $query->result();
	}

  public function getemp($emp_id)
	{
		$this->db->select('*');
		  $this->db->from('ft_employee');

      // $this->db->join('ft_employee', 'ft_employee.emp_unique_id = ft_emp_service_record.emp_uid');
		$this->db->where("emp_unique_id",$emp_id);

		$query = $this->db->get();
//echo $this->db->last_query();
		
        return $rows = $query->result();
	}  public function getemparres($emp_id)
	{
		$this->db->select('*');
		  $this->db->from('ft_employee');

      // $this->db->join('ft_employee', 'ft_employee.emp_unique_id = ft_emp_service_record.emp_uid');
		$this->db->where("emp_pay_cate_id",$emp_id);
		   $this->db->order_by("emp_order", "ASC"); 

		$query = $this->db->get();
//echo $this->db->last_query();
		
        return $rows = $query->result();
	}
  public function getpayroll_emp()
	{
		$this->db->select('*');
		  $this->db->from('ft_pay_emmp_bank');

    $this->db->join('ft_employee', 'ft_employee.emp_unique_id = ft_pay_emmp_bank.pay_emp_unique_id');
		$this->db->where("pay_emp_unique_id",$emp_id);
		$query = $this->db->get();
//echo $this->db->last_query();
		
        return $rows = $query->result();
	}

  public function salary_mastar()
    {

          $this->db->select('*');
          $this->db->from('ft_pay_salary_category');
          $this->db->where("pay_parent_id",0);
          $this->db->where("pay_cate_budget_no !=",'');
	   	  
          $query = $this->db->get();
		  //echo $this->db->last_query();
          return $rows = $query->result();
    }
    
 public function salary_emp($cate_id,$m)
    {
        $this->db->select('*');
        $this->db->from('ft_pay_register');
		//$this->db->join('ft_pay_bill_cate', 'ft_pay_bill_cate.pbill_cate_id = ft_pay_register.pay_salary_cate_id');
        $this->db->join('ft_employee', 'ft_employee.emp_unique_id = ft_pay_register.pay_emp_unique_id');
		$this->db->join('ft_emp_tr_uniquecode', 'ft_emp_tr_uniquecode.uniquecode = ft_pay_register.pay_emp_unique_id');
		$this->db->join('ft_employee_details', 'ft_employee_details.uid = ft_pay_register.pay_emp_unique_id');
		$this->db->join('ft_emprole_master', 'ft_employee.designation_id  = ft_emprole_master.role_id');
        $this->db->where("pay_salary_cate_id",$cate_id);
        $this->db->where("pay_month",$m);
        $this->db->where("pay_back_date",0);
        $this->db->where("pay_arriyas",0);
        $this->db->order_by("emp_order", "ASC"); 
        $query = $this->db->get();
		///echo $this->db->last_query();
        return $rows = $query->result();
    }
    function pay_diduction($cate_id,$m)
    {

       $this->db->select('*');
          $this->db->from('ft_pay_register');

       //  $this->db->join('ft_pay_bill_cate', 'ft_pay_bill_cate.pbill_cate_id = ft_pay_register.pay_salary_cate_id');
         $this->db->join('ft_employee', 'ft_employee.emp_unique_id = ft_pay_register.pay_emp_unique_id');
        $this->db->where("pay_salary_cate_id",$cate_id);
        $this->db->where("pay_month",$m);
       $this->db->where("pay_back_date",0);
	   $this->db->where("pay_arriyas",0);
	     $this->db->order_by("emp_order", "ASC"); 
        $query = $this->db->get();
// echo $this->db->last_query();
 return $rows = $query->result();
    }

    function pay_diduction_bck($m,$mm)
    {

        $this->db->select($m.",pay_id,pay_emp_unique_id,pay_total");
          $this->db->from('ft_pay_register');

       //  $this->db->join('ft_pay_bill_cate', 'ft_pay_bill_cate.pbill_cate_id = ft_pay_register.pay_salary_cate_id');
         $this->db->join('ft_employee', 'ft_employee.emp_unique_id = ft_pay_register.pay_emp_unique_id');
        $this->db->where("pay_back_date",1);
			   $this->db->where("pay_arriyas",0);
        $this->db->where("pay_month",$mm);
     $this->db->order_by("emp_order", "ASC"); 
        $query = $this->db->get();

 return $rows = $query->result();
    }
    
     function pay_diduction1($f1,$cate_id,$m)
    {

       $this->db->select('*');
          $this->db->from('ft_pay_register');

       //  $this->db->join('ft_pay_bill_cate', 'ft_pay_bill_cate.pbill_cate_id = ft_pay_register.pay_salary_cate_id');
         $this->db->join('ft_employee', 'ft_employee.emp_unique_id = ft_pay_register.pay_emp_unique_id');
        $this->db->where("pay_salary_cate_id",$cate_id);
        $this->db->where("pay_month",$m);
   $this->db->where("pay_back_date",0);
	   $this->db->where("pay_arriyas",0);
	     $this->db->order_by("emp_order", "ASC"); 
        $query = $this->db->get();
// echo $this->db->last_query();
 return $rows = $query->result();
    }
	function currentda($id)
	{
		 $query = $this->db->query("SELECT salary_da FROM `ft_pay_salary_master` where salary_cate_id=".$id);
		  $rowid = $query->result();
		return $rowid[0]->salary_da;
	}
     function pay_diduction12($f1,$cate_id,$m)
    {

       $this->db->select('*');
          $this->db->from('ft_pay_register');

       //  $this->db->join('ft_pay_bill_cate', 'ft_pay_bill_cate.pbill_cate_id = ft_pay_register.pay_salary_cate_id');
         $this->db->join('ft_employee', 'ft_employee.emp_unique_id = ft_pay_register.pay_emp_unique_id');
        $this->db->where("pay_salary_cate_id",$cate_id);
        $this->db->where("pay_month",$m);
           $this->db->where("pay_arriyas",1);
		   $this->db->where("pay_back_date",0);
	   $this->db->order_by("emp_order", "ASC"); 
        $query = $this->db->get();
//echo $this->db->last_query();
 return $rows = $query->result();
    }

   public function cate_salary($cate_id)
    {
          $this->db->select('*');
          $this->db->from('ft_pay_salary_category');
           $this->db->where("pay_cate_id",$cate_id);
          $query = $this->db->get();
            
        
        return $rows = $query->result();


    }
	public function emp_uid($emp_id)
	{
		     $this->db->select('*');
          $this->db->from('ft_employee');
		$this->db->like('emp_unique_id', $emp_id); 
		 $query = $this->db->get();
            
        
        return $rows = $query->result();
	}
	public function advance()
	{
		     $this->db->select('*');
          $this->db->from('ft_pay_advance_master');
		
		 $query = $this->db->get();
            
        
        return $rows = $query->result();
	}
  public function getempdetails($id = "")
  {
      $this->db->select('*');
          $this->db->from('ft_employee');
      if($id != ""){
       $this->db->where("emp_unique_id",$id);
      }
     $query = $this->db->get();
            
        
        return $rows = $query->result();

  }
  public function getempgpf($id = "")
  {
      $this->db->select('*');
          $this->db->from('ft_emp_service_record');
      if($id != ""){
       $this->db->where("emp_uid",$id);
      }
     $query = $this->db->get();
            
        
        return $rows = $query->result();

  }
public function house_type($id = "")
  {
      $this->db->select('*');
          $this->db->from('pay_house_rent_master');
      if($id != ""){
       $this->db->where("ph_id",$id);
      }
     $query = $this->db->get();
            
        
        return $rows = $query->result();

  }

  function pay_slip()
  {

    $this->db->select('*');
          $this->db->from('ft_pay_register');
           $this->db->join('ft_employee', 'ft_employee.emp_unique_id =  ft_pay_register.pay_emp_unique_id');
      $this->db->where("pay_year",$_POST['pay_year']);
       $this->db->where("pay_emp_unique_id",$_POST['uid']);
     $this->db->where("pay_month",$_POST['pay_month']);
     $query = $this->db->get();
            
        
        return $rows = $query->result();


  }
  function add_deatils()
  {

    
    $id =$_POST['emp_unique_id'];

    $data = array(
               'emp_house_no' => $_POST['emp_house_no'],
               'emp_house_type' =>  $_POST['emp_house_type'],
               'emp_pen_no' =>$_POST['emp_pen_no'],
               'emp_adhar_card_no' => $_POST['emp_adhar_card_no'],
               'emp_gpf_dpf_code' => $_POST['gpf_dpf_code'],

            );

$this->db->where('emp_unique_id', $id);
$this->db->update('ft_employee', $data); 
  }
function pay_bill()
{   
	
	$buget =0; $pt =0;$pts =0;
	  if($_POST['pay_type'] == 0) 
		{
		  	$query = $this->db->query("SELECT sum(pay_total_sum) as payts,sum(pay_total) pay_total FROM `ft_pay_register` where pay_arriyas=0 and pay_back_date=0 and pay_month ='".$_POST['pay_month']."' and  pay_year =".$_POST['pay_year']." AND pay_salary_cate_id ='".$_POST['pay_head']."'");
	  		$rowid = $query->result();

			  foreach ($rowid as $key => $value) {
						$pts = $value->payts;
				$pt =$value->pay_total;
				$head = $_POST['pay_head'];
				$buget = $_POST['pay_buget'];
				$common=0;
			  }
			 
		}
	elseif($_POST['pay_type'] == 2 ) 
		{
		  	$query = $this->db->query("SELECT sum(pay_total_sum) as payts,sum(pay_total) pay_total FROM `ft_pay_register` where  pay_month ='".$_POST['pay_month']."' and  pay_year =".$_POST['pay_year']." AND pay_emp_unique_id ='".$_POST['emp_uinque_id_leave']."' and pay_back_date = 1  ");
	  		$rowid = $query->result();

			  foreach ($rowid as $key => $value) {
						$pts = $value->payts;
				$pt =$value->pay_total;
				$head = 0 ;
				$buget = $_POST['pay_buget'];
				$common=0;
			  }
		
		}
		else if( $_POST['pay_type'] == 3 ){
		  	$query = $this->db->query("SELECT sum(pay_total_sum) as payts,sum(pay_total) pay_total FROM `ft_pay_register` where  pay_month ='".$_POST['pay_month']."' and  pay_year =".$_POST['pay_year']." AND pay_emp_unique_id ='".$_POST['emp_uinque_id_transfer']."' and  pay_back_date = 2 ");
	  		$rowid = $query->result();

			  foreach ($rowid as $key => $value) {
						$pts = $value->payts;
				$pt =$value->pay_total;
				$head = 0 ;
				$buget = $_POST['pay_buget'];
				$common=0;
			  }
		
		}
	else if( $_POST['pay_type'] == 4 ){
		//echo "SELECT pay_amount pay_total FROM `ft_pay_dpf_yearly_amount` where  pay_month ='".$_POST['pay_month']."' and  pay_year =".$_POST['pay_year']." AND pay_emp_unique_id ='".$_POST['emp_uinque_id_dpfgpf']."' and  pay_back_date = 2 "; 
			//die;
		  	$query = $this->db->query("SELECT pay_amount pay_total FROM `ft_pay_dpf_yearly_amount` where  pay_month ='".$_POST['pay_month']."' and  pay_years ='".$_POST['pay_year']."' AND pay_emp_unique_id ='".$_POST['emp_uinque_id_dpfgpf']."'  ");
	  		$row = $query->row_array();
			
		
				$pts = $row['pay_total'];
				$pt =  $row['pay_total'];
				$head = $_POST['dpf_gpf_subtype'];
				$buget = $_POST['pay_buget'];
				$common=0;
			
		
		}
	elseif($_POST['pay_type'] == 1 ){
		 	$query = $this->db->query("SELECT sum(pay_total_sum) as payts,sum(pay_total) pay_total FROM `ft_pay_register` where  pay_month ='".$_POST['pay_month']."' and  pay_year =".$_POST['pay_year']." AND pay_arriyas_type ='".$_POST['emp_uinq']."'  AND pay_arriyas = 1 and   pay_salary_cate_id ='".$_POST['pay_head']."'");
		  $rowid = $query->result();
		  foreach ($rowid as $key => $value) {
					$pts = $value->payts ;
			$pt =$value->pay_total;
			$common=1;
			$head = $_POST['pay_head'];
			$buget =$_POST['pay_buget'];
		  }
		}
		if($_POST['pay_type'] == 0 &&  $_POST['emp_uinq'] ){
			$emp_uinq = $_POST['emp_uinq'];

		}elseif($_POST['pay_type'] == 2 && $_POST['emp_uinque_id_leave'])
		{
			$emp_uinq = $_POST['emp_uinque_id_leave'];
			
		}elseif( $_POST['pay_type'] == 3 && $_POST['emp_uinque_id_transfer'])
		{
			$emp_uinq = $_POST['emp_uinque_id_transfer'];
		}
		else if( $_POST['pay_type'] == 4 && $_POST['emp_uinque_id_dpfgpf']){
			$emp_uinq = $_POST['emp_uinque_id_dpfgpf'];
		}
		
	   $data = array('pbill_month' => $_POST['pay_month'] ,
					'pbill_cate_id' =>  $head ,
					'pbill_bugetno' =>  $buget,
					'pbill_emp_code' =>	$emp_uinq ,
					'pbill_computer_date' =>date("Y-m-d",strtotime( $_POST['computer_bill_date'])) ,
					'pbill_type' => $_POST['pay_type'] ,
					'pbill_year' => date("Y") ,
					'pbill_gross_amount' =>$_POST['bill_grossamount'],
					'pbill_net_amont' =>$_POST['bill_netamount'],
					'pbill_computer_no' => $_POST['computer_bill_number'] ,
				  	'pbill_office_no' => $_POST['office_bill_number'] ,
				   	'pbill_vocher_no' => $_POST['vocher_bill_number'] ,
				  	'pbill_vocher_date' => date("Y-m-d",strtotime($_POST['vocher_bill_date'])) ,
				   );
	
   

                $this->db->insert("ft_pay_bill_cate" ,$data);

//echo $this->db->last_query();	die();

  $data2 = array(
       				'pay_billno' =>  $this->db->insert_id(),
               
               );
          $this->db->where("pay_salary_cate_id", $head);
		  $this->db->where("pay_month", $_POST['pay_month']);
		  $this->db->where("pay_year", $_POST['pay_year']);
		  $this->db->where("pay_back_date", 0);
		  $this->db->where("pay_arriyas", 0);
	
		  if($_POST['pay_type'] == 1) 
			{
		$this->db->where("pay_arriyas_type", $_POST['emp_uinq']);
			}     
      $this->db->update("ft_pay_register", $data2);

if($_POST['pay_type'] == 0) 
			{
 		$query1 = $this->db->query("SELECT * FROM `ft_pay_emp_salary` where  pay_salary_cate_id =".$_POST['pay_head']);
      	$rowid1 = $query1->result();
	  	  
        foreach ($rowid1 as $key => $pay) {
    
   
              $datapay = array(
                'pay_salary_cate_id' => $pay->pay_salary_cate_id,
                'pay_emp_unique_id' => $pay->pay_emp_unique_id ,
                'pay_basic' => $pay->pay_basic ,
				  'pay_grp' => $pay->pay_grp ,
				  'pay_da' =>  $pay->pay_da ,
				  'pay_special' =>$pay->pay_special ,
				  'pay_hra' =>$pay->pay_hra ,
				  'pay_sa' => $pay->pay_sa ,
				  'pay_madical' => $pay->pay_madical ,
				  'pay_ca' =>  $pay->pay_ca,
				  'pay_sp' =>  $pay->pay_sp,
				  'pay_others' =>  $pay->pay_others ,
               'pay_ca' => $pay->pay_ca,
              'pay_sp' => $pay->pay_sp ,
               'pay_total_sum' =>  $pay->pay_total_sum,
               'pay_dpf' =>  $pay->pay_dpf ,
                'pay_dpf_adv' =>  $pay->pay_dpf_adv,
               'pay_gpf' =>  $pay->pay_gpf ,
               'pay_gpf_adv' =>  $pay->pay_gpf_adv,
              'pay_gias' => $pay->pay_gias ,
              'pay_defined_contribution' => $pay->pay_defined_contribution ,
              'pay_fuel_charge' => $pay->pay_fuel_charge ,
              'pay_professional_tax' => $pay->pay_professional_tax ,
              'pay_income_tax' => $pay->pay_income_tax ,
               'pay_grain_adv' => $pay->pay_grain_adv ,
              'pay_festival_adv' => $pay->pay_festival_adv ,
               'pay_other_adv' => $pay->pay_other_adv,
              'pay_house_loan' => $pay->pay_house_loan,
              'pay_car_loan' => $pay->pay_car_loan,
              'pay_house_rent' => $pay->pay_house_rent,
              'pay_total_cut' => $pay->pay_total_cut,
               'pay_total' => $pay->pay_total,
                'created_by' => $pay->created_by,
                'pay_remark'=> "Salary add this" .$_POST['pay_month'],
               );
   
         
     $this->db->insert("ft_pay_log_emp_salary", $datapay);
 

      $querypay = $this->db->query("SELECT * FROM `ft_pay_register` where  pay_month ='".$_POST['pay_month']."' AND pay_salary_cate_id =".$_POST['pay_head']." and pay_arriyas = 0 and pay_back_date =0 and pay_emp_unique_id =".$pay->pay_emp_unique_id);
      $rowidpay = $querypay->result();
      foreach ($rowidpay as $key => $value) {

        # code...

          $datapay1 = array(
                'pay_salary_cate_id' => $value->pay_salary_cate_id,
                'pay_emp_unique_id' => $value->pay_emp_unique_id ,
                'pay_basic' => $value->pay_basic ,
              'pay_grp' => $value->pay_grp ,
              'pay_da' =>  $value->pay_da ,
              'pay_special' =>$value->pay_special ,
              'pay_hra' =>$value->pay_hra ,
              'pay_sa' => $value->pay_sa ,
              'pay_madical' => $value->pay_madical ,
              'pay_ca' =>  $value->pay_ca,
              'pay_sp' =>  $value->pay_sp,
              'pay_others' =>  $value->pay_others ,
               'pay_ca' => $value->pay_ca,
              'pay_sp' => $value->pay_sp ,
               'pay_total_sum' =>  $value->pay_total_sum,
               'pay_dpf' =>  $value->pay_dpf ,
                'pay_dpf_adv' =>  $value->pay_dpf_adv,
               'pay_gpf' =>  $value->pay_gpf ,
               'pay_gpf_adv' =>  $value->pay_gpf_adv,
              'pay_gias' => $value->pay_gias ,
              'pay_defined_contribution' => $value->pay_defined_contribution ,
              'pay_fuel_charge' => $value->pay_fuel_charge ,
              'pay_professional_tax' => $value->pay_professional_tax ,
              'pay_income_tax' => $value->pay_income_tax ,
               'pay_grain_adv' => $value->pay_grain_adv ,
              'pay_festival_adv' => $value->pay_festival_adv ,
               'pay_other_adv' => $value->pay_other_adv,
              'pay_house_loan' => $value->pay_house_loan,
              'pay_car_loan' => $value->pay_car_loan,
              'pay_house_rent' => $value->pay_house_rent,
              'pay_total_cut' => $value->pay_total_cut,
               'pay_total' => $value->pay_total,
                'created_by' => $value->created_by,
                'no_updated' =>  $pay->no_updated + 1,
                'pay_remark'=> "Salary add this" . " ".$_POST['pay_month'],
               );
          $this->db->where("pay_emp_unique_id", $value->pay_emp_unique_id);
      $this->db->update("ft_pay_emp_salary", $datapay1);
      }
	}

		}

                return "yes";
}
function pay_bill_all()
{
$this->db->select('*');
        $this->db->from('ft_pay_bill_cate');
        $this->db->where("pbill_month",$_POST['pay_month'] );
        $this->db->where("pbill_year",$_POST['pay_year'] );
        $this->db->where("pbill_cate_id",inputcheckvaul('pay_head'));
        $query = $this->db->get();
        $rows = $query->result();
        return $rows = $query->num_rows();


}

function salary_bill()
{
$this->db->select('*');
        $this->db->from('ft_pay_bill_cate');
         $this->db->where("pbill_month",$_POST['pay_month'] );
        $this->db->where("pbill_year",date("Y") );
        $this->db->where("pbill_cate_id",$_POST['pay_head']);
         $query = $this->db->get();
         $rows = $query->result();
         return $rows;
}

function pay_bill_cate($cate ,$m)
{
        $this->db->select('*');
        $this->db->from('ft_pay_bill_cate');
        $this->db->where("pbill_month",$m );
        $this->db->where("pbill_year",date("Y") );
        $this->db->where("pbill_cate_id",$cate);
        $query = $this->db->get();
        $rows = $query->result();
         //echo $this->db->last_query();
         return $rows;
}
function pay_bill_cate1($cate ,$m)
{
        $this->db->select('*');
        $this->db->from('ft_pay_bill_cate');
        $this->db->where("pbill_month",$m );
        $this->db->where("pbill_year",date("Y") );
        $this->db->where("pbill_cate_id",$cate);
         $this->db->where("pbill_type",0);
        $query = $this->db->get();
        $rows = $query->result();
         //echo $this->db->last_query();
         return $rows;
}

function salary_emp_mofification($emp_id,$emp_month){
//SELECT * FROM `ft_pay_register` Where `pay_emp_unique_id` = "171005898" and `pay_month` in ("March" , "April")
  $currentmoth = date("F");
  $query = $this->db->query('SELECT * FROM `ft_pay_register` JOIN ft_employee on ft_pay_register.pay_emp_unique_id = ft_employee.emp_unique_id where `pay_month` = "April"');
     
        return $query->result();
}

function pay_salary_master(){
//SELECT * FROM `ft_pay_register` Where `pay_emp_unique_id` = "171005898" and `pay_month` in ("March" , "April")
  $currentmoth = date("F");
  $query = $this->db->query('SELECT * FROM  ft_pay_emp_salary');
     
        return $query->result();
}
function add_arriyas()
{

  $year = date("Y") ;
      $maonth = date("F") ;

      if(isset($_POST['pay_gradepay'])){

        $pay_gradepay = $_POST['pay_gradepay'];

      }else{
    $pay_gradepay = 0;

      }
        if(isset($_POST['pay_gradepay'])){

        $pay_gradepay = $_POST['pay_gradepay'];

      }else{
    $pay_gradepay = 0;

      }
        if(isset($_POST['pay_ca'])){

        $pay_ca = $_POST['pay_ca'];

      }else{
    $pay_ca = 0;

      }
        if(isset($_POST['pay_da'])){

        $pay_da = $_POST['pay_da'];

      }else{
    $pay_da = 0;

      }

        if(isset($_POST['pay_hra'])){

        $pay_hra = $_POST['pay_hra'];

      }else{
    $pay_hra = 0;

      }


        if(isset($_POST['pay_sa'])){

        $pay_sa = $_POST['pay_sa'];

      }else{
    $pay_sa = 0;

      }

          if(isset($_POST['pay_madical'])){

        $pay_madical = $_POST['pay_madical'];

      }else{
    $pay_madical = 0;

      }


            if(isset($_POST['pay_special'])){

        $pay_special = $_POST['pay_special'];

      }else{
    $pay_special = 0;

      }
      if(isset($_POST['pay_sp'])){

        $pay_sp = $_POST['pay_sp'];

      }else{
    $pay_sp = 0;

      }
            if(isset($_POST['pay_others'])){

        $pay_others = $_POST['pay_others'];

      }else{
    $pay_others = 0;

      }
        $total = $pay_others  + $pay_gradepay +$pay_ca + $pay_da + $pay_hra + $pay_sa + $pay_sa + $pay_madical + $pay_special + $pay_sp ;
       $data = array(

        'pay_salary_cate_id' => $_POST['pay_salary_cate_id'],
        'pay_emp_unique_id' => $_POST['emp_unique_id'],
        'pay_month' => $maonth,
        'pay_year' =>$year,
        'pay_end_month' => $_POST['arriyas_end_month'],
        'pay_start_month' =>  $_POST['arriyas_start_month'],
		'pay_arriyas_year' =>  $_POST['arriyas_year'],
        'pay_grp' =>  $pay_gradepay,
        'pay_ca' => $pay_ca,
        'pay_da' => $pay_da,
         'pay_hra' => $pay_hra,
          'pay_sa' =>$pay_sa,
           'pay_madical' => $pay_madical, 
           'pay_special' =>$pay_special ,
       'pay_sp' => $pay_sp,
       'pay_arriyas' =>1,
       'pay_others' => $pay_others,
       'pay_total_sum' => $total,
       'pay_total' => $total
       );
          
      $this->db->insert('ft_pay_register', $data); 
      return true;
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

 $query = $this->db->query('SELECT * FROM `ft_pay_emp_salary` where pay_salary_cate_id != 13 ');
  $rowid = $query->result();
  //where  pay_emp_unique_id = 51010886
 // pre($rowid);

 
      foreach ($rowid  as $key => $pay) {

  $query12 = $this->db->query('SELECT * FROM `ft_pay_salary_master` where salary_da_apply_month = "'.$currentmonth.'"  and  salary_cate_id ="'.$pay->pay_salary_cate_id.'" and salary_da_apply_year="'.$current_year.'"');
  $rowid12 = $query12->result();

 $query = $this->db->query('SELECT * FROM `ft_pay_emi` join ft_pay_emp_advance on ft_pay_emp_advance.pea_emp_unique_id = ft_pay_emi.emi_emp_unique_id WHERE ft_pay_emp_advance.pea_type=0  and ft_pay_emp_advance.pea_emp_unique_id ='.$pay->pay_emp_unique_id.' ORDER BY `emi_id` DESC LIMIT 0,1  ');
  $rowid  = $query->result();
   $pay_grain_adv = $pay->pay_grain_adv;
   $pay_festival_adv = $pay->pay_festival_adv ;
  $pay_dpf_adv = $pay->pay_dpf_adv ;
   $pay_gpf_adv = $pay->pay_gpf_adv ;
if(count($rowid) != 0)
  {
  
    foreach ($rowid as $key => $rowid) {
  # code...
      if($rowid->emi_no_installment != $rowid->pea_emi)
      {
        $datapay1 = array(
                
                'emi_pay_date' => $currentmonth ,
                'emp_type_id' => $rowid->pea_type_id,
                'emi_pay_year' =>  $current_year,
                'emi_emp_unique_id' => $pay->pay_emp_unique_id ,
                'emi_amount' =>$rowid->emi_amount  ,
              'emi_no_installment' => $rowid->emi_no_installment + 1
     );
       // pre($datapay);
    //  die();
         
    $this->db->insert("ft_pay_emi", $datapay1);
     if($rowid->pea_type_id == 1){

      $pay_grain_adv = $rowid->emi_amount; 
        }
          if($rowid->pea_type_id == 3){

      $pay_festival_adv = $rowid->emi_amount ;
        }
		if($q->pea_type_id == 6){

      $pay_dpf_adv = $pay->pay_dpf_adv ;
        }
        if($q->pea_type_id == 5){

      $pay_gpf_adv = $pay->pay_gpf_adv ;
        }
   }
    }

  }else{
    $query21 = $this->db->query('SELECT * FROM  ft_pay_emp_advance WHERE ft_pay_emp_advance.pea_type =0  and ft_pay_emp_advance.pea_emp_unique_id ='.$pay->pay_emp_unique_id);
  $rowid21  = $query21->result();
    foreach ($rowid21 as $key => $q) {
  # code...

        $datapay1 = array(
                 'emi_pay_date' => $currentmonth ,
                 'emp_type_id' => $q->pea_type_id,
                'emi_pay_year' =>  $current_year ,
                'emi_emp_unique_id' => $pay->pay_emp_unique_id ,
                'emi_amount' => $q->pea_emi_amount ,
              'emi_no_installment' => 1
     );
        $this->db->insert("ft_pay_emi", $datapay1);
        if($q->pea_type_id == 1){

      $pay_grain_adv = $q->pea_emi_amount ;
        }
          if($q->pea_type_id == 3){

      $pay_festival_adv = $q->pea_emi_amount ;
        }
		if($q->pea_type_id == 6){

      $pay_dpf_adv = $pay->pay_dpf_adv ;
        }
        if($q->pea_type_id == 6){

      $pay_gpf_adv = $pay->pay_gpf_adv ;
        }
		
  }
}

    $da =  $pay->pay_da ;
    $ts =$pay->pay_basic + $pay->pay_grp + $da + $pay->pay_special + $pay->pay_hra +
       $pay->pay_sa + $pay->pay_madical +$pay->pay_others + $pay->pay_special+ $pay->pay_ca +  $pay->pay_sp;

       $tc =  $pay->pay_dpf + $pay_dpf_adv + $pay->pay_gpf + $pay_gpf_adv + $pay->pay_gias + $pay->pay_defined_contribution +
        $pay->pay_fuel_charge + $pay->pay_income_tax + $pay->pay_professional_tax + $pay->pay_fuel_charge + $pay_grain_adv  + $pay_festival_adv + $pay->pay_house_rent + $pay->pay_other_adv + $pay->pay_house_loan + $pay->pay_car_loan ; 

         $tt = $ts - $tc;


              $datapay = array(
                'pay_salary_cate_id' => $pay->pay_salary_cate_id,
                'pay_month' => $currentmonth,
                'pay_year' =>  $current_year  ,
                'pay_emp_unique_id' => $pay->pay_emp_unique_id ,
                'pay_basic' => $pay->pay_basic ,
              'pay_grp' => $pay->pay_grp ,
              'pay_da' => $pay->pay_da,
              'pay_special' =>$pay->pay_special ,
              'pay_hra' =>$pay->pay_hra ,
              'pay_sa' => $pay->pay_sa ,
              'pay_madical' => $pay->pay_madical ,
              'pay_ca' =>  $pay->pay_ca,
              'pay_sp' =>  $pay->pay_sp,
              'pay_others' =>  $pay->pay_others ,
               'pay_ca' => $pay->pay_ca,
              'pay_sp' => $pay->pay_sp ,
               'pay_total_sum' =>  $pay->pay_total_sum,
               'pay_dpf' =>  $pay->pay_dpf ,
                'pay_dpf_adv' =>  $pay_dpf_adv,
               'pay_gpf' =>  $pay->pay_gpf ,
               'pay_gpf_adv' =>  $pay_gpf_adv,
              'pay_gias' => $pay->pay_gias ,
              'pay_defined_contribution' => $pay->pay_defined_contribution ,
              'pay_fuel_charge' => $pay->pay_fuel_charge ,
              'pay_professional_tax' => $pay->pay_professional_tax ,
              'pay_income_tax' => $pay->pay_income_tax ,
               'pay_grain_adv' => $pay_grain_adv ,
              'pay_festival_adv' => $pay_festival_adv ,
               'pay_other_adv' => $pay->pay_other_adv,
              'pay_house_loan' => $pay->pay_house_loan,
              'pay_car_loan' => $pay->pay_car_loan,
              'pay_house_rent' => $pay->pay_house_rent,
              'pay_total_cut' => $pay->pay_total_cut,
               'pay_total' => $pay->pay_total,
			      'pay_month_given'=> date("F"),
				 'pay_month_order'=> date("m"),
				  'pay_year_given' =>date('Y'),
                'created_by' => $this->session->userdata('user_id'),
               );
			   
    $this->db->insert("ft_pay_register", $datapay);
   
  }

}
  function checkmonthda()
  {$year = date("Y");
        $currentmonth = date("F");

       $query = $this->db->query('SELECT * FROM `ft_pay_emp_salary` join ft_pay_salary_master on ft_pay_salary_master.salary_cate_id = ft_pay_emp_salary.pay_salary_cate_id where ft_pay_salary_master.salary_da_apply_month = "'.$currentmonth.'" and ft_pay_salary_master.salary_da_apply_year = "'.$year.'" ');
         $rowid = $query->result();
  
        
  
      foreach ($rowid  as $key => $pay) {
          # code...
            $nn = $pay->pay_basic + $pay->pay_grp;
            $da = ($nn *  $pay->salary_da)/100;

             $ts =$pay->pay_basic + $pay->pay_grp + $da + $pay->pay_special + $pay->pay_hra +
             $pay->pay_sa + $pay->pay_madical +$pay->pay_others + $pay->pay_special+ $pay->pay_ca +  $pay->pay_sp;

             $tc =  $pay->pay_dpf + $pay->pay_dpf_adv + $pay->pay_gpf + $pay->pay_gpf_adv + $pay->pay_gias + $pay->pay_defined_contribution + $pay->pay_fuel_charge + $pay->pay_income_tax+
             $pay->pay_professional_tax + $pay->pay_fuel_charge +$pay->pay_grain_adv  +$pay->pay_festival_adv + $pay->pay_house_rent + $pay->pay_other_adv + $pay->pay_house_loan + $pay->pay_car_loan ; 

               $tt = $ts - $tc;
   
              $datapay = array(
                'pay_salary_cate_id' => $pay->pay_salary_cate_id,
                'pay_emp_unique_id' => $pay->pay_emp_unique_id ,
                'pay_basic' => $pay->pay_basic ,
              'pay_grp' => $pay->pay_grp ,
              'pay_da' =>  $pay->pay_da ,
              'pay_special' =>$pay->pay_special ,
              'pay_hra' =>$pay->pay_hra ,
              'pay_sa' => $pay->pay_sa ,
              'pay_madical' => $pay->pay_madical ,
              'pay_ca' =>  $pay->pay_ca,
              'pay_sp' =>  $pay->pay_sp,
              'pay_others' =>  $pay->pay_others ,
               'pay_ca' => $pay->pay_ca,
              'pay_sp' => $pay->pay_sp ,
               'pay_total_sum' =>  $pay->pay_total_sum,
               'pay_dpf' =>  $pay->pay_dpf ,
                'pay_dpf_adv' =>  $pay->pay_dpf_adv,
               'pay_gpf' =>  $pay->pay_gpf ,
               'pay_gpf_adv' =>  $pay->pay_gpf_adv,
              'pay_gias' => $pay->pay_gias ,
              'pay_defined_contribution' => $pay->pay_defined_contribution ,
              'pay_fuel_charge' => $pay->pay_fuel_charge ,
              'pay_professional_tax' => $pay->pay_professional_tax ,
              'pay_income_tax' => $pay->pay_income_tax ,
               'pay_grain_adv' => $pay->pay_grain_adv ,
              'pay_festival_adv' => $pay->pay_festival_adv ,
               'pay_other_adv' => $pay->pay_other_adv,
              'pay_house_loan' => $pay->pay_house_loan,
              'pay_car_loan' => $pay->pay_car_loan,
              'pay_house_rent' => $pay->pay_house_rent,
              'pay_total_cut' => $pay->pay_total_cut,
               'pay_total' => $pay->pay_total_cut,
                'created_by' => $pay->created_by,
               );
   
         
     $this->db->insert("ft_pay_log_emp_salary", $datapay);

      $datanew = array(
              
               
              'pay_da' => round($da),
             'pay_total_sum' =>  round($ts),
              'pay_total_cut' => round($tc),
               'pay_total' => round($tt),
                'updated_by' =>  $this->session->userdata('user_id'),
                'updated_at'=> date("Y-m-d h:i:s"),
               'no_updated'=> $pay->no_updated +1,
               'pay_remark' => "DA Chnages"
               );
      pre($datanew);
 $this->db->where("pay_id", $pay->pay_id);
      $this->db->update("ft_pay_emp_salary", $datanew);

     
    }
}
 function edit_salary($id)
  {

  $query = $this->db->query('SELECT * FROM `ft_pay_register` where  pay_id ='.$id);
  $rowid = $query->result();
  return $rowid ;
  }

    function month_salary_cate($id,$maonth)
  {

  $query = $this->db->query("SELECT * FROM `ft_pay_register` where pay_arriyas =0 and pay_month ='".$maonth."' and pay_year =".$id);
  $rowid = $query->result();
  return $rowid ;
  }
  function edit_slary_emp()
  {
  if(isset($_POST['pay_gradepay'])){

        $pay_gradepay = $_POST['pay_gradepay'];

      }else{
    $pay_gradepay = 0;

      }
        if(isset($_POST['pay_ca'])){

        $pay_ca = $_POST['pay_ca'];

      }else{
    $pay_ca = 0;

      }
        if(isset($_POST['pay_da'])){

        $pay_da = $_POST['pay_da'];

      }else{
    $pay_da = 0;

      }

        if(isset($_POST['pay_hra'])){

        $pay_hra = $_POST['pay_hra'];

      }else{
    $pay_hra = 0;

      }


        if(isset($_POST['pay_sa'])){

        $pay_sa = $_POST['pay_sa'];

      }else{
    $pay_sa = 0;

      }

          if(isset($_POST['pay_madical'])){

        $pay_madical = $_POST['pay_madical'];

      }else{
    $pay_madical = 0;

      }


            if(isset($_POST['pay_special'])){

        $pay_special = $_POST['pay_special'];

      }else{
    $pay_special = 0;

      }
      if(isset($_POST['pay_sp'])){

        $pay_sp = $_POST['pay_sp'];

      }else{
    $pay_sp = 0;

      }
            if(isset($_POST['pay_others'])){

        $pay_others = $_POST['pay_others'];

      }else{
    $pay_others = 0;

      }
          if(isset($_POST['pay_dpf'])){

        $pay_dpf = $_POST['pay_dpf'];

      }else{
    $pay_dpf = 0;

      }

if(isset($_POST['pay_gpf'])){

        $pay_gpf = $_POST['pay_gpf'];

      }else{
    $pay_gpf = 0;

      }
       if(isset($_POST['pay_dpf_adv'])){

        $pay_dpf_adv = $_POST['pay_dpf_adv'];

      }else{
    $pay_dpf_adv = 0;

      }
if(isset($_POST['pay_gpf_adv'])){

        $pay_gpf_adv = $_POST['pay_gpf_adv'];

      }else{
    $pay_gpf_adv = 0;

      }


if(isset($_POST['pay_gias'])){

        $pay_gias = $_POST['pay_gias'];

      }else{
    $pay_gias = 0;

      }

if(isset($_POST['pay_define'])){

        $pay_define = $_POST['pay_define'];

      }else{
    $pay_define = 0;

      }

if(isset($_POST['pay_fuel_charge'])){

        $pay_fuel_charge = $_POST['pay_fuel_charge'];

      }else{
    $pay_fuel_charge = 0;

      }
if(isset($_POST['pay_professional_tax'])){

        $pay_professional_tax = $_POST['pay_professional_tax'];

      }else{
    $pay_professional_tax = 0;

      }

if(isset($_POST['pay_income_tax'])){

        $pay_income_tax = $_POST['pay_income_tax'];

      }else{
    $pay_income_tax = 0;

      }


if(isset($_POST['pay_other_adv'])){

        $pay_other_adv = $_POST['pay_other_adv'];

      }else{
    $pay_other_adv = 0;

      }

if(isset($_POST['pay_house_rent'])){

        $pay_house_rent = $_POST['pay_house_rent'];

      }else{
    $pay_house_rent = 0;

      }


 


        $datapay = array(
                'pay_salary_cate_id' => $_POST['pay_salary_cate_id'],
               'pay_basic' => $_POST['pay_basic'] ,
              'pay_grp' =>$pay_gradepay,
              'pay_da' => $pay_da,
              'pay_special' =>$pay_special ,
              'pay_hra' =>$pay_hra,
              'pay_sa' => $pay_sa,
              'pay_madical' =>$pay_madical,
              'pay_ca' =>  $pay_ca,
              'pay_sp' =>  $pay_sp,
              'pay_others' => $pay_others ,
               'pay_ca' => $pay_ca ,
              'pay_sp' => $pay_sp ,
               'pay_total_sum' =>  $_POST['pay_total_sum'],
               'pay_dpf' =>  $pay_dpf ,
                'pay_dpf_adv' => $pay_dpf_adv,
               'pay_gpf' =>  $pay_gpf ,
               'pay_gpf' => $pay_gpf_adv,
              'pay_gias' => $pay_gias ,
              'pay_defined_contribution' => $pay_define ,
              'pay_fuel_charge' => $pay_fuel_charge ,
              'pay_professional_tax' => $pay_professional_tax ,
              'pay_income_tax' =>$pay_income_tax ,
             //  'pay_grain_adv' => $_POST['pay_grain_adv'] ,
             // 'pay_festival_adv' =>$_POST['pay_festival_adv'] ,
               'pay_other_adv' => $pay_other_adv,
    //  'pay_house_loan' => $_POST['pay_house_loan'],
   //   'pay_car_loan' => $_POST['pay_car_loan'],
      'pay_house_rent' => $pay_house_rent,
      'pay_total_cut' => $_POST['pay_total_cut'],
       'pay_total' => $_POST['pay_total'],
        'updated_by' => $this->session->userdata('user_id'),
        'updated_at' =>date("Y-m-d H:i:s"),
        'no_updated'=>$_POST['no_updated']
               );
   $this->db->where("pay_id",$_POST['pay_id']);
      $this->db->update("ft_pay_register", $datapay);

   //   echo $this->db->last_query();

  }
  function edit_slary_emp1()
  {
 $query = $this->db->query("SELECT * FROM `ft_pay_register` join ft_pay_salary_master on ft_pay_salary_master.salary_cate_id=ft_pay_register.pay_salary_cate_id  where  pay_id=".$_POST['pay_id'] );
  $rowid = $query->result();
 
  if(isset($_POST['pay_gradepay'])){

        $pay_gradepay = $_POST['pay_gradepay'];

      }else{
    $pay_gradepay = 0;

      }
        if(isset($_POST['pay_ca'])){

        $pay_ca = $_POST['pay_ca'];

      }else{
    $pay_ca = 0;

      }
        if(isset($_POST['pay_da'])){

        $pay_da = $_POST['pay_da'];

      }else{
    $pay_da = 0;

      }

        if(isset($_POST['pay_hra'])){

        $pay_hra = $_POST['pay_hra'];

      }else{
    $pay_hra = 0;

      }


        if(isset($_POST['pay_sa'])){

        $pay_sa = $_POST['pay_sa'];

      }else{
    $pay_sa = 0;

      }

          if(isset($_POST['pay_madical'])){

        $pay_madical = $_POST['pay_madical'];

      }else{
    $pay_madical = 0;

      }


            if(isset($_POST['pay_special'])){

        $pay_special = $_POST['pay_special'];

      }else{
    $pay_special = 0;

      }
      if(isset($_POST['pay_sp'])){

        $pay_sp = $_POST['pay_sp'];

      }else{
    $pay_sp = 0;

      }
            if(isset($_POST['pay_others'])){

        $pay_others = $_POST['pay_others'];

      }else{
    $pay_others = 0;

      }
          if(isset($_POST['pay_dpf'])){

        $pay_dpf = $_POST['pay_dpf'];

      }else{
    $pay_dpf = 0;

      }

if(isset($_POST['pay_gpf'])){

        $pay_gpf = $_POST['pay_gpf'];

      }else{
    $pay_gpf = 0;

      }
       if(isset($_POST['pay_dpf_adv'])){

        $pay_dpf_adv = $_POST['pay_dpf_adv'];

      }else{
    $pay_dpf_adv = 0;

      }
if(isset($_POST['pay_gpf_adv'])){

        $pay_gpf_adv = $_POST['pay_gpf_adv'];

      }else{
    $pay_gpf_adv = 0;

      }


if(isset($_POST['pay_gias'])){

        $pay_gias = $_POST['pay_gias'];

      }else{
    $pay_gias = 0;

      }

if(isset($_POST['pay_define'])){

        $pay_define = $_POST['pay_define'];

      }else{
    $pay_define = 0;

      }

if(isset($_POST['pay_fuel_charge'])){

        $pay_fuel_charge = $_POST['pay_fuel_charge'];

      }else{
    $pay_fuel_charge = 0;

      }
if(isset($_POST['pay_professional_tax'])){

        $pay_professional_tax = $_POST['pay_professional_tax'];

      }else{
    $pay_professional_tax = 0;

      }

if(isset($_POST['pay_income_tax'])){

        $pay_income_tax = $_POST['pay_income_tax'];

      }else{
    $pay_income_tax = 0;

      }


if(isset($_POST['pay_other_adv'])){

        $pay_other_adv = $_POST['pay_other_adv'];

      }else{
    $pay_other_adv = 0;

      }

if(isset($_POST['pay_house_rent'])){

        $pay_house_rent = $_POST['pay_house_rent'];

      }else{
    $pay_house_rent = 0;

      }

 $dab = (inputcheckvaul('pay_basic') + inputcheckvaul('pay_grp'));


      $da  = round(($dab *  $rowid[0]->salary_da)/100);
	  
	  if(inputcheckvaul('pay_salary_cate_id') == 2)
		{
	
			$pay_define = round((($_POST['pay_basic'] + inputcheckvaul('pay_grp') + $da) * 10)/100) ;
			}else{
			$pay_define = $pay_define;
			}

      $ts = $_POST['pay_basic'] + inputcheckvaul('pay_grp') + $da + $pay_special + $pay_hra + $pay_sa + $pay_madical + $pay_others + $pay_ca +  $pay_sp;

       $tc =  $pay_dpf + $pay_dpf_adv + $pay_gpf + $pay_gpf_adv + $pay_gias + $pay_define  + $pay_income_tax + $pay_professional_tax + $pay_fuel_charge + inputcheckvaul('pay_grain_adv')  +inputcheckvaul('pay_festival_adv') + $pay_house_rent +        $pay_other_adv + inputcheckvaul('pay_house_loan') +inputcheckvaul('pay_car_loan') ; 

         $tt = $ts - $tc;

     //  echo $pay_dpf." +". $pay_dpf_adv ." +". $pay_gpf ." +".$pay_gpf_adv ." +".$pay_gias ." +".$pay_define ." +".$pay_fuel_charge ." +".$pay_income_tax." +".$pay_professional_tax ." +".$pay_fuel_charge." +".inputcheckvaul('pay_grain_adv') ." +".inputcheckvaul('pay_festival_adv') ." +". $pay_house_rent." +".      $pay_other_adv ." +".inputcheckvaul('pay_house_loan') ." +".inputcheckvaul('pay_car_loan');
        
       // echo $tt." ".$tc;
		 
     //   echo $_POST['pay_basic'] ." +".inputcheckvaul('pay_grp') ." +".$da." +".$pay_special ." +". $pay_hra ." +". $pay_sa ." +".$pay_madical ." +".$pay_others .." +".$pay_ca ." +". $pay_sp;

     // die();      

        $datapay = array(
                'pay_salary_cate_id' =>inputcheckvaul('pay_salary_cate_id'),
                'pay_remark'=> inputcheckvaul('pay_remark'),
               'pay_basic' => inputcheckvaul('pay_basic'),
              'pay_grp' =>inputcheckvaul('pay_grp'),
              'pay_da' => $da,
              'pay_special' =>$pay_special ,
              'pay_hra' =>$pay_hra,
              'pay_sa' => $pay_sa,
              'pay_madical' =>$pay_madical,
              'pay_special' =>  $pay_special,
              'pay_others' => $pay_others ,
               'pay_ca' => $pay_ca ,
              'pay_sp' => $pay_sp ,
               'pay_total_sum' =>  $ts,
               'pay_dpf' =>  $pay_dpf ,
                'pay_dpf_adv' => $pay_dpf_adv,
               'pay_gpf' =>  $pay_gpf ,
               'pay_gpf_adv' => $pay_gpf_adv,
              'pay_gias' => $pay_gias ,
              'pay_defined_contribution' => $pay_define ,
              'pay_fuel_charge' => $pay_fuel_charge ,
              'pay_professional_tax' => $pay_professional_tax ,
              'pay_income_tax' =>$pay_income_tax ,
               'pay_grain_adv' => inputcheckvaul('pay_grain_adv'),
              'pay_festival_adv' =>inputcheckvaul('pay_festival_adv') ,
               'pay_other_adv' => $pay_other_adv,
      'pay_house_loan' => inputcheckvaul('pay_house_loan') ,
     'pay_car_loan' =>inputcheckvaul('pay_car_loan') ,
      'pay_house_rent' => $pay_house_rent,
      'pay_total_cut' => $tc,
       'pay_total' => $tt,
        'updated_by' => $this->session->userdata('user_id'),
        'updated_at' =>date("Y-m-d H:i:s"),
        'no_updated'=>$_POST['no_updated']
               );
			   pre($datapay);
  $this->db->where("pay_id",$_POST['pay_id']);
     $this->db->update("ft_pay_register", $datapay);

    


  }

 function edit_slary_arreas()
  {
 $query = $this->db->query("SELECT * FROM `ft_pay_register` join ft_pay_salary_master on ft_pay_salary_master.salary_cate_id=ft_pay_register.pay_salary_cate_id  where  pay_id=".$_POST['pay_id'] );
  $rowid = $query->result();
 
  if(isset($_POST['pay_gradepay'])){

        $pay_gradepay = $_POST['pay_gradepay'];

      }else{
    $pay_gradepay = 0;

      }
        if(isset($_POST['pay_ca'])){

        $pay_ca = $_POST['pay_ca'];

      }else{
    $pay_ca = 0;

      }
        if(isset($_POST['pay_da'])){

        $pay_da = $_POST['pay_da'];

      }else{
    $pay_da = 0;

      }

        if(isset($_POST['pay_hra'])){

        $pay_hra = $_POST['pay_hra'];

      }else{
    $pay_hra = 0;

      }


        if(isset($_POST['pay_sa'])){

        $pay_sa = $_POST['pay_sa'];

      }else{
    $pay_sa = 0;

      }

          if(isset($_POST['pay_madical'])){

        $pay_madical = $_POST['pay_madical'];

      }else{
    $pay_madical = 0;

      }


            if(isset($_POST['pay_special'])){

        $pay_special = $_POST['pay_special'];

      }else{
    $pay_special = 0;

      }
      if(isset($_POST['pay_sp'])){

        $pay_sp = $_POST['pay_sp'];

      }else{
    $pay_sp = 0;

      }
            if(isset($_POST['pay_others'])){

        $pay_others = $_POST['pay_others'];

      }else{
    $pay_others = 0;

      }
          if(isset($_POST['pay_dpf'])){

        $pay_dpf = $_POST['pay_dpf'];

      }else{
    $pay_dpf = 0;

      }

if(isset($_POST['pay_gpf'])){

        $pay_gpf = $_POST['pay_gpf'];

      }else{
    $pay_gpf = 0;

      }
       if(isset($_POST['pay_dpf_adv'])){

        $pay_dpf_adv = $_POST['pay_dpf_adv'];

      }else{
    $pay_dpf_adv = 0;

      }
if(isset($_POST['pay_gpf_adv'])){

        $pay_gpf_adv = $_POST['pay_gpf_adv'];

      }else{
    $pay_gpf_adv = 0;

      }


if(isset($_POST['pay_gias'])){

        $pay_gias = $_POST['pay_gias'];

      }else{
    $pay_gias = 0;

      }

if(isset($_POST['pay_define'])){

        $pay_define = $_POST['pay_define'];

      }else{
    $pay_define = 0;

      }

if(isset($_POST['pay_fuel_charge'])){

        $pay_fuel_charge = $_POST['pay_fuel_charge'];

      }else{
    $pay_fuel_charge = 0;

      }
if(isset($_POST['pay_professional_tax'])){

        $pay_professional_tax = $_POST['pay_professional_tax'];

      }else{
    $pay_professional_tax = 0;

      }

if(isset($_POST['pay_income_tax'])){

        $pay_income_tax = $_POST['pay_income_tax'];

      }else{
    $pay_income_tax = 0;

      }


if(isset($_POST['pay_other_adv'])){

        $pay_other_adv = $_POST['pay_other_adv'];

      }else{
    $pay_other_adv = 0;

      }

if(isset($_POST['pay_house_rent'])){

        $pay_house_rent = $_POST['pay_house_rent'];

      }else{
    $pay_house_rent = 0;

      }

if(isset($_POST['pay_da'])){

         $da  =  $_POST['pay_da'];

      }else{
     $da  = 0;

      }


      $da  = 

      $ts = $_POST['pay_basic'] + inputcheckvaul('pay_grp') + $da + $pay_special + $pay_hra + $pay_sa + $pay_madical + $pay_others + $pay_ca +  $pay_sp;

       $tc =  $pay_dpf + $pay_dpf_adv + $pay_gpf + $pay_gpf_adv + $pay_gias + $pay_define  + $pay_income_tax + $pay_professional_tax + $pay_fuel_charge + inputcheckvaul('pay_grain_adv')  +inputcheckvaul('pay_festival_adv') + $pay_house_rent +        $pay_other_adv + inputcheckvaul('pay_house_loan') +inputcheckvaul('pay_car_loan') ; 

         $tt = $ts - $tc;

     //  echo $pay_dpf." +". $pay_dpf_adv ." +". $pay_gpf ." +".$pay_gpf_adv ." +".$pay_gias ." +".$pay_define ." +".$pay_fuel_charge ." +".$pay_income_tax." +".$pay_professional_tax ." +".$pay_fuel_charge." +".inputcheckvaul('pay_grain_adv') ." +".inputcheckvaul('pay_festival_adv') ." +". $pay_house_rent." +".      $pay_other_adv ." +".inputcheckvaul('pay_house_loan') ." +".inputcheckvaul('pay_car_loan');
        
       // echo $tt." ".$tc;
     
     //   echo $_POST['pay_basic'] ." +".inputcheckvaul('pay_grp') ." +".$da." +".$pay_special ." +". $pay_hra ." +". $pay_sa ." +".$pay_madical ." +".$pay_others .." +".$pay_ca ." +". $pay_sp;

     // die();      

        $datapay = array(
                'pay_salary_cate_id' =>inputcheckvaul('pay_salary_cate_id'),
                'pay_remark'=> inputcheckvaul('pay_remark'),
               'pay_basic' => inputcheckvaul('pay_basic'),
              'pay_grp' =>inputcheckvaul('pay_grp'),
              'pay_da' => $da,
              'pay_special' =>$pay_special ,
              'pay_hra' =>$pay_hra,
              'pay_sa' => $pay_sa,
              'pay_madical' =>$pay_madical,
              'pay_special' =>  $pay_special,
              'pay_others' => $pay_others ,
               'pay_ca' => $pay_ca ,
              'pay_sp' => $pay_sp ,
               'pay_total_sum' =>  $ts,
               'pay_dpf' =>  $pay_dpf ,
                'pay_dpf_adv' => $pay_dpf_adv,
               'pay_gpf' =>  $pay_gpf ,
               'pay_gpf_adv' => $pay_gpf_adv,
              'pay_gias' => $pay_gias ,
              'pay_defined_contribution' => $pay_define ,
              'pay_fuel_charge' => $pay_fuel_charge ,
              'pay_professional_tax' => $pay_professional_tax ,
              'pay_income_tax' =>$pay_income_tax ,
               'pay_grain_adv' => inputcheckvaul('pay_grain_adv'),
              'pay_festival_adv' =>inputcheckvaul('pay_festival_adv') ,
               'pay_other_adv' => $pay_other_adv,
      'pay_house_loan' => inputcheckvaul('pay_house_loan') ,
     'pay_car_loan' =>inputcheckvaul('pay_car_loan') ,
      'pay_house_rent' => $pay_house_rent,
      'pay_total_cut' => $tc,
       'pay_total' => $tt,
        'updated_by' => $this->session->userdata('user_id'),
        'updated_at' =>date("Y-m-d H:i:s"),
        'no_updated'=>$_POST['no_updated']
               );
    //     pre($datapay);
  $this->db->where("pay_id",$_POST['pay_id']);
     $this->db->update("ft_pay_register", $datapay);

    


  }

function edit_slary_empbck()
  {
 $query = $this->db->query("SELECT * FROM `ft_pay_register` join ft_pay_salary_master on ft_pay_salary_master.salary_cate_id=ft_pay_register.pay_salary_cate_id  where  pay_id=".$_POST['pay_id'] );
  $rowid = $query->result();
 
  if(isset($_POST['pay_gradepay'])){

        $pay_gradepay = $_POST['pay_gradepay'];

      }else{
    $pay_gradepay = 0;

      }
        if(isset($_POST['pay_ca'])){

        $pay_ca = $_POST['pay_ca'];

      }else{
    $pay_ca = 0;

      }
        if(isset($_POST['pay_da'])){

        $pay_da = $_POST['pay_da'];

      }else{
    $pay_da = 0;

      }

        if(isset($_POST['pay_hra'])){

        $pay_hra = $_POST['pay_hra'];

      }else{
    $pay_hra = 0;

      }


        if(isset($_POST['pay_sa'])){

        $pay_sa = $_POST['pay_sa'];

      }else{
    $pay_sa = 0;

      }

          if(isset($_POST['pay_madical'])){

        $pay_madical = $_POST['pay_madical'];

      }else{
    $pay_madical = 0;

      }


            if(isset($_POST['pay_special'])){

        $pay_special = $_POST['pay_special'];

      }else{
    $pay_special = 0;

      }
      if(isset($_POST['pay_sp'])){

        $pay_sp = $_POST['pay_sp'];

      }else{
    $pay_sp = 0;

      }
            if(isset($_POST['pay_others'])){

        $pay_others = $_POST['pay_others'];

      }else{
    $pay_others = 0;

      }
          if(isset($_POST['pay_dpf'])){

        $pay_dpf = $_POST['pay_dpf'];

      }else{
    $pay_dpf = 0;

      }

if(isset($_POST['pay_gpf'])){

        $pay_gpf = $_POST['pay_gpf'];

      }else{
    $pay_gpf = 0;

      }
       if(isset($_POST['pay_dpf_adv'])){

        $pay_dpf_adv = $_POST['pay_dpf_adv'];

      }else{
    $pay_dpf_adv = 0;

      }
if(isset($_POST['pay_gpf_adv'])){

        $pay_gpf_adv = $_POST['pay_gpf_adv'];

      }else{
    $pay_gpf_adv = 0;

      }


if(isset($_POST['pay_gias'])){

        $pay_gias = $_POST['pay_gias'];

      }else{
    $pay_gias = 0;

      }

if(isset($_POST['pay_define'])){

        $pay_define = $_POST['pay_define'];

      }else{
    $pay_define = 0;

      }

if(isset($_POST['pay_fuel_charge'])){

        $pay_fuel_charge = $_POST['pay_fuel_charge'];

      }else{
    $pay_fuel_charge = 0;

      }
if(isset($_POST['pay_professional_tax'])){

        $pay_professional_tax = $_POST['pay_professional_tax'];

      }else{
    $pay_professional_tax = 0;

      }

if(isset($_POST['pay_income_tax'])){

        $pay_income_tax = $_POST['pay_income_tax'];

      }else{
    $pay_income_tax = 0;

      }


if(isset($_POST['pay_other_adv'])){

        $pay_other_adv = $_POST['pay_other_adv'];

      }else{
    $pay_other_adv = 0;

      }

if(isset($_POST['pay_house_rent'])){

        $pay_house_rent = $_POST['pay_house_rent'];

      }else{
    $pay_house_rent = 0;

      }

 $dab = (inputcheckvaul('pay_basic') + inputcheckvaul('pay_grp'));


      $da  = $_POST['pay_da'];
	  
	  if(inputcheckvaul('pay_salary_cate_id') == 2)
		{
	
			$pay_define = round((($_POST['pay_basic'] + inputcheckvaul('pay_grp') + $da) * 10)/100) ;
			}else{
			$pay_define = $pay_define;
			}

      $ts = $_POST['pay_basic'] + inputcheckvaul('pay_grp') + $da + $pay_special + $pay_hra + $pay_sa + $pay_madical + $pay_others + $pay_ca +  $pay_sp;

       $tc =  $pay_dpf + $pay_dpf_adv + $pay_gpf + $pay_gpf_adv + $pay_gias + $pay_define  + $pay_income_tax + $pay_professional_tax + $pay_fuel_charge + inputcheckvaul('pay_grain_adv')  +inputcheckvaul('pay_festival_adv') + $pay_house_rent +        $pay_other_adv + inputcheckvaul('pay_house_loan') +inputcheckvaul('pay_car_loan') ; 

         $tt = $ts - $tc;

     //  echo $pay_dpf." +". $pay_dpf_adv ." +". $pay_gpf ." +".$pay_gpf_adv ." +".$pay_gias ." +".$pay_define ." +".$pay_fuel_charge ." +".$pay_income_tax." +".$pay_professional_tax ." +".$pay_fuel_charge." +".inputcheckvaul('pay_grain_adv') ." +".inputcheckvaul('pay_festival_adv') ." +". $pay_house_rent." +".      $pay_other_adv ." +".inputcheckvaul('pay_house_loan') ." +".inputcheckvaul('pay_car_loan');
        
       // echo $tt." ".$tc;
		 
     //   echo $_POST['pay_basic'] ." +".inputcheckvaul('pay_grp') ." +".$da." +".$pay_special ." +". $pay_hra ." +". $pay_sa ." +".$pay_madical ." +".$pay_others .." +".$pay_ca ." +". $pay_sp;

     // die();      

        $datapay = array(
                'pay_salary_cate_id' =>inputcheckvaul('pay_salary_cate_id'),
                'pay_remark'=> inputcheckvaul('pay_remark'),
               'pay_basic' => inputcheckvaul('pay_basic'),
              'pay_grp' =>inputcheckvaul('pay_grp'),
              'pay_da' => $da,
              'pay_special' =>$pay_special ,
              'pay_hra' =>$pay_hra,
              'pay_sa' => $pay_sa,
              'pay_madical' =>$pay_madical,
              'pay_special' =>  $pay_special,
              'pay_others' => $pay_others ,
               'pay_ca' => $pay_ca ,
              'pay_sp' => $pay_sp ,
               'pay_total_sum' =>  $ts,
               'pay_dpf' =>  $pay_dpf ,
                'pay_dpf_adv' => $pay_dpf_adv,
               'pay_gpf' =>  $pay_gpf ,
               'pay_gpf_adv' => $pay_gpf_adv,
              'pay_gias' => $pay_gias ,
              'pay_defined_contribution' => $pay_define ,
              'pay_fuel_charge' => $pay_fuel_charge ,
              'pay_professional_tax' => $pay_professional_tax ,
              'pay_income_tax' =>$pay_income_tax ,
               'pay_grain_adv' => inputcheckvaul('pay_grain_adv'),
              'pay_festival_adv' =>inputcheckvaul('pay_festival_adv') ,
               'pay_other_adv' => $pay_other_adv,
      'pay_house_loan' => inputcheckvaul('pay_house_loan') ,
     'pay_car_loan' =>inputcheckvaul('pay_car_loan') ,
      'pay_house_rent' => $pay_house_rent,
      'pay_total_cut' => $tc,
       'pay_total' => $tt,
        'updated_by' => $this->session->userdata('user_id'),
        'updated_at' =>date("Y-m-d H:i:s"),
        'no_updated'=>$_POST['no_updated']
               );
			   pre($datapay);
  $this->db->where("pay_id",$_POST['pay_id']);
     $this->db->update("ft_pay_register", $datapay);

    


  }


  function edit_slary_emp12()
  {

 
  if(isset($_POST['pay_gradepay'])){

        $pay_gradepay = $_POST['pay_gradepay'];

      }else{
    $pay_gradepay = 0;

      }
        if(isset($_POST['pay_ca'])){

        $pay_ca = $_POST['pay_ca'];

      }else{
    $pay_ca = 0;

      }
        if(isset($_POST['pay_da'])){

        $pay_da = $_POST['pay_da'];

      }else{
    $pay_da = 0;

      }

        if(isset($_POST['pay_hra'])){

        $pay_hra = $_POST['pay_hra'];

      }else{
    $pay_hra = 0;

      }


        if(isset($_POST['pay_sa'])){

        $pay_sa = $_POST['pay_sa'];

      }else{
    $pay_sa = 0;

      }

          if(isset($_POST['pay_madical'])){

        $pay_madical = $_POST['pay_madical'];

      }else{
    $pay_madical = 0;

      }


            if(isset($_POST['pay_special'])){

        $pay_special = $_POST['pay_special'];

      }else{
    $pay_special = 0;

      }
      if(isset($_POST['pay_sp'])){

        $pay_sp = $_POST['pay_sp'];

      }else{
    $pay_sp = 0;

      }
            if(isset($_POST['pay_others'])){

        $pay_others = $_POST['pay_others'];

      }else{
    $pay_others = 0;

      }
          if(isset($_POST['pay_dpf'])){

        $pay_dpf = $_POST['pay_dpf'];

      }else{
    $pay_dpf = 0;

      }

if(isset($_POST['pay_gpf'])){

        $pay_gpf = $_POST['pay_gpf'];

      }else{
    $pay_gpf = 0;

      }
       if(isset($_POST['pay_dpf_adv'])){

        $pay_dpf_adv = $_POST['pay_dpf_adv'];

      }else{
    $pay_dpf_adv = 0;

      }
if(isset($_POST['pay_gpf_adv'])){

        $pay_gpf_adv = $_POST['pay_gpf_adv'];

      }else{
    $pay_gpf_adv = 0;

      }


if(isset($_POST['pay_gias'])){

        $pay_gias = $_POST['pay_gias'];

      }else{
    $pay_gias = 0;

      }

if(isset($_POST['pay_define'])){

        $pay_define = $_POST['pay_define'];

      }else{
    $pay_define = 0;

      }

if(isset($_POST['pay_fuel_charge'])){

        $pay_fuel_charge = $_POST['pay_fuel_charge'];

      }else{
    $pay_fuel_charge = 0;

      }
if(isset($_POST['pay_professional_tax'])){

        $pay_professional_tax = $_POST['pay_professional_tax'];

      }else{
    $pay_professional_tax = 0;

      }

if(isset($_POST['pay_income_tax'])){

        $pay_income_tax = $_POST['pay_income_tax'];

      }else{
    $pay_income_tax = 0;

      }


if(isset($_POST['pay_other_adv'])){

        $pay_other_adv = $_POST['pay_other_adv'];

      }else{
    $pay_other_adv = 0;

      }

if(isset($_POST['pay_house_rent'])){

        $pay_house_rent = $_POST['pay_house_rent'];

      }else{
    $pay_house_rent = 0;

      }


$query1 = $this->db->query("SELECT * FROM `ft_pay_salary_master` where  salary_cate_id =".inputcheckvaul('pay_salary_cate_id'));
  $rowid = $query1->result();
     

      $ts = $_POST['pay_basic'] + inputcheckvaul('pay_grp') + inputcheckvaul('pay_da') + $pay_special + $pay_hra +
       $pay_sa + $pay_madical + $pay_others + $pay_special+ $pay_ca +  $pay_sp;

       $tc =  $pay_dpf + $pay_dpf_adv + $pay_gpf + $pay_gpf_adv + $pay_gias + $pay_define + $pay_fuel_charge + $pay_income_tax+
       $pay_professional_tax + $pay_fuel_charge +inputcheckvaul('pay_grain_adv')  +inputcheckvaul('pay_festival_adv') + $pay_house_rent +
         $pay_other_adv + inputcheckvaul('pay_house_loan') +inputcheckvaul('pay_car_loan') ; 

         $tt = $ts - $tc;

         $dab = (inputcheckvaul('pay_basic') + $pay_gradepay );
        
      //   $da  = ($dab *  $rowid[0]->salary_da)/100;
      //   echo $_POST['pay_id']."test";
        // die();

        $datapay = array(
                'pay_salary_cate_id' =>inputcheckvaul('pay_salary_cate_id'),
                'pay_remark'=> inputcheckvaul('remark'),
               'pay_basic' => inputcheckvaul('pay_basic'),
              'pay_grp' =>inputcheckvaul('pay_grp'),
              'pay_da' => inputcheckvaul('pay_da'),
              'pay_special' =>$pay_special ,
              'pay_hra' =>$pay_hra,
              'pay_sa' => $pay_sa,
              'pay_madical' =>$pay_madical,
              'pay_special' =>  $pay_special,
              'pay_others' => $pay_others ,
               'pay_ca' => $pay_ca ,
              'pay_sp' => $pay_sp ,
               'pay_total_sum' =>  $ts,
               'pay_dpf' =>  $pay_dpf ,
                'pay_dpf_adv' => $pay_dpf_adv,
               'pay_gpf' =>  $pay_gpf ,
               'pay_gpf' => $pay_gpf_adv,
              'pay_gias' => $pay_gias ,
              'pay_defined_contribution' => $pay_define ,
              'pay_fuel_charge' => $pay_fuel_charge ,
              'pay_professional_tax' => $pay_professional_tax ,
              'pay_income_tax' =>$pay_income_tax ,
               'pay_grain_adv' => inputcheckvaul('pay_grain_adv'),
              'pay_festival_adv' =>inputcheckvaul('pay_festival_adv') ,
               'pay_other_adv' => $pay_other_adv,
      'pay_house_loan' => inputcheckvaul('pay_house_loan') ,
     'pay_car_loan' =>inputcheckvaul('pay_car_loan') ,
      'pay_house_rent' => $pay_house_rent,
      'pay_total_cut' => $tc,
       'pay_total' => $tt,
        'updated_by' => $this->session->userdata('user_id'),
        'pay_back_date'>1,
        'updated_at' =>date("Y-m-d H:i:s"),
        'no_updated'=>$_POST['no_updated']
               );
   $this->db->where("pay_id",$_POST['pay_id']);
      $this->db->update("ft_pay_register", $datapay);

      $this->db->select('*');
          $this->db->from('ft_pay_register');
           $this->db->join('ft_employee', 'ft_employee.emp_unique_id =  ft_pay_register.pay_emp_unique_id');
   $this->db->where("pay_emp_unique_id",$empid);
    $this->db->where("pay_back_date",1);
   $query11 = $this->db->get();
            
    // echo $this->db->last_query();
     $rows11 = $query11->result();

  return $rows11;

    //  echo $this->db->last_query();

  }
function edithead($id,$tablename)
{


  $query = $this->db->query('SELECT * FROM `'.$tablename.'` where '.$id);
  $rowid = $query->result();
  return $rowid ;
}
function edit_head()
{
 
    $data =array('pay_cate_name'=> inputcheckvaul('pay_cate_name'), 
      'pay_cate_basic'=> inputcheckvaul('pay_cate_basic'), 
      'pay_cate_da'=>  inputcheckvaul('pay_cate_da'), 
      'pay_cate_special'=> inputcheckvaul('pay_cate_da'), 
      'pay_cate_sa'=> inputcheckvaul('pay_cate_sa'),
      'pay_cate_madical'=> inputcheckvaul('pay_cate_madical'),
      'pay_cate_grp'=> inputcheckvaul('pay_cate_grp'),
      'pay_cate_ca'=> inputcheckvaul('pay_cate_ca'),
      'pay_cate_hra'=> inputcheckvaul('pay_cate_hra'),
      'pay_cate_other_add'=> inputcheckvaul('pay_cate_other_add'),
      'pay_cate_special'=> inputcheckvaul('pay_cate_special'),
      'pay_cate_sp'=> inputcheckvaul('pay_cate_sp'),
      'pay_cate_dpf'=> inputcheckvaul('pay_cate_dpf'),
      'pay_cate_dpf_adv'=> inputcheckvaul('pay_cate_dpf_adv'),
      'pay_cate_gpf'=> inputcheckvaul('pay_cate_gpf'),
      'pay_cate_gpf_adv'=> inputcheckvaul('pay_cate_gpf_adv'),
      'pay_cate_defined_contribution'=> inputcheckvaul('pay_cate_defined_contribution'),
      'pay_cate_gias'=> inputcheckvaul('pay_cate_gias'),
      'pay_cate_house_loan'=> inputcheckvaul('pay_cate_house_loan'),
      'pay_cate_car_loan'=> inputcheckvaul('pay_cate_car_loan'),
      'pay_cate_house_rent'=> inputcheckvaul('pay_cate_house_rent'),
      'pay_cate_fuel_charge'=> inputcheckvaul('pay_cate_fuel_charge'),
      'pay_cate_garain_adv'=> inputcheckvaul('pay_cate_garain_adv'),
      'pay_cate_festival_adv'=> inputcheckvaul('pay_cate_festival_adv'),
      'pay_cate_professional_tax'=> inputcheckvaul('pay_cate_professional_tax'),
      'pay_cate_income_tax'=> inputcheckvaul('pay_cate_income_tax'),
       'pay_cate_other_adv'=> inputcheckvaul('pay_cate_other_adv'), 

              );
//print_r($data);die();
   $this->db->where("pay_cate_id",$_POST['pay_cate_id']);
      $this->db->update("ft_pay_salary_category", $data);
}

function salary_fixstion()
{


  $query = $this->db->query('SELECT * FROM `ft_pay_fixation` ');
  $rowid = $query->result();
  return $rowid ;
}
function add_fixstion()
{

  $data =array('pf_cate_id'=>$_POST['pf_cate_id'] ,
   'pf_name'=>$_POST['pf_name'] ,
    'pf_discription'=>$_POST['pf_discription'], 
    'pf_type'=>$_POST['pf_type'],
     'pf_parcentage_val'=>$_POST['pf_parcentage_val'],
     'pf_range'=>$_POST['pf_range'],
     'created_by'=>$this->session->userdata('user_id') );
  
  $this->db->insert("ft_pay_fixation", $data);
      return true ;

}
     
function edit_fixstion()
{

  $data =array('pf_cate_id'=>$_POST['pf_cate_id'] ,
   'pf_name'=>$_POST['pf_name'] ,
    'pf_discription'=>$_POST['pf_discription'], 
    'pf_type'=>$_POST['pf_type'],
     'pf_parcentage_val'=>$_POST['pf_parcentage_val'],
     'pf_range'=>$_POST['pf_range'],
     'created_by'=>$this->session->userdata('user_id') );
   
    $this->db->where("pf_id",$_POST['pf_id']);
      $this->db->update("ft_pay_fixation", $data);
 
      return true ;

}
  function salarymster($cate)
  {
     $query = $this->db->query('SELECT salary_da FROM `ft_pay_salary_master` where salary_cate_id ='.$cate);

  $rowid = $query->result();
  return $rowid ;
  }
   function allsalarymster()
  {
     $query = $this->db->query('SELECT * FROM `ft_pay_emp_salary` ');
  $rowid = $query->result();

  return $rowid ;
  }
  function edit_salarymaster($file)
  {

    $query = $this->db->query('SELECT * FROM `ft_pay_emp_salary` where pay_id ='.$_POST["pay_id"]);
    $rowid = $query->result();

    foreach ($rowid as $key => $value) {
      # code...

      $dataold =array('pay_id' => $_POST['pay_id'],
        'pay_salary_cate_id'=> $value->pay_salary_cate_id,
          'pay_emp_unique_id'=> $value->pay_emp_unique_id,
          'pay_basic'=> $value->pay_basic,
            'pay_grp'=> $value->pay_grp,
          'pay_ca'=> $value->pay_ca,
          'pay_da'=> $value->pay_da,
           'pay_hra'=> $value->pay_hra,
           'pay_sa'=> $value->pay_sa,
           'pay_madical'=> $value->pay_madical,
           'pay_special'=> $value->pay_special,
           'pay_sp'=> $value->pay_sp,
            'pay_total_sum'=> $value->pay_total_sum,
            'pay_dpf'=> $value->pay_dpf,
            'pay_dpf_adv'=> $value->pay_dpf_adv,
            'pay_gpf'=> $value->pay_gpf,
            'pay_gpf_adv'=> $value->pay_gpf_adv,
            'pay_gias'=> $value->pay_gias,
            'pay_house_loan'=> $value->pay_house_loan,
            'pay_car_loan'=> $value->pay_car_loan,
            'pay_fuel_charge'=> $value->pay_fuel_charge,
            'pay_grain_adv'=> $value->pay_grain_adv,
            'pay_festival_adv'=> $value->pay_festival_adv,
            'pay_professional_tax'=> $value->pay_professional_tax,
            'pay_income_tax'=> $value->pay_income_tax,
            'pay_other_adv'=> $value->pay_other_adv,
            'pay_total_cut'=> $value->pay_total_cut,
            'pay_total'=> $value->pay_total,
            'pay_remark'=> $value->pay_remark,
            'created_at'=> date("Y-m-d H:i:s"),
            'created_by'=> $this->session->userdata('user_id') ,
            'updated_by'=> $value->updated_by,
            'updated_at'=> $value->updated_at,
           'no_updated'=> $value->no_updated,
       );
       
         $this->db->insert("ft_pay_log_emp_salary", $dataold);


   $query1 = $this->db->query('SELECT * FROM `ft_pay_fixation` where pf_id ='.$_POST["pf_icr"]);
    $rowid1 = $query1->result();

     $query22 = $this->db->query('SELECT * FROM `ft_pay_salary_master` where salary_cate_id ='.$value->pay_salary_cate_id);
    $rowid12 = $query22->result();

  foreach ($rowid1 as $key => $value1) {
    # code...
    if($value1->pf_type == 0)
        {
          $basic = ($value->pay_basic + $value->pay_grp );
          $par_val = "0.0".$value1->pf_parcentage_val;

         $newbasic = ( $par_val * $basic) + $value->pay_basic ;
         $da = round(($basic * $rowid12[0]->salary_da) / 100) ;
         $nbasic = round($newbasic / 10) * 10;
        $total_sum =  $nbasic  + $value->pay_grp + $value->pay_ca+ $da+ $value->pay_hra+ $value->pay_sa+ $value->pay_madical+ $value->pay_special+ $value->pay_others+ $value->pay_sp;
        $total = $total_sum - $value->pay_total_cut;
        }else{
		if($value->pay_basic>= 58930)
			{
			 $basic =$value->pay_basic + 1280;
			}elseif($value->pay_basic >= 67210){
			$basic =$value->pay_basic + 1380;
			}elseif($value->pay_basic >= 70290){
			 $basic =$value->pay_basics + 1540;
			}
			
			$nbasic = round($basic / 10) * 10;
			 $da = round(($basic * $rowid12[0]->salary_da) / 100) ;
			  $data_salary =$nbasic."|".$da."|".$data['pay_fixation'][0]->pf_name;
			 $total_sum =  $nbasic  + $value->pay_grp + $value->pay_ca+ $da+ $value->pay_hra+ $value->pay_sa+ $value->pay_madical+ $value->pay_special+ $value->pay_others+ $value->pay_sp;
        $total = $total_sum - $value->pay_total_cut;
		}

        $datanew =array(
        
          'pay_basic'=> $nbasic ,
          'pay_da'=> $da,
           'pay_total_sum'=> $value->pay_total_sum,
            'pay_total'=> $value->pay_total,
            'pay_remark'=> $_POST['description'],
            'file_name'=> $file,
            'updated_by'=>  $this->session->userdata('user_id'),

            'updated_at'=> date("Y-m-d H:i:s"),
           'no_updated'=> $value->no_updated + 1,
       );
         $this->db->where("pay_id",$_POST['pay_id']);
      $this->db->update("ft_pay_emp_salary", $datanew);
  } 

  $datafixs =array(
        
          'pef_cate_id'=> $value->pay_salary_cate_id,
          'pef_emp_unique_id'=> $value->pay_emp_unique_id,
           'pef_remark'=> $_POST['description'],
            'pef_order_no'=> $_POST['order_no'],
            'pef_order_date'=> date("Y-m-d",strtotime($_POST['order_date'])),
            'pef_order_applicable_month'=> $_POST['pay_month'],
            'pef_order_applicable_date'=>date("Y-m-d",strtotime($_POST["order_date1"])),
           'created_by'=>  $this->session->userdata('user_id'),
       );
        $this->db->insert("ft_pay_emp_fixation", $datafixs);
    
    }

  }
  function autoincremrnt()
  {
    $currentmonth = date("F");

      $query = $this->db->query('SELECT * ,`ft_pay_emp_salary`.pay_id  pid FROM `ft_pay_emp_salary` join ft_employee on `ft_pay_emp_salary`.`pay_emp_unique_id` = ft_employee.emp_unique_id   join ft_pay_salary_master on ft_pay_salary_master.salary_cate_id = ft_pay_emp_salary.pay_salary_cate_id  join ft_pay_increment_month on `ft_pay_emp_salary`.`pay_emp_unique_id` = `ft_pay_increment_month`.`pay_emp_unique_id` where pay_month = "'.$currentmonth.'" ');    $rowid = $query->result();

 //echo $this->db->last_query();

     foreach ($rowid as $key => $value) {
      # code...
      if( $value->pay_incr_year != date("Y") )
      {
        $dataold =array('pay_id' => $value->pay_id,
        'pay_salary_cate_id'=> $value->pay_salary_cate_id,
          'pay_emp_unique_id'=> $value->pay_emp_unique_id,
          'pay_basic'=> $value->pay_basic,
          'pay_grp'=> $value->pay_grp,
          'pay_incr_year'=> $value->pay_incr_year,
          'pay_ca'=> $value->pay_ca,
          'pay_da'=> $value->pay_da,
           'pay_hra'=> $value->pay_hra,
           'pay_sa'=> $value->pay_sa,
           'pay_madical'=> $value->pay_madical,
           'pay_special'=> $value->pay_special,
           'pay_sp'=> $value->pay_sp,
            'pay_total_sum'=> $value->pay_total_sum,
            'pay_dpf'=> $value->pay_dpf,
            'pay_dpf_adv'=> $value->pay_dpf_adv,
            'pay_gpf'=> $value->pay_gpf,
            'pay_gpf_adv'=> $value->pay_gpf_adv,
            'pay_gias'=> $value->pay_gias,
            'pay_house_loan'=> $value->pay_house_loan,
            'pay_car_loan'=> $value->pay_car_loan,
            'pay_fuel_charge'=> $value->pay_fuel_charge,
            'pay_grain_adv'=> $value->pay_grain_adv,
            'pay_festival_adv'=> $value->pay_festival_adv,
            'pay_professional_tax'=> $value->pay_professional_tax,
            'pay_income_tax'=> $value->pay_income_tax,
            'pay_other_adv'=> $value->pay_other_adv,
            'pay_total_cut'=> $value->pay_total_cut,
            'pay_total'=> $value->pay_total,
            'pay_remark'=> $value->pay_remark,
            'created_at'=> date("Y-m-d H:i:s"),
            'created_by'=> $this->session->userdata('user_id') ,
            'updated_by'=> $value->updated_by,
            'updated_at'=> $value->updated_at,
           'no_updated'=> $value->no_updated,
       );
       
        // $this->db->insert("ft_pay_log_emp_salary", $dataold);


  
         if($value->pay_incr_type != 1)
         {
              $basic = ($value->pay_basic + $value->pay_grp );
              $par_val = "0.0".$value->pay_incr_amount ;
              $newbasic = ( $par_val * $basic) + $value->pay_basic ;
              $da = round(($basic * $value->salary_da) / 100) ;
               $nbasic = round($newbasic / 10) * 10;
               $total_sum =  $newbasic  + $value->pay_grp + $value->pay_ca+ $da+ $value->pay_hra+ $value->pay_sa+ $value->pay_madical+ $value->pay_special+ $value->pay_others+ $value->pay_sp;
               $total = $total_sum - $value->pay_total_cut;
       }else{


         $basic = $value->pay_basic +  $value->pay_incr_amount;
          
          $nbasic = round($basic / 10) * 10;
            $da = round(($basic * $value->salary_da) / 100) ;
          
          $total_sum =  $basic  + $value->pay_grp + $value->pay_ca+ $da+ $value->pay_hra+ $value->pay_sa+ $value->pay_madical+ $value->pay_special+ $value->pay_others+ $value->pay_sp;
           $total = $total_sum - $value->pay_total_cut;


       }

        $datanew =array(
          'pay_basic'=> $basic ,
          'pay_da'=> $da,
           'pay_total_sum'=> $total_sum,
            'pay_incr_year'=> date("Y"),
            'pay_total'=> $total,
            'pay_remark'=> "Yearly incrment",
            'updated_by'=>  $this->session->userdata('user_id'),
            'updated_at'=> date("Y-m-d H:i:s"),
           'no_updated'=> $value->no_updated + 1,
       );
    //  $this->db->where("pay_id",$value->pid);
    // $this->db->update("ft_pay_emp_salary", $datanew);
   } }
     return $rowid ;
  } 

   

  function salary_mastaremp()
  {
  			     $query = $this->db->query('SELECT * FROM `ft_pay_register` where pay_arriyas =1  GROUP by pay_arriyas_name ');
  $rowid = $query->result();
  return $rowid ;
  }
  function getcate_al($id)
  {
  			     $query = $this->db->query('SELECT pay_cate_budget_no FROM `ft_pay_salary_category` where pay_cate_id ='.$id);
  $rowid = $query->result();
  return $rowid ;
  }
  function showda()
  {
 $query = $this->db->query('SELECT * FROM `ft_pay_salary_master` ');
  $rowid = $query->result();
  return $rowid ;

  }
  function getcate_pp($id)
  {
             $query = $this->db->query('SELECT * FROM `ft_pay_salary_master` where salary_cate_id ='.$id);
  $rowid = $query->result();
  return $rowid ;
  }
  function update_da()
  { 

         $query = $this->db->query('SELECT * FROM `ft_pay_salary_master` where salary_id ='.$_POST['id']);
  $rowid = $query->result();

foreach ($rowid as $key => $value12) {
  # code...

     $datafixs =array(
        'salary_cate_id'=>$value12->salary_cate_id,
          'salary_da'=> $value12->salary_da,
         'created_by'=>  $value12->created_by, 
         'salary_id'=>  $value12->salary_id, 
         'salary_da_apply_month'=> $value12->salary_da_apply_month,
          'salary_da_apply_year'=> $value12->salary_da_apply_year,
       );
        $this->db->insert("ft_pay_log_salary_master", $datafixs);

         $data =array(
    
          'salary_da'=> $_POST['da'],
          'salary_da_apply_month'=> $_POST['pay_month'],
          'salary_da_apply_year'=> $_POST['pay_year'],
           'updated_by'=>$this->session->userdata('user_id'),
           'updated_at'=>date("y-m-d h:i:s"),
          'no_updated'=>$_POST["no_updated"],
         );
         $this->db->where("salary_id",$_POST['id']);
        $this->db->update("ft_pay_salary_master", $data);

 
    }
 
  
}

function showallpayslip()
{
   $this->db->select('*');
          $this->db->from('ft_pay_register');
           $this->db->join('ft_employee', 'ft_employee.emp_unique_id =  ft_pay_register.pay_emp_unique_id');
      $this->db->where("pay_year",$_POST['pay_year']);
       $this->db->where("pay_salary_cate_id",4);
     $this->db->where("pay_month",$_POST['pay_month']);
     $query = $this->db->get();
            
    // echo $this->db->last_query();
        
        return $rows = $query->result();


}function emp_cate()
{//SELECT * FROM `ft_pay_increment_month` join ft_employee on ft_employee.emp_unique_id = ft_pay_increment_month.`pay_emp_unique_id`

$this->db->select('*');
          $this->db->from('ft_pay_increment_month');
           $this->db->join('ft_employee', 'ft_employee.emp_unique_id =  ft_pay_increment_month.pay_emp_unique_id');
  //$this->db->where("pay_salary_cate_id",1);
  
     $query = $this->db->get();
            
        
   //  echo $this->db->last_query();

        return $rows = $query->result();

}
function add_increment_month()
{


 $data =array(
    'pay_incr_type'=> $_POST['pay_incr_type'],
    'pay_incr_amount'=> $_POST['pay_incr_amount'],
          'pay_month'=> $_POST['pay_month'],
           'updated_by'=>$this->session->userdata('user_id'),
           'updated_at'=> date("Y-m-d h:i:s"),
           
          'no_update'=>$_POST["no_update"],
         );
         $this->db->where("pay_id",$_POST['pay_id']);
        $this->db->update("ft_pay_increment_month", $data);



}function pay_salary_emp($id)
{


  $this->db->select('*');
          $this->db->from('ft_pay_emp_salary');
           $this->db->join('ft_employee', 'ft_employee.emp_unique_id =  ft_pay_emp_salary.pay_emp_unique_id');
      $this->db->where("pay_year",$_POST['pay_year']);
       $this->db->where("pay_emp_unique_id",$id);
     $this->db->where("pay_month",$_POST['pay_month']);

     $this->db->order_by("designation_id", "desc"); 
     $query = $this->db->get();
            
    // echo $this->db->last_query();
        
        return $rows = $query->result();
}
function getpaymonthmaster($empid)
{
    $date1 = $_GET['pay_year'].'-'.$_GET['pay_month'].'-01';
//    $date2 = $_GET['pay_year_end'].'-'.$_GET['pay_month_end'].'-01';

 
    //die();
    $this->db->select('*');
              $this->db->from('ft_pay_emp_salary');
       $this->db->where("pay_emp_unique_id",$empid);
       $query = $this->db->get();
                
        // echo $this->db->last_query();
         $rows = $query->result();





   // echo $nn[0]."monika ";
  //  echo "<br/>";

           $this->db->select('*');
              $this->db->from('ft_pay_register');
            $this->db->where("pay_month",$_GET['pay_month']);
            $this->db->where("pay_year",$_GET['pay_year']);   
          $this->db->where("pay_emp_unique_id",$empid);
           $query23 = $this->db->get();
                     
        // echo $this->db->last_query();
         $rows22 = $query23->result();

		if($rows22[0]->pay_basic == 0 ){

    foreach ($rows as $key => $pay) {


         //  $currentmonth = $_POST['pay_month']; 
              $datapay = array(
                'pay_salary_cate_id' => $pay->pay_salary_cate_id,
                'pay_month' => $_GET['pay_month'],
                'pay_year' =>   $_GET['pay_year'] ,
                'pay_emp_unique_id' => $pay->pay_emp_unique_id ,
                'pay_basic' => $pay->pay_basic ,
              'pay_grp' => $pay->pay_grp ,
              'pay_da' => $pay->pay_da,
              'pay_special' =>$pay->pay_special ,
              'pay_hra' =>$pay->pay_hra ,
              'pay_sa' => $pay->pay_sa ,
              'pay_madical' => $pay->pay_madical ,
              'pay_ca' =>  $pay->pay_ca,
              'pay_sp' =>  $pay->pay_sp,
              'pay_others' =>  $pay->pay_others ,
               'pay_ca' => $pay->pay_ca,
              'pay_sp' => $pay->pay_sp ,
               'pay_total_sum' =>  $pay->pay_total_sum,
               'pay_dpf' =>  $pay->pay_dpf ,
                'pay_dpf_adv' =>  $pay->pay_dpf_adv,
               'pay_gpf' =>  $pay->pay_gpf ,
               'pay_gpf_adv' =>  $pay->pay_gpf_adv,
              'pay_gias' => $pay->pay_gias ,
              'pay_defined_contribution' => $pay->pay_defined_contribution ,
              'pay_fuel_charge' => $pay->pay_fuel_charge ,
              'pay_professional_tax' => $pay->pay_professional_tax ,
              'pay_income_tax' => $pay->pay_income_tax ,
               'pay_grain_adv' => $pay->pay_grain_adv ,
              'pay_festival_adv' => $pay->pay_festival_adv ,
               'pay_other_adv' => $pay->pay_other_adv,
              'pay_house_loan' => $pay->pay_house_loan,
              'pay_car_loan' => $pay->pay_car_loan,
              'pay_house_rent' => $pay->pay_house_rent,
              'pay_total_cut' => $pay->pay_total_cut,
               'pay_total' => $pay->pay_total_cut,
               'pay_back_date' => $_GET["type"],
			   'pay_subject'=> $_GET["subjet"],
			    'pay_month_given'=> date("F"),
				 'pay_month_order'=> date("m"),
				  'pay_year_given' =>date('Y'),
                'created_by' => $this->session->userdata('user_id'),
               );

 
   $this->db->insert("ft_pay_register", $datapay);
  //   echo $this->db->last_query();
// die();
  }
}

$this->db->select('*');
          $this->db->from('ft_pay_register');
           $this->db->join('ft_employee', 'ft_employee.emp_unique_id =  ft_pay_register.pay_emp_unique_id');
   $this->db->where("pay_emp_unique_id",$empid);
    $this->db->where("pay_back_date",1);
   $query11 = $this->db->get();
            
    // echo $this->db->last_query();
     $rows11 = $query11->result();

  return $rows11;


}
function showsalaryexcase()
{
	$empid = $this->uri->segment(3);
$month = $this->uri->segment(4);
$query = $this->db->query("SELECT *  FROM `ft_pay_register` join ft_employee on ft_employee.emp_unique_id  = ft_pay_register.pay_emp_unique_id  WHERE `pay_emp_unique_id`= ".$empid." AND `pay_month_given` =  '".$month."' and pay_back_date =1 or pay_back_date= 2 ORDER BY `pay_id` DESC");
  $rowid = $query->result();//echo $this->db->las
echo $this->db->last_query();
  return $rowid;
}
function showsalaryexcase1()
{
	$empid = $this->uri->segment(3);
$month = $this->uri->segment(4);
$query = $this->db->query("SELECT *  FROM `ft_pay_register` join ft_employee on ft_employee.emp_unique_id  = ft_pay_register.pay_emp_unique_id  WHERE  `pay_month_given` =  '".$empid."' and pay_back_date =1 or pay_back_date= 2 ORDER BY `pay_id` DESC");
  $rowid = $query->result();//echo $this->db->las
//echo $this->db->last_query();
  return $rowid;
	
}
function incrment_month()
{
$data =array(
    'pay_basic'=> $_POST['pay_basic'],
         'no_updated'=>$_POST["no_update"],
		  'pay_remark'=>$_POST["pay_remark"],
         );
         $this->db->where("pay_id",$_POST['pay_id']);
        $this->db->update("ft_pay_emp_salary", $data);


}
function empsalary($empid)
{

$this->db->select('*');
          $this->db->from('ft_pay_emp_salary');
         //  $this->db->join('ft_employee', 'ft_employee.emp_pay_cate_id =  ft_pay_emp_salary.pay_salary_cate_id');
   $this->db->where("pay_salary_cate_id",$empid);

   $query11 = $this->db->get();
            
   // echo $this->db->last_query();
     $rows11 = $query11->result();

  return $rows11;

}
function allemp()
{
$this->db->select('*');
          $this->db->from('ft_employee');
		   $this->db->where("emp_is_retired",0);
		    $this->db->where("emp_status",1);
		
         //  $this->db->join('ft_employee', 'ft_employee.emp_pay_cate_id =  ft_pay_emp_salary.pay_salary_cate_id');
     $query11 = $this->db->get();  
   // echo $this->db->last_query();
     $rows11 = $query11->result();

  return $rows11;


}
function cate_salary_master($empid)
{
$this->db->select('*');
          $this->db->from('ft_pay_salary_master');
         //  $this->db->join('ft_employee', 'ft_employee.emp_pay_cate_id =  ft_pay_emp_salary.pay_salary_cate_id');
        $this->db->where("salary_cate_id",$empid);
     $query11 = $this->db->get();  
 
   // echo $this->db->last_query();
     $rows11 = $query11->result();

  return $rows11;


}

function emp_update()
{
$query = $this->db->query('SELECT * FROM `ft_pay_salary_category` where pay_cate_id ='.$_POST['cate_name']);
  $rowid = $query->result();//echo $this->db->last_quer

  foreach ($_POST['emp'] as $key => $value) {
    # code...
  
$data1 =array(
    'emp_pay_cate_id'=> $_POST['cate_name'],
                 );


       $this->db->where("emp_unique_id",$value);
     $this->db->update("ft_employee", $data1);
$data =array(
    'pay_salary_cate_id'=> $_POST['cate_name'],
                 );
       
  $this->db->where("pay_emp_unique_id",$value);
    $this->db->update("ft_pay_emp_salary", $data);

}
}

function changeca()
{
$query = $this->db->query('SELECT * FROM `ft_pay_salary_master` where salary_id ='.$_POST['salary_id']);
  $rowid = $query->result();//echo $this->db->last_quer
foreach ($rowid as $key => $value12) {
  # code...
  $datafixs =array(
        'salary_cate_id'=>$value12->salary_cate_id,
          'salary_ca'=> $value12->salary_ca,
         'created_by'=>  $value12->created_by, 
         'salary_id'=>  $value12->salary_id, 
         'salary_da_apply_month'=> $value12->salary_da_apply_month,
          'salary_da_apply_year'=> $value12->salary_da_apply_year,
       );
        $this->db->insert("ft_pay_log_salary_master", $datafixs);
}
         $data =array(
        'salary_ca'=>  $_POST['pay_ca'],
                     );


             $this->db->where("salary_cate_id",$_POST['cateid']);
            $this->db->update("ft_pay_salary_master", $data);  
            // print_r($data);
            // echo $this->db->last_query();
     
//die();

  if(isset($_POST['checkval']))
   {
  # code...
       $uid  = explode(",",$_POST['checkval']);
       
        foreach ($uid as $key => $value) {
      $query1 = $this->db->query('SELECT * FROM `ft_pay_emp_salary` where pay_emp_unique_id ='.$value);
        $rowid1 = $query1->result();//sprint_r($rowid1);die();
      foreach ($rowid1 as $key => $pay) {
        # code...
                     $datapay = array(
                                    'pay_salary_cate_id' => $pay->pay_salary_cate_id,
                                    'pay_emp_unique_id' => $pay->pay_emp_unique_id ,
                                    'pay_basic' => $pay->pay_basic ,
                                  'pay_grp' => $pay->pay_grp ,
                                  'pay_da' =>  $pay->pay_da ,
                                  'pay_special' =>$pay->pay_special ,
                                  'pay_hra' =>$pay->pay_hra ,
                                  'pay_sa' => $pay->pay_sa ,
                                  'pay_madical' => $pay->pay_madical ,
                                  'pay_ca' =>  $pay->pay_ca,
                                  'pay_sp' =>  $pay->pay_sp,
                                  'pay_others' =>  $pay->pay_others ,
                                   'pay_ca' => $pay->pay_ca,
                                  'pay_sp' => $pay->pay_sp ,
                                   'pay_total_sum' =>  $pay->pay_total_sum,
                                   'pay_dpf' =>  $pay->pay_dpf ,
                                    'pay_dpf_adv' =>  $pay->pay_dpf_adv,
                                   'pay_gpf' =>  $pay->pay_gpf ,
                                   'pay_gpf_adv' =>  $pay->pay_gpf_adv,
                                  'pay_gias' => $pay->pay_gias ,
                                  'pay_defined_contribution' => $pay->pay_defined_contribution ,
                                  'pay_fuel_charge' => $pay->pay_fuel_charge ,
                                  'pay_professional_tax' => $pay->pay_professional_tax ,
                                  'pay_income_tax' => $pay->pay_income_tax ,
                                   'pay_grain_adv' => $pay->pay_grain_adv ,
                                  'pay_festival_adv' => $pay->pay_festival_adv ,
                                   'pay_other_adv' => $pay->pay_other_adv,
                                  'pay_house_loan' => $pay->pay_house_loan,
                                  'pay_car_loan' => $pay->pay_car_loan,
                                  'pay_house_rent' => $pay->pay_house_rent,
                                  'pay_total_cut' => $pay->pay_total_cut,
                                   'pay_total' => $pay->pay_total_cut,
                                    'created_by' => $pay->created_by,
                                   );
                $this->db->insert("ft_pay_log_emp_salary", $datapay);


$ts =$pay->pay_basic + $pay->pay_grp + $pay->pay_da + $pay->pay_special + $pay->pay_hra +
             $pay->pay_sa + $pay->pay_madical +$pay->pay_others + $pay->pay_special+ $_POST['pay_ca'] +  $pay->pay_sp;

             $tc =  $pay->pay_dpf + $pay->pay_dpf_adv + $pay->pay_gpf + $pay->pay_gpf_adv + $pay->pay_gias + $pay->pay_defined_contribution + $pay->pay_fuel_charge + $pay->pay_income_tax+
             $pay->pay_professional_tax + $pay->pay_fuel_charge +$pay->pay_grain_adv  +$pay->pay_festival_adv + $pay->pay_house_rent + $pay->pay_other_adv + $pay->pay_house_loan + $pay->pay_car_loan ; 

               $tt = $ts - $tc;

                $data1 =array(
                   'pay_ca'=> $_POST['pay_ca'],
                   'pay_remark'=> "ca chnage",
                   'pay_total_sum' =>  round($ts),
              'pay_total_cut' => round($tc),
               'pay_total' => round($tt),
                'updated_by' =>  $this->session->userdata('user_id'),
                'updated_at'=> date("Y-m-d h:i:s"),
                   'no_updated'=> $pay->no_updated +1
                       );
              //  print_r($data1);
                $this->db->where("pay_emp_unique_id", $pay->pay_emp_unique_id);
              $this->db->update("ft_pay_emp_salary", $data1);# code..
           }
       }
    }

}

function changeda()
{
        $query = $this->db->query('SELECT * FROM `ft_pay_salary_master` where salary_id ='.$_POST['salary_id']);
          $rowid = $query->result();//echo $this->db->last_quer
        foreach ($rowid as $key => $value12) {
          # code...
          $datafixs =array(
                'salary_cate_id'=>$value12->salary_cate_id,
                  'salary_da'=> $value12->salary_da,
                 'created_by'=>  $value12->created_by, 
                 'salary_id'=>  $value12->salary_id, 
                 'salary_da_apply_month'=> $value12->salary_da_apply_month,
                  'salary_da_apply_year'=> $value12->salary_da_apply_year,
               );
                $this->db->insert("ft_pay_log_salary_master", $datafixs);
        }
         $data =array(
        'salary_da'=>  $_POST['pay_ca'],
                     );


             $this->db->where("salary_cate_id",$_POST['cateid']);
            $this->db->update("ft_pay_salary_master", $data);  
            
     
//die();

  if(isset($_POST['checkvalda']))
   {
  # code...
       $uid  = explode(",",$_POST['checkvalda']);
     
        foreach ($uid as $key => $value) {
      $query1 = $this->db->query('SELECT * FROM `ft_pay_emp_salary` where pay_emp_unique_id ='.$value);
        $rowid1 = $query1->result();
     
      foreach ($rowid1 as $key => $pay) {
        # code...
                     $datapay = array(
                                    'pay_salary_cate_id' => $pay->pay_salary_cate_id,
                                    'pay_emp_unique_id' => $pay->pay_emp_unique_id ,
                                    'pay_basic' => $pay->pay_basic ,
                                  'pay_grp' => $pay->pay_grp ,
                                  'pay_da' =>  $pay->pay_da ,
                                  'pay_special' =>$pay->pay_special ,
                                  'pay_hra' =>$pay->pay_hra ,
                                  'pay_sa' => $pay->pay_sa ,
                                  'pay_madical' => $pay->pay_madical ,
                                  'pay_ca' =>  $pay->pay_ca,
                                  'pay_sp' =>  $pay->pay_sp,
                                  'pay_others' =>  $pay->pay_others ,
                                   'pay_ca' => $pay->pay_ca,
                                  'pay_sp' => $pay->pay_sp ,
                                   'pay_total_sum' =>  $pay->pay_total_sum,
                                   'pay_dpf' =>  $pay->pay_dpf ,
                                    'pay_dpf_adv' =>  $pay->pay_dpf_adv,
                                   'pay_gpf' =>  $pay->pay_gpf ,
                                   'pay_gpf_adv' =>  $pay->pay_gpf_adv,
                                  'pay_gias' => $pay->pay_gias ,
                                  'pay_defined_contribution' => $pay->pay_defined_contribution ,
                                  'pay_fuel_charge' => $pay->pay_fuel_charge ,
                                  'pay_professional_tax' => $pay->pay_professional_tax ,
                                  'pay_income_tax' => $pay->pay_income_tax ,
                                   'pay_grain_adv' => $pay->pay_grain_adv ,
                                  'pay_festival_adv' => $pay->pay_festival_adv ,
                                   'pay_other_adv' => $pay->pay_other_adv,
                                  'pay_house_loan' => $pay->pay_house_loan,
                                  'pay_car_loan' => $pay->pay_car_loan,
                                  'pay_house_rent' => $pay->pay_house_rent,
                                  'pay_total_cut' => $pay->pay_total_cut,
                                   'pay_total' => $pay->pay_total_cut,
                                    'created_by' => $pay->created_by,
                                   );
                $this->db->insert("ft_pay_log_emp_salary", $datapay);

$nn = $pay->pay_basic + $pay->pay_grp;
            $da = ($nn *  $_POST['pay_ca'])/100;

             $ts =$pay->pay_basic + $pay->pay_grp + $da + $pay->pay_special + $pay->pay_hra +
             $pay->pay_sa + $pay->pay_madical +$pay->pay_others + $pay->pay_special+ $pay->pay_ca +  $pay->pay_sp;

             $tc =  $pay->pay_dpf + $pay->pay_dpf_adv + $pay->pay_gpf + $pay->pay_gpf_adv + $pay->pay_gias + $pay->pay_defined_contribution + $pay->pay_fuel_charge + $pay->pay_income_tax+
             $pay->pay_professional_tax + $pay->pay_fuel_charge +$pay->pay_grain_adv  +$pay->pay_festival_adv + $pay->pay_house_rent + $pay->pay_other_adv + $pay->pay_house_loan + $pay->pay_car_loan ; 

               $tt = $ts - $tc;
   
           

                $data1 =array(
                   'pay_da'=> $da,
                   'pay_remark'=> "da chnage",
                   'pay_total_sum' =>  round($ts),
              'pay_total_cut' => round($tc),
               'pay_total' => round($tt),
                'updated_by' =>  $this->session->userdata('user_id'),
                'updated_at'=> date("Y-m-d h:i:s"),
                   'no_updated'=> $pay->no_updated +1
                       );
                
                $this->db->where("pay_emp_unique_id", $pay->pay_emp_unique_id);
              $this->db->update("ft_pay_emp_salary", $data1);# code..
           }
       }
    }

}

function changehra()
{
        $query = $this->db->query('SELECT * FROM `ft_pay_salary_master` where salary_id ='.$_POST['salary_id']);
          $rowid = $query->result();//echo $this->db->last_quer
        foreach ($rowid as $key => $value12) {
          # code...
          $datafixs =array(
                'salary_cate_id'=>$value12->salary_cate_id,
                  'salary_hra'=> $value12->salary_hra,
                 'created_by'=>  $value12->created_by, 
                 'salary_id'=>  $value12->salary_id, 
                 'salary_da_apply_month'=> $value12->salary_da_apply_month,
                  'salary_da_apply_year'=> $value12->salary_da_apply_year,
               );
                $this->db->insert("ft_pay_log_salary_master", $datafixs);
        }
         $data =array(
        'salary_hra'=>  $_POST['pay_ca'],
                     );


             $this->db->where("salary_cate_id",$_POST['cateid']);
            $this->db->update("ft_pay_salary_master", $data);  
            
     
//die();

  if(isset($_POST['checkvalhra']))
   {
  # code...
       $uid  = explode(",",$_POST['checkvalhra']);
     
        foreach ($uid as $key => $value) {
      $query1 = $this->db->query('SELECT * FROM `ft_pay_emp_salary` where pay_emp_unique_id ='.$value);
        $rowid1 = $query1->result();
     
      foreach ($rowid1 as $key => $pay) {
        # code...
                     $datapay = array(
                                    'pay_salary_cate_id' => $pay->pay_salary_cate_id,
                                    'pay_emp_unique_id' => $pay->pay_emp_unique_id ,
                                    'pay_basic' => $pay->pay_basic ,
                                  'pay_grp' => $pay->pay_grp ,
                                  'pay_da' =>  $pay->pay_da ,
                                  'pay_special' =>$pay->pay_special ,
                                  'pay_hra' =>$pay->pay_hra ,
                                  'pay_sa' => $pay->pay_sa ,
                                  'pay_madical' => $pay->pay_madical ,
                                  'pay_ca' =>  $pay->pay_ca,
                                  'pay_sp' =>  $pay->pay_sp,
                                  'pay_others' =>  $pay->pay_others ,
                                   'pay_ca' => $pay->pay_ca,
                                  'pay_sp' => $pay->pay_sp ,
                                   'pay_total_sum' =>  $pay->pay_total_sum,
                                   'pay_dpf' =>  $pay->pay_dpf ,
                                    'pay_dpf_adv' =>  $pay->pay_dpf_adv,
                                   'pay_gpf' =>  $pay->pay_gpf ,
                                   'pay_gpf_adv' =>  $pay->pay_gpf_adv,
                                  'pay_gias' => $pay->pay_gias ,
                                  'pay_defined_contribution' => $pay->pay_defined_contribution ,
                                  'pay_fuel_charge' => $pay->pay_fuel_charge ,
                                  'pay_professional_tax' => $pay->pay_professional_tax ,
                                  'pay_income_tax' => $pay->pay_income_tax ,
                                   'pay_grain_adv' => $pay->pay_grain_adv ,
                                  'pay_festival_adv' => $pay->pay_festival_adv ,
                                   'pay_other_adv' => $pay->pay_other_adv,
                                  'pay_house_loan' => $pay->pay_house_loan,
                                  'pay_car_loan' => $pay->pay_car_loan,
                                  'pay_house_rent' => $pay->pay_house_rent,
                                  'pay_total_cut' => $pay->pay_total_cut,
                                   'pay_total' => $pay->pay_total_cut,
                                    'created_by' => $pay->created_by,
                                   );
                $this->db->insert("ft_pay_log_emp_salary", $datapay);

$nn = $pay->pay_basic + $pay->pay_grp;
            $da = ($nn *  $_POST['pay_ca'])/100;

             $ts =$pay->pay_basic + $pay->pay_grp + $pay->pay_da + $pay->pay_special + $da +
             $pay->pay_sa + $pay->pay_madical +$pay->pay_others + $pay->pay_special+ $pay->pay_ca +  $pay->pay_sp;

             $tc =  $pay->pay_dpf + $pay->pay_dpf_adv + $pay->pay_gpf + $pay->pay_gpf_adv + $pay->pay_gias + $pay->pay_defined_contribution + $pay->pay_fuel_charge + $pay->pay_income_tax+
             $pay->pay_professional_tax + $pay->pay_fuel_charge +$pay->pay_grain_adv  +$pay->pay_festival_adv + $pay->pay_house_rent + $pay->pay_other_adv + $pay->pay_house_loan + $pay->pay_car_loan ; 

               $tt = $ts - $tc;
   
           

                $data1 =array(
                   'pay_hra'=> $da,
                   'pay_remark'=> "hra chnage",
                   'pay_total_sum' =>  round($ts),
              'pay_total_cut' => round($tc),
               'pay_total' => round($tt),
                'updated_by' =>  $this->session->userdata('user_id'),
                'updated_at'=> date("Y-m-d h:i:s"),
                   'no_updated'=> $pay->no_updated +1
                       );
                
                $this->db->where("pay_emp_unique_id", $pay->pay_emp_unique_id);
              $this->db->update("ft_pay_emp_salary", $data1);# code..
           }
       }
    }

}
function changema()
{

  $query = $this->db->query('SELECT * FROM `ft_pay_salary_master` where salary_id ='.$_POST['salary_id']);
  $rowid = $query->result();//echo $this->db->last_quer
foreach ($rowid as $key => $value12) {
  # code...
  $datafixs =array(
        'salary_cate_id'=>$value12->salary_cate_id,
          'salary_madical'=> $value12->salary_madical,
         'created_by'=>  $value12->created_by, 
         'salary_id'=>  $value12->salary_id, 
         'salary_da_apply_month'=> $value12->salary_da_apply_month,
          'salary_da_apply_year'=> $value12->salary_da_apply_year,
       );
        $this->db->insert("ft_pay_log_salary_master", $datafixs);
}
         $data =array(
        'salary_madical'=>  $_POST['pay_ca'],
                     );


             $this->db->where("salary_cate_id",$_POST['cateid']);
            $this->db->update("ft_pay_salary_master", $data);  
             print_r($data);
            echo $this->db->last_query();
     


  if(isset($_POST['checkvalma']))
   {
  # code...
       $uid  = explode(",",$_POST['checkvalma']);
       
        foreach ($uid as $key => $value) {
      $query1 = $this->db->query('SELECT * FROM `ft_pay_emp_salary` where pay_emp_unique_id ='.$value);
        $rowid1 = $query1->result();//sprint_r($rowid1);die();
      foreach ($rowid1 as $key => $pay) {
        # code...
                     $datapay = array(
                                    'pay_salary_cate_id' => $pay->pay_salary_cate_id,
                                    'pay_emp_unique_id' => $pay->pay_emp_unique_id ,
                                    'pay_basic' => $pay->pay_basic ,
                                  'pay_grp' => $pay->pay_grp ,
                                  'pay_da' =>  $pay->pay_da ,
                                  'pay_special' =>$pay->pay_special ,
                                  'pay_hra' =>$pay->pay_hra ,
                                  'pay_sa' => $pay->pay_sa ,
                                  'pay_madical' => $pay->pay_madical ,
                                  'pay_ca' =>  $pay->pay_ca,
                                  'pay_sp' =>  $pay->pay_sp,
                                  'pay_others' =>  $pay->pay_others ,
                                   'pay_ca' => $pay->pay_ca,
                                  'pay_sp' => $pay->pay_sp ,
                                   'pay_total_sum' =>  $pay->pay_total_sum,
                                   'pay_dpf' =>  $pay->pay_dpf ,
                                    'pay_dpf_adv' =>  $pay->pay_dpf_adv,
                                   'pay_gpf' =>  $pay->pay_gpf ,
                                   'pay_gpf_adv' =>  $pay->pay_gpf_adv,
                                  'pay_gias' => $pay->pay_gias ,
                                  'pay_defined_contribution' => $pay->pay_defined_contribution ,
                                  'pay_fuel_charge' => $pay->pay_fuel_charge ,
                                  'pay_professional_tax' => $pay->pay_professional_tax ,
                                  'pay_income_tax' => $pay->pay_income_tax ,
                                   'pay_grain_adv' => $pay->pay_grain_adv ,
                                  'pay_festival_adv' => $pay->pay_festival_adv ,
                                   'pay_other_adv' => $pay->pay_other_adv,
                                  'pay_house_loan' => $pay->pay_house_loan,
                                  'pay_car_loan' => $pay->pay_car_loan,
                                  'pay_house_rent' => $pay->pay_house_rent,
                                  'pay_total_cut' => $pay->pay_total_cut,
                                   'pay_total' => $pay->pay_total_cut,
                                    'created_by' => $pay->created_by,
                                   );
                $this->db->insert("ft_pay_log_emp_salary", $datapay);


$ts =$pay->pay_basic + $pay->pay_grp + $pay->pay_da + $pay->pay_special + $pay->pay_hra +
             $pay->pay_sa + $pay->pay_ca +$pay->pay_others + $pay->pay_special+ $_POST['pay_ca'] +  $pay->pay_sp;

             $tc =  $pay->pay_dpf + $pay->pay_dpf_adv + $pay->pay_gpf + $pay->pay_gpf_adv + $pay->pay_gias + $pay->pay_defined_contribution + $pay->pay_fuel_charge + $pay->pay_income_tax+
             $pay->pay_professional_tax + $pay->pay_fuel_charge +$pay->pay_grain_adv  +$pay->pay_festival_adv + $pay->pay_house_rent + $pay->pay_other_adv + $pay->pay_house_loan + $pay->pay_car_loan ; 

               $tt = $ts - $tc;

                $data1 =array(
                   'pay_madical'=> $_POST['pay_ca'],
                   'pay_remark'=> "madical chnage",
                   'pay_total_sum' =>  round($ts),
              'pay_total_cut' => round($tc),
               'pay_total' => round($tt),
                'updated_by' =>  $this->session->userdata('user_id'),
                'updated_at'=> date("Y-m-d h:i:s"),
                   'no_updated'=> $pay->no_updated +1
                       );
              //  print_r($data1);
                $this->db->where("pay_emp_unique_id", $pay->pay_emp_unique_id);
              $this->db->update("ft_pay_emp_salary", $data1);# code..
           }
       }
    }

}
function changesa()
{

  $query = $this->db->query('SELECT * FROM `ft_pay_salary_master` where salary_id ='.$_POST['salary_id']);
  $rowid = $query->result();//echo $this->db->last_quer
foreach ($rowid as $key => $value12) {
  # code...
  $datafixs =array(
        'salary_cate_id'=>$value12->salary_cate_id,
          'salary_smchuri'=> $value12->salary_smchuri,
         'created_by'=>  $value12->created_by, 
         'salary_id'=>  $value12->salary_id, 
         'salary_da_apply_month'=> $value12->salary_da_apply_month,
          'salary_da_apply_year'=> $value12->salary_da_apply_year,
       );
        $this->db->insert("ft_pay_log_salary_master", $datafixs);
}
         $data =array(
        'salary_smchuri'=>  $_POST['pay_ca'],
                     );


             $this->db->where("salary_cate_id",$_POST['cateid']);
            $this->db->update("ft_pay_salary_master", $data);  
             print_r($data);
            echo $this->db->last_query();
     


  if(isset($_POST['checkvalsa']))
   {
  # code...
       $uid  = explode(",",$_POST['checkvalsa']);
       
        foreach ($uid as $key => $value) {
      $query1 = $this->db->query('SELECT * FROM `ft_pay_emp_salary` where pay_emp_unique_id ='.$value);
        $rowid1 = $query1->result();//sprint_r($rowid1);die();
      foreach ($rowid1 as $key => $pay) {
        # code...
                     $datapay = array(
                                    'pay_salary_cate_id' => $pay->pay_salary_cate_id,
                                    'pay_emp_unique_id' => $pay->pay_emp_unique_id ,
                                    'pay_basic' => $pay->pay_basic ,
                                  'pay_grp' => $pay->pay_grp ,
                                  'pay_da' =>  $pay->pay_da ,
                                  'pay_special' =>$pay->pay_special ,
                                  'pay_hra' =>$pay->pay_hra ,
                                  'pay_sa' => $pay->pay_sa ,
                                  'pay_madical' => $pay->pay_madical ,
                                  'pay_ca' =>  $pay->pay_ca,
                                  'pay_sp' =>  $pay->pay_sp,
                                  'pay_others' =>  $pay->pay_others ,
                                   'pay_ca' => $pay->pay_ca,
                                  'pay_sp' => $pay->pay_sp ,
                                   'pay_total_sum' =>  $pay->pay_total_sum,
                                   'pay_dpf' =>  $pay->pay_dpf ,
                                    'pay_dpf_adv' =>  $pay->pay_dpf_adv,
                                   'pay_gpf' =>  $pay->pay_gpf ,
                                   'pay_gpf_adv' =>  $pay->pay_gpf_adv,
                                  'pay_gias' => $pay->pay_gias ,
                                  'pay_defined_contribution' => $pay->pay_defined_contribution ,
                                  'pay_fuel_charge' => $pay->pay_fuel_charge ,
                                  'pay_professional_tax' => $pay->pay_professional_tax ,
                                  'pay_income_tax' => $pay->pay_income_tax ,
                                   'pay_grain_adv' => $pay->pay_grain_adv ,
                                  'pay_festival_adv' => $pay->pay_festival_adv ,
                                   'pay_other_adv' => $pay->pay_other_adv,
                                  'pay_house_loan' => $pay->pay_house_loan,
                                  'pay_car_loan' => $pay->pay_car_loan,
                                  'pay_house_rent' => $pay->pay_house_rent,
                                  'pay_total_cut' => $pay->pay_total_cut,
                                   'pay_total' => $pay->pay_total_cut,
                                    'created_by' => $pay->created_by,
                                   );
                $this->db->insert("ft_pay_log_emp_salary", $datapay);


$ts =$pay->pay_basic + $pay->pay_grp + $pay->pay_da + $pay->pay_special + $pay->pay_hra +
             $pay->pay_madical + $pay->pay_ca +$pay->pay_others + $pay->pay_special+ $_POST['pay_ca'] +  $pay->pay_sp;

             $tc =  $pay->pay_dpf + $pay->pay_dpf_adv + $pay->pay_gpf + $pay->pay_gpf_adv + $pay->pay_gias + $pay->pay_defined_contribution + $pay->pay_fuel_charge + $pay->pay_income_tax+
             $pay->pay_professional_tax + $pay->pay_fuel_charge +$pay->pay_grain_adv  +$pay->pay_festival_adv + $pay->pay_house_rent + $pay->pay_other_adv + $pay->pay_house_loan + $pay->pay_car_loan ; 

               $tt = $ts - $tc;

                $data1 =array(
                   'pay_sa'=> $_POST['pay_ca'],
                   'pay_remark'=> "Smchuri Allowance chnage",
                   'pay_total_sum' =>  round($ts),
              'pay_total_cut' => round($tc),
               'pay_total' => round($tt),
                'updated_by' =>  $this->session->userdata('user_id'),
                'updated_at'=> date("Y-m-d h:i:s"),
                   'no_updated'=> $pay->no_updated +1
                       );
              //  print_r($data1);
                $this->db->where("pay_emp_unique_id", $pay->pay_emp_unique_id);
              $this->db->update("ft_pay_emp_salary", $data1);# code..
           }
       }
    }

}

function changegis()
{

  $query = $this->db->query('SELECT * FROM `ft_pay_salary_master` where salary_id ='.$_POST['salary_id']);
  $rowid = $query->result();//echo $this->db->last_quer
foreach ($rowid as $key => $value12) {
  # code...
  $datafixs =array(
        'salary_cate_id'=>$value12->salary_cate_id,
          'salary_gis'=> $value12->salary_gis,
         'created_by'=>  $value12->created_by, 
         'salary_id'=>  $value12->salary_id, 
         'salary_da_apply_month'=> $value12->salary_da_apply_month,
          'salary_da_apply_year'=> $value12->salary_da_apply_year,
       );
        $this->db->insert("ft_pay_log_salary_master", $datafixs);
}
         $data =array(
        'salary_gis'=>  $_POST['pay_ca'],
                     );


             $this->db->where("salary_cate_id",$_POST['cateid']);
            $this->db->update("ft_pay_salary_master", $data);  
             print_r($data);
            echo $this->db->last_query();
     


  if(isset($_POST['checkvalgis']))
   {
  # code...
       $uid  = explode(",",$_POST['checkvalgis']);
       
        foreach ($uid as $key => $value) {
      $query1 = $this->db->query('SELECT * FROM `ft_pay_emp_salary` where pay_emp_unique_id ='.$value);
        $rowid1 = $query1->result();//sprint_r($rowid1);die();
      foreach ($rowid1 as $key => $pay) {
        # code...
                     $datapay = array(
                                    'pay_salary_cate_id' => $pay->pay_salary_cate_id,
                                    'pay_emp_unique_id' => $pay->pay_emp_unique_id ,
                                    'pay_basic' => $pay->pay_basic ,
                                  'pay_grp' => $pay->pay_grp ,
                                  'pay_da' =>  $pay->pay_da ,
                                  'pay_special' =>$pay->pay_special ,
                                  'pay_hra' =>$pay->pay_hra ,
                                  'pay_sa' => $pay->pay_sa ,
                                  'pay_madical' => $pay->pay_madical ,
                                  'pay_ca' =>  $pay->pay_ca,
                                  'pay_sp' =>  $pay->pay_sp,
                                  'pay_others' =>  $pay->pay_others ,
                                   'pay_ca' => $pay->pay_ca,
                                  'pay_sp' => $pay->pay_sp ,
                                   'pay_total_sum' =>  $pay->pay_total_sum,
                                   'pay_dpf' =>  $pay->pay_dpf ,
                                    'pay_dpf_adv' =>  $pay->pay_dpf_adv,
                                   'pay_gpf' =>  $pay->pay_gpf ,
                                   'pay_gpf_adv' =>  $pay->pay_gpf_adv,
                                  'pay_gias' => $pay->pay_gias ,
                                  'pay_defined_contribution' => $pay->pay_defined_contribution ,
                                  'pay_fuel_charge' => $pay->pay_fuel_charge ,
                                  'pay_professional_tax' => $pay->pay_professional_tax ,
                                  'pay_income_tax' => $pay->pay_income_tax ,
                                   'pay_grain_adv' => $pay->pay_grain_adv ,
                                  'pay_festival_adv' => $pay->pay_festival_adv ,
                                   'pay_other_adv' => $pay->pay_other_adv,
                                  'pay_house_loan' => $pay->pay_house_loan,
                                  'pay_car_loan' => $pay->pay_car_loan,
                                  'pay_house_rent' => $pay->pay_house_rent,
                                  'pay_total_cut' => $pay->pay_total_cut,
                                   'pay_total' => $pay->pay_total_cut,
                                    'created_by' => $pay->created_by,
                                   );
                $this->db->insert("ft_pay_log_emp_salary", $datapay);


$ts =$pay->pay_basic + $pay->pay_grp + $pay->pay_da + $pay->pay_special + $pay->pay_hra +
             $pay->pay_madical + $pay->pay_ca +$pay->pay_others + $pay->pay_special+ $pay->pay_ca +  $pay->pay_sp;

             $tc =  $pay->pay_dpf + $pay->pay_dpf_adv + $pay->pay_gpf + $pay->pay_gpf_adv + $_POST['pay_ca']+ $pay->pay_defined_contribution + $pay->pay_fuel_charge + $pay->pay_income_tax+
             $pay->pay_professional_tax + $pay->pay_fuel_charge +$pay->pay_grain_adv  +$pay->pay_festival_adv + $pay->pay_house_rent + $pay->pay_other_adv + $pay->pay_house_loan + $pay->pay_car_loan ; 

               $tt = $ts - $tc;

                $data1 =array(
                   'pay_gias'=> $_POST['pay_ca'],
                   'pay_remark'=> "GIS chnage",
                   'pay_total_sum' =>  round($ts),
              'pay_total_cut' => round($tc),
               'pay_total' => round($tt),
                'updated_by' =>  $this->session->userdata('user_id'),
                'updated_at'=> date("Y-m-d h:i:s"),
                   'no_updated'=> $pay->no_updated +1
                       );
              //  print_r($data1);
                $this->db->where("pay_emp_unique_id", $pay->pay_emp_unique_id);
              $this->db->update("ft_pay_emp_salary", $data1);# code..
           }
       }
    }

}
function changept()
{

  $query = $this->db->query('SELECT * FROM `ft_pay_salary_master` where salary_id ='.$_POST['salary_id']);
  $rowid = $query->result();//echo $this->db->last_quer
foreach ($rowid as $key => $value12) {
  # code...
  $datafixs =array(
        'salary_cate_id'=>$value12->salary_cate_id,
          'salary_pt'=> $value12->salary_pt,
         'created_by'=>  $value12->created_by, 
         'salary_id'=>  $value12->salary_id, 
         'salary_da_apply_month'=> $value12->salary_da_apply_month,
          'salary_da_apply_year'=> $value12->salary_da_apply_year,
       );
        $this->db->insert("ft_pay_log_salary_master", $datafixs);
}
         $data =array(
        'salary_pt'=>  $_POST['pay_ca'],
                     );


             $this->db->where("salary_cate_id",$_POST['cateid']);
            $this->db->update("ft_pay_salary_master", $data);  
             print_r($data);
            echo $this->db->last_query();
     


  if(isset($_POST['checkvalpt']))
   {
  # code...
       $uid  = explode(",",$_POST['checkvalpt']);
       
        foreach ($uid as $key => $value) {
      $query1 = $this->db->query('SELECT * FROM `ft_pay_emp_salary` where pay_emp_unique_id ='.$value);
        $rowid1 = $query1->result();//sprint_r($rowid1);die();
      foreach ($rowid1 as $key => $pay) {
        # code...
                     $datapay = array(
                                    'pay_salary_cate_id' => $pay->pay_salary_cate_id,
                                    'pay_emp_unique_id' => $pay->pay_emp_unique_id ,
                                    'pay_basic' => $pay->pay_basic ,
                                  'pay_grp' => $pay->pay_grp ,
                                  'pay_da' =>  $pay->pay_da ,
                                  'pay_special' =>$pay->pay_special ,
                                  'pay_hra' =>$pay->pay_hra ,
                                  'pay_sa' => $pay->pay_sa ,
                                  'pay_madical' => $pay->pay_madical ,
                                  'pay_ca' =>  $pay->pay_ca,
                                  'pay_sp' =>  $pay->pay_sp,
                                  'pay_others' =>  $pay->pay_others ,
                                   'pay_ca' => $pay->pay_ca,
                                  'pay_sp' => $pay->pay_sp ,
                                   'pay_total_sum' =>  $pay->pay_total_sum,
                                   'pay_dpf' =>  $pay->pay_dpf ,
                                    'pay_dpf_adv' =>  $pay->pay_dpf_adv,
                                   'pay_gpf' =>  $pay->pay_gpf ,
                                   'pay_gpf_adv' =>  $pay->pay_gpf_adv,
                                  'pay_gias' => $pay->pay_gias ,
                                  'pay_defined_contribution' => $pay->pay_defined_contribution ,
                                  'pay_fuel_charge' => $pay->pay_fuel_charge ,
                                  'pay_professional_tax' => $pay->pay_professional_tax ,
                                  'pay_income_tax' => $pay->pay_income_tax ,
                                   'pay_grain_adv' => $pay->pay_grain_adv ,
                                  'pay_festival_adv' => $pay->pay_festival_adv ,
                                   'pay_other_adv' => $pay->pay_other_adv,
                                  'pay_house_loan' => $pay->pay_house_loan,
                                  'pay_car_loan' => $pay->pay_car_loan,
                                  'pay_house_rent' => $pay->pay_house_rent,
                                  'pay_total_cut' => $pay->pay_total_cut,
                                   'pay_total' => $pay->pay_total_cut,
                                    'created_by' => $pay->created_by,
                                   );
                $this->db->insert("ft_pay_log_emp_salary", $datapay);


$ts =$pay->pay_basic + $pay->pay_grp + $pay->pay_da + $pay->pay_special + $pay->pay_hra +
             $pay->pay_madical + $pay->pay_ca +$pay->pay_others + $pay->pay_special+ $pay->pay_ca +  $pay->pay_sp;

             $tc =  $pay->pay_dpf + $pay->pay_dpf_adv + $pay->pay_gpf + $pay->pay_gpf_adv + $_POST['pay_ca']+ $pay->pay_defined_contribution + $pay->pay_fuel_charge + $pay->pay_income_tax+
             $pay->pay_gias + $pay->pay_fuel_charge +$pay->pay_grain_adv  +$pay->pay_festival_adv + $pay->pay_house_rent + $pay->pay_other_adv + $pay->pay_house_loan + $pay->pay_car_loan ; 

               $tt = $ts - $tc;

                $data1 =array(
                   'pay_professional_tax'=> $_POST['pay_ca'],
                   'pay_remark'=> "PT chnage",
                   'pay_total_sum' =>  round($ts),
              'pay_total_cut' => round($tc),
               'pay_total' => round($tt),
                'updated_by' =>  $this->session->userdata('user_id'),
                'updated_at'=> date("Y-m-d h:i:s"),
                   'no_updated'=> $pay->no_updated +1
                       );
              //  print_r($data1);
                $this->db->where("pay_emp_unique_id", $pay->pay_emp_unique_id);
              $this->db->update("ft_pay_emp_salary", $data1);# code..
           }
       }
    }

}

function changefule()
{

  $query = $this->db->query('SELECT * FROM `ft_pay_salary_master` where salary_id ='.$_POST['salary_id']);
  $rowid = $query->result();//echo $this->db->last_quer
foreach ($rowid as $key => $value12) {
  # code...
  $datafixs =array(
        'salary_cate_id'=>$value12->salary_cate_id,
          'salary_fuel_charge'=> $value12->salary_fuel_charge,
         'created_by'=>  $value12->created_by, 
         'salary_id'=>  $value12->salary_id, 
         'salary_da_apply_month'=> $value12->salary_da_apply_month,
          'salary_da_apply_year'=> $value12->salary_da_apply_year,
       );
        $this->db->insert("ft_pay_log_salary_master", $datafixs);
}
         $data =array(
        'salary_fuel_charge'=>  $_POST['pay_ca'],
                     );


             $this->db->where("salary_cate_id",$_POST['cateid']);
            $this->db->update("ft_pay_salary_master", $data);  
             print_r($data);
            echo $this->db->last_query();
     


  if(isset($_POST['checkvalfule']))
   {
  # code...
       $uid  = explode(",",$_POST['checkvalfule']);
       
        foreach ($uid as $key => $value) {
      $query1 = $this->db->query('SELECT * FROM `ft_pay_emp_salary` where pay_emp_unique_id ='.$value);
        $rowid1 = $query1->result();//sprint_r($rowid1);die();
      foreach ($rowid1 as $key => $pay) {
        # code...
                     $datapay = array(
                                    'pay_salary_cate_id' => $pay->pay_salary_cate_id,
                                    'pay_emp_unique_id' => $pay->pay_emp_unique_id ,
                                    'pay_basic' => $pay->pay_basic ,
                                  'pay_grp' => $pay->pay_grp ,
                                  'pay_da' =>  $pay->pay_da ,
                                  'pay_special' =>$pay->pay_special ,
                                  'pay_hra' =>$pay->pay_hra ,
                                  'pay_sa' => $pay->pay_sa ,
                                  'pay_madical' => $pay->pay_madical ,
                                  'pay_ca' =>  $pay->pay_ca,
                                  'pay_sp' =>  $pay->pay_sp,
                                  'pay_others' =>  $pay->pay_others ,
                                   'pay_ca' => $pay->pay_ca,
                                  'pay_sp' => $pay->pay_sp ,
                                   'pay_total_sum' =>  $pay->pay_total_sum,
                                   'pay_dpf' =>  $pay->pay_dpf ,
                                    'pay_dpf_adv' =>  $pay->pay_dpf_adv,
                                   'pay_gpf' =>  $pay->pay_gpf ,
                                   'pay_gpf_adv' =>  $pay->pay_gpf_adv,
                                  'pay_gias' => $pay->pay_gias ,
                                  'pay_defined_contribution' => $pay->pay_defined_contribution ,
                                  'pay_fuel_charge' => $pay->pay_fuel_charge ,
                                  'pay_professional_tax' => $pay->pay_professional_tax ,
                                  'pay_income_tax' => $pay->pay_income_tax ,
                                   'pay_grain_adv' => $pay->pay_grain_adv ,
                                  'pay_festival_adv' => $pay->pay_festival_adv ,
                                   'pay_other_adv' => $pay->pay_other_adv,
                                  'pay_house_loan' => $pay->pay_house_loan,
                                  'pay_car_loan' => $pay->pay_car_loan,
                                  'pay_house_rent' => $pay->pay_house_rent,
                                  'pay_total_cut' => $pay->pay_total_cut,
                                   'pay_total' => $pay->pay_total_cut,
                                    'created_by' => $pay->created_by,
                                   );
                $this->db->insert("ft_pay_log_emp_salary", $datapay);


$ts =$pay->pay_basic + $pay->pay_grp + $pay->pay_da + $pay->pay_special + $pay->pay_hra +
             $pay->pay_madical + $pay->pay_ca +$pay->pay_others + $pay->pay_special+ $pay->pay_ca +  $pay->pay_sp;

             $tc =  $pay->pay_dpf + $pay->pay_dpf_adv + $pay->pay_gpf + $pay->pay_gpf_adv + $_POST['pay_ca']+ $pay->pay_defined_contribution + $pay->pay_fuel_charge + $pay->pay_income_tax+
             $pay->pay_gias + $pay->pay_professional_tax +$pay->pay_grain_adv  +$pay->pay_festival_adv + $pay->pay_house_rent + $pay->pay_other_adv + $pay->pay_house_loan + $pay->pay_car_loan ; 

               $tt = $ts - $tc;

                $data1 =array(
                   'pay_fuel_charge'=> $_POST['pay_ca'],
                   'pay_remark'=> "fule chares chnage",
                   'pay_total_sum' =>  round($ts),
              'pay_total_cut' => round($tc),
               'pay_total' => round($tt),
                'updated_by' =>  $this->session->userdata('user_id'),
                'updated_at'=> date("Y-m-d h:i:s"),
                   'no_updated'=> $pay->no_updated +1
                       );
              //  print_r($data1);
                $this->db->where("pay_emp_unique_id", $pay->pay_emp_unique_id);
              $this->db->update("ft_pay_emp_salary", $data1);# code..
           }
       }
    }

}
function changegpf()
{

  $query = $this->db->query('SELECT * FROM `ft_pay_salary_master` where salary_id ='.$_POST['salary_id']);
  $rowid = $query->result();//echo $this->db->last_quer
foreach ($rowid as $key => $value12) {
  # code...
  $datafixs =array(
        'salary_cate_id'=>$value12->salary_cate_id,
          'salary_gpf'=> $value12->salary_gpf,
         'created_by'=>  $value12->created_by, 
         'salary_id'=>  $value12->salary_id, 
         'salary_da_apply_month'=> $value12->salary_da_apply_month,
          'salary_da_apply_year'=> $value12->salary_da_apply_year,
       );
        $this->db->insert("ft_pay_log_salary_master", $datafixs);
}
         $data =array(
        'salary_gpf'=>  $_POST['pay_ca'],
                     );


             $this->db->where("salary_cate_id",$_POST['cateid']);
            $this->db->update("ft_pay_salary_master", $data);  
             print_r($data);
            echo $this->db->last_query();
     


  if(isset($_POST['checkvalgpf']))
   {
  # code...
       $uid  = explode(",",$_POST['checkvalgpf']);
       
        foreach ($uid as $key => $value) {
      $query1 = $this->db->query('SELECT * FROM `ft_pay_emp_salary` where pay_emp_unique_id ='.$value);
        $rowid1 = $query1->result();//sprint_r($rowid1);die();
      foreach ($rowid1 as $key => $pay) {
        # code...
                     $datapay = array(
                                    'pay_salary_cate_id' => $pay->pay_salary_cate_id,
                                    'pay_emp_unique_id' => $pay->pay_emp_unique_id ,
                                    'pay_basic' => $pay->pay_basic ,
                                  'pay_grp' => $pay->pay_grp ,
                                  'pay_da' =>  $pay->pay_da ,
                                  'pay_special' =>$pay->pay_special ,
                                  'pay_hra' =>$pay->pay_hra ,
                                  'pay_sa' => $pay->pay_sa ,
                                  'pay_madical' => $pay->pay_madical ,
                                  'pay_ca' =>  $pay->pay_ca,
                                  'pay_sp' =>  $pay->pay_sp,
                                  'pay_others' =>  $pay->pay_others ,
                                   'pay_ca' => $pay->pay_ca,
                                  'pay_sp' => $pay->pay_sp ,
                                   'pay_total_sum' =>  $pay->pay_total_sum,
                                   'pay_dpf' =>  $pay->pay_dpf ,
                                    'pay_dpf_adv' =>  $pay->pay_dpf_adv,
                                   'pay_gpf' =>  $pay->pay_gpf ,
                                   'pay_gpf_adv' =>  $pay->pay_gpf_adv,
                                  'pay_gias' => $pay->pay_gias ,
                                  'pay_defined_contribution' => $pay->pay_defined_contribution ,
                                  'pay_fuel_charge' => $pay->pay_fuel_charge ,
                                  'pay_professional_tax' => $pay->pay_professional_tax ,
                                  'pay_income_tax' => $pay->pay_income_tax ,
                                   'pay_grain_adv' => $pay->pay_grain_adv ,
                                  'pay_festival_adv' => $pay->pay_festival_adv ,
                                   'pay_other_adv' => $pay->pay_other_adv,
                                  'pay_house_loan' => $pay->pay_house_loan,
                                  'pay_car_loan' => $pay->pay_car_loan,
                                  'pay_house_rent' => $pay->pay_house_rent,
                                  'pay_total_cut' => $pay->pay_total_cut,
                                   'pay_total' => $pay->pay_total_cut,
                                    'created_by' => $pay->created_by,
                                   );
                $this->db->insert("ft_pay_log_emp_salary", $datapay);
                $gpf =(($pay->pay_basic + $pay->pay_grp) * $_POST['pay_ca'])/100;

$ts =$pay->pay_basic + $pay->pay_grp + $pay->pay_da + $pay->pay_special + $pay->pay_hra +
             $pay->pay_madical + $pay->pay_ca +$pay->pay_others + $pay->pay_special+ $pay->pay_ca +  $pay->pay_sp;

             $tc =  $pay->pay_dpf + $pay->pay_dpf_adv + $pay->pay_fuel_charge + $pay->pay_gpf_adv + $gpf + $pay->pay_defined_contribution + $pay->pay_fuel_charge + $pay->pay_income_tax+
             $pay->pay_gias + $pay->pay_professional_tax +$pay->pay_grain_adv  +$pay->pay_festival_adv + $pay->pay_house_rent + $pay->pay_other_adv + $pay->pay_house_loan + $pay->pay_car_loan ; 

               $tt = $ts - $tc;

                $data1 =array(
                   'pay_fuel_charge'=>  $gpf ,
                   'pay_remark'=> "gpf persentage chnage",
                   'pay_total_sum' =>  round($ts),
              'pay_total_cut' => round($tc),
               'pay_total' => round($tt),
                'updated_by' =>  $this->session->userdata('user_id'),
                'updated_at'=> date("Y-m-d h:i:s"),
                   'no_updated'=> $pay->no_updated +1
                       );
              //  print_r($data1);
                $this->db->where("pay_emp_unique_id", $pay->pay_emp_unique_id);
              $this->db->update("ft_pay_emp_salary", $data1);# code..
           }
       }
    }

}
function edit_slary_master()
{

 
  if(isset($_POST['pay_gradepay'])){

        $pay_gradepay = $_POST['pay_gradepay'];

      }else{
    $pay_gradepay = 0;

      }
        if(isset($_POST['pay_ca'])){

        $pay_ca = $_POST['pay_ca'];

      }else{
    $pay_ca = 0;

      }
        if(isset($_POST['pay_da'])){

        $pay_da = $_POST['pay_da'];

      }else{
    $pay_da = 0;

      }

        if(isset($_POST['pay_hra'])){

        $pay_hra = $_POST['pay_hra'];

      }else{
    $pay_hra = 0;

      }


        if(isset($_POST['pay_sa'])){

        $pay_sa = $_POST['pay_sa'];

      }else{
    $pay_sa = 0;

      }

          if(isset($_POST['pay_madical'])){

        $pay_madical = $_POST['pay_madical'];

      }else{
    $pay_madical = 0;

      }


            if(isset($_POST['pay_special'])){

        $pay_special = $_POST['pay_special'];

      }else{
    $pay_special = 0;

      }
      if(isset($_POST['pay_sp'])){

        $pay_sp = $_POST['pay_sp'];

      }else{
    $pay_sp = 0;

      }
            if(isset($_POST['pay_others'])){

        $pay_others = $_POST['pay_others'];

      }else{
    $pay_others = 0;

      }
          if(isset($_POST['pay_dpf'])){

        $pay_dpf = $_POST['pay_dpf'];

      }else{
    $pay_dpf = 0;

      }

if(isset($_POST['pay_gpf'])){

        $pay_gpf = $_POST['pay_gpf'];

      }else{
    $pay_gpf = 0;

      }
       if(isset($_POST['pay_dpf_adv'])){

        $pay_dpf_adv = $_POST['pay_dpf_adv'];

      }else{
    $pay_dpf_adv = 0;

      }
if(isset($_POST['pay_gpf_adv'])){

        $pay_gpf_adv = $_POST['pay_gpf_adv'];

      }else{
    $pay_gpf_adv = 0;

      }


if(isset($_POST['pay_gias'])){

        $pay_gias = $_POST['pay_gias'];

      }else{
    $pay_gias = 0;

      }

if(isset($_POST['pay_define'])){

        $pay_define = $_POST['pay_define'];

      }else{
    $pay_define = 0;

      }

if(isset($_POST['pay_fuel_charge'])){

        $pay_fuel_charge = $_POST['pay_fuel_charge'];

      }else{
    $pay_fuel_charge = 0;

      }
if(isset($_POST['pay_professional_tax'])){

        $pay_professional_tax = $_POST['pay_professional_tax'];

      }else{
    $pay_professional_tax = 0;

      }

if(isset($_POST['pay_income_tax'])){

        $pay_income_tax = $_POST['pay_income_tax'];

      }else{
    $pay_income_tax = 0;

      }


if(isset($_POST['pay_other_adv'])){

        $pay_other_adv = $_POST['pay_other_adv'];

      }else{
    $pay_other_adv = 0;

      }

if(isset($_POST['pay_house_rent'])){

        $pay_house_rent = $_POST['pay_house_rent'];

      }else{
    $pay_house_rent = 0;

      }

 $dab = (inputcheckvaul('pay_basic') + inputcheckvaul('pay_grp'));


      $da  = ($dab * 119)/100;
    
    if(inputcheckvaul('cate_id') == 2)
    {
  
      $pay_define = (($_POST['pay_basic'] + inputcheckvaul('pay_grp') + $da) * 10)/100 ;
      }else{
      $pay_define = $pay_define;
      }

      $ts = $_POST['pay_basic'] + inputcheckvaul('pay_grp') + $da + $pay_special + $pay_hra + $pay_sa + $pay_madical + $pay_others + $pay_ca +  $pay_sp;

       $tc =  $pay_dpf + $pay_dpf_adv + $pay_gpf + $pay_gpf_adv + $pay_gias + $pay_define  + $pay_income_tax + $pay_professional_tax + $pay_fuel_charge + inputcheckvaul('pay_grain_adv')  +inputcheckvaul('pay_festival_adv') + $pay_house_rent +        $pay_other_adv + inputcheckvaul('pay_house_loan') +inputcheckvaul('pay_car_loan') ; 

         $tt = $ts - $tc;


        $datapay = array(
                'pay_emp_unique_id' =>inputcheckvaul('pay_emp_unique_id'),
                'pay_salary_cate_id' =>inputcheckvaul('cate_id'),
                
               'pay_basic' => inputcheckvaul('pay_basic'),
              'pay_grp' =>inputcheckvaul('pay_grp'),
              'pay_da' => $da,
              'pay_special' =>$pay_special ,
              'pay_hra' =>$pay_hra,
              'pay_sa' => $pay_sa,
              'pay_madical' =>$pay_madical,
              'pay_special' =>  $pay_special,
              'pay_others' => $pay_others ,
               'pay_ca' => $pay_ca ,
              'pay_sp' => $pay_sp ,
               'pay_total_sum' =>  $ts,
               'pay_dpf' =>  $pay_dpf ,
                'pay_dpf_adv' => $pay_dpf_adv,
               'pay_gpf' =>  $pay_gpf ,
               'pay_gpf_adv' => $pay_gpf_adv,
              'pay_gias' => $pay_gias ,
              'pay_defined_contribution' => $pay_define ,
              'pay_fuel_charge' => $pay_fuel_charge ,
              'pay_professional_tax' => $pay_professional_tax ,
              'pay_income_tax' =>$pay_income_tax ,
              'pay_house_loan' => inputcheckvaul('pay_house_loan') ,
     'pay_car_loan' =>inputcheckvaul('pay_car_loan') ,
      'pay_house_rent' => $pay_house_rent,
      'pay_total_cut' => $tc,
       'pay_total' => $tt,
        'created_by' => $this->session->userdata('user_id'),
       
               );
        
     $this->db->insert("ft_pay_emp_salary", $datapay);
if($_POST['condi'] == 1 ){
      $datapay1 = array( 'pay_emp_unique_id' =>inputcheckvaul('pay_emp_unique_id'),
                'pay_salary_cate_id' =>inputcheckvaul('cate_id'),
                
               'pay_basic' => inputcheckvaul('pay_basic'),
              'pay_grp' =>inputcheckvaul('pay_grp'),
              'pay_da' => $da,
              'pay_special' =>$pay_special ,
              'pay_hra' =>$pay_hra,
              'pay_sa' => $pay_sa,
              'pay_madical' =>$pay_madical,
              'pay_special' =>  $pay_special,
              'pay_others' => $pay_others ,
               'pay_ca' => $pay_ca ,
              'pay_sp' => $pay_sp ,
               'pay_total_sum' =>  $ts,
               'pay_dpf' =>  $pay_dpf ,
                'pay_dpf_adv' => $pay_dpf_adv,
               'pay_gpf' =>  $pay_gpf ,
               'pay_gpf_adv' => $pay_gpf_adv,
              'pay_gias' => $pay_gias ,
              'pay_defined_contribution' => $pay_define ,
              'pay_fuel_charge' => $pay_fuel_charge ,
              'pay_professional_tax' => $pay_professional_tax ,
              'pay_income_tax' =>$pay_income_tax ,
              'pay_house_loan' => inputcheckvaul('pay_house_loan') ,
     'pay_car_loan' =>inputcheckvaul('pay_car_loan') ,
      'pay_house_rent' => $pay_house_rent,
      'pay_total_cut' => $tc,
       'pay_total' => $tt,
	   	    'pay_month' => date("F"),
				'pay_year' => date("Y"),
				 'pay_month_given' => date("F"),
		 'pay_month_order' =>date('m'),
        'created_by' => $this->session->userdata('user_id')        
		);
     $this->db->insert("ft_pay_register", $datapay1);

}
    


}
function edit_slary_master1()
{
      $query1 = $this->db->query('SELECT * FROM `ft_pay_emp_salary` where pay_id ='.$_POST['pay_id']);
        $rowid1 = $query1->result();//sprint_r($rowid1);die();
        foreach ($rowid1 as $key => $pay) {
          # code...
      
                     $datapay = array(
                                    'pay_salary_cate_id' => $pay->pay_salary_cate_id,
                                    'pay_emp_unique_id' => $pay->pay_emp_unique_id ,
                                    'pay_basic' => $pay->pay_basic ,
                                  'pay_grp' => $pay->pay_grp ,
                                  'pay_da' =>  $pay->pay_da ,
                                  'pay_special' =>$pay->pay_special ,
                                  'pay_hra' =>$pay->pay_hra ,
                                  'pay_sa' => $pay->pay_sa ,
                                  'pay_madical' => $pay->pay_madical ,
                                  'pay_ca' =>  $pay->pay_ca,
                                  'pay_sp' =>  $pay->pay_sp,
                                  'pay_others' =>  $pay->pay_others ,
                                   'pay_ca' => $pay->pay_ca,
                                  'pay_sp' => $pay->pay_sp ,
                                   'pay_total_sum' =>  $pay->pay_total_sum,
                                   'pay_dpf' =>  $pay->pay_dpf ,
                                    'pay_dpf_adv' =>  $pay->pay_dpf_adv,
                                   'pay_gpf' =>  $pay->pay_gpf ,
                                   'pay_gpf_adv' =>  $pay->pay_gpf_adv,
                                  'pay_gias' => $pay->pay_gias ,
                                  'pay_defined_contribution' => $pay->pay_defined_contribution ,
                                  'pay_fuel_charge' => $pay->pay_fuel_charge ,
                                  'pay_professional_tax' => $pay->pay_professional_tax ,
                                  'pay_income_tax' => $pay->pay_income_tax ,
                                   'pay_grain_adv' => $pay->pay_grain_adv ,
                                  'pay_festival_adv' => $pay->pay_festival_adv ,
                                   'pay_other_adv' => $pay->pay_other_adv,
                                  'pay_house_loan' => $pay->pay_house_loan,
                                  'pay_car_loan' => $pay->pay_car_loan,
                                  'pay_house_rent' => $pay->pay_house_rent,
                                  'pay_total_cut' => $pay->pay_total_cut,
                                   'pay_total' => $pay->pay_total_cut,
                                    'created_by' => $pay->created_by,
                                   );
                $this->db->insert("ft_pay_log_emp_salary", $datapay);
  }

$ts =$pay->pay_basic + $pay->pay_grp + $pay->pay_da + $pay->pay_special + $pay->pay_hra +
             $pay->pay_madical + $pay->pay_ca +$pay->pay_others + $pay->pay_special+ $pay->pay_ca +  $pay->pay_sp;

       $tc =  inputcheckvaul('pay_dpf') +inputcheckvaul('$pay_dpf_adv') +inputcheckvaul('pay_gpf') +
       inputcheckvaul('pay_gpf_adv') + inputcheckvaul('pay_gias') +  inputcheckvaul('pay_define') +
       inputcheckvaul('pay_income_tax') +inputcheckvaul('pay_professional_tax') +inputcheckvaul('pay_fuel_charge')
       +inputcheckvaul('pay_house_rent') +inputcheckvaul('pay_other_adv') ; 

         $tt = $ts - $tc;
           

                $data1 =array( 
                  'pay_dpf' =>  inputcheckvaul('pay_dpf') ,
                'pay_dpf_adv' => inputcheckvaul('$pay_dpf_adv') ,
               'pay_gpf' =>  inputcheckvaul('pay_gpf')  ,
               'pay_gpf_adv' => inputcheckvaul('pay_gpf_adv') ,
              'pay_gias' => inputcheckvaul('pay_gias') ,
              'pay_defined_contribution' => inputcheckvaul('pay_define'),
              'pay_fuel_charge' => inputcheckvaul('pay_fuel_charge'),
              'pay_professional_tax' => inputcheckvaul('pay_professional_tax') ,
              'pay_income_tax' =>inputcheckvaul('pay_income_tax') ,
         'pay_house_rent' => inputcheckvaul('pay_house_rent'),
                 'pay_remark'=> "all value chares chnage",
                   'pay_total_sum' =>  round($ts),
              'pay_total_cut' => round($tc),
               'pay_total' => round($tt),
                'updated_by' =>  $this->session->userdata('user_id'),
                'updated_at'=> date("Y-m-d h:i:s"),
                   'no_updated'=> $pay->no_updated +1
                       );
            // print_r($data1);die();
                $this->db->where("pay_id", $_POST['pay_id']);
              $this->db->update("ft_pay_emp_salary", $data1);
         
  

}
function alladvnce()
{
     $currentyear = date("Y");
      $this->db->select('*');
      $this->db->from('ft_pay_emp_advance');
     $this->db->where("pea_type",0);
      // $this->db->where("pay_year",$currentyear);
       $query = $this->db->get();
     //echo $this->db->last_query();
   return $rows = $query->result();

}
function alladv()
{
     $currentyear = date("Y");
      $this->db->select('*');
      $this->db->from('ft_pay_advance_master');      // $this->db->where("pay_year",$currentyear);
       $query = $this->db->get();
     //echo $this->db->last_query();
   return $rows = $query->result();

}
function add_empadv()
{

                $data1 =array( 
                  'pea_type_id' =>  inputcheckvaul('cate_id') ,
                'pea_type' => 0 ,
               'pea_emp_unique_id' =>  inputcheckvaul('pay_emp_unique_id')  ,
               'pea_starting_month' => inputcheckvaul('pea_starting_month') ,
              'pea_starting_year' => inputcheckvaul('pea_starting_year') ,
              'pea_intrest_rate' => inputcheckvaul('pae_interest'),
              'pea_amount' => inputcheckvaul('pea_amount'),
              'pea_emi' => inputcheckvaul('pea_emi') ,
              'pea_emi_amount' =>inputcheckvaul('pea_emi_amount') ,
         
                       );
            // print_r($data1);die();
               
              $this->db->insert("ft_pay_emp_advance", $data1);

}function Allbills()
{

  $currentyear = date("Y");
      $this->db->select('*');
      $this->db->from('ft_pay_bill_cate');
      // $this->db->where("pay_year",$currentyear);
       $query = $this->db->get();
     //echo $this->db->last_query();
   return $rows = $query->result();

}function edit_pay_bill()
{
   $data1 =array( 
                  'pea_type_id' =>  inputcheckvaul('cate_id') ,
                'pea_type' => 0 ,
               'pea_emp_unique_id' =>  inputcheckvaul('pay_emp_unique_id')  ,
               'pea_starting_month' => inputcheckvaul('pea_starting_month') ,
              'pea_starting_year' => inputcheckvaul('pea_starting_year') ,
              'pea_intrest_rate' => inputcheckvaul('pae_interest'),
              'pea_amount' => inputcheckvaul('pea_amount'),
              'pea_emi' => inputcheckvaul('pea_emi') ,
              'pea_emi_amount' =>inputcheckvaul('pea_emi_amount') ,
         
                       );
            // print_r($data1);die();
               
              $this->db->insert("ft_pay_emp_advance", $data1);

}
	public function bills($edit_id = null)
	{
		$this->db->select('*');
	    $this->db->from('ft_pay_bill_cate');
	    $this->db->where("pbill_id",$edit_id);
	    $query = $this->db->get();
		//echo $this->db->last_query();
	    return $rows = $query->result();
	}

	public function edit_pay_bill11($edit_id)
	{	
		if($_POST['pay_type'] == 2 || $_POST['pay_type'] == 3){$head = 0;}else{$head = $_POST['pay_head'];}
		$data = array('pbill_month' => $_POST['pay_month'] ,
			  'pbill_cate_id' =>  $head,
			  'pbill_bugetno' =>   $_POST['pay_buget'],
			  'pbill_computer_date' =>  date("Y-m-d",strtotime($_POST['computer_bill_date'])) ,
			  'pbill_type' => $_POST['pay_type'] ,
			  'pbill_year' => $_POST['pay_year'] ,
			  'pbill_computer_no' => $_POST['computer_bill_number'] ,
			  'pbill_office_no' => $_POST['office_bill_number'] ,
			  'pbill_vocher_no' => $_POST['vocher_bill_number'] ,
			  'pbill_vocher_date' => date("Y-m-d", strtotime($_POST['vocher_bill_date'])) ,
			   );
	
        $this->db->where("pbill_id", $edit_id );
	 	return	$this->db->update("ft_pay_bill_cate", $data);
	
	}
	
function salary_emp_report($m)
{

$y=Date("Y");
  // e


    $this->db->select('*');
          $this->db->from('ft_pay_register');

       //  $this->db->join('ft_pay_bill_cate', 'ft_pay_bill_cate.pbill_cate_id = ft_pay_register.pay_salary_cate_id');
         $this->db->join('ft_employee', 'ft_employee.emp_unique_id = ft_pay_register.pay_emp_unique_id');
     $this->db->where("pay_year",$y);
        $this->db->where("pay_month",$m);
		    $this->db->where("pay_month",$m);
			    $this->db->where("pay_arriyas",0);
            $this->db->where("pay_back_date",0);
        $this->db->order_by("emp_order", "DESC"); 

        $query = $this->db->get();
// /echo $this->db->last_query();
   return $rows = $query->result();
}function showsamayman()
{
$this->db->select('*');
          $this->db->from('ft_pay_emp_samay_maan');

       //  $this->db->join('ft_pay_bill_cate', 'ft_pay_bill_cate.pbill_cate_id = ft_pay_register.pay_salary_cate_id');
       $this->db->where("pay_emp_unique_id",$_GET['uid']);
   
        $this->db->where("pay_emp_status",1);
   
        $query = $this->db->get();
// /echo $this->db->last_query();
   return $rows = $query->result();

}function addsamaymaan($file)
{
     $data = array('pay_emp_unique_id' => $_POST['pay_emp_unique_idpay_emp_unique_id'] ,
          'pay_emp_samay_man' =>  $_POST['pay_emp_samay_man'] ,
          'pay_basic_new' =>   $_POST['pay_basic_new'],
          'pay_emp_date' =>  date("Y-m-d",strtotime($_POST['pay_emp_date'])) ,
          'pay_grp_new' => $_POST['pay_grp_new'] ,
          'pay_order_no' => $_POST['pay_order_no'] ,
          'pay_file_name' => $file ,
          'pay_emp_status' => 1 ,
           'pay_remark' => $_POST['pay_remark'] ,
          'created_by' => $this->session->userdata('user_id'),
           );
       $this->db->insert("ft_pay_emp_samay_maan", $data);



        $query = $this->db->query('SELECT * FROM `ft_pay_emp_salary` join ft_pay_salary_master on ft_pay_salary_master.salary_cate_id = ft_pay_emp_salary.pay_salary_cate_id where pay_emp_unique_id='.$_POST['pay_emp_unique_idpay_emp_unique_id']);
         $rowid = $query->result();
  
        
  
      foreach ($rowid  as $key => $pay) {
       
              $datapay = array(
                'pay_salary_cate_id' => $pay->pay_salary_cate_id,
                'pay_emp_unique_id' => $pay->pay_emp_unique_id ,
                'pay_basic' => $pay->pay_basic ,
              'pay_grp' => $pay->pay_grp ,
              'pay_da' =>  $pay->pay_da ,
              'pay_special' =>$pay->pay_special ,
              'pay_hra' =>$pay->pay_hra ,
              'pay_sa' => $pay->pay_sa ,
              'pay_madical' => $pay->pay_madical ,
              'pay_ca' =>  $pay->pay_ca,
              'pay_sp' =>  $pay->pay_sp,
              'pay_others' =>  $pay->pay_others ,
               'pay_ca' => $pay->pay_ca,
              'pay_sp' => $pay->pay_sp ,
               'pay_total_sum' =>  $pay->pay_total_sum,
               'pay_dpf' =>  $pay->pay_dpf ,
                'pay_dpf_adv' =>  $pay->pay_dpf_adv,
               'pay_gpf' =>  $pay->pay_gpf ,
               'pay_gpf_adv' =>  $pay->pay_gpf_adv,
              'pay_gias' => $pay->pay_gias ,
              'pay_defined_contribution' => $pay->pay_defined_contribution ,
              'pay_fuel_charge' => $pay->pay_fuel_charge ,
              'pay_professional_tax' => $pay->pay_professional_tax ,
              'pay_income_tax' => $pay->pay_income_tax ,
               'pay_grain_adv' => $pay->pay_grain_adv ,
              'pay_festival_adv' => $pay->pay_festival_adv ,
               'pay_other_adv' => $pay->pay_other_adv,
              'pay_house_loan' => $pay->pay_house_loan,
              'pay_car_loan' => $pay->pay_car_loan,
              'pay_house_rent' => $pay->pay_house_rent,
              'pay_total_cut' => $pay->pay_total_cut,
               'pay_total' => $pay->pay_total_cut,
                'created_by' => $pay->created_by,
               );
   
         
     $this->db->insert("ft_pay_log_emp_salary", $datapay);
   # code...
            $nn = $_POST['pay_basic_new'] + $_POST['pay_grp_new'];
            $da = round(($nn *  $pay->salary_da)/100);

             $ts =$_POST['pay_basic_new'] + $_POST['pay_grp_new'] + $da + $pay->pay_special + $pay->pay_hra +
             $pay->pay_sa + $pay->pay_madical +$pay->pay_others + $pay->pay_special+ $pay->pay_ca +  $pay->pay_sp;

             $tc =  $pay->pay_dpf + $pay->pay_dpf_adv + $pay->pay_gpf + $pay->pay_gpf_adv + $pay->pay_gias + $pay->pay_defined_contribution + $pay->pay_fuel_charge + $pay->pay_income_tax+
             $pay->pay_professional_tax + $pay->pay_fuel_charge +$pay->pay_grain_adv  +$pay->pay_festival_adv + $pay->pay_house_rent + $pay->pay_other_adv + $pay->pay_house_loan + $pay->pay_car_loan ; 

               $tt = $ts - $tc;
   
      $datanew = array(
              
               'pay_basic'=>$_POST['pay_basic_new'],
               'pay_grp'=>$_POST['pay_grp_new'],
              'pay_da' => $da,
             'pay_total_sum' =>  $ts,
              'pay_total_cut' => $tc,
               'pay_total' => $tt,
                'updated_by' =>  $this->session->userdata('user_id'),
                'updated_at'=> date("Y-m-d h:i:s"),
               'no_updated'=> $pay->no_updated +1,
               'pay_remark' => "Samyaman Chnages"

               );
      
 $this->db->where("pay_id", $pay->pay_id);
      $this->db->update("ft_pay_emp_salary", $datanew);


    }
}
    function get_salararriays()
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



   foreach($output as $val) {
    // print_r();
     $nn = explode("|", $val['month']);
    $months .="'". $nn[0]."', ";
 

}

$string = rtrim($months, ", \t\n");


    
         $query = $this->db->query("SELECT * FROM `ft_pay_register` join ft_employee on ft_employee.emp_unique_id = ft_pay_register.pay_emp_unique_id
          WHERE pay_month IN (".$string.") and pay_salary_cate_id =".$_GET['cate_id']. "  ORDER BY `ft_employee`.`emp_order`,`ft_pay_register`.`pay_month_order` ASC");
         $rowid = $query->result();

        
      //echo $this->db->last_query();
      return $rowid;

    }
    function epayment()
    {
        $year = date("Y") ;
      $maonth = date("F") ;

 
  for($i=1;$i<=$_POST['countall'];$i++) {
  
 //print_r($_POST);

    $query = $this->db->query("SELECT * FROM `ft_pay_register`  WHERE   pay_start_month ='".$_POST['pay_month']. "'  and pay_end_month = '".$_POST['pay_month_end']. "' and   pay_arriyas_year = '".$_POST['pay_year']. "' and pay_arriyas_year_end =  '".$_POST['pay_year_end']. "'  and pay_arriyas=1  and pay_emp_unique_id =". $_POST['uincodes'.$i]);
         $rowid = $query->result();


         if(count($rowid) == 0)
         {
		 
		 if($this->uri->segment(3) == 1 || $this->uri->segment(3)== 2 )
		 {
				  $data = array(
					'pay_salary_cate_id'=> $this->uri->segment(3), 
				'pay_emp_unique_id' =>  $_POST['uincodes'.$i],
				'pay_month' => $maonth,
				'pay_year' =>$year,
				'pay_end_month' => $_POST['pay_month_end'],
				'pay_start_month' =>  $_POST['pay_month'],
				'pay_arriyas_year' =>  $_POST['pay_year'],
				'pay_arriyas_year_end' => $_POST['pay_year_end'],
				'pay_da' => $_POST['pay_diff'.$i],
				'pay_arriyas' =>1,
				   'created_by' =>  $this->session->userdata('user_id'),
				'pay_total_sum' =>  $_POST['pay_diff1'.$i],
			   'pay_total' => $_POST['pay_diff'.$i],
			   );
	   }else{
	   
	            $data = array(
            'pay_salary_cate_id'=> $this->uri->segment(3), 
        'pay_emp_unique_id' =>  $_POST['uincodes'.$i],
        'pay_month' => $maonth,
        'pay_year' =>$year,
        'pay_end_month' => $_POST['pay_month_end'],
        'pay_start_month' =>  $_POST['pay_month'],
        'pay_arriyas_year' =>  $_POST['pay_year'],
        'pay_arriyas_year_end' => $_POST['pay_year_end'],
        'pay_da' => $_POST['pay_diff'.$i],
		'pay_gpf'  => $_POST['gpf'.$i],
        'pay_arriyas' =>1,
		   'created_by' =>  $this->session->userdata('user_id'),
        'pay_total_sum' =>  $_POST['pay_diff'.$i],
		'pay_total_cut' =>  $_POST['gpf'.$i],
		
       'pay_total' => $_POST['caseamount'.$i],
			   );
			   }
// pre($data);echo "<br/>";
 $this->db->insert('ft_pay_register', $data); 
      }
	 
     }
          
       $data1 = array(
            'pay_arreas_cate_id'=>  $this->uri->segment(3), 
              'pay_month' => $maonth,
            'pay_year' =>$year,
            'pay_head_name' => 0,
            'pay_order_no' => $_POST['orderno'],
            'pay_d_duration' =>  $_GET['pay_month'].",".$_GET['pay_month_end'],
            'pay_c_duration' =>   $_GET['pay_month'].",".$_GET['pay_month_end'],
        
       );
          
      $this->db->insert('ft_pay_arreas_cate', $data1); 

    
      return true;

    }
    function zeroarriays()
    {
      foreach ($_GET['unicode'] as $key => $value) {
        # code...
       
          $data = array(
    
        'pay_emp_unique_id' => $value,
 
       );
     //     pre($data);echo "<br/>";
       $this->db->insert('ft_pay_register', $data); 


      }


    }
    function getarrias()
    {$cate_id = $this->uri->segment(3);
      $month = $this->uri->segment(4);
	    $atype = $this->uri->segment(5);
		
         $query = $this->db->query("SELECT * FROM `ft_pay_register` join ft_employee on ft_employee.emp_unique_id = ft_pay_register.pay_emp_unique_id 
          WHERE  pay_salary_cate_id =".$cate_id. " and pay_month =  '".$month. "' and pay_arriyas_type = '".$atype."' and pay_year = 2016 and pay_arriyas=1  GROUP by ft_employee.emp_unique_id ORDER BY `ft_employee`.`emp_order` ASC");
         $rowid = $query->result();
      //   echo $this->db->last_query();
           return $rowid;

    }
    function epaymentgpf()
    {
  
$query23 = $this->db->query("SELECT * FROM `ft_pay_register` join ft_employee on ft_employee.emp_unique_id = ft_pay_register.pay_emp_unique_id 
          WHERE  pay_salary_cate_id =".$_POST['cate_id']. " and   pay_start_month ='".$_POST['pay_month']. "'  and pay_end_month = '".$_POST['pay_month_end']. "' and
           pay_arriyas_year = '".$_POST['pay_year']. "' and pay_arriyas_year_end =  '".$_POST['pay_year_end']. "' and  pay_arriyas=1  and  pay_arriyas_type=1 GROUP by ft_employee.emp_unique_id ORDER BY `ft_employee`.`emp_order` ASC");
         $rowid23 = $query23->result();

		  if(count($rowid23) == 0){
	 // print_r($_POST);
	//	die();
		   $year = date("Y") ;
			  $maonth = date("F") ;
			$da=  $_POST['da'];
			$gpf = "";
			foreach ($_POST['da'] as $value) {
			
			
			  # code...
		
			  $uni= explode("|", $value);
	
		
			  foreach ($_POST['gpf'] as $key => $gval) {
		
				$gpf .= "'".$gval."',";
		
				# code...
			  }

				$epayment = "";
			  foreach ($_POST['epayment'] as $key => $eval) {
		
				$epayment .= "'".$eval."',";
				# code...
			  }

			$stringe = rtrim($epayment, ", \t\n");
			
			
			$string = rtrim($gpf, ", \t\n");
			

			
			$querye = $this->db->query("SELECT * FROM `ft_pay_register` join ft_employee on ft_employee.emp_unique_id = ft_pay_register.pay_emp_unique_id
					  WHERE pay_month IN (".$stringe.") and pay_salary_cate_id =".$_POST['cate_id']. " and  pay_emp_unique_id=". $uni[1]."  ORDER BY `ft_employee`.`emp_order` ASC");
					 $rowide = $querye->result();
      		   $epayment1 =0;
         foreach ($rowide as $key => $paye) {
  			$nbasic = $paye->pay_basic + $paye->pay_grp;
            $newpre = getdavalnew($_POST['cate_id'])[0]->salary_da; 
            $nda = round(($nbasic * $newpre)/100);
    
            $diff = $nda - $paye->pay_da;
            $epayment1= $diff + $epayment1;
            

         }
   

         $query = $this->db->query("SELECT * FROM `ft_pay_register` join ft_employee on ft_employee.emp_unique_id = ft_pay_register.pay_emp_unique_id
          WHERE pay_month IN (".$string.") and pay_salary_cate_id =".$_POST['cate_id']. " and  pay_emp_unique_id=". $uni[1]."  ORDER BY `ft_employee`.`emp_order` ASC");
         $rowid = $query->result();
	
        $gpf1=0;
         foreach ($rowid as $key => $pay) {
           # code...
            $nbasic = $pay->pay_basic + $pay->pay_grp;
            $newpre =getdavalnew($_POST['cate_id'])[0]->salary_da; 
            $nda = round(($nbasic * $newpre)/100);
           
            $diff = $nda - $pay->pay_da;
             $gpf1= $diff + $gpf1;
            //echo "-----<br/>";
         }
 ///   echo  "<br/> GPF ----".@$gpf1."----<br/>epayment -- ".@$epayment1."-----<br/>";
  
$pay_da = $gpf1 + $epayment1 ;


          $data = array(
		  'pay_date' => date("Y-m-d"),
		  'pay_arriyas_type' =>1,
            'pay_salary_cate_id'=> $_POST['cate_id'], 
        'pay_emp_unique_id'  => $uni[1],
		'pay_month' =>date("F"),
		'pay_year' =>date("Y"),
		'pay_basic'=>$_POST['pay_basic'.$uni[1]],
			'pay_grp'=>$_POST['pay_grp'.$uni[1]],
			'pay_da'=> $_POST['pay_da_new'.$uni[1]],
        'pay_year' =>  $_POST['pay_year'],
      'pay_diff' => $_POST['arreas'.$uni[1]],
       'orderno'=> $_POST['orderno'],
	   'created_by'=> $this->session->userdata('user_id')
       );
      
     $this->db->insert('ft_pay_arreas_paper', $data); 
	 
	 
	    echo $this->db->last_query(); 
	 
		 if($this->uri->segment(3) == 1 || $this->uri->segment(3)== 2 || $this->uri->segment(3)== 13 || $this->uri->segment(3)== 14 )
		 {
				  $data = array(
					'pay_salary_cate_id'=> $_POST['cate_id'], 
					'pay_arriyas_name'=> 'DA Arrear',
					'pay_arriyas_type' =>1,
				'pay_emp_unique_id' =>  $uni[1],
			'pay_month' =>date("F"),
		'pay_year' =>date("Y"),
				'pay_end_month' => $_POST['pay_month_end'],
				'pay_start_month' =>  $_POST['pay_month'],
				'pay_arriyas_year' =>  $_POST['pay_year'],
				'pay_arriyas_year_end' => $_POST['pay_year_end'],
				'pay_da' => $_POST['arreas'.$uni[1]],
				'pay_arriyas' =>1,
				   'created_by' =>  $this->session->userdata('user_id'),
				'pay_total_sum' => $_POST['arreas'.$uni[1]],
			   'pay_total' => $_POST['arreas'.$uni[1]],
			   );
	   }else{
	   
	            $data = array(
            'pay_salary_cate_id'=> $_POST['cate_id'], 
			'pay_arriyas_name'=> 'DA Arrear',
			'pay_arriyas_type' =>1,
        'pay_emp_unique_id' =>   $uni[1],
     	'pay_month' =>date("F"),
		'pay_year' =>date("Y"),
        'pay_end_month' => $_POST['pay_month_end'],
        'pay_start_month' =>  $_POST['pay_month'],
        'pay_arriyas_year' =>  $_POST['pay_year'],
        'pay_arriyas_year_end' => $_POST['pay_year_end'],
        'pay_da' => $_POST['arreas'.$uni[1]],
		'pay_gpf'  => $gpf1,
        'pay_arriyas' =>1,
		   'created_by' =>  $this->session->userdata('user_id'),
        'pay_total_sum' =>  $_POST['arreas'.$uni[1]],
		'pay_total_cut' =>  $gpf1,
		
       'pay_total' => $epayment1,
			   );
			   }
// pre($data);echo "<br/>";
 $this->db->insert('ft_pay_register', $data);
 
 
 
    }
	
    }
	  $data11 = array(
            'pay_arreas_cate_id'=>$_POST['cate_id'], 
             	'pay_month' =>date("F"),
		'pay_year' =>date("Y"),
            'pay_head_name' => 0,
            'pay_order_no' => $_POST['orderno'],
            'pay_d_duration' =>  $_POST['pay_month'].",".$_POST['pay_month_end'],
            'pay_c_duration' =>   $_POST['pay_month'].",".$_POST['pay_month_end'],
        
       );
          
      $this->db->insert('ft_pay_arreas_cate', $data11); 
          
          
    

        return true;
       

    }
	 function epaymentpp()
    {
  

   		foreach ($_POST['da'] as $value) {
  $uni= explode("|", $value);


          $data = array(
		  'pay_date' => date("Y-m-d"),
            'pay_salary_cate_id'=> $_POST['cate_id'], 
        'pay_emp_unique_id'  => $uni[1],
		'pay_arriyas_type' =>1,
		'pay_month' =>date("F"),
		'pay_year' =>date("Y"),
		'pay_basic'=>$_POST['pay_basic'.$uni[1]],
			'pay_grp'=>$_POST['pay_grp'.$uni[1]],
			'pay_da'=> $_POST['pay_da_new'.$uni[1]],
        'pay_year' =>  $_POST['pay_year'],
        'pay_diff' => $_POST['arreas'.$uni[1]],
       'orderno'=> $_POST['orderno'],
	   'created_by'=> $this->session->userdata('user_id')
       );
      
     $this->db->insert('ft_pay_arreas_paper', $data); 
	 
	 
	 
	
				  $data1 = array(
					'pay_salary_cate_id'=> $_POST['cate_id'], 
					'pay_arriyas_name'=> 'DA Arrear',
				'pay_emp_unique_id' =>  $uni[1],
				'pay_month' =>date("F"),
		'pay_year' =>date("Y"),
				'pay_end_month' => $_POST['pay_month_end'],
				'pay_start_month' =>  $_POST['pay_month'],
				'pay_arriyas_year' =>  $_POST['pay_year'],
				'pay_arriyas_year_end' => $_POST['pay_year_end'],
				'pay_da' => $_POST['arreas'.$uni[1]],
				'pay_arriyas' =>1,
				   'created_by' =>  $this->session->userdata('user_id'),
				'pay_total_sum' =>  $_POST['arreas'.$uni[1]],
			   'pay_total' => $_POST['arreas'.$uni[1]],
			   );
	   
// pre($data);echo "<br/>";
 $this->db->insert('ft_pay_register', $data1);

    }
   
	  $data11 = array(
            'pay_arreas_cate_id'=>  $_POST['cate_id'], 
             	'pay_month' =>date("F"),
		'pay_year' =>date("Y"),
            'pay_head_name' => 0,
            'pay_order_no' => $_POST['orderno'],
            'pay_d_duration' =>  $_POST['pay_month'].",".$_POST['pay_month_end'],
            'pay_c_duration' =>   $_POST['pay_month'].",".$_POST['pay_month_end'],
        
       );
          
      $this->db->insert('ft_pay_arreas_cate', $data11); 
        return true;
     
    }
	
	function updatepapaer($id)
	{
	      $data = array(
           
     		'pay_basic'=>$_POST['basic'],
			'pay_grp'=>$_POST['pay_grp'],
     		 'pay_da_new' => $_POST['pay_didi'],
            'pay_dd' =>$_POST['gpf'],
        'pay_case' => $_POST['caseamount'], 
		'updated_by' =>  $this->session->userdata('user_id'),
                'updated_at'=> date("Y-m-d h:i:s"),
               'no_updated'=> $_POST['no_updated'] + 1,
       );
       $this->db->where("pay_id", $_POST['pay_id']);
     $this->db->update('ft_pay_arreas_paper', $data); 
    }
	
	
	function getarrias_papper($id,$m)
	{
              $t = $this->uri->segment(5);    
              
	  $query = $this->db->query("SELECT * FROM `ft_employee` join ft_pay_arreas_paper on ft_employee.emp_unique_id = ft_pay_arreas_paper.pay_emp_unique_id where pay_month = '".$m."' and pay_arriyas_type =".$t." and	pay_year = 2016 and  pay_salary_cate_id =".$id." ORDER BY `ft_employee`.`emp_order` ASC");
	  //SELECT * FROM `ft_employee` join ft_pay_arreas_paper on ft_employee.emp_unique_id = ft_pay_arreas_paper.pay_emp_unique_id where pay_month = 'June' and pay_arriyas_type =1 and pay_year = 2016 and pay_salary_cate_id =3 ORDER BY `ft_employee`.`emp_order` ASC
         $rowid = $query->result();
   //  echo $this->db->last_query();
		 return $rowid;
	}
        
function addptremarks()
{

     if(isset($_POST['checkvalgpf']))
       {
      # code...
           $uid  = explode(",",$_POST['checkvalgpf']);


           
            foreach ($uid as $key => $pay) {

       
          
              $datanew = array(
                        
                         'pay_pt_remarks'=>$_POST['marks'],
                                                 'updated_by' =>  $this->session->userdata('user_id'),
                          'updated_at'=> date("Y-m-d h:i:s"),
                       

                         );
            
                
           $this->db->where("pay_id",  $pay);
             $this->db->update("ft_pay_register", $datanew);
         
      }
     }
    }//////////////////////Arrias code
	function addremarksindb($id)
	{
	         $datanew = array(
                        
                         'pay_remark'=>$_POST['pay_remark'],
                           'updated_by' =>  $this->session->userdata('user_id'),
                          'updated_at'=> date("Y-m-d h:i:s"),
                       

                         );
            
                
           $this->db->where("pay_id",  $id);
             $this->db->update("ft_pay_register", $datanew);
			  echo $this->db->last_query();
	}
	function empyearlyincementdata()
	{
	
	//SELECT * FROM `ft_pay_emp_salary` JOIN ft_employee on ft_employee.emp_unique_id = ft_pay_emp_salary.pay_emp_unique_id join ft_pay_maan_master on ft_pay_maan_master.pay_grade = ft_pay_emp_salary.pay_grp
	     $t = $this->uri->segment(3);    
              
	  $query = $this->db->query("SELECT * ,ft_pay_increment_month.pay_basic as basic ,ft_pay_increment_month.pay_grp  as grp ,ft_pay_emp_salary.pay_basic as basic1 , ft_pay_emp_salary.pay_grp as grp1 FROM `ft_pay_emp_salary` JOIN ft_employee on ft_employee.emp_unique_id = ft_pay_emp_salary.pay_emp_unique_id join ft_pay_increment_month on ft_employee.emp_unique_id = ft_pay_increment_month.pay_emp_unique_id Join ft_pay_maan_master on ft_pay_maan_master.pay_grade = ft_pay_emp_salary.pay_grp where ft_pay_emp_salary.pay_salary_cate_id =".$t." ORDER BY `ft_employee`.`emp_order` ASC");
	  //SELECT * FROM `ft_employee` join ft_pay_arreas_paper on ft_employee.emp_unique_id = ft_pay_arreas_paper.pay_emp_unique_id where pay_month = 'June' and pay_arriyas_type =1 and pay_year = 2016 and ft_pay_emp_salary.pay_salary_cate_id =3 ORDER BY `ft_employee`.`emp_order` ASC
         $rowid = $query->result();
//echo $this->db->last_query();
		 return $rowid;
	}
	function addremarksindbincr($id)
	{
	          $datanew = array(
                        'pay_basic'=>$_POST['pay_basic'],
                         'pay_remarkinc'=>$_POST['pay_remark'],
						 'pay_incr_status'=>$_POST['pay_incr_status'],
                           'updated_by' =>  $this->session->userdata('user_id'),
                          'updated_at'=> date("Y-m-d h:i:s"),
                       

                         );
           $this->db->where("pay_emp_unique_id",  $id);
             $this->db->update("ft_pay_increment_month", $datanew);
	
	}
		public function check_pay_bill_exist()
	{
		if($this->input->post('pay_type') == 0){
			$this->db->where(	'pbill_type' 	, $this->input->post('pay_type') );
			$this->db->where(	'pbill_cate_id' 	, $this->input->post('pay_head') );
			$this->db->where(	'pbill_month' 	, $this->input->post('pay_month') );
			$this->db->where(	'pbill_year' 	, $this->input->post('pay_year') );
		
		}elseif($this->input->post('pay_type') == 1){
			$this->db->where(	'pbill_type' 	, $this->input->post('pay_type') );
			$this->db->where(	'pbill_emp_code' 	, $this->input->post('emp_uinq') );
			$this->db->where(	'pbill_cate_id' 	, $this->input->post('pay_head') );
			$this->db->where(	'pbill_month' 	, $this->input->post('pay_month') );
			$this->db->where(	'pbill_year' 	, $this->input->post('pay_year') );
		}else{
			$this->db->where(	'pbill_type' 	, $this->input->post('pay_type') );
			$this->db->where(	'pbill_month' 	, $this->input->post('pay_month') );
			$this->db->where(	'pbill_year' 	, $this->input->post('pay_year') );
		}
		$query = $this->db->get('ft_pay_bill_cate');
		$row_count = $query->num_rows();
		//echo $this->db->last_query(); die;
		return $row_count;
		
	}
	public function get_leave_approve_emp()
	{
		$this->db->select('pay_emp_unique_id');
		$this->db->where('pay_billno',NULL);
		$this->db->where('pay_back_date',1);
		$this->db->group_by('pay_emp_unique_id');
		$query = $this->db->get('ft_pay_register');
		$rows = $query->result();
		return $rows;
	}
	public function get_transfer_emp()
	{
		
		$this->db->select('pay_emp_unique_id');
		$this->db->where('pay_billno',NULL);
		$this->db->where('pay_back_date',2);
		$this->db->group_by('pay_emp_unique_id');
		$query = $this->db->get('ft_pay_register');
		$rows = $query->result();
		return $rows;
	}
	function salaryincr()
	{
	  $query = $this->db->query("SELECT * ,ft_pay_increment_month.pay_basic as basic ,ft_pay_increment_month.pay_grp  as grp ,ft_pay_emp_salary.pay_basic as basic1 , ft_pay_emp_salary.pay_grp as grp1 
	  FROM `ft_pay_emp_salary` JOIN ft_employee on ft_employee.emp_unique_id = ft_pay_emp_salary.pay_emp_unique_id join ft_pay_increment_month on ft_employee.emp_unique_id = ft_pay_increment_month.pay_emp_unique_id Join 
	  ft_pay_maan_master on ft_pay_maan_master.pay_grade = ft_pay_emp_salary.pay_grp ORDER BY `ft_employee`.`emp_order` ASC");
	  //SELECT * FROM `ft_employee` join ft_pay_arreas_paper on ft_employee.emp_unique_id = ft_pay_arreas_paper.pay_emp_unique_id where pay_month = 'June' and pay_arriyas_type =1 and pay_year = 2016 and ft_pay_emp_salary.pay_salary_cate_id =3 ORDER BY `ft_employee`.`emp_order` ASC
        $rowid  = $query->result();
		 foreach ($rowid  as $key => $pay) {
		if($pay->pay_incr_status == 1 ){
		$pay1 = $pay->basic1 + $pay->grp1; $payincr = $pay1 * 3;
				
					$payaddval = floor($payincr/100);
					 $number = ceil($payaddval / 10) * 10;
		
			$pay_new =  $pay->basic1 + $number  + $pay->grp1;  
			$da  = getdavalnew($pay->emp_pay_cate_id)[0]->salary_da; 
			$hra  = getdavalnew($pay->emp_pay_cate_id)[0]->salary_hra; 
			$pay_da = round(($pay_new * $da)/100);
			if(	$pay->pay_hra != 0 )
			{
				$pay_hra = round(($pay_new * $hra)/100);
				
			}else{
				
				$pay_hra = 0;
			}
	if(	$pay->pay_defined_contribution != 0 )
			{$pay_nda =$pay_da +$pay_new;
				$pay_dd = round(($pay_nda * $hra)/100);
				
			}else{
				
				$pay_dd = 0;
			} 
			$ts =$pay->basic1 + $number + $pay->grp1 + $pay_da  + $pay->pay_special + $pay_hra +
             $pay->pay_sa + $pay->pay_madical +$pay->pay_others + $pay->pay_special+ $pay->pay_ca +  $pay->pay_sp;

             $tc =  $pay->pay_dpf + $pay->pay_dpf_adv + $pay->pay_gpf + $pay->pay_gpf_adv + $pay->pay_gias + $pay_dd + $pay->pay_fuel_charge + $pay->pay_income_tax+
             $pay->pay_professional_tax + $pay->pay_fuel_charge +$pay->pay_grain_adv  +$pay->pay_festival_adv + $pay->pay_house_rent + $pay->pay_other_adv + $pay->pay_house_loan + $pay->pay_car_loan ; 

               $tt = $ts - $tc;
			 
          $datapay = array(
              
               'pay_basic' =>   $pay->basic1 + $number , 
              'pay_da' => $pay_da,
         
              'pay_hra' =>$pay_hra,
			  'pay_defined_contribution'=>$pay_dd,
 
               'pay_total_sum' =>  $ts,
			  'pay_total_cut' =>$tc,
			   'pay_total' => $tt,
				'updated_by' => $this->session->userdata('user_id'),
				'updated_at' =>date("Y-m-d H:i:s"),
               );echo $pay->pay_emp_unique_id;
		//
		 $this->db->where("pay_emp_unique_id",  $pay->pay_emp_unique_id);
             $this->db->update("ft_pay_emp_salary", $datapay);
		
		}
		}
	
	
	}function pay_slary_register()
	{

	if($this->uri->segment(3) != "lpc")
	{	
		$pay_arriyas_year_end = date("Y",strtotime($this->input->post('enddate')));
		$pay_end_month = date("F",strtotime($this->input->post('enddate')));
		$pay_start_month = date("F",strtotime($this->input->post('stardate')));
		$pay_arriyas_year= date("Y",strtotime($this->input->post('stardate')));
		$pay_arriyas_satrdate = date("Y-m-d",strtotime($this->input->post('stardate')));
		$pay_arriyas_enddate = date("Y-m-d",strtotime($this->input->post('enddate')));
        $datapay = array(
                'pay_emp_unique_id' => $this->input->post('uid'),
                'pay_salary_cate_id' => $this->input->post('pay_salary_cate_id'),
				'pay_arriyas' => 1,
				 'pay_arriyas_name' => $this->input->post('arreasname'),
              'pay_arriyas_year_end	' =>$pay_arriyas_year_end,
              'pay_month_given' => date("F"),
              'pay_end_month' =>$pay_end_month ,
			  'pay_start_month' =>$pay_start_month ,
			  'pay_arriyas_year' =>$pay_arriyas_year,
			  'pay_arriyas_satrdate'=>$pay_arriyas_satrdate,
			    'pay_arriyas_enddate'=>$pay_arriyas_enddate,
			    'pay_month' => date("F"),
				'pay_year' => date("Y"),
                 'pay_basic' => $this->input->post('pay_basic'),
              'pay_grp' =>$this->input->post('pay_gradepay'),
              'pay_da' => $this->input->post('pay_da'),
              'pay_special' =>$this->input->post('pay_special') ,
              'pay_hra' =>$this->input->post('pay_hra'),
              'pay_sa' => $this->input->post('pay_sa'),
              'pay_madical' =>$this->input->post('pay_madical'),
              'pay_special' =>  $this->input->post('pay_special'),
              'pay_others' => $this->input->post('pay_others'),
               'pay_ca' => $this->input->post('pay_ca'),
              'pay_sp' => $this->input->post('pay_sp'),
               'pay_total_sum' => $this->input->post('pay_total_sum') ,
               'pay_dpf' => $this->input->post('pay_dpf') ,
               'pay_gpf' =>  $this->input->post('pay_gpf'),
				'pay_defined_contribution' => $this->input->post('pay_define'),
              'pay_income_tax' =>$this->input->post('pay_income_tax'),
   				'pay_other_adv' =>$this->input->post('pay_other_adv'),
			  'pay_total_cut' => $this->input->post('pay_total_cut'),
			   'pay_total' => $this->input->post('pay_total'),
			   'pay_remark' => $this->input->post('pay_remark'),
				  'pay_remark' => $this->input->post('pay_remark'),
		     'pay_month_given'=> date("F"),
				 'pay_month_order'=> date("m"),
				  'pay_year_given' =>date('Y'),
        'created_by' => $this->session->userdata('user_id'),
       
               );
		
					//pr($datapay);die();
			  	 $this->db->insert("ft_pay_register", $datapay);
				 $payid =$this->db->insert_id();
	  }else{
			  
			  
				  $this->db->from('ft_pay_register');
				  $this->db->where("pay_emp_unique_id", $this->input->post('uid'));
				   $this->db->where("pay_month",$this->input->post("pay_month"));
				  $this->db->where("pay_year",$this->input->post("pay_year"));
				    $this->db->where("pay_arriyas",0);
				   $query = $this->db->get();
				echo $this->db->last_query();
					$rows = $query->result();
					/*
					if(count($rows) == 0 || $rows[0]->pay_basic == 0  ) {
			       		*/
				   
					     $datapay = array(
		                'pay_emp_unique_id' => $this->input->post('uid'),
		                'pay_salary_cate_id' => $this->input->post('pay_salary_cate_id'),
		              	'pay_month_given' =>$this->input->post("pay_month"),
					    'pay_month' =>$this->input->post("pay_month"),
						'pay_year' => $this->input->post("pay_year"),
		                'pay_basic' => $this->input->post('pay_basic'),
						'pay_grp' =>$this->input->post('pay_gradepay'),
						'pay_da' => $this->input->post('pay_da'),
						'pay_special' =>$this->input->post('pay_special') ,
						'pay_hra' =>$this->input->post('pay_hra'),
						'pay_sa' => $this->input->post('pay_sa'),
						'pay_madical' =>$this->input->post('pay_madical'),
						'pay_special' =>  $this->input->post('pay_special'),
						'pay_others' => $this->input->post('pay_others'),
						'pay_ca' => $this->input->post('pay_ca'),
						'pay_sp' => $this->input->post('pay_sp'),
						'pay_total_sum' => $this->input->post('pay_total_sum') ,
						'pay_dpf' => $this->input->post('pay_dpf') ,
						'pay_gpf' =>  $this->input->post('pay_gpf'),
						'pay_defined_contribution' => $this->input->post('pay_define'),
						'pay_income_tax' =>$this->input->post('pay_income_tax'),
						'pay_professional_tax' =>$this->input->post('pay_professional_tax'),
						'pay_fuel_charge' =>$this->input->post('pay_fule_charge'),
						'pay_house_rent' =>$this->input->post('pay_house_rent'),
						'pay_gias' =>$this->input->post('pay_gias'),
						'pay_other_adv' =>$this->input->post('pay_other_adv'),
		    			'pay_total_cut' => $this->input->post('pay_total_cut'),
		       			'pay_total' => $this->input->post('pay_total'),
			   		    'pay_remark' => $this->input->post('pay_remark'),
				        'pay_month_given'=> date("F"),
						 'pay_month_order'=> date("m"),
						  'pay_year_given' =>date('Y'),
							   'pay_year_given' =>date('Y'),
							 'pay_back_date'=> 5,
		                'created_by' => $this->session->userdata('user_id'),
		       
		               );
					
					  $this->db->insert("ft_pay_register", $datapay);	
					 $payid =$this->db->insert_id();
					 //  echo $this->db->last_query();
				   
				  /* }else{
					    $payid =0;
					   
				 }*/
			 
			   }
        	
				 if($payid != 0 ){
		
			  $query = $this->db->query("SELECT * from ft_pay_bill_cate where pbill_computer_no=".$this->input->post('computer_bill_number')." and pbill_office_no=".$this->input->post('office_bill_number'));
	  //SELECT * FROM `ft_employee` join ft_pay_arreas_paper on ft_employee.emp_unique_id = ft_pay_arreas_paper.pay_emp_unique_id where pay_month = 'June' and pay_arriyas_type =1 and pay_year = 2016 and ft_pay_emp_salary.pay_salary_cate_id =3 ORDER BY `ft_employee`.`emp_order` ASC
        $rowid  = $query->row();  
        
        
				$data = array('pbill_month' => date('F') ,
					'pbill_cate_id' => $this->input->post('pay_salary_cate_id'),
					'pbill_emp_code' =>	$this->input->post('uid') ,
					'pbill_computer_date' =>date("Y-m-d",strtotime($this->input->post('computer_bill_date'))) ,
					'pbill_type' => 1 ,
					'pbill_year' => date("Y") ,
					'pbill_gross_amount' => $this->input->post('bill_grossamount'),
					'pbill_net_amont' => $this->input->post('bill_netamount') ,
					'pbill_computer_no' => $this->input->post('computer_bill_number') ,
				  	'pbill_office_no' => $this->input->post('office_bill_number') ,
				   	'pbill_vocher_no' => $this->input->post('vocher_bill_number') ,
				  	'pbill_vocher_date' => date("Y-m-d",strtotime($this->input->post('vocher_bill_date'))) ,
				   );
				
				 if(count($rowid) == 0){
				 $this->db->insert("ft_pay_bill_cate" ,$data);
				 $billno= $this->db->insert_id();
				 }else{
				 $billid = $rowid->pbill_id;
					   $this->db->where("pbill_id", $billid);
			 		 $this->db->update("ft_pay_bill_cate" ,$data);
					 	 $billno= $billid ;
					}
               


			  $data2 = array(
								'pay_billno' =>  $billno,
						   
						   );
					  $this->db->where("pay_id", $payid);
			 
				  $this->db->update("ft_pay_register", $data2);
				}

	}
	function edit_pay_slary_register()
	{

	if($this->uri->segment(3) != "lpc")
	{	
		$pay_arriyas_year_end = date("Y",strtotime($this->input->post('enddate')));
		$pay_end_month = date("F",strtotime($this->input->post('enddate')));
		$pay_start_month = date("F",strtotime($this->input->post('stardate')));
		$pay_arriyas_year= date("Y",strtotime($this->input->post('stardate')));
		$pay_arriyas_satrdate = date("Y-m-d",strtotime($this->input->post('stardate')));
		$pay_arriyas_enddate = date("Y-m-d",strtotime($this->input->post('enddate')));
        $datapay = array(
                'pay_emp_unique_id' => $this->input->post('uid'),
                'pay_salary_cate_id' => $this->input->post('pay_salary_cate_id'),
				'pay_arriyas' => 1,
				 'pay_arriyas_name' => $this->input->post('arreasname'),
              'pay_arriyas_year_end	' =>$pay_arriyas_year_end,
              'pay_month_given' => date("F"),
              'pay_end_month' =>$pay_end_month ,
			  'pay_start_month' =>$pay_start_month ,
			  'pay_arriyas_year' =>$pay_arriyas_year,
			  'pay_arriyas_satrdate'=>$pay_arriyas_satrdate,
			    'pay_arriyas_enddate'=>$pay_arriyas_enddate,
			    'pay_month' => date("F"),
				'pay_year' => date("Y"),
                 'pay_basic' => $this->input->post('pay_basic'),
              'pay_grp' =>$this->input->post('pay_gradepay'),
              'pay_da' => $this->input->post('pay_da'),
              'pay_special' =>$this->input->post('pay_special') ,
              'pay_hra' =>$this->input->post('pay_hra'),
              'pay_sa' => $this->input->post('pay_sa'),
              'pay_madical' =>$this->input->post('pay_madical'),
              'pay_special' =>  $this->input->post('pay_special'),
              'pay_others' => $this->input->post('pay_others'),
               'pay_ca' => $this->input->post('pay_ca'),
              'pay_sp' => $this->input->post('pay_sp'),
               'pay_total_sum' => $this->input->post('pay_total_sum') ,
               'pay_dpf' => $this->input->post('pay_dpf') ,
               'pay_gpf' =>  $this->input->post('pay_gpf'),
				'pay_defined_contribution' => $this->input->post('pay_define'),
              'pay_income_tax' =>$this->input->post('pay_income_tax'),
   				'pay_other_adv' =>$this->input->post('pay_other_adv'),
			  'pay_total_cut' => $this->input->post('pay_total_cut'),
			   'pay_total' => $this->input->post('pay_total'),
			   'pay_remark' => $this->input->post('pay_remark'),
				  'pay_remark' => $this->input->post('pay_remark'),
		     'pay_month_given'=> date("F"),
				 'pay_month_order'=> date("m"),
				  'pay_year_given' =>date('Y'),
        'updated_by' => $this->session->userdata('user_id'),
       'updated_at' => date("Y-m-d H:i:s")
               );
		
					//pr($datapay);die();
			$this->db->where("pay_id", $this->input->post('pay_edit'));
			  	 $this->db->update("ft_pay_register", $datapay);
				 $payid =$this->input->post('pay_edit');
	  }else{
			  
			  
				  $this->db->from('ft_pay_register');
				  $this->db->where("pay_emp_unique_id", $this->input->post('uid'));
				   $this->db->where("pay_month",$this->input->post("pay_month"));
				  $this->db->where("pay_year",$this->input->post("pay_year"));
				    $this->db->where("pay_arriyas",0);
				   $query = $this->db->get();
				echo $this->db->last_query();
					$rows = $query->result();
					/*
					if(count($rows) == 0 || $rows[0]->pay_basic == 0  ) {
			       		*/
				   
					     $datapay = array(
		                'pay_emp_unique_id' => $this->input->post('uid'),
		                'pay_salary_cate_id' => $this->input->post('pay_salary_cate_id'),
		              	'pay_month_given' =>$this->input->post("pay_month"),
					    'pay_month' =>$this->input->post("pay_month"),
						'pay_year' => $this->input->post("pay_year"),
		                'pay_basic' => $this->input->post('pay_basic'),
						'pay_grp' =>$this->input->post('pay_gradepay'),
						'pay_da' => $this->input->post('pay_da'),
						'pay_special' =>$this->input->post('pay_special') ,
						'pay_hra' =>$this->input->post('pay_hra'),
						'pay_sa' => $this->input->post('pay_sa'),
						'pay_madical' =>$this->input->post('pay_madical'),
						'pay_special' =>  $this->input->post('pay_special'),
						'pay_others' => $this->input->post('pay_others'),
						'pay_ca' => $this->input->post('pay_ca'),
						'pay_sp' => $this->input->post('pay_sp'),
						'pay_total_sum' => $this->input->post('pay_total_sum') ,
						'pay_dpf' => $this->input->post('pay_dpf') ,
						'pay_gpf' =>  $this->input->post('pay_gpf'),
						'pay_defined_contribution' => $this->input->post('pay_define'),
						'pay_income_tax' =>$this->input->post('pay_income_tax'),
						'pay_professional_tax' =>$this->input->post('pay_professional_tax'),
						'pay_fuel_charge' =>$this->input->post('pay_fule_charge'),
						'pay_house_rent' =>$this->input->post('pay_house_rent'),
						'pay_gias' =>$this->input->post('pay_gias'),
						'pay_other_adv' =>$this->input->post('pay_other_adv'),
		    			'pay_total_cut' => $this->input->post('pay_total_cut'),
		       			'pay_total' => $this->input->post('pay_total'),
			   		    'pay_remark' => $this->input->post('pay_remark'),
				        'pay_month_given'=> date("F"),
						'pay_month_order'=> date("m"),
					    'pay_year_given' =>date('Y'),
					    'pay_year_given' =>date('Y'),
					    'pay_back_date'=> 5,
		                'updated_by' => $this->session->userdata('user_id'),
      				    'updated_at' => date("Y-m-d H:i:s")
		       
		               );
					
						 $this->db->where("pay_id", $this->input->post('pay_edit'));
						 $this->db->update("ft_pay_register", $datapay);
						 $payid =$this->input->post('pay_edit');
					 	 echo $this->db->last_query();
				   
				  /* }else{
					    $payid =0;
					   
				 }*/
			 
			   }
        	
				 if($payid != 0 ){
		
			  $query = $this->db->query("SELECT * from ft_pay_bill_cate where pbill_computer_no=".$this->input->post('computer_bill_number')." and pbill_office_no=".$this->input->post('office_bill_number'));
	  //SELECT * FROM `ft_employee` join ft_pay_arreas_paper on ft_employee.emp_unique_id = ft_pay_arreas_paper.pay_emp_unique_id where pay_month = 'June' and pay_arriyas_type =1 and pay_year = 2016 and ft_pay_emp_salary.pay_salary_cate_id =3 ORDER BY `ft_employee`.`emp_order` ASC
        $rowid  = $query->row();  
        
        
				$data = array('pbill_month' => date('F') ,
					'pbill_cate_id' => $this->input->post('pay_salary_cate_id'),
					'pbill_emp_code' =>	$this->input->post('uid') ,
					'pbill_computer_date' =>date("Y-m-d",strtotime($this->input->post('computer_bill_date'))) ,
					'pbill_type' => 1 ,
					'pbill_year' => date("Y") ,
					'pbill_gross_amount' => $this->input->post('bill_grossamount'),
					'pbill_net_amont' => $this->input->post('bill_netamount') ,
					'pbill_computer_no' => $this->input->post('computer_bill_number') ,
				  	'pbill_office_no' => $this->input->post('office_bill_number') ,
				   	'pbill_vocher_no' => $this->input->post('vocher_bill_number') ,
				  	'pbill_vocher_date' => date("Y-m-d",strtotime($this->input->post('vocher_bill_date'))) ,
				   );
				
				 if(count($rowid) == 0){
				 $this->db->insert("ft_pay_bill_cate" ,$data);
				 $billno= $this->db->insert_id();
				 }else{
				 $billid = $rowid->pbill_id;
					   $this->db->where("pbill_id", $billid);
			 		 $this->db->update("ft_pay_bill_cate" ,$data);
					 	 $billno= $billid ;
					}
                $data2 = array(
								'pay_billno' =>  $billno,
						   	   );
					  $this->db->where("pay_id", $payid);
			 	  $this->db->update("ft_pay_register", $data2);
				}

	}
	function currentpayhead()
	{
 $this->db->select('emp_pay_cate_id');
      $this->db->from('ft_employee');
      $this->db->where("emp_unique_id",$this->uri->segment(3));
      // $this->db->where("pay_month",$pay_month);
      // $this->db->where("pay_year",$currentyear);
       $query = $this->db->get();
     //echo $this->db->last_query();
   return $rows = $query->result();
		
	}
	function get_pay($id)
	{
	
      $this->db->from('ft_pay_register');
      $this->db->where("pay_id",$id);
      $query = $this->db->get();
    //echo $this->db->last_query();
   return $rows = $query->result();
	}
	function get_bill($id)
	{
	
      $this->db->from('ft_pay_bill_cate');
      $this->db->where("pbill_id",$id);
      $query = $this->db->get();
    //echo $this->db->last_query();
   return $rows = $query->result();
	}
}


?>