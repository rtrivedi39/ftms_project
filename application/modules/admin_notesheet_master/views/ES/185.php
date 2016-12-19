<?php
$contents  = '' ;
$contents .= '<tr><td colspan="2"><div class=""><span class="shift-left">प्रगति ला हाउस भोपाल के देयक के भुगतान के संबंध में।</span></div></td></tr>';
$contents .= '<tr><td colspan="2"><table width="100%"><tr><td align="left">पंजी क्रमांक '.$panji_krmank.'/21-क(स्था.), </td><td align="right"> दिनांक '.$file_mark_section_date.'</td></tr></table></td></tr>';
$contents .= '<tr><td align="center" colspan="2" > ----------------------------------------------------------</td></tr>';
$contents .= '<tr><td align="left" colspan="2"><p class="shift-left text-justify">    कृपया पुस्तकालय शाखा की टीप ';
if($is_genrate == true){
    $contents .= $post_data['start_date'];
}else{
	$contents .= '<input name="start_date" class="date1"  type="text"  />';
}
$contents .= ' का अवलोकन करने का कष्ट करें ।  </td></tr>'; 
 $contents .= '<tr><td colspan="2"><p class="text-justify shift-left" >पुस्तकालय शाखा द्वारा प्रगति ला हाउस भोपाल से नस्ती अनुसार पुस्तकों का क्रय किया गया है। जिसका देयक राशि रुपये ';
if($is_genrate == true){
    $contents .= $post_data['amount_given'];
}else{
	$contents .= '<input name="amount_given"   type="text"  />';
} 
$contents .= ' (  <span class="amount_given_word">---</span>) मात्र भुगतान हेतु प्राप्त हुआ है।  </p><br/></td></tr>';
$contents .= '<tr><td colspan="2"><p class="text-justify shift-left" > अतः यदि मान्य हो तो उक्त देयक के भुगतान की स्वीकृति प्रदान की जाना उचित होगा ।</p><br/></td></tr>';
$contents .= '<tr><td colspan="2"><p class="text-justify shift-left" > आदेशार्थ प्रस्तुत।  </p><br/></td></tr>';

if($this->uri->segment(6) == 'p' || $this->uri->segment(7) == 'p'  ){
$contents .= '<tr><td colspan="2"><div><u>अनुभाग अधिकारी (स्था) </u> </div><br/><br/><br/></td></tr>';
$contents .= '<tr><td colspan="2"><div><u>अवर सचिव </u> </div><br/><br/><br/></td></tr>';
$contents .= '<tr><td colspan="2"><div><u>व0ले0अ0 </u> </div><br/><br/><br/></td></tr>';
}
$contents .= '<tr><td colspan="2"><br /><br/><br/><div  style="text-align:justify" ></div><br/></td></tr>';

?>
<style>
.shift-left{ margin-left:10%;}
.shift-top{ margin-top:20px; }
.shift-left{ text-indent:50px }
</style>



