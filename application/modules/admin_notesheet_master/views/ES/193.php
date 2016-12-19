<?php
$contents  = '' ;
$contents .= '<tr><td colspan="2"><div  class="shift-buttom" ><span  class="shift-left">शासकीय वाहन क्रमांक <input type="text" name="year"  value="" placeholder="वाहन क्रमांक "/>  में आवष्यक 
कार्य कराये जाने बाबत्। </span>';
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
$contents .='</div></td></tr>';
$contents .= '<tr><td align="left"><br />पंजी क्रमांक '.$panji_krmank.'/21- अ(स्था),<br /></td><td align="right"><br /> दिनांक '.$file_mark_section_date.'<br /></td></tr>';
$contents .= '<tr><td align="center" colspan="2">&nbsp; &nbsp;---------------------------------------------&nbsp;&nbsp;</td></tr>';
$contents .= '<tr><td colspan="2" align="left"><p>&nbsp;कृपया प्रस्तुत टीप एवं देयकों का अवलोकन करना चाहंेगे। </p></td></tr>';
$contents .= '<tr><td colspan="2"><div class="text-justify"><p>&nbsp; ';
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
$contents .='को आवंटित शासकीय वाहन क्रमांक';
if($is_genrate == true){
	$contents .= $post_data['amount'];
}else
{
$contents .='<input type="text" name="vno"  value="" placeholder="वाहन क्रमांक "/>';
}
$contents .='  में';
if($is_genrate == true){
	$contents .= $post_data['vrepairname'];
}else
{
$contents .=' <input type="text" name="vrepairname"  value="" placeholder="आॅटोमोबाईलस  नाम  "/>';
}

$contents .=' द्वारा प्रदाय बिल क्रं0 ';
if($is_genrate == true){

	$contents .= $post_data['year'];
}else
{
$contents .='<input type="text" name="year"  value="" placeholder=" बिल क्रं0 "/>';
}
$contents .=', दिनांक ';
if($is_genrate == true){

	$contents .= $post_data['date1'];
}else
{
$contents .='<input type="text" name="date1" class="date1"   value="" placeholder="दिनांक  "/>';
}
$contents .=' अनुसार अत्यावश्यक कार्य कराया जाकर राशि रूपये';
if($is_genrate == true){

	$contents .= $post_data['amount'];
}else
{
$contents .='<input type="text" name="amount"  value="" placeholder="रूपये "/>';
}
$contents .='(रूपये ';
if($is_genrate == true){

	$contents .= $post_data['amount2'];
}else
{
$contents .='<input type="text" name="amount2"  value="" placeholder="रूपये शब्द  में"/>';
}
$contents .=' केवल) का भुगतान हेतु प्रस्तुत किया गया।</p> ';

$contents .= '</div></td></tr>';


$contents .= '<tr><td colspan="2">';
if($is_genrate == true){

	$contents .= $post_data['textfield'];
}else
{
$contents .='<textarea name="textfield" cols="80" rows="5"></textarea>';
}
$contents .='<br/></td></tr>';
$contents .= '</td></tr>';

 ?>

