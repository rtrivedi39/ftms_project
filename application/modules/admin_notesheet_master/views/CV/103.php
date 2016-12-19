<style>
p{
	line-height:19px;
}td{
	padding:0px;
}
</style>
<?php 
$contents  = '<table style="font-size:12px; margin:0% auto; width:90%;">' ;
$contents .= '<tr><td align="right"><b><u>स्पीड पोस्ट द्वारा</b></u></td></tr>';
$contents .= '<tr><td align="center"><h5><b>फा0क्र0 4(ए)/';
if($is_genrate == true){ 
    $contents .=  $post_data['number'];
} else {
    $contents .= '<input type="text" class="" name="number"  value=""/>';
}
$contents .= '/'.date("Y").'/'.$file_number.'/21-क(सि.)</b></h5></td></tr>';
$contents .= '<tr><td align="center"><u><h5>'.$dept_name.'</h5></u></td></tr>';
$contents .= '<tr><td align="left"><b>प्रेषकः-</b></td></tr>';
$contents .= '<tr><td align="left"><span style="margin-left:8%">';
if($is_genrate == true){
	$contents .=  get_officer_information($this->input->post('add_secetroy')); 
}else{
	 $contents .= get_officer_for_sign('add_secetroy' ,array(2,3,4,5,7,11) ,'', $us_id);
}
$contents .= '</span></td></tr>';
$contents .= '<tr><td align="left"><span style="margin-left:8%">';
if($is_genrate == true){	
    $contents .=   get_officer_dign($this->input->post('add_secetroy'));
}
else {
	 $contents .= '-------';
	}
$contents .= ', विधि</span></td></tr>';
$contents .= '<tr><td align="left"><b>प्रति,</b></td></tr>';
if($is_genrate == true){
    foreach(get_advocates_name('', $post_data['member_id']) as $row){
        $contents .= '<tr><td align="left"><span style="margin-left:8%">'.$row->scm_name_hi.'</span>,</td></tr>';
        $contents .= '<tr><td align="left"><span style="margin-left:8%">'.$row->scm_post_hi.', '.$row->scm_court_name_hi.'</span>,</td></tr>';
		$contents .= '<tr><td align="left"><span style="margin-left:8%">'.$row->scm_address_hi.',</span></td></tr>';
        $contents .= '<tr><td align="left"><span style="margin-left:8%">'.$row->scm_pincode_hi.'</span></td></tr>';    }
} else {
    $contents .= '<tr><td align="left"><select name="member_id">';
    foreach($standing_counsil_memebers as $row){
        $contents .= '<option value="'.$row->scm_id.'">'.$row->scm_name_hi.'</option>';
    }
    $contents .= '</select></td></tr>';
}
$contents .= '<tr><td align="right"> भोपाल, दिनांक ';
if($is_genrate == true){ 
    $contents .=  get_date_formate($post_data['date1'],'d/m/Y').'</td></tr>';
} else {
    $contents .= ' <input type="text" class="date1" name="date1" placeholder="dd/mm/yyyy" value="'.$today.'"/></td></tr>';
} 
$contents .= '<tr><td><table><tr><td style="width:7%; vertical-align: top;"><b>विषय:- </b></td><td>';
if($is_genrate == true){ 
    $contents .=  $post_data['subject'];
} else {
    $contents .= '<textarea name="subject" rows="" columns="">'.$file_subject.'</textarea>';
}
$contents .= '</td></tr></table></td></tr>';

$contents .= '<tr><td align="center">--------------</td></tr>';
$contents .= '<tr><td align="left"><b>महोदय,</b></td></tr>';
$contents .= '<tr><td align="left"><p>उपरोक्त विषयांतर्गत  प्रकरण में म०प्र० शासन की ओर से माननीय उचचतम न्यायलय नई दिल्ली में पैरवी करें |</p></td></tr>';
$contents .= '<tr><td><div style="float:left; width:17%"><b>संलग्न :-</b></div><p style="text-indent:0;"> वकालतनामा | </p></td></tr>';

$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">भवदीय,</div></td></tr>';
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right"><div  style="width:60%; text-align:center;">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td>&nbsp;</td></tr>';
}
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">(';
if($is_genrate == true){
	$contents .=  get_officer_information($this->input->post('add_secetroy')); 
}else{
	$contents .= '-------';
}
$contents .= ')</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">';
if($is_genrate == true){	
    $contents .=   get_officer_dign($this->input->post('add_secetroy'));
}
else {
	 $contents .= '-------';
	}
$contents .= '</div></td></tr>';$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">'.$dept_name.'</div></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';

$contents .= '<tr><td align="left"><div style="float:left;">पृ0 क्रमांक 4(ए)/';
if($is_genrate == true){ 
    $contents .=  $post_data['number'];
} else {
    $contents .= '-------';
}
$contents .= '/'.date("Y").'/'.$file_number.'/21-क(सि.)</div><div style="float:right;">भोपाल, दिनांक ';
if($is_genrate == true){ 
    $contents .=  get_date_formate($post_data['date4'],'d/m/Y');
} else {
    $contents .= '<input type="text" class="date1" name="date4" placeholder="dd/mm/yyyy" value="'.$today.'"/></div>';
}
$contents .=  '</td></tr>';
$contents .= '<tr><td><tr><td><u>प्रतिलिपि:</u></td></tr>';

$contents .= '<tr><td><p>1- सचिव, म.प्र. शासन, <b>'.$file_department.',</b> भोपाल की ओर उनके    यू.ओ.क्र  '.$file_uo_or_letter_no.' दिनांक '.get_date_formate($file_judgment_date,'d/m/Y').' के संदर्भ में उनकी विभागीय नस्ती  के साथ भेजकर अनुरोध है कि  प्रकरण मे प्रभारी अधिकारी को निर्देश दे कि पवे तत्काल  ';
 if($is_genrate == true){
    foreach(get_advocates_name('', $post_data['member_id']) as $row){
        $contents .= ' '.$row->scm_name_hi.'</span>,';
    }
} else {
    $contents .= '-------------';
}
 $contents .= ', नई दिल्ली में संपर्क कर आवश्यक कार्यवाही करे |   </td></tr>';
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">भवदीय,</div></td></tr>';
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right"><div  style="width:60%; text-align:center;">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td>&nbsp;</td></tr>';
}
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">(';
if($is_genrate == true){
	$contents .=  get_officer_information($this->input->post('add_secetroy')); 
}else{
	$contents .= '-------';
}
$contents .= ')</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">';
if($is_genrate == true){	
    $contents .=   get_officer_dign($this->input->post('add_secetroy'));
}
else {
	 $contents .= '-------';
	}
$contents .= '</div></td></tr>';$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">'.$dept_name.'</div></td></tr>';
$contents .= '</table>';
?>   

