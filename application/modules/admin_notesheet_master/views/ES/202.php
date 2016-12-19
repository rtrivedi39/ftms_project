<?php
$contents  = '' ;
$contents .= '<tr><td colspan="2"><div  class="shift-left text-justify" >विधुत देयकों के भुगतान के संबंध में |';

$contents .='</div></td></tr>';
$contents .= '<tr><td align="left"><br />पंजी क्रमांक '.$panji_krmank.'/21- अ(स्था),<br /></td><td align="right"><br /> दिनांक '.$file_mark_section_date.'<br /></td></tr>';
$contents .= '<tr><td align="center" colspan="2">&nbsp; &nbsp;---------------------------------------------&nbsp;&nbsp;</td></tr>';
$contents .= '<tr><td colspan="2"  align="left"><p class="shift-left text-justify">&nbsp;	कृपया प्रस्तुत विधुत देयक का अवलोकन करना चाहेंगे। </p></td></tr>';
$contents .= '<tr><td colspan="2"><div class=" shift-left text-justify"><p>&nbsp; ';
$contents .= '<tr><td colspan="2"><p class="text-justify shift-left" >';

if($name != '' && $designation != ''){
    $contents .= $name." , ".$designation;
}else{
    if($is_genrate == true){
        $contents .= get_employee_name($this->input->post('emp_name') , '');// get_officer_information();
    }
    else{
        $contents .= get_all_employee_ddllist('emp_name' ,'');
    }
    $contents .= ', ';
    if($is_genrate == true){
        $contents .=   get_employee_designation_id($this->input->post('emp_name'));
    }
    else{
        $contents .= '----' ;
    }
}

$contents .=' द्वारा शासकीय आवास क्रमांक';
if($apply_house_no != ''){
    $contents .= $apply_house_no;
}else{
    if($is_genrate == true){
        $contents .= $post_data['houseno'];
    }else{
        $contents .=' <input type="text" name="houseno"  value="" placeholder="आवास क्रमांक "/>';
    }
}

$contents .='  में भोपाल में लगे विधुत मीटर के देयक निम्नानुसार हैः-</p> ';

$contents .= '</div></td></tr>';
$contents .= '<tr><td colspan="2" align="center"><div style="margin-left: 50px;  text-align: justify;    margin-bottom: 6px;    line-height: 20px;">';



if(isset($apply_amount) && $apply_amount != ''){

    $contents .= '<table width="100%" border="1" align="center"><tr>
    <td  style="border:#666666 1px solid">माह</td>
    <td style="border:#666666 1px solid" >यूनिट</td>
    <td style="border:#666666 1px solid">देयक राशि </td>
    <td style="border:#666666 1px solid">औसत 50 प्रतिशत</td>
	<td style="border:#666666 1px solid">स्वीकृत राशि</td>
  </tr>';
    foreach($bill_apply_month_arr as $key => $bill_apply_month){
        $mnt = explode('-',$bill_apply_month);
        $halfamt =  $bill_apply_amt_arr[$key] / 2 ;
        $totala += $halfamt ;
        $contents .='<tr>
    <td style="border:#666666 1px solid">'.months($mnt[0] , true).'</td>
    <td style="border:#666666 1px solid">'.$bill_electricity_unit[$key].'</td>
    <td style="border:#666666 1px solid">'.$bill_apply_amt_arr[$key].'</td>
    <td style="border:#666666 1px solid">'.$halfamt.'</td>

	<td style="border:#666666 1px solid">';

        if($is_genrate == true){
            $contents .= $post_data['amonut12'.$key];
        }else{
            $contents .='<input type="text" name="amonut12'.$key.'" value="'.$halfamt.'" placeholder="स्वीकृत राशि"/>';
        }
        $contents .='</td></tr>';
    }
    $contents .=' <tr>
      <td style="border:#666666 1px solid">&nbsp;</td>
        <td style="border:#666666 1px solid">&nbsp;</td>
      <td style="border:#666666 1px solid">&nbsp;</td>
      <td style="border:#666666 1px solid">राशि</td>
      <td style="border:#666666 1px solid">';
    if($is_genrate == true){
        $contents .= $post_data['tamount1'];
    }else{
        $contents .='<input type="text" name="tamount1" value="'.$totala.'" placeholder="राशि रुपये"/>';
    }
    $contents .='</td></tr>';
    $contents .='</table>';

}else{

    $contents .= '<table width="100%" border="1" align="center"><tr>
    <td  style="border:#666666 1px solid">माह</td>
    <td style="border:#666666 1px solid" >यूनिट</td>
    <td style="border:#666666 1px solid">देयक राशि </td>
    <td style="border:#666666 1px solid">औसत 50 प्रतिशत</td>
	<td style="border:#666666 1px solid">स्वीकृत राशि</td>
  </tr>';
    if($is_genrate == true){
        $contents .= '<tr>
    <td style="border:#666666 1px solid">'.$post_data['month1'].'</td>
    <td style="border:#666666 1px solid">'.$post_data['unit1'].'</td>
    <td style="border:#666666 1px solid">'.$post_data['amonut10'].'
	</td >
    <td style="border:#666666 1px solid">'.$post_data['amonut1'].'</td>

	<td style="border:#666666 1px solid">'.$post_data['amonut12'].'</td>
  </tr>
     <tr>';
    }else{
        $contents .='<tr>
    <td style="border:#666666 1px solid"><input type="text" name="month1"  value="" placeholder="माह"/></td>
    <td style="border:#666666 1px solid"><input type="text" name="unit1"  value="" placeholder="यूनिट"/></td>
    <td style="border:#666666 1px solid"><input type="text" name="amonut10" id="amonut10" onblur="totalval2()"  value="" placeholder="देयक राशि "/></td>
    <td style="border:#666666 1px solid"><input type="text" name="amonut1" id="amonut1" onblur="totalval2()" value="0" placeholder="औसत 50 प्रतिशत"/></td>
	<td style="border:#666666 1px solid"><input type="text" name="amonut12" id="amonut12" onblur="totalval2()"  value="0" placeholder="स्वीकृत राशि"/></td>
  </tr>
     <tr>';
    }
    if($is_genrate == true){
        $contents .= '<tr>
    <td style="border:#666666 1px solid">'.$post_data['month12'].'</td>
    <td style="border:#666666 1px solid">'.$post_data['unit2'].'</td>
    <td style="border:#666666 1px solid">'.$post_data['amonut20'].'	</td>
    <td style="border:#666666 1px solid">'.$post_data['amonut2'].'</td>

	<td style="border:#666666 1px solid">'.$post_data['amonut22'].'</td>
  </tr>
     <tr>';
    }else{
        $contents .='
    <td style="border:#666666 1px solid"><input type="text" name="month12"  value="" placeholder="माह"/></td>
    <td style="border:#666666 1px solid"><input type="text" name="unit2"  value="" placeholder="यूनिट"/></td>
    <td style="border:#666666 1px solid"><input type="text" name="amonut20" id="amonut20" onblur="totalval2()" value="" placeholder="देयक राशि "/></td>
    <td style="border:#666666 1px solid"><input type="text" name="amonut2" id="amonut2" onblur="totalval2()" value="0" placeholder="औसत 50 प्रतिशत"/></td>
	<td style="border:#666666 1px solid"><input type="text" name="amonut22" id="amonut22" onblur="totalval2()"  value="0" placeholder="स्वीकृत राशि"/></td>
  </tr>';}
    if($is_genrate == true){
        $contents .= '<tr>
    <td style="border:#666666 1px solid">'.$post_data['month3'].'</td>
    <td style="border:#666666 1px solid">'.$post_data['unit3'].'</td>
    <td style="border:#666666 1px solid">'.$post_data['amonut30'].'
	</td>
    <td style="border:#666666 1px solid">'.$post_data['amonut3'].'</td>

	<td style="border:#666666 1px solid">'.$post_data['amonut32'].'</td>
  </tr>
     <tr>';
    }else{
        $contents .='<tr>
    <td style="border:#666666 1px solid"><input type="text" name="month3"  value="" placeholder="माह"/></td>
    <td style="border:#666666 1px solid"><input type="text" name="unit3"  value="" placeholder="यूनिट"/></td>
    <td style="border:#666666 1px solid"><input type="text" name="amonut30" id="amonut30" onblur="totalval2()"  value="" placeholder="देयक राशि "/></td>
    <td style="border:#666666 1px solid"><input type="text" name="amonut3" id="amonut3" onblur="totalval2()"  value="0" placeholder="औसत 50 प्रतिशत"/></td>
	<td style="border:#666666 1px solid"><input type="text" name="amonut32" id="amonut32" onblur="totalval2()"  value="0" placeholder="स्वीकृत राशि"/></td>
  </tr>';}

    if($is_genrate == true){
        $contents .= '<tr>
      <td style="border:#666666 1px solid">&nbsp;</td>
	    <td style="border:#666666 1px solid">&nbsp;</td>
      <td style="border:#666666 1px solid">&nbsp;</td>
      <td style="border:#666666 1px solid">राशि</td>

	<td style="border:#666666 1px solid">'.$post_data['tamount1'].'</td>
  </tr>
     <tr>';
    }else{
        $contents .=' <tr>
      <td style="border:#666666 1px solid">&nbsp;</td>
	    <td style="border:#666666 1px solid">&nbsp;</td>
      <td style="border:#666666 1px solid">&nbsp;</td>
      <td style="border:#666666 1px solid">राशि</td>
      <td style="border:#666666 1px solid"> <input type="text" name="tamount1" id="tamount1" onblur="totalval2()"   value="0" placeholder="राशि रुपये"/></td>
    </tr>';
    }
    $contents .='</tr></table>';

}


$contents .= '</div></td></tr>';
$contents .= '<tr><td colspan="2"><p class="shift-left text-justify">	राज्य शासन विधि और विधायी कार्य विभाग के आदेश क्रमांक फा 3 (ए)19/03/21-ब (एक) भोपाल दिनांक ';
if($is_genrate == true){
    $contents .= $post_data['date22'];
}else{
    $contents .='<input type="text" name="date22" id="date" class="date1"    placeholder="दिनांक"/>';
}
$contents .='के द्वारा मध्यप्रदेश न्यायिक सेवा के सदस्योें को दिनांक    1.11.1999 से सुविधाएं एवं भत्ते स्वीकृत किए गये हैं। उक्त आदेश की कंडिका(एक) के अनुसार न्यायिक सेवा के अधिकारियों को विधुत देयक का 50 प्रतिशत अधिकतम 1000 विधुत यूनिट प्रतिमाह के मूल्य के बराबर राशि राज्य सरकार द्वारा न्यायिक सेवा के सदस्यों को देय होगी। </p><br/></td></tr>';
$contents .= '</td></tr>';
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
    $contents .='<input type="text" name="mangno3" id="date" style="width: 250px;" class=""  value="मद-33-अनुरक्षण कार्य-(003)-वाहन "   placeholder="दिनांक"/>';
}
$contents .='  में वित्तीय वर्ष ';
if($is_genrate == true){
    $contents .= $post_data['mangno4'];
}else{
    $contents .='<input type="text" name="mangno4" id="date" class=""  value=" 2016-17 "   placeholder="दिनांक"/>';
}
$contents .=' हेतु प्राप्त आवंटन में से विकलनीय होगा। </p><br/></td></tr>';
$contents .= '</td></tr>';
$contents .= '<tr><td colspan="2"><p class="shift-left text-justify">      अतः';
$contents .= '<tr><td colspan="2"><p class="text-justify shift-left" >';

if($name != '' && $designation != ''){
    $contents .= $name." , ".$designation;
}else{
    if($is_genrate == true){
        $contents .= get_employee_name($this->input->post('emp_name') , '');// get_officer_information();
    }
    else{
        $contents .= get_all_employee_ddllist('emp_name' ,'');
    }
    $contents .= ', ';
    if($is_genrate == true){
        $contents .=   get_employee_designation_id($this->input->post('emp_name'));
    }
    else{
        $contents .= '----' ;
    }
}

$contents .= ' को ';
if($is_genrate == true){
    $contents .= $post_data['tamount2'];
}else{
    $contents .='<input type="text" name="tamount2" id="tamount2" onblur="totalval2()"   value="'.$totala.'" placeholder="राशि रुपये"/>';
}
$contents .='  (रूपये     केवल) स्वीकृत किया जाना प्रस्तावित है ।  </p><br/></td></tr>';
$contents .= '</td></tr>';
?>
<style>
    .shift-left{ margin-left:10%;}
    .shift-top{ margin-top:20px; }
    .shift-left{ text-indent:50px }
</style>
