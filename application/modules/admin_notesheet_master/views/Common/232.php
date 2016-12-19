<style>
p{	
	text-indent:58px;
	margin-bottom:15px;
}
table#sanshepika *{
	<?php	
	if($post_data['line_height'] != ''){
		echo 'line-height:'.$post_data['line_height'].'pt;';
	} else{
		echo 'line-height:16pt;'; 
	}
	if($post_data['font_size'] != ''){
		echo 'font-size:'.$post_data['font_size'].'pt;';
	} else{
		echo  'font-size:11pt;';
	}
	if($post_data['word_spacing'] != ''){
		echo 'word-spacing:'.$post_data['word_spacing'].'pt;';
	} else{
		//echo 'word-spacing:7pt;';
	}
	?>
}
table#sanshepika table{
	width:100%;
}
table#sanshepika td, table#sanshepika th{
	vertical-align:top;
}
@page{
	margin:1in .6in .6in 1in;			
}
</style>
<?php 
$code = '';
if($file_mark_section_id == 11 ){
	$code = 'ब(एक)';
} elseif($file_mark_section_id == 12 ){
	$code = 'ब(दो)';
}  else {
	$code = ' ';
} 
$contents  = '<table id="sanshepika" style="width:100%;">' ;

$contents  = '<tr><td height="100">&nbsp;</td></tr>';
$contents .= '<tr><td><div style="float:right;"><u>';
$contents .= 'अद्व शास.पत्र कं ';
if($is_genrate == true){ 
    $contents .=  $post_data['number'];
} else {
    $contents .= '<input type="text" class="" name="number"  value=""/>';
}
$contents .= '/'.date("Y").'/'.$file_number.'/21-'.get_section_code($this->session->userdata('emp_section_id')) .' </u></td></tr>';

$contents .= '</div></td></tr>';
$contents .= '<tr><td><div style="float:right;"><u>'.$dept_name.',</div></td></tr>';

$contents .= '<tr contenteditable="false"><td align="left"><div ><b>';
if($is_genrate == true){	 
	$contents .= get_officer_information($this->input->post('sing_user')); 
}else{
	$contents .= get_officer_for_sign('sing_user' ,array(2,3,4,5,7,11) ,'', $us_id);
}
$contents .= '</b></div></td></tr>';
$contents .= '<tr contenteditable="false"><td align="left"><div>';
if($is_genrate == true){
	$contents .=   get_officer_dign($this->input->post('sing_user'));
}else{
	$contents .= '-------';
}
$contents .= '</div></td></tr>';
$contents .= '<tr><td><div style="float:left"></div><div style="float:right;">';
$contents .= 'भोपाल, दिनांक ';
if($is_genrate == true){
	 $contents .= $post_data['file_head_date'];
}
else{
	 $contents .= '<input name="file_head_date" placeholder="date"  value="'.date("d-m-Y").'"  type="text" />' ;
}
$contents .= '</div></td></tr>';

//for subject
$contents .= '<tr><td align="left"><b><table width="100%"><tr><td width="50px" valign="top"> विषय:- </td>';
$contents .= '<td>';
if($is_genrate == true){
	 $contents .= $post_data['file_subject'];
}
else{
	 $contents .= '<textarea name="file_subject" placeholder="विषय"  cols="70" rows="3" >'.$file_subject.'</textarea>' ;
}

$contents .= '</td></tr></b></td></tr></table>';

///for sandarbh
if($is_genrate == true){
	if($post_data['sandarvh'] != ''){
		$contents .= '<tr><td align="left"><b><table width="100%"><tr><td width="50px" valign="top"> आदरणीय श्री </td><td>';
		$contents .= $post_data['sandarvh'];
		$contents .= '</td></tr></b></td></tr></table>';
	}
} else {
	$contents .= '<tr><td align="left"><table width="100%"><tr><td width="90px" valign="top">आदरणीय श्री</td><td>';
	$contents .= '<input name="sandarvh" placeholder="" type="text" />';
	$contents .= '</td></tr></td></tr></table>';
}

//for content
if($is_genrate == true){
	if($post_data['content_text'] != ''){
		$contents .= '<tr><td align="left" id="inner_content">';		
		//$contents .= $post_data['content_para'];
		$contents .= base64_decode($post_data['content_text']);
		$contents .= '</td></tr>';
	}
} else {
	$contents .= '<tr><td align="left">';
	$contents .= '<textarea id="compose_textarea" name="content_para"></textarea>';
	$contents .= '</td></tr>';
}

$contents .= '<tr><td><p style="text-indent:60%">सद्भावनाओ  सहित,</p></td></tr>';
$contents .= '<tr><td align="right">';
if($is_genrate == true){
	 $contents .= $post_data['adeshnadar'];
}
else{
	 
}
$contents .= '</td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td align="right"><div  style="width:50%; text-align:center;">भवदीय</div></td></tr>';
//for signature
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right"><div  style="width:50%; text-align:center;">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td>&nbsp;</td></tr>';
}
$contents .= '<tr contenteditable="false"><td align="right"><div style="width:50%; text-align:center;">(<b>';
if($is_genrate == true){	 
	$contents .= get_officer_information($this->input->post('sing_user')); 
}else{
	$contents .= '---------';
}
$contents .= '</b>)</div></td></tr>';
$contents .= '<tr contenteditable="false"><td align="right"><div style="width:50%; text-align:center;">';
if($is_genrate == true){
	$contents .=   get_officer_dign($this->input->post('sing_user'));
}else{
	$contents .= '-------';
}
$contents .= '</div></td></tr>';

//for pratilipit
if($is_genrate == true){
	if($post_data['column_one'] != ''){
		$contents .= '<tr><td align="">प्रति</td></tr>';
	}
}else{
	 $contents .= '<tr><td align="">प्रति</td></tr>';

}
$contents .= '<tr><td><div style="margin-left:100px">';
if($is_genrate == true){
	 $contents .= $post_data['prati_name'];
}
else{
	 $contents .= '<input name="prati_name" placeholder=""     type="text" />' ;
}
$contents .= '</div></td></tr>';
$contents .= '<tr><td><div style="margin-left:100px">';
if($is_genrate == true){
	 $contents .= $post_data['dp_name'];
}
else{
	 $contents .= '<input name="dp_name" placeholder=""    type="text" />' ;
}
$contents .= '</div></td></tr>';
$contents .= '<tr><td><div style="margin-left:100px">';
if($is_genrate == true){
	 $contents .= $post_data['where_from'];
}
else{
	 $contents .= '<input name="where_from" placeholder=""    type="text" />' ;
}
$contents .= '</div></td></tr>';

$contents .= '</table>';

