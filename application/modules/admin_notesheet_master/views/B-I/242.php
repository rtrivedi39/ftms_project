<?php
$contents   = '<table id="orders" style="width:100%;">' ;
$contents  .= '<tr><td align="right"><u>स्पीड पोस्ट द्वारा</u></td></tr>';
$contents  .= '<tr><td align="center"><h3><u>'.@$dept_name.', भोपाल</u></h3></td></tr>';
$contents  .= '<tr><td align="center"><h3><u>::आदेश ::</u></h3></td></tr>';
$contents  .= '<tr><td align="right">भोपाल दिनांक ';
if($is_genrate == true){
	$contents .= $post_data['file_head_date'];
}else{
	$contents .=  '<input type="text" class="date1" name="file_head_date" value="'.date('d-m-Y').'" placeholder="dd/mm/yyyy" />';
}
$contents  .= '</td></tr>';
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
$contents .= '<tr><td align="left"><b><table width="100%"><tbody><tr><td width="50px" valign="top"> विषय:- </td><td>चयनित अभ्यार्थी- ';
if($is_genrate == true){
	 $contents .= $post_data['p_name'];
}
else{
	 $contents .= '<input name="p_name" id="p_name"  placeholder=""  value=""  type="text" />' ;
}
 $contents .= ' सिविल न्यायाधीश के पद पर नियुक्ति के संबंध में।(परीक्षा '.date('Y',strtotime('-1 year')).')</td></tr></tbody></table></b></td></tr>';
$contents .= '<tr><td align="left"><b><table width="100%"><tbody><tr><td width="50px" valign="top"> सन्दर्भ:- </td><td>अनुप्रमाणन फार्म में दी गई जानकारी के संबंध में।</td></tr></tbody></table></b></td></tr>';
$contents  .= '<tr><td align="left" id="inner_content"><p>उपरोक्त संदर्भित विषयक आपके द्वारा माननीय उच्च न्यायालय को प्रस्तुत किये गये अनुप्रमाणन-फार्म के कालम-10 में दी गयी जानकारी अपूर्ण है। तत्संबंधी अनुप्रमाणन-फार्म की छायाप्रति प्रे्षित कर लेख है कि अनुप्रमाणन-फार्म का अवलोकन कर उल्लेखित अवधि अप्रेल 1996 से जनवरी 1997 तथा मई 1998 से जून 2000,मई 2004 से जून 2013 तक की अवधि में आपके निवासरत रहने की जानकारी आवेदन पत्र द्वारा इस विभाग को अविलंब उपलब्ध कराने का कष्ट करें।</p> </td></tr>';


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



?>


                
                
        
                  
                
               
                