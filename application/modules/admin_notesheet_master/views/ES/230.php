<?php
$contents  = '' ;
$contents .= '<tr><td colspan="2"><div class="shift-buttom"><span class="shift-left">'.$file_subject.' </span></div></td></tr>';
$contents .= '<tr><td colspan="2"><table width="100%"><tr><td align="left">पंजी क्रमांक '.$panji_krmank.'/21-क(स्था.), </td><td align="right"> दिनांक '.$file_mark_section_date.'</td></tr></table></td></tr>';
$contents .= '<tr><td align="center" colspan="2" > ----------------------------------------------------------</td></tr>';
$contents .= '<tr><td align="left" colspan="2"><p class="shift-left text-justify"> म0प्र0 उपभोक्‍ता संघ मर्यादित भोपाल से पत्र प्राप्‍त हुआ है, जिसमें उनके  द्वारा प्रदाय की गई बरसाती हेतु वेटटेक्‍स प्रपत्र प्रदाय करने का निवेदन किया गया है। ';
$contents .= '</p></td></tr>';
$contents .= '<tr><td align="left" colspan="2"><p class="shift-left text-justify"> म0प्र0 उपभोक्‍ता संघ को उक्‍त राशि का भुगतान देयक क्रमांक ';
if($is_genrate == true){
	$contents .= $_POST['bill_no'];
}else
{
$contents  .= '<input type="text" name="bill_no" value="268" >';	
}
$contents .= 'दिनांक ';
if($is_genrate == true){
	$contents .= $_POST['date'];
}else
{
$contents  .= '<input type="text" name="date" value="8-7-16" class="date1">';	
}
$contents .= ' द्वारा किया जा चुका है ।';
$contents .= '</p></td></tr>';
$contents .= '<tr><td align="left" colspan="2"><p class="shift-left text-justify"> अत: राशि रूपये ';
if($is_genrate == true){
	$contents .= $_POST['amount'];
}else
{
$contents  .= '<input type="text" name="amount" >';	
}
$contents  .= '/ में से राशि रूपये ';
if($is_genrate == true){
	$contents .= $_POST['deduct_amount'];
}else
{
$contents  .= '<input type="text" name="deduct_amount" >';	
}
$contents  .= '/ का कटौत्रा राशि का संबंंधित फर्म को  वेट टेक्‍स प्रपत्र प्रदाय किये जाने  हेतु वेट टेक्‍स प्रपत्र हस्‍ताक्षार्थ  है। ';
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



