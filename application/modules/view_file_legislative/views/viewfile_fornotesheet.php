<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo $title; $emp_session_id = emp_session_id(); $getEmployeeSection=getEmployeeSection();?>
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
            <div class="box" id="divname">
                <div class="box-header">
                    <div style="float:left"><h3 class="box-title"><?php echo $title_tab;?></h3></div>
                    <div style="float:right">
                        <!--<button class="btn btn-block btn-info"><?php echo $this->lang->line('view_file_mark');?></button>-->
						<button onclick="printContents('divname')" class="btn btn-primary no-print">Print</button>
                        <button class="btn btn-warning" onclick="goBack()" data-toggle="tooltip" data-original-title="Back"><?php echo $this->lang->line('Back_button_label'); ?></button>
                    </div>
                </div><!-- /.box-header -->
				<div class="box-body">                
                <?php if($this->session->flashdata('message') || $this->session->flashdata('error')) {
                    $msg = $this->session->flashdata('message') ? 'success' : 'danger';
                    ?>
                    <div class="alert alert-<?php echo $msg; ?> alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <?php  echo $this->session->flashdata('message');
                            echo $this->session->flashdata('error'); ?>
                        <br/>
                    </div>
                <?php }?>
                <table id="view_table" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th><?php echo $this->lang->line('sno'); ?></th>
						<th><?php echo $this->lang->line('section_no1'); ?></th>
                        <th><?php echo $this->lang->line('view_file_subject'); ?></th>
                        <th><?php echo $this->lang->line('uo/letter_no'); ?></th>
                        <th><?php echo $this->lang->line('view_file_uo_letter_date'); ?></th>                        
                        <th><?php echo $this->lang->line('view_file_mark_section_id'); ?></th>
                        <th>विभाग</th>
                        <th><?php echo $this->lang->line('date'); ?></th>
                        <th><?php echo $this->lang->line('filestatus'); ?></th>
                        <th><?php echo $this->lang->line('actions'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 	$section_exp_emp = explode(',',$getEmployeeSection);
							$i=1; 
							foreach ($get_files as $key => $files) {?>
                        <tr>
                            <td><?php echo $i;?> (<?php echo $this->lang->line('file_no'); ?> : <?php echo $files->file_id;?>)
								  <br><?php if(isset($files->file_status) && $files->file_status != ''){ show_file_status($files->file_status);}?>
							</td>
							<td><a href="<?php echo base_url()."view_file/viewdetails/".$files->file_id ;?>" data-toggle="tooltip" data-original-title="View details">
								<?php echo getfilesec_id_byfileid($files->file_id,$files->file_mark_section_id,$files->file_type);?>
								</a>
							</td>
                            <td><?php echo $files->file_subject;?></td>
                            <td><?php echo $files->file_uo_or_letter_no; ?> (<?php echo getFileType($files->file_type) ;?>)</td>
                            <td><?php echo date_format(date_create($files->file_uo_or_letter_date), 'd/m/y'); ?></td>
                            
                            <td><?php echo getSection($files->file_mark_section_id); ?></td>
                            <td><?php 
							$file_from = file_from_type();
                            $high_bench =  highcourt_bench();
							echo   $files->file_Offer_by == 'c' || $files->file_Offer_by == 'jvn' ? $file_from[$files->file_Offer_by] ." , ". $files->district_name_hi : false ;
							echo    $files->file_Offer_by == 'm' || $files->file_Offer_by == 'u' ? $file_from[$files->file_Offer_by] ." , ". $high_bench[$files->court_bench_id] : false ;
							echo    $files->file_Offer_by == 'sc' ? $file_from[$files->file_Offer_by] ." , Delhi , दिल्ली" : false ;
							echo    $files->file_Offer_by == 'v' || $files->dept_name_hi ? $file_from[$files->file_Offer_by] ." , ". $files->dept_name_hi ." ".$files->file_department_name : $files->file_department_name;
							?>
                            </td>
                            <td><?php echo date_format(date_create($files->file_update_date), 'd/m/y'); ?>
                                (<?php if($files->file_hardcopy_status == 'not'){ echo $this->lang->line('mark_date');} else { echo $this->lang->line('received_date');} ?>)
                            </td>
                            <td><?php
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
									if($files->multi_user_receiver_id !=null){
                                    $multi_rece = explode(',',$files->multi_user_receiver_id);
                                    if($files->multi_user_receiver_id != null && $files->multi_user_receiver_id != '' && in_array($files->file_received_emp_id,$multi_rece)){                                               echo " तथा ";

                                        foreach($multi_rece as $multi) {
                                            if ($multi != $files->file_received_emp_id) {
                                                $multi_nm = getemployeeName($multi);
                                echo $multi_nm;
                                                echo " , ";
                                            }
                                        }
                                        echo " को अंकित की गई है |";
                                    }
                                    }
									?>
								</td>
                                <td width="100px" >
                                    <?php $senderemp = empdetails($files->file_received_emp_id);
									$multi_nm = explode(',',$files->multi_user_receiver_id);                                    
                                    if($senderemp[0]['role_id'] == '8' || $senderemp[0]['role_id'] == '37' || $senderemp[0]['role_id'] == '14'){
										//pre($section_exp_emp);
										if(in_array(27,$section_exp_emp)){
											echo   $files->file_hardcopy_status == 'working' && ($emp_session_id == $files->file_received_emp_id) ? '<button onclick="open_model6('.$files->file_id.',&#39;'.$files->file_status.'&#39;)" class="btn btn-sm btn-twitter btn-block rty6" value="'.$files->file_id.'" data-toggle="tooltip" data-original-title="Mark to Translator">अन्य सहायक को अंकित करें</button>' : false;
										}
                                        if(in_array('19',$section_exp_emp)){}else{
											echo   $files->file_hardcopy_status == 'working' && ($emp_session_id == $files->file_received_emp_id || in_array($emp_session_id,$multi_nm)) && $files->file_level_id != '31' ? '<button onclick="open_model2('.$files->file_id.',&#39;'.$files->file_status.'&#39;)" value="'.$files->file_id.'"  class="btn btn-sm btn-block btn-twitter upperuser" data-toggle="tooltip" data-original-title="Send to officer">अधिकारी को भेजें</button> ' : false;
										}
                                    
									}else{
                                        echo   $files->file_hardcopy_status != 'not' && ($emp_session_id == $files->file_received_emp_id || in_array($emp_session_id,$multi_nm)) && $files->file_return != '1'  ? '<a href="'.base_url().'manage_file/dealing_manage_files/return_file_so/'.$files->file_id.'" onclick="return confirm_send()" class="btn btn-block btn-sm btn-success" data-toggle="tooltip" data-original-title="Send to SO">एस. ओ. को भेंजे</a>' : false;
                                        echo   $files->file_hardcopy_status != 'not' && ($emp_session_id == $files->file_received_emp_id || in_array($emp_session_id,$multi_nm)) && $files->file_return == '1' ? '<a href="'.base_url().'manage_file/dealing_manage_files/return_file_so/'.$files->file_id.'/2" onclick="return confirm_send()" class="btn btn-block btn-sm btn-success" data-toggle="tooltip" data-original-title="Send to SO">एस. ओ. को भेंजे</a>' : false;
                                    //    echo   $files->file_hardcopy_status == 'working' && checkUserrole() == '19' && (emp_session_id() == $files->file_received_emp_id || in_array(emp_session_id(),$multi_nm)) ? '<button onclick="open_model6('.$files->file_id.')" class="btn btn-sm btn-twitter btn-block rty6" value="'.$files->file_id.'" data-toggle="tooltip" data-original-title="Mark to Translator">अन्य सहायक को अंकित करें</button>' : false;
                                    }
                                    if(in_array('19',$section_exp_emp)) {
                                        echo $files->file_hardcopy_status == 'working' && ($emp_session_id == $files->file_received_emp_id || in_array($emp_session_id, $multi_nm)) && $files->file_level_id != '31' ? '<button onclick="open_model2(' . $files->file_id . ',&#39;' . $files->file_status . '&#39;)" value="' . $files->file_id . '"  class="btn btn-sm btn-block btn-twitter upperuser" data-toggle="tooltip" data-original-title="Send to officer">अधिकारी को भेजें</button> ' : false;
                                        echo $files->file_hardcopy_status != 'not' && $emp_session_id == $files->file_received_emp_id   ? '<button onclick="open_model_dispose('.$files->file_id.')" class="btn btn-sm btn-block btn-danger" value="'.$files->file_id.'" data-toggle="tooltip" data-original-title="Dispose in section"><i class="fa fa-sort-down"></i> शाखा में Dispose</button> ' : false;
                                    }
									echo   $files->file_hardcopy_status == 'working' && $files->file_mark_section_id == '20' && ($emp_session_id == $files->file_received_emp_id || in_array($emp_session_id,$multi_nm)) ? '<button onclick="open_model6('.$files->file_id.',&#39;'.$files->file_status.'&#39;)" class="btn btn-sm btn-twitter btn-block rty6" value="'.$files->file_id.'" data-toggle="tooltip" data-original-title="Mark to Translator">अन्य सहायक को अंकित करें</button>' : false;
                                    echo   ($files->file_hardcopy_status == 'working' || $files->file_hardcopy_status == 'received' ) && ($emp_session_id == $files->file_received_emp_id || in_array($emp_session_id,$multi_nm)) ? '<a onclick="return confirm_send()" href="'.base_url().'manage_file/dispatch_file_byso/'.$files->file_id.'" class="btn btn-block btn-sm btn-instagram rty1" value="'.$files->file_id.'" data-toggle="tooltip" data-original-title="Send to Dispatch">जावक शाखा में भेजें</a> ' : false;
									echo   $files->file_hardcopy_status == 'working' && ($emp_session_id == $files->file_received_emp_id || in_array($emp_session_id,$multi_nm)) && $this->uri->segment(3) != '' ? '<button onclick="section_section_da('.$files->file_id.')" value="'.$files->file_id.'"  class="btn btn-sm btn-block btn-twitter sections_nm" data-toggle="tooltip" data-original-title="Section to Section movement">Section to Section</button> ' : false;
									echo   ($files->file_hardcopy_status == 'working' || $files->file_hardcopy_status == 'received' ) && $emp_session_id == $files->file_received_emp_id ? '<button type="button" class="btn btn-sm btn-primary btn-block remarkbtn_model" data-file_id="'.$files->file_id.'" data-toggle="modal" data-target="#remarkmodel_all_section" data-toggle="tooltip" data-original-title="Add to remark">रिमार्क जोड़े</button> ' : false;
                                    ?>
                                </td>
                            </tr>
                            <?php $i++; } ?>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div><!-- /.row -->
    <!-- Main row -->
</section><!-- /.content -->

<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script type="text/javascript">
    $(function () {
	/*sent to other section*/
        $(".sections_nm").click(function () {
            var file_id = $(this).val();
            var HTTP_PATH='<?php echo base_url(); ?>';
            $.ajax({
                type: "POST",
                url: HTTP_PATH + "view_file_legislative/section_off_nm/"+file_id,
                datatype: "json",
                async: false,
                data: {file_id: file_id},
                success: function(data) {
                    var r_data = JSON.parse(data);
                    var otpt1 = '<select class="form-control" name="section_mark">';
                    $.each(r_data, function( index, value ) {
                        otpt1 += '<option value="'+value.section_id+'">'+value.section_name_hi+' ('+value.section_name_en+')</option>';
                    });
                    otpt1 += '</select>';
                    $(".emp_byfile2").html(otpt1);
                }
            });
        });
        $(".upperuser").click(function () {
            var file_id = $(this).val();
            var HTTP_PATH='<?php echo base_url(); ?>';
            $.ajax({
                type: "POST",
                url: HTTP_PATH + "view_file_legislative/upper_role_officer/"+file_id,
                datatype: "json",
                async: false,
                data: {file_id: file_id},
                success: function(data) {
                    var r_data = JSON.parse(data);
                    var otpt1 = '<select class="form-control" name="emp_id2">';
                    $.each(r_data, function( index, value ) {
						if(value.emp_detail_gender=='m'){
								var fword_en='Shri';
								var fword_hi='श्री';

						}else if(value.emp_detail_gender=='f'){
								var fword_en='shushri';
								var fword_hi='सुश्री';
						}
                        otpt1 += '<option value="'+value.emp_id+'">'+fword_hi+' '+value.emp_full_name_hi+' ('+value.emprole_name_hi+')</option>';
                    });
                    otpt1 += '</select>';
                    $(".emp_byfile2").html(otpt1);
                }
            });
        });

        
        $(".rty6").click(function () {
            var file_id = $(this).val();
            var HTTP_PATH='<?php echo base_url(); ?>';
            $.ajax({
                type: "POST",
                url: HTTP_PATH + "view_file_legislative/section_da_name",
                datatype: "json",
                async: false,
                data: {file_id: file_id},
                success: function(data) {
                    var r_data = JSON.parse(data);
                    var otpt = '<select class="form-control" name="Da_name" required=""><option value="">सहायको का चयन करें</option> ';
                    $.each(r_data, function( index, value ) {
						if(value.emp_detail_gender=='m'){
								var fword_en='Shri';
								var fword_hi='श्री';

						}else if(value.emp_detail_gender=='f'){
								var fword_en='shushri';
								var fword_hi='सुश्री';
						}
                        var session2 = <?php echo $emp_session_id ?>;
                        if(value.role_id != 14 && value.role_id != 8 && value.role_id != 37 && session2 != value.emp_id) {
                            otpt += '<option value="' + value.emp_id + '">'+fword_hi+' '+value.emp_full_name_hi+'</option>';
                        }
						
                    });
                    otpt += '</select>';
                    $("#emp_byfile5").html(otpt);
                }
            });
        });
    });
    function open_model2(file,file_status){
        var file2 = file;
		 check_file_status(file_status);
        $('#modal-id2').val(file2);
        $('#modal-send_upper').modal('show');
    }
    function open_model6(file,file_status){
        var file6 = file;
		 check_file_status(file_status);
        $('#modal-id5').val(file6);
        $('#modal-return_da_file').modal('show');
    }
	function section_section_da(file){
        var filess = file;
		
        $('#form_submit_link').attr('action','<?php echo base_url() ;?>manage_file_legislative/section_to_section/'+filess);
        $('#modal_send_upper_incharge').modal('show');
    }
	 function check_file_status( file_status )
    {
        $(".physical_file").prop( "checked", false );
        $(".electronic_file").prop( "checked", false );
        $(".electronic_file").prop( "disabled", false );
        $(".physical_file").prop( "disabled", false );

        var efile = "<?php echo $this->uri->segment(1)?>";
        if(efile != 'e-files' && efile != 'efile'){
            $(".physical_file").prop( "checked", true );
            $(".physical_file").prop( "disabled", true );
            $(".electronic_file").prop( "disabled", true );
            $(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="p"  >');
        }
        else{
            if(file_status == 'p'){
            $(".physical_file").prop( "checked", true );
             
             $(".physical_file").prop( "disabled", true );
             $(".electronic_file").prop( "disabled", true );
             $(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="p">');
            }
            else if(file_status == 'e'){
            $(".electronic_file").prop( "checked", true );
            $(".electronic_file").prop( "disabled", true );
            $(".physical_file").prop( "disabled", true );
            $(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="e">');
            }
            else if(file_status == 'p,e'|| file_status == 'e,p'){
                $(".physical_file").prop( "checked", true );
                $(".electronic_file").prop( "checked", true );
                $(".electronic_file").prop( "disabled", true );
                $(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="e">');
            }
            else{
                $(".electronic_file").prop( "checked", true );
                $(".electronic_file").prop( "disabled", true );
                $(".physical_file").prop( "disabled", true );
                $(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="e">');
            }
        }
        if(efile == 'efile' || efile == 'e-files'){
            getphysical_file_from_log(file,file_status);  
        }

    }
    function open_model_dispose(file){
        var file_dis = file;
        $('#modal-dis').val(file_dis);
        $('#modal-dispose_file').modal('show');
    }
</script>
<!--raginee-->
<div class="modal fade" id="modal_send_upper_incharge" data-backdrop="static">
    <div class="modal-dialog">
        <!--- <form action="<?php echo base_url() ;?>manage_file_legislative/Sendfile_upperofficer" method="post" >-->
        <form method="post" id="form_submit_link">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-edit"></i> टिप लिखें </h4>
                </div>
                <div class="modal-body">
                    <div class="box-body table-responsive">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <!--  <input type="text" id="modal-id2" name="fileids2">-->
                                    <textarea class="form-control" rows="3" placeholder="Enter ..." id="modal-id" name="rmk1"></textarea>
                                    <br/>
                                    <div class="emp_byfile2"></div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i>रद्द करें</button>
                    <button id="btn-delete" onclick="return confirm_send()" type="submit" class="btn btn-primary"><i class="fa fa-check"></i>भेजें</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!--End-->
<!--raginee-->
<div class="modal fade" id="modal-send_upper" data-backdrop="static">
    <div class="modal-dialog">
        <form action="<?php echo base_url() ;?>manage_file/Sendfile_upperofficer" method="post" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-edit"></i> टिप लिखें </h4>
                </div>
                <div class="modal-body">
                    <div class="box-body table-responsive">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <input type="hidden" id="modal-id2" name="fileids2">
                                    <textarea class="form-control" rows="3" placeholder="Enter ..." id="modal-id" name="rmk1"></textarea>
                                    <br/>
                                    <div class="emp_byfile2"></div>
									 <div class="form-group checkbox pull-right">
                                        <label>
                                          <input type="checkbox" id="physical_file_1" name="file_status[]" class="form-group physical_file" value="p" >Physical File
                                        </label>
                                        <label>
                                        <input type="checkbox" id="electronic_file_1" name="file_status[]" value="e" class="form-group electronic_file">E-File

                                        </label>
                                      </div>
                                        <div class="efile_div"></div>
									</div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i>रद्द करें</button>
                    <button id="btn-delete" onclick="return confirm_send()" type="submit" class="btn btn-primary"><i class="fa fa-check"></i>भेजें</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!--End-->
<!--return file mark to da-->
<div class="modal fade" id="modal-return_da_file" data-backdrop="static">
    <div class="modal-dialog">
        <form role="form" method="post" action="<?php echo base_url()?>view_file_legislative/dealing_file/sent_to_da">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-edit"></i>टिप लिखें </h4>
                </div>
                <div class="modal-body">
                    <div class="box-body table-responsive">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <input type="hidden" id="modal-id5" name="file_id1">
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" rows="3" placeholder="Enter ..." id="modal-id" name="file_remark"></textarea>
                                    </div>

                                    <?php   $section_exp1 = explode(',',$getEmployeeSection);
                                    $section_11 = array('2','10','14');
                                    if(array_intersect($section_exp1, $section_11)){
                                        ?>
                                        <div class="form-group">
                                            <select class="form-control" name="court_bench_byso" required="required">
                                                <option value="">Select</option>
                                                <?php foreach(highcourt_bench() as $key => $value){
                                                    echo '<option value="'.$key.'">'.$value.'</option>';
                                                } ?>
                                            </select>
                                        </div>
                                    <?php } ?>
                                    <div id="emp_byfile5"></div>
									  <div class="form-group checkbox pull-right">
                                        <label>
                                          <input type="checkbox" id="physical_file_1" name="file_status[]" class="form-group physical_file" value="p" >Physical File
                                        </label>
                                        <label>
                                        <input type="checkbox" id="electronic_file_1" name="file_status[]" value="e" class="form-group electronic_file">E-File

                                        </label>
                                      </div>
                                        <div class="efile_div"></div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i>Cancel</button>
                    <button id="btn-delete" onclick="return confirm_send()" type="submit" class="btn btn-primary"><i class="fa fa-check"></i>Send</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Model for dispose file in section -->
<div class="modal fade" id="modal-dispose_file" data-backdrop="static">
    <div class="modal-dialog">
        <form action="<?php echo base_url() ;?>manage_file/dispatch_for_close_byso" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-edit"></i> Enter Remark </h4>
                </div>
                <div class="modal-body">
                    <div class="box-body table-responsive">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <input type="hidden" id="modal-dis" name="filedis_id">
                                    <div class="form-group">
                                        <textarea class="form-control" rows="3" placeholder="आप फाइल को Dispose क्यूँ करना चाहते है कृपया जरुर लिखें|" id="modal-id" name="filedis_msg" required>सूचनार्थ</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                    <button id="btn-delete" type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>