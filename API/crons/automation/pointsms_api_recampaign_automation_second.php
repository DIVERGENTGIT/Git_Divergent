 <?php

require_once 'db/config.php';
include("/var/www/html/strikerapp/smslib/config.inc");    
include("/var/www/html/strikerapp/smslib/functions.inc");     
 
$SERVER_NAME = SERVER_NAME; 
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
	
$getReCampaigns = $mysqli->query("SELECT message_id,user_id,sender_name,message,to_mobileno,port_no,error_text,dlr_status FROM sms_api_messages WHERE (error_code = '083' OR error_code = '036' OR error_code = '019' OR error_code = '225' OR error_code = '245' OR error_code = '100' OR error_code = '103' OR error_code = '106' OR error_code = '024' OR (dlr_status = 16 AND error_text ='Misc Error') ) AND date(ondate) = date(NOW()) AND (port_no IN ($bsnlPortStr)  OR  port_no LIKE '1%' ) AND re_campaign_status = 1 AND re_campaign_dlr_status = 1  LIMIT 5000");       
	     
  
	if($getReCampaigns->num_rows > 0 ) {        
		while($campaignResult = $getReCampaigns->fetch_assoc()) {        
			$message_id = $campaignResult['message_id'];     
			$sender_name = $campaignResult['sender_name'];    
			$user_id = $campaignResult['user_id'];    
			$sms_txt = trim($campaignResult['message']);  
		        $to_mobile = $campaignResult['to_mobileno'];     
		        $port_no = 51113; //$campaignResult['port_no'];  
			$unicode_sms = '';  
			     $dlr_status = $campaignResult['dlr_status'];  
		          $error_text = $campaignResult['error_text'];  
			//$mysqli->query("UPDATE sms_api_messages SET re_campaign_status = 3 WHERE message_id = '".$message_id."'  ");   
			$mclass ="&mclass=''";      
	  
	  		if($dlr_status == 16 && $error_text = 'Misc Error') {
        	 		 $dateTime = date('Y-m-d');     
        	 		$logText = "Message ID : $message_id,Dlr Status : $dlr_status, with $error_text from port : $port_no";
        	 		error_log("\n".date('Y-m-d H:i:s')."| Misc Error Log| ".$logText."\r\n",3,"/var/www/html/logs/Automation_logs/MiscErrorLog/pointsms_misc_log_".$dateTime.".log");  
		        }  
		        	 	
		        	 	 
		        $getUserType = $mysqli->query("select no_ndnc from users WHERE user_id = '".$user_id."'");
		        if($getUserType->num_rows > 0) {
		        	$userTypeRes = $getUserType->fetch_assoc();
		        	$no_ndnc = $userTypeRes['no_ndnc'];
		        	$senderName_kennel = $sender_name;    
		        	if($no_ndnc == 0 ) {       
					$port_no = 51313;
					$senderName_kennel = "001242";
				} 
				
				
				
		        		
		        	//if($port_no != '45113') {
		        	//	$port_no = 45113;
		        		$mysqli->query("UPDATE sms_api_messages SET port_no = '".$port_no."',re_campaign_status=2 WHERE message_id = '".$message_id."'  "); 
		        	//}  	
		        		
				
				
				/*if($port_no > 0) {
					$getPortType = $mysqli->query("SELECT sending_port_no FROM sms_queue where sending_port_no = '".$port_no."' AND used_for = 'BSNL' ");   
					if($getPortType->num_rows > 0)    
					{      
						if($no_ndnc == 0 ) {       
							$senderName_kennel = "BA-611128";
						}else{ 
					 		$senderName_kennel = "BA-".$sender_name;
					 	}
					}     
				} */           
				     
				     
				     
		     
				$dateTime = date('Y-m-d');     
				$logName = $user_id.'_'.$dateTime;
						                 
				$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($senderName_kennel)."&to=91$to_mobile&text=".urlencode($sms_txt);
				$URL .= "$unicode_sms$mclass&dlr-mask=19&dlr-url=".urlencode($SERVER_NAME."/api_reseller_dlr.php?campaign_id=$message_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T&sms_port=$port_no");    
			 	http_send($URL,$port_no);       
					               
				error_log("\n".date('Y-m-d H:i:s')."| Recampaign API Automation For Message ID - $message_id | To Number $to_mobile with URL ".$URL."\r\n",3,"/var/www/html/logs/Automation_logs/API/pointsms_api_IEA_".$logName.".log");  
				      
				  
				//$mysqli->query("UPDATE sms_api_messages SET re_campaign_status = 4 WHERE message_id = '".$message_id."'  "); 
			}
		}  
	}

}
        
        
?>

