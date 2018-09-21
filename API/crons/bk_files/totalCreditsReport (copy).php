<?php
  
getTotalCreditsReport();

function getTotalCreditsReport() {
	$server_ip = 'localhost';  $db_user = 'devel'; $db_pass = 'D3v3l09@511';  $db_name = 'sms';   
	$mysqli = new mysqli($server_ip, $db_user, $db_pass, $db_name);

   	$day_before_yesterday = date("Y-m-d", strtotime("-1 days")); 

   



	/**  SMSSTRIKER API REPORT  **/
	$dndCount = $totalSMSCredits = $failedCredits = $deliveredCredits = $pendingCount = 0;
	$getRepots = "SELECT tid FROM totalSMSCredits WHERE date(dateTime) = '$day_before_yesterday' AND service = 'striker' AND type = 'api'  ";  
	$getRepotsRes = $mysqli->query($getRepots);  
	if($getRepotsRes->num_rows == 0) {
	  	$total_count_query = "select sum(noofmessages) as sms_count from sms_api_messages where date(ondate)='$day_before_yesterday'";
		$total_count_rs = $mysqli->query($total_count_query); 

		if($total_count_rs->num_rows > 0) {     
			$total_count_val = $total_count_rs->fetch_assoc();
			$totalSMSCredits = $total_count_val['sms_count'];  
	 
			$api_count_query="select sum(noofmessages) as totalCredits,dlr_status,error_code from sms_api_messages where date(ondate)='$day_before_yesterday' GROUP BY dlr_status";
	  
			$api_count_queryRes = $mysqli->query($api_count_query);	 
			while($val = $api_count_queryRes->fetch_assoc()) {
				if($val['dlr_status'] == 3 || ($val['dlr_status'] == 16 && $val['error_code'] == '0x00000481' )) {
					  $dndCount += $val['totalCredits'];
				}else if($val['dlr_status'] == 0 || $val['dlr_status'] == NULL) {
					  $pendingCount += $val['totalCredits'];
				} else if($val['dlr_status'] == 1 ) {  
					  $deliveredCredits = $val['totalCredits'];
				} else{
					  $failedCredits += $val['totalCredits'];
				}
	  
			}      
			if($totalSMSCredits > 0) {			
	 			$addCreditsQ = "INSERT INTO totalSMSCredits (total_numbers_count,pending_count,failed_count,dnd_count,delivered_count,type,service,dateTime) VALUES('".$totalSMSCredits."','".$pendingCount."','".$failedCredits."','".$dndCount."','".$deliveredCredits."','api','striker','".$day_before_yesterday."')";  
				$mysqli->query($addCreditsQ); 
				 
			}
		}
	}    
      
  


  




	/**  SMSSTRIKER FTP CAMPAIGN REPORT **/

	$dndCount = $totalSMSCredits = $failedCredits = $deliveredCredits = $pendingCount = 0;
	$getRepot = "SELECT tid FROM totalSMSCredits WHERE date(dateTime) = '$day_before_yesterday' AND service = 'striker' AND type = 'ftp'   ";  
	$getRepotRes = $mysqli->query($getRepot);  
	if($getRepotRes->num_rows == 0) { 
		$campaigns_query = "select sum(no_of_messages) as sms_count from ftp_campaign where is_scheduled = 0 and status = 3 and date(created_date_time)= '$day_before_yesterday'";
		$campaigns_rs = $mysqli->query($campaigns_query);
	 
		if($campaigns_rs->num_rows > 0) {    
			$total_count_val = $campaigns_rs->fetch_assoc();
			$totalSMSCredits = $total_count_val['sms_count'];    
			$query = "SELECT sum(sms_count) as totalCredits,dlr_status,error_code FROM `ftp_campaigns_to` where date(sent_on) = '$day_before_yesterday' group by dlr_status";

			$campaigns_rs = $mysqli->query($query);	 
			while($val = $campaigns_rs->fetch_assoc()) {
				if($val['dlr_status'] == 3 || ($val['dlr_status'] == 16 && $val['error_code'] == '0x00000481' )) {
					  $dndCount += $val['totalCredits'];
				}else if($val['dlr_status'] == 0 || $val['dlr_status'] == NULL) {
					  $pendingCount += $val['totalCredits'];
				} else if($val['dlr_status'] == 1 ) {
					  $deliveredCredits = $val['totalCredits'];
				} else{
					  $failedCredits += $val['totalCredits'];
				}
	    
			}     
 

			if($totalSMSCredits > 0) {			
				$addCreditsQ = "INSERT INTO totalSMSCredits (total_numbers_count,pending_count,failed_count,dnd_count,delivered_count,type,service,dateTime) VALUES('".$totalSMSCredits."','".$pendingCount."','".$failedCredits."','".$dndCount."','".$deliveredCredits."','ftp','striker','".$day_before_yesterday."')";  
				$mysqli->query($addCreditsQ);  
			}  
		}    
	}   
  


   





	/**  SMSSTRIKER SCHEDULE & NON - SCHEDULE CAMPAIGNS REPORT  **/

	$dndCount = $totalSMSCredits = $failedCredits = $deliveredCredits = $pendingCount = 0;
	$getReportss = "SELECT tid FROM totalSMSCredits WHERE date(dateTime) = '$day_before_yesterday' AND service = 'striker' AND type = 'campaign'   ";  
	$getReportssRes = $mysqli->query($getReportss);  
	if($getReportssRes->num_rows == 0) { 
		$campaigns_query = "select campaign_id,sum(no_of_messages) as noOfMessages  from campaigns where is_scheduled = 0 and campaign_status = 2 and date(created_on)= '$day_before_yesterday'";
		$campaigns_rs = $mysqli->query($campaigns_query); 
		if($campaigns_rs->num_rows > 0) { 
			$campaignsRes = $campaigns_rs->fetch_assoc();	 
	   		$totalSMSCredits = $campaignsRes['noOfMessages'];  
			$query = "SELECT sum(sms_count) as totalCredits,dlr_status,error_code FROM `campaigns_to` where campaign_id IN (select campaign_id from campaigns where is_scheduled = 0  and campaign_status = 2 and date(created_on)= '$day_before_yesterday') AND  date(sent_on) = '$day_before_yesterday' group by dlr_status";   
			$campaigns_rs = $mysqli->query($query);	 
			while($val = $campaigns_rs->fetch_assoc()) { 
				if($val['dlr_status'] == 3  || ($val['dlr_status'] == 16 && $val['error_code'] == '0x00000481' )) {
					  $dndCount += $val['totalCredits'];
				}else if($val['dlr_status'] == 0 || $val['dlr_status'] == NULL) {
					  $pendingCount += $val['totalCredits'];
				} else if($val['dlr_status'] == 1 ) {
					  $deliveredCredits = $val['totalCredits'];
				} else{
					  $failedCredits +=$val['totalCredits'];
				} 
			}   
		}  
	 

	 
		$campaigns_query = "select campaign_id,sum(no_of_messages) as noOfMessages  from campaigns where is_scheduled = 1 and campaign_status = 2  and date(scheduled_on)= '$day_before_yesterday'";
		$campaigns_rs = $mysqli->query($campaigns_query); 
		if($campaigns_rs->num_rows > 0) { 
			$campaignsRes = $campaigns_rs->fetch_assoc();	 
	   		$totalSMSCredits += $campaignsRes['noOfMessages'];  
			$query = "SELECT sum(sms_count) as totalCredits,dlr_status,error_code FROM `campaigns_to` where campaign_id IN (select campaign_id from campaigns where is_scheduled = 1  and campaign_status = 2 and date(scheduled_on)= '$day_before_yesterday') AND  date(sent_on) = '$day_before_yesterday' group by dlr_status";   
			$campaigns_rs = $mysqli->query($query);	   
			while($val = $campaigns_rs->fetch_assoc()) { 
				if($val['dlr_status'] == 3 || ($val['dlr_status'] == 16 && $val['error_code'] == '0x00000481' ) ) {  
					  $dndCount += $val['totalCredits'];
				}else if($val['dlr_status'] == 0 || $val['dlr_status'] == NULL) {
					  $pendingCount += $val['totalCredits'];
				} else if($val['dlr_status'] == 1 ) {
					  $deliveredCredits += $val['totalCredits'];
				} else{
					  $failedCredits += $val['totalCredits'];
				}     
			}            
   
			if($totalSMSCredits > 0) { 
			
				$addCreditsQ = "INSERT INTO totalSMSCredits (total_numbers_count,pending_count,failed_count,dnd_count,delivered_count,type,service,dateTime) VALUES('".$totalSMSCredits."','".$pendingCount."','".$failedCredits."','".$dndCount."','".$deliveredCredits."','campaign','striker','".$day_before_yesterday."')";  
				$mysqli->query($addCreditsQ); 
			}
		}   
  
	}  
	
 






	/**  POINTSMS SCHEDULE & NON - SCHEDULE CAMPAIGNS REPORT **/ 

	$dndCount = $totalSMSCredits = $failedCredits = $deliveredCredits = $pendingCount = 0;
	$getReports = "SELECT tid FROM totalSMSCredits WHERE date(dateTime) = '$day_before_yesterday'  AND service = 'pointsms' AND type = 'campaign'  ";  
	$getReportsRes = $mysqli->query($getReports);  
	if($getReportsRes->num_rows == 0) {
		$campaigns_query = "select campaign_id,sum(no_of_messages) as noOfMessages  from sms_reseller.campaigns where is_scheduled = 0 and campaign_status = 2  and date(created_on)= '$day_before_yesterday'"; 
		$campaigns_rs = $mysqli->query($campaigns_query); 
		if($campaigns_rs->num_rows > 0) { 
			$campaignsRes = $campaigns_rs->fetch_assoc();	 
	   		$totalSMSCredits = $campaignsRes['noOfMessages'];  
			$query = "SELECT sum(sms_count) as totalCredits,dlr_status,error_code FROM sms_reseller.campaigns_to where campaign_id IN (select campaign_id from sms_reseller.campaigns where is_scheduled = 0 and campaign_status = 2  and date(created_on)= '$day_before_yesterday') AND  date(sent_on) = '$day_before_yesterday' group by dlr_status";  
			$campaigns_rs = $mysqli->query($query);	   
			while($val = $campaigns_rs->fetch_assoc()) {   
				if($val['dlr_status'] == 3 || ($val['dlr_status'] == 16 && $val['error_code'] == '0x00000481')) {  
					  $dndCount += $val['totalCredits'];
				}else if($val['dlr_status'] == 0 || $val['dlr_status'] == NULL) {
					  $pendingCount += $val['totalCredits'];
				} else if($val['dlr_status'] == 1 ) {
					  $deliveredCredits = $val['totalCredits'];
				} else{
					  $failedCredits += $val['totalCredits'];
				}     
			}   

		} 
	  
		$campaigns_query = "select campaign_id,sum(no_of_messages) as noOfMessages  from sms_reseller.campaigns where is_scheduled = 1 and campaign_status = 2  and date(scheduled_on)= '$day_before_yesterday'"; 
		$campaigns_rs = $mysqli->query($campaigns_query); 
		if($campaigns_rs->num_rows > 0) {   
			$campaignsRes = $campaigns_rs->fetch_assoc();	 
	   		$totalSMSCredits += $campaignsRes['noOfMessages'];  
			$query = "SELECT sum(sms_count) as totalCredits,dlr_status,error_code FROM sms_reseller.campaigns_to where campaign_id IN (select campaign_id from sms_reseller.campaigns where is_scheduled = 1 and campaign_status = 2 and date(scheduled_on)= '$day_before_yesterday') AND  date(sent_on) = '$day_before_yesterday' group by dlr_status";  
			$campaigns_rs = $mysqli->query($query);	   
			while($val = $campaigns_rs->fetch_assoc()) {     
				if($val['dlr_status'] == 3 || ($val['dlr_status'] == 16 && $val['error_code'] == '0x00000481') ) {    
					  $dndCount += $val['totalCredits'];
				}else if($val['dlr_status'] == 0 || $val['dlr_status'] == NULL) {
					  $pendingCount += $val['totalCredits'];
				} elseif($val['dlr_status'] == 1 ) {
					  $deliveredCredits += $val['totalCredits'];
				} else{
					  $failedCredits += $val['totalCredits'];
				}     
			}              
      
 
			if($totalSMSCredits > 0) {			
				$addCreditsQ = "INSERT INTO totalSMSCredits (total_numbers_count,pending_count,failed_count,dnd_count,delivered_count,type,service,dateTime) VALUES('".$totalSMSCredits."','".$pendingCount."','".$failedCredits."','".$dndCount."','".$deliveredCredits."','campaign','pointsms','".$day_before_yesterday."')";  
			 	$mysqli->query($addCreditsQ); 
			}
		}   

	}  
	



 



	/**  POINTSMS API REPORT   **/

	$dndCount = $totalSMSCredits = $failedCredits = $deliveredCredits = $pendingCount = 0;
	$getReport = "SELECT tid FROM totalSMSCredits WHERE date(dateTime) = '$day_before_yesterday'  AND service = 'pointsms' AND type = 'api' ";  
	$getReportRes = $mysqli->query($getReport);  
	if($getReportRes->num_rows == 0) {  
		$campaigns_query = "select sum(noofmessages) as noOfMessages  from sms_reseller.sms_api_messages where date(ondate)= '$day_before_yesterday'"; 
		$campaigns_rs = $mysqli->query($campaigns_query); 
		if($campaigns_rs->num_rows > 0) {   
			$campaignsRes = $campaigns_rs->fetch_assoc();	 
	   		$totalSMSCredits = $campaignsRes['noOfMessages'];  
			$query = "select sum(noofmessages) as totalCredits,dlr_status,error_code from sms_reseller.sms_api_messages where date(ondate)= '$day_before_yesterday' group by dlr_status";    
			$campaigns_rs = $mysqli->query($query);	   
			while($val = $campaigns_rs->fetch_assoc()) {   
				if($val['dlr_status'] == 3  || ($val['dlr_status'] == 16 && $val['error_code'] == '0x00000481')) {    
					  $dndCount += $val['totalCredits'];
				}else if($val['dlr_status'] == 0 || $val['dlr_status'] == NULL) {
					  $pendingCount += $val['totalCredits'];
				} else if($val['dlr_status'] == 1 ) {
					  $deliveredCredits =$val['totalCredits'];
				} else{
					  $failedCredits +=$val['totalCredits'];
				}     
			}              
      
			if($totalSMSCredits > 0) {
			
				$addCreditsQ = "INSERT INTO totalSMSCredits (total_numbers_count,pending_count,failed_count,dnd_count,delivered_count,type,service,dateTime) VALUES('".$totalSMSCredits."','".$pendingCount."','".$failedCredits."','".$dndCount."','".$deliveredCredits."','api','pointsms','".$day_before_yesterday."')";  
				$mysqli->query($addCreditsQ); 
			}
		}   

	} 
 

         
	 
	$reportQ = "SELECT * FROM totalSMSCredits WHERE date(dateTime) = '$day_before_yesterday'  ";  
	$reportQRes = $mysqli->query($reportQ);  
	 
	if($reportQRes->num_rows > 0) {
		$mailContent = "<html><h4>Dear Sir,</h4></br><p style='margin-left:20px;'>Below are the total credits report of SMSSTRIKER & POINTSMS. </p></br>";
		$mailContent .= "<head>  
			<style>table { border-collapse: collapse;}table, td, th {  border: 1px solid #01acf9;}</style>
			</head>
			<table border='0' cellpadding='0' cellspacing='0' id='product-table' width='100%'>
			<thead class='table-thead'>
			    <tr >
				<th rowspan='5' align='center'><a>On Date</a></th>
				<th colspan='4' align='center'><a>SMSSTRIKER</a></th>
				<th colspan='4' align='center'><a>POINTSMS</a></th>
				<th rowspan='2' align='center'><a>Type</a></th>
			    </tr>
			    <tr>
				<th align='center'><a>Total</a></th>
				<th align='center'><a>Pending</a></th>
				<th align='center'><a>Failed</a></th>
				<th align='center'><a>Delivered</a></th>
				<th align='center'><a>Total</a></th>
				<th align='center'><a>Pending</a></th>
				<th align='center'><a>Failed</a></th>
				<th align='center'><a>Delivered</a></th> 
			    </tr> 
			    
			</thead>  
		<tbody> ";	
		$totalSTR = $totalSTRF = $totalSTRD = 0;
		$totalPOI = $totalPOIF = $totalPOID = 0;

		$mailContent .="  <tr> <td rowspan=6 align='center' style='font-weight:bold;'>".$day_before_yesterday."</td> </tr>";	
		while($reportQResult = $reportQRes->fetch_assoc()) {  
	 		$pending_numbersCount = $pending_numbers_count = $total_numbersCount = $total_numbers_count = $delivered_count = $deliveredCount = $failed_count = $failedCount = '0';
	 
			if($reportQResult['service'] == 'striker') {
			  
				$total_numbers_count = $reportQResult['total_numbers_count']; 
				$failed_count = $reportQResult['failed_count']+$reportQResult['dnd_count'];
				$delivered_count = $reportQResult['delivered_count']; 
				$pending_numbersCount = $reportQResult['pending_count'];	  
			}else{
				$total_numbersCount = $reportQResult['total_numbers_count'];
				$failedCount = $reportQResult['failed_count']+$reportQResult['dnd_count'];
				$deliveredCount = $reportQResult['delivered_count'];	  
				$pending_numbers_count = $reportQResult['pending_count'];	  		
			}
		
	  

			$mailContent .=" <tr>	   
						<td align='center'>".$total_numbers_count."</td>
						<td align='center'>".$pending_numbersCount."</td>
						<td align='center'>".$failed_count."</td>
						<td align='center'>".$delivered_count."</td>
						<td align='center'>".$total_numbersCount."</td>
						<td align='center'>".$pending_numbers_count."</td>
						<td align='center'>".$failedCount."</td>
						<td align='center'>".$deliveredCount."</td>
						<td align='center'>".strtoupper($reportQResult['service']).' - '.strtoupper($reportQResult['type'])."</td> 
				 	 </tr>";  
						      
				   		 
	
		 	$totalSTR +=$total_numbers_count;
			$totalSTRF +=$failed_count;
			$totalSTRD +=$delivered_count;
			$totalSTRP +=$pending_numbersCount;	  
	
			$totalPOI +=$total_numbersCount;
			$totalPOIF +=$failedCount;
			$totalPOID +=$deliveredCount;
			$totalPOIP +=$pending_numbers_count;
			$grandTot = $totalSTR+$totalPOI;
	    
		}    
		$mailContent .=" <tr align='center' style='font-weight: bold; color: black;'>
				        <td>Total</td>
				        <td style='font-size:16px;color:#c13002;'>".$totalSTR."</td>
					<td>".$totalSTRP."</td>
				        <td>".$totalSTRF."</td>
				        <td>".$totalSTRD."</td>
				        <td style='font-size:16px;color:#c13002;'>".$totalPOI."</td>
					<td>".$totalPOIP."</td>
				        <td>".$totalPOIF."</td>
				        <td>".$totalPOID."</td>
				        <td>-</td>
		                 </tr>";  


	$mailContent .=" <tr align='center' style='font-weight: bold; color: black;'>
				        <td>Grand Total</td>  
				        <td colspan='8'  style='font-size:16px;color:#c13002;'> ".$totalSTR." + ".$totalPOI." = ".$grandTot ."</td>
					 <td>STRIKER & POINTSMS</td>
		                 </tr></tbody></table></html>";  
   
 
		if($totalSTR > 0 || $totalPOI > 0) {  
			  totalCreditsReport($mailContent);
	 	} 
	}  

}



function totalCreditsReport($mailContent) {
 
	require('/var/www/html/strikerapp/PHPMailer-master/PHPMailerAutoload.php'); 
	$mail = new PHPMailer();
	// set mailer to use SMTP
	$mail->IsSMTP();  
	$mail -> SMTPDebug = 3;
	$mail->Host = 'smtp.sendgrid.net';
	$mail->SMTPAuth = true;     // turn on SMTP authentication
	$mail->Port = 587;
	$mail->Username = "smsstriker";  // SMTP username
	$mail->Password = "striker@123"; // SMTP password
	$mail->FromName = "smsstriker";
	$mail->SetFrom('support@smsstriker.com', 'Daily Report');  
	$mail->AddAddress('naveen@strikersoft.in', 'Daily Report');
	//$mail->AddAddress('sandeepthicse@gmail.com', 'SMSSTRIKER');
	$mail->AddCC('krishna@smsstriker.net', 'Daily Report');	
	$mail->AddCC('prasad.k@smsstriker.in', 'Daily Report');	
	$mail->AddCC('srinivas@smsstriker.net', 'Daily Report');	
	$mail->AddCC('ravi.kathula@smsstriker.net', 'Daily Report');	
	$mail->WordWrap = 50;      
	$mail->IsHTML(true);    
	$mail->Subject = "Daily SMS Report"; 

	
	$mail->Body    = $mailContent;  
	$mail->AltBody = $mailContent; 

	if(!$mail->Send())
	{
		 echo "Message could not be sent. <p>";
		// echo "Mailer Error: " . $mail->ErrorInfo;

	}else{   

		echo "Message has been sent";
	}  
  
}



mysql_close($db);

?>
