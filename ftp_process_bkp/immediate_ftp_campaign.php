<?php


/** 
  * Send SMS
  * Copy data from dynamic tables to 'ftp_campaigns_to' with errorCode and errorStatus     
  * Drop dynamic tables
  **/
 
$mysqli = mysqli_connect("localhost","smsstrikerapp",'$tr!k3r@2009',"sms"); 

function immediateCampaign()   
{	
	$isValidTemplate = true;
	 

  	include("/var/www/html/strikerapp/smslib/config.inc");
       include("/var/www/html/strikerapp/smslib/functions.inc");
	//  include("/var/www/vhosts/www.rkadvertisings.com/htdocs/smslib/config.inc");
     //   include("/var/www/vhosts/www.rkadvertisings.com/htdocs/smslib/functions.inc");
     
	global $mysqli; 
 
	 $campaign_rs = $mysqli->query("select * FROM ftp_campaign WHERE status = '2' AND (process_table1_status = 0 AND process_table2_status = 0 AND process_table3_status = 0)"); 	
	if($campaign_rs->num_rows > 0 ) 
	{    
		while($campaign_details_val = $campaign_rs->fetch_array(MYSQLI_ASSOC))  
		{	

				$campaign_id = $campaign_details_val['campaign_id'];
		   $mysqli->query("UPDATE ftp_campaign SET status = '4' WHERE campaign_id = '".$campaign_id."'");   		
 
			$userquery = $mysqli->query("select no_ndnc,dnd_check,template_check from users where user_id = '".$campaign_details_val['user_id']."' "); 
			$ndnc = $userquery->fetch_array(MYSQLI_ASSOC);
			$no_ndnc = $ndnc['no_ndnc'];  
	    
			$dnd_check = $ndnc['dnd_check'];
			$user_id = $campaign_details_val['user_id']; 
			$sender = $campaign_details_val['sender_id'];   
			$template_check=$ndnc['template_check'];
			$process_table1 = $campaign_details_val['process_table1'];
			$process_table2 = $campaign_details_val['process_table2'];
			$process_table3 = $campaign_details_val['process_table3'];
			$process_table1_status = $campaign_details_val['process_table1_status']; 
			$process_table2_status = $campaign_details_val['process_table2_status']; 
			$process_table3_status = $campaign_details_val['process_table3_status'];
$unicode_sms = "&charset=ASCII";
$mclass ="&mclass=''";        
			$no_of_messages = 0; 
			$userActType = array();
			$userActType = array(array($no_ndnc,$dnd_check));
			$semi = array();
			$semi = array(1,1);   
			$tran = array(1,0);    
			$promo = array(0,0);    
		 
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
if($user_id=='4904')
{
			$available_port_val = $mysqli->query("SELECT sending_port_no FROM sms_queue where application_priority='ACTSR' order by queued, sent asc limit 1");
			$available_port = $available_port_val->fetch_array(MYSQLI_ASSOC);
			$available_port = $available_port['sending_port_no'];

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

				if($user_id==4857){

		                        if($i == 1) {
		                        // $available_port = 44213;
		                        $available_port = 47713;
		                        }elseif($i == 2) {
		                        //      $available_port = 44313;
		                $available_port = 47813;
		                        }else{
		                //      $available_port = 44413;
		                                $available_port = 47513;
		                        }

                                }elseif($user_id==2917){

                                	if($i == 1) {
				    	  $available_port = 45213;
		   			   //$available_port = 47813;
		        		   // $available_port = 48113;
		                       		// $available_port = 44413;
		                        }elseif($i == 2) {
		                                $available_port = 44313;
		                                //$available_port = 47813;
		                        }else{
		                       		 $available_port = 44413;
		                                //$available_port = 47513;
		                        }

                                }
   
 

				$check_table_exixts = $mysqli->query("SELECT * FROM $table_name ");       
	 			if($check_table_exixts->num_rows > 0 )    
	 			{        
	 				$to_details_rs = $mysqli->query("select account_num,sms_text,to_mobile_no from  $table_name ");     					  
 					if($to_details_rs->num_rows > 0)     
					{  
						$no_of_messages = $no_of_messages+$to_details_rs->num_rows; 
 					  	$insertQuery="insert into  ftp_campaigns_to  (campaign_id,acccount_num,to_mobile_no,sms_text,sms_count,sent_on,dlr_status,error_text,port_no) values ";    
			 			$values="";
			 			$offset=0;  
    						
						while($to_details_val = $to_details_rs->fetch_array(MYSQLI_ASSOC)) 
						{      
 	 
$no_of_messages_tmp++;  
$account_num = $to_details_val['account_num'];

$sms_text = $to_details_val['sms_text'];

$sms_text1 = $mysqli->real_escape_string($sms_text);
//$sms_text1 = str_replace('@','at',$sms_text1);


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
	 								

		
									$templates_query = "SELECT template from templates where user_id='$user_id' and status='2' " ;
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
								$values .= "('$campaign_id','$account_num','$to_mobile','$sms_text1','$sms_length_tmp',now(),'2','Block Listed Number','$available_port'),";  
							}else if(!$isValidTemplate)
						{
 							
							$values .= "('$campaign_id','$account_num','$to_mobile','$sms_text1','$sms_length_tmp',now(),'13','Not a valid Template','$available_port'),";  
						}elseif($is_invalid_no)
							{								
							
								$values .= "('$campaign_id','$account_num','$to_mobile','$sms_text1','$sms_length_tmp',now(),'16','Invalid Number','$available_port'),"; 
							} else {  
 
								if($ndnc['dnd_check'])
								{
									//check for dnd number
									$checkDndRes = $mysqli->query("SELECT count(*) FROM dnd_db.ndnc_data WHERE dnc_number = '{$to_mobile}'");
									$checkDndRow = $checkDndRes->fetch_array();
									$isDND = $checkDndRow[0];
									if($isDND)
									{

										$values .= "('$campaign_id','$account_num','$to_mobile','$sms_text1','$sms_length_tmp',now(),'3','DND Number','$available_port'),"; 
									} else {
																				

 



							
 /*
  $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=91$to_mobile&text=".urlencode($sms_text1);
$URL .= "$unicode_sms$mclass&dlr-mask=19&dlr-url=".urlencode("http://182.18.165.185/ftp_dlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");

http_send($URL,$available_port);    
*/
$dlr_status=0;
$error_text='NULL';      
 
										$values .= "('$campaign_id','$account_num','$to_mobile','$sms_text1','$sms_length_tmp',now(),'$dlr_status','$error_text','$available_port'),";

										
									}  
								} else {     
									






 
							
 /*

$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=91$to_mobile&text=".urlencode($sms_text1);
$URL .= "$unicode_sms$mclass&dlr-mask=19&dlr-url=".urlencode("http://182.18.165.185/ftp_dlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");

http_send($URL,$available_port);
*/


$dlr_status=0;
$error_text='NULL';

 
									$values .=   "('$campaign_id','$account_num','$to_mobile','$sms_text1','$sms_length_tmp',now(),'$dlr_status','$error_text','$available_port'),";
									
 
								}   
				      			}       
							$offset++;     							
							if($offset == 10000)
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
	 						$mysqli->query("UPDATE ftp_campaign SET process_table1_status = '1' WHERE campaign_id = '".$campaign_id."'");
								unset($table_1);
							}elseif(isset($table_2)) {
	 							$mysqli->query("UPDATE ftp_campaign SET process_table2_status = '1' WHERE campaign_id = '".$campaign_id."'");
								unset($table_2);
							}else if(isset($table_3)) {
	 							$mysqli->query("UPDATE ftp_campaign SET process_table3_status = '1' WHERE campaign_id = '".$campaign_id."'");
								unset($table_3);    
							}
						
							$mysqli->query("DROP TABLE $table_name ");
						  
					}  
					
              
					     
				}	      
 			}  
			 
 		  }	    
		   $mysqli->query("UPDATE ftp_campaign SET status = '3' WHERE campaign_id = '".$campaign_id."'");   
   
		}    
	}	    
}     
      
 
immediateCampaign();     
        

?>
