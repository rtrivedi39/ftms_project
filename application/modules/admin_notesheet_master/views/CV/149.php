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

if($is_genrate == true){
	$contents .= '<tr><td align="left"><span style="margin-left:8%">'.$post_data['advocate_type'].'</span>,</td></tr>';
	$contents .= '<tr><td align="left"><span style="margin-left:8%">'.$post_data['district'].$post_data['court_type'].'</span>,</td></tr>';
	$contents .= '<tr><td align="left"><span style="margin-left:8%">'.$post_data['court_location'].'</span></td></tr>';
} else {
	$contents .= '<tr><td align="left"><select name="advocate_type" class="advocate_type">';
	foreach($advocate_type as $row){
		$contents .= '<option value="'.$row.'">'.$row.'</option>';
	}
	$contents .= '</select></td></tr>';
	$contents .= '<tr><td align="left">'.get_distic_dd('district').'<select name="court_type" class="court_type">';
	foreach($court_type as $row){
		$contents .= '<option value="'.$row.'">'.$row.'</option>';
	}
	$contents .= '</select></td></tr>';
	$contents .= '<tr><td align="left"><select name="court_location" class="court_location">';
	foreach($court_location as $row){
		$contents .= '<option value="'.$row.'">'.$row.'</option>';
	}
	$contents .= '</select></td></tr>';
}
$contents .= '<tr><td align="left">विषय:-<span style="margin-left:4%">';
if($is_genrate == true){ 
    $contents .=  $post_data['subject'];
} else {
    $contents .= '<textarea name="subject" rows="2" columns="100">'.$file_subject.'</textarea>';
}
$contents .= ' के विरुद्ध मध्यप्रदेश शासन एवं अन्य  | ';


$contents .= '</td></tr>';
$contents .= '<tr><td align="center">------000-------</td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td align="left"><p>उपरोक्त विषयांकित संदर्भित पत्र के संबंध में है कि विधि विभाग नियमावली के नियमानुसार प्रशासकीय विभाग से प्रस्ताव प्राप्त होने पर कार्यवाही की जाती है</p> </td></tr>';
$contents .= '<tr><td align="left"><p>अतः प्राप्त पत्र मूलतः वापस करते हुए लेख किया जाता है कि प्रस्ताव प्रशासकीय विभाग ('.$file_department.' )  के माध्यम से इस विभाग को भिजवाये |</p> </td></tr>';

$contents .= '<tr><td>संलग्न :- उपरोक्तानुसार</td></tr>';
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
$contents .= '<tr><td><tr><td><u>प्रतिलिपि:</u></td></tr>';
$contents .= '<tr><td align="left"><div style="float:left;">पृ. क्रमांक ';
if($is_genrate == true){ 
    $contents .=  $post_data['number'];
} else {
    $contents .= '-------';
}
$contents .= '/'.date("Y").'/'.$file_number.'/21-क(सि.)</div><div style="float:right;">भोपाल, दिनांक ';
if($is_genrate == true){ 
    $contents .=  get_date_formate($post_data['date4'],'d/m/Y');
} else {
    $contents .= '<input type="text" class="date1" name="date4" placeholder="dd/mm/yyyy" value="'.$today.'"/></div>';
}
$contents .=  '</td></tr>';
$contents .= '<tr><td><p>1- सचिव, म.प्र. शासन, '.$file_department.', भोपाल की ओर सूचनार्थ प्रेषित |';
 $contents .= ' प्रस्तुत कराना सुनिश्चित करे,  तथा की गई कार्यवाही की सूचना इस विभाग को भेजे |   ';
$contents .= '.</p></td></tr>';
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
$contents .= ')</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">अवर सचिव</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">'.$dept_name.'</div></td></tr>';
$contents .= '<tr><td></td></tr>';
?>

