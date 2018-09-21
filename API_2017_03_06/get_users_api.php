<?php
include("dbconnect/config.php");

if($_REQUEST['api_keys'])
{

	$apikey=trim(urldecode($_REQUEST['api_keys']));
	$sql_query=$mysqli->query("select count(*) as cnt, user_id from api_keys where user_keys='".$apikey."'");
	$apidata=$sql_query->fetch_array(MYSQLI_ASSOC);
	$reseller_id =$apidata['user_id'];
	if($apidata['cnt']==1){
	$sql_username=$mysqli->query("select username,email,mobile,organization,login_time,available_credits from users where reseller_id='".$reseller_id."'");
	while($apiusers_row=$sql_username->fetch_array(MYSQLI_ASSOC)) {
	$reseller_users[]=$apiusers_row;
	}
	print_r(json_encode($reseller_users));
	}
	else
	{
	   $response["sucess"]="Invalid Key";
	} 
	   print_r(json_encode($response));
	}
	else
	{
	   echo "required parameters missing";
	}

?>
