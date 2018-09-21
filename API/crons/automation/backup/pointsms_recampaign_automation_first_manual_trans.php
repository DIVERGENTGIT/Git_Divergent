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
$getCampaignsProcessData = $mysqli->query("SELECT sms_text,to_mobile_no,port_no,campaign_id FROM campaigns_to WHERE (dlr_status = 16 AND error_text = 'Misc Error')  AND (port_no IN ($bsnlPortStr) OR  port_no LIKE '1%') AND campaign_id IN (2219810,2219811,2219812,2219813,2219814,2219816,2219817,2219818,2219819,2219821,2219822,2219823,2219824,2219826,2219827,2219828,2219830,2219831,2219832,2219833,2219834,2219835,2219836,2219837,2219838,2219839,2219840,2219841,2219842,2219843,2219844,2219845,2219846,2219847,2219848,2219849,2219850,2219851,2219852,2219854,2219855,2219858,2219861,2219863,2219869,2219870,2219871,2219872,2219873,2219874,2219875,2219876,2219878,2219879,2219880,2219881,2219882,2219884,2219885,2219886,2219887,2219888,2219889,2219890,2219891,2219893,2219894,2219896,2219898,2219899,2219900,2219902,2219903,2219904,2219905,2219906,2219907,2219908,2219909,2219910,2219911,2219912,2219913,2219915,2219916,2219917,2219918,2219919,2219920,2219921,2219923,2219924,2219925,2219926,2219928,2219929,2219930,2219931,2219932,2219933,2219934,2219936,2219937,2219938,2219939,2219940,2219941,2219942,2219943,2219944,2219946,2219947,2219948,2219949,2219950,2219951,2219952,2219953,2219954,2219955,2219956,2219957,2219958,2219959,2219960,2219961,2219963,2219964,2219965,2219966,2219969,2219970,2219971,2219972,2219974,2219975,2219976,2219978,2219979,2219980,2219981,2219983,2219984,2219985,2219986,2219987,2219988,2219989,2219990,2219991,2219992,2219993,2219994,2219995,2219996,2219997,2219999,2220000,2220001,2220002,2220004,2220005,2220006,2220007,2220008,2220009,2220010,2220011,2220012,2220013,2220015,2220016,2220017,2220018,2220019,2220020,2220021,2220022) GROUP BY campaign_id");	
if($getCampaignsProcessData->num_rows > 0 ) {          
		$totalcnt = 0;  
		$processCount = $getCampaignsProcessData->num_rows;   
		$mclass ="&mclass=''";       
		while($campaignsProcessDataRes = $getCampaignsProcessData->fetch_assoc()) {
			$campaignID = trim($campaignsProcessDataRes['campaign_id']);   
					 	          
			$getReCampaigns = $mysqli->query("SELECT campaign_id,user_id,sender_name,is_unicode_sms FROM campaigns WHERE    campaign_id = '".$campaignID."' AND campaign_status = 2 AND re_campaign_status < 5  ");    
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
									 	
									 	 $dateTime = date('Y-m-d');       
										$logName = $user_id.'_'.$dateTime;  
										     
										$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($senderName_kennel)."&to=91$to_mobile&text=".urlencode($sms_txt);
										$URL .= "$unicode_sms$mclass&dlr-mask=19&dlr-url=".urlencode("http://pointsms.in/DLRS/reseller_dlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");
									 	http_send($URL,$port_no);       
												       
										$totalcnt = $totalcnt+1;      
										error_log("\n".date('Y-m-d H:i:s')."| Recampaign Automation For Campaign - $campaign_id | To Number $to_mobile and count ::: $totalcnt with URL ".$URL."\r\n",3,"/var/www/html/logs/Automation_logs/Campaign/pointsms_transMiscErr_".$logName.".log");  
				 						      
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

