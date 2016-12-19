<?php
$contents  = '' ;
$contents .= '<tr><td colspan="2"><div class="shift-buttom"><span class="shift-left">'.$file_subject.' </span></div></td></tr>';
$contents .= '<tr><td colspan="2"><table width="100%"><tr><td align="left">पंजी क्रमांक '.$panji_krmank.'/21-क(स्था.), </td><td align="right"> दिनांक '.$file_mark_section_date.'</td></tr></table></td></tr>';
$contents .= '<tr><td align="center" colspan="2" > ----------------------------------------------------------</td></tr>';
$contents .= '<tr><td align="left" colspan="2"><p class="shift-left text-justify"> उपरोक्‍त विषयक ';
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
$contents .= ' द्वारा आवेदन प्रस्‍तुत कर निवेदन किया गया है कि उनकी ';
if($is_genrate == true){
	$contents .= $_POST['relation'];
}else
{
$contents  .= '<input type="text" name="relation" placeholde="ex.- पत्नि" >';
}

if($is_genrate == true){
	$contents .= $_POST['relative_name'];
}else
{
$contents  .= '<input type="text" name="relative_name" placeholde=" " >';
}
$contents  .= ', ';
if($is_genrate == true){
	$contents .= $_POST['desesis'];
}else
{
$contents  .= '<input type="text" name="desesis" placeholde=" " >';
}
$contents  .= ', ';
$contents  .= 'रोग से पीडित है, जिनका ईलाज वर्तमान में ';
if($is_genrate == true){
	$contents .= $_POST['hospital'];
}else
{
$contents  .= '<input type="text" name="hospital" placeholde=" " >';
}
$contents  .= ' चिकित्‍सालय में चल रहा है। जिसका देयक राशि रूपये ';
if($is_genrate == true){
	$contents .= $_POST['amount'];
}else
{
$contents  .= '<input type="text" name="amount" >';
}

$contents  .= '(एक लाख चौहत्‍तर हजार तीन सौ पिचहत्‍तर) केवल का भुगतान हेतु प्रस्‍तुत किया गया है। ';
if($is_genrate == true){
$contents .= get_employee_designation_id($this->input->post('emp_name'), '',  false);
}
else{
$contents .= get_all_employee_ddllist('emp_name' ,'');
}

$contents .= ' द्वारा लेख किया गया है कि उनके द्वारा पूर्व में उक्‍त चिकित्‍सा  देयक का भुगतान प्राप्‍त नहीं किया गया है। </p></td></tr>';
$contents .= '<tr><td align="left" colspan="2"><p class="shift-left text-justify"> अत: यदि मान्‍य हो तो ';
if($is_genrate == true){
$contents .= get_employee_designation_id($this->input->post('emp_name'), '',  false);
}
else{
$contents .= get_all_employee_ddllist('emp_name' ,'');
}
$contents .= 'द्वारा प्रस्‍तुत चिकित्‍सा देयक पर सिविल सर्जन सह मुख्‍य अस्‍पताल अधीक्षक जयप्रकाश चिक्तिसालय भोपाल की सहमति ली जाना प्रस्‍तावित है, ताकि सहमति उपरांत देयक की राशि का भुगतान ';
if($is_genrate == true){
$contents .= get_employee_designation_id($this->input->post('emp_name'), '',  false);
}
else{
$contents .= get_all_employee_ddllist('emp_name' ,'');
}
$contents .= ' को किया जा सके ।  यदि मान्‍य हो तो प्रारूप अनुमोदनार्थ प्रस्‍तुत है।</p></td></tr>';


$contents .= '</p></td></tr>';
if($this->uri->segment(6) == 'p' || $this->uri->segment(7) == 'p'  ){
$contents .= '<tr><td colspan="2"><div><u>अनुभाग अधिकारी (स्था0) </u> </div><br/><br/><br/></td></tr>';
$contents .= '<tr><td colspan="2"><div><u>अवर सचिव </u> </div><br/><br/><br/></td></tr>';
}
$contents .= '<tr><td colspan="2"><br /><br/><br/><div  style="text-align:justify" ></div><br/></td></tr>';

?>
<style>
.shift-left{ margin-left:10%;}
.shift-top{ margin-top:20px; }
.shift-left{ text-indent:50px }
</style>



