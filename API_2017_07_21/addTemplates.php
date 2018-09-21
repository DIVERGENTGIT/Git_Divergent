<?php
include("dbconnect/config.php");

if(isset($_REQUEST['username'])){
$username=$_REQUEST['username'];
}
if(isset($_REQUEST['password'])){ 
$password=$_REQUEST['password'];
}
if(isset($_REQUEST['template'])){
$template=urldecode(trim($_REQUEST['template']));
}
$date=date('y-m-d');
$path="/var/www/html/strikerapp/api_log/getcreditals/templates_$date.log";
error_log(print_r($_REQUEST,TRUE)."\n",3,$path);

if(isset($username) && isset($password)){

$rs=$mysqli->query("select * from users where username='$username' and password=md5('$password')");
if($rs->num_rows >0)
{
	while($val= $rs->fetch_array())
	{
	//print_r($val);
	$user_id=$val['user_id'];
	}
		
		if(isset($template)){
  $sql="insert into templates(template,user_id) values('$template','$user_id')";
$rs1=$mysqli->query($sql);
if($rs1){
$sucess="Templetes Successfully Added";
echo json_encode(array("success"=>$sucess));
}
else{
$msg= "Unable to add Templetes";

}
}else{
$msg= "Require parameter Missing";
}

}

	}	
	
else
{
	$msg= "Please enter valid user details";
	}
	
	if($msg)
echo json_encode(array("errmsg"=>$msg));
$mysqli->close();
	?>
