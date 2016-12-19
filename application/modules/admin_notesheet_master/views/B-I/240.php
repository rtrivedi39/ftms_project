<?php
$contents   = '<table id="orders" style="width:100%;">' ;
$contents  .= '<tr><td align="right"><u> </u></td></tr>';
$contents  .= '<tr><td align="center"><h3><u>'.@$dept_name.', भोपाल</u></h3></td></tr>';
$contents  .= '<tr><td align="center"><h3><u>::आदेश ::</u></h3></td></tr>';
$contents  .= '<tr><td align="right">भोपाल दिनांक ';
if($is_genrate == true){
	$contents .= $post_data['file_head_date'];
}else{
	$contents .=  '<input type="text" class="date1" name="file_head_date" value="'.date('d-m-Y').'" placeholder="dd/mm/yyyy" />';
}
$contents  .= '</td></tr>';
$contents  .= '<tr><td><p>फा.क्र. 1/5/96/21-ब(एक) '.$file_number.'/'.date("Y").' , ( प्रतिक्षा सूची.मेरिट क्रमांक )  राज्‍य शासन  ';
if($is_genrate == true){
	$contents .= $post_data['p_name'];
}else{
	$contents .=  '<input type="text"  name="p_name" id="p_name" value="'.@$scm_name_hi.'" placeholder="नाम" />';
}
$contents  .= ' पिता श्री ';
if($is_genrate == true){
	$contents .= $post_data['father_name'];
}else{
	$contents .=  '<input type="text"  name="father_name" id="father_name" value="'.$scm_father_name_hi.'" placeholder="पिता नाम" />';
}
$contents  .= '  को मध्यप्रदेश न्यायिक सेवा में 
सिविल न्यायाधीश वर्ग-2 (  प्रवेश स्‍तर ) वर्ग  के पद पर , दो वर्ष की परिवीक्षा पर अथवा अन्‍य आदेश होने तक अस्‍थायी रूप से, उनके द्वारा कार्यभार ग्रहण  करने के दिनांक से कनिष्ठ वेतनमान रूपये  ';
if($is_genrate == true){
	$contents .= $post_data['salary'];
}else{
	$contents .=  '<input type="text"  name="salary" value="" placeholder="वेतन" />';
}
$contents .=  ' में एतदद्वारा नियुक्‍त करता है।</p></td></tr>';
$contents  .= '<tr><td><p>अभ्‍यर्थी का गृह जिला ';
if($is_genrate == true){
	$contents .= $post_data['home_district'];
}else{
	$contents .=  '<input type="text"  name="home_district" value="" placeholder="जिला" />';
}
$contents .=  ' ( म.प्र.) है। उसकी जन्‍मतिथि ';
if($is_genrate == true){
	$contents .= $post_data['birthdate'];
}else{
	$contents .=  '<input type="text"  name="birthdate" class="date1" value="" />';
}

$contents .=  ' है। </p></tr></tr>';

$contents  .= '<tr><td>&nbsp;</td></tr>';

$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td align="right">';
if($is_genrate == true){
	 $contents .= $post_data['adeshnadar'];
}
else{
	 $contents .= '<input name="adeshnadar" placeholder=""  size="100" value="मध्यप्रदेश के राज्यपाल के नाम से तथा आदेशानुसार,"  type="text" />' ;
}
$contents .= '</td></tr>';
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right"><div  style="width:70%; text-align:center;">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td>&nbsp;</td></tr>';
}
$contents .= '<tr><td align="right"><div style="width:70%; text-align:center;">(<b>';
if($is_genrate == true){	 
	$contents .= get_officer_information($this->input->post('sing_user')); 
}else{
	$contents .= get_officer_for_sign('sing_user' ,array(2,3,4,5,7) ,'', $us_id);
}
$contents .= '</b>)</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:70%; text-align:center;">';
if($is_genrate == true){
	$contents .=   get_officer_dign($this->input->post('sing_user'));
}else{
	$contents .= '-------';
}
$contents .= '</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:70%; text-align:center;">'.$dept_name.'</div></td></tr>';
$contents .= '<tr><td align=""><div style="height:50px;"></div></td></tr>';
$contents .= '<tr><td><div style="float:left">';
if($is_genrate == true){
	 $contents .= $post_data['file_head'];
}
else{
	 $contents .= '<input name="file_head" placeholder="file no" size="50" value="फा.क्र. 1/5/96/21-ब(एक) '.$file_number.'/'.date("Y").',"  type="text" />' ;
}
$contents .= '</div><div style="float:right;">';
$contents .= 'भोपाल, दिनांक ';
if($is_genrate == true){
	 $contents .= $post_data['file_head_date'];
}
else{
	 $contents .= '----------' ;
}
$contents .= '</div></td></tr>';

//for pratilipit
$contents .= '<tr><td align="">प्रतिलिपि :-</td></tr>';
$contents .= '<tr><td><table width="100%"><tr><td width="10%" valign="top">1.</td><td width="*%" valign="top">';
$contents .= ' रजिस्‍ट्रार जनरल म0प्र0 उच्‍च न्‍यायालय जबलपुर की ओर उनके अर्द्धशासकीय पत्र क्रमांक ';
if($is_genrate == true){
	 $contents .= $post_data['latter_no'];
}
else{
	 $contents .= '<input name="latter_no" placeholder="" type="text" />' ;
}
$contents .= ' दिनांक ';
if($is_genrate == true){
	$contents .= $post_data['latter_date'];
}else{
	$contents .=  '<input type="text"  name="latter_date" class="date1" value="" />';
}
$contents .= ' तथा अर्द्धशासकीय पत्र ';
if($is_genrate == true){
	 $contents .= $post_data['half_latter_no'];
}
else{
	 $contents .= '<input name="half_latter_no" placeholder="" type="text" />' ;
}
 $contents .= ' दिनांक ';
if($is_genrate == true){
	$contents .= $post_data['half_latter_date'];
}else{
	$contents .=  '<input type="text"  name="half_latter_date" class="date1" value="" />';
}
$contents .= ' के संदर्भ में इस अनुरोध के साथ अग्रेषित कि, कृपया उक्‍त आदेश के अनुसरण में अभ्‍यर्थी को पदस्‍थापना की सूचना सीधे देकर इस विभाग को अवगत कराने का कष्‍ट करें  ';
$contents .= '</td></tr></td></tr></table>';
$contents .= '<tr><td><table width="100%"><tr><td width="10%" valign="top">2.</td><td width="*%" valign="top">';
if($is_genrate == true){
	$contents .= $post_data['p_name'];
}else{
	$contents .=  '<input type="text"  name="p_name"  class="p_name"  value="'.@$scm_name_hi.'" placeholder="नाम" />';
}
$contents  .= ' पिता श्री ';
if($is_genrate == true){
	$contents .= $post_data['father_name'];
}else{
	$contents .=  '<input type="text"  name="father_name" value="'.$scm_father_name_hi.'" placeholder="पिता नाम" />';
}

if($is_genrate == true){
	$contents .= $post_data['address'];
}else{
	$contents .=  '<input type="text"  name="address" value=""  />';
}
$contents .=  '   भोपाल ( म0 प्र0) पिन. ';
if($is_genrate == true){
	$contents .= $post_data['pincode'];
}else{
	$contents .=  '<input type="text"  name="pincode" value=""  />';
} 
$contents .=  ' को इस निर्देश के साथ प्रेषित है कि :- <br>(1 ) वह पदस्‍थापना संबंधी आदेश प्राप्‍त होने पर उच्‍च न्‍यायालय द्वारा निर्धारित समयावधि में निश्चित रूप से पदभार ग्रहण करें, अन्‍यथा उक्‍त नियुक्ति आदेश स्वतः प्रभावहीन होगा। , 
वह पदस्‍थापना के स्‍थान में जन्‍मति‍थि संबंधी प्रमाण-पत्र, जाति प्रमाण-पत्र (यदि लागू हो) तथा शैक्षणिक योग्‍यताओं से संबंधित मूल प्रमाण पत्र तथा उनकी छायाप्रतियां सक्षम अधिकारी के समक्ष सेवापुस्तिका में संलग्‍न किये जाने हेतु प्रस्‍तुत करें तथा मूल प्रमाण पत्र प्रमाणीकरण पश्‍चात वापस प्राप्‍त करें | <br>3 ) महालेखाकार मध्‍यप्रदेश ग्‍वालियर की ओर सूचनार्थ एवं आवश्‍यक कार्यवाही हेतु अग्रेषित |<br>4) उप नियंत्रक शासन केन्‍द्रीय मुद्रणालय, अरेरा हिल्‍स, भोपाल की ओर म.प्र. राजपत्र के आगामी अंक में प्रकाशनार्थ अग्रेषित।';
$contents .= '</td></tr></td></tr></table>';



//for signature
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right"><div  style="width:70%; text-align:center;">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td>&nbsp;</td></tr>';
}
$contents .= '<tr><td align="right"><div style="width:70%; text-align:center;">(<b>';
if($is_genrate == true){
	$contents .=  get_officer_information($this->input->post('sing_user')); 
}else{
	$contents .= '-------';	
}
$contents .= '</b>)</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:70%; text-align:center;">';
if($is_genrate == true){	
    $contents .=   get_officer_dign($this->input->post('sing_user'));
}else{
	$contents .= '-------';
}  
$contents .= '</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:70%; text-align:center;">'.$dept_name.'</div></td></tr>';
$contents .= '</table>';

?>


                
                
        
                  
                
               
                