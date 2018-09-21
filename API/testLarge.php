<?php  

 include("/var/www/html/strikerapp/API/dbconnect/config.php");  
 	 	 
echo sms_alert('sandeepthi',2,1550434);


function sms_alert($uname,$total_no_of_sms,$campaign_id){
	echo $user=SMS_ALERT_USER; //your username
 
	$password=SMS_ALERT_PWD; //your password
	$message = "Large Campaign Alert. From User $uname, Campaign ID:$campaign_id and Total Campaign Size : $total_no_of_sms"; //enter Your Message

	$senderid=SMS_ALERT_SENDERID; //Your senderid
	$messagetype="1"; //Type Of Your Message  
	$url=CALL_SMS_API;    
  
	$message = urlencode($message);
	$ch = curl_init();  
	if (!$ch){ die("Couldn't initialize a cURL handle"); }   
	$ret = curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt ($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
	//curl_setopt ($ch, CURLOPT_POSTFIELDS,
	//"username=$user&password=$password&to=$mno&msg=$message&from=$senderid&type=$messagetype");
 
	curl_setopt ($ch, CURLOPT_POSTFIELDS,
	"username=$user&password=$password&to=".SMS_ALERT_TO."&msg=$message&from=$senderid&type=$messagetype");

	$ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  
	$curlresponse = curl_exec($ch); // execute
	echo $curlresponse;
}
	//echo "end";


 
$mysqli->close();
?>
