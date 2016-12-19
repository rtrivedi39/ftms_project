<style>
p {
    margin-bottom: 2px;
    line-height: 18px;
}
td{
	line-height: 18px;
}
</style>
<?php
$contents  = '<table style="font-size:14px; margin:0% auto; width:80%;">' ;
$contents .= '<tr><td align="center"><h4><u>'.$dept_name.'</u></h4></td></tr>';
$contents .= '<tr><td align="center">//आदेश //</td></tr>';
$contents .= '<tr><td align="right"><b><u>भोपाल, दिनांक ';
if($is_genrate == true){ 
    $contents .=  get_date_formate($post_data['panjidate'],'d/m/Y');
} else {
    $contents .= '<input type="text" class="date1" name="panjidate"  value="'.$file_mark_section_date.'"/>';
}
$contents .= '</u></b></td></tr>';
$contents .= '<tr><td><p>फा0क्रमांक 1(सी)/'.$file_number.'/'.date('Y').'/एट्रोसिटीज/21-ब(दो), राज्य शासन, अनुसूचित जाति और अनुसूचित जनजाति (अत्याचार निवारण) अधिनियम, 1989 की धारा-14 के अनुसार विनिर्दिष्ट विशेष न्यायालय के लिये अधिनियम की    धारा-15 के अंतर्गत ';
if($is_genrate == true){
	$contents .= $post_data['distic_1'];
}else{
	$contents  .= get_distic_dd('distic_1');	
}
$contents .= ' जिले के विनिर्दिष्ट विशेष न्यायालय के लिये, अनुसूचित जाति और अनुसूचित जनजाति (अत्याचार निवारण) नियम, 1995 के नियम 4(1) के अनुसार ';
if($is_genrate == true){ 
    $contents .= '<b>'.$post_data['ad_name'].'</b>';
} else {
    $contents .= '<input type="text" class="" name="ad_name"  value="श्री"/>';
}
$contents .= ' को जिला ';
if($is_genrate == true){
	$contents .= $post_data['distic_1'];
}else{
	$contents  .= get_distic_dd('distic_1');	
}
$contents .= ' में विशेष लोक अभियोजक नियुक्त करता है । </p></td></tr>';

$contents .= '<tr><td><p>उक्त नियुक्ति ';
if($is_genrate == true){ 
    $contents .=  '<b>'.$post_data['ad_name'].'</b>';
} else {
    $contents .= '<input type="text" class="" name="ad_name"  value="श्री"/>';
}
$contents .= ' द्वारा कार्यभार ग्रहण करने के दिनांक से तीन वर्ष के लिये होगी। यह नियुक्ति बिना कोई कारण बताये समाप्त की जा सकती है। किसी भी स्थिति में 62 वर्ष की आयु के पश्चात् वे उक्त पद पर कार्य करने हेतु अर्ह नहीं होंगे।</p></td></tr> ';
$contents .= '<tr><td><p>';
if($is_genrate == true){ 
    $contents .=  '<b>'.$post_data['ad_name'].'</b>';
} else {
    $contents .= '<input type="text" class="" name="ad_name"  value="श्री"/>';
}
$contents .= '  को शुल्क आदि विधि और विधायी कार्य विभाग के आदेश क्रमांक 1(सी)एट्रोसिटीज/21-ब(दो), दिनांक ';
if($is_genrate == true){ 
    $contents .=  get_date_formate($post_data['adeeshdate'],'d/m/Y');
} else {
    $contents .= '<input type="text" class="date1" name="adeeshdate"  value="'.$today.'"/>';
}
$contents .= ' के अनुरूप देय होंगे एवं इस संबंध में होने वाला व्यय मांग संख्या 64-मुख्य शीर्ष-2225-(5171) विशेष न्यायालयों की स्थापना-31-व्यावसायिक सेवाओं हेतु अदायगियां-003-अभिभाषकों को फीस के अंतर्गत विकलनीय होगा। जिसका भुगतान उक्त शीर्ष से संबंधित जिला एवं सत्र न्यायाधीश द्वारा किया जायेगा।';

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
$contents .= '<tr><td><p>(1)<span style="margin-left:5%">उप नियंत्रक शासकीय केन्द्रीय मुद्रणालय, भोपाल की ओर म0प्र0 राजपत्र के आगामी अंक में प्रकाशनार्थ,</span></p>  </td></tr>';
$contents .= '<tr><td><p>(2)<span style="margin-left:5%">रजिस्ट्रार जनरल, म0प्र0 उच्च न्यायालय, जबलपुर,</span></p>  </td></tr>';
$contents .= '<tr><td><p>(3)<span style="margin-left:5%">आयुक्त, ';
if($is_genrate == true){
	$contents .= $post_data['sambhag'];
}else{
	$contents  .= get_division_dd('sambhag');	
}
 $contents  .= ' संभाग ';
if($is_genrate == true){
	$contents .= $post_data['distic_1'];
}else{
	$contents  .= get_distic_dd('distic_1');	
}
$contents  .= ' म0प्र0,</span></p>  </td></tr>';
$contents .= '<tr><td><p>(4)<span style="margin-left:5%">कलेक्टर एवं जिला दण्डाधिकारी, ';
if($is_genrate == true){
	$contents .= $post_data['distic_1'];
}else{
	$contents  .= get_distic_dd('distic_1');	
}
$contents  .= ' म0प्र0,</span></p>  </td></tr>';
$contents .= '<tr><td><p>(5)<span style="margin-left:5%">जिला एवं सत्र न्यायाधीश, ';
if($is_genrate == true){
	$contents .= $post_data['distic_1'];
}else{
	$contents  .= get_distic_dd('distic_1');	
}
$contents  .= ' म0प्र0,</span></p> </td></tr>';
$contents .= '<tr><td><p>(6)<span style="margin-left:5%">प्रमुख सचिव, म0प्र0 शासन, आदिम जाति एवं अनुसूचित जाति कल्याण विभाग, मंत्रालय, भोपाल,</p></td></tr>';
$contents .= '<tr><td><p>(7)<span style="margin-left:5%">संचालक, लोक अभियोजन, संचालनालय, भदभदा रोड़, भोपाल,म0प्र0,</p></td></tr>';
$contents .= '<tr><td><p>(8)<span style="margin-left:5%">प्रमुख सचिव, गृह (पुलिस) विभाग, मंत्रालय , भोपाल</p></td></tr>';
$contents .= '<tr><td><p>(9)<span style="margin-left:5%">माननीय विधि मंत्री जी के निज सचिव,</p></td></tr>';
$contents .= '<tr><td><p>(10)<span style="margin-left:5%">बजट शाखा, विधि विभाग, भोपाल, म0प्र0,</p></td></tr>';
$contents .= '<tr><td><p>(11)<span style="margin-left:5%">';
if($is_genrate == true){ 
    $contents .= $post_data['paskshkar_name'];
} else {
    $contents .= '<input type="text" class="" name="paskshkar_name"  value="श्री"/>';
}
$contents .= '</p></td></tr>';
$contents .= '<tr><td><p>की ओर सूचनार्थ एवं आवश्यक कार्यवाही हेतु प्रेषित। </p></td></tr>';
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

                
                
        
                  
                
               
                