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
                        <br/>
                    </div>

                    <div class="box-header with-border">
                        <div class="row">
                            <div class="col-xs-2">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('bulk_action'); ?> </label>
                            </div><?php if($this->session->flashdata('error')){?>
     <div class="col-xs-6" style="    background-color: rgba(255, 24, 0, 0.44);
    width: 68%;
    padding: 0 5px;
    border: solid 1px red;"><?php // echo $this->session->flashdata('message');
                        echo $this->session->flashdata('error'); ?><div/>
                        <?php } ?>
                        </div>
                    </div>
                    <div class="box-body">
           
    <form action="<?php echo base_url();?>payroll/showallpayslip" method="post">

                           <div class="form-group col-xs-6">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('emp_pay_month'); ?><span class="text-danger">*</span></label>
               <?php $currentmonth = date('F'); ?>
                  <select name="pay_month" name="pay_month" required onchage="changemonth()" class="form-control">
                                <option value=""><?php echo $this->lang->line('emp_pay_month'); ?></option>
                                <?php for ($m=1; $m<=12; $m++) {
     $month = date('F', mktime(0,0,0,$m, 1, date('Y')));
     
     ?>
                                    <option value="<?php echo $month ?>" <?php echo  $currentmonth == $month  ? 'selected' : ''; ?> ><?php echo $month ?></option>
                                <?php } ?>
                            </select> 

                <?php echo form_error('category_title_hin');?>
              </div>
              
              
               <div class=" form-group col-xs-6">
              <label for="exampleInputEmail1"><?php echo $this->lang->line('emp_pay_year'); ?><span class="text-danger">*</span></label>
             
                <select name="pay_year" required class="form-control">
                                <option value=""><?php echo $this->lang->line('emp_pay_year'); ?></option>
                                <?php for ($y=2014; $y<=date("Y"); $y++) {
   
     ?>
                                    <option value="<?php echo $y ?>"  <?php echo  date("Y") == $y  ? 'selected' : ''; ?>  ><?php echo $y ?></option>
                                <?php } ?>
                            </select>   </div>


    </div>
   
      <div class="box-footer">
          <button class="btn btn-primary" type="submit" name="savenotice" id="savenotice"  value="1"><?php echo $this->lang->line('submit_botton'); ?></button>
        </div>

             </div> </div><!-- /.box --></div>
        </div>
    </div><!-- /.row -->
    <!-- Main row -->
</section><!-- /.content -->

<!-- Modal approve -->

