<?php 
$contents  = '' ;
$contents .= '<tr><td align="center" colspan="2"><u><h3>'.$dept_name.'</h3></u></td></tr>';
$contents .= '<tr><td align="left"  colspan="2">&nbsp;</td></tr>';
$contents .= '<tr><td  colspan="2" ><div style="float:left"> क्रमांक ';
if($is_genrate == true){ 
    $contents .=  $post_data['panjee_no'];
} else {
    $contents .= ' <input type="text"  name="panjee_no"  value=""/>';
}
$contents .= '/'.date("Y").'/21-मत </div><div style="float:right"> भोपाल, दिनांक ';
if($is_genrate == true){ 
    $contents .=  get_date_formate($post_data['date1'],'d/m/Y');
} else {
    $contents .= ' <input type="text" class="date1" name="date1" placeholder="dd/mm/yyyy" value="'.$today.'"/>';
}
 $contents .= '</div></td></tr>';
$contents .= '<tr><td align="left" colspan="2">&nbsp;</td></tr>';
$contents .= '<tr><td align="left" width="8%">प्रति, </td><td></td></tr>';
$contents .= '<tr><td></td><td>';
if($is_genrate == true){ 
    $contents .=  $post_data['send_officer'];
} else {
    $contents .= ' <input type="text"  name="send_officer"  value=""/>';
}
$contents .= '</td></tr>';
$contents .= '<tr><td></td><td> जिला ';
if($is_genrate == true){
	$contents .= $post_data['distic_1'];
}else
{
$contents  .= get_distic_dd('distic_1');	
}
$contents .= '</td></tr>';
$contents .= '<tr><td></td><td> (म0प्र0) </td></tr>';

$contents .= '<tr><td align="left"> विषय :- </td><td> ';
if($is_genrate == true){ 
    $contents .=  $post_data['subject'];
} else {
    $contents .= ' <textarea name="subject" cols="100" />'.$file_subject.'</textarea>';
}
 $contents .= '</td></tr>';
$contents .= '<tr><td align="center" colspan="2">-----------</td></tr>';
$contents .= '<tr><td align="left" colspan="2">';

if($is_genrate == true){ 
    $contents .=  $post_data['sandrbh'];
} else {
    $contents .= ' <textarea name="sandrbh" cols="100" />संदर्भ:-  आवेदन पत्र दिनांक </textarea>';
}

$contents .= '</td></tr>';
$contents .= '<tr><td align="left" colspan="2">&nbsp;</td></tr>';

$contents .= '<tr><td></td><td><p>उपरोक्त विषयक संदर्भित आवेदन पत्र मूलत: आपकी ओर आवश्यक कार्यवाही हेतु संलग्न प्रेषित है। ';

 if($is_genrate == true){ 
    $contents .=  $post_data['change_content'];
} else {
 $contents .= '<textarea name="change_content"  rows="8" cols="130" id="letter_content"></textarea>';
}
$contents .= '</p></td></tr>';
$contents .= '<tr><td align="left" colspan="2">';
if($is_genrate == true){ 
    $contents .=  $post_data['attach_doc'];
} else {
    $contents .= ' <textarea name="attach_doc" cols="25" />संलग्नः-उपरोक्तानुसार
	  पृष्ठ 1 से 77  </textarea>';
}
$contents .= ' </td></tr>';

 $contents .= '<tr><td align="right" height="20" colspan="2"></td></tr>';
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right" colspan="2"><div class="officer-center">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td colspan="2">&nbsp;</td></tr>';
}
$contents .= '<tr><td colspan="2" align="right"><div  contenteditable="false" class="officer-center">( ';
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
$contents .= '<tr><td colspan="2" align="right"><div style="" class="law_dept" >मध्यप्रदेश शासन विधि और विधायी कार्य विभाग, भोपाल</div></td></tr>';
$contents .= '<tr><td align="left" colspan="2" >&nbsp;</td></tr>';
$contents .= '<tr><td colspan="2"><div style="float:left"> पृ.क्रमांक ' ; 
if($is_genrate == true){ 
    $contents .=  $post_data['panjee_no'];
} else {
    $contents .= '--------';
}
$contents .= '/'.date("Y").'/21-मत </div><div style="float:right"> भोपाल, दिनांक ';
if($is_genrate == true){ 
    $contents .=  get_date_formate($post_data['date1'],'d/m/Y');
} else {
    $contents .= '----------';
}
 $contents .= '</div></td></tr>';
 
 $contents .= '<tr><td align="left" colspan="2" >प्रतिलिपि </td></tr>';
 if($is_genrate == true){ 
    $contents .=  '<tr><td></td><td><p>'.$post_data['notesheet_content'].'</p></td></tr>';
} else {
 $contents .= '<tr><td></td><td><p><textarea name="notesheet_content"  rows="8" cols="130" id="letter_content"></textarea></p></td></tr>';
}
  
 $contents .= '<tr><td align="right" height="20" colspan="2" ></td></tr>';
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right" colspan="2"><div class="officer-center">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td colspan="2">&nbsp;</td></tr>';
}
$contents .= '<tr><td colspan="2" align="right"><div  contenteditable="false" class="officer-center">( ';
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
$contents .= '<tr><td colspan="2" align="right"><div style="" class="law_dept" >मध्यप्रदेश शासन विधि और विधायी कार्य विभाग, भोपाल</div></td></tr>';
?>   

