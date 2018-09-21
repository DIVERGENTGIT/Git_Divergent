<?php
include("dbconnect/config.php");  

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
$username=$mysqli->real_escape_string($username);
$password=$mysqli->real_escape_string($password);
$rs=$mysqli->query("select * from users where username='$username' and password=md5('$password')");
if($rs->num_rows>0)
{
	while($val=$rs->fetch_array())
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

	$rs1=$mysqli->query($sql);
	
	if($rs1->num_rows>0)
	{		
	$senders=array();
	while($res=$rs1->fetch_array()){
		$sender['senderID']=$res['sender_name'];
		array_push($senders,$sender);
			}
		echo	json_encode($senders);
	
	}
	else{
		$msg= "You Don't have Template";
	
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
$mysqli->close();
	?>
