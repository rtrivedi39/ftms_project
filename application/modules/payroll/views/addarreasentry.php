<style>

table, th, td {
    border: 1px solid #E2DFDF;
    /* padding: 6px 5px 7px 7px; */
}
table, th, td {
    border: 1px solid #E2DFDF;
    /* padding: 6px 5px 7px 7px; */
}</style>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo $title; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo $title; ?></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
        <!-- Your Page Content Here -->
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
               
                   <?php 
					if($this->uri->segment(4) == "lpc"){
						$bb = "lpc";
						
					}else{
						$bb = "";
					}
					?>
                    <div class="box-body ">
					   	  <form action="<?php echo base_url();?>payroll/pay_slary_register/<?php echo $bb ?>" method="post">

					<div class="col-lg-12 "> 
       <div class="box-header box-warning">
                      <h3> </h3>
                    </div>
					<div class="col-lg-12 ">	<?php 
					if($this->uri->segment(4) == "lpc"){?>
					
					     <div class="form-group col-xs-6">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('emp_pay_month'); ?><span class="text-danger">*</span></label>
               <?php $currentmonth = date('F'); ?>
                  <select name="pay_month" name="pay_month" required onchage="changemonth()" class="form-control">
                                <option value=""><?php echo $this->lang->line('emp_pay_month'); ?></option>
                                <?php for ($m=1; $m<=12; $m++) {
     $month = date('F', mktime(0,0,0,$m, 1, date('Y')));
     
     ?>
                                    <option value="<?php echo $month ?>" <?php echo  $currentmonth == $month  ? 'selected' : ''; ?> ><?php echo $month ?></option>
                                <?php } ?>
                            </select> 

                <?php echo form_error('category_title_hin');?>
              </div>
              
              
               <div class=" form-group col-xs-6">
              <label for="exampleInputEmail1"><?php echo $this->lang->line('emp_pay_year'); ?><span class="text-danger">*</span></label>
            
                <select name="pay_year"   class="form-control">
                                <option value=""><?php echo $this->lang->line('emp_pay_year'); ?></option>
                                <?php for ($y=2015; $y<=2018; $y++) {
   
     ?>
                                    <option value="<?php echo $y ?>" <?php echo  date("Y") == $y  ? 'selected' : ''; ?>  ><?php echo $y ?></option>
                                <?php } ?>
                            </select>   </div>
			<div class="form-group">
                <label for="exampleInputEmail1"><?php echo "वेतन एरियर्स  रिमार्क "; ?><span class="text-danger">*</span></label>
             
                 <textarea name="pay_remark" class="form-control" id="pay_remark" 
				 placeholder="वेतन एरियर्स  रिमार्क "></textarea>
			
              </div>
					
					<?php }else{?>
					
					            	  	 
       <div class="form-group">
                <label for="exampleInputEmail1"><?php echo "वेतन एरियर्स  नाम "; ?><span class="text-danger">*</span></label>
             
                 <input type="text"  name="arreasname" id="arreasname" placeholder="वेतन एरियर्स  नाम"  value="" class="form-control">
				  

                
              </div>       <div class="form-group">
                <label for="exampleInputEmail1"><?php echo "वेतन एरियर्स  रिमार्क "; ?><span class="text-danger">*</span></label>
             
                 <textarea name="pay_remark" class="form-control" id="pay_remark" 
				 placeholder="वेतन एरियर्स  रिमार्क "></textarea>
				  

                
              </div>
					
               <div class="col-xs-6" id="dis1" >
                                  <div class="form-group">
                <label for="exampleInputEmail1"><?php echo "वेतन महीने से " ?><span class="text-danger">*</span></label>
             <input type="text"  name="stardate" id="stardate"  placeholder="<?php echo "वेतन महीने से";  ?>"  value="" class="form-control date1">
                  
              </div>
                            </div>
                            <div id="dis2" >
                                <div class="col-xs-6">
                                       <div class="form-group">
                <label for="exampleInputEmail1"><?php echo "वेतन महीने तक "; ?><span class="text-danger">*</span></label>
              <input type="text"  name="enddate" id="enddate"  placeholder="<?php echo "वेतन महीने तक";  ?>"  value="" class="form-control date1">
              </div>
         
                    </div> </div>
					<?php } ?>
                  <div class="col-xs-6" id="dis1" >  <?php $currentmonth = date('F'); ?>
                                  <div class="form-group">
                <label for="exampleInputEmail1"><?php echo "वेतन  देने वाला माह  " ?><span class="text-danger">*</span></label>
              <select name="pay_month_given" onchage="monthorder()" id="pay_month_given" required class="form-control">
                                <option value=""><?php echo $this->lang->line('emp_pay_month'); ?></option>
                                <?php 
								
								for ($m=1; $m<=12; $m++) {
								$month = date('F', mktime(0,0,0,$m, 1, date('Y')));
     
     ?>
                                    <option value="<?php echo $m ?>" <?php echo  $currentmonth == $month  ? 'selected' : ''; ?> ><?php echo $month ?></option>
                                <?php } ?>
                            </select> 
                  
              </div>
                            </div>
                            <div id="dis2" >
                                <div class="col-xs-6">
                                       <div class="form-group">
                <label for="exampleInputEmail1"><?php echo "वेतन देने वाला वर्ष   "; ?><span class="text-danger">*</span></label>
             <select name="pay_year_given" id="pay_year_given" required class="form-control">
                                <option value=""><?php echo $this->lang->line('emp_pay_year'); ?></option>
                                <?php for ($y=2015; $y<=2018; $y++) {
   
     ?>
                                    <option value="<?php echo $y ?>" <?php echo  date("Y") == $y  ? 'selected' : ''; ?>  ><?php echo $y ?></option>
                                <?php } ?>
                            </select>  
              </div>
         
                    </div> </div>
             
					</div>
               	  	<div class="col-lg-6 "> 
					  <input type="hidden" name="pay_month_order" id="pay_month_order" value="<?php echo date("m");?>" class="form-control">
               	  		   <div class="box-header box-warning">
               	  		<h3>वेतन अभिलेख / वेतन वृद्धि</h3>
               	  	</div>
       


 
  
     <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("basic_pay");?></label> <span class="text-danger">*</span></label>
                  <input type="number" onfocus="totalvalue()" onblur="totalvalue()" name="pay_basic" id="pay_basic" placeholder="<?php echo $this->lang->line('basic_pay'); ?>"  value="0" class="form-control">
			
				  <input name="uid" id="uid" type="hidden" value="<?php echo $this->uri->segment(3);?>" />
           <input name="pay_salary_cate_id" id="pay_salary_cate_id" type="hidden" value="<?php echo $dataval[0]['pay_cate_id']?>" />
               
            </div>  
<?php 
	
	if($dataval[0]['pay_cate_grp'] == 1){?>

             <div class="form-group ">
                <label for="file_type"><?php echo $this->lang->line("pay_gradepay");?></label> <span class="text-danger">*</span></label>
                  <input type="number" onfocus="totalvalue()"  onblur="totalvalue()" name="pay_gradepay" id="pay_gradepay" placeholder="<?php echo $this->lang->line('pay_gradepay'); ?>" value="0" class="form-control">
              
            </div>

  <?php }else{?>
		           <input type="hidden" name="pay_gradepay" id="pay_gradepay" value="0">
    
		
		<?php } ?>
<?php if($dataval[0]['pay_cate_da'] == 1){?>
         <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_da");?></label> <span class="text-danger">*</span></label>
               <input name="pay_da" type="number"   class="form-control"  id="pay_da" onblur="totalvalue()" onfocus="totalvalue()" value="0" placeholder="<?php echo $this->lang->line('pay_da'); ?>">
               
            </div>
  <?php }else{?>
		           <input type="hidden" name="pay_da" id="pay_da" value="0">
    
		
		<?php } ?><?php if($dataval[0]['pay_cate_special'] == 1){?>
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_special");?></label> <span class="text-danger">*</span></label>
              
               <input type="number" onfocus="totalvalue()" onblur="totalvalue()" name="pay_special" id="pay_special" placeholder="<?php echo $this->lang->line('pay_special'); ?>"  value="0" class="form-control">
            </div>
  <?php }else{?>
		           <input type="hidden" name="pay_special" id="pay_special" value="0">
    
		
		<?php } ?><?php if($dataval[0]['pay_cate_hra'] == 1){?>
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_hra");?></label> <span class="text-danger">*</span></label>
      
                        <input type="text" onfocus="totalvalue()" onblur="totalvalue()" name="pay_hra" id="pay_hra" placeholder="<?php echo $this->lang->line('pay_hra'); ?>"  value="0" class="form-control">
            </div>
     <?php }else{?>
		           <input type="hidden" name="pay_hra" id="pay_hra" value="0">
    
		
		<?php } ?><?php if($dataval[0]['pay_cate_sa'] == 1){?>
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_sa");?></label> <span class="text-danger">*</span></label>
               
                <input type="number" onfocus="totalvalue()" onblur="totalvalue()" name="pay_sa" id="pay_sa" placeholder="<?php echo $this->lang->line('pay_sa'); ?>"  value="0" class="form-control">
            </div>
           <?php }else{?>
		           <input type="hidden" name="pay_sa" id="pay_sa" value="0">
    
		
		<?php } ?><?php if($dataval[0]['pay_cate_madical'] == 1){?>
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_ma");?></label> <span class="text-danger">*</span></label>
               
                <input type="number" onfocus="totalvalue()" onblur="totalvalue()" name="pay_madical" id="pay_madical" placeholder="<?php echo $this->lang->line('pay_ma'); ?>"  value="0" class="form-control">
            </div>
                    <?php }else{?>
		           <input type="hidden" name="pay_madical" id="pay_madical" value="0">
    
		
		<?php } ?><?php if($dataval[0]['pay_cate_ca'] == 1){?>
				<div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_ca");?></label> <span class="text-danger">*</span></label>
               
                <input type="number" name="pay_ca" id="pay_ca"  onfocus="totalvalue()" onblur="totalvalue()" placeholder="<?php echo $this->lang->line("pay_ca");?>"  value="0" class="form-control">
            </div>
	 
           <?php }else{?>
		                  <input type="hidden" name="pay_ca" onfocus="totalvalue()"  id="pay_ca" placeholder="<?php echo $this->lang->line('pay_other_adv'); ?>"  value="0" class="form-control">
    
		
		<?php } ?><?php if($dataval[0]['pay_cate_sp'] == 1){?>
			<div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_sp");?></label> <span class="text-danger">*</span></label>
               
                <input type="number"onfocus="totalvalue()" onblur="totalvalue()" name="pay_sp" id="pay_sp" placeholder="<?php echo $this->lang->line("pay_sp");?>"  value="0" class="form-control">
            </div>
    <?php }else{?>
		                  <input type="hidden" name="pay_sp" onfocus="totalvalue()" onblur="totalvalue()"  id="pay_sp" placeholder="<?php echo $this->lang->line('pay_other_adv'); ?>"  value="0" class="form-control">
    
		
		<?php } ?><?php if($dataval[0]['pay_cate_other_add'] == 1){?>
			<div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_others");?></label> <span class="text-danger">*</span></label>
               
                <input type="number" onfocus="totalvalue()" onblur="totalvalue()" name="pay_others" id="pay_others" placeholder="<?php echo $this->lang->line("pay_others");?>"  value="0" class="form-control">
            </div>
		      <?php }else{?>
		                  <input type="hidden" name="pay_others"onfocus="totalvalue()" onblur="totalvalue()" id="pay_others" placeholder="<?php echo $this->lang->line('pay_other_adv'); ?>"  value="0" class="form-control">
    
		
		<?php } ?>
			<div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_sum");?></label> <span class="text-danger">*</span></label>
			    <input type="number" onfocus="totalvalue()" onblur="totalvalue()" name="pay_total_sum" id="pay_total_sum" placeholder="<?php echo $this->lang->line('pay_sum'); ?>"  value="0" class="form-control" />
			</div>
        </div ><div class="col-lg-6 ">

        	   <div class="box-header box-warning">
               	  		<h3>वेतन कटौती राशि</h3>
               	  	</div>

    <?php if($dataval[0]['pay_cate_gpf'] == 1){?>
     <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_gpf");?></label> <span class="text-danger">*</span></label>
               
                <input type="number" onfocus="totalvalue()" onblur="totalvalue()" name="pay_gpf" id="pay_gpf" placeholder="<?php echo $this->lang->line('pay_gpf'); ?>"  value="0" class="form-control">
              
          </div>
           <?php }else{?>
		                  <input type="hidden" name="pay_gpf" onfocus="totalvalue()" onblur="totalvalue()" id="pay_gpf" placeholder=""  value="0" class="form-control">
    
		
		<?php } ?><?php if($dataval[0]['pay_cate_dpf'] == 1){?>
     <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_dpf");?></label> <span class="text-danger">*</span></label>
               
                <input type="number" name="pay_dpf" id="pay_dpf" onfocus="totalvalue()" onblur="totalvalue()"  placeholder="<?php echo $this->lang->line('pay_dpf'); ?>"  value="0" class="form-control">
              
          </div>
            
         <?php }else{?>
		                  <input type="hidden" name="pay_dpf" onfocus="totalvalue()" onblur="totalvalue()"  id="pay_dpf" placeholder=""  value="0" class="form-control">
    
		
		<?php } ?><?php if($dataval[0]['pay_cate_defined_contribution'] == 1){?>

         <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_define");?></label> <span class="text-danger">*</span></label>
               
                       <input type="number" name="pay_define" oonfocus="totalvalue()" onblur="totalvalue()"  id="pay_define" placeholder="<?php echo $this->lang->line('pay_define'); ?>"  value="0" class="form-control">
          </div>
       <?php }else{?>
		                  <input type="hidden" name="pay_define"  id="pay_define" placeholder=""  value="0" class="form-control">
    
		
		<?php } ?>
		

			
     <?php if($dataval[0]['pay_cate_gias'] == 1){?>
		
		<div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_gis");?></label> <span class="text-danger">*</span></label>
               
                 <input type="number" name="pay_gias" id="pay_gias" placeholder="<?php echo $this->lang->line('pay_gis'); ?>"  value="0" class="form-control">
            </div>
 <?php }else{?>
		                  <input type="hidden" name="pay_gias" onfocus="totalvalue()" onblur="totalvalue()" id="pay_gias" placeholder=""  value="0" class="form-control">
    
		
		<?php } ?> <?php if($dataval[0]['pay_cate_house_loan'] == 1){?>
		
       <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_house_rent");?></label> <span class="text-danger">*</span></label>
            
               <input type="number" name="pay_house_rent" id="pay_house_rent" placeholder="<?php echo $this->lang->line('pay_house_rent'); ?>"  value="0" class="form-control">
            </div>
	 <?php }else{?>
		                  <input type="hidden" name="pay_house_rent" onfocus="totalvalue()" onblur="totalvalue()"  id="pay_house_rent" placeholder=""  value="0" class="form-control">
    
		
		<?php } ?>    <?php if($dataval[0]['pay_cate_fuel_charge'] == 1){?>
                  <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_fule_charge");?></label> <span class="text-danger">*</span></label>
            
               <input type="number" name="pay_fule_charge" id="pay_fule_charge" placeholder="<?php echo $this->lang->line('pay_fule_charge'); ?>"  value="0" class="form-control">
            </div>
			<?php }else{?>
		                  <input type="hidden" name="pay_fule_charge" onfocus="totalvalue()" onblur="totalvalue()"  id="pay_fule_charge" placeholder=""  value="0" class="form-control">
    
		
		<?php } ?>
			
			   <?php if($dataval[0]['pay_cate_professional_tax'] == 1){?>
			<div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_professional_tax");?></label> <span class="text-danger">*</span></label>
          
               <input type="number" name="pay_professional_tax" onfocus="totalvalue()" onblur="totalvalue()" id="pay_professional_tax" placeholder="<?php echo $this->lang->line('pay_professional_tax'); ?>"  value="0" class="form-control">
            </div>
            
				<?php }else{?>
		                  <input type="hidden" name="pay_fuel_charge"  id="pay_fuel_charge" placeholder=""  value="0" class="form-control">
    
		
		<?php } ?>
		
			
		
     <?php if($dataval[0]['pay_cate_income_tax'] == 1){?>
    
            <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_income_tax");?></label> <span class="text-danger">*</span></label>
               
                  <input type="number" name="pay_income_tax" id="pay_income_tax" onfocus="totalvalue()" onblur="totalvalue()"  placeholder="<?php echo $this->lang->line('pay_income_tax'); ?>"  value="0" class="form-control">
            </div>
			    <?php }else{?>
		                  <input type="hidden" name="pay_income_tax" onfocus="totalvalue()" onblur="totalvalue()" id="pay_income_tax" placeholder="<?php echo $this->lang->line('pay_other_adv'); ?>"  value="0" class="form-control">
    
		
		<?php } ?><?php if($dataval[0]['pay_cate_other_adv'] == 1){?>
        
            <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_other_adv");?></label> <span class="text-danger">*</span></label>
               
                  <input type="number" name="pay_other_adv" onfocus="totalvalue()" onblur="totalvalue()"  id="pay_other_adv" placeholder="<?php echo $this->lang->line('pay_other_adv'); ?>"  value="0" class="form-control">
            </div>
        <?php }else{?>
		                  <input type="hidden" name="pay_other_adv"  id="pay_other_adv" placeholder=""  value="0" class="form-control">
    
		
		<?php } ?>
	            <div class="form-group">
	                <label for="file_type"><?php echo $this->lang->line("pay_total_cut");?></label> <span class="text-danger">*</span></label>
	               
	                  <input type="number" name="pay_total_cut" onfocus="totalvalue()" onblur="totalvalue()" id="pay_total_cut" placeholder=""  value="0" class="form-control">
	            </div>
        <div class="form-group ">
	                <label for="file_type">कुल </label> <span class="text-danger">*</span></label>
	               
	                  <input type="number" name="pay_total" onfocus="totalvalue()" onblur="totalvalue()" id="pay_total" placeholder=""  value="0" class="form-control">
          </div>
     </div>
		<div class="col-lg-12">

        	   <div class="box-header box-warning">
               	  		<h3>वेतन बिल  विवरण</h3>
               	  	</div>

<div class="col-lg-6 ">

<div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('computer_bill_number'); ?><span class="text-danger">*</span></label>
            	<input type="number"  name="computer_bill_number" id="computer_bill_number" value="" placeholder="<?php echo $this->lang->line('computer_bill_number'); ?>"  class="form-control">
				<?php echo form_error('computer_bill_number');?>
              	</div>
			 <div class="form-group">
                <label for="exampleInputEmail1"><?php echo "कंप्यूटर बिल तारीख"; ?><span class="text-danger">*</span></label>
            	<input type="text"  name="computer_bill_date" id="computer_bill_date"  placeholder="<?php echo "कंप्यूटर बिल तारीख";  ?>"  value="" class="form-control date1">
              <?php echo form_error('computer_bill_date');?>
              </div>
			  
  			<div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('office_bill_number'); ?><span class="text-danger">*</span></label>
                <input type="number"  name="office_bill_number" id="office_bill_number" placeholder="<?php echo $this->lang->line('office_bill_number'); ?>"  value="" class="form-control">
              	 <?php echo form_error('office_bill_number');?>
              </div>
  			 

</div>
<div class="col-lg-6 ">

 <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('vocher_bill_number'); ?></label>
            	<input type="number"  name="vocher_bill_number" id="vocher_bill_number"   value="" class="form-control">
              	 <?php echo form_error('vocher_bill_number');?>
              </div>

               <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('vocher_bill_date'); ?></label>
            	<input type="text"   name="vocher_bill_date" id="vocher_bill_date" placeholder="<?php echo $this->lang->line('vocher_bill_date'); ?>"  class="form-control date1">
              	 <?php echo form_error('vocher_bill_date');?>
              </div>


</div>

<div class="col-lg-6 ">

<div class="form-group">
                <label for="exampleInputEmail1"><?php echo "बिल की सकल  राशि"; ?></label>
            	<input type="number"  name="bill_grossamount" id="bill_grossamount" placeholder="<?php echo 'बिल की सकल  राशि'; ?>"  value="" class="form-control">
              	 <?php echo form_error('bill_grossamount');?>
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1"><?php  echo "बिल की शुद्ध  राशि"; ?></label>
            	<input type="text"   name="bill_netamount" id="bill_netamount"  placeholder="<?php echo 'बिल की शुद्ध  राशि'; ?>"  class="form-control ">
              	 <?php echo form_error('bill_netamount');?>
              </div>
          </div>


</div>
       </div>
       

		
 </div>        	  <div class="box-footer">
          <button class="btn btn-primary" type="submit" name="savenotice" id="savenotice"  value="1"><?php echo $this->lang->line('submit_botton'); ?></button>
        </div>

		</div>
              </div>
                    <!-- /.box-body -->

            </div><!-- /.box -->
        </div>
    </div><!-- /.row -->
    <!-- Main row -->
</section><!-- /.content -->

<script type="text/javascript">
function totalvalue()
{ 
  var result =0;var dd = 0;
  pay_basic = $("#pay_basic").val();
  pay_others = $("#pay_others").val();
  pay_grp = $("#pay_gradepay").val();
  da= $("#pay_da").val();
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
  pay_income_tax = $("#pay_income_tax").val();
	pay_cate_other_adv = $("#pay_other_adv").val();
	pay_professional_tax = $("#pay_professional_tax").val();
	pay_fule_charge = $("#pay_fule_charge").val();
	pay_house_rent = $("#pay_house_rent").val();
	pay_gias = $("#pay_gias").val();
 
  result = parseInt(pay_basic) + parseInt(pay_grp) + parseInt(pay_others) + parseInt(pay_sp)+ parseInt(pay_ca) + parseInt(pay_ma) +  
   parseInt(pay_da) +  parseInt(pay_sa) + parseInt(pay_hra)+ parseInt(pay_special);


	 dd = parseInt(pay_gpf) + parseInt(pay_dpf) + parseInt(pay_define)+ parseInt(pay_gias) + parseInt(pay_house_rent) + parseInt(pay_fule_charge)+ parseInt(pay_professional_tax) + parseInt(pay_income_tax) + parseInt(pay_cate_other_adv);

  var pay_didi = $("#pay_total_cut").val(dd);

 

  var total = parseInt(result) -  parseInt(dd); 

    console.log(total);
   $("#pay_total_sum").val(result);

    $("#pay_total").val(total);
}

$( "#pay_month_given" ).change(function() {
var dd = $("#pay_month_given").val();

	var gfgf =$("#pay_month_order").val(dd);
});
</script>