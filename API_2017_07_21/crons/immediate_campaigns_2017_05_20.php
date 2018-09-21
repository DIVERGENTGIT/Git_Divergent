<?php
include("/var/www/html/strikerapp/smslib/config.inc");
include("/var/www/html/strikerapp/smslib/functions.inc");

include("/var/www/html/strikerapp/API/dbconnect/config.php");
$campaign_rs = $mysqli->query("select campaign_id,campaign_name from campaigns where is_scheduled='0' and campaign_status='1' AND source_type NOT IN(3,4) LIMIT 10");
  
$campaigns = ""; 
if($campaign_rs->num_rows > 0) 
{

	while($campaign_val= $campaign_rs->fetch_array(MYSQLI_ASSOC)) 
	{
		$campaigns .= $campaign_val['campaign_id'].",";
	}
	
	$campaign_ids=substr($campaigns,0,strlen($campaigns)-1);
 
	$mysqli->query("set character_set_results='utf8'");   // for unicode string
	$mysqli->query("update campaigns set campaign_status='2' where campaign_id in ($campaign_ids)");
	
    $campaign_details_rs = $mysqli->query("select user_id,campaign_id,campaign_name,sender_name,sms_text,campaign_type,is_unicode_sms,no_of_messages,phone_nos_count from campaigns where campaign_id in ($campaign_ids)");
	while($campaign_details_val = $campaign_details_rs->fetch_array(MYSQLI_ASSOC)) 
	{

		$user_id = trim($campaign_details_val['user_id']);
		$campaign_id = $campaign_details_val['campaign_id'];
		$campaign_name = trim($campaign_details_val['campaign_name']);
		$sender_name = $campaign_details_val['sender_name'];
		$sms_type = $campaign_details_val['campaign_type'];
		$is_unicode_sms = $campaign_details_val['is_unicode_sms'];
		$no_of_messages = $campaign_details_val['no_of_messages'];
		$phone_nos_count = $campaign_details_val['phone_nos_count'];
		$short_code = '';
		$mclass = "";
		if($sms_type == 1) 
			$mclass = "&mclass=0";
		$unicode_sms = "";
		if($is_unicode_sms) 
			$unicode_sms = "&coding=2&charset=utf-8"; // for unicode string
		$ndnc = $mysqli->query("select no_ndnc,dnd_check,username from users where user_id='$user_id'");
		$ndnc = $ndnc->fetch_array(MYSQLI_ASSOC);
	
	$dnd_check_transuser = $ndnc['dnd_check'];
$username = $ndnc['username'];
	
	    if($ndnc['no_ndnc'] == 1 && $dnd_check_transuser!=1){
            //loop Transactional SMPP
            $portType = "LT1";
            //$sender = "LM-".$sender_name;
			 $sender = $sender_name;
           
        } elseif($ndnc['no_ndnc'] == 0){
            //loop Promo SMPP
            $portType = "LP1";
            //$sender = "LM-".$sender_name;
			$sender = $sender_name;
        } elseif($ndnc['no_ndnc'] == 2){ //solutions infini transactional
            $portType = "ST1";
            $sender = $sender_name;
        }
        if($ndnc['no_ndnc'] == 1 && $dnd_check_transuser){
			
			$sender = $sender_name;
			$portType = "LS1";
		}
		$available_port_val = $mysqli->query("SELECT sending_port_no FROM sms_queue where application_priority='$portType' order by queued, sent asc limit 1");
		$available_port_val = $available_port_val->fetch_array(MYSQLI_ASSOC);
		$available_port = $available_port_val['sending_port_no'];
 
		//redirect all messages one particular port 
		if($user_id=='2029' or $user_id=='2028'  or $user_id=='2030')
		{
			$available_port_val =$mysqli->query("SELECT sending_port_no FROM sms_queue where sending_port_no IN ('40013','36013','39013','29013','28013','31013') order by queued, sent asc limit 1");
			$available_port_val = $available_port_val->fetch_array(MYSQLI_ASSOC);
			$available_port = $available_port_val['sending_port_no'];
		}
		

	if($user_id=='4036' || $user_id=='4330' || $user_id=='4350' || $user_id=='3989') // ACT 18-08-2016 AS PER NAVEEN REQUEST
	{

		if($sender_name=='ACTHYD')
		{
			
		
			$available_port='47513';
		}else{
			$available_port='47113';
		}

	}
 
	
	if($user_id=='4410')//ABIPROMO-semitrans user
	{
		$available_port_val = $mysqli->query("SELECT sending_port_no FROM sms_queue where sending_port_no IN ('48113','48213','48313') order by queued, sent asc limit 1");
		$available_port_val = $available_port_val->fetch_array(MYSQLI_ASSOC); 
$available_port = $available_port_val['sending_port_no'];

		//$available_port='48513';

	}


                
		//redirect all messages one particular port 
		if($user_id=='1975' or $user_id=='1975')
		{
			$available_port_val = $mysqli->query("SELECT sending_port_no FROM sms_queue where port_no in (39000,38000,35000,36000) order by queued, sent asc limit 1");
			$available_port_val = $available_port_val->fetch_array(MYSQLI_ASSOC);
			 $available_port = $available_port_val['sending_port_no'];
		}
		
		//$campaign_name="";
		$blockCampaign="0";
		$blockUserCampaign="0";
		if($user_id=='1975' or $user_id=='1975')
		{
			$offsetT=0;	
			 $insertQuery="insert into campaigns_to(campaign_id,to_mobile_no,sms_text,sent_on,dlr_status,error_code,error_text,port_no,short_url,delivered_on) values ";
 			$values="";
			
			//1975
			$haystack = $campaign_name;
			$needle = '02'; // search word
			if (strpos($haystack,$needle) !== false) 
			{
			    echo "$haystack contains $needle";
			    $blockCampaign=1;
			}
			$blockUserCampaign=1;
		}
 
		if($blockUserCampaign=="1" && $blockCampaign=="1")
		{
			$no_of_messages_tmp=100;
			//block campaigns
			 $to_details_rs = $mysqli->query("select sms_text,to_mobile_no from schedule_campaigns_to where campaign_id='$campaign_id'");
			 
			 while($to_details_val =  $to_details_rs->fetch_array(MYSQLI_ASSOC))
			 {  
				$no_of_messages_tmp++;
				$sms_text = $to_details_val['sms_text'];
                		$sms_text1 = $mysqli->real_escape_string($sms_text); 
             	   		$sms_text1 = trim(preg_replace('/\s+/', ' ', $sms_text1));
				$findString = 'ion.bz/';
                         	$pos = stripos($sms_text1, $findString); 
				$str = substr($sms_text1, $pos);   
  				$shortCode = substr($str, strlen($findString)); 
	 			$short_code = substr($shortCode, 0, 7); 
				$to_mobile = $to_details_val['to_mobile_no'];
				$tmp_rand=rand ( 5, 35);
			        $dndquery = "SELECT count(*) as dnd FROM dnd_db.ndnc_data WHERE dnc_number = '{$to_mobile}'";
				$checkDndRes = $mysqli->query($dndquery);

                $checkDndRow = $checkDndRes->fetch_array(MYSQLI_ASSOC);
                $isDND = $checkDndRow['dnd'];

                if($isDND > 0)  
                {
                   	//mysql_query("insert into campaigns_to(campaign_id,to_mobile_no,sms_text,sent_on,dlr_status,error_text) values('$campaign_id','$to_mobile','$sms_text1',now(),'3','DND Number')");
                   	 $values.="('$campaign_id','$to_mobile','$sms_text1',now(),'3','NULL','DND Number','41013','$short_code',now()),";
                   	
                }else
				{
					//mysql_query("insert into campaigns_to(campaign_id,to_mobile_no,sms_text,sent_on,dlr_status,error_code,error_text,port_no,delivered_on) values('$campaign_id','$to_mobile','$sms_text1',now(),'1','000','Delivered','41013',DATE_ADD(NOW(), INTERVAL $tmp_rand second) )");
					 $values.="('$campaign_id','$to_mobile','$sms_text1',now(),'1','000','Delivered','41013','$short_code',DATE_ADD(NOW(), INTERVAL $tmp_rand second)),";
				}
				
				$offsetT++;
	            if($offsetT==3000)
	            {
	               $values=substr($values,0,strlen($values)-1);
	               $final_query=$insertQuery." ".$values;
	               $mysqli->query($final_query);
			//echo mysql_error();
				   $offsetT=0;
				   $values="";
		    }	
		   } // end while
			// update remaining records
			if($offsetT>0)
                    {
	            $values=substr($values,0,strlen($values)-1);
	            $final_query=$insertQuery." ".$values;
				$mysqli->query($final_query);
				
				$offsetT=0;  
				$values="";
			}	 
			 
		// delete records from schedule_campaigns_to
		//if($no_of_messages_tmp==$no_of_messages)
				//mysql_query("delete from schedule_campaigns_to where campaign_id='$campaign_id'");		
		
			 
		}else
		{
 
			
		// normal campaigns
        		$to_details_rs = $mysqli->query("select sms_text,to_mobile_no from schedule_campaigns_to where campaign_id='$campaign_id'");
		if($to_details_rs->num_rows > 0) 
		{
			$insertQuery="insert into campaigns_to(campaign_id,to_mobile_no,sms_text,sent_on,dlr_status,error_text,port_no,short_url) values ";
 			$values="";
 			$offset=0;	
			$no_of_messages_tmp=100;
			while($to_details_val = $to_details_rs->fetch_array(MYSQLI_ASSOC))
			{

				$no_of_messages_tmp++;
				$sms_text = $to_details_val['sms_text'];
                		$sms_text1 = $mysqli->real_escape_string($sms_text); 
             	  		$sms_text1 = trim(preg_replace('/\s+/', ' ', $sms_text1)); 
				$findString = 'ion.bz/';
				$pos = stripos($sms_text1, $findString); 
				$str = substr($sms_text1, $pos); 
  				$shortCode = substr($str, strlen($findString)); 
	 			$short_code = substr($shortCode, 0, 7); 
				$to_mobile = $to_details_val['to_mobile_no'];

			//mysql_query("insert into schedule_campaigns_to_bkup(campaign_id,to_mobile_no,sms_text) values('$campaign_id','$to_mobile','$sms_text1')");

                //check is block listed number?
		$text1=$username.$smstext.$sender.$to_mobile;  
		$textmd5=md5($text1);      
		$checkContent = $mysqli->query("SELECT count(*) as duplicate FROM duplicatecheck WHERE md5text = '$textmd5'");
		$checkContentData = $checkContent->fetch_array(MYSQLI_ASSOC);
                $is_duplicate = $checkContentData['duplicate'];
 		if(!$is_duplicate) {  
 				$mysqli->query("INSERT INTO duplicatecheck (datetime,md5text) VALUES ('".date('Y-m-d H:i:s')."','".$textmd5."')"); 
		} 

                $blockedNumberRes = $mysqli->query("SELECT count(*) as blocked FROM sms.block_listed_numbers WHERE mobile_no = '{$to_mobile}'");
                $blockedNumberRow = $blockedNumberRes->fetch_array(MYSQLI_ASSOC);
                $is_block_listed = $blockedNumberRow['blocked'];
                $is_invalid_no = 1;
                if(strlen($to_mobile)>7 and strlen($to_mobile)<=10 )	
                    	$is_invalid_no=0;

                if($is_duplicate > 0){
 			
			 $values.="('$campaign_id','$to_mobile','$sms_text1',now(),'16','Duplicate Msg','$available_port','$short_code'),";
			$this->Campaign_model->campaignToNormalShorturl($campaign_id, $sendShorturl, $sms_length, $mobile_no, $smstext,$sms_port, 16, $error_text);
		}else if($is_block_listed > 0){
                   // mysql_query("insert into campaigns_to(campaign_id,to_mobile_no,sms_text,sent_on,dlr_status,error_text) values('$campaign_id','$to_mobile','$sms_text1',now(),'2','Block Listed Number')");
                     $values.="('$campaign_id','$to_mobile','$sms_text1',now(),'2','Block Listed Number','$available_port','$short_code'),";
                }  elseif($is_invalid_no){
                   	 // mysql_query("insert into campaigns_to(campaign_id,to_mobile_no,sms_text,sent_on,dlr_status,error_text,port_no) values('$campaign_id','$to_mobile','$sms_text1',now(),'16','Invalid Number','$available_port')");
                   	  
                   	  $values.="('$campaign_id','$to_mobile','$sms_text1',now(),'16','Invalid Number','$available_port','$short_code'),";
                   	  
						//$block_no_count++;
                    }else {
                    if(!$ndnc['no_ndnc']){ // promo
                        //check for dnd number
                        $checkDndRes = $mysqli->query("SELECT count(*) as dnd FROM dnd_db.ndnc_data WHERE dnc_number = '{$to_mobile}'");
                        $checkDndRow = $checkDndRes->fetch_array(MYSQLI_ASSOC);
                        $isDND = $checkDndRow['dnd'];
                       $dndquery= "SELECT count(*) FROM dnd_db.ndnc_data WHERE dnc_number = '{$to_mobile}'";
                       error_log("promo ".$dndquery."dndstatus ".$isDND."\n",3,ERRORLOGS);
                        if($isDND > 0){
                           
                          $values.="('$campaign_id','$to_mobile','$sms_text1',now(),'3','DND Number','$available_port','$short_code'),";  
                        } else {
                            $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=91$to_mobile&text=".urlencode($sms_text);
                            $URL .= "$unicode_sms$mclass&dlr-mask=19&dlr-url=".urlencode(SERVER_NAME."/dlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");

                            http_send($URL,$available_port);
                         
                            $values.="('$campaign_id','$to_mobile','$sms_text1',now(),'0','NULL','$available_port','$short_code'),";
                        }
                    } else {
                    
                    if($dnd_check_transuser) // semi trans
                    {
                    
                    
                    
                      $checkDndRes = $mysqli->query("SELECT count(*) as dnd FROM dnd_db.ndnc_data WHERE dnc_number = '{$to_mobile}'");
                        $checkDndRow = $checkDndRes->fetch_array(MYSQLI_ASSOC);
                        $isDND = $checkDndRow['dnd'];
                       $dndquery= "SELECT count(*) FROM dnd_db.ndnc_data WHERE dnc_number = '{$to_mobile}'";
                       error_log("Semi ".$dndquery."dndstatus ".$isDND."\n",3,ERRORLOGS);
                        if($isDND > 0){
                           // mysql_query("insert into campaigns_to(campaign_id,to_mobile_no,sms_text,sent_on,dlr_status,error_text) values('$campaign_id','$to_mobile','$sms_text1',now(),'3','DND Number')");
                          $values.="('$campaign_id','$to_mobile','$sms_text1',now(),'3','DND Number','$available_port','$short_code'),";  
                        } else {
                            $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=91$to_mobile&text=".urlencode($sms_text);
                            $URL .= "$unicode_sms$mclass&dlr-mask=19&dlr-url=".urlencode(SERVER_NAME."/dlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");

                            http_send($URL,$available_port);
                            //mysql_query("insert into campaigns_to(campaign_id,to_mobile_no,sms_text,sent_on,port_no) values('$campaign_id','$to_mobile','$sms_text1',now(),'$available_port')");
                            $values.="('$campaign_id','$to_mobile','$sms_text1',now(),'0','NULL','$available_port','$short_code'),";
                        }
                    
                    
                    
                    
                    }else{ // trans
 
                        $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=91$to_mobile&text=".urlencode($sms_text);
                        $URL .= "$unicode_sms$mclass&dlr-mask=19&dlr-url=".urlencode(SERVER_NAME."/dlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");

                        http_send($URL,$available_port);
                        //mysql_query("insert into campaigns_to(campaign_id,to_mobile_no,sms_text,sent_on,port_no) values('$campaign_id','$to_mobile','$sms_text1',now(),'$available_port')");
                        $values.="('$campaign_id','$to_mobile','$sms_text1',now(),'0','NULL','$available_port','$short_code'),";
                        }
                    }
                }
			
			$offset++;
 
            if($offset==3000)
            {
            	
            	//echo "5000";
	            $values=substr($values,0,strlen($values)-1);
	            $final_query=$insertQuery." ".$values;
				$mysqli->query($final_query);
				//echo mysql_error();
				$offset=0;
				$values="";
			}
			}// while loop end campaign numbers end
			
			if($offset>0)
			{
				// "remaining records ";
				$values=substr($values,0,strlen($values)-1);
				$final_query=$insertQuery." ".$values;
				$mysqli->query($final_query);
			}
				  $minusno_of_messages_tmp=$no_of_messages_tmp-100;
    	if($no_of_messages_tmp==$no_of_messages || $minusno_of_messages_tmp==$no_of_messages)
			{
				$mysqli->query("INSERT INTO schedule_campaigns_to_temp SELECT * from schedule_campaigns_to where campaign_id='$campaign_id'");	
				$mysqli->query("delete from schedule_campaigns_to where campaign_id='$campaign_id'");			
			}
			
				
		} // normal campaigns - end
	}// block campaigns else - end
		
		
		
		
		
		
	}// while end
$mysqli->close();
} else {
	
    echo 'No Immediate SMS Camapigns[ '.date("F j, Y, g:i a").' ]'. PHP_EOL;
    
}
