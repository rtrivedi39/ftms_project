<?php
$contents  = '' ;
$contents .= '<tr><td align="right" colspan="3"><u>स्पीड-पोस्ट द्वारा</u></td></tr>';
$contents .= '<tr><td align="center" colspan="3"><h2><u>मध्यप्रदेश शासन, विधि एवं विधायी कार्य विभाग, भोपाल</u></h2></b></td>';
$contents .= '</tr>';
$contents .= '<tr>';
$contents .= '<td colspan="2"> क्रमांक 6/';
$contents .= @$this->input->post('head') ? $this->input->post('head') : '<input name="head" placeholder="file no" type="text" />';
$contents .= '/'.date("y").'/'.$panji_krmank.'/21-क (आप),</span';
$contents .= '</td><td align="right"><span id="Label1">भोपाल, दिनांक '.date("d-m-Y").' </td>';
$contents .= '</tr><tr><td align="left" valign="top" width="55px"> प्रति,</td><td>&nbsp; &nbsp;<br />';


if($is_genrate == true){
    $contents .= '<span>'.$post_data['advocate_type'].',</span>';
}else{
    $contents .= '<select name="advocate_type">';
    foreach($advocate_type as $row){
        $contents .= '<option value="'.$row.'">'.$row.'</option>';
    }
    $contents .= '</select>';
    $contents .= '<br/>__ कार्यालय,';
}
$contents .= '<br />';
if($is_genrate == true){
    $contents .= '<span>'.$post_data['advocate_type'].' कार्यालय,<br /></span>';
}
$contents .= 'मध्यप्रदेश उच्च न्यायालय,<br />';
if($is_genrate == true){
    $contents .= '<span>'.$post_data['court_location'].'</span>';
}else{
    $contents .= '<select name="court_location">';
    foreach($court_location as $row){
        $contents .= '<option value="'.$row.'">'.$row.'</option>';
    }
    $contents .= '</select>';
}
$contents .= ' (म.प्र.),<br />';
$contents .= '</td><td>&nbsp;</td></tr><tr><td align="left" valign="top">';
$contents .= 'विषय:-</td><td colspan="2" style="text-align: justify"> '.$file_subject.' </td></tr>';
$contents .= '<tr><td align="left" valign="top">';
$contents .= 'सन्दर्भ :-</td><td colspan="2" style="text-align: justify"></td></tr>';
$contents .= '<tr><td align="center" colspan="3" valign="top">';
$contents .= '/////';
$contents .= '</td></tr>';
$contents .= '<tr><td colspan="3"><p>राज्य शासन द्वारा उपरोक्त विषयांतर्गत एवं संदर्भित प्रकरण में ';
if($is_genrate == true){
	  $contents .= '<span>'.$post_data['doshmukti'].'</span>';
}
else{
	$contents .= '<select name="doshmukti"><option>दोषमुक्ति</option><option>सजावृधि </option></select>';
}
  
$contents .= 'निर्णय के विरद्ध अभियुक्त के संबंध में मध्यप्रदेश उच्च न्यायालय  ------- के समक्ष अपील प्रस्तुत करने का निर्णय लिया गया है | अपील प्रस्ताव दिनांक ';
if($is_genrate == true){
	$contents .= $post_data['text1'];
}else{ 
$contents .= '<input name="text1" type="text" class="date1" />';
}
 $contents .= 'को विधि विभाग में प्राप्त हुआ है | अपील प्रस्तुत करने की परिसीमा दिनांक ';
 if($is_genrate == true){
$contents .= $post_data['text2'];
}else{ 
$contents .= '<input name="text2" type="text" class="date1"/>';
}

 $contents .= 'तक है / थी |</p></td></tr>';
$contents .= '<tr><td colspan="3"><p>अतः आप राज्य शासन द्वारा लिये गये निर्णय के  अनुसार द. प. स. की धारा 377 , 378 के  अंतर्गत मध्यप्रदेश उच्च न्यायालय ---------- के समक्ष दिनांक ';
 if($is_genrate == true){
$contents .= $post_data['text3'];
}else{ 
$contents .= '<input name="text3" type="text" class="date1"/>';
}
$contents .= ' तक अपील प्रस्तुत करने की समुचित कार्यवाही करें | यदि नियत दिनांक ';
 if($is_genrate == true){
$contents .= $post_data['text4'];
}else{ 
$contents .= '<input name="text4" type="text" class="date1"/>';
}
$contents .= ' तक अपील प्रस्तुत नहीं की जाती है तो दिन-प्रतिदिन विलम्ब का कारण दर्शित करते हुए विलम्ब माफी हेतु आवेदन पत्र जो शपथपत्र से समर्पित हो सहित अपील प्रस्तुत की जाये तथा कार्यवाही की सूचना शीघ्र विभाग को प्रेषित करें |  </p></td></tr>';
$contents .= '<tr><td colspan="3">संलग्न दस्तावेज :- </td></tr>';
$contents .= '<tr><td colspan="3" align="right">मध्यप्रदेश के राज्यपाल के नाम से आदेशानुसार , </td></tr>';
$contents .= '<tr><td colspan="3"><div style="float:right; width:70%; text-align:center"><b>(';
if($is_genrate == true){
$contents .= $post_data['avar_secetroy'];
}else
{
	 $contents .= '<select name="avar_secetroy">';
	$contents .=  '<option>रजनी पंचोली</option><option>एच. एम. बाथम</option></select>';
}

$contents .= ') <br />';
if($is_genrate == true){
    $contents .= '<span>'.$post_data['dsin'].'</span>';
}else {
    $contents .= '<select name="dsin">';
    foreach ($dsig as $row) {
       if($row == 'अवर सचिव'){
			 $contents .= '<option value="' . $row . '" selected>' . $row . '</option>';
		}else
		{
        $contents .= '<option value="' . $row . '">' . $row . '</option>';
		}
	}
    $contents .= '</select>';
}
$contents .= '<tr><td colspan="3" align="right" ><div  style="width:70%; text-align:center">'.$dept_name.', भोपाल</div> </td></tr>';
?>



