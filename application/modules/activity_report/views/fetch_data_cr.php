<!-- Content Header (Page header) -->
<style>
@media print
{    
    #divname table, #divname1 table{
		font-size:12px;
	}
}

</style>
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
    <div class="row" >
		<div class="col-xs-12 no-print">
			<form role="form" method="post" action="<?php echo base_url()?>activity_report/fetch_data_cr"  enctype="multipart/form-data">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Please select date</h3>
				</div>
				<div class="box-body">
				<table class="table table-condensed">
					<tr>
						<th>Start date</th>
						<th>End date</th>
					</tr>
					<tr>
						<td>
							<input type="text" name="start_date" id="start_date" class="date_picker form-control" value="<?php echo get_date_formate($start_date, 'd-m-Y'); ?>" placeholder="Select start date" class="form-control">
						</td>
						<td>
							<input type="text" name="end_date" id="end_date" class="date_picker form-control" value="<?php echo get_date_formate($end_date, 'd-m-Y'); ?>" placeholder="Select end date" class="form-control">
						</td>
						<td>
							<button class="btn btn-primary" type="submit">Search</button>
						</td>
					</tr>
				</table>
				</div>
			</div>
			</form>
		</div>
        <div class="col-xs-12" id="divname">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><?php echo $get_section[0]['section_name_hi']." (".$get_section[0]['section_name_en'].")" ?> में दिनांक <?php echo get_date_formate($start_date, 'd-m-Y'); ?> से दिनांक <?php echo get_date_formate($end_date, 'd-m-Y'); ?> तक का विवरण</h3>
                    <div class="box-tools pull-right no-print">
                        <button onclick="printContent('divname')" class="btn btn-primary no-print">Print</button>
                        <button class="btn btn-warning no-print" onclick="goBack()"><?php echo $this->lang->line('Back_button_label'); ?></button>
                    </div>
                </div>
                <div></div>
                    <div class="box-body">
                        <table class="table table-condensed">
						
							<tr>
                                <th width="10%">#</th>
                                <th width="*%">Mark Section</th>
								<th width="15%">New entry</th>
								<th width="15%">Old entry(Refrence number) </th>	
								<th width="15%">Total Entry</th>														
																					
                            </tr>
							<?php
							
							$ttloldentry = $ttlttlnewentry = $grand_total =  0; $i = 1; $today = date('Y-m-d');  
							$sections = get_list(SECTIONS, null, "section_id not in ('8','1','21','25','26')");
							$persional = array(
									array
									(
										'section_id' => '100',
										'section_name_hi' => 'व्यक्तिगत',
										'section_name_en' => 'Personal',
										'section_short_name' => 'PR',
										'section_code' => '',
										'section_created_date' => '',
									)
									);
							$section_all  = array_merge($sections, $persional);		
							//pr($section_all);
							foreach($section_all  as $key => $section) { 							
							$qry = $this->db->query("SELECT count(file_id) AS fileno,
							SUM(IF(old_registared_no = '0', 1,0)) AS new_entry,	
							SUM(IF(old_registared_no != '0', 1,0)) AS old_entry
							 
							FROM ft_files						
							WHERE `file_mark_section_id`='".$section['section_id']."' ANd (date(file_created_date) >='$start_date' and date(file_created_date) <='$end_date') ORDER BY fileno");
						
							foreach($qry->result() as $dipatch) { 
							?>
								<tr>
									<td class="text-center"><?php echo $i; ?>.</td>
									<td class="text-left"><?php echo $section['section_name_hi'].'-'.$section['section_name_en']; ?></td>
									<td style="cursor:pointer" onclick="showpage('<?php echo base_url('activity_report'); ?>/file_moniter/files_cr?secid=<?php echo $section['section_id'] ?>&t=new&s_date=<?php echo $start_date; ?>&e_date=<?php echo $end_date; ?>')" class="text-center"> <?php echo $dipatch->new_entry; ?></td>
									<td style="cursor:pointer" onclick="showpage('<?php echo base_url('activity_report'); ?>/file_moniter/files_cr?secid=<?php echo $section['section_id'] ?>&t=old&s_date=<?php echo $start_date; ?>&e_date=<?php echo $end_date; ?>')" class="text-center"><?php echo $dipatch->old_entry; ?></td>
									<td style="cursor:pointer" onclick="showpage('<?php echo base_url('activity_report'); ?>/file_moniter/files_cr?secid=<?php echo $section['section_id'] ?>&t=all&s_date=<?php echo $start_date; ?>&e_date=<?php echo $end_date; ?>')" class="text-center"><?php echo $dipatch->new_entry + $dipatch->old_entry; ?></td>
									
								</tr>
							<?php
								$ttloldentry = $ttloldentry + $dipatch->new_entry;
								$ttlttlnewentry = $ttlttlnewentry + $dipatch->old_entry;					
							}
							$i++; } ?>
							<tr class="bg-info">
								<th colspan="2" class="text-center"><b>Grand Total</b></th>
								<th class="text-center"><b><?php echo $ttloldentry; ?></b></th>
								<th class="text-center"><b><?php echo $ttlttlnewentry; ?></b></th>
								<th class="text-center"><b><?php echo $ttloldentry + $ttlttlnewentry; ?></b></th>
							</tr>
					
                        </table>
						
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>

       <div class="col-xs-12" id="divname1">
            <div class="box box-primary">
				<div class="box-header">
                    <h3 class="box-title"><?php echo $get_section[0]['section_name_hi']." (".$get_section[0]['section_name_en'].")" ?> में दिनांक <?php echo get_date_formate($start_date, 'd-m-Y'); ?> से दिनांक <?php echo get_date_formate($end_date, 'd-m-Y'); ?> तक का विवरण</h3>
                    <div class="box-tools pull-right no-print">
                        <button onclick="printContent('divname1')" class="btn btn-primary no-print">Print</button>
                        <button class="btn btn-warning no-print" onclick="goBack()"><?php echo $this->lang->line('Back_button_label'); ?></button>
                    </div>
                </div>
				<div class="box-body">
                    <table class="table table-condensed stripeTable12">
                        <tr>
                            <th>#</th>
                            <th>Employee name</th>
                            <th>New entry</th>
                            <th>Old entry</th>
                            <th>Total entry</th>
							<th>File return</th>	
							<th>Daily files created</th>	
                        </tr>
                        <?php
						$qry_emp = $this->db->query("select group_concat(emp_id) as cr_emp from ft_employee where `role_id` = '9'");
						$result = $qry_emp->row_array();
						$emps = $result['cr_emp'];
							
						$ttloldentry = $ttlttlnewentry = $grand_total = $ttlttlreturn=  0;
                        $qry = $this->db->query("SELECT createfile_empid , 
						count(file_id) AS fileno,
						SUM(IF(old_registared_no = '0', 1,0)) AS new_entry, 
						SUM(IF(old_registared_no != '0', 1,0)) AS old_entry,
						SUM(IF((file_return = '3' || file_return = '1') &&  file_received_emp_id in(".$emps."), 1,0)) AS file_return

						FROM ft_files 
						WHERE (date(file_created_date) >= '$start_date' and date(file_created_date) <= '$end_date')
						AND createfile_empid IN ($emps)
						GROUP by `createfile_empid`
						ORDER BY fileno DESC");
                     
                        if($qry->num_rows() != 0) {
                            $i = '1';
                            $record1 = $qry->result() ;
								foreach($record1 as $record){
    								?>
                                    <tr class="stripeRow">
                                        <td class="text-center"><?php echo $i ;?>. </td>
                                        <td class="text-left"><?php  echo getemployeeName($record->createfile_empid, true);?></td>
                                        <td style="cursor:pointer" onclick="showpage('<?php echo base_url('activity_report'); ?>/file_moniter/files_cr?emp=<?php echo $record->createfile_empid; ?>&t=new&s_date=<?php echo $start_date; ?>&e_date=<?php echo $end_date; ?>')" class="text-center"><?php  echo $record->new_entry ;?></td>
                                        <td style="cursor:pointer" onclick="showpage('<?php echo base_url('activity_report'); ?>/file_moniter/files_cr?emp=<?php echo $record->createfile_empid; ?>&t=old&s_date=<?php echo $start_date; ?>&e_date=<?php echo $end_date; ?>')" class="text-center"><?php  echo $record->old_entry ;?></td>
                                        <td style="cursor:pointer" onclick="showpage('<?php echo base_url('activity_report'); ?>/file_moniter/files_cr?emp=<?php echo $record->createfile_empid; ?>&t=all&s_date=<?php echo $start_date; ?>&e_date=<?php echo $end_date; ?>')" class="text-center"><?php  echo $record->new_entry + $record->old_entry ;?></td>
                                        <td style="cursor:pointer" onclick="showpage('<?php echo base_url('activity_report'); ?>/file_moniter/files_cr?emp=<?php echo $record->createfile_empid; ?>&t=return&s_date=<?php echo $start_date; ?>&e_date=<?php echo $end_date; ?>')" class="text-center"><?php echo $record->file_return; ?></td>
                                        <td style="cursor:pointer" onclick="showpage('<?php echo base_url('activity_report'); ?>/file_moniter/daily_files_cr?emp=<?php echo $record->createfile_empid; ?>&s_date=<?php echo $start_date; ?>&e_date=<?php echo $end_date; ?>')" class="text-center">View</td>
                                    </tr>
                                    <?php 
										$ttloldentry = $ttloldentry + $record->new_entry;
										$ttlttlnewentry = $ttlttlnewentry + $record->old_entry;					
										$ttlttlreturn = $ttlttlreturn + $record->file_return;					
									$i++; }
                        } else{ ?>
                            <tr>
                                <td colspan="5" align="center"> No Records Found  </td>
                            </tr>
                        <?php } ?>
							<tr class="bg-info">
								<th colspan="2" class="text-center"><b>Grand Total</b></th>
								<th class="text-center"><b><?php echo $ttloldentry; ?></b></th>
								<th class="text-center"><b><?php echo $ttlttlnewentry; ?></b></th>
								<th class="text-center"><b><?php echo $ttloldentry + $ttlttlnewentry; ?></b></th>
								<th class="text-center"><b><?php echo $ttlttlreturn; ?></b></th>
								<th></th>
							</tr>
                    </table>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
		
		<div class="col-xs-12" id="divname2">
            <div class="box box-primary">
				<div class="box-header">
                    <h3 class="box-title">CSU में दिनांक <?php echo get_date_formate($start_date, 'd-m-Y'); ?> से दिनांक <?php echo get_date_formate($end_date, 'd-m-Y'); ?> तक का विवरण</h3>
                    <div class="box-tools pull-right no-print">
                        <button onclick="printContent('divname2')" class="btn btn-primary no-print">Print</button>
                        <button class="btn btn-warning no-print" onclick="goBack()"><?php echo $this->lang->line('Back_button_label'); ?></button>
                    </div>
                </div>
				<div class="box-body">
                    <table class="table table-condensed stripeTable12">
                        <tr>
                            <th>#</th>
                            <th>Employee name</th>
                            <th>Total scanned</th>
                            <!--<th>Total direct mark</th>
                            <th>Total Files</th>-->
							<th>Daily files created</th>	
                        </tr>
                        <?php
						$ttloldentrycsu =  $ttloldentrycsus = $ttloldentrycsud = 0; 
						$i = 1;
						$scan_emp = 0;
						$qry_emp_csu = $this->db->query("select group_concat(emp_id) as scan_emp from ft_employee where `role_id` = '39' and emp_id!=218");
						$result = $qry_emp_csu->row_array();
						$scan_emp = $result['scan_emp'];	
						
						/*$query_csu = "  SELECT fmove_previous_user_id as scan_emp,
										count(distinct(fmove_file_id)) as Total_files
										
									    FROM `ft_file_movements`
										join `ft_files` on  `ft_files`.file_id = `ft_file_movements`.fmove_file_id
										WHERE  scan_id != '' and `fmove_previous_user_id` in($scan_emp)
										and date(fmove_created_datetime) >= '$start_date' 
										and date(fmove_created_datetime) <= '$end_date'
										group by fmove_previous_user_id";
						*/
						$query_csu = "SELECT fmove_previous_user_id as scan_emp,
						count(fmove_file_id) as Total_files										
					    FROM `ft_file_movements`
						join `ft_files` on  `ft_files`.file_id = `ft_file_movements`.fmove_file_id
						WHERE  `fmove_previous_user_id` in($scan_emp)
						and date(fmove_created_datetime) >= '$start_date' 
						and date(fmove_created_datetime) <= '$end_date' and (`fmove_current_user_id`!=`fmove_previous_user_id` || (`fmove_current_user_id`=`fmove_previous_user_id` and ft_file_movements.file_return = '2' and ft_files.file_hardcopy_status = 'close'))
						group by fmove_previous_user_id";
							$qry_files_Csu = $this->db->query($query_csu);
						if($qry_files_Csu->num_rows() != 0) {
                            $i = '1';
                            $record_csu = $qry_files_Csu->result() ;
								foreach($record_csu as $res_csu){
				
							?>
							<tr class="stripeRow">
								<td class="text-center"><?php echo $i ;?>. </td>
								<td class="text-left"><?php  echo getemployeeName($res_csu->scan_emp, true); ?></td>
								<td class="text-center"><?php echo $res_csu->Total_files; ?></td>
							<?php /*	<td class="text-center"><?php echo $res_csu->Total_files; ?></td>
								<td class="text-center"><?php echo $res_csu->Total_files + $res_csu->Total_files; ?></td>*/ ?>
								<td style="cursor:pointer" onclick="showpage('<?php echo base_url('activity_report'); ?>/file_moniter/daily_files_cr?emp=<?php echo $res_csu->scan_emp; ?>&s_date=<?php echo $start_date; ?>&e_date=<?php echo $end_date; ?>&for=csu')" class="text-center">View </td>	 
								</tr>
						<?php 
							$ttloldentrycsus = $ttloldentrycsus + $res_csu->Total_files;
							//$ttloldentrycsud = $ttloldentrycsud + $res_csu->Total_files;
							//$ttloldentrycsu = $ttloldentrycsus + $ttloldentrycsud;
								$i++; }
								
						} else{ ?>
                            <tr>
                                <td colspan="5" align="center"> No Records Found  </td>
                            </tr>
                        <?php } ?>		
						
						<tr class="bg-info">
							<th colspan="2" class="text-center"><b>Grand Total</b></th>
							<th class="text-center"><b><?php echo $ttloldentrycsus; ?></b></th>
							<?php /*<th class="text-center"><b><?php echo $ttloldentrycsud; ?></b></th>
							<th class="text-center"><b><?php echo $ttloldentrycsu; ?></b></th>*/ ?>
							<th></th>
						</tr>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div><!-- /.row -->
 <!-- Main row -->
</section><!-- /.content -->
<script>
    function printContent(el){
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }
</script>
<script>
    function showpage(comp1)
    {
        window.location=comp1;
    }
</script>
