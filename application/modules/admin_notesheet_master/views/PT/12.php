<?php 
$contents  = '' ;
$contents .= '<tr><td align="center"><u><h3>'.$dept_name.'</h3></u></td></tr>';
$contents .= '<tr><td align="center"><u><h4>//आदेश//</h4></u></td></tr>';
$contents .= '<tr><td><div style="float:left">क्रमांक  '.$file_number.'/'.date("Y").'/21-क(या0),  </div><div style="float:right">भोपाल, दिनांक  ';
if($is_genrate == true){
$contents .= $post_data['date1'].'</div></td></tr>';
}else
{
	$contents .=  '<input type="text" class="date1" name="date1" value="'.$today.'" placeholder="dd/mm/yyyy" required>';
}
$contents .=  '</div></td></tr>';
$contents .= ' <tr><td> <p>राज्य शासन,  ';
if($is_genrate == true){
    foreach(get_advocates_name('', $post_data['member_id']) as $row){
        $contents .= ' '.$row->scm_name_hi.' '.$row->scm_post_hi;
    }
} else {
    $contents .= ' <select name="member_id">';
    foreach($standing_counsil_memebers as $row){
        $contents .= '<option value="'.$row->scm_id.'">'.$row->scm_name_hi.'</option>';
    }
    $contents .= '</select>';
}
$contents .= ' को नेशनल ग्रीन ट्रिब्यूनल, सेन्ट्रल जोन दिल्ली में प्रस्तुत याचिका क्रं० ';
if($is_genrate == true){
$contents .= ' '.$post_data['yachika_no'] .'/';
}else{
$contents .= ' <input type="text" name="yachika_no" value="'.$file_number.'"/> / ';
}
if($is_genrate == true){
$contents .= ' '.$post_data['yachika_no_2'] ;
}else{
$contents .= ' <input type="text" name="yachika_no_2" value="'.$agenst.'"/> ';
}
$contents .= ' विरूद्ध ';
if($is_genrate == true){
$contents .= ' '.$post_data['against'] ;
}else{
$contents .= '<input type="text" name="against" value="'.$agenst_name.'"/> ';
}
$contents .= ' में म०प्र० शासन की और से पैरवी करने हेतु  ' ;
if($is_genrate == true){
    foreach(get_advocates_name('', $post_data['member_id1']) as $row){
        $contents .= ' '.$row->scm_name_hi.' '.$row->scm_post_hi;
    }
} else {
    $contents .= ' <select name="member_id1">';
    foreach($standing_counsil_memebers as $row){
        $contents .= '<option value="'.$row->scm_id.'">'.$row->scm_name_hi.'</option>';
    }
    $contents .= '</select>';
}
$contents .= ', नई दिल्ली को नियुक्त किया जाता है ।</p>';
$contents .= '</td></tr>';
$contents .= '<tr><td><p> इस सम्बंध में फीस का भुगतान प्रशासकीय विभाग द्वारा वहन किया जायेगा |</p></td></tr>';
$contents .= '<tr><td><p>हस्ताक्षरयुक्त वकालतनामा संलग्न कर भेजा जा रहा है |</p></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td align="right">मध्यप्रदेश के राज्यपाल के नाम से तथा आदेशानुसार</td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">('.$as_name.')</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">अतिरिक्त सचिव</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">'.$dept_name.'</div></td></tr>';
$contents .= '<tr><td><div style="float:left">फा0क्रं  '.$file_number.'/ '.date("Y").'/21-(या) </div><div style="float:right">भोपाल, दिनांक  ';
if($is_genrate == true){
$contents .= $post_data['date2'].'</div></td></tr>';
}else
{
	$contents .=  '<input type="text" class="date1" name="date2" value="'.$today.'" placeholder="dd/mm/yyyy" />';
}
$contents .= '<tr><td>प्रतिलिपि:-</td></tr>';
$contents .=  '<tr><td><p>1-  सचिव, म0प्र0 शासन,‍ ';
$contents .=  ' '.$file_department;
$contents .=  ', मंत्रालय भोपाल की ओर उनके यू0ओ0क्र0 '.$file_uo_or_letter_no.' , दिनांक  ';
$contents .=  ' '.get_date_formate($file_uo_or_letter_date,'d/m/Y');
$contents .=  ' के संदर्भ में नस्ती सहित अग्रेषित। कृपया प्रकरण के प्रभारी अधिकारी को निर्देश दें कि वें ';
if($is_genrate == true){
    foreach(get_advocates_name('', $post_data['member_id2']) as $row){
        $contents .= ' '.$row->scm_name_hi.' '.$row->scm_post_hi;
    }
} else {
    $contents .= ' <select name="member_id2">';
    foreach($standing_counsil_memebers as $row){
        $contents .= '<option value="'.$row->scm_id.'">'.$row->scm_name_hi.'</option>';
    }
    $contents .= '</select>';
}
$contents .= '  से संपर्क कर न्यायालय के समक्ष प्रत्यावर्तन प्रस्तुत कर आवश्यक कार्यवाही करें एवं उसकी एक प्रति इस विभाग को सन्दर्भ सहित भेजे ।';
$contents .= '<tr><td><p>2- ';
if($is_genrate == true){
    foreach(get_advocates_name('', $post_data['member_id4']) as $row){
        $contents .= ' '.$row->scm_name_hi.', '.$row->scm_post_hi;
    }
} else {
    $contents .= ' <select name="member_id4">';
    foreach($standing_counsil_memebers as $row){
        $contents .= '<option value="'.$row->scm_id.'">'.$row->scm_name_hi.'</option>';
    }
    $contents .= '</select>';
}
$contents .= ',  उच्चतम न्यायालय, ';
if($is_genrate == true){
$contents .= ' '.$post_data['for_forwoarding'] ;
}else{
$contents .= ' <input type="text" name="for_forwoarding"/>';
}
$contents .= ' की और सूचनार्थ एवं आवश्यक कार्यवाही हेतु अग्रेषित।</p></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">('.$as_name.')</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">अतिरिक्त सचिव</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">'.$dept_name.'</div></td></tr>';
?>


