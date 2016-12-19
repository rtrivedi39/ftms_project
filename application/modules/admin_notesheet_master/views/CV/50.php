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
$contents .= '<tr><td align="center"> '.$file_department.'  का  </td></tr>';
$contents .= '<tr><td align="center"><div style="float:left;">यू.ओ. क्रमांक :'.$file_uo_or_letter_no.'</div><div style="float:right;">दिनांक '.get_date_formate($file_uo_or_letter_date,'d/m/Y').'</div>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td align="center"> -------000------- </td></tr>';
$contents .= '<tr><td><p>कृपया प्रशासकीय विभाग की नस्ती पर अंकित टीप ';
if($is_genrate == true){
$contents .= get_date_formate($post_data['date1'],'d/m/Y');
}else
{
    $contents .=  '<input type="text" class="date1" name="date1" value="'.$today.'" placeholder="dd/mm/yyyy" required>';
}
$contents .= ' का अवलोकन करें। </p></td></tr>';
$contents .= '<tr><td><p>';
if($is_genrate == true){ 
    $contents .=  ' '.$post_data['content2'];
} else {
    $contents .= ' <textarea name="content2" style="margin: 0px; height: 60px; width: 90%;">
	प्रशासकीय विभाग ने माननीय उच्च न्यायालय के समक्ष लंबित प्रकरण क्रमांक '.$case_no.' में अनावेदक म.प्र. शासन की ओर से पक्ष समर्थन करने हेतु
	</textarea>';
}

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
		$contents .= '<option value="'.$row.'">'.$row.'</option>';
	}
	$contents .= '</select>';
}
if($is_genrate == true){ 
    $contents .=  ' '.$post_data['content3'];
} else {
    $contents .= ' <textarea name="content3" style="margin: 0px; height: 40px; width: 98%;">
	 को आवश्यक निर्देश देने बाबत्‌ नस्ती इस विभाग को प्रशासकीय स्वीकृति के साथ भेजी है। 
	</textarea>';
}
$contents .= '</p> </td></tr>';
$contents .= '<tr><td><p>';
if($is_genrate == true){ 
    $contents .=  ' '.$post_data['content4'];
} else {
    $contents .= ' <textarea name="content4" style="margin: 0px; height: 40px; width: 90%;">
	 अत: यदि मान्य हो तो प्रशासकीय विभाग के प्रस्तावानुसार
	</textarea>';
}
if($is_genrate == true){
	$contents .= ' '.$post_data['advocate_type'];
	$contents .= ' '.$post_data['court_location'];
} else {
	$contents .= '-------------------, ----------------------- ';
} 
if($is_genrate == true){ 
    $contents .=  ' '.$post_data['content5'];
} else {
    $contents .= ' <textarea name="content5" style="margin: 0px; height: 40px; width: 98%;">
	 पक्ष-समर्थन करने के निर्देश जारी करना प्रस्तावित है।
	</textarea>';
}

$contents .= '</p> </td></tr>';
$contents .= '<tr><td><p> अनुमोदन पश्चात् आदेश की प्रतिया हश्ताक्षरार्थ प्रस्तुत है।</p> </td></tr>';
if($is_genrate == true){
	$contents .= $post_data['extra_content'] != '' ? '<tr><td><p>'.$post_data['extra_content'].'</p></td></tr><p>' : '';
}else{
	$contents .= '<tr><td><textarea name="extra_content" style="margin: 0px; height: 50px; width: 98%;" placeholder="यदि आपको और डाटा जोड़ना है तो यहाँ पर लिखे|"></textarea></td></tr>';
}
$contents .= '<tr><td>&nbsp;</td></tr>';
if($this->uri->segment(6) == 'p' || $this->uri->segment(7) == 'p'  ){
$contents .= '<tr><td><u>अनुभाग अधिकारी (सिविल)</u></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>अवर सचिव (सिविल)</u></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>अति. सचिव (सिविल)</u></td></tr>';
}
$contents .= '</table>';