<?php
$link=mysql_pconnect("localhost","smsstrikerapp",'$tr!k3r@2009');
mysql_select_db("sms");

$today = date("Y-m-d");
$day_month = substr($today,5,2);
$day_year = substr($today,0,4);
//$backup_table = "campaigns_backup.campaigns_dlr_".$day_month.$day_year;

$backup_table = "sms_api_messages_dlr";


$sqlst=mysql_query("select message_id,to_mobileno from sms_api_messages where dlr_status=0 and date(ondate)<=DATE_SUB(now(), INTERVAL 5 MINUTE) and date(ondate)=date(now())");

while($rec=mysql_fetch_array($sqlst)){

$stmnt=mysql_query("select message_id,to_mobileno,delivered_on,dlr_status,error_text,error_code from $backup_table where message_id=$rec[message_id] and to_mobileno=$rec[to_mobileno]");


while($dlrrec=mysql_fetch_array($stmnt)){

mysql_query("update sms_api_messages set dlr_status='$dlrrec[dlr_status]',error_code='$dlrrec[error_code]',error_text='$dlrrec[error_text]',delivered_on=FROM_UNIXTIME($ts) where message_id='$dlrrec[message_id]' and to_mobileno='$dlrrec[to_mobileno]'");

  

 }
			
  }  

mysql_close($link);
?>
