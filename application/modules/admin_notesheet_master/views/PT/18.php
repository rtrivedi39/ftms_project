<?php 
$contents  = '' ;
$contents .= '<tr><td align="left"><div style="margin-top:20px;"><span style="margin-left:10%;"> ';
if($is_genrate == true){
   $contents .=  $post_data['subject'];
} else {
    $contents .= ' <textarea name="subject"  cols="85" row="3" >'.$file_subject.'</textarea>';
 
}

$contents .= '</span></div></td></tr>';
$contents .= '<tr><td align="center">---------</td></tr>';
$contents .= '<tr><td><div style="float:left">पं.क्र.  '.$file_number.'/21-(या0),  </div><div  style="float:right">दिनांक ';
if($is_genrate == true){
     $contents .= get_date_formate($post_data['date1'],'d/m/Y');
}
else
{
    $contents .='<input type="text" class="date1" name="date1" placeholder="dd/mm/yyyy" value="'.$file_mark_section_date.'" />';
}
$contents .= '<tr><td align="center"> '.$file_department.'  का  </td></tr>';

$contents .= '<tr><td align="center"><div style="float:left;">यू.ओ. क्रमांक :'.$file_uo_or_letter_no.'</div><div style="float:right;">दिनांक '.get_date_formate($file_uo_or_letter_date,'d/m/Y').'</div>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td align="left"><p> 	कृपया प्रशासकीय विभाग की नस्ती पर अंकित टीप का अवलोकन करें।  </td></tr>';
$contents .= '<tr><td align="left"><p> 	विषयांकित प्रकरण में प्रतिरक्षण आदेश जारी करने का उल्लेख किया गया है। प्रशासनिक अधिकरण जबलपुर में शासन द्वारा ';

if($is_genrate == true){
$contents .= $post_data['advocate_name'];
}else
{
	$contents .=  '<input type="text" name="advocate_name" id="advocate_name_txt"  />';
}
$contents .= ' शासकीय अधिवक्ता (स्टेडिंग काउन्सिंल) जबलपुर को नियुक्त किया गया है।  </td></tr>';
$contents .= '<tr><td align="left"><p> 	अत: यदि मान्य हो तो उपरोक्त विषयांकित प्रकरण में इस विभाग द्वारा जारी आदेश दिनांक 15 जनवरी, 2009 के परिप्रेक्ष्य में केन्द्रीय प्रशासनिक अधिकरण जबलपुर में शासन की ओर से पैरवी करने हेतु ';
if($is_genrate == true){
$contents .= $post_data['advocate_name'];
}else
{
	$contents .=  '<input type="text" name="advocate_name" class="advocate_name_txt"  />';
}
 $contents .= ', शासकीय अधिवक्ता को नियुक्त किया जाना उचित होगा, साथ ही ';
 if($is_genrate == true){
$contents .= $post_data['advocate_name'];
}else
{
	$contents .=  '<input type="text" name="advocate_name" class="advocate_name_txt"  />';
}
$contents .= ', शासकीय अधिवक्ता द्वारा देयक प्रस्तुत करने पर उनके पाराश्रमिक एवं अन्य वास्तविक व्ययों का भुगतान शासन द्वारा प्रचलित नियमों के अनुसार प्रशासनिक विभाग द्वारा किया जएगा। </td></tr>';
$contents .= '<tr><td align="left"><p> 	आदेश की स्वच्छ प्रतियां हस्ताक्षरार्थ प्रस्तुत है।  </td></tr>';

if($this->uri->segment(6) == 'p' || $this->uri->segment(7) == 'p'  ){
$contents .= '<tr><td><u>अनुभाग अधिकारी (याचिका)</u></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>अवर सचिव (याचिका)</u></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>वरिष्ठ लेखाधिकारी</u></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>अति. सचिव (याचिका)</u></td></tr>';


}
?>
