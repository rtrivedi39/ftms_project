
<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script type="text/javascript">
  function get_notery_form(fileid,url_path){ 
		
		/*alert(url_path);
		 var file1 = fileid ;*/
		var base = '<?php echo base_url()?>';
		 $('#redirect_url').val(url_path);
		 $("#skip_button").prop("href", base+url_path);
		 $("#skip_button").attr('target', '_blank'); 

		 /*$('#skip_button').val(url_path);*/
        $('#url_path').val(url_path);
        $('#dispatch_model').modal('show'); 
	}
	
	function getAdvocateName(name_hi)
	{
		
		  var HTTP_PATH='<?php echo base_url(); ?>';
			$.ajax({
                type: "POST",
                url: HTTP_PATH + "advocates/getAdvocateName",
                datatype: "json",
                async: false,
                data: {name_hi: name_hi},
                success: function(data) {
					/*alert(data);*/
					console.log(data);
                 }
            });
	}
    $(function () {
		
       /* Get user name*/
        $(".rty1").click(function () {
            var file_id = $(this).val();
            var HTTP_PATH='<?php echo base_url(); ?>';
            $.ajax({
                type: "POST",
                url: HTTP_PATH + "view_file/section_da_name",
                datatype: "json",
                async: false,
                data: {file_id: file_id},
                success: function(data) {
                    var r_data = JSON.parse(data);
                    var otpt = '<select class="form-control" name="emp_id"><option value="">Select DA name</option> ';
                    $.each(r_data, function( index, value ) {
                        otpt += '<option value="'+value.emp_id+'">'+value.emp_full_name+'</option>';
                    });
                    otpt += '</select>';
                    $("#emp_byfile").html(otpt);
                }
            });
        });
     });



</script>
<style>

.frmSearch {border: 1px solid #F0F0F0;background-color:#C8EEFD;margin: 2px 0px;padding:40px;}
#country-list{float:left;list-style:none;margin:0;padding:0;width:190px;}
#country-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#country-list li:hover{background:#F0F0F0;}
#search-box{padding: 10px;border: #F0F0F0 1px solid;}
#scm_name_en-error , #scm_name_hi-error, #advocate_posttype-error , #advocate_aplicant_type-error  ,#scm_address_hi-error{ color:#a94442 }
</style>

<script>
$(document).ready(function(){
	
			
	$("#scm_name_en").keyup(function(){
		
		 var HTTP_PATH='<?php echo base_url(); ?>';
		$.ajax({
		type: "POST",
		     url: HTTP_PATH + "advocates/getAdvocateName",
		data:'name_en='+$(this).val(),
		beforeSend: function(){
			$("#scm_name_en").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
		
			console.log(data);
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#scm_name_en").css("background","#FFF");
		}
		});
	});
	
	$("#scm_name_hi").keyup(function(){
	
		 var HTTP_PATH='<?php echo base_url(); ?>';
		$.ajax({
		type: "POST",
		url: HTTP_PATH + "advocates/getAdvocateName_hin",
		data:'name_hi='+$(this).val(),
		beforeSend: function(){
			$("#scm_name_hi").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			
			console.log(data);
			$("#suggesstion-box_hin").show();
			$("#suggesstion-box_hin").html(data);
			$("#scm_name_hi").css("background","#FFF");
		}
		});
	});
});

function selectAdvocate_name_en(val,scm_id) {
$("#scm_name_en").val(val);
	var HTTP_PATH='<?php echo base_url(); ?>';
		$.ajax({
		type: "POST",
		     url: HTTP_PATH + "advocates/getAdvocatedetails",
		data:'scm_id='+scm_id,
		beforeSend: function(){
			$("#scm_name_en").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			
			
			
			  var r_data = JSON.parse(data);
			$("#once_registration_number_council").val(r_data[0]['once_registration_number_council']);
			   ;
			   $("#scm_name_hi").val(r_data[0]['scm_name_hi']);
			   $("#father_name").val(r_data[0]['father_name']);
			   $("#email_id").val(r_data[0]['email_id']);
			   $("#contact_no").val(r_data[0]['once_registration_number_council']);
			   $("#scm_address_hi").val(r_data[0]['scm_address']);
			   $("#scm_pincode").val(r_data[0]['scm_pincode']);
			   $("#stamp_no").val(r_data[0]['stamp_no']);
			   $("#stamp_date").val(r_data[0]['stamp_date']);
			   $("#adv_order_no").val(r_data[0]['order_no']);
			   $("#adv_order_date").val(r_data[0]['order_date']);
			   $("#chalan_no").val(r_data[0]['adv_invoice_no']);
				}
		});
$("#suggesstion-box").hide();
}


function selectAdvocate_name_hi(val,scm_id) {

var HTTP_PATH='<?php echo base_url(); ?>';
		$.ajax({
		type: "POST",
		url: HTTP_PATH + "advocates/getAdvocatedetails",
		data:'scm_id='+scm_id,
		beforeSend: function(){
			$("#scm_name_en").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			 console.log(data);
			
		}
		});
$("#suggesstion-box_hin").hide();
}

</script>
<!-- Disptach Modal -->
<div class="modal fade" id="dispatch_model" tabindex="-1" role="dialog" aria-labelledby="Dispatchmodel">
    <div class="modal-dialog" role="document">
       
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-edit"></i>नोटरी की जानकारी</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body table-responsive">
                        <div class="box-body">
                           
					<form role="form" method="post" id="advocate_form" action="<?php echo base_url() ?>advocates/manage_advocate<?php if (isset($id)) {
                    echo '/' . $id;
                } ?>">
				
			   <input type="hidden" name="url_path_currnet" id="url_path_currnet" value="<?php echo $this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3).'/'.$this->uri->segment(4); ?>"> 
			   <input type="hidden" name="redirect_url" id="redirect_url" value=""> 
                    <div class="col-md-6">
                        <div class="box box-primary" style="margin-top: 15px;">
                            <div class="box-body">
								
								
								<div class="form-group">
									<label><?php echo $this->lang->line('advocate_applicant_type_label'); ?><span class="text-danger">*</span> :</label>
									
									<?php  $selected  = '' ;
									if(isset($adv_details['advocate_aplicant_type'])){
										 $selected  = $adv_details['advocate_aplicant_type'] ;
									} else if($this->input->post('advocate_aplicant_type')){
										 $selected  = $this->input->post('advocate_aplicant_type') ;
									} ?>
									<?php echo get_adv_aplicant_type_ddl_list('advocate_aplicant_type', 'class="form-control"',$selected ); ?>
									 <?php echo form_error('advocate_aplicant_type'); ?>
									 <span id="advocate_aplicant_type-error"></span>
								</div>
								
								<div class="form-group">
									<label><?php echo $this->lang->line('advocate_post_id_label'); ?><span class="text-danger">*</span> :</label>
									
									<?php  $selected  = '' ;
									if(isset($adv_details['advocate_post_type'])){
										 $selected  = $adv_details['advocate_post_type'] ;
									} else if($this->input->post('advocate_post_type')){
										 $selected  = $this->input->post('advocate_post_type') ;
									} ?>
									<?php echo get_advocate_posttype_ddl_list('advocate_post_type', 'class="form-control"','nty' ); ?>
									<?php echo form_error('advocate_post_type'); ?>
									<span id="advocate_posttype-error"></span>
								</div>
								<div class="form-group">
									<label><?php echo $this->lang->line('emp_full_name_label_hi'); ?> <span class="text-danger">*</span> :</label>
									<input type="text" class="form-control" name="scm_name_hi" id="scm_name_hi" value="<?php echo isset($adv_details['scm_name_hi'])? $adv_details['scm_name_hi']:$this->input->post('scm_name_hi')?>" >
									 <?php echo form_error('scm_name_hi'); ?>
									 <div id="suggesstion-box_hin"></div>
									 <span id="scm_name_hi-error"></span>
								</div>
								<div class="form-group">
									<label><?php echo $this->lang->line('emp_full_name_label_en'); ?>:</label>
									<input type="text" class="form-control" name="scm_name_en" id="scm_name_en" value="<?php echo isset($adv_details['scm_name'])? $adv_details['scm_name']:$this->input->post('scm_name_en')?>">
									 <?php echo form_error('scm_name_en'); ?>
									 <div id="suggesstion-box"></div>
									
								</div>
								<div class="form-group">
									<label><?php echo $this->lang->line('adv_father_name_label'); ?>:</label>
									<input type="text" class="form-control" name="father_name" id="father_name" value="<?php echo isset($adv_details['father_name'])? $adv_details['father_name']:$this->input->post('father_name')?>">
								</div>
								<div class="form-group">
									<label><?php echo $this->lang->line('adv_emailid_label'); ?>:</label>
									<input type="email" class="form-control" name="email_id" id="email_id" value="<?php echo isset($adv_details['email_id'])? $adv_details['email_id']:$this->input->post('email_id')?>">
								</div>
								<div class="form-group">
									<label><?php echo $this->lang->line('adv_contactno_label'); ?>:</label>
									<input type="text" class="form-control" maxlength="12" name="contact_no" id="contact_no"  value="<?php echo isset($adv_details['contact_no'])? $adv_details['contact_no']:$this->input->post('contact_no')?>">
								</div>
								<div class="form-group">
									<label><?php echo $this->lang->line('adv_address_label'); ?><span class="text-danger">*</span> :</label>
								<textarea class="form-control" rows="3" name="scm_address_hi" id="scm_address_hi"><?php echo isset($adv_details['scm_address'])? $adv_details['scm_address_hi']:$this->input->post('scm_address_hi')?></textarea>
									 <span id="scm_address_hi-error"></span>
									<?php echo form_error('scm_address'); ?>
								</div>
								<div class="form-group">
									<label><?php echo $this->lang->line('adv_address_en_label'); ?> :</label>
									<textarea class="form-control" rows="3" name="scm_address_en"><?php echo isset($adv_details['scm_address'])? $adv_details['scm_address']:$this->input->post('scm_address_en')?></textarea>
									
								</div>
								<div class="form-group">
									<label><?php echo $this->lang->line('adv_address_pincode_label'); ?>:</label>
									<input type="number" class="form-control" name="scm_pincode" id="scm_pincode" maxlength="6" value="<?php echo isset($adv_details['scm_pincode'])? $adv_details['scm_pincode']:$this->input->post('scm_pincode')?>">
								</div>
								
								<div class="form-group">
									<label><?php echo $this->lang->line('adv_stamp_no_label'); ?>:</label>
									<input type="number" class="form-control" name="stamp_no" id="stamp_no" value="<?php echo isset($adv_details['stamp_no'])? $adv_details['stamp_no']:$this->input->post('stamp_no')?>">
									
								</div>
								<div class="form-group">
									<label><?php echo $this->lang->line('adv_stamp_date_label'); ?> :</label>
									<input type="text" class="form-control date1" name="stamp_date" id="stamp_date" value="<?php echo isset($adv_details['stamp_date'])? date('d-m-Y',strtotime($adv_details['stamp_date'])):$this->input->post('stamp_date')?>">
									
								</div>
								
							</div>
                        </div><!-- /.box -->
                    </div>
					
					<div class="col-md-6">
                        <div class="box box-primary" style="margin-top: 15px;">
                            <div class="box-body">
								<div class="form-group">
									<label><?php echo $this->lang->line('adv_order_no_label'); ?>:</label>
									<input type="text" class="form-control " name="adv_order_no" id="adv_order_no"  value="<?php echo isset($adv_details['order_no'])? $adv_details['order_no']:$this->input->post('adv_order_no')?>">
									
								</div>
								<div class="form-group">
									<label><?php echo $this->lang->line('adv_order_date_label'); ?>:</label>
									<input type="text" class="form-control date1" id="adv_order_date" name="adv_order_date" value="<?php echo isset($adv_details['order_date'])? date('d-m-Y',strtotime($adv_details['order_date']) ):$this->input->post('adv_order_date')?>">
									
								</div>
								<div class="form-group">
									<label><?php echo $this->lang->line('adv_court_type_label'); ?><span class="text-danger">*</span>:</label>
									<?php   $selected  = '' ;
									if(isset($adv_details['scm_court_name_hi'])){
										 $selected  = $adv_details['scm_court_name_hi'] ;
									}else if($this->input->post('scm_court_name_hi')){
										 $selected  = $this->input->post('scm_court_name_hi') ;
									} 
									echo get_court_name_ddl_list('scm_court_name_hi' , 'class="form-control"',$selected); ?>
								<span id="scm_court_name_hi-error"></span>
								</div>
								
								<div class="form-group">
									<label><?php echo $this->lang->line('adv_state_label'); ?>:</label>
									<?php  $selected  = '' ;
									if(isset($adv_details['state_id'])){
										 $selected  = $adv_details['state_id'] ;
									}else if($this->input->post('state_id')){
										 $selected  = $this->input->post('state_id') ;
									} ?>
									<?php echo get_state_ddl_list('state_id', ' class="form-control"',14);  ?>
								</div>
								<div class="form-group">
									<label><?php echo "जिला"; ?>:</label>
									<?php  $selected  = '' ;
									if(isset($adv_details['district_id'])){
										 $selected  = $adv_details['district_id'] ;
									}else if($this->input->post('district_id')){
										 $selected  = $this->input->post('district_id') ;
									} ?>
									<?php echo  get_distic_ddl_list('district_id', ' class="form-control"', $selected); ?>
								</div>
								<div class="form-group">
									<label><?php echo $this->lang->line('adv_tahsil_label'); ?>:</label>
									<?php  $selected  = '' ;
									if(isset($adv_details['tahsil_id'])){
										 $selected  = $adv_details['tahsil_id'] ;
									}else if($this->input->post('tahsil_id')){
										 $selected  = $this->input->post('tahsil_id') ;
									} ?>
									<?php 
										echo get_tahsil_ddl_list('tahsil_id',  'class="form-control tahsil_list" ',$selected ); ?>
									<div id="tahsil_div"></div>

							</div>
								<div class="form-group">
									<label><span id="appintment_date" ><?php echo $this->lang->line('adv_appointment_date_label'); ?></span>
									<span id="appintment_date_first" style="display:none"  ><?php echo $this->lang->line('adv_first_appointment_date_label'); ?></span> :</label>
									<input type="text" class="form-control date1" name="adv_appointment_posting_date" value="<?php echo isset($adv_details['posting_date'])? date('d-m-Y' ,strtotime($adv_details['posting_date'])):$this->input->post('adv_appointment_posting_date')?>">
								</div>
								<div class="form-group">
									<label><?php echo $this->lang->line('adv_provision_period_label'); ?></label>
									
									<?php  $selected  = '' ;
									if(isset($adv_details['provision_pirod'])){
										 $selected  = $adv_details['provision_pirod'] ;
									} else if($this->input->post('provision_pirod')){
										 $selected  = $this->input->post('provision_pirod') ;
									}
									echo get_provision_pirod_ddl_list('provision_pirod' , 'class="form-control" ',$selected ) ;
									?>
									
								</div>
								<div class="form-group">
									<label><?php echo $this->lang->line('adv_renewal date_label'); ?>:</label>
									<input type="text" class="form-control date1" name="post_renew_date" id="post_renew_date" value="<?php echo isset($adv_details['post_renew_date'])? date('d-m-Y',strtotime($adv_details['post_renew_date'])):$this->input->post('post_renew_date')?>">
								</div>
								<div class="form-group">
									<label><?php echo $this->lang->line('adv_application_for_renewal_date_label'); ?>:</label>
									<input type="text" class="form-control date1"  name="application_for_renewal_date" id="application_for_renewal_date" value="<?php echo isset($adv_details['application_for_renewal_date'])? date('d-m-Y',strtotime($adv_details['application_for_renewal_date'])):$this->input->post('application_for_renewal_date')?>">
								</div>
								<div class="form-group">
									<label><?php echo $this->lang->line('adv_invoice_no_label'); ?>:</label>
									<input type="text" class="form-control " name="adv_invoice_no"  id="adv_invoice_no"  value="<?php echo isset($adv_details['adv_invoice_no'])? $adv_details['adv_invoice_no']:$this->input->post('adv_invoice_no')?>">
								</div>
								<div class="form-group">
									<label><?php echo $this->lang->line('adv_invoice_date_label'); ?>:</label>
									<input type="text" class="form-control date1" name="adv_invoice_date"  id="adv_invoice_date"  value="<?php echo isset($adv_details['adv_invoice_date'])? date('d-m-Y',strtotime($adv_details['adv_invoice_date'])):$this->input->post('adv_invoice_date')?>">
								</div>
								<div class="form-group">
									<label><?php echo $this->lang->line('adv_once_registration_number_council_label'); ?>  :</label>
									<input type="text" class="form-control" name="once_registration_number_council" id="once_registration_number_council" value="<?php echo isset($adv_details['once_registration_number_council'])? $adv_details['once_registration_number_council']:$this->input->post('once_registration_number_council')?>">
									
									
								</div>
								<div class="form-group">
									<label><?php echo $this->lang->line('notery_registration_no_label'); ?> :</label>
									<input type="text" class="form-control" name="notery_registration_no" id="notery_registration_no" value="<?php echo isset($adv_details['once_registration_number_council'])? $adv_details['once_registration_number_council']:$this->input->post('once_registration_number_council')?>">
									
								</div>
								
								<div class="form-group" id="private_lawyer" style="display:none">
									<label for="private_lawyer_fee"><?php echo $this->lang->line('adv_private_lawyer_fee'); ?>:</label>
									<input type="text" class="form-control" name="package_amount" value="<?php echo isset($adv_details['package_amount'])? $adv_details['package_amount']:$this->input->post('package_amount')?>">
								</div>
								<div class="form-group" id="lokabhiyojak_power" style="display:none">
									<label><?php echo $this->lang->line('adv_lokabhiyojak_power_label'); ?>:</label>
									<textarea class="form-control" rows="3" name="lokabhiyojak_work"><?php echo isset($adv_details['lokabhiyojak_work'])? $adv_details['lokabhiyojak_work']:$this->input->post('lokabhiyojak_work')?></textarea>
								</div>
								
								
							</div>
                        </div><!-- /.box -->
                    </div>
                    
                        </div>
                    </div><!-- /.box-body -->
                </div>
                <div class="modal-footer">
                   
					<a  class="btn btn-danger pull-left" id="skip_button" >Skip</a>
                    <div class="box-footer">
									<button type="button" onclick="return advocate_post_data();" class="btn btn-primary">जमा करें</button>
								</div>
                </div>
			</form>
            </div>
      
    </div>
</div>
<script type="text/javascript" >
function advocate_post_data(){

	flag =1;
	$("#advocate_aplicant_type-error").html();	
	$("#advocate_posttype-error").html();
	$("#scm_name_hi-error").html();
	$("#scm_name_en-error").html();
	if($("#advocate_aplicant_type").val() == '' ){
		$("#advocate_aplicant_type-error").html("कृपया इसे जरुर दर्ज करे!");
		flag = 0; 
	}
	if($("#advocate_post_type").val() == '' ){
		$("#advocate_posttype-error").html("कृपया इसे जरुर दर्ज करे!");
		flag = 0; 
	}
	if($("#scm_name_hi").val() == '' ){
		$("#scm_name_hi-error").html("कृपया इसे जरुर दर्ज करे!");
		flag = 0; 
	}
	if($("#scm_court_name_hi").val() == '' ){
		$("#scm_court_name_hi-error").html("कृपया इसे जरुर दर्ज करे!");
		flag = 0; 
	}
	if($("#scm_address_hi").val() == '' ){
		$("#scm_address_hi-error").html("कृपया इसे जरुर दर्ज करे!");
		flag = 0; 
	}
	
	if(flag == 0 ){
		return false;
	}
	
	if(flag == 1 ){
		   $('#advocate_form').submit();
		
		return true;
	}
}
</script>
 <link href="<?php echo ADMIN_THEME_PATH; ?>plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
      <script src="<?php echo ADMIN_THEME_PATH; ?>plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
	  <script src="<?php echo base_url(); ?>themes/section_feilds.js" type="text/javascript"></script>
      <script type="text/javascript">
      $(function () {
     /*   //Date DOB*/
		$('.date1').datepicker();
	  });
	  </script>
	  <script type="text/javascript" language="javascript">
    window.onload = function() {
        var PopupWarning = {
            init: function() {
                var popups_are_disabled = this.popups_are_disabled();
                if (popups_are_disabled == true) {
                    this.redirect_to_instruction_page();
                } else {
                }
            },
            redirect_to_instruction_page: function() {
                window.location.href = 'a.aspx';
            },
            redirect_to_action_page: function() {
            },
            popups_are_disabled: function() {
                var popup = window.open("http://www.google.com", "popup_tester", "width=1,height=1,left=0,top=0");
                if (!popup || popup.closed || typeof popup == 'undefined' || typeof popup.closed == 'undefined') {
                    return true;
                }
                window.focus();
                popup.blur();
                if (navigator && (navigator.userAgent.toLowerCase()).indexOf("chrome") > -1) {
                    var on_load_test = function() { PopupWarning.test_chrome_popups(popup); };
                    var timer = setTimeout(on_load_test, 5);
                    return;
                }
                popup.close();
                return false;
            },
            test_chrome_popups: function(popup) {
                if (popup && popup.chrome_popups_permitted && popup.chrome_popups_permitted() == true) {
                    popup.close();
                    return true;
                }
                this.redirect_to_instruction_page();
            }
        };
        PopupWarning.init();
    }
	
	