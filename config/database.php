<?php
header("Access-Control-Allow-Origin: *");


$link = mysqli_connect("localhost","strikerapp",'Off!c3@v2017',"sms");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  else
  {
  //echo "connect";
  } 
   

$baseurl="https://www.smsstriker.com/";


//define('SERVER_NAME','https://www.smsstriker.com/API/DLRS');   
define('SERVER_NAME','http://120.138.9.213/strikerapp/DLRS');   



?>
