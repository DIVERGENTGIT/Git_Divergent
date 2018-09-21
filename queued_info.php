<?php

$link= mysqli_connect("localhost","strikerapp",'Off!c3@v2017',"sms"); 
$rs=mysqli_query($link,"select distinct port_no from sms_queue "); 
$array = array(); 
$activePortNum = ''; 
while($val=mysqli_fetch_array($rs))
{  
	$port = $val[0];  
	//$array[] = $port;
	$url = "http://182.18.139.110:$port/cgi-bin/status?password=ara111";
	$file = file_get_contents($url);
	$splt = explode("Status:",$file);
	$runstr = $splt[1];
	$runarr = explode("WDP",$runstr);
	$status = $runarr[0]; //Online Time 

	$splt2 = explode("SMS:",$file);
	$Qstr = $splt[1];

	$qarr = explode("SMS:",$Qstr);
	$a = $qarr[1];
	$arr = explode("(",trim($a));
	$b = explode("queued",$arr[2]);
	$quesms = $b[0]; //Queued 
	$c = explode("store size",$b[1]);
	$storesize = $c[1];  //Store Size  
	$d = explode("Box connections:",$runstr);  //Box connections
  
	$boxarr = explode("SMSC connections:",$d[1]); 
	$smpponline = explode(":smpp (",$boxarr[1]);
 
	$cnt = count($smpponline);
 
	$offlinePorts = substr_count($boxarr[1], 'offline');
	if($offlinePorts == 0) {  
		$activePortNum .= $port.' ,';	 
	} 
}


$activePortNum = rtrim($activePortNum,',');
print_r($activePortNum);
 
exit;
/*$totalPorts = count($array); 
$distributedKennelLength  = ceil($campaignSize/$totalPorts); 
 
for($i=0;$i<count($array);$i++) {


	if($array[$i]['size'] <= $distributedKennelLength) {
		$kennelPortNo = $array[$i]['port'];
 
 	}else{  
		unset($array[$i]['port']);unset($array[$i]['size']);
	}
 
}  
 
 */
//echo json_encode($array);

/* ################################################## Pointsms######################################### 

$link2=mysqli_connect("localhost","root",'striker@123',"sms_reseller") or die(mysqli_error());
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


 
 //mysqli_query($link2,"update sms_queue set queued='$storesize',failed='$failed',sent='$quesms',received='$quesms',online='$status' where port_no='$port'") or die(mysqli_error());

}*/



?>
