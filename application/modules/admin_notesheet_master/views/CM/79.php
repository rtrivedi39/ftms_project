<?php
$contents  = '' ;
$contents  .= '<tr><td colspan="3"><table width="100%"><tr><td align="left">क्र.';
if($is_genrate == true){
    $contents .= $post_data['head'];
}else{
	$contents .= '<input name="head" placeholder="head" type="text" />';
}
$contents .= '/'.date("y").'/'.$panji_krmank.'/21-क(आप),';
$contents .= '</td><td  align="right">भोपाल, दि. '.date("d-m-Y").'</td></tr></table></td></tr>' ;
$contents  .= '<tr><td valign="top" class="style2"> प्रतिलिपि:- </td></tr><tr><td></td><td  valign="top" style="vertical-align:top" >1.</td><td ><div>' ;
if($is_genrate == true){
$contents .= $post_data['DropDownList1'];
}else
{
	$contents  .= '<select name="DropDownList1" id="DropDownList1">
	<option value="महाधिवक्ता कार्यालय , जबलपुर">महाधिवक्ता कार्यालय , जबलपुर</option><option value="अतिरिक्त महाधिवक्ता कार्यालय , ग्वालियर">अतिरिक्त महाधिवक्ता कार्यालय , ग्वालियर</option>
	<option value="अतिरिक्त महाधिवक्ता कार्यालय , इंदौर">अतिरिक्त महाधिवक्ता कार्यालय , इंदौर</option></select>';
}

$contents  .= '    (म0प्र0) की ओर अग्रेषित संबंधित प्रकरण का अभिलेख, स्थाई अधिवक्ता, नई दिल्ली  की&nbsp; ओर शीघ्र भेजने की व्यवस्था करें  ।  </div></td></tr><tr><td></td><td valign="top" style="vertical-align:top">2.</td><td ><div>' ;
if($is_genrate == true){
$contents .= $post_data['DropDownList2'];
}else
{
   $contents  .= '   <select name="DropDownList2"  id="DropDownList2"><option value="रजिस्ट्रार (न्यायिक) मध्यप्रदेश उच्च न्यायालय, जबलपुर">रजिस्ट्रार (न्यायिक) मध्यप्रदेश उच्च न्यायालय, जबलपुर</option><option value="अतिरिक्त रजिस्ट्रार (न्यायिक) मध्यप्रदेश उच्च न्यायालय, ग्वालियर">अतिरिक्त रजिस्ट्रार (न्यायिक) मध्यप्रदेश उच्च न्यायालय, ग्वालियर</option><option value="अतिरिक्त रजिस्ट्रार (न्यायिक) मध्यप्रदेश उच्च न्यायालय, इंदौर">अतिरिक्त रजिस्ट्रार (न्यायिक) मध्यप्रदेश उच्च न्यायालय, इंदौर</option></select>';
}
$contents  .= ' (म0प्र0) की ओर अग्रिम कार्यवाही एवं सूचनार्थ प्रेषित। </div></td></tr><tr><td></td><td valign="top" style="vertical-align:top" >3. </td><td ><div>' ;
$contents  .= $file_department .' मंत्रालय, भोपाल म0 प्र0 के यू0ओ0  क्रमांक  '.$file_uo_or_letter_no.' दिनांक '.date('d-m-Y',strtotime($file_uo_or_letter_date)) . '  (म0प्र0) को इस निर्देश के साथ प्रेषित कि उपरोक्त प्रकरण में तत्काल प्रभारी अधिकारी की नियुक्ति करें व प्रभारी अधिकारी को निर्देशित करें कि वे स्थायी अधिवक्ता से नई दिल्ली के पते पर सम्पर्क कर विशेष अनुमति याचिका प्रस्तुत करें और प्रकरण से संबंधित निर्णय की प्रमाणित प्रतिलिपि, केस डायरी, साक्ष्य में ग्राह्य दस्तावेजों की प्रतिलिपियां, परीक्षित साक्षियों के कथन एवं अन्य सुसंगत दस्तावेज । प्रकरण में पैरवी करने वाले स्थायी अधिवक्ता को उपलब्ध कराया जाना सुनिश्चित करें और की गई कार्यवाही से इस विभाग को सूचित करें ।   </div></td></tr><tr><td></td><td  valign="top" style="vertical-align:top">4.</td><td ><div>' ;
$contents  .= ' जिला दण्डाधिकारी, '.$district_name_hi.'   (म0प्र0) को इस निर्देश के साथ प्रेषित कि उपरोक्त प्रकरण में तत्काल प्रभारी अधिकारी की नियुक्ति करें व प्रभारी अधिकारी को निर्देशित करें कि वे स्थायी अधिवक्ता से नई दिल्ली के पते पर सम्पर्क कर विशेष अनुमति याचिका प्रस्तुत करें और प्रकरण से संबंधित निर्णय की प्रमाणित प्रतिलिपि, केस डायरी, साक्ष्य में ग्राह्य दस्तावेजों की प्रतिलिपियां, परीक्षित साक्षियों के कथन एवं अन्य सुसंगत दस्तावेज । प्रकरण में पैरवी करने वाले स्थायी अधिवक्ता को उपलब्ध कराया जाना सुनिश्चित करें और की गई कार्यवाही से इस विभाग को सूचित करें । </div></td></tr><tr><td></td><td  valign="top" style="vertical-align:top">5.</td><td><div>';

$contents  .= ' विधि विभाग, उप कार्यालय, एम.पी. भवन, नई दिल्ली-110001 की ओर सूचनार्थ एवं आवश्यक कार्यवाही हेतु अग्रेषित ।</div></td></tr><tr><td></td><td>6.</td><td ><div>' ;
$contents  .= ' पुलिस अधीक्षक, (म0प्र0) की ओर इस निर्देश के साथ प्रेषित कि उपरोक्तानुसार अपील प्रस्तुत कराया  जाना सुनिश्चित करें तथा कि गई कार्यवाही की सूचना इस विभाग को भेजें ।</div></td></tr>' ;
$contents  .= '<tr><td align="right" colspan="3" style="text-align: center"><table align="right" width="600"><tr><td align="center"  contenteditable="false">' ;
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right"><div class="officer-center">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td >&nbsp;</td></tr>';
}
$contents .= '</table></td></tr>';
$contents  .= '<tr><td align="right" colspan="3" style="text-align: center"><table align="right"><tr><td align="center"  contenteditable="false">' ;
$contents  .= '(';
if($is_genrate == true){
$contents .=  get_officer_information($this->input->post('secetroy')); 

}else
{
     $contents .= get_officer_for_sign('secetroy' ,array(4,5) ,'', $s_id );
    
}
$contents  .= ') </td></tr><tr><td align="center"  contenteditable="false">';
if($is_genrate == true){    
    $contents .=   get_officer_dign($this->input->post('secetroy'));
}
else {
     $contents .= '-------';
    }
$contents  .= '</td></tr><tr><td align="center">मध्यप्रदेश शासन विधि और विधायी कार्य विभाग, भोपाल </td></tr><tr><td></table></td></tr>' ;

?>
