<style>
p{	
	text-indent:0px;
	text-align:justify;
	margin-bottom:15px;
}
h3{
	font-weight:bold;
}
table#orders *{
	<?php	
	if($post_data['line_height'] != ''){
		echo 'line-height:'.$post_data['line_height'].'pt;';
	} else{
		echo 'line-height:17pt;'; 
	}
	if($post_data['font_size'] != ''){
		echo 'font-size:'.$post_data['font_size'].'pt;';
	} else{
		echo  'font-size:13pt;'; 
	}
	if($post_data['word_spacing'] != ''){
		echo 'word-spacing:'.$post_data['word_spacing'].'pt;';
	} else{
		//echo 'word-spacing:8pt;';
	}
	?>
}
table#orders td, table#orders th{
	vertical-align:top;
}
@page{
	margin:1in .6in .6in 1in;		
}
</style>
<?php
$contents   = '<table id="orders" style="width:100%;">' ;
$contents  .= '<tr><td align="center"><h3><u>'.@$dept_name.', भोपाल</u></h3></td></tr>';
$contents  .= '<tr><td align="center"><h3><u>अधिसूचना</u></h3></td></tr>';
$contents  .= '<tr><td align="right">भोपाल दिनांक ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['file_head_date'].'</b>';
}else{
	$contents .=  '<input type="text" class="date1" name="file_head_date" value="'.date('d-m-Y').'" placeholder="dd/mm/yyyy" />';
}
$contents  .= '</td></tr>';
 $contents  .= '<tr><td><p>फा.क्र.1-2-90/21-ब(एक)'.$file_number.'/'.date("Y").', अनुसूचित जातियां और अनुसूचित जनजातियां (अत्याचार निवारण) अधिनियम, 1989 (1989 का 33) की धारा 14 द्वारा प्रदत्त शक्तियों को प्रयोग में लाते हुए तथा विषेष न्यायालय, ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['distict_name'].'</b>';
}else{
	$contents  .= get_distic_dd('distict_name');	
}
$contents  .= ' से संबंधित इस विभाग की अधिसूचना फा.क्रमांक 1-2-90/21-ब(एक), दिनांक 15 सितम्बर, 2009 में आंषिक उपांतरण करते हुए, राज्य शासन, मध्यप्रदेश उच्च न्यायालय के माननीय मुख्य न्यायाधिपति की सहमति से, एतद्द्वारा, सेशन न्यायाधीष,  ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['distict_name'].'</b>';
}else{
	$contents  .= '----------';	
}
$contents  .= ' के न्यायालय को उक्त अधिनियम के अधीन अपराधों का विचारण करने के लिए विषेष न्यायालय के रुप में विनिर्दिष्ट करता है। </p></td></tr>';
$contents  .= '<tr><td><p>2.	इस विभाग की अधिसूचना फा.क्रमांक 1-2-90/21-ब(एक), दिनांक 15.09.2009 द्वारा गठित विषेष न्यायालय,  ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['distict_name'].'</b>';
}else{
	$contents  .= '----------';	
}
$contents  .= '  में लंबित सभी मामले, पैरा-1 के अधीन विषेष न्यायालय का गठन होने की तारीख को सम्बन्धित विषेष न्यायालय में अंतरित हो जाएंगे। </p></td></tr>';
$contents  .= '<tr><td align="center"><h3><u>NOTIFICATION</u></h3></td></tr>';
$contents  .= '<tr><td><p>F.N0.1-2-90-2015-XXI-B(1)'.$file_number.'/'.date("Y").',- In exercise of the powers conferred by section 14 of the Scheduled Castes and the Scheduled Tribes (Prevention of Atrocities) Act, 1989 (N0.33 of 1989) and in partial modification of this department’s Notification F.No.1-2-90/21-B(1), dated  15th September 2009 relating to Special Court, ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['distict_name_en'].'</b>';
}else{
	$contents .= '<input name="distict_name_en" placeholder="जिले का नाम अंग्रेजी में"    type="text" />' ;
}
$contents .= ' the State Government with the concurrence of the Chief Justice of the High Court of Madhya Pradesh, hereby, specify the Court of Sessions Judge, ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['distict_name_en'].'</b>';
}else{
	$contents .= '--------' ;
} 
$contents .= ' to be a Special Court to try the offences under the said Act.</p></td></tr>';
$contents  .= '<tr><td><p>2.	All cases pending in the Special Court of ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['distict_name_en'].'</b>';
}else{
	$contents .= '--------' ;
}
$contents .= ' constituted by this Department’s Notification F.No. 1-2-90/21-B(1), dated 15th September 2009, on the date of constitution of Special Court under para-1, shall stand transferred to the respective Special Court.</td></tr></p>';
$contents .= '<tr><td align="right">';
if($is_genrate == true){
	 $contents .= '<b>'.$post_data['adeshnadar'].'</b>';
}
else{
	 $contents .= '<input name="adeshnadar" placeholder=""  size="100" value="मध्यप्रदेश के राज्यपाल के नाम से तथा आदेशानुसार,"  type="text" />' ;
}
$contents .= '</td></tr>';
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right"><div  style="width:70%; text-align:center;">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td>&nbsp;</td></tr>';
}
$contents .= '<tr><td align="right"><div style="width:70%; text-align:center;">(<b>';
if($is_genrate == true){	 
	$contents .= get_officer_information($this->input->post('sing_user')); 
}else{
	$contents .= get_officer_for_sign('sing_user' ,array(2,3,4,5,7) ,'', $us_id);
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
$contents .= '<tr><td align=""><div style="height:120px;"></div></td></tr>';
$contents .= '<tr><td><div style="float:left">';
if($is_genrate == true){
	 $contents .= '<b>'.$post_data['file_head'].'</b>';
}
else{
	 $contents .= '<input name="file_head" placeholder="file no" size="50" value="फा.क्र.1-2-90/21-ब(एक)'.$file_number.'/'.date("Y").',"  type="text" />' ;
}
$contents .= '</div><div style="float:right;">';
$contents .= 'भोपाल, दिनांक ';
if($is_genrate == true){
	 $contents .= '<b>'.$post_data['file_head_date'].'</b>';
}
else{
	 $contents .= '----------' ;
}
$contents .= '</div></td></tr>';

//for pratilipit
$contents .= '<tr><td align="">प्रतिलिपि :-</td></tr>';
$contents .= '<tr><td><table width="100%"><tr><td width="10%" valign="top">1.</td><td width="*%" valign="top">';
$contents .= 'रजिस्ट्रार जनरल, मध्यप्रदेश उच्च न्यायालय, जबलपुर, के पत्र क्र.  ';
   if($is_genrate == true){
	   $contents .= '<b>'.$post_data['patra_no'].'</b>';
}else{
	$contents .= '<input name="patra_no" placeholder="पत्र क्रमांक "    type="text" />' ;
}    
$contents .= ' के संदर्भ में,';
$contents .= '</td></tr></td></tr></table>';
$contents .= '<tr><td><table width="100%"><tr><td width="10%" valign="top">2.</td><td width="*%" valign="top">';
$contents .= 'प्रमुख सचिव, गृह (पुलिस) विभाग, मध्यप्रदेश शासन, भोपाल,';
$contents .= '</td></tr></td></tr></table>';
$contents .= '<tr><td><table width="100%"><tr><td width="10%" valign="top">3.</td><td width="*%" valign="top">';
$contents .= 'प्रमुख सचिव, म.प्र. शासन, आदिम जाति एवं अनुसूचित जाति कल्याण विभाग, मंत्रालय, भोपाल,';
$contents .= '</td></tr></td></tr></table>';
$contents .= '<tr><td><table width="100%"><tr><td width="10%" valign="top">4.</td><td width="*%" valign="top">';
$contents .= 'जिला एवं सत्र न्यायाधीश, ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['distict_name'].'</b>';
}else{
	$contents  .= '----------';	
}
$contents  .= ', (म.प्र.), </td></tr></td></tr></table>';
$contents .= '<tr><td><table width="100%"><tr><td width="10%" valign="top">5.</td><td width="*%" valign="top">';
$contents .= 'उप नियंत्रक, शासन केन्द्रीय मुद्रणालय, भोपाल,<br/>
की ओर सूचनार्थ एवं आवश्यक कार्यवाही हेतु (म.प्र. राजपत्र भाग-1 के आगामी अंक में प्रकाशनार्थ) पे्रषित।<br/>
( ) केवल मुद्रणालय के लिये।,'; 
$contents .= '</td></tr></td></tr></table>';
$contents .= '<tr><td><table width="100%"><tr><td width="10%" valign="top">6.</td><td width="*%" valign="top">';
$contents .= 'शाखा प्रभारी, आय.टी.शाखा,विधि और विधायी कार्य विभाग,भोपाल की ओर अधिसूचना की प्रति नेट पर अपलोड़ करने बाबत प्रेषित।';
$contents .= '</td></tr></td></tr></table>';

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

?>


                
                
        
                  
                
               
                