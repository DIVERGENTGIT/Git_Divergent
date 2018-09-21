<?php
include('../../config/config.php');
require($Email_lib);
/**
http://10.10.10.199/strikerapp/API/smsplan/sentleademail.php?un=MjkxNw==
http://10.10.10.199/strikerapp/thank-you.php?un=MjkxNw==
**/
 
if(isset($_GET['un'])) {

$source = 'SEO';
if(isset($_GET['source']) && $_GET['source'] = 'PPC') {
	$source = 'PPC';
}
$userid=base64_decode($_GET['un']);
$userid = mysqli_real_escape_string($link,$userid);
$query = "SELECT email,mobile,username,first_name,last_name,is_send FROM users where user_id='$userid'";
$result = mysqli_query($link,$query) or die('Error query:  '.$query);

	if(mysqli_num_rows($result)>0)  
	{
		$rec=mysqli_fetch_assoc($result);
		//print_r($rec);
		$is_send = $rec['is_send'];
		$email = $rec['email'];
		$mobile = $rec['mobile'];
		$username = $rec['username'];
		//$description = trim($rec['description']);
		$name = ucfirst($rec['first_name']).' '.ucfirst($rec['last_name']);
	
		if($is_send=='0')
		{       
  
			//if($description == 'landingPage') { $source = 'PPC'; }else{ $source = 'SEO'; }
			send_email_sms($email,$mobile,$username,$name,$source);  
			$query = "update users set is_send=1 where user_id='$userid'";
			$result = mysqli_query($link,$query) or die('Error query:  '.$query);
			$response_code="200";
			$code="1";
			$message="Send successfully!...";
		}
		else
		{
			$response_code="200";
			$code="2";
			$message="Alreadysent";
		}
	
	
	}
	else
	{
	  		$response_code="200";
	  		$code="2";
			$message="Invalid User Details";
	}
}
else
{
  		$response_code="200";
  		$code="2";
		$message="Invalid User Details";
}
print_r(json_encode(array("status"=>$response_code,"code"=>$code,"message"=>$message)));
exit;

function send_email_sms($email,$mobile,$username,$name,$source)
{
//require($Email_lib);
//*** sent sms plan status **// 
$username=ucfirst($username);

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
//$mail->AddAddress("gotte.naresh@gmail.com", $name);
//$mail->AddBCC("sandeepthicse@gmail.com", "SMSSTRIKER");
//$mail->AddBCC("supraja.thanga@smsstriker.in", "SMSSTRIKER");
//$mail->AddBCC("accounts@smsstriker.com", "SMSSTRIKER");
//$mail->AddBCC("naveen@smsstriker.com", "SMSSTRIKER");
$mail->AddBCC("sales@smsstriker.com", "SMSSTRIKER");
$mail->WordWrap = 50;    
$mail->IsHTML(true);  
$mail->Subject = "SMSSTRIKER - New User Registration";

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
	       <p> Dear Team,</p></br>
	        
	        <p>Here are the new user information.</p>
 
		<p>Username : '.$username.'</p>	
		<p>Email : '.$email.'</p>
		<p>Mobile : '.$mobile.'</p>
		 <p>Source : '.$source.' </p>
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




