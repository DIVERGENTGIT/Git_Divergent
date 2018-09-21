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
if(isset($_REQUEST['username'])){
$username=$_REQUEST['username'];
}
if(isset($_REQUEST['password'])){
$password=$_REQUEST['password'];
}
if(isset($_REQUEST['sender'])){
$sender=trim($_REQUEST['sender']);
}



if(isset($username) && isset($password)&&isset($sender)){

$username=mysql_real_escape_string($username);
$password=mysql_real_escape_string($password);
$rs=mysql_query("select * from users where username='$username' and password=md5('$password')");
	while($val=mysql_fetch_array($rs))
	{
	//print_r($val);
	$user_id=$val['user_id'];
	}


		$response=array();
		 $stmnt="select count(*) as cnt from sender_names where user_id='$user_id' and sender_name='$sender'";
		$sql_unique=mysql_query($stmnt);
		$row= mysql_fetch_array($sql_unique);
	  $cnt=	$row['cnt'];
	if($cnt==0)
		{


			$sql="INSERT INTO sender_names (user_id,sender_name,on_date) VALUES ('$user_id','$sender',NOW())";
			$sql_query=mysql_query($sql);

						print_r(json_encode(array('status'=>'Sender ID Added Successfully')));
		}
		else
		{
		    print_r(json_encode(array('status'=>'Sender ID Already Exist')));
		}
	}else{
	$respons["status"]="Required Parmeter Missing";
	echo json_encode($respons,true);

	}
?>

