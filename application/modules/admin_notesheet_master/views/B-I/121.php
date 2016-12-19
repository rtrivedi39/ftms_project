<?php
$contents  = '' ;
$contents .= '<tr><td align="right" colspan="3"><b>REGD. AD.</b></td><tr>';
$contents .= '<tr><td align="center" colspan="3" style="font-weight: bold; font-size:14px;">GOVERNMENT OF MADHYA PRADESH</td></tr>';
$contents .= '<tr><td align="center" colspan="3" style="font-weight: bold; font-size:14px;">LAW AND LEGISLATIVE AFFAIRS DEPARTMENT</td></tr>';
$contents .= '<tr><td align="center" colspan="3" style="font-weight: bold; font-size:14px;">Ist FLOOR VINDHYACHAL BHAWAN</td></tr>';
$contents .= '<tr><td align="center" colspan="3" style="font-weight: bold; font-size:14px;">BHOPAL</td></tr>';
$contents .= '<tr><td colspan="2"><table width="100%"><tr><td align="left">No.3(B) '.$panji_krmank.'/21-B(1), </td><td align="right"> Bhopal, Dated '.$file_mark_section_date.'</td></tr></table></td></tr>';

$contents .= '<tr><td valign="top"  width="55px">To,</td><td colspan="2"></td> </tr>';
$contents .= '<tr><td></td><td>The Superintendent of Police, </td></tr>';
$contents .= '<tr><td></td><td>';
if($is_genrate == true){
	$contents .= $post_data['dist'];
}else{
	 $contents .= get_distic_dd('dist','','','english');//'<select name="dist"><option>BHIND</option><option>GWALIOR</option><option>BHOPAL</option></select>';
}


$contents .= '(M.P.) ';
$contents .= '</td></tr>';
$contents .= '<tr><td></td><td colspan="2">';
if($is_genrate == true){
	$contents .= $post_data['p_name'];
}else{
	 $contents .= '<input type="text" name="p_name" size="50" id="p_name" value="" >';
}

$contents .= ' whose particulars are shown in the Enclosed attestation form is a candidate for the post of Civil Judge-2 (Entry Level) in Madhya Pradesh Judicial Service. </p></td></tr>';
$contents .= '<tr><td  valign="top" ></td><td valign="top" colspan="2" >';
$contents .= '<p>You are requested to verify his/her character antecedents and certify on the basis of the information available in the police records whether he/she has come to adverse notice or not and whether there are any facts about him/her on record which would render the candidate unsuitable for employment under Govenment. In this connection it may be stated that the criteria to be observed for determining suitability of candidate as prescribed by the State Govenment are that no person should be considered unfit for appointment solely because of this political opinions but care has to be taken not to employ persons who are likely to be disloyal and to abuse the confidence placed in them by virtue of their appointment persons who are actively engaged in subversive activities including members of any organisation, the object of which is to change the existing order of society by violent means, should be considered fit for appointment under Govenment. An individual may be considered unsuitable for public employment only on the ground of his actual participation in association any objectionable activity programmed, specifically the following shall be considered undesirable for employment in civil posting the public services:- </p></td></tr>';
$contents .= '<tr><td  valign="top" ></td><td valign="top" colspan="2" >';
$contents .= '<p>(A)Those who are or have been members of, or associated with anybody or association declared unlawful after it was so  declared; or   </p>';
$contents .= '<p>(B)  Those who have participated in, or associated with any activity or  programme.</p>';
$contents .= '<p> Aimed at the subversion of the constitution.</p>';
$contents .= '<p>Aimed at the organised breach of defence of the law involving violence; </p>';
$contents .= '<p>Prejudicial to the interests of the sovereignty and integrity of India  or the security of the State or; </p>';
$contents .= '<p>Which promotes on grounds of religion, race, language caste or community, feelings of enmity or hatred between different sections of the people; participation in such activities at any time after attaining the age of 21 years and within three years of date of enquiry should be considered as evidence that the person is still actively engaged in such activities unless in the interval there is positives evidence of a change of attitude. It is requested it may be specifically indicated whether or not the candidate is suitable for employment under Govenment in the light of the criteria mentioned above. If in your opinion he/she is unsuitable bring reasons may please be communicated immediately. </p>';

$contents .= '<p>ENDT:- -BHOPAL(M.P.)</p></td></tr>';

/*$contents .= '<tr><td align="right" height="40"></td></tr>';*/
$contents .= '<tr><td colspan="3" align="right"><div  contenteditable="false"  class="officer-center">( ';
if($is_genrate == true){
	$contents .=  get_officer_information($this->input->post('avar_secetroy') ,'English'); 
}else{
    $contents .= get_officer_for_sign('avar_secetroy' ,$uber_sect ,'English', $us_id );
}
$contents .= ' )</div></td></tr>';
$contents .= '<tr><td colspan="3" align="right"><div  contenteditable="false"  class="officer-center ">';

if($is_genrate == true){    
    $contents .=   get_officer_dign($this->input->post('avar_secetroy'),'English');
}else{
    $contents .= '-------';
}
	
$contents .= '</div></td></tr>';
$contents .= '<tr><td align="right"  colspan="3"  align="right"><div class="law_dept" style="">Govt. of M.P., Law & Legislative Affairs Department</div></td></tr>';	
$contents .= '<tr><td colspan="2"><table width="100%"><tr><td align="left">EndtNo.3(B) '.$panji_krmank.'/21-B(1), </td><td align="right"> Bhopal, Dated '.$file_mark_section_date.'</td></tr></table></td></tr>';
$contents .= '<tr><td colspan="2"><p>Copy with a copy of the Attestation form, forwarded to the Deputy Inspector General of Police, Intelligence, Madhya Pradesh Bhopal for information and necessary action at any early date.</p></td></tr>';
$contents .= '<tr><td align="right" height="40"></td></tr>';
$contents .= '<tr><td colspan="3" align="right"><div  contenteditable="false"  class="officer-center">( ';
if($is_genrate == true){
	$contents .=  get_officer_information($this->input->post('avar_secetroy') ,'English'); 
}else{
    $contents .= get_officer_for_sign('avar_secetroy' ,$uber_sect ,'English', $us_id);
}
$contents .= ' )</div></td></tr>';
$contents .= '<tr><td colspan="3" align="right"><div  contenteditable="false"  class="officer-center ">';

if($is_genrate == true){    
    $contents .=   get_officer_dign($this->input->post('avar_secetroy'),'English');
}else{
    $contents .= '-------';
}
	
$contents .= '</div></td></tr>';
?>
