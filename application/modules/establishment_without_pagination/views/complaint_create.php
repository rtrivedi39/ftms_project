<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo $title; ?>
        <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo $title_tab; ?></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Your Page Content Here -->
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
				<form role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url()?>establishment/complaint/add_complaint/<?php if(isset($id)){ echo '/'.$id;} ?>">
					<div class="box-header">
						<h3 class="box-title"><?php echo $title_tab;?></h3>
						<div class="box-tools pull-right">
							<a href="<?php echo base_url('establishment'); ?>/complaints">
								<button class="btn  btn-primary" type="button">किये हुए आवेदन</button>
							</a>
							<a href="javascript:history.go(-1)">
								<button class="btn btn-warning" type="button"><?php echo $this->lang->line('Back_button_label'); ?></button>
							</a>
							
						</div>
					</div><!-- /.box-header -->		
					<div class="box-body">	
						<div class="col-md-6">      
									   
							<div class="form-group">
								<label for="complaint_type"><?php echo $this->lang->line('complaint_type'); ?><span class="text-danger">*</span></label>
								<select name="complaint_type" id="complaint_type" class="form-control">
									<option value="">Select application type</option>
									<?php foreach(complaint_type('',1,true) as $key => $value) { ?>
										<option value="<?php echo $value['master_category_id']; ?>" <?php echo (isset($form_input['complaint_type']) && $form_input['complaint_type'] == $value['master_category_id']) ? 'selected' : '';  ?>><?php echo $value['category_title_hin']; ?></option>
									<?php } ?>
								</select>
								<?php echo form_error('complaint_type');?>
							</div>

							<div class="form-group">
								<label for="complaint_subtype"><?php echo $this->lang->line('complaint_subtype'); ?><span class="text-danger">*</span></label>
								<select class="form-control" name="complaint_subtype" id="complaint_subtype" required>
									<option value="">Select sub type</option>
								</select>

								<?php echo form_error('complaint_subtype');?>
							</div>

							<div class="form-group">
								<label for="complaint_subject"><?php echo $this->lang->line('complaint_subject'); ?><span class="text-danger">*</span></label>
									<textarea name="complaint_subject" class="form-control"><?php echo (isset($form_input['complaint_subject'])) ?  $form_input['complaint_subject']: '';  ?></textarea>
								<?php echo form_error('complaint_subject');?>
							</div>
							<div class="form-group">
								<label for="complaint_containts"><?php echo $this->lang->line('complaint_containts'); ?><span class="text-danger">*</span></label>
								<textarea name="complaint_containts" id="complaint_containts" class="form-control"><?php echo (isset($form_input['complaint_containts'])) ?  $form_input['complaint_containts']: '';  ?></textarea>
								<?php echo form_error('complaint_containts');?>
							</div>
							<?php if(check_est_emplyee()) { ?>
							<div class="form-group">
								<label for="complaint_for_emp"><?php echo $this->lang->line('complaint_for_emp'); ?><span class="text-danger">*</span></label>
								<select name="complaint_for_emp" id="complaint_for_emp" class="form-control">
									<option value="">Select application employee</option>
									<?php $complaint_for_emplyees = get_list(EMPLOYEES, 'emp_full_name_hi', array('emp_status' => '1' , 'emp_is_retired' => '0'), 'ASC');
									foreach($complaint_for_emplyees as $key => $value) { ?>
										<option value="<?php echo $value['emp_id']; ?>" <?php echo ((isset($form_input['complaint_for_emp']) && $form_input['complaint_for_emp'] == $value['emp_id']) || $value['emp_id'] == emp_session_id()) ? 'selected' : '';  ?>><?php echo getemployeeName($value['emp_id'], true); ?> - <?php echo get_employee_role($value['emp_id'], true); ?></option>
									<?php } ?>
								</select>
								<?php echo form_error('complaint_for_emp');?>
							</div>
							<?php } ?>
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

<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script type="text/javascript">
    $(function () {
        
        $("#complaint_type").change(function () {
            var prnt_id = $(this).val();
            var HTTP_PATH = '<?php echo base_url(); ?>';
            $.ajax({
                type: "POST",
                url: HTTP_PATH + "establishment/complaint/ajax_get_category/"+prnt_id,
                datatype: "json",
                async: false,
                data: {prnt_id: prnt_id},				
                success: function(data) {
					console.log(prnt_id);
                    var r_data = JSON.parse(data);
                    var otpt = '<option value="">Select sub type category</option>';
                    $.each(r_data, function( index, value ) {
                        otpt += '<option value="'+value.master_category_id+'">'+value.category_title_hin+'</option>';
                    });
						 //otpt += '<option value="other">अन्य</option>';
                    $("#complaint_subtype").html(otpt);
                }
            });
        });
	});
</script>


