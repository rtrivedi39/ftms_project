<?php
if(isset($billdetails) && $billdetails != ''){
    $uri4 = $billdetails['bill_sub_catid'];
}else{
    $uri2 =  $this->uri->segment(2);
    $uri3 =  $this->uri->segment(3);
    $uri4 = $this->uri->segment(4);
} ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo $title; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo $title_tab; ?></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
<!-- Your Page Content Here -->
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-xs-12 ">
        <div class="box">
            <div class="box-header">
                <div style="float:left"><h3 class="box-title"><?php echo $get_bill_single['category_title_hin']; ?></h3></div>
                <button class="btn btn-warning" title="Back" onclick="goBack()" style="float:right"><?php echo $this->lang->line('Back_button_label'); ?></button>
            </div>
        </div><!-- /.box-header -->
        <?php if($this->session->flashdata('message') || $this->session->flashdata('error')) {
            $msg = $this->session->flashdata('message') ? 'success' : 'danger';
            ?>
            <div class="alert alert-<?php echo $msg; ?> alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>
                    <?php  echo $this->session->flashdata('message');
                    echo $this->session->flashdata('error'); ?>
                </strong><br>
            </div>
        <?php }?>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <!-- general form elements -->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">बिल के भुगतान हेतु |</h3>
            </div><!-- /.box-header -->
            <!-- form start -->

            <form role="form" method="post" action="<?php echo base_url()?>est_service_module/manage_out_bill_byfile"  enctype="multipart/form-data">
                <div class="box-body">

                    <div class="form-group" id="month_div">
                        <label>बिल के भुगतान माह </label>
                        <div class="row">
                            <div class="col-xs-6"><input type="text" name="frm_dt" id="frm_dt" value="<?php echo $billdetails['bill_from_date']  ? date_format(date_create($billdetails['bill_from_date']), 'd-m-Y') : '' ?>" placeholder="कब से" class="form-control date1" required></div>
                            <div class="col-xs-6"><input type="text" name="to_dt" id="to_dt" value="<?php echo $billdetails['bill_to_date']  ? date_format(date_create($billdetails['bill_to_date']), 'd-m-Y') : '' ?>" placeholder="कब तक" class="form-control date1" required></div>
                        </div>
                        <div id="error_month_txt" class="text-danger"></div>
                    </div>


                    <?php if(isset($billdetails) && !empty($billdetails)){ }else{ ?>
                        <?php if($get_bill_single['master_category_id'] != '127'){ ?>
                            <div class="form-group">
                                <!--<div style="float: right">-->
                                <button type="button" id="add_multi_btn" class="btn btn-sm btn-success" ><i class='fa fa-fw fa-plus'></i> एम्पलाई  जोड़ें</button>
                                <button type="button" id="remove1" class="btn btn-sm btn-danger remove1" style="display: none"><i class="fa fa-fw fa-minus"></i> एम्पलाई  हटाये</button>
                                <!--</div>-->
                            </div>
                        <?php  } } ?>


                    <div class="form-group">
                        <?php $mark_to_officer = get_officers_list(); ?>
                        <div class="col-xs-2"></div>
                        <div class="col-xs-4">एम्पलाई चयन करे</div>
                        <div class="col-xs-4">
                            <select class="form-control" name="emp_search[]" id="emp_search" onchange="selectEmployee_name_bill( null ,this.value)">
                                <option value="">चयन</option>
                                <?php foreach($mark_to_officer as $offrow){ ?>
                                    <option value="<?php echo $offrow['emp_id']; ?>"><?php echo getemployeeName($offrow['emp_id'], true).", ".getemployeeRole($offrow['role_id']); ?></option>
                                <?php } ?>
                            </select>

                           <!-- <input autocomplete="off" class="form-control" name="applicant_emp_code_search" id="applicant_emp_code_search" placeholder="खोजे" />
                          -->
                        </div>
                    </div>
                    <!---add multiple data start-->

                    <div id="display_multiple" class="display_multiple">

                        <input type="hidden" name="applicant_emp_id[]" id="applicant_emp_id" required="" value="<?php echo $billdetails['bill_emp_id']  ? $billdetails['bill_emp_id'] : '' ?>" >

                        <div class="form-group">
                            <label for="exampleInputEmail1">नाम / एम्पलाई कोड</label>
                            <div class="row">
                                <div class="col-xs-6">
                                    <input type="text" class="form-control" id="applicant_name" name="applicant_name[]" placeholder="नाम" required="" value="<?php echo $billdetails['bill_emp_name']  ? $billdetails['bill_emp_name'] : '' ?>" >
                                </div>
                                <div class="col-xs-6">
                                    <input type="text" class="form-control" id="applicant_emp_code" name="applicant_emp_code[]" placeholder="कोड" required="" value="<?php echo $billdetails['bill_emp_unique_id']  ? $billdetails['bill_emp_unique_id'] : '' ?>">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">पद नाम</label>
                            <input type="text" class="form-control" id="applicant_designation" name="applicant_designation[]" placeholder="पद" required="" value="<?php echo $billdetails['bill_emp_designation']  ? $billdetails['bill_emp_designation'] : '' ?>">
                        </div>

                        <div class="form-group" id="div_mobile_no">
                            <label for="exampleInputEmail1">नंबर</label>
                            <input type="text" class="form-control" id="app_mobile_number" name="app_mobile_number[]" placeholder="नंबर" value="<?php echo $billdetails['bill_mobile_no']  ? $billdetails['bill_mobile_no'] : '' ?>" required="">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">राशि</label>
                            <div class="row">
                                <div class="col-xs-4">
                                    <input type="text" required class="form-control" id="app_apply_amount" name="app_apply_amount[]" placeholder="राशि" autocomplete="off" value="<?php echo $billdetails['bill_apply_amt']  ? $billdetails['bill_apply_amt'] : '' ?>"/>
                                </div>
                                <div class="col-xs-8">
                                    <input type="text" required class="form-control" name="applied_amount_adv_words[]" id="applied_amount_adv_words" placeholder="<?php echo "राशि शब्दों में लिखे"; ?>" value="<?php echo $billdetails['bill_apply_amt_words']  ? $billdetails['bill_apply_amt_words'] : '' ?>"/>
                                </div>
                            </div>
                            <div id="show_msg_ac"></div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-6">
                                    <label for="exampleInputPassword1">पात्रता</label>
                                    <input type="text" required class="form-control" id="eligible_amount" name="eligible_amount[]" placeholder="राशि" value="<?php echo $billdetails['bill_apply_amt']  ? $billdetails['bill_apply_amt'] : '' ?>"/>
                                </div>
                                <div class="col-xs-6">
                                    <label for="exampleInputPassword1">पात्रता से अधिक वसूली</label>
                                    <input type="text" required class="form-control" name="more_eligible_amount[]" id="more_eligible_amount" placeholder="<?php echo "राशि शब्दों में लिखे"; ?>" value="<?php echo $billdetails['bill_apply_amt_words']  ? $billdetails['bill_apply_amt_words'] : '' ?>"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group" id="div_description">
                            <label for="exampleInputEmail1">बिल का विवरण</label>
                            <textarea  id="app_bill_description" name="app_bill_description" class="form-control"></textarea>
                        </div>

                    </div>

                    <div id="add_multi_src" ></div>

                    <div class="form-group">
                        <label for="exampleInputFile">बिल की स्लिप संलग्न करें</label>
                        <input type="file" name="attachment1" id="attachment1" required="">
                    </div>
                    <!---add multiple data end-->
                </div><!-- /.box-body -->

                <input type="hidden" value="<?php echo $this->session->userdata('emp_id'); ?>" name="apply_emp_id" id="apply_emp_id" />
                <input type="hidden" value="<?php echo $get_bill_single['category_title_hin']; ?>" name="app_bill_for" id="app_bill_for" />
                <input type="hidden" value="<?php echo $billdetails['bill_sub_catid']  ? $billdetails['bill_sub_catid'] : $uri4 ; ?>" name="sub_master_id" id="sub_master_id" />

                <input type="text" value="<?php echo $_GET['file_id']  ? $_GET['file_id'] : null ; ?>" name="bill_file_id" id="bill_file_id" />

                <div class="box-footer" id="div_hide">
                    <?php if(isset($billdetails) && !empty($billdetails)){ ?>
                        <input type="text" name="bill_id" id="bill_id" value="<?php echo $billdetails['id']; ?>" />
                        <button class="btn btn-primary margin" onclick="return confirm_receive()" name="process_type" value="modify_app" type="submit"><?php echo "बदलाव करे"; ?></button>
                    <?php }else{ ?>
                            <button class="btn btn-primary margin" onclick="return confirm_receive()" name="process_type" value="add_on_file" type="submit"><?php echo "स्थापना में जमा करें"; ?></button>
                    <?php	} ?>
                </div>

        </div><!-- /.box -->
    </div>
    <div class="col-md-6">
        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">आवेदक की जानकारी</h3>
            </div>
            <div class="box-body">

                <div class="form-group">
                    <label for="exampleInputEmail1">बिल</label>
                    <select class="form-control" id="type_of_bill" name="type_of_bill" required="">
                        <!--<option value="">बिल का चयन करे </option>-->
                        <?php foreach($get_category_bill as $get_bill){ ?>
                            <option value="<?php echo $get_bill['master_category_id'] ;?>"><?php echo $get_bill['category_title_hin'] ;?> (<?php echo $get_bill['category_title_en'] ;?>)</option>
                        <?php } ?>
                    </select>
                </div>

                <hr/>

                <!--  <div class="box-header">
                        <h3 class="box-title">आवेदन के नियम</h3>                        
                        <button type="button" class="btn pull-right" onclick="open_rules_pdf(<?php echo $get_bill_single['master_category_id'] ; ?>)"><i class="fa fa-fw fa-paperclip"></i> संलग्न प्रति </button>
                    </div>
                    <div class="row">
                        <?php foreach($get_category_bill_con as $get_category_bill_con1){ ?>
                            <div class="col-md-12">
                                <div class="box box-warning box-solid">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">
                                            <?php
                    if($get_category_bill_con1['con_mst_apply_on'] == 5){
                        echo "<div class='pull-right'>न्यायिक अधिकारी </span>";
                    }elseif($get_category_bill_con1['con_mst_apply_on'] == 999){
                        echo "<div class='pull-right'>अन्य </span>";
                    } ?></h3>
                                        <div class=" pull-right"><b> <?php echo  $get_category_bill_con1['con_time_limit'] ; ?> </b></div>
                                    </div>
                                    <div class="box-body">
                                        <b><?php echo "<span id='mst_condition_".$get_category_bill_con1['con_mst_apply_on']."' class='mst_condition'>".$get_category_bill_con1['con_condition']."</span> <span id='mst_con_type_".$get_category_bill_con1['con_mst_apply_on']."' class='mst_con_type'>".$get_category_bill_con1['con_type'] ; ?></span></b>
                                    </div>
                                </div>
                            </div>
                        <?php  }  ?>
                    </div>   -->
                            </div><!-- /.box-body -->
        </div><!-- /.box -->
        <div id="rules_pdf_div"></div>
    </div>
</div><!-- /.box -->
</form>

</section><!-- /.content -->
<?php $this->load->view("empcode_autosuggetion"); ?>
<script>
    $('#is_attachment_change').change(function(){
        if($('#is_attachment_change').is(':checked')){
            $("#attachment1").prop('required', false);
        }else{
            $("#attachment1").prop('required', true);
        }
    });
    $(document).ready(function(){

        var month1 = '<?php echo json_encode(months(null,true)) ?>';
        var curr_yr = '<?php echo date("Y") ?>';
        var curr_month = '<?php echo date("m") ?>';
        var month2 = JSON.parse(month1);
        var master_category_id = '<?php echo $get_bill_single['master_category_id'] ; ?>';
        var bill_petrol_lit = '<?php echo $billdetails['bill_petrol_lit ']  ? $billdetails['bill_petrol_lit'] : '' ?>' ;
        var incr = 1;
        var x = 0;
        var mark_to_officer = '<?php echo json_encode($mark_to_officer) ?>';
        var mark_to_officer_j = JSON.parse(mark_to_officer) ;


        $('#add_multi_btn').on('click', function() {
            if(incr <= 4) {
                $("#only_save").hide();
                $("#remove1").show();

                var content1 = '<hr/>';
                content1 += '<div class="form-group'+incr+'"><div class="col-xs-2"></div><div class="col-xs-4">एम्पलाई चयन करे</div>';
                content1 += '<div class="col-xs-4">';
                content1 += '<select name="emp_search[]" id="emp_search'+incr+'" class="form-control" onchange="selectEmployee_name_bill( null ,this.value , '+incr+')">';
                content1 += '<option value="">चयन</option>';
                $.each(mark_to_officer_j, function( index, value ) {
                    content1 +=  '<option value="'+value.emp_id+'">'+value.emp_title_hi+' '+value.emp_full_name_hi+'</option>';
                });
                content1 += '</select>';
                content1 += '</div>';
                content1 += '</div></div><div class="multiple_div" id="multiple_div'+incr+'" ></div>';
                $('#add_multi_src').append(content1);


                $("#display_multiple").clone().insertAfter("#multiple_div"+ incr).attr("id", "app_apply_amount" +  incr).find("input[type='text']").val("")
                    .each(function() {
                        var id = this.id || "";
                        var match = id+incr;
                        this.id = match;
                    });

                /*$("#display_multiple").clone().attr('id', 'id'+incr).insertAfter("#multiple_div");
                $("#display_multiple").clone().appendTo("#multiple_div"); */

                $("#eligible_amount"+incr).keyup(function(){

                    var app_apply_amount = $("#app_apply_amount"+x).val();
                    var eligible_amount = $("#eligible_amount"+x).val();

                    if(parseFloat(app_apply_amount) && parseFloat(eligible_amount) && app_apply_amount != 0 ) {
                        var max_amount =  parseFloat(app_apply_amount) - parseFloat(eligible_amount) ;
                        $('#more_eligible_amount'+x).val(max_amount);
                    }else{
                        $('#more_eligible_amount'+x).val('');
                    }
                });

                x++;
                incr++;
            }
        });
        $('#remove1').click(function () {
alert('cjh');
            if(incr ==2){
                $("#only_save").show();
                $("#remove1").hide();
            }
            if(x >= 1 && incr >=  1) {
                $("#app_apply_amount" + x).remove();
                x--;
                incr--;
            }
        });

        $('#add_multi_choose').on('click', '.btn-togal', function() {
            var toggleid = $(this).data("toggleid");
            $("#toggle_div"+toggleid).toggle('500');
        });
    });

    function check_month(month , oth = null){
        /*   var check_mnt  = this.value; */
        var check_mnt  = month;
        var emp_id = '<?php echo $this->session->userdata('emp_id'); ?>';
        var master_id = '<?php echo $get_bill_single['master_category_id'] ; ?>';
        var HTTP_PATH='<?php echo base_url(); ?>';
        $.ajax({
            type: "POST",
            url: HTTP_PATH + "est_service_module/check_for_month",
            data: {emp_id: emp_id,master_id:master_id,check_mnt : check_mnt},
            success: function(data){
                var r_data = JSON.parse(data);
                if(r_data != ''){
                    $.each(r_data, function( index, value ) {
                        /* console.log(value['bill_apply_month']); */
                        if(oth != null){
                            $( "#month_div"+oth ).addClass( "has-error" );
                            $( "#error_month_txt"+oth).html('<span class="text-danger">आपके द्वरा चैनित माह हेतु भुगतान का आवेदन किया जा चुका है |</span>');
                        }else{
                            $( "#month_div" ).addClass( "has-error" );
                            $( "#error_month_txt").html('आपके द्वरा चैनित माह हेतु भुगतान का आवेदन किया जा चुका है |');
                        }
                        $("#div_hide").hide();
                    });
                }else{
                    if(oth != null){
                        $(  "#month_div"+oth  ).removeClass( "has-error" );
                        $( "#error_month_txt"+oth ).html('');
                    }else{
                        $( "#month_div" ).removeClass( "has-error" );
                        $( "#error_month_txt").html('');
                    }
                    $("#div_hide").show();
                }
            }
        });
    }

    function getTheDays(month , putid = '') {
        var moth = month;
        var dt = new Date(moth.split('-')[0]);
        var date = new Date();

        var month = dt.getMonth(),
            year = date.getFullYear();
        var FirstDay = new Date(year, month, 1);
        var LastDay = new Date(year, month + 1, 0);

        var f = FirstDay.getDate();
        var l = LastDay.getDate();

        var mf = FirstDay.getMonth() + 1;
        var ml = LastDay.getMonth() + 1;

        if(f<10) { f='0'+f  }
        if(l<10) { l='0'+l  }
        if(mf<10) { mf='0'+mf }
        if(ml<10) { ml='0'+ml }

        document.getElementById('frm_dt'+putid).value = (f) + '-' + (mf) + '-' + FirstDay.getFullYear();
        document.getElementById('to_dt'+putid).value = (l) + '-' + (ml) + '-' + LastDay.getFullYear();
    }

    function detect_petrol_amount(incr1 = ''){
        var amount1 = $("#app_petrol_lit"+incr1).val();
        var amount2 = $("#app_petrol_rate"+incr1).val();
        if(parseFloat(amount1) && parseFloat(amount2)) {
            var t_amt =  parseFloat(amount1)* parseFloat(amount2) ;
            $('#app_apply_amount'+incr1).val(t_amt);
        }else{
            $('#app_apply_amount'+incr1).val('');
        }
    }



    function selectEmployee_name_bill( emp_unicode_name  , emp_id , num = '')
    {
        var HTTP_PATH='<?php echo base_url(); ?>';
        $.ajax({
            type: "POST",
            url: HTTP_PATH + "establishment/getemployee_details_fill",
            data:'emp_id='+emp_id,
            beforeSend: function(){

            },
            success: function(data){
                var r_data = JSON.parse(data);
                $("#applicant_emp_id"+num).val(r_data['emp_id']);
                $("#applicant_name"+num).val(r_data['emp_full_name_hi']);
                $("#applicant_emp_code"+num).val(r_data['emp_unique_id']);
                $("#applicant_designation"+num).val(r_data['emprole_name_hi']);
                $("#applicant_category"+num).val(r_data['emp_class']);
            }
        });

    }

    $("#app_apply_amount , #eligible_amount").keyup(function(){
        var app_apply_amount = $("#app_apply_amount").val();
        var eligible_amount = $("#eligible_amount").val();

        if(parseFloat(app_apply_amount) && parseFloat(eligible_amount) && app_apply_amount != 0 ) {
            var max_amount =  parseFloat(app_apply_amount) - parseFloat(eligible_amount) ;
            $('#more_eligible_amount').val(max_amount);
        }else{
            $('#more_eligible_amount').val('');
        }
    });


</script>