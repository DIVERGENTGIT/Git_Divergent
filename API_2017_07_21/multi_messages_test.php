<?php 
include("dbconnect/config.php");  
/* Parameters */
$username=$_REQUEST['username'];
$password=$_REQUEST['password'];
$from=$_REQUEST['from'];
if(strlen($from)==6)
{
$mno_msg=$_REQUEST['mno_msg'];
$type=$_REQUEST['type']; 
$dnd_check = 0;

if(isset($_REQUEST['dnd_check']) && $_REQUEST['dnd_check']){
    $dnd_check = $_REQUEST['dnd_check'];
}

$dlr_url=trim($_REQUEST['dlr_url']);
   

$rs=$mysqli->query("select user_id, no_ndnc,dnd_check from users where username='".$username."' and password='".md5($password)."'");
if($rs->num_rows > 0){
    $val= $rs->fetch_array();
    $user_id=$val[0];

	///sender names
	if($val['no_ndnc'] == 1 && $val['dnd_check'] == 0){  //Transactional SMPP
	//$sender = "LM-" . $from;
	//$sms_port = 15013;
	$sender = $from;
	$port_type="LT2";
	} elseif($val['no_ndnc'] == 0){  //Promo SMPP

	/*$from = "0" . rand(16066,16075);
	$sender = "LM-" . $from;
	*/
	//$sms_port = 27013;
	$sender = $from;
	$port_type="LP2";
	} else if($val['dnd_check'] == 1 && $val['no_ndnc'] == 1){  // semi Transactional SMPP

	$sender = $from;
	$port_type="LS2";
	}

$port = $mysqli->query("select sending_port_no from sms_queue where application_priority='$port_type' order by queued asc limit 1");    
$portarr=$port->fetch_array();
$sms_port=$portarr['sending_port_no'];
   include("/var/www/html/strikerapp/smslib/config.inc");
   include("/var/www/html/strikerapp/smslib/functions.inc");
/**	 For Live   **/
    //get job id
   //$job_id_rs = $mysqli->query("INSERT INTO  sms_api_job_ids SET user_id = '".$user_id."',  created_on = NOW()  ");
    $job_id_rs = $mysqli->query("INSERT INTO  sms_api_job_ids(user_id,created_on) VALUES('".$user_id."', NOW()) ");    
	
    $job_id = $mysqli->insert_id;



    $multi_msgs = explode('~',$mno_msg);
	
    for($i = 0; $i < count($multi_msgs); $i++){
   
        $params = explode('^',$multi_msgs[$i]);
        $to = trim($params[0]);
        $message = trim($params[1]);

$message = urldecode($message);  
$message=explode('\n',$message);
$message= implode(" ",$message);
$message=explode('\r',$message);
$message= implode(" ",$message);
$message=explode('\t',$message);
$message= implode(" ",$message);
$message=str_replace("\'","'",$message); 
$message=str_replace('\"','"',$message);
$message = str_replace("\n", " ", $message);
$message = str_replace("\t", " ", $message);
 $message = str_replace("\r", " ", $message); 
 $message = preg_replace('/\s+/', ' ', $message);
 $message = trim($message);  
        $message1 = $mysqli->real_escape_string($message);
        $message_length =strlen($message);
        if($message_length == 0){
            $message_length = 1;
        }

		// calculate SMS length
		if($message_length>160)
			$no_of_messages_tmp=ceil($message_length/153);
		else
			$no_of_messages_tmp=ceil($message_length/160);


		$no_of_messages=$no_of_messages_tmp;  // changed on 26-12-2013 as per santosh request	
        //$no_of_messages = ceil($message_length/160);


 if($val['no_ndnc']==1){


	// checking sendernames
		  $sender_names_query = "SELECT sender_name from sender_names where user_id='$user_id' and sender_name='".trim($from)."'" ;
		$sender_names_rs = $mysqli->query($sender_names_query);
		//mysql_num_rows($sender_names_rs);

		if($sender_names_rs->num_rows == 0)
		{
		$error = true;
		$isValidSenderName =true;
		echo $error_msg = "Invalid Sender Name ";exit;


		}

		}

        //get available balance
         $balance_row = $mysqli->query("select available_credits from users where user_id = '{$user_id}'");
        $balance_row = $balance_row->fetch_array(MYSQLI_ASSOC);
        $available_credits = $balance_row['available_credits'];

        if($no_of_messages<=$available_credits) {
            //check is block listed number?
            $blockedNumberRes = $mysqli->query("SELECT count(*) as blocked FROM sms.block_listed_numbers WHERE mobile_no = '{$to}'");
            $blockedNumberRow = $blockedNumberRes->fetch_array();
            $is_block_listed = $blockedNumberRow['blocked']; 
            if($is_block_listed > 0){
                $mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id)
                        values('$user_id','$from','$message1','$no_of_messages','$to',now(),'2','Block Listed Number','$job_id')");
		  echo "{Job Id: $job_id, Ack:Block Listed Number}";
            }else if($isValidSenderName)
				{

				 $query="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id) values('$user_id','$from','$message','$no_of_messages','$to',now(),'12','Not a valid Sender Name','$job_id')";
					$mysqli->query($query);
		  echo "{Job Id: $job_id, Ack: Not a valid Sender Name}";
					
				} 
           elseif(strlen($to) != 10){
                $mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id)
                        values('$user_id','$from','$message1','$no_of_messages','$to',now(),'16','Invalid Number','$job_id')");
		  echo "{Job Id: $job_id, Ack: Invalid Number}";
            }       
            
                       else {
                if(!$val['no_ndnc']){
                    //check for dnd number
                    $checkDndRes = $mysqli->query("SELECT count(*) as dnd FROM dnd_db.ndnc_data WHERE dnc_number = '{$to}'");
                    $checkDndRow = $checkDndRes->fetch_array();
                    $isDND = $checkDndRow['dnd'];
                    if($isDND > 0){
                        $mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,job_id)
                            values('$user_id','$from','$message1','$no_of_messages','$to',now(),'3','$job_id')");
		  echo "{Job Id: $job_id, Ack: DND Number}";
                    } else {
                      /*  mysql_query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,job_id)
                            values('$user_id','$from','$message1','$no_of_messages','$to',now(),'$job_id')");
*/

 $query="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,job_id,port_no)
                            values('$user_id','$from','$message1','$no_of_messages','$to',now(),'$job_id','$sms_port')";
                             $mysqli->query($query);
                        $smsId = $mysqli->insert_id;

                     $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=91$to&text=".urlencode($message);
                        if($type=="0"){
                            $URL .="&mclass=0";
                        }
                       $URL .= "&dlr-mask=19&dlr-url=".urlencode(SERVER_NAME."/apidlr.php?campaign_id=$smsId&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");
                       http_send($URL,$sms_port);
    echo "{Job Id: $job_id, Ack: Messages has been sent}"; 
                    }
                } else {
                    $is_dnd_number = 0;
                    if($dnd_check){
                        //check for dnd number
                        $checkDndRes = $mysqli->query("SELECT count(*) as dnd  FROM dnd_db.ndnc_data WHERE dnc_number = '{$to}'");
                        $checkDndRow = $checkDndRes->fetch_array();
			$checkDndRow = $checkDndRow['dnd'];
                        if($checkDndRow > 0){
                         $is_dnd_number = 1;
                        }
                    }

                    if($is_dnd_number){
                        $mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,job_id)
                            values('$user_id','$from','$message1','$no_of_messages','$to',now(),'3','$job_id')");
		  echo "{Job Id: $job_id, Ack: DND Number}";
                    } else {
                       $query="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,job_id,port_no)
                            values('$user_id','$from','$message1','$no_of_messages','$to',now(),'$job_id','$sms_port')";
                             $mysqli->query($query);
                        $smsId = $mysqli->insert_id;

                      $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=91$to&text=".urlencode($message);
                        if($type=="0"){
                            $URL .="&mclass=0";
                        }
                       $URL .= "&dlr-mask=19&dlr-url=".urlencode(SERVER_NAME."/apidlr.php?campaign_id=$smsId&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");       
                       http_send($URL,$sms_port);
    echo "{Job Id: $job_id, Ack: Messages has been sent}"; 
                    }
                }
            }  
            
                $balance = $available_credits - $no_of_messages;
				$mysqli->query("insert into user_credits_logs(before_campaign_credits,after_campaign_credits,current_campaign_credits,
				user_id,job_id) values('$available_credits','$balance','$no_of_messages','$user_id','$job_id')");
            $mysqli->query("update users set available_credits=available_credits-$no_of_messages where user_id='$user_id'");
            
            
                        							$available_credits=$available_credits-$no_of_messages;

        } else {
            $mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,job_id)
                            values('$user_id','$from','$message1','$no_of_messages','$to',now(),'11','$job_id')");
		echo "{Job Id: $job_id, Ack: Insufficient Credits}";
        }
    }

} else {
    echo "Invalid User Details";
}
}else{
echo "invalid sender ID please use six characters sender ID";
}
$mysqli->close();
?>
