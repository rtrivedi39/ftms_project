<?php
$contents  = '' ;
$contents .= '<tr><td align="right" colspan="3"><b><u>स्पीड पोस्ट</u></b></td>';
$contents .= '<tr><td align="center" colspan="3"><b><u>मध्यप्रदेश शासन, विधि एवं विधायी कार्य विभाग, भोपाल</u></b></td>';
$contents .= '</tr>';
$contents .= '<tr>';
$contents .= '<td colspan="3"><table width="100%"><tr><td>क्रमांक 6/';
if($is_genrate == true){
    $contents .= $post_data['head'];
}else{
	$contents .= '<input name="head" placeholder="head" type="text" />';
}

$contents .= '/'.date("y").'/'.$panji_krmank.'/21-क (आप),</span';
$contents .= '</td><td align="right"><span id="Label1">भोपाल, दिनांक '.date("d-m-Y").' </td>';
$contents .= '</tr></table></td></tr><tr><td align="left" valign="top" class="top_class"> प्रति,</td><td colspan="2"></td></tr><tr><td></td><td colspan="2">';
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
$contents .= '</td><td colspan="3">&nbsp;</td></tr><tr><td class="top_class" align="left" valign="top">';
$contents .= 'विषय:-</td><td colspan="2" class="text-justify">';
$contents .= 'न्यायालय ';
if($is_genrate == true){
    $contents .= $post_data['dt4'];
}else{
	 $contents .= get_Court('dt4');
	
   
}

$contents .= ' न्यायाधीश,</span>&nbsp;जिला '.$district_name_hi.' ';
$contents .= '(म.प्र.) के&nbsp;विशेष प्रकरण क्रमांक  '.$case_no.'  '.$case_parties1[2].' '.$case_parties1[1].' '.$case_parties1[0].' के मामले में अभियुक्तगण को ';
$contents .= 'भा.दं.वि. की धारा ' ;
if($is_genrate == true){
    $contents .= $post_data['text2'];
}else{
	 $contents .= '<input name="text2" type="text"/>';
	  
}

$contents .= '&nbsp;के संबंध में पारित दोषमुक्ति के निर्णय दिनांक '.$file_judgment_date1.'    के विरूद्ध अपील प्रस्तुत किये जाने बाबत् । &nbsp;';
$contents .= '</td></tr><tr><td align="left" valign="top">';
$contents .= 'संदर्भ:-</td><td colspan="2">कार्यालय कलेक्टर एवं जिला दण्डाधिकारी, जिला '.$district_name_hi.' (म.प्र.) के ';
$contents .= $file_type == 'l' ? 'पत्र क्रमांक': false;
$contents .= $file_type == 'f' ? 'यू.ओ. क्रमांक': false;
$contents .= ' '.$file_uo_or_letter_no.' दिनांक '.$file_uo_or_letter_date1 .'.';
$contents .= '</td></tr><tr><td align="center" colspan="3" valign="top">';
$contents .= '---0---';
$contents .= '</td></tr><tr>';
$contents .= '<td></td><td align="left" valign="top" colspan="2" class="text-justify">';
$contents .= '<p class=" shift-left">राज्य शासन द्वारा उपरोक्त विषयांतर्गत एवं संदर्भित प्रकरण में दोषमुक्ति के निर्णय के विरूद्ध उक्त अभियुक्तगण ';
if($is_genrate == true){
    $contents .= $post_data['text3'];
}else{
	 $contents .= '<input name="text3" type="text"/>';
 
}
$contents .= ' के संबंध में मध्यप्रदेश उच्च न्यायालय ';
if($is_genrate == true){
    $contents .= '<span>'.$post_data['court_location2'].'</span>';
}else{
    $contents .= '<select name="court_location2">';
    foreach($court_location2 as $row){
        $contents .= '<option value="'.$row.'">'.$row.'</option>';
    }
    $contents .= '</select>';
}
$contents .= ' के समक्ष अपील प्रस्तुत करने का निर्णय लिया गया है । अपील प्रस्तुत करने की परिसीमा अवधि दिनांक ';
if($is_genrate == true){
    $contents .= $post_data['text4'];
}else{
	 $contents .= '<input name="text4" type="text"/>';
 
}

$contents .= ' तक थी, अपील प्रस्ताव दिनांक  '.$file_mark_section_date.'';
$contents .= '&nbsp;को परिसीमा अवधि के बाह्य विधि विभाग में प्राप्त हुआ है ।</p> <p>';
$contents .= 'अत: आप राज्य शासन द्वारा लिये गये निर्णय के अनुसार दं.प्र.सं. की धारा 378 के अंतर्गत मध्यप्रदेश उच्च न्यायालय ';
if($is_genrate == true){
    $contents .= '<span>'.$post_data['court_location2'].'</span>';
}else {
    $contents .= '__';
}
$contents .= ' के समक्ष';
$contents .= ' दिन-प्रतिदिन के विलम्ब का पर्याप्त कारण दर्शित करते हुए विलम्ब माफी हेतु आवेदन पत्र जो प्रभारी अधिकारी के शपथपत्र से समर्थित विभाग को प्रेषित करें । अपील प्रस्ताव इस कार्यालय को अवधि बाह्य प्राप्त हुआ है । विलम्ब इस कार्यालय की ओर से नहीं हुआ है ।  <b><u>अत: विलम्ब के लिये यह कार्यालय उत्तरदायी नहीं है । माननीय उच्च न्यायालय में धारा-5 लिमिटेशन एक्ट का आवेदन मय शपथ-पत्र के प्रस्तुत किया जाएगा, जिसमें दिन-प्रतिदिन के विलम्ब को स्पष्ट किया जाएगा । </u></b>';
$contents .= '</p><br/><span><b>( सचिव विधि द्वारा अनुमोदित)</b></span><br /><span><b><u>संलग्न दस्तावेज :</u></b></span><br/>';
$contents .= '<span>1-निर्णय की सत्य प्रतिलिपि,<br />2-लोक अभियोजक का मत,<br />3-साक्षियों के कथन,<br /></span></td></tr>';
$contents .= '<tr><td align="right" colspan="3" valign="top" ><div class="law_dept"> मध्यप्रदेश के राज्यपाल के नाम से तथा आदेशानुसार, </div></td></tr>';
$contents .= '<tr><td align="right" height="20"></td></tr>';
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right" colspan="3"><div class="officer-center">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td colspan="3">&nbsp;</td></tr>';
}
$contents .= '<tr><td colspan="3" align="right"><div contenteditable="false" class="officer-center">( ';
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
