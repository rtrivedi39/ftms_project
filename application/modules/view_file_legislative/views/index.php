<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo $title; $emp_session_id= emp_session_id(); ?></h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard (legislative)</a></li>
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
                <?php // echo $this->session->flashdata('message'); ?>
                <?php if($this->session->flashdata('message') || $this->session->flashdata('error')) {
                    $msg = $this->session->flashdata('message') ? 'success' : 'danger';
                    ?>
                    <div class="alert alert-<?php echo $msg; ?> alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>
                            <?php  echo $this->session->flashdata('message');
                            echo $this->session->flashdata('error'); ?>
                        </strong>
                        <br/>
                    </div>
                <?php }
                ?>
                <div class="box-header">
                    <h3 class="box-title"><?php echo $title_tab;?></h3>
                    <div class="box-tools pull-right">
                        <button onclick="printContents('divname')" class="btn btn-primary no-print">Print</button>
                        <!--<button class="btn btn-block btn-info"><?php echo $this->lang->line('view_file_mark');?></button>-->
                        <button class="btn  btn-warning" title="Back" onclick="goBack()"><?php echo $this->lang->line('Back_button_label'); ?></button>
                    </div>

                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
						 <form method="post">
                        <?php $empssection = empdetails($emp_session_id);
							$alloted_section = $empssection[0]['emp_section_id'];
							$allot_section = explode( ',',$alloted_section );
							if(count($allot_section) > 1){
                        if(isset($page1)) {$p1 = '/'.$page1;} else { $p1 = null;}
                        $i=1; foreach(explode(",",$empssection[0]['emp_section_id'])  as $empsec){
                            if ($i%2 == 1) { $cls = "class='btn bg-purple btn-flat margin'"; }else{ $cls = "class='btn bg-maroon btn-flat margin'"; }
                            if (isset($empsec)) {
								if($empsec != '26')		{					?>
                                <a href="<?php echo base_url().'view_file_legislative/index'.$p1.'/?section_id='.$empsec ; ?>" <?php echo $cls ; ?>><?php echo getSection($empsec) ; ?></a>
                            <?php }	} $i++; }?>
                             <a href="<?php echo base_url().'view_file_legislative/index'.$p1.'/?section_id=oth' ; ?>" class="btn bg-purple btn-flat margin">(अन्य फाइलें) Other files</a>
							 <a href="<?php echo base_url().'view_file_legislative/index'?>" class="btn bg-maroon btn-flat margin" ><?php echo "सभी फ़ाइल्" ; ?></a>
							<?php } ?>


							</form>
						<table id="view_table" class="table table-bordered table-striped display">
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
                            <?php $i=1; foreach ($get_files as $key => $files) {
                                $diff=date_diff(date_create($files->file_update_date),date_create(date("Y-m-d")));
                                $checkdate = $diff->format("%a");
                                ?>
                                <tr <?php
                                if($checkdate >= '3' && $checkdate <= '7') { echo "style='background-color:#FBFBDE' data-toggle='tooltip' data-original-title='३ दिन से अधिक विलंब'";
                                } else if($checkdate >= '7' && $checkdate <= '10') { echo "style='background-color:#FFE7BA' data-toggle='tooltip' data-original-title='७ दिन से अधिक विलंब'";
                                } else if($checkdate >= '10') { echo "style='background-color:#FFA4A4' data-toggle='tooltip' data-original-title='१० दिन से अधिक विलंब'";}
                                ?>>
                                    <td alt="<?php echo $files->file_id;?>"><?php echo $i;?></td>
                                    <td><?php
                                        // echo @getfilesec_id_byfileid($files->file_id,$files->file_mark_section_id,$files->file_type) ? getfilesec_id_byfileid($files->file_id,$files->file_mark_section_id,$files->file_type) : 'N/A';
                                        $rrt = all_getfilesec_id_byfileid($files->file_id);
                                        foreach($rrt as $rrt1){
                                            $sechi = explode('(',getSection($rrt1['section_id']));
                                            echo "<b>".$rrt1['section_number'] ."</b> - <span style='font-size: 12px'>".$sechi['0']."</span><br/>";
                                        }
                                        ?></td>
                                    <td><?php echo $files->file_subject;?>
										<br><?php if(isset($files->file_status) && $files->file_status != ''){ show_file_status($files->file_status);}?>  
									</td>
									<td><?php echo $files->file_uo_or_letter_no; ?> (<?php echo getFileType($files->file_type) ;?>)<br><span class="badge bg-light-blue"> प्रेषक नाम : <?php echo isset($files->file_sender_emp_id)? getemployeeName($files->file_sender_emp_id, 'hindi'):'' ?></span></td>
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
                                                echo file_closed_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi, $file_details[0]['file_type']);
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
                                    <td width="150px">
                                        <?php
                                        $senderemp = empdetails($files->file_sender_emp_id);
										$multi_nm = explode(',',$files->multi_user_receiver_id);
                                        echo $files->file_hardcopy_status == 'not' && ($emp_session_id == $files->file_received_emp_id || in_array(emp_session_id(),$multi_nm)) && $this->uri->segment(3) != '1' ? '<button onclick="open_model3('.$files->file_id.',&#39;'.$files->file_status.'&#39;)" value="'.$files->file_id.'" class="btn btn-block btn-sm btn-twitter"><span class="blink_fast">'.$this->lang->line('receive_file').'</span></button> <a data-toggle="tooltip" data-original-title="वापस पिछले स्तर पर भेजे" onclick="return confirm_reject()" href="'.base_url().'manage_file/send_file_return/'.$files->file_id.'" class="btn btn-block btn-sm btn-instagram" data-toggle="tooltip" data-original-title="Reject">'.$this->lang->line('reject').'</a>' : false;
                                        echo $files->file_hardcopy_status == 'not' && ($emp_session_id == $files->file_received_emp_id || in_array(emp_session_id(),$multi_nm)) && $this->uri->segment(3) == '1' ? '<a onclick="return confirm_receive()" href="'.base_url().'manage_file_legislative/receive_file_sectionno/'.$files->file_id.'" class="btn btn-block btn-twitter"><span class="blink_fast" data-toggle="tooltip" data-original-title="Receive">'.$this->lang->line('receive_file').'</span></a>' : false; // file receive from dealing assistant
                                        echo   $files->file_hardcopy_status == 'received' && ($emp_session_id == $files->file_received_emp_id || in_array(emp_session_id(),$multi_nm)) && $files->file_return != '1' & $this->uri->segment(3) == '' ? '<a href="'.base_url().'dashboard/dealing_legis/'.$files->file_id.'" class="btn btn-sm btn-block btn-twitter" data-toggle="tooltip" data-original-title="Modify"><i class="fa fa-fw fa-edit"></i> बदलाव करें</a>' : false;
                                        echo   $files->file_hardcopy_status == 'received' && ($emp_session_id == $files->file_received_emp_id || in_array(emp_session_id(),$multi_nm)) ? '<button onclick="open_model6('.$files->file_id.',&#39;'.$files->file_status.'&#39;)" class="btn btn-sm btn-twitter btn-block rty6" value="'.$files->file_id.'" data-toggle="tooltip" data-original-title="Mark to DA">सहायक को अंकित करें</button>' : false;
                                        echo   $files->file_hardcopy_status == 'received' && ($emp_session_id == $files->file_received_emp_id || in_array(emp_session_id(),$multi_nm)) ? '<button onclick="open_model2('.$files->file_id.')" value="'.$files->file_id.'"  class="btn btn-sm btn-block btn-twitter upperuser" data-toggle="tooltip" data-original-title="Send to officer" data-file_section_id = "'.$files->file_mark_section_id.'">अधिकारी को भेजें</button> ' : false;
                                        echo   $files->file_hardcopy_status == 'received' && ($emp_session_id == $files->file_received_emp_id || in_array(emp_session_id(),$multi_nm)) ? '<button onclick="section_section('.$files->file_id.')" value="'.$files->file_id.'"  class="btn btn-sm btn-block btn-twitter sections_nm" data-toggle="tooltip" data-original-title="Section to Section movement">Section to Section</button> ' : false; //&& $this->uri->segment(3) != '' 
                                        echo   $files->file_hardcopy_status == 'received' && ($emp_session_id == $files->file_received_emp_id || in_array(emp_session_id(),$multi_nm)) ? '<a onclick="return confirm_send()" href="'.base_url().'manage_file_legislative/dispatch_file_byso/'.$files->file_id.'" class="btn btn-sm btn-instagram btn-block rty1" value="'.$files->file_id.'" data-toggle="tooltip" data-original-title="Send to Dispatch">जावक शाखा में भेजें</a> ' : false; //&& $files->file_return == '1' && $this->uri->segment(3)!='' 
                                        echo   $files->file_hardcopy_status == 'received' && ($emp_session_id == $files->file_received_emp_id || in_array(emp_session_id(),$multi_nm)) ? '<button onclick="open_model_dispose('.$files->file_id.')" class="btn btn-sm btn-block btn-danger rty1" value="'.$files->file_id.'" data-toggle="tooltip" data-original-title="Dispose in section">शाखा में Dispose</button> ' : false;

                                        $section_exp = explode(',',getEmployeeSection());
                                        $section_11 = array('28');
                                        if(array_intersect($section_exp, $section_11)){
 

                                        }
                                        echo   $files->file_hardcopy_status == 'received' && $emp_session_id == $files->file_received_emp_id ? '<button onclick="open_model5('.$files->file_id.')" value="'.$files->file_id.'"  class="btn btn-block btn-sm btn-instagram" data-toggle="tooltip" data-original-title="Return to CR">अवाक शाखा में भेजें</button> ' : false; //&& ($this->uri->segment(3)=='1' || $this->uri->segment(1)=='today')
										echo   ($files->file_hardcopy_status == 'received' || $files->file_hardcopy_status == 'working' ) && emp_session_id() == $files->file_received_emp_id ? '<button type="button" class="btn btn-sm btn-primary btn-block remarkbtn_model" data-file_id="'.$files->file_id.'" data-toggle="modal" data-target="#remarkmodel_all_section" data-toggle="tooltip" data-original-title="फाइल से  सम्बंधित रिमार्क जोड़ें ">रिमार्क जोड़े</button> ' : false;
                                        ?>
                                        <input type="hidden" class="mark_sec" value="<?php echo $files->file_mark_section_id ; ?>">
                                    </td>
                                </tr>
                                <?php $i++; } ?>
                            </tbody>
                        </table>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>

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
                url: HTTP_PATH + "view_file_legislative/section_da_name",
                datatype: "json",
                async: false,
                data: {file_id: file_id},
                success: function(data) {
                    var r_data = JSON.parse(data);
                    var otpt = '<select class="form-control" id="daname_multiple" name="emp_id"><option value="">सहायको का चयन करें</option> ';
                    $.each(r_data, function( index, value ) {
                        otpt += '<option value="'+value.emp_id+'">'+value.emp_full_name+'</option>';
                    });
                    otpt += '</select>';
                    $("#emp_byfile").html(otpt);
                }
            });
        });
                $(".upperuser").click(function () {
            var file_id = $(this).val();
            var file_section = $(this).data('file_section_id'); 
            var HTTP_PATH='<?php echo base_url(); ?>';
            $.ajax({
                type: "POST",
                url: HTTP_PATH + "view_file_legislative/upper_role_officer/"+file_id,
                datatype: "json",
                async: false,
                data: {file_id: file_id,
					file_section: file_section},
                success: function(data) {
                    var r_data = JSON.parse(data);
                    var otpt1 = '<select class="form-control" name="emp_id2">';
                    $.each(r_data, function( index, value ) {
                        if(value.emp_id == 27){
                            var sel = 'selected';
                        }else{ var sel = '';}						
						if(value.emp_detail_gender=='m'){
                            var fword_en='Shri';
                            var fword_hi='श्री';

                        }else if(value.emp_detail_gender=='f'){
                            var fword_en='shushri';
                            var fword_hi='सुश्री';
                        }
                        otpt1 += '<option value="'+value.emp_id+'" '+sel+'>'+fword_hi+' '+value.emp_full_name_hi+' ('+value.emprole_name_hi+')</option>';
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
                    $("#emp_byfile2").html(otpt1);
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
                    var otpt = '<select class="form-control" name="Da_name[]" multiple="multiple" id="daname_multiple" required="">';
                    $.each(r_data, function( index, value ) {
						if(value.emp_detail_gender=='m'){
								var fword_en='Shri';
								var fword_hi='श्री';

						}else if(value.emp_detail_gender=='f'){
								var fword_en='shushri';
								var fword_hi='सुश्री';
						}
                        otpt += '<option value="'+value.emp_id+'">'+fword_hi+' '+value.emp_full_name_hi+'</option>';
                    });
                    otpt += '</select>';
                    $("#emp_byfile5").html(otpt);

					$('#daname_multiple').multiselect({
						includeSelectAllOption: true
					});
					$('#btnSelected').on('click',function(){
						var selected = $("#daname_multiple option:selected");
						var message = "";
						selected.each(function () {
							message += $(this).text() + " " + $(this).val() + "\n";
						});
						alert(message);
					});
                }
            }); 
        }); 
    }); 


    function open_model(file){
        var file1 = file;
        $('#modal-id').val(file1);
        $('#modal-delete').modal('show');
    }
    function open_model2(file){
        var file2 = file;
        $('#modal-id2').val(file2);
        $('#modal-send_upper').modal('show');
        $('#form_submit_link').attr('action','<?php echo base_url() ;?>manage_file/Sendfile_upperofficer/'+file2);

    }
    function open_model3(file,file_status){
        var file3 = file;
		 check_file_status(file_status);
        $('#modal-receive_file').modal('show');
        $('#receive_file1').attr('action','<?php echo base_url() ;?>manage_file_legislative/receive_file_sectionno/'+file3);
    }
    function open_model5(file){
        var file5 = file;
        $('#modal-return_to_cr').modal('show');
        $('#cr_return').val(file5);
    }
    function open_model6(file,file_status){
        var file6 = file;
		 check_file_status(file_status);
        $('#modal-id5').val(file6);
        $('#modal-return_da_file').modal('show');
    }
    function open_model_dispose(file){
        var file_dis = file;
        $('#modal-dis').val(file_dis);
        $('#modal-dispose_file').modal('show');
    }
    function section_section(file){
        var filess = file;
        $('#modal-send_upper').modal('show');
        $('#form_submit_link').attr('action','<?php echo base_url() ;?>manage_file_legislative/section_to_section/'+filess);
    }
    function confirm_dispose(){
        return confirm('क्या आप Dispose करना  चाहते है!');
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
</script>

<div class="modal fade" id="modal-delete" data-backdrop="static">
    <div class="modal-dialog">
        <form action="<?php echo base_url() ;?>manage_file_legislative/return_file_da" method="post" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-edit"></i> टीप लिखें </h4>
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
        <!--- <form action="<?php echo base_url() ;?>manage_file_legislative/Sendfile_upperofficer" method="post" >-->
        <form method="post" id="form_submit_link">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-edit"></i> टीप लिखें </h4>
                </div>
                <div class="modal-body">
                    <div class="box-body table-responsive">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <!--  <input type="text" id="modal-id2" name="fileids2">-->
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
<!--receive model-->
<div class="modal fade" id="modal-receive_file" data-backdrop="static">
    <div class="modal-dialog">
        <form method="post" id="receive_file1">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-male"></i>फ़ाइल देने वाले का नाम</h4>
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
                                        <label>Section Receive</label>
                                        <?php $section_exp = explode(',',getEmployeeSection()); ?>
                                        <select class="form-control" name="section_mark1">
                                            <?php foreach($section_exp as $exp){ ?>
                                                echo '<option value="<?php echo $exp ?>"><?php echo getSection($exp) ?></option>
                                            <?php  } ?>
                                        </select>
                                    </div>
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
        <form role="form" method="post" action="<?php echo base_url()?>view_file_legislative/dealing_file/sent_to_da">
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
        <form role="form" method="post" action="<?php echo base_url()?>view_file_legislative/dealing_file/sent_to_da">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-edit"></i>टीप लिखें </h4>
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

                                    <?php   $section_exp1 = explode(',',getEmployeeSection());
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


<style type="text/css">
    #leave_employee_filter{
        clear: both;
    }
</style>