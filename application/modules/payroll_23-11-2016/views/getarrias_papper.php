    <script type="text/javascript">
        function PrintPage() {
            document.getElementById('print').style.display = 'none';
         
            document.URL = "";
            window.location.href = "";
            window.print();
        }

    </script><script type="text/javascript">
/*
 $(document).ready(function () {
          
            $('#print').dataTable({
    "lengthMenu": [ 10, 25, 50, 75, 100,125,150,175,200, 1000 ],
  "pageLength": 50,
"aaSorting": [],
  
  
});
           
        });*/
</script> 
    <style type="text/css" media="print">

        thead
        {
            display: table-header-group;
        }
		.noprint{
		display:none}
       
    </style>
    <style type="text/css" >

      
		h3{line-height: 28px;
		}
    </style>

<section class="content-header">
    <h1>
        <?php //echo $title; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php //echo $title; ?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header no-print">
                    <h1 ><?php echo " वेतन एरियर्स  डी. ए . पत्रक " ;?>
                  </h1>
                </div>
                <div class="box-body">
                    <h3 style="text-align: right;"></h3>
                </div>
            </div>
        </div>
    </div>
    <!-- Your Page Content Here -->
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
<div class="box-tools pull-right no-print">
                       <button onclick="printContents('divname')" class="btn btn-primary btn-sm no-print">Print</button>
                        <button class="btn  btn-warning" title="Back" onclick="goBack()">पिछले पेज में वापस जायें</button>

                    </div>
               <div class="box-body">

                        
                        <div class="fix_table-container">
					
              <div id="divname">     <?php $cate_id  = $this->uri->segment(3);  ?>  
			  <form  id="emp" action="<?php echo base_url();?>payroll/epayment/<?php echo $cate_id ?>" method="post">
					      <!-- class="table fixed_headers table-bordered table-striped dataTable fix_maintable dataTable" -->
						   <table width="100%" border="0" align="center">
    <tr>
      <td align="center" valign="middle"><h1>मध्यप्रदेश शासन विधि एवं विधायी कार्य विभाग</h1>	  </td>
      </tr>
	  <?php 
	  $uri = $this->uri->segment(3);
	  if($uri == 3 ){
	  ?>
    <tr>
      <td align="center">	 <h3 style="
    line-height: 28px;
">मध्यप्रदेश शासन, वित्त विभाग मंत्रालय वल्लभ भवन भोपाल के आदेश क्रमाक एफ 4-1/2016/नियम चार भोपाल, दिनांक 3 जून, 2016 के अनुसार जनवरी 2016 से मंहगाई भत्ता दर में हुई वृद्वि 119 प्रतिशत से बढ़ाकर रूपये 125 प्रतिशत के अनुसार प्रथम,द्वितीय एवं तृतीय श्रेणी शासकीय सेवकों का माह अप्रैल, 2016 से मई, 2016 तक के ऐरिसर्य राशि का सामान्य भविष्य निधि मे जमा एवं नगद भुगतान आहरण देयक/पत्रक।</h3></td>
      </tr>
	    <?php }elseif($uri == 2  ){?>
	    <tr>
      <td align="center">	 <h3 style="
    line-height: 28px;
">मध्यप्रदेश शासन, वित्त विभाग मंत्रालय वल्लभ भवन भोपाल के आदेश क्रमाक एफ 4-1/2016/नियम चार भोपाल, दिनांक 3 जून, 2016 के अनुसार जनवरी 2016 से मंहगाई भत्ता दर में हुई वृद्वि 119 प्रतिशत से बढ़ाकर रूपये 125 प्रतिशत के अनुसार द्वितीय एवं तृतीय श्रेणी शासकीय सेवकों का माह अप्रैल, 2016 से मई, 2016 तक के ऐरिसर्य राशि का सामान्य भविष्य निधि मे जमा एवं नगद भुगतान आहरण देयक/पत्रक।</h3></td>
      </tr>
	  <?php }elseif($uri == 5  ){?>
	      <tr>
      <td align="center">	
	    <h3 <h3 style="
    line-height: 28px;
">मध्यप्रदेश शासन, वित्त विभाग मंत्रालय वल्लभ भवन भोपाल के आदेश क्रमाक एफ 4-1/2016/नियम चार भोपाल, दिनांक 3 जून, 2016 के अनुसार जनवरी 2016 से मंहगाई भत्ता दर में हुई वृद्वि 119 प्रतिशत से बढ़ाकर रूपये 125 प्रतिशत के अनुसार तृतीय  श्रेणी शासकीय सेवकों का माह अप्रैल, 2016 से मई, 2016 तक के ऐरिसर्य राशि का नगद भुगतान आहरण देयक/पत्रक।</h3>
	    <h3>
		
			  <?php }elseif($uri == 8  ){?>
	      <tr>
      <td align="center">	
 <h3 style="
    line-height: 28px;
">मध्यप्रदेश शासन, वित्त विभाग मंत्रालय वल्लभ भवन भोपाल के आदेश क्रमाक एफ 4-1/2016/नियम चार भोपाल, दिनांक 3 जून, 2016 के अनुसार जनवरी 2016 से मंहगाई भत्ता दर में हुई वृद्वि 119 प्रतिशत से बढ़ाकर रूपये 125 प्रतिशत के अनुसार पारिभाषित अंशदायी चतुर्थ श्रेणी शासकीय सेवकों का माह जनवरी, 2016 से मई, 2016 तक के ऐरिसर्य राशि का नगद भुगतान आहरण देयक/पत्रक।</h3>
	    <h3>
					  <?php }elseif( $uri == 6 ){?>
	      <tr>
      <td align="center">	
	     <h3 style="
    line-height: 28px;
">मध्यप्रदेश शासन, वित्त विभाग मंत्रालय वल्लभ भवन भोपाल के आदेश क्रमाक एफ 4-1/2016/नियम चार भोपाल, दिनांक 3 जून, 2016 के अनुसार जनवरी 2016 से मंहगाई भत्ता दर में हुई वृद्वि 119 प्रतिशत से बढ़ाकर रूपये 125 प्रतिशत के अनुसार पारिभाषित अंशदायी चतुर्थ श्रेणी शासकीय सेवक का माह जनवरी, 2016 से मई, 2016 तक के ऐरिसर्य राशि का नगद भुगतान आहरण देयक/पत्रक।</h3>
	    <h3>
							
					  <?php }elseif($uri == 7 ){?>
	      <tr>
      <td align="center">	
	  <h3 style="
    line-height: 28px;
">मध्यप्रदेश शासन, वित्त विभाग मंत्रालय वल्लभ भवन भोपाल के आदेश क्रमाक एफ 4-1/2016/नियम चार भोपाल, दिनांक 3 जून, 2016 के अनुसार जनवरी 2016 से मंहगाई भत्ता दर में हुई वृद्वि 119 प्रतिशत से बढ़ाकर रूपये 125 प्रतिशत के अनुसार चतुर्थ श्रेणी शासकीय सेवक का माह अप्रैल, 2016 से मई, 2016 तक के ऐरिसर्य राशि का नगद भुगतान आहरण देयक/पत्रक।</h3>
	    <h3>
	      <?php }elseif($uri == 1 ){?>
	      </h3>
      <tr>
      <td align="center">	
	    <h3>विषयः- मंत्रालय वल्लभ भवन के आदेश क्रमाक एफ 4-1/2016/नियम चार भोपाल दिनांक 3 जून, 2016 के अनुसार जनवरी 2016 से मंहगाई भत्ता दर में हुई वृद्वि अनुसार न्यायिक सेवा अधिकारियों का माह जनवरी, 2016 से अप्रैल , 2016 तक ऐरिसर्य राशि के नगद भुगतान का आहरण पत्रक ।</h3></td>
      </tr>
	  
	  
	  <?php }elseif($uri ==4  ){?>
	  	       <tr>
      <td align="center">	
	    <h3>मध्यप्रदेश शासन, वित्त विभाग मंत्रालय वल्लभ भवन भोपाल के आदेश क्रमाक एफ 4-1/2016/नियम चार भोपाल, दिनांक 3 जून, 2016 के अनुसार जनवरी 2016 से मंहगाई भत्ता दर में हुई वृद्वि 119 प्रतिशत से बढ़ाकर रूपये 125 प्रतिशत के अनुसार चतुर्थ श्रेणी शासकीय सेवकों का माह अप्रैल, 2016 से मई, 2016 तक के ऐरिसर्य राशि का विभागीय भविष्य निधि मे जमा एवं नगद भुगतान आहरण देयक/पत्रक।</h3></td>
      </tr>
	  <?php } ?>
  </table>
<table id="print" cellspacing="0" width="100%" style="font-size:12px">
  


<?php $k=0; foreach($getemp as $emp){ $k++; if($k == 1){ ?>

       <thead>
<tr>
  <th >&nbsp;</th>
  <th >&nbsp;</th>
  <th >&nbsp;</th>
 
  <th colspan="3" >मंहगाई भत्ता जो भुगतान किया जाना था</th>
  <th colspan="3" >मंहगाई भत्ता जो भुगतान किया गया था</th>

  <th >अंतर </th>
  <th >कुल देय ऐरियर्स के माह</th>
  <th >कुल अंतर </th>
<?php if($uri != 2  && $uri != 6 && $uri != 1  &&  $uri != 8   ) { if(  $uri == 4 || $uri == 7 ){?>
<th > डी  पी फ </th>  <?php }else{  ?><th > जी पी फ </th>
  <?php }} ?>
  <th >नगद राशी </th>
  <th >राशि शब्दो में</th>
  <th >आहरण अधिकारी के हस्ताक्षर </th>
   <th ></th>
</tr>
<tr>
                                    
                                    <th ><?php echo "क्र."  ?></th>
                                    <th ><?php echo $this->lang->line('emp_unique_code')  ?></th>
                                    <th ><?php echo $this->lang->line('emp_name')." (पद) "; ?></th>
                                
                                    <th ><?php  echo $this->lang->line('basic_pay');  ?></th>
                                    <th ><?php echo  $this->lang->line('pay_gradepay');  ?></th>
                                    <th ><?php  echo  " नया ".getdavalnew($cate_id)[0]->salary_da."  प्रतिशत से ". $this->lang->line('pay_da');    ?></th>
                                    <th ><?php  echo $this->lang->line('basic_pay');  ?></th>
                                 
                            <th ><?php echo  $this->lang->line('pay_gradepay');  ?></th>
                             
                                    <th ><?php echo " पुराना ".getdavalback($cate_id)[0]->salary_da." प्रतिशत से  ". $this->lang->line('pay_da') ;  ?></th>
                         
                                
                                    <th >&nbsp;</th>
                 
                            <th >&nbsp;</th>
                               
                                    <th >&nbsp;</th>
									<?php if($uri != 2  && $uri != 6 && $uri != 1  &&  $uri != 8   ) {?>
                                    <th > <?php   $u = @getduertionofarreas($emp->pay_month,$emp->pay_salary_cate_id,$emp->pay_year)[0]->pay_d_duration;
                                   
                                          if($u != ""){  $v = explode(",", $u);
                                      $n = array_unique($v);
                                      echo $n[0]." 2016 to ".end($n)." 2016 ";
                                    }?></th>
								<?php } ?>
                                    <th ><?php $u = @getduertionofarreas($emp->pay_month,$emp->pay_salary_cate_id,$emp->pay_year)[0]->pay_c_duration;
                                     if($u != ""){
                                      $v = explode(",", $u);
                                      $n = array_unique($v); 
                                      echo $n[0]." 2016  to ".$n[1]." 2016"; }else{     echo  "<br/>".$emp->pay_start_month ." 2016  to ". $emp->pay_end_month." 2016";


                                      } ?></th>
                             
                                  
                                    <th >कुल देय अन्तर की राशि</th>
                                       <th ></th>
                                   <th > रिमार्क 
                                     <input name="countall"   value="<?php echo count($getemp);?>" type="hidden" /></th>
</tr>
<?php }} ?>  
                              </thead>
                         

   <tbody>      
                	
					   <?php $k=0; $dd=0; $totalolda = 0;  $totalda = 0;$totaldiff =0;$totalgpf =0;$totalpp =0; foreach($getemp as $emp){ $k++;
				$payamount = getpayamamount($emp->pay_emp_unique_id,$emp->pay_month,$emp->pay_year);
				//  pre($payamount);
				$date1 = $payamount[0]->pay_arriyas_year.'-'.$payamount[0]->pay_start_month.'-01';
$date2 = $payamount[0]->pay_arriyas_year_end.'-'.$payamount[0]->pay_end_month.'-01';

$ts1 = strtotime($date1);
$ts2 = strtotime($date2);

$year1 = date('Y', $ts1);
$year2 = date('Y', $ts2);

$month1 = date('m', $ts1);
$month2 = date('m', $ts2);

$countmonth  = (($year2 - $year1) * 12) + ($month2 - $month1) +1;
				

		
	?>
				 
				
                                    <tr id="<?php echo $emp->pay_id; ?>">
                                      <th  ><?php echo $k; ?><br />                                      </th>
                                      <th  ><?php echo  get_tr_unicode($emp->emp_unique_id);?></th>
                                      <th ><?php  echo get_employee_gender(getemppenno($emp->pay_emp_unique_id)['emp_id'])." " .getemppenno($emp->pay_emp_unique_id)['emp_full_name_hi']."<br/>  (". get_employee_designation_id(getemppenno($emp->pay_emp_unique_id)['emp_id']).")";
									   ?></th>
                                      <th ><div class="hide<?php echo $emp->pay_id; ?>"><?php echo 	$emp->pay_basic ?></div>
                                          <div class="show<?php echo $emp->pay_id; ?>" style="display:none">
                                            <input name="danew" onblur="checkda(<?php echo $emp->pay_id; ?>)" id="danew" value="<?php echo 	getdavalnew($emp->pay_salary_cate_id)[0]->salary_da ?>" type="hidden" />
                                            <input name="pay_basic<?php echo  $k;; ?>" onblur="checkda(<?php echo $emp->pay_id; ?>)" id="basic<?php echo $emp->pay_id; ?>" value="<?php echo 	$emp->pay_basic ?>" type="text" />
                                          </div></th>
                                      <th ><div class="hide<?php echo $emp->pay_id; ?>" ><?php echo 	$emp->pay_grp ?></div>
                                          <div class="show<?php echo $emp->pay_id; ?>" style="display:none">
                                            <input name="pay_grp<?php echo $k; ?>"  onblur="checkda(<?php echo $emp->pay_id; ?>)" id="pay_grp<?php echo $emp->pay_id; ?>" value="<?php echo 	$emp->pay_grp ?>" type="text" />
                                          </div></th>
                                      <th > <div class="hide<?php echo $emp->pay_id; ?>" >
                                        <?php $newda =  getdavalnew($emp->pay_salary_cate_id)[0]->salary_da; echo   $newda1 = round((( $emp->pay_basic +  $emp->pay_grp)* $newda)/100);$totalda =  $newda1 + $totalda;   ?>
                                      </div>
                                          <div class="show<?php echo $emp->pay_id; ?>" style="display:none">
                                            <input name="pay_da_new"   onblur="checkda(<?php echo $emp->pay_id; ?>)" readonly="" id="da<?php echo $emp->pay_id; ?>" value="<?php echo 	$emp->pay_da ?>" type="text" />
                                          </div></th>
                                      <th ><?php echo 	$emp->pay_basic ?></th>
                                      <th ><?php echo $emp->pay_grp ?></th>
                                      <th > <div class="hide<?php echo $emp->pay_id; ?>" >
                                        <?php $olda =  getdavalback($emp->pay_salary_cate_id)[0]->salary_da;  
										 echo $olda1 =  round((( $emp->pay_basic +  $emp->pay_grp)* $olda)/100); $totalolda =  $olda1 + $totalolda;
										 
										   ?>
                                      </div>
                                          <div class="show<?php echo $emp->pay_id; ?>" style="display:none">
                                            <input name="pay_da_old"   onblur="checkda(<?php echo $emp->pay_id; ?>)" readonly="" id="daold<?php echo $emp->pay_id; ?>" value="<?php echo 	$emp->pay_da ?>" type="text" />
                                          </div
									  ></th>
                                      <th ><?php echo $dd =  $newda1 - $olda1 ; ?></th>
                                      <th ><?php echo $countmonth; ?></th>
                                      <th ><?php echo  $payamount[0]->pay_da ;
									   $totaldiff1 = $totaldiff1  + $payamount[0]->pay_da ; ?>
                                          <input name="pay_diff<?php echo $k ?>" id="pay_diff<?php echo $emp->pay_id; ?>" value="<?php echo 	$emp->pay_diff ?>" type="hidden" />
                                          <input name="uincodes<?php echo $k; ?>" id="pay_diff<?php echo $emp->pay_id; ?>" value="<?php echo 	$emp->pay_emp_unique_id ?>" type="hidden" />                                      </th>
										  <?php if($uri != 2  &&  $uri != 6 && $uri != 1  &&  $uri != 8   ) {
										   if(  $uri == 4 ){?>
										       <th ><?php echo $payamount[0]->pay_dpf; $totalgpf = $totalgpf +$payamount[0]->pay_dpf;  ?> </th>
											   <?php }else{ ?>
                                      <th ><?php echo $payamount[0]->pay_gpf; $totalgpf = $totalgpf +$payamount[0]->pay_gpf;  ?> </th>
									  <?php }}?>
                                      <th ><?php echo $payamount[0]->pay_total; $totalpp = $totalpp +$payamount[0]->pay_total; ?> </th>
                                      <th ><?php echo ucfirst(convert_number_to_words($payamount[0]->pay_total)) ?></th>
                                      <th > </th>
                                      <th ><?php echo $payamount[0]->pay_remark; ?><br/>
									  
									  <div class="eidt<?php echo $emp->pay_id; ?>" style="display:none">
					                    <textarea name="countall" class="eidt" id="pay_remark<?php echo $payamount[0]->pay_id; ?>"></textarea>	
										<input name="" type="button"  onclick="addremarksindb(<?php echo $payamount[0]->pay_id; ?>)"  value=" जमा"/>
</div>					
									  <a href="#<?php echo $emp->pay_id; ?>"  class="hid noprint" onclick="addremarks(<?php echo $emp->pay_id; ?>)">Add Remark</a>
									  </th>
                                    </tr>
                                   
                               
                                 
                                       
           
						  
						  <?php } ?>
</tbody> 


 <tr id="" style="background:#009933;s">
                                     <th  >&nbsp;</th>
                                         <th  >&nbsp;</th>
                                  
                                      <th >&nbsp;</th>   
                                      <th >&nbsp;</th>
                              
									  <th >Total</th>
									  
							
                                      <th >New DA:- <?php echo $totalda; ?></th>
                                      <th >&nbsp;</th>
                                    
										     <th >&nbsp;</th>
										
                                      <th >Old DA :- <?php echo $totalolda; ?></th>    
									 
											      <th >&nbsp;</th>
                                                  <th >&nbsp;</th>
                                                  <th ><?php echo $totaldiff1; ?></th>
												  <?php if($uri != 2  && $uri != 6 && $uri != 1  &&  $uri != 8   ) {?>
												  
                                      <th ><?php echo $totalgpf; ?></th>
                                                  <?php } ?><th ><?php echo $totalpp; ?></th>
                                                  <th ></th> <th ></th>
                                                  <th ></th>
                                 </tr>
 <tr id="" >
   <th colspan="17" align="center" valign="middle"  ><center>
<h2><?php

$number = $totalpp;
   $no = round($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
  echo ucfirst($result . "Rupees  " . $points) ;
?></h2>
</center></th>
   </tr>
 
</table>
<div id="bottom_anchor"></div>
</div>
  



    </div>   
    </div>
</div>
  </div>
    </div>
  </section>
    </form>    

  <?php function convert_number_to_words($number) {

    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
			
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}?>
  <script type="text/javascript">


function addremarks(id)
{

$(".eidt"+id).show();
$(".hid").hide();
}

function addremarksindb(id)
{
  var r = confirm("कृपया सुनिश्चित करें कि डेटा सही है अथवा नहीं");
    if (r == true) {
	$remarks= $("#pay_remark"+id).val();
	$.post("<?php echo base_url()?>payroll/addremarksindb/"+id,
		{"pay_remark":$remarks
		},
		function(a){location.reload();});
 } else {
        txt = "You pressed Cancel!";
    }
}
function checkda(id)
{
 basic = $("#basic"+id).val(); 
    <?php if($dataval[0]['pay_cate_grp'] == 1){  ?>
pay_gpf = $("#pay_grp"+id).val();
 <?php }else{ ?>
pay_gpf = 0;
<?php } ?>
    pay_danew = $("#danew").val(); 
	   //   alert(pay_danew);

  var dd = parseInt(basic) + parseInt(pay_gpf);
var  dane = parseInt(dd) * parseInt(pay_danew);
var  dane1 = parseInt(dd) * parseInt(119);

  var dd1 = Math.round(parseInt(dane)/100);
 var dd2 = Math.round(parseInt(dane1)/100);
  pay_didi = $("#da"+id).val(dd1);
    pay_didi = $("#daold"+id).val(dd2);

  

}
function onsubmited(id){

   var r = confirm("कृपया सुनिश्चित करें कि डेटा सही है अथवा नहीं");
    if (r == true) {
     
        basic = $("#basic"+id).val();
		pay_grp = $("#pay_grp"+id).val();
  		pay_didi = $("#da"+id).val();
 		 gpf = $("#gpf"+id).val();
  		caseamount = $("#caseamount"+id).val();
		no_updated  = $("#no_updateds"+id).val();
	
		$.post("<?php echo base_url()?>payroll/updatepapaer/<?php echo  $this->uri->segment(3); ?>",
		{ "basic": basic,
		"pay_grp": pay_grp,
		"pay_didi": pay_didi,
		"gpf": gpf,
		"pay_id":id,
		"no_updated":no_updated,
		"caseamount":caseamount
		},
		function(a){location.reload();});

    } else {
        txt = "You pressed Cancel!";
    }
  
}
  </script>
    