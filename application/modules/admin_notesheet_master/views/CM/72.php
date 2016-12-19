<?php
$contents  = '' ;
$contents  .= '<tr><td colspan="3"><table width="100%"><tr><td align="left">क्रमांक 6/  -क(आप), </td><td align="right">भोपाल, दिनांक '.date("d-m-Y").'</td></tr></table></td></tr>';
$contents  .= '<tr><td valign="top" >प्रतिलिपि:- </td><td colspan="2"></td></tr>';
$contents  .= '<tr><td valign="top"></td><td  class="top_class">1.</td><td>';
if($is_genrate == true){
	$contents .= $post_data['DropDownList1'];
}else
{
	$contents  .= '<select name="DropDownList1"><option value="रजिस्ट्रार (न्यायिक)">रजिस्ट्रार (न्यायिक)</option><option value="अतिरिक्त रजिस्ट्रार (न्यायिक)">अतिरिक्त रजिस्ट्रार (न्यायिक)</option></select>';
}

$contents  .= ' मध्यप्रदेश उच्च न्यायालय ';

if($is_genrate == true){
	$contents .= $post_data['court_location'];
}else
{
	$contents  .= '<select name="court_location">';
	foreach($court_location  as $loca){
		$contents  .= '<option>'.$loca.'</option>';
	}
	$contents  .= '</select>';
}
$contents  .= '  । </td></tr>';

$contents  .= '<tr><td valign="top"></td><td  class="top_class">  2.</td><td> जिला दण्डाधिकारी,&nbsp;<span id="Label1"></span>';
if($is_genrate == true){
	$contents .= $post_data['distic_1'];
}else
{
$contents  .= get_distic_dd('distic_1');	
}
$contents  .= '&nbsp;(म.प्र.)&nbsp;को  इस निर्देश के साथ प्रेषित की जाती है कि उपरोक्त प्रकरण में तत्काल प्रभारी अधिकारी     की नियुक्ति करें व प्रभारी अधिकारी को निर्देशित करें कि वे&nbsp;';
if($is_genrate == true){
	$contents .= $post_data['DropDownList2'];
}else
{
	$contents  .= '<select name="DropDownList2" id="DropDownList2"><option value="महाधिवक्ता कार्यालय जबलपुर">महाधिवक्ता कार्यालय जबलपुर</option><option value="अतिरिक्त महाधिवक्ता कार्यालय इंदौर">अतिरिक्त महाधिवक्ता कार्यालय इंदौर</option><option value="अतिरिक्त महाधिवक्ता कार्यालय ग्वालियर">अतिरिक्त महाधिवक्ता कार्यालय ग्वालियर</option></select> ';
}

$contents  .= '&nbsp;से संपर्क    कर विलम्ब का दिन-प्रतिदिन का कारण दर्शित करते हुए विलम्ब माफी के आवेदन पत्र जो शपथपत्र से समर्थित हो सहित, अपील प्रस्तुत करें और प्रकरण से संबंधित केस डायरी, साक्ष्य में ग्राह्य दस्तावेजों की प्रतिलिपियां, परीक्षित साक्षियों के कथन एवं अन्य सुसंगत दस्तावेज । प्रकरण में पैरवी करने वाले अतिरिक्त महाधिवक्ता को उपलब्ध कराया जाना सुनिश्चित करें और की गयी कार्यवाही से इस विभाग को सूचित करें।<span  class="font-large"><u> साथ ही भविष्य में भेजे जाने वाले अपील प्रस्ताव के साथ निर्णय एवं मत की दो प्रमाणित प्रतिलिपिया संलग्न कर आवश्यक रूप से इस विभाग को भेजा जाना सुनिश्चित करें|</u></span><br> </td></tr>';
$contents  .= '<tr><td valign="top"></td><td  class="top_class">  3.</td><td>';
$contents  .= ' पुलिस अधीक्षक,  <span id="Label2"></span>';
if($is_genrate == true){
	$contents .= $post_data['distic_2'];
}else
{
$contents  .= get_distic_dd('distic_2');	
}
$contents  .= ' &nbsp;(म0प्र0) को इस निर्देश के साथ प्रेषित की जिला मजिस्ट्रेट से संपर्क कर अपील प्रस्तुत कराया जाना सुनिश्चित करें तथा की गयी कार्यवाही की सूचना इस विभाग को भेजें ।<br /><br> </td></tr>';
$contents  .= '<tr><td valign="top" ></td><td  class="top_class">  4.</td><td> आयुक्त&nbsp; ';
if($is_genrate == true){
	$contents .= $post_data['division'];
}else
{
$contents  .= get_division_dd('division'  );	
}

$contents  .= '&nbsp;संभाग&nbsp';
if($is_genrate == true){
	$contents .= $post_data['distic_3'];
}else
{
$contents  .= get_distic_dd('distic_3');	
}

$contents  .= '&nbsp;को सूचनार्थ प्रेषित की संबंधित जिला मजिस्ट्रेट द्वारा आदेश का पालन किया जाना सुनिश्चित करें ।<br /><br /><br /></td></tr>';
$contents .= '<tr><td align="right" height="80"></td></tr>';
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right" colspan="3"><div class="officer-center">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td colspan="3">&nbsp;</td></tr>';
}
$contents .= '<tr><td colspan="3" align="right"><div  contenteditable="false" class="officer-center">( ';
if($is_genrate == true){
$contents .=  get_officer_information($this->input->post('avar_secetroy')); 

}else
{
     $contents .= get_officer_for_sign('avar_secetroy' ,$uber_sect ,'', $us_id);
    
}

$contents .= ' )</div></td></tr>';
$contents .= '<tr><td colspan="3" align="right"><div contenteditable="false" class="officer-center ">';

if($is_genrate == true){    
    $contents .=   get_officer_dign($this->input->post('avar_secetroy'));
}
else {
     $contents .= '-------';
    }
	
$contents .= '</div></td></tr>';
$contents .= '<tr><td colspan="3" align="right"><div style="" class="law_dept" >मध्यप्रदेश शासन विधि और विधायी कार्य विभाग, भोपाल</div></td></tr>';
$contents .= '<td>&nbsp;</td><td>&nbsp;</td></tr>';
?>
            
                
        
                  
                
               
                