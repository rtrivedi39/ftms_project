<?php
$contents ='';

$contents .= '<tr><td colspan="2"><div class=""><span class="shift-left"> ';
if($is_genrate == true){
    $contents .= $post_data['postname'];
}else{
$contents .= '<input name="postname" type="text"  />';
}
$contents .= ',';
if($is_genrate == true){
    $contents .= $post_data['city'];
}else{
$contents .=' <input name="city" type="text"  />';
}
$contents .='जाने हेतु लेखा मिलान दल को 
यात्रा अग्रिम स्वीकृत करने के संबंध मे|
</span></div></td></tr>';
$contents .= '<tr><td colspan="2"><table width="100%"><tr><td align="left">पंजी क्रमांक '.$panji_krmank.'/21-क(आप.), </td><td align="right"> दिनांक '.$file_mark_section_date.'</td></tr></table></td></tr>';
$contents .= '<tr><td align="center" colspan="2" > ----------------------------------------------------------</td></tr>';
$contents .= '<tr><td align="left" colspan="2"><p class="shift-left text-justify"> विभागीय आदेश क्रमांक';
if($is_genrate == true){
    $contents .= $post_data['orderno'];
}else{
$contents .= ' <input name="orderno" type="text" class="date1"  />';
}
$contents .= ', दिनांक ';if($is_genrate == true){
    $contents .= $post_data['date111'];
}else{

$contents .= '<input name="date111" type="text" class="date1"  />';
}
$contents .= 'अनुसार वित्तीय वर्ष ';
$contents .= ', दिनांक ';if($is_genrate == true){
    $contents .= $post_data['year111'];
}else{
$contents .= '<input name="year111" type="text"  />';
}
$contents .= ' में हुये व्यय के आॅंकड़ों के मिलान हेतु (मिलान दल) कार्यालय प्रधान महालेखाकार, ग्वालियर भेजे जाने हेतु निम्नलिखित कर्मचारियों को 
उनके नाम के सम्मुख दर्शाये अनुसारः-   </p></td></tr>'; 
$contents .= '<tr><td colspan="2"><p class="text-justify shift-left" > ';
if($is_genrate == true){
    $contents .= $post_data['textname'];
}else{
$contents .= '<textarea name="textname" cols="50" rows="10"></textarea>';
}

$contents .= '</p><br/></td></tr>';
$contents .= '<tr><td colspan="2"><p class="text-justify shift-left" >  उक्त व्यय मांग संख्या';
if($is_genrate == true){
    $contents .= $post_data['yetrabhata'];
}else{
$contents .= '<input name="yetrabhata" type="text" class=""  />';
}
$contents .= 'यात्रा भत्ते दौरे आदि में से विकलनीय होगा। वित्तीय वर्ष ';
if($is_genrate == true){
    $contents .= $post_data['year2'];
}else{
$contents .= '<input name="year2" type="text" class=""  />';
}
$contents .= 'में प्रथमबार यात्रा अग्रिम राशि रूपये ';
if($is_genrate == true){
    $contents .= $post_data['amount'];
}else{
$contents .= '<input name="amount" type="text" class=""  />';
}
$contents .= 'स्वीकृति हेतु प्रस्तुत।</p><br/></td></tr>';

$contents .= '<tr><td colspan="2"><p class="text-justify " >  आदेशार्थ प्रस्तुत।</p><br/></td></tr>';



