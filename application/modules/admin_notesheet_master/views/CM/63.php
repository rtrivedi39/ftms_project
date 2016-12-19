<?php
$contents  = '' ;
$contents .= '<tr><td>';
$contents .= '<div class="shift-top-note"><span class="shift-left-note">'.$file_subject.'</span></div><br>';
$contents .= 'पंजी क्रमांक '.$panji_krmank.'/21-क(आप.),<div style="float: right"> दिनांक '.$file_mark_section_date.'</span></div></td></tr>';
$contents .= '<tr><td align="center"><br>-------00------<br><br></td></tr>';
$contents .= '<tr><td><p> कृपया विचाराधीन ';
$contents .= $file_type == 'l' ? 'पत्र ': false;
$contents .= $file_type == 'f' ? 'नस्ती': false;
$contents .= ' का अवलोकन करने का कष्ट करें ।</p><br><p>';
if($is_genrate == true){
    $contents .= $post_data['text1'];
}else{
    $contents .= '<input type="text" name="text1"/>';
}
$contents .= ' की ';
$contents .= 'पत्र/नस्ती  के ';
$contents .= $file_type == 'l' ? 'पत्र क्रमांक': false;
$contents .= $file_type == 'f' ? 'यू.ओ. क्रमांक': false;
$contents .= ' '.$file_uo_or_letter_no.' , दिनांक '.$file_uo_or_letter_date1.' ';
$contents .= 'के संदर्भ में प्रभारी अधिकारी नियुक्त कर प्रतिरक्षण आदेश जारी करने का लेख किया है।</p>';
$contents .= '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;अनुमोदित  होने पर वकालतनामा एवं प्रतिरक्षण आदेश की प्रति हस्ताक्षार्थ प्रस्तुत । एवं प्रशासकीय विभाग की नस्ती पर अंकित टीप हस्ताक्षार्थ प्रस्तुत |<br><br></td></tr>';
$contents .= '<tr><td><br><u>अनु. अधि. (आप.) </u><br><br><br><br><u>अवर सचिव (आप.) </u></td></tr>';
?>
