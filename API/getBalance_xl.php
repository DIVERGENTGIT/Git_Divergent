<?php 
include("dbconnect/config.php");
 
 
/* Parameters */
$username=@$_REQUEST['username'];
$password=@$_REQUEST['password'];

/* db connection */
/* Previous code
if(!@$db_link)
{
    $db_link=mysql_connect("localhost","root","myadmin") or die(mysql_error());
}   
else
{
    $db_link=mysql_pconnect("localhost","root","myadmin") or die(mysql_error());
}
mysql_select_db("sms",$db_link) or die(mysql_error());

 // user authentication 

$rs=mysql_query("select user_id, no_ndnc, available_credits from users where username='$username' and password=md5('$password')");
if(mysql_num_rows($rs)>0){
    $val=mysql_fetch_array($rs);
    $user_id=$val['user_id'];
    $balance = $val['available_credits'];
    echo $balance;
} else {
    echo "Invalid User Details";
}
mysql_close($db_link);
     
//$password = md5(trim($password));
$rs=$mysqli->query("select user_id, no_ndnc, available_credits from users where username='$username' and password=md5('$password')");
//print_r($mysqli->affected_rows);*/


// Recently modified on 10/1/2017
$rs = $mysqli->query("select user_id, no_ndnc,dnd_check, is_merge_duplicate,available_credits from users where username='".$username."' and password= '".md5($password)."' ");
if($rs->num_rows > 0) {
    $val = $rs->fetch_object();     
    $no_ndnc = $val->no_ndnc;
    $dnd_check = $val->dnd_check;
    $user_id = $val->user_id;
    $balance = $val->available_credits;
$is_merge_duplicate=$val->is_merge_duplicate;
if($dnd_check==1 && $no_ndnc==1)
{
$actbal=array("ActType"=>"Semi Transactional","is_merge_duplicate"=>$is_merge_duplicate,"Balance"=>$balance);
}
if($dnd_check==0 && $no_ndnc==1)
{
$actbal=array("ActType"=>"Transactional","duplicate_marge"=>$is_merge_duplicate,"Balance"=>$balance);
}
if($no_ndnc==0)
{
$actbal=array("ActType"=>"Promotional","duplicate_marge"=>$is_merge_duplicate,"Balance"=>"$balance");
}

echo json_encode($actbal);
} else {
    echo "Invalid User Details";
}
$rs->close();   
$mysqli->close();


