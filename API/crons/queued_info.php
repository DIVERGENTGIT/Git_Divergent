<?php

$link=mysqli_connect("localhost","strikerapp",'Off!c3@v2017',"sms") or die(mysqli_error($link));

$rs=mysqli_query($link,"select distinct port_no from sms_queue ");

while($val=mysqli_fetch_array($rs))
{

  $port=$val[0];
echo  "=========================$port=======================<br>";
//$port=$_REQUEST['port'];
  $url="http://182.18.139.110:$port/cgi-bin/status?password=ara111";

 $file = file_get_contents($url);

$splt=explode("Status:",$file);
$runstr=$splt[1];

$runarr=explode("WDP",$runstr);
echo "Online Time : ",$status=$runarr[0];
echo "<br>";


$splt2=explode("SMS:",$file);
$Qstr=$splt[1];

$qarr=explode("SMS:",$Qstr);
$a=$qarr[1];
$arr=explode("(",trim($a));
$b=explode("queued",$arr[2]);
echo "Queued : ", $quesms= $b[0];
echo "<br>";
$c=explode("store size",$b[1]);
echo "Store Size : ", $storesize=$c[1];
echo "<br>";

$d=explode("Box connections:",$runstr);
echo "Box connections :";

$boxarr=explode("SMSC connections:",$d[1]);

echo "<br>";
echo $boxarr[0];
echo "<br>";


$smpponline=explode(":smpp (",$boxarr[1]);
$smpponline[1];
$cnt=count($smpponline);

echo "Total Accounts : ".($cnt-1);

echo "<br>";
echo "Noof Online : ".substr_count($boxarr[1], 'online');
echo "<br>";
echo "Noof offline : ".substr_count($boxarr[1], 'offline');
echo "<br>";


if(substr_count($boxarr[1], 'offline') > 0) { 
	sms_alert($port); 
}
 
/*
for($i=1;$i<$cnt;$i++){
echo $cnt-$i;
echo $smpponline[$cnt-$i];
echo "<br>";
}
*/

 mysqli_query($link,"update sms_queue set queued='$storesize',failed='$failed',sent='$quesms',received='$quesms',online='$status' where port_no='$port'") or die(mysqli_error());

}


/* ################################################## Pointsms######################################### */

$link2=mysqli_connect("localhost","pointsmsapp",'po!nt$m$@2009',"sms_reseller") or die(mysqli_error());
$rs2=mysqli_query($link2,"select distinct port_no from sms_queue ");
while($val=mysqli_fetch_array($rs2))
{


  $port2=$val[0];
echo  " =========================$port2 pointsms =======================<br>";
//$port=$_REQUEST['port'];
  $url="http://182.18.139.110:$port2/cgi-bin/status?password=ara111";

 $file = file_get_contents($url);

$splt=explode("Status:",$file);
$runstr=$splt[1];

$runarr=explode("WDP",$runstr);
echo "Online Time : ",$status=$runarr[0];
echo "<br>";


$splt2=explode("SMS:",$file);
$Qstr=$splt[1];

$qarr=explode("SMS:",$Qstr);
$a=$qarr[1];
$arr=explode("(",trim($a));
$b=explode("queued",$arr[2]);
echo "Queued : ", $quesms= $b[0];
echo "<br>";
$c=explode("store size",$b[1]);
echo "Store Size : ", $storesize=$c[1];
echo "<br>";

$d=explode("Box connections:",$runstr);
echo "Box connections :";

$boxarr=explode("SMSC connections:",$d[1]);

echo "<br>";
echo $boxarr[0];
echo "<br>";


$smpponline=explode(":smpp (",$boxarr[1]);
$smpponline[1];
$cnt=count($smpponline);

echo "Total Accounts : ".($cnt-1);

echo "<br>";
echo "Noof Online : ".substr_count($boxarr[1], 'online');
echo "<br>";
echo "Noof offline : ".substr_count($boxarr[1], 'offline');
echo "<br>";

if(substr_count($boxarr[1], 'offline') > 0) { 
	sms_alert($port); 
}

/*
for($i=1;$i<$cnt;$i++){
echo $cnt-$i;
echo $smpponline[$cnt-$i];
echo "<br>";
}
*/

 mysqli_query($link2,"update sms_queue set queued='$storesize',failed='$failed',sent='$quesms',received='$quesms',online='$status' where port_no='$port'") or die(mysqli_error());

}


function sms_alert($port){
include("/var/www/html/strikerapp/API/dbconnect/config.php");  
	$user=SMS_ALERT_USER; //your username
	 $password=SMS_ALERT_PWD; //your password
	$message = "Kennel Offline Port : $port"; //enter Your Message

	 $senderid=SMS_ALERT_SENDERID; //Your senderid
	$messagetype="1"; //Type Of Your Message  
	 $url=CALL_SMS_API;    
  
 	$message = urlencode($message);
	$ch = curl_init();  
	if (!$ch){ die("Couldn't initialize a cURL handle"); }   
	$ret = curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt ($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
	//curl_setopt ($ch, CURLOPT_POSTFIELDS,
	//"username=$user&password=$password&to=$mno&msg=$message&from=$senderid&type=$messagetype");
 
	curl_setopt ($ch, CURLOPT_POSTFIELDS, "username=$user&password=$password&to=".SMS_ALERT_TO."&msg=$message&from=$senderid&type=$messagetype");
 
	//curl_setopt ($ch, CURLOPT_POSTFIELDS, "username=$user&password=$password&to=9701019800&msg=$message&from=$senderid&type=$messagetype");

	$ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  
	  $curlresponse = curl_exec($ch); // execute
}



?>
