<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo $title; ?>
            <!-- <small>Optional description</small> -->
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url('admin'); ?>"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line('dashboard'); ?></a></li>
            <li><a href="<?php echo base_url('admin');?>/sections"><?php echo $this->lang->line('title'); ?></a></li>
            <li class="active"><?php echo $title_tab; ?></li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <!-- Your Page Content Here -->
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                 
                <div class="box-header">
                  <div style="float:left"><h3 class="box-title"><?php echo $title_tab;?></h3></div>
                  
                </div><!-- /.box-header -->
                  
                <form role="form" method="post" action="<?php echo base_url()?>admin_sections_master/manage_section<?php if(isset($id)){ echo '/'.$id;} ?>">
                  <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary" style="margin-top: 15px;">
                      <!-- form start -->
                      <?php echo $this->session->flashdata('message'); ?>
                      
                        <div class="box-body">
                          <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo $this->lang->line('emp_role_id_label'); ?></label>
                             <?php echo  isset($assistant_details->emprole_name_hi)?$assistant_details->emprole_name_hi:''?>
                             
                           
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo $this->lang->line('emp_section_id_label'); ?></label>
                              <?php echo isset($assistant_details->section_name_hi)?$assistant_details->section_name_hi :''?>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1"><?php echo $this->lang->line('emp_unique_id_label'); ?></label>
                            <?php echo (@$assistant_details->emp_unique_id ? @$assistant_details->emp_unique_id:'');?>
                           
                          </div>
                          <div class="form-group">
                            <label for="exampleInputFile"><?php echo $this->lang->line('emp_login_id_label_1'); ?></label>
                            <?php echo (@$assistant_details->emp_login_id ? @$assistant_details->emp_login_id:'');?>
                           
                          </div>                  
                         
                          <div class="form-group">
                            <label for="exampleInputFile"><?php echo $this->lang->line('emp_full_name_label'); ?></label>
                           <?php echo (@$assistant_details->emp_full_name ? @$assistant_details->emp_full_name:'');?>
                           
                          </div>                 

                          <div class="form-group">
                            <label for="exampleInputFile"><?php echo $this->lang->line('emp_email_label'); ?></label>
                            <?php echo (@$assistant_details->emp_email ? @$assistant_details->emp_email:'');?>
                            
                          </div>  
                          <div class="form-group">
                            <label for="exampleInputFile"><?php echo $this->lang->line('emp_mobile_label'); ?></label>
                            <?php echo (@$assistant_details->emp_mobile_number ? @$assistant_details->emp_mobile_number:'');?>
                          
                          </div> 

                        </div><!-- /.box-body -->
                       <!--  <div class="box-footer">
                          <button class="btn btn-primary" type="submit"><?php //echo $this->lang->line('submit_botton'); ?></button>
                        </div> -->
                    </div><!-- /.box -->
                  </div>



                  <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary" style="margin-top: 15px;">
                      <!-- form start -->
                      <div class="box-body">
                          <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo $this->lang->line('emp_is_retired_label'); ?></label>
                                <?php echo checkEmployeeRetired($assistant_details->emp_is_retired); ?>
                           
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo $this->lang->line('emp_gender_label'); ?></label>
                              <?php if($assistant_details->emp_detail_gender == 'm'){ echo "Male"; }else { echo "Female"; }?>
                         
                          </div>

                          <div class="form-group">
                            <label for="exampleInputPassword1"><?php echo $this->lang->line('emp_detail_martial_status_label'); ?></label>
                            <?php echo (@$assistant_details->emp_detail_martial_status ? @$assistant_details->emp_detail_martial_status:'');?>
                           
                          </div>
                          <div class="form-group">
                            <label for="exampleInputFile"><?php echo $this->lang->line('emp_detail_address_label'); ?></label>
                            <?php echo (@$assistant_details->emp_detail_address ? @$assistant_details->emp_detail_address:'');?>
                          
                          </div>                  
                          

                          <div class="form-group">
                            <label for="exampleInputFile"><?php echo $this->lang->line('emp_state'); ?></label>
							<?php if(isset($assistant_details->emp_detail_city)){ echo getState($assistant_details->emp_detail_city); } ?>
                           
                          </div>                 

                          <div class="form-group">
                            <label for="exampleInputFile"><?php echo $this->lang->line('emp_city'); ?></label>
                            <?php if(isset($assistant_details->emp_detail_state)){ echo getCity($assistant_details->emp_detail_state); } ?>
                           
                          </div>  
                          <div class="form-group">
                            <label for="exampleInputFile"><?php echo $this->lang->line('emp_mobile_label'); ?></label>
                          <?php echo (@$assistant_details->emp_mobile_number ? @$assistant_details->emp_mobile_number:'');?>
                           
                          </div> 

                        </div><!-- /.box-body -->
                       
                    </div><!-- /.box -->
                  </div>
                </form>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
            </div>
          </div><!-- /.row -->
          <!-- Main row -->
        </section><!-- /.content -->
    