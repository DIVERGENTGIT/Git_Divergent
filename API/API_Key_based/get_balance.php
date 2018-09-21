<?php 
include("../dbconnect/config.php");
 
 
/* Parameters */
$user_id=$_REQUEST['user_id'];


// Recently modified on 10/1/2017
$rs = $mysqli->query("select user_id,available_credits,no_ndnc,dnd_check,template_check from users where user_id =$user_id");
if($rs->num_rows > 0) {
    $val = $rs->fetch_object();     
    //$user_id = $val->user_id;
    $balance = $val->available_credits;
    echo $balance;
} else {
    echo "Invalid User Details";
}
$rs->close();   
$mysqli->close();


