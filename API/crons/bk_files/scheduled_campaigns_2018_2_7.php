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
	$campaign_details_rs = $mysqli->query("select user_id,campaign_id,sender_name,sms_text,sms_count,long_url,shorturl_text,campaign_type,is_unicode_sms,no_of_messages,phone_nos_count from campaigns where campaign_id in ($campaign_ids)");
	while($campaign_details_val = $campaign_details_rs->fetch_array(MYSQLI_ASSOC)) {
		
		$user_id = $campaign_details_val['user_id'];
		$campaign_id = $campaign_details_val['campaign_id'];
		$sender_name = $campaign_details_val['sender_name'];
		$sms_count = $campaign_details_val['sms_count'];
		$campaign_type = $campaign_details_val['campaign_type'];
		$is_unicode_sms = $campaign_details_val['is_unicode_sms'];
		$no_of_messages = $campaign_details_val['no_of_messages'];
		$campaignLength = $campaign_details_val['phone_nos_count'];
		$shorturl_input = $campaign_details_val['long_url'];
		$shorturl_text = $campaign_details_val['shorturl_text'];
		$mclass = "";
		if($campaign_type == 1) 
			$mclass = "&mclass=0";
        $unicode_sms = "";
		if($is_unicode_sms) 
			$unicode_sms = "&coding=2&charset=utf-8"; // for unicode string
		$getRes = $mysqli->query("select no_ndnc,dnd_check,International,AllowedCountry from users where user_id='$user_id'");		
		$ndnc = $getRes->fetch_array(MYSQLI_ASSOC);
		$dnd_check_transuser = $ndnc['dnd_check'];
		$isInternational = $ndnc['International']; 
		$allowedCountry = $ndnc['AllowedCountry']; 
        //sender names
        if($ndnc['no_ndnc'] == 1 && $dnd_check_transuser!=1){
            //loop Transactional SMPP
            $portType = "LT2";

            //$sender = "LM-".$sender_name;
			 $sender = $sender_name;
$portTypeNAS = 'NAST2';
            //$portType = "ST2";
            //$sender = $sender_name;

        } elseif($ndnc['no_ndnc'] == 0){
            //loop Promo SMPP
            //$sender = "LM-".$sender_name;
	//$sender = $sender_name;
	$sender = "STRIKR";

            $portType = "LP2";
$portTypeNAS = 'NASP2';
            //$portType = "SP2";
            //$sender = $sender_name;
        } elseif($ndnc['no_ndnc'] == 2){ //Vf transactional
            $portType = "VT2";$portTypeNAS = 'NAST2';
            $sender = $sender_name;
        }
 elseif($ndnc['no_ndnc'] == 1 && $dnd_check_transuser==1){ //Semi trans
            $portType = "LS2";
            $sender = $sender_name;
            $portTypeNAS = 'NASP2';
        }
 	
	/*$getQueryRes = $mysqli->query("SELECT sending_port_no FROM sms_queue where application_priority='$portType' order by queued, sent asc limit 1");
        $available_port_val = $getQueryRes->fetch_array(MYSQLI_ASSOC);
        $available_port = $available_port_val['sending_port_no'];*/
		
	$availablePorts = array();
	$activePorts = getActivePortNumbers(); 
	$available_port_val = $mysqli->query("SELECT sending_port_no FROM sms_queue where application_priority='$portType' AND port_no IN ($activePorts) ORDER BY queued, sent ASC  ");
 	while($available_ports = $available_port_val->fetch_array(MYSQLI_ASSOC)) {
		$availablePorts[] = $available_ports['sending_port_no'];
	}

	if($user_id == 578) {
		$availablePorts = array(48113,48213);
	} 
	
	if($user_id == 880) {
			$availablePorts = array(47513);
		} 

	$totalPorts = count($availablePorts);  
	$kennelLength  = ceil($campaignLength/$totalPorts);		
        if($user_id == 5813) {
		$CountryRoute = array("971" => "33013");
	}else{
		$CountryRoute = array("971" => "33013","91" => "33013","972" => "33013","971" => "33013","968" => "33013","966" => "33013","974" => "33013","90" => "33013","973" => "33013","962" => "33013","965" => "33013","60" => "33013","95" => "33013","63" => "33013","65" => "33013","84" => "33013","62" => "33013" ,"1" => "33013");
	}      
	
	  $isValidSenderName = TRUE;
	if($ndnc['no_ndnc'] == 1){
	$checkSenderName = $mysqli->query("SELECT * FROM sender_names WHERE user_id = '".$user_id."' AND sender_name = '".trim($sender)."' AND status = 1 ");
$sms_port ='';
 	if($checkSenderName->num_rows > 0) { 
		$isValidSenderName = TRUE;  
	}else{
		$isValidSenderName = FALSE;   
		
		$getNASPortNumber = $mysqli->query("SELECT sending_port_no FROM sms_queue WHERE application_priority = '$portTypeNAS'");
    		if($getNASPortNumber->num_rows > 0) {
    			$getNASPortNumberRes = $getNASPortNumber->fetch_array();
    			$sms_port = $getNASPortNumberRes['sending_port_no'];
    		}	
	}  
	}
	     				
		$to_details_rs = $mysqli->query("select sms_text,to_mobile_no from schedule_campaigns_to where campaign_id='$campaign_id'");
		if($to_details_rs->num_rows > 0) 
		{
			$no_of_messages_tmp=100;$campaignProcessedLength = 0;$portIndex = 0;
			$available_port = $availablePorts[$portIndex];
			while($to_details_val =  $to_details_rs->fetch_array(MYSQLI_ASSOC))
			{
				if($user_id == 5874) { // campapsrtc
				  	 $available_port = 46213;
				}else{ 
					if($portIndex < $totalPorts) {
						if($campaignProcessedLength == $kennelLength) {
							$portIndex++;
							$campaignProcessedLength = 0;
							$available_port = $availablePorts[$portIndex];
						}
					}  
				}
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
               if($isInternational == 1) {		
			if((strlen($to_mobile) >= 6 and strlen($to_mobile) <= 16)) {
				if(strcmp($allowedCountry,"*") == 0){
					 $is_invalid_no = 0;
				}else{  
					  $str1 = "|".substr($to_mobile, 0, 4)."|";
					  $str2 = "|".substr($to_mobile, 0, 3)."|";
					  $str3 = "|".substr($to_mobile, 0, 2)."|";
					  $str4 = "|".substr($to_mobile, 0, 1)."|";

					$pos1 = strpos($allowedCountry,$str1); 
					$pos2 = strpos($allowedCountry,$str2); 
					$pos3 = strpos($allowedCountry,$str3); 
					$pos4 = strpos($allowedCountry,$str4); 

					if($pos1 || $pos2 || $pos3 || $pos4){
						$is_invalid_no = 0;
					} 
				}
			}

			if(isset($CountryRoute[substr($to_mobile, 0, 4)])) $available_port = $CountryRoute[substr($to_mobile, 0, 4)];
			elseif(isset($CountryRoute[substr($to_mobile, 0, 3)])) $available_port = $CountryRoute[substr($to_mobile, 0, 3)];
			elseif(isset($CountryRoute[substr($to_mobile, 0, 2)])) $available_port = $CountryRoute[substr($to_mobile, 0, 2)];
			elseif(isset($CountryRoute[substr($to_mobile, 0, 1)])) $available_port = $CountryRoute[substr($to_mobile, 0, 1)];
			else $available_port = "32013"; 

		}else{ 

		      if(strlen(trim($to_mobile))==10)
			{
				if($to_mobile[0]=='6' or $to_mobile[0]=='7' or $to_mobile[0]=='8' or $to_mobile[0]=='9' )
				{
					$is_invalid_no=0;
				
				}else{
	 				$is_invalid_no=1;
				}
			
				//echo  $tmp_number."-valid";	
			}
 		}
  if(!$isValidSenderName) {
  			if($user_id == 5874) { // campapsrtc
				$available_port = 46213;
			} else{	$available_port = $sms_port; }
 
	}  
	if($user_id == 5857)  
{
	$available_port = 47213;  
}        
	
		$text1=$username.$sms_text1.$sender.$to_mobile;  

		$textmd5=md5($text1);      
		$checkContent = $mysqli->query("SELECT count(*) as duplicate FROM duplicatecheck WHERE md5text = '$textmd5'");
		$checkContentData = $checkContent->fetch_array(MYSQLI_ASSOC);
       		$is_duplicate = $checkContentData['duplicate'];
		if($is_duplicate == 0) {  
			$mysqli->query("INSERT INTO duplicatecheck (datetime,md5text) VALUES ('".date('Y-m-d H:i:s')."','".$textmd5."')");  
		}   
 
                   $is_duplicate = 0;
                $blockedNumberRes = $mysqli->query("SELECT count(*) as blocked FROM sms.block_listed_numbers WHERE user_id = '$user_id' AND mobile_no = '{$to_mobile}'");
                $blockedNumberRow =  $blockedNumberRes->fetch_array(MYSQLI_ASSOC);
                $is_block_listed = $blockedNumberRow['blocked'];

     
 		if($is_duplicate > 0) {			 
		 	 $mysqli->query("insert into campaigns_to(campaign_id,user_id,sender_name,to_mobile_no,sms_text,sms_count,sent_on,dlr_status,error_text,port_no,short_url) values('$campaign_id','$user_id','$sender','$to_mobile','$sms_text1','$smsLength',now(),'16','Duplicate Msg','$available_port','$short_code')");
  			 
		}elseif($is_block_listed > 0){
                    $mysqli->query("insert into campaigns_to(campaign_id,user_id,sender_name,to_mobile_no,sms_text,sms_count,sent_on,dlr_status,error_text,port_no,short_url) values('$campaign_id','$user_id','$sender','$to_mobile','$sms_text1','$smsLength',now(),'2','Block Listed Number','$available_port','$short_code')");
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
					
				if($isInternational == 1) {
					 $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=$to_mobile&text=".urlencode($sms_text);
		            	}else{
                          	  $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=91$to_mobile&text=".urlencode($sms_text);
				}
                           	$URL .= "$unicode_sms$mclass&dlr-mask=19&dlr-url=".urlencode(SERVER_NAME."/dlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");
				$campaignProcessedLength++;
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
					if($isInternational == 1) {
						$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=$to_mobile&text=".urlencode($sms_text);
		            		}else{
    						$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=91$to_mobile&text=".urlencode($sms_text);	
					}
     					$URL .= "$unicode_sms$mclass&dlr-mask=19&dlr-url=".urlencode(SERVER_NAME."/dlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");
					$campaignProcessedLength++;
                       			http_send($URL,$available_port);
                        		$mysqli->query("insert into campaigns_to(campaign_id,user_id,sender_name,to_mobile_no,sms_text,sms_count,sent_on,port_no,short_url) values('$campaign_id','$user_id','$sender','$to_mobile','$sms_text1','$smsLength',now(),'$available_port','$short_code')");                      

				}       
			}else{
				if($isInternational == 1) {
					$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=$to_mobile&text=".urlencode($sms_text);
		            	}else{
           				$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=91$to_mobile&text=".urlencode($sms_text);
				}
     				$URL .= "$unicode_sms$mclass&dlr-mask=19&dlr-url=".urlencode(SERVER_NAME."/dlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");
				$campaignProcessedLength++;
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
  



/** Get Active Port Numbers **/

function getActivePortNumbers() {
	global $mysqli;  
 
	$portNums = $mysqli->query("SELECT DISTINCT port_no FROM sms_queue"); 
	$activePortNum = ''; 
	while($portNumsRes = $portNums->fetch_array())
	{  
		$port = $portNumsRes[0];  
		//$array[] = $port;
		$url = "http://182.18.139.110:$port/cgi-bin/status?password=ara111";
		$file = file_get_contents($url);
		$splt = explode("Status:",$file);
		$runstr = $splt[1];
		$runarr = explode("WDP",$runstr);
		$status = $runarr[0]; //Online Time 

		$splt2 = explode("SMS:",$file);
		$Qstr = $splt[1];

		$qarr = explode("SMS:",$Qstr);
		$a = $qarr[1];
		$arr = explode("(",trim($a));
		$b = explode("queued",$arr[2]);
		$quesms = $b[0]; //Queued 
		$c = explode("store size",$b[1]);
		$storesize = $c[1];  //Store Size  
		$d = explode("Box connections:",$runstr);  //Box connections
	  
		$boxarr = explode("SMSC connections:",$d[1]); 
		$smpponline = explode(":smpp (",$boxarr[1]);
	 
		$cnt = count($smpponline);
	 
		$offlinePorts = substr_count($boxarr[1], 'offline');
		if($offlinePorts == 0) {  
			$activePortNum .= $port.' ,';	 
		} 
	} 
	$activePortNum = rtrim($activePortNum,',');
	return $activePortNum;
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
