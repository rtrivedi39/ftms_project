<?php
$contents  = '' ;
$contents .= '<tr><td colspan="2"  align="center"><div  class="" >
<span  class="shift-left">फोटोकॉपी  देयक का भुगतान किये जाने बावत |</span></div></td></tr>';
$contents .= '<tr><td align="left"><br />पंजी क्रमांक '.$panji_krmank.'/21-क(स्था),<br /></td><td align="right"><br /> दिनांक '.$file_mark_section_date.'<br /></td></tr>';
$contents .= '<tr><td align="center" colspan="2">&nbsp; &nbsp;---------------------------------------------&nbsp;&nbsp;</td></tr>';
$contents .= '<tr><td colspan="2" align="left"><p>&nbsp; उक्त  विषयक  कृपया  ';
if($is_genrate == true){
	$contents .= $post_data['enteeprise'];
}else
{
$contents .='<input type="text" name="enteeprise"  value="" placeholder=" नाम"/> ';
}

$contents .= 'द्वारा  माह  ';

if($is_genrate == true){
    $contents .= $post_data['month2'];
}else{
    $contents .= get_month('month2');
}


if($is_genrate == true){
	$contents .= "&nbsp; ".$post_data['year'];
}else
{
$contents .='<input type="text" name="year"  value="" placeholder="वर्ष"/>';
}
$contents .= '&nbsp;के फोटोकॉपी  देयक प्रस्तुत किया गया है, जिसका अवलोकन हो |</p></td></tr>';
$contents .= '<tr><td colspan="2"><div class="text-justify"><p>&nbsp; उपरोक्त देयक का मिलान विभाग द्वारा दिये गये पत्रक से किया गया ।</p> ';

$contents .= '</div></td></tr>';
$contents .= '<tr><td colspan="2"><div class="text-justify" ><p>&nbsp;  देयको का विवरण निम्नानुसार हैः-</p> </div></td></tr>';

$contents .= '<tr><td colspan="2"><div class="text-justify" ><p>&nbsp;  माह  ';

if($is_genrate == true){
    $contents .= $post_data['month1'];
}else{
    $contents .= get_month('month1');
}
if($is_genrate == true){
	$contents .= "&nbsp; ". $post_data['year2'];
}else
{
$contents .=' <input type="text" name="year2"  value="" placeholder="वर्ष"/>';
}
$contents .=' <br/>
<table width="100%" style="margin:0% auto;    width: 80%;
" border="1">
  <tr>
    <td style="border: 1px solid black;">क्रमांक</td>
    <td  style="border: 1px solid black;">पेपर साईज</td>
    <td  style="border: 1px solid black;">काॅपी संख्या	</td>
    <td  style="border: 1px solid black;">राशि रुपये </td>
  </tr>';
    if($is_genrate == true){
	$contents .='<tr>
     <td  style="border: 1px solid black;">1</td>
     <td  style="border: 1px solid black;">'.$post_data['peper1'].'</td>
     <td  style="border: 1px solid black;">'.$post_data['no1'].'</td>
     <td style="border: 1px solid black;">'.$post_data['amonut1'].'</td>
  </tr>';
}else
{
  $contents .='<tr>
    <td  style="border: 1px solid black;">1</td>
    <td  style="border: 1px solid black;"><input type="text" name="peper1"  value="" placeholder="पेपर साईज"/></td>
    <td  style="border: 1px solid black;"><input type="text" name="no1"  value="" placeholder="काॅपी संख्या"/></td>
    <td  style="border: 1px solid black;"><input type="text" name="amonut1" id="amonut1" onblur="totalval()"  value="0" placeholder="राशि रुपये"/></td>
  </tr>';
}
  if($is_genrate == true){
	$contents .='<tr>
     <td  style="border: 1px solid black;">2</td>
     <td  style="border: 1px solid black;">'.$post_data['peper2'].'</td>
     <td  style="border: 1px solid black;">'.$post_data['no2'].'</td>
     <td style="border: 1px solid black;">'.$post_data['amonut2'].'</td>
  </tr>';
}else
{
    $contents .='<tr>
     <td  style="border: 1px solid black;">2</td>
    <td  style="border: 1px solid black;"><input type="text" name="peper2"  value="" placeholder="पेपर साईज"/></td>
    <td  style="border: 1px solid black;"><input type="text" name="no2"  value="" placeholder="काॅपी संख्या"/></td>
    <td  style="border: 1px solid black;"><input type="text" name="amonut2" id="amonut2" onblur="totalval()"   value="0" placeholder="राशि रुपये"/></td>
  </tr>';
}  if($is_genrate == true){
	$contents .='<tr>
     <td  style="border: 1px solid black;">3</td>
     <td  style="border: 1px solid black;">'.$post_data['peper3'].'</td>
     <td  style="border: 1px solid black;">'.$post_data['no3'].'</td>
     <td  style="border: 1px solid black;">'.$post_data['amonut3'].'</td>
  </tr>';
}else
{
     $contents .='<tr>
 <td  style="border: 1px solid black;">3</td>
    <td  style="border: 1px solid black;"> <input type="text" name="peper3"  value="" placeholder="पेपर साईज"/></td>
    <td  style="border: 1px solid black;"><input type="text" name="no3"  value="" placeholder="काॅपी संख्या"/></td>
    <td  style="border: 1px solid black;"><input type="text" name="amonut3" id="amonut3" onblur="totalval()"   value="0" placeholder="राशि रुपये"/></td>
  </tr>';
  }if($is_genrate == true){
	$contents .='<tr>
  <tr>
      <td style="border: 1px solid black;" >&nbsp;</td>
      <td  style="border: 1px solid black;">&nbsp;</td>
      <td style="border: 1px solid black;">राशि</td>
     <td  style="border: 1px solid black;">'.$post_data['amonut0'].'</td>
  </tr><tr>
      <td  style="border: 1px solid black;">&nbsp;</td>
      <td  style="border: 1px solid black;">&nbsp;</td>
      <td  style="border: 1px solid black;">अर्थात राशि</td>
         <td  style="border: 1px solid black;">'.$post_data['amonut0'].'</td>  </tr>';
}else
{
   $contents .=' <tr>
      <td  style="border: 1px solid black;">&nbsp;</td>
      <td  style="border: 1px solid black;">&nbsp;</td>
      <td  style="border: 1px solid black;">राशि</td>
  <td><input id="t1amount1" onblur="totalval()"   value="0" placeholder="राशि रुपये"/></td>
    </tr>
	   <tr>
      <td  style="border: 1px solid black;">&nbsp;</td>
      <td  style="border: 1px solid black;">&nbsp;</td>
      <td  style="border: 1px solid black;">अर्थात राशि</td>
      <td  style="border: 1px solid black;"><input type="text" name="amonut0" id="t1amount1" onblur="totalval()"   value="0" placeholder="राशि रुपये"/></td>
    </tr>';
	
}
	$contents .='</table></p> </div></td></tr>';

$contents .= '<tr><td colspan="2"  align="left"><div class="text-justify" ><p>&nbsp; सूची
 से देयक में अंकित संख्‍या का मिलान किया गया है। जो सही है। अत: कुल राशि
 रू ';
if($is_genrate == true){
	$contents .= $post_data['amunt2234'];
}else
{
$contents .='<input type="text" name="amunt2234"  value="" placeholder="राशि रुपये"/>';
}
$contents .=' &nbsp;  में से &nbsp;  ';
if($is_genrate == true){
	$contents .= $post_data['pers'];
}else
{
$contents .='<input type="text" name="pers"  value="" placeholder="प्रतिशत की दर"/>';
}
$contents .='&nbsp;  प्रतिशत की दर से राशि रूपये ';
if($is_genrate == true){
	$contents .= $post_data['amoundd'];
}else
{
$contents .='<input type="text" name="amoundd"  value="" placeholder=" काटने की राशि "/>';
}
$contents .='&nbsp;  काटने के उपरांत
 शेष्‍ा राशि रूपये ';
 
 if($is_genrate == true){
	$contents .= $post_data['amounto'];
}else
{
$contents .='<input type="text" name="amounto"  value="" placeholder=" कुल राशि "/>';
}
$contents .='&nbsp;  का भुगतान संबंधित को किया जाना प्रस्‍तावित है।</p></div><br/></td></tr>';

$contents .= '</td></tr>';

 ?>

