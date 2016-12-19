<?php 
$contents  = '' ;
$contents .= '<tr><td align="left"><div style="margin-top:30px;"><span style="margin-left:10%;">';
if($is_genrate == true){ 
    $contents .=  ' <b>'.$post_data['subject'];
} else {
    $contents .= ' <textarea name="subject" style="margin: 0px; height: 40px; width: 80%;">'.$file_subject.'</textarea>';
}
$contents .= ' को म.प्र. सिविल सेवा (वर्गीकरण, नियंत्रण तथा अपील) नियम,1966 के नियम 10(9) के अंतर्गत अनुशासानात्मक कार्यवाही फलस्वरूप सेवा से पदच्युत किये जाने के विरुध्द महामहिम राज्यपाल महोदय को प्रस्तुत ';
if($is_genrate == true){
	$contents .= ' '.$post_data['type_name'];
} else {	
	$contents .= ' <select name="type_name" class="type_name">';
	$contents .= '<option value="अपील">अपील</option>';
	$contents .= '<option value="अभ्यावेदन">अभ्यावेदन</option>';
	$contents .= '</select>';
}
$contents .= ' के संबंध में |</b><tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td  align="center">पंजी क्रमांक  '.$file_number.'/21-ब(एक),  भोपाल, दिनांक  ';
if($is_genrate == true){
$contents .= get_date_formate($post_data['date'],'d/m/Y');
}else
{
    $contents .=  '<input type="text" class="date1" name="date" value="'.$file_mark_section_date.'" placeholder="dd/mm/yyyy" required>';
}
$contents .=  '</td></tr>';
$contents .= '<tr><td align="center"> -------000------- </td></tr>';
$contents .= '<tr><td><p>कृपया महामहिम राज्यपाल सचिवालय से प्राप्त ज्ञापन दिनांक ';
if($is_genrate == true){
	$contents .= get_date_formate($post_data['gyapan_date'],'d/m/Y');
}else{
    $contents .=  '<input type="text" class="date1" name="gyapan_date" value="'.$today.'" placeholder="dd/mm/yyyy" required>';
}
$contents .= ' का अवलोकन कीजिये| </p></td></tr>';
$contents .= '<tr><td><p>उक्त ज्ञापन में राज्यपाल सचिवालय द्वारा ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['name_person'].'</b>';
} else {
    $contents .=  '<input type="text" class="" name="name_person" value="">';
}
$contents .= ' वर्तमान में  ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['name_person_crnt'].'</b>';
} else {
    $contents .=  '<input type="text" class="" name="name_person_crnt" value="">';
}
$contents .= '  को म.प्र.सिविल सेवा (वर्गीकरण, नियंत्रण तथा अपील )नियम,1966 10 (9) के अंतर्गत सेवा से पदच्युत किए जाने के विरुध्द महामहिम राज्यपाल महोदय को प्रस्तुत ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['type_name'].'</b>';
} else {	
	$contents .= ' <select name="type_name" class="type_name">';
	$contents .= '<option value="अपील">अपील</option>';
	$contents .= '<option value="अभ्यावेदन">अभ्यावेदन</option>';
	$contents .= '</select>';
}
$contents .= ' पर वर्णित बिन्दुओं पर विधि,नियम,निर्देश व निर्धारित प्रक्रिया के अनुसार परिक्षण उपरांत आवश्यक कार्यवाही का अनुरोध किया है |</p> </td></tr>';
$contents .= '<tr><td><p>';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['nameperson'].'</b>';
} else {
    $contents .=  '<input type="text" class="" name="nameperson" value="">';
}
$contents .= ' को उच्च न्यायालय की अनुशंसा पर दिनांक ';
if($is_genrate == true){
	$contents .= get_date_formate($post_data['anu_date'],'d/m/Y');
}else{
    $contents .=  '<input type="text" class="date1" name="anu_date" value="'.$today.'" placeholder="dd/mm/yyyy" required>';
}
$contents .= ' को म.प्र.सिविल सेवा (वर्गीकरण, नियंत्रण तथा अपील) नियम,1966 10(9) के अंतर्गत सेवा से पदच्युत किया गया है |</p> </td></tr>';
$contents .= '<tr><td><p> अधीनस्थ न्यायालय के न्यायाधीशों के कार्य तथा आचरण पर माननीय उच्च न्यायालय का नियंत्रण रहता है |</p> </td></tr>';
$contents .= '<tr><td><p> अत: प्राप्त ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['type_name'].'</b>';
} else {	
	$contents .= ' <select name="type_name" class="type_name">';
	$contents .= '<option value="अपील">अपील</option>';
	$contents .= '<option value="अभ्यावेदन">अभ्यावेदन</option>';
	$contents .= '</select>';
}
$contents .= ' को, मध्यप्रदेश उच्च न्यायालय की ओर माननीय मुख्य न्यायाधिपति महोदय की अनुमति से उच्च न्यायालय का अभिमत प्रकट किये जाने हेतु, प्रेषित किया जाना प्रस्तावित है |</p> </td></tr>';
$contents .= '<tr><td><p> ज्ञापन के प्रारूप सहित प्रस्ताव अनुमोदनार्थ सादर प्रस्तुत है |     </p> </td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><b><u>अनुभाग अधिकारी (बी -1)</u></b></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><b><u>अवर सचिव (बी -1)</u></b></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><b><u>सचिव (बी -1)</u></b></td></tr>';