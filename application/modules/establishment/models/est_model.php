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
	public function count_get_marked_da_file($type = '', $emp_id = '') {
		$check_est_so = check_est_so();
		$empids = $this->get_establishment_empids();
        $impolde_empids = implode(',',$empids);
		if($emp_id == ''){
			$emp_id = $this->session->userdata('emp_id');
		}
		$tbl1 = FILES;
		$tbl2 = SECTIONS;
		$tbl3 = EMPLOYEES;
		$this->db->select("COUNT(DISTINCT(file_id)) as totalfiles");
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
		if(isset($_GET['searchby']) && $_GET['searchby']!=''){
			$searchval=trim($_GET['searchby']);
			$wheres= "(FIND_IN_SET('".$searchval."',ft_files.file_all_section_no) OR ft_files.file_subject like '%".$searchval."%'  OR ft_files.file_uo_or_letter_no like '%".$searchval."%' OR ft_files.file_uo_or_letter_date = DATE_FORMAT('".$searchval."', '%Y-%m-%d'))";
			$this->db->where($wheres);
		}
		$section_ids = array(7,25);
		$this->db->where_in("$tbl1.file_mark_section_id",$section_ids);		
		$this->db->order_by("file_update_date", 'asc');		
		$query = $this->db->get();
	    //echo $this->db->last_query();
		return $query->row_array();
		
		}
	public function get_marked_da_file($type = '', $emp_id = '',$limit=null,$page=null)  {
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
		if(isset($_GET['searchby']) && $_GET['searchby']!=''){
			$searchval=trim($_GET['searchby']);
			$wheres= "(FIND_IN_SET('".$searchval."',ft_files.file_all_section_no) OR ft_files.file_subject like '%".$searchval."%'  OR ft_files.file_uo_or_letter_no like '%".$searchval."%' OR ft_files.file_uo_or_letter_date = DATE_FORMAT('".$searchval."', '%Y-%m-%d'))";
			$this->db->where($wheres);
		}
		$section_ids = array(7,25);
		$this->db->where_in("$tbl1.file_mark_section_id",$section_ids);
		
		$this->db->order_by("file_update_date", 'ASC');
		$this->db->limit($limit,$page);	
		$query = $this->db->get();
	    //echo $this->db->last_query();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return FALSE;
		}
		}

	public function show_count_marked_da_file($type = '', $emp_id = '')  {
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

		$section_ids = array(7,25);
		$this->db->where_in("$tbl1.file_mark_section_id",$section_ids);
		
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

