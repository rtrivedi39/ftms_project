<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
   <?php echo "डी पी एफ स्लिप"; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo "डी पी स्लिप"; ?></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Your Page Content Here -->
    <!-- Small boxes (Stat box) -->
  
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <!-- small box -->
            <div class="box box-warning">
                <div class="box-header">
                  <!--  <h3>यह आपकी पर्सनल जानकारी है अगर इसमे किसी प्रकार की त्रुटी दिखाई दे तो हमें अवश्य सूचित करे|</h3> -->
                </div>
           <div class="container"><h2><?php echo "डी पी एफ स्लिप २०१५-२०१६";?></h2>
  
<div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">       
                <div class="box-header">
                  
                    <div class="box-tools pull-right">
           
            
                        <a href="javascript:history.go(-1)">
                            <button type="button" class="btn  btn-warning"><?php echo $this->lang->line('Back_button_label'); ?></button>
                        </a>
                    </div>
                </div><!-- /.box-header -->
        
	<?php if($_GET['uid'] != "51011068" && $_GET['uid'] != "51011071"){
				?>
				<div class="col-md-3">
                      <a href="<?php echo base_url();?>uploads/paybill/DPFSLIP2015-2016/<?php echo "0".$_GET['uid'].".pdf";  ?>" trgate= "_blank" class="btn  btn-danger"><?php echo "डी पी एफ स्लिप";  ?>
 <br/>2015-2016</a>
                </div>
				<?php }else{?>
				<div class="col-md-3">
                    	<a target="_blank" href="<?php echo base_url(); ?>uploads/paybill/DPFSLIP2015-2016/<?php echo "0".$_GET['uid'].".pdf"; ?>" class="btn btn-danger ">डी पी एफ स्लिप -1
						<br/>2015-2016</a>
					</div>	<div class="col-md-3">
						<a target="_blank" href="<?php echo base_url(); ?>uploads/paybill/DPFSLIP2015-2016/<?php echo "0".$_GET['uid']."-2.pdf"; ?>" class="btn btn-danger ">डी पी एफ स्लिप -2  
						<br/>2015-2016</a>
				</div>	<div class="col-md-3">	<a target="_blank" href="<?php echo base_url(); ?>uploads/paybill/DPFSLIP2015-2016/<?php echo "0".$_GET['uid']."-3.pdf"; ?>" class="btn btn-danger ">डी पी एफ स्लिप -3
						<br/>2015-2016</a>
                </div>
				
				
				<?php } ?> 
				</div>
				</div></div>
				</div>
								</div>
				
     </div><!-- /.box -->
    </div><!-- col 12-->
    </div><!-- /.row -->
 
    </div>
</section><!-- /.content -->
