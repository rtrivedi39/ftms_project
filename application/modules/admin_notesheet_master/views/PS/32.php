
<?php 
$contents  = '' ;
$contents .= '<tr><td><div style="margin-top:15px;"><span style="margin-left:10%;">अभियोजन स्वीकृति प्रकरण क्रमांक  '.@$case_no;
if($is_genrate == true){ 
    $contents .=  ' '.$post_data['subject'];
} else {
    $contents .= ' <textarea name="subject" style="margin: 0px; height: 40px; width: 80%;">'.$file_subject.'</textarea>';
}
$contents .= '</span></div></td></tr>';
$contents .= '<tr><td align="center">---------0---------</td></tr>';
$contents .= '<tr><td><u><p>पजी क्रं '.$file_number.'/'.date("Y").'/21-क (अभि) दिनांक ';
if($is_genrate == true){
$contents .= $post_data['date1'];
}else
{
	$contents .=  '<input type="text" class="date1" name="date1" value="'.date('d-m-Y').'" placeholder="dd/mm/yyyy" />';
}
$contents .= '</p></u></td></tr>';
$contents .=  ' <tr><td><p>लोकायुक्त कार्यालय क्रमांक ';
if($is_genrate == true){
$contents .= $post_data['crime_no'];
}else{
$contents .= 	'<input type="text" name="crime_no">';
} 
$contents .=  ' ( वि.पु.स्था ';
if($is_genrate == true){
$contents .= $post_data['vsth_no'];
}else{
$contents .= 	'<input type="text" name="vsth_no">';
}

$contents .= 	' राज्य आर्थिक अपराध क्रमांक ';
if($is_genrate == true){
$contents .= $post_data['crime_no_2'];
}else{
$contents .= 	'<input type="text" name="crime_no_2">';
}  
$contents .= 	' धारा 7,12,13(1) D13(2)D';

$contents .= 	'</p></td></tr>'; 

$contents .= '<tr><td align="center">---------0---------</td></tr>';
$contents .= '<tr><td><p>कृपया लोकायुक्त  कार्यालय /राज्य आर्थिक अपराध प्रकोष्ठ से प्राप्त अभियोजन स्वीकृति संबंधी प्रस्ताव का अवलोकन करें । </p></td></tr>';
$contents .= '<tr><td><p>श्री ';
if($is_genrate == true){
$contents .= $post_data['name_1'];
}else{
$contents .= 	'<input type="text" name="name_1" value="'.$file_subject.'">';
}
$contents .= ' से अभियोजन के संबंध में लोकायुक्त कार्यालय/राज्य आर्थिक अपराध द्वारा प्रस्ताव केस डायरी, अभिलेख, रिपोर्ट पृ.1 से पृ ';
if($is_genrate == true){
$contents .= $post_data['page_no_1'];
}else{
$contents .= 	'<input type="text" name="page_no_1">';
}
$contents .= ' तक मूल अभिलेख की छायाप्रति पृ0 1 से पृ0  ';
if($is_genrate == true){
$contents .= $post_data['page_no_2'];
}else{
$contents .= '<input type="text" name="page_no_2">';
}
$contents .='तक गवाहान कथन की छायाप्रति पृ0 1 से पृ0  ';
if($is_genrate == true){
$contents .= $post_data['page_no_3'];
}else{
$contents .= '<input type="text" name="page_no_3">';
}
$contents .= '  तक इस विभाग को उपलब्ध कराये है।</p></td></tr>';
$contents .= '<tr><td><p>	इस संबंध में म0प्र0 शासन, सामान्य प्रशासन विभाग के आदेश क्रमांक एफ/15/01/2014/1-10, दिनांक 05.09.2014 द्वारा सभी विभागों को निर्देश जारी किये  है कि अभियोजन संबंधी प्रकरणों में संबंधित विभाग 45 दिन की समयावधि में अभियोजन की स्वीकृति जारी कर उसे अन्वेषण  अभिकरण/व्यक्तिगत परिवादी को प्रेषित करेगा तथा स्वीकृति आदेश की एक प्रति विधि विभाग को अग्रेषित  करें ।</p></td></tr>';
$contents .= '<tr><td><p>	सामान्य प्रशासन विभाग के आदेश दिनांक 05.09.2014 के अनुक्रम में प्रकरण इस विभाग को विशेष पुलिस स्थापना, लोकायुक्त /ब्यूरो कार्यालय द्वारा अभियोजन स्वीकृति हेतु भेजा गया है। अत: उक्त आदेशानुसार प्रस्ताव प्रकरण सहित प्रशासकीय विभाग ';
if($is_genrate == true){
    $contents .= $post_data['depart_1'];
}else
{
    $contents .=  get_department_ddl_list('depart_1');
}

$contents .= ' की ओर आवश्यक कार्यवाही करने हेतु भेजा जाना उचित प्रतीत होता है। साथ ही उसकी सूचना लोकायुक्त कार्यालय को भी भेजी जाना उचित होगा।</p></td></tr>';


$contents .= '<tr><td><p>	अत: अर्द्ध  शासकीय पत्र की स्वच्छ प्रतियां हस्ताक्षरार्थ प्रस्तुत हैा</p></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
if($this->uri->segment(6) == 'p' || $this->uri->segment(7) == 'p'){
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>अनुभाग अधिकारी (अभि0) </u></td></tr>';

$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>सचिव  (अभि0) </u></td></tr>';
}



//print content
//echo $contents;
?>   

