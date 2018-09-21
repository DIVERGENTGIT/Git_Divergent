<?php

		 require_once 'db/config.php';
include("/var/www/html/strikerapp/smslib/config.inc");     
include("/var/www/html/strikerapp/smslib/functions.inc");     
   
         
$bsnlPortStr = '';    
$getBSNLPorts = $mysqli->query("SELECT sending_port_no FROM sms_queue where used_for = 'BSNL' GROUP BY sending_port_no "); 
if($getBSNLPorts->num_rows > 0)  
{ 
	while($BSNLPorts = $getBSNLPorts->fetch_assoc()) {
		$bsnlPortStr .= $BSNLPorts['sending_port_no'].',';
	}
}  
        
  $bsnlPortStr = rtrim($bsnlPortStr,',');  
$bsnlPortArr = explode(',',$bsnlPortStr);
      
if(count($bsnlPortArr)) {       
	$getReCampaigns = $mysqli->query("SELECT *  FROM `sms_api_messages` WHERE `dlr_status` = 16 and ondate >= '2018-07-05 19:00:00' and char_length(to_mobileno) = 10 and error_text = 'Invalid Number'
  ORDER BY `message_id` DESC ");  
	  
	// $mysqli->query("SELECT message_id,user_id,sender_name,message,to_mobileno,port_no,dlr_status,error_text FROM sms_api_messages WHERE  re_campaign_status = 0 AND (error_code = '083' OR error_code = '036' OR error_code = '019' OR error_code = '225' OR error_code = '245' OR error_code = '100' OR error_code = '103' OR error_code = '106' OR error_code = '024' OR (dlr_status = 16 AND error_text ='Misc Error')) AND date(ondate) = date(NOW()) AND  (port_no IN ($bsnlPortStr)  OR  port_no LIKE '1%') LIMIT 5000"); 
	if($getReCampaigns->num_rows > 0 ) {            
		while($campaignResult = $getReCampaigns->fetch_assoc()) {            
			echo  $message_id = $campaignResult['message_id'];      echo "</br>";
			$sender_name = $campaignResult['sender_name'];          
			$user_id = $campaignResult['user_id'];  
			$sms_txt = trim($campaignResult['message']);  
		        $to_mobile = $campaignResult['to_mobileno'];     
		        $port_no = $campaignResult['port_no'];  
		         $dlr_status = $campaignResult['dlr_status'];  
		          $error_text = $campaignResult['error_text'];  
			$unicode_sms = '';      
			    
			$mysqli->query("UPDATE sms_api_messages SET re_campaign_status = 1 WHERE message_id = '".$message_id."'  ");   
			$mclass ="&mclass=''";      
	  
		        $getUserType = $mysqli->query("select no_ndnc,dnd_check from users WHERE user_id = '".$user_id."'");
		        if($getUserType->num_rows > 0) {
		        	$userTypeRes = $getUserType->fetch_assoc();
		        	$no_ndnc = $userTypeRes['no_ndnc'];
				$dnd_check = $userTypeRes['dnd_check'];
			        
			       /* if($port_no != '45113') { 
			        	if($dlr_status == 16 && $error_text = 'Misc Error') {
		        	 		 $dateTime = date('Y-m-d');     
		        	 		$logText = "Message ID : $message_id,Dlr Status : $dlr_status, with $error_text from port : $port_no";
		        	 		error_log("\n".date('Y-m-d H:i:s')."| Misc Error Log | ".$logText."\r\n",3,"/var/www/html/logs/Automation_logs/MiscErrorLog/striker_misc_log_".$dateTime.".log");  
		        	 	}  
		        		$port_no = 45113;
		        		$mysqli->query("UPDATE sms_api_messages SET port_no = '".$port_no."' WHERE message_id = '".$message_id."'  "); 
		        	}  */
		        			
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
					 	
					 	
					}
					}	  
					  		  
					  $dateTime = date('Y-m-d');     
						$logName = $user_id.'_'.$dateTime; 
						$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($senderName_kennel)."&to=91$to_mobile&text=".urlencode($sms_txt);
						$URL .= "$unicode_sms$mclass&dlr-mask=19&dlr-url=".urlencode("http://pointsms.in/DLRS/api_reseller_dlr.php?campaign_id=$message_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");
					 	http_send($URL,$port_no);         
								       
						error_log("\n".date('Y-m-d H:i:s')."| Recampaign API Automation For Message ID - $message_id | To Number $to_mobile with URL ".$URL."\r\n",3,"/var/www/html/logs/Automation_logs/API/pointsms_api_".$logName.".log");  
						      
				
					$mysqli->query("UPDATE sms_api_messages SET re_campaign_status = 2 WHERE message_id = '".$message_id."'  "); 	
					    
				//}        
			}
		}  
	}
}
 
        
        
?>

