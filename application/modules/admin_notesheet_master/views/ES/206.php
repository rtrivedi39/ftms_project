<?php
$contents  = '' ;
$contents .= '<tr><td align="right" colspan="3"><u>स्पीड-पोस्ट द्वारा</u></td></tr>';
$contents .= '<tr><td align="center" colspan="3"><h3><u>मध्यप्रदेश शासन, विधि एवं विधायी कार्य विभाग, भोपाल</u></h3></b></td></tr>';
$contents .= '<tr><td colspan="3"><table width="100%"><tr><td>क्रमांक '.$panji_krmank.'/21-क (स्था0), </td><td  align="right"> भोपाल, दिनांक '.date("d-m-Y").' </td></tr></table></td></tr>';
$contents .= '<tr><td align="left" valign="top" > प्रति,</td><td colspan="2"></td></tr>';
$contents .= '<tr><td></td><td colspan="2">';
if($is_genrate == true){
$contents .= get_employee_designation_id($this->input->post('emp_name'), '',  false);
}
else{
$contents .= get_all_employee_ddllist('emp_name' ,'');
}
$contents .= '</td></tr>';
$contents .= '<tr><td></td><td colspan="2">';
if($is_genrate == true){
$contents .=   get_employee_designation_id($this->input->post('emp_name')); 
}
else{
$contents .= '----' ;
} 
$contents .= '</td></tr>';
$contents .= '<tr><td></td><td colspan="2"> विधि विभाग, भोपाल । </td></tr>';

$contents .= '<tr><td>विषय:- </td><td colspan="2" > '.$file_subject.' </td></tr>';
$contents .= '<tr><td  valign="top" class="top_class"> संदर्भ:- </td><td colspan="2">आपका आवेदन  दिनांक';
if($is_genrate == true){
	$contents .= $post_data['date_1'];
}else
{
$contents  .= "<input type='text' name='date_1' class='date1'> ";	
}
$contents .= 'एवं' ;
if($is_genrate == true){
	$contents .= $post_data['date_2'];
}else
{
$contents  .= "<input type='text' name='date_2' class='date1'> ";	
}
$contents .= 'के संबंध में  । </td></tr>';
$contents .= '<tr><td align="center" colspan="3" valign="top">';
$contents .= '---0---';
$contents .= '</td></tr>';
$contents .= '<tr><td></td><td colspan="2"><p>उपरोक्त विषयक एवं संदर्भ में निर्देशानुसार आपको सूचित किया जाता है कि ';
if($is_genrate == true){
	$contents .= $post_data['colleage_name'];
}else
{
$contents  .= "<input type='text' name='colleage_name' > ";	
}
$contents .= ' द्वारा अधिसूचना क्रमांक ';
if($is_genrate == true){
	$contents .= $post_data['notification_no'];
}else
{
$contents  .= "<input type='text' name='notification_no' > ";	
}
$contents .= 'दिनांक ';
if($is_genrate == true){
	$contents .= $post_data['notification_date'];
}else
{
$contents  .= "<input type='text' name='notification_date' class='date1' > ";	
}
$contents .= ' द्वारा जारी अधिसूचना कि अनुसार आपको प्रदत्त डाॅक्टर आॅफ फिलास्फी ;च्ण्भ्ण्क्ण्द्ध की उपाधि दिनांक ';
if($is_genrate == true){
	$contents .= $post_data['notification_date'];
}else
{
$contents  .= "<input type='text' name='notification_date' class='date1' > ";	
}

$contents .= '  प्राप्त होने पर इस शर्त के साथ आपको नाम के आगे डाॅक्टर लिखने की अनुमति प्रदान की जाती है कि, भविष्य में उपाधि के आधार पर किसी भी प्रकार की वेतनवृद्धि की पात्रता नहीं होगीे एवं न ही आप इस आधार पर किसी तरह के लाभ के लिये दावा करेंगे । ';
$contents .= '</p></td></tr>';

if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right" colspan="3"><div class="officer-center">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td colspan="3">&nbsp;</td></tr>';
}
$contents .= '<tr><td colspan="2" align="right"><div contenteditable="false" class="officer-center">( ';
if($is_genrate == true){
$contents .=  get_officer_information($this->input->post('avar_secetroy')); 

}else
{
     $contents .= get_officer_for_sign('avar_secetroy' ,$uber_sect ,'', $us_id);
    
}

$contents .= ' )</div></td></tr>';
$contents .= '<tr><td colspan="2" align="right"><div contenteditable="false" class="officer-center ">';

if($is_genrate == true){    
    $contents .=   get_officer_dign($this->input->post('avar_secetroy'));
}
else {
     $contents .= '-------';
    }
	
$contents .= '</div></td></tr>';
$contents .= '<tr><td colspan="2" align="right"><div  class="law_dept" >मध्यप्रदेश शासन विधि और विधायी कार्य विभाग, भोपाल</div></td></tr>';
$contents .= '<tr><td colspan="3"><table width="100%"><tr><td>पृ0क्रमांक '.$panji_krmank.'/21-क (स्था0), </td><td  align="right"> भोपाल, दिनांक '.date("d-m-Y").' </td></tr></table></td></tr>';
$contents .= '<tr><td align="left" valign="top" >प्रतिलिपि,</td><td colspan="2"></td></tr>';
$contents .= '<tr><td align="left" valign="top" ></td><td colspan="2">1	महालेखाकार (लेखा एवं हकदारी), अरेरा हिल्स भोपाल/ग्वालियर </td></tr>';
$contents .= '<tr><td align="left" valign="top" ></td><td colspan="2">2	कोषालय अधिकारी विन्ध्याचल भवन भोपाल। </td></tr>';
$contents .= '<tr><td align="left" valign="top" ></td><td colspan="2">3	संबंधित सेवा-पुस्तिका एवं पदक्रम सूची में पृविष्टि हेतु/रजिस्टर  लिपिक/व्यक्तिगत नस्त/पे-बिल लिपिक की ओर सूचनार्थ एवं आवश्यक कार्यवाही हेतु अग्रेषित । </td></tr>';

if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right" colspan="3"><div class="officer-center">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td colspan="3">&nbsp;</td></tr>';
}
$contents .= '<tr><td colspan="2" align="right"><div contenteditable="false" class="officer-center">( ';
if($is_genrate == true){
$contents .=  get_officer_information($this->input->post('avar_secetroy')); 

}else
{
     $contents .= get_officer_for_sign('avar_secetroy' ,$uber_sect ,'', $us_id);
    
}

$contents .= ' )</div></td></tr>';
$contents .= '<tr><td colspan="2" align="right"><div contenteditable="false" class="officer-center ">';

if($is_genrate == true){    
    $contents .=   get_officer_dign($this->input->post('avar_secetroy'));
}
else {
     $contents .= '-------';
    }
	
$contents .= '</div></td></tr>';
$contents .= '<tr><td colspan="2" align="right"><div  class="law_dept" >मध्यप्रदेश शासन विधि और विधायी कार्य विभाग, भोपाल</div></td></tr>';
?>
