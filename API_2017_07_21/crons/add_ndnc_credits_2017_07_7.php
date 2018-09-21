<?php 
$link = mysql_pconnect("localhost","smsstrikerapp",'$tr!k3r@2009') or die(mysql_error());
mysql_select_db("sms",$link) or die(mysql_error());

$users_rs = mysql_query("select user_id from users where return_ndnc_credits = 1");
if(mysql_num_rows($users_rs) > 0) {
	while($users_val = mysql_fetch_array($users_rs)) 
	{
		$final_returns_credits=0;
		$user_id = $users_val['user_id'];
		//getting yesterday campaign details
		$campaigns_list=mysql_query("select campaign_id from campaigns where user_id = '$user_id' and date(created_on) = DATE_SUB(curdate(), INTERVAL 1 DAY)");
			
		if(mysql_num_rows($campaigns_list) > 0) 
		{
			
		}
		
		//$query = "select count(*) from campaigns_to where dlr_status = 3 and campaign_id in (select campaign_id from campaigns where user_id = '$user_id' and date(created_on) = DATE_SUB(curdate(), INTERVAL 1 DAY) )";
		 $query1 = "select count(sms_text) as cnt,length(sms_text) as msglen from campaigns_to where (dlr_status = 3 or error_code='0x00000481') and campaign_id in (select campaign_id from campaigns where user_id = '$user_id' and  is_scheduled='0' and date(created_on) = DATE_SUB(curdate(), INTERVAL 1 DAY) ) group by length(campaigns_to.sms_text) ";
	  $resultSet1=mysql_query($query1);
	  while($resultSet1_val = mysql_fetch_array($resultSet1)) 
	  {
		  $return_credits=0;
		  $numbers_count = $resultSet1_val['cnt'];
          $smslength = $resultSet1_val['msglen'];
		  
		  $temp_len=$smslength/160;
		  if($temp_len<=1)
			  $msgcount=1;
		  else if($temp_len<=2)	  
			  $msgcount=2;		  
		  else if($temp_len<=3)	  
			  $msgcount=3;	
		  else if($temp_len<=4)	  
			  $msgcount=4;	
     	  else if($temp_len<=5)	  
			  $msgcount=5;
		  else if($temp_len<=6)
			  $msgcount=6;
		  else if($temp_len<=7)	  
			  $msgcount=7;		  
		  else if($temp_len<=8)	  
			  $msgcount=8;	
		  else if($temp_len<=9)	  
			  $msgcount=9;	
     	  else if($temp_len<=10)	  
			  $msgcount=10;		
		
		  echo "\n $user_id - $smslength/160 = ".($smslength/160)."  Messages Count: $msgcount   Total Numbers : $numbers_count";
			  	  				  		  
		  $return_credits=$msgcount*$numbers_count;
 		  $final_returns_credits=$return_credits+$final_returns_credits;
		  
	  }
		//$val = mysql_fetch_array(mysql_query($query));
		//$return_credits = $val[0];
			
		if($final_returns_credits > 0)
		{
			 $sql1="insert into user_payments(user_id,no_of_sms,price,total_amount,on_date,note) 						values('$user_id','$final_returns_credits','0','0',now(),'returned DND Credits')";
			mysql_query($sql1);
			mysql_query("update users set available_credits = available_credits + $final_returns_credits where user_id='$user_id'");
		
			echo "\n $user_id :: $final_returns_credits \n";	
		}
		
		// scheduled campaign returns
		$return_credits=0;
		$numbers_count=0;
		$smslength=0;
		$temp_len=0;
		$final_returns_credits=0;
		
		 $schedule_query = "select count(sms_text) as cnt,length(sms_text) as msglen from campaigns_to where (dlr_status = 3 or error_code='0x00000481') and  campaign_id in
					(select campaign_id from campaigns where user_id = '$user_id' and  is_scheduled='1' and campaign_status=2 and date(scheduled_on) = DATE_SUB(curdate(), INTERVAL 1 DAY) ) group by length(campaigns_to.sms_text) ";
		
	 $resultSet2=mysql_query($schedule_query);
	  while($resultSet2_val = mysql_fetch_array($resultSet2)) 
	  {
		  $return_credits=0;
		  $numbers_count = $resultSet2_val['cnt'];
          $smslength = $resultSet2_val['msglen'];
		  
		  $temp_len=$smslength/160;
		  if($temp_len<=1)
			  $msgcount=1;
		  else if($temp_len<=2)	  
			  $msgcount=2;		  
		  else if($temp_len<=3)	  
			  $msgcount=3;	
		  else if($temp_len<=4)	  
			  $msgcount=4;	
     	  else if($temp_len<=5)	  
			  $msgcount=5;
		  else if($temp_len<=6)
			  $msgcount=6;
		  else if($temp_len<=7)	  
			  $msgcount=7;		  
		  else if($temp_len<=8)	  
			  $msgcount=8;	
		  else if($temp_len<=9)	  
			  $msgcount=9;	
     	  else if($temp_len<=10)	  
			  $msgcount=10;		
		
		  echo "\n $user_id - $smslength/160 = ".($smslength/160)."  Messages Count: $msgcount   Total Numbers : $numbers_count";
			  	  				  		  
		  $return_credits=$msgcount*$numbers_count;
 		  $final_returns_credits=$return_credits+$final_returns_credits;
		  
	  }
		//$val = mysql_fetch_array(mysql_query($query));
		//$return_credits = $val[0];
			
		if($final_returns_credits > 0)
		{
			 $sql2="insert into user_payments(user_id,no_of_sms,price,total_amount,on_date,note) 						values('$user_id','$final_returns_credits','0','0',now(),'returned DND Credits-scheduled')";
			mysql_query($sql2);
			mysql_query("update users set available_credits = available_credits + $final_returns_credits where user_id='$user_id'");
		
			echo "\n $user_id :: $final_returns_credits \n";	
		}
		
					
	}// end while
	
} // end first if
mysql_close($link);
