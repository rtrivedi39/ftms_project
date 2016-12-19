<?php
$contents  = '' ;
$contents .= '<tr><td align="center" colspan="2"><h4><u><b>मध्यप्रदेश शासन, विधि एवं विधायी कार्य विभाग, भोपाल</b></u></h4></td></tr>';
$contents .= '<tr><td class="style5" colspan="2"><table width="100%"><tr><td align="left">क्रमांक 12/'.date("y").'/'.$panji_krmank.'/21-क (आप), </td><td align="right">भोपाल, दिनांक       '.date("m-Y").'';
$contents .= '</td></tr></table></td></tr>';
$contents .= '<tr><td class="style7 top_class" > प्रति, </td><td><td></td></tr>';
$contents .= '<tr><td></td><td>';
if($is_genrate == true){
    $contents .= '<span>'.$post_data['advocate_type'].',</span>';
}else{
    $contents .= '<select name="advocate_type">';
    foreach($advocate_type as $row){
        $contents .= '<option value="'.$row.'">'.$row.'</option>';
    }
    $contents .= '</select>';

}
$contents .= '</td></tr>';
$contents .= '<tr><td></td><td>';
if($is_genrate == true){
    $contents .= '<span>'.$post_data['advocate_type'].',</span>';
}else{
    $contents .= '---------';
   

}
$contents .= ' कार्यालय,';
$contents .= '</td></tr>';
$contents .= '<tr><td></td><td>मध्यप्रदेश उच्च न्यायालय,</td></tr>';
$contents .= '<tr><td></td><td>';
if($is_genrate == true){
    $contents .= '<span>'.$post_data['court_location'].'</span>';
}else{
    $contents .= '<select name="court_location">';
    foreach($court_location as $row){
        $contents .= '<option value="'.$row.'">'.$row.'</option>';
    }
    $contents .= '</select>';
}

$contents .= ' </td></tr>';
$contents .= '<tr><td class="style7 top_class"  width="55px ">';
$contents .= 'विषय:-</td><td colspan="2"> ';

$contents .= 'माननीय न्यायालय,  ';
if($is_genrate == true){
    $contents .= $post_data['dt4'];
}else{
	 $contents .= get_Court('dt4');
}
$case_no1 = explode('/',$case_no);
$contents .= ' न्यायाधीश, जिला ';
if($is_genrate == true){
$contents .= $post_data['DropDownList22'];
}else
{
       $contents  .= get_distic_dd('DropDownList22');
}
if(!empty($district_name_hi)){
	$contents  .= $district_name_hi;
}

$contents .= '(म.प्र.) के '. $case_no1[0].' ';
$contents .= '  प्रकरण क्रमांक '.$case_no1[1].' '.$case_no1[2].' '.$case_parties1[2].' '.$case_parties1[1].' '.$case_parties1[0].' ';
$contents .= ' धारा ';
if($is_genrate == true){
    $contents .= $post_data['dhara'];
}else{
	 $contents .= '<input type="text" name="dhara" />';
}
$contents .= '  के मामले में पारित आदेश दिनांक ';
if($is_genrate == true){
    $contents .= $post_data['apeel_date'];
}else{
    $contents .= '<input type="text" name="apeel_date" value="'.$file_judgment_date1.'" class="date1"/>';
}
$contents .= ' के विरूद्ध ' ;

if($is_genrate == true){
    $contents .= '<span>'.$post_data['against'].'</span>';
}else{
    $contents .= '<select name="against"><option>पुनरीक्षण</option><option>रिवीजन</option><option>रिट याचिका   </option><option>निगरानी  याचिका   </option></select>';
}
$contents .= ' अपील प्रस्तुत किये जाने बावत् |</td></tr>';
$contents .= '<tr><td align="left"  class="top_class">';
$contents .= 'संदर्भ:-</td><td valign="top">कार्यालय  शासकीय अभिभाषक '.$district_name_hi.' , जिला '.$district_name_hi.'  (म.प्र.)  के पत्र/फाइल क्रमांक /' .$file_uo_or_letter_no.'/ कार्या०/शास०/अभि०, दिनांक ';
if($is_genrate == true){
$contents .= $post_data['date11'];
}else
{
	$contents .=  '<input type="text" class="date1" name="date11" value="'.date('d-m-Y').'" placeholder="dd/mm/yyyy" />';
} 
$contents .= '<br /></td></tr><tr><td align="center" class="style1 top_class" colspan="2" valign="top">';
$contents .= '---000---';
$contents .= '</td></tr><tr>';
$contents .= '<tr><td></td><td class="style1" colspan="2"><p class="shift-left" >राज्य शासन द्वारा उपरोक्त विषयांतर्गत एवं संदर्भित प्रकरण में पारित आदेश दिनांक ';
if($is_genrate == true){
	$contents .= $post_data['text1'];
}else{ 
$contents .= '<input name="text1" type="text" class="date1" />';
}
$contents .= ' के विरुद्ध ';
if($is_genrate == true){
    $contents .= '<span>'.$post_data['against'].'</span>';
}else{
    $contents .= '<select name="against"><option>पुनरीक्षण</option><option>रिवीजन</option><option>रिट याचिका   </option><option>निगरानी  याचिका   </option></select>';
}
$contents .= ' याचिका प्रस्तुत करने का निर्णय लिया गया है |</td></tr>';
$contents .= '<tr><td></td><td align="left" class="style1" valign="top" colspan="2"><p class="shift-left" >';
$contents .= 'अतः आज राज्य शासन द्वारा लिये गये निर्णय के अनुसार दण्ड प्रक्रिया संहिता की धारा 397,401,482 के अंतर्गत म0 प्र0 उच्च न्यायालय के समक्ष  ';
if($is_genrate == true){
    $contents .= '<span>'.$post_data['against'].'</span>';
}else{
    $contents .= '<select name="against"><option>पुनरीक्षण</option><option>रिवीजन</option><option>रिट याचिका   </option><option>निगरानी  याचिका   </option></select>';
}
 $contents .= '  प्रस्तुत करने की समुचित कार्यवाही करें | तथा कार्यवाही की सूचना शीघ्र विधि विभाग को प्रेषित करें |</p></td></tr>';
$contents .= '<tr><td colspan="2">संलग्न दस्तावेज :- </td></tr>';
$contents .= '<tr><td colspan="3">';
$contents .= '<span>1-निर्णय की सत्य प्रतिलिपि,<br />2-लोक अभियोजक का मत,<br />3-साक्षियों के कथन,<br /></span></td></tr>';
$contents .= '<tr><td align="right" height="60"></td></tr>';
$contents .= '<tr><td colspan="2">&nbsp;</td></tr>';
$contents .= '<tr><td colspan="2" align="right"><div class="law_dept">मध्यप्रदेश के राज्यपाल के नाम से आदेशानुसार , </div></td></tr>';
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right" colspan="3"><div class="officer-center">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td colspan="3">&nbsp;</td></tr>';
}
$contents .= '<tr><td colspan="2" align="right"><div  contenteditable="false" class="officer-center">( ';
if($is_genrate == true){
$contents .=  get_officer_information($this->input->post('avar_secetroy')); 

}else
{
     $contents .= get_officer_for_sign('avar_secetroy' ,$uber_sect ,'', $us_id);
    
}

$contents .= ' )</div></td></tr>';
$contents .= '<tr><td colspan="2" align="right"><div  contenteditable="false" class="officer-center">';

if($is_genrate == true){    
    $contents .=   get_officer_dign($this->input->post('avar_secetroy'));
}
else {
     $contents .= '-------';
    }
$contents .= '</div></td></tr>';
$contents .= '<tr><td colspan="2" align="right"><div  class="law_dept" style="">मध्यप्रदेश शासन विधि और विधायी कार्य विभाग, भोपाल</div></td></tr>';



?>
