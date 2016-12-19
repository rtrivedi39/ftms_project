<?php $sed_id = $file_data[0]['file_mark_section_id']; 
?>

<style>
    input[type=checkbox] + label {
        color: #dd4b39;
    }
    input[type=checkbox]:checked + label {
        color: #398439;
    }
</style>
	<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo $title; ?>
        <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo $this->lang->line('active_page'); ?></li>
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
        <div style="float:left"><h3 class="box-title"><?php echo $title_tab;?></h3></div>
        <button class="btn btn-warning" onclick="goBack()" style="float:right"><?php echo $this->lang->line('Back_button_label'); ?></button>
    </div>

    <?php
    if($is_page_edit){ ?>
        <div style="float:right">
            <a href="<?php echo base_url();?>/cr_manage_file">
                <button class="btn btn-block btn-info"><?php echo $this->lang->line('add_new'); ?></button>
            </a>
        </div>
    <?php } ?>

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
<?php //echo validation_errors(); ?>
<div class="col-md-12">
    <!-- general form elements -->
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title"><?php echo $this->lang->line('add_file'); ?></h3>
        </div><!-- /.box-header -->
        <form role="form" method="post" action="<?php echo base_url()?>scan/save_dealing<?php if(isset($file_data[0]['file_id'])){ echo '/'.$file_data[0]['file_id'];} ?>"  enctype="multipart/form-data">
		  <input type="hidden" name="scan_files_id" id="scan_files_id">
          <input type="hidden" name="section_id" value="<?php echo $sed_id; ?>">
		  <div class="box-body">
           <div class="col-md-6">
					<div class="form-group">
                        <label for="section no"><?php echo $this->lang->line('File_section_no'); ?> :- </label>
                        <b><?php echo isset($file_data[0]['file_id']) ? getfilesec_id_byfileid($file_data[0]['file_id'] , $file_data[0]['file_mark_section_id']) : ''; ?></b>
                    </div>
			<div class="form-group">
			<?php 	if( !empty($file_data[0]['scan_id'])){ ?>
			 <label for="section no"><?php echo "सभी स्कैन की गई फाइल"; ?> :- </label>
			</div>
			<div class="form-group">
				<ul>
				<?php 
				
				if(isset($file_data[0]['scan_id']) && !empty($file_data[0]['scan_id'])){
				
				$scan_ids = unserialize($file_data[0]['scan_id']); 
				
				$scan_id_values = get_scan_files($scan_ids);
				//pr($scan_ids);
				// explode(',',$file_data[0]['scan_id']) ; 
					foreach($scan_id_values as $scanid){
						if(!empty($scanid)){
						$scan_file_details = scan_file_details($scanid);
						$file_path = $scan_file_details['scan_file_path'];
						?>
						<li class="my_scan_file_2" style="text-align:left; "><a onclick="open_file_in_viewer( <?php echo $scanid ;?>,'<?php echo $file_path; ?>')" style="cursor:pointer"><?php echo get_scan_file_name($scanid); ?></a><button type="button" onclick="open_model2_addbookmark(<?php echo $scanid; ?>)" class="btn btn-box-tool add_bookmark"><i class="fa fa-plus"></i> Add bookmark</button></li>
                            <?php if(!empty($scan_file_details['scan_bookmark_page'])){
                                $bookmark = unserialize($scan_file_details['scan_bookmark_page']);
                                foreach($bookmark as $key1 => $bookmark3){?>
                                    <a class="btn-sm" onclick="open_file( <?php echo $scanid ;?>,'<?php echo $file_path.'#page='.$key1; ?>')"><?php echo "Page no. ".$key1." - ".$bookmark3;?></a><br/>
                                <?php  } }?>
								<?php 
				} } }?>
				</ul>
		
			</div>
				<div id="pdfRenderer" style="border: 1px solid gray;"></div>
				<div class="form-group" id="scan_file_div">
					<?php   $last_scan_id = end($scan_id_values);
					 $scan_file_details = scan_file_details($last_scan_id);
					 $scan_file = isset($scan_file_details['scan_file_path'])?$scan_file_details['scan_file_path']:'';
					 if(!empty($scan_file) && isset( $scan_file)){
				?>
					<object id="pdf_viewer" data="<?php echo base_url(). $scan_file; ?>" type="application/pdf" width="100%" height="600px">

					<p>It appears you don't have a PDF plugin for this browser.
                    No biggie... you can <a href="<?php echo base_url()?>/uploads/Leave Management Application.pdf">click here to
                        download the PDF file.</a></p>

					</object>
			
					 <?php } }?>

					<?php 
					 if(empty($file_data[0]['scan_id'])) {
						
						 ?>
						 <object data="<?php echo base_url(); ?>uploads/scan/viwer_example.pdf" type="application/pdf" width="100%" height="600px">

                <p>It appears you don't have a PDF plugin for this browser.
                    No biggie... you can <a href="<?php echo base_url()?>/uploads/Leave Management Application.pdf">click here to
                        download the PDF file.</a></p>

					</object>
						 <?php 
					 }
					?>
		</div>
			</div>

                <div class="col-md-6">
				<div class="form-group">
						<label for="file_type"><?php echo $this->lang->line('label_type'); ?></label> <span class="text-danger">*</span></label>
						<select class="form-control" name="file_type" id="file_type">
							<?php foreach(file_types() as $key => $value){
            $selected = '' ;
            if($file_data[0]['file_type'] == $key){
                $selected = 'selected' ;
            }
            echo '<option value="'.$key.'"  '.$selected.'>'.$value.'</option>';
							} ?>
						</select>
						<?php echo form_error('file_type');?>
					</div>

<?php if($file_data[0]['file_mark_section_id'] != 19 && $file_data[0]['file_mark_section_id'] != 7) { ?>
                    <div class="form-group">
                        <label for="file_head"><?php echo $this->lang->line('file_head'); ?></label>
                        <select class="form-control" name="file_head" id="file_head">
                            <option value="">Select</option>
                            <?php $head_notesheet = get_list(HEADS_MASTER,null,array('section_id'=>$file_data[0]['file_mark_section_id'])); ?>
							<?php foreach($head_notesheet as $row){ ?>
                                <option value="<?php echo $row['head_code']; ?>" <?php  if($this->input->post('file_head')==$row['head_code'] || @$file_data[0]['file_head_id']==$row['head_code'] ){ echo 'selected';} ?>><?php echo $row['head_code']." - ".$row['head_title']; ?></option>
                            <?php } ?>
                        </select>
                        <?php //echo form_error('file_head');?>
                    </div>
					<?php } ?> 

<div <?php if($sed_id == 7 || $sed_id == 25) { echo "style='display: none'"; } else { echo "style='display: block'";} ?>>
                    <div class="form-group">
                        <label for="file_uo_number"><?php if($file_data[0]['file_type'] == 'f') {
                                echo $this->lang->line('label_uo_number');  $date1 = $this->lang->line('label_uo_date');
                            } elseif ($file_data[0]['file_type'] == 'l') {
                                echo $this->lang->line('label_letterno_number');  $date1 = $this->lang->line('label_letterno_date');
                            } else {
                                echo $this->lang->line('label_uo_number')." / ".$this->lang->line('label_letterno_number');
                            } ?>  <span class="text-danger">*</span></label>
                        <input type="text" name="file_uo_number" value="<?php echo isset($file_data[0]['file_uo_or_letter_no']) ? $file_data[0]['file_uo_or_letter_no'] : ''; ?>" placeholder="<?php echo $this->lang->line('placeholder_dispatch_number'); ?>" class="form-control" >
                        <?php echo form_error('file_uo_number');?>
                    </div>

                    <div class="form-group">
                        <label for="file_type"><?php if($file_data[0]['file_type'] == 'f') {
                                echo $this->lang->line('label_uo_date');
                            } elseif ($file_data[0]['file_type'] == 'l') {
                                echo $this->lang->line('label_letterno_date');
                            } else {
                                echo $this->lang->line('label_uo_date')." / ".$this->lang->line('label_letterno_date');
                            } ?> <span class="text-danger">*</span></label>
                        <input type="text" name="file_uo_date" id="file_uo_date" value="<?php echo isset($file_data[0]['file_uo_or_letter_date']) ? date_format(date_create($file_data[0]['file_uo_or_letter_date']),'d-m-Y') : ''; ?>" placeholder="<?php echo $this->lang->line('placeholder_dispatch_date'); ?>" class="form-control" >
                        <?php echo form_error('file_uo_date');?>
                    </div>
                    </div>

                    <div class="form-group">
                        <label for="file_subject"><?php echo $this->lang->line('label_subject'); ?> <span class="text-danger">*</span></label>
                        <textarea class="form-control"  name="file_subject" ><?php echo isset($file_data[0]['file_subject']) ? $file_data[0]['file_subject'] : ''; ?></textarea>
                        <?php echo form_error('file_subject');?>
                    </div>

					<div class="form-group">
                        <label for="file_subject_en">विषय अंग्रेजी में  <?php // echo $this->lang->line('label_subject‌_en'); ?></label>
                        <textarea class="form-control"  name="file_subject_en" ><?php echo isset($file_data[0]['file_subject_en']) ? $file_data[0]['file_subject_en'] : ''; ?></textarea>
                       
                    </div>
<div <?php if($sed_id == 11 || $sed_id == 12 || $sed_id == 13 || $sed_id == 19 || $sed_id == 7 || $sed_id == 25) { echo "style='display: none'"; } else { echo "style='display: block'";} ?>>

								<div class="form-group">
									<label for="file_subject"><?php echo $this->lang->line('appeal_petition'); ?> <span class="text-danger">*</span></label>
									<input type="text" name="courts_name_location" value="<?php echo isset($file_data[0]['courts_name_location']) ? $file_data[0]['courts_name_location'] : ''; ?><?php echo (@$this->input->post('courts_name_location')) ? @$this->input->post('courts_name_location') : '' ; ?>" class="form-control">
									<?php echo form_error('courts_name_location');?>
								</div>


						<div class="form-group">
							<label for="file_subject"><?php echo $this->lang->line('Party_name_petition'); ?> <span class="text-danger">*</span></label>
							<?php
							$petition_toname='';
							if($file_data[0]['case_parties']!=''){
								$cparray= explode('-',$file_data[0]['case_parties']);
								$petition_toname=$cparray[0];
							}
							?>
							<input type="text" name="party_petition" value="<?php echo (@$this->input->post('party_petition')) ? @$this->input->post('party_petition') : $petition_toname ; ?>" class="form-control">
							<?php echo form_error('party_petition');?>
						</div>
						
						<div class="form-group">
							<label for="file_subject"><?php echo $this->lang->line('Party_name_respondent'); ?> <span class="text-danger">*</span></label>
							<input type="text" name="Party_name_respondent" value="<?php echo (@$this->input->post('Party_name_respondent')) ? @$this->input->post('Party_name_respondent') : 'मध्य प्रदेश शासन' ; ?>" class="form-control">
							<?php echo form_error('Party_name_respondent');?>
						</div>
					<?php if($file_data[0]['old_registared_no']!=0 ){ 			?>
					 <div class="form-group"    >
                        <label for="old_registared_no"><?php echo $this->lang->line('old_registared_no_label'); ?> </label>
                        <input type="text" name="old_registared_no" id="old_registared_no"  value="<?php echo (@$this->input->post('old_registared_no')) ? @$this->input->post('old_registared_no') : $file_data[0]['old_registared_no'] ; ?>" class="form-control">
                       
                    </div>
					<?php } ?>
					</div>
					<?php if(in_array($file_data[0]['file_mark_section_id'],array('15','2','10','14'))){ ?>
						<div class="form-group">
							<label for="judgement_data"><?php echo $this->lang->line('judgement_data'); ?> <span class="text-danger">*</span></label>
							<input type="text" name="judgement_data" id="judgement_data" value="<?php echo $file_data[0]['file_judgment_date'] != "0000-00-00" ? date_format(date_create($file_data[0]['file_judgment_date']),'d-m-Y') : $this->input->post('judgement_data'); ?>" class="form-control">
							<?php  echo form_error('judgement_data');?>
						</div>
					<?php } ?>
                    <input type="hidden" name="file_offer_by" value="<?php echo $file_data[0]['file_Offer_by']; ?>">
                    <?php if($sed_id == 15 || $sed_id == 11 || $sed_id == 12 || $sed_id == 19 || $sed_id == 2 || $sed_id == 10){  ?>
						<div class="form-group">
							<label for="prosecution file type">
							 <?php if($sed_id == 15){ ?> <label for="prosecution file type" id="procecution_label"  ><?php echo $this->lang->line('file_ka_prakar'); ?> </label> <?php } ?>
							 <?php if($sed_id == 12){ ?> <label for="BII file type" id="nyayic_sec_2label" ><?php echo $this->lang->line('file_ka_prakar_b2'); ?> </label><?php } ?>
							 <?php if($sed_id == 11){ ?> <label for="BII file type" id="nyayic_sec_1label" ><?php echo $this->lang->line('file_ka_prakar_b1'); ?> </label><?php } ?>
							 <?php if($sed_id == 19){ ?>  <label for="lib file type" id="lib_sec_1label" ><?php echo $this->lang->line('file_ka_prakar_lib'); ?> </label><?php } ?>
							<?php if($sed_id == 2){ ?>  <label for="pettion file type" id="petition_sec_1label" >फाइल का प्रकार  </label><?php } ?>
							 <?php if($sed_id == 10){ ?>  <label for="civil file type" id="civil_sec_1label" >फाइल का प्रकार  </label><?php } ?>
								
					
							 <span class="text-danger">*</span></label>
							
							<select class="form-control" name="section_file_type" >
								<option value="">  <?php if($sed_id == 15){ ?> <?php echo $this->lang->line('file_ka_prakar'); ?> <?php } ?>
								 <?php if($sed_id == 12){ ?> <?php echo $this->lang->line('file_ka_prakar_b2'); ?><?php } ?>
								 <?php if($sed_id == 11){ ?> <?php echo $this->lang->line('file_ka_prakar_b1'); ?><?php } ?>
								 <?php if($sed_id == 19){ ?> <?php echo $this->lang->line('file_ka_prakar_lib'); ?><?php } ?>
								<?php if($sed_id == 2){ ?> फाइल का प्रकार <?php } ?>
								 <?php if($sed_id == 10){ ?> फाइल का प्रकार <?php } ?>
								</option>		
								<?php

									if($sed_id == 11){
										$presecution_file_type= get_BI_file_type(); /*function define in common helper. Database filed name : section_file_type in ft_files */
									}
									if($sed_id == 12){
										$presecution_file_type= get_BII_file_type(); /*function define in common helper. Database filed name : section_file_type in ft_files */
									}
									if($sed_id == 15){
										$presecution_file_type= get_prosecution_file_type(); /*function define in common helper. Database filed name : section_file_type in ft_files */
									}
									if($sed_id == 19){
										$presecution_file_type= get_lib_file_type(); /*function define in common helper. Database filed name : section_file_type in ft_files */
									}
									if($sed_id == 2){
										$presecution_file_type= get_petition_file_type(); /*function define in common helper. Database filed name : section_file_type in ft_files */
									}
									if($sed_id == 10){
										$presecution_file_type= get_civil_file_type(); /*function define in common helper. Database filed name : section_file_type in ft_files */
									}
									foreach($presecution_file_type as $pftype => $value){ ?>
										<option value="<?php echo $pftype; ?>" <?php if($file_data[0]['section_file_type']==$pftype){ echo 'selected';} ?>><?php echo $value; ?></option>
							<?php } ?>
							</select>
							<?php echo form_error('section_file_type');?>
						</div>
					<?php } ?>
					<?php if($sed_id == 11){ ?>
                    <div class="form-group">
					<?php $section_category_array = section_category_array() //print_r();?>
                        <label for="section_file_categoty"><?php echo $this->lang->line('label_section_file_categoty'); ?> <span class="text-danger"> *</span></label>
                        <select class="form-control" name="section_file_categoty" id="section_file_categoty" >
                            <option value=""><?php echo $this->lang->line('label_section_file_categoty'); ?></option>
                            <?php foreach($section_category_array as $key_sec_category=>$section_category){ ?>
									<option value="<?php echo $key_sec_category; ?>" <?php  if(@$file_data[0]['section_file_categoty'] == $key_sec_category){ echo 'selected';}else if($this->input->post('section_file_categoty') == $key_sec_category){ echo 'selected'; } ?>><?php echo $section_category; ?></option>
                            <?php } ?>
                        </select>
                        <?php echo form_error('section_file_categoty');?>
                    </div>
					<?php } ?>
					

										<div class="form-group">
    <label for="offer_by"><?php echo $this->lang->line('offer_by'); ?></label> <!-- <span class="text-danger">*</span>  -->
                <select class="form-control" name="file_offer_by" id="file_offer_by">
                    <option value=""><?php echo $this->lang->line('option_select_from'); ?></option>
                    <?php foreach(file_from_type() as $key => $value){ ?>
                        <option value="<?php echo $key ?>" <?php if (@$file_data[0]['file_Offer_by'] == $key) { echo "selected";} ?>><?php echo $value ?></option>
                    <?php   } ?>
                </select>
                <?php echo form_error('file_offer_by');?>
            </div>

			<?php if($sed_id == 2 || $sed_id == 11 ){ ?>
						<div class="form-group">
							<label for="High_court_bench"><?php echo $this->lang->line('High_court_bench'); ?></label>
							<?php $highcourt = highcourt_bench() ; ?>
							<!--<input type="text" name="court_bench" value="<?php  // echo isset($file_data[0]['court_bench_id']) && $file_data[0]['court_bench_id'] !=0 ? $highcourt[$file_data[0]['court_bench_id']] : ''; ?>" class="form-control" <?php // if ($file_data[0]['court_bench_id'] != 0) echo ""; ?>>-->
							<select name="court_bench"  class="form-control">
								<option value="">Select</option>
								<?php foreach($highcourt as $key => $court) {?>
									<option value="<?php echo $key ?>" <?php if(@$file_data[0]['court_bench_id']== $key){ echo 'selected';} ?>><?php echo $court?></option>
								<?php } ?>
							</select>
							</select>
							<?php echo form_error('court_bench');?>
						</div>
				<?php }  ?>

                    <div class="form-group">
                        <label for=" file_department_id"><?php echo $this->lang->line('label_dept_name'); ?></label>
                        <select class="form-control" name="file_department_id" id="file_department_id" >
                            <option value=""><?php echo $this->lang->line('option_select_dept'); ?></option>
                            <?php foreach($departments_list as $row){ ?>
									<option value="<?php echo $row['dept_id']; ?>" <?php  if(@$file_data[0]['file_department_id'] == $row['dept_id']){ echo 'selected';} ?>><?php echo $row['department_default_no']." - ".$row['dept_name_hi']; ?></option>
                            <?php } ?>
                            
                        </select>
                        <?php echo form_error('file_department_id');?>
                    </div>

                    <div class="form-group">
                        <label for="district_id"><?php echo $this->lang->line('label_district_name'); ?></label>
                        <select class="form-control" name="district_id" >
                            <option value=""><?php echo $this->lang->line('option_select_district'); ?></option>
                            <?php $i = 1; foreach($district_list as $row){ ?>
									<option value="<?php echo $row['district_id']; ?>" <?php  if(@$file_data[0]['file_district_id'] == $row['district_id']){ echo 'selected';} ?>><?php echo $i." - ".$row['district_name_hi'].'('.$row['district_name_en'].')'; ?></option> 
								<?php $i++; } ?>
                            
                        </select>
                        <?php echo form_error('district_id');?>
                    </div>

                <div class="form-group">
                        <label for="stat_id"><?php echo $this->lang->line('label_state_name'); ?></label>
                    <select class="form-control" name="state_id" id="state_id">
                        <option value="">14 - मध्यप्रदेश(Madhya Pradesh)</option>
                        <?php $i = 1; foreach($state_list as $row){ ?>
                            <option value="<?php echo $row['state_id']; ?>" <?php  if($file_data[0]['file_state_id'] == $row['state_id']){ echo 'selected';} ?>><?php echo $i." - ".$row['state_name_hi'].'('.$row['state_name_en'].')'; ?></option>
                            <?php $i++; } ?>
                    </select>
                </div>


                    <div class="form-group">
                        <label for="file_department_name" id="other_label"><?php echo $this->lang->line('more_detail'); ?></label>
                        <input type="text" name="file_department_name" id="file_department_name" value="<?php echo @$file_data[0]['file_department_name'] ? $file_data[0]['file_department_name'] : $this->input->post('file_department_name') ?>" placeholder="<?php echo $this->lang->line('more_detail'); ?>" class="form-control">
                        <?php// echo form_error('file_department_name');?>
                    </div>

<div <?php if($sed_id == 11 || $sed_id == 12 || $sed_id == 13 || $sed_id == 19 || $sed_id == 7 || $sed_id == 25) { echo "style='display: none'"; } else { echo "style='display: block'";} ?>>

						<div class="form-group">
                        <label for="file_subject"><?php echo $this->lang->line('case_no'); ?> <?php if(isset($this->session->userdata['emp_section_id']) && ($this->session->userdata['emp_section_id']==2 || $this->session->userdata['emp_section_id']==10 || $this->session->userdata['emp_section_id']==14)){ ?> <span class="text-danger non_req">*</span> <?php } ?> </label>
                        <span class="pull-right"> <input value="1" type="checkbox" id="is_prakaran" name="is_prakaran">  यदि नस्ती/पत्र पर प्रकरण क्रं नही है तो टिक करें |</span>
						<?php
							//   if($file_data[0]['case_no']!=''){  }
							$c1 = explode(',',$file_data[0]['case_no']);
							$i=0;
							foreach ($c1 as $case_no_type) {
                            $case1= explode('/',$case_no_type);?>
                            <div class="row">
							<?php if($file_data[0]['file_mark_section_id']!=15){?>
                                <div class="col-xs-4">
                                    <select name="files_other_feilds[case_type][<?php echo $i ?>]" class="form-control non_required" <?php if(isset($this->session->userdata['emp_section_id']) && ($this->session->userdata['emp_section_id']==2 || $this->session->userdata['emp_section_id']==10 || $this->session->userdata['emp_section_id']==14)){ ?> required <?php } ?> >
                                        <option value="">Select</option>
                                        <?php foreach(case_name() as $case){ ?>
                                            <option value="<?php echo $case ?>" <?php if(isset($case1[0]) && $case1[0] == $case) { echo "selected" ;} ?>><?php echo $case ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php echo form_error('case_type');?>
                                </div>
							<?php } ?>
                                <div class="col-xs-4">
                                    <input type="text"  name="files_other_feilds[case_no][<?php echo $i ?>]" value="<?php echo isset($case1[1]) ? $case1[1] : '' ; ?>" class="form-control non_required" <?php if(isset($this->session->userdata['emp_section_id']) && ($this->session->userdata['emp_section_id']==2 || $this->session->userdata['emp_section_id']==10 || $this->session->userdata['emp_section_id']==14)){ ?> required <?php } ?> >
                                    <?php echo form_error('case_no');?>
                                </div>
                                <div class="col-xs-4">
                                    <select Name='files_other_feilds[case_year][<?php echo $i ?>]' class="form-control non_required" <?php if(isset($this->session->userdata['emp_section_id']) && ($this->session->userdata['emp_section_id']==2 || $this->session->userdata['emp_section_id']==10 || $this->session->userdata['emp_section_id']==14)){ ?> required <?php } ?> >
									<?php
                                        for ($x=date("Y"); $x>2000; $x--) { ?>
                                            <option value="<?php echo $x ?>" <?php if(isset($case1[2]) && $case1[2] == $x){ echo "selected" ;} ?>><?php echo $x ?></option>';
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <?php $i++; } ?>

						</div>
					</div>
                    	<div class="form-group text-center">
							<a href="<?php echo base_url().'scan_files/csu_upload_files/'.$file_data[0]['file_id']; ?>"  class="btn bg-purple">Browse File</a>
							<!--<a href="#" onclick="get_file_poup()" class="btn bg-purple">UPLOAD File</a>-->
						
							<button type="button" onclick="open_model_csu(<?php echo $file_data[0]['file_id']; ?>);" data-file_status12 = "<?php echo $file_data[0]['file_status']; ?>"  class="btn bg-purple btn_mark_csu">Mark to scan unit</button>
							<div id="upload_files_id"></div>
						</div>
                    <div class="form-group text-center">
                        <input type="checkbox" name="check_field" class="check_field12">
                        <label><?php echo $this->lang->line('check_field'); ?></label><?php echo form_error('check_field');?>
                    </div>
                    <input type="hidden" name="file_mark_section_id" value="2">
                    <div class="box-footer text-right">
                        <button class="btn btn-primary load_btn" id="btn_sub1" disabled onclick="return confirm('कृपया सुनिश्चित करे की आप यह फाइल दर्ज करना चाहते हैं |')" type="submit"><?php echo $this->lang->line('button_submit'); ?></button>
                   
                    </div>
                    <span class="text-danger"><?php echo $this->lang->line('m_note'); ?></span>
                    <input type="hidden" name="last_url_name" value="<?php echo $refering_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : ''; ?>"/>
                </div>
            </div><!-- /.box-body -->
        </form>
    </div><!-- /.box -->
</div>
</div>
</div><!-- /.row -->
<!-- Main row -->
</section><!-- /.content -->
<?php $this->load->view('scan_file_js')?>
<?php $this->load->view("scan_files/add_scan_bookmark"); ?>
<script>
        $("#is_prakaran").click(function() {
          /*  var is_prakaran = $('#is_prakaran').val(); */            
            if ($('#is_prakaran').is(":checked"))
			{
				$(".non_required" ).prop('required',false);
				$(".non_req" ).html('');
			}   else{
			    $(".non_required" ).prop('required',true);
			   $(".non_req" ).html('*');
			}    
        });
</script>