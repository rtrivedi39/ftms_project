<?php
$contents  = '' ;
$contents .= '<tr><td align="center" colspan="3"><h3><u>मध्यप्रदेश शासन, विधि एवं विधायी कार्य विभाग, भोपाल</u></h3></b></td></tr>';
$contents .= '<tr><td align="center" colspan="3">(विधि परामर्शी कार्यालय मध्यप्रदेश भोपाल)</td></tr>';
$contents .= '<tr><td colspan="3"><table width="100%"><tr><td>क्रमांक '.$panji_krmank.'/21-क (स्था0), </td><td  align="right"> भोपाल, दिनांक '.date("d-m-Y").' </td></tr></table></td></tr>';
$contents .= '<tr><td colspan="3"><table width="100%">';
$contents .= '<tr><td width="10%" align="right" >1.</td><td  width="40%">अभिदाता का नाम</td><td align="left" width="50%">';
if($is_genrate == true){
	$contents .= $post_data['applicaint_name'];
}else
{
$contents .='<input type="text" name="applicaint_name" id="applicaint_name" readonly  value="'.$pay_emp_name.'" placeholder="अभिदाता का नाम"/> ';
}
$contents .='</td></tr>';
$contents .= '<tr><td align="right">2.</td><td>पद नाम</td><td  align="left">';
if($is_genrate == true){
	$contents .= $post_data['applicaint_name'];
}else
{
$contents .='<input type="text" name="applicaint_designation" id="applicaint_designation"  readonly  value="'.$pay_emp_designation.'"	 value="" placeholder="पद नाम"/> ';
}
$contents .='</td></tr>';
$contents .= '<tr><td align="right">3.</td><td>एम्पलाई कोड़</td><td align="left">';
if($is_genrate == true){
	$contents .= $post_data['employee_code'];
}else
{
$contents .='<input type="text" name="employee_code" id="employee_code" readonly value="'.$pay_emp_unique_id.'"  placeholder="पद नाम"/> ';
}
$contents .='</td></tr>';
$contents .= '<tr><td align="right">4.</td><td>स्वीकृत राशि</td><td align="left">';
if($is_genrate == true){
	$contents .= $post_data['accepted_amount'];
}else
{
$contents .='<input type="text" name="accepted_amount" id="accepted_amount"  value="" placeholder="स्वीकृत राशि"/> ';
}
$contents .='</td></tr>';
$contents .= '<tr><td align="right">5.</td><td>शब्दों में राशि</td><td align="left">';
if($is_genrate == true){
	$contents .= $post_data['accepted_amount_in_words'];
}else
{
$contents .='<input type="text" name="accepted_amount_in_words" id="accepted_amount_in_words"  value="" placeholder="शब्दों में राशि"/> ';
}
$contents .=' </td></tr>';
$contents .= '<tr><td align="right">6.</td><td>सा.भ.नि/विभागीय भविष्य निधि खाता क्रमांक </td><td align="left">';
if($is_genrate == true){
	$contents .= $post_data['account_no'];
}else
{
$contents .='<input type="text" name="account_no" id="account_no"  value="'.$pay_account_no.'" placeholder="भविष्य निधि खाता क्रमांक"/> ';
}
$contents .=' </td></tr>';
$contents .= '<tr><td align="right">7.</td><td>आहरण /स्वीकृति का प्रकार (अस्थाई अग्रिम या आंशिक अंतिम प्रत्याहरण) </td><td align="left">';
if($is_genrate == true){
	$contents .= $post_data['temp_part_final'];
}else
{
$contents .='<input type="text" name="temp_part_final" id="temp_part_final"  value="'.$est_category.'" /> ';
}
$contents .=' </td></tr>';
$contents .= '<tr><td align="right">8.</td><td>नियम जिसके अधीन स्वीकृति प्रदान की गई है:-</td><td align="left"> ';
if($is_genrate == true){
	$contents .= $post_data['rules'];
}else
{
$contents .='<input type="text" name="rules" id="rules" value="" /> ';
}
$contents .='</td></tr>';
$contents .= '<tr><td align="right">9.</td><td>लेखाशीर्ष जिसमें राशि विकलित की जाएगी:-</td><td align="left">';

$contents .='लेखाशीर्ष-क-अल्प बचतें भविष्य निधिया आदि मुख्यशीर्ष 8009 राज्य भविष्य निधियां-01-सिविल (101) सामान्य भविष्य  संख्या-29-न्याय प्रशासन मुख्य शीर्ष 2052, सचिवालय सामान्य सेवा, (090) सचिवालय, योजना (9057)विधि और विधायी कार्य
</td></tr>';



$contents .= '</table></td></tr>';

$contents .= '<tr><td></td><td colspan="2"><p>प्रमाणित किया जाता है कि स्वीकृति हेतु आवश्यक समस्त शर्तो की पूर्ति कर ली गई है।</p></td></tr>';
$contents .= '<tr><td></td><td colspan="2"><p>(प्रमुख सचिव विधि द्वारा अनुमोदित)</p></td></tr>';

if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right" colspan="3"><div class="officer-center">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td colspan="3">&nbsp;</td></tr>';
}
$contents .= '<tr><td colspan="3" align="right"><div contenteditable="false" class="officer-center">( ';
if($is_genrate == true){	 
	$contents .= get_officer_information($this->input->post('sing_user')); 
}else{
	$contents .= get_officer_for_sign('sing_user' ,array(2,3,4,5,7,11) ,'', 26);
}
$contents .= ' )</div></td></tr>';
$contents .= '<tr><td colspan="3" align="right"><div contenteditable="false" class="officer-center ">';

if($is_genrate == true){    
    $contents .=   get_officer_dign($this->input->post('sing_user'));
}
else {
     $contents .= '-------';
    }
	
$contents .= '</div></td></tr>';
$contents .= '<tr><td colspan="2" align="right"><div  class="law_dept" >मध्यप्रदेश शासन विधि और विधायी कार्य विभाग, भोपाल</div></td></tr>';
$contents .= '<tr><td colspan="2"><br></td></tr>';
$contents .= '<tr><td colspan="2" align="center">//2//</td></tr>';
$contents .= '<tr><td align="right">प्रतिलिपि:-</td><td></td></tr>';
$contents .= '<tr><td colspan="3"><table width="100%"><tr><td>पृ. क्रमांक '.$panji_krmank.'/21-क (स्था0), </td><td  align="right"> भोपाल, दिनांक '.date("d-m-Y").' </td></tr></table></td></tr>';
$contents .= '<tr><td align="right">1.</td><td>वरिष्ठ कोषालय अधिकारी,विन्ध्याचल भवन कोषालय भोपाल की ओर मूल देयक के साथ दो प्रतियों में आवश्यक कार्यवाही हेतु। </td></tr>';
$contents .= '<tr><td align="right">2.</td><td>संबंधित अभिदाता ';
if($is_genrate == true){
	$contents .= $post_data['applicaint_name'];
}else
{
$contents .='<input type="text" name="applicaint_name" readonly  value="'.$pay_emp_name.'" placeholder="अभिदाता का नाम"/> ';
}
$contents .=', ';
if($is_genrate == true){
	$contents .= $post_data['applicaint_name'];
}else
{
$contents .='<input type="text" name="applicaint_designation" readonly  value="'.$pay_emp_designation.'"	 value="" placeholder="पद नाम"/> ';
}
$contents .=' विधि विभाग की ओर सूचनार्थ। वास्तविक उपयोग के उपरान्त अतिरिक्त शेष राशि तत्काल कोषालय/बैंक में ब्याज सहित चालान से स्वंय के भविष्य निधि खाता क्रमांक में जमा की जावेगी तथा चालान की प्रति आहरण एवं संवितरण अधिकारी को तत्काल उपलब्ध करायी जावेगी। </td></tr>';
$contents .= '<tr><td align="right">3.</td><td>आहरण एवं संवितरण अधिकारी/सेवापुस्तिका/पासबुक संधारण हेतु अनुभाग अधिकारी स्थापना शाखा की ओर आवश्यक कार्यवाही हेतु।   </td></tr>';

if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right" colspan="3"><div class="officer-center">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td colspan="3">&nbsp;</td></tr>';
}
$contents .= '<tr><td colspan="2" align="right"><div contenteditable="false" class="officer-center">( ';
if($is_genrate == true){	 
	$contents .= get_officer_information($this->input->post('sing_user')); 
}else{
	$contents .= '-------';
}
$contents .= ' )</div></td></tr>';
$contents .= '<tr><td colspan="3" align="right"><div contenteditable="false" class="officer-center ">';

if($is_genrate == true){    
    $contents .=   get_officer_dign($this->input->post('sing_user'));
}
else {
     $contents .= '-------';
    }
	
$contents .= '</div></td></tr>';
$contents .='<tr><td></td></tr>';
?>
