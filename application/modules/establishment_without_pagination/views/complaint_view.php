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
					<div class="box-header">
						<div style="float:left"><h3 class="box-title"><?php echo $title_tab;?></h3></div>
						<div style="float:right;">
							<a href="javascript:history.go(-1)">
								<button class="btn btn-block btn-warning" type="button"><?php echo $this->lang->line('Back_button_label'); ?></button>
							</a>
						</div>
					</div><!-- /.box-header -->		
					<div class="box-body">	
					<?php if(isset($get_complaint)) {
						$get_complaint = $get_complaint[0];
						}?>
						<div class="col-md-6">  
							<p><span><?php echo $this->lang->line('complaint_emp'); ?></span><br/>
							<label><b><?php echo getemployeeName($get_complaint['complaint_emp_id'], true); ?></b></label></p>
							<p><span><?php echo $this->lang->line('complaint_type'); ?></span><br/>
							<label><b><?php echo complaint_type($get_complaint['complaint_type_id']); ?></b></label>	</p>						
							<p><span><?php echo $this->lang->line('complaint_subject'); ?></span><br/>
							<label><b><?php echo $get_complaint['complaint_subject']; ?></b></label></p>
							<p><span><?php echo $this->lang->line('complaint_containts'); ?></span><br/>
							<label><b><?php echo $get_complaint['complaint_containts']; ?></b></label></p>
							<p><span><?php echo $this->lang->line('complaint_time'); ?></span><br/>
							<label><b><?php echo get_datetime_formate($get_complaint['complaint_create_time']); ?></b></label></p>
							<p><span><?php echo $this->lang->line('complaint_status'); ?></span><br/>
							<label><b><?php echo get_complaint_status($get_complaint['complaint_is_finish']); ?></b></label>
							<?php if($get_complaint['complaint_is_finish'] == 1) {
								echo ' by '.getemployeeName($get_complaint['complaint_finish_emp'], true);
								echo ' on '. get_datetime_formate($get_complaint['complaint_finish_date']);
							}
							?>
							</p>
						</div><!-- /.col-6-->
					</div><!-- /.box body -->
					 <div class="box-footer">
						<a href="<?php echo base_url('establishment');?>/print_complaint/<?php echo $get_complaint['complaint_id'];?>"  class="btn  btn-warning">Print</a>
					</div>							
            </div><!-- /.box -->
        </div><!-- /.col-12 -->
    </div><!-- /.row -->
    <!-- Main row -->
</section><!-- /.content -->

<?php //pr($alloted_work['complaint_subject']); ?>

    