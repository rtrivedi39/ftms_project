<?php
$contents  = '' ;
$contents .= '<tr><td colspan="2"><div  class="shift-buttom" ><span  class="shift-left">'.$file_subject.'</span></div></td></tr>';
$contents .= '<tr><td align="left"><br />पंजी क्रमांक '.$panji_krmank.'/21-क(आप.),<br /></td><td align="right"><br /> दिनांक '.$file_mark_section_date.'<br /></td></tr>';
$contents .= '<tr><td align="center" colspan="2">&nbsp; &nbsp;---------------------------------------------&nbsp;&nbsp;</td></tr>';
$contents .= '<tr><td colspan="2" align="left">&nbsp;<br />   हेड क्रं. 6/';
if($is_genrate == true){
    $contents .= $post_data['head'];
}else{
	$contents .= '<input name="head" placeholder="head" type="text" />';
}
$contents .= '/'.date("Y");
$contents .= '<br /> म.प्र. उच्च न्यायालय ';
if($is_genrate == true){
    $contents .= $post_data['court_location2'];
}else{
    $contents .= '<select name="court_location2">';
    foreach($court_location2 as $row){
        $contents .= '<option value="'.$row.'">'.$row.'</option>';
    }
    $contents .= '</select>';
}
$contents .= '<br /><tr><td colspan="2"><div class="text-justify">जिला दण्डाधिकारी ';
$contents .= $district_name_hi;
$contents .= ' (म.प्र.)  के ';
$contents .= $file_type == 'l' ? 'पत्र क्रमांक': false;
$contents .= $file_type == 'f' ? 'यू.ओ. क्रमांक': false;
$contents .= ' '.$file_uo_or_letter_no.' दिनांक  '.$file_judgment_date1.' द्वारा अपील प्रस्तावित ।<br /></div>';
$contents .= '<div>विधि विभाग में प्रस्ताव  दिनांक '.$file_mark_section_date;
$contents .= ' को प्राप्त हुआ ।<br /></div>';
$contents .= '<div> अपील प्रस्ताव के संबंध में नस्ती के परीक्षण के लिए जानकारी निम्नानुसार है :-<br/></div></td></tr>';
$contents .= '<tr><td colspan="2"><div class="text-justify">1. न्यायालय का पूर्ण नाम जिसके विरूद्ध अपील प्रस्तुत की जानी है । <br/>';
if($is_genrate == true){
    $contents .= $post_data['dt4'];
}else{
	 $contents .= get_Court('dt4');
	
   
}
$contents .= '</div></td></tr>';
$contents .= '<tr><td colspan="2"><div class="text-justify" >2.  म0प्र0 शासन विरूद्ध '.$case_parties1[0].' के मामले में अपील प्रस्तावित की गई है । </div></td></tr>';
$contents .= '<tr><td colspan="2"><div class="text-justify" >3. ';
if($is_genrate == true){
    $contents .= $post_data['case_hindi'];
}else{
    $contents .= '<select name="case_hindi">';
    foreach($case_hindi as $row){
        $contents .= '<option value="'.$row.'">'.$row.'</option>';
    }
    $contents .= '</select>';
}
$contents .= '  प्रकरण क्रं.  '.$case_no1[1].'/'.$case_no1[2].'</div></td></tr>';
$contents .= '<tr><td colspan="2"><div class="text-justify" >4. ';
if($is_genrate == true){
    $contents .= $post_data['dosh_mukti'];
}else{
    $contents .= '	<select name="dosh_mukti">';
    foreach($dosh_mukti as $row){
        $contents .= '<option value="'.$row.'">'.$row.'</option>';
    }
    $contents .= '</select>';
}
$contents .= '  के निर्णय की दिनांक ';
if($is_genrate == true){
    $contents .= $post_data['dt1'];
}else{
    $contents .= '<input type="text" name="dt1" class="date1" value=""/>';
}
$contents .= '</div></td></tr>';
$contents .= '<tr><td colspan="2"><div  class="text-justify" >5. ';
if($is_genrate == true){
    $contents .= $post_data['dosh_mukti'];
}else{
	$contents .= '__';
}
$contents .= ' का निर्णय भा.दं.भि. की धारा ';
if($is_genrate == true){
    $contents .= $post_data['text1'];
}else{
    $contents .= '<input type="text" name="text1"/>';
}
$contents .= '  के अंतर्गत पारित किया गया है ।</div></td></tr>';
$contents .= '<tr><td colspan="2"><div  class="text-justify" >6.';
if($is_genrate == true){
    $contents .= $post_data['dosh_mukti'];
}else{
	$contents .= '__';
}
$contents .= ' निर्णय की प्रमाणित प्रतिलिपि संलग्न है, जो ध्वज-ए है । </div></td></tr>';
$contents .= '<tr><td colspan="2"><div class="text-justify" >7. साक्षियों के कथनों की प्रतिलिपि संलग्न  ';
if($is_genrate == true){
    $contents .= $post_data['dropdown1'];
}else{
    $contents .= '<select name="dropdown1">';
        $contents .= '<option>है </option>';
        $contents .= '<option>नहीं है </option>';    
    $contents .= '</select>';
}
$contents .= ' |</div></td></tr>';
$contents .= '<tr><td colspan="2"><div class="text-justify">8. ';
if($is_genrate == true){
    $contents .= $post_data['dosh_mukti'];
}else{
	$contents .= '__';
}
$contents .= ' निर्णय के विरूद्ध लोक अभियोजक का अभिमत संलग्न  ';
if($is_genrate == true){
    $contents .= $post_data['dropdown2'];
}else{
    $contents .= '<select name="dropdown2">';
        $contents .= '<option>है </option>';
        $contents .= '<option>नहीं है </option>';    
    $contents .= '</select>';
}
$contents .= ' । </div</td></tr>';
$contents .= '<tr><td colspan="2"><div class="text-justify" >9. ';
if($is_genrate == true){
    $contents .= $post_data['dosh_mukti'];
}else{
	$contents .= '__';
}
$contents .= ' निर्णय के विरूद्ध ';
if($is_genrate == true){
    $contents .= $post_data['dropdown3'];
}else{
    $contents .= '<select name="dropdown3">';
        $contents .= '<option>अपील </option>';
        $contents .= '<option>रिवीजन</option>';    
    $contents .= '</select>';
}
$contents .= '  प्रस्तुत किये जाने की दिनांक ';
if($is_genrate == true){
    $contents .= $post_data['dt2'];
}else{
    $contents .= '<input type="text" name="dt2" class="date1"/>';
}
$contents .= '<tr><td colspan="2"><div  style="text-align:justify">10. प्रकरण अवधि बाह्य ';
if($is_genrate == true){
    $contents .= $post_data['late_days'];
}else{
$contents .= '<select name="late_days"><option> </option><option>दिवस विलंब से </option> </select>';
}
$contents .= ' प्राप्त ';
if($is_genrate == true){
    $contents .= $post_data['dropdown_4'];
}else{
    $contents .= '<select name="dropdown_4">';
        $contents .= '<option>हुआ है </option>';
        $contents .= '<option>नहीं हुआ है </option>';    
    $contents .= '</select>';
}
$contents .= '</div></td></tr>';
$contents .= '<tr><td colspan="2"><div class="text-justify">11. प्रकरण  में '; 
if($is_genrate == true){
    $contents .= $post_data['high_court'];
}else{
	 $contents .= '<select name="high_court"><option> निर्णय </option><option> आदेश </option></select>';
}
$contents .= ' दिनांक   ';
if($is_genrate == true){
    $contents .= $post_data['order_date_1'];
}else{
    $contents .= '<input type="text" name="order_date_1" class="date1"  value = "'.$file_judgment_date1 .'" />';
}
$contents .= ' पारित हुआ हैं| नकल के लिये आवेदन दिनांक  ';
if($is_genrate == true){
    $contents .= $post_data['order_date_12'];
}else{
    $contents .= '<input type="text" name="order_date_12" class="date1"/>';
}
$contents .= ' को दिया गया और दिनांक  ';
if($is_genrate == true){
    $contents .= $post_data['order_date_122'];
}else{
    $contents .= '<input type="text" name="order_date_122" class="date1"/>';
}
$contents .= ' को   प्राप्त हुआ हैं| जिस कारण नकल की अवधि  निकाले जाने पर अपील / पुनरीक्षण करने के लिये अवधि दिनांक ';
if($is_genrate == true){
    $contents .= $post_data['date_1234'];
}else{
    $contents .= '<input type="text" name="date_1234" class="date1"/>';
}
$contents .= ' तक '; 
if($is_genrate == true ){
	if($post_data['out_of_date'] == 'विलम्ब'){ }else{
		  $contents .= $post_data['out_of_date'];
	}
  
}else{
	 $contents .= '<select name="out_of_date" class="out_of_date"><option> प्राप्त है।  </option><option>प्रकरण अवधि बाह्य प्राप्त हुआ है। </option><option> विलम्ब </option></select>';
}
$contents .= ' <div id="late_receive" ';

if($post_data['out_of_date'] == 'विलम्ब'){
$contents .= 'class="show"';
}else{
$contents .= 'class="hide"';
}

$contents .= '>';
if($is_genrate == true){
    $contents .= $post_data['late_receive_days'] ;
}else{
$contents .= '<input type="text" name="late_receive_days"/>';
}
$contents .= '   दिन विलम्ब से प्राप्त हुआ है। </div>';
$contents .= '</div></td></tr>';
$contents .= '<tr><td colspan="2"><br/><div  style="text-align:justify" ></div><br/></td></tr>';
$contents .= '</div></td></tr>';
$contents .= '<tr><td colspan="2"><br /><br />';
  if($this->uri->segment(6) == 'p' || $this->uri->segment(7) == 'p'  ){
$contents .= ' <br /><br /> <u>अनुभाग अधिकारी (आप.)</u><br /><br /><u>अवर सचिव (आप.)</u><br /></td></tr>';
  }
?>



