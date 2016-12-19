<?php        if(count($pay_salary) != 0) { ?>
<table border="1" style="background-color:FFFFCC;border-collapse:collapse;border:1px solid FFCC00;color:000000;width:100%" cellpadding="3" cellspacing="3">
<thead>	<tr style="text-align:center">
		<td colspan="32"><h1>मध्यप्रदेश शासन विधि एवं विधायी कार्य विभाग</h1></td>
		
		</tr>
	<?php $emp_id = $this->uri->segment("3"); ?>
	<tr style="text-align:center">
	</tr>


		
                                <tr>
                                    
                                    <th width='5%'><?php echo $this->lang->line('sno')  ?></th>
                                    <th><?php echo $this->lang->line('emp_unique_code')  ?></th>
                                    <th <?php echo "हेड नाम "; ?></th>
                                                                    
                            <th><?php  echo $this->lang->line('basic_pay');  ?></th>
                               
                                    <th <?php echo  $this->lang->line('pay_gradepay');  ?></th>
                            
                                    <th><?php echo  $this->lang->line('pay_special');   ?></th>
                                    
                                   <th ><?php  echo  $this->lang->line('pay_da');?></th>
                                 
                                    <th width='5%'><?php echo $this->lang->line('pay_others'); ?></th>
                                             
                                    <th><?php echo $this->lang->line('pay_sa');  ?></th>
                                     
                                    <th <?php echo  $this->lang->line('pay_ma'); ?></th>

                                     
                                     <th width='5%'><?php echo $this->lang->line('pay_sp'); ?></th>

                                           
                                    <th><?php echo $this->lang->line('pay_ca');?></th>
                                 
                            <th><?php echo $this->lang->line('pay_sum'); ?></th>
                            
                                    <th><?php echo  $this->lang->line('pay_gpf'); ?></th>
                                   
                                   <th ><?php  echo $this->lang->line('pay_gpf_adv');  ?> </th>
                                   
                                    <th width='5%'><?php  echo $this->lang->line('pay_dpf'); ?></th>

                                   
                                    <th><?php echo $this->lang->line('pay_dpf_adv');   ?></th>
                                     
                                    <th <?php  echo $this->lang->line('pay_gis');?></th>
                                   
                                    <th><?php echo $this->lang->line('pay_define')."dsf"; ?></th>
                                 
                            <th><?php echo $this->lang->line('pay_home_loan');?></th>

                                    <th><?php echo $this->lang->line('pay_car_loan');?></th>

                                 
                                <th><?php echo $this->lang->line('pay_house_rent'); ?></th>

                           
                                
                                     <th><?php echo $this->lang->line('pay_grain_adv'); ?></th>
                                
                                
                                   <th ><?php echo $this->lang->line('pay_fule_charge'); ?></th>

                                       

                            <th><?php echo $this->lang->line('pay_festival_adv');  ?></th>


                                    <th <?php echo $this->lang->line('pay_professional_tax'); ?></th>

                          

                                <th> <?php echo  $this->lang->line('pay_income_tax'); ?></th>

                            

                                    <th><?php echo  $this->lang->line('pay_other_adv'); ?></th>

                             
                                   <th ><?php echo $this->lang->line('pay_total_cut'); ?></th>
                                   <th ><?php echo $this->lang->line('pay_amount');  ?></th>
                                </tr>
	
	
                                    <?php $k =0; 
                                     // pre($pay_salary);
                                    foreach ($pay_salary as $key => $pay) { $k++; 
                                      if($pay->no_updated == 0){?>
                                  <tr>
                                  <?php }else{ ?>
                                  <tr style="background-color: #FF8D00;
    color: #ffffff;">
                                    <?php } ?>
                                    <th width='5%'><?php echo $k ;?> </th>
                                    <th><?php echo get_tr_unicode($pay->pay_emp_unique_id); ?></th>
                                    <th> <?php echo gethead($pay->pay_salary_cate_id)[0]->pay_cate_name;?></th>
                                   
                            <th><?php echo $pay->pay_basic;  ?></th>
                                
                                    <th><?php echo $pay->pay_grp;  ?></th>
                             
                                    <th><?php echo $pay->pay_special;   ?></th>
                                    
                                   <th ><?php  echo  $pay->pay_da;  ?></th>
                                   
                                    <th width='5%'><?php echo $pay->pay_others ?></th>
                                        
                                    <th><?php echo $pay->pay_sa;  ?></th>
                                    
                                    <th <?php echo $pay->pay_madical; ?></th>

                                     <th><?php echo $pay->pay_sp; ?></th>

                                    <th><?php echo $pay->pay_ca ?></th>
                                  
                                   
                            <th><?php echo $pay->pay_total_sum; ?></th>
                            
                                    <th><?php echo $pay->pay_gpf; ?></th>
                                  
                                   <th ><?php echo  $pay->pay_gpf_adv; ?> </th>
                                  
                                    <th width='5%'><?php echo   $pay->pay_dpf ?></th>

                                    <th><?php echo   $pay->pay_dpf_adv ?></th>
                                  
                                    <th <?php echo $pay->pay_gias ?> </th>
                                  
                                    <th><?php echo $pay->pay_defined_contribution ?></th>
                                 
                            <th><?php echo $pay->pay_house_loan ?></th>

                         


                                    <th><?php echo $pay->pay_car_loan ?></th>

                              
                                <th><?php echo $pay->pay_house_rent ?></th>

                          
                                
                                     <th><?php echo $pay->pay_grain_adv ?></th>
                                
                                

                                   <th ><?php echo $pay->pay_fuel_charge; ?></th>

                                      

                            <th><?php echo $pay->pay_festival_adv; ?></th>


                                    

                                    <th width='5%'><?php echo $pay->pay_professional_tax; ?></th>

                                     
                                <th <?php echo $pay->pay_income_tax ?></th>

                            

                                    <th><?php echo $pay->pay_other_adv ?></th>

                                   <th ><?php echo $pay->pay_total_cut; ?></th>
                                   <th ><?php echo $pay->pay_total; ?></th>
                                </tr>
	<?php }  ?>


</table>

  <input  type="button" onclick="window.print();" style="background-color: #052B02;border: solid 1px #36730F;margin: 10px auto;
    color: #ffffff;
    padding: 10px;" name="Submit" class="no-print"  value="print" /> <input style="background-color: #052B02;border: solid 1px #36730F;margin: 10px auto;
    color: #ffffff;
    padding: 10px;" class="no-print"  type="button" onclick="window.history.back();" name="Submit" value="Go Back" >

  <?php }else{ ?>
  <div class="error" style="    text-align: center;
    background-color: rgba(244, 67, 54, 0.45);
    font-size: 36px;
    border: 1px solid red;
    width: 100%;">No result Found</div>
  <?php }?>
 <style type="text/css" media="print">
  
  @page { size: landscape; }

  @media print
{    
    .no-print, .no-print *
    {
        display: none !important;
    }
}

</style>