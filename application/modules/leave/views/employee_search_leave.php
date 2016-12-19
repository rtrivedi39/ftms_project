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
    <!-- Small boxes (Start box) -->

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><?php echo $title_tab; ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">                    
                    <form method="post" action="<?php echo base_url(); ?>leave/leave_approve/employeeLeave">
                        <div class="row col-xs-6">
                            <div class="col-xs-3">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('search_leave_type'); ?> </label>
                            </div>
                            <div class="col-xs-3">
                                <?php $leavesearch = array('User ID', 'Name', 'Mobile Number'); ?>
                                <select class="form-control" name="search_type" id="search_type"  >
                                    <option value="" > -- <?php echo $this->lang->line('leave_select'); ?>-- </option>
                                    <?php
                                    foreach ($leavesearch as $search) {
                                        ?>
                                        <option><?php echo $search; ?></option>
                                        <?php
                                    }
                                    ?>

                                </select>
                            </div>
                            <div class="col-xs-3">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('search_value'); ?> </label>
                            </div>
                            <div class="col-xs-3">
                                <input type="text"  name="seach_value" id="seach_value" autocomplete="off"  class="form-control">
                            </div>

                        </div>
                        <div class="col-xs-1 bulk_action">
                            <button type="submit" class="btn btn-block btn-success"><?php echo $this->lang->line('leave_emp_search'); ?></button>
                        </div>
                        <div class="col-xs-3">
                            <div class="col-xs-12">
                                <a href="<?php echo base_url(); ?>leave/employee_list" class="btn btn-block btn-info" ><?php echo $this->lang->line('view_all_employee'); ?></a>
                            </div>
                            <div class="col-xs-6">
                                <?php /* if (checkUserrole() == 4 OR (in_array(checkUserrole(),array(5,6,7,8,11,14)) )){ ?>
                                  <a href="<?php echo base_url(); ?>leave/approve_deny"  class="btn btn-block btn-warning" ><?php echo $this->lang->line('view_all_pending_approvel'); ?></a>
                                  <?php } */ ?>
                            </div>
                        </div>
                        <div class="col-xs-2">
                              <a href="<?php echo base_url(); ?>leave/onbehalf_applied" class="btn btn-block btn-info" ><?php echo $this->lang->line('list_of_applied_leave'); ?></a>
                        </div>

                    </form>            

                    <?php if (!empty($under_employees)) { ?>

                        <div class="col-md-12">
                            <label><?php echo $this->lang->line('user_information_remaining'); ?></label>
                            <table class="leave_table" id="example1" >
                                <tr>
                                    <th><?php echo $this->lang->line('userid'); ?></th>
                                    <th><?php echo $this->lang->line('leave_emp_name'); ?></th>
                                    <th><?php echo $this->lang->line('leave_emp_email'); ?></th>
                                    <th><?php echo $this->lang->line('leave_emp_mobile'); ?></th>
                                    <th><?php echo $this->lang->line('casual_leave'); ?></th>
                                    <th><?php echo $this->lang->line('optional_leave'); ?></th>
                                    <th><?php echo $this->lang->line('earned_leave'); ?></th>
                                    <th><?php echo $this->lang->line('half_pay_leave'); ?></th>
                                    <th><?php echo $this->lang->line('leave_emp_designation'); ?></th>
                                    <th><?php echo $this->lang->line('leave_designation'); ?></th>
                                </tr>
                                <?php foreach ($under_employees as $userleaves) { ?>
                                    <tr>
                                        <td><?php echo $userleaves->emp_unique_id; ?></td>
                                        <td><span data-original-title="<?php echo get_employee_gender($userleaves->emp_id, false).' ' .$userleaves->emp_full_name ?>"  data-toggle="tooltip"><a href="<?php echo base_url('leave')."/leave_details/".$userleaves->emp_id ?>"><?php echo get_employee_gender($userleaves->emp_id).' ' .$userleaves->emp_full_name_hi; ?></a></span></td>
                                        <td><?php echo $userleaves->emp_email; ?></td>
                                        <td><?php echo $userleaves->emp_mobile_number; ?></td>
                                        <td><?php echo $userleaves->cl_leave; ?></td>
                                        <td><?php echo $userleaves->ol_leave; ?></td>
                                        <td><?php echo calculate_el($userleaves->el_leave); ?></td>
                                        <td><?php echo $userleaves->hpl_leave.' ('.calculate_hpl($userleaves->hpl_leave).')'; ?></td>
                                        <td><?php echo getemployeeRole($userleaves->role_id); ?></td>
                                        <td><a href="<?php echo base_url(); ?>leave/add_leave/<?php echo $userleaves->emp_id ?>"><?php echo $this->lang->line('emp_leave_applyed'); ?></a></td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                    <?php } else if (!empty($userleaves)) { ?>

                        <div class="col-md-12">
                            <label><?php echo $this->lang->line('user_information_remaining'); ?></label>
                            <table class="leave_table" >
                                <tr>
                                    <th><?php echo $this->lang->line('userid'); ?></th>
                                    <th><?php echo $this->lang->line('leave_emp_name'); ?></th>
                                    <th><?php echo $this->lang->line('leave_emp_email'); ?></th>
                                    <th><?php echo $this->lang->line('leave_emp_mobile'); ?></th>
                                    <th><?php echo $this->lang->line('casual_leave'); ?></th>
                                    <th><?php echo $this->lang->line('optional_leave'); ?></th>
                                    <th><?php echo $this->lang->line('earned_leave'); ?></th>
                                    <th><?php echo $this->lang->line('half_pay_leave'); ?></th>
                                    <th><?php echo $this->lang->line('leave_emp_designation'); ?></th>
                                    <th><?php echo $this->lang->line('leave_designation'); ?></th>
                                </tr>
                                <tr>
                                    <td><?php echo $userleaves->emp_unique_id; ?></td>
                                    <td><span data-original-title="<?php echo get_employee_gender($userleaves->emp_id, false).' ' .$userleaves->emp_full_name ?>"  data-toggle="tooltip"><a href="<?php echo base_url('leave')."/leave_details/".$userleaves->emp_id ?>"><?php echo get_employee_gender($userleaves->emp_id).' ' .$userleaves->emp_full_name_hi; ?></a></span></td>
                                    <td><?php echo $userleaves->emp_email; ?></td>
                                    <td><?php echo $userleaves->emp_mobile_number; ?></td>
                                    <td><?php echo $userleaves->cl_leave; ?></td>
                                    <td><?php echo $userleaves->ol_leave; ?></td>
                                    <td><?php echo $userleaves->el_leave; ?></td>
                                    <td><?php echo $userleaves->ol_leave; ?></td>
                                    <td><?php echo getemployeeRole($userleaves->role_id); ?></td>
                                    <td><a href="<?php echo base_url(); ?>leave/add_leave/<?php echo $userleaves->emp_id ?>"><?php echo $this->lang->line('emp_leave_applyed'); ?></a></td>
                                </tr>
                            </table>
                        </div>
                        <?php
                    } else if (isset($userleaves) && count(($userleaves) == 0)) {
                        ?> 
                        <div class="row">
                            <div class="col-md-12">
                                <div ><?php echo $this->lang->line('leave_record_not_found'); ?></div>
                            </div>
                        </div>
                    <?php }
                    ?>

                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div><!-- /.row -->
    <!-- Main row -->
</section><!-- /.content -->


