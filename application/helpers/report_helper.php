<?php
	
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @ Function Name      : pr
 * @ Function Params    : $data {mixed}, $kill {boolean}
 * @ Function Purpose   : formatted display of value of varaible
 * @ Function Returns   : foramtted string
 */
 function file_dispatchre()
 {      $ci = & get_instance();
			$query = "SELECT count(file_id) AS counts,
				  SUM(IF((`issection_despose` = 0), 1,0)) AS not_section_dispose,
				  SUM(IF((`issection_despose` = 1), 1,0)) AS section_dispose
				  FROM ft_file_dispatch";
			$query = $ci->db->query($query);
			$result = $query->row_array();
			return $result;
}function par_vettingen()
{
	$query = $this->db->query("select count(file_id) as counts FROM ft_files UNION  
							SELECT  count(file_id) as counts FROM ft_files_master  where `file_mark_section_id`='".$sce_id."' and `file_from_section_id`='18' and `file_return` !='2' and (file_hardcopy_status = 'received' or file_hardcopy_status = 'working')");
						$res1 =  $query->row_array();
						$query = $this->db->query("select count(file_id) as counts FROM ft_files UNION  
							SELECT  count(file_id) as counts FROM ft_files_master where `file_mark_section_id`='".$sce_id."' and `file_from_section_id`='18' and `file_return` !='2' and (file_hardcopy_status = 'not')");
						$res2 =  $query->row_array();
						$query = $this->db->query("select count(file_id) as counts FROM ft_files UNION  
							SELECT  count(file_id) as counts FROM ft_files_master where `file_mark_section_id`='18' and `file_from_section_id`='28' and `file_return` ='2'");
						$res3 =  $query->row_array();
						
						return $res3;
	
}
function par_translation()
{
	$ci = & get_instance();
		$query = $this->db->query("select count(file_id) as counts FROM ft_files UNION  
							SELECT  count(file_id) as counts FROM ft_files_master where `file_mark_section_id`='".$sce_id."' and `file_from_section_id`='16' and `file_return` !='2' and (file_hardcopy_status = 'received' or file_hardcopy_status = 'working')");
						$res1 =  $query->row_array();
						$query = $this->db->query("select count(file_id) as counts FROM ft_files UNION  
							SELECT  count(file_id) as counts FROM ft_files_master where `file_mark_section_id`='".$sce_id."' and `file_from_section_id`='16' and `file_return` !='2' and (file_hardcopy_status = 'not')");
						$res2 =  $query->row_array();
						$query = $this->db->query("select count(file_id) as counts FROM ft_files where `file_mark_section_id`='16' and `file_from_section_id`='20' and `file_return` ='2'");
						$res3 =  $query->row_array();
						return $res3;
	
						
	
}
 function parsentagsetion($sce_id)
 {
	 $ci = & get_instance();
		$query = "SELECT count(file_id) AS counts,
					SUM(IF((file_hardcopy_status = 'received' or file_hardcopy_status = 'working') && file_return !='2', 1,0)) AS working,
					SUM(IF((file_hardcopy_status = 'not') && file_return !='2', 1,0)) AS not_recive,
					SUM(IF((file_return = '2'), 1,0)) AS close
					FROM ft_files  where `file_mark_section_id`='".$sce_id."'
					UNION all 
					SELECT count(file_id) AS counts_close,
					SUM(IF((file_hardcopy_status = 'received' or file_hardcopy_status = 'working') && file_return !='2', 1,0)) AS working_close,
					SUM(IF((file_hardcopy_status = 'not') && file_return !='2', 1,0)) AS not_recive,
					SUM(IF((file_return = '2'), 1,0)) AS close
					FROM ft_files_master
					where `file_mark_section_id`='".$sce_id."'";
					$query = $ci->db->query($query);
					$result = $query->result();		
			return $result;					
 }
 function count_receivedfiles($id){
	 	 $ci = & get_instance();
		 $qry="select count(file_id) as total_recieved_file FROM ft_".FILES." where `file_mark_section_id`='".$id."' and `file_return` !='2' and file_hardcopy_status = 'received'";
		 $query = $ci->db->query($qry);
		 $result = $query->row_array();		
		return $result;	
 }function count_workingdfiles($sec_id){
	 $ci = & get_instance();
	  $qry0="select count(file_id) as total_working_file FROM ft_".FILES." where `file_mark_section_id`='".$sec_id."' and `file_return` !='2' and file_hardcopy_status = 'working'";
	  $query = $ci->db->query($qry0);
		 $result = $query->row_array();		
		return $result;	
	 
	 
 }
 function count_total_not_recived($sec_id)
 {
	  $ci = & get_instance();
	  $qry0=("select count(file_id) as total_not_recived_file FROM ft_".FILES." where `file_mark_section_id`='".$sec_id."' and `file_return` !='2' and (file_hardcopy_status = 'not')");;
	  $query = $ci->db->query($qry0);
		 $result = $query->row_array();		
		return $result;	
	 
	 
 } function count_not_closefile($sec_id)
 {
	  $ci = & get_instance();
	  $qry0="select count(file_id) as total_numb_of_dispetch FROM ft_".FILES." where `file_mark_section_id`='".$sec_id."' and file_hardcopy_status !='close' and file_return='2'";
	  $query = $ci->db->query($qry0);
		 $result = $query->row_array();		
		return $result;	
	 
	 
 } function count_Disposefile($sec_id)
 {
	  $ci = & get_instance();
	  $qry0="SELECT count(DISTINCT(files.file_id)) as total_numb_of_dispose FROM `ft_".FILES_MASTER."` as files inner join ft_file_dispatch as file_dispetch on file_dispetch.file_id= files.file_id and issection_despose=0 WHERE files.file_mark_section_id IN ($sec_id) AND (files.file_hardcopy_status = 'close') AND files.file_return = '2' ";
	  $query = $ci->db->query($qry0);
	  //echo $ci->db->last_query();
		 $result = $query->row_array();		
		return $result;	
	 
	 
 }
function  count_totalrecievd($sec_id){
	
		  $ci = & get_instance();
	  $qry0="select count(file_id) as total_sections_file FROM ft_".FILES." where `file_mark_section_id`='".$sec_id."' UNION all select count(file_id) as total_sections_file FROM ft_".FILES_MASTER." where `file_mark_section_id`='".$sec_id."'";
	  $query = $ci->db->query($qry0);
		 //echo $ci->db->last_query();
		 $result = $query->result();
		 
		 $total=0;
		 foreach($result as $all)
		 {
			$total = $all->total_sections_file + $total;
			 
		 }
		
		return $total;	
	
}