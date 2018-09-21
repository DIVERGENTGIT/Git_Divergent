<!DOCTYPE html>
<body>

<script>
alert("Thank you for Providing Your Information");
 window.location="https://www.smsstriker.com"; </script>

<?php

 extract($_REQUEST);
 // Send SMS Plan
 send_email_sms($cname,$gstarn,$gstadr,$pan,$state,$pincode,$service,$pidgst,$saccode,$email,$phonenumber);
 
 ?>

</body>
</html>
<?php
function send_email_sms($cname,$gstarn,$gstadr,$pan,$state,$pincode,$service,$pidgst,$saccode,$email,$phonenumber)
{
require("/var/www/html/strikerapp/PHPMailer-master/PHPMailerAutoload.php"); //change path on live
$mail = new PHPMailer();
// set mailer to use SMTP
$mail->IsSMTP();
$mail -> SMTPDebug = 2;
$mail->Host = 'mail.office24by7.in';
$mail->SMTPAuth = true;     // turn on SMTP authentication
$mail->Port = 465;
$mail->Username = "app@office24by7.in";  // SMTP username
$mail->Password = "Str!ker@123"; // SMTP password
$mail->FromName = "smsstriker";
$mail->SetFrom($email, $cname);
$mail->AddReplyTo($email, $cname); // indicates ReplyTo headers
$mail->AddAddress("support@smsstriker.com", 'GST Info');
$mail->AddAddress('joshi.herald@smsstriker.in', 'GST Info');
$mail->AddAddress('accounts@strikersoft.in', 'GST Info');
$mail->AddCC("naveen@smsstriker.com", "GST Info");
//$mail->AddCC("pasulaniharika@gmail.com", "GST Info");
$mail->WordWrap = 50;
$mail->IsHTML(true);
//$mail->Subject = "Customer Price Enquiry for SMS";
$mail->Subject = "GST Information from Striker Customers";
 $message = '
 <!DOCTYPE html> 
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
<p>Company Information for GST</p> 
<br> 
	<p>Company Name : '.$cname.' </p>
	<p>GST/ARN Number: '.$gstarn.' </p>
	<p>Address where the GST registration is obtained : '.$gstadr.' </p>
	<p>PAN (Permanent Account Number): '.$pan.' </p>
	<p>State  : '.$state.' </p>
	<p>PIN Code : '.$pincode.' </p>
	<p>Nature Of Service : '.$service.' </p>
	<p>Provisional ID For GST : '.$pidgst.' </p>
	<p>SAC Code: '.$saccode.' </p>
	<p>Contact Email ID : '.$email.' </p>
	<p>Contact Number : '.$phonenumber.' </p>
<br> 


<p>Link: <a href="http://www.smsstriker.com/login.html">http://www.smsstriker.com</a></p> 

<p>For any services related issues, please contact to <a href="mailto:support@smsstriker.com" target="_top">support@smsstriker.com&#59;</a> contact : 040 &#45;79417711.</p>  
<br> 
<p>For providing your feedback, please click the URL : <a href="http://www.smsstriker.com/users_feedback.html">http://www.smsstriker.com </a></p> 
<p>Thanks for being our valid customer....Have a great day ahead.....</p> 
<p><b>Best Regards&#44;</b></p><br> 
<p><b>Striker Soft Solutions Pvt Ltd.&#44;</b></p> 
<div> 
<img src="http://www.smsstriker.com/images_n/logo.png" style="width:155px;margin-top:7px;margin-bottom:7px;"> 
</div> 
<div class="signature"> 
<p><b>(Delloitte India&#39;s Fast 50 Tech companies)</b></p> 
<p><b>Sinmon Dwaraka| Opp: Cyber Gateways</b></p> 
<p><b>Hightech City| Hyderabad &#45; 81 |</b></p> 

</div> 
</div> 
</div> 
</body> 
    
</html>
'; 


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

?>


