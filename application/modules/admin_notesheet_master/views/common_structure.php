<?php
//pre($file_details);
$emp_allot_seet = empdetails_alloted_work();
$uber_sect = 7 ;
$secetry = 4 ;
$add_secetroy = 5 ;
$toal_seet_work = array(1,2,3,4,'sc');
//file details
$today = date('d-m-Y');
$file_id = $file_details[0]['file_id'];
//$file_number = $file_details[0]['file_number'];
$file_uo_or_letter_no = $file_details[0]['file_uo_or_letter_no'];
$file_uo_or_letter_date = $file_details[0]['file_uo_or_letter_date'];
$file_uo_or_letter_date1 = date("d-m-Y", strtotime($file_uo_or_letter_date));
$file_subject = $file_details[0]['file_subject'];
$file_type = $file_details[0]['file_type'];
$case_no = $file_details[0]['case_no'];
$case_no1 = explode("/",$case_no);
$file_judgment_date = $file_details[0]['file_judgment_date'];
$file_judgment_date1 = $file_judgment_date != '0000-00-00' ? date("d-m-Y", strtotime($file_judgment_date)) : false;
$file_mark_section_date = $file_details[0]['file_mark_section_date'] != '0000-00-00' ? date("d-m-Y", strtotime($file_details[0]['file_mark_section_date'])) : false;
$days_delay =  day_difference_dates($file_judgment_date, date('Y-m-d'));
$file_department = ($file_details[0]['dept_name_hi'] != '') ? $file_details[0]['dept_name_hi'] : '';
$district_name_hi = ($file_details[0]['district_name_hi'] != '') ? $file_details[0]['district_name_hi'] : '';
$agenst =  array_pop(explode('-', $file_details[0]['case_parties']));
$agenst_name =  array_pop(explode('-', $file_details[0]['case_parties'],-2));
$file_mark_section_id = $file_details[0]['file_mark_section_id'];
$file_type = $file_details[0]['file_type'];

$file_number = getfilesec_id_byfileid($file_id, $file_mark_section_id, $file_type);
//notesheet details
$notesheet_id = $notesheet_details[0]->notesheet_id;
$section_id = $notesheet_details[0]->section_id;


if($section_id == 0){
	if(isset($_GET['aa']) && $_GET['aa'] == "aa" ){
			echo "Monika";
			}
	$section_name = 'Common';
} else{
	$section_name = getSection($section_id, true);
}
$notesheet_title = $notesheet_details[0]->notesheet_title;
$doc_type = $notesheet_details[0]->doc_type;
//$section_name = getSection($section_id, true);
$case_parties = $file_details[0]['case_parties'];
$case_parties1 = explode("-",$case_parties);

$panji_krmank = getfilesec_id_byfileid($file_id,$file_mark_section_id,$file_type);
//get  secretary law
$details_sl = get_section_employee($section_id, 4);
foreach ($details_sl as $row) {
    $sl_name = $row->emp_full_name_hi;
    $sl_name_en = $row->emp_full_name;
	$s_id = $row->emp_id;
}
//get aditional secretary
$details_as = get_section_employee($section_id, 5);
foreach ($details_as as $row) {
    $as_name = $row->emp_full_name_hi;
    $as_name_en = $row->emp_full_name;
	$as_id = $row->emp_id;
}
//get section oficer
$details_so = get_section_employee($section_id, 8);
foreach ($details_so as $row) {
    $so_name = $row->emp_full_name_hi;
	$so_id = $row->emp_id;
}
//get under secretary oficer
$details_us = get_section_employee($section_id, 7);
foreach ($details_us as $row) {
    $us_name = $row->emp_full_name_hi;
	$us_id = $row->emp_id;
}
//get account officer oficer
$details_ao = get_section_employee(13, 11);
foreach ($details_ao as $row) {
    $ao_name = $row->emp_full_name_hi;
	$ao_id = $row->emp_id;
}


$dept_name = 'मध्यप्रदेश शासन, विधि और विधायी कार्य विभाग';

//criminal work variable
$vakalatnam = 'IN THE MATTER OF VAKALATNAMA';
$case_nm = case_name();



//criminal work variable end
//standing counsil menber name and address
$standing_counsil_memebers = get_advocates_name(array('advocate_type' => 'sc'));

$standing_counsil_memebers_hc = get_advocates_name(array('advocate_type' => 'hc'));

// madystam adhivakta
$madhyastam_adhivkta = get_advocates_name(array('advocate_post_type' => 8 ));

$state_list  = get_state_list();
$advocate_type = array(
    //'',
	'अतिरिक्त महाधिवक्ता',
    'महाधिवक्ता',
	'रजिस्ट्रार',
    'डिप्टी रजिस्ट्रार',
	'मान0  उच्चतम  न्यायालय',
	'मान0  अपीलीय प्राधिकारी',
	'शासकीय  महाधिवक्ता',
	'कार्यालय  कलेक्टर',
	'सचिव ',
	''
);
$court_type = array(
   
	'मान0  उच्च न्यायालय',
    'मान0 उच्च न्यायालय खण्डपीठ',
	'मान0  उच्चतम  न्यायालय',
	'उपादान ',
  '',
);
$court_location = array(
   
	'जबलपुर, मध्यप्रदेश',
	'इंदौर, मध्यप्रदेश',
	'ग्वालियर, मध्यप्रदेश',
	'नई दिल्ली ',
	 '',
);
$court_location2 = array(
    'जबलपुर',
    'खंडपीठ इंदौर',
    'खंडपीठ ग्वालियर',
);
$sufix_list =  array(
    //'',
    'st',
    'nd',
    'rd',
    'th',
);
$title_list_hi =  array(
    //'',
    'श्री',
    'श्रीमति',
    'सुश्री',
    'श्रीमान',
);

$title_list =  array(
    //'',
    'Shri',
    'Miss',
    'Mrs.',
    'Mr.',
);
$sambhag = array(
    'चम्बल',
    'ग्वालियर',
    'उज्जैन',
    'इंदौर',
    'नर्मदापुरम',
    'जबलपुर',
    'रीवा',
    'शहडोल',
    'भोपाल',
    'सागर',
);
$dsig = array(
    'अतिरिक्त सचिव',
    'अवर सचिव',
    'सचिव',
);
$writ_lists =  array(
    'रिट याचिका',
    'रिट अपील',
    'रिव्यु याचिका',
    'अवमानना याचिका',
    'प्रतिरक्षण',
    'विविध याचिका',
    'विशेष अनुमति याचिका',
);
$case_hindi = array(
    'विशेष सत्र',
    'आपराधिक',
    'सत्र',
    'दांडिक',
);

$dosh_mukti = array(
    'दोषमुक्ति',
    'सजावृद्धि',
);

$months = months(false , true );

$establi_so_details = get_estableshment_so();

$est_so_name = $establi_so_details['emp_full_name_hi'];
$est_so_designation  = get_employee_designation_id($establi_so_details['emp_id']);
$employee_list = get_all_employee();
if($this->input->post('emp_name')){
	$emp_details = get_user_details($this->input->post('emp_name'));
	$pay = get_employee_grade_pay($emp_details[0]->emp_unique_id );
	$grade_pay = $pay['pay_grp'];
	$basic_pay = $pay['pay_basic'];
	$basic_10_per = (($basic_pay + $grade_pay )*10) / 100 ;
}

//for gpf-->
if(!empty($file_details[0]['file_est_relation_id'])){
	
 	$application_data =  dispaly_application_on_file($file_details[0]['file_est_relation_id']);
	$pay_id = $application_data['pay_id'];
	$pay_emp_name = $application_data['pay_emp_name'];
	$pay_emp_unique_id = $application_data['pay_emp_unique_id'];
	$pay_emp_designation = $application_data['pay_emp_designation'];
	$pay_account_no = isset($application_data['pay_account_no'])?$application_data['pay_account_no']:'';
	$applied_amount_adv = $application_data['applied_amount_adv'];
	$applied_amount_adv_words = $application_data['applied_amount_adv_words'];
	$pay_percentage = $application_data['pay_percentage'];
	$pay_adv_amount = $application_data['pay_adv_amount'];
    $pay_amount = $application_data['pay_amount'];
    $pay_pre_amount = $application_data['pay_pre_amount'];

    $remaning_amount =  $pay_pre_amount - $pay_adv_amount ;

	if($application_data['pay_sub_cateid']== 97){
		$est_category = 'अस्थाई अग्रिम'; // 97  tempary
	}
	else if($application_data['pay_sub_cateid']== 131){
		$est_category = 'आंशिक अंतिम प्रत्याहरण';	//131 part final 
	}

	 
}else
{
	$pay_id = $dpf_gpf_details->pay_id;
	$pay_emp_name = $dpf_gpf_details->pay_emp_name;
	$pay_emp_designation = $dpf_gpf_details->pay_emp_designation;
	$pay_account_no = $dpf_gpf_details->pay_account_no;
	$applied_amount_adv = $dpf_gpf_details->applied_amount_adv;
	$pay_amount = $dpf_gpf_details->pay_amount;
	$pay_pre_amount = $dpf_gpf_details->pay_pre_amount;
	
}
//for gpf end-->


/*$istype = $style = '';
if($is_genrate == true && isset($post_data['isnotesheet']) && $post_data['isnotesheet'] == 'yes'){
	$width = 'width:80%; margin:0 auto;';
	$istype = '?type=n';
	$style = 'background-color:#CCFFCC;';
} else if($is_genrate == true){
	$width = 'width:100%; margin:0 auto;';
} else {
	$width = 'width:100%; margin:0 auto;';
}

$structure_prefix = '<html><body><table  style="margin:0% auto;" cellspacing="1" cellpadding="0">';
$structure_postfix = '</table></body></html>';

if ($is_genrate == false) {
    $controller = 'generate_notesheet';
} else {
   $controller = 'save_notesheet';
   //$controller = 'complete_draft';
}
$url = base_url().'admin_notesheet_master/notesheet_generate/'.$controller.'/'.$notesheet_id.'/'.$section_id.'/'.$file_id.$istype;
*/
$type = '';


if ($is_genrate == false) {
    $controller = 'generate_notesheet';
    $type = "?type=".$doc_type;
} else {
    $controller = 'save_notesheet';
    $type = "?type=".$doc_type;
}
$doc_type = $this->input->get('type') != '' ? $this->input->get('type') : $doc_type ;

if($this->uri->segment(6)){
	$file_status = '/'.$this->uri->segment(6);
}else{
	$file_status = '' ;
}
$url = base_url().'admin_notesheet_master/notesheet_generate/'.$controller.'/'.$notesheet_id.'/'.$file_mark_section_id.'/'.$file_id.$file_status.$type;
//$url = base_url().'admin_notesheet_master/notesheet_generate/'.$controller.'/'.$notesheet_id.'/'.$section_id.'/'.$file_id.$type;



//if($is_genrate == true && isset($post_data['isnotesheet']) && $post_data['isnotesheet'] == 'yes'){
if($doc_type == 'n'){
    $style = 'width:100%; background-color:#CCFFCC; margin:0 auto;';
    $width = 'width:68%; margin:0 auto;';
    //$type_style = 'background-color:#CCFFCC;';
} else if($doc_type != 'n'){
    $style = 'width:100%; background-color:#eee; margin:0 auto;';
    $width = 'width:100%; margin:0 auto;';
    //$type_style = 'background-color:#eee;';
}

$structure_prefix = '<html><body><table style="margin:0% auto;" cellspacing="1" cellpadding="0">';
$structure_postfix = '</table></body></html>';
?>
<link href="<?php echo base_url(); ?>themes/e_file_style.css" rel="stylesheet" type="text/css" />
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
    <div class="row">
        <div class="col-xs-12">
            <!-- Various colors -->
            <div class="box box-primary">
                <div class="box-header no-print">
                    <h3 class="box-title">प्रोफार्मा</h3>
					<div class="box-tools pull-right">
						<!--<button type="button" onclick="return window.close();" >बंद करे</button>-->
						<button class="btn btn-warning" onclick="goBack()" data-toggle="tooltip" data-original-title="Back"><?php echo $this->lang->line('Back_button_label'); ?></button>
					</div>
				</div>
                <form method="post" name="notesheetForm" action="<?php echo $url; ?>" >
					
					<input type="hidden" name="pay_id" id="pay_id"  value="<?php echo isset($pay_id)?$pay_id:$this->input->post('pay_id') ?>" />
					<input type="hidden" name="accepted_amount" id="accepted_amount" value="<?php echo $this->input->post('accepted_amount') ?>" />
					<input type="hidden" name="rules" id="rules"  value="<?php echo $this->input->post('rules') ?>" />
					
					<input type="hidden" value="<?php echo  $file_sts; ?>" name="file_sts" id="file_sts" >
					<?PHP if($this->input->post('add_secetroy')){?>
                   <input type="hidden" name="officer_id" id="officer_id" value="<?php echo $this->input->post('add_secetroy') ?>" >
                    <?php } ?>
                     <?PHP if($this->input->post('avar_secetroy')){?>
                   <input type="hidden" name="officer_id" id="officer_id" value="<?php echo $this->input->post('avar_secetroy') ?>" >
                    <?php } ?>
					 <?PHP if($this->input->post('secetroy')){?>
                   <input type="hidden" name="officer_id" id="officer_id" value="<?php echo $this->input->post('secetroy') ?>" >
                    <?php } ?>
					<?PHP if($this->input->post('sing_user')){?>
                   <input type="hidden" name="officer_id" id="officer_id" value="<?php echo $this->input->post('sing_user') ?>" >
                    <?php } ?>
                   <input type="hidden" name="member_id" id="member_id" value="<?php echo $this->input->post('member_id') ?>" >
					<input type="hidden" value="" name="content_text" id="content_text"/>
						<div class="box-body" id="forPrint" style="<?php echo $style; ?>">



                        <div <?php echo $is_genrate == true ? 'contenteditable="true"' : '' ; ?>	style="<?php echo $width; ?>" class="show_content" >


                            <?php require($section_name . '/' . $notesheet_id . '.php');
								$final_contents = $structure_prefix.$contents.$structure_postfix;

								if($is_genrate == true){
									echo $final_contents;
								} else {
									echo $final_contents;
								}
                            ?>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer" >
                        <?php if($is_genrate == true){  ?>
                            <div class="sticky sticky_class no-print">
							    <button type="button" onclick="save_notesheet();" id="btnsave_content" class="btn btn-primary margin" value="" name="savepdf">Save and Continue</button> <!--data-loading-text="Saving..."-->
                                <button type="button" onclick="goBack()" class="no-print btn btn-warning margin">Back or Edit</button>
                                <button type="button" onclick="printContents('forPrint')" class="no-print btn bg-maroon margin">Print Content</button>
                            </div>
                        <?php  } else { ?>
                            <div class="sticky sticky_class no-print">
								<div class="row">
									<div class="col-md-2">
										<button type="submit" onclick="return genrate_content();"  class="btn btn-success " value="Generate" name="generate">Generate</button>
									</div>
                                    <?php if(in_array($file_mark_section_id, array(11,12))){ ?>								
									<div class="col-md-2">
										<select class="form-control" name="font_size">
											<option value="">--फ़ॉन्ट आकार चुने--</option>
											<?php for($i=10; $i<=24; $i++){ ?>
												<option value="<?php echo $i; ?>"><?php echo $i; ?> PT</option>
											<?php } ?>
										</select>
									</div>
									<div class="col-md-2">
										<select class="form-control" name="line_height">
											<option value="">--रेख की ऊंचाई चुने--</option>
											<?php for($i=10; $i<=50; $i++){ ?>
												<option value="<?php echo $i; ?>"><?php echo $i; ?> PT</option>
											<?php } ?>
										</select>
									</div>
									<div class="col-md-2">
										<select class="form-control" name="word_spacing">
											<option value="">--शब्द रिक्ति चुने--</option>
											<?php for($i=6; $i<=25; $i++){ ?>
												<option value="<?php echo $i; ?>"><?php echo $i; ?> PT</option>
											<?php } ?>
										</select>
									</div>
									<?php } ?>
								</div>
                            </div>
                        <?php  } ?>
                    </div>
                </form>
            </div>	<!-- /.box -->
        </div>
    </div><!-- /.row -->
    <!-- Main row -->
</section><!-- /.content -->
<?php $this->load->view('footer_js.php'); ?>
<script src="<?php echo base_url(); ?>themes/e_file_style.js" type="text/javascript"></script>
<script>
	
	function genrate_content(){	
		var res = confirm('कृपया सुनिश्चित कर ले यह जोड़ रहे है');
		if(res==false){
			return false;
		}	
		/*var content_text = $('#compose_textarea').val();*/
		var content_text = CKEDITOR.instances['compose_textarea'].getData();		
		/*content_text = content_text.trim(); */
		content_text = encrypt('encode',content_text);
		$("#content_text").val(content_text);
	}
	
function save_notesheet(){

 
	var conf = confirm('कपया सुनिश्चित करें कि आप इसे सुरक्षित करना चाहते है | ') ;
	
	if(conf == false ){
		return false;
	}
	$('#btnsave_content').button('loading');
	var content1 = $('.show_content').html().trim();
	content1 = encrypt('encode',content1);

	var d_type = "<?php echo $this->input->get('type') ?>"; 
	var file_id = "<?php echo $this->uri->segment(6) ?>"; 
	var section_id ="<?php echo $this->uri->segment(5) ?>"; 
	var notesheet_id = "<?php echo $this->uri->segment(4) ?>";  
	var file_sts = $("#file_sts").val();  
	var head_id = $("#head").val();  
	var officer_id = $("#officer_id").val(); 
	
	
	var pay_id = $("#pay_id").val(); 
	var accepted_amount = $("#accepted_amount").val(); 
	var rules = $("#rules").val(); 
	
	var yes_ajax = 'yes_ajax';
	var HTTP_PATH='<?php echo base_url(); ?>';
           $.ajax({
                url: HTTP_PATH + "admin_notesheet_master/notesheet_generate/save_notesheet/",
                type: 'POST',
				
				
                data: {
                file_sts:file_sts, content1: content1,file_id:file_id,section_id:section_id,
				/* notesheet_id:notesheet_id,head_id:head_id,d_type:d_type,officer_id:officer_id,req_type:yes_ajax */
				notesheet_id:notesheet_id,head_id:head_id,d_type:d_type,officer_id:officer_id,req_type:yes_ajax,pay_id:pay_id,accepted_amount:accepted_amount,rules:rules

                },       
                success: function(data) {
					alert(data);

					if(file_sts == 'p'){

						window.location="<?php echo base_url(); ?>attached/file_doc/1";
					}else{
					
						window.location="<?php echo base_url(); ?>efile/"+file_id;


					}
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					alert("some error"+textStatus);
					}
			});
}
</script>
<style>
.shift-top-note{ margin-top:20px !important; }
.shift-left-note{     margin-left: 10% !important; }
</style>
