<?php
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

$message=str_replace("\'","'",$message);
$message=str_replace('\"','"',$message);
$message_length=strlen($message);
if($message_length == 0){
    $message_length = 1;
}


// calculate SMS length
if($message_length>70)
	$no_of_messages_tmp=ceil($message_length/63);
else
$no_of_messages_tmp=ceil($message_length/70);
$no_of_messages=$no_of_messages_tmp;  // changed on 26-12-2013 as per santosh request
$mm=explode(",",$to_mobiles);
if(!$db_link)
{
    //$db_link=mysql_connect("localhost","root","myadmin") or die(mysql_error());
    
    $db_link=mysql_connect("localhost","smsstrikerapp",'$tr!3r@2009') or die(mysql_error());
   
}
else
{
   // $db_link=mysql_pconnect("localhost","root","myadmin") or die(mysql_error());
     $db_link=mysql_connect("localhost","smsstrikerapp",'$tr!3r@2009') or die(mysql_error());
}
mysql_select_db("sms",$db_link) or die(mysql_error());

$rs=mysql_query("select user_id,available_credits,no_ndnc,dnd_check,template_check from users where username='$username' and password=md5('$password')");
if(mysql_num_rows($rs)>0)
{
	$val=mysql_fetch_array($rs);
	$user_id=$val[0];
	$available_credits = $val[1];
	$check_dnd=$val['dnd_check'];
	$user_type=$val['no_ndnc'];
	$template_check=$val['template_check'];

	
	if($user_type==1)
	{
		
		
		if($template_check)
		{
		$error = false;
		$isValidTemplate = true;

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
			$templates_rs = mysql_query($templates_query);
			mysql_num_rows($templates_rs);
			if(mysql_num_rows($templates_rs)>0)
			{  
				while ($row = mysql_fetch_array($templates_rs))
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
		
		
		
		$isValidSenderName=true;
		// checking sendernames
		$sender_names_query = "SELECT sender_name from sender_names where user_id='$user_id' and sender_name='".trim($from)."'" ;
		$sender_names_rs = mysql_query($sender_names_query);
		mysql_num_rows($sender_names_rs);
		if(mysql_num_rows($sender_names_rs)==0)
		{
			$error = true;
			$isValidSenderName = false;
			//$error_msg .= "Invalid Sender Name ";
		}

	
	}
	
	


    //sender names
    if($val['no_ndnc'] == 1){  //Transactional SMPP
        $sender = $from;
        $sms_port = 47213;
    } elseif($val['no_ndnc'] == 0){  //Promo SMPP
        
        $sender = $from;
        $sms_port = 49013;
    } elseif($val['no_ndnc'] == 2){ //solutions infini transactional
        $sender = $from;
        $sms_port = 20013;
    }
    
  if($val['dnd_check'] == 1 && $val['no_ndnc'] == 1){  // semi Transactional SMPP

        $sender = $from;
        $sms_port = 48113;
    }


		

  include("/var/www/html/strikerapp/smslib/config.inc");
   include("/var/www/html/strikerapp/smslib/functions.inc");

    //get job id
    if($scheduled_on){
  
      $createCampaign="INSERT INTO  sms_api_job_ids SET user_id = '$user_id',created_on = NOW(),is_scheduled =1,campaign_status=1,message='$message',noofmessages=$no_of_messages,scheduled_on='$scheduled_on',sender_name='$from' ";
  
    $job_id_rs = mysql_query($createCampaign);
    $job_id = mysql_insert_id();

    for($i=0;$i<count($mm);$i++) 
	{
        $to=trim($mm[$i]);
        if($no_of_messages<=$available_credits) 
		{
			$message1=mysql_real_escape_string(htmlentities($message, ENT_QUOTES, "UTF-8"));
			
            mysql_query("update users set available_credits=available_credits-$no_of_messages where user_id='$user_id'");
			  $insert_q="insert into schedule_api_campaigns_to SET job_id='$job_id',sms_text='$message1',to_mobile_no='$to',
			  sender_name='$from', is_unicode='1',created_on=now()";
			mysql_query($insert_q);
			
			

        } else { // nofunds
            mysql_query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,job_id,port_no)
                            values('$user_id','$from','$message1','$no_of_messages','$to',now(),'11','$job_id','$sms_port')");
        }
    } //for
    echo "{Job Id: $job_id, Ack: Messages has been sent}";    
    
    
    
    
    }else{
    
    $job_id_rs = mysql_query("
                INSERT INTO  sms_api_job_ids
                  SET user_id = '$user_id',
                    created_on = NOW()
            ");
    $job_id = mysql_insert_id();
   

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
		
						    $unicode_sms = "&coding=2&charset=utf-8&";
						       if($type){
						       $mclass = "&mclass=1"; // noraml sms
						       }else
						       {
						      $mclass = "&mclass=0"; // flash sms
						       }
						       
		
		if($no_of_messages<=$available_credits) 
		{
			if($error)
			{
				if(!$isValidMobileNo)
				{
				
				$query="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no) values('$user_id','$from','$message','$no_of_messages','$to',now(),'16','Invalid Number','$job_id','$sms_port')";
				
					mysql_query($query);
				}else if(!$isValidSenderName)
				{
				
				$query="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no) values('$user_id','$from','$message','$no_of_messages','$to',now(),'12','Not a valid Sender Name','$job_id','$sms_port')";
					mysql_query($query);
				} else if(!$isValidTemplate)
				{
				$query="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no) values('$user_id','$from','$message','$no_of_messages','$to',now(),'13','Not a valid Template','$job_id','$sms_port')";
				
					mysql_query($query);
				}else if(!$send_api_sms)
				{
				
				$query="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no)	values('$user_id','$from','$message1','$no_of_messages','$to',now(),'5', 'Vendor Specific Error: Please contact your provider','$job_id','$sms_port')";
				
					mysql_query($query);				
				}	
			$date= date('Y-m-d');
             //error_log($query."\r\n",3,"/var/www/vhosts/www.smsstriker.com/htdocs/api_log/striker_api_log/apistriker_".$date.".log");
			}
			else
			{
			
            $message1=mysql_real_escape_string($message);

            //check is block listed number?
            $blockedNumberRes = mysql_query("SELECT count(*) FROM sms.block_listed_numbers WHERE mobile_no = '{$to}'");
            $blockedNumberRow = mysql_fetch_array($blockedNumberRes);
            $is_block_listed = $blockedNumberRow[0];
            if($is_block_listed){
            
            $query="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no)
                        values('$user_id','$from','$message1','$no_of_messages','$to',now(),'2','Block Listed Number','$job_id','$sms_port')";
                        
                mysql_query($query);
            } else {
                if(!$val['no_ndnc']){
                    //check for dnd number
                    $checkDndRes = mysql_query("SELECT count(*) FROM dnd_db.ndnc_data WHERE dnc_number = '{$to}'");
                    $checkDndRow = mysql_fetch_array($checkDndRes);
                    $isDND = $checkDndRow[0];
                    if($isDND){
                    
                    $query="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,job_id,port_no)
                            values('$user_id','$from','$message1','$no_of_messages','$to',now(),'3','$job_id','$sms_port')";
                            
                        mysql_query($query);
                    } else {
                    
                    $query="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,job_id,port_no)
                            values('$user_id','$from','$message1','$no_of_messages','$to',now(),'$job_id','$sms_port')";
                            
                        mysql_query($query);
                        $smsId = mysql_insert_id();

                       $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)
										."&to=91$to&text=".urlencode($message);
										$URL .= "$unicode_sms$mclass&dlr-mask=19&dlr-url=".urlencode("http://www.strikersoft.in/API/DLRS/apidlr_xml.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");
										http_send($URL,$sms_port);
                    }
                } else {
                    $is_dnd_number = 0;
                    if($dnd_check){
                        //check for dnd number
                        $checkDndRes = mysql_query("SELECT count(*) FROM dnd_db.ndnc_data WHERE dnc_number = '{$to}'");
                        $checkDndRow = mysql_fetch_array($checkDndRes);
                        if($checkDndRow[0]){
                            $is_dnd_number = 1;
                        }
                    }

                    if($is_dnd_number){
                    $query="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,job_id,port_no)
                            values('$user_id','$from','$message1','$no_of_messages','$to',now(),'3','$job_id','$sms_port')";
                        mysql_query($query);
                    } else {
                    $query="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,job_id,port_no)
                        values('$user_id','$from','$message1','$no_of_messages','$to',now(),'$job_id','$sms_port')";
                        
                        mysql_query($query);
                        $smsId = mysql_insert_id();

                 
										$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)
										."&to=91$to&text=".urlencode($message);
										$URL .= "$unicode_sms$mclass&dlr-mask=19&dlr-url=".urlencode("http://www.strikersoft.in/API/DLRS/apidlr_xml.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");
										http_send($URL,$sms_port);
                    }
                }
            }
            
          		  $balance = $available_credits - $no_of_messages;
				mysql_query("insert into user_credits_logs(before_campaign_credits,after_campaign_credits,current_campaign_credits,
				user_id,job_id) values('$available_credits','$balance','$no_of_messages','$user_id','$job_id')");
				
            mysql_query("update users set available_credits=available_credits-$no_of_messages where user_id='$user_id'");
            
            							$available_credits=$available_credits-$no_of_messages; 

		}
        $date= date('Y-m-d');
//error_log($query."\r\n",3,"/var/www/vhosts/www.smsstriker.com/htdocs/api_log/striker_api_log/apistriker_".$date.".log");
		}
		 else { // nofunds
		 
		 $query="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,job_id,port_no)
                            values('$user_id','$from','$message1','$no_of_messages','$to',now(),'11','$job_id','$sms_port')";
                            
                            
            mysql_query($query);
            $date= date('Y-m-d');
//error_log($query."\r\n",3,"/var/www/vhosts/www.smsstriker.com/htdocs/api_log/striker_api_log/apistriker_".$date.".log"); 
        }
		
    } //for
    echo "{Job Id: $job_id, Ack: Messages has been sent}";
    

 } // normal api end

}
else { //user Authentication
    echo "Invalid User Details";

}
}else{
echo "invalid sender ID please use six characters sender ID";
}
mysql_close($db_link);
?>
