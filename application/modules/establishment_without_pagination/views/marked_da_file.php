
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
                            <a href="?type=p"  class="btn btn-warning <?php echo ($this->input->get('type') && $this->input->get('type') == 'p' || $this->input->get('type') == '') ? 'disabled' : ''; ?>">Pending <span class="badge"><?php echo sizeof($this->est_model->get_marked_da_file('p')) ; ?></span></a>
                            <a href="?type=f"  class="btn btn-success <?php echo ($this->input->get('type') && $this->input->get('type') == 'f') ? 'disabled' : ''; ?>">Finished <span class="badge"><?php echo sizeof($this->est_model->get_marked_da_file('f')) ; ?></span></a>
                            <a href="?type=all"  class="btn btn-primary <?php echo ($this->input->get('type') && $this->input->get('type') == 'all') ? 'disabled' : ''; ?>">All <span class="badge"><?php echo sizeof($this->est_model->get_marked_da_file('all')) ; ?></span></a>
                        </div>
					<?php }  else {
						echo '<h3 class="box-title">Files</h3>';
					}?>
                    </div>
                    <div class="box-tools pull-right">
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
                    <table id="example1" class="table table-bordered table-striped">
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
                        <?php  if((count($get_marked_list)>0) && is_array($get_marked_list)) {?>
                            <?php $i=1; foreach (@$get_marked_list as $key => $marked) { 
								$diff=date_diff(date_create($marked['file_update_date']),date_create(date("Y-m-d")));
                                $checkdate = $diff->format("%a");
								?>
                                <tr <?php
                                if($checkdate >= '3' && $checkdate <= '7') { echo "style='background-color:#FBFBDE' data-toggle='tooltip' data-original-title='३ दिन से अधिक विलंब'";
                                } else if($checkdate >= '7' && $checkdate <= '10') { echo "style='background-color:#FFE7BA' data-toggle='tooltip' data-original-title='७ दिन से अधिक विलंब'";
                                } else if($checkdate >= '10') { echo "style='background-color:#FFA4A4' data-toggle='tooltip' data-original-title='१० दिन से अधिक विलंब'";}
                                ?>>
                                    <td><?php echo $i;?></td>
									<td><a href="<?php echo base_url()."view_file/viewdetails/".$marked['file_id'] ;?>" data-toggle="tooltip" data-original-title="View details"><?php echo @getfilesec_id_byfileid($marked['file_id'],$marked['file_mark_section_id'],$marked['file_type']) ? getfilesec_id_byfileid($marked['file_id'],$marked['file_mark_section_id'],$marked['file_type']) : 'N/A'; ?></a></td>
                                    <td><?php $com_type = $marked['section_file_type'] != '' ? complaint_type($marked['section_file_type']) : 'N/A' ;  echo $com_type != 'N/A' ? $com_type['category_title_hin'] : $com_type; ?></td>
                                    <td><?php echo getemployeeName($marked['file_sender_emp_id'], true);?></td>
                                    <td><?php echo getemployeeName($marked['createfile_empid'], true);?></td>
									<td><?php echo $marked['file_subject']; ?>
										<br><?php  if(isset($marked['file_status']) && $marked['file_status'] != ''){ show_file_status($marked['file_status']);}?>
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
										<?php $senderemp = empdetails($marked['file_sender_emp_id']);
										if(is_array($this->session->userdata('today_permission_assign'))){
											$is_subuser='?subuse='.$this->session->userdata['today_permission_assign']['today_permission_given_empid'];
										}else{
											$is_subuser='';
										}
										if($marked['file_return'] == '2' && $marked['file_hardcopy_status'] != 'not' && $marked['file_hardcopy_status'] != 'close'){
											echo    '<a onclick="return confirm_send()" href="'.base_url().'manage_file/dispatch_file_byso/'.$marked['file_id'].'" class="btn btn-sm  btn-block btn-instagram" value="'.$marked['file_id'].'">जावक शाखा में भेजें</a>';
											echo   $marked['file_hardcopy_status'] == 'received' && emp_session_id() == $marked['file_received_emp_id'] && $marked['file_level_id'] != '31' ? '<button onclick="open_model2('.$marked['file_id'].')" value="'.$marked['file_id'].'"  class="btn btn-sm btn-block btn-success upperuser" data-toggle="tooltip" data-original-title="Send to officer">अधिकारी को भेजें</button> ' : false;
											echo   $marked['file_hardcopy_status'] == 'received' && emp_session_id() == $marked['file_received_emp_id'] ? '<button onclick="open_model6('.$marked['file_id'].')" class="btn btn-sm btn-twitter btn-block rty6" value="'.$marked['file_id'].'" data-toggle="tooltip" data-original-title="Mark to DA">सहायक को  अंकित करें</button>' : false;
										}else{

											// echo   $marked['file_hardcopy_status'] == 'not' && emp_session_id() == $marked['file_received_emp_id'] && $this->uri->segment(3) != 'return' ? '<a onclick="return confirm_receive()" href="'.base_url().'establishment/manage_file/receive_file_sectionno/'.$marked['file_id'].'" class="btn btn-block btn-twitter"><span class="blink_fast" data-toggle="tooltip" data-original-title="Receive">'.$this->lang->line('receive_file').'</span></a>' : false; // file receive from dealing assistant

											// echo   $marked['file_hardcopy_status'] == 'not' && emp_session_id() == $marked['file_received_emp_id'] ? '<button onclick="receive_markda('.$marked['file_id'].')" class="btn btn-block btn-sm btn-twitter rty6" value="'.$marked['file_id'].'"><span class="blink_fast">'.$this->lang->line('receive_file').'</span></button> <a data-toggle="tooltip" data-original-title="वापस भेजें" onclick="return confirm_reject()" href="'.base_url().'establishment/manage_file/reject_file/'.$marked['file_id'].'" class="btn btn-block btn-sm btn-instagram" data-toggle="tooltip" data-original-title="Reject">'.$this->lang->line('reject').'</a>' : false;
											echo   $marked['file_hardcopy_status'] == 'not' && emp_session_id() == $marked['file_received_emp_id'] ? '<button onclick="open_model3('.$marked['file_id'].')" class="btn btn-block btn-sm btn-twitter rty6" value="'.$marked['file_id'].'"><span class="blink_fast">प्राप्त करें</span></button>' : false;
											echo   $marked['file_hardcopy_status'] == 'not' && $marked['file_type'] != 'app' && emp_session_id() == $marked['file_received_emp_id'] ? ' <a data-toggle="tooltip" data-original-title="वापस भेजें" onclick="return confirm_reject()" href="'.base_url().'establishment/manage_file/reject_file/'.$marked['file_id'].'" class="btn btn-block btn-sm btn-danger" data-toggle="tooltip" data-original-title="Reject">अस्वीकारे</a>' : false;

											echo   $marked['file_hardcopy_status'] == 'received' && emp_session_id() == $marked['file_received_emp_id'] ? '<button onclick="open_model6('.$marked['file_id'].')" class="btn btn-sm btn-twitter btn-block rty6" value="'.$marked['file_id'].'" data-toggle="tooltip" data-original-title="Mark to DA">शाखा में ही मार्क करे </button>' : false;
											echo   $marked['file_hardcopy_status'] == 'received' && emp_session_id() == $marked['file_received_emp_id'] ? '<button onclick="open_model2('.$marked['file_id'].')" value="'.$marked['file_id'].'"  class="btn btn-sm btn-block btn-success upperuser" data-toggle="tooltip" data-original-title="Send to officer">अधिकारी को भेजें</button> ' : false;
											echo   $marked['file_hardcopy_status'] == 'received' && emp_session_id() == $marked['file_received_emp_id'] ? '<button onclick="section_section('.$marked['file_id'].')" value="'.$marked['file_id'].'"  class="btn btn-sm btn-block btn-warning sections_nm" data-toggle="tooltip" data-original-title="Section to Section movement">Section to Section</button> ' : false;
											//echo   $marked['file_hardcopy_status'] == 'received' && emp_session_id() == $marked['file_received_emp_id'] && $marked['file_return'] == 1 ? '<a onclick="return confirm_send()" href="'.base_url().'manage_file/dispatch_file_byso/'.$marked['file_id'].'" class="btn btn-sm btn-instagram btn-block" value="'.$marked['file_id'].'" data-toggle="tooltip" data-original-title="Send to Dispatch">जावक शाखा में भेजें</a> ' : false;
											echo   $marked['file_hardcopy_status'] == 'received' && emp_session_id() == $marked['file_received_emp_id'] ? '<button onclick="open_model_dispose('.$marked['file_id'].')" class="btn btn-sm btn-block btn-danger" value="'.$marked['file_id'].'" data-toggle="tooltip" data-original-title="Dispose in section">शाखा में Dispose</button> ' : false;
											//echo   $marked['file_hardcopy_status'] == 'received' && emp_session_id() == $marked['file_received_emp_id'] ? '<a onclick="return confirm_send()" href="'.base_url().'manage_file/dispatch_file_byso/'.$marked['file_id'].'" class="btn btn-sm btn-instagram btn-block" value="'.$marked['file_id'].'" data-toggle="tooltip" data-original-title="Send to Dispatch">जावक शाखा में भेजें</a> ' : false;
											 echo   $marked['file_hardcopy_status'] == 'received' && emp_session_id() == $marked['file_received_emp_id'] ? '<a onclick="send_despetch_section('.$marked['file_id'].',&#39;'.$marked['file_id'].'&#39;)" class="btn btn-sm btn-instagram btn-block" value="'.$marked['file_id'].'" data-toggle="tooltip" data-original-title="Send to Dispatch">जावक शाखा में भेजें</a> ' : false;
											echo   $marked['file_hardcopy_status'] == 'received' && emp_session_id() == $marked['file_received_emp_id']  ? '<button type="button" class="btn btn-sm btn-primary btn-block remarkbtn" data-file_id="'.$marked['file_id'].'" data-toggle="modal" data-target="#remarkmodel" data-toggle="tooltip" data-original-title="Add to remark">रिमार्क जोड़े</button> ' : false;
                                            echo   $marked['file_hardcopy_status'] == 'received' && emp_session_id() == $marked['file_received_emp_id']  ? '<a onclick="return confirm_send()" href="'.base_url('establishment').'/est_files/manage_files/'.$marked['file_id'].'" class="btn btn-sm btn-info btn-block" value="'.$marked['file_id'].'" data-toggle="tooltip" data-original-title="Modify">बदलाव करें</a> ' : false;
										
										}	?>                                           
										
									</td>
                                </tr>
                                <?php
                                $i++;
                            } //for loop
                        }else { // else not fount
                           echo '';
						   }?>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div><!-- /.row -->
    <!-- Main row -->
</section><!-- /.content -->
<?php $this->load->view('view_footer_script'); ?>
<script>
    function showcomp(comp1)
    {
        window.location='<?php echo base_url();?>view_file/viewdetails/'+comp1;
    }
</script>
<?php $this->load->view('open_popup_for_despetch') ; ?>
