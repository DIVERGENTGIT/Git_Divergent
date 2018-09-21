<?php
$link=mysql_pconnect("localhost","strikerapp",'Off!c3@v2017');
mysql_select_db("sms");

$today = date("Y-m-d");
$day_month = substr($today,5,2);
$day_year = substr($today,0,4);
$backup_table = "ftp_campaigns_to_dlr";
//$backup_table = "ftp_campaigns_to_dlr_".$day_month.$day_year;

//$backup_table = "sms_api_messages_dlr";


$sqlst=mysql_query("select campaign_id,to_mobile_no from ftp_campaigns_to where dlr_status=0 and date(sent_on)<=DATE_SUB(now(), INTERVAL 5 MINUTE) and date(sent_on)=date(now())");
  
while($rec=mysql_fetch_array($sqlst)){

$stmnt=mysql_query("select campaign_id,to_mobile_no,delivered_on,dlr_status,error_text,error_code from $backup_table where campaign_id=$rec[campaign_id] and to_mobile_no=$rec[to_mobile_no]");


while($dlrrec=mysql_fetch_array($stmnt)){  

mysql_query("update ftp_campaigns_to set dlr_status='$dlrrec[dlr_status]',error_code='$dlrrec[error_code]',error_text='$dlrrec[error_text]',delivered_on='$dlrrec[delivered_on]' where campaign_id='$dlrrec[campaign_id]' and to_mobile_no='$dlrrec[to_mobile_no]'");



 }
			
  }  

mysql_close($link);
?>
