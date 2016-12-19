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
$contents .= '<tr><td align="center"> '.$file_department.'  का  </td></tr>';
$contents .= '<tr><td align="center"><div style="float:left;">यू.ओ. क्रमांक :'.$file_uo_or_letter_no.'</div><div style="float:right;">दिनांक '.get_date_formate($file_uo_or_letter_date,'d/m/Y').'</div>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td align="center"> -------000------- </td></tr>';
$contents .= '<tr><td><p>कृपया प्रशासकीय विभाग की नस्ती पर अंकित टीप ';
if($is_genrate == true){
$contents .= get_date_formate($post_data['date1'],'d/m/Y');
}else
{
    $contents .=  '<input type="text" class="date1" name="date1" value="'.$today.'" placeholder="dd/mm/yyyy" required>';
}
$contents .= ' का अवलोकन करने का कष्ट करें। </p></td></tr>';
$contents .= '<tr><td><p>उपरोक्त विषयक में प्रशासकीय विभाग द्वारा एनजीटी प्रकरण अपील क्रमांक '.$case_no ;
if($is_genrate == true){
$contents .= $post_data['name_party'];
}else
{
    $contents .=  '<input type="text"  name="name_party" >';
}
$contents .= ' विरुद्ध  ';
if($is_genrate == true){
$contents .= $post_data['name_party'];
}else
{
    $contents .=  '<input type="text"  name="name_party" >';
}
 $contents .= ', एवं अन्य में प्रतिरक्षण आदेश जारी करने हेतु नस्ती विधि विभाग को प्रेषित की है | विषयांकित में मध्यप्रदेश शासन की ओर से प्रतिरक्षण किया जाना है| इस विभाग द्वारा ग्रीन ट्रिब्यूनल ';
 if($is_genrate == true){
$contents .= $post_data['tiubnal_state'];
}else
{
    $contents .=  '<select name="tiubnal_state" ><option>दिल्ली</option><option>भोपाल</option><option>उपभोक्ता फोरम</option></select>';
}
  $contents .= ' में  प्रचलित प्रकरण में पैरवी किये जाने हेतु  ';
  if($is_genrate == true){
    foreach(get_advocates_name('', $post_data['member_id']) as $row){
        $contents .= '<span>'.$row->scm_name_hi.'</span>,';
      
    }
} else {
    $contents .= '<select name="member_id">';
    foreach($standing_counsil_memebers as $row){
        $contents .= '<option value="'.$row->scm_id.'">'.$row->scm_name_hi.'</option>';
    }
    $contents .= '</select>';
}

$contents .= '  अधिवक्ता को अधिकृत किया गया है अतएव शासन की ओर से पैरवी किये जाने हेतु उनके नाम से नियुक्त आदेश जारी किया जाना उचित होगा | ';
if($is_genrate == true){
	$contents .= ' '.$post_data['content'];
}else{
    $contents .=  ' <input type="text" class="" size="50" name="content">';
}
$contents .= '</p> </td></tr>';
$contents .= '<tr><td><p> विषयांकित  प्रकरण  में अधिवक्ता को फीस का भुगतान विधि विभाग द्वारा जारी आदेश दिनांक ';
if($is_genrate == true){
$contents .= get_date_formate($post_data['date2'],'d/m/Y');
}else
{
    $contents .=  '<input type="text" class="date1" name="date2" value="'.$today.'" placeholder="dd/mm/yyyy" required>';
}

$contents .= ' में  वर्णित शर्तो के अधीन  प्रशासकीय विभाग द्वारा किया जायेगा|';
if($is_genrate == true){
	$contents .= ' '.$post_data['content1'];
}else{
    $contents .=  ' <input type="text" class="" size="50" name="content1">';
}
$contents .= '</p> </td></tr>';

$contents .= '<tr><td><p>अतः प्रकरण उच्च स्तर पर मतार्थ  एवं आदेशार्थ प्रस्तुत है।</p> </td></tr>';
if($is_genrate == true){
	$contents .= $post_data['extra_content'] != '' ? '<tr><td><p>'.$post_data['extra_content'].'</p></td></tr><p>' : '';
}else{
	$contents .= '<tr><td><textarea name="extra_content" style="margin: 0px; height: 50px; width: 98%;" placeholder="यदि आपको और डाटा जोड़ना है तो यहाँ पर लिखे|"></textarea></td></tr>';
}
//$contents .= '<tr><td><p> प्रशासकीय विभाग को संबंधित दस्तावेज शासकीय अधिवक्ता का मत / याचिका की प्रति / प्रशासकीय अनुमोदन नस्ती पर उपलब्ध नहीं कराया है | अतः नस्ती मूलतः वापिस की जाती है।</p> </td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';

if($this->uri->segment(6) == 'p' || $this->uri->segment(7) == 'p'  ){
$contents .= '<tr><td><u>अनुभाग अधिकारी (सिविल)</u></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>अवर सचिव (सिविल)</u></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>अति. सचिव (सिविल)</u></td></tr>';
}
$contents .= '</table>';