<?php $this->load->view('B-II/state_tahsil') ?>
<?php
$contents  = '<table style="font-size:14px; margin:0% auto; width:80%;">' ;
$contents .= '<tr><td align="center"><h5><u>'.$dept_name.'</u></h5></td></tr>';
$contents .= '<tr><td align="center"><h5><u>(विन्ध्याचल भवन, प्रथम-तल, भोपाल)</u></h5></td></tr>';
$contents .= '<tr><td align="center"><h5><u>नोटरी के व्यवसाय संबंधी प्रमाण-पत्र</u></h5></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td align="center"><h5><u>पंजी क्रमांक  एम.पी. क्रमांक ';
if($is_genrate == true){ 
    $contents .=  $post_data['panji'];
} else {
    $contents .= '<input type="text" class="" name="panji"  value="" required/>';
}
$contents .= '/'.date('Y').'/21-ब(दो)</u></h5></td></tr>';
$contents .= '<tr><td align="center"><h5><u>फा0 क्रमांक 17(ई)/'.$file_number.'/21-ब(दो)/'.date('Y').'</u></h5></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><p>प्रमाणित किया जाता है कि  ';
$contents .= '<span id="notery_adv" ></span>';
if($is_genrate == true){ 
    $contents .=  '<b>'.$post_data['notriname'].'</b>';
} else {
    $contents .= '<input type="text" class="notriname adv_name" name="notriname"  value="श्री "/>';
}
$contents .= ' अधिवक्ता निवासी-  ';
if($is_genrate == true){ 
    $contents .=  $post_data['addres'].',';
} else {
    $contents .= '<input type="text" class="addres" name="addres"  value=""/>,';
}
$contents .= ' तहसील  ';
if($is_genrate == true){ 
    $contents .=  $post_data['tahsil'];
} else {
    $contents .= '<input type="text" class="adv_tahsil tahsil" name="tahsil"  value=""/>';
}
$contents .= ' जिला  ';
if($is_genrate == true){
    $contents .= $post_data['adv_distic2'];
} else {
	$contents .=  '<input type="text" class="distic_1 adv_distic" name="adv_distic2" value="">';//get_distic_dd('distic_1');
}
$contents .= ' (म0प्र0) को नोटरी अधिनियम, 1952 (क्रं-53 सन् 1952) के अधीन नोटरी के रूप में नियुक्त किया जाता है और उन्हें नोटरी के रूप में तहसील  ';
if($is_genrate == true){ 
    $contents .=  $post_data['tahsil'];
} else {
    $contents .= '<input type="text" class="tahsil" name="tahsil"  value=""/>';
}
$contents .= ' जिला  ';
if($is_genrate == true){
    $contents .= $post_data['adv_distic2'];
} else {
	$contents .=  '<input type="text" class="distic_1 adv_distic" name="adv_distic2" value="">';//get_distic_dd('distic_1');
}
$contents .= ' में व्यवसाय करने के लिये दिनांक ';
if($is_genrate == true){ 
    $contents .=  get_date_formate($post_data['vyav_date'],'d/m/Y');
} else {
    $contents .= '<input type="text" class="date1" name="vyav_date"  value="'.$today.'"/>';
}
$contents .= '  से ';
if($is_genrate == true){ 
    $contents .=  get_date_formate($post_data['vyav_date_tak'],'d/m/Y');
} else {
    $contents .= '<input type="text" class="date1" name="vyav_date_tak"  value="'.$today.'"/>';
}
$contents .= ' तक अर्थात पांच वर्ष की कालावधि के लिए प्राधिकृत किया जाता है।</p></td></tr>';
$contents .= '<tr><td><p>यह प्रमाण-पत्र मेरे हस्ताक्षर से ओर सरकार की मुद्राधीन तारीख दिनांक ';
if($is_genrate == true){ 
    $contents .=  get_date_formate($post_data['mudrit_date'],'d/m/Y');
} else {
    $contents .= '<input type="text" class="date1" name="mudrit_date"  value="'.$today.'"/>';
}
$contents .= ' को दिया जाता है।  </p></td></tr>';
$contents .= '<tr><td align="right">मध्यप्रदेश के राज्यपाल के नाम से तथा आदेशानुसार,</td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">(<b>';
if($is_genrate == true){
	$contents .= $post_data['slname'];
} else {
	$contents .= ' <select name="slname" class="slname">';
	foreach(user_byrole_section(null,5) as $key => $name){
		$slname = $name['emp_full_name_hi'];
		$slected = $as_name == $slname ? "selected" : "";
		$contents .= '<option value="'.$slname.'" '.$slected.'>'.$slname.'</option>';
	}
	$contents .= '</select>';	
}
$contents .= '</b>)</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;"><b>अपर सचिव,</b></div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">'.$dept_name.'</div></td></tr>';
$contents .= '</table>';
?>
<?php  $this->load->view('B-II/b_2section_js');?>
                
                
        
                  
                
               
                