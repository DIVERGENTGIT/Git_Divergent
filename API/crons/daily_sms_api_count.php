<?php
$db = mysql_pconnect("localhost","strikerapp",'Off!c3@v2017') or die(mysql_error());
mysql_select_db("sms",$db) or die(mysql_error());

  $day_before_yesterday = date("Y-m-d", strtotime("-2 days"));


$dndCount = $totalSMSCredits = $failedCredits = $deliveredCredits = 0; 
$day_month = substr($day_before_yesterday,5,2);
$day_year = substr($day_before_yesterday,0,4);

  $total_count_query = "select user_id,sum(noofmessages) as sms_count from sms_api_messages where date(ondate)='$day_before_yesterday' group by user_id";
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
	                                                where date(ondate)='$day_before_yesterday' and user_id='$user_id' and (dlr_status=16 and error_code!='0x00000481')");
	    $invalid_sms_count_val = mysql_fetch_array($invalid_sms_count_rs);
	    $invalid_sms_count = $invalid_sms_count_val['in_count'];
	
	    //dnd count
	    $dnd_sms_count_rs = mysql_query("select sum(noofmessages) as dnd_count from sms_api_messages where date(ondate)='$day_before_yesterday' and user_id='$user_id' and (dlr_status=3 or error_code='0x00000481')");
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
	 	
		/*$totalSMSCredits +=$total_count;
		$failedCredits +=$invalid_sms_count+$ex_sms_count;
		$deliveredCredits +=$delivered_count;	
		$dndCount  +=$dnd_count;*/
	
	}
}  

//copy the rows of the date before yesterday's into campaigns_backup database
 
$backup_table = "sms_api_messages_".$day_month.$day_year;

  $backup_query = "insert into campaigns_backup.$backup_table ( select * from sms.sms_api_messages where date(ondate) = '$day_before_yesterday')";
$backup_result = mysql_query($backup_query);

//delete from sms_api_messages table of day before yesterdays
if($backup_result) {
	  $delete_query = "delete from sms.sms_api_messages where date(ondate) = '$day_before_yesterday'";
	mysql_query($delete_query);
} 
   
/*
$db = mysql_connect("localhost","devel",'D3v3l09@511') or die(mysql_error());
mysql_select_db("sms",$db) or die(mysql_error());
    
 
 
if($totalSMSCredits > 0) {
	$addCreditsQ = "INSERT INTO totalSMSCredits (total_numbers_count,failed_count,dnd_count,delivered_count,type,service,dateTime) VALUES('".$totalSMSCredits."','".$failedCredits."','".$dndCount."','".$deliveredCredits."','api','smsstriker','".date('Y-m-d H:i:s')."')";  
	mysql_query($addCreditsQ); 
}   
*/


mysql_close($db);
?>
