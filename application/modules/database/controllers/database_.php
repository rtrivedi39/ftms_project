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

    public function index() {
		
       $query = $this->db->get('notarylist_list_final');
       $records = $query->result();
	   
	   foreach($records as $record){
			$notary_array = array(
					'name' =>  $record->col2,
					'first_appintment_date' =>  $record->col7,
					'renew_date' =>  $record->col8,
					'next_renew_date' =>  $record->col9,
					'mobile' =>  $record->col12,
				);
				
					$this->db->where('advocate_post_type',4);
					$this->db->where_not_in('scm_district_id' , array(200,201));
					$query_master = $this->db->get('ft_advocate_master');
					$records_masters = $query_master->result();
					$s = 1;
					foreach($records_masters as $records_master){
					
					 if($records_master->scm_name_hi == $notary_array['name'] )
					 {
							
						 	//echo "name ".$s .' '. $notary_array['name'];
							if(!empty($notary_array['first_appintment_date'])){
							echo $records_master->scm_id."====".$record->col1;
							$update_master_array['first_appointment_date'] = $notary_array['first_appintment_date'];
							}
							$update_master_array['contact_no'] = $notary_array['mobile'] ;
							
							$this->db->where('scm_name_hi',$records_master->scm_name_hi);
							$this->db->update('ft_advocate_master',$update_master_array);
							$result = $this->db->affected_rows(); 
					
							
							
									if(!empty($notary_array['renew_date'])){ 
										if(!empty($notary_array['next_renew_date']))
											{$valdate= $notary_array['next_renew_date'];}else{$valdate="0000-00-00" ;}
										$notary_services_array['posting_date'] = $notary_array['renew_date'];
										$notary_services_array['post_renew_date'] = $valdate;
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