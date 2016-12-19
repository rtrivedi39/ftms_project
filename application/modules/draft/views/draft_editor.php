 <?php $year = $this->input->get('year') != '' ? $this->input->get('year') : date('Y'); 
//pr($draft_data);
 ?>
 <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           <?php echo $title; ?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><?php echo $title; ?></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
		  <div class="col-xs-12">
				<div class="box box-primary box-solid">				
					<div class="box-header">
						<i class="fa fa-th"></i><h3 class="box-title">विकल्प</h3>  
						<div class="box-tools pull-right">
							<button data-widget="collapse" class="btn bg-primary btn-sm"><i class="fa fa-minus"></i></button>
						</div>				
					</div><!-- /.box-header -->
					<div class="box-body">
						<div class="row">
							<div class="col-xs-2">
								<a href="<?php echo base_url();?>draft/draft" class="btn btn-primary"></i> इनबॉक्स पर जाए</a>
							</div>
							<div class="col-xs-2">
								<a href="<?php echo base_url();?>draft/draft/send_draft" class="btn btn-primary"></i> भेजे गए पर जाए</a>
							</div>
							<div class="col-xs-2">
								<a href="<?php echo base_url();?>draft/draft/draft_viewer/<?php echo $this->uri->segment('4'); ?>" class="btn btn-warning"></i> ड्राफ्ट पर जाए</a>
							</div>
							<div class="col-xs-2">
							</div>
							<div class="col-xs-2">
							</div>
						</div>
					</div>
				</div>
			</div>
            <div class="col-md-12">			
				<form method="post" name="save_draft" action="<?php echo base_url(); ?>draft/draft/<?php echo (isset($reopen) && $reopen == true ) ? 'save_draft' : 'save_edit_draft' ;?>/<?php echo $draft_data['draft_id']; ?>">
				  <div class="box box-primary">
					<div class="box-header with-border">
					  <h3 class="box-title"><?php echo $sub_title; ?></h3>
					  <div class="box-tools pull-right">
						<button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
					  </div>
					</div><!-- /.box-header -->
					<div class="box-body">
					  <div class="form-group">
						<label>ड्राफ्ट किसको भेजना है</label>
						<select name="sender_id" class="form-control">
							<?php  $senior_id = get_user_supervisor();
								  $super_visor = !empty($senior_id[0]->emp_id) ?  $senior_id[0]->emp_id : '';
							$employees  = get_list(EMPLOYEES, "role_id ASC, emp_full_name_hi ASC", "emp_status = '1' and emp_is_retired = '0' and emp_is_parmanent = '1' and role_id BETWEEN 3 AND 27 ",'');
							foreach($employees as $key => $value){ ?>
								<option value="<?php echo $value['emp_id']; ?>" <?php echo $value['emp_id'] == $super_visor ? 'selected' : '';  ?>><?php echo $value['emp_full_name']; ?> (<?php echo $value['emp_full_name_hi']; ?> - <?php echo get_employee_role($value['emp_id']); ?>)</option>
							<?php } ?>
						</select>
					  </div>
					  <div class="form-group">
						<label>ड्राफ्ट का प्रकार</label>
						<select name="draft_type" class="form-control">
							<?php foreach(draft_type() as $key => $value){ ?>
								<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
							<?php } ?>
						</select>
					  </div>
					  <div class="form-group">
						<label>ड्राफ्ट का विषय</label>
						<textarea  name="draft_subject" class="form-control" style="height:75px"><?php echo isset($draft_data['draft_subject']) ? $draft_data['draft_subject'] : ''; ?></textarea>
					  </div>
					  <div class="form-group">
						<label>ड्राफ्ट का </label>
						<?php $content = isset($draft_data['draft_content_text']) ? $draft_data['draft_content_text'] : ''; 
						
						?>
						<textarea id="compose-textarea" name="draft_content_text" class="form-control" style="height: 500px"><?php echo $content; ?></textarea>
					  </div>					 				
					 
					</div><!-- /.box-body -->
					<div class="box-footer">
					  <div class="pull-right">
						<input type="hidden" name="file_id" value ="<?php echo isset($draft_data['file_id']) ? $draft_data['file_id'] : ''; ?>" >
						<button type="submit" name="btnadddraft" value="add_draft" onClick="return confirm('कृपया सुनिश्चित कर ले की आप ड्राफ्ट पुनः एडिट के किये सहेज रहे है');" class="btn btn-primary"><i class="fa fa-pencil"></i> ड्राफ्ट जोड़े</button>
						<button type="submit" name="btnadddraft" value="send_draft" onClick="return confirm('कृपया सुनिश्चित कर ले की आप ड्राफ्ट को भेज रहे है');" class="btn btn-success"><i class="fa fa-envelope-o"></i> भेजे</button>
					  </div>
					  <a href="<?php echo base_url();?>draft/draft" class="btn btn-danger"><i class="fa fa-times"></i> रद्द करे</a>
					</div><!-- /.box-footer -->
				  </div><!-- /. box -->
				</form>
				
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
		<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- 
	Include the WYSIWYG javascript files
-->
<script type="text/javascript" src="<?php echo base_url()?>themes/ckeditor/ckeditor.js"></script>
<!-- 
	Attach the editor on the textareas
-->
<script type="text/javascript">
	 CKEDITOR.replace('compose-textarea');
	 
	 $(document).ready(function(){	
		$("#compose-textarea").keyup(function(){
			$(this).css("background-color", "pink");
		});
	});

</script>