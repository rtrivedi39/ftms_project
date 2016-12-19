<?php
$contents  = '' ;
$contents .= '<tr><td align="right" colspan="3"><u><b>स्पीड पोस्ट द्वारा </b></u></td></tr>';
$contents .= '<tr><td align="center"  colspan="3"><h4><b><u>मध्यप्रदेश शासन, विधि एवं विधायी कार्य विभाग, भोपाल</u></b></h4><br/>  <br/> </td></tr>';
$contents .= '<tr><td colspan="3"><table width="100%"><tr><td align="left"> क्रमांक 12/';
if($is_genrate == true){
	 $contents .= $post_data['head_val_1'];
}
else{
	 $contents .= '<input name="head_val_1" placeholder="file no" value="'.$panji_krmank.'" type="text" />' ;
}

$contents .= '/'.date("y").'/'.$panji_krmank.'/21-क (आप), </td><td align="right">';
$contents .= 'भोपाल, दिनांक '.date("d-m-Y").'</td><td></table></td></tr>';
$contents .= '<tr><td align="left" valign="top" class="top_class">प्रति,</td><td colspan="2"></td></tr>';
$contents .= '<tr><td></td><td colspan="2">';
if($is_genrate == true){
    $contents .= $post_data['advocate_type'].',';
}else{
    $contents .= '<select name="advocate_type">';
    foreach($advocate_type as $row){
        $contents .= '<option value="'.$row.'">'.$row.'</option>';		
    }
	$contents .= '<option value="शासकीय अधिवक्ता">शासकीय अधिवक्ता</option>';
    $contents .= '</select>';
   
}
$contents .= '</td></tr><tr><td></td><td colspan="2">महाधिवक्ता कार्यालय, </td></tr>';
$contents .= '<tr><td></td><td colspan="2">मध्यप्रदेश उच्च न्यायालय, </td></tr><tr><td></td><td colspan="2">' ;
if($is_genrate == true){
    $contents .= '<span>'.$post_data['court_location'].'</span>';
}else{
    $contents .= '<select name="court_location">';
    foreach($court_location as $row){
        $contents .= '<option value="'.$row.'">'.$row.'</option>';
    }
    $contents .= '</select>';
}


$contents .= '</td></tr>';
$contents .= '</td><td colspan="3">&nbsp;</td></tr>';
$contents .= '<tr><td align="left" valign="top">';
$contents .= 'विषय:- </td><td colspan="2" ><p class="text-justify ">उच्च न्यायालय, म.प्र. ';
if($is_genrate == true){
    $contents .= '<span>'.$post_data['court_location2'].'</span>';
}else{
    $contents .= '<select name="court_location2">';
    foreach($court_location2 as $row){
        $contents .= '<option value="'.$row.'">'.$row.'</option>';
    }
    $contents .= '</select>';
}
$contents .= ' के CR क्रमांक '.$case_no .'&nbsp';
if($is_genrate == true){
$contents .= $post_data['against_party'];
}else
{
	 $contents .= '<input type="text" name="against_party" >';
	
}
$contents .= ' में हुये निर्णय/आदेश, दिनांक ';
if($is_genrate == true){
$contents .= $post_data['judge_date11'];
}else
{
	$contents .=  '<input type="text" class="date1" name="judge_date11" value="'.$file_judgment_date1.'" placeholder="dd/mm/yyyy" />';
} 
 
$contents .=  '  के संबंध में ।';
$contents .= '</p></td></tr><tr><td align="center"  valign="top" colspan="3">';
$contents .= '----0----</td></tr><tr>';
$contents .= '<td></td><td align="left"  valign="top" colspan="2">';
$contents .= '<p class="text-justify shift-left">संदर्भ हेतु कृपया अपने&nbsp;<span id="Label9">पत्र क्रमांक '.$file_uo_or_letter_no.'     दिनांक  '.$file_uo_or_letter_date1.'   का अवलोकन करने का कष्ट करें । राज्य शासन ने विषयांकित में अब कोई अग्रिम कार्यवाही नहीं करने का निश्चय करते हुये नस्तीबद्ध किया है ।</p>';
$contents .= '</td></tr><tr><td></td><td align="right"  colspan="2">';
$contents .= '<b>मध्यप्रदेश के राज्यपाल के नाम से तथा आदेशानुसार,</b></td></tr>';

if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right" colspan="3"><div class="officer-center">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td colspan="3">&nbsp;</td></tr>';
}
$contents .= '<tr><td colspan="3" align="right"><div contenteditable="false"  class="officer-center">( ';
if($is_genrate == true){
$contents .=  get_officer_information($this->input->post('avar_secetroy')); 

}else
{
     $contents .= get_officer_for_sign('avar_secetroy' ,$uber_sect ,'', $us_id);
    
}

$contents .= ' )</div></td></tr>';
$contents .= '<tr><td colspan="3" align="right"><div contenteditable="false"  class="officer-center ">';

if($is_genrate == true){    
    $contents .=   get_officer_dign($this->input->post('avar_secetroy'));
}
else {
     $contents .= '-------';
    }
	
$contents .= '</div></td></tr>';
$contents .= '<tr><td colspan="3" align="right"><div style="" class="law_dept" >मध्यप्रदेश शासन विधि और विधायी कार्य विभाग, भोपाल</div></td></tr>';
$contents .= '<tr><td colspan="3">&nbsp;</td></tr>';

$contents .= '<tr><td colspan="3"><table width="100%"><tr><td align="left">पृ0 क्रमांक 12/';
if($is_genrate == true){
	 $contents .= $post_data['head_val_1'];
}
else{
	 $contents .= '--------' ;
}

$contents .= '/'.date("y").'/'.$panji_krmank.'/21-क (आप), </td><td align="right">';
$contents .= 'भोपाल, दिनांक '.date("d-m-Y").'</td></table></td></tr>';
$contents .= '<tr><td>प्रतिलिपि:- </td> <td colspan="2"></td></tr>';
$contents .= '<tr><td></td><td colspan="2">जिला दंडाधिकारी  '; 
if($is_genrate == true){
	$contents .= $post_data['distic_1'];
}else
{
$contents  .= get_distic_dd('distic_1');	
}
$contents .= ' की ओर सूचनार्थ अग्रेषित |</div></td></tr>';
$contents .= '</td></tr><tr><td align="right" colspan="3" ></td></tr>';
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
      // $contents .= get_officer_for_sign('avar_secetroy' ,$uber_sect ,'', $us_id);
	$contents .= "-------";
}

$contents .= ' )</div></td></tr>';
$contents .= '<tr><td colspan="3" align="right"><div  contenteditable="false" class="officer-center ">';


if($is_genrate == true){    
    $contents .=   get_officer_dign($this->input->post('avar_secetroy'));
}
else {
     $contents .= '-------';
    }
	
$contents .= '</div></td></tr>';
$contents .= '<tr><td colspan="3" align="right"><div style="" class="law_dept" >मध्यप्रदेश शासन विधि और विधायी कार्य विभाग, भोपाल</div></td></tr>';
?>