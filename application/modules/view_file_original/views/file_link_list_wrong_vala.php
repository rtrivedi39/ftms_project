<!-- Content Header (Page header) -->
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
    <?php if($this->session->flashdata('message') || $this->session->flashdata('error')) {
        $msg = $this->session->flashdata('message') ? 'success' : 'danger';
        ?>
        <div class="alert alert-<?php echo $msg; ?> alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php  echo $this->session->flashdata('message');
            echo $this->session->flashdata('error'); ?>
            <br/>
        </div>
    <?php } ?>
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Modified File Details  <b>पंजी क्रमांक : <?php echo getfilesec_id_byfileid($file_details[0]['file_id'],$file_details[0]['file_mark_section_id'],$file_details[0]['file_type']); ?></b></h3>
            <a href="<?php echo base_url()  ; ?>view_file/dealing_file"><button class="btn btn-warning" title="Back" style="float:right"><?php echo $this->lang->line('Back_button_label'); ?></button></a>
        </div><!-- /.box-header -->
        <div class="box-body">

            <div class="col-xs-4">
                <div class="form-group">
                    <label for="exampleInputEmail1"><?php
                        echo   $file_details[0]['file_type'] == 'f' ? $this->lang->line('view_file_uo_number') : false;
                        echo   $file_details[0]['file_type'] == 'l' ?  $this->lang->line('label_letterno_number') : false;
                        echo   $file_details[0]['file_type'] == 'a' ? $this->lang->line('label_letterno_number') : false;
                        echo   $file_details[0]['file_type'] == 'r' ? $this->lang->line('label_registry_number') : false;
                        echo   $file_details[0]['file_type'] == 'n' ? $this->lang->line('label_notice_number') : false;
                        echo   $file_details[0]['file_type'] == 'o' ? $this->lang->line('label_letterno_number') : false; ?> : </label>
                    <?php echo (@$file_details[0]['file_uo_or_letter_no'] ? $file_details[0]['file_uo_or_letter_no'] : '' ); ?>
                </div>
            </div>
            <div class="col-xs-4">
                <div class="form-group">
                    <label for="exampleInputPassword1"><?php
                        echo   $file_details[0]['file_type'] == 'f' ? $this->lang->line('view_file_uo_date') : false;
                        echo   $file_details[0]['file_type'] == 'l' ?  $this->lang->line('label_letterno_date') : false;
                        echo   $file_details[0]['file_type'] == 'a' ? $this->lang->line('label_letterno_date') : false;
                        echo   $file_details[0]['file_type'] == 'r' ? $this->lang->line('label_registry_date') : false;
                        echo   $file_details[0]['file_type'] == 'n' ? $this->lang->line('label_notice_date') : false;
                        echo   $file_details[0]['file_type'] == 'o' ? $this->lang->line('label_letterno_date') : false; ?> : </label>
                    <?php  echo (@$file_details[0]['file_uo_or_letter_date'] ? date_format(date_create($file_details[0]['file_uo_or_letter_date']), 'd/m/Y') : '' ); ?>
                </div></div>
            <div class="col-xs-4">
                <div class="form-group">
                    <label for="exampleInputFile"><?php echo $this->lang->line('view_file_type'); ?> : </label>
                    <?php // echo (@$file_details[0]['file_type'] ? $file_details[0]['file_type'] : '' );
                    if(isset($file_details[0]['file_type'])) {
                        echo  getFileType($file_details[0]['file_type']); } ?>
                </div>
            </div>

            <div class="col-xs-12">
                <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line('view_file_subject'); ?> : </label>
                    <?php echo (@$file_details[0]['file_subject'] ? $file_details[0]['file_subject'] : '' ); ?>
                </div>
            </div>


            <div class="col-xs-4">
                <div class="form-group">
                    <label for="exampleInputFile">प्रस्ताव भेजने वाला विभाग  : </label>
                    <?php // echo (@$file_details[0]['file_type'] ? $file_details[0]['file_type'] : '' );
                    if(isset($file_details[0]['file_Offer_by'])) {
                        $file_from = file_from_type();
                        $high_bench =  highcourt_bench();
                        echo    $file_details[0]['file_Offer_by'] == 'c' ? $file_from[$file_details[0]['file_Offer_by']] ." , ". $file_details[0]['district_name_hi'] : false;
                        echo    $file_details[0]['file_Offer_by'] == 'm' ? $file_from[$file_details[0]['file_Offer_by']] ." , ". $high_bench[$file_details[0]['court_bench_id']] : false;
                        echo    $file_details[0]['file_Offer_by'] == 'u' ? $file_from[$file_details[0]['file_Offer_by']] ." , ". $high_bench[$file_details[0]['court_bench_id']] : false;
                        echo    $file_details[0]['file_Offer_by'] == 'au' ? $file_from[$file_details[0]['file_Offer_by']] ." , ". $file_details[0]['state_name_en'] : false;
                        echo    $file_details[0]['file_Offer_by'] == 'v' ? $file_from[$file_details[0]['file_Offer_by']] ." , ". $file_details[0]['dept_name_hi'] : false;
                        echo    $file_details[0]['file_Offer_by'] == 'o' ? $file_from[$file_details[0]['file_Offer_by']] ." , ". $file_details[0]['file_department_name'] : false;
                    } ?>
                </div>
            </div>

            <div class="col-xs-4">
                <?php if($file_details[0]['file_department_id'] != '0' && $file_details[0]['file_department_id'] != null)  { ?>
                    <div class="form-group">
                        <label for="exampleInputFile">विभाग : </label>
                        <?php echo (@$file_details[0]['file_department_id'] ? $file_details[0]['dept_name_hi'] : '' ); ?>
                    </div>
                <?php } else if($file_details[0]['file_district_id'] != '0' && $file_details[0]['file_district_id'] != null) {?>
                    <div class="form-group">
                        <label for="exampleInputFile">जिला : </label>
                        <?php echo (@$file_details[0]['district_name_hi'] ? $file_details[0]['district_name_hi'] : '' ); ?>
                    </div>
                <?php } else if($file_details[0]['state_id'] != '0' && $file_details[0]['state_id'] != null) {?>
                    <div class="form-group">
                        <label for="exampleInputFile">राज्य : </label>
                        <?php echo (@$file_details[0]['state_id'] ? $file_details[0]['state_name_en'] : '' ); ?>
                    </div>
                <?php } else if($file_details[0]['court_bench_id'] != '0' && $file_details[0]['court_bench_id'] != null) {?>
                    <div class="form-group">
                        <label for="exampleInputFile">महाधिवक्ता : </label>
                        <?php echo (@$file_details[0]['court_bench_id'] ? $high_bench[$file_details[0]['court_bench_id']] : '' ); ?>
                    </div>
                <?php } else if($file_details[0]['file_department_name'] != '0' && $file_details[0]['file_department_name'] != null) {?>
                    <div class="form-group">
                        <label for="exampleInputFile">Incoming from : </label>
                        <?php echo (@$file_details[0]['file_department_name'] ? $file_details[0]['file_department_name'] : '' ); ?>
                    </div>
                <?php } ?>
            </div>

            <div class="col-xs-4">
                <div class="form-group">
                    <label for="exampleInputFile"><?php echo $this->lang->line('file_received_by'); ?> : </label>
                    <?php echo (@$file_details[0]['emp_full_name'] ? $file_details[0]['emp_full_name'] : '' ); ?>
                </div>
            </div>

            <div class="col-xs-4">
                <div class="form-group">
                    <label for="view_file_mark_section_id"><?php echo $this->lang->line('view_file_mark_section_id'); ?> : </label>
                    <?php echo (@$file_details[0]['section_name_hi'] ? $file_details[0]['section_name_hi'] : '' ); ?>,<?php echo (@$file_details[0]['section_name_en'] ? $file_details[0]['section_name_en'] : '' ); ?>
                </div>
            </div>

            <?php if($file_details[0]['case_parties'] != '' &&  $file_details[0]['case_parties'] != null) { ?>
                <div class="col-xs-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">पक्षकार/प्रतिवादी : </label>
                        <?php echo (@$file_details[0]['case_parties'] ? preg_replace('/[-]+/', ' ', trim($file_details[0]['case_parties'])) : '' ); ?>
                    </div>
                </div>
            <?php } ?>

            <?php if($file_details[0]['case_no'] != '' &&  $file_details[0]['case_no'] != null) { ?>
                <div class="col-xs-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">प्रकरण क्र.  : </label>
                        <?php echo (@$file_details[0]['case_no'] ? trim($file_details[0]['case_no']) : '' ); ?>
                    </div>
                </div>
            <?php } ?>

            <?php if($file_details[0]['file_linked_id'] != '' &&  $file_details[0]['file_linked_id'] != 0) { ?>
                <div class="col-xs-12">
                    <label for="exampleInputEmail1">Linked Files  : </label>
                    <?php $file_links = explode(',',$file_details[0]['file_linked_id']);
                    foreach($file_links as $file_l){ ?>
                        <a href="<?php echo base_url();?>view_file/viewdetails/<?php echo $file_l ;?>"><button type="button" class="btn bg-light-blue btn-xs"><span class="fa fa-fw fa-link"></span> <?php echo "View File ". $file_l ?></button></a>

                    <?php } ?>
                </div>
            <?php } ?>

        </div>
    </div>
</div>

<div class="col-xs-12">
    <div class="box box-warning">
        <div class="box-header">
            <h3 class="box-title"><?php echo $title_tab; ?></h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="col-md-12">
                <form method="post" action="">
                    <div class="col-xs-3">
                        <div class="input-group">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-primary">For link Search By</button>
                            </div>
                            <select class="form-control" name="search_type" id="search_type">
                                <option value="" >Select type</option>
                                <?php foreach(file_searchtypes()  as $key => $value) {
                                    if($key != '9' && $key != '5'){
                                        ?>
                                        <option value="<?php echo $key; ?>" <?php echo @$this->input->post('search_type') == $key ? "selected" : false?>><?php echo $value; ?></option>
                                    <?php }} ?>
                            </select>
                        </div>
                        <?php echo form_error('search_type');?>
                    </div>

                    <div class="col-xs-3" id="dis4" <?php echo @$this->input->post('search_type') == '1' ? "style='display: block'" : "style='display: none'"?>>
                        <select name="sections" class="form-control">
                            <option value="">Select</option>
                            <?php $empssection = empdetails(emp_session_id());
                            foreach(explode(",",$empssection[0]['emp_section_id'])  as $empsec){
                                if($empsec == $file_details[0]['file_mark_section_id']){
                                    ?>
                                    <option value="<?php echo $empsec ?>" <?php echo @$this->input->post('sections') == $empsec ? "selected" : false?>><?php echo getSection($empsec) ; ?></option>
                                <?php } }?>
                        </select>
                        <?php echo form_error('sections');?>
                    </div>


                    <div class="col-xs-3" id="dis1" <?php echo @$this->input->post('search_type') != '5' && $this->input->post('search_type') != '9' && $this->input->post('search_type') != '7' && $this->input->post('search_type') != '4' ? "style='display: block'" : "style='display: none'"?>>
                        <input type="text"  name="search_value" id="search_value" value="<?php echo @$this->input->post('search_value') ? $this->input->post('search_value') : ''  ?>" autocomplete="off" placeholder="Put Value"  class="form-control">
                        <?php echo form_error('search_value');?>
                    </div>
                    <div id="dis2" <?php echo @$this->input->post('search_type') == '4' ? "style='display: block'" : "style='display: none'"?>>
                        <div class="col-xs-3">
                            <input type="text" placeholder="From Date" name="frm_dt" id="frm_dt" autocomplete="off"  class="form-control">
                            <?php echo form_error('frm_dt');?>
                        </div>
                    </div>

                    <div class="col-xs-4" id="dis3" <?php echo @$this->input->post('search_type') == '5' ? "style='display: block'" : "style='display: none'"?>>
                        <select name="months" class="form-control">
                            <?php foreach (months() as $key => $val) {
                                if(date("m") >= $key) { ?>
                                    <option value="<?php echo $key ?>" <?php if ($key == date("m")) { echo "selected"; } ?>><?php echo $val." / ".date("Y") ; ?></option>
                                <?php } } ?>
                        </select>
                        <?php echo form_error('file_type');?>
                    </div>

                    <!-- for case no.-->
                    <div class="show_case"  <?php echo @$this->input->post('search_type') == '7' ? "style='display: block'" : "style='display: none'"?>>
                        <div class="col-xs-2">
                            <select name="case_type" class="form-control">
                                <option value="">Select type</option>
                                <?php foreach(case_name() as $case){ ?>
                                    <option value="<?php echo $case ?>"><?php echo $case ?></option>
                                <?php } ?>
                            </select>
                            <?php echo form_error('case_type');?>
                        </div>
                        <div class="col-xs-2">
                            <input type="text" name="case_no" placeholder="Number" value="" class="form-control">
                            <?php echo form_error('case_no');?>
                        </div>
                        <div class="col-xs-2">
                            <select Name='case_year' class="form-control"><?php
                                for ($x=date("Y"); $x>2000; $x--)
                                { echo'<option value="'.$x.'">'.$x.'</option>';  } ?>
                            </select>
                            <?php echo form_error('case_year');?>
                        </div>
                    </div>
                    <!-- End case no.-->

                    <div class="show_movement_dt" <?php echo @$this->input->post('search_type') == '9' ? "style='display: block'" : "style='display: none'"?>>
                        <div class="col-xs-3">
                            <input type="text" placeholder="From Date" name="movement_frm_dt" id="movement_frm_dt" autocomplete="off"  class="form-control">
                            <?php echo form_error('movement_frm_dt');?>
                        </div>
                        <div class="col-xs-3">
                            <input type="text" placeholder="To Date" name="movement_to_dt" id="movement_to_dt" autocomplete="off"  class="form-control">
                            <?php echo form_error('movement_to_dt');?>
                        </div>
                    </div>

                    <div class="col-xs-1">
                        <button type="submit" class="btn btn-success">Search</button>
                    </div>
                    <div class="col-xs-12">
                        <p>&nbsp;</p><br/>
                    </div>

                </form>
            </div>

            <form action="<?php echo base_url(); ?>view_file/file_search/manage_link_files" method="post">
                <input type="hidden" name="file3" value="<?php echo $file_details[0]['file_id'] ; ?>">
                <?php
                if(isset($get_files)){
                    if(!empty($get_files)) {?>
                        <div class="col-md-12" style="overflow: auto">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th><?php echo $this->lang->line('sno'); ?></th>
                                    <th><?php echo $this->lang->line('view_file_subject'); ?></th>
                                    <th><?php echo $this->lang->line('uo/letter_no'); ?></th>
                                    <th><?php echo $this->lang->line('view_file_uo_letter_date'); ?></th>
                                    <th><?php echo $this->lang->line('view_mark_section'); ?></th>
                                    <th><?php echo $this->lang->line('section_no1'); ?></th>
                                    <th><?php echo $this->lang->line('date'); ?></th>
                                    <th><?php echo $this->lang->line('filestatus'); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=1; foreach ($get_files as $key => $files) {
                                    if($files->file_id != $file_details[0]['file_id']) {?>
                                        <tr>
                                            <td><input type="checkbox" name="linkcheck[]" value="<?php echo $files->file_id;?>"/></td>
                                            <td><?php echo $i;?> (<?php echo $this->lang->line('file_no'); ?> : <?php echo $files->file_id;?>)</td>
                                            <td><?php echo $files->file_subject;?></td>
                                            <td><?php echo $files->file_uo_or_letter_no; ?> (<?php echo getFileType($files->file_type) ;?>)</td>
                                            <td><?php echo date_format(date_create($files->file_uo_or_letter_date), 'd/m/y'); ?></td>
                                            <td><?php echo getSection($files->file_mark_section_id); ?></td>
                                            <td><?php
                                                if(isset($files->section_number)){
                                                    echo $files->section_number;

                                                } else {
                                                    $name_sec = getfilesec_id_byfileid($files->file_id,$files->file_mark_section_id,$files->file_type);
                                                    if(!empty($name_sec)){
                                                        echo $name_sec;
                                                    }else{
                                                        echo 'Na/na';
                                                    }
                                                }
                                                @$files->section_number ? $files->section_number : getfilesec_id_byfileid($files->file_id,$files->file_mark_section_id,$files->file_type)
                                                ?></td>
                                            <td><?php echo date_format(date_create($files->file_update_date), 'd/m/y'); ?>
                                                (<?php if($files->file_hardcopy_status == 'not'){ echo $this->lang->line('mark_date');} else { echo $this->lang->line('received_date');} ?>)
                                            </td>
                                            <td align=""><?php
                                                $filereceiver = get_user_details($files->file_received_emp_id);
                                                if ($filereceiver)
                                                {
                                                    if($files->file_hardcopy_status == 'not') {
                                                        echo "<span style='color:#dd4b39' >Not Received by <b>".ucfirst($filereceiver[0]->emp_full_name)."</b><br/>(".$filereceiver[0]->emprole_name_hi.")</span>";
                                                    } else {
                                                        echo "<span style='color:#00a65a' >Received by <b>".ucfirst($filereceiver[0]->emp_full_name)."</b><br/>(".$filereceiver[0]->emprole_name_hi.")</span>";
                                                    }  } ?></td>
                                        </tr>
                                        <?php $i++; }} ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-3"><button type="submit" class="btn btn-success">LINK FILES</button></div>
                    <?php } else{
                        echo "<div align='center' class='text-danger'><b>No Data available Plz Try Again..</b></div>";
                    }} ?>
            </form>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</div>
</div><!-- /.row -->
<!-- Main row -->
</section><!-- /.content -->
<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script type="text/javascript">
    $('#search_type').change(function(){
        $typeval  = $("#search_type") .val();
        if($typeval == '4'){
            $("#dis1,#dis3,#dis4").hide();
            $("#dis2").show();
            $(".show_case").hide();
            $(".show_movement_dt").hide();
        }else if($typeval == '5'){
            $("#dis3").show();
            $("#dis2,#dis1,#dis4").hide();
            $(".show_case").hide();
            $(".show_movement_dt").hide();
        }else if($typeval == '1'){
            $("#dis4,#dis1").show();
            $("#dis2,#dis3").hide();
            $(".show_case").hide();
            $(".show_movement_dt").hide();
        }else if($typeval == '7'){
            $(".show_case").show();
            $("#dis4,#dis1").hide();
            $("#dis2,#dis3").hide();
            $(".show_movement_dt").hide();
        }else if($typeval == '9'){
            $(".show_movement_dt").show();
            $(".show_case").hide();
            $("#dis4,#dis1").hide();
            $("#dis2,#dis3").hide();
        } else{
            $("#dis1").show();
            $("#dis2,#dis3,#dis4").hide();
            $(".show_case").hide();
            $(".show_movement_dt").hide();
        }
    });
</script>
