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
if(isset($_REQUEST['template'])){
$template=trim($_REQUEST['template']);
}


if(isset($username) && isset($password)){
$rs=mysql_query("select * from users where username='$username' and password=md5('$password')");
if(mysql_num_rows($rs)>0)
{
	while($val=mysql_fetch_array($rs))
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

$limit=trim($_REQUEST['limit']);
$sql.="order by campaign_id desc limit ".$limit;

}

	$rs1=mysql_query($sql);
	
	if(mysql_num_rows($rs1)>0)
	{		
	$template=array();
	while($res=mysql_fetch_array($rs1)){
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
	$rs1=mysql_query($sql);
	
	if(mysql_num_rows($rs1)>0)
	{		
	$template=array();
	while($res=mysql_fetch_array($rs1)){
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
