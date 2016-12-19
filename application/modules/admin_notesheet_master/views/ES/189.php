<?php
$contents  = '' ;
$contents .= '<tr><td colspan="2"><div class=""><span class="shift-left">शासकीय आवास आधिपत्य में रखे जाने बावत् ।</span></div></td></tr>';
$contents .= '<tr><td colspan="2"><table width="100%"><tr><td align="left">पंजी क्रमांक '.$panji_krmank.'/21-क(स्था.), </td><td align="right"> दिनांक '.$file_mark_section_date.'</td></tr></table></td></tr>';
$contents .= '<tr><td align="center" colspan="2" > ----------------------------------------------------------</td></tr>';
 $contents .= '<tr><td align="left" colspan="2"><p class="shift-left text-justify"> ';
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
 $contents .= ' द्वारा माननीय उच्च न्यायालय  के आदेश दिनांक ';
 if($is_genrate == true){
	 $contents .= $post_data['start_date'];
}else{
	$contents .= '<input name="start_date" class="date1"  type="text"  />';
}
   $contents .= '  के संबंध में';
   
   $contents .= '<tr><td align="center" colspan="2" >';
   if($is_genrate == true){
	$contents .= $post_data['textfield1'];
}else
{
$contents .= '<textarea name="textfield1" cols="80" rows="5"></textarea>';
}
   $contents .=  ' </td></tr>';

?>
<style>
.shift-left{ margin-left:10%;}
.shift-top{ margin-top:20px; }
.shift-left{ text-indent:50px }
</style>



