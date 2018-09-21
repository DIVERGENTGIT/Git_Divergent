<?php
include("/var/www/html/strikerapp/smslib/config.inc");
include("/var/www/html/strikerapp/smslib/functions.inc");
include("/var/www/html/strikerapp/API/dbconnect/config.php");
global $mysqli;
$campaign_rs = $mysqli->query("select campaign_id from campaigns where is_scheduled='1' and campaign_status='1' and source_type not in(3,4) and scheduled_on <= now()");
$campaigns = "";
//$promotional_ports = array("Neo", "Morpheus", "Trinity", "Cypher", "Tank");
//$transactional_ports = array("Neo", "Morpheus", "Trinity", "Cypher", "Tank");
$fp = fopen('/var/www/html/strikerapp/tempdata_scheduledCampaign.txt', 'a');
//echo "test number",$campaign_rs->num_rows;
if($campaign_rs->num_rows >0) {
	
	while($campaign_val= $campaign_rs->fetch_array(MYSQLI_ASSOC)) {
		$campaigns .= $campaign_val['campaign_id'].",";  
	}
	  
	$campaign_ids=substr($campaigns,0,strlen($campaigns)-1); 
	
	 $mysqli->query("update campaigns set campaign_status='2' where campaign_id in ($campaign_ids)");
	$mysqli->query("set character_set_results='utf8'");   // for unicode string
	$campaign_details_rs = $mysqli->query("select user_id,campaign_id,sender_name,sms_text,campaign_type,is_unicode_sms,no_of_messages from campaigns where campaign_id in ($campaign_ids)");
	while($campaign_details_val = $campaign_details_rs->fetch_array(MYSQLI_ASSOC)) {
		
		$user_id = $campaign_details_val['user_id'];
		$campaign_id = $campaign_details_val['campaign_id'];
		$sender_name = $campaign_details_val['sender_name'];
		$campaign_type = $campaign_details_val['campaign_type'];
		$is_unicode_sms = $campaign_details_val['is_unicode_sms'];
		$no_of_messages = $campaign_details_val['no_of_messages'];

		$mclass = "";
		if($campaign_type == 1) 
			$mclass = "&mclass=0";
        $unicode_sms = "";
		if($is_unicode_sms) 
			$unicode_sms = "&coding=2&charset=utf-8"; // for unicode string
		$getRes = $mysqli->query("select no_ndnc,dnd_check from users where user_id='$user_id'");		
		$ndnc = $getRes->fetch_array(MYSQLI_ASSOC);
		$dnd_check_transuser = $ndnc['dnd_check'];
        //sender names
        if($ndnc['no_ndnc'] == 1 && $dnd_check_transuser!=1){
            //loop Transactional SMPP
            $portType = "LT2";

            //$sender = "LM-".$sender_name;
			 $sender = $sender_name;

            //$portType = "ST2";
            //$sender = $sender_name;

        } elseif($ndnc['no_ndnc'] == 0){
            //loop Promo SMPP
            //$sender = "LM-".$sender_name;
	//$sender = $sender_name;
	$sender = "STRIKR";

            $portType = "LP2";

            //$portType = "SP2";
            //$sender = $sender_name;
        } elseif($ndnc['no_ndnc'] == 2){ //Vf transactional
            $portType = "VT2";
            $sender = $sender_name;
        }
 elseif($ndnc['no_ndnc'] == 1 && $dnd_check_transuser==1){ //Semi trans
            $portType = "LS2";
            $sender = $sender_name;
        }
 	$getQueryRes = $mysqli->query("SELECT sending_port_no FROM sms_queue where application_priority='$portType' order by queued, sent asc limit 1");
        $available_port_val = $getQueryRes->fetch_array(MYSQLI_ASSOC);
        $available_port = $available_port_val['sending_port_no'];
		
		
                        				
		$to_details_rs = $mysqli->query("select sms_text,to_mobile_no from schedule_campaigns_to where campaign_id='$campaign_id'");
		if($to_details_rs->num_rows > 0) 
		{
			$no_of_messages_tmp=100;
			while($to_details_val =  $to_details_rs->fetch_array(MYSQLI_ASSOC))
			{
				$sms_text = $to_details_val['sms_text'];
                $sms_text1 = $mysqli->real_escape_string($sms_text);
				$to_mobile = $to_details_val['to_mobile_no'];

				//mysql_query("insert into schedule_campaigns_to_bkup(campaign_id,to_mobile_no,sms_text) values('$campaign_id','$to_mobile','$sms_text1')");

                //check is block listed number?
                $is_invalid_no = 1;
                if(strlen($to_mobile)>7 and strlen($to_mobile)<=10 )	
                    	$is_invalid_no=0;
                    
                   
                $blockedNumberRes = $mysqli->query("SELECT count(*) as blocked FROM sms.block_listed_numbers WHERE mobile_no = '{$to_mobile}'");
                $blockedNumberRow =  $blockedNumberRes->fetch_array(MYSQLI_ASSOC);
                $is_block_listed = $blockedNumberRow['blocked'];
 		 
                if($is_block_listed > 0){
                    $mysqli->query("insert into campaigns_to(campaign_id,to_mobile_no,sms_text,sent_on,dlr_status,error_text) values('$campaign_id','$to_mobile','$sms_text1',now(),'2','Block Listed Number')");
                } 
                elseif($is_invalid_no){
                   	  $mysqli->query("insert into campaigns_to(campaign_id,to_mobile_no,sms_text,sent_on,dlr_status,error_text,port_no) values('$campaign_id','$to_mobile','$sms_text1',now(),'16','Invalid Number','$available_port')");
						//$block_no_count++;
                    }
                
                else {  
                    if(!$ndnc['no_ndnc']){
                        //check for dnd number
                       	 $checkDndRes = $mysqli->query("SELECT count(*) FROM dnd_db.ndnc_data WHERE dnc_number = '{$to_mobile}'");
                      
                       	 $checkDndRow = $checkDndRes->fetch_array(MYSQLI_ASSOC);
                       	 $isDND = $checkDndRow[0];
                       	 if($isDND){
                            $mysqli->query("insert into campaigns_to(campaign_id,to_mobile_no,sms_text,sent_on,dlr_status,error_text) values('$campaign_id','$to_mobile','$sms_text1',now(),'3','DND Number')");
                            
                       	 } else {
                          	  $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=91$to_mobile&text=".urlencode($sms_text);
                           	$URL .= "$unicode_sms$mclass&dlr-mask=19&dlr-url=".urlencode(SERVER_NAME."/dlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");

                            	http_send($URL,$available_port);
                            	$mysqli->query("insert into campaigns_to(campaign_id,to_mobile_no,sms_text,sent_on,port_no) values('$campaign_id','$to_mobile','$sms_text1',now(),'$available_port')");
                            
                        }
                    } else {
                    	if($ndnc['dnd_check']){

				$checkDndRes = $mysqli->query("SELECT count(*) FROM dnd_db.ndnc_data WHERE dnc_number = '{$to_mobile}'");
                      
                       	 	$checkDndRow = $checkDndRes->fetch_array(MYSQLI_ASSOC);
                        	$isDND = $checkDndRow[0];
                        	if($isDND){
                            		$mysqli->query("insert into campaigns_to(campaign_id,to_mobile_no,sms_text,sent_on,dlr_status,error_text) values('$campaign_id','$to_mobile','$sms_text1',now(),'3','DND Number')");
                            
                     		  }else{
    					$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=91$to_mobile&text=".urlencode($sms_text);
     					$URL .= "$unicode_sms$mclass&dlr-mask=19&dlr-url=".urlencode(SERVER_NAME."/dlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");
                       			http_send($URL,$available_port);
                        		$mysqli->query("insert into campaigns_to(campaign_id,to_mobile_no,sms_text,sent_on,port_no) values('$campaign_id','$to_mobile','$sms_text1',now(),'$available_port')");                      

				}  
			}else{
           			$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=91$to_mobile&text=".urlencode($sms_text);
     				$URL .= "$unicode_sms$mclass&dlr-mask=19&dlr-url=".urlencode(SERVER_NAME."/dlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");
                        	http_send($URL,$available_port);
                        	$mysqli->query("insert into campaigns_to(campaign_id,to_mobile_no,sms_text,sent_on,port_no) values('$campaign_id','$to_mobile','$sms_text1',now(),'$available_port')");
                      
                    	}
                }
			}
			 $mysqli->query("delete from schedule_campaigns_to where campaign_id='$campaign_id'");			
		}

	}
}	
$mysqli->close();
} else {
    echo 'No Scheduled SMS Camapigns[ '.date("F j, Y, g:i a").' ]'. PHP_EOL;
}
