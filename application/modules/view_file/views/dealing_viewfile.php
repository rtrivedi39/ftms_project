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
            <div class="box">
                <?php if($this->session->flashdata('message') || $this->session->flashdata('error')) {
                    $msg = $this->session->flashdata('message') ? 'success' : 'danger';
                    ?>
                    <div class="alert alert-<?php echo $msg; ?> alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php  echo $this->session->flashdata('message');
                        echo $this->session->flashdata('error'); ?>
                        <br/>
                    </div>
                <?php } ?>
                <div class="box-header">
                    <h3 class="box-title"><?php echo $title_tab;?></h3>
                    <div class="box-tools pull-right">
                        <!--<button class="btn btn-block btn-info"><?php echo $this->lang->line('view_file_mark');?></button>-->
                        <button class="btn btn-block btn-warning" title="Back" onclick="goBack()"><?php echo $this->lang->line('Back_button_label'); ?></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
						<div class="row">
							<div class="col-sm-5">
								<div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing <?php if(isset($_GET['per_page']) && !empty($_GET['per_page'])){ echo @$_GET['per_page'];}else{ if($total_files==0){ echo 0;}else{echo '1';}} ?> to <?php if($total_files==0){ echo 0;}else{ echo ($perpage+@$_GET['per_page']);} ?> of <span class="label label-primary">&nbsp;<?php echo $total_files; ?>&nbsp;</span> entries</div>
							<?php echo per_page_listing() ;?>
							</div>
							<div class="col-sm-7">
								<div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">							
									<?php  foreach ($links as $link) {
												echo $link;
											} 
									?>								
								</div>
								<form name="search_from" id="search_from" method="get">
									<div class="col-sm-5 pull-right">
										<!--<div id="example1_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="Section & CR number,Subject,UO No.& Date" aria-controls="example1"></label></div>-->
										<div class="input-group">
											<input type="search" required name="searchby" class="form-control" placeholder="Section no./CR no./Subject/UO No./Date/file sender name" aria-controls="example1">
											<div class="input-group-btn">
											  <button class="btn btn-success">खोजें</i></button>
											</div>
										  </div>								
									</div>
									
								</form>
							</div>
						</div>
						<div class="fix_table-container fix_maintable">
                        <table class="table table-bordered table-striped">
                            <thead style="background-color:white">
                            <tr>
                                <th><?php echo $this->lang->line('sno'); ?></th>
								<th><?php echo $this->lang->line('section_no1'); ?></th>
                                <th><?php echo $this->lang->line('view_file_subject'); ?></th>
                                <th><?php echo $this->lang->line('uo/letter_no'); ?></th>
                                <th><?php echo $this->lang->line('view_file_uo_letter_date'); ?></th>                                
                                <th><?php echo $this->lang->line('view_file_mark_section_id'); ?></th>
								<th>विभाग</th>
                                <th><?php echo $this->lang->line('date'); ?></th>
                                <th><?php echo $this->lang->line('filestatus'); ?></th>
                                <th><?php echo $this->lang->line('actions'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; foreach ($get_files as $key => $files) { 
								$diff=date_diff(date_create($files->file_update_date),date_create(date("Y-m-d")));
								$checkdate = $diff->format("%a");
								
								?>
                                <tr <?php
                if($checkdate >= '3' && $checkdate <= '7') { echo "style='background-color:#F3E212' data-toggle='tooltip' data-original-title='३ दिन से अधिक विलंब'";
                } else if($checkdate >= '7' && $checkdate <= '10') { echo "style='background-color:#ffb743' data-toggle='tooltip' data-original-title='७ दिन से अधिक विलंब'";
                } else if($checkdate >= '10') { echo "style='background-color:#FFA4A4' data-toggle='tooltip' data-original-title='१० दिन से अधिक विलंब'";}
                ?>>
								
                                    <td><?php echo $i;?> <span style="display:none">(<?php echo $this->lang->line('file_no'); ?> : <?php echo $files->file_id;?>)</span></td>
									<td style="font-size:16px;"><a href="<?php echo base_url()."view_file/viewdetails/".$files->file_id ;?>" data-toggle="tooltip" data-original-title="View details"> 
											<span class="label label-success" title="शाखा पंजी क्र.">
												<?php echo getfilesec_id_byfileid($files->file_id,$files->file_mark_section_id);?>
											</span>
										</a>
									</td>
                                    <td><?php echo $files->file_subject;?>
									<br><?php if(!empty($files->scan_id) && $files->scan_id !='N;'){
										show_scan_file($files->scan_id);
							}?>
							<br>
							<?php if(!empty($files->final_draft_id)){
							$final_draft_id = $files->final_draft_id; ?>
							<a style="cursor:pointer;" target="_blank" href="<?php echo base_url(); ?>draft/draft/view_file/<?php echo $files->final_draft_id;; ?>/<?php echo $files->file_id; ?>">view draft</a>
							<?php } ?>
							<br><?php show_file_status($files->file_status)?>
								</td>
                                    <td><?php echo $files->file_uo_or_letter_no; ?> (<?php echo getFileType($files->file_type) ;?>)</td>
                                    <td><?php echo date_format(date_create($files->file_uo_or_letter_date), 'd/m/y'); ?></td>                                    
                                    <td><?php echo getSection($files->file_mark_section_id); ?></td>
									<td><?php
                                        $file_from = file_from_type();
										$high_bench =  highcourt_bench();										
										if(isset( $files->file_Offer_by) && isset($file_from)){
										echo   $files->file_Offer_by == 'c' || $files->file_Offer_by == 'jvn' ? $file_from[$files->file_Offer_by] ." , ". $files->district_name_hi : false ;
										}
										if(isset( $files->file_Offer_by) && isset($file_from) && isset($high_bench)){
										echo    $files->file_Offer_by == 'm' || $files->file_Offer_by == 'u' ? $file_from[$files->file_Offer_by] ." , ". $files->court_bench_id != 0 ? $high_bench[$files->court_bench_id] : 'N/A' : false ;
										}
										if(isset( $files->file_Offer_by) && isset($file_from)){
										echo    $files->file_Offer_by == 'sc' ? $file_from[$files->file_Offer_by] ." , Delhi , दिल्ली" : false ;
										}										
										if(isset($files->file_Offer_by) && isset($file_from)){
											echo    $files->file_Offer_by == 'v' || $files->dept_name_hi ? @$file_from[@$files->file_Offer_by] ." , ". $files->dept_name_hi ." ".$files->file_department_name : $files->file_department_name;
										}
													?>
                                    </td>
                                    <td><?php echo date_format(date_create($files->file_update_date), 'd/m/y'); ?>
                                        (<?php if($files->file_hardcopy_status == 'not'){ echo $this->lang->line('mark_date');} else { echo $this->lang->line('received_date');} ?>)
                                    </td>
                                    <td><?php
                                        $filereceiver = get_user_details($files->file_received_emp_id);
                                        if ($filereceiver)
                                        {
											if($files->file_hardcopy_status == 'not') {
												echo file_not_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi);
											} else if($files->file_hardcopy_status == 'close') {
												echo file_closed_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi, $files->file_type);
											} else  if($files->file_hardcopy_status == 'received') {
												echo file_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi);
											} else if($files->file_hardcopy_status == 'working'){
												echo file_working_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi);
											}
										} ?></td>
                                    <td width="175px">
                                        <div class="btn-group">
										<?php
											if((($this->uri->segment(1)=='e-files' || $this->uri->segment(1)=='efile') && $files->final_draft_id !='' ) || ($this->uri->segment(1)=='view_file' && $files->final_draft_id=='')) { //
											//if((($this->uri->segment(1)=='e-files' || $this->uri->segment(1)=='efile') && $files->final_draft_id !='' ) || ($this->uri->segment(1)=='view_file' && $files->final_draft_id=='' && ( $files->file_status == 'p' || ($files->file_status == 'p,e' || $files->file_status == 'e,p')))){
												$is_draft_detail=null;
												$is_draft_detail = is_notehseet_finalized($files->file_id,emp_session_id(),null,'loggedin_usr_draf_added');
											?>
                                            <?php if (($files->file_hardcopy_status == 'received' || $files->file_hardcopy_status == 'working') && $files->file_return != '1') {
												$section_exp = explode(',',getEmployeeSection());
												if(in_array('22',$section_exp)) {?>
													<a href="<?php echo base_url();?>edit/rti_file/<?php echo $files->file_id; ?>" class="btn btn-block btn-sm btn-twitter" data-toggle="tooltip" data-original-title="Modify"><i class="fa fa-fw fa-edit"></i>बदलाव करें</a>
												<?php } else{ $efile = show_efile_section(getEmployeeSection());
												if($efile == 'efile'){
												?>
													<a href="<?php echo base_url();?>scan/dealing/<?php echo $files->file_id; ?>" class="btn btn-block btn-sm btn-twitter" data-toggle="tooltip" data-original-title="Modify"><i class="fa fa-fw fa-edit"></i> बदलाव करें </a>
													<button type="button" onclick="open_model_csu(<?php echo $files->file_id; ?>);" class="btn btn-block btn-sm btn-instagram btn_mark_csu" data-toggle="tooltip"  data-file_status12 = "<?php echo $files->file_status; ?>"  data-original-title="Mark to scan unit for add PDF">Mark to CSU</button>
                                                <?php }else{ ?>
													<a href="<?php echo base_url();?>dashboard/dealing/<?php echo $files->file_id; ?>" class="btn btn-block btn-sm btn-twitter" data-toggle="tooltip" data-original-title="Modify"><i class="fa fa-fw fa-edit"></i>बदलाव करें</a>
												<?php } ?>
											<?php } ?>
												<?php /*if(getusersectionemp_session_id() == 19) {?>

												<?php }*/ ?>
											<?php } else if($files->file_hardcopy_status == 'not'){ ?>
                                                <!--  <a onclick="return confirm('Are you sure you want to receive this file')" href="<?php// echo base_url();?>view_file/dealing_file/receivebyAD/<?php// echo $files->file_id; ?>" class="btn btn-block btn-sm btn-twitter"  data-toggle="tooltip" data-original-title="Receive file"><span class="blink_fast" ><?php// echo $this->lang->line('receive_file') ?></span></a>-->												
												<a onclick="receive_DA(<?php echo $files->file_id ;?>,'<?php echo $files->file_status ;?>');" class="btn btn-block btn-sm btn-twitter"  data-toggle="tooltip" data-original-title="Receive file"><span class="blink_fast" ><?php echo $this->lang->line('receive_file') ?></span></a>
												<a onclick="return confirm('Are you sure you want to send this file')" href="<?php echo base_url(); ?>manage_file/dealing_manage_files/return_file_so/<?php echo $files->file_id ; ?>/1" data-toggle="tooltip" data-original-title="Return" class="btn btn-block btn-sm btn-instagram">रिजेक्ट करें</a> <!-- here 1 is use for return file-->
										   <?php } else if($files->file_hardcopy_status == 'received' && $files->file_return == '1'){  ?>
                                                <a href="<?php echo base_url() ?>manage_file/dealing_manage_files/return_file_so/<?php echo $files->file_id ;?>/2" onclick="return confirm_send()" class="btn btn-block btn-sm btn-success" data-toggle="tooltip" data-original-title="Send to SO">एस. ओ. को भेंजे</a>
                                            <?php } ?>
											
										<?php }else {
												if($files->final_draft_id == '' && $files->file_hardcopy_status != 'received' ){
													echo 'यह फाइल, <a href="#" class="badge bg-light-blue" >फाइल देखें </a>से प्राप्त करें !';
												}else if($files->file_hardcopy_status != 'received' ){
													echo 'यह फाइल,  <a href="'.base_url().'e-files/inbox?filecr='.$files->file_subject.'" class="badge bg-light-blue" >अंकित ई-फ़ाइलें (Inbox)</a>से प्राप्त करें !';
												}elseif($files->file_hardcopy_status=="received"){ 
													echo '<a href="'.base_url().'e-files/inbox?filecr='.$files->file_subject.'" class="badge bg-light-blue" >अंकित ई-फ़ाइलें (Inbox)</a>पर कार्यवाही करें !' ; 
												} 
										} ?>	
                                        </div>
                                    </td>
                                </tr>
                                <?php $i++; } ?>
                            </tbody>
                        </table>
						<div id="bottom_anchor"></div> <!---use for fix table header-->
				</div>
						<div class="row">
							<div class="col-sm-5">
								<div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing <?php if(isset($_GET['per_page']) && !empty($_GET['per_page'])){ echo @$_GET['per_page'];}else{ if($total_files==0){ echo 0;}else{echo '1';}} ?> to <?php if($total_files==0){ echo 0;}else{ echo ($perpage+@$_GET['per_page']);} ?> of <span class="label label-primary">&nbsp;<?php echo $total_files; ?>&nbsp;</span> entries</div>
							</div>
							<div class="col-sm-7">
								<form name="search_from" id="search_from" method="get">
									<div class="col-sm-5 pull-right">
										<!--<div id="example1_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="Section & CR number,Subject,UO No.& Date" aria-controls="example1"></label></div>-->
										<div class="input-group">
											<input type="search" required name="searchby" class="form-control" placeholder="Section no./CR no./Subject/UO No./Date/file sender name" aria-controls="example1">
											<div class="input-group-btn">
											  <button class="btn btn-success">खोजें</i></button>
											</div>
										  </div>								
									</div>
									
								</form>
								<div class="dataTables_paginate paging_simple_numbers" id="example1_paginate" style="clear:both">							
									<?php  foreach ($links as $link) {
												echo $link;
											} 
									?>								
								</div>
								
							</div>
						</div>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div><!-- /.row -->
        <!-- Main row -->
</section><!-- /.content -->
<?php $this->load->view('open_popup_forda') ; ?>

