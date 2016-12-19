<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
   <?php echo $title; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo $title; ?></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Your Page Content Here -->
    <!-- Small boxes (Stat box) -->
  
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <!-- small box -->
            <div class="box box-warning">
                <div class="box-header">
                  <!--  <h3>यह आपकी पर्सनल जानकारी है अगर इसमे किसी प्रकार की त्रुटी दिखाई दे तो हमें अवश्य सूचित करे|</h3> -->
                </div>
           <div class="container"><h2><?php echo $title;?></h2>
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
    <?php foreach ($pay_regi as $key => $pay) {?>
     
      
      
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_arrdhar_card");?></label> <span class="text-danger">*</span></label>
               <?php echo $pay->emp_adhar_card_no;?>
            </div>
      
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("emp_name");?></label> <span class="text-danger">*</span></label>
               <?php echo $pay->emp_full_name_hi;?>
            </div>
      
    
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("emp_house_no");?></label> <span class="text-danger">*</span></label>
               <?php echo $pay->emp_house_no;?>
            </div><div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("emp_mobile_no");?></label> <span class="text-danger">*</span></label>
               <?php echo $pay->emp_mobile_number;?>
            </div><div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("emp_pay_month");?></label> <span class="text-danger">*</span></label>
               <?php echo date("M",strtotime($pay->pay_month));?>
            </div>
    <?php }?>
</div>
</div></div></div>
    <div id="home" class="tab-pane fade in active">
      <h3><?php echo $this->lang->line('tab1_pay_detail_incrment')?></h3>
       <div class="col-md-12">
    <div class="box box-primary">
        <div class="box-body">
    <?php foreach ($pay_regi as $key => $pay) {?>
     <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("basic_pay");?></label> <span class="text-danger">*</span></label>
               <?php echo $pay->pay_basic; ?>
            </div>
         <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_da");?></label> <span class="text-danger">*</span></label>
               <?php echo $pay->pay_da; ?>
            </div>
      
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_special");?></label> <span class="text-danger">*</span></label>
               <?php echo $pay->pay_special;?>
            </div>
      
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_hra");?></label> <span class="text-danger">*</span></label>
               <?php echo $pay->pay_hra;?>
            </div>
      
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_sa");?></label> <span class="text-danger">*</span></label>
               <?php echo $pay->pay_sa;?>
            </div>
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_ma");?></label> <span class="text-danger">*</span></label>
               <?php echo $pay->pay_madical;?>
            </div><div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_sum");?></label> <span class="text-danger">*</span></label>
               <?php echo $pay->pay_professional_tax;?>
            </div><div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_income_tax");?></label> <span class="text-danger">*</span></label>
               <?php echo $pay->pay_total_sum;?>
            </div>
    <?php }?>
</div>
</div>
</div> 
    </div>
    <div id="menu1" class="tab-pane fade">
      <h3><?php echo $this->lang->line('tab2_pay_gpf')?></h3>
        <div class="col-md-12">
    <div class="box box-primary">
        <div class="box-body">
    <?php foreach ($pay_regi as $key => $pay) {?>
     <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_gpf");?></label> <span class="text-danger">*</span></label>
               <?php echo $pay->pay_gpf; ?>
            </div>
         <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_gpf_adv");?></label> <span class="text-danger">*</span></label>
               <?php echo $pay->pay_gpf_adv; ?>
            </div>
      
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_gis");?></label> <span class="text-danger">*</span></label>
               <?php echo $pay->pay_gias;?>
            </div>
      
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_home_loan");?></label> <span class="text-danger">*</span></label>
               <?php echo $pay->pay_house_loan;?>
            </div>
      
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_car_loan");?></label> <span class="text-danger">*</span></label>
               <?php echo $pay->pay_house_loan;?>
            </div>
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_fule_charge");?></label> <span class="text-danger">*</span></label>
               <?php echo $pay->pay_fuel_charge;?>
            </div><div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_professional_tax");?></label> <span class="text-danger">*</span></label>
               <?php echo $pay->pay_professional_tax;?>
            </div><div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_income_tax");?></label> <span class="text-danger">*</span></label>
               <?php echo $pay->pay_income_tax;?>
            </div>
    <?php }?>
</div>
</div>
</div>  </div>
    <div id="menu2" class="tab-pane fade">
      <h3><?php echo $this->lang->line('tab3_pay_adv')?></h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>
    <div id="menu3" class="tab-pane fade">
      <h3><?php echo $this->lang->line('tab4_pay_bankdetails')?></h3>
     <div class="col-md-12">
    <div class="box box-primary">
        <div class="box-body">
    <?php foreach ($emp_bank as $key => $pay) {?>
     <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("state");?></label> <span class="text-danger">*</span></label>
               <?php echo $pay->peb_state_id; ?>
            </div>
         <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("districk");?></label> <span class="text-danger">*</span></label>
               <?php echo $pay->peb_district; ?>
            </div>
      
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("bank_name");?></label> <span class="text-danger">*</span></label>
               <?php echo $pay->peb_bank_name;?>
            </div>
      
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("bank_ifsc");?></label> <span class="text-danger">*</span></label>
               <?php echo $pay->peb_ifsc_code;?>
            </div>
      
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("bank_account_no");?></label> <span class="text-danger">*</span></label>
               <?php echo $pay->peb_bank_account_no;?>
            </div>
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("ag_series");?></label> <span class="text-danger">*</span></label>
               <?php echo $pay->peb_ag_series;?>
            </div><div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("gpf_dpf_code");?></label> <span class="text-danger">*</span></label>
               <?php echo $pay->peb_gpf_dpf_nps_code;?>
            </div><div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("contact_no");?></label> <span class="text-danger">*</span></label>
               <?php echo $pay->emp_mobile_number;?>
            </div>
    <?php }?>
</div>
</div>
</div>

      </div>
  </div> </div>
       </div>
        </div>
    </div>
</section><!-- /.content -->