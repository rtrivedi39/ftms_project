
<?php 
$contents  = '' ;
$contents .= '<tr><td align="center"><u><h3>'.$dept_name.'</h3></u></td></tr>';
$contents .= '<tr><td><div style="float:left">पंजी क्र.  '.@$file_number.'/'.date("Y").'/21-क(अभि), </div><div style="float:right">भोपाल, दिनांक   ';
if($is_genrate == true){
$contents .= $post_data['date1'].'</div></td></tr>';
}else
{
	$contents .=  '<input type="text" class="date1" name="date1" value="'.date('d-m-Y').'" placeholder="dd/mm/yyyy" />';
}
$contents .= '</div></td></tr>';
$contents .= '<tr><td align="left">प्रति,</td></tr>';
$contents .= '<tr><td><span style="margin-left:12%">प्रमुख सचिव, </span></td></tr>';
$contents .= '<tr><td><span style="margin-left:12%">म.प्र. शासन,</span></td></tr>';
$contents .= '<tr><td><span style="margin-left:12%">'.@$file_department.'';


$contents .= ',</span></td></tr>';
$contents .= '<tr><td align="left"><span style="margin-left:12%">मंत्रालय, भोपाल</span></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';

$contents .= '<tr><td align="left"><div style="float:left; width:12%;">विषय:- </div> <div style="float:left; width:85%;">थाना ';
if($is_genrate == true){
$contents .= $post_data['station_1'];
}else
{
	$contents .=  '<input type="text" name="station_1"  />';
}
$contents .=  'क्रं अपराध क्रमांक ';
if($is_genrate == true){
$contents .= $post_data['crime_no_1'];
}else
{
	$contents .=  '<input type="text" name="crime_no_1"  />';
}
$contents .=  ' धारा ';
 if($is_genrate == true){
$contents .= $post_data['dhara_1'];
}else
{
	$contents .=  '<input type="text" name="dhara_1"  />';
}
$contents .=  '  में अभियोजन अनुमति के संबंध में । </div></td></tr>';

$contents .= '<tr><td align="center">------0-------</td></tr>';
$contents .= '<tr><td><p>उपरोक्त विषयांकित प्रकरण जिला  दण्डाधिकारी  ';
 if($is_genrate == true){
$contents .= $post_data['state_ploce_station'];
}else
{
	$contents .= get_distic_dd('state_ploce_station');
}
$contents .=  ' द्वारा थाना ';
if($is_genrate == true){
$contents .= $post_data['station_1'];
}else
{
	$contents .=  '<input type="text" name="station_1"  />';
}
$contents .=  ' के अपराध क्रमांक '; 
if($is_genrate == true){
$contents .= $post_data['crime_no_2'];
}else
{
	$contents .=  '<input type="text" name="crime_no_2"  />';
}
$contents .=  ' धारा ';
if($is_genrate == true){
$contents .= $post_data['dhara_2'];
}else
{
	$contents .=  '<input type="text" name="dhara_2"  />';
}
 $contents .=  ' में ';
 if($is_genrate == true){
$contents .= $post_data['against'];
}else
{
	$contents .=  '<input type="text" name="against"  />';
}
if($is_genrate == true){
$contents .= '&nbsp;'.$post_data['state_13'].'&nbsp;';
}else
{
	$contents .=  get_distic_dd('state_13');
}
$contents .=  ' के विरूद्ध अभियोजन स्वीकृति हेतु धारा 197 ';
 
$contents .=  ' के अंतर्गत प्रकरण प्रेषित किया है ।</p></td></tr>';
$contents .= '<tr><td><p> उक्त संबंध में लेख है कि सामान्य प्रशासन विभाग के परिपत्र दिनांक  5.9.14 ' ;

 $contents .=  'के अनुक्रम में अभियोजन स्वीकृति  संबंधी कार्यवाही प्रशासकीय विभाग द्वारा की जाना है । </p></td></tr>';
$contents .= '<tr><td><p> अत: निर्देशानुसार प्राप्त प्रकरण मूलत: आपकी ओर आवश्यक कार्यवाही हेतु संलग्न प्रेषित कर अनुरोध है कि अभियोजन स्वीकृति संबंधी कार्यवाही समय सीमा में पूर्ण कर की गई कार्यवाही से इस विभाग को एवं जिला दण्डाधिकारी ';
if($is_genrate == true){
$contents .= $post_data['state_11'];
}else
{
	$contents .=  get_distic_dd('state_11');
}
$contents .=  ' को सूचित कराने का कष्ट करें । </p></td></tr>';

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
$contents .= '<tr><td><div style="float:left">पृ.क्र. 1060/15/21-क(अभि),	</div><div style="float:right">भोपाल, दिनांक   ';
if($is_genrate == true){
$contents .= $post_data['date1'];
}else
{
	$contents .=  '<input type="text" class="date1" name="date1" value="'.date('d-m-Y').'" placeholder="dd/mm/yyyy" />';
}
$contents .= '</div></td></tr>';

$contents .= '<tr><td>प्रतिलिपि:-</td></tr>';
$contents .= '<tr><td><p>कार्यालय जिला ';
if($is_genrate == true){
$contents .= $post_data['state_12'];
}else
{
	$contents .=  get_distic_dd('state_12');
}
$contents .=  ' म0 प्र0  की ओर सूचनार्थ प्रेषित ।</p></td></tr>';



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

