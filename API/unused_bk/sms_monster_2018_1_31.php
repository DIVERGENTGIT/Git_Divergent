<?php

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

$mn="".urldecode($_REQUEST['to']);


$mn = str_replace("\r",'', $mn);$mn = str_replace("\n",'', $mn);$mn = str_replace("\t",'', $mn);$mn=str_replace(' ', '', $mn);
$mn = str_replace(array("\r\n\t","\n\t","\r\t","\r\n", "\r", "\n","\t"), "", $mn);
$mn = str_replace(array("\r\n\t","\n\t","\r\t","\r\n", "\r", "\n","\t"), "", $mn);

if(strlen($mn)>10)	{$first_string=(int)$mn;$mn=$first_string.substr($mn,(strlen($first_string)+1));}
if(strlen($mn)>10)	{$first_string=(int)$mn;$mn=$first_string.substr($mn,(strlen($first_string)+1));}
if(strlen($mn)>10)	{$first_string=(int)$mn;$mn=$first_string.substr($mn,(strlen($first_string)+1));}
if(strlen($mn)>10)	{$first_string=(int)$mn;$mn=$first_string.substr($mn,(strlen($first_string)+1));}
if(strlen($mn)>10)	{$first_string=(int)$mn;$mn=$first_string.substr($mn,(strlen($first_string)+1));}

$to_mobile = $mn;

$type=$_REQUEST['type'];

$dnd_check = 0;
$error = false;
$message1='';
if(isset($_REQUEST['dnd_check']) && $_REQUEST['dnd_check']){
    $dnd_check = $_REQUEST['dnd_check'];
}

//$custom_parameter=$_REQUEST['custom_parameter'];
//$dlr_url=trim($_REQUEST['dlr_url']);

$sms_text=urldecode($_REQUEST['msg']);

$sms_text=str_replace("\'","'",$sms_text);
$sms_text=str_replace('\"','"',$sms_text);

$splMessage = strtolower(trim($sms_text));
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

$mm=explode(",",$to_mobile);
if(!$db_link)
{
    $db_link=mysql_connect("localhost","strikerapp",'Off!c3@v2017') or die(mysql_error());
}
else
{
    $db_link=mysql_pconnect("localhost","strikerapp",'Off!c3@v2017') or die(mysql_error());
}
mysql_select_db("sms",$db_link) or die(mysql_error());
$rs=mysql_query("select user_id,available_credits,no_ndnc,template_check,International,AllowedCountry from users where username='$username' and password=md5('$password')");
if(mysql_num_rows($rs)>0)
{
    $val=mysql_fetch_array($rs);
    $user_id=$val[0];
    $available_credits = $val[1];
	$user_type=$val['no_ndnc'];
	$template_check=$val['template_check'];
	$International = $val['International'];
	$AllowedCountry = $val['AllowedCountry'];
	if($user_type==1)
	{
		
		
		if($template_check)
		{
		$error = false;
		$isValidTemplate = true;
		//check for templates
			//lower case
		$sms_text = strtolower($sms_text);
	
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
			$sms_port=33013;
			
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
		$sender_names_rs = mysql_query($sender_names_query);
		mysql_num_rows($sender_names_rs);
		if(mysql_num_rows($sender_names_rs)==0)
		{
			$error = true;
			$isValidSenderName = false;
			//$error_msg .= "Invalid Sender Name ";
		}

	
	}




   

include("/var/www/html/strikerapp/smslib/config.inc");
    include("/var/www/html/strikerapp/smslib/functions.inc");

    //get job id
    $job_id_rs = mysql_query("
                INSERT INTO  sms_api_job_ids
                  SET user_id = '$user_id',
                    created_on = NOW()
            ");
    $job_id = mysql_insert_id();

    for($i=0;$i<count($mm);$i++) {
        $to=trim($mm[$i]);
       	 
		
		if($no_of_messages<=$available_credits) 
		{
			if($error)
			{
				 if(!$isValidSenderName)
				{
					mysql_query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no) values('$user_id','$from','$sms_text','$no_of_messages','$to',now(),'12','Not a valid Sender Name','$job_id','$sms_port')");
				} else if(!$isValidTemplate)
				{
					mysql_query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no) values('$user_id','$from','$sms_text','$no_of_messages','$to',now(),'13','Not a valid Template','$job_id','$sms_port')");
				}else if(!$send_api_sms)
				{
					mysql_query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no)	values('$user_id','$from','$sms_text','$no_of_messages','$to',now(),'5', 'Vendor Specific Error: Please contact your provider','$job_id','$sms_port')");				
				}	
			
			}else
			{
							
		//Country code and route port configuration  
		
	    $CountryRoute = array("971" => "33013","91" => "33013","968" => "33013","966" => "33013","974" => "33013","90" => "33013","973" => "33013","962" => "33013","965" => "33013","60" => "33013","95" => "33013","63" => "33013","65" => "33013","84" => "33013","62" => "33013","852" => "33013");
	   	

		
                $blockedNumberRes = mysql_query("SELECT count(*) as blocked FROM sms.block_listed_numbers WHERE user_id = '$user_id' AND  mobile_no = '{$to_mobile}'");
                $blockedNumberRow = mysql_fetch_array($blockedNumberRes);
                $is_block_listed = $blockedNumberRow['blocked'];
                $is_invalid_no = 1;
				if($International!=1){
					if(strlen($to_mobile)>7 and strlen($to_mobile)<=10 )	
                    		$is_invalid_no=0;
					}else{
					
					
					if(isset($CountryRoute[substr($to_mobile, 0, 4)])) $available_port = $CountryRoute[substr($to_mobile, 0, 4)];
					elseif(isset($CountryRoute[substr($to_mobile, 0, 3)])) $available_port = $CountryRoute[substr($to_mobile, 0, 3)];
					elseif(isset($CountryRoute[substr($to_mobile, 0, 2)])) $available_port = $CountryRoute[substr($to_mobile, 0, 2)];
					elseif(isset($CountryRoute[substr($to_mobile, 0, 1)])) $available_port = $CountryRoute[substr($to_mobile, 0, 1)];
					$available_port = "33013";  //Default Port
							
						if((strlen($to_mobile) >= 6 and strlen($to_mobile)<=16)) {
							if(strcmp($AllowedCountry,"*")==0){
								$is_invalid_no=0;
							}
							else{

								$str1 = "|".substr($to_mobile, 0, 4)."|";
								$str2 = "|".substr($to_mobile, 0, 3)."|";
								$str3 = "|".substr($to_mobile, 0, 2)."|";
								$str4 = "|".substr($to_mobile, 0, 1)."|";
								
								$pos1 = strpos($AllowedCountry,$str1);
								$pos2 = strpos($AllowedCountry,$str2);
								$pos3 = strpos($AllowedCountry,$str3);
								$pos4 = strpos($AllowedCountry,$str4);

								if($pos1 || $pos2 || $pos3 || $pos4){
									$is_invalid_no=0;
								}
							}
						}
				}


                if($is_block_listed > 0){
                   mysql_query("insert into campaigns_to(campaign_id,to_mobile_no,sms_text,sent_on,dlr_status,error_text) values('$campaign_id','$to_mobile','$sms_text',now(),'2','Block Listed Number')");
                    // $values.="('$campaign_id','$to','$sms_text',now(),'2','Block Listed Number','$available_port'),";
                } else {
			
	if($International==1)
	{

		$getphoneCode = mysql_query("select c.phonecode,c.nicename from countries c where c.phonecode=substring('$to',1,length(phonecode))");
 		$phoneCodeRes = mysql_fetch_array($getphoneCode);
 		$phoneCode = $phoneCodeRes['phonecode'];   
 		$nicename = $phoneCodeRes['nicename']; 
		if($is_invalid_no==0){
 			$intCodeQuery = "insert into international_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,job_id,port_no,phonecode,nicename) values('$user_id','$from','$sms_text','$no_of_messages','$to',now(),'$job_id','$available_port','$phoneCode','$nicename')";
  mysql_query($intCodeQuery);
			$data="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,job_id,port_no)
			values('$user_id','$from','$sms_text','$no_of_messages','$to',now(),'$job_id','$available_port')";

			mysql_query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,job_id,port_no)
			values('$user_id','$from','$sms_text','$no_of_messages','$to',now(),'$job_id','$available_port')");
			$smsId = mysql_insert_id();

			$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($from)."&to=$to&text=".urlencode($sms_text);
			if($type=="0"){
			$URL .="&mclass=0";
		}
			$URL .= "&dlr-mask=19&dlr-url=".urlencode("https://www.smsstriker.com/API/DLRS/intapidlr.php?campaign_id=$smsId&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");
		 http_send($URL,$available_port);
		}else
		{ 

	mysql_query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,job_id,port_no,dlr_status,error_text)
			values('$user_id','$from','$sms_text','$no_of_messages','$to',now(),'$job_id','$available_port','16','Not Allowed Country')");
			
			$intCodeQuery = "insert into international_api_messages  (user_id,sender_name,message,noofmessages,to_mobileno,ondate,job_id,port_no,dlr_status,error_text,phonecode,nicename) values('$user_id','$from','$sms_text','$no_of_messages','$to',now(),'$job_id','$available_port','16','Not Allowed Country','$phoneCode','$nicename')";	
		 mysql_query($intCodeQuery);
		 
		}
		

		 
                      
                       
                           $balance = $available_credits - $no_of_messages;
				//mysql_query("insert into user_credits_log(before_campaign_credits,after_campaign_credits,current_campaign_credits, user_id,job_id) values('$available_credits','$balance','$no_of_messages','$user_id','$job_id')");
                              
            mysql_query("update users set available_credits=available_credits-$no_of_messages where user_id='$user_id'");
            
		$available_credits=$available_credits-$no_of_messages;
		
		$data=$data."URL--".$URL ; 
		$date= date('Y-m-d');				
		
		error_log($data."\r\n",3,"/var/www/html/strikerapp/api_log/monster_api_log/mons_log".$date.".log"); 


		
		
		
	}
	             /*else
	{
						
$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($from)."&to=$to&text=".urlencode($sms_text);
		$URL .= "&dlr-mask=19&dlr-url=".urlencode("http://182.18.165.185/intapidlr.php?campaign_id=$smsId&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");
   }*/
                      

				}

		}
        
		} else { // nofunds
            mysql_query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no)
                            values('$user_id','$from','$sms_text','$no_of_messages','$to',now(),'11','insufficient balance','$job_id','$sms_port')");
                            
                            $date= date('Y-m-d');
                            $data="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no)
                            values('$user_id','$from','$sms_text','$no_of_messages','$to',now(),'11','insufficient balance','$job_id','$sms_port')";
                            
                            error_log($data."\r\n",3,"/var/www/html/strikerapp/api_log/monster_api_log/insuffient_bal_mons-inter-api_".$date.".log"); 
        }
    } //for
    	
    echo "{Job Id: $job_id, Ack: Messages has been sent}";
  
} else { //user Authentication
    echo "Invalid User Details";
}
mysql_close($db_link);
?>
