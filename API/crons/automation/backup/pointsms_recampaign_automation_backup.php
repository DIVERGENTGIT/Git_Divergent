 <?php

$server_ip = "localhost";   
$db_user = "pointsmsapp";
$db_pass = 'po!nt$m$@2009';  
$db_name = "sms_reseller";    

$mysqli = new mysqli($server_ip, $db_user, $db_pass, $db_name);    
$mysqli->set_charset("utf8");  
   
include("/var/www/html/strikerapp/smslib/config.inc");    
include("/var/www/html/strikerapp/smslib/functions.inc");  
         
$getReCampaigns = $mysqli->query("SELECT campaign_id,user_id,sender_name,is_unicode_sms FROM campaigns WHERE re_campaign_status = 0 AND campaign_status = 2 AND  date(created_on) = date(NOW()) LIMIT 1 ");    
                  
if($getReCampaigns->num_rows > 0 ) {              
	while($campaignResult = $getReCampaigns->fetch_assoc()) {    
		$campaign_id = $campaignResult['campaign_id'];       
		$sender_name = $campaignResult['sender_name'];  
		$user_id = $campaignResult['user_id'];
		$is_unicode_sms = $campaignResult['is_unicode_sms'];   
		$unicode_sms = '';
	        if($is_unicode_sms == 1) { 
			$unicode_sms = "&coding=2&charset=utf-8";
		}
 		   
 		$mysqli->query("UPDATE campaigns SET re_campaign_status = 1 WHERE campaign_id = '".$campaign_id."'  "); 
 		
	        $getCampaignsProcessData = $mysqli->query("SELECT sms_text,to_mobile_no,port_no FROM campaigns_to WHERE campaign_id ='".$campaign_id."' AND (error_code = '083' OR error_code = '036' OR error_code = '056' OR error_code = '075' OR error_code = '084' OR error_code = '098')");          
	        if($getCampaignsProcessData->num_rows > 0 ) {      
	        	$totalcnt = 0;
	        	$processCount = $getCampaignsProcessData->num_rows; 
	        	$mclass ="&mclass=''";      

			while($campaignsProcessDataRes = $getCampaignsProcessData->fetch_assoc()) {
				$sms_txt = trim($campaignsProcessDataRes['sms_text']);
		                $to_mobile = $campaignsProcessDataRes['to_mobile_no'];
		                $port_no = $campaignsProcessDataRes['port_no'];
		                
		                $getUserType = $mysqli->query("select no_ndnc,dnd_check from users WHERE user_id = '".$user_id."'");
		                if($getUserType->num_rows > 0) {
		                	$userTypeRes = $getUserType->fetch_assoc();
		                	$no_ndnc = $userTypeRes['no_ndnc'];
		                	$dnd_check = $userTypeRes['dnd_check'];
		                		
		                	if($no_ndnc == 1 && $dnd_check == 1) {
		                	        $port_no = 35213;
		               		}
		               		  
		               		if($no_ndnc == 1) {
		                		$port_no = 34813;
		                	}
		                		   
		               		if($no_ndnc == 0) {
		                		$port_no = 36113;
		                	}
		                	
		               		 $mysqli->query("UPDATE campaigns_to SET port_no =  '".$port_no."'  WHERE campaign_id = '".$campaign_id."' AND to_mobile_no = '".$to_mobile."'  ");  
		                		    
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
					$URL .= "$unicode_sms$mclass&dlr-mask=19&dlr-url=".urlencode("http://pointsms.in/DLRS/reseller_dlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");
				 	http_send($URL,$port_no);       
					                       
					$totalcnt = $totalcnt+1;    
					error_log("\n".date('Y-m-d H:i:s')."| Recampaign Automation For Campaign - $campaign_id | To Number $to_mobile and count ::: $totalcnt with URL ".$URL."\r\n",3,"/var/www/html/logs/Automation_logs/Campaign/pointsms_".$user_id.".log");  
					    
					if($totalcnt == $processCount){      
						$mysqli->query("UPDATE campaigns SET re_campaign_status = 2 WHERE campaign_id = '".$campaign_id."'  "); 
						break;  
					}
				}
			}  
	        }
	}  
}
 
        
        
?>

