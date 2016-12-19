<?php
$contents  = '' ;
$contents .= '<tr><td colspan="2"><div class=""><span class="shift-left">';
if($is_genrate == true){
    $contents .= $post_data['fule'];
}else{
    $contents .= '<select name="fule" ><option>पेट्रोल</option><option>डीजल</option></select>';
}
$contents .= ' देयक के भुगतान के संबंध में। शासकीय वाहन क्रमांक ';
if($is_genrate == true){
    $contents .= $post_data['vicle_no'];
}else{
    $contents .= '<input type="text" name="vicle_no" value="एम पी 02 "  placeholder=" वाहन क्रमांक"  >';
}
$contents .= '(माह ';
if($is_genrate == true){
    $contents .= $post_data['month'];
}else{
    $contents .= get_month('month');
}

$contents .= '),';
if($is_genrate == true){
    $contents .= $post_data['year'];
}else{
    $contents .= '<input type="text" name="year" value="2016"  >';
}
$contents .='  </span></div></td></tr>';
$contents .= '<tr><td colspan="2"><table width="100%"><tr><td align="left">पंजी क्रमांक '.$panji_krmank.'/21-क(स्था.), </td>
<td align="right"> दिनांक '.$file_mark_section_date.'</td></tr></table></td></tr>';
$contents .= '<tr><td align="center" colspan="2" > ----------------------------------------------------------</td></tr>';
 $contents .= '<tr><td align="left" colspan="2"><p class="shift-left text-justify">कृपया विचाराधीन टीप एवं साथ में संलग्न प्रमाण-पत्र का अवलोकन करना चाहेंगे।';
 
$contents .= '  </td></tr>'; 
$contents .= '<tr><td colspan="2"><p class="text-justify shift-left" >';
if($is_genrate == true){
	$contents .= get_employee_designation_id($this->input->post('emp_name'), '',  false);
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
$contents .= ' की टीप अनुसार शासकीय वाहन क्रमांक ';
if($is_genrate == true){
    $contents .= $post_data['vicle_no1'];
}else{
    $contents .= '<input type="text" name="vicle_no1" value="एम पी 02  " placeholder=" वाहन क्रमांक"  >';
}
$contents .= ' में माह ';
$contents .= '(माह ';
if($is_genrate == true){
    $contents .= $post_data['month'];
}else{
    $contents .= get_month('month');
}

$contents .= '), '.date('Y');
$contents .= ' में रूपये   ';
if($is_genrate == true){
    $contents .= $post_data['amount'];
}else{
    $contents .= '<input type="text" name="amount"  >';
}
$contents .= ' के हिसाब से ';
if($is_genrate == true){
    $contents .= $post_data['fule_quantity'];
}else{
    $contents .= '<input type="text" name="fule_quantity"  >';
}
 $contents .= ' लीटर पेेट्रोल रूपये ';
if($is_genrate == true){
    $contents .= $post_data['amount'];
}else{
    $contents .= '<input type="text" name="amount"  >';
}
 $contents .= ' का व्यय किया गया। जिसका भुगतान ';
if($is_genrate == true){
	$contents .= get_employee_designation_id($this->input->post('other_emp_name'), '',  false);
}
else{
$contents .= get_all_employee_ddllist('other_emp_name' ,'');
}
$contents .= ', ';
if($is_genrate == true){
$contents .=   get_employee_designation_id($this->input->post('other_emp_name')); 
}
else{
$contents .= '----' ;
} 
$contents .= ' विधि द्वारा किया गया है। अतः नियमानुसार किये गये व्यय की प्रतिपूर्ति करायी जाये।</p><br/></td></tr>';
$contents .= '<tr><td colspan="2"><p class="text-justify shift-left" >परिवहन विभाग के ज्ञापन क्रमांक ';
if($is_genrate == true){
    $contents .= $post_data['gyapan_no'];
}else{
    $contents .= '<input type="text" name="gyapan_no"  >';
}
$contents .= '/ दिनांक ';
if($is_genrate == true){
    $contents .= $post_data['gyapan_date'];
}else{
    $contents .= '<input type="text" name="gyapan_date" class="date1" >';
}
$contents .= ' के अनुसार शासकीय अधिकारियों को प्रतिमाह ';
if($is_genrate == true){
    $contents .= $post_data['fule_quantity'];
}else{
    $contents .= '<input type="text" name="fule_quantity"  >';
}
$contents .= ' लीटर पेट्रोल व्यय की पात्रता है।</p><br/></td></tr>';
$contents .= '<tr><td colspan="2"><p class="text-justify shift-left" >मांग संख्या';
if($is_genrate == true){
    $contents .= $post_data['mang'];
}else{
    $contents .= '<input type="text" name="mang" value="-29-2052-" >';
}
$contents .='सचिवालय सामान्य सेवाएं-(-';

if($is_genrate == true){
    $contents .= $post_data['mang1'];
}else{
    $contents .= '<input type="text" name="mang1" value="090" >';
}
$contents .=') सचिवालय योजना-(';
if($is_genrate == true){
    $contents .= $post_data['mang2'];
}else{
    $contents .= '<input type="text" name="mang2" value="9057" >';
}
$contents .='-विधि एवं विधायी कार्य की ';
if($is_genrate == true){
    $contents .= $post_data['mang3'];
}else{
    $contents .= '<input type="text" name="mang3" style="width: 250px;" value="मद-22-कार्यालय व्यय-(009)-पेट्रोल,  तेल " >';
}
$contents .='आदि में वित्तीय वर्ष ';
if($is_genrate == true){
    $contents .= $post_data['fyear'];
}else{
    $contents .= '<input type="text" name="fyear" value="2016-17 " >';
}
$contents .=' हेतु प्राप्त आवंटन में से विकलनीय होगा। ';

$contents .= '</p><br/></td></tr>';
$contents .= '<tr><td colspan="2"><p class="text-justify shift-left" >अतः माह ';
if($is_genrate == true){
    $contents .= $post_data['month'];
}else{
    $contents .= get_month('month');
}
$contents .= ', ';
if($is_genrate == true){
    $contents .= $post_data['year1'];
}else{
    $contents .= '<input type="text" name="year1" value="2016"  >';
}
'$contents .=  में ';
if($is_genrate == true){
    $contents .= $post_data['fule_quantity1'];
}else{
    $contents .= '<input type="text" name="fule_quantity1"  >';
}
$contents .= ' लीटर पेट्रोल की राशि रूपये  ';
if($is_genrate == true){
    $contents .= $post_data['gyapan_no'];
}else{
    $contents .= '<input type="text" name="gyapan_no"  >';
}
$contents .= '(रूपये <span class="amount_in_word"></span>) स्वीकृत किया जाना उचित होगा।</p><br/></td></tr>';


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



