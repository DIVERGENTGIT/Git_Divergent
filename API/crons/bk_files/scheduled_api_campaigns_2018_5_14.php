<?php
include("/var/www/html/strikerapp/smslib/config.inc");
include("/var/www/html/strikerapp/smslib/functions.inc");
include("/var/www/html/strikerapp/API/dbconnect/config.php");
global $mysqli;
$campaign_rs = $mysqli->query("select job_id from sms_api_job_ids where is_scheduled='1' and campaign_status='1' and scheduled_on <= now()");
$campaigns = "";
//$promotional_ports = array("Neo", "Morpheus", "Trinity", "Cypher", "Tank");
//$transactional_ports = array("Neo", "Morpheus", "Trinity", "Cypher", "Tank");
if($campaign_rs->num_rows > 0) {
	
	while($campaign_val= $campaign_rs->fetch_array(MYSQLI_ASSOC)) {
		$campaigns .= $campaign_val['job_id'].",";   
	}
	
	$job_ids=substr($campaigns,0,strlen($campaigns)-1); 
	  
	$mysqli->query("update sms_api_job_ids set campaign_status='2' where job_id in ($job_ids)");
	echo "select user_id,job_id,sender_name,message from sms_api_job_ids where job_id in ($job_ids)";
	$campaign_details_rs = $mysqli->query("select user_id,job_id,sender_name,message from sms_api_job_ids where job_id in ($job_ids)");
	while($campaign_details_val = $campaign_details_rs->fetch_array(MYSQLI_ASSOC)) {
		
		$user_id = $campaign_details_val['user_id'];
		$job_id = $campaign_details_val['job_id'];
		$sender_name = $campaign_details_val['sender_name'];
		//$campaign_type = $campaign_details_val['campaign_type'];
		$campaign_type = 0;
		if($campaign_type == 1) {
			$mclass = "&mclass=0";
		} else {
			$mclass = "";
		}
		$getRes = $mysqli->query("select no_ndnc from users where user_id='$user_id'");
		$ndnc = $getRes->fetch_array(MYSQLI_ASSOC);
        //sender names
        if($ndnc['no_ndnc'] == 1 && $ndnc['dnd_check'] != 1){
            //Transactional SMPP
            $portType = "LT2";
            //$sender = "LM-".$sender_name;
			 $sender = $sender_name;
$portTypeNAS = 'NAST2';
            //$portType = "ST2";
            //$sender = $sender_name;

        } elseif($ndnc['no_ndnc'] == 0){
            //loop Promo SMPP
            //$sender = "LM-".$sender_name;
			$sender = $sender_name;
            $portType = "LP2";
	$portTypeNAS = 'NASP2';
            //$portType = "SP2";
            //$sender = $sender_name;
        } elseif($ndnc['no_ndnc'] == 2){ //solutions infini transactional
            $portType = "ST2";
            $sender = $sender_name;
            $portTypeNAS = 'NAST2';
        }
elseif($ndnc['no_ndnc'] == 1 && $ndnc['dnd_check'] == 1){ //SEMI  transactional
            $portType = "LS2";
            $sender = $sender_name;
            $portTypeNAS = 'NASP2';
        }

	$res = $mysqli->query("SELECT sending_port_no FROM sms_queue where application_priority='$portType' order by queued, sent asc limit 1");
        $available_port_val = $res->fetch_array(MYSQLI_ASSOC);
        $available_port = $available_port_val['sending_port_no'];
        
          if($ndnc['no_ndnc'] == 1) {     
    $checkSenderName = $mysqli->query("SELECT * FROM sender_names WHERE user_id = '".$user_id."' AND sender_name = '".trim($sender)."' AND status = 1 ");

    if($checkSenderName->num_rows == 0) {  
    	$getNASPortNumber = $mysqli->query("SELECT sending_port_no FROM sms_queue WHERE application_priority = '$portTypeNAS'");
    		if($getNASPortNumber->num_rows > 0) {  
    			$getNASPortNumberRes = $getNASPortNumber->fetch_array();
    			$sms_port = $getNASPortNumberRes['sending_port_no'];
    		}
	 $available_port = $sms_port;
    }  
     }  
                      
		
		$to_details_rs = $mysqli->query("select sms_text,to_mobile_no,is_unicode from schedule_api_campaigns_to where job_id='$job_id'");
		if($to_details_rs->num_rows > 0) {
			while($to_details_val =  $to_details_rs->fetch_array(MYSQLI_ASSOC))
			{
				$is_unicode = $to_details_val['is_unicode'];
				if($is_unicode){
					$unicode_sms = "&coding=2&charset=utf-8&";
				}
				$sms_text = $to_details_val['sms_text'];
               			$sms_text1 = $mysqli->real_escape_string($sms_text);
				$message=$sms_text1 ;
				$message=str_replace("\'","'",$message);
				$message=str_replace('\"','"',$message);
				
				$splMessage = $message =trim($message);
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
				
				$to_mobile = $to_details_val['to_mobile_no'];

                //check is block listed number?
                $blockedNumberRes = $mysqli->query("SELECT count(*) as blocked FROM sms.block_listed_numbers WHERE user_id = '$user_id' AND mobile_no = '{$to_mobile}'");
                $blockedNumberRow = $blockedNumberRes->fetch_array(MYSQLI_ASSOC);
                $is_block_listed = $blockedNumberRow['blocked'];
                if($is_block_listed > 0){
                    $mysqli->query("insert into sms_api_messages(user_id,sender_name,job_id,to_mobileno,message,noofmessages,`ondate`,dlr_status,error_text) values('$user_id','$sender_name','$job_id','$to_mobile','$sms_text1',$no_of_messages,now(),'2','Block Listed Number')");
                } else {
                    if(!$ndnc['no_ndnc']){
                        //check for dnd number
                        $checkDndRes = $mysqli->query("SELECT count(*) as dndcount FROM dnd_db.ndnc_data WHERE dnc_number = '{$to_mobile}'");
                        $checkDndRow = $checkDndRes->fetch_array(MYSQLI_ASSOC);
                        $isDND = $checkDndRow['dndcount'];
                        if($isDND > 0){
                            $mysqli->query("insert into sms_api_messages(user_id,sender_name,job_id,to_mobileno,message,noofmessages,`ondate`,dlr_status,error_text) values('$user_id','$sender_name','$job_id','$to_mobile','$sms_text1',$no_of_messages,now(),'3','DND Number')");
                        } else {
  $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=91$to_mobile&text=".urlencode($sms_text);
                            $URL .= "$unicode_sms$mclass&dlr-mask=19&dlr-url=".urlencode(SERVER_NAME."/dlr.php?campaign_id=$job_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");

                            http_send($URL,$available_port);
                            $mysqli->query("insert into sms_api_messages(user_id,sender_name,job_id,to_mobileno,message,noofmessages,`ondate`,port_no) values('$user_id','$sender_name','$job_id','$to_mobile','$sms_text1',$no_of_messages,now(),'$available_port')");
                        }
                    } else {
                        $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=91$to_mobile&text=".urlencode($sms_text);
                        $URL .= "$unicode_sms$mclass&dlr-mask=19&dlr-url=".urlencode(SERVER_NAME."/dlr.php?campaign_id=$job_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");
                        http_send($URL,$available_port);
                        $mysqli->query("insert into sms_api_messages(user_id,sender_name,job_id,to_mobileno,message,noofmessages,`ondate`,port_no) values('$user_id','$sender_name','$job_id','$to_mobile','$sms_text1',$no_of_messages,now(),'$available_port')");
                    }
                }
			}
			$mysqli->query("delete from schedule_api_campaigns_to where job_id='$job_id'");			
		}
	} 
$mysqli->close(); 
} else {
    echo "No Scheduled SMS Camapigns";
}
