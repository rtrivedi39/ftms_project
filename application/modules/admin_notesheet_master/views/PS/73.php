<?php 
$contents  = '' ;

$contents .= '<tr><td align="right"><div style="margin-top:150px">अर्द्ध शास.पत्र क्रं. ';
if($is_genrate == true){
$contents .= $post_data['gove_half_1'];
}else
{
	$contents .=  '<input type="text" name="gove_half_1" /> ';
}
$contents .= '/21-क(अभि)</div></td></tr>';
$contents .= '<tr><td>विषय:- ';
if($is_genrate == true){
	$contents .= $post_data['subject'];
}else
{
	$contents .=  '<textarea  name="subject" cols="145" rows="5"></textarea> ';
}

$contents .= 'न्यायालय में अभियोजन स्वीकृति के संबंध में ।</td></tr>';




$contents .= '<tr><td align="center">------0-------</td></tr>';
$contents .= '<tr><td><p>आरोपी ';
if($is_genrate == true){
$contents .= $post_data['criminal'];
}else
{
	$contents .=  '<input type="text" name="criminal" /> ';
}
$contents .= ' ,तत्कालीन ओएसडी तत्कालीन शिक्षा मंत्री मध्य प्रदेश भोपाल के विरूद्ध अपराध क्रमांक ';
if($is_genrate == true){
$contents .= $post_data['crime_no_2'];
}else
{
	$contents .=  '<input type="text" name="crime_no_2" placeholder="अपराध क्रमांक " /> ';
}
$contents .=  ' में एसटीएफ भोपाल द्वारा अभियोजन की स्वीकृति का अनुरोध किया गया है । आरोपी का प्रशासकीय विभाग सामान्य प्रशासन विभाग (कार्मिक) है । अत: अभियोजन की स्वीकृति  के संबंध में संबंधित प्रकरण दस्तावेज सूची सहित आपको प्रेषित किये जा रहे ।</p></td></tr>';
$contents .= '<tr><td><p>प्रकरण से  संबंधित किसी अभिलेख / दस्तावेज़ की आवश्यकता होने पर वह सीधे लोकायुक्त संगठन से प्राप्त करने का कष्ट करें |</p></td></tr>';
$contents .= '<tr><td><p>कृपया सामान्य प्रशासन विभाग के आदेश क्रमांक  एफ-15-01/14/ 1 -10  दिनांक  5 - 9 - 14 के प्रकाश में समय सीमा में आवश्यक कार्यवाही करने का कष्ट करें ।</p></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><p>शुभकामनाओं सहित।</p></td></tr>';
//$contents .= '<tr><td align="right"><div style="width:35%; text-align:center;">	भवदीय</div></td></tr>';
//$contents .= '<tr><td align="right"><div style="width:35%; text-align:center;"> (आर.के. वाणी)</div></td></tr>';
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right"><div  style="width:50%; text-align:center;">भवदीय <br/> (Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td>&nbsp;</td></tr>';
}
$contents .= '<tr><td align="right"><div class="officer-center">( ';
if($is_genrate == true){	 
	$contents .= get_officer_information($this->input->post('sing_user')); 
}else{
	$contents .= get_officer_for_sign('sing_user' ,array(2,3,4,5,7) ,'', $us_id);
}

$contents .= ' )</div></td></tr>';
$contents .= '<tr><td align="right"><div class="officer-center"> ';
if($is_genrate == true){
	$contents .=   get_officer_dign($this->input->post('sing_user'));
}else{
	$contents .= '-------';
}
$contents .= '</td></tr>';
$contents .= '<tr><td>प्रति ,</td></tr>';
$contents .= '<tr><td><span style="margin-left:5%">';
if($is_genrate == true){
$contents .= $post_data['name_2'];
}else
{
	$contents .=  '<input type="text" name="name_2"  />';
	}

$contents .= ',</span></td></tr>';
$contents .= '<tr><td><span style="margin-left:5%">प्रमुख सचिव, </span></td></tr>';
$contents .= '<tr><td><span style="margin-left:5%">म.प्र. शासन,</span></td></tr>';
$contents .= '<tr><td><span style="margin-left:5%">'.@$file_department.',</span></td></tr>';
$contents .= '<tr><td align="left"><span style="margin-left:5%">मंत्रालय, भोपाल</span></td></tr>';


//print content
//echo $contents;
?>   

