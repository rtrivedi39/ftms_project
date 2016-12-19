<?php
$contents  = '' ;
 $contents .= '<tr><td colspan="2"><div class=""><span class="shift-left"> व्यक्तिगत नस्ती- ';
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
$contents .= '।</span></div></td></tr>';
$contents .= '<tr><td colspan="2"><table width="100%"><tr><td align="left">पंजी क्रमांक '.$panji_krmank.'/21-क(स्था.), </td><td align="right"> दिनांक '.$file_mark_section_date.'</td></tr></table></td></tr>';
$contents .= '<tr><td align="center" colspan="2" > ----------------------------------------------------------</td></tr>';
$contents .= '<tr><td align="left" colspan="2"><p class="shift-left text-justify"> कृपया विचाराधीनआवेदन पत्र का अवलोकन हो।   </td></tr>'; 
$contents .= '<tr><td colspan="2"><p class="text-justify shift-left" >  इस विभाग के आदेश क्रमांक 2392/21-अ(स्था), दिनांक 24.4.2013 के पालन मे ';
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
 $contents .= ' , द्वारा  इस कार्यालय मे दिनांक ';
  if($is_genrate == true){
    $contents .= $post_data['dd_date'];
}else{
	$contents .= '<input name="dd_date" class="date1"  type="text"  />';
}
 $contents .= ' को पूर्वान्ह में डाटा ऐंट्री आपरेटर  के पद पर अपना पदभार ग्रहण कर लिया गया है ।   </p><br/></td></tr>';
$contents .= '<tr><td colspan="2"><p class="text-justify shift-left" >   अतः उक्त  कर्मचारी का चिकित्सीय परीक्षण एवं चरित्र सत्यापन कराया जाना उचित होगा ।</p><br/></td></tr>';
$contents .= '<tr><td colspan="2"><p class="text-justify shift-left" >   आदेशार्थ प्रस्तुत । </p><br/></td></tr>';


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



