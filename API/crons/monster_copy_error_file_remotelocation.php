<?php
if(!$db_link)
{
    $db_link=mysql_connect("localhost","strikerapp","Off!c3@v2017") or die(mysql_error());
}
else
{
    $db_link=mysql_pconnect("localhost","strikerapp","Off!c3@v2017") or die(mysql_error());
}
mysql_select_db("sms",$db_link) or die(mysql_error());

// this code for monster india 

 $campaign_rs = mysql_query("SELECT job_id,`sender_name` as 'sender ID',message,to_mobileno,dlr_status, CASE
WHEN `dlr_status`= '0' 
THEN 'Pending'
WHEN `dlr_status`= '12' 
THEN 'Not a valid Sender Name'
WHEN `dlr_status`= '11'
THEN 'No Credits'
WHEN `dlr_status`= '2' 
THEN 'REJECTED'
WHEN `dlr_status`= '13' 
THEN 'Not a valid Template'
WHEN `dlr_status`= '5' 
THEN 'Vendor Specific Error: Please contact your provider'
ELSE error_text
END as errortext ,ondate
FROM sms_api_messages where user_id=3843 and dlr_status not in (1,3) and date(ondate)=  DATE( DATE_SUB( NOW() , INTERVAL 1 DAY ) ) order by ondate desc");



if(mysql_num_rows($campaign_rs)>0) 
{



    while($campaign_val= mysql_fetch_array($campaign_rs)) 
    {
      echo  $data = $campaign_val['job_id']." | ".$campaign_val['sender ID']." | ".$campaign_val['message']." | ".$campaign_val['to_mobileno']." | ".$campaign_val['errortext']." | ".$campaign_val['ondate'];
        
date_default_timezone_set("Asia/Kolkata");
//$date= "Created date is " . date('Y-m-d h:i:sa');
$date= date('Y-m-d');
//error_log($data."\r\n",3,"/var/www/vhosts/www.smsstriker.com/htdocs/api_log/failed_campaigns.log".$date);
error_log($data."\r\n",3,"/home/monstr/indiadata/failed_campaigns_monsterindia$date.log");

    }

   
}

// another user

 $campaign_query = mysql_query("SELECT job_id,`sender_name` as 'sender ID',message,to_mobileno,dlr_status, CASE
WHEN `dlr_status`= '0' 
THEN 'Pending'
WHEN `dlr_status`= '12' 
THEN 'Not a valid Sender Name'
WHEN `dlr_status`= '11'
THEN 'No Credits'
WHEN `dlr_status`= '2' 
THEN 'REJECTED'
WHEN `dlr_status`= '13' 
THEN 'Not a valid Template'
WHEN `dlr_status`= '5' 
THEN 'Vendor Specific Error: Please contact your provider'
ELSE error_text
END as errortext ,ondate
FROM sms_api_messages where user_id=4094 and dlr_status not in (1,3) and date(ondate)=  DATE( DATE_SUB( NOW() , INTERVAL 1 DAY ) ) order by ondate desc");



if(mysql_num_rows($campaign_query)>0) 
{



    while($cdata= mysql_fetch_array($campaign_query)) 
    {
      echo  $res_data = $cdata['job_id']." | ".$cdata['sender ID']." | ".$cdata['message']." | ".$cdata['to_mobileno']." | ".$cdata['errortext']." | ".$cdata['ondate'];
        
date_default_timezone_set("Asia/Kolkata");
//$date= "Created date is " . date('Y-m-d h:i:sa');
$date= date('Y-m-d');
//error_log($data."\r\n",3,"/var/www/vhosts/www.smsstriker.com/htdocs/api_log/failed_campaigns.log".$date);
error_log($res_data."\r\n",3,"/home/monstr/data/failed_campaigns_monsterint$date.log");

    }

   
}


