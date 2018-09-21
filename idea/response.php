<?php
$currentdate=date("Y-m-d");
 error_log(json_encode($_GET)."\n",3,"/var/www/html/Reseller_User/idea/longcode_response_$currentdate.log");  


?>
