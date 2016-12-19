<?php
$contents  = '' ;
$contents .= '<tr><td align="left"><div style="margin-top:20px;"><span style="margin-left:10%;">सुचना के अधिकार अधिनियम, 2005 धरा 6(1) के अन्तर्गत जानकारी-  आवेदक ';
if($is_genrate == true){ 
    $contents .=  $post_data['avedakname'];
} else {
    $contents .= ' <input type="text" class="" name="avedakname"  value=""/>';
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
$contents .= '<tr><td><p>कृपया अपीलय अधिकारी, सुचना का अधिकार प्रकोष्ठ की टीप दिनांक ';
if($is_genrate == true){ 
    $contents .=  get_date_formate($post_data['tipdate'],'d.m.Y');
} else {
    $contents .= ' <input type="text" class="date1" name="tipdate"  value=""/>';
}
$contents .= ' का अवलोकन कीजिये| </p></td></tr>';
$contents .= '<tr><td><p>उक्त टीप के बिंदु क्रं. ';
if($is_genrate == true){ 
    $contents .=  $post_data['bindu'];
} else {
    $contents .= ' <input type="text" class="" name="bindu"  value="6"/>';
}
$contents .= ' के संबंध में राज्य लोक सूचना अधिकारी को जानकारी दिनांक ';
if($is_genrate == true){ 
    $contents .=  get_date_formate($post_data['jandkaridate'],'d.m.Y');
} else {
    $contents .= ' <input type="text" class="date1" name="jandkaridate"  value=""/>';
}
$contents .= ' को प्रदान की जा चुकी है| यह भी उल्लेखनीय है कि जानकारी दिये जाने के पूर्व भी प्रकरण से सम्बंधित मूल नस्ती आवश्यक समाधान एवं अवलोकन हेतु राज्य लोक सूचना अधिकारी से कोई जानकारी आज दिनक तक प्राप्त नहीं हुई है, जिससे प्रकरण में न्यायिक शाखा -1 द्वारा कोई कार्यवाही अपेक्षित होना प्रतीत नहीं होता है|</p></td></tr> ';
$contents .= '<tr><td><p>अतः अनुमोदन पश्चात टीप की एक प्रति राज्य लोक सुचना अधिकारी एवं अपीलीय अधिकारी को प्रेषित की जाना प्रस्तावित है|</p></td></tr> ';
$contents .= '<tr><td><p>प्रकरण अनुमोदनार्थ प्रस्तुत है|</p></td></tr> ';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><b>अनुभाग अधिकारी (बी-1)</b></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><b>अवर सचिव  (बी-1)</b></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><b>सचिव (बी-1)</b></td></tr>';

?>

                
                
        
                  
                
               
                