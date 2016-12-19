<?php //pre($emp_bank);
    foreach ($emp_bank as $key => $pay) {?>
     <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("state");?> : </label>

               <?php echo getState($pay->emp_detail_state); ?>

            </div>
         <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("districk");?> : </label>
               <?php echo getCity($pay->emp_detail_city); ?>
            </div>
      
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("bank_name");?> :  </label>
               <?php echo "State Bank of India"?>
            </div>
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("bank_branch_name");?> :  </label>
               <?php echo $pay->bnk_branch;?>
            </div>
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("bank_ifsc");?> :  </label>
               <?php echo $pay->bank_ifsc;?>
            </div>
      
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("bank_account_no");?> :  </label>
               <?php echo $pay->bank_ac;?>
            </div>
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("ag_series");?> : </label>
               <?php echo $pay->ag_series;?>
            </div><div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("gpf_dpf_code");?> : </label>
               <?php echo $pay->gpf_dpf_code;?>
            </div><div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("contact_no");?> :  </label>
               <?php echo $pay->emp_mobile_number;?>
            </div>
    <?php }?>