<?php
include('config/config.php');
require($Email_lib);

$base_url="https://www.smsstriker.com";
if(isset($_GET['save3'])) {
	$id = mysqli_real_escape_string($link,$_GET['userid']);
$otpverify = mysqli_real_escape_string($link,$_GET['otpverify']);

 $query = "SELECT * FROM price_enquery where id=".$id;
	$result = mysqli_query($link,$query) or die('Error query:  '.$query);
$rec=mysqli_fetch_array($result);

 	    $otpcode = $rec['otpcode'];
		$sendtime = $rec['otptime'];
		$smstype = $rec['smstype'];
		$noofsms = $rec['noofsms'];
		$subcription = $rec['subcription'];
		if($subcription==0){
		 $months="One Time";
		}else{  
		 $months = $subcription."Months";
		}
		$email = $rec['email'];
		$name = $rec['name'];
	 $mobile = $rec['mobile'];

 
	if($otpcode==$otpverify)
		{
		
			if($sendtime > time()) /// check if 3 mins over or not
			 {
				
					 $query="UPDATE `price_enquery` SET `otpverify` = '1'   WHERE `id` =".$id;
					 mysqli_query($link,$query);

					$verify=1;
			  }else{
			  	$verify=2; // time out
			 	
			 	}
		}
		else
		{
		 $verify=0;
		}

echo json_encode(array("status"=>200,'verifystatus'=>$verify));		
	
	@mysqli_close($link);
	
 
 }
 

/*******For resend otp user **************/
 if(isset($_GET['resendotp'])) {
		$generateotp=substr(mt_rand(), 0, 4); /// to generate random number
		$time = time() + 1 * 60;	// set sesion time to 3 mins
		
		$otp =array("otp"=>$generateotp);

		$name = mysqli_real_escape_string($link,$_GET['name']);
		$email = mysqli_real_escape_string($link,$_GET['email']);
		
		$mobile = mysqli_real_escape_string($link,$_GET['mobile']);
		 $query="UPDATE `price_enquery` SET `otpcode`= '$generateotp',`otptime`= '$time'   WHERE `id` =".$_GET['userid'];
		mysqli_query($link,$query);
   	$affectrow= mysqli_affected_rows($link);
   
	if($affectrow){  
		$id = mysqli_real_escape_string($link,$_GET['userid']);
		$query = "SELECT * FROM price_enquery where id=".$id;
		$result = mysqli_query($link,$query) or die('Error query:  '.$query);
		$rec=mysqli_fetch_assoc($result);
			$otp = $rec['otpcode'];
			$email = $rec['email'];
			$name = $rec['name'];
			$mobile = $rec['mobile'];
		send_email_otp($name,$email,$mobile,$otp); 
		echo json_encode(array("status"=>200,'resend'=>1,"otp"=>$generateotp));		
	}
 
	@mysqli_close($link);
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
$mail->Host = 'mail.office24by7.in';
$mail->SMTPAuth = true;     // turn on SMTP authentication
$mail->Port = 465;
$mail->Username = "app@office24by7.in";  // SMTP username
$mail->Password = "Str!ker@123"; // SMTP password
$mail->FromName = "smsstriker";
$mail->SetFrom("support@smsstriker.com", 'smsstriker');
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

.header-newsletr{background:url(http://smsstriker.com/images/about-page-bg.png) no-repeat;background-size: 100% 100%;
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
<a href="index.html"><img src="http://smsstriker.com/images/sms-striker-logo.png" width="100px" alt="sms striker"></a>
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
<a href="http://www.smsstriker.com/privacy-policy.html">Disclaimers & Privacy Policy</a>
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


	 

/*******For user information and send otp**************/
 if(isset($_GET['save2'])) {
  
		$generateotp=substr(mt_rand(), 0, 4); /// to generate random number
		$time = time() + 3 * 60;	// set sesion time to 3 mins	
		$otp =array("otp"=>$generateotp);
		$name = mysqli_real_escape_string($link,$_GET['username']);
		$email = mysqli_real_escape_string($link,$_GET['email']);
		$mobile = mysqli_real_escape_string($link,$_GET['mobile']);
		$couponCode = mysqli_real_escape_string($link,$_GET['couponCode']);
		$couponUsed = FALSE;  
		
		if($couponCode) {
			$checkCouponUsed =  "SELECT id FROM price_enquery WHERE couponCode = '".$couponCode."' AND pgresponse = 'Transaction Successful' AND (email = '".$email."' OR mobile = '".$mobile."') ";
			$checkCouponUsedRes = mysqli_query($link,$checkCouponUsed);
			$couponUsed = mysqli_num_rows($checkCouponUsedRes);  
		}
		if($couponUsed) {
				echo json_encode(array("status" => 201));		
		}else{ 
  
			$query="UPDATE `price_enquery` SET `name` = '$name', `email`= '$email', `mobile`= '$mobile' ,`otpcode`= '$generateotp' ,`otptime`= '$time' ,couponCode='$couponCode'  WHERE `id` =".$_GET['userid'];
			mysqli_query($link,$query);
	   		$affectrow= mysqli_affected_rows($link);

			if($affectrow){   
				echo json_encode(array("status"=>200,"otp"=>$generateotp));		
			}
		}
		
		$query = "SELECT noofsms,pagetype FROM price_enquery where id = '".$_GET['userid']."'";
		$result = mysqli_query($link,$query) or die('Error query:  '.$query);
		$rec = mysqli_fetch_assoc($result);
	 	$noofsms = $rec['noofsms'];  
		$source = $rec['pagetype'];  
		send_email_otp($name,$email,$mobile,$generateotp); 
		send_leadInfo_to_sales($name,$mobile,$email,$noofsms,$source,$base_url);
 
}      


  
 
  
function send_leadInfo_to_sales($name,$number,$email,$noofsms,$source,$base_url) { 
	$tmp_number = trim($number);
	if(strlen($tmp_number)==10 )
	{  
		if($tmp_number[0]==7 or $tmp_number[0]==8 or $tmp_number[0]==9 )
		{ 
			$username = ucfirst($name);	   
			$sms_text = "New Lead Generated User : $username,Email : $email, Mobile : $number, NofSMS : $noofsms , source : $source.";  
			$sms_url = "https://www.smsstriker.com/API/sms.php?";
			$toNumbers = '8501822227';
			if($number == 8885966361) {
				$toNumbers = '8885966361';
			}   
			$sms_url .= "username=support&password=Str!k3r2020&from=STRIKR&to=$toNumbers&msg=".urlencode($sms_text)."&type=1";
			$ch = curl_init();  
			curl_setopt($ch, CURLOPT_URL, $sms_url);
			curl_setopt($ch, CURLOPT_header_new, 0);  
			curl_exec($ch);
			curl_close($ch);     
			$listName = 'SMS Preview';
		 	$result = file_get_contents("https://voiceapi.office24by7.com/LeadGenerate/AddLead?API_Key=484960c1-5861-42a7-aebd-ee92639bea0e&cust_number=$number&listname=$listName&source_type=$source");   
  

			//$result = file_get_contents("http://inhostapis.office24by7.com/LeadGenerate/AddLead?API_Key=175b2d4f-bd75-4878-8d53-7aaa2eca4731&cust_number=$number&listname=PPC&source_type=$source");
			/*$agentstatus_json= file_get_contents("http://inhostapis.office24by7.com/LeadGenerate/CheckAgent?API_Key=175b2d4f-bd75-4878-8d53-7aaa2eca4731&division=Sales%20Agent"); 
            		$agentstatus = json_decode($agentstatus_json,true);   
            		if($agentstatus['message']=='available') 
                	{ 
                		return  $result = file_get_contents("http://inhostapis.office24by7.com/LeadGenerate/AddLead?API_Key=175b2d4f-bd75-4878-8d53-7aaa2eca4731&cust_number=$number&source_type=STRIKER-$source&listname=PPC%20Agent"); 
                	} 
           	 	else   
                	{ 
                		return $result = file_get_contents("http://inhostapis.office24by7.com/LeadGenerate/AddLead?API_Key=175b2d4f-bd75-4878-8d53-7aaa2eca4731&cust_number=$number&source_type=STRIKER-$source&listname=PPC%20Executive"); 
               	 	} */
		}

	}
} 



/*******************required sms information **********************/

 if(isset($_GET['method_save']) && $_GET['method_save']=='save' ) {
	
  
$noofsms = mysqli_real_escape_string($link,$_GET['noofsms']);
$smstype = mysqli_real_escape_string($link,$_GET['smstype']);
$subcription = mysqli_real_escape_string($link,$_GET['subcription']);
$couponCode = mysqli_real_escape_string($link,$_GET['couponCode']);
$pageType = '';
if($smstype == 'Transactional') {
	$pageType = 'home-trans';
}else if ($smstype == 'Promotional') {
	$pageType = 'home-promo';
}  


$insert_query = "INSERT INTO `price_enquery` (`noofsms`, `smstype`, `servicetype`, `subcription`,`couponCode`,`pagetype`) VALUES
 ('$noofsms','$smstype','sms','$subcription','$couponCode','$pageType');";
 
	

	mysqli_query($link,$insert_query);  
	$id=mysqli_insert_id($link);    
	$query = "SELECT * FROM price_enquery where id=".$id;
	$result = mysqli_query($link,$query) or die('Error query:  '.$query);
	$price_enquery = array();
		while($result1=mysqli_fetch_object($result))
		{
		 $price_enquery[] = $result1;  
		}
		echo json_encode($price_enquery) ;

	@mysqli_close($link);
}
  


 



?>
