<?php 
$contents  = '' ;
$contents .= '<tr><td align="center"><u><h3>'.$dept_name.'</h3></u></td></tr>';
$contents .= '<tr><td align="left"><div style="float:left;">क्रमांक ';
if($is_genrate == true){ 
    $contents .=  $post_data['number'];
} else {
    $contents .= '<input type="text" class="" name="number"  value=""/>';
}
$contents .= '/'.date("Y").'/'.$file_number.'/21-क(सि.)</div><div style="float:right;">भोपाल, दिनांक ';
if($is_genrate == true){ 
    $contents .=  get_date_formate($post_data['date4'],'d/m/Y');
} else {
    $contents .= '<input type="text" class="date1" name="date4" placeholder="dd/mm/yyyy" value="'.$today.'"/></div>';
}
$contents .=  '</td></tr>';
$contents .= '<tr><td align="left">प्रति, </td></tr>';
$contents .= '<tr><td align="left"><span style="margin-left:8%">';
 if($is_genrate == true){
	$contents .= ' <b>'.$post_data['type_name'].'</b>';
} else {	
	$contents .= ' <select name="type_name" class="type_name">';
	$contents .= '<option value=""></option>';
	$contents .= '<option value="कार्यालय कलेक्टर">कार्यालय कलेक्टर</option>';
	$contents .= '<option value="महाधिवक्ता">महाधिवक्ता</option>';
	$contents .= '<option value="शासकीय अधिवक्ता">शासकीय अधिवक्ता</option>';
	$contents .= '</select>';
}
$contents .= '</span>,</td></tr>';
$contents .= '<tr><td align="left"><span style="margin-left:8%">जिला ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['district'].'</b>';
} else {	
	$contents .= get_distic_dd('district' );
}
$contents .= '</span>,</td></tr>';
$contents .= '<tr><td align="left">विषय:-<span style="margin-left:4%">';
if($is_genrate == true){ 
    $contents .=  $post_data['subject'];
} else {
    $contents .= '<textarea name="subject" rows="2" columns="100">'.$file_subject.'</textarea>';
}
$contents .= ' के विरुद्ध मध्यप्रदेश शासन एवं अन्य  | ';
$contents .= '</td></tr>';
$contents .= '<tr><td align="left">संदर्भ:-<span style="margin-left:4%"> आपका पत्र दिनांक';
if($is_genrate == true){ 
    $contents .=  $post_data['date_san'];
} else {
    $contents .= '<input type="text" name="date_san" class="date1" >';
}
$contents .= '</td></tr>';
$contents .= '<tr><td align="center">------000-------</td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td align="left"><p>उपरोक्त विषयांकित एवं संदर्भित पत्र के सम्बन्ध में लेख है  कि   1999 में  जिला सरकार बनी थी उसमे कलेक्टर को पदेन  उप सचिव के अधिकार प्रत्योजित  किये गये थे,  चूंकि अब जिला सरकार नही है, अत:  विधि विभाग नियमावली  के तहत प्रशासकीय ('.$file_department.')  विभाग के माध्यम से प्रस्ताव प्राप्त होने पर कार्यवाही की जाना सम्भव हो सकेगा | </p> </td></tr>';
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right"><div  style="width:60%; text-align:center;">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td>&nbsp;</td></tr>';
}
$contents .= '<tr><td align="right" style="line-height:15px;"><div style="width:60%; text-align:center;">(';

if($is_genrate == true){
	$contents .=  get_officer_information($this->input->post('avar_secetroy')); 
}else{
	 $contents .= get_officer_for_sign('avar_secetroy' ,array(2,3,4,5,7,11) ,'', $us_id);
}
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">'.$dept_name.'</div></td></tr>';
$contents .= '<tr><td></td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">'.$dept_name.'</div></td></tr>';
$contents .= '<tr><td><div style="float:left">पृ. क्रमांक  '.$file_number.'/'.date("Y").'/21-क(सि.)</div><div style="float:right">भोपाल, दिनांक  ';
if($is_genrate == true){
	$contents .= get_date_formate($post_data['date4'],'d/m/Y').'</div></td></tr>';
}else{
	$contents .=  '-----------';
}
$contents .= '<tr><td>प्रतिलिपि:-</td></tr>';
$contents .=  '<tr><td><p>1-  सचिव, म0प्र0 शासन,‍ ';
$contents .=  ' '.$file_department;
$contents .=  '  , भोपाल की ओर सूचनार्थ आवश्यक कार्यवाही हेतु अग्रेषित  प्रेषित |  ';

if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right"><div  style="width:50%; text-align:center;">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td>&nbsp;</td></tr>';
}
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;" contenteditable="false">(';
if($is_genrate == true){
	$contents .=  get_officer_information($this->input->post('avar_secetroy')); 
}else{
	$contents .= '-------';
}
$contents .= ')</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;" contenteditable="false">';
if($is_genrate == true){	
    $contents .=   get_officer_dign($this->input->post('avar_secetroy'));
}
else{
	$contents .= '-------';
}
$contents .= '</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">'.$dept_name.'</div></td></tr>';


?>

