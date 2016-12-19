<?php
$contents  = '' ;
$contents .= '<tr><td colspan="2"><div class=""><span class="shift-left">यात्रा देयक स्वीकृत करने विषयक ।</span></div></td></tr>';
$contents .= '<tr><td colspan="2"><table width="100%"><tr><td align="left">पंजी क्रमांक '.$panji_krmank.'/21-क(स्था.), </td><td align="right"> दिनांक '.$file_mark_section_date.'</td></tr></table></td></tr>';
$contents .= '<tr><td align="center" colspan="2" > ----------------------------------------------------------</td></tr>';
$contents .= '<tr><td colspan="2"><p class="text-justify shift-left" >  श्री ';
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
$contents .= ' विधि शासकीय कार्य से दिनांक   ';
if($is_genrate == true){
    $contents .= $post_data['start_date'];
}else{
	$contents .= '<input name="start_date" class="date1"  type="text"  />';
}
$contents .= 'से दिनांक ';
if($is_genrate == true){
    $contents .= $post_data['end_date'];
}else{
	$contents .= '<input name="end_date" class="date1"  type="text"  />';
}
$contents .= 'तक ';
if($is_genrate == true){
    $contents .= $post_data['state'];
}else{
	$contents .= '<input name="state"   type="text"  />';
}
$contents .= ' गये थे, जिसका देयक राशि रुपये ';
if($is_genrate == true){
    $contents .= $post_data['amount_spend'];
}else{
	$contents .= '<input name="amount_spend" class="amount_spend"  type="text"  />';
}
$contents .= ' <span class="span_amount"> -- </span> मात्र का भुगतान हेतु प्रस्तुत किया गया है। </p><br/></td></tr>';
$contents .= '<tr><td colspan="2"><p class="text-justify shift-left" >  उक्त देयक की जांच की गई जो सही एवं उचित है। श्री ';
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
$contents .= ', विधि को पूर्व में किसी भी प्रकार का अग्रिम स्वीकृत नहीं किया गया है।</p><br/></td></tr>';
$contents .= '<tr><td colspan="2"><p class="text-justify shift-left" >   अतः श्री ';
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
$contents .= ', विधि को यात्रा देयक की राशि रुपये ';
if($is_genrate == true){
    $contents .= $post_data['amount_spend'];
}else{
	$contents .= '<input name="amount_spend" class="amount_spend"  type="text"  />';
}
$contents .= ' <span class="span_amount"> -- </span>  मात्र का भुगतान किया जाना उचित होगा ।</p><br/></td></tr>';
$contents .= '<tr><td colspan="2"><p class="text-justify shift-left" >   आदेषार्थ प्रस्तुत ।</p><br/></td></tr>';
if($this->uri->segment(6) == 'p' || $this->uri->segment(7) == 'p'  ){
$contents .= '<tr><td colspan="2"><div><u>अनुभाग अधिकारी (स्था)</u> </div><br/><br/><br/></td></tr>';
$contents .= '<tr><td colspan="2"><div><u>वरिष्ठ लेखाधिकारी (स्था) </u> </div><br/></td></tr>';
}
$contents .= '<tr><td colspan="2"><br /><br/><br/><div  style="text-align:justify" ></div><br/></td></tr>';

?>
<style>
.shift-left{ margin-left:10%;}
.shift-top{ margin-top:20px; }
.shift-left{ text-indent:50px }
</style>



