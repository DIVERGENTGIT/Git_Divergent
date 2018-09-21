<?php
header("Access-Control-Allow-Origin: *");
$link = mysqli_connect("localhost","strikerapp",'Off!c3@v2017',"sms");
//$link = mysqli_connect("localhost","root",'striker@123',"sms");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
header('Content-type: application/json');
$baseurl="https://www.smsstriker.com/newui_1.0.0.1";
?>
