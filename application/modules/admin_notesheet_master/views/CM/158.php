<?php
$contents  = '' ;
$contents .= '<tr><td align="right" colspan="3"><b><u>स्पीड पोस्ट</u></b>';
$contents .= '<tr><td align="center" colspan="3"><b><u>मध्यप्रदेश शासन, विधि एवं विधायी कार्य विभाग, भोपाल</u></b>';
$contents .= '</td></tr><tr><td colspan="3"><table width="100%"><tr><td>क्र 6/';
if($is_genrate == true){
    $contents .= $post_data['head'];
}else{
	$contents .= '<input name="head" placeholder="head" type="text" />';
}

$contents .= '/'.date("y").'/'.$panji_krmank.'/21-क (आप),';
$contents .= '</td><td align="right">भोपाल, दिनांक ';
if($is_genrate == true){
 if($post_data['date1']!= '' ){ 
	 $contents .= $post_data['date1'];
	 }else { 
	 $contents .= '&nbsp;&nbsp;&nbsp;&nbsp;' ;
	 }
}else
{
	$contents .=  '<input type="text" class="date1" name="date1" placeholder="dd/mm/yyyy" />';
}
$contents .= '</td></tr></table></td></tr>';
$contents .= '<tr><td valign="top" width="55px" class="top_class"> प्रति, </td><td colspan="2"></td></tr>';
$contents .= '<tr><td></td><td colspan="2">जिला दण्डाधिकारी,</td></tr>'; 
$contents .= '<tr><td></td><td colspan="2">जिला ';
if($is_genrate == true){
	$contents .= $post_data['distic_3'];
}else
{
$contents  .= get_distic_dd('distic_3');	
}
$contents .= ', म0प्र0 </td></tr>';
$contents .= '<tr><td valign="top" class="top_class"> ';
$contents .= 'विषय:-</td><td colspan="2" valign="top">';
$contents .= 'सत्र प्र.क्र '.$case_parties.' में पारित निर्णय दि '.$file_judgment_date1 .' के विरूद्ध अपील प्रस्ताव भेजे जाने में हुए विलंब के कारण व आधार के संबंध में । </td></tr>';
$contents .= '<tr><td  valign="top" class="top_class"> संदर्भ:- </td><td colspan="2">आपका अपील प्रस्ताव संबंधी पत्र क्रमांक ';
$contents .= ' '.$file_uo_or_letter_no;
$contents  .=' दिनांक ';
if($is_genrate == true){
	$contents .= $post_data['date_2'];
}else
{
$contents  .= "<input type='text' name='date_2' class='date1'> ";	
}

$contents .= ' </td></tr><tr><td align="center" colspan="3">';
$contents .= '---000---';
$contents .= '</td></tr><tr><td></td><td colspan="2">';
$contents .= '<p class="text-justify shift-left">निर्देशानुसार उपरोक्त विषय एवं संदर्भ में लेख किया जाता है कि विषयांकित सत्र प्रकरण में दिनांक ';
if($is_genrate == true){
	$contents .= $post_data['date_4'];
}else
{
$contents  .= "<input type='text' name='date_4' class='date1' value='".$file_judgment_date1."'> ";	
}
$contents .= ' को निर्णय पारित किया गया है, जबकि उक्त निर्णय के विरूद्ध अपील प्रस्ताव अत्यधिक विलंब से आपके उक्त

संदर्भित पत्र के द्वारा दिनांक  ';
if($is_genrate == true){
	$contents .= $post_data['late_date'];
}else
{
$contents  .= "<input type='text' name='late_date' class='date1' value='".$file_judgment_date1."'> ";	
}
$contents .= ' को इस विभाग की ओर भेजा गया है ।  '; 

$contents .= ' </p></td></tr><tr>';
$contents .= '<tr><td></td><td colspan="2"><p class="text-justify shift-left">अतः इस संबंध में विलंब का उचित कारण व आधार स्पष्ट करते हुए एवं विलंब की बाबत् उत्तरदायित्व का

निर्धारण करते हुए, यथाशीघ्र जानकारी इस विभाग की ओर भेजे जाने का कष्ट करें कि अपील प्रस्ताव भेजे जाने में

इतना अधिक विलंब क्यों हुआ है । </p></td></tr><tr>';
$contents .= '<td align="right" colspan="3"><b> मध्यप्रदेश के राज्यपाल के नाम से तथा आदेशानुसार,</b>&nbsp;&nbsp;</td></tr><tr>';
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right" colspan="3"><div class="officer-center">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td colspan="3">&nbsp;</td></tr>';
}
$contents .= '<tr><td colspan="3" align="right"><div  contenteditable="false" class="officer-center">( ';
if($is_genrate == true){
$contents .=  get_officer_information($this->input->post('avar_secetroy')); 

}else
{
     $contents .= get_officer_for_sign('avar_secetroy' ,$uber_sect ,'', $us_id);
    
}

$contents .= ' )</div></td></tr>';
$contents .= '<tr><td colspan="3"  align="right"><div  contenteditable="false" class="officer-center ">';

if($is_genrate == true){    
    $contents .=   get_officer_dign($this->input->post('avar_secetroy'));
}
else {
     $contents .= '-------';
    }
	
$contents .= '</div></td></tr>';
$contents .= '<tr><td colspan="3" align="right"><div style=""  class="law_dept"  >मध्यप्रदेश शासन विधि और विधायी कार्य विभाग, भोपाल</div></td></tr>';
$contents .= '<td>&nbsp;</td><td>&nbsp;</td></tr>';
?>
