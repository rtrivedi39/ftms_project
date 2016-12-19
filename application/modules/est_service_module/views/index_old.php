<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo $title; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo $this->lang->line('notice_heading'); ?></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Your Page Content Here -->
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title"></h3>
                    <div class="box-tools pull-right">
                        <?php  if(($this->uri->segment(2)=='subcategory')|| ($this->uri->segment(2)=='edit_subcategory')|| ($this->uri->segment(2)=='view_subcategory') ){  ?>
                            <a href="<?php echo base_url('establishment');?>/subcategory/<?php echo $this->uri->segment(3); ?>">
                                <button type="button" class="btn  btn-info"><?php echo $this->lang->line('add_button'); ?></button>
                            </a>
                        <?php } ?>
                        <?php  if(($this->uri->segment(2) == 'edit_category')|| ($this->uri->segment(2) == 'managecategory') || ($this->uri->segment(2) == 'category')){ ?>
                            <a href="<?php echo base_url('establishment');?>/managecategory">
                                <button type="button" class="btn  btn-info"><?php echo $this->lang->line('add_button'); ?></button>
                            </a>
                        <?php } ?>
                        <a href="javascript:history.go(-1)">
                            <button type="button" class="btn btn-warning"><?php echo $this->lang->line('Back_button_label'); ?></button>
                        </a>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
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
                                    <div class="form-group">
                                        <!--<div class="col-xs-2">-->
                                       <button type="button" class="btn btn-primary">Reimbursement</button>
                                        <!--</div>-->
                                        <!--<div class="col-xs-2">-->
                                        <button type="button" class="btn btn-primary" id="show_btn">Advance</button>
                                        <!--</div>-->
                                    </div>
                                    <!--<hr/>
                                    <div class="form-group">
                                        <div class="col-xs-3 col-md-3">
                                            <div class="input-group">
                                                <div class="input-group-btn">
                                                    <button type="button" class="btn btn-primary">खोज का प्रकार</button>
                                                </div>
                                                <select class="form-control" name="search_type" required id="search_type">
                                                    <option value="">खोजनें का प्रकार चयन करें </option>
                                                        <option value="1" <?php /*echo @$this->input->post('search_type') == '1' ? "selected" : false*/?>>यूनिकोड</option>
                                                        <option value="2" <?php /*echo @$this->input->post('search_type') == '2' ? "selected" : false*/?>>नाम</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-3 col-md-3">
                                            <input type="text" name="search_parameter1" id="search_parameter1"  class="form-control">
                                        </div>
                                        <div class="col-xs-3 col-md-3">
                                            <button type="submit" class="btn btn-primary"> खोजे </button>
                                        </div>
                                    </div>-->
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-xs-12 show_div_r" style="display: none">
                        <div class="box box-info">
                            <div class="box-header">
                                <i class="fa fa-file-text"></i><h3 class="box-title"><?php echo $title_tab;?></h3>
                                <div class="box-tools pull-right">
                                    <button data-widget="collapse" class="btn bg-primary  btn-sm"><i class="fa fa-minus"></i></button>
                                </div>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="col-md-4">
                                    <?php  foreach($emp_gpf_dpf as $emp_gpf_dpf1) {
                                        if($emp_gpf_dpf1['pay_cate_gpf'] == '1') { ?>
                                            <a href="<?php echo base_url('establishment'); ?>/gpfdpf_manage/index/160/p" class="btn btn-primary" > जी.पी.एफ. </a>
                                        <?php }elseif($emp_gpf_dpf1['pay_cate_dpf'] == '1') { ?>
                                            <a href="<?php echo base_url('establishment'); ?>/gpfdpf_manage/index/160/p" class="btn btn-primary" > डी,पी.एफ. </a>
                                    <?php }} ?>
                                </div>
                            </div><!-- /.box -->
                        </div><!-- /.row -->
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div><!-- /.row -->
        <!-- Main row -->
</section><!-- /.content -->
<script>
    $(document).ready(function(){
        $("#show_btn").click(function(){
            $(".show_div_r").toggle();
        });
    });
</script>

