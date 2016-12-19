<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo $title; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo ""; ?></li>
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
                    <table id="view_table" class="table table-bordered table-striped display print_font">
                        <thead>
                        <tr>
                            <th>क्रमांक</th>
                            <th>अभिदाता</th>
                            <th>खता क्रमांक</th>
                            <th>वर्ष</th>
                            <th>राशि</th>
                            <th>अपेक्षित राशि</th>
                            <th>स्थिति</th>
                            <th>कार्यवाही</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i=1; foreach ($app_list as $key => $lists) {
                            $file_details = getFileDetails($lists['pay_file_id']);
                            $curr_emp = emp_session_id(); ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td>
                                    <?php echo $lists['pay_emp_name'] ; ?><br/>
                                    <?php echo $lists['pay_emp_unique_id'] ; ?><br/>
                                    <?php echo $lists['pay_emp_designation'] ; ?><br/>
                                    <?php echo $lists['pay_emp_class'] ; ?>
                                </td>
                                <td><?php echo $lists['pay_account_no'] ; ?></td>
                                <td><?php echo $lists['pay_years'] ; ?></td>
                                <td><?php echo $lists['pay_amount'] ; ?></td>
                                <td><?php echo $lists['pay_adv_amount'] ; ?></td>
                                <td>
                                    <?php show_dpf_gpf_status($lists['applied_amnt_adv_status']); ?>
                                </td>
                                <td>
                                    <?php
                                    if($this->uri->segment(2)  == 'app_list' && $lists['applied_amnt_adv_status']  == '2' && $file_details->file_received_emp_id == $curr_emp) { ?>
                                     <button class="btn btn-block btn-sm btn-primary" data-toggle="tooltip" title="click here" onclick="open_model_generate_file(<?php echo $lists['pay_id'] ; ?> , <?php echo $lists['pay_file_id'] ; ?>);">क्लिक करें </button>
                                    <?php } else if($lists['applied_amnt_adv_status']  == '1') { ?>
                                    <button class="btn btn-block btn-sm btn-primary" data-toggle="tooltip" title="click here" onclick="open_model_work_app(<?php echo $lists['pay_id'] ; ?>);">क्लिक करें </button>
                                    <?php }else{ ?>
                                    <?php if($this->uri->segment(2)  == 'app_list'){ ?>
                                        <a href="<?php echo base_url(); ?>view_file/viewdetails/<?php echo$lists['pay_file_id'] ; ?>" class="btn btn-sm btn-block btn-primary">नस्ती की जानकारी</a>
                                        <?php } ?>
                                        <a href="<?php echo base_url(); ?>est_service_module/dispaly_application/<?php echo $lists['pay_id'] ; ?>" class="btn btn-sm btn-block btn-primary">आवेदन देखे</a>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                    </table>

                </div><!-- /.box -->
            </div>
        </div><!-- /.row -->
        <!-- Main row -->
</section><!-- /.content -->
<script>
    function open_model_work_app(pay_id){
        var pay_id = pay_id;
        $('#show_payid').html('Application id : '+pay_id);
        $('#modal-application_work').modal('show');
        $('#send_file1').attr('href','<?php echo base_url()?>est_service_module/create_file_application/'+pay_id);
        $('#receive_file1').attr('href','<?php echo base_url()?>est_service_module/create_file_application/'+pay_id);
        $('.dispaly_app').attr('href','<?php echo base_url()?>est_service_module/dispaly_application/'+pay_id);
        $('#modify_app').attr('href','<?php echo base_url()?>establishment/edit_service_forms/'+pay_id);
    }

    function open_model_generate_file(pay_id , fileid){
        var pay_id = pay_id;
        var fileid = fileid;
        $('#show_payid2').html('Application id : '+pay_id);
        $('#show_fileid').html('File id : '+fileid);
        $('#modal-file_work').modal('show');
        $('#dispaly_file1').attr('href','<?php echo base_url()?>view_file/viewdetails/'+fileid);
        $('.dispaly_app').attr('href','<?php echo base_url()?>est_service_module/dispaly_application/'+pay_id);
     /*  $('#send_notesheet').attr('href','<?php// echo base_url() ?>admin_notesheet_master/view_file_notesheet/203/7/'+fileid+'?pay_id='+pay_id); */
        $('#send_notesheet').attr('href','<?php echo base_url() ?>est_service_module/create_notesheet_app?file_id='+fileid+'&&pay_id='+pay_id);
    }
</script>
<!--receive model-->

<div class="modal fade" id="modal-application_work" data-backdrop="static">
    <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">आवेदन पर कार्य करें </h4>
                </div>
                <div class="modal-body">
                    <div class="box-body table-responsive">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <div class="col-md-4"><a id="send_file1" onclick="return confirm_receive()" class="btn btn-block btn-primary">स्थापना में भेजे</a></div>
                                        <div class="col-md-4"><a type="button" class="btn btn-block btn-primary dispaly_app">आवेदन देखे</a></div>
                                        <div class="col-md-4"><a id="modify_app" type="button" class="btn btn-block btn-primary">बदलाव करें</a></div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
                <div class="modal-footer">
                    <span id="show_payid" class="pull-left"></span>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                </div>
            </div>
    </div>
</div>
<!--End-->
<!--receive model-->
<div class="modal fade" id="modal-file_work" data-backdrop="static">
    <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">नस्ती पर कार्यवाही करें </h4>
                </div>
                <div class="modal-body">
                    <div class="box-body table-responsive">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <div class="col-md-5"><a id="send_notesheet" onclick="return confirm('क्या आप नस्ती को प्राप्त कर नोटशीट संलग्न करना चाहते है  | ')" class="btn btn-block btn-primary">प्राप्त / नोटशीट संलग्न करें</a></div>
                                        <div class="col-md-4"><a id="dispaly_file1" type="button" class="btn btn-block btn-primary">नस्ती की जानकारी</a></div>
                                        <div class="col-md-3"><a type="button" class="btn btn-block btn-primary dispaly_app">आवेदन देखे</a></div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
                <div class="modal-footer">
                    <span id="show_payid2" class="pull-left"></span> &nbsp;&nbsp; <span id="show_fileid" class="pull-left"></span>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                </div>
            </div>
    </div>
</div>
<!--End-->