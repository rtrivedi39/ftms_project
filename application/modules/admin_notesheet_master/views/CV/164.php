<?php 
$contents  = '' ;
$contents .= '<tr><td align="center"><u><h3>'.$dept_name.'</h3></u></td></tr>';
$contents .= '<tr><td align="center"><u><h4>//आदेश//</h4></u></td></tr>';
$contents .= '<tr><td><div style="float:left">क्रमांक  3(ए)/';
if($is_genrate == true){ 
	$contents .=  ''.$post_data['number'];
} else {
	$contents .= ' <input type="text" class="" name="number">';
}
$contents .=  '/'.date("Y").'/'.$file_number.'/21-क(सि.),  </div><div style="float:right">भोपाल, दिनांक  ';
if($is_genrate == true){
$contents .= get_date_formate($post_data['date1'],'d/m/Y').'</div></td></tr>';
}else
{
	$contents .=  '<input type="text" class="date1" name="date1" value="'.$today.'" placeholder="dd/mm/yyyy" required>';
}
$contents .=  '</div></td></tr>';
$contents .= ' <tr><td align="left"><p>राज्य शासन,  ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['name_of'].'</b>';
}else{
	$contents .=  '<input type="text" class="" name="name_of" value="श्री सचिन के. वर्मा"  required>';
}
$contents .= ', अधिवक्ता को राष्ट्रीय ग्रीन ट्रिब्युनल  ';
if($is_genrate == true){
	$contents .= ''.$post_data['title_loc'];
} else {
	$contents .= ' <select name="title_loc" class="title_loc">';
	$contents .= '<option value="भोपाल">भोपाल</option>';
	$contents .= '</select>';
}
$contents .= ' के समक्ष प्रकरण क्रमांक '.$case_no;
if($is_genrate == true){
$contents .= ' '.$post_data['agenst'] ;
}else{
$contents .= ' <input type="text" name="agenst" value="'.$agenst.'"/> ';
}
$contents .= ' विरूद्ध ';
if($is_genrate == true){
$contents .= ' '.$post_data['agenst_name'] ;
}else{
$contents .= '<input type="text" name="agenst_name" value="'.$agenst_name.'"/> ';
}

$contents .= ' में, शासन की ओर से पैरवी करने हेतु एतद्द्वारा नियुक्त करता है।</p>';
$contents .= '</td></tr>';
$contents .= '<tr><td><p> इस संबंध में फीस का भुगतान विधि विभाग द्वारा जारी आदेश दिनांक  27.08.2012 में वर्णित शर्तो के अधीन प्रशासकीय विभाग द्वारा किया जायेगा।</p></td></tr>';
$contents .= '<tr><td align="right">मध्यप्रदेश के राज्यपाल के नाम से तथा आदेशानुसार,</td></tr>';
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right"><div  style="width:60%; text-align:center;">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td>&nbsp;</td></tr>';
}
$contents .= '<tr><td align="right" style="line-height:15px;"><div style="width:60%; text-align:center;">(';

if($is_genrate == true){	 
	$contents .= get_officer_information($this->input->post('sing_user')); 
}else{
	$contents .= get_officer_for_sign('sing_user' ,array(2,3,4,5,7) ,'', $as_id);
}
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">';
if($is_genrate == true){	
    $contents .=   get_officer_dign($this->input->post('sing_user'));
}else{
	$contents .= '-------';
}  
$contents .= '</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">'.$dept_name.'</div></td></tr>';
$contents .= '<tr><td><div style="float:left">क्रमांक  3(ए)/';
if($is_genrate == true){ 
	$contents .=  ''.$post_data['number'].'';
} else {
	$contents .= ' ----- ';
}
$contents .=  '/'.date("Y").'/'.$file_number.'/21-क(सि.),  </div><div style="float:right">भोपाल, दिनांक  ';
if($is_genrate == true){
$contents .= get_date_formate($post_data['date1'],'d/m/Y').'</div></td></tr>';
}else
{
	$contents .=  '<input type="text" class="date1" name="date1" value="'.$today.'" placeholder="dd/mm/yyyy" required>';
}
$contents .=  '</div></td></tr>';
$contents .= '<tr><td>प्रतिलिपि:-</td></tr>';
$contents .=  '<tr><td>1- <p>सचिव, म0प्र0 शासन,‍ ';
$contents .=  ' <b>'.$file_department.'</b>';
$contents .=  ', मंत्रालय भोपाल की ओर उनके यू0ओ0क्र0 <b>'.$file_uo_or_letter_no.'</b>, दिनांक  ';
$contents .=  ' '.get_date_formate($file_uo_or_letter_date,'d/m/Y');
$contents .=  ' के संदर्भ में उनकी नस्ती सहित सूचनार्थ एवं आवश्यक कार्यवाही हेतु अग्रेषित। ';
$contents .= '<tr><td>2- <p>';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['name_of_full'].'</b>';
}else{
	$contents .=  '<input type="text" class="" name="name_of_full" size="100" value="श्री सचिन के. वर्मा, अधिवक्ता, एम0आई0जी0 508, विजय स्तम्भ, नियर प्रेस काॅम्लेक्स, एम.पी. नगर जोन-1, भोपाल-462011"  required>';
}
$contents .= ' , मध्यप्रदेश की ओर आवश्यक कार्यवाही हेतु अग्रेषित।</p></td></tr>';
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right"><div  style="width:60%; text-align:center;">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td>&nbsp;</td></tr>';
}
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">(';
if($is_genrate == true){
	$contents .=  get_officer_information($this->input->post('sing_user')); 
}else{
	$contents .= '-------';	
}
$contents .= ')</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">';
if($is_genrate == true){	
    $contents .=   get_officer_dign($this->input->post('sing_user'));
}else{
	$contents .= '-------';
}  
$contents .= '</div></td></tr>';

$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">'.$dept_name.'</div></td></tr>';
?>


