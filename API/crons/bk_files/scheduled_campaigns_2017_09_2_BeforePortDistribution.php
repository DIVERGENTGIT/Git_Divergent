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
	$campaign_details_rs = $mysqli->query("select user_id,campaign_id,sender_name,sms_text,sms_count,long_url,shorturl_text,campaign_type,is_unicode_sms,no_of_messages from campaigns where campaign_id in ($campaign_ids)");
	while($campaign_details_val = $campaign_details_rs->fetch_array(MYSQLI_ASSOC)) {
		
		$user_id = $campaign_details_val['user_id'];
		$campaign_id = $campaign_details_val['campaign_id'];
		$sender_name = $campaign_details_val['sender_name'];
		$sms_count = $campaign_details_val['sms_count'];
		$campaign_type = $campaign_details_val['campaign_type'];
		$is_unicode_sms = $campaign_details_val['is_unicode_sms'];
		$no_of_messages = $campaign_details_val['no_of_messages'];
		$shorturl_input = $campaign_details_val['long_url'];
		$shorturl_text = $campaign_details_val['shorturl_text'];
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
				$sms_text = trim($to_details_val['sms_text']);
				$sms_text = getShortCode($sms_text,$shorturl_text,$shorturl_input,$user_id,$campaign_id);
               			$sms_text1 = $mysqli->real_escape_string($sms_text);
               							$sms_text1 = trim($sms_text1);
				$findString = 'ion.bz/';
                         	$pos = stripos($sms_text1, $findString); 
				if($pos === false) {
					$short_code = FALSE;
				}else{
				$str = substr($sms_text1, $pos); 
  				$shortCode = substr($str, strlen($findString)); 
	 			$short_code = substr($shortCode, 0, 7); 
				}
				$short_code = trim($short_code);
				$to_mobile = $to_details_val['to_mobile_no'];
				$sms_text = trim($sms_text);
				
				 $splMessage = trim($sms_text);
				$special_char = array(',','.','-','!','&','’','_','#','(',')','<','>','%',':',';','.','?','*','+','-','/','&','∼','!','=',',','"','’','’');

				$sms_text_spl = str_replace($special_char, ' ', $splMessage); 


				$special_char_2 = array('{','}','[',']','^','|','€');
				$sms_text_spl2 = str_replace($special_char_2, '  ', $sms_text_spl); 

				if(strlen($sms_text_spl2)>160) 
					$sms_length_tmp=ceil(strlen($sms_text_spl2)/153);
				else
					$sms_length_tmp=ceil(strlen($sms_text_spl2)/160); 
		  
				 
				/*if(strlen($sms_text) > 160)	    
					$sms_length_tmp = ceil(strlen($sms_text)/153);
				else
					$sms_length_tmp = ceil(strlen($sms_text)/160);*/
			
				$smsLength = $sms_count; //$sms_length_tmp;     Changed on 2017-08-29 
				//mysql_query("insert into schedule_campaigns_to_bkup(campaign_id,to_mobile_no,sms_text) values('$campaign_id','$to_mobile','$sms_text1')");

                //check is block listed number?
                $is_invalid_no = 1;
                if(strlen($to_mobile)>7 and strlen($to_mobile)<=10 )	
                    	$is_invalid_no=0;
 
                   
                $blockedNumberRes = $mysqli->query("SELECT count(*) as blocked FROM sms.block_listed_numbers WHERE user_id = '$user_id' AND mobile_no = '{$to_mobile}'");
                $blockedNumberRow =  $blockedNumberRes->fetch_array(MYSQLI_ASSOC);
                $is_block_listed = $blockedNumberRow['blocked'];
 		 
                if($is_block_listed > 0){
                    $mysqli->query("insert into campaigns_to(campaign_id,user_id,sender_name,to_mobile_no,sms_text,sms_count,sent_on,dlr_status,error_text,short_url) values('$campaign_id','$user_id','$sender','$to_mobile','$sms_text1','$smsLength',now(),'2','Block Listed Number','$short_code')");
                } 
                elseif($is_invalid_no){
                   	  $mysqli->query("insert into campaigns_to(campaign_id,user_id, sender_name,to_mobile_no,sms_text,sms_count,sent_on,dlr_status,error_text,port_no,short_url) values('$campaign_id','$user_id','$sender','$to_mobile','$sms_text1','$smsLength',now(),'16','Invalid Number','$available_port','$short_code')");
						//$block_no_count++;
                    }
                
                else {  
                    if(!$ndnc['no_ndnc']){
                        //check for dnd number
                       	 $checkDndRes = $mysqli->query("SELECT count(*) as dndcount FROM dnd_db.ndnc_data WHERE dnc_number = '{$to_mobile}'");
                      
                       	 $checkDndRow = $checkDndRes->fetch_array(MYSQLI_ASSOC);
                       	 $isDND = $checkDndRow['dndcount'];
                       	 if($isDND > 0){
                            $mysqli->query("insert into campaigns_to(campaign_id,user_id,sender_name, to_mobile_no,sms_text,sms_count,sent_on,dlr_status,error_text,short_url) values('$campaign_id','$user_id','$sender','$to_mobile','$sms_text1','$smsLength',now(),'3','DND Number','$short_code')");
                            
                       	 } else {
                          	  $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=91$to_mobile&text=".urlencode($sms_text);
                           	$URL .= "$unicode_sms$mclass&dlr-mask=19&dlr-url=".urlencode(SERVER_NAME."/dlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");

                            	http_send($URL,$available_port);
                            	$mysqli->query("insert into campaigns_to(campaign_id,user_id,sender_name,to_mobile_no,sms_text,sms_count,sent_on,port_no,short_url) values('$campaign_id','$user_id','$sender','$to_mobile','$sms_text1','$smsLength',now(),'$available_port','$short_code')");
                            
                        }
                    } else {
                    	if($ndnc['dnd_check']){

				$checkDndRes = $mysqli->query("SELECT count(*) as dndcount FROM dnd_db.ndnc_data WHERE dnc_number = '{$to_mobile}'");
                      
                       	 	$checkDndRow = $checkDndRes->fetch_array(MYSQLI_ASSOC);
                        	$isDND = $checkDndRow['dndcount'];
                        	if($isDND > 0){
                            		$mysqli->query("insert into campaigns_to(campaign_id,user_id,sender_name,to_mobile_no,sms_text,sms_count,sent_on,dlr_status,error_text,short_url) values('$campaign_id','$user_id','$sender','$to_mobile','$sms_text1','$smsLength',now(),'3','DND Number','$short_code')");
                            
                     		  }else{
    					$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=91$to_mobile&text=".urlencode($sms_text);
     					$URL .= "$unicode_sms$mclass&dlr-mask=19&dlr-url=".urlencode(SERVER_NAME."/dlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");
                       			http_send($URL,$available_port);
                        		$mysqli->query("insert into campaigns_to(campaign_id,user_id,sender_name,to_mobile_no,sms_text,sms_count,sent_on,port_no,short_url) values('$campaign_id','$user_id','$sender','$to_mobile','$sms_text1','$smsLength',now(),'$available_port','$short_code')");                      

				}  
			}else{
           			$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=91$to_mobile&text=".urlencode($sms_text);
     				$URL .= "$unicode_sms$mclass&dlr-mask=19&dlr-url=".urlencode(SERVER_NAME."/dlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");
                        	http_send($URL,$available_port); 
                        	$mysqli->query("insert into campaigns_to(campaign_id,user_id,sender_name,to_mobile_no,sms_text,sms_count,sent_on,port_no,short_url) values('$campaign_id','$user_id','$sender','$to_mobile','$sms_text1','$smsLength',now(),'$available_port','$short_code')");
                      
                    	}
                }
			}
			 $mysqli->query("delete from schedule_campaigns_to where campaign_id='$campaign_id'");			
		}

	}
}	
 
} else {
    echo 'No Scheduled SMS Camapigns[ '.date("F j, Y, g:i a").' ]'. PHP_EOL;
}
  


function getShortCode($message,$shorturl_text,$shorturl_input,$userId,$campaign_id) { 
	global $mysqli;
	$shortInput = '';$getsendShorturl = ''; $shortUrl = 'http://ion.bz/';
	if($shorturl_input != NULL)    
	{
		$result1 = generateShortCode();
		$sendShorturl=$result1; 
		$getsendShorturl = $shortUrl."$sendShorturl"; 
		$mysqli->query("INSERT INTO shorturl_db.short_urls (long_url,user_id,short_code,date_created) VALUES('".$shorturl_input."','".$userId."','".$sendShorturl."','".date('Y-m-d')."')");

		$newsms_text = $message;
		$newshorturl_text = $shorturl_text;
		$newshorturl_text = str_replace("\n", "", $newshorturl_text);
		$newshorturl_text = str_replace("\n", "", $newshorturl_text);
		$newshorturl_text = str_replace("\t", "", $newshorturl_text);
		$newshorturl_text = str_replace("\r", "", $newshorturl_text);

		$message = str_replace($newshorturl_text, "$getsendShorturl", $newsms_text);   
	}else{
		$findString = 'ion.bz/';
		$pos = stripos($message, $findString); 
		if($pos === false) {
			$shortInput = FALSE;
		}else{
			$str = substr($message, $pos); 
			$shortCode = substr($str, strlen($findString)); 
			$short_code = substr($shortCode, 0, 7);
			$shortUrlInput = $mysqli->query("SELECT long_url FROM shorturl_db.short_urls WHERE short_code = '".trim($short_code)."'");
			if($shortUrlInput->num_rows > 0) {

					$shortUrlInputRes = $shortUrlInput->fetch_array(MYSQLI_ASSOC);
					$shorturl_input = $shortInput = $shortUrlInputRes['long_url'];		
		
			}
		}
		if($shortInput) {
			$result1 = generateShortCode();
			$sendShorturl=$result1;  

			$getsendShorturl=$shortUrl."$result1";   

			$mysqli->query("INSERT INTO shorturl_db.short_urls (long_url,user_id,short_code,date_created) VALUES('".$shorturl_input."','".$userId."','".$sendShorturl."','".date('Y-m-d')."')");
			$newsms_text= $message;		  	 

			$newshorturl_text=$shortUrl."$short_code"; 
			$newshorturl_text = str_replace("\n", "", $newshorturl_text);
			$newshorturl_text = str_replace("\t", "", $newshorturl_text);
			$newshorturl_text = str_replace("\r", "", $newshorturl_text);

			  $message = str_replace($newshorturl_text, "$getsendShorturl", $newsms_text); 
		}  

	}
	if($shorturl_input != NULL) {
		 $findString = 'ion.bz/';
		$pos = stripos($message, $findString); 
		if($pos === false) {
			$shortInput = FALSE;  
		}else{
			$str = substr($message, $pos); 

			$shortCode = substr($str, strlen($findString)); 
			$short_code = substr($shortCode, 0, 7); 
		}    
		$getsendShorturl=$shortUrl."$short_code"; 
		$mysqli->query("UPDATE campaigns SET sms_text= '".$message."' ,long_url ='".$shorturl_input."',shorturl_text = '".$getsendShorturl."' WHERE campaign_id = '".$campaign_id."'"); 
	}   
	return trim($message);
}  
  


/*** CHECK SHORTCODE ALREADY EXISTS ,By Saisandeepthi,2017_05_05 ***/
function generateShortCode() { 			
	global $mysqli;
	$codeExists = 0; 
	$n = 1;
	for($i=0;$i<$n;$i++) {   
		$shortCode =  substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 7);
		//$result = $this->Campaign_model->checkCodeExists($shortCode);
		$shortCode = trim($shortCode);
		$query = $mysqli->query("SELECT id FROM shorturl_db.short_urls WHERE short_code = '".$shortCode."'");
		if($query->num_rows > 0) {
			$result = 0;   
		}else{  
			$result = 1;  
		}  

		if($result == 1) {
			$codeExists = 1;    
			$n = 0;break;  
		}else{  
			$codeExists = 0;   
		}                 
		     
		$n++;          
	}      
	if($codeExists == 1) {
		return  $shortCode;      
	}else{
		return  substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 7);  
	}
}


$mysqli->close();
