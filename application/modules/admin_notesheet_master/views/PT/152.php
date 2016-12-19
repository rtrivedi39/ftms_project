<?php 
$contents  = '' ;
$contents .= '<tr><td align="left"><div style="margin-top:20px;"><span style="margin-left:10%;">';
if($is_genrate == true){ 
    $contents .=  ' '.$post_data['subject'];
} else {
    $contents .= ' <textarea name="subject" style="margin: 0px; height: 40px; width: 80%;">'.$file_subject.'</textarea>';
}

$contents .= '<tr><td><div style="float:left">पं.क्र.  '.$file_number.'/21-(या0),  </div><div  style="float:right">दिनांक ';
if($is_genrate == true){
     $contents .= get_date_formate($post_data['date1'],'d/m/Y');
}
else
{
    $contents .='<input type="text" class="date1" name="date1" placeholder="dd/mm/yyyy" value="'.$file_mark_section_date.'" />';
}
$contents .= '<tr><td align="center"> '.$file_department.'  का  </td></tr>';

$contents .= '<tr><td align="center"><div style="float:left;">यू.ओ. क्रमांक :'.$file_uo_or_letter_no.'</div><div style="float:right;">दिनांक '.get_date_formate($file_uo_or_letter_date,'d/m/Y').'</div>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td align="center">--00--</td></tr>';
$contents .= '<tr><td align="center" height="80"></td></tr>';

$contents .= '<tr><td align="left"><p> कृपया प्रशासकीय विभाग की नस्ती पर अंकित टीप का अवलोकन करें।   </p></td></tr>'; 
$contents .= '<tr><td align="left"><p> प्रशासकीय विभाग ने विषयांकित प्रकरण  में अनावेदक म.प्र. शासन की ओर से प्रतिरक्षण आदेश जारी करने हेतु नस्ती विधि विभाग को प्रेषित की है। </p></td></tr>'; 
$contents .= '<tr><td align="left"><p> प्रशासकीय विभाग की नस्ती में याचिका की प्रति एवं पार्टी का नाम नही है। विधि विभाग द्वारा म.प्र. शासन की ओर से ही पक्ष समर्थन आदेश जारी किये जाते है। याचिका की प्रति न होने से एवं पार्टी का नाम न होने से यह स्पष्ट नही होता कि म.प्र. शासन  इसमें पक्षकार है अथवा नही। </p></td></tr>';
$contents .= '<tr><td align="left"><p> अत: प्रशासकीय विभाग की नस्ती लौटाते हुए नस्ती पर याचिका की प्रति अथवा अधिवक्ता पत्र एवं पार्टी का नाम उपलब्ध करायें तभी प्रतिरक्षण आदेश जारी किया जाना संभव होगा। </p></td></tr>';   
$contents .= '<tr><td align="left"><p> साथ ही यह भी लिखा जाना उचित होगा कि भविष्य में ऐसी नस्ती पर सम्पूण्र जानकारी उपलब्ध कराकर ही नस्ती भेजी जावे। </p></td></tr>';   
   if($this->uri->segment(6) == 'p' || $this->uri->segment(7) == 'p'  ){
	   $contents .= '<tr><td>&nbsp;</td></tr>';
		$contents .= '<tr><td><u>अनुभाग अधिकारी (याचिका)</u></td></tr>';

		$contents .= '<tr><td>&nbsp;</td></tr>';
		$contents .= '<tr><td><u>अवर सचिव (याचिका)</u></td></tr>';

		$contents .= '<tr><td>&nbsp;</td></tr>';
		$contents .= '<tr><td><u>अति सचिव (याचिका)</u></td></tr>';
	   }
       $contents .= ' <tr><td></td></tr><tr><td></td></tr>';
?>