
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
                
                <div class="box-body">
                       
 <?php  $in = 0;  foreach ($emp_details as $key => $pay) { $in = $in +1 ; if($in == 1){
  ?> 
        <div class="col-xs-12">
          <div class="col-xs-6">
           <h3> Neme : <?php echo $pay->emp_full_name_hi; ?><h3/>
          </div>    <div class="col-xs-6">
            <h3>Unique code :<?php $firstdigit= substr($pay->emp_unique_id, 0, 1); if($firstdigit == 5 ){$a = 0; }else{$a = "";}echo $a.$pay->emp_unique_id;  ?></h3>
            </div>   </div>
        

         
<?php }} ?>                 </div>
            </div>
        </div>
    </div>
    <!-- Your Page Content Here -->
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">

               <div class="box-body">
               	  <form action="<?php echo base_url();?>payroll/edit_salarymaster" enctype="multipart/form-data" id="myForm" onsubmit="salarymasster()" method="post">

                      <div class="col-lg-12 "> 
      <div class="form-group">
                <label for="email"><?php echo "वेतन फिक्सेशन प्रकार" ?></label>
               <select name="pf_icr" id="pf_icr" onchange="salarycal()" required class="form-control">

                                <option value=""><?php echo "वेतन फिक्सेशन प्रकार"; ?></option>
                                <?php foreach ($pay_fixation as $key => $fix) { ?>
							
                               <option   value="<?php echo $fix->pf_id; ?>"  ><?php echo $fix->pf_name ?></option>
							   
							   <?php 
							   }?> </select>  </div>

              </div>
                      </div>
   <div class="col-lg-12 box box-primary" id="orderdetails"> 

       <div class="box-header box-warning">
                      <h3>आर्डर विवरण </h3>
                    </div>
    <div class="col-lg-6" id="orderdetails"> 
      <div class="form-group">
                <label for="email"><?php echo "आदेश नंबर " ?></label>
                    <input type="number"  required name="order_no" id="order_no" placeholder="<?php echo "आर्डर नंबर"; ?>"  value="" class="form-control">
               
                </div>
<div class="form-group">
                <label for="email"><?php echo "लागू की तारीख " ?></label>
                    <input type="text" required name="order_date1" id="order_date1" placeholder="<?php echo "लागू की तारीख "; ?>"  value="" class="form-control date1">
               
                </div>
 </div>

 <div class="col-lg-6" id="orderdetails"> 
     
 <div class="form-group">
                <label for="email"><?php echo "आदेश दिनांक  " ?></label>
                    <input type="text" required  name="order_date" id="order_date" placeholder="<?php echo "आर्डर दिनांक "; ?>"  value="" class="form-control date1">
               
                </div>

 <div class="form-group">
              
                <label for="exampleInputEmail1"><?php echo "लागू करने का महीना"; ?><span class="text-danger">*</span></label>
               <?php $currentmonth = date('F'); ?>
                  <select  required name="pay_month" name="pay_month"  class="form-control">
                                <option value=""><?php echo $this->lang->line('emp_pay_month'); ?></option>
                                <?php for ($m=1; $m<=12; $m++) {
     $month = date('F', mktime(0,0,0,$m, 1, date('Y')));
     
     ?>
                                    <option value="<?php echo $month ?>"  ><?php echo $month ?></option>
                                <?php } ?>
                            </select> 
              </div>
</div>
 <div class="col-lg-12" id="orderdetails"> 
<div class="form-group">
    <input id="uploadImage1" type="file" name="file_upload" onchange="PreviewImage(1);" style="float: left" required/>
  आदेश का अपलोड साइज़ : 10 MB
    <input type="button" id="reset_pdf" value="Remove doc" style="float: right"/>
    <span id="dis_file_size"></span>
</div>
<div class="form-group" style="border: 1px solid gray;height: 600px;" id="scan_file_div">
    <!--  <object id="uploadPreview1" data="<?php echo base_url()?>/uploads/Viwer_example.pdf" width="100%" height="600px"></object>-->
</div>
     <div class="form-group"> <label for="exampleInputEmail1"><?php echo "विवरण "; ?><span class="text-danger">*</span></label>
           
<textarea name="description" required id="description" class="form-control"></textarea>
</div>
</div>

   <div class="col-lg-12 box box-primary" id="orderdetails"> 

               	  	<div class="col-lg-6 "> 
               	  		   <div class="box-header box-warning">
               	  		<h3>वेतन अभिलेख / वेतन वृद्धि</h3>
               	  	</div>



           <?php
//pre($pay_salary);
//pre($pay_fixation);
 	if(count($pay_salary) != 0){
 	$i=0; 	
 		foreach ($pay_salary as $key => $pay) { 

      ?>
 
  <input type="hidden" name="pay_salary_cate_id" id="pay_salary_cate_id" value="<?php echo $pay->pay_salary_cate_id  ?>" class="form-control">
                <input readonly type="hidden" name="pay_id" id="pay_id" value="<?php echo $pay->pay_id;  ?>" class="form-control">
         <input readonly type="hidden" name="no_updated" id="no_updated" value="<?php echo $pay->no_updated +1;  ?>" class="form-control">
            
<input readonly type="hidden" name="no_updated" id="pay_emp_unique_id" value="<?php echo $pay->pay_emp_unique_id  ?>" class="form-control">
         

      <?php
               if($dataval[0]['pay_cate_basic'] == 1){	?>
     <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("basic_pay");?></label> <span class="text-danger">*</span></label>
                  <input readonly type="number" onfocus="totalvalue()" name="pay_basic" id="pay_basic" placeholder="<?php echo $this->lang->line('emp_unique_code'); ?>"  value="<?php echo $pay->pay_basic; ?>" class="form-control">
               
            </div>  

<?php }if($dataval[0]['pay_cate_grp'] == 1){	?>
             <div class="form-group ">
                <label for="file_type"><?php echo $this->lang->line("pay_gradepay");?></label> <span class="text-danger">*</span></label>
                  <input readonly type="number" onfocus="totalvalue()" name="pay_gradepay" id="pay_gradepay" placeholder="<?php echo $this->lang->line('pay_gradepay'); ?>" value="<?php echo @$pay->pay_grp; ?>" class="form-control">
              
            </div>

<?php }if($dataval[0]['pay_cate_da'] == 1){	?>

         <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_da");?></label> <span class="text-danger">*</span></label>
               <input readonly type="number" onfocus="totalvalue()" name="pay_da"  onfocus="showday()" id="pay_da" placeholder="<?php echo $this->lang->line('emp_unique_code'); ?>"  value="<?php echo $pay->pay_da; ?>" class="form-control">
               
            </div>
      <?php }if($dataval[0]['pay_cate_special'] == 1){	?>
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_special");?></label> <span class="text-danger">*</span></label>
              
               <input readonly type="number" onfocus="totalvalue()" name="pay_special" id="pay_special" placeholder="<?php echo $this->lang->line('emp_unique_code'); ?>"  value="<?php echo $pay->pay_special; ?>" class="form-control">
            </div>
      <?php }if($dataval[0]['pay_cate_hra'] == 1){	?>
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_hra");?></label> <span class="text-danger">*</span></label>
      
                        <input readonly type="text" onfocus="totalvalue()" name="pay_hra" id="pay_hra" placeholder="<?php echo $this->lang->line('emp_unique_code'); ?>"  value="<?php echo $pay->pay_hra;?>" class="form-control">
            </div>
      <?php }if($dataval[0]['pay_cate_sa'] == 1){	?>
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_sa");?></label> <span class="text-danger">*</span></label>
               
                <input readonly type="number" onfocus="totalvalue()" name="pay_sa" id="pay_sa" placeholder="<?php echo $this->lang->line('pay_sa'); ?>"  value="<?php echo $pay->pay_sa;?>" class="form-control">
            </div>
             <?php }if($dataval[0]['pay_cate_madical'] == 1){	?> 
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_ma");?></label> <span class="text-danger">*</span></label>
               
                <input readonly type="number" onfocus="totalvalue()" name="pay_madical" id="pay_madical" placeholder="<?php echo $this->lang->line('pay_ma'); ?>"  value="<?php echo $pay->pay_madical;?>" class="form-control">
            </div>
               <?php }if($dataval[0]['pay_cate_ca'] == 1){	?> 
				<div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_ca");?></label> <span class="text-danger">*</span></label>
               
                <input readonly type="number" name="pay_ca" id="pay_ca" placeholder="<?php echo $this->lang->line("pay_ca");?>"  value="<?php echo $pay->pay_ca;?>" class="form-control">
            </div>
			   <?php }if($dataval[0]['pay_cate_sp'] == 1){	?> 
			<div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_sp");?></label> <span class="text-danger">*</span></label>
               
                <input readonly type="number" onfocus="totalvalue()" name="pay_sp" id="pay_sp" placeholder="<?php echo $this->lang->line("pay_sp");?>"  value="<?php echo $pay->pay_sp;?>" class="form-control">
            </div>
			<?php } ?>
			<div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_others");?></label> <span class="text-danger">*</span></label>
               
                <input readonly type="number" onfocus="totalvalue()" name="pay_others" id="pay_others" placeholder="<?php echo $this->lang->line("pay_others");?>"  value="<?php echo $pay->pay_others;?>" class="form-control">
            </div>
			
			<div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_sum");?></label> <span class="text-danger">*</span></label>
                <input readonly type="number" onfocus="totalvalue()" name="pay_total_sum" id="pay_total_sum" placeholder="<?php echo $this->lang->line('pay_ma'); ?>"  value="<?php echo $pay->pay_total_sum;?>" class="form-control">
              
            </div>
        </div ><div class="col-lg-6 ">

        	   <div class="box-header box-warning">
               	  		<h3>वेतन कटौती राशि</h3>
               	  	</div>

      
         <?php   if($dataval[0]['pay_cate_gpf'] == 1){ ?>
     <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_gpf");?></label> <span class="text-danger">*</span></label>
               
                <input readonly type="number"  name="pay_gpf" id="pay_gpf" placeholder="<?php echo $this->lang->line('pay_ma'); ?>"  value="<?php echo $pay->pay_gpf;?>" class="form-control">
              
            </div>
          <?php }  if($dataval[0]['pay_cate_dpf'] == 1){ ?>
     <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_dpf");?></label> <span class="text-danger">*</span></label>
               
                <input readonly type="number" name="pay_dpf" id="pay_dpf" placeholder="<?php echo $this->lang->line('pay_cate_dpf'); ?>"  value="<?php echo $pay->pay_gpf;?>" class="form-control">
              
            </div>
            
            <?php }if($dataval[0]['pay_cate_defined_contribution'] == 1){  ?>

         <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_define");?></label> <span class="text-danger">*</span></label>
               
                       <input readonly type="number" name="pay_define" id="pay_define" placeholder="<?php echo $this->lang->line('pay_ma'); ?>"  value="<?php echo $pay->pay_defined_contribution;?>" class="form-control">
            </div>
        <?php }if($dataval[0]['pay_cate_gias'] == 1){  ?>
      <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_gis");?></label> <span class="text-danger">*</span></label>
               
                 <input readonly type="number" name="pay_gias" id="pay_gias" placeholder="<?php echo $this->lang->line('pay_gis'); ?>"  value="<?php echo $pay->pay_gias;?>" class="form-control">
            </div>
        <?php }if($dataval[0]['pay_cate_house_rent'] == 1){  ?>
       <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_house_rent");?></label> <span class="text-danger">*</span></label>
            
               <input readonly type="number" name="pay_house_rent" id="pay_house_rent" placeholder="<?php echo $this->lang->line('pay_house_rent'); ?>"  value="<?php echo $pay->pay_house_rent;?>" class="form-control">
            </div>
		<?php }if($dataval[0]['pay_cate_fuel_charge'] == 1){  ?>
                  <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_fule_charge");?></label> <span class="text-danger">*</span></label>
            
               <input readonly type="number" name="pay_fuel_charge" id="pay_fuel_charge" placeholder="<?php echo $this->lang->line('pay_gis'); ?>"  value="<?php echo $pay->pay_fuel_charge;?>" class="form-control">
            </div>
			<?php }if($dataval[0]['pay_cate_professional_tax'] == 1){  ?>
			
			  
			<div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_professional_tax");?></label> <span class="text-danger">*</span></label>
          
               <input readonly type="number"  name="pay_professional_tax" id="pay_professional_tax" placeholder="<?php echo $this->lang->line('pay_gis'); ?>"  value="<?php echo $pay->pay_professional_tax;?>" class="form-control">
            </div>
            <?php }if($dataval[0]['pay_cate_income_tax'] == 1){  ?>
            <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_income_tax");?></label> <span class="text-danger">*</span></label>
               
                  <input readonly type="number" name="pay_income_tax" id="pay_income_tax" placeholder="<?php echo $this->lang->line('pay_gis'); ?>"  value="<?php echo $pay->pay_income_tax;?>" class="form-control">
            </div>
           <?php }if($dataval[0]['pay_cate_other_adv'] == 1){  ?>
            <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line("pay_other_adv");?></label> <span class="text-danger">*</span></label>
               
                  <input readonly type="number" name="pay_cate_other_adv" id="pay_cate_other_adv" placeholder="<?php echo $this->lang->line('pay_other_adv'); ?>"  value="<?php echo $pay->pay_other_adv;?>" class="form-control">
            </div>
            <?php } ?>
	            <div class="form-group">
	                <label for="file_type"><?php echo $this->lang->line("pay_total_cut");?></label> <span class="text-danger">*</span></label>
	               
	                  <input readonly type="number" name="pay_total_cut" onfocus="showtotal_DIII()" id="pay_total_cut" placeholder="<?php echo $this->lang->line('pay_total_cut'); ?>"  value="<?php echo $pay->pay_total_cut;?>" class="form-control">
	            </div>
        <div class="form-group ">
	                <label for="file_type">कुल वेतन  </label> <span class="text-danger">*</span></label>
	               
	                  <input readonly type="number" name="pay_total" onfocus="" id="pay_total" placeholder=""  value="<?php echo $pay->pay_total;?>" class="form-control">
	            </div>
     </div>
		
            
<?php 
	} 

	}

//pre($pay_salary);


?>

   </div>

               	  <div class="box-footer">
          <button class="btn btn-primary" type="submit" name="savenotice" id="savenotice"  value="1"><?php echo $this->lang->line('submit_botton'); ?></button>
        </div>
</div>
           </div><!-- /.box --></div>
        </div>
    </div><!-- /.row -->
    <style type="text/css">

.image-preview-input {
    position: relative;
  overflow: hidden;
  margin: 0px;    
    color: #333;
    background-color: #fff;
    border-color: #ccc;    
}
.image-preview-input input[type=file] {
  position: absolute;
  top: 0;
  right: 0;
  margin: 0;
  padding: 0;
  font-size: 20px;
  cursor: pointer;
  opacity: 0;
  filter: alpha(opacity=0);
}
.image-preview-input-title {
    margin-left:2px;
}
    </style>
    <!-- Main row -->
</section><!-- /.content -->

<!-- Modal approve -->
<script type="text/javascript">

$(document).on('click', '#close-preview', function(){ 
    $('.image-preview').popover('hide');
    // Hover befor close the preview
    $('.image-preview').hover(
        function () {
           $('.image-preview').popover('show');
        }, 
         function () {
           $('.image-preview').popover('hide');
        }
    );    
});

$(function() {
    // Create the close button
    var closebtn = $('<button/>', {
        type:"button",
        text: 'x',
        id: 'close-preview',
        style: 'font-size: initial;',
    });
    closebtn.attr("class","close pull-right");
    // Set the popover default content
    $('.image-preview').popover({
        trigger:'manual',
        html:true,
        title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
        content: "There's no image",
        placement:'bottom'
    });
    // Clear event
    $('.image-preview-clear').click(function(){
        $('.image-preview').attr("data-content","").popover('hide');
        $('.image-preview-filename').val("");
        $('.image-preview-clear').hide();
        $('.image-preview-input input:file').val("");
        $(".image-preview-input-title").text("Browse"); 
    }); 
    // Create the preview image
    $(".image-preview-input input:file").change(function (){     
        var img = $('<img/>', {
            id: 'dynamic',
            width:250,
            height:200
        });      
        var file = this.files[0];
        var reader = new FileReader();
        // Set preview image into the popover data-content
        reader.onload = function (e) {
            $(".image-preview-input-title").text("Change");
            $(".image-preview-clear").show();
            $(".image-preview-filename").val(file.name);            
            img.attr('src', e.target.result);
            $(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
        }        
        reader.readAsDataURL(file);
    });  
});
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
function salarycal(){
 pay_icr = $("#pf_icr").val();

$.get( "<?php echo  base_url(); ?>payroll/salarycal/<?php echo $_GET['uid']?>/"+pay_icr, function( data ) {

  console.log(data);
  var salary = data.split("|");
  $("#pay_basic").val(salary[0]);
$("#pay_da").val(salary[1]);
  pay_basic = salary[0];

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
  pay_da = salary[1];
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
    $("#description").val(salary[2]);
 

$("#pay_basic").css("background-color", "yellow");
$("#pay_da").css("background-color", "yellow");
$("#pay_total").css("background-color", "yellow");
$("#pay_total_sum").css("background-color", "yellow");
});
}

function salarymasster()
{
      var r = confirm("कृपया सुनिश्चित करें कि , डेटा सही है की नहीं");
    if (r == true) {
        document.getElementById("myForm").submit();


    } else {
        txt = "You pressed Cancel!";
    }
  alert(txt);
}
</script><script type="text/javascript">
    function PreviewImage(no) {
        var  file_size1 = document.getElementById("uploadImage"+no).files[0].size/ 1048576;
        //  document.getElementById("dis_file_size").innerHTML = "File size is "+file_size1;
        if(file_size1 <= '10') {
            $('#scan_file_div').empty().append('<object id="uploadPreview1" width="100%" height="600px"></object>');
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("uploadImage" + no).files[0]);

            oFReader.onload = function (oFREvent) {
                document.getElementById("uploadPreview" + no).data = oFREvent.target.result;
            };
            var sf = document.getElementById("uploadImage"+no).files[0].name;
            sf = sf.substring(0, sf.indexOf('.'));
            $('#file_title').val(sf);
        }
        else{
            alert('u choose more then 10 mb file');
            $('#scan_file_div').empty().append('<object id="uploadPreview1" width="100%" height="600px"></object>');
            $('#uploadImage1').val('');
        }
    }
    $(document).ready(function(){
        $('#reset_pdf').on('click', function() {
            $('#uploadImage1').val('');
            $('#scan_file_div').empty().append('<object id="uploadPreview1" width="100%" height="600px"></object>');
        });
    
     $("#scan_file_types").change(function() {
            var scan_file_types = $(this).val();
            //  alert(scan_file_types);
            var HTTP_PATH='<?php echo base_url(); ?>';
            $.ajax({
                type: "POST",
                url: HTTP_PATH + "scan_files/get_subfiletype",
                datatype: "json",
                async: false,
                data: {scan_file_id: scan_file_types},
                success: function(data) {
                    var r_data = JSON.parse(data);
                    
                    var otpt = '<option value="">Select</option>';
                    $.each(r_data, function( index, value ) {
                        // console.log(value);
                        if(value.sub_file_type_hi != null) {
                            otpt += '<option value="' + value.type_id + '">' + value.sub_file_type_hi + '</option>';
                        }else{
                            otpt += '<option value="' + value.type_id + '">' + value.sub_file_type + '</option>';
                        }
                    });
                    $("#scan_subfile_types").html(otpt);
                }
            });
        });
    
    });
</script>