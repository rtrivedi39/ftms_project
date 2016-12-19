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
                            <th>बिल</th>
                            <th>बिल के भुगतान माह</th>
                            <th>अपेक्षित राशि</th>
                            <th>स्थिति</th>
                            <th>कार्यवाही</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i=1; foreach ($app_list as $key => $lists) {
                            $file_details = getFileDetails($lists['bill_file_id']);
                            $curr_emp = emp_session_id(); ?>
                            <tr>
                                <td><?php echo $i ?> -
                                    <?php echo $lists['bill_file_id'] ; ?>
                                </td>
                                <td>
                                    <?php echo $lists['bill_emp_name'] ; ?><br/>
                                    <?php echo $lists['bill_emp_unique_id'] ; ?><br/>
                                    <?php echo $lists['bill_emp_designation'] ; ?>
                                </td>
                                <td><?php echo $lists['bill_for'] ; ?></td>
                                <td><?php // echo $lists['bill_apply_month'] ; ?>
                                    <?php
                                    $monts =    explode(',',$lists['bill_apply_month']) ;
                                    $from_date =    explode(',',$lists['bill_from_date']) ;
                                    $to_date =    explode(',',$lists['bill_to_date']) ;
                                    foreach($monts as $key => $mont){
                                        $mnt = explode('-',$mont);
                                        echo months($mnt['0'] , true)." / " .$mnt['1'] ;
                                        echo ' : ( '.$from_date[$key].' to '.$to_date[$key] .' )';
                                        echo '  <br/>';
                                    }  ?>

                                </td>
                                <td><?php /*echo $lists['bill_apply_amt'] ; */?><!-- (--><?php /*echo $lists['bill_apply_amt_words'] ; */?>

                                    <?php
                                    $bill_apply = explode(',',$lists['bill_apply_amt']) ;
                                    $bill_words = explode(',',$lists['bill_apply_amt_words']) ;
                                    $bill_approve = explode(',',$lists['bill_approve_amount']) ;
                                    foreach($bill_apply as $key => $bill_amt){
                                        echo $bill_amt.' /-  (' .$bill_words[$key]. ') <br/>' ;
                                        if(isset($bill_approve[$key])){
										echo '<b> ( स्वीकृत राशि   '.$bill_approve[$key] .' /- ) </b>'	;
											}
                                        echo "<br/>"; }
                                    ?>
                                </td>
                                <td>
                                    <?php show_dpf_gpf_status($lists['bill_status']); ?>
                                </td>
                                <td>
                                    <?php
									 $id1 = explode(',',$lists['id']) ;
                                    if($this->uri->segment(2)  == 'bill_list' && $lists['bill_status']  == '2' && $file_details->file_received_emp_id == $curr_emp) { ?>
                                        <button class="btn btn-block btn-sm btn-primary" data-toggle="tooltip" title="click here" onclick="open_model_generate_file( '<?php echo $lists['id'] ; ?>' , '<?php echo $lists['bill_file_id'] ; ?>' , '<?php echo $file_details->file_hardcopy_status ?>' , <?php echo $lists['bill_sub_catid'] ; ?>);">क्लिक करें </button>
                                    <?php } else if($lists['bill_status']  == '1') { ?>
                                        <button class="btn btn-block btn-sm btn-primary" data-toggle="tooltip" title="click here" onclick="open_model_work_bill('<?php echo $lists['id'] ; ?>');">क्लिक करें </button>
                                    <?php }else{ ?>
                                        <?php if($this->uri->segment(2)  == 'bill_list'){ ?>
                                            <a href="<?php echo base_url(); ?>view_file/viewdetails/<?php echo $lists['bill_file_id'] ; ?>" class="btn btn-sm btn-block btn-primary">नस्ती की जानकारी</a>
                                        <?php  foreach($id1 as $key => $id){
                                            $mnt_d = explode('-',$monts[$key]);    ?>
                                        <button  class="btn btn-block btn-sm btn-primary" onclick="for_close_bill('<?php echo $id; ?>' , '<?php echo $lists['bill_file_id'] ; ?>')">Update <?php echo months($monts[$key]['0'] , true) ; ?></button>	
                                        <?php  }  ?>
									    <!--<a href="<?php // echo base_url(); ?>est_service_module/local_bill_manage/work_for_bill/file_id='<?php // echo $lists['bill_file_id'] ; ?>'&&bill_id='<?php// echo $lists['id'] ; ?>'" class="btn btn-sm btn-block btn-danger disabled">कार्यवाही पूर्ण</a>-->
										<?php } } 
                                         foreach($id1 as $key => $id){
                                         $mnt_d = explode('-',$monts[$key]);    ?>
                                            <a href="<?php echo base_url(); ?>est_service_module/dispaly_bill_view/<?php echo $id ; ?>" class="btn btn-sm btn-block btn-primary">आवेदन  &nbsp <?php echo months($monts[$key]['0'] , true) ; ?></a>
                                        <?php  }  ?>                            
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
    function open_model_work_bill(bill_id){
        var bill_id = bill_id;
        $('#show_payid').html('Application id : '+bill_id);
        $('#modal-application_work').modal('show');
        $('#send_file1').attr('href','<?php echo base_url()?>est_service_module/create_file_for_bill/'+bill_id);
        $('#receive_file1').attr('href','<?php echo base_url()?>est_service_module/create_file_application/'+bill_id);
        $('.dispaly_app').attr('href','<?php echo base_url()?>est_service_module/dispaly_bill_view/'+bill_id);
        $('#modify_app').attr('href','<?php echo base_url()?>establishment/edit_bill_forms/'+bill_id);
    }

    function open_model_generate_file(bill_id , fileid , status , bill_sub_cat){
        var bill_id = bill_id;
        var fileid = fileid;
        var file_status = status;
        var bill_sub_cat = bill_sub_cat;
        $('#show_payid2').html('Application id : '+bill_id);
        $('#show_fileid').html('File id : '+fileid);
        $('#modal-file_work').modal('show');
        $('#dispaly_file1').attr('href','<?php echo base_url()?>view_file/viewdetails/'+fileid);
        $('.dispaly_app').attr('href','<?php echo base_url()?>est_service_module/dispaly_bill_view/'+bill_id);
        /*  $('#send_notesheet').attr('href','<?php// echo base_url() ?>admin_notesheet_master/view_file_notesheet/203/7/'+fileid+'?pay_id='+pay_id); */
        $('#send_notesheet').attr('href','<?php echo base_url() ?>est_service_module/create_notesheet_for_bill?file_id='+fileid+'&&bill_id='+bill_id+'&&file_status='+file_status+'&&bill_sub_cat='+bill_sub_cat);
    }

    function for_close_bill(bill_id , fileid ){
        var bill_id = bill_id;
        var fileid = fileid;
        $('#bill1').val(bill_id);
        $('#file1').val(fileid);
        $('#modal-close_bill').modal('show');
        $('#update_bill').attr('action','<?php echo base_url()?>est_service_module/local_bill_manage/update_bill_status');
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
                <h4 class="modal-title">नस्ती पर कर्यवाही करें </h4>
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

<!--close bill-->

<div class="modal fade" id="modal-close_bill" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">आवेदन पर कार्य करें </h4>
            </div>
            <form method="post" id="update_bill">
                <div class="modal-body">
                    <div class="box-body table-responsive">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">स्वीकृत राशि</label>
                                        <input type="text" class="form-control" id="approve_amt" name="approve_amt" placeholder="स्वीकृत राशि" value="" required="" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">status</label>
                                        <select class="form-control" name="bill_status">
                                            <option value="">चयन करे </option>
                                            <option value="5"> क्लोज </option>
                                        </select>
                                    </div>
                                    <input type="hidden" id="bill1" name="bill1"/>
                                    <input type="hidden" id="file1" name="file1"/>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                    <button type="submit" class="btn btn-primary"> Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--End-->