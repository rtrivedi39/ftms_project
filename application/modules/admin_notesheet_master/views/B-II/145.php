<?php
$contents  = '<table style="font-size:14px; margin:0% auto; width:80%;">' ;
$contents .= '<tr><td align="center"><h5><u>'.$dept_name.'</u></h5></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td align="center">//आदेश //</td></tr>';
$contents .= '<tr><td align="right"><b><u>भोपाल, दिनांक ';
if($is_genrate == true){ 
    $contents .=  get_date_formate($post_data['panjidate'],'d/m/Y');
} else {
    $contents .= '<input type="text" class="date1" name="panjidate"  value="'.$file_mark_section_date.'"/>';
}
$contents .= '</u></b></td></tr>';
$contents .= '<tr><td><p>फा0क्रमांक 1(सी)/'.$file_number.'/'.date('Y').'/21-ब(दो), इस विभाग के समसंख्यक आदेश दिनांक  ';
if($is_genrate == true){ 
    $contents .=  get_date_formate($post_data['adeshdate'],'d/m/Y');
} else {
    $contents .= '<input type="text" class="date1" name="adeshdate"  value="'.$file_judgment_date1.'"/>';
}
$contents .= ' को निरस्त करते हुए राज्य शासन, दण्ड प्रक्रिया संहिता,1973 (क्रं0 2 सन 1974) की धारा 24(8) द्वारा प्रदत्त शक्तियों को प्रयोग में लाते हुए, भोपाल स्थित अपर सत्र न्यायालयों मंं प्रतिबंधित संगठन सिमी से संबंधित विचाराधीन सत्र प्रकरणों में राज्य शासन की ओर से पैरवी करने हेतु निम्नानुसार एतदद्वारा निम्नलिखित अभियोजन अधिकारियों को विशेष लोक अभियोजक नियुक्त करता है :- </p></td></tr>';
if($is_genrate == true){ 
	$i=1; foreach($post_data['lokname'] as $name){
		if($name != ''){
			$contents .= '<tr><td><p>'.$i.'. <span style="margin-left:5%">'.$name.'</p></tr></td>';
		}
	$i++;}
} else {
    $contents .= '<tr><td><input type="text" class="" name="lokname[]"  value="श्री"/></tr></td>';
    $contents .= '<tr><td><input type="text" class="" name="lokname[]"  value=""/></tr></td>';
    $contents .= '<tr><td><input type="text" class="" name="lokname[]"  value=""/></tr></td>';
}
$contents .= '<tr><td align="right">मध्यप्रदेश के राज्यपाल के नाम से तथा आदेशानुसार,</td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
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
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;"><b>सचिव,</b></div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">'.$dept_name.'</div></td></tr>';
$contents .= '<tr><td><div style="float:left">पृ0 क्रमांक1(सी)/'.$file_number.'/'.date('Y').'/एट्रोसिटीज/21-ब(दो), </div><div style="float:right">भोपाल, दिनांक  ';
if($is_genrate == true){
$contents .= get_date_formate($post_data['panjidate1'],'d/m/Y').'</div></td></tr>';
}else
{
    $contents .=  '<input type="text" class="date1" name="panjidate1" value="'.$file_mark_section_date.'" placeholder="dd/mm/yyyy" required>';
}
$contents .=  '</div></td></tr>';
$contents .= '<tr><td><tr><td><u>प्रतिलिपि:</u></td></tr>';
$contents .= '<tr><td><p>(1)<span style="margin-left:5%">कलेक्टर एवं जिला दण्डाधिकारी, जिला भोपाल, (म0प्र0)</p></td></tr>';
$contents .= '<tr><td><p>(2)<span style="margin-left:5%">जिला एवं सत्र न्यायाधीश, भोपाल </p></td></tr>';
$contents .= '<tr><td><p>(3)<span style="margin-left:5%">समस्त अपर सत्र न्यायाधीश, भोपाल </p></td></tr>';
$contents .= '<tr><td><p>(4)<span style="margin-left:5%">शासकीय अभिभाषक/लोक अभियोजक जिला, भोपाल</p></td></tr>';
$contents .= '<tr><td><p>(5)<span style="margin-left:5%">पुलिस महानिरीक्षक, एस.टी.एस, भोपाल (म.प्र.)</p></td></tr>';
$contents .= '<tr><td><p>(6)<span style="margin-left:5%">';
if($is_genrate == true){ 
    $contents .=  $post_data['dand'];
} else {
    $contents .= '<input type="text" class="" name="dand"  value="द87/15/दो/ए-1"/>';
}
$contents .= ' दिनांक ';
if($is_genrate == true){
$contents .= get_date_formate($post_data['dand_date'],'d/m/Y');
}else
{
    $contents .=  '<input type="text" class="date1" name="dand_date" value="'.$today.'" placeholder="dd/mm/yyyy" required>';
}
$contents .= ' के संदर्भ में आदेश की प्रति नस्ती पर संलग्न कर नस्ती मूलतः लौटाई जाती है |</p></td></tr>';
$contents .= '<tr><td><p>सूचनार्थ एवं आवश्यक कार्यवाही हेतु प्रेषित |   </p></td></tr>';
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
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;"><b>सचिव,</b></div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">'.$dept_name.'</div></td></tr>';
$contents .= '</table>';
?>

                
                
        
                  
                
               
                