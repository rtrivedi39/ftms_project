<?php
$contents  = '' ;
$contents .= '<tr><td align="center"><b> फा0क्र0 3(ए)/';
if($is_genrate == true){
	$contents .= $post_data['number'];
}else{
	$contents .=  '<input type="text" class="" name="number"  />';
}
$contents .= '/'.date("Y").'/21-ब(एक)/'.$file_number.'</b></td></tr>';
$contents .= '<tr><td align="left"><div style="margin-top:30px;"><span style="margin-left:10%;">';
if($is_genrate == true){ 
    $contents .=  ' <b>'.$post_data['subject'];
} else {
    $contents .= ' <textarea name="subject" style="margin: 0px; height: 40px; width: 80%;">जिला न्यायाधीश (प्रवेश स्तर)  परीक्षा में चयनित अभ्यर्थी  की नियुक्ति -</textarea>';
}
$contents .= '</b></td></tr>';
$contents .= '<tr><td align="center">------------</td></tr>';
$contents .= '<tr><td>मूल नस्ती क्रं  3(बी) ' .$file_number.'/'.date('Y').'/21-ब(एक) के नोट पृष्ठ ';
if($is_genrate == true){ 
    $contents .=  $post_data['page_no'];
} else {
    $contents .= '<input type="text"  name="page_no"  value=""/>';
}
$contents .= ' पर माननीय विधि मंत्रीजी का अनुमोदन प्राप्त हो चुका है चयनित अभ्यर्थी के नियुक्ति आदेश जारी करने के पूर्व निम्नलिखित आवश्यक औपचारिक्तायें सम्बंधित कार्यालयों से अपेक्षित है जिन्हें पत्राचार के माध्यम से किया जाना प्रस्तावित है :- </td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td>1 . संभागीय संयुक्त संचालक / अध्यक्ष चिकित्सा सेवांए ';
if($is_genrate == true){ 
    $contents .=  $post_data['service'];
} else {
    $contents .= '<input type="text"  name="service"  value=""/>';
}
$contents .= '</td></tr> ';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td>2. चरित्र सत्यापन जांच प्रतिवेदन प्राप्त किये जाने हेतु सम्बंधित जिला पुलिस अधीक्षक ';
if($is_genrate == true){ 
    $contents .=  $post_data['officer'];
} else {
      $contents .= '<input type="text"  name="officer"  value=""/>';
}
$contents .= '</td></tr> ';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td>3. पुलिस उप महानिरीक्षक म.प्र.  ';
if($is_genrate == true){ 
    $contents .=  $post_data['officer1'];
} else {
      $contents .= '<input type="text"  name="officer1"  value=""/>';
}
$contents .= '</td></tr> ';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td>4. जाति प्रमाण पत्र जांच आवेदन प्राप्त किये जाने हेतु  सम्बंधित जिला कलेक्टर  ';
if($is_genrate == true){ 
    $contents .=  $post_data['dist_calacter'];
} else {
      $contents .= '<input type="text"  name="dist_calacter"  value=""/>';
}
$contents .= '</td></tr> ';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td>5. अनापत्ति प्रमाण पत्र किये जाने हेतु  ';
if($is_genrate == true){ 
    $contents .=  $post_data['certificate'];
} else {
    $contents .= '<input type="text"  name="certificate"  value=""/>';
}

$contents .= '</td></tr> ';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><p>प्रस्ताव सहित पत्र की स्वच्छ प्रतियां अनुमोदनार्थ /हस्ताक्षरथ सादर प्रस्तुत | </p></td></tr> ';
$contents .= '<tr><td>&nbsp;</td></tr>';
if($this->uri->segment(6) == 'p' || $this->uri->segment(7) == 'p'  ){
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><b><u>अनुभाग अधिकारी (बी -1)</u></b></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><b><u>अवर सचिव (बी -1)</u></b></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><b><u>सचिव (बी -1)</u></b></td></tr>';
}
?>

                
                
        
                  
                
               
                