<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo $title; ?>
      <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url(); ?>/advocate/list/<?php echo $this->uri->segment(3)?>">Advocate</a></li>
        <li class="active"><?php echo $page_title; ?></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Your Page Content Here -->
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">	
            <div class="box">
                <div class="box-header">
                    <div style="float:left"><h3 class="box-title"><?php echo $page_title; ?></h3></div>
                       
					  
                    <?php
						
					if($this->uri->segment(2) == 'edit_advocate'){ ?>					   
					    <a class="col-md-2 pull-right"  href="<?php echo base_url();?>advocate/add/<?php echo $this->uri->segment(3); ?>">
	                      <button class="btn btn-block btn-info"><?php echo $this->lang->line('add_button'); ?> </button>
				        </a>
					<?php }?>
					 <a class="col-md-2 pull-right"  href="<?php echo base_url();?>advocate/list/<?php echo $this->uri->segment(3); ?>">
	                      <button class="btn btn-block btn-info"><?php echo "सूची देखे"; ?> </button>
				        </a>
					  <?php if($this->uri->segment(2) == 'add'){ ?>
						   <a class="col-md-2 pull-right"  href="<?php echo base_url();?>advocate/add/<?php echo $adv_type; ?>">
			                      <button class="btn btn-block btn-info"><?php echo $this->lang->line('add_button'); ?> </button>
						   </a>
				   		<?php }?>
                    <div style="float:right;margin-right: 10px;">
						
                        <a href="javascript:history.go(-1)">
                            <button class="btn btn-block btn-warning"><?php echo $this->lang->line('Back_button_label'); ?></button>
                        </a>
                    </div>
					
                </div><!-- /.box-header -->
				
                <?php echo $this->session->flashdata('message'); //pre($this->input->post()); pre($emp_detail); pre($emp_more_detail); ?>
               <?php  if($this->uri->segment(2) == 'edit_advocate'){
				   ?>
				   <form enctype="multipart/form-data" role="form" method="post" action="<?php echo base_url() ?>advocate/edit_advocate/<?php echo $this->uri->segment(3);?><?php if (isset($id)) {
                    echo '/' . $id;
                } ?>">
				   <?php 
				   
			   }else{
				  ?>
					<form role="form" method="post" action="<?php echo base_url() ?>advocate/add/<?php echo $this->uri->segment(3);?>" enctype="multipart/form-data">
				<?php 				  
			   }

			   ?>
						<?php //pr( $adv_details) ?>
						
			   <input type="hidden" name="scm_id" value="<?php echo isset($adv_details['scm_id'])?$adv_details['scm_id']:'' ?>" >
                    <div class="col-md-6">
                        <div class="box box-primary" style="margin-top: 15px;">
                            <div class="box-body">
								<div class="form-group">
									<label><?php echo "नस्ती का शाखा  कमांक ( ब-I) "; ?> :</label>
									<br>
									<div class="col-md-7" ><input type="number" class="form-control section_no col-md-2" name="advocate_file_cr_no" value="<?php echo !empty($adv_details['advocate_file_cr_no'])? $adv_details['advocate_file_cr_no']:$this->input->post('advocate_file_cr_no')?>" ></div>
									<div class="col-md-5" >
										<select name="section_no_year"  class="form-control col-md-2">
										<?php for($year = 2015 ; $year < 2050; $year++ ){ ?>
											<?php if(date('Y') == $year ){ 
												?>
												<option selected='selected' ><?php echo $year ?></option>
												<?php
											}else{ 
												?>
												<option><?php echo $year ?></option>
												<?php
											} ?>
										

										<?php } ?>
										</select>
									</div>
									
									 <?php echo form_error('advocate_file_cr_no'); ?>
									<span id="error-section_number" style="color:red"></span>
								</div>
								<br>
								
								 <?php if($this->uri->segment(3) != 9){?>
								<div class="form-group">
									<label><?php echo $this->lang->line('advocate_applicant_type_label'); ?><span class="text-danger">*</span> :</label>
									
									<?php  $selected  = 'Apply' ;
									if(isset($adv_details['advocate_aplicant_type'])){
										 $selected  = $adv_details['advocate_aplicant_type'] ;
									} else if($this->input->post('advocate_aplicant_type')){
										 $selected  = $this->input->post('advocate_aplicant_type') ;
									} ?>
									<?php echo get_adv_aplicant_type_ddl_list('advocate_aplicant_type', 'class="form-control"',$selected ); ?>
									 <?php echo form_error('advocate_aplicant_type'); ?>
								</div>
								<?php } ?>
								<?php if( $this->uri->segment(3) == 9 ){?>
								
								<div class="form-group">
									<label><?php echo $this->lang->line('adv_meritno_label'); ?> <span class="text-danger">*</span>:</label>
									<input type="number" class="form-control" name="marti_no" value="<?php echo isset($adv_details['marti_no'])? $adv_details['marti_no']:$this->input->post('marti_no'); ?>">
									<?php echo form_error('marti_no'); ?>
								</div>
								<div class="form-group">
									<label><?php echo $this->lang->line('adv_Rollno_label'); ?>:</label>
									<input type="text" class="form-control" name="roll_no" value="<?php echo isset($adv_details['roll_no'])? $adv_details['roll_no']:$this->input->post('roll_no'); ?>">
									<?php echo form_error('roll_no'); ?>
								</div>
								<div class="form-group" >
									<label for="total_interview_label"><?php echo $this->lang->line('total_marks_label'); ?> :</label>
									<input type="text" class="form-control" name="total_interview" value="<?php echo isset($adv_details['total_marks_written'])? $adv_details['total_marks_written']:$this->input->post('total_interview')?>">
									<?php echo form_error('total_interview'); ?>
								</div>
								<?php } ?>
								<?php if($this->uri->segment(3) == 9){ 
									?>
								<input type="hidden" name="advocate_aplicant_type" value="<?php echo "Apply"; ?>">
									<?php } ?>
								<input type="hidden" name="advocate_post_type" value="<?php echo @$advocat_type['adm_id'] ?>">
								
								<div class="form-group">
									<label><?php echo $this->lang->line('emp_full_name_label_hi'); ?> <span class="text-danger">*</span> :</label>
									<input type="text" class="form-control" name="scm_name_hi" value="<?php echo isset($adv_details['scm_name_hi'])? $adv_details['scm_name_hi']:$this->input->post('scm_name_hi')?>" >
									 <?php echo form_error('scm_name_hi'); ?>
								</div>
								<div class="form-group">
									<label><?php echo $this->lang->line('emp_full_name_label_en'); ?><span class="text-danger">*</span> :</label>
									<input type="text" class="form-control" name="scm_name_en"  value="<?php echo isset($adv_details['scm_name_en'])? $adv_details['scm_name_en']:$this->input->post('scm_name_en')?>">
									 <?php echo form_error('scm_name_en'); ?>
								</div>
								 <?php if($this->uri->segment(3) != 9){?>
								<div class="form-group">
									<label><?php echo "कार्य अनुभव (वर्ष में ) "; ?> :</label>
									<input type="number" class="form-control" name="adv_work_experiance" value="<?php echo !empty($adv_details['adv_work_experiance'])? $adv_details['adv_work_experiance']:$this->input->post('adv_work_experiance')?>" >
									 <?php echo form_error('adv_work_experiance'); ?>
								</div>
								<?php } ?>
								<div class="form-group">
									<label><?php echo $this->lang->line('adv_father_name_label'); ?>:</label>
									<input type="text" class="form-control" name="scm_father_name_hi" value="<?php echo isset($adv_details['scm_father_name_hi'])? $adv_details['scm_father_name_hi']:$this->input->post('scm_father_name_hi')?>">
								</div>
								<div class="form-group">
									<label><?php echo $this->lang->line('adv_gender_label'); ?> <span class="text-danger">*</span>:</label>
									<select class="form-control" name="scm_gender" >
									<option value='M' <?php if(isset($adv_details['scm_gender'])){ if($adv_details['scm_gender'] == 'M'){ echo "selected"; } }?> >पुरुष</option>
									<option value='F' <?php if(isset($adv_details['scm_gender'])){ if($adv_details['scm_gender'] == 'F'){ echo "selected"; } } ?> >स्त्री</option>
									<option value='O' <?php if(isset($adv_details['scm_gender'])){ if($adv_details['scm_gender'] == 'O'){ echo "selected"; } } ?> > अन्य </option>
									</select>
									 <?php echo form_error('scm_gender'); ?>
								</div>
								<div class="form-group">
									<label><?php echo $this->lang->line('adv_dob_label'); ?>:</label>
									<input type="text" class="form-control date1" name="scm_dob" value="<?php if(isset($adv_details['scm_dob']) && $adv_details['scm_dob']!= '0000-00-00' &&  $adv_details['scm_dob']!= '1970-01-01' ) { echo date('d-m-Y',strtotime($adv_details['scm_dob']));} else{ echo $this->input->post('scm_dob'); } ?>">
								</div>
								
								<div class="form-group">
									<label><?php echo $this->lang->line('adv_emailid_label'); ?>:</label>
									<input type="email" class="form-control" name="email_id" value="<?php echo isset($adv_details['email_id'])? $adv_details['email_id']:$this->input->post('email_id')?>">
								</div>
								<div class="form-group">
									<label><?php echo $this->lang->line('adv_contactno_label'); ?>:</label>
									<input type="text" class="form-control" maxlength="12" name="contact_no" value="<?php echo isset($adv_details['contact_no'])? $adv_details['contact_no']:$this->input->post('contact_no')?>">
								</div>
								
								<div class="form-group">
									<label><?php echo $this->lang->line('adv_address_hi_label'); ?><span class="text-danger">*</span> :</label>
								<textarea class="form-control" rows="3" name="scm_address_hi"><?php echo isset($adv_details['scm_address_hi'])? $adv_details['scm_address_hi']:$this->input->post('scm_address_hi')?></textarea>
									
									<?php echo form_error('scm_address_hi'); ?>
								</div>
								<div class="form-group">
									<label><?php echo $this->lang->line('adv_address_en_label'); ?> :</label>
									<textarea class="form-control" rows="3" name="scm_address_en"><?php echo isset($adv_details['scm_address_en'])? $adv_details['scm_address_en']:$this->input->post('scm_address_en')?></textarea>
									
								</div>
								
								<div class="form-group">
									<label><?php echo $this->lang->line('adv_address_pincode_label'); ?>:</label>
									<input type="number" class="form-control" name="scm_pincode" maxlength="6" value="<?php echo isset($adv_details['scm_pincode'])? $adv_details['scm_pincode']:$this->input->post('scm_pincode')?>">
								</div>
								
								
								
							
								
							</div>
                        </div><!-- /.box -->
                    </div>
					
					<div class="col-md-6">
                        <div class="box box-primary" style="margin-top: 15px;">
                            <div class="box-body">
								 <?php if($this->uri->segment(3) != 9){?>
								<div class="form-group">
									<label><?php echo $this->lang->line('adv_court_type_label'); ?>:</label>
									<?php   $selected  = '' ;
									if(isset($adv_details['advocate_type'])){
										$selected  = $adv_details['advocate_type'] ;
									}else if($this->input->post('advocate_type')){
										 $selected  = $this->input->post('advocate_type') ;
									} 
									echo get_court_name_ddl_list('advocate_type' , 'class="form-control"',$selected); ?>
								<?php echo form_error('advocate_type'); ?>
								</div>
								<?php } ?>
								
							
									
									<input type="hidden" class="form-control" name="advocate_designation" value="<?php echo isset($adv_details['advocate_designation'])? ($adv_details['advocate_designation']):( isset($title) ? $title: $this->input->post('advocate_designation') )?>" >
								
								<?php if($this->uri->segment(3) != 9 ){ ?>
								<div class="form-group">
									<label><?php echo $this->lang->line('adv_state_label'); ?>:</label>
									<?php  $selected  = '' ;
									if(isset($adv_details['	scm_state_id'])){
										 $selected  = $adv_details['scm_state_id'] ;
									}else if($this->input->post('scm_state_id')){
										 $selected  = $this->input->post('scm_state_id') ;
									} ?>
									<?php echo get_state_ddl_list('scm_state_id', ' class="form-control"',14);  ?>
									<?php echo form_error('scm_state_id'); ?>
								</div>
								<?php } ?>
								<?php if($this->uri->segment(3) != 9 ){ ?>
								<div class="form-group">
									<label><?php echo "जिला"; ?><span class="text-danger">*</span> :</label>
									<?php  $selected  = '' ;
									if(isset($adv_details['scm_district_id'])){
										 $selected  = $adv_details['scm_district_id'] ;
									}else if($this->input->post('scm_district_id')){
										 $selected  = $this->input->post('scm_district_id') ;
									} ?>
									<?php echo  get_distic_ddl_list('scm_district_id', 'id="district_id"  class="form-control"', $selected); ?>
									<?php echo form_error('scm_district_id'); ?>
								</div>
								<?php } ?>
								<?php if($this->uri->segment(3) != 9 ){ ?>
								<div class="form-group">
									<label><?php echo $this->lang->line('adv_tahsil_label'); ?><span class="text-danger">*</span> :</label>
									<?php  $selected  = '' ;
									
									if(isset($adv_details['scm_tahsil_id'])){
										 $selected  = $adv_details['scm_tahsil_id'] ;
									}else if($this->input->post('scm_tahsil_id')){
										 $selected  = $this->input->post('scm_tahsil_id') ;
									} ?>
									<?php 
										echo get_tahsil_ddl_list('scm_tahsil_id',  'id="tahsil_id" class="form-control tahsil_list"  ',$selected ,@$adv_details['scm_district_id']); ?>
									<div id="tahsil_div"></div>
									<?php echo form_error('scm_tahsil_id'); ?>
								</div>
								<?php } ?>
								<?php if($this->uri->segment(3) != 9 && $this->uri->segment(3) != 1 && $this->uri->segment(3) != 2  ){ ?>
								<div class="form-group">
									<label><?php echo $this->lang->line('adv_taluka_label'); ?> :</label>
									<?php  $selected  = '' ;
									if(isset($adv_details['scm_taluka_id'])){
										 $selected  = $adv_details['scm_taluka_id'] ;
									}else if($this->input->post('scm_taluka_id')){
										 $selected  = $this->input->post('scm_taluka_id') ;
									} ?>
									<?php 
										echo  get_taluka_ddl_list('scm_taluka_id' , 'id="taluka_id" class="form-control taluka_list" ',$selected ,@$adv_details['scm_district_id']); ?>
									<div id="taluka_div"></div>

								</div>
								<?php } ?>
								<?php if($adv_type == 4){
									?>
									<div class="form-group">
									<label><?php echo 'प्रथम नियुक्ति दिनांक';?>:</label>
									<input type="text" class="form-control date1" name="first_appointment_date" id="first_appointment_date" value="<?php if(!empty($adv_details['first_appointment_date']) && $adv_details['first_appointment_date'] != '0000-00-00' && $adv_details['first_appointment_date'] != '1970-01-01' ){ echo isset($adv_details['first_appointment_date'])? date('d-m-Y',strtotime($adv_details['first_appointment_date'])):''; }else{ echo $this->input->post('first_appointment_date'); } ?>">
								</div>
								<?php } ?>
								
								<?php if($this->uri->segment(3)!=9 ){?>
								<div class="form-group">
									<label>
										<?php if($adv_type == 4){
											echo "नवीनीकरण / नियुक्ति दिनांक (कब से)"; 
										}else{
 echo $this->lang->line('adv_posting_date_label');
										}?>
										:</label>
								<input type="text" class="form-control date1" name="posting_date" id="posting_date" value="<?php if(!empty($adv_details['posting_date']) && $adv_details['posting_date'] != '0000-00-00'){ echo isset($adv_details['posting_date'])? date('d-m-Y',strtotime($adv_details['posting_date'])):''; }else{ echo $this->input->post('posting_date'); } ?>">
								</div>
								<?php } ?>
								<?php if($this->uri->segment(3) != 9){ ?>
								<div class="form-group">
									<label><?php echo "कार्यकाल"; ?></label>
									
									<?php  $selected  = '' ;
									if(isset($adv_details['provision_pirod'])){
										 $selected  = $adv_details['provision_pirod'] ;
									} else if($this->input->post('provision_pirod')){
										 $selected  = $this->input->post('provision_pirod') ;
									}
									echo get_provision_pirod_ddl_list('provision_pirod' , 'class="form-control" ',$selected ) ;
									?>
									
								</div>
								<?php } ?>
								<?php if($this->uri->segment(3)!=9  ){?>
								<div class="form-group">
									<label><?php echo $this->lang->line('adv_renewal date_label');  
										if($adv_type == 4){ echo '(कब तक)'; } ?>:</label>
									<input type="text" class="form-control" name="post_renew_date" id="post_renew_date"  value="<?php  if(!empty($adv_details['post_renew_date']) && $adv_details['post_renew_date'] != '0000-00-00'){  echo isset($adv_details['post_renew_date'])? date('d-m-Y',strtotime($adv_details['post_renew_date'])):''; } else { echo $this->input->post('post_renew_date') ; } ?>">
								</div>
								<?php } ?>
							
								
								<?php if($this->uri->segment(3)!=9  && $this->uri->segment(2) != 'add' ){?>
								<div class="form-group">
									<label><?php echo $this->lang->line('adv_application_for_renewal_date_label'); ?>:</label>
									<input type="text" class="form-control date1"  name="application_for_renewal_date" value="<?php if( !empty($adv_details['application_for_renewal_date']) && $adv_details['application_for_renewal_date'] != '1970-01-01' && $adv_details['application_for_renewal_date'] != '0000-00-00' ){ echo date('d-m-Y',strtotime($adv_details['application_for_renewal_date']));}else{ echo $this->input->post('application_for_renewal_date'); } ?>">
								</div>
								<?php } ?>
								<?php if($this->uri->segment(3)!=9  && $this->uri->segment(2) != 'add' ){?>
								<div class="form-group">
									<label><?php echo $this->lang->line('adv_invoice_no_label'); ?>:</label>
									<input type="text" class="form-control " name="adv_invoice_no"  id="adv_invoice_no"  value="<?php echo !empty($adv_details['adv_invoice_no'])? $adv_details['adv_invoice_no']:$this->input->post('adv_invoice_no')?>">
								</div>
								<?php } ?>
								<?php if($this->uri->segment(3)!=9  && $this->uri->segment(2) != 'add' ){?>
								<div class="form-group">
									<label><?php echo $this->lang->line('adv_invoice_date_label'); ?>:</label>
									<input type="text" class="form-control date1" name="adv_invoice_date" value="<?php if( !empty($adv_details['adv_invoice_date']) && $adv_details['adv_invoice_date'] != '1970-01-01' && $adv_details['adv_invoice_date'] != '0000-00-00' ){ echo date('d-m-Y',strtotime($adv_details['adv_invoice_date']));}else{ echo $this->input->post('adv_invoice_date'); } ?>" > 
								</div>
								<?php } ?>
								<?php if($this->uri->segment(3) != 9 ){ ?>
								<div class="form-group">
									<label><?php echo $this->lang->line('adv_once_registration_number_council_label'); ?>  :</label>
									<input type="text" class="form-control once_registration_number" name="once_registration_number_council" value="<?php echo isset($adv_details['once_registration_number_council'])? $adv_details['once_registration_number_council']:$this->input->post('once_registration_number_council')?>">
									<span id="error-once_registration" class="text-danger"></span>
								</div>
								<?php } ?>
								<div class="form-group" id="private_lawyer" style="display:none">
									<label for="private_lawyer_fee"><?php echo $this->lang->line('adv_private_lawyer_fee'); ?>:</label>
									<input type="text" class="form-control" name="package_amount" value="<?php echo isset($adv_details['package_amount'])? $adv_details['package_amount']:$this->input->post('package_amount')?>">
								</div>
								<?php if($this->uri->segment(3) == 4  ){?>
								<div class="form-group">
									<label><?php echo $this->lang->line('notery_registration_no_label'); ?> :</label>
									<input type="text" class="form-control" name="notery_registration_no" id="notery_registration_no" value="<?php echo isset($adv_details['notery_registration_no'])? $adv_details['notery_registration_no']:$this->input->post('notery_registration_no')?>">
									
								</div>
								<?php } ?>
								<div class="form-group" id="lokabhiyojak_power" style="display:none">
									<label><?php echo $this->lang->line('adv_lokabhiyojak_power_label'); ?>:</label>
									<textarea class="form-control" rows="3" name="lokabhiyojak_work"><?php echo isset($adv_details['lokabhiyojak_work'])? $adv_details['lokabhiyojak_work']:$this->input->post('lokabhiyojak_work')?></textarea>
								</div>
								<?php if( $this->uri->segment(3) == 1 || $this->uri->segment(3) == 2   ){ ?>
								<div class="form-group " >
									<label> क्य धारा २० के अंतर्गत  हैं? :</label>
									<select name="dhara_twintee_status" id="dhara_twintee_status"  class="form-control">
										<option value='n' <?php if(isset($adv_details['dhara_twintee_status']) && $adv_details['dhara_twintee_status'] == 'n'){ echo "selected"; } ?>> नहीं </option>
										<option value='y' <?php if(isset($adv_details['dhara_twintee_status']) && $adv_details['dhara_twintee_status'] == 'y'){ echo "selected"; } ?>> हाँ </option>
									</select>
								</div>
								
								<div class="form-group dhara_twintee_status " style='<?php if(!empty($adv_details['dhara_twintee_status']) && $adv_details['dhara_twintee_status'] == 'y'){ echo "display:block"; }else{ echo "display:none"; } ?>' >
									<label><?php echo "धारा २० के अंतर्गत रिमार्क"; ?>:</label>
									<textarea class="form-control" rows="3" name="dhara_twintee_remark" ><?php echo isset($adv_details['dhara_twintee_remark'])? $adv_details['dhara_twintee_remark']:$this->input->post('dhara_twintee_remark')?></textarea>
								</div>
								<?php } ?>
								<?php if( $this->uri->segment(3) == 9 ){ ?>
								<div class="form-group">
									<label><?php echo $this->lang->line('adv_home_district_label'); ?><span class="text-danger">*</span> :</label>
									<?php  $selected  = '' ;
									if(isset($adv_details['home_district'])){
										 $selected  = $adv_details['home_district'] ;
									}else if($this->input->post('home_district')){
										 $selected  = $this->input->post('home_district') ;
									} ?>
									<?php echo  get_distic_ddl_list('home_district', 'id="home_district"  class="form-control"', $selected); ?>
									<?php echo form_error('home_district'); ?>
								</div>
								<div class="form-group">
									<label><?php echo $this->lang->line('adv_residential_address_label'); ?> <span class="text-danger">*</span>:</label>
									<textarea class="form-control" rows="3" name="residential_address" ><?php echo isset($adv_details['residential_address'])? $adv_details['residential_address']:$this->input->post('adv_remarke')?></textarea>
									<?php echo form_error('home_district'); ?>
								</div>
							
								<div class="form-group">
									<label><?php echo $this->lang->line('physical_handicap_label'); ?> :</label>
									<select name="id_physical_handicap" id="id_physical_handicap"  class="form-control">
										<option value='n' <?php if(isset($adv_details['id_physical_handicap']) && $adv_details['id_physical_handicap'] == 'n'){ echo "selected"; } ?>> नहीं </option>
										<option value='y' <?php if(isset($adv_details['id_physical_handicap']) && $adv_details['id_physical_handicap'] == 'y'){ echo "selected"; } ?> > हाँ </option>
									</select>
								</div>
								<div class="form-group">
									<label> क्या <?php echo $this->lang->line('attach_fitness_cert_label'); ?> संलग्न हैं? :</label>
									<select name="attach_fitness_cert_status" id="attach_fitness_cert_status"  class="form-control">
									<option value='n' <?php if(isset($adv_details['fitness_file_upload_path']) && $adv_details['fitness_file_upload_path'] == 'n'){ echo "selected"; } ?>> नहीं </option>
									<option value='y' <?php if(isset($adv_details['fitness_file_upload_path']) && $adv_details['fitness_file_upload_path'] == 'y'){ echo "selected"; } ?> > हाँ </option>
									</select>
								</div>
								<div class="form-group attach_fitness_cert_status" <?php if(!empty($adv_details['attach_fitness_cert_status']) &&  $adv_details['attach_fitness_cert_status']== 'y'){ echo 'style="display:block"; '; } else { echo 'style="display:none"; '; }?>  >
									<label><?php echo $this->lang->line('adv_physical_handicap_file_label'); ?> :</label>
									<input type="file" name="fitness_cert_path" class="form-control" >
								</div>
								
								
								<div class="form-group" >
									<label><?php echo $this->lang->line('cast_category_label'); ?> :</label>
									<select name="cast_category" id="cast_category" class="form-control">
										<?php $cast_categories = cast_category_array();
												foreach($cast_categories as $key=>$category){?>
										<option value='<?php echo $key; ?>' <?php if(isset($adv_details['category_name']) && $adv_details['category_name'] == $key){ echo "selected"; } ?>> <?php echo $category; ?> </option>
										<?php } ?>
										
									</select>
								</div>
								
								<div class="form-group  cast_category_cert_status" <?php if(!empty($adv_details['is_cast_cert_upload']) &&  $adv_details['is_cast_cert_upload']== 'y'){ echo 'style="display:block"; '; } else { echo 'style="display:none"; '; }?> >
									<label> क्या <?php echo $this->lang->line('cast_category_label'); ?> संलग्न हैं? :</label>
									<select name="cast_category_cert_status" id="cast_category_cert_status"  class="form-control">
										<option value='n' <?php if(isset($adv_details['is_cast_cert_upload']) && $adv_details['is_cast_cert_upload'] == 'n'){ echo "selected"; } ?>> नहीं </option>
										<option value='y' <?php if(isset($adv_details['is_cast_cert_upload']) && $adv_details['is_cast_cert_upload'] == 'y'){ echo "selected"; } ?>> हाँ </option>
									</select>
								</div>
								<div class="form-group uploda_cc" <?php if(!empty($adv_details['is_cast_cert_upload']) &&  $adv_details['is_cast_cert_upload']== 'y'){ echo 'style="display:block"; '; } else { echo 'style="display:none"; '; }?> >
									<label><?php echo $this->lang->line('cast_category_file_label'); ?> :</label>
									<input type="file" name="cast_category_file" class="form-control" >
								</div>
								<div class="form-group " >
									<label> क्या <?php echo $this->lang->line('non_opjection_certificate_label'); ?> संलग्न हैं? :</label>
									<select name="non_opjection_cert_status" id="non_opjection_cert_status"  class="form-control">
										<option value='n' <?php if(isset($adv_details['non_opjection_cert_status']) && $adv_details['non_opjection_cert_status'] == 'n'){ echo "selected"; } ?>> नहीं </option>
										<option value='y' <?php if(isset($adv_details['non_opjection_cert_status']) && $adv_details['non_opjection_cert_status'] == 'y'){ echo "selected"; } ?>> हाँ </option>
									</select>
								</div>
								<div class="form-group  non_opjection_cert_status" <?php if(!empty($adv_details['non_opjection_cert_status']) &&  $adv_details['non_opjection_cert_status']== 'y'){ echo 'style="display:block"; '; } else { echo 'style="display:none"; '; }?>  >
									<label><?php echo $this->lang->line('non_opjection_cert_file_label'); ?> :</label>
									<input type="file" name="non_opjection_cert_file" class="form-control" >
								</div>
								
								<div class="form-group " >
									<label> क्या चरित्र प्रमाण संलग्न हैं? :</label>
									<select name="is_character_cert_status" id="is_character_cert_status"  class="form-control">
										<option value='n' <?php if(isset($adv_details['is_character_cert_status']) && $adv_details['is_character_cert_status'] == 'n'){ echo "selected"; } ?>> नहीं </option>
										<option value='y' <?php if(isset($adv_details['is_character_cert_status']) && $adv_details['is_character_cert_status'] == 'y'){ echo "selected"; } ?>> हाँ </option>
									</select>
								</div>
								<div class="form-group is_character_cert_status"   <?php if(!empty($adv_details['is_character_cert_status']) &&  $adv_details['is_character_cert_status']== 'y'){ echo 'style="display:block"; '; } else { echo 'style="display:none"; '; }?> >
									<label><?php echo $this->lang->line('charater_certificate_file_label'); ?> :</label>
									<table  id="budget_again"  class="budget_again" >
										<tr>
											<td>राज्य</td>
											<td>ज़िला</td>
											<td>प्रमाण पत्र</td>
											<!--<td>
												<input type="hidden" name="total_row" class="total_row" value="<?php //echo count($adv_character_details)?>">
												<input type="button" onClick="return addrow_budget(); " id="addrowo_budget" value="Add Row" />
												</td> -->
										</tr>
										<?php if(count(@$adv_character_details) > 0 ){  
											foreach($adv_character_details as $character_det){		
												$state_id = $character_det['state_id'];
												$district_id  = $character_det['district_id'];
												$upload_file_name = $character_det['upload_file_name'];
											?>
											<tr id="ctr_row">
											<td><?php echo get_state_ddl_list('ctr_state_id', ' class="form-control col-md-3"  id="ctr_state_lst"',$state_id);  ?></td>
											<td><div id="dist_list"><?php echo  get_distic_ddl_list('ctr_district_id', 'id="ctr_district_id"  class="form-control col-md-3"',$district_id); ?></div></td>
											<td><input type="file" name="ctr_charater_certificate_file" class="form-control" ></td>
											<!--<td></td>-->
										</tr>		
											<?php } ?>
										<?php }else{ ?>
										<tr id="ctr_row">
											<td><?php echo get_state_ddl_list('ctr_state_id', ' class="form-control col-md-3"  id="ctr_state_lst"');  ?></td>
											<td><div id="dist_list"><?php echo  get_distic_ddl_list('ctr_district_id', 'id="ctr_district_id"  class="form-control col-md-3"'); ?></div></td>
											<td><input type="file" name="ctr_charater_certificate_file" class="form-control" ></td>
											<!--<td></td>-->
										</tr>
										<?php } ?>
										<tr id="ctr_div"><td colospan="4"></td>
									</tr>										
									</table>
								</div>
								
								
								<?php } ?>
								<div class="form-group">
									<label><?php echo $this->lang->line('adv_remarke_label'); ?>:</label>
									<textarea class="form-control" rows="3" name="adv_remarke" ><?php echo isset($adv_details['adv_remarke'])? $adv_details['adv_remarke']:$this->input->post('adv_remarke')?></textarea>
								</div>
								<div class="box-footer">
									<button type="submit" onclick="return confir_post_data();" class="btn btn-primary">जमा करें</button>
								</div>
							</div>
                        </div><!-- /.box -->
                    </div>
                    </form>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div><!-- /.row -->
<!-- Main row -->
</section><!-- /.content -->

<?php $this->load->view('advocates_js'); ?>
