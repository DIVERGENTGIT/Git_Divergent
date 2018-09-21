<?php 
$db = mysql_pconnect("localhost","smsstrikerapp",'$tr!k3r@2009') or die(mysql_error());
mysql_select_db("sms",$db) or die(mysql_error());

$day_before_yesterday = date("Y-m-d", strtotime("-1 days"));
$day_month = substr($day_before_yesterday,5,2);
$day_year = substr($day_before_yesterday,0,4);
//taking backup of day before yesterday's data

$backup_table = "sms_api_messages_dlr_".$day_month.$day_year;
 $backup_query = "insert into campaigns_backup.$backup_table ( select * from sms.sms_api_messages_dlr where date(delivered_on)='$day_before_yesterday' )";

$backup_result = mysql_query($backup_query);

//delete from sms_api_messages table of day before yesterdays
if($backup_result) {
	$delete_query = "delete from sms.sms_api_messages_dlr where date(delivered_on) = '$day_before_yesterday'";
	mysql_query($delete_query);
}

mysql_close($db);
?>
