<style type="text/css" media="print">
    @media print
{    
    .no-print, .no-print *
    {
        display: none !important;
    }


}
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
<h1>
  <?php  $dd_key = $this->uri->segment(3);
			echo  $this->lang->line($dd_key );
         ?>
</h1>
<ol class="breadcrumb">
  <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
  <li class="active">
    <?php  $dd_key = $this->uri->segment(3);
	$emp_id = $this->uri->segment(4);
echo  $this->lang->line($dd_key );
         ?>
  </li>
</ol>
</section>
<!-- Main content -->
<section class="content">
  <!-- Your Page Content Here -->
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="col-xs-12 no-print" >
          <div class="box-header">
            <h3 class="box-title">
              <?php //echo $title_tab_header;     ?>
            </h3>
          </div>
          <?php if($dataval[0]['pay_cate_gpf'] == 1){  ?>
          <div class="col-xs-2"> <a   href="<?php echo base_url(); ?>payroll/paydd_papararr/pay_gpf/<?php echo $this->uri->segment(4) ;?>/<?php echo $this->uri->segment(5); ?>"  class="btn btn-block btn-info" ><?php echo $this->lang->line('pay_gpf');?></a><br/>
          </div>
          <?php }if($dataval[0]['pay_cate_dpf'] == 1){  ?>
          <div class="col-xs-2"> <a   href="<?php echo base_url(); ?>payroll/paydd_papararr/pay_dpf/<?php echo $this->uri->segment(4) ;?>/<?php echo $this->uri->segment(5); ?>"  class="btn btn-block btn-info" ><?php echo $this->lang->line('pay_dpf');?></a><br/>
          </div>
          <?php }if($dataval[0]['pay_cate_defined_contribution'] == 1){  ?>
          <div class="col-xs-2"> <a   href="<?php echo base_url(); ?>payroll/paydd_papararr/pay_defined_contribution/<?php echo $this->uri->segment(4) ;?>/<?php echo $this->uri->segment(5); ?>"  class="btn btn-block btn-info" ><?php echo $this->lang->line('pay_define');?></a><br/>
          </div>
          <?php }?>
          <div class="col-xs-2"> <a   href="<?php echo base_url(); ?>payroll/paydd_papararr/pay_income_tax/<?php echo $this->uri->segment(4) ;?>/<?php echo $this->uri->segment(5); ?>"  class="btn btn-block btn-info" ><?php echo $this->lang->line('pay_income_tax');?></a><br/>
          </div>
          <?php if($dataval[0]['pay_cate_other_adv'] == 1){  ?>
          <div class="col-xs-2"> <a   href="<?php echo base_url(); ?>payroll/paydd_papararr/pay_other_adv/<?php echo $this->uri->segment(4) ;?>/<?php echo $this->uri->segment(5); ?>"  class="btn btn-block btn-info" ><?php echo $this->lang->line('pay_other_adv');?></a><br/>
          </div>
          <?php } ?>
          <div class="col-xs-2"> <a   href="<?php echo base_url(); ?>payroll/paydd_papararr/pay_total/<?php echo $this->uri->segment(4) ;?>/<?php echo $this->uri->segment(5); ?>"  class="btn btn-block btn-info" ><?php echo   "नगद  राशी";?></a><br/>
          </div>
        </div>
        <h1 class="no-print">
          <?php  $dd_key = $this->uri->segment(3);
echo  $this->lang->line($dd_key );
         ?>
        </h1>
        <div class="box-tools pull-right no-print">
          <button onclick="printContents('divname')" class="btn btn-primary btn-sm no-print">Print</button>
          <button class="btn  btn-warning" title="Back" onclick="goBack()">पिछले पेज में वापस जायें</button>
          <?php if($dd_key == "pay_professional_tax"){?>
          <button type="button" class="btn bg-purple"  data-toggle="modal" onclick="ckval()" data-target="#mygpf">Add remark</button>
          <?php } ?>
        </div>
        <div id="divname">
          <?php  $this->load->view("payroll/pay_dd_head");?>
          <?php if($dd_key == "pay_gpf" || $dd_key == "pay_dpf"){

$this->load->view("payroll/pay_gpf1");
 }elseif($dd_key == "pay_income_tax") {
 $this->load->view("payroll/pay_it"); 
  }
  elseif($dd_key == "pay_defined_contribution") {
 $this->load->view("payroll/pay_gpf1"); 
  } elseif($dd_key == "pay_house_rent") { $this->load->view("payroll/pay_hrd"); ?>
          <?php }elseif($dd_key == "pay_professional_tax"){
 $this->load->view("payroll/pay_pt"); 
 }elseif($dd_key == "pay_gias"){
 $this->load->view("payroll/pay_gis"); 
 }elseif($dd_key == "pay_fuel_charge"){
 $this->load->view("payroll/pay_fuel_charge"); 
 }elseif($dd_key == "pay_house_loan"){
 $this->load->view("payroll/pay_house_loan"); 
 }elseif($dd_key == "pay_car_loan"){
 $this->load->view("payroll/pay_house_loan"); 
 }
 elseif($dd_key == "pay_grain_adv"){
 $this->load->view("payroll/pay_grain_adv"); 
 }
elseif($dd_key == "pay_festival_adv"){
 $this->load->view("payroll/pay_festival_adv"); 
 }
elseif($dd_key == "pay_other_adv"){
 $this->load->view("payroll/pay_other_adv"); 
 }elseif($dd_key == "pay_total"){

 $this->load->view("payroll/pay_total"); 
 
 }
 else{
 $this->load->view("payroll/pay_pt"); 

 } ?>
        </div>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  </div>
  <!-- /.row -->
  <!-- Main row -->
</section>
<!-- /.content -->
<div id="mygpf" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">रिमार्क </h4>
      </div>
      <div class="modal-body">
      <form action="<?php echo base_url();?>payroll/addptremarks/<?php echo $this->uri->segment(4).'/'.$this->uri->segment(5); ?>" method="post" >
        <div class="form-group">
          <label for="exampleInputEmail1"><?php echo  "रिमार्क " ?><span class="text-danger">*</span></label>
          <input type="text" name="marks" id=""  value="" class="form-control">
          <input type="hidden" name="salary_id" id="salary_id"  value="" class="form-control">
        </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" type="submit" name="savenotice" id="savenotice" onclick="showdetails()" value="1"><?php echo $this->lang->line('submit_botton'); ?></button>
        </div>
      </form>
    </div>
  </div>
</div>
