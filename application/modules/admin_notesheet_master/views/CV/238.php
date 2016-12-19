<style>
p{
	line-height:24px;
}
</style>
<?php 
$contents  = '<table style="font-size:14px;  width:100%; margin:0% auto;">' ;
$contents .= '<tr><td align="left"><div style="margin-top:20px;"><span style="margin-left:10%;">';
if($is_genrate == true){ 
    $contents .=  ' '.$post_data['subject'];
} else {
    $contents .= ' <textarea name="subject" style="margin: 0px; height: 40px; width: 80%;">'.$file_subject.'</textarea>';
}
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><div style="float:left">पंजी क्रमांक  '.$file_number.'/21-क(सि.),  </div><div style="float:right">भोपाल, दिनांक  ';
if($is_genrate == true){
$contents .= get_date_formate($post_data['date'],'d/m/Y').'</div></td></tr>';
}else
{
    $contents .=  '<input type="text" class="date1" name="date" value="'.$file_mark_section_date.'" placeholder="dd/mm/yyyy" required>';
}
$contents .=  '</div></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td align="center"> -------000------- </td></tr>';
$contents .= '<tr><td><p>कृपया ';
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
$contents .= ' जिला  ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['district'].'</b>';
} else {	
	$contents .= get_distic_dd('district' );
}
$contents .= ' से प्राप्त  का अवलोकन कीजिये। </p></td></tr>';
$contents .= '<tr><td><p>उपरोक्त विषयांकित प्रकरण क्रमांक '.@$case_no.' '.@$agenst_name.' में  माननीय उच्च न्यायालय ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['coutrs'].'</b>';
} else {	
	$contents .= '<select  name="coutrs">';
	 foreach($court_location2 as $h_courts){
	$contents .= '<option>'.$h_courts.'</option>';	
		}
	$contents .= '</select>';	
}
$contents .= ' में अपील ';


$contents .= ' दायर किये जाने हेतु  प्रस्ताव इस विभाग की ओर प्रेषित  किया है |  ';

$contents .= '</p> </td></tr>';


$contents .= '<tr><td><p>अत : उक्त सम्बन्ध में कलेक्टर जिला ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['district'].'</b>';
} else {	
	$contents .= '------';
}
$contents .= ' को पत्र मूलत:  वापस करते हुए लेख किया जाना उचित होगा कि  1999 में  जिला सरकार बनी थी उसमे कलेक्टर को पदेन  उप सचिव के अधिकार प्रत्योजित  किये गये थे,  चूंकि अब जिला सरकार नही है, अत:  विधि विभाग नियमावली  के तहत प्रशासकीय विभाग के माध्यम से प्रस्ताव प्राप्त होने पर कार्यवाही की जा सकेगी  | ';
$contents .= '</p> </td></tr>';

$contents .= '<tr><td><p>अवलोकनार्थ एवं आदेशार्थ प्रस्तुत|</p></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
if($this->uri->segment(6) == 'p' || $this->uri->segment(7) == 'p'  ){
$contents .= '<tr><td><u>अनुभाग अधिकारी (सिविल)</u></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>अवर सचिव (सिविल)</u></td></tr>';
}
$contents .= '</table>';
