<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Profile
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Profile</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <!-- Your Page Content Here -->
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-10 col-xs-10">
              <!-- small box -->
               <div class="box box-warning">
              
                <div class="box-body col-lg-6">
                   <?php if($this->session->flashdata('update')){

                    ?>  <div class="alert alert-success alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <strong><?php  echo $this->session->flashdata('update'); ?></strong><br>
                  <?php echo validation_errors(); ?>
                  </div>
                    <?php
                     
                  }?>
                  <form role="form" method="post"  enctype="multipart/form-data" action="<?php echo site_url() ?>admin/admin_dashboard/updateProfile">
                    <input type="hidden" name="edit_id" value="<?php echo  isset($userdata[0]->emp_id) ? $userdata[0]->emp_id : ''; ?>" > 
                     <div class="form-group">
                      <label>Full Name</label>
                      <input type="text" value="<?php echo isset($userdata[0]->emp_full_name) ? $userdata[0]->emp_full_name : ''; ?>" class="form-control" name="emp_name" id="emp_name"  placeholder="Enter ..."/>
                    </div>
                    <!-- text input -->
                    <div class="form-group">
                      <label>Email</label>
                      <input type="text" value="<?php echo isset($userdata[0]->emp_email)?$userdata[0]->emp_email:''; ?>" class="form-control" name="email" id="email"  placeholder="Enter ..."/>
                    </div>
                    <div class="form-group">
                      <label>Mobile</label>
                      <input type="text" value="<?php echo isset($userdata[0]->emp_mobile_number)?$userdata[0]->emp_mobile_number :''; ?>" class="form-control" placeholder="Enter ..." name="mobile" id="mobile" />
                    </div>
                    <div class="form-group col-lg-4">
                      <label>Upload Image</label>
                       <input type="file" name="userfile"  />
                     </div>
                    <div class="form-group pull-right" >
                      <?php if(!empty($userdata[0]->emp_image)){ ?>
                       <img src="../uploads/employee/<?php echo $userdata[0]->emp_image ?>"   height="150" width="100">
                       <?php } ?>
                    </div>
                   <div style="clear:both"> </div>
                    <div class="form-group col-lg-4 pull-right">
                      <button type="submit" class="btn btn-block btn-primary">Update</button>                 
                    </div>     
                 </div>
               </div>
              </div>
            </div><!-- ./col -->
            </div>
          </div> 
           
          
          <!-- Main row -->



        </section><!-- /.content -->