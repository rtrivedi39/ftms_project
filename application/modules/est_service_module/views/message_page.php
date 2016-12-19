<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo $title; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo "स्थापना कार्य"; ?></li>
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
                        <a href="javascript:history.go(-1)">
                            <button type="button" class="btn btn-warning"><?php echo $this->lang->line('Back_button_label'); ?></button>
                        </a>
                    </div>
                </div><!-- /.box-header -->

                <div class="box-body">
                        <div class="col-xs-12" >
                            <div class="box box-success box-solid">
                                <div class="box-header">
                                    <i class="fa fa-th"></i><h3 class="box-title"><?php echo "अवेदन सफलतापूर्वक दर्ज किया गया | " ; ?></h3>
                                    <div class="box-tools pull-right">
                                        <button data-widget="collapse" class="btn bg-green btn-sm"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <div class="row text-center">
                                        <div class="form-group">

                                            <div class="box-body"> <a href="http://localhost/eoffice_3june_est/establishment/service_forms/52/97"><button type="button" class="btn btn-primary"><i class="fa fa-edit"></i> आवेदन करें</button></a> <a href="http://localhost/eoffice_3june_est/est_service_module/app_list/97"><button type="button" class="btn btn-primary"><i class="fa fa-fw fa-list"></i> आवेदन देखें</button></a> <a target="_blank" href="http://localhost/eoffice_3june_est/uploads/notice/93823126ccb71a8a776bc47a1b05e25a.pdf"><button type="button" class="btn btn-primary"><i class="fa fa-fw fa-paperclip"></i> नियम</button></a> </div>
										
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div><!-- /.box -->
            </div>
        </div><!-- /.row -->
        <!-- Main row -->
</section><!-- /.content -->
