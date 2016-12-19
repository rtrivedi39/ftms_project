<?php 

$contents  = '' ;
$contents .= '<tr><td colspan="2"><div class="shift-buttom"><span class="shift-left">'.$file_subject.'</span></div></td></tr>';
$contents .= '<tr><td colspan="2"><table width="100%"><tr><td align="left">पंजी क्रमांक '.$panji_krmank.'/21-क(आप.), </td><td align="right"> दिनांक '.$file_mark_section_date.'</td></tr></table></td></tr>';
$contents .= '<tr><td align="center" colspan="2" ><br>-------00------<br><br></td></tr>';
$contents .= '<tr><td colspan="2">';
if($is_genrate == true){
	$contents .= $post_data['draft_content_text'];
}else{
		$contents .= '<textarea id="compose_textarea" name="draft_content_text" class="form-control" style="height: 500px" required></textarea></td></tr>';
}
$contents .= '<tr><td colspan="2">( प्रमुख सचिव विधि द्वारा अनुमोदित )</td></tr>';

$contents .= '<tr><td align="right"><div class="officer-center">( ';
if($is_genrate == true){
	 
		$contents .= get_officer_information($this->input->post('secetroy'));  
	 
}else{
	 $contents .= get_officer_for_sign('secetroy' ,$secetry ,'', $s_id );
	
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
	$contents .= '</td></tr>';
	$contents .= '<tr><td align="left"><b>';
if($is_genrate == true){	
    $contents .=  $this->input->post('markto_other');
}else {
	$contents .= '<textarea name="markto_other" cols="30" rows="3">प्रमुख सचिव('.$file_department.')</textarea></div>';
}
$contents .= '</b></td></tr>';
	?>
	