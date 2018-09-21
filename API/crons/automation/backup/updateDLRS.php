<?php

require_once 'db/config_sms.php'; 
             
include("/var/www/html/strikerapp/smslib/config.inc");     
include("/var/www/html/strikerapp/smslib/functions.inc");       
          
$getReCampaigns = $mysqli->query("SELECT * FROM campaigns_to_fin2 WHERE flag_status = 0 LIMIT 5000");  

if($getReCampaigns->num_rows > 0 ) {  
	$updateQuery = '';    $deleteQuery = '';          
	while($campaignResult = $getReCampaigns->fetch_assoc()) {    
		$campaign_id = trim($campaignResult['campaign_id']);     
		$user_id = trim($campaignResult['user_id']);   
		$sender_name = trim($campaignResult['sender_name']);     
		$to_mobile_no = trim($campaignResult['to_mobile_no']);    
		$error_text = trim($campaignResult['status']);  
		$error_code = trim($campaignResult['error_code']);  
		$dlr_status = '';        
		        
		if($error_code == '000') {  
			$dlr_status = 1;  
		}else{
			$dlr_status = 2;  
		}       
		          
		 //       echo "UPDATE campaigns_to SET dlr_status = '".$dlr_status."',error_code='".$error_code."',error_text='".$error_text."',delivered_on=now() WHERE campaign_id = '".$campaign_id."' AND user_id = '".$user_id."' AND sender_name = '".$sender_name."' AND to_mobile_no = '".$to_mobile_no."' ";exit;
		        
		$updateQuery .= "UPDATE campaigns_to SET dlr_status = '".$dlr_status."',error_code='".$error_code."',error_text='".$error_text."',delivered_on=now() WHERE campaign_id = '".$campaign_id."' AND user_id = '".$user_id."' AND sender_name = '".$sender_name."' AND to_mobile_no = '".$to_mobile_no."' ";
		  	  
		$updateQuery .= ";";   
		//$mysqli->query("DELETE FROM  campaigns_to_fin2  WHERE campaign_id = '".$campaign_id."' AND user_id = '".$user_id."' AND sender_name = '".$sender_name."' AND to_mobile_no = '".$to_mobile_no."'  "); 
		
		$deleteQuery .= "UPDATE campaigns_to_fin2 SET flag_status = 1 WHERE campaign_id = '".$campaign_id."' AND user_id = '".$user_id."' AND sender_name = '".$sender_name."' AND to_mobile_no = '".$to_mobile_no."'";
		$deleteQuery .=";";
	}    
	
	 echo $updateQuery;     
	
	 echo "</br>";echo "</br>";echo "</br>";echo "</br>";
	 echo $deleteQuery;
	 
	//$mysqli->multi_query($updateQuery);
	//$mysqli->multi_query($deleteQuery);     
	 
}
 
        
        
?>

