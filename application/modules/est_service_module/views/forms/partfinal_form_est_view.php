<?php
$uri3 =  $appdetails['pay_cateid'];
$uri4 =  $appdetails['pay_sub_cateid'];

$app_year = date_format(date_create($appdetails['created_at']), 'Y');
$app_month = date_format(date_create($appdetails['created_at']), 'm');
$app_day = date_format(date_create($appdetails['created_at']), 'd');


$curr_financial_year = get_financial_year(null ,$app_day , $app_month , $app_year );
$back1_financial_year = get_financial_year(1 ,$app_day , $app_month , $app_year );
$back2_financial_year = get_financial_year(2 ,$app_day , $app_month , $app_year );

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
                    <div style="float:left"><h3 class="box-title"><?php echo $title_tab;?></h3></div>
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
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <div class="col-xs-10 col-md-offset-1">
                        <div class="form-group text-center"><h2><u><?php echo $this->lang->line('manage_gpfdpf_dept_title'); ?></u></h2></div>

                        <div class="form-group text-center"><h3>भविष्य निधि खाते से अस्थाई/ आंशिक अंतिम के  आहरण हेतु आवेदन <br>(अभिदाता द्वारा भरा जाने वाला आवेदन )</h3></div>

                        <div class="form-group col-md-4">
                            <?php echo "1. ".$this->lang->line('manage_gpfdpf_applicant_name'); ?> <span class="text-danger">*</span>
                        </div>

                        <div class="form-group col-md-3" style="position: relative;">
                            <?php echo $appdetails['pay_emp_name'] ; ?>
                        </div>

                        <div class="form-group col-md-3" style="position: relative;">
                            <?php echo $appdetails['pay_emp_unique_id'] ; ?>
                        </div>

                        <div class="form-group col-md-4">
                            <?php echo "2. (क) ".$this->lang->line('manage_gpfdpf_applicant_designation'); ?> <span class="text-danger">*</span>
                        </div>

                        <div class="form-group col-md-6">
                            <?php echo $appdetails['pay_emp_designation'] ; ?>
                        </div>

                        <div class="form-group col-md-4">
                            <?php echo "&nbsp;&nbsp;&nbsp; (ख) ".$this->lang->line('manage_gpfdpf_applicant_category'); ?> <span class="text-danger">*</span>
                        </div>

                        <div class="form-group col-md-6">
                            <?php echo $appdetails['pay_emp_class'] ; ?>
                        </div>

                        <div class="form-group col-md-4">
                            <?php echo @$uri3 == '52' ? "3. ".$this->lang->line('manage_gpfdpf_dpf_account_no_gpf') : "3. ".$this->lang->line('manage_gpfdpf_dpf_account_no_dpf') ; ?> <span class="text-danger">*</span>
                        </div>

                        <div class="form-group col-md-6">
                            <?php echo $appdetails['pay_account_no'] ; ?>
                        </div>

                        <div class="form-group  col-md-4"><?php echo "4. ".$this->lang->line('manage_gpfdpf_account_remaing_amount'); ?></div>

                        <div class="form-group col-md-6">
                            &nbsp;
                        </div>

                        <div class="form-group  col-md-4"><?php echo "&nbsp;&nbsp;&nbsp;(क) विगत दो वर्ष पूर्व का वर्ष "; echo $back2_financial_year ; ?></div>

                        <div class="form-group col-md-6">
                            <?php echo $appdetails['pay_pre_amount'] ; ?>
                        </div>

                        <div class="form-group  col-md-4"><?php echo "&nbsp;&nbsp;&nbsp;(ख) विगत वर्ष ";  echo $back1_financial_year ;?> में जमा</div>

                        <div class="form-group col-md-6">
                            <?php echo $appdetails['pay_amount'] ; ?>
                        </div>
                        
                         <?php if($appdetails['pay_percentage'] == '90') { ?>
						<div class="form-group  col-md-4"><?php echo "&nbsp;&nbsp;&nbsp;(ग) वर्ष ";  echo $curr_financial_year ;?> में जमा</div>

                        <div class="form-group col-md-6">
                            <?php echo $appdetails['pay_amnt_curr_financial'] ; ?>
                        </div>
							 
					  <?php } ?>
                     
                        <div class="form-group  col-md-4 text-center"><?php echo $this->lang->line('manage_gpfdpf_temp_gpf_withdraw'). ' ( - )';   ?></div>

                        <div class="form-group col-md-6">
                            <?php echo $appdetails['pay_adv_amount'] ; ?>
                            <br>
                             <?php if($appdetails['pay_percentage'] == '90' && $appdetails['pay_amnt_curr_financial'] != '') { 
							 echo $tot =  ($appdetails['pay_pre_amount'] + $appdetails['pay_amount'] + $appdetails['pay_amnt_curr_financial']) - $appdetails['pay_adv_amount'] ;
							 }else{ 
							 echo $tot =  $appdetails['pay_pre_amount'] - $appdetails['pay_adv_amount'] ;
							 } ?>
                        </div>



                        <div class="form-group">
                            <div class="col-xs-4">
                                <?php echo "5. (क)  अस्थाई अग्रिम/आंशिक अंतिम  ".$this->lang->line('manage_gpfdpf_temp_less_last_gpf'); ?>
                            </div>
                            <div class="col-xs-2">
                                <?php echo "रु ".$appdetails['applied_amount_adv'] ; ?>
                            </div>
                            <div class="col-xs-6">
                                <?php echo $appdetails['applied_amount_adv_words'] ; ?>
                            </div>
                        </div>


                        <div class="form-group col-md-12">
                            <p>&nbsp</p>
                            <?php echo "6. ".$this->lang->line('manage_gpfdpf_temp_gpf_remaining_details'); ?></div>

                        <?php if($uri4 == '97'){ ?>
                            <div class="form-group col-md-12 text-center"><?php echo $this->lang->line('manage_gpfdpf_blanck'); ?></div>
                        <?php } ?>

                        <?php if($this->uri->segment(4) == 162 || $this->uri->segment(4) == 163 ){ }else{ ?>

                            <div class="form-group  col-md-12">
                                <table width="100%">
                                    <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('manage_gpfdpf_serial_no'); ?><br>1</th>
                                        <th><?php echo $this->lang->line('manage_gpfdpf_month'); ?><br>2</th>
                                        <th><?php echo $this->lang->line('manage_gpfdpf_amount_which_sengtion'); ?><br>3</th>
                                        <th><?php echo $this->lang->line('manage_gpfdpf_repayment_remaing_amount'); ?><br>4</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="text-align:center">निरंक</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        <?php } ?>

                        <div class="form-group  col-md-12">
                            <?php if($uri4 == 131){ ?>
                                <div class="form-group  col-md-12 " style="margin-left:-20px;"><?php echo "7. आंशिक अंतिम आहरण हेतु -"; ?></div>
                            <?php } ?>
                            <p>जिस वर्ष अग्रिम हेतु आवेदन किया जाता है, उस वर्ष में अग्रिम एवं आंशिक अंतिम आहरण का पूर्ण विवरण -
                                <?php echo $appdetails['pay_percentage'] ; ?> प्रतिशत </p>
                            <?php if($uri4 == 97){ ?>
                                <p>वास्तविक उपयोग के उपरांत अतिरिक्त शेष राशि तत्काल कोषालय /बैंक में ब्याज सहित चालान की प्रति आहरण एवं संवितरण अधिकारी को तत्काल उपलब्ध करायी जावेगी | </p>
                            <?php }	?>
                        </div>

                        <div class="form-group  col-md-12">
                            <div class="form-group col-md-6">दिनांक  <b><?php echo date_format(date_create($appdetails['created_at']), 'd-m-Y'); ?></b></div>

                            <div class="form-group col-md-6 text-center">
                                <div class="pull-right">(<?php echo $appdetails['pay_emp_name'] ; ?>)<br><?php echo $appdetails['pay_emp_designation'] ; ?></div>
                            </div>
                        </div>

                        <div class="form-group box-footer text-right col-md-12">

                            <a class="btn btn-primary" href="<?php echo base_url()."".$appdetails['pay_attachment']; ?>" target="_blank">संलग्न स्लिप देखे </a>

                            <?php if($appdetails['applied_amnt_adv_status'] == '1' && $appdetails['pay_emp_id'] == $this->session->userdata('emp_id')) { ?>
                            <a class="btn btn-primary" href="<?php echo base_url()?>est_service_module/create_file_application/<?php echo $appdetails['pay_id'] ; ?>" onclick="return confirm_receive()">स्थापना में भेजे</a>
                            <?php } ?></php>

                          <!--  <?php /*if($appdetails['applied_amnt_adv_status'] == '2') { */?>
                                <a class="btn btn-primary" href="<?php /*echo base_url(); */?>est_service_module/create_notesheet_app?file_id=<?php /*echo $appdetails['pay_file_id'] */?>&&pay_id=<?php /*echo $appdetails['pay_id'] */?>" onclick="return confirm_receive()">नोटशीट संलग्न करें</a>
                            --><?php /*} */?>
                        </div>


                    </div>
                </div>
            </div><!-- /.box -->
        </div><!-- /.box -->
    </div><!-- /.box -->
</section><!-- /.content -->
