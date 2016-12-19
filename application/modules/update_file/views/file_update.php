<?php

 ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo $title; ?>
        <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Update file</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
<!-- Your Page Content Here -->
<!-- Small boxes (Stat box) -->
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title"><?php echo $title_tab;?></h3>
				</div><!-- /.box-header -->
				
				<div class="box-body">
					<?php if($this->session->flashdata('message') || $this->session->flashdata('error')) {
						$msg = $this->session->flashdata('message') ? 'success' : 'danger';
						?>
						<div class="alert alert-<?php echo $msg; ?> alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong>
								<?php  echo $this->session->flashdata('message');
								echo $this->session->flashdata('error'); ?>
							</strong><br>
						</div>
					<?php }?>
					<div class="row">
						<form role="form" method="post" action="<?php echo base_url('update_file')?>/update_file/file_list"  enctype="multipart/form-data">
						<div class="col-md-2">
							<div class="form-group">
								<label for="label_file_id">Search File id</label>
							</div>
						 </div>
						 <div class="col-md-4">
							<div class="form-group">
								<input type="text" class="form-control" value="<?php echo @$file_id; ?>" name="search_file_id">
								<?php echo form_error('search_file_id'); ?>
							</div>
						 </div>
						 <div class="col-md-4">
							<div class="form-group">
								<button type="submit" class="btn btn-primary">खोजें</button>
							</div>
						 </div>
						 </form>
					</div>
				</div><!-- body -->
			</div><!-- box -->
		</div><!-- col -->
	</div><!-- row -->
		
<?php //pre($file_data);
if($file_data) { 
?>		
<div class="row">		
<div class="col-md-12">
    <!-- general form elements -->
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Update file</h3>
        </div><!-- /.box-header -->
        <form role="form" method="post" action="<?php echo base_url('update_file')?>/update_file/manage_file<?php if(isset($file_data['file_id'])){ echo '/'.$file_data['file_id'];} ?>"  enctype="multipart/form-data">
          <input type="hidden" name="file_id" value="<?php echo $file_id; ?>">
          <input type="hidden" name="file_mark_section_id" value="<?php echo $file_data['file_mark_section_id']; ?>">
		  <div class="box-body">
                <div class="row">
					<div class="col-md-12">
						<table class="tabel table-bordered">
							<tr><td>विषय  : </td><td><?php echo $file_data['file_subject']; ?></td></tr>
							<tr><td>प्रकार : </td><td><?php echo getFileType($file_data['file_type']);  ?></td></tr>
							<tr><td>पत्र क्रमांक : </td><td><?php echo $file_data['file_uo_or_letter_no']; ?></td></tr>
							<tr><td>पत्र दिनांक  : </td><td><?php echo get_date_formate($file_data['file_uo_or_letter_date']); ?></td></tr>
							<tr><td>अनुभाग  : </td><td><?php echo (@$file_data['section_name_hi'] ? $file_data['section_name_hi'] : '' ); ?>,<?php echo (@$file_data['section_name_en'] ? $file_data['section_name_en'] : '' );; ?></td></tr>
							<tr><td>पंजी क्रमांक  : </td><td> <?php
									$rrt = all_getfilesec_id_byfileid($file_data['file_id']);
									if($rrt){
										foreach($rrt as $rrt1){
											$sechi = explode('(',getSection($rrt1['section_id']));
											echo " <b>".$rrt1['section_number'] ."</b> - <span>".$sechi['0']."</span> | ";
										}
									}else{
										echo "N/A";
									}
									?></td></tr>
							<tr><td>जानकारी  : </td><td><a href="<?php echo base_url(); ?>view_file/viewdetails/<?php echo $file_id; ?>" target="_blank">देखें<a></td></tr>
							<tr><td>ई-फाइल कि जानकारी : </td><td><a href="<?php echo base_url(); ?>efile/<?php echo $file_id; ?>" target="_blank">देखें<a></td></tr>
							<tr><td>फाइल-प्रकार : </td><td><?php if(isset($file_data['file_status']) && $file_data['file_status'] != ''){ show_file_status($file_data['file_status']);} ?></td></tr>
							
						</table>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<?php //pre($file_data); ?>
						<div class="form-group">
							<label for="advocate_name">Advocate name (अधिवक्ता का नाम) <span class="text-danger">*</span></label>
							<select name="avocate_id" class="form-control">
							<option value="">Select </option>
							<?php foreach($advocts_list as $row){
								$selcted =  ((@$this->input->post('avocate_id') == $row->scm_id) || (!empty($file_data['order_generat_advocate_id']) && $file_data['order_generat_advocate_id'] == $row->scm_id ) ? 'selected' : '' ); 
								echo '<option value="'.$row->scm_id.'" '.$selcted.'>'.$row->scm_name_hi.'</option>';
							} ?>
							</select>
							<?php echo form_error('avocate_id');?>
						</div>
						
						<div class="form-group">
							<label for="sing_user">Officer Name (वकालतनामे  पर जिस अधिकारी ने हस्ताक्षर कए) <span class="text-danger">*</span></label>
							<?php 
								$uid = @$file_data['order_generat_officer_id'] ;
								echo get_officer_for_sign('sing_user' ,array(2,3,4,5,7) ,'', $uid,'form-control');
							?>
							<?php echo form_error('sing_user');?>
						</div>
						<?php 
							$part_array = explode('-विरुद्ध-',$file_data['case_parties']);
							$party_petition = $part_array[0];
							$Party_name_respondent = $part_array[1];
						?>
						<div class="form-group">
							<label for="file_subject">Petitioner (पक्षवादी)<span class="text-danger">*</span></label>
							<input type="text" name="party_petition" value="<?php echo (@$this->input->post('party_petition')) ? @$this->input->post('party_petition') : $party_petition ; ?>" class="form-control">
							<?php echo form_error('party_petition');?>
						</div>
						<div class="form-group">
							<label for="Party_name_respondent">Respondent (प्रतिवादी)<span class="text-danger">*</span></label>
							<input type="text" name="Party_name_respondent" value="<?php echo (@$this->input->post('Party_name_respondent')) ? @$this->input->post('Party_name_respondent') : $Party_name_respondent ; ?>" class="form-control">
							<?php echo form_error('Party_name_respondent');?>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="judgement_data">Lower court Judgement date(निचली अदालत का आदेश दिनांक) <span class="text-danger">*</span></label>
							<input type="text" name="judgement_data" id="judgement_data" value="<?php echo $file_data['file_judgment_date'] != "0000-00-00" ? date_format(date_create($file_data['file_judgment_date']),'d-m-Y') : $this->input->post('judgement_data'); ?>" class="form-control date1">
							<?php  echo form_error('judgement_data');?>
						</div>
					 
						<div class="form-group">
							<label for="file_subject">Case number (प्रकरण क्रमांक) <span class="text-danger">*</span></label>
							<?php
								//   if($file_data['case_no']!=''){  }
								$c1 = explode(',',$file_data['case_no']);
								$i=0;
								foreach ($c1 as $case_no_type) {
								$case1 = explode('/',$case_no_type);
								?>
								<div class="row">
								<?php if($file_data['file_mark_section_id']!=15){?>
									<div class="col-xs-4">
										<select name="files_other_feilds[case_type][<?php echo $i ?>]" class="form-control">
											<option value="">Select (चुने)</option>
											<?php foreach(case_name() as $case){ ?>
												<option value="<?php echo $case ?>" <?php if(isset($case1) && $case1[0] == $case) { echo "selected" ;} ?>><?php echo $case ?></option>
											<?php } ?>
										</select>
										<?php echo form_error('case_type');?>
									</div>
								<?php } ?>
									<div class="col-xs-4">
										<input type="text"  name="files_other_feilds[case_no][<?php echo $i ?>]" value="<?php echo isset($case1[1]) ? $case1[1] : '' ; ?>" class="form-control">
										<?php echo form_error('case_no');?>
									</div>
									<div class="col-xs-4">
										<select Name='files_other_feilds[case_year][<?php echo $i ?>]' class="form-control" ><?php
											for ($x=date("Y"); $x>2000; $x--) { ?>
												<option value="<?php echo $x ?>" <?php if(isset($case1[2]) && $case1[2] == $x){ echo "selected" ;} ?>><?php echo $x ?></option>';
											<?php } ?>
										</select>
									</div>
								</div>

								<?php $i++; } ?>
						</div>
					</div>
				</div>
			</div> <!-- body -->
			<div class="box-footer text-right">
				<button class="btn btn-primary load_btn"  onclick="return confirm('कृपया सुनिश्चित करे की आप यह फाइल दर्ज करना चाहते हैं |')" type="submit">Submit</button>
			</div>
        </form>
    </div><!-- /.box -->
</div>
</div><!-- /.row -->
<?php } ?>
<!-- Main row -->
</section><!-- /.content -->
