<?php
$contents  = '' ;
$contents .= '<tr><td colspan="2"><div class="shift-buttom"><span class="shift-left">'.$file_subject.'</span></div></td></tr>';
$contents .= '<tr><td colspan="2"><table width="100%"><tr><td align="left">पंजी क्रमांक '.$panji_krmank.'/21-क(आप.), </td><td align="right"> दिनांक '.$file_mark_section_date.'</td></tr></table></td></tr>';
$contents .= '<tr><td align="center" colspan="2" > ----------------------------------------------------------</td></tr>';
$contents .= '<tr><td colspan="2"><table width="100%"><tr><td align="left">विभाग का ';
$contents .= $file_type == 'l' ? 'पत्र क्रमांक': false;
$contents .= $file_type == 'f' ? 'यू.ओ. क्रमांक': false;
$contents .= ' '.$file_uo_or_letter_no.'</td><td align="right">दिनांक '.$file_uo_or_letter_date1.'</td></tr></table></td></tr>';
$contents .= '<tr><td colspan="2">हेड क्रं.';
if($is_genrate == true){
    $contents .= $post_data['head'];
}else{
    $contents .= '<input name="head" placeholder="file no" type="text" />';
    
}
$contents .= '/'.date("Y").'</td></tr>';
$contents .= '<tr><td align="center" colspan="2">----000----</td></tr>';
$contents .= '<tr><td align="left" colspan="2"><p class="shift-left">कृपया प्रशासकीय विभाग से प्राप्त नस्ती का अवलोकन करने का कष्ट करें ।  </p></td></tr>'; 
$contents .= '<tr><td colspan="2"><p class="shift-left text-justify">प्रशासकीय विभाग ने माननीय उच्च न्यायालय   ';
if($is_genrate == true){
    $contents .= $post_data['court_location2'];
}else{
    $contents .= '<select name="court_location2">';
    foreach($court_location2 as $row){
        $contents .= '<option value="'.$row.'">'.$row.'</option>';
    }
    $contents .= '</select>';
}
$contents .= ' के समक्ष लंबित प्रकरण क्रमांक  '.$case_no.' में अनावेदक म.प्र. शासन की ओर से पक्ष-समर्थन करने हेतु अतिरिक्त महाधिवक्ता,';
$contents .= 'को आवश्यक निर्देश देने बाबत् नस्ती इस विभाग को प्रशासकीय स्वीकृति के साथ भेजी है    । </p></td></tr>';

$contents .= '<tr><td colspan="2"><p class="text-justify shift-left" >अत: यदि मान्य हो तो प्रशासकीय विभाग के प्रस्तावानुसार पक्ष-समर्थन करने हेतु निर्देश जारी करना प्रस्तावित है । </p><br/></td></tr>';
if($this->uri->segment(6) == 'p' || $this->uri->segment(7) == 'p'  ){
$contents .= '<tr><td colspan="2"><div><u>अनुभाग अधिकारी (आप.) </u> </div><br/><br/><br/></td></tr>';
$contents .= '<tr><td colspan="2"><div><u>अपर सचिव (आप.) </u> </div><br/></td></tr>';
}
$contents .= '<tr><td colspan="2"><br /><br/><br/><div  style="text-align:justify" ></div><br/></td></tr>';

?>
