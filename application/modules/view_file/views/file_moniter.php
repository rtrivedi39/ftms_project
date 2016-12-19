<style>
    th{
        text-align: center !important;
    }
</style>
<?php
	$emp_section = explode(',',$this->session->userdata('emp_section_id'));
	$sub_sec_file_type = $this->input->get('sstype') != '' ? $this->input->get('sstype') : '';
?>
<link href="<?php echo ADMIN_THEME_PATH; ?>plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
<!-- Content Header (Page header) -->
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
            <div class="box" style="overflow: auto" id="divname">
                <div class="box-header">
                  <?php $role= checkUserrole_by_id(emp_session_id(),true); if($role ==3 ){ ?>
                    <div class="row" align="center">
                        <a href="<?php echo base_url();?>moniter/files" class="btn btn-sm btn-primary"><?php echo "Back To File Monitor"; ?></a>
                        <?php $ps_mark = ps_mark_file();
                        foreach($ps_mark as $key => $ps_mark1){
                            if($key != ''){?>
                            <a href="<?php echo base_url();?>moniter/files?psmrk=<?php echo $key;?>" class="btn btn-sm btn-primary"><?php echo @$key != '' ? $ps_mark1 : "Back To File Monitor"; ?></a>
                        <?php }} ?>
                    </div>
                    <hr/>
                    <?php }?>
                    <div style="float:left">
						  <a class="text-green" href="<?php echo base_url();?>moniter/files?sort=rc" style="padding:0px 7px 0px 0px"><i class="fa fa-square">&nbsp;Received</i></a>
						  <a class="text-red" href="<?php echo base_url();?>moniter/files?sort=rj" style="padding:0px 7px 0px 0px"><i class="fa fa-square">&nbsp;Reject</i></a>
						  <a class="text-red" href="<?php echo base_url();?>moniter/files?sort=rj_cr" style="padding:0px 7px 0px 0px"><i class="fa fa-square">&nbsp;CR Reject</i></a>
					</div>
				   <div style="float:right">
				   
				     <?php
					 $sts =	$this->uri->segment(1);	
if($sts == 'e-files'){
					 $close =	$this->uri->segment(3);
				 if($close == "close"){ ?>
				  <a class="text-red blink_me" href="" style="padding:0px 7px 0px 0px" >आप बंद कि गई नस्तीयां देख रहे है </a>
				     <a class="text-red" href="<?php echo base_url();?>moniter/files" style="padding:0px 7px 0px 0px" ><button  class="btn btn-info no-print">Working File</button></a>
					 
					  
				  <?php }else{ ?>
				     <a class="text-red blink_me" href="" style="padding:0px 7px 0px 0px" > आप कार्यरत नस्तीयां देख रहे है</a>
				
				     <a class="text-red" href="<?php echo base_url();?>moniter/files/close" style="padding:0px 7px 0px 0px" ><button  class="btn btn-warning no-print">Close File</button></a>
					 
					 	
				  <?php }} else{
				  
				  $close =	$this->uri->segment(3);
				if($close == "close"){ ?>
				 <a class="text-red" href="" style="padding:0px 7px 0px 0px" > आप बंद कि गई नस्तीयां देख रहे है </a>
				<a class="text-red" href="<?php echo base_url();?>moniter/files" style="padding:0px 7px 0px 0px" ><button  class="btn btn-info no-print">Working File</button></a>					 
					  
				<?php }else{ ?>
				<a class="text-red" href="" style="padding:0px 7px 0px 0px" > आप कार्यरत नस्तीयां देख रहे है</a>
				
				<a class="text-red" href="<?php echo base_url();?>moniter/files/close" style="padding:0px 7px 0px 0px" ><button  class="btn btn-warning no-print">Close File</button></a>					 
					 	
				<?php } } ?>
					   <?php if(in_array(2,$emp_section) || in_array(10,$emp_section)) {?>
						<select  id="section_file_type_ddl" name="section_file_type_ddl" class="form-control btn btn-sm btn-info " style="width:150px;font-size:14px;text-align:left">
							<option value="">फ़ाइल के प्रकार का चयन करें</option>
								<?php foreach(get_civil_file_type() as $ky => $dname){ ?>
									<option value="<?php echo $ky; ?>" <?php echo ($sub_sec_file_type != '' && $ky == $sub_sec_file_type) ? 'selected' : ''; ?>><?php echo $dname; ?> </option>				
								<?php } ?>
						</select> 
						<?php } ?>
                        <!--<button class="btn btn-block btn-info"><?php// echo $this->lang->line('view_file_mark');?></button>-->
                        <!--<a class="btn btn-info"><?php// echo $this->lang->line('view_file_mark');?></a>-->
						<button onclick="printContents('divname')" class="btn btn-primary no-print">Print</button>
                        <button class="btn btn-warning no-print" onclick="goBack()"><?php echo $this->lang->line('Back_button_label'); ?></button>
                    </div>
                    <div class="row" <?php if(isset($_GET['psmrk'])){ echo "style='display: none'";}?>>
                        <div class="col-xs-12" align="center">
                            <form method="get" action="<?php $_SERVER['REQUEST_URI'] ?>">
                                <div class="col-md-2">
                                    <label>फाइल को फिल्टर करें</label>
                                </div>
                                <div class="col-md-2">
                                    <select class="form-control" id="files_year" name="files_year">
                                        <?php $i = '2015';
                                        if(isset($_GET['files_year']) && $_GET['files_year']!=''){$files_year=$_GET['files_year'];}else{ $files_year=date('Y');}
                                        while($i <= date('Y')) { ?>
                                            <option value="<?php echo $i ; ?>" <?php echo $files_year == $i ? 'selected' : ''; ?>><?php echo $i ;?></option>
                                            <?php $i++; } ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select class="form-control" id="files_month" name="files_month">
                                        <option value="">--Select Month--</option>
                                        <?php $i = '01';
                                        if(isset($_GET['files_month']) && $_GET['files_month']!=''){$files_month=$_GET['files_month'];}else{ $files_month=date('m');}
                                        //$current_month=date('m');
                                        foreach(all_month() as $i => $months) { ?>
                                            <option value="<?php echo $i ; ?>" <?php echo $files_month == $i ? 'selected' : ''; ?>><?php echo $months ;?></option>
                                            <?php $i++; } ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input type="hidden" name="sort" value="<?php if(isset($_GET['sort']) && $_GET['sort']!=''){ echo $_GET['sort'];}?>"/>
                                    <button class="btn btn-success" type="submit">खोजें</button>                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!-- /.box-header -->
				 <div class="box-body">
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
                    </div>

                <?php } ?>
                <?php if(emp_session_id() != $this->session->userdata('emp_id')){
                    $em =  empdetails(emp_session_id());
                    ?>
                    <div class="callout callout-info lead">
                        <p>आप <b><?php echo emp_gender(emp_session_id()) ." ". $em[0]['emp_full_name_hi'] ." (". getemployeeRole($em[0]['role_id']).")" ;?></b> को अंकित की गई फाइलें देख रहे है |</p>
                    </div>
                <?php  } ?>
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
									<input type="search" required name="searchby" class="form-control" placeholder="Section no./CR no./Subject/UO No./Date/file sender name" aria-controls="example1">
									<div class="input-group-btn">
									  <button class="btn btn-success">खोजें</i></button>
									  <?php if(isset($_GET['searchby']) && $_GET['searchby']!=''){?>
										<a href="<?php echo reset_back_url();?>" class="btn btn-success">रीसेट करें</a>
									<?php } ?>
									</div>
								  </div>								
							</div>
							
						</form>
					</div>
				</div>
				<div class="fix_table-container">
                <table class="table table-bordered table-hover fix_maintable">
                    <thead style="background: white ;">
                    <tr>
                        <th><?php echo $this->lang->line('sno'); ?></th>
                        <th><?php echo $this->lang->line('view_file_subject'); ?></th>
						<th style="display:none"><?php echo "monitor_date"; ?></th>
                        <th><?php echo $this->lang->line('uo/letter_no'); ?></th>
                        <th><?php echo $this->lang->line('view_file_uo_letter_date'); ?></th>
                        <th><?php echo $this->lang->line('section_no1'); ?></th>
                        <th><?php echo $this->lang->line('view_file_mark_section_id'); ?></th>
                        <th class="no-print"><?php echo $this->lang->line('date'); ?></th>
                        <th class="no-print"><?php echo $this->lang->line('filestatus'); ?></th>
                        <th class="no-print">कार्यवाही</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=1; 
						if(isset($_GET['per_page']) && $_GET['per_page']!=''){
								$i=$_GET['per_page']+1;
						}
					foreach ($get_files as $key => $files) { 					
					?>
                        <tr onClick="showcomp(<?php echo $files->file_id; ; ?>)" style="cursor:pointer; <?php if(checkUserrole() == 3 &&  $files->ps_moniter_date == '' ){} else if(checkUserrole() == 3 && match_date_from_current($files->ps_moniter_date) == 1 && $files->file_hardcopy_status!='close' && $files->file_return!=2 ){ echo "background-color:rgb(236, 202, 202)"; }else if(checkUserrole() == 3 && match_date_from_current($files->ps_moniter_date) == 2 && $files->file_hardcopy_status!='close' && $files->file_return!=2 ){ echo "background-color:#A9DEA9"; }else if(checkUserrole() == 3 && match_date_from_current($files->ps_moniter_date) == 3 && $files->file_hardcopy_status!='close' && $files->file_return!=2 ){ echo "background-color:#E2C081"; } ?>"; data-toggle="tooltip" data-original-title="View Files">
                        <td><?php echo $i;?>  <span style="display:none"> (<?php echo $this->lang->line('file_no'); ?> : <?php echo $files->file_id;?>)<span></td>
                        <td><?php echo $files->file_subject;?> <br><div style="float:right"><b><?php  if(($files->ps_moniter_date != '0000-00-00') && ($files->ps_moniter_date !='1970-01-01')){ echo (@$files->ps_moniter_date)? 'Mark Date :'. date('d-m-Y' , strtotime($files->ps_moniter_date)):''; } ?></b></div>
						<br><?php if(isset($files->scan_id) && $files->scan_id != ''){ show_scan_file($files->scan_id);}?>
						<br><?php if(isset($files->file_status) && $files->file_status != ''){ show_file_status($files->file_status);}?>
						</td>
						<td  style="display:none"><?php echo $files->ps_moniter_date;?></td>
                        <td><?php echo isset($files->file_uo_or_letter_no)?$files->file_uo_or_letter_no:''; ?> (<?php echo isset($files->file_type)?getFileType($files->file_type):'' ;?>) </td>
                        <td><?php if(isset($files->file_uo_or_letter_date) && $files->file_uo_or_letter_date != '0000-00-00'){ echo date_format(date_create($files->file_uo_or_letter_date), 'd/m/y'); } ?></td>
                        <td><?php 
						//echo @getfilesec_id_byfileid($files->file_id,$files->file_mark_section_id) ? getfilesec_id_byfileid($files->file_id,$files->file_mark_section_id) : 'N/A'; 
						$rrt = all_getfilesec_id_byfileid($files->file_id);
							foreach($rrt as $rrt1){
								$sechi = explode('(',getSection($rrt1['section_id']));
								echo "<b>".$rrt1['section_number'] ."</b> - <span style='font-size: 12px'>".$sechi['0']."</span><br/>";
							}
						?>
						<?php if(isset($files->old_registared_no) && ($files->old_registared_no != 0 )){
									echo "<br><span title='पुराना रजिस्टर नंबर' > ORN : ".$files->old_registared_no ."</span>";
								} ?>
						</td>
                        <td><?php echo @getSection($files->file_mark_section_id) ? getSection($files->file_mark_section_id) : 'N/A'; ?></td>
                        <td class="no-print"><?php echo date_format(date_create($files->file_update_date), 'd/m/y'); ?>
                            (<?php if($files->file_hardcopy_status == 'not'){ echo $this->lang->line('mark_date');} else { echo $this->lang->line('received_date');} ?>)
                        </td>
                            <td class="no-print"><?php
                                $filereceiver = get_user_details($files->file_received_emp_id);
                                if ($filereceiver)
                                {
									if($files->file_hardcopy_status == 'not') {
										echo file_not_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi);
                                    } else if($files->file_hardcopy_status == 'close') {
										echo file_closed_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi, $files->file_type);
                                 } else{
										echo file_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi);
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

                                ?></td>
								<td><?php $show_r =  base_url()."view_file/document_path/index/".$files->file_id ; $target="target='_blank'"; 
								//echo   $files->file_hardcopy_status != 'close' ? '<a href="'.$show_r.'"  '.$target.' class="btn btn-block btn-sm btn-twitter" data-toggle="tooltip" data-original-title="Add doccument">दस्तावेज संलग्न करें</a>' : false;  ?>
								<?php echo $this->uri->segment(1)=='e-files'? '<a href="'.base_url().'efile/'.$files->file_id.'" class="btn btn-sm btn-block btn-warning"> ई- फाइल देखें</a>': false; ?>
								</td>
                        </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>
				<div id="bottom_anchor"></div>
                </div>
				<div class="row">
					<div class="col-sm-5">
						<div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing <?php if(isset($_GET['per_page']) && !empty($_GET['per_page'])){ echo @$_GET['per_page']+1;}else{ if($total_files==0){ echo 0;}else{echo '1';}} ?> to <?php if($total_files==0){ echo 0;}else{ echo ($perpage+@$_GET['per_page']);} ?> of <span class="label label-primary">&nbsp;<?php echo $total_files; ?>&nbsp;</span> entries</div>
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
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col-12 -->
    </div><!-- /.row -->
    <!-- Main row -->
</section><!-- /.content -->
<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Page Script -->
<script>
    function showcomp(comp1)
    {
        window.location='<?php echo base_url();?>view_file/viewdetails/'+comp1;
    }
</script>
