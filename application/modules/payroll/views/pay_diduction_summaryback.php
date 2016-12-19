<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo  " वेतन कटोती पत्रक ";  ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo "  पुराने माह का वेतन कटोती पत्रक"; ?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title"><?php echo "  पुराने माह का वेतन कटोती पत्रक ";     ?></h3>
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
                        <h3 class="box-title"><?php echo "  पुराने माह का वेतन कटोती पत्रक "; ?></h3>                 
                    </div>
                    <div class="box-header with-border">
                        <div class="row">
                            <div class="col-xs-2">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('bulk_action'); ?> </label>
                            </div>
                          
                          
                        </div>
                    </div>

                    <div class="box-body">
               
     
                            <div class="col-xs-2">
    <a   href="<?php echo base_url(); ?>payroll/paydd_papar_bck/pay_gpf/<?php echo $this->uri->segment(3) ;?>"  class="btn btn-block btn-info" ><?php echo $this->lang->line('pay_gpf');?></a><br/>
    </div>    

<div class="col-xs-2">
    <a   href="<?php echo base_url(); ?>payroll/paydd_papar_bck/pay_dpf/<?php echo $this->uri->segment(3) ;?>"  class="btn btn-block btn-info" ><?php echo $this->lang->line('pay_dpf');?></a><br/>
    </div> 

     


  

        <div class="col-xs-2">
    <a   href="<?php echo base_url(); ?>payroll/paydd_papar_bck/pay_gias/<?php echo $this->uri->segment(3) ;?>"  class="btn btn-block btn-info" ><?php echo $this->lang->line('pay_gis');?></a><br/>


    </div>




        <div class="col-xs-2">
    <a   href="<?php echo base_url(); ?>payroll/paydd_papar_bck/pay_defined_contribution/<?php echo $this->uri->segment(3) ;?>"  class="btn btn-block btn-info" ><?php echo $this->lang->line('pay_define');?></a><br/>
    </div>

   <div class="col-xs-2">
    <a   href="<?php echo base_url(); ?>payroll/paydd_papar_bck/pay_house_loan/<?php echo $this->uri->segment(3) ;?>"  class="btn btn-block btn-info" ><?php echo $this->lang->line('pay_home_loan');?></a><br/>
    </div>

    

<div class="col-xs-2">
    <a   href="<?php echo base_url(); ?>payroll/paydd_papar_bck/pay_car_loan/<?php echo $this->uri->segment(3) ;?>"  class="btn btn-block btn-info" ><?php echo $this->lang->line('pay_car_loan');?></a><br/>
    </div>



<div class="col-xs-2">
    <a   href="<?php echo base_url(); ?>payroll/paydd_papar_bck/pay_house_rent/<?php echo $this->uri->segment(3) ;?>"  class="btn btn-block btn-info" ><?php echo $this->lang->line('pay_house_rent');?></a><br/>
    </div>

 
    <div class="col-xs-2">
    <a   href="<?php echo base_url(); ?>payroll/paydd_papar_bck/pay_fuel_charge/<?php echo $this->uri->segment(3) ;?>"  class="btn btn-block btn-info" ><?php echo $this->lang->line('pay_fule_charge');?></a><br/>
    </div>

 <div class="col-xs-2">
    <a   href="<?php echo base_url(); ?>payroll/paydd_papar_bck/pay_festival_adv/<?php echo $this->uri->segment(3) ;?>" class="btn btn-block btn-info" ><?php echo $this->lang->line('pay_festival_adv');?></a><br/>


    </div>

 <div class="col-xs-2">
    <a   href="<?php echo base_url(); ?>payroll/paydd_papar_bck/pay_grain_adv/<?php echo $this->uri->segment(3) ;?>"  class="btn btn-block btn-info" ><?php echo $this->lang->line('pay_grain_adv');?></a><br/>


    </div>
     <div class="col-xs-2">
    <a   href="<?php echo base_url(); ?>payroll/paydd_papar_bck/pay_professional_tax/<?php echo $this->uri->segment(3) ;?>"  class="btn btn-block btn-info" ><?php echo $this->lang->line('pay_professional_tax');?></a><br/>

    
    </div>


     <div class="col-xs-2">
    <a   href="<?php echo base_url(); ?>payroll/paydd_papar_bck/pay_income_tax/<?php echo $this->uri->segment(3) ;?>"  class="btn btn-block btn-info" ><?php echo $this->lang->line('pay_income_tax');?></a><br/>

    
    </div>
     </div>
             </div>
    </div><!-- /.row -->
    <!-- Main row -->
</section><!-- /.content -->

<!-- Modal approve -->

<script type="text/javascript">
$('select').on('change', function() {
 
  $("#1").attr("href", "<?php echo base_url(); ?>payroll/empcate/1/"+this.value);
  $("#2").attr("href", "<?php echo base_url(); ?>payroll/empcate/2/"+this.value);
  $("#3").attr("href", "<?php echo base_url(); ?>payroll/empcate/3/"+this.value);
  $("#4").attr("href", "<?php echo base_url(); ?>payroll/empcate/4/"+this.value);
});

</script>