<style>
p{
	line-height:24px;
}
</style>
<?php 
$contents  = '<table style="font-size:14px;  width:90%; margin:0% auto;">' ;
$contents .= '<tr><td width="20%" style="border-right:1px solid" valign="top"> <div style="margin-top:20%"> <h4 class="text-center">नेमी टीप </h4><div align="center">( केवल ऐसी टीपों आदि के लिये उपयोग में लाया जाये जो स्थायी अभिलेख के लियें न हों)</div> </div></td><td  width="80%" align="center" ><table width="100%" ><tr><td align="center"><u>फा0क्र0 3(ए) /';
if($is_genrate == true){ 
    $contents .=  $post_data['number'];
} else {
    $contents .= '<input type="text" class="" name="number"  value=""/>';
}
$contents .= '/'.date("Y").'/'.$file_number.'/21-'.get_section_code($this->session->userdata('emp_section_id')) .' </u></td></tr>';

$contents .= '<tr><td>विषय : - '.$file_subject.'</td></tr>';
$contents .= '<tr><td align="center">............</td></tr>';
$contents .= '<tr><td>';
if($is_genrate == true){

$contents .= $post_data['compose_textarea'];
}else {
	
$contents .= '<textarea id="compose_textarea" name="compose_textarea" ></textarea>';
}
$contents .= '</td></tr>';
$contents .= '<tr><td align="right"><div id="name_of_officer" class="officer-center" >  ';
if($is_genrate == true){	 
	$contents .= get_officer_information($this->input->post('sing_user')); 
}else{
	$contents .= get_officer_for_sign('sing_user' ,array(7,8) ,'', $us_id);
}
$contents .='</div></td></tr>';
$contents .= '<tr><td align="right"><div id="section_name" class="officer-center" > ( ';
$contents .= getSection( $this->session->userdata('emp_section_id') ,'' , 'hindi');

$contents .=' ) </div></td></tr>';
$contents .= '<tr><td align="right"></td></tr>';


$contents .= '<tr><td align="left"><div>';
if($is_genrate == true){ 
}
else{
$contents .= '<select name="nemee_teep_option" id="nemee_teep_option"><option> --चयन करें-- </option><option>अनुभाग</option><option>मंत्री</option><option>मंत्रालय</option></select>';
}
$contents .= '</div></td></tr>';
$contents .= '<tr><td>';
if($is_genrate == true && count($post_data['section_name']) != 0 ){
	$contents .= '<div class="section_names_c" ><ul>';
}
else{
$contents .= '<div class="section_names_c" style="display:none"><ul>';
}
  $section_list = get_list(SECTIONS,null,null);
$sec_arr = array();

if($is_genrate == true && count($post_data['section_name']) != 0 ) {
	
	foreach($post_data['section_name'] as $sname ){
	//	pre($sname);
		$contents .= "<li style='list-style:none'><label class='checkbox'>". $sname."</label></li>";
	}
//$contents .= $sec_arr;
}
else{
	foreach( $section_list as $sections )
	{
		$contents .= "<li style='list-style:none'><label class='checkbox'><input type='checkbox' class='section_name_c' name='section_name[]' value='".$sections['section_name_hi']."' > ".$sections['section_name_hi'] ."</label></li>";
	}
}
$contents .= '</ul></div>';


if($is_genrate == true && $post_data['sectory']){ 
$contents .=   '<div class="sectary_div" >' .$post_data['sectory'];
} else {

 $contents .=  '<div class="sectary_div" style="display:none"><select name="sectory" id="sectory"><option value=""> --चयन करें-- </option><option value="सचिव">सचिव </option><option value="अवर सचिव">अवर सचिव </option></select>';
}
$contents .= '</div>';
if($is_genrate == true && !empty($post_data['respect']) ){ 
$contents .= '<div class="res_minister_div" >माननीय मंत्री ';
}
else{
	$contents .= '<div class="res_minister_div" style="display:none">माननीय मंत्री <input type="hidden" name="respect"  id="respect" value="" >';
}
$contents .= '</div>';

if($is_genrate == true){ 
    $contents .=  '<div class="department_div" >'.$post_data['department_na'];
} else {
    $contents .= '<div class="department_div" style="display:none">'.get_department_ddl_list('department_na');
}
$contents .= '</div>';

if($is_genrate == true){ 
    $contents .= '<div class="address_div"  >'. $post_data['address'];
} else {
    $contents .= '<div class="address_div"  style="display:none"><textarea id="address" name="address" ></textarea>';
}
$contents .= '</div>';
if($is_genrate == true && !empty($post_data['ministry'])){ 
	
$contents .= '<div class="mantraly_div" >मंत्रालय , भोपाल </div>';
}else{
	
$contents .= '<div class="mantraly_div" style="display:none">मंत्रालय , भोपाल <input type="hidden" name="ministry" value="" ></div>';
}
$contents .= '</td></tr>';
$contents .= '</td></tr></table>';
$contents .= '</table>';

