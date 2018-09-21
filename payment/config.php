<?php
$hosturl= $_SERVER['HTTP_HOST'];
$web_url = "http://$hosturl";
$link = mysqli_connect("localhost","strikerapp",'Off!c3@v2017',"sms");
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result=mysqli_query($conn,"select value from global_settings where setting_name='Service Tax'");
while($row=mysqli_fetch_assoc($result))
{
$tax=$row['value'];
}

 $errorlog_path="/var/www/html/strikerapp/payment/Error_Logs/SFAResponse_paramesters".date("Ymd").".log";	  
	
?>
