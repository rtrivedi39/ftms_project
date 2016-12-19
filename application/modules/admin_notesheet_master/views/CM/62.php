<?php
$contents  = '' ;
$contents .= '<tr><td colspan="2"><div class="shift-buttom"><span class="shift-left">'.$file_subject.'</span></div></td></tr>';
$contents .= '<tr><td colspan="2"><table width="100%"><tr><td align="left">पंजी क्रमांक '.$panji_krmank.'/21-क(आप.), </td><td align="right"> दिनांक '.$file_mark_section_date.'</td></tr></table></td></tr>';
$contents .= '<tr><td align="center" colspan="2" > ----------------------------------------------------------</td></tr>';
$contents .= '<tr><td colspan="2"> ';
if($is_genrate == true){
    $contents .= $post_data['advocate_type'];
}else{
    $contents .= '<select name="advocate_type">';
    foreach($advocate_type as $row){
        $contents .= '<option value="'.$row.'">'.$row.'</option>';
    }
    $contents .= '</select>';
}
$contents .= ' ';
if($is_genrate == true){
    $contents .= $post_data['court_location'];
}else{
    $contents .= '<select name="court_location">';
    foreach($court_location as $row){
        $contents .= '<option value="'.$row.'">'.$row.'</option>';
    }
    $contents .= '</select>';
}
$contents .= ' </td></tr>';
$contents .= '<tr><td colspan="2">उच्च न्यायालय   ';
if($is_genrate == true){
    $contents .= $post_data['court'];
}else{
    $contents .= '<select name="court" ><option> </option><option>खण्डपीठ</option></select>';
}
$contents .= '&nbsp;';
if($is_genrate == true){
    $contents .= $post_data['state'];
}else{
    $contents .= '<select name="state" ><option> ग्वालियर</option><option>इंदौर</option><option>जबलपुर</option></select>';
}
$contents .= ' का पत्र क्रमांक '.$file_uo_or_letter_no.' दिनांक '.$file_uo_or_letter_date1.'</td></tr>';
$contents .= '<tr><td colspan="2"><table width="100%"><tr><td align="left">हेड क्रं.';
if($is_genrate == true){
    $contents .= $post_data['head'];
}else{
    $contents .= '<input name="head" placeholder="file no" type="text" />';
    
}
$contents .= '/'.date("Y").' </td><td align="right">उच्च न्यायालय ';
if($is_genrate == true){
    $contents .= $post_data['court_location2'];
}else{
    $contents .= '<select name="court_location2">';
    foreach($court_location2 as $row){
        $contents .= '<option value="'.$row.'">'.$row.'</option>';
    }
    $contents .= '</select>';
}
$contents .= '</td></tr></table> </td></tr>';

$contents .= '<tr><td align="center" colspan="2">----000----</td></tr>';
$contents .= '<tr><td align="left" colspan="2"><p class="shift-left">कृपया कार्यालय ';
if($is_genrate == true){
    $contents .= $post_data['high_court_list'];
}else{
    $contents .= '<select name="high_court_list" ><option>महाधिवक्ता जबलपुर </option><option>अति0 महाधिवक्ता ग्वालियर  </option><option>अति0 महाधिवक्ता इन्दौर  </option></select>';
}

$contents .= ' से प्राप्त पत्र एवं सह पत्रो सहित अवलोकन हो | ';

$contents .= ' </p></td></tr><tr><td align="left" colspan="2"><p class="shift-left"> माननीय उच्च न्यायलय द्वारा पारित ';
if($is_genrate == true){
    $contents .= $post_data['high_court'];
}else{
	 $contents .= '<select name="high_court"><option> निर्णय </option><option> आदेश </option></select>';
}
$contents .= ' दिनांक ';
if($is_genrate == true){
    $contents .= $post_data['date_12'];
}else{
    $contents .= '<input type="text" name="date_12" class="date1"/>';
}
$contents .= ' की ';

$contents .= ' प्रमाणित प्रति भेजकर निर्णय में अग्रिम कार्यवाही ';
if($is_genrate == true){
    $contents .= $post_data['option_yes'];
}else{
	$contents .=  '<select name="option_yes"><option> हाँ </option><option> नहीं </option></select>';
}
$contents .=  ' करने का मत व्यक्त किया हैं|</td></tr>'; 
$contents .= '<tr><td colspan="2"><p class="shift-left text-justify">';
if($is_genrate == true){
    $contents .= $post_data['high_court'];
}else{
	 $contents .= '<select name="high_court"><option> निर्णय </option><option> आदेश </option></select>';
}
$contents .= ' दिनांक ';
 
if($is_genrate == true){
    $contents .= $post_data['text_123'];
}else{
    $contents .= '<input type="text" name="text_123" value="'.$file_judgment_date1 .'" class="date1"/>';
}
$contents .= ' से यह विशेष प्रमाणित पत्र प्राप्ति हेतु प्रार्थना पत्र देना उचित समझा जाये तो  अवधि अधिनियम के नियम 133 के अनुसार दिनांक  ';
if($is_genrate == true){
    $contents .= $post_data['date_123'];
}else{
    $contents .= '<input type="text" name="date_123" class="date1"/>';
}
$contents .= '&nbsp;तक उपलब्ध ';
 if($is_genrate == true){
    $contents .= $post_data['option_past_pre'];
}else{
	$contents .= '<select name="option_past_pre"><option> है</option><option>थी</option></select>';
}
$contents .= '। प्रकरण में शासन की अपील ';
if($is_genrate == true){
    $contents .= $post_data['option_postpond'];
}else{
    $contents .= '<select name="option_postpond"><option> ख़ारिज</option><option>निरस्त</option><option>स्वीकार</option></select>';
}
 $contents .= ' की गई है ।</p></td></tr>';
$contents .= '<tr><td colspan="2"><p class="text-justify shift-left"> प्रकरण  में पारित'; 
if($is_genrate == true){
    $contents .= $post_data['high_court'];
}else{
	 $contents .= '<select name="high_court"><option> निर्णय </option><option> आदेश </option></select>';
}
$contents .= ' दिनांक   ';
if($is_genrate == true){
    $contents .= $post_data['order_date_1'];
}else{
    $contents .= '<input type="text" name="order_date_1" class="date1"  value = "'.$file_judgment_date1 .'" />';
}
$contents .= ' प्राप्त हैं| नकल के लिये आवेदन दिनांक  ';
if($is_genrate == true){
    $contents .= $post_data['order_date_12'];
}else{
    $contents .= '<input type="text" name="order_date_12" class="date1"/>';
}
$contents .= ' से दिनांक  ';
if($is_genrate == true){
    $contents .= $post_data['order_date_14'];
}else{
    $contents .= '<input type="text" name="order_date_14" class="date1"/>';
}
$contents .= ' तक है | नकल के लिये अवधि दिनांक  ';
if($is_genrate == true){
    $contents .= $post_data['order_date_122'];
}else{
    $contents .= '<input type="text" name="order_date_122" class="date1"/>';
}
$contents .= ' तक प्राप्त हैं| शासन की ';
if($is_genrate == true){
    $contents .= $post_data['option_postpond'];
}else{
    $contents .= '<select name="option_postpond"><option> अपील </option><option>पुनरीक्षण </option></select>';
}
if($is_genrate == true){
    $contents .= $post_data['option_postpond'];
}else{
    $contents .= '<select name="option_postpond"><option> ख़ारिज</option><option>निरस्त</option><option>स्वीकार</option></select>';
}
$contents .= ' की गई हैं|  ';

$contents .= ' प्रकरण   ';
if($is_genrate == true){
    $contents .= $post_data['late_receive_days'] ;
}else{
$contents .= '<input type="text" name="late_receive_days"/>';
}
$contents .= '   दिन विलम्ब से प्राप्त हुआ है। ';
$contents .= '</p></td></tr>';
$contents .= '<tr><td colspan="2"><p class="text-justify shift-left">प्रकरण  परीक्षण हेतु प्रस्तुत है ।</p><br/></td></tr>';
$contents .= '<tr><td colspan="2"><br/><div  style="text-align:justify" ></div><br/></td></tr>';
   if($this->uri->segment(6) == 'p' || $this->uri->segment(7) == 'p'  ){
$contents .= '<tr><td colspan="2"><div><u>अनुभाग अधिकारी (आप.) </u> </div><br/><br/><br/></td></tr>';
$contents .= '<tr><td colspan="2"><div><u>अति. सचिव </u> </div><br/></td></tr>';
$contents .= '<tr><td colspan="2"><br /><br/><br/><div  style="text-align:justify" ></div><br/></td></tr>';
   }
?>




