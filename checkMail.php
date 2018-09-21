<?php

////https://www.smsstriker.com/sendemail.php?payment=payment&trn_id=1518124824&servicetax=15&smsprice=0.18
include('config/config.php');

$base_url="http://www.smsstriker.com";

require($Email_lib);

if(isset($_GET['userid'])) {

$id = mysqli_real_escape_string($link,$_GET['userid']);

//*** update sent sms plan status **//
$sql="update price_enquery set sent_smsplan=0 where id=$id and sent_smsplan=1";
$plane_query=mysqli_query($link,$sql);
//*** update sent sms plan status **//

$query = "SELECT * FROM price_enquery where id=$id and sent_smsplan=0";
$result = mysqli_query($link,$query) or die('Error query:  '.$query);

if(mysqli_num_rows($result)>0)
{
$rec=mysqli_fetch_array($result);
$otpcode = $rec['otpcode'];
$sendtime = $rec['otptime'];
$smstype = $rec['smstype'];
$noofsms = $rec['noofsms'];
$noofkeywords = $rec['noofkeywords'];
$servicetype = $rec['servicetype'];
$noofshorturl = $rec['noofshorturl'];
$replytype = $rec['replytype'];

$subcription = $rec['subcription'];
	if($subcription==0){
	 $months="One Time";
	}else{
	 $months = $subcription."Months";
	}
	$email = $rec['email'];
	$name = ucfirst($rec['name']);
	 $mobile = $rec['mobile'];
	 $noofsms = $rec['noofsms'];
	 $type=$_GET['type'];

	 switch($type){
case 'sms':
     // sent to support
	 send_email_sms($smstype,$noofsms,$months,$email,$name, $mobile);
	 // sent to user
     send_email_smsplan($name,$email,$id,$noofsms,$base_url,$link);
break;
case 'longcode':
	 send_email_longcode($noofkeywords,$servicetype,$replytype,$months,$email,$name, $mobile);
break;

case 'shorturl':
	 send_email_shorturl($noofshorturl,$replytype,$months,$email,$name, $mobile);
break;
	 
	 }
}
else
{
 print_r(json_encode(array("status"=>"failed")));
}
	 
	 
}


function send_email_sms($smstype,$noofsms,$months,$email,$name, $mobile){
	
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
$mail->SetFrom($email, $name);
$mail->AddReplyTo($email, $name); // indicates ReplyTo headers
//$mail->AddAddress('sales@smsstriker.com', 'SMS Leads');
//$mail->AddAddress('joshi.herald@smsstriker.in', 'SMS Leads');
//$mail->AddCC("naveen@smsstriker.com", "SMS Leads");
$mail->WordWrap = 50;
$mail->IsHTML(true);
//$mail->Subject = "Customer Price Enquiry for SMS";
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

 
function send_email_longcode($noofkeywords,$servicetype,$replytype,$months,$email,$name, $mobile){
	
$mail = new PHPMailer();

// set mailer to use SMTP
$mail->IsSMTP();

$mail -> SMTPDebug = 2;
$mail->Host = 'smtp.sendgrid.net';
$mail->SMTPAuth = true;     // turn on SMTP authentication
$mail->Port = 587;
$mail->Username = "smsstriker";  // SMTP username
$mail->Password = "striker@123"; // SMTP password
$mail->FromName = "smsstriker";
$mail->SetFrom($email, $name);
$mail->AddReplyTo($email, $name); // indicates ReplyTo headers
//$mail->AddAddress('sales@smsstriker.com', 'SMS Leads');
//$mail->AddAddress('joshi.herald@smsstriker.in', 'SMS Leads');
//$mail->AddCC("naveen@smsstriker.com", "SMS Leads");

$mail->WordWrap = 50;
$mail->IsHTML(true);
$mail->Subject = "Customer Price Enquiry For Longcode";


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
					<p>No of Keywords  : '.$noofkeywords.' </p>
					<p>Service Type : '.$servicetype.' </p>
					<p>Replay Type  : '.$replytype.' </p>
					<p>Months : '.$months.' </p>

					<p>Link: <a href="https://www.smsstriker.com/login.html">http://www.smsstriker.com</a></p> 
					
					<p>For any services related issues, please contact to <a href="mailto:support@smsstriker.com" target="_top">support@smsstriker.com&#59;</a> contact : 040 &#45;79417711.</p>  
					<br> 
					<p>For providing your feedback, please click the URL : <a href="https://www.smsstriker.com/contact-us.html">http://www.smsstriker.com </a></p> 
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
function  send_email_shorturl($noofshorturl,$replytype,$months,$email,$name, $mobile){
	
$mail = new PHPMailer();

// set mailer to use SMTP
$mail->IsSMTP();

$mail -> SMTPDebug = 2;
$mail->Host = 'smtp.sendgrid.net';
$mail->SMTPAuth = true;     // turn on SMTP authentication
$mail->Port = 587;
$mail->Username = "smsstriker";  // SMTP username
$mail->Password = "striker@123"; // SMTP password
$mail->FromName = "smsstriker";
$mail->SetFrom($email, $name);
$mail->AddReplyTo($email, $name); // indicates ReplyTo headers
//$mail->AddAddress('sales@smsstriker.com', 'SMS Leads');
//$mail->AddAddress('joshi.herald@smsstriker.in', 'SMS Leads');
//$mail->AddCC("naveen@smsstriker.com", "SMS Leads");
$mail->WordWrap = 50;
$mail->IsHTML(true);
$mail->Subject = "Customer Price Enquiry for Short Urls";


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
					<p>No of ShortURLs  : '.$noofshorturl.' </p>
					<p>Replay Type  : '.$replytype.' </p>
					<p>Months : '.$months.' </p>
					<br> 
					

					<p>Link: <a href="https://www.smsstriker.com/login.html">https://www.smsstriker.com</a></p> 
					
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


/*
if(isset($_GET['otp'])) {
	$name =$_GET['name'];
	$email = $_GETT['email'];
	$mobile = $_GET['mobile'];
	$otp = $_GET['otp'];
send_email_otp($name,$email,$mobile,$otp);
}
*/

if($_GET['sendotp']=='sendotp') {
$id = mysqli_real_escape_string($link,$_GET['pid']);
$query = "SELECT * FROM price_enquery where id=".$id;
$result = mysqli_query($link,$query) or die('Error query:  '.$query);
$rec=mysqli_fetch_assoc($result);
	$otp = $rec['otpcode'];
	$email = $rec['email'];
	$name = $rec['name'];
	$mobile = $rec['mobile'];
send_email_otp($name,$email,$mobile,$otp);
}


function send_email_otp($name,$email,$mobile,$otp){

$username=ucfirst($name);
// mobile atert
$sms_text = "Your One Time Password(OTP) is : $otp";
$sms_url = "https://www.smsstriker.com/API/sms.php?";
$sms_url .= "username=support&password=Str!k3r2020&from=STRIKR&to=$mobile&msg=".urlencode($sms_text)."&type=1";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $sms_url);
curl_setopt($ch, CURLOPT_header_new, 0);
curl_exec($ch);
curl_close($ch);

$mail = new PHPMailer();

// set mailer to use SMTP
$mail->IsSMTP();  

$mail -> SMTPDebug = 2;
$mail->Host = 'smtp.sendgrid.net';
$mail->SMTPAuth = true;     // turn on SMTP authentication
$mail->Port = 587;
$mail->Username = "smsstriker";  // SMTP username
$mail->Password = "striker@123"; // SMTP password
$mail->FromName = "smsstriker";
$mail->SetFrom("sandeepthicse@gmail.com", 'smsstriker');
//$mail->AddReplyTo($email, $name); // indicates ReplyTo headers
$mail->AddAddress($email, $name);
//$mail->AddBCC("krishnabati@gmail.com", "OTP Email");
$mail->WordWrap = 50;
$mail->IsHTML(true);
$mail->Subject = "One Time Password (OTP)!";

 $message = '<html>
<head>
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
<style>
* {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;}

.mrgleft{margin-left:-25px;}
.main-newsletter{width:100%;max-width:600px;    float: left;}

.header-newsletr{background:url(https://smsstriker.com/images/about-page-bg.png) no-repeat;background-size: 100% 100%;
padding: 15px 25px;}

.bold-name{color:#00B8B5;}

.halfwidth02{width:100%;max-width: 300px;float:left;}
.halfwidth03{width:100%;max-width: 200px;float:left;}

	
	
	.paddinglt25{padding-right:25px;}
	.footer-top-list{float:right;}
	.footer-top-list li:first-child{margin-bottom:16px;font-size:15px;}
	.footer-top-list li{text-align:right;list-style-type:none;margin-bottom: 6px;    font-size: 12px;
    font-weight: bold;}
	.footer-top-list span{margin-left:5px;}
	.footer-top-list b{color:#00B8B5;}
	.footerbtm{background:#58595B;padding-bottom: 7px;padding-top: 7px;}
	.footer-social-list{float:right;margin: 0px;}
	.footer-social-list li{list-style-type:none;float:left;margin-right:15px;}
	.footerlast{background:#BBBDBF;padding-top: 10px;padding-bottom: 10px;}
	.footerlast a, .footerlast p{font-size:9px;color:#fff;text-decoration:none;}
	.footerlast p{margin:0px;text-align:right;}
	.footer-social-list li:last-child{margin:0px;}
	.table-btmcont b{color:#00B8B5;}
	.text-right{text-align:right;}
	.table-btmcont p{font-size:11px;font-weight: bold;}
	.democlass a{background:#00b8b6;color:#fff;    color: #fff;
    padding: 3px 6px;
    margin-left: 4px;text-decoration:none;
    border-radius: 5px;}
	.mrgtbbotom{margin-top:10px;margin-bottom:10px;}

	.contactbtm02{position:relative;margin-top: 20px;    padding-top: 15px;
    padding-bottom: 15px;}

	.firstcontent p{font-size: 12px;
    font-weight: bold;}
	.play-btn a{text-decoration:none;color:#00B8B5;border:1px solid #00B8B5;    padding: 3px 5px;}
	.indian-rupee img{    width: 9px;
    margin-left: 2px;}
	.fltright{float:right !important;}
	.oneotp-content b{color: #00B8B5;}
	
	.btmotpcontent p{    background: #cdf1f1;
    padding: 15px;
    border-radius: 10px;}
	.oneotp-content p.otpnumber{font-weight:bold;    font-size: 16px;}
	.oneotp-content p{font-size: 14px;}
	.otp-padding{width:100%;max-width:470px;margin: auto;}
</style>

</head>
<body style="padding:0px;margin:0px;font-family: Lato,sans-serif;">
<div class="main-newsletter">
<div class="header-newsletr" style="width:100%;float:left;">
<a href="index.html"><img src="https://smsstriker.com/images/sms-striker-logo.png" width="100px" alt="sms striker"></a>
</div>
<div class="firstcontent" style="width:100%;float:left;">
<div style="padding-left:25px;padding-right:25px;">
<p>Hi</p>
<b class="bold-name">Mr/Mrs. '.$username.',</b>
<p>Thank you for showing interest in our services</p>
</div>
</div>
<div class="oneotp-content" style="width:100%;float:left;">
<div style="padding-left:25px;padding-right:25px;">
<div class="otp-padding">

<p class="otpnumber">Your One Time Password is : <b> '.$otp.'</b></p>

<p>OTP validity 3 minutes to expired</p>
</div>
</div>
</div>
<div class="btmotpcontent" style="width:100%;float:left;">
<div style="padding-left:25px;padding-right:25px;">
<div class="otp-padding">
<p>NEVER SHARE your OTP, User ID, Password anyone,Sharing these details can lead to unauthorized access to your account</p>
</div>
</div>
</div>
<div class="contactbtm02" style="width:100%;float:left;">
<div style="padding-left:25px;padding-right:25px;">
<div class="halfwidth fltright" style="width:100%;max-width: 275px;float:left;">
<ul class="footer-top-list"> 
<li><b>Need help?</b></li>
<li>+91  7097 19 19 19 <span><img src="http://strikersoftsolutions.com/images/newslet-phone.png" alt=""></span></li>
<li>support@smsstriker.com <span><img src="http://strikersoftsolutions.com/images/newsltr-mail.png" alt=""></span></li>
<li>www.smsstriker.com <span><img src="http://strikersoftsolutions.com/images/newsltr-web.png" alt=""></span></li>
</ul>
</div>
</div>
</div>
<div class="footerbtm" style="width:100%;float:left;">
<div style="padding-left:25px;padding-right:25px;">
<div class="halfwidth" style="width:100%;max-width: 275px;float:left;">
<img src="http://strikersoftsolutions.com/images/newsletter-footer-logo.png" alt="">
</div>
<div class="halfwidth" style="width:100%;max-width: 275px;float:left;">
<ul class="footer-social-list">
<li><a href="https://www.facebook.com/strikersoftsolutions/" target="_blank"><img src="http://strikersoftsolutions.com/images/fb.png" alt=""></a></li>
<li><a href="https://twitter.com/strikersofthyd" target="_blank"><img src="http://strikersoftsolutions.com/images/twiter.png" alt=""></a></li>
<li><a href="https://plus.google.com/110633432043392276134/about?gmbpt=true&hl=en" target="_blank"><img src="http://strikersoftsolutions.com/images/gpluse.png" alt=""></a></li>
</ul>
</div>
</div>
</div>
<div class="footerlast" style="width:100%;float:left;">
<div style="padding-left:25px;padding-right:25px;">
<div class="halfwidth" style="width:100%;max-width: 275px;float:left;">
<a href="https://www.smsstriker.com/privacy-policy.html">Disclaimers & Privacy Policy</a>
</div>
<div class="halfwidth" style="width:100%;max-width: 275px;float:left;">
<p>&copy; 2017 Striker Soft Solutions Pvt. Ltd. All Rights Reserved</p>
</div>
</div>
</div>
</div>
<div>

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


/*
function shorturlgenerateemail($urlno)
{
switch($urlno)
{
case 1:
 $url="http://smsstriker.com";
break;
case 2:
 $url="http://strikersoftsolutions.com/";
break;
case 3:   
 $url="http://www.adfruitsdigital.com/";
break;
case 4:
 $url="http://pointsms.in/index.php/user/login.html";
break;
case 5:
 $url="http://www.smsstriker.com/lms";
break;
case 6:
 $url="http://182.18.163.215/FirstRing/";
break;

}
return $url;
}


function generatshortcodeloop()
{
for($i=1;$i<7;$i++)
{

 $url= shorturlgenerateemail($i);
  $apiurl="http://ion.bz/smsnewui_api.php?get_shorturl=sucess&user_url=".$url."&user_id=2917";
	echo $genershortcode=file_get_contents($apiurl);
}
	return $genershortcode;
	
}

$shortcode=generatshortcodeloop();
*/


function send_email_smsplan($name,$email,$id,$noofsms,$base_url,$link) {

//*** update sent sms plan status **//
$sql="update price_enquery set sent_smsplan=1 where id=$id and sent_smsplan=0";
$plane_query=mysqli_query($link,$sql);
//*** update sent sms plan status **//

$username=ucfirst($name);

$mail = new PHPMailer();

// set mailer to use SMTP
$mail->IsSMTP();

$mail -> SMTPDebug = 2;
$mail->Host = 'smtp.sendgrid.net';
$mail->SMTPAuth = true;     // turn on SMTP authentication
$mail->Port = 587;
$mail->Username = "smsstriker";  // SMTP username
$mail->Password = "striker@123"; // SMTP password
$mail->FromName = "smsstriker";
$mail->SetFrom("support@smsstriker.com", 'smsstriker');
//$mail->AddReplyTo($email, $name); // indicates ReplyTo headers
$mail->AddAddress($email, $name);
//$mail->AddBCC("krishna@smsstriker.net", "SMS PRICE LIST");
$mail->WordWrap = 50;
$mail->IsHTML(true);
$mail->Subject = "SMS Plans & Prices";

$pid=base64_encode($id);
//$paynow='<span class="play-btn"><a href="'.$base_url.'/index.php/User/paynow/'.$id.'">Pay Now</a></span>';
$demo='<span class="play-btn" style="margin-left:8px;"><a href="'.$base_url.'/index.php/User/demo/'.$pid.'" style="background: #00b8b6;color:#fff;border-radius:5px;">Demo</a></span>';

$sql1="SELECT * FROM `sms_packages` where noofsms<=$noofsms order by id desc limit 1";
$plane_query1=mysqli_query($link,$sql1);
$plans_rows1=mysqli_fetch_assoc($plane_query1);
//print_r($plans_rows1);
$getnoofsms=$plans_rows1['noofsms'];
$message_plans='';
$sql="select * from sms_packages  order by id asc";
$plane_query=mysqli_query($link,$sql);
$color='';
//$plane_rows=mysqli_num_rows($plane_query);
while($plans_rows=mysqli_fetch_assoc($plane_query))
{
//print_r($plans_rows);
//exit;
if($plans_rows["pkgrange_from"]<2000000)
{

 $color='';
 $trbgcolor='';
 
	if($getnoofsms==$plans_rows["pkgrange_from"])
	{
	 $color='blue';
	 $trbgcolor="#e7e8e7";
	}
	else
	{
	$color='black';
	$trbgcolor="#fff";
	}

$message_plans.='
<tr style="background: '.$trbgcolor.';"><td style="border-bottom:1px solid #7fdbda;border-right:1px solid #7fdbda;padding: 9px;font-size: 12px;font-weight: bold;text-align:center;border-left: 1px solid #7fdbda;"><span style="color:'.$color.';font-weight:bold">'.$plans_rows["pkgrange_from"].' - '. $plans_rows["pkgrange_to"] .'</span></td><td style="border-bottom:1px solid #7fdbda;border-right:1px solid #7fdbda;padding: 9px;font-size: 12px;font-weight: bold;text-align:center;">'.$plans_rows["promotional"].' </td><td style="border-bottom:1px solid #7fdbda;border-right:1px solid #7fdbda;padding: 9px;font-size: 12px;font-weight: bold;text-align:center;">'.$plans_rows["transactional"].' </td><td style="border-bottom:1px solid #7fdbda;border-right:1px solid #7fdbda;padding: 9px;font-size: 12px;font-weight: bold;text-align:center;"><span class="play-btn"><a style="text-decoration:none;color:#00B8B5;border:1px solid #00B8B5;padding: 3px 5px;" href="'.$base_url.'/index.php/User/paynow/'.$plans_rows["id"].'/'.$pid.'">Pay Now</a></span></td></tr>';
}
else
{
$message_plans.='
<tr>
<td style="border-bottom:1px solid '.$trbgcolor.';border-right:1px solid #7fdbda;padding: 9px;font-size: 12px;font-weight: bold;text-align:center;border-left: 1px solid #7fdbda;-moz-border-bottom-left-radius: 10px;-moz-border-bottom-right-radius: 10px;-webkit-border-bottom-right-radius: 10px;border-bottom-right-radius: 10px;-webkit-border-bottom-left-radius: 10px;border-bottom-left-radius: 10px;">
20 Lakh above</td><td colspan="3" style="border-bottom:1px solid #7fdbda;border-right:1px solid #7fdbda;padding: 9px;font-size: 12px;font-weight: bold;text-align:center;">Contact Support Team for price</td>
</tr>';
}

}

//echo $message_plans;
//exit;

 $message = '<html><head><link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
<style>
.price-title:before{position:absolute;;border-top:8px solid #e6e6e6;   width: 100%;
    height: 24px;
    left: 0px;
    top: -9px;}
	.price-title h4{margin:0px;padding-top:15px;padding-bottom:15px;font-size: 18px;}

.contactbtm:before{position:absolute;content:"";border-top:8px solid #e6e6e6;    width: 100%;
    height: 24px;
    left: 0px;
    top: -9px;}

	.halfwidthlist{width:100%;max-width: 200px;    float: left;}
	@media (max-width:525px){
	.reponsive-table{overflow-x: scroll;}
	.play-btn a{border:0px;}
	}
</style>
</head>
<body style="padding:0px;margin:0px;font-family: Lato,sans-serif;">
<div style="width:100%;max-width:600px;float: left;">
<div class="header-newsletr" style="background:url(http://smsstriker.com/images/about-page-bg.png) no-repeat;background-size: 100% 100%;width:100%;float:left;">
<div style="padding: 15px 25px;"> 
<a href="https://www.smsstriker.com"><img src="http://smsstriker.com/images/sms-striker-logo.png" width="100px" alt="sms striker"></a>
</div>
</div>
<div class="firstcontent" style="width:100%;float:left;">
<div style="padding: 15px 25px;">
<p style="font-size: 12px;font-weight: bold;">Hi</p>
<b class="bold-name" style="color:#00B8B5;">Mr/Mrs. '.$username.',</b>
<p style="font-size: 12px;font-weight: bold;">Thank you for showing interest in our services</p>
<p style="font-size: 12px;font-weight: bold;">SMS Striker is a subsidiary of the Telecom service provider Striker Soft Solutions. It was established in 2009 and since then it has pioneered innovative technology-based solutions.</p>
</div>
</div>
<div style="width:100%;float:left;">
<div style="padding: 15px 25px;">
<div class="centerwidth" style="width:100%;max-width: 400px;margin: auto;float: none;">
<div class="" style="width:100%;float:left;"> 
<div class="halfwidthlist">
<ul class="our-services-list" style="position:relative;padding-left: 42px;background: url(http://strikersoftsolutions.com/images/our-products.png) no-repeat;background-size:auto 100%;">
<li style="margin-bottom: 20px;background: url(http://strikersoftsolutions.com/images/dot-email.png) no-repeat;padding-left: 17px;background-size: 9px;background-position: left top 4px;list-style-type:none; position:relative;"><a style="text-decoration:none;color:#4d4d4d;font-weight: bold;font-size:11px;" href="http://smsstriker.com/">SMS Striker</a></li>
<li style="margin-bottom: 20px;background: url(http://strikersoftsolutions.com/images/dot-email.png) no-repeat;padding-left: 17px;background-size: 9px;background-position: left top 4px;list-style-type:none; position:relative;"><a style="text-decoration:none;color:#4d4d4d;font-weight: bold;font-size:11px;" href="http://voicestriker.com/">Voice Striker</a></li>
<li style="margin-bottom: 20px;background: url(http://strikersoftsolutions.com/images/dot-email.png) no-repeat;padding-left: 17px;background-size: 9px;background-position: left top 4px;list-style-type:none; position:relative;"><a style="text-decoration:none;color:#4d4d4d;font-weight: bold;font-size:11px;" href="http://firstring.in/">First Ring</a></li>
<li style="margin-bottom: 20px;background: url(http://strikersoftsolutions.com/images/dot-email.png) no-repeat;padding-left: 17px;background-size: 9px;background-position: left top 4px;list-style-type:none; position:relative;"><a style="text-decoration:none;color:#4d4d4d;font-weight: bold;font-size:11px;" href="http://office24by7.com/">Office 24/7</a></li>
<li style="margin-bottom: 20px;background: url(http://strikersoftsolutions.com/images/dot-email.png) no-repeat;padding-left: 17px;background-size: 9px;background-position: left top 4px;list-style-type:none; position:relative;"><a style="text-decoration:none;color:#4d4d4d;font-weight: bold;font-size:11px;" href="#">OTP Box</a></li>
<li style="margin-bottom: 20px;background: url(http://strikersoftsolutions.com/images/dot-email.png) no-repeat;padding-left: 17px;background-size: 9px;background-position: left top 4px;list-style-type:none; position:relative;"><a style="text-decoration:none;color:#4d4d4d;font-weight: bold;font-size:11px;" href="http://adfruitsdigital.com/">Ad Fruits</a></li>
</ul>
</div>
<div class="halfwidthlist">
<ul class="our-products-list" style="position:relative;padding-left: 45px;background: url(http://strikersoftsolutions.com/images/our-services.png) no-repeat;background-size: auto 100%;">
<li style="margin-bottom: 3px;    background: url(http://strikersoftsolutions.com/images/dot-email.png) no-repeat;
padding-left: 17px;background-size: 11px;background-position: left top 8px;list-style-type:none; position:relative;background-size: 9px;background-position: left top 4px;"><a style="text-decoration:none;color:#4d4d4d;font-weight: bold;font-size:11px;" href="https://smsstriker.com/">SMS</a></li>
<li style="margin-bottom: 3px;    background: url(http://strikersoftsolutions.com/images/dot-email.png) no-repeat;
padding-left: 17px;background-size: 11px;background-position: left top 8px;list-style-type:none; position:relative;background-size: 9px;background-position: left top 4px;"><a style="text-decoration:none;color:#4d4d4d;font-weight: bold;font-size:11px;" href="https://smsstriker.com/">Long Code</a></li>
<li style="margin-bottom: 3px;    background: url(http://strikersoftsolutions.com/images/dot-email.png) no-repeat;
padding-left: 17px;background-size: 11px;background-position: left top 8px;list-style-type:none; position:relative;background-size: 9px;background-position: left top 4px;"><a style="text-decoration:none;color:#4d4d4d;font-weight: bold;font-size:11px;" href="https://smsstriker.com/">Short URL</a></li>
<li style="margin-bottom: 3px;    background: url(http://strikersoftsolutions.com/images/dot-email.png) no-repeat;
padding-left: 17px;background-size: 11px;background-position: left top 8px;list-style-type:none; position:relative;background-size: 9px;background-position: left top 4px;"><a style="text-decoration:none;color:#4d4d4d;font-weight: bold;font-size:11px;" href="https://smsstriker.com/">Missed Call</a></li>
<li style="margin-bottom: 3px;    background: url(http://strikersoftsolutions.com/images/dot-email.png) no-repeat;
padding-left: 17px;background-size: 11px;background-position: left top 8px;list-style-type:none; position:relative;background-size: 9px;background-position: left top 4px;"><a style="text-decoration:none;color:#4d4d4d;font-weight: bold;font-size:11px;" href="https://smsstriker.com/">OBD Call</a></li>
<li style="margin-bottom: 3px;    background: url(http://strikersoftsolutions.com/images/dot-email.png) no-repeat;
padding-left: 17px;background-size: 11px;background-position: left top 8px;list-style-type:none; position:relative;background-size: 9px;background-position: left top 4px;"><a style="text-decoration:none;color:#4d4d4d;font-weight: bold;font-size:11px;" href="https://smsstriker.com/">IVR</a></li>
<li style="margin-bottom: 3px;    background: url(http://strikersoftsolutions.com/images/dot-email.png) no-repeat;
padding-left: 17px;background-size: 11px;background-position: left top 8px;list-style-type:none; position:relative;background-size: 9px;background-position: left top 4px;"><a style="text-decoration:none;color:#4d4d4d;font-weight: bold;font-size:11px;" href="https://smsstriker.com/">Virtual Number</a></li>
<li style="margin-bottom: 3px;    background: url(http://strikersoftsolutions.com/images/dot-email.png) no-repeat;
padding-left: 17px;background-size: 11px;background-position: left top 8px;list-style-type:none; position:relative;background-size: 9px;background-position: left top 4px;"><a style="text-decoration:none;color:#4d4d4d;font-weight: bold;font-size:11px;" href="https://smsstriker.com/">Toll Free Number</a></li>
<li style="margin-bottom: 3px;    background: url(http://strikersoftsolutions.com/images/dot-email.png) no-repeat;
padding-left: 17px;background-size: 11px;background-position: left top 8px;list-style-type:none; position:relative;background-size: 9px;background-position: left top 4px;"><a style="text-decoration:none;color:#4d4d4d;font-weight: bold;font-size:11px;" href="https://smsstriker.com/">Click to Call</a></li>
<li style="margin-bottom: 3px;    background: url(http://strikersoftsolutions.com/images/dot-email.png) no-repeat;
padding-left: 17px;background-size: 11px;background-position: left top 8px;list-style-type:none; position:relative;background-size: 9px;background-position: left top 4px;"><a style="text-decoration:none;color:#4d4d4d;font-weight: bold;font-size:11px;" href="https://smsstriker.com/">Conference Call</a></li>
</ul>
</div>
</div>
</div>
</div>
</div>
<div class="price-title" style="border-top:1px solid #29c2bf;position:relative;text-align:center;color:#00b8b6;margin-top: 20px;width:100%;float:left;">
<div style="padding: 15px 25px;">
<h4 style="margin:0px;padding-top:15px;padding-bottom:15px;font-size: 18px;">Our SMS Prices</h4>
</div>
</div>

<div class="table-btmcont" style="width:100%;float:left;">
<div class="reponsive-table" style="width:100%;float:left;">
<table class="newsletter-table" style="width:100%;float:left;padding-left:15px;padding-right:15px;">
<thead>
<tr style="background:#00b8b6;"><td rowspan="2" style="text-align:center;-moz-border-top-left-radius: 10px;-webkit-border-top-left-radius: 10px;border-top-left-radius: 10px;">SMS Pack Range</td><td style="text-align:center;" colspan="2">Price Per SMS (<span class="indian-rupee"><img style="width: 9px;margin-left: 2px;" src="http://strikersoftsolutions.com/images/firstring-email/rupee-indian-white.png"  alt=""></span>) </td><td rowspan="2" style="text-align:center;-moz-border-top-right-radius: 10px;-webkit-border-top-right-radius: 10px;border-top-right-radius: 10px;">&nbsp;</td></tr>
<tr><td style="text-align:center;">Promotional</td><td>Transactional</td></tr>
</thead>
<tbody>
'.$message_plans.'
</tbody>
</table>
</div>
<div class="fullwidth" style="width:100%;float:left;padding-left:15px;padding-right:15px;">
<div class="halfwidth02" style="width:100%;max-width: 350px;float:left;"><p><b>Note:</b> <br> Service Tax of 18% is applicable on all your Packages. <br> </p></div>
<div class="halfwidth03 text-right" style="width:100%;max-width: 200px;float:right;"><p>Request for'.$demo.'</p></div>
</div>
<div class="fullwidth" style="width:100%;float:left;padding-left:15px;padding-right:15px;">
<p><a href="#" style="text-decoration:none;color:#000;"> * Terms & Conditions Apply</a></p>
</div>
</div>
<div class="fullwidth contactbtm" style="border-top:1px solid #29c2bf;position:relative;margin-top: 20px;width:100%;float:left;">
<div style="padding: 15px 25px 15px 0px;">
<div class="halfwidth" style="width:100%;max-width: 275px;float:left;">
<img src="http://strikersoftsolutions.com/images/price-footer-left.png" width="80px" alt="">
</div>
<div class="halfwidthleftft" style="width:100%;max-width: 275px;float:right;">
<ul class="footer-top-list" style="float:right;">
<li style="text-align:right;list-style-type:none;margin-bottom: 6px;font-size: 12px;font-weight: bold;margin-bottom:16px;font-size:15px;"><b style="color:#00B8B5;">Need help?</b></li>
<li style="text-align:right;list-style-type:none;margin-bottom: 6px;font-size: 12px;font-weight: bold;color:#000;">+91  7097 19 19 19 <span style="margin-left:5px;"><img src="http://strikersoftsolutions.com/images/newslet-phone.png" alt=""></span></li>
<li style="text-align:right;list-style-type:none;margin-bottom: 6px;font-size: 12px;font-weight: bold;"><a href="#" style="text-decoration:none;color:#000;">support@smsstriker.com <span style="margin-left:5px;"><img src="http://strikersoftsolutions.com/images/newsltr-mail.png" alt=""></span></a></li>
<li style="text-align:right;list-style-type:none;margin-bottom: 6px;font-size: 12px;font-weight: bold;"><a href="https://www.smsstriker.com/" style="text-decoration:none;color:#000;">www.smsstriker.com <span style="margin-left:5px;"><img src="http://strikersoftsolutions.com/images/newsltr-web.png" alt=""></span></a></li>
</ul>
</div>
</div>
</div>
<div class="footerbtm" style="background:#58595B;padding-bottom: 7px;padding-top: 7px;width:100%;float:left;">
<div style="padding: 15px 25px;">
<div class="halfwidth" style="width:100%;max-width: 275px;float:left;">
<img src="http://strikersoftsolutions.com/images/newsletter-footer-logo.png" alt="">
</div>
<div class="halfwidth" style="width:100%;max-width: 275px;float:left;">
<ul class="footer-social-list" style="float:right;margin: 0px;">
<li style="list-style-type:none;float:left;margin-right:15px;"><a href="https://www.facebook.com/strikersoftsolutions/" target="_blank"><img src="http://strikersoftsolutions.com/images/fb.png" alt=""></a></li>
<li style="list-style-type:none;float:left;margin-right:15px;"><a href="https://twitter.com/strikersofthyd" target="_blank"><img src="http://strikersoftsolutions.com/images/twiter.png" alt=""></a></li>
<li style="margin:0px;list-style-type:none;float:left;"><a href="https://plus.google.com/110633432043392276134/about?gmbpt=true&hl=en" target="_blank"><img src="http://strikersoftsolutions.com/images/gpluse.png" alt=""></a></li>
</ul>
</div>
</div>
</div>
<div class="footerlast" style="width:100%;float:left;background:#BBBDBF;padding-top: 10px;padding-bottom: 10px;">
<div style="padding: 15px 25px;">
<div class="halfwidth" style="width:100%;max-width: 275px;float:left;">
<a style="font-size:9px;color:#fff;text-decoration:none;" href="https://www.smsstriker.com/privacy-policy.html">Disclaimers & Privacy Policy</a>
</div>
<div class="halfwidth" style="width:100%;max-width: 275px;float:left;">
<p style="margin:0px;text-align:right;font-size:9px;color:#fff;text-decoration:none;">&copy; 2017 Striker Soft Solutions Pvt. Ltd. All Rights Reserved</p>
</div>
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


//http://localhost/smsstriker/sendemail.php?payment=payment&trn_id=201701105873039&servicetax=15&smsprice=0.18



if(isset($_GET['payment'])) {
    $trn_id=$_REQUEST['trn_id']; 

  // service tax    
$query2 = "SELECT * FROM global_settings where 	setting_name='Service Tax'";
$result2 = mysqli_query($link,$query2) or die('Error query:  '.$query2);
$rec2=mysqli_fetch_assoc($result2);
$ServiceTax=$rec2['value'];
     $query="SELECT pe.registeruser_id,pe.name,pe.mobile,pe.email,pe.epg_txnID,pe.created_on,pe.smstype,th.payment_id,th.noofsms,th.sms_price as smsprice,th.amount,th.tax_amount, th.total_amount,pe.pgresponse,th.epg_txnID FROM transaction_history th INNER JOIN price_enquery pe on pe.epg_txnID=th.epg_txnID
     WHERE th.epg_txnID = $trn_id group by th.payment_id order by th.payment_id desc limit 1 "; 
	$result = mysqli_query($link,$query) or die('Error query:  '.$query);
	if(mysqli_num_rows($result)>0)
	{
			while($value=mysqli_fetch_assoc($result))
			{
			//print_r($value);
			extract($value);
			//print_r($value);

/*
$sql1="update price_enquery set is_created=0 where epg_txnID=$trn_id";
$result = mysqli_query($link,$sql1) or die('Error query:  '.$sql1);*/


			$sql="select * from price_enquery where epg_txnID=$trn_id and is_created=0";
			$result = mysqli_query($link,$sql) or die('Error query:  '.$sql);

				if(mysqli_num_rows($result)>0)
				{
					 if($pgresponse=='Transaction Successful')
					//  if($pgresponse=='Transaction Cancelled')
					 {  
						 $on_date=date("Y-m-d H:i:s");
						 $query1="INSERT INTO `user_payments` ( `user_id`, `no_of_sms`, `price`, `amount`, `service_tax`, `service_tax_percent`, `total_amount`, `on_date`, `payment_type`, `transaction_id`,`note`)VALUES ('$registeruser_id', '$noofsms', '$smsprice', '$amount', '$tax_amount', '$ServiceTax', '$total_amount','$on_date',1,'$trn_id','PPC')";
						  mysqli_query($link,$query1) or die('Error query:  '.$query1);
						  $payment_id=mysqli_insert_id($link); 
						  $query2="update users set available_credits=available_credits+$noofsms where user_id=$registeruser_id";
						   mysqli_query($link,$query2) or die('Error query:  '.$query2);

						$sql1="update price_enquery set is_created=1 where epg_txnID=$trn_id";
						$result = mysqli_query($link,$sql1) or die('Error query:  '.$sql1);
					//require($Email_lib);

$query1 = "SELECT no_ndnc,dnd_check,organization,username,first_name,last_name FROM users where user_id=".$registeruser_id;
$result1 = mysqli_query($link,$query1) or die('Error query:  '.$query1);
$rec1=mysqli_fetch_assoc($result1);
$organization=$rec1['organization'];
$username=$rec1['username'];
$name=$rec1['first_name'].' '.$rec1['last_name'];

if($rec1['no_ndnc']=="0")
{
$smstype="Promotional";
}
if($rec1['no_ndnc']=="1")
{
$smstype="Transactional";
}
if($rec1['no_ndnc']=="1" && $rec1['dnd_check']=='1')
{
$smstype="Semi Trans";
}


if($name=='')
{
$sql1="update price_enquery set name='$name' where registeruser_id=$registeruser_id";
$result = mysqli_query($link,$sql1) or die('Error query:  '.$sql1);
}


						//generate invoice insert start
                         $query2="INSERT INTO `sms`.`generate_invoice` (`user_id`, `transaction_id`, `sms_type`, `amount`, `create_on`)
                          VALUES ('$registeruser_id', '$trn_id', '$smstype', '$total_amount', '$on_date');";
                         mysqli_query($link,$query2) or die('Error query:  '.$query2);
						  $inv_id=mysqli_insert_id($link);
						  
					/*	  
						$invoiceyear=date("Y");
						  $lastyear=$invoiceyear-1;*/
						  
						  $invoice_id="MID/SM/".$inv_id;
						  
						  /*
						  if($inv_id>100)
						  {
						   $invoice_id="2016-17/MID/SMS/".$inv_id;
						  }
						  if($inv_id>10)
						  {
						   $invoice_id="2016-17/MID/0".$inv_id;
						  }*/
					//generate invoice insert end
					
						  

//$email="krishna@smsstriker.net";

send_invoice_generator($invoice_id,$epg_txnID,$created_on,$registeruser_id,$smstype,$payment_id,$organization,$name,$username,$on_date,$noofsms,$smsprice,$amount,$ServiceTax,$service_tax,$total_amount);

send_email_invoice($epg_txnID,$created_on,$registeruser_id,$smstype,$payment_id,$organization,$name,$username,$on_date,$noofsms,$smsprice,$amount,$ServiceTax,$service_tax,$total_amount,$pgresponse,$mobile,$email);


						
					print_r(json_encode(array('status'=>"success")));	
					}
					else
					{
 
				$sql1="update price_enquery set  is_created=0 where epg_txnID=$trn_id";
				$result = mysqli_query($link,$sql1) or die('Error query:  '.$sql1);
					}
			// sent eamil and mobile alert

				}
				else
				{
				
				print_r(json_encode(array('status'=>"failed")));
								//send_email_payment($name,$mobile,$email,$noofsms,$amount,$tax_amount,$total_amount,$pgresponse,$epg_txnID,$Email_lib);
				}
			break;
			}
	
	}
	else
	{
	print_r(json_encode(array('status'=>"failed")));
				//send_email_payment($name,$mobile,$email,$noofsms,$amount,$tax_amount,$total_amount,$pgresponse,$epg_txnID,$Email_lib);
	}
}


function send_email_payment($name,$mobile,$email,$noofsms,$amount,$tax_amount,$total_amount,$pgresponse,$epg_txnID,$Email_lib)
{

$username=ucfirst($name);

$sms_text = "Your payment ".$pgresponse."!..";
$sms_text .= " No of SMS ".$noofsms;
$sms_text .= " Amount ".$total_amount;
$sms_text .= " Transaction ID ".$epg_txnID;

 $sms_url = "https://www.smsstriker.com/API/sms.php?username=support&password=Str!k3r2020&from=STRIKR&to=$mobile&msg=".urlencode($sms_text)."&type=1";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $sms_url);
curl_setopt($ch, CURLOPT_header_new, 0);
//curl_exec($ch);
curl_close($ch);
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
$mail->SetFrom('sandeepthicse@gmail.com', 'User Payment');

//$mail->AddReplyTo($email, $name); // indicates ReplyTo headers
$mail->AddAddress($email, $name);
$mail->AddBCC("sandeepthicse@gmail.com", "SMS Payment");
//$mail->AddBCC("accounts@smsstriker.com", "SMS Payment");
//$mail->AddBCC("naveen@smsstriker.com", "SMS Payment");
$mail->WordWrap = 50;
$mail->IsHTML(true);
$mail->Subject = "Your payment".$pgresponse."!..";

 $message = '<html>
<head>
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
<style>
* {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;}
body{padding:0px;margin:0px;font-family: Lato,sans-serif;}
.mrgleft{margin-left:-25px;}
.main-newsletter{width:100%;max-width:600px;    float: left;}
.fullwidth{width:100%;float:left; }
.header-newsletr{background:url(http://smsstriker.com/images/about-page-bg.png) no-repeat;background-size: 100% 100%;
padding: 15px 25px;}
.padding25{padding-left:25px;padding-right:25px;}
.bold-name{color:#00B8B5;}
.halfwidth{width:100%;max-width: 275px;float:left;}
.halfwidth02{width:100%;max-width: 300px;float:left;}
.halfwidth03{width:100%;max-width: 200px;float:left;}

	
	.newsletter-table td{text-align:center;}
	.paddinglt25{padding-right:25px;}
	.footer-top-list{float:right;}
	.footer-top-list li:first-child{margin-bottom:16px;font-size:15px;}
	.footer-top-list li{text-align:right;list-style-type:none;margin-bottom: 6px;    font-size: 12px;
    font-weight: bold;}
	.footer-top-list span{margin-left:5px;}
	.footer-top-list b{color:#00B8B5;}
	.footerbtm{background:#58595B;padding-bottom: 7px;padding-top: 7px;}
	.footer-social-list{float:right;margin: 0px;}
	.footer-social-list li{list-style-type:none;float:left;margin-right:15px;}
	.footerlast{background:#BBBDBF;padding-top: 10px;padding-bottom: 10px;}
	.footerlast a, .footerlast p{font-size:9px;color:#fff;text-decoration:none;}
	.footerlast p{margin:0px;text-align:right;}
	.footer-social-list li:last-child{margin:0px;}
	.table-btmcont b{color:#00B8B5;}
	.text-right{text-align:right;}
	.table-btmcont p{font-size:11px;font-weight: bold;}
	.democlass a{background:#00b8b6;color:#fff;    color: #fff;
    padding: 3px 6px;
    margin-left: 4px;text-decoration:none;
    border-radius: 5px;}
	.mrgtbbotom{margin-top:10px;margin-bottom:10px;}

	.contactbtm02{position:relative;margin-top: 20px;    padding-top: 15px;
    padding-bottom: 15px;}

	.firstcontent p{font-size: 12px;
    font-weight: bold;}
	.play-btn a{text-decoration:none;color:#00B8B5;border:1px solid #00B8B5;    padding: 3px 5px;}
	.indian-rupee img{    width: 9px;
    margin-left: 2px;}
	.fltright{float:right !important;}
	.oneotp-content b{color: #00B8B5;}
	
	.btmotpcontent p{    background: #cdf1f1;
    padding: 15px;
    border-radius: 10px;}
	.oneotp-content p.otpnumber{font-weight:bold;    font-size: 16px;}
	.oneotp-content p{font-size: 14px;}
	.otp-padding{width:100%;max-width:470px;margin: auto;}
</style>

</head>
<body>
<div class="main-newsletter">
<div class="fullwidth header-newsletr">
<a href="https://www.smsstriker.com"><img src="http://smsstriker.com/images/sms-striker-logo.png" width="100px" alt="sms striker"></a>
</div>
<div class="fullwidth padding25 firstcontent">
<p>Hi</p>
<b class="bold-name">Mr/Mrs. '.$username.',</b>
<p>Thank you for showing interest in our services</p>
</div>
<div class="fullwidth padding25 oneotp-content">
<div class="otp-padding">
					<br> 
						<p>No of SMS          : '.$noofsms.' </p>
						<p>Amount             : '.$total_amount.' </p>
						<p>Transaction ID     : '.$epg_txnID.' </p>
						<p>Transaction status : '.$pgresponse.' </p>
					<br> 

</div>
</div>



<div class="fullwidth padding25 contactbtm02">

<div class="halfwidth fltright">
<ul class="footer-top-list">
<li><b>Need help?</b></li>
<li>+91  7097 19 19 19 <span><img src="http://strikersoftsolutions.com/images/newslet-phone.png" alt=""></span></li>
<li>support@smsstriker.com <span><img src="http://strikersoftsolutions.com/images/newsltr-mail.png" alt=""></span></li>
<li>www.smsstriker.com <span><img src="http://strikersoftsolutions.com/images/newsltr-web.png" alt=""></span></li>
</ul>
</div>
</div>
<div class="fullwidth footerbtm padding25">
<div class="halfwidth">
<img src="http://strikersoftsolutions.com/images/newsletter-footer-logo.png" alt="">
</div>
<div class="halfwidth">
<ul class="footer-social-list">
<li><a href="https://www.facebook.com/strikersoftsolutions/" target="_blank"><img src="http://strikersoftsolutions.com/images/fb.png" alt=""></a></li>
<li><a href="https://twitter.com/strikersofthyd" target="_blank"><img src="http://strikersoftsolutions.com/images/twiter.png" alt=""></a></li>
<li><a href="https://plus.google.com/110633432043392276134/about?gmbpt=true&hl=en" target="_blank"><img src="http://strikersoftsolutions.com/images/gpluse.png" alt=""></a></li>
</ul>
</div>
</div>
<div class="fullwidth footerlast padding25">
<div class="halfwidth">
<a href="https://www.smsstriker.com/privacy-policy.html">Disclaimers & Privacy Policy</a>
</div>
<div class="halfwidth">
<p>&copy; 2017 Striker Soft Solutions Pvt. Ltd. All Rights Reserved</p>
</div>
</div>
</div>
<div>

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


// send invoice email


function send_email_invoice($epg_txnID,$created_on,$registeruser_id,$smstype,$payment_id,$organization,$name,$username,$on_date,$no_of_sms,$price_per_sms,$amount,$ServiceTax,$service_tax,$total_amount,$pgresponse,$mobile,$email)
{
$username=ucfirst($username);
$sms_text = "Your payment ".$pgresponse."!..";
$sms_text .= " No of SMS ".$noofsms;
$sms_text .= " Amount ".$total_amount;
$sms_text .= " Transaction ID ".$epg_txnID;

$sms_url = "https://www.smsstriker.com/API/sms.php?username=support&password=Str!k3r2020&from=STRIKR&to=$mobile&msg=".urlencode($sms_text)."&type=1";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $sms_url);
curl_setopt($ch, CURLOPT_header_new, 0);
//curl_exec($ch);
curl_close($ch);


$mail = new PHPMailer();

// set mailer to use SMTP
$mail->IsSMTP();

$mail -> SMTPDebug = 2;
$mail->Host = 'smtp.sendgrid.net';
$mail->SMTPAuth = true;     // turn on SMTP authentication
$mail->Port = 587;
$mail->Username = "smsstriker";  // SMTP username
$mail->Password = "striker@123"; // SMTP password
$mail->FromName = "smsstriker";
 $mail->SetFrom("support@smsstriker.com", 'smsstriker');
//$mail->AddReplyTo($email, $name); // indicates ReplyTo headers
$mail->AddAddress($email, $name);
$mail->AddBCC("supraja.thanga@smsstriker.in", "SMSSTRIKER");
$mail->AddBCC("accounts@smsstriker.com", "SMSSTRIKER");
$mail->AddBCC("naveen@smsstriker.com", "SMSSTRIKER");
 
 
$mail->WordWrap = 50;
$mail->IsHTML(true);
$mail->Subject = "INVOICE";

  $message = '<html>
<head>
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
<style>
* {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;}
body{padding:0px;margin:0px;font-family: Lato,sans-serif;}
.mrgleft{margin-left:-25px;}
.main-newsletter{width:100%;max-width:600px;    float: left;}
.fullwidth{width:100%;float:left; }
.header-newsletr{background:url(http://smsstriker.com/images/about-page-bg.png) no-repeat;background-size: 100% 100%;
padding: 15px 25px;}
.padding25{padding-left:25px;padding-right:25px;}
.bold-name{color:#00B8B5;}
.halfwidth{width:100%;max-width: 275px;float:left;}
.halfwidth02{width:100%;max-width: 300px;float:left;}
.halfwidth03{width:100%;max-width: 200px;float:left;}

	
	.newsletter-table td{text-align:center;}
	.paddinglt25{padding-right:25px;}
	.footer-top-list{float:right;}
	.footer-top-list li:first-child{margin-bottom:16px;font-size:15px;}
	.footer-top-list li{text-align:right;list-style-type:none;margin-bottom: 6px;    font-size: 12px;
    font-weight: bold;}
	.footer-top-list span{margin-left:5px;}
	.footer-top-list b{color:#00B8B5;}
	.footerbtm{background:#58595B;padding-bottom: 7px;padding-top: 7px;}
	.footer-social-list{float:right;margin: 0px;}
	.footer-social-list li{list-style-type:none;float:left;margin-right:15px;}
	.footerlast{background:#BBBDBF;padding-top: 10px;padding-bottom: 10px;}
	.footerlast a, .footerlast p{font-size:9px;color:#fff;text-decoration:none;}
	.footerlast p{margin:0px;text-align:right;}
	.footer-social-list li:last-child{margin:0px;}
	.table-btmcont b{color:#00B8B5;}
	.text-right{text-align:right;}
	.table-btmcont p{font-size:11px;font-weight: bold;}
	.democlass a{background:#00b8b6;color:#fff;    color: #fff;
    padding: 3px 6px;
    margin-left: 4px;text-decoration:none;
    border-radius: 5px;}
	.mrgtbbotom{margin-top:10px;margin-bottom:10px;}

	.contactbtm02{position:relative;margin-top: 20px;    padding-top: 15px;
    padding-bottom: 15px;}

	.firstcontent p{font-size: 12px;
    font-weight: bold;}
	.play-btn a{text-decoration:none;color:#00B8B5;border:1px solid #00B8B5;    padding: 3px 5px;}
	.indian-rupee img{    width: 9px;
    margin-left: 2px;}
	.fltright{float:right !important;}
	.oneotp-content b{color: #00B8B5;}
	
	.btmotpcontent p{    background: #cdf1f1;
    padding: 15px;
    border-radius: 10px;}
	.oneotp-content p.otpnumber{font-weight:bold;    font-size: 16px;}
	.oneotp-content p{font-size: 14px;}
	.otp-padding{width:100%;max-width:470px;margin: auto;}
</style>

</head>
<body>
<div class="main-newsletter">
<div class="fullwidth header-newsletr">
<a href="https://www.smsstriker.com"><img src="http://smsstriker.com/images/sms-striker-logo.png" width="100px" alt="sms striker"></a>
</div>
<div class="fullwidth padding25 firstcontent">
<p>Hi</p>
<b class="bold-name">Mr/Mrs. '.$username.',</b>
<p>Thank you for showing interest in our services</p>
</div>
<div class="fullwidth padding25 oneotp-content">
<div class="otp-padding">
					<br> 
						<p>No of SMS          : '.$no_of_sms.' </p>
						<p>Amount             : '.$total_amount.' </p>
						<p>Transaction ID     : '.$epg_txnID.' </p>
						<p>Transaction status : '.$pgresponse.' </p>
					<br> 

</div>
</div>



<div class="fullwidth padding25 contactbtm02">

<div class="halfwidth fltright">
<ul class="footer-top-list">
<li><b>Need help?</b></li>
<li>+91  7097 19 19 19 <span><img src="http://strikersoftsolutions.com/images/newslet-phone.png" alt=""></span></li>
<li>support@smsstriker.com <span><img src="http://strikersoftsolutions.com/images/newsltr-mail.png" alt=""></span></li>
<li>www.smsstriker.com <span><img src="http://strikersoftsolutions.com/images/newsltr-web.png" alt=""></span></li>
</ul>
</div>
</div>
<div class="fullwidth footerbtm padding25">
<div class="halfwidth">
<img src="http://strikersoftsolutions.com/images/newsletter-footer-logo.png" alt="">
</div>
<div class="halfwidth">
<ul class="footer-social-list">
<li><a href="https://www.facebook.com/strikersoftsolutions/" target="_blank"><img src="http://strikersoftsolutions.com/images/fb.png" alt=""></a></li>
<li><a href="https://twitter.com/strikersofthyd" target="_blank"><img src="http://strikersoftsolutions.com/images/twiter.png" alt=""></a></li>
<li><a href="https://plus.google.com/110633432043392276134/about?gmbpt=true&hl=en" target="_blank"><img src="http://strikersoftsolutions.com/images/gpluse.png" alt=""></a></li>
</ul>
</div>
</div>
<div class="fullwidth footerlast padding25">
<div class="halfwidth">
<a href="https://www.smsstriker.com/privacy-policy.html">Disclaimers & Privacy Policy</a>
</div>
<div class="halfwidth">
<p>&copy; 2017 Striker Soft Solutions Pvt. Ltd. All Rights Reserved</p>
</div>
</div>
</div>
<div>

</div>
</body>
</html>';


 
 


$mail->Body    = $message;
$mail->AltBody = $message;



global $invoicepath;

$pdffilename = "SMSStriker_invoice_".$epg_txnID;
$filepath=$invoicepath.$pdffilename.'.pdf';
$mail->AddAttachment($filepath);


if(!$mail->Send())
{
   echo "Message could not be sent. <p>";
   echo "Mailer Error: " . $mail->ErrorInfo;

}else{

echo "Message has been sent";
}

}




function send_invoice_generator($invoice_id,$epg_txnID,$created_on,$registeruser_id,$smstype,$payment_id,$organization,$name,$username,$on_date,$no_of_sms,$price_per_sms,$amount,$ServiceTax,$service_tax,$total_amount)
{
  	
  //$url = "http://www.smsstriker.com/invoice_code/index.php";
global $invoice_url;
  $url = $invoice_url."invoice_code/index.php"; 
  $parameters="tn=$epg_txnID&invoice_id=$invoice_id&cd=$created_on&rid=$registeruser_id&smstype=$smstype
  &payment_id=$payment_id&od=$on_date&org=$organization&name=$name&st=$ServiceTax&amt=$amount&noofsms=$no_of_sms&total_amount=$total_amount&prices=$price_per_sms&username=$username&tax_amt=$service_tax";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);    
	$response = curl_exec($ch);   

	curl_close($ch);
}


 
if($_REQUEST['accondDetails'] == 1) {
 	$trnID = $_REQUEST['trnID'];
	$query =  "SELECT pe.registeruser_id,pe.pgresponse,pe.id FROM transaction_history th INNER JOIN price_enquery pe on pe.epg_txnID=th.epg_txnID WHERE th.epg_txnID = '".$trnID."' AND is_created = 0 group by th.payment_id order by th.payment_id desc limit 1";    
	$result = mysqli_query($link,$query);    
	if(mysqli_num_rows($result) > 0)  
	{     
		while($value = mysqli_fetch_assoc($result)) {    
			$userID = $value['registeruser_id'];
			$pgresponse = $value['pgresponse'];
			$PID = $value['id'];
			//if($pgresponse == 'Transaction Successful') { 
				$getUserData = "SELECT username,password,email FROM users WHERE user_id = '".$userID."'";
				$getUserDataRes = mysqli_query($link,$getUserData);
				while($userDataRes = mysqli_fetch_assoc($getUserDataRes)) {
					$name = $userDataRes['username']; 
					$email = $userDataRes['email']; 
					$password = generatePassword(); 
					
					mysqli_query($link,"UPDATE users set password = '".md5($password)."' where user_id = '".$userID."'");
					mysqli_query($link,"UPDATE price_enquery set is_created = 2 where id = '".$PID."'");		
					send_email_user_account_details($name,$email,$password);
					 
				}  
			//}  
		}       
		
	}
	
}



function generatePassword($l = 8, $c = 4, $n = 4, $s = 0) {
	// get count of all required minimum special chars
	$count = $c + $n + $s;

	// sanitize inputs; should be self-explanatory
	if(!is_int($l) || !is_int($c) || !is_int($n) || !is_int($s)) {
	trigger_error('Argument(s) not an integer', E_USER_WARNING);
	return false;
	}
	elseif($l < 0 || $l > 20 || $c < 0 || $n < 0 || $s < 0) {
	trigger_error('Argument(s) out of range', E_USER_WARNING);
	return false;
	}
	elseif($c > $l) {
	trigger_error('Number of password capitals required exceeds password length', E_USER_WARNING);
	return false;
	}  
	elseif($n > $l) {
	trigger_error('Number of password numerals exceeds password length', E_USER_WARNING);
	return false;
	}
	elseif($s > $l) {
	trigger_error('Number of password capitals exceeds password length', E_USER_WARNING);
	return false;
	}
	elseif($count > $l) {
	trigger_error('Number of password special characters exceeds specified password length', E_USER_WARNING);
	return false;
	}

	// all inputs clean, proceed to build password

	// change these strings if you want to include or exclude possible password characters
	$chars = $caps = "abcdefghijklmnopqrstuvwxyz";
	//$caps = strtoupper($chars);
	$nums = "0123456789";
	$syms = "!@#%^&*$?";
	$out = '';
	// build the base password of all lower-case letters
	for($i = 0; $i < $l; $i++) {
	$out .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
	}

	// create arrays if special character(s) required
	if($count) {
	// split base password to array; create special chars array
	$tmp1 = str_split($out);
	$tmp2 = array();

	// add required special character(s) to second array
	for($i = 0; $i < $c; $i++) {
	array_push($tmp2, substr($caps, mt_rand(0, strlen($caps) - 1), 1));
	}
	for($i = 0; $i < $n; $i++) {
	array_push($tmp2, substr($nums, mt_rand(0, strlen($nums) - 1), 1));
	}
	for($i = 0; $i < $s; $i++) {
	array_push($tmp2, substr($syms, mt_rand(0, strlen($syms) - 1), 1));
	}

	// hack off a chunk of the base password array that's as big as the special chars array
	$tmp1 = array_slice($tmp1, 0, $l - $count);
	// merge special character(s) array with base password array
	$tmp1 = array_merge($tmp1, $tmp2);
	// mix the characters up
	shuffle($tmp1);
	// convert to string for output
	$out = implode('', $tmp1);
	}

	return $out;
}


function send_email_user_account_details($name,$email,$accountPwd){ 
	$username=ucfirst($name); 
	$mail = new PHPMailer();
 
	$mail->IsSMTP();
	$mail->SMTPDebug = 3;
	$mail->Host = 'smtp.sendgrid.net';
	$mail->SMTPAuth = true;     // turn on SMTP authentication
	$mail->Port = 587;
	$mail->Username = "smsstriker";  // SMTP username
	$mail->Password = "striker@123"; // SMTP password
	$mail->FromName = "smsstriker";
	$mail->SetFrom("support@smsstriker.com", 'smsstriker');
  
	//$mail->AddReplyTo($email, $name); // indicates ReplyTo headers
	$mail->AddAddress($email, $name); 
	//$mail->AddBCC("supraja.thanga@smsstriker.in", "SMSSTRIKER");
	//$mail->AddBCC("accounts@smsstriker.com", "SMSSTRIKER");
	//$mail->AddBCC("naveen@smsstriker.com", "SMSSTRIKER");
	//$mail->AddAddress("muzaffar@strikersoft.in", "SMSSTRIKER");
	 
 
	$mail->WordWrap = 50;
	$mail->IsHTML(true);
	$mail->Subject = "Your Login Credentials";

	 $message = '<html>
	<head>
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
	<style>
	* {
	    -webkit-box-sizing: border-box;
	    -moz-box-sizing: border-box;
	    box-sizing: border-box;}
	body{padding:0px;margin:0px;font-family: Lato,sans-serif;}
	.mrgleft{margin-left:-25px;}
	.main-newsletter{width:100%;max-width:600px;    float: left;}
	.fullwidth{width:100%;float:left; }
	.header-newsletr{background:url(http://smsstriker.com/images/about-page-bg.png) no-repeat;background-size: 100% 100%;
	padding: 15px 25px;}
	.padding25{padding-left:25px;padding-right:25px;}
	.bold-name{color:#00B8B5;}
	.halfwidth{width:100%;max-width: 275px;float:left;}
	.halfwidth02{width:100%;max-width: 300px;float:left;}
	.halfwidth03{width:100%;max-width: 200px;float:left;}

	
		.newsletter-table td{text-align:center;}
		.paddinglt25{padding-right:25px;}
		.footer-top-list{float:right;}
		.footer-top-list li:first-child{margin-bottom:16px;font-size:15px;}
		.footer-top-list li{text-align:right;list-style-type:none;margin-bottom: 6px;    font-size: 12px;
	    font-weight: bold;}
		.footer-top-list span{margin-left:5px;}
		.footer-top-list b{color:#00B8B5;}
		.footerbtm{background:#58595B;padding-bottom: 7px;padding-top: 7px;}
		.footer-social-list{float:right;margin: 0px;}
		.footer-social-list li{list-style-type:none;float:left;margin-right:15px;}
		.footerlast{background:#BBBDBF;padding-top: 10px;padding-bottom: 10px;}
		.footerlast a, .footerlast p{font-size:9px;color:#fff;text-decoration:none;}
		.footerlast p{margin:0px;text-align:right;}
		.footer-social-list li:last-child{margin:0px;}
		.table-btmcont b{color:#00B8B5;}
		.text-right{text-align:right;}
		.table-btmcont p{font-size:11px;font-weight: bold;}
		.democlass a{background:#00b8b6;color:#fff;    color: #fff;
	    padding: 3px 6px;
	    margin-left: 4px;text-decoration:none;
	    border-radius: 5px;}
		.mrgtbbotom{margin-top:10px;margin-bottom:10px;}

		.contactbtm02{position:relative;margin-top: 20px;    padding-top: 15px;
	    padding-bottom: 15px;}

		.firstcontent p{font-size: 12px;
	    font-weight: bold;}
		.play-btn a{text-decoration:none;color:#00B8B5;border:1px solid #00B8B5;    padding: 3px 5px;}
		.indian-rupee img{    width: 9px;
	    margin-left: 2px;}
		.fltright{float:right !important;}
		.oneotp-content b{color: #00B8B5;}
	
		.btmotpcontent p{    background: #cdf1f1;
	    padding: 15px;
	    border-radius: 10px;}
		.oneotp-content p.otpnumber{font-weight:bold;    font-size: 16px;}
		.oneotp-content p{font-size: 14px;}
		.otp-padding{width:100%;max-width:470px;margin: auto;}
	</style>

	</head>
	<body>
	<div class="main-newsletter">
	<div class="fullwidth header-newsletr">
	<a href="https://www.smsstriker.com"><img src="http://smsstriker.com/images/sms-striker-logo.png" width="100px" alt="sms striker"></a>
	</div>
	<div class="fullwidth padding25 firstcontent">
	<p>Hi</p>
	<b class="bold-name">Mr/Mrs. '.$username.',</b>
	<p>Thank you for showing interest in our services</p>
	</div>
	<div class="fullwidth padding25 oneotp-content">
	<div class="otp-padding">
						<br> 
							<p>USERNAME          : '.$username.' </p>
							<p>PASSWORD             : '.$accountPwd.' </p> 
						<br> 

	</div>
	</div> 
	<div class="fullwidth padding25 contactbtm02">

	<div class="halfwidth fltright">
	<ul class="footer-top-list">
	<li><b>Need help?</b></li>
	<li>+91  7097 19 19 19 <span><img src="http://strikersoftsolutions.com/images/newslet-phone.png" alt=""></span></li>
	<li>support@smsstriker.com <span><img src="http://strikersoftsolutions.com/images/newsltr-mail.png" alt=""></span></li>
	<li>www.smsstriker.com <span><img src="http://strikersoftsolutions.com/images/newsltr-web.png" alt=""></span></li>
	</ul>
	</div>
	</div>
	<div class="fullwidth footerbtm padding25">
	<div class="halfwidth">
	<img src="http://strikersoftsolutions.com/images/newsletter-footer-logo.png" alt="">
	</div>
	<div class="halfwidth">
	<ul class="footer-social-list">
	<li><a href="https://www.facebook.com/strikersoftsolutions/" target="_blank"><img src="http://strikersoftsolutions.com/images/fb.png" alt=""></a></li>
	<li><a href="https://twitter.com/strikersofthyd" target="_blank"><img src="http://strikersoftsolutions.com/images/twiter.png" alt=""></a></li>
	<li><a href="https://plus.google.com/110633432043392276134/about?gmbpt=true&hl=en" target="_blank"><img src="http://strikersoftsolutions.com/images/gpluse.png" alt=""></a></li>
	</ul>
	</div>
	</div>
	<div class="fullwidth footerlast padding25">
	<div class="halfwidth">
	<a href="http://www.smsstriker.com/privacy-policy.html">Disclaimers & Privacy Policy</a>
	</div>
	<div class="halfwidth">
	<p>&copy; 2017 Striker Soft Solutions Pvt. Ltd. All Rights Reserved</p>
	</div>
	</div>
	</div>
	<div>

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



?>

	




