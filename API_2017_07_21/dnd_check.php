<?php 
include("dbconnect/config.php");

/* Parameters */
$username=$_REQUEST['username'];
$password=$_REQUEST['password'];
$to_mobiles=$_REQUEST['to'];

$mm=explode(",",$to_mobiles);

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
$rs= $mysqli->query("select user_id, no_ndnc, available_credits from users where username='".$username."' and password='".md5($password)."'");
if($rs->num_rows > 0){
    

for($i=0;$i<count($mm);$i++) {
	$to=trim($mm[$i]);
	if($to){
	     //check for dnd number
    $checkDndRes = $mysqli->query("SELECT count(*) as dnd FROM dnd_db.ndnc_data WHERE dnc_number = '{$to}'");
    $checkDndRow =$checkDndRes->fetch_array(MYSQLI_NUM);
    $isDND = $checkDndRow['dnd'];
    if($isDND){
		echo "DND Number";
	} else {
        echo "Non DND Number";
            }
    } else{ 
		echo "Invalid Details";
	}	
	}
} 

else {
    echo "Invalid User Details";
}
$mysqli->close();
?>
