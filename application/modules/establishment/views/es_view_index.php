<?php $userrole = checkUserrole();
$login_emp_level= get_emp_role_levele();
$emp_session_id =  emp_session_id() ;
$emp_section = explode(',',$this->session->userdata('emp_section_id'));

?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo $title; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Establishment</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Your Page Content Here -->
    <!-- Small boxes (Stat box) -->
    <div class="row">
	 <?php $this->load->view('establishment/est_header'); ?>
        <div class="col-xs-12">
            <div class="box box-warning" id="divname">
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
					<?php if(check_est_so()){ ?>
					<select disabled id="auto_file_received_value" class="form-control btn btn-sm btn-twitter auto_file_received_value" style="width:150px;font-size:14px;text-align:left">
						<?php if($this->uri->segment(1)!= 'today') { ?><option >चयनित नस्तिया प्राप्त करें </option><?php } ?>
						<option value="<?php echo $emp_session_id ;?>">केवल फाइल  को प्राप्त करें</option>

						<?php $employees  = get_establishment_employees_with_des(false); ?>
						<?php foreach($employees as $emp => $emp_details) { ?>
								<option value="<?php echo $emp_details->emp_id; ?>"><?php echo getemployeeName($emp_details->emp_id,true); ?></option>
						<?php } ?>
					</select>
					<?php } ?>
                        <button onclick="printContents('divname')" class="btn btn-primary no-print">Print</button>
                        <!--<button class="btn btn-block btn-info"><?php echo $this->lang->line('view_file_mark');?></button>-->
                        <button class="btn  btn-warning" title="Back" onclick="goBack()"><?php echo $this->lang->line('Back_button_label'); ?></button>
                    </div>

                </div><!-- /.box-header -->
                <div class="box-body">
				<marquee behavior="alternate" class="text-center bg-danger" scrollamount="1">
				<b style="color:red;"> प्रमुख सचिव के आदेश अनुसार सभी फाइलें 2 दिवस के अन्दर ही प्राप्त करे या अस्वीकार करे अन्यथा अस्वीकारे का बटन दिखाई नहीं देगा|</b>
				</marquee>
                     <div class="table-responsive" align="center">
					<form method="post">
                        <?php $empssection = empdetails(emp_session_id());
							$alloted_section = $empssection[0]['emp_section_id'];
							$allot_section = explode( ',',$alloted_section );
							if(($this->uri->segment(3)) && ($this->uri->segment(4))){
								$page1 = $this->uri->segment(3).'/'.$this->uri->segment(4);
							}
							if(count($allot_section) > 1){
                        if(isset($page1)) {$p1 = '/'.$page1;} else { $p1 = null;}
                        $i=1; foreach(explode(",",$empssection[0]['emp_section_id'])  as $empsec){
                            if ($i%2 == 1) { $cls = "class='btn bg-purple btn-flat margin'"; }else{ $cls = "class='btn bg-maroon btn-flat margin'"; }
                            if (isset($empsec)) {
								if($empsec != '26')		{					?>
                                <!--  <button value="<?php echo $empsec ; ?>" name="section_ids" type="submit" <?php echo $cls ; ?>><?php echo getSection($empsec) ; ?></button>-->
                                <a href="<?php echo base_url().'establishment/view_file_es'.$p1.'/?section_id='.$empsec ; ?>" <?php echo $cls ; ?>><?php echo getSection($empsec) ; ?></a>
                            <?php }	} $i++; }?>
							 <a href="<?php echo base_url().'establishment/view_file_es'?>" class="btn bg-purple btn-flat margin" ><?php echo "सभी फ़ाइल्" ; ?></a>	
							<?php } ?>
							</form>
								<div style="clear:both"></div>
							<div class="row">
								<div class="col-sm-5">
									<div class="dataTables_info pull-left" id="example1_info" role="status" aria-live="polite">Showing <?php if(isset($_GET['per_page']) && !empty($_GET['per_page'])){ echo @$_GET['per_page']+1;}else{ if($total_files==0){ echo 0;}else{echo '1';}} ?> to <?php if($total_files==0){ echo 0;}else{ echo ($perpage+@$_GET['per_page']);} ?> of <span class="label label-primary">&nbsp;<?php echo $total_files; ?>&nbsp;</span> entries</div>
								<?php echo per_page_listing() ;?>
								</div>
								<div class="col-sm-7">
									<div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">							
										<?php  foreach ($links as $link) {
													echo $link;
												} 												
										?>								
									</div>
									<form name="search_from" id="search_from" method="get" action="<?php show_current_url(); ?>">
										<div class="col-sm-5 pull-right">
											<!--<div id="example1_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="Section & CR number,Subject,UO No.& Date" aria-controls="example1"></label></div>-->
											<div class="input-group">
												<?php if(isset($_GET['section_id']) && $_GET['section_id']!=''){?>
													<input type="hidden" name="section_id" value="<?php echo $_GET['section_id']?>">
												<?php } ?>
												<input type="search" required name="searchby" class="form-control" placeholder="Section & CR number,Subject,UO No.& Date" aria-controls="example1" value="<?php if(isset($_GET['searchby']) && $_GET['searchby']!=''){ echo $_GET['searchby'];} ?>">
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
                        <table  class="table table-bordered table-striped display">
                            <thead>
                            <tr>
                                <th><?php echo $this->lang->line('sno'); ?></th>
                                <th><?php echo $this->lang->line('section_no1'); ?></th>
                                <th><?php echo $this->lang->line('view_file_subject'); ?></th>
                                <th><?php echo $this->lang->line('label_file_type'); ?>/ यू० ओ० क्रं० <br> प्रेषक नाम</th>
                                <th>विभाग प्राप्ति दिनांक</th>
                                <th><?php echo $this->lang->line('view_file_mark_section_id'); ?></th>
                                <th>विभाग</th>
                                <th>मार्क <?php echo $this->lang->line('date'); ?></th>
                                <th class="no-print"><?php echo $this->lang->line('filestatus'); ?></th>
                                <th class="no-print"><?php echo $this->lang->line('actions'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
							  $i=1;$sn=1; 
							if(isset($_GET['per_page']) && $_GET['per_page']!=''){
								$sn=$_GET['per_page']+1;
							}
							foreach ($get_files as $key => $files) {
                                $diff=date_diff(date_create($files->file_update_date),date_create(date("Y-m-d")));
                                $checkdate = $diff->format("%a");
                                ?>
                                <tr <?php
                                if($checkdate >= '3' && $checkdate <= '7') { echo "style='background-color:#FBFBDE' data-toggle='tooltip' data-original-title='३ दिन से अधिक विलंब'";
                                } else if($checkdate >= '7' && $checkdate <= '10') { echo "style='background-color:#FFE7BA' data-toggle='tooltip' data-original-title='७ दिन से अधिक विलंब'";
                                } else if($checkdate >= '10') { echo "style='background-color:#FFA4A4' data-toggle='tooltip' data-original-title='१० दिन से अधिक विलंब'";}
                                ?>>
                                   <td><span title="<?php echo $this->lang->line('file_no'); ?> : <?php echo $files->file_id;?>" ><?php echo $i;?> </span>
                                        <br/>
                                        <?php @$fno = getfilesec_id_byfileid($files->file_id,'1',$files->file_type,$files->file_mark_section_id);
                                        if($fno !=null){ echo "Cr :".$fno;} ?>
										<?php if(check_est_so()){ ?>
										<br/>
										<input type="checkbox" class="chk_slct_file" id="row_id_<?php echo $files->file_id; ?>" value="<?php echo $files->file_id; ?>" name="fileIds" style="font-size:26px;"/>
										<?php } ?>
									</td>
									<td><a href="<?php echo base_url()."view_file/viewdetails/".$files->file_id ;?>" data-toggle="tooltip" data-original-title="View details"><?php echo @$estsecno = @getfilesec_id_byfileid($files->file_id,$files->file_mark_section_id,$files->file_type) ? getfilesec_id_byfileid($files->file_id,$files->file_mark_section_id,$files->file_type) : 'N/A'; ?></a></td>
                                    <td><?php echo $files->file_subject;?>
										<br><?php if(isset($files->file_status) && $files->file_status != ''){ show_file_status($files->file_status);}?>
										<br><?php if(isset($files->scan_id) && $files->scan_id != ''){ show_scan_file($files->scan_id);}?>
                    				</td>
                                    <td><?php echo $files->file_uo_or_letter_no; ?> (<?php echo getFileType($files->file_type) ;?>) <br><span class="badge bg-light-blue"> प्रेषक नाम : <?php echo isset($files->file_sender_emp_id)? getemployeeName($files->file_sender_emp_id, 'hindi'):'' ?></span></td>
                                    <td><?php echo date_format(date_create($files->file_uo_or_letter_date), 'd/m/y'); ?></td>
                                    <td><?php //echo getSection($files->file_mark_section_id); ?>
									<?php 
										$rrt = all_getfilesec_id_byfileid($files->file_id);
											foreach($rrt as $rrt1){
												$sechi = explode('(',getSection($rrt1['section_id']));
												echo "<b>".$rrt1['section_number'] ."</b> - <span style='font-size: 12px'>".$sechi['0']."</span><br/>";
											}
										?>
									</td>
                                   <td><?php
                                        $file_from = file_from_type();
                                        $high_bench =  highcourt_bench();

                                         if(isset($files->file_Offer_by) && $fno != null ){

                                            echo   $files->file_Offer_by == 'c' || $files->file_Offer_by == 'jvn' ? (isset( $file_from[$files->file_Offer_by] )? $file_from[$files->file_Offer_by] :'')." , ". (isset($files->district_name_hi)?$files->district_name_hi:'') : false ;
                                            echo   $files->file_Offer_by == 'm' || $files->file_Offer_by == 'u' ? (isset($file_from[$files->file_Offer_by])?$file_from[$files->file_Offer_by]:'') ." , ". (isset($high_bench[$files->court_bench_id])?$high_bench[$files->court_bench_id]:'') : false ;
                                            echo   $files->file_Offer_by == 'sc' ? (isset($file_from[$files->file_Offer_by])?$file_from[$files->file_Offer_by]:'') ." , Delhi , दिल्ली" : false ;
                                            echo   $files->file_Offer_by == 'v' || (isset($files->dept_name_hi)?$files->dept_name_hi:'') ? (isset($file_from[$files->file_Offer_by])?$file_from[$files->file_Offer_by]:'') ." , ". (isset($files->dept_name_hi)?$files->dept_name_hi:'') ." ".(isset($files->file_department_name)?$files->file_department_name:'') : (isset($files->file_department_name)?$files->file_department_name:'');
                                        }else {
											echo "विधि और विधायी कार्य विभाग";
										}	?>
                                    </td>
                                    <td><?php echo date_format(date_create($files->file_update_date), 'd/m/y'); ?>
                                        (<?php if($files->file_hardcopy_status == 'not'){ echo $this->lang->line('mark_date');} else { echo $this->lang->line('received_date');} ?>)
                                    </td>
                                    <td class="no-print"><?php
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
                                        } ?>
                                    </td>
                                    <td class="no-print">
                                    <?php
									if((($this->uri->segment(1)=='e-files' || $this->uri->segment(1)=='efile') && $files->final_draft_id =='' && $login_emp_level['role_id']=='37') || (($this->uri->segment(1)=='e-files' || $this->uri->segment(1)=='efile') && $files->final_draft_id !='' ) || (($this->uri->segment(2)=='view_file_es' || $this->uri->segment(1)=='today') && $files->final_draft_id=='') && $files->file_status == 'p'){
										$senderemp = empdetails($files->file_sender_emp_id);
                                        if(is_array($this->session->userdata('today_permission_assign'))){
                                            $is_subuser='?subuse='.$this->session->userdata['today_permission_assign']['today_permission_given_empid'];
                                        }else{
                                            $is_subuser='';
                                        }
                                        if($files->file_return == '2' && $files->file_hardcopy_status != 'not'){
                                            echo    '<a onclick="return confirm_send()" href="'.base_url().'manage_file/dispatch_file_byso/'.$files->file_id.'" class="btn btn-sm  btn-block btn-instagram" value="'.$files->file_id.'">जावक शाखा में भेजें</a>';
                                            echo   ($files->file_hardcopy_status == 'received' || $files->file_hardcopy_status == 'working') && $emp_session_id == $files->file_received_emp_id && $files->file_level_id != '31' ? '<button onclick="open_model2('.$files->file_id.')" value="'.$files->file_id.'"  class="btn btn-sm btn-block btn-success upperuser" data-toggle="tooltip" data-original-title="Send to officer">अधिकारी को भेजें</button> ' : false;
                                            echo   ($files->file_hardcopy_status == 'received' || $files->file_hardcopy_status == 'working') && $emp_session_id == $files->file_received_emp_id ? '<button onclick="open_model6('.$files->file_id.',&#39;'.$files->file_status.'&#39;)" class="btn btn-sm btn-info btn-block rty6" value="'.$files->file_id.'" data-toggle="tooltip" data-original-title="Mark to DA">सहायक को  अंकित करें</button>' : false;
                                        }else{


                                        // echo   $files->file_hardcopy_status == 'not' && $emp_session_id == $files->file_received_emp_id && $this->uri->segment(3) != 'return' ? '<a onclick="return confirm_receive()" href="'.base_url().'establishment/manage_file/receive_file_sectionno/'.$files->file_id.'" class="btn btn-block btn-twitter"><span class="blink_fast" data-toggle="tooltip" data-original-title="Receive">'.$this->lang->line('receive_file').'</span></a>' : false; // file receive from dealing assistant

                                        // echo   $files->file_hardcopy_status == 'not' && $emp_session_id == $files->file_received_emp_id ? '<button onclick="receive_markda('.$files->file_id.')" class="btn btn-block btn-sm btn-twitter rty6" value="'.$files->file_id.'"><span class="blink_fast">'.$this->lang->line('receive_file').'</span></button> <a data-toggle="tooltip" data-original-title="वापस भेजें" onclick="return confirm_reject()" href="'.base_url().'establishment/manage_file/reject_file/'.$files->file_id.'" class="btn btn-block btn-sm btn-instagram" data-toggle="tooltip" data-original-title="Reject">'.$this->lang->line('reject').'</a>' : false;
                                            echo   $files->file_hardcopy_status == 'not' && $emp_session_id == $files->file_received_emp_id ? '<button onclick="open_model3('.$files->file_id.',&#39;'.$files->file_status.'&#39;)" class="btn btn-block btn-sm btn-twitter rty6" value="'.$files->file_id.'"><span class="blink_fast">'.$this->lang->line('receive_file').'</span></button> ' : false;
												if($checkdate < '3'){
                                                    if(check_est_so() && $estsecno == 'N/A'){
                                                        echo  ($files->file_hardcopy_status == 'not' && $files->file_type != 'app' && $emp_session_id == $files->file_received_emp_id)  ? '<a data-toggle="tooltip" data-original-title="CR वापस भेजें" onclick="return confirm_reject()" href="'.base_url().'manage_file/reject_for_cr/'.$files->file_id.'" class="btn btn-block btn-sm btn-danger" data-toggle="tooltip" data-original-title="Reject CR">'.$this->lang->line('reject').'</a>'  : false;
                                                    }else {
													   echo  ($files->file_hardcopy_status == 'not' && $files->file_type != 'app' && $emp_session_id == $files->file_received_emp_id)  ? '<a data-toggle="tooltip" data-original-title="वापस भेजें" onclick="return confirm_reject()" href="'.base_url().'manage_file/send_file_return/'.$files->file_id.'" class="btn btn-block btn-sm btn-danger" data-toggle="tooltip" data-original-title="Return">'.$this->lang->line('reject').'</a>'  : false;
                                                    }
												}
                                            
                                            echo   ($files->file_hardcopy_status == 'received' || $files->file_hardcopy_status == 'working') && $emp_session_id == $files->file_received_emp_id ? '<button onclick="open_model6('.$files->file_id.',&#39;'.$files->file_status.'&#39;)" class="btn btn-sm btn-twitter btn-block rty6" value="'.$files->file_id.'" data-toggle="tooltip" data-original-title="Mark to DA">शाखा में ही मार्क करे </button>' : false;
                                            echo   ($files->file_hardcopy_status == 'received' || $files->file_hardcopy_status == 'working') && $emp_session_id == $files->file_received_emp_id ? '<button onclick="open_model2('.$files->file_id.')" value="'.$files->file_id.'"  class="btn btn-sm btn-block btn-success upperuser" data-toggle="tooltip" data-original-title="Send to officer">अधिकारी को भेजें</button> ' : false;
                                            echo   ($files->file_hardcopy_status == 'received' || $files->file_hardcopy_status == 'working') && $files->file_type != 'app' && $emp_session_id == $files->file_received_emp_id ? '<button onclick="section_section('.$files->file_id.',&#39;'.$files->file_status.'&#39;)" value="'.$files->file_id.'"  class="btn btn-sm btn-block btn-warning sections_nm" data-toggle="tooltip" data-original-title="Section to Section movement">Section to Section</button> ' : false;
                                           // echo   ($files->file_hardcopy_status == 'received' || $files->file_hardcopy_status == 'working') && $files->file_type != 'app' && $emp_session_id == $files->file_received_emp_id ? '<a onclick="return confirm_send()" href="'.base_url().'manage_file/dispatch_file_byso/'.$files->file_id.'" class="btn btn-sm btn-instagram btn-block" value="'.$files->file_id.'" data-toggle="tooltip" data-original-title="Send to Dispatch">जावक शाखा में भेजें</a> ' : false;
											 echo    ($files->file_hardcopy_status == 'received' || $files->file_hardcopy_status == 'working') && $files->file_type != 'app' && $emp_session_id == $files->file_received_emp_id ? '<a onclick="send_despetch_section('.$files->file_id.',&#39;'.$files->file_status.'&#39;)" class="btn btn-sm btn-instagram btn-block" value="'.$files->file_id.'" data-toggle="tooltip" data-original-title="Send to Dispatch">जावक शाखा में भेजें</a> ' : false;
                                            echo   ($files->file_hardcopy_status == 'received' || $files->file_hardcopy_status == 'working') && $emp_session_id == $files->file_received_emp_id ? '<button onclick="open_model_dispose('.$files->file_id.')" class="btn btn-sm btn-block btn-danger" value="'.$files->file_id.'" data-toggle="tooltip" data-original-title="Dispose in section">शाखा में Dispose</button> ' : false;
											//echo   ($files->file_hardcopy_status == 'received' || $files->file_hardcopy_status == 'working') && $emp_session_id == $files->file_received_emp_id ? '<button type="button" class="btn btn-sm btn-primary btn-block remarkbtn" data-file_id="'.$files->file_id.'" data-toggle="modal" data-target="#remarkmodel" data-toggle="tooltip" data-original-title="Add to remark">रिमार्क जोड़े</button> ' : false;
											echo   ($files->file_hardcopy_status == 'received' || $files->file_hardcopy_status == 'working') && $files->file_type != 'app' && $emp_session_id == $files->file_received_emp_id   ? '<button onclick="open_model5('.$files->file_id.')" value="'.$files->file_id.'"  class="btn btn-block btn-sm btn-danger" data-toggle="tooltip" data-original-title="Return to CR"><i class="fa fa-reply"></i> आवक शाखा में भेजें</button> '  : false;

                                            echo   ($files->file_hardcopy_status == 'received' || $files->file_hardcopy_status == 'working') && $files->file_type != 'app' && $emp_session_id == $files->file_received_emp_id   ? '<a href="'.base_url().'scan/dealing/'.$files->file_id.'" class="btn btn-block btn-sm btn-twitter" data-toggle="tooltip" data-original-title="Modify"><i class="fa fa-fw fa-edit"></i> बदलाव करें </a> <button type="button" onclick="open_model_csu('.$files->file_id.');" class="btn btn-block btn-sm btn-instagram btn_mark_csu" data-toggle="tooltip" data-file_status12 = "'.$files->file_status.'" data-original-title="Mark to scan unit for add PDF">Mark to CSU</button>'  : false;
									   //     echo $files->file_hardcopy_status == 'received' && $emp_session_id == $files->file_received_emp_id ?  '<button type="button" class="btn btn-sm btn-instagram btn-block rty1" data-toggle="modal" data-file_id="'.$files->file_id.'" id="dispatch_btn" data-target="#dispatch_model" data-toggle="tooltip" data-original-title="Send to Dispatch"> जावक शाखा में भेजें</button>' : false;
                                        }
								 }else {
									if($this->uri->segment(1)=='today'){
										echo "नस्ती का चयन कर सहायक को मार्क करे  |";
									}else{
										if(@$fno ==''){ $esno = $estsecno;} else{ $esno=$fno;}
										if($files->final_draft_id == '' && $files->file_hardcopy_status != 'received' ){
											echo 'यह फाइल, <a href="#" class="badge bg-light-blue" >फाइल देखें </a>से प्राप्त करें !';
										}else if($files->file_hardcopy_status != 'received' ){
											echo 'यह फाइल,  <a href="'.base_url().'e-files/inbox?searchby='.$esno.'" class="badge bg-light-blue" >अंकित ई-फ़ाइलें (Inbox)</a>से प्राप्त करें !';
										}elseif($files->file_hardcopy_status=="received"){
											echo '<a href="'.base_url().'e-files/inbox?searchby='.$esno.'" class="badge bg-light-blue" >अंकित ई-फ़ाइलें (Inbox)</a>पर कार्यवाही करें !' ;
										}
									}
								}

								echo ($files->file_hardcopy_status == 'received' || $files->file_hardcopy_status == 'working') && $emp_session_id == $files->file_received_emp_id ? '<button type="button" class="btn btn-sm btn-primary btn-block remarkbtn_model" data-file_id="'.$files->file_id.'" data-toggle="modal" data-target="#remarkmodel_all_section" data-toggle="tooltip" data-original-title="फाइल से  सम्बंधित रिमार्क जोड़ें ">रिमार्क जोड़े</button> ' : false;
									?>
                                    </td>
                                </tr>
                                <?php $i++; $sn++;  } ?>
                            </tbody>
                        </table>
						<form method="post" action="" id="multi_file_post_frm">
							<input type="hidden" value="0" id="file_total_slct_count"/>
							<input type="hidden" value="" id="file_emp_mark_id" name="file_emp_mark_id" />
							<input type="hidden" value="0" id="file_selected_file_ids" name="file_selected_file_ids"/>
							<input type="hidden" value="<?php echo $login_emp_level['emprole_level']; ?>" id="emp_login_level"/>
							<input type="hidden" value="<?php echo $this->uri->segment(1) ?>" id="today_sec_permission" name="today_sec_permission"/>
					  </form>
						<div style="clear:both"></div>
							<div class="row">
								<div class="col-sm-5">
									<div class="dataTables_info pull-left" id="example1_info" role="status" aria-live="polite">Showing <?php if(isset($_GET['per_page']) && !empty($_GET['per_page'])){ echo @$_GET['per_page'];}else{ if($total_files==0){ echo 0;}else{echo '1';}} ?> to <?php if($total_files==0){ echo 0;}else{ echo ($perpage+@$_GET['per_page']);} ?> of <span class="label label-primary">&nbsp;<?php echo $total_files; ?>&nbsp;</span> entries</div>
								</div>
								<div class="col-sm-7">
									<div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">							
										<?php  foreach ($links as $link) {
													echo $link;
												} 
										?>								
									</div>
									<form name="search_from" id="search_from" method="get" action="<?php show_current_url(); ?>">
										<div class="col-sm-5 pull-right">
											<!--<div id="example1_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="Section & CR number,Subject,UO No.& Date" aria-controls="example1"></label></div>-->
											<div class="input-group">
												<?php if(isset($_GET['section_id']) && $_GET['section_id']!=''){?>
													<input type="hidden" name="section_id" value="<?php echo $_GET['section_id']?>">
												<?php } ?>
												<input type="search" required name="searchby" class="form-control" placeholder="Section & CR number,Subject,UO No.& Date" aria-controls="example1" value="<?php if(isset($_GET['searchby']) && $_GET['searchby']!=''){ echo $_GET['searchby'];} ?>">
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
							<?php if(check_est_so()){ ?>
							<div style="margin: 10px;" class="pull-right">
								<select disabled id="auto_file_received_value" class="form-control btn btn-sm btn-twitter auto_file_received_value" style="width:150px;font-size:14px;text-align:left">
									<?php if($this->uri->segment(1)!= 'today') { ?><option>चयनित नस्तिया प्राप्त करें</option><?php } ?>
									<option value="<?php echo $emp_session_id ;?>">केवल फाइल  को प्राप्त करें</option>
								<?php $employees  = get_establishment_employees_with_des(false); ?>
									<?php foreach($employees as $emp => $emp_details) { ?>
											<option value="<?php echo $emp_details->emp_id; ?>"><?php echo getemployeeName($emp_details->emp_id,true); ?></option>
									<?php } ?>
								</select>
							</div>
							<?php } ?>
						</div>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>

        <!-- Main row -->
</section><!-- /.content -->
<?php $this->load->view('view_footer_script'); ?>
<?php $this->load->view('view_file/open_popup_forda') ; ?>
<style type="text/css">
    #leave_employee_filter{
        clear: both;
    }
</style>

