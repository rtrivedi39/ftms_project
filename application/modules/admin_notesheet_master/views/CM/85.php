<?php
$contents  = '' ;
$contents .= '<tr><td align="right" colspan="3"><u>स्पीड-पोस्ट द्वारा</u></td></tr>';
$contents .= '<tr><td align="center" colspan="3"><h2><u>मध्यप्रदेश शासन, विधि एवं विधायी कार्य विभाग, भोपाल</u></h2></b></td>';
$contents .= '</tr>';
$contents .= '<tr>';
$contents .= '<td colspan="2"> क्रमांक 6/';
if($is_genrate == true){
$contents .= $post_data['head'];
}else
{
	$contents .=  '<input type="text" name="head"  />';
}

$contents .= '/'.date("y").'/'.$panji_krmank.'/21-क (आप),</span';
$contents .= '</td><td align="right"><span id="Label1">भोपाल, दिनांक '.date("d-m-Y").' </td>';
$contents .= '</tr><tr><td align="left" valign="top" width="55px"> प्रति,</td><td>&nbsp; &nbsp;<br />';
if($is_genrate == true){
    $contents .= '<span>'.$post_data['advocate_type'].',</span>';
}else{
    $contents .= '<select name="advocate_type">';
    foreach($advocate_type as $row){
        $contents .= '<option value="'.$row.'">'.$row.'</option>';
    }
    $contents .= '</select>';
    $contents .= '<br/>__ कार्यालय,';
}
$contents .= '<br />';
if($is_genrate == true){
    $contents .= '<span>'.$post_data['advocate_type'].' कार्यालय,<br /></span>';
}
$contents .= 'मध्यप्रदेश उच्च न्यायालय,<br />';
if($is_genrate == true){
    $contents .= '<span>'.$post_data['court_location'].'</span>';
}else{
    $contents .= '<select name="court_location">';
    foreach($court_location as $row){
        $contents .= '<option value="'.$row.'">'.$row.'</option>';
    }
    $contents .= '</select>';
}
$contents .= ' (म.प्र.),<br />';
$contents .= '</td><td>&nbsp;</td></tr>';
$contents .= '<tr><td align="left" valign="top">';
$contents .= 'विषय:-</td><td colspan="2" style="text-align: justify"> '.$file_subject.' </td></tr>';
$contents .= '<tr><td align="left" valign="top">';
$contents .= 'सन्दर्भ:-</td><td colspan="2" style="text-align: justify"> आपका पत्र  '.$file_uo_or_letter_no.' क्रमांक दिनांक '.$file_uo_or_letter_date.'  </td></tr>';

$contents .= '<tr><td align="center" colspan="3" valign="top">';
$contents .= '---0---';
$contents .= '</td></tr>';
$contents .= '<tr><td colspan="3"><p>उपरोक्त विषयांकित चाही गई जानकारी के संबंध में लेख है कि,  एमसीआरसी प्रकरण क्रमांक '.@$case_no ;
if($is_genrate == true){
    $contents .= '<span>'.$post_data['aganist'].'</span>';
}else{
   
$contents .= "<input type='text' name='aganist' >";
   
}
$contents .= ' विरुद्ध मध्यप्रदेश एवं अन्य में आवश्यक कार्यवाही उपरांत एस0एल0पी0 नहीं करने का निर्णय लिया गया हैा </p></td></tr>';
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right" colspan="3"><div  class="officer-center" >(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td colspan="3">&nbsp;</td></tr>';
}
$contents .= '<tr><td colspan="3" align="right"><div contenteditable="false"  class="officer-center">( ';
if($is_genrate == true){
$contents .=  get_officer_information($this->input->post('avar_secetroy')); 

}else
{
     $contents .= get_officer_for_sign('avar_secetroy' ,$uber_sect ,'', $us_id);
    
}

$contents .= ' )</div></td></tr>';
$contents .= '<tr><td colspan="3" align="right"><div contenteditable="false"  class="officer-center ">';

if($is_genrate == true){    
    $contents .=   get_officer_dign($this->input->post('avar_secetroy'));
}
else {
     $contents .= '-------';
    }
	
$contents .= '</div></td></tr>';
$contents .= '<tr><td colspan="3" align="right"><div class="law_dept" style="margin-right:150px" >मध्यप्रदेश शासन विधि और विधायी कार्य विभाग, भोपाल</div></td></tr>';

$contents .= '</tr>';

$contents .= '<tr><td colspan="2" > क्रमांक 12/';
if($is_genrate == true){
$contents .= $post_data['head'];
}else
{
	$contents .=  '--------';
}

$contents .= '/'.date("y").'/'.$panji_krmank.'/21-क (आप),</span';
$contents .= '</td><td align="right"><span id="Label1">भोपाल, दिनांक '.date("d-m-Y").' </td></tr>';
$contents .= '<tr><td colspan="3">प्रतिलिपि  :-  </td></tr>';
$contents .= '<tr><td colspan="3"><div style="margin-left:70px" >1 . जिला दंडाधिकारी ';
if($is_genrate == true){
$contents .= $post_data['state_1'];
}else
{
	$contents .=  get_distic_dd('state_1');
}

$contents .= ' (म०प्र०) की ओर सूचनार्थ एवं अग्रेषित |</div></td></tr>';

if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right" colspan="3"><div  class="officer-center" >(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td colspan="3">&nbsp;</td></tr>';
}
$contents .= '<tr><td colspan="3" align="right"><div contenteditable="false"  class="officer-center">( ';
if($is_genrate == true){
$contents .=  get_officer_information($this->input->post('avar_secetroy')); 

}else
{
     $contents .= get_officer_for_sign('avar_secetroy' ,$uber_sect ,'', $us_id);
    
}

$contents .= ' )</div></td></tr>';
$contents .= '<tr><td colspan="3" align="right"><div contenteditable="false"  class="officer-center ">';

if($is_genrate == true){    
    $contents .=   get_officer_dign($this->input->post('avar_secetroy'));
}
else {
     $contents .= '-------';
    }
	
$contents .= '</div></td></tr>';


$contents .= '<tr><td colspan="3" align="right"><div class="law_dept" style="margin-right:150px" >मध्यप्रदेश शासन विधि और विधायी कार्य विभाग, भोपाल</div></td></tr>';
?>
