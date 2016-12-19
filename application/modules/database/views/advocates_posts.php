<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo $title; ?>
      <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url('admin'); ?>/sections">Employees</a></li>
        <li class="active"><?php echo $page_title; ?></li>
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
                    <div style="float:left"><h3 class="box-title"><?php echo $page_title; ?></h3></div>
                    <?php   if ($is_page_edit == 0) { ?>
                        <div style="float:right">
                            <a href="<?php echo base_url('admin'); ?>/add_employee">
                                <button class="btn btn-block btn-info"><?php echo $this->lang->line('add_button'); ?></button>
                            </a>
                        </div>
                    <?php } ?>
                    <div style="float:right;margin-right: 10px;">
                        <a href="javascript:history.go(-1)">
                            <button class="btn btn-block btn-warning"><?php echo $this->lang->line('Back_button_label'); ?></button>
                        </a>
                    </div>

                </div><!-- /.box-header -->
                <?php echo $this->session->flashdata('message'); //pre($this->input->post()); pre($emp_detail); pre($emp_more_detail); ?>
                <form role="form" method="post" action="<?php echo base_url() ?>advocates/advocates_posts/manage_advocate_post<?php if (isset($id)) {
                    echo '/' . $id;
                } ?>">
				
                    <div class="col-md-6">
                        <div class="box box-primary" style="margin-top: 15px;">
                            <div class="box-body">
								<div class="form-group">
									<label><?php echo $this->lang->line('advocate_post_id_label'); ?><span class="text-danger">*</span>:</label>
									<?php  $selected  = '' ;
									if(isset($advocate_details['advocate_type'])){
										 $selected  = $advocate_details['advocate_type'] ;
									} else if($this->input->post('advocate_post_type')){
										 $selected  = $this->input->post('advocate_post_type') ;
									} ?>
									<?php echo get_advocate_posttype_ddl_list('advocate_post_type', 'class="form-control"',$selected ); ?>
									<?php echo form_error('advocate_post_type'); ?>
								</div>
							
								<div class="form-group">
									<label><?php echo 'स्वीकृत '.$this->lang->line('adv_designation_label'); ?><span class="text-danger">*</span>:</label>
									<input type="number" class="form-control" name="approved_posts" value="<?php echo isset($advocate_details['approved_posts'])? $advocate_details['approved_posts']:$this->input->post('approved_posts')?>">
									<?php echo form_error('approved_posts'); ?>
								</div>
								<!--<div class="form-group">
									<label><?php //echo $this->lang->line('adv_full_post_label'); ?>:</label>
									<input type="number" min="0" onchange="field_post();" class="form-control" name="filled_posts" value="<?php //echo isset($advocate_details['filled_posts'])? $advocate_details['filled_posts']:$this->input->post('filled_posts')?>">
									
								</div>-->
								<!-- <div class="form-group">
									<label><?php //echo $this->lang->line('adv_vacancies_label'); ?>:</label>
									<input type="number" onchange="validate_vacant_seats();" class="form-control" name="vacant_seats" value="<?php //echo isset($advocate_details['vacant_seats'])? $advocate_details['vacant_seats']:$this->input->post('vacant_seats')?>">
								
								</div>-->
								<div class="form-group">
									<label><?php echo $this->lang->line('adv_state_label'); ?><span class="text-danger">*</span>:</label>
									<?php  $selected  = '' ;
									if(isset($advocate_details['state_id'])){
										 $selected  = $advocate_details['state_id'] ;
									}else if($this->input->post('state_id')){
										 $selected  = $this->input->post('state_id') ;
									}else{
										 $from_district  = 14 ;
									} ?>
									<?php echo get_state_ddl_list('state_id', ' class="form-control"',$selected, @$from_district );  ?>
									<?php echo form_error('state_id'); ?>
								</div>
								<div class="form-group">
									<label><?php echo $this->lang->line('adv_district_label'); ?><span class="text-danger">*</span> :</label>
									<?php  $selected  = '' ;
									if(isset($advocate_details['district_id'])){
										 $selected  = $advocate_details['district_id'] ;
									}else if($this->input->post('scm_district_id')){
										 $selected  = $this->input->post('scm_district_id') ;
									} ?>
									<?php echo  get_distic_ddl_list('scm_district_id', 'id="district_id"  class="form-control"', $selected); ?>
									<?php echo form_error('scm_district_id'); ?>
								</div>
								<div class="form-group">
									<label><?php echo $this->lang->line('adv_tahsil_label'); ?>:</label>
									<?php  $selected  = '' ;
									if(isset($advocate_details['tahsil_id'])){
										 $selected  = $advocate_details['tahsil_id'] ;
									}else if($this->input->post('scm_tahsil_id')){
										 $selected  = $this->input->post('scm_tahsil_id') ;
									} ?>
									<?php 
										echo get_tahsil_ddl_list('scm_tahsil_id',  'id="tahsil_id" class="form-control tahsil_list"  ',$selected ,@$advocate_details['district_id']); ?>
									<div id="tahsil_div"></div>
									
									<?php echo form_error('scm_tahsil_id'); ?>
								</div>
								
								<div class="form-group">
									<label><?php echo $this->lang->line('adv_taluka_label'); ?> :</label>
									<?php  $selected  = '' ;
									if(isset($advocate_details['taluka_id'])){
										 $selected  = $advocate_details['taluka_id'] ;
									}else if($this->input->post('scm_taluka_id')){
										 $selected  = $this->input->post('scm_taluka_id') ;
									} ?>
									<?php 
										echo  get_taluka_ddl_list('scm_taluka_id' , 'id="taluka_id" class="form-control taluka_list" ',$selected ,@$advocate_details['district_id']); ?>
									<div id="taluka_div"></div>
								</div>
								<div class="box-footer">
									<button type="submit" onclick="return confir_post_data();" class="btn btn-primary">जमा करें</button>
								</div>
							</div>
                        </div><!-- /.box -->
                    </div>
                    </form>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div><!-- /.row -->
<!-- Main row -->
</section><!-- /.content -->
<?php $this->load->view('advocates_js'); ?>
<script>
	function field_post(){	
       var approved_posts = $("input[name=approved_posts]").val();
       var filled_posts = $("input[name=filled_posts]").val();
       if(filled_posts>approved_posts){
	       alert(' भरे पद की संख्या, स्वीकृत पद से ज्यादा नहीं हो सकती ? ');
	       $("input[name=filled_posts]").val('');
	       $("input[name=filled_posts]").focus();
	       return false;
		}
	}
	function validate_vacant_seats(){	
       var approved_posts = $("input[name=approved_posts]").val();
	   var filled_posts = $("input[name=filled_posts]").val();
       var vacant_seats = $("input[name=vacant_seats]").val();
       var total_vacant_post = parseInt(filled_posts) + parseInt(vacant_seats);
       if(total_vacant_post>approved_posts){
	       alert(' रिक्त पद की संख्या, स्वीकृत पद से ज्यादा नहीं हो सकती ? ');
	       $("input[name=vacant_seats]").val('');
	       $("input[name=vacant_seats]").focus();
	       return false;
		}
	}
</script>