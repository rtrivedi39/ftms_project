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

    <div class="row" id="divname">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header no-print">
                    <h3 class="box-title"><?php echo $title_tab; ?></h3>
                    <div class="pull-right">
                        <button onclick="printContents('divname')" class="btn btn-primary no-print">Print</button>
                        <button class="btn btn-warning" title="Back" onclick="goBack()" style="float:right"><?php echo $this->lang->line('Back_button_label'); ?></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="col-md-12"> 
                        <form method="post" action="" class="no-print">
                            <div class="col-xs-3">
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-primary">Search By</button>
                                    </div>
                                    <select class="form-control" name="search_type" id="search_type">
                                        <option value="" >Select type</option>
                                        <?php foreach(file_searchtypes()  as $key => $value) { ?>
                                            <option value="<?php echo $key; ?>" <?php echo @$this->input->post('search_type') == $key ? "selected" : false?>><?php echo $value; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <?php echo form_error('search_type');?>
                            </div>

						<div class="col-xs-3" id="dis4" <?php echo @$this->input->post('search_type') == '1' ? "style='display: block'" : "style='display: none'"?>>
							<select name="sections" class="form-control">
								<option value="">Select</option>
								<?php $empssection = empdetails(emp_session_id());
								foreach(explode(",",$empssection[0]['emp_section_id'])  as $empsec){ ?>
									<option value="<?php echo $empsec ?>" <?php echo @$this->input->post('sections') == $empsec ? "selected" : false?>><?php echo getSection($empsec) ; ?></option>
								<?php  }?>
							</select>
							<?php echo form_error('sections');?>
						</div>


                            <div class="col-xs-3" id="dis1" <?php echo @$this->input->post('search_type') != '5' && $this->input->post('search_type') != '9' && $this->input->post('search_type') != '10' && $this->input->post('search_type') != '7' && $this->input->post('search_type') != '4' ? "style='display: block'" : "style='display: none'"?>>
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

                            <!--Search datewise with filter-->
                            <div  class="show_search_dt_filter no-print" <?php echo @$this->input->post('search_type') == '10' ? "style='display: block'" : "style='display: none'"?>>
                                <div class="col-xs-2">
                                    <select id="filter_section_emp_wise"  name="filter_section_emp_wise" class="form-control rmv_required">
                                        <option value="">Select Filter</option>
                                            <option value="emp">Employees</option>
                                            <option value="sec">Section</option>
                                    </select>
                                    <?php echo form_error('filter_section_emp_wise  ');?>
                                </div>
                                <div class="col-xs-2">
                                    <select id="section_emp_list" name="empid_secid" class="form-control rmv_required" >
                                        <option value="">Select employee/Section</option>
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
                            <!--Search datewise with filter-->

                            <div class="col-xs-1">
                                <button type="submit" class="btn btn-success">Search</button>
                            </div>
                            <div class="col-xs-12">
                                <p>&nbsp;</p><br/>
                                <div style="clear:both">Note : All fields are required *</div>
                            </div>

                        </form>
                    </div>

                    <?php
                    if(isset($get_files)){ 
                        if(!empty($get_files)) { ?>
                            <div class="col-md-12" style="overflow: auto">
                                <?php if(count(@$get_files)>0){ ?>
                            <div style="float:right">Total Number of Files: <b><?php echo count($get_files);?></b></div>
                        <?php } ?>
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th class="no-print"><?php echo $this->lang->line('sno'); ?></th>
										<th><?php echo $this->lang->line('section_no1'); ?> जावक</th>
                                        <th><?php echo $this->lang->line('view_file_subject'); ?></th>
                                         <th><?php echo $this->lang->line('section_no1'); ?> शाखा</th>
										 <th><?php echo $this->lang->line('view_mark_section'); ?></th>
                                        <th><?php echo $this->lang->line('uo/letter_no'); ?></th>
                                        <th><?php echo $this->lang->line('view_file_uo_letter_date'); ?></th>
                                        <th>विभाग</th>
										<th class="no-print"><?php echo $this->lang->line('date'); ?></th>
                                        <th class="no-print"><?php echo $this->lang->line('filestatus'); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php  
                                    $i=1; foreach ($get_files as $key => $files) { 									
                                        if(is_array($files)){
                                           foreach ($files as $key1 => $file) {  
										    
										   ?>
                                            <tr onClick="showcomp(<?php echo $file->file_id; ; ?>)" style="cursor:pointer"; data-toggle="tooltip" data-original-title="View file">
                            <td class="no-print"><?php echo $i;?> (<?php echo $this->lang->line('file_no'); ?> : <?php echo $file->file_id;?>)</td>
							 <td><b><?php if(isset($file->file_id) ){							
								 echo getfilesec_id_byfileid($file->file_id, '8',$file->file_type) != '' ? getfilesec_id_byfileid($file->file_id, '8',$file->file_type) : 'N/a' ; }
								 else { echo 'N/a'; }?><b></td>
							
                            <td><?php echo $file->file_subject;?></td>
                            <td><?php echo getfilesec_id_byfileid($file->file_id,$file->file_mark_section_id,$file->file_type); ?></td>
							<td><?php echo getSection($file->file_mark_section_id); ?></td>
								
                            <td><?php echo $file->file_uo_or_letter_no; ?> (<?php echo getFileType($file->file_type) ;?>)</td>                           
                          <td><?php echo date_format(date_create($file->file_uo_or_letter_date), 'd/m/y'); ?></td>
                            
					    <td><?php 
						$file_from = file_from_type();
						$high_bench =  highcourt_bench();						
						if(isset($file->file_Offer_by)){
						
						echo   $file->file_Offer_by == 'c' || $file->file_Offer_by == 'jvn' ? (isset( $file_from[$file->file_Offer_by] )? $file_from[$file->file_Offer_by] :'')." , ". (isset($file->district_name_hi)?$file->district_name_hi:'') : false ;
						echo   $file->file_Offer_by == 'm' || $file->file_Offer_by == 'u' ? (isset($file_from[$file->file_Offer_by])?$file_from[$file->file_Offer_by]:'') ." , ". (isset($high_bench[$file->court_bench_id])?$high_bench[$file->court_bench_id]:'') : false ;
						echo   $file->file_Offer_by == 'sc' ? (isset($file_from[$file->file_Offer_by])?$file_from[$files->file_Offer_by]:'') ." , Delhi , दिल्ली" : false ;
						echo   $file->file_Offer_by == 'v' || (isset($file->dept_name_hi)?$file->dept_name_hi:'') ? (isset($file_from[$file->file_Offer_by])?$file_from[$file->file_Offer_by]:'') ." , ". (isset($file->dept_name_hi)?$file->dept_name_hi:'') ." ".(isset($file->file_department_name)?$file->file_department_name:'') : (isset($file->file_department_name)?$file->file_department_name:'');
						}	?>
						</td> 
							<td class="no-print"><?php echo date_format(date_create($file->file_update_date), 'd/m/y'); ?>
                               (<?php if($file->file_hardcopy_status == 'not'){ echo $this->lang->line('mark_date');} else { echo $this->lang->line('received_date');} ?>)
                           </td >
                            <td class="no-print"><?php							
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
							
                        </tr>
                                          <?php }
                                        } else {?>
                            <tr onClick="showcomp(<?php echo $files->file_id; ; ?>)" style="cursor:pointer"; data-toggle="tooltip" data-original-title="View Files">
                            <td class="no-print"><?php echo $i;?> (<?php echo $this->lang->line('file_no'); ?> : <?php echo $files->file_id;?>)</td>
                            <td><b><?php echo @getfilesec_id_byfileid($files->file_id,'8',$files->file_type) ? getfilesec_id_byfileid($files->file_id,'8',$files->file_type) : 'N/a' ;?><b></td>
								<td><?php echo $files->file_subject;?></td>
                            <td><?php echo getfilesec_id_byfileid($files->file_id,$files->file_mark_section_id,$files->file_type); ?></td>
								
								<td><?php echo getSection($files->file_mark_section_id); ?></td>
                            <td><?php echo $files->file_uo_or_letter_no; ?> (<?php echo getFileType($files->file_type) ;?>)</td>
                            <td><?php echo date_format(date_create($files->file_uo_or_letter_date), 'd/m/y'); ?></td>
                            
                           <td><?php 
						$file_from = file_from_type();
						$high_bench =  highcourt_bench();
						
						if(isset($files->file_Offer_by)){
						
						echo   $files->file_Offer_by == 'c' || $files->file_Offer_by == 'jvn' ? (isset( $file_from[$files->file_Offer_by] )? $file_from[$files->file_Offer_by] :'')." , ". (isset($files->district_name_hi)?$files->district_name_hi:'') : false ;
						echo   $files->file_Offer_by == 'm' || $files->file_Offer_by == 'u' ? (isset($file_from[$files->file_Offer_by])?$file_from[$files->file_Offer_by]:'') ." , ". (isset($high_bench[$files->court_bench_id])?$high_bench[$files->court_bench_id]:'') : false ;
						echo   $files->file_Offer_by == 'sc' ? (isset($file_from[$files->file_Offer_by])?$file_from[$files->file_Offer_by]:'') ." , Delhi , दिल्ली" : false ;
						echo   $files->file_Offer_by == 'v' || (isset($files->dept_name_hi)?$files->dept_name_hi:'') ? (isset($file_from[$files->file_Offer_by])?$file_from[$files->file_Offer_by]:'') ." , ". (isset($files->dept_name_hi)?$files->dept_name_hi:'') ." ".(isset($files->file_department_name)?$files->file_department_name:'') : (isset($files->file_department_name)?$files->file_department_name:'');
						}	?>
						</td> 
                           <td class="no-print"><?php echo date_format(date_create($files->file_update_date), 'd/m/y'); ?>
                               (<?php if($files->file_hardcopy_status == 'not'){ echo $this->lang->line('mark_date');} else { echo $this->lang->line('received_date');} ?>)
                           </td>
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
                        </tr>
                        <?php } $i++; } ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php } else{
                            echo "<div align='center' class='text-danger'><b>No Data available Plz Try Again..</b></div>";
                        }} ?>
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
		$('.rmv_required').prop('required', false);
        if($typeval == '4'){
            $("#dis1,#dis3,#dis4").hide();
            $("#dis2").show();
            $(".show_case,.show_search_dt_filter").hide();
            $(".show_movement_dt").hide();
        }else if($typeval == '5'){
            $("#dis3").show();
            $("#dis2,#dis1,#dis4").hide();
            $(".show_case,.show_search_dt_filter").hide();
            $(".show_movement_dt").hide();
        }else if($typeval == '1'){
            $("#dis4,#dis1").show();
            $("#dis2,#dis3").hide();
            $(".show_case,.show_search_dt_filter").hide();
            $(".show_movement_dt").hide();
        }else if($typeval == '7'){
            $(".show_case").show();
            $("#dis4,#dis1").hide();
            $("#dis2,#dis3").hide();
            $(".show_movement_dt,.show_search_dt_filter").hide();
        }else if($typeval == '9'){
            $(".show_movement_dt").show();
            $(".show_case,.show_search_dt_filter").hide();
            $("#dis4,#dis1").hide();
            $("#dis2,#dis3").hide();
        }else if($typeval == '10'){
            $(".show_search_dt_filter").show();
            $(".show_movement_dt").hide();
            $(".show_case").hide();
            $("#dis4,#dis1").hide();
            $("#dis2,#dis3").hide();
			$('.rmv_required').prop('required', true);
        } else{
            $("#dis1").show();
            $("#dis2,#dis3,#dis4").hide();
            $(".show_case,.show_search_dt_filter").hide();
            $(".show_movement_dt").hide();
        }
    });
    function showcomp(comp1)
    {
        window.location='<?php echo base_url();?>view_file/viewdetails/'+comp1;
    }
</script>
