<?php

$server_ip = "localhost";
$db_user = "pointsmsapp";
$db_pass = 'po!nt$m$@2009';  
$db_name = "sms_reseller";  

mysql_connect($server_ip,$db_user,$db_pass);
mysql_select_db($db_name);


include("/var/www/html/strikerapp/smslib/config.inc");
include("/var/www/html/strikerapp/smslib/functions.inc");



        $campaign_no_rs = mysql_query("SELECT sms_text,to_mobile_no FROM campaigns_to WHERE campaign_id=1950338  AND dlr_status='0'");
      

$available_port=47713;
 $new_campaign_id=1950338;
$sender="NALNDA";
$mclass ="&mclass=''";           
                    while($to_details_val = mysql_fetch_array($campaign_no_rs))
                    {
                        $sms_txt = trim($to_details_val['sms_text']);

                        $to_mobile = $to_details_val['to_mobile_no'];

 echo $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=91$to_mobile&text=".urlencode($sms_txt);

$URL .= "$mclass&dlr-mask=31&dlr-url=".urlencode("http://pointsms.in/DLRS/api_reseller_dlr.php?campaign_id=$new_campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");

		http_send($URL,$available_port);

                        
                    }
                    

