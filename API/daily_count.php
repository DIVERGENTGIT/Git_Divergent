<?php  
include("dbconnect/config.php");
/* Parameters */
$username=$_REQUEST['username'];
$password=$_REQUEST['password'];
$date=$_REQUEST['date'];
//echo $date;

/* db connection 
if(!$db_link)
{
    $db_link=mysql_connect("localhost","root","myadmin") or die(mysql_error());
}
else
{
    $db_link=mysql_pconnect("localhost","root","myadmin") or die(mysql_error());
}
mysql_select_db("sms",$db_link) or die(mysql_error()); */

/* user authentication */
$rs = $mysqli->query("select user_id, no_ndnc, available_credits from users where username='".$username."' and password='".md5($password)."'");
if($rs->num_rows > 0){
    $val = $rs->fetch_array(MYSQLI_ASSOC);
    $user_id=$val['user_id'];
    $balance = $val['available_credits'];
    //echo $balance;
	//echo $user_id;

	$rs1=$mysqli->query("select on_date,sms_count,delivered_count,expired_count,invalid_count from sms_api_daily_count where user_id='".$user_id."' and on_date='".$date."'");
	  
	if($rs1->num_rows > 0){
		
    $val1 = $rs1->fetch_array(MYSQLI_ASSOC);
	
    $on_date=$val1['on_date'];
    $sms_count = $val1['sms_count'];
	$delivered_count= $val1['delivered_count'];
	$expired_count= $val1['expired_count'];
	$invalid_count= $val1['invalid_count'];
	//echo $delivered_count;
	//echo $on_date;
	//echo $sms_count;
	echo "{Total_count: $sms_count ,Delivered:$delivered_count,expired_count:$expired_count,ondate:$on_date }";
} }else {
    echo "Invalid User Details";
}
$mysqli->close();
?>
