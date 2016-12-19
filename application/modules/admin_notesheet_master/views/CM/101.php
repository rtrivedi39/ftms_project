<?php
$contents  = '' ;
$contents .= '<tr><td colspan="2" align="right"><u>स्पीड पोस्ट द्वारा</u></td></tr>';
$contents .= '<tr>';
$contents .= '<td colspan="2"><div align="center"><h4><u>मध्यप्रदेश शासन, विधि एवं विधायी कार्य विभाग, भोपाल </u></h4></div></td></tr><tr><td colspan="2"><table width="100%"><tr><td align="left">क्रमांक  ';
$contents .= '6/'.$panji_krmank.'/'.date("y").'/ 21-क(आप),';
$contents .= '</td><td align="right">भोपाल , दिनांक '.date("d-m-Y").'</td></tr></table></td></tr>';

$contents .= '<tr><td>प्रति,</td><td></td></tr>';
if($is_genrate == true){
    foreach(get_advocates_name('', $post_data['member_id']) as $row){
        $contents .= '<tr><td></td><td>'.$row->scm_name_hi.',</td></tr>';
        $contents .= '<tr><td></td><td>'.$row->scm_post_hi.', '.$row->advocate_designation.',</td></tr>';
		$contents .= '<tr><td></td><td>'.$row->scm_address_2_hin.',</td></tr>';
		$address = explode(',',$row->scm_address_hi);
        $contents .= '<tr><td></td><td>निवास पता - '. $address[0].',</td></tr>';
		$contents .= '<tr><td></td><td>'. $address[1].','.$address[2].',</td></tr>';
		$contents .= '<tr><td></td><td>'.$row->scm_court_name_hi.' (म०प्र०) </td></tr>';
    }
} else {
    $contents .= '<tr><td></td><td><select name="member_id">';
    foreach($standing_counsil_memebers_hc as $row){
        $contents .= '<option value="'.$row->scm_id.'">'.$row->scm_name_hi.'</option>';
    }
    $contents .= '</select></td></tr>';
}
$contents .= '<tr><td valign="top" class="top_class">विषय:- </td><td valign="top" class="top_class">';
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
}else
{
	$contents .=  '<input type="text" name="dhara"  />';
}
$contents .= ' में पारित दोषमुक्ति निर्णय दिनांक '.$file_judgment_date1.'  ';
$contents .= 'के विरूद्ध अपील प्रस्तुत किये जाने बावत् । ';
$contents .= '</td></tr>';
$contents .= '<tr><td valign="top" class="top_class"> संदर्भ:- </td><td>महानिरिक्षक  (प0)  विशेष पुलिस स्थापना,लोकायुक्त कार्यालय, भोपाल (म0प्र0) के पत्र क्रं. '.$file_uo_or_letter_no.'  अप0क्र0  ';
if($is_genrate == true){
$contents .= $post_data['crime_no'];
}else
{
	$contents .=  '<input type="text" name="crime_no"  />';
}
$contents .= ' भोपाल, दिनांक '.$file_uo_or_letter_date1.' </td></tr>';
$contents .= '<tr><td align="center" colspan="2"> --------0--------- </td></tr>';
$contents .= '<tr><td></td><td><p class="shift-left">राज्य शासन द्वारा उपरोक्त विषयांतर्गत एवं संदर्भित प्रकरण में अभियुक्त ';
if($is_genrate == true){
$contents .= $post_data['crimanal_name'];
}else
{
	$contents .=  '<input type="text" name="crimanal_name"  />';
}
$contents .= ' दोषमुक्ति के विरुद्ध मध्यप्रदेश उच्च न्यायालय खंडपीठ ग्वालियर के समक्ष अपील प्रस्तुत करने का निर्णय लिया गया है | अत: आप राज्य शासन द्वारा लिये गये निर्णय के अनुसार दं.प्र.सं. की धारा 378 के अंतर्गत मध्यप्रदेश उच्च न्यायालय खंडपीठ ग्वालियर के समक्ष अपील प्रस्तुत करें कार्यवाही की सुचना शीघ्र विधि विभाग को प्रेषित करें |</p></td></tr>';


$contents .= '<br /></td></tr>';
$contents .= '<tr><td colspan="2" ><b>(सचिव विधि द्वारा अनुमोदित)</b></td></tr>';
$contents .= '<tr><td colspan="2" ><u>संलग्न दस्तावेज :</u></td></tr>';
$contents .= '<tr><td colspan="2" >1-निर्णय की सत्य प्रतिलिपि,<br>2-लोकायुक्त कार्यालय का मत,<br> 3-साक्षीयों के कथनों की मत,</td></tr>';

$contents .= '<tr><td colspan="2" align="right">मध्यप्रदेश के राज्यपाल के नाम से तथा आदेशानुसार,</td></tr>';

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
$contents .= '<tr><td colspan="2" align="right"><div style=""  class="officer-center ">मध्यप्रदेश शासन विधि और विधायी कार्य विभाग, भोपाल</div></td></tr>';
$contents .= '<td>&nbsp;</td><td>&nbsp;</td></tr>';


?>
