<?php

require_once 'db/config.php';
include("/var/www/html/strikerapp/smslib/config.inc");    
include("/var/www/html/strikerapp/smslib/functions.inc");  

$port_no = 45113;
$dateTime = date('Y-m-d');       
$logName = $user_id.'_'.$dateTime;     
$totalcnt = 0;
 
$senderName_kennel = 'BA-MEDHAV';
$campaign_id= 2230529;   
       
$to_numbers_array = array(8309762612); 
$unicode_sms = '';    
$mclass ="&mclass=''";             
 
$getCamapignData = $mysqli->query("SELECT user_id,sender_name,sms_text,sms_count,created_on,is_unicode_sms From campaigns where campaign_id = '".$campaign_id."' ");
 
if($getCamapignData->num_rows > 0 ) {          
	$camapignDataRes = $getCamapignData->fetch_assoc();
	$user_id = $camapignDataRes['user_id'];
	$sender_name = $camapignDataRes['sender_name'];
	$sms_text = $camapignDataRes['sms_text'];
	$sms_count = $camapignDataRes['sms_count'];
	$created_on = $camapignDataRes['created_on'];
	$is_unicode_sms = $camapignDataRes['is_unicode_sms'];
	$unicode_sms = '';
	if($is_unicode_sms == 1) { 
		$unicode_sms = "&coding=2&charset=utf-8";
	} 
	foreach($to_numbers_array as $to_mobile) {
		echo "INSERT INTO campaigns_to SET campaign_id = '".$campaign_id."',user_id='".$user_id."',sender_name='".$sender_name."',to_mobile_no='".$to_mobile."',sms_text='".$sms_text."',sms_count='".$sms_count."',sent_on='".$created_on."',port_no='".$port_no."'";
		
		echo "</br>";  
  
		//$mysqli->query("INSERT INTO campaigns_to SET campaign_id = '".$campaign_id."',user_id='".$user_id."',sender_name='".$sender_name."',to_mobile_no='".$to_mobile."',sms_text='".$sms_text."',sms_count='".$sms_count."',sent_on='".$created_on."',port_no='".$port_no."'");
		$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($senderName_kennel)."&to=91$to_mobile&text=".urlencode($sms_text);  
		$URL .= "$unicode_sms$mclass&dlr-mask=19&dlr-url=".urlencode("http://pointsms.in/DLRS/reseller_dlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");
		http_send($URL,$port_no);         
		$totalcnt = $totalcnt+1;      
		error_log("\n".date('Y-m-d H:i:s')."| Recampaign Automation For Campaign - $campaign_id | To Number $to_mobile and count ::: $totalcnt with URL ".$URL."\r\n",3,"/var/www/html/logs/Automation_logs/Campaign/pointsms_scrubMiscErr_".$logName.".log");  
	}

	 
}



?>
  
