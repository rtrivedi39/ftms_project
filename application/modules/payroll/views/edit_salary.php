
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php //echo $title; ?>
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
                    <h1 ><?php echo $emp_details[0]->emp_full_name;    ?></h1>
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
               	  <form action="<?php echo base_url();?>payroll/edit_slary_emp" method="post">
               	  	<div class="col-lg-6 "> 
               	  		   <div class="box-header box-warning">
               	  		<h3>वेतन अभिलेख / वेतन वृद्धि</h3>
               	  	</div>
           <?php


 	if(count($pay_salary) != 0){
 	$i=0; 	
 		foreach ($pay_salary as $key => $pay) { 

      ?>
  <input type="hidden" name="pay_salary_cate_id" id="pay_salary_cate_id" value="<?php echo $pay->pay_salary_cate_id  ?>" class="form-control">
                <input type="hidden" name="pay_id" id="pay_id" value="<?php echo $pay->pay_id;  ?>" class="form-control">
                  <input type="hidden" name="pay_month" id="pay_month" value="<?php echo $pay->pay_month;  ?>" class="form-control">
               <input type="hidden" name="no_updated" id="no_updated" value="<?php echo $pay->no_updated +1;  ?>" class="form-control">
               
      <?php
               if($dataval[0]['pay_cate_basic'] == 1){	?>
     <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("basic_pay");?></label> <span class="text-danger">*</span></label>
                  <input type="number" onfocus="totalvalue()" name="pay_basic" id="pay_basic" placeholder="<?php echo $this->lang->line('emp_unique_code'); ?>"  value="<?php echo $pay->pay_basic; ?>" class="form-control">
               
            </div>  

<?php }if($dataval[0]['pay_cate_grp'] == 1){	?>
             <div class="form-group ">
                <label for="file_type"><?php echo $this->lang->line("pay_gradepay");?></label> <span class="text-danger">*</span></label>
                  <input type="number" onfocus="totalvalue()" name="pay_gradepay" id="pay_gradepay" placeholder="<?php echo $this->lang->line('pay_gradepay'); ?>" value="<?php echo @$pay->pay_grp; ?>" class="form-control">
              
            </div>

<?php }if($dataval[0]['pay_cate_da'] == 1){	?>

         <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_da");?></label> <span class="text-danger">*</span></label>
               <input type="number" onfocus="totalvalue()" name="pay_da"  onfocus="showday()" id="pay_da" placeholder="<?php echo $this->lang->line('emp_unique_code'); ?>"  value="<?php echo $pay->pay_da; ?>" class="form-control">
               
            </div>
      <?php }if($dataval[0]['pay_cate_special'] == 1){	?>
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_special");?></label> <span class="text-danger">*</span></label>
              
               <input type="number" onfocus="totalvalue()" name="pay_special" id="pay_special" placeholder="<?php echo $this->lang->line('emp_unique_code'); ?>"  value="<?php echo $pay->pay_special; ?>" class="form-control">
            </div>
      <?php }if($dataval[0]['pay_cate_hra'] == 1){	?>
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_hra");?></label> <span class="text-danger">*</span></label>
      
                        <input type="text" onfocus="totalvalue()" name="pay_hra" id="pay_hra" placeholder="<?php echo $this->lang->line('emp_unique_code'); ?>"  value="<?php echo $pay->pay_hra;?>" class="form-control">
            </div>
      <?php }if($dataval[0]['pay_cate_sa'] == 1){	?>
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_sa");?></label> <span class="text-danger">*</span></label>
               
                <input type="number" onfocus="totalvalue()" name="pay_sa" id="pay_sa" placeholder="<?php echo $this->lang->line('pay_sa'); ?>"  value="<?php echo $pay->pay_sa;?>" class="form-control">
            </div>
             <?php }if($dataval[0]['pay_cate_madical'] == 1){	?> 
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_ma");?></label> <span class="text-danger">*</span></label>
               
                <input type="number" onfocus="totalvalue()" name="pay_madical" id="pay_madical" placeholder="<?php echo $this->lang->line('pay_ma'); ?>"  value="<?php echo $pay->pay_madical;?>" class="form-control">
            </div>
               <?php }if($dataval[0]['pay_cate_ca'] == 1){	?> 
				<div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_ca");?></label> <span class="text-danger">*</span></label>
               
                <input type="number" name="pay_ca" id="pay_ca" placeholder="<?php echo $this->lang->line("pay_ca");?>"  value="<?php echo $pay->pay_ca;?>" class="form-control">
            </div>
			   <?php }if($dataval[0]['pay_cate_sp'] == 1){	?> 
			<div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_sp");?></label> <span class="text-danger">*</span></label>
               
                <input type="number" onfocus="totalvalue()" name="pay_sp" id="pay_sp" placeholder="<?php echo $this->lang->line("pay_sp");?>"  value="<?php echo $pay->pay_sp;?>" class="form-control">
            </div>
			<?php } ?>
			<div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_others");?></label> <span class="text-danger">*</span></label>
               
                <input type="number" onfocus="totalvalue()" name="pay_others" id="pay_others" placeholder="<?php echo $this->lang->line("pay_others");?>"  value="<?php echo $pay->pay_others;?>" class="form-control">
            </div>
			
			<div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_sum");?></label> <span class="text-danger">*</span></label>
                <input type="number" onfocus="totalvalue()" name="pay_total_sum" id="pay_total_sum" placeholder="<?php echo $this->lang->line('pay_ma'); ?>"  value="<?php echo $pay->pay_total_sum;?>" class="form-control">
              
            </div>
        </div ><div class="col-lg-6 ">

        	   <div class="box-header box-warning">
               	  		<h3>वेतन कटौती राशि</h3>
               	  	</div>

      
         <?php   if($dataval[0]['pay_cate_gpf'] == 1){ ?>
     <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_gpf");?></label> <span class="text-danger">*</span></label>
               
                <input type="number"  name="pay_gpf" id="pay_gpf" placeholder="<?php echo $this->lang->line('pay_ma'); ?>"  value="<?php echo $pay->pay_gpf;?>" class="form-control">
              
            </div>
          <?php }  if($dataval[0]['pay_cate_dpf'] == 1){ ?>
     <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_dpf");?></label> <span class="text-danger">*</span></label>
               
                <input type="number" name="pay_dpf" id="pay_dpf" placeholder="<?php echo $this->lang->line('pay_cate_dpf'); ?>"  value="<?php echo $pay->pay_gpf;?>" class="form-control">
              
            </div>
            
            <?php }if($dataval[0]['pay_cate_defined_contribution'] == 1){  ?>

         <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_define");?></label> <span class="text-danger">*</span></label>
               
                       <input type="number" name="pay_define" id="pay_define" placeholder="<?php echo $this->lang->line('pay_ma'); ?>"  value="<?php echo $pay->pay_defined_contribution;?>" class="form-control">
            </div>
        <?php }if($dataval[0]['pay_cate_gias'] == 1){  ?>
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_gis");?></label> <span class="text-danger">*</span></label>
               
                 <input type="number" name="pay_gias" id="pay_gias" placeholder="<?php echo $this->lang->line('pay_gis'); ?>"  value="<?php echo $pay->pay_gias;?>" class="form-control">
            </div>
        <?php }if($dataval[0]['pay_cate_house_rent'] == 1){  ?>
       <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_house_rent");?></label> <span class="text-danger">*</span></label>
            
               <input type="number" name="pay_house_rent" id="pay_house_rent" placeholder="<?php echo $this->lang->line('pay_house_rent'); ?>"  value="<?php echo $pay->pay_house_rent;?>" class="form-control">
            </div>
		<?php }if($dataval[0]['pay_cate_fuel_charge'] == 1){  ?>
                  <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_fule_charge");?></label> <span class="text-danger">*</span></label>
            
               <input type="number" name="pay_fuel_charge" id="pay_fuel_charge" placeholder="<?php echo $this->lang->line('pay_gis'); ?>"  value="<?php echo $pay->pay_fuel_charge;?>" class="form-control">
            </div>
			<?php }if($dataval[0]['pay_cate_professional_tax'] == 1){  ?>
			
			  
			<div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_professional_tax");?></label> <span class="text-danger">*</span></label>
          
               <input type="number" name="pay_professional_tax" id="pay_professional_tax" placeholder="<?php echo $this->lang->line('pay_gis'); ?>"  value="<?php echo $pay->pay_professional_tax;?>" class="form-control">
            </div>
            <?php }if($dataval[0]['pay_cate_income_tax'] == 1){  ?>
            <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_income_tax");?></label> <span class="text-danger">*</span></label>
               
                  <input type="number" name="pay_income_tax" id="pay_income_tax" placeholder="<?php echo $this->lang->line('pay_gis'); ?>"  value="<?php echo $pay->pay_income_tax;?>" class="form-control">
            </div>
           <?php }if($dataval[0]['pay_cate_other_adv'] == 1){  ?>
            <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_other_adv");?></label> <span class="text-danger">*</span></label>
               
                  <input type="number" name="pay_cate_other_adv" id="pay_cate_other_adv" placeholder="<?php echo $this->lang->line('pay_other_adv'); ?>"  value="<?php echo $pay->pay_other_adv;?>" class="form-control">
            </div>
            <?php } ?>
	            <div class="form-group">
	                <label for="file_type"><?php echo $this->lang->line("pay_total_cut");?></label> <span class="text-danger">*</span></label>
	               
	                  <input type="number" name="pay_total_cut" onfocus="showtotal_DIII()" id="pay_total_cut" placeholder="<?php echo $this->lang->line('pay_total_cut'); ?>"  value="<?php echo $pay->pay_total_cut;?>" class="form-control">
	            </div>
        <div class="form-group ">
	                <label for="file_type">कुल </label> <span class="text-danger">*</span></label>
	               
	                  <input type="number" name="pay_total" onfocus="" id="pay_total" placeholder=""  value="<?php echo $pay->pay_total;?>" class="form-control">
	            </div>
     </div>
		
            
<?php 
	} 

	}

//pre($pay_salary);


?>

               	  <div class="box-footer">
          <button class="btn btn-primary" type="submit" name="savenotice" id="savenotice"  value="1"><?php echo $this->lang->line('submit_botton'); ?></button>
        </div>

             </div> </div><!-- /.box --></div>
        </div>
    </div><!-- /.row -->
    <!-- Main row -->
</section><!-- /.content -->

<!-- Modal approve -->
<script type="text/javascript">
function totalvalue()
{
pay_basic = $("#pay_basic").val();

pay_others = $("#pay_others").val();
 
 
 <?php if($dataval[0]['pay_cate_grp'] == 1){ ?>
  
 pay_grp = $("#pay_gradepay").val();
 <?php }else{ ?>
     var  pay_grp = 0
     <?php } ?>

<?php if($dataval[0]['pay_cate_madical'] == 1){ ?>
  
 pay_ma = $("#pay_madical").val();
 <?php }else{ ?>
     var  pay_ma = 0
     <?php } ?>


     <?php if($dataval[0]['pay_cate_sp'] == 1){ ?>
  
pay_sp = $("#pay_sp").val();
 <?php }else{ ?>
     var  pay_sp = 0
     <?php } ?>
      <?php if($dataval[0]['pay_cate_sa'] == 1){ ?>
  pay_sa = $("#pay_sa").val();
 <?php }else{ ?>
     var  pay_sa = 0
     <?php } ?>



        <?php if($dataval[0]['pay_cate_ca'] == 1){ ?>
  pay_ca = $("#pay_ca").val();
 <?php }else{ ?>
     var  pay_ca = 0
     <?php } ?>
          <?php if($dataval[0]['pay_cate_da'] == 1){ ?>
  pay_da = $("#pay_da").val();
 <?php }else{ ?>
     var  pay_da = 0
     <?php } ?>
     <?php if($dataval[0]['pay_cate_hra'] == 1){ ?>
  pay_hra = $("#pay_hra").val();
 <?php }else{ ?>
     var  pay_hra = 0
     <?php } ?>

 
 
    pay_special = $("#pay_special").val();

    pay_didi = $("#pay_total_cut").val();
  var result = parseInt(pay_basic) + parseInt(pay_grp) + 
   parseInt(pay_others) + parseInt(pay_sp)+ 
   parseInt(pay_ca) + parseInt(pay_ma) +  
   parseInt(pay_da) + parseInt(pay_sp)+ parseInt(pay_ma) + parseInt(pay_sa) + parseInt(pay_hra)  
  + parseInt(pay_special)   ;


total = parseInt(result) -  parseInt(pay_didi);
   $("#pay_total_sum").val(result);

    $("#pay_total").val(total);
}

</script>