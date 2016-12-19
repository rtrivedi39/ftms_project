<?php
$contents  = '' ;
$contents  .= '<tr><td colspan="3"><table width="100%"><tr><td align="left">क्र.';
if($is_genrate == true){
    $contents .= $post_data['head'];
}else{
	$contents .= '<input name="head" placeholder="head" type="text" />';
}
$contents .= '/'.date("y").'/'.$panji_krmank.'/21-क(आप),';
$contents .= '</td><td  align="right"> भोपाल, दि. '.date("d-m-Y").'</td></tr></table></td></tr>' ;
$contents  .= '<tr><td valign="top" class="style2"> प्रतिलिपि:- </td></tr><tr><td></td><td>1.</td><td >' ;
if($is_genrate == true){
    $contents .= '<span>'.$post_data['advocate_type'].' कार्यालय,</span>';
}else{
    $contents .= '<select name="advocate_type">';
    foreach($advocate_type as $row){
        $contents .= '<option value="'.$row.'">'.$row.'</option>';
    }
    $contents .= '</select>';
}
$contents .= ' ';
if($is_genrate == true){
    $contents .= '<span>'.$post_data['court_location'].'</span>';
}else{
    $contents .= '<select name="court_location">';
    foreach($court_location as $row){
        $contents .= '<option value="'.$row.'">'.$row.'</option>';
    }
    $contents .= '</select>';
}
$contents  .= '  की ओर अग्रेषित संबंधित प्रकरण का अभिलेख, स्थाई अधिवक्ता, नई दिल्ली   की ओर शीघ्र भेजने की व्यवस्था करें । </td></tr><tr><td></td><td>2.</td><td >' ;
if($is_genrate == true){
    $contents .= $post_data['reg'];
}else{
    $contents .= '<select name="reg">';
    $contents .= '<option>रजिस्ट्रार (न्यायिक) मध्यप्रदेश उच्च न्यायालय, जबलपुर </option>';
    $contents .= '<option>अतिरिक्त रजिस्ट्रार (न्यायिक) मध्यप्रदेश उच्च न्यायालय, ग्वालियर</option>';
    $contents .= '<option>अतिरिक्त रजिस्ट्रार (न्यायिक) मध्यप्रदेश उच्च न्यायालय, इंदौर</option>';
    $contents .= '</select>';
}
$contents  .= ' (म0प्र0) &nbsp; की ओर अग्रिम कार्यवाही एवं सूचनार्थ प्रेषित। </td></tr><tr><td></td><td>3.</td><td>' ;
$contents  .= ' जिला दण्डाधिकारी, ' ;
$contents  .= $district_name_hi ;
$contents .= ' (म0प्र0) को इस निर्देश के साथ प्रेषित कि उपरोक्त प्रकरण में तत्काल प्रभारी  अधिकारी की नियुक्ति करें व प्रभारी अधिकारी को निर्देशित करें कि वे स्थायी अधिवक्ता ' ;
$contents  .= 'से नई दिल्ली के पते पर सम्पर्क कर विशेष अनुमति याचिका प्रस्तुत करें और प्रकरण से  संबंधित निर्णय की प्रमाणित प्रतिलिपि, केस डायरी, साक्ष्य में ग्राह्य दस्तावेजों ' ;
$contents  .= 'की प्रतिलिपियां, परीक्षित साक्षियों के कथन एवं अन्य सुसंगत दस्तावेज । प्रकरण में पैरवी करने वाले स्थायी अधिवक्ता को उपलब्ध कराया जाना सुनिश्चित करें और की गई कार्यवाही से इस विभाग को सूचित करें । </td></tr><tr><td></td><td>4.</td><td>' ;
$contents  .= ' पुलिस अधीक्षक, '.$district_name_hi.' (म0प्र0) की ओर इस निर्देश के साथ प्रेषित कि उपरोक्तानुसार अपील प्रस्तुत कराया  जाना सुनिश्चित करें तथा कि गई कार्यवाही की सूचना इस विभाग को भेजें । </td></tr><tr><td></td><td>5.</td><td>' ;
$contents  .= ' विधि विभाग, उप कार्यालय, एम.पी. भवन, नई दिल्ली-110001 की ओर सूचनार्थ एवं आवश्यक  कार्यवाही हेतु अग्रेषित । </td></tr>' ;
$contents .= '<tr><td colspan="3">&nbsp;</td></tr>';
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right" colspan="3"><div  class="officer-center" >(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td colspan="3">&nbsp;</td></tr>';
}
$contents .= '<tr><td colspan="3" align="right"><div class="officer-center"  contenteditable="false" >( ';
if($is_genrate == true){
$contents .=  get_officer_information($this->input->post('secetroy')); 

}else
{
     $contents .= get_officer_for_sign('secetroy' ,array(4,5) ,'', $s_id );
    
}

$contents .= ' )</div></td></tr>';
$contents .= '<tr><td colspan="3" align="right"><div class="officer-center"  contenteditable="false">';

if($is_genrate == true){    
    $contents .=   get_officer_dign($this->input->post('secetroy'));
}
else {
     $contents .= '-------';
    }
$contents .= '</div></td></tr>';
$contents .= '<tr><td colspan="3" align="right"><div  class="officer-center" style="">मध्यप्रदेश शासन विधि और विधायी कार्य विभाग, भोपाल</div></td></tr>';
?>
