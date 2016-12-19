<style>
p{
	line-height:24px;
}
</style>
<?php 
$contents  = '<table style="font-size:14px;  width:100%; margin:0% auto;">' ;
$contents .= '<tr><td align="right"><b><u>सूचना का अधिकार</u></b></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td>फा. क्र.  '.$file_number.'/सू.अ./'.date("Y").'</td></tr>';
$contents .= '<tr><td align="center"> <b>सूचना का अधिकार अधिनियम, 2005 </b></td></tr>';
$contents .= '<tr><td align="center"><b>( सूचना का अधिकार अधिनियम, 2005 की धारा 6(1) के अंतर्गत  आवेदन पत्र पर कार्यवाही) </b></td></tr>';
$contents .= '<tr><td align="left">आवेदक का नाम श्री     ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['avedak'].'</b>';
}else{
    $contents .=  '<input type="text" class=""  size="50px" name="avedak" value="" placeholder="आवेदक का नाम " required>';
}
$contents .=  '</td></tr>';
$contents .= '<tr><td align="center"> पंजी क्रमांक  :- '.$file_number.'/सू.अ./'.date("Y").' दिनांक       /        / '.date("Y").'</div>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td align="center"> -------000------- </td></tr>';
$contents .= '<tr><td><p>आवेदन के पत्र के साथ रू0 10/- का षुल्क कार्यालय में जमा रू0 10 मूल्य का स्टाम्प पत्र संलग्न किया गया है।</p> </td></tr>';
$contents .= '<tr><td><p>आवेदन पत्र में वांछित जानकारी की विषिष्टियां दी गई हैं। आवेदन पत्र रसीद  आवेदक को दी जाए।</p> </td></tr>';
$contents .= '<tr><td><p>निर्घारित पंजी में आवेदन पत्र की प्रविष्टि की जाए।</p> </td></tr>';
$contents .= '<tr><td><p>वांछित जानकारी इस कार्यालय की ';
if($is_genrate == true){ 
    $contents .=  ' <b>'.getSection($post_data['section']).'</b>';
} else {
	$contents .= ' <select name="section" class="section">';
	$sections = get_list(SECTIONS,'','');	
	foreach($sections as $row){
		$contents .= '<option value="'.$row['section_id'].'">'.$row['section_name_hi'].'('.$row['section_name_en'].')</option>';
	}
	$contents .= '</select>';
}
$contents .= '   से संबंधित है, अतः शाखा प्रभारी बिंदुवार जानकारी सूचना के अधिकार प्रकोष्ठ  को उपलब्ध करावें, अथवा उसके बारे में उपलब्धता निष्चित करते हुए यथोचित जानकारी पृृष्ठ संख्या सहित उपलब्ध करावें, क्योंकि आज दिनांक से 30 दिवस के भीतर आवेदक को वांछित सूचना की उपलब्धता सुनिष्चित करना है। </p> </td></tr>';
$contents .= '<tr><td><p> शाखा प्रभारी, कृपया जानकारी, पन्द्रह दिवस के अंदर निश्चित रूप से उपलब्ध कराना सुनिश्चित करें, ताकि स्मरण पत्र जारी करने की स्थिति निर्मित न हो। ।</p> </td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
if($this->uri->segment(6) == 'p' || $this->uri->segment(7) == 'p'  ){
$contents .= '<tr><td><u>अनुभाग अधिकारी (सिविल)</u></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>अवर सचिव (सिविल)</u></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>अति. सचिव (सिविल)</u></td></tr>';
}
$contents .= '</table>';