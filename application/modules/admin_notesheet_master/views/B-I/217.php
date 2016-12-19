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
@page{
	margin:1in .6in .6in 1in;			
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
	  $contents .= '<input name="post_type" placeholder=""  value=""  size="30"  type="text" /></td></tr>' ;
	  $contents .= '</b></u></td></tr>';
}
$contents .= '<tr><td align="center"><h4><u><b>'.$dept_name.'</b></u></h4></td></tr>';
$contents .= '<tr><td><div style="float:left">';
if($is_genrate == true){
	 $contents .= $post_data['file_head'];
}
else{
	 $contents .= '<input name="file_head" placeholder="file no" size="50" value="फा.क्र. '.$panji_krmank.'/'.date("Y").'/21-ब(एक),"  type="text" />' ;
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
$contents .= '<tr><td align="left"> प्रति, </td></tr>';
//for prati
$contents .= '<tr><td align="left"><div style="margin-left:55px;">संभागीय पेंशन अधिकारी,</div></td></tr>';
$contents .= '<tr><td align="left"><div style="margin-left:55px;">पेंशन कार्यालय, सतपुडा भवन,</div></td></tr>';
$contents .= '<tr><td align="left"><div style="margin-left:55px;">भोपाल,</div></td></tr>';

//for subject
$contents .= '<tr><td align="left"><b><table width="100%"><tr><td width="50px" valign="top"> विषय:- </td>';
$contents .= '<td>'.$file_subject.' पेंशन प्रकरण  के संबंध मे। </td></tr></b></td></tr></table>';

//for content
$contents .= '<tr><td align="left"><p>';
$contents .= 'उपरोक्त विषयक निर्देशानुसार उच्च न्यायालय जबलपुर से प्राप्त ज्ञापन क्रमांक ';
if($is_genrate == true){
	 $contents .= $post_data['gyapan_kramank'];
}
else{
	 $contents .= '<input name="gyapan_kramank" placeholder=""  size="50px" type="text" />' ;
} 
$contents .='  -पेंशन दिनांक ';
if($is_genrate == true){
	 $contents .= $post_data['penson_date'];
}
else{
	 $contents .= '<input name="penson_date" placeholder="दिनांक"  size="50px" type="text" />' ;
}
$contents .= ', की छायाप्रति, पेंशन प्रकरण,  पेंशन फार्म, पेंशन संराशिकरण, आवेदन पत्र, गणना पत्रक, सेवापुस्तिका एवं अन्य आवश्यक अभिलेख सहित आपकी ओर प्रेषित कर अनुरोध है कि कृपया  प्रकरण में पेंशन उपादान आदेश एवं पेंशन संराशिकरण आदेश शीघ्र जारी करने का कष्ट करें। श्री ';
if($is_genrate == true){
	 $contents .= $post_data['name_pernor'];
}else{
	 $contents .= '<input name="name_pernor" placeholder="दिनांक"  size="50px" type="text" />' ;
}
$contents .= ' दिनांक  ';
if($is_genrate == true){
	 $contents .= $post_data['patra_date'];
}
else{
	 $contents .= '<input name="patra_date" placeholder="दिनांक"  size="50px" type="text" />' ;
}
$contents .= ' को सेवानिवृत्त होने जा रहे हैं ।';
$contents .= '</p></td></tr>';
$contents .= '<tr><td align="left"><p>आगामी दो वर्षो में सेवानिवृृत्त होने वाले न्यायिक अधिकारियों की सेवानिवृृत्ति संबंधी सूची उच्च न्यायालय, जबलपुर द्वारा संचालक पेंशन, भोपाल, संयुक्त संचालक, भोपाल एवं संभागीय पेंशन अधिकारी, भोपाल को यथा समय पृथक से भेजी जाती है।</p></td></tr>';
$contents .= '<tr><td align="left"><p>अतः निर्देशानुसार आपके पत्र क्र. 42/जि.पें.अधि./2013, दिनांक 09.01.2014 के अनुसार क्रमांक 1 से 6 तक की जानकारी निम्नानुसार हैः-।</p></td></tr>';

$contents .= '<tr><td><table width="100%" border="1px solid">';
$contents .= '<td width="50%" valign="top">1. कार्यालय का नाम </td><td width="50%" valign="top">'.$dept_name.'</td></tr>';
$contents .= '<td width="50%" valign="top">2. कार्यालय प्रमुख का नाम एवं मो. नं.  </td><td width="50%" valign="top">';
if($is_genrate == true){
	 $contents .= $post_data['ps_name'];
}else{
	 $contents .= '<input name="ps_name" value="श्री ए. एम. सक्सेना, प्रमुख सचिव, विधि 94251 05080"  size="50px" type="text" />' ;
}
$contents .= '</td></tr>';
$contents .= '<td width="50%" valign="top">3. प्रभारी स्थापना पेंशन का मो. नं.  </td><td width="50%" valign="top">';
if($is_genrate == true){
	 $contents .= $post_data['prabhari_no'];
}else{
	 $contents .= '<input name="prabhari_no" value="94251 34499"  size="50px" type="text" />' ; 
}
$contents .= '</td></tr>';
$contents .= '<td width="50%" valign="top">4. कार्यालय का दूरभाष  </td><td width="50%" valign="top">';
if($is_genrate == true){
	 $contents .= $post_data['ofice_no'];
}else{
	 $contents .= '<input name="ofice_no" value="0755-2441267"  size="50px" type="text" />' ;
}
$contents .= '</td></tr>';
$contents .= '<td width="50%" valign="top">5. पता  </td><td width="50%" valign="top">';
if($is_genrate == true){
	 $contents .= $post_data['addrsss'];
}else{
	 $contents .= '<input name="addrsss" value="विधि और विधायी कार्य विभाग"  size="50px" type="text" />' ;
}
$contents .= '</td></tr>';
$contents .= '<td width="50%" valign="top">5. ई-मेल पता   </td><td width="50%" valign="top">';
if($is_genrate == true){
	 $contents .= $post_data['email_dd'];
}else{
	 $contents .= '<input name="email_dd" value="ladbho@mp.nic.in"  size="50px" type="text" />' ;
}
$contents .= '</td></tr>';
$contents .= '</table></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><b>संलग्नः</b> उपरोक्तानुसार। <br/> D.D.O. Code No-0512101001</td></tr>';

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
$contents .= '</table>';

