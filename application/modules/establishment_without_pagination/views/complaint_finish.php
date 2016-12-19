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
				<form role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url()?>establishment/complaint/complaint_finished">
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
						<input type="hidden" name="complaint_finish" value="<?php echo $get_complaint['complaint_id'];?>">
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
							<select name="complaint_finish" class="form-control">
								<option value="1" <?php echo $get_complaint['complaint_is_finish'] == 1 ? 'selected' : ''; ?>>Finished</option>
								<option value="0" <?php echo $get_complaint['complaint_is_finish'] == 0 ? 'selected' : ''; ?>>Pending</option>
							</select>
						</div><!-- /.col-6-->
					</div><!-- /.box body -->
					 <div class="box-footer">
						<button class="btn btn-primary" type="submit" name="btnwork" id="btnwork" value="1"><?php echo $this->lang->line('submit_botton'); ?></button>
						<a href="<?php echo base_url('establishment');?>/print_complaint/<?php echo $get_complaint['complaint_id'];?>"  class="btn  btn-warning">Print</a>
					</div>							
				</form>
            </div><!-- /.box -->
        </div><!-- /.col-12 -->
    </div><!-- /.row -->
    <!-- Main row -->
</section><!-- /.content -->

<?php //pr($alloted_work['complaint_subject']); ?>

    