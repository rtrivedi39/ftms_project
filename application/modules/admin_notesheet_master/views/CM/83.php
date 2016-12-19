<?php
$contents  = '' ;
$contents .= '<tr><td align="right" colspan="3"><u>स्पीड-पोस्ट द्वारा</u></td></tr>';
$contents .= '<tr><td align="center" colspan="3"><h3><u>मध्यप्रदेश शासन, विधि एवं विधायी कार्य विभाग, भोपाल</u></h3></b></td></tr>';
$contents .= '<tr><td colspan="3"><table width="100%"><tr><td>क्रमांक 12/';
if($is_genrate == true){
    $contents .= $post_data['head'];
}else{
	$contents .= '<input name="head" placeholder="head" type="text" />';
}

$contents .= '/'.date("y").'/'.$panji_krmank.'/21-क (आप), </td><td  align="right"> भोपाल, दिनांक '.date("d-m-Y").' </td></tr></table></td></tr>';
$contents .= '<tr><td align="left" valign="top" > प्रति,</td><td colspan="2"></td></tr>';
$contents .= '<tr><td></td><td colspan="2">';
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
$contents .= '</td></tr>';
$contents .= '<tr><td>विषय:- </td><td colspan="2" > '.$file_subject.' </td></tr>';
$contents .= '<tr><td align="center" colspan="3" valign="top">';
$contents .= '---0---';
$contents .= '</td></tr>';
$contents .= '<tr><td></td><td colspan="2"><p>उपरोक्त रिट याचिका में अनावेदक म०प्र०शासन की ओर से पक्ष समर्थन / प्रतिरक्षण करने का कष्ट करे |</p></td></tr>';
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
$contents .= '<tr><td colspan="3" ><table width="100%"><tr><td>क्रमांक 12/';
if($is_genrate == true){
$contents .= $post_data['head'];
}else
{
	$contents .=  '--------';
}

$contents .= '/'.date("y").'/'.$panji_krmank.'/21-क (आप),</td>';
$contents .= '<td align="right"> भोपाल, दिनांक '.date("d-m-Y").' </td></tr></table></td></tr>';
$contents .= '<tr><td width="100px">प्रतिलिपि  :-  </td><td colspan="2"></td></tr>';
$contents .= '<tr><td></td><td colspan="2"><div>1. सचिव मध्यप्रदेश शासन '.@$file_department.' मंत्रालय वल्लभ भवन भोपाल की ओर उनके यू.ओ .क्रमांक '.$file_uo_or_letter_no.' दिनांक '.$file_uo_or_letter_date1.' के सन्दर्भ में म०प्र० विधि विभाग नियमावली के नियम 136 के अधीन आवश्यक निर्देश दीजिये कि वे प्रकरण से संबंधित अभिलेख तथा अन्य कागज़ात के साथ शासकीय अधिवक्ता  से संम्पर्क करे |</div></td></tr>';
$contents .= '<tr><td></td><td><div>2 . जिला दंडाधिकारी ';
if($is_genrate == true){
$contents .= $post_data['state_1'];
}else
{
	$contents .=  get_distic_dd('state_1');
}

$contents .= ' (म०प्र०) की ओर सूचनार्थ एवं आवश्यक कायर्वाही हेतु प्रेषित |</div></td></tr>';
$contents .= '<tr><td></td><td><div>3 . पुलिस अधीक्षक ';
if($is_genrate == true){
$contents .= $post_data['state_1'];
}else
{
	$contents .=  get_distic_dd('state_1');
}

$contents .= '( म०प्र०) की ओर सूचनार्थ एवं आवश्यक कार्यवाही हेतु प्रेषित |</div></td></tr>';
$contents .= '<tr><td colspan="2">&nbsp;</td></tr>';
$contents .= '<tr><td align="right" height="30"></td></tr>';
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right" colspan="3"><div class="officer-center">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td colspan="3">&nbsp;</td></tr>';
}
 $contents .= '<tr><td colspan="3" align="right"><div contenteditable="false"  class="officer-center">( ';
if($is_genrate == true){
$contents .=  get_officer_information($this->input->post('avar_secetroy')); 

}else
{
    // $contents .= get_officer_for_sign('avar_secetroy' ,$uber_sect ,'', $us_id);
	$contents .= "-------";
    
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
$contents .= '<tr><td colspan="2" align="right"><div class="law_dept" >मध्यप्रदेश शासन विधि और विधायी कार्य विभाग, भोपाल</div></td></tr>';
?>
