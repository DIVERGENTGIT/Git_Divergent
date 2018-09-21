<?php


$server_ip = "localhost";   
$db_user = "pointsmsapp";
$db_pass = 'po!nt$m$@2009';  
$db_name = "sms_reseller";    
 
$mysqli = new mysqli($server_ip, $db_user, $db_pass, $db_name);    
$mysqli->set_charset("utf8"); 

 //define('SERVER_NAME','http://pointsms.in/DLRS');   
define('SERVER_NAME','http://120.138.9.213/pointsms/DLRS');   

 
?>


