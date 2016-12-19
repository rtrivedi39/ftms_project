<style>
p{	
	text-indent:58px;
	margin-bottom:15px;
}
table#sanshepika *{
	<?php	
	if($post_data['line_height'] != ''){
		echo 'line-height:'.$post_data['line_height'].'pt;';
	} else{
		echo 'line-height:16pt;'; 
	}
	if($post_data['font_size'] != ''){
		echo 'font-size:'.$post_data['font_size'].'pt;';
	} else{
		echo  'font-size:11pt;';
	}
	if($post_data['word_spacing'] != ''){
		echo 'word-spacing:'.$post_data['word_spacing'].'pt;';
	} else{
		//echo 'word-spacing:7pt;';
	}
	?>
}
table#sanshepika table{
	width:100%;
}
table#sanshepika td, table#sanshepika th{
	vertical-align:top;
}
@page{
	margin:1in .6in .6in 1in;			
}
</style>
<?php 
$code = '';
if($file_mark_section_id == 11 ){
	$code = 'ब(एक)';
} elseif($file_mark_section_id == 12 ){
	$code = 'ब(दो)';
}  else {
	$code = ' ';
} 
$contents  = '<table style="width:100%;" >' ;
if($is_genrate == true){	
	 $contents .= '<tr><td align="right" colspan="2"><u><b>';
	 $contents .= $post_data['post_type'];
	 $contents .= '</b></u></td></tr>';
}else{
	  $contents .= '<tr><td align="right"  colspan="2"><u><b>';
	  $contents .= '<input name="post_type" placeholder=""  value="परिशिष्ट - 1"  size="30"  type="text" /></td></tr>' ;
	  $contents .= '</b></u></td></tr>';
}
$contents .= '<tr><td align="center"  colspan="2"><h4><u><b>'.$dept_name.'</b></u></h4></td></tr>';


$contents .= '<tr><td> क्रमांक  13/'.$panji_krmank.'/'.date('Y').'-'.date('y  ', strtotime('+1 years')).'/21-बजट </td><td align="right">भोपाल , दिनांक ';
if($is_genrate == true){
	 $contents .= $post_data['order_date'];
}
else{
	 $contents .= '<input name="order_date" type="text" />' ;
}
$contents .= '<select name="month" >';
foreach($months as $mm ){
$contents .= '<option>'.$mm.'</option>';	
}
$contents .= '</select>';
$contents .= ','.date('Y').'</td></tr>';
$contents .= '<tr><td  colspan="2"><table width="100%"  id="budget_again"  class="budget_again" style="overflow:auto;"><thead>';
$contents .= '<tr><td colspan="7" align="center" style="border:1px solid #000" >उन शीर्षों का अनुमान जो बढ़ाया जाना प्रस्तावित हैं |</td><td style="border:1px solid #000"  colspan="7" align="center" >उन शीर्षों का अनुमान जो कम किया जाना प्रस्तावित हैं | </td></tr>';
$contents .= '<tr><td align="center" style="border:1px solid #000"> बजट शीर्ष </td>';
$contents .= '<td align="center" style="border:1px solid #000" > वर्ष   '.date('Y').'-'.date('Y', strtotime('+1 years')).' हेतु स्वीकृत प्रावधान</td>';
$contents .= '<td  align="center" style="border:1px solid #000" >माह ';
$contents .= '<select name="month" >';
foreach($months as $mm ){
	
$contents .= '<option>'.$mm.'</option>';	

}
$contents .= '</select>';
$contents .= date('Y').' तक का व्यय </td>';
$contents .= '<td align="center" style="border:1px solid #000" >माह मार्च '.date('Y', strtotime('+1 years')).'तक का अनुमानित व्यय </td>';
$contents .= '<td align="center" style="border:1px solid #000" >वर्ष '.date('Y').'-'.date('Y', strtotime('+1 years')).' हेतु कुल व्यय </td>';
$contents .= '<td align="center" style="border:1px solid #000" >पुनर्विनियोजन दवारा अधिक राशि की पूर्ति </td>';
$contents .= '<td align="center" style="border:1px solid #000" >अधिक मांग के कारण </td>';
$contents .= '<td align="center" style="border:1px solid #000" >बजट शीर्ष </td>';
$contents .= '<td align="center" style="border:1px solid #000" >वर्ष   '.date('Y').'-'.date('Y', strtotime('+1 years')).' हेतु स्वीकृत प्रावधान </td>';
$contents .= '<td align="center" style="border:1px solid #000" >माह ' ;
$contents .= '<select name="month" >';
foreach($months as $mm ){
$contents .= '<option>'.$mm.'</option>';	
}
$contents .= '</select>';
$contents .= date('Y').' तक का व्यय </td>';
$contents .= '<td align="center" style="border:1px solid #000" > माह मार्च '.date('Y', strtotime('+1 years')).'तक का अनुमानित व्यय </td>';
$contents .= '<td align="center" style="border:1px solid #000" >वर्ष '.date('Y').'-'.date('Y', strtotime('+1 years')).' हेतु कुल व्यय  </td>';
$contents .= '<td align="center" style="border:1px solid #000" >पुनर्विनियोजन हेतु उपलब्ध राशि</td>';
$contents .= '<td  align="center" style="border:1px solid #000" >बचत के कारण</td></tr>';
$contents .= '<tr><td  align="center" style="border:1px solid #000"  >1</td><td  align="center" style="border:1px solid #000" >2</td  align="center" style="border:1px solid #000" ><td  align="center" style="border:1px solid #000" >3</td><td  align="center" style="border:1px solid #000" >4</td><td  align="center" style="border:1px solid #000" >5</td><td  align="center" style="border:1px solid #000" >6</td><td  align="center" style="border:1px solid #000" >7</td><td  align="center" style="border:1px solid #000" >8</td><td  align="center" style="border:1px solid #000" >9</td><td  align="center" style="border:1px solid #000" >10</td><td  align="center" style="border:1px solid #000" >11 </td><td  align="center" style="border:1px solid #000" >12</td><td  align="center" style="border:1px solid #000" >13 </td><td  align="center" style="border:1px solid #000" > 14</td></tr> </thead><tbody>';
    if($is_genrate == true){
		$total_row = count($post_data["input0"]);	
		for($i = 0; $i < $total_row; $i++){
				$_i = $i + 1;
			if(!empty($post_data["input0"][$i])){
				$contents .= '<tr  style="border:#666666 1px solid">
				<td style="border:#666666 1px solid">'.$post_data["input0"][$i].'</td>
				<td style="border:#666666 1px solid">'.$post_data["input1"][$i].'</td>
				<td style="border:#666666 1px solid">'.$post_data["input2"][$i].'</td>
				<td style="border:#666666 1px solid">'.$post_data["input3"][$i].'</td>
				<td style="border:#666666 1px solid">'.$post_data["input4"][$i].'</td>
				<td style="border:#666666 1px solid">'.$post_data["input5"][$i].'</td>
				<td style="border:#666666 1px solid">'.$post_data["input6"][$i].'</td>
				<td style="border:#666666 1px solid">'.$post_data["input7"][$i].'</td>
				<td style="border:#666666 1px solid">'.$post_data["input8"][$i].'</td>
				<td style="border:#666666 1px solid">'.$post_data["input9"][$i].'</td>
				<td style="border:#666666 1px solid">'.$post_data["input10"][$i].'</td>
				<td style="border:#666666 1px solid">'.$post_data["input11"][$i].'</td>
				<td style="border:#666666 1px solid">'.$post_data["input12"][$i].'</td>
				<td style="border:#666666 1px solid">'.$post_data["input13"][$i].'</td>
				<td style="border:#666666 1px solid">'.$post_data["input14"][$i].'</td>
				</tr>  ';
			}
		}
    }else{
$contents .= '<tr><td align="center" style="border:1px solid #000">';

 $contents .= '<textarea cols="10" rows="7" name="input0[]"  >मांग संख्या 29 मुख्य  लेखाशीर्ष 2014 - न्याय प्रशासन- लाघुशीर्ष-(114) - विधि सलाहकार और परामर्शदाता कांसिल (6251)- उच्च न्यायलय / उच्चतम न्यायालयों के अभिभाषको की फीस एवं अन्य भुगतान विस्तृत शीर्ष :- <u> 31- व्यवसायिक सेवाओं हेतु अदा. 010- अन्य (  मतदेय)</textarea>';

$contents .= '</u></td>';
$contents .= '<td align="center" style="border:1px solid #000" > ';
$contents .= '<input name="input1[]"   value="" size="5"  type="text" />';
$contents .= '</td>';
$contents .= '<td  align="center" style="border:1px solid #000" >';
$contents .= '<input name="input2[]"   value="" size="5"  type="text" />';
$contents .= '</td>';
$contents .= '<td align="center" style="border:1px solid #000" >';
$contents .= '<input name="input3[]"   value="" size="5"  type="text" />';
$contents .= '</td>';
$contents .= '<td align="center" style="border:1px solid #000" >';
$contents .= '<input name="input4[]"   value="" size="5"  type="text" />';
$contents .= '</td>';
$contents .= '<td align="center" style="border:1px solid #000" >';
$contents .= '<input name="input5[]"   value="" size="5"  type="text" />';
$contents .= '</td>';
$contents .= '<td align="center" style="border:1px solid #000" >';
$contents .= '<input name="input6[]"   value="" size="5"  type="text" />';
$contents .= '</td>';
$contents .= '<td align="center" style="border:1px solid #000" >वर्ष 2015-16 में प्रावधान कम  होने के कारण | </td>';
$contents .= '<td align="center" style="border:1px solid #000" > ';
$contents .= '<textarea cols="10" rows="7"  name="input7[]"   />मांग संख्या 29 मुख्य लेखाशीर्ष 2014 - न्याय प्रशासन- लाघुशीर्ष-(114) - विधि सलाहकार और परामर्शदाता कांसिल (6251)- उच्च न्यायलय / उच्चतम न्यायालयों के अभिभाषको की फीस एवं अन्य भुगतान विस्तृत शीर्ष :- <u> 31- व्यवसायिक सेवाओं हेतु अदा.</u> 003- अन्य ( मतदेय)" </textarea>';
$contents .= '</td>';
$contents .= '<td align="center" style="border:1px solid #000" >';
$contents .= '<input name="input8[]"   value="" size="5"  type="text" />';

 $contents .= '</td>';
$contents .= '<td align="center" style="border:1px solid #000" >';
 $contents .= '<input name="input9[]"   value="" size="5"  type="text" />';
 $contents .= '</td>';
$contents .= '<td align="center" style="border:1px solid #000" >';
$contents .= '<input name="input10[]"   value="" size="5"  type="text" />';
$contents .= '</td>';
$contents .= '<td align="center" style="border:1px solid #000" >';
$contents .= '<input name="input11[]"   value="" size="5"  type="text" />';
$contents .= '</td>';
$contents .= '<td align="center" style="border:1px solid #000" >वर्ष 2015-16 में व्यय न होने के कारण | </td></tr>';
 }
$contents .=  '  <tr style="border:#666666 1px solid"><td colspan="14"><input type="hidden" value=""
name="total_row" class="total_row"><input type="button" onClick="return addrow_budget(); " id="addrowo_budget" value="Add Row" /></td> </tr></tbody>';
$contents .= '<tfoot><tr><td align="center" style="border:1px solid #000"> योग </td>';
$contents .= '<td align="center" style="border:1px solid #000" > ';
if($is_genrate == true){
 $contents .= $post_data['accepted_provision_1'] ;	
}else{
 $contents .= '<input name="accepted_provision_1" class="accepted_provision_1"   value="" size="5"  type="text" />';
}
$contents .= '</td>';
$contents .= '<td  align="center" style="border:1px solid #000" >';
if($is_genrate == true){
 $contents .= $post_data['accepted_provision_2'] ;	
}else{
 $contents .= '<input name="accepted_provision_2" class="accepted_provision_2"    value="" size="5"  type="text" />';
}
$contents .= '</td>';
$contents .= '<td align="center" style="border:1px solid #000" >';
if($is_genrate == true){
 $contents .= $post_data['accepted_provision_3'] ;	
}else{
 $contents .= '<input name="accepted_provision_3" class="accepted_provision_3"   value="" size="5"  type="text" />';
}
$contents .= '</td>';
$contents .= '<td align="center" style="border:1px solid #000" >';
if($is_genrate == true){
 $contents .= $post_data['accepted_provision_4'] ;	
}else{
 $contents .= '<input name="accepted_provision_4" class="accepted_provision_4"   value="" size="5"  type="text" />';
}
 $contents .= '</td>';
$contents .= '<td align="center" style="border:1px solid #000" >';
if($is_genrate == true){
 $contents .= $post_data['accepted_provision_5'] ;	
}else{
 $contents .= '<input name="accepted_provision_5" class="accepted_provision_5"   value="" size="5"  type="text" />';
}
 $contents .= '</td>';
$contents .= '<td align="center" style="border:1px solid #000" >';
if($is_genrate == true){
 $contents .= $post_data['accepted_provision_6'] ;	
}else{
 $contents .= '<input name="accepted_provision_6" class="accepted_provision_6"   value="" size="5"  type="text" />';
}
 $contents .= '</td>';
$contents .= '<td align="center" style="border:1px solid #000" > </td>';
$contents .= '<td align="center" style="border:1px solid #000" ></td>';
$contents .= '<td align="center" style="border:1px solid #000" >';
if($is_genrate == true){
 $contents .= $post_data['accepted_provision_8'] ;	
}else{
 $contents .= '<input name="accepted_provision_8" class="accepted_provision_8"   value="" size="5"  type="text" />';
}
 $contents .= '</td>';
$contents .= '<td align="center" style="border:1px solid #000" >';
if($is_genrate == true){
 $contents .= $post_data['accepted_provision_9'] ;	
}else{
 $contents .= '<input name="accepted_provision_9" class="accepted_provision_9"   value="" size="5"  type="text" />';
}
 $contents .= '</td>';
$contents .= '<td align="center" style="border:1px solid #000" >';
if($is_genrate == true){
 $contents .= $post_data['accepted_provision_10'] ;	
}else{
 $contents .= '<input name="accepted_provision_10" class="accepted_provision_10"   value="" size="5"  type="text" />';
}
 $contents .= '</td>';
$contents .= '<td align="center" style="border:1px solid #000" >';
if($is_genrate == true){
 $contents .= $post_data['accepted_provision_11'] ;	
}else{
 $contents .= '<input name="accepted_provision_11" class="accepted_provision_11"   value="" size="5"  type="text" />';
}
 $contents .= '</td>';
$contents .= '<td align="center" style="border:1px solid #000"></td>';

$contents .= ' </tfoot></table></td></tr>';
$contents .= '<tr><td colspan="2">"प्रमाणित किया जाता है कि उक्त पुनर्विनियोजन प्रतिबंधित श्रेणी में नहीं आता है और इसमें राज्य शासन दवारा निर्धारित किसी भी शर्त  का उल्लंघन नही किया गया है | "</td></tr>';
$contents .= '<tr><td colspan="2">यह पुनर्विनियोजन आदेश वित्त विभाग के यू. ओ. क्रमांक ';
if($is_genrate == true){
	 $contents .= $post_data['uo_latter_no'];
}
else{
	 $contents .= '<input name="uo_latter_no" placeholder=""  value="'.$file_uo_or_letter_no.'"  type="text" />' ;
}

$contents .= ' दिनांक ';
if($is_genrate == true){
	 $contents .= $post_data['uo_latter_date'];
}
else{
	 $contents .= '<input name="uo_latter_date" placeholder="" class="date1"   value="'.$file_uo_or_letter_date.'"  type="text" />' ;
}

$contents .= ' दवारा दी गई सहमती से जारी किया जा रहा है |  </td></tr>';



$contents .= '<tr><td  colspan="2">&nbsp;</td></tr>';

$contents .= '<tr ><td align="right" colspan="2" >';
if($is_genrate == true){
	 $contents .= $post_data['adeshnadar'];
}
else{
	 $contents .= '<input name="adeshnadar" placeholder=""  size="100" value="मध्यप्रदेश के राज्यपाल के नाम से तथा आदेशानुसार,"  type="text" />' ;
}
$contents .= '</td></tr>';
//for signature
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right"  colspan="2"><div  style="width:50%; text-align:center;">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td  colspan="2" >&nbsp;</td></tr>';
}
$contents .= '<tr contenteditable="false"><td align="right"  colspan="2"><div style="width:50%; text-align:center;">(<b>';
if($is_genrate == true){	 
	$contents .= get_officer_information($this->input->post('sing_user')); 
}else{
	$contents .= get_officer_for_sign('sing_user' ,array(2,3,4,5,7,11) ,'', $us_id);
}
$contents .= '</b>)</div></td></tr>';
$contents .= '<tr contenteditable="false"><td align="right"  colspan="2"><div style="width:50%; text-align:center;">';
if($is_genrate == true){
	$contents .=   get_officer_dign($this->input->post('sing_user'));
}else{
	$contents .= '-------';
}
$contents .= '</div></td></tr>';
$contents .= '<tr><td align="right"  colspan="2" ><div style="width:50%; text-align:center;">'.$dept_name.'</div></td></tr>';

$contents .= '<tr><td>प्र. क्र. 13/'.$panji_krmank.'/'.date('Y').'-'.date('y  ', strtotime('+1 years')).'/21-बजट </td><td align="right">भोपाल , दिनांक ';
if($is_genrate == true){
	 $contents .= $post_data['order_date'];
}
else{
	 $contents .= '<input name="order_date" type="text" />' ;
}
$contents .= '<select name="month" >';
foreach($months as $mm ){
$contents .= '<option>'.$mm.'</option>';	
}
$contents .= '</select>';
$contents .= ','.date('Y').'</td></tr>';
 $contents .= '<tr><td align="" colspan="2">प्रतिलिपि :-</td></tr>';

$contents .= '<tr><td colspan="2">1. महालेखाकार ( लेखा एवं हकदारी ) प्रथम , मध्यप्रदेश ग्वालियर</td></tr>';
$contents .= '<tr><td colspan="2">2. प्रमुख सचिव, म. प्र. शासन वित्त विभाग बजट - 8, मंत्रालय भोपाल की ओर यू. ओ. क्रमांक ';
if($is_genrate == true){
	 $contents .= $post_data['uo_latter_no'];
}
else{
	 $contents .= '<input name="uo_latter_no" placeholder=""  value="'.$file_uo_or_letter_no.'"  type="text" />' ;
}

$contents .= ' दिनांक ';
if($is_genrate == true){
	 $contents .= $post_data['uo_latter_date'];
}
else{
	 $contents .= '<input name="uo_latter_date" placeholder="" class="date1"   value="'.$file_uo_or_letter_date.'"  type="text" />' ;
}
$contents .= ' के सन्दर्भ में, </td></tr>';
$contents .= '<tr><td colspan="2">3. आयुक्त कोष एवं लेखा  पर्यावास भवन भोपाल की ओर उपरोक्तानुसार रूपये ';
if($is_genrate == true){
	 $contents .= $post_data['above_amt'];
}
else{
	 $contents .= '<input name="above_amt" class="above_amt" placeholder=""  value=""  type="text" />' ;
}
$contents .= '/- का पुनर्विनियोजन सेन्ट्रल सर्वर में प्रविष्ट करने हेतु,</td></tr>';
$contents .= '<tr><td colspan="2">4. आहरण एवं संवितरण अधिकारी ,';
if($is_genrate == true){
	 $contents .= $post_data['lawdept_off'];
}
else{
$contents .= '<select name="lawdept_off"><option>विधि और विधायी कार्य विभाग </option><option>जबलपुर</option><option>इंदौर </option><option>ग्वालियर</option>';
$contents .= '</select>';
}
$contents .= ', भोपाल </td></tr>';
$contents .= '<tr><td colspan="2">5. वरिष्ठ  कोषालय अधिकारी, ';
if($is_genrate == true){
	 $contents .= $post_data['vindhyachal'];
}
else{
$contents .= '<select  name="vindhyachal"><option>विन्द्याचल भवन  कोषालय  </option><option>जबलपुर</option><option>इंदौर </option><option>ग्वालियर</option>';
$contents .= '</select>';
}
$contents .= ', भोपाल की ओर सूचनार्थ एवं आवश्यक कार्यवाही हेतु अग्रेषित | </td></tr>';



//for signature
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right" colspan="2" ><div  style="width:50%; text-align:center;">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td colspan="2">&nbsp;</td></tr>';
}
$contents .= '<tr><td align="right" colspan="2"><div style="width:50%; text-align:center;">(<b>';
if($is_genrate == true){
	$contents .=  get_officer_information($this->input->post('sing_user')); 
}else{
	$contents .= '-------';	
}
$contents .= '</b>)</div></td></tr>';
$contents .= '<tr><td align="right" colspan="2" ><div style="width:50%; text-align:center;">';
if($is_genrate == true){	
    $contents .=   get_officer_dign($this->input->post('sing_user'));
}else{
	$contents .= '-------';
}  
$contents .= '</div></td></tr>';
$contents .= '<tr><td align="right" colspan="2"><div style="width:50%; text-align:center;">'.$dept_name.'</div></td></tr>';
$contents .= '</table>';

