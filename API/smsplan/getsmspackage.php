<?php
include('../../config/config.php');
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
$mail->AddAddress('sales@smsstriker.com', 'SMS Leads');
$mail->AddAddress('joshi.herald@smsstriker.in', 'SMS Leads');
$mail->AddCC("naveen@smsstriker.com", "SMS Leads");
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
$mail->Host = 'mail.office24by7.in';
$mail->SMTPAuth = true;     // turn on SMTP authentication
$mail->Port = 465;
$mail->Username = "app@office24by7.in";  // SMTP username
$mail->Password = "Str!ker@123"; // SMTP password
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

$sql1="SELECT * FROM `sms_price_list` where noofsms<=$noofsms order by id desc limit 1";
$plane_query1=mysqli_query($link,$sql1);
$plans_rows1=mysqli_fetch_assoc($plane_query1);
//print_r($plans_rows1);
$getnoofsms=$plans_rows1['noofsms'];
$message_plans='';
$sql="select * from sms_price_list  order by id asc";
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
<a href="index.html"><img src="http://smsstriker.com/images/sms-striker-logo.png" width="100px" alt="sms striker"></a>
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
padding-left: 17px;background-size: 11px;background-position: left top 8px;list-style-type:none; position:relative;background-size: 9px;background-position: left top 4px;"><a style="text-decoration:none;color:#4d4d4d;font-weight: bold;font-size:11px;" href="http://smsstriker.com/">SMS</a></li>
<li style="margin-bottom: 3px;    background: url(http://strikersoftsolutions.com/images/dot-email.png) no-repeat;
padding-left: 17px;background-size: 11px;background-position: left top 8px;list-style-type:none; position:relative;background-size: 9px;background-position: left top 4px;"><a style="text-decoration:none;color:#4d4d4d;font-weight: bold;font-size:11px;" href="http://smsstriker.com/">Long Code</a></li>
<li style="margin-bottom: 3px;    background: url(http://strikersoftsolutions.com/images/dot-email.png) no-repeat;
padding-left: 17px;background-size: 11px;background-position: left top 8px;list-style-type:none; position:relative;background-size: 9px;background-position: left top 4px;"><a style="text-decoration:none;color:#4d4d4d;font-weight: bold;font-size:11px;" href="http://smsstriker.com/">Short URL</a></li>
<li style="margin-bottom: 3px;    background: url(http://strikersoftsolutions.com/images/dot-email.png) no-repeat;
padding-left: 17px;background-size: 11px;background-position: left top 8px;list-style-type:none; position:relative;background-size: 9px;background-position: left top 4px;"><a style="text-decoration:none;color:#4d4d4d;font-weight: bold;font-size:11px;" href="http://smsstriker.com/">Missed Call</a></li>
<li style="margin-bottom: 3px;    background: url(http://strikersoftsolutions.com/images/dot-email.png) no-repeat;
padding-left: 17px;background-size: 11px;background-position: left top 8px;list-style-type:none; position:relative;background-size: 9px;background-position: left top 4px;"><a style="text-decoration:none;color:#4d4d4d;font-weight: bold;font-size:11px;" href="http://smsstriker.com/">OBD Call</a></li>
<li style="margin-bottom: 3px;    background: url(http://strikersoftsolutions.com/images/dot-email.png) no-repeat;
padding-left: 17px;background-size: 11px;background-position: left top 8px;list-style-type:none; position:relative;background-size: 9px;background-position: left top 4px;"><a style="text-decoration:none;color:#4d4d4d;font-weight: bold;font-size:11px;" href="http://smsstriker.com/">IVR</a></li>
<li style="margin-bottom: 3px;    background: url(http://strikersoftsolutions.com/images/dot-email.png) no-repeat;
padding-left: 17px;background-size: 11px;background-position: left top 8px;list-style-type:none; position:relative;background-size: 9px;background-position: left top 4px;"><a style="text-decoration:none;color:#4d4d4d;font-weight: bold;font-size:11px;" href="http://smsstriker.com/">Virtual Number</a></li>
<li style="margin-bottom: 3px;    background: url(http://strikersoftsolutions.com/images/dot-email.png) no-repeat;
padding-left: 17px;background-size: 11px;background-position: left top 8px;list-style-type:none; position:relative;background-size: 9px;background-position: left top 4px;"><a style="text-decoration:none;color:#4d4d4d;font-weight: bold;font-size:11px;" href="http://smsstriker.com/">Toll Free Number</a></li>
<li style="margin-bottom: 3px;    background: url(http://strikersoftsolutions.com/images/dot-email.png) no-repeat;
padding-left: 17px;background-size: 11px;background-position: left top 8px;list-style-type:none; position:relative;background-size: 9px;background-position: left top 4px;"><a style="text-decoration:none;color:#4d4d4d;font-weight: bold;font-size:11px;" href="http://smsstriker.com/">Click to Call</a></li>
<li style="margin-bottom: 3px;    background: url(http://strikersoftsolutions.com/images/dot-email.png) no-repeat;
padding-left: 17px;background-size: 11px;background-position: left top 8px;list-style-type:none; position:relative;background-size: 9px;background-position: left top 4px;"><a style="text-decoration:none;color:#4d4d4d;font-weight: bold;font-size:11px;" href="http://smsstriker.com/">Conference Call</a></li>
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
<div class="halfwidth02" style="width:100%;max-width: 350px;float:left;"><p><b>Note:</b> <br> Service Tax of 15% is applicable on all your Packages. <br> </p></div>
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
<li style="text-align:right;list-style-type:none;margin-bottom: 6px;font-size: 12px;font-weight: bold;"><a href="http://www.smsstriker.com/" style="text-decoration:none;color:#000;">www.smsstriker.com <span style="margin-left:5px;"><img src="http://strikersoftsolutions.com/images/newsltr-web.png" alt=""></span></a></li>
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
<a style="font-size:9px;color:#fff;text-decoration:none;" href="http://www.smsstriker.com/privacy-policy.html">Disclaimers & Privacy Policy</a>
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


