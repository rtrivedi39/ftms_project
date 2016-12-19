<?php 
$contents  = '' ;
$contents .= '<tr><td align="center"><u><h3>'.$dept_name.'</h3></u></td></tr>';
$contents .= '<tr><td><div style="float:left">क्रमांक  '.$file_number.'/'.date("Y").'/21-क(या0),  </div><div style="float:right">भोपाल, दिनांक  ';
if($is_genrate == true){
$contents .= '&nbsp;&nbsp; '.get_date_formate($post_data['date1'],' /m/Y').'</div></td></tr>';
}else
{
	$contents .=  '<input type="text" class="date1" name="date1" value="'.$today.'" placeholder="dd/mm/yyyy" />';
}
$contents .=  '</div></td></tr>';
if($is_genrate == true){
	$contents .= '<tr><td align="left"><span style="margin-left:8%">'.$post_data['advocate_type'].',';
	$contents .= '</span></td></tr>';
	$contents .= '<tr><td align="left"><span style="margin-left:8%">'.$post_data['court_type'].'</span>,</td></tr>';
	$contents .= '<tr><td align="left"><span style="margin-left:8%">'.$post_data['court_location'].'</span></td></tr>';
} else {
	$contents .= '<tr><td align="left"><select name="advocate_type" class="advocate_type">';
	foreach($advocate_type as $row){
		$contents .= '<option value="'.$row.'">'.$row.'</option>';
	}	
	$contents .= '</td></tr>';
	$contents .= '<tr><td align="left"><select name="court_type" class="court_type">';
	foreach($court_type as $row){
		$contents .= '<option value="'.$row.'">'.$row.'</option>';
	}
	$contents .= '</select></td></tr>';
	$contents .= '<tr><td align="left"><select name="court_location" class="court_location">';
	foreach($court_location as $row){
		$contents .= '<option value="'.$row.'">'.$row.'</option>';
	}
	$contents .= '</select>,</td></tr>';
}
$contents .=  '<tr><td>विषय:- <span style="margin-left:4%">';
if($is_genrate == true){ 
    $contents .=  ' '.$post_data['subject'];
} else {
    $contents .= ' <textarea name="subject" style="margin: 0px; height: 40px; width: 80%;">'.$file_subject.'</textarea>';
}
/*$contents .=  '<tr><td>विषय:- <span style="margin-left:4%"> रिट याचिका क्र. '.$case_no;
if($is_genrate == true){ 
    $contents .=  ' '.$post_data['agenst_name'];
} else {
    $contents .= ' <input type="text" class="" name="agenst_name" value="'.$agenst_name.'" />';
}
$contents .= ' विरुद्ध ';
if($is_genrate == true){ 
    $contents .=  $post_data['agenst'];
} else {
    $contents .= ' <input type="text" class="" name="agenst" value="'.$agenst.'" />';
}*/
$contents .= '|</td></tr>';
$contents .= '<tr><td align="center">----</td></tr>';
$contents .= '<tr><td><p><span style="margin-left:8%"></span>उपरोक्त प्रकरण में अनावेदक म.प्र. शासन की ओर से प्रत्यावर्तन प्रस्तुत कर पक्षसमर्थन/प्रतिरक्षण करने का कष्ट करें।</p></td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">मध्यप्रदेश के राज्यपाल के नाम से तथा आदेशानुसार,</div></td></tr>';
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right"><div  style="width:50%; text-align:center;">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td>&nbsp;</td></tr>';
}
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;" contenteditable="false">(';
if($is_genrate == true){	 
	$contents .= get_officer_information($this->input->post('sing_user')); 
}else{
	$contents .= get_officer_for_sign('sing_user' ,array(2,3,4,5,7) ,'', $as_id);
}

$contents .= ')</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;" contenteditable="false">';
if($is_genrate == true){
	$contents .=   get_officer_dign($this->input->post('sing_user'));
}else{
	$contents .= '-------';
}
$contents .= '</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">'.$dept_name.'</div></td></tr>';
$contents .= '<tr><td><div style="float:left">पृ0 क्रमांक  '.$file_number.'/'.date("Y").'/21-क(या0),  </div><div style="float:right">भोपाल, दिनांक  ';
if($is_genrate == true){
	$contents .= '&nbsp;&nbsp; '.get_date_formate($post_data['date1'],'/m/Y').'</div></td></tr>';
}else{
	$contents .=  '<input type="text" class="date1" name="date2" value="'.$today.'" placeholder="dd/mm/yyyy" />';
}
$contents .= '<tr><td>प्रतिलिपि:-</td></tr>';

$contents .=  '<tr><td><p>';
if($is_genrate == true){
	$contents .= $post_data['send_at'].', ';
}else{
	$contents .=  '<select name="send_at">';	
	$contents .=  '<option value="सचिव">सचिव</option>';
	$contents .=  '<option value="प्रमुख सचिव">प्रमुख सचिव</option>';
	$contents .=  '<option value="संचालक">संचालक</option>';
	$contents .=  '<option value=""></option>';
	$contents .=  '</select>';
}
if($is_genrate == true && ($post_data['send_at'] == 'सचिव' || $post_data['send_at'] == 'प्रमुख सचिव')){
	$contents .=  'म0प्र0 शासन,‍ ';
}else{
	$contents .=  '';
}
$contents .=  ' '.$file_department.', ';
if($is_genrate == true && ($post_data['send_at'] == 'सचिव' || $post_data['send_at'] == 'प्रमुख सचिव')){
	$contents .=  'मंत्रालय ';
}else{
	$contents .=  '';
}
$contents .=  ' भोपाल की ओर उनके यू0ओ0क्र0 '.$file_uo_or_letter_no.', दिनांक  ';
$contents .=  ' '.get_date_formate($file_uo_or_letter_date,'d/m/Y');
$contents .= '  के संदर्भ में नस्ती सहित म.प्र. शासन विधि विभाग नियमावली के नियम- 136 के अधीन आवश्यक कार्यवाही हेतु अग्रेषित। इस प्रकरण में प्रभारी अधिकारी को तत्काल निर्देश दीजिये कि वे प्रकरण से संबंधित अभिलेख तथा अन्य कागजात के साथ शासकीय अधिवक्ता से संपर्क करें। ';
$contents .= '</p></td></tr>';
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right"><div  style="width:50%; text-align:center;">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td>&nbsp;</td></tr>';
}
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;" contenteditable="false">(';

if($is_genrate == true){
	$contents .=  get_officer_information($this->input->post('sing_user')); 
}else{
	$contents .= '-------';	
}
$contents .= ')</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;" contenteditable="false">';
if($is_genrate == true){	
    $contents .=   get_officer_dign($this->input->post('sing_user'));
}else{
	$contents .= '-------';
} 
$contents .= '</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">'.$dept_name.'</div></td></tr>';
?>


