<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Test_file_move	 extends MX_Controller {
    function __construct() {
        parent::__construct();
    }
    public function index()
    {


    	/*error_reporting(1);
       	echo $i = 1;    	    
		$qur = "SELECT file_id FROM `ft_files` WHERE `file_hardcopy_status` = 'close'";
		$result = $this->db->query($qur);
		$files = $result->result(); 
		
		foreach($files as $file){	
			$id  = $file->file_id;
			$vv = "ft_";
			
			$query9 ="INSERT $vv".DIGITAL_SINATURE_MASTER." SELECT * FROM $vv".DIGITAL_SINATURE." WHERE ds_file_id =$id";
			$query =$this->db->query($query9);
			
			$query7 ="INSERT $vv".DRAFT_LOG_MASTER." SELECT * FROM $vv".DRAFT_LOG." WHERE draft_log_file_id =$id";
			$query =$this->db->query($query7);
			
			$query1 ="INSERT $vv".FILES_MASTER."  SELECT * FROM $vv".FILES." WHERE file_id=$id";
			$query =$this->db->query($query1);
			
			$query2 ="INSERT $vv".FILES_MOVEMENT_MASTER." SELECT * FROM $vv".FILES_MOVEMENT." WHERE fmove_file_id =$id";
			$query =$this->db->query($query2);
			
			$query3 ="INSERT $vv".FILES_LOG_MASTER." SELECT * FROM $vv".FILES_LOG." WHERE file_id =$id";
			$query =$this->db->query($query3);			
			
			$query4 ="DELETE FROM $vv".FILES." WHERE file_id=$id";
			$query =$this->db->query($query4);
			
			$query5 ="DELETE FROM $vv".FILES_MOVEMENT." WHERE fmove_file_id =$id";
			$query =$this->db->query($query5);
			
			$query6 ="DELETE FROM $vv".FILES_LOG." WHERE file_id =$id;";
			$query =$this->db->query($query6);

			$query8 ="DELETE FROM $vv".DRAFT_LOG." WHERE draft_log_file_id = $id;";
			$query =$this->db->query($query8);
			
			$query10 ="DELETE FROM $vv".DIGITAL_SINATURE." WHERE ds_file_id = $id;";
			$query =$this->db->query($query10);
		$i++;
		
		}	*/
		echo $i;
    }    
}