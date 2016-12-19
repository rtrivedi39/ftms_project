<style type="text/css" media="print">
    @media print
{    
    .no-print, .no-print *
    {
        display: none !important;
    }


}
</style>
<section class="content-header">
    <h1>
        <?php echo  " वेतन कटोती पत्रक ";  ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo " वेतन कटोती पत्रक "; ?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title"><?php echo " वेतन कटोती पत्रक ";     ?></h3>
                </div>
                <div class="box-body">
                    <?php //$this->load->view('payroll_header') ?>
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
                        <h3 class="box-title"><?php echo " वेतन कटोती पत्रक "; ?></h3>                 
                    </div>
                    <div class="box-header with-border">
                        <div class="row">
                            <div class="col-xs-2">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('bulk_action'); ?> </label>
                            </div>
                              <div class="box-tools pull-right">
           
            
                        <a href="javascript:history.go(-1)">
                            <button type="button" class="btn  btn-warning"><?php echo $this->lang->line('Back_button_label'); ?></button>
                        </a>
                    </div>
                          
                        </div>
                    </div>

                    <div class="box-body ">
               
     <?php if($dataval[0]['pay_cate_gpf'] == 1){  ?>
                            <div class="col-xs-2">
    <a   href="<?php echo base_url(); ?>payroll/paydd_papararr/pay_gpf/<?php echo $this->uri->segment(3) ;?>/<?php echo $this->uri->segment(4); ?>"  class="btn btn-block btn-info" ><?php echo $this->lang->line('pay_gpf');?></a><br/>
    </div>    
<?php }if($dataval[0]['pay_cate_dpf'] == 1){  ?>
<div class="col-xs-2">
    <a   href="<?php echo base_url(); ?>payroll/paydd_papararr/pay_dpf/<?php echo $this->uri->segment(3) ;?>/<?php echo $this->uri->segment(4); ?>"  class="btn btn-block btn-info" ><?php echo $this->lang->line('pay_dpf');?></a><br/>
    </div> 

     




     

       <?php }if($dataval[0]['pay_cate_defined_contribution'] == 1){  ?>


        <div class="col-xs-2">
    <a   href="<?php echo base_url(); ?>payroll/paydd_papararr/pay_defined_contribution/<?php echo $this->uri->segment(3) ;?>/<?php echo $this->uri->segment(4); ?>"  class="btn btn-block btn-info" ><?php echo $this->lang->line('pay_define');?></a><br/>
    </div>
<?php }  ?>
 




     <div class="col-xs-2">
    <a   href="<?php echo base_url(); ?>payroll/paydd_papararr/pay_income_tax/<?php echo $this->uri->segment(3) ;?>/<?php echo $this->uri->segment(4); ?>"  class="btn btn-block btn-info" ><?php echo $this->lang->line('pay_income_tax');?></a><br/>

    
    </div>
	   <div class="col-xs-2">
    <a   href="<?php echo base_url(); ?>payroll/paydd_papararr/pay_total/<?php echo $this->uri->segment(3) ;?>/<?php echo $this->uri->segment(4); ?>"  class="btn btn-block btn-info" ><?php echo   "नगद  राशी";?></a><br/>

    
    </div>
     </div>
             </div>
    </div><!-- /.row -->
    <!-- Main row -->
	</div>
	
	
	
	
</section><!-- /.content -->

<!-- Modal approve -->

