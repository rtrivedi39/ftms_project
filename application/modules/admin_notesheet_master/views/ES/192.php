<?php
$contents  = '' ;
$contents .= '<tr><td colspan="2"><div class=""><span class="shift-left">कार क्रय की अनुमति दिये जाने  बावत्-  ';

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
$contents .= ' ।</span></div></td></tr>';
$contents .= '<tr><td colspan="2"><table width="100%"><tr><td align="left">पंजी क्रमांक '.$panji_krmank.'/21-क(आप.), </td><td align="right"> दिनांक '.$file_mark_section_date.'</td></tr></table></td></tr>';
$contents .= '<tr><td align="center" colspan="2" > ----------------------------------------------------------</td></tr>';
$contents .= '<tr><td align="left" colspan="2"><p class="shift-left text-justify">कृपया पुस्तकालय शाखा की टीप ';
if($is_genrate == true){
    $contents .= $post_data['start_date'];
}else{
	$contents .= '<input name="start_date" class="date1"  type="text"  />';
}
$contents .= ' का अवलोकन करने का कष्ट करें ।  </td></tr>'; 
 $contents .= '<tr><td colspan="2"><p class="text-justify shift-left" > पूर्व पृष्ठ अनुसार ';
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
 $contents .= ' को अति0 सचिव महोदय के निर्देशानुसार वाहन क्रय के संबंध में विस्तृत जानकारी देने हेतु अवगत कराया गया था, जिसके पालन में  ';
if($is_genrate == true){
	$contents .= get_employee_name($this->input->post('emp_name') , '');// get_officer_information();
}
else{
$contents .= get_all_employee_ddllist('emp_name' ,'');
}
$contents .= 'द्वारा अवगत कराया गया है कि कार (ठम्।ज्)  की अनुमानित कीमत लगभग रुपये  ';
 if($is_genrate == true){
	 $contents .=  $post_data['approx_amount'];
}
else{
$contents .= '<input name="approx_amount"  type="text"  />';
}
$contents .= ' है, ससुर एवं पति की बचत से राशि रुपये  ';
 if($is_genrate == true){
	 $contents .=  $post_data['saving_amount'];
}
else{
$contents .= '<input name="saving_amount"  type="text"  />';
}
'/- (<span class="amount_word"> ---- </span>) एवं शेष राशि रुपये ';
 if($is_genrate == true){
	 $contents .=  $post_data['remaing_amount'];
}
else{
$contents .= '<input name="remaing_amount"  type="text"  />';
}
 $contents .= '/- (<span class="amount_word"> ---- </span>)';
 if($is_genrate == true){
	 $contents .=  $post_data['finance_bank'];
}
else{
$contents .= '<input name="finance_bank"  type="text"  />';
 }
$contents .= ' से लोन लेकर वह कार क्रय करेगी।  </p><br/></td></tr>';
$contents .= '<tr><td colspan="2"><p class="text-justify shift-left" > अवलोकन उपरांत आदेशार्थ प्रस्तुत । </p><br/></td></tr>';


if($this->uri->segment(6) == 'p' || $this->uri->segment(7) == 'p'  ){
$contents .= '<tr><td colspan="2"><div><u>अनुभाग अधिकारी (स्था) </u> </div><br/><br/><br/></td></tr>';
$contents .= '<tr><td colspan="2"><div><u>अवर सचिव </u> </div><br/><br/><br/></td></tr>';
$contents .= '<tr><td colspan="2"><div><u>व0ले0अ0 </u> </div><br/><br/><br/></td></tr>';
}
$contents .= '<tr><td colspan="2"><br /><br/><br/><div  style="text-align:justify" ></div><br/></td></tr>';

?>
<style>
.shift-left{ margin-left:10%;}
.shift-top{ margin-top:20px; }
.shift-left{ text-indent:50px }
</style>



