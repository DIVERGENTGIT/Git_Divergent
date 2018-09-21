<?php  

  

 include("dbconnect/config.php");  
 $shortUrl = 'http://ion.bz/';
 echo 'WORKING............';
 /*
$table_name = "large_campaign_activities";
$sqlto=$mysqli->query("SELECT COUNT(*) AS COUNT FROM $table_name  WHERE status='0'");
$campaignto = $sqlto->fetch_array(MYSQLI_ASSOC);
 
if($campaignto['COUNT'] > 0)  
{ 	  
	 // select  large_campaign_activities_new which status is zero means new campaign every time 1
 	$rslt=$mysqli->query("SELECT * FROM $table_name  WHERE status='0' limit 1"); 
	if($rslt->num_rows > 0)
 
	{

		$data = $rslt->fetch_array(MYSQLI_ASSOC);
		$id = $data['id'];
		$userId = $data['user_id'];
		$campaign_id = $data['campaign_id'];
		$mobile_no_column = $data['mobile_no_column'];
		$sms_text = $data['sms_text'];		
		$is_schedule = $data['is_schedule'];
		$from_row = $data['from_row'];
		$to_row = $data['to_row'];  
		$totalnoofsms = $data['no_of_sms'];    
		//$original_file = "/var/www/vhosts/www.smsstriker.com/htdocs/".$data['file_path'];
		$original_file = "/var/www/html/strikerapp/uploads/".$data['file_path'];
		if(is_file($original_file)) 
		{  
			if(file_exists($original_file)) 
			{  
				$Filepath=$original_file;
				$filesize = intval(shell_exec("wc -l $Filepath"));
				$file_completepath1 = '';  
				$file_completepath2 = '';   
				$file_completepath3 = ''; 
				
				 
				date_default_timezone_set('UTC');
				$StartMem = memory_get_usage();
		      		if($campaign_id) 
		      		{

					//$mysqli->query("update $table_name set status='1' where id='".$id."'");
					$Spreadsheet = new SpreadsheetReader($Filepath);
					$BaseMem = memory_get_usage();
					$Sheets = $Spreadsheet->Sheets();					
					$i=0;$string = "";
					$maxrows=0;$maxcols=0;
					$var_positions_msg=explode("#",$sms_text);
					$varpositionscount=count($var_positions_msg);
					$data_array = array();
					$total_no_of_sms = 0;	
					if(!$mobile_no_column){$mobile_no_column=0;}
					if(!$sms_text){$sms_text=1;}				
					if(!$from_row){$from_row=2;}
					if($to_row > $filesize){$to_row=$filesize;}
					foreach ($Sheets as $Index => $Name)
					{
						$i = $from_row-1;
						$Spreadsheet->ChangeSheet($Index);
						foreach ($Spreadsheet as $Key => $Row)
						{
							
							if($i > $to_row) break;
							for($j = 0; $j < sizeof($Row); $j++) 
							{ 
								$uploded_data[$i][$j] = $Row[$j];
							}
 
							$i++;$maxrows++;

						}   
						break;    
					}
 					$process_table1 = 'sms_customized.schedule_campaigns_to_'.$campaign_id.'_1';   
				$process_table2 = 'sms_customized.schedule_campaigns_to_'.$campaign_id.'_2';   
				$process_table3 = 'sms_customized.schedule_campaigns_to_'.$campaign_id.'_3';
					if($maxrows <= 300000) {
						$mysqli->query("CREATE TABLE IF NOT EXISTS $process_table1 ( `campaign_id` int(11) DEFAULT NULL, `unique_msg_id` varchar(50) DEFAULT NULL, `sms_text` text CHARACTER SET utf8 COLLATE utf8_bin, `to_mobile_no` bigint(20) DEFAULT NULL, `created_on` datetime DEFAULT NULL ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");  
					}elseif($maxrows > 300000) {
						$mysqli->query("CREATE TABLE IF NOT EXISTS $process_table1 ( `campaign_id` int(11) DEFAULT NULL, `unique_msg_id` varchar(50) DEFAULT NULL, `sms_text` text CHARACTER SET utf8 COLLATE utf8_bin, `to_mobile_no` bigint(20) DEFAULT NULL, `created_on` datetime DEFAULT NULL ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
						$mysqli->query("CREATE TABLE IF NOT EXISTS $process_table2 ( `campaign_id` int(11) DEFAULT NULL, `unique_msg_id` varchar(50) DEFAULT NULL, `sms_text` text CHARACTER SET utf8 COLLATE utf8_bin, `to_mobile_no` bigint(20) DEFAULT NULL, `created_on` datetime DEFAULT NULL ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
					
					}else{
						$mysqli->query("CREATE TABLE IF NOT EXISTS $process_table1 ( `campaign_id` int(11) DEFAULT NULL, `unique_msg_id` varchar(50) DEFAULT NULL, `sms_text` text CHARACTER SET utf8 COLLATE utf8_bin, `to_mobile_no` bigint(20) DEFAULT NULL, `created_on` datetime DEFAULT NULL ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
						$mysqli->query("CREATE TABLE IF NOT EXISTS $process_table2 ( `campaign_id` int(11) DEFAULT NULL, `unique_msg_id` varchar(50) DEFAULT NULL, `sms_text` text CHARACTER SET utf8 COLLATE utf8_bin, `to_mobile_no` bigint(20) DEFAULT NULL, `created_on` datetime DEFAULT NULL ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
						$mysqli->query("CREATE TABLE IF NOT EXISTS $process_table3 ( `campaign_id` int(11) DEFAULT NULL, `unique_msg_id` varchar(50) DEFAULT NULL, `sms_text` text CHARACTER SET utf8 COLLATE utf8_bin, `to_mobile_no` bigint(20) DEFAULT NULL, `created_on` datetime DEFAULT NULL ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");
					}
					
					$path1 = "/var/lib/mysql-files/LoadData/load_data_".$campaign_id."_1.csv"; 
					$path2 = "/var/lib/mysql-files/LoadData/load_data_".$campaign_id."_2.csv"; 
					$path3 = "/var/lib/mysql-files/LoadData/load_data_".$campaign_id."_3.csv"; 
					if(file_exists($path1)) {
						unlink($path1); 
					} 
					if(file_exists($path2)) {
						unlink($path2); 
					} 
					if(file_exists($path3)) { 
						unlink($path3); 
					} 
 $getLongCodeText = $mysqli->query("SELECT long_url,shorturl_text FROM campaigns WHERE campaign_id = '".$campaign_id."'");
					$getLongCodeTextRes = $getLongCodeText->fetch_array(MYSQLI_ASSOC);
					$shorturl_input = $getLongCodeTextRes['long_url'];
					$shorturl_text = $getLongCodeTextRes['shorturl_text'];
					for($k=$from_row-1;$k<=$to_row;$k++) {  
  						$mobile_no = trim($uploded_data[$k][$mobile_no_column]);
 
						if(strlen($mobile_no)>0 && $mobile_no!=0)
						  {
						    $message = "";
						    for($j=0;$j<$varpositionscount;$j++) 
						        {
						        if($j%2 == 1) 
						            {
						            $colstringValue = $var_positions_msg[$j];
						            $colIndex = $colstringValue;
						            $message .= trim($uploded_data[$k][$colIndex]);
						            }
						        else 
						            {
						            $message .= $var_positions_msg[$j];
						            }
						        }
			 
                        if($shorturl_input != NULL)
								{
									$result1 = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 7); 
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
								}   
       
								 $message = preg_replace('/\s+/', ' ', $message);
							if(strlen($message)>160)	
							$sms_length_tmp=ceil(strlen($message)/153);
							else	$sms_length_tmp=ceil(strlen($message)/160);
							$sms_length=$sms_length_tmp;
							
							$unique_num = get_unique();  
							if($k <= 300000) {   
								 
								$datatoload = $campaign_id.",\"".$unique_num."\",".$message.",\"".$mobile_no."\",".date('Y-m-d H:i:s')."\n";         
								 $file_completepath1 = "/var/lib/mysql-files/LoadData/load_data_".$campaign_id."_1.csv";
								 error_log($datatoload,3,$file_completepath1);  // track the logs for file data and path
							}else if($k <= 600000) { 
								//$datatoload = $campaign_id.",\"".$message."\",".$mobile_no.",\"".date('Y-m-d H:i:s')."\"\n";
								//  $file_completepath2 = "/var/www/vhosts/www.smsstriker.com/htdocs/LoadData/load_data_".$campaign_id."_2.csv";
								$datatoload = $campaign_id.",\"".$unique_num."\",".$message.",\"".$mobile_no."\",".date('Y-m-d H:i:s')."\n";         
								 $file_completepath2 = "/var/lib/mysql-files/LoadData/load_data_".$campaign_id."_2.csv";
								 error_log($datatoload,3,$file_completepath2);  // track the logs for file data and path
							}else { 
								//$datatoload = $campaign_id.",\"".$message."\",".$mobile_no.",\"".date('Y-m-d H:i:s')."\"\n";
								  //$file_completepath3 = "/var/www/vhosts/www.smsstriker.com/htdocs/LoadData/load_data_".$campaign_id."_3.csv"; 
								  $datatoload = $campaign_id.",\"".$unique_num."\",".$message.",\"".$mobile_no."\",".date('Y-m-d H:i:s')."\n";         
								  $file_completepath3 = "/var/lib/mysql-files/LoadData/load_data_".$campaign_id."_3.csv";  
								 error_log($datatoload,3,$file_completepath3);  // track the logs for file data and path
							}  
							$total_no_of_sms = $total_no_of_sms + $sms_length;
						      
							//mysql_query("insert into schedule_campaigns_to set campaign_id='$campaign_id',sms_text='$message',to_mobile_no='$mobile_no'");
							 //echo $file_completepath1. ' '.$file_completepath2. ' '.$file_completepath3;
    
				
						}  

					 }  
					if($total_no_of_sms > 0 ) 
					{
 
					
						 $table_count = 0;
						// dump the data into schedule_campaigns_to
						if($file_completepath1 != NULL) {

							  $sqlst = "LOAD DATA INFILE  '$file_completepath1' INTO TABLE $process_table1 FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\\n'";
							  $rs = $mysqli->query($sqlst);
							  $table_count = 1;
 
						}
						if($file_completepath2 != NULL) {

							  $sqlst = "LOAD DATA INFILE  '$file_completepath2' INTO TABLE $process_table2 FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\\n'";
							$rs = $mysqli->query($sqlst);
							 $table_count +=1;
							
					
						}    
						if($file_completepath3 != NULL) {

							  $sqlst = "LOAD DATA INFILE  '$file_completepath3' INTO TABLE $process_table3 FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\\n'";
							$rs = $mysqli->query($sqlst);
							$table_count +=1;
 
					
						} 
						
						if($is_schedule > 0) 
						{

						   	$mysqli->query("update campaigns set campaign_status='1' where campaign_id='$campaign_id'");
						}
						else 
						{

						   	$mysqli->query("update campaigns set campaign_status='1' where campaign_id='$campaign_id'");    
						}
						$mysqli->query("update $table_name set status='2' where id='$id'"); 		      		 					$usr = $mysqli->query("select username from users where user_id=$userId");
				  		$usr = $usr->fetch_array(MYSQLI_ASSOC);
						$uname = $usr['username'];
				  		if($totalnoofsms > 200000)
						{
							//sms_alert($uname,$total_no_of_sms,$campaign_id);
						}  
							 
					}	
                           		//immediateCampaign($table_count,$userId,$campaign_id); 
               			  
				}
			}  
		}				
	}  
}



 
function get_unique()
{
	global $mysqli;
 	$msg_c = ''; 
	$set_msg = 'set @u:= hex(uuid())'; 
	$q = $mysqli->query($set_msg); 
 
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
 
 

 

function immediateCampaign($count,$userId,$campaign_id)   
{	
	 include("/var/www/html/strikerapp/smslib/config.inc");
	 include("/var/www/html/strikerapp/smslib/functions.inc");
 
	global $mysqli; 
	$userquery = $mysqli->query("select no_ndnc,dnd_check from users where user_id = '".$userId."' "); 
	$ndnc = $userquery->fetch_array(MYSQLI_ASSOC);
	$no_ndnc = $ndnc['no_ndnc'];  
	$dnd_check = $ndnc['dnd_check']; 
	//$unicode_sms = "&coding=2&charset=utf-8";
	$unicode_sms = '';  
	$mclass = "&mclass=1";       
	$userActType = array();
	$userActType = array(array($no_ndnc,$dnd_check));
	$semi = array();
	$semi = array(1,1);   
	$tran = array(1,0);    
	$promo = array(0,0);    
	switch ($userActType)
	{  // Account type switch start
		case in_array($semi,$userActType) :

		    	$portType = "LP2"; // semi trans
		break;
		case in_array($tran,$userActType):  

			    $portType = "LT2"; // trans
		break;
		case in_array($promo,$userActType):

			$portType = "LS2"; // promo
		break; 
	}
	$available_port_val = $mysqli->query("SELECT sending_port_no FROM sms_queue where application_priority='$portType' order by queued, sent asc limit 1");
	$available_port = $available_port_val->fetch_array(MYSQLI_ASSOC);
	$available_port = $available_port['sending_port_no'];  
	for($i=1;$i<=$count;$i++) {
		$table_name = 'schedule_campaigns_to_'.$campaign_id.'_'.$i; 
		$no_of_messages = 0;
		$campaign_rs = $mysqli->query("select * FROM $table_name "); 
		if($campaign_rs->num_rows > 0 )   
		{
			$no_of_messages = $campaign_rs->num_rows;   
			$no_of_messages_tmp = 0;
			
	 		$insertQuery="insert into  campaigns_to  (campaign_id,unique_msg_id,to_mobile_no,sms_text,sent_on,dlr_status,error_text,port_no) values ";    
			$values="";
			$offset=0;  
			while($campaign_details_val = $campaign_rs->fetch_array(MYSQLI_ASSOC))  
			{	
				$no_of_messages_tmp++;  
				$campaign_id = $campaign_details_val['campaign_id'];
				$unique_msg_id = $campaign_details_val['unique_msg_id'];
				$sms_text = $campaign_details_val['sms_text'];
				$to_mobile = $campaign_details_val['to_mobile_no'];
				$sms_text1 = $mysqli->real_escape_string($sms_text);
				if(strlen($sms_text) > 160)	    
					$sms_length_tmp = ceil(strlen($sms_text)/153);
				else
					$sms_length_tmp = ceil(strlen($sms_text)/160);
			
				$blockedNumberRes = $mysqli->query("SELECT count(*) as count FROM sms.block_listed_numbers WHERE mobile_no = '{$to_mobile}'");
				$blockedNumberRow = $blockedNumberRes->fetch_array(); 
				$is_block_listed = $blockedNumberRow[0];  
				$is_invalid_no = 1;
				if(strlen($to_mobile) > 7 && strlen($to_mobile) <= 10 )	
					$is_invalid_no = 0;
		   	
			
				if($is_block_listed)
				{    
					$values .= "('$campaign_id','$unique_msg_id','$to_mobile','$sms_text1',now(),'2','Block Listed Number','$available_port'),";  
				}elseif($is_invalid_no)
				{								
					$values .= "('$campaign_id','$unique_msg_id','$to_mobile','$sms_text1',now(),'16','Invalid Number','$available_port'),"; 
				} else {  
	 
					if(!$ndnc['no_ndnc'])
					{
										//check for dnd number
						$checkDndRes = $mysqli->query("SELECT count(*) FROM dnd_db.ndnc_data WHERE dnc_number = '{$to_mobile}'");
						$checkDndRow = $checkDndRes->fetch_array();
						$isDND = $checkDndRow[0];
						if($isDND)
						{

							$values .= "('$campaign_id','$unique_msg_id','$to_mobile','$sms_text1',now(),'3','DND Number','$available_port'),"; 
						} else {
										
							 $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=91$to_mobile&text=".urlencode($sms_text);
							$URL .= "$unicode_sms$mclass&dlr-mask=19&dlr-url=".urlencode(SERVER_NAME."ftp_dlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");
							 http_send($URL,$available_port);
	 
	 
	 						$values .= "('$campaign_id','$unique_msg_id','$to_mobile','$sms_text1',now(),'0','NULL','$available_port'),";
						}  
					} else {     
									
	 
						 $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=91$to_mobile&text=".urlencode($sms_text);
						$URL .= "$unicode_sms$mclass&dlr-mask=19&dlr-url=".urlencode(SERVER_NAME."ftp_dlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");
									
	 					 http_send($URL,$available_port);
	 
	 

		 				$values .=   "('$campaign_id','$unique_msg_id','$to_mobile','$sms_text1',now(),'0','NULL','$available_port'),";  
									
	 
					}     
				}  
				$offset++;  
				if($offset == 3000)
				 {								
					 $values = substr($values,0,strlen($values)-1);  
					 $final_query = $insertQuery." ".$values; 
					 $mysqli->query($final_query); 
					 $offset = 0;            
					 $values = "";     
	 
				}       
			
			}
			 
			if($offset > 0)       
			{       
				// "remaining records ";
				$values=substr($values,0,strlen($values)-1);
				$final_query=$insertQuery." ".$values; 
				$mysqli->query($final_query);       

			}   
			if($no_of_messages_tmp == $no_of_messages)  
			{
	 
			  	$mysqli->query("DROP TABLE $table_name");  
				  
			} 
	   
		}   
	}	   		
 
}



 





 
function sms_alert($uname,$totalnoofsms,$campaign_id)
{
	$user=SMS_ALERT_USER; //your username
	$password=SMS_ALERT_PWD; //your password
	$message = "Large Campaign Alert. From User $uname ,Campaign ID: $campaign_id and Total Campaign Size : $totalnoofsms"; //enter Your Message

	$senderid=SMS_ALERT_SENDERID; //Your senderid
	$messagetype="1"; //Type Of Your Message
	$url=CALL_SMS_API;    
	$message = urlencode($message);
	$ch = curl_init();
	if (!$ch){die("Couldn't initialize a cURL handle");}
	$ret = curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt ($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); 		
	curl_setopt ($ch, CURLOPT_POSTFIELDS,
	"username=$user&password=$password&to=."SMS_ALERT_TO."&msg=$message&from=$senderid&type=$messagetype");

	$ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	$curlresponse = curl_exec($ch); // execute
} 
    
$mysqli->close();

*/
?>
