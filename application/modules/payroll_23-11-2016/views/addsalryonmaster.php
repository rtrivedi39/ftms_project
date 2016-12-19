
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo "मास्टर मे वेतन जोड़े "; ?>
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
                    <h1 ><?php echo "   मास्टर मे वेतन जोड़े "   ?></h1>
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
               	  <form action="<?php echo base_url();?>payroll/edit_slary_master" method="post">

<div class="col-lg-12 "> 
       <div class="box-header box-warning">
                      <h3>अधिकारी / कर्मचारी  नाम</h3>
                    </div>
                      <div class="form-group">
                <label for="file_type"><?php echo "अधिकारी / कर्मचारी  नाम";?></label> <span class="text-danger">*</span></label>
                 
                 <select name="pay_emp_unique_id" id="pay_emp_unique_id" required  class="form-control">
                                <option value=""><?php echo "अधिकारी / कर्मचारी  नाम" ?></option>
                                <?php foreach ($emp as $key => $value) {
								
								 if( $value->designation_id != 38 ){
								 
                                if(notinsalary($value->emp_unique_id ) == 0){
                             $name=  $value->emp_unique_id."  [". get_employee_gender($value->emp_id).$value->emp_full_name_hi."]";
                           
     
     ?>
                                    <option value="<?php echo $value->emp_unique_id ?>" ><?php echo $name; ?></option>
                                <?php }  } }?>
                            </select> 

            </div>  
  <div class="form-group">
                <label for="file_type"><?php echo " वेतन हेड ";?></label> <span class="text-danger">*</span></label>
                 
                 <select name="cate_id" id="cate_id" required  onchange="showcurrentda()" class="form-control">
                                <option value=""><?php echo "वेतन हेड" ?></option>
                                <?php foreach ($pay_salary as $key => $value) {
                            
     
     ?>
                                    <option value="<?php echo $value->pay_cate_id ?>" ><?php echo $value->pay_cate_name; ?></option>
                                <?php } ?>
                            </select> 

            </div>  <div class="form-group">
                <label for="file_type"><?php echo "वेतन जोड़ना है इस माह के वेतन में अथवा नहीं ";?></label> <span class="text-danger">*</span></label>
                 
                 <select name="condi" id="" required  class="form-control">
                       
                                    <option value="0" > नहीं </option>
									<option value="1" > हाँ </option>
                         
                            </select> 

            </div>
			
</div>

               	  	<div class="col-lg-6 "> 
               	  		   <div class="box-header box-warning">
               	  		<h3>वेतन अभिलेख / वेतन वृद्धि</h3>
               	  	</div>
       


 
  
     <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("basic_pay");?></label> <span class="text-danger">*</span></label>
                  <input type="number" onfocus="totalvalue()" name="pay_basic" id="pay_basic" placeholder="<?php echo $this->lang->line('basic_pay'); ?>"  value="0" class="form-control">
				  
				  <input name="daperst" id="daperstas" type="hidden" value="0" />
               
            </div>  


             <div class="form-group ">
                <label for="file_type"><?php echo $this->lang->line("pay_gradepay");?></label> <span class="text-danger">*</span></label>
                  <input type="number" onfocus="totalvalue()" name="pay_gradepay" id="pay_gradepay" placeholder="<?php echo $this->lang->line('pay_gradepay'); ?>" value="0" class="form-control">
              
            </div>



         <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_da");?></label> <span class="text-danger">*</span></label>
               <input type="number" onfocus="totalvalue();showday();" name="pay_da"   id="pay_da" placeholder="<?php echo $this->lang->line('pay_da'); ?>"  value="0" class="form-control">
               
            </div>

      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_special");?></label> <span class="text-danger">*</span></label>
              
               <input type="number" onfocus="totalvalue()" name="pay_special" id="pay_special" placeholder="<?php echo $this->lang->line('pay_special'); ?>"  value="0" class="form-control">
            </div>
 
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_hra");?></label> <span class="text-danger">*</span></label>
      
                        <input type="text" onfocus="totalvalue()" name="pay_hra" id="pay_hra" placeholder="<?php echo $this->lang->line('pay_hra'); ?>"  value="0" class="form-control">
            </div>
  
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_sa");?></label> <span class="text-danger">*</span></label>
               
                <input type="number" onfocus="totalvalue()" name="pay_sa" id="pay_sa" placeholder="<?php echo $this->lang->line('pay_sa'); ?>"  value="0" class="form-control">
            </div>
     
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_ma");?></label> <span class="text-danger">*</span></label>
               
                <input type="number" onfocus="totalvalue()" name="pay_madical" id="pay_madical" placeholder="<?php echo $this->lang->line('pay_ma'); ?>"  value="0" class="form-control">
            </div>
            
				<div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_ca");?></label> <span class="text-danger">*</span></label>
               
                <input type="number" name="pay_ca" id="pay_ca" placeholder="<?php echo $this->lang->line("pay_ca");?>"  value="0" class="form-control">
            </div>
	 
			<div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_sp");?></label> <span class="text-danger">*</span></label>
               
                <input type="number" onfocus="totalvalue()" name="pay_sp" id="pay_sp" placeholder="<?php echo $this->lang->line("pay_sp");?>"  value="0" class="form-control">
            </div>

			<div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_others");?></label> <span class="text-danger">*</span></label>
               
                <input type="number" onfocus="totalvalue()" name="pay_others" id="pay_others" placeholder="<?php echo $this->lang->line("pay_others");?>"  value="0" class="form-control">
            </div>
			
			<div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_sum");?></label> <span class="text-danger">*</span></label>
                <input type="number" onfocus="totalvalue()" name="pay_total_sum" id="pay_total_sum" placeholder="<?php echo $this->lang->line('pay_sum'); ?>"  value="0" class="form-control">
              
            </div>
        </div ><div class="col-lg-6 ">

        	   <div class="box-header box-warning">
               	  		<h3>वेतन कटौती राशि</h3>
               	  	</div>

    
     <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_gpf");?></label> <span class="text-danger">*</span></label>
               
                <input type="number"  name="pay_gpf" id="pay_gpf" placeholder="<?php echo $this->lang->line('pay_gpf'); ?>"  value="0" class="form-control">
              
            </div>
       
     <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_dpf");?></label> <span class="text-danger">*</span></label>
               
                <input type="number" name="pay_dpf" id="pay_dpf" placeholder="<?php echo $this->lang->line('pay_dpf'); ?>"  value="0" class="form-control">
              
            </div>
            
     

         <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_define");?></label> <span class="text-danger">*</span></label>
               
                       <input type="number" name="pay_define" id="pay_define" placeholder="<?php echo $this->lang->line('pay_define'); ?>"  value="0" class="form-control">
            </div>
      
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_gis");?></label> <span class="text-danger">*</span></label>
               
                 <input type="number" name="pay_gias" id="pay_gias" placeholder="<?php echo $this->lang->line('pay_gis'); ?>"  value="0" class="form-control">
            </div>

       <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_house_rent");?></label> <span class="text-danger">*</span></label>
            
               <input type="number" name="pay_house_rent" id="pay_house_rent" placeholder="<?php echo $this->lang->line('pay_house_rent'); ?>"  value="0" class="form-control">
            </div>
	
                  <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_fule_charge");?></label> <span class="text-danger">*</span></label>
            
               <input type="number" name="pay_fuel_charge" id="pay_fuel_charge" placeholder="<?php echo $this->lang->line('pay_fule_charge'); ?>"  value="0" class="form-control">
            </div>
			
			
			  
			<div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_professional_tax");?></label> <span class="text-danger">*</span></label>
          
               <input type="number" name="pay_professional_tax" id="pay_professional_tax" placeholder="<?php echo $this->lang->line('pay_professional_tax'); ?>"  value="0" class="form-control">
            </div>
            
            <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_income_tax");?></label> <span class="text-danger">*</span></label>
               
                  <input type="number" name="pay_income_tax" id="pay_income_tax" placeholder="<?php echo $this->lang->line('pay_income_tax'); ?>"  value="0" class="form-control">
            </div>
        
            <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_other_adv");?></label> <span class="text-danger">*</span></label>
               
                  <input type="number" name="pay_other_adv" id="pay_other_adv" placeholder="<?php echo $this->lang->line('pay_other_adv'); ?>"  value="0" class="form-control">
            </div>
        
	            <div class="form-group">
	                <label for="file_type"><?php echo $this->lang->line("pay_total_cut");?></label> <span class="text-danger">*</span></label>
	               
	                  <input type="number" name="pay_total_cut" onfocus="showtotal_DIII()" id="pay_total_cut" placeholder=""  value="" class="form-control">
	            </div>
        <div class="form-group ">
	                <label for="file_type">कुल </label> <span class="text-danger">*</span></label>
	               
	                  <input type="number" name="pay_total" onfocus="0" id="pay_total" placeholder=""  value="" class="form-control">
	            </div>
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
<script type="text/javascript">
function totalvalue()
{
showcurrentda();
pay_basic = $("#pay_basic").val();

pay_others = $("#pay_others").val();
  daperst = $("#daperstas").val();
 pay_grp = $("#pay_gradepay").val();
da = Math.round(((parseInt(pay_basic) + parseInt(pay_grp)) * daperst)/100);
  da= $("#pay_da").val(da);
 pay_ma = $("#pay_madical").val();
pay_sp = $("#pay_sp").val();
pay_sa = $("#pay_sa").val();
  pay_ca = $("#pay_ca").val();
  pay_da = $("#pay_da").val();
  pay_hra = $("#pay_hra").val();
 pay_special = $("#pay_special").val();


  pay_gpf = $("#pay_gpf").val();
 pay_dpf = $("#pay_dpf").val();
  pay_define = $("#pay_define").val();
    pay_gis = $("#pay_gias").val();
     pay_house_rent = $("#pay_house_rent").val();
     pay_fule_charge = $("#pay_fuel_charge").val();
        pay_professional_tax = $("#pay_professional_tax").val();
           pay_income_tax = $("#pay_income_tax").val();
             pay_cate_other_adv = $("#pay_other_adv").val();

  var dd = parseInt(pay_gpf) + parseInt(pay_dpf) +    parseInt(pay_define) + parseInt(pay_gis)+    parseInt(pay_house_rent) + parseInt(pay_fule_charge) +  
   parseInt(pay_professional_tax) + parseInt(pay_cate_other_adv);

  pay_didi = $("#pay_total_cut").val(dd);
  pay_didi = $("#pay_total_cut").val();

  var result = parseInt(pay_basic) + parseInt(pay_grp) + 
   parseInt(pay_others) + parseInt(pay_sp)+ 
   parseInt(pay_ca) + parseInt(pay_ma) +  
   parseInt(pay_da) + parseInt(pay_sp)+ parseInt(pay_ma) + parseInt(pay_sa) + parseInt(pay_hra)+ parseInt(pay_special)   ;


total = parseInt(result) -  parseInt(pay_didi);
   $("#pay_total_sum").val(result);

    $("#pay_total").val(total);
}function showcurrentda()
{
	var cateid=$("#cate_id").val();

	$.get("<?php echo base_url();?>payroll/currentda/"+cateid,function(q){
		
		  daperst = $("#daperstas").val(q);
	});
	
}
function showtotal_DIII()
{

 pay_gpf = $("#pay_gpf").val();
 pay_dpf = $("#pay_dpf").val();
  pay_define = $("#pay_define").val();
    pay_gis = $("#pay_gias").val();
     pay_house_rent = $("#pay_house_rent").val();
     pay_fule_charge = $("#pay_fuel_charge").val();
        pay_professional_tax = $("#pay_professional_tax").val();
           pay_income_tax = $("#pay_income_tax").val();
             pay_cate_other_adv = $("#pay_other_adv").val();

  var dd = parseInt(pay_gpf) + parseInt(pay_dpf) +    parseInt(pay_define) + parseInt(pay_gis)+    parseInt(pay_house_rent) + parseInt(pay_fule_charge) +  
   parseInt(pay_professional_tax) + parseInt(pay_cate_other_adv);

  pay_didi = $("#pay_total_cut").val(dd);

  $tt=  $("#pay_total_sum").val();

    total = parseInt($tt) -  parseInt(dd);

    $("#pay_total").val(total);
}
</script>