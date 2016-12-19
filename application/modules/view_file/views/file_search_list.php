<!-- Content Header (Page header) -->
<?php   
$emp_session_id =  emp_session_id();
$user_sections = getusersection($emp_session_id);
$sections_allot = explode(',',$user_sections);
$section_count = count($sections_allot); 
$section_id = 0;
if($section_count == 1){
	$section_id = $user_sections;
}
$file_from = file_from_type();
$high_bench =  highcourt_bench();
$userrole = checkUserrole();
$Employee_lists_estab =  get_establishment_employees('so')  ;
foreach($Employee_lists_estab as $esta_emp){
	$establiment_empids[] = $esta_emp['emp_id'];
}?>
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
            <div class="box box-primary">
               <div class="box-header no-print">					
					<h3 class="box-title"><?php echo $title_tab; ?></h3>
					<div class="pull-right box-tools"> 
						<?php if(in_array(11, $sections_allot) || in_array(12, $sections_allot)){ 
							//if($this->session->userdata('emp_id') == 1){ ?>
							<a class="btn btn-info" href="<?php echo base_url();?>view_file/file_search/file_search_out_of_dep">विभाग की बाहर भेजी गयी नस्तियां</a>
						<?php } ?>
						<a class="btn btn-primary" href="<?php echo base_url();?>view_file/file_search?task=reopen">फाइल को पुनः खोलें </a>
						<?php if($userrole == 1) {?><a class="btn btn-danger" href="<?php echo base_url();?>view_file/file_search?task=fileclose">फाइल को बंद करें </a><?php } ?>
						<a class="btn btn-primary" href="<?php echo base_url();?>view_file/file_search?task=fileedit">फाइल का बदलाव करें </a>
						<button class="btn btn-warning" title="Back" onclick="goBack()" ><?php echo $this->lang->line('Back_button_label'); ?></button>
					</div>
                </div><!-- /.box-header -1-->
				<div class="box-header">
					<?php if($this->input->get('task') == 'reopen') { ?>
						 <div class="callout callout-info">
							<h4>फाइल पुनः खोलने के लिए खोजे</h4>
							<p>जो फाइल बंद हो गयी है और आपको पुनः खोलना है उसे  यहाँ खोजे </p>
						 </div>
					<?php } else if($this->input->get('task') == 'fileclose'){  ?>
						 <div class="callout callout-info">
							<h4>फाइल बंद करने के लिए खोजे</h4>
							 <p>जिस फाइल  को बंद करना  है उसे  यहाँ खोजे </p>
					<?php } else if($this->input->get('task') == 'fileedit'){  ?>
						 <div class="callout callout-info">
							<h4>फाइल का बदलाव करने के लिए खोजे</h4>
							 <p>जिस फाइल का बदलाव  करना है उसे  यहाँ खोजे </p>
					<?php }?>
				</div><!-- /.box-header -2 -->
			    <form method="post" action="" class="no-print">
					<div class="box-body">
							<!-- row search type -->
							<div class="row">	
								<div class="col-xs-6 col-md-3"></div>							
								<div class="col-xs-6 col-md-4">
									<div class="input-group">
										<div class="input-group-btn">
											<button type="button" class="btn btn-primary">खोज का प्रकार</button>
										</div>
										<select class="form-control" name="search_type" required id="search_type">
											<option value="" >--- खोजनें का प्रकार चयन करें ---</option>
												<?php foreach(file_searchtypes()  as $key => $value) { ?>
													<option value="<?php echo $key; ?>" <?php echo @$this->input->post('search_type') == $key ? "selected" : false?>><?php echo $value; ?></option>
												<?php } ?>
										</select>
										<?php echo form_error('search_type');?>

									</div>
															</div>	
															<div class="col-xs-6 col-md-4">
                                    <select class="form-control" name="check_table" required id="check_table">
                                        <option value="wip" <?php @$this->input->post('check_table') == 'wip' ? 'selected' : '' ?>>Working File</option>
                                        <option value="close" <?php @$this->input->post('check_table') == 'close' ? 'selected' : '' ?>>Close File</option>
                                    </select>
                                </div>
							</div><!-- /.row -->
							<hr class="clearfix">
							<div id="search_fltr_div" class="row search_filter" <?php if($this->input->post('search_type') ){ ?> style="display:block" <?php } else{?> style="display:none;" <?php } ?>>
								
								<div class="col-xs-2 col-md-2" id="dis4" <?php  if(($this->input->post('search_type') == '10') || ($this->input->post('search_type') == '6')|| ( $this->input->post('search_type') == '10' )){ echo  "style='display:none'" ;} echo @$this->input->post('search_type') == '2'  || @$this->input->post('search_type') == '9'  || @$this->input->post('search_type') == '7'  || @$this->input->post('search_type') == '1'  || $this->input->post('search_type') == '3' || $this->input->post('search_type') == '4' || $this->input->post('search_type') == '8'|| $this->input->post('search_type') == '13' ? "style='display: block'" : "style='display: '" ; ?>  ><!--- dist div for section -------->
											<label>सेक्शन का चयन करें <span class="text-danger">*</span></label>
											<select name="sections" id="search_section_wise" class="form-control">
												<option value="">सेक्शन का चयन करें</option>
												<?php $emp_sections = getSectionData($sections_allot);
													
													foreach($emp_sections  as $empsec){ 
														$section_details = $empsec->section_name_hi.'('.$empsec->section_name_en.')';
														$selected = null; 
														if((@$this->input->post('sections') == $empsec->section_id) || ($section_count == 1 && $empsec->section_id == $section_id) ){
															 $selected = "selected";
														}
													?>
													<option value="<?php echo $empsec->section_id ?>" <?php echo $selected; ?>><?php echo $section_details ; ?></option>
												<?php  }?>
												<?php if($this->session->userdata('emp_section_id') != 1){ ?>
													<option value="1" <?php echo @$this->input->post('sections') == '1' ? "selected" : false?>>आवक (CR)</option>
												<?php } ?>
												<option value="8" <?php echo @$this->input->post('sections') == '8' ? "selected" : false?>>जावक (Dispatch)</option>
											</select>
											<?php echo form_error('sections');?>
								  </div><!--- end dist div for section -------->
								<!-- get dispetch file --->
								<div class="col-xs-6 col-md-6 dispatch_div dispatch_block" style="display:none" >
									
									<div class="col-xs-4 col-md-4 dispatch_block" <?php echo $this->input->post('search_type') == '11' ? "style='display: block'" : "style='display: none'"?>>
										<label>जावक शाखा में भेजी दिनांक</label>
										<input type="text" placeholder="Date"  name="date_distpach" id="date_distpach" autocomplete="off"  value="" class="form-control ps_moniter_date">
										<?php echo form_error('date_distpach');?>
									</div>
									<div class="col-xs-4 col-md-4 dispatch_block" <?php echo $this->input->post('search_type') == '11' ? "style='display: block'" : "style='display: none'"?>>
										<label> सेक्शन का चयन करें </label>
										<select name="sections_all" id="" class="form-control">
											<option value=""> -- सेक्शन का चयन करें -- </option>
											<?php  foreach($emp_sections  as $empsec){ 
											$section_details = $row->section_name_hi.'(22'.$row->section_name_en.')';
											?>
												<option value="<?php echo $empsec ?>" <?php echo @$this->input->post('sections_all') == $empsec->section_id ? "selected" : false?>><?php echo $section_details ; ?></option>
											<?php  }?>
										</select>
									</div>
									<div class="col-xs-4 col-md-4 dispatch_block" <?php echo $this->input->post('search_type') == '11' ? "style='display: block'" : "style='display: none'"?>>
										<label> नस्ती की स्थिति  </label>
										<select name="dispatch_type" class="form-control">
										<!--<option value="all">All</option>-->
										<option value="not_received">Not Received</option>
										<option value="received">Received</option>
										<option value="close">Close</option>
									</select>
									<?php echo form_error('dispatch_type');?>
									</div>
										
							</div>
							
							
						<!-- END get dispetch file --->
								   <!---  monthwise div   -------->
								   <div class="col-xs-4 col-md-4" id="dis3" <?php echo @$this->input->post('search_type') == '5' ? "style='display: block'" : "style='display: none'"?>>
										  <label>माह का चयन करें </label>
										
									   <select name="months" id="search_month_wise" class="form-control">
											<?php foreach (months() as $key => $val) {
												if(date("m") >= $key) { ?>
													<option value="<?php echo $key ?>" <?php if ($key == date("m")) { echo "selected"; } ?>><?php echo $val." / ".date("Y") ; ?></option>
												<?php } } ?>
										</select>
										<?php echo form_error('file_type');?>
									</div>
								 <!--- END monthwise div  -------->
								 <div class=" col-xs-3 col-md-3" id="emp_per_month" <?php echo @$this->input->post('search_type') == '5' ? "style='display: block'" : "style='display: none'"?> >
									<label>Employee jo login hai</label>
									<input type="text" name="emp_per_month" id="emp_per_month" value="<?php echo $this->session->userdata('emp_full_name_hi')?>"   class="form-control" disabled="disabled">
								</div> 
								  <div class="col-xs-3 col-md-3 search_value_div" id="search_value_div" <?php if($this->input->post('search_type') == '13' || $this->input->post('search_type') == '7' || $this->input->post('search_type') == '12'|| $this->input->post('search_type') == '5' || $this->input->post('search_type') == '9'  || $this->input->post('search_type') == '11' || $this->input->post('search_type') == '10'  ){ echo "style='display:none'"; }?>><!--- search_value_div -------->
									  <label id="search_value_label"><?php if($this->input->post('search_type')== 3 ){ echo "UO/Letter No."; } else if($this->input->post('search_type')== 4 ){ echo "UO/Letter Date"; } else if($this->input->post('search_type')== 1 ){ echo "पंजी क्र."; } else  if($this->input->post('search_type')== 1 ){ echo " पंजी क्र. "; }else  if($this->input->post('search_type')== 8 ){ echo " विषय "; }else  if($this->input->post('search_type')== 2 ){ echo " पक्षकार "; }else  if($this->input->post('search_type')== 6 ){ echo " System File ID "; }else { ?> दर्ज करें   <?php } ?><span class="text-danger">*</span></label>
									  
									  <div id="dis1"  <?php echo @$this->input->post('search_type') != '5' && $this->input->post('search_type') != '9'   && $this->input->post('search_type') != '10' && $this->input->post('search_type') != '7' && $this->input->post('search_type') != '4'  && $this->input->post('search_type') != '11' && $this->input->post('search_type') != '12' && $this->input->post('search_type') != '13' ? "style='display: block'" : "style='display: none'"?> >
										   <input type="text"  name="search_value" id="search_value" value="<?php echo @$this->input->post('search_value') ? $this->input->post('search_value') : ''  ?>" autocomplete="off" placeholder="Put Value"  class="form-control">
										   <?php echo form_error('search_value');?>
									  </div>

									  <div id="dis2" <?php echo @$this->input->post('search_type') == '4' ? "style='display: block'" : "style='display: none'"?>> 
										<!--- uo later date -->
											<input type="text" placeholder="From Date" name="frm_dt" id="frm_dt" autocomplete="off" value="<?php echo @$this->input->post(frm_dt); ?>" class="form-control">
											<?php echo form_error('frm_dt');?>
										<!--- uo later date -->
									  </div>
									</div><!--- end search_value_div -------->

									<div class="col-xs-2 col-md-2" id="year_search" <?php echo @$this->input->post('search_type') == '10' || @$this->input->post('search_type') == '6' || @$this->input->post('search_type') == '5' || @$this->input->post('search_type') == '12' ? "style='display: none'" : "style='display: block'" ?>><!---  year block-------->
									   <label>वर्ष का चयन करें</label>
									   <select class="form-control" id="s_files_year" name="s_files_year">
										<?php $i = '2015';
										while($i <= date('Y')) { 	
											$s_files_year = $this->input->post('s_files_year');
											?>
											<option value="<?php echo $i ; ?>" <?php if($s_files_year){ echo $s_files_year == $i ? 'selected' : ''; }else{ echo date('Y') == $i ? 'selected' : '';  }?>><?php echo $i ;?></option>
											<?php $i++; } ?>
										</select>
									</div><!--- end syear block -------->

									<div class="col-xs-4 col-md-4 show_movement_dt" <?php if( ($this->input->post('search_type') == '8') || ($this->input->post('search_type') == '7') || ($this->input->post('search_type') == '1') || ($this->input->post('search_type') == '4') || ($this->input->post('search_type') == '3') || ($this->input->post('search_type') == '2') ||  ($this->input->post('search_type') == '9') || ( $this->input->post('search_type') == '11') || ( $this->input->post('search_type') == '13')|| ( $this->input->post('search_type') == '5') ) { echo "style='display: block'";} else if(( $this->input->post('search_type') == '12') || ( $this->input->post('search_type') == '10') || ( $this->input->post('search_type') == '6')) { echo "style='display: none'"; } ?> ><!--- movement_date div -->
										<div class="row">
											<div class="col-xs-12">	
											<label>आवागमन दिनांक <span class="text-danger" style="font-size:10px;">  (जरूरी हो तो ही दर्ज करें अन्यथा रिक्त रहने दे)  </span></label>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-6 ">												
												<input type="text" placeholder="कब से" name="movement_frm_dt" id="movement_frm_dt" value="<?php echo $this->input->post('movement_frm_dt')?>" autocomplete="off"  class="form-control">
												<?php echo form_error('movement_frm_dt');?>
											</div>

											<div class="col-xs-6">
												<input type="text" placeholder="कब तक" name="movement_to_dt" id="movement_to_dt" autocomplete="off" value="<?php echo $this->input->post('movement_to_dt')?>"  class="form-control">
												<?php echo form_error('movement_to_dt');?>
											</div>
										</div>
								  </div><!---END movement_date div -->

								 <div class="col-xs-5 col-md-5"  id="psmonitor" <?php echo @$this->input->post('search_type') == '12' ? "style='display: block'" : "style='display: none'"?>><!-- for Ps monitor.-->
										<div class="row">   
										   <div class="col-xs-6">
												  <label>माह का चयन करें </label>
												<select name="ps_months" class="form-control">
													<?php foreach (months() as $key => $val) { ?>
															<option value="<?php echo $key ?>" <?php if ($this->input->post('ps_months') == $key) { echo "selected"; } ?>><?php echo $val; ?></option>
														<?php } ?>
												</select>
												<?php echo form_error('ps_months');?>
											</div>

											<div class="col-xs-6">
												 <label>वर्ष का चयन करें </label>
												<select Name='ps_case_year' class="form-control"><?php
													for ($x=date("Y"); $x>2000; $x--) { ?>
													   <option <?php echo @$this->input->post('ps_case_year') == $x ? 'selected' : false ; ?> value="<?php echo $x ; ?>"><?php echo $x ; ?></option>';
													<?php } ?>
												</select>
												<?php echo form_error('ps_case_year');?>
											</div>
										</div>
									</div><!-- End Ps monitor-->

									<!--- case no div -->
								   <div class="col-xs-4 col-md-4 show_case" <?php echo @$this->input->post('search_type') == '7' ? "style='display: block'" : "style='display: none'"?> >
										<div class="row">
											<div class="col-xs-12">	
												<label>प्रकरण चयन करें</label>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-4 col-md-4">	
												<select name="case_type"  id="search_case_type" class="form-control">
													<option value="">प्रकरण चयन करें</option>
													<?php foreach(case_name() as $case){ ?>
														<option value="<?php echo $case ?>" <?php if($this->input->post('case_type') == $case ){ echo "selected"; } ?>><?php echo $case ?></option>
													<?php } ?>
												</select>
												<?php echo form_error('case_type');?>
											</div>
											<div class="col-xs-4 col-md-4">
												<input type="text" name="case_no" id="search_case_no" placeholder="Number" value="<?php if($this->input->post('case_no')){ echo $this->input->post('case_no'); } ?>" class="form-control">
												<?php echo form_error('case_no');?>
											</div>
											<div class="col-xs-4 col-md-4">
												<select Name='case_year' class="form-control">
													<?php for ($x=date("Y"); $x>2000; $x--)	{ 	?>
														<option value="<?php echo $x ?>" <?php if($this->input->post('case_year') == $x ){ echo "selected" ; }?>><?php echo $x ?></option>
													<?php } ?>
												</select>
												<?php echo form_error('case_year');?>
											 </div>
										</div>
								 </div> <!-- End case no.-->
								
							  <div  class="  show_search_dt_filter no-print" <?php echo @$this->input->post('search_type') == '10' ? "style='display: block'" : "style='display: none'"?>>
                                <div class="col-xs-3  col-md-3">
									<label>चयन करें कर्मचारी / शाखा</label>
                                    <select id="filter_section_emp_wise"  name="filter_section_emp_wise" class="form-control ">
                                        <option value="">चयन करें</option>
                                            <option value="emp" <?php if(@$filter_section_emp_wise=='emp'){ echo 'selected';} ?>>Employees</option>
                                            <option value="sec" <?php if(@$filter_section_emp_wise=='sec'){ echo 'selected';} ?>>Sections</option>
                                    </select>
                                    <?php //echo form_error('filter_section_emp_wise  ');?>
                                </div>
                                <div class="col-xs-3  col-md-3">
									<label>कब तक</label>
                                    <select id="section_emp_list" name="empid_secid" class="form-control " >
                                        <option value="">चयन करें</option>
                                    </select>
                                    <?php //echo form_error('empid_secid');?>
                                    
                                </div>
                                <div class="col-xs-3  col-md-3">
									<label>कब से</label>
                                    <input type="text" placeholder="From Date"  name="search_frm_dt" id="search_frm_dt" autocomplete="off" value="<?php echo $frm_date; ?>"  class="form-control ps_moniter_date ">
                                    <?php //echo form_error('search_frm_dt');?>
                                </div>
                                <div class="col-xs-3  col-md-3">
									<label>कब तक</label>
                                    <input type="text" placeholder="To Date"  name="search_to_dt" id="search_to_dt" autocomplete="off"  value="<?php echo $to_date; ?>" class="form-control ps_moniter_date ">
                                    <?php //echo form_error('search_to_dt');?>
                                </div>

                            </div>
							</div><!-- /.row -->
							<hr class="clearfix">

							<div class="row send_department" style="<?php if($this->input->post('search_type') == 13  ){ echo 'display:block'; } else { echo 'display:none'; } ?>">
								  <div class="col-xs-3 col-md-3">

										<label for="offer_by"><?php echo $this->lang->line('offer_by'); ?> </label>
										<select class="form-control" name="file_offer_by" id="file_offer_by">
											<option value=""><?php echo $this->lang->line('option_select_from'); ?></option>
											<?php foreach(file_from_type() as $key => $value){ ?>
												<option value="<?php echo $key ?>" <?php if ($this->input->post('file_offer_by') == $key) { echo "selected";} ?>><?php echo $value ?></option>
											<?php   } ?>

										</select>
									  <?php echo form_error('offer_by');?>
										</div>
									 <div class=" col-md-3 col-xs-3"  id="High_court_show" <?php if($this->input->post('file_offer_by') == 'm' || $this->input->post('file_offer_by') == 'u') { echo "style='display: block'"; } else { echo "style='display: none'";} ?>>
										<label for="High_court_bench"><?php echo $this->lang->line('High_court_bench'); ?></label>
										<select class="form-control" name="court_bench" id="court_bench">
											<option value=""><?php echo $this->lang->line('option_select_from'); ?></option>
											<?php $i = 1; foreach(highcourt_bench() as $key => $value){ ?>
												echo '<option value="<?php echo $key ?>" <?php if ($this->input->post('court_bench') == $key) { echo "selected";} ?>><?php echo $i.' - '.$value ?></option>
											<?php $i++; } ?>
										</select>

									</div>
									 <div class=" col-md-3 col-xs-3" id="dept_id_show" <?php if($this->input->post('file_offer_by') == 'v') { echo "style='display: block'"; } else { echo "style='display: none'";} ?>>
										<label for="file_department_id"><?php echo $this->lang->line('label_dept_name'); ?></label>
										<select class="form-control" name="file_department_id" id="file_department_id">
											<option value=""><?php echo $this->lang->line('option_select_dept'); ?></option>
												<?php  $departments_list           = get_list(DEPARTMENTS, 'department_default_no', null,'ASC');?>
											<?php foreach($departments_list as $row){ ?>
												<option value="<?php echo $row['dept_id']; ?>" <?php  if($this->input->post('file_department_id')==$row['dept_id']){ echo 'selected';} ?>><?php echo @$row['department_default_no']==1000 ? '' :  $row['dept_name_hi']." - ".$row['department_default_no']; ?></option>
											<?php } ?>
											<option value="400"><?php echo $this->lang->line('option_other'); ?></option>
										</select>

									</div>
									<div class=" col-md-3 col-xs-3" id="state_id_show" <?php if($this->input->post('file_offer_by') == 'au') { echo "style='display: block'"; } else { echo "style='display: none'";} ?>>
									<label for="district_id"><?php echo $this->lang->line('label_state_name'); ?></label>
									<select class="form-control" name="state_id" id="state_id">
										<option value="">Select</option>
										<?php $i = 1; foreach($state_list as $row){ ?>
											<option value="<?php echo $row['state_id']; ?>" <?php  if($this->input->post('state_id')==$row['state_id']){ echo 'selected';} ?>><?php echo $i." - ".$row['state_name_hi'].'('.$row['state_name_en'].')'; ?></option>
										<?php $i++; } ?>
									</select>

								</div>
								<div class=" col-md-3 col-xs-3 dist_id_show" id="dist_id_show" <?php if($this->input->post('file_offer_by') == 'c' || $this->input->post('file_offer_by') == 'jvn' || $this->input->post('file_offer_by') == 'v' || $this->input->post('file_offer_by') == 'm' || $this->input->post('file_offer_by') == 'o') { echo "style='display: block'"; } else { echo "style='display: none'";} ?>>
								<label for="district_id"><?php echo $this->lang->line('label_district_name'); ?></label>
								<select class="form-control" name="district_id" id="district_id">
									<option value=""><?php echo $this->lang->line('option_select_district'); ?></option>
									<?php  $district_list  = get_list(DISTRICT, 'district_name_hi', null,'ASC');?>
									<?php $i = 1; foreach($district_list as $row){ ?>
										<option value="<?php echo $row['district_id']; ?>" <?php  if($this->input->post('district_id')==$row['district_id']){ echo 'selected';} ?>><?php echo $row['district_name_hi'].'('.$row['district_name_en'].') - '.$i; ?></option>
									<?php $i++; } ?>
									<option value="400"><?php echo $this->lang->line('option_other'); ?></option>
								</select>
								</div>
								<div class=" col-md-3 col-xs-3 " id="dept_name_show1" <?php if( $this->input->post('file_offer_by')){ echo 'style="display:block" '; }else { echo 'style="display:none" '; }?> >
								<label for="file_department_name" id="other_label"><?php echo $this->lang->line('more_detail'); ?></label>
								<input type="text" name="file_department_name" id="file_department_name" value="<?php echo @$this->input->post('file_department_name') ? $this->input->post('file_department_name') : false ?>" placeholder="<?php echo $this->lang->line('more_detail'); ?>" class="form-control">
							</div>
						</div>

					</div><!-- box body -->
					<div class="box-footer search_filter" <?php if($this->input->post('search_type')){ ?> style="display:block" <?php } else { ?> style="display:none" <?php } ?>>
						<div class="pull-left" ><label>Note : (*) Fields are required.</label></div>
						<div class="pull-right" >
								<button type="submit" class="btn btn-primary">खोजें</button>
								<a href="<?php echo base_url()?>view_file/file_search" class="btn btn-warning"> <i class="fa fa-refresh"> </i> पेज को फिर से लोड करें </a>
						</div>
					</div><!-- box footer -->
				</form>
			</div><!-- /.box -->
		</div>	<!-- /.col-12 -->
	</div>	<!-- /.row -->
				
 <?php if(isset($get_files)){ ?>
			<div class="row" id="divname">
				<div class="col-xs-12" style="overflow: auto">
				  <div class="box box-primary">
					<?php if(!empty($get_files)) { ?>					
					 <div class="box-header">
						 <?php if(count(@$get_files)>0){ ?>
							<?php if(isset($filter_section_emp_wise) && $filter_section_emp_wise=='emp'){ 
									$reportname='';
								}else if(isset($filter_section_emp_wise) && $filter_section_emp_wise=='sec'){ 
									$reportname=''; 
								}else {
									$reportname='';
								} 
							?>
						<h3 class="box-title">Total Number of Files: <b><?php if(empty($get_files[0])){ echo '0';}else{ echo count($get_files); }?></b></h3>
						<div class="text-center">
							<b><?php echo $search_by_temp_section_emp_name.' '.$reportname; ?> </b> Files <?php if($filter_search_frm_date!='' && $filter_search_to_date!=''){ ?> from <b><?php echo $filter_search_frm_date; ?></b> to <b><?php echo $filter_search_to_date; ?></b><?php } ?>
							<b><?php echo $this->input->post('date_distpach')!='' ? $this->input->post('date_distpach') : '' ;?></b>
					    </div> 
						<div class="box-tools pull-right bg-info" style="font-size: 18px;">
							<button onclick="printContents('divname')" class="btn btn-primary no-print">Print</button>
						</div>
						<?php } ?>
					 </div>
					 <div class="box-body">
						 <table class="table table-bordered table-hover">
						  <thead>
						  <tr>
							<th><?php echo $this->lang->line('sno'); ?></th>
							<th class="no-print"><?php echo $this->lang->line('section_no1'); ?> जावक</th>
							<th><?php echo $this->lang->line('view_file_subject'); ?></th>
							<th><?php echo $this->lang->line('section_no1'); ?> शाखा</th>
							<th class="no-print"><?php echo $this->lang->line('view_mark_section'); ?></th>
							<th><?php echo $this->lang->line('uo/letter_no'); ?></th>
							<th><?php echo $this->lang->line('view_file_uo_letter_date'); ?></th>
						   <?php if($data_search_type == '11') { ?>
							<th>किस विभाग को</th>
							<th>जावक का पंजी नंबर</th>
							<th>हस्ताक्षर</th>
						  <?php }  else { ?>
							<th>किस विभाग से</th>
							<th> विभाग में प्राप्ति दिनांक<?php //echo $this->lang->line('date'); ?></th>
							<th> निराकरण दिनांक<?php //echo $this->lang->line('date'); ?></th>
						   <?php } ?>
							<th class="no-print"><?php echo $this->lang->line('filestatus'); ?></th>
							<?php if(isset($_GET['task']) && ($_GET['task']=='reopen' || $_GET['task']=='fileedit'  || $_GET['task']=='fileclose') ){?>
								<th class="no-print"> कार्यवाही करें</th>
							<?php } ?>
						</tr>
						</thead>
						<tbody>
						<?php  
						$i=1; foreach ($get_files as $key => $files) { 

							if(is_array($files)){
							   foreach ($files as $key1 => $file) {  ?>
								 <tr <?php if(!isset($_GET['task']) && $_GET['task']!='reopen'){?> onClick="showcomp(<?php echo $file->file_id; ; ?>)" <?php } ?> style="cursor:pointer"; data-toggle="tooltip" data-original-title="View file">
									<td><?php echo $i;?> <br>
									 <?php if(isset($section_id) && ($section_id == 1)){?>(<b>File ID : </b> <?php echo $file->file_id; ?>) <br/> <?php } ?> 

									 <?php
									if(isset($files->file_id)){ 									 
									 $section_number_array= get_cr_section_nuber($files->file_id); ?> 
									<?php if(isset($section_number_array['section_number']) && $section_number_array['section_number']!='') {?><br/> CR-<?php echo $section_number_array['section_number'];?><?php } 
									} ?>
									 </td>
									 <td class="no-print">
										 <b><?php 
											if(isset($file->file_id) ){ 
										 		echo getfilesec_id_byfileid($file->file_id,'8',$file->file_type) ? getfilesec_id_byfileid($file->file_id,'8',$file->file_type) : 'N/a' ; 
											}else { echo 'N/a'; } ?>
										<b> <br/>
										<?php  if(!empty($file->dispetch_file_type)){ 
											echo '<i class="text-warning fa fa-mars-stroke"></i>';
										} ?>	
									</td>
									<td><?php echo $file->file_subject;?><br><?php if(isset($file->scan_id) && $file->scan_id != ''){ show_scan_file($file->scan_id);}?>
										<br><?php if(isset($file->file_status) && $file->file_status != '') {show_file_status($file->file_status);}?>
										<br><div style="float:right"><b data-original-title="PS monitor due date" data-toggle="tooltip"><?php  if(($file->ps_moniter_date != '0000-00-00') && ($file->ps_moniter_date !='1970-01-01')){ echo (@$file->ps_moniter_date)? 'Date  : '. date('d-m-Y' , strtotime($file->ps_moniter_date)):''; } ?></b>
									</td>
									<td>
										<?php echo getfilesec_id_byfileid($file->file_id,$file->file_mark_section_id,$file->file_type); ?>
										<?php echo '<br/><span title="Central Receipt Number">CR-'.getfilesec_id_byfileid($file->file_id,'1',$file->file_type).'</span>';?>
									</td>
									<td class="no-print"><?php echo getSection($file->file_mark_section_id); ?></td>								
									<td><?php echo $file->file_uo_or_letter_no; ?> (<?php echo getFileType($file->file_type) ;?>)</td>                           
									 <td><?php if(isset($file->file_uo_or_letter_date) && $file->file_uo_or_letter_date != '0000-00-00'){ echo date_format(date_create($file->file_uo_or_letter_date), 'd/m/y'); } ?></td>
									<?php if($data_search_type == '11') { ?>
										<td><?php 
									if(isset($file->dispatch_lists) && ($file->dispatch_lists != '' && $file->dispatch_lists != 'null')) {
											$dispatch_lists = json_decode($file->dispatch_lists);
											echo '<table>';
											foreach($dispatch_lists as $row){
													echo '<tr><td>'.$row.'</td>';									
												}
											echo '</table>';
										} else {
											$file_from = file_from_type();
											$high_bench =  highcourt_bench();
											if(isset($file->file_Offer_by) && isset($file_from)) {
												echo   $filetosent = @$file->file_Offer_by == 'c' || @$file->file_Offer_by == 'jvn' ? @$file_from[$file->file_Offer_by] ." , ". @$file->district_name_hi." <br/>" : false ;
											}
											if(isset($file->file_Offer_by)  && isset($file_from)  || isset($high_bench)) {
												//pre($high_bench[$file->court_bench_id]);
												echo  $filetosent = @$file->file_Offer_by == 'm' || @$file->file_Offer_by == 'u' ? @$file_from[$file->file_Offer_by] ." , ". $high_bench[$file->court_bench_id] : false ;
												echo   $filetosent = @$file->file_Offer_by == 'v' || @$file->dept_name_hi ?  @$file->dept_name_hi ." ".(isset($file->file_department_name)?$file->file_department_name:'') : (isset($file->file_department_name)?$file->file_department_name:'');
											}
										}?></td> 
										<td></td>
										<td></td>
									  <?php }  else { ?>
										 <td>
										<?php 
											//print_r($establiment_empids );
											//echo $file->createfile_empid;
											if( in_array($file->createfile_empid ,$establiment_empids ) && empty($file->file_Offer_by)){
												echo "विधि एवं विधायी कार्य विभाग";
											}else{									

											echo   $file->file_Offer_by == 'c' || $file->file_Offer_by == 'jvn' ? $file_from[$file->file_Offer_by] ." , ". $file->district_name_hi : false ;
											echo    $file->file_Offer_by == 'm' || $file->file_Offer_by == 'u' ? (isset($file_from[$file->file_Offer_by])?$file_from[$file->file_Offer_by]:'') ." , ". (isset($high_bench[$file->court_bench_id])?$high_bench[$file->court_bench_id]:'') : false ;
											echo    $file->file_Offer_by == 'sc' ? $file_from[$file->file_Offer_by] ." , Delhi , दिल्ली" : false ;
											echo    $file->file_Offer_by == 'v' || $file->dept_name_hi ?  $file->dept_name_hi ." ".$file->file_department_name : $file->file_department_name;
											}
										?>
										</td>
										<td><?php //echo date_format(date_create($file->file_update_date), 'd/m/y'); ?>
											<?php echo date_format(date_create($file->file_created_date), 'd/m/y'); ?>
										   <!--(<?php if($file->file_hardcopy_status == 'not'){ echo $this->lang->line('mark_date');} else { echo $this->lang->line('received_date');} ?>)-->
									   </td>
										<td>	
											<?php $dispetch_date_array=array(); $dispetch_date_array= get_file_dispos_date(null,$file->file_id); 
												if(isset($dispetch_date_array) && !empty($dispetch_date_array)){
													echo get_date_formate($dispetch_date_array['dispatch_date'],'d/m/y'); 
												}else{ echo 'N/A';}
											?>
										</td>
									   <?php } ?>

									<td align="" class="no-print"><?php							
										$filereceiver = get_user_details($file->file_received_emp_id);
										if ($filereceiver)
										{
											if($file->file_hardcopy_status == 'not') {									
											   echo file_not_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi);
											} else if($file->file_hardcopy_status == 'close') {										
											   echo file_closed_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi, $file->file_type);
											} else  if($file->file_hardcopy_status == 'received') {										
												echo file_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi);
											} else if($file->file_hardcopy_status == 'working'){										
												echo file_working_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi);
											}
										   } 
									?></td>
									<?php if(isset($_GET['task']) && $_GET['task']=='reopen'){?>
										<td>
											<?php if($file->file_hardcopy_status=='close'){ ?>
											<a class="btn bg-olive margin" onclick="confirm_reopen(<?php echo $file->file_id; ?>);">पुनः खोलें </a>
											<?php }else {?>
											<button class="btn bg-olive margin" type="button" onClick="showcomp(<?php echo $file->file_id; ?>)">View File</button>
											<?php } ?>
										</td>
									<?php } else if(isset($_GET['task']) && $_GET['task']=='fileedit'){?>
										<td>
											<?php //pre($files[0]->file_received_emp_id); ?>
											<?php if(($file->file_hardcopy_status=='received' || $file->file_hardcopy_status=='working') && $file->file_received_emp_id==$this->session->userdata("emp_id")){ ?>
												<a class="btn bg-olive margin"  href="<?php echo base_url();?>dashboard/dealing/<?php echo $file->file_id;?>">बदलाव करें</a>
											<?php }else {?>
												<b class="text-red">
													बदलाव के लिए फाइल का प्राप्त करना आवश्यक हैं <br/>
													<span class="text-yellow blink">बदलाव नहीं कर सकते  </span>
												</b>
													<button class="btn bg-olive margin" type="button" onClick="showcomp(<?php echo $file->file_id; ?>)">View File</button>
											<?php } ?>
										</td>
										<?php }elseif(isset($_GET['task']) && $_GET['task']=='fileclose' ){ ?>
											<td>
											<?php if($file->file_hardcopy_status == 'close'){  ?>
												फाइल पहले से ही बंद है|
											<?php }else {?>
												<button onclick="open_model_dispose(<?php echo $file->file_id; ?>)" class="btn btn-sm btn-block btn-danger rty1" value="<?php echo $file->file_id; ?>" data-toggle="tooltip" data-original-title="Dispose in section"><i class="fa fa-sort-down"></i> नस्ती को बंद करें</button>
											<?php } ?>
											 </td>
										<?php } ?>
				</tr>
							  <?php }
							} else {  ?>
				<tr <?php if(isset($_GET['task']) && $_GET['task']=='reopen'){} elseif(isset($_GET['task']) && $_GET['task']=='fileclose') {} else{?> onClick="showcomp(<?php echo $files->file_id; ?>)" <?php } ?> style="cursor:pointer"; data-toggle="tooltip" data-original-title="View Files">
				<td class="no-print"><?php echo $i;?> <?php if($section_id == 1){?>(<b>File ID : </b> <?php echo $files->file_id; ?>) <br/> <?php } ?>  <span class="no-print" style="display:none;"> (<?php echo $this->lang->line('file_no'); ?> : <?php echo $files->file_id;?>)  <?php $section_number_array= get_cr_section_nuber($files->file_id); ?> </span>  <?php $section_number_array= get_cr_section_nuber($files->file_id); ?>  <?php if(isset($section_number_array['section_number']) && $section_number_array['section_number']!='') {?><br/> CR-<?php echo $section_number_array['section_number'];?><?php } ?></td>
				<td class="no-print"><b><?php echo @getfilesec_id_byfileid($files->file_id,'8',$files->file_type) ? getfilesec_id_byfileid($files->file_id,'8',$files->file_type) : 'N/a' ;?><b>
				 <br/>
				<?php  if(!empty($files->dispetch_file_type)){ 
					echo '<i class="text-warning fa fa-mars-stroke"></i>';
				} ?></td>
				<td><?php echo $files->file_subject;?>
					<br><?php if(isset($files->scan_id) && $files->scan_id != ''){ show_scan_file($files->scan_id);}?>
					<br><?php if(isset($files->file_status) && $files->file_status != '') {show_file_status($files->file_status);}?>
					<br><div style="float:right"><b data-original-title="PS monitor due date" data-toggle="tooltip"><?php  if(($files->ps_moniter_date != '0000-00-00') && ($files->ps_moniter_date !='1970-01-01')){ echo (@$files->ps_moniter_date)? 'Date  : '. date('d-m-Y' , strtotime($files->ps_moniter_date)):''; } ?></b>
				</td>
				<td><?php echo getfilesec_id_byfileid($files->file_id,$files->file_mark_section_id,$files->file_type); ?></td>

					<td class="no-print"><?php echo getSection($files->file_mark_section_id); ?></td>
				<td><?php echo $files->file_uo_or_letter_no; ?> (<?php echo getFileType($files->file_type) ;?>)</td>
				<td><?php if(isset($files->file_uo_or_letter_date) && $files->file_uo_or_letter_date != '0000-00-00'){ echo date_format(date_create($files->file_uo_or_letter_date), 'd/m/y'); } ?></td>
				  <?php if($data_search_type == '11') { ?>
					<td><?php  
						if(isset($files->dispatch_lists) && ($files->dispatch_lists != '' && $files->dispatch_lists != 'null')) {
							$dispatch_lists = json_decode($files->dispatch_lists);
							echo '<table>';
							foreach($dispatch_lists as $row){
									echo '<tr><td>'.$row.'</td></tr>';									
								}
							echo '</table>';
						} else {
							$file_from = file_from_type();
							$high_bench =  highcourt_bench();
							if(isset($files->file_Offer_by) && isset($file_from)) {
								echo   $filetosent = @$files->file_Offer_by == 'c' || @$files->file_Offer_by == 'jvn' ? @$file_from[$files->file_Offer_by] ." , ". @$files->district_name_hi." <br/>" : false ;
							}
							if(isset($files->file_Offer_by)  && isset($file_from)  || isset($high_bench)) {
								//pre($high_bench[$files->court_bench_id]);
								echo  $filetosent = @$files->file_Offer_by == 'm' || @$files->file_Offer_by == 'u' ? @$file_from[$files->file_Offer_by] ." , ". $high_bench[$files->court_bench_id] : false ;
								echo   $filetosent = @$files->file_Offer_by == 'v' || @$files->dept_name_hi ?  @$files->dept_name_hi ." ".(isset($files->file_department_name)?$files->file_department_name:'') : (isset($files->file_department_name)?$files->file_department_name:'');
							}
						}?></td>
					<td></td>
					<td></td>
				  <?php }  else { ?>
				<td><?php 
					//print_r($establiment_empids );
					//echo $file->createfile_empid;
					if( in_array($files->createfile_empid ,$establiment_empids ) && empty($file->file_Offer_by)){
							echo "विधि एवं विधायी कार्य विभाग";
					}else{	
					$file_from = file_from_type();
					$high_bench =  highcourt_bench();
					echo   $files->file_Offer_by == 'c' || $files->file_Offer_by == 'jvn' ? (isset($file_from[$files->file_Offer_by])?$file_from[$files->file_Offer_by]:'') ." , ". $files->district_name_hi : false ;
					echo   $files->file_Offer_by == 'm' || $files->file_Offer_by == 'u' ? (isset($file_from[$files->file_Offer_by])?$file_from[$files->file_Offer_by]:'') ." , ". (isset($high_bench[$files->court_bench_id])?$high_bench[$files->court_bench_id]:'') : false ;
					echo   $files->file_Offer_by == 'sc' ? (isset($file_from[$files->file_Offer_by])?$file_from[$files->file_Offer_by]:'') ." , Delhi , दिल्ली" : false ;
					echo   $files->file_Offer_by == 'v' || $files->dept_name_hi ? $file_from[$files->file_Offer_by] ." , ". $files->dept_name_hi ." ".$files->file_department_name : $files->file_department_name;

				}
				?>
				</td>
			   <td><?php //echo date_format(date_create($files->file_update_date), 'd/m/y'); ?>
					<?php echo date_format(date_create($files->file_created_date), 'd/m/y'); ?>
				   <!--(<?php if($files->file_hardcopy_status == 'not'){ echo $this->lang->line('mark_date');} else { echo $this->lang->line('received_date');} ?>)-->
			   </td>
			   <td><?php $dispetch_date_array= get_file_dispos_date(null,$files->file_id); 
					 if( isset($dispetch_date_array['dispatch_date'])&& $dispetch_date_array['dispatch_date']!=''){
						echo get_date_formate($dispetch_date_array['dispatch_date'],'d/m/y');
					 }else{
						echo 'N/A';
					 }

				?></td>
				 <?php } ?>
			   <td align="" class="no-print"><?php
					$filereceiver = get_user_details($files->file_received_emp_id);
					if ($filereceiver)
					{
						if($files->file_hardcopy_status == 'not') {
							echo file_not_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi);
						} else if($files->file_hardcopy_status == 'close') {
							echo file_closed_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi, $files->file_type);
						} else  if($files->file_hardcopy_status == 'received') {
							echo file_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi);
						} else if($files->file_hardcopy_status == 'working'){
							echo file_working_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi);
						}

					} 
				?></td>
				 <?php if(isset($_GET['task']) && $_GET['task']=='reopen'){ ?>
					<td>
						<?php if($files->file_hardcopy_status=='close'){?>
							<a class="btn bg-olive margin" onclick="confirm_reopen(<?php echo $files->file_id; ?>);">पुनः खोलें  </a>
						<?php }else {?>
							<button class="btn bg-olive margin" type="button" onClick="showcomp(<?php echo $files->file_id; ?>)">View File</button>
						<?php } ?>
					</td>
				 <?php } elseif(isset($_GET['task']) && $_GET['task']=='fileedit'){?>
					<td>
						<?php //pre($files[0]->file_received_emp_id); ?>
						<?php if(($files->file_hardcopy_status=='received' || $files->file_hardcopy_status=='working') && $files->file_received_emp_id==$this->session->userdata("emp_id")){ ?>
							<a class="btn bg-olive margin"  href="<?php echo base_url();?>dashboard/dealing/<?php echo $files->file_id;?>">बदलाव करें</a>
						<?php }else {?>
							<b class="text-red">
								बदलाव के लिए फाइल का प्राप्त करना आवश्यक हैं <br/>
								<span class="text-yellow blink">बदलाव नहीं कर सकते  </span>
							</b>
								<button class="btn bg-olive margin" type="button" onClick="showcomp(<?php echo $files->file_id; ?>)">View File</button>
						<?php } ?>
					</td>
					<?php }elseif(isset($_GET['task']) && $_GET['task']=='fileclose' ){  ?>
						<td>
							<?php if($files->file_hardcopy_status == 'close'){ ?>
								फाइल पहले से ही बंद है|
							<?php }else {?>
								<button onclick="open_model_dispose(<?php echo $files->file_id; ?>)" class="btn btn-sm btn-block btn-danger rty1" value="<?php echo $files->file_id; ?>" data-toggle="tooltip" data-original-title="Dispose in section"><i class="fa fa-sort-down"></i> नस्ती को बंद करें</button>
							<?php } ?>
						</td>
					<?php }  ?>

				</tr>
			<?php } $i++; } ?>
						</tbody>
					</table>
				</div><!-- /.box-body -->								
				<?php } else{
					echo "<div align='center' class='text-danger'><b>No Data available Plz Try Again..</b></div>";
				}?>
			 </div><!-- /.box -->
			</div>
		</div><!-- /.row -->
	<?php } ?>
    <!-- Main row -->
</section><!-- /.content -->
<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script type="text/javascript">
	  <?php if($this->input->post('search_type') == '' || $this->input->post('search_type') == '1'){ ?>
		  $(document).ready(function(){	    
			$("#search_type").val(1);		
			$(".search_filter").show();	
			$("#search_value").focus();	 
	
		});
	<?php } ?>	
    $('#search_type').change(function(){
		$typeval  = $("#search_type") .val();
		$(".search_filter").show();
		
		$('.rmv_required').prop('required', false);
        if($typeval == '4'){
  			$("#dis4,#dis4_1,#year_search,#dis2").show();
			$("#dis1,#dis3,#emp_per_month").hide();
           
            $(".show_case,.show_search_dt_filter, .dispatch_block,#psmonitor").hide();
			$("#High_court_show, #dept_name_show , #suprem_court_show ,#dept_id_show,#state_id_show,#send_department").hide();
            $(".show_movement_dt,.search_value_div").show();
			 $("#dist_id_show,.dept_name_show1,.send_department").hide();
			 $("#search_value_label").html("UO/Letter Date<span class='text-danger'>*</span>");
        }else if($typeval == '3'){
			 $(".show_movement_dt,#year_search").show();
  			$("#dis4,#dis4_1,#dis1").show();
			$("#dis1,#dis3,#emp_per_month").hide();
			$("#High_court_show, #dept_name_show , #suprem_court_show ,#dept_id_show,#state_id_show,#send_department").hide();
            $("#dis2").hide();
            $(".show_case,.show_search_dt_filter, .dispatch_block,#psmonitor,#send_department").hide();
           
			$("#dis1,.search_value_div").show();
			 $(".dist_id_show,.dept_name_show1").hide();
			 $("#dist_id_show,.send_department").hide();
			 $("#search_value_label").html("UO/Letter No.<span class='text-danger'>*</span>");
        }
		else if($typeval == '2'){
  			$("#dis4,#dis4_1,#dis1,#search_value_div,#year_search").show();
			$("#dis1,#dis3,#emp_per_month").hide();
			$("#High_court_show, #dept_name_show , #suprem_court_show ,#dept_id_show,#state_id_show,#send_department").hide();
            $("#dis2").hide();
            $(".show_case,.show_search_dt_filter, .dispatch_block,#psmonitor,#send_department").hide();
            $(".show_movement_dt").show();
			$("#dis1").show();
			 $(".dist_id_show,.dept_name_show1,.send_department").hide();
			  $("#search_value_label").html("पक्षकार <span class='text-danger'>*</span>");
        }
		else if($typeval == '5'){
            $("#dis3,#emp_per_month,#emp_per_month").show();
            $("#dis2,#dis1,#dis4,#dis4_1").hide();
            $(".show_case,.show_search_dt_filter, .dispatch_block,#psmonitor,#send_department").hide();
			$("#High_court_show, #dept_name_show , #suprem_court_show ,#dept_id_show,#state_id_show,#send_department").hide();
            $(".dist_id_show,.dept_name_show1,.send_department,#search_value_div,#year_search").hide();
          
        }else if($typeval == '12'){
            $("#psmonitor").show();
            $("#dis2,#dis1,#dis4_1,#dis3,#emp_per_month,#search_value_div,#year_search").hide();
			$("#High_court_show, #dept_name_show , #suprem_court_show ,#dept_id_show,#state_id_show,#send_department").hide();
            $(".show_case,.show_search_dt_filter, .dispatch_block").hide();
            $(".show_movement_dt,#send_department").hide();
			$(".dist_id_show,.dept_name_show1,.search_value_div").hide();
        }else if($typeval == '1'){
            $("#dis4,#dis4_1,#dis1,.show_movement_dt,.search_value_div").show();
			$("#High_court_show, #dept_name_show , #suprem_court_show ,#dept_id_show,#state_id_show,#send_department,#emp_per_month").hide();
            $("#dis2,#dis3").hide();
            $(".show_case,.show_search_dt_filter, .dispatch_block,#psmonitor,#send_department").hide();
           $(".dist_id_show,.dept_name_show1,.send_department").hide();
             $("#search_value_label").html("पंजी क्र. <span class='text-danger'>*</span>");
        }else if($typeval == '7'){
			$(".show_case,#dis4,.show_movement_dt,#year_search").show();
			$("#High_court_show, #dept_name_show , #suprem_court_show ,#dept_id_show,#state_id_show,#send_department,#dist_id_show").hide();
            $("#dis4_1,#dis1,#emp_per_month").hide();
            $("#dis2,#dis3").hide();
            $(".show_search_dt_filter, .dispatch_block,#psmonitor,#send_department").hide();
			$("#dist_id_show,.dept_name_show1,.search_value_div,.send_department").hide();
			
        }
		else if($typeval == '8'){
			$("#High_court_show, #dept_name_show , #suprem_court_show ,#dept_id_show,#state_id_show,#send_department").hide();
            $("#dis4_1,.show_case,#emp_per_month").hide();
		    $("#dis2,#dis3").hide();
            $(".show_search_dt_filter, .dispatch_block,#psmonitor,#send_department").hide();
			$(".dist_id_show,.dept_name_show1,.send_department").hide();
			 $("#dis1,#dis4,.search_value_div,#year_search,.show_movement_dt,#dis1").show();
			$("#search_value_label").html("विषय <span class='text-danger'>*</span>");
        }
		else if($typeval == '9'){
			$("#High_court_show, #dept_name_show , #suprem_court_show ,#dept_id_show,#state_id_show,#send_department").hide();
            $(".show_movement_dt,#dis4,#year_search").show();
            $(".show_case,.show_search_dt_filter, .dispatch_block,#psmonitor,#emp_per_month,#search_value_div").hide();
            $("#dis4_1,#dis1").hide();
            $("#dis2,#dis3").hide();
			$(".dist_id_show,.dept_name_show1,.send_department").hide();
        }

	/*else if($typeval == '10'){
		$("#High_court_show, #dept_name_show , #suprem_court_show ,#dept_id_show,#state_id_show,#send_department").hide();
			$("#dis1,#dis4,.search_value_div,#year_search").hide();
            $(".show_search_dt_filter").show();
            $(".show_movement_dt, .dispatch_block,#psmonitor,#emp_per_month").hide();
            $(".show_case").hide();
            $("#dis4_1,#dis1,#search_value").hide();
            $("#dis2,#dis3,.send_department").hide();
			$(".dist_id_show").hide();
			$('.rmv_required').prop('required', true);
        }*/
		else if($typeval == '13'){
		
			$("#dis1").hide();
			$("#High_court_show, #dept_name_show , #suprem_court_show ,#dept_id_show,#state_id_show").hide();
            $(".show_search_dt_filter,#emp_per_month").hide();
            $("#psmonitor").hide();
            $(".show_case").hide();
            $("#dis4_1,#dis1").hide();
            $("#dis2,#dis3,#search_value_div,#dispatch_block").hide();
			$(".show_movement_dt").show();
		 	
			$(".send_department,#year_search,#dis4").show();
			$('.rmv_required').prop('required', true);
        }
		else if($typeval == '11'){
		
			$(".dispatch_block,.send_department").hide();
            $(".show_movement_dt,.show_search_dt_filter, .show_case,#psmonitor,.search_value_div").hide();
            $("#dis4_1,#dis1").hide();
            $("#dis2,#dis3,#emp_per_month").hide();
		    $(".show_movement_dt,.dispetch_div,#year_search").show();
			$("#High_court_show, #dept_name_show , #suprem_court_show ,#dept_id_show,#state_id_show").hide();
			$(".dist_id_show,.dept_name_show1,#dept_name_show1").hide();
			
        }  else{
			
            $("#dis1,#search_value_div,#system_file_id_label").show();
            $("#dis2,#dis3,#dis4,#dis4_1,#emp_per_month,#year_search").hide();
            $(".show_case,.show_search_dt_filter, .dispatch_block,#psmonitor").hide();
			$("#High_court_show, #dept_name_show , #suprem_court_show ,#dept_id_show,#state_id_show,#send_department").hide();
            $(".show_movement_dt").hide();
			$(".dist_id_show,.dept_name_show1, #dept_name_show1,.send_department").hide();
			$("#search_value_label").html("System file ID<span class='text-danger'>*</span>");
        }
    });

     $('#section_emp_list').change(function(){
        $("#temp_section_emp_name").val($("#section_emp_list option:selected").text());
     });
     $('#search_section_wise').change(function(){
        $("#temp_section_emp_name").val($("#search_section_wise option:selected").text());
     });
     $('#search_type').change(function(){
        if($(this).val()==9){
            $("#temp_section_emp_name").val($("#search_type option:selected").text());
        }else if($(this).val()==2){
            var search_type = $("#search_type option:selected").text();
            var search_case_type_no=search_type;
            $("#temp_section_emp_name").val(search_case_type_no);
        }else if($(this).val()==5){
            var search_type = $("#search_type option:selected").text();
            var search_monthwise = $("#search_month_wise option:selected").text();
            var search_case_type_no=search_type+'-'+search_monthwise;
            $("#temp_section_emp_name").val(search_case_type_no);
        }if($(this).val()==6){
            $("#temp_section_emp_name").val('System ID');
        }  
		/*var login_role_id = <?php echo $this->session->userdata['user_role']; ?>;      
        if($(this).val()==8 && login_role_id!=1){
            $("#search_fltr_div").hide();
            alert('सम्बंधित फाइल को  ` विषय ` से खोजने के लिए आईटी शाखा से संपर्क करें |');
            $("#search_fltr_div").replaceWith('<div style="color:red;text-align:center"> सम्बंधित फाइल को <b> " विषय से खोजने "</b> के लिए आईटी शाखा से संपर्क करें |</div>');
            return false;
        }else {
            $("#search_fltr_div").show();
        }*/
     });
     $('#search_case_type').change(function(){
        var caseno = $("#search_case_no").val();
        var casetype = $("#search_case_type option:selected").text();
        var search_case_type_no=casetype+'-'+caseno;
        $("#temp_section_emp_name").val(search_case_type_no);
     });

    function showcomp(comp1)
    {
        window.location='<?php echo base_url();?>view_file/viewdetails/'+comp1;
    }

    $(function(){
        checkBorder();
        $("table tr th").change(function(){
           checkBorder(); 
        });
    });
	function checkBorder(){
         $("table tr").each(function(){
            if ($(this).find("input").val() == ""){
               $(this).attr("class", "border");   
            }
        });   
	}
	
	function confirm_reopen(fileid) {
	/*	alert('कृपया नस्ती को पुनः खोलने के लिए आई. टी शाखा से संपर्क करें ! धन्यवाद !');
		return false;
	*/	
		var res = confirm('कृपया सुनिश्चित करे की आप यह फाइल/पत्र पुनः खोलना चाहते हैं!!');
		if(res==true){ 
			$.ajax({
                type: "POST",
                url: '<?php echo base_url(); ?>' + "manage_file/ajax_file_reopen",
                datatype: "json",
                async: false,
                data: {fileid: fileid},
                success: function(data) {
				
                    var f_data = JSON.parse(data);
                   
					if(f_data==0){
					location.reload();
					}else if(f_data==2){
                        alert('यह ई-फाइल है अत: यह फाइल केवल नस्ती धारक द्वारा ही पुनः खोली जा सकती है |');
                    }else{
						alert('यह फाइल पुनः नहीं खोली जा सकती कृपया पुनः प्रयास करे |');
					}
                }
            });
			/*window.location='<?php #echo base_url();?>view_file/ABC/'+fileid;*/
		}else{
			alert('wrongway');
			/*window.location='<?php #echo base_url();?>view_file/file_search';*/
		}
		
	}
	
	/*for section dipose by CR*/
	function open_model_dispose(file){
		var file_dis = file;
		$('#modal-dis').val(file_dis);
		$('#modal-dispose_file').modal('show');
	}
	$('#file_offer_by').change(function(){
		
        if($('#file_offer_by').val() == 'c' || $('#file_offer_by').val() == 'jvn'){
            $("#dist_id_show").show();
            $("#High_court_show, #dept_name_show , #suprem_court_show ,#dept_id_show,#state_id_show").hide();
			$(".delhi_advocate").hide();
			 $("#dept_name_show1").show();
            chenge_otherdepname();
        } else if($('#file_offer_by').val() == 'm' || $('#file_offer_by').val() == 'u'){
            $("#dept_id_show , #dept_name_show , #suprem_court_show,#state_id_show").hide();
            $("#High_court_show,#dist_id_show").show();
			$(".delhi_advocate").hide();
		 $("#dept_name_show1").show();
            chenge_otherdepname();
        } else if($('#file_offer_by').val() == 'au'){
            $("#dist_id_show , #dept_id_show , #dept_name_show , #suprem_court_show,#High_court_show").hide();
            $("#state_id_show").show();
			$(".delhi_advocate").hide();
			 $("#dept_name_show1").show();
        }else if($('#file_offer_by').val() == 'v'){
            $("#dept_name_show , #High_court_show , #suprem_court_show ,#state_id_show").hide();
            $("#dept_id_show,#dist_id_show").show();
			$(".delhi_advocate").hide();
			 $("#dept_name_show1").show();
            chenge_otherdepname();
        }else if($('#file_offer_by').val() == 'sc'){
            $("#dist_id_show , #dept_name_show , #High_court_show ,#dept_id_show,#state_id_show").hide();
            $("#suprem_court_show, .delhi_advocate").show();
			 $("#dept_name_show1").show();
            chenge_otherdepname();
        } else  {
            $("#dept_id_show,#High_court_show , #suprem_court_show,#state_id_show").hide();
			$(".delhi_advocate").hide();
            $("#dept_name_show,#dist_id_show").show();
            $("#other_label").text('<?php echo $this->lang->line('label_dept_name');?>');
			 $("#dept_name_show1").show();
            $("#file_department_name").attr('placeholder','<?php echo $this->lang->line('label_dept_name');?>');
        }
    });
 function chenge_otherdepname(){
        $("#other_label").text('<?php echo $this->lang->line('more_detail');?>');
        $("#file_department_name").attr('placeholder','<?php echo $this->lang->line('more_detail');?>');
    }
</script>
<style type="text/css">
th.border
{
    border:solid 1px red;
}
</style>

<!-- Model for dispose file in section -->
<div class="modal fade" id="modal-dispose_file" data-backdrop="static">
    <div class="modal-dialog">
        <form action="<?php echo base_url() ;?>manage_file/dispatch_for_close_byso" method="post" enctype="multipart/form-data">
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
                                    <input type="hidden" id="modal-dis" name="filedis_id">                                    
                                    <div class="form-group">
                                    <textarea class="form-control" rows="3" placeholder="आप फाइल को Dispose क्यूँ करना चाहते है कृपया जरुर लिखें|" id="modal-id" name="filedis_msg" required>यह फाइल आई. टी. एडमिन द्वारा बंद की जा रही है क्यूंकि यह फाइल ....... से पुनः दर्ज हो गयी है|</textarea>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                    <button id="btn-delete" type="submit" class="btn btn-primary send_btn"><i class="fa fa-check"></i> Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php //pre(get_cr_emp_id(1)); ?>
