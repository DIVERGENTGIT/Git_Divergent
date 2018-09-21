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
if(isset($_REQUEST['tmp_header'])){
$tmp_header=urldecode(trim($_REQUEST['tmp_header']));
}
if(isset($_REQUEST['tmp_footer'])){
$tmp_footer=urldecode(trim($_REQUEST['tmp_footer']));
}

if(isset($_REQUEST['tmp_title'])){
$tmp_title=urldecode(trim($_REQUEST['tmp_title']));
}

$date=date('y-m-d');
$path="/var/www/html/strikerapp/api_log/getcreditals/templates_$date.log";
$data = json_encode($_REQUEST,true);
error_log($data."\r\n",3,$path);


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
  $sql="insert into templates(template,user_id,template_name,template_header,template_footer) values('$template','$user_id','$tmp_title','$tmp_header','$tmp_footer')";
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
