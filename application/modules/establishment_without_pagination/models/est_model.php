<?php

class Est_model extends CI_Model {

 	function __construct() {
        parent::__construct();
    }

    function get_file_last_number(){
    	$this->db->select_max('file_number');
		$query = $this->db->get(FILES, 1);    	
    	$result = $query->row_array();
    	return $result['file_number'] + 1;
    }
	
	function get_file_last_number_sectionwise($section){
    	$this->db->select_max('file_section_serial_no');
		$this->db->where(array('file_mark_section_id'=>$section));
		$query = $this->db->get(FILES);    	
    	$result = $query->row_array();
    	return $result['file_section_serial_no'] + 1;
    }
	
	public function get_marked_da_file($type = '', $emp_id = '') {

        //	$ctype = complaint_type('', 1);
        //	$com_type = array();
        //	foreach($ctype as $key => $types){
        //		$com_type[] = $types['master_category_id'];
        //	}
        //	$all_com_type = implode(',', $com_type);

        $check_est_so = check_est_so();
		$empids = $this->get_establishment_empids();
        $impolde_empids = implode(',',$empids);
		if($emp_id == ''){
			$emp_id = $this->session->userdata('emp_id');
		}
		$tbl1 = FILES;
		$tbl2 = SECTIONS;
		$tbl3 = EMPLOYEES;
		$this->db->select(FILES . '.*,section_name_hi,section_name_en,emp_full_name,emp_full_name_hi');
		$this->db->from($tbl1);
		$this->db->join($tbl2, "$tbl2.section_id = $tbl1.file_mark_section_id", 'left');
		$this->db->join($tbl3, "$tbl3.emp_id = $tbl1.file_received_emp_id", 'left');
		if($check_est_so) {
			if($type == 'p'){
				$this->db->where("(file_hardcopy_status = 'not' OR file_hardcopy_status = 'received')");	
				$this->db->where("file_received_emp_id",$emp_id);	
			}		
			if($type == 'f'){			
				$this->db->where("$tbl1.file_hardcopy_status", 'close');
			}
		} else{
			$this->db->where("$tbl1.file_received_emp_id", "$emp_id");
		}

        $where = '(createfile_empid  in ('.$impolde_empids.') or file_sender_emp_id in ('.$impolde_empids.'))';
        $this->db->where($where);

		//$this->db->where_in('createfile_empid', $empids);

		$section_ids = array(7,25);
		$this->db->where_in("$tbl1.file_mark_section_id",$section_ids);
		//$this->db->where("$tbl1.section_file_type NOT IN($all_com_type) ");
		//comment the following line because section this file show only DA file list and this condition not show section file
		//$this->db->where('section_file_type !=',0);
		$this->db->order_by("file_update_date", 'ASC');
		$query = $this->db->get();
	    //echo $this->db->last_query();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return FALSE;
		}
		}

	public function get_establishment_empids()
	{
		$employees_es = get_establishment_employees_with_des();
		$empids = array();
		foreach( $employees_es as $emp_ids){ $empids[] = $emp_ids->emp_id ; }
		return $empids;
	}

}

