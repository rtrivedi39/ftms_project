<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo $title; ?>
            <!-- <small>Optional description</small> -->
          </h1>
          <ol class="breadcrumb">
             <li><a href="<?php echo base_url('admin').'/dashboard'; ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url('admin');?>/department_posts"><?php echo $title; ?></a></li>
            <li class="active"><?php echo $this->lang->line('Manage_post_label'); ?></li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <!-- Your Page Content Here -->
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-xs-12">
               <div class="col-md-6">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title"><?php echo $page_title; ?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <?php echo $this->session->flashdata('message'); //pre($otherwork_master_detail); ?>
                <form role="form" method="post" action="<?php echo base_url()?>admin_notesheet_type_master/manage_notesheet_mastmenu<?php if(isset($id)){ echo '/'.$id;} ?>">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1"><?php echo $this->lang->line('label_section_id_hi'); ?><span class="text-danger">*</span></label>
                      <?php $section_list = get_list(SECTIONS, null, null); //pre($post_date['notesheet_menu_title_hi']);  ?>
                      <select class="form-control" name="section_id" id="section_id">
                          <option value=""><?php echo $this->lang->line('emp_designation_select_label'); ?></option>
                          <?php foreach ($section_list as $empk => $section) { ?>
                              <?php 
                              if($section['section_id']!=26){
                                  if (is_array($section)) { ?>
                                      <option value="<?php echo $section['section_id']; ?>" <?php if (@$otherwork_master_detail['section_id'] == $section['section_id']) 
                                      {
                                          echo 'selected';
                                      } 
                                      else if (@$post_date['section_id'] == $section['section_id']) 
                                      {
                                          echo 'selected';
                                      } ?> ><?php echo $section['section_name_hi']; ?> (<?php echo $section['section_name_en']; ?>) 
                                  <?php } ?>
                          <?php } } ?>
                      </select>
                      <?php echo form_error('section_id');?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1"><?php echo $this->lang->line('label_otherwork_hi'); ?><span class="text-danger">*</span></label>
                      <input type="text" name="notesheet_menu_title_hi" value="<?php echo (@$otherwork_master_detail['notesheet_menu_title_hi'] ? @$otherwork_master_detail['notesheet_menu_title_hi']:@$post_date['notesheet_menu_title_hi']);?>" class="form-control">
                      <?php echo form_error('notesheet_menu_title_hi');?>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1"><?php echo $this->lang->line('label_otherwork_en'); ?></label>
                      <input type="text" name="notesheet_menu_title_en" value="<?php echo (@$otherwork_master_detail['notesheet_menu_title_en'] ? @$otherwork_master_detail['notesheet_menu_title_en']:@$post_date['notesheet_menu_title_en']);?>" class="form-control">
                      <input type="hidden" name="notesheet_status" value="<?php echo (@$otherwork_master_detail['notesheet_status'] ? @$otherwork_master_detail['notesheet_status']:1);?>">
					 <?php echo form_error('notesheet_menu_title_en');?>
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
    