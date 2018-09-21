<?php 
include("../config/config.php");
$currentdate=date("Y-m-d");

if(isset($_GET['sender']))
{
	//print_r($_GET);
	$user_mobile = $_GET['sender'];   // customer mobile number
	$dest = $_GET['dest'];            // longcode number
	$body = urldecode($_GET['body']); 		   // message 
	$smscinfo = $_GET['smscinfo'];   // operator information
	//$date=$_GET['senttime'];
	$on_time=$_GET['senttime'];
	$datesplit=explode("/",$date);
	$day= $datesplit[0];  
	$month= $datesplit[1];
	$datesplit[2];
	$yearsplt=explode(" ",$datesplit[2]);
	$year=$yearsplt[0];
$year="20".$yearsplt[0];
 error_log(json_encode($_GET).$body."\n",3,"longcode_log/longcode_$currentdate.log");  
 //$on_time = $year."-".$month."-".$day." ".$yearsplt[1];
	 //$on_time = $day."-".$month."-".$year." ".$yearsplt[1];
//$date = str_replace('/', '-', $date); 
//$on_time=date('d-m-Y H.i.s', strtotime($date));
	$customer_alert='';
	$vendor_alert='';
	$keyword_name='';
	$service_type='';
	$sender_id='';
	$longcode_number=$dest;
      $service_type='';
      $result='Sent Failed';
      
      $match_count;
	$unmatch_count;
						
// step 1: check longcode number is expired or not

		$sql="select * from  longcode_subscription where  longcode_number='$dest' and 
		date(subscription_end) >= date('$currentdate') ";
		$getService_info = mysqli_query($link,$sql) or die("query error".mysqli_error());
		if(mysqli_num_rows($getService_info) > 0)
		{
		
			while($getService_info_res = mysqli_fetch_object($getService_info)) 
			{
			
			$service_type = $getService_info_res->service_type;  
			$user_id = $getService_info_res->user_id;
			$longcode_number = $getService_info_res->longcode_number;
			// get user information
			$sql3="select username,password,mobile,longcode_credits from users where user_id=$user_id";
			$result3=mysqli_query($link,$sql3);
			$user_info=mysqli_fetch_assoc($result3);
			//print_r($user_info);
			$username=$user_info['username'];
			$password=$user_info['password'];
			$longcode_credits=$user_info['longcode_credits'];
			$vendor_mobile=$user_info['mobile'];
			
// step 2: check longcode keyword is match or not   

			//echo $user_id;  
			
			$sql="select keyword,service_type,user_id,longcode_number from longcode_config where user_id = '".$user_id."' AND 
			longcode_number = '".$longcode_number."' AND status = 1 AND service_type='".$service_type."' ORDER BY longcode_id DESC";
			$getServiceKeywords = mysqli_query($link,$sql);  
			if(mysqli_num_rows($getServiceKeywords) > 0) 
			{
				while($getServiceKeywords_res = mysqli_fetch_object($getServiceKeywords)) 
				{
				//print_r($getServiceKeywords_res);
					$service_type = $getServiceKeywords_res->service_type;  
					$user_id = $getServiceKeywords_res->user_id;
					$longcode_number = $getServiceKeywords_res->longcode_number;
					$keyword_name = $getServiceKeywords_res->keyword;
			
					//echo $body;
				
					if(preg_match('~\b('.$keyword_name.')\b~', $body, $matches, PREG_OFFSET_CAPTURE))
					{
					
					$match_count++;

						$status="Keyword is Match";
						
						//echo $keyword_name;
						//echo $user_id;
						if($service_type=='dedicated' || $service_type=='shared' )
						{

						// step 3: Send Long Code SMS for Keyword is Match 			
						$result=send_longcode_sms($longcode_number,$user_id,$keyword_name,$service_type,$on_time,
						$body,$user_mobile,$smscinfo);

						}
						print_r(json_encode(array("Status"=>$status,"Result"=>$result,"Matchcount"=>$match_count))); 
						
						exit;

					}
					else
					{
					$unmatch_count++;
					$status="Keyword not Match";
					
							if($service_type=='dedicated' && $keyword_name=='N/A')
							{
							// step 4: Send Long Code SMS for Keyword not Match			
							$result=send_longcode_sms($longcode_number,$user_id,$keyword_name,$service_type,$on_time,
							$body,$user_mobile,$smscinfo);
							
							print_r(json_encode(array("Status"=>$status,"Result"=>$result,"UnMatchcount"=>$unmatch_count)));
							exit;
							
							}
						
						
					}
				}   
			}
			else
			{
				$status="Keyword not configured";
/***********************************  DIRECT USER MESSAGE START *****************************************/
	$sql_insert="insert into longcode_smsmessages (service_number,message_from,status,error_message,message,message_time,user_id,sender_id,keyword,smscinfo,service_type) values ('$longcode_number','$user_mobile','failed','$status','$body','$on_time',$user_id,'$sender_id','$keyword_name', '$smscinfo','$service_type')";
	mysqli_query($link,$sql_insert);
/***********************************   DIRECT USER MESSAGE START *****************************************/	
				
			}   


			}


		
		}
mysql_close($link);



}

print_r(json_encode(array("Status"=>$status,"Result"=>$result,"UnMatchcount"=>$unmatch_count)));

//print_r(json_encode(array("Status"=>$status,"Result"=>$result)));

// Send Longcode SMS
function send_longcode_sms($longcode_number,$user_id,$keyword_name,$service_type,$on_time,$body,$user_mobile,$smscinfo)
{

      $api = "https://www.smsstriker.com/API/send_longcode_sms.php?";
	$api .= "longcode_number=$longcode_number&";
	$api .= "user_mobile=".$user_mobile."&";
	$api .= "user_id=$user_id&";
	$api .= "keyword_name=".$keyword_name."&";
	$api .= "service_type=".$service_type."&";
	$api.="body=".urlencode($body)."&";
	$api .= "smscinfo=".$smscinfo."&";
	$api.="on_time=".urlencode($on_time);
	return $rs=file_get_contents($api);
}
?>


