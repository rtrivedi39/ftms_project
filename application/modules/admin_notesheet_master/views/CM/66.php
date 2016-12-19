<?php
$contents  = '' ;
$contents .= '<tr><td colspan="2" align="right"><u>स्पीड पोस्ट द्वारा</u></td></tr>';
$contents .= '<tr>';
$contents .= '<td colspan="2"> <br/><br/><table width="100%"><tr><td align="left">क्रं.';
if($is_genrate == true){
    $contents .= $post_data['head'];
}else{
	$contents .= '<input name="head" placeholder="head" type="text" />';
}

$contents .= '/'.date("y").'/'.$panji_krmank.'/21-क(आप),';
$contents .= '</td><td align="right"> भोपाल , दिनांक '.date("d-m-Y").'</td></tr></table></td></tr>';
$contents .= '<tr><td valign="top" class="style2"> प्रेषक:-</td><td></td></tr>';
$contents .= '<tr><td></td><td>';
if($is_genrate == true){
$contents .=  get_officer_information($this->input->post('secetroy')); 

}else
{
     $contents .= '--------';
    
}
$contents .= ',<br>';
if($is_genrate == true){    
    $contents .=   get_officer_dign($this->input->post('secetroy'));
}
else {
     $contents .= '-------';
    }
$contents .= ',<br>';
$contents .= 'मध्यप्रदेश शासन,<br> विधि और विधायी कार्य विभाग, भोपाल<br></td></tr>';
$contents .= '<tr><td valign="top" class="style2"> प्रति, </td><td></td><tr><td></td><td>';
if($is_genrate == true){
    foreach(get_advocates_name('', $post_data['member_id']) as $row){
        $contents .= $row->scm_name_hi;
        $contents .= ',<br />';
        $contents .= $row->scm_post_hi.', '.$row->scm_court_name_hi.',<br/>';
        $contents .= $row->scm_address_hi.',<br/>';
        $contents .= $row->scm_pincode_hi;
    }
} else {
    $contents .= '<select name="member_id">';
    foreach($standing_counsil_memebers as $row){
        $contents .= '<option value="'.$row->scm_id.'">'.$row->scm_name_hi.'</option>';
    }
    $contents .= '</select>';
    $contents .= '<br/>__';
}
$contents .= '<br></td></tr>';
$contents .= '<tr><td colspan="2">&nbsp;</td></tr>';
$contents .= '<tr><td class="style2" valign="top">विषय:- </td>';
$contents .= '<td>'.$file_subject.'</td></tr>';
$contents .= '<tr><td class="style2 top_class" valign="top" >संदर्भ:-</td><td> आपका ';
$contents .= $file_type == 'l' ? 'पत्र क्रमांक': false;
$contents .= $file_type == 'f' ? 'यू.ओ. क्रमांक': false;
$contents .= ' '.$file_uo_or_letter_no.', नई दिल्ली, दिनांक '.$file_uo_or_letter_date1.'<br> '.$file_department .' मंत्रालय, भोपाल म0 प्र0 के यू0ओ0  क्रमांक  '.$file_uo_or_letter_no.' दिनांक '.date('d-m-Y',strtotime($file_uo_or_letter_date)) .'</td></tr>';
$contents .= '<tr><td class="style2" colspan="2">&nbsp;</td>';
$contents .= '<tr><td></td><td><br> उपरोक्त प्रकरण में मध्यप्रदेश राज्य की ओर से प्रतिरक्षण करें और की गई कार्यवाही से विभाग को सूचित करें । <br><br></td></tr>';
$contents .= '<tr><td></td><td align="left"><b><u>संलग्न दस्तावेज:-</u></b><br>1-वकालतनामा</td></tr>';
$contents .= '<tr><td colspan="2">&nbsp;</td></tr>';
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right" colspan="3"><div class="officer-center">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td colspan="3">&nbsp;</td></tr>';
}
$contents .= '<tr><td colspan="2" align="right"><div contenteditable="false" class="officer-center">( ';
if($is_genrate == true){
$contents .=  get_officer_information($this->input->post('secetroy')); 

}else
{
     $contents .= get_officer_for_sign('secetroy' ,array(4,5) ,'', $s_id );
    
}

$contents .= ' )</div></td></tr>';
$contents .= '<tr><td colspan="2" align="right"><div contenteditable="false" class="officer-center">';

if($is_genrate == true){    
    $contents .=   get_officer_dign($this->input->post('secetroy'));
}
else {
     $contents .= '-------';
    }
$contents .= '</div></td></tr>';
$contents .= '<tr><td colspan="2" align="right"><div >मध्यप्रदेश शासन विधि और विधायी कार्य विभाग, भोपाल</div></td></tr>';

?>

