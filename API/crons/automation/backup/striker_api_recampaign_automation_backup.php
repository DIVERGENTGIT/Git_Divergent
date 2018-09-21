<?php

$server_ip = "localhost"; 
$db_user = "strikerapp"; 
$db_pass = 'Off!c3@v2017';  
$db_name = "sms";           

$mysqli = new mysqli($server_ip, $db_user, $db_pass, $db_name);    
$mysqli->set_charset("utf8");   
         
include("/var/www/html/strikerapp/smslib/config.inc");     
include("/var/www/html/strikerapp/smslib/functions.inc");     
          
$getReCampaigns = $mysqli->query("SELECT message_id,user_id,sender_name,message,to_mobileno,port_no FROM sms_api_messages WHERE  re_campaign_status = 0 AND user_id = 5482 AND (error_code = '083' OR error_code = '036') AND date(ondate) = date(NOW()) LIMIT 500"); 
if($getReCampaigns->num_rows > 0 ) {            
	while($campaignResult = $getReCampaigns->fetch_assoc()) {            
		$message_id = $campaignResult['message_id'];     
		$sender_name = $campaignResult['sender_name'];        
		$user_id = $campaignResult['user_id'];  
		$sms_txt = trim($campaignResult['message']);  
                $to_mobile = $campaignResult['to_mobileno'];     
                $port_no = $campaignResult['port_no'];  
		$unicode_sms = '';    
	        /*if($is_unicode_sms == 1) {
			$unicode_sms = "&coding=2&charset=utf-8"; 
		}*/  
		    
		$mysqli->query("UPDATE sms_api_messages SET re_campaign_status = 1 WHERE message_id = '".$message_id."'  ");   
		//$totalcnt = 0;   
        	//$processCount = $getReCampaigns->num_rows;   
        	$mclass ="&mclass=''";      
  
                $getUserType = $mysqli->query("select no_ndnc,dnd_check from users WHERE user_id = '".$user_id."'");
                if($getUserType->num_rows > 0) {
                	$userTypeRes = $getUserType->fetch_assoc();
                	$no_ndnc = $userTypeRes['no_ndnc'];
        		$dnd_check = $userTypeRes['dnd_check'];
	                		
                	/*if($no_ndnc == 1 && $dnd_check == 1) {  
                	        $port_no = 35213;
               		}
               		  
               		if($no_ndnc == 1) {
                		$port_no = 34813;
                	}
                		   
               		if($no_ndnc == 0) {
                		$port_no = 36113;
                	}*/ 
                	
                	
                	//  $mysqli->query("UPDATE sms_api_messages SET port_no =  '".$port_no."'  WHERE message_id = '".$message_id."'  ");  	  
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
			$URL .= "$unicode_sms$mclass&dlr-mask=19&dlr-url=".urlencode("https://www.smsstriker.com/API/DLRS/apidlr.php?campaign_id=$message_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");  
		 	http_send($URL,$port_no);       
			                           
			//$totalcnt = $totalcnt+1;          
			error_log("\n".date('Y-m-d H:i:s')."| Recampaign API Automation For Message ID - $message_id | To Number $to_mobile with URL ".$URL."\r\n",3,"/var/www/html/logs/Automation_logs/API/striker_api_".$user_id.".log");  
			        
			//    echo $totalcnt.','.$processCount;        
			      
			//if($totalcnt == $processCount){        
				
			$mysqli->query("UPDATE sms_api_messages SET re_campaign_status = 2 WHERE message_id = '".$message_id."'  "); 
			 //break;      
			//}
		}
	}  
}
 
        
        
?>

