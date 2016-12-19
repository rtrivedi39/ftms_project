<?php $this->load->view('B-II/state_tahsil') ?>
<style>
p{
	line-height:24px;
}
</style>
<?php
$contents  = '<table style="font-size:15px;  width:80%; margin:0% auto;">' ;
$contents .= '<tr><td align="left"><div style="margin-top:35px;"><span style="margin-left:10%;">';
if($is_genrate == true){ 
    $contents .=  '<b>'.$post_data['notriname'].'</b>';
} else {
    $contents .= '<input type="text" class="notriname adv_name " name="notriname"  value="श्री "/>';
}

$contents .= ' <span id="notery_adv"></span>';
$contents .= ' अधिवक्ता एवं नोटरी, जिला मुख्यालय ';

if($is_genrate == true){
        $contents .= '<b>'.$post_data['distic_1'].'</b>';
} else {
	$contents .= '<input type="text" class="adv_distic " name="distic_1"  />';
}
$contents .= ' के नोटरी व्यवसाय प्रमाण-पत्र के नवीनीकरण  के संबंध में।</div></td></tr>';
$contents .= '<tr><td align="center">-----00-------</td></tr>';

$contents .= '<tr><td align="center"><b><u>पंजी क्रं ';
if($is_genrate == true){ 
    $contents .=  $post_data['panjino'];
} else {
    $contents .= '<input type="text" name="panjino" />';
}
$contents .= '/'.date('Y').'/21-ब(दो), दिनांक ';
if($is_genrate == true){ 
    $contents .=  $post_data['panjidate'];
} else {
    $contents .= '<input type="text" class="" name="panjidate"  value="'.$today.'"/>';
}
$contents .= '</u></b></td></tr>';

$contents .= '<tr><td><p>कृपया जिला एवं सत्र न्यायाधीश ';

if($is_genrate == true){
        $contents .= '<b>'.$post_data['distic_1'].'</b>';
} else {
	$contents .= '<input type="text" class="adv_distic " name="distic_1"  value="श्री "/>';
}
$contents .= ' के पत्र/ज्ञापन क्रमांक ';
if($is_genrate == true){ 
    $contents .=  '<b>'.$post_data['gyapan_no'].'</b>';
} else {
    $contents .= '<input type="text" class="" name="gyapan_no"  value=""/>';
}
$contents .= ' दिनांक ';
if($is_genrate == true){ 
    $contents .=  '<b>'.$post_data['grapan_date'].'</b>';
} else {
    $contents .= '<input type="text" class="" name="grapan_date"  value="'.$today.'"/>';
}
$contents .= ' का अवलोकन करना चाहेंगे। </p></td></tr>';
$contents .= '<tr><td><p>जिला एवं सत्र न्यायाधीश  ';

if($is_genrate == true){
        $contents .= '<b>'.$post_data['distic_1'].'</b>';
} else {
	$contents .= '<input type="text" class="adv_distic " name="distic_1"  value="श्री "/>';
}
$contents .= ' ने  ';
if($is_genrate == true){ 
    $contents .=  '<b>'.$post_data['notriname'].'</b>';
} else {
    $contents .= '<input type="text" class="notriname adv_name" name="notriname"  value="श्री "/>';
}
$contents .= ' अधिवक्ता जिला मुख्यालय ';

if($is_genrate == true){
        $contents .= '<b>'.$post_data['distic_1'].'</b>';
} else {
	$contents .= '<input type="text" class="adv_distic " name="distic_1"  value="श्री "/>';
}

$contents .= ' नोटरी व्यवसाय प्रमाण-पत्र को नवीनीकृत  किये जाने संबंधी आवेदन पत्र दिनांक  ';
if($is_genrate == true){ 
    $contents .=  $post_data['avedan_date'];
} else {
    $contents .= '<input type="text" class="avedan_date" name="avedan_date"  value="'.$today.'"/>';
}
$contents .= ' को सहपत्रों सहित अपनी अनुशंसा के साथ इस विभाग को प्रेषित किया है। </p></td></tr>';
$contents .= '<tr><td><p>';
if($is_genrate == true){ 
    $contents .=  '<b>'.$post_data['notriname'].'</b>';
} else {
    $contents .= '<input type="text" class="notriname adv_name" name="notriname"  value="श्री "/>';
}
$contents .= ' अधिवक्ता एवं नोटरी ने दिनांक ';
if($is_genrate == true){ 
    $contents .=  '<b>'.$post_data['notri_date'].'</b>';
} else {
    $contents .= '<input type="text" class="adv_posting_date" name="notri_date"  value="'.$today.'"/>';
}
$contents .= ' को समाप्त होने वाली समयावधि तक के लिये जारी अपने नोटरी व्यवसाय प्रमाण-पत्र को आगामी 5 वर्ष तक के लिये नवीनीकरण किये जाने का अनुरोध किया हैं। आवेदन-पत्र के साथ नोटरी नियम,1956 के अनुसार नोटरी व्यवसाय प्रमाण-पत्र नवीनीकृत किये जाने के संबंध में देय शुल्क रूपये 1000/- (रूपये एक हजार) केवल कोषालय में जमा किये जाने के चालान क्रमांक ';
if($is_genrate == true){ 
    $contents .=  '<b>'.$post_data['chalan_no'].'</b>';
} else {
    $contents .= '<input type="text" class="chalan_no" name="chalan_no"  value=""/>';
}
$contents .= ' चालान  दिनांक ';
if($is_genrate == true){ 
    $contents .=  '<b>'.$post_data['chalan_date'].'</b>';
} else {
    $contents .= '<input type="text" class="chalan_date" name="chalan_date"  value="'.$today.'"/>';
}
$contents .= ' की मूल प्रति एवं रूपये 2000/- (रूपये दो हजार) केवल का नान-ज्यूडिशियल स्टाम्प संलग्न है| </p></td></tr>';
$contents .= '<tr><td><p>';
if($is_genrate == true){ 
    $contents .=  '<b>'.$post_data['notriname'].'</b>';
} else {
    $contents .= '<input type="text" class="notriname adv_name" name="notriname"  value="श्री "/>';
}
$contents .= ' अधिवक्ता को सर्वप्रथम राज्य शासन द्वारा दिनांक ';
if($is_genrate == true){ 
    $contents .=  '<b>'.$post_data['todate'].'</b>';
} else {
    $contents .= '<input type="text" class="notri_todate adv_posting_date" name="todate"  value="'.$today.'"/>';
}
$contents .= ' से पांच वर्ष के लिए दिनांक ';
if($is_genrate == true){ 
    $contents .=  '<b>'.$post_data['from_name'].'</b>';
} else {
    $contents .= '<input type="text" class="notri_fromdate post_renew_date" name="from_name"  value="'.date('d-m-Y',strtotime($today."+ 5 years")).'"/>';
}
$contents .= ' को समाप्त होने वाली समयावधि तक के लिये नोटरी व्यवसाय का प्रमाण पत्र जारी किया गया था,  एवं समय-समय पर नवीनीकरण किये जाने के उपरांत अंतिम बार उनके नोटरी व्यवसाय प्रमाण-पत्र का दिनांक ';
if($is_genrate == true){ 
    $contents .=  '<b>'.$post_data['patra_date'].'</b>';
} else {
    $contents .= '<input type="text" class="" name="patra_date"  value="'.$today.'"/>';
}
$contents .= ' तक के लिये नवीनीकरण किया गया था ।</p></td></tr>';
$contents .= '<tr><td><p>नोटरी अधिनियम 1952 की धारा-5 के अंतर्गत संधारित की जाने वाली नोटरी पंजी में ';
if($is_genrate == true){ 
    $contents .=  '<b>'.$post_data['notriname'].'</b>';
} else {
    $contents .= '<input type="text" class="notriname adv_name" name="notriname"  value="श्री "/>';
}
$contents .= ' का नाम दर्ज ';
if($is_genrate == true){ 
    $contents .=  ' '.$post_data['type'];
} else {
    $contents .= ' <select name="type">';
	$contents .= '<option value="है">है</option>';
	$contents .= '<option value="नहीं है">नहीं है</option>';
	$contents .= '</select>';
}
$contents .= '|  विभाग द्वारा उन्हें नोटरी व्यवसाय प्रमाण-पत्र क्रमांक ';
if($is_genrate == true){ 
    $contents .=  '<b>'.$post_data['notrino'].'</b>';
} else {
    $contents .= '<input type="text" class="notry_no" name="notrino"  value=""/>';
}
$contents .= ' आवंटित किया गया है।</p></td></tr>';
$contents .= '<tr><td><p>नोटरी अधिनियम 1952 की धारा-5(2) में उल्लेख किया गया है कि यदि कोई नोटरी अपने नोटरी व्यवसाय प्रमाण-पत्र की समयावधि समाप्त होने के पूर्व निर्धारित देय शुल्क एवं नान-ज्यूडिशियल स्टाम्प के साथ नोटरी व्यवसाय प्रमाण-पत्र को नवीनीकृत किये जाने का आवेदन-पत्र राज्य शासन को प्रेषित करता है, तो वह अपने नोटरी व्यवसाय प्रमाण-पत्र को आगामी पांच वर्ष के लिये नवीनीकृत करा पाने का अधिकारी होता हैं। </p></td></tr> ';
if($this->uri->segment(6) == 'p' || $this->uri->segment(7) == 'p'  ){
	$contents .= '<tr><td><div style="height:50px;"></div></td></tr>';
//page 2
$contents .= '<tr><td align="center">-----00-------</td></tr>';
$contents .= '<tr><td align="left">पूर्व पृष्ठसेः-</td></tr>';
}
$contents .= '<tr><td align="left"><div style=""><span style="margin-left:10%;">';
$contents .= ' इस विभाग में ';
if($is_genrate == true){ 
    $contents .=  '<b>'.$post_data['notriname'].'</b>';
} else {
    $contents .= '<input type="text" class="notriname adv_name" name="notriname"  value="श्री "/>';
}
$contents .= ' के कार्य एवं आचरण के संबंध में अन्य कहीं से भी कोई शिकायत प्राप्त नहीं हुई है। इसलिये ';
if($is_genrate == true){ 
    $contents .=  '<b>'.$post_data['notriname'].'</b>';
} else {
    $contents .= '<input type="text" class="notriname adv_name" name="notriname"  value="श्री "/>';
}
$contents .= ' अधिवक्ता के नोटरी व्यवसाय प्रमाण-पत्र को आगामी पांच वर्ष अर्थात् दिनांक ';
if($is_genrate == true){ 
    $contents .=  '<b>'.$post_data['notri_to_date'].'</b>';
} else {
    $contents .= '<input type="text" class=" notri_todate" name="notri_to_date"  value="'.$today.'"/>';
}
$contents .= ' से दिनांक ';
if($is_genrate == true){ 
    $contents .=  '<b>'.$post_data['notri_from_date'].'</b>';
} else {
    $contents .= '<input type="text" class=" notri_fromdate" name="notri_from_date"  value="'.$today.'"/>';
}
$contents .= ' तक के लिये नवीनीकृत किया जाना उचित होगा।</p></td></tr>';
$contents .= '<tr><td><p>प्रमुख सचिव, विधि के अनुमोदन पश्चात् ';
if($is_genrate == true){ 
    $contents .=  '<b>'.$post_data['notriname'].'</b>';
} else {
    $contents .= '<input type="text" class="notriname adv_name" name="notriname"  value="श्री "/>';
}
$contents .= ' के नोटरी व्यवसाय प्रमाण-पत्र का नवीनीकरण कर नवीनीकृत नोटरी व्यवसाय प्रमाण-पत्र जारी कर दिया जायेगा|</p></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
if($this->uri->segment(6) == 'p' || $this->uri->segment(7) == 'p'  ){
$contents .= '<tr><td><b>अनुभाग अधिकारी (बी-2)</b></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><b>अवर सचिव  (बी-2)</b></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><b>सचिव (बी-2)</b></td></tr>';
//page 3
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
}
if($this->uri->segment(6) == 'p' || $this->uri->segment(7) == 'p'  ){
$contents .= '<tr><td align="left"><div style="margin-top:250px;"><span style="margin-left:10%;">';
if($is_genrate == true){ 
    $contents .=  '<b>'.$post_data['notriname'].'</b>';
} else {
    $contents .= '<input type="text" class="notriname adv_name" name="notriname"  value="श्री "/>';
}
$contents .= ' अधिवक्ता एवं नोटरी, जिला मुख्यालय ';


if($is_genrate == true){
        $contents .= '<b>'.$post_data['distic_1'].'</b>';
} else {
	$contents .= '<input type="text" class="adv_distic " name="distic_1"  value="श्री "/>';
}

$contents .= ' के नोटरी व्यवसाय प्रमाण-पत्र के नवीनीकरण  के संबंध में।</td></tr>';

$contents .= '<tr><td align="center">-----00-------</td></tr>';
$contents .= '<tr><td align="left">पूर्व पृष्ठसेः-</td></tr>';
}
$contents .= '</table>';
?>
<?php  //$this->load->view('B-II/b_2section_js');?>

                
                
        
                  
                
               
                