<?php
/* Parameters */

include("/var/www/html/strikerapp/API/dbconnect/config.php");
global $mysqli;
//$User_id=array('429');  // Talwar
$User_id=array('477');
$arrcnt=count($User_id);

for($i=0;$i<=$arrcnt;$i++)
{
	//echo $res_id[$i];
	
	$User=$mysqli->query("select username,available_credits,mobile from users where user_id='$User_id[$i]'");
//echo $res;   
if($User->num_rows > 0){
    $val=$User->fetch_array(MYSQLI_ASSOC);
    //$user_id=$val['user_id'];
    $balance1 = $val['available_credits'];
    //$balance2 = $val['available_tran_credits'];
    $mno=$val['mobile'];
    //echo "Promo:".$balance1;
    //echo "&nbsp";
    //echo "Trans:".$balance2;
    //echo "&nbsp","&nbsp","&nbsp","&nbsp";
    $username=$val['username'];
    //echo $mno;
    //echo "&nbsp","&nbsp","&nbsp";
    if($balance1<='15000')
    {
$user="support"; //your username
$password="Str!k3r2020"; //your password
//$mobilenumbers=; //enter Mobile numbers comma seperated
$message = "Dear $username, Your sms balance is low $balance1. Please contact Service Provider"; //enter Your Message
$senderid="SMSBAL"; //Your senderid  
$messagetype="1"; //Type Of Your Message
$url="https://www.smsstriker.com/API/sms.php";

$message = urlencode($message);
$ch = curl_init();
if (!$ch){die("Couldn't initialize a cURL handle");}
$ret = curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt ($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt ($ch, CURLOPT_POSTFIELDS,
"username=$user&password=$password&to=$mno,7659897711&msg=$message&from=$senderid&type=$messagetype");
$ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$curlresponse = curl_exec($ch); // execute
	}
	}
		//echo "<br>";
	}
//db connection
//require_once '/var/www/html/crons/db.php';


//print_r($res_id);
?>
