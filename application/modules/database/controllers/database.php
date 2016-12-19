<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Database extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('cookie');
		$this->load->helper('advocate');
        $this->load->module('template');
        $this->load->model('advocates_model', 'advocate_model');
        $this->load->language('admin_user', 'hindi');
        $this->load->language('advocate', 'hindi');
        authorize();
    }
	
	public function chage_posting_date()
	{
		$this->db->select('scm_id,asr_scm_id,scm_name_en,scm_name_hi,scm_father_name_hi,scm_address_hi,scm_post_hi,first_appointment_date,posting_date,post_renew_date');
					$this->db->where('advocate_post_type',4);
					$district = '`scm_district_id` IS NULL';
					$this->db->where($district);
					$this->db->where('posting_date > post_renew_date');
				
					$this->db->from('ft_advocate_master');
					$this->db->join('ft_advocate_service_record','ft_advocate_service_record.asr_scm_id = ft_advocate_master.scm_id ');
					
					//	$this->db->order_by('district_name_en','asc');
					$query_master = $this->db->get();
					$records_masters = $query_master->result();
			//echo $this->db->last_query();die;
					foreach($records_masters as $record){
						echo "posting_date " .$post_renew_date = $record->post_renew_date;
						echo "post_renew_date " .$record->post_renew_date;
						echo "<br>";
						$update_service['posting_date'] = '0000-00-00' ;
						
						$update_service['post_renew_date'] = $record->posting_date;
						$this->db->where('asr_scm_id',$record->scm_id );
						$this->db->update('ft_advocate_service_record',$update_service);
						echo $this->db->last_query();
					}
	
	}
	public function change_date_format(){
		$this->db->where('col5 !=','अलीराजपुर');
		$this->db->where('col5 !=','अनूपपुर');
		$this->db->where('col5 !=','अशोकनगर');
		$this->db->where('col5 !=','अशोकनगर');
		$this->db->where('col8 !=','');
        $query = $this->db->get('ft_notarylist_list_final_3_monika');
		echo $this->db->last_query();
			echo "<br>";
	 //die;
       $records = $query->result();
	   foreach($records as $record){
		   
		   $posting = explode('-',$record->col9);
		 echo "old _date ".$record->col9;
		   echo " ".strlen($posting[2]);
		/*if(strlen($posting[2]) == 4 ){
			$newdate = $posting[2].'-'.$posting[1].'-'.$posting[0];
			$this->db->where('col8',$record->col8 );
			$update_date['col8'] = $newdate ;
			$this->db->update('ft_notarylist_list_final_3_monika',$update_date);
			echo $this->db->last_query();
		}*/
		   
		  // print_r( $posting );
		   
		   echo "<br>";
	   }
	}
    public function index_a() {
		$this->db->where('col5 !=','अलीराजपुर');
		$this->db->where('col5 !=','अनूपपुर');
		$this->db->where('col5 !=','अशोकनगर');
		$this->db->where('col1 !=',1);
       $query = $this->db->get('ft_notarylist_list_final_3_monika');
	 
	//echo $this->db->last_query();
		//echo "<br>";
 //die;
       $records = $query->result();
	  
	  // die;
	   foreach($records as $record){
		if(!empty(  $record->col7)){ 
			$first_appintment_date = $record->col7;
		}else{
			$first_appintment_date = '0000-00-00';
		}
		if(!empty(  $record->col8)){ 
			$renew_date = $record->col8;
		}else{
			$renew_date = '0000-00-00';
		}
		if(!empty(  $record->col9)){ 
			$next_renew_date = $record->col9;
		}else{
			$next_renew_date = '0000-00-00';
		}
			$notary_array = array(
					'name' =>  $record->col2,
					'first_appintment_date' =>  $first_appintment_date,
					'renew_date' =>  $renew_date,
					'next_renew_date' =>  $next_renew_date,
					'mobile' =>  $record->col12,
				);
				//echo "renew date ".$notary_array['renew_date'];
		   			$this->db->select('scm_id,asr_scm_id,scm_name_en,scm_name_hi,scm_father_name_hi,scm_address_hi,scm_post_hi,first_appointment_date,posting_date,post_renew_date,district_name_en');
					$this->db->where('advocate_post_type',4);
				
					$this->db->where_not_in('scm_district_id' , array(200,201));
					$this->db->from('ft_advocate_master');
					$this->db->join('ft_advocate_service_record','ft_advocate_service_record.asr_scm_id = ft_advocate_master.scm_id ');
					$this->db->join('ft_district_master','ft_district_master.district_id = ft_advocate_master.scm_district_id ','left');
					//	$this->db->order_by('district_name_en','asc');
					$query_master = $this->db->get();
				
				//	echo $this->db->last_query();die;
		   			//echo "<br>";
					$records_masters = $query_master->result();
					$s = 1;
					//die;
					foreach($records_masters as $records_master){
					
					 if($records_master->scm_name_hi == $notary_array['name'] )
					 {
							/* echo "aaaa";
						 	echo "name ".$s .' '. $notary_array['name'] .' '.$records_master->scm_id ;
						  echo "<br>";
						*/
							 /*if(!empty($notary_array['first_appintment_date'])){
							echo $records_master->scm_id."====".$record->col1;
								
							$update_master_array['first_appointment_date'] = $notary_array['first_appintment_date'];
							}
							$update_master_array['contact_no'] = $notary_array['mobile'] ;
							
							
							$this->db->where('scm_name_hi',$records_master->scm_name_hi);
							$this->db->update('ft_advocate_master',$update_master_array);
							//$result = $this->db->affected_rows(); 
						 */	
							echo $records_master->scm_id."====".$record->col1;
						   if($notary_array['renew_date']){
							$notary_array['renew_date'];
							$notary_services_array['posting_date'] = $notary_array['renew_date'];
							
						 }
						if($notary_array['next_renew_date']){
							$notary_services_array['post_renew_date'] = $notary_array['next_renew_date'];
						 } 
						 
						 $this->db->where('asr_scm_id',$records_master->scm_id);
						 $this->db->update('ft_advocate_service_record',$notary_services_array);
						
						 echo $this->db->last_query();
									
								
										
									
								 echo "<br/>";
								
						
					 }
					 $s++;
				}
				
					
			}
	
	   
	 
    }
	
}