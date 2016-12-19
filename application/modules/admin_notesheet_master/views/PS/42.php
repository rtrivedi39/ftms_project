<?php 
$contents  = '' ;
$contents .= '<tr><td><div style="margin-top:200px"><div style="float:left; ">'.@$name_bh.'</div><div style="float:right">'.$dept_name.'</div></div></td></tr>';
$contents .= '<tr><td><div style="float:left">सचिव</div><div style="float:right">विंध्याचल भवन, प्रथम तल, भोपाल</div></td></tr>';
$contents .= '<tr><td align="right"><u>अद्व  शास.पत्र कं ';
if($is_genrate == true){
$contents .= $post_data['gove_half_1'];
}else
{
	$contents .=  '<input type="text" name="gove_half_1" /> ';
}
$contents .= '21-क अभि</u></td></tr>';

$contents .= '<tr><td>विषय:- अप0क्र. ';
if($is_genrate == true){
$contents .= $post_data['crime_no_1'];
}else
{
	$contents .=  '<input type="text" name="crime_no_1" placeholder="अप0क्र." /> ';
}
if($is_genrate == true){
$contents .= '&nbsp;'.$post_data['subject'].'&nbsp;';
}else
{
	$contents .=  '<input type="text" name="subject"  />';
}
$contents .= ' विरूद्ध न्यायालय में अभियोजन स्वीकृति आदेश जारी किये जाने  बावत</td></tr>';

$contents .= '<tr><td align="center">------0-------</td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';

$contents .= '<tr><td><p>आरोपी ';
if($is_genrate == true){
$contents .= $post_data['subject_1'];
}else
{
	$contents .=  '<input type="text" name="subject_1"  />';
}
$contents .= ' विरूद्ध अपराध क्रमांक ';
if($is_genrate == true){
$contents .= $post_data['crime_no_2'];
}else
{
	$contents .=  '<input type="text" name="crime_no_2" placeholder="अपराध क्रमांक " /> ';
}
$contents .=  ' में राज्य आर्थिक अपराध अन्वेषण ब्यूरो ,भोपाल द्वारा अभियोजन की स्वीकृति का अनुरोध किया गया है। आरोपी का प्रशासकीय विभाग सहकारिता विभाग है। अत: अभियोजन की स्वीकृति के संबंध में संबंधित प्रकरण दस्तावेज सूची सहित आपको प्रेषित किये जा रहे है।</p></td></tr>';
$contents .= '<tr><td><p>प्रकरण से  संबंधित किसी अभिलेख / दस्तावेज़ की आवश्यकता होने पर वह सीधे लोकायुक्त संगठन से प्राप्त करने का कष्ट करें |</p></td></tr>';

$contents .= '<tr><td><p>कृपया सामान्य प्रशासन विभाग के आदेश क्रमांक  एफ-15-01/14/ 1 -10  दिनांक  5 - 9 - 14 के प्रकाश में समय सीमा में आवश्यक कार्यवाही करने का कष्ट करें ।</p></td></tr>';
$contents .= '<tr><td><p>शुभकामनाओं सहित।</p></td></tr>';
$contents .= '<tr><td align="right"><div style="width:35%; text-align:center;">	भवदीय</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:35%; text-align:center;" contenteditable="false">(';
if($is_genrate == true){	 
	$contents .= get_officer_information($this->input->post('sing_user')); 
}else{
	$contents .= get_officer_for_sign('sing_user' ,array(2,3,4,5,7) ,'', $as_id);
}

$contents .= ')</div></td></tr>';

$contents .= '<tr><td>प्रति ,</td></tr>';
$contents .= '<tr><td><span style="margin-left:10%">';
if($is_genrate == true){
$contents .= $post_data['name_2'];
}else
{
	$contents .=  '<input type="text" name="name_2"  />';
}

$contents .= ',</span></td></tr>';
$contents .= '<tr><td><span style="margin-left:10%">प्रमुख सचिव, </span></td></tr>';
$contents .= '<tr><td><span style="margin-left:10%">म.प्र. शासन,</span></td></tr>';
$contents .= '<tr><td><span style="margin-left:10%">'.$file_department.',</span></td></tr>';
$contents .= '<tr><td align="left"><span style="margin-left:10%">मंत्रालय, भोपाल</span></td></tr>';

//print content
//echo $contents;
?>   

