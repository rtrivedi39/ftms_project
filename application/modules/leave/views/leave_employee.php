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
			<?php echo $this->session->flashdata('message'); ?>
                <div class="box-header">
                    <h3 class="box-title"><?php echo $title_tab; ?></h3>
                </div>
                <div class="box-body">
                    <table id="leave_employee" class="table table-bordered table-striped display">
                        <thead>
                            <tr>
                                <th width='5%'>SNo.</th>
                                <th width="15%"><?php echo $this->lang->line('emp_unique_id'); ?></th>
                                <th width='15%'><?php echo $this->lang->line('leave_emp_name'); ?></th>
                                <th width='10%'><?php echo $this->lang->line('leave_emp_designation'); ?></th>
                                <th width="10%"><?php echo $this->lang->line('emp_mobile_no'); ?></th>
                                <th width="15%"><?php echo $this->lang->line('leave_emp_email'); ?></th>
                                <th width="10%"><?php echo $this->lang->line('leave_cl'); ?></th>
                                <th width="10%"><?php echo $this->lang->line('leave_ol'); ?></th>
                                <th width="10%"><?php echo $this->lang->line('leave_el'); ?></th>
                                <th width="10%"><?php echo $this->lang->line('leave_hpl'); ?>(Comm.)</th>
                                <th width="10%"><?php echo $this->lang->line('view'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
							$userrole = checkUserrole();
							$crnt_emp_id = 	$this->session->userdata('emp_id');
							$emp_section = getusersection($crnt_emp_id);
                            foreach ($details_leave as $key => $leave) {
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $leave->emp_unique_id; ?></td>
                                    <td><a href="<?php echo base_url('leave')."/leave_details/".$leave->emp_id ?>" data-original-title="<?php echo get_employee_gender($leave->emp_id, false).' ' .$leave->emp_full_name ?>"  data-toggle="tooltip"><?php echo get_employee_gender($leave->emp_id).' '.$leave->emp_full_name_hi . '</a>'; ?></td>
                                    <td><?php echo getemployeeRole($leave->role_id); ?></td>

                                    <td><?php echo $leave->emp_mobile_number; ?></td>
                                    <td><?php echo $leave->emp_email; ?></td>

                                    <td><?php echo $leave->cl_leave; ?></td>
                                    <td><?php echo $leave->ol_leave; ?></td>
                                    <td><?php echo calculate_el($leave->el_leave); ?></td>
                                    <td><?php echo $leave->hpl_leave.' ('.calculate_hpl($leave->hpl_leave).')'; ?></td>
                                    <td>
										<a href="<?php echo base_url(); ?>leave/leave_details/<?php echo $leave->emp_id ?>"><?php echo $this->lang->line('view'); ?></a>
										<?php if ((in_array(7, explode(',',$emp_section)) && $userrole == 8) || $userrole == 1 ){ ?>
											<a href="<?php echo base_url(); ?>leave/leave/manage_leave/<?php echo $leave->emp_id ?>"><?php echo $this->lang->line('edit'); ?></a>
										<?php }  ?>
									</td>
                                </tr>
                                <?php $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div><!-- /.row -->
    <!-- Main row -->
</section><!-- /.content -->


