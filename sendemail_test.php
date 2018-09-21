<?php 

include('config/config.php');
$base_url="https://www.smsstriker.com";
require($Email_lib);



  
print_r(send_email_sms($link));
function send_email_sms($link) {
  
$query = mysqli_query($link,"SELECT * FROM Mstr_Global_Variables WHERE GV_ID IN (48,49,50,51,52,53)");
 
 $Email_SMTP_Host = $Email_SMTP_Port = $Email_SMTP_Username = $Email_SMTP_Password = $Email_SMTP_FromMail = $Email_SMTP_DisplayName = '';
while($res = mysqli_fetch_assoc($query)) {
	if($res['Variable_Name'] == 'Email_SMTP_Host') {
		$Email_SMTP_Host = $res['Variable_Value'];
	}
	if($res['Variable_Name'] == 'Email_SMTP_Port') {
		$Email_SMTP_Port = $res['Variable_Value'];
	}
	if($res['Variable_Name'] == 'Email_SMTP_Username') {
		$Email_SMTP_Username = $res['Variable_Value'];
	}
	if($res['Variable_Name'] == 'Email_SMTP_Password') {
		$Email_SMTP_Password = $res['Variable_Value'];
	}
	
	if($res['Variable_Name'] == 'Email_SMTP_FromMail') {
		$Email_SMTP_FromMail = $res['Variable_Value'];
	}
	
	if($res['Variable_Name'] == 'Email_SMTP_DisplayName') {
		$Email_SMTP_DisplayName = $res['Variable_Value'];
	}
}
 

	 $smstype = 'smsssss';$noofsms='5846666';$months=4;$email = 'sandeepthi.ch@office24by7.com';$name = 'SAi'; $mobile = 3453453434;
	
	$mail = new PHPMailer();
	$mail->IsSMTP();  
	$mail->SMTPDebug = 2;
	$mail->Host =  $Email_SMTP_Host;
	$mail->SMTPAuth = true;     // turn on SMTP authentication
	$mail->Port = $Email_SMTP_Port;
	$mail->Username = $Email_SMTP_Username;  // SMTP username
	$mail->Password = $Email_SMTP_Password; // SMTP password
	$mail->FromName = $Email_SMTP_DisplayName;
	$mail->SetFrom($Email_SMTP_FromMail, $Email_SMTP_DisplayName);
	$mail->AddAddress($email);
	$mail->SMTPDebug = false; 
	$mail->WordWrap = 50;    
	$mail->IsHTML(true);
			
			

	$mail->Subject = "Leads For SMSSTRIKER";
	$message = '<!DOCTYPE html> 
		<head> 
		<title>SMS Striker</title> 
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<meta name="description"> 
		<meta name="keywords">  
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> 
		<style> 
		body{margin:0px;padding:0px;font-family: sans-serif; font-size: 13px;   color: #1f497d;    line-height: 1.5;} 
		p{    margin-top: 0px; 
		margin-bottom: 0px;} 
		.col-sm-12{width:100%;float:left;} 
		.container{width:600px;margin:auto;} 
		.signature p{color: gray;} 
		a{color:#15c !important;} 
		</style> 
		</head> 
		<body> 
		<div class="col-sm-12"> 
		<div class="container"> 
		<p>Dear '.$name.'</p> 
		<br> 
		<p>Username : '.$name.' </p>
		<p>Email : '.$email.' </p>
		<p>Mobile : '.$mobile.' </p>
		<p>sms Type : '.$smstype.' </p>
		<p>No of SMS  : '.$noofsms.' </p>
		<p>Months : '.$months.' </p>
		<br> 


		<p>Link: <a href="https://www.smsstriker.com/login.html">http://www.smsstriker.com</a></p> 

		<p>For any services related issues, please contact to <a href="mailto:support@smsstriker.com" target="_top">support@smsstriker.com&#59;</a> contact : 040 &#45;79417711.</p>  
		<br> 
		<p>For providing your feedback, please click the URL : <a href="https://www.smsstriker.com/contact-us.html">https://www.smsstriker.com </a></p> 
		<p>Thanks for being our valid customer....Have a great day ahead.....</p> 
		<p><b>Best Regards&#44;</b></p><br> 
		<p><b>Striker Soft Solutions Pvt Ltd.&#44;</b></p> 
		<div> 
		<img src="https://www.smsstriker.com/images_n/logo.png" style="width:155px;margin-top:7px;margin-bottom:7px;"> 
		</div> 
		<div class="signature"> 
		<p><b>(Delloitte India&#39;s Fast 50 Tech companies)</b></p> 
		<p><b>Sinmon Dwaraka| Opp: Cyber Gateways</b></p> 
		<p><b>Hightech City| Hyderabad &#45; 81 |</b></p> 

		</div> 
		</div> 
		</div> 
		</body> 

		</html>'; 


	$mail->Body    = $message;
	$mail->AltBody = $message;

	if(!$mail->Send())
	{
		echo "Message could not be sent. <p>";
		echo "Mailer Error: " . $mail->ErrorInfo;
	}else{
		echo "Message has been sent";
	}
}



 
