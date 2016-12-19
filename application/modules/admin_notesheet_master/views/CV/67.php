<style>
	td{
	padding: 2px !important;
}
</style>
<?php 
$contents  = '' ;
$contents .= '<tr><td align="center">';
if($is_genrate == true){
	$contents .= '<h5 style="margin:0px;">'.$post_data['title_type'];
} else {
	$contents .= '<select name="title_type" class="title_type">';
	$contents .= '<option value="BEFORE HON’BLE THE SUPREME COURT OF INDIA">BEFORE HON’BLE THE
	SUPREME COURT OF INDIA</option>';
	$contents .= '<option value="BEFORE HON’BLE NATIONAL GREEN TRIBUNAL">BEFORE HON’BLE NATIONAL
	GREEN TRIBUNAL</option>';
	$contents .= '<option value="BEFORE HON’BLE CENTRAL SALES TAX APPELLATE AUTHORITY">BEFORE HON’BLE CENTRAL SALEX TAX APPELLATE AUTHORITY</option>';
	$contents .= '</select>';
}
if($is_genrate == true){
	$contents .= ''.$post_data['title_loc'];
} else {
	$contents .= ' <select name="title_loc" class="title_loc">';
	$contents .= '<option value=""></option>';
	$contents .= '<option value=", NEW DELHI">NEW DELHI</option>';
	$contents .= '<option value=", BHOPAL">BHOPAL</option>';
	$contents .= '</select>';
}
$contents .= '</h5></td></tr>';
$contents .= '<tr><td align="center"><h6 style="margin:0px;"> IN THE MATTER OF ';
if($is_genrate == true){ 
	$contents .=  @$post_data['name'];
} else {
	$contents .= '<input type="text" class="" name="name" value="SLP" required></div>';
}
if($is_genrate == true){ 
	$contents .=  ' '.$post_data['number'];
} else {
	$contents .= ' <input type="text" class="" name="number" required></div>';
}
$contents .= ' </h6></td></tr>';
$contents .= '<tr><td align="center"><h5 style="margin:0px;">VAKALATNAMA</h5></td></tr>';
$contents .= '<tr><td align="left"><div style="float:left;">';
if($is_genrate == true){ 
    $contents .=  $post_data['agenst'];
} else {
    $contents .= '<input type="text" class="" name="agenst" value="'.$agenst.'"/></div>';
}
$contents .= ' </div><div style="float:right;">PETITIONER(s)/APPLICANT</div></td></tr>';
$contents .= '<tr><td align="center">VERSUS</td></tr>';
$contents .= '<tr><td align="left"><div style="float:left;">';
if($is_genrate == true){ 
    $contents .=  $post_data['agenst_name'];
} else {
    $contents .= '<input type="text" class="" name="agenst_name" value="'.$agenst_name.'"/></div>';
}
$contents .= '</div><div style="float:right;">RESPONDENT(S)/OPP PARTIES.</div></td></tr>';
$contents .= '<tr><td align="left"><p>I ';
if($is_genrate == true){
	$contents .=  get_officer_information($this->input->post('add_secetroy'),'en'); 
}else{
     $contents .= get_officer_for_sign('add_secetroy' ,array(2,3,4,5,7,11) ,'en', $us_id);
}
$contents .= ', ';
if($is_genrate == true){	
    $contents .=   get_officer_dign($this->input->post('add_secetroy'),'en');
}
else {
	$contents .= '-------';
}
$contents .= ',  to Govt of M.P. Law & Legislative Affairs Department, Bhopal, APPELLANT / RESPONDENT, do hereby appoint and retain';
if($is_genrate == true){
    foreach(get_advocates_name('', $post_data['member_id']) as $row){
        $contents .= ' <b>'.$row->scm_name_en.'</b>';
    }
} else {
    $contents .= ' <select name="member_id">';
    foreach($standing_counsil_memebers as $row){
        $contents .= '<option value="'.$row->scm_id.'">'.$row->scm_name_en.'</option>';
    }
    $contents .= '</select>';
}
$contents .= ' Advocate of the Supreme Court of India to act and appeal for me/ us in the Suit / Appeal / Petitioner / Reference
 on my / our behalf to conduct and defend or withdraw the same and all proceedings that may be taken in respect of any application 
 connected with the same and all proceedings that may be taken in respect of any application connected with the same or any 
 decree or order passed therein, including proceedings in taxation and applications for reviews to file and obtain return 
 documents and to deposit and receive money on my / our behalf in the above Suit / Appeal / Petition Reference and in application
 if review, and to represent me / us and to take all necessary steps on my / our behalf in the above matter. I/We agree to 
 rectify all acts done Dated ';
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
$contents .=  '.</td></tr>';

if(($this->uri->segment(6) != 'p' && $is_genrate == false) ||  ($this->uri->segment(7) != 'p' && $is_genrate == true)){
	$contents .= '<tr><td align="right"><div  style="width:70%; text-align:center;">(Digitally Signed)</div></td></tr>';
} else {
	$contents .= '<tr><td>&nbsp;</td></tr>';
} 
$contents .= '<tr><td align="right"><div style="width:70%; text-align:center;">(';
if($is_genrate == true){
	$contents .=  get_officer_information($this->input->post('add_secetroy'),'en'); 
}else{
     $contents .= '------------';
}
$contents .=  ')</div></td></tr>'; 
$contents .= '<tr><td align="right"><div style="width:70%; text-align:center;">';
if($is_genrate == true){	
    $contents .=   get_officer_dign($this->input->post('add_secetroy'),'en');
}
else {
	$contents .= '-------';
}
$contents .= ' to Government</div></td></tr>';  
$contents .= '<tr><td align="right"><div style="width:70%; text-align:center;">Plaintiff(s)/ Departments(s)/Petitioner(s)/ Appellant(s)</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:70%; text-align:center;">Respondents(s)/ Opp. Parties(s)</div></td></tr>';
$contents .= '<tr><td><div> Accepted </div>';

if($is_genrate == true){
    foreach(get_advocates_name('', $post_data['member_id']) as $row){
        $contents .= ' <div><b>('.$row->scm_name_en.')</b></div>';
		$contents .= ' <div>'.$row->scm_post_en.' '.$row->scm_court_name_en.',</div>';
		$contents .= ' <div>'.$row->scm_address_en.', '.$row->scm_pincode.'</div>';
    }
} else {
	$contents .= ' ';
}
$contents .= '</td></tr>';
$contents .= '<tr> <td style="border-bottom:1px solid #000;"></td></tr>';
$contents .= '<tr><td align="center"><span style="font-size:10px;">Memo of appearance</span></td></tr>';
$contents .= '<tr><td align="left"><div>To,</div>';

$contents .= '<div>The Registrar,</div>';
$contents .= '<div>Supreme Court of India,</div>';
$contents .= '<div>New Delhi - 110 001</div>';
$contents .= '<div>Sir,</div> </td></tr>';
$contents .= '<tr><td align="left">Please enter the appearance for the above named Plaintiff(s) / Defendant(s) / Petitioner(s) / Appellant (s) / Respondents(s) / Opp. Parties in Petition / Suit / Reference / Appeal';
if($is_genrate == true){ 
    $contents .=  ' '.$post_data['name2'];
} else {
    $contents .= ' <input type="text" class="" name="name2" value=""/>';
}
$contents .= ' </td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">Yours faithfully</div></td></tr>';
$contents .= '<tr><td align="right"><div style="width:50%; text-align:center;">';
if($is_genrate == true){
    foreach(get_advocates_name('', $post_data['member_id']) as $row){
        $contents .= ' <b>('.$row->scm_name_en.')</b>';
    }
} else {
	$contents .= ' ';
}
$contents .= '</div></td></tr>';

?>
