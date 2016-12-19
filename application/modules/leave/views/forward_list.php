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
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title"><?php //echo $title_tab_header;           ?></h3>
                </div>
                <div class="box-body">
                    <?php $this->load->view('leave_header') ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <form action="<?php echo base_url(); ?>leave/leave_forward/bulkAction" method="post" >
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $title_tab; ?></h3>                 
                    </div>
                    <div class="box-header with-border">
                        <div class="row">
                            <div class="col-xs-2">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('bulk_action'); ?> </label>
                            </div>
                            <div class="col-xs-3">
                                <select name="bultselect" id="bultselect"  class="form-control">
                                    <option value="" > -- <?php echo $this->lang->line('leave_select'); ?>-- </option>
                                    <option value="1"><?php echo $this->lang->line('leave_session') ?></option>
                                    <option value="2"><?php echo $this->lang->line('leave_may_not_session') ?></option>
                                </select>
                                <?php echo form_error('bultselect'); ?>
                            </div>
                            <div class="col-xs-3 bulk_action">
                                <button type="submit" class="btn btn-block btn-success"><?php echo $this->lang->line('bulk_action'); ?></button>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <?php echo $this->session->flashdata('message'); ?>
                        <table id="leave_tbl" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width='5%'><input type="checkbox" id="selectall"/></th>
                                    <th width='25%' style="display:none"><?php echo "Created Date" ?></th>
                                    <th width='25%'><?php echo $this->lang->line('leave_emp_name') . '/' . $this->lang->line('leave_emp_designation'); ?></th>
                                    <th width="10%"><?php echo $this->lang->line('leave_reason'); ?></th>
                                    <th width="10%"><?php echo $this->lang->line('leave_type'); ?></th>
                                    <th width="10%">आवेदन दिनांक</th>
                                    <th width="10%"><?php echo $this->lang->line('leave_days'); ?></th>
                                    <th width="10%"><?php echo $this->lang->line('leave_start_date'); ?></th>
                                    <th width="10%"><?php echo $this->lang->line('end_date'); ?></th>
                                    <th width="15%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $r = 0;
                                $i = 1;
                                //pre($under_employee_lists);
                                $userder_ids = array();
                                if (isset($under_employee_lists) && !empty($under_employee_lists)) {
                                    foreach ($under_employee_lists as $uemployees) {
                                        $userder_ids[] = $uemployees->emp_id;
                                    }
                                }
                                   //pre($userder_ids);
                                    foreach ($details_leave as $leave) {
                                        if(checkUserrole() == 1 || checkUserrole() == 4 ) {  ?>
                                            <tr>
                                                <td><input type="checkbox" class="case" name="leave_ids[]" value="<?php echo $leave->emp_leave_movement_id ?>"/></td>
                                                <td style="display:none"><?php echo $leave->emp_leave_create_date ?></td>
                                                <td><a href="<?php echo base_url('leave')."/leave_details/".$leave->emp_id ?>" data-original-title="<?php echo get_employee_gender($leave->emp_id, false).' ' .$leave->emp_full_name ?>"  data-toggle="tooltip"><?php echo get_employee_gender($leave->emp_id).' ' .$leave->emp_full_name_hi  . '</a>/' . getemployeeRole($leave->role_id); ?></td>
                                                <td><?php echo $leave->emp_leave_reason ?></td>
                                                <td><?php echo leaveType($leave->emp_leave_type, true) ?></td>
                                                <td><?php echo get_date_formate($leave->emp_leave_create_date); ?></td>
                                                <td><?php echo $leave->emp_leave_no_of_days; 
                                                if (!empty($leave->emp_leave_half_type)) { ?>
                                                    <span data-toggle="tooltip" class="btn btn-info" data-original-title="<?php echo $leave->emp_leave_half_type == 'FH' ? $this->lang->line('first_half') : $this->lang->line('second_half'); ?>">i</span>
                                                <?php } ?>
                                                </td>
												
                                                <td><?php echo get_date_formate($leave->emp_leave_date); ?></td>
                                                <td><?php echo get_date_formate($leave->emp_leave_end_date); ?></td>
                                                <td>
                                                    <div class="btn-group" >
                                                        <a href="<?php echo base_url(); ?>leave/leave_forward/forword_leave/<?php echo $leave->emp_leave_movement_id; ?>" class="btn  btn-twitter" onclick="return confirm('Are you sure?');"><?php echo $this->lang->line('leave_session'); ?></a>
                                                        <button type="button" class="btn btn-danger btndeny" name="btndeny" data-leaveid="<?php echo $leave->emp_leave_movement_id; ?>" data-toggle="modal" data-target="#denyModal"><?php echo $this->lang->line('leave_may_not_session') ?></button>


                                                    </div>
                                                </td>
                                            </tr>
                                                <?php
                                        } else {
                                       //pre($leave->emp_id);
                                            if (in_array($leave->emp_id, $userder_ids)) {

                                                ?>
                                                <tr>
                                                    <td><input type="checkbox" class="case" name="leave_ids[]" value="<?php echo $leave->emp_leave_movement_id ?>"/></td>
                                                    <td style="display:none"><?php echo $leave->emp_leave_create_date ?></td>
                                                    <td><a href="<?php echo base_url('leave')."/leave_details/".$leave->emp_id ?>" data-original-title="<?php echo get_employee_gender($leave->emp_id, false).' ' .$leave->emp_full_name ?>"  data-toggle="tooltip"><?php echo get_employee_gender($leave->emp_id).' ' .$leave->emp_full_name_hi  . '</a>/' . getemployeeRole($leave->role_id); ?></td>
                                                    <td><?php echo $leave->emp_leave_reason ?></td>
                                                    <td><?php echo leaveType($leave->emp_leave_type, true) ?></td>
													<td><?php echo get_date_formate($leave->emp_leave_create_date); ?></td>
                                                    <td><?php echo $leave->emp_leave_no_of_days; ?></td>
                                                    <td><?php echo get_date_formate($leave->emp_leave_date); ?></td>
                                                    <td><?php echo get_date_formate($leave->emp_leave_end_date); ?></td>
                                                    <td>
                                                        <div class="btn-group" >
                                                            <a href="<?php echo base_url(); ?>leave/leave_forward/forword_leave/<?php echo $leave->emp_leave_movement_id; ?>" class="btn  btn-twitter" onclick="return confirm('Are you sure?');"><?php echo $this->lang->line('leave_session'); ?></a>
                                                            <button type="button" class="btn btn-danger btndeny" name="btndeny" data-leaveid="<?php echo $leave->emp_leave_movement_id; ?>" data-toggle="modal" data-target="#denyModal"><?php echo $this->lang->line('leave_may_not_session') ?></button>
                                                            <?php if($leave->medical_files !=  '') { ?>
                                                                <a href="<?php echo base_url(); ?>uploads/medical_files/<?php echo $leave->medical_files; ?>" target="_blank">Certificate</a>
                                                            <?php } ?>

                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            $i++;
                                            $r++;
                                        }
                                    }
                                
                                ?>
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </form>
            </div><!-- /.box -->
        </div>
    </div>
    <!-- /.row --><!-- Main row -->
</section><!-- /.content -->

<!-- Modal -->
<div class="modal fade" id="denyModal" tabindex="-1" role="dialog" aria-labelledby="denyModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('leave_deny_reson'); ?></h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url(); ?>leave/leave_forward/deny" accept-charset="UTF-8" role="form" class="form-signin" method="post" id="aer">
                    <div class="modal-body">
                        <input type="hidden" name="leaveID" id="leaveID" value="">
                        <label><?php echo $this->lang->line('leave_reason'); ?></label>
                        <textarea name="deny_reson" class="form-control" required=""></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="btndeny">Save changes</button>
                    </div>
                </form>
            </div>      
        </div>
    </div>
</div>

<script type="text/javascript">
    function is_delete() {
        var res = confirm('<?php echo $this->lang->line("delete_confirm_message"); ?>');
        if (res === false) {
            return false;
        }
    }

</script>
