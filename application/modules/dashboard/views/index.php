<?php $view_role = viewDashboardRole($this->session->userdata('user_role')); 
$role_id = checkUserrole();
$CI = & get_instance();
$todays = date('Y-m-d');
$_3days = date('Y-m-d', strtotime($todays.' - 3 days'));
$_7days = date('Y-m-d', strtotime($todays.' - 7 days'));
$_10days = date('Y-m-d', strtotime($todays.' - 10 days'));
//$userid= emp_session_id();
//pre($data);
?>
<section class="content-header">
    <h1>
        <?php echo $this->lang->line('title') ?>

    </h1>
    <!--  <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol> -->
</section>

<!-- Main content -->
<section class="content">
<?php if($role_id == 1 || $role_id == 3 || $role_id == 4 || $role_id == 5 ) { ?>
<div class="no-print">
	<a  href="http://10.115.254.213/lms/leave/leave_approve">
		<div class="col-md-3 col-sm-6 col-xs-12" data-original-title="शासकीय कर्मचारीओ की छुट्टिया अनुमोदन करें" data-toggle="tooltip">
			<div class="info-box bg-blue">
				<span class="info-box-icon"><i class="fa fa-group"></i></span>
				<div class="info-box-content">
				  <span class="info-box-text">अवकाश</span>
				  <span class="info-box-number">अवकाश  आवेदन देखें</b></span>
				  <div class="progress">
					<div style="width: 100%" class="progress-bar"></div>
				  </div>
				  <span class="progress-description"></span>
				</div><!-- /.info-box-content -->
			</div>
		</div>
	</a>
	<a href="#">
		<div class="col-md-3 col-sm-6 col-xs-12" data-original-title="कैमरा स्क्रीन देखें" data-toggle="tooltip">
			<div class="info-box bg-green">
				<span class="info-box-icon"><i class="fa fa-camera"></i></span>
				<div class="info-box-content">
				  <span class="info-box-text">कैमरा</span>
				  <span class="info-box-number">कैमरा स्क्रीन देखें </b></span>
				  <div class="progress">
					<div style="width: 100%" class="progress-bar"></div>
				  </div>
				  <span class="progress-description"></span>
				</div><!-- /.info-box-content -->
		  </div>
		</div>
	</a>
	<a href="<?php echo base_url(); ?>lms/unis_bio_report">
		<div class="col-md-3 col-sm-6 col-xs-12" data-original-title="बायोमेट्रिक देखें" data-toggle="tooltip">
			<div class="info-box bg-yellow">
				<span class="info-box-icon"><i class="fa fa-eye"></i></span>
				<div class="info-box-content">
				  <span class="info-box-text">बायोमेट्रिक </span>
				  <span class="info-box-number">बायोमेट्रिक देखें</b></span>
				  <div class="progress">
					<div style="width:100%" class="progress-bar"></div>
				  </div>
				  <span class="progress-description"></span>
				</div><!-- /.info-box-content -->
		  </div>
		</div>
	</a>
	
	<a href="<?php echo base_url(); ?>show/reports">
		<div class="col-md-3 col-sm-6 col-xs-12" data-original-title="सभी प्रकार की रिपोर्ट देखें" data-toggle="tooltip">
			<div class="info-box bg-red">
				<span class="info-box-icon"><i class="fa fa-bar-chart"></i></span>
				<div class="info-box-content">
				  <span class="info-box-text">रिपोर्ट्स</span>
				  <span class="info-box-number">सभी प्रकार की रिपोर्ट देखें</b></span>
				  <div class="progress">
					<div style="width: 100%" class="progress-bar"></div>
				  </div>
				  <span class="progress-description"></span>
				</div><!-- /.info-box-content -->
		  </div>
		</div>
	</a>
	<div style="clear:both"></div>
	<a href="<?php echo base_url(); ?>view_file/Dispaly_list">
		<div class="col-md-3 col-sm-6 col-xs-12" data-original-title="स्वयं को अंकित फाइलें देखें" data-toggle="tooltip">
			<div class="info-box bg-yellow">
				<span class="info-box-icon"><i class="fa fa-eye"></i></span>
				<div class="info-box-content">
				  <span class="info-box-text">अंकित फाइलें देखें</span>
				  <span class="info-box-number">स्वयं को अंकित फाइलें देखें</b></span>
				  <div class="progress">
					<div style="width: 100%" class="progress-bar"></div>
				  </div>
				  <span class="progress-description"></span>
				</div><!-- /.info-box-content -->
		  </div>
		</div>
	</a>
	<a href="<?php echo base_url();?>show/establishment">
		<div class="col-md-3 col-sm-6 col-xs-12" data-original-title="<?php echo isset($sec['section_name_en'])?$sec['section_name_en']:'' ; ?>" data-toggle="tooltip">
			<div class="info-box bg-red">
				<span class="info-box-icon"><i class="fa fa-mortar-board"></i></span>
				<div class="info-box-content">
				  <span class="info-box-text">स्थापना</span>
				  <span class="info-box-number">विभाग की स्थापना देखें </b></span>
				  <div class="progress">
					<div style="width: 100%" class="progress-bar"></div>
				  </div>
				  <span class="progress-description"></span>
				</div><!-- /.info-box-content -->
		  </div>
		</div>
	</a>
	<a href="<?php echo base_url(); ?>view_file/file_search">
		<div class="col-md-3 col-sm-6 col-xs-12" data-original-title="<?php echo isset($sec['section_name_en'])?$sec['section_name_en']:'' ; ?>" data-toggle="tooltip">
			<div class="info-box bg-green">
				<span class="info-box-icon"><i class="fa fa-search-plus"></i></span>
				<div class="info-box-content">
				  <span class="info-box-text">खोजें</span>
				  <span class="info-box-number">सभी अनुभाग की फ़ाइले खोंजे</b></span>
				  <div class="progress">
					<div style="width: 100%" class="progress-bar"></div>
				  </div>
				  <span class="progress-description"></span>
				</div><!-- /.info-box-content -->
		  </div>
		</div>
	</a>
	
	<a href="<?php echo base_url(); ?>moniter/files">
		<div class="col-md-3 col-sm-6 col-xs-12" data-original-title="<?php echo isset($sec['section_name_en'])?$sec['section_name_en']:'' ; ?>" data-toggle="tooltip">
			<div class="info-box bg-blue">
				<span class="info-box-icon"><i class="fa fa-file-movie-o"></i></span>
				<div class="info-box-content">
				  <span class="info-box-text">मॉनिटर</span>
				  <span class="info-box-number">फाइल मॉनिटर करें</b></span>
				  <div class="progress">
					<div style="width: 100%" class="progress-bar"></div>
				  </div>
				  <span class="progress-description"></span>
				</div><!-- /.info-box-content -->
		  </div>
		</div>
	</a>
	<div style="clear:both"></div>
	</div>
    <?php echo modules::run('activity_report/index_for_admin',null); ?>
<?php }  else { 
	if($role_id == 8) {
	//header( "Location: ".base_url()."reports" );
		?>    
<div class="row no-print">  
	<?php  if(show_view_as_lvl()!='404'){
             $is_file_alloted= check_ps_monitor_file_is_alloted('count',$this->session->userdata("emp_id"));?>
			<a href="<?php echo base_url(); ?>ps_file_monitor?empid=<?php echo $this->session->userdata("emp_id"); ?>">
				<div class="col-md-3 col-sm-6 col-xs-12" data-original-title="स्वयं को अंकित फाइलें देखें" data-toggle="tooltip">
					<div class="info-box bg-yellow">
						<span class="info-box-icon"><i class="fa fa-fw fa-eye"></i></i></span>
						<div class="info-box-content">
						   <span class="info-box-text"> फ़ाइलें देखें</span>
						    <span class="info-box-number">पी .एस. मॉनिटर की फाइलें देखें</b></span>
							<div class="progress">
							<div style="width: 100%" class="progress-bar"></div>
						  </div>
						  <span class="progress-description"></span>
						</div><!-- /.info-box-content -->
				  </div>
				</div>
			</a>
			<?php } ?>
			<a href="<?php echo base_url(); ?>reports">
				<div class="col-md-3 col-sm-6 col-xs-12" data-original-title="" data-toggle="tooltip">
					<div class="info-box bg-blue">
						<span class="info-box-icon"><i class="fa fa-file-o"></i></span>
						<div class="info-box-content">
						  <span class="info-box-text">रिपोर्टिंग</span>
						  <span class="info-box-number">फाइल रिपोर्टिंग</b></span>
						  <div class="progress">
							<div style="width: 100%" class="progress-bar"></div>
						  </div>
						  <span class="progress-description"></span>
						</div><!-- /.info-box-content -->
				  </div>
				</div>
			</a>
		<!--<div class="no-print">
        <div class="row">           
            <div class="col-lg-4 col-xs-6">                
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?php //echo isset($total_file) ? $total_file : ''; ?></h3>
                        <p><?php //echo $this->lang->line('dashboard_number_file'); ?> in section</p>
                    </div>
                        
                     <?php //if($emp_section_ids == 8 && isset($emp_section)){ ?>
                        <a href="<?php //echo base_url().'reports/moniter?secid='.$emp_section; ?>&s=not&lvl=list_all_dipatch_section_files" class="small-box-footer">
                            Click to view file list <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    <?php //}else{?> 


                        <a href="<?php// echo base_url().'view_file'; ?>" class="small-box-footer">
                            More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    <?php //} ?>


                </div>
            </div>
<div class="col-lg-4 col-xs-6">                
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3><?php //echo isset($pending_file) ? $pending_file : '' ?></h3>
                        <p><?php//echo $this->lang->line('dashboard_pending_file'); ?> in section</p>
                    </div>
                    <?php //if($emp_section_ids ==8 && isset($emp_section)){ ?>
                        <a href="<?php //echo base_url().'reports/moniter?secid='.$emp_section; ?>&s=not&lvl=section_dis" class="small-box-footer">
                            Click to view file list <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    <?php //}else{?> 


                    <a href="<?php //echo base_url().'activity_report/fetch_data/'.$emp_section_ids; ?>" class="small-box-footer">
                        Click to view file list <i class="fa fa-arrow-circle-right"></i>
                    </a>
                    <?php// } ?>


                </div>
            </div>
            <div class="col-lg-4 col-xs-6">               
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?php //echo isset($dispetch_file) ? $dispetch_file : '' ?></h3>
                        <p><?php //echo $this->lang->line('dashboard_dispatch_file'); ?> in section</p>
                    </div>
                   <?php //if($emp_section_ids ==8 && isset($emp_section)){ ?>
                        <a href="<?php //echo base_url().'reports/moniter?secid='.$emp_section; ?>&s=2&lvl=dis_sec_cloase_file" class="small-box-footer">
                           Click to view file list <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    <?php //} else { ?>


                       <a href="<?php //echo base_url().'activity_report/fetch_data/'.$emp_section_ids; ?>" class="small-box-footer">
                            Click to view file list <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    <?php //} ?>


                </div>
            </div>
			<!--
			<div class="col-lg-4 col-xs-6">               
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h3><?php ///$count_total_worked_files= total_work_by_officer_emp('count_total_file_works',$userid,$emp_section); echo $count_total_worked_files['total_file_works']; ?></h3>
                        <p>Total number of file worked by you</p>
                    </div>
                   
					<a href="<?php //echo base_url().'reports/moniter?empid='.$userid; ?>&s=not&lvl=view_ofcr_deald_files"" class="small-box-footer">
						Click to view file list <i class="fa fa-arrow-circle-right"></i>
					</a>
			   
                </div>
            </div>
			-->
        </div>
        <!-- =========================================================== -->
<?php }} ?>

<?php if(!isset($start_date)){$start_date=date('Y-m-d');}if(!isset($end_date)){$end_date=date('Y-m-d');} ?>
<div class="row">		
    <?php
    $arr_ps_count = ps_monitor_marked_report(null,"today" , emp_session_id());
    if($arr_ps_count > 0) {
        $this->load->view('psmonit_alert');
    }?>
	 
<!--
comment on 1/6/2016
<div class="box box-primary" id="divname1">
	<div class="box-header">
		<h3 class="box-title"><?php /*echo get_date_formate($start_date,'d.m.Y'); */?> से <?php /*echo get_date_formate($end_date,'d.m.Y'); */?>  तक  जिन फाइलों पर आपने कार्य किया</h3>
		<div class="box-tools pull-right">
			<button onclick="printContents('divname1')" class="btn btn-primary no-print">प्रिंट</button>
			<button class="btn btn-warning no-print" onclick="goBack()">बेक</button>
		</div>
	</div>
	<div class="box-body">
			
				<form method="post" action="<?php /*echo base_url('dashboard')*/?>/common_dashboard/dashboard_report"  enctype="multipart/form-data">
				
				<table class="table table-condensed text-center">
					<?php /*

					// $query = "SELECT count(distinct(ft_files.file_id)) AS worked,
						// count(IF((file_hardcopy_status = 'not'), 1,0)) AS not_recv,
						// count(IF((file_hardcopy_status = 'received'), 1,0)) AS received
						// FROM ft_file_logs join ft_files on ft_files.file_id = ft_file_logs.file_id
						// where to_emp_id = '$userid'
						// and (date(`flog_created_date`) >= '$start_date'
						// and date(`flog_created_date`) <= '$end_date') ";
						// $query = $this->db->query($query);
						// $result = $query->row_array();
						// pre($result);

						$query_log = $CI->db->query("SELECT count(distinct(ft_files.file_id)) as marked
						FROM ft_file_logs join ft_files on ft_files.file_id = ft_file_logs.file_id
						where to_emp_id = '$userid' 
						and (date(`flog_created_date`) >= '$start_date' 
						and date(`flog_created_date`) <= '$end_date') 
						and file_hardcopy_status = 'not'");						
						$marked = $query_log->row_array();

						$query_log = $CI->db->query("SELECT count(distinct(ft_files.file_id)) as received 
						FROM ft_file_logs join ft_files on ft_files.file_id = ft_file_logs.file_id
						where to_emp_id = '$userid' 
						and (date(`flog_created_date`) >= '$start_date' 
						and date(`flog_created_date`) <= '$end_date') 
						and file_hardcopy_status = 'received' ");
						$received = $query_log->row_array();
						
						$query_log = $CI->db->query("SELECT count(distinct(file_id)) as worked 
						FROM ft_file_logs 
						where from_emp_id = '$userid' 
						and (date(`flog_created_date`) >= '$start_date' 
						and date(`flog_created_date`) <= '$end_date' )");
						$worked = $query_log->row_array();
					*/?>
						<?php /*if($role_id == 1 || $role_id == 3){ */?>
					<tr>
						<td><label>कर्मचारी चुने</label></td>
						<td><select name="user_id" class="form-control">
							<?php /*$employees = get_list(EMPLOYEES, 'role_id', array('emp_is_retired' => 0, 'emp_status' =>1 ), 'ASC');
							foreach($employees as $kry => $emp_data){
								*/?>
								<option value="<?php /*echo  $emp_data['emp_id']; */?>" <?php /*echo $userid == $emp_data['emp_id'] ? 'selected' : ''; */?>>
									<?php /*echo  $emp_data['emp_full_name_hi'].'('.get_employee_role($emp_data['emp_id']).')' ; */?></option>
								<?php
/*							}
							*/?>
							</select>
						</td>
					</tr>
					<?php /*} */?>
					<tr>
						<td><label>दिनांक से खोजे</label></td>
						<td><input type="text" class="form-control date1" name= "start_date" value="<?php /*echo get_date_formate($start_date,'d-m-Y'); */?>" placeholder="select date"/> <?php /*echo form_error('start_date') ; */?>
						से 
						<input type="text" class="form-control date1" name= "end_date" value="<?php /*echo get_date_formate($end_date,'d-m-Y'); */?>" placeholder="select date"/> <?php /*echo form_error('end_date') ; */?>
						</td>
						<td><button type="submit" class="btn btn-primary" >खोजे</button></td>
						
					</tr>
					<tr>
						<th>जो फाइल आपको मार्क हुई है</th>
						<th>जिन फाइलों पर कार्य किया गया</th>
						<th>कुल किया गया कार्य</th>
					</tr>
					<tr>
						<td class="total_files_received" style="cursor:pointer" onclick='showpage("<?php /*echo base_url('activity_report'); */?>/file_moniter/files_log?a=marked&emp=<?php /*echo $userid; */?>&s_date=<?php /*echo $start_date; */?>&e_date=<?php /*echo $end_date; */?>")'>
							<span data-toggle="tooltip" title="" class="badge bg-light-blue" data-original-title="<?php /*  echo $marked['marked']; */?> Files">
							<?php /*  echo $marked['marked']; */?>
							</span> 
						</td>
						<td>
							<table class="table table-condensed text-center">
								<tr><td>प्राप्त की</td><td>भेजी गयी</td></tr>
								<tr>
									<td class="total_files_received" style="cursor:pointer" onclick='showpage("<?php /*echo base_url('activity_report'); */?>/file_moniter/files_log?a=received&emp=<?php /*echo $userid; */?>&s_date=<?php /*echo $start_date; */?>&e_date=<?php /*echo $end_date; */?>")'>
										<span data-toggle="tooltip" title="" class="badge bg-light-blue" data-original-title="<?php /*  echo $received['received']; */?> Files">
										<?php /*  echo $received['received']; */?>
										</span>
									</td>
									<td class="total_files_received" style="cursor:pointer" onclick='showpage("<?php /*echo base_url('activity_report'); */?>/file_moniter/files_log?a=worked&emp=<?php /*echo $userid; */?>&s_date=<?php /*echo $start_date; */?>&e_date=<?php /*echo $end_date; */?>")'>
										<span data-toggle="tooltip" title="" class="badge bg-light-blue" data-original-title="<?php /*  echo $worked['worked']; */?> Files">
										<?php /*  echo $worked['worked']; */?>
										</span>
									</td>
								</tr>
							</table>
						</td>
						<td class="total_files_received" style="cursor:pointer" onclick='showpage("<?php /*echo base_url('activity_report'); */?>/file_moniter/files_log?a=all&emp=<?php /*echo $userid; */?>&s_date=<?php /*echo $start_date; */?>&e_date=<?php /*echo $end_date; */?>")'>
							<span data-toggle="tooltip" title="" class="badge bg-light-blue" data-original-title="<?php /*  echo $received['received'] + $worked['worked']; */?> Files">
							<?php /*  echo $received['received'] + $worked['worked']; */?>
							</span> 
						</td>
					</tr>
				</table>
				</form>
			</div>
		</div>
	</div>-->

	
			<div class="col-md-12">	
				<!--File Mergion and Re-open-->
				<?php $login_usr_section = explode(',',$emp_section_ids); ?>
				<?php if(checkUserrole()!=9 && $login_usr_section[0] != 8){ ?>
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">फाइल का पुर्नजीवन, बदलाव एवं एकीकरण</h3>
					</div>
				<div class="row">							
					<div class="col-md-3">
						<a class="btn btn-block btn-bitbucket" onclick="show_merge_file_dive('merge');" href="javascript:void(0)">फाइल  का  एकीकरण </a>
					</div>

					<div class="col-md-3">
						<a class="btn btn-block btn-bitbucket" onclick="show_merge_file_dive('split');" href="javascript:void(0)">फाइल की प्रतिलिपि जोड़े </a>
					</div>

					<div class="col-md-3">
						<a class="btn btn-block btn-bitbucket" href="<?php echo base_url();?>view_file/file_search?task=reopen">फाइल को पुनः खोलें </a>
					</div>

					<div class="col-md-3">
						<a class="btn btn-block btn-bitbucket" href="<?php echo base_url();?>view_file/file_search?task=fileedit">फाइल का पुनः बदलाव करें </a>
					</div>
					<?php if(checkUserrole() == 1 ) { ?>
					<div class="col-sm-3 col-md-3">
						<a class="btn btn-danger" href="<?php echo base_url();?>view_file/file_search?task=fileclose">फाइल को बंद करें </a>
					</div>
					<?php } ?>
						<?php 
						
							$classIV  = get4classemp($this->session->userdata('emp_unique_id'));
				if($classIV[0]->pay_salary_cate_id == 4){
				if($this->session->userdata('emp_unique_id') != "51011068" && $this->session->userdata('emp_unique_id') != "51011071"){
				?>
				<div class="col-md-3">
                    	<a target="_blank" href="<?php echo base_url(); ?>uploads/paybill/DPFSLIP2015-2016/<?php echo "0".$this->session->userdata('emp_unique_id').".pdf"; ?>" class="btn btn-danger ">डी पी एफ स्लिप 
						<br/>2015-2016</a>
                </div>
				<?php }else{?>
				<div class="col-md-3">
                    	<a target="_blank" href="<?php echo base_url(); ?>uploads/paybill/DPFSLIP2015-2016/<?php echo "0".$this->session->userdata('emp_unique_id').".pdf"; ?>" class="btn btn-danger ">डी पी एफ स्लिप -1
						<br/>2015-2016</a>
						
						<a target="_blank" href="<?php echo base_url(); ?>uploads/paybill/DPFSLIP2015-2016/<?php echo "0".$this->session->userdata('emp_unique_id')."-2.pdf"; ?>" class="btn btn-danger ">डी पी एफ स्लिप -2  
						<br/>2015-2016</a>
						<a target="_blank" href="<?php echo base_url(); ?>uploads/paybill/DPFSLIP2015-2016/<?php echo "0".$this->session->userdata('emp_unique_id')."-3.pdf"; ?>" class="btn btn-danger ">डी पी एफ स्लिप -3
						<br/>2015-2016</a>
                </div>		
				
						<?php }} ?>
				
							<div style="clear:both"></div>
							<br/>
							<?php
							$hide="";							
							if(isset($_GET['fmerge_type']) && $_GET['fmerge_type']!='' && $_GET['fnumber']!='')
							{
								$res= check_file_exist_or_not();
                    if(isset($res) && $res != 'not_found'&& $res != '') {
                        if($_GET['type_fn'] == 'split'){
                            redirect('view_file/file_splitting/index/' . $res[0]['file_id']);
                        }else{
                            redirect('view_file/file_link/101/' . $res[0]['file_id']);
                        }
                                }else{
                                    echo "<div class='text-bold text-center text-danger'>DATA NOT FOUND</div>";
                                }
								$hide="";
							}else{
								$hide="display:none";
							} 
							?>
							
							<div class="col-xs-12" style="<?php echo $hide; ?>" id="merge_dive">
								<form action="" method="get">
                        <input type="hidden" required value="" name="type_fn" id="type_fn">
									<div class="col-xs-3">
										<div class="form-group">
                                <label id="change_type"><span class="text-danger">*</span></label>
                                <select id="file_merging_type" required="" name="fmerge_type" class="form-control">
                                    <option value="">चयन करें</option>
                                    <option value="sno" <?php echo @$this->input->get('fmerge_type') == 'sno' ? "selected" : false?>>अनुभाग पंजी क्रमांक (Section number)</option>
                                    <option value="fid" <?php echo @$this->input->get('fmerge_type') == 'fid' ? "selected" : false?>>फाइल ई.डी (File Id)</option>
                                    <option value="crno" <?php echo @$this->input->get('fmerge_type') == 'crno' ? "selected" : false?>>आवक नंबर (CR Number)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-3" id="sec_nm_remove">
                            <div class="form-group" >
                                <label for="exampleInputFile">अनुभाग का नाम </label>
                                <select id="secid" name="secid" class="form-control">
                                    <option value="">Select Type</option>
                                    <?php $empssection = empdetails(emp_session_id());
                                    foreach(explode(",",$empssection[0]['emp_section_id'])  as $empsec){ ?>
                                        <option value="<?php echo $empsec ?>" <?php echo @$this->input->get('secid') == $empsec ? "selected" : false?>><?php echo getSection($empsec) ; ?></option>
                                    <?php  }?>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-3" id="cr_year_remove" style="display: none">
                            <div class="form-group">
                                <label>वर्ष</label>
                                <select class="form-control" id="m_files_year" name="m_files_year">
                                    <?php $i = '2015';
                                    while($i <= date('Y')) { ?>
                                        <option value="<?php echo $i ; ?>" <?php echo date('Y') == $i ? 'selected' : ''; ?>><?php echo $i ;?></option>
                                        <?php $i++; } ?>
											</select>
										</div>
									</div>
									<div class="col-xs-3">
										<div class="form-group">
											<label for="exampleInputFile">क्रमांक/नंबर<span class="text-danger">*</span></label>
											<input type="text" required class="form-control" value="<?php echo @$this->input->get('fnumber');?>" name="fnumber" id="mergeno">
										</div>
									</div>
									<div class="col-xs-3">
										<div class="form-group">
											<label for="exampleInputFile">कार्यवाही</label>
											<button class="btn btn-primary form-control" type="submit">खोजे</button>
										</div>
									</div>
								</form>
							</div>
							<div style="clear:both"></div>
					</div>
				</div>
				<?php } ?>				
				</div>	
				<div class="col-md-12">	
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">एप्लीकेशन के बारे में कोई  सुझाव  देने के लिए</h3>
					</div>
					<div class="box-body">
						<a class="btn btn-bitbucket" href="<?php echo base_url();?>suggestions">सुझाव  </a>						
					</div>
				</div>
			</div>
		</div><!-- /.row -->


 </section><!-- /.content -->
<script>
    function showpage(comp1)
    {
        window.location=comp1;
    }
    function show_merge_file_dive(type){

        if(type == 'split'){
            $("#type_fn").val(type);
            $("#change_type").html('फाइल प्रतिलिपि बनाने हेतु खोज के प्रकार');
        }else if(type == 'merge'){
            $("#type_fn").val(type);
            $("#change_type").html('फाइल एकीकरण  हेतु खोज के  प्रकार');
        }
        $("#merge_dive").show()
    }
    $('#file_merging_type').change(function(){
        var fmerge_type = $('#file_merging_type option:selected').val();
        if(fmerge_type == 'fid'){
            $('#sec_nm_remove').hide();
            $('#cr_year_remove').hide();
            $("#secid").prop( "required", false );
        }else if(fmerge_type == 'crno'){
            $('#sec_nm_remove').hide();
            $('#cr_year_remove').show();
            $("#secid").prop( "required", false );
        }else{
            $("#secid").prop( "required", true );
            $('#sec_nm_remove').show();
            $('#cr_year_remove').hide();
        }

    });
</script>




