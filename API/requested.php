<?php
$date=date('Y-m-d');
//$print= file_get_contents(json_encode(print_r($_REQUEST),true));
//print_r($print);
 
$req = json_encode($_REQUEST,true);
error_log($req,3,"/var/www/vhosts/www.smsstriker.com/htdocs/strikerapp/API/longcode_log/longcode_$date.log");
?>
