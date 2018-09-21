<?php 

include("dbconnect/config.php");  

$username=$_REQUEST['username'];
$password=$_REQUEST['password'];
$from=$_REQUEST['from'];
 
$to_mobiles=$_REQUEST['to'];
$type=$_REQUEST['type'];
$dlr_url=trim($_REQUEST['dlr_url']);
$custom_parameter=$_REQUEST['custom_parameter'];
$message=$_REQUEST['msg'];
$message=str_replace("\'","'",$message);
$message=str_replace('\"','"',$message);
$message_length=strlen($message);
if($message_length == 0){
    $message_length = 1;
}
// calculate SMS length
if($message_length>160)
	$no_of_messages_tmp=ceil($message_length/153);
else
	$no_of_messages_tmp=ceil($message_length/160);

$no_of_messages=$no_of_messages_tmp;  // changed on 26-12-2013 as per santosh request	
//$no_of_messages=ceil($message_length/160);

$mm=explode(",",$to_mobiles);
/*
if(!$db_link)
{
    $db_link=mysql_connect("localhost","root","myadmin") or die(mysql_error());
}
else
{
    $db_link=mysql_pconnect("localhost","root","myadmin") or die(mysql_error());
}
mysql_select_db("sms",$db_link) or die(mysql_error()); */

$rs=$mysqli->query("select user_id,available_credits,no_ndnc from users where username='".$username."' and password='".md5($password)."'");
if($rs->num_rows > 0)
{
    $val=$rs->fetch_array();
    $user_id=$val[0];
    $available_credits = $val[1];
 
    //sender names
    if($val['no_ndnc'] == 1){ //loop Transactional SMPP
        //$sender = "LM-" . $from;
		 $sender = $from;
        $sms_port = 15013;
    } elseif($val['no_ndnc'] == 0){ //loop Promo SMPP
       /*
	    $from = "0" . rand(16066,16075);
        $sender = "LM-" . $from;
		*/
		$sender =$from;
        $sms_port = 27013;
    } elseif($val['no_ndnc'] == 2){ //solutions infini transactional
        $sms_port = 19013;
        $sender = $from;
    }

    $sender = "LM-Striker";
    $sms_port = 35013;

    include("/var/www/html/strikerapp/smslib/config.inc");
    include("/var/www/html/strikerapp/smslib/functions.inc");

    for($i=0;$i<count($mm);$i++) {
        $to=trim($mm[$i]);
        if($no_of_messages<=$available_credits) {
            $message1=$mysqli->real_escape_string($message);
            if(!$val['no_ndnc']){ 
                //check for dnd number
                $checkDndRes = $mysqli->query("SELECT count(*) FROM dnd_db.ndnc_data WHERE dnc_number = '{$to}'");
                $checkDndRow = $checkDndRes->fetch_array();
                $isDND = $checkDndRow[0];

                if($isDND){
                    $mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status)
                        values('$user_id','$from','$message1','$no_of_messages','$to',now(),'3')");
                } else {
                    $mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate)
                        values('$user_id','$from','$message1','$no_of_messages','$to',now())");
                    $smsId = $mysqli->insert_id;

                    $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=91$to&text=".urlencode($message);
                    if($type=="0"){
                        $URL .="&mclass=0";  
                    }
                    $URL .= "&dlr-mask=31&dlr-url=".urlencode(SERVER_NAME."apidlr.php?campaign_id=$smsId&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");
 
                    http_send($URL,$sms_port);
                }
            } else {
                $mysql_query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate) values('$user_id','$from','$message1','$no_of_messages','$to',now())");
                $smsId = $mysqli->insert_id;

                $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=91$to&text=".urlencode($message);   
                if($type=="0"){   
                    $URL .="&mclass=0";
                }
                $URL .= "&dlr-mask=31&dlr-url=".urlencode(SERVER_NAME."apidlr.php?campaign_id=$smsId&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");

                http_send($URL,$sms_port);
            }
            $mysqli->query("update users set available_credits=available_credits-$no_of_messages where user_id='$user_id'");
            echo "Message has been sent";
        } else { // nofunds
            echo "Don't have Sufficient SMS Credits to send SMS. Add SMS Credits by contacting administrator.";
            exit;
        }   

    } //for
} else { //user Authentication
    echo "Invalid User Details";
}
$mysqli->close();
?>
