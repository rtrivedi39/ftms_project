<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo $title; ?>
            <!-- <small>Optional description</small> -->
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('admin').'/dashboard'; ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url('admin');?>/manage_teep"> <?php echo $title; ?></a></li>
            <li class="active"><?php echo $page_title; ?></li>
		  </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <!-- Your Page Content Here -->
          <!-- Small boxes (Stat box) -->
          <div class="row">
          
              <div class="box">
               
                <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title"><?php echo $page_title; ?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo $this->session->flashdata('message'); ?>
                <form role="form" method="post" action="<?php echo base_url()?>admin_teep_master/manage_teep<?php if(isset($id)){ echo '/'.$id;} ?>">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1"><?php echo $this->lang->line('label_teep_title'); ?></label>
                      <input type="text" name="title" value="<?php echo (@$teep_master_details['title'] ? @$teep_master_details['title']:'');?>" class="form-control">
                      <?php echo form_error('title');?>
                    </div>
                    <div class="form-group">
					
                      <label for="exampleInputPassword1"><?php echo $this->lang->line('label_teep_emp_role'); ?></label>
						 <div class="form-group  pull-right">
						<?php 	foreach($get_emp_rolelist as $role_key=>$rolelist){ 
							$level_ids = explode(',',$teep_master_details['emprole_level_id']);
						?>
						<label class="checkbox"> <input type="checkbox" name="emprole_level[]" value="<?php echo $rolelist['emprole_level'] ?>"  <?php if(in_array($rolelist['emprole_level'],$level_ids )){ echo "checked"; } ?> ><?php echo $rolelist['emprole_name_hi'].'('.$rolelist['emprole_name_en'].')' ?>
							</label>
						<?php
						}?>
						</div>
                  
                    </div>
					  <div class="clearfix"></div>
                    <div class="form-group">
                      <label for="exampleInputFile"><?php echo $this->lang->line('label_teep_status'); ?></label>
                     <select name="status"  class="form-control" >
						 <option value="1" <?php if($teep_master_details['status'] == 1){ echo "selected"; }?>> Enabled </option>
						 <option value="2" <?php if($teep_master_details['status'] == 2 ){ echo "selected"; }?>> Disabled </option>
						</select>
						
                      <?php echo form_error('status');?>
                    </div>                  
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button class="btn btn-primary" onclick="return confir_post_data();" type="submit"><?php echo $this->lang->line('submit_botton'); ?></button>
                  </div>
                </form>
              </div><!-- /.box -->
            </div>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
            </div>
          </div><!-- /.row -->
          <!-- Main row -->
        </section><!-- /.content -->
    