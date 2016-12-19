<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo $title; ?>
            <!-- <small>Optional description</small> -->
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url().'dashboard'?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url('admin');?>/employee_otherwork"><?php echo $title; ?></a></li>
            <li class="active"><?php echo $this->lang->line('Manage_post_label'); ?></li>
         </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <!-- Your Page Content Here -->
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-xs-12">
             
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title"><?php echo $page_title; ?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo $this->session->flashdata('message'); //pre($otherwork_master_detail); ?>
                <form role="form" method="post" action="<?php echo base_url()?>admin_upper_level_work_master/manage_otherwork<?php if(isset($id)){ echo '/'.$id;} ?>">
                  <div class="box-body">
					<div  class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1"><?php echo $this->lang->line('label_otherwork_hi'); ?></label>
                      <input type="text" name="other_work_title_hi" value="<?php echo (@$otherwork_master_detail['other_work_title_hi'] ? @$otherwork_master_detail['other_work_title_hi']:'');?>" class="form-control">
                      <?php echo form_error('other_work_title_hi');?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1"><?php echo $this->lang->line('label_otherwork_en'); ?></label>
                      <input type="text" name="other_work_title_en" value="<?php echo (@$otherwork_master_detail['other_work_title_en'] ? @$otherwork_master_detail['other_work_title_en']:'');?>" class="form-control">
                      <?php echo form_error('other_work_title_en');?>
                    </div>
                  </div><!-- /.box-body -->
				</div>
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
    