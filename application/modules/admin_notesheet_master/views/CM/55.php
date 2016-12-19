<?php
$contents  = '' ;
$contents .= '<tr><td align="right" colspan="3"><b><u>स्पीड-पोस्ट</u></b></td><tr>';
$contents .= '<tr><td align="center" colspan="3" style="font-weight: bold; text-decoration: underline"><h3>';
$contents .= 'मध्यप्रदेश शासन, विधि एवं विधायी कार्य विभाग, भोपाल <h3></td></tr><tr><td colspan="3"><table width="100%"><tr><td align="left">';
$contents .= 'क्रमांक ';
if($is_genrate == true){
$contents .= $post_data['head'];
}else
{
	 $contents .= '<input type="text" name="head" >';
	
}

$contents .= '/'.date("y").'/'.$panji_krmank.'/21-क(आप),';
$contents .= '</td><td align="right"> भोपाल, दिनांक '.date("d-m-Y").'</td></tr></table></td></tr>';
$contents .= '<tr><td valign="top" colspan="2" width="55px">प्रति,</td>';
$contents .= '<td>जिला दण्डाधिकारी,<br />';
$contents .= $district_name_hi.' (म.प्र.),';
$contents .= '<br /></td></tr> <tr><td valign="top" colspan="2">';
$contents .= 'विषय:- </td><td valign="top" >';
$contents .= 'माननीय न्यायिक ';
if($is_genrate == true){
    $contents .= $post_data['dt4'];
}else{
	 $contents .= get_Court('dt4');
}
$case_no1 = explode('/',$case_no);
$contents .= ' , जिला  '.$district_name_hi.'  (म.प्र.)  के  '.$case_no1[0].' प्रकरण क्रमांक '.$case_no1[1].'/'.$case_no1[2].' ';
$contents .= 'म.प्र. शासन विरूद्ध '.$case_parties1[0].' ';
$contents .= 'में पारित आदेश दिनांक  '.$file_judgment_date1.' के संबंध में ।';
$contents .= '</td></tr><tr><td valign="top" colspan="2">';
$contents .= 'संदर्भ:-</td><td valign="top">';
$contents .= 'कार्यालय कलेक्टर एवं जिला दण्डाधिकारी, '.$district_name_hi.' ( म.प्र.) के ';
$contents .= $file_type == 'l' ? 'पत्र क्रमांक': false;
$contents .= $file_type == 'f' ? 'यू.ओ. क्रमांक': false;
$contents .= ' ' .$file_uo_or_letter_no.' , दिनांक ';
$contents .=  $file_uo_or_letter_date1.' <br /></td>';
$contents .= '</tr><tr> <td align="center" colspan="3" valign="top">';
$contents .= '---000---<br />';
$contents .= '</td></tr><tr>';
$contents .= '<td align="left" valign="top" colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$contents .= 'उपर्युक्त विषयांकित एवं संदर्भित पत्र का अवलोकन करें । <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;आपकी ओर से प्रेषित दोषमुक्ति अपील प्रस्ताव पर विचार किये जाने पश्चात् राज्य शासन  द्वारा आगे कार्यवाही नहीं किये जाने का निर्णय लिया गया है ।';
$contents .= '</td></tr><td align="left" colspan="3" valign="top">';
$contents .= 'संलग्न दस्तावेज :<br /><span>1-निर्णय की सत्य प्रतिलिपि,</span><br/><span>2-लोक अभियोजक का अपील आधार व मत,</span><br/><span>';
$contents .= '3-साक्षियों के कथन,</span></td></tr>';
$contents .= '<tr><td class="style2" colspan="3" valign="top" align="center"><div class="test_for_post">';
$contents .= '<div align="right"><b>मध्यप्रदेश के राज्यपाल के नाम से तथा आदेशानुसार </b></div></td></tr>';

if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right" colspan="3"><div class="officer-center">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td colspan="3">&nbsp;</td></tr>';
}
$contents .= '<tr><td colspan="3" align="right"><div  contenteditable="false"  class="officer-center">( ';
if($is_genrate == true){
$contents .=  get_officer_information($this->input->post('avar_secetroy')); 

}else
{
     $contents .= get_officer_for_sign('avar_secetroy' ,$uber_sect ,'', $us_id);
    
}


$contents .= ' )</div></td></tr>';
$contents .= '<tr><td colspan="3" align="right"><div  contenteditable="false"  class="officer-center ">';

if($is_genrate == true){    
    $contents .=   get_officer_dign($this->input->post('avar_secetroy'));
}
else {
     $contents .= '-------';
    }
	
$contents .= '</div></td></tr>';
$contents .= '<tr><td colspan="3" align="right"><div class="law_dept" >मध्यप्रदेश शासन विधि और विधायी कार्य विभाग, भोपाल</div></td></tr>';	
$contents .= '<tr><td colspan="3">&nbsp;</td></tr><tr><td align="left" colspan="3"><table width="100%"><tr><td>';
$contents .= 'पृ. क्रं ';
if($is_genrate == true){
$contents .= $post_data['head'];
}else
{
	 $contents .= '----';
	
}

$contents .= '/'.date("y").'/'.$panji_krmank.'/21-क(आप),';
$contents .= '</td><td align="right">भोपाल, दिनांक '.date("d-m-Y").'</td></tr></table>';
$contents .= '</td></tr><tr>';
$contents .= '<td align="left" valign="top">';
$contents .= 'प्रतिलिपि:- </td><td colspan="2" valign="top"  >';
$contents .= ' आयुक्त ';
$contents .= $district_name_hi;
$contents .= ' (म.प्र.) सम्भाग ';
if($is_genrate == true){
    $contents .= '<span>'.$post_data['sambhag'].'</span>';
}else{
    $contents .= '<select name="sambhag">';
    foreach($sambhag as $row){
        $contents .= '<option value="'.$row.'">'.$row.'</option>';
    }
    $contents .= '</select>';
}
$contents .= '&nbsp;की ओर कार्यालय कलेक्टर एवं जिला दण्डाधिकारी, '.$district_name_hi.'';
$contents .= '&nbsp;म.प्र.&nbsp;के ';
$contents .= $file_type == 'l' ? 'पत्र क्रमांक': false;
$contents .= $file_type == 'f' ? 'यू.ओ. क्रमांक': false;
$contents .= ' '.$file_uo_or_letter_no.' दिनांक '.$file_uo_or_letter_date1.' के संदर्भ में सूचनार्थ प्रेषित । </td></tr>';
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right" colspan="3"><div class="officer-center">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td colspan="3">&nbsp;</td></tr>';
}
 $contents .= '<tr><td colspan="3" align="right"><div  contenteditable="false"  class="officer-center">( ';
if($is_genrate == true){
$contents .=  get_officer_information($this->input->post('avar_secetroy')); 

}else
{
        // $contents .= get_officer_for_sign('avar_secetroy' ,$uber_sect ,'', $us_id);
	$contents .= "-------";
}

$contents .= ' )</div></td></tr>';
$contents .= '<tr><td colspan="3" align="right"><div  contenteditable="false"  class="officer-center ">';

if($is_genrate == true){    
    $contents .=   get_officer_dign($this->input->post('avar_secetroy'));
}
else {
     $contents .= '-------';
    }
	
$contents .= '</div></td></tr>';
$contents .= '<tr><td align="right"  colspan="3"  align="right"><div class="law_dept" style="">मध्यप्रदेश शासन विधि और विधायी कार्य विभाग, भोपाल</div></td></tr>';	

?>
