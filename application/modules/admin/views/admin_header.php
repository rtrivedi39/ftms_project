<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <meta charset="UTF-8">
    <title>FTMS </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo ADMIN_THEME_PATH; ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <!--<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />-->
     <link href="<?php echo base_url(); ?>themes/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <!--<link href="<?php //echo ADMIN_THEME_PATH; ?>extra/css/ionicons.min.css" rel="stylesheet" type="text/css" />-->
    <!--<link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />-->
	<link href="<?php echo base_url(); ?>themes/ionicons/css/ionicons.min.css" rel="stylesheet" type="text/css" />

	
	<!--<link type="text/css" rel="stylesheet" href="<?php //echo base_url(); ?>themes/admin/plugins/iCheck/all.css">-->
    <link href="<?php echo base_url(); ?>themes/style.css" rel="stylesheet" type="text/css" />	
  <!--Data Table CSS-->
     <!-- DATA TABLES -->
    <link href="<?php echo ADMIN_THEME_PATH; ?>plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo ADMIN_THEME_PATH; ?>plugins/datatables/dataTables.tableTools.min.css" rel="stylesheet" type="text/css" />

    <!-- Theme style -->
    <link href="<?php echo ADMIN_THEME_PATH; ?>dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!--Text Slider-->
	<link href="<?php echo ADMIN_THEME_PATH; ?>bootstrap/css/text_slider.css" rel="stylesheet" type="text/css" />
    <!--End Text Slider-->	
	<!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link href="<?php echo ADMIN_THEME_PATH; ?>dist/css/skins/skin-blue.min.css" rel="stylesheet" type="text/css" />
	<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
  </head>
  <!--
  BODY TAG OPTIONS:
  =================
  Apply one or more of the following classes to get the
  desired effect
  |---------------------------------------------------------|
  | SKINS         | skin-blue                               |
  |               | skin-black                              |
  |               | skin-purple                             |
  |               | skin-yellow                             |
  |               | skin-red                                |
  |               | skin-green                              |
  |---------------------------------------------------------|
  |LAYOUT OPTIONS | fixed                                   |
  |               | layout-boxed                            |
  |               | layout-top-nav                          |
  |               | sidebar-collapse                        |
  |               | sidebar-mini                            |
  |---------------------------------------------------------|
  -->
  <?php 
  authorize();
    $is_emp_first_login =  $this->session->userdata("emp_first_login");
	//$userrole = checkUserrole(); 
	$emp_session_id=emp_session_id();
	// Check login employee role
	if($emp_session_id == $this->session->userdata('emp_id')){
		$userrole = $this->session->userdata('user_role');
	} else{				
		$userrole = checkUserrole_by_id($emp_session_id,true);
	}
    ?>
 <body class="skin-blue sidebar-mini <?php //if($userrole==3){ echo 'sidebar-collapse';  } ?>"> 
    <div class="wrapper">
      <!-- Main Header -->
      <header class="main-header">
        <!-- Logo -->
		<?php 
		if($userrole == 1){
			?>
			  <a href="<?php echo base_url(); ?>dashboard" class="logo">
			<?php 
		}else{
		?>
        <a href="<?php echo base_url()?>dashboard" class="logo">
		<?php } ?>
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini">DSH</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b><?php echo $this->session->userdata('emp_unique_id'); ?></b></span>
        </a>
        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
		  <?php  $marked_file = current_pending_files(null,true); ?>
		   <?php if(!in_array($userrole, array(39,9))){ ?>
		  <div class="navbar-custom-menu pull-left">
              <ul class="nav navbar-nav" style="font-family: cursive;">
                  <li>
                      <a href="javascript:void(0)" onclick="show_current_file(null,true)" title="Current Pending File..">
                          <b><?php   echo $marked_file['files_no']; ?> <i class="fa fa-fw fa-arrow-left shake"></i></b>
                      </a>
                  </li>                  
                  <?php $notic_detail= get_row("select notice_subject,notice_description,notice_attachment from ft_notice_board  where emp_id='151' and notice_is_active='1' and notice_trash='0' order by notice_id desc limit 0,1"); ?>
                  <?php if(isset($notic_detail) && !empty($notic_detail)){ ?>
				  <li> 
                      <a <?php if($notic_detail['notice_attachment']==''){?> href="javascript:void(0)"<?php }else { ?> href="<?php echo base_url();?>/uploads/notice/<?php echo $notic_detail['notice_attachment']; ?>" target="_blank" <?php } ?>>
                         <span class="blink_me" data-placement="bottom"  data-toggle="tooltip" title="<?php echo $notic_detail['notice_description'];?>" style="color:#fff"><img src="<?php echo base_url(); ?>/themes/site/images/gif-new.gif"> नोटिस :  <?php  echo word_limiter($notic_detail['notice_subject'],11,' ').'...';?></span>
                      </a>
                  </li>
                  <?php } ?>
              </ul>
              </div>
			  <?php } ?>
          <div class="navbar-custom-menu">
			<ul class="nav navbar-nav" style="font-family: cursive;">
                  <li>
                      <a href="<?php echo base_url(); ?><?php echo in_array($userrole, array(1,2,3,4,5)) ? 'dashboard#pending_file' : 'individual_reports' ; ?>" title="Pending files">
						<i class="fa fa-files-o"></i>
						<span class="label label-danger blink_me" style="top:27px">लंबित नस्तियां </span>						
                      </a>
                  </li>
              </ul>
              <?php $arr_ps_count = ps_monitor_marked_report(null,"today",emp_session_id());
              $emp = '';
              if($userrole  != 3){
                  $emp = "?empid=".$emp_session_id;
              }
              if($arr_ps_count > 0){ ?>
              <ul class="nav navbar-nav" style="font-family: cursive;">
                  <li>
                      <a href="<?php echo base_url(); ?>ps_file_monitor<?php echo $emp; ?>" title="PS Monitor Pending File No.">
                          <span class="label label-warning blink_fast" >PS Monitor Pending File No.</span>
                          <?php echo "<b>".$arr_ps_count."</b>" ; ?>
                      </a>
                  </li>
              </ul>
              <?php } ?>
            <ul class="nav navbar-nav">
            <?php if($userrole  != 3){ // PS supervisour
			  $user_supervisor = get_user_supervisor();
              if(!empty($user_supervisor)){ ?>
                <li class="dropdown messages-menu">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#" title="Lists of Supervisor">
                  <i class="fa fa-user"></i>
                  <span class="label label-success" ><?php echo count($user_supervisor); ?></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">Supervisor list</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                        <ul class="menu">
                            <?php foreach($user_supervisor as $row) { ?>
                      <li><!-- start message -->
                        <a href="#">
                          <div class="pull-left">
                                    <?php  if(!empty($row->emp_image)){ ?>
                                        <img alt="User Image" class="img-circle" src="<?php echo USR_IMG_PATH.$row->emp_image ?>">
                                    <?php } else{ ?>
                                        <img alt="User Image" class="img-circle" src="<?php echo ADMIN_THEME_PATH; ?>dist/img/avatar5.png">
                                    <?php } ?>                                  
                          </div>
                          <h4>
                                  <?php echo $row->emp_full_name;  ?>
                                  <small><i class="fa  fa-times-circle-o"></i> <?php echo $row->emp_unique_id;  ?></small>
                          </h4>
                                 <p><?php echo $row->emprole_name_hi;   ?></p>
                        </a>
                      </li><!-- end message -->
                            <?php } ?>
                        </ul>                  
                  </li>
                  <li class="footer"><a href="#">...</a></li>
                </ul>
              </li>
            <?php } ?>
            <?php } // PS supervisour?>
              <?php
              $emp_session_section = $this->session->userdata("emp_section_id");
              if(!empty($emp_session_section)){
                  $emp_sections = getSectionData(explode(',',$emp_session_section));
                  ?>
              <li class="dropdown messages-menu">
                      <a data-toggle="dropdown" class="dropdown-toggle" href="#" title="Lists of Sections Alloted">
                          <i class="fa fa-tree"></i>
                          <span class="label label-success" ><?php echo count($emp_sections); ?></span>
                      </a>
                      <ul class="dropdown-menu">
                            <li class="header">Allotted sections lists</li>
                            <li>
                              <ul class="menu">
                                <?php
                                    foreach ($emp_sections as $row) {
									$section_details = $row->section_name_hi.'('.$row->section_name_en.')';
									//pr($section_details);
                                    ?>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-institution  text-red"></i> 
                                            <span data-original-title="<?php echo $section_details?>" data-toggle="tooltip" title="">
                                              <?php echo $section_details?>
                                            </span>
                                        </a>
                                    </li>
                                <?php } ?>
                              </ul>
                            </li>
                            <li class="footer"><a href="#">...</a></li>
                      </ul>
                  </li>
            <?php } ?>
              <!-- Messages: style can be found in dropdown.less-->
             
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                   <?php  if(!empty($this->session->userdata('emp_image'))){ ?>
			<img src="<?php echo USR_IMG_PATH.$this->session->userdata('emp_image') ?>"  class="user-image" alt="User Image"  >
                       <?php } else{ ?>
                  <img src="<?php echo ADMIN_THEME_PATH; ?>dist/img/avatar5.png" class="user-image" alt="User Image"/>
                    <?php } ?>
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs"><?php echo $this->session->userdata('emp_full_name');?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <?php if(!empty($this->session->userdata('emp_image'))){ ?>
                   <img src="<?php echo USR_IMG_PATH.$this->session->userdata('emp_image') ?>"  class="img-circle" alt="User Image" >
                    <?php }else{ ?>
                    <img src="<?php echo ADMIN_THEME_PATH; ?>dist/img/avatar5.png" class="img-circle" alt="User Image" />
                    <?php } ?>
                    <p>					
                      <?php echo $this->session->userdata('emp_full_name');?> 
                       <small><?php //First login:- 
							//$log_data = get_user_log();
							//echo get_datetime_formate($log_data['log_create_date']);
                        ?>
                      
                      </small>
                    </p>
                  </li>
                  <!-- Menu Body -->                
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <?php if($is_emp_first_login==1){ ?>
                    <div class="pull-left">
                       <a href="<?php echo site_url(); ?>admin/profile" class="btn btn-default btn-flat">Profile</a>
                     </div>
                    <?php } ?>
                    <div class="pull-right">
                      <a href="<?php echo base_url()?>logout" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <!-- <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li> -->
            </ul>
          </div>
        </nav>
      </header>