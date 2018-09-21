<?php 
include("dbconnect/config.php");   
if($_REQUEST['mobile']&&$_REQUEST['text'])
{
   
$username=CALL_SMS_API_USERNAME;
$password=CALL_SMS_API_PASSWORD;
$from=CALL_SMS_API_FROM;
$to=$_REQUEST['mobile'];
$msg=$_REQUEST['text'];

echo call_sms_api($username,$password,$from,$to,$msg);

//echo "{Sucess:SMS Sent Successfully}";
}else
{
	echo "<span style='color:red'>{Failed:Required Parameter Missing} </span>";
}

      function call_sms_api($username,$password,$from,$to,$msg){  
		
       // $api = "http://www.smsstriker.com/API/sms.php?";
       $api = CALL_SMS_API;
        $api .= "username=".$username."&";
        $api .= "password=".$password."&";
        $api .= "from=".$from."&";
        $api .= "to=".$to."&";
         $api .= "msg=".urlencode($msg);
        return file_get_contents($api);
		
}
?>
