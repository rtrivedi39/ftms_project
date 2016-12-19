<?php

class File_search_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    function file_search_sectionno($searchtype = null, $value1 = null , $value2 = null) {
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
          //  $this->db->where("$tbl1.file_mark_section_id",$value1);
            $this->db->where("$tbl6.section_id", $value1);
            $this->db->where("$tbl6.section_number", $value2);
        }
        $this->db->order_by("$tbl1.file_id", 'desc');
        $query = $this->db->get();
     //  echo $this->db->last_query();
        return $query->result();
    }
	
	function file_search_lists($searchtype = null, $value1 = null , $value2 = null, $bul = '', $floor = '') {
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
        $this->db->order_by("$tbl1.file_department_id", 'ASC');
        // $this->db->order_by("$tbl4.dept_name_hi", 'ASC');
        $query = $this->db->get();
        // echo $this->db->last_query().br();
		if($query->num_rows() > 0){
			return $query->result();
		} else {
			return false;
		}
        
    }

    function file_search($searchtype = null, $value1 = null , $value2 = null) {
        $value123 = explode(',',$value1);
		
		$tbl1 = FILES;
        $tbl3 = EMPLOYEES;
		$tbl4 = DEPARTMENTS;
        $tbl5 = DISTRICT;
        $this->db->select(FILES . '.*,emp_full_name,dept_name_hi,district_name_hi');
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
            $this->db->where("$tbl1.file_uo_or_letter_date", $value1);
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
        $this->db->order_by("$tbl1.file_id", 'desc');
        $query = $this->db->get();
    //  echo  $this->db->last_query();
        return $query->result();
    }
//search foe case no
    function file_search_caseno($searchtype = null, $value1 = null , $value2 = null) {
        $tbl1 = FILES;
        $tbl3 = EMPLOYEES;
        $tbl6 = FILES_OTHER_FEILDS;
        $this->db->select(FILES . '.*,'.EMPLOYEES.'.emp_full_name,'.FILES_OTHER_FEILDS.'.case_no');
        $this->db->from($tbl1);
        $this->db->join($tbl3, "$tbl3.emp_id = $tbl1.file_received_emp_id", 'left');
        $this->db->join($tbl6, "$tbl6.f_file_id = $tbl1.file_id");
        if($searchtype != null && isset($searchtype) && $searchtype == 7){
            $where = "FIND_IN_SET('" . $value1 . "', case_no)";
            $this->db->where($where);
        }
        $this->db->order_by("$tbl1.file_id", 'desc');
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

}

