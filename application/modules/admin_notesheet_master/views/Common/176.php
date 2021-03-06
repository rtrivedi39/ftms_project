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
$contents .= '<tr><td align="center"><h4><u><b>'.$dept_name.'</b></u></h4></td></tr>';
if($is_genrate == true){	
	 $contents .= '<tr><td align="center"><h5><b>';
	 $contents .= $post_data['sanshepika'];
	 $contents .= '</b></h5></td></tr>';
}else{
	  $contents .= '<tr><td align="center"><h5><b>';
	  $contents .= '<input name="sanshepika" placeholder=""  value="// आदेश  //"  size="30"  type="text" />' ;
	  $contents .= '</b></h5></td></tr>';
}

$contents .= '<tr><td><div style="float:left"></div><div style="float:right;">';
$contents .= 'भोपाल, दिनांक ';
if($is_genrate == true){
	 $contents .= $post_data['file_head_date'];
}
else{
	 $contents .= '<input name="file_head_date" placeholder="date"  value="'.date("d-m-Y").'"  type="text" />' ;
}
$contents .= '</div></td></tr>';

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
	$contents .= '<textarea id="compose_textarea"  name="content_para">फा.क्र. '.date("Y").'/'.$panji_krmank.'/21-ब('.$code.'),</textarea>';
	$contents .= '</td></tr>';
}

$contents .= '<tr><td align="right">';
if($is_genrate == true){
	 $contents .= $post_data['adeshnadar'];
}
else{
	 $contents .= '<input name="adeshnadar" placeholder=""  size="100" value="मध्यप्रदेश के राज्यपाल के नाम से तथा आदेशानुसार,"  type="text" />' ;
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
	$contents .= get_officer_information($this->input->post('sing_user')); 
}else{
	$contents .= get_officer_for_sign('sing_user' ,array(2,3,4,5,7,11) ,'', $us_id);
}
$contents .= '</b>)</div></td></tr>';
$contents .= '<tr contenteditable="false"><td align="right"><div style="width:70%; text-align:center;">';
if($is_genrate == true){
	$contents .=   get_officer_dign($this->input->post('sing_user'));
}else{
	$contents .= '-------';
}
$contents .= '</div></td></tr>'; 
$contents .= '<tr><td align="right"><div style="width:70%; text-align:center;">'.$dept_name.'</div></td></tr>';

// for contetnt
$contents .= '<tr><td><div style="float:left">';
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
	 $contents .= '----------' ;
}
$contents .= '</div></td></tr>';

//for pratilipit
if($is_genrate == true){
	if($post_data['column_one'] != ''){
		$contents .= '<tr><td align="">प्रतिलिपि :-</td></tr>';
	}
}else{
	 $contents .= '<tr><td align="">प्रतिलिपि :-</td></tr>';

}	
$contents .= '<tr><td><table width="100%" id="tbl_one_column" class="one_column">';
	
if($is_genrate == true){	
	$total_row = count($post_data['column_one']);	
	for($i = 0; $i < $total_row; $i++){
		$_i = $i + 1;
		if(isset($post_data['column_one'][$i]) && $post_data['column_one'][$i] != ''){
			$contents .= '<tr><td align="left" width="10%" valign="top">'.$_i .'.</td>			
			<td width="*%" valign="top">'.$post_data['column_one'][$i].'</td>
			</tr>';
		}
	}
	
}else{
	  $contents .= '<tbody><tr>	 
		<td width="*%" valign="top"><input name="column_one[]" placeholder=""  value="" size="100" type="text" /></td>
		</tr></tbody>';
	
}
if($is_genrate == false){
	$contents .= '<tfoot><tr><td colspan="6" style="text-align: left;">';
	$contents .= '<input type="button" id="addpratilpi" value="प्रतिलिपि जोड़े" />';
	$contents .= '<input type="hidden" value="" name="total_row" class="total_row"></td></tr></tfoot>';
}
$contents .= '</table></td></tr>';

$ki_or = 'की ओर सुचनार्थ एवं आवश्‍यक कार्यवाही हेतु प्रेषित।';

if($is_genrate == true){	
	if($post_data['column_one'] != ''){
		$contents .= '<tr><td>';
		$contents .= $post_data['pratilipi_content'];
		$contents .= '</td></tr>';
	}
} else {
	$contents .= '<tr><td>';
	$contents .= '<textarea style="margin: 0px; width:700px; height: 180px;" name="pratilipi_content">'.$ki_or.'</textarea>';
	$contents .= '</td></tr>';
}

//for signature
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right"><div  style="width:70%; text-align:center;">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td>&nbsp;</td></tr>';
}
$contents .= '<tr><td align="right"><div style="width:70%; text-align:center;">(<b>';
if($is_genrate == true){
	$contents .=  get_officer_information($this->input->post('sing_user')); 
}else{
	$contents .= '-------';	 
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
$contents .= '</table>';


