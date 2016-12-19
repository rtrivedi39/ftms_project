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

table#tbl_three_column, table#tbl_three_column1{
	border:1px solid;
}
table#tbl_three_column th, table#tbl_three_column1 th{
	text-align:center;
}

table#tbl_three_column > thead > tr > th, 
table#tbl_three_column > tbody > tr > th,
table#tbl_three_column > tfoot > tr > th,
table#tbl_three_column > thead > tr > td, 
table#tbl_three_column > tbody > tr > td,
table#tbl_three_column > tfoot > tr > td,
table#tbl_three_column1 > thead > tr > th, 
table#tbl_three_column1 > tbody > tr > th,
table#tbl_three_column1 > tfoot > tr > th,
table#tbl_three_column1 > thead > tr > td, 
table#tbl_three_column1 > tbody > tr > td,
table#tbl_three_column1 > tfoot > tr > td{
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
$contents  .= '<tr><td><p>फा.क्रमांक 17(ई) 44/2013/21-ब(एक)/'.$file_number.'/'.date("Y").' , - राष्ट्रीय अन्वेषण अभिकरण अधिनियम, 2008 (2008 का 34) की धारा 22 की उपधारा (1) द्वारा प्रदत्त शक्तियों को प्रयोग में लाते हुए, राज्य शासन, एतद्द्वारा, मध्यप्रदेश उच्च न्यायालय के परामर्ष से, इस विभाग की अधिसूचना फा.क्रमांक ब(1)3476-2013,दिनांक 11 सितम्बर, 2013 में, जो मध्यप्रदेश राजपत्र भाग-एक में दिनांक 20 सितम्बर,2013 को प्रकाशित हुई थी, निम्नलिखित संशोधन करता है,अर्थात्ः-</p></td></tr>';
$contents  .= '<tr><td align="center"><h3><u>संशोधन</u></h3></td></tr>';
$contents  .= '<tr><td><p class="intent_p">उक्त अधिसूचना में, सारणी में, अनुक्रमांक        ';
if($is_genrate == true){
	   $contents .= '<b>'.$post_data['anukranank'].'</b>';
}else{
	$contents .= '<input name="anukranank" placeholder="क्रमांक "    type="text" />' ;
} 
$contents .= '  तथा उनसे संबंधित प्रविष्टियों के स्थान पर, निम्नलिखित अनुक्रमांक तथा उनसे संबंधित प्रविष्टियाँ स्थापित की जाएं, अर्थात:-</p></td></tr>';
$contents  .= '<tr><td align="center"><h3><u>सारणी</u></h3></td></tr>';
$contents .= '<tr><td align="center">
		<table width="100%" id="tbl_three_column" class="three_column" border="1px">
		<thead><tr>
		<th>क्रमांक </th>
		<th>जिले का नाम </th>
		<th>विशेष न्यायाधीष का नाम</th>
		</tr></thead>		
		<tbody><tr>
		<td align="center"><b>(1)</b></td>
		<td align="center"><b>(2)</b></td>
		<td align="center"><b>(3)</b></td>
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
			</tr>';
		}
	}	
}else{
	  $contents .= '<tr>
	  <td><input type="text" size="" class="" name="column_one[]"></td>
	  <td><input type="text" size="50" name="column_two[]"></td>
	  <td><input type="text" size="" name="column_three[]"></td>
	  </tr></tbody>';
	
}
if($is_genrate == false){
	$contents .= '<tfoot><tr><td colspan="6" style="text-align: left;">';
	$contents .= '<input type="button" id="addrow" value="Add Row" />';
	$contents .= '<input type="hidden" value="" name="total_row" class="total_row"></td></tr></tfoot>';
}

$contents .= '</table></td></tr>';
$contents  .= '<tr><td>&nbsp;</td></tr>';
$contents  .= '<tr><td align="center"><h3><u>NOTIFICATION</u></h3></td></tr>';
$contents  .= '<tr><td><p>F-No. 17(E)/44/2013/21-B(0ne)– '.$file_number.'/'.date("Y").' ,-In exercise of the powers conferred by sub-section (1) of section 22 of National Investigation Agency Act, 2008 (34 of 2008), the state Government In consultation with the High Court of Madhya Pradesh, hereby, makes the following amendment in this Department’s Notification F-No. B(1)3476-2013,  dated 11th September,2013, which was published in the Madhya pradesh Gazette, Part-1, dated 20th September, 2013, Namely:-</p></td></tr>';
$contents  .= '<tr><td align="center"><h3><u>Amendment</u></h3></td></tr>';
$contents  .= '<tr><td><p class="intent_p">In the said notification , in the  table, for serial number                ';
if($is_genrate == true){ 
	$contents .= '<b>'.$post_data['anukranank'].'</b>'; 
}else{
	$contents .= '-------' ;
} 
$contents .= ' and entries relating thereto, the following serial numbers and  entries relating  thereto shall be substituted, namely:-</p></td></tr>';

$contents .= '<tr><td align="center">
		<table width="100%" id="tbl_three_column1" class="three_column1" border="1px">
		<thead><tr>
		<th>S. No. </th>
		<th>Name of District </th>
		<th>Name and Designation of the Judge </th>
		</tr></thead>		
		<tbody><tr>
		<td align="center"><b>(1)</b></td>
		<td align="center"><b>(2)</b></td>
		<td align="center"><b>(3)</b></td>
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
			</tr>';
		}
	}	
}else{
	  $contents .= '<tr>
	  <td><input type="text" size="" class="" name="column_one1[]"></td>
	  <td><input type="text" size="50" name="column_two1[]"></td>
	  <td><input type="text" size="" name="column_three1[]"></td>
	  </tr></tbody>';
	
}
if($is_genrate == false){
	$contents .= '<tfoot><tr><td colspan="6" style="text-align: left;">';
	$contents .= '<input type="button" id="addrow1" value="Add Row" />';
	$contents .= '<input type="hidden" value="" name="total_row" class="total_row1"></td></tr></tfoot>';
}

$contents .= '</table></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
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
	 $contents .= '<input name="file_head" placeholder="file no" size="50" value="पृ.क्र. 17(ई)44/2013/21-ब(एक)    '.$file_number.'/'.date("Y").',"  type="text" />' ;
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
$contents .= 'रजिस्ट्रार जनरल, म.प्र. उच्च न्यायालय, जबलपुर,की ओर उनके ज्ञापन क्रमांक  ';
   if($is_genrate == true){
	   $contents .= '<b>'.$post_data['patra_no'].'</b>';
}else{
	$contents .= '<input name="patra_no" placeholder="पत्र क्रमांक "    type="text" />' ;
}    
$contents .= '  के संदर्भ में,';
$contents .= '</td></tr></td></tr></table>';
$contents .= '<tr><td><table width="100%"><tr><td width="10%" valign="top">2.</td><td width="*%" valign="top">';
$contents .= 'सचिव, भारत सरकार, गृह मंत्रालय,नार्थ ब्लाक, नई दिल्ली,';
$contents .= '</td></tr></td></tr></table>';
$contents .= '<tr><td><table width="100%"><tr><td width="10%" valign="top">3.</td><td width="*%" valign="top">';
$contents .= 'सचिव, म.प्र. शासन, गृह (पुलिस) विभाग मंत्रालय, भोपाल,';
$contents .= '</td></tr></td></tr></table>';
$contents .= '<tr><td><table width="100%"><tr><td width="10%" valign="top">4.</td><td width="*%" valign="top">';
 $contents .= 'जिला एवं सत्र न्यायाधीश,  ';
 if($is_genrate == true){
	 $contents .= '<b>'.$post_data['distict_name'].'</b>';
}else{
	$contents  .= get_distic_dd('distict_name');	
}
$contents .= ', म.प्र., की ओर सूचनार्थ प्रेषित।</td></tr></td></tr></table>';
$contents .= '<tr><td><table width="100%"><tr><td width="10%" valign="top">5.</td><td width="*%" valign="top">';
$contents .= 'उप नियंत्रक, शासन केन्द्रीय मुद्रणालय,भोपाल, <br/>
की ओर सूचनार्थ एवं ( म.प्र. राजपत्र भाग-एक के आगामी अंक में प्रकाशनार्थ प्रेषित। ,'; 
$contents .= '</td></tr></td></tr></table>';
$contents .= '<tr><td><table width="100%"><tr><td width="10%" valign="top">6.</td><td width="*%" valign="top">';
$contents .= 'शाखा प्रभारी, आय.टी.शाखा,विधि और विधायी कार्य विभाग,भोपाल की ओर अधिसूचना की प्रति नेट पर अपलोड़ करने बाबत प्रेषित।';
$contents .= '</td></tr></td></tr></table>';


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


                
                
        
                  
                
               
                