<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script type="text/javascript">
    $(function () {
        /*//Get upper user name*/
        $(".upperuser").click(function () {
			var file_id = $(this).val();
            var HTTP_PATH='<?php echo base_url(); ?>';
            $.ajax({
                type: "POST",
                url: HTTP_PATH + "establishment/view_file_es/upper_role_officer_new/"+file_id,
                datatype: "json",
                async: false,
                data: {file_id: file_id},
                success: function(data) {
                    var r_data = JSON.parse(data);
					var otpt1 = '<select id="check_sec_count" class="form-control" name="emp_id2">';
                    $.each(r_data[0], function( index, value ) {
                        if(r_data[1][0].upperofficid == value.emp_id){
                            var selected = 'selected';
                        }else{
                            var selected = null;
                        }
						if(value.emp_detail_gender=='m'){
                            var fword_en='Shri';
                            var fword_hi='श्री';
                        }else if(value.emp_detail_gender=='f'){
                            var fword_en='shushri';
                            var fword_hi='सुश्री';
                        }
                        otpt1 += '<option value="'+value.emp_id+'" '+selected+'>'+fword_hi+' '+value.emp_full_name+' ('+value.emprole_name_hi+')</option>';
                    });
                    otpt1 += '</select>';
                    $("#emp_byfile2").html(otpt1);
					$('#check_sec_count').change(function () {
					 
					   var emp_id =  $(this).val();
                       $.ajax({
							type: "POST",
							url: HTTP_PATH + "establishment/view_file_es/check_user_section/",
							datatype: "json",
							async: false,
							data: {emp_id: emp_id},
							success: function(data) {
								
							if(data!=0){
								var s_data = JSON.parse(data);
								var otpt2 = '<div class="row radiodiv">';
							
								$.each(s_data, function( index, value ) {
								 otpt2 += '<div class="col-md-4 text-center"><label class="radio" ><input type="radio"  required ="required" name="section_id" value="'+value.section_id+'">'+value.section_name_hi+' </label></div>';
								
								});								
								otpt2 += '</div>';
								$("#emp_by_section").html(otpt2);
								}else{
									$(".radiodiv").remove();
									$("#emp_by_section").html('');
									
								}
							}
						});
                      
                    });
                }
            });
        });

        $(".sections_nm").click(function () {
            var file_id = $(this).val();
            var HTTP_PATH='<?php echo base_url(); ?>';
            $.ajax({
                type: "POST",
                url: HTTP_PATH + "establishment/view_file_es/section_off_nm_es/"+file_id,
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

     /*   */
        $(".rty6").click(function () {
            var file_id = $(this).val();
            var HTTP_PATH='<?php echo base_url(); ?>';
            $.ajax({
                type: "POST",
                url: HTTP_PATH + "establishment/view_file_es/section_user_name_es",
                datatype: "json",
                async: false,
                data: {file_id: file_id},
                success: function(data) {
                    var r_data = JSON.parse(data);
                    var otpt = '<select class="form-control" name="Da_name" required=""><option value="">Select DA name</option> ';
                    var session2 = <?php echo emp_session_id() ?>;
                    var user_role_2 = <?php echo $this->session->userdata('user_role') ?>;
                    $.each(r_data, function( index, value ) {						
                        if(user_role_2 != 8){
                            if(value.role_id == 8) {
							if(value.emp_detail_gender == 'm'){
							var rgtag = 'श्री';	
							}else{
							var rgtag = 'सुश्री' ;		
							}
                                otpt += '<option value="' + value.emp_id + '" selected>'+rgtag+' ' + value.emp_full_name_hi +' ('+value.emprole_name_hi+')</option>';
                            }
                        }else{
                        if(session2 != value.emp_id) {
							
						if(value.emp_detail_gender == 'm'){
						var rgtag = 'श्री';	
						}else{
						var rgtag = 'सुश्री' ;		
						}
						  otpt += '<option value="' + value.emp_id + '">'+rgtag+' ' + value.emp_full_name_hi + ' ('+value.emprole_name_hi+')</option>';
                        }}
                    });
                    otpt += '</select>';
                   $("#emp_byfile5").html(otpt);
                 
                }
            });
        });
    });


    function open_model(file){
        var file1 = file;
        $('#modal-id').val(file1);
        $('#modal-delete').modal('show');
    }

    function open_model2(file ,file_status){
        var file2 = file;
		check_file_status(file_status);
        $('#modal-id2').val(file2);
        $('#modal-send_upper').modal('show');
        $('#form_submit_link').attr('action','<?php echo base_url() ;?>manage_file/Sendfile_upperofficer/'+file2);

    }
    function open_model3(file ,file_status ){
        var file3 = file;
		 check_file_status(file_status);
		$('#modal-receive_file').modal('show');
        $('#receive_file1').attr('action','<?php echo base_url() ;?>manage_file/receive_file_sectionno/'+file3);
    }
    function open_model4(file){
        var file4 = file;
        $('#modal-receive_file').modal('show');
        $('#receive_file1').attr('action','<?php echo base_url() ;?>manage_file/receive_file_sectionno/'+file4);
    }
    function open_model5(file){
        var file5 = file;
        $('#modal-return_to_cr').modal('show');
        $('#cr_return').val(file5);
    }
    function open_model6(file , file_status){
        var file6 = file;
		 check_file_status( file_status);
        $('#modal-id5').val(file6);
        $('#modal-return_da_file').modal('show');
    }
    function open_model_dispose(file){
        var file_dis = file;
        $('#modal-dis').val(file_dis);
        $('#modal-dispose_file').modal('show');
    }
    function section_section(file , file_status){
        var filess = file;
		check_file_status( file_status);
        $('#modal-send_upper').modal('show');
        $('#form_submit_link').attr('action','<?php echo base_url() ;?>manage_file/section_to_section/'+filess);
    }

    function receive_markda(file){
        var file3 = file;
        $('#modal-receive_mark').modal('show');
        $('#receive_mark').attr('action','<?php echo base_url() ;?>establishment/receive_sectionno_mark_da/'+file3);
    }

    function confirm_dispose(){
        return confirm('क्या आप Dispose करना  चाहते है!');
    }

   /* //add apend div for multiple dispatch*/
    $(document).ready(function () {
        var counter = 0;

        $("#addrow").on("click", function () {

            counter = $('#multiple_dispatch tr').length - 2;

            var newRow = $("<tr>");
            var cols = "";

            cols += '<td>प्रतिलिपि ' + counter + '</td><td><textarea name="dispatch_name[]"' + counter + '" rows="2" cols="50"></textarea></td>';
         /*   //cols += '';*/

            cols += '<td><input type="button" class="ibtnDel"  value="हटायें"></td>';
            newRow.append(cols);
            if (counter == 10) $('#addrow').attr('disabled', true).prop('value', "You've reached the limit");
            $("table.m_dispatch").append(newRow);
            counter++;
            $('.total_row').val(counter);
        });

        $("table.m_dispatch").on("click", ".ibtnDel", function (event) {
            $(this).closest("tr").remove();

            counter -= 1;
            $('#addrow').attr('disabled', false).prop('value', "Add Row");
            $('.total_row').val(counter);
        });


        /*//dispatch button on click*/
        $("#dispatch_btn").click(function () {
            var file_id = $(this).data('file_id'); /**/
            $('#dis_file_id').val(file_id);  /*//set model file_id*/
            var dept = $(this).closest("tr").find('td:eq(6)').text();
            $('#dept_name').val(dept);  /*//set model file_id*/

        });
		
	/*	//remark button on click*/
        $(".remarkbtn").click(function () {
            var file_id = $(this).data('file_id'); 
            $('#remark_file_id').val(file_id);  
            var panji = $(this).closest("tr").find('td:eq(1)').text();
            $('#panji_no').html(panji);  
			var da_path_name = window.location.href.substring(window.location.href.lastIndexOf('/') + 1);
		
			
			if(da_path_name == 'view_file_es' ){
			var subject = $(this).closest("tr").find('td:eq(2)').text();
			
			}else{
			var subject = $(this).closest("tr").find('td:eq(4)').text();
			}
            $('#subject').html(subject); 

        });

        
        $("#ddl_dipatch_lists").change(function() {
            var list_id = $(this).val(); 
            if(list_id == 1){
                $('#mahadhivakta').hide();
                $('#vibhag').show();
                $('.mahadhivakta').val('');
            }else if(list_id == 2){
                $('#mahadhivakta').show();
                $('#vibhag').hide();
                $('.vibhag').val('');
            }else{
                $('.mahadhivakta').hide();
                $('.vibhag').hide();
                $('.mahadhivakta, .vibhag').val('');

            }

        });
    });
	
	
	
	$( "#medical_type" ).change(function() {
	
		 if($(this).val() == 'दस्ताबेज' )
		 {
			 $(".certificate_attach").show();
		 }else
		 {
			 $(".certificate_attach").hide();
		 }
		 
	});
	$( "#bill_type" ).change(function() {
	
		 if($(this).val() == 2 )
		 {
			 $("#employee_list").hide();
		 }else
		 {
			 $("#employee_list").show();
		 }
		 
	});

	function get_designation(emp_id){
		var HTTP_PATH = $("#base_url").val();
		
		
		 $.ajax({
			type: "POST",
			url: HTTP_PATH + "establishment/Forms/get_employee_designation/",
			datatype: "json",
			async: false,
			data: {emp_id: emp_id},
			success: function(data) {
			
				$("#designation").val(data);
			
			}
		});
	}

			
	function mark_file(string)
	{
	
		if(string == 'own'){
			
			$(".other_list_emp").hide();
		}
		else if(string == 'other'){
			$(".other_list_emp").show();
			
		}
	}
	

	$(function() {
	  $(".child").on("click",function() {
		  $parent = $(this).prevAll(".parent");
		  if ($(this).is(":checked")) $parent.prop("checked",true);
		  else {
			 var len = $(this).parent().find(".child:checked").length;
			 $parent.prop("checked",len>0);
		  }    
	  });
	  $(".parent").on("click",function() {
		  $(this).parent().find(".child").prop("checked",this.checked);
	  });
	});
	
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
</script>
<div class="modal fade" id="modal-delete" data-backdrop="static">
    <div class="modal-dialog">
        <!-- <form action="<?php echo base_url() ;?>manage_file/return_file" method="post" >-->
        <form action="<?php echo base_url() ;?>manage_file/return_file_da" method="post" >
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
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> रद्द</button>
                    <button id="btn-delete" type="submit" class="btn btn-primary"><i class="fa fa-check"></i> हाँ</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!--raginee-->
<div class="modal fade" id="modal-send_upper" data-backdrop="static">
    <div class="modal-dialog">
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
									<div id="emp_by_section"> </div>
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
                                        <label for="exampleInputFile"> फ़ाइल देने वाले का नाम</label>
                                        <input type="text" id="carry_fileemp_name" name="carry_fileemp_name" placeholder="Put name here"  class="form-control">
                                    </div>
                                    <!--<div class="form-group">
                                        <label>Section Receive</label>
                                        <?php // $section_exp = explode(',',getEmployeeSection()); ?>
                                        <select class="form-control" name="section_mark1">
                                            <?php // foreach($section_exp as $exp){ ?>
                                                echo '<option value="<?php // echo $exp ?>"><?php // echo getSection($exp) ?></option>
                                            <?php //  } ?>
                                        </select>
                                    </div>-->
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
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                    <button id="btn-delete" onclick="return confirm_receive()" type="submit" class="btn btn-primary"><i class="fa fa-check blink"></i> Receive</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!--End-->
<!--receive model-->
<div class="modal fade" id="modal-return_to_cr" data-backdrop="static">
    <div class="modal-dialog">
        <form role="form" method="post" action="<?php echo base_url()?>view_file/dealing_file/sent_to_da">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-edit"></i> आवक में भेजें</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body table-responsive">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <input type="hidden" id="cr_return" name="file_id1">
                                        <textarea class="form-control" rows="3" placeholder="Enter ..." id="modal-id" name="file_remark"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                    <button onclick="return confirm_send()" type="submit" name="return_tocr" value="return_tocr" class="btn btn-primary"><i class="fa fa-share"></i> Return</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!--End-->
<!--return file mark to da-->
<div class="modal fade" id="modal-return_da_file" data-backdrop="static">
    <div class="modal-dialog">
        <form role="form" method="post" action="<?php echo base_url()?>view_file/dealing_file/sent_to_da">
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
<!--End-->
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
<!-- Disptach Modal -->
<div class="modal fade" id="dispatch_model" tabindex="-1" role="dialog" aria-labelledby="Dispatchmodel">
    <div class="modal-dialog" role="document">
        <form action="<?php echo base_url() ;?>manage_file/dispatch_file_byso/" method="post" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-edit"></i>नस्ती जावक में भेजें</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body table-responsive">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <input type="hidden" id="dis_file_id" name="dis_file_id">
                                    <textarea class="form-control" rows="3" placeholder="कोई टीप लिखें" id="remark-dis" name="remark"></textarea>
                                    <br/>
                                    <table id="multiple_dispatch" class="m_dispatch gridtable" border="1px" style="font-size:13px;" width="100%">
                                        <tbody>
                                        <tr><td>नस्ती कहाँ जानी है</td><td><textarea name="dispatch_name[]" rows="2" cols="50" id="dept_name"></textarea></td></tr>
                                        <tr style="display:none;" ><td>प्रतिलिपि</td><td>
                                                <select name="dispatch_name_lists" id="ddl_dipatch_lists">
                                                    <option value="">--विकल्प चुने--</option>
                                                    <option value="1">विभाग </option>
                                                    <option value="2">महाधिवक्ता </option>
                                                </select>
                                            </td></tr>
                                        <tr  id="vibhag"><td>प्रतिलिपि 2</td><td>
                                                <select name="dispatch_name[]"  class="vibhag" multiple="true">
                                                    <option value="">--विभाग चुने--</option>
                                                    <?php foreach(getDepartments() as $row) { ?>
                                                        <option value="<?php echo $row->dept_name_hi; ?>"><?php echo $row->dept_name_hi; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td></tr>
                                        <tr  id="mahadhivakta"><td>प्रतिलिपि 3</td><td>
                                                <select name="dispatch_name[]" class="mahadhivakta" multiple="true">
                                                    <option value="">--महाधिवक्ता चुने--</option>
                                                    <option value="महाधिवक्ता, मान0  उच्च न्यायालय, जबलपुर, मध्यप्रदेश">महाधिवक्ता, मान0  उच्च न्यायालय, जबलपुर, मध्यप्रदेश </option>
                                                    <option value="अतिरिक्त महाधिवक्ता, मान0  उच्च न्यायालय खण्डपीठ, इंदौर, मध्यप्रदेश">अतिरिक्त महाधिवक्ता, मान0  उच्च न्यायालय खण्डपीठ, इंदौर, मध्यप्रदेश </option>
                                                    <option value="अतिरिक्त महाधिवक्ता, मान0  उच्च न्यायालय खण्डपीठ, ग्वालियर, मध्यप्रदेश">अतिरिक्त महाधिवक्ता, मान0  उच्च न्यायालय खण्डपीठ, ग्वालियर, मध्यप्रदेश </option>
                                                </select>
                                            </td></tr>
                                        </tbody>
                                        <tfoot class="other"><tr><td colspan="4" style="text-align: left;">
                                                <input type="button" id="addrow" value="अन्य प्रतिलिपि जोड़े" />
                                                <input type="hidden" value="" name="total_row" class="total_row"></td></tr></tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> रद्द</button>
                    <button id="btn-delete" type="submit" class="btn btn-primary" onclick="return confirm('क्या आप Dispatch करना  चाहते है!');"><i class="fa fa-check"></i> हाँ</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!--return file mark to da-->
<div class="modal fade" id="modal-receive_mark" data-backdrop="static">
    <div class="modal-dialog">
        <form method="post" id="receive_mark">
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
                                        <label for="exampleInputFile"> फ़ाइल देने वाले का नाम</label>
                                        <input type="text" id="carry_fileemp_name" name="carry_fileemp_name" placeholder="Put name here"  class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" id="modal-id5" name="file_id1">
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" rows="3" placeholder="Enter ..." id="modal-id" name="file_remark"></textarea>
                                    </div>
                                    <label for="exampleInputFile">सहायक को  अंकित करें</label>
                                    <div id="emp_byfile6"></div>
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

<!-- remark Modal -->
<div class="modal fade" id="remarkmodel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
 <div class="modal-dialog">
        <form method="post" id="receive_mark" action="<?php echo base_url('establishment').'/establishment/add_reamrk' ;?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-edit"></i>रिमार्क लिखें </h4>
                </div>
                <div class="modal-body">
                    <div class="box-body table-responsive">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">  
									<p>पंजी क्रमांक:- <b><span id="panji_no">	</span></b></p>							
									<p>विषय:- <b><span id="subject">	</span></b></p>						
                                    <div class="form-group">
                                        <input type="hidden" id="remark_file_id" name="file_id_remark">
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" rows="3" placeholder="Enter ..." id="modal-id" name="file_remark"></textarea>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i>रद्द</button>
                    <button id="btn-delete" onclick="return confirm_send()" type="submit" class="btn btn-primary"><i class="fa fa-check"></i>जोड़े</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php $this->load->view('open_popup_for_despetch') ; ?>
