<?php //pre(getusersection(emp_session_id()));
//conplaints
//$all_complaints = sizeof($this->complaint_model->get_complaints('all'));
//marked da files
//$all_marked = sizeof($this->est_model->get_marked_da_file('all'));
//cr files
$get_files = sizeof(@$get_files);

if(check_est_so() || getusersection(emp_session_id()) == 7) { ?>
    <div class="col-xs-12">
        <div class="box box-primary box-solid">
            <div class="box-header">
                <i class="fa fa-th"></i><h3 class="box-title">विकल्प</h3>
                <div class="box-tools pull-right">
                    <button data-widget="collapse" class="btn bg-primary btn-sm"><i class="fa fa-minus"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="row text-center">
                    <!--<div class="col-xs-2">-->
                    <a href="<?php echo base_url('establishment'); ?>/view_file_es" class="btn btn-primary" <?php echo $this->uri->segment(2) == 'view_file_es' && $this->uri->segment(3) == '' ? 'disabled' : '' ;?>>सभी फाइले देखे<?php if(check_est_so()) { ?><span class="badge"><?php //echo $get_files ; ?><?php } ?></span></a>
                    <!--</div>-->
                    <!-- <div class="col-xs-2">-->
                    <a href="<?php echo base_url('establishment'); ?>/view_file_es/index/cr" class="btn btn-warning" <?php echo $this->uri->segment(2) == 'view_file_es' && $this->uri->segment(4) == 'cr' ? 'disabled' : '' ;?>>आवक से आयी फाइलें / पत्र <?php if(check_est_so()) { ?><span class="badge"><?php //echo $get_files ; ?><?php } ?></span></a>
                    <!--</div>
                    <div class="col-xs-2">-->
                    <a href="<?php echo base_url('establishment'); ?>/est_files/marked_da_file" class="btn btn-info <?php echo $this->uri->segment(3) == 'marked_da_file' ? 'disabled' : '' ;?>">स्थापना शाखा में बनाई फाइलें / पत्र <?php if(check_est_so()) { ?><span class="badge"><?php //echo $all_marked ; ?><?php } ?></span></a>
                    <!--</div>
                    <div class="col-xs-2">-->
                    <a href="<?php echo base_url('establishment'); ?>/view_file_es/index/return"  class="btn btn-success <?php echo $this->uri->segment(4) == 'return'  && $this->uri->segment(2) == 'view_file_es' ? 'disabled' : '' ;?>" >अधिकारी द्वारा आई फाइलें /पत्र<?php if(check_est_so()) { ?><span class="badge"><?php //echo $all_complaints ; ?><?php } ?></span></a>
                    <!--</div>
                    <div class="col-xs-2">-->
                    <a href="<?php echo base_url('establishment'); ?>/complaints"  class="btn btn-danger <?php echo $this->uri->segment(2) == 'complaints' ? 'disabled' : '' ;?>" >आवेदन <?php if(check_est_so()) { ?><span class="badge"><?php //echo $all_complaints ; ?><?php } ?></span></a>
                    <!--</div>-->
                </div>
            </div>
        </div>
    </div>
<?php } ?>