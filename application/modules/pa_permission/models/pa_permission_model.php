<?php
class Pa_permission_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function manage_pa_permision()
    {
        $data_send = $this->input->post();
        if ($this->input->post('pa_id')=='') {
            foreach ($data_send as $ky => $module) {
                if (is_array($module)) {
                    $module['emp_id_assign_to'] = $this->input->post('emp_id');
                    $module['emp_id_assign_by'] = $this->session->userdata('emp_id');
                    //pr($module);
                    $res[] = insertData($module, EMPLOYEE_PERMISSION_ALLOTED);
                }
            }

        } else {
            foreach ($data_send as $ky => $module) {
                if (is_array($module)) {
                    $module['emp_id_assign_to'] = $this->input->post('emp_id');
                    $module['emp_id_assign_by'] = $this->session->userdata('emp_id');
                    $is_exit = get_list(EMPLOYEE_PERMISSION_ALLOTED,null,array('emp_id_assign_by'=>$this->session->userdata('emp_id'),'emp_id_assign_to'=>$this->input->post('emp_id'),'epa_module_name'=>trim($module['epa_module_name'])));
                    //pr($is_exit);
                    if(count($is_exit)>0){
                        foreach($is_exit as $delval){
                            delete_data(EMPLOYEE_PERMISSION_ALLOTED,array('emp_id_assign_by'=>$delval['emp_id_assign_by'],'emp_id_assign_to'=>$delval['emp_id_assign_to'],'epa_module_name'=>trim($delval['epa_module_name'])));
                        }
                        $module['emp_id_assign_to'] = $this->input->post('emp_id');
                        $module['emp_id_assign_by'] = $this->session->userdata('emp_id');
                        $res[] = insertData($module, EMPLOYEE_PERMISSION_ALLOTED);
                    } else{
                            $module['emp_id_assign_to'] = $this->input->post('emp_id');
                            $module['emp_id_assign_by'] = $this->session->userdata('emp_id');
                            $res[] = insertData($module, EMPLOYEE_PERMISSION_ALLOTED);
                    }
                }
            }

        }
        return $res;
    }
	
	public function manage_da_permision()
    {
        $data_send = $this->input->post();
		//pr($data_send);
		if($this->input->post('epa_type')=='section_wise'){
			$epa_type='sec';
		}else if($this->input->post('epa_type')=='designation_wise'){
			$epa_type='desig';
		}else{
			$epa_type='pa';
		}
		
        if ($this->input->post('pa_id')=='') {
            foreach ($data_send as $ky => $module) {
                if (is_array($module)) {
                    //pr($this->input->post());
					$module['epa_type'] =$epa_type;
					$module['emp_id_assign_by'] =$this->input->post('emp_id_assign_by');
					$module['emp_id_assign_to'] =$this->input->post('emp_id_assign_to');
					$module['epa_designation_id'] =$this->input->post('epa_designation_id')==''?0:$this->input->post('epa_designation_id');
					$module['epa_section_id'] =$this->input->post('epa_section_id');
					$module['epa_permission_from'] =date('Y-m-d',strtotime($this->input->post('epa_permission_from')));
					$module['epa_permission_to'] =date('Y-m-d',strtotime($this->input->post('epa_permission_to')));
                    $module['epa_session_empid'] = $this->session->userdata('emp_id');
                    //pr($module);
                    $res[] = insertData($module, EMPLOYEE_PERMISSION_ALLOTED);
                }
            }

        } else {
            foreach ($data_send as $ky => $module) {
                if (is_array($module)) {
                    $module['emp_id_assign_to'] = $this->input->post('emp_id');
                    $module['emp_id_assign_by'] = $this->session->userdata('emp_id');
                    $is_exit = get_list(EMPLOYEE_PERMISSION_ALLOTED,null,array('emp_id_assign_by'=>$this->session->userdata('emp_id'),'emp_id_assign_to'=>$this->input->post('emp_id'),'epa_module_name'=>trim($module['epa_module_name'])));
                    //pr($is_exit);
                    if(count($is_exit)>0){
                        foreach($is_exit as $delval){
                            delete_data(EMPLOYEE_PERMISSION_ALLOTED,array('emp_id_assign_by'=>$delval['emp_id_assign_by'],'emp_id_assign_to'=>$delval['emp_id_assign_to'],'epa_module_name'=>trim($delval['epa_module_name'])));
                        }
                        $module['emp_id_assign_to'] = $this->input->post('emp_id');
                        $module['emp_id_assign_by'] = $this->session->userdata('emp_id');
                        $res[] = insertData($module, EMPLOYEE_PERMISSION_ALLOTED);
                    } else{
                            $module['emp_id_assign_to'] = $this->input->post('emp_id');
                            $module['emp_id_assign_by'] = $this->session->userdata('emp_id');
                            $res[] = insertData($module, EMPLOYEE_PERMISSION_ALLOTED);
                    }
                }
            }

        }
        return $res;
    }
}