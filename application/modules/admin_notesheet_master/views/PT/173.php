<?php
$contents  = '' ;
$contents .= '<tr><td align="center" colspan="3" ><b><u><h3>मध्यप्रदेश शासन, विधि एवं विधायी कार्य विभाग <h3></u></b></td></tr>';
$contents .= '<tr><td align="center" colspan="3" ><b><u><h4>//शुधि पत्र //  <h4></u></b></td></tr>';
$contents .= '<tr><td align="right" colspan="3"> भोपाल, दिनांक     ';
if($is_genrate == true){
$contents .= get_date_formate($post_data['date1'],'d/m/Y').'</div></td></tr>';
}else
{
	$contents .=  '<input type="text" class="date1" name="date1" value="'.$today.'" placeholder="dd/mm/yyyy" />';
}
$contents .=  '</td></tr>';
$contents .= '<tr><td align="right" colspan="3"><p> फा.क्रमांक    '.$file_number.'/'.date("Y").'/21-क(या0),  राज्य शासन, ';
if($is_genrate == true){
    $contents .= '<span>'.$post_data['advocate_type'].',</span>';
}else{
    $contents .= '<select name="advocate_type">';
    foreach($advocate_type as $row){
        $contents .= '<option value="'.$row.'">'.$row.'</option>';
    }
    $contents .= '</select>';

}
if($is_genrate == true){
    $contents .= '<span>'.$post_data['court_location'].'</span>';
}else{
    $contents .= '<select name="court_location">';
    foreach($court_location as $row){
        $contents .= '<option value="'.$row.'">'.$row.'</option>';
    }
    $contents .= '</select>';
}
$contents .= ' की रिट याचिका क्रमांक ';
if($is_genrate == true){
$contents .= $post_data['writ_no'];
}else
{
	$contents .=  '<input type="text" name="writ_no"  />';
}
$contents .=  'प्र.क्र. '.$case_no.'  विरूद्ध  ' .$case_parties.'में म0प्र0 शासन द्वारा शासन मे पारित आदेश दिनांक ';
if($is_genrate == true){
$contents .= get_date_formate($post_data['date2'],'d/m/Y') ;
}else
{
	$contents .=  '<input type="text" class="date1" name="date2" value="'.$today.'" placeholder="dd/mm/yyyy" />';
}
$contents .= ' के वि0 रिट अपील में इस विभाग द्वारा जारी आदेश क्रमांक ';
if($is_genrate == true){
$contents .= $post_data['order_no'];
}else
{
	$contents .=  '<input type="text" name="order_no"  />';
}
$contents .=  '  क. या. दिनांक ';
if($is_genrate == true){
$contents .= get_date_formate($post_data['date3'],'d/m/Y') ;
}else
{
	$contents .=  '<input type="text" class="date1" name="date3" value="'.$today.'" placeholder="dd/mm/yyyy" />';
}
 $contents .=  ' में आदेश दिनांक ';
if($is_genrate == true){
$contents .= get_date_formate($post_data['date4'],'d/m/Y') ;
}else
{
	$contents .=  '<input type="text" class="date1" name="date4" value="'.$today.'" placeholder="dd/mm/yyyy" />';
}
$contents .=  ' के स्थान पर ';
 if($is_genrate == true){
$contents .= get_date_formate($post_data['date5'],'d/m/Y') ;
}else
{
	$contents .=  '<input type="text" class="date1" name="date5" value="'.$today.'" placeholder="dd/mm/yyyy" />';
}
$contents .=  ' अंकित हो गया है जिसे अब आदेश दिनांक ';
 if($is_genrate == true){
$contents .= get_date_formate($post_data['date6'],'d/m/Y') ;
}else
{
	$contents .=  '<input type="text" class="date1" name="date6" value="'.$today.'" placeholder="dd/mm/yyyy" />';
}
 $contents .=  ' पढा जाये </p></td></tr>';

$contents .= '<tr><td align="right" colspan="3">मध्यप्रदेश के राज्यपाल के नाम से तथा आदेशानुसार,</td></tr>';
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right" colspan="3"><div  style="width:50%; text-align:center;">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td>&nbsp;</td></tr>';
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
$contents .= '<tr><td align="right"  colspan="3"  align="right"><div class="law_dept" style="">मध्यप्रदेश शासन विधि और विधायी कार्य विभाग, भोपाल</div></td></tr>';	
$contents .= '<tr><td align="right" colspan="3"><table width="100%"><tr><td align="left">पृ. क्रमांक      '.$file_number.'/'.date("Y").' /21-क(या.) </td><td align="right"> भोपाल, दिनांक     ';
if($is_genrate == true){
$contents .= get_date_formate($post_data['date1'],'d/m/Y').'</div></td></tr>';
}else
{
	$contents .=  '<input type="text" class="date1" name="date1" value="'.$today.'" placeholder="dd/mm/yyyy" />';
}
$contents .= '</td></tr></table></td></tr>';
$contents .= '<tr><td>प्रतिलिपि:- </td><td  colspan="2"></td></tr>';
$contents .= '<tr><td align="right">1. </td><td  colspan="2"> ';
if($is_genrate == true){   
	$contents .= $post_data['advocate_type'];

}else{
$contents .= '<select name="advocate_type" class="advocate_type">';
	foreach($advocate_type as $row){
		$contents .= '<option value="'.$row.'">'.$row.'</option>';
	}
	$contents .= '</select>';
}
if($is_genrate == true){   
$contents .= $post_data['court_type'];
}else{
$contents .= '<select name="court_type" class="court_type">';
	foreach($court_type as $row){
		if(($emp_allot_seet == 1 && $row == 'मान0  उच्च न्यायालय' ) || ($emp_allot_seet == 2 && $row == 'मान0 उच्च न्यायालय खण्डपीठ' ) || ($emp_allot_seet == 3 && $row == 'मान0 उच्च न्यायालय खण्डपीठ' )  )
		{
			$contents .= '<option value="'.$row.'" selected>'.$row.'</option>';
		}else{
			$contents .= '<option value="'.$row.'">'.$row.'</option>';
		}
	}
	$contents .= '</select>';
}
$contents .= ', ';
if($is_genrate == true){   
$contents .= $post_data['court_location'];
}else{
$contents .= '<select name="court_location" class="court_location">';
	foreach($court_location as $row){
		if(($emp_allot_seet == 1 && $row == 'जबलपुर, मध्यप्रदेश' ) || ($emp_allot_seet == 2 && $row == 'ग्वालियर, मध्यप्रदेश' ) || ($emp_allot_seet == 3 && $row == 'इंदौर, मध्यप्रदेश' )  ){
			$contents .= '<option value="'.$row.'" selected>'.$row.'</option>';
		}
		else{
			$contents .= '<option value="'.$row.'">'.$row.'</option>';
		}
	}
	$contents .= '</select>';
}
$contents .= ' की ओर इस विभाग के आदेश्‍ क्रमांक ';
if($is_genrate == true){
$contents .= $post_data['order_no_2'] ;
}else
{
	$contents .=  '<input type="text" name="order_no_2" />';
}
$contents .= ' दिनांक ';
 if($is_genrate == true){
$contents .= get_date_formate($post_data['date6'],'d/m/Y') ;
}else
{
	$contents .=  '<input type="text" class="date1" name="date7" value="'.$today.'" placeholder="dd/mm/yyyy" />';
}
$contents .= '  के संदर्भ में आवश्यक कार्यवाही हैतु अग्रेषित । </td></tr>';
$contents .= '<tr><td align="right" vertical-align="top">2. </td><td  colspan="2">';
if($is_genrate == true){
	$contents .= $post_data['send_at'].', ';
}else{
	$contents .=  '<select name="send_at">';	
	$contents .=  '<option value="सचिव">सचिव</option>';
	$contents .=  '<option value="प्रमुख सचिव">प्रमुख सचिव</option>';
	$contents .=  '<option value="संचालक">संचालक</option>';
	$contents .=  '<option value=""></option>';
	$contents .=  '</select>';
}
if($is_genrate == true && ($post_data['send_at'] == 'सचिव' || $post_data['send_at'] == 'प्रमुख सचिव')){
	$contents .=  'म0प्र0 शासन,‍ ';
}else{
	$contents .=  '';
}
$contents .=  ' '.$file_department.', ';
if($is_genrate == true && ($post_data['send_at'] == 'सचिव' || $post_data['send_at'] == 'प्रमुख सचिव')){
	$contents .=  'मंत्रालय ';
}else{
	$contents .=  '';
}
$contents .= ' भोपाल की ओर उनके यू.ओ.क्र. '.$file_uo_or_letter_no .', दिनांक '.$file_uo_or_letter_date.' के संदर्भ में नस्ती सहित भेजकर लेख है कि प्रकरण के प्रभारी को निर्देश दे कि वह तत्काल ';

$contents .= ' न्यायालय के समक्ष प्रत्यावर्तन प्रस्तुत कर उसकी एक प्रति इस विभाग को संदर्भ सहित भेजें। </td></tr>';
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right" colspan="3"><div  style="width:50%; text-align:center;">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td>&nbsp;</td></tr>';
}
$contents .= '<tr><td colspan="3" align="right"><div  contenteditable="false" class="officer-center">( ';
if($is_genrate == true){
$contents .=  get_officer_information($this->input->post('avar_secetroy')); 

}else
{
     $contents .= '-------';
    
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
$contents .= '<tr><td align="right"  colspan="3"  align="right"><div class="law_dept" style="">मध्यप्रदेश शासन विधि और विधायी कार्य विभाग, भोपाल</div></td></tr>';	
?>
