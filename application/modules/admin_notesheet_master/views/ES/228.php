<?php
$contents  = '' ;
$contents .= '<tr><td colspan="2"><div class="shift-buttom"><span class="shift-left">'.$file_subject.' </span></div></td></tr>';
$contents .= '<tr><td colspan="2"><table width="100%"><tr><td align="left">पंजी क्रमांक '.$panji_krmank.'/21-क(स्था.), </td><td align="right"> दिनांक '.$file_mark_section_date.'</td></tr></table></td></tr>';
$contents .= '<tr><td align="center" colspan="2" > ----------------------------------------------------------</td></tr>';
$contents .= '<tr><td align="left" colspan="2"><p class="shift-left text-justify"> उपरोक्‍त विषयक प्रस्‍तुत आवेदन पत्र का कृपया अवलोकन हो,   माननीय उच्‍च न्‍यायालय जबलपुर के आदेशानुसार ';
if($is_genrate == true){
	$contents .= get_officer_information($this->input->post('employee_name') );
}else
{
$contents  .= get_employee_list('employee_name');	
}
$contents .= ', का  विधि विभाग में ';
if($is_genrate == true){
	$contents .= get_officer_dign($this->input->post('employee_name') );
}else
{
$contents  .= '-------';
}
$contents  .= ' के पद पर स्‍थानांतरण होने के फलस्‍वरूप नियमानुसार स्‍थानांतरण अनुदान की राशि एक माह का मूल वेतन राशि रूपये ';
if($is_genrate == true){
	$contents .= $_POST['amount_pol'];
}else
{
$contents  .= "<input type='text' name='amount_pol' >";
} 
$contents  .= ' (पैंसठ हजार तीन सौ अस्‍सी) मात्र स्‍वीकृत किये जाने हेतु प्रारूप अनुमोदनार्थ प्रस्‍तुत है।';

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



