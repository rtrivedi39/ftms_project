<?php

function es_file_marktype(){
    $mark_types = array(
        '3' => 'स्थापना (Establishment)',
        '1' => 'अनुभाग (Section)',
        '2' => 'व्यक्तिगत (Personal)',
    );
    return $mark_types;
}

function get_establishment_employees($withso = true){
	if($withso){
		return get_list(EMPLOYEES, 'emp_full_name_hi', "FIND_IN_SET('7',`emp_section_id`) AND role_id IN(8,17,18,22,23,24,37) AND emp_status ='1' AND emp_is_retired = '0' and 	 emp_posting_location =1", 'ASC');
	} else {
		return get_list(EMPLOYEES, 'emp_full_name_hi', "FIND_IN_SET('7',`emp_section_id`) AND role_id IN(17,18,22,23,24,37) AND emp_status ='1' AND emp_is_retired = '0' and 	 emp_posting_location =1", 'ASC');
	}
}

function check_est_so(){
	if((checkUserrole() == 8 || checkUserrole() == 37) && in_array('7', explode(',',getEmployeeSection()))){
		return true;
	} else{
		return false;
	}
}

function check_est_emplyee(){
	if(in_array(checkUserrole(), array(8,17,18,22,23,24,37)) && in_array('7', explode(',',getEmployeeSection()))){
		return true;
	} else{
		return false;
	}
}



function complaint_type($id = '', $every = '1', $onlyparent = false){
	if($onlyparent){
		$onlyparent = 'AND parent_category_id IS NULL';
	}else{
		$onlyparent = '';
	}
    if($id == ''){
        return get_list(EST_CATEGORY_MASTER, 'master_category_id', "is_every_emp_create = '$every' $onlyparent ");
    } else {		
        $complaint_type = get_list(EST_CATEGORY_MASTER, 'master_category_id', array('master_category_id' => $id));
        if(count($complaint_type) > 0){
            return $complaint_type[0];
        } else {
            return 'N/A';
        }
    }
}

function get_parent_category($id){
    $category = get_list(EST_CATEGORY_MASTER, 'master_category_id', array('master_category_id' => $id));
    $parent_category_id = $category[0]['parent_category_id'];
    if($parent_category_id != ''){
        $rid = $parent_category_id;
    } else{
        $rid = $id;
    }
    return $rid;
}

function complaint_withparent_type($id = '', $every = '1'){
	if($id == ''){
		$complaint_type = get_list(EST_CATEGORY_MASTER, 'master_category_id', array('is_every_emp_create' => $every));
	} else {
		$complaint_type = get_list(EST_CATEGORY_MASTER, 'master_category_id', array('is_every_emp_create' => $every, 'master_category_id' => $id));
	}
	return $complaint_type;
}

function get_child_categories($prtid,$only_active = false){
    if($only_active == true){
        $con = array('parent_category_id' => $prtid , 'active_status' => '1');
    }else{
        $con = array('parent_category_id' => $prtid);
    }
    return  get_list(EST_CATEGORY_MASTER, 'master_category_id', $con);

}

function get_category_allote_emp($cat_id , $multi_result = false){
	$ci = & get_instance();
	$tbl_work_allote = EST_WORK_ALLOTE;
	$ci->db->select('est_word_alloted_emp_id');	
	$where = "FIND_IN_SET('" . $cat_id . "', est_word_alloted_work_id)";
    $ci->db->where($where);
	$ci->db->from($tbl_work_allote);
	$ci->db->order_by('est_word_alloted_id', 'ASC');
	$query = $ci->db->get();
	//echo $ci->db->last_query();	
	if($query->num_rows() != '')
	{          
	if($multi_result == true){
            $result = $query->result_array();
            return $result ;
        }else{
            $row = $query->row_array();
            return $row['est_word_alloted_emp_id'];
        }
	}
	else{
		return FALSE;
	}
}

//return or true false or all ids
function is_every_empcreate($id){
    $cancreate = get_list(EST_CATEGORY_MASTER, 'master_category_id', array('master_category_id' => $id));
    $is_every_emp_create = $cancreate[0]['is_every_emp_create'];
    if($is_every_emp_create == 1){
        $can = true;
    } else{
        $can = false;
    }
    return $can;
}

function get_complaint_status($status){
	if($status == 1){
		return '<label class="label label-success">Finished</label>';
	} else {
		return '<label class="label label-warning">Pending</label>';
	}

}

function information_type($type = ''){
	$information_type = array(
		1 => 'लिखित',
		2 => 'मौखित',
		3 => 'अन्य',
	);
	if($type == ''){
		return $information_type;
	} else {
		if (array_key_exists($type, $information_type)) {
			return $information_type[$type];
		} else {
			return 'Non';
		}
	}
}


function get_employee_name_dd($name , $attr = '',$selected = '')
{

    $CI = & get_instance();

    //$CI->db->where('emp_section_id',15);
    $CI->db->order_by('emp_full_name_hi','asc');
    $query = $CI->db->get(EMPLOYEES);
    $results = $query->result();
    //print_r($results);
    $dropdown = '<select '.$attr.' name="'.$name.'" id="'.$name.'">'."\n";

    $dropdown .= "<option value=''> --Select-- </option>";
    foreach($results as $result){
        if( $result !=''){

            $dropdown .= '<option  value='.$result->emp_id.'>'.$result->emp_full_name_hi.'</option>'."\n";
        }
    }

    $dropdown .= '</select>'."\n";

    /*** and return the completed dropdown ***/
    return $dropdown;

}

function upper_officers_list($task=null,$param=null){
    $CI = & get_instance();
    $CI->db->where('role_id <',8);
    $CI->db->where('role_id !=',1);
    $CI->db->where('emp_status',1);
	 $CI->db->where('emp_posting_location',1);
    $CI->db->where('emp_is_retired',0);
    //$CI->db->where_in(array('role_id'=>implode(',',$role_ids_array)));
    $CI->db->from(EMPLOYEES);
    $query = $CI->db->get();
    $emp_officer_list= $query->result_array();
    return $emp_officer_list;
}

//section no pluse one
function plusone_fileno_es($sectionid){
    $CI = & get_instance();
    $CI->db->select_max('section_number');
    $CI->db->where('section_id',$sectionid);
    $query = $CI->db->get(FILES_SECTION, 1);
    $result = $query->row_array();
    $CI->db->last_query();
    return $result['section_number'] + 1;
}

function es_file_billtype(){
    $billtype = array(
        '1' => 'स्वयं का बिल(Personal Bill)',
        '2' => 'विभाग बिल  (Department Bill)',
       
    );
    return $billtype;
}

function es_file_billcategory(){
    $billcategory = array(
        '1' => 'बिजली बिल(Electricity Bill)',
        '2' => 'पेट्रोल बिल  (Petrol Bill)',
        '3' => 'रिपेरिंग बिल  (Repairing Bill)',
		'4' => 'हॉउस रेंट बिल  (House rent Bill)',
		'5' => 'स्टेशनरी बिल  (Stationary  Bill)',
		
    );
    return $billcategory;
}

function est_file_types(){
	return array('f' => 'File , नस्ती',
	'l' => 'Letter , पत्र',
	'or' => 'Order , आदेश',
	'ah' => 'Ahran , आहरण',
	'bh' => 'Bhugtan , भुगतान',
	'o' => 'Other , अन्य',
	);
}

function get_establishment_employees_with_des($withso = true){
		$CI = & get_instance();
	if($withso){		
		$tbl1 = EMPLOYEES;
		$tbl2 = EMPLOYEE_DETAILS;
		$tbl3 = EMPLOYEEE_ROLE;
		$CI->db->select(EMPLOYEES .'.*,emp_detail_gender,emprole_name_hi');
		$CI->db->join($tbl2, "$tbl2.emp_id = $tbl1.emp_id", 'left');
		$CI->db->join($tbl3, "$tbl3.role_id = $tbl1.designation_id", 'left');

		$where = "FIND_IN_SET('7',`emp_section_id`) AND ft_employee.role_id IN(8,17,18,22,23,24,37) AND emp_status ='1' AND emp_is_retired = '0' and 	 emp_posting_location =1 ";
		$CI->db->where($where);
		$query = $CI->db->get($tbl1);
		//echo $CI->db->last_query();
		return $query->result();
	} else {
	$tbl1 = EMPLOYEES;
		$tbl1 = EMPLOYEES;
		$tbl2 = EMPLOYEE_DETAILS;
		$tbl3 = EMPLOYEEE_ROLE;
		$CI->db->select(EMPLOYEES .'.*,emp_detail_gender,emprole_name_hi');
		$CI->db->join($tbl2, "$tbl2.emp_id = $tbl1.emp_id", 'left');
		$CI->db->join($tbl3, "$tbl3.role_id = $tbl1.designation_id", 'left');

		$where = "FIND_IN_SET('7',`emp_section_id`) AND ft_employee.role_id IN(8,17,18,22,23,24,37) AND emp_status ='1' AND emp_is_retired = '0' and 	 emp_posting_location =1 ";
		$CI->db->where($where);
		$query = $CI->db->get($tbl1);
		//echo $CI->db->last_query();
		return $query->result();
	}
}
//////////////code add by monika

/////////code add by Monika
function getsum($tablename,$condi ,$column) 
{
    $CI = & get_instance();
    $sessionemp = emp_session_id();
    $query =   $CI->db->query("SELECT sum($column) as sum_val FROM ".$tablename." where ".$condi );
    $state_name = $query->row_array();
    //print_r($state_name);
    return $state_name;
}
function sumcolumn($fl ,$id, $month,$y)
{
//$y = 2017;

    $CI = & get_instance();
   $y =$CI->uri->segment("5");
    $sessionemp = emp_session_id();
    $query =   $CI->db->query("SELECT SUM(`".$fl."`) as val FROM ft_pay_register WHERE `pay_salary_cate_id`=".$id." and  pay_arriyas= 0 and pay_back_date= 0  and pay_month='".$month."' and pay_year='".$y."'" );
    $state_name = $query->row_array();
    //print_r($state_name); 
//echo $CI->db->last_query();  




    return $state_name;
}
function sumcolumn_one_emp($fl ,$id,$uid,$y)
{

    $CI = & get_instance();
    $sessionemp = emp_session_id();
	$string = rtrim($y, ", \t\n");

 
    $query =   $CI->db->query("SELECT SUM(`".$fl."`) as val FROM ft_pay_register WHERE pay_month in (".$string.") and pay_emp_unique_id=".$uid );

   
    $state_name = $query->row_array();
   //print_r($state_name);
   // echo $CI->db->last_query();
        
        
    return $state_name;




}
function deffentcolum($uid,$cm ,$pm,$fileid)
{

    $CI = & get_instance();
    $sessionemp = emp_session_id();
    $query =   $CI->db->query("SELECT (pay_basic - pay_basic) as a FROM `ft_pay_register` where `pay_month` in ('".$cm."' ,'".$pm."' ) and pay_emp_unique_id =". $uid );
    $state_name = $query->row_array();
   //print_r($state_name);
    return $state_name;

}


function getbillno()
{	$CI = & get_instance();
	 $query = $CI->db->get("ft_pay_bill_cate");
$pbilno = $query->result();
return $pbilno ;
}
function getbillnos($m,$c,$y,$t)
{	$CI = & get_instance();
	   $query =   $CI->db->query("SELECT * FROM `ft_pay_bill_cate` where pbill_month = '".$m."' and pbill_year = '".$y."' and pbill_cate_id = '".$c."' and pbill_type =". $t );
    $state_name = $query->result();
// echo $CI->db->last_query();
    return $state_name;

}
function inputcheckvaul($var)
{
   if(isset($_POST[$var]))
   {
    $var = $_POST[$var];
   }else{
     $var =0;
   }
   //echo  $var."<br/>";
   return $var;

}
function gethead($id)
{	$CI = & get_instance();
 //$CI->db->select('pay_cate_name');
    $CI->db->where('pay_cate_id',$id);
    $query = $CI->db->get("ft_pay_salary_category");
$pbilno = $query->result();
return $pbilno;
}
function getsalary($m,$y,$ui)
{
	$CI = & get_instance();
 $CI->db->select('*');
          $CI->db->from('ft_pay_register');
          $CI->db->join('ft_employee', 'ft_employee.emp_unique_id =  ft_pay_register.pay_emp_unique_id');
      $CI->db->where("pay_year",$y);
       $CI->db->where("pay_emp_unique_id",$ui);
     $CI->db->where("pay_month",$m);
     $query = $CI->db->get();
            
    //    echo $CI->db->last_query();
         $rows = $query->result();


        return $rows;


 }

 function emp_nmae($emp_unique_id)
 {

$CI = & get_instance();
 $CI->db->select('*');
          $CI->db->from('ft_employee');
          $CI->db->where("emp_unique_id",$emp_unique_id);
     
     $query = $CI->db->get();
            
    //    echo $CI->db->last_query();
         $rows = $query->result();


        return $rows;


 }
 function sumcolumn_one_emp1($fl ,$id,$uid)
{

    $CI = & get_instance();
    $sessionemp = emp_session_id();
    $query =   $CI->db->query("SELECT SUM(`".$fl."`) as val FROM ft_pay_register WHERE  pay_back_date =1 and pay_emp_unique_id=".$uid );

   
    $state_name = $query->row_array();
   //print_r($state_name);

        
        
    return $state_name;




}function last_month($m)
{
 if($m = "May")
 {
  $last_month= "April";
 }elseif($m = "April")
 {
  $last_month= "March";
 }elseif($m = "March")
 {
  $last_month= "February";
 }elseif($m = "February")
 {
  $last_month= "January";
 }
elseif($m = "January")
 {
  $last_month= "December";
 }elseif($m = "December")
 {
  $last_month= "November";
 }elseif($m = "November")
 {
  $last_month= "October";
 }elseif($m = "October")
 {
  $last_month= "September";
 }elseif($m = "September")
 {
  $last_month= "August";
 }
elseif($m = "August")
 {
  $last_month= "July";
 }
elseif($m = "July")
 {
  $last_month= "June";
 }elseif($m = "July")
 {
  $last_month= "June";
 }elseif($m = "June")
 {
  $last_month= "May";
 }

return  $last_month; 




}

 function paydiff($uid,$m,$y)
 {
 
 //echo $uid.",".$col.",".$m.",".$y."<br/>";
 // $last_month1  =last_month($m);
  $last_month= Date('F', strtotime("01-".$m."-".$y. " - 1 month"));
// echo  $last_month;
  //  echo $last_month."<br/>";
	$CI = & get_instance();
 	//$CI->db->select($col);
          $CI->db->from('ft_pay_register');
          $CI->db->where("pay_emp_unique_id",$uid);
		         $CI->db->where("pay_arriyas",0); 
				     $CI->db->where("pay_back_date",0); 
              $CI->db->where("pay_month",$last_month);
     $query = $CI->db->get();

         $rows = $query->result();


        return $rows;
 }
 function notinsalary($uid)
 {
  $CI = & get_instance();
  $CI->db->select('*');
          $CI->db->from('ft_pay_emp_salary');
          $CI->db->where("pay_emp_unique_id",$uid);
     
     $query = $CI->db->get();
            
    //    echo $CI->db->last_query();
         $rows = $query->result();


        return count($rows);


 }function getinstlment($id,$m,$y,$D)
 {
  $CI = & get_instance();
       $query = $CI->db->query('SELECT emi_no_installment FROM `ft_pay_emi` join ft_pay_emp_advance on 
        ft_pay_emp_advance.pea_emp_unique_id = ft_pay_emi.emi_emp_unique_id WHERE
         ft_pay_emp_advance.pea_type=0  and 
         ft_pay_emi.emi_emp_unique_id ='.$id.' and ft_pay_emi.emi_pay_date = "'.$m.'"  and ft_pay_emi.emi_pay_year = "'.$y.'" and emp_type_id ='.$D.'   ORDER BY `emi_id` DESC LIMIT 0,1  ');
  $rowid  = $query->result();
   
   
            
  


        return  $rowid ;

 }function getemppenno($id)
 {
 $CI = & get_instance();
    $sessionemp = emp_session_id();
    $query =   $CI->db->query("SELECT *  FROM ft_employee WHERE emp_unique_id=".$id );

   
    $state_name = $query->row_array();
   //print_r($state_name);

        
        
    return $state_name;

 }
 function get_adv_name($id)
 {
 $CI = & get_instance();
    $sessionemp = emp_session_id();
    $query =   $CI->db->query("SELECT *  FROM ft_pay_advance_master WHERE adv_id=".$id."  LIMIT 0,1" );
    $state_name = $query->row_array();
    return $state_name;

 }
 function paydiffmonth($uid,$m)
 {

  $last_month = Date('F', strtotime($m . " last month"));
  $CI = & get_instance();
  $CI->db->select('*');
          $CI->db->from('ft_pay_register');
          $CI->db->where("pay_emp_unique_id",$uid);
              $CI->db->where("pay_month",$last_month);
     $query = $CI->db->get();
            
  //  echo $CI->db->last_query();
         $rows = $query->result();


        return $rows;
 }
 function getoldsalry($uid)
 {
 
  $CI = & get_instance();
  $query =   $CI->db->query("SELECT pay_basic , pay_grp  FROM ft_pay_log_emp_salary WHERE pay_emp_unique_id=".$uid."  LIMIT 0,1" );

   
    $state_name = $query->result();
   //print_r($state_name);



        return $state_name;

 }function getiadvamount($uid,$id)
 {
$CI = & get_instance();
  $query =   $CI->db->query("SELECT * FROM `ft_pay_emp_advance` where pea_emp_unique_id =".$uid." and pea_type_id =".$id." ORDER BY `ft_pay_emp_advance`.`pea_type_id` ASC" );

   
    $state_name = $query->result();
   //print_r($state_name);



        return $state_name;

 }function get_employee_designation_id($emp_id, $id = false , $iseng = false) {
    $CI = & get_instance();
    $CI->db->where('ft_employee.emp_id', $emp_id);
    $CI->db->join('ft_emprole_master',  "ft_employee.designation_id =  ft_emprole_master.role_id");
    $CI->db->from('ft_employee');
    $query =  $CI->db->get();
    $row = $query->row();
  if($id == true){
    return $row->role_id;
  } else {
        if($iseng == true){
            return $row->emprole_name_en;
        }else{
            return $row->emprole_name_hi;
        }
}
}
function getdavalback($id)
{
$CI = & get_instance();
  $query =   $CI->db->query("SELECT salary_da FROM `ft_pay_log_salary_master` where salary_cate_id =".$id." ORDER BY `salary_id` DESC LIMIT 0,1" );

   
    $state_name = $query->result();
    return $state_name;

}function getdavalnew($id)
{
$CI = & get_instance();
  $query =   $CI->db->query("SELECT * FROM `ft_pay_salary_master` where salary_cate_id =".$id );

   
    $state_name = $query->result();
    return $state_name;

}function getduertionofarreas($m,$cate,$y)
{

$CI = & get_instance();
  $query =   $CI->db->query("SELECT * FROM `ft_pay_arreas_cate` where pay_arreas_cate_id =".$cate." and pay_month = '".$m."' and pay_year =".$y);

   
    $state_name = $query->result();
    return $state_name;
}
function getflyear($m1,$y1,$y2,$y3)
  {

    $currentYear = $y1; 

    $nextyear =$y2; //date('Y', strtotime('+1 years',$currentYear)); 

    $m1 = date('m', strtotime($y3."-$m1-0"))."|".$y3;
 //echo  $m1."<br/>";
for ($m=1; $m<=12; $m++) {
  if($m >= 3 ){
      $Year = $currentYear;
    }else{

       $Year = $nextyear;
    }
     if($m <= 9){$k = "0".$m;}else{$k =$m;}
 
  $flyear = $k."|".$Year;

    if($m1 == $flyear )
      {   
 // echo "<br/>";
//echo $m1."== ".$flyear;
        $retu = 1;
        return $retu;
      }else{ $retu = 0;

      }
}
     

  }function newbasic($id)
  {

    $CI = & get_instance();
  $query =   $CI->db->query("SELECT pay_basic FROM `ft_pay_log_emp_salary` where pay_emp_unique_id =".$id );

   
    $state_name = $query->result();
    return $state_name;
  }function getsalarylastmonts($emp,$output,$y1,$y2)
  {
    $CI = & get_instance();
	  $months = "";
   foreach($output as $val) {
    //
	
	
     $nn = explode("|", $val['month']);
    $months .="'". $nn[0]."', ";
 

}

$string = rtrim($months, ", \t\n");


    
         $query = $CI->db->query("SELECT pay_month,pay_year,pay_basic ,pay_grp ,pay_da FROM `ft_pay_register` WHERE pay_month IN (".$string.") and pay_emp_unique_id=".$emp." and pay_year between ".$y1." and ".$y2." and  pay_back_date = 0 AND  pay_arriyas = 0  ORDER BY `ft_pay_register`.`pay_month_order` ASC");
         $rowid = $query->result();

         
   // echo $CI->db->last_query();
      return $rowid;
  
  }
  
  function getarrearsppmonts($emp,$output,$y1)
  {
    $CI = & get_instance();
	  
    
         $query = $CI->db->query("SELECT * FROM `ft_pay_arreas_paper` WHERE pay_month_given ='".$output."' and 	pay_emp_unique_id =".$emp." and pay_year_given =".$y1);
         $rowid = $query->result();

         
  // echo $CI->db->last_query();
      return $rowid;
  
  }
    
  function getbackpmonts($emp,$output,$y1)
  {
    $CI = & get_instance();
	  
    
         $query = $CI->db->query("SELECT * FROM `ft_pay_register` WHERE pay_month ='".$output."' and 	pay_emp_unique_id =".$emp." and pay_back_date= 1 and  pay_year =".$y1);
         $rowid = $query->result();

         
  // echo $CI->db->last_query();
      return $rowid;
  
  }
  
  function getpayamamount($id,$m,$y )
  {
   $CI = & get_instance();
    $query = $CI->db->query("SELECT * FROM `ft_pay_register` WHERE pay_month = '".$m."' and pay_emp_unique_id=".$id." and pay_year  =".$y."  AND  pay_arriyas = 1  ORDER BY `ft_pay_register`.`pay_month_order` ASC");
         $rowid = $query->result();

         
   // echo $CI->db->last_query();
      return $rowid;
  }
    function getbasicgradepay($id,$m,$y )
  {
   $CI = & get_instance();
    $query = $CI->db->query("SELECT * FROM `ft_pay_arreas_paper` WHERE pay_month = '".$m."' and pay_emp_unique_id=".$id." and pay_year  =".$y."  AND  pay_arriyas_type =1");
         $rowid = $query->result();

         
 //echo $CI->db->last_query();
      return $rowid;
  }

  function get4classemp($id)
  {
  
    $CI = & get_instance();
       $query = $CI->db->query("SELECT pay_salary_cate_id from ft_pay_emp_salary where pay_emp_unique_id =".$id);
         $rowid = $query->result();

        
   //  echo $CI->db->last_query();
     return $rowid;
  
  }
  function get_tr_unicode($id)
  {
   $CI = & get_instance();
       $query = $CI->db->query("SELECT trunique from ft_emp_tr_uniquecode  where uniquecode =".$id);
         $rowid = $query->result();

         return $rowid[0]->trunique;
   //  echo $CI->db->last_query();
    

  }
  function get_pay_emp_advance()
 {
 	$CI = & get_instance();
	$CI->db->select('adv_id,adv_name_hi');
	$where = array(5,6); 
	$CI->db->where_in('adv_id',$where);
   	$query = $CI->db->get(" ft_pay_advance_master");
    $rows = $query->result();
	return $rows;
}	
function get_bill_num_array($key = '')
{
	
	$bill_num_array = array(
							0 => 'वेतन',
							1 => 'एरीयर्स',
							2 => 'अवकाश स्वीकृत',
							3 => 'स्थानांतरण',
		
						);
		if($key != ''){
						if(array_key_exists($key ,$bill_num_array)){
							return $bill_num_array [$key];
						}
					} else{
						return $bill_num_array; 
					}
	
}function getbillnoswithid($m)
{
	$CI = & get_instance();
	   $query =   $CI->db->query("SELECT * FROM `ft_pay_bill_cate` where pbill_id =".$m);
    $state_name = $query->result();//echo $CI->db->last_query();

    return $state_name;
	
	
}
function emp_details_with_pay_details( $emp_id ){
	$CI = & get_instance();

    $CI->db->select(EMPLOYEES.'.emp_id,'.EMPLOYEES.'.role_id,emp_title_hi,designation_id,emp_unique_id,emp_full_name,emp_full_name_hi,emp_email,emp_mobile_number,emp_section_id,emp_is_retired,emp_is_parmanent,emprole_name_hi,emp_gpf_dpf_code,emp_class,emp_pay_cate_id');
    $CI->db->where(EMPLOYEES.'.emp_id', $emp_id);
	$CI->db->from(EMPLOYEES);
	$CI->db->join( EMPLOYEEE_ROLE, EMPLOYEEE_ROLE.".role_id = ".EMPLOYEES.".designation_id", 'left');
	$CI->db->join( EMPLOYEE_DETAILS, EMPLOYEE_DETAILS.".emp_id = ".EMPLOYEES.".emp_id", 'left');

    $query = $CI->db->get();
    $data = $query->result_array();
	$CI->db->last_query();
    return $data;
}
function get_dpf_gpf_details($uid = null , $empid = null , $mast_id = null , $pay_appid = null)
{
    if($uid != null || $empid != null) {
        $CI = &get_instance();
        $CI->db->select('*');
        if ($uid != null) {
            $CI->db->where('pay_emp_unique_id', $uid);
        }
        if ($empid != null) {
            $CI->db->where('pay_emp_id', $empid);
        }
        if ($mast_id != null) {
            $CI->db->where('pay_sub_cateid', $mast_id);
        }
        if ($pay_appid != null) {
            $CI->db->where('pay_id', $pay_appid);
        }
        $CI->db->order_by("pay_id", "desc");
        $CI->db->limit('1');
        $query = $CI->db->get("ft_pay_dpf_yearly_amount");
        $rows = $query->row_array();
        $CI->db->last_query();
        return $rows;
    }
}
function convert_currentcy_interger($x)
{
	$float = str_replace(",", "",$x);
	$interger = $x = (int)$float;
	return $interger ;
}
function get_financial_year($backyear = null , $d = null,$m = null,$y = null , $only_year = true){
    //ex - $cur_dt = date('Ymd', mktime(0, 0, 0, 5 , 10, 2013));
    if($d != null && $m != null && $y != null){
    $cur_dt = date('Ymd', mktime(0, 0, 0, $m , $d, $y));
    }else{
    $cur_dt = date('Ymd', mktime(0, 0, 0, date("m")  , date("d"), date("Y")));
    }
    $cur_mm = $cur_yy = $fin_st_dd = $fin_st_mm = $fin_st_yy = $fin_nd_dd = $fin_nd_mm = $fin_nd_yy = "";
    $cur_mm = substr(trim($cur_dt),4,2);
    $cur_yy= substr(trim($cur_dt),0,4);

    if ( $cur_mm >= "04" && $cur_mm <= "12" )
    {
        $fin_st_dd="01";
        $fin_st_mm="04";
        $fin_st_yy= $cur_yy;
        $fin_nd_dd="31";
        $fin_nd_mm="03";
        $fin_nd_yy= $cur_yy+1;
    }
    if ($cur_mm >= "01" && $cur_mm <= "03")
    {
        $fin_st_dd="01";
        $fin_st_mm="04";
        $fin_st_yy=$cur_yy-1;
        $fin_nd_dd="31";
        $fin_nd_mm="03";
        $fin_nd_yy=$cur_yy;
    }
    $fin_st = date('Y-m-d', mktime(0, 0, 0, $fin_st_mm , $fin_st_dd, $fin_st_yy));
    $fin_nd = date('Y-m-d', mktime(0, 0, 0, $fin_nd_mm , $fin_nd_dd, $fin_nd_yy));
if($only_year == true){
    if($backyear != null && is_numeric($backyear)){
        $yrsy1 = $fin_st_yy-$backyear ;
        $yrsy2 = $fin_nd_yy-$backyear ;
        return $yrsy1."-".$yrsy2 ;
    }else{
        return $fin_st_yy."-".$fin_nd_yy ;
    }

}else{
    return $fin_st." - ".$fin_nd ;
}
    /* echo "\nCurrent Date: $cur_dt\n";
       echo "\nFinancial Year From : $fin_st To : $fin_nd\n";
       echo "\n$fin_nd\n";
       echo "\n$fin_st_mm";
       echo "\n$fin_st_yy\n";
       echo "\n$fin_st_mm";
       echo "\n$fin_nd_mm";
       echo "\n$fin_nd_yy\n";*/
}
 function  get_employee_details($id)
{
	  $CI = & get_instance();
    $tab1 = EMPLOYEES;
    $tab2 = EMPLOYEEE_ROLE;
	$tab3 =  EMPLOYEE_SERVICE_RECORD;

    $CI->db->select("$tab1.emp_id,$tab1.emp_pay_cate_id,$tab1.emp_title_hi,$tab1.emp_title_en,$tab1.role_id,$tab1.designation_id,$tab1.emp_unique_id,$tab1.emp_full_name,$tab1.emp_full_name_hi,$tab1.emp_email,$tab1.emp_mobile_number,$tab1.emp_section_id,$tab1.emp_is_retired,$tab1.emp_is_parmanent,$tab2.emprole_name_hi,$tab2.emprole_name_en ,$tab3.bank_ac");
	$CI->db->where("$tab1.emp_id",$id);
    $CI->db->order_by('emp_full_name_hi','asc');
    $CI->db->join($tab2,"$tab2.role_id = $tab1.designation_id",'left');
	$CI->db->join($tab3,"$tab1.emp_id = $tab3.emp_id",'left');
    $query = $CI->db->get($tab1);
    //echo $CI->db->last_query();

        $results = $query->result();


        return  $results ;


}
function get_employee_name_details($emp_name = null  ,$emp_code = null )
{
    $CI = & get_instance();
    $tab1 = EMPLOYEES;
    $tab2 = EMPLOYEEE_ROLE;
    $CI->db->select("$tab1.emp_id,$tab1.emp_title_hi,$tab1.emp_title_en,$tab1.role_id,$tab1.designation_id,$tab1.emp_unique_id,$tab1.emp_full_name,$tab1.emp_full_name_hi,$tab1.emp_email,$tab1.emp_mobile_number,$tab1.emp_section_id,$tab1.emp_is_retired,$tab1.emp_is_parmanent,$tab2.emprole_name_hi,$tab2.emprole_name_en");
    if(!empty($emp_name)){
        $CI->db->like('emp_full_name_hi',$emp_name);
    }
    else if(!empty($emp_code)){
        $CI->db->like('emp_unique_id',$emp_code);
    }
    $CI->db->order_by('emp_full_name_hi','asc');
    $CI->db->join($tab2,"$tab2.role_id = $tab1.designation_id",'left');
    $query = $CI->db->get($tab1);
    //echo $CI->db->last_query();
    if(!empty($emp_code) || !empty($emp_name) ){
        $results = $query->result();

        return  $results ;
    }
}
function get_incomegross($id,$rr,$col){

	$srt = str_replace("-",",",$rr);

	$srt1 = explode(",",$srt);
	$CI = & get_instance();
    $sessionemp = emp_session_id();
    $query =$CI->db->query("SELECT $col, pay_month_given,pay_year_given  FROM (`ft_pay_register`) JOIN `ft_employee` ON
     `ft_employee`.`emp_unique_id` = `ft_pay_register`.`pay_emp_unique_id` WHERE
     `pay_emp_unique_id` = ".$id." AND ft_pay_register.`pay_year_given` in (".$srt .") ORDER BY `ft_pay_register`.`pay_month_order` ASC");
    $state_name1 = $query->result();	  $state_name = 0;

 foreach($state_name1 as $row ){

	 if($row->pay_month_given == "January" && $row->pay_year_given == $srt1[0])
	 {
		 $state_name = 0;
	 }
	  elseif($row->pay_month_given == "February" && $row->pay_year_given == $srt1[0])
	  {
		 $state_name = 0;
	 }
	 else{
		 $state_name = $row->$col + $state_name; 
	 }
	 
 }
  return $state_name;
}
function incomecheck($id,$yy){



	$CI = & get_instance();
    $sessionemp = emp_session_id();
    $CI->db->select('in_id,in_uid,in_status');
        $CI->db->from('ft_est_income_tax');
        $CI->db->where("in_financial_year",$yy);
        $CI->db->where("in_uid",$id );
         $query = $CI->db->get();
        $rows = $query->result();
      $rows1 = $query->num_rows();
 //echo $CI->db->last_query();

    return $rows;
}function  getrules($yy){
	
	$CI = & get_instance();
    $sessionemp = emp_session_id();
    $CI->db->select('rl_id,rl_modid,rl__title,rl__discription');
        $CI->db->from('ft_rules_masters');
        $CI->db->where("rl_modid",$yy);
        $query = $CI->db->get();
        $rows = $query->result();
      $rows1 = $query->num_rows();
 //echo $CI->db->last_query();
 
    return $rows;
	
}
 function fetch_alloted_work($work_id = '')
    {$CI = & get_instance();
        $tbl_category = EST_CATEGORY_MASTER;
        $tbl_work_allote = EST_WORK_ALLOTE;
    $CI->db->select('est_word_alloted_emp_id'); 
        if($work_id != ''){
      $CI->db->where("$tbl_category.master_category_id", $work_id);
        }
       $CI->db->join($tbl_work_allote, $tbl_work_allote . '.est_word_alloted_work_id = '.$tbl_category .'.master_category_id');
        $CI->db->from($tbl_category);
        $CI->db->order_by('est_word_alloted_work_id', 'ASC');
        $query = $CI->db->get();
        $CI->db->last_query();
        
        if($query->num_rows() != 0)
        {          
            return $query->result_array();
        }
        else{
            return FALSE;
        }

    }function fetch_paycate($u_id = ''){
    
    $CI = & get_instance();
        $tab1 = EMPLOYEES;
   $CI->db->select("$tab1.emp_pay_cate_id,$tab1.emp_unique_id,$tab1.emp_full_name_hi,$tab1.emp_title_hi");
    $CI->db->where("emp_unique_id", $u_id);
        $CI->db->order_by('emp_order','asc');
    $query = $CI->db->get($tab1);
    //echo $CI->db->last_query();
    $results = $query->row_array();
        return  $results ;
   
    
  }