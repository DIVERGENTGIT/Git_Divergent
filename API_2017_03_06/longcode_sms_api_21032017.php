<?php 
include("dbconnect/config.php");

/*
// success case :
http://localhost/smsstriker/API/longcode_sms_api.php?%20&sender=NARESH&dest=sdgjsd&body=HI%20test&smsinfo=%22sdgsdh%22&senttime=2017-02-17%2001:01:01&smscinfo=shjsdgjh

// failed case

http://localhost/smsstriker/API/longcode_sms_api.php?%20&sender=NARESH&dest=sdgjsd&body=HI%20&smsinfo=%22sdgsdh%22&senttime=2017-02-17%2001:01:01&smscinfo=shjsdgjh

http://www.smsstriker.com/API/longcode_sms_api.php?sender=917799424688&dest=8367000040&senttime=13/03/17 10:37:37 AM&msg=KRISHNA 11
http://10.10.10.25/smsstriker/API/longcode_sms_api.php?sender=8688388672&dest=8688388676&msg=test&senttime=13/03/17
*/
      $currentdate=date("Y-m-d");
error_log(json_encode($_GET)."\n",3,"longcode_log/longcode_$currentdate.log");  

if(isset($_GET['sender']))
{

//print_r($_GET);


	$user_mobile = $_GET['sender'];  // customer mobile number
	$dest = $_GET['dest'];          // longcode number
	$body = urldecode($_GET['msg']); // message 
	$smscinfo = urldecode($_GET['smscinfo']); // operator information
	$date=$_GET['senttime'];
	$datesplit=explode("/",$date);
	$day= $datesplit[0];  
	$month= $datesplit[1];
	$datesplit[2];
	$yearsplt=explode(" ",$datesplit[2]);
	$year=$yearsplt[0];
	//$year="20".$yearsplt[0];
	$on_time=$year."-".$month."-".$day." ".$yearsplt[1];
	$customer_alert='';
	$vendor_alert='';
//error_log("BODY".$body."\n",3,"longcode_log/longcode_$currentdate.log");  

$sql="select * from  longcode_subscription where  longcode_number='$dest' and date(subscription_end) >= date('$currentdate') ";
		 $getService_info = mysqli_query($mysqli,$sql) or die("query error".mysqli_error()); 

	if(mysqli_num_rows($getService_info) > 0)
	{

		 while($getService_info_res = mysqli_fetch_object($getService_info)) 
		 {
		// print_r($getService_info_res);
		// exit;
			  $service_type = $getService_info_res->service_type;  
			  $user_id = $getService_info_res->user_id;
			   $longcode_number = $getService_info_res->longcode_number; 
			   
			$sql="select keyword_name from longcode_keywords where user_id = '".$user_id."' AND longcode_number = '".$longcode_number."' AND status = 1 ";
		
			  $getServiceKeywords = mysqli_query($mysqli,$sql); 
			 if(mysqli_num_rows($getServiceKeywords) > 0)  
			 {
				  while($getServiceKeywords_res = mysqli_fetch_object($getServiceKeywords)) 
				  {
				  
				//print_r($getServiceKeywords_res);
				//exit;
					$keyword_name = $getServiceKeywords_res->keyword_name;
					//echo $body;
					$matched = FALSE;
					$service_type;
					if($service_type == 'shared') {
						if(preg_match('/('.$keyword_name.')/', $body, $matches, PREG_OFFSET_CAPTURE)) {
							$matched = TRUE;
						}
 
						if(!$matched) {  
							break;
					       }   
				}
			
if($keyword_name!='')
{
 $st="select * from longcode_config where (status= 1 and user_id=$user_id  and longcode_number='$longcode_number') and keyword='$keyword_name'";
}
else{
 $st="select * from longcode_config where (status= 1 and user_id=$user_id  and longcode_number='$longcode_number')";
}
 //echo $st;
 
 
					 $getRes = mysqli_query($mysqli,$st);
					 //echo mysqli_num_rows($getRes);
					 if(mysqli_num_rows($getRes) > 0)
					 {
					
						 while($longcode_config = mysqli_fetch_assoc($getRes))
						 { 
							///print_r($longcode_config);exit;
														
							extract($longcode_config);

 			
							$messagetype=1;

							// get user information
							$sql3="select username,password,mobile,longcode_credits from users where user_id=$user_id";
							$result3=mysqli_query($mysqli,$sql3);
							$user_info=mysqli_fetch_assoc($result3);

							//print_r($user_info);

							$username=$user_info['username'];
							$password=$user_info['password'];
							
							$longcode_credits=$user_info['longcode_credits'];

// vendor number if not avalable in profile then get the mobile information from input box of vendor block

							if($vendor_number!='')
							{
								$vendor_mobile=$vendor_number;
							}
							else
							{
								$vendor_mobile=$user_info['mobile'];
							}

 							// get longcode price
							$longcode_price=getLongcode_price($mysqli,$user_id); 
                                          // get longcode price
                                     
 /******************************* CUSTOMER ALERT SART ****************************************/	                                       
	if($customer_alert!='')
	{
	
		$message=$customer_alert;
		$sql="select * from longcode_subscription  where user_id=$user_id and longcode_number=$longcode_number";
		$result3=mysqli_query($mysqli,$sql);
		if(mysqli_num_rows($result3)>0)
		{
		$longcode_subscription=mysqli_fetch_assoc($result3);


		$service_type=$longcode_subscription['service_type'];
		$no_of_sms=$longcode_subscription['no_of_sms'];

		$used_incoming_sms=$longcode_subscription['used_incoming_sms'];

		$vailable_credits=$no_of_sms-$used_incoming_sms;
		 
			if($vailable_credits>0) // from longcode_subscription table
			{
				$status="sent";
			}
			else if($longcode_credits>$longcode_price) // from users table deduction
			{
				$status="sent";
			}
			else
			{
				$status="insufficient balance";
			}
			
		            if($user_mobile>0)  // customer messages alert
				{
				call_sms_api($username,$password,$message,$user_mobile,$sender_id,$messagetype);
				insert_sms_api($mysqli,$user_id,$user_mobile,$message,$on_time,$keyword_name,$sender_id,$longcode_number,
				$smscinfo,$status,$service_type);
				$customer_alert="Customer SMS Send Successfully !...";
				}  
		}						
      }
						      
/***********************************  CUSTOMER ALERT END *****************************************/

/***********************************  VENDOR ALERT START *****************************************/

	if($vender_alert!='')
	{
		$message=trim(message_replace($vender_alert,$mobile,$longcode_number,$on_time),",");
		//$message=$vender_alert;
		$sql="select * from longcode_subscription  where user_id=$user_id and longcode_number=$longcode_number";
		$result3=mysqli_query($mysqli,$sql);
		if(mysqli_num_rows($result3)>0)
		{
		$longcode_subscription=mysqli_fetch_assoc($result3);
		
		$service_type=$longcode_subscription['service_type'];

		$no_of_sms=$longcode_subscription['no_of_sms'];
		$used_incoming_sms=$longcode_subscription['used_incoming_sms'];

		$vailable_credits=$no_of_sms-$used_incoming_sms;
		      $mobile=$vendor_mobile;
			if($vailable_credits>0)
			{
			$status="sent";
			}
			else if($longcode_credits>$longcode_price)
			{
			$status="sent";
			}
			else
			{
			$status="insufficient balance";
			}
			
			// send custom sms api
	           if($vendor_mobile>0)
			{
			call_sms_api($username,$password,$message,$vendor_mobile,$sender_id,$messagetype);
			$vendor_alert="Vendor SMS Send Successfully !...";
			} 
			 
			/// insert vendor sms	
			$sql_insert="insert into longcode_smsmessages (service_number,message_from,status,message,message_time,user_id,sender_id,keyword,smscinfo,count,service_type) values ('$longcode_number','$vendor_mobile','$status','$message','$on_time',$user_id,'$sender_id','$keyword_name', '$smscinfo','$status','$service_type')";
			mysqli_query($mysqli,$sql_insert);	
			
		}
	
	           				

	}

//echo $customer_alert;
//echo $vendor_alert;


/***********************************  VENDOR ALERT END *****************************************/

/***********************************  BALANCE DEDUCTION START*****************************************/

 balance_deduction($mysqli,$user_id,$longcode_price,$longcode_number);
 
 /***********************************   BALANCE DEDUCTION END*****************************************/
 
 							//	echo $api_alert;
							if($api_alert == 1)
							{

 
								//echo $api_alert;
 longcode_api($connect_api_url,$phone_number,$service_numbers,$sms_time,$sms_text_param,$user_mobile,$longcode_number,$on_time,$body,$service_type);
								 
							}							 
 
						} 
					}  
 
				 }   
			}   
		 
		}

	}

}

print_r(json_encode(array("customer_status"=>$customer_alert,"vendor_status"=>$vendor_alert,"status"=>$status)));
///  message_replace

function message_replace($vender_alert,$mobile,$longcode_number,$on_time)
{

$message='';
	$str=$vender_alert;
	// replace with coustomer number
	$str2=str_replace("<Customer Number>",$mobile,$str);
	// replace with Service number 
	$str3=str_replace("<Service Number>",$longcode_number,$str2);
	// replace with Service number 
	 $message=str_replace("<Sent Time>",$on_time,$str3);
 	$date=date('Y-m-d');  
	error_log($message,3,"longcode_log/longcode_$date.log");  
return $message;
}
	
// send sms 

function call_sms_api($username,$password,$message,$mobile,$sender_id,$messagetype) 
{

/*
	$api = "http://www.smsstriker.com/API/custom_missedcallsms_api.php?";
	$api .= "username=$username&";
	$api .= "password=$password&";
	$api .= "to=".$mobile."&";
	$api .= "msg=".urlencode($message)."&";
	$api .= "from=".$sender_id."&";
	$api .= "type=".$messagetype."&";
	
	$rs=file_get_contents($api);
 	$date=date('Y-m-d');  
	error_log($api,3,"longcode_log/longcode_$date.log");  

return $rs;   */
	return true; 
}


/** SMS LONGCODE URL API  **/

function longcode_api($connect_api_url,$phone_number,$service_numbers,$sms_time,$sms_text_param,$user_mobile,$dest,$on_time,$body,$service_type) { 
 
//http://localhost/requested.php,phnono,serviceno,senttime,sms_text,9701019800,8688388679,20-- ,KRISHR,dedicated
	 // return  $connect_api_url.','.$phone_number.','.$service_numbers.','.$sms_time.','.$sms_text_param.','.$user_mobile.','.$dest.','.$on_time.','.$body.','.$service_type;
	$api =$connect_api_url;  
	$api .=trim("?$phone_number=$user_mobile");
	$api .=trim("&$service_numbers=$dest");
	$api .=trim("&$sms_time=$on_time");  
	$api .=trim("&$sms_text_param=$body");    
 	$date=date('Y-m-d');  
  	//http://localhost/requested.php?phnono=9701019800&serviceno=8688388679&senttime=2017-02-03 &sms_text=KRISHR
 
	$rs = file_get_contents($api); 
	error_log($rs,3,"longcode_log/longcode_$date.log");  
	return $r;
 
}

function insert_sms_api($mysqli,$user_id,$mobile,$message,$on_time,$keyword_name,$sender_id,$longcode_number,
$smscinfo,$status,$service_type)
{

$vender_alert='';

$sql_insert="insert into longcode_smsmessages (service_number,message_from,status,message,message_time,user_id,sender_id,keyword,smscinfo,count,service_type) values ('$longcode_number','$mobile','$status','$message','$on_time',$user_id,'$sender_id','$keyword_name',
 '$smscinfo','$status','$service_type')";
 mysqli_query($mysqli,$sql_insert);
 
 	$date=date('Y-m-d');  
	error_log($sql_insert,3,"longcode_log/longcode_$date.log");
	
}


function balance_deduction($mysqli,$user_id,$longcode_price,$longcode_number)
{
	 $sql="select * from longcode_subscription  where user_id=$user_id and longcode_number=$longcode_number";
	 $result3=mysqli_query($mysqli,$sql);
	 if(mysqli_num_rows($result3)>0)
	 {
	  $longcode_subscription=mysqli_fetch_assoc($result3);
	  
	  $no_of_sms=$longcode_subscription['no_of_sms'];
	  $used_incoming_sms=$longcode_subscription['used_incoming_sms'];
	  $vailable_credits=$no_of_sms-$used_incoming_sms;
			if($vailable_credits>0)  // SMS deduction
			{
			$incoming_sms=1;
			$sql="update longcode_subscription set used_incoming_sms=used_incoming_sms+$incoming_sms where user_id=$user_id 
			and longcode_number=$longcode_number ";
			mysqli_query($mysqli,$sql);
			}
			else // Credit deduction
			{
				$sql="update users set longcode_credits=longcode_credits-$longcode_price where user_id=$user_id";
				mysqli_query($mysqli,$sql);
			}
			
	}
	
	

}

function getLongcode_price($mysqli,$user_id)
{
	// get longcode price from global table
	$sql2="select value from global_settings where setting_name='longcode'";
	$result2=mysqli_query($mysqli,$sql2);
	if(mysqli_num_rows($result2)>0)
	{
		$global_settings=mysqli_fetch_assoc($result2);
		foreach ($global_settings as $key=>$global_setting)
		{
			$longcodeprice=$global_setting;
		}
	}
	//$pgresponse=='Transaction Cancelled';
	$pgresponse='Transaction Successful';
	$sql="select up.price,up.service_tax_percent,pe.servicetype,up.transaction_id from user_payments up INNER JOIN 
	price_enquery pe on up.transaction_id=pe.epg_txnID
	where up.user_id=$user_id and pe.servicetype='longcode' order by up.payment_id desc limit 1";
	
	$result=mysqli_query($mysqli,$sql);
	
	if(mysqli_num_rows($result)>0)
	{
	    $user_payments=mysqli_fetch_assoc($result);
		foreach ($user_payments as $key=>$user_payment)
		{
			if($user_payment['price']==0 || $user_payment['price']=='' || $user_payment['price']=='NULL')
			{
				return $longcodeprice;
			}
			else
			{
			 return $user_payment['price'];
			}
			
			
		}
	
	}
	else
	{
	
		return $longcodeprice;
		
	}
}

?>

