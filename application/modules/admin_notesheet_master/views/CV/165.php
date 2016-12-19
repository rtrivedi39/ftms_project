<style>
p{
	line-height:24px;
}
</style>
<?php 
$contents  = '<table style="font-size:14px;  width:90%; margin:0% auto;">' ;

$contents .= '<tr><td align="center"> <u><h4>'.$dept_name.' </u></h4></td></tr>';
$contents .= '<tr><td align="center"> <u><h4>//आदेश//</u></h4></td></tr>';
$contents .= '<tr><td align="right">भोपाल, दिनांक '.date("d-m-Y").'</td></tr>';
$contents .= '<tr><td align="center"> -------- </td></tr>';
$contents .= '<tr><td><p>फा0क्र0 3(ए) /';
if($is_genrate == true){ 
    $contents .=  $post_data['number'];
} else {
    $contents .= '<input type="text" class="" name="number"  value=""/>';
}
$contents .= '/'.date("Y").'/'.$file_number.'/21-क(सि.)  राज्य शासन, उच्च न्यायालय, नई दिल्ली के समक्ष प्रस्तुत प्र.क्र.'.$case_no.'  '.$agenst.' विरूद्ध '.$agenst_name.'  में अपील प्रस्तुत करने की कार्योत्तर स्वीकृृति प्रदान करता है। </p></td></tr>';
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right"><div  style="width:60%; text-align:center;">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td>&nbsp;</td></tr>';
}
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">(<b>';
if($is_genrate == true){
	$contents .=  get_officer_information($this->input->post('avar_secetroy')); 
}else{
	 $contents .= get_officer_for_sign('avar_secetroy' ,array(2,3,4,5,7,11) ,'', $us_id);
}
$contents .= '</b>)</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">';
if($is_genrate == true){
		$contents .= '<b>'.get_officer_dign($this->input->post('avar_secetroy')).'</b>';
} else {
	$contents .= '----------';
} 
$contents .= '</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">'.$dept_name.'</div></td></tr>';
$contents .= '<tr><td><div style="float:left"> पृ. फा. क्र. 3(सि.)/';
if($is_genrate == true){
	 $contents .= $post_data['number'];
}
else{
	 $contents .= '--------------' ;
}

$contents .= '/'.date("y").'/'.$panji_krmank.'/21-क (सि.), </div><div style="float:right;">';
$contents .= 'भोपाल, दिनांक '.date("d-m-Y").'</div></td></tr>';
$contents .= '<tr><td align="">प्रतिलिपि :-</td></tr>';
$contents .= '<tr><td><table style="font-size:14px;"><tr><td width="10%" valign="top">1.</td><td width="*%" valign="top">सचिव, म.प्र. शासन, '.$file_department.' विभाग भोपाल की ओर उनके यू.ओ.क्र '.$file_uo_or_letter_no.'    दिनांक  '.$file_uo_or_letter_date.' के संदर्भ में उनकी नस्ती सहित सूचनार्थ एवं आवश्यक कार्यवाही हेतु अग्रेषित।</td></tr>';
$contents .= '<td width="10%" valign="top">2.</td><td width="*%" valign="top">उच्च न्यायालय नई-दिल्ली की ओर सूचनार्थ अग्रेषित।</td></table> </td></tr>';
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right"><div  style="width:60%; text-align:center;">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td>&nbsp;</td></tr>';
}
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">(<b>';
if($is_genrate == true){
	$contents .= get_officer_information($this->input->post('avar_secetroy')); 
} else {
	$contents .= '--------------';	
}
$contents .= '</b>)</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">';
if($is_genrate == true){
		$contents .= '<b>'.get_officer_dign($this->input->post('avar_secetroy')).'</b>';
} else {
	$contents .= '------------';
} 
$contents .= '</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">'.$dept_name.'</div></td></tr>';
$contents .= '</table>';

