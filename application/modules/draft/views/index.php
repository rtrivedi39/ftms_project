 <section class="content-header">
  <h1>
	<?php echo $title; ?>
	<small> <?php echo sizeof($draft_data); ?> <?php echo $small_title; ?></small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
	<li class="active"><?php echo $title; ?></li>
  </ol>
</section>
<section class="content">
	  <div class="row">
		<div class="col-md-3">
		  <a href="<?php echo base_url();?>draft/draft/add_draft" class="btn btn-primary btn-block margin-bottom"><?php echo $this->lang->line('draft_create'); ?></a>
		  <?php $this->load->view('draft_sidebar'); ?>
		</div><!-- /.col -->
		<div class="col-md-9">
		<?php if($this->session->flashdata('message') || $this->session->flashdata('error')) {
			$msg = $this->session->flashdata('message') ? 'success' : 'danger';
			?>
			<div class="alert alert-<?php echo $msg; ?> alert-dismissable">					
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>
					<?php  echo $this->session->flashdata('message');
					echo $this->session->flashdata('error'); ?>
				</strong>
				<br/>
			</div>
		<?php } ?>
		  <div class="box box-primary">
			<div class="box-header with-border">
			  <h3 class="box-title"><?php echo $sub_title; ?></h3>
			  <div class="box-tools pull-right">
				<div class="has-feedback">
				  <input type="text" class="form-control input-sm" placeholder="Search Mail"/>
				  <span class="glyphicon glyphicon-search form-control-feedback"></span>
				</div>
			  </div><!-- /.box-tools -->
			</div><!-- /.box-header -->
			<div class="box-body no-padding">
			  <div class="mailbox-controls">
				<!-- Check all button -->
				<button class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button>
				<div class="btn-group">
				  <button class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
				</div><!-- /.btn-group -->
				<a href="" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></a>
				<div class="pull-right">
				  1-50/<?php echo sizeof($draft_data); ?>
				  <div class="btn-group">
					<button class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
					<button class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
				  </div><!-- /.btn-group -->
				</div><!-- /.pull-right -->
			  </div>
			  <div class="table-responsive mailbox-messages">
				<table class="table table-hover table-striped">
					<thead>
						<tr>
						  <th>Check</th>
						  <th>Draft Id</b></th>
						  <th class="mailbox-name">Name</th>
						  <th class="mailbox-subject">Subject</th>
						  <th class="mailbox-attachment">Type</th>
						  <th class="mailbox-date">Time</th>
						</tr>
					</thead>
				  <tbody>
				  <?php   if(isset($draft_data) && $draft_data != ''){ 
				   $i =1 ; foreach($draft_data as $drft) { 
					if($this->uri->segment('3') == 'send_draft' || $this->uri->segment('3') == 'working_draft'){
						$emp_id = $drft->draft_reciever_id;
					} else{
						$emp_id = $drft->draft_sender_id;
					}
				   ?>
						<tr>
						  <td><input type="checkbox" /></td>
						  <td><b><?php echo $drft->draft_id; ?></b></td>
						  <td class="mailbox-name"><a href="<?php echo base_url(); ?>draft/draft/draft_viewer/<?php echo $drft->draft_id; ?>"> <?php echo getemployeeName($emp_id, true);?> - <?php echo get_employee_role($emp_id); ?></a></td>
						  <td class="mailbox-subject"><b><?php echo substr($drft->draft_subject, 0, 80);?>...</td>
						  <td class="mailbox-attachment"><?php echo draft_type($drft->draft_type);?></td>
						  <td class="mailbox-date" data-toggle="tooltip" title="<?php echo get_datetime_formate($drft->draft_create_date);?>"><?php echo get_timeago($drft->draft_create_date);?></td>
						</tr>
				  <?php $i++; }
					} else {
						echo '<tr><td colspam="5">No result found!</td></tr>';
					} ?>
				  </tbody>
				</table><!-- /.table -->
			  </div><!-- /.mail-box-messages -->
			</div><!-- /.box-body -->
			<div class="box-footer no-padding">
			  <div class="mailbox-controls">
				<!-- Check all button -->
				<button class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button>                    
				<div class="btn-group">
				  <button class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
				</div><!-- /.btn-group -->
				<a href="" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></a>
				<div class="pull-right">
				  1-50/<?php echo sizeof($draft_data); ?>
				  <div class="btn-group">
					<button class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
					<button class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
				  </div><!-- /.btn-group -->
				</div><!-- /.pull-right -->
			  </div>
			</div>
		  </div><!-- /. box -->
		</div><!-- /.col -->
	  </div><!-- /.row -->
</section><!-- /.content -->
<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
 <!-- iCheck -->
    <script src="<?php echo ADMIN_THEME_PATH; ?>plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <!-- Page Script -->
    <script>
      $(function () {
      /*  Enable iCheck plugin for checkboxes
        iCheck for checkbox and radio inputs*/
        $('.mailbox-messages input[type="checkbox"]').iCheck({
          checkboxClass: 'icheckbox_flat-blue',
          radioClass: 'iradio_flat-blue'
        });

        /*Enable check and uncheck all functionality*/
        $(".checkbox-toggle").click(function () {
          var clicks = $(this).data('clicks');
          if (clicks) {
           /* Uncheck all checkboxes*/
            $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
            $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
          } else {
           /* Check all checkboxes*/
            $(".mailbox-messages input[type='checkbox']").iCheck("check");
            $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
          }          
          $(this).data("clicks", !clicks);
        });

       /* Handle starring for glyphicon and font awesome*/
        $(".mailbox-star").click(function (e) {
          e.preventDefault();
          /*detect type*/
          var $this = $(this).find("a > i");
          var glyph = $this.hasClass("glyphicon");
          var fa = $this.hasClass("fa");

          /*Switch states*/
          if (glyph) {
            $this.toggleClass("glyphicon-star");
            $this.toggleClass("glyphicon-star-empty");
          }

          if (fa) {
            $this.toggleClass("fa-star");
            $this.toggleClass("fa-star-o");
          }
        });
      });
    </script>
    



