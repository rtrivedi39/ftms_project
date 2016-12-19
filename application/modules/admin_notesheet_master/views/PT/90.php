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
$contents .= '<tr><td><div style="float:left">पत्र क्रमांक  ';
if($is_genrate == true){
	$contents .= ' '.$post_data['patra_no'];
}else
{
	$contents .=  '<input type="text" class="" name="patra_no" value="" placeholder="" />';
}
$contents .=  '</div><div style="float:right">दिनांक  ';
if($is_genrate == true){
	$contents .= get_date_formate($post_data['date2'],'d/m/Y').'</div></td></tr>';
}else
{
	$contents .=  '<input type="text" class="date1" name="date2" value="'.$today.'" placeholder="dd/mm/yyyy" />';
}
$contents .=  '</div></td></tr>';
$contents .= '<tr><td><p>क्रपया विचाराधीन पत्र का अवलोकन करने का कष्ट करें |</p> </td></tr>';
$contents .= '<tr><td><p>उक्त प्रकरण में ';
if($is_genrate == true){
	$contents .= ' '.$post_data['advocate_type'].'</span>,';
	$contents .= ' '.$post_data['court_type'].'</span>,';
	$contents .= ' '.$post_data['court_location'].'</span>, (म. प्र.)';
} else {
	$contents .= ' <select name="advocate_type" class="advocate_type">';
	foreach($advocate_type as $row){
		$contents .= '<option value="'.$row.'">'.$row.'</option>';
	}
	$contents .= '<option value="उप महाधिवक्ता">उप महाधिवक्ता </option>';
	$contents .= '</select> ';
	$contents .= ' <select name="court_type" class="court_type">';
	foreach($court_type as $row){
		$contents .= '<option value="'.$row.'">'.$row.'</option>';
	}
	$contents .= '</select> ';
	$contents .= ' <select name="court_location" class="court_location">';
	foreach($court_location as $row){
		$contents .= '<option value="'.$row.'">'.$row.'</option>';
	}
	$contents .= '</select>, (म. प्र.)';
}

$contents .= ' हेतु प्रशासकीय विभाग और इस विभाग को सूचित किया जाता है |	प्रकरण में आवश्यक कार्यवाही प्रशासकीय विभाग को ही करना है |	अत: प्राप्त पत्र की छाया प्रति आवश्यक कार्यवाही हेतु प्रशासकीय 	विभाग को प्रेषित किया जाना प्रस्तावित है |</p></td></tr>';
if($this->uri->segment(6) == 'p' || $this->uri->segment(7) == 'p'  ){
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>अनुभाग अधिकारी (याचिका)</u></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>अवर सचिव (याचिका)</u></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>अति. सचिव (याचिका)</u></td></tr>';


}


?>

