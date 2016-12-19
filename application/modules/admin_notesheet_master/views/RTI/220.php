<style>
p{
	line-height:24px;
}
</style>
<?php 
$contents  = '<table style="font-size:14px;  width:100%; margin:0% auto;">' ;
$contents .= '<tr><td align="right"><b><u>सूचना का अधिकार</u></b></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td>फा. क्र.  '.$file_number.'/सू.अ./'.date("Y").'</td></tr>';
$contents .= '<tr><td align="center"> <b>सूचना का अधिकार अधिनियम, 2005 </b></td></tr>';
$contents .= '<tr><td align="left">आवेदक का नाम श्री     ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['avedak'].'</b>';
}else{
    $contents .=  '<input type="text" class=""  size="50px" name="avedak" value="" placeholder="आवेदक का नाम " required>';
}
$contents .=  '</td></tr>';
$contents .= '<tr><td align="center"> पंजी क्रमांक  :- '.$file_number.'/सू.अ./'.date("Y").' दिनांक       /        / '.date("Y").'</div>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td align="center"> -------000------- </td></tr>';
$contents .= '<tr><td><p> उपरोक्त विषयान्तर्गत  राज्य सूचना आयोग से प्राप्त पत्र का कृृपया अवलोकन कीजिए, जो द्वितीय अपील प्रकरण क्रमांक ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['kramank_namme'].'</b>';
}else{
    $contents .=  '<input type="text" class=""  size="100px" name="kramank_namme" value="" placeholder="क्रमांक एवं नाम" required>';
}
$contents .= ' जो राज्य लोक सूचना अधिकारी एवं अपीलीय अधिकारी को सम्बोधित होकर प्राप्त हुआ हैं। </p> </td></tr>';
$contents .= '<tr><td><p>  उपरोक्त द्वितीय अपील प्रकरण में माननीय मुख्य सूचना आयुक्त महोदय द्वारा पारित आदेश दिनांक ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['adsh_dinank'].'</b>';
}else{
    $contents .=  '<input type="text" class=""  size="30px" name="adsh_dinank" value="" placeholder="" required>';
}
$contents .=  ' की प्रति संलग्न प्रेषित करते हुए लेख किया है कि राज्य लोक सूचना अधिकारी को निर्देशित किया जाता है कि इस आदेश प्राप्ति के ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['mah_tak'].'</b>';
}else{
    $contents .=  '<input type="text" class=""  size="30px" name="mah_tak" value="" placeholder="" required>';
}
$contents .=  ' में अपीलार्थी की पुनर्विलोकन याचिका पर यदि कोई कार्यवाही की गई हो तो उससे संबंधित संधारित नस्ती की प्रमााणित प्रति अपीलार्थी को निःशुल्क उपलब्ध कराई जाए तथा यदि कोई कार्यवाही नहीं की गई है तो इस आशय की स्पष्ट लिखित सूचना अपीलार्थी को दी जाये। उक्त निर्देश के साथ अपील निराकृत की गई है।  ';
$contents .= '<tr><td><p>अतः प्राप्त आदेश के पालन में आवेदक से प्राप्त आवेदन एवं राज्य सूचना आयोग से प्राप्त आदेश की छायाप्रति उपलब्ध कराते हुए ';
if($is_genrate == true){ 
    $contents .=  ' <b>'.getSection($post_data['section_shakha']).'</b>';
} else {
	$contents .= ' <select name="section_shakha" class="section">';
	$sections = get_list(SECTIONS,'','');	
	foreach($sections as $row){
		$contents .= '<option value="'.$row['section_id'].'">'.$row['section_name_hi'].'('.$row['section_name_en'].')</option>';
	}
	$contents .= '</select>';
}
$contents .= ' को जानकारी प्रदाय किये जाने हेतु निर्देषित किया जाना उचित होगा ।।</p> </td></tr>';
$contents .= '<tr><td><p> तदनुसार नस्ती  ';
if($is_genrate == true){
	$contents .=  ' <b>'.getSection($post_data['section_shakha']).'</b>';
}else{
    $contents .=  '<---------';
}
$contents .= ' की ओर अंकित करने का कृपया कष्ट करें ।</p> </td></tr>';
$contents .= '<tr><td><p> आदेशार्थ प्रस्तुत है। </p> </td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
if($this->uri->segment(6) == 'p' || $this->uri->segment(7) == 'p'  ){
$contents .= '<tr><td><u>अनुभाग अधिकारी (सिविल)</u></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>अवर सचिव (सिविल)</u></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>अति. सचिव (सिविल)</u></td></tr>';
}
$contents .= '</table>';