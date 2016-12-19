
<section class="content-header">
    <h1>
        <?php echo $title ?>

    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">Leave Dashboard</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Start box) -->
    <div class="row">
        <?php $this->load->view('leave_dashboard')?>
    </div><!-- /.row -->

    <div class="row" id="divname1">
        <div class="col-md-12">
            <?php echo $this->session->flashdata('message'); ?>
            <div class="box box-info">
                <div class="box-header">
                    <i class="fa fa-inbox"></i><h3 class="box-title"><?php echo $this->lang->line('current_leave_status'); ?></h3>
                <div class="pull-right no-print"> 
						<button class="btn btn-warning" onclick="goBack()">पिछले पेज में वापस जायें</button>				
                        <button onclick="printContents('divname1')" class="btn btn-primary no-print">Print</button>                           
                    </div>
				</div><!-- /.box-header -->

                <div class="box-body no-padding">
                    <table class="table">
                        <tr>
                            <th style="width: 10px">#</th>
                            <th><?php echo $this->lang->line('leave_type') ?></th>                           
                            <th><?php echo $this->lang->line('leave_start_date') ?></th>
                            <th><?php echo $this->lang->line('end_date') ?></th>  
                            <th><?php echo $this->lang->line('leave_days') ?></th>
                            <th><?php echo $this->lang->line('leave_reason') ?></th>
                            <th><?php echo $this->lang->line('headqurter_permosion') ?></th>
                            <th><?php echo $this->lang->line('half_day_status') ?></th>
                            <th><?php echo $this->lang->line('leave_status') ?></th>
                            <th><?php echo $this->lang->line('action') ?></th>
                            <th><?php echo $this->lang->line('print') ?></th>
                        </tr>
                        <?php
                        $r = 1;
                        //pr($leaves_pending);
                        if (isset($leaves_pending)) {
                            foreach ($leaves_pending as $leave_det) {
                               ?>
                                <tr>
                                    <td><?php echo $r; ?>.</td>
                                    <td><?php echo!empty($leave_det->emp_leave_type) ? leaveType($leave_det->emp_leave_type, true) : '-' ?></td>
                                    <td><?php echo ($leave_det->emp_leave_date != '1970-01-01') ? get_date_formate($leave_det->emp_leave_date) : '-' ?> </td>
                                    <td><?php echo ($leave_det->emp_leave_end_date != '1970-01-01') ? get_date_formate($leave_det->emp_leave_end_date) : '-' ?> 
                                   <?php if($leave_det->sickness_date != $leave_det->emp_leave_date){
                                         echo strtotime($leave_det->sickness_date) ? 
                                        '<button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="left" title="Sickness Certificate date '.get_date_formate($leave_det->sickness_date, 'd.m.Y').' and EL from '.get_date_formate($leave_det->emp_leave_date,'d.m.Y').' to '.date('d.m.Y',strtotime($leave_det->sickness_date.'-1 Day')).'">i</button>' : 
                                        '';  } ?> </td>
                                    <td><?php echo!empty($leave_det->emp_leave_no_of_days) ? 
                                            $leave_det->emp_leave_type == 'hpl' ? ($leave_det->emp_leave_no_of_days * 2) .' ('.$leave_det->emp_leave_no_of_days.')' : $leave_det->emp_leave_no_of_days : 
                                            '-' ?></td>
                                    <td><?php echo!empty($leave_det->emp_leave_reason) ? $leave_det->emp_leave_reason : '-' ?></td>
                                    <td><?php echo $leave_det->emp_leave_is_HQ == 1 ? 
                                        $this->lang->line('yes').'('.get_date_formate($leave_det->emp_leave_HQ_start_date).'-'.get_date_formate($leave_det->emp_leave_HQ_end_date).' )' : 
                                        $this->lang->line('no'); ?>
                                        <?php if($leave_det->leave_message != '' && $leave_det->emp_leave_is_HQ == 1){ ?>
                                            <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="left" title="<?php echo $leave_det->leave_message; ?>">i</button>
                                        <?php } ?>
                                    </td>
                                    <td><?php echo!empty($leave_det->emp_leave_half_type) ? $leave_det->emp_leave_half_type == 'FH' ? $this->lang->line('first_half') : $this->lang->line('second_half') : '-' ?></td>
                                    <td> <?php /* <label class="label label-info"><?php echo leave_status(true, $leave_det->leave_status); ?></label> */ ?>
                                    <?php 
                                        if ($leave_det->emp_leave_approval_type == 0) {
                                            if ($leave_det->emp_leave_forword_type == 0) {
                                                echo '<label class="label label-warning">' . $this->lang->line('leave_status_pending') . '</label>';
                                            } else if (($leave_det->emp_leave_forword_type == 1) OR ( $leave_det->emp_leave_forword_type == 2)) {
                                                echo '<label class="label label-warning">' . $this->lang->line('leave_status_on_approval') . '</label>';
                                            }
                                        } 
                                        ?> </td>                                   
                                    <td>
                                        <?php if ($leave_det->emp_leave_forword_type == 0) { ?>
                                            <a href="<?php echo base_url(); ?>leave/cancel/<?php echo $leave_det->emp_leave_movement_id; ?>" class="text-danger" onClick="return confirm('Are you sure?');"><span class="fa fa-close"></span> <?php echo $this->lang->line('cancel_leave') ?></a>
                                        <?php } else if ($leave_det->emp_leave_forword_type == 1) { ?>
                                            <label class="label label-info"><?php echo getemployeeName($leave_det->emp_leave_forword_emp_id); ?></label>
                                            <label class="label label-success"><?php echo $this->lang->line('leave_forworeded_option'); ?></label>
                                        <?php } else if ($leave_det->emp_leave_forword_type == 2) { ?>
                                            <label class="label label-info"><?php echo getemployeeName($leave_det->emp_leave_forword_emp_id); ?></label>
                                            <label class="label label-danger"><?php echo $this->lang->line('leave_not_forworeded_option'); ?></label>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo base_url(); ?>leave/print/<?php echo $leave_det->emp_leave_movement_id; ?>" class="btn btn-primary"><span class="fa fa-print"></span> <?php echo $this->lang->line('print_button') ?></a>
                                        <?php if($leave_det->medical_files !=  '') { ?>
                                            <a href="<?php echo base_url(); ?>uploads/medical_files/<?php echo $leave_det->medical_files; ?>" target="_blank">Certificate</a>
                                        <?php } ?>
                                    </td>

                                </tr>
                                <?php
                                $r++;
                            }
                        } else {
                            ?><tr>  <td colspan="3"><?php echo $this->lang->line('no_record_found'); ?></td></tr><?php }
                        ?>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="row" id="divname">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header">
                    <i class="fa fa-inbox"></i><h3 class="box-title"><?php echo $this->lang->line('total_leaves'); ?> (2015)</h3>
                    <div class="pull-right no-print">                       
                        <button onclick="printContents('divname')" class="btn btn-primary no-print">Print</button>                           
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                    <table class="table">
                        <tr>
                            <th style="width: 10px">#</th>
                            <th><?php echo $this->lang->line('leave_type') ?></th>                           
                            <th><?php echo $this->lang->line('when_date') ?></th>
                            <th><?php echo $this->lang->line('leave_days') ?></th>
                            <th><?php echo $this->lang->line('leave_reason') ?></th>
                            <th><?php echo $this->lang->line('headqurter_permosion') ?></th>
                            <th><?php echo $this->lang->line('half_day_status') ?></th>
                            <th><?php echo $this->lang->line('leave_status') ?></th>
                            <th><?php echo $this->lang->line('leave_on_approve_date') ?></th>
                            <th><?php echo $this->lang->line('onbehalf') ?></th>
                            <th><?php echo $this->lang->line('reason') ?></th>
                            <th><?php echo $this->lang->line('order') ?></th>
                        </tr>
                        <?php
                        $r = 1;
                        $total = array(
                            'cl' => 0,
                            'ol' => 0,
                            'el' => 0,
                            'hpl' => 0,
                        ); 
                        if (isset($leaves_approve_deny_cancel)) {
                            foreach ($leaves_approve_deny_cancel as $details) {
                                ?>
                                <tr class="bg-<?php
                                    switch ($details->emp_leave_type) {
                                        case 'cl':
                                            echo "info";
                                            $total['cl'] = $details->emp_leave_approval_type ==  1 ? $details->emp_leave_no_of_days + $total['cl'] : $total['cl'] ;
                                            break;
                                        case 'ol':
                                            echo "success";
                                            $total['ol'] = $details->emp_leave_approval_type ==  1 ? $details->emp_leave_no_of_days + $total['ol'] : $total['ol'];
                                            break;
                                        case 'el':
                                            echo "warning";
                                            $total['el'] = $details->emp_leave_approval_type ==  1 ? $details->emp_leave_no_of_days + $total['el'] : $total['el'];
                                            break;
                                        case 'hpl':
                                            echo "danger";
                                            break;
                                        default:
                                            echo "transparent";
                                            break;
                                    }
                                    ?>">
                                    <td><?php echo $r; ?>.</td>
                                    <td><?php echo!empty($details->emp_leave_type) ? leaveType($details->emp_leave_type, true) : '-' ?></td>                             
                                    <td><?php echo ($details->emp_leave_date != '1970-01-01') ? get_date_formate($details->emp_leave_date,'d.m.y') : '-' ?> 
                                        to <?php echo ($details->emp_leave_end_date != '1970-01-01') ? get_date_formate($details->emp_leave_end_date,'d.m.Y') : '-' ?> 
                                      <?php  if($details->sickness_date != $details->emp_leave_date){
                                        echo strtotime($details->sickness_date) ? 
                                        '<span type="button" class="btn btn-info" data-toggle="tooltip" data-placement="left" title="Sickness Certificate date '.get_date_formate($details->sickness_date, 'd.m.Y').' and EL from '.get_date_formate($details->emp_leave_date,'d.m.Y').' to '.date('d.m.Y',strtotime($details->sickness_date.'-1 Day')).'">i</span>' : 
                                        '' ; } ?>
                                    </td>
                                    <td><?php echo!empty($details->emp_leave_no_of_days) ? 
                                            $details->emp_leave_type == 'hpl' ? ($details->emp_leave_no_of_days * 2) .' ('.$details->emp_leave_no_of_days.')' : $details->emp_leave_no_of_days : 
                                            '-' ?>
                                        <?php   if($details->sickness_date != $details->emp_leave_date && $details->emp_leave_type == 'hpl'){ 
                                                $diff =  day_difference_dates($details->sickness_date, $details->emp_leave_end_date) + 1; 
                                                 if(strtotime($details->sickness_date) != '') {
                                                    echo  " [Adjust in ".($diff * 2).'('.$diff.") days]" ;
                                                    //$total['hpl'] = $details->emp_leave_approval_type ==  1 ? ($diff * 2) + $total['hpl'] : $total['hpl'];
                                                 }
                                             } else {
                                                  //$total['hpl'] = $details->emp_leave_approval_type ==  1 ? ($details->emp_leave_no_of_days * 2) + $total['hpl'] : $total['hpl'];
                                             }
                                        ?>
                                    </td>
                                    <td><?php echo!empty($details->emp_leave_reason) ? $details->emp_leave_reason : '-' ?></td>
                                    <td><?php echo $details->emp_leave_is_HQ == 1 ? 
                                        $this->lang->line('yes').'('.get_date_formate($details->emp_leave_HQ_start_date).'-'.get_date_formate($details->emp_leave_HQ_end_date).')' : 
                                        $this->lang->line('no'); ?>
                                     <?php if($details->leave_message != '' && $details->emp_leave_is_HQ == 1){ ?>
                                            <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="left" title="<?php echo $details->leave_message; ?>">i</button>
                                        <?php } ?>
                                    </td>  
                                    <td><?php echo!empty($details->emp_leave_half_type) ? $details->emp_leave_half_type == 'FH' ? $this->lang->line('first_half') : $this->lang->line('second_half') : '-' ?></td>
                                    <td><?php
                                        if (!empty($details->emp_leave_forword_type)) {
                                            if ($details->emp_leave_approval_type == 1) {
                                                echo '<label class="label label-success">' . $this->lang->line('leave_status_approve') . '</label>';
                                            }
                                            if ($details->emp_leave_approval_type == 2) {
                                                echo '<label class="label label-danger">' . $this->lang->line('leave_status_deny') . '</label>';
                                            }
                                            if ($details->emp_leave_approval_type == 3 || $details->emp_leave_forword_type == 3) {
                                                echo '<label class="label label-warning">' . $this->lang->line('leave_cancel') . '</label>';
                                            }
                                        }
                                        ?> </td>
                                    <td><?php echo ($details->emp_leave_forword_date != '0000-00-00 00:00:00') ? get_date_formate($details->emp_leave_forword_date) : '-' ?> </td>
                                    <td><?php echo!empty($details->on_behalf_leave) ? $details->on_behalf_leave != $this->session->userdata('emp_id') ? getemployeeName($details->on_behalf_leave) : $this->lang->line('self') : '-' ?></td>
                                    <td><?php echo!empty($details->emp_leave_deny_reason) ? $details->emp_leave_deny_reason : '-' ?> </td>
                                    <td>
                                        <?php if ($details->emp_leave_approval_type == 1 && ($details->emp_leave_type == 'el' || $details->emp_leave_type == 'hpl') ) { ?>
                                            <a href="<?php echo base_url(); ?>leave/leave/print_order/<?php echo $details->emp_leave_movement_id; ?>" class="btn btn-primary"><span class="fa fa-print"></span> <?php echo $this->lang->line('print_button') ?></a>
                                        <?php   } ?>
                                        <?php if($details->medical_files !=  '') { ?>
                                            <a href="<?php echo base_url(); ?>uploads/medical_files/<?php echo $details->medical_files; ?>" target="_blank">Certificate</a>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php
                                $r++;
                            }
                        } else {
                            ?><tr>  <td colspan="3"><?php echo $this->lang->line('no_record_found'); ?></td></tr><?php }
                        ?>
                    </table>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <h4><?php echo $this->lang->line('total_leaves'); ?></h4>
                    <table>
                        <tr>
                            <th><?php echo leaveType('cl', true); ?></th>
                            <th><?php echo leaveType('ol', true); ?></th>
                            <th><?php echo leaveType('el', true); ?></th>
                            <th><?php echo leaveType('hpl', true); ?> (<?php echo leaveType('comm', true); ?>)</th>
                        </tr>
                        <tr>
                            <td><?php echo $total['cl']; ?></td>
                            <td><?php echo $total['ol']; ?></td>
                            <td><?php echo $total['el']; ?></td>
                            <td><?php /*echo $total['hpl']; ?>(<?php echo calculate_hpl($total['hpl']);*/  ?></td>
                        </tr>
                    </table>
                </div>
            </div><!-- /.box -->
            <div class="alert alert-warning no-print">
                <?php echo $this->lang->line('rule_not_changes_message'); ?>
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->


