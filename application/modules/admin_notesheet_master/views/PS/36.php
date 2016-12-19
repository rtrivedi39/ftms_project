<?php 
$contents  = '' ;
$contents .= '<tr><td align="center"><u><h3>'.$dept_name.'</h3></u></td></tr>';
$contents .= '<tr><td><div style="float:left">फा.क्रं. 12/';
if($is_genrate == true){
$contents .= $post_data['file_no'];
}else
{
	$contents .=  '<input type="text" name="file_no" />';
}
$contents .=  '/';
if($is_genrate == true){
$contents .= $post_data['year'];
}else
{
	$contents .=  '<input type="text" name="year" />';
}
$contents .= ' पं.क्रं. '.@$file_number.'/'.date("Y").'/21-क(अभि), </div><div style="float:right">भोपाल, दिनांक   ';
if($is_genrate == true){
$contents .= $post_data['date1'];
}else
{
	$contents .=  '<input type="text" class="date1" name="date1" value="'.date('d-m-Y').'" placeholder="dd/mm/yyyy" />';
}
$contents .= '</div></td></tr>';
$contents .= '<tr><td align="left">प्रति,</td></tr>';
$contents .= '<tr><td align="left"><span style="margin-left:12%">जिला दंडाधिकारी,</span></td></tr>';
$contents .= '<tr><td align="left"><span style="margin-left:12%">';
if($is_genrate == true){
$contents .= $post_data['state_2'];
}else
{
	$contents .=  get_distic_dd('state_2');
}
 $contents .= ' मध्यप्रदेश,</span></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td align="left"><div style="float:left; width:12%;">विषय:- </div> <div style="float:left; width:87%;"> प्रकरण प्रत्याहरण के संबंध में, </div></td></tr>';

$contents .= '<tr><td align="center">------0-------</td></tr>';
$contents .= '<tr><td><p>आरक्षी केन्द्र ';
if($is_genrate == true){ 
    $contents .=  $post_data['address'];
} else {
    $contents .= ' <input type="text" name="address"/>';
}
 $contents .= ' जिला ';
if($is_genrate == true){
$contents .= $post_data['state_22'];
}else
{
	$contents .=  get_distic_dd('state_22');
}
 $contents .= ' के अप.क्रं. ';
if($is_genrate == true){ 
    $contents .=  $post_data['crime_no_1'];
} else {
    $contents .= ' <input type="text" name="crime_no_1"/>';
}
$contents .= ' के आधार पर मध्यप्रदेश शासन विरूद्ध ';
if($is_genrate == true){ 
    $contents .=  $post_data['against'];
} else {
    $contents .= ' <input type="text" name="against"/>';
}
$contents .= ' में धारा ';
if($is_genrate == true){ 
    $contents .=  $post_data['dharano_1'];
} else {
    $contents .= ' <input type="text" name="dharano_1"/>';
}
$contents .= ' भा.द.वि. के अंतर्गत मुख्य न्यायिक दंडाधिकारी,'; 
if($is_genrate == true){ 
    $contents .=  $post_data['state_1'];
} else {
    $contents .=  get_distic_dd('state_1');
}


$contents .= ' के न्यायालय में लंबित है ।</p></td></tr>';
$contents .= '<tr><td><p>उक्त प्रकरण के संबंध में शासन की यह राय है कि इसको आगे चलाया जाना न्याय प्रशासन के हित में नहीं है ।</p></td></tr>';


$contents .= '<tr><td><p>अत: आप संबंधित भारसाधक लोक अभियोजक/सहायक लोक अभियोजक को सलाह दें कि वे लोकहित में अपने स्वविवेक का प्रयोग करते हुए दंड प्रक्रिया संहिता की धारा 321 के उपबंधो के अधीन न्यायालय की अनुमति से उक्त प्रकरण को वापस लेने हेतु आवश्यक कार्यवाही करें ।</p></td></tr>';
$contents .= '<tr><td><p>इस संबंध में की गई कार्यवाही से इस विभाग को तथा गृह विभाग को तत्काल अवगत कराऍ ।</p></td></tr>';
$contents .= '<tr><td align="right">मध्य प्रदेश के राज्यपाल के नाम से तथा आदेशानुसार </td></tr>';
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right" colspan="3"><div class="officer-center">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td colspan="3">&nbsp;</td></tr>';
}

$contents .= '<tr><td colspan="3" align="right"><div  contenteditable="false" class="officer-center">( ';
if($is_genrate == true){
$contents .=  get_officer_information($this->input->post('avar_secetroy')); 

}else
{
     $contents .= get_officer_for_sign('avar_secetroy' ,$uber_sect ,'', $us_id);
    
}

$contents .= ' )</div></td></tr>';
$contents .= '<tr><td colspan="3" align="right"><div  contenteditable="false" class="officer-center">';

if($is_genrate == true){    
    $contents .=   get_officer_dign($this->input->post('avar_secetroy'));
}
else {
     $contents .= '-------';
    }
$contents .= '</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">'.$dept_name.'</div></td></tr>';
$contents .= '<tr><td><div style="float:left">पृ.फा.क्रं. 12/';
if($is_genrate == true){
$contents .= $post_data['file_no'];
}else
{
	$contents .=  '--------';
}
$contents .=  '/';
if($is_genrate == true){
$contents .= $post_data['year'];
}else
{
	$contents .=  '--------';
}
$contents .= 'पं.क्रं.  '.@$file_number.'/'.date("Y").'/21-क(अभि), </div><div style="float:right">भोपाल, दिनांक   ';
if($is_genrate == true){
$contents .= $post_data['date1'];
}else
{
	$contents .=  '<input type="text" class="date1" name="date1" value="'.date('d-m-Y').'" placeholder="dd/mm/yyyy" />';
}
$contents .= '</div></td></tr>';
$contents .= '<tr><td>प्रतिलिपि:-</td></tr>';
$contents .= '<tr><td><div style="width:10%; float:left">1- </div><div style="width:85%; float:left">सचिव, म.प्र. शासन, ';
if($is_genrate == true){
$contents .= $post_data['dept_2'];
}else
{
	$contents .=  '<input type="text"  name="dept_2"  />';
}
$contents .=  ', भोपाल की ओर उनके यू.ओ.क्र.   '.@$file_uo_or_letter_no.'/दो/सी-2 ,  दिनांक ';
if($is_genrate == true){
$contents .= $post_data['date2'];
}else
{
	$contents .=  '<input type="text" class="date1" name="date2" value="'.date('d-m-Y').'" placeholder="dd/mm/yyyy" />';
}
$contents .=  ' के संदर्भ में नस्ती सहित अग्रेषित ।</div></td></tr>';
$contents .= '<tr><td align="left"><div style="width:10%; float:left">2- </div><div style="width:85%; float:left"> निजी सचिव, मुख्यमंत्री सचिवालय, भोपाल ।</div></td></tr>';
$contents .= '<tr><td align="left"><div style="width:10%; float:left">3- </div><div style="width:85%; float:left"> निजी सचिव, विधि मंत्री कार्यालय, भोपाल की ओर सूचनार्थ अग्रेषित । </div></td></tr>';


$contents .= '<tr><td>&nbsp;</td></tr>';
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right" colspan="3"><div class="officer-center">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td colspan="3">&nbsp;</td></tr>';
}

$contents .= '<tr><td colspan="3" align="right"><div  contenteditable="false" class="officer-center">( ';
if($is_genrate == true){
$contents .=  get_officer_information($this->input->post('avar_secetroy')); 

}else
{
     $contents .= get_officer_for_sign('avar_secetroy' ,$uber_sect ,'', $us_id);
    
}

$contents .= ' )</div></td></tr>';
$contents .= '<tr><td colspan="3" align="right"><div  contenteditable="false" class="officer-center">';

if($is_genrate == true){    
    $contents .=   get_officer_dign($this->input->post('avar_secetroy'));
}
else {
     $contents .= '-------';
    }
$contents .= '</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">'.$dept_name.'</div></td></tr>';

//print content
//echo $contents;
?>   

