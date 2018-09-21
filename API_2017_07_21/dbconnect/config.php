<?php

$server_ip = "localhost";
$db_user = "smsstrikerapp";
$db_pass = '$tr!k3r@2009';  
$db_name = "sms";  


/*
$server_ip = "localhost";
$db_user = "root";
$db_pass = 'ReK1ArEtA6';  
$db_name = "sms"; 
*/  
 


$mysqli = new mysqli($server_ip, $db_user, $db_pass, $db_name);

		$mysqli->set_charset("utf8");

/* check connection */
if ($mysqli->connect_errno) {  
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
    
define('SERVER_NAME','https://www.smsstriker.com/API/DLRS');   
define('CALL_SMS_API','https://www.smsstriker.com/API/sms.php?'); 
define('CALL_SMS_API_USERNAME','etisbew');   
define('CALL_SMS_API_PASSWORD','123456');    
define('CALL_SMS_API_FROM','TESTSM');  
define('SMS_ALERT_USER','support');           
define('SMS_ALERT_PWD','Str!k3r2020');        
define('SMS_ALERT_SENDERID','STRIKR');  
define('SMS_ALERT_TO','9581479111,7659897711,9701019800,9966487711'); 
define('XML_TEST_USER','narayanaxml');
define('XML_TEST_PWD','narayanagroup1979');   
define('ERRORLOGS','/var/www/html/strikerapp/api_log/dnd_logs/dnd.log');
define('CAMPRETURNCREDITS','/var/www/html/logs/strikerCampReturnCredits_log');   
                                                
  
?> 
 
