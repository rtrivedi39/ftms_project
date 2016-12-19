<style>
    th{
        text-align: center !important; 
    }
</style>
<?php 
$Employee_lists_estab =  get_establishment_employees('so')  ;
$emp_session_id =  emp_session_id() ;
//pre($Employee_lists_estab);
foreach($Employee_lists_estab as $esta_emp){
	$establiment_empids[] = $esta_emp['emp_id'];
}
$emp_role_levele = get_emp_role_levele();
$userrole = checkUserrole();
$emp_section = explode(',',$this->session->userdata('emp_section_id'));
$sub_sec_file_type = $this->input->get('sstype') != '' ? $this->input->get('sstype') : '';
//pre($emp_section);
//echo $userrole;
?>
     <!--<link href="<?php echo ADMIN_THEME_PATH; ?>plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />-->
<!-- Content Header (Page header) -->
<?php if($this->uri->segment(1)=='efile' && $this->uri->segment(2)!=''){ /*this is use for view e-file*/ ?>
<?php }else{ ?>
<section class="content-header">
		<h1>
            <?php echo $title; ?> [<?php echo !empty($this->input->get('section_id')) ? getSection($this->input->get('section_id')) : 'सभी अनुभाग' ; ?>]
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
            <div class="box" style="overflow: auto" id="divname">
                <div class="box-header">
                    <div style="float:left"><h3 class="box-title"><?php echo $title_tab;?></h3></div>
                    <div style="float:right">
					<?php if(in_array(2,$emp_section) || in_array(10,$emp_section)) {?>
					<select  id="section_file_type_ddl" name="section_file_type_ddl" class="form-control btn btn-sm btn-info " style="width:150px;font-size:14px;text-align:left">
						<option value="">फ़ाइल के प्रकार का चयन करें</option>
						<?php foreach(get_civil_file_type() as $ky => $dname){ ?>
							<option value="<?php echo $ky; ?>" <?php echo ($sub_sec_file_type != '' && $ky == $sub_sec_file_type) ? 'selected' : ''; ?>><?php echo $dname; ?> </option>				
						<?php } ?> 
					</select>
					<?php } ?>
					<select disabled id="auto_file_received_value" class="form-control btn btn-sm btn-twitter auto_file_received_value" style="width:150px;font-size:14px;text-align:left">
							<option value="">चयनित नस्तिया प्राप्त करें</option>
							<option value="<?php echo $emp_session_id ;?>">केवल फाइल  को प्राप्त करें</option>
							<?php //$dalist= modules::run('view_file/section_da_name',true);?>
							<?php //foreach($dalist as $ky=>$dname){ ?>
								<!--<option value="<?php //echo $dname['emp_id']; ?>"><?php //if($dname['emp_detail_gender']=='m'){ $pre_name='श्री  '; }else if($dname['emp_detail_gender']=='f'){ $pre_name='सुश्री  ';}  echo  $pre_name.$dname['emp_full_name_hi']; ?> </option>-->				
							<?php //} ?>
						</select>
						<?php if( ($emp_role_levele['emprole_level'] == 6 || $emp_role_levele['emprole_level'] <= 5) && $userrole!='25' ){ ?>
                        <a href="<?php echo base_url();?>e-files/efile_sign"><button class="btn btn-sm btn-success" style="height:35px;font-size:14px;">फ़ाइल पर हस्ताक्षर जोड़ें </button></a>
						<?php } ?>
                        <!--<a class="btn btn-info"><?php echo $this->lang->line('view_file_mark');?></a>-->
						<button onclick="printContents('divname')" class="btn btn-primary no-print">Print</button>
                        <button class="btn btn-warning" onclick="goBack()"><?php echo $this->lang->line('Back_button_label'); ?></button>
                    </div>
                    <br/>
                </div><!-- /.box-header -->
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
                <?php }?>
                <?php $empssection = $em =  empdetails($emp_session_id);
						if($emp_session_id != $this->session->userdata('emp_id')){
                    ?>
                    <div class="callout callout-info lead">
                        <p>आप <b><?php echo emp_gender($emp_session_id) ." ". $em[0]['emp_full_name_hi'] ." (". getemployeeRole($em[0]['role_id']).")" ;?></b> को अंकित की गई फाइलें देख रहे है |</p>
                    </div>
                <?php  } ?>
                <div class="box-body" align="center">
                    <form method="post">
						<?php //$empssection = empdetails(emp_session_id());
                        if(isset($page1)) {$p1 = '/'.$page1;} else { $p1 = null;}
                        $i=1; foreach(explode(",",$empssection[0]['emp_section_id'])  as $empsec){
						//	pre($empsec);
							$section_shorting = get_section_shorting('section_shortid',$empsec);
							//pre($section_shorting);
							if($empsec==$section_shorting['section_id'] && $section_shorting['section_grouping']==1){
								$cls = "class='btn bg-purple btn-flat margin'";
							}else{
								$cls='';
							}if($empsec==$section_shorting['section_id'] && $section_shorting['section_grouping']==2){
								$cls1 = "class='btn bg-maroon btn-flat margin'";
							}else{
								$cls1='';
							}
							if($empsec==$section_shorting['section_id'] && $section_shorting['section_grouping']==3){
								$cls2 = "class='btn bg-blue btn-flat margin'";
							}else{
								$cls2='';
							}
							if($empsec==$section_shorting['section_id'] && $section_shorting['section_grouping']==4){
								$cls4 = "class='btn bg-green btn-flat margin'";
							}else{
								$cls4='';
							}
							if($empsec==$section_shorting['section_id'] && $section_shorting['section_grouping']==5){
								$cls5 = "class='btn bg-red btn-flat margin'";
							}else{
								$cls5='';
							}
							if($empsec==$section_shorting['section_id'] && $section_shorting['section_grouping']==6){
								$cls6 = "class='btn bg-yellow btn-flat margin'";
							}else{
								$cls6='';
							}
							if($empsec==$section_shorting['section_id'] && $section_shorting['section_grouping']==7){
								$cls7 = "class='btn bg-olive btn-flat margin'";
							}else{
								$cls7='';
							}
							if($empsec==$section_shorting['section_id'] && $section_shorting['section_grouping']==8){
								$cls8 = "style='background-color:#46b8da' class='btn bg-olive btn-flat margin'";
							}else{
								$cls8='';
							}
                            //if ($i%2 == 1) { $cls = "class='btn bg-purple btn-flat margin'"; }else{ $cls = "class='btn bg-maroon btn-flat margin'"; }
                            if (isset($empsec)) {
								if($empsec != '26'){?>								
								<a href="<?php echo current_url().'/?section_id='.$empsec ; ?>" <?php echo $cls; echo $cls1; echo $cls2; echo $cls4; echo $cls5; echo $cls6;echo $cls7;echo $cls8; ?> <?php echo $this->input->get('section_id') == $empsec ? 'disabled' : '' ?> ><?php echo getSection($empsec) ; ?></a>
								
								<?php }	} $i++; }?>
							<a href="<?php echo current_url().'/?section_id=oth' ; ?>" style='background-color:#46b8da;color:#fff' class='btn btn-flat margin' >(अन्य फाइलें) Other files</a>
						<?php 
                            $is_file_alloted= check_ps_monitor_file_is_alloted('count',$this->session->userdata("emp_id"));
                            if($is_file_alloted>0){?>
                        
                            <a title="View mark monitor files" class="btn bg-navy margin" href="<?php echo base_url().'ps_file_monitor' ; ?>">
    								पी .एस. मॉनिटर फ़ाइलें
    						</a>
                            <?php  } else if($empssection[0]['role_id']==3){ ?>
                                <a title="View mark monitor files" class="btn bg-navy margin" href="<?php echo base_url().'ps_file_monitor' ; ?>">
									पी. एस. मॉनिटर फ़ाइलें
                                </a>
                        <?php } ?>
                    </form>
                </div>
				<?php  if($this->input->get('section_id') == 11){ ?>
                 <div class="row no-gutter ">
                    <div class="form-group col-md-8 span9">
					<?php $section_category_array = section_category_array() //print_r();?><div class="form-group col-md-5" style="margin-left:10px">
                        <label for="section_file_categoty"><?php echo $this->lang->line('label_section_file_categoty'); ?> न्यायिक शाखा - I (Judicial branch -I) </label>
						</div>
						<div class="form-group col-md-5">
                        <select class="form-control" name="section_file_categoty" id="section_file_categoty" >
                            <option value=""><?php echo $this->lang->line('label_section_file_categoty'); ?></option>
                            <?php foreach($section_category_array as $key_sec_category=>$section_category){ ?>
									<option <?php if($this->input->get('cate') == $key_sec_category ) { echo "selected"; }?> value="<?php echo $key_sec_category; ?>" <?php if(isset($file_data[0]['section_file_categoty'])){ if(@$file_data[0]['section_file_categoty'] == $key_sec_category){ echo 'selected';} } else if($this->input->post('section_file_categoty') == $key_sec_category){ echo 'selected'; } ?>><?php echo $section_category; ?></option>
                            <?php } ?>
                            
                        </select>
                        <?php echo form_error('section_file_categoty');?>
                    </div>
					 </div>
					  </div>
					<?php } ?>
					<div class="row">
					<div class="col-sm-5">
						<div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing <?php if(isset($_GET['per_page']) && !empty($_GET['per_page'])){ echo @$_GET['per_page']+1;}else{ if($total_files==0){ echo 0;}else{echo '1';}} ?> to <?php if($total_files==0){ echo 0;}else{ echo ($perpage+@$_GET['per_page']);} ?> of <span class="label label-primary">&nbsp;<?php echo $total_files; ?>&nbsp;</span> entries</div>
						<?php echo per_page_listing() ;?>
					</div>
					<div class="col-sm-7">
						<div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">							
							<?php  foreach ($links as $link) {
										echo $link;
									} 
							?>								
						</div>
						<form name="search_from" id="search_from" method="get" action="<?php echo show_current_url(); ?>">
							<div class="col-sm-5 pull-right">
								<!--<div id="example1_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="Section & CR number,Subject,UO No.& Date" aria-controls="example1"></label></div>-->
								<div class="input-group">
									<?php if(isset($_GET['section_id']) && $_GET['section_id']!=''){?>
										<input type="hidden" name="section_id" value="<?php echo $_GET['section_id']?>">
									<?php } ?>
									<?php if(isset($_GET['sstype']) && $_GET['sstype']!=''){?>
										<input type="hidden" name="sstype" value="<?php echo $_GET['sstype']?>">
									<?php } ?>
									<input type="search" required name="searchby" class="form-control" placeholder="Section no./CR no./Subject/UO No./Date/file sender name" aria-controls="example1" value="<?php if(isset($_GET['searchby']) && $_GET['searchby']!=''){ echo $_GET['searchby'];} ?>">
									<div class="input-group-btn">
									  <button class="btn btn-success">खोजें</i></button>
									  <?php if(isset($_GET['searchby']) && $_GET['searchby']!=''){?>
										<a href="<?php echo reset_back_url();?>" class="btn btn-success">रिसेट करें</a>
									  <?php } ?>
									</div>
								  </div>								
							</div>							
						</form>
					</div>
				</div>
				<div class="fix_table-container">
<?php } ?>
    <table class="table table-bordered fix_maintable">
                    <thead  style="background-color:white">
                    <tr>
                        <!--<th><button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button></th>-->
                        <th data-bSortable="false"><?php echo $this->lang->line('sno'); ?></th>
                        <th><?php echo $this->lang->line('view_file_subject'); ?></th>
                        <th><?php echo $this->lang->line('uo/letter_no'); ?></th>
                        <th><?php echo $this->lang->line('view_file_uo_letter_date'); ?></th>
                        <th><?php echo $this->lang->line('section_no1'); ?></th>
                        <th><?php echo $this->lang->line('view_file_mark_section_id'); ?></th>
                        <th>विभाग</th>
                        <th><?php echo $this->lang->line('date'); ?></th>
                        <th class="no-print"><?php echo $this->lang->line('filestatus'); ?></th>
                        <th class="no-print"><?php echo $this->lang->line('actions'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(isset($get_files)) {
                        $i=1;$sn=1; 
						if(isset($_GET['per_page']) && $_GET['per_page']!=''){
								$sn=$_GET['per_page']+1;
						}
						foreach ($get_files as $key => $files) {
							$rrt = all_getfilesec_id_byfileid($files->file_id);
							$senderemp = empdetails($files->file_sender_emp_id);
							$diff=date_diff(date_create($files->file_update_date),date_create(date("Y-m-d")));
							$checkdate = $diff->format("%a");
							?>
							<tr aa <?php
							if($checkdate >= '3' && $checkdate <= '7') { echo "style='background-color:#F3E212' data-toggle='tooltip' data-original-title='३ दिन से अधिक विलंब'";
							} else if($checkdate >= '7' && $checkdate <= '10') { echo "style='background-color:#ffb743' data-toggle='tooltip' data-original-title='७ दिन से अधिक विलंब'"; //#FFE7BA
							} else if($checkdate >= '10') { echo "style='background-color:#FFA4A4' data-toggle='tooltip' data-original-title='१० दिन से अधिक विलंब'";}
							?>>
                                <!--<td><input type="checkbox" /></td>-->
                                <td>
									<?php echo $sn;?> <span style="display:none">(<?php echo $this->lang->line('file_no'); ?> : <?php echo $files->file_id;?>)</span><br/><?php foreach($rrt as $rrt2){ if($rrt2['section_id'] == '1'){  $crvalue = $rrt2['section_number']; }} ?><?php echo "CR-".$crvalue; ?>
									<br/>
									<input type="checkbox" class="chk_slct_file" id="row_id_<?php echo $files->file_id; ?>" value="<?php echo $files->file_id; ?>" name="fileIds" style="font-size:26px;"/>			
								</td>
								<td><?php echo $files->file_subject;?><br><?php if(isset($files->scan_id) && $files->scan_id != ''){ show_scan_file($files->scan_id);}?><br><?php if(isset($files->file_status) && $files->file_status != ''){show_file_status($files->file_status);}?></td>
                                <td><?php echo $files->file_uo_or_letter_no; ?> (<?php echo getFileType($files->file_type) ;?>)<br><span class="badge bg-light-blue"> प्रेषक नाम : <?php echo isset($files->file_sender_emp_id)? get_employee_gender($files->file_sender_emp_id)." ".$senderemp[0]['emp_full_name_hi'] :'' ?></span></td>
                                <td><?php if(isset($files->file_uo_or_letter_date) && $files->file_uo_or_letter_date != '0000-00-00'){ echo date_format(date_create($files->file_uo_or_letter_date), 'd/m/y'); } ?></td>
                                <td>
								<a href="<?php echo base_url()."view_file/viewdetails/".$files->file_id ;?>" data-toggle="tooltip" data-original-title="View details">
                                    <?php
									$section_id_check = '';
									foreach($rrt as $rrt1){ // $rrt1['section_id'] != $files->file_mark_section_id
                                        if($rrt1['section_id'] != '1'){
                                        $sechi = explode('(',getSection($rrt1['section_id']));
                                        echo "<b>".$rrt1['section_number'] ."</b> - <span style='font-size: 12px'>".$sechi['0']."</span><br/>";
                                   $section_id_check[] =  $rrt1['section_id'];
								   }} 
								  if(@!in_array($files->file_mark_section_id,$section_id_check)){
									echo "N/A";
									} 
								   ?>
								</a>
								</td>
                                <td><?php echo @$files->file_mark_section_id ? getSection($files->file_mark_section_id) : 'N/A'; ?></td>
                                <td><?php
                                    $file_from = file_from_type();
                                    $high_bench =  highcourt_bench();
									if( in_array($files->createfile_empid ,$establiment_empids ) && empty($files->file_Offer_by) ){
															echo "विधि एवं विधायी कार्य विभाग";
														}else{
									  if(isset($files->file_Offer_by)){
										echo   $files->file_Offer_by == 'c' || $files->file_Offer_by == 'jvn' ? (isset($file_from[$files->file_Offer_by])?$file_from[$files->file_Offer_by]:'') ." , ". (isset($files->district_name_hi)?$files->district_name_hi:'') : false ;
										echo    $files->file_Offer_by == 'm' || $files->file_Offer_by == 'u' ? (isset($file_from[$files->file_Offer_by])?$file_from[$files->file_Offer_by]:'') ." , ". (isset($high_bench[$files->court_bench_id])?$high_bench[$files->court_bench_id]:'') : false ;
										echo    $files->file_Offer_by == 'sc' ? (isset($file_from[$files->file_Offer_by])?$file_from[$files->file_Offer_by]:'') ." , Delhi , दिल्ली" : false ;
										echo    $files->file_Offer_by == 'v' || $files->dept_name_hi ? (isset($file_from[$files->file_Offer_by])?$file_from[$files->file_Offer_by]:'' )." , ". (isset($files->dept_name_hi)?$files->dept_name_hi:'') ." ". (isset($files->file_department_name)?$files->file_department_name:'') : (isset($files->file_department_name)?$files->file_department_name:'');
										}
									}
                                    ?>
                                </td>
                                <td class="no-print"><?php echo date_format(date_create($files->file_update_date), 'd/m/y'); ?>
                                    (<?php if($files->file_hardcopy_status == 'not'){ echo $this->lang->line('mark_date');} else { echo $this->lang->line('received_date');} ?>)
                                </td>
                                <td align="" class="no-print"><?php
                                    $filereceiver = get_user_details($files->file_received_emp_id);
                                    if ($filereceiver)
                                    {
										if($files->file_hardcopy_status == 'not') {
											echo file_not_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi,$filereceiver[0]->emp_detail_gender);
										} else if($files->file_hardcopy_status == 'close') {
											echo file_closed_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi, $files->file_type ,$filereceiver[0]->emp_detail_gender);
										} else{
											echo file_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi,$filereceiver[0]->emp_detail_gender);
										}
										 
                                        /*if($files->file_hardcopy_status == 'not') {
                                            echo "<span style='color:#dd4b39' >Not Received by <b> ".ucfirst($filereceiver[0]->emp_full_name)."</b><br/>(".$filereceiver[0]->emprole_name_hi.")</span>";
                                        } else {
                                            echo "<span style='color:#00a65a' >Received by <b> ".ucfirst($filereceiver[0]->emp_full_name)."</b><br/>(".$filereceiver[0]->emprole_name_hi.")</span>";
                                        }  */
									} ?></td>
                                <td align="center" class="no-print">
								<?php //if(isset($_GET['show']) && $_GET['show']=='law'){
										$is_file_section_efile = check_section_is_efile($files->file_mark_section_id);
										//pre($files->file_mark_section_id);
								//} ?>
								<?php if($files->final_draft_id!=''){ $is_signed = get_final_draft_isnotesheet(emp_session_id(),$files->file_id);
								//$file_value = empty($is_signed) ? 'जोड़े' : 'देखें';
                                    if(!empty($is_signed)){
                                        $file_value = 'देखें';
                                        $btn_1 = 'btn-github';
                                    }else{
                                        $file_value = 'जोड़े';
                                        $btn_1 = 'btn-warning';
                                    }
                                }else{ $file_value = '';}
								echo $this->uri->segment(1) =='e-files' && $files->file_hardcopy_status == 'received' && emp_session_id() == $files->file_received_emp_id && $files->final_draft_id!=''   ? '<a href="'.base_url().'efile/'.$files->file_id.'" class="btn btn-sm btn-block '.$btn_1.'"> ई- फाइल  '.$file_value.'</a>'  : false;  ?>
								<?php //if((($this->uri->segment(1)=='e-files' || $this->uri->segment(1)=='efile') && $files->final_draft_id!='') || ($this->uri->segment(1)=='view_file' && $files->final_draft_id=='' && strtolower($files->file_status)=='e' || strtolower($files->file_status)=='p,e' || strtolower($files->file_status)=='e,p')){ ?>
								<?php if((($this->uri->segment(1)=='e-files' || $this->uri->segment(1)=='efile') && $files->final_draft_id!='' && $is_file_section_efile=='efile') || ( ($this->uri->segment(1)=='view_file' && $files->final_draft_id=='') || ($files->final_draft_id!='' && $is_file_section_efile=='not_efile'))){ ?>

									
									<?php
									if($emp_session_id =='264'){
										$showmd=1;
									}else{$showmd=0;}
                                    //  echo   $files->file_hardcopy_status == 'received' && emp_session_id() == $files->file_received_emp_id && emp_session_id() != '2' ? '<a onclick="return confirm_send()" href="'.base_url().'manage_file/Send_file_us/'.$files->file_id.'" class="btn btn-sm btn-block btn-info">'.$this->lang->line('send_file_officer').'</a>' : false;
                                    $is_draft_detail=null;									
									$is_draft_detail = is_notehseet_finalized($files->file_id,$emp_session_id,null,'loggedin_usr_draf_added',true);
									if((isset($is_draft_detail['draft_status']) && ($is_draft_detail['draft_status']==3 || $is_draft_detail['draft_status']==2) && $files->file_received_emp_id == $this->session->userdata("emp_id")) || ($this->uri->segment(1)=='view_file' && (strtolower($files->file_status)=='p') || $files->file_status == '')){
									/*Fore E-File*/
										echo   $files->file_hardcopy_status == 'received' && $emp_session_id == $files->file_received_emp_id && $emp_session_id != '264' ? '<button onclick="open_model2('.$files->file_id.',&#39;'.$files->file_status.'&#39;)" value="'.$files->file_id.'" class="btn btn-sm btn-block btn-info upperuser">अधिकारी को भेजें</button>' : false;
										echo   ($this->uri->segment(1)!='e-files' && $this->uri->segment(1)!='efile') && $files->file_hardcopy_status == 'received' && $emp_session_id == $files->file_received_emp_id ? '<button onclick="open_model('.$files->file_id.','.$showmd.',&#39;'.$files->file_status.'&#39;)" value="'.$files->file_id.'" class="btn btn-sm btn-block btn-danger rty" data-mark_sec="'.$files->file_mark_section_id.'">'.$this->lang->line('send_to_down_officer').'</button>' : false;
                                        echo   ($this->uri->segment(1)=='e-files' || $this->uri->segment(1)=='efile') && $files->file_hardcopy_status == 'received' && $emp_session_id == $files->file_received_emp_id ? '<button onclick="open_model('.$files->file_id.','.$showmd.',&#39;'.$files->file_status.'&#39;)" value="'.$files->file_id.'" class="btn btn-sm btn-block btn-danger rty_efile" data-mark_sec="'.$files->file_mark_section_id.'" data-sender_empid ="'.$files->file_sender_emp_id.'"  data-sendreemprole = "'.$senderemp[0]['role_id'].'">'.$this->lang->line('send_to_down_officer').'</button>' : false;
									}                                   
                                    //  echo   $files->file_hardcopy_status == 'not' && emp_session_id() == $files->file_received_emp_id ? '<a onclick="return confirm_receive()" href="'.base_url().'manage_file/receive_by_officer/'.$files->file_id.'" class="btn  btn-twitter"><span class="blink_fast">'.$this->lang->line('receive_file').'</span></a>' : false;
                                    echo   $files->file_hardcopy_status == 'not' && $emp_session_id == $files->file_received_emp_id ? '<button onclick="open_model3('.$files->file_id.',&#39;'.$files->file_status.'&#39;)" class="btn btn-block btn-sm btn-twitter"><span class="blink_fast">'.$this->lang->line('receive_file').'</span></button>' : false;
									echo   $this->uri->segment(1)!='e-files' && $this->uri->segment(1)!='efile' && $files->file_hardcopy_status == 'not' && $emp_session_id == $files->file_received_emp_id ? '<a data-toggle="tooltip" data-original-title="अस्वीकार करने पर यह फाइल पिछले स्तर पर चली जाएगी |" onclick="return confirm_reject()" href="'.base_url().'manage_file/send_file_return/'.$files->file_id.'" class="btn btn-block btn-sm btn-instagram" data-toggle="tooltip" data-original-title="Reject">Reject</a>' : false;
	                                if(strtolower($files->file_status)=='p' || $files->file_received_emp_id == $this->session->userdata("emp_id")) {
	                                    echo   $files->file_hardcopy_status == 'received' && $emp_session_id == $files->file_received_emp_id  ? '<button  onclick="open_model_dispose('.$files->file_id.')" class="btn btn-sm btn-block btn-info upperuser"> शाखा में Dispose</button>' : false;
										echo   $files->file_hardcopy_status == 'received' && $emp_session_id == $files->file_received_emp_id ? '<a onclick="return confirm_send()" href="'.base_url().'manage_file/dispatch_file_byso/'.$files->file_id.'" class="btn btn-sm btn-success btn-block rty1" value="'.$files->file_id.'" data-toggle="tooltip" data-original-title="Send to Dispatch"><i class="fa fa-send"></i> जावक शाखा में भेजें</a> ' : false;
	                                    //echo   emp_session_id() == $files->file_received_emp_id  ? '<a href="'.base_url().'efile/'.$files->file_id.'"  class="btn btn-block btn-sm btn-warning" data-toggle="tooltip" data-original-title="E-file">ई- फाइल</a>' : false;
	                                } else if($emp_session_id != $this->session->userdata("emp_id")){
	                                    echo "This is e-file, it can be forwarded only by the main user.";
	                                } 
                                }else {
									if($files->final_draft_id='' && $files->file_hardcopy_status != 'received' ){
									echo 'यह फाइल, <a href="#" class="badge bg-light-blue" >फाइल देखें </a>से प्राप्त करें !';
									}else if($files->file_hardcopy_status != 'received' ){
										echo 'यह फाइल,  <a href="'.base_url().'e-files/inbox?searchby='.$crvalue.'" class="badge bg-light-blue" >अंकित ई-फ़ाइलें (Inbox)</a>से प्राप्त करें !';
									}elseif($files->file_hardcopy_status=="received"){ 
									echo '<span"><a href="'.base_url().'e-files/inbox?searchby='.$crvalue.'" class="badge bg-light-blue" >अंकित ई-फ़ाइलें (Inbox)</a>में कार्यवाही करें !</span>' ;
									} 
								}
									echo   $files->file_hardcopy_status == 'received' && emp_session_id() == $files->file_received_emp_id ? '<button type="button" class="btn btn-sm btn-primary btn-block remarkbtn_model" data-file_id="'.$files->file_id.'" data-toggle="modal" data-target="#remarkmodel_all_section" data-toggle="tooltip" data-original-title="फाइल से  सम्बंधित रिमार्क जोड़ें ">रिमार्क जोड़े</button> ' : false;
								?>
									<?php if($files->file_hardcopy_status != 'not' && emp_session_id() == $files->file_received_emp_id){ ?>											 
									<button type="button" onclick="open_model_csu(<?php echo $files->file_id; ?>);" class="btn btn-block btn-sm btn-instagram btn_mark_csu"  data-file_status12 = "<?php  echo $files->file_status; ?>"  data-toggle="tooltip" data-original-title="Mark to scan unit for add PDF">Mark to CSU</button>
									<?php } ?>									
                                </td>
                            </tr>
                            <?php $i++; $sn++; 
								unset($crvalue);
								} } else {
                        echo "Plz first a section";
                    }
                    ?>
                    </tbody>
                </table>				
				 <form method="post" action="" id="multi_file_post_frm">
					<input type="hidden" value="0" id="file_total_slct_count"/>
					<input type="hidden" value="" id="file_emp_mark_id" name="file_emp_mark_id" />
					<input type="hidden" value="0" id="file_selected_file_ids" name="file_selected_file_ids"/>
					<input type="hidden" value="<?php echo $emp_role_levele['emprole_level']; ?>" id="emp_login_level"/>
				</form>
<?php if($this->uri->segment(1)=='efile' && $this->uri->segment(2)!=''){ /*this is use for view e-file*/ ?>
<?php }else{ ?>
<div id="bottom_anchor"></div> <!---use for fix table header-->
</div>
<div  style="margin: 10px;" class="pull-right">
					<select disabled id="auto_file_received_value" class="form-control btn btn-sm btn-twitter auto_file_received_value" style="width:150px;font-size:14px;text-align:left">
						<option value="" >चयनित नस्तिया प्राप्त करें </option>
				 		<option value="<?php echo $emp_session_id ;?>">केवल फाइल  को प्राप्त करें</option>
							<?php //$dalist= modules::run('view_file/section_da_name',true);?>
							<?php //foreach($dalist as $ky=>$dname){ ?>
							<!--	<option value="<?php //echo $dname['emp_id']; ?>"><?php //if($dname['emp_detail_gender']=='m'){ $pre_name='श्री  '; }else if($dname['emp_detail_gender']=='f'){ $pre_name='सुश्री  ';}  echo  $pre_name.$dname['emp_full_name_hi']; ?> </option>-->				
							<?php //} ?>
						</select>					
					</div>
				<div class="row">
					<div class="col-sm-5">
						<div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing <?php if(isset($_GET['per_page']) && !empty($_GET['per_page'])){ echo @$_GET['per_page']+1;}else{ if($total_files==0){ echo 0;}else{echo '1';}} ?> to <?php if($total_files==0){ echo 0;}else{ echo ($perpage+@$_GET['per_page']);} ?> of <span class="label label-primary">&nbsp;<?php echo $total_files; ?>&nbsp;</span> entries</div>
					</div>
					<div class="col-sm-12">
						<form name="search_from" id="search_from" method="get" action="<?php echo show_current_url(); ?>">
							<div class="col-sm-5 pull-right">
								<!--<div id="example1_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="Section & CR number,Subject,UO No.& Date" aria-controls="example1"></label></div>-->
								<div class="input-group">
									<?php if(isset($_GET['section_id']) && $_GET['section_id']!=''){?>
										<input type="hidden" name="section_id" value="<?php echo $_GET['section_id']?>">
									<?php } ?>
									<?php if(isset($_GET['sstype']) && $_GET['sstype']!=''){?>
										<input type="hidden" name="sstype" value="<?php echo $_GET['sstype']?>">
									<?php } ?>
									<input type="search" required name="searchby" class="form-control" placeholder="Section no./CR no./Subject/UO No./Date/file sender name" aria-controls="example1" value="<?php if(isset($_GET['searchby']) && $_GET['searchby']!=''){ echo $_GET['searchby'];} ?>">
									<div class="input-group-btn">
									  <button class="btn btn-success">खोजें</i></button>
									  <?php if(isset($_GET['searchby']) && $_GET['searchby']!=''){?>
										<a href="<?php echo reset_back_url();?>" class="btn btn-success">रिसेट करें</a>
									  <?php } ?>
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
			<?php }else{ ?>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.row -->
    <!-- Main row -->
</section><!-- /.content -->
<?php } ?>
<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
   <!-- <script src="<?php// echo ADMIN_THEME_PATH; ?>plugins/iCheck/icheck.min.js" type="text/javascript"></script> -->
<!-- Page Script -->
<script>
        /*Get user name*/
        $(".rty").click(function () {
			$(".sign_data_content").html('');
			$('.Da_name_r').val('');
			$(".get_sign_data").prop( "checked", false );
           
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
                    var otpt = '<select class="form-control emp_id" required id="check_sec_count" name="emp_id"><option value="" >चयन करें </option>';
                    $.each(r_data, function( index, value ) {
                        if(value.role_id == 8 || value.role_id == 37 || value.role_id == 14){
                            var secname = value.section_name;
                        }else{
                            var secname = '';
                        } if( (value.section_id == mark_sec && value.section_id != 17 ) && (value.section_id == mark_sec && value.section_id != 18) && (value.section_id == mark_sec && value.section_id != 22)&& (value.section_id == mark_sec && value.section_id != 13)&& (value.section_id == mark_sec && value.section_id != 11) ){
                            var selected = 'selected';
                        }else{
                            var selected = null;
                        }
						var selected = null; /*// BECAUSE OF MULTI SECTION USER */ 
						if(value.emp_detail_gender=='m'){
                            var fword_en='Shri';
                            var fword_hi='श्री';

                        }else if(value.emp_detail_gender=='f'){
                            var fword_en='shushri';
                            var fword_hi='सुश्री';
                        }
                        otpt += '<option value="'+value.emp_id+'" '+selected+'>'+fword_hi+' '+value.emp_full_name_hi+' ('+value.emprole_name_hi+')  '+secname+'</option>';
                    });
					/*otpt += '<option value="164" null="">दीपक बाबू श्रीवास्तव </option>';*/
                    otpt += '</select>';
                    $("#emp_byfile").html(otpt);
				}
            });

              $('#check_sec_count').change(function () {
				var emp_id =  $(this).val();						
				auto_select_section(emp_id);
			  
			});
			
			 });
			 
			 function auto_select_section(emp_id){					   
		  		   
		   var mark_sec = $('.rty_efile').data('mark_sec');

		   $.ajax({
				type: "POST",
				url: HTTP_PATH + "view_file/check_user_section/",
				datatype: "json",
				async: false,
				data: {emp_id: emp_id},
				success: function(data) {
					
				if(data!=0){
					var s_data = JSON.parse(data);
					var otpt2 = '<div class="row radiodiv">';
				
					$.each(s_data, function( index, value ) {
						var checked = 'un';
						if(mark_sec == value.section_id){
							checked = 'checked';
						} 									
						otpt2 += '<div class="col-md-4 text-center"><label class="radio" ><input type="radio"  required ="required" name="section_id" value="'+value.section_id+'" '+checked+'>'+value.section_name_hi+' </label></div>';
					
					});								
					otpt2 += '</div>';
					$("#emp_by_section").html(otpt2);
					}else{
						$(".radiodiv").remove();
						$("#emp_by_section").html('');
						
					}
				}
			});


		}



        /* this is for eoffice auto select sender emp*/
        $(".rty_efile").click(function () {
			$(".sign_data_content").html('');
			$('.Da_name_r').val('');	
			$(".get_sign_data").prop( "checked", false );
            var file_id = $(this).val();
            var user_role = '<?php echo checkUserrole() ; ?>';
            var mark_sec = $(this).data('mark_sec');
            var sender_empid = $(this).data('sender_empid');
            var sendreemprole = $(this).data('sendreemprole');
            var HTTP_PATH='<?php echo base_url(); ?>';
            $.ajax({
                type: "POST",
                url: HTTP_PATH + "view_file/return_fileofficer/"+file_id,
                datatype: "json",
                async: false,
                data: {file_id: file_id},
                success: function(data) {
                    
                    var r_data = JSON.parse(data);
                    var otpt = '<select class="form-control emp_id" required id="check_sec_count_1" name="emp_id"><option value="" >चयन करें </option>';
                    $.each(r_data, function( index, value ) {
                        if(value.role_id == 8 || value.role_id == 37 || value.role_id == 14){
                            var secname = value.section_name;
                        }else{
                            var secname = '';
                        }
                        if(sendreemprole > user_role){
                if(value.emp_id == sender_empid){
                    var selected = 'selected';
                }else{
                    var selected = null;
                        }}else{
                        if((value.section_id == mark_sec && value.section_id != 17 ) && (value.section_id == mark_sec && value.section_id != 18) && (value.section_id == mark_sec && value.section_id != 22)&& (value.section_id == mark_sec && value.section_id != 13)&& (value.section_id == mark_sec && value.section_id != 11) ){
                            var selected = 'selected';
                        }else{
                            var selected = null;
                }
                        }
                        if(value.emp_detail_gender=='m'){
                            var fword_en='Shri';
                            var fword_hi='श्री';
                        }else if(value.emp_detail_gender=='f'){
                            var fword_en='shushri';
                            var fword_hi='सुश्री';
                        }
                        otpt += '<option value="'+value.emp_id+'" '+selected+'>'+fword_hi+' '+value.emp_full_name_hi+' ('+value.emprole_name_hi+')  '+secname+'</option>';
                    });
                    otpt += '</select>';
                    $("#emp_byfile").html(otpt);
                $('#check_sec_count_1').change(function () {
                        var emp_id =  $(this).val();					
						auto_select_section(emp_id);

                    });
                }
            });
        });

        /*Get upper user name*/
         $(".upperuser").click(function () {			
			$(".sign_data_content").html('');
			$('.Da_name_r').val('');
			$(".get_sign_data").prop( "checked", false );	
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
                    var otpt1 = '<select class="form-control emp_id2" name="emp_id2">';
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
 /*    function showcomp(comp1)
        {
          var comp2 = comp1;
          alert(comp2);
    window.location='resolution_comp.php?comp1='+comp1;
      }*/
    function open_model(file,yn ,file_status){
		$(".radiodiv").remove();
		$("#emp_by_section").html('');
		var file1 = file;
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
		}
		 if(efile == 'efile' || efile == 'e-files'){
		 getphysical_file_from_log(file,file_status);  
		 }
		 
        $('#modal-id').val(file1);
		if(yn==1){ $('.psmdate').show();
            if($("#mdf"+file).text()!=''){
                $("#ps_moniter_date").val($("#mdf"+file).text());
            }
        }else{$('.psmdate').hide();}
		$('#modal-delete').modal('show');
    }
    function open_model2(file,file_status){
		$(".signdata").hide();/*by default hide digital sign checkbox */
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
			if(file_status == 'p'){
				$(".physical_file").prop( "checked", false );
				
				$(".electronic_file").prop( "checked", true );
				$(".electronic_file").prop( "disabled", true );
				$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="e">');
			}

			else if(file_status == 'e'){
				$(".signdata").show(); /*Show Digital sign box*/	
				$(".electronic_file").prop( "checked", true );
				$(".electronic_file").prop( "disabled", true );
				$(".physical_file").prop( "disabled", true );
				$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="e">');
			}

			else if(file_status == 'p,e'|| file_status == 'e,p'){
				$(".signdata").show(); /*Show Digital sign box*/
				$(".physical_file").prop( "checked", true );
				$(".electronic_file").prop( "checked", true );
				$(".electronic_file").prop( "disabled", true );
				$(".physical_file").prop( "disabled", true );
				$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="e"><input type="hidden"  name="file_status[]" class="form-group" value="p">');
				
			}
		}
		 if(efile == 'efile' || efile == 'e-files'){
			$(".signdata").show(); /*Show Digital sign box*/
			getphysical_file_from_log(file,file_status);  
		 }
		 
        $('#modal-id2').val(file2);
        $('#modal-send_upper').modal('show');
    }
        function open_model3(file,file_status){
        var file3 = file;
		$(".signdata").hide();/*by default hide digital sign checkbox */
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

			if(file_status == 'p'){
				$(".physical_file").prop( "checked", false );
		
				$(".electronic_file").prop( "checked", true );
				$(".electronic_file").prop( "disabled", true );
				$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="e">');
			}
			else if(file_status == 'e'){
				$(".signdata").show(); /*Show Digital sign box*/
				$(".electronic_file").prop( "checked", true );
				$(".electronic_file").prop( "disabled", true );
				$(".physical_file").prop( "disabled", true );
				$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="e">');
			}

			else if(file_status == 'p,e'|| file_status == 'e,p'){
				$(".signdata").show(); /*Show Digital sign box*/
				$(".physical_file").prop( "checked", true );
				$(".electronic_file").prop( "checked", true );
				$(".electronic_file").prop( "disabled", true );
				$(".physical_file").prop( "disabled", true );

				$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="e"><input type="hidden"  name="file_status[]" class="form-group" value="p">');
				




			}
		}
        $('#modal-receive_file').modal('show');
        $('#receive_file1').attr('action','<?php echo base_url() ;?>manage_file/receive_by_officer/'+file3);
    }
	function open_model_dispose(file){
        var file_dis = file;
        $('#modal-dis').val(file_dis);
        $('#modal-dispose_file').modal('show');
    }
</script>

<div class="modal fade" id="modal-delete" data-backdrop="static">
    <div class="modal-dialog">
        <form action="<?php echo base_url() ;?>manage_file/return_file" method="post" id="sendfile_upperofficer">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-edit"></i> Enter Remark </h4>
                </div>
                <div class="modal-body">
                    <div class="box-body table-responsive">
                        <div class="box-body">
                            <div class="row">
								<?php 
								
								 $empssection = empdetails($emp_session_id);
								if($empssection[0]['role_id']==3) { ?>
								<div class="col-xs-12 psmdate">
									<label>PS monitor Date <?php echo @$userBrowserName ? $userBrowserName : false; ?></label>
									
									<input type="date" class="form-control ps_moniter_date1" name="ps_moniter_date" id="ps_moniter_date1">
									<br/>
								</div>

                                    <div class="col-xs-12 psmark">
                                        <?php $ps_mark = ps_mark_file(); ?>
									<label>PS Mark On File</label>
                                        <select class="form-control" name="ps_file_mark" id="ps_file_mark">
                                            <?php foreach($ps_mark as $key => $ps_mark1) { ?>
                                            <option value="<?php echo $key ?>"><?php echo $ps_mark1?></option>
                                            <?php } ?>
                                        </select>
                                        <br/>
								</div>
								<?php } ?>
                                <div class="col-xs-12">
                                    <input type="hidden" id="modal-id" class="lower_efileid" name="fileids">
                                    <textarea class="form-control textarea_val" rows="3" placeholder="Enter ..." id="modal-id"name="rmk1"></textarea>
                                    <br/>
                                    <div id="emp_byfile"></div>
									<div id="emp_by_section"> </div>
										<div class="form-group pull-right">
										<input type="checkbox" class="physical_file" id="physical_file_sendupper" name="file_status[]"  value="p" >Physical File
										<input type="checkbox" class="electronic_file" id="electronic_file_sendupper" name="file_status[]" value="e" >E-File
									</div>
									<div class="efile_div"></div>
                                    <?php if($this->uri->segment(1)=='e-files' || $this->uri->segment(1)=='efile'){ ?>
									<div style="clear:both;margin-left: 15px;" class="signdata">
										<input type="checkbox" class="get_sign_data" id="get_sign_data" name="get_sign_data" value="">&nbsp; हस्ताक्षर करें
									</div>
                                    <?php }?>
								<div class="signdata sign_data_content"></div>
                            </div>
                        </div>
                            </div>
                    </div><!-- /.box-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i>Cancel</button>
					<button id="btn-delete" onclick="return confirm_send()" type="submit" class="btn btn-primary load_btn send_btn autoclick <?php if(($this->uri->segment(1)=='e-files')|| ($this->uri->segment(1)=='efile')){ echo " disabled"; }?>"><i class="fa fa-check"></i>भेजें</button>
					<input type="hidden" class="modal-send_upper_txt1" name="modal-send_upper_txt1" value="0"/>
                </div>
            </div>
        </form>
    </div>
</div>

<!--raginee-->
<div class="modal fade" id="modal-send_upper" data-backdrop="static">
    <div class="modal-dialog">
        <form action="<?php echo base_url() ;?>manage_file/Sendfile_upperofficer" id="sendfile_upperofficer" method="post" >
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
                                    <input type="hidden" id="modal-id2" class="lower_efileid" name="fileids2">
                                    <textarea class="form-control" rows="3" placeholder="Enter ..." id="modal-id" name="rmk1"></textarea>
                                    <br/>
                                    <div id="emp_byfile2"></div>
									<div class="form-group pull-right">
										<input type="checkbox" class="physical_file"  id="physical_file_sendupper" name="file_status[]"  value="p" <?php if($this->uri->segment(1) != 'e-files'){ echo "checked"; }?>>Physical File
										<input type="checkbox" class="electronic_file" id="electronic_file_sendupper" name="file_status[]" value="e" <?php if($this->uri->segment(1) == 'e-files'){ echo "checked"; }?>>E-File
									</div>
									<div class="efile_div"></div>
                                    <?php if($this->uri->segment(1)=='e-files' || $this->uri->segment(1)=='efile'){ ?>
									<div style="clear:both;margin-left: 15px;" class="signdata">
										<input type="checkbox" class="get_sign_data" id="get_sign_data" name="get_sign_data" value="">&nbsp; हस्ताक्षर करें									
									</div>
                                    <?php } ?>
									<div class="signdata sign_data_content"></div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i>Cancel</button>
                   <button id="btn-delete" onclick="return confirm_send()" type="submit" class="btn btn-primary load_btn send_btn autoclick <?php if(($this->uri->segment(1)=='e-files')|| ($this->uri->segment(1)=='efile')){ echo " disabled"; }?>"><i class="fa fa-check"></i>भेजें</button>
				   <input type="hidden" class="modal-send_upper_txt1" name="modal-send_upper_txt1" value="0"/>
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
                                        <label for="exampleInputFile">File given by</label>
                                        <input type="text" id="carry_fileemp_name" name="carry_fileemp_name" placeholder="Put name here"  class="form-control">
                                        </div>
                                        <div class="form-group  pull-right">
                                               <input type="checkbox"  class="physical_file" id="physical_file_receive" name="file_status[]"  value="p" <?php if(($this->uri->segment(1) != 'e-files') && ($this->uri->segment(1) != 'efile')){ echo "checked disabled"; }else{ echo 'disabled' ; }?>>Physical File
											   
											  <input type="checkbox" class="electronic_file" id="electronic_file_receive" name="file_status[]" value="e" <?php if(($this->uri->segment(1) == 'e-files')||($this->uri->segment(1) == 'efile')){ echo "checked disabled"; }else{ echo 'disabled' ; }?> >E-File
											 
										</div>
										<div class="efile_div"></div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                    <button id="btn-delete" onclick="return confirm_receive()" type="submit" class="btn btn-primary send_btn"><i class="fa fa-check blink"></i> Receive</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!--End-->
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
                    <button id="btn-delete" onclick="return confirm('क्या आप फाइल को बंद करना चाहते है ?')" type="submit" class="btn btn-primary send_btn"><i class="fa fa-check"></i> Submit</button>
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
<?php //$this->load->view('index_script_footer.php') ?>
<script>
    $('#ps_file_mark').change(function(){
       var  ps_file_mark = $('#ps_file_mark option:selected').val();
        var  ps_file_mark_text = "यह फाइल "+$('#ps_file_mark option:selected').text()+" को भेजी जानी है  | ,";

if(ps_file_mark != ''){
    $('.textarea_val').val(ps_file_mark_text);
}else{
    $('.textarea_val').val('');
}


    });
function getphysical_file_from_log(file,file_status)
	{
		var empid =  "<?php echo $emp_session_id ;?>";
		
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
				 
				/* console.log(r_data );*/
				if((r_data[0]['from_emp_id'] == empid && (r_data[0]['file_status_log'] == 'p,e')) || (r_data[0]['from_emp_id'] == empid && r_data[0]['file_status_log'] == 'e,p')){

					$(".physical_file").prop( "checked", true );
					$(".physical_file").prop( "disabled", false );
					$(".physical_file").prop( "checked", true );
					$(".physical_file").prop( "disabled", false );
					$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="e">');
				}
				
			}
		});
	}
	</script>
<?php $this->load->view('open_popup_forda') ; ?>