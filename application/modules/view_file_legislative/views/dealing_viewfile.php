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
                        <table id="view_table" class="table table-bordered table-striped">
                            <thead>
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
                            <?php $i=1; foreach ($get_files as $key => $files) { ?>
                                <tr>
                                    <td><?php echo $i;?> (<?php echo $this->lang->line('file_no'); ?> : <?php echo $files->file_id;?>)</td>
									<td>
										<a href="<?php echo base_url()."view_file/viewdetails/".$files->file_id ;?>" data-toggle="tooltip" data-original-title="View details">
										<?php echo getfilesec_id_byfileid($files->file_id,$files->file_mark_section_id);?>
										</a>
										</td>
                                    <td><?php echo $files->file_subject;?>
										 <br><?php if(isset($files->file_status) && $files->file_status != ''){ show_file_status($files->file_status);}?>
									</td>
									<td><?php echo $files->file_uo_or_letter_no; ?> (<?php echo getFileType($files->file_type) ;?>)</td>
                                    <td><?php echo date_format(date_create($files->file_uo_or_letter_date), 'd/m/y'); ?></td>                                    
                                    <td><?php echo getSection($files->file_mark_section_id); ?></td>
									<td><?php
                                        $file_from = file_from_type();
                                        $high_bench =  highcourt_bench();
                                        echo   $files->file_Offer_by == 'c' || $files->file_Offer_by == 'jvn' ? $file_from[$files->file_Offer_by] ." , ". $files->district_name_hi : false ;
                                        echo    $files->file_Offer_by == 'm' || $files->file_Offer_by == 'u' ? $file_from[$files->file_Offer_by] ." , ". $high_bench[$files->court_bench_id] : false ;
                                        echo    $files->file_Offer_by == 'v' || $files->dept_name_hi ? $file_from[$files->file_Offer_by] ." , ". $files->dept_name_hi ." ".$files->file_department_name : $files->file_department_name;

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
                                           /* if($files->file_hardcopy_status == 'not') {
                                                echo "<span style='color:#dd4b39' >Not Received by <b> ".ucfirst($filereceiver[0]->emp_full_name)." , ".$filereceiver[0]->emprole_name_hi."</b></span>";
                                            } else if($files->file_hardcopy_status == 'received') {
                                                echo "<span style='color:#00a65a' >Received by <b> ".ucfirst($filereceiver[0]->emp_full_name)." , ".$filereceiver[0]->emprole_name_hi."</b></span>";
                                            } else if($files->file_hardcopy_status == 'working') {
                                                echo "<span style='color:#00a65a' >Work in Progress by<b> ".ucfirst($filereceiver[0]->emp_full_name)." , ".$filereceiver[0]->emprole_name_hi."</b></span>";
                                            } */
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
										?></td>
                                    <td width="175px">
                                        <div class="btn-group">
                                            <?php if (($files->file_hardcopy_status == 'received' || $files->file_hardcopy_status == 'working') && $files->file_return != '1') { ?>
                                                <a href="<?php echo base_url();?>dashboard/dealing_legis/<?php echo $files->file_id; ?>" class="btn btn-block btn-sm btn-twitter" data-toggle="tooltip" data-original-title="Modify"><i class="fa fa-fw fa-edit"></i> बदलाव करें</a>
                                               <a onclick="return confirm('Are you sure you want to send this file')" href="<?php echo base_url(); ?>manage_file_legislative/dealing_manage_files/return_file_so/<?php echo $files->file_id ; ?>/1" data-toggle="tooltip" data-original-title="Return" class="btn btn-sm btn-block btn-instagram">रिजेक्ट करें</a> <!-- here 1 is use for return file-->
                                            <?php } else if($files->file_hardcopy_status == 'not')  { ?>
                                                <a onclick="return confirm('Are you sure you want to receive this file')" href="<?php echo base_url();?>view_file_legislative/dealing_file/receivebyAD/<?php echo $files->file_id; ?>" class="btn btn-block btn-twitter" title="नस्ती को प्राप्त करें"><span class="blink_fast" data-toggle="tooltip" data-original-title="Receive file"><?php echo $this->lang->line('receive_file') ?></span></a>
                                            <?php } else if($files->file_hardcopy_status == 'received' && $files->file_return == '1'){  ?>
                                                <a href="<?php echo base_url() ?>manage_file_legislative/dealing_manage_files/return_file_so/<?php echo $files->file_id ;?>/2" onclick="return confirm_send()" class="btn btn-block btn-sm btn-success" data-toggle="tooltip" data-original-title="Send to SO">एस. ओ. को भेंजे</a>
                                            <?php } ?>
											<?php echo   $files->file_hardcopy_status == 'received' && emp_session_id() == $files->file_received_emp_id ? '<button type="button" class="btn btn-sm btn-primary btn-block remarkbtn_model" data-file_id="'.$files->file_id.'" data-toggle="modal" data-target="#remarkmodel_all_section" data-toggle="tooltip" data-original-title="फाइल से  सम्बंधित रिमार्क जोड़ें ">रिमार्क जोड़े</button> ' : false;?>
                                        </div>
                                    </td>
                                </tr>
                                <?php $i++; } ?>
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div><!-- /.row -->
        <!-- Main row -->
</section><!-- /.content -->
