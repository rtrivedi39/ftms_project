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
            
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $title_tab; ?></h3>                 
                    </div>
                    <div class="box-header with-border">
                        <div class="row">
                                  <div class="col-xs-12 ">
                             <a href="<?php echo base_url();?>payroll/add_adv/" >
                                                <button type="button" class="btn  btn-primary"><?php echo $this->lang->line('add_new'); ?></button></a>
                           
                            </div>
                          
                          
                        </div>
                    </div>
                    <div class="box-body">
                    	<?php// pre($pay_salary);?>
       
                        <table id="leave_tbl" class="table table-bordered table-striped">
                            <thead>
                                <tr>  <th width='5%'><?php echo $this->lang->line('sno'); ?></th>
                                    <th width='5%'><?php echo $this->lang->line('adv_name')  ?></th> 
									<th width='5%'><?php echo $this->lang->line('adv_name_en')  ?></th>
                                    <th width="5%"><?php echo $this->lang->line('adv_no_installment'); ?></th>
                                    <th width='5%'><?php echo $this->lang->line('adv_intrest'); ?></th>
                 
                                   
                               

                                  
                                </tr>
                            </thead>
                            <tbody>
                            <?php  $i = 1;
                              //pre($pay_salary);
                                foreach ($pay_salary as $key => $salary) { ?>
									<tr>
                                    <th width='5%5%'><?php echo $i; ?></th>
                                    <th width="5%">  <?php echo  $salary->adv_name_hi?></th>
                                    <th width="5%">  <?php  echo $salary->adv_name_en?></th>
                                       <th width="5%">  <?php echo  $salary->adv_no_installment?></th>
                                   
                                       <th width="5%">  <?php echo $salary->adv_intrest?></th>
                                   

                                    </tr>

                                <?php  $i++; } ?>
                            </tbody>
                        </table>
   
            </div><!-- /.box -->
        </div>
    </div><!-- /.row -->
    <!-- Main row -->
</section><!-- /.content -->

<!-- Modal approve -->
