<?php 

 
 include("dbconnect/config.php");  
  
//https://www.smsstriker.com/API/APSRTCWebService.php?fromdt=2018-02-02&todt=2018-02-15
  
  
$from_date = isset($_REQUEST['fromdt'])?$_REQUEST['fromdt']:'';
$to_date = isset($_REQUEST['todt'])?$_REQUEST['todt']:'';
$report = array(); 

if($from_date && $to_date) {
	$userIPAddr = $_SERVER['REMOTE_ADDR'];  
 	if($userIPAddr) {
 		$checkIsIPValid = $mysqli->query("select * FROM allow_ip where ip ='".trim($userIPAddr)."' AND userName = 'APSRTC' ");	
 		if($checkIsIPValid->num_rows == 0) {
 			$apsrtcErrorReport = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><Report></Report>');
			$table = $apsrtcErrorReport->addChild('Table','Not an authoritative user');
			//echo htmlentities($apsrtcErrorReport->asXML()); 
			echo explode("\n",htmlentities($apsrtcReport->asXML()), 2)[1];
 			exit;
 		}     
 	}  
 
	if(preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $to_date)) {
		   $days_diff_to = daysDifference($from_date, $to_date); 
	}
	
	if(preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $from_date)) {
		   $days_diff_from = daysDifference($from_date, $to_date); 
	}  
	$i = 0;  
	//if($days_diff_from && $days_diff_to) {
		$apsrtcUsers = array(5874,5020,4477,4476,4475,4323,4130,3436,2547);
		foreach($apsrtcUsers as $userID) {
			$i++;
			$getUserName = $mysqli->query("select username from users where user_id ='".trim($userID)."'  ");
			if($getUserName->num_rows > 0)
			{
				$getUserNameRes = $getUserName->fetch_array(MYSQLI_ASSOC);
	   			$userName = $getUserNameRes['username'];
	
				$report[$i]['SID'] = $i;
				$report[$i]['SName'] = $userName;
				$servicecount = 0;
			
				// Fetch SMS report from last 2 dates   
				 $getSMSAPICount = "select  date(ondate) as ondate,sum(noofmessages) as sms_count from sms_api_messages where user_id='$userID' AND ondate >= DATE_SUB(NOW(),INTERVAL 6 MONTH)";
		
				if($from_date) {  
					$getSMSAPICount .= " AND date(ondate) >= '$from_date'";
				}
				if($to_date) {
					$getSMSAPICount .= " AND date(ondate) <= '$to_date'";
				} 
				 
				//$getSMSAPICount .= " group by date(ondate) order by date(ondate) desc ";
				$getSMSAPICount .= "order by date(ondate) desc ";
				$getSMSAPICountRes = $mysqli->query($getSMSAPICount);
				if($getSMSAPICountRes->num_rows > 0) {
					while($response = $getSMSAPICountRes->fetch_array(MYSQLI_ASSOC)) {
						$servicecount += $response['sms_count'];
					}
				}
	   			
	 
	 			$currentDate = date('Y-m-d');
	 			$days_diff1 = daysDifference($currentDate, $from_date); 
	   			 if($days_diff1 > 2) {
					// Fetch SMS report from last 6 months
					$getAPICount = "select on_date,sms_count from sms_api_daily_count where user_id='$userID' AND on_date >= DATE_SUB(NOW(),INTERVAL 6 MONTH)";
					if($from_date) {
						$getAPICount .= " AND on_date >='$from_date'";
					}
					if($to_date) {
						$getAPICount .= " AND on_date <='$to_date'";
					}
					$getAPICount .= " order by date(on_date) desc";   
	 
				 }

				$getAPICountRes = $mysqli->query($getAPICount);
				if($getAPICountRes->num_rows > 0) {
					while($response = $getAPICountRes->fetch_array(MYSQLI_ASSOC)) {
						$servicecount += $response['sms_count'];
					}
				}
			
				//echo json_encode(array('status' => 200,'message' => 'Success','data'=> $report));
	 
	   			$report[$i]['servicecount'] = $servicecount;

			}
		}
	  
	  
		$apsrtcReport = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><Report></Report>');
		foreach($report as $data) { 
			$table = $apsrtcReport->addChild('Table');
			$SID = $table->addChild('SID',$data['SID']);
			$SName = $table->addChild('SName',$data['SName']);
			$servicecount = $table->addChild('servicecount',$data['servicecount']);

		}  
		//echo htmlentities($apsrtcReport->asXML()); 
		
		echo explode("\n",htmlentities($apsrtcReport->asXML()), 2)[1];

	/*}else{
		$apsrtcErrorReport = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><Report></Report>');
		$table = $apsrtcErrorReport->addChild('Table','Not a valid request');
		echo htmlentities($apsrtcErrorReport->asXML()); 
		exit;
	}*/
}else{ 
	$apsrtcErrorReport = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><Report></Report>');
	$table = $apsrtcErrorReport->addChild('Table','Not a valid request');
	//echo htmlentities($apsrtcErrorReport->asXML()); 
	echo explode("\n",htmlentities($apsrtcReport->asXML()), 2)[1];
	exit;
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
