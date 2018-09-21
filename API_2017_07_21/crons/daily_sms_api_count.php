<?php
$db = mysql_pconnect("localhost","smsstrikerapp",'$tr!k3r@2009') or die(mysql_error());
mysql_select_db("sms",$db) or die(mysql_error());

echo $day_before_yesterday = date("Y-m-d", strtotime("-2 days"));



$day_month = substr($day_before_yesterday,5,2);
$day_year = substr($day_before_yesterday,0,4);

echo $total_count_query = "select user_id,sum(noofmessages) as sms_count from sms_api_messages where date(ondate)='$day_before_yesterday' group by user_id";
$total_count_rs = mysql_query($total_count_query);

if(mysql_num_rows($total_count_rs)>0) {

	while($total_count_val = mysql_fetch_array($total_count_rs)) {
	        
		$user_id = $total_count_val['user_id'];
	    $total_count = $total_count_val['sms_count'];
	
	
	    //delivered count
	     $delivered_count_query="select sum(noofmessages) as dl_count from sms_api_messages where date(ondate)='$day_before_yesterday' and user_id='$user_id' and dlr_status=1 ";
	    $delivered_sms_count_rs = mysql_query($delivered_count_query);
	    $delivered_sms_count_val = mysql_fetch_array($delivered_sms_count_rs);
	    $delivered_sms_count = $delivered_sms_count_val['dl_count'];
	
	    //expired count
	    $ex_sms_count_rs = mysql_query("select sum(noofmessages) as ex_count from sms_api_messages
	                                                where date(ondate)='$day_before_yesterday' and user_id='$user_id' and dlr_status=2 ");
	    $ex_sms_count_val = mysql_fetch_array($ex_sms_count_rs);
	    $ex_sms_count = $ex_sms_count_val['ex_count'];
	
	    //invalid count
	    $invalid_sms_count_rs = mysql_query("select sum(noofmessages) as in_count from sms_api_messages
	                                                where date(ondate)='$day_before_yesterday' and user_id='$user_id' and dlr_status=16 and error_code!='0x00000481'");
	    $invalid_sms_count_val = mysql_fetch_array($invalid_sms_count_rs);
	    $invalid_sms_count = $invalid_sms_count_val['in_count'];
	
	    //dnd count
	    $dnd_sms_count_rs = mysql_query("select sum(noofmessages) as dnd_count from sms_api_messages
	                                                where date(ondate)='$day_before_yesterday' and user_id='$user_id' and dlr_status=3 or error_code='0x00000481'");
	    $dnd_sms_count_val = mysql_fetch_array($dnd_sms_count_rs);
	    $dnd_sms_count = $dnd_sms_count_val['dnd_count'];
	
	    mysql_query("insert into sms_api_daily_count SET
	            on_date = '$day_before_yesterday',
	            user_id = '$user_id',
	            sms_count = '$total_count',
	            delivered_count = '$delivered_sms_count',
	            dnd_count = '$dnd_sms_count',
	            expired_count = '$ex_sms_count',
	            invalid_count = '$invalid_sms_count'
	    ");
	    
	
	}
}

//copy the rows of the date before yesterday's into campaigns_backup database

$backup_table = "sms_api_messages_".$day_month.$day_year;

echo $backup_query = "insert into campaigns_backup.$backup_table ( select * from sms.sms_api_messages where date(ondate) = '$day_before_yesterday')";
$backup_result = mysql_query($backup_query);

//delete from sms_api_messages table of day before yesterdays
if($backup_result) {
	echo $delete_query = "delete from sms.sms_api_messages where date(ondate) = '$day_before_yesterday'";
	mysql_query($delete_query);
}



mysql_close($db);
?>
