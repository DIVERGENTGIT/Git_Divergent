<?php
include("/var/www/html/strikerapp/config/database.php");

$mysqli=$link;
/** 
  * Send SMS
  * Copy data from dynamic tables to 'ftp_campaigns_to' with errorCode and errorStatus     
  * Drop dynamic tables
  **/
  
  
  
// Ftp bulk process for Margadarsi users and for remaining users too (FOR ::: margharasi_start.php & ftp_process_dynamically.php)  
 
global $mysqli; 
 
function immediateCampaign()   
{	
	$isValidTemplate = true;
	 

      include("/var/www/html/strikerapp/smslib/config.inc");
      include("/var/www/html/strikerapp/smslib/functions.inc");
   
       
	global $mysqli;   
 
	 $campaign_rs = $mysqli->query("select * FROM campaigns WHERE campaign_status = '5' AND csv_file_size > 0 AND (process_table1_status = 0 AND process_table2_status = 0 AND process_table3_status = 0) LIMIT 1"); 	
	if($campaign_rs->num_rows > 0 ) 
	{    
		while($campaign_details_val = $campaign_rs->fetch_array(MYSQLI_ASSOC))  
		{	

				$campaign_id = $campaign_details_val['campaign_id'];
		   $mysqli->query("UPDATE campaigns SET campaign_status = '4' WHERE campaign_id = '".$campaign_id."'");   		
 
			$userquery = $mysqli->query("select username,no_ndnc,dnd_check,template_check from users where user_id = '".$campaign_details_val['user_id']."' "); 
			$ndnc = $userquery->fetch_array(MYSQLI_ASSOC);
			$no_ndnc = $ndnc['no_ndnc'];  
	    			$username = $ndnc['username'];  
			$dnd_check = $ndnc['dnd_check'];
			$user_id = $campaign_details_val['user_id']; 
			$sender = $campaign_details_val['sender_name'];   
			$template_check=$ndnc['template_check'];
			$process_table1 = $campaign_details_val['process_table1'];
			$process_table2 = $campaign_details_val['process_table2'];
			$process_table3 = $campaign_details_val['process_table3'];
			$process_table1_status = $campaign_details_val['process_table1_status']; 
			$process_table2_status = $campaign_details_val['process_table2_status']; 
			$process_table3_status = $campaign_details_val['process_table3_status'];
			$unicode_sms = "&charset=ASCII";
			$mclass ="&mclass=''";        
			$portType = $no_of_messages = 0; 
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
				break;
				case in_array($tran,$userActType):  

				$portType = "MLT2"; // trans
				break;
				case (in_array($promo,$userActType) || in_array($promo2,$userActType)):

				$portType = "LP2"; // promo
				break; 
			}
			$table_count = 0;
			$table_1 = '';$table_2='';$table_3=''; 
			if($process_table1 != NULL)
			{
				$table_count += 1;
				$table_1 = $process_table1;
				
			}
			if($process_table2 != NULL) 
			{
				$table_count += 1;
				$table_2 = $process_table2;
 
			}
			if($process_table3 != NULL)
			{
				$table_count += 1;
				$table_3 = $process_table3;
				 
			} 	
 
 
				$checked=0;
  			$no_of_messages_tmp = 0;
  			
$available_port = 0;

			$available_port_val = $mysqli->query("SELECT sending_port_no FROM sms_queue where application_priority='".$portType."' order by queued, sent asc limit 1");
			$available_port = $available_port_val->fetch_array(MYSQLI_ASSOC);
			$available_port = $available_port['sending_port_no'];

			// Here we are getting only one port so that we are adding this script outside the loop
			 $senderName_kennel = $sender;
			 if($available_port > 0) {
			 	$getPortType = $mysqli->query("SELECT sending_port_no FROM sms_queue where sending_port_no = '".$available_port."' AND used_for = 'BSNL' "); 
			 	if($getPortType->num_rows > 0)    
				{  
					if($no_ndnc == 0){
						$senderName_kennel = "BA-611128";
				 	}else{ 
				 		$senderName_kennel = "BA-".$sender;
				 	}
			 	}  
			 }    
			 
			 

			for($i=1;$i<=$table_count;$i++)     
			{  

			$table_name = '';
			if(isset($table_1)) {
				$table_name = $table_1;
				//unset($table_1);
			}elseif(isset($table_2)) {
				$table_name = $table_2;
				//unset($table_2);
			}else if(isset($table_3)) {
				$table_name = $table_3;
				//unset($table_3);  
			}

			if(isset($table_name)) { 


				$check_table_exixts = $mysqli->query("SELECT * FROM $table_name ");       
	 			if($check_table_exixts->num_rows > 0 )    
	 			{        
	 				$to_details_rs = $mysqli->query("select user_id,sms_text,to_mobile_no,smsLength from  $table_name ");     					  
 					if($to_details_rs->num_rows > 0)     
					{  
						$no_of_messages = $no_of_messages+$to_details_rs->num_rows; 
 					  	$insertQuery="insert into campaigns_to  (campaign_id,unique_msg_id,user_id,sender_name,to_mobile_no,sms_text,sms_count,sent_on,dlr_status,error_text,port_no) values ";    
			 			$values="";
			 			$offset=0;  
    						
						while($to_details_val = $to_details_rs->fetch_array(MYSQLI_ASSOC)) 
						{      
 	 
$no_of_messages_tmp++;  
$account_num = $to_details_val['user_id'];

$sms_text = trim($to_details_val['sms_text']);
$sms_text1 = $mysqli->real_escape_string($sms_text);
//$sms_text1 = str_replace('@','at',$sms_text1);

$uniqueNo = get_unique();
if(strlen($sms_text)>160)	    
$sms_length_tmp=ceil(strlen($sms_text)/153);
else
$sms_length_tmp=ceil(strlen($sms_text)/160);

 			 

			if(!$checked) 
							{
								if($template_check)
								{
									$error = false;
									$isValidTemplate = true;
									//check for templates
									//lower case
									$sms_text = strtolower($sms_text);

									//remove special characters
									$special_char = array(',','.','-','!','&','*');
									$sms_text = str_replace($special_char, ' ', $sms_text);
									$sms_text_array = explode(" ", $sms_text);
									$txt_array1 = array();
									for($k = 0; $k < count($sms_text_array); $k++){
										$txt1 = trim($sms_text_array[$k]);
										if(strlen($txt1) > 0){
											$txt_array1[] = $txt1;
										}
									} 
	 								

		
									$templates_query = "SELECT template from templates where user_id='$user_id' " ;
									$templates_rs = $mysqli->query($templates_query); 

									if($templates_rs->num_rows > 0)
									{  
										while ($row = $templates_rs->fetch_array())
										{
															 
											$temp = strtolower($row['template']);
											$txt2 = str_replace($special_char, ' ', $temp);
											$sms_template = str_replace('xxxx','', $txt2);
											$sms_template_array = explode(" ", $sms_template);
	
											$txt_array2 = array();
											for($m = 0; $m < count($sms_template_array); $m++){
												$txt3 = trim($sms_template_array[$m]);
												if(strlen($txt3) > 0){
													$txt_array2[] = $txt3;
												}
											}
		 		
 
										 
										$diff_array = array_diff($txt_array2, $txt_array1);

										 	

										$text_array2_count = count($txt_array2);
										$diff_array_count = count($diff_array);


								$diff_percentage = ($diff_array_count/$text_array2_count)*100;

																					 
										if($diff_percentage <= 40)
						  				{
						  					$checked = 1;
											$temp_check=true; break;
											 
										}
										else 
										{
											$checked = 0;
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
			  					  

						}  
 
							$to_mobile = $to_details_val['to_mobile_no'];  
							$blockedNumberRes = $mysqli->query("SELECT count(*) as count FROM sms.block_listed_numbers WHERE mobile_no = '{$to_mobile}'");
							$blockedNumberRow = $blockedNumberRes->fetch_array(); 
							$is_block_listed = $blockedNumberRow[0];  
							$is_invalid_no = 1;
							if(strlen($to_mobile) > 7 && strlen($to_mobile) <= 10 )	
								$is_invalid_no = 0;
	   
							if($is_block_listed)
							{   
								$values .= "('$campaign_id','$uniqueNo','$account_num','$sender','$to_mobile','$sms_text1','$sms_length_tmp',now(),'2','Block Listed Number','$available_port'),";  
							}else if(!$isValidTemplate)
						{
 							
							$values .= "('$campaign_id','$uniqueNo','$account_num','$sender','$to_mobile','$sms_text1','$sms_length_tmp',now(),'13','Not a valid Template','$available_port'),";  
						}elseif($is_invalid_no)
							{								
							
								$values .= "('$campaign_id','$uniqueNo','$account_num','$sender','$to_mobile','$sms_text1','$sms_length_tmp',now(),'16','Invalid Number','$available_port'),"; 
							} else {  
 
								if($ndnc['dnd_check'])
								{
									//check for dnd number
									$checkDndRes = $mysqli->query("SELECT count(*) FROM dnd_db.ndnc_data WHERE dnc_number = '{$to_mobile}'");
									$checkDndRow = $checkDndRes->fetch_array();
									$isDND = $checkDndRow[0];
									if($isDND)
									{

										$values .= "('$campaign_id','$uniqueNo','$account_num','$sender','$to_mobile','$sms_text1','$sms_length_tmp',now(),'3','DND Number','$available_port'),"; 
									} else {
																				

 



							

 $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($senderName_kennel)."&to=91$to_mobile&text=".urlencode($sms_text);
$URL .= "$unicode_sms$mclass&dlr-mask=19&dlr-url=".urlencode("https://www.smsstriker.com/API/DLRS/dlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");
  
http_send($URL,$available_port);      
$dlr_status=0;
$error_text='NULL';      
 
										$values .= "('$campaign_id','$uniqueNo','$account_num','$sender','$to_mobile','$sms_text1','$sms_length_tmp',now(),'$dlr_status','$error_text','$available_port'),";

										
									}  
								} else {     
									






  
$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($senderName_kennel)."&to=91$to_mobile&text=".urlencode($sms_text);
$URL .= "$unicode_sms$mclass&dlr-mask=19&dlr-url=".urlencode("https://www.smsstriker.com/API/DLRS/dlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");

http_send($URL,$available_port); 

 

$dlr_status=0;
$error_text='NULL';

 
									$values .=   "('$campaign_id','$uniqueNo','$account_num','$sender','$to_mobile','$sms_text1','$sms_length_tmp',now(),'$dlr_status','$error_text','$available_port'),";
									
 
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
          
						if($offset>0)     
						{       
							// "remaining records ";
							$values=substr($values,0,strlen($values)-1);
							$final_query=$insertQuery." ".$values; 
$mysqli->query ($final_query);
						}    
					} 

					if($no_of_messages_tmp == $no_of_messages)    
					{
 
						if(isset($table_1)) {
	 						$mysqli->query("UPDATE campaigns SET process_table1_status = '1' WHERE campaign_id = '".$campaign_id."'");
								unset($table_1);
							}elseif(isset($table_2)) {
	 							$mysqli->query("UPDATE campaigns SET process_table2_status = '1' WHERE campaign_id = '".$campaign_id."'");
								unset($table_2);
							}else if(isset($table_3)) {
	 							$mysqli->query("UPDATE campaigns SET process_table3_status = '1' WHERE campaign_id = '".$campaign_id."'");
								unset($table_3);    
							}
						
							$mysqli->query("DROP TABLE $table_name ");
						  
					}else{
						sms_alert($username,$no_of_messages,$campaign_id);  

					}  
					

					     
				}	      
 			}  
			 
 		  }	 $mysqli->query("UPDATE campaigns SET campaign_status = 2 WHERE campaign_id = '".$campaign_id."'");   

		  if($no_of_messages_tmp == 0) {
				sms_alert($username,$no_of_messages_tmp,$campaign_id);
		   $mysqli->query("UPDATE campaigns SET campaign_status = '5' WHERE campaign_id = '".$campaign_id."'");   

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
    
 
immediateCampaign(); 
 

function sms_alert($uname,$total_no_of_sms,$campaign_id){
	$user="support"; //your username
	$password="Str!k3r2020"; //your password
	$message = "FTP Campaign Alert. From User $uname, Campaign ID:$campaign_id and Total Campaign Size : $total_no_of_sms"; //enter Your Message

	$senderid="STRIKR"; //Your senderid
	$messagetype="1"; //Type Of Your Message
	$url="http://www.smsstriker.com/API/sms.php";
	
	$message = urlencode($message);
	$ch = curl_init();
	//if (!$ch){die("Couldn't initialize a cURL handle");}
	$ret = curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt ($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
	//curl_setopt ($ch, CURLOPT_POSTFIELDS,
	//"username=$user&password=$password&to=$mno&msg=$message&from=$senderid&type=$messagetype");
		
	  curl_setopt ($ch, CURLOPT_POSTFIELDS,
	"username=$user&password=$password&to=8886638806,9000189845,9701019800&msg=$message&from=$senderid&type=$messagetype");

	$ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	$curlresponse = curl_exec($ch); // execute
}     
        


$mysqli->close();

?>
