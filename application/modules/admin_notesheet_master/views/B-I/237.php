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
	$code = 'एक';
} 
if($file_mark_section_id == 12 ){
	$code = 'दो';
}  
$contents  = '<table id="sanshepika" style="width:100%;">' ;

$contents .= '<tr><td align="right">REGD. AD.</td></tr>';
$contents .= '<tr><td align="center"><h4><b>GOVERNMENT OF MADHYA PRADESH</b></h4></td></tr>';
$contents .= '<tr><td align="center"><h4><b>LAW AND LEGISLATIVE AFFAIRS DEPARTMENT</b></h4></td></tr>';
$contents .= '<tr><td align="center"><h4><b>Ist FLOOR VINDHYACHAL BHAWAN</b></h4></td></tr>';
$contents .= '<tr><td align="center"><h4><b>BHOPAL</b></h4></td></tr>';


$contents .= '<tr><td><div style="float:left">No.3'.date("Y").'/'.$panji_krmank.'/21-ब('.$code.'),</div><div style="float:right;">';
$contents .= 'Bhopal, Dated';
if($is_genrate == true){
	 $contents .= $post_data['file_head_date'];
}
else{
	 $contents .= '<input name="file_head_date" placeholder="date"  value="'.date("d-m-Y").'"  type="text" />' ;
}
$contents .= '</div></td></tr>';
$contents .= '<tr><td>To,</td></td></tr>';



if($is_genrate == true){
	 $contents .= '<tr><td align="left"> <div style="margin-left:100px">';
	 $contents .= $post_data['sender_1'];
	 $contents .= '</div></td></tr>';
	 $contents .= '<tr><td align="left"> <div style="margin-left:150px">';
	 $contents .= $post_data['sender_11'];
	 $contents .= '</div></td></tr>';
}
else{
	 $contents .= '<tr><td align="left"> <div style="margin-left:100px">';
	 $contents .= '<input name="sender_1"  value="1/	The Deputy Commissioner of police"  type="text" />' ;
	 $contents .= '</div></td></tr>';
	 $contents .= '<tr><td align="left"> <div style="margin-left:150px">';
	 $contents .= '<input name="sender_11"  value="1/	The Deputy Commissioner of police"  type="text" />' ;
	 $contents .= '</div></td></tr>';
}


if($is_genrate == true){
	 $contents .= '<tr><td align="left"> <div style="margin-left:100px">';
	 $contents .= $post_data['sender_2'];
	 $contents .= '</div></td></tr>';
	 $contents .= '<tr><td align="left"> <div style="margin-left:150px">';
	 $contents .= $post_data['sender_21'];
	 $contents .= '</div></td></tr>';
}
else{
	 $contents .= '<tr><td align="left"> <div style="margin-left:100px">';
	 $contents .= '<input name="sender_2"  value="1/	The Deputy Commissioner of police"  type="text" />' ;
	 $contents .= '</div></td></tr>';
	 $contents .= '<tr><td align="left"> <div style="margin-left:150px">';
	 $contents .= '<input name="sender_21"  value="1/	The Deputy Commissioner of police"  type="text" />' ;
	 $contents .= '</div></td></tr>';
}


if($is_genrate == true){
	 $contents .= '<tr><td align="left"> <div style="margin-left:100px">';
	 $contents .= $post_data['sender_3'];
	 $contents .= '</div></td></tr>';
	 $contents .= '<tr><td align="left"> <div style="margin-left:150px">';
	 $contents .= $post_data['sender_31'];
	 $contents .= '</div></td></tr>';
}
else{
	 $contents .= '<tr><td align="left"> <div style="margin-left:100px">';
	 $contents .= '<input name="sender_3"  value="1/	The Deputy Commissioner of police"  type="text" />' ;
	 $contents .= '</div></td></tr>';
	 $contents .= '<tr><td align="left"> <div style="margin-left:150px">';
	 $contents .= '<input name="sender_31"  value="1/	The Deputy Commissioner of police"  type="text" />' ;
	 $contents .= '</div></td></tr>';
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
	$contents .= '<textarea id="compose_textarea"  name="content_para"></textarea>';
	$contents .= '</td></tr>';
}
$contents .= '<tr><td align="left">ENDT:- -BHOPAL(M.P.)
</td></tr>';
$contents .= '<tr><td align="right">';
if($is_genrate == true){
	 $contents .= $post_data['adeshnadar'];
}
else{
	 $contents .= '<input name="adeshnadar" placeholder=""  size="100" value="Govt. of M.P., Law & Legislative Affairs Department"  type="text" />' ;
}
$contents .= '</td></tr>';

//for signature
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right"><div  style="width:70%; text-align:center;">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td>&nbsp;</td></tr>';
}
$contents .= '<tr contenteditable="false"><td align="right"><div style="width:70%; text-align:center;">(<b>';
if($is_genrate == true){	 
	$contents .= get_officer_information($this->input->post('sing_user') ,'english'); 
}else{
	$contents .= get_officer_for_sign('sing_user' ,array(2,3,4,5,7,11) ,'english', $us_id);
}
$contents .= '</b>)</div></td></tr>';
$contents .= '<tr contenteditable="false"><td align="right"><div style="width:70%; text-align:center;">';
if($is_genrate == true){
	$contents .=   get_officer_dign($this->input->post('sing_user'),'english');
}else{
	$contents .= '-------';
}
$contents .= '</div></td></tr>'; 
$contents .= '<tr><td align="right"><div style="width:70%; text-align:center;">Govt. of M.P., Law & Legislative Affairs Department</div></td></tr>';

$contents .= '<tr><td><div style="float:left">Endt.No.3(B)2'.date("Y").'/'.$panji_krmank.'/21-ब('.$code.'),</div><div style="float:right;">';
$contents .= 'Bhopal, Dated';
if($is_genrate == true){
	 $contents .= $post_data['file_head_date'];
}
else{
	 $contents .= '<input name="file_head_date" placeholder="date"  value="'.date("d-m-Y").'"  type="text" />' ;
}
$contents .= '</div></td></tr>';
//for pratilipi
if($is_genrate == true){
	if($post_data['pratilipi_content_text'] != ''){
		$contents .= '<tr><td align="left" id="inner_content">';		
		//$contents .= $post_data['content_para'];
		$contents .= $post_data['pratilipi_content_text'];
		$contents .= '</td></tr>';
	}
} else {
	$contents .= '<tr><td align="left">';
	$contents .= '<textarea   name="pratilipi_content_text" cols="90" rows="7"></textarea>';
	$contents .= '</td></tr>';
}

//for signature
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right"><div  style="width:70%; text-align:center;">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td>&nbsp;</td></tr>';
}
$contents .= '<tr contenteditable="false"><td align="right"><div style="width:70%; text-align:center;">(<b>';
if($is_genrate == true){	 
	$contents .= get_officer_information($this->input->post('sing_user') ,'english'); 
}else{
	$contents .= '----------';
}
$contents .= '</b>)</div></td></tr>';
$contents .= '<tr contenteditable="false"><td align="right"><div style="width:70%; text-align:center;">';
if($is_genrate == true){
	$contents .=   get_officer_dign($this->input->post('sing_user') ,'english');
}else{
	$contents .= '-------';
}
$contents .= '</div></td></tr>'; 
$contents .= '<tr><td align="right"><div style="width:70%; text-align:center;">Govt. of M.P., Law & Legislative Affairs Department</div></td></tr>';


$contents .= '</table>';


