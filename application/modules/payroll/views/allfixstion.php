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
                    <?php $this->load->view('payroll_header') ?>
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
                          
                          <div class="col-xs-12 ">
                             <a href="<?php echo base_url();?>payroll/addfixstion/" >
                               <button type="button" class="btn  btn-primary"><?php echo $this->lang->line('add_new'); ?></a></button>
                            </div> 
                        </div>
                    </div>
                    <div class="box-body">
                        <?php echo $this->session->flashdata('message'); ?>
                        <table  class="table table-bordered table-striped display dataTable no-footer ">
                            <thead>
                                <tr>
                                    <th width='5%'>फिक्सेशन  नाम</th>
                                    <th width="5%">फिक्सेशन  विवरण </th>
                                    <th width='5%'>फिक्सेशन सैलरी  हेड </th>
                                     <th width='5%'>फिक्सेशन अमाउंट टाइप  </th>
                                      <th width='5%'>पर्सेंटेज इंक्रेमनेंट  अमाउंट </th>
                          <th width='5%'>पर्सेंटेज रेंज अमाउंट </th>
                                    <th width="15%"></th>

                                </tr>
                            </thead>
                            <tbody>
                            <?php  $i = 1;
                              // pre($pay_salary);
                                foreach ($pay_salary as $key => $salary) { ?>
									<tr>
                                    <th width='5%5%'><?php echo $salary->pf_name ?></th>
                                    <th width="5%"><?php echo $salary->pf_discription ?></th>
                                    <th width='5%'><?php echo gethead($salary->pf_cate_id)[0]->pay_cate_name; ?></th>
                                     
                                    <th width="5%"><?php if($salary->pf_type == 0){ echo "पर्सेंटेज";}else{echo "फिक्स्ड";} ?></th>
                                     <th width="5%"><?php echo $salary->pf_parcentage_val ?></th>
                                     <th width='5%'><?php echo $salary->pf_range; ?></th>
                                       
                                     
                                    <th width="15%"><a href="<?php echo base_url(); ?>payroll/editfixstion/<?php echo $salary->pf_cate_id ?>">edit</a> </th>

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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
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
                        <button type="button" class="btn btn-default" data-dismiss="modal">रद्द
                        <button type="submit" class="btn btn-primary" name="btnapprove">जमा करें
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
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
                        <button type="button" class="btn btn-default" data-dismiss="modal">रद्द
                        <button type="submit" class="btn btn-primary" name="btndeny">जमा करे
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
