<style>
p{
	line-height:24px;
}
</style>
<?php 
$contents  = '<table style="font-size:14px;  width:90%; margin:0% auto;">' ;

$contents .= '<tr><td align="center"> <u><h4>'.$dept_name.' </u></h4></td></tr>';
$contents .= '<tr><td><div style="float:left"> फा.क्र 3(सि.)/';
if($is_genrate == true){
	 $contents .= $post_data['head_val_1'];
}
else{
	 $contents .= '<input name="head_val_1" placeholder="file no" type="text" />' ;
}

$contents .= '/'.date("y").'/'.$panji_krmank.'/21-क(सि), </div><div style="float:right;">';
$contents .= 'भोपाल, दिनांक '.date("d-m-Y").'</div></td></tr>';

$contents .= '<tr><td align="left"> प्रति  </td></tr>';
$contents .= '<tr><td align="left"> <div style="margin-left:45px;">';
if($is_genrate == true){
	 $contents .= $post_data['court'];
}
else{
	 $contents .= '<select name="court" ><option>महाधिवक्ता</option><option>अति  महाधिवक्ता</option></select>' ;
}
$contents .=',</div></td></tr>';

$contents .= '<tr><td align="left"><div style="margin-left:45px;">माननीय  उच्च न्यायालय,</div></td></tr>';
$contents .= '<tr><td align="left"> <div style="margin-left:45px;">';
if($is_genrate == true){
	 $contents .= $post_data['highcourt'];
}
else{
	 $contents .= '<select name="highcourt" ><option>जबलपुर</option><option>खंडपीड इन्दौर</option><option>खंडपीड ग्वालियर</option></select>' ;
}
$contents .=',</div></td></tr>';
$contents .= '<tr><td align="left"><div style="float:left; width:45px;"> विषय:- </div><p style="text-indent: 5px;"> '.$file_subject.'</p></td></tr>';
$contents .= '<tr><td align="center"> -------- </td></tr>';
$contents .= '<tr><td><p>उपरोक्त विषयक प्रकरण में शासन की ओर से माननीय उच्च न्यायालय ';
if($is_genrate == true){
	// $contents .= $post_data['court'].', ';
	 $contents .= ' '.$post_data['highcourt']; 
}
else{
	 $contents .= '---------' ;
}
$contents .= ' के समक्ष पक्ष-समर्थन करनें का कष्ट करें |</p></td></tr>';
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right"><div  style="width:60%; text-align:center;">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td>&nbsp;</td></tr>';
}
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">(<b>';
if($is_genrate == true){	 
	$contents .= get_officer_information($this->input->post('sing_user')); 
}else{
	$contents .= get_officer_for_sign('sing_user' ,array(2,3,4,5,7) ,'', $us_id);
}
$contents .= '</b>)</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">';
if($is_genrate == true){
	$contents .=   get_officer_dign($this->input->post('sing_user'));
}else{
	$contents .= '-------';
}
$contents .= '</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">'.$dept_name.'</div></td></tr>';
$contents .= '<tr><td><div style="float:left"> पृ. फा. क्र. 3(सि.)/';
if($is_genrate == true){
	 $contents .= $post_data['head_val_1'];
}
else{
	 $contents .= '--------------' ;
}

$contents .= '/'.date("y").'/'.$panji_krmank.'/21-क (सि.), </div><div style="float:right;">';
$contents .= 'भोपाल, दिनांक '.date("d-m-Y").'</div></td></tr>';
$contents .= '<tr><td align="">प्रतिलिपि :-</td></tr>';
$contents .= '<tr><td><table style="font-size:14px;"><tr><td width="10%" valign="top">1.</td><td width="*%" valign="top">सचिव, म.प्र. शासन, '.$file_department.' विभाग भोपाल की ओर उनके यू.ओ.क्र '.$file_uo_or_letter_no.'    दिनांक  '.$file_uo_or_letter_date.' के सन्दर्भ में उनकी नस्ती सहित अग्रेषित | </td></tr>';
$contents .= '<td width="10%" valign="top">2.</td><td width="*%" valign="top">कलेक्टर ';
if($is_genrate == true){
	$contents .= $post_data['distic_1'];
}else
{
$contents  .= get_distic_dd('distic_1');	
}
$contents .= ' की ओर सूचनार्थ एवं आवश्यक कार्यवाही हेतु  अग्रेषित |</td></table> </td></tr>';
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right"><div  style="width:60%; text-align:center;">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td>&nbsp;</td></tr>';
}
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">(<b>';
if($is_genrate == true){
	$contents .=  get_officer_information($this->input->post('sing_user')); 
}else{
	$contents .= '-------';	
}
$contents .= '</b>)</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">';
if($is_genrate == true){	
    $contents .=   get_officer_dign($this->input->post('sing_user'));
}else{
	$contents .= '-------';
}  
$contents .= '</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">'.$dept_name.'</div></td></tr>';
$contents .= '</table>';

