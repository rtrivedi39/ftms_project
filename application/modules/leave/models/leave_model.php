<?php

class Leave_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function insert_leave($data) {
        return $this->db->insert(LEAVE_MOVEMENT, $data);
    }

    function update_employee($data) {
        $this->db->where('emp_id', $this->session->userdata('emp_id'));
        return $this->db->update(EMPLOYEE_DETAILS, $data);
    }

    public function getLeaves($id = '') {
        $this->db->select('cl_leave,ol_leave,el_leave,hpl_leave');
        if($id == ''){
            $this->db->where('emp_id', $this->session->userdata('emp_id'));
        }else {
            $this->db->where('emp_id', $id);
        }
        $query = $this->db->get(EMPLOYEE_LEAVE);
        $this->db->last_query();
        return $query->row();
    }

    public function get_leaves($leave_status = '', $leave_type = '', $id = '') {
        $this->db->select('*');
        if ($leave_status == 'pending') {
            $equal = "( emp_leave_forword_type = 0 or emp_leave_forword_type = 1 or emp_leave_forword_type = 2 ) and (emp_leave_approval_type = 0)";
            $this->db->where($equal);
        }
        if ($leave_status == 'approve') {
            $equal = "( emp_leave_forword_type = 1 or emp_leave_approval_type = 1)";
            $this->db->where($equal);
        }
        if ($leave_status == 'deny') {
            $equal = "( emp_leave_forword_type = 2 or emp_leave_approval_type = 2)";
            $this->db->where($equal);
        }
        if ($leave_status == 'cancel') {
            $equal = "( emp_leave_forword_type = 3 or emp_leave_approval_type = 3)";
            $this->db->where($equal);
        }
        if ($leave_status == 'approve_deny') {
            $equal = "( emp_leave_forword_type = 1 or emp_leave_approval_type = 1 or emp_leave_forword_type = 2 or emp_leave_approval_type = 2)";
            $this->db->where($equal);
        }
        if ($leave_status == 'leaves_approve_deny_cancel') {
            $equal = "(emp_leave_approval_type = 1 or emp_leave_approval_type = 2 or emp_leave_approval_type = 3 or  emp_leave_forword_type = 3)";
            $this->db->where($equal);
        }
        if (!empty($leave_type)) {
            $this->db->where('emp_leave_type', $leave_type);
        }
        $emp_id = $id == '' ? $this->session->userdata('emp_id') : $id ;
        $this->db->where(LEAVE_MOVEMENT . '.emp_id',$emp_id );
        $this->db->join(EMPLOYEES, EMPLOYEES . '.emp_id = ' . LEAVE_MOVEMENT . '.emp_id');
        $this->db->from(LEAVE_MOVEMENT);
        $this->db->order_by('emp_leave_create_date', 'DESC');
        $query = $this->db->get();
       //echo $this->db->last_query() . br();
        return $rows = $query->result();
    }

    public function getAllELLeaves($leave_status = '') {
        $this->db->select(LEAVE_MOVEMENT . '.emp_id,emp_leave_reason,emp_leave_movement_id,role_id,emp_full_name,emp_full_name_hi, emp_leave_type,emp_leave_end_date,emp_leave_no_of_days,emp_leave_date,emp_leave_forword_type');
        if ($this->session->userdata('user_role') == 11) {
            $this->db->where('emp_leave_type', 'el');
        }
        if ($leave_status == 'pending') {
            $this->db->where('emp_leave_forword_type', 0);
        }
        $this->db->join(EMPLOYEES, EMPLOYEES . '.emp_id = emp_leave_movement_id', 'left');
        $this->db->from(LEAVE_MOVEMENT);
        $this->db->order_by('emp_leave_create_date', 'DESC');
        $query = $this->db->get();
        $this->db->last_query();
        return $rows = $query->result();
    }


	public function get_allaproval_lists($leave_type = ''){
		$userrole = checkUserrole();
		$this->db->select('*');
		$equal = "((emp_leave_forword_type = 1 or emp_leave_forword_type = 2 ) and emp_leave_approval_type = 0)";
		switch($userrole){
			case 1 :  //for admin
				$this->db->where($equal);
			break;
			case 4 :  // for secretary
				$condition_1 = "((emp_leave_type != 'el' or emp_leave_type != 'hpl') and emp_leave_no_of_days < '7'  and role_id > 16)";
				$condition_2 = "((emp_leave_type = 'el' or emp_leave_type = 'hpl') and emp_leave_no_of_days < '7'  and role_id > 16) ";
				$this->db->where('('.$equal.' and ('.$condition_1 .' or '. $condition_2.'))');
				//$this->db->where($condition_2);
			break;
			case 3 :  // for PS
				$condition_1 = "((emp_leave_type != 'el' or emp_leave_type != 'hpl') and role_id <= 16)";
				$condition_2 = "((emp_leave_type = 'el' or emp_leave_type = 'hpl') and emp_leave_no_of_days >= '7' )";
				$condition_3 = "((emp_leave_type != 'el' or emp_leave_type != 'hpl') and role_id <= 16 and (emp_leave_forword_type = 0 and emp_leave_approval_type = 0))";
				$this->db->where('(('.$equal.' and ('.$condition_1 .' or '. $condition_2.')) or ('.$condition_3.'))');
				//$this->db->where($condition_2);

			default:  // for others

			break;

		}
		if($leave_type != '') {
            $this->db->where('emp_leave_type', $leave_type);
        }
        $this->db->join(EMPLOYEES, EMPLOYEES . '.emp_id = ' . LEAVE_MOVEMENT . '.emp_id', 'left');
        $this->db->from(LEAVE_MOVEMENT);
        $this->db->order_by('emp_leave_movement_id', 'desc');
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $rows = $query->result();
	}

	public function get_allforword_lists($leave_type = ''){
		$userrole = checkUserrole();
		$this->db->select('*');
		$equal = "(emp_leave_forword_type = 0 and emp_leave_approval_type = 0)";
		switch($userrole){
			case 1 :  //for admin
				$this->db->where($equal);
			break;
			case 4 :  // for secretary
				$condition_1 = "((emp_leave_type != 'el' or emp_leave_type != 'hpl') and role_id > 16)";
				$condition_2 = "((emp_leave_type = 'el' or emp_leave_type = 'hpl') and (role_id BETWEEN 4 AND 16)) ";
				$this->db->where('('.$equal.' and ('.$condition_1 .' or '. $condition_2.'))');
				//$this->db->where($condition_2);
			break;
			case 3 :  // for PS
				$this->db->where($equal);
			default:  // for others
				$this->db->where($equal);
			break;

		}
		if($leave_type != '') {
            $this->db->where('emp_leave_type', $leave_type);
        }
        $this->db->join(EMPLOYEES, EMPLOYEES . '.emp_id = ' . LEAVE_MOVEMENT . '.emp_id', 'left');
        $this->db->from(LEAVE_MOVEMENT);
        $this->db->order_by('emp_leave_movement_id', 'desc');
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $rows = $query->result();
	}


    public function getAllLeaves($leave_status = '', $leave_type = '', $isforword = true) {
        $this->db->select('*');
        $userrole = checkUserrole();

        if ($leave_status == 'pending') {
            if($isforword == true) {
                 $this->db->where('emp_leave_forword_type', 0);
            }else {
                $equal = "(emp_leave_forword_type = 1 or emp_leave_forword_type = 2 ) and (emp_leave_approval_type = 0)";
                if ($userrole == 3) {
                    $this->db->where($equal);
                    $this->db->where("(emp_leave_type = 'el' or emp_leave_type = 'hpl')");
                    $this->db->where('emp_leave_no_of_days >=', 7);
                } else {
                    $this->db->where($equal);
                }
            }
        }
        if ($leave_status == 'approve') {
            $this->db->where('emp_leave_forword_type', 1);
        }
        if ($leave_status == 'deny') {
            $this->db->where('emp_leave_forword_type', 2);
        }
        if ($leave_status == '') {
            $this->db->or_where('emp_leave_forword_type', 1);
            $this->db->or_where('emp_leave_forword_type', 2);
        }
        if (!empty($leave_type)) {
            $this->db->where('emp_leave_type', $leave_type);
        }
        $this->db->join(EMPLOYEES, EMPLOYEES . '.emp_id = ' . LEAVE_MOVEMENT . '.emp_id', 'left');
        $this->db->from(LEAVE_MOVEMENT);
        $this->db->order_by('emp_leave_movement_id', 'desc');
        $query = $this->db->get();
        $this->db->last_query();
        return $rows = $query->result();
    }

    public function getUser($search_type = '', $search_value = '') {

        if (!empty($search_type) && !empty($search_value)) {
            $employee_leave = EMPLOYEE_LEAVE;
            $employee = EMPLOYEES;
            $leave_movement = LEAVE_MOVEMENT;
            $this->db->select($employee . '.emp_id,emp_leave_movement_id,emp_unique_id,emp_full_name,emp_full_name_hi, emp_email,emp_mobile_number	,cl_leave,ol_leave,el_leave,hpl_leave,role_id');
            $this->db->from($employee);
            if ($search_type == 'User ID') {
                $this->db->where($employee . '.emp_unique_id', $search_value);
            }
            if ($search_type == 'Name') {
                $this->db->like($employee . '.emp_full_name', $search_value);
            }
            if ($search_type == 'Mobile Number') {
                $this->db->where($employee . '.emp_mobile_number', $search_value);
            }

            $this->db->join($employee_leave, $employee_leave . '.emp_id=' . $employee . '.emp_id', 'left');
            $this->db->join($leave_movement, $leave_movement . '.emp_id=' . $employee . '.emp_id', 'left');
            $query = $this->db->get();
            $this->db->last_query();
            return $rows = $query->row();
        } else {
            return false;
        }
    }

    public function updateLeave($leave_id, $data) {
        $this->db->where('emp_leave_movement_id', $leave_id);
        return $this->db->update(LEAVE_MOVEMENT, $data);
    }

    public function cancel_leave($id) {
        $this->db->where('emp_leave_movement_id', $id);
        $data = array(
            'emp_leave_forword_type' => '3',
            'leave_status' =>  5,
            'emp_leave_forword_date' => date('Y-m-d h:i:s'),
        );
        return $this->db->update(LEAVE_MOVEMENT, $data);
    }

    public function getLeave($leave_id) {
        $employee_leave = LEAVE_MOVEMENT;
        $this->db->where('emp_leave_movement_id', $leave_id);
        $query = $this->db->get($employee_leave);
        return $rows = $query->row();
    }

    public function getEmployeeLeave() {
        $employee_leave = EMPLOYEE_LEAVE;
        $employee = EMPLOYEES;
        $this->db->select($employee . '.emp_id,emp_unique_id,emp_full_name,emp_email,emp_mobile_number,emp_full_name_hi, cl_leave,ol_leave,el_leave,hpl_leave,role_id');
        $this->db->from($employee);
        $this->db->where('role_id !=', 1);
        $this->db->join($employee_leave, $employee_leave . '.emp_id=' . $employee . '.emp_id');
        $this->db->order_by("designation_id", "ASC");
		$this->db->order_by("emp_full_name_hi", "ASC");
		$query = $this->db->get();
        //$this->db->last_query();
        return $rows = $query->result();
    }

    public function getAllLeavesDetails($isforword = false) {
        $employee_leave_movement = LEAVE_MOVEMENT;
        $employee = EMPLOYEES;
        $this->db->select($employee . '.emp_id,emp_leave_reason,emp_unique_id,emp_leave_movement_id,emp_full_name,emp_full_name_hi, emp_leave_type,emp_leave_no_of_days,emp_leave_forword_emp_id,emp_leave_forword_type,emp_leave_forword_date,role_id,emp_leave_approval_type,emp_leave_approvel_date,emp_leave_create_date,emp_leave_date,	emp_leave_end_date');
        //$this->db->where('emp_leave_forword_emp_id',$this->session->userdata('emp_id'));
        $crnt_emp_id = 	$this->session->userdata('emp_id');
        $userrole = checkUserrole();
        
        if($isforword && in_array($userrole, array(1, 3, 4))){
           $this->db->where('emp_leave_forword_emp_id', $crnt_emp_id);
        } else {
            if (in_array($userrole, array(5, 6, 7, 8, 11, 14))) {
                $this->db->where('emp_leave_forword_emp_id', $crnt_emp_id);
            }
            if (in_array($userrole, array(1, 3, 4))) {
                $this->db->where('emp_leave_approval_emp_id', $crnt_emp_id);
            }
        }
        $this->db->from($employee);
        $this->db->where('emp_leave_forword_type !=', 3);
        $this->db->where('emp_leave_approval_type !=', 3);
        $this->db->join($employee_leave_movement, $employee_leave_movement . '.emp_id=' . $employee . '.emp_id');
        $this->db->order_by('emp_leave_date', 'desc');
        $this->db->limit(500);
        $query = $this->db->get();
        $this->db->last_query();
        return $rows = $query->result();
    }
	
	 public function get_approved_lists($limit = 100) {
        $employee_leave_movement = LEAVE_MOVEMENT;
        $employee = EMPLOYEES;
		$userrole = checkUserrole();
		$crnt_emp_id = 	$this->session->userdata('emp_id');
	    $emp_section = getusersection($crnt_emp_id);
        $this->db->select($employee . '.emp_id,emp_full_name,emp_full_name_hi,emp_unique_id,role_id,'.$employee_leave_movement.'.*');
        if(in_array($userrole, array(3, 4))){
           $this->db->where('emp_leave_approval_emp_id', $crnt_emp_id);
		   $this->db->where('emp_leave_approval_type', 1);
        } else if ((in_array(7, explode(',',$emp_section)) && $userrole == 8) || $userrole == 1 ){
           $this->db->where('emp_leave_approval_type', 1);
        }
		$this->db->where('emp_leave_forword_type !=', 3);
        $this->db->where('emp_leave_approval_type !=', 3);
        $this->db->from($employee);        
        $this->db->join($employee_leave_movement, $employee_leave_movement . '.emp_id=' . $employee . '.emp_id');
        $this->db->order_by('emp_leave_approvel_date', 'desc');
        $this->db->limit($limit);
        $query = $this->db->get();
        $this->db->last_query();
        return $rows = $query->result();
    }

    public function getSingleEmployee($emp_id) {
        $employee = EMPLOYEES;
         $this->db->select('emp_full_name, emp_full_name_hi,emp_id,role_id');
        $this->db->where('emp_id', $emp_id);
        $this->db->from($employee);
        $query = $this->db->get();
        return $query->row();
    }

    function get_reports($start_date, $end_date, $emp_id, $leave_type, $emp_section_id = '', $isdistinct = true) {
        $employee_leave_movement = LEAVE_MOVEMENT;
        $employee = EMPLOYEES;
        if ($isdistinct) {
            $this->db->select("DISTINCT(ft_".$employee_leave_movement . ".emp_id)");
        } else {
            $this->db->select('*');
        }
        $this->db->where('emp_leave_date >=', get_date_formate($start_date, 'Y-m-d'));
        $this->db->where('emp_leave_date <=', get_date_formate($end_date, 'Y-m-d'));
        if ($emp_id != '') {
            $this->db->where($employee_leave_movement . '.emp_id', $emp_id);
        }
        if ($leave_type != '') {
            $this->db->where('emp_leave_type', $leave_type);
        }
        if ($emp_section_id != '') {
            $this->db->where_in('emp_section_id', $emp_section_id);
        }
        $this->db->where_in('emp_is_retired', 0);
        $this->db->from($employee_leave_movement);
        $this->db->join($employee, $employee_leave_movement . '.emp_id=' . $employee . '.emp_id');
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $rows = $query->result();
    }

    public function getTotalLeave($emp_id, $leave_type = '') {
        
        $employee_leave = EMPLOYEE_LEAVE;
        if($leave_type == ''){
            $this->db->select('*');
        }else{
            $leave_type = $leave_type == 'hq' || $leave_type == 'ihpl' || $leave_type == 'sl' ? 'other' : $leave_type ;
            $leave = $leave_type.'_leave';
            $this->db->select($leave);
        }
        $this->db->where('emp_id', $emp_id);
        $this->db->from($employee_leave);
        $query = $this->db->get();
        $this->db->last_query();
        $rows = $query->row();
        if($leave_type == ''){
            return $rows;
        }else{
            return $rows->$leave;
        }
    }
    public function get_remaining_leaves($id = '', $leave_type, $type_of_hpl, $isall = false) {
        $leave_movement = LEAVE_MOVEMENT;
        if($isall){
            $this->db->select('*');
        }else{
            $this->db->select('sum(emp_leave_no_of_days) as total');
        }
        if ($id == '') {
            $emp_id = $this->session->userdata('emp_id');
        } else {
            $emp_id = $id;
        }
        $this->db->where('emp_id', $emp_id);
        $leave_type = $leave_type == 'hq' || $leave_type == 'ihpl' || $leave_type == 'sl' ? 'other' : $leave_type ;
        $this->db->where('emp_leave_type', $leave_type);
        $this->db->where('emp_leave_approval_type = 0 AND emp_leave_forword_type !=3');
        $this->db->from($leave_movement);
        $query = $this->db->get();
        //echo $this->db->last_query();
        $ret = $query->row();
        $total_rem = $this->getTotalLeave($emp_id,$leave_type);
        if($isall){
            return $ret;
        }else{
            if($type_of_hpl == 'hpl'){
                if($type == 'GG') {
                    return ($total_rem - ($ret->total * 2))/2;
                 } else {
                    return ($total_rem - ($ret->total * 2))/4;
                 }
            }else{
                return $total_rem - $ret->total;
            }
        }
    }

     public function getUnderEmployee($emp_id = '') {
        $hiraarchi_level = EMPLOYEE_HIARARCHI_LEVEL;
		if($emp_id != ''){
			$emp_id = $this->db->where('emp_id', $emp_id);
		} else{
			$emp_id = $this->session->userdata('emp_id');
		}
       
        $query = $this->db->get($hiraarchi_level);
        $this->db->last_query();
        return $rows = $query->result();
    }

    public function getUnderEmployeeUser($emp_id = '') {
        $employee_ids = array();
        $empids = $this->getUnderEmployee($emp_id);
        foreach ($empids as $empid) {
            $employee_ids[] = $empid->under_emp_id;
        }
        if ($employee_ids) {
            $employee_leave = EMPLOYEE_LEAVE;
            $employee = EMPLOYEES;
            $this->db->select($employee . '.emp_id,emp_unique_id,emp_full_name,emp_full_name_hi, emp_email,emp_mobile_number,cl_leave,ol_leave,el_leave,hpl_leave,role_id');
            $this->db->from($employee);
            $this->db->where_in($employee_leave . '.emp_id', $employee_ids);
            $this->db->join($employee_leave, $employee_leave . '.emp_id=' . $employee . '.emp_id', 'left');
			$this->db->order_by('role_id', 'ASC');
			$this->db->order_by('emp_full_name', 'ASC');
            $query = $this->db->get();
            $this->db->last_query();
            return $rows = $query->result();
        } else {
            return false;
        }
    }

    public function updateLeaveMovement($udata, $leave_movement_id) {
        $leave_movement = LEAVE_MOVEMENT;
        $this->db->where('emp_leave_movement_id', $leave_movement_id);
        return $this->db->update($leave_movement, $udata);
    }

    public function saveLeaveRemark($data) {
        $leave_remark = LEAVE_REMARK;
        return $this->db->insert($leave_remark, $data);
    }

    public function get_applied_lists() {
        $leave_movement = LEAVE_MOVEMENT;
        $employee = EMPLOYEES;
        $this->db->select('*');
        $this->db->where('on_behalf_leave',$this->session->userdata('emp_id'));      
        $this->db->where($leave_movement . '.emp_id != ', $this->session->userdata('emp_id') ); 
        $this->db->from($employee);
        $this->db->join($leave_movement, $leave_movement . '.emp_id=' . $employee . '.emp_id');
        $this->db->order_by('emp_leave_create_date', 'desc');
        $query = $this->db->get();
       //echo  $this->db->last_query();
        return $rows = $query->result();
    }


    public function get_forworded_lists() {
        $leave_movement = LEAVE_MOVEMENT;
        $employee = EMPLOYEES;
        $this->db->select('*');        
        $this->db->where('emp_leave_forword_emp_id',$this->session->userdata('emp_id'));      
        $this->db->from($employee);
        $this->db->join($leave_movement, $leave_movement . '.emp_id=' . $employee . '.emp_id');
        $this->db->order_by('emp_leave_forword_date', 'desc');
        $query = $this->db->get();
       //echo  $this->db->last_query();
        return $rows = $query->result();
    }
    
    //leave check
   /* public function is_leave_exits($emp_id, $date, $leave_type) {
        $date = date('Y-m-d',strtotime($date));
        if ($this->check_leave_date($emp_id, $date)) {
            if ($leave_type == 'hpl' || $leave_type == 'el') {
                $this->check_leave_date_before_after($emp_id, $date);
            } else {
                return false;
            }
        } else {
            return true;
        }
    } */

    public function is_leave_exits($emp_id, $date, $end_date, $leave_type = '', $otherday = false) {
        $apply_date = strtotime($date);
        $apply_end_date = strtotime($end_date);
        $this->db->select('*');
        $this->db->where('emp_id', $emp_id);
        $this->db->where('emp_leave_forword_type !=', 3);
        $this->db->where('emp_leave_approval_type !=', 3);
        $otherday ? $this->db->where('emp_leave_date !=', date('Y-m-d', $apply_date)) : '' ;
        $this->db->from(LEAVE_MOVEMENT);
        $query = $this->db->get();
         //echo $this->db->last_query(); exit;
        if ($query->num_rows() > 0) {
            //echo $query->num_rows(); exit;
            foreach ($query->result() as $row) {
                $start_date = strtotime($row->emp_leave_date);
                $end_date = strtotime($row->emp_leave_end_date);
                if ($apply_date >= $start_date && $apply_date <= $end_date) {
                    $return = false; 
                }  else {
                    $return = true; 
                }
                /* else if ($apply_end_date >= $start_date) {
                    $return = false;  
                } */
               if($return == false) { return  true; break; } 
            }
        } else {
            return false;
        }
    }
    
    public function check_leave_date_after($emp_id, $date, $isel_hpl = false) {
        $apply_date = strtotime($date);
        $this->db->select('*');
        $this->db->where('emp_id', $emp_id);
        if($isel_hpl == true){
            $where = "(emp_leave_type = 'hpl' or emp_leave_type = 'el')";
        } else{
            $where = "((emp_leave_type = 'cl' and (emp_leave_half_type = '' or emp_leave_half_type = 'SH')) or emp_leave_type = 'ol')";
        }
        $this->db->where('emp_leave_forword_type !=', 3);
        $this->db->where('emp_leave_approval_type !=', 3);
        $this->db->where($where);
        $this->db->from(LEAVE_MOVEMENT);
        $query = $this->db->get();
       //echo $this->db->last_query(); exit;
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $start_date = strtotime($row->emp_leave_date.' +1 day');
                $end_date_after = strtotime($row->emp_leave_end_date.' +1 day'); 
                if ($apply_date >= $start_date && $apply_date <= $end_date_after) {
                    $return = true;
                } else {
                    $return =  false;
                }
                if($return == true) { return  true; break; } 
            }
        } else{
           return false;
        }
    }
    
    public function is_leave_exits_before_holiday($emp_id, $date, $isel_hpl = false){
        $leave_dates_interval = array();
        if($isel_hpl == false){
            $last_leave = $this->leave_model->get_last_leave($emp_id, '', true);
        }else{
            $last_leave = $this->leave_model->get_last_leave($emp_id);
        }
        if($last_leave !== false) {
            $last_leave_date = $last_leave[0]->last_leave;
            $last_date_after = date('Y-m-d', strtotime($last_leave_date . ' +1 day'));
            $diff = day_difference_dates($last_date_after, $date);
            if($diff < 7){
                for ($i = 1; $i <= $diff; $i++) {
                    $date_counter = date('Y-m-d', strtotime($last_leave_date . ' +' . $i . ' day'));
                    $response = check_holidays($date_counter);
                    if ($response == true) {
                        $leave_dates_interval[] = $date_counter;
                    } else{
                        return false;
                    }
                }
                if(!empty($leave_dates_interval)){
                    return true;
                }else {
                    return false;
                }
            }
            else {
                return false;
            }
        } else {
            return false;
        }
        
    }
    
    public function get_last_leave($emp_id, $leave_id = '', $isother = false){
        $this->db->select('max(emp_leave_end_date) as last_leave');
        $this->db->where('emp_id', $emp_id);
        $this->db->where('emp_leave_forword_type !=', 3);
        $this->db->where('emp_leave_approval_type !=', 3);
        if($leave_id != ''){
            $this->db->where('emp_leave_movement_id !=', $leave_id);
        }
        if($isother == false){
            $where = "(emp_leave_type = 'el' or emp_leave_type = 'hpl')";
        }else{
            $where = "(emp_leave_type = 'cl' or emp_leave_type = 'ol')"; 
        }
        $this->db->where($where);
        $this->db->limit('1');
        $this->db->from(LEAVE_MOVEMENT);
        $query = $this->db->get();
        //echo $this->db->last_query(); exit;
        $rows = $query->result();
        if ($query->num_rows() > 0 && $rows[0]->last_leave != '') {
            return $rows;
        } else {
            return false;
        }
        
    }

    public function is_leave_exits_ondate($emp_id, $date, $isreturn = false) {
        $this->db->select('*');
        $this->db->where('emp_id', $emp_id);
        $this->db->where('emp_leave_date', $date);
        $this->db->where('emp_leave_forword_type !=', 3);
        $this->db->where('emp_leave_approval_type !=', 3);
        $where = "(emp_leave_type = 'cl' or emp_leave_type = 'ol')";
        $this->db->where($where);
        $this->db->limit('1');
        $this->db->order_by('emp_leave_create_date','desc');
        $this->db->from(LEAVE_MOVEMENT);
        $query = $this->db->get();
        // echo $this->db->last_query(); exit;
        if($isreturn){
            return $query->result();
        }else{
            if ($query->num_rows() > 0) {
                //echo $query->num_rows(); exit;
                 return true;
            } else {
                return false;
            }
        }
    }
    
    public function update_leave_exists($data){
        if($data[0]->emp_leave_approval_type == 1 ){
            $upt_data_appr = array(
               'leave_status' => 5,
               'emp_leave_forword_type' => '3',
               'emp_leave_approval_type' => '3',
               'emp_leave_deny_reason' => 'इस दिनांक को अन्य अवकाश लिया',
            );
            $this->db->where('emp_leave_movement_id', $data[0]->emp_leave_movement_id);
            $this->db->update(LEAVE_MOVEMENT, $upt_data_appr);
            deductLeaveAdd($data[0]->emp_id, $data[0]->emp_leave_type, $data[0]->emp_leave_no_of_days);
        } else {
            $upt_data = array(
                'emp_leave_forword_type' => '3',
                'emp_leave_approval_type' => '3',
                // 'emp_leave_approvel_date' => date('Y-m-d'),
                //'emp_leave_forword_date' => date('Y-m-d'),
                'leave_status' => 5,
                'emp_leave_deny_reason' => 'Cancel and convert',
            );
            $this->db->where('emp_leave_movement_id', $data[0]->emp_leave_movement_id);
            $this->db->update(LEAVE_MOVEMENT, $upt_data);

        }
        return true;
    }
    
    public function adjust_leave($id, $upt_data){
        $this->db->where('emp_leave_movement_id', $id);
        $this->db->update(LEAVE_MOVEMENT, $upt_data);
    }
    
    
    /* leave level employeee model start*/

    public function get_leave_under_employees() {
        $employee_ids = array();
        $empids = $this->get_under_forwader_employees();
        foreach ($empids as $empid) {
            $employee_ids[] = $empid->emp_id;
        }
        if ($employee_ids) {
            $employee_leave = EMPLOYEE_LEAVE;
            $employee = EMPLOYEES;
            $this->db->select($employee . '.emp_id,emp_unique_id,emp_full_name,emp_full_name_hi, emp_email,emp_mobile_number,cl_leave,ol_leave,el_leave,hpl_leave,role_id');
            $this->db->from($employee);
            $this->db->where_in($employee_leave . '.emp_id', $employee_ids);
            $this->db->join($employee_leave, $employee_leave . '.emp_id=' . $employee . '.emp_id', 'left');			
            $query = $this->db->get();
           // echo $this->db->last_query();
            return $rows = $query->result();
        } else {
            return false;
        }
    }
    
    public function get_under_forwader_employees($id = ''){
        $this->db->select('*');
        if($id == ''){
            $emp_id = $this->session->userdata('emp_id');
        }else{
            $emp_id = $id;
        }
        if($this->session->userdata('user_role') != 1 ){
           $this->db->where('forwarder_id', $emp_id); 
        }
        $this->db->join(EMPLOYEE_LEAVE_LEVEL_MASTER, EMPLOYEE_LEAVE_LEVEL_MASTER . '.emp_id = ' . EMPLOYEES . '.emp_id');
        $this->db->from(EMPLOYEES);
        $query = $this->db->get();
        //echo $this->db->last_query(); exit;
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    public function get_under_recommender_employees($id = ''){
        $this->db->select('*');
        if($id == ''){
            $emp_id = $this->session->userdata('emp_id');
        }else{
            $emp_id = $id;
        }
        $this->db->where('recommender_id', $emp_id);
        $this->db->join(EMPLOYEE_LEAVE_LEVEL_MASTER, EMPLOYEE_LEAVE_LEVEL_MASTER . '.emp_id = ' . EMPLOYEES . '.emp_id');
        $this->db->from(EMPLOYEES);
        $query = $this->db->get();
         //echo $this->db->last_query(); exit;
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    public function get_under_approver_employees($id = ''){
        $this->db->select('*');
        if($id == ''){
            $emp_id = $this->session->userdata('emp_id');
        }else{
            $emp_id = $id;
        }
        $this->db->where('approver_id', $emp_id);
        $this->db->join(EMPLOYEE_LEAVE_LEVEL_MASTER, EMPLOYEE_LEAVE_LEVEL_MASTER . '.emp_id = ' . EMPLOYEES . '.emp_id');
        $this->db->from(EMPLOYEES);
        $query = $this->db->get();
           //echo $this->db->last_query(); exit;
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
}
