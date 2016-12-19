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
	
    <?php //pr($get_files); ?>
        <div class="col-xs-12" >
            <div class="box" style="overflow: auto" >
                <div class="box-header">
				<div>
					<h4 class="text-center"><?php echo getSection(14);?> files</h4>
					<p class="text-right"><b>Total number of Files: <?php echo count($get_files);?> </b></p>
				</div>
                    <div style="float:left"><h3 class="box-title no-print"><?php echo $title_tab;?></h3></div>
                    <div style="float:right">
                        <!--<button class="btn btn-block btn-info"><?php echo $this->lang->line('view_file_mark');?></button>-->
						<button onclick="printContents('divname')" class="btn btn-primary no-print">Print</button>
                        <button class="btn btn-warning no-print" title="Back" onclick="goBack()"><?php echo $this->lang->line('Back_button_label'); ?></button>
                    </div>
                    <br/>
                </div><!-- /.box-header -->
                 <div class="box-body">
                <?php // echo $this->session->flashdata('message'); ?>
                <?php if($this->session->flashdata('message') || $this->session->flashdata('error')) {
                    $msg = $this->session->flashdata('message') ? 'success' : 'danger';
                    ?>
                    <div class="alert alert-<?php echo $msg; ?> alert-dismissable no-print">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>
                            <?php  echo $this->session->flashdata('message');
                            echo $this->session->flashdata('error'); ?>
                        </strong>
                        <br/>
                    </div>
                <?php }
				$empdetails =  empdetails(emp_session_id());?>
                <table style="margin-left:0%" id="view_table_dispatch1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th width="5%">क्र.</th>
                        <th width="20%">विषय</th>
						<th width="20%"> भेजने वाला विभाग</th>
						<th width="10%">यू.ओ / पत्र क्र.</th>
						<th width="10%">यू.ओ/पत्र दिनांक</th>
                        <th width="5%">अनुभाग का पंजी क्र.</th>
                        <th width="5%">विभाग में प्राप्ति दिनांक</th>  
                        <th width="5%">निराकण दिनांक</th>
                    </tr>
                    </thead>
                    <tbody>
						<?php $i=1; foreach ($get_files as $key => $files) {
						//pr($files);						
							if(is_array($files)){
								$files = $files[0];
							}
						$file_open = $files->file_id;
						$dept_name_hi = $dept_officer_nm =  $dept_officer_number = $dept_officer_email = '';
						//pre($files->file_department_id);
						if($files->file_department_id != '' || isset($files->file_department_id) || $files->file_department_id != 0 ) {
							$file_dept = get_list(DEPARTMENTS, NULL, array('dept_id' => $files->file_department_id));
							//pre($file_dept);
							$dept_name_hi = isset($file_dept[0]['dept_name_hi']) ? $file_dept[0]['dept_name_hi'] : '';
							$dept_officer_nm = isset($file_dept[0]['dept_officer_nm']) ? $file_dept[0]['dept_officer_nm'] : '';
							if(isset($file_dept[0]['dept_officer_number'] ) &&  $file_dept[0]['dept_officer_number'] != '' && $file_dept[0]['dept_officer_number'] != 0){
								$dept_officer_number =   $file_dept[0]['dept_officer_number'];
							} else {
								$dept_officer_number =  '9898989898';
							}
							$dept_officer_email = isset($file_dept[0]['dept_officer_email']) ? $file_dept[0]['dept_officer_email'] : '';
							$file_open = $files->file_id.','.$dept_officer_number;

						}

						?>
						<tr class="row-gap">
							<td><?php echo $i;?></td>
							<td><?php echo $files->file_subject;?>
							<br><?php if(isset($files->scan_id) && $files->scan_id != ''){ show_scan_file($files->scan_id); }?>
							</td>
							<td><?php
									$file_from = file_from_type();
									$high_bench =  highcourt_bench();
									if(isset($files->file_Offer_by) && isset($file_from)) {
										echo   @$files->file_Offer_by == 'c' || @$files->file_Offer_by == 'jvn' ? @$file_from[$files->file_Offer_by] ." , ". @$files->district_name_hi." <br/>" : false ;
									}
									if(isset($files->file_Offer_by)  && isset($file_from)  || isset($high_bench)) {
										//pre($high_bench[$files->court_bench_id]);
										echo   @$files->file_Offer_by == 'm' || @$files->file_Offer_by == 'u' ? @$file_from[$files->file_Offer_by] ." , ". $high_bench[$files->court_bench_id] : false ;

										echo   @$files->file_Offer_by == 'v' || @$files->dept_name_hi ?  @$files->dept_name_hi ." ".(isset($files->file_department_name)?$files->file_department_name:'') : (isset($files->file_department_name)?$files->file_department_name:'');
									}									
								?>
							</td>
							<td><?php echo $files->file_uo_or_letter_no; ?> (<?php echo getFileType($files->file_type) ;?>)</td>
							<td><?php echo date_format(date_create($files->file_uo_or_letter_date), 'd/m/y'); ?></td>
							<td><?php echo get_panji_no($files->file_id,$files->file_mark_section_id,$files->file_created_date); ?></td>
							<td><?php echo date_format(date_create($files->file_created_date), 'd/m/y'); ?></td>
							<td><?php echo get_date_formate($files->dispatch_date, 'd/m/y'); ?></td>
						</tr>
						
						<?php $i++; } ?>
					
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col-12 -->  
</div><!-- /.row -->
    <!-- Main row -->
</section><!-- /.content -->
<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script type="text/javascript">
    $(function () {
        
        $(".rty1").click(function () {
            var file_id = $(this).val();
            var HTTP_PATH='<?php echo base_url(); ?>';
            $.ajax({
                type: "POST",
                url: HTTP_PATH + "view_file/section_da_name",
                datatype: "json",
                async: false,
                data: {file_id: file_id},
                success: function(data) {
                    var r_data = JSON.parse(data);
                    var otpt = '<select class="form-control" name="emp_id"><option value="">Select DA name</option> ';
                    $.each(r_data, function( index, value ) {
                        otpt += '<option value="'+value.emp_id+'">'+value.emp_full_name+'</option>';
                    });
                    otpt += '</select>';
                    $("#emp_byfile").html(otpt);
                }
            });
        });
    });
    function open_model(file){
        var file1 = file;
        $('#modal-id').val(file1);
        $('#modal-delete').modal('show');
    }
    function open_model2(file, mobile_number){		
        var file2 = file;
        $('#modal-id2').val(file2);       
        $('#mobile_number').val(mobile_number);
        $('#modal-da').modal('show');
    }
	
	$("#sende_data").click(function(){
		var deptname = " विभाग का नाम :- " + $(this).data("deptname");
		var officername = " विभाग के अधिकारी का  नाम :- " + $(this).data("officername");		
		$('#deptname').html(deptname);
        $('#offcer_name').html(officername);
		var name = $(this).closest("tr").find('td:eq(2)').text();
		
		var fileid = $(this).data('fileid'); 	
		
	});
	
    function open_model3(file){
        var file3 = file;
        $('#modal-receive_file').modal('show');
        $('#receive_file1').attr('action','<?php echo base_url() ;?>manage_file/receive_file_dispatch/'+file3);
    }
	
	
	$(document).ready(function () {
		var counter = 0;

		$(".addrow").on("click", function () {

			counter = $('.m_dispatch tr').length - 2;

			var newRow = $("<tr>");
			var cols = "";

			cols += '<td>प्रतिलिपि ' + counter + '</td><td><textarea name="dispatch_name[]"' + counter + '" rows="2" cols="50"></textarea></td>';
			

			cols += '<td><input type="button" class="ibtnDel"  value="हटायें"></td>';
			newRow.append(cols);
			if (counter == 10) $('.addrow').attr('disabled', true).prop('value', "You've reached the limit");
			$("table.m_dispatch").append(newRow);
			counter++;
			$('.total_row').val(counter);
		});

		$("table.m_dispatch").on("click", ".ibtnDel", function (event) {
			$(this).closest("tr").remove();

			counter -= 1;
			$('.addrow').attr('disabled', false).prop('value', "अन्य प्रतिलिपि जोड़े");
			$('.total_row').val(counter);
		});


		
	});
</script>


<div class="modal fade" id="modal-delete" data-backdrop="static">
    <div class="modal-dialog">
        <!-- <form action="<?php echo base_url() ;?>manage_file/return_file" method="post" >-->
        <form action="<?php echo base_url() ;?>manage_file/return_file_da" method="post" >
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
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                    <button id="btn-delete" type="submit" onclick="return confirm_send()" class="btn btn-primary"><i class="fa fa-check"></i> Yes</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="modal-da" data-backdrop="static">
    <div class="modal-dialog">
        <form action="<?php echo base_url() ;?>manage_file/dispatch_for_close" method="post" enctype="multipart/form-data">
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
                                    <input type="hidden" id="modal-id2" name="fileids2">
                                    <label  id="deptname"></label><br/>
                                    <label  id="offcer_name"></label>
									<hr/>
                                    <div class="form-group">
									<label>मूल्य</label>
                                        <input type="number" name="cost_dispatch" class="form-control" placeholder="cost of diapatch">
                                    </div>
                                    <div class="form-group">
									<label>विभाग के अधिकारी का मोबाइल नंबर</label>
                                        <div class="input-group">
                                          <div class="input-group-addon">+91</div>
                                           <input type="text" name="mobile_number" id="mobile_number" class="form-control" placeholder="Department mobile number">
                                        </div>									                                       
                                    </div>
                                    <div class="form-group">
									<label>कोई टीप</label>
                                    <textarea class="form-control" rows="3" placeholder="Enter ..." id="modal-id" name="rmk2"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">File input</label>
                                        <input type="file" id="proof_dispatch" name="proof_dispatch">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                    <button id="btn-delete" type="submit" class="btn btn-primary" onclick="return confirm_send_sms();"><i class="fa fa-check" ></i> Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!--receive model-->
<div class="modal fade" id="modal-receive_file" data-backdrop="static">
    <div class="modal-dialog">
        <form method="post" id="receive_file1">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-male"></i> फ़ाइल देने वाले का नाम</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body table-responsive">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="exampleInputFile">File given by</label>
                                        <input type="text" id="carry_fileemp_name" name="carry_fileemp_name" placeholder="Put name here"  class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                    <button id="btn-delete" onclick="return confirm_receive()" type="submit" class="btn btn-primary"><i class="fa fa-check blink"></i> Receive</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!--End-->
<style type="text/css">
    #leave_employee_filter{
        clear: both;
    }
	.row-gap{
		border-bottom:1px solid #cccccc !important;
		margin-bottom:10px !important;
	}
	
</style>
<script>
	function  confirm_send_sms(){        
		var no = document.getElementById('mobile_number');
		if(no.value == ''){
			alert('कृपया मोबाइल नंबर जरुर दर्ज करें|');
			no.focus();
			return false;
		} else {
			return confirm('आप फाइल को बंद कर रहे है और सन्देश नं.  '+ no.value +' पर भेज रहे है');
		}
	}
</script>