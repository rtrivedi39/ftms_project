<?php  $high_bench =  highcourt_bench();
$Employee_lists_estab =  get_establishment_employees('so')  ;
$files_year = $this->input->post('files_year') != '' ? $this->input->post('files_year') : date('Y');
foreach($Employee_lists_estab as $esta_emp){
	$establiment_empids[] = $esta_emp['emp_id'];
}?>
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
	<div class="row" id="">
		<div class="col-xs-12">
			<div class="box box-info">
				<div class="box-header no-print">
					<h3 class="box-title">Section </h3>
				</div>
				<div class="box-body" align="center">
					<?php $sections = get_list(SECTIONS, null, "section_id not in ('8','1','26')");
					$i=1; foreach($sections  as $key => $section){?>
						<?php if($this->uri->segment(1)=='today' && $this->uri->segment(2)=='files' ){ ?>
							<a href="<?php echo base_url().'today/files?section_id='.$section['section_id'] ; ?>" class="btn bg-<?php echo ($this->input->get('section_id') != '' && $this->input->get('section_id') == $section['section_id'] )? 'purple' : 'maroon ' ; ?> btn-flat margin" ><?php echo $section['section_name_hi'] ; ?></a>
						<?php }else{ ?>
							<a href="<?php echo base_url().'view_file/?section_id='.$section['section_id'] ; ?>" class="btn bg-<?php echo ($this->input->get('section_id') != '' && $this->input->get('section_id') == $section['section_id'] )? 'purple' : 'maroon ' ; ?> btn-flat margin" ><?php echo $section['section_name_hi'] ; ?></a>
						<?php } ?>
					<?php } ?>
					<?php if($this->uri->segment(1)=='today' && $this->uri->segment(2)=='files' ){ ?>
						<a href="<?php echo base_url().'today/files'?>" class="btn bg-olive  btn-flat margin" >सभी फाइलें देखें</a>
					<?php }else { ?>
					<a href="<?php echo base_url().'view_file'?>" class="btn bg-olive  btn-flat margin" >सभी फाइलें देखें</a>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
    <div class="row" id="divname">
	<div class="col-md-12"> 
     <div class="box">
        <div class="box-header">
        </div>
        <div class="box-body">
        <form method="post" action="<?php echo base_url(); ?>view_file/dispatch_file_list/search_files" class="no-print">
            <div class="col-xs-1">
                <label><b>पंजी क्र.</b></label>                              
            </div>
			<div class="col-xs-2">
				<select name="sections" class="form-control">
					<option value="">Select</option>
					<?php $empssection = empdetails(emp_session_id());
					foreach(explode(",",$empssection[0]['emp_section_id'])  as $empsec){ ?>
						<option value="<?php echo $empsec ?>" <?php echo @$this->input->post('sections') == $empsec ? "selected" : false?>><?php echo getSection($empsec) ; ?></option>
					<?php  }?>
				</select>
				<?php echo form_error('sections');?>
			</div>                            
            <div class="col-xs-2">
                <input type="text"  name="search_value" id="search_value" value="<?php echo @$this->input->post('search_value') ? $this->input->post('search_value') : ''  ?>" autocomplete="off" placeholder="Put Value"  class="form-control">
                <?php echo form_error('search_value');?>
            </div>   
				<div class="col-xs-2">             
				<select class="form-control" id="files_year" name="files_year">
				<?php $i = '2015';
				while($i <= date('Y')) { ?>
					<option value="<?php echo $i ; ?>" <?php echo $files_year == $i ? 'selected' : ''; ?>><?php echo $i ;?></option>
				<?php $i++; } ?>
				</select>
            </div> 
            <div class="col-xs-2">
					<select name="building_name" class="form-control">
					<option value="">Select</option>
					<?php foreach(building_name(true) as $key => $value) { ?>
						<option value="<?php echo $key; ?>" <?php echo @$this->input->post('building_name') == $key ? 'selected' : ''  ?>><?php echo $value; ?></option>
					<?php } ?>
					</select>
            </div><div class="col-xs-2">
					<select name="building_floor" class="form-control">
					<option value="">Select</option>
					<?php foreach(building_floor(true) as $key => $value) { ?>
						<option value="<?php echo $key; ?>" <?php echo @$this->input->post('building_floor') == $key ? 'selected' : ''  ?>><?php echo $value; ?></option>
					<?php } ?>
					</select>
            </div> 
            <div class="col-xs-1">
                <button type="submit" class="btn btn-success">Search</button>
            </div>                          
            <div class="col-xs-1">
                <a  class="btn btn-primary" href="<?php echo base_url(); ?>view_file">View all</a>                       
            </div>
        </form>
        </div>
    </div>
    </div>
    <?php //pr($get_files); ?>
        <div class="col-xs-12" >
            <div class="box" style="overflow: auto" >
                <div class="box-header">
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
                <table id="view_table_dispatch" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th class="no-print"><?php echo $this->lang->line('sno'); ?></th>
                        <th><?php echo $this->lang->line('section_no1'); ?> जावक</th>
                        <th><?php echo $this->lang->line('view_file_subject'); ?></th>
                        <th><?php echo $this->lang->line('uo/letter_no'); ?></th>
                        <th><?php echo $this->lang->line('view_file_uo_letter_date'); ?></th>
                        <th><?php echo $this->lang->line('view_file_mark_section_id'); ?>  का  <?php echo $this->lang->line('section_no1'); ?></th>
                        <th><?php echo $this->lang->line('date'); ?></th>
						<th class="no-print"> भेजने वाला विभाग</th>
						<th>विभाग जहाँ नस्ती जाना है</th>
						<th>अनुभाग</th>
                        <th class="no-print"><?php echo $this->lang->line('filestatus'); ?></th>
                        <th class="no-print" width="150px"><?php echo $this->lang->line('actions'); ?></th>
						<th>हस्ताक्षर</th>
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
								$dept_officer_number =  '0';
							}
							$dept_officer_email = isset($file_dept[0]['dept_officer_email']) ? $file_dept[0]['dept_officer_email'] : '';
							$file_open = $files->file_id.','.$dept_officer_number;

						}

						?>
						<tr class="row-gap">
							<td class="no-print"><?php echo $i;?> (<?php echo $this->lang->line('file_no'); ?> : <?php echo $files->file_id;?>)</td>
                            <td><b class="big_font">
								<?php //echo @getfilesec_id_byfileid($files->file_id,getusersection(emp_session_id()),$files->file_type) ? getfilesec_id_byfileid($files->file_id,getusersection(emp_session_id()),$files->file_type) : 'N/a' ;
									$rrt = all_getfilesec_id_byfileid($files->file_id);
									foreach($rrt as $rrt1){
										if($rrt1['section_id']==8){
											$sechi = explode('(',getSection($rrt1['section_id']));
											echo "<b>".$rrt1['section_number'] ."</b> - <span style='font-size: 12px'>".$sechi['0']."</span><br/>";
										}
									}
								?>
								<b><?php  if( ($files->file_hardcopy_status == 'received') && !empty($files->dispetch_file_type)){ ?>
								<a  onclick="create_suspense_slip(<?php echo $files->file_id ?>)" style="cursor:pointer" value="'.$files->file_id.'" data-toggle="tooltip" data-original-title="Create suspense slip "> suspense slip </a> 
								<?php } ?>
									
									</td>
							<td><?php echo $files->file_subject;?></td>
							<td><?php echo $files->file_uo_or_letter_no; ?> (<?php echo getFileType($files->file_type) ;?>)</td>
							<td><?php echo date_format(date_create($files->file_uo_or_letter_date), 'd/m/y'); ?></td>
							<td>
							<?php
								$rrt = all_getfilesec_id_byfileid($files->file_id);
								//pr($rrt);
								foreach($rrt as $rr){
									echo '<b class="big_font">'.get_panji_no_for_dispetch($rr['section_number'], $rr['section_id'],$files->file_created_date )."</b>";
									echo "<br>";
								}
								?>
							
							</td>
							<td><?php echo date_format(date_create($files->file_update_date), 'd/m/y'); ?>
								(<?php if($files->file_hardcopy_status == 'not'){ echo $this->lang->line('mark_date');} else { echo $this->lang->line('received_date');} ?>)
							</td>
							<td class="no-print"><b class="big_font" ><?php
							
									$file_from = file_from_type();
									$high_bench =  highcourt_bench();
								if( in_array($files->createfile_empid ,$establiment_empids ) && empty($files->file_Offer_by) ){
										echo "विधि एवं विधायी कार्य विभाग";
									}else{
									if(isset($files->file_Offer_by) && isset($file_from)) {
										echo   @$files->file_Offer_by == 'c' || @$files->file_Offer_by == 'jvn' ? (isset($file_from[$files->file_Offer_by])?$file_from[$files->file_Offer_by]:'') ." , ". @$files->district_name_hi." <br/>" : false ;
									}
									if(isset($files->file_Offer_by)  && isset($file_from)  || isset($high_bench)) {
										//pre($high_bench[$files->court_bench_id]);
										echo   @$files->file_Offer_by == 'm' || @$files->file_Offer_by == 'u' ? @$file_from[$files->file_Offer_by] ." , ". (isset($high_bench[$files->court_bench_id])?$high_bench[$files->court_bench_id]:'') : false ;

										echo   @$files->file_Offer_by == 'v' || @$files->dept_name_hi ?  @$files->dept_name_hi ." ".(isset($files->file_department_name)?$files->file_department_name:'') : (isset($files->file_department_name)?$files->file_department_name:'');
									}	
								}									
								?>
							</td>
							<td contenteditable="true">							
							<?php if( ($files->file_hardcopy_status == 'received' || $files->file_hardcopy_status == 'close' ) && emp_session_id() == $files->file_received_emp_id && $files->file_return == '2' ){ ?>
								<b class="big_font" ><?php 
									if(isset($files->dispatch_lists) && $files->dispatch_lists != '') {
										$dispatch_lists = json_decode($files->dispatch_lists);
										echo '<table>';
										foreach($dispatch_lists as $row){
											if($row != '' && $row != 'विभाग'){
												echo '<tr><td>'.$row.'</td>';
											}
											}
										echo '</table>';
									} else {
										$file_from = file_from_type();
										$high_bench =  highcourt_bench();
										if(isset($files->file_Offer_by) && isset($file_from)) {
											echo   $filetosent = @$files->file_Offer_by == 'c' || @$files->file_Offer_by == 'jvn' ? @$file_from[$files->file_Offer_by] ." , ". @$files->district_name_hi." <br/>" : false ;
										}
										if(isset($files->file_Offer_by)  && isset($file_from)  || isset($high_bench)) {
											//pre($high_bench[$files->court_bench_id]);
											echo  $filetosent = @$files->file_Offer_by == 'm' || @$files->file_Offer_by == 'u' ? @$file_from[$files->file_Offer_by] ." , ". $high_bench[$files->court_bench_id] : false ;
											echo   $filetosent = @$files->file_Offer_by == 'v' || @$files->dept_name_hi ?  @$files->dept_name_hi ." ".(isset($files->file_department_name)?$files->file_department_name:'') : (isset($files->file_department_name)?$files->file_department_name:'');
										}
									}?>
								</b>
							 <?php } else if($files->file_hardcopy_status != 'close' && $files->file_hardcopy_status == 'not') { ?>
							<form action="<?php echo base_url() ;?>manage_file/update_dispatch_file/" method="post" class="no-print">								
							<input type="hidden" id="dis_file_id" name="dis_file_id" value="<?php echo $files->file_id ; ?>">
							<table id="multiple_dispatch" class="m_dispatch gridtable" border="1px" style="font-size:13px;" width="100%">
								<tbody>
									<tr><td>नस्ती कहाँ जानी है </td><td><textarea name="dispatch_name[]" rows="2" cols="50"><?php $file_from = file_from_type(); $high_bench =  highcourt_bench();
										if(isset($files->file_Offer_by) && isset($file_from)) { echo   @$files->file_Offer_by == 'c' || @$files->file_Offer_by == 'jvn' ? @$file_from[$files->file_Offer_by] ." , ". @$files->district_name_hi." <br/>" : false ; }
										if(isset($files->file_Offer_by)  && isset($file_from)  || isset($high_bench)) { echo   @$files->file_Offer_by == 'm' || @$files->file_Offer_by == 'u' ? (isset($file_from[$files->file_Offer_by])?$file_from[$files->file_Offer_by]:'') ." , ". (isset($high_bench[$files->court_bench_id])?$high_bench[$files->court_bench_id]:'') : false ; echo   @$files->file_Offer_by == 'v' || @$files->dept_name_hi ?  @$files->dept_name_hi ." ".(isset($files->file_department_name)?$files->file_department_name:'') : (isset($files->file_department_name)?$files->file_department_name:'');}									
									?></textarea> <br/><input type="button" class="ibtnDel"  value="हटायें"></td></tr>
									<?php 
									if(isset($files->dispatch_lists) && $files->dispatch_lists != '') {
										$dispatch_lists = json_decode($files->dispatch_lists);
										if(isset($dispatch_lists)){
										foreach($dispatch_lists as $row){
											echo '<tr><td><input type="button" class="ibtnDel"  value="हटायें"></td>
											<td><textarea name="dispatch_name[]" rows="2" cols="50">'.$row.'</textarea></td>
											</tr>';									
										}
							 }		}
										?>
																								
									<tr  id="vibhag"><td>अन्य प्रतिलिपि चुने जो लिस्ट्स में नहीं है</td><td>
										<select name="dispatch_name[]"  class="vibhag" multiple="true">
											<option value="">--विभाग चुने--</option>
											<?php foreach(getDepartments() as $row) { ?>
												<option value="<?php echo $row->dept_name_hi; ?>"><?php echo $row->dept_name_hi; ?></option>
											<?php } ?>
										</select>
									</td></tr>
									<tr  id="mahadhivakta"><td>अन्य प्रतिलिपि चुने जो लिस्ट्स में नहीं है</td><td>
										<select name="dispatch_name[]" class="mahadhivakta" multiple="true">
											<option value="">--महाधिवक्ता चुने--</option>
											<option value="महाधिवक्ता, मान0  उच्च न्यायालय, जबलपुर, मध्यप्रदेश">महाधिवक्ता,जबलपुर </option>
											<option value="अतिरिक्त महाधिवक्ता, मान0  उच्च न्यायालय खण्डपीठ, इंदौर, मध्यप्रदेश">अतिरिक्त महाधिवक्ता,  इंदौर </option>
											<option value="अतिरिक्त महाधिवक्ता, मान0  उच्च न्यायालय खण्डपीठ, ग्वालियर, मध्यप्रदेश">अतिरिक्त महाधिवक्ता, ग्वालियर </option>
										</select>
									</td></tr>			
									<tr><td colspan="2" style="text-align: left;">
									<input type="button" class="addrow" value="अन्य प्रतिलिपि जोड़े" />
									<input type="hidden" value="" name="total_row" class="total_row"></td></tr>
								</tbody>
								<tfoot>											
									<tr><td style="text-align: left;">
										<button id="btn-delete" type="submit" class="btn btn-primary" onclick="return confirm('क्या आप प्राप्त  करना  चाहते है!');"><i class="fa fa-check"></i> <?php echo $this->lang->line('receive_file'); ?></button>
									</td>
									<td>
									<?php echo  (emp_session_id() == $files->file_received_emp_id)  ? '<a data-toggle="tooltip" data-original-title="वापस  शाखा में भेजें"  onclick="open_model_cr('.$files->file_id.')" class="btn btn-sm btn-danger" data-toggle="tooltip" data-original-title="Reject"><i class="fa fa-reply"></i> अस्वीकारे</a>' : false; ?>
									</td>
									</tr>
								</tfoot>
									
							</table>
							</form>
							 <?php } ?>							
							</td>					
									
							<td><?php echo getSection($files->file_mark_section_id,$isshort = false); ?></td>
							<td class="no-print"> <?php
								$filereceiver = get_user_details($files->file_received_emp_id);
								if ($filereceiver) {
									if($files->file_hardcopy_status == 'not') {
										echo file_not_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi);
									   // echo "<span style='color:#dd4b39'><b>".$filereceiver[0]->emp_full_name_hi."</b> के द्वारा प्राप्त नहीं की गयी</br>(".$filereceiver[0]->emprole_name_hi.")</span>";
									} else if($files->file_hardcopy_status == 'close') {
										echo file_closed_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi, $files->file_type);
									   // echo "<span style='color:#dd4b39'><b>".$filereceiver[0]->emp_full_name_hi."</b> के द्वारा ".getFileType($files->file_type)."बंद की गयी</br>(".$filereceiver[0]->emprole_name_hi.")</span>";
									} else{
										echo file_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi);
									   // echo "<span style='color:#00a65a'><b>".$filereceiver[0]->emp_full_name_hi."</b> के द्वारा प्राप्त  की गयी</br>(".$filereceiver[0]->emprole_name_hi.")</span>";
									}
								} ?></td>
							<td class="no-print">
								<?php $senderemp = empdetails($files->file_sender_emp_id);
							    // echo   $files->file_hardcopy_status == 'not' && emp_session_id() == $files->file_received_emp_id ? '<a onclick="return confirm_receive()" href="'.base_url().'manage_file/receive_file_dispatch/'.$files->file_id.'" class="btn btn-twitter"><span class="blink_fast">'.$this->lang->line('receive_file').'</span></a>' : false;
								echo   $files->file_hardcopy_status == 'not' && emp_session_id() == $files->file_received_emp_id && $files->file_return == '2' && $empdetails[0]['role_id'] != '8' && $empdetails[0]['role_id'] != '37' ? '<a onclick="return confirm_receive()" href="'.base_url().'manage_file/receive_by_officer/'.$files->file_id.'" class="btn btn-twitter"><span class="blink_fast" data-toggle="tooltip" data-original-title="Receive">'.$this->lang->line('receive_file').'</span></a>' : false;   
								
								//echo   $files->file_hardcopy_status == 'not' && emp_session_id() == $files->file_received_emp_id && ($empdetails[0]['role_id'] == '8' || $empdetails[0]['role_id'] == '37')  ? '<button type="button" class="btn btn-sm btn-instagram btn-block" data-toggle="modal" data-file_id="'.$files->file_id.'" id="dispatch_btn" data-target="#dispatch_model" data-toggle="tooltip" data-original-title="Receive">'.$this->lang->line('receive_file').'</span></button>' : false;
								//echo emp_session_id();
								//echo $files->file_return;
								echo   $files->file_hardcopy_status == 'received' && emp_session_id() == $files->file_received_emp_id && $files->file_return == '2' && ($empdetails[0]['role_id'] == '8' or $empdetails[0]['role_id'] == '37') ? '<button onclick="open_model('.$files->file_id.')" class="btn btn-block btn-twitter rty1" value="'.$files->file_id.'" data-toggle="tooltip" data-original-title="Mark Dealing Assistant">सहायक को अंकित करें</button>' : false;
								echo   $files->file_hardcopy_status == 'received' && emp_session_id() == $files->file_received_emp_id && ($files->file_return == '2' || $files->file_return == '1') ? '<button onclick="open_model2('.$file_open.')" data-fileid="'.$files->file_id.'" data-deptname="'.$dept_name_hi.'" data-officername="'.$dept_officer_nm.'" class="btn btn-block btn-twitter rty1" id="sende_data" value="'.$files->file_id.'" data-toggle="tooltip" data-original-title="Close File">बंद करें</button>' : false;
								?>
							</td>
							<td></td>
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
<script>

function open_model_cr(file){
	var file5 = file;
	$('#modal-return_to_section').modal('show');
	$('#cr_return').val(file5);
	$('#form_submit_section').attr('action','<?php echo base_url()?>manage_file/reject_dispacthto_section/'+file5);
}

</script>

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
		/*mobile_number = mobile_number+','+'9425424554'; */
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
function create_suspense_slip(file){
	var file_id = file;
	 $('#modal-suspence_slip').modal('show');
	var HTTP_PATH='<?php echo base_url(); ?>';
            $.ajax({
                type: "POST",
                url: HTTP_PATH + "view_file/file_details_for_suspence",
                datatype: "json",
                async: false,
                data: {file_id: file_id},
                success: function(data) {
					
                    var r_data = JSON.parse(data);
					
					$("#section").text(r_data['file_from_section']);
					$("#section_no").text(r_data['panji_no']);
					$("#subject").text(r_data['file_subject']);
					$("#sent_department").text(r_data['dispetch_dept']);
					$("#create_date").text(r_data['file_come_in_dept']);
					$("#DA_teep").text(r_data['flog_remark']);
					$("#dispetch_no").text(r_data['dispetch_no']);
					
                   
                }
            });
        }
</script>
<div class="modal fade" id="modal-suspence_slip" data-backdrop="static">
    <div class="modal-dialog">
        <!-- <form action="<?php echo base_url() ;?>manage_file/return_file" method="post" >-->
        <form action="<?php echo base_url() ;?>manage_file/return_file_da" method="post" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-edit"></i>Create suspense slip </h4>
                </div>
                <div class="modal-body">
                    <div class="box-body table-responsive">
                        <div class="box-body">
                            <div class="row" id="suspence_slip_print">
                                <div class="col-xs-12">
									<div class="col-xs-12" align="center"><u><h3>विचाराधीन फाइल पंजी </h3></u></div>
									  <div class="row">
										<div class="col-xs-6">
										<label for="department"> विभाग :- </label>  विधि एवं विधायी कार्य विभाग 
										</div>
								
										<div class="col-xs-6">
										<label for="department"> शाखा :- </label>  <span id="section"></span> 
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-xs-6">
										<label for="department">पंजी क्रमांक :-  </label>  <span id="section_no"></span>
										</div>
										<div class="col-xs-6">
										<label for="department"> प्राप्ति दिनांक :- </label> <span id="create_date"></span>
										</div>
									</div>
									<br>
									<div class="row">
									<div class="col-xs-12">
									<label for="department">विषय :-  </label>  <span id="subject"></span>
									</div>
									</div>
									<br>
									<table width="100%">
										<tr><th>अंतिम आदेश की तारीख सारांश </th><th>कैफियत तथा स्मरण-पत्र की तारीख   </th></tr>
										<tr > <td rowspan="2"><span id="DA_teep" ></span></td><td> <label for="sent_department">नस्ती कहाँ भेजी गई है :-  </label>  <span id="sent_department"> </span></td></tr>
										<tr ><td><div class="col-xs-10"> <label for="dispetch_no">नस्ती का जावक क्र. :-  </label>   &nbsp;<span id="dispetch_no"></span>
										</div><br>
										<div class="col-xs-10"><label for="dispetch_date">जावक दिनांक :-   </label> 
										<span id="dispetch_date"></span></div><br><br><br>
										<div class="pull-right"><label for="sign_sheel">(हस्ताक्षर एवं सील जावक प्रभारी)  </label> </div>
										</td></tr>
									</table>
									
									
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                    <button id="btn-delete" type="submit" onclick="printContents('suspence_slip_print')" class="btn btn-primary"><i class="fa fa-check"></i> Print</button>
                </div>
            </div>
        </form>
    </div>
</div>
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
<!--receive model-->
<div class="modal fade" id="modal-return_to_section" data-backdrop="static">
    <div class="modal-dialog">
        <!--<form role="form" method="post" action="<?php echo base_url()?>view_file/Dealing_file/Sent_to_DA">-->
		<form method="post" id="form_submit_section">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-edit"></i> शाखा में भेजें</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body table-responsive">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <input type="hidden" id="cr_return" name="file_id1">
                                        <textarea class="form-control" rows="3" placeholder="Enter ..." id="modal-id" name="file_remark">फाइल की हार्ड कॉपी प्राप्त नहीं हुई</textarea>
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