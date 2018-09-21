<?php  

 include("/var/www/html/strikerapp/API/dbconnect/config.php");  
 $shortUrl = 'http://ion.bz/';
 global $mysqli;

  
  
$table_count = 1;  $userId = 6371;$campaign_id=1748553;$sender='PZKART';$campaignLength=63127;
  
immediateCampaign($table_count,$userId,$campaign_id,$sender,$campaignLength);
					 
   
    
function get_unique()
{
	global $mysqli;
 	$msg_c = ''; 
	$set_msg = 'set @u:= hex(uuid())'; 
	$q = $mysqli->query($set_msg); 
	//print_r($q);
	if($q) 
	{
		$msg_str = "select concat(substr(@u,7,4),'-',substr(@u,5,4), '-', substr(@u,1,4),'-', substr(@u,9,4) ) as unique_no";
		$res = $mysqli->query($msg_str); 
		$msg_carr = $res->fetch_array(); 
		if(isset($msg_carr['unique_no']))

			$msg_c = $msg_carr['unique_no']; 
		return $msg_c; 
	}	
	return $msg_c;
}  


  


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

   
function immediateCampaign($count,$userId,$campaign_id,$sender,$campaignLength)   
{	


	 include("/var/www/html/strikerapp/smslib/config.inc");
	 include("/var/www/html/strikerapp/smslib/functions.inc");
   
	global $mysqli; 
	$userquery = $mysqli->query("select no_ndnc,dnd_check,available_credits,International,AllowedCountry from users where user_id = '".$userId."' "); 
	$ndnc = $userquery->fetch_array(MYSQLI_ASSOC);  
	$no_ndnc = $ndnc['no_ndnc'];  
	$dnd_check = $ndnc['dnd_check']; 
	$allowedCountry = $ndnc['AllowedCountry']; 
	$isInternational = $ndnc['International']; 
	$user_available_credits = TRUE;//$ndnc['available_credits']; 
 $date = date('Y-m-d');
	//$unicode_sms = "&coding=2&charset=utf-8";  
	//$unicode_sms = '';    
	$unicode_sms = "&charset=ASCII";
	$userCredits = FALSE;
	//$mclass = "&mclass=1"; 
	$mclass ="&mclass=''";        
	$userActType = array();
	$userActType = array(array($no_ndnc,$dnd_check));
	$semi = array();
	$semi = array(1,1);   
	$tran = array(1,0);    
	$promo = array(0,0);   
	$promo2 = array(0,1);     
switch ($userActType)
	{  // Account type switch start
	case in_array($semi,$userActType) :

	$portType = "LS2"; // semi trans
	$portTypeNAS = 'NASP2';
	break;
	case in_array($tran,$userActType):  

	$portType = "LT2"; // trans
	$portTypeNAS = 'NAST2';
	break;
	case (in_array($promo,$userActType) || in_array($promo2,$userActType)):

	$portType = "LP2"; // promo
		$portTypeNAS = 'NASP2';
	break; 
	}    
 
	//$getUserTotalCredits = $mysqli->query("SELECT no_of_messages FROM campaigns WHERE campaign_id = '".$campaign_id."' AND user_id = '".$userId."'");	 
 	//$getUserTotalCreditsRes = $getUserTotalCredits->fetch_array(MYSQLI_ASSOC);
	//$totalCredits = $getUserTotalCreditsRes['no_of_messages'];  
 	//$deduct_user_credits = 0;

	/*$available_port_val = $mysqli->query("SELECT sending_port_no FROM sms_queue where application_priority='$portType' order by queued, sent asc limit 1");
	$available_port = $available_port_val->fetch_array(MYSQLI_ASSOC);
	$available_port = $available_port['sending_port_no'];  */

	$availablePorts = array();
	$activePorts = getActivePortNumbers(); 
	$available_port_val = $mysqli->query("SELECT sending_port_no FROM sms_queue where application_priority='$portType' AND port_no IN ($activePorts) ORDER BY queued, sent ASC  ");
 	while($available_ports = $available_port_val->fetch_array(MYSQLI_ASSOC)) {
		$availablePorts[] = $available_ports['sending_port_no'];
	}
 	if($userId == 5874) {
		$availablePorts = array(37513);
	} 
	
	if($userId == 250) {
		$availablePorts = array(34113);
	} 
        if($userId == 6116) {
                $availablePorts = array(36113);
        }
	
	/*if($userId == 578) {
		$availablePorts = array(48113,48213);
	} 
	
	if($userId == 880 ) {
		$availablePorts = array(47513);
	} 
	$sender = trim($sender);
	if($sender == 'JOBSTP') {
		$availablePorts = array(47513);
	}*/
	   
	 $totalPorts = count($availablePorts);       // Active port numbers count
	 $kennelLength  = ceil($campaignLength/$totalPorts);        // Campaign length for each port number
	if($userId == 5813) {
		$CountryRoute = array("971" => "33013");
	}else{
		$CountryRoute = array("971" => "33013","91" => "33013","972" => "33013","971" => "33013","968" => "33013","966" => "33013","974" => "33013","90" => "33013","973" => "33013","962" => "33013","965" => "33013","60" => "33013","95" => "33013","63" => "33013","65" => "33013","84" => "33013","62" => "33013" ,"1" => "33013");
	}

 
	$isValidSenderName = TRUE;
	 
	if($no_ndnc == 1) {
	$checkSenderName = $mysqli->query("SELECT * FROM sender_names WHERE user_id = '".$userId."' AND sender_name = '".trim($sender)."' AND status = 1 ");
$sms_port = '';

 
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
	
	

	if($count == 0) { 
		$mysqli->query("update campaigns set campaign_status = 2  where campaign_id='$campaign_id'");
		return true;
	}else{	 
	    for($i=1;$i<=$count;$i++) {
		$table_name = 'sms_customized.schedule_campaigns_to_'.$campaign_id.'_'.$i; 
		$no_of_messages = 0;   
		$campaign_rs = $mysqli->query("select * FROM $table_name "); 

		if($campaign_rs->num_rows > 0 )   
		{
			$no_of_messages = $campaign_rs->num_rows;  
			$no_of_messages_tmp = 0;  
			  
	 		$insertQuery="insert into campaigns_to  (campaign_id,unique_msg_id,user_id,sender_name,to_mobile_no,sms_text,sms_count,sent_on,dlr_status,error_text,port_no,short_url) values "; 
			$values="";
			$offset=0;     
			$campaignProcessedLength = 0;$portIndex = 0;
			while($campaign_details_val = $campaign_rs->fetch_array(MYSQLI_ASSOC))  
			{	
				 
				//if($userId==5082 || ($userId==250 && $sender!='BALAJI')){ // BALAJI MARKET AND SANDEEP TEST
					//$available_port= $available_port;
				//}else{
					$available_port = $availablePorts[$portIndex];
				 	if($portIndex < $totalPorts) {  
						// Checking number of processed campaigns length
						if($campaignProcessedLength == $kennelLength) {
							$portIndex++;
							$campaignProcessedLength = 0;
							
							// Assigning port number from array
							$available_port = $availablePorts[$portIndex];
						}
					}    
 				//}	  
				$no_of_messages_tmp++;  
				$campaign_id = $campaign_details_val['campaign_id'];
				$unique_msg_id = $campaign_details_val['unique_msg_id'];
				$sms_text = trim($campaign_details_val['sms_text']);
				$findString = 'ion.bz/';
                         	$pos = stripos($sms_text, $findString); 
 
				if($pos === false) {  
					$short_code = FALSE;
				}else{

					$str = substr($sms_text, $pos); 
  					$shortCode = substr($str, strlen($findString)); 
	 				$short_code = substr($shortCode, 0, 7);
				} 
				$to_mobile = $campaign_details_val['to_mobile_no'];
				$sms_text1 = $mysqli->real_escape_string($sms_text);
				$sms_text = trim($sms_text);
				/*if(strlen($sms_text) > 160)	    
					$sms_length_tmp = ceil(strlen($sms_text)/153);
				else
					$sms_length_tmp = ceil(strlen($sms_text)/160);*/
					
					
				 $splMessage = trim($sms_text);  
				$special_char = array(',','.','-','!','&','’','_','#','(',')','<','>','%',':',';','.','?','*','+','-','/','&','∼','!','=',',','"','’','’');

				$sms_text_spl = str_replace($special_char, ' ', $splMessage); 
  
  
				$special_char_2 = array('{','}','[',']','^','|','€','~');
				$sms_text_spl2 = str_replace($special_char_2, '  ', $sms_text_spl); 

				if(strlen($sms_text_spl2)>160)
					$sms_length_tmp=ceil(strlen($sms_text_spl2)/153);
				else
					$sms_length_tmp=ceil(strlen($sms_text_spl2)/160);	 
			
				$smsLength = $sms_length_tmp;
				$blockedNumberRes = $mysqli->query("SELECT count(*) as blocked FROM sms.block_listed_numbers WHERE user_id = '$userId' AND mobile_no = '{$to_mobile}'");
				$blockedNumberRow = $blockedNumberRes->fetch_array(); 
				$is_block_listed = $blockedNumberRow['blocked'];  
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
					if(strlen($to_mobile) > 7 && strlen($to_mobile) <= 10 )	
						$is_invalid_no = 0;
		   		}
  
  				 if(!$isValidSenderName) { $available_port = $sms_port; }
				
 
 				 $senderName_kennel = $sender;
				 if($available_port > 0) {
				 	$getPortType = $mysqli->query("SELECT sending_port_no FROM sms_queue where sending_port_no = '".$available_port."' AND used_for = 'BSNL' "); 
				 	if($getPortType->num_rows > 0)  
					{  
					 	if($ndnc['no_ndnc'] == 0) {
							$senderName_kennel = "BA-611128";
						}else{	
					 		$senderName_kennel = "BA-".$sender;
					 	}
				 	}  
				 
				 }   
 
 				
  
				if($is_block_listed > 0)
				{    
					$values .= "('$campaign_id','$unique_msg_id','$userId','$sender','$to_mobile','$sms_text1','$smsLength',now(),'2','Block Listed Number','$available_port','$short_code'),";  
				}elseif($is_invalid_no)
				{								
					$values .= "('$campaign_id','$unique_msg_id','$userId','$sender','$to_mobile','$sms_text1','$smsLength',now(),'16','Invalid Number','$available_port','$short_code'),"; 
				} 
				else {  
	 
					if(!$ndnc['no_ndnc'])
					{
						//Promotional Type 
						$checkDndRes = $mysqli->query("SELECT count(*) as dnd FROM dnd_db.ndnc_data WHERE dnc_number = '{$to_mobile}'");
						$checkDndRow = $checkDndRes->fetch_array();
						$isDND = $checkDndRow['dnd'];
						if($isDND > 0)
						{

							$values .= "('$campaign_id','$unique_msg_id','$userId','$sender','$to_mobile','$sms_text1','$smsLength',now(),'3','DND Number','$available_port','$short_code'),"; 
						} else {
							if($isInternational == 1) {
								 $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($senderName_kennel)."&to=$to_mobile&text=".urlencode($sms_text);
							}else{
								 $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($senderName_kennel)."&to=91$to_mobile&text=".urlencode($sms_text);
							}
 							// if($user_available_credits > 0) {
								 
								$URL .= "$unicode_sms$mclass&dlr-mask=19&dlr-url=".urlencode(SERVER_NAME."/dlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T&sms_port=$available_port");
								error_log($sms_text."\r\n",3,CAMPRETURNCREDITS."/kanelLogs".$date.".log");      
								$campaignProcessedLength++;
								http_send($URL,$available_port);
	 						 
	 						//}
	 						$values .= "('$campaign_id','$unique_msg_id','$userId','$sender','$to_mobile','$sms_text1','$smsLength',now(),'0','NULL','$available_port','$short_code'),";
						}  
					} else {     
					if($ndnc['dnd_check'])
					{
						//Semi Transactional Type 				
 $checkDndRes = $mysqli->query("SELECT count(*) as dnd FROM dnd_db.ndnc_data WHERE dnc_number = '{$to_mobile}'");
						$checkDndRow = $checkDndRes->fetch_array();
						$isDND = $checkDndRow['dnd'];
						if($isDND > 0)
						{  

							$values .= "('$campaign_id','$unique_msg_id','$userId','$sender','$to_mobile','$sms_text1','$smsLength',now(),'3','DND Number','$available_port','$short_code'),"; 
						}else{
							if($isInternational == 1) {
								$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($senderName_kennel)."&to=$to_mobile&text=".urlencode($sms_text);
							}else{
						// if($user_available_credits > 0) {
							 $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($senderName_kennel)."&to=91$to_mobile&text=".urlencode($sms_text);
					}
							$URL .= "$unicode_sms$mclass&dlr-mask=19&dlr-url=".urlencode(SERVER_NAME."/dlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T&sms_port=$available_port");
							error_log($sms_text."\r\n",3,CAMPRETURNCREDITS."/kanelLogs".$date.".log");      							$campaignProcessedLength++;
	 						 http_send($URL,$available_port);
						//}    
						 
						$values .=   "('$campaign_id','$unique_msg_id','$userId','$sender','$to_mobile','$sms_text1','$smsLength',now(),'0','NULL','$available_port','$short_code'),";
} 
}else {

if($isInternational == 1) {
								$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($senderName_kennel)."&to=$to_mobile&text=".urlencode($sms_text); 
							}else{
		//Transactional Type
		// if($user_available_credits > 0) {
			$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($senderName_kennel)."&to=91$to_mobile&text=".urlencode($sms_text);  }

			$URL .= "$unicode_sms$mclass&dlr-mask=19&dlr-url=".urlencode(SERVER_NAME."/dlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T&sms_port=$available_port");

			error_log($sms_text."\r\n",3,CAMPRETURNCREDITS."/kanelLogs".$date.".log"); 
			$campaignProcessedLength++;     
		http_send($URL,$available_port);
		// }
      

		$values .=   "('$campaign_id','$unique_msg_id','$userId','$sender','$to_mobile','$sms_text1','$smsLength',now(),'0','NULL','$available_port','$short_code'),";  
					}				
	 
					}     
				}  
				$offset++;  
				if($offset == 3000)
				 {								
					 $values = substr($values,0,strlen($values)-1);  
					echo  $final_query = $insertQuery." ".$values;  echo "</br>";
					 $mysqli->query($final_query); 
					 $offset = 0;            
					 $values = "";     
	 
				}  
				
     				//$user_available_credits = $user_available_credits - $sms_length_tmp;
				//$deduct_user_credits = $deduct_user_credits+$sms_length_tmp;
			  
			}
			//if($user_available_credits < 0) { $user_available_credits = 0; } 

			// $mysqli->query("update users set available_credits = '".$user_available_credits."' where user_id='$userId'");  
 
			   
			if($offset > 0)           
			{       
				// "remaining records ";
				$values=substr($values,0,strlen($values)-1);
			 	echo $final_query=$insertQuery." ".$values;  echo "</br>"; 
				$mysqli->query($final_query);       

			}   
			
			
			if($no_of_messages_tmp == $no_of_messages)  
			{
	 
			  	$mysqli->query("DROP TABLE $table_name");  
			  	    
			}      
	     
		}else{  
			$mysqli->query("DROP TABLE $table_name");
		}   
  
	  }  
	$mysqli->query("update campaigns set campaign_status = 2  where campaign_id='$campaign_id'");
     }	   		
 
}			  
   	 

function sms_alert($uname,$total_no_of_sms,$campaign_id){
	$user=SMS_ALERT_USER; //your username
	$password=SMS_ALERT_PWD; //your password
	$message = "Large Campaign Alert. From User $uname, Campaign ID:$campaign_id and Total Campaign Size : $total_no_of_sms"; //enter Your Message

	$senderid=SMS_ALERT_SENDERID; //Your senderid
	$messagetype="1"; //Type Of Your Message  
	$url=CALL_SMS_API;    
  
	$message = urlencode($message);
	$ch = curl_init();  
	if (!$ch){ die("Couldn't initialize a cURL handle"); }   
	$ret = curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt ($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
	//curl_setopt ($ch, CURLOPT_POSTFIELDS,
	//"username=$user&password=$password&to=$mno&msg=$message&from=$senderid&type=$messagetype");
 
	curl_setopt ($ch, CURLOPT_POSTFIELDS,
	"username=$user&password=$password&to=".SMS_ALERT_TO."&msg=$message&from=$senderid&type=$messagetype");

	$ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  
	$curlresponse = curl_exec($ch); // execute
}
	//echo "end";



 


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



 

?>
