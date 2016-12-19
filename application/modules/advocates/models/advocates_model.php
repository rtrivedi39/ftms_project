<?php

class Advocates_model extends CI_Model {

 	function __construct() {
        parent::__construct();
		
    } 
	
	function get_advocate_list($adv_post_type=null,$distid=null,$tehsil_id=null,$taluka_id= null, $search_type = null){
		$today = date('Y-m-d');
		//$tbl_advocate = "ft_advocate_master_original";
		$tbl_advocate = 'ft_advocate_master';
        $tbl4 = ADVOCATE_SERVICE_RECORD;
	    $attchament = ADVOCATE_ATTACHMENT;
		$tbl_district = DISTICT_MASTER;
		$tbl_tehsil = TAHSIL_MASTER;
	    //$this->db->select('.*,dept_name_hi,district_name_hi');
        $this->db->join($tbl4, "$tbl4.asr_scm_id = $tbl_advocate.scm_id", 'left');
		$this->db->join($tbl_district, "$tbl_advocate.scm_district_id = $tbl_district.district_id", 'left');
        $this->db->join($tbl_tehsil, "$tbl_advocate.scm_tahsil_id = $tbl_tehsil.tahsil_id", 'left');
        if($adv_post_type == 9){
			$this->db->join($attchament,  $attchament.'.sci_id = '.$tbl_advocate.'.scm_id' , 'right');
			
		}
		$this->db->where($tbl_advocate.'.status','1');
		$this->db->where($tbl_advocate.'.advocate_post_type',$adv_post_type);
		$district_id = $this->input->post('district_id');
		$tahsil_id = $this->input->post('tahsil_id');
		$taluka_id = $this->input->post('taluka_id');
		if(!empty($district_id)){
			$this->db->where($tbl_advocate.'.scm_district_id',$district_id );
		}
		if(!empty($tahsil_id)){
			$this->db->where($tbl_advocate.'.scm_tahsil_id',$tahsil_id );
		}
		if(!empty($taluka_id)){
			$this->db->where($tbl_advocate.'.scm_taluka_id',$taluka_id);
		}
		if(!empty($search_type)){
			if($search_type == 'rdo'){
				$this->db->where("date(post_renew_date) < '$today'");
			}
			if($search_type == 'smtr'){
				$this->db->where("date(post_renew_date) > '$today'");
				$this->db->order_by('date(post_renew_date)','ASC');
			}
		}
		$this->db->order_by($tbl_district.'.district_name_en','ASC');
		$this->db->order_by($tbl_tehsil.'.tahsil_name_en','ASC');
		$this->db->order_by($tbl_advocate.'.scm_id','desc');
        $query = $this->db->get($tbl_advocate);
        // echo $this->db->last_query();
        return $query->result_array();
	}
	
	function getadvocate_details($id ,$adv_post_type){
		$tbl_advocate = ADVOCATE_MASTER;
        $tbl4 = ADVOCATE_SERVICE_RECORD;
        $attchament = ADVOCATE_ATTACHMENT;
        //$this->db->select('.*,dept_name_hi,district_name_hi');
        $this->db->join($tbl4, "$tbl4.asr_scm_id = $tbl_advocate.scm_id", 'inner');
        
        if($adv_post_type == 9){
            $this->db->join($attchament,  $attchament.'.sci_id = '.$tbl_advocate.'.scm_id' , 'left');
        }
		$this->db->where($tbl_advocate.'.status','1');
		$this->db->where($tbl_advocate.'.scm_id',$id);
        $query = $this->db->get($tbl_advocate);
      // echo $this->db->last_query();
        return $query->result_array();
	}
	function get_advocate_type($coulmn_name, $where, $issingle = true){
		$tbl_advocate = ADVOCATE_TYPE;
        $this->db->select($coulmn_name);
		$this->db->where($where);
        $query = $this->db->get($tbl_advocate);
       //  echo $this->db->last_query();
	   if($issingle == true){
		   return $query->row_array();		
	   }else{
			return $query->result();		   
	   }
	}
	
	function get_advocate_post_single($id ){
		$tbl_advocate_post = ADVOCATE_POSTING;
		$this->db->where($tbl_advocate_post.'.advocate_posting_id',$id);
        $query = $this->db->get($tbl_advocate_post);
       //  echo $this->db->last_query();
        return $query->result_array();
	}
	function get_advocate_post( ){
		$tbl_advocate_post = ADVOCATE_POSTING;
		//$this->db->where($tbl_advocate_post.'.advocate_posting_id',$id);
        $query = $this->db->get($tbl_advocate_post);
       //  echo $this->db->last_query();
        return $query->result_array();
	}
	public function getadvocate_type()
	{
		$select = 'adm_id,adm_name, count( advocate_post_type) as countadv';
		$this->db->from('advocate_name_master'); 
		$this->db->join('ft_advocate_master','advocate_post_type = adm_id','left');
		$this->db->group_by('advocate_post_type');
		$this->db->select($select);
	   	$query = $this->db->get();
      	return $query->result();
     
	}
	public function get_civijudgecharacter($judge_id = '')
	{
		
		$this->db->where('judge_id',$judge_id);
        $query = $this->db->get(ADVOCATE_CIJ_CHAR_CERTIFICATE);
       //  echo $this->db->last_query();
        return $query->result_array();
	}
	public function delete_judgecharacter($judge_id)
	{
		$this->db->where('judge_id',$judge_id);
       	return $this->db->delete(ADVOCATE_CIJ_CHAR_CERTIFICATE);
    }
	public function get_registration_number( $registration_number = null ){
		$tbl_advocate_master = ADVOCATE_MASTER;
		$this->db->where('once_registration_number_council',$registration_number);
        $query = $this->db->get($tbl_advocate_master);
        //echo $this->db->last_query();
        return $query->num_rows();
	}
	public function delete_char_certificate($judge_car_id = null ){
		$this->db->where('charater_certificate_id',$judge_car_id);
		$query = $this->db->get('civil_judge_charater_certificate');
		$certi_files_details = $query->row();
		if( file_exists('./uploads/civil_judge/'.$certi_files_details->upload_file_name) ){
			unlink('./uploads/civil_judge/'.$certi_files_details->upload_file_name);                 
		}
		$this->db->where('charater_certificate_id',$judge_car_id);
        return $this->db->delete('civil_judge_charater_certificate');
	}
	public function delete_records($judge_id = null ){
	
		$this->db->where('charater_certificate_id',$judge_id);
		$query_cer = $this->db->get(ADVOCATE_CIJ_CHAR_CERTIFICATE);
		
		$certi_files_details = $query_cer->result();
		foreach($certi_files_details  as $certi_files_detail){
			if( file_exists('./uploads/civil_judge/'.$certi_files_detail->upload_file_name) ){
				unlink('./uploads/civil_judge/'.$certi_files_detail->upload_file_name);                 
			}
		}
		$this->db->where('judge_id',$judge_id);
        $this->db->delete(ADVOCATE_CIJ_CHAR_CERTIFICATE);
        
		
		$this->db->where('sci_id',$judge_id);
		$query = $this->db->get(ADVOCATE_ATTACHMENT);
		$attachment_docs = $query->result();
		foreach($attachment_docs as $attchment){
			if( file_exists('./uploads/civil_judge/'.$attchment->fitness_file_upload_path) ){
				unlink('./uploads/civil_judge/'.$attchment->fitness_file_upload_path);                 
			}
			if( file_exists('./uploads/civil_judge/'.$attchment->cast_cert_upload_path) ){
				unlink('./uploads/civil_judge/'.$attchment->cast_cert_upload_path);                 
			}
			if( file_exists('./uploads/civil_judge/'.$attchment->non_opjection_cert_path) ){
				unlink('./uploads/civil_judge/'.$attchment->non_opjection_cert_path);                 
			}
		}
		
		$this->db->where('sci_id',$judge_id);
        $this->db->delete(ADVOCATE_ATTACHMENT);
        
        $this->db->where('asr_scm_id',$judge_id);
        $this->db->delete(ADVOCATE_SERVICE_RECORD);
        
        $this->db->where('scm_id',$judge_id);
        $this->db->delete(ADVOCATE_MASTER);
	}
	public function get_section_number( $section_number = null ){
		
		$this->db->where('advocate_file_cr_no',$section_number);
        $query = $this->db->get(ADVOCATE_SERVICE_RECORD);
        //echo $this->db->last_query();
        return $query->num_rows();
	}
	public function advocate_post_from_district($distrcit_id = null ,$tahsil_id = null , $advocate_post_type = null )
	{
		if(!empty($distrcit)){
			$this->db->where('district_id',$distrcit_id);
		}
		if(!empty($tahsil)){
			$this->db->where('tahsil_id',$tahsil_id);
		}
		if(!empty($advocate_post_type)){
			$this->db->where('advocate_type',$advocate_post_type);
		}
		$query = $this->db->get(ADVOCATE_POSTING);
		//echo $this->db->last_query();
		return $query->result();
	}
	public function advocate_update_post($distrcit_id = null ,$tahsil_id = null , $advocate_post_type = null ,$advocate_post_type = null ,$adv_post_data = null  , $update_id = null ){
		if(!empty($distrcit)){
			$this->db->where('district_id',$distrcit_id);
		}
		if(!empty($tahsil)){
			$this->db->where('tahsil_id',$tahsil_id);
		}
		if(!empty($advocate_post_type)){
			$this->db->where('advocate_type',$advocate_post_type);
		}
		$this->db->where('advocate_posting_id',$update_id);
		$this->db->update(ADVOCATE_POSTING,$adv_post_data);
		
		
	//	echo $this->db->last_query();
	die;
	}
	
	function get_advocate_list_by_postid($adv_post_type){
		$tbl_district = DISTICT_MASTER;
		$tbl_tehsil = TAHSIL_MASTER;
		$tbl_posting = ADVOCATE_POSTING;
		$this->db->select('advocate_posting_id,vacant_seats,approved_posts,filled_posts,'.$tbl_posting.'.district_id,'.$tbl_tehsil.'.tahsil_id,taluka_id,'.$tbl_district.'.district_name_en,'.$tbl_district.'.district_name_hi,'.$tbl_tehsil.'.tahsil_name_hi,'.$tbl_tehsil.'.tahsil_name_en');
		//$this->db->select('advocate_posting_id,vacant_seats,approved_posts,filled_posts,district_id,tahsil_id,taluka_id');
		$this->db->from(ADVOCATE_POSTING);
		$this->db->join($tbl_district, "$tbl_posting.district_id = $tbl_district.district_id", 'left');
        $this->db->join($tbl_tehsil, "$tbl_posting.tahsil_id = $tbl_tehsil.tahsil_id", 'left');

		$this->db->where('advocate_type',$adv_post_type);
		$this->db->order_by($tbl_district.'.district_name_en','ASC');
		$this->db->order_by($tbl_tehsil.'.tahsil_name_en','ASC');
		$query = $this->db->get();		
		//echo $this->db->last_query();
		$result = $query->result_array();	
        return $query->result_array();
	}
	
	function get_advocate_agp_gp_segtion(){
		$tbl_district = DISTICT_MASTER;
		$tbl_tehsil = TAHSIL_MASTER;
		$tbl_posting = ADVOCATE_POSTING;
		$this->db->select('advocate_posting_id,vacant_seats,approved_posts,filled_posts,advocate_type,'.$tbl_posting.'.district_id,'.$tbl_tehsil.'.tahsil_id,taluka_id,'.$tbl_district.'.district_name_en,'.$tbl_district.'.district_name_hi,'.$tbl_tehsil.'.tahsil_name_hi,'.$tbl_tehsil.'.tahsil_name_en');
		//$this->db->select('advocate_posting_id,vacant_seats,approved_posts,filled_posts,district_id,tahsil_id,taluka_id');
		$this->db->from(ADVOCATE_POSTING);
		$this->db->join($tbl_district, "$tbl_posting.district_id = $tbl_district.district_id", 'left');
        $this->db->join($tbl_tehsil, "$tbl_posting.tahsil_id = $tbl_tehsil.tahsil_id", 'left');
		$adv_type = array(2);
		$this->db->where_in('advocate_type',$adv_type);
		$this->db->order_by($tbl_district.'.district_name_en','ASC');
		$this->db->order_by($tbl_tehsil.'.tahsil_name_en','ASC');
		$query = $this->db->get();			
		//$result = $query->result_array();	
		

        return $query->result_array();
	}
/*	function manage_panel(){

        $data_is = array(
            'panel_advocate_id' => $this->input->post('panel_advocate_id'),
            'panel_post_id'  	=> $this->input->post('panel_post_id'),
            'panel_district_id'	=> $this->input->post('panel_district_id'),
            'panel_tehsil_id'  	=> $this->input->post('panel_tehsil_id'),
            'panel_taluka_id'  	=> $this->input->post('panel_taluka_id'),
            'panel_status'  	=> $this->input->post('panel_status'),
            'panel_discription'	=> $this->input->post('panel_discription'),
            'panel_create_date' => @$this->input->post('panel_status') == 'Y' ? date('Y-m-d H:i:s') : null,
            'panel_close_date'  => @$this->input->post('panel_status') == 'N' ? date('Y-m-d H:i:s') : null,
            'panel_entry_date'  => date('Y-m-d H:i:s'),
        );

        $res = insertData_with_lastid($data_is, ADVOCATE_PANEL);
        if($res){
            return true ;
        }else{
            return false;
        }
    } */
	
	
	
	function manage_panel($advocate_id = null , $data1 = null){
        if($advocate_id != null){
        $panel_advocate_id =  $advocate_id;
        }else{
        $panel_advocate_id = $this->input->post('panel_advocate_id');
        }
        if($data1 != null && isset($data1['advocate_post_type'])){
        $panel_post_id =  $data1['advocate_post_type'];
        }else{
        $panel_post_id = $this->input->post('panel_post_id');
        }
        if($data1 != null && isset($data1['scm_district_id'])){
        $panel_district_id =  $data1['scm_district_id'];
        }else{
        $panel_district_id = $this->input->post('panel_district_id');
        }
        if($data1 != null && isset($data1['scm_tahsil_id'])){
        $panel_tehsil_id =  $data1['scm_tahsil_id'];
        }else{
        $panel_tehsil_id = $this->input->post('panel_tehsil_id');
        }
        if($data1 != null && isset($data1['scm_taluka_id'])){
        $panel_taluka_id =  $data1['scm_taluka_id'];
        }else{
        $panel_taluka_id = $this->input->post('panel_taluka_id');
        }

        $data_is = array(
            'panel_advocate_id' => $panel_advocate_id,
            'panel_post_id'  	=> $panel_post_id,
            'panel_district_id'	=> $panel_district_id,
            'panel_tehsil_id'  	=> $panel_tehsil_id,
            'panel_taluka_id'  	=> $$panel_taluka_id,
            'panel_status'  	=> $this->input->post('panel_status'),
            'panel_discription'	=> $this->input->post('panel_discription'),
            'panel_create_date' => @$this->input->post('panel_status') == 'Y' ? date('Y-m-d H:i:s') : null,
            'panel_close_date'  => @$this->input->post('panel_status') == 'N' ? date('Y-m-d H:i:s') : null,
            'panel_entry_date'  => date('Y-m-d H:i:s'),
        );
        $res = insertData_with_lastid($data_is, ADVOCATE_PANEL);
        if($res){
            return true ;
        }else{
            return false;
        }
    }
	
	
	    function get_panel_list( $adv_id = null){
        $tab1 = ADVOCATE_PANEL ;
        $tab2 = ADVOCATE_MASTER ;
        $this->db->select('panel_id,panel_advocate_id,panel_post_id,panel_district_id,panel_tehsil_id,panel_taluka_id,panel_status,panel_discription,panel_create_date,panel_close_date , scm_name_hi , scm_post_hi');
        $this->db->where('panel_advocate_id',$adv_id);
        $this->db->join($tab2, "$tab2.scm_id = $tab1.panel_advocate_id", 'left');
        $query = $this->db->get(ADVOCATE_PANEL);
        $result = $query->result_array();
        return $result;
    }
	function getadvocate_details_adv($id ){
		$tbl_advocate = ADVOCATE_MASTER;
        $tbl4 = ADVOCATE_SERVICE_RECORD;
      
        //$this->db->select('.*,dept_name_hi,district_name_hi');
        $this->db->join($tbl4, "$tbl4.asr_scm_id = $tbl_advocate.scm_id", 'inner');
        
        
		$this->db->where($tbl_advocate.'.status','1');
		$this->db->where($tbl_advocate.'.scm_id',$id);
        $query = $this->db->get($tbl_advocate);
		//echo $this->db->last_query();
        return $query->result_array();
	}
	public function delete_records_agp_gp($delete_id = null ){		
        $this->db->where('asr_scm_id',$delete_id);
        $this->db->delete(ADVOCATE_SERVICE_RECORD);        
        $this->db->where('scm_id',$delete_id);
        return $this->db->delete(ADVOCATE_MASTER);
	}
}

