<?php 
include("dbconnect/config.php");  

//https://www.smsstriker.com/API/get_dlr_date_range.php?username=username&password=password&fromdate=dd/mm/yyyy&todate=dd/mm/yyyy


$todate = isset($_REQUEST['todate'])?$_REQUEST['todate']:'';
$fromdate = isset($_REQUEST['fromdate'])?$_REQUEST['fromdate']:'';
$curdate = date('Y-m-d'); 
$days_diff = FALSE;      

$userName = isset($_REQUEST['username'])?$_REQUEST['username']:''; 
$password = isset($_REQUEST['password'])?$_REQUEST['password']:''; 
  
  
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

	if(preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $todate)){
		$days_diff = daysDifference($fromdate, $todate);	
	}else{ 
		$days_diff = 0;
	} 

	$report = array();   
	if(!$fromdate && !$todate) {
		$fromdate = $curdate;
	}    
 
	$getMessages = "SELECT ondate,to_mobileno,job_id,dlr_status, error_text FROM sms_api_messages WHERE user_id = '".$user_id."'  "; 
	      
	if($fromdate && $todate) {    
		$getMessages .= " AND date(ondate) >= '$fromdate' AND date(ondate) <= '$todate'";
	}else{
		$getMessages .= " AND date(ondate) = '$fromdate' ";
	}    
	           
	$getMessages .= " AND ondate >= DATE_SUB(NOW(),INTERVAL 6 MONTH) ORDER BY ondate DESC ";

	$getAPISMSReportRes = $mysqli->query($getMessages);      
  
	if($getAPISMSReportRes->num_rows > 0) {
		while($response = $getAPISMSReportRes->fetch_array(MYSQLI_ASSOC)) {
			$report[] = array("Job Id" => $response['job_id'],"Report" => array("To" => $response['to_mobileno'],"Dlr Code" => $response['dlr_status'],"Dlr Text" => $response['error_text'],"Ondate" => $response['ondate'] )); 
		}
	}       
  
	if($days_diff > 2) {        
		$year = substr($fromdate,0,4);
		$month = substr($fromdate,5,2);      
		$table_name = "campaigns_backup.sms_api_messages_".$month.$year;
		$sMSReport =  "SELECT ondate,to_mobileno,job_id,dlr_status, error_text FROM $table_name WHERE user_id = '".$user_id."' " ;
		       
		if($fromdate && $todate) {           
			$sMSReport .= " AND date(ondate) >= '$fromdate' AND date(ondate) <= '$todate'";
		}      
		    
		$sMSReport .= " AND ondate >= DATE_SUB(NOW(),INTERVAL 6 MONTH) ORDER BY ondate DESC ";
 
		$getSMSReport = $mysqli->query($sMSReport);
		
 		if($getSMSReport->num_rows > 0) {
			while($response = $getSMSReport->fetch_array(MYSQLI_ASSOC)) {
				$report[] = array("Job Id" => $response['job_id'],"Report" => array("To" => $response['to_mobileno'],"Dlr Code" => $response['dlr_status'],"Dlr Text" => $response['error_text'],"Ondate" => $response['ondate'] ));        
				   
			}        
		}
	}       
	  
	echo json_encode(array('Status' => 200,'StatusMsg' => 'Success','data'=> $report));  
}else{  
	echo json_encode(array('Status' => 201,'StatusMsg' => 'Not a valid request' ));
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
