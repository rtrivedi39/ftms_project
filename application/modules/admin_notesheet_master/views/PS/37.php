
<?php 
$contents  = '' ;
$contents .= '<tr><td><div style="margin-top:10px;"><span style="margin-left:10%;">अभियोजन स्वीकृति हेतु आवेदन पत्र श्री ';
if($is_genrate == true){
$contents .= $post_data['name_1'];
}else
{
	$contents .=  '<input type="text"  name="name_1"  />';
}
$contents .=  ' जिला ';

if($is_genrate == true){
$contents .= $post_data['state_1'];
}else
{
	$contents .=  get_distic_dd('state_1');
}

$contents .=  ' मे लोक सेवक के विरूद्ध अभियोजन स्वीकृति बाबत।</span></div></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';


$contents .= '<tr><td align="center">------0-------</td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><p><div style="float:left">पंजी क्र0 '.$file_number.'/'.date("Y").'/21-क(अभि )</div><div style="float:right"> दिनांक   ';
if($is_genrate == true){
$contents .= $post_data['date1'].'</div></td></tr>';
}else
{
	$contents .=  '<input type="text" class="date1" name="date1" value="'.date('d-m-Y').'" placeholder="dd/mm/yyyy" />';
}
$contents .= '</div></p></td></tr>';

$contents .= '<tr><td><p> कृपया विचाराधीन पत्र का सहपत्रों सहित अवलोकन करने का कष्ट करें ।</p></td></tr>';
//$contents .= '<tr><td>&nbsp;</td></tr>';

$contents .= '<tr><td><p> आवेदक श्री ';
if($is_genrate == true){
$contents .= $post_data['name_2'];
}else
{
	$contents .=  '<input type="text"  name="name_2"  />';
}
$contents .=  ' ने लोक सेवक  ';
if($is_genrate == true){
$contents .= $post_data['log_sevak'];
}else
{
	$contents .=  '<input type="text"  name="log_sevak"  />';
}
$contents .=  ' के विरूद्ध धारा 197 के अंतर्गत आवेदन पत्र प्रस्तुत किया है। अभियोजन स्वीकृति हेतु सामान्य प्रशासन विभाग ने दिनांक  05.09.2014';

$contents .= ' को एक परिपत्र जारी किया है। उक्त परिपत्र के अनुसार अभियोजन स्वीकृति की कार्यवाही प्रशासकीय विभाग द्वारा की जाना है।</p></td></tr>';
//$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><p> अत: प्राप्त प्रकरण मूलत: प्रशासकीय विभाग ';
if($is_genrate == true){
$contents .= $post_data['dept_1'];
}else
{
	$contents .=  '<input type="text"  name="dept_1"  />';
}
$contents .=  ' की ओर आवश्यक कार्यवाही हेतु भेजा जाना प्रस्तावित है तथा विभाग द्वारा की गई कार्यवाही से आवेदक को भी सूचित किया जाना उचित होगा। 
 </p></td></tr>';
$contents .= '<tr><td><p>आदेशार्थ प्रस्तुत।</p></td></tr>';
//$contents .= '<tr><td>&nbsp;</td></tr>';

$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td align="left"><div style="width:35%; text-align:center;"></div></td></tr>';
if($this->uri->segment(6) == 'p' || $this->uri->segment(7) == 'p'){
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>अनु0अधि0 ( अभि0)</u></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>अति0सचिव ( अभि0)</u></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>अनु0अधि0 ( अभि0)</u></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>अवर सचिव ( अभि0)</u></td></tr>';
}
$contents .= '<tr><td align="center">ज्ञापन की स्वच्छ प्रतिया हस्ताक्षरार्थ प्रस्तुत |</td></tr>';



//print content
//echo $contents;
?>   

