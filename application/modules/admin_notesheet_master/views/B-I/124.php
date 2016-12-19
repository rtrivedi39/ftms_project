<?php
$contents  = '' ;
$contents .= '<tr><td colspan="2" align="right"><u>स्पीड पोस्ट द्वारा</u></td></tr>';
$contents  .= '<tr><td align="center"><h3><u>'.@$dept_name.', भोपाल</u></h3></td></tr>';
$contents  .= '<tr><td align="center"><h3><u>::आदेश ::</u></h3></td></tr>';
$contents .= '<tr><td><div style="float:left">फा.क्र.  '.$file_number.'/21-ब(एक) ,  </div><div style="float:right">भोपाल, दिनांक  ';
if($is_genrate == true){
$contents .= get_date_formate($post_data['date'],'d/m/Y').'</div></td></tr>';
}else
{
    $contents .=  '<input type="text" class="date1" name="date" value="'.$file_mark_section_date.'" placeholder="dd/mm/yyyy" required>';
}
$contents .=  '</div></td></tr>';
$contents .= '<tr><td align="left"> प्रति, </td></tr>';
$contents .= '<tr><td align="left"><div style="margin-left:55px;">';
if($is_genrate == true){
	 $contents .= $post_data['p_name'];
}
else{
	 $contents .= '<input name="p_name" id="p_name"  placeholder=""  value=""  type="text" />' ;
}
$contents .= ',</div></td></tr>';
$contents .= '<tr><td align="left"><div style="margin-left:55px;">';
if($is_genrate == true){
	 $contents .= $post_data['address'];
}
else{
	 $contents .= '<input name="address" placeholder=""  value=""  type="text" />' ;
}
$contents .= ',</div></td></tr>';
$contents .= '<tr><td align="left"><div style="margin-left:55px;">';
if($is_genrate == true){
	 $contents .= $post_data['district'];
}
else{
	 $contents .= '<input name="district" id="district" placeholder=""  value=""  type="text" />' ;
}
$contents .= '  (म.प्र.) पिन-';
if($is_genrate == true){
	 $contents .= $post_data['pin_code'];
}
else{
	 $contents .= '<input name="pin_code" placeholder=""  value=""  type="text" />' ;
}
$contents .= ' ,</div></td></tr>';
 $contents .= '<tr><td align="left"><b><table width="100%"><tbody><tr><td width="50px" valign="top"> विषय:- </td><td>चयनित अभ्यार्थी- ';
 if($is_genrate == true){
	 $contents .= $post_data['p_name'];
}
else{
	 $contents .= '<input name="p_name" class="p_name" placeholder=""  value=""  type="text" />' ;
}
$contents .= ' सिविल न्यायाधीश के पद पर नियुक्ति के संबंध में।(परीक्षा '.date('Y',strtotime(-1)).')</td></tr></tbody></table></b></td></tr>';
$contents .= '<tr><td align="left" id="inner_content"><p>मध्यप्रदेश उच्च यायालय द्वारा आयोजित मध्यप्रदेश सिविल न्यायधीश वर्ग-2 (प्रवेश स्तर ) के पद पर आपका चयन हुआ है। नियुक्ति आदेश जारी किए जाने के पूर्व आपके   स्वास्थ्य संबंधी  उपयुक्तता का परीक्षण किया जाना आवश्यक होगा। </p> 
<p>अत:आपसे अनुरोध है कि यह पत्र प्राप्त होने के पन्द्रह दिवस की कालावधि में संभागीय संयुक्त संचालक स्वास्थ्य सेवाएं,  ';
if($is_genrate == true){
	 $contents .= $post_data['district'];
}
else{
	 $contents .= '<input name="district" class="district"  placeholder=""  value=""  type="text" />' ;
}
$contents .= ' से सम्पर्क कर अपना स्वास्थ्य परीक्षण चिकित्सीय मण्डल द्वारा निर्धारित फीस का भुगतान कर कराया जाना सुनिश्चित करें।</p> <p>इस पत्र की प्राप्ति की अभिस्वीकृति कृपया तुरन्त देवें ।</p> </td></tr>';

$contents  .= '<tr><td>&nbsp;</td></tr>';
$contents  .= '<tr><td align="right"><b>मध्यप्रदेश के राज्यपाल के नाम से तथा आदेशानुसार,</b> </td></tr>';
$contents  .= '<tr><td>&nbsp;</td></tr>';
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
$contents  .= '<tr><td align="right" ><div style="width:60%; text-align:center;">'.@$dept_name.', भोपाल</div></td></tr>';

?>

                
                
        
                  
                
               
                