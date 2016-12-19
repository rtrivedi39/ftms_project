<?php
$contents  = '' ;
$contents .= '<tr><td colspan="2"><div class="shift-buttom"><span class="shift-left">'.$file_subject.' </span></div></td></tr>';
$contents .= '<tr><td colspan="2"><table width="100%"><tr><td align="left">पंजी क्रमांक '.$panji_krmank.'/21-क(स्था.), </td><td align="right"> दिनांक '.$file_mark_section_date.'</td></tr></table></td></tr>';
$contents .= '<tr><td align="center" colspan="2" > ----------------------------------------------------------</td></tr>';
$contents .= '<tr><td align="left" colspan="2"><p class="shift-left text-justify">  कृृपया विचाराधीन आवेदन का अवलोकन हो। </p></td></tr>';
$contents .= '<tr><td align="left" colspan="2"><p class="shift-left text-justify"> ';
if($is_genrate == true){
	$contents .= $post_data['employee_name'];
}else
{
$contents  .= "<input type='text' name='employee_name' class='employee_name' value='".$pay_emp_name."' > ";	
}
$contents .= ',';
if($is_genrate == true){
	$contents .= $post_data['employee_designation'];
}else
{
$contents  .= "<input type='text' name='employee_designation' class='employee_designation' value='".$pay_emp_designation."' > ";	
}
$contents .= ' ने आवेदन प्रस्तुत कर सामान्य भविष्य निधि खाता क्र. ';
if($is_genrate == true){
	$contents .= $post_data['employee_ac_no'];
}else
{
$contents  .= "<input type='text' name='employee_ac_no' class='employee_ac_no'  value='".$pay_account_no."' > ";	
}
$contents .= ' में से रूपये ';
if($is_genrate == true){
	$contents .= $post_data['temp_gpf_amt'];
}else
{
$contents  .= "<input type='text' name='temp_gpf_amt' class='temp_gpf_amt'  value='".$applied_amount_adv."' > ";	
}
$contents .= '/- (<span class="temp_gpf_amt_span">'.$applied_amount_adv_words.'</span>) का   '.$est_category.' चाहा है। </p></td></tr>';
$contents .= '<tr><td align="left" colspan="2"><p class="shift-left text-justify">आवेदक के सा.भ.नि.  लेखा पर्ची में वर्ष '.date('Y',strtotime("-2 year")).'-'.date('y',strtotime("-1 year")).' में  ';
if($is_genrate == true){
	$contents .= $post_data['debit_amount'];
}else
{
$contents  .= "<input type='text' name='debit_amount' class='debit_amount' value='".$pay_pre_amount."' > ";
}
$contents .= ' जमा हैं। </p></td></tr>';


$contents .= ' <tr><td align="left" colspan="2"><p class="shift-left text-justify"> सा.भ.नि. नियम ';
if($is_genrate == true){
    $contents .= $post_data['rules'];
}else
{
    $contents  .= "<input type='text' name='rules' class='rules' > ";
}
$contents .= ' के अनुसार जमा राशि का  '.$pay_percentage.'  प्रतिशत तक '.$est_category.' का प्रावधान है। </p></td></tr>';


$contents .= '<tr><td align="left" colspan="2"><p class="shift-left text-justify">पूर्व स्वीकृत दिनांक ';
if($is_genrate == true){
	$contents .= $post_data['accepted_date'];
}else
{
$contents  .= "<input type='text' name='accepted_date' class='accepted_date date1' > ";	
}
$contents .= ' को रूपये ';
if($is_genrate == true){
	$contents .= $post_data['year_debit_amt'];
}else
{
$contents  .= "<input type='text' name='year_debit_amt' class='year_debit_amt' value='' > ";
}
$contents .= '/- एवं दिनांक ';
if($is_genrate == true){
	$contents .= $post_data['previous_accept_date'];
}else
{
$contents  .= "<input type='text' name='previous_accept_date' class='previous_accept_date date1' > ";
}
$contents .= ' को रूपये ';
if($is_genrate == true){
	$contents .= $post_data['previous_accept_amt'];
}else
{
$contents  .= "<input type='text' name='previous_accept_amt' class='previous_accept_amt' > ";
}
$contents .= '/- मात्र का आंशिक अग्रिम प्रत्याहरण का समायोजन कर शेष राशि रूपये ';
if($is_genrate == true){
	$contents .= $post_data['remaing_amount'];
}else
{
$contents  .= "<input type='text' name='remaing_amount' class='remaing_amount' value='$remaning_amount'> ";
}
$contents .= '/- मात्र में से चाही राशि रूपये ';
if($is_genrate == true){
	$contents .= $post_data['temp_gpf_amt'];
}else
{
$contents  .= "<input type='text' name='temp_gpf_amt' class='temp_gpf_amt' id='temp_gpf_amt' value='".$applied_amount_adv."' > ";
}
//$contents .= '<b>'.$applied_amount_adv ;
$contents .= '/-('.$applied_amount_adv_words.') </b> मात्र स्वीकृति हेतु प्रस्तुत है।</p></td></tr>';
$contents .= '<tr><td align="left" colspan="2"><p class="shift-left text-justify">जिसकी वसूली ';
if($is_genrate == true){
	$contents .= $post_data['kist_month'];
}else
{
$contents  .= "<input type='text' name='kist_month' class='kist_month' id='kist_month' value='' >";
}
$contents .= ' माह से किश्तों में माह जून, '.date('Y').' पेड जुलाई, '.date('Y').' प्रतिमाह राशि रूपये ';
if($is_genrate == true){
	$contents .= $post_data['every_month_amount'];
}else
{
$contents  .= "<input type='text' name='every_month_amount' class='every_month_amount' id='every_month_amount'  > ";
}
$contents .= '/- से की जाएगी।</p></td></tr>';
//$contents .= '<tr><td align="left" colspan="2"><p class="shift-left text-justify">लेखापाल परीक्षण कर प्रस्तुत करें।</p></td></tr>';
//$contents .= '<tr><td align="left" colspan="2"><p class="shift-left text-justify">आवेदक के सा.भ.नि. खाते में वर्ष '.date('Y',strtotime("-2 year")).'-'.date('y',strtotime("-1 year")).' में शेष जमा राशि ';

//$contents .= '/- में से राशि रूपये ';
//if($is_genrate == true){
//	$contents .= $post_data['temp_gpf_amt'];
//}else
//{
//$contents  .= "<input type='text' name='temp_gpf_amt' class='temp_gpf_amt' > ";
//}
//$contents .= '/-(तीस हजार) का अस्थायी अग्रिम चाहा है जो जमा राशि के 25 प्रतिशत से कम है।</p></td></tr>';
//$contents .= '<tr><td align="left" colspan="2"><p class="shift-left text-justify">सा.भ.नि. नियम 15-ए(क) के अनुसार अभिदाता बिना कारण बताये अस्थायी अग्रिम वर्ष में दो बार प्राप्त कर सकता है।</p></td></tr>';
//$contents .= '<tr><td align="left" colspan="2"><p class="shift-left text-justify">अतः आवेदक को राशि रूपये ';
//if($is_genrate == true){
//	$contents .= $post_data['temp_gpf_amt'];
//}else
//{
//$contents  .= "<input type='text' name='temp_gpf_amt' class='temp_gpf_amt' value='".$applied_amount_adv."' > ";
//}

//$contents .= '/-( <span class="temp_gpf_amt"></span>) मात्र स्वीकृत किया जा सकता है।</p></td></tr>';
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