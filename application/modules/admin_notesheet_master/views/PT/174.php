<?php
$contents  = '' ;
$contents .= '<tr><td align="center" colspan="3" ><b><u><h3>BEFORE THE NATIONAL GREEN TRIBUNAL CENERAL  ZONAL<h3></u></b></td></tr>';
$contents .= '<tr><td align="center" colspan="3" ><b><u><h4>BENCH - BHOPAL<h4></u></b></td></tr>';
$contents .= '<tr><td align="center" colspan="3" ><b><u><h4>IN THE MATTER OF  No. ';
if($is_genrate == true){ 
	$contents .=  @$post_data['name'];
} else {
	$contents .= '<input type="text" class="" name="name" value="" required></div>';
}
if($is_genrate == true){ 
	$contents .=  ' '.$post_data['number'];
} else {
	$contents .= ' <input type="text" class="" name="number" value="'.$case_no.'(CZ)" required></div>';
}
$contents .= '<h4></u></b></td></tr>';
$contents .= '<tr><td align="center" colspan="3" ><b><u><h4>VAKALATNAMA <h4></u></b></td></tr>';
$contents .= '<tr><td align="right" colspan="3"><div style="float:left">';
if($is_genrate == true){ 
    $contents .=  $post_data['agenst'];
} else {
    $contents .= '<input type="text" class="" name="agenst" value="'.$agenst.'"/></div>';
}
$contents .=  '</div><div  style="float:right">PETITIONER(s)/APPLICANT</div></td></tr>';
$contents .= '<tr><td align="center" colspan="3" ><h5>VERSUS<h5></td></tr>';
$contents .= '<tr><td align="right" colspan="3"><div style="float:left">';
if($is_genrate == true){ 
    $contents .=  $post_data['agenst_name'];
} else {
    $contents .= '<input type="text" class="" name="agenst_name" value="'.$agenst_name.'"/></div>';
}
$contents .=  '</div><div  style="float:right">RESPONDENT(S)/OPP PARTIES.</div></td></tr>';

$contents .= '<tr><td align="right" colspan="3"><p> I <b>';
if($is_genrate == true){
$contents .=  get_officer_information($this->input->post('add_secetroy'),'en'); 

}else
{
     $contents .= get_officer_for_sign('add_secetroy' ,$add_secetroy ,'en', $as_id);
    
} 
 $contents .= '</b>, Additional Secretary to Govt of M.P. Law & Legislative Affairs Department, Bhopal, APPELLANT / RESPONDENT, do hereby appoint and retain ';if($is_genrate == true){
    foreach(get_advocates_name('', $post_data['member_id']) as $row){
        $contents .= ' <b>'.$row->scm_name.'</b>';
    }
} else {
    $contents .= ' <select name="member_id">';
    foreach($standing_counsil_memebers as $row){
        $contents .= '<option value="'.$row->scm_id.'">'.$row->scm_name.'</option>';
    }
    $contents .= '</select>';
}
 $contents .= ' Advocate of the <b>NATIONAL GREEN TRIBUNAL CENERAL  ZONAL BENCH - BHOPAL </b>to act and appeal for me/ us in the Suit / Appeal / Petitioner / Reference on my / our behalf to conduct and defend or withdraw the same and all proceedings that may be taken in respect of any application connected with the same and all proceedings that may be taken in respect of any application connected with the same or any decree or order passed therein, including proceedings in taxation and applications for reviews to file and obtain return documents and to deposit and receive money on my / our behalf in the above Suit / Appeal / Petition Reference and in application if review, and to represent me / us and to take all necessary steps on my / our behalf in the above matter. I/We agree to rectify all acts done Dated <b>';
if($is_genrate == true){ 
    $contents .=  $post_data['day'];
} else {
    $contents .= '<input type="text" class="" name="day" />';
}
if($is_genrate == true){ 
    $contents .=  $post_data['sufix'];
} else {
	$contents .= ' <select  class="" name="sufix" >';
	foreach($sufix_list as $list){
		$contents .= '<option value="'.$list.'">'.$list.'</option>';
	}
    $contents .= ' </select>';
}
$contents .=  ' day of ';
if($is_genrate == true){ 
    $contents .=  $post_data['month'];
} else {
	$contents .= ' <select  class="" name="month" >';
	foreach(months() as $month){
		$contents .= '<option value="'.$month.'">'.$month.'</option>';
	}
    $contents .= ' </select>';
}
if($is_genrate == true){ 
    $contents .=  ' '.$post_data['year'];
} else {
    $contents .= ' <select  class="" name="year" >';
	$i = 1980;
	while($i < 2020){
		$selct = $i == date('Y') ? 'selected' : '';
		$contents .= '<option value="'.$i.'" '.$selct.'>'.$i.'</option>';
	 $i++; }
    $contents .= ' </select>';
}
$contents .= ' </b></p></td></tr>';
if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right"><div  style="width:50%; text-align:center;">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td>&nbsp;</td></tr>';
} 
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">(';
if($is_genrate == true){
	$contents .=  get_officer_information($this->input->post('add_secetroy'),'en'); 
}else{
     $contents .= '------------';
}
$contents .=  ')</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">Additional Secretary to Government</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">Plaintiff(s)/ Departments(s)</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">Petitioner(s)/ Appellant(s)</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">Respondents(s)/ Opp. Parties(s)</div></td></tr>';
$contents .= '<tr><td>Accepted</td></tr>';

if($is_genrate == true){
    foreach(get_advocates_name('', $post_data['member_id']) as $row){
        $contents .= ' <tr><td><b>('.$row->scm_name.')</b></td></tr>';
		$contents .= ' <tr><td>'.$row->scm_post.' '.$row->scm_court_name.',</td></tr>';
		$contents .= ' <tr><td>'.$row->scm_address.', '.$row->scm_pincode.'</td></tr>';
    }
} else {
	$contents .= '<tr><td></td></tr> ';
}

$contents .= '<tr> <td style="border-bottom:1px solid #000;"></td></tr>';
$contents .= '<tr><td align="center"><span style="font-size:10px;">Memo of appearance</span></td></tr>';
$contents .= '<tr><td align="left">To,</td></tr>';
$contents .= '<tr><td align="left">The Registrar,</td></tr>';
$contents .= '<tr><td align="left"><b>NATIONAL GREEN TRIBUNAL</b>,</td></tr>';
$contents .= '<tr><td align="left"><b>CENERAL  ZONAL</b></td></tr>';
$contents .= '<tr><td align="left"><b>BENCH - BHOPAL</b></td></tr>';
$contents .= '<tr><td align="left">Sir,</td></tr>';
$contents .= '<tr><td align="left">Please enter the appearance for the above named Plaintiff(s) / Defendant(s) / Petitioner(s) / Appellant (s) / Respondents(s) / Opp. Parties in Petition / Suit / Reference / Appeal ';
if($is_genrate == true){ 
    $contents .=  ' '.$post_data['name2'];
} else {
    $contents .= ' <input type="text" class="" name="name2" value=""/>';
}
$contents .= ' </td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;"><br>Yours faithfully</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">';
if($is_genrate == true){
    foreach(get_advocates_name('', $post_data['member_id']) as $row){
        $contents .= ' <b>('.$row->scm_name.')</b>';
    }
} else {
	$contents .= ' ';
}
?>
