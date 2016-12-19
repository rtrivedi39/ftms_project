<?php
$contents  = '' ;
$contents .= '<tr><td colspan="2" align="right"><u><b>स्पीड पोस्ट</b></u></td></tr>';
$contents .= '<tr><td colspan="2"><div align="center"><b><h4><u>मध्यप्रदेश शासन, विधि एवं विधायी कार्य विभाग, भोपाल</u></h4></b></div></td></tr><tr><td colspan="2"><table width="100%"><tr><td align="left">क्रं. ';
if($is_genrate == true){
    $contents .= $post_data['head'];
}else{
	$contents .= '<input name="head" placeholder="head" type="text" />';
}

$contents .= '/'.date("y").'/'.$panji_krmank.'/21-क(आप),';
$contents .= '</td><td  align="right">भोपाल , दिनांक '.date("d-m-Y").'</td></tr></table></td></tr>';

$contents .= '<tr><td valign="top" width="100px">प्रति,</td><td></td></tr>';
$contents .= '<tr><td valign="top"></td><td>';
if($is_genrate == true){
    $contents .= $post_data['to_1'];
}else{
	$contents .= '<input name="to_1"  type="text" />';
}
$contents .= '</td></tr>';
$contents .= '<tr><td valign="top"></td><td>';
if($is_genrate == true){
    $contents .= $post_data['to_2'];
}else{
	$contents .= '<input name="to_2"  type="text" />';
}
$contents .= '</td></tr>';
$contents .= '<tr><td valign="top"></td><td> जिला  -';

if($is_genrate == true){
	$contents .= $post_data['distic_2'];
}else
{
$contents  .= get_distic_dd('distic_2');	
}
$contents .= '</td></tr>';


$contents .= '<tr><td>विषय:-</td><td>'.$file_subject.'</td></tr>';
$contents .= '<tr><td colspan="2" align="center">------0000-------</td></tr>';
$contents .= '<tr><td colspan="2"><br/>';
$contents .= '<p class="shift-left">उपरोक्त विषयांकित प्रकरण के संबंध में लेख है कि इस विभाग द्वारा सीधे आवेदक द्वारा प्राप्त आवेदन पत्र पर कोई कार्यवाही नहीं की जाती है। प्रकरण जिला दण्डाधिकारी एवं शासकीय अधिवक्ता द्वारा प्राप्त होने पर ही इस विभाग द्वारा आवश्यक कार्यवाही की जाती है। </p></tr>';
$contents .= '<tr><td colspan="2"><br /><p class="shift-left">अतः प्रकरण उचित माध्यम से इस विभाग में प्रेषित होने के उपरान्त ही उक्त प्रकरण में आवश्यक कार्यवाही की जायेगी। </p><br /></td></tr>';
$contents .= '<tr><td align="left"><u>संलग्न दस्तावेज:-</u></td><td>उक्त आवेदन।  </td></tr>';
$contents .= '<tr><td colspan="2">&nbsp;</td></tr>';
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right" colspan="3"><div class="officer-center">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td colspan="2">&nbsp;</td></tr>';
}
$contents .= '<tr><td colspan="2" align="right"><div contenteditable="false" class="officer-center">( ';
if($is_genrate == true){	 
	$contents .= get_officer_information($this->input->post('sing_user')); 
}else{
	$contents .= get_officer_for_sign('sing_user' ,array(2,3,4,5,7,11) ,'', $us_id);
}
$contents .= ' )</div></td></tr>';
$contents .= '<tr><td colspan="2" align="right"><div contenteditable="false" class="officer-center">';

if($is_genrate == true){    
    $contents .=   get_officer_dign($this->input->post('sing_user'));
}
else {
     $contents .= '-------';
    }
$contents .= '</div></td></tr>';
$contents .= '<tr><td colspan="2" align="right"><div  class="law_dept" style="">मध्यप्रदेश शासन विधि और विधायी कार्य विभाग, भोपाल</div></td></tr>';
?>
