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
	
    $campaign_details_rs = $mysqli->query("select user_id,campaign_id,campaign_name,sender_name,sms_text,sms_count,campaign_type,is_unicode_sms,long_url,shorturl_text,no_of_messages,phone_nos_count from campaigns where campaign_id in ($campaign_ids)");
	while($campaign_details_val = $campaign_details_rs->fetch_array(MYSQLI_ASSOC)) 
	{

		$user_id = trim($campaign_details_val['user_id']);
		$campaign_id = $campaign_details_val['campaign_id'];
		$campaign_name = trim($campaign_details_val['campaign_name']);
		$sender_name = $campaign_details_val['sender_name'];
		$sms_count = $campaign_details_val['sms_count'];
		$sms_type = $campaign_details_val['campaign_type'];
		$is_unicode_sms = $campaign_details_val['is_unicode_sms'];
		$no_of_messages = $campaign_details_val['no_of_messages'];
		$phone_nos_count = $campaign_details_val['phone_nos_count'];
		$shorturl_input = $campaign_details_val['long_url'];
		$shorturl_text = $campaign_details_val['shorturl_text'];
		$short_code = '';
		$mclass = "";
		if($sms_type == 1) 
			$mclass = "&mclass=0"; 
		$unicode_sms = "";
		if($is_unicode_sms) 
			$unicode_sms = "&coding=2&charset=utf-8"; // for unicode string
		$ndnc = $mysqli->query("select username,no_ndnc,dnd_check,International,AllowedCountry from users where user_id='$user_id'");
		$ndnc = $ndnc->fetch_array(MYSQLI_ASSOC);
	
	$dnd_check_transuser = $ndnc['dnd_check'];
		$username = $ndnc['username'];
	$isInternational = $ndnc['International'];  
		$allowedCountry = $ndnc['AllowedCountry']; 
	    if($ndnc['no_ndnc'] == 1 && $dnd_check_transuser!=1){
	    $portTypeNAS = 'NAST2';
            //loop Transactional SMPP
            $portType = "LT2";
            //$sender = "LM-".$sender_name;
			 $sender = $sender_name;
           
        } elseif($ndnc['no_ndnc'] == 0){
            //loop Promo SMPP
            $portType = "LP2";
 
            //$sender = "LM-".$sender_name;
			$sender = $sender_name;
        } elseif($ndnc['no_ndnc'] == 2){ //solutions infini transactional
            $portType = "ST1";
            $sender = $sender_name;
            $portTypeNAS = 'NAST2';
        }
        if($ndnc['no_ndnc'] == 1 && $dnd_check_transuser==1){
			
			$sender = $sender_name;
			$portType = "LS2";
			$portTypeNAS = 'NASP2';
		}
		
		
		
		$available_port_val = $mysqli->query("SELECT sending_port_no FROM sms_queue where application_priority='$portType' order by queued, sent asc limit 1");
		$available_port_val = $available_port_val->fetch_array(MYSQLI_ASSOC);
		$available_port = $available_port_val['sending_port_no'];
 

	
   
  
  if($user_id=='4130')
{
	 $available_port = 0;
}

if($user_id == 5874) { // campapsrtc
 	 $available_port = 46213;
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
  				$sms_text = getShortCode($sms_text,$shorturl_text,$shorturl_input,$user_id,$campaign_id);
                		$sms_text1 = $mysqli->real_escape_string($sms_text); 
				$findString = 'ion.bz/';
                         	$pos = stripos($sms_text1, $findString); 
				if($pos === false) {
					$short_code = FALSE;
				}else{
				$str = substr($sms_text1, $pos); 
  				$shortCode = substr($str, strlen($findString)); 
	 			$short_code = substr($shortCode, 0, 7); 
				}
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
		$camapignLength = $to_details_rs->num_rows;	

		$availablePorts = array();
		$activePorts = getActivePortNumbers(); 
		$available_port_val = $mysqli->query("SELECT sending_port_no FROM sms_queue where application_priority='$portType' AND port_no IN ($activePorts) ORDER BY queued, sent ASC  ");
	 	while($available_ports = $available_port_val->fetch_array(MYSQLI_ASSOC)) {
			$availablePorts[] = $available_ports['sending_port_no'];
		}
		if($user_id == 578) {
			$availablePorts = array(48113,48213);
		} 
	    
		$totalPorts = count($availablePorts);  
		$kennelLength  = ceil($camapignLength/$totalPorts);
		$isValidSenderName = TRUE;
		 if($ndnc['no_ndnc'] == 1 ){
		$checkSenderName = $mysqli->query("SELECT * FROM sender_names WHERE user_id = '".$user_id."' AND sender_name = '".trim($sender)."' AND status = 1 ");
  
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
	
		if($user_id == 5813) {

			$CountryRoute = array("971" => "33013");
		}else{
			$CountryRoute = array("971" => "33013","91" => "33013","972" => "33013","971" => "33013","968" => "33013","966" => "33013","974" => "33013","90" => "33013","973" => "33013","962" => "33013","965" => "33013","60" => "33013","95" => "33013","63" => "33013","65" => "33013","84" => "33013","62" => "33013" ,"1" => "33013");
		}
		if($camapignLength > 0) 
		{
			$insertQuery="insert into campaigns_to  (campaign_id,user_id,sender_name,to_mobile_no,sms_text,sms_count,sent_on,dlr_status,error_text,port_no,short_url) values ";
 			$values="";
 			$offset=0;	  
			$no_of_messages_tmp=100;$campaignProcessedLength = 0;$portIndex = 0; 
			
			// Users with Static Port Numbers
			$users = array('4130','1975',  '5874');
			while($to_details_val = $to_details_rs->fetch_array(MYSQLI_ASSOC))
			{
				 
				if(in_array($user_id, $users, true)) {   
					$available_port  = $available_port;
				}else{
					$available_port = $availablePorts[$portIndex];
					if($portIndex < $totalPorts) {
						if($campaignProcessedLength == $kennelLength) {
							$portIndex++;
							$campaignProcessedLength = 0;
							$available_port = $availablePorts[$portIndex];
						}
					}    
				}	
				     

 
				$no_of_messages_tmp++;
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
				$to_mobile = $to_details_val['to_mobile_no'];
				$sms_text = trim($sms_text);
				
				/*$splMessage =  trim($sms_text);
				$special_char = array(',','.','-','!','&','’','_','#','(',')','<','>','%',':',';','.','?','*','+','-','/','&','∼','!','=',',','"','’','’');

				$sms_text_spl = str_replace($special_char, ' ', $splMessage); 


				$special_char_2 = array('{','}','[',']','^','|','€');
				$sms_text_spl2 = str_replace($special_char_2, '  ', $sms_text_spl); */

				if(strlen($sms_text)>160)
					$sms_length_tmp=ceil(strlen($sms_text)/153);
				else
					$sms_length_tmp=ceil(strlen($sms_text)/160);   
				  	
				$smsLength = $sms_count;  // $sms_length_tmp;   Changed on 2017-08-29
				  
				/*if(strlen($sms_text) > 160)	    
					$sms_length_tmp = ceil(strlen($sms_text)/153);
				else
					$sms_length_tmp = ceil(strlen($sms_text)/160);*/
						  


			//mysql_query("insert into schedule_campaigns_to_bkup(campaign_id,to_mobile_no,sms_text) values('$campaign_id','$to_mobile','$sms_text1')");

                //check is block listed number?
                $blockedNumberRes = $mysqli->query("SELECT count(*) as blocked FROM sms.block_listed_numbers WHERE user_id = '$user_id' AND mobile_no = '{$to_mobile}'");
                $blockedNumberRow = $blockedNumberRes->fetch_array(MYSQLI_ASSOC);
                $is_block_listed = $blockedNumberRow['blocked'];
                $is_invalid_no = 1;
                //if(strlen($to_mobile)==10 )	
                    	//$is_invalid_no=0;

		
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
                 
			if($user_id=='4130') {
				$available_port = 0;
			}else if($user_id == 5874) { // campapsrtc
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

		if($is_duplicate > 0) {			 
  		$values.="('$campaign_id','$user_id','$sender','$to_mobile','$sms_text1','$smsLength',now(),'16','Duplicate Msg','$available_port','$short_code'),";
  			 
		}else  if($is_block_listed > 0){
                  
                     $values.="('$campaign_id','$user_id','$sender','$to_mobile','$sms_text1','$smsLength',now(),'2','Block Listed Number','$available_port','$short_code'),";
                }  elseif($is_invalid_no){
                    
                   	  
                   	  $values.="('$campaign_id','$user_id','$sender','$to_mobile','$sms_text1','$smsLength',now(),'16','Invalid Number','$available_port','$short_code'),";
                   	  
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
                           
                          $values.="('$campaign_id','$user_id','$sender','$to_mobile','$sms_text1','$smsLength',now(),'3','DND Number','$available_port','$short_code'),";  
                        } else {
                       	  $values.="('$campaign_id','$user_id','$sender','$to_mobile','$sms_text1','$smsLength',now(),'0','NULL','$available_port','$short_code'),";
			 	if($isInternational == 1) {
					 $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=$to_mobile&text=".urlencode($sms_text);
		            	}else{

                           	 	$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=91$to_mobile&text=".urlencode($sms_text);
			    	}
                            $URL .= "$unicode_sms$mclass&dlr-mask=19&dlr-url=".urlencode(SERVER_NAME."/dlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");
                         //  error_log("$URL"."\n",3,"/var/www/html/strikerapp/api_log/immediatedCampaigns/kennelUrl.log");
				$campaignProcessedLength++;
                            http_send($URL,$available_port);
                         
                           
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
                        
                          $values.="('$campaign_id','$user_id','$sender','$to_mobile','$sms_text1','$smsLength',now(),'3','DND Number','$available_port','$short_code'),";  
                        } else {
                          $values.="('$campaign_id','$user_id','$sender','$to_mobile','$sms_text1','$smsLength',now(),'0','NULL','$available_port','$short_code'),";

				if($isInternational == 1) {
					 $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=$to_mobile&text=".urlencode($sms_text);
		            	}else{
                            		$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=91$to_mobile&text=".urlencode($sms_text);
				   }
                            $URL .= "$unicode_sms$mclass&dlr-mask=19&dlr-url=".urlencode(SERVER_NAME."/dlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");
                        //   error_log("$URL"."\n",3,"/var/www/html/strikerapp/api_log/immediatedCampaigns/kennelUrl.log");
				$campaignProcessedLength++;
                            http_send($URL,$available_port); 
                          
                        } 
                      
                    }else{ // trans
  			$values.="('$campaign_id','$user_id','$sender','$to_mobile','$sms_text1','$smsLength',now(),'0','NULL','$available_port','$short_code'),";
			if($isInternational == 1) {
				 $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=$to_mobile&text=".urlencode($sms_text); 
		         }else{
                        	$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=91$to_mobile&text=".urlencode($sms_text);
			}
                        $URL .= "$unicode_sms$mclass&dlr-mask=19&dlr-url=".urlencode(SERVER_NAME."/dlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");
                     //  error_log("$URL"."\n",3,"/var/www/html/strikerapp/api_log/immediatedCampaigns/kennelUrl.log");
			$campaignProcessedLength++;
                        http_send($URL,$available_port);
                        
                       
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
				 // error_log($final_query."\n",3,"/var/www/html/strikerapp/api_log/immediatedCampaigns/query.log");
			}
			}// while loop end campaign numbers end
			
			if($offset>0)
			{
				// "remaining records ";
				$values=substr($values,0,strlen($values)-1);
				$final_query=$insertQuery." ".$values;
				$mysqli->query($final_query);
			   //error_log($final_query."\n",3,"/var/www/html/strikerapp/api_log/immediatedCampaigns/query.log");
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
 
} else {
	
    echo 'No Immediate SMS Camapigns[ '.date("F j, Y, g:i a").' ]'. PHP_EOL;
    
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
	  $shortUrl = 'http://ion.bz/';
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

?>
