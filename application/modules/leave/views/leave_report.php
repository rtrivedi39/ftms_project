<style type="text/css" media="print">
  @page { size: landscape; }
</style>
<section class="content-header">
    <h1> <?php echo $title ?></h1>
    <ol class="breadcrumb">
         <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Leave</li>
    </ol>
</section>
<div class="pad margin no-print">
    <div class="box box-info">
        <div class="box-header">
            <h3><?php echo $this->lang->line('filter_title'); ?></h3>
        </div>
        <div class="box-body">
            <form action="<?php echo base_url() ?>leave/leave_report/reports" method="post"> 
                <div class="row">
                    <div class="col-md-3">
                        <label><?php echo $this->lang->line('from'); ?></label>
                        <input type="text" name="start_date" id="start_date" class="form-control" placeholder="dd-mm-yyyy" value="<?php echo isset($form_input['start_date']) ? $form_input['start_date'] : ''; ?>">
                        <?php echo form_error('start_date'); ?>
                    </div>
                    <div class="col-md-3">
                        <label><?php echo $this->lang->line('to'); ?></label>
                        <input type="text" name="end_date" id="end_date" class="form-control" placeholder="dd-mm-yyyy" value="<?php echo isset($form_input['end_date']) ? $form_input['end_date'] : ''; ?>">
                        <?php echo form_error('end_date'); ?>
                    </div>
                    <div class="col-md-3">
                        <label><?php echo $this->lang->line('user_id'); ?></label>
                        <input type="text" class="form-control" name="userid" id="userid" value="<?php echo isset($form_input['userid']) ? $form_input['userid'] : ''; ?>">
                        <?php echo form_error('userid'); ?>
                    </div>
                    <div class="col-md-3">
                        <label><?php echo $this->lang->line('leave_type'); ?></label>
                        <select class="form-control" name="leave_type" id="leave_type">
                            <option value="" > -- <?php echo $this->lang->line('leave_select'); ?>-- </option>
                            <option value="cl" <?php echo (isset($form_input['leave_type']) && $form_input['leave_type'] == 'cl') ? 'selected' : ''; ?>><?php echo $this->lang->line('casual_leave'); ?></option>
                            <option value="ol" <?php echo (isset($form_input['leave_type']) && $form_input['leave_type'] == 'ol') ? 'selected' : ''; ?>><?php echo $this->lang->line('optional_leave'); ?></option>
                            <option value="el" <?php echo (isset($form_input['leave_type']) && $form_input['leave_type'] == 'el') ? 'selected' : ''; ?>><?php echo $this->lang->line('earned_leave'); ?></option>
                            <option value="hpl"<?php echo (isset($form_input['leave_type']) && $form_input['leave_type'] == 'hpl') ? 'selected' : ''; ?>><?php echo $this->lang->line('half_pay_leave'); ?></option>
                            <option value="ot" <?php echo (isset($form_input['leave_type']) && $form_input['leave_type'] == 'ot') ? 'selected' : ''; ?>><?php echo $this->lang->line('official_tour'); ?></option>
                        </select>
                        <?php echo form_error('leave_type'); ?>
                    </div>
                </div>
                <br/>
               
                <br/>
                <div class="row">
                    <div class="col-md-12">
                        <a class="btn btn-primary" role="button" data-toggle="collapse" href="#advanceSearch" aria-expanded="false" aria-controls="collapseExample">
                            Advance search
                          </a>                        
                          <div class="collapse" id="advanceSearch">
                            <div class="well">
                                <label>Select section</label>
                                    <?php $section_list = get_list(SECTIONS, null, null); //pre($section_list);  ?>
                                    <div class="form-group">
                                        <?php $ln = 1;
                                        foreach ($section_list as $seck => $sections) { ?>
                                                <div style="padding:10px; display: inline-block;" title="<?php echo $sections['section_name_en']; ?>">
                                                    <input type="checkbox"  class="minimal" name="emp_section_id[]" value="<?php echo $sections['section_id']; ?>" />
                                                    <?php echo $sections['section_name_hi']; ?>(<?php echo $sections['section_short_name']; ?>)
                                                </div> 
                                            <?php $ln++;
                                        } ?>  
                                    </div>
                            </div>
                          </div>
                    </div>
                </div>
                <br/>
                 <div class="row">
                    <div class="col-md-3">
                        <button type="submit" name="btnsearch" value="btnsearch_all" class="btn btn-primary" ><?php echo $this->lang->line('button_search'); ?> </button>
                    </div>
                </div>
                <hr class="clearfix"/>
                  <div class="row">
                    <div class="col-md-12">
                        <button type="submit" name="btnsearch"  value="btnsearch_today" class="btn btn-primary">Today</button>
                        <button type="submit" name="btnsearch"  value="btnsearch_tomorrow" class="btn btn-primary">Yesterday</button>
                        <button type="submit" name="btnsearch"  value="btnsearch_thisweek" class="btn btn-info">This Week</button>
                        <button type="submit" name="btnsearch"  value="btnsearch_lastweek" class="btn btn-info">Last Week</button>
                        <button type="submit" name="btnsearch"  value="btnsearch_thismonth" class="btn btn-warning" >This Month</button>
                        <button type="submit" name="btnsearch"  value="btnsearch_lastmonth" class="btn btn-warning">Last Month</button>
                        <button type="submit" name="btnsearch"  value="btnsearch_thisyear" class="btn btn-success">This Year</button>
                        <button type="submit" name="btnsearch"  value="btnsearch_lastyear" class="btn btn-success">Last Year</button>
                    </div>
                </div> 
            </form>
        </div>
    </div>
</div>	
<!-- Main content -->
<?php if ($process) { ?>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <?php echo $this->session->flashdata('message'); ?>
                <div class="box box-info">
                    <div class="box-header">
                        <i class="fa fa-inbox"></i><h3 class="box-title"><?php echo $this->lang->line('view_report'); ?></h3>
                    </div><!-- /.box-header -->
                    <p><?php echo isset($form_input['start_date']) ? 'दिनांक '.$form_input['start_date'] : ''; ?>
                        <?php echo isset($form_input['end_date']) ? 'से दिनांक '.$form_input['end_date'].' तक' : ''; ?>
                        <?php echo isset($form_input['leave_type']) ? ' '.leaveType($form_input['leave_type'],true) : ''; ?> की रिपोर्ट|</p>
                    <div class="box-body no-padding">
                        <div class="no-print">
                            <button onclick="print_content()" class="btn btn-primary">Print this page</button>                            
                        </div>
                        <br/>	
                        <table width="100%">
                            <thead>
                                <tr>
                                    <th><?php echo $this->lang->line('sno'); ?></th>
                                    <th>Details</th>
                                    <th><?php echo $this->lang->line('leaves'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sn = 1; 
                                 $total = array(
                                    'cl' => 0,
                                    'ol' => 0,
                                    'el' => 0,
                                    'hpl' => 0,
                                );
                                if ($leave_reports) {
                                    foreach ($leave_reports as $row) {
                                        $user_details = get_user_details($row->emp_id); ?>
                                        <tr>
                                            <td><?php echo $sn; ?></td>
                                            <td>
                                                <?php echo $this->lang->line('unique_id'); ?> :- <b><?php echo $user_details[0]->emp_unique_id; ?></b><br/>
                                                <?php echo $this->lang->line('name'); ?> :- <b><?php echo $user_details[0]->emp_full_name_hi; ?></b><br/>
                                                <?php echo $this->lang->line('post'); ?> :- <b><?php echo $user_details[0]->emprole_name_hi; ?></b><br/>
                                                <?php echo $this->lang->line('mobile_no'); ?> :- <b><?php echo $user_details[0]->emp_mobile_number; ?></b><br/>
                                                <?php echo $this->lang->line('email'); ?> :- <b><?php echo $user_details[0]->emp_email; ?></b><br/>
                                            </td>
                                            <td> 
                                                <table width="100%">
                                                    <tr>
                                                        <th>Leave type</th>
                                                        <th>Days</th>
                                                        <th>Date</th>
                                                        <th>Reason</th>
                                                        <th>Remark</th>
                                                    </tr> 
                                                    <?php
                                                    $resultas = $this->leave_model->get_reports($form_input['start_date'], $form_input['end_date'], $row->emp_id, $form_input['leave_type'], '',false);
                                                    if ($resultas != '') {
                                                        $total = array(
                                                            'cl' => 0,
                                                            'ol' => 0,
                                                            'el' => 0,
                                                            'hpl' => 0,
                                                        );
                                                        foreach ($resultas as $rowas) { 
                                                            
                                                            switch ($rowas->emp_leave_type) {
                                                                case 'cl':
                                                                    $total['cl'] = $rowas->emp_leave_approval_type ==  1 ? $rowas->emp_leave_no_of_days + $total['cl'] : $total['cl'] ;
                                                                    break;
                                                                case 'ol':
                                                                    $total['ol'] = $rowas->emp_leave_approval_type ==  1 ? $rowas->emp_leave_no_of_days + $total['ol'] : $total['ol'] ;
                                                                    break;
                                                                case 'el':
                                                                    $total['el'] = $rowas->emp_leave_approval_type ==  1 ? $rowas->emp_leave_no_of_days + $total['el'] : $total['el'] ;
                                                                    break;
                                                                case 'hpl':
                                                                    $total['hpl'] = $rowas->emp_leave_approval_type ==  1 ? ($rowas->emp_leave_no_of_days * 2 )+ $total['hpl'] : $total['hpl'] ;
                                                                    break;
                                                                default:
                                                                    break;
                                                            }
                                                            ?>                
                                                            <tr>
                                                                <td><?php echo leaveType($rowas->emp_leave_type); ?></td>
                                                                <td><?php echo $rowas->emp_leave_no_of_days; ?></td>
                                                                <td><?php echo get_date_formate($rowas->emp_leave_date); ?></td>
                                                                <td><?php echo $rowas->emp_leave_reason; ?></td>
                                                                <td>
                                                                    <?php echo $rowas->emp_leave_approval_type == 1 ? 
                                                                        'Approved' :
                                                                        'Pending' ; ?>
                                                                </td>
                                                            </tr>  
                                                        <?php  } ?>
                                                    <?php } ?>
                                                </table>
                                                <table width="100%">
                                                        <?php $leaves = $this->leave_model->getLeaves($row->emp_id); ?>
                                                        <tr>
                                                           <th colspan="2"><?php echo leaveType('cl'); ?></th>
                                                           <th colspan="2"><?php echo leaveType('ol'); ?></th>
                                                           <th colspan="2"><?php echo leaveType('el'); ?></th>
                                                           <th colspan="2"><?php echo leaveType('hpl'); ?></th>
                                                        </tr>
                                                        <tr> <td>Leave taken</td><td>Remaining</td><td>Leave taken</td><td>Remaining</td><td>Leave taken</td><td>Remaining</td><td>Leave taken</td><td>Remaining</td></tr>
                                                        <tr>
                                                           <td><?php echo $total['cl']; ?> </td> <td> <?php echo $leaves->cl_leave; ?></td>
                                                           <td><?php echo $total['ol']; ?> </td> <td> <?php echo $leaves->ol_leave; ?></td>
                                                           <td><?php echo $total['el']; ?> </td> <td> <?php echo calculate_el($leaves->el_leave); ?></td>
                                                           <td><?php echo $total['hpl']; ?> </td> <td> <?php echo $leaves->hpl_leave .' ('.calculate_hpl($leaves->hpl_leave).')'; ?></td>
                                                        </tr>
                                                </table>
                                            </td>                       
                                        </tr>		         
                                        <?php
                                        $sn++;
                                    }
                                    ?> 
                                    <?php
                                } else {
                                    echo "No record found!";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
<?php } ?>

