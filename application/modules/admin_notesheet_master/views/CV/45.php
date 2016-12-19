<style>
p{
	line-height:24px;
}
</style>
<?php 
$contents  = '<table style="font-size:14px;  width:100%; margin:0% auto;">' ;
$contents .= '<tr><td align="left"><div style="margin-top:5px;"><span style="margin-left:10%;">';
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
$contents .= '<tr><td><p>'.$file_department.' में माध्यस्थम अधिकरण के प्रकरण क्रमांक  '.$case_no.' के  प्रकरण प्रभारी अधिकारी ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['name'].'</b>';
}else{
    $contents .=  '<input type="text" class="" name="name"  size="50" value="कार्यपालन यंत्री, लो0नि0वि0 " required>';
}
$contents .= ' की नियुक्ति कर नस्ती इस विभाग में प्रतिरक्षण करने के लिये अधिवक्ता की नियुक्ति हेतु भेजी है।';
$contents .= '</p> </td></tr>';
$contents .= '<tr><td><p> उक्त प्रकरण माध्यस्थम अधिकरण में विचाराधीन है, तथा प्रकरण सुनवाई हेतु दिनांक ';
if($is_genrate == true){
	$contents .= get_date_formate($post_data['date2'],'d/m/Y');
}else{
    $contents .=  '<input type="text" class="date1" name="date2" value="'.$today.'" placeholder="dd/mm/yyyy" required>';
}

$contents .= ' को नियत है। अधिवक्तओं की नियुक्ति का पैनल सूची में अंकित क्रमांक ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['number'].'</b>';
}else{
    $contents .=  '<input type="text" class="" name="number"  required>';
}
$contents .= ' शासकीय अधिवक्ता ';
if($is_genrate == true){
    foreach(get_advocates_name('', $post_data['member_id']) as $row){
        $contents .= ' <b>'.$row->scm_name_hi.'</b>';
    }
} else {
    $contents .= ' <select name="member_id">';
    foreach($madhyastam_adhivkta as $row){
        $contents .= '<option value="'.$row->scm_id.'">'.$row->scm_name_hi.'</option>';
    }
    $contents .= '</select>';
}
$contents .= '  को म.प्र. शासन की ओर से पैरवी करने हेतु नियुक्त किया जाना उचित प्रतीत होता है।';
$contents .= '</p> </td></tr>';
$contents .= ' <tr><td><p>आदेशार्थ प्रस्तुत है |</p> </td></tr>';
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