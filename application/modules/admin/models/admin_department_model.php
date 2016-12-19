<?php

class Admin_department_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();

    }

    public function   getdepartmentData($id)
    {

        $query = $this->db->get_where(DEPARTMENTS,
            array(
                'dept_id'=>$id
            )
        );
        return $query->row_array();
    }

    public function adddepartment($data)
    {
        //pr($data);
        $this->db->insert(DEPARTMENTS, $data);
        return $this->db->insert_id();

    }

    public function updatedepartment($data , $dept_id)
    {
        $this->db->where('dept_id' ,$dept_id);
       return $this->db->update(DEPARTMENTS,$data);
    }
        
    public function getUnderEmployee($emp_id) {
        $hiraarchi_level = EMPLOYEE_HIARARCHI_LEVEL;
        $this->db->where('emp_id', $emp_id);
        $query = $this->db->get($hiraarchi_level);
       //echo  $this->db->last_query();
        return $rows = $query->result();
    }

    public function get_departmental_structure($emp_id) {
        $employee_ids = array();
        $empids = $this->getUnderEmployee($emp_id);
        foreach ($empids as $empid) {
           // if($empid != $emp_id){
                $employee_ids[] = $empid->under_emp_id;
          //  }
        }
        if ($employee_ids) {
            $employee_leave = EMPLOYEE_LEAVE;
            $employee = EMPLOYEES;
            $this->db->select($employee . '.emp_id,emp_unique_id, emp_full_name,emp_full_name_hi,emp_email, emp_mobile_number, cl_leave,ol_leave, el_leave,hpl_leave, designation_id');
            $this->db->from($employee);
            $this->db->where($employee_leave . '.emp_id !=', $emp_id);
            $this->db->where($employee . '.emp_status', 1);
            $this->db->where($employee . '.emp_is_parmanent', 1);
            $this->db->where($employee . '.emp_is_retired', 0);
            $this->db->where_in($employee_leave . '.emp_id', $employee_ids);
            $this->db->join($employee_leave, $employee_leave . '.emp_id=' . $employee . '.emp_id', 'left');
            $this->db->order_by('role_id', 'ASC');
            $this->db->order_by('emp_full_name', 'ASC');
            $query = $this->db->get();
            //echo $this->db->last_query();
            return $rows = $query->result();
        } else {
            return false;
        }
    }
}