<?php 
$contents  = '' ;
$contents .= '<tr><td align="left"><div style="margin-top:20px;"><span style="margin-left:10%;">';
if($is_genrate == true){ 
    $contents .=  ' '.$post_data['subject'];
} else {
    $contents .= ' <textarea name="subject" style="margin: 0px; height: 40px; width: 80%;">'.$file_subject.'</textarea>';
}
$contents .= ' में पक्ष समर्थन हेतु|';
$contents .= '<tr><td>&nbsp;</td></tr>';
/*$contents .= '<tr><td align="left"><div style="margin-top:20px;"><span style="margin-left:10%;">रिट याचिका क्रमांक '.$case_no;
if($is_genrate == true){ 
    $contents .=  ' '.$post_data['agenst_name'];
} else {
    $contents .= ' <input type="text" class="" name="agenst_name" value="'.$agenst_name.'" />';
}
$contents .= ' विरुद्ध ';
if($is_genrate == true){ 
    $contents .=  $post_data['agenst'];
} else {
    $contents .= ' <input type="text" class="" name="agenst" value="'.$agenst.'" />';
}
$contents .= ' में पक्ष समर्थन हेतु|</td></tr>';*/
$contents .= '<tr><td align="center"> -------000------- </td></tr>';
$contents .= '<tr><td><div style="float:left">पं.क्र.  '.$file_number.'/21-(या0),  </div><div  style="float:right">दिनांक ';
if($is_genrate == true){
     $contents .= get_date_formate($post_data['date1'],'d/m/Y');
}
else
{
    $contents .='<input type="text" class="date1" name="date1" placeholder="dd/mm/yyyy" value="'.$file_mark_section_date.'" />';
}
$contents .= '<tr><td align="center"> '.$file_department.'  का  </td></tr>';

$contents .= '<tr><td align="center"><div style="float:left;">यू.ओ. क्रमांक :'.$file_uo_or_letter_no.'</div><div style="float:right;">दिनांक '.get_date_formate($file_uo_or_letter_date,'d/m/Y').'</div>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><p>कृपया प्रशासकीय विभाग की नस्ती पर अंकित टीप का अवलोकन करें। </p></td></tr>';
$contents .= '<tr><td><p>प्रशासकीय विभाग ने विषयांकित प्रकरण में अनावेदक म.प्र. शासन की ओर से प्रतिरक्षण आदेश जारी करने हेतु नस्ती विधि विभाग को प्रेषित की है।</p> </td></tr>';
$contents .= '<tr><td><p>अतः प्रशासकीय विभाग के प्रस्ताव अनुसार अनावेदक म.प्र. शासन की ओर से पक्ष समर्थन करने हेतु ';
if($is_genrate == true){
	$contents .= ' '.$post_data['advocate_type'];
	$contents .= ' '.$post_data['court_location'];
} else {
	
	$contents .= ' <select name="advocate_type" class="advocate_type">';
	foreach($advocate_type as $row){
		$contents .= '<option value="'.$row.'">'.$row.'</option>';
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
	$contents .= '</select>';
}
$contents .= ' को आवश्यक निर्देश प्रदान किया जाना प्रस्तावित है।</p></td></tr>';
$contents .= '<tr><td><p>आदेश की स्वच्छ प्रतियां एवं प्रशासकीय विभाग की नस्ती पर अंकित टीप हस्ताक्षरार्थ प्रस्तुत है।</p></td></tr>';
if($this->uri->segment(6) == 'p' || $this->uri->segment(7) == 'p'){
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>अनुभाग अधिकारी (याचिका)</u></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>अवर सचिव (याचिका)</u></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>अति. सचिव (याचिका)</u></td></tr>';
}
//echo $contents;
?>

