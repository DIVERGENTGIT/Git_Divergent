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
$template=urldecode(trim($_REQUEST['template']));
}
$date=date('y-m-d');
$path="/var/www/vhosts/www.smsstriker.com/htdocs/api_log/getcreditals/templates_$date.log";
error_log(print_r($_REQUEST,TRUE)."\n",3,$path);

if(isset($username) && isset($password)){

$rs=mysql_query("select * from users where username='$username' and password=md5('$password')");
if(mysql_num_rows($rs)>0)
{
	while($val=mysql_fetch_array($rs))
	{
	//print_r($val);
	$user_id=$val['user_id'];
	}
		
		if(isset($template)){
  $sql="insert into templates(template,user_id) values('$template','$user_id')";
$rs1=mysql_query($sql);
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
mysql_close();
	?>
