<?php 

$server_ip = "localhost";  
$db_user = "strikerapp";
$db_pass = 'Off!c3@v2017';  
$db_name = "sms";  


$mysqli = new mysqli($server_ip, $db_user, $db_pass, $db_name);

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$day_before_yesterday = date("Y-m-d", strtotime("-2 days"));
$totalSMSCredits = $failedCredits = $deliveredCredits = $dndCount = 0; 
$day_month = substr($day_before_yesterday,5,2);
$day_year = substr($day_before_yesterday,0,4);  
$cmonth=date('m');
$cyear=date('Y');
//unscheduled campaigns
$campaigns_query = "select campaign_id from ftp_campaign where is_scheduled = 0 and date(created_date_time)= '$day_before_yesterday'";
$campaigns_rs = $mysqli->query($campaigns_query);

if($campaigns_rs->num_rows > 0) {

	while($campaigns_val = $campaigns_rs->fetch_array()) {
		$campaign_id = $campaigns_val['campaign_id'];
		
		//counts
		$query = "SELECT count(to_mobile_no) as total_count,
			(count(CASE WHEN dlr_status is NULL THEN to_mobile_no END) + count(CASE WHEN dlr_status=0 THEN to_mobile_no END)) as pending_dlr_count,
			count(CASE WHEN dlr_status =1 THEN to_mobile_no END) as delivered_count,
			count(CASE WHEN dlr_status=2 THEN to_mobile_no END) as expired_count,
			count(CASE WHEN dlr_status=3 THEN to_mobile_no END) as dnd_count,
			count(CASE WHEN dlr_status=16 THEN to_mobile_no END) as invalid_count 
			FROM ftp_campaigns_to WHERE campaign_id='$campaign_id'";
		
		$rs = $mysqli->query($query);		
		$val = $rs->fetch_array();
		
		$total_count = $val['total_count'];
		$delivered_count = $val['delivered_count'];
		$expired_count = $val['expired_count'];
		$dnd_count = $val['dnd_count'];
		$pending_dlr_count=$val['pending_dlr_count'];
		$invalid_count = $val['invalid_count'];
		
		
		//update
		$mysqli->query("update ftp_campaign SET 
			total_numbers_count = '$total_count',
			delivered_count = '$delivered_count',
			expired_count = '$expired_count',
			dnd_count = '$dnd_count',
			pending_dlrs_count= '$pending_dlr_count',
			invalid_count = '$invalid_count'
			WHERE campaign_id = '$campaign_id'
		");
		
		$totalSMSCredits +=$total_count;
		$failedCredits +=$expired_count+$invalid_count;
		$deliveredCredits +=$delivered_count;
		$dndCount +=$dnd_count;	
	}

}

/*
//scheduled campaigns
$campaigns_query = "select campaign_id from ftp_campaign where is_scheduled = 1 and date(scheduled_on)= '$day_before_yesterday'";
$campaigns_rs = mysql_query($campaigns_query);

if(mysql_num_rows($campaigns_rs) > 0) {

	while($campaigns_val = mysql_fetch_array($campaigns_rs)) {
		$campaign_id = $campaigns_val['campaign_id'];
		
		//counts
		$query = "SELECT count(to_mobile_no) as total_count,
			(count(CASE WHEN dlr_status is NULL THEN to_mobile_no END) + count(CASE WHEN dlr_status=0 THEN to_mobile_no END)) as pending_dlr_count,
			count(CASE WHEN dlr_status =1 THEN to_mobile_no END) as delivered_count,
			count(CASE WHEN dlr_status=2 THEN to_mobile_no END) as expired_count,
			(count(CASE WHEN dlr_status=3 THEN to_mobile_no END) + count(CASE WHEN dlr_status =16 and error_text='DND number' THEN to_mobile_no END)) as dnd_count,
		count(CASE WHEN dlr_status=16 and error_text!='DND number' THEN to_mobile_no END) as invalid_count
			FROM ftp_campaigns_to WHERE campaign_id='$campaign_id'";
		
		$rs = mysql_query($query);		
		$val = mysql_fetch_array($rs);
		
		$total_count = $val['total_count'];
		$delivered_count = $val['delivered_count'];
		$expired_count = $val['expired_count'];
		$dnd_count = $val['dnd_count'];
		$pending_dlr_count=$val['pending_dlr_count'];
		$invalid_count = $val['invalid_count'];
		
		//update
		mysql_query("update ftp_campaign SET 
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

  
*/
//taking backup of day before yesterday's data
$backup_table = "campaigns_backup.ftp_campaigns_to_".$day_month.$day_year;
$createtable = "campaigns_backup.ftp_campaigns_to_".$cmonth.$cyear;

 $create_table_stmt = "CREATE TABLE IF NOT EXISTS $createtable (
  `campaign_id` int(11) NOT NULL,
  `unique_msg_id` varchar(50) default NULL,
  `acccount_num` varchar(255) NOT NULL,
  `to_mobile_no` bigint(20) default NULL,
  `sms_text` text character set utf8 collate utf8_bin,
  `sent_on` varchar(50) default NULL,
  `dlr_status` int(11) default NULL,
  `error_code` varchar(15) default NULL,
  `error_text` varchar(100) default NULL,
  `delivered_on` varchar(50) default NULL,
  `port_no` varchar(6) NOT NULL,
  `sms_count` int(11) NOT NULL,
  KEY `campaign_id` (`campaign_id`),
  KEY `mobile_index` (`to_mobile_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1; ";    
    
    
    
    
$query_exe = $mysqli->query($create_table_stmt);
if($query_exe) {
	$mysqli->query("ALTER TABLE $createtable ADD KEY `campaign_id` (`campaign_id`), ADD KEY `mobile_index` (`to_mobile_no`)");
}    


$backup_query = "insert into $backup_table ( select * from sms.ftp_campaigns_to where date(sent_on) = '$day_before_yesterday'  )";
 
$backup_result = $mysqli->query($backup_query);  
 $insertid= $mysqli->affected_rows;

//delete from sms_api_messages table of day before yesterdays
if($insertid) {

//echo "test";
	$delete_query = "delete from sms.ftp_campaigns_to where date(sent_on) = '$day_before_yesterday'";
	$mysqli->query($delete_query);  
}

/*

$db = mysql_connect("localhost","devel",'D3v3l09@511') or die(mysql_error());
mysql_select_db("sms",$db) or die(mysql_error());
    
   
 
if($totalSMSCredits > 0) {
	$addCreditsQ = "INSERT INTO totalSMSCredits (total_numbers_count,failed_count,dnd_count,delivered_count,type,service,dateTime) VALUES('".$totalSMSCredits."','".$failedCredits."','".$dndCount."','".$deliveredCredits."','ftp','smsstriker','".date('Y-m-d H:i:s')."')";  
	mysql_query($addCreditsQ); 
}   
*/

$mysqli->close();
?>
