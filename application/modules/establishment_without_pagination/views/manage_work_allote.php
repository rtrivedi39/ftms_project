<style>
.parent{
	
}
.child{
	
}
</style>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo $title; ?>
        <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo $page_title; ?></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Your Page Content Here -->
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
				<form role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url()?>establishment/est_master_category/manage_work_allote<?php if(isset($id)){ echo '/'.$id;} ?>">
					<div class="box-header">
						<div style="float:left"><h3 class="box-title"><?php echo $page_title;?></h3></div>
						<?php
						if($is_page_edit == 0){ ?>
							<div style="float:right;padding-left: 10px;">
								<a href="<?php echo base_url('establishment');?>/add_work">
									<button type="button" class="btn btn-block btn-info"><?php echo $this->lang->line('add_button'); ?></button>
								</a>
							</div>
						<?php } ?>
						<div style="float:right;">
							<a href="javascript:history.go(-1)">
								<button class="btn btn-block btn-warning" type="button"><?php echo $this->lang->line('Back_button_label'); ?></button>
							</a>
						</div>
					</div><!-- /.box-header -->		
					<div class="box-body">	
						<div class="col-md-6">          
							<?php echo $this->session->flashdata('message'); ?>					   
							<div class="form-group">
								<label for="est_word_alloted_emp_id"><?php echo $this->lang->line('est_word_alloted_emp_id'); ?><span class="text-danger">*</span></label>
								<select name="est_word_alloted_emp_id"class="form-control">
									<option value="">Select employee</option>
									<?php foreach($employees as $emp => $emp_details) { ?>
										<option value="<?php echo $emp_details['emp_id']; ?>" <?php echo ((isset($alloted_work['est_word_alloted_emp_id']) && $alloted_work['est_word_alloted_emp_id'] == $emp_details['emp_id']) || (isset($form_input['est_word_alloted_emp_id']) && $form_input['est_word_alloted_emp_id'] == $emp_details['emp_id'])) ? 'selected' : '';  ?>><?php echo getemployeeName($emp_details['emp_id'], true).'/ '.getemployeeName($emp_details['emp_id']); ?></option>
									<?php } ?>
								</select>
								<?php echo form_error('est_word_alloted_emp_id');?>
							</div>

							<div class="form-group">
								<label for="est_word_alloted_work_id"><?php echo $this->lang->line('est_word_alloted_work_id'); ?><span class="text-danger">*</span></label>
								<?php /* foreach($category_detail as $cat => $cat_deatils) { ?>
									<div class="checkbox">
									  <label>
										<input type="checkbox" name="est_word_alloted_work_id[]" id="est_word_alloted_work_id"  value="<?php echo $cat_deatils['master_category_id'] ; ?>" 
										<?php echo ((isset($alloted_work['est_word_alloted_work_id']) && in_array($cat_deatils['master_category_id'],explode(',',$alloted_work['est_word_alloted_work_id']))) || (isset($form_input['est_word_alloted_work_id']) && in_array($cat_deatils['master_category_id'],explode(',',$form_input['est_word_alloted_work_id'])))) ? 'checked' : '';  ?>>
										<?php echo $cat_deatils['category_title_hin'] ; ?>
									  </label>
									</div>
								<?php } */ ?>
								
								<?php $i = 1; foreach($category_detail as $cat => $cat_deatils) { ?>
								<div>
									<input type="checkbox"  class='parent'  name="est_word_alloted_work_id[]"   value="<?php echo $cat_deatils['master_category_id'] ; ?>" 
										<?php echo ((isset($alloted_work['est_word_alloted_work_id']) && in_array($cat_deatils['master_category_id'],explode(',',$alloted_work['est_word_alloted_work_id']))) || (isset($form_input['est_word_alloted_work_id']) && in_array($cat_deatils['master_category_id'],explode(',',$form_input['est_word_alloted_work_id'])))) ? 'checked' : '';  ?>>
										<b><?php echo $cat_deatils['category_title_hin'] ; ?></b>
									</input><br/>
									<?php foreach(get_child_categories($cat_deatils['master_category_id']) as $sub => $sub_deatils) { ?>	
										<input type="checkbox"  class='child'  name="est_word_alloted_work_id[]"   value="<?php echo $sub_deatils['master_category_id'] ; ?>" 
											<?php echo ((isset($alloted_work['est_word_alloted_work_id']) && in_array($sub_deatils['master_category_id'],explode(',',$alloted_work['est_word_alloted_work_id']))) || (isset($form_input['est_word_alloted_work_id']) && in_array($sub_deatils['master_category_id'],explode(',',$form_input['est_word_alloted_work_id'])))) ? 'checked' : '';  ?>>
											<?php echo $sub_deatils['category_title_hin'] ; ?>
										</input>
									<?php } ?>
								</div>
								<hr/>
								<?php $i++; } ?>	
								<?php echo form_error('est_word_alloted_work_id');?>
							</div>
							<div class="form-group">
								<label for="est_word_alloted_comment"><?php echo $this->lang->line('est_word_alloted_comment'); ?></label>
								<textarea name="est_word_alloted_comment" id="est_word_alloted_comment" class="form-control"><?php echo (isset($form_input['est_word_alloted_comment']) || isset($alloted_work['est_word_alloted_comment'])) ?  $form_input['est_word_alloted_comment'].''.$alloted_work['est_word_alloted_comment'] : '';  ?></textarea>
								<?php echo form_error('est_word_alloted_comment');?>
							</div>
						</div><!-- /.col-6-->
					</div><!-- /.box body -->
					 <div class="box-footer">
						<button class="btn btn-primary" type="submit" name="btnwork" id="btnwork" value="1"><?php echo $this->lang->line('submit_botton'); ?></button>
					</div>							
				</form>
            </div><!-- /.box -->
        </div><!-- /.col-12 -->
    </div><!-- /.row -->
    <!-- Main row -->
</section><!-- /.content -->
<?php $this->load->view('view_footer_script'); ?>
<?php //pr($alloted_work['est_word_alloted_work_id']); ?>

    