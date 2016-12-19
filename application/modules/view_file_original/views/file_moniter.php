<link href="<?php echo ADMIN_THEME_PATH; ?>plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
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
            <div class="box" style="overflow: auto" id="divname"> 
                <div class="box-header">
                    <div style="float:left"><h3 class="box-title"><?php echo $title_tab;?></h3>
					<?php if(checkUserrole() == 3 && get_ps_monitor_date() >= 1){  ?>
					<div style="margin-left:460px"><a href="<?php echo base_url(); ?>moniter/files?file_ps=ps" class="btn btn-block btn-info" ><?php echo $this->lang->line('label_ps_monitor_date')?></a></div></div>
					
					<div class="color-palette-set col-sm-4 col-md-3">
					<div class="bg-green disabled color-palette"><span><?php echo $this->lang->line('label_ps_green')?></span></div>
					<div class="bg-yellow color-palette"><span><?php echo $this->lang->line('label_ps_orange')?></span></div>
					<div class="bg-red disabled color-palette"><span><?php echo $this->lang->line('label_ps_red')?></span></div>
					 </div>
					<?php } ?>
					  </div>
				   <div style="float:right">
                        <!--<button class="btn btn-block btn-info"><?php echo $this->lang->line('view_file_mark');?></button>-->
                     
					   <!--<a class="btn btn-info"><?php echo $this->lang->line('view_file_mark');?></a>-->
						<button onclick="printContents('divname')" class="btn btn-primary no-print">Print</button>
                        <button class="btn btn-warning no-print" onclick="goBack()"><?php echo $this->lang->line('Back_button_label'); ?></button>
                    </div>
                    <br/>
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
                <table id="view_table" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th><?php echo $this->lang->line('sno'); ?></th>
                        <th><?php echo $this->lang->line('view_file_subject'); ?></th>
						<th style="display:none"><?php echo "monitor_date"; ?></th>
                        <th><?php echo $this->lang->line('uo/letter_no'); ?></th>
                        <th><?php echo $this->lang->line('view_file_uo_letter_date'); ?></th>
                        <th><?php echo $this->lang->line('section_no1'); ?></th>
                        <th><?php echo $this->lang->line('view_file_mark_section_id'); ?></th>
                        <th class="no-print"><?php echo $this->lang->line('date'); ?></th>
                        <th class="no-print"><?php echo $this->lang->line('filestatus'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=1; foreach ($get_files as $key => $files) { 
					
					?>
                        <tr onClick="showcomp(<?php echo $files->file_id; ; ?>)" style="cursor:pointer; <?php if(checkUserrole() == 3 &&  $files->ps_moniter_date == '' ){} else if(checkUserrole() == 3 && match_date_from_current($files->ps_moniter_date) == 1 ){ echo "background-color:rgb(236, 202, 202)"; }else if(checkUserrole() == 3 && match_date_from_current($files->ps_moniter_date) == 2 ){ echo "background-color:#A9DEA9"; }else if(checkUserrole() == 3 && match_date_from_current($files->ps_moniter_date) == 3 ){ echo "background-color:#E2C081"; } ?>"; data-toggle="tooltip" data-original-title="View Files">
                        <td><?php echo $i;?> (<?php echo $this->lang->line('file_no'); ?> : <?php echo $files->file_id;?>)</td>
                        <td><?php echo $files->file_subject;?> <br><div style="float:right"><b><?php  if(($files->ps_moniter_date != '0000-00-00') && ($files->ps_moniter_date !='1970-01-01')){ echo (@$files->ps_moniter_date)? 'Mark Date :'. date('d-m-Y' , strtotime($files->ps_moniter_date)):''; } ?></b></div></td>
						<td  style="display:none"><?php echo $files->ps_moniter_date;?></td>
                        <td><?php echo $files->file_uo_or_letter_no; ?> (<?php echo getFileType($files->file_type) ;?>)</td>
                        <td><?php echo date_format(date_create($files->file_uo_or_letter_date), 'd/m/y'); ?></td>
                        <td><?php 
						//echo @getfilesec_id_byfileid($files->file_id,$files->file_mark_section_id) ? getfilesec_id_byfileid($files->file_id,$files->file_mark_section_id) : 'N/A'; 
						$rrt = all_getfilesec_id_byfileid($files->file_id);
                                        foreach($rrt as $rrt1){
                                            $sechi = explode('(',getSection($rrt1['section_id']));
                                            echo "<b>".$rrt1['section_number'] ."</b> - <span style='font-size: 12px'>".$sechi['0']."</span><br/>";
                                        }
						?></td>
                        <td><?php echo @getSection($files->file_mark_section_id) ? getSection($files->file_mark_section_id) : 'N/A'; ?></td>
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
                         		} ?></td>
                        </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>
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
