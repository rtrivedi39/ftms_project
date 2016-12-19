<?php
$contents  = '' ;
$contents .= '<tr><td colspan="2"><div class="shift-buttom"><span class="shift-left">'.$file_subject.' </span></div></td></tr>';
$contents .= '<tr><td colspan="2"><table width="100%"><tr><td align="left">पंजी क्रमांक '.$panji_krmank.'/21-क(स्था.), </td><td align="right"> दिनांक '.$file_mark_section_date.'</td></tr></table></td></tr>';
$contents .= '<tr><td align="center" colspan="2" > ----------------------------------------------------------</td></tr>';
$contents .= '<tr><td align="left" colspan="2"><p class="shift-left text-justify"> उक्‍त विषयक वेल्‍टोनिक्‍स इंडिया प्रायवेट लिमिटेड, इंदौर से पत्र प्राप्‍त हुआ है, जिसमें उनके द्वारा निवेदन किया गया है कि उनके द्वारा प्रदाय किये गये दो नग कम्‍प्‍युटर्स के देयक की राशि रूपये ';
if($is_genrate == true){
	$contents .= $_POST['amount'];
}else
{
$contents  .= '<input type="text" name="amount" >';	
}
$contents  .= ' का वेट टेक्‍स प्रपत्र प्रदाय करने का कष्‍ट करें ।';
$contents .= '</p></td></tr>';
$contents .= '<tr><td align="left" colspan="2"><p class="shift-left text-justify"> वेल्‍टोनिक्स इंडिया प्रायवेट लिमिटेड को देयक क्रमांक 85 दिनांक ';
if($is_genrate == true){
	$contents .= $_POST['date'];
}else
{
$contents  .= '<input type="text" name="date" value="8-7-16" class="date1">';	
}
$contents  .= ' द्वारा उक्‍त राशि का भुगतान किया जा चुका है । ';
$contents .= '</p></td></tr>';
$contents .= '<tr><td align="left" colspan="2"><p class="shift-left text-justify"> अत: देयक राशि रूपये ';
if($is_genrate == true){
	$contents .= $_POST['amount'];
}else
{
$contents  .= '<input type="text" name="amount" >';	
}
$contents  .= ' में से वेट टेक्‍स कटोत्री  राशि रूपये 545.00 का संबंधित फर्म को वेट टेक्‍स प्रमाण पत्र प्रदाय किया जाना उचित होगा । यदि मान्‍य  हो तो वेट टेक्‍स प्रपत्र हस्‍ताक्षार्थ प्रस्‍तुत है।';

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



