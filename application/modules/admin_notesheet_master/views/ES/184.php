<?php
$contents  = '' ;
$contents .= '<tr><td colspan="2"><div class="shift-buttom"><span class="shift-left">  टेलीविजन क्रय की सूचना बावत् । </span></div></td></tr>';
$contents .= '<tr><td colspan="2"><table width="100%"><tr><td align="left">पंजी क्रमांक '.$panji_krmank.'/21-क(स्था.), </td><td align="right"> दिनांक '.$file_mark_section_date.'</td></tr></table></td></tr>';
$contents .= '<tr><td align="center" colspan="2" > ----------------------------------------------------------</td></tr>';
$contents .= '<tr><td align="left" colspan="2"><p class="shift-left text-justify">  कृपया विचाराधीन पत्र का  अवलोकन करने का कष्ट करें । </td></tr>'; 
$contents .= '<tr><td colspan="2"><p class="text-justify shift-left" >';
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
$contents .= ' द्वारा सतगुरु एजेंसी, इतवारा रोड,भोपाल से सेमसंग टेलीविजन(एल.ई.डी.) राशि रुपये ';
 if($is_genrate == true){
	 $contents .=  $post_data['amount'];
}
else{
$contents .= '<input name="amount"  type="text"  />';
}
$contents .= ' /- क्रय  सूचना दी गई है  । </p><br/></td></tr>';
$contents .= '<tr><td colspan="2"><p class="text-justify shift-left" >   अवलोकन प्रस्तुत।   </p><br/></td></tr>';
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



