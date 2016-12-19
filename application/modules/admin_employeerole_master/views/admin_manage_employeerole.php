<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo $title; ?>
            <!-- <small>Optional description</small> -->
          </h1>
          <ol class="breadcrumb">
          <li><a href="<?php echo base_url().'dashboard';?>"><i class="fa fa-dashboard"></i><?php echo $this->lang->line('dashboard');?></a></li>
		  <li><a href="<?php echo base_url('admin');?>/employeerole"><?php echo $title;?></a></li>
		  <li class="active"><?php echo $page_title;?></li>  </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <!-- Your Page Content Here -->
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <div style="float:left"><h3 class="box-title"><?php echo $page_title;?></h3></div>
                    <?php 
                      if($is_page_edit==0){ ?>
                          <div style="float:right">
                             <a href="<?php echo base_url('admin');?>/add_employeerole">
                              <button class="btn btn-block btn-info"><?php echo $this->lang->line('emprole_add');?></button>
                            </a>
                          </div>
                    <?php } ?>
                  
                </div><!-- /.box-header -->
                <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title"><?php echo $page_title; ?></h3>
                </div><!-- /.box-header -->
				  <!-- form start -->
                <?php echo $this->session->flashdata('message'); ?>
                <form role="form" method="post" action="<?php echo base_url()?>admin_employeerole_master/manage_employeerole/<?php echo $id;?>">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputFile"><?php echo $this->lang->line('emprole_unit_name'); ?></label>
                     <select name = "unit_id" class="form-control"> 
                          <option value=""> -- Select --  </option>
                          <?php if(isset($unilevels)){
                            foreach($unilevels as $unitlelel){
								if($unitlelel->unit_id == $emprole_master_detail['unit_id'])
								{
								?>
                            <option value="<?php echo $unitlelel->unit_id ?>" selected> <?php echo $unitlelel->unit_name;  ?></option>
								<?php	
									
								}else{
                            ?>
                            <option value="<?php echo $unitlelel->unit_id ?>"> <?php echo $unitlelel->unit_name;  ?></option>
								<?php }
                          }
                          } ?>
                      </select>
                      <?php echo form_error('unit_id');?>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1"><?php echo $this->lang->line('emprole_lavel_name_hi'); ?></label>
                      <input type="text" name="emprole_name_hi" value="<?php echo (@$emprole_master_detail['emprole_name_hi'] ? @$emprole_master_detail['emprole_name_hi']:'');?>" placeholder="<?php echo $this->lang->line('add_employeerole_with_hi'); ?>" class="form-control">
                      <?php echo form_error('emprole_name_hi');?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1"><?php echo $this->lang->line('emprole_lavel_name_en'); ?></label>
                      <input type="text" name="emprole_name_en" value="<?php echo (@$emprole_master_detail['emprole_name_en'] ? @$emprole_master_detail['emprole_name_en']:'');?>" placeholder="<?php echo $this->lang->line('add_employeerole_with_en'); ?>" class="form-control">
                      <?php echo form_error('emprole_name_en');?>
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
    