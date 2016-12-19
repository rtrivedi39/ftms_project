<?php
$contents  = '' ;
$contents .= '<tr><td align="center"><b> फा0क्र0 3(ए)/';
if($is_genrate == true){
	$contents .= $post_data['number'];
}else{
	$contents .=  '<input type="text" class="" name="number"  />';
}
$contents .= '/'.date("Y").'/21-ब(एक)/'.$file_number.'</b></td></tr>';
$contents .= '<tr><td align="left"><span style="margin-left:8%"><b>प्रतियोगात्मक परीक्षा 2015 के माध्यम से 1 सिविल न्यायाधीश सीनियर डिविजन को मध्यप्रदेश उच्चतर न्यायिक सेवा (भर्ती तथा सेवाशर्ते) नियम, 1994, यथासंशोधित नियम 5(1)(ख) के अंतर्गत जिला न्यायाधीश (प्रवेश स्तर) के पद पर नियुक्ति के संबंध में |</b> </span></td></tr>';
$contents .= '<tr><td align="center">------------</td></tr>';
$contents .= '<tr><td  align="center">पंजी क्रमांक  '.$file_number.'/21-ब(एक),  भोपाल, दिनांक  ';
if($is_genrate == true){
$contents .= get_date_formate($post_data['date'],'d/m/Y');
}else
{
    $contents .=  '<input type="text" class="date1" name="date" value="'.$file_mark_section_date.'" placeholder="dd/mm/yyyy" required>';
}
$contents .=  '</td></tr>';$contents .= '<tr><td align="center">-----000-------</td></tr>';
$contents .= '<tr><td><p>उच्च न्यायालय ने अर्द्ध शासकीय पत्र क्र.  ';


if($is_genrate == true){ 
    $contents .=  '<b>'.$post_data['pad'].'</b>';
} else {
    $contents .= '<input type="text" class="pad" name="pad" placeholder=""  value=""/>';
}
$contents .= ' पदों के विरुध्द आयोजित परीक्षा में ';
if($is_genrate == true){ 
    $contents .=  '<b>'.$post_data['person_name'].'</b>';
} else {
    $contents .= '<input type="text" class="person_name" name="person_name" placeholder=""  value=""/>';
}
$contents .= '  को जिला न्यायाधीश (प्रवेश स्तर) के पद पर मध्यप्रदेश उच्चतर न्यायिक सेवा (भर्ती तथा सेवाशर्ते) नियम, 1994 यथासंशोधित नियम 5(1)(ख) के अंतर्गत सिविल न्यायाधीश वरिष्ठ श्रेणी संवर्ग के सदस्य की सिमित प्रतियोगिता परीक्षा के माध्यम से (योग्यता के आधार पर) पदोन्नति द्वारा जिला न्यायाधीश (प्रवेश स्तर)के पद पर नियुक्त किये जाने की अनुशंसा की है | </p></td></tr> ';
$contents .= '<tr><td><p>भारत के संविधान के अनुच्छेद 233 (1) के प्रावधानों के अनुसार उच्च न्यायालय के परामर्श से जिला न्यायाधीश के पद पर,नियुक्ति राज्य शासन द्वरा की जाती है, तथा संविधान के अनुच्छेद 235 के अनुसार अधीनस्थ न्यायालयों पर उच्च न्यायालय का प्रसासनिक नियंत्रण है उच्च न्यायालय द्वारा अधीनस्थ न्यायालयों के कार्य का पर्यवेक्षण किया जाता है |';
$contents .= '<tr><td><p>अत: माननीय उच्च न्यायालय की अनुशंसा के अनुसरण में मध्यप्रदेश उच्चतर न्यायिक सेवा (भर्ती तथा सेवाशर्ते) (संशोधित) नियम, 1994 के नियम 5(1) (ख) के प्रावधानों के अंतर्गत नियुक्ति के पूर्व माननीय विधि मंत्री जी का प्रशासकीय अनुमोदन प्राप्त किया जाना प्रस्तावित है तत्पश्चात मुख्य सचिव के माध्यम से माननीय मुख्यमंत्री जी का आदेश प्राप्त कर आवश्यक आदेश जारी किए जाएंगे | </p></td></tr> ';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><b><u>अनुभाग अधिकारी (बी -1)</u></b></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><b><u>अवर सचिव (बी -1)</u></b></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><b><u>सचिव (बी -1)</u></b></td></tr>';

?>

                
                
        
                  
                
               
                