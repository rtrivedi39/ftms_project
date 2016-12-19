<?php  $userrole = checkUserrole(); ?>
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
		
		  
		   <?php 
		  $emp_id = emp_session_id();
		  $empdetails = empdetails($emp_id) ;
		  $so_and_above_officer = array(3,4,5,6,7,8);
		  $empdetails[0]['role_id'];
			if(in_array($empdetails[0]['role_id'] ,$so_and_above_officer  )){
		  $this->load->view('rti_manage_file/rti_buttons'); 
			}
		  ?>
        <div class="col-xs-12">
            <div class="box" style="overflow: auto">
                <div class="box-header no-print">
                    <div style="float:left"><h3 class="box-title"><?php echo $title_tab;?></h3></div>
                    <div style="float:right">
                        <!--<button class="btn btn-block btn-info"><?php echo $this->lang->line('view_file_mark');?></button>-->
						<button onclick="printContents('divname')" class="btn btn-primary no-print">Print</button>
                        <button class="btn btn-warning no-print" title="Back" onclick="goBack()"><?php echo $this->lang->line('Back_button_label'); ?></button>
                        
                    </div>
                </div><!-- /.box-header -->
                <?php // echo $this->session->flashdata('message'); ?>
                <?php if($this->session->flashdata('message') || $this->session->flashdata('error')) {
                    $msg = $this->session->flashdata('message') ? 'success' : 'danger';
                    ?>
                    <div class="alert alert-<?php echo $msg; ?> alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php  echo $this->session->flashdata('message');
                        echo $this->session->flashdata('error'); ?>
                    </div>
                <?php } ?>
                <table id="view_table" class="table table-bordered table-striped display print_font">
                    <thead>
                    <tr>
                        <th><?php echo $this->lang->line('sno'); ?></th>
                        <th><?php echo $this->lang->line('section_no1'); ?></th>
                        <th><?php echo $this->lang->line('view_file_subject'); ?></th>
                        <th><?php echo $this->lang->line('rti_file_applicant_firm_name'); ?></th>
                        <th><?php echo $this->lang->line('rti_file_applicant_firm_contact_no'); ?></th>
                        <th><?php echo $this->lang->line('view_mark_section'); ?></th>
						<th>विभाग</th>
                        <th><?php echo $this->lang->line('date'); ?></th>
                        <th class="no-print" width="100px"><?php echo $this->lang->line('filestatus'); ?></th>
                        <th  class="no-print" width="115px"><?php echo $this->lang->line('actions'); ?></th>
                        <!--<th  class="no-print">create by</th>-->
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=1; foreach ($get_files as $key => $files) { ?>
                        <tr>
                            <td><?php echo $i;?></td>                            
                            <td><?php
                               
								$rrt = all_getfilesec_id_byfileid($files->file_id);
                                        foreach($rrt as $rrt1){
                                            $sechi = explode('(',getSection($rrt1['section_id']));
                                            echo "<b>".$rrt1['section_number'] ."</b> - <span style='font-size: 12px'>".$sechi['0']."</span><br/>";
                                        }
								
								?>
                            </td>
                            <td><?php echo $files->file_subject;?>
                                <br><?php if(isset($files->scan_id) && $files->scan_id != ''){ show_scan_file($files->scan_id); }?>
                            </td>
                            <td><?php echo $files->file_uo_or_letter_no; ?> (<?php echo getFileType($files->file_type) ;?>)</td>
                            <td><?php echo date_format(date_create($files->file_uo_or_letter_date), 'd/m/y'); ?></td>
                            <td><?php $marksection=$files->file_mark_section_id;
                                if($marksection==0){
                                    if($marksection==1){ echo 'व्यक्तिगत (Personal)';}else{ echo ' गोपनीय / सुरक्षित फ़ाइल'; }
                                }else{ echo getSection($files->file_mark_section_id);}?>
                            </td>
							<td><?php 
							$file_from = file_from_type();
							$high_bench =  highcourt_bench();							
							if(isset( $files->file_Offer_by) && isset($file_from)){
							echo   $files->file_Offer_by == 'c' || $files->file_Offer_by == 'jvn' ? $file_from[$files->file_Offer_by] ." , ". $files->district_name_hi : false ;
							}
							if(isset( $files->file_Offer_by) && isset($file_from) && isset($high_bench)){
							echo    $files->file_Offer_by == 'm' || $files->file_Offer_by == 'u' ? $file_from[$files->file_Offer_by] ." , ". $high_bench[$files->court_bench_id] : false ;
							}
							if(isset( $files->file_Offer_by) && isset($file_from)){
							echo    $files->file_Offer_by == 'sc' ? $file_from[$files->file_Offer_by] ." , Delhi , दिल्ली" : false ;
							}
							if(isset( $files->file_Offer_by) && isset($file_from)){
							echo    $files->file_Offer_by == 'v' || $files->dept_name_hi ? $file_from[$files->file_Offer_by] ." , ". $files->dept_name_hi ." ".$files->file_department_name : $files->file_department_name;
							}
							?>
							</td>
                            <td><?php echo date("d-m-Y", strtotime($files->file_created_date));?></td>
                            <td class="no-print"><?php
                                $filereceiver = get_user_details($files->file_received_emp_id);
                                if ($filereceiver)
                                {
                                    if($files->file_hardcopy_status == 'not') {
                                        echo "<span style='color:#dd4b39' >Not Received by <b> ".ucfirst($filereceiver[0]->emp_full_name)."</b><br/> (".$filereceiver[0]->emprole_name_hi.")</span>";
                                    } else {
                                        echo "<span style='color:#00a65a' >Received by <b> ".ucfirst($filereceiver[0]->emp_full_name)."</b><br/> (".$filereceiver[0]->emprole_name_hi.")</span>";
                                    } } ?></td>
                            <td class="no-print">
                                <div class="btn-group">
                                    <a href="<?php echo base_url();?>view_file/viewdetails/<?php echo $files->file_id; ?>" class="btn btn-twitter">View <i class="fa fa-fw fa-search"></i></a>
                                    <?php 
									if(emp_session_id()==$files->file_received_emp_id)
                                    { 
										if($files->file_hardcopy_status == 'not') {  ?>
                                    <!--<a href="<?php echo base_url();?>dashboard/receive_edit/<?php echo $files->file_id; ?>" class="btn btn-twitter"><span class="blink_fast">Receive</span></a>-->
                                        <a onclick="return confirm_receive()" href="<?php echo base_url();?>rti_manage_file/rti_files_edit/receivebycr/<?php echo $files->file_id; ?>" class="btn btn-twitter"><span class="blink_fast">Receive</span></a>
                                    <?php }else {

									?><a href="<?php echo base_url();?>edit/rti_file/<?php echo $files->file_id; ?>" class="btn  btn-twitter">Edit</a>
                                    <?php } 
									}else if(emp_session_id()==$files->createfile_empid)
									{ 	
										if($files->file_hardcopy_status == 'not' && emp_session_id() == $files->file_sender_emp_id) { ?>
											<a href="<?php echo base_url();?>edit/rti_file/<?php echo $files->file_id; ?>" class="btn  btn-twitter">Edit</a>
									<?php } ?>
									<?php }
									if($files->file_sender_emp_id==emp_session_id()){
										$showmd=1;
									}else{$showmd=0;}
									echo   $files->file_hardcopy_status == 'received' && emp_session_id() == $files->file_received_emp_id && $files->file_level_id != '31' ? '<button onclick="open_model2('.$files->file_id.')" value="'.$files->file_id.'"  class="btn btn-sm btn-block btn-twitter upperuser" data-toggle="tooltip" data-original-title="Send to officer">अधिकारी को भेजें</button> ' : false;
									$rolearray = array(3,4,5,6,7,11);
									if(in_array( $userrole ,$rolearray)){
									echo   $files->file_hardcopy_status == 'received' && emp_session_id() == $files->file_received_emp_id ? '<button onclick="open_model('.$files->file_id.','.$showmd.')" value="'.$files->file_id.'" class="btn btn-sm btn-block btn-danger rty" data-mark_sec="'.$files->file_mark_section_id.'">'.$this->lang->line('send_to_down_officer').'</button>' : false;
									}
									echo   $files->file_hardcopy_status == 'received' && emp_session_id() == $files->file_received_emp_id  ? '<button onclick="section_section('.$files->file_id.')" value="'.$files->file_id.'"  class="btn btn-sm btn-block btn-twitter sections_nm" data-toggle="tooltip" data-original-title="Section to Section movement">Section to Section</button> ' : false;
									?>
                                </div>
                            </td>
						<!--<td  class="no-print"><?php //$createfile_empid = get_user_details($files->createfile_empid); echo ucfirst($createfile_empid[0]->emp_full_name); ?></td>	-->
                        </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
    <!-- Main row -->
</section><!-- /.content -->
<style type="text/css">
    #leave_employee_filter{
        clear: both;
    }
</style>
<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script>
	function open_model2(file){
        var file2 = file;
        $('#modal-id2').val(file2);
        $('#modal-send_upper').modal('show');
        $('#form_submit_link').attr('action','<?php echo base_url() ;?>manage_file/Sendfile_upperofficer/'+file2);

    }
	function section_section(file){
        var filess = file;
        $('#modal-send_upper').modal('show');
        $('#form_submit_link').attr('action','<?php echo base_url() ;?>manage_file/section_to_section/'+filess);
    }
	  function open_model(file,yn){
        var file1 = file;
        $('#modal-id').val(file1);
		/*//if(yn==1){ $('.psmdate').show();}else{$('.psmdate').hide();}*/
        $('#modal-delete').modal('show');
    }
	  $(function () {
		    $(".upperuser").click(function () {
            var file_id = $(this).val();
            var HTTP_PATH='<?php echo base_url(); ?>';
            $.ajax({
                type: "POST",
                url: HTTP_PATH + "view_file/upper_role_officer_new/"+file_id,
                datatype: "json",
                async: false,
                data: {file_id: file_id},
                success: function(data) {
                    var r_data = JSON.parse(data);
                    var otpt1 = '<select class="form-control" name="emp_id2">';
                   $.each(r_data[0], function( index, value ) {
                        if(r_data[1][0].upperofficid == value.emp_id){
                            var selected = 'selected';
                        }else{
                            var selected = null;
                        }

                        otpt1 += '<option value="'+value.emp_id+'" '+selected+'>'+value.emp_full_name+' ('+value.emprole_name_hi+')</option>';
                    });
                    otpt1 += '</select>';
                    $("#emp_byfile2").html(otpt1);
                }
            });
        });
		
		  $(".sections_nm").click(function () {
            var file_id = $(this).val();
            var HTTP_PATH='<?php echo base_url(); ?>';
            $.ajax({
                type: "POST",
                url: HTTP_PATH + "view_file/section_off_nm/"+file_id,
                datatype: "json",
                async: false,
                data: {file_id: file_id},
                success: function(data) {
					
                    var r_data = JSON.parse(data);
                    var otpt1 = '<select class="form-control" name="section_mark" required>';
					otpt1 += '<option value="">Select</option>';
                    $.each(r_data, function( index, value ) {
                        otpt1 += '<option value="'+value.section_id+'">'+value.section_name_hi+' ('+value.section_name_en+')</option>';
                    });
                    otpt1 += '</select>';
                    $("#emp_byfile2").html(otpt1);
                }
            });
        });
		
		  
        $(".rty").click(function () {
            var file_id = $(this).val();
            var mark_sec = $(this).data('mark_sec');
            var HTTP_PATH='<?php echo base_url(); ?>';
            $.ajax({
                type: "POST",
                url: HTTP_PATH + "view_file/return_fileofficer/"+file_id,
                datatype: "json",
                async: false,
                data: {file_id: file_id},
                success: function(data) {
                    var r_data = JSON.parse(data);
                    var otpt = '<select class="form-control" id="check_sec_count" name="emp_id">';
                    $.each(r_data, function( index, value ) {
                        if(value.role_id == 8 || value.role_id == 37 || value.role_id == 14){
                            var secname = value.section_name_hi;
                        }else{
                            var secname = '';
                        }if(value.section_id == mark_sec){
                            var selected = 'selected';
                        }else{
                            var selected = null;
                        }
                        otpt += '<option value="'+value.emp_id+'" '+selected+'>'+value.emp_full_name_hi+' ('+value.emprole_name_hi+')  '+secname+'</option>';
                    });
                    otpt += '</select>';
                    $("#emp_byfile").html(otpt);

                   $('#check_sec_count').change(function () {
                        alert($(this).val()); // or $(this).val()
                    });
                }
            });
        });
		
	 });	
</script>

<div class="modal fade" id="modal-delete" data-backdrop="static">
    <div class="modal-dialog">
        <form action="<?php echo base_url() ;?>manage_file/return_file" method="post" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-edit"></i> Enter Remark </h4>
                </div>
                <div class="modal-body">
                    <div class="box-body table-responsive">
                        <div class="box-body">
                            <div class="row">
								<div class="col-xs-12 psmdate">
									<label>PS monitor Date</label>
									<input type="date" class="form-control ps_moniter_date" name="ps_moniter_date" id="ps_moniter_date">
									<br/>
								</div>
                                <div class="col-xs-12">
                                    <input type="hidden" id="modal-id" name="fileids">
                                    <textarea class="form-control" rows="3" placeholder="Enter ..." id="modal-id" name="rmk1"></textarea>
                                    <br/>
                                    <div id="emp_byfile"></div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i>Cancel</button>
                    <button id="btn-delete" onclick="return confirm_send()" type="submit" class="btn btn-primary load_btn"><i class="fa fa-check"></i>Send</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="modal-send_upper" data-backdrop="static">
    <div class="modal-dialog">
        <!--<form action="<?php echo base_url() ;?>manage_file/Sendfile_upperofficer" method="post" >-->
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
                                    <input type="hidden" id="modal-id2" name="fileids2">
                                    <textarea class="form-control" rows="3" placeholder="Enter ..." id="modal-id" name="rmk1"></textarea>
                                    <br/>
                                    <div id="emp_byfile2"></div>
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