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
            <h3 class="box-title">Modified File Details <b>पंजी क्रमांक : <?php echo getfilesec_id_byfileid($file_details[0]['file_id'],$file_details[0]['file_mark_section_id'],$file_details[0]['file_type']); ?></b></h3>
            <a href="<?php echo base_url()  ; ?>view_file/dealing_file"><button class="btn btn-warning" title="Back" style="float:right"><?php echo $this->lang->line('Back_button_label'); ?></button></a>
            <div class="col-xs-12"><label> फाइल एकीकृत करते ही ,इस फाइल का पंजी क्रमांक  मुख्य क्रमांक माना जाएगा, अन्य फाइल को शाखा में ही बंद कर  दिया जाएगा |   </label></div>
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

            <div class="col-xs-12">
                <label for="exampleInputFile"><?php echo $this->lang->line('view_file_progress_status'); ?> : </label>
                <?php
                $filereceiver = get_user_details($file_details[0]['file_received_emp_id']);
                if ($filereceiver)
                {
                    if($file_details[0]['file_hardcopy_status'] == 'not') {
                        echo file_not_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi);
                    } else if($file_details[0]['file_hardcopy_status'] == 'close') {
                        echo file_closed_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi, $file_details[0]['file_type']);
                    } else  if($file_details[0]['file_hardcopy_status'] == 'received') {
                        echo file_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi);
                    } else if($file_details[0]['file_hardcopy_status'] == 'working'){
                        echo file_working_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi);
                    }
                }
                if($file_details[0]['multi_user_receiver_id'] !=null){
                    $multi_rece = explode(',',$file_details[0]['multi_user_receiver_id']);
                    if($file_details[0]['multi_user_receiver_id'] != null && $file_details[0]['multi_user_receiver_id'] != '' && in_array($file_details[0]['file_received_emp_id'],$multi_rece)){                                               echo " तथा ";

                        foreach($multi_rece as $multi){
                            if($multi != $file_details[0]['file_received_emp_id']) {
                                $multi_nm = getemployeeName($multi, $ishindi = true);
                                echo $multi_nm;
                                echo " , ";
                            }
                        }
                        echo " को अंकित की गई है |";
                    }
                }				?>
            </div>


            <?php if($file_details[0]['file_linked_id'] != '' &&  $file_details[0]['file_linked_id'] != 0) { ?>
                <div class="col-xs-12">
                    <label for="exampleInputEmail1">Linked Files  : </label>
                    <?php $file_links = explode(',',$file_details[0]['file_linked_id']);
                    foreach($file_links as $file_l){ ?>
                <a href="<?php echo base_url(); ?>view_file/viewdetails/<?php  echo $file_l ; ?>"><button type="button" class="btn bg-light-blue bt-block btn-xs"><span class="fa fa-fw fa-link"></span> <?php
                                $rrt = all_getfilesec_id_byfileid($file_l);
                                foreach($rrt as $rrt1){
                                    $sechi = explode('(',getSection($rrt1['section_id']));
                                    echo " ".$rrt1['section_number'] ." - <span>".$sechi['0']."</span> , ";
                                }
                                ?></button></a>

                    <?php } ?>
                </div>
            <?php } ?>

        </div>
    </div>
</div>

<?php if($file_details[0]['file_received_emp_id'] == emp_session_id() && $file_details[0]['file_hardcopy_status']=='received') {?>

<?php } ?>
<div class="col-xs-12">
<div class="box box-warning">
<?php if($file_details[0]['file_received_emp_id'] == emp_session_id() && $file_details[0]['file_hardcopy_status']!='not') {?>


    <div class="box-body">
    <div class="col-md-12">
        <form method="post" action="">
            <button type="submit" value="related_view" name="show_related_view" class="btn btn-block btn-vk">क्या आप एक ही विषय , प्रकरण क्र. से संबधित नस्ती खोजना चाहते है | (किल्क करे)</button>
        </form>

        <hr/>

        <form method="post" action="">
            <div class="col-xs-3">
                <div class="input-group">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-primary">खोज का प्रकार</button>
                    </div>
                    <select class="form-control" name="search_type" id="search_type">
                        <option value="" >खोजनें का प्रकार चयन करें</option>
                        <?php foreach(file_searchtypes()  as $key => $value) {
                            if($key != 5 && $key != 9 && $key != 11){
                                ?>
                                <option value="<?php echo $key; ?>" <?php echo @$this->input->post('search_type') == $key ? "selected" : false?>><?php echo $value; ?></option>
                            <?php }} ?>
                    </select>
                </div>
                <?php// echo form_error('search_type');?>
            </div>

            <div class="col-xs-2" id="dis4" <?php echo @$this->input->post('search_type') == '1' ? "style='display: block'" : "style='display: none'"?>>
                <select name="sections" id="search_section_wise" class="form-control">
                    <option value="">सेक्शन का चयन करें</option>
                    <option value="1">आवक (CR)</option>
                    <?php $empssection = empdetails(emp_session_id());
                    foreach(explode(",",$empssection[0]['emp_section_id'])  as $empsec){ ?>
                        <option value="<?php echo $empsec ?>" <?php echo @$this->input->post('sections') == $empsec ? "selected" : false?>><?php echo getSection($empsec) ; ?></option>
                    <?php  }?>

                </select>
                <?php echo form_error('sections');?>
            </div>
            <?php $cr_section_ids= get_cr_emp_id(1);?>
            <?php if(in_array(emp_session_id(),$cr_section_ids['id_array'])){?>
                <div class="col-xs-2" id="dis4_1" <?php echo @$this->input->post('search_type') == '1' ? "style='display: block'" : "style='display: none'"?>>
                    <?php $other_section=get_list_orderwise(SECTIONS,array('col'=>'section_name_en','order'=>'asc'),array('section_id !='=>1,'section_id !='=>26),null); ?>
                    <select name="mark_sections" id="search_mark_sections" class="form-control">
                        <option value="">अन्य सेक्शन का चयन करें</option>
                        <?php foreach($other_section  as $empsec){ ?>
                            <option value="<?php echo $empsec['section_id'] ?>" <?php echo @$this->input->post('mark_sections') == $empsec['section_id'] ? "selected" : false?>><?php echo getSection($empsec['section_id']) ; ?></option>
                        <?php  }?>
                    </select>
                    <?php echo form_error('mark_sections');?>
                </div>
            <?php } ?>
            <div class="col-xs-3" id="dis1" <?php echo @$this->input->post('search_type') != '5' && $this->input->post('search_type') != '9' && $this->input->post('search_type') != '10' && $this->input->post('search_type') != '7' && $this->input->post('search_type') != '4'  && $this->input->post('search_type') != '11' ? "style='display: block'" : "style='display: none'"?>>
                <input type="text"  name="search_value" id="search_value" value="<?php echo @$this->input->post('search_value') ? $this->input->post('search_value') : ''  ?>" autocomplete="off" placeholder="Put Value"  class="form-control">
                <?php echo form_error('search_value');?>
            </div>
            <div id="dis2" <?php echo @$this->input->post('search_type') == '4' ? "style='display: block'" : "style='display: none'"?>>
                <div class="col-xs-3">
                    <input type="text" placeholder="From Date" name="frm_dt" id="frm_dt" autocomplete="off"  class="form-control">
                    <?php echo form_error('frm_dt');?>
                </div>
                <!--<div class="col-xs-3">
                                    <input type="text" placeholder="To Date" name="to_dt" id="to_dt" autocomplete="off"  class="form-control">
                                <?php echo form_error('to_dt');?>
                                </div>-->
            </div>
            <div class="col-xs-4" id="dis3" <?php echo @$this->input->post('search_type') == '5' ? "style='display: block'" : "style='display: none'"?>>
                <select name="months" id="search_month_wise" class="form-control">
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
                    <select name="case_type"  id="search_case_type" class="form-control">
                        <option value="">प्रकरण चयन करें</option>
                        <?php foreach(case_name() as $case){ ?>
                            <option value="<?php echo $case ?>"><?php echo $case ?></option>
                        <?php } ?>
                    </select>
                    <?php echo form_error('case_type');?>
                </div>
                <div class="col-xs-2">
                    <input type="text" name="case_no" id="search_case_no" placeholder="Number" value="" class="form-control">
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

            <!--Search datewise with filter-->
            <div  class="show_search_dt_filter no-print" <?php echo @$this->input->post('search_type') == '10' ? "style='display: block'" : "style='display: none'"?>>
                <div class="col-xs-2">
                    <select id="filter_section_emp_wise"  name="filter_section_emp_wise" class="form-control rmv_required">
                        <option value="">चयन करें</option>
                        <option value="emp" <?php if(@$filter_section_emp_wise=='emp'){ echo 'selected';} ?>>Employees</option>
                        <option value="sec" <?php if(@$filter_section_emp_wise=='sec'){ echo 'selected';} ?>>Sections</option>
                    </select>
                    <?php echo form_error('filter_section_emp_wise  ');?>
                </div>
                <div class="col-xs-2">
                    <select id="section_emp_list" name="empid_secid" class="form-control rmv_required" >
                        <option value="">चयन करें</option>
                    </select>
                    <?php echo form_error('empid_secid');?>

                </div>
                <div class="col-xs-2">
                    <input type="text" placeholder="From Date"  name="search_frm_dt" id="search_frm_dt" autocomplete="off" value="<?php echo $frm_date; ?>"  class="form-control ps_moniter_date rmv_required">
                    <?php echo form_error('search_frm_dt');?>
                </div>
                <div class="col-xs-2">
                    <input type="text" placeholder="To Date"  name="search_to_dt" id="search_to_dt" autocomplete="off"  value="<?php echo $to_date; ?>" class="form-control ps_moniter_date rmv_required">
                    <?php echo form_error('search_to_dt');?>
                </div>

            </div>
            <!--statrt dispatch file type-->
            <div class="col-xs-2 dispatch_block" <?php echo $this->input->post('search_type') == '11' ? "style='display: block'" : "style='display: none'"?>>
                <input type="text" placeholder="Date"  name="date_distpach" id="date_distpach" autocomplete="off"  value="" class="form-control ps_moniter_date">
                <?php echo form_error('date_distpach');?>
            </div>
            <div class="col-xs-2 dispatch_block" <?php echo $this->input->post('search_type') == '11' ? "style='display: block'" : "style='display: none'"?>>
                <select name="sections_all" id="" class="form-control">
                    <option value="">सेक्शन का चयन करें</option>
                    <?php $empssection = empdetails(emp_session_id());
                    foreach(explode(",",$empssection[0]['emp_section_id'])  as $empsec){ ?>
                        <option value="<?php echo $empsec ?>" <?php echo @$this->input->post('sections_all') == $empsec ? "selected" : false?>><?php echo getSection($empsec) ; ?></option>
                    <?php  }?>
                </select>
            </div>

            <div class="col-xs-2 dispatch_block" <?php echo $this->input->post('search_type') == '11' ? "style='display: block'" : "style='display: none'"?>>
                <select name="dispatch_type" class="form-control">
                    <!--<option value="all">All</option>-->
                    <option value="not_received">Not Received</option>
                    <option value="received">Received</option>
                    <option value="close">Close</option>
                </select>
                <?php echo form_error('dispatch_type');?>
            </div>
            <!--end dispatch file type-->
            <!--Search datewise with filter-->
            <input type="hidden" name="temp_section_emp_name" id="temp_section_emp_name"/>
            <!--   <input type="hidden" value="related_view" name="show_related_view"/>-->
            <div class="col-xs-1">
                <button type="submit" class="btn btn-success">खोजें</button>
            </div>
            <input type="checkbox" value="related_view" name="show_related_view"/> check to show releted view (if any)
            <div class="col-xs-12">
                <div style="clear:both">Note : All fields are required *</div>
            </div>

        </form>

    </div>

    <form action="<?php echo base_url(); ?>view_file/file_search/manage_link_files" method="post">
        <input type="hidden" name="file3" value="<?php echo $file_details[0]['file_id'] ; ?>">
        <div class="col-md-12" style="overflow: auto">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Merge</th>
                    <th><?php echo $this->lang->line('sno'); ?></th>
                    <th><?php echo $this->lang->line('view_file_subject'); ?></th>
                    <th>पक्षकार</th>
                    <th>प्रकरण क्र.</th>
                    <th><?php echo $this->lang->line('uo/letter_no'); ?></th>
                    <th><?php echo $this->lang->line('view_file_uo_letter_date'); ?></th>
                    <th><?php echo $this->lang->line('view_mark_section'); ?></th>
                    <th><?php echo $this->lang->line('section_no1'); ?></th>
                    <th><?php echo $this->lang->line('date'); ?></th>
                    <th><?php echo $this->lang->line('filestatus'); ?></th>
                </tr>
                </thead>
                <tbody>

                <?php
                $disable_btn = 'disabled';
                if(isset($get_files_related) && !empty($get_files_related)){
                    $i=1; foreach ($get_files_related as $key => $files) {
                        if($files != null && is_array($files)){
                            $files = $files[0];
                        }
                        if($files != null && $files->file_id != $file_details[0]['file_id'] && $files->file_hardcopy_status != 'close') {?>
                            <tr class="text-bold" data-toggle='tooltip' data-original-title="Related files">
                                <!--<td><input type="checkbox" name="linkcheck[]" value="<?php /*echo $files->file_id;*/?>"/></td>-->
                                <td><?php  if((emp_session_id() == $files->file_received_emp_id && $files->file_hardcopy_status != 'not') || $files->file_hardcopy_status == 'close') {?>
                                        <input type="checkbox" name="linkcheck[]" class="checkrag" value="<?php echo $files->file_id;?>"/>
                                    <?php }else{ echo "<span class='fa fa-fw fa-unlink' data-toggle='tooltip' data-original-title='कृप्या इस फाइल को आहुत करें |'></span>"; } ?></td>
                                <td><?php echo $i;?> (<?php echo $this->lang->line('file_no'); ?> : <?php echo $files->file_id;?>)</td>
                                <td><?php echo $files->file_subject;?>
                                    <br><?php if(isset($files->scan_id) && $files->scan_id != ''){ show_scan_file($files->scan_id);}?>
                                </td>
                                <td><?php echo $files->case_parties;?></td>
                                <td><?php echo @$files->case_no ? $files->case_no : '';?></td>
                                <td><?php echo $files->file_uo_or_letter_no; ?> (<?php echo getFileType($files->file_type) ;?>)</td>
                                <td><?php echo date_format(date_create($files->file_uo_or_letter_date), 'd/m/y'); ?></td>
                                <td><?php echo getSection($files->file_mark_section_id); ?></td>
                                <td>
                                    <?php
									$rrt = all_getfilesec_id_byfileid($files->file_id);
									foreach($rrt as $rrt1){
									$sechi = explode('(',getSection($rrt1['section_id']));
									echo "<b>".$rrt1['section_number'] ."</b> - <span style='font-size: 12px'>".$sechi['0']."</span><br/>";
									}
									?>
                                </td>
                                <td><?php echo date_format(date_create($files->file_update_date), 'd/m/y'); ?>
                                    (<?php if($files->file_hardcopy_status == 'not'){ echo $this->lang->line('mark_date');} else { echo $this->lang->line('received_date');} ?>)
                                </td>
                                <td align=""><?php
                                    $filereceiver = get_user_details($files->file_received_emp_id);
                                    if ($filereceiver)
                                    {
                                        if($files->file_hardcopy_status == 'not') {
                                            echo file_not_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi);
                                        } else if($files->file_hardcopy_status == 'close') {
                                            echo file_closed_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi, $files       ->file_type);
                                        } else  if($files->file_hardcopy_status == 'received') {
                                            echo file_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi);
                                        } else if($files->file_hardcopy_status == 'working'){
                                            echo file_working_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi);
                                        }

                                    } ?>
                                </td>
                            </tr>
                            <tr><td colspan="11"><hr/></td></tr>
                            <?php $i++;
                            $disable_btn = '';
                        }}}
                else{

                    //  echo "<div align='center' class='text-danger'><b>No Data available Plz Try Again..</b></div>";
                }
                ?>

                <?php
                if(isset($get_files) && !empty($get_files)){
                    $i=1; foreach ($get_files as $key => $files) {
                        if($files != null && is_array($files)){
                            $files = $files[0];
                        }
                        if($files != null && $files->file_id != $file_details[0]['file_id'] && $files->file_hardcopy_status != 'close' ) {?>
                            <tr  <?php  if(emp_session_id() == $files->file_received_emp_id && $files->file_hardcopy_status == 'not') { ?> data-toggle='tooltip' data-original-title="यह फाइल आपके द्वरा स्वीकृत नही की गई है ,  कृप्या स्वीकार करके पुनः प्रयास करे |" <?php } elseif(emp_session_id() != $files->file_received_emp_id && $files->file_hardcopy_status == 'close') {?> data-toggle='tooltip' data-original-title="कृप्या इस फाइल को आहुत करें |" <?php } ?>>
                                <td>
                                    <?php  if((emp_session_id() == $files->file_received_emp_id && $files->file_hardcopy_status != 'not') || $files->file_hardcopy_status == 'close') {?>
                                        <input type="checkbox" name="linkcheck[]" class="checkrag" value="<?php echo $files->file_id;?>"/>
                                    <?php }else{ echo "<span class='fa fa-fw fa-unlink'></span>"; } ?></td>
                                <td><?php echo $i;?> (<?php echo $this->lang->line('file_no'); ?> : <?php echo $files->file_id;?>)</td>
                                <td><?php echo $files->file_subject;?><br><?php if(isset($files->scan_id) && $files->scan_id != ''){ show_scan_file($files->scan_id);}?></td>
                                <td><?php echo $files->case_parties;?></td>
                                <td><?php echo @$files->case_no ? $files->case_no : '';?></td>
                                <td><?php echo $files->file_uo_or_letter_no; ?> (<?php echo getFileType($files->file_type) ;?>)</td>
                                <td><?php echo date_format(date_create($files->file_uo_or_letter_date), 'd/m/y'); ?></td>
                                <td><?php echo getSection($files->file_mark_section_id); ?></td>
                                <td>
                                    <?php
									$rrt = all_getfilesec_id_byfileid($files->file_id);
									foreach($rrt as $rrt1){
									$sechi = explode('(',getSection($rrt1['section_id']));
									echo "<b>".$rrt1['section_number'] ."</b> - <span style='font-size: 12px'>".$sechi['0']."</span><br/>";
									}
									?>
                                </td>
                                <td><?php echo date_format(date_create($files->file_update_date), 'd/m/y'); ?>
                                    (<?php if($files->file_hardcopy_status == 'not'){ echo $this->lang->line('mark_date');} else { echo $this->lang->line('received_date');} ?>)
                                </td>
                                <td align=""><?php
                                    $filereceiver = get_user_details($files->file_received_emp_id);
                                    if ($filereceiver)
                                    {
                                        if($files->file_hardcopy_status == 'not') {
                                            echo file_not_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi);
                                        } else if($files->file_hardcopy_status == 'close') {
                                            echo file_closed_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi, $files       ->file_type);
                                        } else  if($files->file_hardcopy_status == 'received') {
                                            echo file_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi);
                                        } else if($files->file_hardcopy_status == 'working'){
                                            echo file_working_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi);
                                        }

                                    } ?>
                                </td>
                            </tr>
                            <?php $i++;
                            $disable_btn = '';
                        }}}else{


                    //  echo "<div align='center' class='text-danger'><b>No Data available Plz Try Again..</b></div>";
                } ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-12"><button type="submit" onclick="return confirm('एकीकृत होने के बाद नस्ती अलग नहीं होगी |') , confirm('क्या आप नस्ती को एकीकृत करना चाहते है |')" class="btn btn-success" <?php echo $disable_btn ?> id="merge_id">MERGE FILES</button>
            <span class="text-red"> * एकीकृत होने  के बाद नस्ती अलग नहीं होगी |</span></div>

    </form>

    </div><!-- /.box-body -->
<?php }else{ ?>
    <div class="box-body text-center"><label>इस फाइल को एकीकृत करने हेतु पहले फाइल को अपनी ID पे Receive करें | </label></div>
<?php } ?>
</div><!-- /.box -->
</div>


</div><!-- /.row -->
<!-- Main row -->
</section><!-- /.content -->
<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script type="text/javascript">

    /* $('.checkrag').change(function(){
     if($('.checkrag').is(':checked')){
     $("#merge_id").prop("disabled", false);
     }else{
     $("#merge_id").prop("disabled", true);
     }
     });*/

    $('#search_type').change(function(){
        $typeval  = $("#search_type") .val();
        $('.rmv_required').prop('required', false);
        if($typeval == '4'){
            $("#dis1,#dis3,#dis4,#dis4_1").hide();
            $("#dis2").show();
            $(".show_case,.show_search_dt_filter, .dispatch_block").hide();
            $(".show_movement_dt").hide();
        }else if($typeval == '5'){
            $("#dis3").show();
            $("#dis2,#dis1,#dis4,#dis4_1").hide();
            $(".show_case,.show_search_dt_filter, .dispatch_block").hide();
            $(".show_movement_dt").hide();
        }else if($typeval == '1'){
            $("#dis4,#dis4_1,#dis1").show();
            $("#dis2,#dis3").hide();
            $(".show_case,.show_search_dt_filter, .dispatch_block").hide();
            $(".show_movement_dt").hide();
        }else if($typeval == '7'){
            $(".show_case").show();
            $("#dis4,#dis4_1,#dis1").hide();
            $("#dis2,#dis3").hide();
            $(".show_movement_dt,.show_search_dt_filter, .dispatch_block").hide();
        }else if($typeval == '9'){
            $(".show_movement_dt").show();
            $(".show_case,.show_search_dt_filter, .dispatch_block").hide();
            $("#dis4,#dis4_1,#dis1").hide();
            $("#dis2,#dis3").hide();
        }else if($typeval == '10'){
            $(".show_search_dt_filter").show();
            $(".show_movement_dt, .dispatch_block").hide();
            $(".show_case").hide();
            $("#dis4,#dis4_1,#dis1").hide();
            $("#dis2,#dis3").hide();
            $('.rmv_required').prop('required', true);
        }else if($typeval == '11'){
            $(".show_movement_dt,.show_search_dt_filter, .show_case").hide();
            $("#dis4,#dis4_1,#dis1").hide();
            $("#dis2,#dis3").hide();
            $(".dispatch_block").show();
        } else{
            $("#dis1").show();
            $("#dis2,#dis3,#dis4,#dis4_1").hide();
            $(".show_case,.show_search_dt_filter, .dispatch_block").hide();
            $(".show_movement_dt").hide();
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
    });
    $('#search_case_type').change(function(){
        var caseno = $("#search_case_no").val();
        var casetype = $("#search_case_type option:selected").text();
        var search_case_type_no=casetype+'-'+caseno;
        $("#temp_section_emp_name").val(search_case_type_no);
    });


</script>
