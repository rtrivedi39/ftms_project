<?php $emp_session_id =  emp_session_id();?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo $title; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo $title_tab; ?></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Your Page Content Here -->
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <?php $this->load->view('establishment/est_header');  ?>
        <div class="col-xs-12">
            <div class="box box-primary" id="divname">
                <div class="box-header no-print">
                    <div style="float:left">
					<?php if(check_est_so()) { ?>
                        <div class="btn-group">
                            <a href="?type=p"  class="btn btn-warning <?php echo ($this->input->get('type') && $this->input->get('type') == 'p' || $this->input->get('type') == '') ? 'disabled' : ''; ?>">Pending <span class="badge"><?php echo sizeof($this->est_model->show_count_marked_da_file('p')) ; ?></span></a>
                            <a href="?type=f"  class="btn btn-success <?php echo ($this->input->get('type') && $this->input->get('type') == 'f') ? 'disabled' : ''; ?>">Finished <span class="badge"><?php echo sizeof($this->est_model->show_count_marked_da_file('f')) ; ?></span></a>
                            <a href="?type=all"  class="btn btn-primary <?php echo ($this->input->get('type') && $this->input->get('type') == 'all') ? 'disabled' : ''; ?>">All <span class="badge"><?php echo sizeof($this->est_model->show_count_marked_da_file('all')) ; ?></span></a>
                        </div>
					<?php }  else {
						echo '<h3 class="box-title">Files</h3>';
					}?>
                    </div>
                    <div class="box-tools pull-right">
					<?php if(check_est_so()){ ?>
					<select disabled id="auto_file_received_value" class="form-control btn btn-sm btn-twitter auto_file_received_value" style="width:150px;font-size:14px;text-align:left">
						<?php if($this->uri->segment(1)!= 'today') { ?><option >चयनित नस्तिया प्राप्त करें </option><?php } ?>
						<option value="<?php echo $emp_session_id ;?>">केवल फाइल  को प्राप्त करें</option>

									<?php $employees  = get_establishment_employees_with_des(false); ?>
						<?php foreach($employees as $emp => $emp_details) { ?>
								<option value="<?php echo $emp_details->emp_id; ?>"><?php echo getemployeeName($emp_details->emp_id,true); ?></option>
						<?php } ?>
					</select>
					<?php } ?>
					 <button onclick="printContents('divname')" class="btn btn-primary ">Print</button>
                        <a href="<?php echo base_url('establishment');?>/create_form">
                            <button class="btn  btn-info"><?php echo $this->lang->line('add_button'); ?> </button>
                        </a>
						<a href="javascript:history.go(-1)">
                            <button class="btn  btn-warning"><?php echo $this->lang->line('Back_button_label'); ?></button>
                        </a>
                    </div>                   
                </div><!-- /.box-header -->
                <div class="box-body">
				<?php if($this->session->flashdata('message') || $this->session->flashdata('error')) {
					$msg = $this->session->flashdata('message') ? 'success' : 'danger'; ?>
						<div class="alert alert-<?php echo $msg; ?> alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong>
								<?php  echo $this->session->flashdata('message');
								echo $this->session->flashdata('error'); ?>
							</strong>
							<br/>
						</div>
				<?php } ?>
				<div class="clearfix"></div>
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
									<form name="search_from" id="search_from" method="get" action="<?php echo show_current_url(); ?>">
										<div class="col-sm-5 pull-right">
											<!--<div id="example1_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="Section & CR number,Subject,UO No.& Date" aria-controls="example1"></label></div>-->
											<div class="input-group">
												<?php if(isset($_GET['type']) && $_GET['type']!=''){?>
													<input type="hidden" name="type" value="<?php echo $_GET['type']?>">
												<?php } ?>
												<input type="search" required name="searchby" class="form-control" placeholder="Section & CR number,Subject,UO No.& Date" aria-controls="example1" value="<?php if(isset($_GET['searchby']) && $_GET['searchby']!=''){ echo $_GET['searchby'];} ?>">
												<div class="input-group-btn">
												  <button class="btn btn-success">खोजें</i></button>
												  <?php if(isset($_GET['searchby']) && $_GET['searchby']!=''){?>
													<a href="<?php echo reset_back_url();?>" class="btn btn-success">रीसेट करें</a>
												  <?php } ?>
												</div>
											  </div>								
										</div>
										
									</form>
								</div>
							</div>
                    <table  class="table table-bordered table-striped">
                        <thead>
                        <tr>
							<th>क्रमांक</th>
							<th>पंजी क्रं.</th>
                            <th>प्रकार</th>
                            <th>किसने भेजी</th>
                            <th>जिसके द्वारा बनाई गई</th>
                            <th>विषय</th>
                            <th>दिनांक</th>
                            <th>मार्क दिनांक</th>
							<?php if ($this->input->get('type') && $this->input->get('type') != 'p') { ?>
								<th>निराकरण दिनांक</th>
							<?php } ?>							
                            <th class="no-print"><?php echo $this->lang->line('filestatus'); ?></th>
                            <th class="no-print"><?php echo $this->lang->line('actions'); ?></th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php if((count($get_marked_list)>0) && is_array($get_marked_list)) {?>
                            <?php $i=1; 
							$sn=1; 
							if(isset($_GET['per_page']) && $_GET['per_page']!=''){
								$sn=$_GET['per_page']+1;
							}
							foreach (@$get_marked_list as $key => $marked) { 
								$diff=date_diff(date_create($marked['file_update_date']),date_create(date("Y-m-d")));
                                $checkdate = $diff->format("%a");
								?>
                                <tr <?php
                                if($checkdate >= '3' && $checkdate <= '7') { echo "style='background-color:#FBFBDE' data-toggle='tooltip' data-original-title='३ दिन से अधिक विलंब'";
                                } else if($checkdate >= '7' && $checkdate <= '10') { echo "style='background-color:#FFE7BA' data-toggle='tooltip' data-original-title='७ दिन से अधिक विलंब'";
                                } else if($checkdate >= '10') { echo "style='background-color:#FFA4A4' data-toggle='tooltip' data-original-title='१० दिन से अधिक विलंब'";}
                                ?>>
                                    <td><?php echo $sn;?>
										<?php if(check_est_so()){ ?>
										<input type="checkbox" class="chk_slct_file" id="row_id_<?php echo $marked['file_id']; ?>" value="<?php echo $marked['file_id']; ?>" name="fileIds" style="font-size:26px;"/>
										<?php } ?>
									</td>
									<td><a href="<?php echo base_url()."view_file/viewdetails/".$marked['file_id'] ;?>" data-toggle="tooltip" data-original-title="View details"><?php echo @getfilesec_id_byfileid($marked['file_id'],$marked['file_mark_section_id'],$marked['file_type']) ? getfilesec_id_byfileid($marked['file_id'],$marked['file_mark_section_id'],$marked['file_type']) : 'N/A'; ?></a></td>
                                    <td><?php $com_type = $marked['section_file_type'] != '' ? complaint_type($marked['section_file_type']) : 'N/A' ;  echo $com_type != 'N/A' ? $com_type['category_title_hin'] : $com_type; ?></td>
                                    <td><?php echo getemployeeName($marked['file_sender_emp_id'], true);?></td>
                                    <td><?php echo getemployeeName($marked['createfile_empid'], true);?></td>
									<td><?php echo $marked['file_subject']; ?>
										<br><?php  if(isset($marked['file_status']) && $marked['file_status'] != ''){ show_file_status($marked['file_status']);}?>
										<br><?php if(isset($marked['scan_id']) && $marked['scan_id'] != ''){ show_scan_file($marked['scan_id']);}?>
									</td>
									<td><?php echo get_date_formate($marked['file_created_date'],'d/m/y'); ?></td>
									<td><?php echo date_format(date_create($marked['file_update_date']), 'd/m/y'); ?>
                                        (<?php if($marked['file_hardcopy_status'] == 'not'){ echo 'मार्क दिनांक';} else { echo 'प्राप्ति दिनांक';} ?>)
                                    </td>
                                    <?php if ($this->input->get('type') && $this->input->get('type') != 'p') { ?>
									<td><?php $days = day_difference_dates($marked['file_created_date'], $marked['file_update_date']);
										if($days <= 3){ $lb_class = 'primary'; } else if($days > 3 && $days <= 7){ $lb_class = 'warning'; } else if($days > 7 ){ $lb_class = 'danger'; }
									echo $marked['file_hardcopy_status'] == 'close' ? get_date_formate($marked['file_update_date'], 'd/m/y').' <label class="label label-'.$lb_class.'">'.$days.' days</label>' : 'Working' ; ?></td>
									<?php } ?>
									<td class="no-print"><?php
                                        $filereceiver = get_user_details($marked['file_received_emp_id']);
                                        if ($filereceiver)
                                        {
                                            if($marked['file_hardcopy_status'] == 'not') {
                                                echo file_not_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi);
                                            } else if($marked['file_hardcopy_status'] == 'close') {
                                                echo file_closed_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi, $marked['file_type']);
                                            } else  if($marked['file_hardcopy_status'] == 'received') {
                                                echo file_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi);
                                            } else if($marked['file_hardcopy_status'] == 'working'){
                                                echo file_working_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi);
                                            }
                                        } //filereceiver ?>
                                    </td>
									<td class="no-print">
									<?php
									if((($this->uri->segment(1)=='e-files' || $this->uri->segment(1)=='efile') && $marked['final_draft_id'] =='' && $login_emp_level['role_id']=='37') || (($this->uri->segment(1)=='e-files' || $this->uri->segment(1)=='efile') && $marked['final_draft_id'] !='' ) || (($this->uri->segment(3)=='marked_da_file' || $this->uri->segment(1)=='today') && $marked['final_draft_id']=='') && $marked['file_status'] == 'p'){
										$senderemp = empdetails($marked['file_sender_emp_id']);
										if(is_array($this->session->userdata('today_permission_assign'))){
											$is_subuser='?subuse='.$this->session->userdata['today_permission_assign']['today_permission_given_empid'];
										}else{
											$is_subuser='';
										}
										if($marked['file_return'] == '2' && $marked['file_hardcopy_status'] != 'not' && $marked['file_hardcopy_status'] != 'close'){
											echo    '<a onclick="return confirm_send()" href="'.base_url().'manage_file/dispatch_file_byso/'.$marked['file_id'].'" class="btn btn-sm  btn-block btn-instagram" value="'.$marked['file_id'].'">जावक शाखा में भेजें</a>';
											echo   ($marked['file_hardcopy_status'] == 'received' || $marked['file_hardcopy_status'] == 'working') && $emp_session_id == $marked['file_received_emp_id'] && $marked['file_level_id'] != '31' ? '<button onclick="open_model2('.$marked['file_id'].')" value="'.$marked['file_id'].'"  class="btn btn-sm btn-block btn-success upperuser" data-toggle="tooltip" data-original-title="Send to officer">अधिकारी को भेजें</button> ' : false;
											echo   ($marked['file_hardcopy_status'] == 'received' || $marked['file_hardcopy_status'] == 'working') && $emp_session_id == $marked['file_received_emp_id'] ? '<button onclick="open_model6('.$marked['file_id'].')" class="btn btn-sm btn-twitter btn-block rty6" value="'.$marked['file_id'].'" data-toggle="tooltip" data-original-title="Mark to DA">सहायक को  अंकित करें</button>' : false;
										}else{

											// echo   $marked['file_hardcopy_status'] == 'not' && $emp_session_id == $marked['file_received_emp_id'] && $this->uri->segment(3) != 'return' ? '<a onclick="return confirm_receive()" href="'.base_url().'establishment/manage_file/receive_file_sectionno/'.$marked['file_id'].'" class="btn btn-block btn-twitter"><span class="blink_fast" data-toggle="tooltip" data-original-title="Receive">'.$this->lang->line('receive_file').'</span></a>' : false; // file receive from dealing assistant

											// echo   $marked['file_hardcopy_status'] == 'not' && $emp_session_id == $marked['file_received_emp_id'] ? '<button onclick="receive_markda('.$marked['file_id'].')" class="btn btn-block btn-sm btn-twitter rty6" value="'.$marked['file_id'].'"><span class="blink_fast">'.$this->lang->line('receive_file').'</span></button> <a data-toggle="tooltip" data-original-title="वापस भेजें" onclick="return confirm_reject()" href="'.base_url().'establishment/manage_file/reject_file/'.$marked['file_id'].'" class="btn btn-block btn-sm btn-instagram" data-toggle="tooltip" data-original-title="Reject">'.$this->lang->line('reject').'</a>' : false;
											echo   $marked['file_hardcopy_status'] == 'not' && $emp_session_id == $marked['file_received_emp_id'] ? '<button onclick="open_model3('.$marked['file_id'].')" class="btn btn-block btn-sm btn-twitter rty6" value="'.$marked['file_id'].'"><span class="blink_fast">प्राप्त करें</span></button>' : false;
											echo   $marked['file_hardcopy_status'] == 'not' && $marked['file_type'] != 'app' && $emp_session_id == $marked['file_received_emp_id'] ? ' <a data-toggle="tooltip" data-original-title="वापस भेजें" onclick="return confirm_reject()" href="'.base_url().'establishment/manage_file/reject_file/'.$marked['file_id'].'" class="btn btn-block btn-sm btn-danger" data-toggle="tooltip" data-original-title="Reject">अस्वीकारे</a>' : false;

											echo   ($marked['file_hardcopy_status'] == 'received' || $marked['file_hardcopy_status'] == 'working') && $emp_session_id == $marked['file_received_emp_id'] ? '<button onclick="open_model6('.$marked['file_id'].')" class="btn btn-sm btn-twitter btn-block rty6" value="'.$marked['file_id'].'" data-toggle="tooltip" data-original-title="Mark to DA">शाखा में ही मार्क करे </button>' : false;
											echo   ($marked['file_hardcopy_status'] == 'received' || $marked['file_hardcopy_status'] == 'working') && $emp_session_id == $marked['file_received_emp_id'] ? '<button onclick="open_model2('.$marked['file_id'].')" value="'.$marked['file_id'].'"  class="btn btn-sm btn-block btn-success upperuser" data-toggle="tooltip" data-original-title="Send to officer">अधिकारी को भेजें</button> ' : false;
											echo   ($marked['file_hardcopy_status'] == 'received' || $marked['file_hardcopy_status'] == 'working') && $emp_session_id == $marked['file_received_emp_id'] ? '<button onclick="section_section('.$marked['file_id'].')" value="'.$marked['file_id'].'"  class="btn btn-sm btn-block btn-warning sections_nm" data-toggle="tooltip" data-original-title="Section to Section movement">Section to Section</button> ' : false;
											//echo   $marked['file_hardcopy_status'] == 'received' && $emp_session_id == $marked['file_received_emp_id'] && $marked['file_return'] == 1 ? '<a onclick="return confirm_send()" href="'.base_url().'manage_file/dispatch_file_byso/'.$marked['file_id'].'" class="btn btn-sm btn-instagram btn-block" value="'.$marked['file_id'].'" data-toggle="tooltip" data-original-title="Send to Dispatch">जावक शाखा में भेजें</a> ' : false;
											echo   ($marked['file_hardcopy_status'] == 'received' || $marked['file_hardcopy_status'] == 'working') && $emp_session_id == $marked['file_received_emp_id'] ? '<button onclick="open_model_dispose('.$marked['file_id'].')" class="btn btn-sm btn-block btn-danger" value="'.$marked['file_id'].'" data-toggle="tooltip" data-original-title="Dispose in section">शाखा में Dispose</button> ' : false;
											//echo   $marked['file_hardcopy_status'] == 'received' && $emp_session_id == $marked['file_received_emp_id'] ? '<a onclick="return confirm_send()" href="'.base_url().'manage_file/dispatch_file_byso/'.$marked['file_id'].'" class="btn btn-sm btn-instagram btn-block" value="'.$marked['file_id'].'" data-toggle="tooltip" data-original-title="Send to Dispatch">जावक शाखा में भेजें</a> ' : false;
											 echo   ($marked['file_hardcopy_status'] == 'received' || $marked['file_hardcopy_status'] == 'working') && $emp_session_id == $marked['file_received_emp_id'] ? '<a onclick="send_despetch_section('.$marked['file_id'].',&#39;'.$marked['file_id'].'&#39;)" class="btn btn-sm btn-instagram btn-block" value="'.$marked['file_id'].'" data-toggle="tooltip" data-original-title="Send to Dispatch">जावक शाखा में भेजें</a> ' : false;
											//echo   ($marked['file_hardcopy_status'] == 'received' || $marked['file_hardcopy_status'] == 'working') && $emp_session_id == $marked['file_received_emp_id']  ? '<button type="button" class="btn btn-sm btn-primary btn-block remarkbtn" data-file_id="'.$marked['file_id'].'" data-toggle="modal" data-target="#remarkmodel" data-toggle="tooltip" data-original-title="Add to remark">रिमार्क जोड़े</button> ' : false;
                                            echo   ($marked['file_hardcopy_status'] == 'received' || $marked['file_hardcopy_status'] == 'working') && $emp_session_id == $marked['file_received_emp_id']  ? '<a onclick="return confirm_send()" href="'.base_url('establishment').'/est_files/manage_files/'.$marked['file_id'].'" class="btn btn-sm btn-info btn-block" value="'.$marked['file_id'].'" data-toggle="tooltip" data-original-title="Modify">बदलाव करें</a> ' : false;
                                            echo   ($marked['file_hardcopy_status'] == 'received' || $marked['file_hardcopy_status'] == 'working') && $marked['file_type'] != 'app' && $emp_session_id == $marked['file_received_emp_id']   ? '<button type="button" onclick="open_model_csu('.$marked['file_id'].');" class="btn btn-block btn-sm btn-instagram btn_mark_csu"  data-file_status12 = "'.$marked['file_status'].'"  data-toggle="tooltip" data-original-title="Mark to scan unit for add PDF">Mark to CSU</button>'  : false;

										}
								}else {
									if($this->uri->segment(1)=='today'){
										echo "नस्ती का चयन कर सहायक को मार्क करे  |";
									}else{
										if($marked['final_draft_id'] == '' && $marked['file_hardcopy_status'] != 'received' ){
											echo 'यह फाइल, <a href="#" class="badge bg-light-blue" >फाइल देखें </a>से प्राप्त करें !';
										}else if($marked['file_hardcopy_status'] != 'received' ){
											echo 'यह फाइल,  <a href="'.base_url().'e-files/inbox?searchby='.$crvalue.'" class="badge bg-light-blue" >अंकित ई-फ़ाइलें (Inbox)</a>से प्राप्त करें !';
										}elseif($marked['file_hardcopy_status']=="received"){
											echo '<a href="'.base_url().'e-files/inbox?searchby='.$crvalue.'" class="badge bg-light-blue" >अंकित ई-फ़ाइलें (Inbox)</a>पर कार्यवाही करें !' ;
										}
									}
								}
								echo ($marked['file_hardcopy_status'] == 'received' || $marked['file_hardcopy_status'] == 'working') && $emp_session_id == $marked['file_received_emp_id'] ? '<button type="button" class="btn btn-sm btn-primary btn-block remarkbtn_model" data-file_id="'.$marked['file_id'].'" data-toggle="modal" data-target="#remarkmodel_all_section" data-toggle="tooltip" data-original-title="फाइल से  सम्बंधित रिमार्क जोड़ें ">रिमार्क जोड़े</button> ' : false;
								?>
								</td>
                                </tr>
                                <?php
                                $i++; $sn++; 
                            } //for loop
                        }else { // else not fount
                           echo '';
						   }?>
                        </tbody>
                    </table>
					<form method="post" action="" id="multi_file_post_frm">
						<input type="hidden" value="0" id="file_total_slct_count"/>
						<input type="hidden" value="" id="file_emp_mark_id" name="file_emp_mark_id" />
						<input type="hidden" value="0" id="file_selected_file_ids" name="file_selected_file_ids"/>
						<input type="hidden" value="<?php echo $login_emp_level['emprole_level']; ?>" id="emp_login_level"/>
						<input type="hidden" value="<?php echo $this->uri->segment(1) ?>" id="today_sec_permission" name="today_sec_permission"/>
				   </form>
						<div class="clearfix"></div>
						<div class="row">
								<div class="col-sm-5">
									<div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing <?php if(isset($_GET['per_page']) && !empty($_GET['per_page'])){ echo @$_GET['per_page'];}else{ if($total_files==0){ echo 0;}else{echo '1';}} ?> to <?php if($total_files==0){ echo 0;}else{ echo ($perpage+@$_GET['per_page']);} ?> of <span class="label label-primary">&nbsp;<?php echo $total_files; ?>&nbsp;</span> entries</div>
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
												<?php if(isset($_GET['type']) && $_GET['type']!=''){?>
													<input type="hidden" name="type" value="<?php echo $_GET['type']?>">
												<?php } ?>
												<input type="search" required name="searchby" class="form-control" placeholder="Section & CR number,Subject,UO No.& Date" aria-controls="example1" value="<?php if(isset($_GET['searchby']) && $_GET['searchby']!=''){ echo $_GET['searchby'];} ?>">
												<div class="input-group-btn">
												  <button class="btn btn-success">खोजें</i></button>
												  <?php if(isset($_GET['searchby']) && $_GET['searchby']!=''){?>
													<a href="<?php echo reset_back_url();?>" class="btn btn-success">रीसेट करें</a>
												  <?php } ?>
												</div>
											  </div>								
										</div>
										
									</form>
								</div>
							</div>
							<?php if(check_est_so()){ ?>
							<div style="margin: 10px;" class="pull-right">
								<select disabled id="auto_file_received_value" class="form-control btn btn-sm btn-twitter auto_file_received_value" style="width:150px;font-size:14px;text-align:left">
									<?php if($this->uri->segment(1)!= 'today') { ?><option>चयनित नस्तिया प्राप्त करें</option><?php } ?>
									<option value="<?php echo $emp_session_id ;?>">केवल फाइल  को प्राप्त करें</option>
									<?php $employees  = get_establishment_employees_with_des(false); ?>
									<?php foreach($employees as $emp => $emp_details) { ?>
											<option value="<?php echo $emp_details->emp_id; ?>"><?php echo getemployeeName($emp_details->emp_id,true); ?></option>
									<?php } ?>
								</select>
							</div>
							<?php } ?>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div><!-- /.row -->
    <!-- Main row -->
</section><!-- /.content -->
<?php $this->load->view('view_footer_script'); ?>
<?php $this->load->view('view_file/open_popup_forda') ; ?>

<script>
    function showcomp(comp1)
    {
        window.location='<?php echo base_url();?>view_file/viewdetails/'+comp1;
    }
</script>
<?php $this->load->view('open_popup_for_despetch') ; ?>
