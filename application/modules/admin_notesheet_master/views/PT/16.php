<?php
$contents  = '' ;
$contents .= '<tr><td align="left"><div style="margin-top:20px;"><span style="margin-left:10%;">नेशनल ग्रीन ट्रीब्युनल सेन्ट्रल जोन ';

if($is_genrate == true){ 
    $contents .=  ' '.$post_data['ddl_ngtstate'];
} else {
    $contents .= ' <select name="ddl_ngtstate" id="ddl_ngtstate" ><option>दिल्ली</option><option>भोपाल</option></select>';
}
$contents .= ' में आवेदन क्रं0 '.@$file_uo_or_letter_no;
if($is_genrate == true){ 
    $contents .=  ' '.$post_data['agenst_name'];
} else {
    $contents .= ' <input type="text" class="" name="agenst_name" value="'.$agenst_name.'" />';
}
$contents .= ' विरुद्ध ';
if($is_genrate == true){ 
    $contents .=  $post_data['agenst'];
} else {
    $contents .= ' <input type="text" class="" name="agenst" value="'.$agenst.'" />';
}
$contents .= ' एवं अन्य में प्रतिरक्षण बाबत ।</span></div></td></tr>';
$contents .= '<tr><td align="center">----------------</td></tr>';
$contents .= '<tr><td align="center"><div style="float:left;">पंजी क्रमांक : '.@$file_number.'/21-क(या0),</div><div style="float:right;">दिनांक ';
if($is_genrate == true){ 
    $contents .=  get_date_formate(@$post_data['date1'],'d/m/Y');
} else {
    $contents .= '<input type="text" class="date1" name="date1" placeholder="dd/mm/yyyy" value="'.@$file_mark_section_date.'"/></div>';
}
$contents .= '</td></tr>';
$contents .= '<tr><td align="center"><div style="float:left;">यू.ओ. क्रमांक :'.@$file_uo_or_letter_no.'</div><div style="float:right;">दिनांक '.get_date_formate($file_uo_or_letter_date,'d/m/Y').'</div>';
$contents .= '<tr><td align="center">-----0-----</td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><p>कृपया प्रशासकीय विभाग ';
$contents .= $file_department;
$contents .= ' की नस्ती का अवलोकन करें।</p></td></tr>';
$contents .= '<tr><td><p>उपरोक्त विषयांकित प्रकरण में प्रशासकीय विभाग ने  नेशनल  ग्रीन  ट्रीब्युनल सेन्ट्रल जोन ';
if($is_genrate == true){ 
    $contents .=  ' '.$post_data['ddl_ngtstate'];
} else {
    $contents .= ' <select name="ddl_ngtstate" class="ddl_ngtstate" ><option>दिल्ली</option><option>भोपाल</option></select>';
}
$contents .= ' में शासन की ओर से पक्ष-समर्थन करने हेतु नस्ती इस विभाग को प्रेषित की है। नेशनल ग्रीन  ट्रीब्युनल सेन्ट्रल जोन ';
if($is_genrate == true){ 
    $contents .=  ' '.$post_data['ddl_ngtstate'];
} else {
    $contents .= ' <select name="ddl_ngtstate" class="ddl_ngtstate" ><option>दिल्ली</option><option>भोपाल</option></select>';
}
$contents .= ' में शासन की ओर से पक्ष समर्थन करने हेतु ';
if($is_genrate == true){ 
    $contents .=  '<b>'.@$post_data['name2'].'</b>';
} else {
    $contents .= '<input type="text" class="" name="name2" /></div>';
}
$contents .= ' अधिवक्ता नियुक्त है ।</p></td></tr>';
$contents .= '<tr><td><p>उपरोक्त विषयांकित प्रकरण में मध्यप्रेश शासन की ओर से पक्ष-समर्थन करने हेतु ';
if($is_genrate == true){ 
    $contents .=  '<b>'.@$post_data['name2'].'</b>';
} else {
    $contents .= '------------';
}
$contents .= ' अधिवक्ता की नियुक्ति शासन द्वारा प्रचलित नियमों के अनुसार उनके फीस का भुगतान प्रशासकीय विभाग द्वारा किये जाने का उल्लेख करते हुये नियुक्त किया जाना उचित होगा।</p></td></tr>';
if($this->uri->segment(6) == 'p' || $this->uri->segment(7) == 'p'  ){
$contents .= '<tr><td><u>अनुभाग अधिकारी (याचिका)</u></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>अवर सचिव (याचिका)</u></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>अति. सचिव (याचिका)</u></td></tr>';
}
?>
