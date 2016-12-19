<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo "वेतन सभी  हेड्स "; ?>    </h1>
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
                        <h3 class="box-title"><?php echo "वेतन वृद्धि सभी  हेड्स "; ?> </h3>                 
                    </div>
                 
                    <div class="box-body">
					
					
                           
                <div class="col-xs-12 with-border">   <h2>वेतन वृद्धि आदेश पत्र </h2> 	<?php foreach($pay_salary  as $sal_Cate){ if($sal_Cate->pay_cate_id != 13 && $sal_Cate->pay_cate_id != 1 ){?>
               <div class="col-xs-2">
    <a target="" id="<?php echo $sal_Cate->pay_cate_id; ?>" href="<?php echo base_url(); ?>payroll/empyearlyincement/<?php echo $sal_Cate->pay_cate_id; ?>"  <?php if($sal_Cate->pay_parent_id == 0){?>class="btn  bg-yellow btn-flat margin "<?php }else{ ?> class="btn bg-maroon btn-flat margin "<?php } ?> ><?php echo $sal_Cate->pay_cate_name; ?></a><br/>
    </div>
    <?php }} ?>	
            </div>  <div class="col-xs-12 with-border  ">
			
			<h2>वेतन वृद्धि प्रमाण पत्र </h2><?php foreach($pay_salary  as $sal_Cate){ if($sal_Cate->pay_cate_id != 13 && $sal_Cate->pay_cate_id != 1 ){?>  	
                <div class="col-xs-2">
    <a target="" id="<?php echo $sal_Cate->pay_cate_id; ?>" href="<?php echo base_url(); ?>payroll/empyearlyincementcer/<?php echo $sal_Cate->pay_cate_id; ?>"  <?php if($sal_Cate->pay_parent_id == 0){?>class="btn   bg-maroon btn-flat margin "<?php }else{ ?> class="btn bg-info btn-flat margin "<?php } ?> ><?php echo $sal_Cate->pay_cate_name."प्रमाण पत्र "; ?></a>
    </div>
    <?php }} ?><!-- /.box --></div></div>
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
  $("#5").attr("href", "<?php echo base_url(); ?>payroll/empcate/5/"+this.value);
  $("#6").attr("href", "<?php echo base_url(); ?>payroll/empcate/6/"+this.value);
  $("#7").attr("href", "<?php echo base_url(); ?>payroll/empcate/7/"+this.value);
  $("#8").attr("href", "<?php echo base_url(); ?>payroll/empcate/8/"+this.value);
    $("#9").attr("href", "<?php echo base_url(); ?>payroll/empcate/9/"+this.value);
	$("#10").attr("href", "<?php echo base_url(); ?>payroll/empcate/10/"+this.value);
	$("#11").attr("href", "<?php echo base_url(); ?>payroll/empcate/11/"+this.value);
	$("#12").attr("href", "<?php echo base_url(); ?>payroll/empcate/12/"+this.value);
});

</script>