<?php

$server_ip = "localhost";
$db_user = "strikerapp"; 
$db_pass = 'Off!c3@v2017';  
$db_name = "sms";    
  
$mysqli = new mysqli($server_ip, $db_user, $db_pass, $db_name);
$mysqli->set_charset("utf8");

     
//define('SERVER_NAME','https://www.smsstriker.com/API/DLRS');   
define('SERVER_NAME','http://120.138.9.213/strikerapp/DLRS');   

 
?>


