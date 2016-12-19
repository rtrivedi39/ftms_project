<?php $userrole = checkUserrole();
$login_emp_level= get_emp_role_levele();
$emp_session_id =  emp_session_id() ;
$emp_section = explode(',',$this->session->userdata('emp_section_id'));
$sub_sec_file_type = $this->input->get('sstype') != '' ? $this->input->get('sstype') : '';
//pre($emp_section);
?>
<!-- Content Header (Page header) -->
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
	<?php if(($this->uri->segment(1)=='efile' || $this->uri->segment(1)=='e-files') && $this->uri->segment(2)!=''){ /*this is use for view e-file*/ ?>
	<?php }else{ ?>
		<?php $this->load->view('view_file/view_file_header'); ?>
	<?php } ?>
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
		<?php if(in_array(2,$emp_section) || in_array(10,$emp_section)) {?>
		<select  id="section_file_type_ddl" name="section_file_type_ddl" class="form-control btn btn-sm btn-info " style="width:150px;font-size:14px;text-align:left">
			<option value="">फ़ाइल के प्रकार का चयन करें</option>
				<?php foreach(get_civil_file_type() as $ky => $dname){ ?>
					<option value="<?php echo $ky; ?>" <?php echo ($sub_sec_file_type != '' && $ky == $sub_sec_file_type) ? 'selected' : ''; ?>><?php echo $dname; ?> </option>				
				<?php } ?>
		</select> 
		<?php } ?>
		<?php if(isset($_GET['test']) &&$_GET['test'] == 'test'){?>
        <?php if($this->uri->segment(1)!='today') { ?>
			<select disabled id="auto_add_draft_value_ajax" class="form-control btn btn-sm btn-primary " style="width:150px;font-size:14px;text-align:left">
				<option  class="blink_fast" >टीप  का चयन करें</option>
				<option>अनुमोदनार्थ | </option>
				<option>अनुमोदित  |</option>
				<option>अनुमोदनार्थ एवं आदेशार्थ  |</option>
				<option>यथा प्रस्तावित |</option>
				<option>आदेश की प्रतियां प्रेषित की जावे |</option>
				<option>य. प्र. अनुमोदित |</option>
				<option>नस्ती पुनः मतार्थ प्रस्तुत है |</option>
				<option>देखा गया |</option>
			</select>
			<?php } ?>
			<?php } ?>
			<select disabled id="auto_file_received_value" class="form-control btn btn-sm btn-twitter auto_file_received_value" style="width:150px;font-size:14px;text-align:left">
                <?php if($this->uri->segment(1)!= 'today') { ?><option >चयनित नस्तिया प्राप्त करें </option><?php } ?>
                <option value="<?php echo $emp_session_id ;?>">केवल फाइल  को प्राप्त करें</option>
				<?php $dalist= modules::run('view_file/section_da_name',true);?>
				<?php foreach($dalist as $ky=>$dname){ ?>
					<option value="<?php echo $dname['emp_id']; ?>"><?php if($dname['emp_detail_gender']=='m'){ $pre_name='श्री  '; }else if($dname['emp_detail_gender']=='f'){ $pre_name='सुश्री  ';}  echo  $pre_name.$dname['emp_full_name_hi']; ?> </option>				
				<?php } ?>
			</select>
		
		<button onclick="printContents('divname')" class="btn btn-primary no-print">Print</button>
      
        <button class="btn  btn-warning" title="Back" onclick="goBack()"><?php echo $this->lang->line('Back_button_label'); ?></button>
    </div>

</div><!-- /.box-header -->
<div class="box-body">
    <marquee behavior="alternate" class="text-center bg-success" scrollamount="2">
        <!--<b style="color:red;"> प्रमुख सचिव के आदेश अनुसार सभी फाइलें 2 दिवस के अन्दर ही प्राप्त करे या अस्वीकार करे अन्यथा अस्वीकारे का बटन दिखाई नहीं देगा|</b>-->
        <b class="text-left text-success"> <img src="http://10.115.254.213//themes/site/images/gif-new.gif"> कृपया नए कार्य विभाजन आदेश दिनांक 21-11-2016 के अनुसार ही नस्तियां अधिकारी को भेजें|</b> 
    </marquee>
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
                       
                            <a href="<?php echo current_url().$p1.'/?section_id='.$empsec ; ?>" <?php echo $cls ; ?>><?php echo getSection($empsec) ; ?></a>
                        <?php }	} $i++; }?>
                <a href="<?php echo current_url()?>" class="btn bg-purple btn-flat margin" ><?php echo "सभी फ़ाइल्" ; ?></a>
            <?php } ?>
        </form>
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
        <table class="table table-bordered table-striped display">
            <thead style="background-color:white">
            <tr>
                <th><?php echo $this->lang->line('sno'); ?></th>
                <th><?php echo $this->lang->line('section_no1'); ?></th>
                <th><?php echo $this->lang->line('view_file_subject'); ?></th>
                <th><?php echo $this->lang->line('uo/letter_no'); ?></th>
                <th><?php echo $this->lang->line('view_file_uo_letter_date'); ?></th>
                <th><?php echo $this->lang->line('view_file_mark_section_id'); ?></th>
                <!--<th><?php// echo $this->lang->line('view_mark_section_date'); ?></th>-->
                <th>विभाग</th>
                <th><?php echo $this->lang->line('date'); ?></th>
                <th><?php echo $this->lang->line('filestatus'); ?></th>
                <th><?php echo $this->lang->line('actions'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php $i=1; foreach ($get_files as $key => $files) {
                $rrt = all_getfilesec_id_byfileid($files->file_id);
                $diff=date_diff(date_create($files->file_update_date),date_create(date("Y-m-d")));
                $checkdate = $diff->format("%a");
                ?>
                <tr <?php
                if($checkdate >= '3' && $checkdate <= '7') { echo "style='background-color:#F3E212' data-toggle='tooltip' data-original-title='३ दिन से अधिक विलंब'";
                } else if($checkdate >= '7' && $checkdate <= '10') { echo "style='background-color:#ffb743' data-toggle='tooltip' data-original-title='७ दिन से अधिक विलंब'";
                } else if($checkdate >= '10') { echo "style='background-color:#FFA4A4' data-toggle='tooltip' data-original-title='१० दिन से अधिक विलंब'";}
                ?>>
                    <td><?php echo $i;?> <span style="display:none">(<?php echo $this->lang->line('file_no'); ?> : <?php echo $files->file_id;?>) </span>
                        <br/>
                        <?php foreach($rrt as $rrt2){ if($rrt2['section_id'] == '1'){  $crvalue = $rrt2['section_number']; }} ?><?php echo "CR-".$crvalue; ?>
                        <br/>
                        <input type="checkbox" class="chk_slct_file" id="row_id_<?php echo $files->file_id; ?>" value="<?php echo $files->file_id; ?>" name="fileIds" style="font-size:26px;"/>
                    </td>
                    <td>
                        <a href="<?php echo base_url()."view_file/viewdetails/".$files->file_id ;?>" data-toggle="tooltip" data-original-title="View details">
                        <?php 
						$section_id_check = '';
						foreach($rrt as $rrt1){ if($rrt1['section_id'] != '1' && $rrt1['section_id'] != '8'){
                            $sechi = explode('(',getSection($rrt1['section_id']));
                            if($rrt1['section_id'] == $files->file_mark_section_id){ ?>
                            <span class="label bg-green" title="शाखा पंजी क्र."style="font-size: 14px;">
                            <?php echo $rrt1['section_number']." " ;   ?>
                             </span>
                            <?php }else{
                                echo "<span style='font-size: 12px'>".$sechi['0']."</span> : ".$rrt1['section_number'] ."<br/>";
                            }
							$section_id_check[] =  $rrt1['section_id'];
							}}  
							if(!in_array($files->file_mark_section_id,$section_id_check)){
									echo "N/A";
							}
							?>
                        </a>
                        <?php if(isset($files->old_registared_no) && ($files->old_registared_no != 0 )){
                            echo "<br><span title='पुराना रजिस्टर नंबर' > ORN : ".$files->old_registared_no ."</span>";
                        } ?>
                    </td>
                    <td><?php echo $files->file_subject;?>
                        <br><?php if(isset($files->scan_id) && $files->scan_id != ''){ show_scan_file($files->scan_id);}?>
                        <br><?php if(isset($files->file_status) && $files->file_status != ''){ show_file_status($files->file_status);}?>
                    </td>
                    <td><?php echo $files->file_uo_or_letter_no; ?> (<?php echo getFileType($files->file_type) ;?>)
						<br><span class="badge bg-light-blue"> प्रेषक नाम : <?php echo isset($files->file_sender_emp_id)? getemployeeName($files->file_sender_emp_id, 'hindi'):'' ?></span>
						<?php 
							if((($this->uri->segment(1)=='e-files' || $this->uri->segment(1)=='efile') && $files->final_draft_id !='' ) || (($this->uri->segment(1)=='view_file' || $this->uri->segment(1)=='today') && $files->final_draft_id=='' || $this->uri->segment(1)=='today')){
								$draft_creator_detail=null;
								$draft_creator_detail = is_notehseet_finalized($files->file_id,null,null,'file_creator_id');															
								if(isset($_GET['test']) && $_GET['test']=='bij'){
									echo 'bije-1';
									pre($draft_creator_detail);									
								}
														
							?>
						<br/>
						<div class="badge bg-green" style="margin-top: 130px;"> सृजक नाम : <?php echo isset($draft_creator_detail['draft_creater_emp_id'])? getemployeeName($draft_creator_detail['draft_creater_emp_id'], 'hindi'):'N/A'; ?></div>
						<?php } ?>
						</td>
                    <td><?php echo date_format(date_create($files->file_uo_or_letter_date), 'd/m/y'); ?></td>
                    <td><?php echo getSection($files->file_mark_section_id); ?>
                    </td>
              
                    <td><?php
                        $file_from = file_from_type();
                        $high_bench =  highcourt_bench();
                        if(isset($files->file_Offer_by)){

                            echo   $files->file_Offer_by == 'c' || $files->file_Offer_by == 'jvn' ? (isset( $file_from[$files->file_Offer_by] )? $file_from[$files->file_Offer_by] :'')." , ". (isset($files->district_name_hi)?$files->district_name_hi:'') : false ;
                            echo   $files->file_Offer_by == 'm' || $files->file_Offer_by == 'u' ? (isset($file_from[$files->file_Offer_by])?$file_from[$files->file_Offer_by]:'') ." , ". (isset($high_bench[$files->court_bench_id])?$high_bench[$files->court_bench_id]:'') : false ;
                            echo   $files->file_Offer_by == 'sc' ? (isset($file_from[$files->file_Offer_by])?$file_from[$files->file_Offer_by]:'') ." , Delhi , दिल्ली" : false ;
                            echo   $files->file_Offer_by == 'v' || (isset($files->dept_name_hi)?$files->dept_name_hi:'') ? (isset($file_from[$files->file_Offer_by])?$file_from[$files->file_Offer_by]:'') ." , ". (isset($files->dept_name_hi)?$files->dept_name_hi:'') ." ".(isset($files->file_department_name)?$files->file_department_name:'') : (isset($files->file_department_name)?$files->file_department_name:'');
                        }	?>
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
                        } ?>
                    </td>
                    <td width="150px">
                        <?php
						if(($this->uri->segment(1)=='e-files' || $this->uri->segment(1)=='efile') && $files->final_draft_id =='' && $login_emp_level['role_id']=='37'){ /*For Incharge*/
                            echo $this->uri->segment(1) =='e-files' && ($files->file_hardcopy_status == 'working' || $files->file_hardcopy_status == 'received' ) && $emp_session_id == $files->file_received_emp_id   ? '<a href="'.base_url().'efile/'.$files->file_id.'" class="btn btn-sm btn-block btn-warning"> ई- फाइल देखें</a>'  : false;
						}else{
                            echo $this->uri->segment(1) =='e-files' && $files->file_hardcopy_status == 'received' && $emp_session_id == $files->file_received_emp_id   ? '<a href="'.base_url().'efile/'.$files->file_id.'" class="btn btn-sm btn-block btn-warning"> ई- फाइल देखें</a>'  : false;
						}  
                        //echo $this->uri->segment(1) =='e-files' && $files->file_hardcopy_status == 'received' && $emp_session_id == $files->file_received_emp_id   ? '<a href="'.base_url().'efile/'.$files->file_id.'" class="btn btn-sm btn-block btn-warning"> ई- फाइल देखें</a>'  : false;
                        if((($this->uri->segment(1)=='e-files' || $this->uri->segment(1)=='efile') && $files->final_draft_id =='' && $login_emp_level['role_id']=='37') || (($this->uri->segment(1)=='e-files' || $this->uri->segment(1)=='efile') && $files->final_draft_id !='' ) || (($this->uri->segment(1)=='view_file' || $this->uri->segment(1)=='today') && $files->final_draft_id=='')){ //
                            $senderemp = empdetails($files->file_sender_emp_id);
                            $daids = explode(',',get_daorunder_empid());
                            $sections = explode(',',getEmployeeSection());
                            $is_draft_detail=null;
                            $is_draft_detail = is_notehseet_finalized($files->file_id,$emp_session_id ,null,'loggedin_usr_draf_added');

                            if(is_array($this->session->userdata('today_permission_assign'))){
                                $is_subuser = ' ?subuse= '.$this->session->userdata['today_permission_assign']['today_permission_given_empid'];
                            }else{
                                $is_subuser = '';
                            }
                            if($senderemp[0]['role_id'] == '9' || $senderemp[0]['role_id'] == '8' || $senderemp[0]['role_id'] == '39' || !in_array($files->file_sender_emp_id,$daids)){
                                if($files->file_hardcopy_status == 'not'){
                                    echo   $this->uri->segment(1) ==  'e-files' && $files->file_hardcopy_status == 'not' && $emp_session_id == $files->file_received_emp_id  ? '<button onclick="receive_efile('.$files->file_id.',&#39;'.$files->file_status.'&#39;)" class="btn btn-block btn-sm btn-twitter rty6" value="'.$files->file_id.'"><span class="blink_fast"><i class="fa fa-angle-double-down"></i> '.$this->lang->line('receive_file').'</span></button>' : false;
                                    if($senderemp[0]['role_id'] == '9' || $senderemp[0]['role_id'] == '39') {
                                        echo $this->uri->segment(1) != 'e-files' && $files->file_hardcopy_status == 'not' && $emp_session_id == $files->file_received_emp_id ? '<button onclick="receive_markda(' . $files->file_id . ',&#39;' . $files->file_status . '&#39;)" class="btn btn-block btn-sm btn-twitter rty6" value="' . $files->file_id . '"><span class="blink_fast"><i class="fa fa-angle-double-down"></i> ' . $this->lang->line('receive_file') . '</span></button>' : false;
                                        if($checkdate < '5' || $files->file_mark_section_id == '10'){
                                            echo  ($files->file_hardcopy_status == 'not' && $emp_session_id == $files->file_received_emp_id)  ? '<a data-toggle="tooltip" data-original-title="वापस आवक शाखा में भेजें"  onclick="open_model_cr('.$files->file_id.',&#39;' . $files->file_status . '&#39;)" class="btn btn-block btn-sm btn-instagram sections_name" data-toggle="tooltip" data-original-title="Reject"><i class="fa fa-reply"></i> '.$this->lang->line('reject').'</a>' : false;
                                        }
                                    } else{
                                        echo $this->uri->segment(1) != 'e-files' && $files->file_hardcopy_status == 'not' && $emp_session_id == $files->file_received_emp_id ? '<button onclick="open_model3('.$files->file_id.',&#39;'.$files->file_status.'&#39;)" value="'.$files->file_id.'" class="btn btn-block btn-twitter"><span class="blink_fast" data-toggle="tooltip" data-original-title="Receive">'.$this->lang->line('receive_file').'</span></button>' : false;
                                        echo $this->uri->segment(1) != 'e-files' && $this->uri->segment(1) != 'efile' && $files->file_hardcopy_status == 'not' && $emp_session_id == $files->file_received_emp_id ? '<a data-toggle="tooltip" data-original-title="अस्वीकार करने पर यह फाइल पिछले स्तर पर चली जाएगी |" onclick="return confirm_reject()" href="'.base_url().'manage_file/send_file_return/'.$files->file_id.'" class="btn btn-block btn-sm btn-instagram" data-toggle="tooltip" data-original-title="Reject">'.$this->lang->line('reject').'</a>' : false;
                                    }
                                } else {
                                    echo $files->file_hardcopy_status == 'received' && emp_session_id() == $files->file_received_emp_id  ? '<a href="' . base_url() . 'scan/dealing/' . $files->file_id . '" class="btn btn-block btn-sm btn-twitter" data-toggle="tooltip" data-original-title="Modify"><i class="fa fa-fw fa-edit"></i>बदलाव करें</a>' : false;
                                    if((isset($is_draft_detail['draft_status']) && ($is_draft_detail['draft_status']==3 || $is_draft_detail['draft_status']==2)) || (($this->uri->segment(1)=='view_file' || $this->uri->segment(1)=='today') && strtolower($files->file_status)=='p')){
                                        echo  ($senderemp[0]['role_id'] == '9' || $senderemp[0]['role_id'] == '39') && $emp_session_id == $files->file_received_emp_id ? '<a href="'.base_url().'File/work/'.$files->file_id.'" class="btn btn-block btn-twitter"><i class="fa fa-street-view"></i>सहायक को अंकित करें</a>' : '<button onclick="open_model6('.$files->file_id.',&#39;'.$files->file_status.'&#39;)" class="btn btn-sm btn-twitter btn-block rty6" value="'.$files->file_id.'" data-toggle="tooltip" data-original-title="Mark to DA"><i class="fa fa-street-view"></i> सहायक को अंकित करें</button>';
                                    }
                                }
                            }else{
                                echo in_array($files->file_sender_emp_id,$daids) && $files->file_hardcopy_status == 'not' && $emp_session_id == $files->file_received_emp_id ? '<button onclick="receive_efile('.$files->file_id.',&#39;'.$files->file_status.'&#39;)" class="btn btn-block btn-sm btn-twitter rty6" value="'.$files->file_id.'"><span class="blink_fast"><i class="fa fa-angle-double-down"></i> '.$this->lang->line('receive_file').'</span></button>' : false; // file receive from dealing assistant
                                echo !in_array($files->file_sender_emp_id,$daids) && $files->file_hardcopy_status == 'not' && $emp_session_id == $files->file_received_emp_id ? '<button onclick="open_model3('.$files->file_id.',&#39;'.$files->file_status.'&#39;)" value="'.$files->file_id.'" class="btn btn-block btn-twitter"><span class="blink_fast" data-toggle="tooltip" data-original-title="Receive">'.$this->lang->line('receive_file').'</span></button>' : false;
                                echo ($this->uri->segment(1) != 'e-files' && $this->uri->segment(1) != 'efile') && $files->file_hardcopy_status == 'not' && $emp_session_id == $files->file_received_emp_id ? '<a data-toggle="tooltip" data-original-title="अस्वीकार करने पर यह फाइल पिछले स्तर पर चली जाएगी |" onclick="return confirm_reject()" href="'.base_url().'manage_file/send_file_return/'.$files->file_id.'" class="btn btn-block btn-sm btn-instagram" data-toggle="tooltip" data-original-title="Reject">'.$this->lang->line('reject').'</a>' : false;
                                if((isset($is_draft_detail['draft_status']) && ($is_draft_detail['draft_status']==3 || $is_draft_detail['draft_status']==2)) || (($this->uri->segment(1)=='view_file' || $this->uri->segment(1)=='today') && strtolower($files->file_status)=='p')){
                                    echo $files->file_hardcopy_status == 'received' && $emp_session_id == $files->file_received_emp_id ? '<button onclick="open_model6('.$files->file_id.',&#39;'.$files->file_status.'&#39;)" class="btn btn-sm btn-twitter btn-block rty6" value="'.$files->file_id.'" data-toggle="tooltip" data-original-title="Mark to DA"><i class="fa fa-street-view"></i> सहायक को अंकित करें</button>' : false;
                                }
                            }
                            if((isset($is_draft_detail['draft_status']) && ($is_draft_detail['draft_status']==3 || $is_draft_detail['draft_status']==2)) || (($this->uri->segment(1)=='view_file' || $this->uri->segment(1)=='today') && strtolower($files->file_status)=='p')){
                                echo  ($files->file_hardcopy_status == 'received' || $files->file_hardcopy_status == 'working') && $emp_session_id == $files->file_received_emp_id ? '<button onclick="open_model2('.$files->file_id.',&#39;'.$files->file_status.'&#39;)" value="'.$files->file_id.'"  class="btn btn-sm btn-block btn-twitter upperuser" data-toggle="tooltip" data-original-title="Send to officer"><i class="fa fa-send"></i> अधिकारी को भेजें</button>' : false;
                                echo ($files->file_hardcopy_status == 'received' || $files->file_hardcopy_status == 'working') && $emp_session_id == $files->file_received_emp_id ? '<button onclick="section_section('.$files->file_id.',&#39;'.$files->file_status.'&#39;,'.$files->file_mark_section_id.')" value="'.$files->file_id.'"  class="btn btn-sm btn-block btn-warning sections_nm" data-toggle="tooltip" data-original-title="Section to Section movement"><i class="fa fa-arrows-h"></i> Section to Section</button> ' : false;
                            }
                            if(in_array(11,$sections)){
                                echo $files->file_hardcopy_status == 'received' && $emp_session_id == $files->file_received_emp_id ?  '<button type="button" class="btn btn-sm btn-instagram btn-block rty1 dispatch_btn" data-toggle="modal" data-file_id="'.$files->file_id.'" id="" data-target="#dispatch_model" data-toggle="tooltip" data-original-title="Send to Dispatch"> जावक शाखा में भेजें</button>' : false;
                            } else {
                                echo ($files->file_hardcopy_status == 'received' || $files->file_hardcopy_status == 'working') && $emp_session_id == $files->file_received_emp_id && $files->file_return != '' ? '<a  onclick="send_despetch_section('.$files->file_id.',&#39;'.$files->file_status.'&#39;)" class="btn btn-sm btn-success btn-block rty1" value="'.$files->file_id.'" data-toggle="tooltip" data-original-title="Send to Dispatch"><i class="fa fa-send"></i> जावक शाखा में भेजें</a> ' : false;
                            }
                            echo ($files->file_hardcopy_status == 'received' || $files->file_hardcopy_status == 'working') && $emp_session_id == $files->file_received_emp_id ? '<button onclick="open_model_dispose('.$files->file_id.')" class="btn btn-sm btn-block btn-danger rty1" value="'.$files->file_id.'" data-toggle="tooltip" data-original-title="Dispose in section"><i class="fa fa-sort-down"></i> शाखा में बंद करें</button> ' : false;
                            echo $this->uri->segment(1) != 'e-files' && $this->uri->segment(1) != 'efile' && $files->file_hardcopy_status == 'received' && $emp_session_id == $files->file_received_emp_id ? '<button onclick="open_model5('.$files->file_id.',&#39;' . $files->file_status . '&#39;)" value="'.$files->file_id.'"  class="btn btn-block btn-sm btn-danger sections_name" data-toggle="tooltip" data-original-title="Return to CR"><i class="fa fa-reply"></i> आवक शाखा में भेजें</button> '  : false;
                        }else {
						if($this->uri->segment(1)=='today'){
						echo "नस्ती का चयन कर सहायक को मार्क करे  |";
							}else{
							if($files->final_draft_id == '' && $files->file_hardcopy_status != 'received' ){
                                echo 'यह फाइल, <a href="#" class="badge bg-light-blue" >फाइल देखें </a>से प्राप्त करें !';
                            }else if($files->file_hardcopy_status != 'received' ){
                                echo 'यह फाइल,  <a href="'.base_url().'e-files/inbox?searchby='.$crvalue.'" class="badge bg-light-blue" >अंकित ई-फ़ाइलें (Inbox)</a>से प्राप्त करें !';
                            }elseif($files->file_hardcopy_status=="received"){
                                echo '<a href="'.base_url().'e-files/inbox?searchby='.$crvalue.'" class="badge bg-light-blue" >अंकित ई-फ़ाइलें (Inbox)</a>पर कार्यवाही करें !' ;
                            }
							}
						}
						
						echo ($files->file_hardcopy_status == 'received' || $files->file_hardcopy_status == 'working') && emp_session_id() == $files->file_received_emp_id ? '<button type="button" class="btn btn-sm btn-primary btn-block remarkbtn_model" data-file_id="'.$files->file_id.'" data-toggle="modal" data-target="#remarkmodel_all_section" data-toggle="tooltip" data-original-title="फाइल से  सम्बंधित रिमार्क जोड़ें ">रिमार्क जोड़े</button> ' : false;
						?>
                    </td>
                </tr>
                <?php $i++;
					unset($crvalue);
					} ?>
            </tbody>
        </table>
		<form method="post" action="" id="multi_file_post_frm">
            <input type="hidden" value="0" id="file_total_slct_count"/>
            <input type="hidden" value="" id="file_emp_mark_id" name="file_emp_mark_id" />
            <input type="hidden" value="0" id="file_selected_file_ids" name="file_selected_file_ids"/>
            <input type="hidden" value="<?php echo $login_emp_level['emprole_level']; ?>" id="emp_login_level"/>
            <input type="hidden" value="<?php echo $this->uri->segment(1) ?>" id="today_sec_permission" name="today_sec_permission"/>
	  </form>
        <?php if($this->uri->segment(1)=='efile' && $this->uri->segment(2)!=''){ /*this is use for view e-file*/ ?>
        <?php }else{ ?>		
		<div id="bottom_anchor"></div> <!---use for fix table header-->
		
		<div class="row">
			<div class="col-sm-5">
					<div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing <?php if(isset($_GET['per_page']) && !empty($_GET['per_page'])){ echo @$_GET['per_page'];}else{ if($total_files==0){ echo 0;}else{echo '1';}} ?> to <?php if($total_files==0){ echo 0;}else{ echo ($perpage+@$_GET['per_page']);} ?> of <span class="label label-primary">&nbsp;<?php echo $total_files; ?>&nbsp;</span> entries</div>
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
			<div style="margin: 10px;" class="pull-right">
		<select disabled id="auto_file_received_value" class="form-control btn btn-sm btn-twitter auto_file_received_value" style="width:150px;font-size:14px;text-align:left">
			<?php if($this->uri->segment(1)!= 'today') { ?><option>चयनित नस्तिया प्राप्त करें</option><?php } ?>
                <option value="<?php echo $emp_session_id ;?>">केवल फाइल  को प्राप्त करें</option>
				<?php $dalist= modules::run('view_file/section_da_name',true);?>
				<?php foreach($dalist as $ky=>$dname){ ?>
					<option value="<?php echo $dname['emp_id']; ?>"><?php if($dname['emp_detail_gender']=='m'){ $pre_name='श्री  '; }else if($dname['emp_detail_gender']=='f'){ $pre_name='सुश्री  ';}  echo  $pre_name.$dname['emp_full_name_hi']; ?> </option>				
				<?php } ?>
			</select>
		</div>
</div>
    </div>
</div><!-- /.box-body -->
</div><!-- /.box -->
</div>

<!-- Main row -->
</section><!-- /.content -->
<?php } ?>
<?php $this->load->view('index_script_footer.php') ?>
<script>
    function receive_efile(file,file_status){
		var file2 = file;
		$(".physical_file").prop( "checked", false );
		$(".electronic_file").prop( "checked", false );
		$(".physical_file").prop( "disabled", false );
		$(".electronic_file").prop( "disabled", false );
		var efile = "<?php echo $this->uri->segment(1)?>";
		if(efile != 'e-files' && efile != 'efile' ){
				$(".physical_file").prop( "checked", true );
				$(".physical_file").prop( "disabled", true );
				$(".electronic_file").prop( "disabled", true );
				$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="p"  >');
		}
		else{
			
			if(file_status == 'p' ){
				$(".physical_file").prop( "checked", true );
				$(".physical_file").prop( "disabled", true );
				$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="p"  >');
			 }
			if(file_status == 'e'){
				$(".electronic_file").prop( "checked", true );
				$(".physical_file").prop( "disabled", true );
				$(".electronic_file").prop( "disabled", true );
				$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="e"  >');
			   }
			if(file_status == 'p,e' || file_status == 'e,p'){
			
			$(".physical_file").prop( "checked", true );
			$(".electronic_file").prop( "checked", true );


			$(".electronic_file").prop( "disabled", true );
			$(".physical_file").prop( "disabled", true );




			$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="e"  ><input type="hidden"  name="file_status[]" class="form-group" value="p"  >');
			
			

			  }
		 }         
			$('#modal-id2').val(file2);
			$('#modal-da_receive').modal('show');
			$('#form_submit_link_file_status').attr('action','<?php echo base_url() ;?>manage_file/receive_file_sectionno/'+file2);
     }
</script>
<div class="modal fade" id="modal-da_receive" data-backdrop="static">
    <div class="modal-dialog">
        <!-- <form action="<?php echo base_url() ;?>manage_file/return_file" method="post" >-->
        <form id="form_submit_link_file_status" action="<?php echo base_url() ;?>manage_file/receive_file_sectionno/" method="post" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-edit"></i>फाइल प्राप्त करे </h4>
                </div>
                <div class="modal-body">
                    <div class="box-body table-responsive">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <input type="hidden" id="modal-id" name="fileids">
                                    <div class="form-group">
                                        <label>कृप्या सुनिश्चित करे की आपके पास फाइल आई है अथवा नही ?</label>
                                    </div>
                                    <div class="form-group checkbox">
                                         <label>
                                         <input type="checkbox" id="physical_file_1" name="file_status[]" class="form-group physical_file" value="p"  >Physical File
											
									   </label>
                                        <label>
                                           <input type="checkbox" id="electronic_file_1" name="file_status[]" value="e" class="form-group electronic_file" >E-File
											
                                        </label>
											<div class="efile_div"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> रद्द</button>
                    <button id="btn-delete" type="submit" class="btn btn-primary"><i class="fa fa-check"></i> प्राप्त करें</button>
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

<?php $this->load->view('open_popup_for_despetch') ; ?>
