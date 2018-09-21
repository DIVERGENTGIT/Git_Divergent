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


$day_before_yesterday = date("Y-m-d", strtotime("-1 days"));

$day_month = substr($day_before_yesterday,5,2);
$day_year = substr($day_before_yesterday,0,4);  
$cmonth=date('m');
$cyear=date('Y');


$backup_table = "campaigns_backup.ftp_campaigns_to_dlr_".$day_month.$day_year;
$createtable = "campaigns_backup.ftp_campaigns_to_dlr_".$cmonth.$cyear;

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


 $backup_query = "insert into $backup_table ( select * from sms.ftp_campaigns_to_dlr where date(delivered_on) = '$day_before_yesterday')";
 
$backup_result = $mysqli->query($backup_query);  
 $insertid= $mysqli->affected_rows;

if($insertid) {

//echo "test";
	$delete_query = "delete from sms.ftp_campaigns_to_dlr where date(delivered_on) = '$day_before_yesterday'";
	$mysqli->query($delete_query);  
}

$mysqli->close();
?>
