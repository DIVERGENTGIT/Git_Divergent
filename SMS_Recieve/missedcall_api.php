<?php 

$mobile = $_REQUEST['mobile'];
$service_number = urldecode($_REQUEST['service_number']);
$status = urldecode($_REQUEST['status']);
$on_time = urldecode($_REQUEST['call_time']);
$user_id = urldecode($_REQUEST['user_id']);

$link = mysql_connect("localhost", "longcodeuser", "admin123");
mysql_select_db("longecode_db",$link); 


	 $insert_query = "insert into sms_missedcall SET
		called_from = '$mobile',
		service_number = '$service_number',
		called_time = '$on_time',
		user_id = '$user_id',
		status = '$status'";
mysql_query($insert_query,$link);	
mysql_close($link);
?>