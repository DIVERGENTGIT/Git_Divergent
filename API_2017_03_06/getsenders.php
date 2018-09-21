<?php
if(!$db_link)
{
    //$db_link=mysql_connect("localhost","root","myadmin") or die(mysql_error());
    
    $db_link=mysql_connect("localhost","smsstrikerapp",'$tr!3r@2009') or die(mysql_error());
   
}
else
{
   // $db_link=mysql_pconnect("localhost","root","myadmin") or die(mysql_error());
     $db_link=mysql_connect("localhost","smsstrikerapp",'$tr!3r@2009') or die(mysql_error());
}

mysql_select_db("sms",$db_link) or die(mysql_error());
if(isset($_REQUEST['username'])){
$username=$_REQUEST['username'];
}
if(isset($_REQUEST['password'])){
$password=$_REQUEST['password'];
}
if(isset($_REQUEST['sender'])){
$sender=trim($_REQUEST['sender']);
}

if(isset($username) && isset($password)){
$username=mysql_real_escape_string($username);
$password=mysql_real_escape_string($password);
$rs=mysql_query("select * from users where username='$username' and password=md5('$password')");
if(mysql_num_rows($rs)>0)
{
	while($val=mysql_fetch_array($rs))
	{
	//print_r($val);
	$user_id=$val['user_id'];
	}
		$sql="select sender_name from sender_names where user_id='$user_id'";
if(isset($sender)){
			if(strlen($sender)==6 && !empty($sender))
			{	
			$sql.="and 	sender_name='$sender'";
			}else{
			$msg= "sender id must be 6 characters";
			}
	}
if(isset($_REQUEST['limit'])){
$limit=trim($_REQUEST['limit']);
$sql.="order by id desc limit ".$limit;
}

	$rs1=mysql_query($sql);
	
	if(mysql_num_rows($rs1)>0)
	{		
	$senders=array();
	while($res=mysql_fetch_array($rs1)){
		$sender['senderID']=$res['sender_name'];
		array_push($senders,$sender);
			}
		echo	json_encode($senders);
	
	}
	else{
		$msg= "You Don't Templates";
	
	}
	}	
	
else
{
	$msg= "Please enter valid user details";
	}
	}else{
		$msg= "Required Parameters Missing";
	}
	if($msg)
echo json_encode(array("errmsg"=>$msg));
mysql_close();
	?>
