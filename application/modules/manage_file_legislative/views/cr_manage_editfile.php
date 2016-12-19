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
                    <label for="file_uo_number">पंजी क्रमांक (CR) :  <?php echo @getfilesec_id_byfileid($file_data[0]['file_id'],$file_data[0]['file_mark_section_id'],$file_data[0]['file_type']) ? getfilesec_id_byfileid($file_data[0]['file_id'],$file_data[0]['file_mark_section_id'],$file_data[0]['file_type']) : 'N/A'; ?>
                    </label>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    <label for="file_uo_date">System ID : <?php echo $file_data[0]['file_id']; ?></label>
                </div>
            </div>
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
                    <?php foreach(highcourt_bench() as $key => $value){ ?>
                        echo '<option value="<?php echo $key ?>" <?php if ($file_data[0]['court_bench_id'] == $key || $this->input->post('court_bench') == $key) { echo "selected";} ?>><?php echo $value ?></option>
                    <?php  } ?>
                </select>
                <?php echo form_error('court_bench');?>
            </div>

            <div class="form-group" id="dept_id_show" <?php if($file_data[0]['file_Offer_by'] == 'v') { echo "style='display: block'"; } else { echo "style='display: none'";} ?>>
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


            <div class="form-group" id="dist_id_show" <?php if($file_data[0]['file_Offer_by'] == 'c' || $file_data[0]['file_Offer_by'] == 'jvn') { echo "style='display: block'"; } else { echo "style='display: none'";} ?>>
                <label for="district_id"><?php echo $this->lang->line('label_district_name'); ?> <span class="text-danger">*</span></label>
                <select class="form-control" name="district_id" >
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

            <div class="form-group" id="dept_name_show1" >
                <label for="file_department_name" id="other_label"><?php echo $this->lang->line('more_detail'); ?> <span class="text-danger">*</span></label>
                <input type="text" name="file_department_name" id="file_department_name" value="<?php echo @$file_data[0]['file_department_name'] ? $file_data[0]['file_department_name'] : $this->input->post('file_department_name') ?>" placeholder="<?php echo $this->lang->line('more_detail'); ?>" class="form-control">
                <?php echo form_error('file_department_name');?>
                <p class="form-helper other_hide" id="otherdept1" style="display:none" ><?php echo $this->lang->line('helper_dept_name'); ?></p>
            </div>

            <div class="form-group">
                <label for="file_mark_section_id"><?php echo $this->lang->line('label_mark_section'); ?> <span class="text-danger">*</span></label>
                <select class="form-control" name="file_mark_section_id">
                    <option value="">Select</option>
                    <?php foreach($section_list as $row){
                        if($row['section_id'] != 1){
                        ?>
                        <option value="<?php echo $row['section_id']; ?>" <?php if($file_data[0]['file_mark_section_id'] == $row['section_id']){ echo "selected"; } ?> ><?php echo $row['section_name_hi']."  (".$row['section_name_en'].")"; ?></option>
                    <?php } }?>
                    <!--<option value="other">Other</option> -->
                </select>
                <?php echo form_error('file_mark_section_id');?>
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

            <div class="form-group text-center">
                <input type="checkbox" name="check_field" id="check_field">
                <label><?php echo $this->lang->line('check_field'); ?></label><?php echo form_error('check_field');?>
            </div>

            <div class="box-footer text-right">
                <button class="btn btn-primary margin" id="submit_btn" disabled onclick="return confirm('कृपया सुनिश्चित करे की आप इसे डाटा को बदलना चाहते हैं |')" type="submit"><?php echo $this->lang->line('button_update'); ?></button>
            </div>
            <span class="text-danger"><?php echo $this->lang->line('m_note'); ?></span>
        </div>
    </div></div>
</form>
</div><!-- /.box -->
</div>
</div>
</div><!-- /.row -->
<!-- Main row -->
</section><!-- /.content -->
<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script type="text/javascript">
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
            chenge_otherdepname();
        } else if($('#file_offer_by').val() == 'm' || $('#file_offer_by').val() == 'u'){
            $("#dist_id_show , #dept_id_show , #dept_name_show , #suprem_court_show,#state_id_show").hide();
            $("#High_court_show").show();
            chenge_otherdepname();
        } else if($('#file_offer_by').val() == 'au'){
            $("#dist_id_show , #dept_id_show , #dept_name_show , #suprem_court_show,#High_court_show").hide();
            $("#state_id_show").show();
        }else if($('#file_offer_by').val() == 'v'){
            $("#dept_name_show , #High_court_show , #suprem_court_show ,#dist_id_show,#state_id_show").hide();
            $("#dept_id_show").show();
            chenge_otherdepname();
        }else if($('#file_offer_by').val() == 'sc'){
            $("#dist_id_show , #dept_name_show , #High_court_show ,#dept_id_show,#state_id_show").hide();
            $("#suprem_court_show").show();
            chenge_otherdepname();
        } else  {
            $("#dist_id_show , #dept_id_show , #High_court_show , #suprem_court_show,#state_id_show").hide();
            $("#dept_name_show").show();
            $("#other_label").text('<?php echo $this->lang->line('label_dept_name');?>');
            $("#file_department_name").attr('placeholder','<?php echo $this->lang->line('label_dept_name');?>');
        }
    });

    function chenge_otherdepname(){
        $("#other_label").text('<?php echo $this->lang->line('more_detail');?>');
        $("#file_department_name").attr('placeholder','<?php echo $this->lang->line('more_detail');?>');
    }
</script>

