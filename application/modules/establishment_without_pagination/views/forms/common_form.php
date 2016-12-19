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
			<div class="box box-primary">
			<!-- form start -->
			<form role="form" method="post" action="<?php echo base_url()?>establishment/est_files/manage_files<?php if(isset($id)){ echo '/'.$id;} ?>"  enctype="multipart/form-data">
				<div class="box-header">
				   <h3 class="box-title"><?php echo $title_tab;?></h3>
					<div class="box-tools pull-right">
						<?php if(isset($is_page_edit)){ ?>
							<a href="<?php echo base_url('establishment');?>/forms">
								<button class="btn  btn-info">नई फाइल जोड़े</button>
							</a>
						<?php } ?>
						<button class="btn btn-warning" title="Back" onclick="goBack()" ><?php echo $this->lang->line('Back_button_label'); ?></button>
					</div>
				</div><!-- /.box-header -->
				<div class="box-body">
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
						<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" >
						<input type="hidden" name="file_mark_section_id" id="file_mark_section_id" value="7" >
						<input type="hidden" name="category_id" id="category_id" value="<?php echo $this->uri->segment(3); ?>" >
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="file_type"><?php echo $this->lang->line('label_file_type'); ?></label> <span class="text-danger">*</span></label>
									<select class="form-control" name="file_type" id="file_type">
									  <?php foreach(est_file_types() as $key => $value){ ?>
										<option value="<?php echo $key ; ?>" <?php echo (isset($file_data) && $file_data[0]['file_type'] == $key) ? 'selected' : '' ;?>><?php echo $value ; ?></option>
									  <?php } ?>				  
									</select>
									<?php echo form_error('file_type');?>
								</div>
								<div class="form-group">
									<label for="subject"><?php echo $this->lang->line('label_subject'); ?></label> <span class="text-danger">*</span></label>
									<textarea name="file_subject" id="file_subject" class="form-control"><?php echo (isset($file_data) && $file_data[0]['file_subject'] != '') ? $file_data[0]['file_subject'] : '' ;?></textarea>
									<?php echo form_error('emp_id');?>
								</div>
								<div class="form-group">
									<label for="discription"><?php echo $this->lang->line('label_file_discription'); ?></label> <span class="text-danger">*</span></label>
									<textarea name="file_discription" id="file_discription" class="form-control"><?php echo (isset($file_data) && $file_data[0]['file_description'] != '') ? $file_data[0]['file_description'] : '' ;?></textarea>
									<?php echo form_error('file_discription');?>
								</div>
								<?php $est_so = get_section_employee(7,8) ;
								if($est_so[0]->emp_id == emp_session_id() && $is_page_edit == false){ ?>
									<div class="form-group"  >
										<label for="medical_type"><?php echo $this->lang->line('label_file_mark') ?></label>
									</div>
									
									<div class="form-group "  >
										<div class="radio col-md-5" style="margin-top:-5px;">
											<label>
											  <input type="radio" onclick="mark_file('own');" name="file_mark" id="own_mark" value="own" checked="">
											  <?php echo $this->lang->line('label_file_self_mark') ?>
											</label>
										</div>
										<div class="radio  col-md-5">
											<label>
											  <input type="radio" onclick="mark_file('other');" name="file_mark" id="other_mark" value="option1" checked="">
											  <?php echo $this->lang->line('label_file_other_mark') ?>
											</label>
										</div>
									</div>
									
									<div style="clear:both"></div>
									
									<div class="form-group other_list_emp">
										<label for="est_emp_list"><?php echo $this->lang->line('label_file_other_mark'); ?></label> <span class="text-danger">*</span></label>
										<?php $employees  = get_establishment_employees(); ?>
										<select name="est_emp_id"class="form-control">
											<option value="">Select employee</option>
											<?php foreach($employees as $emp => $emp_details) { ?>
												<option value="<?php echo $emp_details['emp_id']; ?>" <?php echo ((isset($alloted_work['est_word_alloted_emp_id']) && $alloted_work['est_word_alloted_emp_id'] == $emp_details['emp_id']) || (isset($form_input['est_word_alloted_emp_id']) && $form_input['est_word_alloted_emp_id'] == $emp_details['emp_id'])) ? 'selected' : '';  ?>><?php echo getemployeeName($emp_details['emp_id'], true).'/ '.getemployeeName($emp_details['emp_id']); ?></option>
											<?php } ?>
										</select>
									
									
										<?php echo form_error('est_emp_list');?>
									</div>
								<?php } ?>
								<br>
								<input type="hidden" name="section_file_page" value="<?php echo $this->uri->segment('3'); ?>" />
								<div class="box-footer text-center">
									<button class="btn btn-primary margin" id="submit_btn" onclick="return confirm_generate()" type="submit"><?php echo $this->lang->line('button_submit'); ?></button>
									<button class="btn btn-danger margin" type="reset"><?php echo $this->lang->line('reset_btn'); ?></button>
								</div>
							</div><!-- /.column 6 -->
						</div><!-- /row -->
				</div><!-- /.box-body -->
			</form>
			</div><!-- /.box -->
		</div><!-- /.column 12 -->
	</div><!-- /row -->
</section><!-- /.content -->
<?php $this->load->view('view_footer_script'); ?>