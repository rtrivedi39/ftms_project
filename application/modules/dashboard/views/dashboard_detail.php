<?php $view_role = viewDashboardRole($this->session->userdata('user_role')); 
$role_id = checkUserrole() ?>

<section class="content-header">
	<div  style="float:left;">
 	
	<div  style="float:left;">
           <?php if(end($this->uri->segments)=='establishment'){ ?>
		<h1><?php echo $this->lang->line('title') ?></h1>
			<?php }else if(end($this->uri->segments)=='reports'){  ?>
			<h1>Reports</h1>
		<?php } ?>	
	</div>
	
		
	</div>
	<div style="float:right;margin-top: 30px;"> <button class="btn btn-warning" onclick="goBack()">पिछले पेज में वापस जायें</button></div>
   
   <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <?php if(end($this->uri->segments)=='establishment'){ ?>
			<li class="active">Establishment</li>
		<?php }else if(end($this->uri->segments)=='reports'){  ?>
			<li class="active">Reports</li>
		<?php } ?>
      </ol>
   
   <div style="clear:both"></div>  
</section>

<!-- Main content -->
<section class="content">
<?php if($role_id == 1 || $role_id == 3 || $role_id == 4 || $role_id == 5 ) { ?>
	<div class="row">
		<?php if(end($this->uri->segments)=='establishment'){ ?>
			<div class="col-lg-4 col-xs-6">
			  <!-- small box -->
			  <div class="small-box bg-aqua">
				<div class="inner">
					  <h3>Employee List</h3>
					  <p>View all employees</p>
				</div>
				<div class="icon">
					<i class="fa fa-paw"></i>
				</div>
				<a class="small-box-footer" href="<?php echo base_url(); ?>leave/employee_list">
				  Click to view more info. <i class="fa fa-arrow-circle-right"></i>
				</a>
			  </div>
			</div><!-- ./col -->
			<div class="col-lg-4 col-xs-6">
			  <!-- small box -->
			  <div class="small-box bg-green">
				<div class="inner">
				  <h3>Department Structure</h3>
				  <p>View Department Structure</p>
				</div>
				<div class="icon">
				  <i class="ion ion-settings"></i>
				</div>
				<a class="small-box-footer" href="<?php echo base_url(); ?>admin/department_structure">
				  Click to view more info. <i class="fa fa-arrow-circle-right"></i>
				</a>
			  </div>
			</div><!-- ./col -->
			<div class="col-lg-4 col-xs-6">
			  <!-- small box -->
			  <div class="small-box bg-yellow">
				<div class="inner">
				  <h3>Employee Activity</h3>
				  <p>Show Employee List</p>
				</div>
				<div class="icon">
				  <i class="ion ion-clipboard"></i>
				</div>
				<a class="small-box-footer" href="<?php echo base_url(); ?>user_activity">
				  Click to view more info. <i class="fa fa-arrow-circle-right"></i>
				</a>
			  </div>
			</div><!-- ./col -->
		<?php } if(end($this->uri->segments)=='reports'){ ?>	
		<!--<div class="col-lg-4 col-xs-6">
		  <div class="small-box bg-red">
			<div class="inner">
			  <h3>Leave Report</h3>
			  <p>View Leave report Monthly/Yearly/Weekly</p>
			</div>
			<div class="icon">
			  <i class="ion ion-connection-bars"></i>
			</div>
			<a class="small-box-footer" href="<?php // echo base_url(); ?>leave/leave_report">
			  Click to view more info. <i class="fa fa-arrow-circle-right"></i>
			</a>
		  </div>
		</div>-->
		<div class="col-lg-4 col-xs-6">
		  <!-- small box -->
		  <div class="small-box bg-blue">
			<div class="inner">
			  <h3>Officer Reports</h3>
			  <p>View file report for officer level</p>
			</div>
			<div class="icon">
			  <i class="ion ion-pie-graph"></i>
			</div>
			<a class="small-box-footer" href="<?php echo base_url(); ?>officer_employee_report/officer">
			  Click to view more info. <i class="fa fa-arrow-circle-right"></i>
			</a>
		  </div>
		</div><!-- ./col -->
		<!--<div class="col-lg-4 col-xs-6">
		  <div class="small-box bg-green">
			<div class="inner">
			  <h3>SO/DA Reports</h3>
			  <p>View file report for Section officer or Dealing Asistant level</p>
			</div>
			<div class="icon">
			  <i class="ion ion-levels"></i>
			</div>
			<a class="small-box-footer" href="<?php //echo base_url(); ?>#">
			  Click to view more info. <i class="fa fa-arrow-circle-right"></i>
			</a>
		  </div>
		</div>-->
		<!-- ./col -->
		<!---<div class="col-lg-4 col-xs-6">
		  <div class="small-box bg-green">
			<div class="inner">
			  <h3>All Section Reports</h3>
			  <p>View all file status report</p>
			</div>
			<div class="icon">
			  <i class="ion ion-levels"></i>
			</div>
			<a class="small-box-footer" href="<?php echo base_url(); ?>report/file_report">
			  Click to view more info. <i class="fa fa-arrow-circle-right"></i>
			</a>
		  </div>
		</div>-->
		
		<div class="col-lg-4 col-xs-6">
		  <!-- small box -->
		  <div class="small-box bg-yellow">
			<div class="inner">
			  <h3>Date wise report</h3>
			  <p>View all section reports with date wise</p>
			</div>
			<div class="icon">
			  <i class="ion ion-levels"></i>
			</div>
			<a class="small-box-footer" href="<?php echo base_url(); ?>reports">
			  Click to view more info. <i class="fa fa-arrow-circle-right"></i>
			</a>
		  </div>
		</div><!-- ./col -->
		
		<!--<div class="col-lg-4 col-xs-6">
		  <div class="small-box bg-aqua">
			<div class="inner">
			  <h3>Employee report</h3>
			  <p>View all employee reports with date wise</p>
			</div>
			<div class="icon">
			  <i class="ion ion-levels"></i>
			</div>
			<a class="small-box-footer" href="<?php // echo base_url(); ?>activity_report/employee_report">
			  Click to view more info. <i class="fa fa-arrow-circle-right"></i>
			</a>
		  </div>
		</div>-->
		<div class="col-lg-4 col-xs-6">
		  <!-- small box -->
		  <div class="small-box bg-green">
			<div class="inner">
			  <h3>Individual Reports</h3>
			  <p>view all woking files</p>
			</div>
			<div class="icon">
			  <i class="ion ion-levels"></i>
			</div>
			<a class="small-box-footer" href="<?php echo base_url(); ?>individual_reports">
			  Click to view more info. <i class="fa fa-arrow-circle-right"></i>
			</a>
		  </div>
		</div><!-- ./col -->
		<?php } ?>
	</div>
	<div style="clear:both"></div>
<?php } ?>
    </section><!-- /.content -->





