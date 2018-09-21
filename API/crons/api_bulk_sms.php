<?php

include("/var/www/html/strikerapp/API/dbconnect/config.php");  
 include("/var/www/html/strikerapp/smslib/config.inc");
 include("/var/www/html/strikerapp/smslib/functions.inc");
  

$date = date('Y-m-d'); 
$getSMSReport = $mysqli->query("SELECT * FROM sms_api_bulk_messages");
$campaignLength = $getSMSReport->num_rows;
$availablePorts = array();
$activePorts = getActivePortNumbers();
$campaignProcessedLength = 0;$portIndex = 0;

if($campaignLength > 0 ) {
   while($report = $getSMSReport->fetch_array()) {  
	$smsId = $report['message_id'];
	$sender = $report['sender_name'];
	$to = $report['to_mobileno'];
	$message1 = $report['message']; 
	$type = $report['type'];
	$tempID = $report['tempID']; 
	$user_id = $report['user_id']; 
	$userquery = $mysqli->query("select no_ndnc,dnd_check,available_credits from users where user_id = '".$user_id."' "); 
	$ndnc = $userquery->fetch_array(MYSQLI_ASSOC);
	$no_ndnc = $ndnc['no_ndnc'];  
	$dnd_check = $ndnc['dnd_check']; 
	$userActType = array();
	$userActType = array(array($no_ndnc,$dnd_check));
	$semi = array();
	$semi = array(1,1);   
	$tran = array(1,0);    
	$promo = array(0,0);    
	$promo2 = array(0,1);    
	
	switch ($userActType)
	{  
		// Account type switch start
		case in_array($semi,$userActType) : $portType = "LS2";  $portTypeNAS= 'NASP2';// semi trans 
						    break;
		case in_array($tran,$userActType): $portType = "LT2"; $portTypeNAS= 'NAST2';// trans
						   break;
		case (in_array($promo,$userActType) || in_array($promo2,$userActType)) : $portType = "LP2"; $portTypeNAS= 'NASP2'; // promo
											 break; 
	}  
	
	   $checkSenderName = $mysqli->query("SELECT * FROM sender_names WHERE user_id = '".$user_id."' AND sender_name = '".trim($sender)."' AND status = 1 ");
	   
       $sms_port = '';  $isValidSenderName = TRUE;
       if($no_ndnc == 1) { 
       if($checkSenderName->num_rows > 0) {   
		$isValidSenderName = TRUE;
	}else{
		$isValidSenderName = FALSE;  
		$getNASPortNumber = $mysqli->query("SELECT sending_port_no FROM sms_queue WHERE application_priority = '$portTypeNAS'");
		if($getNASPortNumber->num_rows > 0) {
			$getNASPortNumberRes = $getNASPortNumber->fetch_array();
			$sms_port = $getNASPortNumberRes['sending_port_no'];
		}	
	}  
	}
	  
	$available_port_val = $mysqli->query("SELECT sending_port_no FROM sms_queue where application_priority='$portType' AND port_no IN ($activePorts) ORDER BY queued, sent ASC  ");
 	while($available_ports = $available_port_val->fetch_array(MYSQLI_ASSOC)) {
		$availablePorts[] = $available_ports['sending_port_no'];
	}
 

	  
	$totalPorts = count($availablePorts);  // Active port numbers count
	$kennelLength  = ceil($campaignLength/$totalPorts);  // Campaign length for each port number
	 
        
	$available_port = $availablePorts[$portIndex];
 	if($portIndex < $totalPorts) {
		if($campaignProcessedLength == $kennelLength) {
			$portIndex++;
			$campaignProcessedLength = 0;
			$available_port = $availablePorts[$portIndex];
		}
	}     
       if(!$isValidSenderName) {
		$available_port = $sms_port;
	}
	
	
	 $senderName_kennel = $sender;
 	if($available_port > 0) {
	 	$getPortType = $mysqli->query("SELECT sending_port_no FROM sms_queue where sending_port_no = '".$available_port."' AND used_for = 'BSNL' ");  
	 	if($getPortType->num_rows > 0)  
		{  
		 	if($no_ndnc == 0) { 
			 	$senderName_kennel = "BA-611128";
			}else{   
		 		$senderName_kennel = "BA-".$sender;
		 	} 
	 	}    
 	}  
 
 
	$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($senderName_kennel)."&to=91$to&text=".urlencode($message1);   
	if($type == "0") {      
		$URL .= "&mclass= 0 ";      
	}
	$URL .= "&dlr-mask=19&dlr-url=".urlencode(SERVER_NAME."/apidlr.php?campaign_id=$smsId&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T&sms_port=$available_port");  
	 
	error_log($URL."\r\n",3,"/var/www/html/strikerapp/api_log/striker_api_log/bulk_apistriker_".$date.".log"); 
	 http_send($URL,$available_port);       
	$campaignProcessedLength++;     
	
	//$mysqli->query("UPDATE sms_api_bulk_messages SET port_no = '".$available_port."' WHERE tempID = '".$tempID."' ");
	
	$mysqli->query("UPDATE sms_api_messages SET port_no = '".$available_port."' WHERE message_id = '".$smsId."' ");  
	
	//$tempRecord = $mysqli->query("INSERT INTO sms_api_bulk_messages_temp (SELECT * FROM sms_api_bulk_messages WHERE tempID = '".$tempID."' ) ");
	//$tempRecord = $mysqli->insert_id;  
	//if($tempRecord) { 
	$mysqli->query("DELETE FROM sms_api_bulk_messages WHERE tempID = '".$tempID."' "); 
	
	//}
}


	//$mysqli->close();     	
}

function getActivePortNumbers() {
	global $mysqli;  
 
	$portNums = $mysqli->query("SELECT DISTINCT port_no FROM sms_queue"); 
	$activePortNum = ''; 
	while($portNumsRes = $portNums->fetch_array())
	{  
		$port = $portNumsRes[0];  
		//$array[] = $port;
		$url = "http://182.18.139.110:$port/cgi-bin/status?password=ara111";
		$file = file_get_contents($url);
		$splt = explode("Status:",$file);
		$runstr = $splt[1];
		$runarr = explode("WDP",$runstr);
		$status = $runarr[0]; //Online Time 

		$splt2 = explode("SMS:",$file);
		$Qstr = $splt[1];

		$qarr = explode("SMS:",$Qstr);
		$a = $qarr[1];
		$arr = explode("(",trim($a));
		$b = explode("queued",$arr[2]);
		$quesms = $b[0]; //Queued 
		$c = explode("store size",$b[1]);
		$storesize = $c[1];  //Store Size  
		$d = explode("Box connections:",$runstr);  //Box connections
	  
		$boxarr = explode("SMSC connections:",$d[1]); 
		$smpponline = explode(":smpp (",$boxarr[1]);
	 
		$cnt = count($smpponline);
	 
		$offlinePorts = substr_count($boxarr[1], 'offline');
		if($offlinePorts == 0) {  
			$activePortNum .= $port.' ,';	 
		} 
	} 
	$activePortNum = rtrim($activePortNum,',');
	return $activePortNum;
}


$mysqli->close();       


?>
