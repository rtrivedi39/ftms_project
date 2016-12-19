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
            <h3 class="box-title">Split File (पंजी क्रं :<b> <?php
                    $rrt = all_getfilesec_id_byfileid($file_details[0]['file_id']);
                    if($rrt){
                        foreach($rrt as $rrt1){
                            $sechi = explode('(',getSection($rrt1['section_id']));
                            echo " ".$rrt1['section_number'] ." - <span>".$sechi['0']."</span> , ";
                        }}
                    ?></b>)</h3>
            <!--<a href="<?php echo base_url()  ; ?>view_file/dealing_file"><button class="btn btn-warning" title="Back" style="float:right"><?php echo $this->lang->line('Back_button_label'); ?></button></a>
            <div class="col-xs-12"><label> फाइल एकीकृत करते ही ,इस फाइल का पंजी क्रमांक  मुख्य क्रमांक माना जाएगा, अन्य फाइल को शाखा में ही बंद कर  दिया जाएगा |   </label></div>-->
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
                    <label for="view_file_mark_section_id"><?php echo $this->lang->line('view_file_mark_section_id'); ?> : </label>
                    <?php echo (@$file_details[0]['section_name_hi'] ? $file_details[0]['section_name_hi'] : '' ); ?>,<?php echo (@$file_details[0]['section_name_en'] ? $file_details[0]['section_name_en'] : 'व्यक्तिगत (Personal)' ); ?>
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
            <?php if($file_details[0]['file_copy_ids'] != '' &&  $file_details[0]['file_copy_ids'] != 0) { ?>
                <div class="col-xs-12">
                    <label for="exampleInputEmail1">Copies Of Files  : </label>
                    <?php $file_links = explode(',',$file_details[0]['file_copy_ids']);
                    foreach($file_links as $file_l){ ?>
                        <a title="File id : <?php  echo $file_l ; ?>" href="<?php echo base_url(); ?>view_file/viewdetails/<?php  echo $file_l ; ?>"><button type="button" class="btn bg-light-blue bt-block btn-xs"><span class="fa fa-fw fa-link"></span> <?php
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

<div class="col-xs-12">
    <div class="box box-warning">
        <?php if($file_details[0]['file_received_emp_id'] != emp_session_id()) {?>
            <div class="box-body text-center"><label>इस फाइल  की प्रतिलिपि बनाने  हेतु पहले फाइल को अपनी ID पे Receive करें | </label></div>
        <?php }else{ ?>
        <div class="box-header">
            <h3 class="box-title">नस्ती की प्रतिलिपि दर्ज करें</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="col-md-12">
                <form action="<?php echo base_url(); ?>view_file/file_splitting/file_splitting_fn" method="post">
                    <input type="hidden" name="s_file_id" value="<?php echo (@$file_details[0]['file_id'] ? $file_details[0]['file_id'] : '' ); ?>" />

                    <?php  $rrt = all_getfilesec_id_byfileid($file_details[0]['file_id']);
                    if($rrt){  foreach($rrt as $rrt1){
                        $sechi = explode('(',getSection($rrt1['section_id']));
                        $ttu[] = $rrt1['section_number']."/21-".get_section_code($rrt1['section_id'])."/".date('y');
                    }}
                    $panji = implode(" , ",$ttu);  ?>
                    <input type="hidden" name="s_description" value="मूल नस्ती के पंजी क्र. : <?php echo $panji ; ?>" />
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="file_subject">नस्ती क्रं</label>
                                    <input type="text" class="form-control" name="s_uonumber" value="<?php echo (@$file_details[0]['file_uo_or_letter_no'] ? $file_details[0]['file_uo_or_letter_no'] : '' ); ?>"/>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="file_subject">विषय</label>
                                    <textarea class="form-control" name="s_filesubject"><?php echo (@$file_details[0]['file_subject'] ? $file_details[0]['file_subject'] : '' ); ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <div class="form-group">
                        <div  class="col-xs-1"></div>
                        <div class="col-xs-4">
                            <div class="input-group">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-primary">नस्ती अंकित </button>
                                </div>
                                <select required="required" class="form-control" name="file_mark_type" id="file_mark_type">
                                    <option value=""> चयन करें</option>
                                    <option value="1">अनुभाग</option>
                                    <option value="2">व्यक्तिगत</option>
                                </select>
                            </div>
                            <?php// echo form_error('search_type');?>
                        </div>
                        <div class="col-xs-4">
                            <div id="marked_perameter">
                                <select name="" class="form-control">
                                    <option value="">Select type</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-2">
                            <button type="submit" value="split_file" onclick="return confirm('क्या आप नस्ती की प्रतिलिपि बनाना चाहते है |')" name="split_file" class="btn btn-vk">Split File</button>

                        </div>
                    </div>
                </form>

            </div>
        </div><!-- /.box-body -->
<?php } ?>
    </div><!-- /.box -->
</div>

<div class="col-xs-12">
    <div class="box box-warning">
        <div class="box-header">
            <h3 class="box-title">फाइल की प्रतिलिपिया</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="col-md-12">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th><?php echo $this->lang->line('sno'); ?></th>
                        <th><?php echo $this->lang->line('uo/letter_no'); ?></th>
                        <th><?php echo $this->lang->line('view_file_subject'); ?></th>
                        <th>विवरण</th>
                        <th><?php echo $this->lang->line('view_file_uo_letter_date'); ?></th>
                        <th><?php echo $this->lang->line('view_mark_section'); ?></th>
                        <th><?php echo $this->lang->line('section_no1'); ?></th>
                        <th><?php echo $this->lang->line('date'); ?></th>
                        <th><?php echo $this->lang->line('filestatus'); ?></th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    if(isset($file_copies))

                        $i=1; foreach ($file_copies as $key => $files) {
                        $rrt_c = all_getfilesec_id_byfileid($files['file_id']);
                        ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $files['file_uo_or_letter_no']; ?></td>
                            <td><?php echo $files['file_subject']; ?>
                                <br><?php if(isset($files['scan_id']) && $files['scan_id'] != ''){ show_scan_file($files['scan_id']);}?>
                                <br><?php if(isset($files['file_status']) && $files['file_status'] != ''){ show_file_status($files['file_status']);}?>
                            </td>
                            <td><?php echo $files['file_description']; ?>
                                <br><?php if(isset($files['scan_id']) && $files['scan_id'] != ''){ show_scan_file($files['scan_id']);}?>
                            </td>
                            <td><?php echo date_format(date_create($files['file_uo_or_letter_date']), 'd/m/y'); ?></td>
                            <td><?php if($files['file_mark_section_id'] == '100'){
                                    echo "व्यक्तिगत (Personal)";
                                }else{
                                    echo   $sec_nm =  getSection($files['file_mark_section_id']);
                                }   ?></td>
                            <td><?php if($rrt_c){
                                    foreach($rrt_c as $rrt1_c){
                                        $sechi = explode('(',getSection($rrt1_c['section_id']));
                                        echo " ".$rrt1_c['section_number'] ." - <span>".$sechi['0']."</span> <br/> ";
                                    }}else{
                                    echo "N/A";
                                } ?></td>
                            <td>
                                <?php echo date_format(date_create($files['file_update_date']), 'd/m/y'); ?><br/>
                                (<?php if($files['file_hardcopy_status'] == 'not'){ echo $this->lang->line('mark_date');} else { echo $this->lang->line('received_date');} ?>)
                            </td>
                            <td><?php
                                $filereceiver = get_user_details($files['file_received_emp_id']);
                                if ($filereceiver)
                                {
                                    if($files['file_hardcopy_status'] == 'not') {
                                        echo file_not_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi);
                                    } else if($files['file_hardcopy_status'] == 'close') {
                                        echo file_closed_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi, $files['file_type']);
                                    } else  if($files['file_hardcopy_status'] == 'received') {
                                        echo file_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi);
                                    } else if($files['file_hardcopy_status'] == 'working'){
                                        echo file_working_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi);
                                    }
                                } ?></td>
                        </tr>
                        <?php $i++; } ?>

                    </tbody>
                </table>
            </div>
        </div><!-- /.box-body -->

    </div><!-- /.box -->
</div>


</div><!-- /.row -->
<!-- Main row -->
</section><!-- /.content -->
<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>

<script type="text/javascript">
    $("#file_mark_type").change(function () {
        var court_bench = $('#file_mark_type option:selected').val();
        var HTTP_PATH='<?php echo base_url(); ?>';
        if(court_bench == 1){
            $.ajax({
                type: "POST",
                url: HTTP_PATH + "view_file/section_all_nm",
                datatype: "json",
                async: false,
                //   data: {file_id: file_id},
                success: function(data) {
                    var r_data = JSON.parse(data);
                    var otpt1 = '<select name="section_ids" required="required" class="form-control">';
                    otpt1 += '<option value="">Select Section</option>';
                    $.each(r_data, function( index, value ) {
                        otpt1 += '<option value="'+value.section_id+'" >'+value.section_name_hi+'</option>';
                    });
                    otpt1 +='</select>';
                    $("#marked_perameter").html(otpt1);
                }
            });
        }else if(court_bench == 2){
            $.ajax({
                type: "POST",
                url: HTTP_PATH + "view_file/file_splitting/script_get_officers_list",
                datatype: "json",
                async: false,
                //   data: {file_id: file_id},
                success: function(data) {
                    var r_data = JSON.parse(data);
                    var otpt1 = '<select name="officer_ids" required="required" class="form-control">';
                    otpt1 += '<option value="">Select Officer</option>';
                    $.each(r_data, function( index, value ) {
                        otpt1 += '<option value="'+value.emp_id+'" >'+value.emp_full_name_hi+' ('+value.emprole_name_hi+')</option>';
                    });
                    otpt1 +='</select>';
                    $("#marked_perameter").html(otpt1);
                }
            });
        }else{
            var otpt1 = '<select name="" class="form-control">';
            otpt1 += '<option value="">Select type</option>';
            otpt1 +='</select>';
            $("#marked_perameter").html(otpt1);
        }


    });
</script>
