<?php

$link=mysqli_connect("localhost","strikerapp",'Off!c3@v2017',"sms") or die(mysqli_error($link));
$rs=mysqli_query($link,"select distinct port_no from sms_queue WHERE application_priority != '' ");
while($val=mysqli_fetch_array($rs))
{
 
	$source= 'Striker';
	$port = $val[0];
	$prefixofport = rtrim($port,0);
	if($port == 47900) {
		$url="/home/kannel/kannel_".$prefixofport."_margadarsi/init.d/kannel$prefixofport status";
	}else{
		$url="/home/kannel/kannel$prefixofport/init.d/kannel$prefixofport status";
	}
	$file = shell_exec($url);
	$splt=explode("running...",$file);
	if(count($splt)<2){
		send_email_port_status($port,$source);
	}
}


/* ################################################## Pointsms######################################### */

$link2=mysqli_connect("localhost","pointsmsapp",'po!nt$m$@2009',"sms_reseller") or die(mysqli_error());
$rs2=mysqli_query($link2,"select distinct port_no from sms_queue WHERE application_priority != '' ");
while($val=mysqli_fetch_array($rs2))
{
	$source = 'Pointsms';
 	$port = $val[0];
	$prefixofport = rtrim($port,0);
	if($port == 47900) {
		$url="/home/kannel/kannel_".$prefixofport."_margadarsi/init.d/kannel$prefixofport status";
	}else{
		$url="/home/kannel/kannel$prefixofport/init.d/kannel$prefixofport status";
	}
	$file = shell_exec($url);
	$splt=explode("running...",$file);
	if(count($splt)<2){
		 send_email_port_status($port,$source);
	}
}

 






function send_email_port_status($port,$source) {

	require('/var/www/html/strikerapp/PHPMailer-master/PHPMailerAutoload.php');
	//*** sent sms plan status **// 
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
	$mail->AddAddress("prasad.k@smsstriker.in", "SMSSTRIKER");
	$mail->AddBCC("srinivas.p@smsstriker.in", "SMSSTRIKER");
	$mail->AddBCC("ravi.kathula@smsstriker.net", "SMSSTRIKER");
	$mail->AddBCC("krishna@smsstriker.net", "SMSSTRIKER");
	$mail->AddBCC("rajkumar.g@smsstriker.in", "SMSSTRIKER");
	//$mail->AddAddress("sandeepthicse@gmail.com", "SMSSTRIKER");
	$mail->WordWrap = 50;
	$mail->IsHTML(true);
	$mail->Subject = "Alert! Kannel Port is Down : $port";

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
		       <p> The port is down '.$port.'. Please take an immediate action on priority base it may cause bussiness impact. </p> 
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
