<style>
p{
	line-height:24px;
	text-indent:58px;
}
</style>
<?php 
$contents  = '<table style="font-size:14px;  width:90%; margin:0% auto;">' ;
if($is_genrate == true){	
	 $contents .= '<tr><td align="right"><u><b>';
	 $contents .= $post_data['post_type'];
	 $contents .= '</b></u></td></tr>';
}else{
	  $contents .= '<tr><td align="right"><u><b>';
	  $contents .= '<input name="post_type" placeholder=""  value="स्पीड पोस्ट"  size="30"  type="text" /></td></tr>' ;
	  $contents .= '</b></u></td></tr>';
}
$contents .= '<tr><td align="center"><h4><u><b>'.$dept_name.'</b></u></h4></td></tr>';
$contents .= '<tr><td><div style="float:left">';
if($is_genrate == true){
	 $contents .= $post_data['file_head'];
}
else{
	 $contents .= '<input name="file_head" placeholder="file no" size="50" value="फा.क्र. " type="text" />' ;
}

$contents .= '/'.$panji_krmank.'/'.date("Y").'/21-ब(एक), </div><div style="float:right;">';
$contents .= 'भोपाल, दिनांक '.date("d-m-Y").'</div></td></tr>';

//for prati
if($is_genrate == true){
	if($post_data['prati_1'] != '' || $post_data['prati_2'] != '' || $post_data['prati_3'] != '' || $post_data['prati_4'] != ''){
		$contents .= '<tr><td align="left"> प्रति,  </td></tr>';
	}
}else{
	 $contents .= '<tr><td align="left"> प्रति, </td></tr>';
}

//for prati
if($is_genrate == true){
	 $contents .= $post_data['prati_1'] != '' ? 
	 '<tr><td align="left"><div style="margin-left:55px;">'.$post_data['prati_1'].',</div></td></tr>' : '';
}else{
$contents .= '<tr><td align="left"><div style="margin-left:55px;">
	 <input name="prati_1" placeholder=""  value="" size="30"  type="text" />,</div></td></tr>' ;
}
if($is_genrate == true){
	 $contents .= $post_data['prati_2'] != '' ? 
	 '<tr><td align="left"><div style="margin-left:55px;">'.$post_data['prati_2'].',</div></td></tr>' : '';
}else{
	 $contents .= '<tr><td align="left"><div style="margin-left:55px;">
	 <input name="prati_2" placeholder=""  value="" size="30" type="text" />,</div></td></tr>' ;
}
if($is_genrate == true){
	 $contents .= $post_data['prati_3'] != '' ? 
	 '<tr><td align="left"><div style="margin-left:55px;">'.$post_data['prati_3'].',</div></td></tr>' : '';
}else{
	 $contents .= '<tr><td align="left"><div style="margin-left:55px;">
	 <input name="prati_3" placeholder=""  value="" size="30" type="text" />,</div></td></tr>' ;
}
if($is_genrate == true){
	 $contents .= $post_data['prati_4'] != '' ? 
	 '<tr><td align="left"><div style="margin-left:55px;">'.$post_data['prati_4'].',</div></td></tr>' : '';
}else{
	 $contents .= '<tr><td align="left"><div style="margin-left:55px;">
	 <input name="prati_4" placeholder=""  value="" size="30" type="text" />,</div></td></tr>' ;
}

//for subject
$contents .= '<tr><td align="left"><b><table width="100%"><tr><td width="50px" valign="top"> विषय:- </td>';
$contents .= '<td>'.$file_subject.'</td></tr></b></td></tr></table>';

///for sandarbh
if($is_genrate == true){
	if($post_data['sandarvh'] != ''){
		$contents .= '<tr><td align="left"><b><table width="100%"><tr><td width="50px" valign="top"> सन्दर्भ:- </td><td>';
		$contents .= $post_data['sandarvh'];
		$contents .= '</td></tr></b></td></tr></table>';
	}
} else {
	$contents .= '<tr><td align="left"><b><table width="100%"><tr><td width="50px" valign="top"> सन्दर्भ:- </td><td>';
	$contents .= '<input name="sandarvh" placeholder=""  value="" size="100" type="text" />';
	$contents .= '</td></tr></b></td></tr></table>';
}

//for content
if($is_genrate == true){
	if($post_data['content_para'] != ''){
		$contents .= '<tr><td align="left"><p>';
		$contents .= $post_data['content_para'];
		$contents .= '</p></td></tr>';
	}
} else {
	$contents .= '<tr><td align="left"><p>';
	$contents .= '<textarea style="margin: 0px; width:700px; height: 180px;" name="content_para"></textarea>';
	$contents .= '</p></td></tr>';
}

//for signature
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right"><div  style="width:50%; text-align:center;">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td>&nbsp;</td></tr>';
}
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">(<b>';
if($is_genrate == true){	 
	$contents .= get_officer_information($this->input->post('sing_user')); 
}else{
	$contents .= get_officer_for_sign('sing_user' ,array(2,3,4,5,7) ,'', $us_id);
}
$contents .= '</b>)</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">';
if($is_genrate == true){
	$contents .=   get_officer_dign($this->input->post('sing_user'));
}else{
	$contents .= '-------';
}
$contents .= '</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">'.$dept_name.'</div></td></tr>';

// for contetnt
$contents .= '<tr><td><div style="float:left">';
if($is_genrate == true){
	 $contents .= $post_data['file_head'];
}
else{
	 $contents .= '--------------' ;
}
$contents .= '/'.$panji_krmank.'/'.date("Y").'/21-ब(एक), </div><div style="float:right;">';
$contents .= 'भोपाल, दिनांक '.date("d-m-Y").'</div></td></tr>';

//for pratilipit
if($is_genrate == true){
	if($post_data['pratilipi_1'] != '' || $post_data['pratilipi_2'] != '' || $post_data['pratilipi_content'] != ''){
		$contents .= '<tr><td align="">प्रतिलिपि :-</td></tr>';
	}
}else{
	 $contents .= '<tr><td align="">प्रतिलिपि :-</td></tr>';
}	
	
if($is_genrate == true){
	if($post_data['pratilipi_1'] != ''){
		$contents .= '<tr><td><table><tr><td width="10%" valign="top">1.</td><td width="*%" valign="top">';
		$contents .= $post_data['pratilipi_1'];
		$contents .= '</td></tr></td></tr></table>';
	}
} else {
	$contents .= '<tr><td><table><tr><td width="10%" valign="top">1.</td><td width="*%" valign="top">';
	$contents .= '<input name="pratilipi_1" placeholder=""  value="" size="100" type="text" />';
	$contents .= '</td></tr></td></tr></table>';
}

if($is_genrate == true){
	if($post_data['pratilipi_2'] != ''){
		$contents .= '<tr><td><table><tr><td width="10%" valign="top">1.</td><td width="*%" valign="top">';
		$contents .= $post_data['pratilipi_2'];
		$contents .= '</td></tr></td></tr></table>';
	}
} else {
	$contents .= '<tr><td><table><tr><td width="10%" valign="top">2.</td><td width="*%" valign="top">';
	$contents .= '<input name="pratilipi_2" placeholder=""  value="" size="100" type="text" />';
	$contents .= '</td></tr></td></tr></table>';
}

if($is_genrate == true){
	if($post_data['pratilipi_content'] != ''){
		$contents .= '<tr><td>';
		$contents .= $post_data['pratilipi_content'];
		$contents .= '</td></tr>';
	}
} else {
	$contents .= '<tr><td>';
	$contents .= '<textarea style="margin: 0px; width:700px; height: 180px;" name="pratilipi_content"></textarea>';
	$contents .= '</td></tr>';
}

//for signature
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right"><div  style="width:50%; text-align:center;">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td>&nbsp;</td></tr>';
}
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">(<b>';
if($is_genrate == true){
	$contents .=  get_officer_information($this->input->post('sing_user')); 
}else{
	$contents .= '-------';	
}
$contents .= '</b>)</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">';
if($is_genrate == true){	
    $contents .=   get_officer_dign($this->input->post('sing_user'));
}else{
	$contents .= '-------';
}  
$contents .= '</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">'.$dept_name.'</div></td></tr>';
$contents .= '</table>';

