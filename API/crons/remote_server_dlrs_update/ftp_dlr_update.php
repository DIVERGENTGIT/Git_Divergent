<?php


include("/var/www/html/strikerapp/API/dbconnect/config.php");
include("config.php");


$today = date("Y-m-d");
$day_month = substr($today,5,2);
$day_year = substr($today,0,4);
$backup_table = "ftp_campaigns_to_dlr";
 
  
$getCampaigns = $mysqli->query("select campaign_id,to_mobile_no from ftp_campaigns_to where dlr_status = 0 and date(sent_on) <= DATE_SUB(now(), INTERVAL 5 MINUTE) and date(sent_on) = date(now())");    

while($campaignsRes = $getCampaigns->fetch_assoc()){
	 $getCampaignDlrs = mysql_query("select campaign_id,to_mobile_no,delivered_on,dlr_status,error_text,error_code from $backup_table where campaign_id=$campaignsRes[campaign_id] and to_mobile_no=$campaignsRes[to_mobile_no]");
  
	while($campaignDlrsRes = mysql_fetch_array($getCampaignDlrs)) {  
		$mysqli->query("update ftp_campaigns_to set  dlr_status='$campaignDlrsRes[dlr_status]',error_code='$campaignDlrsRes[error_code]',error_text='$campaignDlrsRes[error_text]',delivered_on='$campaignDlrsRes[delivered_on]' where campaign_id=$campaignDlrsRes[campaign_id] and to_mobile_no=$campaignDlrsRes[to_mobile_no]");
  
 	} 
}  




mysql_close($link);


?>
