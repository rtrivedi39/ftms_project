<?php
$contents  = '' ;
$contents .= '<tr><td colspan="2"><div class="shift-buttom"><span class="shift-left">'.$file_subject.'</span></div></td></tr>';
$contents .= '<tr><td colspan="2"><table width="100%"><tr><td align="left">पंजी क्रमांक '.$panji_krmank.'/21-क(आप.), </td><td align="right"> दिनांक '.$file_mark_section_date.'</td></tr></table></td></tr>';
$contents .= '<tr><td align="center" colspan="2" > ----------------------------------------------------------</td></tr>';
$contents .= '<tr><td align="left" colspan="2"><p class="shift-left text-justify">कृपया विचाराधीन अर्द्व शासकीय पत्र का अवलोकन करने का कष्ट करें।  </p></td></tr><tr><td align="left" colspan="2"><p class="shift-left text-justify">पत्र के माध्यम से शासकीय अधिवक्ता ने सत्र प्रकरण क्रमांक  '.$case_no.' पारित निर्णय दिनांक  '.$file_judgment_date1.'  के ';
if($is_genrate == true){
    $contents .= $post_data['judgment_date_se'];
}else{
	$contents .= '<input name="judgment_date_se"  type="text" />';
}
$contents .= ' संबंध में जानकारी चाही है प्रकरण को वर्ष  ';
if($is_genrate == true){
    $contents .= $post_data['year'];
}else{
	$contents .= '<input name="year" placeholder="year" type="text" />';
}
$contents .= ' के हैड रजिस्टर में देखा गया, परंतु आज दिनांक तक प्रकरण विधि विभाग में आना नहीं पाया जाता है। 
</td></tr>'; 
$contents .= '<tr><td colspan="2"><p class="text-justify shift-left" >अतः संबंधित जानकारी से शासकीय अधिवक्ता को अवगत कराया जाना उचित होगा।</p><br/></td></tr>';
if($this->uri->segment(6) == 'p' || $this->uri->segment(7) == 'p'  ){
$contents .= '<tr><td colspan="2"><div><u>अनुभाग अधिकारी (आप.) </u> </div><br/><br/><br/></td></tr>';
$contents .= '<tr><td colspan="2"><div><u>अति. सचिव </u> </div><br/></td></tr>';
}
$contents .= '<tr><td colspan="2"><br /><br/><br/><div  style="text-align:justify" ></div><br/></td></tr>';

?>
<style>
.shift-left{ margin-left:10%;}
.shift-top{ margin-top:20px; }
.shift-left{ text-indent:50px }
</style>



