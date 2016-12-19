
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo "  कर्मचारी अग्रिम "; ?>
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
                    <h1 ><?php echo "  कर्मचारी अग्रिम";   ?></h1>
                </div>
                <div class="box-body">
                    <?php //$this->load->view('payroll_header') ?>
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
               	  <form action="<?php echo base_url();?>payroll/add_empadv" method="post">

<div class="col-lg-12 "> 
       <div class="box-header box-warning">
                      <h3>अधिकारी / कर्मचारी  नाम</h3>
                    </div>
                      <div class="form-group">
                <label for="file_type"><?php echo "अधिकारी / कर्मचारी  नाम";?></label> <span class="text-danger">*</span></label>
                 
                 <!-- <select name="pay_emp_unique_id" name="pay_emp_unique_id" required  class="form-control">
                                <option value=""><?php echo "अधिकारी / कर्मचारी  नाम" ?></option>
                                <?php foreach ($emp as $key => $value) {
                                  if($value->emp_pay_cate_id  == 2 || $value->emp_pay_cate_id == 3 || $value->emp_pay_cate_id == 4){
                                $name=  $value->emp_unique_id."  [". get_employee_gender($value->emp_id).$value->emp_full_name_hi."]";
                           
     
     ?>
                                    <option value="<?php echo $value->emp_unique_id ?>" ><?php echo $name; ?></option>
                                <?php } } ?>
                            </select>  -->
                              <input type="text"  name="pay_emp_unique_id" id="pay_emp_unique_id" value="" class="form-control">
         

            </div>  
 

  <div class="form-group">
                <label for="file_type"><?php echo " अग्रिम हेड";?></label> <span class="text-danger">*</span></label>
                 
                 <select name="cate_id" name="cate_id" required  class="form-control">
                                <option value=""><?php echo "अग्रिम हेड" ?></option>
                                <?php foreach ($alladv as $key => $value) {
                            
     
     ?>
                                    <option value="<?php echo $value->adv_id ?>" ><?php echo $value->adv_name_hi; ?></option>
                                <?php } ?>
                            </select> 

            </div>  

               	  	
       


 
  
     <div class="form-group">
                <label for="file_type"><?php echo "किश्त संख्या"?></label> <span class="text-danger">*</span></label>
                  <select name="pea_emi" name="pea_emi" required  class="form-control">
                                <option value=""><?php echo "किश्त संख्या" ?></option>
                                <?php for($a=0;$a <=30;$a++) {
                            
     
     ?>
                                    <option value="<?php echo $a ?>" ><?php echo $a ?></option>
                                <?php } ?>
                            </select> 
               
            </div>  


             <div class="form-group ">
                <label for="file_type"><?php echo "अग्रमी किश्त  शुरू करने का माह "?></label> <span class="text-danger">*</span></label>
                 
                 <select name="pea_starting_month" name="pea_starting_month" required  class="form-control">
                                <option value=""><?php echo "अग्रमी किश्त  शुरू करने का माह" ?></option>
                             <?php for ($m=1; $m<=12; $m++) {
     $month = date('F', mktime(0,0,0,$m, 1, date('Y')));
     
     ?>
                                    <option value="<?php echo $month?>"  ><?php echo $month ?></option>
                                <?php } ?>
                            </select> 
            </div>

             <div class="form-group ">
                <label for="file_type"><?php echo "अग्रमी किश्त  शुरू करने का साल "?></label> <span class="text-danger">*</span></label>
                 
                 <select name="pea_starting_year" name="pea_starting_year" required  class="form-control">
                                <option value=""><?php echo "अग्रमी किश्त  शुरू करने का साल" ?></option>
                             <?php for ($m=2015; $m<=2016; $m++) {
    
     ?>
                                    <option value="<?php echo $m?>"  ><?php echo $m ?></option>
                                <?php } ?>
                            </select> 
            </div>


         <div class="form-group">
                <label for="file_type"><?php echo "अग्रिम राशि";?></label> <span class="text-danger">*</span></label>
               <input type="number" name="pea_amount"  id="pea_amount"   value="" class="form-control">
               
            </div>

      <div class="form-group">
                <label for="file_type"><?php echo "अग्रिम ब्याज दर";?></label> <span class="text-danger">*</span></label>
              
               <input type="text"  name="pae_interest" id="pae_interest" value="" class="form-control">
            </div>
 
      <div class="form-group">
                <label for="file_type"><?php echo "किश्त राशि";?></label> <span class="text-danger">*</span></label>
              
               <input type="text"  name="pea_emi_amount" id="pea_emi_amount" value="" class="form-control">
            </div>
                 	  <div class="box-footer">
          <button class="btn btn-primary" type="submit" name="savenotice" id="savenotice"  value="1"><?php echo $this->lang->line('submit_botton'); ?></button>
        </div>

             </div> </div><!-- /.box --></div>
        </div>
    </div><!-- /.row -->
    <!-- Main row -->
</section><!-- /.content -->

<!-- Modal approve -->
