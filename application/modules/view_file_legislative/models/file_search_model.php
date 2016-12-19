<?php

class File_search_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    function file_search_sectionno($searchtype = null, $value1 = null , $value2 = null) {
        $tbl1 = FILES;
        $tbl3 = EMPLOYEES;
        $tbl6 = FILES_SECTION;
        $this->db->select(FILES . '.*,'.EMPLOYEES.'.emp_full_name,'.FILES_SECTION.'.section_number');
        $this->db->from($tbl1);
        $this->db->join($tbl3, "$tbl3.emp_id = $tbl1.file_received_emp_id", 'left');
        $this->db->join($tbl6, "$tbl6.file_id = $tbl1.file_id");
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

    function file_search($searchtype = null, $value1 = null , $value2 = null) {
        $tbl1 = FILES;
        $tbl3 = EMPLOYEES;
        $this->db->select(FILES . '.*,emp_full_name');
        $this->db->from($tbl1);
        $this->db->join($tbl3, "$tbl3.emp_id = $tbl1.file_received_emp_id", 'left');
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
            $this->db->where("$tbl1.file_id", $value1);
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

}

