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
table#sanshepika td, table#sanshepika th{
	vertical-align:top;
}
@page{
	margin:1in .6in .6in 1in;	
	@bottom-left {
        content: counter(page) "/" counter(pages);
    }	
}
</style>
<?php 
  
$contents  = '<table id="sanshepika" style="width:100%;">' ;
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
	 $contents .= '<input name="file_head" placeholder="file no" size="50" value="फा.क्र. '.$panji_krmank.'/अपील/'.date("Y").',"  type="text" />' ;
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

//for prati
if($is_genrate == true){
	if($post_data['prati_1'] != '' || $post_data['prati_2'] != '' || $post_data['prati_3'] != '' || $post_data['prati_4'] != '' || $post_data['prati_5'] != ''){
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
if($is_genrate == true){
	 $contents .= $post_data['prati_5'] != '' ? 
	 '<tr><td align="left"><div style="margin-left:55px;">'.$post_data['prati_5'].',</div></td></tr>' : '';
}else{
	 $contents .= '<tr><td align="left"><div style="margin-left:55px;">
	 <input name="prati_5" placeholder=""  value="" size="30" type="text" />,</div></td></tr>' ;
}

//for subject
if($is_genrate == true){
	if($post_data['vishay'] != ''){
		$contents .= '<tr><td align="left"><b><table width="100%"><tr><td width="50px" valign="top"> विषय:- </td><td>';
		$contents .= $post_data['vishay'];
		$contents .= '</td></tr></b></td></tr></table>';
	}
} else {
	$contents .= '<tr><td align="left"><b><table width="100%"><tr><td width="50px" valign="top"> विषय:- </td><td>';
	$contents .= '<input name="vishay" placeholder=""  value="सूचना का अधिकार अधिनियम-2005 की धारा 19(1) के अंतर्गत प्रथम अपील की	सुनवाई बाबत्।" size="100" type="text" />';
	$contents .= '</td></tr></b></td></tr></table>';
}

///for sandarbh
if($is_genrate == true){
	if($post_data['sandarvh'] != ''){
		$contents .= '<tr><td align="left"><b><table width="100%"><tr><td width="50px" valign="top"> सन्दर्भ:- </td><td>';
		$contents .= $post_data['sandarvh'];
		$contents .= '</td></tr></b></td></tr></table>';
	}
} else {
	$contents .= '<tr><td align="left"><b><table width="100%"><tr><td width="50px" valign="top"> सन्दर्भ:- </td><td>';
	$contents .= '<input name="sandarvh" placeholder=""  value="आपका अपील आवेदन दिनांक .... एवं प्राप्ती दिनांक  ......। " size="100" type="text" />';
	$contents .= '</td></tr></b></td></tr></table>';
}

//for content

$contents .= '<tr><td align="left"><p>निर्देशानुसार विषयान्तर्गत संदर्भित पत्र के संबंध में आपको सूचित किया जाता है कि आपके द्वारा प्रस्तुत अपील ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['kramank'].'</b>';
}else{
    $contents .=  '<input type="text" class=""  size="30px" name="kramank" value="" placeholder="" required>';
}
$contents .=  ' में सुनवाई हेतु दिनांक ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['suvai_dinak'].'</b>';
}else{
    $contents .=  '<input type="text" class=""  size="30px" name="suvai_dinak" value="" placeholder="" required>';
}
$contents .=  ' नियत की गई है। अतः आप दिनांक ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['upsthit_dinak'].'</b>';
}else{
    $contents .=  '<input type="text" class=""  size="30px" name="upsthit_dinak" value="" placeholder="" required>';
}
$contents .=  ' को सुबह ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['samany'].'</b>';
}else{
    $contents .=  '<input type="text" class=""  size="30px" name="samany" value="सुबह 11.00 " placeholder="" required>';
}
$contents .=  ' बजे सचिव/अपीलीय प्राधिकारी महोदय के कक्ष में उपस्थित होवे।</p></td></tr>';

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
	$contents .= get_officer_for_sign('sing_user' ,array(8) ,'', $us_id);
}
$contents .= '</b>)</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">';
if($is_genrate == true){
	$contents .=   get_officer_dign($this->input->post('sing_user'));
}else{
	$contents .= '-------';
}
$contents .= '</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">सूचना का अधिकार प्रकोष्ठ</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">'.$dept_name.'</div></td></tr>';

// for contetnt
$contents .= '<tr><td><div style="float:left">';
if($is_genrate == true){
	 $contents .= $post_data['file_head'];
}
else{
	 $contents .= '--------------' ;
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
$contents .= '<tr><td align="">प्रतिलिपि :-</td></tr>';

$contents .= '<tr><td><table width="100%"><tr><td width="10%" valign="top"></td><td width="*%" valign="top">';
$contents .= 'श्री ';
if($is_genrate == true){	 
	$contents .= '<b>'.get_officer_information($this->input->post('officer_name')).'</b>'; 
}else{
	$contents .= get_officer_for_sign('officer_name' ,array(2,3,4,5,7) ,'', $as_id);
}
$contents .= ', राज्य लोक सूचना अधिकारी, '.$dept_name.', भोपाल को निर्देषानुसार प्रेषित है कि वे नियत दिनांक को समय पर संदर्भित अपील से संबंधित नस्ती सहित उपस्थित होवे।।';
$contents .= '</td></tr></td></tr></table>';




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
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">सूचना का अधिकार प्रकोष्ठ</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">'.$dept_name.'</div></td></tr>';
$contents .= '</table>';

