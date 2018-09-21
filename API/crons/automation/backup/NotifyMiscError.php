<?php

require_once 'db/config_sms.php'; 
             
include("/var/www/html/strikerapp/smslib/config.inc");     
include("/var/www/html/strikerapp/smslib/functions.inc");       
require('/var/www/html/Reseller_User/PHPMailer-master/PHPMailerAutoload.php');
          
$getReCampaigns = $mysqli->query("SELECT * FROM notify_misc_error WHERE date(created_on) = date(now())  ");  
 
if($getReCampaigns->num_rows > 0 ) {  
	$mailContent  = '<p>Dear Team,</p></br> <p>Please find the following report on misc errors,</p></br> <p><table style="width:50%"><tr><th>S.NO</th><th>Campaign ID</th><th>Misc Errors</th></tr>';
	$i = 0;  
	while($campaignResult = $getReCampaigns->fetch_assoc()) {
		$i++;    
		$campaign_id = trim($campaignResult['campaign_id']);     
		$total = trim($campaignResult['total']);   
 		$mailContent .="<tr>
				    <td>".$i."</td>
				    <td>".$campaign_id."</td>
				    <td>".$total."</td>
				  </tr>";  
 	}  
	$mailContent  .= '</table></p> </br><p>Thank you.</p>';  
 
	sendEMAIL($mailContent);  
}
 
   
 
  


function sendEMAIL($mailContent) {

	$emailID = 'it@office24by7.com';
	
	$mail = new PHPMailer(); 
	// set mailer to use SMTP
	$mail->IsSMTP();  
	$mail -> SMTPDebug = 3;
	$mail->Host = 'mail.office24by7.in';
	$mail->SMTPAuth = true;     // turn on SMTP authentication
	$mail->Port = 465;
	$mail->Username = "app@office24by7.in";  // SMTP username
	$mail->Password = "Str!ker@123"; // SMTP password
	$mail->FromName = "smsstriker";
	$mail->SetFrom('support@smsstriker.com', 'Striker Misc Error');
	  
	$mail->AddAddress($emailID, 'Striker');
	$mail->AddCC('krishna@smsstriker.net', 'Striker Misc DLRs');	
	
	$mail->WordWrap = 50;       
	$mail->IsHTML(true);    
	$mail->Subject = "SMSStriker Misc Error Report"; 
 
	$mail->Body    = $mailContent;  
	$mail->AltBody = $mailContent;   

	if(!$mail->Send())
	{ 
		 echo "Message could not be sent. <p>";
	}else{   
		echo "Message has been sent";
	}   
}
 
        
        
?>

