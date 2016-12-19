
<?php
$userrole = checkUserrole();
$usersection = $this->session->userdata('emp_section_id');


?>

<div class="box">
	<div id="print-box">
	<div class="box-header">
		<h4 class="box-title">विधि विभाग, अनुभाग प्रदर्शन दिनांक <?php echo date('d.m.Y h:i:s A');?> तक</h4>
		<div class="box-tools pull-right no-print">
			<!--<button class="btn btn-block btn-info"><?php echo $this->lang->line('view_file_mark');?></button>-->
			<!--<a class="btn btn-info"><?php echo $this->lang->line('view_file_mark');?></a>-->
			<form role="form" method="post" action="<?php echo base_url()?>activity_report/datewise_report"  enctype="multipart/form-data">
				<input type="hidden" name="start_date" id="start_date" class="date_picker form-control" value="<?php echo get_date_formate($start_date, 'd-m-Y'); ?>" placeholder="Select enter date" class="form-control">
				<input type="hidden" name="end_date" id="end_date" class="date_picker form-control" value="<?php echo get_date_formate($end_date, 'd-m-Y'); ?>" placeholder="Select dispatch date" class="form-control">
				<div class="btn-group">
					<button class="btn btn-primary" type="submit">आज की स्थिति</button>
					<button class="btn btn-warning" onclick="goBack()"><?php echo $this->lang->line('Back_button_label'); ?></button>
					<button onclick="printContents('print-box')" class="btn btn-primary no-print">प्रिंट</button>
				</div>
			</form>	
		</div>
	</div><!-- /.box-header -->
	<div class="box-body">	
		<div class="row">
			<?php
			// pre fixws
			
				$fdis = file_dispatchre();
				
			$total_f = $grand_total = $dispach_files  = $dispached_files = 0; $i=1; 
			$height_worked = array();


		 
			
			//Count total no of files
				$grand_total = $fdis['counts'];
			//for dispatched out department
				$dispached_files_out = $fdis['not_section_dispose'];
			//for dispatched in department
				$dispached_files_dept = $fdis['section_dispose'];
			$dispached_files = $dispached_files_out + $dispached_files_dept ; 
				
			foreach($get_section as $sec){
				
				if(!in_array($sec['section_id'], array('26','1','25','20','28','23','21','8','27'))){
					$sce_id = $sec['section_id']; $from_section = '' ;
					//$section = get_list(SECTIONS,null,array('section_id' =>$sce_id ));
					
					if($sce_id == '20'){
						$allsectionresult =par_translation();
						
					// for translation
					
					} else if($sce_id == '28'){

						$allsectionresult =par_vettingen();	
						$from_section = ' in vetting english section';						
						//for vetting english
					
					} else { // for others
						
							$allsectionresult =parsentagsetion($sce_id );
							$from_section = ' in Drafting section';
					}
					$total =0;$close =0;
					
					foreach($allsectionresult as $nr){
					$total = $nr->counts + $total;
					$close = $nr->close +$close ;
						}
					if ($total > 0) {
						$cls = "aqua"; 
					}else{
						$cls = "red"; 
					}
					$total_f = $total_f + $total;
					 $dispached_files = $dispached_files + $close;
				?>
			
				<?php $percent_work = $total != 0 ? (int)(($close * 100)/$total) : 0;
				 $height_worked[$sec['section_id']] = $percent_work ; ?>
					<div class="col-md-4 col-sm-6 col-xs-12 sections-box" data-original-title="<?php echo $sec['section_name_en'] ; ?>" data-toggle="tooltip">
						<a href="<?php echo base_url(); ?>activity_report/fetch_data/<?php echo $sec['section_id'] ; ?>" class="">
						<div class="info-box bg-<?php echo $cls; ?>">
						<span class="info-box-icon"><?php echo $percent_work != '0' ?  (int)$percent_work : '-'; ?>%</span>
						<div class="info-box-content">
						  <span class="info-box-text"><?php echo $sec['section_name_hi'] ; ?></span>
						  <span class="info-box-number"><b><?php echo $total ; ?> File(s) Received </b></span>
						  <div class="progress">
							<div style="width: <?php echo $percent_work; ?>%" class="progress-bar"></div>
						  </div>
						  <span class="progress-description">
							<?php echo $close  ; ?> File(s) Dispatched 
						  </span>
						</div><!-- /.info-box-content -->
					  </div>
					  </a>
				  </div>
				
				<?php $i++; } 
				}
				//echo $total_f;
				?>
		
			<?php 
				if($userrole == 1 || $userrole == 3 ) {
					$final_total = $grand_total;
					$final_dispatch = $dispached_files;
					$heading = "विभाग में अभी तक आई फाइलें";
				} else{
					$final_total = $total_f;
					$final_dispatch = $dispach_files;
					$heading = "आपके अनुभाग में अभी तक आई फाइलें";
				}
			?>
		</div><!-- row -->
		<div class="row no-print">
			<div class="col-md-3 col-sm-6 col-xs-12 " data-original-title="अपनी रिपोर्ट देखे" data-toggle="tooltip">
				<a href="<?php echo base_url(); ?>individual_reports">
					<div class="info-box bg-yellow">
						<span class="info-box-icon"><i class="fa fa-file"></i></span>
						<div class="info-box-content">
						  <span class="info-box-text">Individual report</span>
						  <span class="info-box-number">Individual report</b></span>
					
						</div><!-- /.info-box-content -->
					</div>
				</a>
			</div>
			<?php //if($userrole == 1 || $userrole == 3){ ?>
			<div class="col-md-3 col-sm-6 col-xs-12 " data-original-title="रिपोर्ट देखे" data-toggle="tooltip">
				<a href="<?php echo base_url(); ?>work_done_report">
					<div class="info-box bg-yellow">
						<span class="info-box-icon"><i class="fa fa-file"></i></span>
						<div class="info-box-content">
						  <span class="info-box-text">Work report</span>
						  <span class="info-box-number">Work report</b></span>
					
						</div><!-- /.info-box-content -->
					</div>
				</a>
			</div>
			<?php //} ?>
		</div>		
		
		<hr class="clearfix no-print "/>
		<div class="row">
				
				<?php if($userrole == 1 || $userrole == 3  ) { 
						$qry_emp = $this->db->query("select group_concat(emp_id) as cr_emp from ft_employee where `role_id` = '9'");
						$result = $qry_emp->row_array();
						$emps = $result['cr_emp'];				
					//use for central receipt section 
						$query = $this->db->query("select count(*) as counts FROM ft_files UNION  
							SELECT count(*) as counts FROM ft_files_master where file_received_emp_id in(".$emps.") and (file_return = '1' or file_return = '3')");
						$return =  $query->row_array();					
						$percent_work = 100 - ($return['counts'] * 100)/$final_total; ?>
						
						<div class="col-md-6 col-sm-6 col-xs-12 sections-box happy" data-original-title="Central receipt" data-toggle="tooltip">
							<a href="<?php echo base_url(); ?>activity_report/fetch_data_cr">
							<div class="info-box bg-green">
							<span class="info-box-icon"><?php echo (int)$percent_work; ?>%</span>
							<div class="info-box-content">
							  <span class="info-box-text"><?php echo getSection('1'); ?></span>
							  <span class="info-box-number"><b><?php echo $final_total ; ?> File(s) received, <?php echo $final_total-$return['counts'];?>  File(s) distributed</b></span>
							  <div class="progress">
								<div style="width: <?php echo $percent_work; ?>%" class="progress-bar"></div>
							  </div>
							  <span class="progress-description">
								<?php echo $return['counts']  ; ?> File(s) return from section
							  </span>
							</div><!-- /.info-box-content -->
						  </div>
						  </a>
					  </div>
				<?php  } if($userrole == 1 || $userrole == 3 || ($userrole == 37 && $usersection = '8') ) { 
					 //use for dispatch section
							$res_dis1['counts'] = 0;
							$query = $this->db->query("select count(*) as counts FROM ft_files UNION  
							SELECT count(*) as counts FROM ft_files_master where file_hardcopy_status !='close' and `file_return` = '2' ");
							$res_dis2 =  $query->row_array();
							$query = $this->db->query("SELECT count(*) as counts FROM `ft_file_dispatch`");
							$res_dis3 =  $query->row_array();
							$total_dis = $res_dis1['counts'] + $res_dis2['counts'] + $res_dis3['counts'];
							$percent_work_dis =  ($res_dis3['counts'] * 100)/$total_dis;
						?>
					  <div class="col-md-6 col-sm-6 col-xs-12 sections-box happy" data-original-title="Dispatch" data-toggle="tooltip">
							<a href="<?php echo base_url(); ?>activity_report/fetch_data/8">
							<div class="info-box bg-red">
							<span class="info-box-icon no-print"><?php echo (int)$percent_work_dis; ?>%</span>
							<div class="info-box-content">
							  <span class="info-box-text"><?php echo getSection('8'); ?></span>
							  <span class="info-box-number"><b><?php echo $total_dis ; ?> File(s)received</b></span>
							  <div class="progress">
								<div style="width: <?php echo $percent_work_dis; ?>%" class="progress-bar"></div>
							  </div>
							  <span class="progress-description">
								<?php echo $res_dis3['counts']  ; ?> File(s) Dispatched 
							  </span>
							</div><!-- /.info-box-content -->
						  </div>
						  </a>
					  </div>
					<?php } ?>
			
			<hr class="clearfix no-print "/>
			<div class="row">
			<br/>
			<div class="col-xs-12">				
				<?php if($userrole < 7 || $userrole == 11 ) {
					$maxInd = -1;
					foreach($height_worked as $section => $percent) {
						if($percent > $maxInd) {
							$maxInd = $percent;
							$maxRes = array();
						}
						if($percent == $maxInd) {
							$maxRes[] = getSection($section);
						}
					}
					$maxSetions =  implode(', ',$maxRes);
					//$height_section = array_search(max($height_worked), $height_worked);   ?>
				<div class="">
					<div class="col-md-6 col-sm-6 col-xs-12 sections-box happy badhai">
					<h4 class="text-center"><?php echo (int)(max($height_worked)); ?>% के साथ  प्रथम स्थान - <b><?php echo $maxSetions; ?> शाखा</b></h4>
					  <div class="info-box">						
						<div class="info-box-content">
						  <h3 class="text-center">बहुत बहुत बधाई!!! <h3><br/><br/>
						</div><!-- /.info-box-content -->
					  </div><!-- /.info-box -->
					</div>
					<?php
					 $quwery = "SELECT file_received_emp_id , 
					count(file_id) AS fileno, 
					SUM(IF(file_hardcopy_status = 'received' || file_hardcopy_status = 'working', 1,0)) AS received,
					SUM(IF(file_hardcopy_status = 'not', 1,0)) AS notreceive 
					FROM ft_files UNION  
							SELECT file_received_emp_id , 
					count(file_id) AS fileno, 
					SUM(IF(file_hardcopy_status = 'received' || file_hardcopy_status = 'working', 1,0)) AS received,
					SUM(IF(file_hardcopy_status = 'not', 1,0)) AS notreceive FROM ft_files_master
					
					GROUP by `file_received_emp_id` 
					ORDER BY notreceive DESC limit 0,3";
					$qry = $this->db->query($quwery);
					if($qry->num_rows() > 0) {
						$result = $qry->result();
						//pre($result);
					} else {
						echo 'No users found';
					}
					?>
					<?php /*if($userrole == 1) { ?>
					<div class="col-md-6 col-sm-6 col-xs-12 happy">
					<h4 class="text-center"><b>आज की सबसे ज्यादा लंबित फाइलें</b></h4>
					  <div class="info-box">						
						<div class="">
						<table width="100%">
							<tr><th>नाम</th><th>प्राप्त की</th><th>प्राप्त नहीं की</th><th>कुल</th><tr>
						<?php foreach($result as $data){ ?>	
							<tr>
								<td><?php echo getemployeeName($data->file_received_emp_id, true).' '.get_employee_role($data->file_received_emp_id); ?></td>
								<td><a data-toggle="tooltip" data-original-title="Click Here For Display Files" href="<?php echo base_url(); ?>reports/moniter?secid=<?php echo getEmployeeSection($data->file_received_emp_id) ; ?>&s=received&emp=<?php echo $data->file_received_emp_id; ?>" >
								<?php echo $data->received; ?>
								</a></td> 
								<td><a data-toggle="tooltip" data-original-title="Click Here For Display Files" href="<?php echo base_url(); ?>reports/moniter?secid=<?php echo getEmployeeSection($data->file_received_emp_id) ; ?>&s=not&emp=<?php echo $data->file_received_emp_id; ?>" >
								<?php echo $data->notreceive; ?>
								</a></td>
								<td><a data-toggle="tooltip" data-original-title="Click Here For Display Files" href="<?php echo base_url(); ?>reports/moniter?secid=<?php echo getEmployeeSection($data->file_received_emp_id) ; ?>&emp=<?php echo $data->file_received_emp_id; ?>" >
								<?php echo $data->received + $data->notreceive; ?>
								</a></td>
							<tr>
						<?php } ?>
						</table>
						</div><!-- /.info-box-content -->
					  </div><!-- /.info-box -->
					</div>
					<?php } */?>
				</div>
				<?php } ?>
				</div>
			</div><!-- row -->
		</div><!-- /.body -->
	
	<!--<div class="box-footer no-print">
		<h3><?php /*echo $heading; */?></h3>
		<div class="col-md-4 col-sm-6 col-xs-12">
		  <div class="info-box">
			<span class="info-box-icon bg-yellow"><i class="fa fa-files-o"></i></span>
			<div class="info-box-content">
			  <span class="info-box-text">Total files</span>
			  <span class="info-box-number"><?php /*echo $final_total; */?></span>
			</div>
		  </div>
		</div>
		<div class="col-md-4 col-sm-6 col-xs-12">
		  <div class="info-box">
			<span class="info-box-icon bg-green"><i class="fa fa-files-o"></i></span>
			<div class="info-box-content">
			  <span class="info-box-text">Total Dispatched files</span>
			  <span class="info-box-number"><?php /*echo  $final_dispatch; */?></span>
			</div>
		  </div>
		</div>
		<div class="col-md-4 col-sm-6 col-xs-12">
		  <div class="info-box">
			<span class="info-box-icon bg-red"><i class="fa fa-files-o"></i></span>
			<div class="info-box-content">
			  <span class="info-box-text">Total working files</span>
			  <span class="info-box-number"><?php /*$working_files = $final_total - $final_dispatch; echo   $working_files < 0 ? 0 :  $working_files; */?></span>
			</div>
		  </div>
		</div>
	</div>-->


</div><!-- /.print-box -->	
</div><!-- /.box -->
</div><!-- /.box -->