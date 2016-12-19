          <form action="<?php echo base_url();?>payroll/add_emp_salary" method="post">

           <div class="container">

 <fieldset class="scheduler-border">
    <legend class="scheduler-border"><?php echo $this->lang->line('employee_on_leave')?></legend>
    <div class="control-group">
          <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line('How_many_employees_on_leave_days_employees');?> </label>
        <select name="pay_day" id="pay_day"  class="form-control">
                                <option value=""><?php echo $this->lang->line('How_many_employees_on_leave_days_employees'); ?></option>
                                <?php for ($m=1; $m<=31; $m++) {
   
     
     ?>
                                    <option value="<?php echo $m ?>"  ><?php echo $m ?></option>
                                <?php } ?>>
           </select></div>
</div>
</fieldset>




  <fieldset class="scheduler-border">
    <legend class="scheduler-border"><?php echo $this->lang->line('tab1_emp_detail')?></legend>
    <div class="control-group">
      <?php  foreach ($emp_details as $key => $pay) {?>
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_arrdhar_card");?></label> <span class="text-danger">*</span></label>
               <input type="text" name="emp_adhar_card_no"  disabled="disabled" id="emp_adhar_card_no" placeholder="<?php echo $this->lang->line('emp_unique_code'); ?>"  value="<?php echo $pay->emp_adhar_card_no;?>" class="form-control">
            <input type="hidden" name="emp_unique_code" id="emp_unique_code"   value="<?php echo $pay->emp_unique_id;?>" class="form-control">
     
<input type="hidden" name="pay_salary_cate_id" id="pay_salary_cate_id"   value="<?php echo $pay->emp_pay_cate_id;?>" class="form-control">
     
            </div>
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("emp_name");?></label> <span class="text-danger">*</span></label>
         <input type="text" name="emp_house_no" disabled="disabled"id="emp_house_noemp_house_no" placeholder="<?php echo $this->lang->line('emp_unique_code'); ?>"  value="<?php echo $pay->emp_full_name_hi;?>" class="form-control">
            </div>
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("emp_house_no");?></label> <span class="text-danger">*</span></label>
                 <input type="text" name="emp_house_no" disabled="disabled" id="emp_house_noemp_house_no" placeholder="<?php echo $this->lang->line('emp_unique_code'); ?>"  value="<?php echo $pay->emp_house_no;?>" class="form-control">
              
            </div>
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("emp_mobile_no");?></label> <span class="text-danger">*</span></label>
         <input type="text" name="emp_house_no" disabled="disabled" id="emp_house_noemp_house_no" placeholder="<?php echo $this->lang->line('emp_unique_code'); ?>"  value="<?php echo $pay->emp_mobile_number;?>" class="form-control">
            </div>
    <?php }?>
</div>
</fieldset>
 <fieldset class="scheduler-border">
    <legend class="scheduler-border"><?php echo $this->lang->line('tab1_pay_detail_incrment')?></legend>
    <div class="control-group">
<?php $this->load->view("pay_addon");?>


</div>

</fieldset>
 <fieldset class="scheduler-border">
    <legend class="scheduler-border"><?php echo $this->lang->line('tab2_pay_gpf')?></legend>
    <div class="control-group">
<?php $this->load->view("pay_diduction");?>


</div>

</fieldset>
 <fieldset class="scheduler-border">
    <legend class="scheduler-border"><?php echo $this->lang->line('tab3_pay_adv')?></legend>
    <div class="control-group">
<?php $this->load->view("pay_advance");?>


</div>

</fieldset>

<fieldset class="scheduler-border">
    <legend class="scheduler-border"><?php echo $this->lang->line('tab4_pay_bankdetails')?></legend>
    <div class="control-group">
  <?php $this->load->view("pay_bank_details")?>


</div>

</fieldset>
   <div class="box-footer">
          <button class="btn btn-primary" type="submit" name="savenotice" id="savenotice"  value="1"><?php echo $this->lang->line('submit_botton'); ?></button>
        </div>
      </div>

<style type="text/css">

fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}

legend.scheduler-border {
    font-size: 1.2em !important;
    font-weight: bold !important;
    text-align: left !important;

}
</style>