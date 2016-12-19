<?php
$contents  = '' ;
$contents .= '<tr><td align="right" colspan="3"><b><u>स्पीड पोस्ट</u></b>';
$contents .= '<tr><td align="center" colspan="3"><b><u>मध्यप्रदेश शासन, विधि एवं विधायी कार्य विभाग, भोपाल</u></b>';
$contents .= '</td></tr><tr><td colspan="3"><table width="100%"><tr><td align="left"> क्र 6/';
if($is_genrate == true){
    $contents .= $post_data['head'];
}else{
	$contents .= '<input name="head" placeholder="head" type="text" />';
}
$contents .= '/'.date("y").'/'.$panji_krmank.'/21-क (आप), </td>';
$contents .= '<td align="right">भोपाल, दिनांक ';
if($is_genrate == true){
 if($post_data['date1']!= '' ){ $contents .= $post_data['date1']; }else { $contents .= '&nbsp;&nbsp;&nbsp;&nbsp;' ;}
}else
{
	$contents .=  '<input type="text" class="date1" name="date1" placeholder="dd/mm/yyyy" />';
}
$contents .= '</td></tr></table></td></tr><tr>';
$contents .= '<td  valign="top" width="55px"  class="top_class"> प्रति,</td><td><br />';
if($is_genrate == true){
    $contents .= '<span>'.$post_data['advocate_type'].',</span>';
}else{
    $contents .= '<select name="advocate_type">';
    foreach($advocate_type as $row){
        $contents .= '<option value="'.$row.'">'.$row.'</option>';
    }
    $contents .= '</select>';
    $contents .= '<br/>__';
}
$contents .= '<br />';
if($is_genrate == true){
    $contents .= '<span>'.$post_data['advocate_type'].' कार्यालय</span>';
}
$contents .= ',<br />';
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
$contents .= ',<br /></td><td>&nbsp;</td></tr>';
$contents .= '<tr><td valign="top" class="top_class">';
$contents .= 'विषय:-</td><td colspan="2" valign="top"><div id="dv1">';
$contents .= 'माननीय न्यायालय, ';
if($is_genrate == true){
    $contents .= $post_data['dt4'];
}else{
	 $contents .= get_Court('dt4');
}
$case_no1 = explode('/',$case_no);
$contents .= '<span id="Label5"> न्यायाधीश,</span>&nbsp;जिला '.$district_name_hi.' ';
$contents .= '<span id="l2">(म.प्र.)</span>&nbsp;के  '.$case_no1[0].' ';
$contents .= '  प्रकरण क्रमांक '.$case_no1[1].' '.$case_no1[2].' '.$case_parties1[2].' '.$case_parties1[1].' '.$case_parties1[0].'  के मामले में अभियुक्तगण को';
$contents .= ' भा.दं.वि. की धारा ';
if($is_genrate == true){
    $contents .= $post_data['dhara'];
}else{
	 $contents .= '<input name="dhara" type="text" />';
}

$contents .= ' में पारित दोषमुक्ति निर्णय दिनांक '.$file_judgment_date1.'  ';
$contents .= 'के विरूद्ध अपील प्रस्तुत किये जाने बावत् । </div>';
$contents .= '</td></tr><tr><td  valign="top"  class="top_class">';
$contents .= 'संदर्भ:-</td><td colspan="2">कार्यालय कलेक्टर एवं जिला दण्डाधिकारी, जिला '. $district_name_hi.' (म.प्र.) ';
$contents .= $file_type == 'l' ? 'पत्र क्रमांक': false;
$contents .= $file_type == 'f' ? 'यू.ओ. क्रमांक': false;
$contents .= ' '.$file_uo_or_letter_no.' दिनांक '.date('d-m-Y',strtotime($file_uo_or_letter_date));
$contents .= '</td></tr><tr><td align="center" colspan="3">';
$contents .= '---000---';
$contents .= '</td></tr>';
$contents .= '<tr><td></td><td colspan="2">';
$contents .= '<tr><td></td><td align="center" colspan="2">';
$contents .= '<p class="text-justify"> राज्य शासन द्वारा उपरोक्त विषयांतर्गत एवं संदर्भित प्रकरण में दोषमुक्ति के निर्णय के विरूद्ध उक्त अभियुक्तगण ';
if($is_genrate == true){
    $contents .= $post_data['text1'];
}else{
	 $contents .= '<input name="text1" type="text" />';
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
$contents .= ' के समक्ष अपील प्रस्तुत करने का निर्णय लिया गया है । अपील प्रस्ताव दिनांक     ';
if($is_genrate == true){
    $contents .= $post_data['apeel_date'];
}else{
    $contents .= '<input type="text" name="apeel_date" class="date1"/>';
}

$contents .= ' को विधि विभाग में प्राप्त हुआ है । अपील प्रस्तुत करने की परिसीमा अवधि दिनांक  ';
if($is_genrate == true){
    $contents .= $post_data['limitation_date'];
}else{
    $contents .= '<input name="limitation_date" type="text" id="date2"/>';
}
$contents .= ' तक हैं ।</p></td></tr>';
$contents .= '<tr><td></td><td colspan="2" class="shift-left">अत: आप राज्य शासन द्वारा लिये गये निर्णय के अनुसार दं.प्र.सं. की धारा 378 के अंतर्गत मध्यप्रदेश उच्च न्यायालय ';
if($is_genrate == true){
    $contents .= '<span>'.$post_data['court_location2'].'</span>';
}else{
    $contents .= '__';
}
$contents .= ' के समक्ष दिनांक ';
if($is_genrate == true){
    $contents .= $post_data['inform_date'];
}else{
    $contents .= '<input name="inform_date" type="text" id="date3"/>';
}

$contents .= ' तक अपील प्रस्तुत करने की समुचित कार्यवाही करें । यदि नियत दिनांक ';
if($is_genrate == true){
    $contents .= $post_data['text4'];
}else{
    $contents .= '<input name="text4" type="text" id="date4"/>';
}
$contents .= ' तक अपील प्रस्तुत नहीं की जाती है तो दिन-प्रतिदिन विलम्ब का कारण दर्शित करते हुए विलम्ब माफी हेतु आवेदन पत्र से समर्थित हो, सहित अपील प्रस्तुत की जाये तथा कार्यवाही की सूचना शीघ्र विधि विभाग को प्रेषित करें ।';
$contents .= '</p></td></tr>';
$contents .= '<tr><td></td><td colspan="2"><p><b>(अतिरिक्त सचिव विधि द्वारा अनुमोदित) </b><br /><b><u>संलग्न दस्तावेज :</u></b><br /> 1-निर्णय की सत्य प्रतिलिपि,<br />';
$contents .= '2-लोक अभियोजक का मत,<br />3-साक्षियों के कथन, ';
$contents .= '</p></td></tr>';
$contents .= '<td align="right" colspan="3"><b> मध्यप्रदेश के राज्यपाल के नाम से तथा आदेशानुसार, </b>&nbsp;&nbsp;</td></tr><tr>';
$contents .= '<tr><td align="right" height="20"></td></tr>';
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

$contents .= '<tr><td colspan="3" align="right"><div  contenteditable="false" class="officer-center ">';

if($is_genrate == true){    
    $contents .=   get_officer_dign($this->input->post('avar_secetroy'));
}
else {
     $contents .= '-------';
    }
	
$contents .= '</div></td></tr>';
$contents .= '<tr><td colspan="3" align="right"><div style=""  class="law_dept"  >मध्यप्रदेश शासन विधि और विधायी कार्य विभाग, भोपाल</div></td></tr>';
?>
