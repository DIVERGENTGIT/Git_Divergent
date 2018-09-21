<?php
 // $inputJSON = file_get_contents("php://input");
//$input = json_decode($inputJSON, true);
$req = json_encode($_REQUEST,true);
$b=json_decode($req,true);


error_log(print_r($_REQUEST)."\r\n",3,"/var/www/html/strikerapp/api_log/striker_api_log/awsinput.log");
error_log($req."\r\n",3,"/var/www/html/strikerapp/api_log/striker_api_log/awsRES.log");
?>
 
