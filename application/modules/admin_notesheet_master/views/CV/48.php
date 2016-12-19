<style>
p{
	line-height:24px;
}
</style>
<?php 
$contents  = '<table style="font-size:14px;  width:100%; margin:0% auto;">' ;
$contents .= '<tr><td align="left"><div style="margin-top:20px;"><span style="margin-left:10%;">';
if($is_genrate == true){ 
    $contents .=  ' <b>'.$post_data['subject'].'</b>';
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
$contents .= '<tr><td align="center"> '.$file_department.' विभाग  का  </td></tr>';

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
$contents .= '<tr><td><p> प्रशासकीय विभाग ने ';
if($is_genrate == true){
	$contents .= ' '.$post_data['court_type'];
	$contents .= ', '.$post_data['court_location'];
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
$contents .= ' के प्रकरण क्रमांक '.$case_no.' में पारित आदेश दिनांक ';
if($is_genrate == true){
$contents .= $post_data['date2'];
}else
{
    $contents .=  '<input type="text" class="date1" name="date2" value="'.get_date_formate($file_judgment_date1,'d/m/Y').'" placeholder="dd/mm/yyyy" required>';
}
$contents .= ' के विरूद्ध माननीय सर्वोच्च न्यायालय के समक्ष एस.एल.पी. प्रस्तुत करने के बिन्दु पर नस्ती इस विभाग को अग्रेत्तर कार्यवाही हेतु अंकित की है।';
if($is_genrate == true){
	$contents .= ' '.$post_data['content'];
}else{
    $contents .=  ' <input type="text" class="" size="50" name="content">';
}
$contents .= '</p> </td></tr>';
$contents .= '<tr><td><p>प्रशासकीय विभाग की नस्ती पर शासकीय अधिवक्ता का अभिमत उपलब्ध है उनके मतानुसार माननीय उच्च न्यायालय के आदेश के विरूद्ध माननीय सर्वोच्च न्यायालय में एस.एल.पी. प्रस्तुत की जाना चाहिये।';
if($is_genrate == true){
	$contents .= ' '.$post_data['content1'];
}else{
    $contents .=  ' <input type="text" class="" size="50" name="content1">';
}
$contents .= '</p> </td></tr>';
$contents .= '<tr><td><p> प्रशासकीय विभाग की नस्ती पर उपलब्ध निर्णय की छायाप्रति के आधार पर एस.एल.पी. प्रस्तुत करने की समयावधि दिनांक ';
if($is_genrate == true){
$contents .= get_date_formate($post_data['date3'],'d/m/Y');
}else
{
	$avadhi  = date('d/m/Y',strtotime($file_judgment_date1.' +90 days'));
    $contents .=  '<input type="text" class="date1" name="date3" value="'.$avadhi.'" placeholder="dd/mm/yyyy" required>';
}
$contents .= '  तक उपलब्ध ';
if($is_genrate == true){ 
    $contents .=  $post_data['haithi'];
} else {
	$contents .= ' <select name="haithi" class="">';
	$contents .= '<option value="है">है</option>';
	$contents .= '<option value="थी">थी</option>';
	$contents .= '</select>';
}
$contents .= '|';
if($is_genrate == true){
	$contents .= ' '.$post_data['content2'];
}else{
    $contents .=  ' <input type="text" class="" size="50" name="content2">';
}
$contents .= '</p> </td></tr>';
$contents .= '<tr><td><p>प्रशासकीय विभाग द्वारा प्रेषित नस्ती दिनांक  ';
$contents .= ' को प्राप्त हुई जिसमे अवधि दिनांक  ';
if($is_genrate == true){
	$contents .= get_date_formate($post_data['avadhidate'],'d/m/Y');
}else{
    $contents .=  '<input type="text" class="date1" name="avadhidate" value="'.$today.'" placeholder="dd/mm/yyyy" required>';
}
$contents .= ' तक थी जिसमे कुल दिवस   ';
if($is_genrate == true){
	$contents .= $post_data['dayskul'];
}else{
    $contents .=  '<input type="text" class="" name="dayskul" value="" placeholder="" >';
}
$contents .= ' का विलंब हुआ|  प्रशासकीय विभाग से प्राप्त हुई नस्ती में विलंब  के जोखिम का उत्तरदायित्व प्रशासकीय विभाग पर रहेगा| ';
if($is_genrate == true){
	$contents .= ' '.$post_data['content3'];
}else{
    $contents .=  ' <input type="text" class="" size="50" name="content3">';
}
$contents .= '</p> </td></tr>';
$contents .= ' <tr><td><p>अत: नस्ती उच्च स्तर पर मतार्थ एवं आदेशार्थ प्रस्तुत है |</p> </td></tr>';
if($is_genrate == true){
	$contents .= $post_data['extra_content'] != '' ? '<tr><td><p>'.$post_data['extra_content'].'</p></td></tr><p>' : '';
}else{
	$contents .= '<tr><td><textarea name="extra_content" style="margin: 0px; height: 50px; width: 98%;" placeholder="यदि आपको और डाटा जोड़ना है तो यहाँ पर लिखे|"></textarea></td></tr>';
}
if($this->uri->segment(6) == 'p' || $this->uri->segment(7) == 'p'  ){
	$contents .= '<tr><td>&nbsp;</td></tr>';
	$contents .= '<tr><td><u>अनुभाग अधिकारी (सिविल)</u></td></tr>';
	$contents .= '<tr><td>&nbsp;</td></tr>';
	$contents .= '<tr><td><u>अवर सचिव (सिविल)</u></td></tr>';
	$contents .= '<tr><td>&nbsp;</td></tr>';
	$contents .= '<tr><td><u>अति. सचिव (सिविल)</u></td></tr>';
}
$contents .= '</table>';