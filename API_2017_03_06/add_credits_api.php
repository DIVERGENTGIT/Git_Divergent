<?php
include("dbconnect/config.php");

if($_REQUEST['api_keys'] && $_REQUEST['username'] && $_REQUEST['price'] && $_REQUEST['no_of_sms']) {
	$rewardAmt = $_REQUEST['price']+0;
	if(is_float($rewardAmt)) { 
		$no_of_sms=trim($_REQUEST['no_of_sms']);
		$username=trim(urldecode($_REQUEST['username']));
		$price=trim(urldecode($_REQUEST['price']));
		$apikey=trim(urldecode($_REQUEST['api_keys']));
		$total_amount=$no_of_sms * $price;
		   
		$payment_type=1;
		//$sql_query=mysql_query("select count(*) as cnt, user_id from api_keys where user_keys='$apikey'");
		$sql_query = $mysqli->query("select count(*) as cnt, user_id from api_keys where user_keys='".$apikey."' ");
		$apidata = $sql_query->fetch_object();     
		//$apidata=mysql_fetch_array($sql_query);
		//$reseller_id =$apidata['user_id'];
		$reseller_id =$apidata->user_id;      
		if($apidata->cnt == 1){
			$sql_username = $mysqli->query("select count(*) as cntusers, username,user_id from users where username='".$username."'");
			$apiusers = $sql_username->fetch_object();
			// $apiusers=mysql_fetch_array($sql_username);
			$user_id = $apiusers->user_id;
			$available_credits = $apiusers->available_credits;
			if($apiusers->cntusers == 1){	
				$sql_available_credits = $mysqli->query("select available_credits from users where user_id='".$reseller_id."'");
				//$sql_available_credits=mysql_query("select available_credits from users where user_id='$reseller_id'");
				//$available_credits=mysql_fetch_array($sql_available_credits);
				$available_credits = $sql_available_credits->fetch_object();
				$available_credits_reseller=$available_credits->available_credits;
				if($available_credits_reseller >= $no_of_sms) {
	
					$sql = $mysqli->query("insert into user_payments (`user_id`, `no_of_sms`, `price`, `amount`,`total_amount`,`payment_type`, `added_by`) VALUES ('".$user_id."','".$no_of_sms."','".$price."','".$total_amount."','".$total_amount."','".$payment_type."','".$reseller_id."')");
					$updatecredits = $mysqli->query("update users set available_credits = available_credits + $no_of_sms where user_id='$user_id'");
					$updatecredits = $mysqli->query("update users set available_credits = available_credits - $no_of_sms where user_id='$reseller_id'");
					$response["sucess"]="Credits Added Has Been Successfully";
				} else {
					$response["sucess"]="Insufficient SMS Credits.";
				}
	
			} else {
				$response["sucess"]="Credits Added Has Been Faild";
			}
		} else {
			$response["sucess"]="Invalid Key";
		}   
	   print_r(json_encode($response));
	}  else  {
		echo "Invalid Pricing Format.Please Enter Valid format(example:0.12)";
	} 
   }else {
   	echo "Required Parameters Missing";
   } 



?>
