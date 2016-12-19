<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo $title; ?>
            <!--<small>Optional description</small>-->
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard');?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
			<li><a href="<?php echo base_url('admin'); ?>/tahsil/index/<?php echo $this->uri->segment(4)?>"> <?php echo $title; ?></a></li>
			<li class="active"><?php echo $title_tab; ?></li>
           </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <!-- Your Page Content Here -->
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-xs-6">
            
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title"><?php echo $title_tab ?></h3>
                </div><!-- /.box-header -->
                 <!-- form start -->
                <form role="form" method="post" action="<?php echo site_url(); ?>admin/admin_tahsil/addUpdatetahsil">
                   <input type="hidden" value="<?php echo isset($tahsildata['tahsil_id'])? $tahsildata['tahsil_id'] :''; ?>"  name="tahsil_id" id="tahsil_id" class="form-control">
                    <div class="box-body">
					<div class="form-group">
                      <label for="distname_Name"><?php echo $this->lang->line('label_distrct_title') ?></label>
						
						<?php 
						$selected = '';
						if($this->uri->segment(4) && $this->uri->segment(2) == 'add_tahsil'){
							
							$selected = $this->uri->segment(4)  ;
						} else if($this->uri->segment(3)){
								$selected =$this->uri->segment(3);
							
						}
						echo get_district_ddl_list('district_id' ,  'class="form-control"',$selected) ;
						 ?>
						
                        <?php echo form_error('tahsil_name_hi');?>
                     </div>
                    <div class="form-group">
                      <label for="distname_Name"><?php echo $this->lang->line('add_tahsil_hi') ?></label>
                      <input type="text" value="<?php echo isset($tahsildata['tahsil_name_hi'])? $tahsildata['tahsil_name_hi'] :''; ?>" placeholder="<?php echo $this->lang->line('add_tahsil_hi') ?>" name="tahsil_name_hi" id="tahsil_name_hi" class="form-control" required="">
                        <?php echo form_error('tahsil_name_hi');?>
                     </div>
                    <div class="form-group">
                      <label for="District_Name_eng"><?php echo $this->lang->line('add_tahsil_en') ?></label>
                      <input type="text" value="<?php echo isset($tahsildata['tahsil_name_en'])? $tahsildata['tahsil_name_en'] :''; ?>" placeholder="<?php echo $this->lang->line('add_tahsil_en') ?>" name="tahsil_name_en" id="tahsil_name_en" class="form-control" required="">
                        <?php echo form_error('tahsil_name_en');?>
                    </div>
                   
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button class="btn btn-primary" onclick="return confir_post_data();" type="submit"><?php echo $this->lang->line('submit') ?></button>
                  </div>
                </form>
              </div><!-- /.box -->
             </div><!-- /.box-body -->
            </div><!-- /.box -->
            </div>
          </div><!-- /.row -->
          <!-- Main row -->
        </section><!-- /.content -->
    