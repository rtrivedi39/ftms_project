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
                    <div style="float:left"><h3 class="box-title"><?php echo $billdetails['bill_for']; ?></h3></div>
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
                <div class="box-body">
                    <input type="hidden"  class="form-control" name="applicant_emp_id" id="applicant_emp_id" required="">

                    <div class="form-group">
                        <label>बिल के भुगतान माह : </label>
                        <?php
                        $mnt = explode('-',$billdetails['bill_apply_month']);
                        echo months($mnt['0'] , true)." / " .$mnt['1'] ;
                        ?>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">बिल : </label>
                        <?php echo $billdetails['bill_for'] ; ?>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">नाम / एम्पलाई कोड : </label>

                        <?php echo $billdetails['bill_emp_name'] ; ?>

                        <?php echo $billdetails['bill_emp_unique_id'] ; ?>

                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">पद नाम : </label>
                        <?php echo $billdetails['bill_emp_designation'] ; ?>
                    </div>

                    <?php if($billdetails['bill_sub_catid'] == '123'){ ?>
                        <div class="form-group" id="div_mobile_no">
                            <label for="exampleInputEmail1">मोबाइल नंबर</label>
                            <?php echo $billdetails['bill_mobile_no'] ; ?>
                        </div>
                    <?php }elseif($billdetails['bill_sub_catid'] == '121'){
                        if(isset($billdetails['bill_extra_feilds'])){
                            $bill_extra_feilds = unserialize($billdetails['bill_extra_feilds']);
                        } ?>
                        <div class="form-group">
                            <label>Case memo no . : </label>
                            <?php echo $bill_extra_feilds['case_memo'] ; ?>
                        </div>
                        <div class="form-group">
                            <label>वाहन चालक का नाम : </label>
                            <?php echo $bill_extra_feilds['driver_name'] ; ?>
                        </div>
                        <div class="form-group">
                            <label>mailo :</label>
                            <?php echo $bill_extra_feilds['mailo_meter'] ; ?>
                        </div>
                        <div class="form-group" id="div_petrol_lit">
                            <label for="exampleInputEmail1">पेट्रोल की मात्र </label> :
                            <?php echo $billdetails['bill_petrol_lit'] ; ?>  लीटर
                        </div>
                        <div class="form-group" id="div_petrol_lit">
                            <label for="exampleInputEmail1">गाड़ी नंबर</label> :
                            <?php echo $billdetails['bill_vehicle_no'] ; ?>
                        </div>

                    <?php }elseif($billdetails['bill_sub_catid'] == '122'){ ?>
                        <div class="form-group"  id="div_electricity_unit">
                            <label for="exampleInputEmail1">बिजली की यूनिट</label>
                            <?php echo $billdetails['bill_electricity_unit'] ; ?> यूनिट
                        </div>
                    <?php } ?>

                    <div class="form-group">
                        <label for="exampleInputPassword1">राशि : </label>

                        <?php echo $billdetails['bill_apply_amt'] ; ?>

                        (<?php echo $billdetails['bill_apply_amt_words'] ; ?>)


                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">बिल कि स्लिप सन्लंग देखे : </label>
                        <a class="btn btn-primary btn-sm" href="<?php echo base_url()."".$billdetails['bill_attachment']; ?>" target="_blank">संलग्न बिल देखे </a>

                    </div>
                </div><!-- /.box-body -->


            </div><!-- /.box -->
        </div>
        <div class="col-md-6">
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">आवेदन के नियम</h3>
                </div>
                <div class="box-body">
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
                                        <!--<div class="box-tools pull-right">
                                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        </div>--><!-- /.box-tools -->
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                        <b><?php echo "<span id='mst_condition_".$get_category_bill_con1['con_mst_apply_on']."' class='mst_condition'>".$get_category_bill_con1['con_condition']."</span> <span id='mst_con_type_".$get_category_bill_con1['con_mst_apply_on']."' class='mst_con_type'>".$get_category_bill_con1['con_type'] ; ?></span></b>
                                    </div><!-- /.box-body -->
                                </div><!-- /.box -->
                            </div>
                        <?php  }  ?>

                        <?php
                        /* foreach($get_category_bill_con as $get_category_bill_con1){
                            echo  $get_category_bill_con1['con_mst_apply_on'];
                            echo "--";
                            echo  $get_category_bill_con1['con_condition'];
                            echo "--";
                            echo  $get_category_bill_con1['con_type'];
                            echo "<br/>";
                        } */
                        ?>
                        <!--<div class="col-xs-3">
                            <input type="text" class="form-control" placeholder=".col-xs-3">
                        </div>
                        <div class="col-xs-4">
                            <input type="text" class="form-control" placeholder=".col-xs-4">
                        </div>
                        <div class="col-xs-5">
                            <input type="text" class="form-control" placeholder=".col-xs-5">
                        </div>-->
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div><!-- /.box -->
</section><!-- /.content -->
