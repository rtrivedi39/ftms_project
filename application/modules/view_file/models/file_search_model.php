<?php

class File_search_model extends CI_Model {

    function __construct() {
        parent::__construct();
		
    }
    function file_search_sectionno($searchtype = null, $value1 = null , $value2 = null , $year_wise = null,$date_from = null , $to_date = null) {
		
		$sub_type = '';
		if($this->input->get('sstype') != '') {
			$sub_type = $this->input->get('sstype');
        }
        $tbl1 = FILES;
        $tbl3 = EMPLOYEES;
        $tbl6 = FILES_SECTION;
		$tbl4 = DEPARTMENTS;
        $tbl5 = DISTRICT;
		$tabl7 = FILES_MOVEMENT;
        $this->db->select(FILES . '.*,'.EMPLOYEES.'.emp_full_name,'.FILES_SECTION.'.section_number,dept_name_hi,district_name_hi,'.$tabl7.'.fmove_created_datetime,'.$tbl6.'.section_number');
        $this->db->from($tbl6);
		$this->db->join($tbl1, "$tbl6.file_id = $tbl1.file_id",'INNER JOIN');
		 $this->db->join($tabl7, "$tabl7.fmove_file_id = $tbl1.file_id",'left');
        $this->db->join($tbl3, "$tbl3.emp_id = $tbl1.file_received_emp_id", 'INNER JOIN');
        $this->db->join($tbl4, "$tbl4.dept_id = $tbl1.file_department_id", 'left');
        $this->db->join($tbl5, "$tbl5.district_id = $tbl1.file_district_id",'left');
        if($searchtype != null && isset($searchtype) && $searchtype == 1){
          //  $this->db->where("$tbl1.file_mark_section_id",$value1);
			$mark_section_id = $this->input->post('mark_sections');
            $this->db->where("$tbl6.section_id", $value1);
            $this->db->where("$tbl6.section_number", $value2);
			
			if($year_wise != null){
			$where = "YEAR(ft_files_section.file_created_date) = '".$year_wise."'";
			$this->db->where($where);
			}

        }
		if(!empty($from_date) && !empty($to_date) ){
		  /* $where = array(
                'date('.$tabl7.'.fmove_created_datetime) >= ' => date('Y-m-d', strtotime($from_date)),
                'date('.$tabl7.'.fmove_created_datetime) <= ' => date('Y-m-d', strtotime($to_date))
            );
			*/
			$move_from_date = date('Y-m-d', strtotime($from_date));
			$move_to_date = date('Y-m-d', strtotime($to_date));
			$weredt = $tabl7.".fmove_created_datetime  BETWEEN '$move_from_date' and '$move_to_date' ";
			$this->db->where($weredt );
		}
		if($sub_type != ''){
			$this->db->where('section_file_type',$sub_type);
		}
		$this->db->group_by("$tbl1.file_id");
		$this->db->distinct("$tbl1.file_id");
        $this->db->order_by("$tbl1.file_id", 'desc');
        $query = $this->db->get();
     // echo $this->db->last_query().br();
        return $query->result(); 
    }
	
	function file_search_sectionno_cr($searchtype = null, $value1 = null , $value2 = null , $year_wise = null,$from_date=null,$to_date=null) {
		$cr_section_ids= get_cr_emp_id(1);
        $tbl1 = FILES;
        $tbl3 = EMPLOYEES;
        $tbl6 = FILES_SECTION;
		
		$tbl4 = DEPARTMENTS;
        $tbl5 = DISTRICT;
		$tabl7 = FILES_MOVEMENT;
			
        $this->db->select(FILES . '.*,'.EMPLOYEES.'.emp_full_name,'.FILES_SECTION.'.section_number,dept_name_hi,district_name_hi,'.$tabl7.'.fmove_created_datetime,'.$tbl6.'.section_number');
        $this->db->from($tbl6);
		$this->db->join($tbl1, "$tbl6.file_id = $tbl1.file_id",'INNER JOIN');
		//$this->db->join($tabl7, "$tbl1.file_id = $tabl7.fmove_file_id",'left');
      	$this->db->join($tbl3, "$tbl3.emp_id = $tbl1.file_received_emp_id", 'INNER JOIN');
        $this->db->join($tbl4, "$tbl4.dept_id = $tbl1.file_department_id", 'left');
        $this->db->join($tbl5, "$tbl5.district_id = $tbl1.file_district_id",'left');
		 $this->db->join($tabl7, "$tabl7.fmove_file_id = $tbl1.file_id",'left');
		
        if($searchtype != null && isset($searchtype) && $searchtype == 1){
           $this->db->where("$tbl1.file_mark_section_id",$value1);
			$mark_section_id = $this->input->post('mark_sections');
           $this->db->where("$tbl6.section_id", $value1);
           $this->db->where("$tbl6.section_number", $value2);
			
			if($year_wise != null){
			$where = "YEAR(ft_files_section.file_created_date) = '".$year_wise."'";
			$this->db->where($where);
			}		
			
			if(!empty($from_date) && !empty($to_date)){
           	$move_from_date = date('Y-m-d', strtotime($from_date));
			$move_to_date = date('Y-m-d', strtotime($to_date));
			$weredt = $tabl7.".fmove_created_datetime  BETWEEN '$move_from_date' and '$move_to_date' ";
			$this->db->where($weredt );
			
			}
       
            $this-> db->where($where);
			if(checkUserrole()!=25 && checkUserrole()!=12 && in_array(emp_session_id(),$cr_section_ids['id_array'])){
				//$this->db->where("$tbl6.filemarked_section_id", $mark_section_id);
                $this->db->where("$tbl1.file_mark_section_id", $mark_section_id);
			}
         
        }
		$this->db->group_by("$tbl1.file_id");
        $this->db->order_by("$tbl1.file_id", 'desc');
        $query = $this->db->get();
        //echo $this->db->last_query().br();
		//print_r($query->result()); die;
        return $query->result(); 
    }
	
	function file_search_lists($searchtype = null, $value1 = null , $value2 = null, $bul = '', $floor = '', $year = null) {
        $tbl1 = FILES;
        $tbl3 = EMPLOYEES;
        $tbl6 = FILES_SECTION;
		$tbl4 = DEPARTMENTS;
        $tbl5 = DISTRICT;
        $this->db->select(FILES . '.*,'.EMPLOYEES.'.emp_full_name,'.FILES_SECTION.'.section_number,dept_name_hi,district_name_hi');
        $this->db->from($tbl1);
        $this->db->join($tbl3, "$tbl3.emp_id = $tbl1.file_received_emp_id", 'left');
        $this->db->join($tbl6, "$tbl6.file_id = $tbl1.file_id");
		$this->db->join($tbl4, "$tbl4.dept_id = $tbl1.file_department_id", 'left');
        $this->db->join($tbl5, "$tbl5.district_id = $tbl1.file_district_id",'left');
        if($searchtype != null && isset($searchtype) && $searchtype == 1){
           // $this->db->where("$tbl1.file_mark_section_id",$value1);
            $this->db->where("$tbl6.section_id", $value1);
            $this->db->where("$tbl6.section_number", $value2);
        }
		if($bul != ''){
			$this->db->where("$tbl4.building_name", $bul);
		}
		if($floor != ''){
			$this->db->where("$tbl4.building_floor", $floor);
		}
		if($year != ''){
			$this->db->where("YEAR(ft_files.file_created_date)",$year);
		}
        
		$this->db->group_by("$tbl1.file_id");
		$this->db->order_by("$tbl1.file_department_id", 'ASC');
         $this->db->order_by("$tbl4.dept_name_hi", 'ASC');
		//echo "asdasd ".$this->db->last_query();
        $query = $this->db->get();
        
		if($query->num_rows() > 0){
			return $query->result();
		} else {
			return false;
		}
        
    }
	function count_monitor_files($searchtype = null, $value1 = null , $value2 = null) {
        $value123 = explode(',',$value1);		
		$tbl1 = FILES;
        $tbl3 = EMPLOYEES;
		$tbl4 = DEPARTMENTS;
        $tbl5 = DISTRICT;
        $this->db->select('COUNT(DISTINCT(file_id)) as totalfiles');
		$this->db->from($tbl1);
        $this->db->join($tbl3, "$tbl3.emp_id = $tbl1.file_received_emp_id", 'left');
        $this->db->join($tbl4, "$tbl4.dept_id = $tbl1.file_department_id", 'left');
        $this->db->join($tbl5, "$tbl5.district_id = $tbl1.file_district_id",'left');       
		if($searchtype != null && isset($searchtype) && $searchtype == 2){
            $this->db->like("$tbl1.case_parties", $value1);
        }
        if($searchtype != null && isset($searchtype) && $searchtype == 3){
            $this->db->like("$tbl1.file_uo_or_letter_no", $value1);
        }
        if($searchtype != null && isset($searchtype) && $searchtype == 4){
            $this->db->where("$tbl1.file_uo_or_letter_date", get_date_formate($value1,'Y-m-d'));
        }
        if($searchtype != null && isset($searchtype) && $searchtype == 6){
            $this->db->where_in("$tbl1.file_id", $value123);
        }
        if($searchtype != null && isset($searchtype) && $searchtype == 5){
            $this->db->where('MONTH(file_created_date)', $value1);
            $this->db->where('YEAR(file_created_date)', date("Y") );
        }
        if($searchtype != null && isset($searchtype) && $searchtype == 8){
            $this->db->like("$tbl1.file_subject", $value1);
        }
        if($searchtype != null && isset($searchtype) && $searchtype == 9){
            $where = array(
                'date(file_update_date) >= ' => date('Y-m-d', strtotime($value1)),
                'date(file_update_date) <= ' => date('Y-m-d', strtotime($value2))
            );
            $this-> db ->where($where);
        }
        if($searchtype != null && isset($searchtype) && $searchtype == 10){
            $where = array(
                'date(file_update_date) >= ' => date('Y-m-d', strtotime($value1)),
                'date(file_update_date) <= ' => date('Y-m-d', strtotime($value2))
            );
            $this->db->where($where);
        }
		// for searching disptached files
		if($searchtype != null && isset($searchtype) && $searchtype == 11){
            if($value2 == 'close'){
				$final_value  = 'close';
			} else if($value2 == 'not_received'){
				$final_value  = 'not';
			} else if($value2 == 'received'){
				$final_value  = 'received';
			}
			$where = array(
				'date(`file_update_date`)' => date('Y-m-d', strtotime($value1)),
				'file_mark_section_id ' => $this->input->post('sections_all'),
				'file_hardcopy_status ' => $final_value,
				'file_return ' => '2',
            );
            $this->db->where($where);
        }
        if($searchtype != null && isset($searchtype) && $searchtype == 12){
            $this->db->where('MONTH(ps_moniter_date)', $value1);
            $this->db->where('YEAR(ps_moniter_date)', $value2);
        }

        if($searchtype != null && isset($searchtype) && $searchtype == 'psmrk'){
            $this->db->where("$tbl1.ps_mark_file !=", '');
            $this->db->where("$tbl1.ps_mark_file", $value1);
        }
		if(isset($_GET['searchby']) && $_GET['searchby']!=''){
			$searchval=trim($_GET['searchby']);
			$wheres= "(FIND_IN_SET('".$searchval."',ft_files.file_all_section_no) OR ft_files.file_subject like '%".$searchval."%'  OR ft_files.file_uo_or_letter_no like '%".$searchval."%' OR ft_files.file_uo_or_letter_date = DATE_FORMAT('".$searchval."', '%Y-%m-%d'))";
			$this->db->where($wheres);
		}	
        $query = $this->db->get();     
        return $query->row_array();
    }
    
    function count_monitor_files_close($searchtype = null, $value1 = null , $value2 = null) {
        $value123 = explode(',',$value1);		
		$tbl1 = FILES_MASTER;
        $tbl3 = EMPLOYEES;
		$tbl4 = DEPARTMENTS;
        $tbl5 = DISTRICT;
        $this->db->select('COUNT(DISTINCT(file_id)) as totalfiles');
		$this->db->from($tbl1);
        $this->db->join($tbl3, "$tbl3.emp_id = $tbl1.file_received_emp_id", 'left');
        $this->db->join($tbl4, "$tbl4.dept_id = $tbl1.file_department_id", 'left');
        $this->db->join($tbl5, "$tbl5.district_id = $tbl1.file_district_id",'left');       
		if($searchtype != null && isset($searchtype) && $searchtype == 2){
            $this->db->like("$tbl1.case_parties", $value1);
        }
        if($searchtype != null && isset($searchtype) && $searchtype == 3){
            $this->db->like("$tbl1.file_uo_or_letter_no", $value1);
        }
        if($searchtype != null && isset($searchtype) && $searchtype == 4){
            $this->db->where("$tbl1.file_uo_or_letter_date", get_date_formate($value1,'Y-m-d'));
        }
        if($searchtype != null && isset($searchtype) && $searchtype == 6){
            $this->db->where_in("$tbl1.file_id", $value123);
        }
        if($searchtype != null && isset($searchtype) && $searchtype == 5){
            $this->db->where('MONTH(file_created_date)', $value1);
            $this->db->where('YEAR(file_created_date)', date("Y") );
        }
        if($searchtype != null && isset($searchtype) && $searchtype == 8){
            $this->db->like("$tbl1.file_subject", $value1);
        }
        if($searchtype != null && isset($searchtype) && $searchtype == 9){
            $where = array(
                'date(file_update_date) >= ' => date('Y-m-d', strtotime($value1)),
                'date(file_update_date) <= ' => date('Y-m-d', strtotime($value2))
            );
            $this-> db ->where($where);
        }
        if($searchtype != null && isset($searchtype) && $searchtype == 10){
            $where = array(
                'date(file_update_date) >= ' => date('Y-m-d', strtotime($value1)),
                'date(file_update_date) <= ' => date('Y-m-d', strtotime($value2))
            );
            $this->db->where($where);
        }
		// for searching disptached files
		if($searchtype != null && isset($searchtype) && $searchtype == 11){
            if($value2 == 'close'){
				$final_value  = 'close';
			} else if($value2 == 'not_received'){
				$final_value  = 'not';
			} else if($value2 == 'received'){
				$final_value  = 'received';
			}
			$where = array(
				'date(`file_update_date`)' => date('Y-m-d', strtotime($value1)),
				'file_mark_section_id ' => $this->input->post('sections_all'),
				'file_hardcopy_status ' => $final_value,
				'file_return ' => '2',
            );
            $this->db->where($where);
        }
        if($searchtype != null && isset($searchtype) && $searchtype == 12){
            $this->db->where('MONTH(ps_moniter_date)', $value1);
            $this->db->where('YEAR(ps_moniter_date)', $value2);
        }

        if($searchtype != null && isset($searchtype) && $searchtype == 'psmrk'){
            $this->db->where("$tbl1.ps_mark_file !=", '');
            $this->db->where("$tbl1.ps_mark_file", $value1);
        }
		if(isset($_GET['searchby']) && $_GET['searchby']!=''){
			$searchval=trim($_GET['searchby']);
			$wheres= "(FIND_IN_SET('".$searchval."',ft_files.file_all_section_no) OR ft_files.file_subject like '%".$searchval."%'  OR ft_files.file_uo_or_letter_no like '%".$searchval."%' OR ft_files.file_uo_or_letter_date = DATE_FORMAT('".$searchval."', '%Y-%m-%d'))";
			$this->db->where($wheres);
		}	
        $query = $this->db->get();     
        return $query->row_array();
    }
    function file_search($searchtype = null, $value1 = null , $value2 = null,$limit=null,$page=null,$mark_sections=null ,$year_wise=null,$movement_from_date = null , $movement_to_date = null ) {
		//echo "year ".$year_wise;
		
        $value123 = explode(',',$value1);
		$emp_section = getEmployeeSection();
		$tbl1 = FILES;
        $tbl3 = EMPLOYEES;
		$tbl4 = DEPARTMENTS;
        $tbl5 = DISTRICT;
		 $tabl7 = FILES_MOVEMENT;
		$tbl6 = FILES_SECTION;
        $this->db->select(FILES . '.*,emp_full_name,dept_name_hi,'.$tbl5.'.district_name_hi,'.$tabl7.'.fmove_created_datetime,'.$tbl6.'.section_number');
		$this->db->from($tbl1);
		//$this->db->join($tbl1, "$tbl6.file_id = $tbl1.file_id",'left');
        $this->db->join($tbl3, "$tbl3.emp_id = $tbl1.file_received_emp_id", 'left');
        $this->db->join($tbl4, "$tbl4.dept_id = $tbl1.file_department_id", 'left');
        $this->db->join($tbl5, "$tbl5.district_id = $tbl1.file_district_id",'left');
	    $this->db->join($tabl7, "$tabl7.fmove_file_id = $tbl1.file_id",'left');
	    $this->db->join($tbl6, "$tbl6.file_id = $tbl1.file_id",'left');
		
		if($searchtype != null && isset($searchtype) && $searchtype == 2){
            $this->db->like("$tbl1.case_parties", $value1);
        }
        if($searchtype != null && isset($searchtype) && $searchtype == 3 ){
            $this->db->like("$tbl1.file_uo_or_letter_no", $value1);
        }
        if($searchtype != null && isset($searchtype) && !empty($value1) && $searchtype == 4){
			
            $this->db->where("$tbl1.file_uo_or_letter_date", get_date_formate($value1,'Y-m-d'));
        }
		if($searchtype != null && isset($searchtype) && $searchtype == 13){
			
				 $this->db->where("$tbl1.file_Offer_by", $this->input->post('file_offer_by'));
			
			if( $this->input->post('file_offer_by') == 'v') {
				 $this->db->like("$tbl1.file_department_id", $this->input->post('file_department_id'));
				
				if($this->input->post('district_id')){
				$this->db->where("$tbl1.file_district_id", $this->input->post('district_id'));
				}
				if($this->input->post('file_department_name')){
				$this->db->like("$tbl1.file_department_name", $this->input->post('file_department_name'));
				}
			}
			if( $this->input->post('file_offer_by') == 'c' ){
				 
				if($this->input->post('district_id')){
				$this->db->where("$tbl1.file_district_id", $this->input->post('district_id'));
				}
				if($this->input->post('file_department_name')){
				$this->db->like("$tbl1.file_department_name", $this->input->post('file_department_name'));
				}
			}
			
			if( $this->input->post('file_offer_by') == 'm' ){
				
				
				if($this->input->post('court_bench')){
				$this->db->where("$tbl1.court_bench_id", $this->input->post('court_bench'));
				}
				if($this->input->post('district_id')){
				$this->db->where("$tbl1.file_district_id", $this->input->post('district_id'));
				}
				if($this->input->post('file_department_name')){
				$this->db->like("$tbl1.file_department_name", $this->input->post('file_department_name'));
				}
			}
			if( $this->input->post('file_offer_by') == 'jvn' ){
				 if($this->input->post('district_id')){
				$this->db->where("$tbl1.file_district_id", $this->input->post('district_id'));
				}
				if($this->input->post('file_department_name')){
				$this->db->like("$tbl1.file_department_name", $this->input->post('file_department_name'));
				}
			}
			if( $this->input->post('file_offer_by') == 'u' ){
				
				
				if($this->input->post('court_bench')){
				$this->db->where("$tbl1.court_bench_id", $this->input->post('court_bench'));
				}
				if($this->input->post('district_id')){
				$this->db->where("$tbl1.file_district_id", $this->input->post('district_id'));
				}
				if($this->input->post('file_department_name')){
				$this->db->like("$tbl1.file_department_name", $this->input->post('file_department_name'));
				}
			}
			
			if( $this->input->post('file_offer_by') == 'au' ){
				 
				if($this->input->post('state_id')){
				$this->db->where("$tbl1.file_state_id", $this->input->post('state_id'));
				}
				if($this->input->post('file_department_name')){
				$this->db->like("$tbl1.file_department_name", $this->input->post('file_department_name'));
				}
			}
			
			if( $this->input->post('file_offer_by') == 'sc'){
				
				
				if($this->input->post('file_department_name')){
				$this->db->like("$tbl1.file_department_name", $this->input->post('file_department_name'));
				}
				if($this->input->post('state_id')){
				$this->db->where("$tbl1.file_state_id", $this->input->post('state_id'));
				}
			}
			if( $this->input->post('file_offer_by') == 'o' ){
				 
				if($this->input->post('file_department_name')){
				$this->db->like("$tbl1.file_department_name", $this->input->post('file_department_name'));
				}
			}
			if( $this->input->post('file_offer_by') == ''  || $this->input->post('file_offer_by') == null ){
				 
				if($this->input->post('file_department_name')){
				$this->db->like("$tbl1.file_department_name", $this->input->post('file_department_name'));
				}
			}
            //$this->db->where("$tbl1.file_uo_or_letter_date", get_date_formate($value1,'Y-m-d'));
        }
        if($searchtype != null && isset($searchtype) && $searchtype == 6){
            $this->db->where_in("$tbl1.file_id", $value123);
        }
        if($searchtype != null && isset($searchtype) && $searchtype == 5){
            $this->db->where('MONTH(ft_'.$tbl1.'.file_created_date)', $value1);
            $this->db->where('YEAR(ft_'.$tbl1.'.file_created_date)', date("Y") );
			$this->db->where('ft_'.$tabl7.'.fmove_current_user_id', $this->session->userdata('emp_id'));
			
			
        }
        if($searchtype != null && isset($searchtype) && $searchtype == 8){
            $this->db->like("$tbl1.file_subject", $value1);
        }
		if($year_wise != null){
			$where = "YEAR(ft_files_section.file_created_date) = '".$year_wise."'";
			$this->db->where($where);
			}
        if( (  $searchtype != null && isset($searchtype) &&  $searchtype == 10 ) ){
			
            $where = array(
                'date(ft_'.$tbl1.'.file_update_date) >= ' => date('Y-m-d', strtotime($value1)),
                'date(ft_'.$tbl1.'.file_update_date) <= ' => date('Y-m-d', strtotime($value2))
            );
            $this->db->where($where);
        }
		
      /*  if($searchtype != null && isset($searchtype) && $searchtype == 10 ){
            $where = array(
                'date('.$tbl1.'.file_update_date) >= ' => date('Y-m-d', strtotime($value1)),
                'date('.$tbl1.'.file_update_date) <= ' => date('Y-m-d', strtotime($value2))
            );
            $this->db->where($where);
        }*/
		// for searching disptached files
		if($searchtype != null && isset($searchtype) && $searchtype == 11){
			//die("abc");
            if($value2 == 'close'){
				$final_value  = 'close';
			} else if($value2 == 'not_received'){
				$final_value  = 'not';
			} else if($value2 == 'received'){
				$final_value  = 'received';
			}
			$where = array(
				'date(ft_'.$tbl1.'.`file_update_date`)' => date('Y-m-d', strtotime($value1)),
				'file_mark_section_id ' => $this->input->post('sections_all'),
				'file_hardcopy_status ' => $final_value,
				'ft_'.$tbl1.'.file_return ' => '2',
            );
            $this->db->where($where);
        }
        if($searchtype != null && isset($searchtype) && $searchtype == 12){
            $this->db->where('MONTH(ps_moniter_date)', $value1);
            $this->db->where('YEAR(ps_moniter_date)', $value2);
        }

        if($searchtype != null && isset($searchtype) && $searchtype == 'psmrk'){
            $this->db->where("$tbl1.ps_mark_file !=", '');
            $this->db->where("$tbl1.ps_mark_file", $value1);
        }
		if($this->input->post('sections')){
				$mark_section_id = $this->input->post('sections');
			//echo "sdfds ".$mark_section_id;
        
           // $this->db->where("$tbl6.section_id", $value1);
            //$this->db->where("$tbl6.section_number", $value2);
			 $this->db->where("$tbl6.section_id", $mark_section_id);
              // $this->db->where("$tbl6.section_number", $mark_section_id);
		}
		if(!empty($movement_from_date) || !empty($movement_to_date)  ){
			$move_from_date = date('Y-m-d', strtotime($movement_from_date));
			$move_to_date = date('Y-m-d', strtotime($movement_to_date));
			$weredt = $tabl7.".fmove_created_datetime  BETWEEN '$move_from_date' and '$move_to_date' ";
			$this->db->where($weredt );
		}
		
		if(isset($_GET['searchby']) && $_GET['searchby']!=''){
			$_GET['searchby'];
			$wheres= "(FIND_IN_SET('".$searchval."',ft_files.file_all_section_no) OR ft_files.file_subject like '%".$searchval."%'  OR ft_files.file_uo_or_letter_no like '%".$searchval."%' OR ft_files.file_uo_or_letter_date = DATE_FORMAT('".$searchval."', '%Y-%m-%d'))";
			$this->db->where($wheres);
		}		
		//$this->db->distinct("$tbl1.file_id");
		$this->db->group_by("$tbl1.file_id");
		$this->db->order_by("$tbl1.file_update_date", 'asc');		
		if(isset($page) && $page!='' && isset($limit) && $limit!='' && $this->uri->segment(2)!='file_search'){
			$this->db->limit($limit,$page);	
		}
		
		
		
        $query = $this->db->get(); 
		//echo $this->db->last_query();
        return $query->result();
    }
//search foe case no
    function file_search_caseno($searchtype = null, $value1 = null , $value2 = null , $mark_section = null ,$s_files_year= null,$movement_from_date =null, $movement_to_date =null ) {
        $tbl1 = FILES;
        $tbl3 = EMPLOYEES;
        $tbl6 = FILES_OTHER_FEILDS;
		$tabl7 = FILES_MOVEMENT;
		$tbl8 = FILES_SECTION;
        $this->db->select(FILES . '.*,'.EMPLOYEES.'.emp_full_name,'.FILES_OTHER_FEILDS.'.case_no,'.$tabl7.'.fmove_created_datetime,'.$tbl8.'.section_number');
        $this->db->from($tbl1);
        $this->db->join($tbl3, "$tbl3.emp_id = $tbl1.file_received_emp_id", 'left');
        $this->db->join($tbl6, "$tbl6.f_file_id = $tbl1.file_id");
	  	$this->db->join($tabl7, "$tabl7.fmove_file_id = $tbl1.file_id",'left');
	    $this->db->join($tbl8, "$tbl8.file_id = $tbl1.file_id",'left');
		
        if($searchtype != null && isset($searchtype) && $searchtype == 7){
            $where = "FIND_IN_SET('" . $value1 . "', case_no)";
            $this->db->where($where);
        }
		
		if(!empty($mark_section)){
			$mark_section_id = $this->input->post('sections');
			$this->db->where("$tbl8.section_id", $mark_section_id);
            
		}
		if(!empty($s_files_year)){
			$where = "YEAR(ft_files_section.file_created_date) = '".$s_files_year."'";
			$this->db->where($where);
		}
		
		if(!empty($movement_from_date) && !empty($movement_to_date)){
			
			$move_from_date = date('Y-m-d', strtotime($movement_from_date));
			$move_to_date = date('Y-m-d', strtotime($movement_to_date));
			$weredt = $tabl7.".fmove_created_datetime  BETWEEN '$move_from_date' and '$move_to_date' ";
			$this->db->where($weredt );
		}
		
        $this->db->order_by("$tbl1.file_id", 'desc');
		$this->db->group_by("$tbl1.file_id");
        $query = $this->db->get();
       // echo $this->db->last_query();
        return $query->result();
    }
    function file_search_emp_section_wise($searchtype = null, $filter_section_emp_wise = null,$empid_secid = null, $srch_frm_dt = null, $srch_to_dt = null) {
        $tbl1 = FILES;
        $tbl3 = EMPLOYEES;
        $tbl6 = FILES_OTHER_FEILDS;
        $tbl4 = DEPARTMENTS;
        $tbl5 = DISTRICT;
        $tbl7 = SECTIONS;
        $this->db->select(FILES . '.*,'.EMPLOYEES.'.emp_full_name,'.FILES_OTHER_FEILDS.'.case_no,dept_name_hi,district_name_hi');
        $this->db->from($tbl1);
        $this->db->join($tbl3, "$tbl3.emp_id = $tbl1.file_received_emp_id", 'left');
        $this->db->join($tbl6, "$tbl6.f_file_id = $tbl1.file_id");
        $this->db->join($tbl4, "$tbl4.dept_id = $tbl1.file_department_id", 'left');
        $this->db->join($tbl5, "$tbl5.district_id = $tbl1.file_district_id",'left');
        $this->db->join($tbl7, "$tbl7.section_id = $tbl1.file_mark_section_id");
        if($filter_section_emp_wise=='emp'){
            $where = "(file_received_emp_id=$empid_secid || file_sender_emp_id=$empid_secid) && date(file_update_date)>='".date('Y-m-d',strtotime($srch_frm_dt))."' and date(file_update_date) <='".date('Y-m-d', strtotime($srch_to_dt))."'";
        }else{
            $where = "(file_mark_section_id=$empid_secid) && date(file_update_date)>='".date('Y-m-d',strtotime($srch_frm_dt))."' and date(file_update_date) <='".date('Y-m-d', strtotime($srch_to_dt))."'";
        }
        $this->db->where($where);
        $this->db->order_by("$tbl1.file_id", 'desc');
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result();
    }

	 function auto_search_file($searchtype = null, $value1 = null , $value2 = null) {
		 
        $query2 = $this->db->query("SELECT file_subject,case_parties,case_no,file_id from ft_files left join ft_files_other_feilds on ft_files.file_id = ft_files_other_feilds.f_file_id where ft_files.file_id =".$value1);
        $res_array1 =  $query2->result_array();

        // $case_parties_array =   explode('-',$res_array1[0]['case_parties']);
        $case_no_array =   explode('/',$res_array1[0]['case_no']);

        $tbl1 = FILES;
        $tbl3 = EMPLOYEES;
        $tbl6 = FILES_OTHER_FEILDS;
        $this->db->select(FILES . '.*,'.EMPLOYEES.'.emp_full_name,'.FILES_OTHER_FEILDS.'.case_no');
        $this->db->from($tbl1);
        $this->db->join($tbl3, "$tbl3.emp_id = $tbl1.file_received_emp_id", 'left');
        $this->db->join($tbl6, "$tbl6.f_file_id = $tbl1.file_id");
        $this->db->where("$tbl1.file_subject", $res_array1[0]['file_subject']);
     //   if($case_parties_array[0] != null || $case_parties_array[0] != ''){
     //       $this->db->or_where("$tbl1.case_parties", $res_array1[0]['case_parties']);
     //   }
        if($case_no_array[0] != null || $case_no_array[0] != '') {
            $where = "FIND_IN_SET('" . $res_array1[0]['case_no'] . "', $tbl6.case_no)";
            $this->db->or_where($where);
        }
      //  $where = "(file_received_emp_id = ".emp_session_id()." or file_hardcopy_status = 'close')";
       // $this->db->where($where);
        $this->db->order_by("$tbl1.file_id", 'desc');
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result();
    }
     function search_out_of_dept($searchval = null, $other_val = null, $search_section_wise = null){
		$emp_id = $this->session->userdata('emp_id');
		$user_sections = !empty($search_section_wise) ? $search_section_wise : getusersection($this->session->userdata('emp_id'));
		$role = $this->session->userdata('user_role');
		$select = "SELECT file_type , scan_id ,file_status , file_received_emp_id , draft_markto_otherdept , file_update_date, file_id , section_name_hi , file_all_section_no , file_subject , file_hardcopy_status ,
	   (select emp_full_name_hi from ft_employee where emp_id = ft_file_draft.draft_creater_emp_id) as creater
        FROM ft_files left join ft_sections_master on ft_sections_master.section_id = ft_files.file_mark_section_id 
		join ft_draft_log on ft_draft_log.draft_log_file_id = ft_files.file_id
		left join ft_file_draft on  ft_file_draft.draft_id = ft_draft_log.draft_log_draft_id 
		WHERE ";
		if($searchval == 'अन्य'){
			$select .= "`draft_markto_otherdept` like '%$other_val%' ";
		} else {
			$select .= "`draft_markto_otherdept`= '$searchval' ";
		}
		if($role > 9){
			$select .= "and draft_creater_emp_id = '$emp_id' ";
		}
		$select .= " and file_mark_section_id in ($user_sections) and ft_file_draft.draft_type = 'n'";
		//echo $select;
        $query2 = $this->db->query($select);
		/*$searchval = json_encode($searchval);
		$tbl1 = FILES;
        $tbl7 = SECTIONS;
        $this->db->select('*');
        $this->db->from($tbl1);       
        $this->db->join($tbl7, "$tbl7.section_id = $tbl1.file_mark_section_id");
        $this->db->like('dispatch_lists',$searchval);
        $this->db->where_in('file_mark_section_id',array(11,12));
        $this->db->order_by("$tbl1.file_id", 'desc');
        $query = $this->db->get();
		 echo $this->db->last_query();*/
		 
        return $query2->result_array();
    }
	
}

