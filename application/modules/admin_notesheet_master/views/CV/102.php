<style>
p{
	line-height:19px;
}td{
	padding:0px;
}
</style>
<?php 
$contents  = '<table style="font-size:14px;  width:90%; margin:0% auto;" cellpadding="0" border="0" cellspacing="0">' ;
$contents .= '<tr><td align="right"><b><u>स्पीड पोस्ट द्वारा</b></u></td></tr>';
$contents .= '<tr><td align="center"><u><h3>'.$dept_name.'</h3></u></td></tr>';
$contents .= '<tr><td align="left"><div style="float:left;">पृ0 क्रमांक 3(बी)/';
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
	$contents .= '<tr><td align="left" style="line-height:15px;"><span style="margin-left:8%">'.$post_data['advocate_type'].'</span>,</td></tr>';
	$contents .= '<tr><td align="left" style="line-height:15px;"><span style="margin-left:8%">'.$post_data['court_type'].'</span>,</td></tr>';
	$contents .= '<tr><td align="left" style="line-height:15px;"><span style="margin-left:8%">'.$post_data['court_location'].'</span></td></tr>';
} else {
	$contents .= '<tr><td align="left"  style="line-height:15px;"><select name="advocate_type" class="advocate_type">';
	foreach($advocate_type as $row){
		$contents .= '<option value="'.$row.'">'.$row.'</option>';
	}
	$contents .= '</select></td></tr>';
	$contents .= '<tr><td align="left"><select name="court_type" class="court_type">';
	foreach($court_type as $row){
		$contents .= '<option value="'.$row.'">'.$row.'</option>';
	}
	$contents .= '</select></td></tr>';
	$contents .= '<tr><td align="left"  style="line-height:15px;"><select name="court_location" class="court_location">';
	foreach($court_location as $row){
		$contents .= '<option value="'.$row.'">'.$row.'</option>';
	}
	$contents .= '</select></td></tr>';
}
$contents .= '<tr><td align="left"><table><td vertical-align="top">विषय:-</td><td style="margin-left:3%"><span style="margin-left:0%">';
if($is_genrate == true){ 
    $contents .=  $post_data['subject'];
} else {
    $contents .= '<textarea name="subject" rows="2" columns="100">'.$file_subject.'</textarea>';
}
$contents .= '  विरुद्ध ';
if($is_genrate == true){ 
    $contents .=  $post_data['against_party'];
} else {
    $contents .= '<input type="text" name="against_party" />';
} 
$contents .= ' में पारित   ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['title_type'].'</b>';
} else {
	$contents .= ' <select name="title_type" class="title_type">';
	$contents .= '<option value="आदेश">आदेश</option>';
	$contents .= '<option value="निर्णय">निर्णय</option>';
	$contents .= '<option value="अधिनिर्णय">अधिनिर्णय</option>';
	$contents .= '<option value="अवार्ड">अवार्ड</option>';
	$contents .= '</select>';
}
$contents .= ' दिनांक  ';
if($is_genrate == true){ 
    $contents .=  get_date_formate($post_data['date4judge'],'d/m/Y');
} else {
    $contents .= '<input type="text" class="date1" name="date4judge" placeholder="dd/mm/yyyy" value="'.((isset($file_judgment_date) && ($file_judgment_date != '0000-00-00')) ? get_date_formate($file_judgment_date, 'd/m/Y') : date('d/m/Y')).'"/></div>';
}
if($is_genrate == true){
	$contents .= ' '.$post_data['advocate_type'].'</span>';
	$contents .= ' '.$post_data['court_location'].'</span>';
} else {
		$contents .= '-------------, ';
	$contents .= ' -----------,';
}
$contents .= ' में  ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['title_loc'].'</b>';
} else {
	$contents .= ' <select name="title_loc" class="title_loc">';
	$contents .= '<option value="अपील">अपील</option>';
	$contents .= '<option value="याचिका">याचिका</option>';
	$contents .= '<option value="रिट याचिका">रिट याचिका</option>';
	$contents .= '<option value="रिट अपील">रिट अपील</option>';
	$contents .= '<option value="पुनरीक्षण">पुनरीक्षण</option>';
	$contents .= '<option value="निगरानी">निगरानी</option>';
	$contents .= '</select>';
}
$contents .= ' प्रस्तुत करने बाबत|  ';
$contents .= '</td></tr></table></td></tr>';
$contents .= '<tr><td align="center">------000-------</td></tr>';
$contents .= '<tr><td align="left"><p>राज्य शासन द्वारा उपरोक्त विषयांतर्गत प्रकरण में पारित ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['title_type'].'</b>';
} else {
	$contents .= ' --------- ';
} 
$contents .= ' दिनांक ';
if($is_genrate == true){ 
    $contents .=  $post_data['date4judge'];
} else {
    $contents .= '--------- ';
}
$contents .= '  के विरुद्ध ';
if($is_genrate == true){
	//$contents .= ' '.$post_data['advocate_type'].' ';
	$contents .= ' '.$post_data['court_type'].' ';
	$contents .= ' '.$post_data['court_location'].' ';
} else {
	$contents .= ' ---------, ';
	$contents .= ' --------, ';
	$contents .= ' ---------- ';
}
$contents .= ' के समक्ष ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['title_loc'].'</b>';
} else {
	$contents .= ' --------- ';
}
$contents .= ' प्रस्तुत करने का निर्णय लिया गया है|  अपील प्रस्ताव दिनांक  ';
if($is_genrate == true){ 
    $contents .=  get_date_formate($post_data['prastav'],'d/m/Y');
} else {
    $contents .= '<input type="text" class="date1" name="prastav" placeholder="dd/mm/yyyy" value="'.$today.'"/>';
}
$contents .= ' को प्राप्त हुआ है| ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['title_loc'].'</b>';
} else {
	$contents .= ' ------------- ';
} 
$contents .= ' प्रस्तुत करने हेतु तिथि ';
if($is_genrate == true){ 
    $contents .=  $post_data['date_11'];
} else {
    $contents .= '<input type="text" class="date1" name="date_11" placeholder="dd-mm-yyyy" />';
}
$contents .= ' उपलब्ध है, फिर भी यदि प्रशासकीय विभाग द्वारा ';
if($is_genrate == true){
	$contents .= ' '.$post_data['advocate_type'].' ';
	$contents .= ' '.$post_data['court_type'].' ';
	$contents .= ' '.$post_data['court_location'].' ';
} else {
	$contents .= ' ---------, ';
	$contents .= ' --------, ';
	$contents .= ' ---------- ';
}
$contents .= ' में ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['title_loc'].'</b>';
} else {
	$contents .= ' ---------- ';
} 
$contents .= ' प्रस्तुत करने में विलंब होता है तो विलंब के कारणों को दर्शाने का उत्तरदायित्व स्वयं  प्रशासकीय विभाग का होगा | अतः समयसीमा में ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['title_loc'].'</b>';
} else {
	$contents .= ' ----------- ';
}
$contents .= ' प्रस्तुत की जाये, तथा कार्यवाही की सूचना शीघ्र विधि विभाग को प्रेषित की जाये |';
$contents .= '<tr><td align="right">मध्यप्रदेश के राज्यपाल के नाम से तथा आदेशानुसार,</td></tr>';
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right"><div  style="width:60%; text-align:center;">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td>&nbsp;</td></tr>';
} 
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">(';

if($is_genrate == true){	 
	$contents .= get_officer_information($this->input->post('sing_user')); 
}else{
	$contents .= get_officer_for_sign('sing_user' ,array(2,3,4,5,7) ,'', $us_id);
}
$contents .= ')</div></td></tr>';
$contents .= '<tr><td align="right"  style="line-height:15px;"><div style="width:60%; text-align:center;">';
if($is_genrate == true){
	$contents .=   get_officer_dign($this->input->post('sing_user'));
}else{
	$contents .= '-------';
}
$contents .= '</div></td></tr>';
$contents .= '<tr><td align="right"  style="line-height:15px;"><div style="width:60%; text-align:center;">'.$dept_name.'</div></td></tr>';
$contents .= '<tr><td></td></tr>';
$contents .= '<tr><td align="left"><div style="float:left;">पृ0 क्रमांक 3(बी)/';
if($is_genrate == true){ 
    $contents .=  $post_data['number'];
} else {
    $contents .= '---------- ';
}
$contents .= '/'.date("Y").'/'.$file_number.'/21-क(सि.)</div><div style="float:right;">भोपाल, दिनांक ';
if($is_genrate == true){ 
    $contents .=  get_date_formate($post_data['date4'],'d/m/Y');
} else {
    $contents .= '<input type="text" class="date1" name="date4" placeholder="dd/mm/yyyy" value="'.$today.'"/></div>';
}
$contents .=  '</td></tr>';
$contents .= '<tr><td><tr><td><u>प्रतिलिपि:</u></td></tr>';

$contents .= '<tr><td><p>1- सचिव, म.प्र. शासन, '.$file_department.', भोपाल की ओर उनके    यू.ओ.क्र  '.$file_uo_or_letter_no.' दिनांक '.get_date_formate($file_uo_or_letter_date1,'d/m/Y').' के संदर्भ में उनकी विभागीय नस्ती सहित अग्रेषित कर सूचित किया जाता है कि प्रकरण मे प्रभारी अधिकारी को निर्देश दे कि प्रकरण से संबंधित समस्त अभिलेख तथा प्रश्नगत ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['title_type'].'</b>';
} else {
	$contents .= ' ------------ ';
}
$contents .= ' दिनांक   ';
if($is_genrate == true){ 
    $contents .= $post_data['judgedate'];
} else {
    $contents .= '<input type="text" class="date1" name="judgedate" placeholder="dd/mm/yyyy" value="'.((isset($file_judgment_date) && ($file_judgment_date != '0000-00-00')) ? get_date_formate($file_judgment_date, 'd/m/Y') : date('d/m/Y')).'"/>';
} 
 $contents .= ' की प्रमाणित प्रतिलिपि के  साथ अविलंब ';
if($is_genrate == true){
	$contents .= ' '.$post_data['advocate_type'].' ';
	$contents .= ' '.$post_data['court_type'].' ';
	$contents .= ' '.$post_data['court_location'].' ';
} else {
	$contents .= ' ---------, ';
	$contents .= ' --------, ';
	$contents .= ' ---------- ';
}
$contents .= ' से संपर्क कर  उपरोक्तानुसार समयसीमा में ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['title_loc'].'</b>';
} else {
	$contents .= ' ------------- ';
}
 $contents .= ' प्रस्तुत करे,  तथा की गई कार्यवाही की सूचना इस विभाग को भेजे |   </td></tr>';
$contents .= '<tr><td><p>2- कलेक्टर ';
if($is_genrate == true){
	$contents .= $post_data['distic_1'];
}else
{
$contents  .= get_distic_dd('distic_1');	
}
$contents .= ' को इस निर्देश के साथ प्रेषित की उपरोक्तानुसार ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['title_loc'].'</b>';
} else {
	$contents .= ' ------------- ';
}
 $contents .= ' प्रस्तुत कराना सुनिश्चित करे,  तथा की गई कार्यवाही की सूचना इस विभाग को भेजे |   ';
 $contents .= '</p></td></tr>';
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right"><div  style="width:60%; text-align:center;">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td>&nbsp;</td></tr>';
}
$contents .= '<tr><td align="right" style="line-height:15px;"><div style="width:60%; text-align:center;">(';

if($is_genrate == true){
	$contents .=  get_officer_information($this->input->post('sing_user')); 
}else{
	$contents .= '-------';	
}


$contents .= ')</div></td></tr>';
$contents .= '<tr><td align="right" style="line-height:15px;"><div style="width:60%; text-align:center;">';
if($is_genrate == true){	
    $contents .=   get_officer_dign($this->input->post('sing_user'));
}else{
	$contents .= '-------';
}  
$contents .= '</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">'.$dept_name.'</div></td></tr>';
$contents .= '<tr><td></td></tr>';
$contents .= '</table>';
?>

