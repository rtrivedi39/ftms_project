<?php 
$contents  = '' ;
$contents .= '<tr><td align="left"><div style="margin-top:20px;"><span style="margin-left:10%;">';
if($is_genrate == true){ 
    $contents .=  ' '.$post_data['subject'];
} else {
    $contents .= ' <textarea name="subject" style="margin: 0px; height: 40px; width: 80%;">'.$file_subject.'</textarea>';
}
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td align="center">--------------</td></tr>';
$contents .= '<tr><td><div style="float:left">क्रमांक  '.$file_number.'/'.date("Y").'/21-क(या0),  </div><div style="float:right">भोपाल, दिनांक  ';
if($is_genrate == true){
$contents .= get_date_formate($post_data['date1'],'d/m/Y').'</div></td></tr>';
}else
{
	$contents .=  '<input type="text" class="date1" name="date1" value="'.$today.'" placeholder="dd/mm/yyyy" />';
}
$contents .=  '</div></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><p>1- क्रपया विचाराधीन पत्र का अवलोकन करने का कष्ट करें |</p> </td></tr>';
$contents .= '<tr><td><p>2- ';
if($is_genrate == true){
	$contents .= ' '.$post_data['ad_name'].'</span>,';	
} else {
	$contents .= ' <select name="ad_name" class="ad_name">';
	$contents .= '<option value="शासकीय अधिवक्ता">शासकीय अधिवक्ता</option>';
	$contents .= '<option value="उप—महाधिवक्ता जबलपुर ">उप—महाधिवक्ता जबलपुर </option>';
	$contents .= '</select> ';
}
if($is_genrate == true){
	$contents .= ' '.$post_data['court_location'].'</span>, (म. प्र.)';
} else {	
	$contents .= ' <select name="court_location" class="court_location">';
	foreach($court_location as $row){
		$contents .= '<option value="'.$row.'">'.$row.'</option>';
	}
	$contents .= '</select>, (म. प्र.)';
}
$contents .= ' ने उक्त प्रकरण में अग्रीम कार्यवाही नही करने का मत व्यक्त किया है, तथा आदेश को पालनार्थ बताया है |</p> </td></tr>';
$contents .= '<tr><td><p>3- प्रकरणों के अवलोकन से स्पष्ट होता है कि प्रकरण में  विधि  विभाग  पक्षकार नही  है, ओर पत्र  की  प्रति प्रशासकीय विभाग को  दी  गई  है, उक्त प्रकरण में विधि विभाग से कोई कार्यवाही की अपेक्षा नही की गई है | </p> </td></tr>';
$contents .= '<tr><td><p>यदि उक्त प्रकरण में प्रशासकीय विभाग की ओर से कोई प्रस्ताव भविष्य में प्राप्त होगा, तो कार्यवाही की  जायेगी | अत: कोई कार्यवाही अपेक्षित नही है |</p> </td></tr>';


if($this->uri->segment(6) == 'p' || $this->uri->segment(7) == 'p'  ){

$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>अनुभाग अधिकारी (याचिका)</u></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>अवर सचिव (याचिका)</u></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>अति. सचिव (याचिका)</u></td></tr>';
}


?>

