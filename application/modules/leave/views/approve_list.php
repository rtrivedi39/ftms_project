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
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title"><?php //echo $title_tab_header;     ?></h3>
                </div>
                <div class="box-body">
                    <?php $this->load->view('leave_header') ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Your Page Content Here -->
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <form action="<?php echo base_url(); ?>leave/leave_approve/bulkAction" method="post" >
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
                                    <option value="1"><?php echo $this->lang->line('leave_approve') ?></option>
                                    <option value="2"><?php echo $this->lang->line('leave_deny') ?></option>
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
                                    <th width='25%'><?php echo $this->lang->line('leave_emp_name') . '/' . $this->lang->line('leave_emp_designation'); ?></th>
                                    <th width="10%"><?php echo $this->lang->line('leave_reason'); ?></th>
                                    <th width='25%'><?php echo "आवेदन दिनांक" ?></th>
                                    <th width="10%"><?php echo $this->lang->line('leave_type'); ?></th>
                                    <th width="10%"><?php echo $this->lang->line('leave_days'); ?></th>
                                    <th width="10%"><?php echo $this->lang->line('leave_start_date'); ?></th>
                                    <th width="10%"><?php echo $this->lang->line('end_date'); ?></th>
                                    <th width="10%"><?php echo $this->lang->line('leave_status'); ?></th>
                                    <th width="15%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php  $i = 1;
                               //pre($details_leave);
                                foreach ($details_leave as $key => $leave) { ?>
									<tr>
                                        <td><input type="checkbox" class="case" name="leave_ids[]" value="<?php echo $leave->emp_leave_movement_id ?>"/></td>
                                        <td><a href="<?php echo base_url('leave')."/leave_details/".$leave->emp_id ?>" data-original-title="<?php echo get_employee_gender($leave->emp_id, false).' ' .$leave->emp_full_name ?>"  data-toggle="tooltip"><?php echo get_employee_gender($leave->emp_id).' '.$leave->emp_full_name_hi . '</a>/' . getemployeeRole($leave->role_id); ?></td>
                                        <td><?php echo $leave->emp_leave_reason ?></td>
                                        <td><?php echo get_date_formate($leave->emp_leave_create_date); ?></td>
                                        <td><?php echo leaveType($leave->emp_leave_type, true) ?></td>
                                        <td><?php echo $leave->emp_leave_no_of_days; ?></td>
                                        <td><?php echo get_date_formate($leave->emp_leave_date); ?></td>
                                        <td><?php echo get_date_formate($leave->emp_leave_end_date); ?></td>
                                        <td><?php echo setForwordMessage($leave->emp_leave_forword_type); ?> <br/> <label class="label-waring label"><?php echo $leave->emp_leave_forword_emp_id != 0 ? getemployeeName($leave->emp_leave_forword_emp_id, true) : 'N/A'; ?></label>  </td>
                                        <td>
                                            <div class="btn-group" >
                                                <!--<a href="<?php echo base_url(); ?>leave/leave_approve/approve/<?php echo $leave->emp_leave_movement_id; ?>" class="btn  btn-twitter" onclick="return confirm('Are you sure?');"><?php echo $this->lang->line('leave_approve') ?></a> -->
                                                <button type="button" class="btn btn-success btn-block btnapprove" name="btnapprove" data-empid="<?php echo $leave->emp_id; ?>" data-leaveid="<?php echo $leave->emp_leave_movement_id; ?>" data-toggle="modal" data-target="#approveModal"><?php echo $this->lang->line('leave_approve') ?></button>
                                                <button type="button" class="btn btn-danger btn-block btndeny" name="btndeny" data-empid="<?php echo $leave->emp_id; ?>" data-leaveid="<?php echo $leave->emp_leave_movement_id; ?>" data-toggle="modal" data-target="#denyModal"><?php echo $this->lang->line('leave_deny') ?></button>
                                                 <?php if($leave->medical_files !=  '') { ?>
                                                    <a href="<?php echo base_url(); ?>uploads/medical_files/<?php echo $leave->medical_files; ?>" target="_blank">Certificate</a>
                                                <?php } ?>
                                            </div>
                                        </td>
                                    </tr>

                                <?php  $i++; } ?>
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </form>
            </div><!-- /.box -->
        </div>
    </div><!-- /.row -->
    <!-- Main row -->
</section><!-- /.content -->

<!-- Modal approve -->
<div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="approveModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">अवकाश स्वीकृत करें</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url(); ?>leave/leave_approve/approve" accept-charset="UTF-8" role="form" class="form-signin" method="post" id="aer">
                    <div class="modal-body">
					<h3>बचे हुए अवकाश</h3>
					<div class="user_leave_details"></div>
						<input type="hidden" name="leaveID" id="leaveID" class="leaveID" value="">
                        <label>अवकाश स्वीकृति का कारण</label>
                        <textarea name="approve_reson" class="form-control"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">रद्द</button>
                        <button type="submit" class="btn btn-primary" name="btnapprove">जमा करें</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div><!-- Modal deny-->
<div class="modal fade" id="denyModal" tabindex="-1" role="dialog" aria-labelledby="denyModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">अवकाश अस्वीकृत  करें</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url(); ?>leave/leave_approve/deny" accept-charset="UTF-8" role="form" class="form-signin" method="post" id="aer">
                    <div class="modal-body">
					<h3>बचे हुए अवकाश</h3>
						<div class="user_leave_details"></div>
                        <input type="hidden" name="leaveID" id="leaveID" class="leaveID" value="">
                        <label>अवकाश अस्वीकृति का कारण</label>
                        <textarea name="deny_reson" class="form-control" required=""></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">रद्द</button>
                        <button type="submit" class="btn btn-primary" name="btndeny">जमा करे</button>
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
