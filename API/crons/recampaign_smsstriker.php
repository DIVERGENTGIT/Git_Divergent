<?php

$server_ip = "localhost";
$db_user = "strikerapp";
$db_pass = 'Off!c3@v2017';  
$db_name = "sms";  

mysql_connect($server_ip,$db_user,$db_pass);
mysql_select_db($db_name);


include("/var/www/html/strikerapp/smslib/config.inc");
include("/var/www/html/strikerapp/smslib/functions.inc");


$new_campaign_id=1707841;
$campaign_no_rs = mysql_query("SELECT sms_text,to_mobile_no FROM campaigns_to WHERE campaign_id='$new_campaign_id' AND  dlr_status=0");
      

$available_port=45113;

$sender="BA-VAIBAV";  
   
$mclass ="&mclass=''";     


$totalcnt=0;  
                    while($to_details_val = mysql_fetch_array($campaign_no_rs))
                    {

                        $sms_txt = trim($to_details_val['sms_text']);

                        $to_mobile = $to_details_val['to_mobile_no'];
                      
$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=91$to_mobile&text=".urlencode($sms_txt);

$URL .= "$mclass&dlr-mask=19&dlr-url=".urlencode("https://www.smsstriker.com/API/DLRS/dlr.php?campaign_id=$new_campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");

		http_send($URL,$available_port);

//mysql("update campaigns_to set dlr_status='NULL' where to_mobile_no=$to_mobile and campaign_id=$new_campaign_id");                        
$totalcnt=$totalcnt+1;
if($totalcnt==4926){
echo "total count" +$totalcnt;
break;

}




                    }
                    


