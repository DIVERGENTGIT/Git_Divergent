<?php

$server_ip = "localhost";
$db_user = "strikerapp";
$db_pass = 'Off!c3@v2017';  
$db_name = "sms";  

$mysqli = new mysqli($server_ip, $db_user, $db_pass, $db_name);

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
    
//mysql_connect("$server_ip","$db_user","$db_pass");
//mysql_select_db("$db_name") or die("sql error".mysql_error()); 
                             
  
?> 
 
