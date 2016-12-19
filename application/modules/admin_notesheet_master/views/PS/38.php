<?php 
$contents  = '' ;
$contents .= '<tr><td> <div style="margin-top:20px;"><span style="margin-left:10%;">प्रकरण वापसी '.@$file_subject.'</span></div></td></tr>';
$contents .= '<tr><td align="center">------0-------</td></tr>';
$contents .= '<tr><td><div style="float:left"><u>पंजी क्र0 '.$file_number.'/'.date("Y").'/21-क(अभि )</div><div style="float:right">दिनांक   ';
if($is_genrate == true){
$contents .= $post_data['date1'];
}else
{
	$contents .=  '<input type="text" class="date1" name="date1" value="'.date('d-m-Y').'" placeholder="dd/mm/yyyy" />';
}
$contents .= '</u></div></td></tr>';
$contents .= '<tr><td><u> गृह विभाग का यू.ओ.क्र '.@$file_uo_or_letter_no.' दिनांक '.date( 'd-m-Y', strtotime( $file_uo_or_letter_date)).'</u></td></tr>';
$contents .= '<tr><td align="center">------0-------</td></tr>';


$contents .= '<tr><td><p>कृपया प्रशासकीय विभाग की टीप दिनांक ';
 if($is_genrate == true){
$contents .= $post_data['teep_date1'];
}else
{
	$contents .=  '<input type="text" class="date1" name="teep_date1" value="'.date('d-m-Y').'" placeholder="dd/mm/yyyy" />';
}
$contents .=  ' का अवलोकन करने का कष्ट  करें। </p></td></tr>';
$contents .= '<tr><td><p>प्रशासकीय विभाग ने निम्नलिखित अपराध क्रमांक ';
 if($is_genrate == true){
$contents .= $post_data['crime_no'];
}else
{
	$contents .=  '<input type="text"  name="crime_no" />';
}
$contents .= ' के वापसी हेतु इस विभाग का मत चाहा है  कि-:-</td></tr>';
$contents .= '<tr><td><p>पुलिस थाना ';
 if($is_genrate == true){
$contents .= $post_data['police_station'];
}else
{
	$contents .=  '<input type="text"  name="police_station" />';
} 
$contents .=  ' जिला ';
 if($is_genrate == true){
$contents .= $post_data['state_1'];
}else
{
	$contents .=  get_distic_dd('state_1'); 
} 
$contents .=  ' अप0 क्र0 ';

 if($is_genrate == true){
$contents .= $post_data['crime_no'];
}else
{
	$contents .=  '-------';
} 
$contents .=  ' ( प्रक.  क्र.)  ';

 if($is_genrate == true){
$contents .= $post_data['pr_no'];
}else
{
	$contents .=  '<input type="text"  name="pr_no" />';
} 
$contents .=  ' अभियुक्तगण   ';
 if($is_genrate == true){
$contents .= $post_data['crimnal'];
}else
{
	$contents .=  '<input type="text"  name="crimnal" />';
}
$contents .=  ' के विरूदध  धारा   ';
 if($is_genrate == true){
$contents .= $post_data['dhara_1'];
}else
{
	$contents .=  '<input type="text"  name="dhara_1" />';
}
$contents .=  ' के अंतर्गत   ';
 if($is_genrate == true){
$contents .= $post_data['according'];
}else
{
	$contents .=  '<input type="text"  name="according" />';
}
$contents .=  ' न्यायालय में लंबित है।  ';
$contents .=  '</p></td></tr>';

$contents .= '<tr><td><p>प्रकरण से संबंधित संक्षिप्त विवरण पत्र व्यवहार एवं केस डायरी नीचे अवलोकनार्थ प्रस्तुत है। </p></td></tr>';
$contents .= '<tr><td><p>पुलिस अधीक्षक ';
if($is_genrate == true){
	$contents .= $post_data['distic_1'];
}else
{
$contents  .= get_distic_dd('distic_1');	
}
$contents .=  ' ,जिला दंडाधिकारी ';
if($is_genrate == true){
	$contents .= ' '.$post_data['distic_1'];
}else
{
$contents  .= ' --------';	
}
$contents .= ' ने प्रकरण का निराकरण न्यायालय से ';
if($is_genrate == true){
	$contents .= $post_data['option_jana'];
}else
{
	$contents .=  '<select name="option_jana"><option>कराया </option><option>वापस लिया </option></select>';
} 
$contents .=  ' जाना उचित बताया है। 
</td></tr>';
$contents .= '<tr><td><p>प्रकरण परीक्षण एवं उचित मतार्थ हेतु  प्रस्तुत है। </p>
</td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
if($this->uri->segment(6) == 'p' || $this->uri->segment(7) == 'p'){
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td align="left"><div style="width:35%; text-align:center;"></div></td></tr>';
$contents .= '<tr><td>&nbsp; </td></tr>';
$contents .= '<tr><td><u>अनुभाग अधिकारी (अभि0) </u></td></tr>';
$contents .= '<tr><td>&nbsp; </td></tr>';
$contents .= '<tr><td><u>अवर सचिव  (अभि0) </u></td></tr>';
$contents .= '<tr><td>&nbsp; </td></tr>';
$contents .= '<tr><td><u>अतिरिक्त सचिव  (अभि0) </u></td></tr>';
}
//print content
//echo $contents;
?>   

