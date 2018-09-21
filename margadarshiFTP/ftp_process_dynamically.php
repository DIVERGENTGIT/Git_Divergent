<?php 
include("/var/www/html/strikerapp/config/database.php");
  $mysqli=$link; 
global $mysqli;  

/**   
  * Campaign creates
  * Based on filesize create dynamic tables	
  **/
      
  
function createCampaign() { 
	require('/var/www/html/strikerapp/spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
	require('/var/www/html/strikerapp/spreadsheet-reader-master/SpreadsheetReader.php');
  
	global $mysqli;  
		    
	// Getting dynamic file path & senderID of ftp users (Except ACT & Margadarsi) from users table
	 	  
	$getFtpProcessedUsers = $mysqli->query("SELECT ftp_sender_id,ftp_process_path,user_id,username FROM users WHERE is_ftp = 1 AND (user_id NOT IN (4904,4857,142) AND reseller_id != 142) AND is_blocked = 0 ");  
	while($ftpProcessedUsersRes = $getFtpProcessedUsers->fetch_array(MYSQLI_ASSOC)) {
		$sender_id = $ftp_sender_id = $ftpProcessedUsersRes['ftp_sender_id'];
	  	$dir =  $user_file_path = $ftp_process_path = $ftpProcessedUsersRes['ftp_process_path'];
		$user_id = $ftpProcessedUsersRes['user_id'];
		$username = $ftpProcessedUsersRes['username'];    
 
	 	//$dir =  $user_file_path = '/home/margadarsi/files/'; 
		//$sender_id ='MCFPVT'; 

		if($sender_id != '' && $user_file_path != '') {
			if(is_dir($dir)){ 
	    						
				if($handle = opendir($dir)) {
					while(false !== ($entry = readdir($handle))) {  
						if($entry != "." && $entry != "..")  {

							$file_type = explode('.',$entry);

		 					if(@$file_type[1] == 'csv') {
								$file_path  = '';
								$file_path = $user_file_path.$entry; 
								//  echo time()-filemtime($file_path);
							 	if(time()-filemtime($file_path) > 1 * 60) {
		 
		$check_file_exists = $mysqli->query("SELECT count(*) as cnt FROM `campaigns` where `csv_file` = '".$file_path."' AND date(`created_on`) = date(now())");     
		 							$check_file_exists_result = $check_file_exists->fetch_array(MYSQLI_ASSOC);
		 
									if($check_file_exists_result['cnt'] == 0)   {
						 				$size = intval(shell_exec("wc -l $file_path"));   // calculates file size
						 				  
						 				$count = 0; 
										if($size > 600000) {  // If filesize is greater than 6 lakh create three dynamic tables 		 
											$count = 3;   
											    
										}elseif($size > 300000) {  // If filesize is greater than 3 lakh create two dynamic tables 			 
											$count = 2;
										}else{  
											$count = 1;	// If filesize is less than 3 lakh create one dynamic table 		
										}    
										
										
				
										$totalrowscsv = $size;
										
										$Spreadsheet = new SpreadsheetReader($file_path);
										$Sheets = $Spreadsheet->Sheets(); 
										//$userNameColumn = 0;
										$mobile_no_column = 0; 
										$text_column = 1; 
										$userID = $user_id; //FALSE;  
										$campaign_id = FALSE; 
					$insertQuery1 = $insertQuery2 = $insertQuery3 = '';$totalMobileNums = 0;					
										$values = ''; $offset = 0; 
					foreach ($Sheets as $Index => $Name)     
					{
						$Spreadsheet->ChangeSheet($Index);
						$max_row = 0;$total_no_of_sms = 0;$i = 0;  
						foreach ($Spreadsheet as $Key => $Row) // take a single spreadsheet read each line in excel sheet
						{  
							if($i >= 1)  {  

								if($Row[$mobile_no_column] > 0)
								{
									$mobile_num = trim($Row[$mobile_no_column]);
									if(strlen($mobile_num) > 0 && $mobile_num != 0)
									{
										 
										$totalMobileNums++;
										$sms_text = trim($Row[$text_column]);
										$sms_text1 = $mysqli->real_escape_string($sms_text);
										$account_name = $username;//trim($Row[$userNameColumn]);
  

										if(!$userID) {
											if($i < 2) {
												$getUserInfo = $mysqli->query("SELECT user_id FROM users WHERE username = '".trim($account_name)."'"); 
												$getUserInfoRes = $getUserInfo->fetch_array(MYSQLI_ASSOC);
												$userID = $getUserInfoRes['user_id'];  
											}  
										}


										if(!$campaign_id) {
											if($userID) {
											$campaign_id = createDumpTable($sender_id,$userID,$file_path,$totalrowscsv,$count);
					if($campaign_id) { 		
		$process_table1 = 'sms_customized.ftp_campaign_to_'.$campaign_id.'_1'; 
		$process_table2 = 'sms_customized.ftp_campaign_to_'.$campaign_id.'_2';
		$process_table3 = 'sms_customized.ftp_campaign_to_'.$campaign_id.'_3';
		$insertQuery1 = "insert into $process_table1  (campaign_id,user_id,account_name,to_mobile_no,sms_text,smsLength,created_on) values "; 
		$insertQuery2 = "insert into $process_table2  (campaign_id,user_id,account_name,to_mobile_no,sms_text,smsLength,created_on) values "; 
		$insertQuery3 = "insert into $process_table3  (campaign_id,user_id,account_name,to_mobile_no,sms_text,smsLength,created_on) values ";

			 		}  
											}	
										}  


		 
										if(strlen($sms_text)>160)	    
											$sms_length_tmp=ceil(strlen($sms_text)/153);
										else
											$sms_length_tmp=ceil(strlen($sms_text)/160);

										$sms_length = $sms_length_tmp; 


									 	if($campaign_id) {
				   
											if($max_row <= 300000) { 
												 
												$values .= "('".$campaign_id."','".$userID."','".$account_name."','".$mobile_num."','".$sms_text1."','".$sms_length."','".date('Y-m-d H:i:s')."'),";   
											}elseif($max_row > 300000 && $max_row <= 600000) {           
												$values .= "('".$campaign_id."','".$userID."','".$account_name."','".$mobile_num."','".$sms_text1."','".$sms_length."','".date('Y-m-d H:i:s')."'),";   
											}else {                                   
												$values .= "('".$campaign_id."','".$userID."','".$account_name."','".$mobile_num."','".$sms_text1."','".$sms_length."','".date('Y-m-d H:i:s')."'),";     
											}                  
		
					     						
											$total_no_of_sms = $total_no_of_sms + $sms_length; 				 					}

				      
									}             
									       
								} 


								$offset++; 
								if($offset == 10000)	{
									if($campaign_id) {
										if($max_row <= 300000)
										{	
											$values = substr($values,0,strlen($values)-1);  
										 	$final_query = $insertQuery1." ".$values; 
										 	$mysqli->query($final_query); 
											$offset = 0;            
											$values = "";  
		 
										}elseif($max_row > 300000 && $max_row <= 600000) {
											$values = substr($values,0,strlen($values)-1);  
										 	$final_query = $insertQuery2." ".$values; 
										 	$mysqli->query($final_query); 
											$offset = 0;            
											$values = ""; 
		 
										}else{
											$values = substr($values,0,strlen($values)-1);  
										 	$final_query = $insertQuery3." ".$values; 
										 	$mysqli->query($final_query); 
											$offset = 0;            
											$values = ""; 
		 
										}  
									}
								}  
							}
							$i++; $max_row++;  
						}        
			  			break;      
					} 
		 
			 
					if($offset > 0)         
					{       
						if($campaign_id) {
							if($max_row <= 300000)
							{	  
								$values = substr($values,0,strlen($values)-1);  
							 	$final_query = $insertQuery1." ".$values; 
							 	$mysqli->query($final_query); 
								$offset = 0;            
								$values = ""; 
		 
							}elseif($max_row > 300000 && $max_row <= 600000) {
								$values = substr($values,0,strlen($values)-1);  
							 	$final_query = $insertQuery2." ".$values; 
							 	$mysqli->query($final_query); 
								$offset = 0;            
								$values = ""; 
		 
							}else{  
								$values = substr($values,0,strlen($values)-1);  
							 	$final_query = $insertQuery3." ".$values; 
							 	$mysqli->query($final_query); 
								$offset = 0;            
								$values = "";
		 
							}  
						}  
					}       
								  
					$basename = basename($file_path);
					
					$year = date('Y');
					$month = date('n');
					$date = date('d');  
					
					//If not exists creating folder with username 
					$userName_path = '/var/www/html/FTPCampaign_Log/'.$username;
		 			if(!file_exists($userName_path)) {
					  	mkdir($userName_path, 0777, true);
					}
					  
					//If not exists creating processCompleted folder under username folder 
					$processCompleted_path = '/var/www/html/FTPCampaign_Log/'.$username.'/processCompleted';
		 			if(!file_exists($processCompleted_path)) {
					  	mkdir($processCompleted_path, 0777, true);
					}  
					  
					//If not exists creating folder with current year under processCompleted
					$year_path = '/var/www/html/FTPCampaign_Log/'.$username.'/processCompleted/'.$year;
		 			if(!file_exists($year_path)) {
					  	mkdir($year_path, 0777, true);
					}
					  
					//If not exists creating folder with current month under year folder
					$month_path = '/var/www/html/FTPCampaign_Log/'.$username.'/processCompleted/'.$year.'/'.$month;
		 			if(!file_exists($month_path)) {
					  	mkdir($month_path, 0777, true);
					}
					  
					//If not exists creating folder with current date under month folder  
					$date_path = '/var/www/html/FTPCampaign_Log/'.$username.'/processCompleted/'.$year.'/'.$month.'/'.$date;
		 			if(!file_exists($date_path)) {
					  	mkdir($date_path, 0777, true);
					}  
					
					$processCompletedPath = $date_path.'/'.$basename;
			
					//$processCompletedPath = '/home/FTPCampaign/'.$username.'/processCompleted/'.$basename;
					//copy($file_path , '/home/processCompleted/'.$basename);
					copy($file_path , $processCompletedPath);  
					unlink($file_path);             

					//$mysqli->query("update users set available_credits = available_credits - $total_no_of_sms where user_id='$userID'"); 
					$mysqli->query("UPDATE campaigns SET campaign_status = '5',sms_count = '".$sms_length."',no_of_messages='".$total_no_of_sms."',sms_text = '".$sms_text1."',phone_nos_count = '".$totalMobileNums."' WHERE campaign_id = '".$campaign_id."'");  
  
  
		 
									}		   		
						   		}
				 			}
				 			/*else if(@$file_type[1] == 'txt') {
				 				$file_path  = '';
								$file_path = $user_file_path.$entry; 
							 	if(time()-filemtime($file_path) > 1 * 60) {
		 
		$check_file_exists = $mysqli->query("SELECT count(*) as cnt FROM `campaigns` where `csv_file` = '".$file_path."' AND date(`created_on`) = date(now())");     
		 							$check_file_exists_result = $check_file_exists->fetch_array(MYSQLI_ASSOC);  
		 
									if($check_file_exists_result['cnt'] == 0)   {
						 				$size = intval(shell_exec("wc -l $file_path"));   // calculates file size
						 				  
						 				$count = 0; 
										if($size > 600000) {  // If filesize is greater than 6 lakh create three dynamic tables 		 
											$count = 3;   
											    
										}elseif($size > 300000) {  // If filesize is greater than 3 lakh create two dynamic tables 			 
											$count = 2;
										}else{  
											$count = 1;	// If filesize is less than 3 lakh create one dynamic table 		
										}    
										
										
				
										$totalrowscsv = $size;
										// Read text file
										
										//$Spreadsheet = new SpreadsheetReader($file_path);
										//$Sheets = $Spreadsheet->Sheets(); 
										//$userNameColumn = 0;
										$mobile_no_column = 0; 
										$text_column = 1; 
										$userID = $user_id; //FALSE;  
										$campaign_id = FALSE; 
										$insertQuery1 = $insertQuery2 = $insertQuery3 = '';$totalMobileNums = 0;					
										$values = ''; $offset = 0; 
										$max_row = 0;$total_no_of_sms = 0;$i = 0;
										$handle = fopen($file_path, "r");
										if($handle) {
											while(($line = fgets($handle)) !== false) {
												 
											 
										
										
										
										
							if($i >= 1)  {

								if($Row[$mobile_no_column] > 0)
								{
									$mobile_num = trim($Row[$mobile_no_column]);
									if(strlen($mobile_num) > 0 && $mobile_num != 0)
									{
										 
										$totalMobileNums++;
										$sms_text = trim($Row[$text_column]);
										$sms_text1 = $mysqli->real_escape_string($sms_text);
										$account_name = $username;//trim($Row[$userNameColumn]);
  

										if(!$userID) {
											if($i < 2) {
												$getUserInfo = $mysqli->query("SELECT user_id FROM users WHERE username = '".trim($account_name)."'"); 
												$getUserInfoRes = $getUserInfo->fetch_array(MYSQLI_ASSOC);
												$userID = $getUserInfoRes['user_id'];  
											}  
										}


										if(!$campaign_id) {
											if($userID) {
											$campaign_id = createDumpTable($sender_id,$userID,$file_path,$totalrowscsv,$count);
					if($campaign_id) { 		
		$process_table1 = 'sms_customized.ftp_campaign_to_'.$campaign_id.'_1'; 
		$process_table2 = 'sms_customized.ftp_campaign_to_'.$campaign_id.'_2';
		$process_table3 = 'sms_customized.ftp_campaign_to_'.$campaign_id.'_3';
		$insertQuery1 = "insert into $process_table1  (campaign_id,user_id,account_name,to_mobile_no,sms_text,smsLength,created_on) values "; 
		$insertQuery2 = "insert into $process_table2  (campaign_id,user_id,account_name,to_mobile_no,sms_text,smsLength,created_on) values "; 
		$insertQuery3 = "insert into $process_table3  (campaign_id,user_id,account_name,to_mobile_no,sms_text,smsLength,created_on) values ";

			 		}  
											}	
										}  


		 
										if(strlen($sms_text)>160)	    
											$sms_length_tmp=ceil(strlen($sms_text)/153);
										else
											$sms_length_tmp=ceil(strlen($sms_text)/160);

										$sms_length = $sms_length_tmp; 


									 	if($campaign_id) {
				   
											if($max_row <= 300000) { 
												 
												$values .= "('".$campaign_id."','".$userID."','".$account_name."','".$mobile_num."','".$sms_text1."','".$sms_length."','".date('Y-m-d H:i:s')."'),";   
											}elseif($max_row > 300000 && $max_row <= 600000) {           
												$values .= "('".$campaign_id."','".$userID."','".$account_name."','".$mobile_num."','".$sms_text1."','".$sms_length."','".date('Y-m-d H:i:s')."'),";   
											}else {                                   
												$values .= "('".$campaign_id."','".$userID."','".$account_name."','".$mobile_num."','".$sms_text1."','".$sms_length."','".date('Y-m-d H:i:s')."'),";     
											}                  
		
					     						
											$total_no_of_sms = $total_no_of_sms + $sms_length; 				 					}

				      
									}             
									       
								} 


								$offset++; 
								if($offset == 10000)	{
									if($campaign_id) {
										if($max_row <= 300000)
										{	
											$values = substr($values,0,strlen($values)-1);  
										 	$final_query = $insertQuery1." ".$values; 
										 	$mysqli->query($final_query); 
											$offset = 0;            
											$values = "";  
		 
										}elseif($max_row > 300000 && $max_row <= 600000) {
											$values = substr($values,0,strlen($values)-1);  
										 	$final_query = $insertQuery2." ".$values; 
										 	$mysqli->query($final_query); 
											$offset = 0;            
											$values = ""; 
		 
										}else{
											$values = substr($values,0,strlen($values)-1);  
										 	$final_query = $insertQuery3." ".$values; 
										 	$mysqli->query($final_query); 
											$offset = 0;            
											$values = ""; 
		 
										}  
									}
								}  
							}
							$i++; $max_row++;  
						}     
						fclose($handle);   
			  			break;      
					} 
				
										 
										
									}
								}	
 								exit;
				 			} */
				    		}  
					}   
					closedir($handle);
				}
			}
		}	             
	}	
} 


function createDumpTable($sender_id,$user_id,$file_path,$totalrowscsv,$count) {
	global $mysqli;  
	$mysqli->query("INSERT INTO campaigns (sender_name,user_id,csv_file,csv_file_size,created_on) VALUES ('".$sender_id."','".$user_id."','".$file_path."','".$totalrowscsv."','".date('Y-m-d H:i:s')."') ");     
	$campaign_id = $mysqli->insert_id;
	$table1 = 'sms_customized.ftp_campaign_to_'.$campaign_id.'_1';    
	$table2 = 'sms_customized.ftp_campaign_to_'.$campaign_id.'_2';
	$table3 = 'sms_customized.ftp_campaign_to_'.$campaign_id.'_3';

	switch($count) {
		case 1 : 
				$table2 = ''; $table3 = '';
			// Create dynamic table based on filesize
	
			$mysqli->query("CREATE TABLE IF NOT EXISTS $table1 (`campaign_id` int(11) DEFAULT NULL,`user_id` int(11) DEFAULT NULL,`account_name` varchar(255) DEFAULT NULL, `to_mobile_no` varchar(20) DEFAULT NULL,`sms_text` text CHARACTER SET utf8 COLLATE utf8_general_ci, `smsLength` int(11) DEFAULT NULL,`created_on` datetime DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");   
 
			break;  
		case 2 :
  				$table3 = '';
			// Create dynamic tables based on filesize
	
			$mysqli->query("CREATE TABLE IF NOT EXISTS $table1 (`campaign_id` int(11) DEFAULT NULL,`user_id` int(11) DEFAULT NULL,`account_name` varchar(255) DEFAULT NULL, `to_mobile_no` varchar(20) DEFAULT NULL,`sms_text` text CHARACTER SET utf8 COLLATE utf8_general_ci, `smsLength` int(11) DEFAULT NULL,`created_on` datetime DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");   

			$mysqli->query("CREATE TABLE IF NOT EXISTS $table2 (`campaign_id` int(11) DEFAULT NULL,`user_id` int(11) DEFAULT NULL,`account_name` varchar(255) DEFAULT NULL, `to_mobile_no` varchar(20) DEFAULT NULL,`sms_text` text CHARACTER SET utf8 COLLATE utf8_general_ci, `smsLength` int(11) DEFAULT NULL,`created_on` datetime DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");  
 
			break;
		case 3 :  
 
			// Create dynamic tables based on filesize
	
			$mysqli->query("CREATE TABLE IF NOT EXISTS $table1 (`campaign_id` int(11) DEFAULT NULL,`user_id` int(11) DEFAULT NULL,`account_name` varchar(255) DEFAULT NULL, `to_mobile_no` varchar(20) DEFAULT NULL,`sms_text` text CHARACTER SET utf8 COLLATE utf8_general_ci,`smsLength` int(11) DEFAULT NULL,`created_on` datetime DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");   

			$mysqli->query("CREATE TABLE IF NOT EXISTS $table2 (`campaign_id` int(11) DEFAULT NULL,`user_id` int(11) DEFAULT NULL,`account_name` varchar(255) DEFAULT NULL, `to_mobile_no` varchar(20) DEFAULT NULL,`sms_text` text CHARACTER SET utf8 COLLATE utf8_general_ci, `smsLength` int(11) DEFAULT NULL,`created_on` datetime DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");  

			$mysqli->query("CREATE TABLE IF NOT EXISTS $table3 (`campaign_id` int(11) DEFAULT NULL,`user_id` int(11) DEFAULT NULL,`account_name` varchar(255) DEFAULT NULL, `to_mobile_no` varchar(20) DEFAULT NULL,`sms_text` text CHARACTER SET utf8 COLLATE utf8_general_ci,`smsLength` int(11) DEFAULT NULL, `created_on` datetime DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");  
 
			break;     
	}

	$mysqli->query("UPDATE campaigns SET process_table1='".$table1."',process_table2 = '".$table2."',process_table3 = '".$table3."' WHERE campaign_id = '".$campaign_id."'");	

	return $campaign_id;
}


     

createCampaign(); 









$mysqli->close();

 

?>  
