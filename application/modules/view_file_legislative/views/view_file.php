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
<div class="box" id="divname">

    <div class="box-header">
        <div style="float:left"><h3 class="box-title"><?php echo $title_tab;?></h3>
        </div>
        <div style="float:right">
			<button onclick="printContents('divname')" class="btn btn-primary no-print">Print</button>
			<button class="btn btn-warning" onclick="goBack()"><?php echo $this->lang->line('Back_button_label'); ?></button>
        </div>
    </div><!-- /.box-header -->
<div class="box-body">
<div class="row">
    <div class="col-md-6"  style="margin-top: 15px;">
        <!-- general form elements -->
        <div class="box box-primary">
            <!-- form start -->
            <div class="box-header" align="center">
                <h4 class="box-title"><b>नस्ती की जानकारी</b>
				<span class="text-green">[<?php echo get_panji_no($file_details[0]['file_id'],$file_details[0]['file_mark_section_id'],$file_details[0]['file_created_date']); ?>]</span>
				</h4><br/>
                <?php if($file_details[0]['file_return'] == '2'){ ?>
                <span class="box-title text-red"><?php echo @$file_details[0]['file_return'] == '2' ? "नस्ती जावक शाखा में है|" : false ; ?></span>
            <?php } ?>
            </div>
            <?php if($file_details[0]['file_linked_id'] != '' &&  $file_details[0]['file_linked_id'] != 0) { ?>
                <div class="col-xs-12">
                        <label for="exampleInputEmail1">सम्बन्धित नस्ती  : </label>
                        <?php $file_links = explode(',',$file_details[0]['file_linked_id']);
                        foreach($file_links as $file_l){ ?>
                            <a href="<?php echo base_url();?>view_file/viewdetails/<?php echo $file_l ;?>"><button type="button" class="btn bg-light-blue btn-xs"><span class="fa fa-fw fa-link"></span> <?php echo "View File ". $file_l ?></button></a>

                        <?php } ?>
                </div>
            <?php } ?>
            <div class="box-body" style="overflow: auto;height: 300px;">
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

                <div class="form-group">
                    <label for="exampleInputPassword1"><?php
                        echo   $file_details[0]['file_type'] == 'f' ? $this->lang->line('view_file_uo_date') : false;
                        echo   $file_details[0]['file_type'] == 'l' ?  $this->lang->line('label_letterno_date') : false;
                        echo   $file_details[0]['file_type'] == 'a' ? $this->lang->line('label_letterno_date') : false;
                        echo   $file_details[0]['file_type'] == 'r' ? $this->lang->line('label_registry_date') : false;
                        echo   $file_details[0]['file_type'] == 'n' ? $this->lang->line('label_notice_date') : false;
                        echo   $file_details[0]['file_type'] == 'o' ? $this->lang->line('label_letterno_date') : false; ?> : </label>
                    <?php  echo (@$file_details[0]['file_uo_or_letter_date'] ? date_format(date_create($file_details[0]['file_uo_or_letter_date']), 'd/m/Y') : '' ); ?>
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
                        <label for="exampleInputFile">विभाग जहां से प्राप्त हुई : </label>
                        <?php echo (@$file_details[0]['file_department_name'] ? $file_details[0]['file_department_name'] : '' ); ?>
                    </div>
                <?php } ?>
                <div class="form-group">
                    <label for="exampleInputFile"><?php echo $this->lang->line('file_received_by'); ?> : </label>
                    <?php echo (@$file_details[0]['emp_full_name'] ? $file_details[0]['emp_full_name'] : '' ); ?>
                </div>
                <div class="form-group">
                    <label for="view_file_mark_section_id"><?php echo $this->lang->line('view_file_mark_section_id'); ?> : </label>
                    <?php echo (@$file_details[0]['section_name_hi'] ? $file_details[0]['section_name_hi'] : '' ); ?>,<?php echo (@$file_details[0]['section_name_en'] ? $file_details[0]['section_name_en'] : '' ); ?>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line('view_file_mark_section_date'); ?> : </label>
                    <?php echo (@$file_details[0]['file_mark_section_date'] ? date_format(date_create($file_details[0]['file_mark_section_date']), 'd/m/Y') : '' ); ?>
                </div>

                <!--new start-->
                <?php if($file_details[0]['case_parties'] != '' &&  $file_details[0]['case_parties'] != null) { ?>
                <div class="form-group">
                    <label for="exampleInputEmail1">पक्षकार/प्रतिवादी : </label>
                    <?php echo (@$file_details[0]['case_parties'] ? preg_replace('/[-]+/', ' ', trim($file_details[0]['case_parties'])) : '' ); ?>
                </div>
                <?php } ?>

                <?php if($file_details[0]['case_no'] != '' &&  $file_details[0]['case_no'] != null) { ?>
                <div class="form-group">
                    <label for="exampleInputEmail1">प्रकरण क्र.  : </label>
                    <?php echo (@$file_details[0]['case_no'] ? trim($file_details[0]['case_no']) : '' ); ?>
                </div>
                <?php } ?>


                <?php if($file_details[0]['courts_name_location'] != '' &&  $file_details[0]['courts_name_location'] != null) { ?>
                <div class="form-group">
                    <label for="exampleInputEmail1">न्यायालय जिसके आदेश के विरुद्ध अपील / याचिका की गयी  : </label>
                    <?php echo (@$file_details[0]['courts_name_location'] ? trim($file_details[0]['courts_name_location']) : '' ); ?>
                </div>
                <?php } ?>

                <?php if($file_details[0]['file_judgment_date'] != '' &&  $file_details[0]['file_judgment_date'] != null &&  $file_details[0]['file_judgment_date'] !=  '0000-00-00') { ?>
                <div class="form-group">
                    <label for="exampleInputEmail1">निर्णय /आदेश दिनांक  : </label>
                    <?php echo (@$file_details[0]['file_judgment_date'] ? date_format(date_create($file_details[0]['file_judgment_date']),'d/m/Y') : '' ); ?>
                </div>
                <?php } ?>
                <!--new end-->

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
							echo file_not_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi);
						} else if($file_details[0]['file_hardcopy_status'] == 'close') {
							echo file_closed_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi, $file_details[0]['file_type']);
						} else  if($file_details[0]['file_hardcopy_status'] == 'received') {
							echo file_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi);
						} else if($file_details[0]['file_hardcopy_status'] == 'working'){
							echo file_working_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi);
						}
                        /*if($file_details[0]['file_hardcopy_status'] == 'not') {
                            echo "<span style='color:#dd4b39' >Not Received by <b> ".$filereceiver[0]->emp_full_name_hi."</b> (".$filereceiver[0]->emprole_name_hi.")</span>";
                        } elseif($file_details[0]['file_hardcopy_status'] == 'received')  {
                            echo "<span style='color:#00a65a' >Received by <b> ".$filereceiver[0]->emp_full_name_hi."</b> (".$filereceiver[0]->emprole_name_hi.")</span>";
                        }elseif($file_details[0]['file_hardcopy_status'] == 'close')  {
                            echo "<span style='color:#ff0000' >Closed by <b> ".$filereceiver[0]->emp_full_name_hi."</b> (".$filereceiver[0]->emprole_name_hi.")</span>";
                        } elseif($file_details[0]['file_hardcopy_status'] == 'working')  {
                            echo "<span style='color:#00a65a' >Work in progress by <b> ".$filereceiver[0]->emp_full_name_hi."</b> (".$filereceiver[0]->emprole_name_hi.")</span>";
                        } */
					} ?>
                </div>


                <?php if($file_details[0]['file_upload'] != null && $file_details[0]['file_upload'] != ''){ ?>
                    <div class="form-group">
                        <label for="exampleInputFile">संलग्न दस्तावेज : </label>
                        <?php echo (@$file_details[0]['file_upload'] ? ' <a  data-toggle="tooltip" data-original-title="View Documents" href="'.base_url().'uploads/documents_file/'.$file_details[0]['file_upload'].'" target="_blank"><i class="fa fa-fw fa-download"></i> click here</a>' : '' ); ?>
                    </div>
                <?php } ?>
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
                <h4 class="box-title"><b>नस्ती का आवागमन</b></h4>
            </div>
            <!-- form start -->
            <div class="box-body"  style="overflow: auto;height: 300px;">
                <div class="form-group">
                    <table width="100%">
                        <tr align="center"><td><b>दिनांक</b></td>
                            <td><b>अधिकारी से</b></td>
                            <td><b>अधिकारी तक</b></td>
                            <td width="75px"><b>आवागमन</b></td>
                        </tr>
                        <?php foreach($file_movement as $row1){
                            if($row1['fmove_current_user_id'] != $row1['fmove_previous_user_id']){
                                $empnmto1 = get_user_details($row1['fmove_current_user_id']);
                                $empnmfrom1 = get_user_details($row1['fmove_previous_user_id'])
                                ?>
                                <tr align="center"><td><?php  echo date_format(date_create($row1['fmove_created_datetime']), 'd/m/Y g:ia'); ?></td>
                                    <td><?php if(isset($empnmfrom1[0]->emp_full_name_hi)) { echo  $empnmfrom1[0]->emp_full_name_hi."<br/>(".$empnmfrom1[0]->emprole_name_hi.")"; } ?></td>
                                    <td><?php if (isset($empnmto1[0]->emp_full_name_hi)) { echo  $empnmto1[0]->emp_full_name_hi."<br/>(".$empnmto1[0]->emprole_name_hi.")"; } ?></td>
                                    <td>
                                        <?php echo $row1['file_return'] == '0' ? 'ऊपर <i class="fa fa-fw fa-level-up"></i>' : false ; ?>
                                        <?php echo $row1['file_return'] == '1' ? 'नीचें <i class="fa fa-fw fa-level-down"></i>' : false ; ?>
                                        <?php echo $row1['file_return'] == '2' ? 'बंद <i class="fa fa-fw fa-external-link"></i>' : false ; ?>
                                     </td>
                                </tr>
                            <?php }} ?>
                    </table>

                </div>
            </div><!-- /.box-body -->

        </div><!-- /.box -->
    </div>
</div>
    <!-- general form elements -->
<hr class="clearfix"/>
<div class="row">
<div class="col-md-12">
    <div class="box box-warning">
        <div class="box-header" align="center">
            <h4 class="box-title"><b>नस्ती का सम्पूर्ण जानकारी</b></h4>
        </div>
        <!-- form start -->
        <div class="box-body"  style="overflow: auto;height: 300px;">
            <div class="form-group">
                <table width="100%">
                    <tr>
                        <td><b>दिनांक</b></td>
                        <td><b>कोई टिप</b></td>
                        <td><b>कोन लाया</b></td>
                        <td><b>क्या हुआ</b></td>
                        <td><b>दस्तावेज</b></td>
                    </tr>
                    <?php foreach($file_log as $row){
                        // if($row['to_emp_id'] != $row['from_emp_id']){
                        $empnmto = get_user_details($row['to_emp_id']);
                        $empnmfrom = get_user_details($row['from_emp_id'])
                        ?>
                        <tr>
                            <td><?php  echo date_format(date_create($row['flog_created_date']), 'd/m/Y g:ia'); ?></td>
                            <td><?php echo @$row['flog_other_remark'] ? $row['flog_other_remark'] : '-' ; ?></td>
                            <td><?php echo @$row['hardcopy_carry_empname'] ? $row['hardcopy_carry_empname'] : '-' ; ?></td>
                            <td><?php
                                if($row['to_emp_id'] == $row['from_emp_id']){
                                    if (isset($empnmto[0]->emp_full_name_hi)) {
                                        if(isset($row['fvlm_id']) && $row['fvlm_id'] == 1){
                                            echo "Dispatced by <b>" . $empnmto[0]->emp_full_name_hi . "</b> (" . $empnmto[0]->emprole_name_hi . ")";
                                        }else {
                                            echo "File is in progress by <b>" . $empnmto[0]->emp_full_name_hi . "</b> (" . $empnmto[0]->emprole_name_hi . ")";
                                        } }
                                } else {
                                    if (isset($empnmfrom[0]->emp_full_name_hi)) {
                                        echo "<b>" . $empnmfrom[0]->emp_full_name_hi. "</b> (" . $empnmfrom[0]->emprole_name_hi . ") marked file to ";
                                    }
                                    if (isset($empnmto[0]->emp_full_name_hi)) {
                                        echo "<b>" . $empnmto[0]->emp_full_name_hi. "</b> (" . $empnmto[0]->emprole_name_hi . ")";
                                    }
                                }
                                ?>
                            </td>
                            <td>
                                <?php if($row['notesheet_file_path'] != '') { ?>
                                <?php /* <a href="<?php echo base_url().'/uploads/notesheets/'.getSection($row['section_id'], true).'/'.$row['notesheet_file_path'];  ?>" target="_blank"><i class="fa fa-file-pdf-o text-red"></i> <i class="fa fa-cloud-download text-green"></i></a>*/ ?>
                                    <a href="<?php echo base_url().'/view_file/view_file/view_notesheet/'.$row['flog_id'];  ?>" target="_blank"><i class="fa fa-file-pdf-o text-red"></i> </a>
                                <?php } ?>
                            </td>
                        </tr>

                        <?php //}
                    } ?>
                </table>

            </div>
        </div><!-- /.box-body -->

    </div><!-- /.box -->
</div><!-- /.col-12 -->
</div><!-- /.row -->
</div><!-- /.box-body -->
</div><!-- /.box -->
</div><!-- /.col-12 -->
</div><!-- /.row -->
<!-- Main row -->
</section><!-- /.content -->
<style type="text/css">
    #leave_employee_filter{
        clear: both;
    }
</style>
