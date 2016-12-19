
<link href="<?php echo ADMIN_THEME_PATH; ?>plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo $title_tab; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo $title_tab; ?></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Your Page Content Here -->
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box" style="overflow: auto" id="divname">
                <div class="box-body">
                    <div class="pull-right">
                        <?php if(empty($_GET['empid'])){ ?>
                        <a href="<?php echo base_url(); ?>ps_file_monitor" class="btn btn-primary btn-sm no-print" <?php if($this->uri->segment(2) == ''){ echo "disabled"; } ?>>WIP</a>
                        <a href="<?php echo base_url(); ?>ps_file_monitor/index/close" class="btn btn-primary btn-sm no-print" <?php if($this->uri->segment(3) == 'close'){ echo "disabled"; } ?>>CLOSE</a>
                        <a href="<?php echo base_url(); ?>ps_file_monitor/index/all" class="btn btn-primary btn-sm no-print" <?php if($this->uri->segment(3) == 'all'){ echo "disabled"; } ?>>ALL</a>
                       <?php } ?>
                        <button onclick="printContents('divname')" class="btn btn-sm btn-primary no-print">Print</button>
                        <button class="btn btn-sm btn-warning no-print" onclick="goBack()"><?php echo $this->lang->line('Back_button_label'); ?></button>
                    </div>
                    <span><?php echo "पी .एस. मॉनिटर फ़ाइलें";?></span>
                    <div class="no-print callout">
                        <div class="disabled color-palette" style="float:left;padding-right: 20px;margin-left: 150px;padding-left: 10px;background-color:#FFA4A4 !important"><span><?php echo $this->lang->line('label_ps_red')?></span></div>
                        <div class="color-palette" style="float:left;background:#FFE7BA;padding-right: 20px;margin-left: 18px;padding-left: 10px;"><span><?php echo 'मोनिट अवधि समाप्त होने वाली फाइलें '?></span></div>
                        <div class="bg-red disabled color-palette blink_me" style="float:left;padding-right: 20px;margin-left: 18px;padding-left: 10px;background-color:red !important"><span><?php echo 'मोनिट अवधि समाप्त हो चुकी फाइलें ';?></span></div>
                    </div>
            </div><!-- /.box-header -->
            <?php // echo $this->session->flashdata('message'); ?>
            <?php if($this->session->flashdata('message') || $this->session->flashdata('error')) {
                $msg = $this->session->flashdata('message') ? 'success' : 'danger';
                ?>
                <div class="alert alert-<?php echo $msg; ?> alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>
                        <?php  echo $this->session->flashdata('message');
                        echo $this->session->flashdata('error'); ?>
                    </strong>
                    <br/>
                </div>
            <?php } ?>
            <?php if(emp_session_id() != $this->session->userdata('emp_id')){
                $em =  empdetails(emp_session_id());
                ?>
                <div class="callout callout-info lead">
                    <p>आप <b><?php echo emp_gender(emp_session_id()) ." ". $em[0]['emp_full_name_hi'] ." (". getemployeeRole($em[0]['role_id']).")" ;?></b> को अंकित की गई फाइलें देख रहे है |</p>
                </div>
            <?php  } ?>
			<div class="fix_table-container fix_maintable">
            <table class="table table-bordered table-hover"> <!--id="view_table"-->
                <thead style="background-color:white">
                <tr>
                    <th><?php echo $this->lang->line('sno'); ?></th>
                    <th style="width:62px"><?php echo $this->lang->line('section_no1'); ?></th>
                    <th><?php echo $this->lang->line('view_file_subject'); ?></th>
                    <th style="display:none"><?php echo "monitor_date"; ?></th>
                    <th><?php echo $this->lang->line('uo/letter_no'); ?></th>
                    <th><?php echo $this->lang->line('view_file_uo_letter_date'); ?></th>

                    <th><?php echo $this->lang->line('view_file_mark_section_id'); ?></th>
                    <th>मॉनिटर निशान दिनांक</th>
                    <th>प्रतिक्रिया  दिनांक</th>
                    <th class="no-print"><?php echo $this->lang->line('date'); ?></th>
                    <th class="no-print"><?php echo $this->lang->line('filestatus'); ?></th>
                    <th class="no-print">कार्यवाही</th>
                </tr>
                </thead>
                <tbody>
                <?php $i=1; foreach ($get_files as $key => $files) { ?>
                    <?php
							$bgcolor=null;
							$addblink = '';
							if(checkUserrole() == 3 && $files->ps_moniter_date =='' && $files->file_hardcopy_status!='close' && $files->file_return!=2)
							{$bgcolor='';} 
							else if(match_date_from_current($files->ps_moniter_date) == 0 && $files->file_hardcopy_status!='close' && $files->file_return!=2)
                    { $bgcolor="background-color:#FFA4A4 !important";  }
							else if(match_date_from_current($files->ps_moniter_date) <= -1 && $files->file_hardcopy_status!='close' && $files->file_return!=2 )
							{ $bgcolor="background-color:red; color:#fff !important" ;  $addblink = "class='blink_me'";
							}else if(match_date_from_current($files->ps_moniter_date) >= 1 && $files->file_hardcopy_status!='close' && $files->file_return!=2 )
                    { $bgcolor="background-color:#FFE7BA ;";
							} 
						?>
                        <tr style="cursor:pointer;<?php echo $bgcolor; ?> " data-toggle="tooltip" data-original-title="PS Monitor Due Date : <?php echo date_format(date_create($files->ps_moniter_date), 'd/m/y'); ?>">
                        <td title="<?php echo 'FSN:-'.$files->file_id;?>">
                            <?php $section_number_array= get_cr_section_nuber($files->file_id); ?>
                            <?php echo $i;?>
                            <?php if(isset($section_number_array['section_number']) && $section_number_array['section_number']!='') {?><br/> CR-<?php echo $section_number_array['section_number'];?><?php } ?>
                        </td>
							<td onClick="showcomp(<?php echo $files->file_id; ; ?>)" ><?php
							 //echo @getfilesec_id_byfileid($files->file_id,$files->file_mark_section_id) ? getfilesec_id_byfileid($files->file_id,$files->file_mark_section_id) : 'N/A'; 
									$rrt = all_getfilesec_id_byfileid($files->file_id);
									foreach($rrt as $rrt1){
                                            $sechi = explode('(',getSection($rrt1['section_id']));
                                            echo "<b>".$rrt1['section_number'] ."</b> - <span style='font-size: 12px'>".$sechi['0']."</span><br/>";
									}
							?>
							</td>
                        <td onClick="showcomp(<?php echo $files->file_id; ; ?>)"><span <?php echo $addblink ; ?>><?php echo $files->file_subject;?></span>
                            <span class="no-print"><br><?php if(isset($files->scan_id) && $files->scan_id != ''){ show_scan_file($files->scan_id);}?>
                            <br><?php if(isset($files->file_status) && $files->file_status != ''){ show_file_status($files->file_status);}?></span>
                            <td style="display:none"><?php echo $files->ps_moniter_date;?></td>
							<td><?php echo $files->file_uo_or_letter_no; ?> (<?php echo getFileType($files->file_type) ;?>)</td>
							<td><?php echo date_format(date_create($files->file_uo_or_letter_date), 'd/m/y'); ?></td>
                       
							<td><?php echo @getSection($files->file_mark_section_id) ? getSection($files->file_mark_section_id) : 'N/A'; ?></td>
							<td title="Mark monitor date"><?php echo date_format(date_create($files->ps_mark_monitor_date), 'd/m/y'); ?></td>
							<td><b title="Monitor date"><?php echo date_format(date_create($files->ps_moniter_date), 'd/m/y'); ?></b></td>
							<td class="no-print"><?php echo date_format(date_create($files->file_update_date), 'd/m/y'); ?>
								(<?php if($files->file_hardcopy_status == 'not'){ echo $this->lang->line('mark_date');} else { echo $this->lang->line('received_date');} ?>)
							</td>
                            <td class="no-print"><?php
                                $filereceiver = get_user_details($files->file_received_emp_id);
                                if ($filereceiver)
                                {
									if($files->file_hardcopy_status == 'not') {
										echo file_not_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi);
                                    } else if($files->file_hardcopy_status == 'close') {
										echo file_closed_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi, $files->file_type);
                                 } else{
										echo file_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi);
									}
                         		}
								if($files->multi_user_receiver_id !=null){
                                    $multi_rece = explode(',',$files->multi_user_receiver_id);
                                    if($files->multi_user_receiver_id != null && $files->multi_user_receiver_id != '' && in_array($files->file_received_emp_id,$multi_rece)){                                               echo " तथा ";

                                        foreach($multi_rece as $multi) {
                                            if ($multi != $files->file_received_emp_id) {
                                                $multi_nm = getemployeeName($multi);
												echo $multi_nm;
                                                echo " , ";
                                            }
                                        }
                                        echo " को अंकित की गई है |";
                                    }
                                    }

								?>
							</td>
                        <td class="no-print">
                            <?php  $dispage = show_view_as_lvl();
                            if($dispage == 'view_file/view_file_list'){
                                $redirectpage = 'view_file/Dispaly_list';
                            }elseif($dispage == 'view_file/index'){
                                $redirectpage = 'view_file';
                            }elseif($dispage == 'view_file/viewfile_fornotesheet'){
                                $redirectpage = 'view_file/dealing_file';
                            }else{
                                $redirectpage='';
                            } ?>
                            <?php  if(emp_session_id() == $files->file_received_emp_id && ($files->file_status == 'p' || $files->file_status == 'P')){          ?>
                                <?php
                                if($files->file_hardcopy_status == 'not') {
                                    echo 'यह फाइल, <span"><a href="' .base_url().''.$redirectpage.'#CR-'. $section_number_array['section_number'] . '" class="badge bg-light-blue" >फाइल देखें </a> से प्राप्त करें |</span>';
                                }else{
                                    echo 'इस फाइल पर, <span"><a href="' .base_url().''.$redirectpage.'#CR-'. $section_number_array['section_number'] . '" class="badge bg-light-blue" >फाइल देखें </a> से कार्यवाही करें !</span>';
                                }
                            }elseif(emp_session_id() == $files->file_received_emp_id && $files->file_status != '') {
                                if($files->final_draft_id='' && $files->file_hardcopy_status != 'received' ){
                                    echo 'यह फाइल, <a href="#" class="badge bg-light-blue" >फाइल देखें </a>से प्राप्त करें !';
                                }else if($files->file_hardcopy_status != 'received' ){
                                    echo 'यह फाइल,  <a href="'.base_url().'e-files/inbox#CR-'.$section_number_array['section_number'].'" class="badge bg-light-blue" >अंकित ई-फ़ाइलें (Inbox)</a>से प्राप्त करें !';
                                }elseif($files->file_hardcopy_status=="received"){
                                    echo '<span"><a href="'.base_url().'e-files/inbox#CR-'.$section_number_array['section_number'].'" class="badge bg-light-blue" >अंकित ई-फ़ाइलें (Inbox)</a>में कार्यवाही करें !</span>' ;
                                }
                            } ?>

                        </td>
                    </tr>
                    <?php $i++; } ?>
                </tbody>
            </table>
			<div id="bottom_anchor"></div> <!---use for fix table header-->
			</div>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
    </div><!-- /.row -->
    <!-- Main row -->
</section><!-- /.content -->
<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Page Script -->
<script>
    function showcomp(comp1)
    {
        window.location='<?php echo base_url();?>view_file/viewdetails/'+comp1;
    }
</script>
<style type="text/css">
    #leave_employee_filter{
        clear: both;
    }
</style>


