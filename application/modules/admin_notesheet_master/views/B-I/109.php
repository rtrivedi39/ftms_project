<?php
$contents  = '' ;
$contents .= '<tr><td align="center"><b> फा0क्र0 3(ए)/';
if($is_genrate == true){
	$contents .= $post_data['number'];
}else{
	$contents .=  '<input type="text" class="" name="number"  />';
}
$contents .= '/'.date("Y").'/21-ब(एक)/'.$file_number.'</b></td></tr>';
$contents .= '<tr><td align="left"><span style="margin-left:8%"><b>';
if($is_genrate == true){ 
    $contents .=  $post_data['ad_name'];
} else {
    $contents .= '<input type="text" class="ad_name" name="ad_name"  value="श्री"/>';
}
$contents .= ' प्रधान न्यायाधीश, कुटुम्ब न्यायालय, भोपाल द्वारा 20 वर्ष की सेवा अवधि तथा 50 वर्ष की आयु पूर्ण होने पर स्वेक्षिक सेवानिवृत्ति लिये जाने </b></td></tr>';$contents .= '<tr><td align="center">------------</td></tr>';
$contents .= '<tr><td  align="center">पंजी क्रमांक  '.$file_number.'/21-ब(एक),  भोपाल, दिनांक  ';
if($is_genrate == true){
	$contents .= get_date_formate($post_data['date'],'d/m/Y');
}else{
    $contents .=  '<input type="text" class="date1" name="date" value="'.$file_mark_section_date.'" placeholder="dd/mm/yyyy" required>';
}
$contents .=  '</td></tr>';$contents .= '<tr><td align="center">-----000-------</td></tr>';
$contents .= '<tr><td><p>';
if($is_genrate == true){ 
    $contents .=   '<b>'.$post_data['ad_name'].'</b>';
} else {
    $contents .= '<input type="text" class="ad_name" name="ad_name"  value="श्री"/>';
}
$contents .= ', प्रधान न्यायाधीश,कुटुम्ब न्यायालय, भोपाल द्वारा प्रेषित आवेदन पत्र सहपत्र सहित का अवलोकन कीजिये |</p></td></tr> ';
$contents .= '<tr><td><p>उच्चतर न्यायिक सेवा के सदस्य  ';
if($is_genrate == true){ 
    $contents .=   '<b>'.$post_data['ad_name'].'</b>';
} else {
    $contents .= '<input type="text" class="ad_name" name="ad_name"  value="श्री"/>';
}
$contents .= ' की जन्मतिथि  ';
if($is_genrate == true){
	$contents .= get_date_formate($post_data['bdy_date'],'d/m/Y');
}else{
    $contents .=  '<input type="text" class="date1" name="bdy_date" value="" placeholder="dd/mm/yyyy" required>';
}
$contents .= '  तथा न्यायिक सेवा से उनकी सेवानिवृत्ति  होने की अधिवार्षिकी आयु ';
if($is_genrate == true){
	$contents .= get_date_formate($post_data['bdytil_date'],'d/m/Y');
}else{
    $contents .=  '<input type="text" class="date1" name="bdytil_date" value="" placeholder="dd/mm/yyyy" required>';
}
$contents .= ' को पूर्ण होगी |</p></td></tr>';
$contents .= '<tr><td><p>';
if($is_genrate == true){ 
    $contents .=  '<b>'.$post_data['ad_name'].'</b>';
} else {
    $contents .= '<input type="text" class="ad_name" name="ad_name"  value="श्री"/>';
}
$contents .= ' को सदस्य म.प्र.माध्यम अधिकरण भोपाल के पद पर (कार्यभार ग्रहण करने के दिनांक से 5 वर्ष की कालावधि अर्थात 65 वर्ष की आयु पूर्ण करने तक की अवधि के लिए) नियुक्ति हेतु कार्यालीन आदेश (न्यायिक शाखा-2) दिनांक  ';
if($is_genrate == true){
	$contents .= get_date_formate($post_data['tak_date'],'d/m/Y');
}else{
    $contents .=  '<input type="text" class="date1" name="tak_date" value="" placeholder="dd/mm/yyyy" required>';
}
$contents .= ' जारी किया गया है |</p></td></tr>';
$contents .= '<tr><td><p>';
if($is_genrate == true){ 
    $contents .=  '<b>'.$post_data['ad_name'].'</b>';
} else {
    $contents .= '<input type="text" class="ad_name" name="ad_name"  value="श्री"/>';
}
$contents .= ' द्वारा मध्यप्रदेश सिविल सेवा सर्विसेज पेंशन नियम,1976 के नियम 42(1)(क) के अंतर्गत निर्धारित प्रपत्र -28 पर आवेदन पत्र तैयार कर प्रस्तुत किया है, जिसकी एक प्रति उच्च न्यायालय, जबलपुर को प्रेषित की है, आवेदन पत्र में स्वेक्छिक सेवा निवृत्ति <b>नियमानुसार एक माह की सुचना अथवा एक माह के वेतन भत्ते की रकम जमा करने की अनिवार्यता से विमुक्त करने का </b> अनुरोध किया है |     ';
$contents .= '<tr><td><p>';
if($is_genrate == true){ 
    $contents .=   '<b>'.$post_data['ad_name'].'</b>';
} else {
    $contents .= '<input type="text" class="ad_name" name="ad_name"  value="श्री"/>';
}
$contents .= ' उच्चतर न्यायिक सेवा से 20 वर्ष की सेवा पूर्ण करने अथवा 50 वर्ष की आयु पूर्ण करने पर स्वेक्छिक सेवानिवृत्ति का निर्णय म.प्र.माध्यस्थम अधिकरण भोपाल में सदस्य के पद पर नामांकित किये जाने के फलस्वरूप लिया है, जो युक्तियुक्त है | </p></td></tr>   ';
$contents .= '<tr><td><p> अत: उक्त परिस्थिति पर विचार करते हुए राज्य शासन द्वारा स्वेक्छिक सेवानिवृत्ति की सूचना की एक माह की अवधि का अधित्यजन किया जाना उचित प्रतीत होता है | एक माह के नोटिस के संबंध में अधित्यजन किये जाने हेतु माननीय विधि मंत्रीजी का प्रशासकीय अनुमोदन एवं मुख्य सचिव के माध्यम से माननीय मुख्यमंत्रीजी के आदेश प्राप्त किया जाना प्रार्थित है | </p></td></tr>';
$contents .= '<tr><td><p>यह उल्लेखनीय  है कि मध्यप्रदेश के समस्त न्यायिक सेवा के सदस्यों की सेवा पर उच्च न्यायालय से आज दिनांक तक कोई प्रस्ताव/अनुशंसा प्राप्त नहीं है |</p></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><b><u>अनुभाग अधिकारी (बी -1)</u></b></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><b><u>अवर सचिव (बी -1)</u></b></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><b><u>सचिव (बी -1)</u></b></td></tr>';

?>

                
                
        
                  
                
               
                