<?php $this->load->view('B-II/state_tahsil') ?>
<?php
//page 1
$contents  = '<table style="font-size:14px; margin:0% auto; width:80%;">' ;
$contents .= '<tr><td align="right"><b><u>स्पीडपोस्ट-द्वारा</u></b></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td align="center"><h5><u>'.$dept_name.',</u></h5></td></tr>';
$contents .= '<tr><td align="center"><h5><u>(विन्ध्याचल भवन, प्रथम-तल)</u></h5></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><div style="float:left">क्रमांक 17(ई)/';
if($is_genrate == true){
	$contents .= $post_data['head_number'];
}else
{
    $contents .=  '<input type="text" class="" name="head_number" value="" required>';
}
$contents .= '/'.date('Y').'/21-ब(दो), </div><div style="float:right">भोपाल, दिनांक  ';
if($is_genrate == true){
	$contents .= $post_data['panji'];
}else
{
    $contents .=  '<input type="text" class="" name="panji" value="'.$file_mark_section_date.'" placeholder="dd/mm/yyyy" required>';
}
$contents .=  '</div></td></tr>';
$contents .= '<tr><td align="left"><b>प्रति,</b></td></tr>';
$contents .= '<tr><td align="left"><span style="margin-left:8%">जिला एवं सत्र न्यायाधीश,</span></td></tr>';
$contents .= '<tr><td align="left"><b><u><span style="margin-left:8%"><b>';
if($is_genrate == true){ 
    $contents .=  $post_data['adv_distic1'];
} else {
    $contents .= '<input type="text" class="adv_distic" name="adv_distic1" value=""/>';
}
$contents .= ' , म0प्र0</b></span></td></tr>';
$contents .= '<tr><td><div style="float:left; width:14%"><b>विषय:- </b></div><p style="text-indent: 0;">';
$contents .= '<span id="notery_adv" ></span>';
if($is_genrate == true){ 
    $contents .=  $post_data['adv_name1'];
} else {
    $contents .= '<input type="text" class="adv_name notriname" name="adv_name1" value=""/>';
}

$contents .= ', नोटरी  जिला मुख्यालय  ';
if($is_genrate == true){ 
    $contents .=  $post_data['adv_distic2'];
} else {
    $contents .= '<input type="text" class="adv_distic" name="adv_distic2" value=""/>';
}


$contents .= ' के नोटेरियल प्रमाण-पत्र का नवीनीकरण करने के संबंध में।</p></td></tr>';
$contents .= '<tr><td align="center">----000----</td></tr>';
$contents .= '<tr><td><p>कृपया उपर्युक्त विषयक आपके ज्ञापन क्रमांक ';
if($is_genrate == true){ 
    $contents .=  $post_data['gyapan_no'];
} else {
    $contents .= '<input type="text" class="" name="gyapan_no"  value=""/>';
}
$contents .= ' दिनांक ';
if($is_genrate == true){ 
    $contents .=  $post_data['grapan_date1'];
} else {
    $contents .= '<input type="text" class="" name="grapan_date1"  value="'.$file_judgment_date.'"/>';
}
$contents .= ' का अवलोकन करें ।</p></td></tr>';
$contents .= '<tr><td><p>राज्य शासन ';
if($is_genrate == true){ 
    $contents .=  $post_data['adv_name2'];
} else {
    $contents .= '<input type="text" class="adv_name notriname" name="adv_name2" value=""/>';
}
$contents .= ', नोटरी  जिला  मुख्यालय ';
if($is_genrate == true){ 
    $contents .=  $post_data['adv_distic4'];
} else {
    $contents .= '<input type="text" class="adv_distic" name="adv_distic4" value=""/>';
}

$contents .= ' को नोटरीज अधिनियम, 1952 की धारा-5 (2) के अंतर्गत आगामी 5 वर्ष दिनांक  ';

if($is_genrate == true){ 
    $contents .= '<b>'.$post_data['adv_posting_date1'].'</b>';
} else {
    $contents .= '<input type="text" value="" name="adv_posting_date1" class="adv_posting_date">';
}
$contents .= ' से दिनांक   ';
if($is_genrate == true){ 
    $contents .=  '<b>'.$post_data['from_date1'].'</b>';
} else {
    $contents .= '<input type="text" class=" notri_fromdate" name="from_date1"  value="'.date('d-m-Y',strtotime($today."+ 5 years")).'"/>';
}
$contents .= ' तक दोनो दिन सम्मिलित करके, नोटरी के रूप में व्यवसाय करने के लिये प्रमाण-पत्र का नवीनीकरण करने की स्वीकृति प्रदान करता  है ।</p></td></tr>';
$contents .= '<tr><td><p>';
if($is_genrate == true){ 
    $contents .=  $post_data['adv_name3'];
} else {
    $contents .= '<input type="text" class="adv_name notriname" name="adv_name3" value=""/>';
}
$contents .= ', नोटरी  जिला मुख्यालय ';
if($is_genrate == true){ 
    $contents .=  $post_data['adv_distic3'];
} else {
    $contents .= '<input type="text" class="adv_distic" name="adv_distic3" value=""/>';
}

$contents .= ' का पूर्व का नवीनीकरण का प्रमाण-पत्र नये प्रमाण-पत्र के साथ संलग्न है जिसे उन्हें दे दिया जाय तथा उसकी अभिस्वीकृति प्राप्त कर अभिलेख हेतु इस विभाग को भेजने का कष्ट करें ।</p></td></tr>';
$contents .= '<tr><td align="right">मध्यप्रदेश के राज्यपाल के नाम से तथा आदेशानुसार,</td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">(<b>';
if($is_genrate == true){
	$contents .= $post_data['sel_name'];
} else {
	$contents .= ' <select name="sel_name" class="sel_name">';
	foreach(user_byrole_section(null,7) as $key => $usnames){ // for under secretary
		$usname = $usnames['emp_full_name_hi'];
		//$slected = $us_name == $usname ? "selected" : "";
		$contents .= '<option value="'.$usname.'">'.$usname.'</option>';
	}		
	foreach(user_byrole_section(null,5) as $keyas => $asnames){ // for aditional secretary
		$asname = $asnames['emp_full_name_hi'];
		//$slectedas = $as_name == $asname ? "selected" : "";
		$contents .= '<option value="'.$asname.'" >'.$asname.'</option>';
	}
	foreach(user_byrole_section(null,4) as $key => $slnames){ // for  secretary
		$slname = $slnames['emp_full_name_hi'];
		$slected = $sl_name == $slname ? "selected" : "";
		$contents .= '<option value="'.$slname.'" >'.$slname.'</option>';
	}
	$contents .= '</select>';	
}
$contents .= '</b>)</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['post'].'</b>';
} else {
	$contents .= ' <select name="post" class="post">';
	$contents .= '<option value="अवर सचिव">अवर सचिव</option>';
	$contents .= '<option value="अपर सचिव">अपर सचिव</option>';
	$contents .= '<option value="सचिव" selected>सचिव</option>';
	$contents .= '</select>';
} 
$contents .= '</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">'.$dept_name.'</div></td></tr>';

//page 2
$contents .= '<tr><td><div style="height:700px;"></div></td></tr>';
$contents .= '<tr><td align="center"><h5><u>'.$dept_name.',</u></h5></td></tr>';
$contents .= '<tr><td align="center"><h5><u>नोटरी के व्यवसाय संबंधी प्रमाण-पत्र का नवीनीकरण</u></h5></td></tr>';
$contents .= '<tr><td><p>चूंकि राज्य शासन ने नोटरी अधिनियम, 1952 (क्रं0-53 सन् 1952) तथा उसके अधीन बनाये गये नोटरीज रूल्स, 1956 के उपबन्धों के अनुसरण में  ';
if($is_genrate == true){ 
    $contents .=  $post_data['adv_name4'];
} else {
    $contents .= '<input type="text" class="adv_name notriname" name="adv_name4" value=""/>';
}
$contents .= ' को जिन्होंने अपना सामान्य वृत्तिक पता- <b>';
if($is_genrate == true){ 
    $contents .=  $post_data['addres'].',';
} else {
    $contents .= '<input type="text" class="addres" name="addres"  value=""/>,';
}
if($is_genrate == true){ 
    $contents .=  ' '.$post_data['tahsil'].',';
} else {
    $contents .= ' <input type="text" class="tahsil" name="tahsil"  value=""/>,';
}
if($is_genrate == true){
    $contents .= ' '.$post_data['distic_1'];
} else {
	$contents .= ' '.get_distic_dd('distic_1');
}
$contents .= '</b>';
$contents .= ' घोषित किया गया था, नोटरी के रूप में नियुक्त किया गया था तथा उक्त ';
if($is_genrate == true){ 
    $contents .=  $post_data['adv_name5'];
} else {
    $contents .= '<input type="text" class="adv_name notriname" name="adv_name5" value=""/>';
}
$contents .= ' नोटरी को व्यवसाय संबंधी प्रमाण-पत्र जारी किया गया था जिसके कि द्वारा उन्हें दिनांक ';
if($is_genrate == true){ 
    $contents .=  '<b>'.$post_data['tha_date'].'</b>';
} else {
    $contents .= '<input type="text" class=" notri_todate" name="tha_date"  value="'.date('d-m-Y',strtotime($today."- 5 years")).'"/>';
}
$contents .= ' से पांच वर्ष की कालावधि तक के लिये इस राज्य के ';
$contents .= ' <b>"जिला  मुख्यालय ';
if($is_genrate == true){
    $contents .= $post_data['distic_1'];
} else {
	$contents .= get_distic_dd('distic_1');
}

$contents .= '"</b>';
$contents .= ' में पूर्वोवत अधिनियम तथा नियमों के उपबन्धों के अध्यधीन रहते हुए, नोटरी के रूप में कार्य करने हेतु प्राधिकृत किया गया था,</p></td></tr>';
$contents .= '<tr><td><p>और चूंकि उक्त  ';
if($is_genrate == true){ 
    $contents .=  $post_data['adv_name6'];
} else {
    $contents .= '<input type="text" class="adv_name notriname" name="adv_name6" value=""/>';
}
$contents .= ', नोटरी ने आवेदन-पत्र तारीख ';
if($is_genrate == true){ 
    $contents .=  '<b>'.$post_data['ptra_date'].'</b>';
} else {
    $contents .= '<input type="text" class="" name="ptra_date"  value="'.$today.'"/>';
}
$contents .= ' के अनुसार  ';
if($is_genrate == true){ 
    $contents .=  '<b>'.$post_data['anu_date'].'</b>';
} else {
    $contents .= '<input type="text" class=" notri_todate" name="anu_date"  value="'.$today.'"/>';
}
$contents .= ' का, अर्थात उस अन्तिम तारीख तक का, जिस तक के लिये पूर्वोवत प्रमाण-पत्र जारी किया गया था, अवसान होने के पश्चात् भी कार्य करते रहने के लिये इच्छा व्यक्त की थी, </p></td></tr>';
$contents .= '<tr><td><p>और चूंकि उक्त  ';
if($is_genrate == true){ 
    $contents .=  $post_data['adv_name7'];
} else {
    $contents .= '<input type="text" class="adv_name notriname" name="adv_name7" value=""/>';
}
$contents .= ', नोटरी ने तारीख ';
if($is_genrate == true){ 
    $contents .=  '<b>'.$post_data['no_to_date'].'</b>';
} else {
    $contents .= '<input type="text" class=" notri_todate" name="no_to_date"  value="'.$today.'"/>';
}

$contents .= ' को रू0 1000/- (रू0 एक हजार) केवल का, जो कि नोटरी रूल्स, 1956 के नियम 9 के अधीन विहित की गयी प्रमाण-पत्र के नवीनीकरण संबंधी फीस है, भुगतान कर दिया है तथा नवीनीकरण का प्रमाण-पत्र जारी किये जाने के लिये स्टाम्प शुल्क रू0 2000/- (रू0 दो हजार) केवल का भी भुगतान कर दिया है| </p></td></tr>';
$contents .= ' <tr><td align="right">.....2/- </td></tr>';
 
//page 3
$contents .= '<tr><td><div style="height:200px;"></div></td></tr>';
$contents .= '<tr><td align="center">//2//</td></tr>';
$contents .= '<tr><td><p>अतएव, राज्य शासन, नोटरीज अधिनियम, 1952 (क्रं0-53 सन् 1952) की धारा 5 की उपधारा (2) द्वारा उसके प्रदत्त शक्तियों के आधार पर एतद्द्वारा, नोटरी के व्यवसाय संबंधी प्रमाण-पत्र दिनांक  ';
if($is_genrate == true){ 
    $contents .=  '<b>'.$post_data['praman_date'].'</b>';
} else {
    $contents .= '<input type="text" class=" notri_todate" name="praman_date"  value="'.$today.'"/>';
}
$contents .= ' को समाप्त होने वाली पांच वर्ष की कालावधि तक के लिये नवीनीकरण करता है और उक्त ';
if($is_genrate == true){ 
    $contents .=  $post_data['adv_name8'];
} else {
    $contents .= '<input type="text" class="adv_name notriname" name="adv_name8" value=""/>';
}
$contents .= ', नोटरी को जिनका वृत्तिक पता पूर्वा अनुसार, नवीनीकरण के इस प्रमाण-पत्र की कालावधि का अवसान होने तक के लिये इस राज्य के  ';
$contents .= ' <b>"जिला  मुख्यालय ';
if($is_genrate == true){
    $contents .= $post_data['distic_1'];
} else {
	$contents .= get_distic_dd('distic_1');
}

$contents .= '"</b>';
$contents .= ' में पूर्वोवत अधिनियम तथा नियमों के, जो कि तत्समय प्रवत्त हो या जो कि समय-समय पर संशोधित किये जाये, उपबंधों के अध्यधीन रहते हुए, नोटरी के रूप में कार्य करते रहने हेतु प्राधिकृत  करता है। ';
$contents .= '<tr><td><p>आज दिनांक ';
if($is_genrate == true){ 
    $contents .=  '<b>'.$post_data['today_date'].'</b>';
} else {
    $contents .= ' <input type="text" class="" name="today_date"  value="'.$today.'"/>';
}
$contents .= ' को मेरे हस्ताक्षर तथा मध्यप्रदेश शासन की सील के अधीन भोपाल, (म0प्र0) में जारी किया गया। इनका पंजीयन क्रमांक ';
$contents .= ' <b>एम0पी0-';
if($is_genrate == true){ 
    $contents .=  $post_data['panjiyan_no'];
} else {
    $contents .= ' <input type="text" class="" name="panjiyan_no"  value=""/>';
}
$contents .= '/21-ब(दो), ';
if($is_genrate == true){ 
    $contents .=  $post_data['old_panji_date'];
} else {
    $contents .= ' <input type="text" class="" name="old_panji_date"  value="'.(date('Y') - 5) .'"/>';
}
$contents .= '</b> है।   </p></td></tr>';
$contents .= '<tr><td align="right">मध्यप्रदेश के राज्यपाल के नाम से तथा आदेशानुसार,  </td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">(<b>';
if($is_genrate == true){
	$contents .= $post_data['sel_name'];
} else {
	$contents .= ' <select name="sel_name" class="sel_name">';
	foreach(user_byrole_section(null,7) as $key => $usnames){ // for under secretary
		$usname = $usnames['emp_full_name_hi'];
		//$slected = $us_name == $usname ? "selected" : "";
		$contents .= '<option value="'.$usname.'" '.$slected.'>'.$usname.'</option>';
	}		
	foreach(user_byrole_section(null,5) as $keyas => $asnames){ // for aditional secretary
		$asname = $asnames['emp_full_name_hi'];
		//$slectedas = $as_name == $asname ? "selected" : "";
		$contents .= '<option value="'.$asname.'" >'.$asname.'</option>';
	}
	foreach(user_byrole_section(null,4) as $key => $slnames){ // for  secretary
		$slname = $slnames['emp_full_name_hi'];
		$slected = $sl_name == $slname ? "selected" : "";
		$contents .= '<option value="'.$slname.'" '.$slected.'>'.$slname.'</option>';
	}
	$contents .= '</select>';	
}
$contents .= '</b>)</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">';
if($is_genrate == true){
		$contents .= '<b>'.$post_data['post'].'</b>';
} else {
	$contents .= ' <select name="post" class="post">';
	$contents .= '<option value="अवर सचिव">अवर सचिव</option>';
	$contents .= '<option value="अपर सचिव">अपर सचिव</option>';
	$contents .= '<option value="सचिव" selected>सचिव</option>';
	$contents .= '</select>';
} 
$contents .= '</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:60%; text-align:center;">'.$dept_name.'</div></td></tr>';
$contents .= '</table>';
?>
 <?php  $this->load->view('B-II/b_2section_js');?>