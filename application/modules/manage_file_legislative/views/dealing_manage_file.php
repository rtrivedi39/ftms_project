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
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Legislative</a></li>
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
                <form role="form" method="post" action="<?php echo base_url()?>dashboard/save_dealing_legis<?php if(isset($file_data[0]['file_id'])){ echo '/'.$file_data[0]['file_id'];} ?>"  enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="section no"><?php echo $this->lang->line('File_section_no'); ?> :- </label>
                                <b><?php echo isset($file_data[0]['file_id']) ? getfilesec_id_byfileid($file_data[0]['file_id'] , $file_data[0]['file_mark_section_id']) : ''; ?></b>
                            </div>

                            <?php if($file_data[0]['file_mark_section_id']==16){ ?>
                                <div class="form-group">
                                    <label for="file_type"><?php echo $this->lang->line('label_type'); ?></label> <span class="text-danger">*</span></label>
                                    <select class="form-control" name="file_type" id="file_type">
                                        <?php
                                        foreach(file_types() as $key => $value){ ?>
                                            <option value="<?php echo $key ?>" <?php if($file_data[0]['file_type'] == $key) { echo "selected"; }?>><?php echo $value ?></option>
                                        <?php   } ?>
                                    </select>
                                    <?php echo form_error('file_type');?>
                                </div>
                            <?php }?>

                            <?php if($file_data[0]['file_mark_section_id']!=19){ ?>

                            <div class="form-group">
                                <label for="file_head"><?php  echo $this->lang->line('file_head'); ?></label>
                                <select class="form-control" name="file_head" id="file_head">
                                    <option value="">Select</option>
                                    <?php  $head_notesheet = get_list(HEADS_MASTER,null,array('section_id'=>$file_data[0]['file_mark_section_id'])); ?>
                                    <?php  foreach($head_notesheet as $row){ ?>
                                        <option value="<?php  echo $row['head_code']; ?>" <?php  if($this->input->post('file_head')==$row['head_code'] || @$file_data[0]['file_head_id']==$row['head_code'] ){ echo 'selected';} ?>><?php  echo $row['head_code']." - ".$row['head_title']; ?></option>
                                    <?php  } ?>
                                </select>
                            </div>
<?php } ?>

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

                            <?php if($file_data[0]['file_mark_section_id']!=16){ ?>
                            <div class="form-group">
                                <label for="file_subject">
                                    <?php if($file_data[0]['file_mark_section_id']==19){
                                        echo $this->lang->line('file_ka_prakar_lib');
                                    }else{
                                        echo "Notifications";
                                    } ?>
                                    </label>
                                <?php if($file_data[0]['file_mark_section_id']==19){
                                    $file_sub = get_lib_file_type() ;
                                }else{
                                    $file_sub = file_sub_type() ;
                                } ?>
                                <select name="section_file_type"  class="form-control">
                                    <option value="">Select</option>
                                    <?php foreach($file_sub as $file_sub1 ) {?>
                                        <option value="<?php echo $file_sub1 ?>" <?php if(@$file_data[0]['section_file_type'] == $file_sub1){ echo 'selected';} ?>><?php echo $file_sub1?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <?php } ?>

                        </div>

                        <div class="col-md-6">
                            <?php if(in_array($file_data[0]['file_mark_section_id'],array('15','2','10','14'))){ ?>
                                <div class="form-group">
                                    <label for="judgement_data"><?php echo $this->lang->line('judgement_data'); ?> <span class="text-danger">*</span></label>
                                    <input type="text" name="judgement_data" id="judgement_data" value="<?php echo $file_data[0]['file_judgment_date'] != "0000-00-00" ? date_format(date_create($file_data[0]['file_judgment_date']),'d-m-Y') : $this->input->post('judgement_data'); ?>" class="form-control">
                                    <?php  echo form_error('judgement_data');?>
                                </div>
                            <?php } ?>

                            <input type="hidden" name="file_offer_by" value="<?php echo $file_data[0]['file_Offer_by']; ?>">
                            <?php if($file_data[0]['file_mark_section_id']==2){ ?>
                                <div class="form-group">
                                    <label for="High_court_bench"><?php echo $this->lang->line('High_court_bench'); ?></label>
                                    <?php $highcourt = highcourt_bench() ; ?>
                                    <select name="court_bench"  class="form-control">
                                        <option value="">Select</option>
                                        <?php foreach($highcourt as $key => $court) {?>
                                            <option value="<?php echo $key ?>" <?php if(@$file_data[0]['court_bench_id']== $key){ echo 'selected';} ?>><?php echo $court?></option>
                                        <?php } ?>
                                    </select>
                                    <?php echo form_error('court_bench');?>
                                </div>
                            <?php } else if($file_data[0]['file_mark_section_id']==15){ ?>
                                <div class="form-group">
                                    <label for="prosecution file type"><?php echo $this->lang->line('file_ka_prakar'); ?> <span class="text-danger">*</span></label>
                                    <select class="form-control" name="section_file_type" >
                                        <option value=""><?php echo $this->lang->line('file_ka_prakar'); ?></option>
                                        <?php
                                        $presecution_file_type= get_prosecution_file_type(); /*function define in common helper. Database filed name : section_file_type in ft_files */
                                        foreach($presecution_file_type as $pftype){ ?>
                                            <option value="<?php echo $pftype; ?>" <?php if($file_data[0]['section_file_type']==$pftype){ echo 'selected';} ?>><?php echo $pftype; ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php echo form_error('section_file_type');?>
                                </div>
                            <?php } ?>
                            <div class="form-group">
                                <label for=" file_department_id"><?php echo $this->lang->line('label_dept_name'); ?></label>
                                <select class="form-control" name="file_department_id" id="file_department_id" >
                                    <option value=""><?php echo $this->lang->line('option_select_dept'); ?></option>
                                    <?php foreach($departments_list as $row){ ?>
                                        <option value="<?php echo $row['dept_id']; ?>" <?php if(@$file_data[0]['file_department_id']==$row['dept_id']){ echo 'selected';} ?>><?php echo $row['dept_name_en']." ".$row['dept_name_hi']; ?></option>
                                    <?php } ?>
                                    <option value="other"><?php echo $this->lang->line('option_other'); ?></option>
                                </select>
                                <?php echo form_error('file_department_id');?>
                            </div>

                            <div class="form-group">
                                <label for="district_id"><?php echo $this->lang->line('label_district_name'); ?></label>
                                <select class="form-control" name="district_id" >
                                    <option value=""><?php echo $this->lang->line('option_select_district'); ?></option>
                                    <?php foreach($district_list as $row){ ?>
                                        <option value="<?php echo $row['district_id']; ?>" <?php if(@$file_data[0]['file_district_id']==$row['district_id']){ echo 'selected';} ?>><?php echo $row['district_name_en'].", ".$row['district_name_hi']; ?></option>
                                    <?php } ?>
                                    <option value="other"><?php echo $this->lang->line('option_other'); ?></option>
                                </select>
                                <?php echo form_error('district_id');?>
                            </div>

                            <div class="form-group">
                                <label for="stat_id"><?php echo $this->lang->line('label_state_name'); ?></label>
                                <select class="form-control" name="state_id" id="state_id">
                                    <option value="">Select</option>
                                    <?php $i = 1; foreach($state_list as $row){ ?>
                                        <option value="<?php echo $row['state_id']; ?>" <?php  if($file_data[0]['file_state_id'] == $row['state_id']){ echo 'selected';} ?>><?php echo $i." - ".$row['state_name_hi'].'('.$row['state_name_en'].')'; ?></option>
                                        <?php $i++; } ?>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="file_department_name" id="other_label"><?php echo $this->lang->line('more_detail'); ?></label>
                                <input type="text" name="file_department_name" id="file_department_name" value="<?php echo @$file_data[0]['file_department_name'] ? $file_data[0]['file_department_name'] : $this->input->post('file_department_name') ?>" placeholder="<?php echo $this->lang->line('more_detail'); ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="from_id">File Upload (if any)</label>
                                <input type="file" name="file_upload"/>
                            </div>
                            <div class="form-group text-center">
                                <input type="checkbox" name="check_field" class="check_field12">
                                <label><?php echo $this->lang->line('check_field'); ?></label><?php echo form_error('check_field');?>
                            </div>
                            <input type="hidden" name="file_mark_section_id" value="2">
                            <div class="box-footer text-right">
                                <button class="btn btn-primary load_btn" id="btn_sub1" disabled onclick="return confirm('कृपया सुनिश्चित करे की आप यह फाइल दर्ज करना चाहते हैं |')" type="submit"><?php echo $this->lang->line('button_submit'); ?></button>
                             <!-- <button name="link_file" value="link_file" id="btn_sub2" disabled class="btn btn-primary load_btn" onclick="return confirm('कृपया सुनिश्चित करे की आप यह फाइल दर्ज करना चाहते हैं |')" type="submit">Update + Link file to other file</button>-->
                            </div>
                            <span class="text-danger"><?php echo $this->lang->line('m_note'); ?></span>
                        </div>
                    </div><!-- /.box-body -->
                </form>
            </div><!-- /.box -->
        </div>
    </div>
</div><!-- /.row -->
<!-- Main row -->
</section><!-- /.content -->
