<?php 
$contents  = '' ;
$contents .= '<tr><td align="left"><div style="margin-top:30px;"><span style="margin-left:10%;">';
if($is_genrate == true){ 
    $contents .=  ' <b>'.$post_data['subject'];
} else {
    $contents .= ' <textarea name="subject" style="margin: 0px; height: 40px; width: 80%;">'.$file_subject.'</textarea>';
}
$contents .= '</b></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td  align="center">पंजी क्रमांक  '.$file_number.'/21-ब(एक),  भोपाल, दिनांक  ';
if($is_genrate == true){
$contents .= get_date_formate($post_data['date'],'d/m/Y');
}else
{
    $contents .=  '<input type="text" class="date1" name="date" value="'.$file_mark_section_date.'" placeholder="dd/mm/yyyy" required>';
}
$contents .=  '</td></tr>';
$contents .= '<tr><td align="center"> -------000------- </td></tr>';
$contents .= '<tr><td><p>रजिस्ट्री, म.प्र. उच्च न्यायालय ने अपने ज्ञापन दिनांक  ';
if($is_genrate == true){
	$contents .= get_date_formate($post_data['gyapan_date'],'d/m/Y');
}else{
    $contents .=  '<input type="text" class="date1" name="gyapan_date" value="'.$today.'" placeholder="dd/mm/yyyy" required>';
}
$contents .= ' के साथ ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['name_person'].'</b>';
} else {
    $contents .=  '<input type="text" class="" name="name_person" value="">';
}
$contents .= ' के चिकित्सा देयक प्रस्तुत करने में हुए विलंब के कारणों का उल्लेख कर रजिस्ट्री को 6 माह पश्चात देयक प्राप्त होने पर विलंब अवधि का दोषमार्जन करने का अनुरोध किया है |</p> </td></tr>';
$contents .= '<tr><td><p>म.प्र. सिविल सेवा (चिकित्सा परिचर्या) नियम, 1958 के नियम 8(1) में व्यवस्था है कि चिकित्सा प्रतिपूर्ति का आवेदन विहित पपत्र में, व्यय किये जाने की तारीख से 6 माह के भीतर नियन्त्रण अधिकारी को प्रस्तुत किया जायेगा, जो कर्मचारी विहित समयावधि में दावे प्रस्तुत न करें उन्हें यह निर्देश है कि केवल अपरिहार्य परिस्थिति में ही विशेष अनुमति के लिये सिफारिश की जाए | (लोक स्वा. एवं परिवार कल्याण विभाग परिपत्र क्र. 317 / 3356 / 82 / 17 /मेडी-4 दिनांक 01.02.1983) वित्तीय अधिकार पुस्तिका 2012, भाग-1 की कंडिका 2.2 के अनुसार देयकों के विलंब के दोषमर्जन हेतु विभाग प्रमुख को शक्तियां प्राप्त है |</p> </td></tr>';
$contents .= '<tr><td><p>आवेदन में कार्यालयीन प्रक्रिया एवं डाक आदि में अधिक समय होने का विलंब दर्शाया गया है, जो विलंब का कारण सम्बंधित आवेदन की शक्ति के बाहर होने में विलंब का कारण संतोषजनक पाते हुये उच्च न्यायालय के प्रस्ताव के परिप्रेक्ष्य में चिकित्सा देयक को प्रस्तुत करने पर 6 माह पश्चात हुए विलंब अवधि का दोषमार्जन किया जाना प्रस्तावित है |</p> </td></tr>';
$contents .= '<tr><td><p>प्रस्ताव स्वच्छ प्रति के साथ अनुमोदन एवं हस्ताक्षरार्थ प्रस्तुत है |    </p> </td></tr>';
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
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;"><b>सचिव, विधि</b></div></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><b>प्रमुख सचिव, विधि</b></td></tr>';