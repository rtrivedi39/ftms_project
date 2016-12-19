
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
<form role="form" method="post" action="<?php echo base_url()?>est_service_module/gpfdpf_manage/manage_gpf_dpf"  enctype="multipart/form-data">

  <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" >
  <input type="hidden" name="file_mark_section_id" id="file_mark_section_id" value="7" >
  <input type="hidden" name="emp_pay_cate_id" id="emp_pay_cate_id" value="" >


 	<div class="box-body">

		<div class="form-group text-center"><h2><?php echo $this->lang->line('manage_gpfdpf_dept_title'); ?></h2></div>

		<div class="form-group text-center"><h3><?php $temp_var = ""; if($this->uri->segment(4) == 160 || $this->uri->segment(4) == 161  ){ $temp_var = "अस्थाई अग्रिम"; }elseif($this->uri->segment(4) == 162 || $this->uri->segment(4) == 163){ $temp_var = "आंशिक अंतिम"; } echo  "भविष्य निधि खाते से $temp_var आहरण हेतु आवेदन <br>अभिदाता द्वारा भरा जाने वाला आवेदन "; ?></h3></div>


            <div class="form-group col-md-4">
              <?php echo "1. ".$this->lang->line('manage_gpfdpf_applicant_name'); ?> <span class="text-danger">*</span>
            </div>

            <div class="form-group col-md-3" style="position: relative;">
                 <input class="form-control" name="applicant_name" id="applicant_name" placeholder="<?php echo $this->lang->line('manage_gpfdpf_applicant_name'); ?>" >
                <?php echo form_error('applicant_name');?>
				<div id="suggesstion-box"></div>
            </div>

            <div class="form-group col-md-3" style="position: relative;">
				 <input class="form-control" name="applicant_emp_code" id="applicant_emp_code" placeholder="एम्प्लोयी कोड">
				 <div id="suggesstion-box_emp_code" ></div>
			</div>

            <div class="form-group col-md-4">
              <?php echo "2. (क) ".$this->lang->line('manage_gpfdpf_applicant_designation'); ?> <span class="text-danger">*</span>
            </div>

            <div class="form-group col-md-6">
               <input class="form-control" name="applicant_designation" id="applicant_designation" placeholder="<?php echo $this->lang->line('manage_gpfdpf_applicant_designation'); ?>" >
             </div>

            <div class="form-group col-md-4">
              <?php echo "&nbsp;&nbsp;&nbsp; (ख) ".$this->lang->line('manage_gpfdpf_applicant_category'); ?> <span class="text-danger">*</span>
            </div>

            <div class="form-group col-md-6">
                  <input class="form-control" name="applicant_category" id="applicant_category" placeholder="<?php echo $this->lang->line('manage_gpfdpf_applicant_category'); ?>">
            </div>

            <div class="form-group col-md-4">
              <?php echo "3. ".$this->lang->line('manage_gpfdpf_dpf_account_no'); ?> <span class="text-danger">*</span>
            </div>
				
			<div class="form-group col-md-6">
                  <input class="form-control" name="dpf_account_no" id="dpf_account_no" placeholder="<?php echo $this->lang->line('manage_gpfdpf_dpf_account_no'); ?>">
            </div>

            <div class="form-group  col-md-4"><?php echo "4. ".$this->lang->line('manage_gpfdpf_account_remaing_amount'); ?></div>

            <div class="form-group col-md-6">
				&nbsp;
			</div>
				
			<div class="form-group  col-md-4"><?php echo "(क) विगत दो वर्ष पूर्व का वर्ष "; $before_year = date('Y')-2; $current_ye = date('Y')-1 ; echo $before_year .'-'.$current_ye?></div>

            <div class="form-group col-md-6">
				<input type="hidden" name="previous_year_txt" id="previous_year_txt" value="<?php echo date('Y') - 1; ?>">
				<input class="form-control" name="previous_year_amnt" id="previous_year_amnt">
			</div>	

            <div class="form-group  col-md-4"><?php echo "(ख) विगत वर्ष ";  $current_ye = date('Y')-1 ;$after_year = date('Y'); echo $current_ye .'-'.$after_year ;?> में जमा</div>

            <div class="form-group col-md-6">
				<input type="hidden" name="current_year_txt" id="current_year_txt" value="<?php echo date('Y'); ?>">
				<input class="form-control" name="current_year_amnt" id="current_year_amnt">
			</div>	

            <div class="form-group  col-md-4 text-center"><?php echo $this->lang->line('manage_gpfdpf_temp_gpf_withdraw'). ' ( - )';   ?></div>

            <div class="form-group col-md-6">
			<input class="form-control" name="gpfdpf_adv" id="gpfdpf_adv">
				<br>
			<input class="form-control" name="gpfdpf_total_amt" id="gpfdpf_total_amt" readonly>
			</div>	

            <div class="form-group  col-md-4"><?php echo "5. (क) ".$this->lang->line('manage_gpfdpf_temp_less_last_gpf'); ?></div>

            <div class="form-group col-md-6">
				<input class="form-control" name="applied_amount_adv" id="applied_amount_adv" placeholder="<?php echo $this->lang->line('manage_gpfdpf_temp_less_last_gpf'); ?>">
			</div>

            <div class="form-group  col-md-10 ">
				<div class="form-group  col-md-6 " style="margin-left:-20px;"><?php echo "6.".$this->lang->line('manage_gpfdpf_temp_gpf_remaining_details'); ?></div>

				<div class="form-group  col-md-4"><?php echo $this->lang->line('manage_gpfdpf_blanck'); ?></div>
			</div>
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
				<p>जिस वर्ष हेतु आवेदन किया जाता है, उस वर्ष में अग्रिम एवं आंशिक अंतिम आहरण का पूर्ण विवरण - २५ प्रतिशत </p>
				<p>वास्तविक उपयोग के उपरांत अतिरिक्त शेष राशि तत्काल कोषालय /बैंक में ब्याज सहित चालान की प्रति आहरण एवं संवितरण अधिकारी को तत्काल उपलब्ध करायी जावेगी | </p>
			</div>

            <div class="form-group  col-md-10">

                <div class="form-group  col-md-6">
				<div class="form-group  col-md-2">दिनांक</div>
				<div class="form-group  col-md-4"><input class="form-control date1" value="<?php echo date('d-m-Y')?>" name="file_type" id="file_type"></div>
			</div>

                <div class="form-group  col-md-4 pull-right">
				
				<div class="form-group  col-md-4"><input type="text" id="employee_name_txt" name="emp_na"><br><input type="text" id="employee_designation_txt" name="emp_designation"></div>
			</div>
		</div>



	   <div class="form-group col-md-4">
                <button class="btn btn-primary margin" id="submit_btn" onclick="return confirm_generate()" type="submit"><?php echo $this->lang->line('button_submit'); ?></button>
                <button class="btn btn-danger margin" type="reset"><?php echo $this->lang->line('button_reset'); ?></button>
       </div>

    </div>

</form>
</div><!-- /.box -->
</div><!-- /.box -->
</div><!-- /.box -->
</section><!-- /.content -->


<?php $this->load->view("empcode_autosuggetion"); ?>