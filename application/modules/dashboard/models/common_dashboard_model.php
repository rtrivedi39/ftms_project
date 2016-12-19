<?php

class Common_dashboard_model extends CI_Model {

 	function __construct() {
        parent::__construct();
    }
	
	public function getTotalFile()
	{
		$sce_id = getEmployeeSection();
		$section = get_list(SECTIONS,null,array('section_id' =>$sce_id ));
		$query = $this->db->query("select count(file_id) as counts FROM ft_files where `file_mark_section_id`='".$sce_id."' and `file_return` !='2' and (file_hardcopy_status = 'received' or file_hardcopy_status = 'working')");
		$res1 =  $query->row_array();
		$query = $this->db->query("select count(file_id) as counts FROM ft_files where `file_mark_section_id`='".$sce_id."' and `file_return` !='2' and (file_hardcopy_status = 'not')");
		$res2 =  $query->row_array();
		$query = $this->db->query("select count(file_id) as counts FROM ft_files where `file_mark_section_id`='".$sce_id."' and `file_return` ='2'");
		$res3 =  $query->row_array();
		$total = $res1['counts'] + $res2['counts'] + $res3['counts'];
		return $total;
	}
	
	public function getTotalFile_dispetch()
	{
		$sce_id = getEmployeeSection();
		$query = $this->db->query("select count(file_id) as total_dispetch_files FROM ft_files where `file_return` ='2'");
		$res3 =  $query->row_array();

		$query = $this->db->query("select count(file_id) as total_dispetch_working_files  FROM ft_files where `file_return` ='2' and (file_hardcopy_status = 'received' or file_hardcopy_status = 'working')");
		$res1 =  $query->row_array();
		
		$query = $this->db->query("select count(file_id) as total_dispetch_pending_files FROM ft_files where `file_return` ='2' and (file_hardcopy_status = 'not')");
		$res2 =  $query->row_array();
		
		$query = $this->db->query("select count(file_id) as total_dispetch_closed_files FROM ft_files where `file_return` ='2' and file_hardcopy_status = 'close'");
		$res4 =  $query->row_array();
		$total_array = array('total_files_in_dis'=>$res3['total_dispetch_files'],
				'total_working_files_in_dis'=>$res1['total_dispetch_working_files'],
				'total_pending_files_in_dis'=>$res2['total_dispetch_pending_files'],
				'total_close_files_in_dis'=>$res4['total_dispetch_closed_files'],
			);
		//$total = $res1['total_dispetch_working_files'] + $res2['total_dispetch_pending_files'] + $res3['total_dispetch_files'];
		//pre($total_array);
		return $total_array;
	}
	
	
	public function getDispatchFile()
	{
		$sce_id = getEmployeeSection();
		$section = get_list(SECTIONS,null,array('section_id' =>$sce_id ));		
		$query = $this->db->query("select count(file_id) as counts FROM ft_files where `file_mark_section_id`='".$sce_id."' and `file_return` ='2'");
		$res3 =  $query->row_array();
		$total = $res3['counts'];
		return $total;
	}
	public function getpendingFile()
	{
		$totalfile = $this->getTotalFile();
		$dispatchFile = $this->getDispatchFile();
		$pendingFile = $totalfile - $dispatchFile;
		return $pendingFile;
		
	}
	
	
	public function getPendingfilesDetails()
	{
		
	}
	public function getNoticeBoardInformation($setion_id = '')
	{
		$notice_board = NOTICE_BOARD;
		$this->db->select('notice_subject,notice_description,notice_attachment,	notice_remark,notice_created_date,notice_from_date,notice_to_date,notice_is_active');
		$this->db->where( 'emp_id', $this->session->userdata('emp_id'));
		$this->db->or_where( 'notice_section_id', $setion_id);
		$this->db->from($notice_board);
		$query = $this->db->get();
		$rows = $query->result();
		$this->db->last_query();
		return $rows;
	}
}

