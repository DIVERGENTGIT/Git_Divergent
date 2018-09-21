<?php
$date=date('Y-m-d');
$req = json_encode($_REQUEST,true);
error_log($req,3,"/var/www/html/strikerapp/API/dlrlogs/dlrs.log");
?>
