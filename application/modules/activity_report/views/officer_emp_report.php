<link href="<?php echo ADMIN_THEME_PATH; ?>plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo $title; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo $title; ?></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Your Page Content Here -->
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box" style="overflow: auto">
                <div class="box-header">
                    <div style="float:left"><h3 class="box-title"><?php echo $title_tab;?></h3></div>
                    <div style="float:right">
                        <!--<button class="btn btn-block btn-info"><?php echo $this->lang->line('view_file_mark');?></button>-->
                        <!--<a class="btn btn-info"><?php echo $this->lang->line('view_file_mark');?></a>-->
                        <button class="btn btn-warning" onclick="goBack()"><?php echo $this->lang->line('Back_button_label'); ?></button>
                    </div>
                    <br/>
            </div><!-- /.box-header -->
			<div class="box-body">
				<div style="padding:10px 2px 1px 10px" class="callout callout-danger lead"><h4>Under Secretary( अवर सचिव)</h4></div>
                <?php // echo $this->session->flashdata('message'); ?>
                <?php if($this->session->flashdata('message') || $this->session->flashdata('error')) {
                    $msg = $this->session->flashdata('message') ? 'success' : 'danger';
                    ?>
                    <div class="alert alert-<?php echo $msg; ?> alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>
                            <?php  echo $this->session->flashdata('message');
                            echo $this->session->flashdata('error'); ?>
                        </strong>
                        <br/>
                    </div>
                <?php } ?>
				
                <div class="box-body" align="left">
				<!--Under Secretary List-->
					<div class="row">
						<?php //pre($employees_list); 
						foreach($employees_list as $ky=>$elist){ ?>
							<div class="col-md-3 col-sm-6 col-xs-12">
							  <div class="info-box bg-aqua">
								<span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>
								<div class="info-box-content">
								  <span class="info-box-text">
									<?php echo get_employee_gender($elist['emp_id'],true);?>
									  <?php echo $elist['emp_full_name_hi'] ?> <br/>(<?php echo get_employee_gender($elist['emp_id'],false).' '.$elist['emp_full_name'] ?>)</span>
										<span class="info-box-number">
										  <?php 
											$total_files_works= total_work_by_officer_emp('count_total_file_works',$elist['emp_id'],null);
											$total_pending_file= total_work_by_officer_emp('total_pending_file',$elist['emp_id'],null);
											$total_close_file= total_work_by_officer_emp('total_close_file',$elist['emp_id'],null);
										  ?>
										  
										  <?php echo $total_files_works['total_file_works'];?>
										  <div style="float:right">
											<a href="<?php echo base_url().'reports/moniter?empid='.$elist['emp_id']; ?>&s=not&lvl=view_ofcr_deald_files" class="small-box-footer">
											  View Files
											</a>
										  </div>
										</span>
								  <div class="progress">
									<div class="progress-bar" style="width: 70%"></div>
								  </div>
								  <span class="progress-description">
									
								  </span>
								  
								</div><!-- /.info-box-content -->
							 
							 </div><!-- /.info-box -->
							</div><!-- /.col -->
						<?php } ?>
					  </div>
					  <!--Deputy Secretary List-->
					  <div style="padding:10px 2px 1px 10px" class="callout callout-danger lead"><h4>Deputy Secretary (उप सचिव)</h4></div>
						<div class="row">
							<?php foreach($deputy_secratory_list as $ky=>$elist){ ?>
							<div class="col-md-3 col-sm-6 col-xs-12">
							  <div class="info-box bg-aqua">
								<span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>
								<div class="info-box-content">
								  <span class="info-box-text">
									<?php echo get_employee_gender($elist['emp_id'],true);?>
									  <?php echo $elist['emp_full_name_hi'] ?> <br/>(<?php echo get_employee_gender($elist['emp_id'],false).' '.$elist['emp_full_name'] ?>)</span>
								  <span class="info-box-number">
									  <?php 
										$total_files_works= total_work_by_officer_emp('count_total_file_works',$elist['emp_id'],null);
										$total_pending_file= total_work_by_officer_emp('total_pending_file',$elist['emp_id'],null);
										$total_close_file= total_work_by_officer_emp('total_close_file',$elist['emp_id'],null);
									  ?>
									  <?php echo $total_files_works['total_file_works'];?>
										<div style="float:right">
											<a href="<?php echo base_url().'reports/moniter?empid='.$elist['emp_id']; ?>&s=not&lvl=view_ofcr_deald_files" class="small-box-footer">
												View Files
											</a>
										</div>
									  </span>
								  <div class="progress">
									<div class="progress-bar" style="width: 70%"></div>
								  </div>
								  <span class="progress-description">
									
								  </span>
								  
								</div><!-- /.info-box-content -->
							  </div><!-- /.info-box -->
							</div><!-- /.col -->
						<?php } ?>
						</div>
					  <!--Additional Secretary List-->
					  <div style="padding:10px 2px 1px 10px" class="callout callout-danger lead"><h4>Additional Secretary (अतिरिक्त सचिव)</h4></div>
                      <div class="row">
						  <?php foreach($additional_secratory_list as $ky=>$elist){ ?>
							<div class="col-md-3 col-sm-6 col-xs-12">
							  <div class="info-box bg-aqua">
								<span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>
								<div class="info-box-content">
								  <span class="info-box-text">
									<?php echo get_employee_gender($elist['emp_id'],true);?>
									  <?php echo $elist['emp_full_name_hi'] ?> <br/>(<?php echo get_employee_gender($elist['emp_id'],false).' '.$elist['emp_full_name'] ?>)</span>
								  <span class="info-box-number">
									  <?php 
										$total_files_works= total_work_by_officer_emp('count_total_file_works',$elist['emp_id'],null);
										$total_pending_file= total_work_by_officer_emp('total_pending_file',$elist['emp_id'],null);
										$total_close_file= total_work_by_officer_emp('total_close_file',$elist['emp_id'],null);
									  ?>
									  <?php echo $total_files_works['total_file_works'];?>
										<div style="float:right"><a href="<?php echo base_url().'reports/moniter?empid='.$elist['emp_id']; ?>&s=not&lvl=view_ofcr_deald_files" class="small-box-footer">View Files</a></div>
									  </span>
								  <div class="progress">
									<div class="progress-bar" style="width: 70%"></div>
								  </div>
								  <span class="progress-description">
									
								  </span>
								  
								</div><!-- /.info-box-content -->
							  </div><!-- /.info-box -->
							</div><!-- /.col -->
						<?php } ?>
						</div>
						<!--Secretary List-->
						<div style="padding:10px 2px 1px 10px" class="callout callout-danger lead"><h4>Secretary ( सचिव)</h4></div>
						  <div class="row">
							  <?php foreach($secratory_list as $ky=>$elist){ ?>
								<div class="col-md-3 col-sm-6 col-xs-12">
								  <div class="info-box bg-aqua">
									<span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>
									<div class="info-box-content">
									  <span class="info-box-text">
										<?php echo get_employee_gender($elist['emp_id'],true);?>
										  <?php echo $elist['emp_full_name_hi'] ?> <br/>(<?php echo get_employee_gender($elist['emp_id'],false).' '.$elist['emp_full_name'] ?>)</span>
									  <span class="info-box-number">
										  <?php 
											$total_files_works= total_work_by_officer_emp('count_total_file_works',$elist['emp_id'],null);
											$total_pending_file= total_work_by_officer_emp('total_pending_file',$elist['emp_id'],null);
											$total_close_file= total_work_by_officer_emp('total_close_file',$elist['emp_id'],null);
										  ?>
										  <?php echo $total_files_works['total_file_works'];?>
											<div style="float:right"><a href="<?php echo base_url().'reports/moniter?empid='.$elist['emp_id']; ?>&s=not&lvl=view_ofcr_deald_files" class="small-box-footer">View Files</a></div>
										  </span>
									  <div class="progress">
										<div class="progress-bar" style="width: 70%"></div>
									  </div>
									  <span class="progress-description">
										
									  </span>
									  
									</div><!-- /.info-box-content -->
								  </div><!-- /.info-box -->
								</div><!-- /.col -->
							<?php } ?>
							</div>
							<!--Principal Secretary-->
							<div style="padding:10px 2px 1px 10px" class="callout callout-danger lead">
								<h4>Principal Secretary (प्रमुख सचिव) </h4>
							</div>
							<div class="row">
							  <?php foreach($pricipal_secratory_list as $ky=>$elist){ ?>
								<div class="col-md-3 col-sm-6 col-xs-12">
								  <div class="info-box bg-aqua">
									<span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>
									<div class="info-box-content">
									  <span class="info-box-text">
										<?php echo get_employee_gender($elist['emp_id'],true);?>
										  <?php echo $elist['emp_full_name_hi'] ?> <br/>(<?php echo get_employee_gender($elist['emp_id'],false).' '.$elist['emp_full_name'] ?>)</span>
									  <span class="info-box-number">
										  <?php 
											$total_files_works= total_work_by_officer_emp('count_total_file_works',$elist['emp_id'],null);
											$total_pending_file= total_work_by_officer_emp('total_pending_file',$elist['emp_id'],null);
											$total_close_file= total_work_by_officer_emp('total_close_file',$elist['emp_id'],null);
										  ?>
										  <?php echo $total_files_works['total_file_works'];?>
											<div style="float:right"><a href="<?php echo base_url().'reports/moniter?empid='.$elist['emp_id']; ?>&s=not&lvl=view_ofcr_deald_files" class="small-box-footer">View Files</a></div>
										  </span>
									  <div class="progress">
										<div class="progress-bar" style="width: 70%"></div>
									  </div>
									  <span class="progress-description">
										
									  </span>
									  
									</div><!-- /.info-box-content -->
								  </div><!-- /.info-box -->
								</div><!-- /.col -->
							<?php } ?>
							</div>
					  <div  style="text-align: justify; width: 90%">
                        <?php 
						$grand_total = $dispached_files = 0; $i=1; 
						/*
						foreach($get_section as $sec){
                            if($sec['section_id'] != '26' && $sec['section_id'] != '1' && $sec['section_id'] != '8'){
                                $sce_id = $sec['section_id'];
								$section = get_list(SECTIONS,null,array('section_id' =>$sce_id ));
								$query = $this->db->query("select count(file_id) as counts FROM ft_files where `file_mark_section_id`='".$sce_id."' and `file_return` !='2' and (file_hardcopy_status = 'received' or file_hardcopy_status = 'working')");
								$res1 =  $query->row_array();
								$query = $this->db->query("select count(file_id) as counts FROM ft_files where `file_mark_section_id`='".$sce_id."' and `file_return` !='2' and (file_hardcopy_status = 'not')");
								$res2 =  $query->row_array();
								$query = $this->db->query("select count(file_id) as counts FROM ft_files where `file_mark_section_id`='".$sce_id."' and `file_return` ='2'");
								$res3 =  $query->row_array();
								$total = $res1['counts'] + $res2['counts'] + $res3['counts'];
								if ($total > 0) { 
									$cls = "aqua"; 
								}else{
									$cls = "red"; 
								}
								$grand_total = 	$grand_total + $total;							 
								$dispached_files = 	$dispached_files + $res3['counts'];
								*/
								?>
								<!--<a href="activity_report/fetch_data/<?php echo $sec['section_id'] ; ?>">
									<div class="col-md-4 col-sm-6 col-xs-12" data-original-title="<?php echo $sec['section_name_en'] ; ?>" data-toggle="tooltip">
										<div class="info-box bg-<?php echo $cls; ?>">
										<span class="info-box-icon"><i class="fa fa-files-o"></i></span>
										<div class="info-box-content">
										  <span class="info-box-text"><?php echo $sec['section_name_hi'] ; ?></span>
										  <span class="info-box-number"><b><?php echo $total ; ?> File(s)</b></span>
										  <div class="progress">
											<div style="width: <?php echo ($res3['counts'] * 100)/$total; ?>%" class="progress-bar"></div>
										  </div>
										  <span class="progress-description">
											<?php echo $res3['counts']  ; ?> File(s) Dispatched 
										  </span>
										</div>
									  </div>
								  </div>
								</a>-->
                            <?php //$i++; } 
						//}?>
                      </div>
                </div>
				<!--<div class="box-footer">
					<div class="col-md-4 col-sm-6 col-xs-12">
					  <div class="info-box">
						<span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>
						<div class="info-box-content">
						  <span class="info-box-text">Total files</span>
						  <span class="info-box-number"><?php echo $grand_total; ?></span>
						</div>
					  </div>
					</div>
					<div class="col-md-4 col-sm-6 col-xs-12">
					  <div class="info-box">
						<span class="info-box-icon bg-green"><i class="fa fa-files-o"></i></span>
						<div class="info-box-content">
						  <span class="info-box-text">Total Dispatched files</span>
						  <span class="info-box-number"><?php echo $dispached_files; ?></span>
						</div>
					  </div>
					</div>
					<div class="col-md-4 col-sm-6 col-xs-12">
					  <div class="info-box">
						<span class="info-box-icon bg-red"><i class="fa fa-files-o"></i></span>
						<div class="info-box-content">
						  <span class="info-box-text">Total pending files</span>
						  <span class="info-box-number"><?php echo $grand_total-$dispached_files; ?></span>
						</div>
					  </div>
					</div>
				</div>-->
            </div><!-- /.box-body -->
        </div><!-- /.box -->
        <div id="display" align="left"></div>
    </div>
    </div><!-- /.row -->
    <!-- Main row -->
</section><!-- /.content -->
<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>

<script type="text/javascript">
        function open_div(file) {
            var test = file;
            var HTTP_PATH = '<?php echo base_url(); ?>';
            var dataString = 'content=' + test;
            $.ajax({
                type: "POST",
                url: HTTP_PATH + "activity_report/fetch_data/" + test,
                data: dataString,
                cache: false,
                success: function (html) {
                    $("#display").html(html);
                }
            });
            return false;
        }
</script>