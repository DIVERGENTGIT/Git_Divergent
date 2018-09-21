<?php
$db =mysql_pconnect("localhost","strikerapp",'Off!c3@v2017');
mysql_select_db("sms",$db) or die(mysql_error());


echo $total_count_query = "select user_id,sum(noofmessages) as sms_count,date(ondate) as ondate from campaigns_backup.sms_api_messages_052017 where  user_id in (SELECT user_id FROM sms.users  WHERE `reseller_id` = 142)  group by user_id ,3";
$total_count_rs = mysql_query($total_count_query);

if(mysql_num_rows($total_count_rs)>0) {

	while($total_count_val = mysql_fetch_array($total_count_rs)) {
	        
		$user_id = $total_count_val['user_id'];
	     $total_count = $total_count_val['sms_count'];
	$ondate = $total_count_val['ondate'];
	
	    //delivered count
	     $delivered_count_query="select sum(noofmessages) as dl_count from campaigns_backup.sms_api_messages_052017 where date(ondate) = '$ondate' and user_id='$user_id' and dlr_status=1 ";
	    $delivered_sms_count_rs = mysql_query($delivered_count_query);
	    $delivered_sms_count_val = mysql_fetch_array($delivered_sms_count_rs);
	    $delivered_sms_count = $delivered_sms_count_val['dl_count'];
	
	    //expired count
	    $ex_sms_count_rs = mysql_query("select sum(noofmessages) as ex_count from campaigns_backup.sms_api_messages_052017
	                                                where  date(ondate) = '$ondate' and user_id='$user_id' and dlr_status=2 ");
	    $ex_sms_count_val = mysql_fetch_array($ex_sms_count_rs);
	    $ex_sms_count = $ex_sms_count_val['ex_count'];
	
	    //invalid count
	    $invalid_sms_count_rs = mysql_query("select sum(noofmessages) as in_count from campaigns_backup.sms_api_messages_052017 where date(ondate) = '$ondate' and user_id='$user_id'  and dlr_status=16 and error_code!='0x00000481' ");
	    $invalid_sms_count_val = mysql_fetch_array($invalid_sms_count_rs);
	    $invalid_sms_count = $invalid_sms_count_val['in_count'];
	
	    //dnd count
	    $dnd_sms_count_rs = mysql_query("select sum(noofmessages) as dnd_count from campaigns_backup.sms_api_messages_052017 where date(ondate) = '$ondate' and user_id='$user_id' and dlr_status=3 or error_code='0x00000481'");
	    $dnd_sms_count_val = mysql_fetch_array($dnd_sms_count_rs);
	    $dnd_sms_count = $dnd_sms_count_val['dnd_count'];
	
	    mysql_query("update sms_api_daily_count SET
	              sms_count = '$total_count',
	            delivered_count = '$delivered_sms_count',
	            dnd_count = '$dnd_sms_count',
	            expired_count = '$ex_sms_count',
	            invalid_count = '$invalid_sms_count' where  date(on_date) = '$ondate' and user_id = '$user_id'
	    ");
	    
	
	}
}







mysql_close($db);
?>
