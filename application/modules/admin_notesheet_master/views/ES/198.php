<?php

$contents  = '' ;
$contents .= '<tr><td colspan="2"><div class=""><span class="shift-left">पासपोर्ट के लिये अनापत्ति प्रमाण-पत्र दिये जाने  बावत्।</span></div></td></tr>';
$contents .= '<tr><td colspan="2"><table width="100%"><tr><td align="left">पंजी क्रमांक '.$panji_krmank.'/21-क(स्था.), </td><td align="right"> दिनांक '.$file_mark_section_date.'</td></tr></table></td></tr>';
$contents .= '<tr><td align="center" colspan="2" > ----------------------------------------------------------</td></tr>';
$contents .= '<tr><td align="left" colspan="2"><p class="shift-left text-justify">कृपया विचाराधीन पत्र का अवलोकन हो।   </p></td></tr><tr><td align="left" colspan="2"><p class="shift-left text-justify">क्षेत्रीय पासपोर्ट कार्यालय भोपाल से '.$est_so_name.', '. $est_so_designation.' के विधि विभाग द्वारा जारी पासपोर्ट हेतु अनापत्ति प्रमाण-पत्र की छायाप्रति प्रेषित कर लेख किया है कि उक्त अनापत्ति प्रमाण पत्र का कन्फर्नमेशन प्रमाण-पत्र, पत्र प्राप्ति के 10 कार्य दिवस में भिजवाया जाना सुनिश्चित करें ।</td></tr>'; 
$contents .= '<tr><td colspan="2"><p class="text-justify shift-left" > अतः यदि मान्य हो तो कन्फर्नमेशन प्रमाण पत्र की स्वच्छ प्रतियाॅं हस्ताक्षार्थ प्रस्तुत है । </p><br/></td></tr>';
$contents .= '<tr><td colspan="2"><p class="text-justify shift-left" >अवलोकन उपरांत आदेशार्थ प्रस्तुत । </p><br/></td></tr>';
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



