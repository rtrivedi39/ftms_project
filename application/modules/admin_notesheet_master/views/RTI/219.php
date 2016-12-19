<style>
p{
	line-height:24px;
}
</style>
<?php 
$contents  = '<table style="font-size:14px;  width:100%; margin:0% auto;">' ;
$contents .= '<tr><td align="right"><b><u>सूचना का अधिकार</u></b></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td>फा. क्र.  '.$file_number.'/सू.अ./'.date("Y").'</td></tr>';
$contents .= '<tr><td align="center"> <b>सूचना का अधिकार अधिनियम, 2005 </b></td></tr>';
$contents .= '<tr><td align="left">आवेदक का नाम श्री     ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['avedak'].'</b>';
}else{
    $contents .=  '<input type="text" class=""  size="50px" name="avedak" value="" placeholder="आवेदक का नाम " required>';
}
$contents .=  '</td></tr>';
$contents .= '<tr><td align="center"> पंजी क्रमांक  :- '.$file_number.'/सू.अ./'.date("Y").' दिनांक       /        / '.date("Y").'</div>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td align="center"> -------000------- </td></tr>';
$contents .= '<tr><td><p>  कृपया अपीलार्थी द्वारा इस विभाग में प्रस्तुत प्रथम अपील का अवलोकन कीजिये।</p> </td></tr>';
$contents .= '<tr><td><p> अपीलार्थी  द्वारा  उनके  आवेदन-पत्र  के  साथ नाॅन ज्यूषियल स्टांप क्रमांक ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['kramank'].'</b>';
}else{
    $contents .=  '<input type="text" class=""  size="30px" name="kramank" value="" placeholder="" required>';
}
$contents .= ' रू. ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['rupay'].'</b>';
}else{
    $contents .=  '<input type="text" class=""  size="30px" name="rupay" value="" placeholder="" required>';
}
$contents .= ' संलग्न किया गया है। उनके द्वारा पूर्व में प्रस्तुत आवेदन पत्र दिनांक ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['dinak'].'</b>';
}else{
    $contents .=  '<input type="text" class=""  size="30px" name="dinak" value="" placeholder="" required>';
}
$contents .= ' में जानकारी प्राप्त न होने की स्थिति में प्रथम अपील प्रस्तुत की गई है। </p> </td></tr>';
$contents .= '<tr><td><p> अतः अपीलार्थी एवं लोक सूचना अधिकारी  को  सुनवाई  हेतु  दिनांक ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['suvai_dinak'].'</b>';
}else{
    $contents .=  '<input type="text" class=""  size="30px" name="suvai_dinak" value="" placeholder="" required>';
}
$contents .= ' को ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['samany'].'</b>';
}else{
    $contents .=  '<input type="text" class=""  size="30px" name="samany" value="सुबह 11.00 " placeholder="" required>';
}

$contents .= ' बजे उपस्थित होने हेतु पत्र जारी किया जाना प्रस्तावित है।</p> </td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
if($this->uri->segment(6) == 'p' || $this->uri->segment(7) == 'p'  ){
$contents .= '<tr><td><u>अनुभाग अधिकारी (सिविल)</u></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>अवर सचिव (सिविल)</u></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>अति. सचिव (सिविल)</u></td></tr>';
}
$contents .= '</table>';