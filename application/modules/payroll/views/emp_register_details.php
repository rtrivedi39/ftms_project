  <style>

table, th, td {
    border: 1px solid #E2DFDF;
    /* padding: 6px 5px 7px 7px; */
}
table, th, td {
    border: 1px solid #E2DFDF;
    /* padding: 6px 5px 7px 7px; */
}
#table-wrapper {
  position:relative;
}
#table-scroll {
/*  height:150px;*/
  overflow:auto;  
  margin-top:20px;
}
#table-wrapper table {
  width:100%;

}
#table-wrapper table * {
 /* background:yellow;*/
  color:black;
}
#table-wrapper table thead th .text {
  position:absolute;   
  top:-20px;
  z-index:2;
  height:20px;
  width:35%;
  border:1px solid red;
}
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo $title; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo $title; ?></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
        <!-- Your Page Content Here -->
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-tools pull-right">
           
            
                        <a href="javascript:history.go(-1)">
                            <button type="button" class="btn  btn-warning"><?php echo $this->lang->line('Back_button_label'); ?></button>
                        </a>
                    </div>
                   
                    <div class="box-body ">
					
					<a  class="btn btn-primary" href="<?php echo base_url();?>payroll/addarreasentry/<?php echo $_GET['uid'];?>"> Add Arrear Entery </a> 
						<a  class="btn btn-warning" href="<?php echo base_url();?>payroll/addarreasentry/<?php echo $_GET['uid'];?>/lpc"> Add LPC Entery </a>  <button onclick="printContents('table-scroll')" class="btn btn-primary btn-sm no-print">Print</button>
                    <div id="table-wrapper">
  <div id="table-scroll">     <table  cellpadding="0"  style="overflow:scroll;width:100px" cellspacing="0"  border="0">
<th colspan="31" style="
    text-align: center">मध्यप्रदेश शासन विधि एवं विधायी कार्य विभाग</th>
 <?php  $in = 0;  foreach ($pay_regi as $key => $pay) { $in = $in +1 ; if($in == 1){
  ?>

            
     
   <tr>
      <th colspan="31" ><table cellpadding="0" cellspacing="0"  border="0" width="100%" border="1">
          <tr>
            <td >Name :</td>
            <td><?php echo get_employee_gender($pay->emp_id)." ".$pay->emp_full_name_hi." (". get_employee_designation_id($pay->emp_id).")"; ?></td>
            <td >Unique ID</td>
            <td ><?php echo  get_tr_unicode($pay->emp_unique_id);  ?></td>
            <td >Year </td>
            <td ><?php echo $_GET["pay_year"];?></td>
          </tr>
            </table></th>
    </tr>
<?php }}if(count($pay_regi) != 0 ){ ?>

                            
                                <tr >
                                    
                                   
                                   <th ><?php  echo " एरीयर्स / वेतन "; ?></th>
                                    <th ><?php echo $this->lang->line('emp_pay_month'); ?></th>
                           <?php if($dataval[0]['pay_cate_basic'] == 1){  ?>
                            <th ><?php  echo $this->lang->line('basic_pay');  ?></th>
                                 <?php }if($dataval[0]['pay_cate_grp'] == 1){  ?>
                                    <th ><?php echo  $this->lang->line('pay_gradepay');  ?></th>
                              <?php }if($dataval[0]['pay_cate_special'] == 1){  ?>
                                    <th ><?php echo  $this->lang->line('pay_special');   ?></th>
                                    <?php }if($dataval[0]['pay_cate_da'] == 1){  ?>
                                   <th ><?php  echo  $this->lang->line('pay_da');?></th>
                                    <?php }if($dataval[0]['pay_cate_hra'] == 1){  ?>
                                   <th ><?php  echo  $this->lang->line('pay_hra');?></th>


                                   <?php }if($dataval[0]['pay_cate_other_add'] == 1){  ?>
                                    <th ><?php echo $this->lang->line('pay_others'); ?></th>
                                              <?php }if($dataval[0]['pay_cate_sa'] == 1){  ?>
                                    <th ><?php echo $this->lang->line('pay_sa');  ?></th>
                                     <?php }if($dataval[0]['pay_cate_madical'] == 1){  ?>
                                    <th ><?php echo  $this->lang->line('pay_ma'); ?></th>

                                     <?php }if($dataval[0]['pay_cate_sp'] == 1){  ?>
                                     <th ><?php echo $this->lang->line('pay_sp'); ?></th>

                                           <?php }if($dataval[0]['pay_cate_ca'] == 1){  ?>
                                    <th ><?php echo $this->lang->line('pay_ca');?></th>
                                  
                                    <?php } ?>
                            <th ><?php echo $this->lang->line('pay_sum'); ?></th>
                             <?php if($dataval[0]['pay_cate_gpf'] == 1){  ?>
                                    <th ><?php echo  $this->lang->line('pay_gpf'); ?></th>
                                    <?php }if($dataval[0]['pay_cate_gpf_adv'] == 1){  ?>
                                   <th ><?php  echo $this->lang->line('pay_gpf_adv');  ?> </th>
                                   <?php }if($dataval[0]['pay_cate_dpf'] == 1){  ?>
                                    <th ><?php  echo $this->lang->line('pay_dpf'); ?></th>

                                     <?php }if($dataval[0]['pay_cate_dpf_adv'] == 1){  ?>
                                    <th ><?php echo $this->lang->line('pay_dpf_adv');   ?></th>
                                     <?php }if($dataval[0]['pay_cate_gias'] == 1){  ?>
                                    <th ><?php  echo $this->lang->line('pay_gis');?></th>
                                    <?php }if($dataval[0]['pay_cate_defined_contribution'] == 1){  ?>
                                    <th ><?php echo $this->lang->line('pay_define')."dsf"; ?></th>
                                 
                                        <?php }if($dataval[0]['pay_cate_house_loan'] == 1){  ?>
                            <th ><?php echo $this->lang->line('pay_home_loan');?></th>

                            <?php }if($dataval[0]['pay_cate_car_loan'] == 1){  ?>


                                    <th ><?php echo $this->lang->line('pay_car_loan');?></th>

                                        <?php }if($dataval[0]['pay_cate_house_rent'] == 1){  ?>
                                <th ><?php echo $this->lang->line('pay_house_rent'); ?></th>

                             <?php }if($dataval[0]['pay_cate_garain_adv'] == 1){  ?>
                                
                                     <th ><?php echo $this->lang->line('pay_grain_adv'); ?></th>
                                
                                
                                     <?php }if($dataval[0]['pay_cate_fuel_charge'] == 1){  ?>

                                   <th ><?php echo $this->lang->line('pay_fule_charge'); ?></th>

                                         <?php }if($dataval[0]['pay_cate_festival_adv'] == 1){  ?>

                            <th ><?php echo $this->lang->line('pay_festival_adv');  ?></th>


                                      <?php }if($dataval[0]['pay_cate_professional_tax'] == 1){  ?>

                                    <th ><?php echo $this->lang->line('pay_professional_tax'); ?></th>

                                      <?php }if($dataval[0]['pay_cate_income_tax'] == 1){  ?>

                                <th ><?php echo  $this->lang->line('pay_income_tax'); ?></th>

                            
                                  <?php }if($dataval[0]['pay_cate_other_adv'] == 1){  ?>

                                    <th ><?php echo  $this->lang->line('pay_other_adv'); ?></th>

                                    <?php } ?>
                                   <th ><?php echo $this->lang->line('pay_total_cut'); ?></th>
                                   <th ><?php echo $this->lang->line('pay_amount');  ?></th>

									<th ><?php echo "कम्यूटर बिल नंबर "  ?></th>
                                
                                             <th ><?php echo   "कम्यूटर बिल दिनांक" ?></th>
                               
                 <th ><?php echo  " ऑफिस नंबर" ?></th>
                                
                                             <th ><?php echo "वॉचर बिल नंबर " 
											 ?></th>
                               <th ><?php echo "वॉचर बिल दिनांक"   ?></th>
							   
							   <th ><?php echo "ग्रॉस अमाउंट  "  ?></th>
                                    <th ><?php echo "नेट अमाउंट  "  ?></th>
                                     <th ><?php echo "रिमार्क";  ?></th>
                                </tr>
                            
                            <tbody>
                            <?php  $k = 0;$months = ""; $m0 =0;
                $pay_sa ="";$pay_madical=""; $pay_car_loan="";
                 $pay_total =""; $pay_total_cut =""; $pay_grp="";$pay_grp= "";$pay_festival_adv="";$pay_professional_tax="";$pay_income_tax="";
         $pay_other_adv="";$pay_fuel_charge="";$pay_grain_adv="";$pay_house_rent ="";$pay_house_loan="";$pay_gias="";$pay_gpf_adv="";
         $pay_total_sum = ""; $pay_gpf =""; $pay_ca=""; $pay_sp="";$pay_hra="";$pay_da="";$pay_special="";$pay_basic="";
                                foreach ($pay_regi as $key => $pay) { $k++; 
                      
                                     $pay_year = $_GET['pay_year'];
   $pay_year = explode("-", $pay_year);

                               $flyear = getflyear($pay->pay_month_given,$pay_year[0],$pay_year[1],$pay->pay_year_given);
                       
                  //    echo $pay->pay_month_given.",".$pay_year[0].",".$pay_year[1].",".$pay->pay_year_given."<br/>";
                      // echo  "f year".$flyear."<br/>";
                              if($flyear == 1 &&  $flyear != ""  ){
                                   /* if($pay->pay_billno != ""){ */

                                     $m0 =$m0  + 1; ?>
								    <tr  >
                                  
                                    
                                   <th ><?php if($pay->pay_arriyas == 1 ){ echo  $pay->pay_arriyas_name;
																		  echo "</br><a href='".base_url()."payroll/edit_addarreasentry/".$pay->pay_emp_unique_id."/edit/".$pay->pay_id."' class='btn btn-warning no_print'>edit</a>";
																		 
																		 
																		 
																		 }else{ echo "वेतन" ;
																			   if($pay->pay_back_date != 0)
																			  echo "</br><a href='".base_url()."payroll/edit_addarreasentry/".$pay->pay_emp_unique_id."/lpc/edit/".$pay->pay_id."' class='btn btn-warning no_print'>edit</a>";
																			  
																			  }
                              

                                   ?></th>
								   
                                     <th ><?php if($pay->pay_arriyas == 1 ){
												 if(!empty($pay->pay_arriyas_satrdate)){
												 echo $pay->pay_arriyas_satrdate ." से ". $pay->pay_arriyas_enddate;
												 
											 }else{
											  echo "01-".$pay->pay_start_month."-".$pay->pay_arriyas_year." से  30-".$pay->pay_end_month."-".$pay->pay_arriyas_year_end;  
											 }
									 }else{ 
                                        echo $pay->pay_month." ".$pay->pay_year ;   } 
										
										$months .= "'".$pay->pay_month."',"; ?></th>
                                        <?php if($dataval[0]['pay_cate_basic'] == 1){  ?>
                            <th ><?php echo $pay->pay_basic; $pay_basic = $pay_basic + $pay->pay_basic; ?></th>
                                 <?php }if($dataval[0]['pay_cate_grp'] == 1){  ?>
                                    <th ><?php echo  $pay->pay_grp; $pay_grp = $pay_grp +$pay->pay_grp; ?></th>
                              <?php }if($dataval[0]['pay_cate_special'] == 1){  ?>
                                    <th ><?php echo $pay->pay_special;   $pay_special = $pay_special +$pay->pay_special;?></th>
                                    <?php }if($dataval[0]['pay_cate_da'] == 1){  ?>
                                   <th ><?php  echo  $pay->pay_da; $pay_da = $pay_da +$pay->pay_da; ?></th>
                                   <?php }if($dataval[0]['pay_cate_hra'] == 1){  ?>
                                   <th ><?php  echo  $pay->pay_hra;  $pay_hra = $pay_hra +$pay->pay_hra;?></th>
                                   <?php }if($dataval[0]['pay_cate_other_add'] == 1){  ?>
                                    <th ><?php echo $pay->pay_others; $pay_others = $pay_others +$pay->pay_others;?></th>
                                              <?php }if($dataval[0]['pay_cate_sa'] == 1){  ?>
                                    <th ><?php echo $pay->pay_sa;$pay_sa = $pay_sa +$pay->pay_sa;  ?></th>
                                     <?php }if($dataval[0]['pay_cate_madical'] == 1){  ?>
                                    <th ><?php echo $pay->pay_madical; $pay_madical = $pay_madical +$pay->pay_madical;?></th>

                                     <?php }if($dataval[0]['pay_cate_sp'] == 1){  ?>
                                     <th ><?php echo $pay->pay_sp; $pay_sp = $pay_sp +$pay->pay_sp;?></th>

                                           <?php }if($dataval[0]['pay_cate_ca'] == 1){  ?>
                                    <th ><?php echo $pay->pay_ca; $pay_ca = $pay_ca +$pay->pay_ca; ?></th>
                                  
                                    <?php } ?>
                            <th ><?php echo $pay->pay_total_sum;$pay_total_sum = $pay_total_sum +$pay->pay_total_sum; ?></th>
                             <?php if($dataval[0]['pay_cate_gpf'] == 1){  ?>
                                    <th ><?php echo $pay->pay_gpf; $pay_gpf = $pay_gpf +$pay->pay_gpf;?></th>
                                    <?php }if($dataval[0]['pay_cate_gpf_adv'] == 1){  ?>
                                   <th ><?php echo  $pay->pay_gpf_adv; $pay_gpf_adv = $pay_gpf_adv +$pay->pay_gpf_adv; ?> </th>
                                   <?php }if($dataval[0]['pay_cate_dpf'] == 1){  ?>
                                    <th ><?php echo   $pay->pay_dpf;$pay_dpf = $pay_dpf +$pay->pay_dpf; ?></th>

                                     <?php }if($dataval[0]['pay_cate_dpf_adv'] == 1){  ?>
                                    <th ><?php echo   $pay->pay_dpf_adv;$pay_dpf_adv = $pay_dpf_adv +$pay->pay_dpf_adv; ?></th>
                                     <?php }if($dataval[0]['pay_cate_gias'] == 1){  ?>
                                    <th ><?php echo   $pay->pay_gias; $pay_gias = $pay_gias +$pay->pay_gias; ?></th>
                                    <?php }if($dataval[0]['pay_cate_defined_contribution'] == 1){  ?>
                                    <th ><?php echo $pay->pay_defined_contribution;$pay_defined_contribution = $pay_defined_contribution +$pay->pay_defined_contribution; ?></th>
                                 
                                        <?php }if($dataval[0]['pay_cate_house_loan'] == 1){  ?>
                            <th ><?php echo $pay->pay_house_loan;
                            $pay_house_loan = $pay_house_loan +$pay->pay_house_loan; ?></th>

                            <?php }if($dataval[0]['pay_cate_car_loan'] == 1){  ?>


                                    <th ><?php echo $pay->pay_car_loan;$pay_car_loan = $pay_car_loan +$pay->pay_car_loan; ?></th>

                                        <?php }if($dataval[0]['pay_cate_house_rent'] == 1){  ?>
                                <th ><?php echo $pay->pay_house_rent;
                                $pay_house_rent = $pay_house_rent +$pay->pay_house_rent; ?></th>

                             <?php }if($dataval[0]['pay_cate_garain_adv'] == 1){  ?>
                                
                                     <th ><?php echo $pay->pay_grain_adv;
                                     $pay_grain_adv = $pay_grain_adv +$pay->pay_grain_adv; ?></th>
                                
                                
                                     <?php }if($dataval[0]['pay_cate_fuel_charge'] == 1){  ?>

                                   <th ><?php echo $pay->pay_fuel_charge; 
                                   $pay_fuel_charge = $pay_fuel_charge +$pay->pay_fuel_charge;?></th>

                                         <?php }if($dataval[0]['pay_cate_festival_adv'] == 1){  ?>

                            <th ><?php echo $pay->pay_festival_adv; $pay_festival_adv = $pay_festival_adv +$pay->pay_festival_adv;?></th>


                                      <?php }if($dataval[0]['pay_cate_professional_tax'] == 1){  ?>

                                    <th ><?php echo $pay->pay_professional_tax;
                                    $pay_professional_tax = $pay_professional_tax +$pay->pay_professional_tax; ?></th>

                                      <?php }if($dataval[0]['pay_cate_income_tax'] == 1){  ?>

                                <th ><?php echo $pay->pay_income_tax; $pay_income_tax = $pay_income_tax +$pay->pay_income_tax; ?></th>

                            
                                  <?php }if($dataval[0]['pay_cate_other_adv'] == 1){  ?>

                                    <th ><?php echo $pay->pay_other_adv; $pay_other_adv = $pay_other_adv +$pay->pay_other_adv; ?></th>

                                    <?php } ?>
                                   <th ><?php echo $pay->pay_total_cut;
                                   $pay_total_cut = $pay_total_cut +$pay->pay_total_cut; ?></th>
                                   <th ><?php echo $pay->pay_total;  $pay_total = $pay_total + $pay->pay_total; ?></th>
								
								   <?php 
								   if($pay->pay_billno != ""){
								   $vv =getbillnoswithid($pay->pay_billno ); 
								   $k =0; foreach($vv as $bb){ $k =$k +1;if($k == 1){ ?>
								         <th ><?php echo $bb->pbill_computer_no  ?></th>
                                
                                             <th ><?php echo   $bb->pbill_computer_date ?></th>
                               
                 <th ><?php echo $bb->pbill_office_no ?></th>
                                
                                             <th ><?php echo $bb->pbill_vocher_no ?></th>
                               <th ><?php echo $bb->pbill_vocher_date ?></th>
							   
							       <th ><?php echo $bb->pbill_gross_amount ?></th>
							   
							       <th ><?php echo $bb->pbill_net_amont ?></th>
							   
							   
							   
                              
								
								   <?php }}}else{?>
								   <th ></th>
                                
                                             <th ></th>
                               
                 <th ></th>
                                
                                             <th ></th>
                               <th ></th>
							   
							       <th ></th>
							   
							       <th ></th>
							   
								   <?php } ?>
								    <th ><?php echo $pay->pay_remark;  ?>
									
									</th>
                                </tr>
<?php  } /*} */ }   if($m0 != 0 ){ ?>
                                 <?php// $emp_id == $dataval[0]['pay_cate_id'] ;?>
                                              <tr style="background-color: #18981D; color: #fff;font-size: 14px;font-weight: bold;">
                                  
                              
                                  <th ></th>
                                     <th >Total  </th>
                                        <?php if($dataval[0]['pay_cate_basic'] == 1){  ?>
                            <th ><?php echo $pay_basic ;  ?></th>
                                 <?php }if($dataval[0]['pay_cate_grp'] == 1){  ?>
                                    <th ><?php echo  @$pay_grp  ?></th>
                              <?php }if($dataval[0]['pay_cate_special'] == 1){  ?>
                                    <th ><?php echo  @$pay_special;   ?></th>
                                    <?php }if($dataval[0]['pay_cate_da'] == 1){  ?>
                                   <th ><?php  echo  @$pay_da;  ?></th>
  <?php }if($dataval[0]['pay_cate_hra'] == 1){  ?>
                                   <th ><?php  echo  @$pay_hra;  ?></th>

                                   <?php }if($dataval[0]['pay_cate_other_add'] == 1){  ?>
                                    <th ><?php echo  @$pay_others;  ?></th>
                                              <?php }if($dataval[0]['pay_cate_sa'] == 1){  ?>
                                    <th ><?php echo $pay_sa;   ?></th>
                                     <?php }if($dataval[0]['pay_cate_madical'] == 1){  ?>
                                    <th ><?php echo $pay_madical;   ?></th>

                                     <?php }if($dataval[0]['pay_cate_sp'] == 1){  ?>
                                     <th ><?php echo @$pay_sp; ?></th>

                                           <?php }if($dataval[0]['pay_cate_ca'] == 1){  ?>
                                    <th ><?php echo @$pay_ca; ?></th>
                                  
                                    <?php } ?>
                            <th ><?php echo @$pay_total_sum;  ?></th>
                             <?php if($dataval[0]['pay_cate_gpf'] == 1){  ?>
                                    <th ><?php echo  @$pay_gpf;  ?></th>
                                    <?php }if($dataval[0]['pay_cate_gpf_adv'] == 1){  ?>
                                   <th ><?php echo  @$pay_gpf_adv;  ?> </th>
                                   <?php }if($dataval[0]['pay_cate_dpf'] == 1){  ?>
                                    <th ><?php echo    $pay_dpf; ?></th>

                                     <?php }if($dataval[0]['pay_cate_dpf_adv'] == 1){  ?>
                                    <th ><?php echo   $pay_dpf_adv;   ?></th>
                                     <?php }if($dataval[0]['pay_cate_gias'] == 1){  ?>
                                    <th ><?php echo   $pay_gias;  ?></th>
                                    <?php }if($dataval[0]['pay_cate_defined_contribution'] == 1){  ?>
                                    <th ><?php echo $pay_defined_contribution;  ?></th>
                                 
                                        <?php }if($dataval[0]['pay_cate_house_loan'] == 1){  ?>
                            <th ><?php echo  $pay_house_loan; ?></th>

                            <?php }if($dataval[0]['pay_cate_car_loan'] == 1){  ?>


                                    <th ><?php echo $pay_car_loan;  ?></th>

                                        <?php }if($dataval[0]['pay_cate_house_rent'] == 1){  ?>
                                <th ><?php echo $pay_house_rent;  ?></th>

                             <?php }if($dataval[0]['pay_cate_garain_adv'] == 1){  ?>
                                
                                     <th ><?php echo $pay_grain_adv;  ?></th>
                                
                                
                                     <?php }if($dataval[0]['pay_cate_fuel_charge'] == 1){  ?>

                                   <th ><?php echo  $pay_fuel_charge  ?></th>

                                         <?php }if($dataval[0]['pay_cate_festival_adv'] == 1){  ?>

                            <th ><?php echo  $pay_festival_adv ?></th>


                                      <?php }if($dataval[0]['pay_cate_professional_tax'] == 1){  ?>

                                    <th ><?php echo $pay_professional_tax; ?></th>

                                      <?php }if($dataval[0]['pay_cate_income_tax'] == 1){  ?>

                                <th ><?php echo  $pay_income_tax;?></th>

                            
                                  <?php }if($dataval[0]['pay_cate_other_adv'] == 1){  ?>

                                    <th ><?php echo $pay_other_adv; ?></th>

                                    <?php } ?>
                                   <th ><?php echo $pay_total_cut;?></th>
                                   <th ><?php echo $pay_total; ?></th>
                                             <th ></th>
                                
                                             <th ></th>
                               
                 <th ></th>
                                
                                             <th ></th>
                               <th> </th>
							   <th ></th>
							   <th ></th>
                                    <th ></th> 
                                </tr> 
                            </tbody>
                            <?php } } else{?>
<tr><th colspan="22"> No result found </th> </tr> 

                            <?php } ?>
                        </table>
                  </div><!-- /.box-body -->

            </div><!-- /.box -->
   </div><!-- /.box-body -->

            </div><!-- /.box -->
        </div>
    </div><!-- /.row -->
    <!-- Main row -->
</section><!-- /.content -->

