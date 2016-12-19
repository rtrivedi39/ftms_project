<!-- Content Header (Page header) -->
<?php
$file_from = file_from_type();
$high_bench =  highcourt_bench();
$emp_section = explode(',',$this->session->userdata('emp_section_id'));
$sub_sec_file_type = $this->input->get('sstype') != '' ? $this->input->get('sstype') : '';
?>
<?php if($this->uri->segment(1)=='efile' && $this->uri->segment(2)!=''){ /*this is use for view e-file*/ ?>
<?php }else{ ?>
    <section class="content-header">
        <h1>
            <?php echo $title; ?>
            <?php echo $sub_sec_file_type != '' ? '('.get_civil_file_type($sub_sec_file_type).')' : ''; ?>
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
					<?php if(in_array(2,$emp_section) || in_array(10,$emp_section)) {?>
					<select  id="section_file_type_ddl" name="section_file_type_ddl" class="form-control btn btn-sm btn-info " style="width:150px;font-size:16px;text-align:left">
						<option value="">फ़ाइल के प्रकार का चयन करें</option>
							<?php foreach(get_civil_file_type() as $ky => $dname){ ?>
								<option value="<?php echo $ky; ?>" <?php echo ($sub_sec_file_type != '' && $ky == $sub_sec_file_type) ? 'selected' : ''; ?>><?php echo $dname; ?> </option>				
							<?php } ?>
					</select> 
					<?php } ?>
                        <!--<button class="btn btn-block btn-info"><?php echo $this->lang->line('view_file_mark');?></button>-->
                        <button onclick="printContents('divname')" class="btn btn-primary no-print">Print</button>
                        <button class="btn btn-warning" onclick="goBack()" data-toggle="tooltip" data-original-title="Back"><?php echo $this->lang->line('Back_button_label'); ?></button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <?php // echo $this->session->flashdata('message'); ?>
                    <?php if($this->session->flashdata('message') || $this->session->flashdata('error')) {
                        $msg = $this->session->flashdata('message') ? 'success' : 'danger';
                        ?>
                        <div class="alert alert-<?php echo $msg; ?> alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <?php  echo $this->session->flashdata('message');
                            echo $this->session->flashdata('error'); ?>
                            <br/>
                        </div>
                    <?php }
                    ?>
					<div class="row">
						<div class="col-sm-5">
							<div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing <?php if(isset($_GET['per_page']) && !empty($_GET['per_page'])){ echo @$_GET['per_page'];}else{ if($total_files==0){ echo 0;}else{echo '1';}} ?> to <?php if($total_files==0){ echo 0;}else{ echo ($perpage+@$_GET['per_page']);} ?> of <span class="label label-primary">&nbsp;<?php echo $total_files; ?>&nbsp;</span> entries</div>
						<?php echo per_page_listing() ;?>
						</div>
						<div class="col-sm-7">
							<div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">							
								<?php  foreach ($links as $link) {
											echo $link;
										} 
								?>								
							</div>
							<form name="search_from" id="search_from" method="get">
								<div class="col-sm-5 pull-right">
									<!--<div id="example1_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="Section & CR number,Subject,UO No.& Date" aria-controls="example1"></label></div>-->
									<div class="input-group">
										<input type="search" required name="searchby" class="form-control" placeholder="Section no./CR no./Subject/UO No./Date/file sender name" aria-controls="example1">
										<div class="input-group-btn">
										  <button class="btn btn-success">खोजें</i></button>
										</div>
									  </div>								
								</div>
								
							</form>
						</div>
					</div>
					<div class="fix_table-container fix_maintable">
                    <?php } ?>
                    <table class="table table-bordered table-striped">
                        <thead style="background-color:white">
                        <tr>
                            <th><?php echo $this->lang->line('sno'); ?></th>
                            <th><?php echo $this->lang->line('view_file_subject'); ?></th>
                            <th><?php echo $this->lang->line('uo/letter_no'); ?></th>
                            <th><?php echo $this->lang->line('view_file_uo_letter_date'); ?></th>
                            <th><?php echo $this->lang->line('section_no1'); ?></th>
                            <th><?php echo $this->lang->line('view_file_mark_section_id'); ?></th>
                            <th>विभाग</th>
                            <th><?php echo $this->lang->line('date'); ?></th>
                            <th><?php echo $this->lang->line('filestatus'); ?></th>
                            <th><?php echo $this->lang->line('actions'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i=1; foreach ($get_files as $key => $files) {
						$diff=date_diff(date_create($files->file_update_date),date_create(date("Y-m-d")));
                $checkdate = $diff->format("%a");
                            if($this->uri->segment(2) == 'file_doc' || $this->uri->segment(4) == 'return'){ $show_r =  base_url()."view_file/document_path/index/".$files->file_id ; $target=""; }
                            else { $show_r =  base_url()."admin_notesheet_master/view_file_notesheet/".$notesheet_id."/".$section_id."/".$files->file_id ; $target="target='_blank'"; }?>
                            <tr <?php
                if($checkdate >= '3' && $checkdate <= '7') { echo "style='background-color:#F3E212' data-toggle='tooltip' data-original-title='३ दिन से अधिक विलंब'";
                } else if($checkdate >= '7' && $checkdate <= '10') { echo "style='background-color:#ffb743' data-toggle='tooltip' data-original-title='७ दिन से अधिक विलंब'";
                } else if($checkdate >= '10') { echo "style='background-color:#FFA4A4' data-toggle='tooltip' data-original-title='१० दिन से अधिक विलंब'";}
                ?>>
                                <td><?php echo $i;?> <span style="display:none">(<?php echo $this->lang->line('file_no'); ?> : <?php echo $files->file_id;?>)</span>  <br/>
                                    CR-<?php @$fno = getfilesec_id_byfileid($files->file_id,'1',$files->file_type,$files->file_mark_section_id); if($fno==null){ echo getfilesec_id_byfileid($files->file_id,'1') ? getfilesec_id_byfileid($files->file_id,'1') : 'N/A' ;}else{ echo $fno;} ?></td>
                                <td><?php echo $files->file_subject;?>
                                    <br><?php if(!empty($files->scan_id)){
                                        show_scan_file($files->scan_id);
                                    }?>
                                    <br><?php if(isset($files->file_status) && $files->file_status != '') {show_file_status($files->file_status);}?>

                                </td>
                                <td><?php echo $files->file_uo_or_letter_no; ?> (<?php echo getFileType($files->file_type) ;?>)</td>
                                <td><?php echo date_format(date_create($files->file_uo_or_letter_date), 'd/m/y'); ?></td>
                                <td style="font-size:18px;">
									<a href="<?php echo base_url()."view_file/viewdetails/".$files->file_id ;?>" data-toggle="tooltip" data-original-title="View details">
									<span class="label label-success" title="शाखा पंजी क्र."><?php echo getfilesec_id_byfileid($files->file_id,$files->file_mark_section_id);?></span>
									</a>
									</td>
                                <td><?php echo getSection($files->file_mark_section_id); ?></td>
                                <td><?php
                                    if(isset($files->file_Offer_by )){
                                        echo   $files->file_Offer_by == 'c' || $files->file_Offer_by == 'jvn' ? $file_from[$files->file_Offer_by] ." , ". $files->district_name_hi : false ;
                                        echo   $files->file_Offer_by == 'm' || $files->file_Offer_by == 'u' ? $file_from[$files->file_Offer_by] ." , ". (isset($high_bench[$files->court_bench_id])?$high_bench[$files->court_bench_id]:'')  : false ;
                                        echo   $files->file_Offer_by == 'sc' ? $file_from[$files->file_Offer_by] ." , Delhi , दिल्ली" : false ;
                                        echo   $files->file_Offer_by == 'v' || $files->dept_name_hi ? (isset($file_from[$files->file_Offer_by])?$file_from[$files->file_Offer_by]:'')  ." , ". $files->dept_name_hi ." ".$files->file_department_name : $files->file_department_name;
                                    }
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
                                    } ?></td>
                                <td>
                                    <?php

                                    if((($this->uri->segment(1)=='e-files' || $this->uri->segment(1)=='efile') && $files->final_draft_id!='') || ($this->uri->segment(1)=='view_file' && $files->final_draft_id=='') || ($this->uri->segment(1)=='attached' && $files->final_draft_id=='')) //
                                    {
										
                                        $is_draft_detail=null;
                                        $is_draft_detail = is_notehseet_finalized($files->file_id,emp_session_id(),null,'loggedin_usr_draf_added',true);
                                        $senderemp = empdetails($files->file_received_emp_id);
                                        $emp_section = getEmployeeSection();
										$efile = show_efile_section($emp_section);
										$sections = explode(',',$emp_section);
                                        echo   ($this->uri->segment(1) != 'e-files' && $this->uri->segment(1) != 'efile') && $files->file_hardcopy_status != 'not' && emp_session_id() == $files->file_received_emp_id  ? '<a href="'.$show_r.'?temp=y&fs=p"  '.$target.' class="btn btn-block btn-sm btn-twitter" data-toggle="tooltip" data-original-title="Add doccument">दस्तावेज संलग्न करें</a>' : false;
                                        echo   $files->file_hardcopy_status != 'not' && $this->uri->segment(1) == 'e-files'  && emp_session_id() == $files->file_received_emp_id  ? '<a href="'.base_url().'efile/'.$files->file_id.'"  class="btn btn-block btn-sm btn-warning" data-toggle="tooltip" data-original-title="E-file">ई- फाइल जोड़े</a>' : false;

                                        //echo   $files->file_hardcopy_status == 'not' && emp_session_id() == $files->file_received_emp_id? '<a onclick="return confirm_receive()" href="'.base_url().'view_file/dealing_file/receivebyAD/'.$files->file_id.'" class="btn btn-block btn-sm btn-twitter"><span class="blink_fast" data-toggle="tooltip" data-original-title="Receive">'.$this->lang->line('receive_file').'</span></a>' : false;
                                        if($files->file_hardcopy_status == 'not' && emp_session_id() == $files->file_received_emp_id)  {  ?>
                                            <a onclick="receive_DA(<?php echo $files->file_id ;?>,'<?php echo $files->file_status ;?>');" class="btn btn-block btn-sm btn-twitter"  data-toggle="tooltip" data-original-title="Receive file"><span class="blink_fast" ><?php echo $this->lang->line('receive_file') ?></span></a>
                                        <?php }
                                        if($files->file_hardcopy_status == 'received'){
                                            if($efile == 'efile' && emp_session_id() == $files->file_received_emp_id){ ?>
                                                <a href="<?php echo base_url();?>scan/dealing/<?php echo $files->file_id; ?>" class="btn btn-block btn-sm btn-twitter" data-toggle="tooltip" data-original-title="Modify"><i class="fa fa-fw fa-edit"></i> बदलाव करें </a>
                                             <?php } else {
                                                echo $files->file_hardcopy_status == 'received' && emp_session_id() == $files->file_received_emp_id  ? '<a href="' . base_url() . 'dashboard/dealing/' . $files->file_id . '" class="btn btn-block btn-sm btn-twitter" data-toggle="tooltip" data-original-title="Modify"><i class="fa fa-fw fa-edit"></i>बदलाव करें</a>' : false;
                                            }}
											if($files->file_hardcopy_status != 'not' && emp_session_id() == $files->file_received_emp_id){ ?>											 
										<button type="button" onclick="open_model_csu(<?php echo $files->file_id; ?>);" class="btn btn-block btn-sm btn-instagram btn_mark_csu"  data-file_status12 = "<?php echo $files->file_status; ?>"  data-toggle="tooltip" data-original-title="Mark to scan unit for add PDF">Mark to CSU</button>
											<?php } 
                                        if((isset($is_draft_detail['draft_status']) && ($is_draft_detail['draft_status']==3 || $is_draft_detail['draft_status']==2)) || ($this->uri->segment(1)=='view_file' && strtolower($files->file_status)=='p') || ($this->uri->segment(1)=='attached' && strtolower($files->file_status)=='p')){
                                            /*Fore E-File*/
                                            echo   $files->file_hardcopy_status != 'not' && emp_session_id() == $files->file_received_emp_id  ? '<a href="#" onclick="receive_SO('.$files->file_id.',&#39;'.$files->file_status.'&#39;);" class="btn btn-block btn-sm btn-success" data-toggle="tooltip" data-original-title="Send to SO">एस. ओ. को भेंजे</a>' : false;
                                        }
                                       // echo   ($files->file_hardcopy_status == 'working' || $files->file_hardcopy_status == 'received' ) && emp_session_id() == $files->file_received_emp_id  && $files->file_return == '1' ? '<a onclick="return confirm_send()" href="'.base_url().'manage_file/dispatch_file_byso/'.$files->file_id.'" class="btn btn-block btn-sm btn-instagram rty1" value="'.$files->file_id.'" data-toggle="tooltip" data-original-title="Send to Dispatch">जावक शाखा में भेजें</a> ' : false;

										if(in_array(11,$sections) || in_array(12,$sections) ){
											echo ($files->file_hardcopy_status == 'working' || $files->file_hardcopy_status == 'received' ) && emp_session_id() == $files->file_received_emp_id ?  '<button type="button" class="btn btn-sm btn-instagram btn-block rty1 dispatch_btn" data-toggle="modal" data-file_id="'.$files->file_id.'" id="" data-target="#dispatch_model" data-toggle="tooltip" data-original-title="Send to Dispatch"> जावक शाखा में भेजें</button>' : false;
										}else{
											echo ($files->file_hardcopy_status == 'working' || $files->file_hardcopy_status == 'received' ) && emp_session_id() == $files->file_received_emp_id ? '<a onclick="send_despetch_section('.$files->file_id.',&#39;'.$files->file_status.'&#39;)" class="btn btn-sm btn-success btn-block rty1" value="'.$files->file_id.'" data-toggle="tooltip" data-original-title="Send to Dispatch">जावक शाखा में भेजें</a> ' : false; // && $files->file_return == '1' 
                                        }
										echo   $files->file_hardcopy_status != 'not' && emp_session_id() == $files->file_received_emp_id   ? '<button onclick="open_model_dispose('.$files->file_id.')" class="btn btn-sm btn-block btn-danger rty1" value="'.$files->file_id.'" data-toggle="tooltip" data-original-title="Dispose in section"><i class="fa fa-sort-down"></i> शाखा में Dispose</button> ' : false;
                                        //for S.O. on leave sent to direct officer
                                        if((isset($is_draft_detail['draft_status']) && ($is_draft_detail['draft_status']==3 || $is_draft_detail['draft_status']==2)) || (($this->uri->segment(1)=='view_file'|| $this->uri->segment(1)=='attached') && strtolower($files->file_status)=='p')){
                                            /*Fore E-File*/
                                            echo   ($files->file_hardcopy_status == 'working' || $files->file_hardcopy_status == 'received' ) && emp_session_id() == $files->file_received_emp_id  ? '<button onclick="open_model2('.$files->file_id.',&#39;'.$files->file_status.'&#39;)" value="'.$files->file_id.'"  class="btn btn-sm btn-block btn-twitter upperuser" data-toggle="tooltip" data-original-title="Send to officer"><i class="fa fa-send"></i> एस. ओ. अवकाश पर</button> ' : false;
                                        }
                                    }else if(($this->uri->segment(1)=='e-files' || $this->uri->segment(1)=='efile') && $files->final_draft_id=='' && ($files->file_hardcopy_status == 'working' || $files->file_hardcopy_status == 'received' ) && emp_session_id() == $files->file_received_emp_id ){
                                        echo   $files->file_hardcopy_status != 'not' && $this->uri->segment(1) == 'e-files' && emp_session_id() == $files->file_received_emp_id  ? '<a href="'.base_url().'efile/'.$files->file_id.'"  class="btn btn-block btn-sm btn-warning" data-toggle="tooltip" data-original-title="E-file">ई- फाइल जोड़े</a>' : false;
                                    }else{
                                        if($files->final_draft_id='' && $files->file_hardcopy_status != 'received' ){
                                            echo 'यह फाइल, <a href="#" class="badge bg-light-blue" >फाइल देखें </a>से प्राप्त करें !';
                                        }else if($files->file_hardcopy_status != 'received' ){
                                            echo 'यह फाइल,  <a href="'.base_url().'e-files/inbox#'.$files->file_subject.'" class="badge bg-light-blue" >अंकित ई-फ़ाइलें (Inbox)</a>से प्राप्त करें !';
                                        }elseif($files->file_hardcopy_status=="received"){
                                            echo '<a href="'.base_url().'e-files/inbox#'.$files->file_subject.'" class="badge bg-light-blue" >अंकित ई-फ़ाइलें (Inbox)</a>पर कार्यवाही करें !' ;
                                        }
                                    }
									echo ($files->file_hardcopy_status == 'received' || $files->file_hardcopy_status == 'working' ) && emp_session_id() == $files->file_received_emp_id ? '<button type="button" class="btn btn-sm btn-primary btn-block remarkbtn_model" data-file_id="'.$files->file_id.'" data-toggle="modal" data-target="#remarkmodel_all_section" data-toggle="tooltip" data-original-title="Add to remark">रिमार्क जोड़े</button> ' : false;
                                    ?>
                                </td>
                            </tr>
                            <?php $i++; 
								unset($fno);
								} ?>
                        </tbody>
                    </table>
					<?php if($this->uri->segment(1)=='efile' && $this->uri->segment(2)!=''){ /*this is use for view e-file*/ ?>
<?php }else{ ?>
	<div id="bottom_anchor"></div> <!---use for fix table header-->
				</div>
					<div class="row">
							<div class="col-sm-5">
								<div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing <?php if(isset($_GET['per_page']) && !empty($_GET['per_page'])){ echo @$_GET['per_page'];}else{ if($total_files==0){ echo 0;}else{echo '1';}} ?> to <?php if($total_files==0){ echo 0;}else{ echo ($perpage+@$_GET['per_page']);} ?> of <span class="label label-primary">&nbsp;<?php echo $total_files; ?>&nbsp;</span> entries</div>
							</div>
							<div class="col-sm-7">
								<form name="search_from" id="search_from" method="get">
									<div class="col-sm-5 pull-right">
										<!--<div id="example1_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="Section & CR number,Subject,UO No.& Date" aria-controls="example1"></label></div>-->
										<div class="input-group">
											<input type="search" required name="searchby" class="form-control" placeholder="Section no./CR no./Subject/UO No./Date/file sender name" aria-controls="example1">
											<div class="input-group-btn">
											  <button class="btn btn-success">खोजें</i></button>
											</div>
										  </div>								
									</div>
									
								</form>
								<div class="dataTables_paginate paging_simple_numbers" id="example1_paginate" style="clear:both">							
									<?php  foreach ($links as $link) {
												echo $link;
											} 
									?>								
								</div>
								
							</div>
					</div>
<?php } ?>
                    <?php if($this->uri->segment(1)=='efile' && $this->uri->segment(2)!=''){ /*this is use for view e-file*/ ?>
                    <?php }else{ ?>    </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div><!-- /.row -->
    <!-- Main row -->
</section><!-- /.content -->
<?php } ?>
<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script type="text/javascript">
    function getphysical_file_from_log(file,file_status)
	{
		var empid =  "<?php echo emp_session_id()?>";
		
		var file_id = file;
		var HTTP_PATH='<?php echo base_url(); ?>';
		$.ajax({
			type: "POST",
			url: HTTP_PATH + "view_file/get_physical_file_from_log",
			datatype: "json",
			async: false,
			data: {file_id: file_id,file_status:file_status},
			success: function(data) {
				 var r_data = JSON.parse(data);
				 
				 console.log(r_data );
				if(r_data[0]['from_emp_id'] == empid ){
					$(".physical_file").prop( "checked", true );
					$(".physical_file").prop( "disabled", false );
					$(".physical_file").prop( "checked", true );
					$(".physical_file").prop( "disabled", false );
					$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="e">');
				}
				
			}
		});
	}
	
	
    $(document).ready(function () {
        var counter = 0;

        $("#addrow").on("click", function () {

            counter = $('#multiple_dispatch tr').length - 2;

            var newRow = $("<tr>");
            var cols = "";

            cols += '<td>प्रतिलिपि ' + counter + '</td><td><textarea name="dispatch_name[]"' + counter + '" rows="2" cols="50"></textarea></td>';
            

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


        
        $("#dispatch_btn").click(function () {
            var file_id = $(this).data('file_id'); 
            $('#dis_file_id').val(file_id);  
            var dept = $(this).closest("tr").find('td:eq(6)').text();
            $('#dept_name').val(dept);  

        });
    });
</script>
<script type="text/javascript">
    function open_model_dispose(file){
        var file_dis = file;
        $('#modal-dis').val(file_dis);
        $('#modal-dispose_file').modal('show');
    }

 /*   send to upper oficer*/
    function open_model2(file , file_status){
        var file2 = file;
		$(".physical_file").prop( "checked", false );
		$(".electronic_file").prop( "checked", false );
		$(".electronic_file").prop( "disabled", false );
		$(".physical_file").prop( "disabled", false );
		var efile = "<?php echo $this->uri->segment(1)?>";
		if(efile != 'e-files' && efile != 'efile'){

			 $(".physical_file").prop( "checked", true );
			 $(".physical_file").prop( "disabled", true );

			 $(".electronic_file").prop( "disabled", true );
			 $(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="p">');
		}
		else{
			$(".electronic_file").prop( "checked", true );
			$(".electronic_file").prop( "disabled", true );
			$(".physical_file").prop( "disabled", true );
			$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="e">');

			if(file_status == 'p'){
				$(".physical_file").prop( "checked", false );
				
				$(".electronic_file").prop( "checked", true );
				$(".electronic_file").prop( "disabled", true );
				$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="e">');
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
				$(".physical_file").prop( "disabled", true );
				$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="e"><input type="hidden"  name="file_status[]" class="form-group" value="p">');
				
			}
			if(efile=='efile' || efile =='e-files' ){
				getphysical_file_from_log(file,file_status);  
			
				$(".physical_file").prop( "checked", false );
			}
			
		}
        $('#modal-id2').val(file2);
        $('#modal-send_upper').modal('show');
        $('#form_submit_upper').attr('action','<?php echo base_url() ;?>manage_file/Sendfile_upperofficer/'+file2);
    }
    /*Get upper user name*/
    $(".upperuser").click(function () {
        var file_id = $(this).val();
        var HTTP_PATH='<?php echo base_url(); ?>';
        $.ajax({
            type: "POST",
            url: HTTP_PATH + "view_file/upper_role_officer_list/"+file_id,   /*//for S.O. on leave sent to direct*/
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

                    if(value.emp_detail_gender=='m'){
                        var fword_en='Shri';
                        var fword_hi='श्री';

                    }else if(value.emp_detail_gender=='f'){
                        var fword_en='Shushri';
                        var fword_hi='सुश्री';
                    }
                    otpt1 += '<option value="'+value.emp_id+'" '+selected+'>'+fword_hi+' '+value.emp_full_name_hi+' ('+value.emprole_name_hi+')</option>';
                });
                otpt1 += '</select>';
                $("#emp_byfile2").html(otpt1);
            }
        });
    });

    function receive_SO(file,file_status){
     
        var file2 = file;
		$(".physical_file").prop( "checked", false );
		$(".electronic_file").prop( "checked", false );
		$(".electronic_file").prop( "disabled", false );
		$(".physical_file").prop( "disabled", false );
		var efile = "<?php echo $this->uri->segment(1)?>";
		if(efile != 'e-files' && efile != 'efile'){
			 $(".physical_file").prop( "checked", true );
			 $(".physical_file").prop( "disabled", true );
			 $(".electronic_file").prop( "disabled", true );
			 $(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="p">');
		}
		else{
			$(".electronic_file").prop( "checked", true );
			$(".electronic_file").prop( "disabled", true );
			$(".physical_file").prop( "disabled", true );
			$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="e">');

			if(file_status == 'p'){
				$(".physical_file").prop( "checked", false );
				
				$(".electronic_file").prop( "checked", true );
				$(".electronic_file").prop( "disabled", true );
				$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="e">');
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
				$(".physical_file").prop( "disabled", true );
				$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="e"><input type="hidden"  name="file_status[]" class="form-group" value="p">');
				
			}
			if(efile =='efile' || efile =='e-files' ){
				
				getphysical_file_from_log(file,file_status);  
				
				$(".physical_file").prop( "checked", false );
				
			}
			
		}
		$('#modal-id2').val(file2);
        $('#modal-so_send').modal('show');
        $('#form_submit_link').attr('action','<?php echo base_url() ;?>manage_file/dealing_manage_files/return_file_so/'+file2);
    }
    function check_dispetch_file(file_type){
       
        if(file_type == 'नस्ती'){
			$(".suspense_slip_div_latter").hide();
            $(".suspense_slip_div_file").show();     
            $("#btn-delete" ).removeClass( "disabled" );
            $("#remark-dis" ).prop('required',true);
            $("#select_send_file" ).prop('required',true);
			$(".vibhag").val('');
			$(".mahadhivakta").val('');
			$(".dept_name").val('');
			
        }else{
            $(".suspense_slip_div_latter").show();
            $(".suspense_slip_div_file").hide();
            $("#btn-delete" ).removeClass( "disabled" );
			$("#remark-dis" ).prop('required',false);
			$("#select_send_file" ).prop('required',false);
			$("#select_send_file" ).val('');
			$("#file_department_id").hide();			
			$("#other_place_file").hide();
			$("#file_department_id").val('');			
			$("#other_place_file").val('');
        }
    }
	
	$(document).ready(function () {
		$("#select_send_file").change(function () {
			var send_file = $(this).val();
			if(send_file == 'विभाग'){
				 $("#file_department_id").show();			
				 $("#other_place_file").hide();			
			} else if(send_file == 'अन्य'){
				$("#file_department_id").hide();			
				$("#other_place_file").show();	
			} else {
				$("#file_department_id").hide();			
				$("#other_place_file").hide();
				$("#file_department_id").val('');			
				$("#other_place_file").val('');
			}
		});
		
		 /*dispatch button on click*/
        $(".dispatch_btn").click(function () {
            var file_id = $(this).data('file_id'); /**/
            $('.dis_file_id').val(file_id);  /*//set model file_id*/
            var dept = $(this).closest("tr").find('td:eq(6)').text();
            $('.dept_name').val(dept);  /*//set model file_id*/

        });
    });
</script>

<!-- send to upper office-->
<div class="modal fade" id="modal-send_upper" data-backdrop="static">
    <div class="modal-dialog">
        <!--<form action="<?php //echo base_url() ;?>manage_file/Sendfile_upperofficer" method="post" >-->
        <form method="post" id="form_submit_upper">
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
                                    <input type="hidden" id="modal-id2" name="fileids2">
                                    <textarea class="form-control" rows="3" placeholder="Enter ..." id="modal-id" name="rmk1"></textarea>
                                    <br/>
                                    <div id="emp_byfile2"></div>
                                </div>
                                <div class="form-group pull-right">
                                    <input type="checkbox" class="physical_file" id="physical_file" name="file_status[]"  value="p" >Physical File
                                    <input type="checkbox" class="electronic_file" id="electronic_file" name="file_status[]" value="e" >E-File
                                </div>
								<div class="efile_div"></div>
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
                                    <div class="col-xs-6">जावक शाखा में क्या भेजना चाहते है ?  </div>
                                    <div class="col-xs-3"> <label class="radio"><input type="radio" name="file_types" required value="पत्र" id="dispetch_latter" onclick="check_dispetch_file(this.value);" checked>पत्र </label>
                                    </div>
                                    <div class="col-xs-3"><label class="radio"><input type="radio" name="file_types" required value="नस्ती" id="dispetch_file" onclick="check_dispetch_file(this.value);" >नस्ती</label>
                                    </div>
                                </div>
                            </div>                            

                                <div class="col-xs-12">
                                    <input type="hidden" class="dis_file_id" name="dis_file_id">                                    


                                    <br/>
									<div class="row suspense_slip_div_file" style="display:none;">

										<table id="" class="m_dispatch gridtable multiple_dispatch" border="1px" style="font-size:13px;" width="100%">
                                        <tbody>
                                        <tr><td>नस्ती कहाँ जानी है</td><td>
                                                <select name="dispatch_name[]" id="select_send_file">

                                                    <option value="">चयन करें </option>
                                                    <option value="मान0  विधि मंत्री जी">मान0  विधि मंत्री जी</option>
                                                    <option value="मुख्य सचिव">मुख्य सचिव</option>
                                                    <option value="विभाग">विभाग</option>
                                                    <option value="अन्य">अन्य</option>
                                                </select>
                                            </td></tr>
											<tr><td></td><td>
								                <select class="form-control" name="dispatch_name[]" id="file_department_id" style="display:none;">
                                                    <option value=""> विभाग का चयन करें</option>
                                                    <?php
                                                    $departments_list = get_list(DEPARTMENTS, 'department_default_no', null,'ASC');
                                                    foreach($departments_list as $row){ ?>
                                                        <option ><?php echo @$row['department_default_no']==1000 ? '' :  $row['dept_name_hi']; ?></option>
                                                    <?php } ?>
                                                </select>
												<textarea name="dispatch_name[]" id="other_place_file"  rows="2" cols="50" style="display:none;" placeholder="अन्य जगह का नाम लिखे"></textarea>
											</td></tr>
                                        </tbody>                                
                                    </table>
                                </div>                           
								<div class="row suspense_slip_div_latter">             
                                    <table id="" class="m_dispatch gridtable multiple_dispatch" border="1px" style="font-size:13px;" width="100%">
                                        <tbody>
                                        <tr><td>प्रति</td>
											<td>
											<textarea name="dispatch_name[]" rows="2" cols="50" class="dept_name"></textarea>

                                            </td>
										</tr>
                                        <tr style="display:none;" ><td>प्रतिलिपि </td>
											<td>

                                                <select name="dispatch_name_lists" id="ddl_dipatch_lists">
                                                    <option value="">--विकल्प चुने--</option>
                                                    <option value="1">विभाग </option>
                                                    <option value="2">महाधिवक्ता </option>
                                                </select>

                                            </td>
										</tr>

                                        <tr  id="vibhag"><td>प्रतिलिपि 1</td>
											<td>
                                                <select name="dispatch_name[]"  class="vibhag" multiple="true">
                                                    <option value="">--विभाग चुने--</option>
                                                    <?php foreach(getDepartments() as $row) { ?>
                                                         <option value="<?php echo $row->dept_name_hi; ?>"><?php echo $row->department_default_no.'-'.$row->dept_name_hi; ?></option>
                                                    <?php } ?>
                                                </select>

                                            </td>
										</tr>

                                        <tr  id="mahadhivakta"><td>प्रतिलिपि 2</td>
											<td>
                                                <select name="dispatch_name[]" class="mahadhivakta" multiple="true">
                                                    <option value="">--महाधिवक्ता चुने--</option>
                                                    <option value="महाधिवक्ता, मान0  उच्च न्यायालय, जबलपुर, मध्यप्रदेश">महाधिवक्ता, मान0  उच्च न्यायालय, जबलपुर, मध्यप्रदेश </option>
                                                    <option value="अतिरिक्त महाधिवक्ता, मान0  उच्च न्यायालय खण्डपीठ, इंदौर, मध्यप्रदेश">अतिरिक्त महाधिवक्ता, मान0  उच्च न्यायालय खण्डपीठ, इंदौर, मध्यप्रदेश </option>
                                                    <option value="अतिरिक्त महाधिवक्ता, मान0  उच्च न्यायालय खण्डपीठ, ग्वालियर, मध्यप्रदेश">अतिरिक्त महाधिवक्ता, मान0  उच्च न्यायालय खण्डपीठ, ग्वालियर, मध्यप्रदेश </option>
                                                </select>

                                            </td>
										</tr>

                                        </tbody>
                                        <tfoot class="other">
											<tr>
											<td colspan="4" style="text-align: left;">
                                                <input type="button" class="addrow" value="अन्य प्रतिलिपि जोड़े" />
                                                <input type="hidden" value="" name="total_row" class="total_row">
											</td>
											</tr>
										</tfoot>
                                    </table>
                                </div>
								<br/>
								<textarea class="form-control" rows="3" placeholder="कोई टीप लिखें" id="remark-dis" name="remark"></textarea>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> रद्द</button>
                    <button id="btn-delete" type="submit" class="btn btn-primary send_btn" onclick="return confirm('क्या आप Dispatch करना  चाहते है!');"><i class="fa fa-check"></i> हाँ</button>
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

<div class="modal fade" id="modal-so_send" data-backdrop="static">
    <div class="modal-dialog">
        <!-- <form action="<?php echo base_url() ;?>manage_file/return_file" method="post" >-->
        <form id="form_submit_link" action="<?php echo base_url() ;?>view_file/dealing_file/receive_file_da" method="post" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-edit"></i>फाइल  SO को भेजे
					</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body table-responsive">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <input type="hidden" id="modal-id" name="fileids">
                                    <div class="form-group">
                                        <label>कृप्या सुनिश्चित करे की आप नस्ती/पत्र की E-file/P-file की कापी को भेजना चाहते हैं ?</label>
                                    </div>
                                    <div class="form-group checkbox">
                                        <label>
                                            <input type="checkbox" id="physical_file" name="file_status[]" class="form-group physical_file" value="p"  > Physical File
                                        </label>
                                        <label>
                                            <input type="checkbox" id="electronic_file" name="file_status[]" value="e" class="form-group electronic_file"  >E-File
                                        </label>
                                    </div>
									<div class="efile_div"></div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> रद्द</button>
                    <button id="btn-delete" type="submit" class="btn btn-primary"><i class="fa fa-check"></i> भेजें</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $this->load->view('open_popup_forda') ; ?>
<?php $this->load->view('open_popup_for_despetch') ; ?>