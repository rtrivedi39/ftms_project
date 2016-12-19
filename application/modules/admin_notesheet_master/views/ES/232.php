<?php
$contents  = '' ;
$contents .= '<tr><td colspan="2"><div class=""><span class="shift-left">';
if($is_genrate == true){
$contents .= get_employee_designation_id($this->input->post('emp_name'), '',  false);
}
else{
$contents .= get_all_employee_ddllist('emp_name' ,'');
}
$contents .= ', ';
if($is_genrate == true){
$contents .=   get_employee_designation_id($this->input->post('emp_name')); 
}
else{
$contents .= '----' ;
} 
$contents .=' का अर्जित एवं चिकित्सा अवकश स्वीकृत करने विषयक। संलग्न. डाक्टर का प्रमाण पत्र। </span></div></td></tr>';
$contents .= '<tr><td colspan="2"><table width="100%"><tr><td align="left">पंजी क्रमांक '.$panji_krmank.'/21-क(स्था.), </td><td align="right"> दिनांक '.$file_mark_section_date.'</td></tr></table></td></tr>';
$contents .= '<tr><td align="center" colspan="2" > ----------------------------------------------------------</td></tr>';
$contents .= '<tr><td align="left" colspan="2"><p class="shift-left text-justify"> क़पया नस्तीं  प्रस्तुरत अावेदन पत्र ध्वज.अ एवं ब का अवलोकन  हो ।';
$contents .= ' </td></tr>'; 
 $contents .= '<tr><td colspan="2"><p class="text-justify shift-left" >ध्वज-अ में ';
 
  if($is_genrate == true){
$contents .= get_employee_designation_id($this->input->post('emp_name'), '',  false);
}
else{
$contents .= get_all_employee_ddllist('emp_name' ,'');
}
 
 $contents .= 'द्वारा आवेदन प्रस्तुहत कर निवेदन किया गया है कि बड्वानी में  उनकी सास का असामायिक निधन  हो जाने के कारण वह कार्यालय में उपस्थित नहीं हो सकते । 
 इस कारण दिनांक ';


  if($is_genrate == true){
    $contents .= $post_data['his_date'];
}else{
	$contents .= '<input name="his_date" class="date1"  type="text"  />';
}
 $contents .= ' से  ';
   if($is_genrate == true){
    $contents .= $post_data['after_date'];
}else{
	$contents .= '<input name="after_date" class="date1"  type="text"  />';
}
$contents .= '  तक मुख्यारलय अनुमति सहित अर्जित अवकाश स्वीकक़त करने का कष्टक करें ।    </p><br/></td></tr>';
$contents .= '<tr><td colspan="2"><p class="text-justify shift-left" > ';
  
$contents .= ' ध्वज.ब  में  ';
if($is_genrate == true){
$contents .= get_employee_designation_id($this->input->post('emp_name'), '',  false);
}
else{
$contents .= get_all_employee_ddllist('emp_name' ,'');
}

$contents .='द्वारा अनफिट प्रमाण पत्र सहित सूचना प्रेषित कर निवेदन किया गया है कि उनका स्वास्थ्य खराब हो जाने के कारण वह कार्यालय में उपस्थित नहीं हो सकते  । </p><br/></td></tr>';


$contents .= '<tr><td colspan="2"><br /><br/><br/><div  style="text-align:justify" >अत: ध्वज अ एवं ब अवलोकनार्थ प्रस्तुसत ।</div><br/></td></tr>';

?>


