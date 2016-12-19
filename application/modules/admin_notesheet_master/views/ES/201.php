<?php
$contents  = '' ;
$contents .= '<tr><td colspan="2"><div class="text-justify shift-left" >कार्यालयीन/निवास टेलीफोन देयकों का भुगतान किये जाने  ';

$contents .='</div></td></tr>';
$contents .= '<tr><td align="left"><div class="text-justify shift-left" ><br />पंजी क्रमांक '.$panji_krmank.'/21- अ(स्था),<br /></td>
<td align="right"><br /> दिनांक '.$file_mark_section_date.'<br /></div></td></tr>';
$contents .= '<tr><td align="center" colspan="2">&nbsp; &nbsp;---------------------------------------------&nbsp;&nbsp;</td></tr>';
$contents .= '<tr><td colspan="2" align="left"><p class="text-justify shift-left">&nbsp;	कृपया प्रस्तुत देयकों का अवलोकन करना चाहेंगे।</p></td></tr>';
$contents .= '<tr><td colspan="2"><div class="text-justify shift-left"><p>&nbsp; ';


$contents .='मध्यप्रदेश शासन विधि एवं विधायी कार्य विभाग भोपाल में पदस्थ अधिकारियों के कार्यालय स्थित दूरभाष के देयकों का भुगतान मध्यप्रदेश शासन, वित्त विभाग के परिपत्र क्रमांक';
   if($is_genrate == true)
	{
		
	$contents .= $post_data['rule'];
}else
{
$contents .='<input type="text" name="rule"  value="" placeholder="नियम "/> ';
}
 $contents .=' , दिनांक ';  
 if($is_genrate == true)
	{
	$contents .= $post_data['date1'];
}else
{

$contents .= '<input type="text" name="date1" class="date1" value="" placeholder="दिनांक "/>';
}
$contents .= ' तथा निवास पर स्थापित दूरभाष/मोबाईल सुविधा परिपत्र एफ 11-13/2015/नियम/चार, दिनांक ';
 if($is_genrate == true)
	{
	$contents .= $post_data['date2'];
}else
{

$contents .= '<input type="text" name="date2" class="date1" value="" placeholder="दिनांक "/> ';
}
$contents .= 'द्वारा निर्धारित पात्रता अनुसार दिनांक ';
 if($is_genrate == true)
	{
	$contents .= $post_data['date3'];
}else
{
$contents .= '<input type="text" name="date3" class="date1" value="" placeholder="दिनांक "/>';
}
$contents .= 'से';
if($is_genrate == true)
	{
	$contents .= $post_data['date4'];
}else
{
$contents .= '<input type="text" name="date4" class="date1" value="" placeholder="दिनांक "/>';
}
$contents .= ' तक के भुगतान हेतु प्रस्तुत देयक जो निम्नानुसार है:- </p> ';

$contents .= '</div></td></tr>';
$contents .= '<tr><td colspan="2"><div class="text-justify shift-left"><table width="100%" border="1">
    <tr>
    <td style="border:#666666 1px solid">स.क्रंO</td>
    <td style="border:#666666 1px solid">अधिकारियों के नाम</td>
    <td style="border:#666666 1px solid">दूरभाष</td>
    <td style="border:#666666 1px solid">राशि</td>
    <td style="border:#666666 1px solid">पात्रता	 </td>
    <td style="border:#666666 1px solid">पात्रता से अधिक वसूली </td>
    <td style="border:#666666 1px solid">खाता क्रंO</td>
  </tr><tr>
    <td style="border:#666666 1px solid">1</td>
    <td style="border:#666666 1px solid">2</td>
    <td style="border:#666666 1px solid">3</td>
    <td style="border:#666666 1px solid">4</td>
    <td style="border:#666666 1px solid">5</td>
    <td style="border:#666666 1px solid">6</td>
    <td style="border:#666666 1px solid">7</td>
  </tr>';
  $telval = getalltelphoneno();$k =0;$kl=0;
  

  foreach($telval as $vv){$kl=$kl+1;
 $contents .= '<tr>
    <td style="border:#666666 1px solid">'.$kl.'</td>
    <td style="border:#666666 1px solid">'.getemployeeName($vv->emp_id, $ishindi = true) .'</td>
    <td style="border:#666666 1px solid">'.$vv->emp_telephone_no.'</td>
    <td style="border:#666666 1px solid">';
    if($is_genrate == true)
	{
	$contents .= $post_data['amonut0-'.$k];
}else
{
    $contents .= '<input type="number" name="amonut0-'.$k.'" id="amonut0-'.$k.'" onblur="totalval3()"   value="0" placeholder="राशि रुपये"/>';
}
    $contents .= '</td><td style="border:#666666 1px solid">';
      if($is_genrate == true)
	{
	$contents .= $post_data['amonut1-'.$k];
}else
{
    $contents .= '<input type="number" name="amonut1-'.$k.'" id="amonut1-'.$k.'" onblur="totalval3()"   value="0" placeholder="पात्रता"/>';
}
    $contents .= '</td><td style="border:#666666 1px solid">';
       if($is_genrate == true)
	{
	$contents .= $post_data['amonut2-'.$k];
	}else
	{
     $contents .= ' <input type="number" name="amonut2-'.$k.'" id="amonut2-'.$k.'" onblur="totalval3()"   value="0" placeholder="वसूली"/>';
	}
   $contents .= ' </td><td style="border:#666666 1px solid">'.$vv->emp_account.'</td></tr>';
  $k =$k +1;}
$contents .= '<tr>
    <td style="border:#666666 1px solid">&nbsp;</td>
    <td style="border:#666666 1px solid">&nbsp;</td>
    <td style="border:#666666 1px solid">&nbsp;</td>
      <td style="border:#666666 1px solid"><input name="" type="hidden" id="count1" value="'.count($telval).'">';
          if($is_genrate == true)
	{
	$contents .= $post_data['amonut0'];
	}else
	{
      $contents .='<input type="number" name="amonut0" id="amount0" onblur="totalval3()"   value="0" placeholder="राशि रुपये"/>';
	} $contents .='</td><td style="border:#666666 1px solid">';
              if($is_genrate == true)
	{
	$contents .= $post_data['amonut1'];
	}else
	{
        $contents .='<input type="number" name="amonut1" id="amount1" onblur="totalval3()"   value="0" placeholder="पात्रता"/>';
	}
        $contents .='</td><td style="border:#666666 1px solid">';
     if($is_genrate == true)
	{
	$contents .= $post_data['amonut2'];
	}else
	{
        $contents .='<input type="number" name="amonut2" id="amount2" onblur="totalval3()"   value="0" placeholder="वसूली"/>';
	}
        $contents .='</td>
    <td style="border:#666666 1px solid">&nbsp;</td>
  </tr>
  </table></div></td></tr>';
$contents .= '<tr><td colspan="2"><p class="shift-left text-justify">	मांग संख्या';
if($is_genrate == true){
    $contents .= $post_data['mangno'];
}else{
$contents .='<input type="text" name="mangno" id="date" class=""  value="-29-2052-"   placeholder="दिनांक"/>';
}
$contents .='सचिवालय सामान्य सेवाएं-(';
if($is_genrate == true){
    $contents .= $post_data['mangno1'];
}else{
$contents .='<input type="text" name="mangno1" id="date" class=""  value="090"   placeholder="दिनांक"/>';
}
$contents .= ')-सचिवालय योजना-(';

if($is_genrate == true){
    $contents .= $post_data['mangno2'];
}else{
$contents .='<input type="text" name="mangno2" id="date" class=""  value="9057"   placeholder="दिनांक"/>';
}
$contents .=' )- विधि एवं विधायी कार्य की';
if($is_genrate == true){
    $contents .= $post_data['mangno3'];
}else{
$contents .='<input type="text" name="mangno3" id="date" class=""  value="मद-33-अनुरक्षण कार्य-(003)-वाहन "   placeholder="दिनांक"/>';
}
$contents .=' अनुरक्षण में वित्तीय वर्ष ';
if($is_genrate == true){
    $contents .= $post_data['mangno4'];
}else{
$contents .='<input type="text" name="mangno4" id="date" class=""  value=" 2016-17 "   placeholder="दिनांक"/>';
}
$contents .=' हेतु प्राप्त आवंटन में से विकलनीय होगा। </p><br/></td></tr>';
$contents .= '</td></tr>';
$contents .= '<tr><td colspan="2"><p  class="text-justify shift-left">अतः उपरोक्त देयकों में से काॅलम 4 पर अंकित राशि ';
  if($is_genrate == true)
	{
	$contents .= $post_data['tamount1'];
	}else
	{
$contents .='<input type="text" name="tamount1" id="tamount1" onblur="totalval3()"   value="0" placeholder="राशि रुपये"/>';
	}
$contents .=' (रूपये केवल) स्वीकृत की जाना प्रस्तावित है तथा काॅलम 6 पर अंकित राशि संबंधित अधिकारी से वसूली की जाना प्रस्तावित है। </p><br/></td></tr>';
$contents .= '</td></tr>';
 ?>
<style>
input{width:50px;}
.shift-left{ margin-left:10%;}
.shift-top{ margin-top:20px; }
.shift-left{ text-indent:50px }
</style>
