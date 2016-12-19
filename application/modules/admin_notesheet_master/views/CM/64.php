<?php
$contents  = '' ;
$contents .= '<tr><td colspan="2"><div class="shift-buttom"><span class="shift-left">'.$file_subject.'</span></div></td></tr>';
$contents .= '<tr><td colspan="2"><table width="100%"><tr><td align="left">पंजी क्रमांक '.$panji_krmank.'/21-क(आप.), </td><td align="right"> दिनांक '.$file_mark_section_date.'</td></tr></table></td></tr>';
$contents .= '<tr><td align="center" colspan="2" ><br>-------00------<br><br></td></tr>';
$contents .= '<tr><td colspan="2"><p  class="shift-left"> कृपया विचाराधीन पत्र का अवलोकन करने का कष्ट करें |';
$contents .= ' </p></td></tr>';
$contents .= '<tr><td colspan="2"><p  class="shift-left"> ';
if($is_genrate == true){
    foreach(get_advocates_name('', $post_data['member_id']) as $row){
        $contents .= ' <b>'.$row->scm_name_hi.'</b>';
    }
}else{
$contents .= '<select name="member_id">';
foreach($standing_counsil_memebers as $row){
    $contents .= '<option value="'.$row->scm_id.'">'.$row->scm_name_hi.'</option>';
}
}
$contents .= '</select>';
$contents .= ' स्थायी अधिवक्ता, नई दिल्ली के ';
$contents .= $file_type == 'l' ? 'पत्र क्रमांक': false;
$contents .= $file_type == 'f' ? 'यू.ओ. क्रमांक': false;
$contents .= ' '.$file_uo_or_letter_no.' दिनांक  '.$file_judgment_date1.' ';
$contents .= ' </p></td></tr>';
$contents .= '<tr><td align="left" colspan="2"><p class="shift-left">';
$contents .= 'उच्चतम न्यायालय में म.प्र. शासन  के स्थायी अधिवक्ता,     ';
if($is_genrate == true){
foreach(get_advocates_name('', $post_data['member_id']) as $row){
    $contents .= ' <b>'.$row->scm_name_hi.'</b>';
}}else{
    $contents .= '_';
    }
$contents .= ' , को प्रेषित विचाराधीन';

$contents .= ' पत्र के संदर्भ में वकालतनामा व प्रतिरक्षण के लिए आदेश जारी किया जाना उचित होगा । </td></tr>';
$contents .= '<tr><td align="left" colspan="2"><p class="shift-left">अनुमोदित होने पर वकालतनामा व आदेश की प्रतिलिपि हस्ताक्षर प्रस्तुत है ।';
$contents .= ' </p></td></tr>';
if($this->uri->segment(6) == 'p' || $this->uri->segment(7) == 'p'  ){
$contents .= '<tr><td colspan="2"><div><u>अनु. अधि. (आप.) </u> </div><br/><br/><br/></td></tr>';
$contents .= '<tr><td colspan="2"><div><u>अवर सचिव (आप.) </u> </div><br/><br/><br/></td></tr>';
$contents .= '<tr><td colspan="2"><div><u>अति. सचिव (आप.)  </u> </div></td></tr>';
}
$contents .= '<tr><td colspan="2"><br /><br/><br/><div  style="text-align:justify" ></div><br/></td></tr>';

?>