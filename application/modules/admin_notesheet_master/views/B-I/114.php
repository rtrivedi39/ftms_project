<?php
$contents  = '' ;
$contents .= '<tr><td align="center">फा0क्र0 1-1/2002/21-ब(एक)</td></tr>';
$contents .= '<tr><td align="left"><span style="margin-left:20%">कुटुम्ब न्यायालय में  ';
if($is_genrate == true){
    $contents .= $post_data['type1'];
} else {
   $contents .= ' <select name="type1">';
   $contents .= '<option value="सेवारत">सेवारत</option>';
   $contents .= '<option value="सेवानिव्रत्त">सेवानिव्रत्त</option>';
   $contents .= '</select>';
}
$contents .= ' न्यायिक अधिकारी की नियुक्ति </span></td></tr>';
$contents .= '<tr><td align="center">------------</td></tr>';
$contents .= '<tr><td align="center">पंजी क्रं '.$file_number.'/'.date('Y').'/21-ब(एक), दिनांक ';
if($is_genrate == true){ 
    $contents .=  get_date_formate($post_data['panjidate'],'d.m.Y');
} else {
    $contents .= '<input type="text" class="date1" name="panjidate"  value="'.$today.'"/>';
}
$contents .= '</td></tr>';
$contents .= '<tr><td align="center">-----000-------</td></tr>';
$contents .= '<tr><td><p>कृपया रजिस्ट्रार जरनल, म. प्र. उच्च न्यायालय के अर्द्धशासकीय पत्र  ';
if($is_genrate == true){ 
    $contents .=  $post_data['patrano'];
} else {
    $contents .= ' <input type="text" class="" name="patrano"  value=""/>';
}
$contents .= ', दिनांक  ';
if($is_genrate == true){ 
    $contents .=  get_date_formate($post_data['uodate'],'d.m.Y');
} else {
    $contents .= ' <input type="text" class="date1" name="uodate"  value="'.get_date_formate($file_uo_or_letter_date1,'d/m/Y').'"/>';
}
$contents .= ' का अवलोकन कीजिये| </p></td></tr> ';
$contents .= '<tr><td><p>उच्च न्यायालय के अर्द्धशासकीय पत्र  क्रं. ';
if($is_genrate == true){ 
    $contents .=  $post_data['patrano1'];
} else {
    $contents .= ' <input type="text" class="" name="patrano1"  value=""/>';
}
$contents .= ', दिनांक  ';
if($is_genrate == true){ 
    $contents .=  get_date_formate($post_data['uodate1'],'d.m.Y');
} else {
    $contents .= ' <input type="text" class="date1" name="uodate1"  value="'.get_date_formate($file_uo_or_letter_date1,'d/m/Y').'"/>';
}
 $contents .= ' के अनुक्रम में  ';
if($is_genrate == true){ 
    $contents .=  $post_data['name'];
} else {
    $contents .= ' <input type="text" class="" name="name"  value=""/>';
}
$contents .= ' सेवा निवृत जिला न्यायाधीश को स्थापित एवं नवीन कुटुम्ब न्यायालय में ';
if($is_genrate == true){ 
    $contents .=  $post_data['age'];
} else {
    $contents .= ' <input type="text" class="" name="age"  value=""/>';
}
$contents .= ' वर्ष दिनांक ';
if($is_genrate == true){ 
    $contents .=  get_date_formate($post_data['agedate'],'d.m.Y');
} else {
    $contents .= '<input type="text" class="date1" name="agedate"  value=""/>';
}
$contents .= ' को पूर्ण करने की अथवा आगामी आदेश होने तक (जो भी पहले हो) अनुशंसा की है|</p></td></tr>';
$contents .= '<tr><td><p>आदेश जरी किये जाने के पूर्व माननीय विधि मंत्रीजी का प्रशासकीय अनुमोदन प्राप्त किया जाना है| </p></td></tr> ';
$contents .= '<tr><td><p>अतः उक्त प्रस्ताव नस्ती सहित अनुमोदनार्थ  एवं माननीय विधि मंत्रीजी को अंकित किये जाने के लिए प्रस्तुत है| </p></td></tr> ';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><b>अनुभाग अधिकारी (बी-1)</b></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><b>अवर सचिव  (बी-1)</b></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><b>सचिव (बी-1)</b></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><p>उक्त प्रस्ताव के प्रशासकीय अनुमोदन हेतु नस्ती माननीय विधि मंत्रीजी की ओर अंकित करना चाहेंगे |</p></td></tr> ';
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">(<b>';
if($is_genrate == true){
	$contents .= $post_data['slname'];
} else {
	$contents .= ' <select name="slname" class="slname">';
	foreach(user_byrole_section(null,4) as $key => $name){
		$slname = $name['emp_full_name_hi'];
		$slected = $sl_name == $slname ? "selected" : "";
		$contents .= '<option value="'.$slname.'" '.$slected.'>'.$slname.'</option>';
	}
	$contents .= '</select>';	
}
$contents .= '</b>)</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;"><b>सचिव, विधि</b></div></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><b>प्रमुख सचिव, विधि</b></td></tr>';
?>

                
                
        
                  
                
               
                