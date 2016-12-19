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
        <?php $this->load->view('establishment/est_header'); ?>
        <div class="col-xs-12">
            <div class="box box-danger" id="divname">
                <div class="box-header no-print">
                    <div style="float:left">
					<?php if(check_est_so()) { ?>
                        <div class="btn-group">
                            <a href="?type=p"  class="btn btn-warning <?php echo ($this->input->get('type') && $this->input->get('type') == 'p' || $this->input->get('type') == '') ? 'disabled' : ''; ?>">Pending <span class="badge"><?php echo sizeof($this->complaint_model->get_complaints('p')) ; ?></span></a>
                            <a href="?type=f"  class="btn btn-success <?php echo ($this->input->get('type') && $this->input->get('type') == 'f') ? 'disabled' : ''; ?>">Finished <span class="badge"><?php echo sizeof($this->complaint_model->get_complaints('f')) ; ?></span></a>
                            <a href="?type=all"  class="btn btn-primary <?php echo ($this->input->get('type') && $this->input->get('type') == 'all') ? 'disabled' : ''; ?>">All <span class="badge"><?php echo sizeof($this->complaint_model->get_complaints('all')) ; ?></span></a>
                        </div>
					<?php }  else {
						echo '<h3 class="box-title">Files</h3>';
					}?>
                    </div>
                    <div class="box-tools pull-right">
					 <button onclick="printContents('divname')" class="btn btn-primary ">Print</button>
                        <a href="<?php echo base_url('establishment');?>/add_complaints">
                            <button class="btn  btn-info">आवेदन दर्ज करें</button>
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
                            <th><?php echo $this->lang->line('complaint_sno'); ?></th>
							<th>पंजी क्रं.</th>
                            <th><?php echo $this->lang->line('complaint_type'); ?></th>
                            <th><?php echo $this->lang->line('complaint_emp'); ?></th>
                            <th><?php echo $this->lang->line('complaint_subject');?></th>
                            <th><?php echo $this->lang->line('complaint_time');?></th>
                            <th class="no-print"><?php echo $this->lang->line('complaint_status');?></th>
							<?php if ($this->input->get('type') && $this->input->get('type') != 'p') { ?>
								<th>निराकरण दिनांक</th>
							<?php }else{ ?>
							<th>मार्क दिनांक</th>
							<?php } ?>
							<th class="no-print"><?php echo $this->lang->line('complaint_action'); ?></th>
                         
                        </tr>
                        </thead>
                        <tbody>
                        <?php  if((count($get_complaint_list)>0) && is_array($get_complaint_list)) {?>
                            <?php $i=1; foreach (@$get_complaint_list as $key => $complaint) { 
								$diff=date_diff(date_create($complaint['file_update_date']),date_create(date("Y-m-d")));
                                $checkdate = $diff->format("%a");
								?>
                                <tr <?php
								if ($this->input->get('type') == 'p') {
                                if($checkdate >= '3' && $checkdate <= '7') { echo "style='background-color:#FBFBDE' data-toggle='tooltip' data-original-title='३ दिन से अधिक विलंब'";
                                } else if($checkdate >= '7' && $checkdate <= '10') { echo "style='background-color:#FFE7BA' data-toggle='tooltip' data-original-title='७ दिन से अधिक विलंब'";
                                } else if($checkdate >= '10') { echo "style='background-color:#FFA4A4' data-toggle='tooltip' data-original-title='१० दिन से अधिक विलंब'";}
                                }
								?>>
                                    <td><?php echo $i;?></td>
                                    <td><a href="<?php echo base_url()."view_file/viewdetails/".$complaint['file_id'] ;?>" data-toggle="tooltip" data-original-title="View details"><?php echo @getfilesec_id_byfileid($complaint['file_id'],$complaint['file_mark_section_id'],$complaint['file_type']) ? getfilesec_id_byfileid($complaint['file_id'],$complaint['file_mark_section_id'],$complaint['file_type']) : 'N/A'; ?></a></td>
									<td><?php $com_type = complaint_type($complaint['section_file_type']) ; echo $com_type['category_title_hin']; ?></td>
                                    <td><?php echo getemployeeName($complaint['createfile_empid'], true);?></td>
                                    <td><?php echo $complaint['file_subject']; ?>
										 <br><?php if(isset($files->file_status) && $files->file_status != ''){ show_file_status($files->file_status);}?>
                                    </td>
									<td><?php echo get_date_formate($complaint['file_created_date'], 'd/m/y'); ?></td>
                                    <td class="no-print"><?php
                                        $filereceiver = get_user_details($complaint['file_received_emp_id']);
                                        if ($filereceiver)
                                        {
                                            if($complaint['file_hardcopy_status'] == 'not') {
                                                echo file_not_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi);
                                            } else if($complaint['file_hardcopy_status'] == 'close') {
                                                echo file_closed_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi, $complaint['file_type']);
                                            } else  if($complaint['file_hardcopy_status'] == 'received') {
                                                echo file_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi);
                                            } else if($complaint['file_hardcopy_status'] == 'working'){
                                                echo file_working_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi);
                                            }
                                        } //filereceiver ?>
                                    </td>
									<?php if ($this->input->get('type') && $this->input->get('type') != 'p') { ?>
									<td><?php $days = day_difference_dates($complaint['file_created_date'], $complaint['file_update_date']);
										if($days <= 3){ $lb_class = 'primary'; } else if($days > 3 && $days <= 7){ $lb_class = 'warning'; } else if($days > 7 ){ $lb_class = 'danger'; }
									echo $complaint['file_hardcopy_status'] == 'close' ? get_date_formate($complaint['file_update_date'], 'd/m/y').' <label class="label label-'.$lb_class.'">'.$days.' days</label>' : 'Working' ; ?></td>
									<?php }else{ ?>
									<td><?php echo date_format(date_create($complaint['file_update_date']), 'd/m/y'); ?>
                                        (<?php if($complaint['file_hardcopy_status'] == 'not'){ echo 'मार्क दिनांक';} else { echo 'प्राप्ति दिनांक';} ?>)
                                    </td>
									<?php } ?>
									<td class="no-print">
										<?php $senderemp = empdetails($complaint['file_sender_emp_id']);
                                        echo   $complaint['file_hardcopy_status'] == 'not' && emp_session_id() == $complaint['file_received_emp_id'] ? '<button onclick="open_model3('.$complaint['file_id'].')" class="btn btn-block btn-sm btn-twitter" value="'.$complaint['file_id'].'"><span class="blink_fast">प्राप्त करे</span></button> ' : false;
										if($complaint['file_return'] == '2' && $complaint['file_hardcopy_status'] != 'not' && $complaint['file_hardcopy_status'] != 'close'){
											echo   $complaint['file_hardcopy_status'] == 'received' && emp_session_id() == $complaint['file_received_emp_id'] ? '<button onclick="open_model6('.$complaint['file_id'].')" class="btn btn-sm btn-twitter btn-block rty6" value="'.$complaint['file_id'].'" data-toggle="tooltip" data-original-title="Mark to DA">सहायक को अंकित करें</button>' : false;
										}
                                        echo   $complaint['file_hardcopy_status'] == 'received' && emp_session_id() == $complaint['file_received_emp_id'] ? '<button onclick="open_model6('.$complaint['file_id'].')" class="btn btn-sm btn-twitter btn-block rty6" value="'.$complaint['file_id'].'" data-toggle="tooltip" data-original-title="Mark to DA">शाखा में ही मार्क करे </button>' : false;
                                        echo   $complaint['file_hardcopy_status'] == 'received' && emp_session_id() == $complaint['file_received_emp_id'] ? '<button onclick="open_model2('.$complaint['file_id'].')" value="'.$complaint['file_id'].'"  class="btn btn-sm btn-block btn-success upperuser" data-toggle="tooltip" data-original-title="Send to officer">अधिकारी को भेजें</button> ' : false;
											//echo   $complaint['file_hardcopy_status'] == 'received' && emp_session_id() == $complaint['file_received_emp_id'] ? '<button onclick="section_section('.$complaint['file_id'].')" value="'.$complaint['file_id'].'"  class="btn btn-sm btn-block btn-warning sections_nm" data-toggle="tooltip" data-original-title="Section to Section movement">Section to Section</button> ' : false;
                                        echo   $complaint['file_hardcopy_status'] == 'received' && emp_session_id() == $complaint['file_received_emp_id'] && $complaint['file_return'] == 1 ? '<a onclick="return confirm_send()" href="'.base_url().'manage_file/dispatch_file_byso/'.$complaint['file_id'].'" class="btn btn-sm btn-info btn-block" value="'.$complaint['file_id'].'" data-toggle="tooltip" data-original-title="Send to Dispatch">जावक शाखा में भेजें</a> ' : false;
                                        echo   $complaint['file_hardcopy_status'] == 'received' && emp_session_id() == $complaint['file_received_emp_id'] ? '<button onclick="open_model_dispose('.$complaint['file_id'].')" class="btn btn-sm btn-block btn-danger" value="'.$complaint['file_id'].'" data-toggle="tooltip" data-original-title="Dispose in section">शाखा में Dispose</button> ' : false;
                                        echo   $complaint['file_hardcopy_status'] == 'received' && emp_session_id() == $complaint['file_received_emp_id']  ? '<button type="button" class="btn btn-sm btn-primary btn-block remarkbtn" data-file_id="'.$complaint['file_id'].'" data-toggle="modal" data-target="#remarkmodel" data-toggle="tooltip" data-original-title="Add to remark">रिमार्क जोड़े</button> ' : false;
                                     if($complaint['file_hardcopy_status'] == 'close'){
                                          $get_closeremark = get_list(FILES_DISPATCH, 'dispatch_id', array('file_id' =>$complaint['file_id']));
                                           echo  '<b>रिमार्क : </b>'.$get_closeremark[0]['remark'] ;
                                      }
									 ?>
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
