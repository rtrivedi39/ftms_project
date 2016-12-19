<?php //print_r($pay_bills)?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
   <?php echo "वेतन बिल नंबर "?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo "वेतन बिल नंबर "?></li>
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
				<div class="container"> <?php if(empty($this->uri->segment(3))){?>
           <h2><?php echo "वेतन बिल नंबर "?></h2>
				<?php }else{ ?>
				<h2><?php echo $pay_bills->pbill_month.", ".$pay_bills->pbill_year." का  बिल  नंबर बदलाव करें |"; ?></h2>
				<?php } ?>
<div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">       
                <div class="box-header">
                    <h3 class="box-title"></h3>
                    <div class="box-tools pull-right">
           
            
                        <a href="javascript:history.go(-1)">
                            <button type="button" class="btn  btn-warning"><?php echo $this->lang->line('Back_button_label'); ?></button>
                        </a>
                    </div>
                </div><!-- /.box-header -->
			
   <form action="<?php echo base_url(); ?>payroll/pay_bill/<?php echo isset($edit_id)?$edit_id:'' ;?>" onsubmit="onsumitsalary()" id="emp" method="post"  >
        <div class="box-body">
     	<?php  if($this->session->flashdata('error')){?>
    	<div class="col-xs-6" style="    background-color: rgba(255, 24, 0, 0.44);
    width: 68%;
    padding: 0 5px;
    border: solid 1px red;"><?php // echo $this->session->flashdata('message');
                        echo $this->session->flashdata('error'); ?><div/>
                        <?php } ?>
            <div class="col-md-6">
			
                <div class="form-group">
                <label for="exampleInputEmail1"><?php echo "बिल नंबर टाइप"; ?><span class="text-danger">*</span></label>
           		<select  name="pay_type" id="pay_type" onchange="showemp()" class="form-control">
                    <option value=""><?php echo "बिल नंबर टाइप"; ?></option>
					<?php foreach(get_bill_num_array() as $key=>$bill_num_type ) { ?>
					
						<option value="<?php echo $key; ?>" <?php if( $this->input->post('pay_type') ==   $key ){ echo 'selected';  }else if(!empty($pay_bills->pbill_type) && ( $pay_bills->pbill_type == $key) ) {  echo 'selected'; }?>><?php echo $bill_num_type; ?></option>
					<?php } ?>
				</select> 
				<?php echo form_error('pay_type');?>
              </div>
				
			  <div class="form-group empcode" <?php if( ($this->input->post('pay_type') ==  1 )|| ( !empty($pay_bills->pbill_type ) &&  ( $pay_bills->pbill_type == 1 )) ){  echo 'style="display:block"'; }else{ echo 'style="display:none"'; } ?>>
                <label for="exampleInputEmail1">एरीयर्स नाम <span class="text-danger">*</span></label>
         		<select  name="emp_uinq" class="form-control">
							<option value="">एरीयर्स नाम </option>
							<option value="2"  <?php if( $this->input->post('emp_uinq') ==  2 ){ echo 'selected'; }else if(!empty( $pay_bills->pbill_emp_code) && ( $pay_bills->pbill_emp_code == 2 ) ) {  echo 'selected'; } ?>>पदोन्नति  एरियर्स </option>
							<option value="1" <?php if( $this->input->post('emp_uinq') ==  1 ){ echo 'selected';  }else if(!empty( $pay_bills->pbill_emp_code) && ( $pay_bills->pbill_emp_code == 1 ) ) {  echo 'selected'; } ?>> डी. ए . एरियर्स </option>
                             <option value="3" <?php if( $this->input->post('emp_uinq') ==  3 ){ echo 'selected'; }else if(!empty( $pay_bills->pbill_emp_code) && ( $pay_bills->pbill_emp_code == 3 ) ) {  echo 'selected'; } ?>> मानदेय</option>
				 </select> 
				 <?php echo form_error('emp_uinq');?>
              </div>
			
			  <div class="form-group empcode_cls"  <?php if(($this->input->post('pay_type')== 2 ) ||(!empty($pay_bills->pbill_type) && $pay_bills->pbill_type == 2 ) ){  echo 'style="display:block" '; }else if( $this->input->post('emp_uinq') !=  2 ||  $this->input->post('emp_uinq') !=  3  ){ echo 'style="display:none" '; }  ?> >
                 <label for="exampleInputEmail1"><?php echo $this->lang->line('pay_emp_unique_id'); ?><span class="text-danger">*</span></label>
				   <select class="form-control " name="emp_uinque_id_leave"><option value=""> चयन करें </option> 
					      <?php foreach ($leave_approve_emp as $key => $leave_emp) {                       ?>
                                    <option value="<?php echo $leave_emp->pay_emp_unique_id ?>" <?php if( $this->input->post('emp_uinque_id') ==  $leave_emp->pay_emp_unique_id ){ echo "selected"; } else if(!empty($pay_bills->pbill_emp_code) && ( $pay_bills->pbill_emp_code ==  $leave_emp->pay_emp_unique_id ) ){ echo "selected"; } ?> ><?php echo $leave_emp->pay_emp_unique_id ?></option> 
                                <?php } ?>
                   </select> 
                <?php echo form_error('emp_uinq');?>
              </div>
			  <div class="form-group empcode_transfer_cls"  <?php if(($this->input->post('pay_type')== 3) || (!empty($pay_bills->pbill_type ) && $pay_bills->pbill_type == 3 )  ) {  echo 'style="display:block" '; }else if( $this->input->post('emp_uinq') !=  2 ||  $this->input->post('emp_uinq') !=  3  ){ echo 'style="display:none" '; }  ?> >
                 <label for="exampleInputEmail1"><?php echo $this->lang->line('pay_emp_unique_id'); ?><span class="text-danger">*</span></label>
				   <select class="form-control " name="emp_uinque_id_transfer"><option value=""> चयन करें </option> 
					     <?php foreach ($transfer_emp as $key => $trans_emp) {                       ?>
                                    <option   <?php  if(!empty($pay_bills->pbill_emp_code) && ( $pay_bills->pbill_emp_code ==  $trans_emp->pay_emp_unique_id ) ){ echo 'selected';  } else if( $this->input->post('emp_uinque_id') ==  $trans_emp->pay_emp_unique_id  ){ echo 'selected';  }  ?>  value="<?php echo $trans_emp->pay_emp_unique_id ?>" ><?php echo $trans_emp->pay_emp_unique_id ?></option>
                         <?php } ?>
                   </select> 
                <?php echo form_error('emp_uinq');?>
              </div>
				
				
              <div class="form-group emphead pay_head_cls" <?php if( $this->input->post('pay_type') ==  2 || $this->input->post('pay_type') ==  3 || (!empty($pay_bills->pbill_type ) &&  ( $pay_bills->pbill_type == 2 ) )  || (!empty($pay_bills->pbill_type ) &&  ( $pay_bills->pbill_type == 3 )) ){ echo 'style="display:none" '; } ?>>
                <label for="exampleInputEmail1"><?php echo $this->lang->line('pay_head'); ?><span class="text-danger">*</span></label>
			    <?php $currentmonth = date('F'); ?>
				<select  name="pay_head" id="pay_head" onchange="selectbuget()" class="form-control">
                                <option value=""><?php echo $this->lang->line('pay_head'); ?></option>
                                <?php foreach ($pay_cate as $key => $pcate) {                       ?>
                                <option value="<?php echo $pcate->pay_cate_id ?>" <?php if( $this->input->post('pay_head') == $pcate->pay_cate_id ){ echo 'selected';  } else if(!empty( $pay_bills->pbill_cate_id) && ( $pay_bills->pbill_cate_id == $pcate->pay_cate_id ) ) {  echo 'selected'; } ?> ><?php echo $pcate->pay_cate_name ?></option>
                                <?php } ?>
                </select> 
				<?php echo form_error('pay_head');?>
              </div>
			  <div class="form-group emphead pay_buget_cls" <?php if( $this->input->post('pay_type') ==  2 || $this->input->post('pay_type') ==  3 ||  @$pay_bills->pbill_type == 2  || @$pay_bills->pbill_type == 3  ){ echo 'style="display:none" '; } ?> >
                <label for="exampleInputEmail1"><?php echo "वेतन बजट मद"; ?><span class="text-danger">*</span></label>
                <?php $currentmonth = date('F'); ?>
                <div  id="buget">
					<select  name="pay_buget" class="form-control">
                                <option value=""><?php echo "वेतन बजट मद"; ?></option>
                                <?php foreach ($pay_cate as $key => $pcate) {  
									
									?>
                                    <option  <?php if( $this->input->post('pay_buget') ==  $pcate->pay_cate_budget_no ){ echo 'selected';  }else if( !empty($pay_bills->pbill_bugetno) && $pay_bills->pbill_bugetno == $pcate->pay_cate_budget_no  ){ echo "selected"; }  ?>  ><?php echo $pcate->pay_cate_budget_no ?></option>
                                <?php } ?>
                    </select> 
				</div>
                <?php echo form_error('pay_buget');?>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('emp_pay_month'); ?><span class="text-danger">*</span></label>
                <?php $currentmonth = date('F'); ?>
                <select name="pay_month" class="form-control">
                                <option value=""><?php echo $this->lang->line('emp_pay_month'); ?></option>
                                <?php for ($m=1; $m<=12; $m++) {
     $month = date('F', mktime(0,0,0,$m, 1, date('Y')));
     
     ?>
                                    <option value="<?php echo $month ?>" <?php   if(!empty($pay_bills->pbill_month ) && ($pay_bills->pbill_month == $month )){ echo "selected"; }  elseif( $this->input->post('pay_month') == $month ) { echo 'selected'; } ?> ><?php echo $month ?></option>
                                <?php } ?>
                            </select> 

                <?php echo form_error('pay_month'); echo @$error_set; ?>
              </div>
              <div class="form-group">
                <label for="exampleInput_year"><?php echo $this->lang->line('emp_pay_year'); ?><span class="text-danger">*</span></label>
                <?php $currentmonth = date('F'); ?>
                <select  name="pay_year" class="form-control">
                      <option value=""><?php echo $this->lang->line('emp_pay_year'); ?></option>
                       <?php for ($m=2016; $m >= 2014; $m--) {     ?>
                                    <option value="<?php echo $m ?>"  <?php if($this->input->post('pay_year') == $m ){ echo "selected"; } else if(!empty($pay_bills->pbill_year) && ($pay_bills->pbill_year == $m)){ echo "selected"; } ?> ><?php echo $m ?></option>
                                <?php } ?>
                 </select> 
				<?php echo form_error('pay_year'); echo @$error_set; ?>
				  
               
              </div>

			<div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('computer_bill_number'); ?><span class="text-danger">*</span></label>
            	<input type="number"  name="computer_bill_number" id="computer_bill_number" value="<?php echo isset($pay_bills->pbill_computer_no) ? $pay_bills->pbill_computer_no : @$this->input->post('computer_bill_number'); ?>"  placeholder="<?php echo $this->lang->line('computer_bill_number'); ?>"  value="" class="form-control">
				<?php echo form_error('computer_bill_number');?>
              	</div>
			 <div class="form-group">
                <label for="exampleInputEmail1"><?php echo "कंप्यूटर बिल तारीख"; ?><span class="text-danger">*</span></label>
            	<input type="text"  name="computer_bill_date" id="computer_bill_date" value="<?php if((isset($pay_bills->pbill_computer_date)&& $pay_bills->pbill_computer_date !='0000-00-00') && $pay_bills->pbill_computer_date != '1970-01-01'){ echo  date('d-m-Y', strtotime($pay_bills->pbill_computer_date)) ; }else { echo $this->input->post('computer_bill_date'); } ?>"  placeholder="<?php echo "कंप्यूटर बिल तारीख";  ?>"  value="" class="form-control date1">
              <?php echo form_error('computer_bill_date');?>
              </div>
			  
  			<div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('office_bill_number'); ?><span class="text-danger">*</span></label>
                <input type="number"  name="office_bill_number" id="office_bill_number" value="<?php echo isset($pay_bills->pbill_office_no) ? $pay_bills->pbill_office_no : @$this->input->post('office_bill_number'); ?>"  placeholder="<?php echo $this->lang->line('office_bill_number'); ?>"  value="" class="form-control">
              	 <?php echo form_error('office_bill_number');?>
              </div>
  			  <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('vocher_bill_number'); ?></label>
            	<input type="number"  name="vocher_bill_number" id="vocher_bill_number" value="<?php echo isset($pay_bills->pbill_vocher_no) ? $pay_bills->pbill_vocher_no: @$this->input->post('vocher_bill_number'); ?>" placeholder="<?php echo $this->lang->line('vocher_bill_number'); ?>"  value="" class="form-control">
              	 <?php echo form_error('vocher_bill_number');?>
              </div>

               <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('vocher_bill_date'); ?></label>
            	<input type="text"   name="vocher_bill_date" id="vocher_bill_date" value="<?php if(isset($pay_bills->pbill_vocher_date)&& $pay_bills->pbill_computer_date!='0000-00-00' && $pay_bills->pbill_computer_date!='1970-01-01') { echo  date('d-m-Y',strtotime($pay_bills->pbill_vocher_date )) ; } else { echo $this->input->post('vocher_bill_date'); } ?>" placeholder="<?php echo $this->lang->line('vocher_bill_date'); ?>"  class="form-control date1">
              	 <?php echo form_error('vocher_bill_date');?>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1"><?php echo "बिल की सकल  राशि"; ?></label>
            	<input type="number"  name="bill_grossamount" id="bill_grossamount" value="<?php echo isset($pay_bills->pbill_gross_amount) ? $pay_bills->pbill_gross_amount: @$this->input->post('bill_grossamount'); ?>" placeholder="<?php echo 'बिल की सकल  राशि'; ?>"  value="" class="form-control">
              	 <?php echo form_error('bill_grossamount');?>
              </div>

               <div class="form-group">
                <label for="exampleInputEmail1"><?php  echo "बिल की शुद्ध  राशि"; ?></label>
            	<input type="text"   name="bill_netamount" id="bill_netamount" value="<?php echo isset($pay_bills->pbill_net_amont) ? $pay_bills->pbill_net_amont: @$this->input->post('bill_netamount'); ?>" placeholder="<?php echo 'बिल की शुद्ध  राशि'; ?>"  class="form-control ">
              	 <?php echo form_error('bill_netamount');?>
              </div>
          </div>
                 
        </div><!-- /.box-body -->
        <div class="box-footer">
          <button class="btn btn-primary" type="submit" name="savenotice" id="savenotice"  value="1"><?php echo $this->lang->line('submit_botton'); ?></button>
        </div>
        </form>
        
      </div><!-- /.box -->
    </div><!-- col 12-->
    </div><!-- /.row -->
 
    </div>
</section><!-- /.content -->
<script>
function validate(form) {

    // validation code here ...


    if(!valid) {
        alert('Please correct the errors in the form!');
        return false;
    }
    else {
        return false;
    }
}function showemp()
{
	var HTTP_PATH='<?php echo base_url(); ?>';
	var tt = $("#pay_type").val(); 
	
	if(tt == 1){
		$(".empcode_transfer_cls").hide();
		$(".pay_head_cls,.empcode").show();
		$(".empcode_cls").hide();
	}
	else if( tt == 2 ){
		$(".empcode").hide();
		$(".empcode_cls").show();
		$(".pay_head_cls").hide();
		$(".empcode_transfer_cls").show();
		$(".pay_buget_cls").hide();
		$(".empcode_transfer_cls").hide();
		
	}
	else if( tt == 3){
		$(".empcode").hide();
		$(".empcode_cls").hide();
		$(".empcode_transfer_cls").hide();
		$(".empcode_transfer_cls").show();
		$(".pay_head_cls").hide();
		$(".pay_buget_cls").hide();
	}
	else{
		$(".empcode").hide();
	}

}
function selectbuget()
{
	
$val =$("#pay_head").val();

$.get("<?php echo base_url();?>payroll/showbuget/"+$val,function(a){

$("#buget").html(a);
})
}function onsumitsalary(id)
{
   var r = confirm("कृपया सुनिश्चित करें कि डेटा सही है अथवा नहीं");
    if (r == true) {
        document.getElementById("emp").submit();


    } else {
        txt = "You pressed Cancel!";
    }
  

}

</script>