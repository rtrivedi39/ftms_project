<?php
$contents  = '' ;
$contents .= '<tr><td align="left"><span style="margin-left:8%"><b>कुटुम्ब न्यायालय में ';
if($is_genrate == true){
	$contents .= ' '.$post_data['type_name'];
} else {	
	$contents .= ' <select name="type_name" class="type_name">';
	$contents .= '<option value="सेवारत">सेवारत</option>';
	$contents .= '<option value="सेवानिवृत्त">सेवानिवृत्त</option>';
	$contents .= '</select>';
}
$contents .= ' न्यायिक अधिकारियों की नियुक्ति </b> </span></td></tr>';
$contents .= '<tr><td align="center">------------</td></tr>';
$contents .= '<tr><td  align="center">पंजी क्रमांक  '.$file_number.'/21-ब(एक),  भोपाल, दिनांक  ';
if($is_genrate == true){
	$contents .= get_date_formate($post_data['date'],'d/m/Y');
}else{
    $contents .=  '<input type="text" class="date1" name="date" value="'.$file_mark_section_date.'" placeholder="dd/mm/yyyy" required>';
}
$contents .=  '</td></tr>';$contents .= '<tr><td align="center">-----000-------</td></tr>';
$contents .= '<tr><td><p>कृपया रजिस्ट्रार जनरल, म.प्र. उच्च न्यायालय के अर्धशासकीय पत्र क्र.   ';
if($is_genrate == true){ 
    $contents .=  $post_data['patrano'];
} else {
    $contents .= '<input type="text" class="" name="patrano"  value=""/>';
}
$contents .= ', दिनांक  '.get_date_formate($file_uo_or_letter_date,'d/m/Y');
$contents .= ' का अवलोकन कीजिये |</p></td></tr> ';
$contents .= '<tr><td><p>उच्च न्यायालय ने अपने पत्र के पैरा 1 लगायत 4 में अलग – अलग प्रस्ताव दिये है |  जिनकी स्थिति निम्नानुसार है :-';
$contents .= '<tr><td><p>1. सेवानिवृत्त न्यायाधीशों को स्थापित एवं नवीन कुटुम्ब न्यायालय में 62 वर्ष की आयु पूर्ण करने अथवा आगामी आदेश होने तक (जो भी पहले हो ) निम्नानुसार कार्य के लिये अनुशंसा की है </p></td></tr> ';
$contents .= '<tr><td align="center">
		<table id="pitition_tbl" class="petition gridtable"  style="font-size:13px; "width="100%">
		<thead><tr><th>क्र.</th><th>नाम</th><th>पदस्थापना </th><th>62 वर्ष की आयु </th></tr></thead>';
		
if($is_genrate == true){
	$total_row = $post_data['total_row'];
	for($i = 0; $i < $total_row; $i++){
		if(isset($post_data['list_name'][$i]) && $post_data['list_name'][$i] != ''){
			$contents .= '<tr><td>'.$post_data['list_no'][$i].'.</td>
			<td>'.$post_data['list_name'][$i].'</td>
			<td>'.$post_data['list_post'][$i].'</td>
			<td>'.$post_data['list_age'][$i].'</td></tr>';
		}
	}
}else{
	  $contents .= '<tbody><tr><td><input type="text"  name="list_no[]" value=""></td>
	  <td><input type="text"  name="list_name[]" value=""></td>
	  <td><input type="text" name="list_post[]" value="प्रधान न्यायाधीश कुटुम्ब न्यायालय "></td>
	  <td><input type="text" name="list_age[]"></td></tr></tbody>';
	
}
if($is_genrate == false){
	$contents .= '<tfoot><tr><td colspan="5" style="text-align: left;">';
	$contents .= '<input type="button" id="addrow" value="Add Row" />';
	$contents .= '<input type="hidden" value="" name="total_row" class="total_row"></td></tr></tfoot>';
}
$contents .= '</table></td></tr>';
$contents .= '<tr><td><p>2. साथ ही  ';
if($is_genrate == true){
	$contents .= '<b>'.$post_data['person_name'].'</b>';
}else{
    $contents .=  '<input type="text" class="person_name" name="person_name" value="" placeholder="name" required>';
}
$contents .= ' जो कि दि. ';
if($is_genrate == true){
	$contents .= get_date_formate($post_data['joki_date'],'d/m/Y');
}else{
    $contents .=  '<input type="text" class="date1" name="joki_date" value="" placeholder="dd/mm/yyyy" required>';
}
$contents .= ' को अधिवार्षिक आयु पूर्ण करेंगे | इनके लिये 62 वर्ष की आयु पूर्ण  करने अथवा आगामी आदेश होने (जो भी पहले हो) के लिये कुटुम्ब न्यायालय में नियुक्ति हेतु अनुशंसा की है | की पदस्थापना संबंधी आदेश बाद में जारी किया जाना सुनिश्चित है | ';
$contents .= '<tr><td><p>3. नवीन कुटुम्ब न्यायालय ';
if($is_genrate == true){
	$contents .= $post_data['distic_1'];
}else{
	$contents  .= get_distic_dd('distic_1');	
}
$contents .= '  तथा ';
if($is_genrate == true){
	$contents .= $post_data['distic_2'];
}else{
	$contents  .= get_distic_dd('distic_2');	
}
$contents .= '  में स्थापित किये जाने संबंधी अधिसूचना जारी किये जाने का भी अनुरोध किया गया है |  ';
$contents .= '<tr><td><p>आदेश जरी किये जाने के पूर्व माननीय विधि मंत्री जी का प्रशासकीय अनुमोदन प्राप्त किया जाना है, मूल नस्ती कर्योतर स्वीकृति हेतु प्रस्तुत की गयी है| | </p></td></tr> ';
$contents .= '<tr><td><p>प्रकरण अनुमोदनार्थ प्रस्तुत | </p></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><b><u>अनुभाग अधिकारी (बी -1)</u></b></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><b><u>अवर सचिव (बी -1)</u></b></td></tr>';
$contents .= '<tr><td>&nbsp;</td></tr>';
$contents .= '<tr><td><b><u>सचिव (बी -1)</u></b></td></tr>';

?>

                
                
        
                  
                
               
                