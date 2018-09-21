<?php 
include("dbconnect/config.php");

$path="/var/www/html/strikerapp/sendernames_logs/sendername.log";
error_log(print_r($_REQUEST,TRUE)."\n",3,$path);
if(isset($_REQUEST['putsendername']) || $_REQUEST['putsendername']!='') {
	$user_id=$_REQUEST['user_id'];
	$sender_name=urldecode($_REQUEST['sender_name']);
	$response=array();
	$stmnt=$mysqli->query("select * from sender_names where user_id='".$user_id."' and sender_name='".$sender_name."'");
 
	//$sql_unique=mysqli_query($conn,$stmnt);
 	//error_log($stmnt."\n",3,$path);
	if($stmnt->num_rows == 0) { 
		  print_r(json_encode(array('status'=>'Available')));
		 $sender_name=strtoupper($sender_name);
		 $sql=$mysqli->query("INSERT INTO sender_names (user_id,sender_name,on_date) VALUES ('".$user_id."','".$sender_name."',NOW())");

		//print_r($mysqli->insert_id);        
		 //$sql_query=mysqli_query($conn,$sql);
    
		error_log($mysqli->insert_id."\n",3,$path);
	}else{
        	 print_r(json_encode(array('status'=>'Existed')));
 
	}   
	$mysqli->close(); 
}else{
	$respons["status"]="Required Parmeter Missing";
	echo json_encode($respons,true);
}
     
/*
	 $servername = "localhost";
	$username = "root";
	$password = "myadmin";
	$dbname = "sms";
      $conn=mysqli_connect($servername, $username, $password, $dbname);
$path="/var/www/vhosts/www.smsstriker.com/htdocs/api_log/sendernames_logs/sendername.log";
error_log(print_r($_REQUEST,TRUE)."\n",3,$path);
	if(isset($_REQUEST['putsendername']) || $_REQUEST['putsendername']!='')
	{
		$user_id=$_REQUEST['user_id'];
		$sender_name=urldecode($_REQUEST['sender_name']);
		$response=array();
		$stmnt="select * from sender_names where user_id='$user_id' and sender_name='$sender_name'";
		$sql_unique=mysqli_query($conn,$stmnt);
		error_log($stmnt."\n",3,$path);
		if(mysqli_num_rows($sql_unique)==0)
		{
			print_r(json_encode(array('status'=>'Available')));
			$sender_name=strtoupper($sender_name);
			$sql="INSERT INTO sender_names (user_id,sender_name,on_date) VALUES ('$user_id','$sender_name',NOW())";
			$sql_query=mysqli_query($conn,$sql);
			error_log($sql."\n",3,$path);
		}
		else
		{
		    print_r(json_encode(array('status'=>'Existed')));
		}
	}else{
	$respons["status"]="Required Parmeter Missing";
	echo json_encode($respons,true);
	}

*/


?>

