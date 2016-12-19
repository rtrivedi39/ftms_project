

<?php $userrole = checkUserrole();
if(get_date_formate($start_date, 'd-m-Y') == get_date_formate($end_date, 'd-m-Y')){
	$date = get_date_formate($start_date, 'd-m-Y');
} else {
	$date = get_date_formate($start_date, 'd-m-Y')." से  ".get_date_formate($end_date, 'd-m-Y')." तक ";
}
$date = $date." समय- ".date('h:i:s a');

 ?>
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
			<div class="box no-print">	
				<div class="box-header">
					<h4 class="box-title">दिनांक का चयन करे</h4>
					<div class="box-tools pull-right no-print">
					</div>
				</div><!-- /.box-header -->
				<form role="form" method="post" action="<?php echo base_url()?>activity_report/employee_report"  enctype="multipart/form-data">
				<div class="box-body">	
					<table class="table table-condensed">
						<tr>
							<th>Start date</th>
							<th>End date</th>
						</tr>
						<tr>
							<td>
								<input type="text" name="start_date" id="start_date" class="date_picker form-control" value="<?php echo get_date_formate($start_date, 'd-m-Y'); ?>" placeholder="Select enter date" class="form-control">
							</td>
							<td>
								<input type="text" name="end_date" id="end_date" class="date_picker form-control" value="<?php echo get_date_formate($end_date, 'd-m-Y'); ?>" placeholder="Select dispatch date" class="form-control">
							</td>
							<td>
								<button class="btn btn-primary" type="submit">Search</button>
							</td>
						</tr>
					</table>
				</div>
				</form>
			</div>
		</div><!-- /.col-12 -->
    </div><!-- /.row -->
    <!-- Main row -->


	<div class="box">	
		<div class="box-header">
			<h4 class="box-title text-center">विधि विभाग, कर्मचारी का  प्रदर्शन दिनांक <?php echo $date; ?></h4>
			<div class="box-tools pull-right no-print">
				<!--<button class="btn btn-block btn-info"><?php echo $this->lang->line('view_file_mark');?></button>-->
				<!--<a class="btn btn-info"><?php echo $this->lang->line('view_file_mark');?></a>-->
				<button class="btn btn-warning" onclick="goBack()"><?php echo $this->lang->line('Back_button_label'); ?></button>
				<button onclick="printContents('print-box')" class="btn btn-primary no-print">प्रिंट</button>
			</div>
		</div><!-- /.box-header -->
		<div class="box-body">	
			<div class="row">
				<table class="table table-condensed">
				<thead>
				<tr><th>S.No.</th><th>Employee name</th>
				<th>Employee designation</th><th>Total Worked files</th>
				<th>Worked files</th><th>Pending files</th><th>Performance</th></tr>
				</thead>
				<tbody>
					<?php 
					//select  worked employee
						$query_employees = $this->db->query("SELECT DISTINCT(`from_emp_id`) as emps_id

						FROM `ft_file_logs`");
						$employees =  $query_employees->result_array();
						$i =1; 
					foreach($employees as $emp){ 
						$userid = $emp['emps_id'];
						$query_worked = $this->db->query("SELECT count(DISTINCT(`file_id`)) as files,
						SUM(IF(from_emp_id = '$userid', 1,0)) AS worked,
						SUM(IF(to_emp_id = '$userid', 1,0)) AS pending
						FROM `ft_file_logs`
						WHERE (date(flog_created_date) >= '$start_date' and date(flog_created_date) <= '$end_date')						
						 and (from_emp_id = '$userid' or to_emp_id = '$userid')");
						$result = $query_worked->row_array();
						$total = $result['worked'] + $result['pending'];
					?>
						<tr>
							<td  class="text-center"><?php echo $i ;?></td>
							<td><?php echo getemployeeName($userid ,true) ;?></td>
							<td><?php echo get_employee_role($userid) ;?></td>
							<td  class="text-center"><a data-toggle="tooltip" data-original-title="Click Here For Display Files" href="<?php echo base_url('activity_report'); ?>/file_moniter/files_log?a=all&emp=<?php echo $userid; ?>&s_date=<?php echo $start_date ?>&e_date=<?php echo $end_date ?>" >
								<?php echo $total ;?>
							</td>
							<td  class="text-center"><a data-toggle="tooltip" data-original-title="Click Here For Display Files" href="<?php echo base_url('activity_report'); ?>/file_moniter/files_log?a=worked&emp=<?php echo $userid; ?>&s_date=<?php echo $start_date ?>&e_date=<?php echo $start_date ?>" >
							<?php echo $result['worked'] ;?></td>
							<td   class="text-center"><a data-toggle="tooltip" data-original-title="Click Here For Display Files" href="<?php echo base_url('activity_report'); ?>/file_moniter/files_log?a=received&emp=<?php echo $userid; ?>&s_date=<?php echo $start_date ?>&e_date=<?php echo $start_date ?>" >
								<?php echo $result['pending'] ;?>
							</td>
							<td  class="text-center"><?php echo $total != 0 ? (int)($result['worked']*100/$total) : 'n/a' ;?>%</td>
						
						</tr>
					<?php $i++; } ?>
					</tbody>
				</table>
			</div>
		</div><!-- /.box - body-->
	</div>
</div><!-- /.box -->
</div><!-- /.box -->
</section><!-- /.content -->
<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>