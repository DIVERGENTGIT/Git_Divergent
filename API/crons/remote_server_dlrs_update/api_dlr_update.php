<?php


include("/var/www/html/strikerapp/API/dbconnect/config.php");
include("config.php");


$today = date("Y-m-d");
$day_month = substr($today,5,2);
$day_year = substr($today,0,4);
$backup_table = "sms_api_messages_dlr";

  

  
$getCampaigns = $mysqli->query("select message_id,to_mobileno from sms_api_messages where dlr_status = 0 and date(ondate) <= DATE_SUB(now(), INTERVAL 5 MINUTE) and date(ondate) = date(now())");      
  
while($campaignsRes = $getCampaigns->fetch_assoc()){
	 $getCampaignDlrs = mysql_query("select message_id,to_mobileno,delivered_on,dlr_status,error_text,error_code from $backup_table where message_id=$campaignsRes[message_id] and to_mobileno=$campaignsRes[to_mobileno]");

	while($campaignDlrsRes = mysql_fetch_array($getCampaignDlrs)) {  
		$mysqli->query("update sms_api_messages set  dlr_status='$campaignDlrsRes[dlr_status]',error_code='$campaignDlrsRes[error_code]',error_text='$campaignDlrsRes[error_text]',delivered_on='$campaignDlrsRes[delivered_on]' where message_id=$campaignDlrsRes[message_id] and to_mobileno=$campaignDlrsRes[to_mobileno]");
 	} 
}    

mysql_close($link);


?>
