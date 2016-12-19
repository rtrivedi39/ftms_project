<?php
$contents  = '' ;
$contents .= '<tr><td colspan="2"><div class=""><span class="shift-left">आउट आफ पाकेट के देयक ';

if($is_genrate == true){
    foreach(get_advocates_name('', $post_data['member_id']) as $row){
        $contents .= ' '.$row->scm_name_hi;
    }
} else {
    $contents .= ' <select name="member_id">';
    foreach($standing_counsil_memebers as $row){
        $contents .= '<option value="'.$row->scm_id.'">'.$row->scm_name_hi.'</option>';
    }
    $contents .= '</select>';
}if($is_genrate == true){
$contents .= $post_data['cortname'];
} else {
$contents .= '<input name="cortname" placeholder="न्यायालय  नाम"  type="text"  />,';
}if($is_genrate == true){
    $contents .= '<span>'.$post_data['court_location'].'</span>';
}else{
    $contents .= '<select name="court_location">';
    foreach($court_location as $row){
        $contents .= '<option value="'.$row.'">'.$row.'</option>';
    }
    $contents .= '</select>';
}

$contents .='  देयकों के भुगतान के संबंध में।।</span></div></td></tr>';
$contents .= '<tr><td colspan="2"><table width="100%"><tr><td align="left">पंजी क्रमांक '.$panji_krmank.'/21-क(स्था.), </td><td align="right"> दिनांक '.$file_mark_section_date.'</td></tr></table></td></tr>';
$contents .= '<tr><td align="center" colspan="2" > ----------------------------------------------------------</td></tr>';
$contents .= '<tr><td align="left" colspan="2"><p class="shift-left text-justify">कृपया विचाराधीन देयकों का अवलोकन कीजिए। ';
if($is_genrate == true){
    foreach(get_advocates_name('', $post_data['member_id']) as $row){
        $contents .= ' '.$row->scm_name_hi;
    }
} else {
    $contents .= ' <select name="member_id">';
    foreach($standing_counsil_memebers as $row){
        $contents .= '<option value="'.$row->scm_id.'">'.$row->scm_name_hi.'</option>';
    }
    $contents .= '</select>';
}
if($is_genrate == true){
$contents .= $post_data['cortname'];
} else {
$contents .= '<input name="nameadvocate1"  placeholder="न्यायालय  नाम "  type="text"  />';
}
$contents .= ', माह ';
if($is_genrate == true){
$contents .= $post_data['month1'];
} else {
$contents .=get_month('month1');
}

if($is_genrate == true){
$contents .= $post_data['year'];
} else {
$contents .=' <input name="year"  placeholder="वर्ष"  type="text"  />';
}

$contents .=' के आउट आफ पाकेट के देयक निम्नानुसार प्रस्तुत किए हैं:- </p></td></tr><tr><td align="left" colspan="2">
 <p class="shift-left text-justify">माह ';
 
if($is_genrate == true){
$contents .= $post_data['month2'];
} else {
$contents .=get_month('month2');
}
 
$contents .= '</td></tr>'; 
$contents .= '<tr><td colspan="2"> <p class="text-justify shift-left">Bill No.';

if($is_genrate == true){
$contents .= $post_data['bilno'];
} else {
$contents .= '<input name="bilno" class="date1" placeholder="Bill No"  type="text"  />';
}
$contents .=', &nbsp;DATE';
if($is_genrate == true){
$contents .= $post_data['date12'];
} else {
$contents .= ' <input name="date12" class="date1" placeholder="दिनांक"  type="text"  />';
}
$contents .='</p><br/></td></tr>';

$contents .= '<tr><td colspan="2"><br /><br/><br/><div  style="text-align:justify" >

<table width="100%" class="petitionoutof"  style="border:#666666 1px solid" border="1" id="pitition_tblout">
  <tr  style="border:#666666 1px solid">
 
        <td height="66" width="64">S. N.</td>
    
    <td style="border:#666666 1px solid">Fees for drafting</td>
    <td style="border:#666666 1px solid">Court Fee</td>
    <td style="border:#666666 1px solid">Paper Book</td>
    <td style="border:#666666 1px solid">Paper Book</td>
    <td style="border:#666666 1px solid">Affidavit</td>
    <td style="border:#666666 1px solid">Photo Copies</td>
    <td style="border:#666666 1px solid">Computer Typing</td>
    <td style="border:#666666 1px solid">Translation</td>
    <td style="border:#666666 1px solid">Communication</td>
    <td style="border:#666666 1px solid">STD/ Fax&nbsp;</td>
    <td style="border:#666666 1px solid">Misc. Expenss</td>
    <td style="border:#666666 1px solid">TOTAL</td>
    <td style="border:#666666 1px solid">Not Pay    (Communication, Postal Charges &amp; Misc. Exp. Etc)</td>
    <td style="border:#666666 1px solid">PAY AMOUNT</td>
  </tr>
  <tr  style="border:#666666 1px solid">
    <td style="border:#666666 1px solid">1</td>
    <td style="border:#666666 1px solid">2</td>
    <td style="border:#666666 1px solid">3</td>
    <td style="border:#666666 1px solid">4</td>
    <td style="border:#666666 1px solid">5</td>
    <td style="border:#666666 1px solid">6</td>
    <td style="border:#666666 1px solid">7</td>
    <td style="border:#666666 1px solid">8</td>
    <td style="border:#666666 1px solid">9</td>
    <td style="border:#666666 1px solid">10</td>
    <td style="border:#666666 1px solid">11</td>
    <td style="border:#666666 1px solid">12</td>
    <td style="border:#666666 1px solid">13</td>
    <td style="border:#666666 1px solid">14</td>
    <td style="border:#666666 1px solid">15</td>
  </tr>
   <tbody>';
   
   if($is_genrate == true){

	$total_row = $post_data['total_row'];	
	for($i = 0; $i < $total_row; $i++){
		$_i = $i + 1;

 $contents .= '<tr  style="border:#666666 1px solid">
    <td style="border:#666666 1px solid">&nbsp;</td>
    <td style="border:#666666 1px solid">'.$post_data["input2".$i].'</td>
    <td style="border:#666666 1px solid">'.$post_data["input3".$i].'</td>
    <td style="border:#666666 1px solid">'.$post_data["input4".$i].'</td>
    <td style="border:#666666 1px solid">'.$post_data["input5".$i].'</td>
    <td style="border:#666666 1px solid">'.$post_data["input6".$i].'</td>
    <td style="border:#666666 1px solid">'.$post_data["input7".$i].'</td>
    <td style="border:#666666 1px solid">'.$post_data["input8".$i].'</td>
    <td style="border:#666666 1px solid">'.$post_data["input9".$i].'</td>
    <td style="border:#666666 1px solid">'.$post_data["input10".$i].'</td>
    <td style="border:#666666 1px solid">'.$post_data["input11".$i].'</td>
    <td style="border:#666666 1px solid">'.$post_data["input12".$i].'</td>
    <td style="border:#666666 1px solid">'.$post_data["input13".$i].'</td>
    <td style="border:#666666 1px solid">'.$post_data["input14".$i].'</td>
    <td style="border:#666666 1px solid">'.$post_data["input15".$i].'</td>
  </tr>  ';
  }}else{
   $contents .= '<tr  style="border:#666666 1px solid">
    <td style="border:#666666 1px solid">&nbsp;</td>
    <td style="border:#666666 1px solid">';
	'<input name="input20" id="input20" class="input" onblur="totalout()" placeholder="Fees for drafting" type="number" /></td>
    <td style="border:#666666 1px solid"><input name="input30" id="input30"  class="input" onblur="totalout()" placeholder="Court Fee" type="number" /></td>
    <td style="border:#666666 1px solid"><input name="input40" id="input40"  class="input" onblur="totalout()"  placeholder="Paper Book" type="number" /></td>
    <td style="border:#666666 1px solid"><input name="input50" id="input50"  class="input" onblur="totalout()" placeholder="Paper Book" type="number" /></td>
    <td style="border:#666666 1px solid"><input name="input60" id="input60"  class="input" onblur="totalout()" placeholder="Affidavit" type="number" /></td>
    <td style="border:#666666 1px solid"><input name="input70" id="input70"  class="input" onblur="totalout()" placeholder="Photo Copies" type="number"/></td>
    <td style="border:#666666 1px solid"><input name="input80" id="input80"  class="input" onblur="totalout()" placeholder="Computer Typing" type="number"/></td>
    <td style="border:#666666 1px solid"><input name="input90" id="input90"  class="input" onblur="totalout()" placeholder="Translation" type="number"/></td>
    <td style="border:#666666 1px solid"><input name="input100" id="input100"  class="input" onblur="totalout()" placeholder="Communication" type="number"/></td>
    <td style="border:#666666 1px solid"><input name="input110" id="input110"  class="input" onblur="totalout()" placeholder="STD/ Fax " type="number"/></td>
    <td style="border:#666666 1px solid"><input name="input120" id="input120"  class="input" onblur="totalout()" placeholder="Misc. Expenss" type="number"/></td>
    <td style="border:#666666 1px solid"><input name="input130" id="input130"  class="input" onblur="totalout()" placeholder="TOTAL" type="number"/></td>
    <td style="border:#666666 1px solid"><input name="input140" id="input140" class="input" onblur="totalout()"  placeholder="Not Pay" type="number"/></td>
    <td style="border:#666666 1px solid"><input name="input150" id="input150"  class="input" onblur="totalout()" placeholder="PAY AMOUNT" type="number"/></td>
  </tr>  ';
  
  
  }
	  $contents .=  '  <tr style="border:#666666 1px solid"><td colspan="15"><input type="hidden" value=""
	  name="total_row" class="total_row"><input type="button" onclick="addrowoutof23()" id="addrowoutof" value="Add Row" />    </td> </tr>';
    $contents .=    '</tbody><tfoot>  <tr style="border:#666666 1px solid"><td style="border:#666666 1px solid">Total</td>
        <td style="border:#666666 1px solid">';
		
		if($is_genrate == true){
$contents .= $post_data['input2'];
} else {
		$contents .= '<input name="input2" id="input2"  onblur="totalout()" class="input" placeholder="TOTAL Fees for drafting" type="number" />';
		}
		$contents .= '</td>
    <td style="border:#666666 1px solid">';
		if($is_genrate == true){
$contents .= $post_data['input3'];
} else {
	$contents .= '<input name="input3" id="input3"  class="input" onblur="totalout()" placeholder="TOTAL Court Fee" type="number" />';
	}
		$contents .= '</td>
    <td style="border:#666666 1px solid">';
		if($is_genrate == true){
		$contents .= $post_data['input4'];
		} else {
		$contents .= '<input name="input4" id="input4" class="input"   onblur="totalout()"placeholder="TOTAL Paper Book" type="number" />';
		}
	

	
	if($is_genrate == true){
		$contents .= $post_data['input5'];
		} else {
	$contents .= '<input name="input5" id="input5"  class="input" onblur="totalout()" placeholder="TOTAL Paper Book" type="number" />';
	}
	
			$contents .= '</td>
    <td style="border:#666666 1px solid">';
	if($is_genrate == true){
		$contents .= $post_data['input6'];
		} else {
	$contents .= '<input name="input6" id="input6"  class="input" onblur="totalout()" placeholder="TOTAL Affidavit" type="number" />';
	}
	
	$contents .= '</td>
    <td style="border:#666666 1px solid">';
	
	
	if($is_genrate == true){
		$contents .= $post_data['input7'];
		} else {
   			$contents .= '<input name="input7" id="input7"  class="input" onblur="totalout()" placeholder="TOTAL Photo Copies" type="number"/>';
   }
 $contents .= '</td>
    <td style="border:#666666 1px solid">';
	
	
	if($is_genrate == true){
		$contents .= $post_data['input8'];
		} else {
 
  $contents .= '<input name="input8" id="input8"  class="input" onblur="totalout()" placeholder="TOTAL Computer Typing" type="number"/>';
  }
  $contents .= '</td>
    <td style="border:#666666 1px solid">';
	
	
	if($is_genrate == true){
		$contents .= $post_data['input9'];
		} else {
		
		 $contents .= '<input name="input9" id="input9"  class="input" onblur="totalout()" placeholder="TOTAL Translation" type="number"/>';
  }
  $contents .= '</td>
    <td style="border:#666666 1px solid">';
	
	
	if($is_genrate == true){
		$contents .= $post_data['input10'];
		} else {
		 $contents .= '<input name="input10" id="input10"  class="input" onblur="totalout()" placeholder="TOTAL Communication" type="number"/>';
  }
  $contents .= '</td>
    <td style="border:#666666 1px solid">';
	
	
	if($is_genrate == true){
		$contents .= $post_data['input11'];
		} else { $contents .= '<input name="input11" id="input11"  class="input" onblur="totalout()" placeholder="TOTAL STD/ Fax " type="number"/>';
  }
  $contents .= '</td>
    <td style="border:#666666 1px solid">';
	
	
	if($is_genrate == true){
		$contents .= $post_data['input12'];
		} else {
		
		
		 $contents .= '<input name="input12" id="input12"  class="input" onblur="totalout()" placeholder="TOTAL Misc. Expenss" type="number"/>';
  }
  $contents .= '</td>
    <td style="border:#666666 1px solid">';
	
	
	if($is_genrate == true){
		$contents .= $post_data['input13'];
		} else {
		
		$contents .= '<input name="input13" id="input13"  class="input" onblur="totalout()"  placeholder="TOTAL " type="number"/>';
  }
	
  $contents .= '</td>
    <td style="border:#666666 1px solid">';
	
	if($is_genrate == true){
		$contents .= $post_data['input14'];
		} else {
		$contents .= '<input name="input14" id="input14"  class="input" onblur="totalout()" placeholder="TOTAL Not Pay" type="number"/>';
  }
  $contents .= '</td>
    <td style="border:#666666 1px solid">';
	
	
	if($is_genrate == true){
		$contents .= $post_data['input15'];
		} else {
		$contents .= '<input name="input15" id="input15"  class="input" onblur="totalout()" placeholder="TOTAL PAY AMOUNT" type="number"/>';
  }
  $contents .= '</td>
    <td style="border:#666666 1px solid">
	
  </tr><tfoot> 
</table></div><br/></td></tr>';


$contents .= '<tr><td colspan="2"><p class="text-justify shift-left" >  विधि और विधायी कार्य विभाग, भोपाल के आदेश क्रमांक  <input name="orderno"  placeholder="आदेश क्रमांक  "  type="text"  />  दिनांक
<input name="date" class="date1" placeholder="दिनांक"  type="text"  /> द्वारा स्थायी अधिवक्ता, उच्चतम न्यायालय, नई दिल्ली को विविध व्यय के अंतर्गत निम्नानुसार राशि देय है:-   </p><br/></td></tr>';

$contents .= '<tr><td colspan="2"><br /><br/><br/><div  style="text-align:justify" >
<table style="border:#666666 1px solid" border="1" cellspacing="0" cellpadding="0">
  <tr style="border:#666666 1px solid">
    <td  style="border:#666666 1px solid"><p align="center"><strong>क्र.</strong></p></td>
    <td style="border:#666666 1px solid" ><p align="center"><strong>विवरण	</strong></p></td>
    <td style="border:#666666 1px solid"><p align="center"><strong>दर</strong></p></td>
  </tr>
  <tr style="border:#666666 1px solid">
    <td style="border:#666666 1px solid" ><p>1</p></td>
    <td style="border:#666666 1px solid"><p>फोटो कापी शुल्क</p></td>
    <td style="border:#666666 1px solid" ><p>1.5/- रू. प्रति पेज</p></td>
  </tr>
  <tr style="border:#666666 1px solid" >
    <td style="border:#666666 1px solid" ><p>2</p></td>
    <td style="border:#666666 1px solid"><p>टाईपिंग शुल्क</p></td>
    <td style="border:#666666 1px solid" ><p>15/- रू. प्रति पेज</p></td>
  </tr>
  <tr>
    <td style="border:#666666 1px solid" ><p>3</p></td>
    <td style="border:#666666 1px solid" ><p>अनुवादक शुल्क</p></td>
    <td style="border:#666666 1px solid" ><p>60/- रू. प्रति पेज</p></td>
  </tr>
</table>
</div><br/></td></tr>';
$contents .= '<tr><td colspan="2"><p class="text-justify shift-left" >   उपरोक्तानुसार तालिका अनुसार भुगतान की दर निर्धारित हैं :-   </p><br/></td></tr>';
$contents .= '<tr><td colspan="2"><p class="text-justify shift-left" >  Postal Charges, Communication , एवं  Misc. Expenses  जो देय नहीं है, उसी अनुसार ';
if($is_genrate == true){
    foreach(get_advocates_name('', $post_data['member_id']) as $row){
        $contents .= ' '.$row->scm_name_hi;
    }
} else {
    $contents .= ' <select name="member_id">';
    foreach($standing_counsil_memebers as $row){
        $contents .= '<option value="'.$row->scm_id.'">'.$row->scm_name_hi.'</option>';
    }
    $contents .= '</select>';
}
$contents .=',';
if($is_genrate == true){
		$contents .= $post_data['nameadvocate12'];
		} else {
 $contents .= '<input name="nameadvocate12"  placeholder="अधिवक्ता "  type="text"  />';
}
 $contents .= ', द्वारा प्रस्तुत देयक से राशि कम करते हुए शेष राशि का भुगतान किया जाना उचित होगा :-   </p><br/></td></tr>';
$contents .= '<tr><td colspan="2"><p class="text-justify shift-left" > <table border="1" cellspacing="0" cellpadding="0" width="519">
  <tr>
    <td  style="border:#666666 1px solid"><p align="center"><strong>स. क्र.</strong></p></td>
    <td style="border:#666666 1px solid"><p align="center"><strong>माह</strong></p></td>
    <td style="border:#666666 1px solid"><p align="center"><strong>देयक की राशि</strong></p></td>
    <td style="border:#666666 1px solid"><p align="center"><strong>ओ.आई.सी. द्वारा दी गई राशि</strong></p></td>
    <td style="border:#666666 1px solid"><p align="center"><strong>कम की गई राशि </strong>(Postal Charges+ Communication    Charges+Misc. Expenses)</p></td>
    <td style="border:#666666 1px solid"><p align="center"><strong>शुद्ध देय राशि</strong></p></td>
  </tr>
  <tr>
    <td style="border:#666666 1px solid"><p align="center">1</p></td>
    <td style="border:#666666 1px solid"><p align="center">';
	
	if($is_genrate == true){
$contents .= $post_data['month3'];
} else {
$contents .=get_month('month3');
}
	 $contents .= '</p></td>
     <td style="border:#666666 1px solid"><p align="center">';
if($is_genrate == true){
$contents .= $post_data['month4'];
} else {
$contents .=get_month('month4');
}
	$contents .= ' </p></td>
    <td style="border:#666666 1px solid"><p align="center">0</p></td>
    <td style="border:#666666 1px solid"><p align="center">';
	if($is_genrate == true){
$contents .= $post_data['month7'];
} else {
$contents .=get_month('month7');
}
	$contents .= ' </p></td>
    <td style="border:#666666 1px solid"><p align="center"><strong></strong></p></td>
  </tr>
  <tr>
    <td style="border:#666666 1px solid"><p align="center"><strong>&nbsp;</strong></p></td>
    <td style="border:#666666 1px solid"><p align="center"><strong>योग</strong></p></td>
    <td style="border:#666666 1px solid"<p align="center"><strong></strong><strong>.00</strong></p></td>
    <td style="border:#666666 1px solid"><p align="center"><strong>0</strong></p></td>
    <td style="border:#666666 1px solid"><p align="center"><strong></strong><strong>.00</strong></p></td>
    <td style="border:#666666 1px solid"><p><strong></strong><strong>.00</strong></p></td>
  </tr>
</table></p><br/></td></tr>';

 $contents .='<tr><td colspan="2"><p class="text-justify shift-left" > ';
if($is_genrate == true){
    foreach(get_advocates_name('', $post_data['member_id']) as $row){
        $contents .= ' '.$row->scm_name_hi;
    }
} else {
    $contents .= ' <select name="member_id">';
    foreach($standing_counsil_memebers as $row){
        $contents .= '<option value="'.$row->scm_id.'">'.$row->scm_name_hi.'</option>';
    }
    $contents .= '</select>';
}
$contents .=', उच्चतम न्यायालय, नई दिल्ली द्वारा प्रस्तुत देयक की राशि रूपये ';
	if($is_genrate == true){
$contents .= $post_data['amount2'];
} else {
$contents .='<input name="amount2"  placeholder="amount "  type="text"  />';
}
$contents .=',(रू.';
	if($is_genrate == true){
$contents .= $post_data['amount23'];
} else {
$contents .=' <input name="amount23"  placeholder="amount in word "  type="text"  />';
}
$contents .=',केवल) में से नोटशीट के स.क्र. 10 एवं 11 जिसकी कुल राशि रू.';
	if($is_genrate == true){
$contents .= $post_data['amount23'];
} else {
$contents .=' <input name="amount234"  placeholder="amount  "  type="text"  /> ';
}
$contents .='(रू. ';
	if($is_genrate == true){
$contents .= $post_data['amount24'];
} else {
$contents .='<input name="amount24"  placeholder="amount in word "  type="text"  />';
}	
$contents .=' केवल) कम कर शेष राशि रूपये ';
if($is_genrate == true){
$contents .= $post_data['amount25'];
} else {
$contents .='<input name="amount25"  placeholder="amount"  type="text"  /> ';
}
$contents .='(रू. ';
if($is_genrate == true){
$contents .= $post_data['amount26'];
} else {
$contents .='<input name="amount26"  placeholder="amount in word "  type="text"  />';
}
$contents .='केवल) स्वीकृत की जाना प्रस्तावित है।</p><pclass="text-justify shift-left" >';

if($is_genrate == true){
    foreach(get_advocates_name('', $post_data['member_id']) as $row){
        $contents .= ' '.$row->scm_name_hi;
    }
} else {
    $contents .= ' <select name="member_id">';
    foreach($standing_counsil_memebers as $row){
        $contents .= '<option value="'.$row->scm_id.'">'.$row->scm_name_hi.'</option>';
    }
    $contents .= '</select>';
}
if($is_genrate == true){
$contents .= ','.$post_data['nameadvocate13'];
} else {
$contents .=', 
<input name="nameadvocate13"  placeholder="अधिवक्ता "  type="text"  />';
}
$contents .='द्वारा प्रस्तुत आउट आफ पाकेट के देयकों का भुगतान 29-2014-00-9999-6251-व्ही- 31-010 की मद से किया जावेगा।
	वर्तमान में उक्त मद में रू.';
	if($is_genrate == true){
	$contents .= $post_data['amount12'];
	} else {
	$contents .=' <input name="amount12"  placeholder="amount "  type="text"  />';
	}
	$contents .='-(रू.';
		if($is_genrate == true){
	$contents .= $post_data['amount254'];
	} else {
	$contents .='<input name="amount254"  placeholder="amount in word"  type="text"  />';
	}
	$contents .='- केवल) का व्यय हो चुका है। लगभग राशि रूपये 5 लाख उपलब्ध हैं। </p><br/></td></tr>';
	
$contents .= '<tr><td colspan="2"><p class="text-justify shift-left" > तदानुसार राशि रूपये ';
	if($is_genrate == true){
	$contents .= $post_data['amount121'];
	} else {
	$contents .= '<input name="amount121"  placeholder="amount "  type="text"  />';
	}
 $contents .= '(रू. ';
 if($is_genrate == true){
	$contents .= $post_data['amount256'];
	} else {
 $contents .='<input name="amount256"  placeholder="amount in word"  type="text"  />';
 }
 '- केवल) 
  केवल) स्वीकृत किया जा सकता है। 
 </p><br/></td></tr>';
 $contents .= '<tr><td colspan="2"><p class="text-justify shift-left" >
  कृपया अनुमोदनार्थ एवं आदेशार्थ प्रस्तुत है।
 </p><br/></td></tr>';
?>
<style>
.input{width:50px;}

</style>


