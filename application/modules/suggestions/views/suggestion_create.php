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
				<form role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url()?>suggestions/suggestion/add_suggestion/<?php if(isset($id)){ echo '/'.$id;} ?>">
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
									<textarea name="suggestion_subject" class="form-control"><?php echo (isset($form_input['suggestion_subject'])) ?  $form_input['suggestion_subject']: '';  ?></textarea>
								<?php echo form_error('suggestion_subject');?>
							</div>
							<div class="form-group">
								<label for="suggestion_containts"><?php echo $this->lang->line('suggestion_containts'); ?></label>
								<textarea name="suggestion_containts" id="suggestion_containts" class="form-control"><?php echo (isset($form_input['suggestion_containts'])) ?  $form_input['suggestion_containts']: '';  ?></textarea>
								<?php echo form_error('suggestion_containts');?>
							</div>
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


