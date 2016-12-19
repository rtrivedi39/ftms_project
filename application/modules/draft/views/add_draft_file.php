 <?php $year = $this->input->get('year') != '' ? $this->input->get('year') : date('Y');

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
			<form method="post" name="save_draft" action="<?php echo base_url(); ?>draft/draft/search_file/1/<?php echo $draft_data['draft_id']; ?>">
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
					<?php  if(isset($file_data) && $file_data != ''){ ?>
						<table class="table table-hover table-striped">
							<tr>
								<th>No.</th>
								<th>पंजी नंबर</th>
								<th>विषय</th>
								<th>इ फाइल</th>
								<th>कार्यवाही</th>
							</tr>
							<?php $i =1 ; foreach($file_data as $file) { ?>
							<tr>
								<th><?php echo $i; ?></th>
								<th><?php echo get_panji_no($file['file_id'],$file['file_mark_section_id'],$file['file_created_date']); ?></th>
								<th><?php echo $file['file_subject']; ?></th>
								<th>
								<?php 
									if(isset($file['scan_id']) && !empty($file['scan_id'])){
										$scan_ids = unserialize($file_data[0]['scan_id']); 
										foreach($scan_ids as $scanid){
											if(!empty($scanid)){
											$scan_file_details = scan_file_details($scanid);
											$file_path = $scan_file_details['scan_file_path'];
											?>
												<li class="my_scan_file_2" style="text-align:left; "><a onclick="open_file_in_viewer( <?php echo $scanid ;?>,'<?php echo $file_path; ?>')" style="cursor:pointer"><?php echo get_scan_file_name($scanid); ?></a>&nbsp;&nbsp;&nbsp;&nbsp; </li>
											<?php 
											}
										} 
									}
								?>
								</th>
								<th><a href="<?php echo base_url();?>draft/draft/add_fileto_draft/<?php echo $file['file_id'].'/'.$draft_data['draft_id']; ?>" class="btn btn-info"><i class="fa fa-add"></i> जोड़े</a></th>
							</tr>
							<?php $i ++;  } ?>
						</table>
					<?php } else{
						echo 'No result found!';
						} ?>
					<?php } ?>
				
					</div><!-- /.box-body -->
					<div class="box-footer">
						<div class="pull-right">						
							<button type="submit" name="search_file" class="btn btn-primary"><i class="fa fa-pencil"></i>खोजे</button>
						</div>
					</div><!-- /.box-footer -->
				  </div><!-- /. box -->
				</form>
			</div>		
		</div>
        <div class="row">          
			<div class="col-md-6">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">विभाग का ड्राफ्ट</h3>
                </div><!-- /.box-header -->
                <div class="box-body" style="height:450px; overflow-y:scroll;">
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
                  <?php  if(($draft_data['draft_status'] == 2 && $draft_data['draft_creater_emp_id'] == $this->session->userdata("emp_id")) || ($draft_data['draft_is_finalize'] == 0 && $draft_data['draft_reciever_id'] == $this->session->userdata("emp_id"))) {  ?>
                  <a href="<?php echo base_url()?>draft/draft/draft_edit/<?php echo $draft_data['draft_id']; ?>" class="btn btn-danger"><i class="fa fa-edit"></i> Edit</a>
                  <a href="<?php echo base_url()?>draft/draft/complete_draft/<?php echo $draft_data['draft_id']; ?>" onClick="return confirm('क्या आप इसे फाइनल ड्राफ्ट करना चाहते है इसके बाद आप पुनः एडिट नहीं कर सकते'); " class="btn btn-success"><i class="fa fa-right"></i> ड्राफ्ट को फाइनल करे</a>
                <?php } ?>
                </div><!-- /.box-footer -->
               
              </div><!-- /. box -->
            </div><!-- /.col -->
			<div class="col-md-6">
			<?php if(isset($search_file) && $search_file == true){  ?>
            <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">फाइल जहा से आयी </h3>
                </div><!-- /.box-header -->
                <div class="box-body" style="height:450px;">
					<div class="col-md-12">	
						<div id="pdfRenderer"></div>
					</div>
                </div><!-- /.box-body -->
                <div class="box-footer">			
				</div><!-- /.box-footer -->
               
            </div><!-- /. box -->
			<?php } ?>
            </div><!-- /.col -->
          </div><!-- /.row -->
	
        </section><!-- /.content -->
<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="<?php echo base_url(); ?>themes/pdfobject.js"></script>
<script type="text/javascript">

	function open_file_in_viewer(scan_id ,file_path){
		 var HTTP_PATH='<?php echo base_url(); ?>';
			var pdf = new PDFObject({
			  url: HTTP_PATH+file_path ,
			  id: "pdfRendered",
			  height:"600px",
			  width:"100%",
			  pdfOpenParams: {
				view: "FitH"
			  }
			}).embed("pdfRenderer");
				
			$("#pdf_viewer").hide();
}
</script>