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
$contents .= ',</div></td></tr>';
$contents .= '<tr><td align="left"><b><table width="100%"><tbody><tr><td width="50px" valign="top"> विषय:- </td><td>अनापत्ति प्रमाण पत्र के संबंध में।</td></tr></tbody></table></b></td></tr>';
$contents .= '<tr><td align="left" id="inner_content"><p>उपरोक्‍त विषय के संबंध में लेख हैै कि अाापके अावेदन पत्र में लेेख हे कि आप वर्तमान सहायक लोक अभियोजना अधिकारी के पद पर कार्यरत है, अत: प्रशासकीय विभाग द्वारा तत्‍संंबंधाी जारी किये अनापत्ति प्रमाण पत्र की प्रति इस विभाग को उपलब्‍ध कराने का कष्‍ट करे।</p></td></tr>';

$contents  .= '<tr><td>&nbsp;</td></tr>';
$contents  .= '<tr><td align="right"><b>मध्यप्रदेश के राज्यपाल के नाम से तथा आदेशानुसार,</b> </td></tr>';
$contents  .= '<tr><td>&nbsp;</td></tr>';
$contents  .= '<tr><td align="right"><div style="width:60%; text-align:center;"> (';
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
$contents  .= '</div></td></tr>';
$contents  .= '<tr><td align="right" ><div style="width:60%; text-align:center;">'.@$dept_name.', भोपाल</div></td></tr>';

?>

                
                
        
                  
                
               
                