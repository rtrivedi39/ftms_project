<?php
$contents  = '' ;
$contents .= '<tr><td colspan="2"><div class=""><span class="shift-left">मोबाईल देयक के भुगतान के संबंध में। (';
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
$contents .= ')</span></div></td></tr>';
$contents .= '<tr><td colspan="2"><table width="100%"><tr><td align="left">पंजी क्रमांक '.$panji_krmank.'/21-क(आप.), </td><td align="right"> दिनांक '.$file_mark_section_date.'</td></tr></table></td></tr>';
$contents .= '<tr><td align="center" colspan="2" > ----------------------------------------------------------</td></tr>';
$contents .= '<tr><td align="left" colspan="2"><p class="shift-left text-justify">कृपया प्रस्तुत मोबाईल देयक का अवलोकन करना चाहेंगे। </p></td></tr>'; 
$contents .= '<tr><td colspan="2"><p class="text-justify shift-left" >';
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
$contents .= ' विधि ने मोबाईल क्रमांक ';
if($is_genrate == true){
	 $contents .= $post_data['mobile_no'];
}else{
	$contents .= '<input name="mobile_no"  type="text"  />';
}
$contents .= ' का माह ';
if($is_genrate == true){
    $contents .= $post_data['month'];
}else{
    $contents .= get_month('month');
}

$contents .= ', ';
if($is_genrate == true){
    $contents .= $post_data['year2'];
}else{
    $contents .= '<input type="text" name="year2" value="2016"  >';
}
    $contents .=' का राशि रूपये ';
if($is_genrate == true){
	 $contents .= $post_data['mobile_no'];
}else{
	$contents .= '<input name="mobile_no"  type="text"  />';
}
$contents .= '/- दिनांक ';
if($is_genrate == true){
	 $contents .= $post_data['date'];
}else{
	$contents .= '<input name="date"  type="text"  class="date1" />';
}
 $contents .= ' को नगद भुगतान कर, मोबाईल देयक भुगतान हेतु प्रस्तुत किया है। </p><br/></td></tr>';
$contents .= '<tr><td colspan="2"><p class="text-justify shift-left" > ';
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
$contents .= ' विधि को रूपये ';
if($is_genrate == true){
	 $contents .= $post_data['mobile_bill_amount'];
}else{
	$contents .= '<input name="mobile_bill_amount"  type="text"  />';
}
$contents .= ' प्रतिमाह मोबाईल रिचार्ज की पात्रता है। </p><br/></td></tr>';

$contents .= '<tr><td colspan="2"><p class="text-justify shift-left" >मांग संख्या';
if($is_genrate == true){
    $contents .= $post_data['mang'];
}else{
    $contents .= '<input type="text" name="mang" value="-29-2052-" >';
}
$contents .='सचिवालय सामान्य सेवाएं-(-';

if($is_genrate == true){
    $contents .= $post_data['mang1'];
}else{
    $contents .= '<input type="text" name="mang1" value="090" >';
}
$contents .=') सचिवालय योजना-(';
if($is_genrate == true){
    $contents .= $post_data['mang2'];
}else{
    $contents .= '<input type="text" name="mang2" value="9057" >';
}
$contents .='-विधि एवं विधायी कार्य की ';
if($is_genrate == true){
    $contents .= $post_data['mang3'];
}else{
    $contents .= '<input type="text" name="mang3" style="width: 250px;" value="मद-22-कार्यालय व्यय-(002) " >';
}
$contents .=' में वित्तीय वर्ष ';
if($is_genrate == true){
    $contents .= $post_data['fyear'];
}else{
    $contents .= '<input type="text" name="fyear" value="2016-17 " >';
}
$contents .=' हेतु प्राप्त आवंटन में से विकलनीय होगा। ';
$contents .= '<tr><td colspan="2"><p class="text-justify shift-left" > अतः पात्रतानुसार माह ';
if($is_genrate == true){
    $contents .= $post_data['month'];
}else{
    $contents .= get_month('month');
}
$contents .= ', ';
if($is_genrate == true){
    $contents .= $post_data['year1'];
}else{
    $contents .= '<input type="text" name="year1" value="2016"  >';
}
$contents .= ' हेतु रूपये ';
if($is_genrate == true){
	 $contents .= $post_data['mobile_bill_amount'];
}else{
	$contents .= '<input name="mobile_bill_amount"  type="text"  />';
}
$contents .= '(रूपये <span class="amount_in_words"></span>) स्वीकृत किया जाना प्रस्तावित है । </p><br/></td></tr>';
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



