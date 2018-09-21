<?php

$server="localhost";
$dbuser="emailgateway";
$dbpass='emailgateway@321';
$db="email_gateway";

$con=mysqli_connect($server,$dbuser,$dbpass,$db);
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$email_addresses="krishna.b@office24by7.com";
$name="krishna";
$mobile="9701019800";
$subject="New Enquiry";
$email="krishnabati@gmail.com";
$unqueid=uniqid();  
$addr=array();     
$addr = explode(',',$email_addresses);
require('PHPMailer-master/PHPMailerAutoload.php');	
$mail = new PHPMailer();

// set mailer to use SMTP
$mail->IsSMTP();
$mail -> SMTPDebug = 0;
/*
$mail -> SMTPDebug = 2;
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;     // turn on SMTP authentication
$mail->Port = 587;
$mail->Username = "relicuussemiconductor@gmail.com";  // SMTP username
$mail->Password = "Relicuus5599@"; // SMTP password
*/
$mail->FromName = "Krishna";
//$mail->Host = 'relay-hosting.secureserver.net';
                 
$mail->addCustomHeader('x-originator-id', "$unqueid");
$mail->addCustomHeader('X-SES-CONFIGURATION-SET', 'weststrikeremail');
$mail->Host = 'email-smtp.eu-west-1.amazonaws.com';
$mail->SMTPAuth = true;     // turn on SMTP authentication
$mail->Port = 587;
$mail->Username = "AKIAIANVP3YAFD7Z4ASQ";  // SMTP username
$mail->Password = "Aut/MMOiiUWYvb3Njdh3kFEaFOtN8iKuduzx8Z3xesqh"; // SMTP password

$mail->SetFrom('krishna@smsstriker.net','striker');
$mail->AddAddress($email, 'krishna');


$mail->AddReplyTo($email, $name); // indicates ReplyTo headers
if(count($addr)>0)
{
foreach ($addr as $ad) 
	{
	    $mail->AddBCC(trim($ad),'strikeremail');       
	}
}
$mail->WordWrap = 50;
$mail->IsHTML(true);
$mail->Subject = "Striker Enquiry Information";

$message = 'Test Email from aws events'; 
$mail->Body    = $message;
$mail->AltBody = $message;
if(!$mail->Send())
	{
	echo "Message not sent.";
	echo "Mailer Error: " . $mail->ErrorInfo;
	}
else
	{


mysqli_query($con,"INSERT INTO mw_campaign (campaign_uid,from_email,subject,subject_encoded) 
VALUES ('$unqueid','$email','$subject','$message')") or mysqli_error($con);
$CampaignId=mysqli_insert_id($con);

mysqli_query($con,"INSERT INTO mw_campaign_delivery_log (campaign_id,message,processed,delivery_confirmed,subscriber_email_id,email_message_id,delivered_on) 
VALUES ($CampaignId,'$message','yes','Sent','$email','$unqueid',now())");
mysqli_close($con);
	echo "Message sent!";


	}

?>
