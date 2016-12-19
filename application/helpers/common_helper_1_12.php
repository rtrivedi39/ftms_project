<?php
	
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * @ Function Name      : pr
 * @ Function Params    : $data {mixed}, $kill {boolean}
 * @ Function Purpose   : formatted display of value of varaible
 * @ Function Returns   : foramtted string
 */
function no_cache() {
    header('Cache-Control: no-store, no-cache, must-revalidate');
    header('Cache-Control: post-check=0, pre-check=0', false);
    header('Pragma: no-cache');
}

function pr($data, $kill = true) {
    $str = "";
    if ($data != '') {
        $str .= str_repeat("=", 25) . " " . ucfirst(gettype($data)) . " " . str_repeat("=", 25);
        $str .= "<pre>";
        if (is_array($data)) {
            $str .= print_r($data, true);
        }
        if (is_object($data)) {
            $str .= print_r($data, true);
        }
        if (is_string($data)) {
            $str .= print_r($data, true);
        }
        $str .= "</pre>";
    } else {
        $str .= str_repeat("=", 22) . " Empty Data " . str_repeat("=", 22);
    }

    if ($kill) {
        die($str .= str_repeat("=", 55));
    }
    echo $str;
}

function pre($data, $kill = true) {
    $str = "";
    if ($data != '') {
        $str .= str_repeat("=", 25) . " " . ucfirst(gettype($data)) . " " . str_repeat("=", 25);
        $str .= "<pre>";
        if (is_array($data)) {
            $str .= print_r($data, true);
        }
        if (is_object($data)) {
            $str .= print_r($data, true);
        }
        if (is_string($data)) {
            $str .= print_r($data, true);
        }
        $str .= "</pre>";
    } else {
        $str .= str_repeat("=", 22) . " Empty Data " . str_repeat("=", 22);
    }

    if ($kill) {
        echo $str .= str_repeat("=", 55);
    } else {
        echo $str;
    }
}

/**
 *
 * @param type $filename
 * @return type 
 */
if (!function_exists('current_file_name')) {

    function current_file_name($filename = '') {
        return basename(str_replace('\\', '/', $filename), ".php");

        // $ext = pathinfo($filename, PATHINFO_EXTENSION);
        // $path = preg_replace('/\.' . preg_quote($ext, '/') . '$/', '', $filename);
        // $array = explode('\\', $path);
        // $len = count($array) - 1;
        // return $array[$len];
    }

}

/**
 *
 * @param type $filename
 * @return type 
 */
if (!function_exists('current_file_dir')) {

    function current_file_dir($filename = '') {
        return basename(dirname(str_replace('\\', '/', $filename))) . '/';

        // $ext = pathinfo($filename, PATHINFO_EXTENSION);
        // $path = preg_replace('/\.' . preg_quote($ext, '/') . '$/', '', $filename);
        // $array = explode('\\', $path);
        // $len = count($array) - 2;
        // if ($array[$len] != 'view') {
        // return $array[$len] . '/';
        // }
        // return;
    }

}

if (!function_exists('objectToArray')) {

    function objectToArray($obj) {
        print_r($obj);
        echo is_object($obj);
        if (is_object($obj)) {
            // Gets the properties of the given object
            // with get_object_vars function
            $obj = get_object_vars($obj);
        }
    }

}

function all_month() {
    return $all_month = array('01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr', '05' => 'May', '06' => 'Jun', '07' => 'Jul', '08' => 'Aug', '09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec');
}

function is_date($str) {
    try {
        $dt = new DateTime(trim($str));
    } catch (Exception $e) {
        return false;
    }
    $month = $dt->format('m');
    $day = $dt->format('d');
    $year = $dt->format('Y');
    if (checkdate($month, $day, $year)) {
        return true;
    } else {
        return false;
    }
}

function str_rand($length = 8, $seeds = 'alphanum') {
    // Possible seeds
    $seedings['alpha'] = 'abcdefghijklmnopqrstuvwqyz';
    $seedings['numeric'] = '0123456789';
    $seedings['alphanum'] = 'abcdefghijklmnopqrstuvwqyz0123456789';
    $seedings['hexidec'] = '0123456789abcdef';

    // Choose seed
    if (isset($seedings[$seeds])) {
        $seeds = $seedings[$seeds];
    }

    // Seed generator
    list($usec, $sec) = explode(' ', microtime());
    $seed = (float) $sec + ((float) $usec * 100000);
    mt_srand($seed);

    // Generate
    $str = '';
    $seeds_count = strlen($seeds);

    for ($i = 0; $length > $i; $i++) {
        $str .= $seeds{mt_rand(0, $seeds_count - 1)};
    }

    return strtoupper($str);
}

/**
 * Method to authorise exess
 */
function authorize() {
    $ci = & get_instance();
    //pre($ci->session->all_userdata());
    $id = $ci->session->userdata("emp_id");
    if ($id == "") {
        $ci->session->set_flashdata("inner_message", "<div class='alert alert-info'>Please login first to access internal pages.</div>");
        redirect("/");
	}
}

function isAdminAuthorize() {
    $ci = & get_instance();
    $id = $ci->session->userdata("admin_logged_in");
    if ($id == "") {
        $ci->session->set_flashdata("message", '<div class="alert alert-danger alert-dismissable"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button><strong>' . $ci->lang->line('input_warning_label') . '</strong><br><p>' . $ci->lang->line('without_login_message') . '</p></div>');
        redirect("/");
    }
}

function checkusremail($str, $role) {
    $ci = & get_instance();
    $result = $ci->db->get_where(EMPLOYEES, array('emp_email' => $str, 'emp_status' => 1, 'role_id' => $role));
    return $result->row_array();
}

function check_userlogin_password($loginname, $pwd, $role) {
    $ci = & get_instance();
    $result = $ci->db->get_where(EMPLOYEES, array('emp_login_id' => $loginname, 'emp_password' => md5($pwd), 'emp_status' => 1, 'role_id' => $role));
    $rows = $result->row_array();
    return $rows;
}

/* Update all user Password */

function update_user_password($userid) {
    $ci = & get_instance();
    $result = $ci->db->get_where(EMPLOYEES, array('emp_login_id' => $loginname, 'emp_password' => md5($pwd), 'emp_status' => 1, 'role_id' => $role));
    $rows = $result->row_array();
    return $rows;
}

//update the any data with common function    
function updateData($table_name, $table_data, $condition) {
    $CI = & get_instance();
    $CI->db->where($condition);
    $check = $CI->db->update($table_name, $table_data);
    return $check;
}

function insertData($tableData, $tableName) {
    $CI = & get_instance();
    $row = $CI->db->insert($tableName, $tableData);
    return $row;
	}

function insertData_with_lastid($tableData, $tableName) {
    $CI = & get_instance();
    $row = $CI->db->insert($tableName, $tableData);
    return $CI->db->insert_id();
}

/**
 * @ Function Name      : get_list
 * @ Function Params    : $data {mixed}, $kill {boolean}
 * @ Function Purpose   : formatted display of value of varaible
 * @ Function Returns   : foramtted string
 */
function get_list($table_name, $orderby ='', $condition ='', $order_by = 'DESC' ) {
    $CI = & get_instance();
    if (!empty($condition)) {
        $CI->db->where($condition);
    }
    if (!empty($orderby)) {
        $CI->db->order_by($orderby, $order_by);
    }
    $CI->db->from($table_name);
    $query = $CI->db->get();
    $data = $query->result_array();
    return $data;
}
function get_list_with_in($table_name, $orderby,$column,$dataarray, $order_by = 'DESC') {
	$CI = & get_instance();
	$CI->db->where_in($column,$dataarray);
    if (!empty($orderby)) {
        $CI->db->order_by($orderby,$order_by);
    }
    $CI->db->from($table_name);
    $query = $CI->db->get();
	///echo $CI->db->last_query();
    $data = $query->result_array();
    return $data;
}
function get_list_orderwise($table_name, $orderby, $condition,$whr_condition=null) {
    $CI = & get_instance();
	if($whr_condition!=''){
		$where_condition=$whr_condition;
		}else{ $where_condition='where';}
    if (!empty($condition)) {
		$CI->db->$where_condition($condition);
    }
    if(!empty($orderby) && is_array($orderby)) {
		$CI->db->order_by($orderby['col'], $orderby['order']);
	}else if(!empty($orderby)) {
        $CI->db->order_by($orderby, 'DESC');
    }
    $CI->db->from($table_name);
    $query = $CI->db->get();
    $data = $query->result_array();
	//echo $CI->db->last_query();
    return $data;
}

function get_list_with_column($table_name,$column_name,$orderby, $condition) {
    $CI = & get_instance();
	if(!empty($column_name)){
		$CI->db->select($column_name);
	}
    if (!empty($condition)) {
        $CI->db->where($condition);
    }
    if(!empty($orderby)) {
        $CI->db->order_by($orderby, 'DESC');
    }
    $CI->db->from($table_name);
    $query = $CI->db->get();
    $data = $query->row_array();
    return $data;
}
function get_row($sql){
	$CI = & get_instance();
	return $CI->db->query($sql)->row_array();
}
function get_rows($sql){
	$CI = & get_instance();
	return $CI->db->query($sql)->result_array();
}
function delete_data($table_name, $condition) {
    $CI = &get_instance();
    $CI->db->where($condition);
    $res = $CI->db->delete($table_name);
    return $res;
}

function get_total_numbers_of($task, $id, $others) {
    $CI = &get_instance();
    if ($task == 'employee' && $id == '') {
        $employees_list_array = get_list(EMPLOYEES, null, array('emp_is_retired' => 0, 'emp_status' => 1));
        if ($others == 'counter') {
            return count($employees_list_array);
        } else {
            return $employees_list_array;
        }
    } else if ($task == 'files' && $id == '') {
        $file_list_array = get_list(FILES, null, null);
        if ($others == 'counter') {
            return count($file_list_array);
        } else {
            return $file_list_array;
			}
    }
}
function gender_array() {
     return array('m' => 'पुरुष', 'f' => 'महिला');
}

function yesno_array() {
     return $array = array('1' => 'हाँ', '0' => 'नहीं');
}

function marital_status_array() {
    return $array = array('1' => 'अविवाहित', '2' => 'विवाहित');
}

/* End */

/* End */

// upload image 
function uploadFile() {
    $CI = & get_instance();
    $config = array(
        'upload_path' => './uploads/employee/',
        'allowed_types' => 'gif|jpg|png',
        // 'max_size'      => '100',
        //'max_width'     => '1024',
        //'max_height'    => '768',
        'encrypt_name' => true,
    );

    $CI->load->library('upload', $config);

    if (!$CI->upload->do_upload()) {
        $error = array('error' => $CI->upload->display_errors());
        // $CI->load->view('upload_form', $error);
    } else {
        $upload_data = $CI->upload->data();
        $data_ary = array(
            'title' => $upload_data['client_name'],
            'file' => $upload_data['file_name'],
            'width' => $upload_data['image_width'],
            'height' => $upload_data['image_height'],
            'type' => $upload_data['image_type'],
            'size' => $upload_data['file_size'],
            'date' => time(),
        );
        return $upload_data['file_name'];
    }
}

function checkUserrole() {
    $CI = & get_instance();
    return $CI->session->userdata('user_role');
}

function checkUserdesignation($loginempid=null) {
    $CI = & get_instance();
	if($loginempid!=null){
		$CI->db->where('emp_id', $loginempid);
	}else{
		$CI->db->where('emp_id', emp_session_id());
	}
    $query = $CI->db->get(EMPLOYEES);
    $row1 = $query->row();
    return $row1->designation_id;
}

function checkUserrole_by_id($id , $get_role = false) {
    $CI = & get_instance();
    $CI->db->where('emp_id',$id);
    $query = $CI->db->get(EMPLOYEES);
    $row = $query->row();
    if($get_role == true){
        return isset($row->role_id) ? $row->role_id : '';
    }else{
        return isset($row->designation_id) ? $row->designation_id : '';
    }
}

function getEmployeeSection($id = null) {
    $CI = & get_instance();
	if($id == null){
		$CI->db->where('emp_id', $CI->session->userdata('emp_id'));
	} else{
		$CI->db->where('emp_id', $id);
	}
    $CI->db->where('emp_is_retired', '0');
    $CI->db->where('emp_status', '1');
    $query = $CI->db->get(EMPLOYEES);
    $row = $query->row();
    return isset($row->emp_section_id) ? $row->emp_section_id : '';
}

function file_types() {
     $file_types = array(
        'f' => 'File , नस्ती',
        'l' => 'Letter , पत्र',
        'a' => 'Appeal , अपील',
        'r' => 'Registry post , रजिस्ट्री डाक',
        'n' => 'Notice , नोटिस',
		's' => 'समंस',
		'pr' => 'प्रस्ताव',
		'av' => 'अभ्यावेदन',
		'gf' => 'गिरफ्तारी',
		'vr' => 'वारंट',
		'w' => 'Writ',
        'bl'  => 'विधेयक (bill)',
		
        'od' => 'अध्यादेश (ordinance)',
        'ms' => 'Miscellaneous',
		'fa' => 'First Appeal',
		'bill'=> 'सेवा / क्रय बिल',
	//	'app'=> 'आवेदन',    // comment bcose it will not show cr file type list .. only add by user applications
		'o' => 'Other , अन्य',
    );
    return $file_types;
}

function file_from_types() {
    $file_from_types = array(
        'Sec(Law)',
        'CM Office',
        'CS Office',
        'Directly' ,
    );
    return $file_from_types;
}

function getNoticeBoardInformation($setion_id = '') {
    
	$CI = & get_instance();
	$notice_board = NOTICE_BOARD;
    $role = checkUserrole();
    $CI->db->select('notice_id,notice_subject,notice_description,notice_attachment,notice_remark,notice_created_date,notice_from_date,notice_to_date,notice_is_active');
    
    if ($role != 1) {
        $CI->db->where('emp_id', emp_session_id());
        $CI->db->or_where('notice_section_id', $setion_id);
    }
    $CI->db->from($notice_board);
    $query = $CI->db->get();
    $rows = $query->result();
    return $rows;
}

function getNoticeBoardInformation_from_est($setion_id='',$empid=151) {
    
	$CI = & get_instance();
	$notice_board = NOTICE_BOARD;
    $role = checkUserrole();
    $CI->db->select('notice_id,notice_subject,notice_description,notice_attachment,notice_remark,notice_created_date,notice_from_date,notice_to_date,notice_is_active');
    
    if($setion_id!= '') {
        $CI->db->where('emp_id', emp_session_id());
        $CI->db->or_where('notice_section_id', $setion_id);
	}else if($empid!=''){
		$CI->db->where(array('emp_id'=>$empid,'notice_is_active'=>1,'notice_trash'=>0));
	}
    $CI->db->from($notice_board);
	$CI->db->order_by('notice_id','desc');
    $query = $CI->db->get();
    $rows = $query->result_array();
    return $rows;
}


function getState($state_id) {
    $CI = & get_instance();
    $CI->db->select('state_name_hi');
    if($state_id){
         $CI->db->where('state_id',$state_id);
    }
    $CI->db->from(STATES);
	$CI->db->order_by('state_name_hi', 'ASC');
    $query = $CI->db->get();
    $row = $query->row();
    return $row->state_name_hi;
}

function getCity($city_id) {
    $CI = & get_instance();
    $CI->db->select('city_name');
    $CI->db->from(CITY);
    if($city_id){
         $CI->db->where('city_id',$city_id);
    }
	$CI->db->order_by('state_name_hi', 'ASC');
    $query = $CI->db->get();
    $row = $query->row();
    return $row->city_name;
}

function checkEmployeeRetired($value) {
    if ($value == 0) {
        return "NO";
    } else {
        return "YES";
    }
}

function getSection($sectionid = null,$isshort = false ,$lang = null) {
    $CI = & get_instance();
    $CI->db->select('section_id,section_name_hi,section_name_en,section_short_name,section_code');
    $CI->db->where('section_id', $sectionid);
    $CI->db->from(SECTIONS);
    $query = $CI->db->get();
    $row = $query->row();
    // echo $CI->db->last_query();
    if($isshort == true){
       return  $row->section_short_name;
    }
     else if (!empty($lang) && $lang != '') {
        return $row->section_name_hi;
    }
    else if (!empty($row) && $row != '') {
        return $row->section_name_hi." (".$row->section_name_en.")";
    } else {
        return null;
    }
}

function getSectionData($sectionid) {	
    $CI = & get_instance();
    $CI->db->select('section_id,section_name_hi,section_name_en');
	if(is_array($sectionid)){
		$CI->db->where_in('section_id', $sectionid);
	} else {		
		$CI->db->where('section_id', $sectionid);
	}
    $CI->db->from(SECTIONS);
    $query = $CI->db->get();
    $row = $query->result();
   // return $row->section_name_hi." (".$row->section_name_en.")";
    return $row;

}
function getFileType($value) {
    if($value == 'l'){
        return '<span data-toggle="tooltip" data-original-title="Letter">पत्र</span>';
    }
    else if($value == 'f'){
        return '<span data-toggle="tooltip" data-original-title="File">नस्ती</span>';
    }
    else if($value == 'a'){
        return '<span data-toggle="tooltip" data-original-title="Appeal">अपील</span>';
    }
    else if($value == 'r'){
        return '<span data-toggle="tooltip" data-original-title="Registry post">रजिस्ट्री</span>';
    }
    else if($value == 'n'){
        return '<span data-toggle="tooltip" data-original-title="Notice">नोटिस</span>';
    }else if($value == 'bl'){
        return '<span data-toggle="tooltip" data-original-title="Notice">विधेयक</span>';
    }else if($value == 'od'){
        return '<span data-toggle="tooltip" data-original-title="Notice">अध्यादेश</span>';
    }else if($value == 'ms'){
        return '<span data-toggle="tooltip" data-original-title="Notice">Miscellaneous</span>';
    }else if($value == 'app'){
        return '<span data-toggle="tooltip" data-original-title="Notice">आवेदन</span>';
    }else {
        return '<span data-toggle="tooltip" data-original-title="Other">अन्य</span>';
    }
}

function getemployeeName($emp_id, $ishindi = false, $isgender = true) {
    $CI = & get_instance();
    $CI->db->select('emp_full_name, emp_full_name_hi');
    $CI->db->from(EMPLOYEES);
    $CI->db->where('emp_id', $emp_id);
    $query = $CI->db->get();
    $row = $query->row();
    if($isgender == false){
        if($ishindi == true){
            return $row->emp_full_name_hi;
        } else {
            return $row->emp_full_name;
        }
    }else{
        if($ishindi == true){
            return get_employee_gender($emp_id).' '.$row->emp_full_name_hi;
        } else {
            return get_employee_gender($emp_id, false).' '.$row->emp_full_name;
        }
    }


}

function old_note_use_get_employee_gender($emp_id, $ishindi = true) {   
		$CI = & get_instance();
		$CI->db->select('emp_detail_gender');
		$CI->db->where('emp_id',$emp_id );
		$CI->db->from(EMPLOYEE_DETAILS);
		$query = $CI->db->get();
		$row = $query->row();   
		// echo $CI->db->last_query();
		$gender =  $row->emp_detail_gender;
		if($gender == 'm'){
			if($ishindi == true){
				return 'श्री';	
			}else {
				return 'Sh.';
			}				
		}
		if($gender == 'f'){
			if($ishindi == true){
				return 'सुश्री';		
			}else {
				return 'Sushri';
			}
					
		} else {
			return '';	
		}
    
}

function get_employee_gender($emp_id, $ishindi = true, $isquery = true) {   
		if($isquery == true){
			$CI = & get_instance();
			$CI->db->select('emp_detail_gender');
			$CI->db->where('emp_id',$emp_id );
			$CI->db->from(EMPLOYEE_DETAILS);
			$query = $CI->db->get();
			$row = $query->row();   
			// echo $CI->db->last_query();
			$gender =  $row->emp_detail_gender;
		} else {
			$gender = $emp_id;
		}
		if($gender == 'm'){
			if($ishindi == true){
				return 'श्री';	
			}else {
				return 'Sh.';

			}
		}
		if($gender == 'f'){
			if($ishindi == true){
				return 'सुश्री';
			}else {
				return 'Sushri';
			}

		} else {
			return '';
		}
    
}

function getDepartmentName($department_id, $is_hindi = false) {
    $CI = & get_instance();
    $CI->db->select('dept_name_hi,dept_name_en');
    $CI->db->from(DEPARTMENTS);
    $CI->db->where('dept_id', $department_id);
    $query = $CI->db->get();
    //echo $CI->db->last_query();
    $row = $query->row();
    if($is_hindi == false){
        return  $row->dept_name_en;
    } else {
        return  $row->dept_name_hi;
    }
   
}

function getDepartments() {
    $CI = & get_instance();
    $CI->db->select('*');
    $CI->db->from(DEPARTMENTS);
	$CI->db->order_by('department_default_no', 'ASC');
    $query = $CI->db->get();
    //echo $CI->db->last_query();
    $rows = $query->result();
	return $rows;

}

function fileLock($value) {
    if ($value == 0) {
        echo "<i class='fa fa-unlock' ></i>";
    } else {
        echo "<i class='fa fa-lock' ></i>";
    }
}

// upload image
function uploadalltypeFile($filename, $path) {
    $CI = & get_instance();
    $config = array(
        'upload_path' => $path,
        'allowed_types' => 'gif|jpg|png|pdf',
        // 'max_size'      => '100',
        //'max_width'     => '1024',
        //'max_height'    => '768',
        'encrypt_name' => true,
    );
 if(!is_dir($path)) //create the folder if it's not already exists
    {
        mkdir($path,0777,TRUE);
    }
    $CI->load->library('upload', $config);

    if (!$CI->upload->do_upload($filename)) {
        $error = array('error' => $CI->upload->display_errors());
        // $CI->load->view('upload_form', $error);
    } else {
        $upload_data = $CI->upload->data();
        $data_ary = array(
            'title' => $upload_data['client_name'],
            'file' => $filename,
            'width' => $upload_data['image_width'],
            'height' => $upload_data['image_height'],
            'type' => $upload_data['image_type'],
            'size' => $upload_data['file_size'],
            'date' => time(),
        );
        return $upload_data['file_name'];
    }
}

function get_department_post_master($roleid) {
    $CI = & get_instance();
    $CI->db->from(EMPLOYEE_MASTER_NUMBER_POST);
    if ($roleid == '') {
        $query = $CI->db->get();
        return $row = $query->result_array();
    } else {
        $CI->db->where('role_id', $roleid);
        $query = $CI->db->get();
        $row = $query->row_array();
        if (!empty($row) && $row != '') {
            return @$row['endm_designation_numbers'];
        } else {
            return null;
        }
    }
}
function get_added_designation_of_emp($byroldid, $task = "") {
    $CI = & get_instance();
    $CI->db->from(EMPLOYEES);
    $CI->db->where('role_id', $byroldid);
    $CI->db->where('emp_posting_location',1);
    $CI->db->where('emp_status',1);
    $query = $CI->db->get();
    $rows = $query->result_array();
    return count($rows);
}
function get_employe_role_designatio($byroldid = '', $task = "") {
    $nerArray = '';
    $added_emp = 0;
    $CI = & get_instance();
    $CI->db->from(EMPLOYEEE_ROLE);
    $query = $CI->db->get();
    $emp_roles_array = $query->result_array();
    //pr($emp_roles_array);
    foreach ($emp_roles_array as $rolkey => $roles) {
        $added_emp = get_added_designation_of_emp($roles['role_id'], "");
        //echo '<br/>rolid:'.$roles['role_id'].'<br/>';
        $endm_designation_numbers = get_department_post_master($roles['role_id'], "");
        //echo $added_emp.'=='.$endm_designation_numbers.'<br/>';
        if (isset($endm_designation_numbers) && $endm_designation_numbers != '') {
            if ($added_emp == $endm_designation_numbers || $added_emp == 3) {
                $emp_roles_array[$rolkey] = '';
            }
        }
    }
    return $emp_roles_array;
}

/* Code added by Bij */
/* Show all alloted section according to employee and table wise. */

function get_alloted_sections_list($empid, $task) {
    $CI = & get_instance();
    $CI->db->select('emp_section_id');
    //echo $empid;
    $CI->db->where('emp_id', $empid);
    if ($task == 'EMPLOYEE_ALLOTED_SECTION_TBL') {
        $CI->db->from(EMPLOYEE_ALLOTED_SECTION);
        $query = $CI->db->get();
        return $rows = $query->result_array();
    } else {
        $CI->db->from(EMPLOYEES);
        $query = $CI->db->get();
        return $rows = $query->row_array();
    }
}

function get_supervisor_list($id, $task = '') {
    $ci = & get_instance();
    if ($task == '' && $id != '') {
        $role_level_aray = $ci->db->query("SELECT emprole_level,role_id FROM ft_" . EMPLOYEEE_ROLE . " where role_id=" . $id)->row_array();
        // $ci->db->last_query();
        //pr($role_level_aray);
        $emp_level_id = $role_level_aray['emprole_level'];
        $supervisor_role_id = ($role_level_aray['role_id']);
        /* Get limit value */
        if ($supervisor_role_id == 11 || $supervisor_role_id == 14 || $supervisor_role_id == 15 || $supervisor_role_id == 8)  { /* Sr. Accountan officer */
            $designation_limit = 50;
            $emp_level_id = 11;
            $where_or = ' and emprolmast.emprole_level !=6';
        } else if ($supervisor_role_id == 9 || $supervisor_role_id == 22 || $supervisor_role_id == 23 || $supervisor_role_id == 24 || $supervisor_role_id == 17 || $supervisor_role_id == 19 || $supervisor_role_id == 20) { /* Grad-I,II,III,Data Entry oprator and CR */
            $emp_level_id = 6;
            $designation_limit = 20;
            $where_or = '';
        } else if($supervisor_role_id == 21 ||$supervisor_role_id == 32 ){ /* For library  */
            $emp_level_id = 11;
            $designation_limit = 3;
            $where_or = '';
        } else if($supervisor_role_id == 12 ){ /* For staff officer  */
            $emp_level_id = 1;
            $designation_limit = 1;
            $where_or = '';
        } else if($supervisor_role_id == 13 || $supervisor_role_id == 25  || $supervisor_role_id == 18 || $supervisor_role_id == 37){ /* For  personal assistant and personal secretary, ACC  */
            $emp_level_id = 8;
            $designation_limit = 30;
            $where_or = '';
         } else if($supervisor_role_id == 28 ||$supervisor_role_id == 29 ||$supervisor_role_id == 30 ||$supervisor_role_id == 35 ||$supervisor_role_id == 36  ||$supervisor_role_id == 34 ){ /* For poen, daftari , driver, class IV  */
            $emp_level_id = 12;
            $designation_limit = 100;
            $where_or = '';
        } else {
            $sql_qry = "SELECT * FROM ft_" . EMPLOYEES . " where role_id = $supervisor_role_id";
            $designation_limit_aray = $ci->db->query($sql_qry)->result_array();
            $designation_limit = count($designation_limit_aray);
            $where_or = '';
        }
        if ($supervisor_role_id == 9 || $supervisor_role_id == 22 || $supervisor_role_id == 23 || $supervisor_role_id == 24 || $supervisor_role_id == 17 || $supervisor_role_id == 19 ||  $supervisor_role_id == 20) { //*Grad-I,II,III,Data Entry oprator and CR*/
            $sql = "SELECT emprolmast.emprole_name_hi, emprole_name_en,emp.emp_id, emp.role_id,emp.emp_full_name, emp.emp_email, emp.emp_section_id FROM `ft_emprole_master` as emprolmast inner join ft_employee as emp on emp.role_id=emprolmast.role_id $where_or where emprolmast.emprole_level !=0 and emprolmast.emprole_level<=$emp_level_id and emp_is_retired = 0 and emp_status = 1 order by emprolmast.role_id desc LIMIT 0,$designation_limit";
        } else if($supervisor_role_id == 21 ||$supervisor_role_id == 32){
            $sql = "SELECT emprolmast.emprole_name_hi, emprole_name_en,emp.emp_id, emp.role_id,emp.emp_full_name, emp.emp_email, emp.emp_section_id FROM `ft_emprole_master` as emprolmast inner join ft_employee as emp on emp.role_id=emprolmast.role_id $where_or where emprolmast.emprole_level !=0 and emprolmast.emprole_level=$emp_level_id and emp_is_retired = 0 and emp_status = 1 order by emprolmast.role_id desc LIMIT 0,$designation_limit";
        } else if($supervisor_role_id == 12){
            $sql = "SELECT emprolmast.emprole_name_hi, emprole_name_en,emp.emp_id, emp.role_id,emp.emp_full_name, emp.emp_email, emp.emp_section_id FROM `ft_emprole_master` as emprolmast inner join ft_employee as emp on emp.role_id=emprolmast.role_id $where_or where emprolmast.emprole_level !=0 and emprolmast.emprole_level='1' and emp_is_retired = 0 and emp_status = 1 order by emprolmast.role_id desc LIMIT 0,$designation_limit";
        } else {
           $sql = "SELECT emprolmast.emprole_name_hi, emprole_name_en,emp.emp_id, emp.role_id,emp.emp_full_name, emp.emp_email, emp.emp_section_id FROM `ft_emprole_master` as emprolmast inner join ft_employee as emp on emp.role_id=emprolmast.role_id $where_or where emprolmast.emprole_level !=0 and emprolmast.emprole_level<$emp_level_id and emp_is_retired = 0 and emp_status = 1 order by emprolmast.role_id desc LIMIT 0,$designation_limit";
        }
        return $ci->db->query($sql)->result_array();
    } else if ($task == 'get_supervisor_detail' && $id != '') {
        $role_level_aray = $ci->db->query("SELECT emprole_level,role_id FROM ft_" . EMPLOYEEE_ROLE . " where role_id=" . $id)->row_array();
        $emp_level_id = $role_level_aray['emprole_level'];
        $supervisor_role_id = ($role_level_aray['role_id']);
        /* Get limit value */
        if ($supervisor_role_id == 11 || $supervisor_role_id == 14 || $supervisor_role_id == 15 || $supervisor_role_id == 8) { /* Sr. Accountan officer */
            $designation_limit = 50;
            $emp_level_id = 11;
            $where_or = ' and emprolmast.emprole_level';
        } else if ($supervisor_role_id == 9 || $supervisor_role_id == 22 || $supervisor_role_id == 23 || $supervisor_role_id == 24 || $supervisor_role_id == 17 || $supervisor_role_id == 19  || $supervisor_role_id == 20) { /* Grad-I,II,III,Data Entry oprator and CR */
            $emp_level_id = 6;
            $designation_limit = 20;
            $where_or = '';
            //$where_or= ' and emprolmast.emprole_level <6';
        } else if($supervisor_role_id == 21 ||$supervisor_role_id == 32 ){ /* For library  */
            $emp_level_id = 11;
            $designation_limit = 3;
            $where_or = '';
        } else if($supervisor_role_id == 28 ||$supervisor_role_id == 29 ||$supervisor_role_id == 30 ||$supervisor_role_id == 35 ||$supervisor_role_id == 36 ||$supervisor_role_id == 34 ){ /* For poen, daftari , class IV  */
            $emp_level_id = 12;
            $designation_limit = 100;
            $where_or = '';
        } else if($supervisor_role_id == 12 ){ /* For staff officer  */
            $emp_level_id = 1;
            $designation_limit = 1;
            $where_or = '';
			} else if($supervisor_role_id == 13 || $supervisor_role_id == 25 || $supervisor_role_id == 18 || $supervisor_role_id == 37 ){ /* For  personal assistant and persnal secretary , ACC */
            $emp_level_id = 8;
            $designation_limit = 30;
            $where_or = '';
        } else if($supervisor_role_id == 10){ /* dfdsf, ACC */
           $emp_level_id = 8;
            $designation_limit = 30;
            $where_or = '';
        } else {
            $sql_qry = "SELECT * FROM ft_" . EMPLOYEES . " where role_id=$supervisor_role_id";
            $designation_limit_aray = $ci->db->query($sql_qry)->result_array();
            $designation_limit = count($designation_limit_aray);
            $where_or = '';
        }
        if ($supervisor_role_id == 9 || $supervisor_role_id == 22 || $supervisor_role_id == 23 || $supervisor_role_id == 24 || $supervisor_role_id == 17 || $supervisor_role_id == 19 ||  $supervisor_role_id == 20) { /* Grad-I,II,III,Data Entry oprator and CR */
            $sql_12 = "SELECT emprolmast.emprole_name_hi, emprole_name_en,emp.emp_id, emp.role_id,emp.emp_full_name, emp.emp_email, emp.emp_section_id FROM `ft_emprole_master` as emprolmast inner join ft_employee as emp on emp.role_id=emprolmast.role_id $where_or where emprolmast.emprole_level !=0 and emprolmast.emprole_level<=$emp_level_id and emp_is_retired = 0 and emp_status = 1 order by emprolmast.role_id desc LIMIT 0,$designation_limit";
        } else if($supervisor_role_id == 21 ||$supervisor_role_id == 32){
            $sql_12 = "SELECT emprolmast.emprole_name_hi, emprole_name_en,emp.emp_id, emp.role_id,emp.emp_full_name, emp.emp_email, emp.emp_section_id FROM `ft_emprole_master` as emprolmast inner join ft_employee as emp on emp.role_id=emprolmast.role_id $where_or where emprolmast.emprole_level !=0 and emprolmast.emprole_level=$emp_level_id and emp_is_retired = 0 and emp_status = 1 order by emprolmast.role_id desc LIMIT 0,$designation_limit";
         } else if($supervisor_role_id == 12){
            $sql_12 = "SELECT emprolmast.emprole_name_hi, emprole_name_en,emp.emp_id, emp.role_id,emp.emp_full_name, emp.emp_email, emp.emp_section_id FROM `ft_emprole_master` as emprolmast inner join ft_employee as emp on emp.role_id=emprolmast.role_id $where_or where emprolmast.emprole_level !=0 and emprolmast.emprole_level='1' and emp_is_retired = 0 and emp_status = 1 order by emprolmast.role_id desc LIMIT 0,$designation_limit";
        } else if($supervisor_role_id == 10){
            $sql_12 = "SELECT emprolmast.emprole_name_hi, emprole_name_en,emp.emp_id, emp.role_id,emp.emp_full_name, emp.emp_email, emp.emp_section_id FROM `ft_emprole_master` as emprolmast inner join ft_employee as emp on emp.role_id=emprolmast.role_id $where_or where emprolmast.emprole_level !=0 and emprolmast.emprole_level='20' and emp_is_retired = 0 and emp_status = 1 order by emprolmast.role_id desc LIMIT 0,$designation_limit";
        } else {
            $sql_12 = "SELECT emprolmast.emprole_name_hi, emprole_name_en,emp.emp_id, emp.role_id,emp.emp_full_name, emp.emp_email, emp.emp_section_id FROM `ft_emprole_master` as emprolmast inner join ft_employee as emp on emp.role_id=emprolmast.role_id $where_or where emprolmast.emprole_level !=0 and emprolmast.emprole_level<$emp_level_id and emp_is_retired = 0 and emp_status = 1 order by emprolmast.role_id desc LIMIT 0,$designation_limit";
        }
        return $ci->db->query($sql_12)->result_array();
    } else if ($task == 'get_supervisor_detail_byId' && $id != '') {
        $sql50 = "SELECT emp_id as supervisorId from ft_employee_hirarchi where under_emp_id=$id";
        $res_array = $ci->db->query($sql50)->result_array();
        foreach ($res_array as $skey => $sval) {
            $supervisor_array[] = $sval['supervisorId'];
        }
        return $supervisor_array;
    }
}

function manage_employee_leave($table_data_leave, $empid_condition, $task) {
    $ci = & get_instance();
    if ($empid_condition == '' && $task == 'add_leave') {
        insertData($table_data_leave, EMPLOYEE_LEAVE);
    } else if ($task == 'update_leave') {
        updateData(EMPLOYEE_LEAVE, $table_data_leave, $empid_condition);
    } else if ($task == 'emp_leave_detail') {
        $emp_leave_detail = get_list(EMPLOYEE_LEAVE, NULL, $empid_condition);
        if (count($emp_leave_detail) > 0) {
            return $emp_leave_detail[0];
        } else {
            return null;
        }
    }
}

/* End of Bij code */

//RP
// viwe file details
function getFiledata($file_id) {
    $CI = & get_instance();
    $tbl1 = FILES;
    $tbl2 = SECTIONS;
    $tbl3 = EMPLOYEES;
    $tbl4 = DEPARTMENTS;
    $tbl5 = DISTRICT;
    $tbl6 = REMARK_MASTER;
    $tbl7 = UNIT_LEVEL;
    $tbl8 = STATE_MASTER;
    $tbl9 = FILES_OTHER_FEILDS;
   $CI->db->select(FILES . '.*,section_name_hi,section_name_en,emp_full_name,emp_full_name_hi,dept_name_hi,dept_name_en,district_name_hi,district_name_en,remark_title_hi,unit_name_hindi,unit_name,state_name_en,state_name_hi,state_id,file_upload,case_no,rti_application_fee,hearing_date_rti,pay_serial_no_rti,applicant_name,rti_applicant_contactno');
    $CI->db->from($tbl1);
    $CI->db->join($tbl2, "$tbl2.section_id = $tbl1.file_mark_section_id", 'left');
    $CI->db->join($tbl3, "$tbl3.emp_id = $tbl1.file_received_emp_id", 'left');
    $CI->db->join($tbl4, "$tbl4.dept_id = $tbl1.file_department_id", 'left');
    $CI->db->join($tbl5, "$tbl5.district_id = $tbl1.file_district_id", 'left');
    $CI->db->join($tbl6, "$tbl6.remark_id = $tbl1.file_progress_status_id", 'left');
    $CI->db->join($tbl7, "$tbl7.unit_id = $tbl1.file_unit_level", 'left');
    $CI->db->join($tbl8, "$tbl8.state_id = $tbl1.file_state_id",'left');
    $CI->db->join($tbl9, "$tbl9.f_file_id = $tbl1.file_id",'left');
    $CI->db->where("$tbl1.file_id", $file_id);
	//$CI->db->order_by("$tbl1.file_id", 'DESC');
    $query = $CI->db->get();
    $CI->db->last_query();
    if ($query->num_rows() != 0) {
        return $query->result_array();
    } else {
    $tbl1 = FILES_MASTER;
    $tbl2 = SECTIONS;
    $tbl3 = EMPLOYEES;
    $tbl4 = DEPARTMENTS;
    $tbl5 = DISTRICT;
    $tbl6 = REMARK_MASTER;
    $tbl7 = UNIT_LEVEL;
    $tbl8 = STATE_MASTER;
    $tbl9 = FILES_OTHER_FEILDS;
   $CI->db->select(FILES_MASTER . '.*,section_name_hi,section_name_en,emp_full_name,emp_full_name_hi,dept_name_hi,dept_name_en,district_name_hi,district_name_en,remark_title_hi,unit_name_hindi,unit_name,state_name_en,state_name_hi,state_id,file_upload,case_no,rti_application_fee,hearing_date_rti,pay_serial_no_rti,applicant_name,rti_applicant_contactno');
    $CI->db->from($tbl1);
    $CI->db->join($tbl2, "$tbl2.section_id = $tbl1.file_mark_section_id", 'left');
    $CI->db->join($tbl3, "$tbl3.emp_id = $tbl1.file_received_emp_id", 'left');
    $CI->db->join($tbl4, "$tbl4.dept_id = $tbl1.file_department_id", 'left');
    $CI->db->join($tbl5, "$tbl5.district_id = $tbl1.file_district_id", 'left');
    $CI->db->join($tbl6, "$tbl6.remark_id = $tbl1.file_progress_status_id", 'left');
    $CI->db->join($tbl7, "$tbl7.unit_id = $tbl1.file_unit_level", 'left');
    $CI->db->join($tbl8, "$tbl8.state_id = $tbl1.file_state_id",'left');
    $CI->db->join($tbl9, "$tbl9.f_file_id = $tbl1.file_id",'left');
    $CI->db->where("$tbl1.file_id", $file_id);
	//$CI->db->order_by("$tbl1.file_id", 'DESC');
    $query = $CI->db->get();
    $CI->db->last_query();
    if ($query->num_rows() != 0) {
        return $query->result_array();
    } else {
        return FALSE;
    }
    } 
}

function getuserbyrole($sectionid, $roleid) {
    $CI = & get_instance();
    if(isset($sectionid) && isset($roleid)) {
        $where = "FIND_IN_SET('" . $sectionid . "', emp_section_id)";
        $CI->db->where($where);
    $CI->db->where('role_id', $roleid);
    $CI->db->from(EMPLOYEES);
    $query = $CI->db->get();
    $data = $query->result_array();
    return $data;
    }
}

function getmarkeduser($sectionid, $unitid) {
    $CI = & get_instance();
    if(isset($sectionid) && isset($unitid)) {
        $tbl1 = EMPLOYEES;
        $tbl2 = UNIT_LEVEL;
        $where = "FIND_IN_SET('" . $sectionid . "', emp_section_id)";
        $CI->db->where($where);
        // $CI->db->where('emp_section_id', $sectionid);
        $CI->db->where('unit_id', $unitid);
        $CI->db->from($tbl1);
        $CI->db->join($tbl2, "$tbl2.role_id = $tbl1.role_id");
        $query = $CI->db->get();
        //  echo $CI->db->last_query();
        $data = $query->row_array();
        return $data;
    }
}

function getmarkeduser_bydesignation($sectionid, $unitid, $designation) {
    $CI = & get_instance();
    if(isset($sectionid) && isset($unitid) && isset($designation)) {
        $tbl1 = EMPLOYEES;
        $tbl2 = UNIT_LEVEL;
        $where = "FIND_IN_SET('" . $sectionid . "', emp_section_id)";
        $CI->db->where($where);
        $CI->db->where('designation_id', $designation);
        $CI->db->where('unit_id', $unitid);
        $CI->db->from($tbl1);
        $CI->db->join($tbl2, "$tbl2.role_id = $tbl1.role_id");
        $query = $CI->db->get();
        //  echo $CI->db->last_query();
        $data = $query->row_array();
        return $data;
    }
}

function getfileStatus($file_id) {
    $CI = & get_instance();
    $CI->db->select('file_hardcopy_status,unit_name');
    $CI->db->where('file_id', $file_id);
    $CI->db->from(FILES);
    $CI->db->join(UNIT_LEVEL, FILES . ".file_unit_level = " . UNIT_LEVEL . ".unit_id", 'left');
    $query = $CI->db->get();
    // $CI->db->last_query();
    $data = $query->result_array();
    return $data;
}

// for display highcourt benchs RP
function highcourt_bench() {
     $file_highcourt = array(
        '1' => 'Jabalpur , जबलपुर',
        '2' => 'Gwalior bench, खण्डपीठ ग्वालियर',
        '3' => 'Indore bench, खण्डपीठ इंदौर',
		'4' => 'Other, अन्य',
    );
    return $file_highcourt;
}

function getusersection($userid) {
    $CI = & get_instance();
    $CI->db->select('emp_section_id');
    $CI->db->where('emp_id', $userid);
    $CI->db->from(EMPLOYEES);
    $query = $CI->db->get();
    $row = $query->row();
    return $row->emp_section_id;
}

/*function getFileDetails($file_id ,$array = false , $column = false) {
    $CI = & get_instance();
    
        if(isset($file_id) && $file_id != ''){
        if($column == false){
            $col = "*";
        }else{
            $col = "file_id,file_mark_section_id,file_created_date,file_mark_section_date,scan_id,final_draft_id,file_est_relation_id";
        }
        $query = $CI->db->query("SELECT * FROM (SELECT ".$col." FROM `ft_files` UNION SELECT ".$col." FROM `ft_files_master`) AS F  WHERE F.file_id = ".$file_id);
        if($array != false){
            return $query->result_array();
        }else{
            return $query->row();
        }
    }
    
    $tbl_files = FILES;
    if($column != false){
        $CI->db->select('file_id,file_mark_section_id,file_created_date,file_mark_section_date,scan_id,final_draft_id,file_est_relation_id');
    }
    $query = $CI->db->get_where($tbl_files, array('file_id' => $file_id));
    if($array != false){
        return $query->result_array();
    }else{
        return $query->row();
    }
}*/

function getFileDetails($file_id ,$array = false , $column = false) {
    $CI = & get_instance();
    $tbl_files = FILES;
    $tbl_files_master = FILES_MASTER;
    if($column != false){
        $CI->db->select('file_id,file_mark_section_id,file_created_date,file_mark_section_date,scan_id,final_draft_id,file_est_relation_id');
    }
    $query = $CI->db->get_where($tbl_files, array('file_id' => $file_id));
    if($query->num_rows() == 0){
		 $query = $CI->db->get_where($tbl_files_master, array('file_id' => $file_id));
	}
	if($array != false){
        return $query->result_array();
    }else{
        return $query->row();
	}
} 

function getFileDetails_closefile($file_id ,$array = false , $column = false) {
    $CI = & get_instance();
    $tbl_files = FILES_MASTER;
    if($column != false){
        $CI->db->select('file_id,file_mark_section_id,file_created_date,file_mark_section_date,scan_id,final_draft_id,file_est_relation_id');
    }
    $query = $CI->db->get_where($tbl_files, array('file_id' => $file_id));
    if($array != false){
        return $query->result_array();
    }else{
        return $query->row();
    }
}
/* Coded added bij 29/07/2015 */

function get_designation_level($empid = null, $roleid = null) {
    /* key refer by employee_role_master table */
    /* 60 means all of Asst. Grade I,II,III,Dataentry opratore etc. */
    /* 50 means */
    $employee_detail = get_list(EMPLOYEES, null, array('emp_id' => $empid));
    $designation_level = array('3' => '1', '4' => '2', '5' => '3', '6' => '4', '7' => '5', '11' => '5', '8' => '6', '14' => '6', '12' => '6', '33' => '6');
    if (array_key_exists($employee_detail[0]['role_id'], $designation_level)) {
        return $designation_level[$employee_detail[0]['role_id']];
    } else {
        return 60;
    }
}

function employee_grad_pay() {
     return array('y' => 'हाँ', 'n' => 'नहीं', 'rule' => 'सरकारी रूल्स के आधार पर');
}

/* RP */

function empdetails($emp_id) {
    $CI = & get_instance();
    $CI->db->select('emp_id,role_id,designation_id,emp_unique_id,emp_full_name,emp_full_name_hi,emp_email,emp_mobile_number,emp_section_id,emp_is_retired,emp_is_parmanent');
    $CI->db->where('emp_id', $emp_id);
    $CI->db->from(EMPLOYEES);
    $query = $CI->db->get();
    $data = $query->result_array();
    return $data;
}

function getunitid($roleid) {
    $CI = & get_instance();
    $CI->db->where('role_id', $roleid);
    $CI->db->from(UNIT_LEVEL);
    $query = $CI->db->get();
    $row = $query->row();
	return isset($row->unit_id)?$row->unit_id:'';
}

function getemployeeRole($role_id = null, $iseng = true) {
    $CI = & get_instance();
    if($role_id != null) {
		$CI->db->where('role_id', $role_id);
		$query = $CI->db->get(EMPLOYEEE_ROLE);
		$row = $query->row();
		 if($iseng == false){
			return $row->emprole_name_en;
		 } else {
			return $row->emprole_name_hi;			 
		 }
    }
}

function get_employee_role($emp_id, $id = false , $iseng = false) {
    $CI = & get_instance();
    $CI->db->where(EMPLOYEES.'.emp_id', $emp_id);
    $CI->db->join(EMPLOYEES, EMPLOYEES . ".role_id = " . EMPLOYEEE_ROLE . ".role_id");
    $CI->db->from(EMPLOYEEE_ROLE);
    $query =  $CI->db->get();
    $row = $query->row();
	if($id == true){
		return $row->role_id;
	} else {
        if($iseng == true){
            return $row->emprole_name_en;
        }else{
            return $row->emprole_name_hi;
        }
	}
}

function get_employee_designation($emp_id, $id = false , $iseng = false) {
    $CI = & get_instance();
    $CI->db->where(EMPLOYEES.'.emp_id', $emp_id);
    $CI->db->join(EMPLOYEES, EMPLOYEES . ".designation_id = " . EMPLOYEEE_ROLE . ".role_id");
    $CI->db->from(EMPLOYEEE_ROLE);
    $query =  $CI->db->get();
    $row = $query->row();
	if($id == true){
		return $row->designation_id;
	} else {
        if($iseng == true){
            return $row->emprole_name_en;
        }else{
            return $row->emprole_name_hi;
        }
	} 
}


function get_user_details($id = '', $column_name = '*') {
    $CI = & get_instance();
    $tbl_emp = EMPLOYEES;
    $tbl_emp_detail = EMPLOYEE_DETAILS;
    $tbl_emp_role = EMPLOYEEE_ROLE;
    $CI->db->select($column_name);
    $CI->db->from($tbl_emp);
    $CI->db->join($tbl_emp_detail, "$tbl_emp.emp_id = $tbl_emp_detail.emp_id");
    $CI->db->join($tbl_emp_role, "$tbl_emp.designation_id = $tbl_emp_role.role_id");
    $emp_id = $id == '' ? emp_session_id() : $id;
	
    $CI->db->where("$tbl_emp.emp_id", $emp_id);
    $query = $CI->db->get();
	
    if ($query->num_rows() == 1) {
        //print_r($query->result());die;
        return $query->result();
    } else {
        return FALSE;
    }
}
function get_user_details_with_name($id = '', $column_name) {
    $CI = & get_instance();
    $tbl_emp = EMPLOYEES;
    $tbl_emp_detail = EMPLOYEE_DETAILS;
    $tbl_emp_role = EMPLOYEEE_ROLE;
    $CI->db->select($column_name);
    $CI->db->from($tbl_emp);
    $CI->db->join($tbl_emp_detail, "$tbl_emp.emp_id = $tbl_emp_detail.emp_id");
    $CI->db->join($tbl_emp_role, "$tbl_emp.designation_id = $tbl_emp_role.role_id");
    $emp_id = $id == '' ? emp_session_id() : $id;
    $CI->db->where("$tbl_emp.emp_id", $emp_id);
    $query = $CI->db->get();
    if ($query->num_rows() == 1) {
        //print_r($query->result());die;
        return $query->result();
    } else {
        return FALSE;
    }
}
function get_data_from_where($table_name, $column, $where_key, $where_value) {
    $ci = & get_instance();
    $ci->db->select($column);
    $result = $ci->db->get_where($table_name, array($where_key => $where_value));
    $rows = $result->row_array();
    $ci->db->last_query();
    return $rows;
}

function get_date_formate($date, $formate = 'd F Y') {
    $date = strtotime($date);
    return date($formate, $date);
}

function get_datetime_formate($date, $formate = 'd F Y h:i A') {
    $date = strtotime($date);
    return date($formate, $date);
}

// file lastid section no
function plusone_fileno1($sectionid , $marksection = null , $month = null) {
    $CI = & get_instance();
    $CI->db->select_max('section_number');
    $CI->db->where('section_id', $sectionid);
	$CI->db->where('YEAR(file_created_date)', date("Y"));
    if($marksection != null){
        $CI->db->where('filemarked_section_id', $marksection);
    }
    $query = $CI->db->get(FILES_SECTION, 1);
    $result = $query->row_array();
    // echo  $CI->db->last_query();
    return $result['section_number'] + 1;
}

// file lastid section no
function getfilesec_id_byfileid($fileid, $sectionid , $filetype = null, $markedsec = null) {
	
    $CI = & get_instance();
    $CI->db->select('section_number');
    $CI->db->where('file_id', $fileid);
    $CI->db->where('section_id', $sectionid);
    if($filetype != null && $filetype != '') {
    //    $CI->db->where('file_type', $filetype);
    }
    if($markedsec != null && $markedsec != '') {
        $CI->db->where('filemarked_section_id', $markedsec);
    }
	$CI->db->order_by('file_section_id','desc');
    $query = $CI->db->get(FILES_SECTION, 1);
    $result = $query->row_array();
 // echo  $CI->db->last_query();
    if (count($result) > 0) {
        return $result['section_number'];
    } else {
        return null;
    }
}

/* Code added by bij 31072015 */

function get_emp_sections($sectionids) {
    $ci = & get_instance();
    $sql_query = "SELECT group_concat(section_name_hi SEPARATOR ',<br/><br/>') as section_hi, group_concat(section_name_en) as section_en FROM `ft_sections_master` WHERE `section_id` IN ($sectionids)";
    $results = $ci->db->query($sql_query)->result_array();
    if (count($results) > 0) {
        return $results[0];
    } else {
        return null;
    }
}

function get_emp_other_work_alloted($empid) {
    $ci = & get_instance();
    if (isset($empid) && $empid != '') {
        $sql_query = "select section_otherwork_id from ft_" . EMPLOYEE_ALLOTED_OTHER_WORK . " where emp_id=$empid";
        $results = $ci->db->query($sql_query)->result_array();
        if (count($results) > 0) {
            return $other_worke_alloted_array = explode(',', $results[0]['section_otherwork_id']);
        } else {
            return null;
        }
    }
}
/* end */

/*06/08/2015*/
function get_secuirty_question(){
   return $sec_qt= array(
        '1'=>'आपकी पसंदीदा गाड़ी का नाम क्या है?',
        '2'=>'आपका उपनाम क्या है?',
        '3'=>'आपके पसंदीदा पालतू जानवर का नाम क्या है?',
        '4'=>'आपके पसंदीदा नाटक का नाम क्या है?',
        '5'=>'आपकी पसंदीदा फिल्म का नाम क्या है?',
        '6'=>'आपके पसंदीदा शहर का नाम क्या है?',
        '7'=>'आपकी पसंदीदा किताब का नाम क्या है?',
        '8'=>'आपका पसंदीदा खेल का नाम क्या है?',
        '9'=>'आपका पसंदीदा रंग कौनसा  है?',
        '10'=>'आप खाली समय में क्या करना पसंद करते है?',
    );
}
function viewDashboardRole($emp_role = '')
{
	
	$role = array(1,2,3,4,5,6,7,8,9,10,17,22,24);
	if(in_array($emp_role , $role))
	{
		return TRUE;
	}
	else{
		return FALSE;
	}
}
function get_user_log($emp_id = ''){
    $CI = & get_instance();
    $CI->db->select('*');
    if(empty($emp_id)) { 
        $CI->db->where('emp_id', emp_session_id());
    } else {
        $CI->db->where('emp_id', $emp_id);  
    } 
    $query = $CI->db->get('employee_login_log');
    $result = $query->row_array();
    //$CI->db->last_query();
    return $result;
}
function file_from_type(){
      $file_types1 = array(
		'v' => 'विभाग',
        'c' => 'कलेक्टर / जिला दण्डाधिकारी',
        'jvn' => 'जिला एवं सत्र न्यायालय',
        'm' => 'महाधिवक्ता',
        'u' => 'उच्च न्यायालय',
        'au' => 'अन्य प्रदेश उच्च न्यायालय',
        'sc' => 'दिल्ली सुप्रीम कोर्ट ',
        'o' => 'Other , अन्य',
    );
    return $file_types1;
}


/*End*/

//rp
function getFiledata_inlist_asc($file_id = null , $section_id = null , $category = null) {
    $CI = & get_instance();
    $emp_session_id = emp_session_id();
    if($section_id == 'oth'){$section =  empdetails($emp_session_id);
        $rt = explode(',',$section[0]['emp_section_id']);
    }
    $tbl1 = FILES;
    $tbl4 = DEPARTMENTS;
    $tbl5 = DISTRICT;
 //   $tbl3 = EMPLOYEES;
  //  $tbl6 = REMARK_MASTER;
    $CI->db->select(FILES .'.*,dept_name_hi,district_name_hi');
    $CI->db->from($tbl1);
    $CI->db->join($tbl4, "$tbl4.dept_id = $tbl1.file_department_id", 'left');
    $CI->db->join($tbl5, "$tbl5.district_id = $tbl1.file_district_id",'left');
 //   $CI->db->join($tbl3, "$tbl3.emp_id = $tbl1.file_received_emp_id", 'left');
   // $CI->db->join($tbl6, "$tbl6.remark_id = $tbl1.file_progress_status_id", 'left');
    if($file_id != null && isset($file_id)){
        $CI->db->where("$tbl1.file_id", $file_id); }
    if($section_id != null && isset($section_id)){
        if($section_id == 'oth'){
            $CI->db->where_not_in("$tbl1.file_mark_section_id", $rt);
        }else {
            //$CI->db->where("$tbl1.file_mark_section_id", $section_id);
			if($section_id==1){
                $CI->db->where("$tbl1.file_mark_section_id",0);
            }else{
               $CI->db->where("$tbl1.file_mark_section_id", $section_id);
            }
        } 
	}
    $CI->db->where("$tbl1.file_received_emp_id", $emp_session_id);
    //$CI->db->where("$tbl1.file_return", '0'); /*Comment by  11 01 2016 for view all type of files.*/
    $CI->db->where("$tbl1.file_hardcopy_status !=", 'close');
	if($category != ''){
	     $CI->db->where("$tbl1.section_file_categoty", $category); 
	}
    $CI->db->order_by("$tbl1.file_update_date", 'ASC');
    $query = $CI->db->get();
    //  echo   $CI->db->last_query();
        return $query->result();
}

	// function get_employees_brthdays($idToday = ''){
        // $CI = & get_instance();
        // $CI->db->select('*'); 
        // $today = date('Y-m-d');
        // if($idToday == 'yes'){
            // $where = "DATE_FORMAT(`emp_detail_dob`, '%m-%d') = DATE_FORMAT('$today', '%m-%d')";
        // } else {
            // $date = week_start_end_by_date($today);
            // $last_day_of_week = $date['last_day_of_week'];
            // $where = "DATE_FORMAT(`emp_detail_dob`, '%m-%d') >= DATE_FORMAT('$today', '%m-%d') and DATE_FORMAT(`emp_detail_dob`, '%m-%d') <= DATE_FORMAT('$last_day_of_week', '%m-%d')";
        // }
		// $CI->db->where("emp_status", '1' );
        // $CI->db->where("emp_is_retired", '0');
        // $CI->db->where($where);
        // $CI->db->join(EMPLOYEES, EMPLOYEES . '.emp_id = ' . EMPLOYEE_DETAILS . '.emp_id');
        // $CI->db->from(EMPLOYEE_DETAILS);
        // $CI->db->order_by("emp_detail_dob", "ASC");    
        // $query = $CI->db->get();
      // echo $CI->db->last_query();
        // return $rows = $query->result();
        
    // }
	
	function get_employees_brthdays($idToday = ''){
        $CI = & get_instance();	
		$today = date('Y-m-d');
        if($idToday == 'yes'){
            $where = "DATE_FORMAT(`emp_detail_dob`, '%m-%d') = DATE_FORMAT('$today', '%m-%d')";
        } else {
            $date = week_start_end_by_date($today);
            $last_day_of_week = $date['last_day_of_week'];
            $where = "DATE_FORMAT(`emp_detail_dob`, '%m-%d') >= DATE_FORMAT('$today', '%m-%d') and DATE_FORMAT(`emp_detail_dob`, '%m-%d') <= DATE_FORMAT('$last_day_of_week', '%m-%d')";
        }
		$query = "SELECT `ft_employee`.`emp_id`, `emp_full_name_hi`, `designation_id`, `emp_detail_dob`,emp_detail_gender,
		DATE_FORMAT(`emp_detail_dob`, '%d') as dob_date, DATE_FORMAT(`emp_detail_dob`, '%m') as dob_month
		FROM (`ft_employee_details`) 
		JOIN `ft_employee` ON `ft_employee`.`emp_id` = `ft_employee_details`.`emp_id` 
		WHERE `emp_status` = '1' AND `emp_is_retired` = '0'  and `emp_posting_location` = '1'
		AND $where
		ORDER BY dob_month ASC, `dob_date` ASC";
		$query= $CI->db->query($query);
        return $query->result();	  
    }
	
    function get_employees_retirements($idToday = ''){
        $CI = & get_instance();
        $CI->db->select('*'); 
        $today = date('Y-m-d');
        $where = "DATE_FORMAT(`emp_detail_retirement_date`, '%y-%m') = DATE_FORMAT('$today', '%y-%m')";
        $CI->db->where($where);
        $CI->db->join(EMPLOYEES, EMPLOYEES . '.emp_id = ' . EMPLOYEE_DETAILS . '.emp_id');
        $CI->db->from(EMPLOYEE_DETAILS);
        $CI->db->order_by("emp_detail_retirement_date", "ASC");    
        $query = $CI->db->get();
       // echo $CI->db->last_query();
        return $rows = $query->result();
        
    }

    function week_start_end_by_date($date, $format = 'Y-m-d') {
        if (is_numeric($date) AND strlen($date) == 10) {
            $time = $date;
        }else{
            $time = strtotime($date);
        }
        
        $week['week'] = date('W', $time);
        $week['year'] = date('o', $time);
        $week['year_week']           = date('oW', $time);
        $first_day_of_week_timestamp = strtotime($week['year']."W".str_pad($week['week'],2,"0",STR_PAD_LEFT));
        $week['first_day_of_week']   = date($format, $first_day_of_week_timestamp);
        $week['first_day_of_week_timestamp'] = $first_day_of_week_timestamp;
        $last_day_of_week_timestamp = strtotime($week['first_day_of_week']. " +6 days");
        $week['last_day_of_week']   = date($format, $last_day_of_week_timestamp);
        $week['last_day_of_week_timestamp']  = $last_day_of_week_timestamp;
        
        return $week;
    }

    function get_emplyee_role_id($emp_id){
        $ci = & get_instance();
        $ci->db->select('role_id');
        $result = $ci->db->get_where(EMPLOYEE, array('emp_id'=>$emp_id ));
        $rows = $result->row_array();
        $ci->db->last_query();
        return $rows['role_id'];
    }

    function get_role_class($id){
        switch($id){
            case 3:
            return 'bg-success';
            break; 
            case 4:
            return 'bg-warning';
            break;
            case 5:
            return 'bg-info';
            break; 
            case 6:
            return 'bg-danger';
            break; 
            case 7:
            return 'bg-primary';
            break;  
            case 8:
            return 'bg-yellow';
            break; 
            case 14:
            return 'bg-yellow';
            break; 
            case 11:
            return 'bg-primary';
            break; 
            case 15:
            return 'bg-green';
            break; 
            case 25:
            return 'bg-aqua';
            break; 
            case 13:
            return 'bg-aqua';
            break; 
            default:
            return 'bg-default';
            break;          
        }
    }

     function get_weeks($ishindi = false){
        $weeks_en = array(
            1 => 'Sunday',
            2 => 'Monday',
            3 => 'Tuesday',
            4 => 'Wednesday',
            5 => 'Thursday',
            6 => 'Friday',
            7 => 'Saturday',
        );
        
        $weeks_hi = array(
            1 => 'रविवार',
            2 => 'सोमवार',
            3 => 'मंगलवार',
            4 => 'बुधवार',
            5 => 'गुरुवार',
            6 => 'शुक्रवार',
            7 => 'शनिवार',
        );
        
        if($ishindi){
            return $weeks_hi;
        } else {
           return $weeks_en; 
        }
    }
    function day_difference_dates($datetime1, $datetime2){
        $datetime1 = strtotime($datetime1);
        $datetime2 = strtotime($datetime2);
        $datediff = $datetime2 - $datetime1;
        $number = floor($datediff/(60*60*24));
        return $number;
    }
    
    function get_user_supervisor($emp_id = ''){
        $CI = & get_instance();
        $emp_id = $emp_id == '' ? $CI->session->userdata('emp_id') : $emp_id ;
        $hiraarchi_level = EMPLOYEE_HIARARCHI_LEVEL;
        $employee = EMPLOYEES;
        $employee_role = EMPLOYEEE_ROLE;
        $CI->db->select($employee . '.emp_id,emp_unique_id,emp_full_name,emp_image,emprole_name_hi');
        $CI->db->from($employee);
        $CI->db->join($hiraarchi_level, $employee . '.emp_id=' . $hiraarchi_level . '.emp_id');
        $CI->db->join($employee_role, $employee . '.designation_id=' . $employee_role . '.role_id');
        $CI->db->where('under_emp_id', $emp_id);
        $query = $CI->db->get();
        //echo $CI->db->last_query();
        return $rows = $query->result();
    }
    
function filesend_nextofficer($file_id,$mark_emp,$file_progressid,$file_remark = null ,$section_id=null ,$f_status = null ) {
    $CI = & get_instance();
    if (isset($file_id) && $mark_emp != '' && $file_progressid != '') {
        $filedetails =  getFileDetails($file_id);
        $check_da_permission = logged_emp_is_permission(); // use for DA prmission

        if($filedetails->file_received_emp_id == emp_session_id() || $check_da_permission['emp_id_assign_by'] == $filedetails->file_received_emp_id) {

            $empdetails = empdetails(emp_session_id());
            $empdetails2 = empdetails($mark_emp);

        $file_data = array(
            'file_received_emp_id' => $mark_emp,
            'file_sender_emp_id' => emp_session_id(),
            'file_hardcopy_status' => 'not',
        //    'file_progress_status_id' => $file_progressid,
            'file_update_date' => date('Y-m-d H:i:s'),
        //    'file_mark_section_date' => date('Y-m-d H:i:s'),
			'file_mark_section_id'=> !empty( $section_id)? $section_id : $filedetails->file_mark_section_id,
			'file_unit_level' => getunitid($empdetails2[0]['role_id'])==''?0:getunitid($empdetails2[0]['role_id']),
			'file_return' => '0',
			'file_status' => isset($f_status)?$f_status :'',
        );
        if($file_remark != ''){
            $remark = $file_remark;
        }else{
            $remark = '';
        }

        $checkUserdesignation = checkUserdesignation();

        $filelog_data = array(
            'file_id' => $file_id,
            'section_id' =>  !empty( $section_id)? $section_id : $filedetails->file_mark_section_id,
            'to_emp_id' => $mark_emp,
            'from_emp_id' => emp_session_id(),
        //    'fvlm_id' => '22',
            'flog_other_remark' => $remark,
            'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
            'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
            'sublogin' => $CI->session->userdata('emp_id'),
			'emp_degignation_id' => $checkUserdesignation,
			'file_status_log' => isset($f_status)?$f_status :'',
        );
       
        $form_data_move1 = array(
            'fmove_file_id'  => $file_id,
            'fmove_current_user_id'  => $mark_emp,
            'fmove_previous_user_id' => emp_session_id(),
            'fmove_to_unit_id'       => getunitid($empdetails2[0]['role_id'])==''?0:getunitid($empdetails2[0]['role_id']),
            'fmove_from_unit_id'     => getunitid($empdetails[0]['role_id'])==''?0:getunitid($empdetails[0]['role_id']),
        );
        // pr(array_merge($file_data,$form_data_move1));
        $res1 = updateData(FILES, $file_data, array('file_id' => $file_id));
        if ($res1) {
                if($filedetails->final_draft_id != null || $filedetails->final_draft_id != 0){
                    update_efile($file_id, $mark_emp);
					if($filelog_data['flog_other_remark'] != ''){
                        insertData($filelog_data, FILES_LOG);
                    }
                }else{
                    insertData($filelog_data, FILES_LOG);
                }
            insertData($form_data_move1, FILES_MOVEMENT);
        }
        return $file_id;
        }else{
            return false;
        }
    }
}

/*Fore E file only*/
function efile_send_nextofficer($file_id,$mark_emp,$file_progressid,$file_remark = null ,$section_id=null ,$f_status = null,$loggined_in_userId) {
    $CI = & get_instance();
    if (isset($file_id) && $mark_emp != '' && $file_progressid != '') {
        $filedetails =  getFileDetails($file_id);

	    $empdetails = empdetails($loggined_in_userId);
        $empdetails2 = empdetails($mark_emp);

		if(!empty($section_id)){
			$sectionid = $section_id;
		}
		else{
			$sectionid = $filedetails->file_mark_section_id;
		}
        $file_data = array(
            'file_received_emp_id' => $mark_emp,
            'file_sender_emp_id' => $loggined_in_userId,
            'file_hardcopy_status' => 'not',
        //    'file_progress_status_id' => $file_progressid,
            'file_update_date' => date('Y-m-d H:i:s'),
        //    'file_mark_section_date' => date('Y-m-d H:i:s'),
			'file_mark_section_id'=> !empty( $section_id)? $section_id : $filedetails->file_mark_section_id,
			'file_unit_level' => getunitid($empdetails2[0]['role_id'])==''?0:getunitid($empdetails2[0]['role_id']),
			'file_return' => '0',
			'file_status' => isset($f_status)?$f_status :'',
        );
        if($file_remark != ''){
            $remark = $file_remark;
        }else{
            $remark = '';
        }

        $checkUserdesignation = checkUserdesignation($loggined_in_userId);

        $filelog_data = array(
            'file_id' => $file_id,
            'section_id' =>  !empty( $section_id)? $section_id : $filedetails->file_mark_section_id,
            'to_emp_id' => $mark_emp,
            'from_emp_id' => $loggined_in_userId,
        //    'fvlm_id' => '22',
            'flog_other_remark' => $remark,
            'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
            'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
            'sublogin' => $CI->session->userdata('emp_id'),
			'emp_degignation_id' => $checkUserdesignation,
			'file_status_log' => isset($f_status)?$f_status :'',
        );

        $form_data_move1 = array(
            'fmove_file_id'  => $file_id,
            'fmove_current_user_id'  => $mark_emp,
            'fmove_previous_user_id' => $loggined_in_userId,
            'fmove_to_unit_id'       => getunitid($empdetails2[0]['role_id'])==''?0:getunitid($empdetails2[0]['role_id']),
            'fmove_from_unit_id'     => getunitid($empdetails[0]['role_id'])==''?0:getunitid($empdetails[0]['role_id']),
        );
        // pr(array_merge($file_data,$form_data_move1));
        $res1 = updateData(FILES, $file_data, array('file_id' => $file_id));
        if ($res1) {
            insertData($filelog_data, FILES_LOG);
            insertData($form_data_move1, FILES_MOVEMENT);
        }
        return $file_id;

    }
}

function filereceive_byofficer($file_id,$logremark = null,$sectionid2 = null, $file_status = null) {
    $CI = & get_instance();
    if (isset($file_id)) {
        $filedetails =  getFileDetails($file_id);
      
	  $empdetails = empdetails(emp_session_id());
	  
        $file_data = array(
            'file_hardcopy_status' => 'received',
            'file_update_date' => date('Y-m-d H:i:s'),
			'file_unit_level' => getunitid($empdetails[0]['role_id'])==''?0:getunitid($empdetails[0]['role_id']),
			'file_status' =>  	isset($file_status)?$file_status:''
        );
        if($logremark != null)
        {
       $hardcopy_carry_empname = $logremark;
        }else{
            $hardcopy_carry_empname = '';
        }
		
		if($filedetails->file_received_emp_id != emp_session_id() && !in_array(emp_session_id(),$multi_nm)){
           $flog_other_remark = getemployeeName(emp_session_id(),$ishindi  = true) .' ('. get_employee_role(emp_session_id()) .") द्वारा ". getemployeeName($filedetails->file_received_emp_id,$ishindi  = true). " (".get_employee_role($filedetails->file_received_emp_id).") का कार्य किया गया |";
        }else{
            $flog_other_remark = "";
        }

        $checkUserdesignation = checkUserdesignation();
        $filelog_data = array(
            'file_id' => $file_id,
            'section_id' => $filedetails->file_mark_section_id,
            'to_emp_id' => emp_session_id(),
            'from_emp_id' => emp_session_id(),
        //    'fvlm_id' => '29',
            'hardcopy_carry_empname' => $hardcopy_carry_empname,
			'flog_other_remark' => $flog_other_remark,
            'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
            'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
            'sublogin' => $CI->session->userdata('emp_id'),
			'emp_degignation_id' => $checkUserdesignation	,
			'file_status_log' =>  	isset($file_status)?$file_status:''
        );
        
        $form_data_move1 = array(
            'fmove_file_id'  => $file_id,
            'fmove_current_user_id'  => emp_session_id(),
            'fmove_previous_user_id' => emp_session_id(),
            'fmove_to_unit_id'       => getunitid($empdetails[0]['role_id'])==''?0:getunitid($empdetails[0]['role_id']),
            'fmove_from_unit_id'     => getunitid($empdetails[0]['role_id'])==''?0:getunitid($empdetails[0]['role_id']),
        );
        // pr(array_merge($file_data,$form_data_move1));
        $res1 = updateData(FILES, $file_data, array('file_id' => $file_id));
        if ($res1) {
            insertData($filelog_data, FILES_LOG);
            insertData($form_data_move1, FILES_MOVEMENT);
        }
        return $file_id;

    }
}

function checkemp_section_byfile($fileid, $empid) {
    $CI = & get_instance();
    if(isset($fileid) && isset($empid)) {
        $filedetails =  getFileDetails($fileid);
        $where = "FIND_IN_SET('" . $filedetails->file_mark_section_id . "', emp_section_id)";
        $CI->db->where($where);
        $CI->db->where('emp_id', $empid);
        $CI->db->from(EMPLOYEES);
        $query = $CI->db->get();
     // echo  $CI->db->last_query();
        if ($query->num_rows() != 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }
}

function getFiledata_inlist_desc($file_id = null , $section_id = null , $category = null) {
    $CI = & get_instance();
    $emp_session_id = emp_session_id();
    if($section_id == 'oth'){$section =  empdetails($emp_session_id);
        $rt = explode(',',$section[0]['emp_section_id']);
    }
    $tbl1 = FILES;
    $tbl4 = DEPARTMENTS;
    $tbl5 = DISTRICT;
    //   $tbl3 = EMPLOYEES;
    //  $tbl6 = REMARK_MASTER;
    $CI->db->select(FILES .'.*,dept_name_hi,district_name_hi');
    $CI->db->from($tbl1);
    $CI->db->join($tbl4, "$tbl4.dept_id = $tbl1.file_department_id", 'left');
    $CI->db->join($tbl5, "$tbl5.district_id = $tbl1.file_district_id",'left');
    //   $CI->db->join($tbl3, "$tbl3.emp_id = $tbl1.file_received_emp_id", 'left');
    // $CI->db->join($tbl6, "$tbl6.remark_id = $tbl1.file_progress_status_id", 'left');
   if($category != ''){
	     $CI->db->where("$tbl1.section_file_categoty", $category); 
	}
   if($file_id != null && isset($file_id)){
        $CI->db->where("$tbl1.file_id", $file_id); }
    if($section_id != null && isset($section_id)){
        if($section_id == 'oth'){
            $CI->db->where_not_in("$tbl1.file_mark_section_id", $rt);
        }else {
            $CI->db->where("$tbl1.file_mark_section_id", $section_id);
        }
    }
    $CI->db->where("$tbl1.file_received_emp_id", $emp_session_id);
    $CI->db->where("$tbl1.file_return", '1');
    $CI->db->where("$tbl1.file_hardcopy_status !=", 'close');
    $CI->db->order_by("$tbl1.file_update_date", 'ASC');
    $query = $CI->db->get();
    //  echo   $CI->db->last_query();
    return $query->result();
}
/*Update by bij 16 01 2016 */
function file_moniter_byuser($file_id = null , $file_moniter_byps = NULL, $emp_id = null,$limit=null,$page=null) {
		if($emp_id == null){
			$emp_id = emp_session_id();
		}
        $CI = & get_instance();
        $yr_mnth_sql='';
        if(isset($_GET['files_year']) && $_GET['files_year']!=''){
           $yr_mnth_sql = "YEAR(flog_created_date)='".$_GET['files_year']."' AND ";
        }else{
            $yr_mnth_sql = "YEAR(flog_created_date)='".date('Y')."' AND ";
        }
        if(isset($_GET['files_month']) && $_GET['files_month']!=''){
             $yr_mnth_sql.="MONTH(flog_created_date)='".$_GET['files_month']."' AND";
        }else{
            $yr_mnth_sql.="MONTH(flog_created_date)='".date('m')."' AND";
        }
     //   $subQuery = ("SELECT DISTINCT `fmove_file_id` FROM `ft_file_movements` WHERE `fmove_current_user_id`=".emp_session_id());
       // $subQuery = ("SELECT DISTINCT `file_id` FROM `ft_file_logs` WHERE `to_emp_id`=".emp_session_id());
        
        $subQuery = ("SELECT DISTINCT `file_id` FROM `ft_file_logs` WHERE $yr_mnth_sql  (`to_emp_id`=".$emp_id."  or from_emp_id = ".$emp_id . ")" );
        //$CI->db->select('*')->from(FILES)->where("file_id IN ($subQuery)", NULL, FALSE);
        if(isset($_GET['sort']) && $_GET['sort']!=''){
            if(isset($_GET['sort'])&& $_GET['sort']=='rj'){
                $CI->db->select('*')->from(FILES)->where("file_id IN ($subQuery)", NULL, FALSE)->where("file_hardcopy_status",'not');
            }else if(isset($_GET['sort'])&& $_GET['sort']=='rj_cr'){
                $CI->db->select('*')->from(FILES)->where("file_id IN ($subQuery)", NULL, FALSE)->where("file_hardcopy_status",'not')->where("file_received_emp_id IN (210,211,204,177)", NULL, FALSE);
            }else if(isset($_GET['sort'])&& $_GET['sort']=='rc'){
                $CI->db->select('*')->from(FILES)->where("file_id IN ($subQuery)", NULL, FALSE)->where("file_hardcopy_status",'received')->or_where("file_hardcopy_status",'working');
            }
        }else{
                $CI->db->select('*')->from(FILES)->where("file_id IN ($subQuery)", NULL, FALSE);
        }
        if(isset($_GET['searchby']) && $_GET['searchby']!=''){
			$searchval=$_GET['searchby'];
			$sql_emp="SELECT emp_id,emp_full_name FROM ft_employee WHERE MATCH(emp_full_name_hi) AGAINST('".$searchval."')";
			$emp_row_details= get_row($sql_emp);
			if(isset($emp_row_details['emp_id']) && $emp_row_details['emp_id']!=''){				
				$searchval = $emp_row_details['emp_id'];
				$CI->db->where('ft_files.file_received_emp_id',$searchval);
			}else{
				$wheres= "(FIND_IN_SET('".$searchval."',ft_files.file_all_section_no) OR ft_files.file_subject like '%".$searchval."%'  OR ft_files.file_uo_or_letter_no like '%".$searchval."%' OR ft_files.file_uo_or_letter_date = DATE_FORMAT('".$searchval."', '%Y-%m-%d'))";
				$CI->db->where($wheres);
			}
		}
         if($file_moniter_byps){
                $CI->db->order_by("ps_moniter_date", 'asc');
        }else{
			$CI->db->order_by("file_update_date", 'desc');                
        }
		$CI->db->limit($limit,$page);
        $query= $CI->db->get();
        return  $query->result();
}function count_file_moniter_byuser_close($file_id = null , $file_moniter_byps = NULL, $emp_id = null) {
        if($emp_id == null){
            $emp_id = emp_session_id();
        }
        $CI = & get_instance();
        $yr_mnth_sql='';
        if(isset($_GET['files_year']) && $_GET['files_year']!=''){
           $yr_mnth_sql = "YEAR(flog_created_date)='".$_GET['files_year']."' AND ";
        }else{
            $yr_mnth_sql = "YEAR(flog_created_date)='".date('Y')."' AND ";
        }
        if(isset($_GET['files_month']) && $_GET['files_month']!=''){
             $yr_mnth_sql.="MONTH(flog_created_date)='".$_GET['files_month']."' AND";
        }else{
            $yr_mnth_sql.="MONTH(flog_created_date)='".date('m')."' AND";
        }
        $subQuery = ("SELECT DISTINCT `file_id` FROM `ft_file_logs_master` WHERE $yr_mnth_sql  (`to_emp_id`=".$emp_id."  or from_emp_id = ".$emp_id . ")" );
        if(isset($_GET['sort']) && $_GET['sort']!=''){
            if(isset($_GET['sort'])&& $_GET['sort']=='rj'){
                $CI->db->select('COUNT(DISTINCT(file_id)) as totalfiles')->from(FILES)->where("file_id IN ($subQuery)", NULL, FALSE)->where("file_hardcopy_status",'not');
            }else if(isset($_GET['sort'])&& $_GET['sort']=='rj_cr'){
                $CI->db->select('COUNT(DISTINCT(file_id)) as totalfiles')->from(FILES)->where("file_id IN ($subQuery)", NULL, FALSE)->where("file_hardcopy_status",'not')->where("file_received_emp_id IN (210,211,204,177)", NULL, FALSE);
            }else if(isset($_GET['sort'])&& $_GET['sort']=='rc'){
                $CI->db->select('COUNT(DISTINCT(file_id)) as totalfiles')->from(FILES)->where("file_id IN ($subQuery)", NULL, FALSE)->where("file_hardcopy_status",'received')->or_where("file_hardcopy_status",'working');
            }
        }else{
                $CI->db->select('COUNT(DISTINCT(file_id)) as totalfiles')->from(FILES)->where("file_id IN ($subQuery)", NULL, FALSE);
        }
        if(isset($_GET['searchby']) && $_GET['searchby']!=''){
            $searchval=$_GET['searchby'];
            $sql_emp="SELECT emp_id,emp_full_name FROM ft_employee WHERE MATCH(emp_full_name_hi) AGAINST('".$searchval."')";
            $emp_row_details=get_row($sql_emp);
            if(isset($emp_row_details['emp_id']) && $emp_row_details['emp_id']!=''){                
                $searchval = $emp_row_details['emp_id'];
                $CI->db->where('ft_files.file_received_emp_id',$searchval);
            }else{
                $wheres= "(FIND_IN_SET('".$searchval."',ft_files.file_all_section_no) OR ft_files.file_subject like '%".$searchval."%'  OR ft_files.file_uo_or_letter_no like '%".$searchval."%' OR ft_files.file_uo_or_letter_date = DATE_FORMAT('".$searchval."', '%Y-%m-%d'))";
                $CI->db->where($wheres);
            }
        }               
        if($file_moniter_byps){
                $CI->db->order_by("ps_moniter_date", 'asc');
        }else{
                $CI->db->order_by("file_update_date", 'asc');
        }
        $query= $CI->db->get();             
        return  $query->row_array();
}
function count_file_moniter_byuser($file_id = null , $file_moniter_byps = NULL, $emp_id = null) {
		if($emp_id == null){
			$emp_id = emp_session_id();
		}
        $CI = & get_instance();
        $yr_mnth_sql='';
        if(isset($_GET['files_year']) && $_GET['files_year']!=''){
           $yr_mnth_sql = "YEAR(flog_created_date)='".$_GET['files_year']."' AND ";
        }else{
            $yr_mnth_sql = "YEAR(flog_created_date)='".date('Y')."' AND ";
        }
        if(isset($_GET['files_month']) && $_GET['files_month']!=''){
             $yr_mnth_sql.="MONTH(flog_created_date)='".$_GET['files_month']."' AND";
        }else{
            $yr_mnth_sql.="MONTH(flog_created_date)='".date('m')."' AND";
        }
        $subQuery = ("SELECT DISTINCT `file_id` FROM `ft_file_logs` WHERE $yr_mnth_sql  (`to_emp_id`=".$emp_id."  or from_emp_id = ".$emp_id . ")" );
        if(isset($_GET['sort']) && $_GET['sort']!=''){
            if(isset($_GET['sort'])&& $_GET['sort']=='rj'){
                $CI->db->select('COUNT(DISTINCT(file_id)) as totalfiles')->from(FILES)->where("file_id IN ($subQuery)", NULL, FALSE)->where("file_hardcopy_status",'not');
            }else if(isset($_GET['sort'])&& $_GET['sort']=='rj_cr'){
                $CI->db->select('COUNT(DISTINCT(file_id)) as totalfiles')->from(FILES)->where("file_id IN ($subQuery)", NULL, FALSE)->where("file_hardcopy_status",'not')->where("file_received_emp_id IN (210,211,204,177)", NULL, FALSE);
            }else if(isset($_GET['sort'])&& $_GET['sort']=='rc'){
                $CI->db->select('COUNT(DISTINCT(file_id)) as totalfiles')->from(FILES)->where("file_id IN ($subQuery)", NULL, FALSE)->where("file_hardcopy_status",'received')->or_where("file_hardcopy_status",'working');
            }
        }else{
                $CI->db->select('COUNT(DISTINCT(file_id)) as totalfiles')->from(FILES)->where("file_id IN ($subQuery)", NULL, FALSE);
        }
		if(isset($_GET['searchby']) && $_GET['searchby']!=''){
			$searchval=$_GET['searchby'];
			$sql_emp="SELECT emp_id,emp_full_name FROM ft_employee WHERE MATCH(emp_full_name_hi) AGAINST('".$searchval."')";
			$emp_row_details=get_row($sql_emp);
			if(isset($emp_row_details['emp_id']) && $emp_row_details['emp_id']!=''){				
				$searchval = $emp_row_details['emp_id'];
				$CI->db->where('ft_files.file_received_emp_id',$searchval);
			}else{
				$wheres= "(FIND_IN_SET('".$searchval."',ft_files.file_all_section_no) OR ft_files.file_subject like '%".$searchval."%'  OR ft_files.file_uo_or_letter_no like '%".$searchval."%' OR ft_files.file_uo_or_letter_date = DATE_FORMAT('".$searchval."', '%Y-%m-%d'))";
				$CI->db->where($wheres);
			}
		}				
        if($file_moniter_byps){
                $CI->db->order_by("ps_moniter_date", 'asc');
        }else{
                $CI->db->order_by("file_update_date", 'asc');
        }
        $query= $CI->db->get();				
        return  $query->row_array();
}
/* end */
/*function file_moniter_byuser($file_id = null , $file_moniter_byps = NULL) {
        $CI = & get_instance();
     //   $subQuery = ("SELECT DISTINCT `fmove_file_id` FROM `ft_file_movements` WHERE `fmove_current_user_id`=".emp_session_id());
       // $subQuery = ("SELECT DISTINCT `file_id` FROM `ft_file_logs` WHERE `to_emp_id`=".emp_session_id());
	   $subQuery = ("SELECT DISTINCT `file_id` FROM `ft_file_logs` WHERE (`to_emp_id`=".emp_session_id()."  or from_emp_id = ".emp_session_id() . ")" );
        //$CI->db->select('*')->from(FILES)->where("file_id IN ($subQuery)", NULL, FALSE);
		if(isset($_GET['sort']) && $_GET['sort']!=''){
			if(isset($_GET['sort'])&& $_GET['sort']=='rj'){
				$CI->db->select('*')->from(FILES)->where("file_id IN ($subQuery)", NULL, FALSE)->where("file_hardcopy_status",'not');
			}else if(isset($_GET['sort'])&& $_GET['sort']=='rj_cr'){
				$CI->db->select('*')->from(FILES)->where("file_id IN ($subQuery)", NULL, FALSE)->where("file_hardcopy_status",'not')->where("file_received_emp_id IN (210,211,204,177)", NULL, FALSE);
			}else if(isset($_GET['sort'])&& $_GET['sort']=='rc'){
				$CI->db->select('*')->from(FILES)->where("file_id IN ($subQuery)", NULL, FALSE)->where("file_hardcopy_status",'received')->or_where("file_hardcopy_status",'working');
			}
		}else{
			$CI->db->select('*')->from(FILES)->where("file_id IN ($subQuery)", NULL, FALSE);
		}
		if($file_moniter_byps){
			$CI->db->order_by("ps_moniter_date", 'asc');
		}else{
			$CI->db->order_by("file_id", 'desc');
		}
        $query = $CI->db->get();
        return    $query->result();
}*/
/* end */

// file search select type RP
function file_searchtypes() {
	$typesearch = array(
        '3' => 'यू0ओ0क्र0 /पत्र क्रमांक0',
        '4' => 'यू0ओ0 दिनांक /पत्र दिनांक',
        '1' => 'पंजी क्र0',
        '7' => 'प्रकरण क्र0',
        '8' => 'विषय',
		'12' => 'पी0 एस0  मॉनिटर',
        '9' => 'आवागमन दिनांक',
		'11' => 'जावक में भेजी गई',
		'13' => 'प्रस्ताव भेजने वाला विभाग',
        '2' => 'पक्षकार',
        '5' => 'Month wise',
        '6' => 'System File ID',
    );
     // if(checkUserrole()==1 ||checkUserrole()==3 || checkUserrole()==4 || checkUserrole()==5 || checkUserrole()==8 || checkUserrole()==37){
        // $typesearch['10']='Date wise';
         // return $typesearch;
     // }else{
       // return $typesearch;
     // }
      return $typesearch;
}
/*18-08-2015*/
function file_other_type(){
   $file_other_types = array(
        '1' => 'अनुभाग (Section)',
        '2' => 'व्यक्तिगत (Personal)',
        '3' => 'गोपनीय / सुरक्षित फ़ाइल (Security/Confidential)',
        '4' => 'फैक्स (Fax)',
        '5' => 'ई-मेल (E-Mail)',
        '6' => 'हाथ से (By Hand)',
    );
    return $file_other_types;
}

function get_officers_list($task=null,$param=null){
	//$officerList= get_list('ft_emprole_master','role_id',array('level_class'=>1));
	//pr($officerList);
	$CI = & get_instance();
	$subQuery = ("SELECT group_concat(role_id) as role_ids FROM `ft_emprole_master` WHERE level_class=1");
	$results = $CI->db->query($subQuery)->row_array();
	$role_ids_array=implode(',',explode(',',$results['role_ids']));
	//pre($role_ids_array);
	
	$where = "role_id in($role_ids_array)";
	$CI->db->where($where);
	$CI->db->where('emp_status',1);
	$CI->db->where('emp_is_retired',0);
	$CI->db->where('emp_posting_location',1);
	//$CI->db->where_in(array('role_id'=>implode(',',$role_ids_array)));
	$CI->db->from(EMPLOYEES);
	$CI->db->order_by('role_id');
	$query = $CI->db->get();
	$emp_officer_list= $query->result_array();
	return $emp_officer_list;
}

function months($month = null, $hindi = false) {
	$months_en = array(
			1 => "January",
			2 => "February",
			3 => "March",
			4 => "April",
			5 => "May",
			6 => "June",
			7 => "July",
			8 => "August",
			9 => "September",
			10 => "October",
			11 => "November",
			12 => "December"
		);
		
		$months_hi = array(
			1 => "जनवरी",
			2 => "फ़रवरी",
			3 => "मार्च",
			4 => "अप्रैल",
			5 => "मई",
			6 => "जून",
			7 => "जुलाई",
			8 => "अगस्त",
			9 => "सितम्बर",
			10 => "अक्टूबर",
			11 => "नवम्बर",
			12 => "दिसम्बर" 
		);
		if($hindi == false){
			if (array_key_exists($month, $months_en)) {
				return $months_en[$month];
			} else {
				return $months_en;
			}		
		} else{
			if (array_key_exists($month, $months_hi)) {
				return $months_hi[$month];
			} else {
				return $months_hi;
			}	
		}		
	}

/*Code start 19 08 2015 Bijendra*/
	function get_emp_role($empid,$other=null){
		$emp_role = empdetails($empid);
		$officerList= get_list('ft_'.UNIT_LEVEL,null,array('role_id'=>$emp_role[0]['role_id']));
		return $officerList[0]['unit_id'];
	}
/*End Code start 19 08 2015*/

/*22/08/2015 GET officer PA List*/
    function get_officer_pa_list($task,$empid){
        //$officer_under_emp_list= get_list('ft_'.EMPLOYEE_HIARARCHI_LEVEL,null,array('emp_id'=>$empid));
        $CI = & get_instance();
        $subQuery = ("SELECT group_concat(under_emp_id) as under_emp_id FROM ft_".EMPLOYEE_HIARARCHI_LEVEL." WHERE emp_id=$empid");
        $results = $CI->db->query($subQuery)->row_array();
        $role_ids_array=implode(',',explode(',',$results['under_emp_id']));
        $where = "`emp_id` in($role_ids_array) AND `emp_status` = 1 AND `emp_is_retired` = 0 AND (`role_id` = 25 OR `role_id` = 12 OR `role_id` = 13)";
        $CI->db->where($where);
        //$CI->db->where_in(array('role_id'=>implode(',',$role_ids_array)));
        $CI->db->from(EMPLOYEES);
        $query = $CI->db->get();
        $emp_officer_list= $query->result_array();
        return $emp_officer_list;
    }

    function show_modules(){
        $module_array=array('1'=>'Files','2'=>'Leave');
        $permission_array = array ('View','Recieved', 'Add','Edit');
        return $module_value=array('module_name'=>$module_array,'permission'=>$permission_array);
    }

    function check_is_permission_exist($emp_id_assign_by,$emp_id_assign_to,$epa_module_name,$permission_name){
        $is_permission_alloted= get_list(EMPLOYEE_PERMISSION_ALLOTED,null,array('emp_id_assign_by'=>$emp_id_assign_by,'emp_id_assign_to'=>$emp_id_assign_to,'epa_module_name'=>$epa_module_name,"epa_$permission_name"=>1));
        if(count($is_permission_alloted)>0){
            return true;
        }
    }

	/*1/09/2015 GET officer PA List*/
	function check_pa_is_any_permission($task='',$paempid=''){
		
		$CI = & get_instance();
		$permission_list_update=array();
		$supervisorId_list='';
		$supervisorId='';
		$logged_id_empid =  $CI->session->userdata('emp_id');
		/*Get PA Upper officer ID*/
		$supervisorId_list= get_list(EMPLOYEE_HIARARCHI_LEVEL,null,array('under_emp_id'=>$logged_id_empid));
		//pr($supervisorId_list);
		/*Get PA Permission List*/
		if(count($supervisorId_list)>0){
			$supervisorId = @$supervisorId_list[0]['emp_id'];
			$permission_list= get_list(EMPLOYEE_PERMISSION_ALLOTED,null,array('emp_id_assign_to'=>$logged_id_empid, 'emp_id_assign_by'=>$supervisorId));
			//pre($supervisorId_list);
			//pre($permission_list);
			foreach($permission_list as $ky=>$val){
				$permission_list_update[$val['epa_module_name']]['add']=$val['epa_add'];
				$permission_list_update[$val['epa_module_name']]['edit']=$val['epa_edit'];
				$permission_list_update[$val['epa_module_name']]['view']=$val['epa_view'];
				$permission_list_update[$val['epa_module_name']]['received']=$val['epa_recieved'];
			}
		}
		return $permission_list_update;
		//
	}
/*End 01/09/2015 GET officer PA List RP modify*/

    function emp_session_id()
    {
        $CI = & get_instance();
		$role = checkUserrole();
		
    if(in_array($role,array(25,12,13))) {
        $CI->db->select('emp_id_assign_by');
        $CI->db->limit('1');
        $CI->db->where('emp_id_assign_to', $CI->session->userdata('emp_id'));
        $CI->db->from(EMPLOYEE_PERMISSION_ALLOTED);
        $query = $CI->db->get();
        //  echo $CI->db->last_query();
        if ($query->num_rows() != 0) {
            $rrt = $query->row('emp_id_assign_by');
        } else {
            $rrt = $CI->session->userdata('emp_id');
		}		
    }elseif($CI->uri->segment(1)=='today' && $CI->uri->segment(2)=='files'){
		$CI->db->select('emp_id_assign_by');
        $CI->db->limit('1');
        $CI->db->where('emp_id_assign_to', $CI->session->userdata('emp_id'));
        $CI->db->from(EMPLOYEE_PERMISSION_ALLOTED);
        $query = $CI->db->get();
        if ($query->num_rows() != 0) {			
            $rrt = $query->row('emp_id_assign_by');
        } else {
            $rrt = $CI->session->userdata('emp_id');
		}
		
	}else{
        $rrt =  $CI->session->userdata('emp_id');
    }
        return $rrt;
    }
/*End 22/08/2015 GET officer PA List RP modify*/



function case_name(){
    $case_name = array(
        'AA',
        'AC',
        'AR',
        'ARBA',
        'ARBC',        
        'BA',
        'CEA',
        'CER',
        'CESR',
        'COMA',
        'COMP',
        'COMPA',
        'CONA',
        'CONC',
        'CONCR',
        'CONT',
        'CONTR',
        'CR',        
        'CRA(CRIMINAL APPEAL)',
        'CRR(CRIMINAL REVISION)',
        'CRRE',
        'CRRF',
        'CRRFC',
        'CS', 
		'DE',           
        'EP',
		'EX',
        'EX-A',
		'EX-AB',
        'EX-B',
        'EX-LA',   
        'FA',
        'FEMA',
        'GTR',
        'ITA',
        'ITR',
        'IDAct',
        'LPA',
        'MA',
        'MACE',
        'MACO',
        'MACOM',
        'MACTR',
        'MAIT',
        'MAVAT',
		'MCA',  
        'MCC',
        'MCOMA',
        'MCP',
        'MCRC',
        'MCRP',
        'MJC',
		'MJC-R', 
        'MP',
        'MWP',
        'OA',
        'OTA',
        'RCA',
        'RCS-A',
        'RCS-B',               
        'RCS-HM',
        'RCT',
        'RP',        
        'SA',
        'SC',
        'SC-ATR',
        'SCCA',
        'SC-CBI',
        'SC-ELE',
        'SC-LOK',
        'SLP CRIMINAL APPEAL',
        'ST',
        'SUM',
        'SLP',
        'STR',
        'TR',
        'Transfer Petition (Criminal)',        
        'VATA',
        'WP',
		'WA',
        'WPS',
        'WTA',
        'WTR',  
		'सत्र',
		'आपराधिक',
		'दाण्डिक',
		'विशेष',
		'फौज़दारी',
    );
    return $case_name ;
}

function get_section_employee($section_id, $role_id = ''){
        $CI = & get_instance();
        $employee = EMPLOYEES;
        $CI->db->select("emp_full_name,emp_full_name_hi,emp_id");
        $CI->db->from($employee);
        $CI->db->where("FIND_IN_SET($section_id,emp_section_id) !=", 0);
         if($role_id != ''){
            $CI->db->where('role_id', $role_id);
        }
        $query = $CI->db->get();
        //echo $CI->db->last_query();
        return $rows = $query->result();
    }
     
   function holidays_2015(){
        $sat_2 = '2nd Saturday';
        $sat_3 = '3rd Saturday';
        $sun = 'Sunday';
        $holidays = array(
           'Saturday' => '2015-01-04', '2015-01-10', '2015-01-11', '2015-01-17', '2015-01-18', '2015-01-25', '2015-01-26',
           '2015-02-01', '2015-02-03', '2015-02-08', '2015-02-14', '2015-02-15', '2015-02-17', '2015-02-21', '2015-02-22',
           '2015-03-01', '2015-03-06', '2015-03-01', '2015-03-08', '2015-03-14', '2015-03-15', '2015-03-21', '2015-03-22', '2015-03-28', '2015-03-29',
           '2015-04-02', '2015-04-03', '2015-04-05', '2015-04-11', '2015-04-12', '2015-04-14', '2015-04-18', '2015-04-19', '2015-04-21', '2015-04-26',
           '2015-05-03', '2015-05-04', '2015-05-09', '2015-05-10', '2015-05-16', '2015-05-17', '2015-05-24', '2015-05-31',
           '2015-06-07', '2015-06-13', '2015-06-14', '2015-06-20', '2015-06-21', '2015-06-28', 
           '2015-07-05', '2015-07-11', '2015-07-12', '2015-07-18', '2015-07-19', '2015-07-26',
           '2015-08-02', '2015-08-08', '2015-08-09', '2015-08-15', '2015-08-16', '2015-08-23', '2015-08-29', '2015-08-30',
           'Janmashtami' => '2015-09-05', '2015-09-06', '2015-09-12', '2015-09-13', 'Anant chaturdashi' => '2015-09-17', '2015-09-19', '2015-09-20', 'Eid' => '2015-09-25', '2015-09-27',
           '2015-10-02', '2015-10-04', '2015-10-10', '2015-10-11', '2015-10-17', '2015-10-18', '2015-10-22', '2015-10-24', '2015-10-25', '2015-10-27',
           '2015-11-01', '2015-11-08', 'Deepavali' => '2015-11-11', 'Padawa' => '2015-11-12', '2015-11-14', '2015-11-15', '2015-11-21', '2015-11-22', 'Guru Nanank Jayanti' => '2015-11-25', '2015-11-29',
           '2015-12-03', '2015-12-06', '2015-12-12', '2015-12-13', '2015-12-19', '2015-12-20', '2015-12-24', '2015-12-25', '2015-12-27',
        );
        return $holidays; 
    }
    
	function holidays_2016(){     
        $holidays = array(
           '2016-01-03', '2016-01-09', '2016-01-10', '2016-01-16', '2016-01-17', '2016-01-24', '2016-01-26', '2016-01-31',
           '2016-02-07', '2016-02-14', '2016-02-21', '2016-02-22', '2016-02-28',
           '2016-03-06', '2016-03-07', '2016-03-13', '2016-03-20', '2016-03-23', '2016-03-25', '2016-03-27',
           '2016-04-03', '2016-04-08', '2016-04-10', '2016-04-14', '2016-04-15', '2016-04-17', '2016-04-19', '2016-04-24',
           '2016-05-01', '2016-05-08', '2016-05-09', '2016-05-15', '2016-05-21', '2016-05-22', '2016-05-29', 
           '2016-06-05', '2016-06-11', '2016-06-12', '2016-06-18', '2016-06-19', '2016-06-26',  
           '2016-07-03', 'ईद-उल-फितर' => '2016-07-06', '2016-07-09', '2016-07-10', '2016-07-16', '2016-07-17', '2016-07-24','2016-07-31',
           '2016-08-07', '2016-08-13', '2016-08-14', 'स्वत्रंता दिवस' => '2016-08-15', 'रक्षाबंधन' => '2016-08-18', '2016-08-20', '2016-08-21', 'जन्माष्टमी' => '2016-08-25', '2016-08-28', 
           '2016-09-04', '2016-09-05', '2016-09-10', '2016-09-11', '2016-09-13', '2016-09-17', '2016-09-18', '2016-09-25', 
           '2016-10-02', '2016-10-08', '2016-10-09', '2016-10-11', '2016-10-12', '2016-10-15', '2016-10-16', '2016-10-23', '2016-10-30', 
           '2016-11-06', '2016-11-12', '2016-11-13', '2016-11-14', '2016-11-19', '2016-11-20', '2016-11-27', '2016-11-27', 
           '2016-12-04', '2016-12-10', '2016-12-11', '2016-12-13', '2016-12-17', '2016-12-18', '2016-12-25', 
        
		);
        return $holidays; 
    }
	
    function check_holidays($date){
        $on_date =  date('Y-m-d', strtotime($date));
        if(in_array($on_date, holidays_2016())) {
           // echo 'yes'.$on_date ; exit;
            return true;
        } else {
            //echo 'no'.$on_date ; exit;
            return false;
        }
        
    }
    
    function holidays_name($date){
        $on_date =  date('Y-m-d', strtotime($date));
        if(in_array($on_date, holidays_2016())) {
           $key = array_search($date, holidays_2016());
            return $key;
        } 
        
    }
    
    function get_advocates_name($condition = '', $byId = '', $select = '*'){
        $CI = & get_instance();
        $CI->db->select($select);
        $CI->db->from(ADVOCATE_MASTER);
        if($condition != ''){
            $CI->db->where($condition);
        }
        if($byId != ''){
            $CI->db->where('scm_id', $byId);
        }
        $CI->db->where('status', 1);
        $query = $CI->db->get();
        $rows = $query->result();
        //echo $CI->db->last_query();
        if($select == '*'){
            return $query->result();
        } else {
            return $rows->$select;
        }
    }  
	  // working   condition
    function get_advocates_name_jobdate($condition = '', $byId = '', $select = '*'){
        $CI = & get_instance();
		$tbl = ADVOCATE_MASTER;
		$tb2 = ADVOCATE_SERVICE_RECORD;
        $CI->db->select(ADVOCATE_MASTER.".* , posting_date , post_renew_date");
        $CI->db->from($tbl);
		$CI->db->join($tb2, $tbl . '.scm_id=' . $tb2 . '.asr_scm_id');
		if($condition != ''){
            $CI->db->where($condition);
        }
        if($byId != ''){
            $CI->db->where('scm_id', $byId);
        }
        $CI->db->where('status', 1);
        $query = $CI->db->get();
        $rows = $query->result();
        //echo $CI->db->last_query();
        if($select == '*'){
            return $query->result();
        } else {
            return $rows->$select;
        }
    }  
	
     function get_standing_counseller_name($task='',$byId=''){
        $CI = & get_instance();
        if($byId){$id=$byId;}else{$id=null;}
        return get_list(COUNSELLER_MEMBERS,null,$id);
    }
    
    function get_leave_supervisor($emp_id = ''){
        $CI = & get_instance();
        $emp_id = $emp_id == '' ? $CI->session->userdata('emp_id') : $emp_id ;
        $leave_level_master = EMPLOYEE_LEAVE_LEVEL_MASTER;
        $employee = EMPLOYEES;
        $CI->db->select($employee . '.emp_id,emp_unique_id,emp_full_name,role_id,emp_image');
        $CI->db->from($employee);
        $CI->db->join($leave_level_master, $employee . '.emp_id=' . $leave_level_master . '.emp_id');
        $CI->db->where($leave_level_master . '.emp_id', $emp_id);
        $query = $CI->db->get();
        //echo $CI->db->last_query();
        return $rows = $query->result();
    }
/*Begin 15-09-2015*/	
	function get_permission_alloted_emp($task){
		if($task=='permission_emp'){
			$CI = & get_instance();
			$sql="SELECT CONCAT(assign_by_emp.emp_full_name,' ', assign_by_emp.emp_full_name_hi) as emp_assign_by,
					CONCAT(assign_to_emp.emp_full_name,' ', assign_to_emp.emp_full_name_hi) as emp_assign_to,
					CONCAT(session_emp.emp_full_name,' ', session_emp.emp_full_name_hi) as session_emp,
					CONCAT(section_master.section_name_hi,' ',section_master.section_name_en) as section_name,
					CONCAT(role_master.emprole_name_hi,' ',role_master.emprole_name_en) as designation_name,
					epa.* 
					FROM `ft_employee_permission_alloted` as epa 
					inner join ft_employee as assign_by_emp on assign_by_emp.emp_id=epa.`emp_id_assign_by` 
								and assign_by_emp.emp_status=1 and assign_by_emp.emp_is_retired=0
					inner join ft_employee as assign_to_emp on assign_to_emp.emp_id=epa.`emp_id_assign_to` 
								and assign_by_emp.emp_status=1 and assign_by_emp.emp_is_retired=0
					LEFT join ft_employee as session_emp on session_emp.emp_id=epa.epa_session_empid 
								and assign_by_emp.emp_status=1 and assign_by_emp.emp_is_retired=0
					LEFT join ft_sections_master as section_master on section_master.section_id=epa.epa_section_id			
					LEFT join ft_emprole_master as role_master on role_master.role_id=epa.epa_designation_id			
					WHERE epa_is_active=1  and epa.epa_type!='pa'";

			return $CI->db->query($sql)->result_array();
		}
    }
	/*End 15-09-2015*/	
	
	/*Begin 19-09-2015 Bij*/
	function get_prosecution_file_type(){
		return array(
		'प्रकरण वापसी'=>'प्रकरण वापसी','दया याचिका'=>'दया याचिका','समंस'=>'समंस','अभियोजन स्वीकृति'=>'अभियोजन स्वीकृति','विधानसभा'=>'विधानसभा','अभ्यावेदन'=>'अभ्यावेदन','Writ'=>'रिट','सुचना का अधिकार' => 'सूचना का अधिकार');
	}
	/*End 19-09-2015 Bij*/
	
/*Begin 19-09-2015 sulbha*/
	function get_BII_file_type(){
		return array(
			1 => 'सूचना का अधिकार',
			2 => 'विधानसभा',
			3 => 'सामान्य',
			4 => 'महाधिवक्ता',
			5 => 'CM Monite',
			6 => 'नोटरी',
		);
	}
	function get_BI_file_type(){
		return array(
			1 => 'CM Monite',
			2 => 'CS Monite',
			3 => 'सामान्य',
			4 => 'S.L.P.',
		);
	}
	function get_lib_file_type(){
		return array(
			1 => 'पत्र',
			2 => 'पत्रिका',
			3 => 'बिल',
			4 => 'किताब',
		);
	}
	
	/* Add rohit 25-04-2016 */
	function get_civil_file_type($type = null){
		$file_type =  array(
			1 => 'प्रतिरक्षण',
			2 => 'अपील',
			3 => 'सामान्य',
			4 => 'S.L.P.',
		);
		if($type != ''){
			if(array_key_exists($type, $file_type)){
				return $file_type[$type];
			}
		} else {
			return $file_type;
		}
	}
	function get_petition_file_type($type = null){
		$file_type =  array(
			1 => 'प्रतिरक्षण',
			2 => 'अपील',
			3 => 'सामान्य',
		);
		if($type != ''){
			if(array_key_exists($type, $file_type)){
				return $file_type[$type];
			}
		} else {
			return $file_type;
		}
	}
	
	/*End 19-09-2015 sulbha*/
	function get_state_list(){
        $CI = & get_instance();
        $subQuery = ("*");
        $CI->db->from(STATES);
        $CI->db->order_by("state_name_en", 'ASC');
        $CI->db->order_by("state_name_hi", 'ASC');
        $query = $CI->db->get();
        $states =  $query->result();
        return $states;
    }
	
	
	/*start get file panji no -Rohit*/
	//get section code from section master table
	function get_section_code($sectionid = null) {
		$CI = & get_instance();
		$CI->db->select('section_code');
		$CI->db->where('section_id', $sectionid);
		$CI->db->from(SECTIONS);
		$query = $CI->db->get();
		$row = $query->row();    // echo $CI->db->last_query();
		return  $row->section_code;
    }
	
	// return full section genrated number if not genrated return blank
	function get_panji_no($file_id, $file_section, $file_creatae_date){
	
		$file_section_number = @getfilesec_id_byfileid($file_id,$file_section);
		if($file_section_number){
            return  $file_section_number."/21-".get_section_code($file_section)."/".get_date_formate($file_creatae_date,'Y');
		} else{
			return '';
		}
		
	}
	
	/* file message -Rohit modify by raginee 15 april 2016*/
	function file_not_receive_message($name, $role , $emp_gender = null){
	if($emp_gender != null){
	if($emp_gender == 'm'){ $gender = 'श्री'; } if($emp_gender == 'f'){	$gender ='सुश्री'; }
		return "<span class='text-danger'>".$role." <b>".$gender." ".$name."</b> की ओर से प्राप्त नहीं की गई|</span>";
	}else{ return "<span class='text-danger'>".$role." <b>".get_emp_gender($name)." ".$name."</b> की ओर से प्राप्त नहीं की गई|</span>";}
	}

	function file_closed_receive_message($name, $role, $type , $emp_gender = null){
	if($emp_gender != null){
	if($emp_gender == 'm'){ $gender = 'श्री'; } if($emp_gender == 'f'){	$gender ='सुश्री'; }
	return "<span class='text-info'>".$role." <b>".$gender." ".$name."</b> के द्वारा बंद किया गया|</span>";
	}else{ return "<span class='text-info'>".$role." <b>".get_emp_gender($name)." ".$name."</b> के द्वारा बंद किया गया|</span>"; }
	}

	function file_receive_message($name, $role , $emp_gender = null){
	if($emp_gender != null){
		if($emp_gender == 'm'){ $gender = 'श्री'; } if($emp_gender == 'f'){	$gender ='सुश्री'; }
	return "<span class='text-success'>".$role." <b>".$gender." ".$name."</b> की ओर से प्राप्त  की गई|</span>";
	}else{ return "<span class='text-success'>".$role." <b>".get_emp_gender($name)." ".$name."</b> की ओर से प्राप्त  की गई|</span>"; }
	}

	function file_working_message($name, $role , $emp_gender = null){
	if($emp_gender != null){
		if($emp_gender == 'm'){ $gender = 'श्री'; } if($emp_gender == 'f'){	$gender ='सुश्री'; }
	return "<span class='text-warning'>".$role." <b>".$gender." ".$name."</b> के द्वारा कार्य किया जा रहा है</span>";
	}else{ return "<span class='text-warning'>".$role." <b>".get_emp_gender($name)." ".$name."</b> के द्वारा कार्य किया जा रहा है</span>"; }
	}
	
	function get_emp_gender($name){
		$emp_id = get_emp_id($name);
		$CI = & get_instance();
		$CI->db->select('emp_detail_gender');
		$CI->db->where('emp_id',$emp_id );
		$CI->db->from(EMPLOYEE_DETAILS);
		$query = $CI->db->get();
		$row = $query->row();   
		// echo $CI->db->last_query();
		$gender =  $row->emp_detail_gender;
		if($gender == 'm'){
			return 'श्री';			
		}
		if($gender == 'f'){
			return 'सुश्री';			
		} else {
			return '';	
		}
	}
	
	
	function get_emp_id($name){
		$CI = & get_instance();
		$CI->db->select('emp_id');
		$CI->db->where('emp_full_name_hi', $name);
		$CI->db->from(EMPLOYEES);
		$query = $CI->db->get();
		$row = $query->row();   
		// echo $CI->db->last_query();
		return $row->emp_id;
		
	}
		
	function sectionunit_user() {
		$select_unit = array(
			'1' => '51',
			'2' => '51',
			'7' => '51',
			'8' => '51',
			'10' => '51',
			'11' => '51',
			'12' => '59',//'51',
			'13' => '51',
			'14' => '51',
			'15' => '51',
			'16' => '54', // drafting -> ps //56 now 54 Additional secretary
			'17' => '59',
			'18' => '51', // vetting english -> ps //56
			'19' => '59', //61
			'20' => '60', // translation -> ad
			'21' => '51',
			'22' => '51',
			'23' => '60', //ad
			'25' => '51',
			'26' => '51',
			'27' => '59',
			'28' => '60',
		);
		return $select_unit;
	}

	function file_sub_type(){
		return array(
			'Rules',
			'Regulations',
			'Statues',
			'Notice',
			'Order',
		);
	}
	
	/* Send sms -Rohit */
	function send_sms($mobile_numbers, $content) { 
           function post_to_url($url, $data) {
           $fields = '';
           foreach($data as $key => $value) { 
              $fields .= $key . '=' . $value . '&'; 
           }
           rtrim($fields, '&');

           $post = curl_init();

           curl_setopt($post, CURLOPT_URL, $url);
           curl_setopt($post, CURLOPT_POST, count($data));
           curl_setopt($post, CURLOPT_POSTFIELDS, $fields);
           curl_setopt($post, CURLOPT_RETURNTRANSFER, 1);

           echo $result = curl_exec($post);

           curl_close($post);
        }

        $data = array(
           "username" => "DITMP-MPLSWD",	             // type your assigned username here(for example:                  "username" => "CDACMUMBAI")
 
           "password" => "lladbho#123",	             //type your password

           "senderid" =>"MPLAWD",	             //type your senderID

           "smsservicetype" =>'bulkmsg',         //*Note*  for single sms enter  ”singlemsg” , for bulk   		enter “bulkmsg”

           "mobileno" =>'mobileno',              //enter the mobile number 

           "bulkmobno" => $mobile_numbers,		//enter the mobile numbers separated by commas, in case of bulk sms otherwise leave it blank

           "content"  => urlencode($content)	             //type the message.
            
        );

        $ret = post_to_url("http://msdgweb.mgov.gov.in/esms/sendsmsrequest", $data);
		if($ret) { 
			echo  'Mesdsage send successfully!';
		}
    }
function section_section_name() {
    $mark_secnm = array(
        '1' => '0',
        '2' => '0',
        '7' => '0',
        '8' => '0',
        '10' => '0',
        '11' => '0',
        '12' => '0',
        '13' => '0',
        '14' => '0',
        '15' => '0',
        '16' => '20', // drafting file move to Translation
        '17' => '0',
        '18' => '28', // vetting english move to vetting hindi
        '19' => '0',
        '20' => '16',
        '21' => '0',
        '22' => '0',
        '23' => '0',
        '25' => '0',
        '26' => '0',
        '27' => '0',
        '28' => '18',
    );
    return $mark_secnm;
}
	/* SECTION FILE categories -Rohit */
	function judicial_branch1($ishindi = false){
		$cat = array(
			1 => 'CM Monite',
			2 => 'CS Monite',
			3 => 'Genral',
		);	
		$cat_hi = array(
			1 => 'CM Monite',
			2 => 'CS Monite',
			3 => 'Genral',
		);	
		if($ishindi){
			return $cat_hi;
		}else {
			return $cat;
		}
		
	}
	
	function judicial_branch2($ishindi = false){
		$cat = array(
			1 => 'RTI',
			2 => 'Vidhan sabha',
			3 => 'Genral',
			4 => 'Mahadhivakta',
			5 => 'CM Monite',
		);	
		$cat_hi = array(
			1 => 'RTI',
			2 => 'विधान सभा',
			3 => 'जनरल',
			4 => 'महाधिवक्ता',
			5 => 'CM Monite',
		);	
		if($ishindi){
			return $cat_hi;
		}else {
			return $cat;
		}
		
	}
	
	function building_name($ishindi = false){
		$name = array(
			1 => 'Vallabh Bhawan',
			2 => 'Vindhyanchal Bhawan',
			3 => 'Satpura Bhawan',	
		);	
		$name_hi = array(
			1 => 'वल्लभ भवन',
			2 => 'सतपुरा भवन',
			3 => 'विंध्यांचल भवन',		
		);	
		if($ishindi){
			return $name_hi;
		}else {
			return $name;
		}
	}
	
	function building_floor($ishindi = false){
		$name = array(
			1 => 'Ground floor',
			2 => 'First floor',
			3 => 'Second floor',	
			4 => 'Third floor',	
			5 => 'Fourth floor',	
			6 => 'Fifth floor',				
		);	
		$name_hi = array(
			1 => 'तलघर',
			2 => 'प्रथम तल',
			3 => 'द्रितीय तल',		
			4 => 'तृतीय तल',		
			5 => 'चतुर्थ तल',		
			6 => 'पंचम तल',		
		);	
		if($ishindi){
			return $name_hi;
		}else {
			return $name;
		}
	}
	
	function section_to_sectionmove($file_id,$mark_emp,$file_sectionid,$file_remark = null) {
    $CI = & get_instance();
    if (isset($file_id) && $mark_emp != '' && $file_sectionid != '') {
        $filedetails =  getFileDetails($file_id);

        $empdetails = empdetails(emp_session_id());
        $empdetails2 = empdetails($mark_emp);

        if($filedetails->file_from_section_id == $file_sectionid){
            $file_return = '1';
        }else{
            $file_return = '0';
        }

        $file_data = array(
            'file_received_emp_id' => $mark_emp,
            'file_sender_emp_id' => emp_session_id(),
            'file_hardcopy_status' => 'not',
            'file_update_date' => date('Y-m-d H:i:s'),
            'file_mark_section_id' => $file_sectionid,
            'file_mark_section_date' => date('Y-m-d H:i:s'),
            //'file_unit_level' => getunitid($empdetails2[0]['role_id']),
            'file_unit_level' => getunitid($empdetails2[0]['role_id'])==''?0:getunitid($empdetails2[0]['role_id']),
          //  'file_return' => $file_return,
            'file_return' => '0',
            'file_from_section_id' => $filedetails->file_mark_section_id
        );

        if($file_remark != ''){
            $remark = $file_remark;
        }else{
            $remark = '';
        }
        $filelog_data = array(
            'file_id' => $file_id,
            'section_id' => $file_sectionid,
            'to_emp_id' => $mark_emp,
            'from_emp_id' => emp_session_id(),
            'flog_other_remark' => $remark,
            'flog_ip_address' => gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR'])),
            'flog_browser_id' => $_SERVER['HTTP_USER_AGENT'],
            'sublogin' => $CI->session->userdata('emp_id'),
			'emp_degignation_id' => checkUserrole()
        );

        $form_data_move1 = array(
            'fmove_file_id'  => $file_id,
            'fmove_current_user_id'  => $mark_emp,
            'fmove_previous_user_id' => emp_session_id(),
			'fmove_to_unit_id'       => getunitid($empdetails2[0]['role_id'])==''?0:getunitid($empdetails2[0]['role_id']),
            'fmove_from_unit_id'     => getunitid($empdetails[0]['role_id'])==''?0:getunitid($empdetails[0]['role_id']),
            'fmove_sectionid_to'       => $file_sectionid,
            'fmove_sectionid_from'     => $filedetails->file_mark_section_id,
            //'file_return'     => $file_return,
            'file_return'     => '0',
        );

        $res1 = updateData(FILES, $file_data, array('file_id' => $file_id));
        if ($res1) {
            insertData($filelog_data, FILES_LOG);
            insertData($form_data_move1, FILES_MOVEMENT);
        }
        return $file_id;
    }
}
function so_by_roleandsection() {
    $select_role = array(
        '1' => '8',
        '2' => '8',
        '7' => '8',
        '8' => '8',
        '10' => '8',
        '11' => '8',
        '12' => '37',
        '13' => '8',
        '14' => '8',
        '15' => '8',
        '16' => '37', // drafting -> incharge
        '17' => '37',
        '18' => '8', // vetting english -> so
        '19' => '37', // 15
        '20' => '14', // AD
        '21' => '8',
        '22' => '8',
        '23' => '14', // AD
        '25' => '8',
        '26' => '8',
        '27' => '37',
        '28' => '14', // AD
    );
    return $select_role;
}
function user_byrole_section($section_id = '', $role_id){
    $CI = & get_instance();
    $employee = EMPLOYEES;
    $CI->db->select("emp_id,emp_full_name,emp_full_name_hi");
    $CI->db->from($employee);
	if($section_id != ''){
		$CI->db->where("FIND_IN_SET($section_id,emp_section_id) !=", 0);
	}
    $CI->db->where('role_id', $role_id);
    $CI->db->where('emp_status', 1);
    $CI->db->where('emp_is_retired', 0);
    $query = $CI->db->get();
	//echo $CI->db->last_query();
	if($section_id != ''){
		return  $query->row_array();
	} else{
		return  $query->result_array();
	}
}

// file lastid section no
function all_getfilesec_id_byfileid($fileid) {
    $CI = & get_instance();
    $CI->db->select('section_number,section_id');
    $CI->db->where('file_id', $fileid);
    $CI->db->order_by('file_section_id', 'DESC');
    $query = $CI->db->get(FILES_SECTION);
    // echo $CI->db->last_query();
    return $result = $query->result_array();
}

function emp_roleid($emp_id) {
    $CI = & get_instance();
    $CI->db->select('role_id');
    $CI->db->where('emp_id', $emp_id);
    $CI->db->from(EMPLOYEES);
    $query = $CI->db->get();
    $data = $query->row_array();
    return $data;
}

function file_status_withname($emp_id ,$name, $role){
    return " <b>".emp_gender($emp_id)." ".$name."</b> (".$role.")" ;
}
function emp_gender($emp_id){
    $CI = & get_instance();
    $CI->db->select('emp_detail_gender');
    $CI->db->where('emp_id',$emp_id );
    $CI->db->from(EMPLOYEE_DETAILS);
    $query = $CI->db->get();
    $row = $query->row();
    $gender =  $row->emp_detail_gender;
    if($gender == 'm'){
        return 'श्री';
    }
    if($gender == 'f'){
        return 'सुश्री';
    } else {
        return '';
    }
}

function get_total_close_file($sectionid,$desposeid,$task){
	$CI = & get_instance();
	$query9	 = $CI->db->query("SELECT * FROM `ft_files` as files inner join ft_file_dispatch as file_dispetch on file_dispetch.file_id= files.file_id and issection_despose=$desposeid WHERE files.file_mark_section_id IN ($sectionid) AND (files.file_hardcopy_status = 'close') AND files.file_return = '2'");
	$total_dispose_by_section =  $query9->result_array();
	//echo $CI->db->last_query();
	if($task=='count_total_section_despose'){
		return count($total_dispose_by_section);
	}else if($task=='count_total_dispetch_section_dispose'){
		return count($total_dispose_by_section);
	}else if($task=='individual_emp_close'){
		$query9	 = $CI->db->query("SELECT count(DISTINCT(files.file_id)) as total_dispose FROM `ft_files` as files inner join ft_file_dispatch as file_dispetch on file_dispetch.file_id=files.file_id and issection_despose=1 WHERE files.file_mark_section_id IN ($sectionid) AND (files.file_hardcopy_status = 'close') AND files.file_return = '2' and files.file_received_emp_id=$desposeid");
		$total_dispose_by_section =  $query9->row_array();
		//pre($total_dispose_by_section);
		return $total_dispose_by_section['total_dispose'];
	}else{
		return $total_dispose_by_section;
	}
}
function get_officer_emp_ids(){
	$CI = & get_instance();
	$query	 = $CI->db->query("SELECT group_concat(emp_id) as officer_id FROM `ft_employee` where `role_id` in(2,4,5,6,7)");
	$officer_usr_ids_array =  $query->row_array();
	return $officer_usr_ids_array['officer_id'];
}

function get_officer_emp_based_file_list($section_id,$desposdid,$empids,$task){
	$CI = & get_instance();
	if($task=='count_officer_base_files'){
		$query9	 = $CI->db->query("select count(file_id) as total_not_recived_file_officers FROM ft_files where `file_mark_section_id`='$section_id' and `file_return` !='2' and (file_hardcopy_status = 'not') and file_received_emp_id in ($empids)");
		$total_dispose_by_section =  $query9->row_array();
	}else if($task=='count_section_base_files'){
		$query9	 = $CI->db->query("select count(file_id) as total_not_recived_file_in_section FROM ft_files where `file_mark_section_id`='$section_id' and `file_return` !='2' and (file_hardcopy_status = 'not') and file_received_emp_id not in ($empids)");
		$total_dispose_by_section =  $query9->row_array();
	}else if($task=='officer_base_file_list'){
		$query9	 = $CI->db->query("select count(file_id) as total_not_recived_file FROM ft_files where `file_mark_section_id`='$section_id' and `file_return` !='2' and (file_hardcopy_status = 'not') and file_received_emp_id not in ($empids)");
		$total_dispose_by_section =  $query9->result_array();
	}else if($task=='section_base_file_list'){
		$query9	 = $CI->db->query("select count(file_id) as total_not_recived_file FROM ft_files where `file_mark_section_id`='$section_id' and `file_return` !='2' and (file_hardcopy_status = 'not') and file_received_emp_id not in ($empids)");
		$total_dispose_by_section =  $query9->result_array();
	}else if($task=='total_file_from_CR'){
		$sql_cr="SELECT group_concat(emp_id) as cr_emp FROM `ft_employee` WHERE emp_section_id ='1'";
		$cr_emp_ids =  $sql_cr->row_array();
		pre($cr_emp_ids);
		$query9	 = $CI->db->query("SELECT * FROM `ft_files` where file_mark_section_id='$section_id'and file_sender_emp_id in (".$cr_emp_ids['cr_emp'].")");
		$total_cr_section_file =  $query9->result_array();
		pre($total_cr_section_file);
	}
	//echo $CI->db->last_query();
	return $total_dispose_by_section;	
}
function total_work_by_officer_emp($task,$empid,$sectionid,$limit=null,$page=null){
    $CI = & get_instance();
    if($task=='count_total_file_works'){
        $query9  = $CI->db->query("SELECT count(movefile.fmove_file_id)as total_file_works FROM `ft_file_movements` as movefile INNER JOIN ft_files as files on movefile.fmove_file_id=files.file_id where movefile.fmove_current_user_id=$empid");
        return $query9->row_array();
    }if($task=='total_pending_file'){
        $query9  = $CI->db->query("SELECT count(movefile.fmove_file_id)as total_pending_file FROM `ft_file_movements` as movefile INNER JOIN ft_files as files on movefile.fmove_file_id=files.file_id and (files.file_hardcopy_status='received' or files.file_hardcopy_status='working' or files.file_hardcopy_status='not') where movefile.fmove_current_user_id=$empid");
        return $query9->row_array();
    }else if($task=='total_complete_file'){
        $query9  = $CI->db->query("SELECT count(*) as total_close_file FROM `ft_file_movements` as movefile INNER JOIN ft_files as files on movefile.fmove_file_id=files.file_id and (files.file_hardcopy_status='close') where movefile.fmove_current_user_id=$empid");
        return $query9->row_array();
    }
    else if($task=='list_of_working_file_by_us'){
        $query9  = $CI->db->query("SELECT fmove_file_id, count(fmove_file_id) as time_of_work FROM `ft_file_movements` where fmove_current_user_id=$empid GROUP by fmove_file_id");
        return $query9->result_array();
    }else if($task=='list_of_all_files_deals_by_user'){
		if(isset($_GET['searchby']) && $_GET['searchby']!=''){
            $searchval=trim($_GET['searchby']);
            $wheres= " and (FIND_IN_SET('".$searchval."',file_all_section_no) OR file_subject like '%".$searchval."%'  OR file_uo_or_letter_no like '%".$searchval."%' OR file_uo_or_letter_date = DATE_FORMAT('".$searchval."', '%Y-%m-%d'))";
         }   
		 $query9  = $CI->db->query("SELECT * FROM `ft_file_movements` as movefile INNER JOIN ft_files as files on movefile.fmove_file_id=files.file_id where movefile.fmove_current_user_id=$empid $wheres LIMIT $limit OFFSET $page");
        return $query9->result();
		
	}else if($task=='list_of_all_files_deals_by_user_count'){		
        if(isset($_GET['searchby']) && $_GET['searchby']!=''){
            $searchval=trim($_GET['searchby']);
            $wheres= " and (FIND_IN_SET('".$searchval."',file_all_section_no) OR file_subject like '%".$searchval."%'  OR file_uo_or_letter_no like '%".$searchval."%' OR file_uo_or_letter_date = DATE_FORMAT('".$searchval."', '%Y-%m-%d'))";
         } 
        $query9  = $CI->db->query("SELECT COUNT(file_id) as totalfiles FROM `ft_file_movements` as movefile INNER JOIN ft_files as files on movefile.fmove_file_id=files.file_id where movefile.fmove_current_user_id=$empid $wheres");
        return $query9->row_array();
    }   
}
function get_file_dispos_date($task, $fid){
    $CI = & get_instance();
    $query9  = $CI->db->query("SELECT `dispatch_date` FROM `ft_file_dispatch` WHERE `file_id`=".$fid);
    return $query9->row_array();
}
function get_cr_emp_id($sectiontid){
	$CI = & get_instance();
    $query9  = $CI->db->query("SELECT group_concat(emp_id) as cr_emp_id  FROM `ft_employee` WHERE `emp_section_id` LIKE '".$sectiontid."' and emp_status=1");
    $section_emp_ids_array = $query9->row_array();
	$section_emp_ids['ids']=$section_emp_ids_array['cr_emp_id'];
	$section_emp_ids['id_array']=explode(',',$section_emp_ids_array['cr_emp_id']);
	return $section_emp_ids;
}

function getDistrict_name($district_id) {
    $CI = & get_instance();
    $CI->db->select('district_name_hi');
    $CI->db->from(DISTICT_MASTER);
    if($district_id){
         $CI->db->where('district_id',$district_id);
    }
	$CI->db->order_by('district_name_hi', 'ASC');
    $query = $CI->db->get();
    $row = $query->row();
    return $row->district_name_hi;
}

function get_cr_section_nuber($fileid) {
    $CI = & get_instance();
    $CI->db->select('section_number,section_id');
    $CI->db->where(array('file_id'=>$fileid,'section_id'=>1));
    $query = $CI->db->get(FILES_SECTION);
    // echo $CI->db->last_query();
    return $result = $query->row_array();
}

function getTaluka_name($taluka_id) {
    $CI = & get_instance();
    $CI->db->select('taluka_name_en');
	$CI->db->select('taluka_name_hi');
    $CI->db->from(TALUKA_MASTER);
    if($taluka_id){
         $CI->db->where('taluka_id',$taluka_id);
    }
	$CI->db->order_by('taluka_id', 'ASC');
    $query = $CI->db->get();
    $row = $query->row();
    return $row->taluka_name_hi.'('.$row->taluka_name_en.')';
}

//file report
function individual_reports($task, $emp_id = '', $start_date = '', $end_date = '' ){
	$CI = & get_instance();
	$today = date('d/m/Y');
	if($emp_id == ''){
		$emp_id = emp_session_id();
	}
	$tbl1 = FILES;
	$tbl2 = FILES_MOVEMENT;
	$CI->db->select('count(DISTINCT(fmove_file_id))as total_file_works');
	$CI->db->from($tbl1);
	$CI->db->join($tbl2, "$tbl2.fmove_file_id = $tbl1.file_id", 'left');
	
	if($start_date != '' && $end_date != ''){
		$CI->db->where("DATE_FORMAT(`fmove_created_datetime`, '%d-%m-%Y') >= '$start_date'");
		$CI->db->where("DATE_FORMAT(`fmove_created_datetime`, '%d-%m-%Y') <= '$end_date'");
	}
	switch($task){
		case 'total_worked':
			//$query9  = $CI->db->query("SELECT count(movefile.fmove_file_id)as total_file_works FROM `ft_file_movements` as movefile INNER JOIN ft_files as files on movefile.fmove_file_id=files.file_id where movefile.fmove_current_user_id=$empid");
			$CI->db->where("$tbl2.fmove_current_user_id", $emp_id);
		break;
		case 'total_pending':
			//$query9  = $CI->db->query("SELECT count(movefile.fmove_file_id)as total_pending_file FROM `ft_file_movements` as movefile INNER JOIN ft_files as files on movefile.fmove_file_id=files.file_id and (files.file_hardcopy_status='received' or files.file_hardcopy_status='working' or files.file_hardcopy_status='not') where movefile.fmove_current_user_id=$empid");
			$CI->db->where("$tbl1.file_hardcopy_status !=", 'close');
			$CI->db->where("$tbl2.fmove_current_user_id", $emp_id);
		break;
		case 'total_complete':
			//$query9  = $CI->db->query("SELECT count(*) as total_close_file FROM `ft_file_movements` as movefile INNER JOIN ft_files as files on movefile.fmove_file_id=files.file_id and (files.file_hardcopy_status='close') where movefile.fmove_current_user_id=$empid");
			$CI->db->where("$tbl1.file_hardcopy_status", 'close');	
			$CI->db->where("$tbl2.fmove_current_user_id", $emp_id);
			break;
		case 'working':
			//$query9  = $CI->db->query("SELECT fmove_file_id, count(fmove_file_id) as time_of_work FROM `ft_file_movements` where fmove_current_user_id=$empid GROUP by fmove_file_id");
			//$CI->db->where("$tbl1.file_received_emp_id", $emp_id);
			$CI->db->where("$tbl2.fmove_current_user_id", $emp_id);
			break;
		case 'worked':
			//$query9  = $CI->db->query("SELECT * FROM `ft_file_movements` as movefile INNER JOIN ft_files as files on movefile.fmove_file_id=files.file_id where movefile.fmove_current_user_id=$empid");
			//$CI->db->where("($tbl1.file_hardcopy_status = 'receive')");
			$CI->db->where("$tbl2.fmove_previous_user_id", $emp_id);
		break;
		case 'not_receive':
			//$query9  = $CI->db->query("SELECT fmove_file_id, count(fmove_file_id) as time_of_work FROM `ft_file_movements` where fmove_current_user_id=$empid GROUP by fmove_file_id");
			$CI->db->where("$tbl1.file_received_emp_id", $emp_id);
			$CI->db->where("$tbl1.file_hardcopy_status",'not');
			break;
		case 'received':
			//$query9  = $CI->db->query("SELECT * FROM `ft_file_movements` as movefile INNER JOIN ft_files as files on movefile.fmove_file_id=files.file_id where movefile.fmove_current_user_id=$empid");
			$CI->db->where("$tbl1.file_hardcopy_status",'received');
			$CI->db->where("$tbl2.fmove_previous_user_id", $emp_id);
		break;
		default : 
			
		break;
	}
	$query = $CI->db->get();
	//echo $CI->db->last_query();
	return $query->row_array();
}

function get_total_cr_dispetch_files($task,$sectionid){
	$CI = & get_instance();
    
	$query1  = $CI->db->query("SELECT count(*) as total_close_files FROM `ft_files` WHERE `file_hardcopy_status` ='close' and file_return='2'");
    $recods= $query1->row_array();
	
	$query2  = $CI->db->query("SELECT count(*) as pending_for_dispetch_section_files FROM `ft_files` WHERE `file_hardcopy_status` !='close' and file_return='2'");
    $recods2= $query2->row_array();
	$dispetch_file['total_dispetched_file']=$recods['total_close_files'];
	$dispetch_file['total_dispetch_pending_file']=$recods2['pending_for_dispetch_section_files'];
	return $dispetch_file;
}

// use for add update report table  - Rohit 17-12-2015
function add_report($data){
	$CI = & get_instance();
    $row = $CI->db->insert(REPORTS, $data);
    return $row;
}

function update_report($id, $data){
	$CI = & get_instance();
    $CI->db->where('report_id', $id);
    $check = $CI->db->update(REPORTS, $data);
    return $check;
}

function get_report($condition = '', $id = ''){
		$CI = & get_instance();
		$CI->db->select('*');
		if($condition != ''){
			$CI->db->where('report_name', $condition);
		} else if($id != ''){
			$CI->db->where('report_id', $id);
		}
		$CI->db->from(REPORTS);
		$query = $CI->db->get();
		return  $query->row();   
		// echo $CI->db->last_query();
}

function check_ps_monitor_file_is_alloted($task,$empid){
    $CI = & get_instance();
    $file_ids_array=array();
    $results=null;
    $query1  = $CI->db->query("SELECT group_concat(file_id) as file_id FROM ft_files as files WHERE files.file_hardcopy_status!='close' and files.file_return!='2' and files.ps_moniter_date!='' and files.ps_moniter_date!='0000-00-00'");
    $recods= $query1->row_array();
    $file_ids = $recods['file_id'];
    if(isset($file_ids) && $file_ids!=''){
        $query2  = $CI->db->query("SELECT DISTINCT(fmove_file_id) FROM `ft_file_movements` where (fmove_current_user_id = $empid OR fmove_previous_user_id=$empid) and fmove_file_id in ($file_ids)");
        $file_recods= $query2->result_array();
        if($task=='count'){
              $results= $query2->num_rows();
        }else{
            $file_recods_list= $query2->result_array();
            foreach ($file_recods_list as $fkey => $fvalue) {
                 $file_ids_array[] = $fvalue['fmove_file_id'];
            }
            $results=$file_ids_array;
        }
    }else{
         $results= 0;
    }
    return $results;
}


function check_ps_monitor_marquee($empid){
    $CI = & get_instance();
    $results=null;
    $query1  = $CI->db->query("SELECT file_id FROM ft_files as files WHERE files.file_hardcopy_status!='close' and files.file_return!='2' and files.ps_moniter_date!='' and files.ps_moniter_date!='0000-00-00'
 and files.file_received_emp_id = '".$empid."'");
    $results= $query1->num_rows();
    return $results;
}
function count_total_ps_monitor_files(){
    $CI = & get_instance();
    $query1  = $CI->db->query("SELECT count(file_id) as totals FROM ft_files as files WHERE files.file_hardcopy_status!='close' and files.file_return!='2' and files.ps_moniter_date!='' and files.ps_moniter_date!='0000-00-00'");
    $recods= $query1->row_array();
    return $recods['totals'];
}
function str_unicode($message){
    header('Content-Type: text/html; charset=UTF-8');
    $finalmessage = "";
    $sss = "";
    for($i=0;$i<mb_strlen($message,"UTF-8");$i++) {
    $sss=mb_substr($message,$i,1,"utf-8");
    $a=0;
    $abc="&#" .ordutf8($sss,$a).";";
    $finalmessage.=$abc;
    }
    return $finalmessage;
    
}

function ordutf8($string, &$offset){
    $code=ord(substr($string, $offset,1));
    if ($code -->= 128)   //Please reomve -- symbol for this line                       
    {        //otherwise 0xxxxxxx
    if ($code < 224) $bytesnumber = 2;                //110xxxxx
    else if ($code < 240) $bytesnumber = 3;        //1110xxxx
    else if ($code < 248) $bytesnumber = 4;    //11110xxx
    $codetemp = $code - 192 - ($bytesnumber > 2 ? 32 : 0) - ($bytesnumber > 3 ? 16 : 0);
    for ($i = 2; $i <= $bytesnumber; $i++) {
    $offset ++;
    $code2 = ord(substr($string, $offset, 1)) - 128;        //10xxxxxx
    $codetemp = $codetemp*64 + $code2;
    }
    $code = $codetemp;
    }
    return $code;
}
function file_monitor_sms_sent($task,$empid,$fid,$filemove){
    $CI = & get_instance();
    /*Check file is monitor or not*/
    $query0  = $CI->db->query("SELECT file_uo_or_letter_no,file_uo_or_letter_date,ps_moniter_date,file_mark_section_id FROM ft_files as files WHERE file_id = $fid and  files.file_hardcopy_status!='close' and files.file_return!='2' and files.ps_moniter_date!='' and files.ps_moniter_date!='0000-00-00'");
    $file_detail= $query0->row_array();
    $results_count= $query0->num_rows();
    $uodate = @$file_detail['file_uo_or_letter_date']!= '0000-00-00' ? date_format(date_create($file_detail['file_uo_or_letter_date']), 'd-m-y') : false;
    $file_uo_no = $file_detail['file_uo_or_letter_no'].'/'.$uodate;

    $ps_moniter_date = @$file_detail['ps_moniter_date']!= '0000-00-00' ? date_format(date_create($file_detail['ps_moniter_date']), 'd/m/y') : false;

    $query1  = $CI->db->query("SELECT * FROM ft_file_movements where fmove_file_id=$fid and file_return=$filemove");
    $recods= $query1->row_array();
     $results= $query1->num_rows();
     /*SMS*/
	 if($empid!=''){

     $query6  = $CI->db->query("SELECT * FROM ft_file_monitor_sms where FIND_IN_SET('".$empid."', sms_emp_id) and sms_file_id=$fid and sms_file_move=$filemove");
     $results6= $query6->num_rows();
    if($results6==0 && $results_count>0){
        $query4  = $CI->db->query("SELECT emp_id,emp_full_name,emp_full_name_hi,emp_mobile_number FROM ft_employee where emp_status=1 and emp_is_retired =0 and emp_id=$empid");
        $emp_detail = $query4->row_array();

        $loopemp = get_move_empid_file($fid,emp_session_id(),$file_detail['file_mark_section_id']);

	   foreach($loopemp as $keyemp => $loopemp1){
            $sms_empno[] = $loopemp1['emp_mobile_number'];
            $emp_id1[] = $loopemp1['fmove_current_user_id'];
        }
        if(in_array($emp_detail['emp_id'],$emp_id1)){
        $mobile_numbers = implode(',',$sms_empno);
            $emp_id2 = implode(',',$emp_id1);
            $empid = $emp_id2;
        }else{
            $mobile_numbers= $emp_detail['emp_mobile_number'];
        }
        //$mobile_numbers= '9893910866';
       $content = 'File added in PS monitor. File UO no/date: '.$file_uo_no.' and PS monitor due date is '.$ps_moniter_date;
        // $content = 'File UO no/date: '.$file_uo_no.' is added in PS monitor and date is '.$ps_moniter_date;
        //$content = str_unicode('पि.एस मॉनिटर में नई फाइल जोड़ी गई हैं');
        //$content = str_unicode('पि.एस मॉनिटर में नई फाइल जोड़ी गई हैं फाइल UO न.-'.$file_uo_no);

         send_sms($mobile_numbers, $content);
        $sms_data = array(
            'sms_file_id'  => $fid,
            'sms_emp_id'  => $empid,
            'sms_file_move' => $filemove,
            'sms_text'=>$content,
        );

        insertData($sms_data,'ft_file_monitor_sms');
    }   
}
}
function check_file_exist_or_not(){
    if(isset($_GET['fmerge_type']) && $_GET['fmerge_type']!='' && $_GET['fnumber']!=''){
        $CI = & get_instance();
        if(isset($_GET['fmerge_type']) && $_GET['fmerge_type']=='fid'){
            $query1  = $CI->db->query("SELECT file_id FROM ft_files where file_id=".$_GET['fnumber']);
            $recods= $query1->row_array();
            $results= $query1->num_rows();
            if(count($results)>0){
                $response= getFiledata($recods['file_id']);
            }else{
                $response= 'not_found';
            }
        }else if(isset($_GET['fmerge_type']) && $_GET['fmerge_type']=='sno'){
            $query155  = $CI->db->query("SELECT file_id FROM ft_files_section where  section_id=".$_GET['secid']." and section_number=".$_GET['fnumber']);
            $recods= $query155->row_array();
            $results= $query155->num_rows();
            pre($results);
            if(count($results)>0 && !empty($results)){
                $response= getFiledata($recods['file_id']);
            }else{
                $response= 'not_found';
            }
        }else if(isset($_GET['fmerge_type']) && isset($_GET['m_files_year']) && $_GET['fmerge_type']=='crno'){
            $query1  = $CI->db->query("SELECT file_id FROM ft_files_section where section_id=1 and section_number=".$_GET['fnumber']." and year(file_created_date)='".$_GET['m_files_year']."'");
            $recods= $query1->row_array();
            $results= $query1->num_rows();
            if(count($results)>0){
                $response= getFiledata($recods['file_id']);
            }else{
                $response= 'not_found';
            }
        }
    }
    return $response;
}


	//provide setting output 
	function get_settings($key){
		$CI = & get_instance();
		$CI->db->select("set_value");
        $CI->db->from(SETTINGS);
        $CI->db->where("set_key",$key);        
        $query = $CI->db->get();
		//echo $CI->db->last_query();
		if($query->num_rows() > 0){
			return $query->row_array();
		} else{
			return false;
		}
	}
	
	function add_settings($key, $value){
		$CI = & get_instance();
		$data = array(
			'set_key' => $key,
			'set_value' => $value,
		);
		if(get_settings($key)) {
			$res = insertData($data, SETTINGS);
		} else {
			$res = false;
		}
		if($res){
			return true;
		} else{
			return false;
		}
	}
	
	//provide setting output 
	function update_settings($key, $new_value){
		$CI = & get_instance();		
		$data = array(
			'set_key' => $key,
			'set_value' => $new_value,
		);
		$res = updateData(SETTINGS, $data, array('set_key' => $key));
		return $res;
			
	}

    function get_file_cr_number($fileid) {  
        $CI = & get_instance();
        $CI->db->select('section_number');
        $CI->db->where('file_id', $fileid);
        $CI->db->where('section_id','1');
        $query = $CI->db->get(FILES_SECTION, 1);
        $result = $query->row_array();
        if (count($result) > 0) {
            return $result['section_number'];
        } else {
            return null;
        }
    }
	function show_dealing_asst_list(){
        return array(17,23,24,22,38,32,19,20,37);
    }


// upload File pdf only
function scan_file_upload($filename, $path ,$title) {
    $CI = & get_instance();
    $config = array(
        'upload_path' => $path,
        'allowed_types' => 'pdf',
        'max_size'      => '10000', //10 mb
        //'max_width'     => '1024',
        //'max_height'    => '768',
        // 'encrypt_name' => true,
        'file_name' => $title.'_'.md5(microtime().rand())
    );
    if(!is_dir($path)) //create the folder if it's not already exists
    {
        mkdir($path,0777,TRUE);
    }
    $CI->load->library('upload', $config);

    if (!$CI->upload->do_upload($filename)) {
        // $error = array('error' => $CI->upload->display_errors());
        echo "error";
        // $CI->load->view('upload_form', $error);
    } else {
        $upload_data = $CI->upload->data();
        $data_ary = array(
            'title' => $upload_data['client_name'],
            'file' => $filename,
            'width' => $upload_data['image_width'],
            'height' => $upload_data['image_height'],
            'type' => $upload_data['image_type'],
            'size' => $upload_data['file_size'],
            'date' => time(),
            'path' => $upload_data['file_path'],
            'name' => $title.'_'.$upload_data['file_name'],
        );
        return $upload_data['file_name'];

    }
}



function get_timeago( $ptime )
{
    $ptime = strtotime($ptime);
    $estimate_time = time() - $ptime;

    if( $estimate_time < 1 )
    {
        return 'less than 1 second ago';
    }

    $condition = array(
        12 * 30 * 24 * 60 * 60  =>  'year',
        30 * 24 * 60 * 60       =>  'month',
        24 * 60 * 60            =>  'day',
        60 * 60                 =>  'hour',
        60                      =>  'minute',
        1                       =>  'second'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $estimate_time / $secs;

        if( $d >= 1 )
        {
            $r = round( $d );
            return 'about ' . $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
        }
    }
}

function upload_array_files($path, $title, $files)
{
    $CI = & get_instance();
    $config = array(
        'upload_path'   => $path,
        'allowed_types' => 'pdf',
        // 'overwrite'     => 1,
        'max_size'      => '10000', //10 mb
    );
    if(!is_dir($path)) //create the folder if it's not already exists
    {
        mkdir($path,0777,TRUE);
    }
    $CI->load->library('upload', $config);
    $images = array();
    foreach ($files['name'] as $key => $image) {
        $_FILES['images[]']['name']= $files['name'][$key];
        $_FILES['images[]']['type']= $files['type'][$key];
        $_FILES['images[]']['tmp_name']= $files['tmp_name'][$key];
        $_FILES['images[]']['error']= $files['error'][$key];
        $_FILES['images[]']['size']= $files['size'][$key];

        $fileName = trim(strtolower($title[$key])) .'_'.md5(microtime().rand());
        /*$images[] = array('name' => $fileName,
            'path'=>$path
        );*/
        $config['file_name'] = $fileName;
        $CI->upload->initialize($config);

        if ($CI->upload->do_upload('images[]')) {
            $upload_details = $CI->upload->data();
        } else {
            //	echo $CI->upload->display_errors()
            echo "error";
            return false;
        }
        $path1 = substr($path, 2);
        $data_f[] = $path1."/".$upload_details['file_name'];
    }
    // return $images;
    
    return $data_f;
}
function get_emp_role_levele(){
    $CI = & get_instance();
    $role_id= get_employee_role(emp_session_id(), $id = true);
    $CI->db->select('role_id,unit_id,emprole_level,emprole_name_hi');
    $CI->db->where('role_id', $role_id);
    $query = $CI->db->get(EMPLOYEEE_ROLE);
    return $roles = $query->row_array();
}
function show_view_as_lvl(){
    $emp_role_lvl= get_emp_role_levele();
    if($emp_role_lvl['emprole_level']==6){ /*so/incharge/assistant directore*/
        return "view_file/index";
    }elseif($emp_role_lvl['emprole_level']==13){ /*Grad 1,2,3 others*/
        return "view_file/viewfile_fornotesheet";
    }elseif($emp_role_lvl['emprole_level']==1 || $emp_role_lvl['emprole_level']==2 || $emp_role_lvl['emprole_level']==3 || $emp_role_lvl['emprole_level']==4 || $emp_role_lvl['emprole_level']==5 || $emp_role_lvl['emprole_level']==7){
        return "view_file/view_file_list";
    }else{
        return "404";
    }
}

function get_emp_by_role($role_id,$section_id = null){
    $CI = & get_instance();
    if(isset($role_id)) {
        $CI->db->select('group_concat(emp_id) as emp_ids');
        $CI->db->where('role_id', $role_id);
        if ($section_id != null) {
            $where = "FIND_IN_SET('" . $section_id . "', emp_section_id)";
            $CI->db->where($where);
        }
        $qry_emp = $CI->db->get(EMPLOYEES);
        $result = $qry_emp->row_array();
        return $result['emp_ids'];
    }
}
function get_daorunder_empid($emp_id1 = null)
{
    $CI = & get_instance();
    $sessionemp = emp_session_id();
    $query =   $CI->db->query("select group_concat(under_emp_id SEPARATOR ',') as u_empid from ft_employee_hirarchi where emp_id = ".$sessionemp);
    $emp_id = $query->row_array();
    return $emp_id['u_empid'];
}
function check_eoffice() {
    $ci = & get_instance();
    $efile = show_efile_section(getEmployeeSection());
    if($efile != 'efile'){
        redirect(base_url());
    }
}
function empdetails_alloted_work()
{
	$ci = & get_instance();
    $result = $ci->db->get_where(EMPLOYEE_DETAILS, array('emp_id' => emp_session_id() ) );
    $emp_details_alloted = $result->row_array();
	return $emp_details_alloted['emp_seet_alloted_work'];
}
function get_so_incharge_of_da($empid,$sectionid){
	$CI = & get_instance();    
    $query =   $CI->db->query("select emp_id_assign_by from ft_employee_permission_alloted where epa_module_name='files' and  epa_section_id IN ($sectionid) and emp_id_assign_to = ".$empid);
    $emp_id = $query->row_array();
    if($query->num_rows() > 0) {
        return $emp_id['emp_id_assign_by'];
    }
}
function get_move_empid_file($fileid,$loginemp = null,$emp_section) {
    $CI = & get_instance();
    $table1 = FILES_MOVEMENT;
    $table2 = EMPLOYEES;
    $CI->db->select('distinct(fmove_current_user_id) , emp_mobile_number,emp_full_name');
    $CI->db->from($table1);
    $CI->db->join($table2, "$table2.emp_id = $table1.fmove_current_user_id", 'left');
    $CI->db->where($table1.'.fmove_file_id',$fileid);
    $CI->db->where($table2.'.role_id !=','9');  // 9 is cr role id
    if($loginemp != null){
        $CI->db->where($table1.'.fmove_current_user_id != ',$loginemp);
    }if(isset($emp_section)){
        $where = "FIND_IN_SET('" . $emp_section . "', emp_section_id)";
        $CI->db->where($where);
    }
    $query = $CI->db->get();
    //echo $CI->db->last_query();
    return $result = $query->result_array();
}
function get_service_record($emp_id)
{
	$CI = & get_instance();
	$CI->db->where('emp_id',$emp_id );
	$query = $CI->db->get_where(EMPLOYEE_DETAILS,array('emp_id'=>$emp_id));
	$row = $query->row_array();
	if( isset($row['emp_service_book_file']) && !empty( $row['emp_service_book_file'])){
		echo '<a target="_blank" href="'.base_url().'uploads/service_book_pdf/'.$row['emp_service_book_file'].'" >Service Book Copy</a>';	
	}
}

function get_file_log_data($file_log_id = null ,$file_id =null){
    $CI = & get_instance();
    if(!empty($file_id)){
        $file_log = FILES_LOG;
        $query = $CI->db->query( "SELECT flog_remark FROM ft_file_logs WHERE `file_id` = $file_id and section_id = 8 and flog_remark is not null ORDER BY `flog_id` DESC ");
    }else{
        $query = $CI->db->get_where(FILES_LOG ,array('flog_id'=>$file_log_id) );
    }
    //echo $CI->db->last_query();
    return $query->row_array();
}
function ps_monitor_marked_report($task = null , $today_condition = null , $empid = null){
    $CI = & get_instance();
    $today_c = '';
    $curr_emp = '';
    $userrole =$CI->session->userdata("user_role"); //checkUserrole_by_id($empid,true); use session role id

    if($today_condition == "today"){
        $today = date('Y-m-d');
        $today_c = "and ps_moniter_date!='0000-00-00' and convert(ps_moniter_date,date) <= '".$today."'";
    }
    if($empid != null && $userrole != 3){
        $curr_emp = "and file_received_emp_id = '".$empid."'";
    }
    $query1  = $CI->db->query("SELECT file_id , ps_moniter_date , file_subject FROM ft_files WHERE file_hardcopy_status != 'close' and  ps_moniter_date!=''".$today_c." ".$curr_emp." order by ps_moniter_date desc");
    $results= $query1->num_rows();
    if($results > 0 && $task == 'data'){
        $results= $query1->result_array();
    }
  //  echo $CI->db->last_query();
    return $results;
}

function ps_mark_file(){
    return array(
        '' => 'विभागीय', // key is blank because its it only for display it will not inset in database
        'cm' => 'CM',
        'cs' => 'CS',
        'fd' => 'Finance Department',
        'lm' => 'Law Minister',
        'o' => 'अन्य',
    );
}

function safe_b64encode($string) {
	$data = base64_encode($string);
	$data = str_replace(array('+', '/', '='), array('-', '_', ''), $data);
	return $data;
}
function safe_b64decode($string) {
        $data = str_replace(array('-', '_'), array('+', '/'), $string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
}	
function current_pending_files($empid = null , $only_count = false) {
    $CI = & get_instance();
    if($empid != null){
        $userid_1 = $empid;
    }else{
        $userid_1 = emp_session_id();
    }
    $curr_date = date('Y-m-d');
    $sql = "SELECT count(file_id) as files_no";
    if($only_count == false) {
        $sql .= ", SUM(IF(date(file_update_date) != '$curr_date', 1,0)) as old_file, SUM(IF(date(file_update_date) = '$curr_date', 1,0)) as today_file , SUM(IF(file_hardcopy_status != 'not', 1,0)) as received, SUM(IF(file_hardcopy_status = 'not', 1,0)) AS noterceived  ,SUM(IF(final_draft_id != '', 1,0)) AS efile";
    }
    $sql .= " FROM `ft_files` WHERE file_hardcopy_status!='close' and `file_received_emp_id`='$userid_1'";
    $query_file = $CI->db->query($sql);
    //$query_file = $CI->db->query("SELECT count(file_id) as files_no , SUM(IF(date(file_update_date) != '$curr_date', 1,0)) as old_file, SUM(IF(date(file_update_date) = '$curr_date', 1,0)) as today_file , SUM(IF(file_hardcopy_status != 'not', 1,0)) as received, SUM(IF(file_hardcopy_status = 'not', 1,0)) AS noterceived  ,SUM(IF(final_draft_id != '', 1,0)) AS efile FROM `ft_files` WHERE file_hardcopy_status!='close' and `file_received_emp_id`='$userid_1'");
    //echo $CI->db->last_query();
    $marked_file = $query_file->row_array();
    return $marked_file;
}
//for ebable disposse button
function enable_dispose($list = null){
	$enable_array = array(''); //for 'cr'=> 'cr', 'csu'=> 'csu'  for null => '' 
    $list_array = explode(',',$list);
	if(array_intersect($list_array ,$enable_array)){
		return true;
	}
}
function get_file_remak($task,$fileid,$login_id){
	$CI = & get_instance();
	$tbl = 'ft_'.FILES_LOG;
	if($task=='single_file_log'){
		$sql_log = "SELECT flog_other_remark FROM $tbl where to_emp_id=$login_id and from_emp_id=$login_id and file_id=$fileid and flog_other_remark!='' and flog_type=1 order by flog_id desc";
		$file_log = get_row($sql_log);
		return $file_log;
	}if($task=='cr_view_remark'){
		$sql_log = "SELECT flog_other_remark FROM $tbl where to_emp_id=$login_id and file_id=$fileid and flog_other_remark!='' and flog_type=2 order by flog_id desc";
		$file_log = get_row($sql_log);
		return $file_log;
	}
}
 /* create by  sulbha 19-05-2016 */
function get_all_filesection_no($fileid) {
    $CI = & get_instance();
    $CI->db->select('group_concat(section_number) as section_no');
    $CI->db->where('file_id', $fileid);
    $query = $CI->db->get(FILES_SECTION);
  
    return $result = $query->row_array();
}

function update_file_tbl_for_section_no($fileid = null)
{
	$filesection_no = get_all_filesection_no($fileid);
	$file_sectionno = $filesection_no['section_no'];
	if(!empty($file_sectionno)){
		$CI = & get_instance();
		$CI->db->where('file_id', $fileid);
		$data['file_all_section_no'] = $file_sectionno ;
		$check = $CI->db->update(FILES, $data);
		//echo "sdf ".$CI->db->last_query();
		return $check;
	}
						
}

function show_current_url(){
    $CI =& get_instance();
    $url = $CI->config->site_url($CI->uri->uri_string());
    return $_SERVER['QUERY_STRING'] ? $url.'?'.$_SERVER['QUERY_STRING'] : $url;
}
function reset_back_url(){
    $CI =& get_instance();
    $url = $CI->config->site_url($CI->uri->uri_string());
	$a_url = $url.'?'.$_SERVER['QUERY_STRING'];
	$is_nd_fined =strstr($a_url, '&');
	if($is_nd_fined){
		$array_url = explode("&",$a_url);
	}else{
		$array_url = explode("?",$a_url);
	}
	$matches  = preg_grep('/^searchby=(\w+)/i', $array_url);	
	if(isset($matches) && !empty($matches)){						
		foreach($matches as $ky=>$val){	
			$rmkey = $ky;					
		}
		unset($array_url[$rmkey]);		
	}	
	//return $array_url[0];
	return $array_url = implode("&",$array_url);
    //return $_SERVER['QUERY_STRING'] ? $url.'?'.$_SERVER['QUERY_STRING'] : $url;
}

function paging_url(){
    $CI =& get_instance();    
    $a_url = show_current_url();   
    $is_nd_fined =strstr($a_url, '&');
    if($is_nd_fined){
        $array_url = explode("&",$a_url);
    }
	//else{
      //  $array_url = explode("?",$a_url);
    //}
    $matches  = preg_grep('/^per_page=(\w+)/i', $array_url);    
     if(isset($matches) && !empty($matches)){                        
        foreach($matches as $ky=>$val){ 
            $rmkey = $ky;                   
            unset($array_url[$rmkey]);      
        }        
    }
    $array_url = implode("&",$array_url);
    if($array_url==''){
        $array_url=$a_url;
    }      
    return $array_url;
    //return $_SERVER['QUERY_STRING'] ? $url.'?'.$_SERVER['QUERY_STRING'] : $url;
}


function get_log($aaa) {
    
    $CI = & get_instance();
    
    $bbb1 = memory_get_usage();
    
    $bbb1 = $bbb1 / 1000000;
    
    $bbb1mb="MB";
    
    $bbb1 = round($bbb1,2);
    
    $aaa1 = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];
    
    $aaa = round($aaa1, 2);
    
    $sessionemp = $CI->session->userdata['emp_id'];
    
    $path = APPPATH.'/../LOG_DATA/';
    
    $date22 = date('Y_m_d').'.';
        
   $filename = $path.'logger_url_'.$date22.'txt';
    
    $file = fopen($filename,'a');
    
    $emp_name = $CI->session->userdata['emp_full_name_hi'];
    
    $ipaddresss = gethostbyname(gethostbyaddr($_SERVER['REMOTE_ADDR']));
    
    $writecontent = 'TIME-'.date('H_i_s')." >>> ".'IP-'.$ipaddresss." >>> ".'EMP_ID-'.$sessionemp.' >>> URL-'.current_url().' >>> LOAD_TIME-'.$aaa.' >>> MEMORY-'.$bbb1.$bbb1mb.' >>> NAME-'.$emp_name.PHP_EOL;
    
    if(current_url()!=base_url()."e_filelist/ajax_count_inbox")
    {
    fwrite($file,$writecontent);
    }
    
    fclose($file); 
            
}


function per_page_listing(){
$CI = & get_instance();
$per_page_entry = ($CI->session->userdata('per_page_entry')!=NULL) ? ($CI->session->userdata('per_page_entry')) : '10';
$ety_per =	'<label class="pull-left">Show <select id="pre_page_entry" name="pre_page_entry">';
$ety_per .= '<option value="10"';
$ety_per .= $per_page_entry == '10' ? 'selected' : false ;
$ety_per .= '>10</option>';
$ety_per .= '<option value="25"';
$ety_per .= $per_page_entry == '25' ? 'selected' : false ;
$ety_per .= '>25</option>';
//$ety_per .= '<option value="50"';
//$ety_per .= $per_page_entry == '50' ? 'selected' : false ;
//$ety_per .= '>50</option>';
if(isset($CI->session->userdata['emp_section_id']) && $CI->session->userdata['emp_section_id']==1){
//$ety_per .= '<option value="100"';
//$ety_per .= $per_page_entry == '100' ? 'selected' : false ;
//$ety_per .= '>100</option>';	
}
$ety_per .= '</select> entries</label>';
return $ety_per;
}
function get_advo_notary_list(){
		  $CI = & get_instance();
		$advo_notary_list = get_rows("select adm_name,adm_id from ft_advocate_name_master where adm_active='y'");
		
		return $advo_notary_list;
	}
/* create by  sulbha 19-05-2016  END */
function get_section_shorting($task,$sectonid){
	$CI = & get_instance();
	if($task=='section_shortid'){	
	$query1  = $CI->db->query("SELECT section_id,section_grouping from ft_sections_master WHERE section_id='".$sectonid."'");
    return $recods= $query1->row_array();
	}
}

function logged_emp_is_permission(){
    $CI = & get_instance();
    $curr_emp = $CI->session->userdata("emp_id");
    $CI->db->select('emp_id_assign_by,emp_id_assign_to,epa_section_id,epa_designation_id');
    $CI->db->where('emp_id_assign_to', $curr_emp);
    $CI->db->where('epa_module_name', 'files');
    $CI->db->from(EMPLOYEE_PERMISSION_ALLOTED);
    $query = $CI->db->get();
    if($query->num_rows() != 0){
        return  $query->row_array();
    }else{
        return  false;
    }
}


function get_file_section($file_id = null){
    $CI = & get_instance();
    $CI->db->select('file_mark_section_id');
    $CI->db->from(FILES);
    $query = $CI->db->get();
    if($query->num_rows() != 0){
        return  $query->row_array();
    }else{
        return  false;
    }
}


function english_template($template_id = null)
{
	$english_temp_arr = array(21,51,68,67);
	if(in_array($template_id,$english_temp_arr)){
		 return "EN";
	}else{
		 return "HI";
	}
	 
}

function employees_class($type = null){
		$list = array(
			1 => 'Class - I',
			2 => 'Class - II',
			3 => 'Class - III',
			4 => 'Class - IV',
			5 => 'Officer'
		);
		if (array_key_exists($type, $list)) {
			return $list[$type];
		} else {
			return $list;
		}
	}
	function get_report_type($type = null){
		$list = array(
			'n' => 'उपस्थिति रिपोर्ट',
			'l' => 'उपस्थिति विलम्ब रिपोर्ट'
		);
		if (array_key_exists($type, $list)) {
			return $list[$type];
		} else {
			return $list;
		}
	}
	
	function get_panji_no_for_dispetch($file_section_number, $file_section, $file_creatae_date){
	
		
		if($file_section_number){
            return  $file_section_number."/21-".get_section_code($file_section)."/".get_date_formate($file_creatae_date,'Y');
		} else{
			return '';
		}
		
	}
	function show_dpf_gpf_status($status){
    if($status == '1'){
echo '<small class="label label-primary">  आवेदन आपके स्तर पर है |</small>';
    }elseif($status == '2'){
        echo '<small class="label label-success">  आवेदन स्थापना शाखा में भेजा गया  |</small>';
    }elseif($status == '3'){
        echo '<small class="label label-info">  कार्यवाही की जा रही  |</small>';
    }elseif($status == '4'){
        echo '<small class="label label-default">  आवेदन को अस्वीकार किया गया |</small>';
    }elseif($status == '5'){
        echo '<small class="label label-primary">  क्लोज</small>';
    }elseif($status == '6'){
        echo '<small class="label label-default">  ---</small>';
    }else{
        echo '';
    }
}

function dispaly_application_on_file($relationid = null){
    $CI = & get_instance();
    $CI->db->select('*');
    $CI->db->where('relation_id', $relationid);
    $CI->db->from('ft_est_module_relation');
    $query = $CI->db->get();
    if($query->num_rows() != 0){
        $data12 =  $query->row_array();
        if($data12['relation_module_table'] == 'ft_pay_dpf_yearly_amount'){
            $id = 'pay_id' ;
        }else{
            $id = 'id' ;
        }
        $query = $CI->db->query("SELECT * from ".$data12['relation_module_table']." where $id = '".$data12['relation_application_id']."' limit 1");
        $res_array1 =  $query->row_array();
        return $res_array1;
    }else{
        return  false;
    }
}
function get_est_mat_attachment($masterid = null){
    $CI = & get_instance();
    if($masterid != null){
        $query = $CI->db->query("SELECT * from ft_est_master_attachments where attach_master_id = $masterid");
        $res_array1 =  $query->result_array();
        return $res_array1 ;
    }else{
        return false ;
    }
} 

function get_civil_judge_character_cer($judge_id = null )
{
	$CI = & get_instance();
    $CI->db->select('*');
    $CI->db->where('judge_id', $judge_id);
    $CI->db->from('ft_civil_judge_charater_certificate');
    $query = $CI->db->get();
    if($query->num_rows() != 0){
        return $query->result();


    }else{
        return  false;
    }


}

function get_fileid_from_sectionno($file_section_no = null ,$section_id = null  )
{
	$CI = & get_instance();
    $CI->db->select('*');
    $CI->db->where('file_section_id', $file_section_no);
    $CI->db->where('section_id', $section_id);
    $CI->db->from(FILES_SECTION);
    $query = $CI->db->get();
    $result = $query->row();
	return @$result->file_id;
}
function emp_local_bill_data($bill_id = null){
    $CI = & get_instance();


    if($bill_id != null){
        $tab1 = EST_LOCAL_BILLS;
        $CI->db->select("*");
        $CI->db->from($tab1);
        $CI->db->where("$tab1.id",$bill_id);

        $query = $CI->db->get();
        if($query->num_rows() != 0)
        {
            $row = $query->row_array();

            return $row ;
        }
        else{
            return FALSE;
        }

    }
}

function est_module_attachment_view ($relation_id){
    if($relation_id){
        $arr1 = array(97,98,130,131);
        $arr2 = array(121,122,123,124);
        $application_data =  dispaly_application_on_file_coloumn_tab($relation_id);
        $show = '<div class="form-group"><label for="section no">आवेदन :- </label></div>';
        $show .= '<div class="form-group"><ul>';
        if($application_data['tab_3'] )
            if(in_array($application_data['tab_3'],$arr1)){
                $show .= '<li style="text-align:left;"><a href="'.base_url().'est_service_module/dispaly_application/'.$application_data['tab_1'].'">आवेदन देखे</a></li>';
            }elseif(in_array($application_data['tab_3'],$arr2)){
                $show .= '<li style="text-align:left;"><a href="'.base_url().'est_service_module/dispaly_bill_view/'.$application_data['tab_1'].'">आवेदन देखे</a></li>';
            }
        $show .= '<li style="text-align:left; "><a target="_blank" href="'.base_url().$application_data['tab_2'].'">संलग्न स्लिप देखे </a></li>';
        $rules =  get_est_mat_attachment($application_data['tab_3']) ;
        if(isset($rules) && !empty($rules)){
            $i = 1 ;
            foreach($rules as $rule){
                $show .= '<li style="text-align:left; "><a target="_blank" href="'.base_url().$rule['attach_path'].'">नियम  '.$i.'</a></li>';
                $i++ ; }}
        $show .= '</ul></div><hr/>';



        echo $show ;
    }

}


function close_file_moniter_byuser($file_id = null , $file_moniter_byps = NULL, $emp_id = null,$limit=null,$page=null) {
		if($emp_id == null){
			$emp_id = emp_session_id();
			}
        $CI = & get_instance();
        $yr_mnth_sql='';
        if(isset($_GET['files_year']) && $_GET['files_year']!=''){
           $yr_mnth_sql = "YEAR(flog_created_date)='".$_GET['files_year']."' AND ";
        }else{
            $yr_mnth_sql = "YEAR(flog_created_date)='".date('Y')."' AND ";
        }
        if(isset($_GET['files_month']) && $_GET['files_month']!=''){
             $yr_mnth_sql.="MONTH(flog_created_date)='".$_GET['files_month']."' AND";
        }else{
            $yr_mnth_sql.="MONTH(flog_created_date)='".date('m')."' AND";
        }
		
		$subQuery = ("SELECT DISTINCT `file_id` FROM `ft_file_logs_master` WHERE $yr_mnth_sql  (`to_emp_id`=".$emp_id."  or from_emp_id = ".$emp_id . ")" );
		
        if(isset($_GET['sort']) && $_GET['sort']!=''){
            if(isset($_GET['sort'])&& $_GET['sort']=='rj'){
                $CI->db->select('*')->from(FILES_MASTER)->where("file_id IN ($subQuery)", NULL, FALSE)->where("file_hardcopy_status",'not');
            }else if(isset($_GET['sort'])&& $_GET['sort']=='rj_cr'){
                $CI->db->select('*')->from(FILES_MASTER)->where("file_id IN ($subQuery)", NULL, FALSE)->where("file_hardcopy_status",'not')->where("file_received_emp_id IN (210,211,204,177)", NULL, FALSE);
            }else if(isset($_GET['sort'])&& $_GET['sort']=='rc'){
                $CI->db->select('*')->from(FILES_MASTER)->where("file_id IN ($subQuery)", NULL, FALSE)->where("file_hardcopy_status",'received')->or_where("file_hardcopy_status",'working');
            }
        }else{
                $CI->db->select('*')->from(FILES_MASTER)->where("file_id IN ($subQuery)", NULL, FALSE);
        }
        if(isset($_GET['searchby']) && $_GET['searchby']!=''){
			$searchval=$_GET['searchby'];
			$sql_emp="SELECT emp_id,emp_full_name FROM ft_employee WHERE MATCH(emp_full_name_hi) AGAINST('".$searchval."')";
			$emp_row_details= get_row($sql_emp);
			if(isset($emp_row_details['emp_id']) && $emp_row_details['emp_id']!=''){				
				$searchval = $emp_row_details['emp_id'];
				$CI->db->where('ft_files_master.file_received_emp_id',$searchval);
			}else{
				$wheres= "(FIND_IN_SET('".$searchval."',ft_files_master.file_all_section_no) OR ft_files_master.file_subject like '%".$searchval."%'  OR ft_files_master.file_uo_or_letter_no like '%".$searchval."%' OR ft_files_master.file_uo_or_letter_date = DATE_FORMAT('".$searchval."', '%Y-%m-%d'))";
				$CI->db->where($wheres);
			}
		}
         if($file_moniter_byps){
                $CI->db->order_by("ps_moniter_date", 'asc');
        }else{
			$CI->db->order_by("file_update_date", 'desc');                
        }
		$CI->db->limit($limit,$page);
        $query= $CI->db->get();
        return  $query->result();
}


function count_close_file_moniter_byuser($file_id = null , $file_moniter_byps = NULL, $emp_id = null) {
		if($emp_id == null){
			$emp_id = emp_session_id();
		}
        $CI = & get_instance();
        $yr_mnth_sql='';
        if(isset($_GET['files_year']) && $_GET['files_year']!=''){
           $yr_mnth_sql = "YEAR(flog_created_date)='".$_GET['files_year']."' AND ";
        }else{
            $yr_mnth_sql = "YEAR(flog_created_date)='".date('Y')."' AND ";
        }
        if(isset($_GET['files_month']) && $_GET['files_month']!=''){
             $yr_mnth_sql.="MONTH(flog_created_date)='".$_GET['files_month']."' AND";
        }else{
            $yr_mnth_sql.="MONTH(flog_created_date)='".date('m')."' AND";
        }
        $subQuery = ("SELECT DISTINCT `file_id` FROM `ft_file_logs_master` WHERE $yr_mnth_sql  (`to_emp_id`=".$emp_id."  or from_emp_id = ".$emp_id . ")" );
        if(isset($_GET['sort']) && $_GET['sort']!=''){
            if(isset($_GET['sort'])&& $_GET['sort']=='rj'){
                $CI->db->select('COUNT(DISTINCT(file_id)) as totalfiles')->from(FILES_MASTER)->where("file_id IN ($subQuery)", NULL, FALSE)->where("file_hardcopy_status",'not');
            }else if(isset($_GET['sort'])&& $_GET['sort']=='rj_cr'){
                $CI->db->select('COUNT(DISTINCT(file_id)) as totalfiles')->from(FILES_MASTER)->where("file_id IN ($subQuery)", NULL, FALSE)->where("file_hardcopy_status",'not')->where("file_received_emp_id IN (210,211,204,177)", NULL, FALSE);
            }else if(isset($_GET['sort'])&& $_GET['sort']=='rc'){
                $CI->db->select('COUNT(DISTINCT(file_id)) as totalfiles')->from(FILES_MASTER)->where("file_id IN ($subQuery)", NULL, FALSE)->where("file_hardcopy_status",'received')->or_where("file_hardcopy_status",'working');
            }
        }else{
                $CI->db->select('COUNT(DISTINCT(file_id)) as totalfiles')->from(FILES_MASTER)->where("file_id IN ($subQuery)", NULL, FALSE);
        }
		if(isset($_GET['searchby']) && $_GET['searchby']!=''){
			$searchval=$_GET['searchby'];
			$sql_emp="SELECT emp_id,emp_full_name FROM ft_employee WHERE MATCH(emp_full_name_hi) AGAINST('".$searchval."')";
			$emp_row_details=get_row($sql_emp);
			if(isset($emp_row_details['emp_id']) && $emp_row_details['emp_id']!=''){				
				$searchval = $emp_row_details['emp_id'];
				$CI->db->where('ft_files_master.file_received_emp_id',$searchval);
			}else{
				$wheres= "(FIND_IN_SET('".$searchval."',ft_files_master.file_all_section_no) OR ft_files_master.file_subject like '%".$searchval."%'  OR ft_files_master.file_uo_or_letter_no like '%".$searchval."%' OR ft_files_master.file_uo_or_letter_date = DATE_FORMAT('".$searchval."', '%Y-%m-%d'))";
				$CI->db->where($wheres);
			}
		}				
        if($file_moniter_byps){
                $CI->db->order_by("ps_moniter_date", 'asc');
        }else{
                $CI->db->order_by("file_update_date", 'asc');
        }
        $query= $CI->db->get();				
        return  $query->row_array();
}
	
	


