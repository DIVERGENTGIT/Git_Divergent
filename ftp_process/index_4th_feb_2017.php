<?php 
include("/var/www/vhosts/www.smsstriker.com/htdocs/ftp_process/dbconnect/config.php");   

/** 
  * Campaign creates
  * Based on filesize create dynamic tables	
  **/
   
function createCampaign() {   
	global $mysqli;   


//print_r($mysqli);
 $dir = '/home/actcorp/'; 
	if (is_dir($dir)){ 
		if ($handle = opendir($dir)) {
			while (false !== ($entry = readdir($handle))) {
				if ($entry != "." && $entry != "..") {
					 $file_type = explode('.',$entry);
//print_r($file_type);


 					if(@$file_type[1] == 'csv') {	
				$file_path = '/home/actcorp/'.$entry; 
				 	$size = intval(shell_exec("wc -l $file_path"));   // calculates file size
				 	$count = 0; 	 	
				 	
					if($size > 600000) {  // If filesize is greater than 6 lakh create three dynamic tables 
						$count = 3;   
						    
					}elseif($size > 300000) {  // If filesize is greater than 3 lakh create two dynamic tables 
   						$count = 2;
					}else{  
						 $count = 1;	// If filesize is less than 3 lakh create one dynamic table 		
					}    
					$user_id = 4857;  // taking user_id as static value  
					$sender_id = 'ACTGRP';  // sender_id  as static value 
					
					// create campaign
					$totalrowscsv=$size-1;
					$mysqli->query("INSERT INTO ftp_campaign (sender_id,user_id,csv_file,csv_file_size) VALUES ('".$sender_id."','".$user_id."','".$file_path."','".$totalrowscsv."') ");     
					$campaign_id = $mysqli->insert_id;				
					  
					  
					 switch($count) {
						case 1 :
								
								$table1 = 'sms_customized.ftp_campaign_to_'.$campaign_id.'_1'; 
								
								// Create dynamic table based on filesize
								
 								$mysqli->query("CREATE TABLE IF NOT EXISTS $table1 (`campaign_id` int(11) DEFAULT NULL,`account_num` varchar(255) DEFAULT NULL, `to_mobile_no` varchar(20) DEFAULT NULL,`sms_text` text CHARACTER SET utf8 COLLATE utf8_bin, `created_on` datetime DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;");   
 
								$mysqli->query("UPDATE ftp_campaign SET status = '1',process_table1='".$table1."'  WHERE campaign_id = '".$campaign_id."'");
								
								break;
						case 2 :
								$table1 = 'sms_customized.ftp_campaign_to_'.$campaign_id.'_1';    
								$table2 = 'sms_customized.ftp_campaign_to_'.$campaign_id.'_2';
								
								// Create dynamic tables based on filesize
								
								$mysqli->query("CREATE TABLE IF NOT EXISTS $table1 (`campaign_id` int(11) DEFAULT NULL,`account_num` varchar(255) DEFAULT NULL, `to_mobile_no` varchar(20) DEFAULT NULL,`sms_text` text CHARACTER SET utf8 COLLATE utf8_bin, `created_on` datetime DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;");   
 
								$mysqli->query("CREATE TABLE IF NOT EXISTS $table2 (`campaign_id` int(11) DEFAULT NULL,`account_num` varchar(255) DEFAULT NULL, `to_mobile_no` varchar(20) DEFAULT NULL,`sms_text` text CHARACTER SET utf8 COLLATE utf8_bin, `created_on` datetime DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;");  

								$mysqli->query("UPDATE ftp_campaign SET status = '1',process_table1='".$table1."',process_table2 = '".$table2."'  WHERE campaign_id = '".$campaign_id."'");

								
								break;
						case 3 :
								$table1 = 'sms_customized.ftp_campaign_to_'.$campaign_id.'_1';    
								$table2 = 'sms_customized.ftp_campaign_to_'.$campaign_id.'_2';
								$table3 = 'sms_customized.ftp_campaign_to_'.$campaign_id.'_3';
								
								// Create dynamic tables based on filesize
								
								$mysqli->query("CREATE TABLE IF NOT EXISTS $table1 (`campaign_id` int(11) DEFAULT NULL,`account_num` varchar(255) DEFAULT NULL, `to_mobile_no` varchar(20) DEFAULT NULL,`sms_text` text CHARACTER SET utf8 COLLATE utf8_bin, `created_on` datetime DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;");   
 
								$mysqli->query("CREATE TABLE IF NOT EXISTS $table2 (`campaign_id` int(11) DEFAULT NULL,`account_num` varchar(255) DEFAULT NULL, `to_mobile_no` varchar(20) DEFAULT NULL,`sms_text` text CHARACTER SET utf8 COLLATE utf8_bin, `created_on` datetime DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;");  
  
								$mysqli->query("CREATE TABLE IF NOT EXISTS $table3 (`campaign_id` int(11) DEFAULT NULL,`account_num` varchar(255) DEFAULT NULL, `to_mobile_no` varchar(20) DEFAULT NULL,`sms_text` text CHARACTER SET utf8 COLLATE utf8_bin, `created_on` datetime DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=latin1;");  

								$mysqli->query("UPDATE ftp_campaign SET status = '1',process_table1='".$table1."',process_table2 = '".$table2."',process_table3 = '".$table3."' WHERE campaign_id = '".$campaign_id."'");

								
								break;     
					}		 		

		 		}
		    	}
}
			closedir($handle);
		}
		           
	}	

} 
  


/** 
  * Get created campaigns
  * Based on filesize create dynamic csv files 
  * Finally load data from csv files to dynamic tables
  **/


function getCampaignData() { 

	require('/var/www/vhosts/www.smsstriker.com/htdocs/ftp_process/spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
	require('/var/www/vhosts/www.smsstriker.com/htdocs/ftp_process/spreadsheet-reader-master/SpreadsheetReader.php');
	global $mysqli;    
	$acount_column = 0;
	$mobile_no_column = 1; 
	$text_column = 2; 
	$file_completepath1 = '';  
	$file_completepath2 = '';   
	$file_completepath3 = '';   
	$query="SELECT * FROM  ftp_campaign WHERE  status = '1'";
	$getData = $mysqli->query($query);

	while ($request_list_row = $getData->fetch_array(MYSQLI_ASSOC)) {
		 $file_path = $request_list_row['csv_file'];
		$campaign_id = $request_list_row['campaign_id'];
		$userId = $request_list_row['user_id'];  
		$process_table1 = $request_list_row['process_table1'];    
		$process_table2 = $request_list_row['process_table2'];
		$process_table3 = $request_list_row['process_table3']; 
		$Spreadsheet = new SpreadsheetReader($file_path);
		$Sheets = $Spreadsheet->Sheets(); 
		$total_rows = intval(shell_exec("wc -l $file_path"));    
 		foreach ($Sheets as $Index => $Name)     
		{
			$Spreadsheet->ChangeSheet($Index);
			$max_row = 1;  		$total_no_of_sms = 0;   
			foreach ($Spreadsheet as $Key => $Row) // take a single spreadsheet read each line in excel sheet
			{
 
				unset($uploded_data);  
				$i=1;
				for($j = 0; $j < sizeof($Row); $j++)    
				{    
    
					$uploded_data[$i][$j] = $Row[$j];  
 
				}
					
				if($uploded_data[$i][$mobile_no_column] > 0)
				{
					$mobile_num = trim($uploded_data[$i][$mobile_no_column]);
					if(strlen($mobile_num) > 0 && $mobile_num != 0)
					{
						 
						$sms_text = trim($uploded_data[$i][$text_column]);
						$sms_text1 = $mysqli->real_escape_string($sms_text);
						$account_num = trim($uploded_data[$i][$acount_column]);

						if(strlen($sms_text)>160)	    
							$sms_length_tmp=ceil(strlen($sms_text)/153);
						else
							$sms_length_tmp=ceil(strlen($sms_text)/160);

						$sms_length = $sms_length_tmp; 

   
						
						if($max_row <= 300000) {               // If num_of_rows <= 3 lakh creates one csv file   
 
							$datatoload = $campaign_id.",\"".$account_num."\",".$mobile_num.",\"".$sms_text."\",".date('Y-m-d H:i:s')."\n";         
							
							// Append first 3 lakh data
							$file_completepath1 = "/var/lib/mysql-files/campaign_data/act_campaign_to_".$campaign_id."_1.csv";  				     
							
							error_log($datatoload,3,$file_completepath1);

						}elseif($max_row <= 600000) {           // If (num_of_rows > 3 lakh && rowcount <= 6 lakh ) creates two csv file   
							$datatoload = $campaign_id.",\"".$account_num."\",".$mobile_num.",\"".$sms_text."\",".date('Y-m-d H:i:s')."\n";         
							// Append next 3 lakh data 
							$file_completepath2 = "/var/lib/mysql-files/campaign_data/act_campaign_to_".$campaign_id."_2.csv";  				error_log($datatoload,3,$file_completepath2); 
   
						}else {                                    // If (num_of_rows > 6 lakh ) creates three csv file   
							$datatoload = $campaign_id.",\"".$account_num."\",".$mobile_num.",\"".$sms_text."\",".date('Y-m-d H:i:s')."\n";         
							
							// Append remaining data 
							$file_completepath3 = "/var/lib/mysql-files/campaign_data/act_campaign_to_".$campaign_id."_3.csv";  
							error_log($datatoload,3,$file_completepath3); 
						}                  

     						
						$total_no_of_sms = $total_no_of_sms + $sms_length; 				 

      
					}             
					       
				}$i++; $max_row++; 
				 
			}      
  			break;      
		}   
 
 		 
		 if($file_completepath1!=null){
	 	// Loade csv files into dynamic tables
 		 $sqlst1 = "LOAD DATA INFILE  '$file_completepath1' INTO TABLE $process_table1 FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\\n'";   
		$mysqli->query($sqlst1); 
		$path1 =  $file_completepath1;   
		$basename1 = basename($path1);
		copy($path1, '/var/lib/mysql-files/processCompleted/'.$basename1); 
		unlink($path1);    // After load the file  move file location	    
}		  
 if($file_completepath2!=null){
		 $sqlst2 = "LOAD DATA INFILE  '$file_completepath2' INTO TABLE $process_table2 FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\\n'";       
		$mysqli->query($sqlst2);  
		$path2 =  $file_completepath2;   
		$basename2 = basename($path2);
		copy($path2, '/var/lib/mysql-files/processCompleted/'.$basename2);     
		unlink($path2);       // After load the file move file location	
		    }
 if($file_completepath3!=null){
		 $sqlst3 = "LOAD DATA INFILE  '$file_completepath3' INTO TABLE $process_table3 FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\\n'";               
		$mysqli->query($sqlst3);    	

	
		$path3 =  $file_completepath3;   
		$basename3 = basename($path3);
		copy($path3, '/var/lib/mysql-files/processCompleted/'.$basename3); 
		unlink($path3);    // After load the file move file location	
		}
		
		// Deduct credits from user
		$mysqli->query("update users set available_credits = available_credits - $total_no_of_sms where user_id='$userId'"); 
		$mysqli->query("UPDATE ftp_campaign SET status = '2',sms_count = '".$sms_length."',no_of_messages='".$total_no_of_sms."',sms_text = '".$sms_text1."' WHERE campaign_id = '".$campaign_id."'");  
		  
		   
	} 	         
                    
   
 }      
 
 
 
 
/** 
  * Send SMS
  * Copy data from dynamic tables to 'ftp_campaigns_to' with errorCode and errorStatus     
  * Drop dynamic tables
  **/
 
   
function immediateCampaign()   
{	
	
	include("/var/www/vhosts/www.rkadvertisings.com/htdocs/smslib/config.inc");
	include("/var/www/vhosts/www.rkadvertisings.com/htdocs/smslib/functions.inc");
	      
	global $mysqli; 
	$campaign_rs = $mysqli->query("select * FROM ftp_campaign WHERE status = '2'"); 
	if($campaign_rs->num_rows > 0 ) 
	{
		while($campaign_details_val = $campaign_rs->fetch_array(MYSQLI_ASSOC))  
		{			
			
			$userquery = $mysqli->query("select no_ndnc,dnd_check from users where user_id = '".$campaign_details_val['user_id']."' "); 
			$ndnc = $userquery->fetch_array(MYSQLI_ASSOC);
			$no_ndnc = $ndnc['no_ndnc'];  
			$campaign_id = $campaign_details_val['campaign_id'];
			$dnd_check = $ndnc['dnd_check'];
			$user_id = $campaign_details_val['user_id']; 
			$sender = $campaign_details_val['sender_id'];   
			//$unicode_sms = "&coding=2&charset=utf-8";
			$unicode_sms = '';  
			$mclass = "&mclass=1";       
			$no_of_messages = 0; 
		/*	$userActType = array();
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
			$table_count = 0;
			$available_port = $available_port_val->fetch_array(MYSQLI_ASSOC);
    			$available_port = $available_port['sending_port_no'];*/
    			
			if($campaign_details_val['process_table1'] != NULL && $campaign_details_val['process_table2'] != NULL && $campaign_details_val['process_table3'] != NULL)
			{
				$table_count = 3;
			}elseif($campaign_details_val['process_table1'] != NULL && $campaign_details_val['process_table2'] != NULL) 
			{
				$table_count = 2;
			}elseif($campaign_details_val['process_table1'] != NULL)
			{
				$table_count = 1;  
			}
  			$no_of_messages_tmp = 0;
			for($i=1;$i<=$table_count;$i++)     
			{  
			
			
				$available_port = 0;
 				if($i == 1) {
 					$available_port = 47713;
 				}elseif($i == 2) {
 					$available_port = 47813;
 				}else{
 					$available_port = 47513;
 				}
    			
 				$table_name = $campaign_details_val['process_table'.$i];

				$check_table_exixts = $mysqli->query("SELECT * FROM $table_name ");       
	 			if($check_table_exixts->num_rows > 0 )    
	 			{        
	 				$to_details_rs = $mysqli->query("select account_num,sms_text,to_mobile_no from  $table_name ");     					  
 					if($to_details_rs->num_rows > 0)     
					{  
						$no_of_messages = $no_of_messages + $to_details_rs->num_rows; 
 					  	$insertQuery="insert into  ftp_campaigns_to  (campaign_id,acccount_num,to_mobile_no,sms_text,sms_count,sent_on,dlr_status,error_text,port_no) values ";    
			 			$values="";
			 			$offset=0;  
    						
						while($to_details_val = $to_details_rs->fetch_array(MYSQLI_ASSOC)) 
						{      
 	 						
	/* 						$dlr_status = 0;
 				$error_text = '';	
 	 						$getUserCredits = $mysqli->query("SELECT available_credits FROM users WHERE user_id = '".$user_id."' ");  
 	 						$getUserCredits_res = $getUserCredits->fetch_object();
 	 						$userCredits = $getUserCredits_res->available_credits; 
 	 						*/
							$no_of_messages_tmp++;  
							$account_num = $to_details_val['account_num'];

						$sms_text = $to_details_val['sms_text'];

							$sms_text1 = $mysqli->real_escape_string($sms_text);


if(strlen($sms_text)>160)	    
$sms_length_tmp=ceil(strlen($sms_text)/153);
else
$sms_length_tmp=ceil(strlen($sms_text)/160);

 				/*
							if($userCredits >= $sms_length_tmp) {
 	 							$mysqli->query("update users set available_credits = available_credits - $sms_length_tmp where user_id='$user_id'");
 	 						}else{
 	 							$dlr_status = 11;
 	 							$error_text = 'Insufficient funds';  
 	 						} */

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
							}elseif($is_invalid_no)
							{								
								$values .= "('$campaign_id','$account_num','$to_mobile','$sms_text1','$sms_length_tmp',now(),'16','Invalid Number','$available_port'),"; 
							} else {  
 
								if(!$ndnc['no_ndnc'])
								{
									//check for dnd number
									$checkDndRes = $mysqli->query("SELECT count(*) FROM dnd_db.ndnc_data WHERE dnc_number = '{$to_mobile}'");
									$checkDndRow = $checkDndRes->fetch_array();
									$isDND = $checkDndRow[0];
									if($isDND)
									{

										$values .= "('$campaign_id','$account_num','$to_mobile','$sms_text1','$sms_length_tmp',now(),'3','DND Number','$available_port'),"; 
									} else {
										
										
							
//if($dlr_status!=11){			
										$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=91$to_mobile&text=".urlencode($sms_text);
										$URL .= "$unicode_sms$mclass&dlr-mask=19&dlr-url=".urlencode("http://182.18.165.185/ftp_dlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");
										http_send($URL,$available_port);
$dlr_status=0;
$error_text='NULL';
//}									  
										$values .= "('$campaign_id','$account_num','$to_mobile','$sms_text1','$sms_length_tmp',now(),'$dlr_status','$error_text','$available_port'),";

										
									}  
								} else {     
									
//if($dlr_status!=11){ 								
$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=91$to_mobile&text=".urlencode($sms_text);
								$URL .= "$unicode_sms$mclass&dlr-mask=19&dlr-url=".urlencode("http://182.18.165.185/ftp_dlr.php?campaign_id=$campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");
									
 http_send($URL,$available_port);
$dlr_status=0;
$error_text='NULL';

//}
									$values .=   "('$campaign_id','$account_num','$to_mobile','$sms_text1','$sms_length_tmp',now(),'$dlr_status','$error_text','$available_port'),";
									
 
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
							$mysqli->query($final_query);       

						}    
					} 

					if($no_of_messages_tmp == $no_of_messages)  
					{
						 $mysqli->query("DROP TABLE $table_name ");
						  
					}  
					
              
					     
				}	      
 			}
 			  
		$path =  $campaign_details_val['csv_file'];   
		$basename = basename($path);
		copy($path, '/home/actcorp/processCompleted/'.$basename);  
		unlink($path);       
		$mysqli->query("UPDATE ftp_campaign SET status = '3' WHERE campaign_id = '".$campaign_id."'");    
   
		}    
	}	  
}   
     
 
       
        
createCampaign();  
getCampaignData();          
immediateCampaign();   
 

?>  
