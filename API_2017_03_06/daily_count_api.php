<?php 
include("dbconnect/config.php");
/* Parameters */
$username=$_REQUEST['username'];
$password=$_REQUEST['password'];
$date=$_REQUEST['date'];
//echo "(ondate>='$date 00:00:12' and ondate<='$date 23:59:12')";
//echo (ondate>="$date 00:00:12" and ondate<="$date 23:59:12");
/* db connection
if(!$db_link)
{
    $db_link=mysql_connect("localhost","root","myadmin") or die(mysql_error());
}
else
{
    $db_link=mysql_pconnect("localhost","root","myadmin") or die(mysql_error());
}
mysql_select_db("sms",$db_link) or die(mysql_error());  */

/* user authentication */
$rs=$mysqli->query("select user_id, no_ndnc, available_credits from users where username='".$username."' and password='".md5($password)."'");
if($rs->num_rows > 0){
    $val= $rs->fetch_array(MYSQLI_ASSOC);
    $user_id=$val['user_id'];   
    $balance = $val['available_credits'];
    //echo $balance;
	//echo $user_id;

	$rs1=$mysqli->query("select count(to_mobileno),ondate from sms_api_messages where user_id='".$user_id."' and (ondate>='$date 00:00:12' and ondate<='$date 23:59:12')");

	if($rs1->num_rows > 0){
		
        $val1= $rs1->fetch_array(MYSQLI_NUM);
	//echo $val1;
  $ondate=$val1[1];
  //echo $ondate;
    $sms_count = $val1['0'];     
	//$delivered_count= $val1['delivered_count'];
	//$expired_count= $val1['expired_count'];
	//$invalid_count= $val1['invalid_count'];
	//echo $delivered_count;
	//echo $on_date;
	//echo $sms_count;
	$ondate=substr($ondate,0,10);
	echo "{Total_count: $sms_count ,ondate:$ondate }";
} }else {
    echo "Invalid User Details";
}
$mysqli->close(); 
?>
