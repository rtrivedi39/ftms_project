<style>
table#pitition_tbl{
	border:1px solid;
	
}
table#pitition_tbl > thead > tr > th, 
table#pitition_tbl > tbody > tr > th,
table#pitition_tbl > tfoot > tr > th,
table#pitition_tbl > thead > tr > td, 
table#pitition_tbl > tbody > tr > td,
table#pitition_tbl > tfoot > tr > td {
    border: 1px solid;
</style>
<?php 
$contents  = '' ;
$contents .= '<tr><td align="left"> <div style="margin-top:20px;"><span style="margin-left:10%;"> ';
if($is_genrate == true){
	$contents .= '<b> '.$post_data['name_advocate'].'</b>';
}else{
	$contents .=  '<input type="text" class="" name="name_advocate" value="" placeholder="नाम" required>';
}
$contents .= ', ';
if($is_genrate == true){
	$contents .= ' <b>'.$post_data['post_advocate'].'</b>';
}else{
	$contents .=  '<input type="text" class="" name="post_advocate" value="" placeholder="पद" required>';
}
$contents .= ', ';
if($is_genrate == true){
	$contents .= ' <b>'.$post_data['court_advocate'].'</b>';
}else{
	$contents .=  '<input type="text" class="" name="court_advocate" value="" placeholder="न्यायलय" required>';
}
$contents .= ', ';
if($is_genrate == true){
	$contents .= '<b> '.$post_data['location_advocate'].'</b>';
}else{
	$contents .=  '<input type="text" class="" name="location_advocate" value="" placeholder="लोकेशन" required>';
}
$contents .= '  के फीस देयकों के भुगतान बाबत्। </span></div></td></tr>';
$contents .= '<tr><td align="center">---------</td></tr>';

$contents .= '<tr><td><div style="float:left">  पंजी क्रमांक : '.$file_number.'/21-(या0),  </div><div  style="float:right">दिनांक ';
if($is_genrate == true){
     $contents .= ' '.get_date_formate($post_data['date1'],'d/m/Y');
}
else
{
    $contents .='<input type="text" class="date1" name="date1" placeholder="dd/mm/yyyy" value="'.$file_mark_section_date.'" />';
}
$contents .= '</div></td></tr>';
$contents .= '<tr><td><p>कृपया ';
if($is_genrate == true){
	$contents .= '<b> '.$post_data['name_advocate'].'</b>';
}else{
	$contents .=  '--------';
}
$contents .= ', ';
if($is_genrate == true){
	$contents .= '<b> '.$post_data['post_advocate'].'</b>';
}else{
	$contents .=  '---------';
}
$contents .= ', ';
if($is_genrate == true){
	$contents .= '<b> '.$post_data['court_advocate'].'</b>';
}else{
	$contents .=  '--------------';
}
$contents .= ', ';
if($is_genrate == true){
	$contents .= '<b> '.$post_data['location_advocate'].'</b>';
}else{
	$contents .=  '-----------------';
}
$contents .= '  से प्राप्त विचाराधीन देयकों का अवलोकन हो।</p></td></tr>';
$contents .= '<tr><td><p>';
if($is_genrate == true){
	$contents .= '<b> '.$post_data['name_advocate'].'</b>';
}else{
	$contents .=  '--------';
}
$contents .= ', ';
if($is_genrate == true){
	$contents .= '<b> '.$post_data['post_advocate'].'</b>';
}else{
	$contents .=  '---------';
}
$contents .= ',  ने  ';
if($is_genrate == true){
	$contents .= '<b> '.$post_data['court_advocate'].'</b>';
}else{
	$contents .=  '---------';
}
$contents .= ' में पैरवी उपरांत फीस के देयक इस विभाग में भुगतान हेतु प्रस्तुत ‍किये है। जिनका विवरण निम्मनानुसार है :-';
$contents .= '</p></td></tr>';
$contents .= '<tr><td align="center">
		<table id="pitition_tbl" class="petition" border="1px" style="font-size:13px;">
		<thead><tr>';
		if($is_genrate == true){
				$contents .= '<th>स.क्र</th>';
		}		
		$contents .= '<th>अनुक्रमांक दिनांक</th>
		<th>प्रकरण क्रमांक एवं नाम</th>
		<th>चाही गई राशि</th>
		<th>स्वीकृत राशि</th>
		<th>कुल राशि रूपये</th>
		</tr></thead>';
$grand_total = 0;		
if($is_genrate == true){
	$total = array(
		'want_price' => 0,
		'order_price' => 0,
		'total_price' => 0,
	);
	$total_row = count($post_data['anukrmank_date']);	
	for($i = 0; $i < $total_row; $i++){
		$_i = $i + 1;
		if(isset($post_data['anukrmank_date'][$i]) && $post_data['anukrmank_date'][$i] != ''){
			$contents .= '<tr><td align="center">'.$_i .'</td>
			<td>'.$post_data['anukrmank'][$i].' <br/>'.get_date_formate($post_data['anukrmank_date'][$i],'d/m/Y').'</td>
			<td>'.$post_data['name_pk'][$i].'</td>
			<td align="center">रू.  '.$post_data['want_price'][$i].'/-</td>
			<td align="center">रू.  '.$post_data['order_price'][$i].'/-</td>
			<td align="center">रू.  <b>'.$post_data['total_price'][$i].'/-</b></td>';
			$total['want_price'] = $total['want_price'] + $post_data['want_price'][$i];
			$total['order_price'] = $total['order_price'] + $post_data['order_price'][$i];
			$total['total_price'] = $total['total_price'] + $post_data['total_price'][$i];
		}
	}
	 $contents .= '<tr><td></td><td colspan="2" align="right">कुल राशि रूपये- </td>
	 <td align="center"><b>'.$total['want_price'].'/-</b></td>
	 <td align="center"><b>'.$total['order_price'].'/-</b></td>
	 <td align="center"><b>'.$total['total_price'].'/-</b></td></tr>';
	 $grand_total = $total['total_price'];
}else{
	  $contents .= '<tbody><tr><td><input type="text" class="" name="anukrmank[]"><br/><input type="text" class="date1" name="anukrmank_date[]"></td>
	  <td><textarea  name="name_pk[]" rows="5"  cols="20"></textarea></td>
	  <td><input type="text" name="want_price[]"></td>
	  <td><input type="text" name="order_price[]"></td>
	  <td><input type="text" name="total_price[]"></td>
	  </tr></tbody>';
	
}
if($is_genrate == false){
	$contents .= '<tfoot><tr><td colspan="6" style="text-align: left;">';
	$contents .= '<input type="button" id="addrow" value="Add Row" />';
	$contents .= '<input type="hidden" value="" name="total_row" class="total_row"></td></tr></tfoot>';
}

$contents .= '</table></td></tr>';
$contents .= '<tr><td><p>';
if($is_genrate == true){
	$contents .= '<b> '.$post_data['name_advocate'].'</b>';
}else{
	$contents .=  '--------';
}
$contents .= ', ';
if($is_genrate == true){
	$contents .= '<b> '.$post_data['post_advocate'].'</b>';
}else{
	$contents .=  '---------';
}
$contents .= ',  ने  ';
if($is_genrate == true){
	$contents .= '<b> '.$post_data['court_advocate'].'</b>';
}else{
	$contents .=  '---------';
}
$contents .= ', ';
if($is_genrate == true){
	$contents .= '<b> '.$post_data['location_advocate'].'</b>';
}else{
	$contents .=  '-----------------';
}
$contents .= ' द्वारा ';
if($is_genrate == true){
	$contents .= '<b> '.$post_data['samksha'].'</b>';
}else{
	$contents .=  '<input type="text" class="" name="samksha" value="उच्चतम न्यायालय " placeholder="उच्चतम न्यायालय" required>';
}
$contents .= '  में पैरवी उपरांत कुल राशि रूपये ';
if($is_genrate == true){
	$contents .= '<b> '.$grand_total.'</b>';
}else{
	$contents .=  '------------';
}
$contents .=  ' /- के भुगतान की मांग की गई है। आदेशानुसार दिये जाने वाली राशि रूपये ';
if($is_genrate == true){
	$contents .= '<b> '.$grand_total.'</b>';
}else{
	$contents .=  '-----------------';
} 
$contents .=  ' /- भुगतान योग्य है।';
$contents .= '</p></td></tr>';
$contents .= '<tr><td><p>अत:  ';
if($is_genrate == true){
	$contents .= '<b> '.$post_data['name_advocate'].'</b>';
}else{
	$contents .=  '--------';
}
$contents .= ', ';
if($is_genrate == true){
	$contents .= '<b> '.$post_data['post_advocate'].'</b>';
}else{
	$contents .=  '---------';
}
$contents .= ',  ने  ';
if($is_genrate == true){
	$contents .= '<b> '.$post_data['court_advocate'].'</b>';
}else{
	$contents .=  '---------';
}
$contents .= ', ';
if($is_genrate == true){
	$contents .= '<b> '.$post_data['location_advocate'].'</b>';
}else{
	$contents .=  '-----------------';
}
$contents .= ' के कुल  ';
if($is_genrate == true){
	$contents .= '<b> '.$post_data['deyask'].'</b>';
}else{
	$contents .=  '<input type="text" class="" name="deyask" value=""  placeholder="कुल देयक" required>';
}
$contents .= '  देयक मांग संख्या 29-2014 न्याय प्रशासन (114) कानूनी सलाहकार और परामर्शदाता 6251-31 व्यवसायिक सेवाओं के ‍लिए अदायगिया 003 अभिभाषको की फीस के अनुसार कुल राशि रूपये ';
if($is_genrate == true){
	$contents .= '<b> '.$grand_total.'</b>';
}else{
	$contents .=  '---------';
}
$contents .=  ' /-  (रूपये-  ';
if($is_genrate == true){
	$contents .= '<b> '.$post_data['price1'].'</b></span>';
}else{
	$contents .= ' <input type="text" name="price1" required>';
} 
$contents .=  ') केवल।  ';
if($is_genrate == true){
	$contents .= '<b> '.$post_data['name_advocate'].'</b>';
}else{
	$contents .=  '--------';
}
$contents .=  ' को फीस देयक भुगतान पेन कार्ड नं0  ';
if($is_genrate == true){
	$contents .= '<b> '.$post_data['pan_number'].'</b>';
}else{
	$contents .=  '<input type="text" name="pan_number" >';
}
$contents .=  ' के अनुसार आयकर अधिनियम, 1961 की धारा 194 जे के अनुसार  ';
if($is_genrate == true){
	$contents .= '<b> '.$post_data['tds'].'</b>';
}else{
	$contents .=  '<input type="text" name="tds" placeholder="TDS" >';
}
$contents .= ' % TDS कटोत्रा कर भुगतान की स्वीकृति हेतु आदेशार्थ प्रस्तुत है। </p></td></tr>';

if($this->uri->segment(6) == 'p' || $this->uri->segment(7) == 'p'  ){
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>अनुभाग अधिकारी (याचिका)</u></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>अवर सचिव (याचिका)</u></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>अति. सचिव (याचिका)</u></td></tr>';
}


?>

