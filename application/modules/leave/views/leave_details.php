<?php
$emp_details= get_list(EMPLOYEES,null,array('emp_id'=>$this->session->userdata("emp_id")));
?>
<section class="content-header">
    <h1>
        <?php echo $title ?>(2015)

    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">Leave Details</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Start box) -->
  
    <div class="row">
        <div class="col-md-12">
            <?php echo $this->session->flashdata('message'); ?>
            <div class="box box-info">
                <div class="box-header">
                    <i class="fa fa-inbox"></i><h3 class="box-title"><?php echo $title_tab; ?> 
                    <b> (<?php echo getemployeeName($id,true) //."/ ". getemployeeRole($id); ?>)</b>(2015)</h3>
                <div class="pull-right box-tools"> 
					<button class="btn btn-warning" onclick="goBack()">पिछले पेज में वापस जायें</button>
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
                            <th><?php echo $this->lang->line('leave_on_approve_date') ?></th>
                            <th><?php echo $this->lang->line('onbehalf') ?></th>
                            <th><?php echo $this->lang->line('print') ?></th>
                        </tr>
                        <?php
                        $r = 1;
                        $total = array(
                            'cl' => 0,
                            'ol' => 0,
                            'el' => 0,
                            'hpl' => 0,
                        );                
                        //pr($leaves_pending);
                        if (isset($leave_detail_lists)) {
                            foreach ($leave_detail_lists as $row) {
                                ?>
                                <tr class="bg-<?php
                                    switch ($row->emp_leave_type) {
                                        case 'cl':
                                            echo "info";
                                            $total['cl'] = $row->emp_leave_approval_type ==  1 ? $row->emp_leave_no_of_days + $total['cl'] : $total['cl'] ;
                                            break;
                                        case 'ol':
                                            echo "success";
                                            $total['ol'] = $row->emp_leave_approval_type ==  1 ? $row->emp_leave_no_of_days + $total['ol'] : $total['ol'] ;
                                            break;
                                        case 'el':
                                            echo "warning";
                                            $total['el'] = $row->emp_leave_approval_type ==  1 ? $row->emp_leave_no_of_days + $total['el'] : $total['el'] ;
                                            break;
                                        case 'hpl':
                                            echo "danger";
                                            $total['hpl'] = $row->emp_leave_approval_type ==  1 ? ($row->emp_leave_no_of_days * 2)+ $total['hpl'] : $total['hpl'] ;
                                            break;
                                        default:
                                            echo "transparent";
                                            break;
                                    }
                                    ?>">
                                    <td><?php echo $r; ?>.</td>
                                    <td><?php echo!empty($row->emp_leave_type) ? leaveType($row->emp_leave_type, true) : '-' ?></td>
                                    <td><?php echo ($row->emp_leave_date != '1970-01-01') ? get_date_formate($row->emp_leave_date) : '-' ?> </td>
                                    <td><?php echo ($row->emp_leave_end_date != '1970-01-01') ? get_date_formate($row->emp_leave_end_date) : '-' ?> </td>
                                    <td><?php echo!empty($row->emp_leave_no_of_days) ? 
                                            $row->emp_leave_type == 'hpl' ? ($row->emp_leave_no_of_days * 2) .' ('.$row->emp_leave_no_of_days.')' : $row->emp_leave_no_of_days : 
                                            '-' ?></td>
                                    <td><?php echo!empty($row->emp_leave_reason) ? $row->emp_leave_reason : '-' ?></td>
                                    <td><?php echo $row->emp_leave_is_HQ == 1 ? 
                                        $this->lang->line('yes').'('.get_date_formate($row->emp_leave_HQ_start_date).'-'.get_date_formate($row->emp_leave_HQ_end_date).')' : 
                                        $this->lang->line('no'); ?>
                                    <?php if($row->leave_message != '' && $row->emp_leave_is_HQ == 1){ ?>
                                            <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="left" title="<?php echo $row->leave_message; ?>">i</button>
                                        <?php } ?>
                                    </td>
                                    <td><?php echo!empty($row->emp_leave_half_type) ? $row->emp_leave_half_type == 'FH' ? $this->lang->line('first_half') : $this->lang->line('second_half') : '-' ?></td>
                                  <td> <?php /* <label class="label label-info"><?php echo leave_status(true, $row->leave_status); ?></label> */ ?>
                                    <?php 
                                        if ($row->emp_leave_approval_type == 0) {
                                            if ($row->emp_leave_forword_type == 0) {
                                                echo '<label class="label label-warning">' . $this->lang->line('leave_status_pending') . '</label>';
                                            } else if (($row->emp_leave_forword_type == 1) OR ( $row->emp_leave_forword_type == 2)) {
                                                echo '<label class="label label-warning">' . $this->lang->line('leave_status_on_approval') . '</label>';
                                            } else if ($row->emp_leave_forword_type == 3) {
                                                echo '<label class="label label-warning">' . $this->lang->line('leave_cancel') . '</label>';
                                            }
                                        } else if ($row->emp_leave_approval_type != 0) {
                                            if ($row->emp_leave_approval_type == 1) {
                                                echo '<label class="label label-success">' . $this->lang->line('leave_status_approve') . '</label>';
                                            } else if ($row->emp_leave_approval_type == 2) {
                                                echo '<label class="label label-danger">' . $this->lang->line('leave_status_deny') . '</label>';
                                            } else if ($row->emp_leave_approval_type == 3) {
                                                echo '<label class="label label-warning">' . $this->lang->line('leave_cancel') . '</label>';
                                            }
                                        }
                                        ?> </td>                                  
                                    <td>
                                        <?php if ($row->emp_leave_approval_type == 0) {
                                            if ($row->emp_leave_forword_type == 0) { ?>
                                                <a href="<?php echo base_url(); ?>leave/cancel/<?php echo $row->emp_leave_movement_id; ?>" class="text-danger" onClick="return confirm('Are you sure?');"><span class="fa fa-close"></span> <?php echo $this->lang->line('cancel_leave') ?></a>
                                                <?php } else if ($row->emp_leave_forword_type == 1) { ?>
                                                    <label class="label label-info"><?php echo getemployeeName($row->emp_leave_forword_emp_id); ?></label>
                                                    <label class="label label-success"><?php echo $this->lang->line('leave_forworeded_option'); ?></label>
                                                <?php } else if ($row->emp_leave_forword_type == 2) { ?>
                                                    <label class="label label-info"><?php echo getemployeeName($row->emp_leave_forword_emp_id); ?></label>
                                                    <label class="label label-danger"><?php echo $this->lang->line('leave_not_forworeded_option'); ?></label>
                                                <?php } 
                                        }  else if ($row->emp_leave_approval_type != 0){
                                            if ($row->emp_leave_approval_type == 1) { ?>
                                                <label class="label label-info"><?php echo getemployeeName($row->emp_leave_approval_emp_id); ?></label>
                                                <label class="label label-success"><?php echo $this->lang->line('leave_status_approve'); ?></label>
                                           <?php  } else if ($row->emp_leave_approval_type == 2) { ?>
                                                <label class="label label-info"><?php echo getemployeeName($row->emp_leave_approval_emp_id); ?></label>
                                                <label class="label label-danger"><?php echo $this->lang->line('leave_not_forworeded_option'); ?></label>
                                           <?php  } 
                                        } ?>
                                    </td>
                                    <td><?php echo ($row->emp_leave_forword_date != '0000-00-00 00:00:00') ? get_date_formate($row->emp_leave_forword_date) : '-' ?> </td>
                                    <td><?php echo!empty($row->on_behalf_leave) ? $row->on_behalf_leave != $this->session->userdata('emp_id') ? getemployeeName($row->on_behalf_leave) : $this->lang->line('self') : '-' ?></td>
                                    <td>
									<div class="btn-group ">
										<a href="<?php echo base_url(); ?>leave/print/<?php echo $row->emp_leave_movement_id; ?>" class="btn btn-primary btn-block"><span class="fa fa-print"></span> <?php echo $this->lang->line('print_button') ?></a>
										<?php if ((in_array(7, explode(',',$emp_details[0]['emp_section_id'])) && checkUserrole() == 8) || checkUserrole() == 1){?>
											<a href="<?php echo base_url(); ?>leave/approve_deny/cancel/<?php echo $row->emp_leave_movement_id; ?>" class="btn  btn-twitter btn-block<?php
											if ($row->emp_leave_approval_type == 3 OR $row->emp_leave_approval_type == 2) {
												echo "disabled";
											}
											$confirm_msg = $row->emp_full_name_hi . '/' . getemployeeRole($row->role_id).' का '.get_date_formate($row->emp_leave_date, 'd.m.Y').' से '.get_date_formate($row->emp_leave_end_date, 'd.m.Y') .' तक का '.leaveType($row->emp_leave_type, true);
											?>" onclick="return confirm('आप  <?php echo $confirm_msg; ?>  रद्द करने जा रहे है| ');"> रद्द</a>
										
											<a href="<?php echo base_url(); ?>leave/modify_leave/<?php echo $row->emp_leave_movement_id; ?>" class="btn btn-twitter btn-block<?php
											   if (($row->emp_leave_approval_type == 3) || ($row->emp_leave_approval_type == 2)) {
												   echo "disabled";
											   }
												?>" onclick="return confirm('आप  <?php echo $confirm_msg; ?>  बदलने  जा रहे है| ');">बदले</a>
										<?php } ?>
									 </div>
                                     <?php if($row->medical_files !=  '') { ?>
                                            <a href="<?php echo base_url(); ?>uploads/medical_files/<?php echo $row->medical_files; ?>" target="_blank">Certificate</a>
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
                    <div class="col-md-6">
                         <?php $leaves = $this->leave_model->getLeaves($this->uri->segment(3));  ?> 
                        <h4><?php echo $this->lang->line('total_leaves'); ?></h4>
                        <table>
                            <tr>
                                <th colspan="2"><?php echo leaveType('cl', true); ?></th>
                                <th colspan="2"><?php echo leaveType('ol', true); ?></th>
                                <th colspan="2"><?php echo leaveType('el', true); ?></th>
                                <th colspan="2"><?php echo leaveType('hpl', true); ?> (<?php echo leaveType('comm', true); ?>)</th>
                            </tr>
                            <tr> <td>लिए हुए</td><td>बाकी</td> <td>लिए हुए</td><td>बाकी</td> <td>लिए हुए</td><td>बाकी</td> <td>लिए हुए</td><td>बाकी</td></tr>
                            <tr>
                                <td><?php echo $total['cl']; ?> </td> <td> <?php echo $leaves->cl_leave; ?></td>
                                <td><?php echo $total['ol']; ?> </td> <td> <?php echo $leaves->ol_leave; ?></td>
                                <td><?php echo $total['el']; ?> </td> <td> <?php echo calculate_el($leaves->el_leave); ?></td>
                                <td><?php echo $total['hpl']; ?> </td> <td> <?php echo $leaves->hpl_leave.' ('.  calculate_hpl($leaves->hpl_leave).')'; ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        
                    </div>
                </div>
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
   
</section><!-- /.content -->


