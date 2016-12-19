 <?php $year = $this->input->get('year') != '' ? $this->input->get('year') : date('Y'); ?>
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
			<a href="<?php echo base_url();?>draft/draft/add_draft" class="btn btn-primary btn-block margin-bottom">नया ड्राफ्ट जोड़े</a>              <?php $this->load->view('draft_sidebar'); ?>
            </div><!-- /.col -->
           <div class="col-md-9">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo $sub_title; ?></h3>
                  <div class="box-tools pull-right">
                    <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
                    <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="mailbox-read-info">
				  <?php $emp_id = $draft_data['draft_sender_id']; ?>
                    <h3><?php echo $draft_data['draft_subject']; ?></h3>
                    <h5><i class="fa fa-user"></i> <?php echo getemployeeName($emp_id, true);?> - <?php echo get_employee_role($emp_id); ?> <i class="fa fa-send"></i> <?php echo getemployeeName($draft_data['draft_reciever_id'], true);?> - <?php echo get_employee_role($draft_data['draft_reciever_id']); ?> <span class="mailbox-read-time pull-right"><i data-toggle="tooltip" title="ड्राफ्ट बनाई दिनांक"><?php echo get_datetime_formate($draft_data['draft_create_date']); ?></i> - <i data-toggle="tooltip" title="ड्राफ्ट पूर्ण  या कर्यवाही दिनांक"><?php echo get_datetime_formate($draft_data['draft_update_date']); ?></i></span></h5>
                  </div><!-- /.mailbox-read-info -->
                  <div class="mailbox-controls with-border text-center">
                    <div class="btn-group">
                      <button class="btn btn-default btn-sm" data-toggle="tooltip" title="Delete"><i class="fa fa-trash-o"></i></button>
                    </div><!-- /.btn-group -->
                    <button class="btn btn-default btn-sm" data-toggle="tooltip"  onclick="printContents('for-print')" title="Print"><i class="fa fa-print"></i></button>
                  </div><!-- /.mailbox-controls -->
				  <?php $type = $draft_data['draft_type']; 
					if($type == 'n'){
						$style = 'padding:2% 13%; background-color:#CCFFCC;';
						$subject = '<p style="padding-left:15%;"><b>'.$draft_data['draft_subject'].'</b></p>';
					}else{
						$style = '';
						$subject = '';
					}
				  ?>
                  <div class="mailbox-read-message no-padding" id="for-print">
					<div style="<?php echo $style; ?>"  >
						<?php echo $subject; ?>
						<?php echo html_entity_decode($draft_data['draft_content_text']); ?>
						<?php foreach($draft_emp as $emp_id){ ?>
							<br/>
							<p><b><u><?php echo get_employee_role($emp_id->draft_log_creater); ?></u></b></p>
						<?php } ?>
					</div>
                  </div><!-- /.mailbox-read-message -->
                </div><!-- /.box-body -->
                <div class="box-footer">
                  
                </div><!-- /.box-footer -->
                <div class="box-footer">
				<?php  if(($draft_data['draft_status'] == 2 && $draft_data['draft_creater_emp_id'] == $this->session->userdata("emp_id")) || ($draft_data['draft_is_finalize'] == 0 && $draft_data['draft_reciever_id'] == $this->session->userdata("emp_id"))) {  ?>
                  <a href="<?php echo base_url()?>draft/draft/draft_edit/<?php echo $draft_data['draft_id']; ?>" class="btn btn-danger"><i class="fa fa-edit"></i> Edit</a>
                  <a href="<?php echo base_url()?>draft/draft/complete_draft/<?php echo $draft_data['draft_id']; ?>" onClick="return confirm('क्या आप इसे फाइनल ड्राफ्ट करना चाहते है इसके बाद आप पुनः एडिट नहीं कर सकते'); " class="btn btn-success"><i class="fa fa-right"></i> ड्राफ्ट को फाइनल करे</a>
                <?php } else if($draft_data['draft_is_finalize'] == 1){ ?>
                  <a href="<?php echo base_url().$draft_data['draft_complete_path']; ?>" target="_blank" class="btn btn-primary"><i class="fa fa-file-pdf-o"></i> पी.डी.एफ. देखे</a>
                  <a href="<?php echo base_url()?>draft/draft/reopen_draft/<?php echo $draft_data['draft_id']; ?>" class="btn btn-warning"><i class="fa fa-file-o"></i> ड्राफ्ट पुनः खोले</a>
				<?php }?>
				<?php  if($draft_data['draft_file_id'] != 0){ ?>
                  <a href="<?php echo base_url()?>draft/draft/view_file/<?php echo $draft_data['draft_id'].'/'.$draft_data['draft_file_id']; ?>"  class="btn btn-primary"><i class="fa fa-file"></i> फाइल देखे</a>
				<?php } else{ ?>
					<a href="<?php echo base_url()?>draft/draft/add_file/<?php echo $draft_data['draft_id']; ?>"  class="btn btn-primary"><i class="fa fa-file"></i> ड्राफ्ट से नई फाइल जोड़े</a>
				 <?php }?>
				  <button class="btn btn-warning" onclick="printContents('for-print')"><i class="fa fa-print"></i> Print</button>
                </div><!-- /.box-footer -->
              </div><!-- /. box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
		  <div class="row">
            <div class="col-md-12">
				<div class="box box-danger">
					<div class="box-header with-border">
					  <h3 class="box-title">लॉग  देखे</h3>
					  <div class="box-tools pull-right">
						<a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-eye"></i></a>
					  </div>
					</div><!-- /.box-header -->
					<div class="box-body">
						<?php if(isset($draft_data_log) && $draft_data_log != '') { ?>
							<table class="dataTable table table-hover">
								<thead>
								<tr><th>S.no. </th><th>किसने बनाया</th><th>किसको भेजा</th><th>कब बनाया</th><th></th></tr>
								</thead>
								<tbody>
								<?php $i = 1; foreach($draft_data_log as $key=> $data){ ?>
									<tr>
									<td><?php echo $i;  ?></td>
									<td><?php echo getemployeeName($data->draft_log_creater, true) .' - '.get_employee_role($data->draft_log_creater); ?></td>
									<td><?php echo getemployeeName($data->draft_log_sendto, true) .' - '.get_employee_role($data->draft_log_sendto); ?></td>
									<td><?php echo $data->draft_log_create_date; ?></td>
									<td><a href="<?php echo base_url().'/draft/draft/draft_compare/'.$data->draft_log_id.'/'.$draft_data['draft_id']; ?>" ><i class="fa fa-eye"></i> View and compare</a></td>
									</tr>
								<?php $i++; } ?>
								</tbody>
							</table>
							<br/>
							
						 <?php } else {
							echo 'No data found';
						}?>
					</div>
					<?php if($draft_data['draft_parent_id'] != null) { ?>
					<div class="box-footer">
						<p class="bg-info" >यह ड्राफ्ट  <a href="<?php echo base_url(); ?>draft/draft/draft_viewer/<?php echo $draft_data['draft_parent_id']; ?>">[<i class="fa fa-eye"></i> ड्राफ्ट ]</a> से पुनः खोला गया| </p>
					</div>
					<?php } ?>
				</div>
			</div>
		</div> 
		<div class="row">
            <div class="col-md-12">
				<div class="box box-warning collapsed-box">
					<div class="box-header with-border">
					  <h3 class="box-title">टाइमलाइन  देखे</h3>
					  <div class="box-tools pull-right">
						<button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-plus"></i></button>
					  </div>
					</div><!-- /.box-header -->
					<div class="box-body" style="display: none;">
					<ul class="timeline">
						<?php if(isset($draft_data_log) && $draft_data_log != '') { ?>
							<?php $i = 1; foreach($draft_data_log as $key=> $data){ ?>
								<!-- timeline time label -->
								<li class="time-label">
									<span class="bg-green">
										<?php echo get_datetime_formate($data->draft_log_create_date); ?>
									</span>
								</li>
								<!-- /.timeline-label -->

								<!-- timeline item -->
								<li>
									<!-- timeline icon -->
									<i class="fa fa-comments bg-yellow"></i>
									<div class="timeline-item">
										<span class="time"><i class="fa fa-clock-o"></i> <?php echo get_timeago($data->draft_log_create_date); ?></span>

										<h3 class="timeline-header"><a href="#"><?php echo getemployeeName($data->draft_log_creater, true) .' - '.get_employee_role($data->draft_log_creater); ?></a> के द्वारा बनाया गया</h3>

										<div class="timeline-body">
											<?php echo $data->draft_content; ?>
										</div>
									</div>
								</li>
								<?php $i++; } ?>
								<li>
								  <i class="fa fa-clock-o bg-gray"></i>
								</li>
						 <?php } else {
							echo 'No data found';
						}?>
						</ul>
					</div>
				</div>
			</div>
		</div>
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
	 
	 
</script>