<link href="<?php echo base_url(); ?>themes/e_file_style.css" rel="stylesheet" type="text/css" />	
 <!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
		   <?php echo $title; ?>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
			<li class="active"><?php echo $title; ?></li>
		</ol>
	</section>

    <!-- Main content -->
    <section class="content">
        <div class="row">          
           <div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border no-print">
					  <h3 class="box-title"><?php echo $sub_title; ?></h3>
					  <div class="box-tools pull-right">
						<button class="btn btn-flat btn-danger" onclick="goBack()"><i class="fa fa-compress"></i> Back</button>
					  </div>
					</div><!-- /.box-header -->
					<div class="box-body no-padding">
						<?php 
							$emp_id = $draft_data['draft_sender_id']; 
                            $file_details = getFileDetails($draft_data['draft_file_id'] , true);
						?>
						<div class="mailbox-controls with-border text-center no-print">
							<div class="btn-group">
							</div><!-- /.btn-group -->
							<button class="btn btn-default btn-sm no-print" data-toggle="tooltip"  onclick="printDiv('forPrint')" title="Print"><i class="fa fa-print"></i></button>
						</div><!-- /.mailbox-controls -->
						<?php
						$type = $draft_data['draft_type']; 
						$panji_number = get_panji_no($file_details[0]['file_id'],$file_details[0]['file_mark_section_id'],$file_details[0]['file_created_date']);
						$subject = $file_d = $style = '';
						if($type == 'n' || $type == 'odn'){ 
							$style = 'padding:2% 8%; background-color:#CCFFCC; font-size:12pt;';
							$subject = $draft_data['draft_subject'];
                            //	if($draft_data['notesheet_id'] == null){
							$subject = '<p style="padding:0% 15%;" id="Divheader"><b><em class="no-print">विषय:- </em>'.$draft_data['draft_subject'].'</b></p><p style="text-align: center;">------</p>';
							$file_d = '<p style="text-align: center;"><b>पंजी क्रमांक  '.$panji_number.', <em style="margin-left:10%;"></em> भोपाल, दिनांक '.get_date_formate($file_details[0]['file_mark_section_date'],'d/m/Y').'</b></p><p style="text-align: center;">------</p>';
                            //	}
						}else{
							$style = 'padding:2% 5%; background-color:#eee;';
						}		
						?>
						<div class="mailbox-read-message no-padding" id="forPrint">						   
							<div  style="<?php echo $style;  ?>; ">
								<table width="100%">
								    <thead class="onlyprint">
										<?php if($subject != ''){ ?>
											<tr>
												<th style="padding:10% 0% 5% 5% !important;"><?php echo $subject; ?></th>
											</tr>
										<?php } ?>
									</thead>
									<tbody>
										<tr>
											<td>
												<div class="no-print">
													<?php echo $draft_data['notesheet_id'] == null ? $subject : '' ; ?>
												</div>						
												<?php 
												if($type != 'odn') {
													echo $file_d ; 
												} 
												if($type == 'n'){ //if type notesheet or bahya notesheet
													$cr_empid_array = explode(',',get_emp_by_role('9', '1')); 
													$link_draft_id =  get_draft_by_fileid($file_details[0]['file_linked_id'],'n');
													if(isset($link_draft_id)){
														foreach($link_draft_id as $link_draft){
															$all_drafts = get_draft_log_data($link_draft->draft_id);
															foreach($all_drafts as $drafts){
																//$span = (get_employee_designation($drafts->draft_log_creater, true) > 9 && $type == 'n') ? '<span class="no-print" title="'.getemployeeName($drafts->draft_log_creater, true).'"><img src="'.base_url().'themes/admin/dist/img/avatar5.png" class="user-image" height="35px" alt="User Image"></span>' : '' ;
																//$span_name = (get_employee_designation($drafts->draft_log_creater, true) > 9 && $type == 'n') ? getemployeeName($drafts->draft_log_creater, true) : '' ;
																echo '<div style="margin:0 auto; width:75%;">';
																//  echo '<button type="button" class="remove_div no-print" title="प्रिंट से हटाये ">हटाये</button>';
																echo filter_string($drafts->draft_content);
																//if(get_employee_designation($drafts->draft_log_creater, true) < 9 && $type == 'n'){
																if($type == 'n'){
																	$verify_status =  verify_digital_sinature($drafts->draft_log_id,md5($drafts->draft_content));
																	$class_no = '';
																	$role_show_fdf = $drafts->creater_role_hi;
																	if($verify_status){ 
																		$class_no = "class='hide'";
																		$role_show_fdf = $drafts->creater_role_name;
																	}
																	echo '<div class="pull-right" style="text-align: center;">'.$verify_status.'
																	<b '.$class_no.'>( '.$drafts->creater_name_hi.' )<br/></b>
																	<b><span>'.$role_show_fdf.'</span></b></div><div class="clearfix"></div>';
																	if($drafts->draft_log_creater != $drafts->draft_log_sendto){
																		echo '<div>';
																		if(check_so_on_leave_id($drafts->creater_designation_id,$drafts->sento_designation_id) != null){
																			echo '<b><u>अनुभाग अधिकारी अवकाश पर </u></b>';
																		}
																		/*	echo '<b><u><br/>'.get_employee_designation($drafts->draft_log_sendto).'(';
																		echo  get_employee_designation($drafts->draft_log_sendto, true) == 3 ? 'विधि' : getSectionName($file_details[0]['file_mark_section_id']);
																		echo ')</u></b></div>'; */
																		echo '<b><u><br/>'.$drafts->sento_role_hi.'';
																		$emp_designation = $drafts->sento_designation_id;
																		if($emp_designation == 3){
																			echo ' (विधि) ';
																		} else if($emp_designation == 11){
																			echo '(स्थापना)'; 
																		}else{
																			echo ($drafts->draft_log_section_id && $drafts->draft_log_section_id!= '100') ? " (".$drafts->draft_setion_hi.")" : '';
																		}
																		echo '</u></b></div>';
																	}
																}
																echo '</div>'; 
																echo '<hr class="no-print"/>';
															}
															echo '<hr style="border-top: 1px solid #74ca48;" class="no-print"/><br/>';
														}
													}
													$on_print_after = "" ;
													$all_drafts = get_draft_log_data($draft_data['draft_id'],false,null,null,$file_details[0]['file_hardcopy_status']);
													foreach($all_drafts as $drafts){
														if($drafts->draft_file_reopen == '1'){
															$on_print_after = "";
														}
														//$span = (get_employee_designation($drafts->draft_log_creater, true) > 9 && $type == 'n') ? '<span class="no-print" title="'.getemployeeName($drafts->draft_log_creater, true).'"><img src="'.base_url().'themes/admin/dist/img/avatar5.png" class="user-image" height="35px" alt="User Image"></span>' : '' ;
														//$span_name = ($drafts->creater_designation_id > 9 && $type == 'n') ? $drafts->creater_name_hi : '' ;
														echo '<div style="margin:0 auto; width:75%;" class="'.$on_print_after.'">';												
														echo filter_string($drafts->draft_content);
														//if(get_employee_designation($drafts->draft_log_creater, true) < 9 && $type == 'n'){
														if($type == 'n'){
															$verify_status =  verify_digital_sinature($drafts->draft_log_id,md5($drafts->draft_content),$file_details[0]['file_hardcopy_status']);
															$class_no = '';
															$role_show_fdf = $drafts->creater_role_hi;
															if($verify_status){
																$class_no = "class='hide'";
																$role_show_fdf = $drafts->creater_role_name;
															}
															echo '<div class="pull-right" style="text-align: center;">'; 

															if(in_array($drafts->draft_log_creater,$cr_empid_array))    {
																echo '<b '.$class_no.'>(आवक)<br/></b>';
															}else{
																echo $verify_status.'
																<b '.$class_no.'>( '.$drafts->creater_name_hi.')<br/></b>
																<b><span>'.$role_show_fdf.'</span></b>';
															}

															echo '</div><div class="clearfix"></div>';

															if($drafts->draft_markto_otherdept != null){
																echo   "<br/><u><b>".$drafts->draft_markto_otherdept."</b></u>";
																$on_print_after = "no-print";
															}
															if($drafts->draft_log_creater != $drafts->draft_log_sendto){
																echo '<div class="'.$on_print_after.'">';
																if(check_so_on_leave($drafts->draft_log_creater,$drafts->draft_log_sendto) != null){
																	echo '<b><u>अनुभाग अधिकारी अवकाश पर </u></b>';
																} 																
																echo '<b><u><br/>'.$drafts->sento_role_hi.'';
																$emp_designation = $drafts->sento_designation_id;
																if($emp_designation == 3){
																	echo ' (विधि) ';
																} else if($emp_designation == 11){
																	echo '(स्थापना)'; 
																}else{
																	echo ($drafts->draft_log_section_id && $drafts->draft_log_section_id!= '100') ? " (".$drafts->draft_setion_hi.")" : '';
																}
																echo '</u></b></div>';	
															}
														}
														echo '</div>';								
														echo '<hr class="no-print"/>';
													}
												} else{ //if type order 
													$draft_data = get_draft($draft_data['draft_id']);
													$cor_draft_log = get_draft_log_data($draft_data['draft_id'], true, '','');
													$verify_status = verify_digital_sinature($cor_draft_log[0]->draft_log_id,md5($cor_draft_log[0]->draft_content),$file_details[0]['file_hardcopy_status']);
													if($type == 'odn'){	
														echo '<div style="margin:0 auto; width:75%;">';											
														echo filter_string($draft_data['draft_content_text']);	
														echo '<div class="pull-right dsign">&nbsp;'.$verify_status.'</div>';
														echo '</div>';
													} else{
														echo filter_string($draft_data['draft_content_text']);
														echo '<div class="pull-right dsign">&nbsp;'.$verify_status.'</div>';
													}
												}
												?>
											</td>
										</tr>
									</tbody>
									<tfoot><tr><td></td></tr></tfoot>
								</table>
							</div>
							
							<!--<footer class="onlyprint">नोट:- यह पेज डिजिटली हस्ताक्षर हुआ है अतः यह इ-फाइल के द्वारा ही वेलिड है|</footer>-->
						</div><!-- /.mailbox-read-message -->
					</div><!-- /.box-body -->					
					<div class="box-footer">
						<button class="btn btn-warning no-print" onclick="printContents('forPrint')"><i class="fa fa-print"></i> Print With table</button>
						<button class="btn btn-warning no-print" onclick="printDiv('forPrint')"><i class="fa fa-print"></i> Print</button>
					<div class="box-tools pull-right">
					  <button class="btn btn-flat btn-danger no-print" onclick="goBack()"><i class="fa fa-compress"></i> Back</button>
					  </div>
					</div><!-- /.box-footer -->
					</div><!-- /. box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
   </section><!-- /.content -->
<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- 
	Include the WYSIWYG javascript files
-->
<script type="text/javascript" src="<?php echo base_url()?>themes/ckeditor/ckeditor.js"></script>
<!-- 
	Attach the editor on the textareas
-->
<script type="text/javascript">
    $(document).ready(function(){
        $('html, body').animate({scrollTop:$(document).height()}, 1000);
    });
	CKEDITOR.replace('compose-textarea');
</script>
<script src="<?php echo base_url(); ?>themes/e_file_style.js" type="text/javascript"></script>