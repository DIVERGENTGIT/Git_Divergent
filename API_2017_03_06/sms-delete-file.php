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


 if (!preg_match("~^(?:f|ht)tps?://~i", $_REQUEST['msg'])) {
        $http = "http:";
        $msg =str_replace(array('\\', $http.'/'), $http.'//', $_REQUEST['msg']); // output hello
       $https = "https:";
      $message =str_replace(array('\\', $https.'/'), $https.'//', $msg); // output hello
    }else{
    
   $message =$_REQUEST['msg'];
    }
    

$message=urldecode(urldecode(urldecode($message)));

/*
$date="USERNAME : ".$username ."to_mobiles :".$to_mobiles ."sender ".$from ."Msg ".$message;
$date= date('Y-m-d');
error_log($message."\r\n",3,"/var/www/vhosts/www.smsstriker.com/htdocs/api_log/apistriker_".$date.".log"); */


$message=str_replace("\'","'",$message);
$message=str_replace('\"','"',$message);
$message_length=strlen($message);
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

$rs=$mysqli->query("select user_id,available_credits,no_ndnc,template_check from users where username='$username' and password=md5('$password')");
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
		
 include("/var/www/vhosts/www.rkadvertisings.com/htdocs/smslib/config.inc");
    include("/var/www/vhosts/www.rkadvertisings.com/htdocs/smslib/functions.inc");

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
			
			}else
			{
			
            $message1=$mysqli->real_escape_string($message);

            //check is block listed number?
            $blockedNumberRes = $mysqli->query("SELECT count(*) FROM sms.block_listed_numbers WHERE mobile_no = '{$to}'");
            $blockedNumberRow = $blockedNumberRes->fetch_array();
            $is_block_listed = $blockedNumberRow[0];
            if($is_block_listed)
			{
			$query=	"insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no)
values('$user_id','$from','$message1','$no_of_messages','$to',now(),'2','Block Listed Number','$job_id','$sms_port')";	

$mysqli->query($query);
			}
                        //check for dnd number
$checkDndRes = $mysqli->query("SELECT count(*) FROM dnd_db.ndnc_data WHERE dnc_number = '{$to}'");
$checkDndRow = $checkDndRes->fetch_array();
                        if($checkDndRow[0]){
                            //$is_dnd_number = 1;
							
$query=	"insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,job_id,port_no)values('$user_id','$from','$message1','$no_of_messages','$to',now(),'3','$job_id','$sms_port')";					
$mysqli->query($query);

 }
                  
 else {
				
				
				$query="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,job_id,port_no)
								values('$user_id','$from','$message1','$no_of_messages','$to',now(),'$job_id','$sms_port')";
												
						$mysqli->query($query);
								$smsId = $mysqli->insert_id;
		
								$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=91$to&text=".urlencode($message);
										if($type=="0"){
											$URL .="&mclass=0";   
										}
								$URL .= "&dlr-mask=19&dlr-url=".urlencode(SERVER_NAME."apidlr.php?campaign_id=$smsId&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");
								http_send($URL,$sms_port);
								
				$balance = $available_credits - $no_of_messages;
				$mysqli->query("insert into user_credits_logs(before_campaign_credits,after_campaign_credits,current_campaign_credits,
				user_id,job_id) values('$available_credits','$balance','$no_of_messages','$user_id','$job_id')");	
								
								        $mysqli->query("update users set available_credits=available_credits-$no_of_messages where user_id='$user_id'");
							$available_credits=$available_credits-$no_of_messages; 
							
						
							




							}
							
							
					}
		
    

		
		}
	else 
		 { // nofunds
		 
		 $query="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,job_id,port_no)
                            values('$user_id','$from','$message1','$no_of_messages','$to',now(),'11','$job_id','$sms_port')";
                            
            $mysqli->query($query);
        }
	
		
    } //for
    echo "{Job Id: $job_id, Ack: Messages has been sent}";

		
		

$date= date('Y-m-d');
error_log($query."\r\n",3,"/var/www/vhosts/www.smsstriker.com/htdocs/api_log/apistriker_".$date.".log"); 	
		
		
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
        $sms_port = 28013;
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
			$sms_port ="28013";
		}
		
		if($user_id==2917)
		{
			$sender = $from;	
			$sms_port ="34013";
		}
		if($user_id==4456 )
		{
		$sender = $from;	
		$sms_port ="44013";
		}
		if($user_id==4330)
        {
			$sender = $from;	
			$sms_port ="27013";
		}
		if($user_id==4163)
        {
			$sender = $from;	
			$sms_port ="61013";
		}
		if($user_id==3846)                  //for challa manikanth & gupshup OTP root CHANGED TO 28013 ON 21JUL2016 BY SREENIVAS
        {
			$sender = $from;	
			$sms_port ="28013";
		}
                if($user_id==4119)                  //for SPRVTEC OTP ROOTING
        {
			$sender = $from;	
			$sms_port ="62013";
		}
if($user_id==4130)                  //for SPRVTEC OTP ROOTING
        {
			$sender = $from;	
			$sms_port ="28013";
		}
if($user_id==4131)                  //for SPRVTEC OTP ROOTING
        {
			$sender = $from;	
			$sms_port ="28013";
		}
	if($user_id==142)                  //for SPRVTEC OTP ROOTING
	{
	$sender = $from;	
	$sms_port ="28013";
	}
		//if($user_id==2846)    //for sagisoltrans root
		//{
			//$sender = $from;	
			//$sms_port ="28013";
		//}


	if($user_id==4497 || $user_id==4411) // NARAYANA AND ABHIBUS
		{
			$sender = $from;	
			$sms_port ="62013";
		}

    include("/var/www/vhosts/www.rkadvertisings.com/htdocs/smslib/config.inc");
    include("/var/www/vhosts/www.rkadvertisings.com/htdocs/smslib/functions.inc");

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
			
			}
			else
			{
			
            $message1=$mysqli->real_escape_string($message);

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
                    $checkDndRow = $checkDndRes->fetch_array();
                    $isDND = $checkDndRow[0];
                    if($isDND){
                    
                    $query="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,job_id,port_no)
                            values('$user_id','$from','$message1','$no_of_messages','$to',now(),'3','$job_id','$sms_port')";
                            
                        $mysqli->query($query);
                    } else {
                    
                    $query="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,job_id,port_no)
                            values('$user_id','$from','$message1','$no_of_messages','$to',now(),'$job_id','$sms_port')";
                            
                        $mysqli->query($query);
                        $smsId = $mysqli->insert_id;

                        $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=91$to&text=".urlencode($message);
                        if($type=="0"){
                            $URL .="&mclass=0";
                        }
                        $URL .= "&dlr-mask=19&dlr-url=".urlencode(SERVER_NAME."apidlr.php?campaign_id=$smsId&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");
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
                    $query="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,job_id,port_no)
                            values('$user_id','$from','$message1','$no_of_messages','$to',now(),'3','$job_id','$sms_port')";
                        $mysqli->query($query);
                    } else {
                    $query="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,job_id,port_no)
                        values('$user_id','$from','$message1','$no_of_messages','$to',now(),'$job_id','$sms_port')";
                        
                        $mysqli->query($query);
                        $smsId = $mysqli->insert_id;

                        $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=91$to&text=".urlencode($message);
                        if($type=="0"){
                            $URL .="&mclass=0";
                        }  
                        $URL .= "&dlr-mask=19&dlr-url=".urlencode(SERVER_NAME."apidlr_xml.php?campaign_id=$smsId&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");
                      http_send($URL,$sms_port);
                    }
                }
            }
            
          		  $balance = $available_credits - $no_of_messages;
				$mysqli->query("insert into user_credits_logs(before_campaign_credits,after_campaign_credits,current_campaign_credits,
				user_id,job_id) values('$available_credits','$balance','$no_of_messages','$user_id','$job_id')");
				
            $mysqli->query("update users set available_credits=available_credits-$no_of_messages where user_id='$user_id'");
            
            							$available_credits=$available_credits-$no_of_messages; 

		}
        
		}
		 else { // nofunds
		 
		 $query="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,job_id,port_no)
                            values('$user_id','$from','$message1','$no_of_messages','$to',now(),'11','$job_id','$sms_port')";
                            
                            
            $mysqli->query($query);
        }
		
    } //for
    echo "{Job Id: $job_id, Ack: Messages has been sent}";
    
$date= date('Y-m-d');
error_log($query."\r\n",3,"/var/www/vhosts/www.smsstriker.com/htdocs/api_log/apistriker_".$date.".log"); 
}

}
else { //user Authentication
    echo "Invalid User Details";

}
$mysqli->close();
?>
