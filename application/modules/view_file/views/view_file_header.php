<?php if(check_est_emplyee()){
	//$this->load->view('establishment/est_header');
 }else { ?>
	<div class="col-xs-12">
		<div class="box">				
			<div class="box-header">
				<i class="fa fa-th"></i><h3 class="box-title">विकल्प</h3>  
				<div class="box-tools pull-right">
                    <button data-widget="collapse" class="btn bg-teal btn-sm"><i class="fa fa-minus"></i></button>
                </div>				
			</div><!-- /.box-header -->
			<div class="box-body">
				<div class="row">
					<div class="col-xs-3">
						<a href="<?php echo base_url('view_file'); ?>?sn=cr" class="btn btn-block btn-warning">आवक से आयी फाइलें</a>
					</div>
					<div class="col-xs-3">
						<a href="<?php echo base_url('view_file'); ?>/index/1" class="btn btn-block btn-info <?php echo ($this->uri->segment(2) == 'index' && $this->uri->segment(3) == '1' ) ? 'disabled' : '' ;?>">सहायक द्वारा आई  फाइलें</a>
					</div>
					<div class="col-xs-3">
						<a href="<?php echo base_url('view_file'); ?>/index/return"  class="btn btn-block btn-danger <?php echo ($this->uri->segment(2) == 'index' && $this->uri->segment(3) == 'return' ) ? 'disabled' : '' ;?>" > अधिकारी द्वारा आई फाइलें</a>
					</div>
					<div class="col-xs-3">
						<a href="<?php echo base_url('view_file'); ?>/index/reject"  class="btn btn-block btn-success <?php echo ($this->uri->segment(2) == 'index' && $this->uri->segment(3) == 'reject' ) ? 'disabled' : '' ;?>" > रिजेक्ट फाइलें </a>
					</div>
				</div>
			</div>
		</div>
	</div>
 <?php } ?>