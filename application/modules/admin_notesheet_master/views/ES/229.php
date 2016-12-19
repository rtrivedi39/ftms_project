<?php
$contents  = '' ;
$contents .= '<tr><td colspan="2"><div class="shift-buttom"><span class="shift-left">'.$file_subject.' </span></div></td></tr>';
$contents .= '<tr><td colspan="2"><table width="100%"><tr><td align="left">पंजी क्रमांक '.$panji_krmank.'/21-क(स्था.), </td><td align="right"> दिनांक '.$file_mark_section_date.'</td></tr></table></td></tr>';
$contents .= '<tr><td align="center" colspan="2" > ----------------------------------------------------------</td></tr>';
$contents .= '<tr><td align="left" colspan="2"><p class="shift-left text-justify"> उपरोक्‍तानुसार राशि रूपये ';
if($is_genrate == true){
	$contents .= $_POST['amount'];
}else
{
$contents  .= '<input type="text" name="amount" >';	
}
$contents .= '/. का भुगतान ';
if($is_genrate == true){
	$contents .= get_officer_information($this->input->post('employee_name') );
}else
{
$contents  .= get_employee_list('employee_name');	
}
$contents .= ' ';
if($is_genrate == true){
	$contents .= get_officer_dign($this->input->post('employee_name') );
}else
{
$contents  .= '-------';
}
$contents .= ' द्वारा किया गया । अत: राशि रूपये ';
if($is_genrate == true){
	$contents .= $_POST['amount'];
}else
{
$contents  .= '<input type="text" name="amount" >';	
}
$contents .= '/- का भुगतान स्‍थाई अग्रिम की मद 22-008 से ';
if($is_genrate == true){
	$contents .= get_officer_information($this->input->post('employee_name') );
}else
{
$contents  .= get_employee_list('employee_name');	
}
$contents .= ' ';
if($is_genrate == true){
	$contents .= get_officer_dign($this->input->post('employee_name') );
}else
{
$contents  .= '-------';
}
$contents  .= ' को किया जाना उचित होगा ।';
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



