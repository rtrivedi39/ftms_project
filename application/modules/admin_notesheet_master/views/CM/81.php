<?php
$contents  = '' ;
$contents .= '<tr><td colspan="2" align="right"><u>स्पीड पोस्ट द्वारा</u></td></tr>';
$contents .= '<tr>';
$contents .= '<td colspan="2"><div align="center"><b><h4><u>मध्यप्रदेश शासन, विधि एवं विधायी कार्य विभाग, भोपाल</u></h4></b></div></td></tr><tr><td colspan="2"><table width="100%"><tr><td width="left"> क्रमांक  ';
if($is_genrate == true){
    $contents .= $post_data['head'];
}else{
	$contents .= '<input name="head" placeholder="head" type="text" />';
}

$contents .= '/21-क(आप), ';
$contents .= '</td><td align="right">भोपाल , दिनांक '.date("d-m-Y").'</td></tr></table></td></tr>';

$contents .= '<tr><td>प्रति,</td><td></td></tr>';
$contents .= '<tr><td></td><td>महाधिवक्ता </td></tr>';
$contents .= '<tr><td></td><td>महाधिवक्ता कार्यालय, जबलपुर (म0प्र0) </td></tr>';

$contents .= '<tr><td>विषय:- <td>'.$file_subject.'</td></tr>';
$contents .= '<tr><td>संदर्भ:-</td><td>महाधिवक्ता कार्यालय, जबलपुर का अर्ध शासकीय पत्र क्र0 '.$file_uo_or_letter_no.' दिनांक '.$file_uo_or_letter_date1.' के संबंध में | </td></tr>';
$contents .= '<tr><td align="center" colspan="2"> --------0--------- </td></tr>';
$contents .= '<tr><td colspan="2" ><p class="shift-left">उपरोक्त विषयक एवं संदर्भित प्रकरण के संबंध में लेख है कि '.$file_subject.' विधि विभाग में आना नही पाया जाता है |</p></td></tr>';
$contents .= '</td></tr>';
$contents .= '<tr><td align="right" height="80"></td></tr>';
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
$contents .= '<tr><td colspan="2" align="right"><div class="law_dept" >मध्यप्रदेश शासन विधि और विधायी कार्य विभाग, भोपाल</div></td></tr>';
$contents .= '<td>&nbsp;</td><td>&nbsp;</td></tr>';
?>
