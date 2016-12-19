<style>
p{
	line-height:24px;
}
</style>
<?php 
$contents  = '<table style="font-size:14px;  width:80%; margin:0% auto;">' ;
$contents .= '<tr><td><div align="center"><b><u>फा.क्र.4(ए)/';
if($is_genrate == true){ 
    $contents .=  $post_data['number'];
} else {
    $contents .= '<input type="text" class="" name="number"  value=""/>';
}
$contents .= '/'.date("Y").'/'.$file_number.'/21-क(सि.)  </div></td></tr>';
$contents .= '<tr><td align="center"> <u><h4>'.$dept_name.' </u></h4></td></tr>';
$contents .= '<tr><td align="left"><b>प्रेषकः-</b></td></tr>';
$contents .= '<tr><td align="left"><span style="margin-left:8%">';
if($is_genrate == true){	 
	$contents .= get_officer_information($this->input->post('sing_user')); 
}else{
	$contents .= get_officer_for_sign('sing_user' ,array(2,3,4,5,7) ,'', $us_id);
}
$contents .= '</span></td></tr>';
$contents .= '<tr><td align="left"><span style="margin-left:8%">';
if($is_genrate == true){
	$contents .=   get_officer_dign($this->input->post('sing_user'));
}else{
	$contents .= '-------';
}
$contents .= ', विधि</span></td></tr>';
$contents .= '<tr><td align="left">प्रति,</td></tr>';
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
$contents .= '<tr><td align="left"> विषय:- माननीय  उच्च्तम न्यायालय नई दिल्ली के समक्ष विशेष अनुमति याचिका एस.एल.पी. (सिविल)  क्रमांक '.$file_number.'/'.date("Y").' में पक्ष-समर्थन करने बाबत्‌ ।</td></tr>';
$contents .= '<tr><td align="center"> -------- </td></tr>';
$contents .= '<tr><td align="left"> महोदय,</td></tr>';
$contents .= '<tr><td><p>उपरोक्त  विषयांतर्गत प्रकरण में म0प्र0 शासन की ओर से माननीय उच्च्तम न्यायालय, नई दिल्ली में पैरवी करें । </p></td></tr>';
$contents .= '<tr><td>संलग्न :- वकालतनामा </td></tr>';
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">भवदीय,</div></td></tr>';
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right"><div  style="width:60%; text-align:center;">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td>&nbsp;</td></tr>';
}
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">(';
if($is_genrate == true){
	$contents .=  get_officer_information($this->input->post('sing_user')); 
}else{
	$contents .= '-------';	
}

$contents .= ')</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">';
if($is_genrate == true){	
    $contents .=   get_officer_dign($this->input->post('sing_user'));
}else{
	$contents .= '-------';
} 
$contents .= '</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">'.$dept_name.'</div></td></tr>';
$contents .= '<tr><td></td></tr>';
$contents .= '<tr><td><div style="float:left"> फा.क्र.4(ए)/';
if($is_genrate == true){
	 $contents .= $post_data['number'];
}
else{
	 $contents .= '------------' ;
}

$contents .= '/'.date("Y").'/'.$file_number.'/21-क(सि.)   </div><div style="float:right;">';
$contents .= 'भोपाल, दिनांक '.date("d-m-Y").'</div></td></tr>';
$contents .= '<tr><td align="">प्रतिलिपि :-</td></tr>';
$contents .= '<tr><td><p>1- सचिव, म.प्र. शासन, '.$file_department.', भोपाल की ओर उनके    यू.ओ.क्र  '.$file_uo_or_letter_no.' दिनांक '.get_date_formate($file_uo_or_letter_date1,'d/m/Y').' के संदर्भ में उनकी विभागीय नस्ती के साथ भेजकर अनुरोध है कि प्रकरण में प्रभारी अधिकारी को निर्देश दे कि वे तत्काल';
if($is_genrate == true){
    foreach(get_advocates_name('', $post_data['member_id']) as $row){
        $contents .= ' '.$row->scm_name_hi.', '.$row->scm_post_hi.', '.$row->scm_court_name_hi.'</span>,';
    }
} else {
    $contents .= '----------------';
}
 $contents .= '  नई दिल्ली से संपर्क कर आवश्यक कार्यवाही करें |  </td></tr>';
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right"><div  style="width:60%; text-align:center;">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td>&nbsp;</td></tr>';
}
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">(';

if($is_genrate == true){
	$contents .=  get_officer_information($this->input->post('sing_user')); 
}else{
	$contents .= '-------';	
}

$contents .= ')</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">';
if($is_genrate == true){	
    $contents .=   get_officer_dign($this->input->post('sing_user'));
}else{
	$contents .= '-------';
} 
$contents .= '</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">'.$dept_name.'</div></td></tr>';
$contents .= '</table>';