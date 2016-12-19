<?php 

$contents  = '' ;
$contents .= '<tr><td colspan="2"><span class="shift-left no-print">'.$file_subject.'</span><br/></td></tr>';

$contents .= '<tr><td colspan="2">';
if($is_genrate == true){
	$contents .= '<p>'.$post_data['draft_content_text'].'</p>';
}else{
		$contents .= '<textarea id="compose_textarea" name="draft_content_text" class="form-control" style="height: 500px" required></textarea></td></tr>';
}
$contents .= '<tr><td colspan="2">( प्रमुख सचिव विधि द्वारा अनुमोदित )</td></tr>';

if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right"><div  style="width:50%; text-align:center;">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td>&nbsp;</td></tr>';
}
$contents .= '<tr contenteditable="false"><td align="right"><div class="officer-center">( ';
if($is_genrate == true){	 
	$contents .= get_officer_information($this->input->post('sing_user')); 
}else{
	$contents .= get_officer_for_sign('sing_user' ,array(2,3,4,5,7) ,'', $us_id);
}

$contents .= ' )</div></td></tr>';
$contents .= '<tr contenteditable="false"><td align="right"><div class="officer-center"> ';
if($is_genrate == true){	
	if($this->input->post('sing_user') != ''){
    $contents .=   get_officer_dign($this->input->post('sing_user'));
	}else{
		$contents .=   get_officer_dign($this->input->post('sing_user'));
	}
}else {
		$contents .= '-------';
} 
$contents .= '</td></tr>';
$contents .= '<tr><td align="left"><b>';
if($is_genrate == true){	
    $contents .=  $this->input->post('markto_other');
}else {
	$contents .= '<textarea name="markto_other" cols="30" rows="3">प्रमुख सचिव('.$file_department.')</textarea></div>';
}
$contents .= '</b></td></tr>';
	?>
	