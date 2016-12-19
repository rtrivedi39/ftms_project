<div class="box box-solid">
	<div class="box-header with-border">
	  <h3 class="box-title">ड्राफ्ट</h3>
	  <div class='box-tools'>
		<button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
	  </div>
	</div>
	<div class="box-body no-padding">
	  <ul class="nav nav-pills nav-stacked">				
		<li class="<?php echo $this->uri->segment('3') == '' ? 'active' : ''; ?>">
			<a href="<?php echo base_url();?>draft/draft"><i class="fa fa-inbox"></i>इनबॉक्स <span class="label label-primary pull-right"></span></a>
		</li>
		<li class="<?php echo $this->uri->segment('3') == 'send_draft' ? 'active' : ''; ?>">
			<a href="<?php echo base_url();?>draft/draft/send_draft"><i class="fa fa-envelope-o"></i> भेजे गए</a>
		</li>
		<li class="<?php echo $this->uri->segment('3') == 'working_draft' ? 'active' : ''; ?>">
			<a href="<?php echo base_url();?>draft/draft/working_draft"><i class="fa fa-file-text-o"></i> काम कर रहे</a>
		</li>
		<li class="<?php echo $this->uri->segment('3') == 'final_draft' ? 'active' : ''; ?>">
			<a href="<?php echo base_url();?>draft/draft/final_draft"><i class="fa fa-file-text"></i> जो पुरे हो गए </a>
		</li>
	  </ul>
	</div><!-- /.box-body -->
</div><!-- /. box -->	