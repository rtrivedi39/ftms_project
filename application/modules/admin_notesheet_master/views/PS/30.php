
<?php 
$contents  = '' ;
$contents .= '<tr><td><div style="margin-top:10px;"><span style="margin-left:10%;"> प्राप्त समंस में साक्ष्य हेतु उपस्थिति बाबत |</span></div></td></tr>';
$contents .= '<tr><td align="center">------0-------</td></tr>';
$contents .= '<tr><td align="center">&nbsp;</td></tr>';
$contents .= '<tr><td><div style="float:left; margin-left:10%;">पंजी क्र0 '.$file_number. ' से ' .'/'.date("Y").'/21-क(अभि )</div></td></tr>';
$contents .= '<tr><td align="center">------0-------</td></tr>';
$contents .= '<tr><td align="center">&nbsp;</td></tr>';
$contents .= '<tr><td><div style="float:left; margin-left:10%;">कृपया प्राप्त समंस का अवलोकन हो । </div></td></tr>';
$contents .= '<tr><td align="center">&nbsp;</td></tr>';
$contents .= '<tr><td align="center">
		<table id="procetion" class="procetion gridtable" width="80%"  style="font-size:13px;">
		<thead><tr><td>क्रमांक </td>
		<td align="center">स्थान</td>
		<td  align="center">पेशी</td>
		<td align="center">आरोपी</td>
		<td align="center">वि. प्र.क्र.</td>
		</tr></thead>';
		
if($is_genrate == true){
	
	$total_row = count($post_data['anukrmank']);
	for($i = 0; $i < $total_row; $i++){
		if(isset($post_data['anukrmank'][$i]) && $post_data['anukrmank'][$i] != ''){
			$contents .= '<tr><td align="center">'.$post_data['anukrmank'][$i].'</td><td align="center">'.$post_data['place'][$i].'</td><td align="center">'.$post_data['case'][$i].'</td><td align="center">'.$post_data['crimnal'][$i].'</td><td align="center">'.$post_data['vp_no'][$i].'</td>';
			
		}
	}
	
}
else{
	  $contents .= '<tbody><tr><td><input type="text" name="anukrmank[]"  value="1" size="10"></td>
	  <td><input type="text"  name="place[]" ></td>
	  <td><input type="text" name="case[]"></td>
	  <td><input type="text" name="crimnal[]"></td>
	  <td><input type="text" name="vp_no[]"></td>
	 
	  
	  </tr></tbody>';
	
}
if($is_genrate == false){
	$contents .= '<tfoot><tr><td colspan="7" style="text-align: left;">';
	$contents .= '<input type="button" id="addrow" value="Add Row" />';
	$contents .= '<input type="hidden" value="" name="total_row" class="total_row"></td></tr></tfoot>';
}

$contents .= '</table></td></tr>';


$contents .= '<tr><td><p>उपरोक्त विषयक प्राप्त समंस के पालन में उक्त  दिनांक को माननीय न्यायालय में साक्ष्य  पर उपस्थित होने के लिए कर्मचारी का नाम  अंकित किए जाने हेतु नस्ती आदेशार्थ प्रस्तुत |</p></td></tr>';


$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td></td></tr>';
if($this->uri->segment(6) == 'p' || $this->uri->segment(7) == 'p'){
$contents .= '<tr><td>&nbsp;</div></td></tr>';
$contents .= '<tr><td><u>अनु0 अधि0</u></td></tr>';


$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>अवर सचिव</u></td></tr>';

}

//print content
//echo $contents;
?>   

