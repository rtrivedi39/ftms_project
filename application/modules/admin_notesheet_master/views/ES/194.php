<?php
$contents  = '' ;
$contents .= '<tr><td colspan="2"><div class=""><span class="shift-left"> एल.टी.सी. देयक स्वीकृत करने विषयक |</span></div></td></tr>';
$contents .= '<tr><td colspan="2"><table width="100%"><tr><td align="left">पंजी क्रमांक '.$panji_krmank.'/21-क(आप.), </td><td align="right"> दिनांक '.$file_mark_section_date.'</td></tr></table></td></tr>';
$contents .= '<tr><td align="center" colspan="2" > ----------------------------------------------------------</td></tr>';
$contents .= '<tr><td align="left" colspan="2"><p class="shift-left text-justify"> कृपया विचाराधीन देयक का अवलोकन हो। </p></td></tr>'; 
$contents .= '<tr><td colspan="2"><p class="text-justify shift-left" >';
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
$contents .= ' विधि ';
if($is_genrate == true){
	 $contents .= $post_data['start_date'];
}else{
	$contents .= '<input name="start_date" class="date1" type="text"  />';
}
$contents .= 'से ';
if($is_genrate == true){
	 $contents .= $post_data['end_date'];
}else{
	$contents .= '<input name="end_date" class="date1" type="text"  />';
}
$contents .= '  तक परिवार सहित एल0टी0सी0 पर ';
if($is_genrate == true){
	 $contents .= $post_data['state'];
}else{
	$contents .= '<input name="state"  type="text"  />';
}
$contents .= '  यात्रा पर गये थे|जिसका यात्रा देयक की राषि रुपये';
if($is_genrate == true){
	 $contents .= $post_data['amount'];
}else{
	$contents .= '<input name="amount"  type="text"  />';
}
$contents .= '( <span class ="amount_in_word"></span>) भुगतान हेतु प्रस्तुत किया गया है ।  </p><br/></td></tr>';
$contents .= '<tr><td colspan="2"><p class="text-justify shift-left" >   उक्त देयक की जांच की गई जो सही एवं उचित है। ';
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
$contents .= ' विधि को पूर्व में राशि रुपये ';
if($is_genrate == true){
	 $contents .= $post_data['amount_in_past'];
}else{
	$contents .= '<input name="amount_in_past"  type="text"  />';
}
$contents .= '(<span class ="amount_in_word"></span>) मात्र का यात्रा  अग्रिम स्वीकृत  किया गया था।</p><br/></td></tr>';
$contents .= '<tr><td colspan="2"><p class="text-justify shift-left" >   अतः ';
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
$contents .= ', विधि को एल.टी.सी. के यात्रा देयक की शेष राशि रुपये ';
if($is_genrate == true){
	 $contents .= $post_data['amount_in_past'];
}else{
	$contents .= '<input name="amount_in_past"  type="text"  />';
}
$contents .= '(<span class ="amount_in_word"></span>) मात्र का भुगतान किया जाना उचित होगा । </p><br/></td></tr>';
$contents .= '<tr><td colspan="2"><p class="text-justify shift-left" >   आदेशार्थ प्रस्तुत । </p><br/></td></tr>';
if($this->uri->segment(6) == 'p' || $this->uri->segment(7) == 'p'  ){
$contents .= '<tr><td colspan="2"><div><u>अनुभाग अधिकारी (स्था.) </u> </div><br/><br/><br/></td></tr>';
$contents .= '<tr><td colspan="2"><div><u>वरिष्ठ लेखाधिकारी</u> </div><br/></td></tr>';
}
$contents .= '<tr><td colspan="2"><br /><br/><br/><div  style="text-align:justify" ></div><br/></td></tr>';

?>
<style>
.shift-left{ margin-left:10%;}
.shift-top{ margin-top:20px; }
.shift-left{ text-indent:50px }
</style>



