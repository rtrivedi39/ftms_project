<?php
$contents  = '' ;
$contents .= '<tr><td colspan="2"><div class=""><span class="shift-left">  सामान्य भविष्य निधि लेखा क्रमांक ';
if($is_genrate == true){
	 $contents .= $post_data['mobile_bill_amount'];
}else{
	$contents .= '<input name="mobile_bill_amount"  type="text"  />';
}
$contents .=' के संबंध में ।  </span></div></td></tr>';
$contents .= '<tr><td colspan="2"><table width="100%"><tr><td align="left">पंजी क्रमांक '.$panji_krmank.'/21-क(स्था.), </td><td align="right"> दिनांक '.$file_mark_section_date.'</td></tr></table></td></tr>';
$contents .= '<tr><td align="center" colspan="2" > ----------------------------------------------------------</td></tr>';
$contents .= '<tr><td align="left" colspan="2"><p class="shift-left text-justify">   उक्त विषयांर्गत ';
if($is_genrate == true){
	$contents .= get_employee_name($this->input->post('emp_name') , '');// get_officer_information();
}
else{
$contents .= get_all_employee_ddllist('emp_name' ,'');
}


$contents .= ' , सेवानिवृत्त, ';
if($is_genrate == true){
$contents .=   get_employee_designation_id($this->input->post('emp_name')); 
}
else{
$contents .= '----' ;
} 
 $contents .= ',  जो पूर्व में विधि विभाग भोपाल में पदस्थ थे, ने आवेदन प्रस्तुत निवेदन किया है कि-कार्यालय महालेखाकार (लेखा एवं हकदारी) ';
 if($is_genrate == true){
	 $contents .= $post_data['state_list'];
}else
{
       $contents  .= get_distic_dd('state_list');
}
$contents .= ' द्वारा लेख किया है कि अंतिम भुगतान प्रकरण में ब्याज की गणना में 3/89 में शामिल आहरण राशि रुपये ';
if($is_genrate == true){
    $contents .= $post_data['amount_spend'];
}else{
	$contents .= '<input name="amount_spend" class="amount_spend"  type="text"  />';
}
$contents .= ' /- विभाग द्वारा जारी आंशिक अंतिम आहरण सूची में शामिल किया गया है ।  </p></td></tr>'; 
 $contents .= '<tr><td colspan="2"><p class="text-justify shift-left" >  उनके द्वारा उक्त आहरण सामान्य भविष्य निधि खाते से संबंधित है अथवा नहीं ? इस संबंध में पुष्टि किये जाने हेतु विधि विभाग भोपाल से प्रमाण पत्र सहित सत्यापित रोकड लेखा की छायाप्रति विधि विभाग ';
  if($is_genrate == true){
	 $contents .= $post_data['state_list'];
}else
{
       $contents  .= get_distic_dd('state_list');
}
$contents .= '  भेजते हुये उसकी एक प्रति उनको भी दिये जाने का निवेदन  किया गया है । </p><br/></td></tr>';
$contents .= '<tr><td colspan="2"><p class="text-justify shift-left" >  उक्त संबंध में लेख है कि विधि विभाग के अभिलेख के अनुसार आहरण राशि रुपये <span class="amount_spend">----</span>/- अध्यक्ष अभिभाषक संघ दतिया को भुगतान की गई, जिसकी पुष्ठि हेतु सत्यापित रोकड लेखा की छायाप्रति नस्ती पर उपलब्ध है । नस्ती अग्रिम कार्यवाही हेतु संबंधित लिपिक को अंकित की जाना उचित होगा।  </p><br/></td></tr>';
if($this->uri->segment(6) == 'p' || $this->uri->segment(7) == 'p'  ){
$contents .= '<tr><td colspan="2"><div><u>अनुभाग अधिकारी (स्था) </u> </div><br/><br/><br/></td></tr>';
$contents .= '<tr><td colspan="2"><div><u>अवर सचिव </u> </div><br/><br/><br/></td></tr>';
}
$contents .= '<tr><td colspan="2"><br /><br/><br/><div  style="text-align:justify" ></div><br/></td></tr>';

?>
<style>
.shift-left{ margin-left:10%;}
.shift-top{ margin-top:20px; }
.shift-left{ text-indent:50px }
</style>



