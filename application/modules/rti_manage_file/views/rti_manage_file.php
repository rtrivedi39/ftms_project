<style>
    input[type=checkbox] + label {
        color: #dd4b39;
    }
    input[type=checkbox]:checked + label {
        color: #398439;
    }
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo $title; ?>
        <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo $this->lang->line('active_page'); ?></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
<!-- Your Page Content Here -->
<!-- Small boxes (Stat box) -->
<div class="row">
<div class="col-xs-12">
<div class="box">
    <div class="box-header">
        <div style="float:left"><h3 class="box-title"><?php echo $title_tab;?></h3></div>
        <button class="btn btn-warning" title="Back" onclick="goBack()" style="float:right"><?php echo $this->lang->line('Back_button_label'); ?>
    </div>
    <?php
    if($is_page_edit){ ?>
        <div style="float:right">
            <a href="<?php echo base_url();?>/cr_manage_file">
                <button class="btn btn-block btn-info"><?php echo $this->lang->line('add_new'); ?></button>
            </a>
        </div>
    <?php } ?>

</div><!-- /.box-header -->
<?php if($this->session->flashdata('message') || $this->session->flashdata('error')) {
    $msg = $this->session->flashdata('message') ? 'success' : 'danger';
    ?>
    <div class="alert alert-<?php echo $msg; ?> alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>
            <?php  echo $this->session->flashdata('message');
            echo $this->session->flashdata('error'); ?>
        </strong><br>
    </div>
<?php }?>
<div class="col-md-12">
<!-- general form elements -->
<!-- /.box-header -->
<!-- form start -->
<?php //echo $id; ?>
<?php
if( $this->uri->segment(2) == 'update_rtifiles_da'){
	?>
<form role="form" method="post" action="<?php echo base_url()?>manage/rti_file_da<?php if(isset($id)){ echo '/'.$id;} ?>" id="rti_frm"  enctype="multipart/form-data">
<?php
}
 else if(!empty($id)){
?>
<form role="form" method="post" action="<?php echo base_url()?>manage/rti_file<?php if(isset($id)){ echo '/'.$id;} ?>" id="rti_frm"  enctype="multipart/form-data">
<?php
	}else{ ?>
<form role="form" method="post" action="<?php echo base_url()?>manage/rti_file<?php if(isset($id)){ echo '/'.$id;} ?>" id="rti_frm"  enctype="multipart/form-data">
<?php } ?>
<div class="col-md-6">
    <div class="box box-primary">
        <div class="box-body">
            <div class="form-group">
				<?php 
				
				if(!isset($file_type) && @$file_type==''){
					@$file_type=$file_detail[0]['file_type'];
				} if(isset($applicant_firm_name) && @$applicant_firm_name==''){
					@$applicant_firm_name=$file_more_detail[0]['applicant_name'];
				}if(isset($firm_contact_no) && @$firm_contact_no==''){
					@$firm_contact_no=$file_more_detail[0]['rti_applicant_contactno'];
				}if(isset($rti_file_fee) && @$rti_file_fee==''){
					@$rti_file_fee	=$file_more_detail[0]['rti_application_free'];
				} if(isset($val_file_subject) && @$val_file_subject==''){
					@$val_file_subject	=$file_detail[0]['file_subject'];
				}
				if(!empty($file_detail[0]['hearing_date_rti']) && ($file_detail[0]['hearing_date_rti'] == '0000-00-00'))
				@$hearing_date = date('d-m-Y' ,strtotime( $file_detail[0]['hearing_date_rti']));
				@$rti_file_fee =  $file_detail[0]['rti_application_fee'];
				@$pay_serial_no_rti =  $file_detail[0]['pay_serial_no_rti'];
				
				?>
                <label for="file_type"><?php echo $this->lang->line('label_type'); ?></label> <span class="text-danger">*</span></label>
                <select class="form-control" name="file_type" id="file_type">
                    <?php foreach(file_types() as $key => $value){
                        if($file_type===$key ){
                            $auto_select='selected';
                        }else{ $auto_select='';}
                        if($key=='f' || $key=='l' || $key=='n' ||  $key=='fa' ){
                            echo '<option value="'.$key.'" '.$auto_select.' >'.$value.'</option>';
                        }
                    } ?>
                </select>
                <?php echo form_error('file_type');?>
            </div>
            <div class="form-group ">
                <label for="applicant_firm_name" id="applicant_firm_name"><?php echo $this->lang->line('rti_file_applicant_firm_name')?></label> <span class="text-danger">*</span></label>
                <input type="text" id="rti_file_applicant_firm_name" required  name="rti_file_applicant_firm_name" value="<?php echo isset($applicant_firm_name) ? $applicant_firm_name : ''; ?>" placeholder="<?php echo $this->lang->line('rti_file_applicant_firm_name'); ?>" class="form-control">
                <?php echo form_error('rti_file_applicant_firm_name');?>
            </div>
			<div class="form-group">
                <label for="rti_file_applicant_firm_contact_no" id="rti_file_applicant_firm_contact_no"><?php echo $this->lang->line('rti_file_applicant_firm_contact_no')?></label> <span class="text-danger">*</span></label>
                <input type="text" maxlength="12" name="rti_file_applicant_firm_contact_no" required value="<?php echo isset($firm_contact_no) ? $firm_contact_no : ''; ?>" placeholder="<?php echo $this->lang->line('rti_file_applicant_firm_contact_no'); ?>" class="form-control">
                <?php echo form_error('rti_file_applicant_firm_name');?>
            </div>
			<div class="form-group">
                <label for="rti_file_serial_no" id="rti_file_serial_no"><?php echo $this->lang->line('label_serial_no')?><span class="text-danger">*</span></label>
                <input type="text" name="rti_file_serial_no" required value="<?php echo isset($pay_serial_no_rti) ? $pay_serial_no_rti : ''; ?>" placeholder="<?php echo $this->lang->line('label_serial_no'); ?>" class="form-control">
                <?php echo form_error('rti_file_applicant_firm_name');?>
            </div>
			<div class="form-group">
                <label for="rti_file_hearing_date" id="rti_file_hearing_date"><?php echo $this->lang->line('label_hearing_date')?> <span class="text-danger">*</span></label>
                <input type="text" name="hearing_date" id="hearing_date" value="<?php echo isset($hearing_date) ? $hearing_date : ''; ?>" placeholder="<?php echo $this->lang->line('label_hearing_date'); ?>" class="form-control date1">
                
            </div>
			
            <div class="form-group">
                <label for="file_subject"><?php echo $this->lang->line('label_subject'); ?><span class="text-danger">*</span></label>
                <textarea class="form-control"  name="file_subject" required placeholder="Put subject here"><?php echo isset($val_file_subject) ? $val_file_subject : ''; ?></textarea>
                <?php echo form_error('file_subject');?>
            </div>
            <?php if($file_type!='n'){ ?>
                <div class="form-group hide_for_notice" id="" >
                    <label for="RTI_fees" id="RTI_fees"><?php echo $this->lang->line('rti_file_fee').' Rs'?> <span class="text-danger">*</span></label>
                    <input maxlength="5" type="text" id="rti_file_fee" name="rti_file_fee" required value="<?php echo isset($rti_file_fee) ? $rti_file_fee : ''; ?>" placeholder="<?php echo $this->lang->line('rti_file_fee'); ?>" class="form-control">
                    <?php echo form_error('rti_file_fee');?>
                </div>
            <?php }else{ ?>
                <div class="form-group hide_for_notice" style="display:none" id="" >
                    <label for="RTI_fees" id="RTI_fees"><?php echo $this->lang->line('rti_file_fee')?> <span class="text-danger">*</span></label>
                    <input type="text" id="rti_file_fee" name="rti_file_fee" required value="<?php echo isset($rti_file_fee) ? $rti_file_fee : ''; ?>" placeholder="<?php echo $this->lang->line('rti_file_fee'); ?>" class="form-control">
                    <?php echo form_error('rti_file_fee');?>
                </div>
            <?php }?>
			<div class="form-group" id="">
                <label for="RTI_fees" id="RTI_tip"><?php echo $this->lang->line('RTI_tip')?></label>
                <textarea class="form-control"  name="RTI_tip" placeholder="Enter TIP here"><?php echo isset($RTI_tip) ? $RTI_tip : ''; ?></textarea>
                <?php echo form_error('RTI_tip');?>
            </div>
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="box box-primary">
        <div class="box-body">
            <!--prastav Start-->
			<?php //pre($file_detail[0]); 
			if($this->input->post('file_offer_by') && $this->input->post('file_offer_by')!=''){
				@$file_offer_by=$this->input->post('file_offer_by');
			}else if($this->uri->segment(3)!=''){
				@$file_offer_by=$file_detail[0]['file_Offer_by'];
			}
			if($this->input->post('district_id') && $this->input->post('district_id')!=''){
				@$district_id=$this->input->post('district_id');
			}else if($this->uri->segment(3)!=''){ @$district_id=$file_detail[0]['file_district_id'];}
			if($this->input->post('state_id') && $this->input->post('state_id')!=''){ @$state_id=$this->input->post('state_id'); }
			else if($this->uri->segment(3)!=''){ @$state_id=$file_detail[0]['file_state_id'];}
			
			if($this->input->post('mark_file_section_id') && $this->input->post('mark_file_section_id')!=''){ @$mark_file_section_id=$this->input->post('mark_file_section_id'); }
			else if($this->uri->segment(3)!=''){ @$mark_file_section_id=$file_detail[0]['file_mark_section_id'];}
			
			if($this->input->post('file_department_id') && $this->input->post('file_department_id')!=''){ @$file_department_id=$this->input->post('file_department_id'); }
			else if($this->uri->segment(3)!=''){ @$file_department_id=$file_detail[0]['file_department_id'];}
			
			if($this->input->post('file_department_name') && $this->input->post('file_department_name')!=''){ @$file_department_name=$this->input->post('file_department_name'); }
			else if($this->uri->segment(3)!=''){ @$file_department_name=$file_detail[0]['file_department_name'];}
			
			if($this->input->post('court_bench') && $this->input->post('court_bench')!=''){ @$court_bench=$this->input->post('court_bench'); }
			else if($this->uri->segment(3)!=''){ @$court_bench=$file_detail[0]['court_bench_id'];}
			
			if($this->input->post('adivakta_name') && $this->input->post('adivakta_name')!=''){ @$adivakta_name=$this->input->post('adivakta_name'); }
			else if($this->uri->segment(3)!=''){ @$adivakta_name='';}
			
			if($file_type!='n'){ ?>
            <div class="form-group hide_for_notice">
                <label for="offer_by"><?php echo $this->lang->line('offer_by'); ?> <span class="text-danger">*</span> </label>
                <select class="form-control" name="file_offer_by" id="file_offer_by">
                    <option value=""><?php echo $this->lang->line('option_select_from'); ?></option>
                    <?php foreach(file_from_type() as $key => $value){ ?>
                        <option value="<?php echo $key ?>" <?php if (isset($file_offer_by) && $file_offer_by==$key ) { echo "selected";} ?>><?php echo $value ?></option>
                    <?php   } ?>
                </select>
                <?php echo form_error('file_offer_by');?>
            </div>
			<?php }else{ ?>
                 <div class="form-group hide_for_notice" style="display:none">
					<label for="offer_by"><?php echo $this->lang->line('offer_by'); ?> <span class="text-danger">*</span> </label>
					<select class="form-control" name="file_offer_by" id="file_offer_by">
						<option value=""><?php echo $this->lang->line('option_select_from'); ?></option>
						<?php foreach(file_from_type() as $key => $value){ ?>
							<option value="<?php echo $key ?>" <?php if (isset($file_offer_by) && $file_offer_by==$key) { echo "selected";} ?>><?php echo $value ?></option>
						<?php   } ?>
					</select>
					<?php echo form_error('file_offer_by');?>
				</div>
            <?php }?>
            <div class="form-group"  id="High_court_show" <?php if(isset($file_offer_by) && ($file_offer_by == 'm' || $file_offer_by == 'u')) { echo "style='display: block'"; } else { echo "style='display: none'";} ?>>
                <label for="High_court_bench"><?php echo $this->lang->line('High_court_bench'); ?> <span class="text-danger">*</span></label>
                <select class="form-control" name="court_bench" id="court_bench">
                    <option value=""><?php echo $this->lang->line('option_select_from'); ?></option>
                    <?php foreach(highcourt_bench() as $key => $value){ ?>
                        <option value="<?php echo $key ?>" <?php if (isset($court_bench) && $court_bench == $key) { echo "selected";} ?>><?php echo $value ?></option>
                    <?php  } ?>
                </select>
                <?php echo form_error('court_bench');?>
            </div>
            <div class="form-group" id="dept_id_show" <?php if( isset($file_offer_by) && ($file_offer_by=='v' || $file_offer_by== 'v')) { echo "style='display: block'"; } else { echo "style='display: none'";} ?>>
                <label for="file_department_id"><?php echo $this->lang->line('label_dept_name'); ?> <span class="text-danger">*</span></label>
                <select class="form-control" name="file_department_id" id="file_department_id">
                    <option value=""><?php echo $this->lang->line('option_select_dept'); ?></option>
                    <?php foreach($departments_list as $row){ ?>
                        <option value="<?php echo $row['dept_id']; ?>" <?php  if(isset($file_department_id) && $file_department_id ==$row['dept_id']){ echo 'selected';} ?>><?php echo $row['dept_name_en']." ".$row['dept_name_hi']; ?></option>
                    <?php } ?>
                    <option value="400"><?php echo $this->lang->line('option_other'); ?></option>
                </select>
                <?php echo form_error('file_department_id');?>
            </div>
            <div class="form-group" id="dist_id_show" <?php if( isset($file_offer_by) && ($file_offer_by=='c' || $file_offer_by== 'jvn')) { echo "style='display: block'"; } else { echo "style='display: none'";} ?>>
                <label for="district_id"><?php echo $this->lang->line('label_district_name'); ?> <span class="text-danger">*</span></label>
                <select class="form-control" name="district_id" id="district_id">
                    <option value=""><?php echo $this->lang->line('option_select_district'); ?></option>
                    <?php foreach($district_list as $row){ ?>
                        <option value="<?php echo $row['district_id']; ?>" <?php  if( isset($district_id) && $district_id==$row['district_id']){ echo 'selected';} ?>><?php echo $row['district_name_en'].", ".$row['district_name_hi']; ?></option>
                    <?php } ?>
                    <option value="400"><?php echo $this->lang->line('option_other'); ?></option>
                </select>
                <?php echo form_error('district_id');?>
            </div>
            <div class="form-group" id="state_id_show" <?php if(isset($file_offer_by) && $file_offer_by=='au') { echo "style='display: block'"; } else { echo "style='display: none'";} ?>>
                <label for="district_id"><?php echo $this->lang->line('label_state_name'); ?> <span class="text-danger">*</span></label>
                <select class="form-control" name="state_id" id="state_id">
                    <option value="">Select</option>
                    <?php foreach($state_list as $row){ ?>
                        <option value="<?php echo $row['state_id']; ?>" <?php  if(isset($state_id) && $state_id==$row['state_id']){ echo 'selected';} ?>><?php echo $row['state_name_en']." ".$row['state_name_hi']; ?></option>
                    <?php } ?>
                </select>
                <?php echo form_error('state_id');?>
            </div>
            <div class="form-group" id="suprem_court_show" <?php if(isset($file_offer_by) && $file_offer_by=='sc') { echo "style='display: block'"; } else { echo "style='display: none'";} ?>>
                <label for="suprem_court_show"><?php echo $this->lang->line('label_suprem_court'); ?> <span class="text-danger">*</span></label>
                <input type="text" name="suprem_court" id="suprem_court" value="<?php echo @$this->input->post('suprem_court') ? @$this->input->post('suprem_court') : 'Delhi , दिल्ली';  ?>"  class="form-control" disabled>
            </div>
			<div class="form-group delhi_advocate" style="display:none">
				<?php 
					$counselling_list = get_standing_counseller_name(null,null);
					//pre($counselling_list);
					foreach($counselling_list as $cname){
						$advocates[]=$cname['scm_name_hi']." (".$cname['scm_court_name'].' '.$cname['scm_post_hi'].")";
					}
				?>
				<label for="file_subject"><?php echo $this->lang->line('delhi_advocate_name'); ?></label>
				<select class="form-control" name="gov_adocate_delhi" id="gov_adocate_delhi">
					<option value=""><?php echo $this->lang->line('delhi_advocate_name'); ?></option>
					<?php foreach($counselling_list as $row){ ?>
						<option value="<?php echo $row['scm_name_hi']; ?>" <?php  if(isset($adivakta_name) && $adivakta_name==$row['scm_name_hi'] ){ echo 'selected';} ?>><?php echo $row['scm_name_hi']." (".$row['scm_court_name'].' '.$row['scm_post_hi'].")"; ?></option>
					<?php } ?>
				</select>
				<?php echo form_error('file_head');?>
			</div>
			<?php if($file_type!='n'){ ?>
				<div class="form-group hide_for_notice" id="dept_name_show1" >
					<label for="file_department_name" id="other_label"><?php echo $this->lang->line('more_detail'); ?></label>
					<input type="text" name="file_department_name" id="file_department_name" value="<?php echo @$file_department_name ? $file_department_name : false ?>" placeholder="<?php echo $this->lang->line('more_detail'); ?>" class="form-control">
					<?php echo form_error('file_department_name');?>
					<p class="form-helper other_hide" id="otherdept1" style="display:none" ><?php echo $this->lang->line('helper_dept_name'); ?></p>
				</div>
			<?php }else{ ?>
				<div class="form-group hide_for_notice" id="dept_name_show1" style="display:none" >
					<label for="file_department_name" id="other_label"><?php echo $this->lang->line('more_detail'); ?></label>
					<input type="text" name="file_department_name" id="file_department_name" value="<?php echo @$file_department_name ? $file_department_name : false ?>" placeholder="<?php echo $this->lang->line('more_detail'); ?>" class="form-control">
					<?php echo form_error('file_department_name');?>
					<p class="form-helper other_hide" id="otherdept1" style="display:none" ><?php echo $this->lang->line('helper_dept_name'); ?></p>
				</div>
			<?php } ?>
            <!--prastav end-->
            <?php $login_user_role_id = checkUserrole(); ?>
			<div class="form-group">
			  <label for="file_mark_section_id"  id="mark_section_id"><?php echo $this->lang->line('label_mark_section'); ?> <span class="text-danger">*</span></label>
                <?php 
			
				$mark_to_officer = get_officers_list(); //pre($mark_to_officer);?>
                <select class="form-control marktosc" required name="mark_file_section_id" id="mark_file_section_id" >
				
                        <option value="" id="select_t_s"><?php echo $this->lang->line('option_select_section'); ?></option>
                        <?php foreach($section_list as $row){ 
							
						
							?>  <option value="<?php echo $row['section_id']; ?>" class="sections" <?php  if(isset($mark_file_section_id) && $mark_file_section_id==$row['section_id'] ){ echo 'selected';} ?>><?php echo $row['section_name_en'].", ".$row['section_name_hi']; ?></option>
						<?php
						
						  } ?>
                </select>
                <?php echo form_error('file_mark_section_id');?>
                <input type="hidden" name="mark_unitid" id="mark_unitid" value="51">
			 </div>
			<!--<div class="form-group">
                <label for="from_id">File Upload (if any)</label>
                <input type="file" name="file_upload"/>
            </div>-->
            <div class="form-group text-center">
                <input type="checkbox" name="check_field" id="check_field">
                <label><?php echo $this->lang->line('check_field'); ?></label><?php echo form_error('check_field');?>
            </div>
            <div class="box-footer text-center">
                <button class="btn btn-primary margin" id="confirm_submit_btn" disabled type="submit"><?php echo $this->lang->line('button_submit'); ?></button>
                <button class="btn btn-danger margin" type="reset"><?php echo $this->lang->line('reset_btn'); ?></button>
            </div>
            <span class="text-danger"><?php echo $this->lang->line('m_note');?></span>
        </div>
    </div>
</div>
</div><!-- /.box-body -->
</form>
</div><!-- /.box -->
</div>
</section><!-- /.content -->
<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script type="text/javascript">
    $(function() {
        $('#file_type').change(function(){
          if($('#file_type').val() == 'n') {
			 $(".hide_for_notice").hide();
			 $("#dist_id_show").hide();
			 $("#High_court_show").hide();
			 $("#dept_id_show").hide();
			 $("#suprem_court_show").hide();
			 $(".delhi_advocate").hide();
			 $("#rti_file_fee").prop("required", false);
		  } else{
			$(".hide_for_notice").show();
			$("#rti_file_fee").prop("required", true);
		  }
        }) ;  
		$('#rti_frm').bind('submit', function() {
		   confir_sub();
		   return (valid) ? true : false;
		});
		var department_name = $('#file_department_name').val() ;
		if(department_name != ''){
			$('#rti_file_applicant_firm_name').val(department_name) ;
		}
    });
	
	function confir_sub(){
		$ret = confirm('कृपया सुनिश्चित करे की आप यह फाइल दर्ज करना चाहते हैं |');
		if($ret == true){
			  var $btn = $(this).button('loading');
              return true;
		}else{
              return false;
		}
	}
	
	$('#file_offer_by').change(function(){
        if($('#file_offer_by').val() == 'c' || $('#file_offer_by').val() == 'jvn'){
            $("#dist_id_show").show();
            $("#High_court_show, #dept_name_show , #suprem_court_show ,#dept_id_show,#state_id_show").hide();
			$(".delhi_advocate").hide();
            chenge_otherdepname();
        } else if($('#file_offer_by').val() == 'm' || $('#file_offer_by').val() == 'u'){
            $("#dist_id_show , #dept_id_show , #dept_name_show , #suprem_court_show,#state_id_show").hide();
            $("#High_court_show").show();
			$(".delhi_advocate").hide();
            chenge_otherdepname();
        } else if($('#file_offer_by').val() == 'au'){
            $("#dist_id_show , #dept_id_show , #dept_name_show , #suprem_court_show,#High_court_show").hide();
            $("#state_id_show").show();
			$(".delhi_advocate").hide();
        }else if($('#file_offer_by').val() == 'v'){
            $("#dept_name_show , #High_court_show , #suprem_court_show ,#dist_id_show,#state_id_show").hide();
            $("#dept_id_show").show();
			$(".delhi_advocate").hide();
            chenge_otherdepname();
        }else if($('#file_offer_by').val() == 'sc'){
            $("#dist_id_show , #dept_name_show , #High_court_show ,#dept_id_show,#state_id_show").hide();
            $("#suprem_court_show, .delhi_advocate").show();
            chenge_otherdepname();
        } else  {
            $("#dist_id_show , #dept_id_show , #High_court_show , #suprem_court_show,#state_id_show").hide();
			$(".delhi_advocate").hide();
            $("#dept_name_show").show();
            $("#other_label").text('विभाग का नाम');
            $("#file_department_name").attr('placeholder','विभाग का नाम');
        }
    });
	
	function chenge_otherdepname(){
        $("#other_label").text('अन्य नाम ');
        $("#file_department_name").attr('placeholder','अन्य नाम ');
    }
	
    $('#check_field').change(function(){
        
        if($('#check_field').is(':checked')){
            $("#confirm_submit_btn").prop("disabled", false);
        }else{
            $("#confirm_submit_btn").prop("disabled", true);
        }
    });
	
	 $('#check_field').change(function(){
		   });
</script>
