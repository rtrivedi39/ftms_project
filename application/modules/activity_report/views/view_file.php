<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo $title; ?>
        <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin'); ?>"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line('dashboard'); ?></a></li>
        <li><a href="<?php echo base_url('admin');?>/sections"><?php echo $this->lang->line('title'); ?></a></li>
        <li class="active"><?php echo $title_tab; ?></li>
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
        <div style="float:left"><h3 class="box-title"><?php echo $title_tab;?></h3>
        </div>
        <div style="float:right"><button class="btn btn-warning" onclick="goBack()"><?php echo $this->lang->line('Back_button_label'); ?></button>
        </div>

    </div><!-- /.box-header -->

    <div class="col-md-6"  style="margin-top: 15px;">
        <!-- general form elements -->
        <div class="box box-primary">
            <!-- form start -->
            <div class="box-header" align="center">
                <h4 class="box-title"><b>File Details</b></h4>
            </div>
            <div class="box-body" style="overflow: auto;height: 300px;">
                <div class="form-group">
                    <label for="exampleInputEmail1"><?php
                        echo   $file_details[0]['file_type'] == 'f' ? $this->lang->line('view_file_uo_number') : false;
                        echo   $file_details[0]['file_type'] == 'l' ?  $this->lang->line('label_letterno_number') : false;
                        echo   $file_details[0]['file_type'] == 'a' ? $this->lang->line('label_letterno_number') : false;
                        echo   $file_details[0]['file_type'] == 'r' ? $this->lang->line('label_registry_number') : false;
                        echo   $file_details[0]['file_type'] == 'o' ? $this->lang->line('label_letterno_number') : false; ?> : </label>
                    <?php echo (@$file_details[0]['file_uo_or_letter_no'] ? $file_details[0]['file_uo_or_letter_no'] : '' ); ?>
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1"><?php
                        echo   $file_details[0]['file_type'] == 'f' ? $this->lang->line('view_file_uo_date') : false;
                        echo   $file_details[0]['file_type'] == 'l' ?  $this->lang->line('label_letterno_date') : false;
                        echo   $file_details[0]['file_type'] == 'a' ? $this->lang->line('label_letterno_date') : false;
                        echo   $file_details[0]['file_type'] == 'r' ? $this->lang->line('label_registry_date') : false;
                        echo   $file_details[0]['file_type'] == 'o' ? $this->lang->line('label_letterno_date') : false; ?> : </label>
                    <?php  echo (@$file_details[0]['file_uo_or_letter_date'] ? date_format(date_create($file_details[0]['file_uo_or_letter_date']), 'd/m/y') : '' ); ?>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line('view_file_subject'); ?> : </label>
                    <?php echo (@$file_details[0]['file_subject'] ? $file_details[0]['file_subject'] : '' ); ?>
                </div>


                <div class="form-group">
                    <label for="exampleInputFile"><?php echo $this->lang->line('view_file_type'); ?> : </label>
                    <?php // echo (@$file_details[0]['file_type'] ? $file_details[0]['file_type'] : '' );
                    if(isset($file_details[0]['file_type'])) {
                        echo  getFileType($file_details[0]['file_type']); } ?>
                </div>

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

                <?php if($file_details[0]['file_department_id'] != '0' && $file_details[0]['file_department_id'] != null)  { ?>
                    <div class="form-group">
                        <label for="exampleInputFile">विभाग : </label>
                        <?php echo (@$file_details[0]['file_department_id'] ? $file_details[0]['file_department_id'] : '' ); ?>
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
                        <label for="exampleInputFile">Incoming  from  : </label>
                        <?php echo (@$file_details[0]['file_department_name'] ? $file_details[0]['file_department_name'] : '' ); ?>
                    </div>
                <?php } ?>
                <div class="form-group">
                    <label for="exampleInputFile"><?php echo $this->lang->line('file_received_by'); ?> : </label>
                    <?php echo (@$file_details[0]['emp_full_name'] ? $file_details[0]['emp_full_name'] : '' ); ?>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line('view_file_mark_section_id'); ?> : </label>
                    <?php echo (@$file_details[0]['section_name_hi'] ? $file_details[0]['section_name_hi'] : '' ); ?>,<?php echo (@$file_details[0]['section_name_en'] ? $file_details[0]['section_name_en'] : '' ); ?>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line('view_file_mark_section_date'); ?> : </label>
                    <?php echo (@$file_details[0]['file_mark_section_date'] ? date_format(date_create($file_details[0]['file_mark_section_date']), 'd/m/y') : '' ); ?>
                </div>

                <!--   <div class="form-group">
                                <label for="exampleInputFile"><?php echo $this->lang->line('view_file_level_id'); ?> : </label>
                                <?php echo (@$file_details[0]['file_level_id'] ? $file_details[0]['file_level_id'] : '' ); ?>
                            </div>-->

                <div class="form-group">
                    <label for="exampleInputFile"><?php echo $this->lang->line('view_file_progress_status'); ?> : </label>
                    <?php
                    $filereceiver = get_user_details($file_details[0]['file_received_emp_id']);
                    if ($filereceiver)
                    {
                        if($file_details[0]['file_hardcopy_status'] == 'not') {
                            echo "<span style='color:#dd4b39' >Not Received by <b> ".ucfirst($filereceiver[0]->emp_full_name)."</b> (".$filereceiver[0]->emprole_name_hi.")</span>";
                        } else {
                            echo "<span style='color:#00a65a' >Received by <b> ".ucfirst($filereceiver[0]->emp_full_name)."</b> (".$filereceiver[0]->emprole_name_hi.")</span>";
                        }  } ?>
                </div>

                <!--    <div class="form-group">
                                <label for="exampleInputFile"><?php echo $this->lang->line('view_file_is_locked'); ?> : </label>
                                <?php echo (@$file_details[0]['file_is_locked'] ? $file_details[0]['file_is_locked'] : '' ); ?>
                            </div> -->

            </div>
        </div><!-- /.box -->
    </div>
    <div class="col-md-6"  style="margin-top: 15px;">
        <div class="box box-primary">
            <div class="box-header" align="center">
                <h4 class="box-title"><b>File Movement</b></h4>
            </div>
            <!-- form start -->
            <div class="box-body"  style="overflow: auto;height: 300px;">
                <div class="form-group">
                    <table width="100%">
                        <tr align="center"><td><b>Date</b></td>
                            <td><b>From Officer</b></td>
                            <td><b>To Officer</b></td>
                            <td width="75px"><b>Flow</b></td>
                        </tr>
                        <?php foreach($file_movement as $row1){
                            if($row1['fmove_current_user_id'] != $row1['fmove_previous_user_id']){
                                $empnmto1 = get_user_details($row1['fmove_current_user_id']);
                                $empnmfrom1 = get_user_details($row1['fmove_previous_user_id'])
                                ?>
                                <tr align="center"><td><?php  echo date_format(date_create($row1['fmove_created_datetime']), 'd/m/y g:ia'); ?></td>
                                    <td><?php if(isset($empnmfrom1[0]->emp_full_name)) { echo  ucfirst($empnmfrom1[0]->emp_full_name)."<br/>(".$empnmfrom1[0]->emprole_name_hi.")"; } ?></td>
                                    <td><?php if (isset($empnmto1[0]->emp_full_name)) { echo  ucfirst($empnmto1[0]->emp_full_name)."<br/>(".$empnmto1[0]->emprole_name_hi.")"; } ?></td>
                                    <td>
                                        <?php echo $row1['file_return'] == '0' ? 'UP <i class="fa fa-fw fa-level-up"></i>' : false ; ?>
                                        <?php echo $row1['file_return'] == '1' ? 'DOWN <i class="fa fa-fw fa-level-down"></i>' : false ; ?>
                                    </td>
                                </tr>
                            <?php }} ?>
                    </table>

                </div>
            </div><!-- /.box-body -->

        </div><!-- /.box -->
    </div>

    <!-- general form elements -->
</div><!-- /.box-body -->
<div class="col-md-12">
    <div class="box box-warning">
        <div class="box-header" align="center">
            <h4 class="box-title"><b>File Log Details</b></h4>
        </div>
        <!-- form start -->
        <div class="box-body"  style="overflow: auto;height: 300px;">
            <div class="form-group">
                <table width="100%">
                    <tr>
                        <td><b>Date</b></td>
                        <td><b>Remark by officer</b></td>
                        <td><b>Carried by</b></td>
                        <td><b>File Log</b></td>
                        <td><b>Doc</b></td>
                    </tr>
                    <?php foreach($file_log as $row){
                        // if($row['to_emp_id'] != $row['from_emp_id']){
                        $empnmto = get_user_details($row['to_emp_id']);
                        $empnmfrom = get_user_details($row['from_emp_id'])
                        ?>
                        <tr>
                            <td><?php  echo date_format(date_create($row['flog_created_date']), 'd/m/y g:ia'); ?></td>
                            <td><?php echo @$row['flog_other_remark'] ? $row['flog_other_remark'] : 'No Remarks' ; ?></td>
                            <td><?php echo @$row['hardcopy_carry_empname'] ? $row['hardcopy_carry_empname'] : 'No Name' ; ?></td>
                            <td><?php
                                if($row['to_emp_id'] == $row['from_emp_id']){
                                    if (isset($empnmto[0]->emp_full_name)) {
                                        echo "File received by <b>" . ucfirst($empnmto[0]->emp_full_name) . "</b> (" . $empnmto[0]->emprole_name_hi . ")";
                                    }
                                } else {
                                    if (isset($empnmfrom[0]->emp_full_name)) {
                                        echo "<b>" . ucfirst($empnmfrom[0]->emp_full_name) . "</b> (" . $empnmfrom[0]->emprole_name_hi . ") marked file to ";
                                    }
                                    if (isset($empnmto[0]->emp_full_name)) {
                                        echo "<b>" . ucfirst($empnmto[0]->emp_full_name) . "</b> (" . $empnmto[0]->emprole_name_hi . ")";
                                    }
                                }
                                ?>
                            </td>
                            <td><?php echo $row['file_headerpath'];  ?></td>
                        </tr>

                        <?php //}
                    } ?>
                </table>

            </div>
        </div><!-- /.box-body -->

    </div><!-- /.box -->
</div>
</div><!-- /.box -->
</div>
</div><!-- /.row -->
<!-- Main row -->
</section><!-- /.content -->
<style type="text/css">
    #leave_employee_filter{
        clear: both;
    }
</style>
    