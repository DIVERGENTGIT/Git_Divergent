<?php 
include("dbconnect/config.php");  

  
//http://smsstriker.com/API/APIReport.php?ondate=2018-01-05&username=xxxxxx&password=xxxxxx&offset=0&limit=1000

$ondate = isset($_REQUEST['ondate'])?$_REQUEST['ondate']:'';
$curdate = date('Y-m-d'); 
$days_diff = FALSE;

$userName = isset($_REQUEST['username'])?$_REQUEST['username']:''; 
$password = isset($_REQUEST['password'])?$_REQUEST['password']:''; 

$offset = isset($_REQUEST['offset'])?$_REQUEST['offset']:''; 
$limit = isset($_REQUEST['limit'])?$_REQUEST['limit']:''; 
  
    

if($offset == '') {  
	$offset = 0;
}

if($limit == '' || $limit > 1000) {
	$limit = 1000;
}
    
  
$user_id = FALSE;
$getUserID = $mysqli->query("select user_id from users where username='".trim($userName)."' and password='".md5($password)."'");
if($getUserID->num_rows > 0)  
{
    $getUserIDRes = $getUserID->fetch_array(MYSQLI_ASSOC);
    $user_id = $getUserIDRes['user_id'];
}else{
	echo json_encode(array('status' => 202,'message' => 'Not a valid credentials'));exit;
} 
   
   
   
if($user_id) {

	if(preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $ondate)){
		$days_diff = daysDifference($curdate, $ondate);	
	}else{ 
		$days_diff = 0;
	} 

	$report = array(); 
	if(!$days_diff) {
		$ondate = $curdate;
	}
	  
	
	$getAPISMSReportRes = $mysqli->query("SELECT ondate,to_mobileno,sender_name,message,noofmessages,dlr_status,error_text FROM sms_api_messages WHERE user_id = '".$user_id."' AND date(ondate) = '".$ondate."' AND ondate >= DATE_SUB(NOW(),INTERVAL 6 MONTH) ORDER BY ondate DESC LIMIT $offset,$limit"); 
	if($getAPISMSReportRes->num_rows > 0) {
		while($response = $getAPISMSReportRes->fetch_array(MYSQLI_ASSOC)) {
			$report[] = $response;  
		}
	}  
	
 
  
	if($days_diff > 2) {    
		$year = substr($ondate,0,4);
		$month = substr($ondate,5,2);
		$table_name = "campaigns_backup.sms_api_messages_".$month.$year;
		$getSMSReport = $mysqli->query("SELECT ondate,to_mobileno,sender_name,message,noofmessages,dlr_status,error_text FROM $table_name WHERE user_id = '".$user_id."' AND date(ondate) = '".$ondate."' AND ondate >= DATE_SUB(NOW(),INTERVAL 6 MONTH) ORDER BY ondate DESC  LIMIT $offset,$limit"); 
 		if($getSMSReport->num_rows > 0) {
			while($response = $getSMSReport->fetch_array(MYSQLI_ASSOC)) {
				$report[] = $response;  
			}
		}
	}   
	
	echo json_encode(array('status' => 200,'message' => 'Success','data'=> $report));  
}else{
	echo json_encode(array('status' => 201,'message' => 'Not a valid request' ));
}
  

 

function daysDifference($date1, $date2)
{
	$month1 = substr($date1,5,2);
	$day1 = substr($date1,8,2);
	$year1 = substr($date1,0,4);

	$month2 = substr($date2,5,2);
	$day2 = substr($date2,8,2);
	$year2 = substr($date2,0,4);

	$date1 = mktime(0,0,0,$month1,$day1,$year1);
	$date2 = mktime(0,0,0,$month2,$day2,$year2);

	if($date1 > $date2){
		$dateDiff = $date1 - $date2;
	} else {
		$dateDiff = $date2 - $date1;
	}
	return $fullDays = floor($dateDiff/(60*60*24));
}



?>
