<?php

class Advocates_report_model extends CI_Model {

 	function __construct() {
        parent::__construct();
    }
	
	function get_advocate_list($adv_post_type=null,$distid=null,$tehsil_id=null,$taluka_id=nulls){
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
		$this->db->join($attchament,  $attchament.'.sci_id = '.$tbl_advocate.'.scm_id' , 'left');
		$this->db->where($tbl_advocate.'.status','1');
		$this->db->where($tbl_advocate.'.advocate_post_type',$adv_post_type);
		$this->db->order_by($tbl_district.'.district_name_en','ASC');
		$this->db->order_by($tbl_tehsil.'.tahsil_name_en','ASC');
        $query = $this->db->get($tbl_advocate);
        //echo $this->db->last_query();
        return $query->result_array();
	}
	
	
	public function get_advocate_list_dst_tah_tal($adv_type)
	{
		//$tbl_advocate = "ft_advocate_master_original";
		$tbl_advocate = 'ft_advocate_master';
        $tbl4 = ADVOCATE_SERVICE_RECORD;
	    $attchament = ADVOCATE_ATTACHMENT;
		$tbl_district = DISTICT_MASTER;
		$tbl_tehsil = TAHSIL_MASTER;
		$district_id = $this->input->post('district_id');
		$tahsil_id = $this->input->post('tahsil_id');
		$taluka_id = $this->input->post('taluka_id');
		
        //$this->db->select('.*,dept_name_hi,district_name_hi');
        $this->db->join($tbl4, "$tbl4.asr_scm_id = $tbl_advocate.scm_id", 'left');
		$this->db->join($attchament,  $attchament.'.sci_id = '.$tbl_advocate.'.scm_id' , 'left');
		$this->db->join($tbl_district, "$tbl_advocate.scm_district_id = $tbl_district.district_id", 'left');
        $this->db->join($tbl_tehsil, "$tbl_advocate.scm_tahsil_id = $tbl_tehsil.tahsil_id", 'left');
		
		$this->db->where($tbl_advocate.'.status','1');
		$this->db->where($tbl_advocate.'.advocate_post_type',$adv_type);
		if(!empty($district_id)){
			$this->db->where($tbl_advocate.'.scm_district_id',$district_id );
		}
		if(!empty($tahsil_id)){
			$this->db->where($tbl_advocate.'.scm_tahsil_id',$tahsil_id );
		}
		if(!empty($taluka_id)){
			$this->db->where($tbl_advocate.'.scm_taluka_id',$taluka_id);
		}
		$this->db->order_by($tbl_district.'.district_name_en','ASC');
		$this->db->order_by($tbl_tehsil.'.tahsil_name_en','ASC');
        $query = $this->db->get($tbl_advocate);
      	//echo "sulbha ".$this->db->last_query();
       return $query->result_array();
	}
	public function get_advocate_list_dst_tah($adv_type)
	{
		
		//$tbl_advocate = "ft_advocate_master_original";
		$tbl_advocate = 'ft_advocate_master';
        $tbl4 = ADVOCATE_SERVICE_RECORD;
		$tbl_district = DISTICT_MASTER;
		$tbl_tehsil = TAHSIL_MASTER;
		$district_id = $this->input->post('district_id');
		echo "tahsil ".$tahsil_id = $this->input->post('tahsil_id');
		$taluka_id = $this->input->post('taluka_id');
		
        //$this->db->select('.*,dept_name_hi,district_name_hi');
        $this->db->join($tbl4, "$tbl4.asr_scm_id = $tbl_advocate.scm_id", 'left');
		$this->db->join($tbl_district, "$tbl_advocate.scm_district_id = $tbl_district.district_id", 'left');
        $this->db->join($tbl_tehsil, "$tbl_advocate.scm_tahsil_id = $tbl_tehsil.tahsil_id", 'left');
		$this->db->where($tbl_advocate.'.status','1');
		$this->db->where($tbl_advocate.'.advocate_post_type',1);
		if(!empty($district_id)){
			$this->db->where($tbl_advocate.'.scm_district_id',$district_id );
		}
		if(!empty($tahsil_id)){
			$this->db->where($tbl_advocate.'.scm_tahsil_id',$tahsil_id );
		}
		if(!empty($taluka_id)){
			$this->db->where($tbl_advocate.'.scm_taluka_id',$taluka_id);
		}
		$this->db->order_by($tbl_district.'.district_name_en','ASC');
		$this->db->order_by($tbl_tehsil.'.tahsil_name_en','ASC');
        $query = $this->db->get($tbl_advocate);
        //echo "sulbha ".$this->db->last_query();
        return $query->result_array();
	}
	 
}

