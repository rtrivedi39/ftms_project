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
    $contents .= '<textarea name="subject" style="margin: 0px; height: 40px; width: 80%;">पेंशन पप्रकरण  '.$file_subject.'</textarea>';
}
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><div style="float:left">पंजी क्रमांक  '.$file_number.'/21-ब(एक),  </div><div style="float:right">भोपाल, दिनांक  ';
if($is_genrate == true){
$contents .= get_date_formate($post_data['date'],'d/m/Y').'</div></td></tr>';
}else
{
    $contents .=  '<input type="text" class="date1" name="date" value="'.$file_mark_section_date.'" placeholder="dd/mm/yyyy" required>';
}
$contents .=  '</div></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td align="center"> -------000------- </td></tr>';
$contents .= '<tr><td><p>कृपया विचाराधीन पत्र का सहपत्रों सहित अवलोकन करने का कष्ट करें|</p></td></tr>';
$contents .= '<tr><td><p>उच्च न्यायालय, जबलपुर ने श्री ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['pansonar_name'].'</b>';
}else{
	$contents .= '<input type="text" size="50px" name="pansonar_name" placeholder="" value="'.$file_subject.'">';
}
$contents .= ' के पेंशन प्रकरण में कोअंतिम रूप देते हुए पेंशन सम्बन्धी आवश्यक दस्तावेज एवं सेवा पुस्तिका सहित भेजकर पेंशन भुगतान आदेश हेतु अनुरोध किया है ।</p> </td></tr>';
$contents .= ' <tr><td><p>उक्त संभंध मे लेख है कि उच्च न्यायालय, जबलपुर से प्राप्त पेंशन सम्बन्धी दस्तावेज सेवापुस्तिका सहित जिला पेंशन अधिकारी , भोपाल को आवश्यक आदेश जरी करने हेतु भेजा जाना प्रस्तावित है।</p> </td></tr>';
$contents .= ' <tr><td><p>ज्ञापन की स्वच्छ प्रतियॉ हस्ताक्षरार्थ प्रस्तुत है ।</p> </td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
if($this->uri->segment(6) == 'p' || $this->uri->segment(7) == 'p'  ){
$contents .= '<tr><td><u>अनुभाग अधिकारी (बी-I)</u></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>अवर सचिव (बी-I)</u></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>सचिव (बी-I)</u></td></tr>';
}
$contents .= '</table>';