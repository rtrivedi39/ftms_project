<?php 
$contents  = '' ;
$contents .= '<tr><td align="center"><u><h3>'.$dept_name.'</h3></u></td></tr>';
$contents .= '<tr><td><div style="float:left">पंजी .क्रं.  ';
if($is_genrate == true){
$contents .= $post_data['file_no'];
}else
{
	$contents .=  '<input type="text" name="file_no" id="file_no1" />';
}
//$contents .= '/';
if($is_genrate == true){
//$contents .= $post_data['year'];
}else
{
//	$contents .=  '<input type="text" name="year" />';
}
$contents .= '/21-क(अभि0), </div><div style="float:right">भोपाल, दिनांक   ';
if($is_genrate == true){
$contents .= $post_data['date1'];
}else
{
	$contents .=  '<input type="text" class="date1" name="date1" value="'.date('d-m-Y').'" placeholder="dd/mm/yyyy" />';
}
$contents .= '</div></td></tr>';
$contents .= '<tr><td align="left">प्रति,</td></tr>';
if($is_genrate == true){
$contents .= '<tr><td><span style="margin-left:10%">'.$post_data['danme'].',</span></td></tr>';
}else{
$contents .= '<tr><td><span style="margin-left:10%">'.get_employee_dd('danme').',</span></td></tr>';	
}
$contents .= '<tr><td><span style="margin-left:10%">';


if($is_genrate == true){
$contents .= $post_data['section'];
}else{
$contents .= get_section_dd('section');	
}


$contents .= '</span></td></tr>';
$contents .= '<tr><td><span style="margin-left:10%">विधि विभाग,</span></td></tr>';
$contents .= '<tr><td><span style="margin-left:10%">भोपाल।</span></td></tr>';
$contents .= '<tr><td><div style="float:left; width:10%;">विषय:- </div><div style="float:float; width:85% "> अभियोजन स्वीकृति ';
if($is_genrate == true){
	$contents .= $post_data['ps_subject'];
}else
{
$contents .= '<input type="text" name="ps_subject">';
}

$contents .= '।</td></tr>';
$contents .= '<tr><td align="center">------0-------</td></tr>';
$contents .= '<tr><td><p>उपरोक्त विषयांकित प्रकरण में पारित अभियोजन स्वीकृति आदेश क्रमांक ';
if($is_genrate == true){
	$contents .= $post_data['order_no'];
}else
{
	$contents .= '<input type="text" name="order_no">';
}
$contents .= ' में  <span id="employee_1" ></span>, <span id="employee_section" ></span>, ';

$contents .= 'विधि विभाग को प्रथम अपर सत्र न्यायाधीश एवं विशेष न्यायाधीश, ';

if($is_genrate == true){
$contents .= $post_data['jail_state_5'];
}else
{
$contents .=   get_distic_dd('jail_state_5');
}
$contents .= ' के न्यायालय में दिनांक ';

if($is_genrate == true){
	$contents .= $post_data['date1'];
}else
{
	$contents .= '<input type="text" class="date1" name="date1" placeholder="dd/mm/yyyy" value=""/>';
}
 
 
 $contents .= ' को साक्ष्य हेतु उपस्थित होने के लिये निर्देशित किया जाता है। विभाग में प्राप्त समंस की प्रति संलग्न है। संबंधित नस्ती आपको अभियोजन शाखा  द्वारा उपलब्ध करायी जा सकेगी। कृपया  दिनांक ';
if($is_genrate == true){
	$contents .= $post_data['date2'];
}else
{
	$contents .= '<input type="text" class="date1" name="date2" placeholder="dd/mm/yyyy" value=""/>';
}
 $contents .= ' को प्रकरण के संबंध में साक्ष्य हेतु न्यायालय के समक्ष उपस्थित होने तथा उस तिथि को हुई कार्यवाही के संक्षिप्त विवरण के साथ मूल समंस की प्रति एवं नस्ती अभियोजन शाखा को लौटायी जाए।</p></td></tr>';

$contents .= '<tr><td>&nbsp;</td></tr>';
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
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">'.$dept_name.'</div></td></tr>';
$contents .= '<tr><td><div style="float:left">पंजी.क्रं.  ';
if($is_genrate == true){
$contents .= $post_data['file_no'];
}else
{
	$contents .=  '---------';
}
//$contents .= '/';
if($is_genrate == true){
//$contents .= $post_data['year'];
}else
{
//	$contents .=  '---------';
}
$contents .= '/21-क(अभि0), </div><div style="float:right">भोपाल, दिनांक   ';
if($is_genrate == true){
$contents .= $post_data['date1'];
}else
{
	$contents .=  '<input type="text" class="date1" name="date1" value="'.date('d-m-Y').'" placeholder="dd/mm/yyyy" />';
}
$contents .= '</div></td></tr>';

$contents .= '<tr><td>प्रतिलिपि:-</td></tr>';
$contents .= '<tr><td align="left"><div width="100%"><div style="float:left; width:14%;">1-</div> <div style="float:left; display:block; width:85%; "><p style="margin:0; text-indent:0;">विशेष पुलिस स्थापना,लोकायुक्त कार्यालय ';
if($is_genrate == true){
$contents .= $post_data['jail_state_1'];
}else
{
$contents .=   get_distic_dd('jail_state_1');
}

$contents .= ' की ओर सूचनार्थ अग्रेषित।</p></div></div></td></tr>';
$contents .= '<tr><td><div style="width:100%;"><div style="float:left; width:14%;">
2-</div><div style="float:left; display:block; width:85%;"><p style="margin:0; text-indent:0;">प्रथम अपर सत्र न्यायाधीश एवं विशेष न्यायाधीश, ';
if($is_genrate == true){
$contents .= $post_data['jail_state_5'];
}else
{
$contents .=   '---';
}
$contents .= '।</p></div><div style="float:left; width:14%;">
3-</div><div style="float:left; display:block; width:85%;"><p style="margin:0; text-indent:0;">स्थापना शाखा,विधि और विधायी कार्य विभाग की ओर आवश्यक कार्यवाही हेतु अग्रेषित ।</p></div></div></td></tr>';



$contents .= '<tr><td>&nbsp;</td></tr>';
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
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">'.@$dept_name.'</div></td></tr>';

//print content
//echo $contents;
?>   

