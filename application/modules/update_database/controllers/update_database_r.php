<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Update_database extends MX_Controller {

    public function index()
    {

        $query = $this->db->query("SELECT * FROM `ft_files` WHERE `file_received_emp_id` = 22 and `file_mark_section_id`='2' limit 10");
        $res_array =  $query->result_array();
        foreach($res_array as $res_array1){
            echo $res_array1['file_id'];
            $query = $this->db->query("INSERT INTO `db_ftms_live_20oct`.`ft_file_logs` (`flog_id`, `file_id`, `section_id`, `to_emp_id`, `from_emp_id`, `hardcopy_carry_empname`, `fvlm_id`, `file_head_id`, `file_headerpath`, `flog_remark`, `flog_other_remark`, `document_path`, `notesheet_file_path`, `notesheet_contents`, `flog_ip_address`, `flog_browser_id`, `flog_created_date`, `sublogin`) VALUES (NULL, '".$res_array1['file_id']."', '2', '22', '18', '', '0', '0', NULL, NULL, 'विभागीय आदेश दिनांक 21/10/2015  के द्वारा श्रीमती यमुना पेटकर को याचिका शाखा का अनुभाग अधिकारी के रूप में पदस्थ किया गया हैं |', NULL, '', '', '', '', CURRENT_TIMESTAMP, '')");
        }

       // $query = $this->db->query("INSERT INTO `db_ftms_live_20oct`.`ft_file_logs` (`flog_id`, `file_id`, `section_id`, `to_emp_id`, `from_emp_id`, `hardcopy_carry_empname`, `fvlm_id`, `file_head_id`, `file_headerpath`, `flog_remark`, `flog_other_remark`, `document_path`, `notesheet_file_path`, `notesheet_contents`, `flog_ip_address`, `flog_browser_id`, `flog_created_date`, `sublogin`) VALUES (NULL, '1645', '2', '22', '18', '', '0', '0', NULL, NULL, 'विभागीय आदेश दिनांक 21/10/2015  के द्वारा श्रीमती यमुना पेटकर को याचिका शाखा का अनुभाग अधिकारी के रूप में पदस्थ किया गया हैं |', NULL, '', '', '', '', CURRENT_TIMESTAMP, '')");

    }

}