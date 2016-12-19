<?php
if(isset($billdetails) && $billdetails != ''){
    $uri4 = $billdetails['bill_sub_catid'];
}else{
    $uri2 =  $this->uri->segment(2);
    $uri3 =  $this->uri->segment(3);
    $uri4 = $this->uri->segment(4);
}
?>
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
                <form role="form" method="post" action="<?php echo base_url()?>est_service_module/manage_local_bill"  enctype="multipart/form-data">
                    <div class="box-body">
                        <input type="hidden" class="form-control" name="applicant_emp_id" id="applicant_emp_id" required="" value="<?php echo $billdetails['bill_emp_id']  ? $billdetails['bill_emp_id'] : '' ?>" >

                        <div class="form-group">
                            <?php if($uri2 == 'bill_forms'){ ?>
                                <div class="form-group col-md-2"></div>
                                <div class="form-group col-md-4">एम्पलाई कोड से खोजे</div>
                                <div class="form-group col-md-4"><input autocomplete="off" class="form-control" name="applicant_emp_code_search" id="applicant_emp_code_search" placeholder="खोजे" />
                                    <div id="suggesstion-box_search"></div>
                                </div>
                            <?php } ?>
                        </div>


                        <?php if($get_bill_single['master_category_id'] == '123'){ ?>
                            <div class="form-group" id="div_mobile_no">
                                <label for="exampleInputEmail1">मोबाइल नंबर</label>
                                <input type="text" class="form-control" id="app_mobile_number" name="app_mobile_number" placeholder="नंबर" value="<?php echo $billdetails['bill_mobile_no']  ? $billdetails['bill_mobile_no'] : '' ?>" required="">
                            </div>
                        <?php }elseif($get_bill_single['master_category_id'] == '121' || $get_bill_single['master_category_id'] == '127'){ ?>
                            <div class="form-group" id="div_petrol_lit">
                                <label for="exampleInputEmail1">गाड़ी नंबर</label>
                                <input type="text" class="form-control" id="app_vehicle_no" name="app_vehicle_no" placeholder="नंबर" value="<?php echo $billdetails['bill_vehicle_no']  ? $billdetails['bill_vehicle_no'] : '' ?>" required="">
                            </div>
                        <?php }if($get_bill_single['master_category_id'] == '122'){ ?>
                            <div class="form-group"  id="div_electricity_unit">
                                <label for="exampleInputEmail1">मकान नंबर</label>
                                <input type="text" class="form-control" id="app_house_no" name="app_house_no" placeholder="मकान नंबर" value="<?php echo $billdetails['bill_user_house_no']  ? $billdetails['bill_user_house_no'] : '' ?>" required="">
                            </div>
                        <?php }if($get_bill_single['master_category_id'] == '128'){ ?>
                            <div class="form-group" id="div_oth_bill">
                                <label for="exampleInputEmail1">बिल का कारण</label>
                                <input type="text" class="form-control" id="app_oth_bill" name="app_oth_bill" placeholder="बिल का कारण" value="" required="">
                            </div>
                        <?php } ?>

                        <!---add multiple data start-->
                        <?php if(isset($billdetails) && !empty($billdetails)){ }else{?>
                        <?php if($get_bill_single['master_category_id'] != '127' && $get_bill_single['master_category_id'] != '123' && $get_bill_single['master_category_id'] != '121'){ ?>
                        <div class="form-group">
                            <!--<div style="float: right">-->
                            <button type="button" id="add_multi_btn" class="btn btn-sm btn-success" ><i class='fa fa-fw fa-plus'></i> माह जोड़ें</button>
                            <button type="button" id="remove1" class="btn btn-sm btn-danger remove1" style="display: none"><i class="fa fa-fw fa-minus"></i> माह हटाये</button>
                            <!--</div>-->
                        </div>
                        <?php  } } ?>

                        <div id="make_maltiple">
                            <div class="form-group" id="month_div">
                                <label>बिल के भुगतान माह </label>
                                <div class="row">
                                    <div class="col-xs-4">
                                        <select name="app_applied_month[]" id="app_applied_month" class="form-control app_applied_month" required="" onchange="check_month(this.value); getTheDays(this.value);">
                                            <option value="">माह का चयन करे</option>
                                            <?php foreach (months(null,true) as $key => $val) {
                                                if(date("m") >= $key) { ?>
                                                    <option value="<?php echo $key."-".date("Y"); ?>"><?php echo $val." / ".date("Y") ; ?></option>
                                                <?php } } ?>
                                        </select>
                                    </div>
                                    <div class="col-xs-4"><input type="text" name="frm_dt[]" id="frm_dt" value="<?php echo $billdetails['bill_from_date']  ? date_format(date_create($billdetails['bill_from_date']), 'd-m-Y') : '' ?>" placeholder="कब से" class="form-control date1" required></div>
                                    <div class="col-xs-4"><input type="text" name="to_dt[]" id="to_dt" value="<?php echo $billdetails['bill_to_date']  ? date_format(date_create($billdetails['bill_to_date']), 'd-m-Y') : '' ?>" placeholder="कब तक" class="form-control date1" required></div>
                                </div>
                                <div id="error_month_txt" class="text-danger"></div>
                            </div>

                            <?php if($get_bill_single['master_category_id'] == '121' || $get_bill_single['master_category_id'] == '127'){
                                if(isset($billdetails['bill_extra_feilds'])){
                                    $bill_extra_feilds = unserialize($billdetails['bill_extra_feilds']);
                                } ?>

                                <div class="form-group" id="extra_petrol_field">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <label>Case memo no .</label>
                                            <input type="text" name="case_memo[]" id="case_memo" value="<?php echo $bill_extra_feilds['case_memo']  ? $bill_extra_feilds['case_memo'] : '' ?>" placeholder="Bill no." class="form-control">
                                        </div>
                                        <div class="col-xs-4">
                                            <label>वाहन चालक का नाम</label>
                                            <input type="text" name="driver_name[]" id="driver_name" value="<?php echo $bill_extra_feilds['driver_name']  ? $bill_extra_feilds['driver_name'] : '' ?>" placeholder="driver name" class="form-control"></div>
                                        <?php if($get_bill_single['master_category_id'] == '121'){ ?>
                                        <div class="col-xs-4">
                                            <label>mailo </label>
                                            <input type="text" name="mailo_meter[]" id="mailo_meter" value="<?php echo $bill_extra_feilds['mailo_meter']  ? $bill_extra_feilds['mailo_meter'] : '' ?>" placeholder="mailo" class="form-control">
                                        </div>
                                        <?php } ?>

                                    </div>
                                </div>
                            <?php if($get_bill_single['master_category_id'] == '121'){ ?>
                                <div class="form-group" id="div_petrol_lit">
                                    <div class="row">
                                    <div class="col-xs-6">
                                        <label for="exampleInputEmail1">पेट्रोल की मात्र </label>
                                        <input type="text" class="form-control" id="app_petrol_lit" name="app_petrol_lit[]" placeholder="लीटर" value="<?php echo $billdetails['bill_petrol_lit']  ? $billdetails['bill_petrol_lit'] : '' ?>" required="">
                                    </div>
                                    <div class="col-xs-6">
                                        <label for="exampleInputEmail1"> पेट्रोल की वर्तमान दर </label>
                                        <input type="text" class="form-control" id="app_petrol_rate" name="app_petrol_rate[]" placeholder="वर्तमान दर" value="" required="" onblur="detect_petrol_amount()" />
                                    </div>
                                    </div>
                                    <div id="show_msg_p"></div>
                                </div>
                                <?php } ?>

                            <?php }elseif($get_bill_single['master_category_id'] == '122'){ ?>
                                <div class="form-group"  id="div_electricity_unit">
                                    <label for="exampleInputEmail1">बिजली की यूनिट</label>
                                    <input type="text" class="form-control" id="app_electricity_unit" name="app_electricity_unit[]" placeholder="यूनिट" value="<?php echo $billdetails['bill_electricity_unit']  ? $billdetails['bill_electricity_unit'] : '' ?>">
                                </div>
                            <?php } ?>

                            <div class="form-group" id="amount_1">
                                <label for="exampleInputPassword1">राशि</label>
                                <div class="row">
                                    <div class="col-xs-4">
                                        <input type="text" required class="form-control" id="app_apply_amount" name="app_apply_amount[]" placeholder="राशि" onblur="test_skill(this.value)" onkeyup="test_skill(this.value)" autocomplete="off" value="<?php echo $billdetails['bill_apply_amt']  ? $billdetails['bill_apply_amt'] : '' ?>"/>
                                    </div>
                                    <div class="col-xs-8">
                                        <input type="text" required class="form-control" name="applied_amount_adv_words[]" id="applied_amount_adv_words" placeholder="<?php echo "राशि शब्दों में लिखे"; ?>" value="<?php echo $billdetails['bill_apply_amt_words']  ? $billdetails['bill_apply_amt_words'] : '' ?>"/>
                                    </div>
                                </div>
                                <div id="show_msg_ac"></div>
                            </div>

                            <div class="form-group" id="div_description">
                                <label for="exampleInputEmail1">बिल का कारण विवरण</label>
                                <textarea  id="app_bill_description" name="app_bill_description" class="form-control"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputFile">बिल की स्लिप संलग्न करें</label>
                                <input type="file" name="attachment10" id="attachment1" required="">
                                <?php if(isset($billdetails) && !empty($billdetails)){ ?>
                                    <input type="checkbox" name="is_attachment_change" id="is_attachment_change" value="pre_same"> अगर संलग्न स्लिप को बदलना नही है तो क्लिक करे  |
                                    <div class="col-md-3"><a class="btn-primary" href="<?php echo base_url()."".$billdetails['bill_attachment']; ?>" target="_blank">संलग्न स्लिप देखे </a></div>
                                <?php } ?>
                            </div>

                            <div class="form-group" id="add_multi_content"></div>
                        </div>

                        <!---add multiple data end-->

                    </div><!-- /.box-body -->
                    <input type="hidden" value="<?php echo $this->session->userdata('emp_id'); ?>" name="apply_emp_id" id="apply_emp_id" />
                    <input type="hidden" value="<?php echo $get_bill_single['category_title_hin']; ?>" name="app_bill_for" id="app_bill_for" />
                    <input type="hidden" value="<?php echo $billdetails['bill_sub_catid']  ? $billdetails['bill_sub_catid'] : $uri4 ; ?>" name="sub_master_id" id="sub_master_id" />

                    <input type="hidden" name="emp_class_id_hidden" id="emp_class_id_hidden" />

                    <div class="box-footer" id="div_hide">
                        <?php if(isset($billdetails) && !empty($billdetails)){ ?>
                            <input type="hidden" name="bill_id" id="bill_id" value="<?php echo $billdetails['id']; ?>" />
                            <button class="btn btn-primary margin" onclick="return confirm_receive()" name="process_type" value="modify_app" type="submit"><?php echo "बदलाव करे"; ?></button>
                        <?php }else{ ?>
                            <button class="btn btn-primary margin" onclick="return confirm_receive()" name="process_type" value="only_save" type="submit" id="only_save"><?php echo "SAVE ONLY"; ?></button>
                            <button class="btn btn-primary margin" onclick="return confirm_receive()" name="process_type" value="send_est" type="submit"><?php echo "स्थापना में जमा करें"; ?></button>
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

                    <div class="form-group">
                        <label for="exampleInputEmail1">नाम / एम्पलाई कोड</label>
                        <div class="row">
                            <div class="col-xs-6">
                                <input type="text" class="form-control" id="applicant_name" name="applicant_name" placeholder="नाम" required="" readonly value="<?php echo $billdetails['bill_emp_name']  ? $billdetails['bill_emp_name'] : '' ?>" >
                            </div>
                            <div class="col-xs-6">
                                <input type="text" class="form-control" id="applicant_emp_code" name="applicant_emp_code" placeholder="कोड" required="" readonly value="<?php echo $billdetails['bill_emp_unique_id']  ? $billdetails['bill_emp_unique_id'] : '' ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">पद नाम</label>
                        <input type="text" class="form-control" id="applicant_designation" name="applicant_designation" placeholder="पद" required="" readonly value="<?php echo $billdetails['bill_emp_designation']  ? $billdetails['bill_emp_designation'] : '' ?>">
                    </div>
                    <hr/>

                    <div class="box-header">
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
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                        <b><?php echo "<span id='mst_condition_".$get_category_bill_con1['con_mst_apply_on']."' class='mst_condition'>".$get_category_bill_con1['con_condition']."</span> <span id='mst_con_type_".$get_category_bill_con1['con_mst_apply_on']."' class='mst_con_type'>".$get_category_bill_con1['con_type'] ; ?></span></b>
                                    </div><!-- /.box-body -->
                                </div><!-- /.box -->
                            </div>
                        <?php  }  ?>
                    </div>
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

        $('#add_multi_btn').on('click', function() {
            if(incr <= 4) {
                $("#only_save").hide();
                $("#remove1").show();
                var content1 = '<div class="rem'+incr+'"><hr/>';

                content1 += '<div class="form-group" id="month_div'+incr+'"><label>बिल के भुगतान माह </label><div class="row"><div class="col-xs-4">';
                content1 += '<select name="app_applied_month[]" id="app_applied_month'+incr+'" class="form-control app_applied_month" required="" onchange="check_month(this.value ,'+incr+') , getTheDays(this.value ,'+incr+')">';
                content1 += '<option value="">माह का चयन करे</option>';
                $.each(month2, function( index, value ) {
                    content1 +=  '<option value="'+index+'-'+curr_yr+'">'+value+' / '+curr_yr+'</option>';
                });
                content1 += '</select></div>';
                content1 += '<div class="col-xs-4"><input type="text" name="frm_dt[]" id="frm_dt'+incr+'" value="" placeholder="कब से" class="form-control date1" required></div>';
                content1 += '<div class="col-xs-4"><input type="text" name="to_dt[]" id="to_dt'+incr+'" value="" placeholder="कब तक" class="form-control date1" required></div>';
                content1 += '</div><div id="error_month_txt'+incr+'"></div></div>';
                if(master_category_id == '123'){

                }else if(master_category_id == '121'){
                    content1 += '<div id="put_extra_field'+incr+'"></div>';
                    content1 += '<div class="form-group" id="div_petrol_lit'+incr+'"><div class="row"><div class="col-xs-6"><label for="exampleInputEmail1">पेट्रोल की मात्र </label><input type="text" class="form-control" id="app_petrol_lit'+incr+'" name="app_petrol_lit[]" placeholder="लीटर" value="" required></div>';
                    content1 += '<div class="col-xs-6"><label for="exampleInputEmail1"> पेट्रोल की वर्तमान दर </label> <input type="text" class="form-control" id="app_petrol_rate'+incr+'" name="app_petrol_rate[]" placeholder="वर्तमान दर" value="" required="" onblur="detect_petrol_amount('+incr+')" /> </div>';
                    content1 += '<div id="show_msg_p'+incr+'"></div></div></div>';

                }else if(master_category_id == '122'){
                    content1 += '<div class="form-group"  id="div_electricity_unit'+incr+'"><label for="exampleInputEmail1">बिजली की यूनिट</label><input type="text" class="form-control" id="app_electricity_unit'+incr+'" name="app_electricity_unit[]" placeholder="यूनिट" value="" required></div>';
                }
                content1 += '<div class="form-group" id="amount_1'+incr+'"><label for="exampleInputPassword1">राशि</label><div class="row"><div class="col-xs-4"><input type="text" required class="form-control" id="app_apply_amount'+incr+'" name="app_apply_amount[]" placeholder="राशि" onkeyup="test_skill(this.value,'+incr+')" autocomplete="off" value=""/></div>';
                content1 += '<div class="col-xs-8"><input type="text" required class="form-control" name="applied_amount_adv_words[]" id="applied_amount_adv_words'+incr+'" placeholder="राशि शब्दों में लिखे" value=""/></div></div><div id="show_msg_ac'+incr+'"></div></div>';
                content1 += '<div id="description_div'+incr+'"></div>';
                content1 += '<div class="form-group"><label for="exampleInputFile">बिल की स्लिप संलग्न करें</label><input type="file" name="attachment1'+incr+'" id="attachment'+incr+'"></div>';
                content1 += '</div>';

                $('#add_multi_content').append(content1);
                $('#app_petrol_lit'+incr).val(bill_petrol_lit);
                $("#extra_petrol_field").clone().appendTo("#put_extra_field"+incr);
                $("#div_description").clone().appendTo("#description_div"+incr);

                x++;
                incr++;
            }
            $('.date1').datepicker();
        });
        $('#remove1').click(function () {

            if(incr ==2){
                $("#only_save").show();
                $("#remove1").hide();
            }
            if(x >= 1 && incr >=  1) {
                $(".rem" + x).remove();
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

</script>