<?php 
$contents  = '' ;
$contents .= '<tr><td align="left"> <div style="margin-top:20px;"><span class="no-print" style="margin-left:10%;">';
if($is_genrate == true){ 
    $contents .=  $post_data['subject'];
} else {
    $contents .= '<textarea name="subject" cols="30" rows="3">'.$file_subject.'</textarea></div>';
}
$contents .= ' </span></div></td></tr>';
$contents .= '<tr><td align="center">--00--</td></tr>';
$contents .= '<tr><td align="center" height="80"></td></tr>';

$contents .= '<tr><td align="left"><span style="margin-left:8%"></span>';
if($is_genrate == true){ 
    $contents .=  $post_data['content'];
} else {
    $contents .= '<textarea name="content" cols="60" rows="3">प्रतिरक्षण आदेश जारी किया गया  हैं आदेश की प्रति  नस्ती पर आपकी ओर प्रेषित हैं |</textarea></div>';
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