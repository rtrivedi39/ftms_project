<?php $userrole = checkUserrole(); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo $title; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo $title; ?></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Your Page Content Here -->
    <!-- Small boxes (Stat box) -->

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-warning">
                 <?php echo $this->session->flashdata('message'); ?>
                <div class="box-header">
                    <h3 class="box-title"><?php echo $title_tab; ?></h3>
                </div>
                <div class="box-body">
                    <table id="leave_tbl" class="table table-bordered table-striped display">
                        <thead>
                            <tr>
                                <th width='5%'>SNo.</th>
                                <th width='25%' style="display:none"><?php echo "Created Date" ?></th>
                                <th width='15%'><?php echo $this->lang->line('leave_emp_name') . '/' . $this->lang->line('leave_emp_designation'); ?></th>
                                <th width="15%"><?php echo $this->lang->line('when_date'); ?></th>
								<th width="10%"><?php echo $this->lang->line('leave_type'); ?></th>
                                <th width="10%"><?php echo $this->lang->line('leave_reason'); ?></th>
                                <th width='10%'><?php echo $this->lang->line('leave_days'); ?></th>
                                <th width='10%'><?php echo $this->lang->line('leave_forworad_name'); ?></th>
                                <th width='10%'><?php echo $this->lang->line('leave_forworad_status'); ?></th>
                                <th width='10%'><?php echo $this->lang->line('leave_forworad_date'); ?></th>
                                <th width="10%"><?php echo $this->lang->line('leave_approve_date'); ?></th>
                                <th width="10%"><?php echo $this->lang->line('leave_status'); ?></th>
                                <th width="10%"><?php echo $this->lang->line('leave_action'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $r = 0;
                            $i = 1;
                            $userder_ids = array();
                           // if (isset($under_employee)) {
                                /*  foreach ($under_employee as $uemployees) {
                                  $userder_ids[] = $uemployees->under_emp_id;
                                  } */

                                //print_r($under_employee);
                                foreach ($details_leave as $key => $leave) {
                                    // if (in_array($leave->emp_id, $userder_ids)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td style="display:none"><?php echo $leave->emp_leave_create_date ?></td>
                                        <td><span data-original-title="<?php echo get_employee_gender($leave->emp_id, false).' ' .$leave->emp_full_name ?>"  data-toggle="tooltip"><a href="<?php echo base_url('leave')."/leave_details/".$leave->emp_id ?>"><?php echo get_employee_gender($leave->emp_id).' ' .$leave->emp_full_name_hi; ?></a>/ <?php echo getemployeeRole($leave->role_id); ?></span></td>
                                        <td><?php echo get_date_formate($leave->emp_leave_date, 'd.m.Y'); ?> to <?php echo get_date_formate($leave->emp_leave_end_date, 'd.m.Y'); ?></td>
                                        <td><?php echo leaveType($leave->emp_leave_type, true); ?></td>
										<td><?php echo $leave->emp_leave_reason ?></td><td><?php echo $leave->emp_leave_no_of_days; ?></td>
                                        <td><?php echo getemployeeName($leave->emp_leave_forword_emp_id);  ?></td>
                                        <td><?php echo setForwordMessage($leave->emp_leave_forword_type); ?></td>
                                        <td><?php echo get_date_formate($leave->emp_leave_forword_date); ?></td>
                                        <td><?php echo get_date_formate($leave->emp_leave_approvel_date); ?></td>

                                        <td><?php echo setApproveMessage($leave->emp_leave_approval_type) ?></td>
                                        <td>
                                            <div class="btn-group ">
                                                <a href="<?php echo base_url(); ?>leave/approve_deny/cancel/<?php echo $leave->emp_leave_movement_id; ?>" class="btn  btn-twitter <?php
                                                if ($leave->emp_leave_approval_type == 3 OR $leave->emp_leave_approval_type == 2) {
                                                    echo "disabled";
                                                }
												$confirm_msg = $leave->emp_full_name_hi . '/' . getemployeeRole($leave->role_id).' का '.get_date_formate($leave->emp_leave_date, 'd.m.Y').' से '.get_date_formate($leave->emp_leave_end_date, 'd.m.Y') .' तक का '.leaveType($leave->emp_leave_type, true);
                                                ?>" onclick="return confirm('आप  <?php echo $confirm_msg; ?>  रद्द करने जा रहे है| ');"> <?php echo $this->lang->line('leave_employee_cancel') ?></a>

                                            </div>
                                            <div class="btn-group ">
                                                <a href="<?php echo base_url(); ?>leave/modify_leave/<?php echo $leave->emp_leave_movement_id; ?>" class="btn btn-twitter <?php
                                                   if (($leave->emp_leave_approval_type == 3) || ($leave->emp_leave_approval_type == 2)) {
                                                       echo "disabled";
                                                   }
                                                    ?>" onclick="return confirm('आप  <?php echo $confirm_msg; ?>  बदलने  जा रहे है| ');">
                                                    <?php echo $this->lang->line('leave_employee_modify') ?></a>

                                            </div>
                                        </td>

                                    </tr>
                                    <?php
                                    //}
                                    $i++;
                                    $r++;
                                }
                            //}
                            ?>
                        </tbody>
                    </table>


                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div><!-- /.row -->
    <!-- Main row -->
</section><!-- /.content -->


