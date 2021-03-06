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
                    <h3 class="box-title"><?php echo " वेतन कटोती ";   ?></h3>
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
                        <h3 class="box-title"><?php echo " वेतन कटोती ";   ?></h3>                 
                    </div>
                    <div class="box-header with-border">
                        <div class="row">
                            <div class="col-xs-2">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('bulk_action'); ?> </label>
                            </div>
                          
                          
                        </div>
                    </div>
                    <div class="box-body">   <div class="box-header with-border">
                        <h3 class="box-title">कृपया  सूची मे से कोई भी माह का चयन करें</h3>                 
                    </div>

                           <div class="form-group col-xs-2">
                <label for="exampleInputEmail1"><?php echo $this->lang->line('emp_pay_month'); ?><span class="text-danger">*</span></label>
               <?php $currentmonth = date('F'); ?>
                  <select name="pay_month" name="pay_month" onchage="changemonth()" class="form-control">
                                <option value=""><?php echo $this->lang->line('emp_pay_month'); ?></option>
                                <?php for ($m=1; $m<=12; $m++) {
     $month = date('F', mktime(0,0,0,$m, 1, date('Y')));
     
     ?>
                                    <option value="<?php echo $month ?>" <?php echo  $currentmonth == $month  ? 'selected' : ''; ?> ><?php echo $month ?></option>
                                <?php } ?>
                            </select> 

                <?php echo form_error('category_title_hin');?>
              </div>
                <div class="col-xs-12">    	<?php foreach($pay_salary  as $sal_Cate){?>
               <div class="col-xs-2">
    <a id="<?php echo $sal_Cate->pay_cate_id; ?>" href="<?php echo base_url(); ?>payroll/paydd/<?php echo $sal_Cate->pay_cate_id; ?>" <?php if($sal_Cate->pay_parent_id == 0){?>class="btn  bg-yellow btn-flat margin "<?php }else{ ?> class="btn bg-maroon btn-flat margin "<?php } ?>  ><?php echo $sal_Cate->pay_cate_name; ?></a><br/>
    </div>
    <?php }?>
            </div><!-- /.box --></div>
        </div>
    </div><!-- /.row -->
    <!-- Main row -->
</section><!-- /.content -->

<!-- Modal approve -->

<script type="text/javascript">
$('select').on('change', function() {
 
  $("#1").attr("href", "<?php echo base_url(); ?>payroll/paydd/1/"+this.value);
  $("#2").attr("href", "<?php echo base_url(); ?>payroll/paydd/2/"+this.value);
  $("#3").attr("href", "<?php echo base_url(); ?>payroll/paydd/3/"+this.value);
  $("#4").attr("href", "<?php echo base_url(); ?>payroll/paydd/4/"+this.value);
  $("#5").attr("href", "<?php echo base_url(); ?>payroll/paydd/5/"+this.value);
  $("#6").attr("href", "<?php echo base_url(); ?>payroll/paydd/6/"+this.value);
  $("#7").attr("href", "<?php echo base_url(); ?>payroll/paydd/7/"+this.value);
  $("#8").attr("href", "<?php echo base_url(); ?>payroll/paydd/8/"+this.value);
  $("#9").attr("href", "<?php echo base_url(); ?>payroll/paydd/9/"+this.value);
  $("#10").attr("href", "<?php echo base_url(); ?>payroll/paydd/10/"+this.value);
  $("#11").attr("href", "<?php echo base_url(); ?>payroll/paydd/11/"+this.value);
  $("#12").attr("href", "<?php echo base_url(); ?>payroll/paydd/12/"+this.value);
});

</script>