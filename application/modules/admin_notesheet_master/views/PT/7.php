<?php 
$contents  = '' ;
$contents .= '<tr><td align="center"><u><h3>'.$dept_name.'</h3></u>';
$contents .= '<tr><td><div style="float:left"> फा0क्र0 4(ए)/';
if($is_genrate == true){
	$contents .= $post_data['number'];
}else{
	$contents .=  '<input type="text" class="" name="number"  />';
}
$contents .= '/'.date("Y").'/'.$file_number.'/21-क(या0),  </div><div style="float:right">भोपाल, दिनांक  ';
if($is_genrate == true){
$contents .= get_date_formate($post_data['date1'],'d/m/Y').'</div></td></tr>';
}else
{
	$contents .=  '<input type="text" class="date1" name="date1" value="'.$today.'" placeholder="dd/mm/yyyy" />';
}
$contents .=  '</div></td></tr>';
$contents .=  '<tr><td>प्रति,</td></tr>';
if($is_genrate == true){
	$contents .= '<tr><td align="left"><span style="margin-left:8%">'.$post_data['advocate_type'].'</span>,</td></tr>';
	$contents .= '<tr><td align="left"><span style="margin-left:8%">'.$post_data['court_type'].'</span>,</td></tr>';
	$contents .= '<tr><td align="left"><span style="margin-left:8%">'.$post_data['court_location'].'</span>, (म. प्र.)</td></tr>';
} else {
	$contents .= '<tr><td align="left"><select name="advocate_type" class="advocate_type">';
	foreach($advocate_type as $row){
		$contents .= '<option value="'.$row.'">'.$row.'</option>';
	}
	$contents .= '</select></td></tr>';
	$contents .= '<tr><td align="left"><select name="court_type" class="court_type">';
	foreach($court_type as $row){
		$contents .= '<option value="'.$row.'">'.$row.'</option>';
	}
	$contents .= '</select></td></tr>';
	$contents .= '<tr><td align="left"><select name="court_location" class="court_location">';
	foreach($court_location as $row){
		$contents .= '<option value="'.$row.'">'.$row.'</option>';
	}
	$contents .= '</select>, (म. प्र.)';

}
$contents .=  '</td></tr>';
$contents .=  '<tr><td><div style="float:left;">विषय:- </div><div style="float:left; margin-left:4%"><span style=""> रिट याचिका क्र. '.$case_no;
$contents .= ' म. प्र. शासन में पारित निर्णय दिनांक '.get_date_formate($file_judgment_date , 'd/m/Y');
$contents .= ' के विरुद्ध ';
if($is_genrate == true){
	$contents .= ' '.$post_data['court_type'].'</span>';
	$contents .= ' '.$post_data['court_location'].'</span>';
} else {
	
	$contents .=  ' <select name="court_type" class="court_type">';
	foreach($court_type as $row){
		$contents .= '<option value="'.$row.'">'.$row.'</option>';
	}
	$contents .= '</select>';
	$contents .= ' <select name="court_location" class="court_location">';
	foreach($court_location as $row){
		$contents .= '<option value="'.$row.'">'.$row.'</option>';
	}
	$contents .= '</select>';

}
$contents .= ' में ';
if($is_genrate == true){
$contents .= ' '.$post_data['writappel'];
}else{
$contents .= ' <select name="writappel"><option>रिट  अपील</option><option>रिव्यू याचिका </option></select>';
}
$contents .= ' दायर करने की अनुमति बाबत| ';
$contents .= '<tr><td align="left"><P>राज्य शासन ने निर्णय लिया है  कि ';
if($is_genrate == true){
	$contents .= ' '.$post_data['court_type'];
	$contents .= ' '.$post_data['court_location'];
} else {
	$contents .= ' <select name="court_type" class="court_type">';
	foreach($court_type as $row){
		$contents .= '<option value="'.$row.'">'.$row.'</option>';
	}
	$contents .= '</select>';
	$contents .= ' <select name="court_location" class="court_location">';
	foreach($court_location as $row){
		$contents .= '<option value="'.$row.'">'.$row.'</option>';
	}
	$contents .= '</select>';
}
$contents .=  ' के आदेश दिनांक ';
if($is_genrate == true){
	$contents .= $post_data['date2'];
}else{
	$contents .=  '<input type="text" class="date1" name="date2" value="'.get_date_formate($file_judgment_date , 'd/m/Y').'" placeholder="dd/mm/yyyy" />';
}
$contents .=  ' के विरूद्ध  ';
if($is_genrate == true){
	$contents .= ' '.$post_data['court_type'];
	$contents .= ' '.$post_data['court_location'];
} else {
	$contents .= ' <select name="court_type" class="court_type">';
	foreach($court_type as $row){
		$contents .= '<option value="'.$row.'">'.$row.'</option>';
	}
	$contents .= '</select>';
	$contents .= ' <select name="court_location" class="court_location">';
	foreach($court_location as $row){
		$contents .= '<option value="'.$row.'">'.$row.'</option>';
	}
	$contents .= '</select>';
}
if($is_genrate == true){
$contents .= ' '.$post_data['writappel1'];
}else{
$contents .= ' <select name="writappel1"><option>रिट  अपील</option><option>रिव्यू याचिका </option></select>';
}
$contents .= ' प्रस्तुत की जाए।<p></td></tr>';
$contents .= '<tr><td><p>प्रशासकीय विभाग द्वारा ';
if($is_genrate == true){
$contents .= $post_data['writappel2'];
}else{
$contents .= ' <select name="writappel2"><option>रिट  अपील</option><option>रिव्यू याचिका </option></select>';
}
$contents .= ' का प्रस्ताव ';
if($is_genrate == true){
$contents .= ' '.$post_data['day1'] ;
}else{
$contents .= ' <input type="text" name="day1">' ;
}
if($is_genrate == true){
$contents .= ' '.$post_data['year'];
}else{
$contents .= ' <select name="year"><option>वर्ष</option><option>माह  </option></select>';
}
if($is_genrate == true){
$contents .= ' '.$post_data['day2'];
}else{
$contents .= ' <input type="text" name="day2" value="'.$days_delay.'">' ;
}
$contents .= ' दिवस विलंब से प्रस्तुत किया गया है।<p></td></tr>';

if($is_genrate == true){
	$contents .= '<tr><td><p>अतः '. $post_data['writappel2'] .' प्रस्तुत करे।';
}else{
$contents .= '<tr><td><p>अतः <select name="writappel2"><option>रिट  अपील</option><option>रिव्यू याचिका </option></select> प्रस्तुत करे। <p></td></tr>';
}
$contents .= '<tr><td align="right">मध्यप्रदेश के राज्यपाल के नाम से तथा आदेशानुसार,</td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">('.$us_name.')</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">अवर सचिव</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">'.$dept_name.'</div></td></tr>';
$contents .= '<tr><td><div style="float:left"> फा0क्र0 4(ए)/';
if($is_genrate == true){
	$contents .= $post_data['number'];
}else{
	$contents .=  '<input type="text" class="" name="number"  />';
}
$contents .= '/'.date("Y").'/'.$file_number.'/21-क(या0),  </div><div style="float:right">भोपाल, दिनांक  ';
if($is_genrate == true){
$contents .= ' '.get_date_formate($post_data['date1'],'d/m/Y').'</div></td></tr>';
}else
{
	$contents .=  ' <input type="text" class="date1" name="date1" value="'.$today.'" placeholder="dd/mm/yyyy" />';
}
$contents .=  '</div></td></tr>';
$contents .=  '<tr><td> प्रतिलिपि:- </td></tr>';
$contents .=  '<tr><td><p> सचिव, म0प्र0 शासन,‍ ';
$contents .=  ' '.$file_department;
$contents .=  ', मंत्रालय भोपाल की ओर उनके यू0ओ0क्र0 '.$file_uo_or_letter_no.', दिनांक  ';
$contents .=  ' '.get_date_formate($file_uo_or_letter_date,'d/m/Y');
if($is_genrate == true){
	$contents .= ' '.$post_data['advocate_type'];
	$contents .= ' '.$post_data['court_type'];
	$contents .= ' '.$post_data['court_location'];
} else {
	$contents .= ' <select name="advocate_type" class="advocate_type">';
	foreach($advocate_type as $row){
		$contents .= '<option value="'.$row.'">'.$row.'</option>';
	}
	$contents .= '</select>';
	$contents .= ' <select name="court_type" class="court_type">';
	foreach($court_type as $row){
		$contents .= '<option value="'.$row.'">'.$row.'</option>';
	}
	$contents .= '</select>';
	$contents .= ' <select name="court_location" class="court_location">';
	foreach($court_location as $row){
		$contents .= '<option value="'.$row.'">'.$row.'</option>';
	}
	$contents .= '</select>';
}

if($is_genrate == true){
$contents .= ' '.$post_data['writappel2'];
}else{
$contents .= ' <select name="writappel2"><option>रिट  अपील</option><option>रिव्यू याचिका </option></select>';
}
$contents .= ' प्रस्तुत करने की कार्यवाही करें। साथ ही देरी के तथ्य को स्पष्ट करने का उत्तरदायित्व प्रशासकीय विभाग का होगा।';
$contents .=  '</p></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">('.$us_name.')</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">अवर सचिव</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">'.$dept_name.'</div></td></tr>';
?>
