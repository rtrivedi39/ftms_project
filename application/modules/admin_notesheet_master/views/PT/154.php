<?php 
$contents  = '' ;
$contents .= '<tr><td align="left"> <div style="margin-top:20px;"><span style="margin-left:10%;">';
if($is_genrate == true){ 
    $contents .=  $post_data['subject'];
} else {
    $contents .= '<textarea name="subject" cols="30" rows="3">'.$file_subject.'</textarea></div>';
}
$contents .= ' </span></div></td></tr>';
$contents .= '<tr><td align="center">--00--</td></tr>';
$contents .= '<tr><td align="center" height="80"></td></tr>';

$contents .= '<tr><td align="left"><span style="margin-left:8%"></span> प्रतिरक्षण आदेश जारी कर  प्रति नस्ती पर रखी है | </td></tr>';   
$contents .= '<tr><td align="right"><div class="officer-center" contenteditable="false">( ';
if($is_genrate =<?php
$contents  = '' ;
$contents .= '<tr><td align="right" colspan="3"><b><u>स्पीड-पोस्ट</u></b></td><tr>';
$contents .= '<tr><td align="center" colspan="3" style="font-weight: bold; text-decoration: underline"><h3>';
$contents .= 'मध्यप्रदेश शासन, विधि एवं विधायी कार्य विभाग, भोपाल <h3></td></tr><tr><td colspan="3"><table width="100%"><tr><td align="left">';
$contents .= 'क्रमांक ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['head'].'</b>';
}else{
	 $contents .= '<input type="text" name="head" >';
}

$contents .= '/'.date("y").'/'.$panji_krmank.'/21-क(या.),';
$contents .= '</td><td align="right"> भोपाल, दिनांक '.date("d-m-Y").'</td></tr></table></td></tr>';
$contents .= '<tr><td valign="top" colspan="2" width="55px">प्रति,</td>';
$contents .= '<td>&nbsp; &nbsp;<br />श्रीमान् प्रमुख सचिव,<br />';
$contents .= $file_department;
$contents .= '<br /><br /></td></tr> <tr><td valign="top" colspan="2">';
$contents .= 'विषय:-</td><td valign="top" >';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['title_loc'].'</b>';
} else {
	$contents .= ' <select name="title_loc" class="title_loc">';
	$contents .= '<option value="अपील">अपील</option>';
	$contents .= '<option value="याचिका">याचिका</option>';
	$contents .= '<option value="रिट याचिका">रिट याचिका</option>';
	$contents .= '<option value="रिट अपील">रिट अपील</option>';
	$contents .= '<option value="विशेष अनुमति यचिका">विशेष अनुमति यचिका</option>';
	$contents .= '<option value="प्रथम अपील">प्रथम अपील</option>';
	$contents .= '<option value="द्वितीय अपील">द्वितीय अपील</option>';
	$contents .= '</select>';
}
$contents .= ' प्रकरण क्रमांक  ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['prakran'].'</b>';
}else{
	 $contents .= '<input type="text" name="prakran" >';
}
$contents .= ' में पारित आदेश दिनांक ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['adeshdinank'].'</b>';
}else{
	$contents .= '<input type="text" class="date1" name="adeshdinank" >';
}
$contents .= '  के विरूद्ध ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['virudhname'].'</b>';
}else{
	 $contents .= '<input type="text" name="virudhname" >';
}
$contents .= '  दिवस विलंब से कार्यवाही प्रस्तावित किए जाने के संबंध में दायित्व निर्धारण/विलंब के कारण के परीक्षण हेतु विधि विभाग में गठित सीमक्षा सेल के समक्ष संपूर्ण विवरण प्रस्तुत किए जाने के संबंध में। ';
$contents .= '<br /></td></tr><tr><td valign="top" colspan="2">';
$contents .= '<td align="left" valign="top" colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$contents .= 'यथा निर्देशित लेख है कि प्रशासकीय विभाग ('.$file_department.') द्वारा ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['title_loc'].'</b>';
} else {
	$contents .= ' --------';
}
$contents .= ' प्रकरण क्रमांक  ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['prakran'].'</b>';
}else{
	 $contents .= '----------';
}
$contents .= ' में पारित आदेश दिनांक ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['adeshdinank'].'</b>';
}else{
	$contents .= '-----------';
}
$contents .= '  के विरूद्ध ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['virudhname'].'</b>';
}else{
	 $contents .= '-----------';
}
$contents .= ' दिवस विलंब से कार्यवाही हेतु प्रस्ताव विधि विभाग को प्रेषित किया गया है।</td></tr>';
$contents .= '<td align="left" valign="top" colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$contents .= 'विशेष अनुमति याचिका क्रमांक ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['kramank'].'</b>';
}else{
	 $contents .= '<input type="text" name="kramank" >';
}
$contents .= ' मध्यप्रदेश राज्य विरूद्ध ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['virudhname'].'</b>';
}else{
	 $contents .= '-----------';
}
$contents .= ' के प्रकरण में मान्नीय सर्वोच्च न्यायालय द्वारा विलंब से याचिका दायर करने के संबंध में कठोर रूख अपनाते हुए शासन पर ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['rupyra'].'</b>';
}else{
	 $contents .= '<input type="text" name="rupyra" >';
}
$contents .= '  रूपए का हर्जाना अधिरौपित करते हुए विलंब के लिए उत्तरदायी अधिकारियों से हर्जाने की राशि वसूल करने हेतु आदेशित किया गया है।</td></tr>';
$contents .= '<td align="left" valign="top" colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$contents .= 'विलंब से याचिका दायर करने के संबंध में मान्नीय सर्वोच्च न्यायालय द्वारा दिए गए दिशा-निर्देश के परिप्रेक्ष्य में वर्तमान प्रकरण में याचिका दायर करने में हुए विलंब के संबंध में दायित्व के निर्धारिण एवं विलंब के कारण के परीक्षण हेतु पृथक से नस्ती की प्रति विधि विभाग में गठित समीक्षा सेल को प्रेषित की गई है।</td></tr>';
$contents .= '<td align="left" valign="top" colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$contents .= 'अतः यह अनुरोध है कि वर्तमान प्रकरण में याचिका दायर करने में हुए विलंब के संबंध में अपने अभिमत सहित दायित्व के निर्धारण एवं विलंब के कारण को दर्शित करते हुए सुसंगत दस्तावेज एवं विवरण विधि विभाग में गठित समीक्षा सेल को एक सप्ताह के भीतर उपलब्ध कराया जाना सुनिश्चित करें।</td></tr>';

$contents .= '<tr><td align="right" height="40"></td></tr>';
$contents .= '<tr><td colspan="3" align="right"><div  contenteditable="false"  class="officer-center">( ';
if($is_genrate == true){
	$contents .=  get_officer_information($this->input->post('avar_secetroy')); 
}else{
    $contents .= get_officer_for_sign('avar_secetroy' ,$uber_sect ,'', $us_id);
}
$contents .= ' )</div></td></tr>';
$contents .= '<tr><td colspan="3" align="right"><div  contenteditable="false"  class="officer-center ">';

if($is_genrate == true){    
    $contents .=   get_officer_dign($this->input->post('avar_secetroy'));
}else{
    $contents .= '-------';
}
	
$contents .= '</div></td></tr>';
$contents .= '<tr><td align="right"  colspan="3"  align="right"><div class="law_dept" style="">मध्यप्रदेश शासन विधि और विधायी कार्य विभाग, भोपाल</div></td></tr>';	

?>
= true){
$contents .=  get_officer_information($this->input->post('add_secetroy')); 

}else
{
	 $contents .= get_officer_for_sign('add_secetroy' ,$add_secetroy ,'', $as_id);
	
}

$contents .= ' )</div></td></tr>';
$contents .= '<tr><td align="right"><div class="officer-center" contenteditable="false"> ';
if($is_genrate == true){	
    $contents .=  get_officer_for_sign_dign("design",$add_secetroy,$this->input->post('add_secetroy'));
}
else {
	 $contents .= '-------';
	}
?>