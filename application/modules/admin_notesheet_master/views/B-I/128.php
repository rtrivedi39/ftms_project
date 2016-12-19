<?php
$contents  = '' ;
$contents .= '<tr><td align="left"><div style="margin-top:30px;"><span style="margin-left:10%;">';
if($is_genrate == true){ 
    $contents .=  ' <b>'.$post_data['subject'];
} else {
    $contents .= ' <textarea name="subject" style="margin: 0px; height: 40px; width: 80%;">म.प्र. में पदस्थ न्यायधिशों के जाती प्रमाण-पत्र की शिकायत के संबंध में जाँच |</textarea>';
}
$contents .= '</b></td></tr>';
$contents .= '<tr><td align="center">------------</td></tr>';
$contents .= '<tr><td  align="center">पंजी क्रमांक  '.$file_number.'/21-ब(एक),  भोपाल, दिनांक  ';
if($is_genrate == true){
	$contents .= get_date_formate($post_data['date'],'d/m/Y');
}else{
    $contents .=  '<input type="text" class="date1" name="date" value="'.$file_mark_section_date.'" placeholder="dd/mm/yyyy" required>';
}
$contents .=  '</td></tr>';$contents .= '<tr><td align="center">-----000-------</td></tr>';
$contents .= '<tr><td><p>कृपया कार्यालय आयुक्त आदिवासी विकास म.प्र. के ज्ञापन दिनांक    ';
if($is_genrate == true){
	$contents .= get_date_formate($post_data['gyapan_date'],'d/m/Y');
}else{
    $contents .=  '<input type="text" class="date1" name="gyapan_date" value="'.$file_uo_or_letter_date.'" placeholder="dd/mm/yyyy" required>';
}
$contents .= ' का अवलोकन कीजिये |</p></td></tr> ';
$contents .= '<tr><td><p>उक्त संबंध में कार्यालयिन ज्ञापन दिनांक ';
if($is_genrate == true){
	$contents .= get_date_formate($post_data['gyapan_date'],'d/m/Y');
}else{
    $contents .=  '<input type="text" class="date1" name="gyapan_date" value="'.$file_uo_or_letter_date.'" placeholder="dd/mm/yyyy" required>';
}
$contents .= ' के संबंध में कार्यालय आयुक्त, आदिवासी विकास म.प्र. ने सरल क्र. 1 से 18 तक से संबंधी वर्तमान में की गई कार्यवाही से अवगत कराया है, जिसमें 3, 11, 13 एवं 16 के संबंध में आयुक्त, आदिम जाती अनुसंधान एवं प्रशिक्षण संस्थान ';
if($is_genrate == true){
	$contents .=  '<b>'.$post_data['location'].'</b>';
}else{
    $contents .=  '<input type="text" class="location" name="location" value="" placeholder="" required>';
}
$contents .= ' शासन आयुक्त, पिछड़ा वर्ग कल्याण,सतपुड़ा भवन, भोपाल तथा आयुक्त,अनुसूचित जाति विकास म.प्र. से आवश्यक कार्यवाही हेतु संपर्क करने का लेख है | साथ ही ';
if($is_genrate == true){
	$contents .=  '<b>'.$post_data['ad_name'].'</b>';
}else{
    $contents .=  '<input type="text" class="ad_name" name="ad_name" value="" placeholder="" required>';
}
$contents .= ' एक ही अधिकारी है, इस विवरण की जाँच कर स्थिति स्पष्ट करने का अनुरोध भी किया है | </p></td></tr>';
$contents .= '<tr><td><p>उपरोक्त स्थिति में अनुरोध है कि आयुक्त,आदिवासी विकास द्वरा  ';
if($is_genrate == true){
	$contents .=  '<b>'.$post_data['ad_name'].'</b>';
}else{
    $contents .=  '<input type="text" class="ad_name" name="ad_name" value="" placeholder="" required>';
}
$contents .= ' एक ही अधिकारी है, इसी पुष्टि करने का अनुरोध किया है जिसके संबंध में अनुरोध है कि उपलब्ध अभिलेख /नस्ती अनुसार  ';
if($is_genrate == true){
	$contents .=  '<b>'.$post_data['ad_name'].'</b>';
}else{
    $contents .=  '<input type="text" class="ad_name" name="ad_name" value="" placeholder="" required>';
}
$contents .= ' एक ही अधिकारी होना प्रतीत होता है, एक ही अधिकारी के नाम का उल्लेख दो अलग अलग प्रकार से किया गया है, जिसके संबंध में संबंधित विभाग को नस्ती के अनुमोदन पश्चात अवगत कराया जाना प्रस्तावित है |</p></td></tr>';
$contents .= '<tr><td><p>अत: प्राप्त पत्र की छायाप्रति उच्च न्यायालय की ओर प्रेषित कर सूची में उल्लेखित सरल क्र.1 पर अंकित  ';
if($is_genrate == true){
	$contents .=  '<b>'.$post_data['person_name'].'</b>';
}else{
    $contents .=  '<input type="text" class="person_name" name="person_name" value="" placeholder="" required>';
}
$contents .= ' के संदेहास्पद जाति प्रमाण एवं सेवापुस्तिका के प्रथम पृष्ठ की अभिप्रमाणित प्रति तथा स्थायी वर्तमान पते की जानकारी मंगाया जाना एवं सरल क्र. 18 पर अंकित  ';
if($is_genrate == true){
	$contents .=  '<b>'.$post_data['person_name2'].'</b>';
}else{
    $contents .=  '<input type="text" class="person_name2" name="person_name2" value="" placeholder="" required>';
}
$contents .= ' के संबंध में उच्च न्यायालय को की गई कार्यवाही से अवगत कराते हुए उपरोक्तानुसार अन्य विभागो को भी पत्र जारी किया जाना उचित होगा | ';
$contents .= ' के संबंध में उच्च न्यायालय को की गई कार्यवाही से अवगत कराते हुए उपरोक्तानुसार अन्य विभागो को भी पत्र जारी किया जाना उचित होगा | ';
$contents .= '<tr><td><p>भेजे जाने वाले ज्ञापन का प्रारूप अनुमोदनार्थ प्रस्तुत है |</p></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><b><u>अनुभाग अधिकारी (बी -1)</u></b></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><b><u>अवर सचिव (बी -1)</u></b></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><b><u>सचिव (बी -1)</u></b></td></tr>';

?>

                
                
        
                  
                
               
                