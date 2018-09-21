<?php 

include("dbconnect/config.php");  
 
 
//http://smsstriker.com/API/APICount.php?from_date=2018-01-02&to_date=2018-01-09&username=xxxxxx&password=xxxxxx
  
$from_date = isset($_REQUEST['from_date'])?$_REQUEST['from_date']:'';
$to_date = isset($_REQUEST['to_date'])?$_REQUEST['to_date']:'';
$userName = isset($_REQUEST['username'])?$_REQUEST['username']:''; 
$password = isset($_REQUEST['password'])?$_REQUEST['password']:''; 


$user_id = FALSE;
$getUserID = $mysqli->query("select user_id from users where username ='".trim($userName)."' and password='".md5($password)."'");
if($getUserID->num_rows > 0)
{
    $getUserIDRes = $getUserID->fetch_array(MYSQLI_ASSOC);
    $user_id = $getUserIDRes['user_id'];
}else{
	echo json_encode(array('status' => 202,'message' => 'Not a valid credentials'));exit;
} 
      
$days_diff = FALSE;    

if($user_id) {
	if($from_date != '' &&  $to_date != '') {
		if(preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $to_date)) {
			  $days_diff = daysDifference($from_date, $to_date); 
		}else{ 
			$days_diff = 0;
		} 
	}
	
	$report = array(); 
	
	
	// Fetch SMS report from last 2 dates   
	 $getSMSAPICount = "select  date(ondate) as ondate,sum(noofmessages) as sms_count from sms_api_messages where user_id='$user_id' AND ondate >= DATE_SUB(NOW(),INTERVAL 6 MONTH)";
		
	if($from_date) {  
		$getSMSAPICount .= " AND date(ondate) >= '$from_date'";
	}
	if($to_date) {
		$getSMSAPICount .= " AND date(ondate) <= '$to_date'";
	} 
	 
	$getSMSAPICount .= " group by date(ondate) order by date(ondate) desc ";
	$getSMSAPICountRes = $mysqli->query($getSMSAPICount);
	if($getSMSAPICountRes->num_rows > 0) {
		while($response = $getSMSAPICountRes->fetch_array(MYSQLI_ASSOC)) {
			$report[] = $response;
		}
	}
	 
 

	if(!$days_diff) {
		// Fetch SMS report from current month on current year  
		$currentYear = date('Y'); $currentMonth = date('m');
	 	$getAPICount = "select on_date,sms_count from sms_api_daily_count where user_id='$user_id' and month(on_date) = '$currentMonth' AND year(on_date) = '$currentYear' ORDER BY on_date DESC ";
		 
	}else if($days_diff > 2) {
		// Fetch SMS report from last 6 months
		$getAPICount = "select on_date,sms_count from sms_api_daily_count where user_id='$user_id' AND on_date >= DATE_SUB(NOW(),INTERVAL 6 MONTH)";
		if($from_date) {
			$getAPICount .= " AND on_date >='$from_date'";
		}
		if($to_date) {
			$getAPICount .= " AND on_date <='$to_date'";
		}
		$getAPICount .= " group by date(on_date) order by on_date desc";  
	}

	$getAPICountRes = $mysqli->query($getAPICount);
	if($getAPICountRes->num_rows > 0) {
		while($response = $getAPICountRes->fetch_array(MYSQLI_ASSOC)) {
			$report[] = $response;
		}
	}
	echo json_encode(array('status' => 200,'message' => 'Success','data'=> $report));  
}else{
	echo json_encode(array('status' => 201,'message' => 'Not a valid request'));
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
