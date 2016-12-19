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
		<div class="col-xs-12" > 
			<div class="box" >
				<div class="box-header">
					<h4> <?php  echo $this->input->post('sections') != '' ? 'मार्क किया गया अनुभाग : -  ' .getSection($this->input->post('sections'))  : ''; ?></h4>
					<h3 class="no-print">Searching files for printing </h3>
				</div>
				<div class="box-body">
					<form method="post" action="<?php echo base_url(); ?>view_file/search_files_cr" class="no-print">						
						<div class="col-xs-4">
							<select name="sections" class="form-control">
								<option value="">Select mark section </option>
								<?php $getSection = get_list(SECTIONS, null, null);
								foreach($getSection  as $section){ ?>
									<option value="<?php echo $section['section_id']; ?>" <?php echo @$this->input->post('sections') == $section['section_id'] ? "selected" : false?>><?php echo $section['section_name_hi'] ; ?></option>
								<?php  }?>
							</select>
							<?php echo form_error('sections');?>
						</div>                            
						<div class="col-xs-4">
							<input type="text"  name="search_date" id="search_date"  value="<?php echo @$this->input->post('search_date') ? $this->input->post('search_date') : ''  ?>" autocomplete="off" placeholder="Select marking date"  class="form-control date_picker">
							<?php echo form_error('search_date');?>
						</div>                    
						 
						<div class="col-xs-2">
							<button type="submit" class="btn btn-success">Search</button>
						</div>                          
						<div class="col-xs-2">
							<a  class="btn btn-primary" href="<?php echo base_url(); ?>show_file/ALL">View all</a>                       
						</div>
					</form>
				</div>
			</div>
		</div>
        <div class="col-xs-12">
            <div class="box" style="overflow: auto">
                <div class="box-header no-print">
                    <div style="float:left"><h3 class="box-title"><?php echo $title_tab;?></h3></div>
                    <div style="float:right">
                        <!--<button class="btn btn-block btn-info"><?php echo $this->lang->line('view_file_mark');?></button>-->
						<button onclick="printContents('divname')" class="btn btn-primary no-print">Print</button>
                        <button class="btn btn-warning no-print" title="Back" onclick="goBack()"><?php echo $this->lang->line('Back_button_label'); ?></button>
                        <a class="btn btn-info no-print" title="Add File" href="<?php echo base_url();?>add_file"><?php echo $this->lang->line('add_files'); ?></a>
                    </div>
                </div><!-- /.box-header -->
                <?php // echo $this->session->flashdata('message'); ?>
                <?php if($this->session->flashdata('message') || $this->session->flashdata('error')) {
                    $msg = $this->session->flashdata('message') ? 'success' : 'danger';
                    ?>
                    <div class="alert alert-<?php echo $msg; ?> alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php  echo $this->session->flashdata('message');
                        echo $this->session->flashdata('error'); ?>
                    </div>
                <?php } ?>
                <table id="view_table" class="table table-bordered table-striped display print_font">
                    <thead>
                    <tr>
                        <th><?php echo $this->lang->line('sno'); ?></th>
                        <th><?php echo $this->lang->line('section_no1'); ?></th>
                        <th><?php echo $this->lang->line('view_file_subject'); ?></th>
                        <th><?php echo $this->lang->line('uo/letter_no'); ?></th>
                        <th><?php echo $this->lang->line('view_file_uo_letter_date'); ?></th>
                        <th class="no-print"><?php echo $this->lang->line('view_mark_section'); ?></th>
						<th>विभाग</th>
                        <th><?php echo $this->lang->line('date'); ?></th>
                        <th class="no-print" width="100px"><?php echo $this->lang->line('filestatus'); ?></th>
                        <th  class="no-print"><?php echo $this->lang->line('actions'); ?></th>
                        <th  class="no-print">create by</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=1; foreach ($get_files as $key => $files) { ?>
                        <tr>
                            <td><?php echo $i;?></td>                            
                            <td>Cr : <?php
                                $fno =   getfilesec_id_byfileid($files->file_id,getusersection($files->createfile_empid),$files->file_type,$marksection=$files->file_mark_section_id);
                                if($fno==null){
                                    $fno1 =  getfilesec_id_byfileid($files->file_id,getusersection($files->createfile_empid),$files->file_type,'100');
                                    if($fno1 == null){
                                        echo "N/a";
                                    }else{
                                        echo $fno1;
                                    }
                                }else{ echo $fno; } ?>
                            </td>
							<td><?php echo $files->file_subject;?></td>
                            <td><?php echo $files->file_uo_or_letter_no; ?> (<?php echo getFileType($files->file_type) ;?>)</td>
                            <td><?php echo date_format(date_create($files->file_uo_or_letter_date), 'd/m/y'); ?></td>
                            <td class="no-print"><?php $marksection=$files->file_mark_section_id;
                                if($marksection==0){
                                    if($marksection==1){ echo 'व्यक्तिगत (Personal)';}else{ echo ' गोपनीय / सुरक्षित फ़ाइल'; }
                                }else{ echo getSection($files->file_mark_section_id);}?>
                            </td>
							<td><?php 
							 if($files->file_Offer_by) {					
                        $file_from = file_from_type();
                        $high_bench =  highcourt_bench();	
						                                                                            
						echo    $files->file_Offer_by == 'c' || $files->file_Offer_by == 'jvn' ? (isset($file_from[$files->file_Offer_by])?$file_from[$files->file_Offer_by]:'') ." , ".( isset($files->district_name_hi)?$files->district_name_hi:'') : false;
                        echo    $files->file_Offer_by == 'm' ? (isset($file_from[$files->file_Offer_by])?$file_from[$files->file_Offer_by]:'')." , ". (isset($high_bench[$files->court_bench_id])?$high_bench[$files->court_bench_id]:'') : false;
                        echo    $files->file_Offer_by == 'u' ? (isset($file_from[$files->file_Offer_by])?$file_from[$files->file_Offer_by]:'')  ." , ". (isset($high_bench[$files->court_bench_id])?$high_bench[$files->court_bench_id]:'') : false;
                        echo    $files->file_Offer_by == 'au' ? (isset($file_from[$files->file_Offer_by])?$file_from[$files->file_Offer_by]:'')." , ". (isset($file_details[0]['state_name_en'])?$file_details[0]['state_name_en']:'') : false;
                        echo    $files->file_Offer_by == 'v' ? (isset($file_from[$files->file_Offer_by])?$file_from[$files->file_Offer_by]:'') ." , ". (isset($files->dept_name_hi)?$files->dept_name_hi:'') : false;
                        echo    $files->file_Offer_by == 'o' ? (isset($file_from[$files->file_Offer_by])?$file_from[$files->file_Offer_by]:'') ." , ". (isset($files->file_department_name)?$files->file_department_name:'') : false;
                        echo    $files->file_Offer_by == 'sc' ? 'दिल्ली सुप्रीम कोर्ट ' : false;
                   
				   }
							?>
							</td>
                            <td><?php echo date("d-m-Y", strtotime($files->file_created_date));?></td>
                            <td class="no-print"><?php
                                $filereceiver = get_user_details($files->file_received_emp_id);
                                if ($filereceiver)
                                {
                                    if($files->file_hardcopy_status == 'not') {
                                        echo "<span style='color:#dd4b39' >Not Received by <b> ".ucfirst($filereceiver[0]->emp_full_name)."</b><br/> (".$filereceiver[0]->emprole_name_hi.")</span>";
                                    } else {
                                        echo "<span style='color:#00a65a' >Received by <b> ".ucfirst($filereceiver[0]->emp_full_name)."</b><br/> (".$filereceiver[0]->emprole_name_hi.")</span>";
                                    } } ?></td>
                            <td class="no-print">
                                <div class="btn-group">
                                    <a href="<?php echo base_url();?>view_file/viewdetails/<?php echo $files->file_id; ?>" class="btn btn-twitter">View <i class="fa fa-fw fa-search"></i></a>
                                    <?php if(emp_session_id()==$files->file_received_emp_id)
                                    { if($files->file_hardcopy_status == 'not') {  ?>
                                    <!--<a href="<?php echo base_url();?>dashboard/receive_edit/<?php echo $files->file_id; ?>" class="btn btn-twitter"><span class="blink_fast">Receive</span></a>-->
                                        <a onclick="return confirm_receive()" href="<?php echo base_url();?>manage_file/files_edit/receivebycr/<?php echo $files->file_id; ?>" class="btn btn-twitter"><span class="blink_fast">Receive</span></a>
                                    <?php } else { ?><a href="<?php echo base_url();?>dashboard/edit_file/<?php echo $files->file_id; ?>" class="btn  btn-twitter">Edit</a>
                                    <?php } }?>
                                </div>
                            </td>
						<td  class="no-print"><?php 
						$createfile_empid = get_user_details($files->createfile_empid);
						echo  ucfirst($createfile_empid[0]->emp_full_name) ?></td>	
                        </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
    <!-- Main row -->
</section><!-- /.content -->
<style type="text/css">
    #leave_employee_filter{
        clear: both;
    }
</style>
