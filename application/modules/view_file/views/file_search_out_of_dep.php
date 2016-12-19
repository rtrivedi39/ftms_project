<!-- Content Header (Page header) -->
<?php   $section= empdetails(emp_session_id());
$emp_session_id =  emp_session_id();
$user_sections = getusersection($emp_session_id);
$sections_allot = explode(',',$user_sections);
$section_count = count($sections_allot); 
$section_id = $section[0]['emp_section_id'];
$file_from = file_from_type();
$high_bench =  highcourt_bench();
$userrole = checkUserrole();
$Employee_lists_estab =  get_establishment_employees('so')  ;
foreach($Employee_lists_estab as $esta_emp){
    $establiment_empids[] = $esta_emp['emp_id'];
}

?>
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

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><?php echo $title_tab ; ?></h3>
                    <button class="btn btn-warning pull-right" title="Back" onclick="goBack()">पिछले पेज में वापस जायें</button>
                </div>
                <div class="box-body">
                    <div class="row">
                        <form method="post" action="" Content-Type="application/x-www-form-urlencoded">
                            <div class="col-xs-12">                                
                                <div class="col-xs-6">
                                    <div class="input-group"> <div class="input-group-btn"> <button type="button" class="btn btn-primary">चयन</button> </div>
                                        <select class="form-control" name="mark_out_dept" id="mark_out_dept" required>
											<?php /*<option value="">चयन करे </option>
											<option value="मान0  विधि मंत्री जी" <?php echo @$this->input->post('search_type') == "मान0  विधि मंत्री जी" ? "selected" : false?>>मान0  विधि मंत्री जी</option>
											<option value="मुख्य सचिव" <?php echo @$this->input->post('search_type') == "मुख्य सचिव" ? "selected" : false?>>मुख्य सचिव</option>
											<option disabled class="text-center"> --------------विभाग का चयन करें---------------</option>
											<?php
											$departments_list = get_list(DEPARTMENTS, 'department_default_no', null,'ASC');
											foreach($departments_list as $row){ ?>
												<option ><?php echo @$row['department_default_no'] == 1000 ? '' :  $row['dept_name_hi']; ?></option>
											<?php } ?>
											<option disabled  class="text-center">---------------महाधिवक्ता चुने----------------</option>
											<option value="महाधिवक्ता, मान0  उच्च न्यायालय, जबलपुर, मध्यप्रदेश">महाधिवक्ता, मान0  उच्च न्यायालय, जबलपुर, मध्यप्रदेश </option>
											<option value="अतिरिक्त महाधिवक्ता, मान0  उच्च न्यायालय खण्डपीठ, इंदौर, मध्यप्रदेश">अतिरिक्त महाधिवक्ता, मान0  उच्च न्यायालय खण्डपीठ, इंदौर, मध्यप्रदेश </option>
											<option value="अतिरिक्त महाधिवक्ता, मान0  उच्च न्यायालय खण्डपीठ, ग्वालियर, मध्यप्रदेश">अतिरिक्त महाधिवक्ता, मान0  उच्च न्यायालय खण्डपीठ, ग्वालियर, मध्यप्रदेश </option>
											<option value="अन्य">अन्य</option>
											<option value="रजिस्ट्रार जनरल, उच्च न्यायालय, जबलपुर">रजिस्ट्रार जनरल, उच्च न्यायालय, जबलपुर'</option>
											*/ foreach(netesheet_mark_to_other_dept()  as $key => $value) {
												if($key != '') { ?>
												<option value="<?php echo $value; ?>" <?php echo @$this->input->post('search_type') == $key ? "selected" : false?>><?php echo $value; ?></option>
											<?php } } 
											?>
										</select>
									</div><br/>
								<input type="text" name="outer_other_name" id="outer_other_name" value="" placeholder="अन्य नाम दर्जे करें" class="form-control">
                                </div>
								
								<div class="col-xs-3">
									<select name="sections" id="search_section_wise" class="form-control">
									<option value="">सेक्शन का चयन करें</option>
									<?php $emp_sections = getSectionData($sections_allot);
										foreach($emp_sections  as $empsec){ 
											$section_details = $empsec->section_name_hi.'('.$empsec->section_name_en.')';
											$selected = null; 
											if((@$this->input->post('sections') == $empsec->section_id) || ($section_count == 1 && $empsec->section_id == $section_id) ){
												 $selected = "selected";
											}
										?>
										<option value="<?php echo $empsec->section_id ?>" <?php echo $selected; ?>><?php echo $section_details ; ?></option>
									<?php  }?>
									</select>
								</div>
								
                                <div class="col-xs-3">
                                    <button type="submit" id="mark_out_dept_btn" class="btn btn-primary">खोजें</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

			<?php if(isset($files_data)){ ?>
            <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Total Number of Files: <b><?php if(empty($files_data[0])){ echo '0';}else{ echo count($files_data); }?></b></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered" class="dataTable">
                            <tbody>
                            <tr>
                                <th style="width: 10px">क्रमांक</th>
                                <th>विषय</th>
                                <th>पंजी क्र. शाखा</th>
                                <th>अनुभाग</th>
                                <th>विभाग में प्राप्ति दिनांक</th>
                                <th>जहां नस्ती भेजी है </th>
                                <th>स्थिति</th>
                                <th>प्रेषक का नाम</th>
                            </tr>
                            <?php
                            foreach ($files_data as $key => $files) {
                                $rrt = all_getfilesec_id_byfileid($files['file_id']);
                                ?>
                                <tr>
                                    <td>1.</td>
                                    <td><?php echo $files['file_subject'];?>
                                        <br><?php if(isset($files['scan_id']) && $files['scan_id'] != ''){ show_scan_file($files['scan_id']);}?><br><?php if(isset($files['file_status']) && $files['file_status'] != ''){show_file_status($files['file_status']);}?>
                                    </td>
                                    <td>
                                        <a href="<?php echo base_url()."view_file/viewdetails/".$files['file_id'] ;?>" data-toggle="tooltip" data-original-title="View details">
                                            <?php
                                            $section_id_check = '';
                                            foreach($rrt as $rrt1){ // $rrt1['section_id'] != $files->file_mark_section_id
                                                if($rrt1['section_id'] != '1'){
                                                    $sechi = explode('(',getSection($rrt1['section_id']));
                                                    echo "<b>".$rrt1['section_number'] ."</b> - <span style='font-size: 12px'>".$sechi['0']."</span><br/>";
                                                    $section_id_check[] =  $rrt1['section_id'];
                                                }}
                                            if(@!in_array($files['file_mark_section_id'],$section_id_check)){
                                                echo "N/A";
                                            }
                                            ?>
                                        </a>
                                    </td>
                                    <td><?php echo $files['section_name_hi'];?></td>
                                    <td>
                                        <?php echo date_format(date_create($files['file_update_date']), 'd/m/y'); ?>
                                        (<?php if($files['file_hardcopy_status'] == 'not'){ echo $this->lang->line('mark_date');} else { echo $this->lang->line('received_date');} ?>)
                                    </td>
                                    <td><?php echo $files['draft_markto_otherdept'];?></td>
                                    <td>
                                        <?php
                                        $filereceiver = get_user_details($files['file_received_emp_id']);
                                        if ($filereceiver)
                                        {
                                            if($files['file_hardcopy_status'] == 'not') {
                                                echo file_not_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi,$filereceiver[0]->emp_detail_gender);
                                            } else if($files['file_hardcopy_status'] == 'close') {
                                                echo file_closed_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi, $files['file_type'] ,$filereceiver[0]->emp_detail_gender);
                                            } else{
                                                echo file_receive_message($filereceiver[0]->emp_full_name_hi,$filereceiver[0]->emprole_name_hi,$filereceiver[0]->emp_detail_gender);
                                            }
                                        } ?>
                                    </td>
									<td>
										<?php echo $files['creater']; ?>
									</td>
                                </tr>
                            <?php } ?>
							</tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div>
            </div>
            </div>

			<?php } ?>
		</div>
    </div>
</section><!-- /.content -->
<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#outer_other_name').hide();
	$('#mark_out_dept').change(function(){
		$('#outer_other_name').val('');
		$typeval  = $(this) .val();
		if($typeval == 'अन्य'){
			$('#outer_other_name').show();
		}else{
			$('#outer_other_name').hide();
		}
	});
});
</script>