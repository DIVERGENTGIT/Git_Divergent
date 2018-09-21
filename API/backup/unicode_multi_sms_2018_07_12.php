<?php 

include("dbconnect/config.php");  
include("/var/www/html/strikerapp/smslib/config.inc");
include("/var/www/html/strikerapp/smslib/functions.inc");

global $mysqli;
 
$custom_parameter=NULL;
$db_link=NULL;
$temp_check=NULL;
$no_of_messages=0;
$no_of_messages_tmp=0;
$message_length=1;
$username=$_REQUEST['username'];
$password=$_REQUEST['password'];
$scheduled_date=$_REQUEST['scheduled_date'];
$scheduled_time=$_REQUEST['scheduled_time'];
if(isset($scheduled_date) && isset($scheduled_time) ){
	$scheduled_on=$scheduled_date.' '.$scheduled_time;
}

if(strlen($_REQUEST['from'])==6)
{
	$from=$_REQUEST['from']; 
	$type=$_REQUEST['type'];

	$dnd_check = 0; 
	if(isset($_REQUEST['dnd_check']) && $_REQUEST['dnd_check']) {
	    $dnd_check = $_REQUEST['dnd_check'];
	}

	$mno_msg=$_REQUEST['mno_msg'];
	$mm = explode('~',$mno_msg);

	$to = $message = '';

	$rs = $mysqli->query("select user_id,available_credits,no_ndnc,dnd_check,template_check from users where username='$username' and password=md5('$password')");
	if($rs->num_rows > 0)
	{
		$val= $rs->fetch_array();
		$user_id=$val[0];
		$available_credits = $val[1];
		$dnd_check=$val['dnd_check'];
		$user_type=$val['no_ndnc'];
		$template_check=$val['template_check'];
			
			
			///sender names
		 if($val['no_ndnc'] == 1 && $val['dnd_check'] == 0){  //Transactional SMPP
				//$sender = "LM-" . $from;
				//$sms_port = 15013;
				$sender = $from;$portTypeNAS='NAST2';
				$port_type="LT2";
			} elseif($val['no_ndnc'] == 0){  //Promo SMPP

				 
				//$sms_port = 27013;
				$sender = $from;
				$port_type="LP2"; $portTypeNAS= 'NASP2';	
			} else if($val['dnd_check'] == 1 && $val['no_ndnc'] == 1){  // semi Transactional SMPP

				$sender = $from;
				$port_type="LS2"; $portTypeNAS= 'NASP2';	
			}

			$port = $mysqli->query("select sending_port_no from sms_queue where application_priority='$port_type' order by queued asc limit 1");    
			$portarr=$port->fetch_array();
			$sms_port=$portarr['sending_port_no'];  


    if($val['no_ndnc'] == 1) {
 $checkSenderName = $mysqli->query("SELECT * FROM sender_names WHERE user_id = '".$user_id."' AND sender_name = '".trim($from)."' AND status = 1 ");

    if($checkSenderName->num_rows == 0) {  
	$getNASPortNumber = $mysqli->query("SELECT sending_port_no FROM sms_queue WHERE application_priority = '$portTypeNAS'");
    		if($getNASPortNumber->num_rows > 0) {
    			$getNASPortNumberRes = $getNASPortNumber->fetch_array();
    			$sms_port = $getNASPortNumberRes['sending_port_no'];
    		}   
    }  
	}	   
	
    
       
 $senderName_kennel = $from;
 if($sms_port > 0) {
 	$getPortType = $mysqli->query("SELECT sending_port_no FROM sms_queue where sending_port_no = '".$sms_port."' AND used_for = 'BSNL' "); 
 	if($getPortType->num_rows > 0)  
	{  
	 	if($val['no_ndnc'] == 0) { 
		    	$senderName_kennel = "BA-611128";
		    }else{
	 		$senderName_kennel = "BA-".$from;
	 	    } 
 	}  
 
 } 
		$job_id_rs = $mysqli->query("
					INSERT INTO  sms_api_job_ids
					  SET user_id = '$user_id',
					    created_on = NOW()
				    ");
			    $job_id = $mysqli->insert_id; 
		
		 
		for($i=0;$i<count($mm);$i++) {

			$params = explode('^',$mm[$i]);
			$to = trim($params[0]);
			$message = trim($params[1]); 

		 	$error = FALSE;
			$isValidMobileNo=TRUE;$isValidSenderName=TRUE;

			if(!preg_match("~^(?:f|ht)tps?://~i", $message)) {
				$http = "http:";
				$message = str_replace(array('\\', $http.'/'), $http.'//', $message); // output hello
				$https = "https:"; 
				$message =str_replace(array('\\', $https.'/'), $https.'//', $message); // output hello
			} 
			    

			$message=urldecode(urldecode(urldecode($message)));

			$message=str_replace("\'","'",$message);
			$message=str_replace('\"','"',$message);

			$message=trim($message);

			$splMessage = strtolower(trim($message));
			$special_char = array(',','.','-','!','&','’','_','#','(',')','<','>','%',':',';','.','?','*','+','-','/','&','∼','!','=',',','"','’','’');


			$sms_text_spl = str_replace($special_char, ' ', $splMessage); 

			$special_char_2 = array('{','}','[',']','^','|','€','~');
			$sms_text_spl2 = str_replace($special_char_2, '  ', $sms_text_spl);


			$message_length=mb_strlen($sms_text_spl2);
			if($message_length == 0){
			    $message_length = 1;
			}


			// calculate SMS length
			if($message_length>70)
				$no_of_messages_tmp = ceil($message_length/63);
			else
			$no_of_messages_tmp = ceil($message_length/70);

			$no_of_messages = $no_of_messages_tmp;  // changed on 26-12-2013 as per santosh request 


			if($user_type == 1)
			{

		
				if($template_check)
				{
				 

					//lower case
				$sms_text = strtolower($message);
	
					//remove special characters
					$special_char = array(',','.','-','!','&');
					$sms_text = str_replace($special_char, ' ', $sms_text);
					$sms_text_array = explode(" ", $sms_text);
					$txt_array1 = array();
					for($i = 0; $i < count($sms_text_array); $i++){
						$txt1 = trim($sms_text_array[$i]);
						if(strlen($txt1) > 0){
							$txt_array1[] = $txt1;
						}
					   }
	
					$templates_query = "SELECT template from templates where user_id='$user_id' and status='2' " ;
					$templates_rs = $mysqli->query($templates_query);
		 
					if($templates_rs->num_rows>0)
					{  
						while ($row = $templates_rs->fetch_array())
						{
						$temp = strtolower($row['template']);
						$txt2 = str_replace($special_char, ' ', $temp);
						$sms_template = str_replace('xxxx','', $txt2);
						$sms_template_array = explode(" ", $sms_template);
	
						$txt_array2 = array();
						for($i = 0; $i < count($sms_template_array); $i++){
							$txt3 = trim($sms_template_array[$i]);
							if(strlen($txt3) > 0){
								$txt_array2[] = $txt3;
							}
						}
				
						$diff_array = array_diff($txt_array2, $txt_array1);
						
						$text_array2_count = count($txt_array2);
						$diff_array_count = count($diff_array);
						
						 $diff_percentage = ($diff_array_count/$text_array2_count)*100;
	
						if($diff_percentage <= 40)
						{
							$temp_check=true;
						}
						else 
						{
							$temp_check=false;
						}
					}

					 
					  
					}
	
					if(!$temp_check){
				
						$error = true;
						$isValidTemplate = false;
					}
		
		
				} 
				// checking sendernames
				$sender_names_query = "SELECT sender_name from sender_names where user_id='$user_id' and sender_name='".trim($from)."'" ;
				$sender_names_rs = $mysqli->query($sender_names_query);
		 
				if($sender_names_rs->num_rows==0)
				{
					$error = true;
					$isValidSenderName = false;
					//$error_msg .= "Invalid Sender Name ";
				}

	
			}
 

			if($scheduled_on){

				/*$createCampaign="INSERT INTO  sms_api_job_ids SET user_id = '$user_id',created_on = NOW(),is_scheduled =1,campaign_status=1,message='$message',noofmessages=$no_of_messages,scheduled_on='$scheduled_on',sender_name='$from' ";

				$job_id_rs = $mysqli->query($createCampaign);
				$job_id = $mysqli->insert_id;*/
				
				   $request = json_encode($_REQUEST['mno_msg']);    
     
     error_log("\n".date('Y-m-d H:i:s')."| Request for jobID - $job_id | ".$request."\r\n",3,"/var/www/html/strikerapp/api_log/striker_api_log/api_logs/striker_API_".$user_id.".log"); 
     
     

				//for($i=0;$i<count($mm);$i++) 
				//{
 
					if($no_of_messages<=$available_credits) 
					{
						if($to > 0) {  
						$message1=$mysqli->real_escape_string(htmlentities($message, ENT_QUOTES, "UTF-8"));

						$mysqli->query("update users set available_credits=available_credits-$no_of_messages where user_id='$user_id'");
						$insert_q="insert into schedule_api_campaigns_to SET job_id='$job_id',sms_text='$message1',to_mobile_no='$to',
						sender_name='$from', is_unicode='1',created_on=now()";
						$mysqli->query($insert_q);
						}
  

					} else { // nofunds
						$mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,job_id,port_no)
						values('$user_id','$from','$message1','$no_of_messages','$to',now(),'11','$job_id','$sms_port')");
					}
				//} //for
				echo "{Job Id: $job_id, Ack: Messages has been sent}";  
			}else{
		      
			   /* $job_id_rs = $mysqli->query("
					INSERT INTO  sms_api_job_ids
					  SET user_id = '$user_id',
					    created_on = NOW()
				    ");
			    $job_id = $mysqli->insert_id; */
			    
			       $request = json_encode($_REQUEST['mno_msg']);    
     
     error_log("\n".date('Y-m-d H:i:s')."| Request for jobID - $job_id | ".$request."\r\n",3,"/var/www/html/strikerapp/api_log/striker_api_log/api_logs/striker_API_".$user_id.".log"); 
     
     
     
     
     
			
	
		 if(!is_numeric($to) || empty($to)) {
 			$to = 0;  
 		}
 		
				$numberlength=strlen($to);
				if($numberlength==12)
					$to=substr($to,2);
				if($numberlength==11)
					$to=substr($to,1);
				if($numberlength==10)
					$to=$to;
		
				if(strlen($to) != 10) 
				{
					//echo "invalid no:".$to;
					$invalid_nos_count++;	
					$error = TRUE;
					$isValidMobileNo=FALSE;
					$error_msg .= "Invalid Number";
			
				}	
		
				$unicode_sms = "&coding=2&charset=utf-8&";
				if($type){
					$mclass = "&mclass=1"; // noraml sms
				}else
				{
					$mclass = "&mclass=0"; // flash sms
				}
								       
					
				if($no_of_messages <= $available_credits) 
				{
				
					if($to > 0) {
						$mysqli->query("update users set available_credits=available_credits-$no_of_messages where user_id='$user_id'");
					}
					
					if($error)
					{
						if(!$isValidMobileNo)
						{
				
							$query="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no) values('$user_id','$from','$message','$no_of_messages','$to',now(),'16','Invalid Number','$job_id','$sms_port')";
				
							$mysqli->query($query);
						}else if(!$isValidSenderName)
						{
				
							$query="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no) values('$user_id','$from','$message','$no_of_messages','$to',now(),'12','Not a valid Sender Name','$job_id','$sms_port')";
							$mysqli->query($query);
						} else if(!$isValidTemplate)
						{
							$query="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no) values('$user_id','$from','$message','$no_of_messages','$to',now(),'13','Not a valid Template','$job_id','$sms_port')";
				
							$mysqli->query($query);
						}else if(!$send_api_sms)
						{
				
							$query="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no)	values('$user_id','$from','$message1','$no_of_messages','$to',now(),'5', 'Vendor Specific Error: Please contact your provider','$job_id','$sms_port')";
				
							$mysqli->query($query);				
						}	
						$date= date('Y-m-d');
			     			//error_log($query."\r\n",3,"/var/www/vhosts/www.smsstriker.com/htdocs/api_log/striker_api_log/apistriker_".$date.".log");
					}
					else
					{
			
						$message1 = $mysqli->real_escape_string($message);

						//check is block listed number?
						$blockedNumberRes = $mysqli->query("SELECT count(*) FROM sms.block_listed_numbers WHERE mobile_no = '{$to}'");
						$blockedNumberRow = $blockedNumberRes->fetch_array();
						$is_block_listed = $blockedNumberRow[0];
						if($is_block_listed){

							$query="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no)
							values('$user_id','$from','$message1','$no_of_messages','$to',now(),'2','Block Listed Number','$job_id','$sms_port')";

							$mysqli->query($query);
			   			 } else {
 
							if(!$val['no_ndnc']){
								//check for dnd number
								$checkDndRes = $mysqli->query("SELECT count(*) FROM dnd_db.ndnc_data WHERE dnc_number = '{$to}'");
								$checkDndRow =  $checkDndRes->fetch_array();
								$isDND = $checkDndRow[0];
								if($isDND){

									$query="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no)
									values('$user_id','$from','$message1','$no_of_messages','$to',now(),'3','DND Number','$job_id','$sms_port')";

									$mysqli->query($query);
								} else {

									$query="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,job_id,port_no)
									values('$user_id','$from','$message1','$no_of_messages','$to',now(),'$job_id','$sms_port')";
									$mysqli->query($query);
									$smsId = $mysqli->insert_id;
    
									$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($senderName_kennel)
									."&to=91$to&text=".urlencode($message);
									$URL .= "$unicode_sms$mclass&dlr-mask=19&dlr-url=".urlencode(SERVER_NAME."apidlr_xml.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T&sms_port=$sms_port");
									http_send($URL,$sms_port);
								}
							} else {
								$is_dnd_number = 0;

								if($dnd_check){
									//check for dnd number
									$checkDndRes = $mysqli->query("SELECT count(*) FROM dnd_db.ndnc_data WHERE dnc_number = '{$to}'");
									$checkDndRow = $checkDndRes->fetch_array();
									if($checkDndRow[0]){
										$is_dnd_number = 1;
									}
								}
 
								if($is_dnd_number){
									$query="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no)
									values('$user_id','$from','$message1','$no_of_messages','$to',now(),'3','DND Number','$job_id','$sms_port')";
									$mysqli->query($query);
								} else {

									$query="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,job_id,port_no)
									values('$user_id','$from','$message1','$no_of_messages','$to',now(),'$job_id','$sms_port')";

									$mysqli->query($query);
									$smsId = $mysqli->insert_id;

  
									$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($senderName_kennel)
									."&to=91$to&text=".urlencode($message);
									$URL .= "$unicode_sms$mclass&dlr-mask=19&dlr-url=".urlencode(SERVER_NAME."apidlr_xml.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T&sms_port=$sms_port");
									http_send($URL,$sms_port);
								}
							}
						}  
  
						//$balance = $available_credits - $no_of_messages;
						//$mysqli->query("insert into user_credits_log(before_campaign_credits,after_campaign_credits,current_campaign_credits, user_id,job_id) values('$available_credits','$balance','$no_of_messages','$user_id','$job_id')");

						//$mysqli->query("update users set available_credits=available_credits-$no_of_messages where user_id='$user_id'"); 

						//$available_credits=$available_credits-$no_of_messages; 



					}
					$date= date('Y-m-d');
					//error_log($query."\r\n",3,"/var/www/vhosts/www.smsstriker.com/htdocs/api_log/striker_api_log/apistriker_".$date.".log");

				}
				else { // nofunds

					$query="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no)
					values('$user_id','$from','$message1','$no_of_messages','$to',now(),'11','Insufficient Credits','$job_id','$sms_port')";


					$mysqli->query($query);
					$date= date('Y-m-d');
					//error_log($query."\r\n",3,"/var/www/vhosts/www.smsstriker.com/htdocs/api_log/striker_api_log/apistriker_".$date.".log"); 
				} 
		 	} 
	     	}
		echo json_encode(array('Job Id' => $job_id, 'Ack' =>  'Messages has been sent'));
	}else {  
    		echo "Invalid User Details"; 
	}
}else{
	echo "invalid sender ID please use six characters sender ID";
}
 

?>




 
