<?php 
 
include("/var/www/vhosts/www.smsstriker.com/htdocs/ftp_process/dbconnect/config.php");

 
//$mysqli = mysqli_connect("localhost","smsstrikerapp",'$tr!k3r@2009',"sms");
 
   

/**   
  * Campaign creates
  * Based on filesize create dynamic tables	
  **/
   
  
function createCampaign() { 
  
	global $mysqli;  
 	$dir ='';
	$get_ftp_users = $mysqli->query("SELECT user_id,no_ndnc,dnd_check FROM users WHERE is_ftp =1 " );  

	while ($ftpUsers = $get_ftp_users->fetch_array(MYSQLI_ASSOC)) {

		$user_id= $ftpUsers['user_id'];
 		if($ftpUsers['no_ndnc'] == 1 && $ftpUsers['dnd_check']==1) {
		if($user_id=='4904'){
		$user_file_path = $dir = '/home/actcorp/promo/';
		$sender_id = 'ACTGRP';
		} elseif($user_id==2917){
                        $user_file_path =  $dir = '/home/actcorp/test/';
                        $sender_id = 'ACTGRP';
                        }

		
		}else{
		//$user_id=='4857'
			if($user_id=='4857'){
			$user_file_path =  $dir = '/home/actcorp/';
			$sender_id = 'ACTGRP';
			}
			elseif($user_id==2917){
			$user_file_path =  $dir = '/home/actcorp/test/';
			$sender_id = 'ACTGRP';
			}
		} 
 
  			
 

	if (is_dir($dir)){ 
		if ($handle = opendir($dir)) {
			while (false !== ($entry = readdir($handle))) {
				if ($entry != "." && $entry != "..") {
					 $file_type = explode('.',$entry);
 


 					if(@$file_type[1] == 'csv') {	
 					     $file_path  = '';
 

					$file_path = $user_file_path.$entry; 

					 if(time()-filemtime($file_path) > 1 * 60) {
 
$check_file_exists = $mysqli->query("SELECT count(*) as cnt FROM `ftp_campaign` where `csv_file` = '".$file_path."' AND date(`created_date_time`)=date(now())");     
 						$check_file_exists_result = $check_file_exists->fetch_array(MYSQLI_ASSOC);
						if($check_file_exists_result['cnt'] == 0)   {
				 	$size = intval(shell_exec("wc -l $file_path"));   // calculates file size
				 	$count = 0; 	 	  
				 	//if($size > 600000) { 
					if($size > 600000) {  // If filesize is greater than 6 lakh create three dynamic tables 
 
						$count = 3;   
						    
					}elseif($size > 300000) {  // If filesize is greater than 3 lakh create two dynamic tables 
 
						$count = 2;
					}else{  
						$count = 1;	// If filesize is less than 3 lakh create one dynamic table 		
					}    
				//	$user_id = 4857;  // taking user_id as static value  
					//$sender_id = 'ACTGRP';  // sender_id  as static value 
					
					// create campaign
					$totalrowscsv=$size;
					$mysqli->query("INSERT INTO ftp_campaign (sender_id,user_id,csv_file,csv_file_size) VALUES ('".$sender_id."','".$user_id."','".$file_path."','".$totalrowscsv."') ");     
					$campaign_id = $mysqli->insert_id;
					  
	     
					 switch($count) {
						case 1 :
								
								$table1 = 'sms_customized.ftp_campaign_to_'.$campaign_id.'_1'; 
								
								// Create dynamic table based on filesize
								
 								$mysqli->query("CREATE TABLE IF NOT EXISTS $table1 (`campaign_id` int(11) DEFAULT NULL,`account_num` varchar(255) DEFAULT NULL, `to_mobile_no` varchar(20) DEFAULT NULL,`sms_text` text CHARACTER SET utf8 COLLATE utf8_general_ci, `created_on` datetime DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");   
 
								$mysqli->query("UPDATE ftp_campaign SET status = '1',process_table1='".$table1."'  WHERE campaign_id = '".$campaign_id."'");
								
								break;
						case 2 :
								$table1 = 'sms_customized.ftp_campaign_to_'.$campaign_id.'_1';    
								$table2 = 'sms_customized.ftp_campaign_to_'.$campaign_id.'_2';
								
								// Create dynamic tables based on filesize
								
								$mysqli->query("CREATE TABLE IF NOT EXISTS $table1 (`campaign_id` int(11) DEFAULT NULL,`account_num` varchar(255) DEFAULT NULL, `to_mobile_no` varchar(20) DEFAULT NULL,`sms_text` text CHARACTER SET utf8 COLLATE utf8_general_ci, `created_on` datetime DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");   
 
								$mysqli->query("CREATE TABLE IF NOT EXISTS $table2 (`campaign_id` int(11) DEFAULT NULL,`account_num` varchar(255) DEFAULT NULL, `to_mobile_no` varchar(20) DEFAULT NULL,`sms_text` text CHARACTER SET utf8 COLLATE utf8_general_ci, `created_on` datetime DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");  

								$mysqli->query("UPDATE ftp_campaign SET status = '1',process_table1='".$table1."',process_table2 = '".$table2."'  WHERE campaign_id = '".$campaign_id."'");

								
								break;
						case 3 :
								$table1 = 'sms_customized.ftp_campaign_to_'.$campaign_id.'_1';    
								$table2 = 'sms_customized.ftp_campaign_to_'.$campaign_id.'_2';
								$table3 = 'sms_customized.ftp_campaign_to_'.$campaign_id.'_3';
								
								// Create dynamic tables based on filesize
								
								$mysqli->query("CREATE TABLE IF NOT EXISTS $table1 (`campaign_id` int(11) DEFAULT NULL,`account_num` varchar(255) DEFAULT NULL, `to_mobile_no` varchar(20) DEFAULT NULL,`sms_text` text CHARACTER SET utf8 COLLATE utf8_general_ci, `created_on` datetime DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");   
 
								$mysqli->query("CREATE TABLE IF NOT EXISTS $table2 (`campaign_id` int(11) DEFAULT NULL,`account_num` varchar(255) DEFAULT NULL, `to_mobile_no` varchar(20) DEFAULT NULL,`sms_text` text CHARACTER SET utf8 COLLATE utf8_general_ci, `created_on` datetime DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");  
  
								$mysqli->query("CREATE TABLE IF NOT EXISTS $table3 (`campaign_id` int(11) DEFAULT NULL,`account_num` varchar(255) DEFAULT NULL, `to_mobile_no` varchar(20) DEFAULT NULL,`sms_text` text CHARACTER SET utf8 COLLATE utf8_general_ci, `created_on` datetime DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");  

								$mysqli->query("UPDATE ftp_campaign SET status = '1',process_table1='".$table1."',process_table2 = '".$table2."',process_table3 = '".$table3."' WHERE campaign_id = '".$campaign_id."'");

								
								break;     
					}
					}		 		
				    }
		 		}
		    	}
}   
			closedir($handle);
		}
		           
	}	
	}

} 
  


/** 
  * Get created campaigns
  * Based on filesize create dynamic csv files 
  * Finally load data from csv files to dynamic tables
  **/


function getCampaignData() { 

   //   require('/var/www/html/strikerapp/spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
     // require('/var/www/html/strikerapp/spreadsheet-reader-master/SpreadsheetReader.php');
 
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
		$mysqli->query("UPDATE ftp_campaign SET status = '2' WHERE campaign_id = '".$campaign_id."'");  
		$userId = $request_list_row['user_id'];  
		$process_table1 = $request_list_row['process_table1'];    
		$process_table2 = $request_list_row['process_table2'];
		$process_table3 = $request_list_row['process_table3']; 
		$Spreadsheet = new SpreadsheetReader($file_path);
		$Sheets = $Spreadsheet->Sheets(); 
		$total_rows = intval(shell_exec("wc -l $file_path"));  
	
		$values = ''; $offset=0;
		$insertQuery1 = "insert into $process_table1  (campaign_id,account_num,to_mobile_no,sms_text,created_on) values "; 
		$insertQuery2 = "insert into $process_table2  (campaign_id,account_num,to_mobile_no,sms_text,created_on) values "; 
		$insertQuery3 = "insert into $process_table3  (campaign_id,account_num,to_mobile_no,sms_text,created_on) values ";
 
 		foreach ($Sheets as $Index => $Name)     
		{
			$Spreadsheet->ChangeSheet($Index);
			$max_row = 1;  		$total_no_of_sms = 0;   
			foreach ($Spreadsheet as $Key => $Row) // take a single spreadsheet read each line in excel sheet
			{
 
				unset($uploded_data);  
				$i=0;
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


					 
   
						if($max_row <= 300000) { 
							 
							$values .= "('".$campaign_id."','".$account_num."','".$mobile_num."','".$sms_text."','".date('Y-m-d H:i:s')."'),";   
						}elseif($max_row > 300000 && $max_row <= 600000) {           
							$values .= "('".$campaign_id."','".$account_num."','".$mobile_num."','".$sms_text."','".date('Y-m-d H:i:s')."'),";   
						}else {                                   
							$values .= "('".$campaign_id."','".$account_num."','".$mobile_num."','".$sms_text."','".date('Y-m-d H:i:s')."'),";     
						}                  

     						
						$total_no_of_sms = $total_no_of_sms + $sms_length; 				 

      
					}             
					       
				}
				$offset++; 
				if($offset == 10000)	{
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
	
				$i++; $max_row++; 
				 
			}      
  			break;      
		}   
 
		if($offset > 0)         
		{       
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

		$basename = basename($file_path);
		copy($file_path , '/home/actcorp/processCompleted/'.$basename);  
		unlink($file_path );  
 	 

		// Deduct credits from user
		$mysqli->query("update users set available_credits = available_credits - $total_no_of_sms where user_id='$userId'"); 
		$mysqli->query("UPDATE ftp_campaign SET sms_count = '".$sms_length."',no_of_messages='".$total_no_of_sms."',sms_text = '".$sms_text1."' WHERE campaign_id = '".$campaign_id."'");  
		  
		   
	} 	         
                     
   
 }      
 
   
 
 
createCampaign();  
getCampaignData();          

 

?>  
