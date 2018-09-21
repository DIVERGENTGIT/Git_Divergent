<?php
include("../config/config.php");

//print_r($_REQUEST);
//exit;


 	$date=date('Y-m-d');  
$req = json_encode($_REQUEST,true);
error_log($req,3,"/var/www/html/strikerapp/API/longcode_log/rawdata_$date.log");
if($_REQUEST['longcode_number']!='')
{
	$longcode_number=$_REQUEST['longcode_number'];
	$user_id=$_REQUEST['user_id'];
	$keyword_name=$_REQUEST['keyword_name'];
	$service_type=$_REQUEST['service_type'];
	$on_time=$_REQUEST['on_time'];
	$body=$_REQUEST['body'];
	$user_mobile=$_REQUEST['user_mobile'];
	$condition1="";
	if($_REQUEST['keyword_name']!='')
	{
		$keyword_name=$_REQUEST['keyword_name'];
		$condition1=" AND keyword='$keyword_name'";
	}
      // get user details
	$sql3="select username,password,mobile,longcode_credits from users where user_id=$user_id";
	$result3=mysqli_query($link,$sql3);
	$user_info=mysqli_fetch_assoc($result3);
	//print_r($user_info);
	$username=$user_info['username'];
	$password=$user_info['password'];
	$longcode_credits=$user_info['longcode_credits'];
	$vendor_mobile=$user_info['mobile'];

	$st="select * from longcode_config 
	where status= 1 and user_id=$user_id  and longcode_number='$longcode_number' and service_type='$service_type' $condition1";
	$getRes = mysqli_query($link,$st);
	if(mysqli_num_rows($getRes) > 0) 
	{
		// longcode number configured 
		while($longcode_config = mysqli_fetch_assoc($getRes))
		{ 
			extract($longcode_config);
			$messagetype=1;
			
			/****************** CUSTOMER ALERT SART *********************************/	                                       
			if($customer_alert!='')
			{
				$message=$customer_alert;
				$status="Recieved";
				
				if($user_mobile>0)  // customer messages alert
				{
				call_sms_api($username,$password,$message,$user_mobile,$sender_id,$messagetype);
				$sql_insert="insert into longcode_smsmessages (service_number,message_from,status,error_message,message,message_time,user_id,sender_id,keyword,smscinfo,service_type)
 values ('$longcode_number','$user_mobile','Recieved','$status','$message','$on_time',$user_id,'$sender_id','$keyword_name','$smscinfo','$service_type')";
				mysqli_query($link,$sql_insert);
				
				$customer_alert="Customer SMS Send Successfully !...";
				
				}  
			}
			/************************  CUSTOMER ALERT END *****************************************/
		
	            /***********************************  VENDOR ALERT START ************************************/
			if($vender_alert!='')
			{
				if($vendor_number!='')
				{
				$vendor_mobile=$vendor_number;
				}
				$message=trim(message_replace($vender_alert,$user_mobile,$longcode_number,$on_time,$body),",");
				// send custom sms api
				if($vendor_mobile>0)
				{
				call_sms_api($username,$password,$message,$vendor_mobile,$sender_id,$messagetype);
				$vendor_alert="Vendor SMS Send Successfully !...";
				} 

				/// insert vendor sms	
				$sql_insert="insert into longcode_smsmessages (service_number,message_from,status,error_message,message,message_time,user_id,sender_id,keyword,smscinfo,service_type) values ('$longcode_number','$vendor_mobile','Sent','$status','$message','$on_time',$user_id,'$sender_id','$keyword_name', '$smscinfo','$service_type')";
				mysqli_query($link,$sql_insert);	
			}


			/***********************************  VENDOR ALERT END *****************************************/
			
			
			if($api_alert == 1)
			{
			//echo $api_alert;
			longcode_api($connect_api_url,$phone_number,$service_numbers,$sms_time,$sms_text_param,$user_mobile,$longcode_number,$on_time,$body,$service_type);
			}
			


if($customer_alert=='' && $vender_alert=='' && $service_type=='dedicated')
{

$keyword_name="N/A";
$vendor_mobile='';
 $sql_insert="insert into longcode_smsmessages (service_number,message_from,status,error_message,message,message_time,user_id,sender_id,keyword,smscinfo,service_type) values ('$longcode_number','$user_mobile','Recieved','$status','$body','$on_time',$user_id,'$sender_id','$keyword_name', '$smscinfo','$service_type')";
mysqli_query($link,$sql_insert);

}
			/***********************************  BALANCE DEDUCTION START*****************************************/

			balance_deduction($link,$user_id,$longcode_price,$longcode_number);

			/***********************************   BALANCE DEDUCTION END*****************************************/

		}
	}
mysqli_close($link);

}

echo $msg="Message has been sent successfully";
//print_r(array("customer_status"=>$customer_alert,"vendor_status"=>$vendor_alert,"status"=>$status));
//  message_replace
function message_replace($vender_alert,$mobile,$longcode_number,$on_time,$body)
{
global $body;
$message='';
  
	$str=$vender_alert;
	// replace with coustomer Message
	$str1=str_replace("<Message>",$body,$str);
	// replace with coustomer number
	$str2=str_replace("<Customer Number>",$mobile,$str1);
	// replace with Service number 
	$str3=str_replace("<Service Number>",$longcode_number,$str2);
	// replace with Service number 
	$message=str_replace("<Sent Time>",$on_time,$str3);
 	$date=date('Y-m-d');  
	error_log($message,3,"longcode_log/stringreplace_$date.log");  
return $message;
}
	
// send sms 

function call_sms_api($username,$password,$message,$mobile,$sender_id,$messagetype) 
{
	//$api = "http://www.smsstriker.com/API/custom_missedcallsms_api.php?";
	
	$api = "https://www.smsstriker.com/API/custom_missedcallsms_api.php?";
	$api .= "username=$username&";
	$api .= "password=$password&";
	$api .= "to=".$mobile."&";
	$api .= "msg=".urlencode($message)."&";
	$api .= "from=".$sender_id."&";
	$api .= "type=".$messagetype."&";
	
	$rs=file_get_contents($api);
 	$date=date('Y-m-d');  
	error_log($api,3,"longcode_log/customapi_$date.log");

//return $rs;   
	return true; 
}


/** SMS LONGCODE URL API  **/

function longcode_api($connect_api_url,$phone_number,$service_numbers,$sms_time,$sms_text_param,$user_mobile,$dest,$on_time,$body,$service_type) { 
 
	$on_time = urlencode($on_time);
	$body = urlencode($body);
	$api =$connect_api_url;  
	$api .=trim("?$phone_number=$user_mobile");
	$api .=trim("&$service_numbers=$dest");
	$api .=trim("&$sms_time=$on_time");  
	$api .=trim("&$sms_text_param=$body");    
 	$date=date('Y-m-d');  
	$rs = file_get_contents($api); 
	error_log($rs.$api,3,"/var/www/html/strikerapp/API/longcode_log/lmsapi_$date.log");  
	return $r;
 
}

function balance_deduction($link,$user_id,$longcode_price,$longcode_number)
{
	// $sql="select * from longcode_subscription  where user_id=$user_id and longcode_number=$longcode_number";
	
	 $currentdate=date("Y-m-d");
	 $sql="select * from  longcode_subscription where  longcode_number='$longcode_number' and 
		date(subscription_end) >= date('$currentdate') and user_id=$user_id and status=1";
	 $result3=mysqli_query($link,$sql);
	 if(mysqli_num_rows($result3)>0)
	 {
	  $longcode_subscription=mysqli_fetch_assoc($result3);
	  
	  $no_of_sms=$longcode_subscription['no_of_sms'];
	  $used_incoming_sms=$longcode_subscription['used_incoming_sms'];
	  $vailable_credits=$no_of_sms-$used_incoming_sms;
			if($vailable_credits>0)  // SMS deduction
			{
			$incoming_sms=1;
			$sql="update longcode_subscription set used_incoming_sms=used_incoming_sms+1 where user_id=$user_id 
			and longcode_number=$longcode_number ";
			mysqli_query($link,$sql);
			}
			else // Credit deduction
			{
				$sql="update users set longcode_credits=longcode_credits-1 where user_id=$user_id";
				mysqli_query($link,$sql);
			}
			
	}
	else // Credit deduction
	{
		$sql="update users set longcode_credits=longcode_credits-1 where user_id=$user_id";
		mysqli_query($link,$sql);
	}
	
	//echo $sql;
mysqli_close($link);

}
