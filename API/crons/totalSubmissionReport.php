<?php
  
getTotalPushSubmissionReport();
 
function getTotalPushSubmissionReport() {
	$server_ip = 'localhost';  $db_user = 'devel'; $db_pass = 'D3v3l09@511';  $db_name = 'sms';  
	//$server_ip = 'localhost';  $db_user = 'root'; $db_pass = 'striker@123';  $db_name = 'sms';   
	$mysqli = new mysqli($server_ip, $db_user, $db_pass, $db_name);
	
	$day_before_yesterday = date("Y-m-d", strtotime("-1 days")); 
	
	$currentMonth = date('m');
	$currentYear = date('Y');    
	$currentDate = date('d');   

	
	// Get BSNL Ports
	$bsnlPortStr = '';    
	$getBSNLPorts = $mysqli->query("SELECT sending_port_no FROM sms_queue where used_for = 'BSNL' GROUP BY sending_port_no "); 
	if($getBSNLPorts->num_rows > 0)  
	{ 
		while($BSNLPorts = $getBSNLPorts->fetch_assoc()) {
			$bsnlPortStr .= $BSNLPorts['sending_port_no'].',';
		}
	}    
	 	 
	$bsnlPortStr = rtrim($bsnlPortStr,',');    
	$bsnlPortArr = explode(',',$bsnlPortStr);  
		   
	$ideaPortStr = 51113; //rtrim($ideaPortStr,',');    
	$ideaPortArr = array(51113); //explode(',',$ideaPortStr);  
		
	if(count($bsnlPortArr) && count($ideaPortArr)) {
	          
	              
	         /**  ----------------------- SMSSTRIKER -----------------------  **/
	          
	          
	   	//Get striker campaign BSNL submission report
	     	$bnl_campaign_count_query = "SELECT sum(sms_count) as totalBNLSub FROM campaigns_to WHERE port_no IN ($bsnlPortStr) AND date(sent_on) = '$day_before_yesterday' AND re_campaign_status IN (0,1) AND (error_code is not null or error_code !='SB2' or error_code != '') ";
		  
		$bnl_campaign_count_Res = $mysqli->query($bnl_campaign_count_query);	 
		$bnl_campaign_count = $bnl_campaign_count_Res->fetch_assoc(); 
		$total_bnl_submission = $bnl_campaign_count['totalBNLSub'];
 
		
		//Get striker campaign BSNL submission Success report
	    	$bnl_campaign_success_count_query = "SELECT sum(sms_count) as totalBNLSuccessSub FROM campaigns_to WHERE port_no IN ($bsnlPortStr) AND date(sent_on) = '$day_before_yesterday' AND re_campaign_status IN (0,1) AND dlr_status = 1";
		   
		$bnl_campaign_success_count_Res = $mysqli->query($bnl_campaign_success_count_query);	 
		$bnl_campaign_success_count = $bnl_campaign_success_count_Res->fetch_assoc(); 
		$total_bnl_success_submission = $bnl_campaign_success_count['totalBNLSuccessSub'];
		
		     

		//Get striker campaign IDEA submission report
	    	$iea_campaign_count_query = "SELECT sum(sms_count) as totalIEASub FROM campaigns_to WHERE port_no IN ($ideaPortStr) AND date(sent_on) = '$day_before_yesterday' AND re_campaign_status IN (0) AND (error_code is not null or error_code !='SB2' or error_code != '')";
		  
		$iea_campaign_count_Res = $mysqli->query($iea_campaign_count_query);	 
		$iea_campaign_count = $iea_campaign_count_Res->fetch_assoc(); 
		$total_iea_submission = $iea_campaign_count['totalIEASub']; 

		    
		//Get striker campaign IDEA submission Success report
	    	 $iea_campaign_success_count_query = "SELECT sum(sms_count) as totalIEASuccessSub FROM campaigns_to WHERE port_no IN ($ideaPortStr) AND date(sent_on) = '$day_before_yesterday' AND re_campaign_status IN (0) AND  dlr_status = 1 ";
		  
		$iea_campaign_success_count_Res = $mysqli->query($iea_campaign_success_count_query);	 
		$iea_campaign_success_count = $iea_campaign_success_count_Res->fetch_assoc(); 
		$total_iea_success_submission = $iea_campaign_success_count['totalIEASuccessSub']; 
		

		
 
		//Get striker campaign BSNL resubmission report
	    	$bnl_campaign_count_query = "SELECT sum(sms_count) as totalBNLReSub FROM campaigns_to_dlr_1st_reprocess WHERE port_no IN ($bsnlPortStr) AND date(delivered_on) = '$day_before_yesterday' ";
		  
		$bnl_campaign_count_Res = $mysqli->query($bnl_campaign_count_query);	 
		$bnl_campaign_count = $bnl_campaign_count_Res->fetch_assoc(); 
		$total_bnl_resubmission = $bnl_campaign_count['totalBNLReSub']; 

 
		//Get striker campaign BSNL resubmission Success report
	    	$bnl_campaign_success_count_query = "SELECT sum(sms_count) as totalBNLSuccessReSub FROM campaigns_to_dlr_1st_reprocess WHERE port_no IN ($bsnlPortStr) AND date(delivered_on) = '$day_before_yesterday' AND  dlr_status = 1 ";
		  
		$bnl_campaign_success_count_Res = $mysqli->query($bnl_campaign_success_count_query);	 
		$bnl_campaign_success_count = $bnl_campaign_success_count_Res->fetch_assoc(); 
		$total_bnl_success_resubmission = $bnl_campaign_success_count['totalBNLSuccessReSub']; 
		
		

		
		//Get striker campaign IDEA resubmission report
	    	$iea_campaign_count_query = "SELECT sum(sms_count) as totalIEAReSub FROM campaigns_to_dlr_2nd_reprocess WHERE port_no IN ($ideaPortStr) AND date(delivered_on) = '$day_before_yesterday' ";
		   
		$iea_campaign_count_Res = $mysqli->query($iea_campaign_count_query);	 
		$iea_campaign_count = $iea_campaign_count_Res->fetch_assoc(); 
		$total_iea_resubmission = $iea_campaign_count['totalIEAReSub']; 
		

		//Get striker campaign IDEA resubmission Success report
	    	$iea_campaign_success_count_query = "SELECT sum(sms_count) as totalIEASuccessReSub FROM campaigns_to_dlr_2nd_reprocess WHERE port_no IN ($ideaPortStr) AND date(delivered_on) = '$day_before_yesterday' AND dlr_status = 1";
		   
		$iea_campaign_success_count_Res = $mysqli->query($iea_campaign_success_count_query);	 
		$iea_campaign_success_count = $iea_campaign_success_count_Res->fetch_assoc(); 
		$total_iea_success_resubmission = $iea_campaign_success_count['totalIEASuccessReSub']; 
		
		
		$bnl_campaign_count_query += $total_iea_resubmission; // Idea resubmission count adding to bsnl submission
		
	          	
		
		$checkIsCampaignAddedToday = $mysqli->query("SELECT * FROM totalSubmissionReport WHERE type = 'campaign' AND service='striker' AND date(dateTime) = '$day_before_yesterday' ");  
		         
		if($checkIsCampaignAddedToday->num_rows > 0)  
		{
			$updateCreditsQ = "UPDATE totalSubmissionReport SET bsnl_submission = '".$total_bnl_submission."',idea_submission = '".$total_iea_submission."',bsnl_resubmission = '".$total_bnl_resubmission."',idea_resubmission = '".$total_iea_resubmission."',bsnl_delivered_submission = '".$total_bnl_success_submission."',
idea_delivered_submission = '".$total_iea_success_submission."',bsnl_delivered_resubmission = '".$total_bnl_success_resubmission."',idea_delivered_resubmission = '".$total_iea_success_resubmission."' WHERE type = 'campaign' AND service = 'striker' AND date(dateTime) = '$day_before_yesterday'";  
			$mysqli->query($updateCreditsQ);  
		  
		}else{   
			$addCreditsQ = "INSERT INTO totalSubmissionReport (bsnl_submission,idea_submission,bsnl_resubmission,idea_resubmission,type,service,dateTime,bsnl_delivered_submission,
idea_delivered_submission,bsnl_delivered_resubmission,idea_delivered_resubmission) VALUES('".$total_bnl_submission."','".$total_iea_submission."','".$total_bnl_resubmission."','".$total_iea_resubmission."','campaign','striker','$day_before_yesterday','".$total_bnl_success_submission."','".$total_iea_success_submission."','".$total_bnl_success_resubmission."','".$total_iea_success_resubmission."')";  
			$mysqli->query($addCreditsQ);
		}  
		
		  
		  
		   
		   
		
		//Get striker api BSNL submission report
	    	$bnl_api_count_query = "SELECT sum(noofmessages) as totalBNLAPISub FROM sms_api_messages WHERE port_no IN ($bsnlPortStr) AND date(ondate) = '$day_before_yesterday' AND re_campaign_status IN (0,1) AND (error_code is not null or error_code !='SB2' or error_code != '')";
		  
		$bnl_api_count_Res = $mysqli->query($bnl_api_count_query);	 
		$bnl_api_count = $bnl_api_count_Res->fetch_assoc(); 
		$total_bnl_submission = $bnl_api_count['totalBNLAPISub']; 
		
		 
		  
		//Get striker api BSNL submission Success report
		$bnl_api_success_count_query = "SELECT sum(noofmessages) as totalBNLAPISuccessSub FROM sms_api_messages WHERE port_no IN ($bsnlPortStr) AND date(ondate) = '$day_before_yesterday' AND re_campaign_status IN (0,1) AND dlr_status = 1";
		  
		$bnl_api_success_count_Res = $mysqli->query($bnl_api_success_count_query);	 
		$bnl_api_success_count = $bnl_api_success_count_Res->fetch_assoc(); 
		$total_bnl_success_submission = $bnl_api_success_count['totalBNLAPISuccessSub']; 
		  
		
		
		//Get striker api IDEA submission report
	    	$iea_api_count_query = "SELECT sum(noofmessages) as totalIEAAPISub FROM sms_api_messages WHERE port_no IN ($ideaPortStr) AND date(ondate) = '$day_before_yesterday' AND re_campaign_status IN (0) AND (error_code is not null or error_code !='SB2' or error_code != '')";
		  
		$iea_api_count_Res = $mysqli->query($iea_api_count_query);	 
		$iea_api_count = $iea_api_count_Res->fetch_assoc(); 
		$total_iea_submission = $iea_api_count['totalIEAAPISub']; 
		
		
		
		//Get striker api IDEA submission Success report
	    	$iea_api_success_count_query = "SELECT sum(noofmessages) as totalIEAAPISuccessSub FROM sms_api_messages WHERE port_no IN ($ideaPortStr) AND date(ondate) = '$day_before_yesterday' AND re_campaign_status IN (0) AND dlr_status = 1";
		  
		$iea_api_success_count_Res = $mysqli->query($iea_api_success_count_query);	 
		$iea_api_success_count = $iea_api_success_count_Res->fetch_assoc(); 
		$total_iea_success_submission = $iea_api_success_count['totalIEAAPISuccessSub'];
		  

		//Get striker api BSNL resubmission report
	    	$bnl_api_count_query = "SELECT sum(noofmessages) as totalBNLAPIReSub FROM sms_api_messages_dlr_1st_reprocess WHERE port_no IN ($bsnlPortStr) AND date(delivered_on) = '$day_before_yesterday' ";
		   
		$bnl_api_count_Res = $mysqli->query($bnl_api_count_query);	 
		$bnl_api_count = $bnl_api_count_Res->fetch_assoc(); 
		$total_bnl_resubmission = $bnl_api_count['totalBNLAPIReSub']; 
		
		
		
		//Get striker api BSNL resubmission Success report
	    	$bnl_api_success_count_query = "SELECT sum(noofmessages) as totalBNLAPISuccessReSub FROM sms_api_messages_dlr_1st_reprocess WHERE port_no IN ($bsnlPortStr) AND date(delivered_on) = '$day_before_yesterday' AND dlr_status = 1";
		   
		$bnl_api_success_count_Res = $mysqli->query($bnl_api_success_count_query);	 
		$bnl_api_success_count = $bnl_api_success_count_Res->fetch_assoc(); 
		$total_bnl_success_resubmission = $bnl_api_success_count['totalBNLAPISuccessReSub']; 
		   
		    
		//Get striker api IDEA resubmission report
	    	$iea_api_count_query = "SELECT sum(noofmessages) as totalIEAAPIReSub FROM sms_api_messages_dlr_2nd_reprocess WHERE port_no IN ($ideaPortStr) AND date(delivered_on) = '$day_before_yesterday' ";
		    
		$iea_api_count_Res = $mysqli->query($iea_api_count_query);	 
		$iea_api_count = $iea_api_count_Res->fetch_assoc(); 
		$total_iea_resubmission = $iea_api_count['totalIEAAPIReSub'];  
		
		
		//Get striker api IDEA resubmission Success report
	    	$iea_api_success_count_query = "SELECT sum(noofmessages) as totalIEAAPISuccessReSub FROM sms_api_messages_dlr_2nd_reprocess WHERE port_no IN ($ideaPortStr) AND date(delivered_on) = '$day_before_yesterday' AND dlr_status = 1";
		    
		$iea_api_success_count_Res = $mysqli->query($iea_api_success_count_query);	 
		$iea_api_success_count = $iea_api_success_count_Res->fetch_assoc(); 
		$total_iea_success_resubmission = $iea_api_success_count['totalIEAAPISuccessReSub'];  
		
		
		
		$bnl_api_count_query += $total_iea_resubmission; // Idea resubmission count adding to bsnl submission
		
		
		
		$checkIsAPIAddedToday = $mysqli->query("SELECT * FROM totalSubmissionReport WHERE type = 'api' AND service='striker' AND date(dateTime) = '$day_before_yesterday' ");
		if($checkIsAPIAddedToday->num_rows > 0)  
		{
			$updateCreditsQ = "UPDATE totalSubmissionReport SET bsnl_submission = '".$total_bnl_submission."',idea_submission = '".$total_iea_submission."',bsnl_resubmission = '".$total_bnl_resubmission."',idea_resubmission = '".$total_iea_resubmission."' ,bsnl_delivered_submission = '".$total_bnl_success_submission."',
idea_delivered_submission = '".$total_iea_success_submission."',bsnl_delivered_resubmission = '".$total_bnl_success_resubmission."',idea_delivered_resubmission = '".$total_iea_success_resubmission."' WHERE type = 'api' AND service = 'striker' AND date(dateTime) = '$day_before_yesterday'";
			$mysqli->query($updateCreditsQ);
		  
		}else{ 
			$addCreditsQ = "INSERT INTO totalSubmissionReport (bsnl_submission,idea_submission,bsnl_resubmission,idea_resubmission,type,service,dateTime,bsnl_delivered_submission,
idea_delivered_submission,bsnl_delivered_resubmission,idea_delivered_resubmission) VALUES('".$total_bnl_submission."','".$total_iea_submission."','".$total_bnl_resubmission."','".$total_iea_resubmission."','api','striker','$day_before_yesterday','".$total_bnl_success_submission."','".$total_iea_success_submission."','".$total_bnl_success_resubmission."','".$total_iea_success_resubmission."')";    
		$mysqli->query($addCreditsQ);
		}
		
		
		
		 
		  
		
		//Get striker ftp BSNL submission report
	    	$bnl_ftp_count_query = "SELECT sum(sms_count) as totalBNLFTPSub FROM ftp_campaigns_to WHERE port_no IN ($bsnlPortStr) AND date(sent_on) = '$day_before_yesterday'  AND (error_code is not null or error_code !='SB2' or error_code != '') ";
		    
		$bnl_ftp_count_Res = $mysqli->query($bnl_ftp_count_query);	 
		$bnl_ftp_count = $bnl_ftp_count_Res->fetch_assoc(); 
		$total_bnl_submission = $bnl_ftp_count['totalBNLFTPSub']; 
		
		
		
		//Get striker ftp BSNL submission Success report
	    	$bnl_ftp_success_count_query = "SELECT sum(sms_count) as totalBNLFTPSuccessSub FROM ftp_campaigns_to WHERE port_no IN ($bsnlPortStr) AND date(sent_on) = '$day_before_yesterday'  AND dlr_status = 1 ";
		    
		$bnl_ftp_success_count_Res = $mysqli->query($bnl_ftp_success_count_query);	 
		$bnl_ftp_success_count = $bnl_ftp_success_count_Res->fetch_assoc(); 
		$total_bnl_success_submission = $bnl_ftp_success_count['totalBNLFTPSuccessSub']; 
		
		
		
		  
		//Get striker ftp IDEA submission report
	    	$iea_ftp_count_query = "SELECT sum(sms_count) as totalIEAFTPSub FROM ftp_campaigns_to WHERE port_no IN ($ideaPortStr) AND date(sent_on) = '$day_before_yesterday'  AND (error_code is not null or error_code !='SB2' or error_code != '') ";
		  
		$iea_ftp_count_Res = $mysqli->query($iea_ftp_count_query);	 
		$iea_ftp_count = $iea_ftp_count_Res->fetch_assoc(); 
		$total_iea_submission = $iea_ftp_count['totalIEAFTPSub']; 
		 
		$total_bnl_resubmission = $total_iea_resubmission = 0;     
		
		
		
		
		//Get striker ftp IDEA submission Success report
	    	$iea_ftp_success_count_query = "SELECT sum(sms_count) as totalIEAFTPSuccessSub FROM ftp_campaigns_to WHERE port_no IN ($ideaPortStr) AND date(sent_on) = '$day_before_yesterday'  AND dlr_status = 1 ";
		  
		$iea_ftp_success_count_Res = $mysqli->query($iea_ftp_success_count_query);	 
		$iea_ftp_success_count = $iea_ftp_success_count_Res->fetch_assoc(); 
		$total_iea_success_submission = $iea_ftp_success_count['totalIEAFTPSuccessSub']; 
		 
		 
		 
		$total_bnl_resubmission = $total_iea_resubmission = $total_iea_success_resubmission = 0;
		$total_bnl_success_resubmission = 0;
		
		
		$checkIsFTPAddedToday = $mysqli->query("SELECT * FROM totalSubmissionReport WHERE type = 'ftp' AND service='striker' AND date(dateTime) = '$day_before_yesterday' ");
		if($checkIsFTPAddedToday->num_rows > 0)  
		{
			$updateCreditsQ = "UPDATE totalSubmissionReport SET bsnl_submission = '".$total_bnl_submission."',idea_submission = '".$total_iea_submission."',bsnl_resubmission = '".$total_bnl_resubmission."',idea_resubmission = '".$total_iea_resubmission."' ,bsnl_delivered_submission = '".$total_bnl_success_submission."',
idea_delivered_submission = '".$total_iea_success_submission."',bsnl_delivered_resubmission = '".$total_bnl_success_resubmission."',idea_delivered_resubmission = '".$total_iea_success_resubmission."' WHERE type = 'ftp' AND service = 'striker' AND date(dateTime) = '$day_before_yesterday'";
			$mysqli->query($updateCreditsQ);
		  
		}else{   
			$addCreditsQ = "INSERT INTO totalSubmissionReport (bsnl_submission,idea_submission,bsnl_resubmission,idea_resubmission,type,service,dateTime,bsnl_delivered_submission,
idea_delivered_submission,bsnl_delivered_resubmission,idea_delivered_resubmission) VALUES('".$total_bnl_submission."','".$total_iea_submission."','".$total_bnl_resubmission."','".$total_iea_resubmission."','ftp','striker','$day_before_yesterday','".$total_bnl_success_submission."','".$total_iea_success_submission."','".$total_bnl_success_resubmission."','".$total_iea_success_resubmission."')";   
			$mysqli->query($addCreditsQ); 
		}
		
		
		
		  
		
		
		
		/**  ----------------------- POINTSMS -----------------------  **/
		
	   	//Get pointsms campaign BSNL submission report
	    	$bnl_campaign_count_query = "SELECT sum(sms_count) as totalBNLSub FROM sms_reseller.campaigns_to WHERE port_no IN ($bsnlPortStr) AND date(sent_on) = '$day_before_yesterday' AND re_campaign_status IN (0,1) AND (error_code is not null or error_code !='SB2' or error_code != '')";
		  
		$bnl_campaign_count_Res = $mysqli->query($bnl_campaign_count_query);	 
		$bnl_campaign_count = $bnl_campaign_count_Res->fetch_assoc(); 
		$total_bnl_submission = $bnl_campaign_count['totalBNLSub']; 
		
		
		
		//Get pointsms campaign BSNL submission Success report
	    	$bnl_campaign_success_count_query = "SELECT sum(sms_count) as totalBNLSuccessSub FROM sms_reseller.campaigns_to WHERE port_no IN ($bsnlPortStr) AND date(sent_on) = '$day_before_yesterday' AND re_campaign_status IN (0,1) AND dlr_status = 1";
		  
		$bnl_campaign_success_count_Res = $mysqli->query($bnl_campaign_success_count_query);	 
		$bnl_campaign_success_count = $bnl_campaign_success_count_Res->fetch_assoc(); 
		$total_bnl_success_submission = $bnl_campaign_success_count['totalBNLSuccessSub'];
		
		
		
		//Get pointsms campaign IDEA submission report
	    	$iea_campaign_count_query = "SELECT sum(sms_count) as totalIEASub FROM sms_reseller.campaigns_to WHERE port_no IN ($ideaPortStr) AND date(sent_on) = '$day_before_yesterday' AND re_campaign_status IN (0) AND (error_code is not null or error_code !='SB2' or error_code != '')";
		  
		$iea_campaign_count_Res = $mysqli->query($iea_campaign_count_query);	 
		$iea_campaign_count = $iea_campaign_count_Res->fetch_assoc(); 
		$total_iea_submission = $iea_campaign_count['totalIEASub']; 
		
		
		
		
		//Get pointsms campaign IDEA submission Success report
	    	$iea_campaign_success_count_query = "SELECT sum(sms_count) as totalIEASuccessSub FROM sms_reseller.campaigns_to WHERE port_no IN ($ideaPortStr) AND date(sent_on) = '$day_before_yesterday' AND re_campaign_status IN (0) AND dlr_status = 1";
		  
		$iea_campaign_success_count_Res = $mysqli->query($iea_campaign_success_count_query);	 
		$iea_campaign_success_count = $iea_campaign_success_count_Res->fetch_assoc(); 
		$total_iea_success_submission = $iea_campaign_success_count['totalIEASuccessSub']; 
		

		//Get pointsms campaign BSNL resubmission report
	    	$bnl_campaign_count_query = "SELECT sum(sms_count) as totalBNLReSub FROM sms_reseller.campaigns_to_dlr_1st_reprocess WHERE port_no IN ($bsnlPortStr) AND date(delivered_on) = '$day_before_yesterday' ";
		  
		$bnl_campaign_count_Res = $mysqli->query($bnl_campaign_count_query);	 
		$bnl_campaign_count = $bnl_campaign_count_Res->fetch_assoc(); 
		$total_bnl_resubmission = $bnl_campaign_count['totalBNLReSub']; 
		
		
		//Get pointsms campaign BSNL resubmission Success report
	    	$bnl_campaign_success_count_query = "SELECT sum(sms_count) as totalBNLSuccessReSub FROM sms_reseller.campaigns_to_dlr_1st_reprocess WHERE port_no IN ($bsnlPortStr) AND date(delivered_on) = '$day_before_yesterday' AND dlr_status = 1";
		  
		$bnl_campaign_success_count_Res = $mysqli->query($bnl_campaign_success_count_query);	 
		$bnl_campaign_success_count = $bnl_campaign_success_count_Res->fetch_assoc(); 
		$total_bnl_success_resubmission = $bnl_campaign_success_count['totalBNLSuccessReSub']; 
		
		   
		
		//Get pointsms campaign IDEA resubmission report
	    	$iea_campaign_count_query = "SELECT sum(sms_count) as totalIEAReSub FROM sms_reseller.campaigns_to_dlr_2nd_reprocess WHERE port_no IN ($ideaPortStr) AND date(delivered_on) = '$day_before_yesterday' ";
		  
		$iea_campaign_count_Res = $mysqli->query($iea_campaign_count_query);	 
		$iea_campaign_count = $iea_campaign_count_Res->fetch_assoc(); 
		$total_iea_resubmission = $iea_campaign_count['totalIEAReSub']; 
		
		
		
		//Get pointsms campaign IDEA resubmission Success report
	    	$iea_campaign_success_count_query = "SELECT sum(sms_count) as totalIEASuccessReSub FROM sms_reseller.campaigns_to_dlr_2nd_reprocess WHERE port_no IN ($ideaPortStr) AND date(delivered_on) = '$day_before_yesterday'  AND dlr_status = 1";
		  
		$iea_campaign_success_count_Res = $mysqli->query($iea_campaign_success_count_query);	 
		$iea_campaign_success_count = $iea_campaign_success_count_Res->fetch_assoc(); 
		$total_iea_success_resubmission = $iea_campaign_success_count['totalIEASuccessReSub']; 
		
		
		
		
		$bnl_campaign_count_query += $total_iea_resubmission; // Idea resubmission count adding to bsnl submission
		
		
		
		$checkIsPointsmsCampaignAddedToday = $mysqli->query("SELECT * FROM totalSubmissionReport WHERE type = 'campaign' AND service='pointsms' AND date(dateTime) = '$day_before_yesterday' ");
		if($checkIsPointsmsCampaignAddedToday->num_rows > 0)  
		{
			$updateCreditsQ = "UPDATE totalSubmissionReport SET bsnl_submission = '".$total_bnl_submission."',idea_submission = '".$total_iea_submission."',bsnl_resubmission = '".$total_bnl_resubmission."',idea_resubmission = '".$total_iea_resubmission."',bsnl_delivered_submission = '".$total_bnl_success_submission."',
idea_delivered_submission = '".$total_iea_success_submission."',bsnl_delivered_resubmission = '".$total_bnl_success_resubmission."',idea_delivered_resubmission = '".$total_iea_success_resubmission."' WHERE type = 'campaign' AND service = 'pointsms' AND date(dateTime) = '$day_before_yesterday'";
			$mysqli->query($updateCreditsQ);
		   
		}else{   
			$addCreditsQ = "INSERT INTO totalSubmissionReport (bsnl_submission,idea_submission,bsnl_resubmission,idea_resubmission,type,service,dateTime,bsnl_delivered_submission,
idea_delivered_submission,bsnl_delivered_resubmission,idea_delivered_resubmission) VALUES('".$total_bnl_submission."','".$total_iea_submission."','".$total_bnl_resubmission."','".$total_iea_resubmission."','campaign','pointsms','$day_before_yesterday','".$total_bnl_success_submission."','".$total_iea_success_submission."','".$total_bnl_success_resubmission."','".$total_iea_success_resubmission."')";   
			$mysqli->query($addCreditsQ); 
		}
		
		
		
		  
		
		//Get pointsms api BSNL submission report
	    	$bnl_api_count_query = "SELECT sum(noofmessages) as totalBNLAPISub FROM sms_reseller.sms_api_messages WHERE port_no IN ($bsnlPortStr) AND date(ondate) = '$day_before_yesterday' AND re_campaign_status IN (0,1) AND (error_code is not null or error_code !='SB2' or error_code != '')";
		  
		$bnl_api_count_Res = $mysqli->query($bnl_api_count_query);	 
		$bnl_api_count = $bnl_api_count_Res->fetch_assoc(); 
		$total_bnl_submission = $bnl_api_count['totalBNLAPISub']; 
		
		
		//Get pointsms api BSNL submission Success report
	    	$bnl_api_success_count_query = "SELECT sum(noofmessages) as totalBNLAPISuccessSub FROM sms_reseller.sms_api_messages WHERE port_no IN ($bsnlPortStr) AND date(ondate) = '$day_before_yesterday' AND re_campaign_status IN (0,1)  AND dlr_status = 1";
		  
		$bnl_api_success_count_Res = $mysqli->query($bnl_api_success_count_query);	 
		$bnl_api_success_count = $bnl_api_success_count_Res->fetch_assoc(); 
		$total_bnl_success_submission = $bnl_api_success_count['totalBNLAPISuccessSub']; 
		
		
		//Get pointsms api IDEA submission report
	    	$iea_api_count_query = "SELECT sum(noofmessages) as totalIEAAPISub FROM sms_reseller.sms_api_messages WHERE port_no IN ($ideaPortStr) AND date(ondate) = '$day_before_yesterday' AND re_campaign_status IN (0) AND (error_code is not null or error_code !='SB2' or error_code != '')";
		  
		$iea_api_count_Res = $mysqli->query($iea_api_count_query);	   
		$iea_api_count = $iea_api_count_Res->fetch_assoc(); 
		$total_iea_submission = $iea_api_count['totalIEAAPISub'];   
		
		
		//Get pointsms api IDEA submission Success report
	    	$iea_api_success_count_query = "SELECT sum(noofmessages) as totalIEAAPISuccessSub FROM sms_reseller.sms_api_messages WHERE port_no IN ($ideaPortStr) AND date(ondate) = '$day_before_yesterday' AND re_campaign_status IN (0) AND dlr_status = 1";
		  
		$iea_api_success_count_Res = $mysqli->query($iea_api_success_count_query);	   
		$iea_api_success_count = $iea_api_success_count_Res->fetch_assoc(); 
		$total_iea_success_submission = $iea_api_success_count['totalIEAAPISuccessSub']; 
		  

		//Get pointsms api BSNL resubmission report
	    	$bnl_api_count_query = "SELECT sum(noofmessages) as totalBNLAPIReSub FROM sms_reseller.sms_api_messages_dlr_1st_reprocess WHERE port_no IN ($bsnlPortStr) AND date(delivered_on) = '$day_before_yesterday' ";
		   
		$bnl_api_count_Res = $mysqli->query($bnl_api_count_query);	 
		$bnl_api_count = $bnl_api_count_Res->fetch_assoc(); 
		$total_bnl_resubmission = $bnl_api_count['totalBNLAPIReSub']; 
		
		
		
		//Get pointsms api BSNL resubmission Success report
	    	$bnl_api_success_count_query = "SELECT sum(noofmessages) as totalBNLAPISuccessReSub FROM sms_reseller.sms_api_messages_dlr_1st_reprocess WHERE port_no IN ($bsnlPortStr) AND date(delivered_on) = '$day_before_yesterday' AND dlr_status = 1";
		   
		$bnl_api_success_count_Res = $mysqli->query($bnl_api_success_count_query);	 
		$bnl_api_success_count = $bnl_api_success_count_Res->fetch_assoc(); 
		$total_bnl_success_resubmission = $bnl_api_success_count['totalBNLAPISuccessReSub'];
		
		   
		   
		//Get pointsms api IDEA resubmission report
	    	$iea_api_count_query = "SELECT sum(noofmessages) as totalIEAAPIReSub FROM sms_reseller.sms_api_messages_dlr_2nd_reprocess WHERE port_no IN ($ideaPortStr) AND date(delivered_on) = '$day_before_yesterday' ";  
		    
		$iea_api_count_Res = $mysqli->query($iea_api_count_query);	 
		$iea_api_count = $iea_api_count_Res->fetch_assoc(); 
		$total_iea_resubmission = $iea_api_count['totalIEAAPIReSub'];  
		
		
		
		//Get pointsms api IDEA resubmission Success report
	    	$iea_api_success_count_query = "SELECT sum(noofmessages) as totalIEAAPISuccessReSub FROM sms_reseller.sms_api_messages_dlr_2nd_reprocess WHERE port_no IN ($ideaPortStr) AND date(delivered_on) = '$day_before_yesterday'  AND dlr_status = 1";  
		    
		$iea_api_success_count_Res = $mysqli->query($iea_api_success_count_query);	 
		$iea_api_success_count = $iea_api_success_count_Res->fetch_assoc(); 
		$total_iea_success_resubmission = $iea_api_success_count['totalIEAAPISuccessReSub']; 
		
		
		
		$bnl_api_count_query += $total_iea_resubmission; // Idea resubmission count adding to bsnl submission
		
		
		
		$checkIsPointsmsAPIAddedToday = $mysqli->query("SELECT * FROM totalSubmissionReport WHERE type = 'api' AND service='pointsms' AND date(dateTime) = '$day_before_yesterday' ");
		if($checkIsPointsmsAPIAddedToday->num_rows > 0)  
		{
			$updateCreditsQ = "UPDATE totalSubmissionReport SET bsnl_submission = '".$total_bnl_submission."',idea_submission = '".$total_iea_submission."',bsnl_resubmission = '".$total_bnl_resubmission."',idea_resubmission = '".$total_iea_resubmission."' ,bsnl_delivered_submission = '".$total_bnl_success_submission."',
idea_delivered_submission = '".$total_iea_success_submission."',bsnl_delivered_resubmission = '".$total_bnl_success_resubmission."',idea_delivered_resubmission = '".$total_iea_success_resubmission."' WHERE type = 'api' AND service = 'pointsms' AND date(dateTime) = '$day_before_yesterday'";
			$mysqli->query($updateCreditsQ);
		      
		}else{    
			$addCreditsQ = "INSERT INTO totalSubmissionReport (bsnl_submission,idea_submission,bsnl_resubmission,idea_resubmission,type,service,dateTime,bsnl_delivered_submission,
idea_delivered_submission,bsnl_delivered_resubmission,idea_delivered_resubmission) VALUES('".$total_bnl_submission."','".$total_iea_submission."','".$total_bnl_resubmission."','".$total_iea_resubmission."','api','pointsms','$day_before_yesterday','".$total_bnl_success_submission."','".$total_iea_success_submission."','".$total_bnl_success_resubmission."','".$total_iea_success_resubmission."')";   
			$mysqli->query($addCreditsQ);
		}
   	}
}   	
     	


  


?>
