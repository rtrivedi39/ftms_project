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
$contents .= '<tr><td><p> प्रशासकीय विभाग ने माननीय सर्वोच्च न्यायालय, नई दिल्ली के एस.एल.पी. (सिविल) नं०  ';
if($is_genrate == true){
	$contents .= $post_data['number'];
}else{
    $contents .=  '<input type="text" class="" name="number" value="'.$file_number.'" required>';
}
$contents .= '  में अनावेदक म०प्र० शासन की ओर से पक्ष-समर्थन करने हेतु अधिवक्ता की नियुक्ति की जाए | ';
if($is_genrate == true){
	$contents .= ' '.$post_data['content'];
}else{
    $contents .=  ' <input type="text" class="" size="50" name="content">';
}
$contents .= '</p> </td></tr>';
$contents .= '<tr><td><p>अब यदि मान्य हो तो प्रशासकीय विभाग के प्रस्तावानुसार विषयांकित प्रकरण में राज्य के स्थाई अधिवक्ता, ';
if($is_genrate == true){
    foreach(get_advocates_name('', $post_data['member_id']) as $row){
        $contents .= ' <b>'.$row->scm_name_hi.'</b>';
    }
} else {
    $contents .= ' <select name="member_id">';
    foreach($standing_counsil_memebers as $row){
        $contents .= '<option value="'.$row->scm_id.'">'.$row->scm_name_hi.'</option>';
    }
    $contents .= '</select>';
}
$contents .= '  को पक्ष-समर्थन करने हेतु निर्देश के साथ वकालतनामा जारी किया जाना उचित होगा  एवं अनुमोदन पश्चात् वकालतनामा एवं आदेश की प्रतिया हश्ताक्षरार्थ प्रस्तुत है।| ';
if($is_genrate == true){
	$contents .= ' '.$post_data['content1'];
}else{
    $contents .=  ' <input type="text" class="" size="50" name="content1">';
}
$contents .= '</p> </td></tr>';
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