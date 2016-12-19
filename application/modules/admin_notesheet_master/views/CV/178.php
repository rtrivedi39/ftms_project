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
$contents .= '/'.date("Y").'/'.$file_number.'/21-क(सि.)  राज्य शासन,  आई.पी.ए.बी. ';
if($is_genrate == true){
	 $contents .= $post_data['state'];
}
else{
	 $contents .= get_state_ddl_list('state');
}
$contents .= ' द्वारा प्रकरण बासमती धान की जी.आई. रजिस्ट्री के संबंध में पारित निर्णय दिनांक ';
if($is_genrate == true){ 
    $contents .=  '<b>'.$post_data['from_date'].'</b>';
} else {
    $contents .= '<input type="text" class="date1" name="from_date"  value="'.$today.'"/>';
}
$contents .= '  के विरूद्ध माननीय उच्च न्यायालय ';
if($is_genrate == true){
	 $contents .= $post_data['state'];
}
else{
	 $contents .= get_state_ddl_list('state');
}
$contents .= ' में अपील दायर करने एवं म.प्र. षासन की ओर से पैरवी हेतु प्रषासकीय विभाग की नस्ती के पृृष्ठ 136 के बिन्दु क्रमांक 02 मे उल्लेखानुसार एतद््द्वारा अनुमति प्रदान करता है।  </p></td></tr>';
$contents .= '<tr><td><p>  प्रशासकीय विभाग ( ';

if($is_genrate == true){ 
    $contents .=  $post_data['department'];
} else {
    $contents .= get_department_ddl_list('department');
}
$contents .= ' ) को फीस एवं अन्य का भुगतान स्वंय वहन करना होगा। </p></td></tr>';

if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right"><div  style="width:60%; text-align:center;">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td>&nbsp;</td></tr>';
}
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">(<b>';
if($is_genrate == true){
	$contents .=  get_officer_information($this->input->post('add_secetroy')); 
}else{
	 $contents .= get_officer_for_sign('add_secetroy' ,$add_secetroy ,'', $as_id);
}
$contents .= '</b>)</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">';
if($is_genrate == true){	
    $contents .=   get_officer_dign($this->input->post('add_secetroy'));
}
else {
	 $contents .= '-------';
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

$contents .= '<tr><td><table width="100%" style="font-size:14px;"><tr><td width="10%" valign="top">1.</td><td valign="top">माननीय उच्च न्यायालय  ';
if($is_genrate == true){
	 $contents .= $post_data['state'];
}
else{
	 $contents .= get_state_ddl_list('state');
}

 $contents .= '( <span class="city_cls">';
 if($is_genrate == true){
	 $contents .= $post_data['district'];
}
else{
	 $contents .= get_district_dd('district' );
}
$contents .= '</span>) की ओर कार्यवाही हेतु अग्रेषित</td></tr></table></td></tr>';
$contents .= '<tr><td><table width="100%" style="font-size:14px;"><tr><td width="10%" valign="top">2.</td><td valign="top">सचिव, म.प्र. शासन, '.$file_department.' विभाग भोपाल की ओर उनके यू.ओ.क्र '.$file_uo_or_letter_no.'    दिनांक  '.$file_uo_or_letter_date.' के संदर्भ में उनकी नस्ती सहित सूचनार्थ एवं आवश्यक कार्यवाही हेतु अग्रेषित।</td></tr></table></td></tr>';
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right"><div  style="width:60%; text-align:center;">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td>&nbsp;</td></tr>';
}
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">(<b>';
if($is_genrate == true){
	$contents .= get_officer_information($this->input->post('add_secetroy')); 
} else {
	$contents .= '--------------';	
}
$contents .= '</b>)</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">';
if($is_genrate == true){
		$contents .= '<b>'.get_officer_dign($this->input->post('add_secetroy')).'</b>';
} else {
	$contents .= '------------';
} 
$contents .= '</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">'.$dept_name.'</div></td></tr>';
$contents .= '</table>';

