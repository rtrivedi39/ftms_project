<?php 
$contents  = '' ;
$contents .= '<tr><td align="left"> <div style="margin-top:20px;"><span style="margin-left:10%;">';
if($is_genrate == true){ 
    $contents .=  $post_data['subject'];
} else {
    $contents .= '<textarea name="subject" cols="30" rows="3">'.$file_subject.'</textarea></div>';
}
$contents .= ' </span></div></td></tr>';
$contents .= '<tr><td align="center">--00--</td></tr>';
$contents .= '<tr><td align="center" height="80"></td></tr>';

$contents .= '<tr><td align="left"><span style="margin-left:8%"></span> प्रतिरक्षण आदेश जारी कर मूलतः नस्ती आपकी ओर वापस की जाती हैं | </td></tr>';   
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right"><div  style="width:50%; text-align:center;">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td>&nbsp;</td></tr>';
}
$contents .= '<tr><td align="right"><div class="officer-center">( ';
if($is_genrate == true){
	 if($this->input->post('secetroy') != ''){
		$contents .= get_officer_information($this->input->post('secetroy'));  
	 } else {
		 $contents .= get_officer_information($this->input->post('avar_secetroy')); 
	 }
}else{
	 $contents .= get_officer_for_sign('secetroy' ,$secetry ,'', $s_id );
	 $contents .= get_officer_for_sign('avar_secetroy' ,$uber_sect , '', $us_id);
}

$contents .= ' )</div></td></tr>';

$contents .= '<tr><td align="right"><div class="officer-center"> ';
if($is_genrate == true){	
	if($this->input->post('secetroy') != ''){
    $contents .=   get_officer_dign($this->input->post('secetroy'));
	}else{
		$contents .=   get_officer_dign($this->input->post('avar_secetroy'));
	}
}
else {
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