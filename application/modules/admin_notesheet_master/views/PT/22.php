<?php 
$contents  = '' ;
$contents .= '<tr><td align="left"> <div style="margin-top:20px;"><span style="margin-left:10%;">';
if($is_genrate == true){ 
    $contents .=  $post_data['option_for'];
} else {
	$contents .= ' <select name="option_for" class="">';
	$contents .= '<option value="W.P.">W.P.</option>';
	$contents .= '<option value="W.A.">W.A.</option>';
	$contents .= '<option value="S.L.P.">S.L.P.</option>';
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
$contents .= ' के संबंध में|</span></div></td></tr>';
$contents .= '<tr><td align="center">--00--</td></tr>';
$contents .= '<tr><td align="left"><div style="float:left;">पंजी क्रमांक : '.$file_number.'/'.date("Y").'/21-क(या0)</div><div style="float:right;">भोपाल, दिनांक ';
if($is_genrate == true){ 
    $contents .=  get_date_formate($post_data['date1'],'d/m/Y');
} else {
    $contents .= '<input type="text" class="date1" name="date1" placeholder="dd/mm/yyyy" value="'.$file_mark_section_date.'"/></div>';
}
$contents .=  '</td></tr>';
$contents .= '<tr><td align="left"> कृपया अध: स्थित विचाराधीन पत्र का अवलोकन करने का कष्ट करें । </td></tr>';
$contents .= '<tr><td align="left"><p>प्राप्त पत्र /नस्ती का संबंध याचिका शाखा से न होकर ';
if($is_genrate == true){ 
    $contents .=  ' '.getSection($post_data['section']);
} else {
	$contents .= ' <select name="section" class="section">';
	$sections .= get_list(SECTIONS,'','');
	foreach($sections as $row){
		$contents .= '<option value="'.$row['section_id'].'">'.$row['section_name_hi'].'('.$row['section_name_en'].')</option>';
	}
	$contents .= '</select>';
}
$contents .=  ' शाखा से होने के कारण पत्र /नस्ती को मूलत: आवश्यक कार्यवाही हेतु संबंधित शाखा को भेजा जाना उचित होगा ।</td></tr>';
if($this->uri->segment(6) == 'p'){
$contents .= '<tr><td><u>अनुभाग अधिकारी (याचिका)</u></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>अवर सचिव (याचिका)</u></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>अति. सचिव (याचिका)</u></td></tr>';*/
$contents .= ' <tr><td></td></tr><tr><td></td></tr>';
}

?>