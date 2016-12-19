<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function auto_update_advocate_posting($adv_post_type,$post_district_id=null,$tehsilid=null,$talukaid=null){
	$CI = & get_instance();
    $CI->db->select('advocate_posting_id,vacant_seats,approved_posts,filled_posts,district_id,tahsil_id,taluka_id');
    $CI->db->where('advocate_type',$adv_post_type);
    $query = $CI->db->get(ADVOCATE_POSTING);
    // echo $CI->db->last_query();
    $result = $query->result_array();	
	//pr($result);	
	foreach($result as $ky=>$val){
		$CI->db->select('count("scm_id") as totalno');
		if(!empty($val['district_id'])){
			$dist_id = $val['district_id'];
			//$disr_array=array('scm_district_id'=>$dist_id);
			$CI->db->where(array('scm_district_id'=>$dist_id));
		}
		if(!empty($val['tahsil_id'])){
			$tahsil_id = $val['tahsil_id'];			
			$CI->db->where(array('scm_tahsil_id'=>$tahsil_id));
		}		
		if(!empty($val['taluka_id'])){			
			$taluka_id = $val['taluka_id'];
			$CI->db->where(array('scm_taluka_id'=>$taluka_id));
		}	
		$CI->db->where(array('status'=>1,'advocate_post_type'=>$adv_post_type,'working_status'=> 0));		
		$query = $CI->db->get(ADVOCATE_MASTER);
		//echo '<pre>';
		//echo '<br/>bije'.$CI->db->last_query();
		$advoccate_result = $query->row_array();
		
		$total_filled_no_post = $advoccate_result['totalno'];
		$filled_posts = $val['filled_posts'];
		$vacant_seats = $val['vacant_seats'];
		$approved_posts = $val['approved_posts'];
		$filled_posts=$total_filled_no_post;
		
		$update_vacant_seats=($approved_posts-$filled_posts);
		$update_post_array = array('filled_posts'=>$filled_posts,
			  'vacant_seats'=>$update_vacant_seats
		);		
		updateData(ADVOCATE_POSTING,$update_post_array,array('advocate_posting_id'=>$val['advocate_posting_id']));
		//pre($advoccate_result);
	}
    //$CI->db->order_by('file_section_id', 'DESC');	
}
function get_panel_data( $adv_id = null){
    $CI = & get_instance();
    $CI->db->select('panel_id,panel_advocate_id ,panel_post_id,panel_district_id,panel_tehsil_id, panel_taluka_id,panel_status,panel_discription, panel_create_date,panel_close_date');
    $CI->db->where('panel_advocate_id',$adv_id);
    $CI->db->limit('1');
    $CI->db->order_by("panel_id", 'DESC');
    $query = $CI->db->get(ADVOCATE_PANEL);
    $result = $query->row_array();
    return $result;
}
function get_agp_districtwise($distid,$tehsilId){	
	$CI = & get_instance();
    $CI->db->select('vacant_seats,approved_posts,filled_posts,district_id,tahsil_id');
    $CI->db->where(array('advocate_type'=>1,'district_id'=>$distid));
    $query = $CI->db->get(ADVOCATE_POSTING);
    $result = $query->row_array();
    return $result;	
	//SELECT vacant_seats,approved_posts,filled_posts FROM `ft_advocate_posting_master` where advocate_type=1 and 
	//district_id=203 
}
	