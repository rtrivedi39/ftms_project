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
    if(isset($is_page_edit)){ ?>
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

<form role="form" method="post" action="<?php echo base_url()?>establishment/est_files/manage_files<?php if(isset($id)){ echo '/'.$id;} ?>"  enctype="multipart/form-data">
<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" >
  <input type="hidden" name="file_mark_section_id" id="file_mark_section_id" value="7" >
  <input type="hidden" name="category_id" id="category_id" value="<?php echo $this->uri->segment(3); ?>" >
<div class="col-md-6">
    <div class="box box-primary">
        <div class="box-body">
		
			<div class="form-group">
                <label for="subject"><?php echo $this->lang->line('label_subject'); ?></label> <span class="text-danger">*</span></label>
				<textarea name="file_subject" id="file_subject" class="form-control"></textarea>
                <?php echo form_error('emp_id');?>
            </div>
			
			<div class="form-group">
                <label for="employee_name"><?php echo $this->lang->line('label_emp_name'); ?></label> <span class="text-danger">*</span></label>
                 <?php echo get_employee_name_dd('employee_id' , $attr = 'class="form-control"', ''); ?>
                <?php echo form_error('emp_id');?>
            </div>
			
			<!--Dropdown-->
            <div class="form-group" >
                <label for="file_type"><?php echo $this->lang->line('label_employee_ac_no'); ?></label> <span class="text-danger">*</span></label>
                 <input type="text" name="employee_ac_no"  value="" placeholder="<?php echo $this->lang->line('employee_ac_no'); ?>" class="form-control">
				
			
                <?php echo form_error('employee_ac_no');?>
            </div>
            <!--End Dropdown-->
			
			<div class="form-group"  >
                <label for="file_Bank_balance"><?php echo $this->lang->line('label_existing_amount') ?></label>
                <input type="text" name="existing_amount"  value="" placeholder="<?php echo $this->lang->line('label_existing_amount'); ?>" class="form-control">
               
            </div>

            <div class="form-group">
                <label for="file_amount_want" ><?php echo $this->lang->line('label_want_amount') ; ?>
                </label></label>
                <input type="text" name="amount_want" id="amount_want"  value="<?php if ($this->input->post('amount_want')){ echo $this->input->post('amount_want');}  ?>" placeholder="<?php echo $this->lang->line('label_want_amount'); ?>" class="form-control date1">
                
            </div>
			
			<div class="form-group">
                <label for="file_amount_want" ><?php echo $this->lang->line('label_laws') ; ?>
                </label></label>
                <input type="text" name="laws" id="laws"  value="<?php if ($this->input->post('laws')){ echo $this->input->post('laws');}  ?>" placeholder="<?php echo $this->lang->line('label_laws'); ?>" class="form-control date1">
                
            </div>
			<?php $est_so = get_section_employee(7,8) ;
			if($est_so[0]->emp_id == emp_session_id()){ ?>
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
						<option value="<?php echo $emp_details['emp_id']; ?>" <?php echo ((isset($alloted_work['est_word_alloted_emp_id']) && $alloted_work['est_word_alloted_emp_id'] == $emp_details['emp_id']) || (isset($form_input['est_word_alloted_emp_id']) && $form_input['est_word_alloted_emp_id'] == $emp_details['emp_id'])) ? 'selected' : '';  ?>><?php echo $emp_details['emp_full_name_hi'].'/ '.$emp_details['emp_full_name']; ?></option>
					<?php } ?>
				</select>
			
			
                <?php echo form_error('est_emp_list');?>
            </div>
			<?php } ?>
			<br>
			 <div class="box-footer text-center">
                <button class="btn btn-primary margin" id="submit_btn" onclick="return confirm_generate()" type="submit"><?php echo $this->lang->line('button_submit'); ?></button>
                <button class="btn btn-danger margin" type="reset"><?php echo $this->lang->line('reset_btn'); ?></button>
            </div>
        </div>
    </div>
</div>

</div><!-- /.box-body -->
</form>
</div><!-- /.box -->
</div>
</section><!-- /.content -->
<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="<?php echo base_url(); ?>theams/establishment.js"></script>