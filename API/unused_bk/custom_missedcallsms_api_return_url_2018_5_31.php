<?php
include("dbconnect/config.php");
/*
api hit

http://www.smsstriker.com/API/custom_missedcallsms_api.php?user_id=4354&username=vinayraja&password=cba82f22bbf27fad99f9910096fbcf14&to=9701019800&msg=&from=&type=&user_service=VoiceService

*/
$custom_parameter=NULL;
$db_link=NULL;
$temp_check=NULL;
$no_of_messages=0;
$no_of_messages_tmp=0;
$message_length=1;
//$r_username = isset($_REQUEST['r_username']) ? $_REQUEST['r_username'] : '';


$username=$_REQUEST['username'];
 
$password=$_REQUEST['password'];
 //$returnurl="http://demo.office24by7.com/CronJobs/sms_response_api.php";
$from=$_REQUEST['from'];

 $urlencode=$_REQUEST['returnurl'];
if (!preg_match("~^(?:f|ht)tps?://~i", $urlencode)) {
        $http = "http:";
        $msg =str_replace(array('\\', $http.'/'), $http.'//', $urlencode); // output hello
       $https = "https:";
      $returnurl =str_replace(array('\\', $https.'/'), $https.'//', $msg); // output hello
    }
if($returnurl){
$returnurl=urldecode($returnurl); 
}else{
$returnurl=$urlencode;
}



$to_mobiles=$_REQUEST['to'];
$type=$_REQUEST['type'];

$user_service=$_REQUEST['user_service'];

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

$no_of_messages=$no_of_messages_tmp;  // changed on 26-12-2013 as per santosh request
//$no_of_messages=ceil($message_length/160);

$mm=explode(",",$to_mobiles);

/*

if(!$db_link)
{
$db_link=mysql_connect("localhost","root","striker@123") or die(mysql_error());
}
else
{
$db_link=mysql_pconnect("localhost","root","striker@123") or die(mysql_error());
}
mysql_select_db("sms",$db_link) or die(mysql_error());

*/
// add new code for user_service start



/*if($user_service!='VoiceService' || $user_service!='FirstRing')
{*/

  
	
	 $sqlrs = $mysqli->query("select user_id,available_credits,no_ndnc,dnd_check,template_check from users where username='".$username."' and password='".$password."'");

/*}else{
		$sqlus=$mysqli->query("SELECT u.user_id,u.username,u.password
	FROM users as u
	left join service_type 	st on u.user_id=st.user_id
	WHERE st.service_type='".$user_service."'");

	if($sqlus->num_rows > 0)
	{
		$valus=$sqlus->fetch_object();  
		$user_id=$valus->user_id;
		$username=$valus->username;
		$password=$valus->password;

	}


	$sqlrs=$mysqli->query("select user_id,available_credits,no_ndnc,dnd_check,template_check from users where user_id='".$user_id."'");	
}*/




if($sqlrs->num_rows > 0){
	$val = $sqlrs->fetch_object();
	$user_id=$val->user_id;
	$available_credits = $val->available_credits;
	$user_type=$val->no_ndnc;
	$template_check= $val->template_check;
	$dnd_check = $val->dnd_check;
	if($user_type == 1) {
		if($template_check) {
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
			$templates_query = $mysqli->query("SELECT template from templates where user_id='".$user_id."' and status= 2 ") ;
			//$templates_rs = mysql_query($templates_query);
			//mysql_num_rows($templates_rs);
			if($templates_query->num_rows > 0) {  
				while ($row = $templates_query->fetch_object())	{
					$temp = strtolower($row->template);
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
			}

			if(!$temp_check){				
				$error = true;
				$isValidTemplate = false;
				//echo $error_msg .= "SMS Text not matching with Approved Templates";
			}


		}

		$isValidSenderName=true;   
		// checking sendernames
		$sender_names_query = $mysqli->query("SELECT sender_name from sender_names where user_id='".$user_id."' and sender_name='".trim($from)."'") ;
		//$sender_names_rs = mysql_query($sender_names_query);
		//mysql_num_rows($sender_names_rs);
		if($sender_names_query->num_rows == 0)
		{
			$error = true;
			$isValidSenderName = false;
			//$error_msg .= "Invalid Sender Name ";
		}
	}
if($user_id==4668 || $user_id==4667){
	$error = false;
	$isValidSenderName=false;

}
	

	//sender names
	if($val->no_ndnc == 1){  //Transactional SMPP
		//$sender = "LM-" . $from;
		//$sms_port = 15013;
		$sender = $from;
     	 $PortType ="LT2";$portTypeNAS= 'NAST2';
	} elseif($val->no_ndnc == 0){  //Promo SMPP

		/*$from = "0" . rand(16066,16075);
		$sender = "LM-" . $from;
		*/
		//$sms_port = 27013;
		$sender = $from;$portTypeNAS= 'NASP2';
     	 $PortType ="LP2";
	} elseif($val->no_ndnc == 2){ //solutions infini transactional
		$sender = $from;
     	 $PortType ="LP2";$portTypeNAS= 'NAST2';
	}

		 if($val->dnd_check == 1 && $val->no_ndnc == 1){  // semi Transactional SMPP

        $sender = $from;
     	 $PortType ="LS2";$portTypeNAS= 'NASP2';
    }
    
    
    $portstmt = $mysqli->query("select sending_port_no from sms_queue where application_priority='$PortType' order by queued asc limit 1");
$port = $portstmt->fetch_array(MYSQLI_BOTH); 
$sms_port = $port[0];

/*if($user_id==5127 && $from=='OFCOTP'){

	//$sms_port=47313;  
	$sms_port=46013;

	//$sms_port=47513;  
}elseif($user_id==5127){
	$sms_port=47113;     
}
*/
	 include("/var/www/html/strikerapp/smslib/config.inc");
	 include("/var/www/html/strikerapp/smslib/functions.inc");
	//get job id
	// $job_id_rs = $mysqli->query("INSERT INTO  sms_api_job_ids SET user_id = '".$user_id."', created_on = NOW() ");
	$job_id_rs = $mysqli->query("INSERT INTO  sms_api_job_ids(user_id,created_on) VALUES('".$user_id."', NOW()) ");    
	$job_id = $mysqli->insert_id;   
	if($val->no_ndnc == 1){
	 $checkSenderName = $mysqli->query("SELECT * FROM sender_names WHERE user_id = '".$user_id."' AND sender_name = '".trim($from)."' AND status = 1 ");

    if($checkSenderName->num_rows == 0) {  
	 $getNASPortNumber = $mysqli->query("SELECT sending_port_no FROM sms_queue WHERE application_priority = '$portTypeNAS'");
    		if($getNASPortNumber->num_rows > 0) {
    			$getNASPortNumberRes = $getNASPortNumber->fetch_array();
    			$sms_port = $getNASPortNumberRes['sending_port_no'];
    		}
    }  
    }
    
    
    
  
 
 
 
    
     
	if($user_id == 5127 ){ // STRIKER SUPPORT - OTP
		$senderName = trim($from);
		if($from == 'STRIKR' || $from == 'PWDOTP' || $from == 'OFCOTP' || $from == 'OFCALT' ) { 
			//$sms_port ="46013";    
			$sms_port = 37113;//"46013";//"37113";    
		} // || $senderName == 'PASWRD'  
	     
	}	  
	  
	   $senderName_kennel = $from;
if($sms_port > 0) {
 	$getPortType = $mysqli->query("SELECT sending_port_no FROM sms_queue where sending_port_no = '".$sms_port."' AND used_for = 'BSNL' "); 
 	if($getPortType->num_rows > 0)  
	{  
	 	$senderName_kennel = "BA-".$from;
 	}  
 
 } 
 
 
 
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
		   				$message1 = $mysqli->real_escape_string($message);
		
		if($no_of_messages <= $available_credits) {
			if($error) {	
				if(!$isValidMobileNo) {
					$mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no) values('".$user_id."','".$from."','".$message."','".$no_of_messages."','".$to."',now(),'16','Invalid Number','".$job_id."','".$sms_port."')");

				}else if(!$isValidSenderName)
				{
					$mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no) values('".$user_id."','".$from."','".$message."','".$no_of_messages."','".$to."',now(),'12','Not a valid Sender Name','".$job_id."','".$sms_port."')");
				} else if(!$isValidTemplate)
				{
					$mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no) values('".$user_id."','".$from."','".$message."','".$no_of_messages."','".$to."',now(),'13','Not a valid Template','".$job_id."','".$sms_port."')");
				}else if(!$send_api_sms)
				{
					$mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no)	values('".$user_id."','".$from."','".$message1."','".$no_of_messages."','".$to."',now(),'5', 'Vendor Specific Error: Please contact your provider','".$job_id."','".$sms_port."')");				
				}	     
			}else
			{

				$message1 = $mysqli->real_escape_string($message);

				//check is block listed number?
				$blockedNumberRes = $mysqli->query("SELECT count(*) FROM sms.block_listed_numbers WHERE mobile_no = '{$to}'");
				$blockedNumberRow = $blockedNumberRes->fetch_array(MYSQLI_BOTH); 
				$is_block_listed = $blockedNumberRow[0];
				if($is_block_listed){
					$mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no)
				values('".$user_id."','".$from."','".$message1."','".$no_of_messages."','".$to."',now(),'2','Block Listed Number','".$job_id."','".$sms_port."')");
				} else {
					if(!$val->no_ndnc){
 
						//check for dnd number
						$checkDndRes = $mysqli->query("SELECT count(*) FROM dnd_db.ndnc_data WHERE dnc_number = '{$to}'");
						$checkDndRow = $checkDndRes->fetch_array(MYSQLI_BOTH); 
						$isDND = $checkDndRow[0];
 
						if($isDND){
							$mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,job_id,port_no)
						values('".$user_id."','".$from."','".$message1."','".$no_of_messages."','".$to."',now(),'3','".$job_id."','".$sms_port."')");
						} else {
							$mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,job_id,port_no)
		values('".$user_id."','".$from."','".$message1."','".$no_of_messages."','".$to."',now(),'".$job_id."','".$sms_port."')");
							$smsId =$mysqli->insert_id;

							$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($senderName_kennel)."&to=91$to&text=".urlencode($message);
 
							if($type=="0"){   
								$URL .="&mclass=0";
							}
								$URL .= "&dlr-mask=19&dlr-url=".urlencode(SERVER_NAME."/apidlr.php?campaign_id=$smsId&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");

//  $URL .= "&dlr-mask=19&dlr-url=".urlencode("$returnurl?campaign_id=$job_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");

 

 							http_send($URL, $sms_port);
 
						}
 
					} else {		
						$is_dnd_number = 0;
						if($dnd_check){
							//check for dnd number
							$checkDndRes = $mysqli->query("SELECT count(*) FROM dnd_db.ndnc_data WHERE dnc_number = '{$to}'");
							$checkDndRow = $checkDndRes->fetch_array(MYSQLI_BOTH); 
							if($checkDndRow[0]){
								$is_dnd_number = 1;
							}
						}

						if($is_dnd_number){
							$mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,job_id,port_no)
	values('".$user_id."','".$from."','".$message1."','".$no_of_messages."','".$to."',now(),'3','".$job_id."','".$sms_port."')");
						} else {
							$mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,job_id,port_no)
	values('".$user_id."','".$from."','".$message1."','".$no_of_messages."','".$to."',now(),'".$job_id."','".$sms_port."')");
							$smsId = $mysqli->insert_id;

							$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($senderName_kennel)."&to=91$to&text=".urlencode($message);

							if($type=="0"){
								$URL .="&mclass=0";
							}
							$URL .= "&dlr-mask=19&dlr-url=".urlencode(SERVER_NAME."/apidlr.php?campaign_id=$smsId&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");

  //$URL .= "&dlr-mask=19&dlr-url=".urlencode("$returnurl?campaign_id=$job_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");
							  http_send($URL,$sms_port);
						}      
					}
				}
				$mysqli->query("update users set available_credits=available_credits-$no_of_messages where user_id='".$user_id."'");

				$available_credits=$available_credits-$no_of_messages; 

			}

		} else { // nofunds
			$mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,job_id,port_no)
	values('".$user_id."','".$from."','".$message1."','".$no_of_messages."','".$to."',now(),'11','".$job_id."','".$sms_port."')");    
		}
	} //for  
	//    echo "{Job Id: $job_id, Ack: Messages has been sent}";
	echo $job_id;    
} else { //user Authentication
	echo "Invalid User Details";
}
$mysqli->close();

?>
