<style>
#loading-image{display:none;}
</style>
<?php
$userrole = checkUserrole();
$CI = & get_instance();
$todays = date('Y-m-d');
$_3days = date('Y-m-d', strtotime($todays.' - 3 days'));
$_7days = date('Y-m-d', strtotime($todays.' - 7 days'));
$_10days = date('Y-m-d', strtotime($todays.' - 10 days'));
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
   <div class="box box-primary" id="divname">
	<div class="box-header">
		<h3 class="box-title">अभी तक के आपके कार्य का विवरण</h3>
		<div class="box-tools pull-right">
			<button onclick="printContents('divname')" class="btn btn-primary no-print">प्रिंट</button>
			<button class="btn btn-warning no-print" onclick="goBack()">पिछले पेज पर जाये</button>
		</div>
	</div><!-- /.box-header -->	
	<div class="box-body">	
		<div class="row">
			<div class="col-md-12">	
				<form role="form" method="post" action="<?php echo base_url('individual_reports')?>"  enctype="multipart/form-data">			
					<table class="table table-condensed text-center">
					<?php  $section_emps = explode(',',$this->session->userdata('emp_section_id'));  ?>
						<tr>
							<td width="30%">
								<select name="emp_section_name" class="form-control" id="emp_sections">
									<option value="">अनुभाग  चुने</option>
									<?php  foreach($section_emps as $values) { ?>
											<option value="<?php echo $values; ?>" <?php echo (isset($form_input['emp_section']) && $form_input['emp_section'] == $values) ? 'selected' : '';  ?>> <?php echo getSection($values); ?> </option>
									<?php }?>
								</select>
							</td>
							<td width="30%">
								<div id="loading-image">Fetching section employees....</div>
								<select name="user_type" class="form-control" id="employee_list_section">
									<option value="">कर्मचारी चुने</option>									
								</select>
							</td width="30%">
							<td>
								<button type="submit" class="btn btn-primary" >खोजे</button>
							</td>
						</tr>
					 <?php //}  
					// pr('h');?>
					</table>
				</form>
				<table class="table table-condensed text-center">
					<tr>
						<td>नाम:- <b><?php echo getemployeeName($userid, true); ?></b></td>
						<td>पद:- <b><?php echo get_employee_role($userid); ?></b></td>
					</tr>
				</table>
				
				<table class="table table-condensed text-center">
					<tr>
						<th>फाइलें जो अभी तक आपको अंकित की गयी है <br/> (अ)</th>
						<th>फाइलें जो आपको प्राप्त करना है <br/> (ब)</th>
						<th>फाइलें जो आपने प्राप्त कर ली है <br/> (स)</th>
						<!--<th>फाइलें जिस पर आपने कार्य किया और वो बंद हो गई है <br/> (द)</th>
						<th>अतिरिक्त (जो अधिकारी के पास या अन्य कही है)<br/> (इ)</th>-->
					</tr>
					<?php  $sections = explode(',',$userid_sec); 
					foreach($sections as $emp_section){  ?>
					<tr>
					<?php $query_all = $CI->db->query("SELECT count(DISTINCT(log.file_id))as total_files, 
							(SELECT count(DISTINCT(log.file_id))as total_file_works FROM `ft_file_logs` as log INNER JOIN ft_files as files on log.file_id = files.file_id INNER JOIN ft_file_dispatch as dispatch on dispatch.file_id = files.file_id where log.to_emp_id = '$userid' and issection_despose = '1') AS section_close,
							(SELECT count(DISTINCT(log.file_id))as total_file_works FROM `ft_file_logs` as log INNER JOIN ft_files as files on log.file_id = files.file_id INNER JOIN ft_file_dispatch as dispatch on dispatch.file_id = files.file_id where log.to_emp_id = '$userid'  and issection_despose = '0') AS dispatch_close,
							(SELECT count(DISTINCT(log.file_id))as total_file_works FROM `ft_file_logs` as log INNER JOIN ft_files as files on log.file_id = files.file_id where log.to_emp_id = '$userid' and files.file_hardcopy_status = 'not' and file_return = '2' ) AS dispatch_not,
							(SELECT count(DISTINCT(log.file_id))as total_file_works FROM `ft_file_logs` as log INNER JOIN ft_files as files on log.file_id = files.file_id where log.to_emp_id = '$userid' and files.file_hardcopy_status = 'received' and file_return = '2' ) AS dispatch_receive,
							(SELECT count(DISTINCT(log.file_id))as total_file_works FROM `ft_file_logs` as log INNER JOIN ft_files as files on log.file_id = files.file_id where log.to_emp_id = '$userid' and files.file_hardcopy_status != 'close' and file_return != '2' and file_received_emp_id != '$userid') AS working_another
							FROM `ft_files` as files 
							INNER JOIN ft_file_logs as log on files.file_id = log.file_id 							
							where log.to_emp_id = '$userid' and files.file_mark_section_id = '$emp_section' ");
							
							$total = $query_all->row_array();
							?>
						<td>
							<table style="border:no-border; width:100%;">
							<tr>
								<td>अनुभाग:- <b><?php echo getSection($emp_section); ?></b></td>
							</tr>
							<tr>
								<td class="total_files_received" style="cursor:pointer" onclick='showpage("<?php echo base_url(); ?>moniter/files?u=<?php  echo $userid; ?>")'>
									<span data-toggle="tooltip" title="" class="badge bg-light-blue" data-original-title="<?php  echo $total['total_files']; ?> Files">
									<?php  echo $total['total_files']; ?>
									</span> 
								</td>
								
							</tr>							
							</table>
						</td>						
						<?php 
						$qry = $this->db->query("SELECT count(file_id) AS fileno,
						SUM(IF(file_hardcopy_status = 'not' && (date(file_update_date) > '$_3days' && date(file_update_date) <= '$today'), 1,0)) AS notreceive,
						SUM(IF(file_hardcopy_status = 'not' && (date(file_update_date) > '$_7days' && date(file_update_date) <= '$_3days'), 1,0)) AS notreceive_3days,
						SUM(IF(file_hardcopy_status = 'not' && (date(file_update_date) > '$_10days' && date(file_update_date) <= '$_7days'), 1,0)) AS notreceive_7days,
						SUM(IF(file_hardcopy_status = 'not' && date(file_update_date) <= '$_10days' , 1,0)) AS notreceive_10days, 
						SUM(IF((file_hardcopy_status = 'received' || file_hardcopy_status = 'working') && (date(file_update_date) > '$_3days' && date(file_update_date) <= '$today'), 1,0)) AS received, 
						SUM(IF((file_hardcopy_status = 'received' || file_hardcopy_status = 'working') && (date(file_update_date) > '$_7days' && date(file_update_date) <= '$_3days'), 1,0)) AS received_3days, 
						SUM(IF((file_hardcopy_status = 'received' || file_hardcopy_status = 'working') && (date(file_update_date) > '$_10days' && date(file_update_date) <= '$_7days'), 1,0)) AS received_7days, 
						SUM(IF((file_hardcopy_status = 'received' || file_hardcopy_status = 'working') && date(file_update_date) <= '$_10days',1,0)) AS received_10days
						
						FROM ft_files						
						WHERE file_received_emp_id = '$userid' and file_mark_section_id = '$emp_section'  ");
					
						foreach($qry->result() as $files_deals) {  ?>
						<td> 
							<table style="border:no-border; width:100%;">
							<tr>
								<td>3 दिन से कम</td><td>3 दिन से ज्यादा</td><td>7 दिन से ज्यादा</td><td>10 दिन से ज्यादा</td>
							</tr>
							<tr>
								<td><a data-toggle="tooltip" data-original-title="Click Here For Display Files" href="<?php echo base_url(); ?>reports/moniter?secid=<?php echo $emp_section ?>&s=not&emp=<?php echo $userid; ?>&s_date=<?php echo $today ?>&e_date=<?php echo $_3days ?>" ><?php echo $files_deals->notreceive; ?></a></td>
								<td><a data-toggle="tooltip" data-original-title="Click Here For Display Files" href="<?php echo base_url(); ?>reports/moniter?secid=<?php echo $emp_section ?>&s=not&emp=<?php echo $userid; ?>&s_date=<?php echo $_3days ?>&e_date=<?php echo $_7days ?>" ><?php echo $files_deals->notreceive_3days; ?></a></td>
								<td <?php echo $files_deals->notreceive_7days > 0 ? 'style="background:#fb8888;"' : ''; ?>><a data-toggle="tooltip" data-original-title="Click Here For Display Files" href="<?php echo base_url(); ?>reports/moniter?secid=<?php echo $emp_section ?>&s=not&emp=<?php echo $userid; ?>&s_date=<?php echo $_7days ?>&e_date=<?php echo $_10days ?>" ><?php echo $files_deals->notreceive_7days; ?></a></td>
								<td <?php echo $files_deals->notreceive_10days > 0 ? 'style="background:red;"' : ''; ?>><a data-toggle="tooltip" data-original-title="Click Here For Display Files" href="<?php echo base_url(); ?>reports/moniter?secid=<?php echo $emp_section ?>&s=not&emp=<?php echo $userid; ?>&e_date=<?php echo $_10days ?>" ><?php echo $files_deals->notreceive_10days; ?></a></td>
								
							</tr>
							</table>
						</td>
						<td> 
							<table style="border:no-border; width:100%;">
							<tr>
								<td>3 दिन से कम</td><td>3 दिन से ज्यादा</td><td>7 दिन से ज्यादा</td><td>10 दिन से ज्यादा</td>
							</tr>
							<tr>
								<td><a data-toggle="tooltip" data-original-title="Click Here For Display Files" href="<?php echo base_url(); ?>reports/moniter?secid=<?php echo $emp_section ?>&s=received&emp=<?php echo $userid; ?>&s_date=<?php echo $today ?>&e_date=<?php echo $_3days ?>" ><?php echo $files_deals->received; ?></a></td>
								<td><a data-toggle="tooltip" data-original-title="Click Here For Display Files" href="<?php echo base_url(); ?>reports/moniter?secid=<?php echo $emp_section ?>&s=received&emp=<?php echo $userid; ?>&s_date=<?php echo $_3days ?>&e_date=<?php echo $_7days ?>" ><?php echo $files_deals->received_3days; ?></a></td>
								<td <?php echo $files_deals->received_7days > 0 ? 'style="background:#fb8888;"' : ''; ?>><a data-toggle="tooltip" data-original-title="Click Here For Display Files" href="<?php echo base_url(); ?>reports/moniter?secid=<?php echo $emp_section ?>&s=received&emp=<?php echo $userid; ?>&s_date=<?php echo $_7days ?>&e_date=<?php echo $_10days ?>" ><?php echo $files_deals->received_7days; ?></a></td>
								<td <?php echo $files_deals->received_10days > 0 ? 'style="background:red;"' : ''; ?>><a data-toggle="tooltip" data-original-title="Click Here For Display Files" href="<?php echo base_url(); ?>reports/moniter?secid=<?php echo $emp_section ?>&s=received&emp=<?php echo $userid; ?>&e_date=<?php echo $_10days ?>" ><?php echo $files_deals->received_10days; ?></a></td>
							</tr>
							</table>
						</td>
						<?php } ?>
						<!--<td>
							<table style="border:no-border; width:100%;">
							<tr>
								<td>शाखा में बंद हई </td><td>जावक में प्राप्त नहीं हुई </td><td>जावक में प्राप्त हुई </td><td>जावक ने बंद की  </td>
							</tr>
							<tr>
								<td><a data-toggle="tooltip" data-original-title="Click Here For Display Files" href="<?php //echo base_url(); ?>reports/moniter?secid=<?php //echo $emp_section ?>&s=2&a=dispetch&emp=<?php //echo $userid; ?>">
									<?php //echo $total['section_close'] ?></a>
								</td>
								<td><a data-toggle="tooltip" data-original-title="Click Here For Display Files" href="<?php //echo base_url(); ?>reports/moniter?secid=<?php //echo $emp_section ?>&s=2&a=dispetch&emp=<?php //echo $userid; ?>">
									<?php //echo $total['dispatch_not'] ?></a>
								</td>
								<td><a data-toggle="tooltip" data-original-title="Click Here For Display Files" href="<?php //echo base_url(); ?>reports/moniter?secid=<?php //echo $emp_section ?>&s=2&a=dispetch&emp=<?php //echo $userid; ?>">
									<?php //echo $total['dispatch_receive'] ?></a>
								</td>
								<td><a data-toggle="tooltip" data-original-title="Click Here For Display Files" href="<?php //echo base_url(); ?>reports/moniter?secid=<?php //echo $emp_section ?>&s=2&a=dispetch&emp=<?php //echo $userid; ?>">
									<?php //echo $total['dispatch_close'] ?></a>
								</td>
							</tr>
							</table>
						</td>
						<td> 
							<span data-toggle="tooltip" title="" class="badge bg-light-blue" data-original-title="<?php  //echo $total['working_another']; ?> Files">
							<?php //echo $total['working_another'] ?>
							</span>
						</td>-->
					</tr>
					<?php unset($total); } ?>
				</table> 
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.box-body -->
</div><!-- /.box -->

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
		
		$(document).ready(function(){	
			$('#loading-image').hide();	
			$("#emp_sections").change(function () {
				$('#loading-image').show();
				var section_id = $(this).val();				
				var HTTP_PATH = '<?php echo base_url(); ?>';
				$.ajax({
					type: "POST",
					url: HTTP_PATH + "activity_report/get_emloyees_section",
					datatype: "json",
					 async: false,
					 data: {section_id: section_id},
					 success: function(data) {
					   var r_data = JSON.parse(data);
					  // console.log(r_data);
					   var otpt = '<option value="">Select employee/Section</option>';                    
							$.each(r_data, function( index, value ) {
								console.log(value);
								if(value.emp_detail_gender=='m'){
									var fword_en='Shri';
									var fword_hi='श्री';
								}else if(value.emp_detail_gender=='f'){
									var fword_en='shushri';
									var fword_hi='सुश्री';
								}
								otpt += '<option value="'+value.emp_id+'">'+fword_hi+' '+value.emp_full_name_hi+'('+value.emprole_name_hi+')</option>';
							});
						
							$("#employee_list_section").html(otpt);
						},
							complete: function(){
							$('#loading-image').hide();
						}
				});
			});
		});
</script>
<script>
    function showpage(comp1)
    {
        window.location=comp1;
    }
</script>
