<?php 
include('../../config/config.php');
/***
http://strikersoft.in/API/longcode/release_number.php?service_number=8367000030&service_type=shared
http://strikersoft.in/API/longcode/release_number.php?service_number=8367000060&service_type=dedicated
***/
if($_REQUEST['service_number']!='')
{
	$longcode_number=$_REQUEST['service_number'];
	$service_type=$_REQUEST['service_type'];
	
	//$query="update longcode_subscription set no_of_sms=0,used_incoming_sms=0 where longcode_number in ($longcode_number)";
	//$result = mysqli_query($link,$query) or die('Error query:  '.$query);
	
	// exit;
	
	/* for active
	$query="update longcode_numbers set user_id=2917,status=1 where longcode_number in ($longcode_number) ";
	$result = mysqli_query($link,$query) or die('Error query:  '.$query);
	
	$query="update longcode_subscription set user_id=2917,status=1 where longcode_number in ($longcode_number)";
	$result = mysqli_query($link,$query) or die('Error query:  '.$query);
	
	$query="update longcode_config set user_id=2917,status=1 where longcode_number in ($longcode_number)";
	$result = mysqli_query($link,$query) or die('Error query:  '.$query);
	
	exit;
	*/
	
	// for release numbers
	$query="select * from longcode_numbers where longcode_number in ($longcode_number)";
	$result = mysqli_query($link,$query) or die('Error query:  '.$query);
	if(mysqli_num_rows($result)>0)
	{
	
	$query="update longcode_numbers set user_id=0,status=0 where longcode_number in ($longcode_number) ";
	$result = mysqli_query($link,$query) or die('Error query:  '.$query);
	
	$query="update longcode_subscription set user_id=0,status=0 where longcode_number in ($longcode_number)";
	$result = mysqli_query($link,$query) or die('Error query:  '.$query);
	
	$query="update longcode_config set user_id=0,status=0 where longcode_number in ($longcode_number)";
	$result = mysqli_query($link,$query) or die('Error query:  '.$query);
	
	$status="Service Number Terminated Successfully";
	}
	else
	{
	 $status="In Valid Service Number";
	}
}
else
{
	$status="Required Service Number";
}

print_r(json_encode(array("status"=>200,"message"=>$status)))

?>
