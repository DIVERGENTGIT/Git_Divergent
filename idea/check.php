<?php
echo $query=urldecode($_REQUEST['query']);

$trk=$_REQUEST['from'] .$query;

error_log($trk."\r\n",3,"/var/www/html/Reseller_User/idea/error_log/tsrtc_url_test.log");

?>

		
