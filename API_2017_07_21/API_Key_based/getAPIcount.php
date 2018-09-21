<?php 
include("../dbconnect/config.php");


		$username=$_REQUEST['username'];
		$password=md5($_REQUEST['password']);
		$sender=$_REQUEST['sender'];
		$from_date=$_REQUEST['from_date'];
		$to_date=$_REQUEST['to_date'];
	
$date1=date_create($from_date);
$date2=date_create($to_date);
$diff=date_diff($date1,$date2);
 
 if($diff->format("%a")<8)
 {
 echo get_all_api_smsreports($username,$password,$sender,$from_date,$to_date);
 }
else   
{
echo "Out of Date Range please Select one week Date Range";
}



 function get_all_api_smsreports($username,$password,$sender,$from_date,$to_date) { 
        global $mysqli;
 		$st = $mysqli->query("SELECT user_id  FROM users WHERE username ='".$username."' and password='".$password."'");
		$rs = $st->fetch_object();   
		 $user_id = $rs->user_id;  
	 $rssender=$mysqli->query("select  sender_name,user_id from sender_names where user_id='".$user_id."' and sender_name='".$sender."'");
	 
	if($rssender->num_rows > 0){
	    $val=$rssender->fetch_array(MYSQLI_ASSOC);
	    $userid=$val['user_id'];
	    $sender_names=$val['sender_name'];
	    
	    
			$condition = "";
			$condition1 = "";
			if($from_date!='' && $to_date!='')
			{
				$condition = " AND date(on_date) >= '$from_date' AND date(on_date) <= '$to_date'";
				$condition1 = " AND date(ondate) >= '$from_date' AND date(ondate) <= '$to_date'";
			}
		
			if($sender_names!='')
			{
				$sendernames = " AND sender_name = '$sender_names'";

			}
		
			$delivered_count = 0;
			$expired_count = 0;
			$dnd_count = 0;
			$pending_dlr_count = 0;
			$invalid_count = 0;
		
			$delivered_count1 = 0;
			$expired_count1 = 0;
			$dnd_count1 = 0;
			$pending_dlr_count1 = 0;
			$invalid_count1 = 0;
			$total_sms = 0;
			
	
			if($from_date!='' && $to_date!='')
			{
		
			if($from_date==$to_date)
			{
				$curdate = date('Y-m-d');
					$fromdays_diff=daysDifference($curdate, $from_date);

					$todiff=daysDifference($curdate, $to_date);
					if($todiff <= 1){

					$table_name1 = "sms.sms_api_messages";
					}else
					{

						$year = substr($to_date,0,4);
						$month = substr($to_date,5,2);
						$table_name1 = "campaigns_backup.sms_api_messages_".$month.$year;
					}
			}else{
		
			

				$curdate = date('Y-m-d');
				$fromdays_diff=daysDifference($curdate, $from_date);

				$todiff=daysDifference($curdate, $to_date);
				if($todiff <= 1){

				$table_name1 = "sms.sms_api_messages";
				}else
				{

				$year = substr($to_date,0,4);
				$month = substr($to_date,5,2);
				$table_name1 = "campaigns_backup.sms_api_messages_".$month.$year;
				}

				if($fromdays_diff <= 1)
				{
				$table_name2 = "sms.sms_api_messages";

				}
				else
				{

				$year = substr($from_date,0,4);
				$month = substr($from_date,5,2);
				$table_name2 = "campaigns_backup.sms_api_messages_".$month.$year;

				}
		}
		      
	  			 $query = $mysqli->query("SELECT
				    (count(CASE WHEN dlr_status is NULL THEN to_mobileno END) + count(CASE WHEN dlr_status = 0 THEN to_mobileno END)) as pending_dlr_count,
				    count(CASE WHEN dlr_status =1 THEN to_mobileno END) as delivered_count,
				    count(CASE WHEN dlr_status=2 THEN to_mobileno END) as expired_count,

				    count(CASE WHEN dlr_status=3 THEN to_mobileno END) as dnd_count,
				    count(CASE WHEN dlr_status=16 THEN to_mobileno END) as invalid_count
				    FROM $table_name1 WHERE user_id =$userid $condition1 $sendernames");
			      
			       
				//$rs = mysql_query($query);       
				$val = $query->fetch_array(MYSQLI_ASSOC);
				$delivered_count = $delivered_count + $val['delivered_count'];
				$expired_count = $expired_count + $val['expired_count'];
				$dnd_count = $dnd_count + $val['dnd_count'];
				$pending_dlr_count = $pending_dlr_count + $val['pending_dlr_count'];
				$invalid_count = $invalid_count + $val['invalid_count'];
			
				 $query2 = $mysqli->query("SELECT
				    (count(CASE WHEN dlr_status is NULL THEN to_mobileno END) + count(CASE WHEN dlr_status = 0 THEN to_mobileno END)) as pending_dlr_count,
				    count(CASE WHEN dlr_status =1 THEN to_mobileno END) as delivered_count,
				    count(CASE WHEN dlr_status=2 THEN to_mobileno END) as expired_count,

				    count(CASE WHEN dlr_status=3 THEN to_mobileno END) as dnd_count,
				    count(CASE WHEN dlr_status=16 THEN to_mobileno END) as invalid_count
				    FROM $table_name2 WHERE user_id =$userid $condition1 $sendernames");
			      
			       
				//$rs2 = mysql_query($query2);       
				$val2 = $query2->fetch_array(MYSQLI_ASSOC);
				$delivered_count1 = $delivered_count1 + $val2['delivered_count'];
				$expired_count1 = $expired_count1 + $val2['expired_count'];
				$dnd_count1 = $dnd_count1 + $val2['dnd_count'];
				$pending_dlr_count1 = $pending_dlr_count1 + $val2['pending_dlr_count'];
				$invalid_count1 = $invalid_count1 + $val2['invalid_count'];
			
		
			
			}	
			else
			{
				//counts
				$query = $mysqli->query("SELECT
				    (count(CASE WHEN dlr_status is NULL THEN to_mobileno END) + count(CASE WHEN dlr_status = 0 
				    THEN to_mobileno END)) as pending_dlr_count,
				    count(CASE WHEN dlr_status =1 THEN to_mobileno END) as delivered_count,
				    count(CASE WHEN dlr_status=2 THEN to_mobileno END) as expired_count,

				    count(CASE WHEN dlr_status=3 THEN to_mobileno END) as dnd_count,
				    count(CASE WHEN dlr_status=16 THEN to_mobileno END) as invalid_count
				    FROM sms_api_messages WHERE user_id =$userid AND date(ondate) >= ( CURDATE() - INTERVAL 1 DAY )");
			       
				//$rs = mysql_query($query);       
				$val = $query->fetch_array(MYSQLI_ASSOC);
		
				$delivered_count = $delivered_count + $val['delivered_count'];
				$expired_count = $expired_count + $val['expired_count'];
				$dnd_count = $dnd_count + $val['dnd_count'];
				$pending_dlr_count = $pending_dlr_count + $val['pending_dlr_count'];
				$invalid_count = $invalid_count + $val['invalid_count'];
			}
		
	
			 $totalsms=$delivered_count+$dnd_count+$expired_count+$pending_dlr_count+$invalid_count+
			$delivered_count1+$dnd_count1+$expired_count1+$pending_dlr_count1+$invalid_count1;

			//$valu = explode(",",$total_rows);
			$apicount="Total Count : $totalsms";
			return $apicount;
	  
	$mysqli->close();
	} else {

	    echo "Invalid Creditials";
	}

	
}
	   
	
	
	function daysDifference($date1, $date2)
    {
        $month1 = substr($date1,5,2);
        $day1 = substr($date1,8,2);
        $year1 = substr($date1,0,4);

        $month2 = substr($date2,5,2);
        $day2 = substr($date2,8,2);
        $year2 = substr($date2,0,4);

        $date1 = mktime(0,0,0,$month1,$day1,$year1);
        $date2 = mktime(0,0,0,$month2,$day2,$year2);

        if($date1 > $date2){
            $dateDiff = $date1 - $date2;
        } else {
            $dateDiff = $date2 - $date1;
        }
        return $fullDays = floor($dateDiff/(60*60*24));
    }
	
	?>
	
