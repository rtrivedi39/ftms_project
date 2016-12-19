<?php
$uri2 =  $this->uri->segment(2);
if(isset($appdetails) && !empty($appdetails)){
    $uri3 = $appdetails['pay_cateid'];
    $uri4 = $appdetails['pay_sub_cateid'];
}else{
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
<?php $check1 = get_dpf_gpf_details($this->session->userdata('user_id'),$this->session->userdata('emp_id'),$uri4) ;

if(!empty($check1)){ ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-danger">
                <div class="box-body text-center">
                 <h4>आपके द्वारा दिनांक <?php echo date_format(date_create($check1['created_at']), 'd-m-Y'); ?> को आवेदन किया जा चुका है |</h4>
                    <div class="form-group">
                        <a type="button" class="btn btn-primary btn-sm" href="<?php echo base_url(); ?>est_service_module/dispaly_application/<?php echo $check1['pay_id'] ;?>">आवेदन देखे</a>
                    <?php if($check1['applied_amnt_adv_status'] == '1'){ ?>
                        <a id="modify_app" type="button" class="btn btn-sm btn-primary" href="<?php echo base_url(); ?>establishment/edit_service_forms/<?php echo $check1['pay_id'] ;?>">बदलाव करें</a>
        <?php } ?>
        </div>
                </div>
            </div>
        </div>
    </div>
<?php }else{ ?>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form role="form" method="post" action="<?php echo base_url()?>est_service_module/gpfdpf_manage/manage_gpf_dpf"  enctype="multipart/form-data">

                    <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
                    <input type="hidden" name="file_mark_section_id" id="file_mark_section_id" value="7" />

                    <div class="box-body">

                        <div class="form-group text-center"><h2><u><?php echo $this->lang->line('manage_gpfdpf_dept_title'); ?></u></h2></div>

                        <div class="form-group text-center"><h3>भविष्य निधि खाते से अस्थाई/ आंशिक अंतिम के  आहरण हेतु आवेदन <br>(अभिदाता द्वारा भरा जाने वाला आवेदन )</h3></div>

                        <?php if($uri2 == 'service_forms'){ ?>
                            <div class="form-group col-md-2"></div>
                            <div class="form-group col-md-4">अभिदाता के एम्पलाई कोड से खोजे</div>
                            <div class="form-group col-md-4"><input autocomplete="off" class="form-control" name="applicant_emp_code_search" id="applicant_emp_code_search" placeholder="खोजे" />
                                <div id="suggesstion-box_search"></div>
                            </div>
                        <?php } ?>
                        <div class="form-group col-md-4">
                            <?php echo "1. ".$this->lang->line('manage_gpfdpf_applicant_name'); ?> <span class="text-danger">*</span>
                        </div>

                        <div class="form-group col-md-3" style="position: relative;">
                            <input type="hidden"  class="form-control" name="applicant_emp_id" id="applicant_emp_id">
                            <input class="form-control" name="applicant_name" id="applicant_name" placeholder="<?php echo $this->lang->line('manage_gpfdpf_applicant_name'); ?>" readonly />
                            <?php echo form_error('applicant_name');?>
                            <div id="suggesstion-box"></div>
                        </div>

                        <div class="form-group col-md-3" style="position: relative;">
                            <input type="text" required class="form-control" name="applicant_emp_code" id="applicant_emp_code" placeholder="एम्प्लोयी कोड" readonly />
                            <div id="suggesstion-box_emp_code" ></div>
                        </div>

                        <div class="form-group col-md-4">
                            <?php echo "2. (क) ".$this->lang->line('manage_gpfdpf_applicant_designation'); ?> <span class="text-danger">*</span>
                        </div>

                        <div class="form-group col-md-6">
                            <input type="text" required class="form-control" name="applicant_designation" id="applicant_designation" placeholder="<?php echo $this->lang->line('manage_gpfdpf_applicant_designation'); ?>" readonly />
                        </div>

                        <div class="form-group col-md-4">
                            <?php echo "&nbsp;&nbsp;&nbsp; (ख) ".$this->lang->line('manage_gpfdpf_applicant_category'); ?> <span class="text-danger">*</span>
                        </div>

                        <div class="form-group col-md-6">
                            <input type="text" required class="form-control" name="applicant_category" id="applicant_category" placeholder="<?php echo $this->lang->line('manage_gpfdpf_applicant_category'); ?>" />
                        </div>

                        <div class="form-group col-md-4">
                            <?php echo @$uri3 == '52' ? "3. ".$this->lang->line('manage_gpfdpf_dpf_account_no_gpf') : "3. ".$this->lang->line('manage_gpfdpf_dpf_account_no_dpf') ; ?> <span class="text-danger">*</span>
                        </div>

                        <div class="form-group col-md-6">
                            <input type="text" required class="form-control" name="dpf_account_no" id="dpf_account_no" placeholder=" खता क्रमांक"  />
                        </div>

                        <div class="form-group  col-md-4"><?php echo "4. ".$this->lang->line('manage_gpfdpf_account_remaing_amount'); ?></div>

                        <div class="form-group col-md-6">
                            &nbsp;
                        </div>

                        <div class="form-group  col-md-4"><?php echo "&nbsp;&nbsp;&nbsp;(क) विगत दो वर्ष पूर्व का वर्ष "; $before_year = date('Y')-2; $current_ye = date('Y')-1 ; echo $before_year .'-'.$current_ye?></div>

                        <div class="form-group col-md-6">
                            <input type="hidden" name="previous_year_txt" id="previous_year_txt" value="<?php echo date('Y') - 1; ?>">
                            <input type="text" required class="form-control" name="previous_year_amnt" id="previous_year_amnt" autocomplete="off">
                        </div>

                        <div class="form-group  col-md-4"><?php echo "&nbsp;&nbsp;&nbsp;(ख) विगत वर्ष ";  $current_ye = date('Y')-1 ;$after_year = date('Y'); echo $current_ye .'-'.$after_year ;?> में जमा</div>

                        <div class="form-group col-md-6">
                            <input type="hidden" name="current_year_txt" id="current_year_txt" value="<?php echo date('Y'); ?>">
                            <input type="text" required class="form-control" name="current_year_amnt" id="current_year_amnt" autocomplete="off"/>
                        </div>

                        <div class="form-group  col-md-4 text-center"><?php echo $this->lang->line('manage_gpfdpf_temp_gpf_withdraw'). ' ( - )';   ?></div>

                        <div class="form-group col-md-6">
                            <input class="form-control" name="gpfdpf_adv" id="gpfdpf_adv" autocomplete="off" required="">
                            <br>
                            <input type="text" required class="form-control" name="gpfdpf_total_amt" id="gpfdpf_total_amt" readonly />
                        </div>

                        <div class="form-group col-md-4"><?php echo "5. (क)  अस्थाई अग्रिम/आंशिक अंतिम  ".$this->lang->line('manage_gpfdpf_temp_less_last_gpf'); ?></div>

                        <div class="form-group col-md-2">
                            <input class="form-control" name="applied_amount_adv" id="applied_amount_adv" placeholder="<?php echo $this->lang->line('manage_gpfdpf_temp_less_last_gpf'); ?>" />
                        </div>
                        <div class="form-group col-md-4">
                            <input type="text" required class="form-control" name="applied_amount_adv_words" id="applied_amount_adv_words" placeholder="<?php echo "अपेक्षित राशि शब्दों में लिखे"; ?>" />
                        </div>

                        <div class="form-group  col-md-6"><?php echo "6. ".$this->lang->line('manage_gpfdpf_temp_gpf_remaining_details'); ?></div>

                        <?php if($uri4 == '97'){ ?>
                            <div class="form-group  col-md-4"><?php echo $this->lang->line('manage_gpfdpf_blanck'); ?></div>
                        <?php } ?>
                        <?php if($this->uri->segment(4) == 162 || $this->uri->segment(4) == 163 ){ }else{ ?>

                            <div class="form-group  col-md-10">
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

                        <div class="form-group  col-md-10">
                            <?php if($uri4 == 131){ ?>
                                <div class="form-group  col-md-12 " style="margin-left:-20px;"><?php echo "7. आंशिक अंतिम आहरण हेतु -"; ?></div>
                            <?php } ?>
                            <p>जिस वर्ष अग्रिम हेतु आवेदन किया जाता है, उस वर्ष में अग्रिम एवं आंशिक अंतिम आहरण का पूर्ण विवरण -
                                <select name="pay_persent" id="pay_persent">
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="75">75</option>
                                    <option value="90">90</option>
                                </select> प्रतिशत </p>
                            <?php if($uri4 == 97){ ?>
                                <p>वास्तविक उपयोग के उपरांत अतिरिक्त शेष राशि तत्काल कोषालय /बैंक में ब्याज सहित चालान की प्रति आहरण एवं संवितरण अधिकारी को तत्काल उपलब्ध करायी जावेगी | </p>
                            <?php }	?>
                        </div>

                        <div class="form-group  col-md-10">
                            <div class="form-group col-md-6">
                                <div class="form-group  col-md-2">दिनांक</div>
                                <div class="form-group  col-md-4"><input type="text" required class="form-control date1" value="<?php echo date('d-m-Y')?>" name="file_type" id="file_type" /></div>
                            </div>
                            <div class="form-group col-md-4 pull-right">
                                <div class="form-group  col-md-4"><input type="text" id="employee_name_txt" name="emp_na" readonly><br><input type="text" id="employee_designation_txt" name="emp_designation" readonly /></div>
                            </div>
                        </div>

                        <div class="form-group col-md-10">
                            <div class="col-md-2"></div>
                            <div class="col-md-4"><label>जी.पी.एफ./डी.पी.एफ. स्लिप संलग्न करें : </label></div>
                            <div class="col-md-3">  <input type="file" name="attachment1" id="attachment1" required=""/></div>
                            <?php if(isset($appdetails) && !empty($appdetails)){ ?>
                                <div class="col-md-3"><a class="btn-primary" href="<?php echo base_url()."".$appdetails['pay_attachment']; ?>" target="_blank">संलग्न स्लिप देखे </a></div>
                            <?php } ?>
                        </div>

                        <input type="hidden" value="<?php echo $this->session->userdata('emp_id'); ?>" name="apply_emp_id" id="apply_emp_id" />
                        <input type="hidden" value="<?php echo $uri4; ?>" name="sub_master_id" id="sub_master_id" />
                        <input type="hidden" name="master_id" id="master_id" value="<?php echo $uri3; ?>" />

                        <div class="form-group box-footer text-right col-md-10">
                            <?php if(isset($appdetails) && !empty($appdetails)){ ?>
                                <input type="hidden" name="pay_app_id" id="pay_app_id" value="<?php echo $appdetails['pay_id']; ?>" />
                                <button class="btn btn-primary margin" onclick="return confirm_receive()" name="process_type" value="modify_app" type="submit"><?php echo "बदलाव करे"; ?></button>
                            <?php }else{ ?>
                                <button class="btn btn-primary margin" onclick="return confirm_receive()" name="process_type" value="send_est" type="submit"><?php echo "स्थापना में जमा करें"; ?></button>
                                <button class="btn btn-primary margin" onclick="return confirm_receive()" name="process_type" value="only_save" type="submit"><?php echo "SAVE ONLY"; ?></button>
                                <button class="btn btn-danger margin" type="reset"><?php echo $this->lang->line('button_reset'); ?></button>
                            <?php } ?>
                        </div>

                    </div>

                </form>
            </div><!-- /.box -->
        </div><!-- /.box -->
    </div><!-- /.box -->
    <?php } ?>
    </section><!-- /.content -->
<?php $this->load->view("empcode_autosuggetion"); ?>