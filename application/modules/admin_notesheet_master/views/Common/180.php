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
		//echo 'word-spacing:8pt;';
	}
	?>
}
table#sanshepika td, table#sanshepika th{
	vertical-align:top;
}
table#sanshepika table td, table#sanshepika table th{
	border:1px solid #000000; 
}	
@page{
	margin:1in .6in .6in 1in;	
	table#sanshepika table td, table#sanshepika table th{
		border:1px solid #000000; 
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
	 $contents .= '<tr><td align="center"><h4><u><b>';
	 $contents .= $post_data['sanshepika'];
	 $contents .= '</b></u></h4></td></tr>';
}else{
	  $contents .= '<tr><td align="center"><h4>';
	  $contents .= '<input name="sanshepika" placeholder=""  value=""  size="30"  type="text" />' ;
	  $contents .= '</h4></td></tr>';
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
$contents .= '</table>';


