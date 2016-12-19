<?php if(count($pay_regi) != 0){ foreach ($pay_regi as $key => $pay) {
  if($dataval[0]['pay_cate_gpf'] == 1){ ?>
     <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_gpf");?></label> <span class="text-danger">*</span></label>
               
                <input type="text" name="pay_gpf" id="pay_gpf" placeholder="<?php echo $this->lang->line('pay_ma'); ?>"  value="<?php echo $pay->pay_gpf;?>" class="form-control">
              
            </div>
          <?php }  if($dataval[0]['pay_cate_dpf'] == 1){ ?>
     <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_dpf");?></label> <span class="text-danger">*</span></label>
               
                <input type="text" name="pay_dpf" id="pay_dpf" placeholder="<?php echo $this->lang->line('pay_cate_dpf'); ?>"  value="<?php echo $pay->pay_gpf;?>" class="form-control">
              
            </div>
            
            <?php }if($dataval[0]['pay_cate_defined_contribution'] == 1){  ?>

         <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_define");?></label> <span class="text-danger">*</span></label>
               
                       <input type="text" name="pay_define" id="pay_define" placeholder="<?php echo $this->lang->line('pay_ma'); ?>"  value="<?php echo $pay->pay_defined_contribution;?>" class="form-control">
            </div>
        <?php }if($dataval[0]['pay_cate_gias'] == 1){  ?>
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_gis");?></label> <span class="text-danger">*</span></label>
               
                 <input type="text" name="pay_gias" id="pay_gias" placeholder="<?php echo $this->lang->line('pay_gis'); ?>"  value="<?php echo $pay->pay_gias;?>" class="form-control">
            </div>
        <?php }if($dataval[0]['pay_cate_house_rent'] == 1){  ?>
       <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_house_rent");?></label> <span class="text-danger">*</span></label>
            
               <input type="text" name="pay_house_rent" id="pay_house_rent" placeholder="<?php echo $this->lang->line('pay_house_rent'); ?>"  value="<?php echo $pay->pay_house_rent;?>" class="form-control">
            </div>
<?php }if($dataval[0]['pay_cate_fuel_charge'] == 1){  ?>
                  <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_fule_charge");?></label> <span class="text-danger">*</span></label>
            
               <input type="text" name="pay_fuel_charge" id="pay_fuel_charge" placeholder="<?php echo $this->lang->line('pay_gis'); ?>"  value="<?php echo $pay->pay_fuel_charge;?>" class="form-control">
            </div>
			<?php }if($dataval[0]['pay_cate_professional_tax'] == 1){  ?>
			
			  
			<div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_professional_tax");?></label> <span class="text-danger">*</span></label>
          
               <input type="text" name="pay_professional_tax" id="pay_professional_tax" placeholder="<?php echo $this->lang->line('pay_gis'); ?>"  value="<?php echo $pay->pay_professional_tax;?>" class="form-control">
            </div> <?php }if($dataval[0]['pay_cate_income_tax'] == 1){  ?>
            <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_income_tax");?></label> <span class="text-danger">*</span></label>
               
                  <input type="text" name="pay_income_tax" id="pay_income_tax" placeholder="<?php echo $this->lang->line('pay_gis'); ?>"  value="<?php echo $pay->pay_income_tax;?>" class="form-control">
            </div>
           <?php }if($dataval[0]['pay_cate_other_adv'] == 1){  ?>
            <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_other_adv");?></label> <span class="text-danger">*</span></label>
               
                  <input type="text" name="pay_cate_other_adv" id="pay_cate_other_adv" placeholder="<?php echo $this->lang->line('pay_other_adv'); ?>"  value="<?php echo $pay->pay_other_adv;?>" class="form-control">
            </div>
<?php } ?>
            <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_total_cut");?></label> <span class="text-danger">*</span></label>
               
                  <input type="text" name="pay_total_cut" onfocus="showtotal_DIII()" id="pay_total_cut" placeholder="<?php echo $this->lang->line('pay_total_cut'); ?>"  value="<?php echo $pay->pay_total_cut;?>" class="form-control">
            </div>
      
    <?php } }else{?>
	<?php if($dataval[0]['pay_cate_gpf'] == 1){  ?>
	     <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_gpf");?></label> <span class="text-danger">*</span></label>
               
                <input type="text" name="pay_gpf" id="pay_gpf" placeholder="<?php echo $this->lang->line('pay_gpf'); ?>"  value="0" class="form-control">
              
            </div>
 <?php }if($dataval[0]['pay_cate_dpf'] == 1){  ?>
       <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_dpf");?></label> <span class="text-danger">*</span></label>
               
                <input type="text" name="pay_dpf" id="pay_dpf" placeholder="<?php echo $this->lang->line('pay_dpf'); ?>"  value="0" class="form-control">
              
            </div>


 <?php }if($dataval[0]['pay_cate_gias'] == 1){  ?>
        
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_gis");?></label> <span class="text-danger">*</span></label>
               
                 <input type="text" name="pay_gias" id="pay_gias" placeholder="<?php echo $this->lang->line('pay_gis'); ?>"  value="0" class="form-control">
            </div>
             <?php }if($dataval[0]['pay_cate_defined_contribution'] == 1){  ?>
             <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_define");?></label> <span class="text-danger">*</span></label>
               
                       <input type="text" name="pay_define" id="pay_define" placeholder="<?php echo $this->lang->line('pay_ma'); ?>"  value="0" class="form-control">
            </div>
       <?php }if($dataval[0]['pay_cate_fuel_charge'] == 1){  ?>
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_fule_charge");?></label> <span class="text-danger">*</span></label>
            
               <input type="text" name="pay_fuel_charge" id="pay_fuel_charge" placeholder="<?php echo $this->lang->line('pay_fule_charge'); ?>"  value="0" class="form-control">
            </div>
			
			       <?php }if($dataval[0]['pay_cate_house_rent'] == 1){  ?>
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_house_rent");?></label> <span class="text-danger">*</span></label>
            
               <input type="text" name="pay_house_rent" id="pay_house_rent" placeholder="<?php echo $this->lang->line('pay_house_rent'); ?>"  value="0" class="form-control">
            </div>
			
             <?php }if($dataval[0]['pay_cate_professional_tax'] == 1){  ?>
			<div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_professional_tax");?></label> <span class="text-danger">*</span></label>
          
               <input type="text" name="pay_professional_tax" id="pay_professional_tax" placeholder="<?php echo $this->lang->line('pay_professional_tax'); ?>"  value="0" class="form-control">
            </div>

<?php }if($dataval[0]['pay_cate_income_tax'] == 1){  ?>
            <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_income_tax");?></label> <span class="text-danger">*</span></label>
               
                  <input type="text" name="pay_income_tax" id="pay_income_tax" placeholder="<?php echo $this->lang->line('pay_income_tax'); ?>"  value="0" class="form-control">
            </div>
<?php }if($dataval[0]['pay_cate_other_adv'] == 1){  ?>
            <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_other_adv");?></label> <span class="text-danger">*</span></label>
               
                  <input type="text" name="pay_cate_other_adv" id="pay_cate_other_adv" placeholder="<?php echo $this->lang->line('pay_other_adv'); ?>"  value="0" class="form-control">
            </div>
<?php } ?>
            <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_total_cut");?></label> <span class="text-danger">*</span></label>
               
                  <input type="text" name="pay_total_cut" onfocus="showtotal_DIII()" id="pay_total_cut" placeholder="<?php echo $this->lang->line('pay_total_cut'); ?>"  value="0" class="form-control">
            </div>
	
	<?php }?>

  <script type="text/javascript">

  $("#pay_day").change(function(){
    
    var leaveday = $("#pay_day").val();

  <?php if($dataval[0]['pay_cate_ca'] == 1){  ?>


 pay_ca = $("#pay_ca").val();
 <?php }else{ ?>
   pay_ca = 0;
  <?php } ?>
  day = 30 ; 
  pay_ca1 = parseInt(pay_ca) / parseInt(day);
pay_ca2 = parseInt(pay_ca) - parseInt(pay_ca1) *  leaveday 
    alert(pay_ca2);
    $("#pay_ca").val(pay_ca2);
});

function showtotal_DIII()
{
   
    <?php if($dataval[0]['pay_cate_gpf'] == 1){  ?>
 pay_gpf = $("#pay_gpf").val();
  <?php }if($dataval[0]['pay_cate_dpf'] == 1){  ?>

     pay_dpf = $("#pay_dpf").val();
    <?php }?>

     <?php if($dataval[0]['pay_cate_fuel_charge'] == 1){  ?>
      pay_others = $("#pay_fuel_charge").val();
      <?php }else{ ?>pay_others = 0;
      <?php } ?>

   <?php if($dataval[0]['pay_cate_defined_contribution'] == 1){  ?>
 pay_define = $("#pay_define").val();
 <?php }else{ ?>
   pay_define = 0;
  <?php } ?>


 pay_basic = $("#pay_income_tax").val();
 pay_grp = $("#pay_professional_tax").val();
   
 pay_sp = $("#pay_house_rent").val();
pay_gis= $("#pay_gias").val();
 pay_sa = $("#pay_income_tax").val();
  
  pay_adv_other = $("#pay_cate_other_adv").val();

  var result = parseInt(pay_basic) + parseInt(pay_grp) + parseInt(pay_sp) +
   parseInt(pay_others) +  parseInt(pay_gpf) +  parseInt(pay_sa) +
   parseInt(pay_define) + parseInt(pay_adv_other) + parseInt(pay_gis) ;
  console.log( pay_basic + '-'+pay_grp + '-'+ pay_sp+ '-'+pay_others + '-'+pay_gpf + '-'+  pay_sa + '-'+ pay_define + '-'+ pay_adv_other + '-'+ pay_gis);
  
 
   $("#pay_total_cut").val(result);
}
  </script>