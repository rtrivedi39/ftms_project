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
				<form role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url()?>est_service_module/manage_service_permission/manage_work_allote<?php if(isset($id)){ echo '/'.$id;} ?>">
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
						<div class="col-md-4">          
							<?php echo $this->session->flashdata('message'); ?>
                            <div class="form-group">
                                <label>Search by unique code</label>
                            <input autocomplete="off" class="form-control" name="applicant_emp_code" id="applicant_emp_code" placeholder="एम्प्लोयी कोड">
</div>

							<div class="form-group">
								<label for="est_word_alloted_emp_id"><?php echo $this->lang->line('est_word_alloted_emp_id'); ?><span class="text-danger">*</span></label>
								<select name="est_word_alloted_emp_id" id="est_word_alloted_emp_id" class="form-control">
									<option value="">Select employee</option>
									<?php foreach($employees as $emp => $emp_details) { ?>
										<option value="<?php echo $emp_details['emp_id'].",".$emp_details['emp_unique_id']; ?>" <?php echo ((isset($alloted_work['est_word_alloted_emp_id']) && $alloted_work['est_word_alloted_emp_id'] == $emp_details['emp_id']) || (isset($form_input['est_word_alloted_emp_id']) && $form_input['est_word_alloted_emp_id'] == $emp_details['emp_id'])) ? 'selected' : '';  ?>><?php echo getemployeeName($emp_details['emp_id'], true).'/ '.getemployeeName($emp_details['emp_id']); ?></option>
									<?php } ?>
								</select>
								<?php echo form_error('est_word_alloted_emp_id');?>
								</div>

							<div class="form-group">
								<label for="est_word_alloted_work_id"><?php echo $this->lang->line('est_word_alloted_work_id'); ?><span class="text-danger">*</span></label>

								<?php $i = 1; foreach($category_detail as $cat => $cat_deatils) { ?>
								<div>
									<!--<input type="checkbox"  class='parent'  name="est_word_alloted_work_id[]"   value="<?php /*echo $cat_deatils['master_category_id'] ; */?>"
										<?php /*echo ((isset($alloted_work['est_word_alloted_work_id']) && in_array($cat_deatils['master_category_id'],explode(',',$alloted_work['est_word_alloted_work_id']))) || (isset($form_input['est_word_alloted_work_id']) && in_array($cat_deatils['master_category_id'],explode(',',$form_input['est_word_alloted_work_id'])))) ? 'checked' : '';  */?> >-->
										<b><?php echo $cat_deatils['category_title_hin'] ; ?></b>
									</input><br/>
									<?php foreach(get_child_categories($cat_deatils['master_category_id'] ,true) as $sub => $sub_deatils) { ?>
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
						</div><!-- /.col-6-->
						<div class="col-md-8">

<table id="example1" class="table table-bordered table-striped">
<thead>
<tr>
    <th>क्रमांक </th>
    <th>नाम</th>
    <th>परमिशन</th>
</tr>
</thead>
<tbody>
<?php
$i = 1;
foreach($user_per as $userpermission){ ?>
<tr>
    <td><?php echo $i ; ?></td>
    <td><?php echo $userpermission['emp_title_hi'] ; ?> <?php echo $userpermission['emp_full_name_hi'] ; ?></td>
    <td><?php echo $userpermission['mst_name'] ; ?></td>
</tr>
<?php $i++ ; } ?>
</table>
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
<script>
    $(document).ready(function(){
        $("#applicant_emp_code").keyup(function(){
            var emp_unique_code = $(this).val();
            var HTTP_PATH='<?php echo base_url(); ?>';
            $.ajax({
                type: "POST",
                url: HTTP_PATH + "establishment/getemployee_emp_code_notesheet_2",
                data:{ emp_unique_code : emp_unique_code } ,
                success: function(data){
                    if(data){
                        var r_data = JSON.parse(data);
                        var otpt = '';
                        $.each(r_data, function( index, value ) {
                            otpt += '<option value="'+value.emp_id+','+value.emp_unique_id+'">'+value.emp_title_hi+' '+value.emp_full_name_hi+' ('+value.emprole_name_hi+')</option>';
                        });
                        $("#est_word_alloted_emp_id").html(otpt);
                    }
                }
            });
        });
    });
</script>


    