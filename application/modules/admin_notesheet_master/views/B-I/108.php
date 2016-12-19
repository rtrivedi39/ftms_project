<?php
$contents  = '' ;
$contents .= '<tr><td align="left"><span style="margin-left:8%"><b>';
if($is_genrate == true){ 
    $contents .=  $post_data['ad_name'];
} else {
    $contents .= '<input type="text" class="ad_name" name="ad_name" placeholder="नाम"  value=""/>';
}
$contents .= ', ';
if($is_genrate == true){ 
    $contents .=  $post_data['ad_designation'];
} else {
    $contents .= '<input type="text" class="ad_designation" name="ad_designation" placeholder="पद"  value=""/>';
}
$contents .= ', कुटुम्ब न्यायालय, ';
if($is_genrate == true){
	$contents .= $post_data['distic_1'];
}else
{
$contents  .= get_distic_dd('distic_1');	
}

$contents .= ' के त्यागपत्र के संबंध में |</b> </span></td></tr>';
$contents .= '<tr><td align="center">------------</td></tr>';
$contents .= '<tr><td  align="center">पंजी क्रमांक  '.$file_number.'/21-ब(एक),  भोपाल, दिनांक  ';
if($is_genrate == true){
$contents .= get_date_formate($post_data['date'],'d/m/Y');
}else
{
    $contents .=  '<input type="text" class="date1" name="date" value="'.$file_mark_section_date.'" placeholder="dd/mm/yyyy" required>';
}
$contents .=  '</td></tr>';$contents .= '<tr><td align="center">-----000-------</td></tr>';
$contents .= '<tr><td><p>कृपया रजिस्ट्रार जरनल, म. प्र. उच्च न्यायालय के अर्द्धशासकीय पत्र  ';
if($is_genrate == true){ 
    $contents .=  $post_data['patrano'];
} else {
    $contents .= '<input type="text" class="" name="patrano"  value=""/>';
}
$contents .= ', दिनांक  '.get_date_formate($file_uo_or_letter_date,'d/m/Y').' का अवलोकन कीजिये| </p></td></tr> ';
$contents .= '<tr><td><p>उच्च न्यायालय ने ';
if($is_genrate == true){ 
    $contents .=  '<b>'.$post_data['ad_name'].'</b>';
} else {
    $contents .= '<input type="text" class="ad_name" name="ad_name" placeholder="नाम"  value=""/>';
}
$contents .= ', ';
if($is_genrate == true){ 
    $contents .=  '<b>'.$post_data['ad_designation'].'</b>';
} else {
    $contents .= '<input type="text" class="ad_designation" name="ad_designation" placeholder="पद"  value=""/>';
}
$contents .= ', कुटुम्ब न्यायालय, ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['distic_1'].'</b>';
}else
{
$contents  .= get_distic_dd('distic_1');	
}

$contents .= ' के त्यागपत्र  दिनांक ';
if($is_genrate == true){ 
    $contents .=  get_date_formate($post_data['agedate'],'d.m.Y');
} else {
    $contents .= '<input type="text" class="date1" name="agedate"  value=""/>';
}


$contents .= ' प्रेषित करते हुए उक्त त्यागपत्र , दिनांक  '.get_date_formate($file_uo_or_letter_date,'d/m/Y').' से स्वीकृत किये जाने की अनुशंसा की है|  ';

$contents .= '<tr><td><p>उच्च न्यायालय की अनुशंसा अनुसार ';
if($is_genrate == true){ 
    $contents .= '<b>'.$post_data['ad_name'].'</b>';
} else {
    $contents .= '<input type="text" class="ad_name" name="ad_name" placeholder="नाम"  value=""/>';
}
$contents .= ', ';
if($is_genrate == true){ 
    $contents .=  '<b>'.$post_data['ad_designation'].'</b>';
} else {
    $contents .= '<input type="text" class="ad_designation" name="ad_designation" placeholder="पद"  value=""/>';
}
$contents .= ' का त्यागपत्र ';
if($is_genrate == true){ 
    $contents .=  get_date_formate($post_data['agedate'],'d.m.Y');
} else {
    $contents .= '<input type="text" class="date1" name="agedate"  value=""/>';
} 
 $contents .= ' से स्वीकृत किया जाना उचित प्रतीत होता है| </p></td></tr> ';
$contents .= '<tr><td><p>उच्च न्यायालय से प्राप्त प्रस्ताव के अनुसार ';
if($is_genrate == true){ 
    $contents .=  '<b>'.$post_data['ad_name'].'</b>';
} else {
    $contents .= '<input type="text" class="ad_name" name="ad_name" placeholder="नाम"  value=""/>';
}
$contents .= ', ';
if($is_genrate == true){ 
    $contents .=  '<b>'.$post_data['ad_designation'].'</b>';
} else {
    $contents .= '<input type="text" class="ad_designation" name="ad_designation" placeholder="पद"  value=""/>';
}
$contents .= ' का त्यागपत्र स्वीकृत किये जाने के आदेश का प्रारूप अनुमोदनार्थ प्रस्तुत है| आदेश जारी करने के पूर्व  माननीय विधि मंत्रीजी का प्रशासकीय अनुमोदन प्राप्त किया जाना प्रस्तावित है| तत्पश्चात आवश्यक आदेश जारी किये जावेंगे | </p></td></tr> ';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><b><u>अनुभाग अधिकारी (बी -1)</u></b></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><b><u>अवर सचिव (बी -1)</u></b></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><b><u>सचिव (बी -1)</u></b></td></tr>';

?>

                
                
        
                  
                
               
                