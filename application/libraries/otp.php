<?php

function otp($to,$subject,$body)
{
	require_once('class.phpmailer.php');	

	$mail             = new PHPMailer();
	
	//$body             = $body;

	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->Host       = "mail.gmail.com"; // SMTP server
	//$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
											   // 1 = errors and messages
											   // 2 = messages only
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
	$mail->Host       = "smtp.gmail.com"; // sets the SMTP server
	$mail->Port       = 587;                    // set the SMTP port for the GMAIL server
	$mail->Username   = "krishnabati@gmail.com"; // SMTP account username
	$mail->Password   = "krishna83*";        // SMTP account password

	$mail->SetFrom('krishnabati@gmail.com','krishna'); ///// from

	$mail->Subject=$subject;  // suject
	$mail->MsgHTML($body);
	$address = $to;  // to
	$mail->AddAddress($address);

	if(!$mail->Send()) 
	{
	  echo "Mailer Error: " . $mail->ErrorInfo;
	} 
	else 
	{		
		return true;		
	}

}
    
?>