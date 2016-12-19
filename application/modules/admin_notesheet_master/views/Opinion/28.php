<?php 
$contents  = '' ;
$contents .= '<tr><td><div style="margin-top:10px;"><span style="margin-left:10%;">'.$file_subject.' </span></div></td></tr>';
$contents .= '<tr><td align="center"> ---- </td></tr>';

$contents .= '<tr><td align="left"><div style="float:left">पंजी क्र. '. @$file_number .' /21- मत</div><div style="float:right">दिनांक ';
if($is_genrate == true){ 
    $contents .=  get_date_formate($post_data['date1'],'d/m/Y').'</td></tr>';
} else {
    $contents .= ' <input type="text" class="date1" name="date1" placeholder="dd/mm/yyyy" value="'.$today.'"/></td></tr>';
}

$contents .= '</div></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><p> कृपया  '.@$department_name.'  का पत्र क्र.  '.$file_uo_or_letter_no .' दि. '.$file_uo_or_letter_date.' का अवलोकन हो | </p></td></tr>';

if($is_genrate == true){ 
//pr($post_data);
    $contents .=  '<tr><td><p>'.$post_data['notesheet_content'].'<p></td></tr>';
} else {
    $contents .= '<tr><td><p><textarea class="ckeditor" name="notesheet_content"  rows="45" cols="100" id="notesheet_content"></textarea><p></td></tr>';
}

$contents .= '<tr><td>&nbsp;</td></tr>';
 if($this->uri->segment(6) == 'p' || $this->uri->segment(7) == 'p'  ){
$contents .= '<tr><td><div style="width:35%; text-align:center;">&nbsp;</div></td></tr>';
$contents .= '<tr><td><div style="width:35%; text-align:center;"><u>अनु. अधि. ( मत) </u></div></td></tr>';
$contents .= '<tr><td><div style="width:35%; text-align:center;">&nbsp;</div></td></tr>';

$contents .= '<tr><td><div style="width:35%; text-align:center;">&nbsp;</div></td></tr>';
$contents .= '<tr><td><div style="width:35%; text-align:center;"><u>अवर सचिव  ( मत)  </u></div></td></tr>';

} 

//print content
//echo $contents;
?>   

