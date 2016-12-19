 <tr style="
    background-color: #8BC34A;
    font-size: 16px;
    font-weight: bold;    color: #000;">

                                  
                                    <th width='5%'></th>
                                    <th width='25%'></th>
                                  <!--  <th width="10%"></th>-->
                                     <th width="10%">Total </th>
                                        <?php if($dataval[0]['pay_cate_basic'] == 1){  ?>
                            <th width='25%'><?php echo  sumcolumn("pay_basic" ,  $this->uri->segment("3"),$this->uri->segment("4"),$this->uri->segment("5"))['val'] ;  ?></th>
                                 <?php }if($dataval[0]['pay_cate_grp'] == 1){  ?>
                                    <th width="10%"><?php echo  @sumcolumn("pay_grp" ,$this->uri->segment("3"),$this->uri->segment("4"),$this->uri->segment("5"))['val'];  ?></th>
                              <?php }if($dataval[0]['pay_cate_special'] == 1){  ?>
                                    <th width='25%'><?php echo  @sumcolumn("pay_special" ,$this->uri->segment("3"),$this->uri->segment("4"),$this->uri->segment("5"))['val']   ?></th>
                                    <?php }if($dataval[0]['pay_cate_da'] == 1){  ?>
                                   <th width="15%"><?php  echo  @sumcolumn("pay_da" ,$this->uri->segment("3"),$this->uri->segment("4"),$this->uri->segment("5"))['val'] ?></th>
                                   <?php }if($dataval[0]['pay_cate_other_add'] == 1){  ?>
                                    <th width='5%'><?php echo  @sumcolumn("pay_others" ,$this->uri->segment("3"),$this->uri->segment("4"),$this->uri->segment("5"))['val']; ?></th>
                                              <?php }if($dataval[0]['pay_cate_sa'] == 1){  ?>
                                    <th width='25%'><?php echo sumcolumn("pay_sa" ,$this->uri->segment("3"),$this->uri->segment("4"),$this->uri->segment("5"))['val'];  ?></th>
                                     <?php }if($dataval[0]['pay_cate_madical'] == 1){  ?>
                                    <th width="10%"><?php echo sumcolumn("pay_madical" ,$this->uri->segment("3"),$this->uri->segment("4"),$this->uri->segment("5"))['val'];  ?></th>

                                     <?php }if($dataval[0]['pay_cate_sp'] == 1){  ?>
                                     <th width='5%'><?php echo @sumcolumn("pay_sp" ,$this->uri->segment("3"),$this->uri->segment("4"),$this->uri->segment("5"))['val'];?></th>

                                           <?php }if($dataval[0]['pay_cate_ca'] == 1){  ?>
                                    <th width='25%'><?php echo @sumcolumn("pay_ca" ,$this->uri->segment("3"),$this->uri->segment("4"),$this->uri->segment("5"))['val'];?></th>
                                                                             <?php }if($dataval[0]['pay_cate_hra'] == 1){  ?>
                                    <th width='25%'><?php echo @sumcolumn("pay_hra" ,$this->uri->segment("3"),$this->uri->segment("4"),$this->uri->segment("5"))['val'];?></th>
                                  
                                    <?php } ?>
                            <th width='25%'><?php echo @sumcolumn("pay_total_sum" ,$this->uri->segment("3"),$this->uri->segment("4"),$this->uri->segment("5"))['val']; ?></th>
                             <?php if($dataval[0]['pay_cate_gpf'] == 1){  ?>
                                    <th width='25%'><?php echo  @sumcolumn("pay_gpf" ,$this->uri->segment("3"),$this->uri->segment("4"),$this->uri->segment("5"))['val']; ?></th>
                                    <?php }if($dataval[0]['pay_cate_gpf_adv'] == 1){  ?>
                                   <th width="15%"><?php echo  @sumcolumn("pay_gpf_adv" ,$this->uri->segment("3"),$this->uri->segment("4"),$this->uri->segment("5"))['val']; ?> </th>
                                   <?php }if($dataval[0]['pay_cate_dpf'] == 1){  ?>
                                    <th width='5%'><?php echo    sumcolumn("pay_dpf" ,$this->uri->segment("3"),$this->uri->segment("4"),$this->uri->segment("5"))['val'] ?></th>

                                     <?php }if($dataval[0]['pay_cate_dpf_adv'] == 1){  ?>
                                    <th width='25%'><?php echo   sumcolumn("pay_dpf_adv" ,$this->uri->segment("3"),$this->uri->segment("4"),$this->uri->segment("5"))['val']  ?></th>
                                   <?php }if($dataval[0]['pay_cate_defined_contribution'] == 1){  ?>
                                    <th width='25%'><?php echo sumcolumn("pay_defined_contribution" ,$this->uri->segment("3"),$this->uri->segment("4"),$this->uri->segment("5"))['val'] ?></th>
                                     <?php }if($dataval[0]['pay_cate_gias'] == 1){  ?>
                                    <th width="10%"><?php echo   sumcolumn("pay_gias" ,$this->uri->segment("3"),$this->uri->segment("4"),$this->uri->segment("5"))['val'] ?></th>
                                  
                                        <?php }if($dataval[0]['pay_cate_house_loan'] == 1){  ?>
                            <th width='25%'><?php echo  sumcolumn("pay_house_loan" ,$this->uri->segment("3"),$this->uri->segment("4"),$this->uri->segment("5"))['val']?></th>

                            <?php }if($dataval[0]['pay_cate_car_loan'] == 1){  ?>


                                    <th width='25%'><?php echo sumcolumn("pay_car_loan" ,$this->uri->segment("3"),$this->uri->segment("4"),$this->uri->segment("5"))['val'] ?></th>

                                        <?php }if($dataval[0]['pay_cate_house_rent'] == 1){  ?>
                                <th width='25%'><?php echo sumcolumn("pay_house_rent" ,$this->uri->segment("3"),$this->uri->segment("4"),$this->uri->segment("5"))['val'] ?></th>

                          
                                
                                     <?php }if($dataval[0]['pay_cate_fuel_charge'] == 1){  ?>

                                   <th width="15%"><?php echo  sumcolumn("pay_fuel_charge" ,$this->uri->segment("3"),$this->uri->segment("4"),$this->uri->segment("5"))['val'] ?></th>

                                      <?php }if($dataval[0]['pay_cate_garain_adv'] == 1){  ?>
                                
                                     <th width='25%'><?php echo sumcolumn("pay_grain_adv" ,$this->uri->segment("3"),$this->uri->segment("4"),$this->uri->segment("5"))['val'] ?></th>
                                      <?php }if($dataval[0]['pay_cate_festival_adv'] == 1){  ?>

                            <th width='25%'><?php echo  sumcolumn("pay_festival_adv" ,$this->uri->segment("3"),$this->uri->segment("4"),$this->uri->segment("5"))['val'] ?></th>


                                      <?php }if($dataval[0]['pay_cate_professional_tax'] == 1){  ?>

                                    <th width='5%'><?php echo sumcolumn("pay_professional_tax" ,$this->uri->segment("3"),$this->uri->segment("4"),$this->uri->segment("5"))['val'] ?></th>

                                      <?php }if($dataval[0]['pay_cate_income_tax'] == 1){  ?>

                                <th width="10%"><?php echo  sumcolumn("pay_income_tax" ,$this->uri->segment("3"),$this->uri->segment("4"),$this->uri->segment("5"))['val'] ?></th>

                            
                                  <?php }if($dataval[0]['pay_cate_other_adv'] == 1){  ?>

                                    <th width='25%'><?php echo sumcolumn("pay_other_adv" ,$this->uri->segment("3"),$this->uri->segment("4"),$this->uri->segment("5"))['val'] ?></th>

                                    <?php } ?>
                                   <th width="15%"><?php echo sumcolumn("pay_total_cut" ,$this->uri->segment("3"),$this->uri->segment("4"),$this->uri->segment("5"))['val'] ?></th>
                                   <th width="15%"><?php echo  sumcolumn("pay_total" ,$this->uri->segment("3"),$this->uri->segment("4"),$this->uri->segment("5"))['val']  ?></th>
                              <th width="15%"></th>
                             

                                </tr></tfoot>