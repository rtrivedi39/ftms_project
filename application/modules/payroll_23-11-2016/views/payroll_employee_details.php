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
					  <div class="box-tools pull-right">
                      <button class="btn  btn-warning" title="Back" onclick="goBack()">पिछले पेज में वापस जायें</button>
                    </div>
                </div>
                <div class="box-body">
                    <table id="leave_employee" class="table table-bordered table-striped display">
                        <thead>
                            <tr>
                                <th width='5%'>SNo.</th>
                                <th width="15%"><?php echo $this->lang->line('emp_unique_id'); ?></th>
                                <th width='15%'><?php echo $this->lang->line('emp_name'); ?></th>
                              
                                <th width="10%"><?php echo $this->lang->line('emp_mobile_no'); ?></th>
                                <th width="15%"><?php echo $this->lang->line('emp_email'); ?></th>
                                  <th width="15%"><?php echo $this->lang->line('emp_house_no'); ?></th>
                                    <th width="15%"><?php echo "हाउस टाइप "  ?></th>
                                     <th width="15%"><?php echo $this->lang->line('pay_arrdhar_card'); ?></th>
                                   <th width="10%"><?php echo "पेन कार्ड नंबर " ?></th>
                                    <th width="10%"><?php echo "जी पी फ / डी पी फ कोड " ?></th>
                                <th width="10%"><?php echo $this->lang->line('view'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
							$userrole = checkUserrole();
							$crnt_emp_id = 	$this->session->userdata('emp_id');
							$emp_section = getusersection($crnt_emp_id);
							//pre($details_leave);
                            foreach ($details_leave as $key => $leave) { ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo get_tr_unicode($leave->emp_unique_id); ?></td>
                                    <td><?php echo $leave->emp_full_name_hi ; ?></td>
                                    <td><?php echo $leave->emp_mobile_number; ?></td>
                                    <td><?php echo $leave->emp_email; ?></td>
                                    <td><?php echo $leave->emp_house_no; ?></td>
                                    <td><?php echo $leave->emp_house_type; ?></td>
                                    <td><?php echo $leave->emp_adhar_card_no; ?></td>
                                    <td><?php echo  $leave->emp_pen_no;?></td>
                                    <td><?php echo  $leave->emp_gpf_dpf_code;?></td>
                                    <td><a href="<?php echo base_url(); ?>payroll/adddetails/<?php echo $leave->emp_unique_id ?>"><?php echo "बदले" ?></a>
								</td>
                                </tr>
                                <?php $i++; }
                            ?>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div><!-- /.row -->
    <!-- Main row -->
</section><!-- /.content -->


