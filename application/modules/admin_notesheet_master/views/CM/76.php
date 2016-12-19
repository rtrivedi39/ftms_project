<?php
$contents  = '' ;
$contents .= '<tr><td colspan="2" align="right"><u>स्पीड पोस्ट द्वारा</u></td></tr>';
$contents  .= '<tr><td align="center" colspan="2" ><h3><u>'.@$dept_name.', भोपाल</u></h3></td></tr>';
$contents  .= '<tr><td align="center"  colspan="2" ><h3><u>::आदेश ::</u></h3></td></tr>';
$contents  .= '<tr><td colspan="2"><span class="shift-left" >'.@$file_subject .'</span></td></tr>';
$contents  .= '<tr><td colspan="2" align="right">भोपाल दिनांक ';
if($is_genrate == true){
$contents .= $post_data['date1'];
}else
{
	$contents .=  '<input type="text" class="date1" name="date1" value="'.date('d-m-Y').'" placeholder="dd/mm/yyyy" />';
}
$contents  .= '</td></tr>';
$contents  .= '<tr><td>पंजी क्र0 '.$file_number.'/'.date("Y").'/21-क (आप0), राज्य शासन ' ;
if($is_genrate == true){
	$contents .= $post_data['name_1'];
	}
else{
	$contents .=  '<input type="text" name="name_1" />';
}
$contents .=  'वरिष्ठ अधिवक्ता, उच्चतम  न्यायालय, नई दिल्ली को इस विभाग के आदेश दिनांक ';
if($is_genrate == true){
$contents .= $post_data['date2'];
}else
{
	$contents .=  '<input type="text" class="date1" name="date2" value="'.date('d-m-Y').'" placeholder="dd/mm/yyyy" />';
}
$contents  .= 'में  वर्णित सेवा शर्तो के अधीन, माननीय उच्चतम न्यायालय के समक्ष राज्य की ओर से उनके द्वारा निम्नलिखित दिनांको में ';
if($is_genrate == true){
$contents .= $post_data['date3'];
}else
{
	$contents .=  '<textarea name="date3" cols="145" rows="5"  /></textarea>';
}
$contents .=  ' में की गई पैरवी के फलस्वरूप, प्रस्तुत देयकों की कुल राशि रू. ';
if($is_genrate == true){
$contents .= $post_data['preice_1'];
}else
{
	$contents .=  '<input type="text"  name="preice_1"   />';
}
$contents .=  ' /- (';
if($is_genrate == true){
$contents .= $post_data['preice_2'];
}else
{
	$contents .=  '<input type="text"  name="preice_2"   />';
}
$contents .=  ' ) के भुगतान करने की एतद द्वारा, स्वीकृति प्रदान करता है | </td></tr>';
$contents  .= '<tr><td><p>विधि परामर्शी मध्यप्रदेश शासन कृपया ';
if($is_genrate == true){
$contents .= $post_data['advocate_name'];
}else
{
	$contents .=  '<input type="text"  name="advocate_name"   />';
}
$contents  .= ', कनिष्ठ अधिवक्ता, उच्चतम न्यायालय, नई दिल्ली को उपरोक्त धनराशि का भुगतान ई-पैमेन्ट के माध्यम से करें | </p></td></tr>';
$contents  .= '<tr><td>&nbsp;</td></tr>';
$contents  .= '<tr><td><p>उपरोक्त व्यय मांग संख्या - 29-2014 न्याय प्रशासन-114- कानूनी सलाहकार एवं परामर्शदाता 6251-31- व्यवसायिक सेवाओं हेतु अदायगियां - 010  अन्य में विकलनीय होगा |</p></td></tr>';
$contents  .= '<tr><td>संलग्न :- देयक </td></tr>';
$contents  .= '<tr><td>&nbsp;</td></tr>';
$contents  .= '<tr><td align="right"><b>मध्यप्रदेश के राज्यपाल के नाम से तथा आदेशानुसार,</b> </td></tr>';
$contents .= '<tr><td colspan="2">&nbsp;</td></tr>';
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right" colspan="3"><div class="officer-center">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td colspan="3">&nbsp;</td></tr>';
}
$contents .= '<tr><td colspan="2" align="right"><div contenteditable="false"  class="officer-center">( ';
if($is_genrate == true){
$contents .=  get_officer_information($this->input->post('secetroy')); 

}else
{
     $contents .= get_officer_for_sign('secetroy' ,$secetry ,'', $s_id );
    
}

$contents .= ' )</div></td></tr>';
$contents .= '<tr><td colspan="2" align="right"><div contenteditable="false"  class="officer-center">';

if($is_genrate == true){    
    $contents .=   get_officer_dign($this->input->post('secetroy'));
}
else {
     $contents .= '-------';
    }
$contents .= '</div></td></tr>';
$contents .= '<tr><td colspan="2"  align="right"><div  class="officer-center">मध्यप्रदेश शासन विधि और विधायी कार्य विभाग, भोपाल</div></td></tr>';

?>                