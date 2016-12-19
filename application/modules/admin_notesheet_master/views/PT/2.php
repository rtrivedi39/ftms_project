<?php 
$contents  = '' ;
$contents .= '<tr><td align="right"><b><u>स्पीड पोस्ट द्वारा</u></b></td></tr>';
$contents .= '<tr><td align="center"><u><h3>'.$dept_name.'</h3></u>';
$contents .= '<tr><td><div style="float:left">क्रमांक  '.$file_number.'/'.date("Y").'/21-क(या0),  </div><div style="float:right">भोपाल, दिनांक  ';
if($is_genrate == true){
$contents .= get_date_formate($post_data['date1'],'d/m/Y').'</div></td></tr>';
}else
{
	$contents .=  '<input type="text" class="date1" name="date1" value="'.$today.'" placeholder="dd/mm/yyyy" required>';
}
$contents .=  '</div></td></tr>';
$contents .= '<tr><td> प्रेषकः-</td></tr>';
$contents .=  '<tr><td><span style="margin-left:8%">'.$as_name.'</span></td></tr>';
$contents .=  '<tr><td><span style="margin-left:8%">अतिरिक्त सचिव, विधि</span></td></tr>';

$contents .=  '<tr><td>प्रति,</td></tr>';
$contents .=  '<tr><td><span style="margin-left:8%">विधि परामर्शी/प्रमुख सचिव,</span></td></tr>';
$contents .=  '<tr><td><span style="margin-left:8%">';
if($is_genrate == true){
	$contents .= $post_data['state'];
}else{
	$contents .= '<tr><td align="left"><select name="state" class="state">';
	foreach($state_list as $row){
		$contents .= '<option value="'.$row->state_name_hi.'">'.$row->state_name_hi.'</option>';
	}
	$contents .= '</select>';
}
$contents .=  ' राज्य,</span></td></tr>';
$contents .=  '<tr><td><span style="margin-left:8%">विधि और विधायी कार्य विभाग,</span></td></tr>';
$contents .=  '<tr><td><span style="margin-left:8%">मंत्रालय, ';
if($is_genrate == true){
	$contents .= $post_data['state'];
}else{
	$contents .= ' <select name="state" class="state">';
	foreach($state_list as $row){
		$contents .= '<option value="'.$row->state_name_hi.'">'.$row->state_name_hi.'</option>';
	}
	$contents .= '</select>';
}
$contents .= '</span></td></tr>';
$contents .=  '<tr><td>विषय:-  <span style="margin-left:4%">';

$contents .=   $file_subject ;

$contents .= '</span></td></tr>';
$contents .=  '<tr><td align="center">::0::</td></tr>';
$contents .=  '<tr><td><p>उपरोक्त प्रकरण माननीय उच्च न्यायालय ';
if($is_genrate == true){
	$contents .= $post_data['state'];
}else{
	$contents .= ' <select name="state" class="state">';
	foreach($state_list as $row){
		$contents .= '<option value="'.$row->state_name_hi.'">'.$row->state_name_hi.'</option>';
	}
	$contents .= '</select>';
}
$contents .= ' में लंबित है, जिसमें म0प्र0 राज्य के मध्यप्रदेश शासन, विधि और विधायी कार्य विभाग, को पक्षकार बनाया गया है। अत: निवेदन है कि प्रकरण में म0प्र0 शासन की ओर से माननीय उच्च न्यायालय ';
if($is_genrate == true){
	$contents .= $post_data['state'];
}else{
	$contents .= ' <select name="state" class="state">';
	foreach($state_list as $row){
		$contents .= '<option value="'.$row->state_name_hi.'">'.$row->state_name_hi.'</option>';
	}
	$contents .= '</select>';
}
$contents .= ' में पैरवी करने के लिए महाधिवक्ता/ शासकीय अधिवक्ता को प्राधिकृत करने का कष्ट करें। नियुक्त किये गये शासकीय अधिवक्ता को फीस का भुगतान आपके राज्य में प्रचलित नियमों के अनुसार म0प्र0 शासन के विधि और विधायी कार्य विभाग, द्वारा किया जायेगा। कृपया अधिवक्ता नियुक्ति की सूचना संबंधित विभाग एवं विधि विभाग को भेजे।</p></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;" contenteditable="false">(';
if($is_genrate == true){
$contents .=  get_officer_information($this->input->post('add_secetroy')); 

}else
{
	 $contents .= get_officer_for_sign('add_secetroy' ,$add_secetroy ,'', $as_id);
	
}
$contents .= ')</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;" contenteditable="false">';
if($is_genrate == true){	
    $contents .=   get_officer_dign($this->input->post('add_secetroy'));
}
else {
	 $contents .= '-------';
	}
$contents .= '</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">'.$dept_name.'</div></td></tr>';
$contents .=  '<tr><td><div style="float: left"> पृ0 क्रमांक  '.$file_number.'/'.date("Y").'/21-क(या0),            </div>    	<div style="float: right"> भोपाल, दिनांक     '; 
if($is_genrate == true){
$contents .= get_date_formate($post_data['date2'],'d/m/Y').'</div></td></tr>';
}else
{
	$contents .=  '<input type="text" class="date1" name="date2" value="'.$today.'"  placeholder="dd/mm/yyyy" required>';
}
$contents .=  '</div> </td> </tr>';
$contents .=  '<tr><td> प्रतिलिपि:- </td></tr>';
$contents .=  '<tr><td><p>प्रमुख सचिव, म0प्र0 शासन,‍ ';
$contents .=  ' '.$file_department;
$contents .=  ', मंत्रालय भोपाल की ओर उनके यू0ओ0क्र0 '.$file_uo_or_letter_no.', दिनांक  ';
$contents .=  ' '.get_date_formate($file_uo_or_letter_date,'d/m/Y');
$contents .= ' के संदर्भ में उनकी विभागीय नस्ती के साथ भेजकर निवेदन है कि प्रकरण के प्रभारी अधिकारी को निर्देश दे कि वह तत्काल विधि परामर्शी/ प्रमुख सचिव, ';
if($is_genrate == true){
	$contents .= $post_data['state'];
}else{
	$contents .= ' <select name="state" class="state">';
	foreach($state_list as $row){
		$contents .= '<option value="'.$row->state_name_hi.'">'.$row->state_name_hi.'</option>';
	}
	$contents .= '</select>';
}
$contents .= ' राज्य, विधि और विधायी कार्य विभाग, मंत्रालय, ';
if($is_genrate == true){
	$contents .= $post_data['state'];
}else{
	$contents .= ' <select name="state" class="state">';
	foreach($state_list as $row){
		$contents .= '<option value="'.$row->state_name_hi.'">'.$row->state_name_hi.'</option>';
	}
	$contents .= '</select>';
}
$contents .= '  राज्य से संपर्क स्थापित कर आवश्यक कार्यवाही करना सुनिश्चित करें। </p></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;" contenteditable="false">(';
if($is_genrate == true){
$contents .=  get_officer_information($this->input->post('add_secetroy')); 

}else
{
	 $contents .= get_officer_for_sign('add_secetroy' ,$add_secetroy ,'', $as_id);
	
}
$contents .= ')</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;" contenteditable="false">';
if($is_genrate == true){	
    $contents .=   get_officer_dign($this->input->post('add_secetroy'));
}
else {
	 $contents .= '-------';
	}
$contents .= '</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">'.$dept_name.'</div></td></tr>';


//echo $contents ;
?>


