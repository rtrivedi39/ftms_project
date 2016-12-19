<?php
$contents  = '' ;
$contents .= '<tr><td colspan="2"><div class="shift-buttom"><span class="shift-left">अनुकंपा नियुक्ति- ';

 if($is_genrate == true){
	 $contents .= $post_data['anukampa_emp_name'];
}else{
	$contents .= '<input name="anukampa_emp_name" id ="anukampa" class="anukampa_emp_name"  type="text"  />';
}
$contents .= ' स्व0 ';
if($is_genrate == true){
	$contents .= get_employee_name($this->input->post('emp_name') , '');// get_officer_information();
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
$contents .= ', </span></div></td></tr>';
$contents .= '<tr><td colspan="2"><table width="100%"><tr><td align="left">पंजी क्रमांक '.$panji_krmank.'/21-क(स्था.), </td><td align="right"> दिनांक '.$file_mark_section_date.'</td></tr></table></td></tr>';
$contents .= '<tr><td align="center" colspan="2" > ----------------------------------------------------------</td></tr>';
 $contents .= '<tr><td align="left" colspan="2"><p class="shift-left text-justify"> <span class="anukampa_emp_name" >------</span>, ';
 if($is_genrate == true){
	 $contents .= $post_data['address'];
}else{
	$contents .= '<input name="address"   type="text"  />';
}
$contents .= ' , ने उनके पिता ' ;
if($is_genrate == true){
	$contents .= get_employee_name($this->input->post('emp_name') , '');// get_officer_information();
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
$contents .= ', विधि विभाग, भोपाल का शासकीय सेवा में रहते हुये दिनांक ';
if($is_genrate == true){
	 $contents .= $post_data['death_date'];
}else{
	$contents .= '<input name="death_date" class="date1"  type="text"  />';
}
$contents .= ' को स्वर्गवास हो जाने के कारण मृत्यु प्रमाण-पत्र एवं स्वयं का बायोडाॅटा संलग्न कर अनुकंपा नियुक्ति हेतु आवेदन निर्धारित प्रपत्र में आवेदन कर अनुकंपा नियुक्ति दिये जाने का निवेदन किया है ।  </td></tr>'; 
$contents .= '<tr><td colspan="2"><p class="text-justify shift-left" >  उक्त संबंध में लेख है कि <span class="anukampa_emp_name" >------</span> की जन्मतिथि ';
 if($is_genrate == true){
	 $contents .= $post_data['dob_date'];
}else{
	$contents .= '<input name="dob_date" class="date1"  type="text"  />';
}
$contents .= '  है। वे दसवी कक्षा उत्तीर्ण है, जो शासकीय सेवा में नियुक्ति हेतु न्यूनतम आयु पूर्ण नहीं करते है । </p><br/></td></tr>';
 $contents .= '<tr><td colspan="2"><p class="text-justify shift-left" >  सामान्य प्रशासन विभाग के परिपत्र दिनांक  ';
 if($is_genrate == true){
	 $contents .= $post_data['lat_date'];
}else{
	$contents .= '<input name="lat_date" class="date1"  type="text"  />';
}
$contents .= '  के बिन्दु क्रमांक-7 उप बिन्दु (7.1) में स्पष्ट उल्लेख किया गया है कि अवयस्क सदस्यों के संबंध में दिवंगत शासकीय सेवक के परिवार में कोई पात्र वयस्क सदस्य नहीं हो तो शासकीय सेवक की मृत्यु दिनांक ';
 if($is_genrate == true){
	 $contents .= $post_data['death_date'];
}else{
	$contents .= '<input name="death_date" class="date1"  type="text"  />';
}
$contents .= ' से 7 वर्ष की अवधि में वयस्क होने पर अनुकंपा नियुक्ति दी जा सकेगी । इसके पश्चात् यदि  वह वयस्क होता है तो अनुकंपा नियुक्ति की पात्रता नहीं होगी।  </p><br/></td></tr>';
$contents .= '<tr><td colspan="2"><p class="text-justify shift-left" > <span class="anukampa_emp_name" >------</span> की उम्र 15 वर्ष 7 माह है, जो नियुक्ति हेतु निर्धारित पूर्ण अर्हता नहीं रखते है । इसलिये नियमानुसार उन्हेें वर्तमान में अनुकंपा नियुक्ति की पात्रता नहीं है, परंतु सामान्य प्रशासन विभाग के परिपत्र दिनांक ';

 if($is_genrate == true){
	 $contents .= $post_data['cer_date'];
}else{
	$contents .= '<input name="cer_date" class="date1"  type="text"  />';
}
$contents .= ' की कंडिका (7.1) में किये गये  प्रावधान के अनुसार  <span class="anukampa_emp_name" >------</span>  के वयस्क होने पर पात्रता के आधार पर अनुकंपा नियुक्ति हेतु नियमानुसार विचार किया जा सकेगा ।  </p><br/></td></tr>';
$contents .= '<tr><td colspan="2"><p class="text-justify shift-left" >  अतः उपरोक्त स्थिति में प्रकरण में फिलहाल कोई कार्यवाही अपेक्षित नहीं है । तदानुसार आवेदक को अवगत कराया जाना उचित होगा ।  </p><br/></td></tr>';
$contents .= '<tr><td colspan="2"><p class="text-justify shift-left" >  आदेशार्थ प्रस्तुत । </p><br/></td></tr>';


if($this->uri->segment(6) == 'p' || $this->uri->segment(7) == 'p'  ){
$contents .= '<tr><td colspan="2"><div><u>अनुभाग अधिकारी (स्था) </u> </div><br/><br/><br/></td></tr>';
$contents .= '<tr><td colspan="2"><div><u>अवर सचिव </u> </div><br/><br/><br/></td></tr>';
$contents .= '<tr><td colspan="2"><div><u>व0ले0अ0 </u> </div><br/><br/><br/></td></tr>';
}
$contents .= '<tr><td colspan="2"><br /><br/><br/><div  style="text-align:justify" ></div><br/></td></tr>';

?>
<style>
.shift-left{ margin-left:10%;}
.shift-top{ margin-top:20px; }
.shift-left{ text-indent:50px }
</style>



