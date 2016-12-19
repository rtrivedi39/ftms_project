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

<form role="form" method="post" action="<?php echo base_url()?>manage_file/files_edit/update_files<?php if(isset($file_data[0]['file_id'])){ echo '/'.$file_data[0]['file_id'];} ?>"  enctype="multipart/form-data">
<div class="col-md-6">
    <div class="box box-primary">
        <div class="box-body">
            <input type="hidden" name="file_type" id="file_type" value="<?php echo $file_data[0]['file_type']; ?>">
            <div class="col-xs-6">
                <div class="form-group">
                    <label for="file_uo_number"> <?php //pre($file_data[0]); ?>
                        पंजी क्रमांक (CR) :  <?php echo @getfilesec_id_byfileid($file_data[0]['file_id'],1,$file_data[0]['file_type']) ? getfilesec_id_byfileid($file_data[0]['file_id'],'1',$file_data[0]['file_type']) : 'N/A'; ?>
                    </label>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    <label for="file_uo_date">System ID : <?php echo $file_data[0]['file_id']; ?></label>
                </div>
            </div>
            <div class="form-group">
                <label for="file_type"><?php echo $this->lang->line('label_type'); ?></label> <span class="text-danger">*</span></label>
                <select class="form-control" name="file_type" id="file_type">
                    <?php foreach(file_types() as $key => $value){
                        if($file_data[0]['file_type'] == $key){
                        ?>
                        <option value="<?php echo $key ?>" <?php if($file_data[0]['file_type']==$key){ echo 'selected';} ?> > <?php echo $value; ?></option>
                    <?php } }?>
                </select>
                <?php echo form_error('file_type');?>
                </label> <span class="btn-sm">Only file type cannot be updated here plz contact system admin.</span>
            </div>
            <!--Dropdown-->
			<?php //pre($file_data); ?>
            <div class="form-group" id="other_file_div">
                <label for="file_type"><?php echo $this->lang->line('other_label'); ?></label> <span class="text-danger">*</span></label>
                <select class="form-control" name="other_file_type" id="other_file_type" required>
					<!--<option value="">Select File For</option>-->
                    <?php /*file_other_type: Define by common helper file*/
                    foreach(file_other_type() as $key => $value){
                        if($key!='3'){?>
                                  <option value="<?php echo $key; ?>" <?php if(@$postdata['other_file_type']==$key){ echo 'selected';} ?> ><?php echo $value; ?></option>
                       <?php }
                    }?>
                </select>
                <?php echo form_error('other_file_type');?>
            </div>
            <!--End Dropdown-->
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

            <div class="form-group">
                <label for="file_subject"><?php echo $this->lang->line('label_subject'); ?> <span class="text-danger">*</span></label>
                <textarea class="form-control"  name="file_subject" ><?php echo isset($file_data[0]['file_subject']) ? $file_data[0]['file_subject'] : ''; ?></textarea>
                <?php echo form_error('file_subject');?>
            </div>

            <div class="form-group">
                <label for="file_subject"><?php echo $this->lang->line('Party_name_petition/respondent'); ?> </label>
                <?php
                $petition_toname='';
                if($file_data[0]['case_parties']!=''){
                    $cparray= explode('-',$file_data[0]['case_parties']);
                    $petition_toname=$cparray[0];
                }
                ?>
                <div class="row">
                    <div class="col-xs-5"><input type="text" placeholder="Petition" name="party_petition" value="<?php echo (@$this->input->post('party_petition')) ? @$this->input->post('party_petition') : $petition_toname ; ?>" class="form-control">
                        <?php // echo form_error('party_petition');?></div>
                    <span class="col-xs-2"><label for="file_subject">विरुद्ध</label></span>
                    <div class="col-xs-5"><input type="text" name="Party_name_respondent" placeholder="Respondent" value="<?php echo (@$this->input->post('Party_name_respondent')) ? @$this->input->post('Party_name_respondent') : 'मध्य प्रदेश शासन' ; ?>" class="form-control">
                        <?php // echo form_error('Party_name_respondent');?></div>
                </div>
            </div>

            <div class="form-group">
                <label for="file_subject"><?php echo $this->lang->line('case_no'); ?> </label>
                <?php
                //   if($file_data[0]['case_no']!=''){  }
                $c1 = explode(',',$file_data[0]['case_no']);
                $i=0;
                foreach ($c1 as $case_no_type) {
                    $case1= explode('/',$case_no_type);?>
                    <div class="row">
                        <div class="col-xs-4">
                            <select name="files_other_feilds[case_type][<?php echo $i ?>]" class="form-control">
                                <option value="">Select</option>
                                <?php foreach(case_name() as $case){ ?>
                                    <option value="<?php echo $case ?>" <?php if(isset($case1[0]) && $case1[0] == $case) { echo "selected" ;} ?>><?php echo $case ?></option>
                                <?php } ?>
                            </select>
                            <?php echo form_error('case_type');?>
                        </div>
                        <div class="col-xs-4">
                            <input type="text" name="files_other_feilds[case_no][<?php echo $i ?>]" value="<?php echo isset($case1[1]) ? $case1[1] : '' ; ?>" class="form-control">
                            <?php echo form_error('case_no');?>
                        </div>
                        <div class="col-xs-4">
                            <select Name='files_other_feilds[case_year][<?php echo $i ?>]' class="form-control" ><?php
                                for ($x=date("Y"); $x>2000; $x--) { ?>
                                    <option value="<?php echo $x ?>" <?php if(isset($case1[2]) && $case1[2] == $x){ echo "selected" ;} ?>><?php echo $x ?></option>';
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <?php $i++; } ?>
            </div>
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="box box-primary">
        <div class="box-body">
            <div class="form-group">
                <label for="offer_by"><?php echo $this->lang->line('offer_by'); ?> <span class="text-danger">*</span> </label>
                <select class="form-control" name="file_offer_by" id="file_offer_by">
                    <option value=""><?php echo $this->lang->line('option_select_from'); ?></option>
                    <?php foreach(file_from_type() as $key => $value){ ?>
                        <option value="<?php echo $key ?>" <?php if ($file_data[0]['file_Offer_by'] == $key) { echo "selected";} ?>><?php echo $value ?></option>
                    <?php   } ?>
                </select>
                <?php echo form_error('file_offer_by');?>
            </div>

            <div class="form-group"  id="High_court_show" <?php if($this->input->post('file_offer_by') == 'm' || $this->input->post('file_offer_by') == 'u') { echo "style='display: block'"; } else { echo "style='display: none'";} ?>>
                <label for="High_court_bench"><?php echo $this->lang->line('High_court_bench'); ?> <span class="text-danger">*</span></label>
                <select class="form-control" name="court_bench" id="court_bench">
                    <option value=""><?php echo $this->lang->line('option_select_from'); ?></option>
                    <?php $i = 1; foreach(highcourt_bench() as $key => $value){ ?>
                        <option value="<?php echo $key ?>" <?php if ($file_data[0]['court_bench_id'] == $key || $this->input->post('court_bench') == $key) { echo "selected";} ?>><?php echo $i.' - '.$value ?></option>
                    <?php $i++; } ?>
                </select>
                <?php echo form_error('court_bench');?>
            </div>

            <div class="form-group" id="dept_id_show" <?php if($this->input->post('file_offer_by') == 'v' || $file_data[0]['file_Offer_by'] == 'v') { echo "style='display: block'"; } else { echo "style='display: none'";} ?>>
                <label for="file_department_id"><?php echo $this->lang->line('label_dept_name'); ?> <span class="text-danger">*</span></label>
                <select class="form-control" name="file_department_id" id="file_department_id" >
                    <option value=""><?php echo $this->lang->line('option_select_dept'); ?></option>
                    <?php foreach($departments_list as $row){ ?>
                        <option value="<?php echo $row['dept_id']; ?>" <?php if($file_data[0]['file_department_id']==$row['dept_id'] || $this->input->post('file_department_id')==$row['dept_id'] ){ echo 'selected';} ?>><?php echo $row['dept_name_en']." ".$row['dept_name_hi']; ?></option>
                    <?php } ?>
                    <option value="400"><?php echo $this->lang->line('option_other'); ?></option>
                </select>
                <?php echo form_error('file_department_id');?>
            </div>

<div class="form-group" id="dist_id_show" <?php if($this->input->post('file_offer_by') == 'c' || $this->input->post('file_offer_by') == 'jvn' || $this->input->post('file_offer_by') == 'v' || $this->input->post('file_offer_by') == 'm' || $this->input->post('file_offer_by') == 'o' || $file_data[0]['file_Offer_by'] == 'c') { echo "style='display: block'"; } else { echo "style='display: none'";} ?>>
                <label for="district_id"><?php echo $this->lang->line('label_district_name'); ?> <span class="text-danger">*</span></label>
                <select class="form-control" name="district_id" id="district_id">
                    <option value=""><?php echo $this->lang->line('option_select_district'); ?></option>
                    <?php foreach($district_list as $row){ ?>
                        <option value="<?php echo $row['district_id']; ?>" <?php if($file_data[0]['file_district_id'] == $row['district_id'] || $this->input->post('district_id') == $row['district_id'] ){ echo 'selected';} ?>><?php echo $row['district_name_en'].", ".$row['district_name_hi']; ?></option>
                    <?php } ?>
                    <option value="400"><?php echo $this->lang->line('option_other'); ?></option>
                </select>
                <?php echo form_error('district_id');?>
            </div>

            <div class="form-group" id="state_id_show" <?php if($file_data[0]['file_Offer_by'] == 'au') { echo "style='display: block'"; } else { echo "style='display: none'";} ?>>
                <label for="district_id"><?php echo $this->lang->line('label_state_name'); ?> <span class="text-danger">*</span></label>
                <select class="form-control" name="state_id" id="state_id">
                    <option value="">Select</option>
                    <?php foreach($state_list as $row){ ?>
                        <option value="<?php echo $row['state_id']; ?>" <?php  if( $file_data[0]['file_state_id'] == $row['state_id'] || $this->input->post('state_id') == $row['state_id'] ){ echo 'selected';} ?>><?php echo $row['state_name_en']." ".$row['state_name_hi']; ?></option>
                    <?php } ?>
                </select>
                <?php echo form_error('state_id');?>
            </div>

            <div class="form-group" id="suprem_court_show" <?php if($file_data[0]['file_Offer_by'] == 'sc') { echo "style='display: block'"; } else { echo "style='display: none'";} ?>>
                <label for="suprem_court_show"><?php echo $this->lang->line('label_suprem_court'); ?> <span class="text-danger">*</span></label>
                <input type="text" name="suprem_court" id="suprem_court" value="<?php echo @$this->input->post('suprem_court') ? @$this->input->post('suprem_court') : 'Delhi , दिल्ली';  ?>"  class="form-control" disabled>
            </div>

			<div class="form-group delhi_advocate" style="display:none">
				<?php
					$counselling_list = get_standing_counseller_name(null,null);
					//pre($counselling_list);
					foreach($counselling_list as $cname){
						$advocates[]=$cname['scm_name_hi']." (".$cname['scm_court_name'].' '.$cname['scm_post_hi'].")";
					}
				?>
				<label for="file_subject"><?php echo $this->lang->line('delhi_advocate_name'); ?></label>
				<select class="form-control" name="gov_adocate_delhi" id="gov_adocate_delhi">
					<option value=""><?php echo $this->lang->line('delhi_advocate_name'); ?></option>
					<?php foreach($counselling_list as $row){ ?>
						<option value="<?php echo $row['scm_name_hi']; ?>" <?php  if($this->input->post('adivakta_name')==$row['scm_name_hi']){ echo 'selected';} ?>><?php echo $row['scm_name_hi']." (".$row['scm_court_name'].' '.$row['scm_post_hi'].")"; ?></option>
					<?php } ?>
				</select>
				<?php echo form_error('file_head');?>
			</div>

            <div class="form-group" id="dept_name_show1" >
                <label for="file_department_name" id="other_label"><?php echo $this->lang->line('more_detail'); ?></label>
                <input type="text" name="file_department_name" id="file_department_name" value="<?php echo @$file_data[0]['file_department_name'] ? $file_data[0]['file_department_name'] : $this->input->post('file_department_name') ?>" placeholder="<?php echo $this->lang->line('more_detail'); ?>" class="form-control">
                <?php echo form_error('file_department_name');?>
                <p class="form-helper other_hide" id="otherdept1" style="display:none" ><?php echo $this->lang->line('helper_dept_name'); ?></p>
            </div>
            <div class="form-group">
			 <label for="file_mark_section_id"  id="file_mark_section_id"><?php echo $this->lang->line('label_mark_section'); ?> <span class="text-danger">*</span></label>
                <?php $mark_to_officer = get_officers_list(); //pre($mark_to_officer);?>
                <?php $fdis='block'; if(isset($postdata['other_file_type'])){ if(@$postdata['other_file_type']=='1' || @$postdata['other_file_type']==''){ $dis='show'; $fdis='hide'; ?>
                    <select class="form-control marktosc" name="file_mark_section_id" id="mark_to_section" style="display:<?php echo $fdis;?>">
                        <option value="" id="select_t_s"><?php echo $this->lang->line('option_select_section'); ?></option>
                        <?php foreach($section_list as $row){ 
                            if( ($row['section_id'] == 21 ) || ($row['section_id'] == 26 ) ){}else{  ?>                     
                            <option value="<?php echo $row['section_id']; ?>" class="sections" <?php  if($this->input->post('file_mark_section_id')==$row['section_id']){ echo 'selected';} ?>><?php echo $row['section_name_en'].", ".$row['section_name_hi']; ?></option>
                        <?php } ?>
                        <?php } ?>
                        <?php } ?>
                    </select>
                <?php form_error('file_mark_section_id'); } else{  ?>
                    <?php if(isset($file_data[0]['file_form']) && $file_data[0]['file_form']==2){ $fdis='none'; } //if( isset()$postdata['other_file_type']!='2'){ ?>
                    <select class="form-control marktosc" name="file_mark_section_id" id="mark_to_section" style="display:<?php echo $fdis;?>">
                        <option value="" id="select_t_s"><?php echo $this->lang->line('option_select_section'); ?></option>
                        <?php foreach($section_list as $row){
                                if( ($row['section_id'] == 21 ) || ($row['section_id'] == 26 ) ){}else{  ?>
                            <option value="<?php echo $row['section_id']; ?>" class="sections" <?php  if($this->input->post('file_mark_section_id')==$row['section_id'] || $file_data[0]['file_mark_section_id']==$row['section_id']){ echo 'selected';} ?>><?php echo $row['section_name_en'].", ".$row['section_name_hi']; ?></option>
                        <?php } ?>
                        <?php } ?>
                    </select>
                    <?php //} ?>
                <?php form_error('file_mark_section_id'); } ?>
                <?php //pre($file_data[0]);?>
                <?php if(isset($postdata['other_file_type'])){   echo '0'; echo $postdata['other_file_type'];
						if(@$postdata['other_file_type']=='2'){    ?>
							<select class="form-control marktoof" name="file_mark_officer_id" id="mark_to_officer">
								<option value="" id="select_t_o"><?php echo $this->lang->line('select_other_mark_to_officer'); ?></option>
								<?php foreach($mark_to_officer as $offrow){ ?>
									<option value="<?php echo $offrow['emp_id']; ?>"  class="officers" <?php if($this->input->post('file_mark_officer_id')==$file_data[0]['file_sender_emp_id']){ echo 'selected';} ?>><?php echo $offrow['emp_full_name'].", ".getemployeeRole($offrow['role_id'])//if($offrow['emp_section_id']==''); ?></option>
								<?php } ?>
							</select>
                <?php } echo form_error('file_mark_officer_id'); }
						else { ?>
                    <?php //if($postdata['other_file_type']!='1'){ ?>
                    <select class="form-control marktoof" name="file_mark_officer_id" id="mark_to_officer" <?php if($file_data[0]['file_form']!=2){ ?>style="display:none" <?php } ?>>
                        <option value="" id="select_t_o"><?php echo $this->lang->line('select_other_mark_to_officer'); ?></option>
                        <?php foreach($mark_to_officer as $offrow){ ?>
                            <option value="<?php echo $offrow['emp_id']; ?>" class="officers" <?php if($file_data[0]['file_sender_emp_id']==$offrow['emp_id']){ echo 'selected';} ?>><?php echo $offrow['emp_full_name'].", ".getemployeeRole($offrow['role_id'])//if($offrow['emp_section_id']==''); ?></option>
                        <?php } ?>
                    </select>
                    <?php //} ?>
					<?php echo form_error('file_mark_officer_id');?>
                <?php } ?>
                
            </div>
            <input type="hidden" name="mark_unitid" id="mark_unitid" value="51">

            <div class="form-group">
                <label for="appel"><?php echo $this->lang->line('appeal_petition'); ?> </label>
                <input type="text" name="courts_name_location" value="<?php echo isset($file_data[0]['courts_name_location']) ? $file_data[0]['courts_name_location'] : ''; ?><?php echo (@$this->input->post('courts_name_location')) ? @$this->input->post('courts_name_location') : '' ; ?>" class="form-control">
                <?php echo form_error('courts_name_location');?>
            </div>

            <div class="form-group">
                <label for="judgement_data"><?php echo $this->lang->line('judgement_data'); ?></label>
                <input type="text" name="judgement_data" id="judgement_data" value="<?php echo $file_data[0]['file_judgment_date'] != "0000-00-00"  ? date_format(date_create($file_data[0]['file_judgment_date']),'d-m-Y') : ''; ?>" class="form-control">
                <?php  echo form_error('judgement_data');?>
            </div>

            <div class="form-group" id="marktocsu">
                <label for="file_uo_number">Mark File To Scan Unit</label>
                <select  class="form-control mark_csu" name="mark_csu">
                     <option value="" <?php  if($this->input->post('mark_csu')== ''){ echo 'selected';} ?>>अंकित किये हुए अनुभाग को भेजे</option>
                    <option value="62" <?php  if($this->input->post('mark_csu')== '62' || $file_data[0]['file_mark_section_id'] == '2'){ echo 'selected';} ?>>सेंट्रल स्कैन यूनिट को भेजे</option>
                </select>
            </div>

            <div class="form-group text-center">
                <input type="checkbox" name="check_field" id="check_field">
                <label><?php echo $this->lang->line('check_field'); ?></label><?php echo form_error('check_field');?>
            </div>

            <div class="box-footer text-right">
                <button class="btn btn-primary margin" id="submit_btn" disabled  type="submit"><?php echo $this->lang->line('button_update'); ?></button>
            </div>
            <span class="text-danger"><?php echo $this->lang->line('m_note'); ?></span>
        </div>
    </div></div>
</form>
</div><!-- /.box -->
</div>
<!-- /.row -->
<!-- Main row -->
</section><!-- /.content -->
<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script type="text/javascript">
$(function() {
        $('#file_type').change(function(){
            if($('#file_type').val() == 'f'){
                $('#dispaly_num').html("<?php echo $this->lang->line('label_uo_number'); ?>");
                $('#dispaly_date').html("<?php echo $this->lang->line('label_uo_date'); ?>");

            } else if($('#file_type').val() == 'l') {
                $('#dispaly_num').html("<?php echo $this->lang->line('label_letterno_number'); ?>");
                $('#dispaly_date').html("<?php echo $this->lang->line('label_letterno_date'); ?>");

            }else if($('#file_type').val() == 'a') {
                $('#dispaly_num').html("<?php echo $this->lang->line('label_letterno_number'); ?>");
                $('#dispaly_date').html("<?php echo $this->lang->line('label_letterno_date'); ?>");

            }else if($('#file_type').val() == 'r') {
                $('#dispaly_num').html("<?php echo $this->lang->line('label_letterno_number'); ?>");
                $('#dispaly_date').html("<?php echo $this->lang->line('label_letterno_date'); ?>");

            }else if($('#file_type').val() == 'n') {
                $('#dispaly_num').html("<?php echo $this->lang->line('label_notice_number'); ?>");
                $('#dispaly_date').html("<?php echo $this->lang->line('label_notice_date'); ?>");

             }else if($('#file_type').val() == 's') {
                $('#dispaly_num').html("<?php echo 'फ़ाइल क्रमांक'; ?>");
                $('#dispaly_date').html("<?php echo 'फ़ाइल दिनांक'; ?>");

            }
            else if($('#file_type').val() == 'w') {
                $('#dispaly_num').html("<?php echo 'Write petion No.'; ?>");
                $('#dispaly_date').html("<?php echo 'Write petition Date'; ?>");

            } else {
                $('#dispaly_num').html("कोई पहचान दर्ज कीजीये (Name)");
                $('#dispaly_date').html("<?php echo $this->lang->line('label_letterno_date'); ?>");

            }
        });

        $('#other_file_type').change(function(){
            var file_for=$(this).val();
            if(file_for==1){
                $('#file_mark_section_id').html("<?php echo $this->lang->line('label_mark_section'); ?>");
				$('#select_t_s').text("<?php echo $this->lang->line('option_select_section'); ?>");
                $("#mark_to_section,#marktocsu").show();
                $("#mark_to_officer").hide();
                $(".petition_file_cls").show();
              
            } else if(file_for==2) {
                $('#file_mark_section_id').html("<?php echo $this->lang->line('other_mark_to_officer'); ?><span class='text-danger'>*</span>");
                $('#select_t_s').text("<?php echo $this->lang->line('select_other_mark_to_officer'); ?>");
                $("#mark_to_section").hide();
                $("#mark_to_officer").show();
                $(".hide_cls").hide();
                $("#marktocsu").hide();
                $(".marktosc").val('');
            }else if(file_for==3) {
                $('#file_mark_section_id').html("<?php echo $this->lang->line('other_mark_to_officer'); ?>");
                $('#select_t_s').text("<?php echo $this->lang->line('select_other_mark_to_officer'); ?>");
                $("#mark_to_section").hide();
                $("#mark_to_officer").show();
                $(".hide_cls").hide();
            }
        });
    });
    $(document).ready(function() {
        var tem_file_to = '<?php echo @$postdata["other_file_type"];?>';
        if(tem_file_to=='2' || tem_file_to=='3'){
              $(".marktosc").hide();
        }
    });
    $(function() {
        $('#file_department_id').change(function(){
            if($('#file_department_id').val() != 'other'){
                $("#dept_name_show").hide();
            } else  {
                $("#dept_name_show").show();
            }  })
    });
    $('#check_field').change(function(){
        
        if($('#check_field').is(':checked')){
            $("#submit_btn").prop("disabled", false);
        }else{
            $("#submit_btn").prop("disabled", true);
        }
       

    });
    
    $('#file_offer_by').change(function(){
        if($('#file_offer_by').val() == 'c' || $('#file_offer_by').val() == 'jvn'){
            $("#dist_id_show").show();
            $("#High_court_show, #dept_name_show , #suprem_court_show ,#dept_id_show,#state_id_show").hide();
			$(".delhi_advocate").hide();
            chenge_otherdepname();
        } else if($('#file_offer_by').val() == 'm' || $('#file_offer_by').val() == 'u'){
            $("#dept_id_show , #dept_name_show , #suprem_court_show,#state_id_show").hide();
            $("#High_court_show,#dist_id_show").show();
			$(".delhi_advocate").hide();
            chenge_otherdepname();
        } else if($('#file_offer_by').val() == 'au'){
            $("#dist_id_show , #dept_id_show , #dept_name_show , #suprem_court_show,#High_court_show").hide();
            $("#state_id_show").show();
			$(".delhi_advocate").hide();
        }else if($('#file_offer_by').val() == 'v'){
            $("#dept_name_show , #High_court_show , #suprem_court_show ,#state_id_show").hide();
            $("#dept_id_show,#dist_id_show").show();
			$(".delhi_advocate").hide();
            chenge_otherdepname();
        }else if($('#file_offer_by').val() == 'sc'){
            $("#dist_id_show , #dept_name_show , #High_court_show ,#dept_id_show,#state_id_show").hide();
            $("#suprem_court_show, .delhi_advocate").show();
            chenge_otherdepname();
        } else  {
            $("#dept_id_show,#High_court_show , #suprem_court_show,#state_id_show").hide();
			$(".delhi_advocate").hide();
            $("#dept_name_show,#dist_id_show").show();
            $("#other_label").text('<?php echo $this->lang->line('label_dept_name');?>');
            $("#file_department_name").attr('placeholder','<?php echo $this->lang->line('label_dept_name');?>');
        }
    });
    $('#court_bench').change(function(){
        var court_bench = $('#court_bench option:selected').val();
        if(court_bench == 1){
            $('#district_id').val('214');
        }else if(court_bench == 2){
            $('#district_id').val('211');
        }else if(court_bench == 3){
            $('#district_id').val('204');
        }else{
            $('#district_id').val('');
        }
    });

    function chenge_otherdepname(){
        $("#other_label").text('<?php echo $this->lang->line('more_detail');?>');
        $("#file_department_name").attr('placeholder','<?php echo $this->lang->line('more_detail');?>');
    }
</script>

