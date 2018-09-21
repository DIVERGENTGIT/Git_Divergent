 <?php
 
  
////https://www.smsstriker.com/sendemail.php?payment=payment&trn_id=1518124824&servicetax=15&smsprice=0.18
include('config/config.php');

$base_url="http://www.smsstriker.com";

require($Email_lib);



send_email_admin();  
function send_email_admin() {

//*** sent sms plan status **// 
//$username="Prasad";

$mail = new PHPMailer();

// set mailer to use SMTP
//$mail->IsSMTP();
    
//$mail->smtpConnect([
  //  'ssl' => [
    //    'verify_peer' => false,
      //  'verify_peer_name' => false,
        //'allow_self_signed' => true
    //]
//]);


 

// set mailer to use SMTP
//$mail->IsSMTP();

//$mail->SMTPDebug = 2;
//$mail->Host = 'smtp.sendgrid.net';
//$mail->SMTPAuth = true;     // turn on SMTP authentication
//$mail->Port = 587;
//$mail->Username = "smsstriker";  // SMTP username
//$mail->Password = "striker@123"; // SMTP password
//$mail->FromName = "smsstriker";

 
/*

$mail->SMTPDebug = 2;
$mail->Host = 'smtp1.striker.co.in';
//$mail->Host = 'smtp.sendgrid.net';
$mail->SMTPAuth = true;     // turn on SMTP authentication
$mail->Port = 25;
$mail->Username = "ssemail";  // SMTP username
$mail->Password = "striker@123"; // SMTP password
$mail->FromName = "smsstriker";*/

$mail->SetFrom("support@smsstriker.com", 'SMSSTRIKER');
//$mail->SetFrom("support@campusstep.in", 'campusstep');
//$mail->AddReplyTo($email, $name); // indicates ReplyTo headers
//$mail->AddAddress($email, $name); 
$mail->AddBCC("sandeepthicse@gmail.com", "SMSSTRIKER");
$mail->AddAddress("krishna@smsstriker.net", "SMSSTRIKER");
$mail->WordWrap = 50;
$mail->IsHTML(true);
$mail->Subject = "New Lead";

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
	        testing
		 
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
