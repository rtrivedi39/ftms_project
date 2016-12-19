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
                             <a href="<?php echo base_url();?>payroll/add_bill" >
                               <button type="button" class="btn  btn-primary"><?php echo $this->lang->line('add_new'); ?></button></a>
                            </div> 
                        </div>
                    </div>
                    <div class="box-body">
                        <?php echo $this->session->flashdata('message_success'); ?>

                        <table  class="table table-bordered table-striped display dataTable no-footer ">
                            <thead>
                                <tr>
                                    <th width='5%'>बिल टाइप</th>
                                    <th width="5%">वेतन हेड</th>
                                    <th width='5%'>वेतन बजट मद* </th>
                                    <th width='5%'>वेतन महीना </th>
                                    <th width='5%'>वेतन साल</th>
                          			<th width='5%'>कंप्यूटर देयक नंबर </th>
                                    <th width="15%">कंप्यूटर बिल तारीख</th>
   									<th width="15%">ऑफिस देयक नंबर</th>
      								<th width="15%">वॉचर देयक नंबर</th>
			                		<th width="15%">वाउचर बिल की तारीख</th> 
                               		<th width="15%">सकल राशी</th> 
                                    <th width="15%">शुद्ध राशि</th>
									<th width="15%">शुद्ध राशि</th>
                                 </tr>
							  </thead>
                            <tbody>
                            <?php  $i = 1;
                              // pre($pay_salary);
                                foreach ($pay_bills as $key => $salary) { ?>
                  			<tr>
								<td width='5%'><?php if($salary->pbill_type == 0){ echo "वेतन";}else{echo "एरीयर्स";}?></td>
                                <td width="5%"><?php echo @gethead($salary->pbill_cate_id)[0]->pay_cate_name;?></td>
                                <td width='5%'><?php echo @$salary->pbill_bugetno;?></td>
                                <td width='5%'><?php echo @$salary->pbill_month;?></td>
								<td width='5%'><?php echo @$salary->pbill_year?></td>
                          		<td width='5%'><?php echo @$salary->pbill_computer_no?></td>
                                <td width="15%"><?php echo @$salary->pbill_computer_date?></td>
   								<td width="15%"><?php echo @$salary->pbill_office_no?></td>
      							<td width="15%"><?php echo @$salary->pbill_vocher_no?></td>
                				<td width="15%"><?php echo @$salary->pbill_vocher_date?></td> 
                				<td width="15%"><?php echo @$salary->pbill_gross_amount?></td> 
                  				<td width="15%"><?php echo @$salary->pbill_net_amont?></td> 
                				<td width="15%">  
									<a href="<?php echo base_url();?>payroll/edit_billno/<?php echo $salary->pbill_id;?>" ><button type="button" class="btn  btn-primary"><?php echo 'बदलाव करें'; ?></button></a>
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

