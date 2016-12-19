<?php 
$contents  = '' ;
$contents .= '<tr><td align="center"><u><h3>'.$dept_name.'</h3></u></td></tr>';
$contents .= '<tr><td><div style="float:left">क्र0  07/';
if($is_genrate == true){
$contents .= $post_data['srno'];
}else
{
	$contents .=  '<input type="text"  name="srno" />';
}
$contents .=  '/';
if($is_genrate == true){
$contents .= $post_data['year_letter'];
}else
{
	$contents .=  '<input type="text"  name="year_letter" />';
}
$contents .= '/ पं. क्रं. '.@$file_number.'/21-क(अभि ),</div><div style="float:right">भोपाल, दिनांक   ';
if($is_genrate == true){
$contents .= $post_data['date1'].'</div></td></tr>';
}else
{
	$contents .=  '<input type="text" class="date1" name="date1" value="'.date('d-m-Y').'" placeholder="dd/mm/yyyy" />';
}
$contents .= '</div></td></tr>';
$contents .= '<tr><td align="left">प्रति,</td></tr>';

$contents .= '<tr><td><span style="margin-left:12%">जिला दंडाधिकारी, </span></td></tr>';
$contents .= '<tr><td align="left"><span style="margin-left:12%">भोपाल</span></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';

$contents .= '<tr><td align="left"><div style="float:left; width:15%;">विषय:- </div><div style="width:85%; float:left;">केन्द्रीय जेल,';
if($is_genrate == true){
$contents .= $post_data['jail_state_1'];
}else
{
$contents .=   get_distic_dd('jail_state_1');
}

$contents .=  ' में दंडित बंदी क्रमांक';
if($is_genrate == true){
$contents .= $post_data['bandi_no'];
}else
{
$contents .=  '<input type="text" name="bandi_no" />';
} 
$contents .=  ' का जेल नियम ';
if($is_genrate == true){
$contents .= $post_data['jail_law_1'];
}else
{
$contents .=  '<input type="text" name="jail_law_1" />';
} 
$contents .=  ' के अंतर्गत समय पूर्व रिहाई प्रकरण ।</div></td></tr>';
$contents .= '<tr><td align="left">संदर्भ :-	<span style="margin-left:5%">आपका यू.ओ.क्रमांक  '.@$file_uo_or_letter_no.', दिनांक '.date('d-m-Y' , strtotime(@$file_uo_or_letter_date)) .'</tr>';
$contents .= '<tr><td align="center">------0-------</td></tr>';
$contents .= '<tr><td><p>केन्द्रीय जेल, ';
if($is_genrate == true){
$contents .= $post_data['jail_state_2'];
}else
{
$contents .=  get_distic_dd('jail_state_2');
}

$contents .='   में दंडित बंदी क्रमांक ';
if($is_genrate == true){
$contents .= $post_data['bandi_no_2'];
}else
{
$contents .=  '<input type="text" name="bandi_no_2" />';
}
$contents .=  ' का जेल नियम ';
if($is_genrate == true){
$contents .= $post_data['jail_law_2'];
}else
{
$contents .=  '<input type="text" name="jail_law_2" />';
} 
$contents .=  ' के अंतर्गत समय पूर्व रिहाई के संबंध में दायर दया याचिका के संबंध में लेख है कि दिनांक ';
if($is_genrate == true){
$contents .= $post_data['date1'];
}else
{
	$contents .=  '<input type="text" class="date1" name="date1" value="'.date('d-m-Y').'" placeholder="dd/mm/yyyy" />';
}
 
	$contents .=  'को माननीय सर्वोच्च  न्यायालय द्वारा राज्य को आजीवन कारावास से दण्डनीय बंदियों की समय पूर्व रिहाई हेतु प्रस्तुत दया याचिकाओं पर  कार्यवाही  में  यथास्थिति लागू करने हेतु आदेशित किया गया है ।';

$contents .= '<tr><td><p>उपरोक्त  मामले माननीय सर्वोच्च न्यायालय द्वारा पारित आदेश W.P.नं. 48/14 की छायाप्रति संलग्न भेजकर अनुरोध है कि माननीय सर्वोच्चय न्यायालय द्वारा पारित आदेश में पूर्व पारित अंतरिम आदेश को W.P.( किमि.) 48/14 के अंतिम निराकरण तक जारी रहने के पारित आदेश के अनुसार कार्यवाही की अनुशंसा की जाती है ।</p></td></tr>';

/*code1*/
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right" colspan="3"><div class="officer-center">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td colspan="3">&nbsp;</td></tr>';
}

$contents .= '<tr><td colspan="3" align="right"><div  contenteditable="false" class="officer-center">( ';
if($is_genrate == true){
$contents .=  get_officer_information($this->input->post('avar_secetroy')); 

}else
{
     $contents .= get_officer_for_sign('avar_secetroy' ,$uber_sect ,'', $us_id);
    
}

$contents .= ' )</div></td></tr>';
$contents .= '<tr><td colspan="3" align="right"><div  contenteditable="false" class="officer-center">';

if($is_genrate == true){    
    $contents .=   get_officer_dign($this->input->post('avar_secetroy'));
}
else {
     $contents .= '-------';
    }
$contents .= '</div></td></tr>';
/*code End*/
$contents .= '<tr><td  colspan="3" align="right"><div contenteditable="false" class="officer-center">'.$dept_name.'</div></td></tr>';
$contents .= '<tr><td><div style="float:left">पृ0क्र0  07/';
if($is_genrate == true){
$contents .= $post_data['srno'];
}else
{
	$contents .=  '--------';
}
$contents .=  '/';
if($is_genrate == true){
$contents .= $post_data['year_letter'];
}else
{
	$contents .=  '--------';
}
$contents .= '/ पं. क्रं. '.@$file_number.'/21-क(अभि ),</div><div style="float:right">भोपाल, दिनांक   ';
if($is_genrate == true){
$contents .= $post_data['date1'].'</div></td></tr>';
}else
{
	$contents .=  '<input type="text" class="date1" name="date1" value="'.date('d-m-Y').'" placeholder="dd/mm/yyyy" />';
}
$contents .= '</div></td></tr>';
$contents .= '<tr><td>प्रतिलिपि -</td></tr>';
$contents .= '<tr><td><p>1-	जेल महानिरीक्षक, म.प्र. भोपाल की ओर सूचनार्थ प्रेषित ।</p></td></tr>';
$contents .= '<tr><td><p>2- केन्द्रीय जेल अधीक्षक, जिला जेल, ';
if($is_genrate == true){
	$contents .= $post_data['jail_state_3'];
}else
{
$contents .= get_distic_dd('jail_state_3');
}
$contents .=  ' की ओर सूचनार्थ एवं आवश्यक कार्यवाही हेतु प्रेषित । </p></td></tr>';
$contents .= '<tr><td><p>3- ';
if($is_genrate == true){
$contents .= $post_data['bandi_name'];
}else
{
	$contents .=  '<input type="text" name="bandi_name" />';
}

$contents .=', केन्द्रीय जेल, ';
if($is_genrate == true){
	$contents .= $post_data['jail_state_4'];
}else
{
$contents .=  get_distic_dd('jail_state_4');
}
$contents .=  ' की ओर सूचनार्थ प्रेषित ।</p></td></tr>';
/*code1*/
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right" colspan="3"><div class="officer-center">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td colspan="3">&nbsp;</td></tr>';
}

$contents .= '<tr><td colspan="3" align="right"><div  contenteditable="false" class="officer-center">( ';
if($is_genrate == true){
$contents .=  get_officer_information($this->input->post('avar_secetroy')); 

}else
{
     $contents .= get_officer_for_sign('avar_secetroy' ,$uber_sect ,'', $us_id);
    
}

$contents .= ' )</div></td></tr>';
$contents .= '<tr><td colspan="3" align="right"><div  contenteditable="false" class="officer-center">';

if($is_genrate == true){    
    $contents .=   get_officer_dign($this->input->post('avar_secetroy'));
}
else {
     $contents .= '-------';
    }
$contents .= '</div></td></tr>';
/*code End*/
$contents .= '<tr><td  colspan="3" align="right"><div contenteditable="false" class="officer-center">'.$dept_name.'</div></td></tr>';

//print content
//echo $contents;
?>   

