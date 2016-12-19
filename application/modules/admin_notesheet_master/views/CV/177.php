<style>
p{
	line-height:24px;
}
</style>
<?php 
$contents  = '<table style="font-size:14px;  width:100%; margin:0% auto;">' ;
$contents .= '<tr><td align="left"><div style="margin-top:20px;"><span style="margin-left:10%;">';
if($is_genrate == true){ 
    $contents .=  ' '.$post_data['subject'];
} else {
    $contents .= ' <textarea name="subject" style="margin: 0px; height: 40px; width: 80%;">'.$file_subject.'</textarea>';
}
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><div style="float:left">पंजी क्रमांक  '.$file_number.'/21-क(सि.),  </div><div style="float:right">भोपाल, दिनांक  ';
if($is_genrate == true){
$contents .= get_date_formate($post_data['date'],'d/m/Y').'</div></td></tr>';
}else
{
    $contents .=  '<input type="text" class="date1" name="date" value="'.$file_mark_section_date.'" placeholder="dd/mm/yyyy" required>';
}
$contents .=  '</div></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td align="center"> -------000------- </td></tr>';
$contents .= '<tr><td><p>कृपया प्रषासकीय विभाग की नस्ती पर अंकित टीप दिनांक 15.06.2016 का अवलोकन करने का कष्ट करें। ';

$contents .= '</p></td></tr>';
$contents .= '<tr><td><p>उपरोक्त विषयक में प्रषासकीय विभाग द्वारा '.$file_subject.' में प्रतिरक्षण आदेष जारी करने हेतु नस्ती विधि विभाग को प्रेषित की है। विषयांकित में मध्यप्रदेष शासन पक्षकार है। अतः ';
if($is_genrate == true){
	$contents .= ' '.$post_data['content'];
}else{
    $contents .=  ' <input type="text" name="content">';
}
$contents .= ' को लेख किया जाना उचित होगा कि विषयांकित में मध्यप्रदेष शासन की ओर से प्रतिरक्षण करने हेतु  ';
if($is_genrate == true){
	$contents .= ' '.$post_data['content'];
}else{
    $contents .=  ' <input type="text"  name="content">';
}
 $contents .=  '(  ';
if($is_genrate == true){ 
	$contents .= $post_data['department'];
}else{
$contents .= get_state_ddl_list('state');
}
$contents .= ')  राज्य शासन की पेनल में से किसी शासकीय अधिवक्ता को नियुक्त करें। पैरवी करने वाले अधिवक्ता को फीस का भुगतान  माननीय ';
if($is_genrate == true){
	$contents .= ' '.$post_data['content'];
}else{
    $contents .=  ' <input type="text"  name="content">';
}
 $contents .=  '(  ';
if($is_genrate == true){ 
	$contents .= $post_data['department'];
}else{
$contents .= get_state_ddl_list('state');
} 
 $contents .=  '  राज्य शासन में प्रचलित नियमों के अनुसार मध्यप्रदेष शासन ';
if($is_genrate == true){ 
	$contents .= $post_data['department'];
}else{
	$contents .=  get_department_ddl_list('department' ) ;
}

$contents .= ' द्वारा किया जाएगा। </p> </td></tr>';
$contents .= '<tr><td><p>अतः प्रकरण उच्च स्तर पर मतार्थ एवं आदेषार्थ प्रस्तुत है।</p> </td></tr>';

$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
if($this->uri->segment(6) == 'p' || $this->uri->segment(7) == 'p'  ){
$contents .= '<tr><td><u>अनुभाग अधिकारी (सिविल)</u></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>अवर सचिव (सिविल)</u></td></tr>';
}
$contents .= '</table>';