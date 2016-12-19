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
						<div class="col-md-6">      
								   
							<div class="form-group">
								<label for="suggestion_subject"><?php echo $this->lang->line('suggestion_subject'); ?><span class="text-danger">*</span></label>
								<p><?php echo $get_suggestion['suggestion_name']; ?></p>
							</div>
							<div class="form-group">
								<label for="suggestion_containts"><?php echo $this->lang->line('suggestion_containts'); ?></label>
								<p><?php echo $get_suggestion['suggestion_details']; ?></p>
							</div>
							<div class="form-group">
								<label for="suggestion_containts">दिनांक</label>
								<p><?php echo get_date_formate($get_suggestion['suggestion_createat']); ?></p> 
							</div>
							<div class="form-group">
								<label for="suggestion_containts">स्थिति</label>
								<p><?php  if($get_suggestion['suggestion_status'] == '0') { ?>
								<label class="label label-danger">कार्यवाही की जा रही है</label>
							<?php } else { ?>
								<label class="label label-success">कार्यवाही पूर्ण</label>
							<?php } ?></p> 
							</div>
						</div><!-- /.col-6-->
					</div><!-- /.box body -->
											
				</form>
            </div><!-- /.box -->
        </div><!-- /.col-12 -->
    </div><!-- /.row -->
    <!-- Main row -->
</section><!-- /.content -->

<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>


