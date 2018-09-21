<?php

require_once 'db/config_sms.php'; 
 
  $SERVER_NAME = SERVER_NAME;  
              
include("/var/www/html/strikerapp/smslib/config.inc");     
include("/var/www/html/strikerapp/smslib/functions.inc");       
          
$getReCampaigns = $mysqli->query("SELECT message_id,user_id,sender_name,message,to_mobileno,port_no FROM sms_api_messages WHERE  re_campaign_status = 0 AND (error_code = '001' OR error_code = '005' OR error_code = '010' OR error_code = '021') AND user_id = 4130 AND date(ondate) = date(NOW()) LIMIT 5000");  

if($getReCampaigns->num_rows > 0 ) {              
	while($campaignResult = $getReCampaigns->fetch_assoc()) {                
		$message_id = $campaignResult['message_id'];     
		$sender_name = $campaignResult['sender_name'];        
		$user_id = $campaignResult['user_id'];  
		$sms_txt = trim($campaignResult['message']);  
                $to_mobile = $campaignResult['to_mobileno'];       
                $port_no = $campaignResult['port_no'];  
		$unicode_sms = '';    
		    
		$mysqli->query("UPDATE sms_api_messages SET re_campaign_status = 1 WHERE message_id = '".$message_id."'  ");   
        	$mclass ="&mclass=''";      
   		$senderName_kennel = $sender_name;    
   		  
               $getUserType = $mysqli->query("select no_ndnc,dnd_check from users WHERE user_id = '".$user_id."'");
               if($getUserType->num_rows > 0) {
                	$userTypeRes = $getUserType->fetch_assoc();
                	$no_ndnc = $userTypeRes['no_ndnc'];
        		$dnd_check = $userTypeRes['dnd_check'];
	                 
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
		                      
			$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($senderName_kennel)."&to=91$to_mobile&text=".urlencode($sms_txt);
			$URL .= "$unicode_sms$mclass&dlr-mask=19&dlr-url=".urlencode($SERVER_NAME."/apidlr.php?campaign_id=$message_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T&sms_port=$port_no");  
		 	http_send($URL,$port_no);       
			                           
			error_log("\n".date('Y-m-d H:i:s')."| Recampaign API Automation For Message ID - $message_id | To Number $to_mobile with URL ".$URL."\r\n",3,"/var/www/html/logs/Automation_logs/API/APSRTC_api_".$user_id.".log");  
			        
				
			//$mysqli->query("UPDATE sms_api_messages SET re_campaign_status = 2 WHERE message_id = '".$message_id."'  "); 
		 }
	}  
}
 
        
        
?>

