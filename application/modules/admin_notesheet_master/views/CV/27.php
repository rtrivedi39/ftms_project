<?php 
$contents  = '' ;

$contents .= '<tr><td align="center"><u><h3>'.$dept_name.'</h3></u></td></tr>';
$contents .= '<tr><td align="center"><div style="float:left;"> फा0क्र0 4(ए)/';
if($is_genrate == true){ 
    $contents .=  $post_data['headno'];
} else {
    $contents .= ' <input type="text"  name="headno" placeholder="" value="'.$file_number.'"/>';
} 

$contents .= '/'.date("Y").'/'.$file_number.'/21-(या0),  </div><div style="float:right;">भोपाल, दिनांक ';
if($is_genrate == true){ 
    $contents .=  get_date_formate($post_data['date1'],'d/m/Y').'</td></tr>';
} else {
    $contents .= ' <input type="text" class="date1" name="date1" placeholder="dd/mm/yyyy" value="'.$today.'"/></td></tr>';
} 
$contents .=  '</td></tr>';
$contents .= '<tr><td align="left">प्रति, </td></tr>';

if($is_genrate == true){
	$contents .= '<tr><td align="left"><span style="margin-left:8%">'.$post_data['advocate_type'].'</span>,</td></tr>';
	$contents .= '<tr><td align="left"><span style="margin-left:8%">'.$post_data['court_type'].'</span>,</td></tr>';
	$contents .= '<tr><td align="left"><span style="margin-left:8%">'.$post_data['court_location'].'</span></td></tr>';
} else {
	$contents .= '<tr><td align="left"><select name="advocate_type" class="advocate_type">';
	foreach($advocate_type as $row){
		$contents .= '<option value="'.$row.'">'.$row.'</option>';
	}
	$contents .= '</select></td></tr>';
	$contents .= '<tr><td align="left"><select name="court_type" class="court_type">';
	foreach($court_type as $row){
		if(($emp_allot_seet == 1 && $row == 'मान0  उच्च न्यायालय' ) || ($emp_allot_seet == 2 && $row == 'मान0 उच्च न्यायालय खण्डपीठ' ) || ($emp_allot_seet == 3 && $row == 'मान0 उच्च न्यायालय खण्डपीठ' )  )
		{
			$contents .= '<option value="'.$row.'" selected>'.$row.'</option>';
		}else{
			$contents .= '<option value="'.$row.'">'.$row.'</option>';
		}
	}
	$contents .= '</select></td></tr>';
	$contents .= '<tr><td align="left"><select name="court_location" class="court_location">';
	foreach($court_location as $row){
		if(($emp_allot_seet == 1 && $row == 'जबलपुर, मध्यप्रदेश' ) || ($emp_allot_seet == 2 && $row == 'ग्वालियर, मध्यप्रदेश' ) || ($emp_allot_seet == 3 && $row == 'इंदौर, मध्यप्रदेश' )  ){
			$contents .= '<option value="'.$row.'" selected>'.$row.'</option>';
		}
		else{
			$contents .= '<option value="'.$row.'">'.$row.'</option>';
		}
	}
	$contents .= '</select></td></tr>';
}
$contents .= '<tr><td align="left"><div style="float:left; width:8%;">विषय:- </div> <div style="float:left; width:90%;">रिट याचिका क्रं0  '.$case_no;
if($is_genrate == true){ 
    $contents .=  ' '.$post_data['agenst_name'];
} else {
    $contents .= ' <input type="text" class="" name="agenst_name" value="'.$agenst_name.'" />';
}
$contents .= ' विरुद्ध ';
if($is_genrate == true){ 
    $contents .=  $post_data['agenst'];
} else {
    $contents .= '<input type="text" class="" name="agenst" value="'.$agenst.'" />';
}
$contents .= ' में पारित ';
if($is_genrate == true){ 
    $contents .=  $post_data['adesh_nirna'];
} else {
	$contents .= ' <select name="adesh_nirna" class="">';
	$contents .= '<option value="आदेश">आदेश</option>';
	$contents .= '<option value="निर्णय">निर्णय</option>';
	$contents .= '</select>';
}
$contents .= ' दिनांक  ';
if($is_genrate == true){ 
    $contents .=  $post_data['date2'];
} else {
    $contents .= '<input type="text" class="date1" name="date2" placeholder="dd/mm/yyyy" value="'.$file_judgment_date1.'" />';
}      
$contents .= ' के विरूद्ध ';
if($is_genrate == true){ 
    $contents .=  $post_data['option_for'];
} else {
	$contents .= ' <select name="option_for" class="">';
	$contents .= '<option value="रिट अपील">रिट अपील</option>';
	$contents .= '<option value="पुनरीक्षण">पुनरीक्षण </option>';
	$contents .= '</select>';
}
$contents .= '  के संबंध में।</div></td></tr>';
$contents .= '<tr><td align="left"><p><span style="margin-left:8%"></span>राज्य शासन ने निर्णय लिया है कि ';
if($is_genrate == true){
	$contents .= ' '.$post_data['court_type'];
	$contents .= ' '.$post_data['court_location'];
} else {
	$contents .= '--------------';
	$contents .= ' --------------';
}
$contents .= ' के ';
if($is_genrate == true){ 
    $contents .=  $post_data['adesh_nirna'];
} else {
    $contents .= '----------';
} 

$contents .= ' दिनांक  ';
if($is_genrate == true){ 
    $contents .=  $post_data['date2'];
} else {
    $contents .= '----------';
}      
$contents .= ' के विरूद्ध ';
if($is_genrate == true){
	$contents .= ' '.$post_data['court_type1'];
	$contents .= ' '.$post_data['court_location1'];
} else {
	$contents .= '<select name="court_type1" class="court_type">';
	foreach($court_type as $row){
		if(($emp_allot_seet == 1 && $row == 'मान0  उच्च न्यायालय' ) || ($emp_allot_seet == 2 && $row == 'मान0 उच्च न्यायालय खण्डपीठ' ) || ($emp_allot_seet == 3 && $row == 'मान0 उच्च न्यायालय खण्डपीठ' )  )
		{
			$contents .= '<option value="'.$row.'" selected>'.$row.'</option>';
		}else{
			$contents .= '<option value="'.$row.'">'.$row.'</option>';
		}
	}
	$contents .= '</select>';
	$contents .= ' <select name="court_location1" class="court_location">';
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
$contents .= ' के समक्ष ';
if($is_genrate == true){ 
    $contents .=  $post_data['option_for'];
} else {
	$contents .= ' ------';
	
}
$contents .= '  प्रस्तुत की जाए।</p></td></tr>';
$contents .= '<tr><td align="left"><p><span style="margin-left:8%"></span>';
$avadhi  = date('d/m/Y',strtotime($file_judgment_date1.' +45 days'));
$avadhi_date =  date('Y-m-d',strtotime($file_judgment_date1.' +45 days'));
$file_mark_section_date_diff =  date('Y-m-d',strtotime($file_mark_section_date));
$days_delay = day_difference_dates($avadhi_date, $file_mark_section_date_diff);
if($is_genrate == true){ 
    $contents .=  $post_data['days'];
} else { 
    $contents .= '<input type="text" class="" name="days"  size="100" value="प्रशासकीय विभाग द्वारा रिट अपील प्रस्तुत किये जाने का प्रस्ताव   '.$days_delay.'  दिन विलंब से प्रस्तुत किया गया है।" />';
}
$contents .= '</p></td></tr>';
$contents .= '<tr><td align="left"><p><span style="margin-left:8%"></span>अत: ';
if($is_genrate == true){ 
    $contents .=  $post_data['option_for'];
} else {
	$contents .= ' -----';
	
}

$contents .= '  तत्काल प्रस्तुत करें।</p></td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">मध्यप्रदेश के राज्यपाल के नाम से तथा आदेशानुसार,</div></td></tr>';
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right"><div  style="width:50%; text-align:center;">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td>&nbsp;</td></tr>';
}
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;" contenteditable="false" >( ';
if($is_genrate == true){
	 if($this->input->post('avar_secetroy') != ''){
		$contents .= get_officer_information($this->input->post('avar_secetroy')); 
	 } else {
		 $contents .= get_officer_information($this->input->post('add_secetroy')); 
	 }
}else{
	 $contents .= get_officer_for_sign('avar_secetroy' ,$uber_sect , '', $us_id);
	 $contents .= get_officer_for_sign('add_secetroy' ,$add_secetroy ,'', $as_id);
}
$contents .= ' )</div></td></tr>';


$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;" contenteditable="false"> ';
if($is_genrate == true){	
    if($this->input->post('avar_secetroy') != ''){	
		$contents .=   get_officer_dign($this->input->post('avar_secetroy'));
	} else {
		$contents .=   get_officer_dign($this->input->post('add_secetroy'));
	}
}
else {
	 $contents .= '-------';
	} 
$contents .= '</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">'.$dept_name.'</div></td></tr>';
$contents .= '<tr><td align="center"><div style="float:left;"> फा0क्र0 4(ए)/ ';
if($is_genrate == true){	
    $contents .=  $post_data['headno'];
}
else {
	 $contents .= '--------';
	} 
$contents .= '/'.date("Y").'/'.$file_number.'/21-(या0),  </div><div style="float:right;">भोपाल, दिनांक ';
if($is_genrate == true){ 
    $contents .=  get_date_formate($post_data['date4'],'d/m/Y');
} else {
    $contents .= '<input type="text" class="date1" name="date4" placeholder="dd/mm/yyyy" value="'.$today.'"/></div>';
}
$contents .=  '</td></tr>';
$contents .= '<tr><td align="left">प्रतिलिपि:-</td></tr>';
$contents .=  '<tr><td><p><span style="margin-left:8%"></span>';
if($is_genrate == true){ 
    $contents .=  $post_data['sectroy'];
} else {
    $contents .= ' <select name="sectroy" ><option>सचिव </option><option>प्रमुख सचिव </option></select>';
}
if($is_genrate == true){ 
    $contents .=  $post_data['vibhag_name'];
} else { 
    $contents .= '<input type="text" class="" name="vibhag_name"  size="70" value=", म0प्र0 शासन,‍  '.$file_department.',  भोपाल " />';
}
$contents .=  ' की ओर उनके यू0ओ0क्र0 '.$file_uo_or_letter_no.', दिनांक  ';
$contents .=  ' '.get_date_formate($file_uo_or_letter_date,'d/m/Y');
$contents .= ' के संदर्भ में नस्ती सहित भेजकर लेख है कि प्रकरण के प्रभारी अधिकारी को निर्देश दे कि वह तत्काल';
 if($is_genrate == true){
	$contents .= ' '.$post_data['advocate_type'];
	$contents .= ', '.$post_data['court_type'];
	$contents .= ', '.$post_data['court_location'];
} else {
	$contents .= '-----------, ';
	$contents .= '-----------, ';
	$contents .= '----------- ';
}
$contents .= ' से संपर्क कर मान0 उच्च न्यायालय में ';
if($is_genrate == true){ 
    $contents .=  $post_data['option_for'];
} else {
	$contents .= ' -----';
	
}
$contents .=' प्रस्तुत करने की कार्यवाही करें।';
if($is_genrate == true){ 
    $contents .=  $post_data['soast'];
} else {
	$contents .= ' <input type="text" class="" name="soast"  size="100" value="साथ ही देरी के तथ्य को स्पष्ट करने का उत्तरदायित्व प्रशासकीय विभाग का होगा।" > </p>' ;
	
}
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right"><div  style="width:50%; text-align:center;">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td>&nbsp;</td></tr>';
}
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;" contenteditable="false">( ';
if($is_genrate == true){
	if($this->input->post('avar_secetroy') != ''){
		$contents .= get_officer_information($this->input->post('avar_secetroy')); 
	 } else {
		 $contents .= get_officer_information($this->input->post('add_secetroy')); 
	 }

}else
{
	  $contents .= '-------';
	
}

$contents .= ' )</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;" contenteditable="false">';
if($is_genrate == true){
	if($this->input->post('avar_secetroy') != ''){	
		$contents .=   get_officer_dign($this->input->post('avar_secetroy'));
	} else {
		$contents .=   get_officer_dign($this->input->post('add_secetroy'));
	}
}
else {
	 $contents .= '-------';
	}
$contents .= '</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">'.$dept_name.'</div></td></tr>';
 
?>

