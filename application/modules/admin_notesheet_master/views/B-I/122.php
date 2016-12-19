<?php
$contents  = '' ;
$contents .= '<tr><td colspan="2" align="right"><u>स्पीड पोस्ट द्वारा</u></td></tr>';
$contents  .= '<tr><td align="center"><h3><u>'.@$dept_name.', भोपाल</u></h3></td></tr>';
$contents  .= '<tr><td align="center"><h3><u>::आदेश ::</u></h3></td></tr>';
$contents .= '<tr><td><div style="float:left">पंजी क्रमांक  '.$file_number.'/21-ब(एक) ,  </div><div style="float:right">भोपाल, दिनांक  ';
if($is_genrate == true){
$contents .= get_date_formate($post_data['date'],'d/m/Y').'</div></td></tr>';
}else
{
    $contents .=  '<input type="text" class="date1" name="date" value="'.$file_mark_section_date.'" placeholder="dd/mm/yyyy" required>';
}
$contents .=  '</div></td></tr>';
$contents .= '<tr><td align="left"> प्रति, </td></tr>';
$contents .= '<tr><td align="left"><div style="margin-left:55px;">कलेक्‍टर, </div></td></tr>';
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
$contents .= ',</div></td></tr>';
 $contents .= '<tr><td align="left"><b><table width="100%"><tbody><tr><td width="50px" valign="top"> विषय:- </td><td>चयनित अभ्यार्थी- ';
 if($is_genrate == true){
	 $contents .= $post_data['p_name'];
}
else{
	 $contents .= '<input name="p_name" id="p_name"  placeholder=""  value=""  type="text" />' ;
}
$contents .= ' सिविल न्यायाधीश के पद पर नियुक्ति के संबंध में।(परीक्षा 2015)</td></tr></tbody></table></b></td></tr>';
$contents .= '<tr><td align="left"><b><table width="100%"><tbody><tr><td width="50px" valign="top"> सन्दर्भ:- </td><td>कार्यालय अनुविभागीय अधिकारी (प्रमाणीकरण) क्रमांक ';
 if($is_genrate == true){
	 $contents .= $post_data['p_name'];
}
else{
	 $contents .= '<input name="p_name" id="p_name"  placeholder=""  value=""  type="text" />' ;
}
 $contents .= ' दिनांक ';
  if($is_genrate == true){
	 $contents .= $post_data['latter_date'];
}
else{
	 $contents .= '<input name="latter_date" class="date1" placeholder=""  value=""  type="text" />' ;
}
$contents .= '</td></tr></tbody></table></b></td></tr>';
$contents .= '<tr><td align="left" id="inner_content"><p>उपरोक्‍त विषयान्‍तर्गत लेख है कि ';
 if($is_genrate == true){
	 $contents .= $post_data['p_name'];
}
else{
	 $contents .= '<input name="p_name" class="p_name"  placeholder=""  value=""  type="text" />' ;
}
$contents .= ' का चयन मध्‍यप्रदेश सिविल  न्‍यायाधीश वर्ग-2 (प्रवेश स्‍तर) परीक्षा,' .date('Y', strtotime('-1 years')). ' में हुआ है। </p> 
<p>अत:अभ्‍यर्थी द्वारा प्रस्‍तुत जाति प्रमाण-पत्र का नियमानुसार निम्‍न बिन्‍दुओं  सहित,जांच कर सत्‍यापन प्रतिवेदन इस कार्यालय को शीघ्र प्रेषित करने का कष्‍ट करे-- </p> <p>1 . क्‍या जाति प्रमाण-पत्र  उसमें उल्‍लेखित कार्यालय द्वारा एवं सक्षम प्राधिकारी द्वारा जारी किया गया है। </p>  <p>2. क्‍या जाति प्रमाण-पत्र नियमानुसार समस्‍त औपचारिकताओं की पूर्ति उपरांत जारी किया गया है। </p>  <p>3. क्‍या संलग्‍न जाति  प्रमाण-पत्र  सही है ,(कुमी) </p>  <p>संलग्‍न- जाति प्रमाण पत्र की छायाप्रति। </p> </td></tr>';

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
$contents  .= '</div></td></tr>';
$contents  .= '<tr><td align="right" ><div style="width:60%; text-align:center;">'.@$dept_name.', भोपाल</div></td></tr>';

?>

                
                
        
                  
                
               
                