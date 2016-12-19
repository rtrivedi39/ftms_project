<?php
class Dealing_file_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    // for fetch uesrid and sectionid wise file list
    public function getFiles_DA($section_id,$id)
    {
       // pr($id);
       $tbl_files = FILES;
        $tbl4 = DEPARTMENTS;
        $tbl5 = DISTRICT;
        $this->db->select(FILES .'.*,dept_name_hi,district_name_hi');
        $this->db->join($tbl4, "$tbl4.dept_id = $tbl_files.file_department_id", 'left');
        $this->db->join($tbl5, "$tbl5.district_id = $tbl_files.file_district_id",'left');
		
        $this->db->where('file_received_emp_id',emp_session_id());
		
        $this->db->where('file_mark_section_id',$section_id);
        if ($id == '2'){
                $this->db->where('file_return', '1');
            }else if($id == '1'){
				
                $this->db->where('file_hardcopy_status =', 'working');
				
            }else{
            $this->db->where('file_return !=', '1');
            $this->db->where('file_hardcopy_status !=', 'working');
            $this->db->where('file_hardcopy_status !=', 'close');
        }
        $this->db->order_by('file_id','desc');
        $query = $this->db->get($tbl_files);
       //  echo $this->db->last_query();
        return $query->result();
    }

    // find dealing assistance unit id
    public function da_unitid($daempid)
    {
        $ty = EMPLOYEE_HIARARCHI_LEVEL;
        $this->db->from('EMPLOYEE');
        $this->db->where('emp_id = (SELECT emp_id FROM '.$ty.' where under_emp_id='.$daempid.' limit 1)', NULL , FALSE);
        $query = $this->db->get();
        $row = $query->row();
        //  $this->db->last_query()
        return $row->role_id;
    }

}