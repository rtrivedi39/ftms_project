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
                        <table id="view_table" class="table table-bordered table-striped display">
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
                            <?php $i=1; foreach ($get_files as $key => $files) {
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
                                        if($fno !=null){ echo "Cr :".$fno;} ?></td>
									<td><a href="<?php echo base_url()."view_file/viewdetails/".$files->file_id ;?>" data-toggle="tooltip" data-original-title="View details"><?php echo @getfilesec_id_byfileid($files->file_id,$files->file_mark_section_id,$files->file_type) ? getfilesec_id_byfileid($files->file_id,$files->file_mark_section_id,$files->file_type) : 'N/A'; ?></a></td>
                                    <td><?php echo $files->file_subject;?>
										<br><?php if(isset($files->file_status) && $files->file_status != ''){ show_file_status($files->file_status);}?>	
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
                                        <?php $senderemp = empdetails($files->file_sender_emp_id);
                                        if(is_array($this->session->userdata('today_permission_assign'))){
                                            $is_subuser='?subuse='.$this->session->userdata['today_permission_assign']['today_permission_given_empid'];
                                        }else{
                                            $is_subuser='';
                                        }
                                        if($files->file_return == '2' && $files->file_hardcopy_status != 'not'){
                                            echo    '<a onclick="return confirm_send()" href="'.base_url().'manage_file/dispatch_file_byso/'.$files->file_id.'" class="btn btn-sm  btn-block btn-instagram" value="'.$files->file_id.'">जावक शाखा में भेजें</a>';
                                            echo   $files->file_hardcopy_status == 'received' && emp_session_id() == $files->file_received_emp_id && $files->file_level_id != '31' ? '<button onclick="open_model2('.$files->file_id.')" value="'.$files->file_id.'"  class="btn btn-sm btn-block btn-success upperuser" data-toggle="tooltip" data-original-title="Send to officer">अधिकारी को भेजें</button> ' : false;
                                            echo   $files->file_hardcopy_status == 'received' && emp_session_id() == $files->file_received_emp_id ? '<button onclick="open_model6('.$files->file_id.',&#39;'.$files->file_status.'&#39;)" class="btn btn-sm btn-info btn-block rty6" value="'.$files->file_id.'" data-toggle="tooltip" data-original-title="Mark to DA">सहायक को  अंकित करें</button>' : false;
                                        }else{


                                        // echo   $files->file_hardcopy_status == 'not' && emp_session_id() == $files->file_received_emp_id && $this->uri->segment(3) != 'return' ? '<a onclick="return confirm_receive()" href="'.base_url().'establishment/manage_file/receive_file_sectionno/'.$files->file_id.'" class="btn btn-block btn-twitter"><span class="blink_fast" data-toggle="tooltip" data-original-title="Receive">'.$this->lang->line('receive_file').'</span></a>' : false; // file receive from dealing assistant

                                        // echo   $files->file_hardcopy_status == 'not' && emp_session_id() == $files->file_received_emp_id ? '<button onclick="receive_markda('.$files->file_id.')" class="btn btn-block btn-sm btn-twitter rty6" value="'.$files->file_id.'"><span class="blink_fast">'.$this->lang->line('receive_file').'</span></button> <a data-toggle="tooltip" data-original-title="वापस भेजें" onclick="return confirm_reject()" href="'.base_url().'establishment/manage_file/reject_file/'.$files->file_id.'" class="btn btn-block btn-sm btn-instagram" data-toggle="tooltip" data-original-title="Reject">'.$this->lang->line('reject').'</a>' : false;
                                            echo   $files->file_hardcopy_status == 'not' && emp_session_id() == $files->file_received_emp_id ? '<button onclick="open_model3('.$files->file_id.',&#39;'.$files->file_status.'&#39;)" class="btn btn-block btn-sm btn-twitter rty6" value="'.$files->file_id.'"><span class="blink_fast">'.$this->lang->line('receive_file').'</span></button> ' : false;
												if($checkdate < '3'){
													echo  ($files->file_hardcopy_status == 'not' && $files->file_type != 'app' && emp_session_id() == $files->file_received_emp_id)  ? '<a data-toggle="tooltip" data-original-title="वापस भेजें" onclick="return confirm_reject()" href="'.base_url().'manage_file/send_file_return/'.$files->file_id.'" class="btn btn-block btn-sm btn-danger" data-toggle="tooltip" data-original-title="Reject">'.$this->lang->line('reject').'</a>'  : false;
												}
                                            
                                            echo   $files->file_hardcopy_status == 'received' && emp_session_id() == $files->file_received_emp_id ? '<button onclick="open_model6('.$files->file_id.',&#39;'.$files->file_status.'&#39;)" class="btn btn-sm btn-twitter btn-block rty6" value="'.$files->file_id.'" data-toggle="tooltip" data-original-title="Mark to DA">शाखा में ही मार्क करे </button>' : false;
                                            echo   $files->file_hardcopy_status == 'received' && emp_session_id() == $files->file_received_emp_id ? '<button onclick="open_model2('.$files->file_id.')" value="'.$files->file_id.'"  class="btn btn-sm btn-block btn-success upperuser" data-toggle="tooltip" data-original-title="Send to officer">अधिकारी को भेजें</button> ' : false;
                                            echo   $files->file_hardcopy_status == 'received' && $files->file_type != 'app' && emp_session_id() == $files->file_received_emp_id ? '<button onclick="section_section('.$files->file_id.',&#39;'.$files->file_status.'&#39;)" value="'.$files->file_id.'"  class="btn btn-sm btn-block btn-warning sections_nm" data-toggle="tooltip" data-original-title="Section to Section movement">Section to Section</button> ' : false;
                                           // echo   $files->file_hardcopy_status == 'received' && $files->file_type != 'app' && emp_session_id() == $files->file_received_emp_id ? '<a onclick="return confirm_send()" href="'.base_url().'manage_file/dispatch_file_byso/'.$files->file_id.'" class="btn btn-sm btn-instagram btn-block" value="'.$files->file_id.'" data-toggle="tooltip" data-original-title="Send to Dispatch">जावक शाखा में भेजें</a> ' : false;
											 echo    $files->file_hardcopy_status == 'received' && $files->file_type != 'app' && emp_session_id() == $files->file_received_emp_id ? '<a onclick="send_despetch_section('.$files->file_id.',&#39;'.$files->file_status.'&#39;)" class="btn btn-sm btn-instagram btn-block" value="'.$files->file_id.'" data-toggle="tooltip" data-original-title="Send to Dispatch">जावक शाखा में भेजें</a> ' : false;
                                            echo   $files->file_hardcopy_status == 'received' && emp_session_id() == $files->file_received_emp_id ? '<button onclick="open_model_dispose('.$files->file_id.')" class="btn btn-sm btn-block btn-danger" value="'.$files->file_id.'" data-toggle="tooltip" data-original-title="Dispose in section">शाखा में Dispose</button> ' : false;
											echo   $files->file_hardcopy_status == 'received' && emp_session_id() == $files->file_received_emp_id ? '<button type="button" class="btn btn-sm btn-primary btn-block remarkbtn" data-file_id="'.$files->file_id.'" data-toggle="modal" data-target="#remarkmodel" data-toggle="tooltip" data-original-title="Add to remark">रिमार्क जोड़े</button> ' : false;
											echo   $files->file_hardcopy_status == 'received' && $files->file_type != 'app' && emp_session_id() == $files->file_received_emp_id   ? '<button onclick="open_model5('.$files->file_id.')" value="'.$files->file_id.'"  class="btn btn-block btn-sm btn-danger" data-toggle="tooltip" data-original-title="Return to CR"><i class="fa fa-reply"></i> आवक शाखा में भेजें</button> '  : false;
									   //     echo $files->file_hardcopy_status == 'received' && emp_session_id() == $files->file_received_emp_id ?  '<button type="button" class="btn btn-sm btn-instagram btn-block rty1" data-toggle="modal" data-file_id="'.$files->file_id.'" id="dispatch_btn" data-target="#dispatch_model" data-toggle="tooltip" data-original-title="Send to Dispatch"> जावक शाखा में भेजें</button>' : false;
                                        }	?>
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
<?php $this->load->view('view_footer_script'); ?>
<style type="text/css">
    #leave_employee_filter{
        clear: both;
    }
</style>

