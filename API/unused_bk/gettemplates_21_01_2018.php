<?php
include("dbconnect/config.php");  

if(isset($_REQUEST['username'])){
$username=$_REQUEST['username'];
}
if(isset($_REQUEST['password'])){
$password=$_REQUEST['password'];
}
if(isset($_REQUEST['template'])){
$template=trim($_REQUEST['template']);
}


if(isset($username) && isset($password)){
$rs=$mysqli->query("select * from users where username='$username' and password=md5('$password')");
if($rs->num_rows > 0)
{
	while($val=$rs->fetch_array())
	{
	//print_r($val);
	$user_id=$val['user_id'];
	}
			if(isset($_REQUEST['type'])){
$type=trim($_REQUEST['type']);
}

if($type==0){ // recent templates
		$sql="select sms_text from campaigns where user_id='$user_id'";
if(isset($template)){
			if(!empty($template))
			{	
			$sql.="and 	sms_text like '%$template%'";
			}
	}
	
if(isset($_REQUEST['limit'])){

$limit= 25;//trim($_REQUEST['limit']);
$sql.="order by campaign_id desc limit ".$limit;
  
}

	$rs1=$mysqli->query($sql);
	
	if($rs1->num_rows > 0)
	{		
	$template=array();
	while($res= $rs1->fetch_array()){
		 $temp["template"]=$res['sms_text'];
		array_push($template,$temp);
			}
		echo	json_encode($template);
	
	}
	else{
		$msg= "You Don't have Templates";
	
	}
}
else{
		$sql="select template from templates where user_id='$user_id'";
if(isset($template)){
			if(!empty($template))
			{	
			$sql.="and 	template like '%$template%'";
			}
	}
	if(isset($_REQUEST['limit'])){
$limit=trim($_REQUEST['limit']);
$sql.="order by template_id desc limit ".$limit;
}
	$rs1=$mysqli->query($sql);
	
	if($rs1->num_rows>0)
	{		
	$template=array();
	while($res= $rs1->fetch_array()){
		 $temp["template"]=$res['template'];
		array_push($template,$temp);
			}
		echo	json_encode($template);
	
	}  
	else{
		$msg= "You Don't have Templates";
	
	}
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
