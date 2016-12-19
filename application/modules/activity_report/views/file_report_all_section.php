<?php $officer_ids=get_officer_emp_ids();?>
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
                    <h3 class="box-title">All Sections Report</h3>
                    <div class="box-tools pull-right">
                        <button onclick="printContent('divname')" class="btn btn-primary no-print">Print</button>
                        <button class="btn btn-warning no-print" onclick="goBack()"><?php echo $this->lang->line('Back_button_label'); ?></button>
                    </div>
                </div>
                <div></div>
                    <div class="box-body">
                        <hr/>
                        <table class="table table-condensed">
                            <tr>
                                <th>#</th>
                                <th>Section</th>
								<th>Total Files received from 22/09/2015 till date</th>
                                <!--<th title="Total Number of files received">Files received but work not started</th>-->
                                <th title="Total Number of files not received">File pending for receive in section</th>
                                <th title="Total Number of files not received">File pending for receive at officer level</th>
								<th title="Total Number of working files">Files in Progress</th>
                                <th title="Total Dispatch to Dispatch section">Disposed by section</th>
								<th title="Total number of dispose">Status to Dispatch Section <br/>(Pending + Close)</th>

                            </tr>
                            <?php if(count($get_section)>0){?>
                                <?php $sn=1;  foreach ($get_section as $section) {
										if($sec['section_id'] != '26' && $sec['section_id'] != '1' && $sec['section_id']!='8'){
                                        /*Get File Not Received in section*/
                                        $file_not_received_section = get_officer_emp_based_file_list($section['section_id'],null,$officer_ids,'count_section_base_files');
                                        /*End*/
                                        $query6 = $this->db->query("select count(file_id) as total_sections_file FROM ft_files where `file_mark_section_id`='".$section['section_id']."'");
                                        $res6 =  $query6->row_array();
                                        /*Get File Not Received in section*/
                                        $file_not_received_section = get_officer_emp_based_file_list($section['section_id'],null,$officer_ids,'count_section_base_files');
                                        /*End*/
                                        /*Get File not recieved at officer level*/
                                         $file_not_received_officer_level = get_officer_emp_based_file_list($section['section_id'],null,$officer_ids,'count_officer_base_files');
                                         /*End*/
                                        $qry0="select count(file_id) as total_working_file FROM ft_files where `file_mark_section_id`='".$section['section_id']."' and `file_return` !='2' and file_hardcopy_status = 'working'";
                                        $query0 = $this->db->query($qry0);
                                        $res0 =  $query0->row_array();

                                        $qry="select count(file_id) as total_recieved_file FROM ft_files where `file_mark_section_id`='".$section['section_id']."' and `file_return` !='2' and file_hardcopy_status = 'received'";
                                        $query = $this->db->query($qry);
                                        $res1 =  $query->row_array();

                                        /*Total section despose*/
                                        $total_section_despose = get_total_close_file($section['section_id'],1,'count_total_section_despose');

                                        $query = $this->db->query("select count(file_id) as total_numb_of_dispetch FROM ft_files where `file_mark_section_id`='".$section['section_id']."' and file_hardcopy_status!='close' and file_return='2'");
                                        $res3 =  $query->row_array();

                                        /*Total Dispose*/
										$query5 = $this->db->query("select count(file_id) as total_numb_of_dispose FROM ft_files where `file_mark_section_id`='".$section['section_id']."' and file_hardcopy_status = 'close' and `file_return` ='2'");
										$res4 =  $query5->row_array();
										$total_dispatch_section_file_despose_despose=$res4['total_numb_of_dispose'];

                                ?>
                                    <tr>
                                        <td id="sno" title="Section Number:<?php echo $section['section_id']; ?>"><?php echo $sn; ?></td>
                                        <td id="section_name"><?php echo $section['section_name_hi']." (".$section['section_name_en'].")" ?></td>
                                        <td id="total_files_received" style="cursor:pointer" onclick="showpage('<?php echo base_url(); ?>reports/moniter?secid=<?php echo $section['section_id'] ?>')">
        									<span data-toggle="tooltip" title="" class="badge bg-light-black" data-original-title="<?php echo $res6['total_sections_file']; ?> Files">
        									<?php echo $res6['total_sections_file']; ?>
        									</span> <br/>Total Files
        									<br/>(A)
                                        </td>
        								<!--<td id="file_work_not_started"  style="cursor:pointer" onclick="showpage('<?php echo base_url(); ?>reports/moniter?secid=<?php echo $section['section_id']?>&s=received')"> <span class="badge bg-red" ><b><?php echo $res1['total_recieved_file']; ?></b> </span><br/>Total Files <br/>(B)</td>-->
                                        <td id="file_recieved_in_section"  style="cursor:pointer" onclick="showpage('<?php echo base_url(); ?>reports/moniter?secid=<?php echo $section['section_id'] ?>&s=not&lvl=section')"><span  class="badge bg-yellow"><b><?php echo $file_not_received_section['total_not_recived_file_in_section']; ?></b></span><br/>Total Files <br/>(C)</td>
                                        <td id="file_recieved_in_officer"  style="cursor:pointer" onclick="showpage('<?php echo base_url(); ?>reports/moniter?secid=<?php echo $section['section_id'] ?>&s=not&lvl=officer')"><span  class="badge bg-yellow"><b><?php echo $file_not_received_officer_level['total_not_recived_file_officers']; ?></b></span><br/>Total Files <br/>(D)</td>
        								<td id="file_in_progress" style="cursor:pointer" onclick="showpage('<?php echo base_url(); ?>reports/moniter?secid=<?php echo $section['section_id'] ?>&s=working')"><span  class="badge bg-green"><b><?php echo $res0['total_working_file'] + $res1['total_recieved_file']; ?></b></span><br/>Total Files <br/>(E)</td>
                                        <td id="file_section_dispose"  style="cursor:pointer" onclick="showpage('<?php echo base_url(); ?>reports/moniter?secid=<?php echo $section['section_id'] ?>&s=2&a=dispetch&lvl=section_dispose')"><span class="label label-info"><b><?php echo $total_section_despose;?><?php //echo $res3['total_numb_of_dispetch']; ?></b></span><br/>Total Files <br/>(F)</td>
        								<td id="file_dispetch_section" ><span class="label label-info"><b><?php echo $res3['total_numb_of_dispetch'] + $total_dispatch_section_file_despose_despose; ?></b></span>&nbsp;Total Files <br/>(G)
        									<br/><table style="margin-top:10px;">
        											<tr>
        												<td><b>Pending</b></td>
        												<td><b>Close</b></td>
        											</tr>
        											<tr>
        												<td style="cursor:pointer" onclick="showpage('<?php echo base_url(); ?>reports/moniter?secid=<?php echo $section['section_id'] ?>&s=2&a=dispetch')"><span class="badge bg-red"><?php echo $res3['total_numb_of_dispetch']; ?></span></td>
        												<td style="cursor:pointer" onclick="showpage('<?php echo base_url(); ?>reports/moniter?secid=<?php echo $section['section_id'] ?>&s=2&a=dispetch&lvl=sent_dipatch_section')"><span class="badge bg-green"><?php echo $total_dispatch_section_file_despose_despose; ?></span></td>
        											</tr>
        									</table>
        								</td>

                                    </tr>
									<?php $sn++; }?>    
								<?php } } ?>
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
