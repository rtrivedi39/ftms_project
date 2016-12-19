<?php
$contents  = '' ;
$contents .= '<tr><td colspan="2"><div class=""><span class="shift-left">अधिवक्ताओं को स्वीकृत देयकों का भुगतान किये जाने बाबत् </span></div></td></tr>';
$contents .= '<tr><td colspan="2"><table width="100%"><tr><td align="left">पंजी क्रमांक '.$panji_krmank.'/21-क(स्था.), </td><td align="right"> दिनांक '.$file_mark_section_date.'</td></tr></table></td></tr>';
$contents .= '<tr><td align="center" colspan="2" > ----------------------------------------------------------</td></tr>';
$contents .= '<tr><td align="left" colspan="2"><p class="shift-left text-justify">   कृृपया याचिका शाखा द्वारा प्रस्तुत आदेश क्रमांक    /21 -क(या.) दिनांक   /  /201 का अवलोकन कीजिये।';

$contents .= ' </p></td></tr><tr><td align="left" colspan="2"><p class="shift-left text-justify"> ';
if($is_genrate == true){
	$contents .= $post_data['section_name'];
}else
{
$contents  .= "<select name='section_name'><option>आपराधिक शाखा</option><option>याचिका शाखा</option><option>न्यायिक शाखा </option></select> ";	
}
$contents .= ' ने अपने आदेश क्र.';
if($is_genrate == true){
	$contents .= $post_data['order_no'];
}else
{
$contents  .= "<input type='text' name='order_no' > ";	
}
$contents  .= 'दिनांक  ';
if($is_genrate == true){
	$contents .= $post_data['order_date'];
}else
{
$contents  .= "<input type='text' name='order_date' > ";	
}
$contents .= ' द्वारा ';
if($is_genrate == true){
    foreach(get_advocates_name('', $post_data['member_id']) as $row){
        $contents .= ' '.$row->scm_name_hi;
    }
} else {
    $contents .= ' <select name="member_id">';
    foreach($standing_counsil_memebers as $row){
        $contents .= '<option value="'.$row->scm_id.'">'.$row->scm_name_hi.'</option>';
    }
    $contents .= '</select>';
}
$contents .= ' अधिवक्ता, उच्चतम न्यायालय, नई दिल्ली को राज्य शासन की ओर से पैरवी करने हेतु अभिभाषकीय पारिश्रमिक के रूप में राशि रूपये ';
if($is_genrate == true){
	$contents .= $post_data['amount'];
}else
{
$contents  .= "<input type='text' name='amount' > ";	
}
$contents .= ' स्वीकृत कर भुगतान किये जाने हेतु आदेशित किया है। </td></tr>'; 

$contents .= '<tr><td colspan="2"><p class="shift-left text-justify">	मांग संख्या';
if($is_genrate == true){
    $contents .= $post_data['mangno'];
}else{
$contents .='<input type="text" name="mangno" id="date" class=""  value="-29-2014-"   placeholder="दिनांक"/>';
}
$contents .=' न्याय प्रशासन-(';
if($is_genrate == true){
    $contents .= $post_data['mangno1'];
}else{
$contents .='<input type="text" name="mangno1" id="date" class=""  value="114"   placeholder="दिनांक"/>';
}
$contents .= ')-विधि सलाहकार और परामर्शदाता (काउंसिल) की योजना-(';

if($is_genrate == true){
    $contents .= $post_data['mangno2'];
}else{
$contents .='<input type="text" name="mangno2" id="date" class=""  value="6251"   placeholder="दिनांक"/>';
}
$contents .=' )- उच्च न्यायालय/उच्चतम न्यायालय के अभिभाषकों की फीस एवं अन्य भुगतान की ';
if($is_genrate == true){
    $contents .= $post_data['mangno3'];
}else{
$contents .='<input type="text" name="mangno3" id="date" style="width: 450px;" class=""  value="मद-31-व्यवसायिक सेवाओं हेतु अदायगियाॅ-(003)-अभिभाषकों की फीस  "   placeholder="दिनांक"/>';
}
$contents .='  में वित्तीय वर्ष ';
if($is_genrate == true){
    $contents .= $post_data['mangno4'];
}else{
$contents .='<input type="text" name="mangno4" id="date" class=""  value=" 2016-17 "   placeholder="दिनांक"/>';
}
$contents .=' हेतु प्राप्त आवंटन में से विकलनीय होगा। </p><br/></td></tr>';

 $contents .= '<tr><td colspan="2"><p class="text-justify shift-left" >  अतः  ';
if($is_genrate == true){
    foreach(get_advocates_name('', $post_data['member_id']) as $row){
        $contents .= ' '.$row->scm_name_hi;
    }
} else {
    $contents .= ' <select name="member_id">';
    foreach($standing_counsil_memebers as $row){
        $contents .= '<option value="'.$row->scm_id.'">'.$row->scm_name_hi.'</option>';
    }
    $contents .= '</select>';
}

$contents  .= ' अधिवक्ता, उच्चतम न्यायालय, नई दिल्ली को रूपये ';
if($is_genrate == true){
	$contents .= $post_data['amount'];
}else
{
$contents  .= "<input type='text' name='amount' > ";	
}
$contents  .= ' स्वीकृत कर भुगतान किया जाना प्रस्तावित है, जिसकी अनुशंसा प्रमुख सचिव, विधि द्वारा दिनांक ';
if($is_genrate == true){
	$contents .= $post_data['by_date'];
}else
{
$contents  .= "<input type='text' name='by_date' class='by_date' > ";	
}
$contents  .= ' को की गई है। ';
$contents .= '  </p><br/></td></tr>';

if($this->uri->segment(6) == 'p' || $this->uri->segment(7) == 'p'  ){
$contents .= '<tr><td colspan="2"><div><u>अनुभाग अधिकारी (स्था0) </u> </div><br/><br/><br/></td></tr>';
$contents .= '<tr><td colspan="2"><div><u>अवर सचिव </u> </div><br/><br/><br/></td></tr>';
}
$contents .= '<tr><td colspan="2"><br /><br/><br/><div  style="text-align:justify" ></div><br/></td></tr>';

?>
<style>
.shift-left{ margin-left:10%;}
.shift-top{ margin-top:20px; }
.shift-left{ text-indent:50px }
</style>



