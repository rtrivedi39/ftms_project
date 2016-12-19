<?php
$contents  = '' ;
$contents .= '<tr><td align="center">फा0क्र0 1-1/2002/21-ब(एक)</td></tr>';
$contents .= '<tr><td align="left"><span style="margin-left:8%">सूचना का अधिकार, अधिनियम,2005  धारा 6(1)  के अंतर्गत जानकारी - आवेदक  ';
if($is_genrate == true){ 
    $contents .=  $post_data['applicaint'];
} else {
    $contents .= '<input type="text"  name="applicaint"  value=""/>';
}
 $contents .= '</span></td></tr>';
 $contents .= '<tr><td align="center">------000------</td></tr>';
$contents .= '<tr><td align="center">पंजी क्रं '.$file_number.'/'.date('Y').'/21-ब(एक), दिनांक ';
if($is_genrate == true){ 
    $contents .=  get_date_formate($post_data['panjidate'],'d.m.Y');
} else {
    $contents .= '<input type="text" class="date1" name="panjidate"  value="'.$today.'"/>';
}
$contents .= '</td></tr>';$contents .= '<tr><td align="center">------000------</td></tr>';
$contents .= '<tr><td><p> क्रपया अपीलय अधिकारी, सूचना का अधिकार प्रकोष्ठ की टीप दिनांक ';
if($is_genrate == true){ 
    $contents .=  get_date_formate($post_data['agedate'],'d.m.Y');
} else {
    $contents .= '<input type="text" class="date1" name="agedate"  value=""/>';
}


$contents .= 'का अवलोकन कीजिये |</p></td></tr>';

$contents .= '<tr><td><p>उक्त टीप के पैरा  6 में उल्लेखित अनुसार चाही गई छायाप्रतियां सत्यापित कर समुचित कार्यवाही हेतु संलग्न है तथा पैरा -7 से सम्बंधित नस्ती प्रक्रियाधीन है |</p></td></tr> ';
$contents .= '<tr><td><p><b>(प्रमुख सचिव, विधि द्वारा अनुमोदित) </b></p></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">(<b>'.$so_name.'</b>)</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;"><b>अनुभाग अधिकारी</b></div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;"><b>न्यायिक शाखा - 1</b></div></td></tr>';
$contents .= '<tr><td><p><b>राज्य लोक सूचना अधिकारी </b></p></td></tr> ';


?>

                
                
        
                  
                
               
                