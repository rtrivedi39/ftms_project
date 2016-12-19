<?php
$contents  = '' ;
$contents .= '<tr><td colspan="2"><div class=""><span class="shift-left">कारण बताओं सूचना पत्र । </span></div></td></tr>';
$contents .= '<tr><td colspan="2"><table width="100%"><tr><td align="left">पंजी क्रमांक '.$panji_krmank.'/21-क(आप.), </td><td align="right"> दिनांक '.$file_mark_section_date.'</td></tr></table></td></tr>';
$contents .= '<tr><td align="center" colspan="2" > ----------------------------------------------------------</td></tr>';
$contents .= '<tr><td align="left" colspan="2"><p class="shift-left text-justify">  उपरोक्त विषयक ध्वज-‘‘अ‘‘ द्वारा ';
if($is_genrate == true){
	$contents .= get_employee_name($this->input->post('emp_name') , '');// get_officer_information();
}
else{
$contents .= get_all_employee_ddllist('emp_name' ,'');
}
$contents .= ', ';
if($is_genrate == true){
$contents .=   get_employee_designation_id($this->input->post('emp_name')); 
}
else{
$contents .= '----' ;
} 
$contents .= ' को दिनांक ' ;
if($is_genrate == true){
    $contents .= $post_data['start_date'];
}else{
	$contents .= '<input name="start_date" class="date1"  type="text"  />';
}
$contents .= ' से दिनांक ' ;
 if($is_genrate == true){
    $contents .= $post_data['end_date'];
}else{
	$contents .= '<input name="end_date" class="date1"  type="text"  />';
}
$contents .= ' तक बिना अवकाश स्वीकृत कराये अपने कर्तव्य पर अनुपस्थित रहने एवं दिनांक ';
 if($is_genrate == true){
    $contents .= $post_data['bord_date'];
}else{
	$contents .= '<input name="bord_date" class="date1"  type="text"  />';
}
$contents .= ' को मेडिकल बोर्ड के समक्ष उपस्थित होने के निर्देश की अवहेलना के कारण, कारण बताओं सूचना पत्र जारी कर तीन दिवस के अंदर कारण दर्शित करने का लेख किया गया था।  </td></tr>'; 
 $contents .= '<tr><td colspan="2"><p class="text-justify shift-left" >जिसके पालन में  ';
if($is_genrate == true){
	$contents .= get_employee_name($this->input->post('emp_name') , '');// get_officer_information();
}
else{
$contents .= get_all_employee_ddllist('emp_name' ,'');
}

 $contents .= ' द्वारा अवगत कराया गया है कि उनके द्वारा ';
  if($is_genrate == true){
    $contents .= $post_data['his_date'];
}else{
	$contents .= '<input name="his_date" class="date1"  type="text"  />';
}
 $contents .= ' को अस्वस्थता की सूचना अनफिट प्रमाण पत्र सहित लिखित में भिजवा दी थी, तदोपरांत दिनांक ';
   if($is_genrate == true){
    $contents .= $post_data['after_date'];
}else{
	$contents .= '<input name="after_date" class="date1"  type="text"  />';
}
$contents .= ' को पुनः लिखित में अनफिट प्रमाण पत्र सहित सूचना भिजवा दी थी ।   </p><br/></td></tr>';
$contents .= '<tr><td colspan="2"><p class="text-justify shift-left" >दिनांक ';
   if($is_genrate == true){
    $contents .= $post_data['not_present_date'];
}else{
	$contents .= '<input name="not_present_date" class="date1"  type="text"  />';
}
$contents .= ' को वह पत्नि की अत्यंत अस्वस्थता(ब्रेन हेमरेज व लकवा) के कारण मेडिकल बोर्ड के समक्ष उपस्थित नहीं हो सके ।   </p><br/></td></tr>';
 $contents .= '<tr><td colspan="2"><p class="text-justify shift-left" >';
if($is_genrate == true){
	$contents .= get_employee_name($this->input->post('emp_name') , '');// get_officer_information();
}
else{
$contents .= get_all_employee_ddllist('emp_name' ,'');
}

$contents .= ' ने अपने आवेदन में लेख किया है कि उनका उद्देश्य कार्यालय के आदेश की अवहेलना करने का नहीं था, परिस्थितिवश वह मेडिकल बोर्ड के समक्ष उपस्थित नहीं हो पाये। मैंने अपना कार्य पूरी ईमानदारी एवं निष्ठा के साथ किया है एवं कभी ऐसा कृत्य नहीं किया है जिससे वरिष्ठ अधिकारियों को प्रतीत हो कि उनके आदेशों की अवहेलना की जा रही है ।   </p><br/></td></tr>';
$contents .= '<tr><td colspan="2"><p class="text-justify shift-left" >अतः महोदयजी से निवेदन हेै कि मेरी परिस्थितियों को दृष्टिगत रखते हुये मेरा लघुकृत अवकाश स्वीकृत करने का कष्ट करें ।  </p><br/></td></tr>';
$contents .= '<tr><td colspan="2"><p class="text-justify shift-left" >अतः ';
if($is_genrate == true){
	$contents .= get_employee_name($this->input->post('emp_name') , '');// get_officer_information();
}
else{
$contents .= get_all_employee_ddllist('emp_name' ,'');
}
$contents .= ' का स्पष्टीकरण अवलोकन उपरांत आदेशार्थ प्रस्तुत । </p><br/></td></tr>';


if($this->uri->segment(6) == 'p' || $this->uri->segment(7) == 'p'  ){
$contents .= '<tr><td colspan="2"><div><u>अनुभाग अधिकारी (स्था) </u> </div><br/><br/><br/></td></tr>';
$contents .= '<tr><td colspan="2"><div><u>अवर सचिव </u> </div><br/><br/><br/></td></tr>';
$contents .= '<tr><td colspan="2"><div><u>व0ले0अ0 </u> </div><br/><br/><br/></td></tr>';
}
$contents .= '<tr><td colspan="2"><br /><br/><br/><div  style="text-align:justify" ></div><br/></td></tr>';

?>
<style>
.shift-left{ margin-left:10%;}
.shift-top{ margin-top:20px; }
.shift-left{ text-indent:50px }
</style>



