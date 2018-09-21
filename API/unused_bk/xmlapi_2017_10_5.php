<?php 
include("dbconnect/config.php");  

$custom_parameter=NULL;
$db_link=NULL;
$temp_check=NULL;
$no_of_messages=0;
$no_of_messages_tmp=0;
$message_length=1;

$date123 = date('Y-m-d');
/*
$string= $_SERVER['QUERY_STRING'];
$data=explode('data=',$string);
$xmlcontent= $data[1];
*/

 $xmlcontent= $_REQUEST['data'];
$xmlfile=htmlspecialchars(urldecode($xmlcontent));

 
$data = html_entity_decode($xmlfile);
date_default_timezone_set("Asia/Kolkata");
$date= "Created date is " . date('Y-m-d h:i:sa');
error_log($data.$date."\r\n",3,"/var/www/html/strikerapp/api_log/xml-api.log");
 $data = str_replace('&', '&amp;', $data);
$xml=simplexml_load_string($data);
$arr = json_decode(json_encode($xml) , 1);

$type=$_REQUEST['type'];

$dnd_check = 0;
$error = false;

if(isset($_REQUEST['dnd_check']) && $_REQUEST['dnd_check']){
    $dnd_check = $_REQUEST['dnd_check'];
}


 $username=$arr['USER']['@attributes']['USERNAME'];
 $password=$arr['USER']['@attributes']['PASSWORD'];
/*
if(!$db_link)
{
    $db_link=mysql_connect("localhost","root","myadmin") or die(mysql_error());
}
else
{
    $db_link=mysql_pconnect("localhost","root","myadmin") or die(mysql_error());
}
*/
$cnt=count($arr['SMS']);
$kc=1;
$a=$arr['SMS'];
$username=$arr['USER']['@attributes']['USERNAME'];
 $password=$arr['USER']['@attributes']['PASSWORD'];
if (array_key_exists("ADDRESS",$a)) // single messages
   {
 
 

$dnd_check = 0;
$error = false;

if(isset($_REQUEST['dnd_check']) && $_REQUESTUSERNAME['dnd_check']){
    $dnd_check = $_REQUEST['dnd_check'];
}





 /*$username=$arr['USER']['@attributes']['USERNAME'];
 $password=$arr['USER']['@attributes']['PASSWORD'];
*/
 $message= $arr['SMS']['@attributes']['TEXT'];
 $from= $arr['SMS']['ADDRESS']['@attributes']['FROM'];
$message=trim($message);
 $to= $arr['SMS']['ADDRESS']['@attributes']['TO'];
 
   $message=str_replace("\'","'",$message);



$message=str_replace('\"','"',$message);
$message=trim($message);

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


$message1 = $message;
$message = $mysqli->real_escape_string($message);
$no_of_messages=$no_of_messages_tmp;  // changed on 26-12-2013 as per santosh request
//$no_of_messages=ceil($message_length/160);

$mm=explode(",",$to);
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
	if($user_type==1)
	{
	
		
		
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



$sender = $from;

if($user_id==4139 || $user_id==4131) //Narayana and manikanth challa ,TSRTC
{


if(trim($sender)=='TSRTCO'){
//$sms_port =47213;

$sms_port=46413;
}else{
//$sms_port =47213;
$sms_port=46413;

}
}elseif($user_id==4130 || $user_id==5020){ // APSRTC
$sms_port =46213;
// $sms_port =46413;

}else{ 
$sms_port =47213;
}




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
					$mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no)	values('$user_id','$from','$message','$no_of_messages','$to',now(),'5', 'Vendor Specific Error: Please contact your provider','$job_id','$sms_port')");				
				}	
			
			}else
			{
			

            //check is block listed number?
            $blockedNumberRes = $mysqli->query("SELECT count(*) as blocked FROM sms.block_listed_numbers WHERE user_id = '$user_id' AND mobile_no = '{$to}'");
            $blockedNumberRow = $blockedNumberRes->fetch_array();
            $is_block_listed = $blockedNumberRow['blocked'];
            if($is_block_listed > 0){
               $mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no)
                        values('$user_id','$from','$message','$no_of_messages','$to',now(),'2','Block Listed Number','$job_id','$sms_port')");
            
			}else {
					
                if(!$val['no_ndnc']){
                    //check for dnd number
				
                    $checkDndRes = $mysqli->query("SELECT count(*) FROM dnd_db.ndnc_data WHERE dnc_number = '{$to}'");
                    $checkDndRow = $checkDndRes->fetch_array();
                    $isDND = $checkDndRow[0];
                    if($isDND){
                        $mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no)
                            values('$user_id','$from','$message','$no_of_messages','$to',now(),'3','DND Number','$job_id','$sms_port')");
                    } else {
						
						
			$logFile = "insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,job_id,port_no)
                            values('$user_id','$from','$message','$no_of_messages','$to',now(),'$job_id','$sms_port')";		
                        $mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,job_id,port_no)
                            values('$user_id','$from','$message','$no_of_messages','$to',now(),'$job_id','$sms_port')");
                        $smsId = $mysqli->insert_id;

                        error_log($logFile."\r\n",3,"/var/www/html/strikerapp/api_log/xml-api_$date123.log");
                        $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=91$to&text=".urlencode($message1);
                        if($type=="0"){
                            $URL .="&mclass=0";
                        }
                        
$URL .= "&dlr-mask=19&dlr-url=".urlencode(SERVER_NAME."/apidlr_xml.php?campaign_id=$smsId&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");
http_send($URL,$sms_port);
 
                    }
                } else {
                    $is_dnd_number = 0;
                    if($dnd_check){
                        //check for dnd number
                        $checkDndRes = $mysqli->query("SELECT count(*) FROM dnd_db.ndnc_data WHERE dnc_number = '{$to}'");
                        $checkDndRow =$checkDndRes->fetch_array();
                        if($checkDndRow[0]){
                            $is_dnd_number = 1;
                        }
                    }

                    if($is_dnd_number){
                        $mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,job_id,port_no)
                            values('$user_id','$from','$message','$no_of_messages','$to',now(),'3','DND Number','$job_id','$sms_port')");
                    } else {
				
				$logFile = "insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,job_id,port_no)
                        values('$user_id','$from','$message','$no_of_messages','$to',now(),'$job_id','$sms_port')";		
                        $mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,job_id,port_no)
                        values('$user_id','$from','$message','$no_of_messages','$to',now(),'$job_id','$sms_port')");
                        $smsId = $mysqli->insert_id;
                        error_log($logFile."\r\n",3,"/var/www/html/strikerapp/api_log/xml-api_$date123.log");

$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=91$to&text=".urlencode($message1);
                        if($type=="0"){
                            $URL .="&mclass=0";
                        }
                     								$URL .= "&dlr-mask=19&dlr-url=".urlencode(SERVER_NAME."/apidlr_xml.php?campaign_id=$smsId&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");

                        http_send($URL,$sms_port);
                    }  
                }
            }
            
              $balance = $available_credits - $no_of_messages;
		//$mysqli->query("insert into user_credits_log(before_campaign_credits,after_campaign_credits,current_campaign_credits,user_id,job_id) values('$available_credits','$balance','$no_of_messages','$user_id','$job_id')");
            $mysqli->query("update users set available_credits=available_credits-$no_of_messages where user_id='$user_id'");
            
             $available_credits=$available_credits-$no_of_messages; 

		}
        
		} else { // nofunds
            $mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no)
                            values('$user_id','$from','$message','$no_of_messages','$to',now(),'11','Insufficient Balance','$job_id','$sms_port')");
        }
    } //for
    echo "{Job Id: $job_id, Ack: Messages has been sent}";
} else { //user Authentication
    echo "Invalid User Details";
}

 
 

   }
else
   {
	   
	 /******************* multiple msgs and multiple numbers ******************************/
	


//mysql_select_db("sms",$db_link) or die(mysql_error());
$rs=$mysqli->query("select user_id,available_credits,no_ndnc,template_check from users where username='".$username."' and password='".md5($password)."'");
if($rs->num_rows > 0)
{
    $val=$rs->fetch_array();
    $user_id=$val[0];
    $available_credits = $val[1];
	$user_type=$val['no_ndnc'];
	$template_check=$val['template_check'];
	

if($user_id==4139 || $user_id==4131)
{

if($sender=='TSRTCO'){
$sms_port=46413;
//$sms_port =47213;

}else{
$sms_port =46413;
//$sms_port =47213;


}
}elseif($user_id==4130){
$sms_port =46213;
//$sms_port =47213;
//$sms_port =46413;

}else{
//$sms_port ="47313";
$sms_port =47213;

}


    include("/var/www/html/strikerapp/smslib/config.inc");
    include("/var/www/html/strikerapp/smslib/functions.inc");

    //get job id
    $job_id_rs = $mysqli->query("
                INSERT INTO  sms_api_job_ids
                  SET user_id = '$user_id',
                    created_on = NOW()
            ");
    $job_id = $mysqli->insert_id;

   for($i=0;$i<$cnt;$i++){
	   
   $message= $arr['SMS'][$i]['@attributes']['TEXT'];
	 $from=($arr['SMS'][$i]['ADDRESS']['@attributes']['FROM']!="")?$arr['SMS'][$i]['ADDRESS']['@attributes']['FROM']:$arr['SMS'][$i][0]['@attributes']['FROM'];
	 $to=  ($arr['SMS'][$i]['ADDRESS']['@attributes']['TO']!="")?$arr['SMS'][$i]['ADDRESS']['@attributes']['TO']:$arr['SMS'][$i][0]['@attributes']['TO'];


 $message=trim($message);
   $message=str_replace("\'","'",$message);



$message=str_replace('\"','"',$message);
$message=trim($message);


$splMessage = strtolower(trim($message));
$special_char = array(',','.','-','!','&','’','_','#','(',')','<','>','%',':',';','.','?','*','+','-','/','&','∼','!','=',',','"','’','’');


$sms_text_spl = str_replace($special_char, ' ', $splMessage); 

$special_char_2 = array('{','}','[',']','^','|','€');
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
$message1 = $message;
$message = $mysqli->real_escape_string($message);
$no_of_messages=$no_of_messages_tmp;  // changed on 26-12-2013 as per santosh request
//$no_of_messages=ceil($message_length/160);

       	 
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
					$mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no)	values('$user_id','$from','$message','$no_of_messages','$to',now(),'5', 'Vendor Specific Error: Please contact your provider','$job_id','$sms_port')");				
				}	
			
			}else
			{
			

            //check is block listed number?
            $blockedNumberRes = $mysqli->query("SELECT count(*) as blocked FROM sms.block_listed_numbers WHERE user_id = '$user_id' AND mobile_no = '{$to}'");
            $blockedNumberRow =$blockedNumberRes->fetch_array();
            $is_block_listed = $blockedNumberRow['blocked'];
            if($is_block_listed > 0){
                $mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no)
                        values('$user_id','$from','$message','$no_of_messages','$to',now(),'2','Block Listed Number','$job_id','$sms_port')");
            
			}else {
					
                if(!$val['no_ndnc']){
                    //check for dnd number
				
                    $checkDndRes = $mysqli->query("SELECT count(*) FROM dnd_db.ndnc_data WHERE dnc_number = '{$to}'");
                    $checkDndRow = $checkDndRes->fetch_array();
                    $isDND = $checkDndRow[0];
                    if($isDND){
                        $mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,job_id,port_no)
                            values('$user_id','$from','$message','$no_of_messages','$to',now(),'3','$job_id','$sms_port')");
                    } else {
				$logFile = "insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,job_id,port_no)
                            values('$user_id','$from','$message','$no_of_messages','$to',now(),'$job_id','$sms_port')";	
                        $mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,job_id,port_no)
                            values('$user_id','$from','$message','$no_of_messages','$to',now(),'$job_id','$sms_port')");
                        $smsId = $mysqli->insert_id;
                        error_log($logFile."\r\n",3,"/var/www/html/strikerapp/api_log/xml-api_$date123.log");
                        $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($from)."&to=91$to&text=".urlencode($message1);
                        if($type=="0"){
                            $URL .="&mclass=0";
                        }
$URL .= "&dlr-mask=19&dlr-url=".urlencode(SERVER_NAME."/apidlr_xml.php?campaign_id=$smsId&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");

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
                        $mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,job_id,port_no)
                            values('$user_id','$from','$message','$no_of_messages','$to',now(),'3','$job_id','$sms_port')");
                    } else {
			$logFile = "insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,job_id,port_no)
                        values('$user_id','$from','$message','$no_of_messages','$to',now(),'$job_id','$sms_port')";			
                        $mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,job_id,port_no)
                        values('$user_id','$from','$message','$no_of_messages','$to',now(),'$job_id','$sms_port')");
                        $smsId = $mysqli->insert_id;
                        error_log($logFile."\r\n",3,"/var/www/html/strikerapp/api_log/xml-api_$date123.log");
                        $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($from)."&to=91$to&text=".urlencode($message1);
                        if($type=="0"){
                            $URL .="&mclass=0";
                        }
$URL .= "&dlr-mask=19&dlr-url=".urlencode(SERVER_NAME."/apidlr_xml.php?campaign_id=$smsId&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");

                        http_send($URL,$sms_port);
                    }
                }
            }

	$balance = $available_credits - $no_of_messages;
	//$mysqli->query("insert into user_credits_log(before_campaign_credits,after_campaign_credits,current_campaign_credits,user_id,job_id) values('$available_credits','$balance','$no_of_messages','$user_id','$job_id')");
	$mysqli->query("update users set available_credits=available_credits-$no_of_messages where user_id='$user_id'");

	$available_credits=$available_credits-$no_of_messages; 

		}
        
		} else { // nofunds
            $mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no)  values('$user_id','$from','$message','$no_of_messages','$to',now(),'11','Insufficient Balance','$job_id','$sms_port')");
        }
    } //for
    echo "{Job Id: $job_id, Ack: Messages has been sent}";
}
 else { //user Authentication
    echo "Invalid User Details";
}
}
$mysqli->close();
?>
