<?php
include("dbconnect/config.php");

if($_REQUEST['api_keys'] && $_REQUEST['username'] && $_REQUEST['price'] && $_REQUEST['no_of_sms'])
{

$rewardAmt = $_REQUEST['price']+0;
if(is_float($rewardAmt))
{
	$no_of_sms=trim($_REQUEST['no_of_sms']);
	$username=trim(urldecode($_REQUEST['username']));
	$price=trim(urldecode($_REQUEST['price']));
	$apikey=trim(urldecode($_REQUEST['api_keys']));
	$total_amount=$no_of_sms * $price;
	$payment_type=3;
	$sql_query=$mysqli->query("select count(*) as cnt, user_id from api_keys where user_keys='$apikey'");
	$apidata=$sql_query->fetch_array();
	$reseller_id =$apidata['user_id'];
	if($apidata['cnt']==1){
	$sql_username=$mysqli->query("select count(*) as cntusers, username,user_id,available_credits from users where username='$username'");
	$apiusers=$sql_username->fetch_array();
	 $user_id=$apiusers['user_id'];
	 $available_credits=$apiusers['available_credits'];
	if($apiusers['cntusers']==1){
	if($available_credits>=$no_of_sms){
	$sql=$mysqli->query("insert into user_payments (`user_id`, `no_of_sms`, `price`, `amount`,`total_amount`,`payment_type`, `added_by`) VALUES ('$user_id','$no_of_sms','$price','$total_amount','$total_amount','$payment_type','$reseller_id')");
	$updatecredits=$mysqli->query("update users set available_credits = available_credits - $no_of_sms where user_id='$user_id'");
	$updatecredits=$mysqli->query("update users set available_credits = available_credits + $no_of_sms where user_id='$reseller_id'");
	$response["sucess"]="Credits Has Been Detected";
	}
	else
	{
	$response["sucess"]="Insufficient SMS Credits.";
	}
	
	}
	
	else
	{
	$response["sucess"]="Credits Detected Has Been Faild";
	}
	}
	else
	{
	$response["sucess"]="Invalid Key";

	} 
	print_r(json_encode($response));
       } 
	else    
	{
	echo "Invalid Pricing Format.Please Enter Valid format(example:0.12)";
	}
	}else
	{
	echo "required parameters missing";
	}






?>
