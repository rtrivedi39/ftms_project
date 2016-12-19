<!-- Content Header (Page header) -->
 <meta charset="UTF-8">
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
                <div class="box-header">
                    <h1 ><?php echo " वेतन एरियर्स  डी. ए . ".$_GET['pay_month']." ".$_GET['pay_year']." - ".$_GET['pay_month_end']." ". $_GET['pay_year_end'];?>
                      </h1>
                </div>
                <div class="box-body">
                    <h3 style="text-align: right;"><?php echo "वित्त विभाग  का आदेश नंबर :- ".$_GET['orderno'];?></h3>
                </div>
            </div>
        </div>
    </div>
    <!-- Your Page Content Here -->
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">

               <div class="box-body">

                        
                        <div class="fix_table-container">
						<form  id="emp" action="<?php echo base_url();?>payroll/epayment/?cate_id=<?php echo $_GET['cate_id']?>&pay_month=<?php echo $_GET['pay_month']?>&pay_year=<?php echo $_GET['pay_year']?>&pay_month_end=<?php echo $_GET['pay_month_end']?>&pay_year_end=<?php echo $_GET['pay_year_end']?>" method="post">
                         
<table id="" class="" cellspacing="0" width="100%" style="font-size:12px">
  
<thead style="background:white" >         <?php if($_GET['cate_id'] == 1 || $_GET['cate_id'] == 2 ){ ?>
<tr>

<th colspan="22">  <button class="btn btn-primary" onclick="onsumitsalary()" type="submit" name="savenotice" id="savenotice"  value="1">
  Apply Payment</button>  </th>
 </tr>
<?php }else{ ?>
<tr>

<th colspan="18"> 
  <table width="100%" border="0" align="center">
    <tr>
      <td colspan="3" align="center" valign="middle"><h1>&#2350;&#2343;&#2381;&#2351;&#2346;&#2381;&#2352;&#2342;&#2375;&#2358; &#2358;&#2366;&#2360;&#2344; &#2357;&#2367;&#2343;&#2367; &#2319;&#2357;&#2306; &#2357;&#2367;&#2343;&#2366;&#2351;&#2368; &#2325;&#2366;&#2352;&#2381;&#2351; &#2357;&#2367;&#2349;&#2366;&#2327;</h1></td>
      </tr>
    <tr>
      <td colspan="3" align="center"><h3>मध्यप्रदेश शासन वित्त विभाग वल्लभ भवन मंत्रालय भोपाल के आदेश क्रमाक एफ <?php echo $_GET['orderno']?> भोपाल दिनांक 14 जून 2013 के अनुसार चतुर्थ श्रेणी कर्मचारियों का माह <?php echo " वेतन एरियर्स  डी. ए . ".$_GET['pay_month']." ".$_GET['pay_year']." से ".$_GET['pay_month_end']." ". $_GET['pay_year_end'];?>तक का मंहगाई भत्ता ऐरियर्स राशि आहरण पत्रक (आदेश प्रति संलग्न ) </h3></td>
      </tr>
    <tr>
      <td align="center"><p>GPF Months</p>
        <p> 
            <?php foreach($months as $mm){  $nn = explode("|", $mm['month']);
    $pay_da = $nn[0];?>       
            <input type="checkbox" name="gpf[]" value="<?php echo $pay_da;?>" /> 
            <?php echo $pay_da;?>
            <?php } ?>
          </p></td>
      <td align="center"><p>Epayment
        Months</p>
        <p><?php foreach($months as $mm){  $nn = explode("|", $mm['month']);
    $pay_da = $nn[0];?>       
            <input type="checkbox" name="epayment[]" value="<?php echo $pay_da;?>" /> 
            <?php echo $pay_da;?>
            <?php } ?>
          </p></td>
      <td align="center"><button class="btn btn-primary" onclick="onsumitsalary()" type="submit" name="savenotice" id="savenotice"  value="1"> Apply Payment</button></td>
    </tr>
  </table></th> 
 </tr>
<?php } ?>         
<tr>
                                    
                                    <th ><?php echo "क्र."  ?></th>
                                    <th ><?php echo $this->lang->line('emp_unique_code')  ?></th>
                                    <th ><?php echo $this->lang->line('emp_name')." (पद) "; ?></th>
                                  <th ><?php echo $this->lang->line('emp_pay_month'); ?></th>
                                    <?php if($dataval[0]['pay_cate_basic'] == 1){  ?>
                            <th ><?php  echo $this->lang->line('basic_pay');  ?></th>
                                 <?php }if($dataval[0]['pay_cate_grp'] == 1){  ?>
                                    <th ><?php echo  $this->lang->line('pay_gradepay');  ?></th>
                              <?php }if($dataval[0]['pay_cate_da'] == 1){  ?>
                                
                                    <th ><?php echo " पुराना ".getdavalback($_GET['cate_id'])[0]->salary_da." प्रतिशत से  ". $this->lang->line('pay_da') ;  ?></th>
                     <?php } ?>
                            <th > <?php  echo  " नया ".getdavalnew($_GET['cate_id'])[0]->salary_da."  प्रतिशत से ". $this->lang->line('pay_da');    ?></th>
                             
                                  
                                   <th >मंहगाई भत्ता प्रतिमाह अन्तर राशि</th>
                                </tr>
                              </thead>
                              </thead>

   <tbody>      
                   <?php $k=0; foreach($getemp as $emp){ $k++;
				$salaryval= getsalarylastmonts($emp->emp_unique_id,$months,$_GET['pay_year'],$_GET['pay_year_end']);
				//print_r($salaryval);
				$totalarreas  = 0;$totalbasic  = 0;$totalpay_grp  = 0;$totalpay_da  = 0;$totalnewda  = 0;
				   foreach($salaryval as $pay ){
				    ?>
                                        
                              
                 
                                       <?php  $totalbasic = $pay->pay_basic + $totalbasic ;  $totalpay_grp = $pay->pay_grp + $totalpay_grp ; $totalpay_da = $pay->pay_grp + $totalpay_da ;  $newda= round((($pay->pay_basic + $pay->pay_grp)* getdavalnew($_GET['cate_id'])[0]->salary_da)/100); $totalnewda = $totalnewda + $newda;  $arreas = $newda - $pay->pay_da; $totalarreas = $arreas  + $totalarreas ;   } ?>
                                    <tr id="<?php echo $emp->emp_id; ?>">
                                      <th  ><?php echo $k; ?></th>
                                         <th  ><?php echo $k; ?></th>
                                      <th ><?php echo $emp->emp_unique_id;  ?></th>
                                      <th ><?php echo @get_employee_gender($emp->emp_id)." ".$emp->emp_full_name_hi." <br/>  (". get_employee_designation_id($emp->emp_id).")"; ?></th>
                                      <th ><?php echo $totalbasic ?></th>
                                      <th ><?php echo $totalpay_grp ?></th>    
									    <th ><?php echo $totalpay_da ?></th>  
										    <th ><?php echo $totalnewda ?></th>
											      <th ><?php echo $totalarreas ?>  <input name="da[]" 
												   value="<?php echo $totalarreas."|".$emp->emp_unique_id; ?>" type="hidden" ></th>
                                 </tr>
                               
                                 
                                       
           
						  
						  <?php } ?>
</tbody> 

<tfoot>
  <?php if($_GET['cate_id'] == 1 || $_GET['cate_id'] == 2 ){ ?>
<tr>

<th colspan="22"> <button class="btn btn-primary" onclick="onsumitsalary()" type="submit" name="savenotice" id="savenotice"  value="1">
  Apply Payment</button> </th>
 </tr>
<?php }else{ ?>
<tr>

<th colspan="18"> 
  <table width="100%" border="0" align="center">
    <tr>
      <td align="center">GPF Months  <?php foreach($months as $mm){ 
       $nn = explode("|", $mm['month']);
    $pay_da = $nn[0];
   ?>       
        <input type="checkbox"name="gpf[]" value="<?php  echo $pay_da; ?>" /> <?php  echo $pay_da; ?>
		  <?php } ?>		</td>
      <td align="center">Epayment
   Months 
   <?php  foreach($months as $mm){ 

      $nn = explode("|", $mm['month']);
    $pay_da = $nn[0];
   ?>
         <input type="checkbox" name="epament[]" value="<?php  echo $pay_da; ?>" /> <?php  echo $pay_da ?> , 
		 <?php } ?>        </td>
      <td align="center"><button class="btn btn-primary" onclick="onsumitsalary()" type="submit" name="savenotice" id="savenotice"  value="1"> Apply Payment</button></td>
    </tr>
  </table></th> 
 </tr
><?php } ?>
</tfoot>   
</table>
<div id="bottom_anchor"></div>
</div>



</form>       
    </div>
</div>
  </div>
    </div>
  </section>
  <script type="text/javascript">

function onsumitsalary(id)
{
   var r = confirm("कृपया सुनिश्चित करें कि डेटा सही है अथवा नहीं");
    if (r == true) {
      $
        document.getElementById("emp").submit();


    } else {
        txt = "You pressed Cancel!";
    }
  

}
  </script>