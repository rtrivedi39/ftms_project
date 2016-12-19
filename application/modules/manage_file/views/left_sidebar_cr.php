 <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
              <?php if(!empty($this->session->userdata('admin_image'))){ ?>
              <img src="../uploads/employee/<?php echo $this->session->userdata('admin_image') ?>" class="img-circle" alt="User Image" />
              <?php 
            }else{ 
              ?>
               <img src="<?php echo ADMIN_THEME_PATH; ?>dist/img/avatar5.png" class="img-circle" alt="User Image" />
           <?php    } ?>
             
            </div>
            <div class="pull-left info">
              <p><?php echo ucfirst($this->session->userdata('emp_full_name'));?></p>
              <!-- Status -->
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

          <!-- search form (Optional) -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header">Main navigation</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="<?php echo base_url();?>/dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            <li class=""><a href="<?php echo base_url();?>dashboard/add_new_file"><i class="fa fa-plus"></i> <span>Add file</span></a></li>
            <li class=""><a href="<?php echo base_url();?>dashboard/show_file"><i class="fa fa-th"></i> <span>File List</span></a></li>
            <li class="treeview">
              <a href="#"><i class='fa fa-link'></i> <span>Commons</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="#"><?php echo $this->lang->line('department_manue');?></a></li>
              </ul> 
            </li>
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>