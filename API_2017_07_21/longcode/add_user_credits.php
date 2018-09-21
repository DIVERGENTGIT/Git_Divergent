<?php 
include('../../config/config.php');
/***
http://strikersoft.in/API/longcode/add_user_credits.php?user_id=2917&user_credits=1000
***/
if($_REQUEST['user_id']!='')
{
	$user_id=$_REQUEST['user_id'];
	$user_credits=$_REQUEST['user_credits'];
	
	// for release numbers
	$query="select * from users where user_id in ($user_id)";
	$result = mysqli_query($link,$query) or die('Error query:  '.$query);
	if(mysqli_num_rows($result)>0)
	{
	
	$query="update users set available_credits=available_credits+$user_credits where user_id in ($user_id)";
	$result = mysqli_query($link,$query) or die('Error query:  '.$query);
	
	$status="Successfully";
	}
	else
	{
	 $status="In Valid User ID";
	}
}
else
{
	$status="In Valid User ID";
}

print_r(json_encode(array("status"=>200,"message"=>$status)))

?>
