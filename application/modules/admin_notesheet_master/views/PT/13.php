<style>
td{
	padding:3px !important;
}
p{
	line-height:20px;
}
</style>
<?php 
$contents  = '' ;
$contents .= '<tr><td align="right"><b><u>स्पीड पोस्ट द्वारा</b></u></td></tr>';
$contents .= '<tr><td align="center"> फा0क्र0 5/ '.$panji_krmank.'/'.date("Y").'/'.$file_number.'/21-क(या0),  </td></tr> ';
$contents .= '<tr><td align="center"><u><h3 style="margin:0px;">'.$dept_name.'</h3></u></td></tr>';
$contents .= '<tr><td align="left">प्रेषकः-</td></tr>';
$contents .= '<tr><td align="left"><span style="margin-left:8%">';
if($is_genrate == true){
	$contents .=  get_officer_information($this->input->post('add_secetroy')); 
}else{
	 $contents .= get_officer_for_sign('add_secetroy' ,$add_secetroy ,'', $as_id);
}
$contents .=  '</span></td></tr>';
$contents .=  '<tr><td><span style="margin-left:8%">अतिरिक्त सचिव, विधि</span></td></tr>';
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
$contents .= '<tr><td align="right"> भोपाल, दिनांक ';
if($is_genrate == true){ 
    $contents .=  '&nbsp;&nbsp;'.get_date_formate($post_data['date1'],'/m/Y').'</td></tr>';
} else {
    $contents .= ' <input type="text" class="date1" name="date1" placeholder="dd/mm/yyyy" value="'.$today.'"/></td></tr>';
} 
$contents .= '<tr><td align="left">विषय:- <span style="margin-left:4%"> ';
if($is_genrate == true){
	$contents .= ' '.$post_data['court_type'];
	$contents .= ' '.$post_data['court_location'];
} else {
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
	$contents .= ' <select name="court_location" class="court_location">';
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
if($is_genrate == true){ 
    $contents .=  ' '.$post_data['agenst_name'];
} else {
    $contents .= ' <input type="text" class="" name="agenst_name" value="'.$agenst_name.'" />';
}
$contents .= ' विरुद्ध ';
if($is_genrate == true){ 
    $contents .=  $post_data['agenst'];
} else {
    $contents .= ' <input type="text" class="" name="agenst" value="'.$agenst.'" />';
}
$contents .= ' में पारित आदेश दिनांक ';
if($is_genrate == true){ 
    $contents .=  $post_data['date2'];
} else {
    $contents .= '<input type="text" class="date1" name="date2" placeholder="dd/mm/yyyy" value="'.$file_judgment_date1.'" />';
}      
$contents .= ' के विरूद्ध ';
if($is_genrate == true){
	$contents .= ' <b>'.$post_data['writ_lists_for'].'</b></span>';
	
} else {
		$contents .= ' <select name="writ_lists_for" class="">';
	foreach($writ_lists as $row){
		$contents .= '<option value="'.$row.'">'.$row.'</option>';
	}
	$contents .= '</select>';
}
$contents .= ' प्रस्तुत किये जाने के संबंध में |</span></td></tr>';
$contents .= '<tr><td align="center">--------------</td></tr>';
$contents .= '<tr><td align="left">महोदय,</td></tr>';
$contents .= '<tr><td align="left"><p><span style="margin-left:8%"></span>उपरोक्त विषयांकित प्रकरण में  ';
if($is_genrate == true){
	$contents .= ' '.$post_data['court_type'];
	$contents .= ' '.$post_data['court_location'];
} else {
	$contents .= '----------, ';
	$contents .= '----------';
}
 $contents .= ' द्वारा  पारित ';
 if($is_genrate == true){
	$contents .= $post_data['order_date'].' ';
 } else {
	$contents .= '<select name="order_date" ><option >आदेश</option><option > निर्णय</option></select> ';
 }
 

 $contents .= 'दिनांक ';
if($is_genrate == true){ 
    $contents .= $post_data['date2'];
} else {
    $contents .= ' ----------';
}
$contents .= ' के विरूद्ध मान0 उच्चतम न्यायालय के समक्ष ';
if($is_genrate == true){
	$contents .= ' <b>'.$post_data['writ_lists_for'].'</b></span>';
	
} else {
		$contents .= '-------------';
}
$contents .= ' प्रस्तुत करें।</p> </td></tr>';
$contents .= '<tr><td align="left"><p><span style="margin-left:8%"></span>';
$avadhi  = date('d/m/Y',strtotime($file_judgment_date1.' +90 days'));
$avadhi_date =  date('Y-m-d',strtotime($file_judgment_date1.' +90 days'));
$file_mark_section_date_diff =  date('Y-m-d',strtotime($file_mark_section_date));
$days_delay = day_difference_dates($avadhi_date, $file_mark_section_date_diff);
if($is_genrate == true){ 
    $contents .=  $post_data['days'];
} else {
    $contents .= '<input type="text" class="" name="days" size="100" value="प्रशासकीय विभाग द्वारा प्रस्ताव  '.$days_delay.' दिवस विलंब से प्रेषित किया गया हैं |" />';
}
$contents .= ' </p> </td></tr>';
$contents .= '<tr><td align="left"><p><span style="margin-left:8%"></span>हस्ताक्षरयुक्त वकालतनामा संलग्न कर भेजा जा रहा है।</p></td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">मध्यप्रदेश के राज्यपाल के नाम से तथा आदेशानुसार,</div></td></tr>';
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right"><div  style="width:50%; text-align:center;">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td>&nbsp;</td></tr>';
}
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;"  contenteditable="false">(';
if($is_genrate == true){
$contents .=  get_officer_information($this->input->post('add_secetroy')); 

}else
{
	 $contents .= '--------------------';
	
}
$contents .= ')</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;"  contenteditable="false">';
if($is_genrate == true){	
    $contents .=   get_officer_dign($this->input->post('add_secetroy'));
}
else {
	 $contents .= '-------';
	}
	
$contents .= '</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">'.$dept_name.'</div></td></tr>';
$contents .= '<tr><td align="left"><div style="float:left;">पृ0 क्रमांक 5/ '.$panji_krmank.'/'.date("Y").'/'.$file_number.'/21-क(या0)</div><div style="float:right;">भोपाल, दिनांक ';
if($is_genrate == true){ 
    $contents .=  '&nbsp;&nbsp; '.get_date_formate($post_data['date4'],'/m/Y');
} else {
    $contents .= '<input type="text" class="date1" name="date4" placeholder="dd/mm/yyyy" value="'.$today.'"/></div>';
}
$contents .=  '</td></tr>';
$contents .= '<tr><td align="left">प्रतिलिपि:-</td></tr>';
$contents .= '<tr><td align="left"><p>';
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
$contents .=  ' भोपाल की ओर उनके यू0ओ0क्र0 '.$file_uo_or_letter_no.', दिनांक  ';
$contents .=  ' '.get_date_formate($file_uo_or_letter_date,'d/m/Y');
$contents .= ' के संदर्भ में उनकी विभागीय नस्ती के साथ भेजकर निवेदन हैं कि प्रकरण के प्रभारी अधिकारी को निर्देश दें कि वह तत्काल उपरोक्त अधिवक्ता से नई दिल्ली में संपर्क कर आवश्यक कार्यवाही करवाये| ';
if($is_genrate == true){ 
    $contents .=  $post_data['spast'];
} else {
    $contents .= '<input type="text" class="" name="spast" size="100" value="साथ ही देरी के तथ्य को स्पष्ट करने का उत्तरदायित्व प्रशासकीय विभाग का होगा |" />';
}
$contents .= '</p></td></tr>';
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right"><div  style="width:50%; text-align:center;">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td>&nbsp;</td></tr>';
}
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;"  contenteditable="false">(';
if($is_genrate == true){
$contents .=  get_officer_information($this->input->post('add_secetroy')); 

}else
{
	 $contents .= '-------'; 
	
}
$contents .= ')</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;"  contenteditable="false" >';
if($is_genrate == true){	
    $contents .=   get_officer_dign($this->input->post('add_secetroy'));
}
else {
	 $contents .= '-------';
	}
	
$contents .= '</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">'.$dept_name.'</div></td></tr>';

//print content
//echo $contents;
?>   

