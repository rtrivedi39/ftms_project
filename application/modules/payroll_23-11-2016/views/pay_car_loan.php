<table  class="" >
<thead>   <tr>
                    <th width='15%'> </th>
                                    <th width='25%'><?php   $dd_key = $this->uri->segment(3); echo $this->lang->line('emp_unique_code')  ?></th>
                                    <th width="20%"><?php echo $this->lang->line('emp_name'); ?></th>
                                        
                                     
                                
                          <th width='25%'><?php echo  "गृह निर्माण अग्रिम"; ?></th>
                        
                                       
                                </tr>
  </thead>                  <?php $k =0; $tt = 0;foreach ($pay_salary as $key => $pay) { $k++;


                                  if($dd_key == "pay_gpf"){$dd =$pay->pay_gpf; }
                                    elseif($dd_key == "pay_dpf"){$dd =$pay->pay_dpf; }
                                       elseif($dd_key == "pay_gias"){$dd =$pay->pay_gias ;}
                                         elseif($dd_key == "pay_defined_contribution"){$dd =$pay->pay_defined_contribution; }
                                           elseif($dd_key == "pay_house_loan"){$dd =$pay->pay_house_loan; }
                                             elseif($dd_key == "pay_car_loan"){$dd =$pay->pay_car_loan ;} 
                                              elseif($dd_key == "pay_house_rent"){$dd =$pay->pay_house_rent ;}
                                                elseif($dd_key == "pay_fuel_charge"){$dd =$pay->pay_fuel_charge; }
                                                  elseif($dd_key == "pay_festival_adv"){$dd =$pay->pay_festival_adv ;}
                                                    elseif($dd_key == "pay_grain_adv"){$dd =$pay->pay_grain_adv; }
                                          elseif($dd_key == "pay_professional_tax"){$dd =$pay->pay_professional_tax; }
                                                  elseif($dd_key == "pay_income_tax"){$dd =$pay->pay_income_tax; }
                                                                           ?> 
                                      ?>
                          <tr id="<?php echo $pay->pay_id; ?>">
                           

                                  <td ><?php echo $k;?></td>
                                    <td width='25%'><?php  echo  get_tr_unicode($pay->pay_emp_unique_id); ?></td>
                                 <td ><?php echo get_employee_gender(emp_nmae($pay->pay_emp_unique_id)[0]->emp_id) ." ". emp_nmae($pay->pay_emp_unique_id)[0]->emp_full_name_hi; ?></td>
                                
                               
                                    <td width='25%'> <?php echo $dd; ?></td>    

                              

                                  
                                </tr>
                         
  <?php }  ?><tfoot>
      <tr style="background-color: #8BC34A; font-size: 16px;font-weight: bold;    color: #000;">

                                  
                                <th width="10%"></th> 
                                    <th width="10%"></th> 
                                  
                                     <th width="10%">Total </th>
                                  
                                    
 <th width="10%"><?php echo  sumcolumn($dd_key ,$this->uri->segment("4"),$this->uri->segment("5"))['val']; ?></th>
                               
                                </tr></tfoot>

                    
</table> 