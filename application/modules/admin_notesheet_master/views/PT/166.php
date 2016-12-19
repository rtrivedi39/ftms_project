<?php 
$contents  = '' ;
$contents .= '<tr><td align="left"> <div style="margin-top:20px;"><span style="margin-left:10%;" class="no-print">';
if($is_genrate == true){ 
    $contents .=  $post_data['subject'];
} else {
    $contents .= '<textarea name="subject" cols="30" rows="3">'.$file_subject.'</textarea></div>';
}
$contents .= ' </span></div></td></tr>';
$contents .= '<tr><td align="center">--00--</td></tr>';
$contents .= '<tr><td align="center" height="80"></td></tr>';

$contents .= '<tr><td align="left">';
if($is_genrate == true){ 
    $contents .=  '<p>'.$post_data['content'].'</p>';
} else {
    $contents .= '<textarea name="content" cols="60" rows="5">माननीय सर्वोच्य न्यायलय द्वारा विशेष अनुमति याचिका (सिविल) क्रमांक 22728/2015 म0 प्र0 राज्य विरुद्ध रमेशचंद्र वर्मा के प्रकरण में दिए गये दिशा-निर्देश  के परिपक्ष्य में विलंब में कारण दर्शित करते हुए तथा दायित्व सुनिश्चित करते हुए सुसंगत दस्तावेज एवं विवरण विधि विभाग में गठित समीक्षा सेल को उपलब्ध कराये जाने हेतु निर्देश दिया जाना प्रार्थित है| </textarea></div>';
}if($is_genrate == true){ 
    $contents .=  '<p>'.$post_data['lasar'].'</p>';
} else {
    $contents .= '<input type="text" class="" name="lasar"  size="70" value="आदेश की प्रति नस्ती पर रखकर प्रेषित है|" >';
}
 
$contents .= '</td></tr>';   
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right"><div  style="width:50%; text-align:center;">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td>&nbsp;</td></tr>';
}
$contents .= '<tr><td align="right"><div class="officer-center">( '; 
if($is_genrate == true){	 
	$contents .= get_officer_information($this->input->post('sing_user')); 
}else{
	$contents .= get_officer_for_sign('sing_user' ,array(2,3,4,5,7) ,'', $as_id);
}

$contents .= ' )</div></td></tr>';
$contents .= '<tr><td align="right"><div class="officer-center"> ';
if($is_genrate == true){
	$contents .=   get_officer_dign($this->input->post('sing_user'));
}else{
	$contents .= '-------';
}
$contents .= '</td></tr><tr><td align="left"><b>';
if($is_genrate == true){	
    $contents .=  $this->input->post('markto_other');
}else {
	$contents .= '<textarea name="markto_other" cols="30" rows="3">प्रमुख सचिव('.$file_department.')</textarea></div>';
}
$contents .= '</b></td></tr>';
	?>