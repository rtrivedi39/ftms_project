          <form action="<?php echo base_url();?>payroll/add_emp_salary" method="post">

           <div class="container">
              <ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#home1"><?php echo $this->lang->line('tab1_emp_detail')?></a></li>  
  <li ><a data-toggle="tab" href="#home"><?php echo $this->lang->line('tab1_pay_detail_incrment')?></a></li>
    <li><a data-toggle="tab" href="#menu1"><?php echo $this->lang->line('tab2_pay_gpf')?></a></li>
    <li><a data-toggle="tab" href="#menu2"><?php echo $this->lang->line('tab3_pay_adv')?></a></li>
    <li><a data-toggle="tab" href="#menu3"><?php echo $this->lang->line('tab4_pay_bankdetails')?></a></li>
  </ul>

  <div class="tab-content">
  <div id="home1" class="tab-pane fade in active">
      <h3><?php echo $this->lang->line('tab1_emp_detail')?></h3>
       <div class="col-md-12">
    <div class="box box-primary">
   <div class="box-body">
    <?php  foreach ($emp_details as $key => $pay) {?>
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_arrdhar_card");?></label> <span class="text-danger">*</span></label>
               <input type="text" name="emp_adhar_card_no" id="emp_adhar_card_no" placeholder="<?php echo $this->lang->line('emp_unique_code'); ?>"  value="<?php echo $pay->emp_adhar_card_no;?>" class="form-control">
            <input type="hidden" name="emp_unique_code" id="emp_unique_code"   value="<?php echo $pay->emp_unique_id;?>" class="form-control">
     

            </div>
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("emp_name");?></label> <span class="text-danger">*</span></label>
			   <input type="text" name="emp_house_no" disabled="disabled"id="emp_house_noemp_house_no" placeholder="<?php echo $this->lang->line('emp_unique_code'); ?>"  value="<?php echo $pay->emp_full_name_hi;?>" class="form-control">
            </div>
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("emp_house_no");?></label> <span class="text-danger">*</span></label>
                 <input type="text" name="emp_house_no" id="emp_house_noemp_house_no" placeholder="<?php echo $this->lang->line('emp_unique_code'); ?>"  value="<?php echo $pay->emp_house_no;?>" class="form-control">
              
            </div>
			<div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("emp_mobile_no");?></label> <span class="text-danger">*</span></label>
			   <input type="text" name="emp_house_no" disabled="disabled" id="emp_house_noemp_house_no" placeholder="<?php echo $this->lang->line('emp_unique_code'); ?>"  value="<?php echo $pay->emp_mobile_number;?>" class="form-control">
            </div>
    <?php }?>
</div>
</div></div></div>
    <div id="home" class="tab-pane fade in ">
      <h3><?php echo $this->lang->line('tab1_pay_detail_incrment')?></h3>
       <div class="col-md-12">
    <div class="box box-primary">
        <div class="box-body">
  <?php $this->load->view("pay_addon");?>


</div>
</div>
</div> 
    </div>
    <div id="menu1" class="tab-pane fade">
      <h3><?php echo $this->lang->line('tab2_pay_gpf')?></h3>
        <div class="col-md-12">
    <div class="box box-primary">
        <div class="box-body">
     <?php $this->load->view("pay_diduction");?>
</div>
</div>
</div>  </div>
    <div id="menu2" class="tab-pane fade">
      <h3><?php echo $this->lang->line('tab3_pay_adv')?></h3>
	        
   <?php $this->load->view("pay_advance")?>
  </div>
    </div>
    <div id="menu3" class="tab-pane fade">
      <h3><?php echo $this->lang->line('tab4_pay_bankdetails')?></h3>
     <div class="col-md-12">
    <div class="box box-primary">
        <div class="box-body">
    <?php $this->load->view("pay_bank_details")?>
</div>
</div>
</div>

      </div>
 

   <div class="box-footer">
          <button class="btn btn-primary" type="submit" name="savenotice" id="savenotice"  value="1"><?php echo $this->lang->line('submit_botton'); ?></button>
        </div>

