<?php
$contents  = '' ;
$contents .= '<tr><td align="right" colspan="3"><u>स्पीड-पोस्ट द्वारा</u></td></tr>';
$contents .= '<tr><td align="center" colspan="3"><h2><u>मध्यप्रदेश शासन, विधि एवं विधायी कार्य विभाग, भोपाल</u></h2></b></td>';
$contents .= '</tr>';
$contents .= '<tr>';
$contents .= '<td colspan="2"> क्रमांक 12/';
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
$contents .= ' (म.प्र.),<br /><br />';
$contents .= '</td><td>&nbsp;</td></tr><tr><td align="left" valign="top">';

$contents .= 'विषय:-</td><td colspan="2" style="text-align: justify"> न्यायालय विशेष न्यायाधीश, जिला ------ के विशेष प्रकरण क्रमांक --------- म0 प्र0 शासन विरुद्ध  ----------- के मामले में भ्रष्टाचार निवारण अधिनियम 1988 की धारा - ---------------- के अंतर्गत पारित दोषमुक्ति दिनांक के विरुद्ध अपील प्रस्तुत किये जाने बाबत | </td></tr>';

$contents .= '<td colspan="3" style="text-align: justify"> सन्दर्भ :- महानिरीक्षक (पूर्व) विशेष पुलिस स्थापना , लोकायुक्त कार्यालय, भोपाल (म0प्र0) के पत्र क्रमांक '.$file_subject.' </td></tr>';
$contents .= '<tr><td align="center" colspan="3" valign="top">';
$contents .= '---0---';
$contents .= '</td></tr>';
$contents .= '<tr><td colspan="3"><p>राज्य शासन द्वारा उपरोक्त विषयांतगर्त एवं संदर्भित प्रकरण में अभियुक्तगण -------------- के विरुद्ध दोषमुक्ति के विरुद्ध मध्यप्रदेश उच्च न्यायालय जबलपुर के समक्ष अपील प्रस्तुत करने का निर्णय लिया गया है | अतः आप राज्य शासन द्वारा  लिये गये निर्णय के अनुसार द.प्र.स. की धारा 378 के  अंतर्गत मध्यप्रदेश उच्च न्यायालय जबलपुर के समक्ष अपील प्रस्तुत करें तथा कार्यवाही की सूचना शीघ्र  विधि विभाग को प्रेषित करें | </p></td></tr>';
$contents .= '<tr><td colspan="3"><b>(सचिव विधि द्वारा अनुमोदित)</b></p></td></tr>';
$contents .= '<tr><td colspan="3"><u>संलग्न दस्तावेज  :- </u></td></tr>';
$contents .= '<tr><td colspan="3">1- सचिव मध्यप्रदेश शासन '.@$file_department.'मंत्रालय वल्लभ भवन भोपाल की ओर उनके यू.ओ .क्रमांक '.$file_uo_or_letter_no.' दिनांक '.$file_uo_or_letter_date1.' के सन्दर्भ में म०प्र०विधि विभाग नियमावली के नियम 136 के अधीन आवश्यक निर्देश दीजिये कि वे प्रकरण से संबंधित अभिलेख तथा अन्य कागज़ात के साथ शासकीय अधिवक्ता  से संम्पर्क करे |</td></tr>';
$contents .= '<tr><td colspan="3">2 . जिला दंडाधिकारी ';
if($is_genrate == true){
$contents .= $post_data['state_1'];
}else
{
	$contents .=  get_distic_dd('state_1');
}

$contents .= ' (म०प्र०) की ओर सूचनार्थ एवं आवश्यक कायर्वाही हेतु प्रेषित |</td></tr>';
$contents .= '<tr><td colspan="3">3 . पुलिस अधीक्षक ';
if($is_genrate == true){
$contents .= $post_data['state_1'];
}else
{
	$contents .=  get_distic_dd('state_1');
}

$contents .= '( म०प्र०) की ओर सूचनार्थ एवं आवश्यक कार्यवाही हेतु प्रेषित |</td></tr>';
$contents .= '<tr><td colspan="3">&nbsp;</td></tr>';
$contents .= '<tr><td colspan="3" align="right"><div style="width:70%; text-align:center;">( ';
if($is_genrate == true){
$contents .= $post_data['avar_secetroy'];
}else
{
	 $contents .= '<select name="avar_secetroy"><option>हरि मोहन बाथम</option><option>रजनी पंचौली</option></select>';
	
}
$contents .= ' )</div></td></tr>';
$contents .= '<tr><td colspan="3" align="right"><div style="width:70%; text-align:center;">';
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
$contents .= '</div></td></tr>';
$contents .= '<tr><td colspan="3" align="right"><div style="width:70%; text-align:center;">मध्यप्रदेश शासन विधि और विधायी कार्य विभाग,भोपाल</div></td></tr>';
?>
