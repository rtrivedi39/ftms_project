<?php
$section_id = getEmployeeSection();
$section_exp = explode(',',$section_id);
$files_year = $this->input->post('files_year') != '' ? $this->input->post('files_year') : date('Y');
$files_month = $this->input->post('files_month') != '' ? $this->input->post('files_month') : date('m');
$files_section = $this->input->post('files_section') != '' ? $this->input->post('files_section') : '';
$files_user = $this->input->post('files_user') != '' ? $this->input->post('files_user') : $this->session->userdata("emp_id");
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
		<div class="col-xs-12 no-print" > 
			<div class="box box-primary">
			<form method="post" action="<?php echo base_url(); ?>show_file/csu" class="no-print">
				
				<div class="box-body">
					<div class="row">
						<div class="col-md-2">
							<label>वर्ष</label>
							<select class="form-control" id="files_year" name="files_year">
							<?php $i = '2015';
							while($i <= date('Y')) { ?>
								<option value="<?php echo $i ; ?>" <?php echo $files_year == $i ? 'selected' : ''; ?>><?php echo $i ;?></option>
							<?php $i++; } ?>
							</select>
						</div>
						<div class="col-md-2">
							<label>माह</label>
							<select class="form-control" id="files_month" name="files_month">
                                    <option value="">Select Month</option>
							<?php $i = '01';
							foreach(all_month() as $i => $months) { ?>
								<option value="<?php echo $i ; ?>" <?php echo $files_month == $i ? 'selected' : ''; ?>><?php echo $months ;?> <?php echo $files_month == $i ? '(All File View)' : false; ?></option>
							<?php $i++; } ?>
							</select>
						</div>
						<div class="col-md-2">
							<label>अंकित शाखा</label>
							<select class="form-control" id="files_section" name="files_section">
                                    <option value="">Select Section</option>
								<?php $sections = get_list(SECTIONS, null, "section_id not in ('8','1','26')");
								$i=1; foreach($sections  as $key => $section){?>
								<option value="<?php echo $section['section_id']; ?>" <?php echo $files_section == $section['section_id'] ? 'selected' : ''; ?>><?php echo $section['section_name_hi'] ; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="col-md-3">
							<label>एंट्री ऑपरेटर का नाम</label>
							<select class="form-control" id="files_user" name="files_user">
                                    <option value="">Select entry user</option>
							<?php 
							$qry_emp = $this->db->query("select group_concat(emp_id) as cr_emp from ft_employee where `role_id` = '9'");
							$result = $qry_emp->row_array();
							$emps = $result['cr_emp'];							
							$employees = get_list(EMPLOYEES, null, "emp_id in (".$emps.")");
							$i=1; foreach($employees  as $key => $emp){?>							
							<option value="<?php echo $emp['emp_id']; ?>" <?php echo $files_user == $emp['emp_id'] ? 'selected' : ''; ?>><?php echo getemployeeName($emp['emp_id'], true) ; ?></option>
							<?php } ?>
							</select>
						</div>
						<div class="col-md-3">
						<br/>
						<button type="submit" class="btn-primary btn">खोजे</button>
						</div>
					</div>
				
                        <div class="row" align="center">
                                <?php
                                foreach($sections  as $key =>  $empsec){
                                    if (isset($empsec['section_id'])) {
                                            $cls = "class='btn btn-default btn-sm btn-flat margin'";
                                            if((isset($sec_id) && $sec_id == $empsec['section_id']) || (isset($files_section) && $files_section ==$empsec['section_id'])){$cls = "class='btn btn-primary btn-sm btn-flat margin'"; } ?>
                                            <a href="<?php echo base_url();?>show_file/csu/<?php echo $empsec['section_id'] ;?>" <?php echo $cls ; ?> ><?php echo getSection($empsec['section_id']) ; ?></a>
                                        <?php }}
                                if(isset($sec_id) && $sec_id == 'all'){ $cls = "class='btn btn-primary btn-sm btn-flat margin'"; }else{ $cls = "class='btn btn-default btn-sm btn-flat margin'"; }           ?>
                                <a href="<?php echo base_url();?>show_file/csu/all" <?php echo $cls ?>><?php echo "सभी फ़ाइल्" ; ?></a>
                                <?php ?>
                        </div>
                    </div>
			</form>
			</div>
		</div>
        <div class="col-xs-12">
            <div class="box" style="overflow: auto">
                <div class="box-header no-print">
					<h3 class="box-title"><?php echo $title_tab;?></h3>
					<div class="box-tools pull-right">
						<!--<button class="btn btn-block btn-info"><?php echo $this->lang->line('view_file_mark');?></button>-->
						<button onclick="printContents('divname')" class="btn btn-primary no-print">Print</button>
						<button class="btn btn-warning no-print" title="Back" onclick="goBack()"><?php echo $this->lang->line('Back_button_label'); ?></button>
				<!--	<a class="btn btn-info no-print" title="Add File" href="<?php echo base_url();?>add_file"><?php echo $this->lang->line('add_files'); ?></a>-->
					</div>
                </div><!-- /.box-header -->
				<div class="box-body">
                <?php // echo $this->session->flashdata('message'); ?>
                <?php if($this->session->flashdata('message') || $this->session->flashdata('error')) {
                    $msg = $this->session->flashdata('message') ? 'success' : 'danger';
                    ?>
                    <div class="alert alert-<?php echo $msg; ?> alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php  echo $this->session->flashdata('message');
                        echo $this->session->flashdata('error'); ?>
                    </div>
                <?php } ?>
                <table id="centr_table" class="table table-bordered table-striped display print_font">
                    <thead>
                    <tr>
						<th style="display:none"></th>
                        <th><?php echo $this->lang->line('sno'); ?></th>
                        <th><?php echo $this->lang->line('section_no1'); ?></th>
                        <th><?php echo $this->lang->line('view_file_subject'); ?></th>
                        <th><?php echo $this->lang->line('uo/letter_no'); ?></th>
                        <th><?php echo $this->lang->line('view_file_uo_letter_date'); ?></th>
                        <th><?php echo $this->lang->line('view_mark_section'); ?></th>
						<th>विभाग</th>
                        <th><?php echo $this->lang->line('date'); ?></th>
                        <th class="no-print" width="100px"><?php echo $this->lang->line('filestatus'); ?></th>
                        <th  class="no-print"><?php echo $this->lang->line('actions'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=1; foreach ($get_files as $key => $files) { ?>
                        <tr>
                            <td style="display:none"><?php echo $files->file_created_date;?></td>
                            <td><?php echo $i;?><?php if($section_id == 1){?>(<b>File ID : </b> <?php echo $files->file_id; ?>) <br/> <?php } ?> </td>
                            <td>Cr : <?php
                                $fno =   getfilesec_id_byfileid($files->file_id,getusersection($files->createfile_empid)); //,$files->file_type
                                if($fno==null){
                                    $fno1 =  getfilesec_id_byfileid($files->file_id,getusersection($files->createfile_empid),$files->file_type,'100');
                                    if($fno1 == null){
                                        echo "N/a";
                                    }else{
                                        echo $fno1;
                                    }
                                }else{ echo $fno; }
								if(isset($files->old_registared_no) && ($files->old_registared_no != 0 )){
									echo "<br><span title='पुराना रजिस्टर नंबर' > ORN : ".$files->old_registared_no ."</span>";
								} 								?>
                            </td>
							<td><?php echo $files->file_subject;?>
							<br><?php show_scan_file($files->scan_id)?>
							<br><?php show_file_status($files->file_status);?>
							</td>
                            <td><?php echo $files->file_uo_or_letter_no; ?> (<?php echo getFileType($files->file_type) ;?>)</td>
                            <td><?php echo date_format(date_create($files->file_uo_or_letter_date), 'd/m/y'); ?></td>
                            <td><?php $marksection=$files->file_mark_section_id;
                                if($marksection==0){
                                    if($marksection==1){ echo 'व्यक्तिगत (Personal)';}else{ echo ' गोपनीय / सुरक्षित फ़ाइल'; }
                                }else{ echo getSection($files->file_mark_section_id);}?>
                            </td>
							<td><?php 
							 if($files->file_Offer_by) {					
                        $file_from = file_from_type();
                        $high_bench =  highcourt_bench();
						echo    $files->file_Offer_by == 'c' || $files->file_Offer_by == 'jvn' ? (isset($file_from[$files->file_Offer_by])?$file_from[$files->file_Offer_by]:'') ." , ".( isset($files->district_name_hi)?$files->district_name_hi:'') : false;
                        echo    $files->file_Offer_by == 'm' ? (isset($file_from[$files->file_Offer_by])?$file_from[$files->file_Offer_by]:'')." , ". (isset($high_bench[$files->court_bench_id])?$high_bench[$files->court_bench_id]:'') : false;
                        echo    $files->file_Offer_by == 'u' ? (isset($file_from[$files->file_Offer_by])?$file_from[$files->file_Offer_by]:'')  ." , ". (isset($high_bench[$files->court_bench_id])?$high_bench[$files->court_bench_id]:'') : false;
                        echo    $files->file_Offer_by == 'au' ? (isset($file_from[$files->file_Offer_by])?$file_from[$files->file_Offer_by]:'')." , ". (isset($file_details[0]['state_name_en'])?$file_details[0]['state_name_en']:'') : false;
                        echo    $files->file_Offer_by == 'v' ? (isset($file_from[$files->file_Offer_by])?$file_from[$files->file_Offer_by]:'') ." , ". (isset($files->dept_name_hi)?$files->dept_name_hi:'') : false;
                        echo    $files->file_Offer_by == 'o' ? (isset($file_from[$files->file_Offer_by])?$file_from[$files->file_Offer_by]:'') ." , ". (isset($files->file_department_name)?$files->file_department_name:'') : false;
                        echo    $files->file_Offer_by == 'sc' ? 'दिल्ली सुप्रीम कोर्ट ' : false;
                    }
                                ?>
							</td>
                            <td><?php echo date("d-m-Y", strtotime($files->file_created_date));?></td>
                            <td class="no-print"><?php
                                $filereceiver = get_user_details($files->file_received_emp_id);
                                if ($filereceiver)
                                {
                                    if($files->file_hardcopy_status == 'not') {
                                        echo "<span style='color:#dd4b39' >Not Received by <b> ".ucfirst($filereceiver[0]->emp_full_name)."</b><br/> (".$filereceiver[0]->emprole_name_hi.")</span>";
                                    } else {
                                        echo "<span style='color:#00a65a' >Received by <b> ".ucfirst($filereceiver[0]->emp_full_name)."</b><br/> (".$filereceiver[0]->emprole_name_hi.")</span>";
                                    } } ?></td>
                            <td class="no-print">
                               <?php if($files->file_hardcopy_status == 'not') { ?>
                                   <a onclick="return confirm('Are you sure you want to receive this file')" href="<?php echo base_url();?>manage_file/receive_by_officer/<?php echo $files->file_id; ?>?ft_status=<?php echo $files->file_status; ?>" class="btn btn-block btn-sm btn-twitter"  data-toggle="tooltip" data-original-title="Receive file"><span class="blink_fast" ><?php echo $this->lang->line('receive_file') ?></span></a>
                        <?php }else{ ?>
                                   <a href="<?php echo base_url(); ?>scan_files/csu_upload_files/<?php echo $files->file_id ; ?>"><button value=""  class="btn btn-sm btn-block btn-twitter" data-toggle="tooltip" data-original-title="Send to officer">Add Scan doc</button></a>
                                        <?php
                                        $checkrole = checkUserrole_by_id($files->file_sender_emp_id,true);
                                        if($checkrole == 9 && $files->file_mark_section_id != '' && $files->file_mark_section_id != '100'){ ?>
                                            <a  onclick="return confirm('Are you sure you want Mark this file without Added any Pdf')"  href="<?php echo base_url(); ?>scan_files/file_direct_mark/<?php echo $files->file_id ; ?>"><button value=""  class="btn btn-block btn-sm btn-twitter" data-toggle="tooltip" data-original-title="Send to officer">File Direct Mark</button></a>
                                        <?php   } ?>

										<?php if (enable_dispose('csu') == true ){  ?>
											<button onclick="open_model_dispose(<?php echo $files->file_id; ?>)" class="btn btn-sm btn-block btn-danger rty1" value="<?php echo $files->file_id; ?>" data-toggle="tooltip" data-original-title="Dispose in section"><i class="fa fa-sort-down"></i> नस्ती को बंद करें</button>
										<?php }  ?>
                              <?php } ?>
                            </td>
                        </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
    <!-- Main row -->
</section><!-- /.content -->
<style type="text/css">
    #leave_employee_filter{
        clear: both;
    }
</style>
<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script>

function open_model_cr(file){
	var file5 = file;
	$('#modal-return_to_cr').modal('show');
	$('#cr_return').val(file5);
	$('#form_submit_cr').attr('action','<?php echo base_url()?>manage_file/reject_crto_section/'+file5);
}
//for section dipose by CR
function open_model_dispose(file){
	var file_dis = file;
	$('#modal-dis').val(file_dis);
	$('#modal-dispose_file').modal('show');
}
/*
//year select
$(function () {
	$('#files_year').on('change', function () {
		window.location = "?year="+$('#files_year').val();
	});
});

$(function () {
	$('#files_month').on('change', function () {
		window.location = "?year="+$('#files_year').val()+"&month="+$('#files_month').val();
	});
});

$(function () {
	$('#files_section').on('change', function () {
		window.location = "?section="+$('#files_section').val();
	});
});
*/	
	
</script>
<!--receive model-->
<div class="modal fade" id="modal-return_to_cr" data-backdrop="static">
    <div class="modal-dialog">
        <!--<form role="form" method="post" action="<?php echo base_url()?>view_file/Dealing_file/Sent_to_DA">-->
		<form method="post" id="form_submit_cr">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-edit"></i> शाखा में भेजें</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body table-responsive">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <input type="hidden" id="cr_return" name="file_id1">
                                        <textarea class="form-control" rows="3" placeholder="Enter ..." id="modal-id" name="file_remark">फाइल की हार्ड कॉपी प्राप्त नहीं हुई</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                    <button onclick="return confirm_send()" type="submit" name="return_tocr" value="return_tocr" class="btn btn-primary"><i class="fa fa-share"></i> Return</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!--End-->

<!-- Model for dispose file in section -->
<div class="modal fade" id="modal-dispose_file" data-backdrop="static">
    <div class="modal-dialog">
        <form action="<?php echo base_url() ;?>manage_file/dispatch_for_close_byso" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-edit"></i> Enter Remark </h4>
                </div>
                <div class="modal-body">
                    <div class="box-body table-responsive">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <input type="hidden" id="modal-dis" name="filedis_id">                                    
                                    <div class="form-group">
                                    <textarea class="form-control" rows="3" placeholder="आप फाइल को Dispose क्यूँ करना चाहते है कृपया जरुर लिखें|" id="modal-id" name="filedis_msg" required>यह फाइल CR-  से पुनः दर्ज हो गयी है|</textarea>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                    <button id="btn-delete" type="submit" class="btn btn-primary send_btn"><i class="fa fa-check"></i> Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>