<?php 
$contents  = '' ;
$contents .= '<tr><td align="center"><u><h3>'.$dept_name.'</h3></u></td></tr>';
$contents .= '<tr><td><div style="float:left">क्रमांक  '.$file_number.'/'.date("Y").'/21-क(या0),  </div><div style="float:right">भोपाल, दिनांक  ';
if($is_genrate == true){
$contents .= get_date_formate($post_data['date1'],'d/m/Y').'</div></td></tr>';
}else
{
	$contents .=  '<input type="text" class="date1" name="date1" value="'.$today.'" placeholder="dd/mm/yyyy" />';
}
$contents .=  '</div></td></tr>';
$contents .= '<tr><td>प्रति,</td></tr>';
$contents .= '<tr><td align="left"><span style="margin-left:8%">सचिव</td></tr>';
$contents .= '<tr><td align="left"><span style="margin-left:8%">मध्यप्रदेश शासन</td></tr>';
if($is_genrate == true){
	$contents .= '<tr><td align="left"><span style="margin-left:8%">'.$post_data['department'].'</span>,</td></tr>';
} else {
	$contents .= '<tr><td align="left"><select name="department" class="department">';
	$department =  get_list(DEPARTMENTS, 'dept_name_hi', null);
	foreach($department as $key => $value){
		$contents .= '<option value="'.$value['dept_name_hi'].'">'.$value['dept_name_hi'].'</option>';
	}
	$contents .= '</select>';	
}
$contents .= ', भोपाल</td></tr>';
$contents .=  '<tr><td>विषय:- <span style="margin-left:4%">';
if($is_genrate == true){ 
    $contents .=  ' '.$post_data['subject'];
} else {
    $contents .= ' <textarea name="subject" style="margin: 0px; height: 40px; width: 80%;">'.$file_subject.'</textarea>';
}
$contents .= '<tr><td align="center">----</td></tr>';
$contents .= '<tr><td><p>उपरोक्त विषयक प्रकरण में ';
if($is_genrate == true){
	$contents .= ' '.$post_data['ad_name'].'</span>,';	
} else {
	$contents .= ' <select name="ad_name" class="ad_name">';
	$contents .= '<option value="अधिवक्ता">अधिवक्ता</option>';
	$contents .= '<option value="महाधिवक्ता">महाधिवक्ता </option>';
	$contents .= '<option value="उप महाधिवक्ता">उप महाधिवक्ता </option>';
	$contents .= '<option value="शासकीय अधिवक्ता">शासकीय अधिवक्ता</option>';
	$contents .= '</select> ';
}
if($is_genrate == true){
	$contents .= ' '.$post_data['location'];	
} else {
	$contents .= ' <select name="location" class="location">';	
	foreach($court_location as $key){
		$contents .= '<option value="'.$key.'">'.$key.'</option>';
	}
	$contents .= '</select>';	
}
$contents .= ' की ओर से प्राप्त पत्र '.$file_uo_or_letter_n.' एवं आदेश की मूलतः प्रति आवश्यक कार्यवाही किये जाने हेतु संलग्न है|</p></td></tr>';
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
}
else {
	 $contents .= '-------';
	}
	
$contents .= '</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">'.$dept_name.'</div></td></tr>';
?>


