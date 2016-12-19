<style>
p{	
	text-indent:0px;
	margin-bottom:15px;
}
table#sanshepika *{
	<?php	
	if($post_data['line_height'] != ''){
		echo 'line-height:'.$post_data['line_height'].'pt;';
	} else{
		echo 'line-height:24pt;'; 
	}
	if($post_data['font_size'] != ''){
		echo 'font-size:'.$post_data['font_size'].'pt;';
	} else{
		echo  'font-size:15pt;';
	}
	if($post_data['word_spacing'] != ''){
		echo 'word-spacing:'.$post_data['word_spacing'].'pt;';
	} else{
		echo 'word-spacing:10pt;';
	}
	?>
}
table#sanshepika td, table#sanshepika th{
	vertical-align:top;
}
@page{
	margin:1in .6in .6in 2in;	
	@bottom-left {
        content: counter(page) "/" counter(pages);
    }	
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
if($is_genrate == true){
	 $contents .= '<tr><td><div style="float:left"><u>';
	 $contents .= $post_data['post_type_left'];
	 $contents .= '</u></div>';
}else{
	  $contents .= '<tr><td><div style="float:left"><u>';
	  $contents .= '<input name="post_type_left" placeholder=""  value="अनुक्रमांक"  size="30"  type="text" />' ;
	  $contents .= '</u></div>';
}
if($is_genrate == true){
	 $contents .= '<div style="float:right"><u>';
	 $contents .= $post_data['post_type'];
	 $contents .= '</u></div></td></tr>';
}else{
	  $contents .= '<div style="float:right"><u>';
	  $contents .= '<input name="post_type" placeholder=""  value="गोपनीय"  size="30"  type="text" />' ;
	  $contents .= '</u></div></td></tr>';
}
$contents .= '<tr><td align="center"><h3>'.$dept_name.'</h3></td></tr>';
$contents .= '<tr><td align="center"></td></tr>';
$contents .= '<tr><td><div style="float:left">';
if($is_genrate == true){
	 $contents .= $post_data['file_head'];
}
else{
	 $contents .= '<input name="file_head" placeholder="file no" size="50" value="फा.क्र. '.$panji_krmank.'/'.date("Y").'/21-ब('.$code.'),"  type="text" />' ;
}

$contents .= '</div><div style="float:right;">';
$contents .= 'भोपाल, दिनांक ';
if($is_genrate == true){
	 $contents .= $post_data['file_head_date'];
}
else{
	 $contents .= '<input name="file_head_date" placeholder="date"  value="'.date("d-m-Y").'"  type="text" />' ;
}
$contents .= '</div></td></tr>';

if($is_genrate == true){	
	 $contents .= '<tr><td align="center"><h4>';
	 $contents .= $post_data['sanshepika'];
	 $contents .= '</h4></td></tr>';
}else{
	  $contents .= '<tr><td align="center"><h4>';
	  $contents .= '<input name="sanshepika" placeholder=""  value="मंत्री-परिषद् के लिए संक्षेपिका"  size="30"  type="text" />' ;
	  $contents .= '</h4></td></tr>';
}
$contents .= '<tr><td align="center"></td></tr>';
//for subject
if($is_genrate == true){
	if($post_data['file_subject'] != ''){
		$contents .= '<tr><td align="left"><table width="100%"><tr><td width="50px" vertical-align="top"> विषय:- </td><td><p style="text-indent:0px;"><b>';
		$contents .= $post_data['file_subject']; 
		$contents .= '</b></p></td></tr></td></tr></table>';
	}
} else {
	$contents .= '<tr><td align="left"><table width="100%"><tr><td width="50px" vertical-align="top"> विषय:- </td><td>';
	$contents .= '<input name="file_subject" placeholder=""  value="'.$file_subject.'" size="100" type="text" />';
	$contents .= '</td></tr></td></tr></table>';
}

$contents .= '<tr><td align="center">----------------</td></tr>';

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

//for signature
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right"><div  style="width:80%; text-align:center;">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td>&nbsp;</td></tr>';
}
$contents .= '<tr contenteditable="false"><td align="right"><div style="width:80%; text-align:center;">(<b>';
if($is_genrate == true){	 
	$contents .= get_officer_information($this->input->post('sing_user')); 
}else{
	$contents .= get_officer_for_sign('sing_user' ,array(2,3,4,5,7,11) ,'', $us_id);
}
$contents .= '</b>)</div></td></tr>';
$contents .= '<tr contenteditable="false"><td align="right"><div style="width:80%; text-align:center;">';
if($is_genrate == true){
	$contents .=   get_officer_dign($this->input->post('sing_user'));
}else{
	$contents .= '-------';
}
$contents .= '</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:80%; text-align:center;">'.$dept_name.'</div></td></tr>';

// for contetnt
$contents .= '</table>';


