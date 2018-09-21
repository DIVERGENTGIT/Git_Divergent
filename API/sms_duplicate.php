<?php 
include("dbconnect/config.php");  
$custom_parameter=NULL;
$db_link=NULL;
$temp_check=NULL;
$no_of_messages=0;
$no_of_messages_tmp=0;
$message_length=1;
//$r_username = isset($_REQUEST['r_username']) ? $_REQUEST['r_username'] : '';


$username=$_REQUEST['username'];
$password=$_REQUEST['password'];
$from=$_REQUEST['from'];
$to_mobiles=$_REQUEST['to'];
$type=$_REQUEST['type'];

$dnd_check = 0;   
$error = false;
$message1='';
if(isset($_REQUEST['dnd_check']) && $_REQUEST['dnd_check']){
    $dnd_check = $_REQUEST['dnd_check'];
}

//$custom_parameter=$_REQUEST['custom_parameter'];
//$dlr_url=trim($_REQUEST['dlr_url']);

$message=urldecode($_REQUEST['msg']);
$message=str_replace("\'","'",$message);
$message=str_replace('\"','"',$message);



$splMessage = strtolower(trim($message));
$special_char = array(',','.','-','!','&','’','_','#','(',')','<','>','%',':',';','.','?','*','+','-','/','&','∼','!','=',',','"','’','’');


$sms_text_spl = str_replace($special_char, ' ', $splMessage); 

$special_char_2 = array('{','}','[',']','^','|','€','~');
$sms_text_spl2 = str_replace($special_char_2, '  ', $sms_text_spl);
 
$message_length=strlen($sms_text_spl2);
if($message_length == 0){
    $message_length = 1;
}


// calculate SMS length
if($message_length>160)
	$no_of_messages_tmp=ceil($message_length/153);
else
	$no_of_messages_tmp=ceil($message_length/160);

$no_of_messages=$no_of_messages_tmp;  // changed on 26-12-2013 as per santosh request
//$no_of_messages=ceil($message_length/160);

$mm=explode(",",$to_mobiles);
/*
if(!$db_link)
{
    $db_link=mysql_connect("localhost","root","myadmin") or die(mysql_error());
}
else
{
    $db_link=mysql_pconnect("localhost","root","myadmin") or die(mysql_error());
}
mysql_select_db("sms",$db_link) or die(mysql_error()); */

$rs=$mysqli->query("select user_id,available_credits,no_ndnc,template_check from users where username='".$username."' and password='".md5($password)."'");
if($rs->num_rows > 0)
{
    $val=$rs->fetch_array();
    $user_id=$val[0];
    $available_credits = $val[1];
	$user_type=$val['no_ndnc'];
	$template_check=$val['template_check'];
	
	
	if($user_id==3843) // monster
	{
		
		//echo "Monster ID";
		
				
		
	 $sender = $from;
        $sms_port = 28013;
		
		  include("/var/www/html/strikerapp/smslib/config.inc");
    include("/var/www/html/strikerapp/smslib/functions.inc");

    //get job id
    $job_id_rs = $mysqli->query("
                INSERT INTO  sms_api_job_ids
                  SET user_id = '$user_id',
                    created_on = NOW()
            ");
    $job_id = $mysqli->insert_id;
    for($i=0;$i<count($mm);$i++) {
        $to=trim($mm[$i]);
       	 
		$error = FALSE;
		$isValidMobileNo=TRUE;
		
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
		
		
		
		if($no_of_messages<=$available_credits) 
		{
			if($error)
			{
				if(!$isValidMobileNo)
				{
					$mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no) values('$user_id','$from','$message','$no_of_messages','$to',now(),'16','Invalid Number','$job_id','$sms_port')");
				}else if(!$isValidSenderName)
				{
					$mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no) values('$user_id','$from','$message','$no_of_messages','$to',now(),'12','Not a valid Sender Name','$job_id','$sms_port')");
				} else if(!$isValidTemplate)
				{
					$mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no) values('$user_id','$from','$message','$no_of_messages','$to',now(),'13','Not a valid Template','$job_id','$sms_port')");
				}else if(!$send_api_sms)
				{
					$mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no)	values('$user_id','$from','$message1','$no_of_messages','$to',now(),'5', 'Vendor Specific Error: Please contact your provider','$job_id','$sms_port')");				
				}	
			
			}else
			{
			
            $message1=$mysqli->real_escape_string($message);

            //check is block listed number?
            $blockedNumberRes = $mysqli->query("SELECT count(*) as blocked FROM sms.block_listed_numbers WHERE user_id = '$user_id' AND   mobile_no = '{$to}'");
            $blockedNumberRow = $blockedNumberRes->fetch_array();
            $is_block_listed = $blockedNumberRow['blocked'];
            if($is_block_listed > 0)
			{
				
mysql_query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no)
values('$user_id','$from','$message1','$no_of_messages','$to',now(),'2','Block Listed Number','$job_id','$sms_port')");
			}
                        //check for dnd number
$checkDndRes = $mysqli->query("SELECT count(*) as dndcount FROM dnd_db.ndnc_data WHERE dnc_number = '{$to}'");
$checkDndRow = $checkDndRes->fetch_array();
                        if($checkDndRow['dndcount'] > 0){
                            //$is_dnd_number = 1;
							
								
$mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no)values('$user_id','$from','$message1','$no_of_messages','$to',now(),'3','DND Number','$job_id','$sms_port')");

 }
                  
 else {
	 
	 
$text1=$username.$message1.$from.$to;
$textmd5=md5($text1);
$checkContent = $mysqli->query("SELECT count(*) as duplicate FROM duplicatecheck_api WHERE md5text = '$textmd5'");
 $checkContentData = $checkContent->fetch_array();
  $is_duplicate = $checkContentData['duplicate'];
 
if($is_duplicate > 0){
	
	$error_text = "Duplicate Msg";
	  $mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no) values('$user_id','$from','$message1','$no_of_messages','$to',now(),'16','$error_text','$job_id','$sms_port')");
}else{
	 $text1=$username.$message1.$from.$to;
	$textmd5=md5($text1);
	$mysqli->query("INSERT INTO `duplicatecheck_api`(`md5text`, `datetime`) VALUES ('$textmd5',NOW())");
								
$mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,job_id,port_no)
								values('$user_id','$from','$message1','$no_of_messages','$to',now(),'$job_id','$sms_port')");
								$smsId = $mysqli->insert_id;
		
								$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=91$to&text=".urlencode($message);
										if($type=="0"){
											$URL .="&mclass=0";
										} 
								$URL .= "&dlr-mask=19&dlr-url=".urlencode(SERVER_NAME."apidlr.php?campaign_id=$smsId&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T&sms_port=$sms_port");
								http_send($URL,$sms_port);
								
								        $mysqli->query("update users set available_credits=available_credits-$no_of_messages where user_id='$user_id'");
										
							}
							
 }
							
							
					}
		
    

		
		}
	else 
		 { // nofunds
            $mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no)
                            values('$user_id','$from','$message1','$no_of_messages','$to',now(),'11','Insufficient Balance','$job_id','$sms_port')");
        }
	
		
    } //for
    echo "{Job Id: $job_id, Ack: Messages has been sent}";

		
		
		
		
		
		
	}else{
		
		// normal api users 
	
	
	
	
	if($user_type==1)
	{
		
		
		if($template_check)
		{
		$error = false;
		$isValidTemplate = true;
		//check for templates
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
		/*	echo "<br> -- original start <br>";
			print_r($txt_array1);  
			echo "<br> -- original end <br>";*/
			
			$templates_query = "SELECT template from templates where user_id='$user_id' and status='2' " ;
			$templates_rs = $mysqli->query($templates_query);
			//mysql_num_rows($templates_rs);
			if($templates_rs->num_rows > 0)
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

		
				/*echo "<br> -- from table start <br>";
				print_r($txt_array2);  
				echo "<br> ".count($txt_array2);
				echo "<br> -- from table  end <br>";
				*/
				
				$diff_array = array_diff($txt_array2, $txt_array1);

				
				/*
				echo "<br> -- difference start <br>";
				print_r($diff_array);  
				echo "<br> ".count($diff_array);
				echo "<br> -- difference  end <br>";*/
				
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
			//$temp_check=false;
			 
			  
			}
	
			if(!$temp_check){
				
				$error = true;
				$isValidTemplate = false;
				//echo $error_msg .= "SMS Text not matching with Approved Templates";
			}
		
		
		}
		
		
		
		$isValidSenderName=true;
		// checking sendernames
		$sender_names_query = "SELECT sender_name from sender_names where user_id='$user_id' and sender_name='".trim($from)."'" ;
		$sender_names_rs = $mysqli->query($sender_names_query);
		//mysql_num_rows($sender_names_rs);
		if($sender_names_rs->num_rows == 0)
		{
			$error = true;
			$isValidSenderName = false;
			//$error_msg .= "Invalid Sender Name ";
		}

	
	}




    //sender names
    if($val['no_ndnc'] == 1){  //Transactional SMPP
        //$sender = "LM-" . $from;
        //$sms_port = 15013;
        $sender = $from;
        $sms_port = 29013;
    } elseif($val['no_ndnc'] == 0){  //Promo SMPP
        
		/*$from = "0" . rand(16066,16075);
        $sender = "LM-" . $from;
		*/
        //$sms_port = 28013;
        $sender = $from;
        $sms_port = 38013;
    } elseif($val['no_ndnc'] == 2){ //solutions infini transactional
        $sender = $from;
        $sms_port = 20013;
    }
		//if($user_id==256)
		//{
			//up
		//	$sender = "0". rand(16066,16075);
		//	$sender_name = "LM-" . $sender;
			//$sender_name = $sender;
			
		//	$sender = $from;	
			//$sms_port ="39013";
		//}

		if($user_id==1395)
		{
			$sender = $from;	
			$sms_port ="28013";
		}
		if($user_id==3783)
		{
			$sender = $from;	
			$sms_port ="29013";
		}
		if($user_id==3843)
		{
			$sender = $from;	
			$sms_port ="31013";
		}
		if($user_id==2917)
		{
			$sender = $from;	
			$sms_port ="34013";
		}
		if($user_id==4036)
        {
			$sender = $from;	
			$sms_port ="19013";
		}
		//if($user_id==2846)    //for sagisoltrans root
		//{
			//$sender = $from;	
			//$sms_port ="28013";
		//}

    include("/var/www/html/strikerapp/smslib/config.inc");
    include("/var/www/html/strikerapp/smslib/functions.inc");

    //get job id
    $job_id_rs = $mysqli->query("
                INSERT INTO  sms_api_job_ids
                  SET user_id = '$user_id',
                    created_on = NOW()
            ");
    $job_id = $mysqli->insert_id;

    for($i=0;$i<count($mm);$i++) {
        $to=trim($mm[$i]);
       	 
		$error = FALSE;
		$isValidMobileNo=TRUE;
		
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
		
		
		
		if($no_of_messages<=$available_credits) 
		{
			if($error)
			{
				if(!$isValidMobileNo)
				{
					$mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no) values('$user_id','$from','$message','$no_of_messages','$to',now(),'16','Invalid Number','$job_id','$sms_port')");
				}else if(!$isValidSenderName)
				{
					$mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no) values('$user_id','$from','$message','$no_of_messages','$to',now(),'12','Not a valid Sender Name','$job_id','$sms_port')");
				} else if(!$isValidTemplate)
				{
					$mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no) values('$user_id','$from','$message','$no_of_messages','$to',now(),'13','Not a valid Template','$job_id','$sms_port')");
				}else if(!$send_api_sms)
				{
					$mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no)	values('$user_id','$from','$message1','$no_of_messages','$to',now(),'5', 'Vendor Specific Error: Please contact your provider','$job_id','$sms_port')");				
				}	
			
			}else
			{
			
            $message1=$mysqli->real_escape_string($message);

            //check is block listed number?
            $blockedNumberRes = $mysqli->query("SELECT count(*) as blocked FROM sms.block_listed_numbers WHERE user_id = '$user_id' AND   mobile_no = '{$to}'");
            $blockedNumberRow = $blockedNumberRes->fetch_array();
            $is_block_listed = $blockedNumberRow['blocked'];
            if($is_block_listed > 0){
                $mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no)
                        values('$user_id','$from','$message1','$no_of_messages','$to',now(),'2','Block Listed Number','$job_id','$sms_port')");
            } else {
                if(!$val['no_ndnc']){
                    //check for dnd number
                    $checkDndRes = $mysqli->query("SELECT count(*) as dndcount FROM dnd_db.ndnc_data WHERE dnc_number = '{$to}'");
                    $checkDndRow = $checkDndRes->fetch_array();
                    $isDND = $checkDndRow['dndcount'];
                    if($isDND > 0){
                       $mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no)
                            values('$user_id','$from','$message1','$no_of_messages','$to',now(),'3','DND Number','$job_id','$sms_port')");
                    } else {
						
							 
$text1=$username.$message1.$from.$to;
$textmd5=md5($text1);
$checkContent = $mysqli->query("SELECT count(*) as duplicate FROM duplicatecheck_api WHERE md5text = '$textmd5'");
 $checkContentData = $checkContent->fetch_array();
   $is_duplicate = $checkContentData['duplicate'];
 
if($is_duplicate > 0){
	
	$error_text = "Duplicate Msg";
	  $mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no) values('$user_id','$from','$message1','$no_of_messages','$to',now(),'16','$error_text','$job_id','$sms_port')");
}else{
	 $text1=$username.$message1.$from.$to;
	$textmd5=md5($text1);
	$mysqli->query("INSERT INTO `duplicatecheck_api`(`md5text`, `datetime`) VALUES ('$textmd5',NOW())");
                        $mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,job_id,port_no)
                            values('$user_id','$from','$message1','$no_of_messages','$to',now(),'$job_id','$sms_port')");
                        $smsId = $mysqli->insert_id;

                        $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=91$to&text=".urlencode($message);
                        if($type=="0"){
                            $URL .="&mclass=0";
                        }
                        $URL .= "&dlr-mask=19&dlr-url=".urlencode(SERVER_NAME."apidlr.php?campaign_id=$smsId&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T&sms_port=$sms_port");
                        http_send($URL,$sms_port);
                    }
					}
                } else {
                    $is_dnd_number = 0;
                    if($dnd_check){
                        //check for dnd number
                        $checkDndRes = $mysqli->query("SELECT count(*) as dndcount FROM dnd_db.ndnc_data WHERE dnc_number = '{$to}'");
                        $checkDndRow = $checkDndRes->fetch_array();
                        if($checkDndRow['dndcount'] > 0){
                            $is_dnd_number = 1;
                        }  
                    }

                    if($is_dnd_number){
                        $mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no)
                            values('$user_id','$from','$message1','$no_of_messages','$to',now(),'3','DND Number','$job_id','$sms_port')");
                    } else {
						
							 
$text1=$username.$message1.$from.$to;
$textmd5=md5($text1);
$checkContent = $mysqli->query("SELECT count(*) as duplicate FROM duplicatecheck_api WHERE md5text = '$textmd5'");
 $checkContentData = $checkContent->fetch_array();
  $is_duplicate = $checkContentData['duplicate'];
 
if($is_duplicate > 0){
	
	 $error_text = "Duplicate Msg";
	  $mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no) values('$user_id','$from','$message1','$no_of_messages','$to',now(),'16','$error_text','$job_id','$sms_port')");
}else{
	$text1=$username.$message1.$from.$to;
	$textmd5=md5($text1);
	$mysqli->query("INSERT INTO `duplicatecheck_api`(`md5text`, `datetime`) VALUES ('$textmd5',NOW())");
                        $mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,job_id,port_no)
                        values('$user_id','$from','$message1','$no_of_messages','$to',now(),'$job_id','$sms_port')");
                        $smsId = $mysqli->insert_id;

                        $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=91$to&text=".urlencode($message);
                        if($type=="0"){
                            $URL .="&mclass=0";
                        }
                        $URL .= "&dlr-mask=19&dlr-url=".urlencode(SERVER_NAME."apidlr.php?campaign_id=$smsId&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T&sms_port=$sms_port");
                        http_send($URL,$sms_port);
                   
					}
                }
            }
           $mysqli->query("update users set available_credits=available_credits-$no_of_messages where user_id='$user_id'");
			}
		}
        
		}
		 else { // nofunds
           $mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no)
                            values('$user_id','$from','$message1','$no_of_messages','$to',now(),'11','Insufficient Balance','$job_id','$sms_port')");
        }
		
    } //for
    echo "{Job Id: $job_id, Ack: Messages has been sent}";
}

}
else { //user Authentication
    echo "Invalid User Details";

}

$mysqli->close(); 
?>
