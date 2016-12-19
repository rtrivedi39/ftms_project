<?php 
$contents  = '' ;
$contents .= '<tr><td align="right"><b><u>स्पीड पोस्ट द्वारा</u></b></td></tr>';
$contents .= '<tr><td align="center"> फा0क्र0 5/';
if($is_genrate == true){
	$contents .= $post_data['number'];
}else{
	$contents .=  '<input type="text" class="" name="number" required>';
}
$contents .= '/'.date("Y").'/'.$file_number.'/21-क(या0) </td></tr> ';
$contents .= '<tr><td align="center"> <u><h3>'.$dept_name.'</h3></u> </td></tr>';
$contents .= '<tr><td align="left"> फा0क्र0 5/';
if($is_genrate == true){
	$contents .= $post_data['number'];
}else{
	$contents .=  '<input type="text" class="" name="number" required>';
}
$contents .= '/'.date("Y").'/'.$file_number.'/21-क(या0) </td></tr> ';
$contents .= '<tr><td> प्रेषकः-</td></tr>';
$contents .= '<tr><td><span style="margin-left:8%">'.$as_name.'</span></td></tr>';
$contents .=  '<tr><td><span style="margin-left:8%">अतिरिक्त सचिव, विधि</span></td></tr>';
$contents .= '<tr><td>प्रति,</td></tr>';
if($is_genrate == true){
    foreach(get_advocates_name('', $post_data['member_id']) as $row){
        $contents .= '<tr><td align="left"><span style="margin-left:8%">'.$row->scm_name_hi.'</span>,</td></tr>';
        $contents .= '<tr><td align="left"><span style="margin-left:8%">'.$row->scm_post_hi.', '.$row->scm_court_name_hi.'</span>,</td></tr>';
        $contents .= '<tr><td align="left"><span style="margin-left:8%">'.$row->scm_address_hi.',</span></td></tr>';
		$contents .= '<tr><td align="left"><span style="margin-left:8%">'.$row->scm_pincode_hi.'</span></td></tr>';
    }
} else {
    $contents .= '<tr><td align="left"><select name="member_id">';
    foreach($standing_counsil_memebers as $row){
        $contents .= '<option value="'.$row->scm_id.'">'.$row->scm_name_hi.'</option>';
    }
    $contents .= '</select></td></tr>';
}
$contents .= '<tr><td align="right">भोपाल, दिनांक  ';
if($is_genrate == true){
$contents .= get_date_formate($post_data['date1'],'d/m/Y').'</td></tr>';
}else
{
	$contents .=  '<input type="text" class="date1" name="date1" value="'.$today.'" placeholder="dd/mm/yyyy" />';
}
$contents .= '</td></tr>';
$contents .=  '<tr><td>विषय:- <span style="margin-left:4%"> रिट अपील क्र. '.$case_no;
if($is_genrate == true){ 
    $contents .=  ' '.$post_data['agenst_name'];
} else {
    $contents .= ' <input type="text" class="" name="agenst_name" value="'.$agenst_name.'" />';
}
$contents .= ' विरुद्ध ';
if($is_genrate == true){ 
    $contents .=  $post_data['agenst'];
} else {
    $contents .= ' <input type="text" class="" name="agenst" value="'.$agenst.'" />';
}
$contents .= ' में पारित ';
if($is_genrate == true){ 
    $contents .=  $post_data['option_for'];
} else {
	$contents .= ' <select name="option_for" class="">';
	$contents .= '<option value="आदेश">आदेश</option>';
	$contents .= '<option value="निर्णय">निर्णय</option>';
	$contents .= '</select>';
}
$contents .= ' दिनांक ';
if($is_genrate == true){ 
    $contents .=  $post_data['date2'];
} else {
    $contents .= '<input type="text" class="date1" name="date2" value="'.get_date_formate($file_judgment_date,'d/m/Y').'" placeholder="dd/mm/yyyy" />';
}

$contents .= ' के विरुध्द विशेष अनुमति याचिका प्रस्तुत  करने  बाबत| </td></tr>';
$contents .= '<tr><td align="center"> --- </td></tr>';
$contents .= '<tr><td><p> उपरोक्त विषयांकित प्रकरण में मान0 उच्च न्यायालय खण्डपीठ ग्वालियर द्वारा पारित आदेश दिनांक ';
if($is_genrate == true){
$contents .=  $post_data['date3'];
}else
{
	$contents .=  '<input type="text" class="date1" name="date3" value="'.get_date_formate($file_judgment_date,'d/m/Y').'" placeholder="dd/mm/yyyy" />';
}
$contents .=' के विरुध्द  मान0 उच्चतम न्यायालय के समक्ष विशेष अनुमति याचिका प्रस्तुत करें।</p></td></tr>';
$contents .='<tr><td><p>हस्ताक्षरयुक्त वकालतनामा संलग्न कर भेजा जा रहा है।</p></td></tr>';
$contents .= '<tr><td align="right">मध्यप्रदेश के राज्यपाल के नाम से तथा आदेशानुसार,</td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">('.$as_name.')</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">अतिरिक्त सचिव</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">'.$dept_name.'</div></td></tr>';
$contents .= '<tr><td align="left"><div style="float:left;">पृ0 क्रमांक 5/';
if($is_genrate == true){
	$contents .= $post_data['number'];
}else{
	$contents .=  '<input type="text" class="" name="number"  required>';
}
$contents .= '/'.date("Y").'/'.$file_number.'/21-क(या0)</div><div style="float:right;">भोपाल, दिनांक ';
if($is_genrate == true){ 
    $contents .=  get_date_formate($post_data['date4'],'d/m/Y');
} else {
    $contents .= '<input type="text" class="date1" name="date4" placeholder="dd/mm/yyyy" value="'.$today.'"/></div>';
}
$contents .=  '</td></tr>';
$contents .= '<tr><td>प्रतिलिपि:-</td></tr>';
$contents .=  '<tr><td><p> सचिव, म0प्र0 शासन,‍ ';
$contents .=  ' '.$file_department;
$contents .=  ', मंत्रालय भोपाल की ओर उनके यू0ओ0क्र0 '.$file_uo_or_letter_no.', दिनांक  ';
$contents .=  ' '.get_date_formate($file_uo_or_letter_date,'d/m/Y');
$contents .= ' के संदर्भ में उनकी विभागीय नस्ती के साथ भेज कर निवेदन है कि प्रकरण के प्रभारी अधिकारी को निर्देश दे कि वह तत्काल उपरोक्त अधिवक्ता से नई दिल्ली में संपर्क कर आवश्यक कार्यवाही करवाएं साथ ही देरी के तथ्य को स्पष्ट करने का उत्तरदायित्व प्रशासकीय विभाग का होगा।';
$contents .= '</p></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">('.$as_name.')</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">अतिरिक्त सचिव</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">'.$dept_name.'</div></td></tr>';



?>

