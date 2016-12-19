
<section class="content-header">
    <h1>
        <?php echo $title ?>(2015)

    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">Leave Balance</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Start box) -->
  <?php //pre($leave_balance); ?>
    <div class="row">
        <div class="col-md-6">
            <?php echo $this->session->flashdata('message'); ?>
            <div class="box box-info">
                <div class="box-header">
                    <i class="fa fa-inbox"></i><h3 class="box-title"><?php echo $title_tab; ?> 
                    <b> (<?php echo getemployeeName($id) //."/ ". getemployeeRole($id); ?>)</b></h3>
                </div><!-- /.box-header -->
				<form enctype="multipart/form-data" id="" role="form" method="post" action="<?php echo base_url() ?>leave/leave/update_leave_balance/">	
                <div class="box-body">
				<input type="hidden" value="<?php echo $id; ?>" name="emp_id">
                    <div class="form-group col-md-12">
						<label for="cl"> Casual leave <?php echo $this->lang->line('casual_leave'); ?><span class="text-danger">*</span></label>
						<input type="number"   name="cl_leave" id="" min="0" max="13" step=".5" value="<?php echo $leave_balance[0]['cl_leave'] ; ?>" class="form-control">
						<?php echo form_error('cl_leave'); ?>
					</div>
					<div class="form-group col-md-12">
						<label for="cl"> Optional leave <?php echo $this->lang->line('optional_leave'); ?><span class="text-danger">*</span></label>
						<input type="number"   name="ol_leave" id="" min="0" max="3" value="<?php echo $leave_balance[0]['ol_leave'] ; ?>" class="form-control">
						<?php echo form_error('ol_leave'); ?>
					</div>
					<div class="form-group col-md-12">
						<label for="cl"> Earned leave <?php echo $this->lang->line('earned_leave'); ?><span class="text-danger">*</span></label>
						<input type="number"   name="el_leave" id=""  value="<?php echo $leave_balance[0]['el_leave'] ; ?>" class="form-control">
						<?php echo form_error('el_leave'); ?>
					</div>
					<div class="form-group col-md-12">
						<label for="cl"> Half pay leave <?php echo $this->lang->line('half_pay_leave'); ?><span class="text-danger">*</span></label>
						<input type="number"   name="hpl_leave" id=""  value="<?php echo $leave_balance[0]['hpl_leave'] ; ?>" class="form-control">
						<?php echo form_error('hpl_leave'); ?>
					</div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                 <button class="btn btn-primary" type="submit" onclick="return confirm('क्या आप बदलाव करना चाहते है|');" id=""><?php echo $this->lang->line('submit_botton'); ?></button>
                </div>
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
   
</section><!-- /.content -->


