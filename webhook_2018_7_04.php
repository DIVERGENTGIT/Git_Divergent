<?php
$content =trim(file_get_contents("php://input"));
$response = json_decode($content, true );
error_log(print_r($response,true)."\r\n",3,"/var/www/html/strikerapp/api_log/striker_api_log/awsRESs.log");
?>
   
