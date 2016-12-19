<link href="<?php echo ADMIN_THEME_PATH; ?>plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo $title; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo $title; ?></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Your Page Content Here -->
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box" style="overflow: auto" id="divname">
                <div class="box-header">
                    <div style="float:left"><h3 class="box-title"><?php echo $title_tab;?></h3></div>
                    <div style="float:right">
                        <!--<button class="btn btn-block btn-info"><?php echo $this->lang->line('view_file_mark');?></button>-->
                        <!--<a class="btn btn-info"><?php echo $this->lang->line('view_file_mark');?></a>-->
						<button onclick="printContents('divname')" class="btn btn-primary no-print">Print</button>
                        <button class="btn btn-warning" onclick="goBack()"><?php echo $this->lang->line('Back_button_label'); ?></button>
                    </div>
                    <br/>
                </div><!-- /.box-header -->
                <?php // echo $this->session->flashdata('message'); ?>
                <?php if($this->session->flashdata('message') || $this->session->flashdata('error')) {
                    $msg = $this->session->flashdata('message') ? 'success' : 'danger';
                    ?>
                    <div class="alert alert-<?php echo $msg; ?> alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>
                            <?php  echo $this->session->flashdata('message');
                            echo $this->session->flashdata('error'); ?>
                        </strong>
                        <br/>
                    </div>
                <?php }?>
                <?php if(emp_session_id() != $this->session->userdata('emp_id')){
                    $em =  empdetails(emp_session_id());
                    ?>
                    <div class="callout callout-info lead">
                        <p>आप <b><?php echo $em[0]['emp_full_name_hi'] ." (". getemployeeRole($em[0]['role_id']).")" ;?></b> को अंकित की गई फाइलें देख रहे है |</p>
                    </div>
                <?php  } ?>
                <div class="box-body" align="center">
                    <form method="post">
                        <?php $empssection = empdetails(emp_session_id());
                        if(isset($page1)) {$p1 = '/'.$page1;} else { $p1 = null;}
                        $i=1; foreach(explode(",",$empssection[0]['emp_section_id'])  as $empsec){
                            if ($i%2 == 1) { $cls = "class='btn bg-purple btn-flat margin'"; }else{ $cls = "class='btn bg-maroon btn-flat margin'"; }
                            if (isset($empsec)) {
if($empsec != '26')		{					?>
                                <!--  <button value="<?php echo $empsec ; ?>" name="section_ids" type="submit" <?php echo $cls ; ?>><?php echo getSection($empsec) ; ?></button>-->
                                <a href="<?php echo base_url().'view_file/Dispaly_list'.$p1.'/?section_id='.$empsec ; ?>" <?php echo $cls ; ?>><?php echo getSection($empsec) ; ?></a>
                            <?php }	} $i++; }?>
                        <a href="<?php echo base_url().'view_file/Dispaly_list'.$p1.'/?section_id=oth' ; ?>" <?php echo $cls ; ?>>(अन्य फाइलें) Other files</a>
                    </form>
                </div>
                <table id="view_table" class="table table-bordered">
                    <thead>
                    <tr>
                        <!--<th><button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button></th>-->
                        <th><?php echo $this->lang->line('sno'); ?></th>
                        <th><?php echo $this->lang->line('view_file_subject'); ?></th>
                        <th><?php echo $this->lang->line('uo/letter_no'); ?></th>
                        <th><?php echo $this->lang->line('view_file_uo_letter_date'); ?></th>
                        <th><?php echo $this->lang->line('section_no1'); ?></th>
                        <th><?php echo $this->lang->line('view_file_mark_section_id'); ?></th>
                        <th>विभाग</th>
                        <th><?php echo $this->lang->line('date'); ?></th>
                        <th class="no-print"><?php echo $this->lang->line('filestatus'); ?></th>
                        <th class="no-print"><?php echo $this->lang->line('actions'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(isset($get_files)) {
                        $i=1; foreach ($get_files as $key => $files) { ?>
                            <tr onClick="showcomp(<?php echo $files->file_id; ; ?>)">
                                <!--<td><input type="checkbox" /></td>-->
                                <td><?php echo $i;?> (<?php echo $this->lang->line('file_no'); ?> : <?php echo $files->file_id;?>)</td>
                                <td><?php echo $files->file_subject;?></td>
                                <td><?php echo $files->file_uo_or_letter_no; ?> (<?php echo getFileType($files->file_type) ;?>)</td>
                                <td><?php echo date_format(date_create($files->file_uo_or_letter_date), 'd/m/y'); ?></td>
                                <td><?php echo @getfilesec_id_byfileid($files->file_id,$files->file_mark_section_id,$files->file_type) ? getfilesec_id_byfileid($files->file_id,$files->file_mark_section_id,$files->file_type) : 'N/A'; ?></td>
                                <td><?php echo @getSection($files->file_mark_section_id) ? getSection($files->file_mark_section_id) : 'N/A'; ?></td>
                                <td><?php
                                    $file_from = file_from_type();
                                    $high_bench =  highcourt_bench();
                                    echo   $files->file_Offer_by == 'c' || $files->file_Offer_by == 'jvn' ? $file_from[$files->file_Offer_by] ." , ". $files->district_name_hi : false ;
                                    echo    $files->file_Offer_by == 'm' || $files->file_Offer_by == 'u' ? $file_from[$files->file_Offer_by] ." , ". $high_bench[$files->court_bench_id] : false ;
                                    echo    $files->file_Offer_by == 'v' || $files->dept_name_hi ? $file_from[$files->file_Offer_by] ." , ". $files->dept_name_hi ." ".$files->file_department_name : $files->file_department_name;

                                    ?>
                                </td>
                                <td class="no-print"><?php echo date_format(date_create($files->file_update_date), 'd/m/y'); ?>
                                    (<?php if($files->file_hardcopy_status == 'not'){ echo $this->lang->line('mark_date');} else { echo $this->lang->line('received_date');} ?>)
                                </td>
                                <td align="" class="no-print"><?php
                                    $filereceiver = get_user_details($files->file_received_emp_id);
                                    if ($filereceiver)
                                    {
										if($files->file_hardcopy_status == 'not') {
											echo file_not_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi);
										} else if($files->file_hardcopy_status == 'close') {
											echo file_closed_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi, $files->file_type);
										} else{
											echo file_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi);
										}
                                        /*if($files->file_hardcopy_status == 'not') {
                                            echo "<span style='color:#dd4b39' >Not Received by <b> ".ucfirst($filereceiver[0]->emp_full_name)."</b><br/>(".$filereceiver[0]->emprole_name_hi.")</span>";
                                        } else {
                                            echo "<span style='color:#00a65a' >Received by <b> ".ucfirst($filereceiver[0]->emp_full_name)."</b><br/>(".$filereceiver[0]->emprole_name_hi.")</span>";
                                        }  */
									} ?></td>
                                <td align="center" class="no-print">
                                    <?php $senderemp = empdetails($files->file_sender_emp_id);
                                    //  echo   $files->file_hardcopy_status == 'received' && emp_session_id() == $files->file_received_emp_id && emp_session_id() != '2' ? '<a onclick="return confirm_send()" href="'.base_url().'manage_file/Send_file_us/'.$files->file_id.'" class="btn btn-sm btn-block btn-info">'.$this->lang->line('send_file_officer').'</a>' : false;
                                    echo   $files->file_hardcopy_status == 'received' && emp_session_id() == $files->file_received_emp_id && emp_session_id() != '2' ? '<button onclick="open_model2('.$files->file_id.')" value="'.$files->file_id.'" data-toggle="tooltip" data-original-title="Send file to officer" class="btn btn-sm btn-block btn-info upperuser">'.$this->lang->line('send_file_officer').'</button>' : false;
                                    echo   $files->file_hardcopy_status == 'received' && emp_session_id() == $files->file_received_emp_id ? '<button onclick="open_model('.$files->file_id.')" value="'.$files->file_id.'" class="btn btn-sm btn-block btn-danger rty" data-original-title="Return File">वापस भेंजे</button>' : false;
                                    //  echo   $files->file_hardcopy_status == 'not' && emp_session_id() == $files->file_received_emp_id ? '<a onclick="return confirm_receive()" href="'.base_url().'manage_file/receive_by_officer/'.$files->file_id.'" class="btn  btn-twitter"><span class="blink_fast">'.$this->lang->line('receive_file').'</span></a>' : false;
                                    echo   $files->file_hardcopy_status == 'not' && emp_session_id() == $files->file_received_emp_id ? '<button onclick="open_model3('.$files->file_id.')" class="btn btn-twitter"><span class="blink_fast">'.$this->lang->line('receive_file').'</span></button>' : false;
                                    ?>
                                    <input type="hidden" class="mark_sec" value="<?php echo $files->file_mark_section_id ; ?>">
                                </td>
                            </tr>
                            <?php $i++; } } else {
                        echo "Plz first a section";
                    }
                    ?>
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.row -->
    <!-- Main row -->
</section><!-- /.content -->
<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<!-- Page Script -->
<script>
    $(function () {
        $('input[type="checkbox"]').iCheck({
            checkboxClass: 'icheckbox_flat-blue',
            radioClass: 'iradio_flat-blue'
        });
       /* Enable check and uncheck all functionality*/
        $(".checkbox-toggle").click(function () {
            var clicks = $(this).data('clicks');
            if (clicks) {
               /* Uncheck all checkboxes*/
                $("input[type='checkbox']").iCheck("uncheck");
                $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
            } else {
               /* Check all checkboxes*/
                $("input[type='checkbox']").iCheck("check");
                $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
            }
            $(this).data("clicks", !clicks);
        });
        /*Handle starring for glyphicon and font awesome*/
        $(".mailbox-star").click(function (e) {
            e.preventDefault();
           /* detect type*/
            var $this = $(this).find("a > i");
            var glyph = $this.hasClass("glyphicon");
            var fa = $this.hasClass("fa");
            /*Switch states*/
            if (glyph) {
                $this.toggleClass("glyphicon-star");
                $this.toggleClass("glyphicon-star-empty");
            }
            if (fa) {
                $this.toggleClass("fa-star");
                $this.toggleClass("fa-star-o");
            }
        });
        /*Get user name*/
        $(".rty").click(function () {
            var file_id = $(this).val();
            var mark_sec = $('.mark_sec').val();
            var HTTP_PATH='<?php echo base_url(); ?>';
            $.ajax({
                type: "POST",
                url: HTTP_PATH + "view_file/return_fileofficer/"+file_id,
                datatype: "json",
                async: false,
                data: {file_id: file_id},
                success: function(data) {
                    var r_data = JSON.parse(data);
                    var otpt = '<select class="form-control" name="emp_id">';
                    $.each(r_data, function( index, value ) {
                        if(value.role_id == 8 || value.role_id == 37){
                            var secname = value.section_name_hi;
                        }else{
                            var secname = '';
                        }
                        otpt += '<option value="'+value.emp_id+'">'+value.emp_full_name_hi+' ('+value.emprole_name_hi+')  '+secname+'</option>';
                    });
                    otpt += '</select>';
                    $("#emp_byfile").html(otpt);
                }
            });
        });

        /*Get upper user name*/
        $(".upperuser").click(function () {
            var file_id = $(this).val();
            var HTTP_PATH='<?php echo base_url(); ?>';
            $.ajax({
                type: "POST",
                url: HTTP_PATH + "view_file/upper_role_officer/"+file_id,
                datatype: "json",
                async: false,
                data: {file_id: file_id},
                success: function(data) {
                    var r_data = JSON.parse(data);
                    var otpt1 = '<select class="form-control" name="emp_id2">';
                    $.each(r_data, function( index, value ) {
                        otpt1 += '<option value="'+value.emp_id+'">'+value.emp_full_name+' ('+value.emprole_name_hi+')</option>';
                    });
                    otpt1 += '</select>';
                    $("#emp_byfile2").html(otpt1);
                }
            });
        });
    });
  /*   function showcomp(comp1)
        {
          var comp2 = comp1;
          alert(comp2);
    window.location='resolution_comp.php?comp1='+comp1;
      }*/
    function open_model(file){
        var file1 = file;
        $('#modal-id').val(file1);
        $('#modal-delete').modal('show');
    }
    function open_model2(file){
        var file2 = file;
        $('#modal-id2').val(file2);
        $('#modal-send_upper').modal('show');
    }
    function open_model3(file){
        var file3 = file;
        $('#modal-receive_file').modal('show');
        $('#receive_file1').attr('action','<?php echo base_url() ;?>manage_file/receive_by_officer/'+file3);
    }
</script>

<div class="modal fade" id="modal-delete" data-backdrop="static">
    <div class="modal-dialog">
        <form action="<?php echo base_url() ;?>manage_file/return_file" method="post" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-edit"></i> Enter Remark </h4>
                </div>
                <div class="modal-body">
                    <div class="box-body table-responsive">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <input type="hidden" id="modal-id" name="fileids">
                                    <textarea class="form-control" rows="3" placeholder="Enter ..." id="modal-id" name="rmk1"></textarea>
                                    <br/>
                                    <div id="emp_byfile"></div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i>Cancel</button>
                    <button id="btn-delete" onclick="return confirm_send()" type="submit" class="btn btn-primary load_btn"><i class="fa fa-check"></i>Send</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!--raginee-->
<div class="modal fade" id="modal-send_upper" data-backdrop="static">
    <div class="modal-dialog">
        <form action="<?php echo base_url() ;?>manage_file/Sendfile_upperofficer" method="post" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-edit"></i> Enter Remark </h4>
                </div>
                <div class="modal-body">
                    <div class="box-body table-responsive">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <input type="hidden" id="modal-id2" name="fileids2">
                                    <textarea class="form-control" rows="3" placeholder="Enter ..." id="modal-id" name="rmk1"></textarea>
                                    <br/>
                                    <div id="emp_byfile2"></div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i>Cancel</button>
                    <button id="btn-delete" onclick="return confirm_send()" type="submit" class="btn btn-primary load_btn"><i class="fa fa-check"></i>Send</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!--End-->
<!--receive model-->
<div class="modal fade" id="modal-receive_file" data-backdrop="static">
    <div class="modal-dialog">
        <form method="post" id="receive_file1">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-male"></i> फ़ाइल देने वाले का नाम</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body table-responsive">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="exampleInputFile">File given by</label>
                                        <input type="text" id="carry_fileemp_name" name="carry_fileemp_name" placeholder="Put name here"  class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                    <button id="btn-delete" onclick="return confirm_receive()" type="submit" class="btn btn-primary"><i class="fa fa-check blink"></i> Receive</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!--End-->
<style type="text/css">
    #leave_employee_filter{
        clear: both;
    }
</style>
