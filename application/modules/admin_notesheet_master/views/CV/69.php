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
    foreach(get_advocates_name('', $post_data['member_id']) as $row){
        $contents .= ' '.$row->scm_name_hi.', '.$row->scm_post_hi.', '.$row->scm_court_name_hi;
    }
} else {
    $contents .= ' <select name="member_id">';
    foreach($standing_counsil_memebers as $row){
        $contents .= '<option value="'.$row->scm_id.'">'.$row->scm_name_hi.'</option>';
    }
    $contents .= '</select>';
}
$contents .= ', नई दिल्ली के नेशनल ग्रीन ट्रिब्यूनल  '; 
if($is_genrate == true){
	$contents .= ''.$post_data['title_loc'];
} else {
	$contents .= ' <select name="title_loc" class="title_loc">';
	$contents .= '<option value="नई दिल्ली">नई दिल्ली</option>';
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
$contents .= ' में पारित निर्णय दिनांक  '.$file_judgment_date1.' के विरुध्द ' ;
if($is_genrate == true){ 
	$contents .=  ''.$post_data['where'];
} else {
	$contents .= ' <input type="text" class="" name="where">';
}
$contents .= ', नई दिल्ली में अपील दायर कर शासन की ओर से पैरवी करने हेतु एतद् द्वारा नियुक्त करता है।</p>';
$contents .= '</td></tr>';
$contents .= '<tr><td><p> इस सम्बंध में फीस का भुगतान विधि विभाग द्वारा जारी आदेश दिनांक ';
if($is_genrate == true){
	$contents .= get_date_formate($post_data['date2'],'d/m/Y').'';
}else{
	$contents .=  '<input type="text" class="date1" name="date2" value="'.$file_judgment_date1.'" placeholder="dd/mm/yyyy" />';
}
$contents .= ' में वर्णित शर्तो के अधीन प्रशासकीय विभाग द्वारा किया जायेगा |</p></td></tr>';
$contents .= '<tr><td align="right">मध्यप्रदेश के राज्यपाल के नाम से तथा आदेशानुसार,</td></tr>';
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right"><div  style="width:60%; text-align:center;">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td>&nbsp;</td></tr>';
}
$contents .= '<tr><td align="right" style="line-height:15px;"><div style="width:60%; text-align:center;">(';

if($is_genrate == true){
	$contents .=  get_officer_information($this->input->post('avar_secetroy')); 
}else{
	 $contents .= get_officer_for_sign('avar_secetroy' ,array(2,3,4,5,7) ,'', $us_id);
}$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">'.$dept_name.'</div></td></tr>';
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
    foreach(get_advocates_name('', $post_data['member_id']) as $row){
        $contents .= ' <b>'.$row->scm_name_hi.', '.$row->scm_post_hi.', '.$row->scm_court_name_hi.', '.$row->scm_address_hi.', '.$row->scm_pincode_hi.'</b>';
    }
} else {
    $contents .= '----------';
}
$contents .= ' की ओर वकालतनामा संलग्न कर आवश्यक कार्यवाही हेतु अग्रेषित।</p></td></tr>';
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right"><div  style="width:60%; text-align:center;">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td>&nbsp;</td></tr>';
}
$contents .= '<tr><td align="right" style="line-height:15px;"><div style="width:60%; text-align:center;">(';

if($is_genrate == true){
	$contents .=  get_officer_information($this->input->post('avar_secetroy')); 
}else{
	 $contents .= '-----------';
}
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">'.$dept_name.'</div></td></tr>';
?>


