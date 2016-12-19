<?php 	
error_reporting(E_ALL);
echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
$servername = "localhost";
$username = "dbadmin";
$password = "password";
//$dbname = "db_eoffice";	
$loginempid_serverid = $_REQUEST['emp_id'];
$loginempid_serverid_array = explode(',',$loginempid_serverid);
$draft_log_creator_id = $loginempid_serverid_array[0];
$request_host= $loginempid_serverid_array[1];
if($request_host==1){
	$dbname = "db_ftms_eoffice_26";
} else {
	$dbname = "db_ftms_eoffice_26";	
}
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
if(isset($_REQUEST['digitalSignature']) && $_REQUEST['digitalSignature']!=''){
	$signature= $_REQUEST['digitalSignature'];	
}else{$signature='';}

if(isset($_REQUEST['data']) && $_REQUEST['data']!=''){
	$s_c_data= $_REQUEST['data'];
}else{$s_c_data='';}

if(isset($_REQUEST['publicKey']) && $_REQUEST['publicKey']!=''){
	$public_key= $_REQUEST['publicKey'];
}else{ $public_key='';}

if(isset($_REQUEST['verification_status']) && $_REQUEST['verification_status']!=''){
	$verification_status= $_REQUEST['verification_status'];
}else{ $verification_status='';}

if(isset($_REQUEST['emp_name']) && $_REQUEST['emp_name']!=''){	
$emp_name= $_REQUEST['emp_name'];
}else{$emp_name='n/a';} 

if(isset($_REQUEST['draft_id']) && $_REQUEST['draft_id']!=''){	
$draft_log_id= $_REQUEST['draft_id'];
}else{$draft_log_id=0;} 

if(isset($_REQUEST['emp_id']) && $_REQUEST['emp_id']!=''){	
$draft_log_creater= $draft_log_creator_id;
}else{$draft_log_creater=0;} 

if(isset($_REQUEST['file_id']) && $_REQUEST['file_id']!=''){	
$file_id= $_REQUEST['file_id'];
}else{$file_id=0;} 

date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d H:i:s');
//Insert
if($signature !=''){
	 $ds_local_data=$_REQUEST['other'];
		$insert_sql = "INSERT INTO ft_digital_signature(ds_signature,ds_signed_data,ds_public_key,ds_verification_status,ds_emp_name,ds_draft_log_id,ds_create_datetime,ds_emp_id,ds_local_data,ds_file_id)VALUES('".$signature."','".$s_c_data."','".$public_key."','".$verification_status."','".$emp_name."',".$draft_log_id.",'".$date."',".$draft_log_creater.",'".$ds_local_data."',$file_id)";
	if ($conn->query($insert_sql)===TRUE) {
		echo 1; //success
		exit;
	} else {
		echo 2;
		echo "Error: " . $insert_sql . "<br>" . $conn->error;
		exit;
	}
}
?>