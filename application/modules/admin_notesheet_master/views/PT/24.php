<?php
$counselling_list = get_standing_counseller_name(null,null);
//pre($counselling_list);
foreach($counselling_list as $cname){
    $advocates[] = $cname['scm_name_hi'];
}
//pre($file_details);
/*Begin Is value Post*/
if($this->input->post('advocate1')){ $post_advocate1=$this->input->post('advocate1'); $style_str1='style="display:none"';}else{$post_advocate1=''; $style_str1='';}  
if($this->input->post('advocate')){ $post_advocate=$this->input->post('advocate'); $style_str='style="display:none"';}else{$post_advocate=''; $style_str='';}  
 if($this->input->post()){ 
		$cmn_style='style="display:none"';
		$date1=$this->input->post('date1');
		$file_uo_date=$this->input->post('file_uo_date');
		$panji_no=$this->input->post('num');
		$panji_uno=$this->input->post('uo_no');
		$so_yachika=$this->input->post('so_yachika');
		$as_yachika=$this->input->post('ac_yachika');
	}else	
	{$cmn_style=''; $so_yachika=''; $as_yachika=''; $panji_no=''; $panji_uno=''; $date1='';$file_uo_date='';} 

/*End Is value Post*/
$contents='<tr colspan="1"><td><div style="margin-top:20px;"><b style="margin-left:50px;">'.$file_details[0]['file_subject'].'</b></div></td><tr/><tr><td>पंजी क्रमांक';?>
                    <?php $contents .='<input '.$cmn_style.' type="text" name="num" value="'.$file_number.'">'; ?>
                    <?php  $contents .='<b> '.$panji_no.'</b>/21-(या),<div style="float:right"> दिनांक  <b>'.$date1.'</b><input '.$cmn_style.' type="text" class="date1" name="date1" placeholder="dd/mm/yyyy" name="generate_date" value="'.date('d/m/Y').'"/></div>';?>
                    <?php $contents .='</div></td></tr><tr><td align="center">'.$file_details[0]['dept_name_hi'].' विभाग  का</td></tr><tr><td><p><div style="float:left">यू.ओ.क्रमांक :  <b>'.$panji_uno.'</b><input '.$cmn_style.' type="text" name="uo_no" value="'.$file_details[0]['file_uo_or_letter_no'].'"></div><div style="float:right">
                       दिनांक ';?>
                        <?php $contents .='<b>'.$file_uo_date.'</b><input '.$cmn_style.' type="text" class="date1" name="file_uo_date" placeholder="dd/mm/yyyy" value="'.date('d/m/Y',strtotime($file_details[0]['file_uo_or_letter_date'])).'" />'; ?>
					
						<?php foreach($advocates as $advocate){  $str = "<option value=$advocate>$advocate</option>";} ?>
						<?php $contents .='</div><br><br></p>
                               <p>कृपया प्रशासकीय विभाग की नस्ती पर अंकित टीप का अवलोकन करें।	</p>
                               <p>प्रशासकीय विभाग ने विषयांकित प्रकरण में  माननीय  सर्वोच्य न्यायालय के समक्ष म.प्र. राज्य की ओर से पक्ष समर्थन/ प्रतिरक्षण आदेश तथा वकालतनामा जारी करने के लिये नस्ती इस विभाग को अंकित की है।</p>
                               <p>अतः प्रशासकीय विभाग के प्रस्ताव अनुसार स्थायी अधिवक्ता   <select name="advocate" required '.$style_str.'><option>अधिवक्ता  का चयन करें</option>';?><?php foreach($advocates as $advocate){  $contents .='"<option value="'.$advocate.'">'.$advocate.'</option>"';} ?> <?php $contents .='</select> <b>'.$post_advocate.'  </b> के नाम आदेश तथा वकालतनामा  जारी किया जाना उचित होगा | </p>
                               <p>स्थायी अधिवक्ता   <select name="advocate1" required '.$style_str1.'><option>अधिवक्ता  का चयन करें</option>';?><?php foreach($advocates as $advocate){  $contents .='<option value="'.$advocate.'">'.$advocate.'</option>';} ?> <?php $contents .='</select><b>'.$post_advocate1.' </b> के नाम आदेश तथा वकालतनामा तथा प्रशासकीय विभाग की नस्ती पर अंकित टीप हस्ताक्षरार्थ प्रस्तुत है।</p>
                                </td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr>';
                               // <tr><td><span><u>अनुभाग अधिकारी (याचिका)<u/></span><br><br><u>अवर सचिव (याचिका) </u></span></td></tr>
                                '<tr><td></td></tr><tr><td>
                                </td>
            </tr>'; //echo $contents;
			
			
if($this->uri->segment(6) == 'p' || $this->uri->segment(7) == 'p'  ){

$contents .= '<tr><td><u>अनुभाग अधिकारी (याचिका)</u></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>अवर सचिव (याचिका)</u></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><u>अति. सचिव (याचिका)</u></td></tr>';
}
?>
	
