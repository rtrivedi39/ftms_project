<?php

class Ps_file_monitor_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    // file lastid section no
    function ps_monitor_files($task = null, $param1 = null , $param2 = null) {
        if(isset($_GET['empid']) && $_GET['empid']!=''){
            $is_file_alloted= check_ps_monitor_file_is_alloted(null,$this->session->userdata("emp_id"));
            $file_array_ids= implode(',',$is_file_alloted);
        }
        $tbl1 = FILES;
        $tbl3 = EMPLOYEES;
        $tbl6 = FILES_SECTION;
        $tbl4 = DEPARTMENTS;
        $tbl5 = DISTRICT;
        $this->db->select(FILES . '.*,'.EMPLOYEES.'.emp_full_name,'.FILES_SECTION.'.section_number,dept_name_hi,district_name_hi');
        $this->db->from($tbl6);
        $this->db->join($tbl1, "$tbl6.file_id = $tbl1.file_id",'INNER JOIN');
        $this->db->join($tbl3, "$tbl3.emp_id = $tbl1.file_received_emp_id", 'INNER JOIN');
        $this->db->join($tbl4, "$tbl4.dept_id = $tbl1.file_department_id", 'left');
        $this->db->join($tbl5, "$tbl5.district_id = $tbl1.file_district_id",'left');
        if(isset($task) && $task == 'close'){
            $this->db->where(array($tbl1.'.file_hardcopy_status'=>'close'));
        }else if(isset($task) && $task =='all'){

        }else{
            $this->db->where(array($tbl1.'.file_hardcopy_status !='=>'close'));
        }
        $this->db->where(array($tbl1.'.ps_moniter_date !='=>null,$tbl1.'.ps_moniter_date !='=>'0000-00-00'));
       
        if(isset($_GET['empid']) && $_GET['empid']!=''){
            $is_file_alloted= check_ps_monitor_file_is_alloted(null,$this->session->userdata("emp_id"));
            $file_array_ids= implode(',',$is_file_alloted);
           // pre($is_file_alloted);
            if(!empty($is_file_alloted) && $is_file_alloted!=''){
                $this->db->where_in($tbl1.'.file_id',$is_file_alloted);
            }
        }
		$this->db->group_by("$tbl1.file_id");
        $this->db->order_by("$tbl1.ps_moniter_date", 'desc');
        $query = $this->db->get();
        //pre($query->result());
        return $query->result(); 
    }

}

