 <?php  ?>
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
		</div>
		
          <div class="row">
           <div class="col-md-4">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">भेजे जाने वाला ड्राफ्ट</h3>
                </div><!-- /.box-header -->
                <div class="box-body" style="height:450px; overflow-y:scroll;">
             
                </div><!-- /.box-body -->
                <div class="box-footer">
                  
                </div><!-- /.box-footer -->
               
              </div><!-- /. box -->
            </div><!-- /.col -->
			<div class="col-md-4">
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
					<div  style="<?php echo $style; ?>; border:1px solid;"  >
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
                  <?php // if(($draft_data['draft_status'] == 2 && $draft_data['draft_creater_emp_id'] == $this->session->userdata("emp_id")) || ($draft_data['draft_is_finalize'] == 0 && $draft_data['draft_reciever_id'] == $this->session->userdata("emp_id"))) {  ?>
                  
                  <a href="<?php echo base_url()?>draft/draft/draft_edit/<?php echo $draft_data['draft_id']; ?>" class="btn btn-danger"><i class="fa fa-edit"></i> Edit</a>
                  <a href="<?php echo base_url()?>draft/draft/complete_draft/<?php echo $draft_data['draft_id']; ?>" onClick="return confirm('क्या आप इसे फाइनल ड्राफ्ट करना चाहते है इसके बाद आप पुनः एडिट नहीं कर सकते'); " class="btn btn-success"><i class="fa fa-right"></i> ड्राफ्ट को फाइनल करे</a>
                <?php // } ?>
                </div><!-- /.box-footer -->
               
              </div><!-- /. box -->
            </div><!-- /.col -->
			<div class="col-md-4">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">फाइल जहा से आयी </h3>
                </div><!-- /.box-header -->
                <div class="box-body" style="height:450px;">
				<div class="col-md-12">	
				<?php 	if( !empty($file_data[0]['scan_id'])){ ?>				
					<div class="form-group">
						<label for="section no"><?php echo "सभी स्कैन की गई फाइल"; ?> :- </label>
					</div>
					<div class="form-group">
						<ul>
						<?php 
							if(isset($file_data[0]['scan_id']) && !empty($file_data[0]['scan_id'])){
								$scan_ids = unserialize($file_data[0]['scan_id']); 
								//pre($scan_ids);
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
						</ul>
				
					</div>
					<div id="pdfRenderer"></div>
					<div class="form-group" id="scan_file_div">
						<?php   $last_scan_id = end($scan_ids);
						 $scan_file_details = scan_file_details($last_scan_id);
						 $scan_file = isset($scan_file_details['scan_file_path']) ? $scan_file_details['scan_file_path']:'';
						 if(!empty($scan_file) && isset( $scan_file)){ ?>
							<object id="pdf_viewer" data="<?php echo base_url(). $scan_file; ?>" type="application/pdf" width="100%" height="450px">
							<p>It appears you don't have a PDF plugin for this browser.
								No biggie... you can <a href="<?php echo base_url(). $scan_file; ?>">click here to download the PDF file.</a></p>
							</object>
				
						 <?php }
				} ?>

					<?php 
					 if(empty($file_data[0]['scan_id'])) { ?>
						<object data="<?php echo base_url(); ?>uploads/scan/viwer_example.pdf" type="application/pdf" width="100%" height="450px">
						<p>It appears you don't have a PDF plugin for this browser.
						No biggie... you can <a href="<?php echo base_url()?>/uploads/Leave Management Application.pdf">click here to
							download the PDF file.</a></p>

						</object>
					<?php  } ?>
					</div>
				</div>
			
                </div><!-- /.box-body -->
                <div class="box-footer">
				<?php 	if( !empty($file_data[0]['scan_id'])){ ?>	
                  <a href="<?php echo base_url(). $scan_file; ?>" target="_blank" class="btn btn-primary"><i class="fa fa-file-pdf-o"></i>  पूरा देखे</a>
                <?php } ?>
				</div><!-- /.box-footer -->
               
              </div><!-- /. box -->
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