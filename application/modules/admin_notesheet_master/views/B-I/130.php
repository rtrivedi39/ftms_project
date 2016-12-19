<?php
$contents  = '' ;
$contents .= '<tr><td align="left"><div style="margin-top:30px;"><span style="margin-left:10%;">';
if($is_genrate == true){ 
    $contents .=  ' <b>'.$post_data['subject'];
} else {
    $contents .= ' <textarea name="subject" style="margin: 0px; height: 40px; width: 80%;">नवीन, स्वीकृत पदों की डी.डी.ओ.क्रं.................. में प्रविष्टि किये जाने के संबंध में |</textarea>';
}
$contents .= '</b></td></tr>';
 $contents .= '<tr><td align="center">------000------</td></tr>';
$contents .= '<tr><td align="center">पंजी क्रं '.$file_number.'/'.date('Y').'/21-ब(एक), दिनांक ';
if($is_genrate == true){ 
    $contents .=  get_date_formate($post_data['panjidate'],'d.m.Y');
} else {
    $contents .= '<input type="text" class="date1" name="panjidate"  value="'.$today.'"/>';
}
$contents .= '</td></tr>';$contents .= '<tr><td align="center">------000------</td></tr>';
$contents .= '<tr><td><p>कृपया रजिस्ट्रार (प्रशासन) मध्यप्रदेश उच्च न्यायालय, जबलपुर के पृष्ठांकन क्रमांक  ';
if($is_genrate == true){ 
    $contents .=  $post_data['patrano'];
} else {
    $contents .= '<input type="text" class="" name="patrano"  value=""/>';
}
$contents .= ' दिनांक  ';
if($is_genrate == true){ 
    $contents .=  get_date_formate($post_data['agedate'],'d.m.Y');
} else {
    $contents .= '<input type="text" class="date1" name="agedate"  value=""/>';
}
$contents .= ' का अवलोकन करने का कष्ट करें |</p></td></tr>';
$contents .= '<tr><td><p>उक्त ज्ञापन में क्रमांक 1 से 11 तक उल्लेखित नवीन स्वीकृत पदों की डी.डी.ओ.क्रं ';
if($is_genrate == true){ 
    $contents .=  $post_data['ddo_no'];
} else {
    $contents .= '<input type="text" class="ddo_no" name="ddo_no"  value=""/>';
}
$contents .= ' में प्रविष्टि किये जाने के कार्यालय कोष एवं लेखा संचालनालय द्वारा किया जाना अपेक्षित है | जिसके संबंध में उच्च न्यायालय ने आयुक्त,कोष एवं लेखा को ज्ञापन प्रेषित कर इस कार्यालय से भी अनुरोध किया है |</p></td></tr>';
$contents .= '<tr><td><p>आयुक्त,कोष एवं लेखा तथा रजिस्ट्रार,प्रशासन उच्च न्यायालय को प्रेषित किये जाने वाले ज्ञापन की स्वच्छ प्रति अनुमोदन व हस्ताक्षर हेतु सादर प्रस्तुत है |</p></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><b><u>अनुभाग अधिकारी (बी -1)</u></b></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><b><u>अवर सचिव (बी -1)</u></b></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><b><u>सचिव (बी -1)</u></b></td></tr>';


?>

                
                
        
                  
                
               
                