<?php 
$contents  = '' ;
$contents .= '<tr><td align="left"><div style="margin-top:20px;"><span style="margin-left:10%;"><u><b>';
if($is_genrate == true){
	$contents .= ' '.$post_data['court_type'].'</span>';
	$contents .= ' '.$post_data['court_location'].'</span>';
} else {
		$contents .= ' <select name="court_type" class="court_type">';
	foreach($court_type as $row){
		if(($emp_allot_seet == 1 && $row == 'मान0  उच्च न्यायालय' ) || ($emp_allot_seet == 2 && $row == 'मान0 उच्च न्यायालय खण्डपीठ' ) || ($emp_allot_seet == 3 && $row == 'मान0 उच्च न्यायालय खण्डपीठ' )  )
		{
			$contents .= '<option value="'.$row.'" selected>'.$row.'</option>';
		}else{
			$contents .= '<option value="'.$row.'">'.$row.'</option>';
		}
	}
	$contents .= '</select>';
	$contents .= ' <select name="court_location" class="court_location">';
	foreach($court_location as $row){
		if(($emp_allot_seet == 1 && $row == 'जबलपुर, मध्यप्रदेश' ) || ($emp_allot_seet == 2 && $row == 'ग्वालियर, मध्यप्रदेश' ) || ($emp_allot_seet == 3 && $row == 'इंदौर, मध्यप्रदेश' )  ){
			$contents .= '<option value="'.$row.'" selected>'.$row.'</option>';
		}
		else{
			$contents .= '<option value="'.$row.'">'.$row.'</option>';
		}
	}
	$contents .= '</select>,';
}
$contents .= ' की ';
if($is_genrate == true){
	$contents .= ' '.$post_data['writ_lists_for'].'</span>';
	
} else {
		$contents .= ' <select name="writ_lists_for" class="">';
	foreach($writ_lists as $row){
		$contents .= '<option value="'.$row.'">'.$row.'</option>';
	}
	$contents .= '</select>';
}
$contents .= ' क्रमांक  ';
/*
if($is_genrate == true){
$contents .= ' '.$post_data['writ_apeel_no'];
}else{
$contents .= ' <input type="text" name="writ_apeel_no" value ="'.$case_no.'">';
}
$contents .= '  में पारित आदेश दिनांक ';
if($is_genrate == true){
$contents .= ' '.$post_data['date1'];
}else{
$contents .= ' <input type="text" class="date1" name="date1" placeholder="dd/mm/yyyy"  value="'.get_date_formate($file_judgment_date,'d/m/Y').'" />';
}
$contents .= '  के विरूद्ध  ';
if($is_genrate == true){
$contents .= ' '.$post_data['ageinst'];
}else{
$contents .= ' <input type="text" name="ageinst" value="'.$agenst_name.'">';
}
if($is_genrate == true){
	$contents .= ' '.$post_data['writ_lists1'].'</span>';
	
} else {
		$contents .= ' <select name="writ_lists1" class="writ_lists">';
	foreach($writ_lists as $row){
		$contents .= '<option value="'.$row.'">'.$row.'</option>';
	}
	$contents .= '</select>';
} */
if($is_genrate == true){ 
    $contents .=  ' '.$post_data['subject'];
} else {
    $contents .= ' <textarea name="subject">'.$file_subject.'</textarea>';
}
$contents .= ' में ';
if($is_genrate == true){
	$contents .= ' <b>'.$post_data['writ_lists'].'</b></span>';
} else {
	$contents .= ' <select name="writ_lists" class="writ_lists">';
	foreach($writ_lists as $row){
		$contents .= '<option value="'.$row.'">'.$row.'</option>';
	}
	$contents .= '</select>';
}
$contents .= ' हेतु ';
$contents .= '</b></u></span></div></td></tr>';

$contents .= '<tr><td><div style="float:left">फा0क्र0  '.$file_number.'/'.date("Y").'/21-क(या0),  </div><div style="float:right">दिनांक'; 
if($is_genrate == true){
$contents .= ' '.get_date_formate($post_data['date2'],'d/m/Y');
}else{
$contents .= ' <input type="text" class="date1" name="date2" placeholder="dd/mm/yyyy"  value="'.$file_mark_section_date.'" />';
}
$contents .= '</div></td></tr>';
$contents .= '<tr><td align="center">  '.$file_department.'  का </td></tr>';
$contents .= '<tr><td><div style="float:left"> यू0ओ0 क्र0              '.$file_uo_or_letter_no.'</div> <div style="float:right">';
if($is_genrate == true){
$contents .= ' '.$post_data['date4'];
}else{
$contents .= ' <input type="text" class="date1" name="date4" placeholder="dd/mm/yyyy"  value="'.get_date_formate($file_uo_or_letter_date,'d/m/Y').'" />';
}
$contents .='</div></td></tr>';
$contents .= '<tr><td align="center">  ---- </td></tr>';
$contents .='<tr><td><p>कृपया प्रशासकीय विभाग की टीप दिनांक ';
if($is_genrate == true){
$contents .= ' '.$post_data['date5'];
}else{
$contents .= ' <input type="text" class="date1" name="date5" placeholder="dd/mm/yyyy"  value="'.get_date_formate($file_uo_or_letter_date,'d/m/Y').'" />';
}   
$contents .= ' का अवलोकन कीजिए| </p></td></tr>';

$contents .='<tr><td><p>प्रशासकीय विभाग ने विषयांकित प्रकरण में  ';
if($is_genrate == true){
	$contents .= ' '.$post_data['court_type'].', ';
	$contents .= ' '.$post_data['court_location'];
} else {
	$contents .= ' ----------, ';
	$contents .= ' ----------';
}

$contents .=' द्वारा पारित आदेश दिनांक  ';
if($is_genrate == true){
$contents .= ' '.get_date_formate($post_data['date6'],'d/m/Y');
}else{
$contents .= ' <input type="text" class="date1" name="date6" placeholder="dd/mm/yyyy"  value="'.$file_judgment_date1.'" />';
} 
$contents .= ' के विरूद्ध  ';
if($is_genrate == true){
	$contents .= ' '.$post_data['court_type1'];
	$contents .= ' '.$post_data['court_location1'];
} else {
	$contents .= ' <select name="court_type1" class="court_type">';
	foreach($court_type as $row){
		if(($emp_allot_seet == 1 && $row == 'मान0  उच्च न्यायालय' ) || ($emp_allot_seet == 2 && $row == 'मान0 उच्च न्यायालय खण्डपीठ' ) || ($emp_allot_seet == 3 && $row == 'मान0 उच्च न्यायालय खण्डपीठ' )  )
		{
			$contents .= '<option value="'.$row.'" selected>'.$row.'</option>';
		}else{
			$contents .= '<option value="'.$row.'">'.$row.'</option>';
		}
	}
	$contents .= '</select>';
	$contents .= ' <select name="court_location1" class="court_location">';
	foreach($court_location as $row){
		if(($emp_allot_seet == 1 && $row == 'जबलपुर, मध्यप्रदेश' ) || ($emp_allot_seet == 2 && $row == 'ग्वालियर, मध्यप्रदेश' ) || ($emp_allot_seet == 3 && $row == 'इंदौर, मध्यप्रदेश' )  ){
			$contents .= '<option value="'.$row.'" selected>'.$row.'</option>';
		}
		else{
			$contents .= '<option value="'.$row.'">'.$row.'</option>';
		}
	}
	$contents .= '</select>';
}
$contents .= ' के समक्ष ';
if($is_genrate == true){
	$contents .= ' <b>'.$post_data['writ_lists'].'</b></span>';
	
} else {
		$contents .= '------';
}
$contents .= ' की अनुमति हेतु नस्ती प्रेषित की है।</p></td></tr>';
$contents .= '<tr><td><p>नस्ती में संलग्न दस्तावेज निम्नानुसार हैः-</p></td></tr>';
$contents .= '<tr><td>';
$contents .= '<table width="100%" class="gridtable" cellpedding="0" style="font-size:13px;">
<tr><td width="5%">क्र0</td><td width="50%">दस्तावेज का विवरण</td>
<td width="15%"></td><td width="30%">पेज संख्या</td></tr><tr>
<td>1</td><td>';
if($is_genrate == true){ 
    $contents .=  $post_data['option_for'];
} else {
	$contents .= ' <select name="option_for" class="">';
	$contents .= '<option value="निर्णय">निर्णय</option>';
	$contents .= '<option value="आदेश">आदेश</option>';	
	$contents .= '</select>';
}
$contents .= ' की प्रति</td><td>';
if($is_genrate == true){ 
    $contents .=  $post_data['yesno7'];
} else {
	$contents .= ' <select name="yesno7" class="">';
	$contents .= '<option value="हाँ">हाँ</option>';
	$contents .= '<option value="नहीं">नहीं</option>';
	$contents .= '</select>';
}
$contents .= '</td><td></td></tr><tr><td>2</td><td>निर्णय के विरूद्ध ';
if($is_genrate == true){
	$contents .= ' <b>'.$post_data['writ_lists'].'</b></span>';
	
} else {
		$contents .= ' -------- ';
	
}
$contents .= ' के संबध में  शासकीय अधिवक्ता का विधिक आधारों सहित अभिमत</td><td>';
if($is_genrate == true){ 
    $contents .=  $post_data['yesno8'];
} else {
	$contents .= ' <select name="yesno8" class="">';
	$contents .= '<option value="हाँ">हाँ</option>';
	$contents .= '<option value="नहीं">नहीं</option>';
	$contents .= '</select>';
}
$contents .= '</td><td></td></tr>';
$contents .= '<tr><td>3</td><td>प्रकरण की संक्षेपिका</td><td>';
if($is_genrate == true){ 
    $contents .=  $post_data['yesno1'];
} else {
	$contents .= ' <select name="yesno1" class="">';
	$contents .= '<option value="हाँ">हाँ</option>';
	$contents .= '<option value="नहीं">नहीं</option>';
	$contents .= '</select>';
}
$contents .= '</td><td></td></tr>';
$contents .= '<tr><td>4</td><td>विभागीय नस्ती में  ';
if($is_genrate == true){
	$contents .= ' <b>'.$post_data['writ_lists'].'</b></span>';
	
} else {
		$contents .= ' -------- ';
	
}
$contents .= ' के आधारों का उल्लेख</td><td>';
if($is_genrate == true){ 
    $contents .=  $post_data['yesno5'];
} else {
	$contents .= ' <select name="yesno5" class="">';
	$contents .= '<option value="हाँ">हाँ</option>';
	$contents .= '<option value="नहीं">नहीं</option>';
	$contents .= '</select>';
}
$contents .= '</td><td></td></tr>
<tr><td>5</td><td>उक्त याचिका की पठनीय प्रति</td><td>';
if($is_genrate == true){ 
    $contents .=  $post_data['yesno6'];
} else {
	$contents .= ' <select name="yesno6" class="">';
	$contents .= '<option value="हाँ">हाँ</option>';
	$contents .= '<option value="नहीं">नहीं</option>';
	$contents .= '</select>';
}
$contents .= '</td><td></td></tr>';
$contents .= '<tr><td>6</td><td>जवाबदावे की प्रति</td><td>';
if($is_genrate == true){ 
    $contents .=  $post_data['yesno3'];
} else {
	$contents .= ' <select name="yesno3" class="">';
	$contents .= '<option value="हाँ">हाँ</option>';
	$contents .= '<option value="नहीं">नहीं</option>';
	$contents .= '</select>';
}
$contents .= '</td><td></td></tr>';
$contents .= '<tr><td>7</td><td>प्रशासकीय विभाग द्वारा प्रभारी अधिकारी की नियुक्ति</td><td>';
if($is_genrate == true){ 
    $contents .=  $post_data['yesno4'];
} else {
	$contents .= ' <select name="yesno4" class="">';
	$contents .= '<option value="हाँ">हाँ</option>';
	$contents .= '<option value="नहीं">नहीं</option>';
	$contents .= '</select>';
}
$contents .= '</td><td></td></tr>
<tr><td>8</td><td>अपील प्रस्ताव नियत परिसीमा अवधि में प्रस्तुत है प्रकरण में अवधि दिनांक ';
$avadhi  = date('d/m/Y',strtotime($file_judgment_date1.' +90 days'));
$avadhi_date =  date('Y-m-d',strtotime($file_judgment_date1.' +90 days'));
$file_mark_section_date_diff =  date('Y-m-d',strtotime($file_mark_section_date));
$days_delay = day_difference_dates($avadhi_date, $file_mark_section_date_diff);
if($is_genrate == true){
	$contents .=  ' <b>'.$post_data['date7'].'</b>';
}else{	
	$contents .= ' <input type="text" class="date1" name="date7" placeholder="dd/mm/yyyy" value="'.$avadhi.'"/>';
}
$contents .= ' तक नियत ';
if($is_genrate == true){ 
    $contents .=  $post_data['haithi'];
} else {
	$contents .= ' <select name="haithi" class="">';
	$contents .= '<option value="है">है</option>';
	$contents .= '<option value="थी">थी</option>';
	$contents .= '</select>';
}
$contents .= '|<br/>कुल ';
if($is_genrate == true){
$contents .= ' <b>'.$post_data['day1'].'</b>';
}else{
$contents .= '<input type="text" name="day1" value="'.$days_delay.'">'; 
}
$contents .= ' दिवस ';
/*if($is_genrate == true){
$contents .= $post_data['day2'];
}else{
$contents .= ' <input type="text" name="day2" value="'.$days_delay.'">'; 
}*/

$contents .= ' विलम्ब</td><td>';
if($is_genrate == true){ 
    $contents .=  $post_data['yesno9'];
} else {
	$contents .= ' <select name="yesno9" class="">';
	$contents .= '<option value="हाँ">हाँ</option>';
	$contents .= '<option value="नहीं">नहीं</option>';
	$contents .= '</select>';
}
$contents .= '</td><td>';
/*$contents .= ' नही तो कितने दिन विलंब से अपील प्रस्ताव किया गया है। दिन संख्या- ';
if($is_genrate == true){
	$contents .= ' '.$post_data['total_day'];
}else{
	$contents .= ' <input type="text" name="total_day" value="'.$days_delay.'">'; 
}*/
$contents .= '</td></tr></table></td></tr>';
$contents .= '<tr><td><p>प्रकरण  ';
if($is_genrate == true){
	$contents .= ' <b>'.$post_data['writ_lists'].'</b></span>';
	
} else {
		$contents .= '---------';
}
$contents .= '। की अनुमति हेतु परीक्षण / आदेशार्थ प्रस्तुत है | </p></td></tr>';
if($this->uri->segment(6) == 'p' || $this->uri->segment(7) == 'p'  ){
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>अनुभाग अधिकारी (याचिका)</u></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>अवर सचिव (याचिका)</u></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>अति. सचिव (याचिका)</u></td></tr>';
}
?>

