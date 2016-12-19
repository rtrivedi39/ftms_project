<?php $high_bench =  highcourt_bench(); ?>
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
                    <div style="float:left"><h3 class="box-title"><?php echo $title_tab;?></h3></div>
                    <div style="float:right">  <button class="btn btn-block btn-warning" title="Back" onclick="goBack()"><?php echo $this->lang->line('Back_button_label'); ?></button>
                    </div>

                </div><!-- /.box-header -->

                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary" style="margin-top: 15px;">
                        <!-- form start -->
                        <?php echo $this->session->flashdata('message'); ?>
						<?php //pre($file_details[0]['section_file_type']); ?>
                        <form role="form" method="post" action="<?php echo base_url()?>view_file/dealing_file/sent_to_da">
                            <input type="hidden" value="<?php echo (@$file_details[0]['file_id'] ? $file_details[0]['file_id'] : '' ); ?>"  name="file_id1" id="file_id1" class="form-control">

                            <div class="form-group" align="center">
                                <br/>
                                <label for="file_subject"><?php echo $this->lang->line('File_section_no'); ?> : </label>
                                <b style="color: #ff0000"><?php echo isset($file_details[0]['file_id']) ? getfilesec_id_byfileid($file_details[0]['file_id'] , $file_details[0]['file_mark_section_id']) : ''; ?></b>
                            </div>

                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputFile"> फाइल पर टीप जोड़ें </label>
                                    <textarea class="form-control"  name="file_remark" placeholder="Fill Remark Here"></textarea>
                                    <?php echo form_error('file_remark');?>
                                </div>
								<?php if($file_details[0]['file_mark_section_id']==2 || $file_details[0]['file_mark_section_id']==14){ ?>
                                <div class="form-group">
                                    <label for="exampleInputFile"><?php echo $this->lang->line('High_court_bench_view'); ?> <span class="text-danger">*</span></label>
                                    <select class="form-control" name="court_bench_byso" >
                                        <option value="">Select</option>
                                        <?php foreach(highcourt_bench() as $key => $value){
                                            echo '<option value="'.$key.'">'.$value.'</option>';
                                        } ?>
										<option value="sc">दिल्ली सुप्रीम कोर्ट </option>
                                    </select>
                                    <?php echo form_error('court_bench_byso');?>
                                </div>
								<?php } else if($file_details[0]['file_mark_section_id']==15){ ?>
								<div class="form-group">
                                    <label for="prosecution file type"><?php echo $this->lang->line('file_ka_prakar'); ?> <span class="text-danger">*</span></label>
									<select class="form-control" name="section_file_type">
										<option value=""><?php echo $this->lang->line('file_ka_prakar'); ?></option>
										<?php 
											$presecution_file_type= get_prosecution_file_type(); /*function define in common helper. Database filed name : section_file_type in ft_files */
											foreach($presecution_file_type as $pftype){ ?>
												<option value="<?php echo $pftype; ?>" <?php if($file_details[0]['section_file_type']==$pftype){ echo 'selected';} ?>><?php echo $pftype; ?></option>
									<?php } ?>
									</select>
                                    <?php echo form_error('section_file_type');?>
                                </div>
								<?php } ?>
                                <div class="form-group">
                                    <label for="exampleInputFile">सहायकों कें नाम <span class="text-danger">*</span></label>
                                    <select class="form-control" name="Da_name" >
                                        <option value="">सहायक का चयन करें</option>
                                        <?php foreach($dealing_name as $daname) { ?>
                                            <option value="<?php echo $daname['emp_id']; ?>"><?php echo getemployeeName($daname['emp_id'],true).'('.get_employee_role($daname['emp_id']).')'; ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php echo form_error('Da_name');?>
                                </div>
								<div class="form-group text-right">
                                        <input type="checkbox"  id="physical_file" name="physical_file" class="physical_file" value="P" checked disabled>Physical File 
										 <input type="hidden" name="physical_file"  value="p">
                                </div>
                                <span class="text-danger"><?php echo $this->lang->line('m_note'); ?></span>
                                <div class="box-footer">
                                    <button class="btn btn-success" type="submit">सहायक को भेंजें</button>
								    <button onclick="return confirm('Are you Sure to return this file to CR section');" type="submit" name="return_tocr" value="return_tocr" class="btn btn-default" data-toggle="tooltip" data-original-title="Only fill remark for return file">आवक शाखा में भेंजें</button>
                                    </div>
                            </div>
                        </form>
                        <!-- /.box-body -->

                    </div><!-- /.box -->
                </div>
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="box box-primary" style="margin-top: 15px;">
                        <!-- form start -->
                        <div class="box-body">
                            <div class="form-group" align="center">
                                <br/>
                            <b>Details</b>
                             </div>

                            <div class="form-group">
                                <label for="file_subject"><?php echo $this->lang->line('File_section_no'); ?> : </label>
                                <b style="color: #ff0000"><?php echo isset($file_details[0]['file_id']) ? getfilesec_id_byfileid($file_details[0]['file_id'] , $file_details[0]['file_mark_section_id']) : ''; ?></b>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('view_file_subject'); ?> : </label>
                                <?php echo (@$file_details[0]['file_subject'] ? $file_details[0]['file_subject'] : '' ); ?>
                            </div>

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
                                <?php echo (@$file_details[0]['file_uo_or_letter_date'] ? date_format(date_create($file_details[0]['file_uo_or_letter_date']), 'd/m/y') : '' ); ?>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputFile"><?php echo $this->lang->line('file_received_by'); ?> : </label>
                                <?php echo (@$file_details[0]['emp_full_name'] ? $file_details[0]['emp_full_name'] : '' ); ?>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputFile"><?php echo $this->lang->line('view_file_type'); ?> : </label>
                                <?php if(isset($file_details[0]['file_type'])) {
                                    if ($file_details[0]['file_type']== 'l') {
                                        echo 'LETTER';
                                    } else {
                                        echo 'FILE';
                                    } }  ?>
                            </div>
							<?php if(!empty($file_details[0]['old_registared_no']) )  { ?>
								<div class="form-group">
									<label for="exampleInputFile">पुराना रजिस्टर नंबर (ORN) : </label>
									<?php echo (@$file_details[0]['old_registared_no'] ? $file_details[0]['old_registared_no'] : '' ); ?>
								</div>
							<?php } ?>
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
                                    echo    $file_details[0]['file_Offer_by'] == 'o' ? $file_details[0]['file_department_name'] ." , ". (isset($file_details[0]['district_name_hi'])?$file_details[0]['district_name_hi']:'') : false;
                                } ?>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('view_file_mark_section_id'); ?> : </label>
                                <?php echo (@$file_details[0]['section_name_hi'] ? $file_details[0]['section_name_hi'] : '' ); ?>,<?php echo (@$file_details[0]['section_name_en'] ? $file_details[0]['section_name_en'] : '' ); ?>
                            </div>

                            <!--  <div class="form-group">
                            <label for="exampleInputPassword1"><?php echo $this->lang->line('view_file_linked_id'); ?> : </label>
                              <?php echo (@$file_details[0]['file_linked_id'] ? $file_details[0]['file_linked_id'] : '' ); ?>

                          </div>
                            <div class="form-group">
                                <label for="exampleInputFile"><?php echo $this->lang->line('view_file_progress_status'); ?> : </label>
                                <?php echo (@$file_details[0]['remark_title_hi'] ? $file_details[0]['remark_title_hi'] : '' ); ?>
                            </div>-->

                        </div><!-- /.box-body -->

                    </div><!-- /.box -->
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
    </div><!-- /.row -->
    <!-- Main row -->
</section><!-- /.content -->
    