<!-- Content Header (Page header) -->
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
						<form  id="emp" action="<?php echo base_url();?>payroll/getarrias_papper" method="post">
                           <input name="pay_year_end"  value="<?php echo $_GET['pay_year_end'] ?>" type="hidden" >
						    <input name="cate_id"  value="<?php echo $_GET['cate_id'] ?>" type="hidden" >
							 <input name="pay_month"  value="<?php echo $_GET['pay_month'] ?>" type="hidden" >
							  <input name="pay_year"  value="<?php echo $_GET['pay_year'] ?>" type="hidden" >
							   <input name="pay_month_end"  value="<?php echo $_GET['pay_month_end'] ?>" type="hidden" >
							    <input name="orderno"  value="<?php echo $_GET['orderno'] ?>" type="hidden" >
								 <input name="pay_year_end"  value="<?php echo $_GET['pay_year_end'] ?>" type="hidden" >
<table id="" class="" cellspacing="0" width="100%" style="font-size:12px">
  
<thead style="background:white" >         <?php if($_GET['cate_id'] == 1 || $_GET['cate_id'] == 2  || $_GET['cate_id'] == 13 || $_GET['cate_id'] == 14 ){ ?>
<tr>

<th colspan="22">  <button class="btn btn-primary" onclick="onsumitsalary()" type="submit" name="savenotice" id="savenotice"  value="1">
   वेतन एरियर्स  डी. ए .  पत्रक </button>  </th>
 </tr>
<?php }else{ ?>
<tr>

<th colspan="18"> 
  <table width="100%" border="0" align="center">
    <tr>
      <td align="center"><p>जी पी एफ देय </p>
        <p> 
            <?php foreach($months as $mm){  $nn = explode("|", $mm['month']);
    $pay_da = $nn[0];?>       
            <input type="checkbox" name="gpf[]" value="<?php echo $pay_da;?>" /> 
            <?php echo $pay_da;?>
            <?php } ?>
          </p></td>
      <td align="center"><p> नगद देय 
        </p>
        <p>
            <?php foreach($months as $mm){  $nn = explode("|", $mm['month']);
    $pay_da = $nn[0];?>       
            <input type="checkbox" name="epayment[]" value="<?php echo $pay_da;?>" />
			 
            <?php echo $pay_da;?>
            <?php } ?>
          </p></td>
      <td align="center"><button class="btn btn-primary" onclick="onsumitsalary()" type="submit" name="savenotice" id="savenotice"  value="1"> वेतन एरियर्स  डी. ए .  पत्रक </button></td>
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

   <tbody>                                     <input name="pay_arriyas_type "   value="1" type="hidden" />      <input name="pay_month"   value="<?php echo $_GET['pay_month'];?>" type="hidden" />
	    <input name="pay_month_end"  value="<?php  echo $_GET['pay_month_end'];?>" type="hidden" />
		  <input name="pay_year"   value="<?php  echo $_GET['pay_year'];?>" type="hidden" />
		    <input name="pay_year_end"   value="<?php  echo $_GET['pay_year_end'];?>" type="hidden" />
			  <input name="orderno"   value="<?php  echo $_GET['orderno'];?>" type="hidden" />
                   <?php $k=0;$empname1 =""; foreach($getemp as $emp){ 
				$salaryval= getsalarylastmonts($emp->emp_unique_id,$months,$_GET['pay_year'],$_GET['pay_year_end']);
                              
				$totalarreas  = 0;$totalbasic  = 0;$totalpay_grp  = 0; $totalpay_da  = 0;$totalnewda  = 0;
				 $k++; 
				   foreach($salaryval as $pay ){
				   
				 $vae  = getarrearsppmonts($emp->emp_unique_id,$pay->pay_month,$pay->pay_year);
                                  $vae1  = getbackpmonts($emp->emp_unique_id,$pay->pay_month,$pay->pay_year);
				// echo count($vae)."monika";
				
				$empname = @get_employee_gender($emp->emp_id)." ".$emp->emp_full_name_hi." <br/>  (". get_employee_designation_id($emp->emp_id).")"; 
				   if(count($vae)== 0  && count($vae1)== 0 ){
				   
				  ?>
                                        
                                   <?php /*?> <input name="pay_month"   value="<?php echo $emp->pay_month ;?>" type="hidden" />
	    <input name="pay_month_end"  value="<?php echo $emp->pay_month_end ;?>" type="hidden" />
		  <input name="pay_year"   value="<?php echo $emp->pay_year ;?>" type="hidden" />
		    <input name="pay_year_end"   value="<?php echo $emp->pay_year_end ;?>" type="hidden" />
			  <input name="orderno"   value="<?php echo $emp->orderno ;?>" type="hidden" /><?php */?><tr id="<?php echo $emp->emp_id; ?>">
                                     <?php if($empname1 != $empname){ ?>
									  <th  ><?php echo $k; ?></th>
                                      <th ><?php echo get_tr_unicode($emp->emp_unique_id); ?></th>
                                      <th ><?php echo $empname;$empname1 = $empname;?></th>
									  <?php }else{ ?>
									  			  <th  ></th>
                                      <th ></th>
                                      <th ></th>
									  <?php } ?>
                                      <th ><?php echo  $pay->pay_month ." ".$pay->pay_year;?></th>
                                      <th ><?php echo  $pay->pay_basic; $totalbasic = $pay->pay_basic  ; ?></th>
									   <?php if($dataval[0]['pay_cate_grp'] == 1){  ?>
                                      <th ><?php echo  $pay->pay_grp; $totalpay_grp = $pay->pay_grp  ; ?></th>
									  <?php }?>
                                      <th ><?php echo  $pay->pay_da; $totalpay_da = $pay->pay_da ; ?></th>
                                      <th ><?php echo $newda= round((($pay->pay_basic + $pay->pay_grp)* getdavalnew($_GET['cate_id'])[0]->salary_da)/100); $totalnewda = $totalnewda + $newda; ?></th>
                                      <th colspan="3" ><?php echo $arreas = $newda - $pay->pay_da; $totalarreas = $arreas  + $totalarreas ;  ?></th>
                         </tr>
	  <?php }elseif(count($vae) != 0 ){ 
							   foreach($vae as $row){?>
                                 
                                                  
                                    <tr style="background:#FFD1BB" id="<?php echo $emp->emp_id; ?>">
                                       <?php if($empname1 != $empname){ ?>
									  <th  ><?php echo $k; ?></th>
                                           <th ><?php echo  get_tr_unicode($emp->emp_unique_id);   ?></th>
                                      <th ><?php echo $empname;$empname1 = $empname;?></th>
									  <?php }else{ ?>
									  			  <th  ></th>
                                      <th ></th>
                                      <th ></th>
									  <?php } ?>
                                      <th ><?php echo  $row->pay_month_given ." ".$row->pay_year_given;?></th>
                                      <th ><?php echo  $row->pay_basic; $totalbasic = $row->pay_basic ; ?></th>
									   <?php if($dataval[0]['pay_cate_grp'] == 1){  ?>
                                      <th ><?php echo  $row->pay_grp; $totalpay_grp = $row->pay_grp  ; ?></th>
									  <?php }?>
                                      <th ><?php echo  $row->pay_da; $totalpay_da = $row->pay_da  ; ?></th>
                                      <th ><?php  $nb = $row->pay_basic + $row->pay_grp;  echo $newda = round(($nb * getdavalnew($_GET['cate_id'])[0]->salary_da)/100);
									  $totalnewda = $newda; ?></th>
                                      <th colspan="3" ><?php echo $arreas = $newda - $row->pay_da; $totalarreas = $arreas  + $totalarreas ;  ?></th>
                         </tr>
				<?php  }}elseif(count($vae1) != 0 ){ 
							   foreach($vae1 as $row){?>
                                 
                                                  
                                    <tr style="background:#ff00ff" id="<?php echo $emp->emp_id; ?>">
                                    <?php if($empname1 != $empname){ ?>
									  <th  ><?php echo $k; ?></th>
                                              <th ><?php echo  get_tr_unicode($emp->emp_unique_id);     ?></th>
                                      <th ><?php echo $empname;$empname1 = $empname;?></th>
									  <?php }else{ ?>
									  			  <th  ></th>
                                      <th ></th>
                                      <th ></th>
									  <?php } ?>
                                      <th ><?php echo  $row->pay_month ." ".$row->pay_year;?></th>
                                      <th ><?php echo  $row->pay_basic; $totalbasic = $row->pay_basic ; ?></th>
									   <?php if($dataval[0]['pay_cate_grp'] == 1){  ?>
                                      <th ><?php echo  $row->pay_grp; $totalpay_grp = $row->pay_grp  ; ?></th>
									  <?php }?>
                                      <th ><?php echo  $row->pay_da; $totalpay_da = $row->pay_da  ; ?></th>
                                      <th ><?php  $nb = $row->pay_basic + $row->pay_grp;  echo $newda = round(($nb * getdavalnew($_GET['cate_id'])[0]->salary_da)/100);
									  $totalnewda = $newda; ?></th>
                                      <th colspan="3" ><?php echo $arreas = $newda - $row->pay_da; $totalarreas = $arreas  + $totalarreas ;  ?></th>
                         </tr>
                                    
                                    
                                    
                                <?php }}} ?>
                                   
                                    <tr  class="printdark" style="background-color: #4CAF50;color: #000;border: 1px solid #000;
"id="<?php echo $emp->emp_id; ?>">
                                      <th  >&nbsp;</th>
                                      <th >&nbsp;</th>
                                      <th >&nbsp;</th>  <th >&nbsp;</th>
                                      <th ><?php echo $totalbasic ?> <input name="pay_basic<?php echo $emp->emp_unique_id; ?>" id="" value="<?php echo $totalbasic; ?>" type="hidden" ></th>
									    <?php if($dataval[0]['pay_cate_grp'] == 1){  ?>
                                      <th ><?php echo $totalpay_grp ?><input name="pay_grp<?php echo $emp->emp_unique_id; ?>" id="" value="<?php echo $totalpay_grp; ?>" type="hidden" ></th>  
									  <?php } ?>  
									    <th ><?php echo $totalpay_da ?> <input name="pay_da_old<?php echo $emp->emp_unique_id; ?>" id="" value="<?php echo $totalpay_da; ?>" type="hidden" ></th>  
										    <th ><?php echo $totalnewda ?><input name="pay_da_new<?php echo $emp->emp_unique_id; ?>" id="" value="<?php echo $totalnewda ?>" type="hidden" > </th>
											      <th ><?php echo $totalarreas ?> <input name="da[]" id="" value="<?php echo $totalarreas."|". $emp->emp_unique_id; ?>" type="hidden" ><input name="arreas<?php echo $emp->emp_unique_id; ?>" id="" value="<?php echo $totalarreas; ?>" type="hidden" ></th>
                                 </tr>
           
						  
						  <?php $totalpay_daall = $totalpay_da +  $totalpay_daall ; 
						  $totalnewdaall = $totalnewdaall + $totalnewda ; 
						  $totalarreasall = $totalarreasall + $totalarreas; 
						  }  ?>
						  
						                    <tr  class="printdark" style="background-color:#CC6600;color: #000;border: 1px solid #000;
"id="<?php echo $emp->emp_id; ?>">
                                      <th  >&nbsp;</th>
                                      <th >&nbsp;</th>
                                      <th >&nbsp;</th>  <th ><h2>Total</h2></th>
                                      <th ></th>
									    <?php if($dataval[0]['pay_cate_grp'] == 1){  ?>
                                      <th ></th>  
									  <?php } ?>  
									    <th ><?php echo $totalpay_daall ?> </th>  
										    <th ><?php echo $totalnewdaall ?></th>
											      <th ><?php echo $totalarreasall ?> </th>
                                 </tr>
           
</tbody> 


</table>
<div id="bottom_anchor"></div>
</div>



</form>       
    </div>
</div>
  </div>
    </div>
  </section>
  <style>
  
    @media print
{    
    .no-print, .no-print *
    {
        display: none !important;
    }.printdark{
	background-color: #4CAF50;color: #000;border: 1px solid #000;
	}


}
  </style>
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