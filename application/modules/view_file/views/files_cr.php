<?php   $section= empdetails(emp_session_id());
$section_id = $section[0]['emp_section_id'];
$files_year = $this->input->get('files_year') != '' ? $this->input->get('files_year') : '';
$files_month = $this->input->get('files_month') != '' ? $this->input->get('files_month') : '';
$files_section = $this->input->get('files_section') != '' ? $this->input->get('files_section') : '';
$files_user = $this->input->get('files_user') != '' ? $this->input->get('files_user') : $this->session->userdata("emp_id");
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
			<div class="box box-info">
				<div class="box-header">
					<h4> <?php  echo $this->input->get('sections') != '' ? 'मार्क किया गया अनुभाग : -  ' .getSection($this->input->get('sections'))  : ''; ?></h4>
					<h3 class="no-print">Searching files for printing </h3>
				
				</div>
				<div class="box-body">
					<form method="get" action="<?php echo base_url(); ?>view_file/search_files_cr" class="no-print">						
						<div class="col-xs-4">
							<select name="sections" class="form-control" required>
								<option value="">Select mark section </option>
								<?php $getSection = get_list(SECTIONS, null, null);
									foreach($getSection  as $section){ ?>
									<option value="<?php echo $section['section_id']; ?>" <?php echo @$this->input->get('sections') == $section['section_id'] ? "selected" : false?>><?php echo $section['section_name_hi'] ; ?></option>
								<?php  }?>
							</select>
							<?php echo form_error('sections');?>
						</div>                            
						<div class="col-xs-4">
							<input type="text"  name="search_date" id="search_date" required  value="<?php echo @$this->input->get('search_date') ? $this->input->get('search_date') : ''  ?>" autocomplete="off" placeholder="Select marking date"  class="form-control date_picker">
							<?php echo form_error('search_date');?>
						</div>                    
						 
						<div class="col-xs-2">
							<button type="submit" class="btn btn-success">Search</button>
						</div>                          
						<div class="col-xs-2">
							<a class="btn btn-info no-print" title="All File" href="<?php echo base_url();?>show_file/ALL?type=all">All files</a>                     
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-xs-12 no-print" > 
			<div class="box box-primary">
			<?php if($this->uri->segment(2)=='search_files_cr'){ $gtpgurl=base_url().'show_file/ALL';}else{ $gtpgurl=show_current_url();} ?>
			<form method="get" action="<?php echo $gtpgurl; ?>" class="no-print">				
				<div class="box-body">
					<div class="row">
						<div class="col-md-2">							
							<label>दिनांक से</label>
							<?php if($this->uri->segment(1)=='return_file'){ $frmdate=''; $frm_req="";} else{ $frmdate = date("d-m-Y", strtotime("first day of previous month")); $frm_req="required";}?>	
							<input type="text"  name="frm_search_date" id="frm_search_date" <?php echo $frm_req; ?>  value="<?php echo @$this->input->get('frm_search_date') ? $this->input->get('frm_search_date') : $frmdate;  ?>" autocomplete="off" placeholder="Select marking date"  class="form-control date_picker">
							<?php echo form_error('frm_search_date');?>							
						</div>
						<div class="col-md-2">
							<label>दिनांक तक</label>
							<?php if($this->uri->segment(1)=='return_file'){ $tilldate=''; $tilldt_req=""; } else{ $tilldate = date('d-m-Y'); $tilldt_req="required";}?>	
							<input type="text"  name="till_search_date" id="till_search_date" <?php echo $tilldt_req; ?>  value="<?php echo @$this->input->get('till_search_date') ? $this->input->get('till_search_date') : $tilldate ?>" autocomplete="off" placeholder="Select marking date"  class="form-control date_picker">
							<?php echo form_error('till_search_date');?>							
						</div>
						<div class="col-md-2">
							<label>अंकित शाखा</label>
							<select class="form-control" id="files_section" name="files_section">
								<option value="">--Select Section--</option>
								<?php $sections = get_list(SECTIONS, null, "section_id not in ('8','1','26')");
								$i=1; foreach($sections  as $key => $section){?>
								<option value="<?php echo $section['section_id']; ?>" <?php echo $files_section == $section['section_id'] ? 'selected' : ''; ?>><?php echo $section['section_name_hi'] ; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="col-md-3">
							<label>एंट्री ऑपरेटर का नाम</label>
							<select class="form-control" id="files_user" name="files_user">
							<option value="">--Select entry user--</option>
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
						<a class="btn btn-info no-print" title="Add File" href="<?php echo base_url();?>add_file"><?php echo $this->lang->line('add_files'); ?></a>
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
				<div class="row">
					<div class="col-sm-5">
						<div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing <?php if(isset($_GET['per_page']) && !empty($_GET['per_page'])){ echo @$_GET['per_page']+1;}else{ if($total_files==0){ echo 0;}else{echo '1';}} ?> to <?php if($total_files==0){ echo 0;}else{ echo ($perpage+@$_GET['per_page']);} ?> of <span class="label label-primary">&nbsp;<?php echo $total_files; ?>&nbsp;</span> entries</div>
						<?php echo per_page_listing() ;?>
					</div>
					<div class="col-sm-7">
						<div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">							
							<?php  foreach ($links as $link) {
										echo $link;
									} 
							?>								
						</div>
						<?php if($this->uri->segment(2)=='search_files_cr'){ $pgget_url=base_url().'show_file/ALL';} else{ $pgget_url= show_current_url(); } ?>	
						<form name="search_from" id="search_from" method="get" action="<?php echo $pgget_url; ?>">
							<div class="col-sm-5 pull-right">
								<!--<div id="example1_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="Section & CR number,Subject,UO No.& Date" aria-controls="example1"></label></div>-->
								<div class="input-group">
									<?php if(isset($_GET['sections']) && $_GET['sections']!=''){?>
										<input type="hidden" name="sections" value="<?php echo $_GET['sections']?>">
									<?php } ?>
									<?php if(isset($_GET['search_date']) && $_GET['search_date']!=''){?>
										<input type="hidden" name="search_date" value="<?php echo $_GET['search_date']?>">
									<?php } ?>
									<?php if(isset($_GET['files_year']) && $_GET['files_year']!=''){?>
										<input type="hidden" name="files_year" value="<?php echo $_GET['files_year']?>">
									<?php } ?>
									<?php if(isset($_GET['files_month']) && $_GET['files_month']!=''){?>
										<input type="hidden" name="files_month" value="<?php echo $_GET['files_month']?>">
									<?php } ?>
									<?php if(isset($_GET['files_section']) && $_GET['files_section']!=''){?>
										<input type="hidden" name="files_section" value="<?php echo $_GET['files_section']?>">
									<?php } ?>
									<?php if(isset($_GET['files_user']) && $_GET['files_user']!=''){?>
										<input type="hidden" name="files_user" value="<?php echo $_GET['files_user']?>">
									<?php } ?>
									<?php if(isset($_GET['till_search_date']) && $_GET['till_search_date']!=''){?>
										<input type="hidden" name="till_search_date" value="<?php echo $_GET['till_search_date']?>">
									<?php } ?>
									<?php if(isset($_GET['frm_search_date']) && $_GET['frm_search_date']!=''){?>
										<input type="hidden" name="frm_search_date" value="<?php echo $_GET['frm_search_date']?>">
									<?php } ?>
									<input type="search" required name="searchby" class="form-control" placeholder="Section & CR number,Subject,UO No.& Date" aria-controls="example1" value="<?php if(isset($_GET['searchby']) && $_GET['searchby']!=''){ echo $_GET['searchby'];} ?>">
									<div class="input-group-btn">
									  <button class="btn btn-success">खोजें</i></button>
									  <?php if(isset($_GET['searchby']) && $_GET['searchby']!=''){?>
										<a href="<?php echo reset_back_url();?>" class="btn btn-success">रिसेट करें</a>
									  <?php } ?>
									</div>
								  </div>								
							</div>							
						</form>
					</div>
				</div>
				<div class="fix_table-container fix_maintable">
                <table class="table table-bordered table-striped display print_font">
                    <thead style="background-color:white">
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
                        <th  class="no-print">create by</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=1; 
						if(isset($_GET['per_page']) && $_GET['per_page']!=''){
								$i=$_GET['per_page']+1;
						}
					foreach ($get_files as $key => $files) { ?>
                        <tr>
                            <td style="display:none"><?php echo $files->file_created_date;?></td>
                            <td><?php echo $i;?><br/><?php if($section_id == 1){?>(<b>FID : </b> <?php echo $files->file_id; ?>) <br/> <?php } ?> </td>
                            <td>CR: <?php
                                $fno =   getfilesec_id_byfileid($files->file_id,getusersection($files->createfile_empid),$files->file_type,$marksection=$files->file_mark_section_id);
                                if($fno==null){
                                    $fno1 =  getfilesec_id_byfileid($files->file_id,getusersection($files->createfile_empid),$files->file_type,'100');
                                    if($fno1 == null){
                                    	$fcrno= get_file_cr_number($files->file_id);
                                    	if($fcrno==null){ echo "N/a";}else{ echo $fcrno;}
                                    }else{ echo $fno1;}
                                }else{ echo $fno; }
								if(isset($files->old_registared_no) && ($files->old_registared_no != 0 )){
									echo "<br><span title='पुराना रजिस्टर नंबर' > ORN : ".$files->old_registared_no ."</span>";
								} 								?>
                            </td>
							<td><?php echo $files->file_subject;?><br><?php if(isset($files->scan_id) && $files->scan_id != ''){ show_scan_file($files->scan_id);}?></td>
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
                                <div> <!--class="btn-group"-->
                                    <a href="<?php echo base_url();?>view_file/viewdetails/<?php echo $files->file_id; ?>" class="btn btn-block btn-primary"><i class="fa fa-fw fa-search"></i> View</a>
                                    <?php if(emp_session_id()==$files->file_received_emp_id){ if($files->file_hardcopy_status == 'not') {  ?>
									   <a onclick="return confirm_receive()" href="<?php echo base_url();?>manage_file/files_edit/receivebycr/<?php echo $files->file_id; ?>" class="btn btn-block btn-primary"><span class="blink_fast">Receive</span></a>
                                        <?php echo  (emp_session_id() == $files->file_received_emp_id)  ? '<a data-toggle="tooltip" data-original-title="वापस  शाखा में भेजें"  onclick="open_model_cr('.$files->file_id.')" class="btn btn-block btn-danger" data-toggle="tooltip" data-original-title="Reject"><i class="fa fa-reply"></i> अस्वीकारे</a>' : false; ?>
                                    <?php } else { ?>
                                        <a href="<?php echo base_url();?>dashboard/edit_file/<?php echo $files->file_id; ?>" class="btn btn-block btn-primary"> <i class="fa fa-fw fa-edit"></i> Edit </a>
										<?php if (enable_dispose('cr') == true ){  ?>
											<button onclick="open_model_dispose(<?php echo $files->file_id; ?>)" class="btn btn-sm btn-block btn-danger rty1" value="<?php echo $files->file_id; ?>" data-toggle="tooltip" data-original-title="Dispose in section"><i class="fa fa-sort-down"></i> नस्ती को बंद करें</button>
										<?php  } ?>
                                    <?php } }?>
                                </div>
                            </td>
						<td  class="no-print"><?php 
						$createfile_empid = get_user_details($files->createfile_empid);
						echo  ucfirst($createfile_empid[0]->emp_full_name) ?></td>	
                        </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>
				<div id="bottom_anchor"></div> <!---use for fix table header-->
				</div>
				<div class="row">
					<div class="col-sm-5">
						<div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing <?php if(isset($_GET['per_page']) && !empty($_GET['per_page'])){ echo @$_GET['per_page']+1;}else{ if($total_files==0){ echo 0;}else{echo '1';}} ?> to <?php if($total_files==0){ echo 0;}else{ echo ($perpage+@$_GET['per_page']);} ?> of <span class="label label-primary">&nbsp;<?php echo $total_files; ?>&nbsp;</span> entries</div>
					</div>
					<div class="col-sm-7">
						<div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">							
							<?php  foreach ($links as $link) {
										echo $link;
									} 
							?>								
						</div>
						<form name="search_from" id="search_from" method="get" action="<?php echo show_current_url(); ?>">
							<div class="col-sm-5 pull-right">
								<!--<div id="example1_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="Section & CR number,Subject,UO No.& Date" aria-controls="example1"></label></div>-->
								<div class="input-group">
									<?php if(isset($_GET['sections']) && $_GET['sections']!=''){?>
										<input type="hidden" name="sections" value="<?php echo $_GET['sections']?>">
									<?php } ?>
									<?php if(isset($_GET['search_date']) && $_GET['search_date']!=''){?>
										<input type="hidden" name="search_date" value="<?php echo $_GET['search_date']?>">
									<?php } ?>
									<?php if(isset($_GET['files_year']) && $_GET['files_year']!=''){?>
										<input type="hidden" name="files_year" value="<?php echo $_GET['files_year']?>">
									<?php } ?>
									<?php if(isset($_GET['files_month']) && $_GET['files_month']!=''){?>
										<input type="hidden" name="files_month" value="<?php echo $_GET['files_month']?>">
									<?php } ?>
									<?php if(isset($_GET['files_section']) && $_GET['files_section']!=''){?>
										<input type="hidden" name="files_section" value="<?php echo $_GET['files_section']?>">
									<?php } ?>
									<?php if(isset($_GET['files_user']) && $_GET['files_user']!=''){?>
										<input type="hidden" name="files_user" value="<?php echo $_GET['files_user']?>">
									<?php } ?>
									<input type="search" required name="searchby" class="form-control" placeholder="Section & CR number,Subject,UO No.& Date" aria-controls="example1" value="<?php if(isset($_GET['searchby']) && $_GET['searchby']!=''){ echo $_GET['searchby'];} ?>">
									<div class="input-group-btn">
									  <button class="btn btn-success">खोजें</i></button>
									  <?php if(isset($_GET['searchby']) && $_GET['searchby']!=''){?>
										<a href="<?php echo reset_back_url();?>" class="btn btn-success">रिसेट करें</a>
									  <?php } ?>
									</div>
								  </div>								
							</div>							
						</form>
					</div>
				</div>
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