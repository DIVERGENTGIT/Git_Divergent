<?php
include("../dbconnect/config.php");  

$user_id=$_REQUEST['user_id'];
if(isset($_REQUEST['sender'])){
$sender=trim($_REQUEST['sender']);
}

if(isset($user_id)){

$rs=$mysqli->query("select * from users where user_id =$user_id");
if($mysqli->num_rows($rs)>0)
{
	
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
	
	if($mysqli->num_rows($rs1)>0)
	{		
	$senders=array();
	while($res=$mysqli->fetch_array($rs1)){
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
$mysqli->close();
	?>
