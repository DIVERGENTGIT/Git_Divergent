 <?php

require_once 'db/config_sms.php';
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
	$getCampaignsProcessData = $mysqli->query("SELECT sms_text,to_mobile_no,port_no,campaign_id FROM campaigns_to WHERE (dlr_status = 16 AND error_text = 'Misc Error')  AND (port_no IN ($bsnlPortStr) OR  port_no LIKE '1%') AND campaign_id IN (1721126,1721057,1721072,1721098,1721111,1721112,1721114,1721115,1721116,1721118,1721122,1721123,1721124,1721125,1721127,1721130,1721131,1721132,1721134,1721135,1721136,1721137,1721138,1721140,1721142,1721143,1721145,1721146,1721147,1721148,1721150,1721151,1721152,1721154,1721158,1721159,1721160,1721163)  GROUP BY campaign_id ");    
	if($getCampaignsProcessData->num_rows > 0 ) {          
		$totalcnt = 0; 
		$processCount = $getCampaignsProcessData->num_rows; 
		$mclass ="&mclass=''";        
		while($campaignsProcessDataRes = $getCampaignsProcessData->fetch_assoc()) {
			$campaignID = trim($campaignsProcessDataRes['campaign_id']);   
				  		          
			$getReCampaigns = $mysqli->query("SELECT campaign_id,user_id,sender_name,is_unicode_sms FROM campaigns WHERE    campaign_id = '".$campaignID."' AND campaign_status = 2   AND re_campaign_status < 5 ");    
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
		 		   
		 		 	$mysqli->query("UPDATE campaigns SET re_campaign_status = 5 WHERE campaign_id = '".$campaign_id."'  "); 
		 		
		 		
			 		/*$bsnlPortStr = '';
			 		  
			 		$mysqli->query("UPDATE campaigns SET re_campaign_status = 1 WHERE campaign_id = '".$campaign_id."'  ");    
			 		$getBSNLPorts = $mysqli->query("SELECT sending_port_no FROM sms_queue where used_for = 'BSNL' GROUP BY sending_port_no "); 
					if($getBSNLPorts->num_rows > 0)  
					{ 
						while($BSNLPorts = $getBSNLPorts->fetch_assoc()) {
							$bsnlPortStr .= $BSNLPorts['sending_port_no'].',';
						}
					}
				
			 		$bsnlPortStr = rtrim($bsnlPortStr,',');
			 		$bsnlPortArr = explode(',',$bsnlPortStr);
			 		      
			 		if(count($bsnlPortArr)) {*/
			 		
				       	 $getCampaignsProcessData1 = $mysqli->query("SELECT sms_text,to_mobile_no,port_no FROM campaigns_to WHERE campaign_id ='".$campaign_id."' AND (dlr_status = 16 AND error_text = 'Misc Error') AND  (port_no IN ($bsnlPortStr) OR  port_no LIKE '1%')  ");          
					if($getCampaignsProcessData1->num_rows > 0 ) {        
						$totalcnt = 0;
						$processCount = $getCampaignsProcessData1->num_rows; 
						$mclass ="&mclass=''";      

						while($campaignsProcessDataRes1 = $getCampaignsProcessData1->fetch_assoc()) {
							$sms_txt = trim($campaignsProcessDataRes1['sms_text']);
							$to_mobile = $campaignsProcessDataRes1['to_mobile_no'];
							$port_no = $campaignsProcessDataRes1['port_no'];
						
							if($port_no != '45113') {
								$port_no = 45113;
								$mysqli->query("UPDATE campaigns_to SET port_no = '".$port_no."' WHERE campaign_id = '".$campaign_id."'  "); 
							}    
							
							$getUserType = $mysqli->query("select no_ndnc,dnd_check from users WHERE user_id = '".$user_id."'");
							if($getUserType->num_rows > 0) {
								$userTypeRes = $getUserType->fetch_assoc();
							echo	$no_ndnc = $userTypeRes['no_ndnc'];
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
									 	
									 	 $dateTime = date('Y-m-d');       
										$logName = $user_id.'_'.$dateTime;  
										     
										$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($senderName_kennel)."&to=91$to_mobile&text=".urlencode($sms_txt);
								$URL .= "$unicode_sms$mclass&dlr-mask=19&dlr-url=".urlencode("https://www.smsstriker.com/API/DLRS/dlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");
									 	http_send($URL,$port_no);       
												       
					 					$totalcnt = $totalcnt+1;      
										error_log("\n".date('Y-m-d H:i:s')."| Recampaign Automation For Campaign - $campaign_id | To Number $to_mobile and count ::: $totalcnt with URL ".$URL."\r\n",3,"/var/www/html/logs/Automation_logs/Campaign/striker_transMiscErr_".$logName.".log");  
										      
										if($totalcnt == $processCount){      
										//	$mysqli->query("UPDATE campaigns SET re_campaign_status = 2 WHERE campaign_id = '".$campaign_id."'  "); 
											break;  
										}
									 	
									}     
								}        
							}
						}
					}  
				//}
				}
			}  
		}	
	}
	 
}

        
        
?>

