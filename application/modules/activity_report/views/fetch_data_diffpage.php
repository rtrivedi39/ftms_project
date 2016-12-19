<?php
//pre($this->uri->segments);
$officer_ids=get_officer_emp_ids();
if(end($this->uri->segments)==21){
	//echo 'welcome';
	$res1 = count_receivedfiles(21);
	$res0 = count_workingdfiles(21);
		
  $qry1="select count(file_id) as total_not_recived_file FROM ft_files where `file_return` !='2' and (ps_moniter_date!='' && ps_moniter_date!='0000-00-00')  and (file_hardcopy_status = 'not')";
    $qry2="select count(file_id) as total_dispatch_file FROM ft_files where (ps_moniter_date!='' && ps_moniter_date!='0000-00-00') and `file_return` ='2'";
}else{
	
	$res1 = count_receivedfiles($get_section[0]['section_id']);
	$res0 = count_workingdfiles($get_section[0]['section_id']);
	
    $qry1="select count(file_id) as total_not_recived_file  FROM ft_files where `file_mark_section_id`='".$get_section[0]['section_id']."' and `file_return` !='2' and (file_hardcopy_status = 'not')";
	
	$qry2="select count(file_id) as total_dispatch_file FROM ft_files where `file_mark_section_id`='".$get_section[0]['section_id']."' and `file_return` ='2'";
	
	
}

/*Total recievd file without dispatch*/
$res2 =  count_total_not_recived($get_section[0]['section_id']);

/*Totoal file sent to Dispetch section*/

$res3 =  count_not_closefile($get_section[0]['section_id']);

/*Total Dispose*/
$res4 =  count_Disposefile($get_section[0]['section_id']);

$total_dispatch_section_file_despose_despose=$res4['total_numb_of_dispose'];

/*Total section despost*/
$total_section_despose = get_total_close_file($get_section[0]['section_id'],1,'count_total_section_despose');

/*Total section recievd file*/

$res6 = count_totalrecievd($get_section[0]['section_id']);
/*Get File Not Received in section*/
 $file_not_received_section = get_officer_emp_based_file_list($get_section[0]['section_id'],null,$officer_ids,'count_section_base_files');
 /*End*/

 /*Get File not recieved at officer level*/
 $file_not_received_officer_level = get_officer_emp_based_file_list($get_section[0]['section_id'],null,$officer_ids,'count_officer_base_files');
 /*End*/
 $sec_id = $get_section[0]['section_id'];
?>
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
    <div class="row" id="divname">

        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><?php echo $get_section[0]['section_name_hi']." (".$get_section[0]['section_name_en'].")" ?></h3>
                    <div class="box-tools pull-right">
                        <button onclick="printContent('divname')" class="btn btn-primary no-print">Print</button>
                        <button class="btn btn-warning no-print" onclick="goBack()"><?php echo $this->lang->line('Back_button_label'); ?></button>
                    </div>
                </div>
                <div></div>
                    <div class="box-body">
                        <hr/>
                        <table class="table table-condensed">
						<?php if($sec_id != 8) { ?>
                            <tr>
                                <th>#</th>
                                <th>Section</th>
								<th>Total Files received from 22/09/2015 till date</th>
                                <!--<th title="Total Number of files received">Files received but work not started</th>-->
                                <th title="Total Number of files not received">File pending for receive in section</th>
                                <th title="Total Number of files not received">File pending for receive at officer level</th>
								<th title="Total Number of working files">Files in Progress</th>
                                <th title="Total Dispatch to Dispatch section">Disposed by Section</th>
								<th title="Total number of dispose">Status to Dispatch Section <br/>(Pending + Close)</th>

                            </tr>
                            <tr>
                                <td id="sno">1.</td>
                                <td id="section_name"><?php echo $get_section[0]['section_name_hi']." (".$get_section[0]['section_name_en'].")" ?></td>
                                <td id="total_files_received" style="cursor:pointer" onclick="showpage('<?php echo base_url(); ?>reports/moniter?secid=<?php echo $get_section[0]['section_id'] ?>')">
									<span data-toggle="tooltip" title="" class="badge bg-light-blue" data-original-title="<?php echo $res6; ?> Files">
									<?php echo $res6; ?>
									</span> <br/>Total Files
									<br/>(A)
                                </td>
								<!--<td id="file_work_not_started"  style="cursor:pointer" onclick="showpage('<?php echo base_url(); ?>reports/moniter?secid=<?php echo $get_section[0]['section_id']?>&s=received')"> <span class="badge bg-red" ><b><?php echo $res1['total_recieved_file']; ?></b> </span><br/>Total Files <br/>(B)</td>-->
                                <td id="file_recieved_in_section"  style="cursor:pointer" onclick="showpage('<?php echo base_url(); ?>reports/moniter?secid=<?php echo $get_section[0]['section_id'] ?>&s=not&lvl=section')"><span  class="badge bg-yellow"><b><?php echo $file_not_received_section['total_not_recived_file_in_section']; ?></b></span><br/>Total Files <br/>(C)</td>
                                <td id="file_recieved_in_officer"  style="cursor:pointer" onclick="showpage('<?php echo base_url(); ?>reports/moniter?secid=<?php echo $get_section[0]['section_id'] ?>&s=not&lvl=officer')"><span  class="badge bg-yellow"><b><?php echo $file_not_received_officer_level['total_not_recived_file_officers']; ?></b></span><br/>Total Files <br/>(D)</td>
								<td id="file_in_progress" style="cursor:pointer" onclick="showpage('<?php echo base_url(); ?>reports/moniter?secid=<?php echo $get_section[0]['section_id'] ?>&s=working')"><span  class="badge bg-green"><b><?php if(isset($res0['total_working_file']) && isset($res1['total_recieved_file']) ){ echo $res0['total_working_file'] + $res1['total_recieved_file']; } else{ echo 0 ;} ?></b></span><br/>Total Files <br/>(E)</td>
                                <td id="file_section_dispose"  style="cursor:pointer" onclick="showpage('<?php echo base_url(); ?>reports/moniter?secid=<?php echo $get_section[0]['section_id'] ?>&s=2&a=dispetch&lvl=section_dispose')"><span class="label label-info"><b><?php echo $total_section_despose;?><?php //echo $res3['total_numb_of_dispetch']; ?></b></span><br/>Total Files <br/>(F)</td>
								<td id="file_dispetch_section" ><span class="label label-info"><b><?php echo $res3['total_numb_of_dispetch'] + $total_dispatch_section_file_despose_despose; ?></b></span>&nbsp;Total Files <br/>(G)
									<br/><table style="margin-top:10px;">
											<tr>
												<td><b>Pending</b></td>
												<td><b>Close</b></td>
											</tr>
											<tr>
												<td style="cursor:pointer" onclick="showpage('<?php echo base_url(); ?>reports/moniter?secid=<?php echo $get_section[0]['section_id'] ?>&s=2&a=dispetch')"><span class="badge bg-red"><?php echo $res3['total_numb_of_dispetch']; ?></span></td>
												<td style="cursor:pointer" onclick="showpage('<?php echo base_url(); ?>reports/moniter?secid=<?php echo $get_section[0]['section_id'] ?>&s=2&a=dispetch&lvl=sent_dipatch_section')"><span class="badge bg-green"><?php echo $total_dispatch_section_file_despose_despose; ?></span></td>
											</tr>
									</table>
								</td>

                            </tr>
							<?php } else { ?>
							<tr>
                                <th width="5%"># data from 22/09/2015 to till date</th>
                                <th width="40%">Section</th>
								<th width="10%">Pending to receive less than 5 days</th>
								<th width="10%">Pending to receive more than 5 days </th>	
								<th width="10%">Receive but not close less than 5 days</th>														
								<th width="10%">Receive but not close more than 5 days</th>
								<th width="15%">Total</th>
                            </tr>
						<?php $i = 1; $today = date('Y-m-d');  $_5days = date('Y-m-d',strtotime($today.' -5 Days'));
						$sections = get_list(SECTIONS, null, "section_id not in ('8','1','21','25','26')");
						foreach($sections  as $key => $section) { 
						$qry = $this->db->query("SELECT count(file_id) AS fileno,
						SUM(IF(file_hardcopy_status = 'not' && (date(file_update_date) > '$_5days' && date(file_update_date) <= '$today'), 1,0)) AS notreceive,
						SUM(IF(file_hardcopy_status = 'not' && date(file_update_date) <= '$_5days' , 1,0)) AS notreceive_5days, 
						SUM(IF(file_hardcopy_status = 'received'  && (date(file_update_date) > '$_5days' && date(file_update_date) <= '$today'), 1,0)) AS received, 
						SUM(IF(file_hardcopy_status = 'received'  && date(file_update_date) <= '$_5days',1,0)) AS received_5days,
						 
						SUM(IF(file_hardcopy_status != 'close', 1,0)) AS total_files
						
						FROM ft_files						
						WHERE `file_mark_section_id`='".$section['section_id']."' and file_return = '2' ");
					
						foreach($qry->result() as $dipatch) { 
						?>
							<tr>
								<td class="text-center"><?php echo $i; ?></td>
								<td class="text-left"><?php echo $section['section_name_hi'].'-'.$section['section_name_en']; ?></td>
								<td class="text-center" style="cursor:pointer" onclick="showpage('<?php echo base_url(); ?>reports/moniter?secid=<?php echo $section['section_id'] ?>&s=not&on=2&a=dispetch&s_date=<?php echo $today ?>&e_date=<?php echo $_5days ?>')"><?php echo $dipatch->notreceive; ?></td>
								<td class="bg-danger text-center" style="cursor:pointer" onclick="showpage('<?php echo base_url(); ?>reports/moniter?secid=<?php echo $section['section_id'] ?>&s=not&on=2&a=dispetch&e_date=<?php echo $_5days ?>')"><?php echo $dipatch->notreceive_5days; ?></td>
								<td class="text-center" style="cursor:pointer" onclick="showpage('<?php echo base_url(); ?>reports/moniter?secid=<?php echo $section['section_id'] ?>&s=received&on=2&a=dispetch&s_date=<?php echo $today ?>&e_date=<?php echo $_5days ?>')"><?php echo $dipatch->received; ?></td>
								<td class="bg-danger text-center" style="cursor:pointer" onclick="showpage('<?php echo base_url(); ?>reports/moniter?secid=<?php echo $section['section_id'] ?>&s=received&on=2&a=dispetch&e_date=<?php echo $_5days ?>')"><?php echo $dipatch->received_5days; ?></td>
								<td class="text-center" style="cursor:pointer" onclick="showpage('<?php echo base_url(); ?>reports/moniter?secid=<?php echo $section['section_id'] ?>&s=2&a=dispetch')"><?php echo $dipatch->total_files; ?></td>
							</tr>
						<?php
							$ttlnotrcv = $ttlnotrcv + $dipatch->notreceive;
							$ttlrcv_5 = $ttlrcv_5 + $dipatch->notreceive_5days;
							$ttlrcv = $ttlrcv + $dipatch->received;
							$ttlnotrcv_5 = $ttlnotrcv_5 + $dipatch->received_5days;
							$grand_total = $grand_total + $dipatch->total_files;
						}
						$i++; } ?>
						<tr class="bg-info">
						<th colspan="2" class="text-center"><b>Grand Total</b></th>
						<th class="text-center"><b><?php echo $ttlnotrcv; ?></b></th>
						<th class="bg-danger text-center"><b><?php echo $ttlrcv_5; ?></b></th>
						<th class="text-center"><b><?php echo $ttlrcv; ?></b></th>
						<th class="bg-danger text-center"><b><?php echo $ttlnotrcv_5; ?></b></th>		
						<th class="text-center"><b><?php echo $grand_total; ?></b></th>
					
						</tr>
					<?php } ?>
                        </table>
						
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
		<?php if($sec_id != 8) { ?>
            <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-body">
				<?php $_10days = date('Y-m-d',strtotime(date('Y-m-d').' -10 Days'));  ?>
                    <table class="table table-condensed stripeTable12">
                        <tr>
                            <th>#</th>
                            <th>File in Progress</th>
                            <th>Received</th>
                            <th>Not Received</th>
                            <th>Total File (C+D+E)<br/><span class="badge bg-red"><?php if( isset($res1['total_recieved_file']) && isset( $file_not_received_section['total_not_recived_file_in_section'] ) && isset($file_not_received_officer_level['total_not_recived_file_officers'] ) && isset( $res0['total_working_file'])) { echo $res1['total_recieved_file'] +  $file_not_received_section['total_not_recived_file_in_section'] + $file_not_received_officer_level['total_not_recived_file_officers'] + $res0['total_working_file'] ;}else { echo 0 ;} ?></span></th>
                            <th>Closed files</th>
							<th style="background-color:#FFA4A4">Pending more <br/> than 10 days</th>
						</tr>
                        <?php
						$report_sectionid=end($this->uri->segments);
                        if(end($this->uri->segments)==21){
                            $qry = $this->db->query();
                            $file_rows= get_rows("SELECT file_received_emp_id , count(file_id) AS fileno, SUM(IF(file_hardcopy_status = 'received' || file_hardcopy_status = 'working', 1,0)) AS received, SUM(IF(file_hardcopy_status = 'not', 1,0)) AS notreceive , SUM(IF(date(file_update_date) <= '".$_10days."', 1,0)) AS pending_10 FROM ft_files WHERE (ps_moniter_date!='' && ps_moniter_date!='0000-00-00') GROUP by `file_received_emp_id` ORDER BY fileno DESC");
                        }else{
                            /*echo $qry_abc_str="SELECT file_received_emp_id , count(file_id) AS fileno, SUM(IF(file_hardcopy_status = 'received' || file_hardcopy_status = 'working', 1,0)) AS received, SUM(IF(file_hardcopy_status = 'not', 1,0)) AS notreceive FROM ft_files WHERE `file_mark_section_id`='".$get_section[0]['section_id']."' GROUP by `file_received_emp_id` ORDER BY fileno DESC";
							 $qry_abc = $this->db->query($qry_abc_str);
							 $sql_qry_old="SELECT CONCAT(emp.emp_title_hi,' ',emp.emp_full_name_hi)  AS empnam,
							    emrole.emprole_name_hi AS empdesignation,emp.emp_id,emprole_level,designation_id,
								COUNT(DISTINCT(dispose.file_id)) AS total_closefile
								FROM ft_employee AS emp 
								LEFT JOIN `ft_emprole_master` AS emrole ON emrole.role_id=emp.designation_id 
								LEFT JOIN `ft_file_dispatch` AS dispose ON dispose.emp_id=emp.emp_id and issection_despose=1 
								WHERE FIND_IN_SET($report_sectionid,emp.emp_section_id) and emrole.emprole_level !=12 and emrole.emprole_level !=10   
								GROUP BY emp.emp_id 
								ORDER BY emrole.emprole_level DESC";
								*/
							$sql_qry = "SELECT CONCAT(emp.emp_title_hi,' ',emp.emp_full_name_hi) AS empnam, emrole.emprole_name_hi AS empdesignation,emp.emp_section_id,
emp.emp_id,scname.section_name_hi as section_name,emprole_level,designation_id, fls.file_received_emp_id ,COUNT(fls.file_id) AS fileno,
SUM(IF(fls.file_mark_section_id=$report_sectionid && fls.file_hardcopy_status = 'received' || fls.file_hardcopy_status = 'working', 1,0)) AS received, 
  SUM(IF(fls.file_mark_section_id=$report_sectionid && fls.file_hardcopy_status = 'not', 1,0)) AS notreceive,
  SUM(IF(fls.file_mark_section_id=$report_sectionid && date(file_update_date) <= '".$_10days."' && fls.file_hardcopy_status != 'close', 1,0)) AS pending_10
FROM ft_files AS fls
INNER JOIN ft_employee AS emp ON emp.emp_id=fls.file_received_emp_id
INNER JOIN `ft_sections_master` AS scname ON scname.section_id=emp.emp_section_id
LEFT JOIN `ft_emprole_master` AS emrole ON emrole.role_id=emp.designation_id 
WHERE fls.file_mark_section_id!=27 and ( (FIND_IN_SET($report_sectionid,emp.emp_section_id) and emrole.emprole_level>=13 ) OR fls.file_mark_section_id=$report_sectionid)  
GROUP BY fls.file_received_emp_id HAVING (notreceive>0 OR received>0 OR FIND_IN_SET($report_sectionid,emp.emp_section_id)) ORDER BY emrole.emprole_level DESC,emp.emp_section_id ASC"; 
							$file_rows=get_rows($sql_qry);                            
                        }
                        /*Get employee id*/
                        //pr($file_rows);
                        if(count($file_rows)>0){	
							$i=1;
							foreach($file_rows as $fky=>$fval) {   
									if($fval['emp_section_id']!=8){
										//$count_pending_filesql="SELECT files.file_received_emp_id , COUNT(files.file_id) AS fileno, SUM(IF(files.file_hardcopy_status = 'received' || files.file_hardcopy_status = 'working', 1,0)) AS received, SUM(IF(files.file_hardcopy_status = 'not', 1,0)) AS notreceive , SUM(IF(DATE(file_update_date) <= '2016-08-03', 1,0)) AS pending_10 FROM ft_files AS files INNER JOIN ft_employee AS emp ON emp.emp_id=files.file_received_emp_id WHERE files.file_mark_section_id='11' AND files.file_hardcopy_status != 'close' and files.file_received_emp_id=".$fval['emp_id']." GROUP BY files.file_received_emp_id ";
										//$pending_files_detail = get_row($count_pending_filesql);										
										
										$show_sect_id = end($this->uri->segments);
										if($fval['emprole_level']>6){
											//pr($fval);
											if($fval['emp_section_id']==$show_sect_id){
												$emp_sectionwise[$fval['section_name']][]=$fval;
											}else{
												$emp_sectionwise[$fval['section_name']][]=$fval;
											}											
										}else{
											$emp_sectionwise['अनुभाग  अधिकारी/अधिकारी'][]=$fval;
										}
									}
							}
							foreach($emp_sectionwise as $fsky=>$fsval){	
									echo '<tr><td></td><td colspan="5"><span class="badge bg-yellow"><b>'.ucfirst($fsky).'</b></span></td></tr>';
									foreach($fsval as $fval){
										$pending_files_detail = $fval;
    								?>    								
                                    <tr class="stripeRow" <?php if($fval['emprole_level']<6){ ?> style="background-color:#949494"<?php }else if($fval['emprole_level']==6 || $fval['emprole_level']==7 ){ echo 'style="background-color:#CECECE"'; }?>>
                                        <td><?php echo $i ;?>. </td>
                                        <td  title="Click to show total numbers of files" style="cursor:pointer" onclick="showpage('<?php echo base_url(); ?>reports/moniter?secid=<?php echo $get_section[0]['section_id'] ?>&emp=<?php echo $fval['emp_id']; ?>')"><?php echo $fval['empnam'].' ('.$fval['empdesignation'].')';  ?> </td>
                                        <td style="cursor:pointer" onclick="showpage('<?php echo base_url(); ?>reports/moniter?secid=<?php echo $get_section[0]['section_id'] ?>&s=received&emp=<?php echo $fval['emp_id']; ?>')" class="qtr-1"><?php if(isset($pending_files_detail['file_received_emp_id'])){ echo $pending_files_detail['received'];}else{ echo 0;} ?></td>
                                        <td style="cursor:pointer" onclick="showpage('<?php echo base_url(); ?>reports/moniter?secid=<?php echo $get_section[0]['section_id'] ?>&s=not&emp=<?php echo $fval['emp_id']; ?>')" class="qtr-2"><?php if(isset($pending_files_detail['notreceive'])){ echo $pending_files_detail['notreceive'];}else{ echo 0;}  ?></td>
                                        <td  id="total_price" style="cursor:pointer" onclick="showpage('<?php echo base_url(); ?>reports/moniter?secid=<?php echo $get_section[0]['section_id'] ?>&emp=<?php echo $fval['emp_id']; ?>')">
    										<span data-toggle="tooltip" title="" class="badge bg-light-blue" data-original-title="<?php echo isset($pending_files_detail['fileno'])? $pending_files_detail['fileno']:''; ?> File">
    											<?php //echo $record1->fileno; ?>
    										</span>    										
    									</td>
    									<td style="cursor:pointer" onclick="showpage('<?php echo base_url(); ?>reports/moniter?&lvl=emp_section_dispose&a=dispetch&secid=<?php echo $get_section[0]['section_id'] ?>&emp=<?php echo $fval['emp_id']; ?>')">																																
    										<span data-toggle="tooltip" title="" class="badge bg-light-blue">
													<?php echo get_total_close_file($show_sect_id,$fval['emp_id'],'individual_emp_close'); ?>
											</span>
											<input type="hidden" class="teat_count_price"  name="" id="test_price" />
    									</td>
										<td style="background-color:#FFA4A4"><?php if(isset($pending_files_detail['pending_10'])){ echo $pending_files_detail['pending_10'];}else{ echo 0;}  ?></td>
                                   </tr>
							<?php $i++; 
									}
                                }  echo '<tr><td></td><td></td><td></td><td></td><td id="total_quantity"></td><td ></td></tr>';
                            } else{ ?>
                            <tr>
                                <td colspan="5" align="center"> No Records Found  </td>
                            </tr>
                        <?php } //pr($emp_sectionwise); ?>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
            </div>
			<?php } ?>
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