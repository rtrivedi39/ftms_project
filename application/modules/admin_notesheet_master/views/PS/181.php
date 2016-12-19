
<?php 
$contents  = '' ;

$contents .= '<tr><td> <P>&nbsp</p></td></tr>';
$contents .=  ' <tr><td><p>विषय:  अभियोजन स्वीकृति हेतु आवेदन पत्र श्री ';
if($is_genrate == true){
$contents .= $post_data['crime_no'];
}else{
$contents .= 	' <input type="text" name="crime_no"> ';
} 
$contents .=  '  जिला ';
 if($is_genrate == true){
$contents .= $post_data['state_1'];
}else
{
	$contents .=  get_distic_dd('state_1'); 
} 

$contents .= 	' में लोक सेवक के विरुध्द अभियोजन स्वीकृति बाबत् | ';
$contents .= 	' </p></td></tr>'; 
$contents .= '<tr><td><P style="text-align:center">----0----</p></td></tr>';
$contents .= '<tr><td> <P>पंजी क्रमांक  ';

$contents .= 	$file_number.'/'.date("Y").'/21-क (अभि) ';

$contents .= 	'  दिनांक  ';

$contents .= 	date( 'd-m-Y', strtotime( $file_uo_or_letter_date));

$contents .= 	' </p></td></tr>'; 


$contents .= '<tr><td><p>कृपया विचाराधीन पत्र का सहपत्रों सहित अवलोकन करने का कष्ट करें।</p></td></tr>';
$contents .= '<tr><td><p> आवेदन  श्री ';
if($is_genrate == true){
$contents .= $post_data['name_1'];
}else{
//$contents .= 	'<input type="text" name="name_1" value="'.$file_subject.'">';
$contents .= 	'<input type="text" name="name_1" value="">';
}
$contents .= '  ने लोक सेवक  ';
if($is_genrate == true){
$contents .= $post_data['page_no_1'];
}else{
$contents .= 	'<input type="text" name="page_no_1">';
}
$contents .= '  के विरुध्द धारा 197 के अंतर्गत आवेदन पत्र प्रस्तुत किया है। अभियोजन स्वीकृति हेतु सामान्य प्रशासन विभाग ने दिनांक 05.09.2014 को एक परिपत्र जारी किया है। उक्ते परिपत्र के अनुसार अभियोजन स्वीकृति की कार्यवाही प्रशासकीय विभाग द्वारा की जाना है। </p></td></tr>';
$contents .= '<tr><td><p>अत: प्राप्त प्रकरण मूलत: प्रशासकीय विभाग ';
if($is_genrate == true){
    $contents .= $post_data['v1'];
}else
{
    $contents .=  get_department_ddl_list('v1');
}
$contents .= ' की ओर आवश्यक कार्यवाही हेतु भेजा जाना प्रस्तावित है तथा विभाग द्वारा की गई कार्यवाही से आवेदक को 
भी सूचित किया जाना उचित होगा।</p></td></tr>';
$contents .= '<tr><td><p>आदेशार्थ  प्रस्तुत।</p></td></tr>';


//$contents .= '<tr><td><p>ज्ञापन की स्वसच्छत प्रतियॉ  हस्तापक्षरा‍र्थ  प्रस्तुात।</p></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
if($this->uri->segment(6) == 'p' || $this->uri->segment(7) == 'p'){
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>अनुभाग अधिकारी (अभि0) </u></td></tr>';

$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>सचिव  (अभि0) </u></td></tr>';
}



//print content
//echo $contents;
?>   

