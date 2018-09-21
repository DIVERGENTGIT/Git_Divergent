<?php

require_once 'db/config.php';
include("/var/www/html/strikerapp/smslib/config.inc");    
include("/var/www/html/strikerapp/smslib/functions.inc");  
         
       

       
       
      
$getCampaignsProcessData = $mysqli->query("SELECT ct.campaign_id,ct.sms_text,ct.to_mobile_no,ct.port_no,ct.dlr_status,ct.error_text,c.is_unicode_sms,ct.user_id,ct.sender_name  FROM campaigns_to ct JOIN campaigns c ON c.campaign_id = ct.campaign_id WHERE ct.campaign_id in (2314810,2314813,2314833) AND ct.port_no = 45113 AND date(sent_on) = date(NOW()) AND ct.re_campaign_status = 0 AND dlr_status = 0 "); 
       
if($getCampaignsProcessData->num_rows > 0 ) {    
$totalcnt = 0;      
 $processCount = $getCampaignsProcessData->num_rows;

while($campaignsProcessDataRes = $getCampaignsProcessData->fetch_assoc()) {
	  $campaign_id = trim($campaignsProcessDataRes['campaign_id']);  
      	$sms_txt = trim($campaignsProcessDataRes['sms_text']);
	$to_mobile = $campaignsProcessDataRes['to_mobile_no'];
	$port_no = $campaignsProcessDataRes['port_no'];   
	$dlr_status = $campaignsProcessDataRes['dlr_status'];
	$error_text = $campaignsProcessDataRes['error_text'];
	$is_unicode_sms = $campaignsProcessDataRes['is_unicode_sms'];
	$user_id = $campaignsProcessDataRes['user_id'];   
	$sender_name = $campaignsProcessDataRes['sender_name'];  
	$unicode_sms = '';    
	if($is_unicode_sms == 1) {
		  $unicode_sms = "&coding=2&charset=utf-8";
	} 
	
	$getUserType = $mysqli->query("select no_ndnc,dnd_check from users WHERE user_id = '".$user_id."'"); 
	if($getUserType->num_rows > 0) {
		$userTypeRes = $getUserType->fetch_assoc();
		$no_ndnc = $userTypeRes['no_ndnc'];
		$dnd_check = $userTypeRes['dnd_check'];
		 	if($dlr_status == 16 && $error_text = 'Misc Error') {
		 		 $dateTime = date('Y-m-d');     
		 		$logText = "CampaignID : $campaign_id,Dlr Status : $dlr_status, with $error_text from port : $port_no";
		 		error_log("\n".date('Y-m-d H:i:s')."| Misc Error Log |".$logText."\r\n",3,"/var/www/html/logs/Automation_logs/MiscErrorLog/striker_misc_log_".$dateTime.".log");  
		 	}  
			  
			  
			 $senderName_kennel = $sender_name; 
			 if($port_no > 0) {
				$getPortType = $mysqli->query("SELECT sending_port_no FROM sms_queue where sending_port_no = '".$port_no."' AND used_for = 'BSNL' "); 
				if($getPortType->num_rows > 0)  
				{     
					if($no_ndnc == 0 ) {       
						$senderName_kennel = "BA-611128";
					}else{ 
				 		$senderName_kennel = "BA-".$sender_name;
				 	}  
				 	  
					$dateTime = date('Y-m-d');     
					$logName = $user_id.'_'.$dateTime;  
					  	    
					$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($senderName_kennel)."&to=91$to_mobile&text=".urlencode($sms_txt);
					
					$URL .= "$unicode_sms$mclass&dlr-mask=19&dlr-url=".urlencode("http://pointsms.in/DLRS/reseller_dlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T&sms_port=$port_no");
					
				 	http_send($URL,$port_no);       
					$totalcnt = $totalcnt+1;       
					error_log("\n".date('Y-m-d H:i:s')."| Recampaign Automation For Campaign - $campaign_id | To Number $to_mobile and count ::: $totalcnt with URL ".$URL."\r\n",3,"/var/www/html/logs/Automation_logs/Campaign/pointsms_BNL_".$logName.".log");   
				} 
			}    
		} 
	}  
}


    
 
        
        
?>

