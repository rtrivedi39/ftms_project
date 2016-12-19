<style>
p{
	line-height:24px;	
}
</style>
<?php 
$contents  = '<table style="font-size:14px;  width:90%; margin:0% auto;">' ;

$contents .= '<tr><td align="center"> <u><h4>'.$dept_name.' </u></h4></td></tr>';
$contents .= '<tr><td align="center"> <u><h4>// आ दे श //</u></h4></td></tr>';
$contents .= '<tr><td><p>फा.क्र.3(ए)/';
if($is_genrate == true){
	 $contents .= $post_data['number'];
}
else{
	 $contents .= '<input name="number" placeholder="file no" type="text" />' ;
}
$contents .= '/'.date("y").'/'.$panji_krmank.'/21-क (सि.), राज्य शासन,  ';
if($is_genrate == true){
    foreach(get_advocates_name('', $post_data['member_id']) as $row){
        $contents .= ' <b>'.$row->scm_name_hi.'</b>';
    }
} else {
    $contents .= ' <select name="member_id">';
    foreach($madhyastam_adhivkta as $row){
        $contents .= '<option value="'.$row->scm_id.'">'.$row->scm_name_hi.'</option>';
    }
    $contents .= '</select>';
}
$contents .= ' अधिवक्ता, भोपाल को माध्यस्थम अधिकरण भोपाल के समक्ष प्रस्तुत प्रकरण क्रमांक '.$case_no.'  ' ;
if($is_genrate == true){
	 $contents .= $post_data['virudh'];
}
else{
	 $contents .= '<input name="virudh" placeholder="" size="30" type="text" value="'.$agenst_name.'" />' ;
}
$contents .= '  विरूद्ध म.प्र. शासन एवं अन्य मे, शासन की ओर से पैरवी करने हेतु नियुक्त करता है।</p></td></tr>';

$contents .= '<tr><td><p>उन्हें म.प्र. सिविल कोर्ट नियम 1961 के नियम 523 के अनुसार फीस देय होगी, जिसकी अधिकतम सीमा रूपये-5000/-(रूपये पांच हजार) केवल होगी, परन्तु यदि प्रकरण का निराकरण समय के पूर्व प्रारंभिक स्टेज पर हो जाता है, तो यह फीस अधिकतम सीमा रूपये-1000/-(रूपये एक हजार) केवल होगी।</p></td></tr>';
$contents .= '<tr><td align="right">मध्यप्रदेश के राज्यपाल के नाम से तथा आदेशानुसार</td></tr>';
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right"><div  style="width:60%; text-align:center;">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td>&nbsp;</td></tr>';
}
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">(<b>';
if($is_genrate == true){
	$contents .=  get_officer_information($this->input->post('avar_secetroy')); 
}else{
	 $contents .= get_officer_for_sign('avar_secetroy' ,array(2,3,4,5,7,11) ,'', $us_id);
}
$contents .= '</b>)</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">';
if($is_genrate == true){
		$contents .= '<b>'.get_officer_dign($this->input->post('avar_secetroy')).'</b>';
} else {
	$contents .= '----------';
} 
$contents .= '</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">'.$dept_name.'</div></td></tr>';
$contents .= '<tr><td><div style="float:left"> फा.क्र.3(ए)/';
if($is_genrate == true){
	 $contents .= $post_data['number'];
}
else{
	 $contents .= '--------------' ;
}

$contents .= '/'.date("y").'/'.$panji_krmank.'/21-क (सि.), </div><div style="float:right;">';
$contents .= 'भोपाल, दिनांक '.date("d-m-Y").'</div></td></tr>';
$contents .= '<tr><td align="">प्रतिलिपि :-</td></tr>';
$contents .= '<tr><td><table style="font-size:14px;"><tr><td width="10%" valign="top">1. </td> <td>न्यायालय माध्यस्थम अधिकरण, विन्धयाचल भवन भोपाल की ओर सूचनार्थ अग्रेषित।</td></tr>';
$contents .= '<td width="10%" valign="top">2.</td><td width="*%" valign="top">सचिव, म.प्र. शासन, '.$file_department.' विभाग की ओर उनके जावक क्रमांक '.$file_uo_or_letter_no.'  दिनांक '.$file_uo_or_letter_date.' के संदर्भ में उनकी नस्ती सहित सूचनार्थ एवं आवश्यक कार्यवाही हेतु अग्रेषित।</td></tr>';
$contents .= '<td width="10%" valign="top">3.</td><td width="*%" valign="top">';
if($is_genrate == true){
	 $contents .='<b>'.$post_data['name1'].'</b>';
}
else{
	 $contents .= '<input name="name1" placeholder="" size="50" value="कार्यपालन यंत्री, लो0नि0वि0" type="text" />' ;
}
$contents .= ' म.प्र. की 	ओर 	सूचनार्थ एवं आवश्यक कार्यवाही हेतु अग्रेषित।</td></tr>';
$contents .= '<td width="10%" valign="top">4.</td><td width="*%" valign="top">';
if($is_genrate == true){
    foreach(get_advocates_name('', $post_data['member_id']) as $row){
        $contents .= '<b>('.$row->scm_name_hi.')'.', '.$row->scm_post_hi.', '.$row->scm_address_hi.'</b>';
    }
} else {
	$contents .= '----------- ';
}
$contents .= ' की 	ओर 	सूचनार्थ एवं आवश्यक कार्यवाही हेतु अग्रषित।</td></tr>';
$contents .= '</table></td></tr>';
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right"><div  style="width:60%; text-align:center;">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td>&nbsp;</td></tr>';
}
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">(<b>';
if($is_genrate == true){
	$contents .= get_officer_information($this->input->post('avar_secetroy')); 
} else {
	$contents .= '--------------';	
}
$contents .= '</b>)</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">';
if($is_genrate == true){
		$contents .= '<b>'.get_officer_dign($this->input->post('avar_secetroy')).'</b>';
} else {
	$contents .= '------------';
} 
$contents .= '</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">'.$dept_name.'</div></td></tr>';
$contents .= '</table>';

