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
           <div class="container"><h2><?php echo "वेतन बिल नंबर "?></h2>
  
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
   <form action="<?php echo base_url(); ?>payroll/pay_bill" onsubmit="onsumitsalary()" id="emp" method="post"  >
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
         
                  <select required name="pay_type" id="pay_type" onchange="showemp()" class="form-control">
                                <option value=""><?php echo "बिल नंबर टाइप"; ?></option>
      
                                    <option value="0"   >वेतन</option>
                             <option value="1"  >एरीयर्स</option>

                            </select> 

                <?php echo form_error('category_title_hin');?>
              </div>
			  
			       <div class="form-group empcode" style="display:none">
                <label for="exampleInputEmail1">एरीयर्स नाम <span class="text-danger">*</span></label>
         
                  <select  name="emp_uinq" class="form-control">
                                <option value="">एरीयर्स नाम </option>
								 <option value="2">पदोन्नति  एरियर्स </option>
								   <option value="1"> डी. ए . एरियर्स </option>
                               <option value="3"> मानदेय</option>
                            
                            </select> 

                <?php echo form_error('category_title_hin');?>
              </div>
                         <div class="form-group emphead">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('pay_head'); ?><span class="text-danger">*</span></label>
               <?php $currentmonth = date('F'); ?>
                  <select  name="pay_head" id="pay_head" onchange="selectbuget()" class="form-control">
                                <option value=""><?php echo $this->lang->line('pay_head'); ?></option>
                                <?php foreach ($pay_cate as $key => $pcate) {                       ?>
                                    <option value="<?php echo $pcate->pay_cate_id ?>"  ><?php echo $pcate->pay_cate_name ?></option>
                                <?php } ?>
                            </select> 

                <?php echo form_error('category_title_hin');?>
              </div>


<div class="form-group emphead">
                <label for="exampleInputEmail1"><?php echo "वेतन बजट मद"; ?><span class="text-danger">*</span></label>
               <?php $currentmonth = date('F'); ?>
                <div  id="buget">  <select  name="pay_buget" class="form-control">
                                <option value=""><?php echo "वेतन बजट मद"; ?></option>
                                <?php foreach ($pay_cate as $key => $pcate) {                       ?>
                                    <option value="<?php echo $pcate->pay_cate_id ?>"  ><?php echo $pcate->pay_cate_budget_no ?></option>
                                <?php } ?>
                            </select> 
</div>
                <?php echo form_error('category_title_hin');?>
              </div>
                      <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('emp_pay_month'); ?><span class="text-danger">*</span></label>
               <?php $currentmonth = date('F'); ?>
                  <select name="pay_month" required  class="form-control">
                                <option value=""><?php echo $this->lang->line('emp_pay_month'); ?></option>
                                <?php for ($m=1; $m<=12; $m++) {
     $month = date('F', mktime(0,0,0,$m, 1, date('Y')));
     
     ?>
                                    <option value="<?php echo $month ?>" <?php echo  $currentmonth == $month  ? 'selected' : ''; ?> ><?php echo $month ?></option>
                                <?php } ?>
                            </select> 

                <?php echo form_error('category_title_hin');?>
              </div>
                      <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('emp_pay_year'); ?><span class="text-danger">*</span></label>
               <?php $currentmonth = date('F'); ?>
                  <select required name="pay_year" class="form-control">
                                <option value=""><?php echo $this->lang->line('emp_pay_year'); ?></option>
                                <?php for ($m=2016; $m >= 2014; $m--) {
   
     
     ?>
                                    <option value="<?php echo $m ?>"  ><?php echo $m ?></option>
                                <?php } ?>
                            </select> 

               
              </div>

     <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('computer_bill_number'); ?><span class="text-danger">*</span></label>
            
                   <input type="number" required name="computer_bill_number" id="computer_bill_number" placeholder="<?php echo $this->lang->line('computer_bill_number'); ?>"  value="" class="form-control">
              
              </div>
			     <div class="form-group">
                <label for="exampleInputEmail1"><?php echo "कंप्यूटर बिल तारीख"; ?><span class="text-danger">*</span></label>
            
                   <input type="text" required name="computer_bill_date" id="computer_bill_number" placeholder="<?php echo "कंप्यूटर बिल तारीख";  ?>"  value="" class="form-control date1">
              
              </div>
			  
  <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('office_bill_number'); ?><span class="text-danger">*</span></label>
            
                   <input type="number" required name="office_bill_number" id="office_bill_number" placeholder="<?php echo $this->lang->line('office_bill_number'); ?>"  value="" class="form-control">
              
              </div>
  <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('vocher_bill_number'); ?><span class="text-danger">*</span></label>
            
                   <input type="number"  name="vocher_bill_number" id="vocher_bill_number" placeholder="<?php echo $this->lang->line('vocher_bill_number'); ?>"  value="" class="form-control">
              
              </div>

               <div class="form-group">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('vocher_bill_date'); ?><span class="text-danger">*</span></label>
            
                   <input type="text"   name="vocher_bill_date" id="vocher_bill_date" placeholder="<?php echo $this->lang->line('vocher_bill_date'); ?>"  value=""  class="form-control date1">
              
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
	$tt = $("#pay_type").val(); alert($tt);
if($tt == 1){
$(".empcode").show();

}else{
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