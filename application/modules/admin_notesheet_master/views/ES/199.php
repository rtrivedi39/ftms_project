<?php
$contents  = '' ;
$contents .= '<tr><td colspan="2"><div class=""><span class="shift-left">
पेंशन सारांशीकरण(कम्युटेशन) के संबंध में- ';
if($is_genrate == true){
$contents .= get_employee_designation_id($this->input->post('emp_name'), '',  false);
}
else{
$contents .= get_all_employee_ddllist('emp_name' ,'');
}
$contents .= ', सेवानिवृत्त ';
if($is_genrate == true){
$contents .=   get_employee_designation_id($this->input->post('emp_name')); 
}
else{
$contents .= '----' ;
} 
$contents .= '</span></div></td></tr>';
$contents .= '<tr><td colspan="2"><table width="100%"><tr><td align="left">पंजी क्रमांक '.$panji_krmank.'/21-क(स्था.), </td><td align="right"> दिनांक '.$file_mark_section_date.'</td></tr></table></td></tr>';
$contents .= '<tr><td align="center" colspan="2" > ----------------------------------------------------------</td></tr>';
$contents .= '<tr><td align="left" colspan="2"><p class="shift-left text-justify">उक्त विषयक श्री ';
if($is_genrate == true){
$contents .= get_employee_designation_id($this->input->post('emp_name'), '',  false);
}
else{
$contents .= get_all_employee_ddllist('emp_name' ,'');
}
$contents .= ', सेवानिवृत्त ';
if($is_genrate == true){
$contents .=   get_employee_designation_id($this->input->post('emp_name')); 
}
else{
$contents .= '----' ;
} 
 $contents .= ' द्वारा निर्धारित प्रपत्र में आवेदन प्रस्तुत कर उक्त आवेदन पेंशन सारांशीकरण (कम्युटेशन) हेतु पेंशन अधिकारी, सतपुड़ा भवन भोपाल को अग्रेषित करने हेतु  निवेदन किया गया है ।   ';
 if($is_genrate == true){
$contents .= get_employee_designation_id($this->input->post('emp_name'), '',  false);
}
else{
$contents .= get_all_employee_ddllist('emp_name' ,'');
}
$contents .= ' की सेवापुस्तिका की छायाप्रति नस्ती पर प्रस्तुत है ।     </p></td></tr><tr><td align="left" colspan="2"><p class="shift-left text-justify">क्षेत्रीय पासपोर्ट कार्यालय भोपाल से श्री '.$est_so_name.', '.$est_so_designation.' के विधि विभाग द्वारा जारी पासपोर्ट हेतु अनापत्ति प्रमाण-पत्र की छायाप्रति प्रेषित कर लेख किया है कि उक्त अनापत्ति प्रमाण पत्र का कन्फर्नमेशन प्रमाण-पत्र, पत्र प्राप्ति के 10 कार्य दिवस में भिजवाया जाना सुनिश्चित करें ।</td></tr>'; 
$contents .= '<tr><td colspan="2"><p class="text-justify shift-left" > अतः यदि मान्य हो तो उक्त आवेदन पत्र मूलतः (तीन प्रतियों में) पेंशन कार्यालय भेजे जाने हेतु प्रारुप अनुमोदनार्थ प्रस्तुत है । </p><br/></td></tr>';

if($this->uri->segment(6) == 'p' || $this->uri->segment(7) == 'p'  ){
$contents .= '<tr><td colspan="2"><div><u>अनुभाग अधिकारी (स्था)  </u> </div><br/><br/><br/></td></tr>';
$contents .= '<tr><td colspan="2"><div><u>व.ले.अ.(स्था) </u> </div><br/></td></tr>';
}
$contents .= '<tr><td colspan="2"><br /><br/><br/><div  style="text-align:justify" ></div><br/></td></tr>';

?>
<style>
.shift-left{ margin-left:10%;}
.shift-top{ margin-top:20px; }
.shift-left{ text-indent:50px }
</style>



