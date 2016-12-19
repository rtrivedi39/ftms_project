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
}else{
    $contents .=  '<input type="text" class="date1" name="date1" value="'.$today.'" placeholder="dd/mm/yyyy" required>';
}
$contents .= ' का अवलोकन करें। </p></td></tr>';
$contents .= '<tr><td><p>प्रशासकीय विभाग ने उपरोक्त विषयक प्रकरण क्रमांक  '.$case_no.' के निर्णय दिनांक ';
if($is_genrate == true){
	$contents .= get_date_formate($post_data['date5'],'d/m/Y');
}else{
    $contents .=  '<input type="text" class="date1" name="date5" value="'.$today.'" placeholder="dd/mm/yyyy" required>';
}
$contents .= ' की छाया प्रतिलिपि भेजकर इस विभाग द्वारा ';
if($is_genrate == true){
$contents .= ' '.$post_data['writappel2'];
}else{
$contents .= ' <select name="writappel2"><option>अपील</option><option>रिट</option></select>';
}
$contents .= ' याचिका प्रस्तुत करने हेतु मत चाहा है। निर्णय दिनांक ';
if($is_genrate == true){
	$contents .= get_date_formate($post_data['date2'],'d/m/Y');
}else{
    $contents .=  '<input type="text" class="date1" name="date2" value="'.$file_judgment_date1.'" placeholder="dd/mm/yyyy" required>';
}
$contents .= ' के अनुसार नकल दिनांक ';
if($is_genrate == true){
	$contents .= get_date_formate($post_data['date3'],'d/m/Y');
}else{
    $contents .=  '<input type="text" class="date1" name="date3" value="'.$today.'" placeholder="dd/mm/yyyy" required>';
}
$contents .= ' मिलाकर अवधि दिनांक ';
if($is_genrate == true){
	$contents .= get_date_formate($post_data['date4'],'d/m/Y');
}else{
    $contents .=  '<input type="text" class="date1" name="date4" value="'.$today.'" placeholder="dd/mm/yyyy" required>';
}
$contents .= '  तक उपलब्ध ';
if($is_genrate == true){
	$contents .= ''.$post_data['title_loc'];
} else {
	$contents .= ' <select name="title_loc" class="title_loc">';
	$contents .= '<option value="है">है</option>';
	$contents .= '<option value="थी">थी</option>';
	$contents .= '</select>';
}
$contents .= '|';
if($is_genrate == true){
	$contents .= ' '.$post_data['content'];
}else{
    $contents .=  ' <input type="text" class="" size="50" name="content">';
}
$contents .= '</p> </td></tr>';
$contents .= ' <tr><td><p>अत: नस्ती उच्च स्तर पर मतार्थ एवं आदेशार्थ प्रस्तुत है।</p> </td></tr>';
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