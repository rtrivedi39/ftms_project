<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
   <?php echo " वेतन एरियर्स"; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo " वेतन एरियर्स" ?></li>
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
           <div class="container"><h2><?php echo "वेतन एरियर्स  ";?></h2>

            <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">       
                <div class="box-header">
                    <h3 class="box-title">वेतन एरियर्स बिल </h3> <div class="box-tools pull-right">
           
                        <a href="javascript:history.go(-1)">
                            <button type="button" class="btn  btn-warning"><?php echo $this->lang->line('Back_button_label'); ?></button>
                        </a>
				     </div>
  <ul class="nav nav-tabs">
    
  <li><a data-toggle="tab" href="#Addions" style="background-color: #f39c12;
    color: #fff;"> वेतन एरियर्स बिल </a></li>  
  <li><a data-toggle="tab" href="#diduction" style="background-color: #d81b60;
    color: #fff;"> वेतन एरियर्स पत्रक</a></li>  
  </ul>
<div class="col-xs-12">   
              
                <div class="tab-content">
    <div id="Addions" class="tab-pane fade in active "><h3> वेतन एरियर्स बिल </h3>
	                   
                 
              <div class="box-header with-border">
                        <h3 class="box-title">कृपया सूची मे से उस माह का चयन करें जिसमे आपने एरियर्स बिल दिया है |  </h3>                 
                    </div>
          
                           <div class="form-group col-xs-2">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('emp_pay_month'); ?><span class="text-danger">*</span></label>
               <?php $currentmonth = date('F'); ?>
                  <select name="pay_month" id="pay_month" onchage="changemonth()" class="form-control select">
                                <option value=""><?php echo $this->lang->line('emp_pay_month'); ?></option>
                                <?php for ($m=1; $m<=12; $m++) {
     $month = date('F', mktime(0,0,0,$m, 1, date('Y')));
     
     ?>
                                    <option value="<?php echo $month ?>" <?php echo  $currentmonth == $month  ? 'selected' : ''; ?> ><?php echo $month ?></option>
                                <?php } ?>
                            </select> 
							<select name="pay_year" name="pay_year" class="form-control">
                                <option value=""><?php echo " एरीयस साल "; ?></option>
                                <?php for ($my=2015; $my<=date("Y"); $my++) {
   
     ?>
                                    <option value="<?php echo $my ?>"  ><?php echo $my ?></option>
                                <?php } ?>
                            </select> 

                <?php echo form_error('category_title_hin');?>
              </div> 
			  
			               <div class="form-group col-xs-2">
                <label for="exampleInputEmail1"><?php echo "एरियर्स" ?><span class="text-danger">*</span></label>
               
                  <select id="pay_month1"  onchage="changemonth()" class="form-control select">
				      <option value="">  एरियर्स </option>
                                <option value="1"> डी. ए . एरियर्स </option>
                                  <option value="2">पदोन्नति  एरियर्स </option>
                 
                            </select> 

              </div> 

<div class="col-xs-12">  
               <?php foreach($pay_cate  as $sal_Cate){?>
               <div class="col-xs-2">
    <a target="" id="<?php echo $sal_Cate->pay_cate_id; ?>" href="<?php echo base_url(); ?>payroll/getarrias/<?php echo $sal_Cate->pay_cate_id; ?>/<?php  echo  $currentmonth ?>"  <?php if($sal_Cate->pay_parent_id == 0){?>class="btn  bg-yellow btn-flat margin "<?php }else{ ?> class="btn bg-maroon btn-flat margin "<?php } ?> ><?php echo $sal_Cate->pay_cate_name; ?></a><br/>
    </div>
    <?php }?>
            </div>
 </div>
 
 
 <div id="diduction" class="tab-pane fade in "><h3>वेतन एरियर्स  डी. ए . पत्रक </h3>
   <div class="col-xs-12">
                
              <div class="box-header with-border">
                        <h3 class="box-title">कृपया सूची मे से उस माह का चयन करें जिसमे आपने एरियर्स बिल दिया है |  </h3>                 
                    </div>
          
                           <div class="form-group col-xs-2">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('emp_pay_month'); ?><span class="text-danger">*</span></label>
               <?php $currentmonth = date('F'); ?>
                  <select name="pay_month1" id="pay_month12" onchage="changemonth1()" class="form-control select1">
                                <option value=""><?php echo $this->lang->line('emp_pay_month'); ?></option>
                                <?php for ($m=1; $m<=12; $m++) {
     $month = date('F', mktime(0,0,0,$m, 1, date('Y')));
     
     ?>
                                    <option value="<?php echo $month ?>" <?php echo  $currentmonth == $month  ? 'selected' : ''; ?> ><?php echo $month ?></option>
                                <?php } ?>
                            </select> 
<select name="pay_year" name="pay_year" class="form-control">
                                <option value=""><?php echo " एरीयस साल "; ?></option>
                                <?php for ($my=2015; $my<=date("Y"); $my++) {
   
     ?>
                                    <option value="<?php echo $my ?>"  ><?php echo $my ?></option>
                                <?php } ?>
                            </select> 
                <?php echo form_error('category_title_hin');?>
              </div> 
			                 <div class="form-group col-xs-2">
                <label for="exampleInputEmail1"><?php echo "एरियर्स" ?><span class="text-danger">*</span></label>
               
                  <select id="pay_month11"  onchage="changemonth1()" class="form-control select1">
				      <option value="0">  एरियर्स </option>
                                <option value="1"> डी. ए . एरियर्स </option>
                                  <option value="2">पदोन्नति  एरियर्स </option>
                 
                            </select> 

              </div> 

<div class="col-xs-12">  
               <?php foreach($pay_cate  as $sal_Cate){?>
               <div class="col-xs-2">
    <a target="" id="_<?php echo $sal_Cate->pay_cate_id; ?>" href="<?php echo base_url(); ?>payroll/getarrias_pp/<?php echo $sal_Cate->pay_cate_id; ?>/<?php  echo  $currentmonth ?>"  <?php if($sal_Cate->pay_parent_id == 0){?>class="btn  bg-maroon btn-flat margin"<?php }else{ ?> class="btn bg-maroon btn-flat margin "<?php } ?> ><?php echo $sal_Cate->pay_cate_name; ?></a><br/>
    </div>
    <?php }?>
            </div>
  </div> 
     </div>
                 
                  </div>
                  </div>
                  </div>
  </div><div class="row">
  
 
  </div>
<div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">       
                <div class="box-header">
                    <h3 class="box-title">वेतन एरियर्स बिल जोड़े </h3>
             
                </div><!-- /.box-header -->
				    <ul class="nav nav-tabs">
    
  <li><a data-toggle="tab" href="#Addions1" style="background-color: #f39c12;
    color: #fff;"> सभी वेतन हेड  डी ए एरियर्स   </a></li>  
  <li><a data-toggle="tab" href="#diduction1" style="background-color: #d81b60;
    color: #fff;"> कर्मचारी  पदोन्नति  एरियर्स </a></li>  
  </ul>
  <div class="tab-content">
    <div id="Addions1" class="tab-pane fade in active "><h3> सभी वेतन हेड (All Salary Heads For DA )</h3>
	
	<div class="box-body">

          
        <form action="<?php echo base_url(); ?>payroll/add_arriyas" method="get" >
                    <div class="col-md-12">
                        <!-- general form elements -->

                         <div class="form-group">
                <label for="file_type"><?php echo " आदेश नंबर ";?></label> <span class="text-danger">*</span></label>
                 
           <input type="text" value="" name="orderno" required class="form-control">

            </div>  

       
   <div class="form-group">
                <label for="file_type"><?php echo " वेतन हेड ";?></label> <span class="text-danger">*</span></label>
                 
                 <select name="cate_id" name="cate_id" required  class="form-control">
                                <option value=""><?php echo "वेतन हेड" ?></option>
                                <?php foreach ($pay_cate as $key => $value) {
                            
     
     ?>
                                    <option value="<?php echo $value->pay_cate_id ?>" ><?php echo $value->pay_cate_name; ?></option>
                                <?php } ?>
                            </select> 

            </div>  



               <div class="col-xs-6" id="dis1" >
                                  <div class="form-group">
                <label for="exampleInputEmail1"><?php echo "वेतन महीने से " ?><span class="text-danger">*</span></label>
               <?php $currentmonth = date('F'); ?>
                  <select name="pay_month" name="pay_month" class="form-control">
                                <option value=""><?php echo "वेतन महीने से " ?></option>
                                <?php for ($m=1; $m<=12; $m++) {
     $month = date('F', mktime(0,0,0,$m, 1, date('Y')));
     
     ?>
                                    <option value="<?php echo $month ?>" <?php echo  $currentmonth == $month  ? 'selected' : ''; ?> ><?php echo $month ?></option>
                                <?php } ?>
                            </select> 
 <select name="pay_year" name="pay_year" class="form-control">
                                <option value=""><?php echo " एरीयस साल से"; ?></option>
                                <?php for ($my=2011; $my<=date("Y"); $my++) {
   
     ?>
                                    <option value="<?php echo $my ?>"  ><?php echo $my ?></option>
                                <?php } ?>
                            </select> 

                <?php echo form_error('category_title_hin');?>
              </div>
                            </div>
                            <div id="dis2" >
                                <div class="col-xs-6">
                                       <div class="form-group">
                <label for="exampleInputEmail1"><?php echo "वेतन महीने तक "; ?><span class="text-danger">*</span></label>
               <?php $currentmonth = date('F'); ?>
                  <select name="pay_month_end" name="pay_month" class="form-control">
                                <option value=""><?php echo "वेतन महीने तक " ?></option>
                                <?php for ($m=1; $m<=12; $m++) {
     $month = date('F', mktime(0,0,0,$m, 1, date('Y')));
     
     ?>
                                    <option value="<?php echo $month ?>" <?php echo  $currentmonth == $month  ? 'selected' : ''; ?> ><?php echo $month ?></option>
                                <?php } ?>
                            </select> 
							 <select name="pay_year_end" name="pay_year_end" class="form-control">
                                <option value=""><?php echo " एरीयस साल  तक "; ?></option>
                                <?php for ($my=2011; $my<=date("Y"); $my++) {
   
     ?>
                                    <option value="<?php echo $my ?>"  ><?php echo $my ?></option>
                                <?php } ?>
                            </select> 

                <?php echo form_error('category_title_hin');?>
              </div>
         
                    </div><!-- col 6 -->
        </div><!-- /.box-body -->
        <div class="box-footer">
          <button class="btn btn-primary" type="submit" name="savenotice" id="savenotice" onclick="showdetails()" value="1"><?php echo $this->lang->line('submit_botton'); ?></button>
        </div>
        </form>
        

         <div class="col-md-12">

         </div>
      </div><!-- /.box -->
    </div>
</div> 
 <div id="diduction1" class="tab-pane fade in "><h3> कर्मचारी  पदोन्नति एरियर्स </h3>
   <div class="col-xs-6">
 <form action="<?php echo base_url();?>payroll/allarreays" method="get">
 
               <div class="col-xs-6" id="dis1" >
			   
			               <div class="col-md-12">
                        <!-- general form elements -->

                         <div class="form-group">
                <label for="file_type"><?php echo " आदेश नंबर ";?></label> <span class="text-danger">*</span></label>
                 
           <input type="text" value="" name="orderno" required class="form-control">

            </div>  
			            <div class="form-group">
                <label for="file_type"> आदेश विषय</label> <span class="text-danger">*</span></label>
                 
                <textarea name="ordersub" class="form-control" required="required"></textarea>

            </div>    <!-- <div id="dis2" >
                                <div class="col-xs-6">

                                  <div class="form-group">
                <label for="exampleInputEmail1"><?php echo "वेतन महीने से " ?><span class="text-danger">*</span></label>
               <?php $currentmonth = date('F'); ?>
                  <select name="pay_month" name="pay_month" class="form-control">
                                <option value=""><?php echo "वेतन महीने से " ?></option>
                                <?php for ($m=1; $m<=12; $m++) {
     $month = date('F', mktime(0,0,0,$m, 1, date('Y')));
     
     ?>
                                    <option value="<?php echo $month ?>" <?php echo  $currentmonth == $month  ? 'selected' : ''; ?> ><?php echo $month ?></option>
                                <?php } ?>
                            </select> 
 <select name="pay_year" name="pay_year" class="form-control">
                                <option value=""><?php echo " एरीयस साल से"; ?></option>
                                <?php for ($my=2001; $my<=date("Y"); $my++) {
   
     ?>
                                    <option value="<?php echo $my ?>"  ><?php echo $my ?></option>
                                <?php } ?>
                            </select> 

                <?php echo form_error('category_title_hin');?>
              </div>
                            </div>
                           
                                <div class="col-xs-6">
                                       <div class="form-group">
                <label for="exampleInputEmail1"><?php echo "वेतन महीने तक "; ?><span class="text-danger">*</span></label>
               <?php $currentmonth = date('F'); ?>
                  <select name="pay_month_end" name="pay_month" class="form-control">
                                <option value=""><?php echo "वेतन महीने तक " ?></option>
                                <?php for ($m=1; $m<=12; $m++) {
     $month = date('F', mktime(0,0,0,$m, 1, date('Y')));
     
     ?>
                                    <option value="<?php echo $month ?>" <?php echo  $currentmonth == $month  ? 'selected' : ''; ?> ><?php echo $month ?></option>
                                <?php } ?>
                            </select> 
							 <select name="pay_year_end" name="pay_year_end" class="form-control">
                                <option value=""><?php echo " एरीयस साल  तक "; ?></option>
                                <?php for ($my=2001; $my<=date("Y"); $my++) {
   
     ?>
                                    <option value="<?php echo $my ?>"  ><?php echo $my ?></option>
                                <?php } ?>
                            </select> 

                <?php echo form_error('category_title_hin');?>
              </div>-->
         
   <div class="box-footer">
          <button class="btn btn-primary" type="submit" name="savenotice" id="savenotice" onclick="showdetails()" value="1"><?php echo $this->lang->line('submit_botton'); ?></button>
 </form>
  </div> 
     </div>   <!-- col 12-->
    </div><!-- /.row -->
 
    </div>
</section><!-- /.content -->
<script type="text/javascript">
$('.select').on('change', function() {
$month1  = $("#pay_month1").val();
$month  = $("#pay_month").val();
  $("#1").attr("href", "<?php echo base_url(); ?>payroll/getarrias/1/"+$month+"/"+$month1);
  $("#2").attr("href", "<?php echo base_url(); ?>payroll/getarrias/2/"+$month+"/"+$month1);
  $("#3").attr("href", "<?php echo base_url(); ?>payroll/getarrias/3/"+$month+"/"+$month1);
  $("#4").attr("href", "<?php echo base_url(); ?>payroll/getarrias/4/"+$month+"/"+$month1);
  $("#5").attr("href", "<?php echo base_url(); ?>payroll/getarrias/5/"+$month+"/"+$month1);
  $("#6").attr("href", "<?php echo base_url(); ?>payroll/getarrias/6/"+$month+"/"+$month1);
  $("#7").attr("href", "<?php echo base_url(); ?>payroll/getarrias/7/"+$month+"/"+$month1);
  $("#8").attr("href", "<?php echo base_url(); ?>payroll/getarrias/8/"+$month+"/"+$month1);
    $("#9").attr("href", "<?php echo base_url(); ?>payroll/getarrias/9/"+$month+"/"+$month1);
  $("#10").attr("href", "<?php echo base_url(); ?>payroll/getarrias/10/"+$month+"/"+$month1);
  $("#11").attr("href", "<?php echo base_url(); ?>payroll/getarrias/11/"+$month+"/"+$month1);
  $("#12").attr("href", "<?php echo base_url(); ?>payroll/getarrias/12/"+$month+"/"+$month1);
    $("#13").attr("href", "<?php echo base_url(); ?>payroll/getarrias/13/"+$month+"/"+$month1);
  $("#14").attr("href", "<?php echo base_url(); ?>payroll/getarrias/14/"+$month+"/"+$month1);
});
$('.select1').on('change', function() {

$month1  = $("#pay_month11").val();
$month  = $("#pay_month12").val();


  $("#_1").attr("href", "<?php echo base_url(); ?>payroll/getarrias_pp/1/"+$month+"/"+$month1);
  $("#_2").attr("href", "<?php echo base_url(); ?>payroll/getarrias_pp/2/"+$month+"/"+$month1);
  $("#_3").attr("href", "<?php echo base_url(); ?>payroll/getarrias_pp/3/"+$month+"/"+$month1);
  $("#_4").attr("href", "<?php echo base_url(); ?>payroll/getarrias_pp/4/"+$month+"/"+$month1);
  $("#_5").attr("href", "<?php echo base_url(); ?>payroll/getarrias_pp/5/"+$month+"/"+$month1);
  $("#_6").attr("href", "<?php echo base_url(); ?>payroll/getarrias_pp/6/"+$month+"/"+$month1);
  $("#_7").attr("href", "<?php echo base_url(); ?>payroll/getarrias_pp/7/"+$month+"/"+$month1);
  $("#_8").attr("href", "<?php echo base_url(); ?>payroll/getarrias_pp/8/"+$month+"/"+$month1);
    $("#_9").attr("href", "<?php echo base_url(); ?>payroll/getarrias_pp/9/"+$month+"/"+$month1);
  $("#_10").attr("href", "<?php echo base_url(); ?>payroll/getarrias_pp/10/"+$month+"/"+$month1);
  $("#_11").attr("href", "<?php echo base_url(); ?>payroll/getarrias_pp/11/"+$month+"/"+$month1);
  $("#_12").attr("href", "<?php echo base_url(); ?>payroll/getarrias_pp/12/"+$month+"/"+$month1);
   $("#_13").attr("href", "<?php echo base_url(); ?>payroll/getarrias_pp/13/"+$month+"/"+$month1);
  $("#_14").attr("href", "<?php echo base_url(); ?>payroll/getarrias_pp/14/"+$month+"/"+$month1);
});
$(document).ready(function() {
    var max_fields      = 10; 
    var wrapper         = $(".input_fields_wrap");
    var add_button      = $(".add_field_button"); 
    
    var x = 1; 
    $(add_button).click(function(e){ 
        e.preventDefault();
        if(x < max_fields){ 
            x++; 
            $(wrapper).append('<div><input type="text" name="unicode[]" required class="form-control"/><a href="#" class="remove_field">Remove</a></div>'); 
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ 
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>