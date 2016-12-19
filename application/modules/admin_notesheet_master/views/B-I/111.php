<?php
$contents  = '' ;
$contents .= '<tr><td align="left"><div style="margin-top:20px;"><span style="margin-left:10%;">न्यायिक अधिकारी की सेवाएँ  प्रतिनियुक्ति से वापस लेकर उच्च न्यायालय को  सोपने के संबंध में|</td></tr>';
$contents .= '<tr><td align="center">------------</td></tr>';
$contents .= '<tr><td align="center">पंजी क्रं '.$file_number.'/'.date('Y').'/21-ब(एक), दिनांक ';
if($is_genrate == true){ 
    $contents .=  get_date_formate($post_data['panjidate'],'d.m.Y');
} else {
    $contents .= '<input type="text" class="date1" name="panjidate"  value="'.$today.'"/>';
}
$contents .= '</td></tr>';
$contents .= '<tr><td align="center">-----000-------</td></tr>';
$contents .= '<tr><td><p>रजिस्ट्री, मध्यप्रदेश उच्च न्यायलय के आदेश क्रमांक ';
if($is_genrate == true){ 
    $contents .=  $post_data['adeshkreamank'];
} else {
    $contents .= ' <input type="text" class="" name="adeshkreamank"  value=""/>';
}
$contents .= ', दिनांक  ';
if($is_genrate == true){ 
    $contents .=  get_date_formate($post_data['uodate1'],'d.m.Y');
} else {
    $contents .= ' <input type="text" class="date1" name="uodate1"  value="'.get_date_formate($file_uo_or_letter_date1,'d/m/Y').'"/>';
}
 $contents .= ' का अवलोकन कीजिये| </p></td></tr>';
$contents .= '<tr><td><p>उच्च न्यायालय से प्राप्त उक्त स्थानातारण आदेश के परिपालन में '.$sl_name.' सचिव, विधि एवं  विधायी कार्य विभाग की सेवाएँ उच्च न्यायालय को वापस सोपा जाना प्रस्तावित है|</p></td></tr> ';
$contents .= '<tr><td><p>अतः यदि मान्य किया जाए तो आवश्यक आदेश जरी किए जाने के पूर्व प्रस्ताव पर माननीय विधि मंत्रीजी का प्रशासकीय अनुमोदन प्राप्त किया जाना उचित होगा| आदेश का प्रारूप अनुमोदनार्थ प्रस्तुत है|</p></td></tr> ';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><b>अनुभाग अधिकारी (बी-1)</b></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><b>अवर सचिव  (बी-1)</b></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><b>सचिव (बी-1)</b></td></tr>';

?>

                
                
        
                  
                
               
                