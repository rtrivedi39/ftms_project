
             
                  <select  name="pay_buget" class="form-control">
                         
                                <?php foreach ($dataval as $key => $pcate) {  ?>
                                    <option value="<?php echo $pcate->pay_cate_budget_no ?>"  ><?php echo $pcate->pay_cate_budget_no ?></option>
                                <?php } ?>
                            </select> 
