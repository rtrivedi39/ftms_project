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
$contents .= '<tr><td></td><td colspan="2"><p> आपको यह जानकारी होते हुये भी कि स्थायी अग्रिम में राशि उपलब्ध नहीं है । फिर भी आपके द्वारा दिनांक ';
if($is_genrate == true){
	$contents .= $post_data['by_date'];
}else
{
$contents  .= "<input type='text' name='by_date' class='date1'> ";	
}
$contents .= ' को कम्प्यूटर उपकरण मरम्मत देयक लगभग रूपये ';
if($is_genrate == true){
	$contents .= $post_data['approx_amount'];
}else
{
$contents  .= "<input type='text' name='approx_amount' > ";	
}
$contents .= ' /- टेªजरी में लगाया गया और टेªजरी से आपत्ती लगकर देयक वापस विभाग में आने के उपरान्त आपके द्वारा आपत्ती का निराकरण कर दिनांक ';
if($is_genrate == true){
	$contents .= $post_data['judgement_date'];
}else
{
$contents  .= "<input type='text' name='judgement_date' class='date1'> ";	
}
$contents .= ' को उक्त देयक पुनः टेªजरी में लगाया गया । जबकि प्रमुख सचिव विधि के वाहन चालक श्री भोलादत्त द्वारा स्थापना में दिनांक ';
if($is_genrate == true){
	$contents .= $post_data['given_date'];
}else
{
$contents  .= "<input type='text' name='given_date' class='date1'> ";	
}
$contents .= ' को ';
if($is_genrate == true){
	$contents .= $post_data['approx_amount'];
}else
{
$contents  .= "<input type='text' name='approx_amount' > ";	
}
$contents .= '/- के देयक प्रस्तुत किये परन्तु आपके द्वारा बताया गया की स्थायी अग्रिम में बजट नहीं है। जबकि उक्त दिनांक को स्थाई अग्रिम में पर्याप्त राशि उपलब्ध थी। किन्तु आपने स्थायी अग्रिम में राशि उपलब्ध न होने पर भी कम्प्यूटर उपकरण की मरम्मत देयक की राशि रुपये ';
if($is_genrate == true){
	$contents .= $post_data['approx_amount'];
}else
{
$contents  .= "<input type='text' name='approx_amount' > ";	
}
$contents .= '/- का भुगतान बिना किसी पूर्व अनुमति से किया गया। जिसके कारण स्थाई अग्रिम से अन्य भुगतान करने में  अत्याधिक असुविधा हुई । इस प्रकार आपने जानबूझकर अधिकारियों को गुमराह किया जो शासकीय सेवक के  लिये अशोभनीय है ।  ';


$contents .= '</p></td></tr>';
$contents .= '<tr><td></td><td colspan="2"><p>  अतः उपरोक्त संबंध में अपना स्पष्टीकरण आज ही प्रस्तुत करे। </p></td></tr>';
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
