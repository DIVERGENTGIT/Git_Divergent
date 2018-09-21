<?php


require_once 'db/config_sms.php';
include("/var/www/html/strikerapp/smslib/config.inc");
include("/var/www/html/strikerapp/smslib/functions.inc");  

  
$getReCampaigns = $mysqli->query("SELECT campaign_id,user_id,sender_name,is_unicode_sms FROM campaigns WHERE re_campaign_status = 2 AND campaign_status = 2   and date(created_on) = date(NOW())    LIMIT 1");
  
  
  
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
		  
		$mysqli->query("UPDATE campaigns SET re_campaign_status = 3 WHERE campaign_id = '".$campaign_id."'  "); 
			
			
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
				    
			$getCampaignsProcessData = $mysqli->query("SELECT sms_text,to_mobile_no,port_no,dlr_status,error_text FROM campaigns_to WHERE campaign_id ='".$campaign_id."' AND (error_code = '083' OR error_code = '036' OR error_code = '019' OR error_code = '225' OR error_code = '245' OR error_code = '100' OR error_code = '103' OR error_code = '106' OR error_code = '024' OR (dlr_status = 16 AND error_text ='Misc Error')) AND (port_no IN ($bsnlPortStr)  OR  port_no LIKE '1%' )  ");           
			if($getCampaignsProcessData->num_rows > 0 ) {  
				$totalcnt = 0;  
				$processCount = $getCampaignsProcessData->num_rows; 
				$mclass ="&mclass=''";  

				while($campaignsProcessDataRes = $getCampaignsProcessData->fetch_assoc()) {
					$sms_txt = trim($campaignsProcessDataRes['sms_text']);
				        $to_mobile = $campaignsProcessDataRes['to_mobile_no'];
				        $port_no = 51113; //$campaignsProcessDataRes['port_no'];
				          $dlr_status = $campaignsProcessDataRes['dlr_status'];
				        $error_text = $campaignsProcessDataRes['error_text'];
				        
				        $getUserType = $mysqli->query("select no_ndnc,dnd_check from users WHERE user_id = '".$user_id."'");
				        if($getUserType->num_rows > 0) {
				        	$userTypeRes = $getUserType->fetch_assoc();
				        	$no_ndnc = $userTypeRes['no_ndnc'];
				        	$dnd_check = $userTypeRes['dnd_check'];
						  
						 if($dlr_status == 16 && $error_text = 'Misc Error') {
				        	 		 $dateTime = date('Y-m-d');     
				        	 		$logText = "CampaignID : $campaign_id,Dlr Status : $dlr_status, with $error_text ";
				        	 		error_log("\n".date('Y-m-d H:i:s')."| Misc Error Log |".$logText."\r\n",3,"/var/www/html/logs/Automation_logs/MiscErrorLog/striker_misc_log_".$dateTime.".log");  
				        	 	}  
				        	 	
				        	   
				        	   
				        	   	 
						
						//if($port_no != '45113') {
							/* Insert into misc error log table
				        	 	if($dlr_status == 16 && $error_text = 'Misc Error') {
								$getUserType = $mysqli->query("SELECT * FROM notify_misc_error WHERE port_no = '".$port_no."' AND created_on = date(now()) and is_notified = 1");
								if($getUserType->num_rows == 0) {
							 		$mysqli->query("INSERT INTO notify_misc_error SET port_no = '".$port_no."', campaign_id = '".$campaign_id."' ,source='Striker' "); 
							 	}  
				        	 	}*/
						
	//						$port_no = 45113;
							$mysqli->query("UPDATE campaigns_to SET port_no = '".$port_no."' WHERE campaign_id = '".$campaign_id."' and to_mobile_no='".$to_mobile."' "); 
					//	} 
						$senderName_kennel = $sender_name;
						//if($port_no > 0) {
						//	$getPortType = $mysqli->query("SELECT sending_port_no FROM sms_queue where sending_port_no = '".$port_no."' AND used_for = 'BSNL' "); 
						//	if($getPortType->num_rows > 0)  
						//	{    
						//		if($no_ndnc == 0 ) {       
						//			$senderName_kennel = "BA-611128";
						//		}else{ 
						//	 		$senderName_kennel = "BA-".$sender_name;
						//	 	} 
							 	
							 	  
								 $dateTime = date('Y-m-d');     
								$logName = $user_id.'_'.$dateTime;  
								  	    
								$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($senderName_kennel)."&to=91$to_mobile&text=".urlencode($sms_txt);
								$URL .= "$unicode_sms$mclass&dlr-mask=19&dlr-url=".urlencode("https://www.smsstriker.com/API/DLRS/dlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T&sms_port=$port_no");
							 	http_send($URL,$port_no); 
								       
								$totalcnt = $totalcnt+1;  
								   
								error_log("\n".date('Y-m-d H:i:s')."| Recampaign Automation For Campaign - $campaign_id | To Number $to_mobile and count ::: $totalcnt with URL ".$URL."\r\n",3,"/var/www/html/logs/Automation_logs/Campaign/striker_IEA_".$logName.".log");  
								     
								if($totalcnt == $processCount){ 
									$mysqli->query("UPDATE campaigns SET re_campaign_status = 4 WHERE campaign_id = '".$campaign_id."'  "); 
									break;  
								} 
							}  
						}      
					}
				}     
			}  
	        }
//	}  
//}
 
        
        
?>

