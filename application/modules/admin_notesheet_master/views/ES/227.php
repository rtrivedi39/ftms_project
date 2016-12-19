<?php
$contents  = '' ;
$contents .= '<tr><td colspan="2"><div class="shift-buttom"><span class="shift-left">'.$file_subject.' </span></div></td></tr>';
$contents .= '<tr><td colspan="2"><table width="100%"><tr><td align="left">पंजी क्रमांक '.$panji_krmank.'/21-क(स्था.), </td><td align="right"> दिनांक '.$file_mark_section_date.'</td></tr></table></td></tr>';
$contents .= '<tr><td align="center" colspan="2" > ----------------------------------------------------------</td></tr>';
$contents .= '<tr><td align="left" colspan="2"><p class="shift-left text-justify"> ';
if($is_genrate == true){
	$contents .= get_officer_information($this->input->post('employee_name') );
}else
{
$contents  .= get_employee_list('employee_name');	
}
$contents .= ', ';
if($is_genrate == true){
	$contents .= get_officer_dign($this->input->post('employee_name') );
}else
{
$contents  .= '-------';
}
$contents  .= ', प्रमुख सचिव विधि शासकीय कार्य से दिनांक ';
if($is_genrate == true){
	$contents .= $_POST['start_date'];
}else
{
$contents  .= "<input type='text' name='start_date' class='date1'>";
}
$contents  .= ' दिनांक ';
if($is_genrate == true){
	$contents .= $_POST['end_date'];
}else
{
$contents  .= "<input type='text' name='end_date' class='date1'>";
}
$contents  .= ' तक जबलपुर गये थे, जिसका देयक राशि रुपये ';
if($is_genrate == true){
	$contents .= $_POST['amount_pol'];
}else
{
$contents  .= "<input type='text' name='amount_pol' >";
} 
$contents  .= ' (पीओएल) एवं ';
if($is_genrate == true){
	$contents .= $_POST['amount_da'];
}else
{
$contents  .= "<input type='text' name='amount_da' >";
} 
$contents  .= ' (डीए) कुल राशि रूपये ';
if($is_genrate == true){
	$contents .= $_POST['total_amount'];
}else
{
$contents  .= "<input type='text' name='total_amount' >";
} 
$contents  .= ' मात्र का भुगतान हेतु प्रस्तुत किया गया है। ';

$contents .= '  </p></td></tr>';
$contents .= '<tr><td align="left" colspan="2"><p class="shift-left text-justify"> उक्त देयक की जांच की गई जांच उपरांत एक विशेष एवं एक साधारण डीए दिया गया ।   जिसके अनुसार कुल राशि रूपये ';
if($is_genrate == true){
	$contents .= $_POST['amount_pol'];
}else
{
$contents  .= "<input type='text' name='amount_pol' >";
} 
$contents  .= ' पीओएल एवं डीए राशि रूपये ';
if($is_genrate == true){
	$contents .= $_POST['amount_da_pol'];
}else
{
$contents  .= "<input type='text' name='amount_da_pol' >";
} 
$contents  .= ' अर्थात कुल राशि रूपये ';
if($is_genrate == true){
	$contents .= $_POST['total_amount'];
}else
{
$contents  .= "-------------";
} 
$contents  .= ' का भुगतान किया जाना प्रस्‍तावित है  प्रमुख सचिव, विधि को पूर्व में किसी भी प्रकार का अग्रिम स्वीकृत नहीं किया गया है। ';
$contents .= '<tr><td align="left" colspan="2"><p class="shift-left text-justify"> अतः ';
if($is_genrate == true){
	$contents .= get_officer_information($this->input->post('employee_name') );
}else
{
$contents  .= get_employee_list('employee_name');	
}
$contents .= ', ';
if($is_genrate == true){
	$contents .= get_officer_dign($this->input->post('employee_name') );
}else
{
$contents  .= '-------';
}

$contents  .= ' , विधि को यात्रा देयक की राशि रुपये ';
if($is_genrate == true){
	$contents .= $_POST['amount_pol'];
}else
{
$contents  .= "<input type='text' name='amount_pol' >";
} 
$contents  .= ' (पीओएल) एवं ';
if($is_genrate == true){
	$contents .= $_POST['amount_da_pol'];
}else
{
$contents  .= "<input type='text' name='amount_da_pol' >";
} 
$contents  .= ' (डीए) कुल राशि रूपये ';
if($is_genrate == true){
	$contents .= $_POST['total_amount'];
}else
{
$contents  .= "-------------";
} 
$contents  .= ' मात्र का भुगतान किया जाना उचित होगा ।';

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



