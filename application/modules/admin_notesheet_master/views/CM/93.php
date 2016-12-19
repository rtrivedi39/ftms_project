<?php
$contents  = '' ;
$contents .= '<tr><td align="right" colspan="3"><u>स्पीड-पोस्ट द्वारा</u></td></tr>';
$contents .= '<tr><td align="center" colspan="3"><h2><u>मध्यप्रदेश शासन, विधि एवं विधायी कार्य विभाग, भोपाल</u></h2></b></td>';
$contents .= '</tr>';
$contents .= '<tr>';
$contents .= '<td colspan="2"> क्रमांक ';
$contents .= $panji_krmank.'/21-क (आप),</span';
$contents .= '</td><td align="right"><span id="Label1">भोपाल, दिनांक '.date("d-m-Y").' </td>';
$contents .= '</tr><tr><td align="left" valign="top" width="55px" class="top_class"> प्रति,</td><td>&nbsp; &nbsp;<br />';
$contents .= '<span>जिला दंडाधिकारी,</span><br />';
get_distic_dd('disct' );
if($is_genrate == true){
    $contents .= '<span>'.$post_data['court_location'].'</span>';
}else{
    $contents .= get_distic_dd('court_location' );
}
$contents .= ' (म.प्र.),<br />';
$contents .= '</td><td>&nbsp;</td></tr><tr><td align="left" valign="top" class="top_class">';
$contents .= 'विषय:-</td><td colspan="2">';
$contents .= 'माननीय न्यायालय, ';
if($is_genrate == true){
    $contents .= $post_data['dt4'];
}else{
	 $contents .= get_Court('dt4');
}
$case_no1 = explode('/',$case_no);
$contents .= '<span id="Label5"> न्यायाधीश,</span>&nbsp;जिला '.$district_name_hi.' ';
$contents .= '<span id="l2">(म.प्र.)</span>&nbsp;के  '.$case_no1[0].' ';
$contents .= '  प्रकरण क्रमांक '.$case_no1[1].' '.$case_no1[2].' '.$case_parties1[2].' '.$case_parties1[1];
if($is_genrate == true){
    $contents .= $post_data['against'];
}else{
    $contents .= '<input type="text" name="against" />';
}
$contents .= ' में पारित निर्णय दिनांक ';
if($is_genrate == true){
    $contents .= $post_data['apeel_date'];
}else{
    $contents .= '<input type="text" name="apeel_date" value="'.$file_judgment_date1.'" class="date1"/>';
}

$contents .= ' से सम्बंधित ';

if($is_genrate == true){
	$contents .= $post_data['ddl_option'];
}else
{
	$contents  .= '<select name="ddl_option" ><option>साक्ष्यो के कथन की नकले </option><option>शासकीय अधिवक्ता का मत </option><option>साक्ष्यो के कथन की नकले व शासकीय अधिवक्ता का मत </option>
	<option>दा० प्र० क्र० _____&#47; ____ के निर्णय की प्रति  </option></select> ';
}
$contents .= ' व अन्य दस्तावेज भेजने बाबत |	 </td></tr>';
$contents .= '<tr><td align="left" valign="top">';
$contents .= 'सन्दर्भ:-</td><td colspan="2" > आपका पत्र क्रमांक '.$file_uo_or_letter_no .' दिनांक  '.date('d-m-Y',strtotime( $file_uo_or_letter_date) ).'</td></tr>';
$contents .= '<tr><td align="center" colspan="3" valign="top">';
$contents .= '---0---';
$contents .= '</td></tr>';
$contents .= '<tr><td colspan="3"><p class="shift-left">उपरोक्त विषयक संदर्भित पत्र के संबंध में लेख किया जाता है कि जिला दंडाधिकारी कार्यालय से विभाग को जो अपील प्रस्ताव भेजा गया है, उसके साथ साक्षियों  के कथन की नकलें  एवं अन्य दस्तावेज संलग्न कर नहीं भेजी है, जिनके अभाव में अपील मत दिया जाना संभव नहीं है अत: तत्काल चाहे गये दस्तावेज विधि विभाग को भेजने का कष्ट करे | तत्पश्चात  ही उपरोक्त प्रकरण  में अपील अभिमत दिया जाना संभव होगा| साथ ही लेख किया जाता है कि प्रकरण में हुए विलंब का उत्तरदायित्व आपके कार्यालय का होगा |</p></td></tr>';

$contents .= '<tr><td colspan="3">&nbsp;</td></tr>';
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
$contents .= '<tr><td colspan="3" align="right"><div  contenteditable="false" class="officer-center">';

if($is_genrate == true){    
    $contents .=   get_officer_dign($this->input->post('avar_secetroy'));
}
else {
     $contents .= '-------';
    }
$contents .= '</div></td></tr>';
$contents .= '<tr><td colspan="3" align="right"><div  class="officer-center" style="">मध्यप्रदेश शासन विधि और विधायी कार्य विभाग, भोपाल</div></td></tr>';
?>
