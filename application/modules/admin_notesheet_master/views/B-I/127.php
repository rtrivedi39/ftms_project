<?php
$contents  = '' ;
$contents .= '<tr><td align="left"><span style="margin-left:8%"><b>न्यायिक अधिकायों की सेवाएं श्रम विभाग को सौंपने के संबंध मे|</b> </span></td></tr>';
$contents .= '<tr><td align="center">------------</td></tr>';
$contents .= '<tr><td  align="center">पंजी क्रमांक  '.$file_number.'/21-ब(एक),  भोपाल, दिनांक  ';
if($is_genrate == true){
$contents .= get_date_formate($post_data['date'],'d/m/Y');
}else
{
    $contents .=  '<input type="text" class="date1" name="date" value="'.$file_mark_section_date.'" placeholder="dd/mm/yyyy" required>';
}
$contents .=  '</td></tr>';$contents .= '<tr><td align="center">-----000-------</td></tr>';
$contents .= '<tr><td><p>रजिस्ट्री, मध्यप्रदेश उच्च न्यायालय से प्राप्त अर्द्ध शासकीय पत्र क्रमांक   ';
if($is_genrate == true){ 
    $contents .=  $post_data['patrano'];
} else {
    $contents .= '<input type="text" class="" name="patrano"  value=""/>';
}
$contents .= ', दिनांक  '.get_date_formate($file_uo_or_letter_date,'d/m/Y');
$contents .= ' का अवलोकन कीजिये |</p></td></tr> ';
$contents .= '<tr><td><p>उच्च न्यायालय ने उक्त अर्द्ध शासकीय पत्र में औद्योगिक विवाद अधिनिम, 1947 (1947का 14) की धारा-7 की उपधारा (3) के अंतर्गत निम्नानुसार न्यायिक अधिकारियों की सेवाएं श्रम न्यायालय में पीठासीन अधिकारी के पद पर नियुक्त किये जाने हेतु सौंपे जाने की अनुशंसा की हैं </p></td></tr> ';
$contents .= '<tr><td>';
if($is_genrate == true){ 
    $contents .=  $post_data['subject'];
} else {
    $contents .= '<textarea name="subject" style="margin: 0px; height: 40px; width: 80%;"></textarea>';
}
$contents .= '</td></tr>';
$contents .= '<tr><td><p>प्रस्ताव पर माननीय विधि मंत्रीजी का प्रशासकीय अनुमोदन प्राप्त किये जाने के पश्चात श्रम विभाग को प्रेषित किया जाना प्रस्तावित है |</p></td></tr> ';
$contents .= '<tr><td><p>प्रकरण अनुमोदनार्थ प्रस्तुत | </p></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><b><u>अनुभाग अधिकारी (बी -1)</u></b></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><b><u>अवर सचिव (बी -1)</u></b></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><b><u>सचिव (बी -1)</u></b></td></tr>';

?>  