<?php
$contents  = '' ;
$contents .= '<tr><td align="right" colspan="3"><u>स्पीड-पोस्ट द्वारा</u></td></tr>';
$contents .= '<tr><td align="center" colspan="3"><h3><u>मध्यप्रदेश शासन, विधि एवं विधायी कार्य विभाग, भोपाल</u></h3></b></td></tr>';
$contents .= '<tr><td colspan="3"><table width="100%"><tr><td>क्रमांक '.$panji_krmank.'/21-क (स्था0), </td><td  align="right"> भोपाल, दिनांक '.date("d-m-Y").' </td></tr></table></td></tr>';
$contents .= '<tr><td align="left" valign="top" > प्रति,</td><td colspan="2"></td></tr>';
$contents .= '<tr><td></td><td colspan="2">';
if($is_genrate == true){
$contents .= get_employee_designation_id($this->input->post('emp_name'), '',  false);
}
else{
$contents .= get_all_employee_ddllist('emp_name' ,'');
}
$contents .= '</td></tr>';
$contents .= '<tr><td></td><td colspan="2">';
if($is_genrate == true){
$contents .=   get_employee_designation_id($this->input->post('emp_name')); 
}
else{
$contents .= '----' ;
} 
$contents .= '</td></tr>';
$contents .= '<tr><td></td><td colspan="2"> विधि विभाग, भोपाल । </td></tr>';

$contents .= '<tr><td>विषय:- </td><td colspan="2" > डिमांड ड्राफ्ट भेजे जाने विषयक ।</td></tr>';
$contents .= '<tr><td  valign="top" class="top_class"> संदर्भ:- </td><td colspan="2">आपका आवेदन  दिनांक';
if($is_genrate == true){
	$contents .= $post_data['date_1'];
}else
{
$contents  .= "<input type='text' name='date_1' class='date1'> ";	
}
$contents .= 'एवं' ;
if($is_genrate == true){
	$contents .= $post_data['date_2'];
}else
{
$contents  .= "<input type='text' name='date_2' class='date1'> ";	
}
$contents .= 'के संबंध में  । </td></tr>';
$contents .= '<tr><td align="center" colspan="3" valign="top">';
$contents .= '---0---';
$contents .= '</td></tr>';
$contents .= '<tr><td></td><td colspan="2"><p> उपरोक्त विषयक आपराधिक शाखा के अपील आदेश क्रमांक ';
if($is_genrate == true){
	$contents .= $post_data['order_no'];
}else
{
$contents  .= "<input type='text' name='order_no' > ";	
}
$contents .= ', रुपये';
if($is_genrate == true){
	$contents .= $post_data['amount'];
}else
{
$contents  .= "<input type='text' name='amount' > ";	
}

$contents .= '/- का बैंक ड्राफ्ट क्रमाक ';
if($is_genrate == true){
	$contents .= $post_data['draft_no'];
}else
{
$contents  .= "<input type='text' name='draft_no' > ";	
}
$contents .= ', दिनांक ';
if($is_genrate == true){
	$contents .= $post_data['draft_no'];
}else
{
$contents  .= "<input type='text' name='draft_no' > ";	
}
$contents .= 'सलंग्न भेजा जा रहा है। कृपया आवश्यक पावती भेजने का कष्ट करें । संलग्नः- बैंक ड्राफ्ट क्रमाक ';
if($is_genrate == true){
	$contents .= $post_data['draft_no'];
}else
{
$contents  .= "<input type='text' name='draft_no' > ";	
}


$contents .= '</p></td></tr>';

if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right" colspan="3"><div class="officer-center">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td colspan="3">&nbsp;</td></tr>';
}
$contents .= '<tr><td colspan="2" align="right"><div contenteditable="false" class="officer-center">( ';
if($is_genrate == true){
$contents .=  get_officer_information($this->input->post('avar_secetroy')); 

}else
{
     $contents .= get_officer_for_sign('avar_secetroy' ,$uber_sect ,'', $us_id);
    
}

$contents .= ' )</div></td></tr>';
$contents .= '<tr><td colspan="2" align="right"><div contenteditable="false" class="officer-center ">';

if($is_genrate == true){    
    $contents .=   get_officer_dign($this->input->post('avar_secetroy'));
}
else {
     $contents .= '-------';
    }
	
$contents .= '</div></td></tr>';
$contents .= '<tr><td colspan="2" align="right"><div  class="law_dept" >मध्यप्रदेश शासन विधि और विधायी कार्य विभाग, भोपाल</div></td></tr>';

?>
