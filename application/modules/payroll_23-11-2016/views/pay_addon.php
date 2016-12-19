<?php
foreach ($pay_regi as $key => $value) {
  # code...

  $cate_id = $value->emp_pay_cate_id;
}


 	if(count($pay_regi) != 0){
 	$i=0; 	
 		foreach ($pay_regi as $key => $pay) { 
		
			$i =$i+1;
 	if($dataval[0]['pay_cate_basic'] == 1){	?>
     <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("basic_pay");?></label> <span class="text-danger">*</span></label>
                  <input type="text" name="pay_basic" id="pay_basic" placeholder="<?php echo $this->lang->line('emp_unique_code'); ?>"  value="<?php echo $pay->pay_basic; ?>" class="form-control">
               
            </div>  

<?php }if($dataval[0]['pay_cate_grp'] == 1){	?>
             <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_gradepay");?></label> <span class="text-danger">*</span></label>
                  <input type="text" name="pay_gradepay" id="pay_gradepay" placeholder="<?php echo $this->lang->line('pay_gradepay'); ?>" value="<?php echo @$pay->pay_grp; ?>" class="form-control">
                <input type="hidden" name="pay_salary_cate_id" id="pay_salary_cate_id" placeholder="<?php echo $this->lang->line('pay_gradepay'); ?>" value="<?php echo $cate_id  ?>" class="form-control">
               
            </div>

<?php }if($dataval[0]['pay_cate_da'] == 1){	?>

         <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_da");?></label> <span class="text-danger">*</span></label>
               <input type="text" name="pay_da"  onfocus="showday()" id="pay_da" placeholder="<?php echo $this->lang->line('emp_unique_code'); ?>"  value="<?php echo $pay->pay_da; ?>" class="form-control">
               
            </div>
      <?php }if($dataval[0]['pay_cate_special'] == 1){	?>
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_special");?></label> <span class="text-danger">*</span></label>
              
               <input type="text" name="pay_special" id="pay_special" placeholder="<?php echo $this->lang->line('emp_unique_code'); ?>"  value="<?php echo $pay->pay_special; ?>" class="form-control">
            </div>
      <?php }if($dataval[0]['pay_cate_hra'] == 1){	?>
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_hra");?></label> <span class="text-danger">*</span></label>
      
                        <input type="text" name="pay_hra" id="pay_hra" placeholder="<?php echo $this->lang->line('emp_unique_code'); ?>"  value="<?php echo $pay->pay_hra;?>" class="form-control">
            </div>
      <?php }if($dataval[0]['pay_cate_sa'] == 1){	?>
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_sa");?></label> <span class="text-danger">*</span></label>
               
                <input type="text" name="pay_sa" id="pay_sa" placeholder="<?php echo $this->lang->line('pay_sa'); ?>"  value="<?php echo $pay->pay_sa;?>" class="form-control">
            </div>
             <?php }if($dataval[0]['pay_cate_madical'] == 1){	?> 
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_ma");?></label> <span class="text-danger">*</span></label>
               
                <input type="text" name="pay_madical" id="pay_madical" placeholder="<?php echo $this->lang->line('pay_ma'); ?>"  value="<?php echo $pay->pay_madical;?>" class="form-control">
            </div>
               <?php }if($dataval[0]['pay_cate_ca'] == 1){	?> 
				<div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_ca");?></label> <span class="text-danger">*</span></label>
               
                <input type="text" name="pay_ca" id="pay_ca" placeholder="<?php echo $this->lang->line("pay_ca");?>"  value="<?php echo $pay->pay_ca;?>" class="form-control">
            </div>
			   <?php }if($dataval[0]['pay_cate_sp'] == 1){	?> 
			<div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_sp");?></label> <span class="text-danger">*</span></label>
               
                <input type="text" name="pay_sp" id="pay_sp" placeholder="<?php echo $this->lang->line("pay_sp");?>"  value="<?php echo $pay->pay_sp;?>" class="form-control">
            </div>
			<?php } ?>
			<div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_others");?></label> <span class="text-danger">*</span></label>
               
                <input type="text" name="pay_others" id="pay_others" placeholder="<?php echo $this->lang->line("pay_others");?>"  value="<?php echo $pay->pay_others;?>" class="form-control">
            </div>
			
			<div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_sum");?></label> <span class="text-danger">*</span></label>
                <input type="text" name="pay_total_sum" id="pay_total_sum" placeholder="<?php echo $this->lang->line('pay_ma'); ?>"  value="<?php echo $pay->pay_total_sum;?>" class="form-control">
              
            </div>
           
    <?php }}else{

		if($dataval[0]['pay_cate_basic'] == 1){	?>
	<div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("basic_pay");?></label> <span class="text-danger">*</span></label>
                  <input type="text" name="pay_basic" id="pay_basic" placeholder="<?php echo $this->lang->line('basic_pay'); ?>"  value="0" class="form-control">
               
            </div><?php }if($dataval[0]['pay_cate_grp'] == 1){	?>
			
			 <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_gradepay");?></label> <span class="text-danger">*</span></label>
                  <input type="text" name="pay_gradepay" id="pay_gradepay" placeholder="<?php echo $this->lang->line('pay_gradepay'); ?>"  value="0" class="form-control">
                 <input type="hidden" name="pay_salary_cate_id" id="pay_salary_cate_id" value="<?php echo $emp_details[0]->emp_pay_cate_id;  ?>" class="form-control">
               
            </div>
   <?php }if($dataval[0]['pay_cate_special'] == 1){ ?>
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_special");?></label> <span class="text-danger">*</span></label>
              
               <input type="text" name="pay_special" id="pay_special" placeholder="<?php echo $this->lang->line('pay_special'); ?>"  value="0" class="form-control">
            </div>
            <?php }if($dataval[0]['pay_cate_da'] == 1){	?>
         <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_da");?></label> <span class="text-danger">*</span></label>


               <input type="text" name="pay_da" onfocus="showday()" id="pay_da" placeholder="<?php echo $this->lang->line('pay_da'); ?>"  value="0" class="form-control">
               
            </div>
   
      <?php } if($dataval[0]['pay_cate_hra'] == 1){	?>
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_hra");?></label> <span class="text-danger">*</span></label>
      
                        <input type="text" name="pay_hra" id="pay_hra" placeholder="<?php echo $this->lang->line('emp_unique_code'); ?>"  value="0" class="form-control">
            </div>
      <?php } if($dataval[0]['pay_cate_sa'] == 1){	?>
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_sa");?></label> <span class="text-danger">*</span></label>
               
                <input type="text" name="pay_sa" id="pay_sa" placeholder="<?php echo $this->lang->line('pay_sa'); ?>"  value="0" class="form-control">
            </div>
    <?php } if($dataval[0]['pay_cate_madical'] == 1){	?>

            <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_ma");?></label> <span class="text-danger">*</span></label>
               
                <input type="text" name="pay_madical" id="pay_madical" placeholder=""  value="0" class="form-control">
            </div> 

             <?php } if($dataval[0]['pay_cate_ca'] == 1){	?>
				<div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_ca");?></label> <span class="text-danger">*</span></label>
               
                <input type="text" name="pay_ca" id="pay_ca" placeholder="<?php echo $this->lang->line("pay_ca");?>"  value="0" class="form-control">
            </div>
			<?php } if($dataval[0]['pay_cate_sp'] == 1){	?>
				<div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_sp");?></label> <span class="text-danger">*</span></label>
               
                <input type="text" name="pay_sp" id="pay_sp" placeholder="<?php echo $this->lang->line("pay_sp");?>"  value="0" class="form-control">
            </div>
			<?php } ?>
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_others");?></label> <span class="text-danger">*</span></label>
               
                <input type="text" name="pay_others" id="pay_others" placeholder="<?php echo $this->lang->line("pay_others");?>"  value="0" class="form-control">
            </div><div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_sum");?></label> <span class="text-danger">*</span></label>
                <input type="text" name="pay_total_sum" onfocus="showtotal()" id="pay_total_sum" placeholder=""  value="" class="form-control">
              
            </div>
           
	<?php }?>
</from>

	<script type="text/javascript">
function showday()
{
 pay_basic = $("#pay_basic").val();
 pay_grp = $("#pay_gradepay").val();
<?php if($dataval[0]['pay_cate_grp'] == 1){ ?>
  
  var grp = pay_grp;
 <?php }else{ ?>
     var grp = 0;
  <?php } ?>

  var result = parseInt(pay_basic) + parseInt(grp);
  da = ((result )*119/100);

   $("#pay_da").val(da);
}
function showtotal()
{
  alert("sadsa");
 pay_basic = $("#pay_basic").val();
 pay_grp = $("#pay_gradepay").val();
pay_others = $("#pay_others").val();
 pay_sp = $("#pay_sp").val();
 pay_ca = $("#pay_ca").val();
 <?php if($dataval[0]['pay_cate_madical'] == 1){ ?>
  
 pay_ma = $("#pay_madical").val();
 <?php }else{ ?>
     var  pay_ma = 0
     <?php } ?>
 pay_da = $("#pay_da").val();
 pay_sa = $("#pay_sa").val();
  pay_hra = $("#pay_hra").val();
   console.log("Monika ");
alert(pay_ma);
  var result = parseInt(pay_basic) + parseInt(pay_grp) + 
   parseInt(pay_others) + parseInt(pay_sp)+ 
   parseInt(pay_ca) + parseInt(pay_ma) +  
   parseInt(pay_da) + parseInt(pay_sp)+ parseInt(pay_ma) + parseInt(pay_sa) + parseInt(pay_hra);
 
alert(result);
   $("#pay_total_sum").val(result);
}
</script>