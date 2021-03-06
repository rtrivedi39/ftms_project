<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo $title; ?>
            <!--<small>Optional description</small>-->
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url().'dashboard' ?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
			<li><a href="<?php echo base_url('admin'); ?>/department"> <?php echo $title; ?></a></li>
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
                    <h3 class="box-title"><?php echo $title_tab; ?></h3>
                </div><!-- /.box-header -->
                 <!-- form start -->
                <form role="form" method="post" action="<?php echo site_url(); ?>admin/admin_department/addUpdatedepartment<?php if(isset($dpid)){ echo '/'.$dpid;} ?>">
                   <input type="hidden" value="<?php echo isset($departmentdata['dept_id'])? $departmentdata['dept_id'] :''; ?>"  name="dept_id" id="dept_id" class="form-control">
                    <div class="box-body">
                    <div class="form-group">
                      <label for="department_Name"><?php echo $this->lang->line('add_department_hi'); ?></label>
                      <input type="text" value="<?php echo isset($departmentdata['dept_name_hi'])? $departmentdata['dept_name_hi'] :''; ?>" placeholder="<?php echo $this->lang->line('add_department_hi'); ?>" name="dept_name_hi" id="dept_name_hi" class="form-control" required="">
                        <?php echo form_error('dept_name_hi');?>
                     </div>
                    <div class="form-group">
                      <label for="Department_Name_eng"><?php echo $this->lang->line('add_department_en'); ?></label>
                      <input type="text" value="<?php echo isset($departmentdata['dept_name_en'])? $departmentdata['dept_name_en'] :''; ?>" placeholder="<?php echo $this->lang->line('add_department_en'); ?>" name="dept_name_en" id="dept_name_en" class="form-control" >
                        <?php echo form_error('dept_name_en');?>
                    </div>
					<div class="form-group">
                      <label for="Department_Name_eng"><?php echo $this->lang->line('officer_name'); ?></label>
                      <input type="text" value="<?php echo isset($departmentdata['dept_officer_nm'])? $departmentdata['dept_officer_nm'] :''; ?>" placeholder="<?php echo $this->lang->line('officer_name'); ?>" name="dept_officer_nm" id="dept_officer_nm" class="form-control">
                        <?php echo form_error('dept_officer_nm');?>
                    </div>
					<div class="form-group">
                      <label for="Department_Name_eng"><?php echo $this->lang->line('officer_number'); ?></label>
                      <input type="text" value="<?php echo isset($departmentdata['dept_officer_number'])? $departmentdata['dept_officer_number'] :''; ?>" placeholder="<?php echo $this->lang->line('officer_number'); ?>" name="dept_officer_number" id="dept_officer_number" class="form-control" >
                        <?php echo form_error('dept_name_en');?>
                    </div>
					<div class="form-group">
                      <label for="Department_Name_eng"><?php echo $this->lang->line('officer_email'); ?></label>
                      <input type="text" value="<?php echo isset($departmentdata['dept_officer_email'])? $departmentdata['dept_officer_email'] :''; ?>" placeholder="<?php echo $this->lang->line('officer_email'); ?>" name="dept_officer_email" id="dept_officer_email" class="form-control" >
                        <?php echo form_error('dept_officer_email');?>
                    </div>
					<div class="form-group">
                      <label for="Department_default_code"><?php echo $this->lang->line('department_default_no'); ?></label>
                      <input type="text" value="<?php echo isset($departmentdata['department_default_no'])? $departmentdata['department_default_no'] :''; ?>" placeholder="<?php echo $this->lang->line('department_default_no'); ?>" name="dept_default_code" id="dept_default_code" class="form-control" >
                        
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
    