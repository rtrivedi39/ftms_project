 <?php $year = $this->input->get('year') != '' ? $this->input->get('year') : date('Y'); 
 $can_add = true; ?>
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
            <div class="col-md-3">
              <a href="<?php echo base_url();?>draft/draft" class="btn btn-primary btn-block margin-bottom">इनबॉक्स पर जाये</a>
              <?php $this->load->view('draft_sidebar'); ?>
            </div><!-- /.col -->
            <div class="col-md-9">
				<form method="post" name="save_draft" action="<?php echo base_url(); ?>draft/draft/search_file">
				  <div class="box box-primary">
					<div class="box-header with-border">
					  <h3 class="box-title">जिस फाइल पर आपको ड्राफ्ट जोड़ना है उसे खोजे</h3>
					</div><!-- /.box-header -->
					<div class="box-body">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" class="form-control" name="search_value" placeholder="पंजी नंबर" value="<?php echo @$this->input->post('search_value') != '' ? @$this->input->post('search_value') : ''?>"/>
								<?php echo form_error('search_value'); ?>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<select name="sections_all" id="" class="form-control">
									<option value="">सेक्शन का चयन करें</option>
									<?php $empssection = empdetails(emp_session_id());
									foreach(explode(",",$empssection[0]['emp_section_id'])  as $empsec){ ?>
										<option value="<?php echo $empsec ?>" <?php echo @$this->input->post('sections_all') == $empsec ? "selected" : false?>><?php echo getSection($empsec) ; ?></option>
									<?php  }?>
									<option value="1">आवक</option>
								</select>
								
								
								<?php echo form_error('sections_all'); ?>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<select class="form-control pull-right" name="year_select" id="year_select">
									<?php $i = '2015'; while($i <= date('Y')) { ?>
										<option value="<?php echo $i ; ?>" <?php echo $year == $i ? 'selected' : ''; ?>><?php echo $i ;?></option>
									<?php $i++; } ?>
								</select>
								<?php echo form_error('year_select'); ?>
							</div>
						</div>
					</div>
					<?php if($search_file == true){  ?>
					<?php if(isset($file_data) && $file_data != ''){						
								if($file_data['0']['file_received_emp_id'] == emp_session_id() && ($file_data['0']['file_hardcopy_status'] == 'received' || $file_data['0']['file_hardcopy_status'] == 'working')){
								$can_add = true;
								?>
									<table class="table table-hover table-striped">
									<tr>
										<th>No.</th>
										<th>पंजी नंबर</th>
										<th>विषय</th>
										<th>कार्यवाही</th>
									</tr>
									<?php $i =1 ; foreach($file_data as $file) { ?>
									<tr>
										<th><?php echo $i; ?></th>
										<th><?php echo get_panji_no($file['file_id'],$file['file_mark_section_id'],$file['file_created_date']); ?></th>
										<th><?php echo $file_data['0']['file_subject']; ?></th>
										<th><a href="<?php echo base_url();?>draft/draft/add_fileto_draft/<?php echo $file['file_id']; ?>" class="btn btn-info"><i class="fa fa-add"></i> जोड़े</a></th>
									</tr>
									<?php $i ++;  } ?>
									</table>
						 <?php } else {
							  $can_add = false;
								echo '<div class="callout callout-info">                  
									<p>फाइल को जोड़ने से पहले फाइल को अपने लेवल पर प्राप्त करे</p>
								</div>';
								}
						} else{
							$can_add = false;
							echo '<div class="callout callout-danger">                  
								<p>No result found!</p>
							</div>';
						} ?>
					<?php } ?>
					
					</div><!-- /.box-body -->
					<div class="box-footer">
						<div class="pull-left">
						  <p>यदि आपको किसी फाइल पर ड्राफ्ट जोड़ना है तो फाइल चुने नहीं तो ड्राफ्ट जोड़ ले</p>
						</div>
						<div class="pull-right">						
							<button type="submit" name="search_file" class="btn btn-primary"><i class="fa fa-pencil"></i>खोजे</button>
						</div>
					</div><!-- /.box-footer -->
				  </div><!-- /. box -->
				</form>
				
				<form method="post" name="save_draft" action="<?php echo base_url(); ?>draft/draft/save_draft">
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
							<?php $senior_id = get_user_supervisor();
								  $super_visor = !empty($senior_id[0]->emp_id) ?  $senior_id[0]->emp_id : '';
							$employees  = get_list(EMPLOYEES, "role_id ASC, emp_full_name_hi ASC", "emp_status = '1' and emp_is_retired = '0' and emp_is_parmanent = '1' and role_id BETWEEN 3 AND 27 ",'');
							foreach($employees as $key => $value){ ?>
								<option value="<?php echo $value['emp_id']; ?>" <?php echo $value['emp_id'] == $super_visor ? 'selected' : '';  ?>><?php echo $value['emp_full_name']; ?>(<?php echo $value['emp_full_name_hi']; ?> - <?php echo get_employee_role($value['emp_id']); ?>)</option>
							<?php } ?>
						</select>
						<?php echo form_error('sender_id'); ?>
					  </div>
					  <div class="form-group">
						<label>ड्राफ्ट का प्रकार</label>
						<select name="draft_type" class="form-control">
							<?php foreach(draft_type() as $key => $value){ ?>
								<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
							<?php } ?>
						</select>
						<?php echo form_error('draft_type'); ?>
					  </div>
					  <div class="form-group">
						<label>ड्राफ्ट का विषय</label>
						<textarea  name="draft_subject" class="form-control" style="height:75px"><?php echo isset($file_data[0]['file_subject']) ? $file_data[0]['file_subject'] : ''; ?></textarea>
						<?php echo form_error('draft_subject'); ?>
					  </div>
					  
					  <div class="form-group">
						<label>ड्राफ्ट का </label>
						<textarea id="compose-textarea" name="draft_content_text" class="form-control" style="height: 500px"></textarea>
						<input type="hidden" name="etxtdata" value =""  id="draftcontenttext">
					 <?php echo form_error('draft_content_text'); ?>
					 </div>				
					</div><!-- /.box-body -->
					<div class="box-footer">
					  <div class="pull-right">
						<input type="hidden" name="file_id" value ="<?php echo isset($file_data[0]['file_id']) ? $file_data[0]['file_id'] : 0; ?>" >
						<input type="hidden" name="section_id" value ="<?php echo isset($file_data[0]['file_mark_section_id']) ? $file_data[0]['file_mark_section_id'] : null; ?>" >
						<?php if($can_add == true){ ?>							
							<button type="submit" name="btnadddraft" value="add_draft" onClick="return confirm('कृपया सुनिश्चित कर ले की आप ड्राफ्ट पुनः एडिट के किये सहेज रहे है');" class="btn btn-primary"><i class="fa fa-pencil"></i>फाइल पर  ड्राफ्ट जोड़े</button>
						<?php } ?>
				
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
	 
	 $(function(){
	  $('#compose-textarea').on('keyup', function(){
			var etxt = $('#draft_version').val();
			alert(etxt);
			$('#draftcontenttext').value(etxt);
	  });  
	});
	
</script>