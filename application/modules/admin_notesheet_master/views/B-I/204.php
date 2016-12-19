<style>
p{	
	text-indent:0px;
	text-align:justify;
	margin-bottom:15px;
}
p.intent_p{	
	text-indent:58px;
}
h3{
	font-weight:bold;
}
table#orders *{
	<?php	
	if($post_data['line_height'] != ''){
		echo 'line-height:'.$post_data['line_height'].'pt;';
	} else{
		echo 'line-height:17pt;'; 
	}
	if($post_data['font_size'] != ''){
		echo 'font-size:'.$post_data['font_size'].'pt;';
	} else{
		echo  'font-size:13pt;'; 
	}
	if($post_data['word_spacing'] != ''){
		echo 'word-spacing:'.$post_data['word_spacing'].'pt;';
	} else{
		//echo 'word-spacing:8pt;';
	}
	?>
}

table#tbl_four_column, table#tbl_four_column1{
	border:1px solid;
}
table#tbl_three_column th, table#tbl_three_column1 th{
	text-align:center;
}

table#tbl_four_column > thead > tr > th, 
table#tbl_four_column > tbody > tr > th,
table#tbl_four_column > tfoot > tr > th,
table#tbl_four_column > thead > tr > td, 
table#tbl_four_column > tbody > tr > td,
table#tbl_four_column > tfoot > tr > td,
table#tbl_four_column1 > thead > tr > th, 
table#tbl_four_column1 > tbody > tr > th,
table#tbl_four_column1 > tfoot > tr > th,
table#tbl_four_column1 > thead > tr > td, 
table#tbl_four_column1 > tbody > tr > td,
table#tbl_four_column1 > tfoot > tr > td{
    border: 1px solid;
}
table#orders td, table#orders th{
	vertical-align:top;
}
@page{
	margin:1in .6in .6in 1in;		
}
</style>
<?php
$contents   = '<table id="orders" style="width:100%;">' ;
$contents  .= '<tr><td align="center"><h3><u>'.@$dept_name.', भोपाल</u></h3></td></tr>';
$contents  .= '<tr><td align="center"><h3><u>अधिसूचना</u></h3></td></tr>';
$contents  .= '<tr><td align="right">भोपाल दिनांक ';
if($is_genrate == true){
	$contents .= $post_data['file_head_date'];
}else{
	$contents .=  '<input type="text" class="date1" name="file_head_date" value="'.date('d-m-Y').'" placeholder="dd/mm/yyyy" />';
}
$contents  .= '</td></tr>';
$contents  .= '<tr><td><p>फा.क्रमांक 17(ई)8-2012/21-ब(एक) '.$file_number.'/'.date("Y").'  , भ्रष्टाचार निवारण अधिनियम, 1988 (1988 का 49)की धारा 3 की उपधारा (1) के साथ पठित मध्यप्रदेष विषेष न्यायालय अधिनियम, 2011 (क्रमांक 8 सन् 2012) की धारा 3 की उपधारा (2) द्वारा प्रदत्त शक्तियों को प्रयोग में लाते हुए, राज्य षासन, मध्यप्रदेष उच्च न्यायालय की सहमति से, एतद्द्वारा, इस विभाग की अधिसूचना क्रमांक 17(ई)8-2012/इक्कीस-ब(एक), दिनांक 2 मार्च, 2012 में, जो मध्यप्रदेष राजपत्र (असाधारण) में दिनांक 2 मार्च, 2012 को प्रकाशित हुई थी, निम्नलिखित संशोधन करता है:- </p></td></tr>';
$contents  .= '<tr><td align="center"><h3><u>संशोधन</u></h3></td></tr>';
$contents  .= '<tr><td><p class="intent_p">सारणी में, अनुक्रमांक ';
if($is_genrate == true){
	   $contents .= '<b>'.$post_data['anukranank'].'</b>';
}else{
	$contents .= '<input name="anukranank" placeholder="क्रमांक "    type="text" />' ;
} 
$contents .= '  तथा उनसे संबंधित प्रविष्टियों के स्थान पर, निम्नलिखित अनुक्रमांक तथा उनसे संबंधित प्रविष्टियाँ स्थापित की जाएं:-</p></td></tr>';
$contents  .= '<tr><td align="center"><h3><u>अनुसूची</u></h3></td></tr>';
$contents .= '<tr><td align="center">
		<table width="100%" id="tbl_four_column" class="four_column" border="1px">
		<thead><tr>
		<th>अनुक्रमांक </th>
		<th>न्यायाधीश का नाम </th>
		<th>मध्यप्रदेश विशेष न्यायालय अधिनियम,2011 की धारा 3(1)के अधीन गठित विशेष न्यायालय का नाम </th>
		<th>मुख्यालय का नाम </th>	
		</tr></thead>		
		<tbody><tr>
		<td align="center"><b>(1)</b></td>
		<td align="center"><b>(2)</b></td>
		<td align="center"><b>(3)</b></td>
		<td align="center"><b>(4)</b></td>	
		</tr>';	
if($is_genrate == true){
	
	$total_row = count($post_data['column_one']);		
	for($i = 0; $i < $total_row; $i++){
		$_i = $i + 1;
		if(isset($post_data['column_one'][$i]) && $post_data['column_one'][$i] != ''){
			$contents .= '<tr>
			<td>'.$post_data['column_one'][$i].'</td>
			<td>'.$post_data['column_two'][$i].'</td>
			<td>'.$post_data['column_three'][$i].'</td>
			<td>'.$post_data['column_four'][$i].'</td>
			</tr>';
		}
	}	
}else{
	  $contents .= '<tr>
	  <td><input type="text" size="" class="" name="column_one[]"></td>
	  <td><input type="text" size="50" name="column_two[]"></td>
	  <td><input type="text" size="" name="column_three[]"></td>
	  <td><input type="text" size="" name="column_four[]"></td>
	  </tr></tbody>';
	
}
if($is_genrate == false){
	$contents .= '<tfoot><tr><td colspan="6" style="text-align: left;">';
	$contents .= '<input type="button" id="addrow" value="Add Row" />';
	$contents .= '<input type="hidden" value="" name="total_row" class="total_row"></td></tr></tfoot>';
}

$contents .= '</table></td></tr>';

$contents  .= '<tr><td align="center"></td></tr>';
$contents  .= '<tr><td align="center"><h3><u>NOTIFICATION</u></h3></td></tr>';
$contents  .= '<tr><td><p>F.No-17(E)8-2012-/21-B(1)– '.$file_number.'/'.date("Y").'  In exercise of the powers conferred by sub-section (2) of section 3 of the Madhya Pradesh Vishesh Nyayalya Adhiniyam, 2011, (No. 8 of 2012) read with sub section (1) of section 3 of the Prevention of Corruption Act, 1988 (No.49 of 1988),  the State Government, with the concurrence of the High Court of Madhya Pradesh, hereby, makes the following amendments in this departments Notification No. F.No. 17(E)8-2012-/XXI-B(One), dated 2nd March, 2012 which was published in the Madhya Pradesh Gazette (Extra-Ordinary) dated 2nd March, 2012:-</p></td></tr>';
$contents  .= '<tr><td align="center"><h3><u>Amendment</u></h3></td></tr>';
$contents  .= '<tr><td><p class="intent_p">For serial numbers ';
if($is_genrate == true){ 
	$contents .= '<b>'.$post_data['anukranank'].'</b>';
}else{
	$contents .= '-------' ;
} 
$contents .= ' and entries relating thereto, the following serial numbers and entries relating thereto shall be substituted:-</p></td></tr>';
$contents .= '<tr><td align="center">
		<table width="100%" id="tbl_four_column1" class="four_column1" border="1px">
		<thead><tr>
		<th>S. No. </th>
		<th>Name of Judge</th>
		<th>Name of special court constituted u/s 3(1)0f the Madhya Pradesh Vishesh Nyayalya Adhiniyam, 2011  </th>
		<th>head quarter</th>	
		</tr></thead>		
		<tbody><tr>
		<td align="center"><b>(1)</b></td>
	   <td align="center"><b>(2)</b></td>
		<td align="center"><b>(3)</b></td>
		<td align="center"><b>(4)</b></td>	
		</tr>';
if($is_genrate == true){
	
	$total_row = count($post_data['column_one1']);	
	for($i = 0; $i < $total_row; $i++){
		$_i = $i + 1;
		if(isset($post_data['column_one1'][$i]) && $post_data['column_one1'][$i] != ''){
			$contents .= '<tr>
			<td>'.$post_data['column_one1'][$i].'</td>
			<td>'.$post_data['column_two1'][$i].'</td>
			<td>'.$post_data['column_three1'][$i].'</td>
			<td>'.$post_data['column_four1'][$i].'</td>
			</tr>';
		}
	}	
}else{
	  $contents .= '<tr>
	  <td><input type="text" size="" class="" name="column_one1[]"></td>
	  <td><input type="text" size="50" name="column_two1[]"></td>
	  <td><input type="text" size="" name="column_three1[]"></td>
	  <td><input type="text" size="" name="column_four1[]"></td>
	  </tr></tbody>';
	
}
if($is_genrate == false){
	$contents .= '<tfoot><tr><td colspan="6" style="text-align: left;">';
	$contents .= '<input type="button" id="addrow1" value="Add Row" />';
	$contents .= '<input type="hidden" value="" name="total_row" class="total_row1"></td></tr></tfoot>';
}

$contents .= '</table></td></tr>';
$contents  .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td align="right">';
if($is_genrate == true){
	 $contents .= $post_data['adeshnadar'];
}
else{
	 $contents .= '<input name="adeshnadar" placeholder=""  size="100" value="मध्यप्रदेश के राज्यपाल के नाम से तथा आदेशानुसार,"  type="text" />' ;
}
$contents .= '</td></tr>';
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right"><div  style="width:70%; text-align:center;">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td>&nbsp;</td></tr>';
}
$contents .= '<tr><td align="right"><div style="width:70%; text-align:center;">(<b>';
if($is_genrate == true){	 
	$contents .= get_officer_information($this->input->post('sing_user')); 
}else{
	$contents .= get_officer_for_sign('sing_user' ,array(2,3,4,5,7) ,'', $us_id);
}
$contents .= '</b>)</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:70%; text-align:center;">';
if($is_genrate == true){
	$contents .=   get_officer_dign($this->input->post('sing_user'));
}else{
	$contents .= '-------';
}
$contents .= '</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:70%; text-align:center;">'.$dept_name.'</div></td></tr>';
$contents .= '<tr><td align=""><div style="height:50px;"></div></td></tr>';
$contents .= '<tr><td><div style="float:left">';
if($is_genrate == true){
	 $contents .= $post_data['file_head'];
}
else{
	 $contents .= '<input name="file_head" placeholder="file no" size="50" value="फा.क्र.1-2-90/21-ब(एक)'.$file_number.'/'.date("Y").',"  type="text" />' ;
}
$contents .= '</div><div style="float:right;">';
$contents .= 'भोपाल, दिनांक ';
if($is_genrate == true){
	 $contents .= $post_data['file_head_date'];
}
else{
	 $contents .= '----------' ;
}
$contents .= '</div></td></tr>';

//for pratilipit
$contents .= '<tr><td align="">प्रतिलिपि :-</td></tr>';
$contents .= '<tr><td><table width="100%"><tr><td width="10%" valign="top">1.</td><td width="*%" valign="top">';
$contents .= 'रजिस्ट्रार जनरल, मध्यप्रदेश उच्च न्यायालय, जबलपुर, के पत्र क्र.  ';
   if($is_genrate == true){
	   $contents .= '<b>'.$post_data['patra_no'].'</b>';
}else{
	$contents .= '<input name="patra_no" placeholder="पत्र क्रमांक "    type="text" />' ;
}    
$contents .= '  के संदर्भ में,';
$contents .= '</td></tr></td></tr></table>';
$contents .= '<tr><td><table width="100%"><tr><td width="10%" valign="top">2.</td><td width="*%" valign="top">';
 $contents .= 'जिला एवं सत्र न्यायाधीश,  ';
 if($is_genrate == true){
	 $contents .= '<b>'.$post_data['distict_name'].'</b>';
}else{
	$contents  .= get_distic_dd('distict_name');	
}
$contents .= ', (म.प्र.),</td></tr></td></tr></table>';
$contents .= '<tr><td><table width="100%"><tr><td width="10%" valign="top">3.</td><td width="*%" valign="top">';
$contents .= 'उप नियंत्रक, केन्द्रीय मुद्रणालय, म.प्र. (राज पत्र भाग-1) में प्रकाशनार्थ प्रेषित , ';
$contents .= '</td></tr></td></tr></table>';
$contents .= '<tr><td><p>की ओर सूचनार्थ एवं आवश्यक कार्यवाही हेतु प्रेषित। ';
$contents .= '</p></td></tr>';


//for signature
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right"><div  style="width:70%; text-align:center;">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td>&nbsp;</td></tr>';
}
$contents .= '<tr><td align="right"><div style="width:70%; text-align:center;">(<b>';
if($is_genrate == true){
	$contents .=  get_officer_information($this->input->post('sing_user')); 
}else{
	$contents .= '-------';	
}
$contents .= '</b>)</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:70%; text-align:center;">';
if($is_genrate == true){	
    $contents .=   get_officer_dign($this->input->post('sing_user'));
}else{
	$contents .= '-------';
}  
$contents .= '</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:70%; text-align:center;">'.$dept_name.'</div></td></tr>';
$contents .= '</table>';

?>


                
                
        
                  
                
               
                