<?php
$contents  = '' ;
$contents .= '<tr><td align="left"><div style="margin-top:20px;"><span style="margin-left:10%;">';
if($is_genrate == true){ 
    $contents .=  ' '.$post_data['subject'];
} else {
    $contents .= ' <textarea name="subject" style="margin: 0px; height: 40px; width: 80%;">'.$file_subject.'</textarea>';
}
$contents .= '</td></tr>';
$contents .= '<tr><td align="center">------------</td></tr>';
$contents .= '<tr><td align="center">पंजी क्रं '.$file_number.'/'.date('Y').'/21-ब(एक), दिनांक ';
if($is_genrate == true){ 
    $contents .=  get_date_formate($post_data['panjidate'],'d.m.Y');
} else {
    $contents .= '<input type="text" class="date1" name="panjidate"  value="'.$today.'"/>';
}
$contents .= '</td></tr>';
$contents .= '<tr><td align="center">-----000-------</td></tr>';
$contents .= '<tr><td><p>कृपया अधोस्थित ज्ञापन का अवलोकन कीजिये| </p></td></tr> ';
$contents .= '<tr><td><p>उच्च न्यायालय ने अपने  ज्ञापन क्रं.  ';
if($is_genrate == true){ 
    $contents .=  $post_data['gyapankra'];
} else {
    $contents .= ' <input type="text" class="" name="gyapankra"  value=""/>';
}
$contents .= ' जबलपुर दिनांक  ';
if($is_genrate == true){ 
    $contents .=  get_date_formate($post_data['uodate1'],'d.m.Y');
} else {
    $contents .= ' <input type="text" class="date1" name="uodate1"  value="'.get_date_formate($file_uo_or_letter_date1,'d/m/Y').'"/>';
}
 $contents .= ' (फैक्स प्रति) द्वारा "मांग संख्या  ';
if($is_genrate == true){ 
    $contents .=  $post_data['nyaysankhya'];
} else {
    $contents .= ' <input type="text" class="" name="nyaysankhya"  value=""/>';
}
$contents .= ' -न्याय प्रशासन के अंतर्गत चालू वित्तीय वर्ष  ';
if($is_genrate == true){ 
    $contents .=  $post_data['age'];
} else {
    $contents .= ' <input type="text" class="" name="age"  value=""/>';
}
$contents .= ' हेतु उच्च न्यायलय (भारित )  एवं  अधिनस्त न्यायलय (मतदेय ) से सम्बन्धी योजनाओं को म. प्र. शासन, वित्त विभाग मंत्रालय, भोपाल द्वारा अधिरोपित क्रय पर पूर्ण प्रतिबंध से विमुक्त रखे जाने" का अनुरोध किया है|';
$contents .= '<tr><td><p>अतः उक्त नयायालय से प्राप्त प्रस्ताव, ज्ञापन की प्रति सहित आवश्यक सहमती प्रदान किये जाने हेतु वित्त विभाग को अंकित जाना पप्रस्तावित है| </p></td></tr> ';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><b>अनुभाग अधिकारी (बी-1)</b></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><b>अवर सचिव  (बी-1)</b></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><b>अतिरिक्त सचिव (बी-1)</b></td></tr>';

?>

                
                
        
                  
                
               
                