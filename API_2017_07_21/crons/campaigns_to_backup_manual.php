<?php 
$db = mysql_pconnect("localhost","smsstrikerapp",'$tr!k3r@2009') or die(mysql_error());
mysql_select_db("sms",$db) or die(mysql_error());

$day_before_yesterday = date("Y-m-d", strtotime("-2 days"));
//$day_before_yesterday='2016-06-26';

$day_month = substr($day_before_yesterday,5,2);
$day_year = substr($day_before_yesterday,0,4);

//unscheduled campaigns
$campaigns_query = "select campaign_id from campaigns where is_scheduled = 0 and date(created_on)= '$day_before_yesterday'";
$campaigns_rs = mysql_query($campaigns_query);

if(mysql_num_rows($campaigns_rs) > 0) {

	while($campaigns_val = mysql_fetch_array($campaigns_rs)) {
		$campaign_id = $campaigns_val['campaign_id'];
		
		//counts
		$query = "SELECT count(to_mobile_no) as total_count,
			(count(CASE WHEN dlr_status is NULL THEN to_mobile_no END) + count(CASE WHEN dlr_status=0 THEN to_mobile_no END)) as pending_dlr_count,
			count(CASE WHEN dlr_status =1 THEN to_mobile_no END) as delivered_count,
			count(CASE WHEN dlr_status=2 THEN to_mobile_no END) as expired_count,
			(count(CASE WHEN dlr_status=3 THEN to_mobile_no END)+ count(CASE WHEN dlr_status =16 and error_code='0x00000481' THEN to_mobile_no END)) as dnd_count,
			count(CASE WHEN dlr_status=16 and error_code!='0x00000481' THEN to_mobile_no END) as invalid_count 
			FROM campaigns_to WHERE campaign_id='$campaign_id'";
		
		$rs = mysql_query($query);		
		$val = mysql_fetch_array($rs);
		
		$total_count = $val['total_count'];
		$delivered_count = $val['delivered_count'];
		$expired_count = $val['expired_count'];
		$dnd_count = $val['dnd_count'];
		$pending_dlr_count=$val['pending_dlr_count'];
		$invalid_count = $val['invalid_count'];
		
		
		//update
		mysql_query("update campaigns SET 
			total_numbers_count = '$total_count',
			delivered_count = '$delivered_count',
			expired_count = '$expired_count',
			dnd_count = '$dnd_count',
			pending_dlrs_count= '$pending_dlr_count',
			invalid_count = '$invalid_count'
			WHERE campaign_id = '$campaign_id'
		");
		
	
	}

}

//scheduled campaigns
$campaigns_query = "select campaign_id from campaigns where is_scheduled = 1 and date(scheduled_on)= '$day_before_yesterday'";
$campaigns_rs = mysql_query($campaigns_query);

if(mysql_num_rows($campaigns_rs) > 0) {

	while($campaigns_val = mysql_fetch_array($campaigns_rs)) {
		$campaign_id = $campaigns_val['campaign_id'];
		
		//counts
		$query = "SELECT count(to_mobile_no) as total_count,
			(count(CASE WHEN dlr_status is NULL THEN to_mobile_no END) + count(CASE WHEN dlr_status=0 THEN to_mobile_no END)) as pending_dlr_count,
			count(CASE WHEN dlr_status =1 THEN to_mobile_no END) as delivered_count,
			count(CASE WHEN dlr_status=2 THEN to_mobile_no END) as expired_count,
			(count(CASE WHEN dlr_status=3 THEN to_mobile_no END) + count(CASE WHEN dlr_status =16 and error_code='0x00000481' THEN to_mobile_no END)) as dnd_count,
		count(CASE WHEN dlr_status=16 and error_code!='0x00000481' THEN to_mobile_no END) as invalid_count
			FROM campaigns_to WHERE campaign_id='$campaign_id'";
		
		$rs = mysql_query($query);		
		$val = mysql_fetch_array($rs);
		
		$total_count = $val['total_count'];
		$delivered_count = $val['delivered_count'];
		$expired_count = $val['expired_count'];
		$dnd_count = $val['dnd_count'];
		$pending_dlr_count=$val['pending_dlr_count'];
		$invalid_count = $val['invalid_count'];
		
		//update
		mysql_query("update campaigns SET 
			total_numbers_count = '$total_count',
			delivered_count = '$delivered_count',
			expired_count = '$expired_count',
			dnd_count = '$dnd_count',
			pending_dlrs_count= '$pending_dlr_count',
			invalid_count = '$invalid_count'
			WHERE campaign_id = '$campaign_id'
		");
		
	
	}

}

//taking backup of day before yesterday's data
$backup_table = "campaigns_to_".$day_month.$day_year;
$backup_query = "insert into campaigns_backup.$backup_table ( select * from sms.campaigns_to where date(sent_on) = '$day_before_yesterday' )";
$backup_result = mysql_query($backup_query);

//delete from sms_api_messages table of day before yesterdays
if($backup_result) {
	$delete_query = "delete from sms.campaigns_to where date(sent_on) = '$day_before_yesterday'";
	mysql_query($delete_query);
}

mysql_close($db);
?>
