<?php
class Dealing_file_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }
	public function count_getFiles_DA($section_id,$id)
    {
		$tbl_files = FILES;
        $tbl4 = DEPARTMENTS;
        $tbl5 = DISTRICT;
        $this->db->select("COUNT(DISTINCT(file_id)) as totalfiles");
        $this->db->join($tbl4, "$tbl4.dept_id = $tbl_files.file_department_id", 'left');
        $this->db->join($tbl5, "$tbl5.district_id = $tbl_files.file_district_id",'left');		
        $this->db->where('file_received_emp_id',emp_session_id());		
        if(!empty($section_id)){            
            $this->db->where_in('file_mark_section_id', explode(',',$section_id));
        }
        if ($id == '2'){
                $this->db->where('file_return', '1');
		}else if($id == '1'){				
                $this->db->where('file_hardcopy_status =', 'working');				
		}else{
            //    $this->db->where('file_return !=', '1');
                $this->db->where('file_hardcopy_status !=', 'working');
                $this->db->where('file_hardcopy_status !=', 'close');
        }
		if(isset($_GET['sstype']) && $_GET['sstype']!=''){
			$filetype=$_GET['sstype'];
			 $this->db->where('section_file_type', "$filetype");
		}
		if(isset($_GET['searchby']) && $_GET['searchby']!=''){
			$searchval=trim($_GET['searchby']);
			$wheres= "(FIND_IN_SET('".$searchval."',ft_files.file_all_section_no) OR ft_files.file_subject like '%".$searchval."%'  OR ft_files.file_uo_or_letter_no like '%".$searchval."%' OR ft_files.file_uo_or_letter_date = DATE_FORMAT('".$searchval."', '%Y-%m-%d'))";
			$this->db->where($wheres);
		}					
        $query = $this->db->get($tbl_files);        
        return $query->row_array();
    }
    // for fetch uesrid and sectionid wise file list
    public function getFiles_DA($section_id,$id,$limit=null,$page=null)
    {
       // pr($id);
       $tbl_files = FILES;
        $tbl4 = DEPARTMENTS;
        $tbl5 = DISTRICT;
        $this->db->select(FILES .'.*,dept_name_hi,district_name_hi');
        $this->db->join($tbl4, "$tbl4.dept_id = $tbl_files.file_department_id", 'left');
        $this->db->join($tbl5, "$tbl5.district_id = $tbl_files.file_district_id",'left');
		
        $this->db->where('file_received_emp_id',emp_session_id());
		
        if(!empty($section_id)){
            //echo $section_id;
            $this->db->where_in('file_mark_section_id', explode(',',$section_id));
        }
        if ($id == '2'){
                $this->db->where('file_return', '1');
            }else if($id == '1'){				
                $this->db->where('file_hardcopy_status =', 'working');				
            }else{
            //    $this->db->where('file_return !=', '1');
                $this->db->where('file_hardcopy_status !=', 'working');
                $this->db->where('file_hardcopy_status !=', 'close');
        }
        if(isset($_GET['searchby']) && $_GET['searchby']!=''){
			$searchval=trim($_GET['searchby']);
			$wheres= "(FIND_IN_SET('".$searchval."',ft_files.file_all_section_no) OR ft_files.file_subject like '%".$searchval."%'  OR ft_files.file_uo_or_letter_no like '%".$searchval."%' OR ft_files.file_uo_or_letter_date = DATE_FORMAT('".$searchval."', '%Y-%m-%d'))";
			$this->db->where($wheres);
		}	
		$this->db->order_by("file_update_date", 'asc');        
		$this->db->limit($limit,$page);	;
		$query = $this->db->get($tbl_files);
        //echo $this->db->last_query();      
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