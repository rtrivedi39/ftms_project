<?php
$contents  = '' ;
$contents  .= '<tr><td><div style="margin-top:12px;"><span style="margin-left:10%;" >'.@$file_subject .'</span></td></tr>';
$contents  .= '<tr><td align="center">-----00-----</td></tr>';

$contents  .= '<tr><td><div style="text-decoration:underline; font-weight:bold"><div style="float:left"><u>पंजी क्रमांक  - '.@$file_number.'/21- क (आप.),</div><div style="float:right"> दिनांक '.date("d-m-Y").'</u></div></div> </td></tr>';
$contents  .= '<tr><td><p>कृपया श्री ';
if($is_genrate == true){
	$contents .= $post_data['price_only'];
	}
else{
	$contents .=  '<input type="text" name="price_only" />';
}
$contents  .= ', वरिष्ठ अधिवक्ता, उच्चम न्यायालय, नई दिल्ली के देयकों का अवलोकन करने का कष्ट करें ।</td></tr>';
$contents  .= '<tr><td><p>श्री ';
if($is_genrate == true){
	$contents .= $post_data['advocates'];
	}
else{
	$contents .=  '<input type="text" name="advocates" />';
}
$contents  .= ' वरिष्ठ अधिवक्ता, उच्चतम न्यायालय द्वारा मूलत: देयक श्री सौरभ मिश्रा, स्थाई अधिवक्ता, विधि, नई दिल्ली को प्रस्तुत किये गये थे । स्थाई अधिवक्ता, विधि, नई दिल्ली द्वारा मूलत: देयकों को सत्यापित कर, इस विभाग को भुगतान हेतु प्रेषित किये गये है, जो निम्नानुसार है :-</p></td></tr>';



$contents .= '<tr><td align="center">
		<table id="fee_notesheet" class="fee_notesheet gridtable" border="1px" style="font-size:13px;">
		<thead><tr><td> क्रमांक </td>
		<td>दिनांक</td>
		<td>प्रकरण क्रमांक एवं नाम</td>
		<td>चाही गई राशि </td>
		<td>आदेशानुसार दी जाने वाली राशि</td></tr></thead>';
		
if($is_genrate == true){
	
	$total_row = count($post_data['sr_no']);
	for($i = 0; $i < $total_row; $i++){
		if(isset($post_data['sr_no'][$i]) && $post_data['sr_no'][$i] != ''){
			$contents .= '<tr><td>'.$post_data['sr_no'][$i].'</td><td>'.$post_data['date'][$i].'</td><td>'.$post_data['prakran_no'][$i].'</td><td>'.$post_data['price'][$i].'</td><td>'.$post_data['order_price'][$i].'</td>';
			
		}
	}
	
}
else{
	  $contents .= '<tbody><tr><td><input type="text" value="1" name="sr_no[]"></td>
	  <td><input type="text"  name="date[]" class="date1" ></td>
	  <td><input type="text" name="prakran_no[]"></td>
	  <td><input type="text" name="price[]"></td>
	  <td><input type="text" name="order_price[]"></td>
	  </tr></tbody>';
	
}
if($is_genrate == false){
	$contents .= '<tfoot><tr><td colspan="5" style="text-align: left;">';
	$contents .= '<input type="button" id="addrow" value="Add Row" />';
	$contents .= '<input type="hidden" value="" name="total_row" class="total_row"></td></tr></tfoot>';
}

$contents .= '</table></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';

$contents .= '<tr><td><p>	श्री ';
if($is_genrate == true){
	$contents .= $post_data['advocates'];
	}
else{
	$contents .=  '<input type="text" name="advocates" />';
}
$contents .=  ', वरिष्ठ अधिवक्ता, उच्चतम न्यायालय, नई दिल्ली द्वारा दिनांक ';
if($is_genrate == true){
$contents .= ' '.$post_data['date1'];
}else
{
	$contents .=  '<input type="text" class="date1" name="date1" value="'.date('d-m-Y').'" placeholder="dd/mm/yyyy" />';
}
$contents .=  'से ';
if($is_genrate == true){
$contents .= ' '.$post_data['date2'];
}else
{
	$contents .=  '<input type="text" class="date1" name="date2" value="'.date('d-m-Y').'" placeholder="dd/mm/yyyy" />';
}
$contents .=  ' तक के कुल ';
if($is_genrate == true){
	$contents .= $post_data['total_1'];
	}
else{
	$contents .=  '<input type="text" name="total_1" />';
}
 $contents .=  ' तक के कुल ';
 if($is_genrate == true){
	$contents .= $post_data['total_1'];
	}
else{
	$contents .=  '<input type="text" name="total_1" />';
}
 $contents .=  ' देयक भुगतान हेतु प्रेषित किये गये है । उक्त सभी देयक आपराधिक प्रकरण से संबंधित है ।</p></td></tr>';
$contents .= '<tr><td><p>उपरोक्तानुसार प्रस्तुत देयकों का विधि विभाग द्वारा जारी आदेश क्रमांक 1(अ)1/07/21-ब (दो), दिनांक 06.03.2013 के अनुसार उचित प्रतीत होते है । (आदेश    पताका-"क") अवलोकनार्थ प्रस्तुत है ।';
$contents .= '</p></td></tr>';
$contents .= '<tr><td><p>अत: उन्हे उपरोक्तानुसार राशि रू. ';
if($is_genrate == true){
	$contents .= $post_data['price_above'];
	}
else{
	$contents .=  '<input type="text" name="price_above" />';
}
$contents .= ' /-  (रूपये ';
if($is_genrate == true){
	$contents .= $post_data['price_only'];
	}
else{
	$contents .=  '<input type="text" name="price_only" />';
}
$contents .=  ' मात्र) का भुगतान किया जाना प्रस्तावित है ।';
$contents .= '</p></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><p>आदेशार्थ ।</p></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
if($this->uri->segment(6) == 'p' || $this->uri->segment(7) == 'p'  ){
$contents .= '<tr><td><u>अनुभाग अधिकारी (आप.) </u></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>अवर सचिव,</u></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>वरिष्ठ लेखाधिकारी,</u></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>अतिरिक्त सचिव,</u></td></tr>';
}
$contents .= '<tr><td>&nbsp;</td></tr>';
?>

                
                
        
                  
                
               
                