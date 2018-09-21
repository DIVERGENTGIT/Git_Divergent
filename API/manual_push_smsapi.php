<?php

include("dbconnect/config.php");  

 include("/var/www/html/strikerapp/smslib/config.inc");
    include("/var/www/html/strikerapp/smslib/functions.inc");
$sms_port=45113;

$query="select message_id,message,sender_name, to_mobileno  from sms_api_messages where user_id=5482 and dlr_status=16 and ondate like '2018-06-17 06%'";
$rs=$mysqli->query($query);
$val=$rs->fetch_array();
$i=0;
while($val=$rs->fetch_array()){
$i++;
$message_id=$val['message_id'];
$message=$val['message'];
//$sender=$val['sender_name'];
$sender='BA-JNBTEM';
$to=$val['to_mobileno'];
$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=91$to&text=".urlencode($message);
$URL .="&mclass=0";
 $URL .= "&dlr-mask=19&dlr-url=".urlencode(SERVER_NAME."/apidlr.php?campaign_id=$message_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");



http_send($URL,$sms_port);
if($i===17839)
{
echo "done";
break;
}

}



               
?>
